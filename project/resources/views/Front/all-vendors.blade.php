@extends('layouts.web')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.vendors') }}
@endsection

@section('content')
	<!-- =========================== Breadcrumbs =================================== -->
	<div class="brd_wraps pt-2 pb-2">
		<div class="container">
			<nav aria-label="breadcrumb" class="simple_breadcrumbs">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#"><i class="ti-home"></i></a></li>
				<li class="breadcrumb-item active" aria-current="page">{{ trans('labels.vendors') }}</li>
			  </ol>
			</nav>
		</div>
	</div>
	<!-- =========================== Breadcrumbs =================================== -->

	<!-- =========================== Vendors =================================== -->

   	<section class="pt-5 pb-5">
   		<div class="container">

   			<div class="row">
				<!-- Single Item -->
				@foreach ($vendors as $key9 => $value)
					<a href="{{URL::to('vendor-details/'.$value->id)}}">
					<div class="col-2xl-2 col-xl-3 col-lg-4 col-sm-6 mb-4">
						<div class="item">
							<div class="woo_product_grid no-hover">
								<div class="woo_cat_thumb">
									<img src="{{Helper::image_path($value->profile_pic)}}" class="img-fluid" alt="" />
								</div>
								<div class="woo_product_caption center">
									<div class="woo_title mt-3">
										<h4 class="woo_pro_title"><a href="{{URL::to('vendor-details/'.$value->id)}}">{{$value->name}}</a></h4>
									</div>
								</div>
							</div>
						</div>
					</div>
					</a>
				@endforeach
   			</div>
   			
   		</div>
   	</section>
	<!-- =========================== Vendors =================================== -->

@endsection

@section('scripttop')

@endsection