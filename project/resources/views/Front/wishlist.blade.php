@extends('layouts.web')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.wishlist') }}
@endsection

@section('content')
	<!-- =========================== Breadcrumbs =================================== -->
	<div class="brd_wraps pt-2 pb-2">
		<div class="container">
			<nav aria-label="breadcrumb" class="simple_breadcrumbs">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{URL::to('/')}}"><i class="ti-home"></i></a></li>
				<li class="breadcrumb-item active" aria-current="page">{{ trans('labels.wishlist') }}</li>
			  </ol>
			</nav>
		</div>
	</div>
	<!-- =========================== Breadcrumbs =================================== -->

	<!-- =========================== Wishlist-Products =================================== -->
	<section class="sixcol">
		<div class="container-fluid">
			@if(count($products) <= 0 || !Auth::user())
				<div class="col-lg-12 col-md-12 text-center">
					<img src="{{Helper::image_path('no-data.png')}}">
					@if(Auth::user())
						<h2 class="error_title mt-4">{{ trans('labels.empty_wishlist') }}</h2>
						<p><span class="text-primary">{{trans('labels.woops')}}</span> {{ trans('labels.wishlist_is_empty') }}</p>
						<a href="{{URL::to('/')}}" class="btn btn-primary">{{ trans('labels.go_home_page') }}</a>
					@else
						<h2 class="error_title mt-4">{{ trans('labels.please_login') }}</h2>
						<p>{{ trans('labels.login_text_wishlist') }}</p>
						<a href="{{URL::to('/signin')}}" class="btn btn-primary">{{ trans('labels.login') }}</a>
					@endif
				</div>
			@else
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<!-- row -->
						<div class="row" id="product-filter">
							@include('Front.filterproduct');
						</div>
						<!-- row -->
					</div>
					<div class="d-flex justify-content-center">
						{{$products->links()}}
					</div>
				</div>
			@endif
		</div>
	</section>
	<!-- =========================== Wishlist-Products =================================== -->
@endsection