<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.vendors')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<!-- =========================== Vendor Wrap =================================== -->
	<div class="vendor_wrap dark">
		<div class="container">
			<div class="row align-items-center">
				
				<div class="col-lg-9 col-md-7 col-sm-12">
					<div class="vendor_head_profl">
						<div class="vendor_profl_thumb">
							<img src="<?php echo e(Helper::image_path($vendors->profile_pic)); ?>" class="img-fluid rounded" alt="" />
						</div>
						<div class="vendor_profl_caption mt-3">
							<h4><?php echo e($vendors->name); ?></h4>
							<p class="text-white"><i class="ti-home"></i> <?php echo e($vendors->store_address); ?></p>
							<p class="text-white"><i class="ti-mobile"></i> <?php echo e($vendors->mobile); ?></p>
							<p class="text-white"><i class="ti-email"></i> <?php echo e($vendors->email); ?></p>
						</div>
					</div>
				</div>
				
				<div class="col-lg-3 col-md-5 col-sm-12 ml-auto">
					<div class="vendor_sales_rate_info">
						
						<div class="vendor_rates_info">
							<label><?php echo e(trans('labels.rattings')); ?></label>
							<div class="vendor_ratting_wrap">
								<div class="vendor_ratting">
									<?php if(@$vendors['rattings'][0]->avg_ratting != ""): ?>
										<?php if(@$vendors['rattings'][0]->avg_ratting < 2): ?>
											<i class="fa fa-star filled"></i>
											<i class="fa fa-star "></i>
											<i class="fa fa-star "></i>
											<i class="fa fa-star "></i>
											<i class="fa fa-star "></i>
										<?php elseif(@$vendors['rattings'][0]->avg_ratting < 3): ?>
											<i class="fa fa-star filled"></i>
											<i class="fa fa-star filled"></i>
											<i class="fa fa-star "></i>
											<i class="fa fa-star "></i>
											<i class="fa fa-star "></i>
										<?php elseif(@$vendors['rattings'][0]->avg_ratting < 4): ?>
											<i class="fa fa-star filled"></i>
											<i class="fa fa-star filled"></i>
											<i class="fa fa-star filled"></i>
											<i class="fa fa-star "></i>
											<i class="fa fa-star "></i>
										<?php elseif(@$vendors['rattings'][0]->avg_ratting < 5): ?>
											<i class="fa fa-star filled"></i>
											<i class="fa fa-star filled"></i>
											<i class="fa fa-star filled"></i>
											<i class="fa fa-star filled"></i>
											<i class="fa fa-star "></i>
										<?php elseif(@$vendors['rattings'][0]->avg_ratting < 6): ?>
											<i class="fa fa-star filled"></i>
											<i class="fa fa-star filled"></i>
											<i class="fa fa-star filled"></i>
											<i class="fa fa-star filled"></i>
											<i class="fa fa-star filled"></i>
										<?php endif; ?>
										<span><?php echo e(@$vendors['rattings'][0]->avg_ratting); ?></span>
									<?php endif; ?>
								</div>
							</div>
						</div>
						
					</div>
				</div>
				
			</div>
		</div>
	</div>
	<!-- =========================== Vendor Wrap =================================== -->
	<?php if(count($getbanners) > 0): ?>
	<section class="offer-banner-wrap pb-5 pt-5">
		<div class="container">
			<div class="row align-items-center">
			
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div id="carouselExampleIndicators" class="carousel slide elec-slide" data-ride="carousel">
						<div class="carousel-inner">
							<?php $__currentLoopData = $getbanners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="carousel-item <?php if($key == 0) { echo "active"; } ?>">
								<img class="d-block w-100 rounded" src="<?php echo e($banner->image); ?>" alt="First slide">
							</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
						<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only"><?php echo e(trans('labels.Previous')); ?></span>
						</a>
						<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only"><?php echo e(trans('labels.Next')); ?></span>
						</a>
					</div>
				</div>
				
			</div>
		</div>
	</section>
	<div class="clearfix"></div>
	<?php endif; ?>

	<!-- =========================== News & Articles =================================== -->
	<section class="gray">
		<div class="container-fluid">
			<div class="row">
	
				<div class="col-lg-12 col-md-12 col-sm-12">
					
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<h4><?php echo e(trans('labels.all_products')); ?></h4>
						</div>
					</div>
					
					<!-- row -->
					<div class="row">
						<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="col-2xl-2 col-xl-3 col-lg-4 col-sm-6 mb-4">
							<div class="woo_product_grid no-hover">

								<?php 
								$strings = array('#FDF7FF','#FDF3F0','#EDF7FD','#FFFAEA','#F1FFF6');
								$count = count($strings);
								?>
								<a href="<?php echo e(URL::to('products/product-details/'.$product->slug)); ?>">
									<div class="woo_product_thumb">
										<?php
											$filename_from_url = parse_url($product['productimage']->image_url);
											$ext = pathinfo($filename_from_url['path'], PATHINFO_EXTENSION);
										?>
										<img src="<?php echo e($product['productimage']->image_url); ?>" class="img-fluid lazyload product-box-image <?php if($ext=='png'): ?> gray-bg <?php endif; ?>" title="<?php echo e($product['product_name']); ?>"/>
										<div class='curtain' style="background-color: <?php echo $strings[$key % $count]; ?>">
									    	<div class='shine'></div>
									  	</div>
									</div>
								
									<div class="woo_product_caption">
										<div class="woo_title mt-2">
											<h4 class="entry-title"><?php echo e(Str::limit($product->product_name, 53)); ?></h4>
											<h6><i class="fa fa-star filled"></i> <?php echo e(number_format($product->ratings_average,1)); ?></h6>
										</div>

										<div class="woo_price mt-2">
											<h6><?php echo e(Helper::CurrencyFormatter($product->product_price)); ?><span class="less_price"><?php echo e(Helper::CurrencyFormatter($product->discounted_price)); ?></span></h6>
										</div>

										<?php if($product->product_price): ?>
											<span class="post-article-cat theme-bg mt-2">Save <?php echo e(Helper::CurrencyFormatter($product->discounted_price - $product->product_price)); ?></span>
										<?php endif; ?>
									</div>
								</a>
								<div class="woo_product_cart hover">
									<ul>
										<?php if($product->is_wishlist == 1): ?>
											<li><a href="javascript:void();" onclick="RemoveWishList('<?php echo e($product->id); ?>','<?php echo e($product->product_name); ?>','<?php echo e(@Auth::user()->id); ?>')" class="woo_cart_btn btn_save"><?php echo e(trans('labels.wishlist')); ?> <i class="fas fa-heart i ml-2"></i></a></li>
										<?php else: ?>
										    <li><a href="javascript:void();" onclick="WishList('<?php echo e($product->id); ?>','<?php echo e($product->product_name); ?>','<?php echo e(@Auth::user()->id); ?>')" class="woo_cart_btn btn_save"><?php echo e(trans('labels.wishlist')); ?> <i class="ti-heart ml-2"></i></a></li>
										<?php endif; ?>
									</ul>
								</div>								
							</div>
						</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
					<!-- row -->

					<div class="d-flex justify-content-center">
						<?php echo e($products->links()); ?>

					</div>

				</div>
			</div>
		</div>
	</section>
	<!-- =========================== News & Articles =================================== -->
	

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripttop'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.web', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/eglobalm/public_html/resources/views/Front/vendor-details.blade.php ENDPATH**/ ?>