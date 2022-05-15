<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\Size;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Monolog\Handler\ElasticaHandler;


class HomeController extends Controller
{
    public function index( )
    {
        
        $saleProducts = Product::with('productAttributes')->where('is_discounted',1)->get();
        $latestProducts = Product::with('productAttributes')->orderBy('created_at','desc')->get();
 

       // echo "<pre>"; print_r($categories[0]->product[0]->productAttributes);die;
        return view('front/home',[
        'title' => "Welcome to Faishon Era",
        'saleProducts' => $saleProducts ,
        'latestProducts' => $latestProducts,
        
    
    ]);
    }

    public function shopPage( Request $request )
    {
        
       
        $brands = Brand::all();
        $colors = Color::all();
        $sizes = Size::all();
        
       
        $productQuery = DB::table('products');
        $productQuery = $productQuery->Join('product_attributes', 'product_attributes.product_id', '=', 'products.product_id');
        $productQuery = $productQuery->distinct()->select('products.*','product_attributes.*');
        //
        if( $request->post('product_search_top') !== null)
        {
            //return $request->post();
            if( $request->post('select_catId') !== null && $request->post('select_subcatId')==null)
            {
            $productQuery = $productQuery->where('products.product_cat_id', $request->post('select_catId'));
       
            }
            if( $request->post('select_subcatId') !==null )
            {
            $productQuery = $productQuery->where('products.product_cat_id', $request->post('select_catId'))->where('product_sub_cat_id',$request->post('select_subcatId'));
       
            }
            if( $request->post('search') !== null)
            {
                
            $productQuery = $productQuery->where('products.product_title','like','%'.$request->post('search') .'%');
       
            }
           
          
        }
        
        
        if( $request->get('cat_filter') !==null && $request->get('subcat_filter') !==null)
            {
                $productQuery = $productQuery->where('products.product_cat_id', $request->get('cat_filter'))->where('product_sub_cat_id',$request->get('subcat_filter'));
       
            }
            if( $request->get('brand_filter') !==null )
            {
                $productQuery = $productQuery->where('products.product_brand',$request->get('brand_filter'));
        
            }

            if( $request->get('min_price') !==null && $request->get('max_price') !==null)
            {
                $productQuery = $productQuery->whereBetween('product_attributes.disc_price', [(int)$request->get('min_price'),(int)$request->get('max_price')] );
       
            }

            if( $request->get('color_filter') !==null )
            {
                $productQuery = $productQuery->where('product_attributes.color_id', (int)$request->get('color_filter'));
       
            }

            if( $request->get('size_filter') !==null )
            {
                $productQuery = $productQuery->where('product_attributes.size_id', (int)$request->get('size_filter'));
       
            }

        $productQuery = $productQuery->groupBy('products.product_id');
        $data['allProducts'] = $productQuery->get();
//dd($data);
       

//dd(DB::getQueryLog());
    
                                 foreach($data['allProducts'] as $prod_list)
								{
									
									 $db_query = DB::table('product_attributes');
									$db_query = $db_query->leftJoin('sizes', 'product_attributes.size_id', '=', 'sizes.size_id');
									$db_query = $db_query->leftJoin('colors', 'product_attributes.color_id', '=', 'colors.color_id');
									$db_query = $db_query->where(['product_attributes.product_id' => $prod_list->product_id]);
									$db_query = $db_query->get();
									$data['all_products_attr'][$prod_list->product_id ] = $db_query;
									
								
								}
                               //prx($data);

        return view('front/shop',[
            'title' => "All Products",
            'brands' => $brands,
            'colors' => $colors,
            'sizes' => $sizes,
            'data' => $data,
            'last_page' => 2 //$allProducts->lastPage(),
           
        ]);
    }

