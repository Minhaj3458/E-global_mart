@extends('layouts.web')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.home') }}
@endsection

@section('content')
<?php 
$strings = array('#FDF7FF','#FDF3F0','#EDF7FD','#FFFAEA','#F1FFF6');
$count = count($strings);
?>
		
	<!-- ======================== Slider Start ==================== -->
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			@foreach($sliders as $key1 => $slider)
				<li data-target="#carouselExampleIndicators" data-slide-to="{{$key1}}" class="<?php if($key1 == 0) { echo "active"; } ?>"></li>
			@endforeach
		</ol>
		<div class="carousel-inner">
			@foreach($sliders as $key2 => $slider)
			<div class="carousel-item <?php if($key2 == 0) { echo "active"; } ?>">
				<a href="{{$slider->link}}">
					<img class="d-block w-100" src="{{Helper::image_path($slider->image)}}">
				</a>
			</div>
			@endforeach
		</div>
		
		<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">{{ trans('labels.Previous') }}</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">{{ trans('labels.Next') }}</span>
		</a>
	</div>
	<!-- ======================== Slider End ==================== -->

	<!-- ======================== Top banner ==================== -->
	<section>
		<div class="container-fluid">
			<div class="row justify-content-center">

				@foreach ($banners as $key => $value)
					@if ($value['positions'] == "top")
					<div class="col-lg-4 col-md-4 col-sm-12">
						<div class="card card_big">
							<div class="card-bg">
								@if($value['type'] == "product")
									<a href="{{Helper::getSlug($value['type'],$value['product_id'])}}">
								@else
									<a href="{{Helper::getSlug($value['type'],$value['cat_id'])}}">
								@endif
									<div class="card-bg-img bg-cover" style="background:#fde9ed url('{{Helper::image_path($value['image'])}}');"></div>
								</a>
							</div>
						</div>
					</div>
					@endif
				@endforeach
				
			</div>
		</div>
	</section>
	<div class="clearfix"></div>
	<!-- ======================== Top banner End ==================== -->
	
	<!-- ======================== Best Sellers Start ==================== -->
	<section class="gray">
		<div class="container-fluid">
			
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="sec-heading-flex pl-2 pr-2">
						<div class="sec-heading-flex-one">
							<h1>{{ trans('labels.featured_products') }}</h1>
						</div>
						<div class="sec-heading-flex-last">
							<a href="{{URL::to('/featured-products')}}" class="btn btn-theme">{{ trans('labels.view_more') }}<i class="ti-arrow-right ml-2"></i></a>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				@foreach($featured_products as $key3 => $product)
				<div class="col-2xl-2 col-xl-3 col-lg-4 col-sm-6 mb-4">
					<div class="woo_product_grid no-hover">
						
						<a href="{{URL::to('products/product-details/'.$product->slug)}}">
							<div class="woo_product_thumb">
								<?php
									$filename_from_url = parse_url($product['productimage']->image_url);
									$ext = pathinfo($filename_from_url['path'], PATHINFO_EXTENSION);
								?>
								<img src="{{$product['productimage']->image_url}}" class="img-fluid lazyload product-box-image @if($ext=='png') gray-bg @endif" title="{{$product->product_name}}" />
								<div class='curtain' style="background-color: <?php echo $strings[$key3 % $count]; ?>">
							    	<div class='shine'></div>
							  	</div>
							</div>
						
							<div class="woo_product_caption">
								<div class="woo_title mt-2">
									<h4 class="entry-title">{{ Str::limit($product->product_name, 32) }}</h4>
									<h6><i class="fa fa-star filled"></i> {{number_format($product->ratings_average,1)}}</h6>
								</div>

								<div class="woo_price mt-2">
									<h6>{{Helper::CurrencyFormatter($product->product_price)}}<span class="less_price">{{Helper::CurrencyFormatter($product->discounted_price)}}</span></h6>
								</div>

								@if($product->product_price)
									<span class="post-article-cat theme-bg mt-2">{{ trans('labels.save') }} {{Helper::CurrencyFormatter($product->discounted_price - $product->product_price)}}</span>
								@endif
							</div>
						</a>
						<div class="woo_product_cart hover">
							<ul>
								@if ($product->is_wishlist == 1)
									<li><a href="javascript:void();" onclick="RemoveWishList('{{$product->id}}','{{$product->product_name}}','{{@Auth::user()->id}}')" class="woo_cart_btn btn_save">{{ trans('labels.wishlist') }} <i class="fas fa-heart i ml-2"></i></a></li>
								@else
								    <li><a href="javascript:void();" onclick="WishList('{{$product->id}}','{{$product->product_name}}','{{@Auth::user()->id}}')" class="woo_cart_btn btn_save">{{ trans('labels.wishlist') }} <i class="ti-heart ml-2"></i></a></li>
								@endif
							</ul>
						</div>								
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</section>
	<div class="clearfix"></div>
	<!-- ======================== Best Sellers End ==================== -->

	<!-- ======================= Hot Deal Start ============================== -->
	<section class="">
		<div class="container-fluid">
			<div class="row align-item-center">
				
				<div class="col-lg-6 col-md-6">
					<div class="d-flex flex-column overflow-hidden rounded-lg pad-bt">
						@foreach ($banners as $key4 => $value)
						@if ($value['positions'] == "left")
							@if($value['type'] == "product")
								<a href="{{Helper::getSlug($value['type'],$value['product_id'])}}">
							@else
								<a href="{{Helper::getSlug($value['type'],$value['cat_id'])}}">
							@endif
								<img src="{{Helper::image_path($value['image'])}}" class="img-fluid" />
							</a>
						@endif
						@endforeach
					</div>
				</div>
				
				<div class="col-lg-6 col-md-6">
					@foreach ($banners as $key5 => $value)
					@if ($value['positions'] == "bottom")
						<div class="offer-deals mb-4">
							@if($value['type'] == "product")
								<a href="{{Helper::getSlug($value['type'],$value['product_id'])}}">
							@else
								<a href="{{Helper::getSlug($value['type'],$value['cat_id'])}}">
							@endif
								<img src="{{Helper::image_path($value['image'])}}" class="img-fluid" />
							</a>
						</div>
					@endif
					@endforeach
				</div>
				
			</div>
		</div>
	</section>

	<section class="">
		<div class="container-fluid">
			
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="sec-heading-flex pl-2 pr-2">
						<div class="sec-heading-flex-one">
							<h1>{{ trans('labels.hot_products') }}</h1>
						</div>
						<div class="sec-heading-flex-last">
							<a href="{{URL::to('/hot-products')}}" class="btn btn-theme">{{ trans('labels.view_more') }}<i class="ti-arrow-right ml-2"></i></a>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				@foreach($hot_products as $key6 => $product)
				<!-- Single Item -->
				<div class="col-2xl-2 col-xl-3 col-lg-4 col-sm-6 mb-4">
					<div class="woo_product_grid no-hover">
						
						<a href="{{URL::to('products/product-details/'.$product->slug)}}">
							<div class="woo_product_thumb">
								<?php
									$filename_from_url = parse_url($product['productimage']->image_url);
									$ext = pathinfo($filename_from_url['path'], PATHINFO_EXTENSION);
								?>
								<img src="{{$product['productimage']->image_url}}" class="img-fluid lazyload product-box-image @if($ext=='png') gray-bg @endif" title="{{$product->product_name}}" />
								<div class='curtain' style="background-color: <?php echo $strings[$key6 % $count]; ?>">
							    	<div class='shine'></div>
							  	</div>
							</div>
						
							<div class="woo_product_caption">
								<div class="woo_title mt-2">
									<h4 class="entry-title">{{ Str::limit($product->product_name, 32) }}</h4>
									<h6><i class="fa fa-star filled"></i> {{number_format($product->ratings_average,1)}}</h6>
								</div>

								<div class="woo_price mt-2">
									<h6>{{Helper::CurrencyFormatter($product->product_price)}}<span class="less_price">{{Helper::CurrencyFormatter($product->discounted_price)}}</span></h6>
								</div>

								@if($product->product_price)
									<span class="post-article-cat theme-bg mt-2">Save {{Helper::CurrencyFormatter($product->discounted_price - $product->product_price)}}</span>
								@endif
							</div>
						</a>
						<div class="woo_product_cart hover">
							<ul>
								@if ($product->is_wishlist == 1)
									<li><a href="javascript:void();" onclick="RemoveWishList('{{$product->id}}','{{$product->product_name}}','{{@Auth::user()->id}}')" class="woo_cart_btn btn_save">{{ trans('labels.wishlist') }} <i class="fas fa-heart i ml-2"></i></a></li>
								@else
								    <li><a href="javascript:void();" onclick="WishList('{{$product->id}}','{{$product->product_name}}','{{@Auth::user()->id}}')" class="woo_cart_btn btn_save">{{ trans('labels.wishlist') }} <i class="ti-heart ml-2"></i></a></li>
								@endif
							</ul>
						</div>								
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</section>
	<!-- ======================= Hot Deals End =============================== -->
	
	<!-- ======================== Women Accessiries Start ==================== -->
	<section class="gray">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="sec-heading-flex pl-2 pr-2">
						<div class="sec-heading-flex-one">
							<h1>{{ trans('labels.new_arrivals') }}</h1>
						</div>
						<div class="sec-heading-flex-last">
							<a href="{{URL::to('/new-products')}}" class="btn btn-theme">{{ trans('labels.view_more') }}<i class="ti-arrow-right ml-2"></i></a>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				@foreach($new_products as $key8 => $product)
				<!-- Single Item -->
				<div class="col-2xl-2 col-xl-3 col-lg-4 col-sm-6 mb-4">
					<div class="woo_product_grid no-hover">
						
						<a href="{{URL::to('products/product-details/'.$product->slug)}}">
							<div class="woo_product_thumb">
								<?php
									$filename_from_url = parse_url($product['productimage']->image_url);
									$ext = pathinfo($filename_from_url['path'], PATHINFO_EXTENSION);
								?>
								<img src="{{$product['productimage']->image_url}}" class="img-fluid lazyload product-box-image @if($ext=='png') gray-bg @endif" title="{{$product->product_name}}" />
								<div class='curtain' style="background-color: <?php echo $strings[$key8 % $count]; ?>">
							    	<div class='shine'></div>
							  	</div>
							</div>
						
							<div class="woo_product_caption">
								<div class="woo_title mt-2">
									<h4 class="entry-title">{{ Str::limit($product->product_name, 32) }}</h4>
									<h6><i class="fa fa-star filled"></i> {{number_format($product->ratings_average,1)}}</h6>
								</div>

								<div class="woo_price mt-2">
									<h6>{{Helper::CurrencyFormatter($product->product_price)}}<span class="less_price">{{Helper::CurrencyFormatter($product->discounted_price)}}</span></h6>
								</div>

								@if($product->product_price)
									<span class="post-article-cat theme-bg mt-2">Save {{Helper::CurrencyFormatter($product->discounted_price - $product->product_price)}}</span>
								@endif
							</div>
						</a>
						<div class="woo_product_cart hover">
							<ul>
								@if ($product->is_wishlist == 1)
									<li><a href="javascript:void();" onclick="RemoveWishList('{{$product->id}}','{{$product->product_name}}','{{@Auth::user()->id}}')" class="woo_cart_btn btn_save">{{ trans('labels.wishlist') }} <i class="fas fa-heart i ml-2"></i></a></li>
								@else
								    <li><a href="javascript:void();" onclick="WishList('{{$product->id}}','{{$product->product_name}}','{{@Auth::user()->id}}')" class="woo_cart_btn btn_save">{{ trans('labels.wishlist') }} <i class="ti-heart ml-2"></i></a></li>
								@endif
							</ul>
						</div>								
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</section>
	<div class="clearfix"></div>
	<!-- ======================== Women Accessiries End ==================== -->

	<!-- ======================== Tag & Explore End ==================== -->
	@foreach ($banners as $key => $value)
	@if ($value['positions'] == "large")
		@if($value['type'] == "product")
			<a href="{{Helper::getSlug($value['type'],$value['product_id'])}}">
		@else
			<a href="{{Helper::getSlug($value['type'],$value['cat_id'])}}">
		@endif
			<section class="image-bg" style="background:url('{{Helper::image_path($value['image'])}}') no-repeat;">
				<div class="ht-300"></div>

				<div class="ht-300"></div>
			</section>
		</a>
		@break
	@endif
	@endforeach
	<!-- ======================== Tag & Explore End ==================== -->

	<!-- ======================== Brand Start ==================== -->
	<section class="pt-5 pb-5">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="sec-heading-flex pl-2 pr-2">
						<div class="sec-heading-flex-one">
							<h1>{{ trans('labels.top_brands') }}</h1>
						</div>
						<div class="sec-heading-flex-last">
							<a href="{{URL::to('/all-brand')}}" class="btn btn-theme">{{ trans('labels.view_more') }}<i class="ti-arrow-right ml-2"></i></a>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="owl-carousel category-slider owl-theme">
						<!-- Single Item -->
						@foreach ($brands as $key9 => $value)
						<div class="item">
							<div class="woo_category_box border_style circle">
								<div class="woo_cat_thumb">
									<a href="{{URL::to('brands/'.$value->id)}}"><img src="{{Helper::image_path($value['icon'])}}" class="img-fluid" /></a>
								</div>
							</div>
						</div>
						@endforeach
					
					</div>
				</div>
			</div>
			
		</div>
	</section>
	<div class="clearfix"></div>
	<!-- ======================== Brand End ==================== -->

	<!-- ======================== Vendors start ==================== -->
	<section class="gray">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="sec-heading-flex pl-2 pr-2">
						<div class="sec-heading-flex-one">
							<h1>{{ trans('labels.vendors') }}</h1>
						</div>
						<div class="sec-heading-flex-last">
							<a href="{{URL::to('/all-vendors')}}" class="btn btn-theme">{{ trans('labels.view_more') }}<i class="ti-arrow-right ml-2"></i></a>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="owl-carousel products-slider owl-theme">
						
						@foreach ($vendors as $key10 => $list)
						<!-- Single Item -->
						<div class="item">
							<div class="woo_product_grid no-hover">
								<div class="woo_product_thumb">
									<img src="{{Helper::image_path($list->profile_pic)}}" class="img-fluid lazyload vendor-box-image"/>
									<div class='curtain' style="background-color: <?php echo $strings[$key10 % $count]; ?>">
								    	<div class='shine'></div>
								  	</div>
								</div>
								<div class="woo_product_caption center">
									<div class="woo_title mt-3">
										<h4 class="woo_pro_title"><a href="{{URL::to('vendor-details/'.$list->id)}}">{{$list->name}}</a></h4>
									</div>
								</div>
							</div>
						</div>
						@endforeach
					
					</div>
				</div>
			</div>
			
		</div>
	</section>
	<div class="clearfix"></div>
	<!-- ======================== vendors End ==================== -->

@endsection