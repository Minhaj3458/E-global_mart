<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.otp_verify')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>	
	
	<!-- =========================== Login =================================== -->
	<section>
		<div class="container">
			
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-lg-6 col-md-6 col-sm-6">
					<div class="login_signup">
						<?php if(\Session::has('danger')): ?>

						    <div class="alert alert-danger">

						        <?php echo e(Session::get('danger')); ?>


						    </div>

						<?php endif; ?>

						<?php if(\Session::has('success')): ?>

						    <div class="alert alert-success">

						        <?php echo e(Session::get('success')); ?>


						    </div>

						<?php endif; ?>
						<h3 class="login_sec_title"><?php echo e(trans('labels.otp_verify')); ?></h3>
						<form action="<?php echo e(URL::to('otp-verification')); ?>" method="post">
							<?php echo csrf_field(); ?>
							<div class="row">

							    <div class="col-lg-12 col-md-12">
							    	<div class="form-group">
							    		<input type="email" name="email" id="email" placeholder="<?php echo e(trans('labels.email')); ?>" class="form-control" value="<?php echo e(Session::get('email')); ?>" readonly="">
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
							    
							    <div class="col-lg-12 col-md-12">
							    	<div class="form-group">
							    		<input type="number" name="otp" id="otp" min="1" maxlength="6" placeholder="<?php echo e(trans('labels.verification_code')); ?>" class="form-control" required="">
							    		<?php $__errorArgs = ['otp'];
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
							    	<p class="already"><?php echo e(trans('labels.email_not_receive')); ?>

							    		<span class="Btn" id="verifiBtn"></span><span id="timer"></span>
							    	</p>
							    </div>

								<div class="col-lg-12 col-md-12">
									<div class="form-group">
										<button type="submit" class="btn btn-md btn-theme col-md-12 mt-3"><?php echo e(trans('labels.verify')); ?></button>
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
      document.getElementById("verifiBtn").innerHTML = `<a href="<?php echo e(URL::to('resend-otp')); ?>">Resend</a>`;
      document.getElementById("timer").innerHTML = "";
    }

    timer(120);
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.web', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Front/otp-verify.blade.php ENDPATH**/ ?>