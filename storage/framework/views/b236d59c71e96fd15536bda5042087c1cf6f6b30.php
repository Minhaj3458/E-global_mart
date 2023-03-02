<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.track_order')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
	<!-- =========================== Breadcrumbs =================================== -->
	<div class="brd_wraps pt-2 pb-2">
		<div class="container">
			<nav aria-label="breadcrumb" class="simple_breadcrumbs">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#"><i class="ti-home"></i></a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(URL::to('order-history')); ?>"><?php echo e(trans('labels.orders')); ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><?php echo e($order_info->order_number); ?></li>
			  </ol>
			</nav>
		</div>
	</div>
	<!-- =========================== Breadcrumbs =================================== -->
	<!-- =========================== My All Orders =================================== -->
	<section>
		<div class="container">
			<div class="row">
				<?php if(empty($order_info->order_number)): ?>
					<div class="col-lg-12 col-md-12 text-center">
						<img src="<?php echo e(Helper::image_path('no-data.png')); ?>">
						<h2 class="error_title mt-4"><?php echo e(trans('labels.no_product')); ?></h2>
						<p><span class="text-primary">Woops!</span> <?php echo e(trans('labels.try_another_category')); ?></p>
						<a href="<?php echo e(URL::to('/')); ?>" class="btn btn-primary"><?php echo e(trans('labels.go_home_page')); ?></a>
					</div>
				<?php else: ?>
				
				<?php echo $__env->make('includes.web.order-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				
					<div class="col-lg-8 col-md-9 col-sm-12 col-12">
						
						<div class="checked-shop">
						
							<ul class="item-groups">
								<!-- Single Items -->
								<li style="border: none;">
									<div class="row align-items-center">
										<div class="col-4 col-md-3 col-xl-2">
											<a href="#"><img src="<?php echo e($order_info->image_url); ?>" alt="..." class="img-fluid" style="width: 800px; object-fit: scale-down;"></a>
										</div>
										
										<div class="col">
											<!-- Title -->
											<p class="mb-2 font-size-sm font-weight-bold">
												<a class="text-body" href="<?php echo e(URL::to('products/product-details/'.$order_info->slug)); ?>"><?php echo e($order_info->product_name); ?></a>
											</p>
											<div class="page-header">
											  	<div class="float-left">
											  		<?php if($order_info->variation != ""): ?>
											  	 		<?php echo e($order_info->attribute); ?> : <?php echo e($order_info->variation); ?><br>
											  		<?php endif; ?>
											  	</div>
											  	<div class="clearfix"></div>
											</div>
											<div class="page-header">
											  	<div class="float-left">
											  		<?php echo e(trans('labels.qty')); ?>: <?php echo e($order_info->qty); ?>

											  	</div>
											  	<div class="float-right">
												  	<p class="text-right theme-cl"><?php echo e(Helper::CurrencyFormatter($order_info->price * $order_info->qty)); ?></p>
											  	</div>
											  	<div class="clearfix"></div>
											</div>
										</div>
									</div>
								</li>
							</ul>
							
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12">
									<?php if($order_info['status'] != 5 && $order_info['status'] != 6 && $order_info['status'] == 4 && $ratting!=1): ?>
										<div class="float-right">
											<button class="btn btn-sm btn-success write-review" data-product-id="<?php echo e($order_info->product_id); ?>" data-vendor-id="<?php echo e($order_info->vendor_id); ?>" data-product-name="<?php echo e($order_info->product_name); ?>" data-product-image="<?php echo e($order_info->image_url); ?>"><?php echo e(trans('labels.write_review')); ?></button>
										</div>
									<?php endif; ?>
									
									<ul class="track_order_list mt-4">
										<?php if($order_info['status'] == 1): ?>
											<li class="complete">
												<div class="trach_single_list">
													<div class="trach_icon_list"><i class="ti-write"></i></div>
													<div class="track_list_caption">
														<h4 class="mb-0"><?php echo e(trans('labels.order_placed')); ?></h4>
														<p><?php echo e(trans('labels.order_placed_text')); ?></p>
													</div>
												</div>
											</li>
											<li class="processing">
												<div class="trach_single_list">
													<div class="trach_icon_list"><i class="ti-package"></i></div>
													<div class="track_list_caption">
														<h4 class="mb-0"><?php echo e(trans('labels.confirmed')); ?></h4>
														<p><?php echo e(trans('labels.order_confirmed_text')); ?></p>
													</div>
												</div>
											</li>
											<li>
												<div class="trach_single_list">
													<div class="trach_icon_list"><i class="ti-gift"></i></div>
													<div class="track_list_caption">
														<h4 class="mb-0"><?php echo e(trans('labels.order_shipped')); ?></h4>
														<p><?php echo e(trans('labels.order_shipped')); ?></p>
													</div>
												</div>
											</li>
											<li>
												<div class="trach_single_list">
													<div class="trach_icon_list"><i class="ti-thumb-up"></i></div>
													<div class="track_list_caption">
														<h4 class="mb-0"><?php echo e(trans('labels.delivered')); ?></h4>
														<p><?php echo e(trans('labels.delivered_text')); ?></p>
													</div>
												</div>
											</li>
										<?php endif; ?>
										<?php if($order_info['status'] == 2): ?>
											<li class="complete">
												<div class="trach_single_list">
													<div class="trach_icon_list"><i class="ti-write"></i></div>
													<div class="track_list_caption">
														<h4 class="mb-0"><?php echo e(trans('labels.order_placed')); ?></h4>
														<p><?php echo e(trans('labels.order_placed_text')); ?></p>
													</div>
												</div>
											</li>
											<li class="complete">
												<div class="trach_single_list">
													<div class="trach_icon_list"><i class="ti-package"></i></div>
													<div class="track_list_caption">
														<h4 class="mb-0"><?php echo e(trans('labels.confirmed')); ?></h4>
														<p><?php echo e(trans('labels.order_confirmed_text')); ?></p>
													</div>
												</div>
											</li>
											<li class="processing">
												<div class="trach_single_list">
													<div class="trach_icon_list"><i class="ti-gift"></i></div>
													<div class="track_list_caption">
														<h4 class="mb-0"><?php echo e(trans('labels.order_shipped')); ?></h4>
														<p><?php echo e(trans('labels.order_shipped')); ?></p>
													</div>
												</div>
											</li>
											<li>
												<div class="trach_single_list">
													<div class="trach_icon_list"><i class="ti-thumb-up"></i></div>
													<div class="track_list_caption">
														<h4 class="mb-0"><?php echo e(trans('labels.delivered')); ?></h4>
														<p><?php echo e(trans('labels.delivered_text')); ?></p>
													</div>
												</div>
											</li>
										<?php endif; ?>
										<?php if($order_info['status'] == 3): ?>
											<li class="complete">
												<div class="trach_single_list">
													<div class="trach_icon_list"><i class="ti-write"></i></div>
													<div class="track_list_caption">
														<h4 class="mb-0"><?php echo e(trans('labels.order_placed')); ?></h4>
														<p><?php echo e(trans('labels.order_placed_text')); ?></p>
													</div>
												</div>
											</li>
											<li class="complete">
												<div class="trach_single_list">
													<div class="trach_icon_list"><i class="ti-package"></i></div>
													<div class="track_list_caption">
														<h4 class="mb-0"><?php echo e(trans('labels.confirmed')); ?></h4>
														<p><?php echo e(trans('labels.order_confirmed_text')); ?></p>
													</div>
												</div>
											</li>
											<li class="complete">
												<div class="trach_single_list">
													<div class="trach_icon_list"><i class="ti-gift"></i></div>
													<div class="track_list_caption">
														<h4 class="mb-0"><?php echo e(trans('labels.order_shipped')); ?></h4>
														<p><?php echo e(trans('labels.order_shipped')); ?></p>
													</div>
												</div>
											</li>
											<li class="processing">
												<div class="trach_single_list">
													<div class="trach_icon_list"><i class="ti-thumb-up"></i></div>
													<div class="track_list_caption">
														<h4 class="mb-0"><?php echo e(trans('labels.delivered')); ?></h4>
														<p><?php echo e(trans('labels.delivered_text')); ?></p>
													</div>
												</div>
											</li>
										<?php endif; ?>
										<?php if($order_info['status'] == 4): ?>
											<li class="complete">
												<div class="trach_single_list">
													<div class="trach_icon_list"><i class="ti-write"></i></div>
													<div class="track_list_caption">
														<h4 class="mb-0"><?php echo e(trans('labels.order_placed')); ?></h4>
														<p><?php echo e(trans('labels.order_placed_text')); ?></p>
													</div>
												</div>
											</li>
											<li class="complete">
												<div class="trach_single_list">
													<div class="trach_icon_list"><i class="ti-package"></i></div>
													<div class="track_list_caption">
														<h4 class="mb-0"><?php echo e(trans('labels.confirmed')); ?></h4>
														<p><?php echo e(trans('labels.order_confirmed_text')); ?></p>
													</div>
												</div>
											</li>
											<li class="complete">
												<div class="trach_single_list">
													<div class="trach_icon_list"><i class="ti-gift"></i></div>
													<div class="track_list_caption">
														<h4 class="mb-0"><?php echo e(trans('labels.order_shipped')); ?></h4>
														<p><?php echo e(trans('labels.order_shipped')); ?></p>
													</div>
												</div>
											</li>
											<li class="complete">
												<div class="trach_single_list">
													<div class="trach_icon_list"><i class="ti-thumb-up"></i></div>
													<div class="track_list_caption">
														<h4 class="mb-0"><?php echo e(trans('labels.delivered')); ?></h4>
														<p><?php echo e(trans('labels.delivered_text')); ?></p>
													</div>
												</div>
											</li>
										<?php endif; ?>
										<?php if($order_info['status'] == 5): ?>
											<li class="cancel">
												<div class="trach_single_list">
													<div class="trach_icon_list"><i class="ti-close"></i></div>
													<div class="track_list_caption">
														<h4 class="mb-0"><?php echo e(trans('labels.cancelled')); ?></h4>
														<p><?php echo e(trans('labels.cancelled_by_vendor')); ?></p>
													</div>
												</div>
											</li>
										<?php endif; ?>
										<?php if($order_info['status'] == 6): ?>
											<li class="cancel">
												<div class="trach_single_list">
													<div class="trach_icon_list"><i class="ti-close"></i></div>
													<div class="track_list_caption">
														<h4 class="mb-0"><?php echo e(trans('labels.cancelled')); ?></h4>
														<p><?php echo e(trans('labels.cancelled_by_user')); ?></p>
													</div>
												</div>
											</li>
										<?php endif; ?>
										<?php if($order_info['status'] == 7): ?>
											<li class="complete">
												<div class="trach_single_list">
													<div class="trach_icon_list"><i class="ti-write"></i></div>
													<div class="track_list_caption">
														<h4 class="mb-0"><?php echo e(trans('labels.return')); ?></h4>
														<p><?php echo e(trans('labels.return')); ?></p>
													</div>
												</div>
											</li>
											<li class="processing">
												<div class="trach_single_list">
													<div class="trach_icon_list"><i class="ti-package"></i></div>
													<div class="track_list_caption">
														<h4 class="mb-0"><?php echo e(trans('labels.return_progress')); ?></h4>
														<p><?php echo e(trans('labels.return_progress')); ?></p>
													</div>
												</div>
											</li>
											<li>
												<div class="trach_single_list">
													<div class="trach_icon_list"><i class="ti-gift"></i></div>
													<div class="track_list_caption">
														<h4 class="mb-0"><?php echo e(trans('labels.return_complete')); ?></h4>
														<p><?php echo e(trans('labels.return_complete')); ?></p>
													</div>
												</div>
											</li>
										<?php endif; ?>
										<?php if($order_info['status'] == 8): ?>
											<li class="complete">
												<div class="trach_single_list">
													<div class="trach_icon_list"><i class="ti-write"></i></div>
													<div class="track_list_caption">
														<h4 class="mb-0"><?php echo e(trans('labels.return')); ?></h4>
														<p><?php echo e(trans('labels.return')); ?></p>
													</div>
												</div>
											</li>
											<li class="complete">
												<div class="trach_single_list">
													<div class="trach_icon_list"><i class="ti-package"></i></div>
													<div class="track_list_caption">
														<h4 class="mb-0"><?php echo e(trans('labels.return_progress')); ?></h4>
														<p><?php echo e(trans('labels.return_progress')); ?></p>
													</div>
												</div>
											</li>
											<li class="processing">
												<div class="trach_single_list">
													<div class="trach_icon_list"><i class="ti-gift"></i></div>
													<div class="track_list_caption">
														<h4 class="mb-0"><?php echo e(trans('labels.return_complete')); ?></h4>
														<p><?php echo e(trans('labels.return_complete')); ?></p>
													</div>
												</div>
											</li>
										<?php endif; ?>
										<?php if($order_info['status'] == 9): ?>
											<li class="complete">
												<div class="trach_single_list">
													<div class="trach_icon_list"><i class="ti-write"></i></div>
													<div class="track_list_caption">
														<h4 class="mb-0"><?php echo e(trans('labels.return')); ?></h4>
														<p><?php echo e(trans('labels.return_text')); ?></p>
													</div>
												</div>
											</li>
											<li class="complete">
												<div class="trach_single_list">
													<div class="trach_icon_list"><i class="ti-package"></i></div>
													<div class="track_list_caption">
														<h4 class="mb-0"><?php echo e(trans('labels.return_progress')); ?></h4>
														<p><?php echo e(trans('labels.return_progress')); ?></p>
													</div>
												</div>
											</li>
											<li class="complete">
												<div class="trach_single_list">
													<div class="trach_icon_list"><i class="ti-gift"></i></div>
													<div class="track_list_caption">
														<h4 class="mb-0"><?php echo e(trans('labels.return_complete')); ?></h4>
														<p><?php echo e(trans('labels.return_complete')); ?></p>
													</div>
												</div>
											</li>
										<?php endif; ?>
										<?php if($order_info['status'] == 10): ?>
											<li class="cancel">
												<div class="trach_single_list">
													<div class="trach_icon_list"><i class="ti-close"></i></div>
													<div class="track_list_caption">
														<h4 class="mb-0"><?php echo e(trans('labels.return_reject')); ?></h4>
														<p><?php echo e($order_info['vendor_comment']); ?></p>
													</div>
												</div>
											</li>
										<?php endif; ?>
									</ul>
								</div>
							</div>
						
						</div>
						
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<!-- =========================== My All Orders =================================== -->
	<!-- Modal Add Review-->
	<div class="modal fade text-left" id="AddReview" tabindex="-1" role="dialog" aria-labelledby="RditProduct"
	aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <label class="modal-title text-text-bold-600" id="RditProduct"><?php echo e(trans('labels.add_review')); ?></label>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div id="errorr" style="color: red;"></div>
	      
	      <form method="post" action="<?php echo e(URL::to('addratting')); ?>" method="post">
	      <?php echo e(csrf_field()); ?>

	        <div class="modal-body">
	          <div class="text-center" id="data-product-image">
	          </div>
	          <div class="text-center">
	            <p class="mt-4 font-weight-bold">
	              <h3 id="data-product-name"></h3>
	            </p>
	          </div>
	          <div class="rating"> 
	            <input type="radio" name="ratting" value="5" id="star5"><label for="star5">☆</label> 
	            <input type="radio" name="ratting" value="4" id="star4"><label for="star4">☆</label> 
	            <input type="radio" name="ratting" value="3" id="star3"><label for="star3">☆</label> 
	            <input type="radio" name="ratting" value="2" id="star2"><label for="star2">☆</label> 
	            <input type="radio" name="ratting" value="1" id="star1"><label for="star1">☆</label>
	          </div>
	          <label>Comment </label>
	          <div class="form-group">
	            <textarea class="form-control" name="comment" id="comment" rows="5" required=""></textarea>
	            <input type="hidden" name="user_id" id="user_id" class="form-control" value="<?php echo e(@Auth::user()->id); ?>">
	            <input type="hidden" name="product_id" id="data-product-id" class="form-control" value="">
	            <input type="hidden" name="vendor_id" id="data-vendor-id" class="form-control" value="">
	          </div>
	        </div>
	        <div class="modal-footer">
	          <input type="submit" class="btn btn-theme" value="Submit">
	        </div>
	      </form>
	    </div>
	  </div>
	</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripttop'); ?>
<script type="text/javascript">
	$(document).ready(function(){
	   $(".write-review").click(function(){ // Click to only happen on announce links
	     $("#data-product-name").text($(this).attr('data-product-name'));
	     $("#data-product-id").val($(this).attr('data-product-id'));
	     $("#data-vendor-id").val($(this).attr('data-vendor-id'));
	     $("#data-product-image").html("<img src="+$(this).attr('data-product-image')+" class='img-fluid' style='max-height: 200px;'>");
	     $('#AddReview').modal('show');
	   });
	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.web', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/eglobalm/public_html/resources/views/Front/track-order.blade.php ENDPATH**/ ?>