@extends('layouts.web')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.address') }}
@endsection

@section('content')
	<!-- =========================== Breadcrumbs =================================== -->
	<div class="brd_wraps pt-2 pb-2">
		<div class="container">
			<nav aria-label="breadcrumb" class="simple_breadcrumbs">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#"><i class="ti-home"></i></a></li>
				<li class="breadcrumb-item active" aria-current="page">{{ trans('labels.address') }}</li>
			  </ol>
			</nav>
		</div>
	</div>
	<!-- =========================== Breadcrumbs =================================== -->

	<!-- =========================== My Address =================================== -->
	<section class="gray">
		<div class="container">
			<div class="row">
				@include('includes.web.order-sidebar')
				
				<div class="col-lg-8 col-md-9">
					@if(Auth::user())
						<div class="row">
							@foreach ($myaddress as $myadd)
							<!-- Single card -->
							<div class="col-lg-6 col-md-6">
								<div class="card-header">
									<h4>{{$myadd->first_name}} {{$myadd->last_name}}
										<p class="float-right">
											<span class="badge badge-success" onclick="getAddress('{{$myadd->id}}','{{$myadd->first_name}}','{{$myadd->last_name}}','{{$myadd->street_address}}','{{$myadd->landmark}}','{{$myadd->pincode}}','{{$myadd->email}}','{{$myadd->mobile}}')">{{ trans('labels.edit') }}</span> <span class="badge badge-danger" onclick="DeleteAddress('{{$myadd->id}}')">{{ trans('labels.delete') }}</span>
										</p>
									</h4>
								</div>
								<div class="add-payment-card">
									<div class="ap-card-body">
										<div class="ml-auto mb-3">{{$myadd->street_address}} {{$myadd->landmark}} - {{$myadd->pincode}}</div>
										<div class="ml-auto mb-3">{{$myadd->mobile}}</div>
										<div class="ml-auto mb-3">{{$myadd->email}}</div>
									</div>
								</div>
							</div>
							@endforeach

							<!-- Single card -->
							<div class="col-lg-6 col-md-6">
								<div class="add-payment-card center">
									<div class="add-pay-card">
										<a href="#" data-toggle="modal" data-target="#AddAddress" class="btn btn-pay"><i class="ti-home"></i></a>
									</div>
									<span>{{ trans('labels.add_address') }}</span>
								</div>
							</div>
						
						</div>
					@else
						<div class="text-center">
							<img src="{{Helper::image_path('no-data.png')}}">
							<h2 class="error_title mt-4">{{ trans('labels.please_login') }}</h2>
							<a href="{{URL::to('/signin')}}" class="btn btn-primary">{{ trans('labels.login') }}</a>
						</div>
					@endif
				</div>
			</div>
		</div>
	</section>
	<!-- =========================== My All Orders =================================== -->

	<!-- Modal Edit Address-->
	<div class="modal fade text-left" id="EditAddress" tabindex="-1" role="dialog" aria-labelledby="RditProduct"
	aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <label class="modal-title text-text-bold-600" id="RditProduct">{{ trans('labels.edit_address') }}</label>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div id="errorr" style="color: red;"></div>
	      
	      <form method="post" action="{{ URL::to('editaddress') }}" method="post">
	      {{csrf_field()}}
	        <div class="modal-body">
	        	<input class="form-control" type="hidden" name="address_id" id="data-id">

	        	<div class="form-row">
					<div class="form-group col-md-6">
					  	<label>{{ trans('labels.first_name') }}</label>
					  	<input class="form-control" type="text" name="first_name" id="data-firstname" placeholder="{{ trans('labels.first_name') }}" required="">
					</div>
					
					<div class="form-group col-md-6">
					  	<label>{{ trans('labels.last_name') }}</label>
			          	<input class="form-control" type="text" name="last_name" id="data-lastname" placeholder="{{ trans('labels.last_name') }}" required="">
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-md-6">
					  	<label>{{ trans('labels.email') }}</label>
			          	<input class="form-control" type="text" name="email" id="data-email" placeholder="{{ trans('labels.email') }}" required="">
					</div>
					
					<div class="form-group col-md-6">
						<label>{{ trans('labels.mobile') }}</label>
			          	<input class="form-control" type="text" name="mobile" id="data-mobile" placeholder="{{ trans('labels.mobile') }}" required="">
					</div>
				</div>

				<div class="form-group col-md-12">
				  	<label>{{ trans('labels.street_address') }}</label>
		          	<textarea class="form-control" name="street_address" id="data-address" placeholder="{{ trans('labels.street_address') }}" required=""></textarea>
				</div>

				<div class="form-row">
											
					<div class="form-group col-md-6">
						<label>{{ trans('labels.landmark') }}</label>
			          	<input class="form-control" type="text" name="landmark" id="data-landmark" placeholder="{{ trans('labels.landmark') }}" required="">
					</div>

		            <div class="form-group col-md-6">
			          	<label>{{ trans('labels.pincode') }}</label>
			          	<input class="form-control" type="text" name="pincode" id="data-pincode" placeholder="{{ trans('labels.pincode') }}" required="">
		            </div>
				</div>

	        </div>
	        <div class="modal-footer">
	          <input type="submit" class="btn btn-theme" value="{{ trans('labels.submit') }}">
	        </div>
	      </form>
	    </div>
	  </div>
	</div>

	<!-- Modal Add Address-->
	<div class="modal fade text-left" id="AddAddress" tabindex="-1" role="dialog" aria-labelledby="RditProduct"
	aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <label class="modal-title text-text-bold-600" id="RditProduct">{{ trans('labels.add_address') }}</label>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div id="errorr" style="color: red;"></div>
	      
	      <form method="post" action="{{ URL::to('saveaddress') }}" method="post">
	      {{csrf_field()}}
	        <div class="modal-body">
	        	<input class="form-control" type="hidden" name="address_id">

	        	<div class="form-row">
					<div class="form-group col-md-6">
					  	<label>{{ trans('labels.first_name') }}</label>
					  	<input class="form-control" type="text" name="first_name" placeholder="{{ trans('labels.first_name') }}" required="">
					</div>
					
					<div class="form-group col-md-6">
					  	<label>{{ trans('labels.last_name') }}</label>
			          	<input class="form-control" type="text" name="last_name" placeholder="{{ trans('labels.last_name') }}" required="">
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-md-6">
					  	<label>{{ trans('labels.email') }}</label>
			          	<input class="form-control" type="text" name="email" placeholder="{{ trans('labels.email') }}" required="">
					</div>
					
					<div class="form-group col-md-6">
						<label>{{ trans('labels.mobile') }}</label>
			          	<input class="form-control" type="text" name="mobile" placeholder="{{ trans('labels.mobile') }}" required="">
					</div>
				</div>

				<div class="form-group col-md-12">
				  	<label>{{ trans('labels.street_address') }}</label>
		          	<textarea class="form-control" name="street_address" placeholder="{{ trans('labels.street_address') }}" required=""></textarea>
				</div>

				<div class="form-row">
											
					<div class="form-group col-md-6">
						<label>{{ trans('labels.landmark') }}</label>
			          	<input class="form-control" type="text" name="landmark" placeholder="{{ trans('labels.landmark') }}" required="">
					</div>

		            <div class="form-group col-md-6">
			          	<label>{{ trans('labels.pincode') }}</label>
			          	<input class="form-control" type="text" name="pincode" placeholder="{{ trans('labels.pincode') }}" required="">
		            </div>
				</div>

	        </div>
	        <div class="modal-footer">
	          <input type="submit" class="btn btn-theme" value="{{ trans('labels.submit') }}">
	        </div>
	      </form>
	    </div>
	  </div>
	</div>
@endsection

@section('scripttop')
<script type="text/javascript">
	function getAddress(id,firstname,lastname,streetaddress,landmark,pincode,email,mobile) {

	     $("#data-id").val(id);
	     $("#data-firstname").val(firstname);
	     $("#data-lastname").val(lastname);
	     $("#data-address").val(streetaddress);
	     $("#data-landmark").val(landmark);
	     $("#data-pincode").val(pincode);
	     $("#data-email").val(email);
	     $("#data-mobile").val(mobile);
	     $('#EditAddress').modal('show');
	};

	function DeleteAddress(id) {
	    swal({
	        title: "Are you sure?",
	        text: "Are you sure want to Delete this address ?",
	        type: "warning",
	        showCancelButton: true,
	        confirmButtonClass: "btn-danger",
	        confirmButtonText: "Yes, Delete it!",
	        cancelButtonText: "No, cancel plz!",
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
	                url:"{{ URL::to('deleteaddress') }}",
	                data: {
	                    id: id
	                },
	                method: 'POST',

	                success: function(response) {
	                    if (response.status == 1) {
	                        swal({
	                            title: "Approved!",
	                            text: "Address has been deleted.",
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
</script>
@endsection