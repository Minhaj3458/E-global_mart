
<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.forgot_password')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>	
	
	<!-- =========================== Forgot-password =================================== -->
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
						<h3 class="login_sec_title"><?php echo e(trans('labels.forgot_password')); ?></h3>
						<form action="<?php echo e(URL::to('send-pass')); ?>" method="post">
							<?php echo csrf_field(); ?>
							<div class="form-group">
								<label><?php echo e(trans('labels.email')); ?></label>
								<input type="text" name="email" class="form-control" placeholder="<?php echo e(trans('placeholder.email')); ?>">
								<?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-md btn-theme col-md-12 mt-3"><?php echo e(trans('labels.submit')); ?></button>
							</div>
						</form>
						<div class="text-center">
							<a href="<?php echo e(URL::to('/signin')); ?>"> <?php echo e(trans('labels.already_user')); ?> <?php echo e(trans('labels.signin')); ?></a>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>
	<!-- =========================== Forgot-password =================================== -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.web', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/eglobalm/public_html/resources/views/Front/forgotpassword.blade.php ENDPATH**/ ?>