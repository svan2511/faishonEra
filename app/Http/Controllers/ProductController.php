<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductAttributes;
use App\Models\Size;
use App\Models\SubCategory;
use App\Models\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $products = Product::all();
        $products = Product::with('category','brand','subCategory')->get();
        //echo "<pre>";print_r($products);die;
        return view('admin.products.products',["title" => 'Products Listing' , 'products'=>$products] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $title = "Add New Product";
        $categories = Category::where('is_home',1)->get();
        $subcategories = SubCategory::all();
        $taxes = Tax::all();
        $brands = Brand::all();
        $sizes = Size::all();
        $colors = Color::all();
        return view('admin.products.add_product_form',["title" => $title,
        'categories' => $categories ,
        'subcategories' => $subcategories,
        'taxes' => $taxes,
        'brands' => $brands,
        'sizes' => $sizes,
        'colors' => $colors
        ] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $rules = [
		 
            'product_title' => 'required',
            'product_brand' => 'required',
            'product_sub_cat_id' => 'required',
            'product_cat_id' => 'required',
            'product_image' => 'required|mimes:jpg,jpeg,png',
            ];


        $customMessages = 
                [
                'required' => 'This Field can not be blank.',
                'mimes' => 'Image should be only in JPG , JPEG and PNG formate.',

                ];

        $this->validate($request, $rules, $customMessages);

        // Products Attribute validation 
		
       $skuArr = $request->sku_number;
       $reg_priceArr = $request->reg_price;
       $disc_priceArr = $request->disc_price;
       $qtyArr = $request->qty;
       $size_id_Arr = $request->size_id;
       $color_id_Arr = $request->color_id;
       
       foreach($skuArr as $key=> $val)
       {
         $sku_count_query = ProductAttributes::where('sku_number' ,'=' ,$skuArr[$key]);
          $sku_count = $sku_count_query->count();
        
                 if($sku_count > 0)
                 {
                         
                       $request->session()->flash('sku_error',"SKU ".$skuArr[$key]." Used Already ! ");
                       return redirect(request()->header('referer'));
                    }
                }

        $model = new Product();
        
        if($request->hasFile('product_image'))
		{
			
			$image = $request->file('product_image');
            
			$ext = $image->extension();
			$product_image_name = time().".".$ext;
			
			$image->storeAs('/public/admin_assets/products' ,$product_image_name );
			
			$model->product_image = $product_image_name;
		}
		$msg = 'Product Added Successfully';
		$model->pro_slug = createSlug($request->post('product_title'));

        $model->product_cat_id = $request->post('product_cat_id');
        $model->product_sub_cat_id = $request->post('product_sub_cat_id');
        $model->product_title = $request->post('product_title');
        $model->product_brand = $request->post('product_brand');
        $model->shrt_desc = $request->post('shrt_desc');
        $model->full_desc = $request->post('full_desc');
        $model->tech_spec = $request->post('tech_spec');

        $model->is_featured = $request->post('is_featured');
        $model->is_discounted = $request->post('is_discounted');
        $model->tax_id = $request->post('tax_id');
        $model->pro_status = 1;
		
	
		$model->save();

        $data = $request->all();

        $this->pro_attributesActions( $data , $model->product_id ,$request , "INST");
		
	    $request->session()->flash('pro_add_msg',$msg);
        
		return redirect('products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
    
        $title = "Edit Product"; 
        $categories = Category::where('is_home',1)->get();
        $subcategories = SubCategory::all();
        $taxes = Tax::all();
        $brands = Brand::all();
        $sizes = Size::all();
        $colors = Color::all();
        return view('admin.products.edit_product_form',[
            "title" => $title ,
            "categories" => $categories,
             "product" => $product,
             "subcategories" => $subcategories,
             "taxes" => $taxes,
             "brands" => $brands,
             "colors" => $colors,
             "sizes" => $sizes             
             ] );
   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id )
    {
        $model = Product::find($id);
        $rules = [
		 
            'product_title' => 'required',
            'product_brand' => 'required',
            'product_sub_cat_id' => 'required',
            'product_cat_id' => 'required',
            ];

            if($request->product_image!="")
            {
                $rules+= ['product_image' => 'mimes:jpg,jpeg,png'];
            }
        $customMessages = 
                [
                'required' => 'This Field can not be blank.',
                'mimes' => 'Image should be only in JPG , JPEG and PNG formate.',

                ];
         
             $this->validate($request, $rules, $customMessages);


             
       // Products Attribute validation 
		
       $skuArr = $request->sku_number;
       $reg_priceArr = $request->reg_price;
       $disc_priceArr = $request->disc_price;
       $qtyArr = $request->qty;
       $size_id_Arr = $request->size_id;
       $color_id_Arr = $request->color_id;
       if(isset($request->hidden_attr_id))
       {
        $hidden_attr_idArray = $request->hidden_attr_id;
       }

       foreach($skuArr as $key=> $val)
       {
         $sku_count_query = ProductAttributes::where('sku_number' ,'=' ,$skuArr[$key]);
         if(isset($request->hidden_attr_id))
            {
             $sku_count_query->where('attr_id' ,'!=' ,$request->hidden_attr_id[$key]);
            }
         
            $sku_count = $sku_count_query->count();
        
                 if($sku_count > 0)
                 {
                         
                       $request->session()->flash('sku_error',"SKU ".$skuArr[$key]." Used Already ! ");
                       return redirect(request()->header('referer'));
                    }
                }

        if($request->hasFile('product_image'))
                {
                    
                    $image = $request->file('product_image');
                    $ext = $image->extension();
                    $product_image_name = time().".".$ext;
                    
                    $image->storeAs('/public/admin_assets/products' ,$product_image_name );
                    
                    $model->product_image = $product_image_name;
                }

                $model->pro_slug = createSlug($request->post('product_title'));

                $model->product_cat_id = $request->post('product_cat_id');
                $model->product_sub_cat_id = $request->post('product_sub_cat_id');
                $model->product_title = $request->post('product_title');
                $model->product_brand = $request->post('product_brand');
                $model->shrt_desc = $request->post('shrt_desc');
                $model->full_desc = $request->post('full_desc');
                $model->tech_spec = $request->post('tech_spec');
        
                $model->is_featured = $request->post('is_featured');
                $model->is_discounted = $request->post('is_discounted');
                $model->tax_id = $request->post('tax_id');
                $model->pro_status = 1;
       
        $msg = 'Product Updated Successfully';
           
		
                $model->save();


                $data = $request->all();

               // echo "<pre>" ;print_r($data);die;

         $this->pro_attributesActions( $data , $model->product_id ,$request ,"UPDT");
                
                $request->session()->flash('pro_add_msg',$msg);
                return redirect('products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }


    public function change_subcat(Request $request)
    {
        $sub_cat_id = $request->post('sub_cat_id');
        $subcategories = Category::with('subCategory')->find($request->post('cat_id'));
       // print_r($subcategories);die;
        return view('admin.products.change_subcat',['subcategories' => $subcategories ,'sub_cat_id' => $sub_cat_id ] );
    }

    public function pro_attributesActions( $data , $prod_id , $request , $proAction )
    {
       
       // Products Attribute Insertion 
		//prx($data);
       $skuArr = $data['sku_number'];
       $reg_priceArr = $data['reg_price'];
       if(isset($data['disc_price']))
       {
        $disc_priceArr = $data['disc_price'];
       }
     
       $qtyArr = $data['qty'];
       $size_id_Arr = $data['size_id'];
       $color_id_Arr = $data['color_id'];
       if(isset($data['hidden_attr_id']))
       {
        $hidden_attr_idArray = $data['hidden_attr_id'];
       }
       
      // echo "<pre>"; print_r($skuArr);die;
  foreach($skuArr as $key=> $val)
  {
    

      $productArray= [];
      $productArray['product_id'] = $prod_id;
      $productArray['sku_number'] = $skuArr[$key];
      $productArray['reg_price'] = $reg_priceArr[$key];
      if(isset($data['disc_price']))
       {
        $productArray['disc_price'] = $disc_priceArr[$key];
       }
     
      $productArray['qty'] = $qtyArr[$key];
      
      if($size_id_Arr[$key] == "")
      {
          $productArray['size_id'] = null;
      }
      else
      {
          $productArray['size_id'] = $size_id_Arr[$key];
      }
      if($color_id_Arr[$key] == "")
      {
          $productArray['color_id'] = null;
      }
      else
      {
          $productArray['color_id'] = $color_id_Arr[$key];
      }
   
      if($request->hasfile("attr_image.$key"))
      {
      $rand_num = rand('111111111','999999999');
      $image_attr = $request->file("attr_image.$key");
      $image_attr_ext = $image_attr->extension();
      $image_attr_name = $rand_num.".".$image_attr_ext;
      //echo $image_attr_name;die('d');
      $image_attr->storeAs('/public/admin_assets/products/attr' ,$image_attr_name );
      
      $productArray['attr_image'] = $image_attr_name;
      }
      

      if ( !isset($hidden_attr_idArray[$key]))
      {
        DB::table('product_attributes')->insert($productArray);
      }

      else
      {
         
          if($proAction === "UPDT" && !isset($data['disc_price']))
          {
            $productArray['disc_price']= 0; 
          }
           //prx($productArray);
        DB::table('product_attributes')->where(['attr_id' => $hidden_attr_idArray[$key]])->update($productArray);
      }

      
      
  }
    }

    public function delete_attribute( Request $request , $attrId ,$productId )
    {
        $model = ProductAttributes::find($attrId);
		$model->delete();
        $msg = "Attribute Deleted Successfully .";
        $request->session()->flash('pro_att_del_msg',$msg);
                return redirect()->route('products.edit' , $productId );
    }

    
}
