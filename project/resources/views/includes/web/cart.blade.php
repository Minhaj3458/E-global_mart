<div class="w3-ch-sideBar w3-bar-block w3-card-2 w3-animate-right"  style="display:none;right:0;" id="rightMenu">
	<div class="rightMenu-scroll">
		<h4 class="cart_heading">{{trans('labels.cart')}}</h4>
		<button onclick="closeRightMenu()" class="w3-bar-item w3-button w3-large"><i class="ti-close"></i></button>
		
			<div class="right-ch-sideBar" id="side-scroll">	
				@if(count(Helper::getcart(@Auth::user()->id)) == 0)
					<div class="col-lg-12 col-md-12 text-center">
						<img src="{{Helper::image_path('no-data.png')}}">
						@if(@Auth::user())
							<h2 class="error_title mt-4">{{ trans('labels.empty_cart') }}</h2>
							<p><span class="text-primary">{{trans('labels.woops')}}</span>  {{ trans('labels.empty_cart_text') }}</p>
							<a href="{{URL::to('/')}}" class="btn btn-primary">{{ trans('labels.shop_now') }}</a>
						@else
							<h2 class="error_title mt-4">{{ trans('labels.please_login') }}</h2>
							<p>{{ trans('labels.please_login_text') }}</p>
							<a href="{{URL::to('/signin')}}" class="btn btn-primary">{{ trans('labels.login') }}</a>
						@endif
					</div>

				@else 	
					<div class="cart_select_items">
						<!-- Single Item -->
						@foreach (Helper::getcart(@Auth::user()->id) as $cartitems)
						<div class="product cart_selected_single">
							<div class="cart_selected_single_thumb">
								<a href="#"><img src="{{$cartitems->image_url}}" class="img-fluid" alt="" /></a>
							</div>
							<div class="cart_selected_single_caption">
								<h4 class="product_title">{{$cartitems->product_name}}</h4>
								@if ($cartitems->attribute != "")
									<span class="numberof_item mt-2">{{$cartitems->attribute}} : {{$cartitems->variation}}</span>
								@endif
								<span class="numberof_item mt-2">{{Helper::CurrencyFormatter($cartitems->price)}} x {{$cartitems->qty}}</span>
								<span class="numberof_item mt-2 text-right"><b></b></span>
								<div class="cart_price">
									<h6><a href="javascript::void()" onclick="DeleteItem('{{$cartitems->id}}','1')" class="text-danger"><i class="fa fa-trash" aria-hidden="true"></i></a><span>{{Helper::CurrencyFormatter($cartitems->qty * $cartitems->price)}}</span></h6>
								</div>
							</div>
						</div>

						<?php
						$data[] = array(
						    "sub_total" => $cartitems->qty * $cartitems->price
						);
						$sub_total = array_sum(array_column(@$data, 'sub_total'));
						?>
						@endforeach

					</div>
					
					<div class="cart_subtotal">
						<h6>Subtotal<span class="theme-cl">{{Helper::CurrencyFormatter($sub_total)}}</span></h6>
					</div>
					
					<div class="cart_action">
						<ul>
							<li><a href="{{URL::to('/cart')}}" class="btn btn-go-cart btn-theme">{{trans('labels.view_cart')}}</a></li>
						</ul>
					</div>
				@endif
				
			</div>
		</div>
</div>