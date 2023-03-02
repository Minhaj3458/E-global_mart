@extends('layouts.web')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.order_details') }}
@endsection

@section('content')
	<!-- =========================== Breadcrumbs =================================== -->
	<div class="brd_wraps pt-2 pb-2">
		<div class="container">
			<nav aria-label="breadcrumb" class="simple_breadcrumbs">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{URL::to('/')}}"><i class="ti-home"></i></a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{URL::to('order-history')}}">{{ trans('labels.order_details') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page">{{$order_infos['order_number']}}</li>
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
						<h2 class="error_title mt-4">{{ trans('labels.no_data') }}</h2>
						<p><span class="text-primary">{{trans('labels.woops')}}</span> {{ trans('labels.try_another_order') }}</p>
						<a href="{{URL::to('/')}}" class="btn btn-primary">{{ trans('labels.go_home_page') }}</a>
					</div>
				@else
					<div class="col-lg-8 col-md-9">
						<div class="card-body bg-white mb-4">
							<div class="row">
								<div class="col-6 col-lg-3">
									<h6 class="text-muted mb-1">{{ trans('labels.order_number') }}</h6>
									<p class="mb-lg-0 font-size-sm font-weight-bold">{{$order_infos['order_number']}}</p>
								</div>
								
								<div class="col-6 col-lg-3">
									<h6 class="text-muted mb-1">{{ trans('labels.date') }}</h6>
									<p class="mb-lg-0 font-size-sm font-weight-bold">
										<span>{{$order_infos['date']}}</span>
									</p>
								</div>
								
								<div class="col-6 col-lg-3">
									<h6 class="text-muted mb-1">{{ trans('labels.payment_type') }}</h6>
									<p class="mb-0 font-size-sm font-weight-bold">
										@if($order_infos['payment_type'] == 1)
											{{ trans('labels.COD') }}
										@endif
										@if($order_infos['payment_type'] == 2)
											{{ trans('labels.Wallet') }}
										@endif
										@if($order_infos['payment_type'] == 3)
											{{ trans('labels.RazorPay') }}
										@endif
										@if($order_infos['payment_type'] == 4)
											{{ trans('labels.Stripe') }}
										@endif
										@if($order_infos['payment_type'] == 5)
											{{ trans('labels.Flutterwave') }}
										@endif
										@if($order_infos['payment_type'] == 6)
											{{ trans('labels.Paystack') }}
										@endif
									</p>
								</div>
								
								<div class="col-6 col-lg-3">
									<!-- Heading -->
									<h6 class="text-muted mb-1">{{ trans('labels.order_amount') }}</h6>
									<p class="mb-0 font-size-sm font-weight-bold">{{Helper::CurrencyFormatter($order_infos['grand_total'])}}</p>
								</div>
								
							</div>
						</div>
						
						<!-- Order Items -->
						<div class="card style-2 mb-4">
							<div class="card-header">
								<h4 class="mb-0">{{ trans('labels.order_items') }} {{count($orderdata)}}</h4>
							</div>
							<div class="card-body">
								<ul class="item-groups">
									@foreach ($orderdata as $value)
									<li style="border: none;">
										<div class="row align-items-center">
											<div class="col-4 col-md-3 col-xl-2">
												<a href="#"><img src="{{$value->image_url}}" alt="..." class="img-fluid" style="width: 800px; object-fit: scale-down;"></a>
											</div>
											<div class="col">
												<!-- Title -->
												<p class="mb-2 font-size-sm font-weight-bold">
													<a class="text-body" href="{{URL::to('products/product-details/'.$value->slug)}}">{{$value->product_name}}</a>
												</p>

												<div class="page-header">
												  	<div class="float-left">
												  		@if($value->variation != "")
												  	 		{{$value->attribute}} : {{$value->variation}}<br>
												  		@endif
												  	</div>
												  	<div class="float-right">
													  	@if($value['status'] == 5)
													  		<p class="theme-cl">{{trans('labels.cancelled_by_vendor')}}</p>
													  	@endif
													  	@if($value['status'] == 6)
													  		<p class="theme-cl">{{trans('labels.cancelled_by_user')}}</p>
													  	@endif
												  	</div>
												  	<div class="clearfix"></div>
												</div>

												<div class="page-header">
												  	<div class="float-left">
												  		{{ trans('labels.qty') }} : {{$value->qty}} * {{Helper::CurrencyFormatter($value->price )}}
												  	</div>
												</div>
											</div>
										</div>
									</li>
									<div class="row">
										<div class="col-6 col-lg-3 text-center">
											<h6 class="text-muted mb-1">{{ trans('labels.shipping') }}</h6>
											<p class="mb-lg-0 font-size-sm font-weight-bold">{{Helper::CurrencyFormatter($value->shipping_cost)}}</p>
										</div>
										<div class="col-6 col-lg-3 text-center">
											<h6 class="text-muted mb-1">{{ trans('labels.tax') }}</h6>
											<p class="mb-lg-0 font-size-sm font-weight-bold">{{Helper::CurrencyFormatter($value->tax)}}</p>
										</div>
										<div class="col-6 col-lg-3 text-center">
											<h6 class="text-muted mb-1">{{ trans('labels.discount') }}</h6>
											@if($value->discount_amount != "")
												<p class="mb-lg-0 font-size-sm font-weight-bold">{{Helper::CurrencyFormatter($value->discount_amount)}}</p>
											@else
												<p class="mb-lg-0 font-size-sm font-weight-bold">{{Helper::CurrencyFormatter(0)}}</p>
											@endif
										</div>

										<div class="col-6 col-lg-3 text-center">
											<h6 class="text-muted mb-1">{{ trans('labels.total') }}</h6>
											<p class="mb-lg-0 font-size-sm font-weight-bold">{{Helper::CurrencyFormatter($value->price * $value->qty+$value->tax+$value->shipping_cost)}}
											</p>
										</div>

										<div class="col-6 col-lg-12 text-right mt-3">
											<div class="page-header">
											  	<div class="float-right">
											  		<a href="{{URL::to('track-order/'.$value->id)}}" class="btn btn-sm btn-success">{{ trans('labels.track_order') }}</a>
											  		@if($value['status'] != 2 && $value['status'] != 4 && $value['status'] != 5 && $value['status'] != 6 && $value['status'] != 7 && $value['status'] != 8 && $value['status'] != 9 && $value['status'] != 10)
											  			<a href="javascript::void()" onclick="CancelOrder('{{$value->id}}')" class="btn btn-sm btn-theme">{{ trans('labels.cancel_order') }}</a>
											  		@endif
												  	@if($value['status'] == 4)
												  		<a href="javascript::void()" data-order-id="{{$value->id}}" data-status="7" class="btn btn-sm btn-theme reject">{{ trans('labels.return') }}</a>
												  	@endif
											  	</div>
											  	<div class="clearfix"></div>
											</div>
										</div>
									</div>
									<li></li>
									@endforeach
								</ul>
							</div>
						</div>
						
						<!-- Total Items -->
						<div class="card style-2 mb-4">
							<div class="card-header">
								<h4 class="mb-0">{{ trans('labels.total_orders') }}</h4>
							</div>
							<div class="card-body">
								<ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
									<li class="list-group-item d-flex">
										<span>{{ trans('labels.subtotal') }}</span>
										<span class="ml-auto">{{Helper::CurrencyFormatter($order_infos['subtotal'])}}</span>
									</li>
								
									<li class="list-group-item d-flex">
										<span>{{ trans('labels.tax') }}</span>
										<span class="ml-auto">{{Helper::CurrencyFormatter($order_infos['tax'])}}</span>
									</li>
									
									<li class="list-group-item d-flex">
										<span>{{ trans('labels.shipping') }}</span>
										<span class="ml-auto">{{Helper::CurrencyFormatter($order_infos['shipping_cost'])}}</span>
									</li>
									@if(@$order_infos['discount_amount'] != "" && @$order_infos['discount_amount'] != 0)
									<li class="list-group-item d-flex">
										<span>{{ trans('labels.discount') }}</span>
										<span class="ml-auto">{{Helper::CurrencyFormatter($order_infos['discount_amount'])}}</span>
									</li>
									@endif
									<li class="list-group-item d-flex font-size-lg font-weight-bold">
										<span>{{ trans('labels.ttl') }}</span>
										<span class="ml-auto">{{Helper::CurrencyFormatter($order_infos['grand_total'])}}</span>
									</li>
								</ul>
							</div>
						</div>
						
						<!-- Shipping & Billing -->
						<div class="card style-2">
							<div class="card-header">
								<h4 class="mb-0">{{ trans('labels.billing_details') }}</h4>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-12 col-md-6">

										<p class="mb-7 mb-md-0">
										  {{$order_infos['full_name']}}, <br>
										  {{$order_infos['email']}}, <br>
										  {{$order_infos['mobile']}}
										</p>

									</div>
								  
									<div class="col-12 col-md-6">
										<!-- Heading -->
										<p class="mb-2 font-weight-bold">
										  {{ trans('labels.shipping_address') }}
										</p>

										<p class="mb-7 mb-md-0">
										  {{$order_infos['street_address']}}, <br>
										  @if($order_infos['landmark'] != "")
										  	{{$order_infos['landmark']}}, <br>
										  @endif
										  {{$order_infos['pincode']}}
										</p>
									</div>
								</div>
							</div>
						</div>
					
				</div>
				@endif
				
			</div>
		</div>
	</section>

	<!-- Modal -->
	<div id="RejectReturn" class="modal fade" role="dialog">
	  	<div class="modal-dialog">

	    	<!-- Modal content-->
	    	<div class="modal-content">
	      		<div class="modal-header"><h4 class="modal-title text-left">{{ trans('labels.write_reason') }}</h4></div>
      			<div class="modal-body">
					<form>
						@foreach($returnconditions as $conditions)
							<label>
								<input type="radio" data-conditions="{{$conditions['return_conditions']}}" name="conditions" class="" >
								<span for="{{$conditions['return_conditions']}}">{{$conditions['return_conditions']}}</span>
							</label><hr>
						@endforeach
			          	<div class="form-group">
				            <input type="hidden" name="order_id" id="data-order-id">
				            <input type="hidden" name="status" id="data-status">
				            <label for="comment" class="col-form-label">{{ trans('labels.comment') }}</label>
				            <textarea class="form-control" id="comment" rows="4" name="comment"></textarea>
			          	</div>
			        </form>
      			</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">{{ trans('labels.close') }}</button>
		        	<button type="button" class="btn btn-sm btn-primary" onclick="StatusUpdate()">{{ trans('labels.submit') }}</button>
		      	</div>
		    </div>
	  	</div>
	</div>
	<!-- =========================== My All Orders =================================== -->

@endsection

@section('scripttop')
<script type="text/javascript">
	function CancelOrder(id) {
	    swal({
	        title: "Are you sure?",
	        text: "Are you sure want to cancel this order ?",
	        type: "warning",
	        showCancelButton: true,
	        confirmButtonClass: "btn-danger",
	        confirmButtonText: "Yes, cancel it!",
	        cancelButtonText: "No!",
	        closeOnConfirm: false,
	        closeOnCancel: false,
	        showLoaderOnConfirm: true,
	    },
	    function(isConfirm) {
	        if (isConfirm) {
	            $.ajax({
	                headers: {
	                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                },
	                url:"{{ URL::to('cancelorder') }}",
	                data: {
	                    id: id
	                },
	                method: 'POST',

	                success: function(response) {
	                    if (response.status == 1) {
	                        swal({
	                            title: "Approved!",
	                            text: "Order has been cancelled.",
	                            type: "success",
	                            showCancelButton: true,
	                            confirmButtonClass: "btn-danger",
	                            confirmButtonText: "Ok",
	                            closeOnConfirm: false,
	                            showLoaderOnConfirm: true,
	                        },
	                        function(isConfirm) {
	                            if (isConfirm) {
	                                swal.close();
	                                location.reload();
	                            }
	                        });
	                    } else {
	                        swal("Cancelled", "Something Went Wrong :(", "error");
	                    }
	                },
	                error: function(e) {
	                    swal("Cancelled", "Something Went Wrong :(", "error");
	                }
	            });
	        } else {
	            swal("Cancelled", "Your record is safe :)", "error");
	        }
	    });
	}

	function StatusUpdate() {

	    var id=$('#data-order-id').val();
	    var status=$('#data-status').val();
	    var return_reason =  $('input[name="conditions"]:checked').attr("data-conditions");
	    var comment=$('#comment').val();

	    $('#preloader').show();
	    $.ajax({
	        headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
	        url:"{{ URL::to('returnrequest') }}",
	        type: "POST",
	        data : {'id':id,'status':status,'return_reason':return_reason,'comment':comment},
	        success:function(response)
	        { 
	            $('#preloader').hide();
	            location.reload();
	        },error:function(response){
	            $('#preloader').hide();
	            console.log("AJAX error in request: " + JSON.stringify(response, null, 2));
	        }
	    });
	}

	$(document).ready(function(){
	   $(".reject").click(function(){ // Click to only happen on announce links

	     $("#data-order-id").val($(this).attr('data-order-id'));
	     $("#data-status").val($(this).attr('data-status'));
	     $('#RejectReturn').modal('show');
	   });
	});
</script>
@endsection