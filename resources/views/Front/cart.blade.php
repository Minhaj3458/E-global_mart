@extends('layouts.web')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.cart') }}
@endsection

@section('content')
	<!-- =========================== Breadcrumbs =================================== -->
	<div class="brd_wraps pt-2 pb-2">
		<div class="container">
			<nav aria-label="breadcrumb" class="simple_breadcrumbs">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#"><i class="ti-home"></i></a></li>
				<li class="breadcrumb-item active" aria-current="page">{{ trans('labels.cart') }}</li>
			  </ol>
			</nav>
		</div>
	</div>
	<!-- =========================== Breadcrumbs =================================== -->

	<!-- =========================== Cart =================================== -->
	<section>
		<div class="container">
			@if (count($cart) <= 0)
			    <div class="col-lg-12 col-md-12 text-center">
			    	<img src="{{Helper::image_path('no-data.png')}}">
			    	@if(Auth::user())
			    		<h2 class="error_title mt-4">{{ trans('labels.empty_cart') }}</h2>
			    		<p><span class="text-primary">{{trans('labels.woops')}}</span> {{ trans('labels.empty_cart_text') }}</p>
			    		<a href="{{URL::to('/')}}" class="btn btn-primary">{{ trans('labels.shop_now') }}</a>
			    	@else
			    		<h2 class="error_title mt-4">{{ trans('labels.please_login') }}</h2>
			    		<p>{{ trans('labels.please_login_text') }}</p>
			    		<a href="{{URL::to('/signin')}}" class="btn btn-primary">{{ trans('labels.login') }}</a>
			    	@endif
			    </div>
			@else 

				@if(Storage::disk('local')->has("promo"))
					@php
						$promo = json_decode(Storage::disk('local')->get("promo"), true);
					@endphp
				@endif

				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th scope="col" class="text-center">{{ trans('labels.product') }}</th>
										<th scope="col" class="text-center">{{ trans('labels.qty') }}</th>
										<th scope="col" class="text-center">{{ trans('labels.item_total') }}</th>
										<th scope="col" class="text-center">{{ trans('labels.tax') }}</th>
										<th scope="col" class="text-center">{{ trans('labels.shipping') }}</th>
										<th scope="col" class="text-center">{{ trans('labels.ttl') }}</th>
										<th scope="col" class="text-center">{{ trans('labels.action') }}</th>
									</tr>
								</thead>
								<tbody>
									@php $final_sub_total = 0; $final_grand_total=0; @endphp
									@foreach ($cart as $cartitems)
									<tr>
										<td>
											<div class="tbl_cart_product">
												<div class="tbl_cart_product_thumb">
													<img src="{{$cartitems->image_url}}" class="img-fluid" alt="" />
												</div>
												<div class="tbl_cart_product_caption">
													<h5 class="tbl_pr_title"><a href="{{URL::to('products/product-details/'.$cartitems->slug)}}"> {{$cartitems->product_name}} </a></h5>
													@if ($cartitems->attribute != "")
													<span class="tbl_pr_quality theme-cl">{{$cartitems->attribute}} : {{$cartitems->variation}}</span>
													@endif
													<br>
													<span class="tbl_pr_quality theme-cl">
														Price : {{Helper::CurrencyFormatter($cartitems->price)}}
													</span>
												</div>
											</div>
										</td>
										<td>
											<div class="pro-add">
												<div class="value-button sub" id="decrease" onclick="qtyupdate('{{$cartitems->id}}','decreaseValue')" value="Decrease Value">
			                                        <i class="fa fa-minus-circle"></i>
			                                    </div>
												<input type="number" id="number_{{$cartitems->id}}" name="number" value="{{$cartitems->qty}}" readonly="" min="1" max="10" />
												<div class="value-button add" id="increase" onclick="qtyupdate('{{$cartitems->id}}','increase')" value="Increase Value">
												    <i class="fa fa-plus-circle"></i>
												</div>
											</div>
										</td>
										<td>
											<h4 class="tbl_org_price">
												@php $ttl = $cartitems->price*$cartitems->qty; $final_sub_total += $ttl; @endphp
												{{Helper::CurrencyFormatter($cartitems->price*$cartitems->qty)}}
											</h4>
										</td>
										<td>
											<h4 class="tbl_org_price">
												@php 
										    		$tax = ($cartitems->tax*$cartitems->qty);
										    	@endphp
												{{Helper::CurrencyFormatter($tax)}}
											</h4>
										</td>
										<td>
											<h4 class="tbl_org_price">
												@php 
										    		$shipping_cost = ($cartitems->shipping_cost);
										    	@endphp
												{{Helper::CurrencyFormatter($shipping_cost)}}
											</h4>
										</td>
										<td>
											<h4 class="tbl_org_price">
												@php $sub_total = $ttl+$tax+$shipping_cost;@endphp
												{{Helper::CurrencyFormatter($ttl+$tax+$shipping_cost)}}
											</h4>
										</td>
										<td>
											<div class="tbl_pr_action">
												<a href="#" class="tbl_remove" onclick="DeleteItem('{{$cartitems->id}}','1')"><i class="fa fa-trash"></i></a>
											</div>
										</td>
									</tr>

									<?php

									$data[] = array(
									    "sub_total" => $ttl,
									    "tax" => $tax,
									    "shipping_cost" => $shipping_cost,
									    "grand_total" => $sub_total,
									);
									$sub_total = array_sum(array_column(@$data, 'sub_total'));
									$tax = array_sum(array_column(@$data, 'tax'));
									$shipping_cost = array_sum(array_column(@$data, 'shipping_cost'));
									$grand_total = array_sum(array_column(@$data, 'grand_total'));
									?>
									@endforeach
									
								</tbody>
							</table>
							<input type="hidden" name="final_sub_total" id="final_sub_total" value="{{$sub_total}}">

							@if(Storage::disk('local')->has("promo"))
								@if (@$promo['type'] == "1")
									@if ($sub_total > @$promo['min_amount'])
										@php $dis_amount = @$promo['amount']; @endphp
									@else
										@php $dis_amount = "0"; @endphp
									@endif
								@endif

								@if (@$promo['type'] == "0")
									@if ($sub_total > @$promo['min_amount'])
										@php $dis_amount = $sub_total*@$promo['percentage']/100; @endphp
									@else
										@php $dis_amount = "0"; @endphp
									@endif
								@endif
							@else
								@php $dis_amount = "0"; @endphp
							@endif
							@php Storage::disk('local')->put("dis_amount", $dis_amount); @endphp

							<div class="col-md-4 col-12 float-right">
								<ul class="list-group list-group-flush">
			                        <li class="list-group-item">{{trans('labels.sub_total')}} <span class="float-right">{{Helper::CurrencyFormatter($sub_total)}}</span></li>
									<li class="list-group-item">{{trans('labels.tax')}} <span class="float-right">{{Helper::CurrencyFormatter($tax)}}</span></li>
									<li class="list-group-item">{{trans('labels.shipping')}} <span class="float-right">{{Helper::CurrencyFormatter($shipping_cost)}}</span></li>
			                        <li class="list-group-item">{{trans('labels.discount')}} <span class="float-right">- {{Helper::CurrencyFormatter($dis_amount)}}</span></li>

									@if(Storage::disk('local')->has("promo"))
			                        	<li class="list-group-item"><strong>{{trans('labels.grand_total')}} <span class="float-right">{{Helper::CurrencyFormatter($grand_total-$dis_amount)}}</span></strong></li>
									@else
										<li class="list-group-item"><strong>{{trans('labels.grand_total')}} <span class="float-right">{{Helper::CurrencyFormatter($grand_total)}}</span></strong></li>
									@endif
									@php Storage::disk('local')->put("grand_total", $grand_total); @endphp
			                    </ul>
			                </div>
						</div>
						

						<!-- Coupon Box -->
						<div class="row align-items-end justify-content-between mb-10 mb-md-0">
							<div class="col-12 col-md-6">

								<!-- Coupon -->
								<form class="mb-7 mb-md-0">
									<div class="col">
										<label class="font-size-sm font-weight-bold">{{ trans('labels.coupon_code') }}</label>
									</div>
									<div class="row form-row">
										<div class="col">
											<input class="form-control form-control-sm" type="text" @if (@$promo['coupon_name'] != "") value="{{@$promo['coupon_name']}}" readonly="" @endif name="coupon_name" id="coupon_name" placeholder="{{ trans('labels.coupon_code') }}">
										</div>
										<div class="col-auto">
											<!-- Button -->
											@if (@$promo['coupon_name'] == "")
												<button class="btn btn-dark" type="button" onclick="applypromo()">{{ trans('labels.apply') }}</button>
											@else
												<button class="btn btn-dark" type="button" onclick="removepromo()">{{ trans('labels.remove') }}</button>
											@endif
										</div>
									</div>
								</form>

							</div>

							<div class="col-12 col-md-12 col-lg-4">
								<a class="btn btn-dark col-lg-12" href="{{URL::to('checkout')}}">{{ trans('labels.proceed_checkout') }}</a>
							</div>
							
						</div>
						<!-- Coupon Box -->
						
					</div>
					
				</div>
			@endif
		</div>
	</section>
	<!-- =========================== Cart =================================== -->

@endsection

@section('scripttop')
<script type="text/javascript">
	function applypromo() {
		var coupon_name=$("#coupon_name").val();
		var final_sub_total=$("#final_sub_total").val();
		$.ajax({
		    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		    url:"{{ URL::to('cart/applypromocode') }}",
		    data: {coupon_name : coupon_name,final_sub_total:final_sub_total}, 
		    method: 'POST',
		    success: function(response) {
		        if (response.status == 1) {
		        	localStorage.setItem("message",response.message)
		            location.reload();
		        } else {
		            toast.error(response.message);
		        }
		    },
		    error: function(error) {
		    	toast.error("Something went wrong");
		    }
		});
	}

	function removepromo() {
		var coupon_name=$("#coupon_name").val();
		$.ajax({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
		    url:"{{ URL::to('cart/removepromocode') }}",
		    data: {
		        coupon_name : coupon_name,
		    }, 
		    method: 'POST',
		    success: function(response) {
		        if (response.status == 1) {
		        	localStorage.setItem("message",response.message)
		            location.reload();
		        } else {
		            toast.error(response.message);
		        }
		    },
		    error: function(error) {
		    	toast.error("Something went wrong");
		    }
		});
	}
</script>
@endsection