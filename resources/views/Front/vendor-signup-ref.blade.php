@extends('layouts.web')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.vendor_register') }}
@endsection

@section('content')
			
	<!-- =========================== Login/Signup =================================== -->
	<section>
		<div class="container">
			
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-lg-8 col-md-12 col-sm-12">
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
					<div class="login_signup">
					    
					    <!--{{ route('vendor.store') }}-->
						<h3 class="login_sec_title">{{ trans('labels.create_account') }}</h3>
						<form method="POST" action="{{route('vendor.store_ref') }}">
						    
						   	<!--<form method="POST" action="{{ route('vendor.store') }}"> 	-->
						    
							@csrf
							 <input type="hidden"  name="ref_name" value="{{ $ref }}" />
							<div class="row">
							   
									<input type="hidden" id="country" name="country" value="880" />
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label>{{ trans('labels.first_name') }}</label>
										<input type="text" class="form-control" name="first_name" id="first_name" value="{{old('first_name')}}" placeholder="{{ trans('labels.first_name') }}">
										@error('first_name')<span class="text-danger">{{ $message }}</span>@enderror
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label>{{ trans('labels.last_name') }}</label>
										<input type="text" class="form-control" name="last_name" id="last_name" value="{{old('last_name')}}" placeholder="{{ trans('labels.last_name') }}">
										@error('last_name')<span class="text-danger">{{ $message }}</span>@enderror
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label>{{ trans('labels.email') }}</label>
										<input type="email" class="form-control" name="email" id="email" value="{{old('email')}}" placeholder="{{ trans('labels.email') }}">
										@error('email')<span class="text-danger">{{ $message }}</span>@enderror
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label>{{ trans('labels.mobile') }}</label>
										<input type="text" class="form-control" name="mobile" id="mobile" value="{{old('mobile')}}" placeholder="{{ trans('labels.mobile') }}">
										@error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label>{{ trans('labels.password') }}</label>
										<input type="password" class="form-control" name="password" id="password" placeholder="{{ trans('labels.password') }}">
										@error('password')<span class="text-danger">{{ $message }}</span>@enderror
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label>{{ trans('labels.confirm_password') }}</label>
										<input type="password" class="form-control" name="confirmpassword" placeholder="{{ trans('labels.confirm_password') }}" value="{{old('confirmpassword')}}">
										@error('confirmpassword')<span class="text-danger">{{ $message }}</span>@enderror
									</div>
								</div>

								
								
								<div class="col-lg-12 col-md-12">
									<div class="login_flex">
										<div class="login_flex_1">
											<input name="terms" id="accept" class="checkbox-custom" type="checkbox" {{old('terms')=='on' ? 'checked' : ''}}>
											<label for="accept" class="checkbox-custom-label">{{ trans('labels.accept_the') }} <a href="{{URL::to('terms-conditions')}}"> <u>{{ trans('labels.terms_conditions') }}</u></a></label>
										</div>
										<div class="login_flex_2">
											{{ trans('labels.already_have_account') }} <a href="{{URL::to('/admin')}}" class="text-bold"> {{ trans('labels.signin') }}</a>
										</div>
									</div>
									@error('terms')<span class="text-danger">{{ $message }}</span>@enderror
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
	<!-- =========================== Login/Signup =================================== -->

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