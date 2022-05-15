@extends('front/master-layout')
  
  @section('main_content')

  <main id="main" class="main-site">

		<div class="container">

			<div class="wrap-breadcrumb custm_ul" id="ul_div">
				
			</div>
			<div class=" main-content-area">
				<div class="wrap-address-billing">
					<h3 class="box-title">Billing Address</h3>
					<form action="#" method="get" name="frm-billing" id="pl_ord">
						@csrf
						<p class="row-in-form">
							<label for="name">Name<span>*</span></label>
							<input id="name" type="text" name="name" value="@if(!empty($user->name)){{$user->name}}@endif" placeholder="Your name">
						
						</p>
						
						
						<p class="row-in-form">
							<label for="email">Email Addreess:</label>
							<input id="email" type="email" name="email" value="@if(!empty($user->email)){{$user->email}}@endif" placeholder="Type your email">
				
						</p>
						
						<p class="row-in-form">
							<label for="phone">Phone number<span>*</span></label>
							<input id="phone" type="text" name="phone" value="" placeholder="10 digits format">
							
						</p>
						
						
						<p class="row-in-form">
							<label for="country">Country<span>*</span></label>
							<input id="country" type="text" name="country" value="" placeholder="Enter Country">
						
						</p>
						
						<p class="row-in-form">
							<label for="zipcode">Postcode / ZIP:</label>
							<input id="zipcode" type="number" name="zipcode" value="" placeholder="Your postal code">
							
						</p>
					
						<p class="row-in-form">
							<label for="city">Town / City<span>*</span></label>
							<input id="city" type="text" name="city" value="" placeholder="City name">
							
						</p>
						
						<p class="row-in-form">
							<label for="address">Address:</label>
							<input id="address" type="text" name="address" value="" placeholder="Street at apartment number">
							
						</p>
						
						<input type="hidden" name="payment_type" id="p_m">
						<input type="hidden" id="grand_total" name="grand_total" value="{{$total + $total_tax }}">
						<input type="hidden" id="t_grand_total" name="t_grand_total" value="{{$total + $total_tax }}">
						<input type="hidden" name="coupon_code" id="coupon_code">
					</form>
				</div>
				<div class="summary summary-checkout">
				<div class="summary-item shipping-method">
						<h4 class="title-box f-title">Order Details</h4>
						
						<p class="summary-info grand-total"><span>Total : </span> <span class=""> ${{$total}}</span></p>
						<p class="summary-info grand-total"><span>Tax : </span> <span class="">${{$total_tax}}</span></p>
						<p class="summary-info grand-total disc_price" style="display:none;"><span>Discount : </span> <span class=""></span></p>
						<p class="summary-info grand-total"><span>Grand Total : </span> <span class="g_t">${{$total + $total_tax }}</span></p>
						<h4 class="title-box">Discount Coupon</h4>
						<p class="row-in-form">
							<label for="coupon-code">Enter Your Coupon code:</label>
							<input id="coupon-code" type="text" name="coupon-code" value="" placeholder="Ex : APJSHUTS">
							<a href="javascript:void(0)" class="rm_but" style="display:none;">Remove</a>
						</p>
						 <h5 id="C_C_R"></h5>
							
						<a href="javascript:void(0)" data-textId="coupon-code" id="couponcode" class="btn btn-small">Apply</a>
						<img src="{{asset('assets/images/loading.gif')}}" id="coupon_load_img" style="width:120px;display:none">
					</div>
					<div class="summary-item payment-method">
						<h4 class="title-box">Payment Method</h4>
						
						<div class="choose-payment-methods">
							<label class="payment-method">
								<input name="payment-method" class="p_m" onclick="$('#p_m').val($(this).val())" id="payment-method-bank" value="COD" type="radio">
								<span>Cash On Delivery</span>
								<span class="payment-desc">But the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable</span>
							</label>
							<label class="payment-method">
								<input name="payment-method" class="p_m" onclick="$('#p_m').val($(this).val())" id="payment-method-visa" value="ONLINE" type="radio">
								<span>Pay Online</span>
								<span class="payment-desc">There are many variations of passages of Lorem Ipsum available</span>
							</label><br>
							<h5 id="O_P_S" style="color:green;"></h5>
							<img src="{{asset('assets/images/loading.gif')}}" id="checkout_load_img" style="width:120px;display:none;">
						</div>
						
						<a href="javascript:void(0)" id="placed_order" class="btn btn-medium">Place order now</a>
						
					</div>
					
				</div>

				

			</div><!--end main content area-->
		</div><!--end container-->

	</main>


  @endsection