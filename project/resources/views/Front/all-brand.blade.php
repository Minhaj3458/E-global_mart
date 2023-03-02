@extends('layouts.web')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.brand') }}
@endsection

@section('content')
	<!-- =========================== Breadcrumbs =================================== -->
	<div class="brd_wraps pt-2 pb-2">
		<div class="container">
			<nav aria-label="breadcrumb" class="simple_breadcrumbs">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#"><i class="ti-home"></i></a></li>
				<li class="breadcrumb-item active" aria-current="page">{{ trans('labels.brand') }}</li>
			  </ol>
			</nav>
		</div>
	</div>
	<!-- =========================== Breadcrumbs =================================== -->

	<!-- =========================== Brands =================================== -->

   	<section class="pt-5 pb-5">
   		<div class="container">

   			<div class="row">
				<!-- Single Item -->
				@foreach ($brands as $key9 => $value)
					<a href="{{URL::to('brands/'.$value->id)}}">
					<div class="col-2xl-2 col-xl-3 col-lg-4 col-sm-6 mb-4">
						<div class="item">
							<div class="woo_category_box border_style circle">
								<div class="woo_cat_thumb">
									<img src="{{$value['image_url']}}" class="img-fluid" alt="" />
								</div>
							</div>
						</div>
					</div>
					</a>
				@endforeach
   			</div>
   			
   		</div>
   	</section>
	<!-- =========================== Brands =================================== -->

@endsection

@section('scripttop')

@endsection