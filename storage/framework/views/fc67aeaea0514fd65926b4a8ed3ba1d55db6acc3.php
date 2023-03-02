<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.checkout')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<!-- =========================== Breadcrumbs =================================== -->
	<div class="brd_wraps pt-2 pb-2">
		<div class="container">
			<nav aria-label="breadcrumb" class="simple_breadcrumbs">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#"><i class="ti-home"></i></a></li>
				<li class="breadcrumb-item active" aria-current="page"><?php echo e(trans('labels.checkout')); ?></li>
			  </ol>
			</nav>
		</div>
	</div>
	<!-- =========================== Breadcrumbs =================================== -->

	<!-- =========================== Billing Section =================================== -->
	<section>
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-12">
					<!-- Shipping details -->
					<h4 class="mb-3"><?php echo e(trans('labels.billing_details')); ?></h4>
					<div class="table-responsive mb-3">
						<table class="table table-bordered table-sm table-hover mb-0">
							<tbody>

								<?php $__currentLoopData = $addressdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>
									<td>
										<div class="custom-control custom-radio" onclick="onClickClose();">
											<input class="custom-control-input" id="<?php echo e($address->id); ?>" name="address" data-fullname="<?php echo e($address->first_name); ?> <?php echo e($address->last_name); ?>" data-email="<?php echo e($address->email); ?>" data-mobile="<?php echo e($address->mobile); ?>" data-street_address="<?php echo e($address->street_address); ?>" data-landmark="<?php echo e($address->landmark); ?>" data-pincode="<?php echo e($address->pincode); ?>" type="radio">
											<label class="custom-control-label text-body text-nowrap ml-2" for="<?php echo e($address->id); ?>"><?php echo e($address->first_name); ?> <?php echo e($address->last_name); ?> (<?php echo e($address->email); ?>)<br>
											<?php echo e($address->mobile); ?><br>
											<?php echo e($address->street_address); ?> <?php echo e($address->landmark); ?> <?php echo e($address->pincode); ?></label>
										</div>
									</td>
								</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

								<tr>
									<td>
										<a href="javascript:void(0)"><h4 class="mb-3" onclick="onClickOpen();">+ <?php echo e(trans('labels.add_address')); ?></h4></a>
										<form method="post" action="<?php echo e(URL::to('saveaddress')); ?>">
										<div class="row mb-5" id="addressform" <?php if(old('_token') == ""): ?> style="display: none;" <?php endif; ?> >
												<?php echo csrf_field(); ?>
												<div class="col-12 col-md-6">
													<!-- First Name -->
													<div class="form-group">
													<label for="first_name"><?php echo e(trans('labels.first_name')); ?></label>
													<input class="form-control form-control-sm" name="first_name" id="first_name" type="text" placeholder="First Name" value="<?php echo e(old('first_name')); ?>">
													<?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
													</div>
												</div>
												
												<div class="col-12 col-md-6">
													<!-- Last Name -->
													<div class="form-group">
													<label for="last_name"><?php echo e(trans('labels.last_name')); ?></label>
													<input class="form-control form-control-sm" name="last_name" id="last_name" type="text" placeholder="Last Name" value="<?php echo e(old('last_name')); ?>">
													<?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
													</div>
												</div>

												<div class="col-12 col-md-6">
													<!-- Email -->
													<div class="form-group">
													<label for="email"><?php echo e(trans('labels.email')); ?></label>
													<input class="form-control form-control-sm" name="email" id="email" type="text" placeholder="Email" value="<?php echo e(old('email')); ?>">
													<?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
													</div>
												</div>

												<div class="col-12 col-md-6">
													<!-- Phone -->
													<div class="form-group">
													<label for="mobile"><?php echo e(trans('labels.mobile')); ?></label>
													<input class="form-control form-control-sm" name="mobile" id="mobile" type="text" placeholder="Phone" value="<?php echo e(old('mobile')); ?>">
													<?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
													</div>
												</div>

												<div class="col-12 col-md-12">
													<!-- Street Address -->
													<div class="form-group">
													<label for="street_address"><?php echo e(trans('labels.street_address')); ?></label>
													<textarea class="form-control form-control-sm" name="street_address" id="street_address" placeholder="Street address" rows="2"><?php echo e(old('street_address')); ?></textarea>
													<?php $__errorArgs = ['street_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
													</div>
												</div>

												<div class="col-12 col-md-6">
													<!-- Landmark -->
													<div class="form-group">
													<label for="landmark"><?php echo e(trans('labels.landmark')); ?></label>
													<input class="form-control form-control-sm" name="landmark" id="landmark" type="text" placeholder="Landmark" value="<?php echo e(old('landmark')); ?>">
													<?php $__errorArgs = ['landmark'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
													</div>
												</div>

												<div class="col-12 col-md-6">
													<!-- Postalcode/Zip -->
													<div class="form-group">
													<label for="pincode"><?php echo e(trans('labels.pincode')); ?></label>
													<input class="form-control form-control-sm" name="pincode" id="pincode" type="text" placeholder="Postalcode/Zip" value="<?php echo e(old('pincode')); ?>">
													<?php $__errorArgs = ['pincode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
													</div>
												</div>

												<div class="col-12 col-md-3">
													<input type="submit" name="submit" class="btn btn-block btn-dark mt-2" value="<?php echo e(trans('labels.save')); ?>">
												</div>
											
										</div>
										</form>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<!-- Shipping details -->


					<!-- Notes -->
					<textarea class="form-control form-control-sm mb-9 mb-md-0 font-size-xs" rows="5" name="order_notes" id="order_notes" placeholder="Order Notes (optional)"></textarea>

					<!-- Heading -->
					<h4 class="mt-3"><?php echo e(trans('labels.payment')); ?></h4>

					<!-- List group -->
					<div class="list-group list-group-sm mb-5">
						<?php $__currentLoopData = $paymentlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="list-group-item">
								<!-- Radio -->
								<div class="custom-control custom-radio">
									<!-- Input -->
									<input class="custom-control-input" id="<?php echo e($payment->payment_name); ?>" data-payment_type="<?php echo e($payment->id); ?>" name="payment" type="radio">
									<!-- Label -->

									<label class="custom-control-label font-size-sm text-body text-nowrap" for="<?php echo e($payment->payment_name); ?>">
										<?php if($payment->payment_name == "COD"): ?>
											<img src="<?php echo e(asset('storage/app/public/Webassets/img/cod.png')); ?>" class="img-fluid ml-2" alt="" width="30px" />
										<?php endif; ?>

										<?php if($payment->payment_name == "Wallet"): ?>
											<img src="<?php echo e(asset('storage/app/public/Webassets/img/credit-card.png')); ?>" class="img-fluid ml-2" alt="" width="30px" />
										<?php endif; ?>

										<?php if($payment->payment_name == "RazorPay"): ?>
											<img src="<?php echo e(asset('storage/app/public/Webassets/img/credit-card.png')); ?>" class="img-fluid ml-2" alt="" width="30px" />

											<?php if($payment->environment=='1'): ?>
											    <input type="hidden" name="razorpay" id="razorpay" value="<?php echo e($payment->test_public_key); ?>">
											<?php else: ?>
											    <input type="hidden" name="razorpay" id="razorpay" value="<?php echo e($payment->live_public_key); ?>">
											<?php endif; ?>
										<?php endif; ?>

										<?php if($payment->payment_name == "Stripe"): ?>
											<img src="<?php echo e(asset('storage/app/public/Webassets/img/credit-card.png')); ?>" class="img-fluid ml-2" alt="" width="30px" />

											<?php if($payment->environment=='1'): ?>
											    <input type="hidden" name="stripe" id="stripe" value="<?php echo e($payment->test_public_key); ?>">
											<?php else: ?>
											    <input type="hidden" name="stripe" id="stripe" value="<?php echo e($payment->live_public_key); ?>">
											<?php endif; ?>
										<?php endif; ?>

										<?php if($payment->payment_name == "Flutterwave"): ?>
											<img src="<?php echo e(asset('storage/app/public/Webassets/img/credit-card.png')); ?>" class="img-fluid ml-2" alt="" width="30px" />

											<?php if($payment->environment=='1'): ?>
											    <input type="hidden" name="flutterwavekey" id="flutterwavekey" value="<?php echo e($payment->test_public_key); ?>">
											<?php else: ?>
											    <input type="hidden" name="flutterwavekey" id="flutterwavekey" value="<?php echo e($payment->live_public_key); ?>">
											<?php endif; ?>
										<?php endif; ?>

										<?php if($payment->payment_name == "Paystack"): ?>
											<img src="<?php echo e(asset('storage/app/public/Webassets/img/credit-card.png')); ?>" class="img-fluid ml-2" alt="" width="30px" />

											<?php if($payment->environment=='1'): ?>
				          	    			    <input type="hidden" name="paystackkey" id="paystackkey" value="<?php echo e($payment->test_public_key); ?>">
				          	    			<?php else: ?>
				          	    			    <input type="hidden" name="paystackkey" id="paystackkey" value="<?php echo e($payment->live_public_key); ?>">
				          	    			<?php endif; ?>
										<?php endif; ?>
										<?php echo e($payment->payment_name); ?>

									</label>
								</div>
							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>

					<a class="btn btn-block btn-dark mb-2" href="javascript:void(0)" onclick="Order()"><?php echo e(trans('labels.proceed_payment')); ?></a>
				</div>
				<?php if(Storage::disk('local')->has("promo")): ?>
					<?php
						$promo = json_decode(Storage::disk('local')->get("promo"), true);
					?>
					<input type="hidden" name="coupon_name" id="coupon_name" value="<?php echo e($promo['coupon_name']); ?>">
				<?php endif; ?>

				<?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cartitems): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php if(Storage::disk('local')->has("promo")): ?>
					<?php if(@$promo['type'] == "1"): ?>
					    <?php if($cartitems->price*$cartitems->qty > @$promo['amount']): ?>
					    	<?php 
					    		$dis_amount = ($cartitems->price*$cartitems->qty) - @$promo['amount'];
					    	?>
					    <?php endif; ?>
					<?php endif; ?>

					<?php if(@$promo['type'] == "0"): ?>
						<?php 
							$dis_amount = ($cartitems->price*$cartitems->qty)*@$promo['percentage']/100;
						?>
					<?php endif; ?>
				<?php endif; ?>

				<?php
				$tax = ($cartitems->tax*$cartitems->qty);
				$shipping_cost = ($cartitems->shipping_cost);

				$subtotal = $cartitems->price*$cartitems->qty;
				$vendorid = $cartitems->vendor_id;
				$data[] = array(
				    "sub_total" => $subtotal,
				    "tax" => $tax,
				    "shipping_cost" => $shipping_cost,
				);
				$sub_total = array_sum(array_column(@$data, 'sub_total'));
				$tax = array_sum(array_column(@$data, 'tax'));
				$shipping_cost = array_sum(array_column(@$data, 'shipping_cost'));
				?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

				<?php if(Storage::disk('local')->has("dis_amount")): ?>
					<?php
						$dis_amount = Storage::disk('local')->get("dis_amount");
					?>
				<?php else: ?>
					<?php
						$dis_amount = 0;
					?>
				<?php endif; ?>
				<?php if(Storage::disk('local')->has("grand_total")): ?>
					<?php
						$grand_total = Storage::disk('local')->get("grand_total");
					?>
				<?php else: ?>
					<?php
						$grand_total = 0;
					?>
				<?php endif; ?>

				<div class="col-12 col-md-12 col-lg-4">
					<div class="cart_detail_box mb-4">
						<div class="card-body">
							<ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
								<li class="list-group-item d-flex">
									<h5 class="mb-0"><?php echo e(trans('labels.order_summary')); ?></h5>
								</li>
								<li class="list-group-item d-flex">
									<span><?php echo e(trans('labels.subtotal')); ?></span> <span class="ml-auto font-size-sm"><?php echo e(Helper::CurrencyFormatter(@$sub_total)); ?></span>
								</li>
								<li class="list-group-item d-flex">
									<span><?php echo e(trans('labels.tax')); ?></span> <span class="ml-auto font-size-sm"><?php echo e(Helper::CurrencyFormatter(@$tax)); ?></span>
								</li>
								<li class="list-group-item d-flex">
									<span><?php echo e(trans('labels.shipping')); ?></span> <span class="ml-auto font-size-sm"><?php echo e(Helper::CurrencyFormatter(@$shipping_cost)); ?></span>
								</li>
								<li class="list-group-item d-flex">
									<span><?php echo e(trans('labels.discount')); ?></span> <span class="ml-auto font-size-sm"><?php echo e(Helper::CurrencyFormatter(@$dis_amount)); ?></span>
								</li>
								<li class="list-group-item d-flex font-size-lg font-weight-bold">
									<span><?php echo e(trans('labels.ttl')); ?></span> <span class="ml-auto font-size-sm"><?php echo e(Helper::CurrencyFormatter(@$grand_total)); ?></span>
								</li>
							</ul>
						</div>
					</div>
					<a class="px-0 text-body" href="<?php echo e(URL::to('/')); ?>"><i class="ti-back-left mr-2"></i> <?php echo e(trans('labels.continue_shopping')); ?></a>
				</div>
				
			</div>
		</div>
	</section>

	<input type="hidden" name="discount_amount" id="discount_amount" value="<?php echo e(@$dis_amount); ?>">
	<input type="hidden" name="grand_total" id="grand_total" value="<?php echo e(@$grand_total); ?>">
	<input type="hidden" name="vendor_id" id="vendor_id" value="<?php echo e(@$vendorid); ?>">
	<!-- =========================== Billing Section =================================== -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripttop'); ?>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="https://checkout.stripe.com/v2/checkout.js"></script>
<script src="https://checkout.flutterwave.com/v3.js"></script>
<script src="https://js.paystack.co/v1/inline.js"></script>
<script type="text/javascript">
	function onClickOpen(){
	    $("#addressform").show();
	    $('input[name="address"]').prop('checked', false);
	}

	function onClickClose(){
	    $("#addressform").hide();
	}

	var SITEURL = '<?php echo e(URL::to('')); ?>';
	function Order() 
	{
	    var full_name =  $('input[name="address"]:checked').attr("data-fullname");
	    var email =  $('input[name="address"]:checked').attr("data-email");
	    var mobile =  $('input[name="address"]:checked').attr("data-mobile");
	    var street_address =  $('input[name="address"]:checked').attr("data-street_address");
	    var pincode =  $('input[name="address"]:checked').attr("data-pincode");
	    var order_notes = $('#order_notes').val();
	    var payment_type = $('input[name="payment"]:checked').attr("data-payment_type");
	    var coupon_name = $('#coupon_name').val();
	    var discount_amount = $('#discount_amount').val();
	    var grand_total = $('#grand_total').val();
	    var vendor_id = $('#vendor_id').val();
	    var flutterwavekey = $('#flutterwavekey').val();
	    var paystackkey = $('#paystackkey').val();

        //COD
        if (payment_type == 1) {
    	    $.ajax({
    	        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    	        url:"<?php echo e(URL::to('order')); ?>",
    	        data: {
    	            full_name : full_name ,
    	            email : email ,
    	            mobile: mobile ,  
    	            grand_total: grand_total ,
    	            street_address: street_address , 
    	            pincode: pincode , 
    	            order_notes : order_notes,
    	            payment_type : payment_type,
    	            vendor_id : vendor_id ,
    	            coupon_name : coupon_name ,
    	            discount_amount : discount_amount ,
    	        }, 
    	        method: 'POST',
    	        success: function(response) {
    	            if (response.status == 1) {
    	                window.location.href = SITEURL + '/success';
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

    	//Wallet
        if (payment_type == 2) {
    	    $.ajax({
    	        headers: {
    	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    	        },
    	        url:"<?php echo e(URL::to('order')); ?>",
    	        data: {
    	            full_name : full_name ,
    	            email : email ,
    	            mobile: mobile ,  
    	            grand_total: grand_total ,
    	            street_address: street_address , 
    	            pincode: pincode , 
    	            order_notes : order_notes,
    	            payment_type : payment_type,
    	            vendor_id : vendor_id ,
    	            coupon_name : coupon_name ,
    	            discount_amount : discount_amount ,
    	        }, 
    	        method: 'POST',
    	        success: function(response) {
    	            if (response.status == 1) {
    	                window.location.href = SITEURL + '/success';
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

	    //Razorpay
	    if (payment_type == 3) {
	    	var options = {
	    	    "key": $('#razorpay').val(),
	    	    "amount": (parseInt(grand_total*100)), // 2000 paise = INR 20
	    	    "name": "e-Commerce",
	    	    "description": "Order payment",
	    	    "image": 'https://stripe.com/img/documentation/checkout/marketplace.png',
	    	    "handler": function (response){
	    	        $.ajax({
	    	        	headers: {
	    	        	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    	        	},
	    	            url:"<?php echo e(URL::to('order')); ?>",
	    	            type: 'post',
	    	            dataType: 'json',
	    	            data: {
	    	            	payment_id: response.razorpay_payment_id ,
	    	            	grand_total: grand_total ,
	    	            	full_name : full_name ,
	    	            	email : email ,
	    	            	mobile: mobile ,  
	    	            	street_address: street_address , 
	    	            	pincode: pincode , 
	    	            	order_notes : order_notes,
	    	            	payment_type : payment_type,
	    	            	vendor_id : vendor_id ,
	    	            	coupon_name : coupon_name ,
	    	            	discount_amount : discount_amount ,
	    	            }, 
	    	            success: function(response) {
	    	                if (response.status == 1) {
	    	                    window.location.href = SITEURL + '/success';
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
	    	        "contact": mobile,
	    	        "email":   email,
	    	        "name":   full_name,
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
	    	        url:"<?php echo e(URL::to('order')); ?>",
	    	        data: {
	    	        	grand_total: grand_total ,
	    	            full_name : full_name ,
	    	            email : email ,
	    	            mobile: mobile ,  
	    	            street_address: street_address , 
	    	            pincode: pincode , 
	    	            order_notes : order_notes,
	    	            payment_type : payment_type,
	    	            vendor_id : vendor_id ,
	    	            coupon_name : coupon_name ,
	    	            discount_amount : discount_amount ,
	    	            stripeToken : token.id,
	    	        }, 
	    	        method: 'POST',
	    	        success: function(response) {
	    	            if (response.status == 1) {
	    	                window.location.href = SITEURL + '/success';
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
	    	    description: 'Order payment',
	    	    amount: grand_total*100,
	    	    currency: "USD",
	    	    email: email
	    	});
	    	e.preventDefault();
	    	// Close Checkout on page navigation:
	    	$(window).on('popstate', function() {
	    	  handler.close();
	    	});
	    }

	    //Flutterwave
	    if (payment_type == 5) {
	    	FlutterwaveCheckout({
	    	  	public_key: flutterwavekey,
	    	  	tx_ref: full_name,
	    	  	amount: grand_total,
	    	  	currency: "NGN",
	    	  	payment_options: " ",
	    	  	customer: {
	    	    	email: email,
	    	    	phone_number: mobile,
	    	    	name: full_name,
	    	  	},
	    	  	callback: function (data) {
		    	    $.ajax({
		    	    	headers: {
		    	    	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    	    	},
		    	        url:"<?php echo e(URL::to('order')); ?>",
		    	        method: 'POST',
		    	        dataType: 'json',
		    	        data: {
		    	        	payment_id: data.flw_ref ,
		    	        	grand_total: grand_total ,
		    	            full_name : full_name ,
		    	            email : email ,
		    	            mobile: mobile ,  
		    	            street_address: street_address , 
		    	            pincode: pincode , 
		    	            order_notes : order_notes,
		    	            payment_type : payment_type,
		    	            vendor_id : vendor_id ,
		    	            coupon_name : coupon_name ,
		    	            discount_amount : discount_amount
		    	        }, 
		    	        success: function(response) {
		    	            if (response.status == 1) {
		    	                window.location.href = SITEURL + '/success';
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
		    	    description: "Order payment",
		    	    logo: "https://stripe.com/img/documentation/checkout/marketplace.png",
	    	  	},
	    	});
	    }

	    //Paystack
	    if (payment_type == 6) {
	    	let handler = PaystackPop.setup({

	    	    key: paystackkey,
	    	    email: email,
	    	    amount: grand_total * 100,
	    	    currency: 'GHS', // Use GHS for Ghana Cedis or USD for US Dollars
	    	    ref: 'trx_'+Math.floor((Math.random() * 1000000000) + 1),
	    	    label: "Order payment",
	    	    onClose: function(){
	    	        // alert('Window closed.');
	    	    },
	    	    callback: function(response){
	    	        $('#preloader').show();
	    	        $.ajax({
	    	            headers: {
	    	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    	            },
	    	            url:"<?php echo e(URL::to('order')); ?>",
	    	            data: {
	    	                payment_id: response.trxref ,
	    	                grand_total: grand_total ,
		    	            full_name : full_name ,
		    	            email : email ,
		    	            mobile: mobile ,  
		    	            street_address: street_address , 
		    	            pincode: pincode , 
		    	            order_notes : order_notes,
		    	            payment_type : payment_type,
		    	            vendor_id : vendor_id ,
		    	            coupon_name : coupon_name ,
		    	            discount_amount : discount_amount
	    	            },
	    	            method: 'POST',
	    	            success: function(response) {
	    	                $('#preloader').hide();
	    	                if (response.status == 1) {
	    	                    window.location.href = SITEURL + '/success';
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
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.web', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/eglobalm/public_html/resources/views/Front/checkout.blade.php ENDPATH**/ ?>