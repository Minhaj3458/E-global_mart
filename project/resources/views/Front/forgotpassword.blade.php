@extends('layouts.web')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.forgot_password') }}
@endsection

@section('content')	
	
	<!-- =========================== Forgot-password =================================== -->
	<section>
		<div class="container">
			
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-lg-6 col-md-6 col-sm-6">
					<div class="login_signup">
						@if (\Session::has('danger'))

						    <div class="alert alert-danger">

						        {{Session::get('danger')}}

						    </div>

						@endif

						@if (\Session::has('success'))

						    <div class="alert alert-success">

						        {{Session::get('success')}}

						    </div>

						@endif
						<h3 class="login_sec_title">{{ trans('labels.forgot_password') }}</h3>
						<form action="{{ URL::to('send-pass') }}" method="post">
							@csrf
							<div class="form-group">
								<label>{{ trans('labels.email') }}</label>
								<input type="text" name="email" class="form-control" placeholder="{{trans('placeholder.email')}}">
								@error('email') <span class="text-danger">{{$message}}</span> @enderror
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-md btn-theme col-md-12 mt-3">{{ trans('labels.submit') }}</button>
							</div>
						</form>
						<div class="text-center">
							<a href="{{ URL::to('/signin') }}"> {{trans('labels.already_user')}} {{trans('labels.signin')}}</a>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>
	<!-- =========================== Forgot-password =================================== -->
@endsection