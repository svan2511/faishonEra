<?php

use App\Models\Color;
use App\Models\Size;
use App\Models\Tax;
use Intervention\Image\Facades\Image;

if( !function_exists('createSlug') )
{
 function createSlug( $str )
 {

    return strtolower(str_replace(' ','-',$str));
 }

}

if( !function_exists('createAccordinCategory') )
{
 function createAccordinCategory( $str )
 {

   return strtolower(str_replace(' ','', $str)); 
 }

}

      if( !function_exists('getUserSessionStatus') )
      {
              function getUserSessionStatus( $request )
              {

                      if($request->session()->has('FRONT_USER_LOGGED_IN'))
                      {
                        $data['user_id'] = $request->session()->get('FRONT_USER_LOGGED_ID');
                        $data['user_type'] = "REGST";
                      }
                      else
                      {
                            if(  $request->session()->has('USER_TEMP_ID')== null   )
                            {
                                $data['user_id'] = rand(111111111,999999999);
                                $request->session()->put('USER_TEMP_ID',$data['user_id']);
                                
                            }
                            else
                            {
                              $data['user_id'] = $request->session()->get('USER_TEMP_ID');
                            }
                            $data['user_type'] = "NONREGST";
                      }

                      return $data;
              }

      }

      if( !function_exists('getCartTotalAmount') )
      {
              function getCartTotalAmount( $prod_price , $prod_quantity )
              {

                
                    return ( $prod_price * $prod_quantity );
                  


              }

      }

      if( !function_exists('getCartTotalTax') )
      {
              function getCartTotalTax( $tax_id , $prod_quantity , $prod_price )
              {
                if( $tax_id !== null)
                {
                  $tax_value = Tax::find($tax_id)->tax_val;
                  $total_tax = (($prod_price * $tax_value)/100)*$prod_quantity;
                  return $total_tax;
                }
              
                  


              }

      }


      if( !function_exists('getRangeproductPrice') )
      {
              function getRangeproductPrice( $product_array , $product_type  )
              {
                     
                $final_str ='';
                     
                $disPriceArray = [];

                foreach( $product_array as $product )
                {
                        if( $product_type == 1)
                        {
                
                
                         $final_str .= '<div class="wrap-price before_price_pro"><ins><p class="product-price">$'.$product->disc_price.'</p></ins> <del><p class="product-price">$'.$product->reg_price.'</p></del></div>';
                        }
                        else
                        { 
                        $disPriceArray[] = $product->reg_price;
                        }
                  
                }

                if( $product_type == 0)
                        {
                                $final_str =  '<div class="wrap-price before_price_pro"><ins><span class="product-price">$'.min($disPriceArray).' - $'.max($disPriceArray).'</span></ins> </div>';
		
                        }
                  
                			
              return $final_str;

              }

      }

      if( !function_exists('prx') )
      {
              function prx( $parry )
              {

                    echo "<pre>"; print_r($parry);
                  die;
                  


              }

      }


      if( !function_exists('getSize') )
      {
              function getSize( $size_id )
              {

                   $size = Size::find($size_id);
                   return $size->size_title;
                  


              }

      }

      if( !function_exists('getColor') )
      {
              function getColor( $color_id )
              {

                   $color = Color::find($color_id);
                   return $color->color_name;
                  


              }

      }







?>