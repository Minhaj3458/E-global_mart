<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.account')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<!-- =========================== Breadcrumbs =================================== -->
	<div class="brd_wraps pt-2 pb-2">
		<div class="container">
			<nav aria-label="breadcrumb" class="simple_breadcrumbs">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#"><i class="ti-home"></i></a></li>
				<li class="breadcrumb-item active" aria-current="page"><?php echo e(trans('labels.account')); ?></li>
			  </ol>
			</nav>
		</div>
	</div>
	<!-- =========================== Breadcrumbs =================================== -->

	<!-- =========================== My Account =================================== -->
	<section class="gray">
		<div class="container">
			<div class="row">
				<?php echo $__env->make('includes.web.order-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				
				<div class="col-lg-8 col-md-9">

					<?php if(Auth::user()): ?>
						<!-- Total Items -->
						<div class="card style-2 mb-4">
							<div class="card-header">
								<h4 class="mb-0"><?php echo e(trans('labels.account')); ?></h4>
							</div>
							<div class="card-body">
								<form class="submit-page" action="<?php echo e(URL::to('/editprofile')); ?>" method="post" enctype="multipart/form-data">
									<?php echo csrf_field(); ?>
									<div class="row">
										<div class="col-12">
										  <div class="form-group">
											<label><?php echo e(trans('labels.name')); ?></label>
											<input class="form-control" type="text" name="name" placeholder="<?php echo e(trans('labels.name')); ?>" value="<?php echo e(Auth::user()->name); ?>">
											<?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
										  </div>
										</div>
										<div class="col-12">
										  <div class="form-group">
											<label><?php echo e(trans('labels.profile')); ?></label>
											<input class="form-control" type="file" name="profile_pic">
											<input class="form-control" type="hidden" name="old_img" value="<?php echo e(Auth::user()->profile_pic); ?>">
										  </div>
										  <img src="<?php echo e(Helper::image_path(Auth::user()->profile_pic)); ?>" class="img-fluid mb-3" alt="" width="120px">	
										</div>
										<div class="col-12">
											<div class="form-group">
												<label> <?php echo e(trans('labels.email')); ?></label>
												<input class="form-control" type="email" name="email" placeholder="<?php echo e(trans('labels.email')); ?>" value="<?php echo e(Auth::user()->email); ?>" readonly disabled>
											</div>
										</div>
										<div class="col-12">
											<div class="form-group">
												<label> <?php echo e(trans('labels.mobile')); ?></label>
												<input class="form-control" type="text" name="mobile" placeholder="<?php echo e(trans('labels.mobile')); ?>" value="<?php echo e(Auth::user()->mobile); ?>" readonly disabled>
											</div>
										</div>
										<div class="col-12">
										  <button class="btn btn-dark" type="submit"><?php echo e(trans('labels.save')); ?></button>
										</div>
									</div>
								</form>
							</div>
						</div>

						<?php if(Auth::user()->login_type == "email"): ?>
						<div class="card style-2 mb-4">
							<div class="card-header">
								<h4 class="mb-0"><?php echo e(trans('labels.change_password')); ?></h4>
							</div>
							<div class="card-body">
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
								<form class="submit-page" action="<?php echo e(URL::to('/changepassword')); ?>" method="post">
									<?php echo csrf_field(); ?>
									<div class="row">
										<div class="col-12">
										  <div class="form-group">
											<label><?php echo e(trans('labels.old_password')); ?></label>
											<input class="form-control" type="password" name="oldpassword" placeholder="<?php echo e(trans('labels.old_password')); ?>" value="<?php echo e(old('oldpassword')); ?>">
											<?php $__errorArgs = ['oldpassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
										  </div>
										</div>
									
										<div class="col-12">
											<div class="form-group">
												<label> <?php echo e(trans('labels.new_password')); ?></label>
												<input class="form-control" type="password" name="newpassword" placeholder="<?php echo e(trans('labels.new_password')); ?>" value="<?php echo e(old('newpassword')); ?>">
												<?php $__errorArgs = ['newpassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
											</div>
										</div>
										<div class="col-12">
											<div class="form-group">
												<label><?php echo e(trans('labels.confirm_password')); ?></label>
												<input class="form-control" type="password" name="confirmpassword" placeholder="<?php echo e(trans('labels.confirm_password')); ?>" value="<?php echo e(old('confirmpassword')); ?>">
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
										<div class="col-12">
										  <button class="btn btn-dark" type="submit"><?php echo e(trans('labels.save')); ?></button>
										</div>
									
									</div>
								</form>
							</div>
						</div>
						<?php endif; ?>
					<?php else: ?>
						<div class="text-center">
							<img src="<?php echo e(Helper::image_path('no-data.png')); ?>">
							<h2 class="error_title mt-4"><?php echo e(trans('labels.please_login')); ?></h2>
							<a href="<?php echo e(URL::to('/signin')); ?>" class="btn btn-primary"><?php echo e(trans('labels.login')); ?></a>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
	<!-- =========================== My All Orders =================================== -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.web', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/eglobalm/public_html/resources/views/Front/account.blade.php ENDPATH**/ ?>