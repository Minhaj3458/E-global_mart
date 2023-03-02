<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.success')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<!-- =========================== Success =================================== -->
	<section>
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-10 col-md-12 col-sm-12">
				
					<div class="card py-3 mt-sm-3">
					  <div class="card-body text-center">
						<h2 class="pb-2"><?php echo e(trans('labels.thanks_for_order')); ?></h2>
						<p class="font-size-sm mb-2"><?php echo e(trans('labels.order_placed')); ?></p>
						<p class="font-size-sm mb-2"><?php echo e(trans('labels.order_number_sucess')); ?> <span class="font-weight-medium"><b><?php echo e($order_info->order_number); ?></b>.</span></p>
						<p class="font-size-sm"><?php echo e(trans('labels.order_confirmation_text')); ?></p><a class="btn btn-secondary mt-3 mr-3" href="<?php echo e(URL::to('/')); ?>"><?php echo e(trans('labels.go_home_page')); ?></a><a class="btn btn-primary mt-3" href="<?php echo e(URL::to('order-history')); ?>"><i class="czi-location"></i>&nbsp;<?php echo e(trans('labels.track_order')); ?></a>
					  </div>
					</div>
				
				</div>
			</div>
		</div>
	</section>
	<!-- =========================== Success =================================== -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.web', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/eglobalm/public_html/resources/views/Front/success.blade.php ENDPATH**/ ?>