    public function cartPage( Request $request )
    {
        
        $userData = getUserSessionStatus( $request );
          $userId = $userData['user_id'];
          $userType = $userData['user_type'];
          $cartProducts = DB::table('cart')
          ->leftJoin('products', 'products.product_id', '=', 'cart.product_id')
          ->leftJoin('product_attributes', 'product_attributes.attr_id', '=', 'cart.product_attr_id')
          ->select('products.*','cart.quantity' ,'cart.cart_id','product_attributes.attr_image','product_attributes.reg_price','product_attributes.disc_price','product_attributes.color_id','product_attributes.size_id')
          ->where('user_id', $userId)
          ->where('user_type', $userType)->get();
        
       return view('front/cart',[
        'title' => "Your Cart Page",
           'prod_details'=>$cartProducts
        ]);
   

    }
    public function single_product( $slug )
    {
       
        
        $product = Product::with('productAttributes')->where('pro_slug',$slug)->get();
        $pro_cat_id = $product[0]->product_cat_id;
        $pro_id = $product[0]->product_id;
        $relatedProducts = Category::with( ["product" => function( $query ) use( $pro_id ) {  
            $query->where('products.product_id', '!=', $pro_id ); 
        }])
        ->where('cat_id',$pro_cat_id)->get();
       // prx($relatedProducts);

        $pro_aatributes = DB::table('product_attributes')
        ->leftjoin('colors', 'product_attributes.color_id', '=', 'colors.color_id')
        ->leftjoin('sizes', 'product_attributes.size_id', '=', 'sizes.size_id')
        ->where('product_attributes.product_id', $product[0]->product_id)->get();

         return view('front/single-product',[
             'title' => $product[0]->product_title." Details",
             'product' => $product ,
             'relatedProducts' => $relatedProducts,
             'pro_aatributes' => $pro_aatributes,
            
            
            ]);
    }

    public function add_cart(Request $request)
    {
        $userData = getUserSessionStatus( $request );
          $arr['user_id']=$userData['user_id'];
          $arr['user_type']=$userData['user_type'];
          $arr['product_id']=$request->product_id;
          $arr['product_attr_id']= $request->attr_id;
          $arr['quantity']=$request->pro_qty;

        
  
          $update_cart_id = $this->checkCartProductSatus( $request , $arr );
            
				if( $update_cart_id)
                {
                        DB::table('cart')
                        ->where('cart_id', $update_cart_id)
                        ->update($arr);
                        $msg = 'Product Updated To Cart Successfully';
                    
                }
                else
                {
                    DB::table('cart')->insert($arr);
                    $msg = 'Product Inserted To Cart Successfully';
                   
                }
                $cartCount =  DB::table('cart')
                ->where('user_id',  $userData['user_id'])
                ->where('user_type',  $userData['user_type'])
                ->count();

                $cart_details = DB::table('cart')
                ->where('user_id',  $userData['user_id'])
                ->where('user_type',  $userData['user_type'])
                ->count();
                return response()->json(['status' => 'success' ,'msg' => $msg ,'cart_details' => $cart_details ]);
        
    }

    public function checkCartProductSatus( $request , $arr )
    {
              
                $check = DB::table('cart')
				->where('product_id', $arr['product_id'])
				->where('user_id',  $arr['user_id'])
				->where('user_type',  $arr['user_type'])
				->where('product_attr_id', $arr['product_attr_id'])
				->get();
                if(isset($check[0]))
                {
                    return $check[0]->cart_id;
                }
                else
                {
                    return false;
                }
    }

    public function cart_del( Request $request)
    {
        $userData = getUserSessionStatus( $request );
          $arr['user_id']=$userData['user_id'];
          $arr['user_type']=$userData['user_type'];

        $check = DB::table('cart')
        ->where('cart_id',$request->post('cart'))
        ->where('user_id',$arr['user_id'])
        ->where('user_type',$arr['user_type'])
        ->delete();
        $cart_count = DB::table('cart')
        ->where('user_id',$arr['user_id'])
        ->where('user_type',$arr['user_type'])
        ->count();

        $cartProducts = DB::table('cart')
          ->leftJoin('products', 'products.product_id', '=', 'cart.product_id')
          ->leftJoin('product_attributes', 'product_attributes.attr_id', '=', 'cart.product_attr_id')
          ->select('products.is_discounted','products.tax_id','cart.quantity' ,'cart.cart_id','product_attributes.reg_price','product_attributes.disc_price',)
          ->where('user_id', $arr['user_id'])
          ->where('user_type', $arr['user_type'])->get();

          //prx($cartProducts);
          $cart_total_updated_price = 0; $cart_total_tax = 0;
          foreach($cartProducts as $prod )
          {
              if( $prod->is_discounted == 1)
              {
                $cart_total_updated_price = $cart_total_updated_price + getCartTotalAmount($prod->disc_price , $prod->quantity);
                $cart_total_tax = $cart_total_tax + getCartTotalTax( $prod->tax_id, $prod->quantity , $prod->disc_price);
              }
              else 
              {
                $cart_total_updated_price = $cart_total_updated_price + getCartTotalAmount($prod->reg_price , $prod->quantity);
                $cart_total_tax = $cart_total_tax + getCartTotalTax( $prod->tax_id, $prod->quantity , $prod->reg_price);
              }
           
          }
        return response()->json(['status' => 'success','cart_count'=>$cart_count ,'cart_total_updated_price' => $cart_total_updated_price ,'cart_total_tax' => $cart_total_tax ]);
        
    }

