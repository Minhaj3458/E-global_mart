<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.home')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php 
$strings = array('#FDF7FF','#FDF3F0','#EDF7FD','#FFFAEA','#F1FFF6');
$count = count($strings);
?>
		
	<!-- ======================== Slider Start ==================== -->
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<li data-target="#carouselExampleIndicators" data-slide-to="<?php echo e($key1); ?>" class="<?php if($key1 == 0) { echo "active"; } ?>"></li>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</ol>
		<div class="carousel-inner">
			<?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="carousel-item <?php if($key2 == 0) { echo "active"; } ?>">
				<a href="<?php echo e($slider->link); ?>">
					<img class="d-block w-100" src="<?php echo e(Helper::image_path($slider->image)); ?>">
				</a>
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
	<!-- ======================== Slider End ==================== -->

	<!-- ======================== Top banner ==================== -->
	<section>
		<div class="container-fluid">
			<div class="row justify-content-center">

				<?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php if($value['positions'] == "top"): ?>
					<div class="col-lg-4 col-md-4 col-sm-12">
						<div class="card card_big">
							<div class="card-bg">
								<?php if($value['type'] == "product"): ?>
									<a href="<?php echo e(Helper::getSlug($value['type'],$value['product_id'])); ?>">
								<?php else: ?>
									<a href="<?php echo e(Helper::getSlug($value['type'],$value['cat_id'])); ?>">
								<?php endif; ?>
									<div class="card-bg-img bg-cover" style="background:#fde9ed url('<?php echo e(Helper::image_path($value['image'])); ?>');"></div>
								</a>
							</div>
						</div>
					</div>
					<?php endif; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				
			</div>
		</div>
	</section>
	<div class="clearfix"></div>
	<!-- ======================== Top banner End ==================== -->
	
	<!-- ======================== Best Sellers Start ==================== -->
	<section class="gray">
		<div class="container-fluid">
			
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="sec-heading-flex pl-2 pr-2">
						<div class="sec-heading-flex-one">
							<h1><?php echo e(trans('labels.featured_products')); ?></h1>
						</div>
						<div class="sec-heading-flex-last">
							<a href="<?php echo e(URL::to('/featured-products')); ?>" class="btn btn-theme"><?php echo e(trans('labels.view_more')); ?><i class="ti-arrow-right ml-2"></i></a>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<?php $__currentLoopData = $featured_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key3 => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="col-2xl-2 col-xl-3 col-lg-4 col-sm-6 mb-4">
					<div class="woo_product_grid no-hover">
						
						<a href="<?php echo e(URL::to('products/product-details/'.$product->slug)); ?>">
							<div class="woo_product_thumb">
								<?php
									$filename_from_url = parse_url($product['productimage']->image_url);
									$ext = pathinfo($filename_from_url['path'], PATHINFO_EXTENSION);
								?>
								<img src="<?php echo e($product['productimage']->image_url); ?>" class="img-fluid lazyload product-box-image <?php if($ext=='png'): ?> gray-bg <?php endif; ?>" title="<?php echo e($product->product_name); ?>" />
								<div class='curtain' style="background-color: <?php echo $strings[$key3 % $count]; ?>">
							    	<div class='shine'></div>
							  	</div>
							</div>
						
							<div class="woo_product_caption">
								<div class="woo_title mt-2">
									<h4 class="entry-title"><?php echo e(Str::limit($product->product_name, 32)); ?></h4>
									<h6><i class="fa fa-star filled"></i> <?php echo e(number_format($product->ratings_average,1)); ?></h6>
								</div>

								<div class="woo_price mt-2">
									<h6><?php echo e(Helper::CurrencyFormatter($product->product_price)); ?><span class="less_price"><?php echo e(Helper::CurrencyFormatter($product->discounted_price)); ?></span></h6>
								</div>

								<?php if($product->product_price): ?>
									<span class="post-article-cat theme-bg mt-2"><?php echo e(trans('labels.save')); ?> <?php echo e(Helper::CurrencyFormatter($product->discounted_price - $product->product_price)); ?></span>
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
		</div>
	</section>
	<div class="clearfix"></div>
	<!-- ======================== Best Sellers End ==================== -->

	<!-- ======================= Hot Deal Start ============================== -->
	<section class="">
		<div class="container-fluid">
			<div class="row align-item-center">
				
				<div class="col-lg-6 col-md-6">
					<div class="d-flex flex-column overflow-hidden rounded-lg pad-bt">
						<?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key4 => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php if($value['positions'] == "left"): ?>
							<?php if($value['type'] == "product"): ?>
								<a href="<?php echo e(Helper::getSlug($value['type'],$value['product_id'])); ?>">
							<?php else: ?>
								<a href="<?php echo e(Helper::getSlug($value['type'],$value['cat_id'])); ?>">
							<?php endif; ?>
								<img src="<?php echo e(Helper::image_path($value['image'])); ?>" class="img-fluid" />
							</a>
						<?php endif; ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				</div>
				
				<div class="col-lg-6 col-md-6">
					<?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key5 => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php if($value['positions'] == "bottom"): ?>
						<div class="offer-deals mb-4">
							<?php if($value['type'] == "product"): ?>
								<a href="<?php echo e(Helper::getSlug($value['type'],$value['product_id'])); ?>">
							<?php else: ?>
								<a href="<?php echo e(Helper::getSlug($value['type'],$value['cat_id'])); ?>">
							<?php endif; ?>
								<img src="<?php echo e(Helper::image_path($value['image'])); ?>" class="img-fluid" />
							</a>
						</div>
					<?php endif; ?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
				
			</div>
		</div>
	</section>

	<section class="">
		<div class="container-fluid">
			
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="sec-heading-flex pl-2 pr-2">
						<div class="sec-heading-flex-one">
							<h1><?php echo e(trans('labels.hot_products')); ?></h1>
						</div>
						<div class="sec-heading-flex-last">
							<a href="<?php echo e(URL::to('/hot-products')); ?>" class="btn btn-theme"><?php echo e(trans('labels.view_more')); ?><i class="ti-arrow-right ml-2"></i></a>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<?php $__currentLoopData = $hot_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key6 => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<!-- Single Item -->
				<div class="col-2xl-2 col-xl-3 col-lg-4 col-sm-6 mb-4">
					<div class="woo_product_grid no-hover">
						
						<a href="<?php echo e(URL::to('products/product-details/'.$product->slug)); ?>">
							<div class="woo_product_thumb">
								<?php
									$filename_from_url = parse_url($product['productimage']->image_url);
									$ext = pathinfo($filename_from_url['path'], PATHINFO_EXTENSION);
								?>
								<img src="<?php echo e($product['productimage']->image_url); ?>" class="img-fluid lazyload product-box-image <?php if($ext=='png'): ?> gray-bg <?php endif; ?>" title="<?php echo e($product->product_name); ?>" />
								<div class='curtain' style="background-color: <?php echo $strings[$key6 % $count]; ?>">
							    	<div class='shine'></div>
							  	</div>
							</div>
						
							<div class="woo_product_caption">
								<div class="woo_title mt-2">
									<h4 class="entry-title"><?php echo e(Str::limit($product->product_name, 32)); ?></h4>
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
		</div>
	</section>
	<!-- ======================= Hot Deals End =============================== -->
	
	<!-- ======================== Women Accessiries Start ==================== -->
	<section class="gray">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="sec-heading-flex pl-2 pr-2">
						<div class="sec-heading-flex-one">
							<h1><?php echo e(trans('labels.new_arrivals')); ?></h1>
						</div>
						<div class="sec-heading-flex-last">
							<a href="<?php echo e(URL::to('/new-products')); ?>" class="btn btn-theme"><?php echo e(trans('labels.view_more')); ?><i class="ti-arrow-right ml-2"></i></a>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<?php $__currentLoopData = $new_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key8 => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<!-- Single Item -->
				<div class="col-2xl-2 col-xl-3 col-lg-4 col-sm-6 mb-4">
					<div class="woo_product_grid no-hover">
						
						<a href="<?php echo e(URL::to('products/product-details/'.$product->slug)); ?>">
							<div class="woo_product_thumb">
								<?php
									$filename_from_url = parse_url($product['productimage']->image_url);
									$ext = pathinfo($filename_from_url['path'], PATHINFO_EXTENSION);
								?>
								<img src="<?php echo e($product['productimage']->image_url); ?>" class="img-fluid lazyload product-box-image <?php if($ext=='png'): ?> gray-bg <?php endif; ?>" title="<?php echo e($product->product_name); ?>" />
								<div class='curtain' style="background-color: <?php echo $strings[$key8 % $count]; ?>">
							    	<div class='shine'></div>
							  	</div>
							</div>
						
							<div class="woo_product_caption">
								<div class="woo_title mt-2">
									<h4 class="entry-title"><?php echo e(Str::limit($product->product_name, 32)); ?></h4>
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
		</div>
	</section>
	<div class="clearfix"></div>
	<!-- ======================== Women Accessiries End ==================== -->

	<!-- ======================== Tag & Explore End ==================== -->
	<?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<?php if($value['positions'] == "large"): ?>
		<?php if($value['type'] == "product"): ?>
			<a href="<?php echo e(Helper::getSlug($value['type'],$value['product_id'])); ?>">
		<?php else: ?>
			<a href="<?php echo e(Helper::getSlug($value['type'],$value['cat_id'])); ?>">
		<?php endif; ?>
			<section class="image-bg" style="background:url('<?php echo e(Helper::image_path($value['image'])); ?>') no-repeat;">
				<div class="ht-300"></div>

				<div class="ht-300"></div>
			</section>
		</a>
		<?php break; ?>
	<?php endif; ?>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<!-- ======================== Tag & Explore End ==================== -->

	<!-- ======================== Brand Start ==================== -->
	<section class="pt-5 pb-5">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="sec-heading-flex pl-2 pr-2">
						<div class="sec-heading-flex-one">
							<h1><?php echo e(trans('labels.top_brands')); ?></h1>
						</div>
						<div class="sec-heading-flex-last">
							<a href="<?php echo e(URL::to('/all-brand')); ?>" class="btn btn-theme"><?php echo e(trans('labels.view_more')); ?><i class="ti-arrow-right ml-2"></i></a>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="owl-carousel category-slider owl-theme">
						<!-- Single Item -->
						<?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key9 => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="item">
							<div class="woo_category_box border_style circle">
								<div class="woo_cat_thumb">
									<a href="<?php echo e(URL::to('brands/'.$value->id)); ?>"><img src="<?php echo e(Helper::image_path($value['icon'])); ?>" class="img-fluid" /></a>
								</div>
							</div>
						</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					
					</div>
				</div>
			</div>
			
		</div>
	</section>
	<div class="clearfix"></div>
	<!-- ======================== Brand End ==================== -->

	<!-- ======================== Vendors start ==================== -->
	<section class="gray">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="sec-heading-flex pl-2 pr-2">
						<div class="sec-heading-flex-one">
							<h1><?php echo e(trans('labels.vendors')); ?></h1>
						</div>
						<div class="sec-heading-flex-last">
							<a href="<?php echo e(URL::to('/all-vendors')); ?>" class="btn btn-theme"><?php echo e(trans('labels.view_more')); ?><i class="ti-arrow-right ml-2"></i></a>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="owl-carousel products-slider owl-theme">
						
						<?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key10 => $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<!-- Single Item -->
						<div class="item">
							<div class="woo_product_grid no-hover">
								<div class="woo_product_thumb">
									<img src="<?php echo e(Helper::image_path($list->profile_pic)); ?>" class="img-fluid lazyload vendor-box-image"/>
									<div class='curtain' style="background-color: <?php echo $strings[$key10 % $count]; ?>">
								    	<div class='shine'></div>
								  	</div>
								</div>
								<div class="woo_product_caption center">
									<div class="woo_title mt-3">
										<h4 class="woo_pro_title"><a href="<?php echo e(URL::to('vendor-details/'.$list->id)); ?>"><?php echo e($list->name); ?></a></h4>
									</div>
								</div>
							</div>
						</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					
					</div>
				</div>
			</div>
			
		</div>
	</section>
	<div class="clearfix"></div>
	<!-- ======================== vendors End ==================== -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.web', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Front/home.blade.php ENDPATH**/ ?>