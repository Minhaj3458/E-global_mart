<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.wishlist')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<!-- =========================== Breadcrumbs =================================== -->
	<div class="brd_wraps pt-2 pb-2">
		<div class="container">
			<nav aria-label="breadcrumb" class="simple_breadcrumbs">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo e(URL::to('/')); ?>"><i class="ti-home"></i></a></li>
				<li class="breadcrumb-item active" aria-current="page"><?php echo e(trans('labels.wishlist')); ?></li>
			  </ol>
			</nav>
		</div>
	</div>
	<!-- =========================== Breadcrumbs =================================== -->

	<!-- =========================== Wishlist-Products =================================== -->
	<section class="sixcol">
		<div class="container-fluid">
			<?php if(count($products) <= 0 || !Auth::user()): ?>
				<div class="col-lg-12 col-md-12 text-center">
					<img src="<?php echo e(Helper::image_path('no-data.png')); ?>">
					<?php if(Auth::user()): ?>
						<h2 class="error_title mt-4"><?php echo e(trans('labels.empty_wishlist')); ?></h2>
						<p><span class="text-primary"><?php echo e(trans('labels.woops')); ?></span> <?php echo e(trans('labels.wishlist_is_empty')); ?></p>
						<a href="<?php echo e(URL::to('/')); ?>" class="btn btn-primary"><?php echo e(trans('labels.go_home_page')); ?></a>
					<?php else: ?>
						<h2 class="error_title mt-4"><?php echo e(trans('labels.please_login')); ?></h2>
						<p><?php echo e(trans('labels.login_text_wishlist')); ?></p>
						<a href="<?php echo e(URL::to('/signin')); ?>" class="btn btn-primary"><?php echo e(trans('labels.login')); ?></a>
					<?php endif; ?>
				</div>
			<?php else: ?>
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<!-- row -->
						<div class="row" id="product-filter">
							<?php echo $__env->make('Front.filterproduct', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
						</div>
						<!-- row -->
					</div>
					<div class="d-flex justify-content-center">
						<?php echo e($products->links()); ?>

					</div>
				</div>
			<?php endif; ?>
		</div>
	</section>
	<!-- =========================== Wishlist-Products =================================== -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.web', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/eglobalm/public_html/resources/views/Front/wishlist.blade.php ENDPATH**/ ?>