    public function cart_update( Request $request)
    {
        $userData = getUserSessionStatus( $request );
          $arr['user_id']=$userData['user_id'];
          $arr['user_type']=$userData['user_type'];
          $cartarr['quantity']=$request->post('qty');
        $check = DB::table('cart')
        ->where('cart_id',$request->post('cart_id'))
        ->where('user_id',$arr['user_id'])
        ->where('user_type',$arr['user_type'])
        ->update($cartarr);

        $cartProducts = DB::table('cart')
          ->leftJoin('products', 'products.product_id', '=', 'cart.product_id')
          ->leftJoin('product_attributes', 'product_attributes.attr_id', '=', 'cart.product_attr_id')
          ->select('products.is_discounted','products.tax_id','cart.quantity' ,'cart.cart_id','product_attributes.reg_price','product_attributes.disc_price',)
          ->where('user_id', $arr['user_id'])
          ->where('user_type', $arr['user_type'])->get();

          //prx($cartProducts);
          $cart_total_updated_price = 0; $cart_total_tax = 0;
          foreach($cartProducts as $prod )
          {
              if( $prod->is_discounted == 1)
              {
                $cart_total_updated_price = $cart_total_updated_price + getCartTotalAmount($prod->disc_price , $prod->quantity);
                $cart_total_tax = $cart_total_tax + getCartTotalTax( $prod->tax_id, $prod->quantity , $prod->disc_price);
              }
              else 
              {
                $cart_total_updated_price = $cart_total_updated_price + getCartTotalAmount($prod->reg_price , $prod->quantity);
                $cart_total_tax = $cart_total_tax + getCartTotalTax( $prod->tax_id, $prod->quantity , $prod->reg_price);
              }
           
          }
        return response()->json(['status' => 'success' , 'cart_total_updated_price' => $cart_total_updated_price ,'cart_total_tax'=>$cart_total_tax ]);
    }

    public function checkout( Request $request )
    {
        //echo $request->session()->get('FRONT_USER_LOGGED_IN');die('anil');
        
        $total =  $request->post('sub_total');
        $total_tax = $request->post('total_tax');
        if ( $request->session()->get('FRONT_USER_LOGGED_IN'))
        {
            $user = User::where('id', $request->session()->get('FRONT_USER_LOGGED_ID'))->first();
            return view('front/checkout',['title' => "Checkout Page",'total'=>$total,'total_tax'=>$total_tax ,'user' => $user]);
        }
        else
        {
            return view('front/checkout',['title' => "Checkout Page",'total'=>$total,'total_tax'=>$total_tax ]);
        }
        
    }


