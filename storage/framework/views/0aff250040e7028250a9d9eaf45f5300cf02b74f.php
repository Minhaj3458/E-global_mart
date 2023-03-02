<!-- row -->
<?php 
$strings = array('#FDF7FF','#FDF3F0','#EDF7FD','#FFFAEA','#F1FFF6');
$counts = count($strings);
?>
<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keys => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="col-2xl-2 col-xl-3 col-lg-4 col-sm-6 mb-4">
	<div class="woo_product_grid no-hover">
		
		<a href="<?php echo e(URL::to('products/product-details/'.$product->slug)); ?>">
			<div class="woo_product_thumb">
				<?php
					$filename_from_url = parse_url($product['productimage']->image_url);
					$ext = pathinfo($filename_from_url['path'], PATHINFO_EXTENSION);
				?>
				<img src="<?php echo e($product['productimage']->image_url); ?>" class="img-fluid lazyload product-box-image <?php if($ext=='png'): ?> gray-bg <?php endif; ?>" title="<?php echo e($product['product_name']); ?>" />
				<div class='curtain' style="background-color: <?php echo $strings[$keys % $counts]; ?>">
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
<!-- row<?php /**PATH /home/eglobalm/public_html/resources/views/Front/filterproduct.blade.php ENDPATH**/ ?>