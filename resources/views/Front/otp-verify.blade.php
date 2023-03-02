@extends('layouts.web')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.otp_verify') }}
@endsection

@section('content')	
	
	<!-- =========================== Login =================================== -->
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
						<h3 class="login_sec_title">{{ trans('labels.otp_verify') }}</h3>
						<form action="{{ URL::to('otp-verification') }}" method="post">
							@csrf
							<div class="row">

							    <div class="col-lg-12 col-md-12">
							    	<div class="form-group">
							    		<input type="email" name="email" id="email" placeholder="{{ trans('labels.email') }}" class="form-control" value="{{Session::get('email')}}" readonly="">
							    		@error('email')<span class="text-danger">{{ $message }}</span>@enderror
							    	</div>
							    </div>
							    
							    <div class="col-lg-12 col-md-12">
							    	<div class="form-group">
							    		<input type="number" name="otp" id="otp" min="1" maxlength="6" placeholder="{{ trans('labels.verification_code') }}" class="form-control" required="">
							    		@error('otp')<span class="text-danger">{{ $message }}</span>@enderror
							    	</div>
							    </div>

							    <div class="col-lg-12 col-md-12">
							    	<p class="already">{{ trans('labels.email_not_receive') }}
							    		<span class="Btn" id="verifiBtn"></span><span id="timer"></span>
							    	</p>
							    </div>

								<div class="col-lg-12 col-md-12">
									<div class="form-group">
										<button type="submit" class="btn btn-md btn-theme col-md-12 mt-3">{{ trans('labels.verify') }}</button>
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

<script>
    let timerOn = true;

    function timer(remaining) {
      var m = Math.floor(remaining / 60);
      var s = remaining % 60;
      
      m = m < 10 ? '0' + m : m;
      s = s < 10 ? '0' + s : s;
      document.getElementById('timer').innerHTML = m + ':' + s;
      remaining -= 1;
      
      if(remaining >= 0 && timerOn) {
        setTimeout(function() {
            timer(remaining);
        }, 1000);
        return;
      }

      if(!timerOn) {
        // Do validate stuff here
        return;
      }
      
      // Do timeout stuff here
      document.getElementById("verifiBtn").innerHTML = `<a href="{{URL::to('resend-otp')}}">Resend</a>`;
      document.getElementById("timer").innerHTML = "";
    }

    timer(120);
</script>

@endsection