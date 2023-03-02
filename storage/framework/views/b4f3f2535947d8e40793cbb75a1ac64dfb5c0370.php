<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.vendor_register')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
			
	<!-- =========================== Login/Signup =================================== -->
	<section>
		<div class="container">
			
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-lg-8 col-md-12 col-sm-12">
					<?php if(Session::has('danger')): ?>
					<div class="alert alert-danger">
					    <?php echo e(Session::get('danger')); ?>

					    <?php
					        Session::forget('danger');
					    ?>
					</div>
					<?php endif; ?>
					<?php if(Session::has('success')): ?>
					<div class="alert alert-success">
					    <?php echo e(Session::get('success')); ?>

					    <?php
					        Session::forget('success');
					    ?>
					</div>
					<?php endif; ?>
					<div class="login_signup">
					    
					    <!--<?php echo e(route('vendor.store')); ?>-->
						<h3 class="login_sec_title"><?php echo e(trans('labels.create_account')); ?></h3>
						<form method="POST" action="<?php echo e(route('vendor.store_ref')); ?>" target="_blank">
						    
						   	<!--<form method="POST" action="<?php echo e(route('vendor.store')); ?>"> 	-->
						    
							<?php echo csrf_field(); ?>
							 <input type="hidden"  name="ref_name" value="<?php echo e($ref); ?>" />
							<div class="row">
							   
									<input type="hidden" id="country" name="country" value="880" />
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label><?php echo e(trans('labels.first_name')); ?></label>
										<input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo e(old('first_name')); ?>" placeholder="<?php echo e(trans('labels.first_name')); ?>">
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
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label><?php echo e(trans('labels.last_name')); ?></label>
										<input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo e(old('last_name')); ?>" placeholder="<?php echo e(trans('labels.last_name')); ?>">
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
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label><?php echo e(trans('labels.email')); ?></label>
										<input type="email" class="form-control" name="email" id="email" value="<?php echo e(old('email')); ?>" placeholder="<?php echo e(trans('labels.email')); ?>">
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
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label><?php echo e(trans('labels.mobile')); ?></label>
										<input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo e(old('mobile')); ?>" placeholder="<?php echo e(trans('labels.mobile')); ?>">
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
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label><?php echo e(trans('labels.password')); ?></label>
										<input type="password" class="form-control" name="password" id="password" placeholder="<?php echo e(trans('labels.password')); ?>">
										<?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label><?php echo e(trans('labels.confirm_password')); ?></label>
										<input type="password" class="form-control" name="confirmpassword" placeholder="<?php echo e(trans('labels.confirm_password')); ?>" value="<?php echo e(old('confirmpassword')); ?>">
										<?php $__errorArgs = ['confirmpassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
									</div>
								</div>

								
								
								<div class="col-lg-12 col-md-12">
									<div class="login_flex">
										<div class="login_flex_1">
											<input name="terms" id="accept" class="checkbox-custom" type="checkbox" <?php echo e(old('terms')=='on' ? 'checked' : ''); ?>>
											<label for="accept" class="checkbox-custom-label"><?php echo e(trans('labels.accept_the')); ?> <a href="<?php echo e(URL::to('terms-conditions')); ?>"> <u><?php echo e(trans('labels.terms_conditions')); ?></u></a></label>
										</div>
										<div class="login_flex_2">
											<?php echo e(trans('labels.already_have_account')); ?> <a href="<?php echo e(URL::to('/admin')); ?>" class="text-bold"> <?php echo e(trans('labels.signin')); ?></a>
										</div>
									</div>
									<?php $__errorArgs = ['terms'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
									<div class="form-group">
										<button type="submit" class="btn btn-md btn-theme col-md-12 mt-3"><?php echo e(trans('labels.signup')); ?></button>
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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripttop'); ?>

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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.web', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/eglobalm/public_html/resources/views/Front/vendor-signup-ref.blade.php ENDPATH**/ ?>