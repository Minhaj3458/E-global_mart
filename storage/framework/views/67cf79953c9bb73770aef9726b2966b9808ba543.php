<div class="w3-ch-sideBar w3-bar-block w3-card-2 w3-animate-right"  style="display:none;right:0;" id="rightMenu">
	<div class="rightMenu-scroll">
		<h4 class="cart_heading"><?php echo e(trans('labels.cart')); ?></h4>
		<button onclick="closeRightMenu()" class="w3-bar-item w3-button w3-large"><i class="ti-close"></i></button>
		
			<div class="right-ch-sideBar" id="side-scroll">	
				<?php if(count(Helper::getcart(@Auth::user()->id)) == 0): ?>
					<div class="col-lg-12 col-md-12 text-center">
						<img src="<?php echo e(Helper::image_path('no-data.png')); ?>">
						<?php if(@Auth::user()): ?>
							<h2 class="error_title mt-4"><?php echo e(trans('labels.empty_cart')); ?></h2>
							<p><span class="text-primary"><?php echo e(trans('labels.woops')); ?></span>  <?php echo e(trans('labels.empty_cart_text')); ?></p>
							<a href="<?php echo e(URL::to('/')); ?>" class="btn btn-primary"><?php echo e(trans('labels.shop_now')); ?></a>
						<?php else: ?>
							<h2 class="error_title mt-4"><?php echo e(trans('labels.please_login')); ?></h2>
							<p><?php echo e(trans('labels.please_login_text')); ?></p>
							<a href="<?php echo e(URL::to('/signin')); ?>" class="btn btn-primary"><?php echo e(trans('labels.login')); ?></a>
						<?php endif; ?>
					</div>

				<?php else: ?> 	
					<div class="cart_select_items">
						<!-- Single Item -->
						<?php $__currentLoopData = Helper::getcart(@Auth::user()->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cartitems): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="product cart_selected_single">
							<div class="cart_selected_single_thumb">
								<a href="#"><img src="<?php echo e($cartitems->image_url); ?>" class="img-fluid" alt="" /></a>
							</div>
							<div class="cart_selected_single_caption">
								<h4 class="product_title"><?php echo e($cartitems->product_name); ?></h4>
								<?php if($cartitems->attribute != ""): ?>
									<span class="numberof_item mt-2"><?php echo e($cartitems->attribute); ?> : <?php echo e($cartitems->variation); ?></span>
								<?php endif; ?>
								<span class="numberof_item mt-2"><?php echo e(Helper::CurrencyFormatter($cartitems->price)); ?> x <?php echo e($cartitems->qty); ?></span>
								<span class="numberof_item mt-2 text-right"><b></b></span>
								<div class="cart_price">
									<h6><a href="javascript::void()" onclick="DeleteItem('<?php echo e($cartitems->id); ?>','1')" class="text-danger"><i class="fa fa-trash" aria-hidden="true"></i></a><span><?php echo e(Helper::CurrencyFormatter($cartitems->qty * $cartitems->price)); ?></span></h6>
								</div>
							</div>
						</div>

						<?php
						$data[] = array(
						    "sub_total" => $cartitems->qty * $cartitems->price
						);
						$sub_total = array_sum(array_column(@$data, 'sub_total'));
						?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

					</div>
					
					<div class="cart_subtotal">
						<h6>Subtotal<span class="theme-cl"><?php echo e(Helper::CurrencyFormatter($sub_total)); ?></span></h6>
					</div>
					
					<div class="cart_action">
						<ul>
							<li><a href="<?php echo e(URL::to('/cart')); ?>" class="btn btn-go-cart btn-theme"><?php echo e(trans('labels.view_cart')); ?></a></li>
						</ul>
					</div>
				<?php endif; ?>
				
			</div>
		</div>
</div><?php /**PATH /home/eglobalm/public_html/resources/views/includes/web/cart.blade.php ENDPATH**/ ?>