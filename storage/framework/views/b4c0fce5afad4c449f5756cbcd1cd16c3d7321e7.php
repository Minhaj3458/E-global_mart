<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.offers')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<!-- =========================== Breadcrumbs =================================== -->
	<div class="brd_wraps pt-2 pb-2">
		<div class="container">
			<nav aria-label="breadcrumb" class="simple_breadcrumbs">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#"><i class="ti-home"></i></a></li>
				<li class="breadcrumb-item active" aria-current="page"><?php echo e(trans('labels.offers')); ?></li>
			  </ol>
			</nav>
		</div>
	</div>
	<!-- =========================== Breadcrumbs =================================== -->

	<!-- =========================== Offers =================================== -->

   	<section class="gray">
   		<div class="container">
   			<div class="row">
   				<?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   				<!-- Single Blog -->
   				<div class="col-lg-4 col-md-6 col-sm-6 mb-4">
   					<div class="coupon p-3 bg-white">
   					    <div class="row no-gutters">
   					        <div class="col-md-4 border-right">
   					            <div class="d-flex flex-column align-items-center"><img src="<?php echo e(asset('storage/app/public/Webassets/img/discount.png')); ?>"><span class="d-block mt-2"><?php echo e(trans('labels.expire')); ?></span><span class="text-black-50"><?php echo e(date('d M Y', strtotime($offers->end_date))); ?></span></div>
   					        </div>
   					        <div class="col-md-8">
   					            <div>
   					                <div class="d-flex flex-row justify-content-end off">
   					                	<?php if($offers->amount != ""): ?>
   					                    	<h1><?php echo e(Helper::CurrencyFormatter($offers->amount)); ?></h1><span><?php echo e(trans('labels.off')); ?></span>
   					                    <?php endif; ?>

				                    	<?php if($offers->percentage != ""): ?>
				                        	<h1><?php echo e($offers->percentage); ?>%</h1><span><?php echo e(trans('labels.off')); ?></span>
				                        <?php endif; ?>
   					                </div>
   					                <div class="d-flex flex-row justify-content-between off px-3 p-2"><span><?php echo e(trans('labels.promo_code')); ?></span><span class="border border-success px-3 rounded code"><?php echo e($offers->coupon_name); ?></span></div>
   					            </div>
   					        </div>
   					    </div>
   					</div>
   				</div>
   				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   			</div>
   		</div>
   	</section>
	<!-- =========================== Category =================================== -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripttop'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.web', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/eglobalm/public_html/resources/views/Front/offers.blade.php ENDPATH**/ ?>