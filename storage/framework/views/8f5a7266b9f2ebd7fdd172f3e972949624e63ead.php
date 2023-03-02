<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.cart')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<!-- =========================== Breadcrumbs =================================== -->
	<div class="brd_wraps pt-2 pb-2">
		<div class="container">
			<nav aria-label="breadcrumb" class="simple_breadcrumbs">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#"><i class="ti-home"></i></a></li>
				<li class="breadcrumb-item active" aria-current="page"><?php echo e(trans('labels.cart')); ?></li>
			  </ol>
			</nav>
		</div>
	</div>
	<!-- =========================== Breadcrumbs =================================== -->

	<!-- =========================== Cart =================================== -->
	<section>
		<div class="container">
			<?php if(count($cart) <= 0): ?>
			    <div class="col-lg-12 col-md-12 text-center">
			    	<img src="<?php echo e(Helper::image_path('no-data.png')); ?>">
			    	<?php if(Auth::user()): ?>
			    		<h2 class="error_title mt-4"><?php echo e(trans('labels.empty_cart')); ?></h2>
			    		<p><span class="text-primary"><?php echo e(trans('labels.woops')); ?></span> <?php echo e(trans('labels.empty_cart_text')); ?></p>
			    		<a href="<?php echo e(URL::to('/')); ?>" class="btn btn-primary"><?php echo e(trans('labels.shop_now')); ?></a>
			    	<?php else: ?>
			    		<h2 class="error_title mt-4"><?php echo e(trans('labels.please_login')); ?></h2>
			    		<p><?php echo e(trans('labels.please_login_text')); ?></p>
			    		<a href="<?php echo e(URL::to('/signin')); ?>" class="btn btn-primary"><?php echo e(trans('labels.login')); ?></a>
			    	<?php endif; ?>
			    </div>
			<?php else: ?> 

				<?php if(Storage::disk('local')->has("promo")): ?>
					<?php
						$promo = json_decode(Storage::disk('local')->get("promo"), true);
					?>
				<?php endif; ?>

				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th scope="col" class="text-center"><?php echo e(trans('labels.product')); ?></th>
										<th scope="col" class="text-center"><?php echo e(trans('labels.qty')); ?></th>
										<th scope="col" class="text-center"><?php echo e(trans('labels.item_total')); ?></th>
										<th scope="col" class="text-center"><?php echo e(trans('labels.tax')); ?></th>
										<th scope="col" class="text-center"><?php echo e(trans('labels.shipping')); ?></th>
										<th scope="col" class="text-center"><?php echo e(trans('labels.ttl')); ?></th>
										<th scope="col" class="text-center"><?php echo e(trans('labels.action')); ?></th>
									</tr>
								</thead>
								<tbody>
									<?php $final_sub_total = 0; $final_grand_total=0; ?>
									<?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cartitems): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td>
											<div class="tbl_cart_product">
												<div class="tbl_cart_product_thumb">
													<img src="<?php echo e($cartitems->image_url); ?>" class="img-fluid" alt="" />
												</div>
												<div class="tbl_cart_product_caption">
													<h5 class="tbl_pr_title"><a href="<?php echo e(URL::to('products/product-details/'.$cartitems->slug)); ?>"> <?php echo e($cartitems->product_name); ?> </a></h5>
													<?php if($cartitems->attribute != ""): ?>
													<span class="tbl_pr_quality theme-cl"><?php echo e($cartitems->attribute); ?> : <?php echo e($cartitems->variation); ?></span>
													<?php endif; ?>
													<br>
													<span class="tbl_pr_quality theme-cl">
														Price : <?php echo e(Helper::CurrencyFormatter($cartitems->price)); ?>

													</span>
												</div>
											</div>
										</td>
										<td>
											<div class="pro-add">
												<div class="value-button sub" id="decrease" onclick="qtyupdate('<?php echo e($cartitems->id); ?>','decreaseValue')" value="Decrease Value">
			                                        <i class="fa fa-minus-circle"></i>
			                                    </div>
												<input type="number" id="number_<?php echo e($cartitems->id); ?>" name="number" value="<?php echo e($cartitems->qty); ?>" readonly="" min="1" max="10" />
												<div class="value-button add" id="increase" onclick="qtyupdate('<?php echo e($cartitems->id); ?>','increase')" value="Increase Value">
												    <i class="fa fa-plus-circle"></i>
												</div>
											</div>
										</td>
										<td>
											<h4 class="tbl_org_price">
												<?php $ttl = $cartitems->price*$cartitems->qty; $final_sub_total += $ttl; ?>
												<?php echo e(Helper::CurrencyFormatter($cartitems->price*$cartitems->qty)); ?>

											</h4>
										</td>
										<td>
											<h4 class="tbl_org_price">
												<?php 
										    		$tax = ($cartitems->tax*$cartitems->qty);
										    	?>
												<?php echo e(Helper::CurrencyFormatter($tax)); ?>

											</h4>
										</td>
										<td>
											<h4 class="tbl_org_price">
												<?php 
										    		$shipping_cost = ($cartitems->shipping_cost);
										    	?>
												<?php echo e(Helper::CurrencyFormatter($shipping_cost)); ?>

											</h4>
										</td>
										<td>
											<h4 class="tbl_org_price">
												<?php $sub_total = $ttl+$tax+$shipping_cost;?>
												<?php echo e(Helper::CurrencyFormatter($ttl+$tax+$shipping_cost)); ?>

											</h4>
										</td>
										<td>
											<div class="tbl_pr_action">
												<a href="#" class="tbl_remove" onclick="DeleteItem('<?php echo e($cartitems->id); ?>','1')"><i class="fa fa-trash"></i></a>
											</div>
										</td>
									</tr>

									<?php

									$data[] = array(
									    "sub_total" => $ttl,
									    "tax" => $tax,
									    "shipping_cost" => $shipping_cost,
									    "grand_total" => $sub_total,
									);
									$sub_total = array_sum(array_column(@$data, 'sub_total'));
									$tax = array_sum(array_column(@$data, 'tax'));
									$shipping_cost = array_sum(array_column(@$data, 'shipping_cost'));
									$grand_total = array_sum(array_column(@$data, 'grand_total'));
									?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									
								</tbody>
							</table>
							<input type="hidden" name="final_sub_total" id="final_sub_total" value="<?php echo e($sub_total); ?>">

							<?php if(Storage::disk('local')->has("promo")): ?>
								<?php if(@$promo['type'] == "1"): ?>
									<?php if($sub_total > @$promo['min_amount']): ?>
										<?php $dis_amount = @$promo['amount']; ?>
									<?php else: ?>
										<?php $dis_amount = "0"; ?>
									<?php endif; ?>
								<?php endif; ?>

								<?php if(@$promo['type'] == "0"): ?>
									<?php if($sub_total > @$promo['min_amount']): ?>
										<?php $dis_amount = $sub_total*@$promo['percentage']/100; ?>
									<?php else: ?>
										<?php $dis_amount = "0"; ?>
									<?php endif; ?>
								<?php endif; ?>
							<?php else: ?>
								<?php $dis_amount = "0"; ?>
							<?php endif; ?>
							<?php Storage::disk('local')->put("dis_amount", $dis_amount); ?>

							<div class="col-md-4 col-12 float-right">
								<ul class="list-group list-group-flush">
			                        <li class="list-group-item"><?php echo e(trans('labels.sub_total')); ?> <span class="float-right"><?php echo e(Helper::CurrencyFormatter($sub_total)); ?></span></li>
									<li class="list-group-item"><?php echo e(trans('labels.tax')); ?> <span class="float-right"><?php echo e(Helper::CurrencyFormatter($tax)); ?></span></li>
									<li class="list-group-item"><?php echo e(trans('labels.shipping')); ?> <span class="float-right"><?php echo e(Helper::CurrencyFormatter($shipping_cost)); ?></span></li>
			                        <li class="list-group-item"><?php echo e(trans('labels.discount')); ?> <span class="float-right">- <?php echo e(Helper::CurrencyFormatter($dis_amount)); ?></span></li>

									<?php if(Storage::disk('local')->has("promo")): ?>
			                        	<li class="list-group-item"><strong><?php echo e(trans('labels.grand_total')); ?> <span class="float-right"><?php echo e(Helper::CurrencyFormatter($grand_total-$dis_amount)); ?></span></strong></li>
									<?php else: ?>
										<li class="list-group-item"><strong><?php echo e(trans('labels.grand_total')); ?> <span class="float-right"><?php echo e(Helper::CurrencyFormatter($grand_total)); ?></span></strong></li>
									<?php endif; ?>
									<?php Storage::disk('local')->put("grand_total", $grand_total); ?>
			                    </ul>
			                </div>
						</div>
						

						<!-- Coupon Box -->
						<div class="row align-items-end justify-content-between mb-10 mb-md-0">
							<div class="col-12 col-md-6">

								<!-- Coupon -->
								<form class="mb-7 mb-md-0">
									<div class="col">
										<label class="font-size-sm font-weight-bold"><?php echo e(trans('labels.coupon_code')); ?></label>
									</div>
									<div class="row form-row">
										<div class="col">
											<input class="form-control form-control-sm" type="text" <?php if(@$promo['coupon_name'] != ""): ?> value="<?php echo e(@$promo['coupon_name']); ?>" readonly="" <?php endif; ?> name="coupon_name" id="coupon_name" placeholder="<?php echo e(trans('labels.coupon_code')); ?>">
										</div>
										<div class="col-auto">
											<!-- Button -->
											<?php if(@$promo['coupon_name'] == ""): ?>
												<button class="btn btn-dark" type="button" onclick="applypromo()"><?php echo e(trans('labels.apply')); ?></button>
											<?php else: ?>
												<button class="btn btn-dark" type="button" onclick="removepromo()"><?php echo e(trans('labels.remove')); ?></button>
											<?php endif; ?>
										</div>
									</div>
								</form>

							</div>

							<div class="col-12 col-md-12 col-lg-4">
								<a class="btn btn-dark col-lg-12" href="<?php echo e(URL::to('checkout')); ?>"><?php echo e(trans('labels.proceed_checkout')); ?></a>
							</div>
							
						</div>
						<!-- Coupon Box -->
						
					</div>
					
				</div>
			<?php endif; ?>
		</div>
	</section>
	<!-- =========================== Cart =================================== -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripttop'); ?>
