@extends('front/master-layout')
  
  @section('main_content')

  <main id="main">
		<div class="container">

			<!--MAIN SLIDE-->
			<div class="wrap-main-slide">
				<div class="slide-carousel owl-carousel style-nav-1" data-items="1" data-loop="1" data-nav="true" data-dots="false">
					<div class="item-slide">
						<img src="{{ asset('assets/images/main-slider-1-1.jpg')}}" alt="" class="img-slide">
						<div class="slide-info slide-1">
							<h2 class="f-title">Kid Smart <b>Watches</b></h2>
							<span class="subtitle">Compra todos tus productos Smart por internet.</span>
							<p class="sale-info">Only price: <span class="price">$59.99</span></p>
							<a href="#" class="btn-link">Shop Now</a>
						</div>
					</div>
					<div class="item-slide">
						<img src="{{ asset('assets/images/main-slider-1-2.jpg')}}" alt="" class="img-slide">
						<div class="slide-info slide-2">
							<h2 class="f-title">Extra 25% Off</h2>
							<span class="f-subtitle">On online payments</span>
							<p class="discount-code">Use Code: #FA6868</p>
							<h4 class="s-title">Get Free</h4>
							<p class="s-subtitle">TRansparent Bra Straps</p>
						</div>
					</div>
					<div class="item-slide">
						<img src="{{ asset('assets/images/main-slider-1-3.jpg')}}" alt="" class="img-slide">
						<div class="slide-info slide-3">
							<h2 class="f-title">Great Range of <b>Exclusive Furniture Packages</b></h2>
							<span class="f-subtitle">Exclusive Furniture Packages to Suit every need.</span>
							<p class="sale-info">Stating at: <b class="price">$225.00</b></p>
							<a href="#" class="btn-link">Shop Now</a>
						</div>
					</div>
				</div>
			</div>

			<!--BANNER-->
			<div class="wrap-banner style-twin-default">
				<div class="banner-item">
					<a href="#" class="link-banner banner-effect-1">
						<figure><img src="{{ asset('assets/images/home-1-banner-1.jpg')}}" alt="" width="580" height="190"></figure>
					</a>
				</div>
				<div class="banner-item">
					<a href="#" class="link-banner banner-effect-1">
						<figure><img src="{{ asset('assets/images/home-1-banner-2.jpg')}}" alt="" width="580" height="190"></figure>
					</a>
				</div>
			</div>

			<!--On Sale-->
			<div class="wrap-show-advance-info-box style-1 has-countdown">
				<h3 class="title-box">Product On Sale</h3>
				<div class="wrap-countdown mercado-countdown" data-expire="2020/12/12 12:34:56"></div>
				<div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container " data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>


				@if( isset( $saleProducts[0] ) )

						@foreach( $saleProducts as $product)

					<div class="product product-style-2 equal-elem">
						<div class="product-thumnail">
							<a href="{{url('product')}}/{{$product->pro_slug}}" title="{{$product->product_title}}">
								<figure><img class="cust_img_size" src="{{ asset('storage/admin_assets/products') }}/{{ $product->product_image }}" alt="{{$product->product_title}}"></figure>
							</a>
							<div class="group-flash">
								<span class="flash-item sale-label">sale</span>
							</div>
							<div class="wrap-btn">
								<a href="#" class="function-link">quick view</a>
							</div>

							
						</div>
						<div class="product-info">
							<a href="{{url('product')}}/{{$product->pro_slug}}" class="product-name"><span>{{ substr( $product->product_title ,0,25)  }}...</span></a>

							@if(count($product->productAttributes) <= 1 )

							<input type="hidden" id="sale_prod_front_{{$product->productAttributes[0]->attr_id}}" value="{{$product->productAttributes[0]->attr_id}}">
							@foreach( $product->productAttributes as $attribute )
							
							<div class="wrap-price"><ins><p class="product-price">${{$attribute->disc_price}}</p></ins> <del><p class="product-price">${{$attribute->reg_price}}</p></del></div>
							@endforeach

							@else
							<input type="hidden" id="sale_prod_front_{{$product->productAttributes[0]->attr_id}}" value="{{$product->productAttributes[0]->attr_id}}">
								<?php echo getRangeproductPrice($product->productAttributes ,$product->is_discounted);?>
							@endif
							
							<img src="{{asset('assets/images/loading.gif')}}" id="sale_loding_img_{{$product->product_id}}" style="width:80px;display:none;">
							<p id="sale_cart_msg_{{$product->product_id}}" style="font-size:12px;display:none;"></p>
						</div>
						<div class="wrap-butons">
								<a href="javascript:void(0)" data-attrId="sale_prod_front_{{$product->productAttributes[0]->attr_id}}" data-prodId="{{$product->product_id}}" data-imageId="sale_loding_img_{{$product->product_id}}" data-messageId="sale_cart_msg_{{$product->product_id}}" class="btn add-to-cart custom-cart front_add_to_cart">Add to Cart</a>
							</div>
					</div>

 
					@endforeach

					@else

					<div class="product product-style-2 equal-elem">
						<h3 class="title-box">No Sale Producs Now.</h3>

					</div>
					@endif
					

				</div>
			</div>

			<!--Latest Products-->
			<div class="wrap-show-advance-info-box style-1">
				<h3 class="title-box">Latest Products</h3>
				<div class="wrap-top-banner">
					<a href="#" class="link-banner banner-effect-2">
						<figure><img src="{{ asset('assets/images/digital-electronic-banner.jpg')}}" width="1170" height="240" alt=""></figure>
					</a>
				</div>
				<div class="wrap-products">
					<div class="wrap-product-tab tab-style-1">						
						<div class="tab-contents">
							<div class="tab-content-item active" id="digital_1a">
								<div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >

								@if( isset( $latestProducts[0] ) )

								@foreach( $latestProducts as $product )
									<div class="product product-style-2 equal-elem ">
										<div class="product-thumnail">
											<a href="{{url('product')}}/{{$product->pro_slug}}" title="{{ $product->product_title }}">
												<figure><img class="cust_img_size" src="{{ asset('storage/admin_assets/products') }}/{{ $product->product_image }}" width="800" height="800" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
											</a>
											<div class="group-flash">
												<span class="flash-item new-label">new</span>
											</div>
											@if( $product->is_discounted == 1)
											<div class="group-flash">
												<span class="flash-item sale-label">sale</span>
											</div>
											@endif
											<div class="wrap-btn">
												<a href="#" class="function-link">quick view</a>
											</div>
										</div>
										<div class="product-info">
											<a href="{{url('product')}}/{{$product->pro_slug}}" class="product-name"><span>{{ substr( $product->product_title ,0,25)  }}...</span></a>
											@if(count($product->productAttributes) <= 1 )
											<input type="hidden" id="latest_prod_front_{{$product->productAttributes[0]->attr_id}}" value="{{$product->productAttributes[0]->attr_id}}">
							@foreach( $product->productAttributes as $attribute )
	
							@if( $product->is_discounted == 1)

							<div class="wrap-price"><ins><p class="product-price">${{$attribute->disc_price}}</p></ins> <del><p class="product-price">${{$attribute->reg_price}}</p></del></div>
						
							@else
							<div class="wrap-price"><ins><p class="product-price">${{$attribute->reg_price}}</p></ins></div>
							@endif


								@endforeach

							@else
							<input type="hidden" id="latest_prod_front_{{$product->productAttributes[0]->attr_id}}" value="{{$product->productAttributes[0]->attr_id}}">
								<?php echo getRangeproductPrice($product->productAttributes , $product->is_discounted);?>
							@endif
										</div>
										<img src="{{asset('assets/images/loading.gif')}}" id="latest_loding_img_{{$product->product_id}}" style="width:80px;display:none;">
							<p id="latest_cart_msg_{{$product->product_id}}" style="font-size:12px;display:none;"></p>
										<div class="wrap-butons">
										<a href="javascript:void(0)" data-attrId="latest_prod_front_{{$product->productAttributes[0]->attr_id}}" data-prodId="{{$product->product_id}}" data-imageId="latest_loding_img_{{$product->product_id}}" data-messageId="latest_cart_msg_{{$product->product_id}}" class="btn add-to-cart custom-cart front_add_to_cart">Add to Cart</a>
							</div>
									</div>

			@endforeach
			@else
			<div class="product product-style-2 equal-elem ">
			<h3 class="title-box">No Producs Found</h3>
			</div>

			@endif

									
								</div>
							</div>							
						</div>
					</div>
				</div>
			</div>

			<!--Product Categories-->
			<div class="wrap-show-advance-info-box style-1">
				<h3 class="title-box">Product Categories</h3>
				<div class="wrap-top-banner">
					<a href="#" class="link-banner banner-effect-2">
						<figure><img src="{{ asset('assets/images/fashion-accesories-banner.jpg')}}" width="1170" height="240" alt=""></figure>
					</a>
				</div>
				<div class="wrap-products">
					<div class="wrap-product-tab tab-style-1">
						<div class="tab-control">
						<?php $k =1;?>
							@foreach( $categories as $category)
							<a href="#{{createAccordinCategory($category->cat_name)}}" class="tab-control-item <?php if($k==1) { echo 'active'; }?>">{{$category->cat_name}}</a>
							<?php $k++;?>
							@endforeach
						</div>
						<div class="tab-contents">

						<?php $j =1;?>
						@foreach( $categories as $category )
						<div class="tab-content-item <?php if($j==1) { echo 'active'; }?>" id="{{createAccordinCategory($category->cat_name)}}">
								<div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >


								@if( isset( $category->product[0] ) )

								@foreach( $category->product as $product )
									<div class="product product-style-2 equal-elem ">
										<div class="product-thumnail">
											<a href="{{url('product')}}/{{$product->pro_slug}}" title="{{ $product->product_title  }}">
												<figure><img class="cust_img_size" src="{{ asset('storage/admin_assets/products') }}/{{ $product->product_image }}" width="800" height="800" alt="{{ $product->product_title }}"></figure>
											</a>
											<div class="group-flash">
												<span class="flash-item new-label">new</span>
											</div>
											@if( $product->is_discounted == 1)
											<div class="group-flash">
												<span class="flash-item sale-label">sale</span>
											</div>
											@endif
											<div class="wrap-btn">
												<a href="#" class="function-link">quick view</a>
											</div>
										</div>
										<div class="product-info">
											<a href="{{url('product')}}/{{$product->pro_slug}}" class="product-name"><span>{{ substr( $product->product_title ,0,25)  }}...</span></a>

											@if(count($product->productAttributes) <= 1 )
											<input type="hidden" id="cat_prod_front_{{$product->productAttributes[0]->attr_id}}" value="{{$product->productAttributes[0]->attr_id}}">
							@foreach( $product->productAttributes as $attribute )
	
							@if( $product->is_discounted == 1)

							<div class="wrap-price"><ins><p class="product-price">${{$attribute->disc_price}}</p></ins> <del><p class="product-price">${{$attribute->reg_price}}</p></del></div>
						
							@else
							<div class="wrap-price"><ins><p class="product-price">${{$attribute->reg_price}}</p></ins></div>
							@endif
							@endforeach

							@else
							<input type="hidden" id="cat_prod_front_{{$product->productAttributes[0]->attr_id}}" value="{{$product->productAttributes[0]->attr_id}}">
								<?php echo getRangeproductPrice($product->productAttributes ,$product->is_discounted );?>
							@endif
										</div>
										<img src="{{asset('assets/images/loading.gif')}}" id="cat_loding_img_{{$product->product_id}}" style="width:80px;display:none;">
							<p id="cat_cart_msg_{{$product->product_id}}" style="font-size:12px;display:none;"></p>
										<div class="wrap-butons">
										<a href="javascript:void(0)" data-attrId="cat_prod_front_{{$product->productAttributes[0]->attr_id}}" data-prodId="{{$product->product_id}}" data-imageId="cat_loding_img_{{$product->product_id}}" data-messageId="cat_cart_msg_{{$product->product_id}}" class="btn add-to-cart custom-cart front_add_to_cart">Add to Cart</a>
							</div>
									</div>

									@endforeach

									@else
									<div class="product product-style-2 equal-elem ">
									<h3 class="title-box">No Products in {{$category->cat_name}} Category .</h3>
									</div>

									@endif

									

								</div>
							</div>
							<?php $j++;?>
							@endforeach

						</div>
					</div>
				</div>
			</div>			

		</div>

	</main>
	
  @endsection