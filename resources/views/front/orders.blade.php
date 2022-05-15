@extends('front/master-layout')
  
  @section('main_content')

  <main id="main" class="main-site" >
  <div class="container">
  <h3 style="margin-top: 50px;">Your Orders Details </h3>
  <ul class="nav nav-tabs" style="margin-top: 50px;">
  <?php $i=1; ?>
  @foreach( $total_orders['orders'] as $order )

    <li <?php if($i==1){ ?> class="active" <?php } ?> ><a data-toggle="tab" href="#ORD_{{$order->order_id}}">ORDER - {{$i}}</a></li>
    <?php $i++; ?>
	@endforeach
  </ul>

  <div class="tab-content" style="margin-bottom: 50px;">
  <?php $j=1;?>
  @foreach( $total_orders['orders'] as $order )
 
    <div id="ORD_{{$order->order_id}}" class="tab-pane fade <?php if($j==1) {?> in active<?php }?>">
      <div class="tab-content-item " id="add_infomation">

	  @foreach( $total_orders['product_details'][$order->order_id] as $details )
	  <table class="shop_attributes">
										<tbody>
											<tr>
												<th>Product Image</th>
												<td class="product_weight"><img src="{{ asset('storage/admin_assets/products/attr') }}/{{$details->attr_image}}" width="100">
												</td>
											</tr>
											<tr>
												<th>Product Title</th><td class="product_dimensions">{{$details->product_title}}</td>
											</tr>
											<tr>
												<th>Color / Size </th><td><p>{{getColor($details->color_id)}} / {{getSize($details->size_id)}}</p></td>
											</tr>
											<tr>
												<th>Product Price</th>
												@if( $details->is_discounted == 1)

												<td class="product_dimensions">{{$details->quantity}} x {{$details->disc_price}}</td>

												@else
												<td class="product_dimensions">{{$details->quantity}} x {{$details->reg_price}}</td>
												@endif

											</tr>
											
										</tbody>
									</table><br>
									<?php $j++;?>
									@endforeach


								</div>
								<table class="shop_attributes">
										<tbody>
										@if( $order->used_coupon_code !=null )
											<tr>
												<th>Used Coupon Code</th>
											
												<td class="product_weight">{{$order->used_coupon_code}}</td>
												</tr>
												@endif
										<tr>
												<th>Total Amount Paid </th>
											
												<td class="product_weight">${{$order->order_total_amount}}</td>

												</tr>
										@if( $order->transaction_id !=null && $order->payment_status =="Credit"  )
											<tr>
												<th>Payment Method / Payment Status / Payment Id</th>
											
												<td class="product_weight">ONLINE / PAID / {{$order->payment_id}}</td>
												</tr>
												@else

												<tr><th>Payment Method / Payment Status / Payment Id</th><td class="product_weight">CASH ON DELEVIERY  / UNPAID / NA</td></tr>
												@endif
											
												@if( $order->transaction_id !=null && $order->payment_status =="Credit"  )
											<tr>
											
											<th>Transaction Id</th>	<td class="product_weight">{{$order->transaction_id}}</td>
												</tr>
												@endif
										
											<tr>
												<th>Order Placed </th><td><p>{{date('Y-m-d',strtotime($order->placed_on)) }}</p></td>
											</tr>
											
										</tbody>
									</table>
    </div>
	@endforeach



    

  </div>
</div>


	</main>


  @endsection