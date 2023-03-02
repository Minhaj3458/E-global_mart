<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.order_details')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<!-- =========================== Breadcrumbs =================================== -->
	<div class="brd_wraps pt-2 pb-2">
		<div class="container">
			<nav aria-label="breadcrumb" class="simple_breadcrumbs">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo e(URL::to('/')); ?>"><i class="ti-home"></i></a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(URL::to('order-history')); ?>"><?php echo e(trans('labels.order_details')); ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><?php echo e($order_infos['order_number']); ?></li>
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
						<h2 class="error_title mt-4"><?php echo e(trans('labels.no_data')); ?></h2>
						<p><span class="text-primary"><?php echo e(trans('labels.woops')); ?></span> <?php echo e(trans('labels.try_another_order')); ?></p>
						<a href="<?php echo e(URL::to('/')); ?>" class="btn btn-primary"><?php echo e(trans('labels.go_home_page')); ?></a>
					</div>
				<?php else: ?>
					<div class="col-lg-8 col-md-9">
						<div class="card-body bg-white mb-4">
							<div class="row">
								<div class="col-6 col-lg-3">
									<h6 class="text-muted mb-1"><?php echo e(trans('labels.order_number')); ?></h6>
									<p class="mb-lg-0 font-size-sm font-weight-bold"><?php echo e($order_infos['order_number']); ?></p>
								</div>
								
								<div class="col-6 col-lg-3">
									<h6 class="text-muted mb-1"><?php echo e(trans('labels.date')); ?></h6>
									<p class="mb-lg-0 font-size-sm font-weight-bold">
										<span><?php echo e($order_infos['date']); ?></span>
									</p>
								</div>
								
								<div class="col-6 col-lg-3">
									<h6 class="text-muted mb-1"><?php echo e(trans('labels.payment_type')); ?></h6>
									<p class="mb-0 font-size-sm font-weight-bold">
										<?php if($order_infos['payment_type'] == 1): ?>
											<?php echo e(trans('labels.COD')); ?>

										<?php endif; ?>
										<?php if($order_infos['payment_type'] == 2): ?>
											<?php echo e(trans('labels.Wallet')); ?>

										<?php endif; ?>
										<?php if($order_infos['payment_type'] == 3): ?>
											<?php echo e(trans('labels.RazorPay')); ?>

										<?php endif; ?>
										<?php if($order_infos['payment_type'] == 4): ?>
											<?php echo e(trans('labels.Stripe')); ?>

										<?php endif; ?>
										<?php if($order_infos['payment_type'] == 5): ?>
											<?php echo e(trans('labels.Flutterwave')); ?>

										<?php endif; ?>
										<?php if($order_infos['payment_type'] == 6): ?>
											<?php echo e(trans('labels.Paystack')); ?>

										<?php endif; ?>
									</p>
								</div>
								
								<div class="col-6 col-lg-3">
									<!-- Heading -->
									<h6 class="text-muted mb-1"><?php echo e(trans('labels.order_amount')); ?></h6>
									<p class="mb-0 font-size-sm font-weight-bold"><?php echo e(Helper::CurrencyFormatter($order_infos['grand_total'])); ?></p>
								</div>
								
							</div>
						</div>
						
						<!-- Order Items -->
						<div class="card style-2 mb-4">
							<div class="card-header">
								<h4 class="mb-0"><?php echo e(trans('labels.order_items')); ?> <?php echo e(count($orderdata)); ?></h4>
							</div>
							<div class="card-body">
								<ul class="item-groups">
									<?php $__currentLoopData = $orderdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<li style="border: none;">
										<div class="row align-items-center">
											<div class="col-4 col-md-3 col-xl-2">
												<a href="#"><img src="<?php echo e($value->image_url); ?>" alt="..." class="img-fluid" style="width: 800px; object-fit: scale-down;"></a>
											</div>
											<div class="col">
												<!-- Title -->
												<p class="mb-2 font-size-sm font-weight-bold">
													<a class="text-body" href="<?php echo e(URL::to('products/product-details/'.$value->slug)); ?>"><?php echo e($value->product_name); ?></a>
												</p>

												<div class="page-header">
												  	<div class="float-left">
												  		<?php if($value->variation != ""): ?>
												  	 		<?php echo e($value->attribute); ?> : <?php echo e($value->variation); ?><br>
												  		<?php endif; ?>
												  	</div>
												  	<div class="float-right">
													  	<?php if($value['status'] == 5): ?>
													  		<p class="theme-cl"><?php echo e(trans('labels.cancelled_by_vendor')); ?></p>
													  	<?php endif; ?>
													  	<?php if($value['status'] == 6): ?>
													  		<p class="theme-cl"><?php echo e(trans('labels.cancelled_by_user')); ?></p>
													  	<?php endif; ?>
												  	</div>
												  	<div class="clearfix"></div>
												</div>

												<div class="page-header">
												  	<div class="float-left">
												  		<?php echo e(trans('labels.qty')); ?> : <?php echo e($value->qty); ?> * <?php echo e(Helper::CurrencyFormatter($value->price )); ?>

												  	</div>
												</div>
											</div>
										</div>
									</li>
									<div class="row">
										<div class="col-6 col-lg-3 text-center">
											<h6 class="text-muted mb-1"><?php echo e(trans('labels.shipping')); ?></h6>
											<p class="mb-lg-0 font-size-sm font-weight-bold"><?php echo e(Helper::CurrencyFormatter($value->shipping_cost)); ?></p>
										</div>
										<div class="col-6 col-lg-3 text-center">
											<h6 class="text-muted mb-1"><?php echo e(trans('labels.tax')); ?></h6>
											<p class="mb-lg-0 font-size-sm font-weight-bold"><?php echo e(Helper::CurrencyFormatter($value->tax)); ?></p>
										</div>
										<div class="col-6 col-lg-3 text-center">
											<h6 class="text-muted mb-1"><?php echo e(trans('labels.discount')); ?></h6>
											<?php if($value->discount_amount != ""): ?>
												<p class="mb-lg-0 font-size-sm font-weight-bold"><?php echo e(Helper::CurrencyFormatter($value->discount_amount)); ?></p>
											<?php else: ?>
												<p class="mb-lg-0 font-size-sm font-weight-bold"><?php echo e(Helper::CurrencyFormatter(0)); ?></p>
											<?php endif; ?>
										</div>

										<div class="col-6 col-lg-3 text-center">
											<h6 class="text-muted mb-1"><?php echo e(trans('labels.total')); ?></h6>
											<p class="mb-lg-0 font-size-sm font-weight-bold"><?php echo e(Helper::CurrencyFormatter($value->price * $value->qty+$value->tax+$value->shipping_cost)); ?>

											</p>
										</div>

										<div class="col-6 col-lg-12 text-right mt-3">
											<div class="page-header">
											  	<div class="float-right">
											  		<a href="<?php echo e(URL::to('track-order/'.$value->id)); ?>" class="btn btn-sm btn-success"><?php echo e(trans('labels.track_order')); ?></a>
											  		<?php if($value['status'] != 2 && $value['status'] != 4 && $value['status'] != 5 && $value['status'] != 6 && $value['status'] != 7 && $value['status'] != 8 && $value['status'] != 9 && $value['status'] != 10): ?>
											  			<a href="javascript::void()" onclick="CancelOrder('<?php echo e($value->id); ?>')" class="btn btn-sm btn-theme"><?php echo e(trans('labels.cancel_order')); ?></a>
											  		<?php endif; ?>
												  	<?php if($value['status'] == 4): ?>
												  		<a href="javascript::void()" data-order-id="<?php echo e($value->id); ?>" data-status="7" class="btn btn-sm btn-theme reject"><?php echo e(trans('labels.return')); ?></a>
												  	<?php endif; ?>
											  	</div>
											  	<div class="clearfix"></div>
											</div>
										</div>
									</div>
									<li></li>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</ul>
							</div>
						</div>
						
						<!-- Total Items -->
						<div class="card style-2 mb-4">
							<div class="card-header">
								<h4 class="mb-0"><?php echo e(trans('labels.total_orders')); ?></h4>
							</div>
							<div class="card-body">
								<ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
									<li class="list-group-item d-flex">
										<span><?php echo e(trans('labels.subtotal')); ?></span>
										<span class="ml-auto"><?php echo e(Helper::CurrencyFormatter($order_infos['subtotal'])); ?></span>
									</li>
								
									<li class="list-group-item d-flex">
										<span><?php echo e(trans('labels.tax')); ?></span>
										<span class="ml-auto"><?php echo e(Helper::CurrencyFormatter($order_infos['tax'])); ?></span>
									</li>
									
									<li class="list-group-item d-flex">
										<span><?php echo e(trans('labels.shipping')); ?></span>
										<span class="ml-auto"><?php echo e(Helper::CurrencyFormatter($order_infos['shipping_cost'])); ?></span>
									</li>
									<?php if(@$order_infos['discount_amount'] != "" && @$order_infos['discount_amount'] != 0): ?>
									<li class="list-group-item d-flex">
										<span><?php echo e(trans('labels.discount')); ?></span>
										<span class="ml-auto"><?php echo e(Helper::CurrencyFormatter($order_infos['discount_amount'])); ?></span>
									</li>
									<?php endif; ?>
									<li class="list-group-item d-flex font-size-lg font-weight-bold">
										<span><?php echo e(trans('labels.ttl')); ?></span>
										<span class="ml-auto"><?php echo e(Helper::CurrencyFormatter($order_infos['grand_total'])); ?></span>
									</li>
								</ul>
							</div>
						</div>
						
						<!-- Shipping & Billing -->
						<div class="card style-2">
							<div class="card-header">
								<h4 class="mb-0"><?php echo e(trans('labels.billing_details')); ?></h4>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-12 col-md-6">

										<p class="mb-7 mb-md-0">
										  <?php echo e($order_infos['full_name']); ?>, <br>
										  <?php echo e($order_infos['email']); ?>, <br>
										  <?php echo e($order_infos['mobile']); ?>

										</p>

									</div>
								  
									<div class="col-12 col-md-6">
										<!-- Heading -->
										<p class="mb-2 font-weight-bold">
										  <?php echo e(trans('labels.shipping_address')); ?>

										</p>

										<p class="mb-7 mb-md-0">
										  <?php echo e($order_infos['street_address']); ?>, <br>
										  <?php if($order_infos['landmark'] != ""): ?>
										  	<?php echo e($order_infos['landmark']); ?>, <br>
										  <?php endif; ?>
										  <?php echo e($order_infos['pincode']); ?>

										</p>
									</div>
								</div>
							</div>
						</div>
					
				</div>
				<?php endif; ?>
				
			</div>
		</div>
	</section>

	<!-- Modal -->
	<div id="RejectReturn" class="modal fade" role="dialog">
	  	<div class="modal-dialog">

	    	<!-- Modal content-->
	    	<div class="modal-content">
	      		<div class="modal-header"><h4 class="modal-title text-left"><?php echo e(trans('labels.write_reason')); ?></h4></div>
      			<div class="modal-body">
					<form>
						<?php $__currentLoopData = $returnconditions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $conditions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<label>
								<input type="radio" data-conditions="<?php echo e($conditions['return_conditions']); ?>" name="conditions" class="" >
								<span for="<?php echo e($conditions['return_conditions']); ?>"><?php echo e($conditions['return_conditions']); ?></span>
							</label><hr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			          	<div class="form-group">
				            <input type="hidden" name="order_id" id="data-order-id">
				            <input type="hidden" name="status" id="data-status">
				            <label for="comment" class="col-form-label"><?php echo e(trans('labels.comment')); ?></label>
				            <textarea class="form-control" id="comment" rows="4" name="comment"></textarea>
			          	</div>
			        </form>
      			</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><?php echo e(trans('labels.close')); ?></button>
		        	<button type="button" class="btn btn-sm btn-primary" onclick="StatusUpdate()"><?php echo e(trans('labels.submit')); ?></button>
		      	</div>
		    </div>
	  	</div>
	</div>
	<!-- =========================== My All Orders =================================== -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripttop'); ?>
