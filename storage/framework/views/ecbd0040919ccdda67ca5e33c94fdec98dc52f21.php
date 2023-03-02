<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.login')); ?>

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
						<h3 class="login_sec_title"><?php echo e(trans('labels.login')); ?></h3>
						<form action="<?php echo e(URL::to('login')); ?>" method="post">
							<?php echo csrf_field(); ?>
							<div class="form-group">
								<label><?php echo e(trans('labels.email')); ?></label>
								<input type="text" name="email" class="form-control">
							</div>
							
							<div class="form-group">
								<label><?php echo e(trans('labels.password')); ?></label>
								<input type="password" name="password" class="form-control">
							</div>
							
							<div class="login_flex">
								<div class="login_flex_1">
									<?php echo e(trans('labels.new_user')); ?> <a href="<?php echo e(URL::to('/signup')); ?>" class="text-bold"><?php echo e(trans('labels.create_account')); ?></a>
								</div>
								<div class="login_flex_2">
									<a href="<?php echo e(URL::to('/forgot-password')); ?>" class="text-bold"><?php echo e(trans('labels.forgot_password')); ?></a>
								</div>
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-md btn-theme col-md-12 mt-3"><?php echo e(trans('labels.login')); ?></button>
								<!--<div class="text-center">-->
								<!--<a href="<?php echo e(url('auth/google')); ?>" class="btn btn-primary col-md-5 mt-3 mr-3" style="background-color: #fff;">-->
								<!--    <img src='<?php echo e(asset("storage/app/public/Webassets/img/ic_google.png")); ?>' alt="">-->
								<!--</a>-->
								<!--<a href="<?php echo e(url('auth/facebook')); ?>" class="btn btn-primary col-md-5 mt-3" style="background-color: #fff;">-->
								<!--    <img src='<?php echo e(asset("storage/app/public/Webassets/img/ic_fb.png")); ?>' alt="">-->
								<!--</a>-->
								<!--</div>-->
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.web', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/eglobalm/public_html/resources/views/Front/signin.blade.php ENDPATH**/ ?>