    public function placed_order(Request $request)
    {
    
        
        $rules = [

            'name' => 'required', 
           'phone' => 'numeric|digits:10|required',
           'country' => 'required',
           'zipcode' => 'required', 
           'city' => 'required', 
           'address' => 'required', 
           'payment_type' => 'required'
        ];

            if ( $request->session()->get('FRONT_USER_LOGGED_IN') )
            {
                
                $rules+= [ 'email' => 'required|email'];
            }
            else
            {
                $rules+= [ 'email' => 'required|email|unique:users'];
            }
          
            


        $valid = Validator::make($request->all() , $rules);
            
        if (!$valid->passes())
        {
            return response()->json(['error' => $valid->errors() , 'status' => 'failed']); die;
        }



        if ( $request->session()->get('FRONT_USER_LOGGED_IN') )
        {
            
            $userId = $request->session()->get('FRONT_USER_LOGGED_ID');
            $userType = "REGST";
            $status = $this->updateCustomerData( $request , $userId, $userType);
            if(!$status)
            {
                return response()->json(['status' => 'NPUD' ,'msg' => 'Some Internal Error occured !']);
              
            }
        }
        else
        {
            
            
            $userData = getUserSessionStatus( $request );
            $arr['user_id']=$userData['user_id'];
            $arr['user_type']=$userData['user_type'];

            $cust_id = $this->insertCustomerData( $request ,$arr['user_id'] ,$arr['user_type']);

                if ( $cust_id)
                {
                    $userId = $request->session()->get('USER_TEMP_ID');
                    DB::table('cart')->where('user_id', $userId)
                    ->update(
                    ['user_id' => $cust_id,'user_type' => 'REGST']
                    
                    );
                    $userId = $cust_id;
                    $userType = 'REGST';
                    $request->session()->put('FRONT_USER_LOGGED_ID', $userId);
                   
            
                }

                
        }

        $order_id = $this->insertOrderData( $request , $userId );
       
        if ( $order_id )
        {
            $this->insertOrderDetailsData( $userId , $userType , $order_id );

            if( $request->post('payment_type') == "ONLINE")
            {
                $response = $this->getFinalPayment( $request ,$order_id);
               // echo "<pre>";print_r($response);die;
                $redirect_url = $response->payment_request->longurl;
                DB::table('orders')
                    ->where('order_id', $order_id)
                    ->update(['transaction_id' => $response->payment_request->id]);
              $request->session()->put('PLACED_ORDER_ID',$order_id);
                 
              return response()->json(['url_redirect' => $redirect_url, 'status' => 'redirect_user' ,'msg' => 'Order Placed Successfully']);
               

            }
            else
            {
                $request->session()->put('PLACED_ORDER_ID',$order_id);
			    return response()->json(['msg' => 'Order Placed Successfully', 'status' => 'O_P_S']);
            }
           

        }

        



    }

    public function insertCustomerData( $request, $userId ,$userType)
    {
            $customer_data = [];
            $customer_data['cust_random_id'] = rand(111111111, 999999999);
            $customer_data['email'] = $request->post('email');
            $customer_data['name'] = $request->post('name');
            $customer_data['password'] = Crypt::encrypt(rand(111111111, 999999999));
            $customer_data['phone'] = $request->post('phone');
			$customer_data['address'] = $request->post('address');
			$customer_data['city'] = $request->post('city');
			$customer_data['zipcode'] = $request->post('zipcode');
			$customer_data['country'] = $request->post('country');
           // echo "<pre>";print_r($customer_data);die('anil');
           $request->session()->put(['FRONT_USER_LOGGED_IN' => true ,'FRONT_USER_LOGGED_ID' => $userId,'FRONT_USER_LOGGED_NAME'=> $request->post('name')]);
          // echo "<pre>"; print_r($request->session()->all());die('anil');
           $cust_id = DB::table('users')->insertGetId($customer_data);
            return $cust_id;
    }

    public function updateCustomerData( $request, $userId ,$userType)
    {
            $customer_data = [];
            $customer_data['email'] = $request->post('email');
            $customer_data['name'] = $request->post('name');
            $customer_data['phone'] = $request->post('phone');
			$customer_data['address'] = $request->post('address');
			$customer_data['city'] = $request->post('city');
			$customer_data['zipcode'] = $request->post('zipcode');
			$customer_data['country'] = $request->post('country');
           // echo "<pre>";print_r($customer_data);die('anil');
           if( DB::table('users')->where('user_id',$userId)->where('user_type',$userType)->update($customer_data) )
           {
            return true;
           }
            
    }

    public function insertOrderData( $request , $userId )
    {
        $order_data['user_id'] = $userId;
        $order_data['placed_on'] = date('Y-m-d h:i:s');
        $order_data['order_status'] = 'placed';
        $order_data['payment_type'] = $request->post('payment_type');
        $order_data['used_coupon_code'] = $request->post('coupon_code');
        $order_data['order_total_amount'] = $request->post('grand_total');


        $order_id = Order::insertGetId($order_data);
        return $order_id;
    }

