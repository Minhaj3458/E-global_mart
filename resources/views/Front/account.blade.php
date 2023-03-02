@extends('layouts.web')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.account') }}
@endsection

@section('content')
	<!-- =========================== Breadcrumbs =================================== -->
	<div class="brd_wraps pt-2 pb-2">
		<div class="container">
			<nav aria-label="breadcrumb" class="simple_breadcrumbs">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#"><i class="ti-home"></i></a></li>
				<li class="breadcrumb-item active" aria-current="page">{{ trans('labels.account') }}</li>
			  </ol>
			</nav>
		</div>
	</div>
	<!-- =========================== Breadcrumbs =================================== -->

	<!-- =========================== My Account =================================== -->
	<section class="gray">
		<div class="container">
			<div class="row">
				@include('includes.web.order-sidebar')
				
				<div class="col-lg-8 col-md-9">

					@if(Auth::user())
						<!-- Total Items -->
						<div class="card style-2 mb-4">
							<div class="card-header">
								<h4 class="mb-0">{{ trans('labels.account') }}</h4>
							</div>
							<div class="card-body">
								<form class="submit-page" action="{{URL::to('/editprofile')}}" method="post" enctype="multipart/form-data">
									@csrf
									<div class="row">
										<div class="col-12">
										  <div class="form-group">
											<label>{{ trans('labels.name') }}</label>
											<input class="form-control" type="text" name="name" placeholder="{{ trans('labels.name') }}" value="{{Auth::user()->name}}">
											@error('name')<span class="text-danger">{{ $message }}</span>@enderror
										  </div>
										</div>
										<div class="col-12">
										  <div class="form-group">
											<label>{{ trans('labels.profile') }}</label>
											<input class="form-control" type="file" name="profile_pic">
											<input class="form-control" type="hidden" name="old_img" value="{{Auth::user()->profile_pic}}">
										  </div>
										  <img src="{{Helper::image_path(Auth::user()->profile_pic)}}" class="img-fluid mb-3" alt="" width="120px">	
										</div>
										<div class="col-12">
											<div class="form-group">
												<label> {{ trans('labels.email') }}</label>
												<input class="form-control" type="email" name="email" placeholder="{{ trans('labels.email') }}" value="{{Auth::user()->email}}" readonly disabled>
											</div>
										</div>
										<div class="col-12">
											<div class="form-group">
												<label> {{ trans('labels.mobile') }}</label>
												<input class="form-control" type="text" name="mobile" placeholder="{{ trans('labels.mobile') }}" value="{{Auth::user()->mobile}}" readonly disabled>
											</div>
										</div>
										<div class="col-12">
										  <button class="btn btn-dark" type="submit">{{ trans('labels.save') }}</button>
										</div>
									</div>
								</form>
							</div>
						</div>

						@if(Auth::user()->login_type == "email")
						<div class="card style-2 mb-4">
							<div class="card-header">
								<h4 class="mb-0">{{ trans('labels.change_password') }}</h4>
							</div>
							<div class="card-body">
								@if(Session::has('danger'))
	                            <div class="alert alert-danger">
	                                {{ Session::get('danger') }}
	                                @php
	                                    Session::forget('danger');
	                                @endphp
	                            </div>
	                            @endif
	                            @if(Session::has('success'))
	                            <div class="alert alert-success">
	                                {{ Session::get('success') }}
	                                @php
	                                    Session::forget('success');
	                                @endphp
	                            </div>
	                            @endif
								<form class="submit-page" action="{{URL::to('/changepassword')}}" method="post">
									@csrf
									<div class="row">
										<div class="col-12">
										  <div class="form-group">
											<label>{{ trans('labels.old_password') }}</label>
											<input class="form-control" type="password" name="oldpassword" placeholder="{{ trans('labels.old_password') }}" value="{{old('oldpassword')}}">
											@error('oldpassword')<span class="text-danger">{{ $message }}</span>@enderror
										  </div>
										</div>
									
										<div class="col-12">
											<div class="form-group">
												<label> {{ trans('labels.new_password') }}</label>
												<input class="form-control" type="password" name="newpassword" placeholder="{{ trans('labels.new_password') }}" value="{{old('newpassword')}}">
												@error('newpassword')<span class="text-danger">{{ $message }}</span>@enderror
											</div>
										</div>
										<div class="col-12">
											<div class="form-group">
												<label>{{ trans('labels.confirm_password') }}</label>
												<input class="form-control" type="password" name="confirmpassword" placeholder="{{ trans('labels.confirm_password') }}" value="{{old('confirmpassword')}}">
												@error('confirmpassword')<span class="text-danger">{{ $message }}</span>@enderror
											</div>
										</div>
										<div class="col-12">
										  <button class="btn btn-dark" type="submit">{{ trans('labels.save') }}</button>
										</div>
									
									</div>
								</form>
							</div>
						</div>
						@endif
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
@endsection