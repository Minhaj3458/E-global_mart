<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.order_history')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<!-- =========================== Breadcrumbs =================================== -->
	<div class="brd_wraps pt-2 pb-2">
		<div class="container">
			<nav aria-label="breadcrumb" class="simple_breadcrumbs">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo e(URL::to('/')); ?>"><i class="ti-home"></i></a></li>
				<li class="breadcrumb-item active" aria-current="page"><?php echo e(trans('labels.order_history')); ?></li>
			  </ol>
			</nav>
		</div>
	</div>
	<!-- =========================== Breadcrumbs =================================== -->

	<!-- =========================== My All Orders =================================== -->
	<section class="gray">
		<div class="container">
			<div class="row">
				
				<?php echo $__env->make('includes.web.order-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

				<?php if(count($orderdata) <= 0): ?>
					<div class="col-lg-8 col-md-9 col-sm-12 col-12 text-center">
						<img src="<?php echo e(Helper::image_path('no-data.png')); ?>">
						<h2 class="error_title mt-4"><?php echo e(trans('labels.no_order')); ?></h2>
						<p><span class="text-primary"><?php echo e(trans('labels.woops')); ?></span> <?php echo e(trans('labels.orders_not_found')); ?></p>
						<a href="<?php echo e(URL::to('/')); ?>" class="btn btn-primary"><?php echo e(trans('labels.go_home_page')); ?></a>
					</div>
				<?php else: ?>
			
					<div class="col-lg-8 col-md-9 col-sm-12 col-12">
					
						<!-- Order Items -->
						<div class="card style-2">
							<div class="card-header">
								<h4 class="mb-0"><?php echo e(trans('labels.total_orders')); ?></h4>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table">
										<thead>
											<tr>
												<th scope="col"><?php echo e(trans('labels.order_number')); ?></th>
												<th scope="col"><?php echo e(trans('labels.payment_type')); ?></th>
												<th scope="col"><?php echo e(trans('labels.price')); ?></th>
												<th scope="col"><?php echo e(trans('labels.date')); ?></th>
												<th scope="col"><?php echo e(trans('labels.action')); ?></th>
											</tr>
										</thead>
										<tbody>
											<!-- payment_type = COD : 1, Wallet : 2, RazorPay : 3, Stripe : 4, Flutterwave : 5 -->
											<?php $__currentLoopData = $orderdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orders): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr>
												<td><a href="<?php echo e(URL::to('order-details/'.$orders->order_number)); ?>"> <?php echo e($orders->order_number); ?></a></td>
												<td>
													<?php if($orders->payment_type == 1): ?>
														<?php echo e(trans('labels.COD')); ?>

													<?php endif; ?>
													<?php if($orders->payment_type == 2): ?>
														<?php echo e(trans('labels.Wallet')); ?>

													<?php endif; ?>
													<?php if($orders->payment_type == 3): ?>
														<?php echo e(trans('labels.RazorPay')); ?>

													<?php endif; ?>
													<?php if($orders->payment_type == 4): ?>
														<?php echo e(trans('labels.Stripe')); ?>

													<?php endif; ?>
													<?php if($orders->payment_type == 5): ?>
														<?php echo e(trans('labels.Flutterwave')); ?>

													<?php endif; ?>
													<?php if($orders->payment_type == 6): ?>
														<?php echo e(trans('labels.Paystack')); ?>

													<?php endif; ?>
												</td>
												<td><?php echo e(Helper::CurrencyFormatter($orders->grand_total)); ?></td>
												<td><?php echo e($orders->date); ?></td>
												<td><a href="<?php echo e(URL::to('order-details/'.$orders->order_number)); ?>" class="btn btn-sm btn-theme"><?php echo e(trans('labels.view_order')); ?></a></td>
											</tr>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</tbody>
									</table>
									<div class="d-flex justify-content-center ">
										<?php echo e($orderdata->links()); ?>

									</div>

								</div>
							</div>
						</div>
						
					</div>						
				<?php endif; ?>
			</div>
		</div>
	</section>
	<!-- =========================== My All Orders =================================== -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.web', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/eglobalm/public_html/resources/views/Front/order-history.blade.php ENDPATH**/ ?>