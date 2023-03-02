@extends('layouts.web')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.signup') }}
@endsection

@section('content')	
	
	<!-- =========================== User-signup =================================== -->
	<section>
		<div class="container">
			
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-lg-6 col-md-6 col-sm-6">
					<div class="login_signup">
						<h3 class="login_sec_title">{{ trans('labels.signup') }}</h3>
						<form action="{{ URL::to('/register') }}" method="post">
							@csrf
							<div class="row">

								<input type="hidden" id="country" name="country" value="880" />
							    <div class="col-lg-6 col-md-6">
							    	<div class="form-group">
							    		<input type="text" class="form-control" name="name" placeholder="{{ trans('labels.name') }}" value="{{Session::get('name')}}">
							    		@error('name')<span class="text-danger">{{ $message }}</span>@enderror
							    	</div>
							    </div>
							    
							    <div class="col-lg-6 col-md-6">
							    	<div class="form-group">
							    		<input type="email" class="form-control" name="email" placeholder="{{ trans('labels.email') }}" value="{{ Session::get('email') }}">
							    		@error('email')<span class="text-danger">{{ $message }}</span>@enderror
							    	</div>
							    </div>

							    <div class="col-lg-12 col-md-12">
							    	<div class="form-group">
							    		<input type="text" class="form-control" name="mobile" id="mobile" placeholder="{{ trans('labels.mobile') }}">
							    		@error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
							    	</div>
							    </div>
							    
							    @if (Session::has('facebook_id') OR Session::has('google_id'))
							    @else
							    	<div class="col-lg-6 col-md-6">
							    		<div class="form-group">
							    			<input type="password" class="form-control" name="password" placeholder="{{ trans('labels.password') }}">
							    			@error('password')<span class="text-danger">{{ $message }}</span>@enderror
							    		</div>
							    	</div>

							    	<div class="col-lg-6 col-md-6">
							    		<div class="form-group">
							    			<input type="password" class="form-control" name="password_confirmation" placeholder="{{ trans('labels.confirm_password') }}">
							    			@error('password_confirmation')<span class="text-danger">{{ $message }}</span>@enderror
							    		</div>
							    	</div>
							    @endif

							    <div class="col-lg-12 col-md-12">
							    	<div class="form-group">
							    		<input type="text" class="form-control" name="referral_code" placeholder="{{ trans('labels.referral_code') }}" value="{{ Request()->referral_code }}">
							    	</div>
							    </div>

								<div class="col-lg-12 col-md-12">
									<div class="login_flex">
										<div class="login_flex_1">
											<input name="accept" id="accept" class="checkbox-custom" type="checkbox">
											<label for="accept" class="checkbox-custom-label">{{ trans('labels.accept_the') }} <a href="{{URL::to('terms-conditions')}}"> <u>{{ trans('labels.terms_conditions') }}</u></a></label>
										</div>
										<div class="login_flex_2">
											{{ trans('labels.already_have_account') }} <a href="{{URL::to('/signin')}}" class="text-bold"> {{ trans('labels.signin') }}</a>
										</div>
									</div>
									@error('accept')<span class="text-danger">{{ $message }}</span>@enderror
									<div class="form-group">
										<button type="submit" class="btn btn-md btn-theme col-md-12 mt-3">{{ trans('labels.signup') }}</button>
									</div>
								</div>

							</div>
						
						
						</form>
					</div>
				</div>

			</div>
		</div>
	</section>
	<!-- =========================== User-Signup =================================== -->

@endsection

@section('scripttop')
<!-- REQUIRED CDN  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"
        integrity="sha512-DNeDhsl+FWnx5B1EQzsayHMyP6Xl/Mg+vcnFPXGNjUZrW28hQaa1+A4qL9M+AiOMmkAhKAWYHh1a+t6qxthzUw=="
        crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css"
    integrity="sha512-yye/u0ehQsrVrfSd6biT17t39Rg9kNc+vENcCXZuMz2a+LWFGvXUnYuWUW6pbfYj1jcBb/C39UZw2ciQvwDDvg=="
    crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
    integrity="sha512-BNZ1x39RMH+UYylOW419beaGO0wqdSkO7pi1rYDYco9OL3uvXaC/GTqA5O4CVK2j4K9ZkoDNSSHVkEQKkgwdiw=="
    crossorigin="anonymous"></script>
<!-- JAVASCRIPT CODE REQUIRED -->
<script>
    var input = $('#mobile');
    var country = $('#country');
    var iti = intlTelInput(input.get(0))
    iti.setCountry("bd");

    // listen to the telephone input for changes
    input.on('countrychange', function(e) {
      // change the hidden input value to the selected country code
      country.val(iti.getSelectedCountryData().dialCode);
    });
</script>
@endsection