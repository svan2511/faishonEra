@extends('front/master-layout')
  
  @section('main_content')

  <main id="main" class="main-site left-sidebar">

		<div class="container">

			<div class="wrap-breadcrumb">
				<ul>
					<li class="item-link"><a href="/" class="link">Home</a></li>
					<li class="item-link"><span>Digital & Electronics</span></li>
				</ul>
			</div>
			<div class="row">

				<div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">

					<!-- <div class="banner-shop">
						<a href="#" class="banner-link">
							<figure><img src="{{ asset('assets/images/shop-banner.jpg')}}" alt=""></figure>
						</a>
					</div> -->

					<!-- <div class="wrap-shop-control">

						<h1 class="shop-title">Digital & Electronics</h1>

						<div class="wrap-right">

							<div class="sort-item orderby ">
								<select name="orderby" class="use-chosen" >
									<option value="menu_order" selected="selected">Default sorting</option>
									<option value="popularity">Sort by popularity</option>
									<option value="rating">Sort by average rating</option>
									<option value="date">Sort by newness</option>
									<option value="price">Sort by price: low to high</option>
									<option value="price-desc">Sort by price: high to low</option>
								</select>
							</div>

							<div class="sort-item product-per-page">
								<select name="post-per-page" class="use-chosen" >
									<option value="12" selected="selected">12 per page</option>
									<option value="16">16 per page</option>
									<option value="18">18 per page</option>
									<option value="21">21 per page</option>
									<option value="24">24 per page</option>
									<option value="30">30 per page</option>
									<option value="32">32 per page</option>
								</select>
							</div>

							<div class="change-display-mode">
								<a href="#" class="grid-mode display-mode active"><i class="fa fa-th"></i>Grid</a>
								<a href="list.html" class="list-mode display-mode"><i class="fa fa-th-list"></i>List</a>
							</div>

						</div>

					</div>end wrap shop control -->

					<div class="row">
					@if( isset($data['allProducts'][0]) )
						<ul class="product-list grid-products equal-container load-ul-data">

						
						@foreach( $data['allProducts'] as $product )

							<li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
									@if( $product->is_discounted == 1)
									<span class="my-index">sale</span>
								@endif
								<div class="product product-style-3 equal-elem ">
									<div class="product-thumnail">
										<a href="{{url('product')}}/{{$product->pro_slug}}" title="{{$product->product_title}}">
											<figure><img class="cust_img_size src" src="{{ asset('storage/admin_assets/products') }}/{{ $product->product_image }}" alt="{{$product->product_title}}"></figure>
										</a>
									</div>
									
									<div class="product-info">
										<a href="{{url('product')}}/{{$product->pro_slug}}" class="product-name"><span>{{ substr( $product->product_title ,0,25)  }}...</span></a>
										@if(count($data['all_products_attr'][$product->product_id]) <= 1 )
										<input type="hidden" id="shop_prod_front_{{$data['all_products_attr'][$product->product_id][0]->attr_id}}" value="{{$data['all_products_attr'][$product->product_id][0]->attr_id}}">
							@foreach( $data['all_products_attr'][$product->product_id] as $attribute )
	
							@if( $product->is_discounted == 1)

							<div class="wrap-price"><ins><p class="product-price">${{$attribute->disc_price}}</p></ins> <del><p class="product-price">${{$attribute->reg_price}}</p></del></div>
						
							@else
							<div class="wrap-price"><ins><p class="product-price">${{$attribute->reg_price}}</p></ins></div>
							@endif
							
							@endforeach 

							@else
							<input type="hidden" id="shop_prod_front_{{$data['all_products_attr'][$product->product_id][0]->attr_id}}" value="{{$data['all_products_attr'][$product->product_id][0]->attr_id}}">
							
								<?php echo getRangeproductPrice($data['all_products_attr'][$product->product_id] , $product->is_discounted);?>
							@endif
							
							<img src="{{asset('assets/images/loading.gif')}}" id="shop_loading_img_{{$product->product_id}}" style="width:80px;display:none;">
							<p id="shop_cart_msg_{{$product->product_id}}" style="font-size:12px;display:none;"></p>
										<div class="wrap-butons">
										<a href="javascript:void(0)" data-attrId="shop_prod_front_{{$data['all_products_attr'][$product->product_id][0]->attr_id}}" data-prodId="{{$product->product_id}}" data-imageId="shop_loading_img_{{$product->product_id}}" data-messageId="shop_cart_msg_{{$product->product_id}}" class="btn add-to-cart custom-cart front_add_to_cart">Add to Cart</a>
							</div>
									</div>
								</div>
							</li>

							@endforeach
							

						</ul>
						@else
						<div class="row">
						<div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">
						<h3>Sorry No Products Found .</h3>
						</div>
					</div>
						@endif
						<inptut type="hidden" id="last_page" value="{{$last_page}}">
					</div>
					<div class="row" style="margin-top:70px;">
					@if(count($data['allProducts']) > 9)
					<div class="load-center">
					<a href="javascript:void(0)" class="btn btn-primary loading-more">LOAD MORE</a>
					</div>
					@endif
					</div>
					
					
					
				</div><!--end main products area-->

				<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
					<div class="widget mercado-widget categories-widget">
						<h2 class="widget-title">All Categories</h2>
						<div class="widget-content">
							<ul class="list-category">

							@foreach( $categories as $category )
								<li class="category-item has-child-cate<?php if(app('request')->input('cat_filter') == $category->cat_id) { echo " open"; }?>">
									<a data-Id="nothing" href="javascript:void(0)" class="cate-link">{{$category->cat_name}}</a>
									<span data-Id="nothing" class="toggle-control">+</span>
									<ul class="sub-cate">
									@foreach( $category->subCategory as $subcategory )

										<li class="category-item"><a  class="cate-link<?php if(app('request')->input('subcat_filter') == $subcategory->subcat_id) { echo " selected-product-active"; }?>" data-itemId="catFilter" data-catId="{{$category->cat_id}}" data-subcatId="{{$subcategory->subcat_id}}" href="javascript:void(0)" >{{$subcategory->subcat_name}}</a></li>
										@endforeach
									</ul>
								</li>

								@endforeach
								
							</ul>
						</div>
					</div><!-- Categories widget-->

					<div class="widget mercado-widget filter-widget brand-widget">
						<h2 class="widget-title">Brand</h2>
						<div class="widget-content">
							<ul class="sub-cate" data-show="6">
								@foreach( $brands as $brand )
								<li class="category-item"><a  data-itemId="brandFilter" data-brandFilter="{{$brand->brand_id}}" class="cate-link<?php if(app('request')->input('brand_filter') == $brand ->brand_id) { echo " selected-product-active"; }?>" href="javascript:void(0)">{{$brand->brand_name}}</a></li>
								@endforeach
							</ul>
						</div>
					</div><!-- brand widget-->

					<div class="widget mercado-widget filter-widget price-filter" data-Id="nothing">
						<h2 class="widget-title" data-Id="nothing">Price</h2>
						<div class="widget-content" data-Id="nothing">
							<div id="slider-range" data-Id="nothing"></div>
							<p>
								<label for="amount" data-Id="nothing">Price:</label>
								<input type="text" data-Id="nothing" id="amount" readonly>
								
							</p><a data-itemId="priceFilter" href="javascript:void(0)" class="btn btn-success">Filter</a>
						</div>
					</div><!-- Price-->

					<div class="widget mercado-widget filter-widget">
						<h2 class="widget-title">Color</h2>
						<div class="widget-content">
							<ul class="">
								@foreach( $colors as $color )
								<li class="list-item"><a data-itemId="colorFilter" data-colorFilter="{{$color->color_id}}" class="<?php if(app('request')->input('color_filter') == $color ->color_id) { echo " selected-product-active"; }?>" href="javascript:void(0)">{{$color->color_name}}</a></li>
								@endforeach
							</ul>
						</div>
					</div><!-- Color -->

					<div class="widget mercado-widget filter-widget">
						<h2 class="widget-title">Size</h2>
						<div class="widget-content">
							<ul class="list-style inline-round ">
								@foreach( $sizes as $size )
								<li class="list-item"><a data-itemId="sizeFilter" data-sizeFilter="{{$size->size_id}}" class="<?php if(app('request')->input('size_filter') == $size ->size_id) { echo " selected-product-active"; }?>" href="javascript:void(0)">{{$size->size_title}}</a></li>
								@endforeach
							</ul>
							<div class="widget-banner">
								
							</div>
						</div>
					</div><!-- Size -->

					<!-- brand widget-->

				</div><!--end sitebar-->

			</div><!--end row-->
			<form id="side_hidden">
			<input type="hidden" name="cat_filter" value="{{app('request')->input('cat_filter')}}" id="catFiler">
			<input type="hidden" name="subcat_filter" value="{{app('request')->input('subcat_filter')}}" id="subcatFilter">
			<input type="hidden" name="brand_filter" value="{{app('request')->input('brand_filter')}}" id="brandFilter">
			<input type="hidden" name="color_filter" value="{{app('request')->input('color_filter')}}" id="colorFilter">
			<input type="hidden" name="size_filter" value="{{app('request')->input('size_filter')}}" id="sizeFilter">
			<input type="hidden" name="min_price" value="{{app('request')->input('min_price')}}" id="min_price">
			<input type="hidden" name="max_price" value="{{app('request')->input('max_price')}}" id="max_price">
			</form>

		</div><!--end container-->

	</main>
	<script>
		<?php if(app('request')->input('min_price') > 0 && app('request')->input('max_price') > 0 ) { ?>
var price_start = <?php echo app('request')->input('min_price'); ?>;
var price_end = <?php echo app('request')->input('max_price'); ?>;
<?php } else { ?>
	var price_start = 300;
var price_end = 600;
	<?php } ?>
		</script>
	
<style>
	
span.my-index {
    color: #ffffff;
    background: red;
    padding: 2px 9px 2px 9px;
	border-radius: 20px;
	margin-left: 100px;
}


   
	</style>

  @endsection