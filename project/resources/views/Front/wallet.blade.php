@extends('layouts.web')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.wallet') }}
@endsection

@section('content')
	<!-- =========================== Breadcrumbs =================================== -->
	<div class="brd_wraps pt-2 pb-2">
		<div class="container">
			<nav aria-label="breadcrumb" class="simple_breadcrumbs">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#"><i class="ti-home"></i></a></li>
				<li class="breadcrumb-item active" aria-current="page">{{ trans('labels.wallet') }}</li>
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
				
				<div class="col-lg-8 col-md-9">
					@if(Auth::user())
						<div class="checked-shop">
							
							<div class="row">
								<div class="col-6">
									<ul class="track_order_list">
									
										<!-- Single List -->
										<li>
											<div class="trach_single_list">
												<div class="trach_icon_list"><i class="ti-wallet"></i></div>
												<div class="track_list_caption">
													<h4 class="mb-0">{{ trans('labels.wallet_balance') }}</h4>
													<h2>{{Helper::CurrencyFormatter($walletamount->wallet)}}</h2>
												</div>
											</div>
										</li>
										
									</ul>
								</div>
								<div class="col-6">
									<ul class="track_order_list" data-toggle="modal" data-target="#RechargeWallet">
									
										<!-- Single List -->
										<li>
											<div class="trach_single_list">
												<div class="trach_icon_list"><i class="ti-plus"></i></div>
												<div class="track_list_caption">
													<h4 class="mb-0">{{ trans('labels.recharge_wallet') }}</h4>
												</div>
											</div>
										</li>
										
									</ul>
								</div>
							</div>
							<hr>
							<div class="card-body bg-white">
								<div class="row justify-content-around">
									<span>
										<h6 class="text-muted"><div class="trach_icon_list font-weight-bold"><i class="fa fa-check-square"></i></div></h6>
										<p class="mb-lg-0 font-size-sm font-weight-bold">{{ trans('labels.wallet_in') }}</p>
									</span>
									<span>
										<h6 class="text-muted"><div class="trach_icon_list"><i class="fa fa-window-close"></i></div></h6>
										<p class="mb-0 font-size-sm font-weight-bold">{{ trans('labels.wallet_out') }}</p>
									</span>
								</div>
							</div><hr>
							@if(count($transaction_data)<=0)
								<div class="col-12 text-center">
									<img src="{{Helper::image_path('no-data.png')}}">
									<h2 class="error_title mt-4">{{ trans('labels.no_transactions') }}</h2>
									<p><span class="text-primary">{{trans('labels.woops')}}</span> {{ trans('labels.transactions_not_found') }}</p>
									<a href="{{URL::to('/')}}" class="btn btn-primary">{{ trans('labels.go_home_page') }}</a>
								</div>
							@endif
							@foreach ($transaction_data as $transaction)
							<div class="row">
								<div class="col-6">
									<ul class="track_order_list">
									
										<!-- Single List -->
										<li>
											<div class="trach_single_list">
												@if($transaction->transaction_type == "1")
													<div class="trach_icon_list"><i class="fa fa-check-square"></i></div>
												@endif
												@if($transaction->transaction_type == "2")
													<div class="trach_icon_list"><i class="fa fa-window-close"></i></div>
												@endif
												@if($transaction->transaction_type == "3")
													<div class="trach_icon_list"><i class="fa fa-check-square"></i></div>
												@endif
												@if($transaction->transaction_type == "4")
													<div class="trach_icon_list"><i class="fa fa-check-square"></i></div>
												@endif
												@if($transaction->transaction_type == "5")
													<div class="trach_icon_list"><i class="fa fa-window-close"></i></div>
												@endif
												<div class="track_list_caption">
													@if($transaction->transaction_type == "1")
														<h4 class="mb-0">{{ trans('labels.Order_Cancel') }}</h4>
														<p>{{ trans('labels.Order_Cancel_text') }}</p>
													@endif
													@if($transaction->transaction_type == "2")
														<h4 class="mb-0">{{ trans('labels.Order_Placed_') }}</h4>
														<p>{{ trans('labels.Order_Placed_text') }}</p>
													@endif
													@if($transaction->transaction_type == "3")
														<h4 class="mb-0">{{ trans('labels.referral') }}</h4>
														<p>{{ trans('labels.referral_text') }}</p>
													@endif
													@if($transaction->transaction_type == "4")
														<h4 class="mb-0">{{ trans('labels.recharge_wallet') }}</h4>
														<p>{{ trans('labels.wallet_recharge_text') }}</p>
													@endif
													@if($transaction->transaction_type == "5")
														<h4 class="mb-0">{{ trans('labels.Order_Return') }}</h4>
														<p>{{ trans('labels.Order_Return_text') }}</p>
													@endif
												</div>
											</div>
										</li>
										
									</ul>
								</div>
								<div class="col-6">
									<ul class="track_order_list">
									
										<!-- Single List -->
										<li>
											<div class="trach_single_list">
												<div class="track_list_caption mt-2 text-right">
													@if($transaction->transaction_type == "2")
														<h4 class="mb-0 danger-color">
															- {{Helper::CurrencyFormatter($transaction->wallet)}}
														</h4>
													@else
														<h4 class="mb-0 font-color">
															+ {{Helper::CurrencyFormatter($transaction->wallet)}}
														</h4>
													@endif												
												</div>
											</div>
										</li>
										
									</ul>
								</div>
							</div>
							@endforeach
							<div class="d-flex justify-content-center">
								{{$transaction_data->links()}}
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

		<!-- Modal -->
		<div class="modal fade" id="RechargeWallet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog  modal-lg" role="document">
		      <div class="modal-content">
		        <div class="modal-header">
		          <h5 class="modal-title" id="exampleModalLongTitle">{{ trans('labels.recharge_wallet') }}</h5>
		          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		            <span aria-hidden="true">&times;</span>
		          </button>
		        </div>
		        <div class="modal-body">
		          <div class="recharge-type">
		          	@foreach ($paymentlist as $payment)
			          	<div class="card">
			          	    <div class="card-body">
			          	    	<input class="custom-control-input" id="{{$payment->payment_name}}" data-payment_type="{{$payment->id}}" name="payment" type="radio">
			          	    	<label class="custom-control-label font-size-sm text-body text-nowrap mt-2" for="{{$payment->payment_name}}">

			          	    		@if($payment->payment_name == "RazorPay")
			          	    			<img src="{{asset('storage/app/public/Webassets/img/credit-card.png')}}" class="img-fluid ml-2" alt="" width="30px" />

			          	    			@if($payment->environment=='1')
			          	    			    <input type="hidden" name="razorpay" id="razorpay" value="{{$payment->test_public_key}}">
			          	    			@else
			          	    			    <input type="hidden" name="razorpay" id="razorpay" value="{{$payment->live_public_key}}">
			          	    			@endif
			          	    		@endif

			          	    		@if($payment->payment_name == "Stripe")
			          	    			<img src="{{asset('storage/app/public/Webassets/img/credit-card.png')}}" class="img-fluid ml-2" alt="" width="30px" />

			          	    			@if($payment->environment=='1')
			          	    			    <input type="hidden" name="stripe" id="stripe" value="{{$payment->test_public_key}}">
			          	    			@else
			          	    			    <input type="hidden" name="stripe" id="stripe" value="{{$payment->live_public_key}}">
			          	    			@endif
			          	    		@endif

			          	    		@if($payment->payment_name == "Flutterwave")
			          	    			<img src="{{asset('storage/app/public/Webassets/img/credit-card.png')}}" class="img-fluid ml-2" alt="" width="30px" />

			          	    			@if($payment->environment=='1')
			          	    			    <input type="hidden" name="flutterwavekey" id="flutterwavekey" value="{{$payment->test_public_key}}">
			          	    			@else
			          	    			    <input type="hidden" name="flutterwavekey" id="flutterwavekey" value="{{$payment->live_public_key}}">
			          	    			@endif
			          	    		@endif

			          	    		@if($payment->payment_name == "Paystack")
			          	    			<img src="{{asset('storage/app/public/Webassets/img/credit-card.png')}}" class="img-fluid ml-2" alt="" width="30px" />

			          	    			@if($payment->environment=='1')
			          	    			    <input type="hidden" name="paystackkey" id="paystackkey" value="{{$payment->test_public_key}}">
			          	    			@else
			          	    			    <input type="hidden" name="paystackkey" id="paystackkey" value="{{$payment->live_public_key}}">
			          	    			@endif
			          	    		@endif
			          	    		{{$payment->payment_name}}
			          	    	</label>
			          	    </div>
		          	  	</div>
		          	@endforeach
		          </div>

		          <div class="form-row">
		          	<div class="form-group col-md-12">
		          	  <label>{{ trans('labels.amount') }}</label>
		          	  <input type="text" class="form-control" name="recharge_amount" id="recharge_amount" placeholder="{{ trans('labels.amount') }}">
		          	</div>
		          </div>

		        </div>
		        <div class="modal-footer">
		          <button type="button" class="btn btn-primary" onclick="Recharge()">{{ trans('labels.recharge') }}</button>
		        </div>
		      </div>
		    </div>
		</div>
	</section>

