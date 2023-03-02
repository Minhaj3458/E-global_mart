@extends('layouts.web')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.success') }}
@endsection

@section('content')

	<!-- =========================== Success =================================== -->
	<section>
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-10 col-md-12 col-sm-12">
				
					<div class="card py-3 mt-sm-3">
					  <div class="card-body text-center">
						<h2 class="pb-2">{{ trans('labels.thanks_for_order') }}</h2>
						<p class="font-size-sm mb-2">{{ trans('labels.order_placed') }}</p>
						<p class="font-size-sm mb-2">{{ trans('labels.order_number_sucess') }} <span class="font-weight-medium"><b>{{$order_info->order_number}}</b>.</span></p>
						<p class="font-size-sm">{{ trans('labels.order_confirmation_text') }}</p><a class="btn btn-secondary mt-3 mr-3" href="{{URL::to('/')}}">{{ trans('labels.go_home_page') }}</a><a class="btn btn-primary mt-3" href="{{URL::to('order-history')}}"><i class="czi-location"></i>&nbsp;{{ trans('labels.track_order') }}</a>
					  </div>
					</div>
				
				</div>
			</div>
		</div>
	</section>
	<!-- =========================== Success =================================== -->

@endsection