<script type="text/javascript">
	function applypromo() {
		var coupon_name=$("#coupon_name").val();
		var final_sub_total=$("#final_sub_total").val();
		$.ajax({
		    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		    url:"<?php echo e(URL::to('cart/applypromocode')); ?>",
		    data: {coupon_name : coupon_name,final_sub_total:final_sub_total}, 
		    method: 'POST',
		    success: function(response) {
		        if (response.status == 1) {
		        	localStorage.setItem("message",response.message)
		            location.reload();
		        } else {
		            toast.error(response.message);
		        }
		    },
		    error: function(error) {
		    	toast.error("Something went wrong");
		    }
		});
	}

	function removepromo() {
		var coupon_name=$("#coupon_name").val();
		$.ajax({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
		    url:"<?php echo e(URL::to('cart/removepromocode')); ?>",
		    data: {
		        coupon_name : coupon_name,
		    }, 
		    method: 'POST',
		    success: function(response) {
		        if (response.status == 1) {
		        	localStorage.setItem("message",response.message)
		            location.reload();
		        } else {
		            toast.error(response.message);
		        }
		    },
		    error: function(error) {
		    	toast.error("Something went wrong");
		    }
		});
	}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.web', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/eglobalm/public_html/resources/views/Front/cart.blade.php ENDPATH**/ ?>