@endsection

@section('scripttop')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="https://checkout.stripe.com/v2/checkout.js"></script>
<script src="https://checkout.flutterwave.com/v3.js"></script>
<script src="https://js.paystack.co/v1/inline.js"></script>
<script type="text/javascript">
	var SITEURL = '{{URL::to('')}}';
	$('#recharge_amount').keyup(function(){
	    "use strict";
	   	var val = $(this).val();
	   	if(isNaN(val)){
	      	val = val.replace(/[^0-9\.]/g,'');
	      	if(val.split('.').length>2) 
	         	val =val.replace(/\.+$/,"");
	      	}
	   	$(this).val(val); 
	});

	function Recharge() 
	{
	    var recharge_amount = $('#recharge_amount').val();
	    var payment_type = $('input[name="payment"]:checked').attr("data-payment_type");
	    
	    if (typeof $("input[name='payment']:checked").val() === "undefined") {
	        toast.error("Please select payment method");
	    } else if (recharge_amount == "") {
	        toast.error("Please enter valid amount");
	    } else {
	    	    //Razorpay
	    	    if (payment_type == 3) {
	    	    	var options = {
	    	    	    "key": $('#razorpay').val(),
	    	    	    "amount": (parseInt(recharge_amount*100)), // 2000 paise = INR 20
	    	    	    "name": "e-Commerce",
	    	    	    "description": "Wallet Recharge",
	    	    	    "image": 'https://stripe.com/img/documentation/checkout/marketplace.png',
	    	    	    "handler": function (response){
	    	    	        $.ajax({
	    	    	        	headers: {
	    	    	        	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    	    	        	},
	    	    	            url:"{{ URL::to('recharge') }}",
	    	    	            type: 'post',
	    	    	            dataType: 'json',
	    	    	            data: {
	    	    	            	payment_id: response.razorpay_payment_id ,
	    	    	            	payment_type: payment_type ,
	    	    	            	recharge_amount: recharge_amount ,
	    	    	            }, 
	    	    	            success: function(response) {
	    	    	                if (response.status == 1) {
	    	    	                    location.reload();
	    	    	                } else {
	    	    	                    $('#ermsg').text(response.message);
	    	    	                    $('#error-msg').addClass('alert-danger');
	    	    	                    $('#error-msg').css("display","block");

	    	    	                    setTimeout(function() {
	    	    	                        $("#error-msg").hide();
	    	    	                    }, 5000);
	    	    	                }
	    	    	            },
	    	    	            error: function(error) {

	    	    	                // $('#errormsg').show();
	    	    	            }
	    	    	    	});
	    	    	   
	    	    		},
	    	    	    "prefill": {
	    	    	        "contact": "{{@Auth::user()->mobile}}",
	    	    	        "email":   "{{@Auth::user()->email}}",
	    	    	        "name":   "{{@Auth::user()->name}}",
	    	    	    },
	    	    	    "theme": {
	    	    	        "color": "#366ed4"
	    	    	    }
	    	    	};

	    	    	var rzp1 = new Razorpay(options);
	    	    	rzp1.open();
	    	    	e.preventDefault();
	    	    }

	    	    //Stripe
	    	    if (payment_type == 4) {

	    	    	var handler = StripeCheckout.configure({
	    	    	  key: $('#stripe').val(),
	    	    	  image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
	    	    	  locale: 'auto',
	    	    	  token: function(token) {
	    	    	    // You can access the token ID with `token.id`.
	    	    	    // Get the token ID to your server-side code for use.

	    	    	    $.ajax({
	    	    	        headers: {
	    	    	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    	    	        },
	    	    	        url:"{{ URL::to('recharge') }}",
	    	    	        data: {
	    	    	        	payment_type: payment_type ,
	    	    	        	recharge_amount: recharge_amount ,
	    	    	            stripeToken : token.id,
	    	    	        }, 
	    	    	        method: 'POST',
	    	    	        success: function(response) {
	    	    	            if (response.status == 1) {
	    	    	                location.reload();
	    	    	            } else {
	    	    	                $('#ermsg').text(response.message);
	    	    	                $('#error-msg').addClass('alert-danger');
	    	    	                $('#error-msg').css("display","block");

	    	    	                setTimeout(function() {
	    	    	                    $("#error-msg").hide();
	    	    	                }, 5000);
	    	    	            }
	    	    	        },
	    	    	        error: function(error) {

	    	    	        }
	    	    	    });
	    	    	  },
	    	    	  opened: function() {
	    	    	    
	    	    	  },
	    	    	  closed: function() {

	    	    	  }
	    	    	});

	    	    	//Stripe Popup
	    	    	handler.open({
	    	    	    name: 'e-Commerce',
	    	    	    description: 'Wallet Recharge',
	    	    	    amount: recharge_amount*100,
	    	    	    currency: "USD",
	    	    	    email: "{{@Auth::user()->email}}",
	    	    	});
	    	    	e.preventDefault();
	    	    	// Close Checkout on page navigation:
	    	    	$(window).on('popstate', function() {
	    	    	  handler.close();
	    	    	});
	    	    }

	    	    //Flutterwave
	    	    if (payment_type == 5) {
	    	    	var flutterwavekey = $('#flutterwavekey').val();

	    	    	FlutterwaveCheckout({
	    	    	  	public_key: flutterwavekey,
	    	    	  	tx_ref: "{{@Auth::user()->name}}",
	    	    	  	amount: recharge_amount,
	    	    	  	currency: "USD",
	    	    	  	payment_options: " ",
	    	    	  	customer: {
	    	    	    	email: "{{@Auth::user()->email}}",
	    	    	    	phone_number: "{{@Auth::user()->mobile}}",
	    	    	    	name: "{{@Auth::user()->name}}",
	    	    	  	},
	    	    	  	callback: function (data) {
	    		    	    $.ajax({
	    		    	    	headers: {
	    		    	    	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    		    	    	},
	    		    	        url:"{{ URL::to('recharge') }}",
	    		    	        method: 'POST',
	    		    	        dataType: 'json',
	    		    	        data: {
	    		    	        	payment_id: data.flw_ref ,
	    		    	        	payment_type: payment_type ,
	    		    	        	recharge_amount: recharge_amount ,
	    		    	        }, 
	    		    	        success: function(response) {
	    		    	            if (response.status == 1) {
	    		    	                location.reload();
	    		    	            } else {
	    		    	                $('#ermsg').text(response.message);
	    		    	                $('#error-msg').addClass('alert-danger');
	    		    	                $('#error-msg').css("display","block");

	    		    	                setTimeout(function() {
	    		    	                    $("#error-msg").hide();
	    		    	                }, 5000);
	    		    	            }
	    		    	        },
	    		    	        error: function(error) {

	    		    	        }
	    		    	    });
	    	    	  	},
	    	    	  	onclose: function() {
	    	    	    	
	    	    	  	},
	    	    	  	customizations: {
	    		    	    title: "e-Commerce",
	    		    	    description: "Wallet Recharge",
	    		    	    logo: "https://stripe.com/img/documentation/checkout/marketplace.png",
	    	    	  	},
	    	    	});
	    	    }

	    	    //Paystack
	    	    if (payment_type == 6) {

	    	    	var paystackkey = $('#paystackkey').val();

	    	    	let handler = PaystackPop.setup({

	    	    	    key: paystackkey,
	    	    	    email: "{{@Auth::user()->email}}",
	    	    	    amount: recharge_amount * 100,
	    	    	    currency: 'GHS', // Use GHS for Ghana Cedis or USD for US Dollars
	    	    	    ref: 'trx_'+Math.floor((Math.random() * 1000000000) + 1),
	    	    	    label: "Wallet Recharge",
	    	    	    onClose: function(){
	    	    	        // alert('Window closed.');
	    	    	    },
	    	    	    callback: function(response){
	    	    	        $('#preloader').show();
	    	    	        $.ajax({
	    	    	            headers: {
	    	    	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    	    	            },
	    	    	            url:"{{ URL::to('recharge') }}",
	    	    	            data: {
	    	    	                payment_id: response.trxref ,
	    	    	                payment_type: payment_type ,
	    	    	                recharge_amount: recharge_amount ,
	    	    	            },
	    	    	            method: 'POST',
	    	    	            success: function(response) {
	    	    	                $('#preloader').hide();
	    	    	                if (response.status == 1) {
	    	    	                    location.reload();
	    	    	                } else {
	    	    	                    $('#ermsg').text(response.message);
	    		    	                $('#error-msg').addClass('alert-danger');
	    		    	                $('#error-msg').css("display","block");

	    		    	                setTimeout(function() {
	    		    	                    $("#error-msg").hide();
	    		    	                }, 5000);
	    	    	                }
	    	    	            },
	    	    	            error: function(error) {

	    	    	                // $('#errormsg').show();
	    	    	            }
	    	    	        });
	    	    	    }
	    	    	});
	    	    	handler.openIframe();
	    	    }
	    }
	}
</script>

@endsection