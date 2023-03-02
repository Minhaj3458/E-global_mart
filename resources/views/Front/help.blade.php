@extends('layouts.web')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.help') }}
@endsection

@section('content')
	<!-- =========================== Breadcrumbs =================================== -->
	<div class="brd_wraps pt-2 pb-2">
		<div class="container">
			<nav aria-label="breadcrumb" class="simple_breadcrumbs">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#"><i class="ti-home"></i></a></li>
				<li class="breadcrumb-item active" aria-current="page">{{ trans('labels.help') }}</li>
			  </ol>
			</nav>
		</div>
	</div>
	<!-- =========================== Breadcrumbs =================================== -->

	<!-- =========================== Help =================================== -->

   	<section class="gray">
   		<div class="container">
   			
   			<div class="row mt-12 align-items-center">
   				<div class="col-lg-12 col-md-12">
   					@if(Session::has('success'))
   					<div class="alert alert-success">
   					    {{ Session::get('success') }}
   					    @php
   					        Session::forget('success');
   					    @endphp
   					</div>
   					@endif
   					<div class="contact-form">
   						<form method="post" action="{{URL::to('/helpform')}}">
   							@csrf
   							<div class="form-row">
   							
   								<div class="form-group col-md-6">
   								  <label>{{ trans('labels.first_name') }}</label>
   								  <input type="text" class="form-control" name="first_name" placeholder="{{ trans('labels.first_name') }}">
   								  @error('first_name')<span class="text-danger">{{ $message }}</span>@enderror
   								</div>
   								
   								<div class="form-group col-md-6">
   								  <label>{{ trans('labels.last_name') }}</label>
   								  <input type="text" class="form-control" name="last_name" placeholder="{{ trans('labels.last_name') }}">
   								  @error('last_name')<span class="text-danger">{{ $message }}</span>@enderror
   								</div>
   							</div>
   							<div class="form-row">
   							
   								<div class="form-group col-md-6">
   								  <label>{{ trans('labels.email') }}</label>
   								  <input type="email" class="form-control" name="email" placeholder="{{ trans('labels.email') }}">
   								  @error('email')<span class="text-danger">{{ $message }}</span>@enderror
   								</div>
   								
   								<div class="form-group col-md-6">
   								  <label>{{ trans('labels.mobile') }}</label>
   								  <input type="text" class="form-control" name="mobile" placeholder="{{ trans('labels.mobile') }}">
   								  @error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
   								</div>
   							</div>
   							
   							<div class="form-group col-lg-12 col-md-12">
   								<label>{{ trans('labels.subject') }}</label>
   								<input type="text" class="form-control" name="subject" placeholder="{{ trans('labels.subject') }}">
   								@error('subject')<span class="text-danger">{{ $message }}</span>@enderror
   							</div>
   							
   							<div class="form-group col-lg-12 col-md-12">
   								<label>{{ trans('labels.message') }}</label>
   								<textarea class="form-control" name="message" placeholder="{{ trans('labels.message') }}"></textarea>
   								@error('message')<span class="text-danger">{{ $message }}</span>@enderror
   							</div>
   							
   							<div class="form-group col-lg-12 col-md-12">
   								<button type="submit" class="btn btn-primary">Send Request</button>
   							</div>
   							
   						</form>
   					</div>
   				</div>
   				
   			</div>
   			
   		</div>
   	</section>
	<!-- =========================== Help =================================== -->

@endsection

@section('scripttop')

@endsection