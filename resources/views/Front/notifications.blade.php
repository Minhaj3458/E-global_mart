@extends('layouts.web')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.all_notifications') }}
@endsection

@section('content')
	<!-- =========================== Breadcrumbs =================================== -->
	<div class="brd_wraps pt-2 pb-2">
		<div class="container">
			<nav aria-label="breadcrumb" class="simple_breadcrumbs">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#"><i class="ti-home"></i></a></li>
				<li class="breadcrumb-item active" aria-current="page">{{ trans('labels.all_notifications') }}</li>
			  </ol>
			</nav>
		</div>
	</div>
	<!-- =========================== Breadcrumbs =================================== -->

	<!-- =========================== My All Orders =================================== -->
	<section>
		<div class="container">
			<div class="row">

				@include('includes.web.order-sidebar')
				
				@if(count($notifications) <= 0)
					<div class="col-lg-8 col-md-9 col-sm-12 col-12 text-center">
						<img src="{{Helper::image_path('no-data.png')}}">
						<h2 class="error_title mt-4">{{ trans('labels.no_notification') }}</h2>
						<p><span class="text-primary">{{trans('labels.woops')}}</span> {{ trans('labels.notifications_not_found') }}</p>
						<a href="{{URL::to('/')}}" class="btn btn-primary">{{ trans('labels.go_home_page') }}</a>
					</div>
				@else
					<div class="col-lg-8 col-md-9 col-sm-12 col-12">
						<!-- Notification list -->
						<div class="card style-2 mb-4">
							<div class="card-body">
								<ul class="item-groups">
									@foreach ($notifications as $value)
									<!-- Single Items -->
									<li>
										<div class="row align-items-center">
											<div class="col-4 col-md-3 col-xl-2">
												@if($value->order_status == 1)
													<a href="{{URL::to('track-order/'.$value->order_id)}}">
														<img src="{{ Helper::image_path('placed.png') }}"class="img-fluid" style="background-color: #fc0; padding: 20px; border-radius: 20%;">
													</a>
												@endif
												@if($value->order_status == 2)
													<a href="{{URL::to('track-order/'.$value->order_id)}}">
														<img src="{{ Helper::image_path('confirmed.png') }}"class="img-fluid" style="background-color: #007aff; padding: 20px; border-radius: 20%;">
													</a>
												@endif
												@if($value->order_status == 3)
													<a href="{{URL::to('track-order/'.$value->order_id)}}">
														<img src="{{ Helper::image_path('delivery.png') }}"class="img-fluid" style="background-color: #5ac8fa; padding: 20px; border-radius: 20%;">
													</a>
												@endif
												@if($value->order_status == 4)
													<a href="{{URL::to('track-order/'.$value->order_id)}}">
														<img src="{{ Helper::image_path('delivered.png') }}"class="img-fluid" style="background-color: #35c759; padding: 20px; border-radius: 20%;">
													</a>
												@endif
												@if($value->order_status == 5 || $value->order_status == 6)
													<a href="{{URL::to('track-order/'.$value->order_id)}}">
														<img src="{{ Helper::image_path('cancel.png') }}"class="img-fluid" style="background-color: #ff3a30; padding: 20px; border-radius: 20%;">
													</a>
												@endif
											</div>
											
											<div class="col">
												<!-- Title -->
												<p class="mb-2 font-size-sm font-weight-bold">
													<a class="text-body" href="{{URL::to('track-order/'.$value->order_id)}}">{{$value->message}}</a> <br>
													<span class="theme-cl">{{$value->order_number}}</span>
												</p>

												<!-- Text -->
												<div class="font-size-sm text-muted">
													{{$value->created_at}}
												</div>

											</div>
										</div>
									</li>
									@endforeach
								</ul>
							</div>
						</div>
						<div class="d-flex justify-content-center">
							{{$notifications->links()}}
						</div>
					</div>
				@endif
			</div>
		</div>
	</section>
@endsection