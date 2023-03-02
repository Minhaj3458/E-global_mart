@extends('layouts.web')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.product_details') }}
@endsection

@section('content')
	<!-- =========================== Breadcrumbs =================================== -->
	<div class="brd_wraps pt-2 pb-2">
		<div class="container">
			<nav aria-label="breadcrumb" class="simple_breadcrumbs">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#"><i class="ti-home"></i></a></li>
				<li class="breadcrumb-item active" aria-current="page">{{$product->product_name}}</li>
			  </ol>
			</nav>
		</div>
	</div>
	<!-- =========================== Breadcrumbs =================================== -->

	<!-- =========================== Product Detail =================================== -->
	<section>
		<div class="container">
			<div class="row">
			
				<div class="col-lg-6 col-md-12 col-sm-12">
					<div class="sp-wrap">
						@foreach($product['productimages'] as $images)
							<a href="{{$images->image_url}}"><img src="{{$images->image_url}}" alt=""></a>
						@endforeach
					</div>
				</div>
				
				<div class="col-lg-6 col-md-12 col-sm-12">
					<div class="woo_pr_detail">
						
						<div class="woo_cats_wrps">
							<a href="#" class="woo_pr_cats">{{$product->category_name}} | {{$product->subcategory_name}} | {{$product->innersubcategory_name}}</a>
						</div>
						<h2 class="woo_pr_title">{{$product->product_name}}</h2>
						
						<div class="woo_pr_reviews">
							<div class="woo_pr_rating">
								@if(@$product['rattings'][0]->avg_ratting != "")
									@if(@$product['rattings'][0]->avg_ratting < 2)
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star "></i>
										<i class="fa fa-star "></i>
										<i class="fa fa-star "></i>
										<i class="fa fa-star "></i>
									@elseif(@$product['rattings'][0]->avg_ratting < 3)
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star "></i>
										<i class="fa fa-star "></i>
										<i class="fa fa-star "></i>
									@elseif(@$product['rattings'][0]->avg_ratting < 4)
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star "></i>
										<i class="fa fa-star "></i>
									@elseif(@$product['rattings'][0]->avg_ratting < 5)
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star "></i>
									@elseif(@$product['rattings'][0]->avg_ratting < 6)
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star filled"></i>
									@endif
								<span class="woo_ave_rat">{{@$product['rattings'][0]->avg_ratting}}</span>
								@endif
							</div>
							<div class="woo_pr_total_reviews">
								<a href="#">({{count(@$all_review)}} {{trans('labels.reviews')}})</a>
							</div>
						</div>
						
						<div class="woo_pr_price">
							<div class="woo_pr_offer_price">
								<h3>
									<span class="price">{{Helper::CurrencyFormatter($product->product_price)}}</span>
									<span class="org_price">@if ($product->discounted_price == 0) @else {{Helper::CurrencyFormatter($product->discounted_price)}} @endif</span>
								</h3>
							</div>
						</div>

						<!-- First -->
						<div class="cart_sku_preflix">
							@if($product->tax == 0)
								<span class="text-success">{{ trans('labels.all_tax') }}</span>
							@else
								@if($product->tax_type == 'percent')
									<span class="text-danger"><span id="additional_tax">{{Helper::CurrencyFormatter($product->product_price*$product->tax/100)}}</span> {{ trans('labels.additional_tax') }}</span>
								@else
									<span class="text-danger"><span id="additional_tax">{{Helper::CurrencyFormatter($product->tax)}}</span> {{ trans('labels.additional_tax') }}</span>
								@endif
							@endif
						</div>


						@if(count($product['variations']) > 0)
						<div class="woo_pr_color flex_inline_center mb-3">
							<div class="woo_pr_varient">
								<h6>{{$product->attribute}}:</h6>
							</div>
							<div class="woo_colors_list pl-3">
								@foreach($product['variations'] as $key => $variations)
								<div class="custom-varient custom-size">
									<input type="radio" class="custom-control-input-details" name="variations" id="variation-{{$variations->id}}" value="{{$variations->id}}" price="{{$variations->price}}" variation-name="{{$variations->variation}}" qty="{{$variations->qty}}" old-price="{{$variations->discounted_variation_price}}" @if($key == 0) checked @endif>
									<label class="custom-control-label" for="variation-{{$variations->id}}">{{$variations->variation}}</label>
								</div>
								@endforeach
							</div>
						</div>
						@endif
						
						<!-- Short Info -->
						<div class="pr_info_prefix mb-3">
							
							<!-- First -->
							<div class="cart_sku_preflix">
								<div class="sku_preflix_first">
									<strong>{{ trans('labels.sku') }}</strong>
								</div>
								<div class="sku_preflix_last">
									{{$product->sku}}
								</div>
							</div>
							
							<!-- First -->
							<div class="cart_sku_preflix">
								<div class="sku_preflix_first">
									<strong>Availibility:</strong>
								</div>
								<div class="sku_preflix_last" id="stock">
									@if($product->is_variation == 0)
										@if($product->product_qty > 0)
											<span class="text-success">{{ trans('labels.in_stock') }}</span>
										@else
											<span class="text-danger">{{ trans('labels.out_stock') }}</span>
										@endif
									@endif

									@if($product->is_variation == 1)
										@foreach($product['variations'] as $key => $variations)
											@if($variations->qty > 0)
												<span class="text-success">{{ trans('labels.in_stock') }}</span>
											@else
												<span class="text-danger">{{ trans('labels.out_stock') }}</span>
											@endif
											@break
										@endforeach
									@endif
								</div>
							</div>
							
							@if ($product->tags != "")
							<!-- First -->
							<div class="cart_sku_preflix">
								<div class="sku_preflix_first">
									<strong>{{ trans('labels.tags') }}</strong>
								</div>
								<div class="sku_preflix_last">
									{{$product->tags}}
								</div>
							</div>
							@endif
							

							<!-- First -->
							<div class="cart_sku_preflix">
								<div class="sku_preflix_first">
									<strong>{{ trans('labels.shipping_time') }}</strong>
								</div>
								<div class="sku_preflix_last">
									{{$product->est_shipping_days}} {{ trans('labels.days') }}
								</div>
							</div>

							<!-- First -->
							<div class="cart_sku_preflix">
								<div class="sku_preflix_first">
									<strong>{{ trans('labels.shipping_charge') }}:</strong>
								</div>
								<div class="sku_preflix_last">
									{{Helper::CurrencyFormatter($product->shipping_cost)}}
								</div>
							</div>

							<!-- First -->
							<div class="cart_sku_preflix">
								<div class="sku_preflix_first">
									<strong>{{ trans('labels.seller') }}:</strong>
								</div>
								<div class="sku_preflix_last">
									<a href="{{URL::to('vendor-details/'.$vendors->id)}}" class="woo_pr_cats">{{$vendors->name}} <br>
										<i class="fa fa-star filled"></i> {{@$vendors['rattings'][0]->avg_ratting}}
									</a>
								</div>
							</div>
						</div>
						
						<div class="woo_btn_action">
							<div class="col-6 col-lg-auto">
								@if (@Auth::user()->id != "")

									@if($product->is_variation == 0)
										@if($product->product_qty > 0)
											<button class="btn btn-block btn-dark mb-2 cart" onclick="AddtoCart()">{{ trans('labels.add_cart') }} <i class="ti-shopping-cart-full ml-2"></i></button>
										@else
											<button class="btn btn-block btn-dark mb-2 cart" disabled onclick="AddtoCart()">{{ trans('labels.add_cart') }} <i class="ti-shopping-cart-full ml-2"></i></button>
										@endif
									@endif

									@if($product->is_variation == 1)
										@foreach($product['variations'] as $key => $variations)
											@if($variations->qty > 0)
												<button class="btn btn-block btn-dark mb-2 cart" onclick="AddtoCart()">{{ trans('labels.add_cart') }} <i class="ti-shopping-cart-full ml-2"></i></button>
											@else
												<button class="btn btn-block btn-dark mb-2 cart" disabled onclick="AddtoCart()">{{ trans('labels.add_cart') }} <i class="ti-shopping-cart-full ml-2"></i></button>
											@endif
											@break
										@endforeach
									@endif

									
								@else
									<a class="btn btn-block btn-dark mb-2" href="{{URL::to('/signin')}}">{{ trans('labels.add_cart') }} <i class="ti-shopping-cart-full ml-2"></i></a>
								@endif
							</div>

							<div class="col-6 col-lg-auto">
								@if ($product->is_wishlist == 1)
									<button onclick="RemoveWishList('{{$product->id}}','{{$product->product_name}}','{{@Auth::user()->id}}')" class="btn btn-gray btn-block mb-2">{{ trans('labels.wishlist') }} <i class="fas fa-heart i ml-2"></i></button>
								@else
								    <button onclick="WishList('{{$product->id}}','{{$product->product_name}}','{{@Auth::user()->id}}')" class="btn btn-gray btn-block mb-2">{{ trans('labels.wishlist') }} <i class="ti-heart ml-2"></i></button>
								@endif
							</div>
						</div>
						
					</div>
				</div>
				
			</div>
			
			<!-- Product Description -->
			<div class="row mt-5">
				<div class="col-lg-12 col-md-12">
					<div class="custom-tab style-1">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true" aria-expanded="true">{{ trans('labels.description') }}</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false" aria-expanded="false">{{ trans('labels.reviews') }}</a>
							</li>
							@if($product->is_return == 1)
							<li class="nav-item">
								<a class="nav-link" id="return-tab" data-toggle="tab" href="#return" role="tab" aria-controls="return" aria-selected="false" aria-expanded="false">{{ trans('labels.return-policy') }}</a>
							</li>
							@endif
						</ul>
						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade active show" id="description" role="tabpanel" aria-labelledby="description-tab" aria-expanded="true">
								<p>{!! nl2br(e($product->description)) !!}</p>
							</div>
							<div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab" aria-expanded="false">
								<div class="review-wrapper">
									<div class="review-wrapper-header">
										<h4>{{count(@$all_review)}} Reviews</h4>
									</div>
									<div class="review-wrapper-body">
										<ul class="review-list">

											@foreach($all_review as $reviews)
											<li>
												<div class="reviews-box">
													<div class="review-body">
														<div class="review-avatar">
															<img alt="" src="{{$reviews['users']->image_url}}" class="avatar avatar-140 photo">
														</div>
														<div class="review-content">
															<div class="review-info">
																<div class="review-comment">
																	<div class="review-author">
																		{{$reviews['users']->name}}
																	</div>

																	<div class="review-comment-stars">
																		@if($reviews->ratting < 2)
																			<i class="fa fa-star"></i>
																			<i class="fa fa-star empty"></i>
																			<i class="fa fa-star empty"></i>
																			<i class="fa fa-star empty"></i>
																			<i class="fa fa-star empty"></i>
																		@elseif($reviews->ratting < 3)
																			<i class="fa fa-star"></i>
																			<i class="fa fa-star"></i>
																			<i class="fa fa-star empty"></i>
																			<i class="fa fa-star empty"></i>
																			<i class="fa fa-star empty"></i>
																		@elseif($reviews->ratting < 4)
																			<i class="fa fa-star"></i>
																			<i class="fa fa-star"></i>
																			<i class="fa fa-star"></i>
																			<i class="fa fa-star empty"></i>
																			<i class="fa fa-star empty"></i>
																		@elseif($reviews->ratting < 5)
																			<i class="fa fa-star"></i>
																			<i class="fa fa-star"></i>
																			<i class="fa fa-star"></i>
																			<i class="fa fa-star"></i>
																			<i class="fa fa-star empty"></i>
																		@elseif($reviews->ratting < 6)
																			<i class="fa fa-star"></i>
																			<i class="fa fa-star"></i>
																			<i class="fa fa-star"></i>
																			<i class="fa fa-star"></i>
																			<i class="fa fa-star"></i>
																		@endif
																	</div>
																</div>
																<div class="review-comment-date">
																	<div class="review-date">
																		<span>{{$reviews->date}}</span>
																	</div>
																</div>
															</div>
															<p>{{$reviews->comment}}</p>
														</div>
													</div>
												</div>
											</li>
											@endforeach
										</ul>
									</div>
								</div>
							</div>
							<div class="tab-pane fade show" id="return" role="tabpanel" aria-labelledby="return-tab" aria-expanded="true">
								<p>{{$vendors->return_policies}}</p>
							</div>
						</div>
					</div>	
				</div>
			</div>
			
		</div>
	</section>
	<!-- =========================== Product Detail =================================== -->
	
	<!-- =========================== Related Products =================================== -->
	<section class="gray">
		<div class="container-fluid">
			
			<div class="row">
				<div class="col-lg-12 col-md-12 mb-2">
					<h4 class="mb-0">{{ trans('labels.related_products') }}</h4>
				</div>						
			</div>
			
			<div class="row">
			
				<div class="col-lg-12 col-md-12">
					<div class="owl-carousel products-slider owl-theme">
						<?php 
						$strings = array('#FDF7FF','#FDF3F0','#EDF7FD','#FFFAEA','#F1FFF6');
						$count = count($strings);
						?>
						<!-- Single Item -->
						@foreach($related_products as $key => $products)
						<div class="item">
							<div class="woo_product_grid no-hover">
								<a href="{{URL::to('products/product-details/'.@$products['slug'])}}">
									<div class="woo_product_thumb">
										<?php
										$filename_from_url = parse_url($products['productimage']->image_url);
										$ext = pathinfo($filename_from_url['path'], PATHINFO_EXTENSION);
										?>
										@if ($ext == "png")
											<img src="{{$products['productimage']->image_url}}" class="img-fluid" alt="" style="height: 335px; object-fit: scale-down; background-color: #f8f7f6;" title="{{$products['product_name']}}" />
										@else
											<img src="{{$products['productimage']->image_url}}" class="img-fluid" alt="" style="height: 335px; object-fit: scale-down;" title="{{$products['product_name']}}" />
										@endif
										<div class='curtain' style="background-color: <?php echo $strings[$key % $count]; ?>">
									    	<div class='shine'></div>
									  	</div>
									</div>
									<div class="woo_product_caption">
										<div class="woo_title mt-2">
											<h4 class="entry-title">{{ Str::limit($products->product_name, 53) }}</h4>
											<h6><i class="fa fa-star filled"></i> {{number_format($products->ratings_average,1)}}</h6>
										</div>

										<div class="woo_price mt-2">
											<h6>{{Helper::CurrencyFormatter($products->product_price)}}<span class="less_price">{{Helper::CurrencyFormatter($products->discounted_price)}}</span></h6>
										</div>

										@if($products->product_price)
											<span class="post-article-cat theme-bg mt-2">Save {{Helper::CurrencyFormatter($products->discounted_price - $products->product_price)}}</span>
										@endif
									</div>
								</a>
								<div class="woo_product_cart hover">
									<ul>
										@if ($products->is_wishlist == 1)
											<li><a href="javascript:void();" onclick="RemoveWishList('{{$products->id}}','{{$products->product_name}}','{{@Auth::user()->id}}')" class="woo_cart_btn btn_save">{{ trans('labels.wishlist') }} <i class="fas fa-heart i ml-2"></i></a></li>
										@else
										    <li><a href="javascript:void();" onclick="WishList('{{$products->id}}','{{$products->product_name}}','{{@Auth::user()->id}}')" class="woo_cart_btn btn_save">{{ trans('labels.wishlist') }} <i class="ti-heart ml-2"></i></a></li>
										@endif
									</ul>
								</div>							
							</div>
						</div>
						@endforeach
					
					</div>
				</div>
				
			</div>

			<input type="hidden" name="user_id" id="user_id" value="{{@Auth::user()->id}}">
			<input type="hidden" name="product_id" id="product_id" value="{{$product->id}}">
			<input type="hidden" name="vendor_id" id="vendor_id" value="{{$product->vendor_id}}">
			<input type="hidden" name="product_name" id="product_name" value="{{$product->product_name}}">
			<input type="hidden" name="attribute" id="attribute" value="{{$product->attribute}}">
			@foreach($product['productimages'] as $images)
				<input type="hidden" name="image" id="image" value="{{$images->image_name}}">
				@break
			@endforeach
			<input type="hidden" name="qty" id="qty" value="1">
			<input type="hidden" name="price" id="price" value="{{$product->product_price}}">
			<input type="hidden" name="shipping_cost" id="shipping_cost" value="{{$product->shipping_cost}}">

			@if($product->tax_type == 'percent')
				<input type="hidden" name="tax_amount" id="tax_amount" value="{{$product->product_price*$product->tax/100}}">
			@else
				<input type="hidden" name="tax_amount" id="tax_amount" value="{{$product->tax}}">
			@endif
			<input type="hidden" name="tax" id="tax" value="{{$product->tax}}">
			<input type="hidden" name="currency_position" id="currency_position" value="{{$currency->currency_position}}">
			<input type="hidden" name="currency" id="currency" value="{{$currency->currency}}">
			<input type="hidden" name="tax_type" id="tax_type" value="{{$product->tax_type}}">
			<input type="hidden" name="slug" id="slug" value="{{$product->slug}}">

		</div>
	</section>
	<!-- =========================== Related Products =================================== -->

