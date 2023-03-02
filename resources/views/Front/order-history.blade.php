@extends('layouts.web')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.order_history') }}
@endsection

@section('content')
	<!-- =========================== Breadcrumbs =================================== -->
	<div class="brd_wraps pt-2 pb-2">
		<div class="container">
			<nav aria-label="breadcrumb" class="simple_breadcrumbs">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{URL::to('/')}}"><i class="ti-home"></i></a></li>
				<li class="breadcrumb-item active" aria-current="page">{{ trans('labels.order_history') }}</li>
			  </ol>
			</nav>
		</div>
	</div>
	<!-- =========================== Breadcrumbs =================================== -->

	<!-- =========================== My All Orders =================================== -->
	<section class="gray">
		<div class="container">
			<div class="row">
				
				@include('includes.web.order-sidebar')

				@if(count($orderdata) <= 0)
					<div class="col-lg-8 col-md-9 col-sm-12 col-12 text-center">
						<img src="{{Helper::image_path('no-data.png')}}">
						<h2 class="error_title mt-4">{{ trans('labels.no_order') }}</h2>
						<p><span class="text-primary">{{trans('labels.woops')}}</span> {{ trans('labels.orders_not_found') }}</p>
						<a href="{{URL::to('/')}}" class="btn btn-primary">{{ trans('labels.go_home_page') }}</a>
					</div>
				@else
			
					<div class="col-lg-8 col-md-9 col-sm-12 col-12">
					
						<!-- Order Items -->
						<div class="card style-2">
							<div class="card-header">
								<h4 class="mb-0">{{trans('labels.total_orders')}}</h4>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table">
										<thead>
											<tr>
												<th scope="col">{{ trans('labels.order_number') }}</th>
												<th scope="col">{{ trans('labels.payment_type') }}</th>
												<th scope="col">{{ trans('labels.price') }}</th>
												<th scope="col">{{ trans('labels.date') }}</th>
												<th scope="col">{{ trans('labels.action') }}</th>
											</tr>
										</thead>
										<tbody>
											<!-- payment_type = COD : 1, Wallet : 2, RazorPay : 3, Stripe : 4, Flutterwave : 5 -->
											@foreach($orderdata as $orders)
											<tr>
												<td><a href="{{URL::to('order-details/'.$orders->order_number)}}"> {{$orders->order_number}}</a></td>
												<td>
													@if($orders->payment_type == 1)
														{{ trans('labels.COD') }}
													@endif
													@if($orders->payment_type == 2)
														{{ trans('labels.Wallet') }}
													@endif
													@if($orders->payment_type == 3)
														{{ trans('labels.RazorPay') }}
													@endif
													@if($orders->payment_type == 4)
														{{ trans('labels.Stripe') }}
													@endif
													@if($orders->payment_type == 5)
														{{ trans('labels.Flutterwave') }}
													@endif
													@if($orders->payment_type == 6)
														{{ trans('labels.Paystack') }}
													@endif
												</td>
												<td>{{Helper::CurrencyFormatter($orders->grand_total)}}</td>
												<td>{{$orders->date}}</td>
												<td><a href="{{URL::to('order-details/'.$orders->order_number)}}" class="btn btn-sm btn-theme">{{ trans('labels.view_order') }}</a></td>
											</tr>
											@endforeach
										</tbody>
									</table>
									<div class="d-flex justify-content-center ">
										{{$orderdata->links()}}
									</div>

								</div>
							</div>
						</div>
						
					</div>						
				@endif
			</div>
		</div>
	</section>
	<!-- =========================== My All Orders =================================== -->
@endsection