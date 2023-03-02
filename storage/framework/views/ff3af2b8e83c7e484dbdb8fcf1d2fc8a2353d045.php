<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.brand')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<!-- =========================== Breadcrumbs =================================== -->
	<div class="brd_wraps pt-2 pb-2">
		<div class="container">
			<nav aria-label="breadcrumb" class="simple_breadcrumbs">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#"><i class="ti-home"></i></a></li>
				<li class="breadcrumb-item active" aria-current="page"><?php echo e(trans('labels.brand')); ?></li>
			  </ol>
			</nav>
		</div>
	</div>
	<!-- =========================== Breadcrumbs =================================== -->

	<!-- =========================== Brands =================================== -->

   	<section class="pt-5 pb-5">
   		<div class="container">

   			<div class="row">
				<!-- Single Item -->
				<?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key9 => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<a href="<?php echo e(URL::to('brands/'.$value->id)); ?>">
					<div class="col-2xl-2 col-xl-3 col-lg-4 col-sm-6 mb-4">
						<div class="item">
							<div class="woo_category_box border_style circle">
								<div class="woo_cat_thumb">
									<img src="<?php echo e($value['image_url']); ?>" class="img-fluid" alt="" />
								</div>
							</div>
						</div>
					</div>
					</a>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   			</div>
   			
   		</div>
   	</section>
	<!-- =========================== Brands =================================== -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripttop'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.web', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/eglobalm/public_html/resources/views/Front/all-brand.blade.php ENDPATH**/ ?>