@endsection

@section('scripttop')
<script type="text/javascript">
	$('input[type="radio"]').change(function() {
		var currency_position = $('#currency_position').val();
		var currency = $('#currency').val();
		var tax = $('#tax').val();
		var tax_type = $('#tax_type').val();

		if(tax != 0) {
			if(tax_type == 'percent') {
				$('#tax_amount').val(parseFloat($(this).attr('price')*tax/100).toFixed(2));
				if (currency_position == "left") {
					$('#additional_tax').text(currency+parseFloat($(this).attr('price')*tax/100).toFixed(2));
				}
				if (currency_position == "right") {
					$('#additional_tax').text(parseFloat($(this).attr('price')*tax/100).toFixed(2)+currency);
				}
			} else {
				$('#tax_amount').val(parseFloat(tax).toFixed(2));
				if (currency_position == "left") {
					$('#additional_tax').text(currency+parseFloat(tax).toFixed(2));
				}
				if (currency_position == "right") {
					$('#additional_tax').text(parseFloat(tax).toFixed(2)+currency);
				}
			}
		}

		$('#price').val(parseFloat($(this).attr('price')));

		if (currency_position == "left") {
			$('.price').text(currency+parseFloat($(this).attr('price')).toFixed(2));

			if ($(this).attr('old-price') != "0") {
				$('.org_price').text(currency+parseFloat($(this).attr('old-price')).toFixed(2));
			}
		}
	    
	    if (currency_position == "right") {
	    	$('.price').text(parseFloat($(this).attr('price')).toFixed(2)+currency);

			if ($(this).attr('old-price') != "0") {
				$('.org_price').text(parseFloat($(this).attr('old-price')).toFixed(2)+currency);
			}
	    }

	    if ($(this).attr('qty') > 0) {
	    	$('#stock').html("<span class='text-success'>{{ trans('labels.in_stock') }}</span>");
	    	$(".cart").attr("disabled", false);
	    } else {
	    	$('#stock').html("<span class='text-danger'>{{ trans('labels.out_stock') }}</span>");
	    	$(".cart").attr("disabled", true);
	    }
	})

	function AddtoCart() {
	  "use strict";
	  var user_id = $('#user_id').val();
	  var product_id = $('#product_id').val();
	  var vendor_id = $('#vendor_id').val();
	  var product_name = $('#product_name').val();
	  var attribute = $('#attribute').val();
	  var image = $('#image').val();
	  var qty = $('#qty').val();
	  var price = $('#price').val();
	  var variation = $('input[name="variations"]:checked').attr('variation-name');
	  var tax = $('#tax_amount').val();
	  var slug = $('#slug').val();
	  var shipping_cost = $('#shipping_cost').val();

	  $('#preloader').show();
	  $.ajax({
	      headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	      },
	      url:"{{ URL::to('/product/addtocart') }}",
	      data: {
	          user_id: user_id,
	          product_id: product_id,
	          vendor_id: vendor_id,
	          product_name: product_name,
	          attribute: attribute,
	          image: image,
	          qty: qty,
	          price: price,
	          variation: variation,
	          tax: tax,
	          slug: slug,
	          shipping_cost: shipping_cost
	      },
	      method: 'POST', //Post method,
	      dataType: 'json',
	      success: function(response) {
	        $("#preloader").hide();
	          if (response.status == 1) {
	            $('#cartcnt').text(response.cartcnt);
  				$('.view-order-btn').show();
				localStorage.setItem("message",response.message)
	            location.reload();
	          } else {
	          	toast.error(response.message);
	          }
	      },
	      error: function(error) {
	          // $('#errormsg').show();
	      }
	  })
	};
</script>
@endsection