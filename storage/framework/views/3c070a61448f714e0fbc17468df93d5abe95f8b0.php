<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.category')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<!-- =========================== Breadcrumbs =================================== -->
	<div class="brd_wraps pt-2 pb-2">
		<div class="container">
			<nav aria-label="breadcrumb" class="simple_breadcrumbs">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#"><i class="ti-home"></i></a></li>
				<li class="breadcrumb-item active" aria-current="page"><?php echo e(trans('labels.category')); ?></li>
			  </ol>
			</nav>
		</div>
	</div>
	<!-- =========================== Breadcrumbs =================================== -->

	<!-- =========================== Category =================================== -->

   	<section class="gray">
   		<div class="container">
   			<?php $__currentLoopData = Helper::getCategory(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      		<div class="p-3 border-bottom fs-16 fw-600 text-center">
         		<h2><a href="<?php echo e(URL::to('categories/products/'.$category->slug)); ?>"> <?php echo e($category->category_name); ?> </a></h2>
      		</div>
      		<div class="p-3 p-lg-4">
         		<div class="row">
         			<?php $__currentLoopData = Helper::getSubcategory(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	         			<?php if($sub->cat_id==$category->id): ?>
			            <div class="col-lg-3 col-6 text-left">
			               	<h6 class="mb-3"><a class="text-reset fw-600 fs-14" href="<?php echo e(URL::to('subcategories/products/'.$category->slug.'/'.$sub->slug)); ?>"><?php echo e($sub->subcategory_name); ?></a></h6>
			               	<ul class="mb-3 list-unstyled pl-2">
			               		<?php $__currentLoopData = Helper::InnerSubcategory(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			               		<?php if($inner->subcat_id==$sub->id): ?>
			                  	<li class="mb-2">
			                     	<a class="text-reset" href="<?php echo e(URL::to('innersubcategories/products/'.$category->slug.'/'.$sub->slug.'/'.$inner->slug)); ?>"><?php echo e($inner->innersubcategory_name); ?></a>
			                  	</li>
              		            <?php endif; ?>
              	            	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			               	</ul>
			            </div>
			            <?php endif; ?>
		            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         		</div>
      		</div>
      		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      	</div>
   	</section>
	<!-- =========================== Category =================================== -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripttop'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.web', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/eglobalm/public_html/resources/views/Front/categories.blade.php ENDPATH**/ ?>