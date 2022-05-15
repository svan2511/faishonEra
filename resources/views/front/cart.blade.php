@extends('front/master-layout')
  
  @section('main_content')

  <main id="main" class="main-site">

		<div class="container">

			<div class="wrap-breadcrumb">
				
			</div>
			<div class="main-content-area">
			@if( isset($prod_details[0]) )
				<div class="wrap-iten-in-cart">
					<h3 class="box-title cart_upadted_data">Products Name</h3>
					<ul class="products-cart">
					<?php $fullAmount =0; $tax = 0; ?>
					
						@foreach( $prod_details as $product )
					
						<li class="pr-cart-item" id="cartId_{{$product->cart_id}}">
							<div class="product-image">
								<figure><img src="{{ asset('storage/admin_assets/products/attr') }}/{{ $product->attr_image }}" alt=""></figure>
							</div>
							<div class="product-name">
								<a class="link-to-product" href="{{url('product')}}/{{$product->pro_slug}}">{{ substr( $product->product_title ,0,25)  }}...  ( {{getColor($product->color_id)}} ) ( {{ getSize($product->size_id)}} )</a>
							</div>
							<div class="wrap-price"><p class="product-price"> 
								@if( $product->is_discounted == 1)
								$<span class="_{{$product->cart_id}}">{{$product->disc_price}}</span>
								@else
								$<span class="_{{$product->cart_id}}">{{$product->reg_price}}</span>
								@endif
							</p></div>
						<div class="quantity">
								<div class="quantity-input change_price_cart">
									<input type="text" id="product-quatity_{{$product->cart_id}}" name="product-quatity" value="{{$product->quantity}}" data-max="120" pattern="[0-9]*" >									
									<a class="btn btn-increase" data-click="true" data-qty="{{$product->cart_id}}" href="#"></a>
									<a class="btn btn-reduce" data-click="true" data-qty="{{$product->cart_id}}"  href="#"></a>
								</div>
							</div>
							<div class="price-field sub-total"><p class="price">
							@if( $product->is_discounted == 1)
							<?php  
							$fullAmount = $fullAmount + getCartTotalAmount($product->disc_price,$product->quantity);
							$tax = $tax + getCartTotalTax( $product->tax_id, $product->quantity , $product->disc_price);
							
							?>
							$<span class="tot_{{$product->cart_id}}">{{$product->quantity * $product->disc_price}}</span>
							@else
							<?php  
							$fullAmount = $fullAmount + getCartTotalAmount($product->reg_price,$product->quantity);
							$tax = $tax + getCartTotalTax( $product->tax_id, $product->quantity , $product->reg_price);
							?>
							$<span class="tot_{{$product->cart_id}}">{{$product->quantity * $product->reg_price}}</span>
							@endif
							</p></div>
							<div class="delete">
								<a href="javascript:void(0)"  class="btn btn-delete cart_del" title="">
									<span>Delete from your cart</span>
									<i class="fa fa-times-circle" aria-hidden="true" data-cartId="{{$product->cart_id}}"></i>
								</a>
							</div>
						</li>
						
						@endforeach
																	
					</ul>
				
				</div>

				<div class="summary myCheckout">
					
					<div class="checkout-info">
					<form action="{{url('checkout')}}" method="post">
						@csrf
						<input type="hidden" name="sub_total" id="hidd_cart_subtot" value="{{$fullAmount}}">
						<input type="hidden" name="total_tax" id="total_tax" value="{{$tax}}">
						<input type="submit" class="btn btn-checkout submit-cart" value="CHECK OUT - TOTAL AMOUNT : ( ${{$fullAmount}} )"> 
				</form>
					</div>
					
				</div>
				@else
				<div class="wrap-iten-in-cart">
					<h3 class="box-title ">Your cart is Empty. </h3>
				</div>

						@endif

			
				</div> 

			</div><!--end main content area-->
		</div><!--end container-->

	</main>


  @endsection