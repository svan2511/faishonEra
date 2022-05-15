<?php //echo "<pre>"; print_r($product[0]->productAttributes);die;?>

@extends('front/master-layout')
  
  @section('main_content')

  <!--main area-->
	<main id="main" class="main-site">

		<div class="container">

			<div class="wrap-breadcrumb">
				<ul>
					<li class="item-link"><a href="#" class="link">home</a></li>
					<li class="item-link"><span>detail</span></li>
				</ul>
			</div>
			<div class="row">

				<div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">
					<div class="wrap-product-detail">
						<div class="detail-media">
							<div class="product-gallery">
							  <ul class="slides">

							 
							    <li id="after-change-image" data-thumb="{{ asset('storage/admin_assets/products') }}/{{ $product[0]->product_image }}">
							    	<img src="{{ asset('storage/admin_assets/products') }}/{{ $product[0]->product_image }}" alt="product thumbnail" />
							    </li>


								@foreach( $product[0]->productAttributes as $attribute )
							    <li data-thumb="{{ asset('storage/admin_assets/products/attr') }}/{{ $attribute->attr_image }}">
							    	<img src="{{ asset('storage/admin_assets/products/attr') }}/{{ $attribute->attr_image }}" alt="product thumbnail" />
							    </li>

							   @endforeach

							  </ul>
							</div>
						</div>
						<div class="detail-info">
							<div class="product-rating">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <a href="#" class="count-review">(05 review)</a>
                            </div>
                            <h2 class="product-name">{{ $product[0]->product_title }}</h2>
                            <div class="short-desc">
							{!! $product[0]->shrt_desc !!}
                            </div>
							<div class="widget mercado-widget filter-widget">
						<div class="widget-content">
							<ul class="list-style inline-round checked-size-value">

							@foreach( $pro_aatributes as $size)

								<li class="list-item pro-size-select" ><a data-attrId="{{$size->attr_id}}" data-size="{{$size->size_title}}" class="filter-link" href="javascript:void(0)">{{$size->size_title}}</a></li>
								
								@endforeach
							</ul>
							
							
						</div>
					</div>

								@foreach( $pro_aatributes as $color)
							<div class="form-check color_change_pro colors sizes_{{$color->size_title}}" >
								<input class="form-check-input check-my-input" type="radio" disabled data-image="{{ asset('storage/admin_assets/products/attr') }}/{{ $color->attr_image }}"  data-id="{{$color->color_id}}" <?php if( $color->disc_price == 0 ) { ?> data-price="{{$color->reg_price}}" <?php } else { ?> data-price="{{$color->disc_price}}" <?php } ?>>
								<label class="form-check-label" for="flexRadioDefault1">
									{{$color->color_name}}
								</label>
								</div>
								@endforeach

                            @if(count($product[0]->productAttributes) <= 1 )
							@foreach( $product[0]->productAttributes as $attribute )
							@if( $product[0]->is_discounted == 1)
							<div class="wrap-price after_changed_price" style="display:none;"><ins><p class="product-price" id="changed_price_pro"></p></div>
							<div class="wrap-price before_price_pro" ><ins><p class="product-price">${{$attribute->disc_price}}</p></ins> <del><p class="product-price">${{$attribute->reg_price}}</p></del></div>
								
							@else
							
							<div class="wrap-price after_changed_price" style="display:none;"><ins><p class="product-price" id="changed_price_pro"></p></div>
							<div class="wrap-price before_price_pro" ><ins><p class="product-price">${{$attribute->reg_price}}</p></ins></div>
							
							@endif
							
							
							@endforeach

							@else
							<div class="wrap-price after_changed_price" style="display:none;"><ins><p class="product-price" id="changed_price_pro"></p></div>
								<?php echo getRangeproductPrice($product[0]->productAttributes ,$product[0]->is_discounted);?>
							@endif
                            <div class="stock-info in-stock">
                                <p class="availability">Availability: <b>In Stock</b></p>
                            </div>
                            <div class="quantity">
                            	<span>Quantity:</span>
								<div class="quantity-input">
									<input type="text" id="product-quatity" name="product-quatity" value="1" data-max="120" pattern="[0-9]*" >
									
									<a class="btn btn-reduce" href="#"></a>
									<a class="btn btn-increase" href="#"></a>
								</div>
							</div>
							<div class="wrap-butons">
							<img src="{{asset('assets/images/loading.gif')}}" id="single_page_loding_img_{{$product[0]->product_id}}" style="width:120px;display:none;">
							<p id="single_page_cart_msg_{{$product[0]->product_id}}" style="font-size:18px;display:none;"></p>
								<form id="add_product">
									@csrf
									<input type="hidden" name="attr_id" id="attr_id">
									<input type="hidden" name="price_attr_id" id="price_attr_id">
									<input type="hidden" name="pro_qty" id="pro_qty">
									<input type="hidden" name="product_id" value="{{$product[0]->product_id}}">
									
								<a href="javascript:void(0)" data-imageId="single_page_loding_img_{{$product[0]->product_id}}" data-messageId="single_page_cart_msg_{{$product[0]->product_id}}" id="add-to-cart" class="btn add-to-cart" >Add to Cart</a>
								</form>
								
                            
              
                            
							</div>
						</div>
						<div class="advance-info">
							<div class="tab-control normal">
								<a href="#description" class="tab-control-item active">description</a>
								<a href="#add_infomation" class="tab-control-item">Technical Specification</a>
								<a href="#review" class="tab-control-item">Reviews</a>
							</div>
							<div class="tab-contents">
								<div class="tab-content-item active" id="description">
									<p>{!! $product[0]->full_desc !!}</p></div>
								<div class="tab-content-item " id="add_infomation">
								<p>{!! $product[0]->tech_spec !!}</p>
								</div>
								<div class="tab-content-item " id="review">
									
									<div class="wrap-review-form">
										
										<div id="comments">
											<h2 class="woocommerce-Reviews-title">01 review for <span>Radiant-360 R6 Chainsaw Omnidirectional [Orage]</span></h2>
											<ol class="commentlist">
												<li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1" id="li-comment-20">
													<div id="comment-20" class="comment_container"> 
														<img alt="" src="{{asset('assets/images/author-avata.jpg')}}" height="80" width="80">
														<div class="comment-text">
															<div class="star-rating">
																<span class="width-80-percent">Rated <strong class="rating">5</strong> out of 5</span>
															</div>
															<p class="meta"> 
																<strong class="woocommerce-review__author">admin</strong> 
																<span class="woocommerce-review__dash">–</span>
																<time class="woocommerce-review__published-date" datetime="2008-02-14 20:00" >Tue, Aug 15,  2017</time>
															</p>
															<div class="description">
																<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
															</div>
														</div>
													</div>
												</li>
											</ol>
										</div><!-- #comments -->

										<div id="review_form_wrapper">
											<div id="review_form">
												<div id="respond" class="comment-respond"> 

													<form action="#" method="post" id="commentform" class="comment-form" novalidate="">
														<p class="comment-notes">
															<span id="email-notes">Your email address will not be published.</span> Required fields are marked <span class="required">*</span>
														</p>
														<div class="comment-form-rating">
															<span>Your rating</span>
															<p class="stars">
																
																<label for="rated-1"></label>
																<input type="radio" id="rated-1" name="rating" value="1">
																<label for="rated-2"></label>
																<input type="radio" id="rated-2" name="rating" value="2">
																<label for="rated-3"></label>
																<input type="radio" id="rated-3" name="rating" value="3">
																<label for="rated-4"></label>
																<input type="radio" id="rated-4" name="rating" value="4">
																<label for="rated-5"></label>
																<input type="radio" id="rated-5" name="rating" value="5" checked="checked">
															</p>
														</div>
														<p class="comment-form-author">
															<label for="author">Name <span class="required">*</span></label> 
															<input id="author" name="author" type="text" value="">
														</p>
														<p class="comment-form-email">
															<label for="email">Email <span class="required">*</span></label> 
															<input id="email" name="email" type="email" value="" >
														</p>
														<p class="comment-form-comment">
															<label for="comment">Your review <span class="required">*</span>
															</label>
															<textarea id="comment" name="comment" cols="45" rows="8"></textarea>
														</p>
														<p class="form-submit">
															<input name="submit" type="submit" id="submit" class="submit" value="Submit">
														</p>
													</form>

												</div><!-- .comment-respond-->
											</div><!-- #review_form -->
										</div><!-- #review_form_wrapper -->

									</div>
								</div>
							</div>
						</div>
					</div>
				</div><!--end main products area-->

				<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
					<div class="widget widget-our-services ">
						<div class="widget-content">
							<ul class="our-services">

								<li class="service">
									<a class="link-to-service" href="#">
										<i class="fa fa-truck" aria-hidden="true"></i>
										<div class="right-content">
											<b class="title">Free Shipping</b>
											<span class="subtitle">On Oder Over $99</span>
											<p class="desc">Lorem Ipsum is simply dummy text of the printing...</p>
										</div>
									</a>
								</li>

								<li class="service">
									<a class="link-to-service" href="#">
										<i class="fa fa-gift" aria-hidden="true"></i>
										<div class="right-content">
											<b class="title">Special Offer</b>
											<span class="subtitle">Get a gift!</span>
											<p class="desc">Lorem Ipsum is simply dummy text of the printing...</p>
										</div>
									</a>
								</li>

								<li class="service">
									<a class="link-to-service" href="#">
										<i class="fa fa-reply" aria-hidden="true"></i>
										<div class="right-content">
											<b class="title">Order Return</b>
											<span class="subtitle">Return within 7 days</span>
											<p class="desc">Lorem Ipsum is simply dummy text of the printing...</p>
										</div>
									</a>
								</li>
							</ul>
						</div>
					</div><!-- Categories widget-->

					<!-- <div class="widget mercado-widget widget-product">
						<h2 class="widget-title">Popular Products</h2>
						<div class="widget-content">
							<ul class="products">
								<li class="product-item">
									<div class="product product-widget-style">
										<div class="thumbnnail">
											<a href="detail.html" title="Radiant-360 R6 Wireless">
												<figure><img src="{{asset('assets/images/products/digital_01.jpg')}}" alt=""></figure>
											</a>
										</div>
										<div class="product-info">
											<a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker...</span></a>
											<div class="wrap-price"><span class="product-price">$168.00</span></div>
										</div>
									</div>
								</li>

								<li class="product-item">
									<div class="product product-widget-style">
										<div class="thumbnnail">
											<a href="detail.html" title="Radiant-360 R6 Wireless">
												<figure><img src="{{asset('assets/images/products/digital_17.jpg')}}" alt=""></figure>
											</a>
										</div>
										<div class="product-info">
											<a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker...</span></a>
											<div class="wrap-price"><span class="product-price">$168.00</span></div>
										</div>
									</div>
								</li>

								<li class="product-item">
									<div class="product product-widget-style">
										<div class="thumbnnail">
											<a href="detail.html" title="Radiant-360 R6 Wireless">
												<figure><img src="{{asset('assets/images/products/digital_18.jpg')}}" alt=""></figure>
											</a>
										</div>
										<div class="product-info">
											<a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker...</span></a>
											<div class="wrap-price"><span class="product-price">$168.00</span></div>
										</div>
									</div>
								</li>

								<li class="product-item">
									<div class="product product-widget-style">
										<div class="thumbnnail">
											<a href="detail.html" title="Radiant-360 R6 Wireless">
												<figure><img src="{{asset('assets/images/products/digital_20.jpg')}}" alt=""></figure>
											</a>
										</div>
										<div class="product-info">
											<a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker...</span></a>
											<div class="wrap-price"><span class="product-price">$168.00</span></div>
										</div>
									</div>
								</li>

							</ul>
						</div>
					</div> -->

				</div><!--end sitebar-->

				<div class="single-advance-box col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="wrap-show-advance-info-box style-1 box-in-site">
						<h3 class="title-box">Related Products</h3>
						<div class="wrap-products">
							<div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}' >
							

							@if( isset($relatedProducts[0]->product[0] ) )
							@foreach( $relatedProducts[0]->product as $product )
								<div class="product product-style-2 equal-elem ">
									<div class="product-thumnail">
										<a href="{{url('product')}}/{{$product->pro_slug}}" title="{{$product->product_title}}">
											<figure><img class="cust_img_size_single" src="{{asset('storage/admin_assets/products')}}/{{$product->product_image}}" width="800" height="800" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
										</a>
										<div class="group-flash">
											<span class="flash-item new-label">new</span>
										</div>
										<div class="wrap-btn">
											<a href="{{url('product')}}/{{$product->pro_slug}}" class="function-link">quick view</a>
										</div>
									</div>
									<div class="product-info">
										<a href="{{url('product')}}/{{$product->pro_slug}}" class="product-name"><span>{{ substr( $product->product_title ,0,20)  }}...</span></a>
										@if(count($product->productAttributes) <= 1 )
										<input type="hidden" id="relates_prod_front_{{$product->productAttributes[0]->attr_id}}" value="{{$product->productAttributes[0]->attr_id}}">
							@foreach( $product->productAttributes as $attribute )
	
							<div class="wrap-price"><ins><p class="product-price">${{$attribute->disc_price}}</p></ins> <del><p class="product-price">${{$attribute->reg_price}}</p></del></div>
							@endforeach

							@else
							<input type="hidden" id="relates_prod_front_{{$product->productAttributes[0]->attr_id}}" value="{{$product->productAttributes[0]->attr_id}}">
								<?php echo getRangeproductPrice($product->productAttributes , $product->is_discounted);?>
							@endif
									</div>
									<img src="{{asset('assets/images/loading.gif')}}" id="relates_loding_img_{{$product->product_id}}" style="width:80px;display:none;">
							<p id="relates_cart_msg_{{$product->product_id}}" style="font-size:12px;display:none;"></p>
									<div class="wrap-butons">
									<a href="javascript:void(0)" data-attrId="relates_prod_front_{{$product->productAttributes[0]->attr_id}}" data-prodId="{{$product->product_id}}" data-imageId="relates_loding_img_{{$product->product_id}}" data-messageId="relates_cart_msg_{{$product->product_id}}" class="btn add-to-cart custom-cart front_add_to_cart">Add to Cart</a>
							</div>
								</div>

								@endforeach

								@else
								<div class="product product-style-2 equal-elem ">
								<h3 class="title-box">No Related Products</h3>
								</div>

								@endif



							</div>
						</div><!--End wrap-products-->
					</div>
				</div>
			</div><!--end row-->

		</div><!--end container-->

	</main>
	<style>
.custom-cart{
    display: block;
    background-color: #ECEBE8;
    font-size: 14px;
    line-height: 34px;
    font-weight: 600;
    color: #666666;
    border: 1px solid #e6e6e6;
    border-radius: 0;
    padding: 4.5px 10px;
    text-align: center;
}
a.btn.add-to-cart.custom-cart:hover {
    background: #FF2832;
    color: white;
}
</style>
  @endsection