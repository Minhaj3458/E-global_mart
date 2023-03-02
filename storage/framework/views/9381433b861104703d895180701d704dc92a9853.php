<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.help')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<!-- =========================== Breadcrumbs =================================== -->
	<div class="brd_wraps pt-2 pb-2">
		<div class="container">
			<nav aria-label="breadcrumb" class="simple_breadcrumbs">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#"><i class="ti-home"></i></a></li>
				<li class="breadcrumb-item active" aria-current="page"><?php echo e(trans('labels.help')); ?></li>
			  </ol>
			</nav>
		</div>
	</div>
	<!-- =========================== Breadcrumbs =================================== -->

	<!-- =========================== Help =================================== -->

   	<section class="gray">
   		<div class="container">
   			
   			<div class="row mt-12 align-items-center">
   				<div class="col-lg-12 col-md-12">
   					<?php if(Session::has('success')): ?>
   					<div class="alert alert-success">
   					    <?php echo e(Session::get('success')); ?>

   					    <?php
   					        Session::forget('success');
   					    ?>
   					</div>
   					<?php endif; ?>
   					<div class="contact-form">
   						<form method="post" action="<?php echo e(URL::to('/helpform')); ?>">
   							<?php echo csrf_field(); ?>
   							<div class="form-row">
   							
   								<div class="form-group col-md-6">
   								  <label><?php echo e(trans('labels.first_name')); ?></label>
   								  <input type="text" class="form-control" name="first_name" placeholder="<?php echo e(trans('labels.first_name')); ?>">
   								  <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
   								</div>
   								
   								<div class="form-group col-md-6">
   								  <label><?php echo e(trans('labels.last_name')); ?></label>
   								  <input type="text" class="form-control" name="last_name" placeholder="<?php echo e(trans('labels.last_name')); ?>">
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
   							<div class="form-row">
   							
   								<div class="form-group col-md-6">
   								  <label><?php echo e(trans('labels.email')); ?></label>
   								  <input type="email" class="form-control" name="email" placeholder="<?php echo e(trans('labels.email')); ?>">
   								  <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
   								</div>
   								
   								<div class="form-group col-md-6">
   								  <label><?php echo e(trans('labels.mobile')); ?></label>
   								  <input type="text" class="form-control" name="mobile" placeholder="<?php echo e(trans('labels.mobile')); ?>">
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
   							
   							<div class="form-group col-lg-12 col-md-12">
   								<label><?php echo e(trans('labels.subject')); ?></label>
   								<input type="text" class="form-control" name="subject" placeholder="<?php echo e(trans('labels.subject')); ?>">
   								<?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
   							</div>
   							
   							<div class="form-group col-lg-12 col-md-12">
   								<label><?php echo e(trans('labels.message')); ?></label>
   								<textarea class="form-control" name="message" placeholder="<?php echo e(trans('labels.message')); ?>"></textarea>
   								<?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
   							</div>
   							
   							<div class="form-group col-lg-12 col-md-12">
   								<button type="submit" class="btn btn-primary">Send Request</button>
   							</div>
   							
   						</form>
   					</div>
   				</div>
   				
   			</div>
   			
   		</div>
   	</section>
	<!-- =========================== Help =================================== -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripttop'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.web', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/eglobalm/public_html/resources/views/Front/help.blade.php ENDPATH**/ ?>