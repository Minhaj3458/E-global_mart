@extends('layouts.web')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.offers') }}
@endsection

@section('content')
	<!-- =========================== Breadcrumbs =================================== -->
	<div class="brd_wraps pt-2 pb-2">
		<div class="container">
			<nav aria-label="breadcrumb" class="simple_breadcrumbs">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#"><i class="ti-home"></i></a></li>
				<li class="breadcrumb-item active" aria-current="page">{{ trans('labels.offers') }}</li>
			  </ol>
			</nav>
		</div>
	</div>
	<!-- =========================== Breadcrumbs =================================== -->

	<!-- =========================== Offers =================================== -->

   	<section class="gray">
   		<div class="container">
   			<div class="row">
   				@foreach ($coupons as $offers)
   				<!-- Single Blog -->
   				<div class="col-lg-4 col-md-6 col-sm-6 mb-4">
   					<div class="coupon p-3 bg-white">
   					    <div class="row no-gutters">
   					        <div class="col-md-4 border-right">
   					            <div class="d-flex flex-column align-items-center"><img src="{{asset('storage/app/public/Webassets/img/discount.png')}}"><span class="d-block mt-2">{{ trans('labels.expire') }}</span><span class="text-black-50">{{date('d M Y', strtotime($offers->end_date))}}</span></div>
   					        </div>
   					        <div class="col-md-8">
   					            <div>
   					                <div class="d-flex flex-row justify-content-end off">
   					                	@if($offers->amount != "")
   					                    	<h1>{{Helper::CurrencyFormatter($offers->amount)}}</h1><span>{{ trans('labels.off') }}</span>
   					                    @endif

				                    	@if($offers->percentage != "")
				                        	<h1>{{$offers->percentage}}%</h1><span>{{ trans('labels.off') }}</span>
				                        @endif
   					                </div>
   					                <div class="d-flex flex-row justify-content-between off px-3 p-2"><span>{{ trans('labels.promo_code') }}</span><span class="border border-success px-3 rounded code">{{$offers->coupon_name}}</span></div>
   					            </div>
   					        </div>
   					    </div>
   					</div>
   				</div>
   				@endforeach
   			</div>
   		</div>
   	</section>
	<!-- =========================== Category =================================== -->

@endsection

@section('scripttop')

@endsection