<script type="text/javascript">
	function CancelOrder(id) {
	    swal({
	        title: "Are you sure?",
	        text: "Are you sure want to cancel this order ?",
	        type: "warning",
	        showCancelButton: true,
	        confirmButtonClass: "btn-danger",
	        confirmButtonText: "Yes, cancel it!",
	        cancelButtonText: "No!",
	        closeOnConfirm: false,
	        closeOnCancel: false,
	        showLoaderOnConfirm: true,
	    },
	    function(isConfirm) {
	        if (isConfirm) {
	            $.ajax({
	                headers: {
	                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                },
	                url:"<?php echo e(URL::to('cancelorder')); ?>",
	                data: {
	                    id: id
	                },
	                method: 'POST',

	                success: function(response) {
	                    if (response.status == 1) {
	                        swal({
	                            title: "Approved!",
	                            text: "Order has been cancelled.",
	                            type: "success",
	                            showCancelButton: true,
	                            confirmButtonClass: "btn-danger",
	                            confirmButtonText: "Ok",
	                            closeOnConfirm: false,
	                            showLoaderOnConfirm: true,
	                        },
	                        function(isConfirm) {
	                            if (isConfirm) {
	                                swal.close();
	                                location.reload();
	                            }
	                        });
	                    } else {
	                        swal("Cancelled", "Something Went Wrong :(", "error");
	                    }
	                },
	                error: function(e) {
	                    swal("Cancelled", "Something Went Wrong :(", "error");
	                }
	            });
	        } else {
	            swal("Cancelled", "Your record is safe :)", "error");
	        }
	    });
	}

	function StatusUpdate() {

	    var id=$('#data-order-id').val();
	    var status=$('#data-status').val();
	    var return_reason =  $('input[name="conditions"]:checked').attr("data-conditions");
	    var comment=$('#comment').val();

	    $('#preloader').show();
	    $.ajax({
	        headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
	        url:"<?php echo e(URL::to('returnrequest')); ?>",
	        type: "POST",
	        data : {'id':id,'status':status,'return_reason':return_reason,'comment':comment},
	        success:function(response)
	        { 
	            $('#preloader').hide();
	            location.reload();
	        },error:function(response){
	            $('#preloader').hide();
	            console.log("AJAX error in request: " + JSON.stringify(response, null, 2));
	        }
	    });
	}

	$(document).ready(function(){
	   $(".reject").click(function(){ // Click to only happen on announce links

	     $("#data-order-id").val($(this).attr('data-order-id'));
	     $("#data-status").val($(this).attr('data-status'));
	     $('#RejectReturn').modal('show');
	   });
	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.web', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/eglobalm/public_html/resources/views/Front/order-details.blade.php ENDPATH**/ ?>