    public function insertOrderDetailsData( $userId , $userType , $order_id )
    {
        
        $cartProducts = DB::table('cart')
        ->leftJoin('products', 'products.product_id', '=', 'cart.product_id')
        ->leftJoin('product_attributes', 'product_attributes.attr_id', '=', 'cart.product_attr_id')
        ->select('products.*','cart.quantity' ,'cart.cart_id','product_attributes.attr_id','product_attributes.attr_image','product_attributes.reg_price','product_attributes.disc_price','product_attributes.color_id','product_attributes.size_id')
        ->where('user_id', $userId)
        ->where('user_type', $userType )->get();

                $arr =[];
    
            foreach($cartProducts as $product)
            {
                $arr['product_id']=$product->product_id;
                $arr['attr_id']=$product->attr_id;
                if( $product->is_discounted == 1 )
                {
                    $arr['price']=$product->disc_price;
                }
                else
                {
                    $arr['price']=$product->reg_price;
                }
               
                $arr['quantity']=$product->quantity;
                $arr['order_id']=$order_id;
                
                OrderDetails::insert($arr);
                
                
            }

            DB::table('cart')->where('user_id', $userId)->where('user_type', $userType)->delete();
    }

    public function getFinalPayment( $request , $order_id)
    {
        $payload = Array(
                'purpose' => 'Shopping on Faishon Era',
                'amount' => $request->grand_total,
                'phone' => $request->post('phone'),
                'buyer_name' => $request->post('name'),
                'redirect_url' => 'http://127.0.0.1:8000/order/details',
                'send_email' => true,
                
                'send_sms' => true,
                'email' => $request->post('email'),
                'allow_repeated_payments' => false
            );

            $response = $this->paymentResponse( $payload );
            return json_decode($response);
           
    }


    public function paymentResponse( $payload )
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
                    array("X-Api-Key:test_e3e09b6140ddd166953ff7ed4e6",
                          "X-Auth-Token:test_e5a737e4b527fb984136ba3656e"));
        
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        $response = curl_exec($ch);
        curl_close($ch); 
        return  $response;
    }

    public function getOrderDetails(Request $request)
    {
        $userData = getUserSessionStatus( $request );
        $userId=$userData['user_id'];

        if ( $request->get('payment_id') && $request->get('payment_request_id'))
        {
            DB::table('orders')->where('transaction_id', $request->get('payment_request_id'))
			->update(['payment_id' => $request->get('payment_id') ,'payment_status' =>$request->get('payment_status')]);
        }
    

           $total_orders['orders'] = Order::where('user_id', $userId)->get();
          foreach ( $total_orders['orders'] as $single_order )
          {
              $total_orders['product_details'][$single_order->order_id] = DB::table('orders')
        ->Join('order_details', 'orders.order_id', '=', 'order_details.order_id')
        ->Join('products', 'products.product_id', '=', 'order_details.product_id')
        ->Join('product_attributes', 'products.product_id', '=', 'product_attributes.product_id')
        ->where('orders.user_id', $userId)->where('orders.order_id', $single_order->order_id )->get();;
          }

         // prx($total_orders);
        return view('front.orders', ["title" => "Order Details",'total_orders' =>$total_orders]);
			
}


public function check_coupon(Request $request)
{
 //return $request->post();
    $result = Coupon::where('code',$request->post('coupon'))->where('status',1)->get();
   
    //prx($result[0]->type);
    if ( !isset( $result[0] ) )
   {
    return response()->json(['msg' => 'Invalid Coupon Code', 'status' => 'fail']);
   }

   if( $request->post('cart') < $result[0]->min_cart_value )
   {
    return response()->json(['msg' => 'Cart Value Should be equal or greater than $'.$result[0]->min_cart_value , 'status' => 'fail']);
   }


   if ( $result[0]->type === "perc" )
   {
       

    $discount = floor ( ( $request->post('cart') * $result[0]->value )/100 );
   $final_amount = $request->post('cart') - $discount;
   }
   else
   {
    $discount = $result[0]->value;
    $final_amount = $request->post('cart') - $discount;

   }
   return response()->json(['msg' => 'Coupon Applied','discount' => $discount ,'final_amount' => $final_amount, 'status' => 'success']);

   
}

public function test()
{
	return view('test');
}

}
