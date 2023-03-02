<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.product_details')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<!-- =========================== Breadcrumbs =================================== -->
	<div class="brd_wraps pt-2 pb-2">
		<div class="container">
			<nav aria-label="breadcrumb" class="simple_breadcrumbs">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#"><i class="ti-home"></i></a></li>
				<li class="breadcrumb-item active" aria-current="page"><?php echo e($product->product_name); ?></li>
			  </ol>
			</nav>
		</div>
	</div>
	<!-- =========================== Breadcrumbs =================================== -->

	<!-- =========================== Product Detail =================================== -->
	<section>
		<div class="container">
			<div class="row">
			
				<div class="col-lg-6 col-md-12 col-sm-12">
					<div class="sp-wrap">
						<?php $__currentLoopData = $product['productimages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $images): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<a href="<?php echo e($images->image_url); ?>"><img src="<?php echo e($images->image_url); ?>" alt=""></a>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				</div>
				
				<div class="col-lg-6 col-md-12 col-sm-12">
					<div class="woo_pr_detail">
						
						<div class="woo_cats_wrps">
							<a href="#" class="woo_pr_cats"><?php echo e($product->category_name); ?> | <?php echo e($product->subcategory_name); ?> | <?php echo e($product->innersubcategory_name); ?></a>
						</div>
						<h2 class="woo_pr_title"><?php echo e($product->product_name); ?></h2>
						
						<div class="woo_pr_reviews">
							<div class="woo_pr_rating">
								<?php if(@$product['rattings'][0]->avg_ratting != ""): ?>
									<?php if(@$product['rattings'][0]->avg_ratting < 2): ?>
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star "></i>
										<i class="fa fa-star "></i>
										<i class="fa fa-star "></i>
										<i class="fa fa-star "></i>
									<?php elseif(@$product['rattings'][0]->avg_ratting < 3): ?>
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star "></i>
										<i class="fa fa-star "></i>
										<i class="fa fa-star "></i>
									<?php elseif(@$product['rattings'][0]->avg_ratting < 4): ?>
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star "></i>
										<i class="fa fa-star "></i>
									<?php elseif(@$product['rattings'][0]->avg_ratting < 5): ?>
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star "></i>
									<?php elseif(@$product['rattings'][0]->avg_ratting < 6): ?>
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star filled"></i>
									<?php endif; ?>
								<span class="woo_ave_rat"><?php echo e(@$product['rattings'][0]->avg_ratting); ?></span>
								<?php endif; ?>
							</div>
							<div class="woo_pr_total_reviews">
								<a href="#">(<?php echo e(count(@$all_review)); ?> <?php echo e(trans('labels.reviews')); ?>)</a>
							</div>
						</div>
						
						<div class="woo_pr_price">
							<div class="woo_pr_offer_price">
								<h3>
									<span class="price"><?php echo e(Helper::CurrencyFormatter($product->product_price)); ?></span>
									<span class="org_price"><?php if($product->discounted_price == 0): ?> <?php else: ?> <?php echo e(Helper::CurrencyFormatter($product->discounted_price)); ?> <?php endif; ?></span>
								</h3>
							</div>
						</div>

						<!-- First -->
						<div class="cart_sku_preflix">
							<?php if($product->tax == 0): ?>
								<span class="text-success"><?php echo e(trans('labels.all_tax')); ?></span>
							<?php else: ?>
								<?php if($product->tax_type == 'percent'): ?>
									<span class="text-danger"><span id="additional_tax"><?php echo e(Helper::CurrencyFormatter($product->product_price*$product->tax/100)); ?></span> <?php echo e(trans('labels.additional_tax')); ?></span>
								<?php else: ?>
									<span class="text-danger"><span id="additional_tax"><?php echo e(Helper::CurrencyFormatter($product->tax)); ?></span> <?php echo e(trans('labels.additional_tax')); ?></span>
								<?php endif; ?>
							<?php endif; ?>
						</div>


						<?php if(count($product['variations']) > 0): ?>
						<div class="woo_pr_color flex_inline_center mb-3">
							<div class="woo_pr_varient">
								<h6><?php echo e($product->attribute); ?>:</h6>
							</div>
							<div class="woo_colors_list pl-3">
								<?php $__currentLoopData = $product['variations']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $variations): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="custom-varient custom-size">
									<input type="radio" class="custom-control-input-details" name="variations" id="variation-<?php echo e($variations->id); ?>" value="<?php echo e($variations->id); ?>" price="<?php echo e($variations->price); ?>" variation-name="<?php echo e($variations->variation); ?>" qty="<?php echo e($variations->qty); ?>" old-price="<?php echo e($variations->discounted_variation_price); ?>" <?php if($key == 0): ?> checked <?php endif; ?>>
									<label class="custom-control-label" for="variation-<?php echo e($variations->id); ?>"><?php echo e($variations->variation); ?></label>
								</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</div>
						</div>
						<?php endif; ?>
						
						<!-- Short Info -->
						<div class="pr_info_prefix mb-3">
							
							<!-- First -->
							<div class="cart_sku_preflix">
								<div class="sku_preflix_first">
									<strong><?php echo e(trans('labels.sku')); ?></strong>
								</div>
								<div class="sku_preflix_last">
									<?php echo e($product->sku); ?>

								</div>
							</div>
							
							<!-- First -->
							<div class="cart_sku_preflix">
								<div class="sku_preflix_first">
									<strong>Availibility:</strong>
								</div>
								<div class="sku_preflix_last" id="stock">
									<?php if($product->is_variation == 0): ?>
										<?php if($product->product_qty > 0): ?>
											<span class="text-success"><?php echo e(trans('labels.in_stock')); ?></span>
										<?php else: ?>
											<span class="text-danger"><?php echo e(trans('labels.out_stock')); ?></span>
										<?php endif; ?>
									<?php endif; ?>

									<?php if($product->is_variation == 1): ?>
										<?php $__currentLoopData = $product['variations']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $variations): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<?php if($variations->qty > 0): ?>
												<span class="text-success"><?php echo e(trans('labels.in_stock')); ?></span>
											<?php else: ?>
												<span class="text-danger"><?php echo e(trans('labels.out_stock')); ?></span>
											<?php endif; ?>
											<?php break; ?>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php endif; ?>
								</div>
							</div>
							
							<?php if($product->tags != ""): ?>
							<!-- First -->
							<div class="cart_sku_preflix">
								<div class="sku_preflix_first">
									<strong><?php echo e(trans('labels.tags')); ?></strong>
								</div>
								<div class="sku_preflix_last">
									<?php echo e($product->tags); ?>

								</div>
							</div>
							<?php endif; ?>
							

							<!-- First -->
							<div class="cart_sku_preflix">
								<div class="sku_preflix_first">
									<strong><?php echo e(trans('labels.shipping_time')); ?></strong>
								</div>
								<div class="sku_preflix_last">
									<?php echo e($product->est_shipping_days); ?> <?php echo e(trans('labels.days')); ?>

								</div>
							</div>

							<!-- First -->
							<div class="cart_sku_preflix">
								<div class="sku_preflix_first">
									<strong><?php echo e(trans('labels.shipping_charge')); ?>:</strong>
								</div>
								<div class="sku_preflix_last">
									<?php echo e(Helper::CurrencyFormatter($product->shipping_cost)); ?>

								</div>
							</div>

							<!-- First -->
							<div class="cart_sku_preflix">
								<div class="sku_preflix_first">
									<strong><?php echo e(trans('labels.seller')); ?>:</strong>
								</div>
								<div class="sku_preflix_last">
									<a href="<?php echo e(URL::to('vendor-details/'.$vendors->id)); ?>" class="woo_pr_cats"><?php echo e($vendors->name); ?> <br>
										<i class="fa fa-star filled"></i> <?php echo e(@$vendors['rattings'][0]->avg_ratting); ?>

									</a>
								</div>
							</div>
						</div>
						
						<div class="woo_btn_action">
							<div class="col-6 col-lg-auto">
								<?php if(@Auth::user()->id != ""): ?>

									<?php if($product->is_variation == 0): ?>
										<?php if($product->product_qty > 0): ?>
											<button class="btn btn-block btn-dark mb-2 cart" onclick="AddtoCart()"><?php echo e(trans('labels.add_cart')); ?> <i class="ti-shopping-cart-full ml-2"></i></button>
										<?php else: ?>
											<button class="btn btn-block btn-dark mb-2 cart" disabled onclick="AddtoCart()"><?php echo e(trans('labels.add_cart')); ?> <i class="ti-shopping-cart-full ml-2"></i></button>
										<?php endif; ?>
									<?php endif; ?>

									<?php if($product->is_variation == 1): ?>
										<?php $__currentLoopData = $product['variations']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $variations): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<?php if($variations->qty > 0): ?>
												<button class="btn btn-block btn-dark mb-2 cart" onclick="AddtoCart()"><?php echo e(trans('labels.add_cart')); ?> <i class="ti-shopping-cart-full ml-2"></i></button>
											<?php else: ?>
												<button class="btn btn-block btn-dark mb-2 cart" disabled onclick="AddtoCart()"><?php echo e(trans('labels.add_cart')); ?> <i class="ti-shopping-cart-full ml-2"></i></button>
											<?php endif; ?>
											<?php break; ?>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php endif; ?>

									
								<?php else: ?>
									<a class="btn btn-block btn-dark mb-2" href="<?php echo e(URL::to('/signin')); ?>"><?php echo e(trans('labels.add_cart')); ?> <i class="ti-shopping-cart-full ml-2"></i></a>
								<?php endif; ?>
							</div>

							<div class="col-6 col-lg-auto">
								<?php if($product->is_wishlist == 1): ?>
									<button onclick="RemoveWishList('<?php echo e($product->id); ?>','<?php echo e($product->product_name); ?>','<?php echo e(@Auth::user()->id); ?>')" class="btn btn-gray btn-block mb-2"><?php echo e(trans('labels.wishlist')); ?> <i class="fas fa-heart i ml-2"></i></button>
								<?php else: ?>
								    <button onclick="WishList('<?php echo e($product->id); ?>','<?php echo e($product->product_name); ?>','<?php echo e(@Auth::user()->id); ?>')" class="btn btn-gray btn-block mb-2"><?php echo e(trans('labels.wishlist')); ?> <i class="ti-heart ml-2"></i></button>
								<?php endif; ?>
							</div>
						</div>
						
					</div>
				</div>
				
			</div>
			
			<!-- Product Description -->
			<div class="row mt-5">
				<div class="col-lg-12 col-md-12">
					<div class="custom-tab style-1">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true" aria-expanded="true"><?php echo e(trans('labels.description')); ?></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false" aria-expanded="false"><?php echo e(trans('labels.reviews')); ?></a>
							</li>
							<?php if($product->is_return == 1): ?>
							<li class="nav-item">
								<a class="nav-link" id="return-tab" data-toggle="tab" href="#return" role="tab" aria-controls="return" aria-selected="false" aria-expanded="false"><?php echo e(trans('labels.return-policy')); ?></a>
							</li>
							<?php endif; ?>
						</ul>
						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade active show" id="description" role="tabpanel" aria-labelledby="description-tab" aria-expanded="true">
								<p><?php echo nl2br(e($product->description)); ?></p>
							</div>
							<div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab" aria-expanded="false">
								<div class="review-wrapper">
									<div class="review-wrapper-header">
										<h4><?php echo e(count(@$all_review)); ?> Reviews</h4>
									</div>
									<div class="review-wrapper-body">
										<ul class="review-list">

											<?php $__currentLoopData = $all_review; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reviews): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<li>
												<div class="reviews-box">
													<div class="review-body">
														<div class="review-avatar">
															<img alt="" src="<?php echo e($reviews['users']->image_url); ?>" class="avatar avatar-140 photo">
														</div>
														<div class="review-content">
															<div class="review-info">
																<div class="review-comment">
																	<div class="review-author">
																		<?php echo e($reviews['users']->name); ?>

																	</div>

																	<div class="review-comment-stars">
																		<?php if($reviews->ratting < 2): ?>
																			<i class="fa fa-star"></i>
																			<i class="fa fa-star empty"></i>
																			<i class="fa fa-star empty"></i>
																			<i class="fa fa-star empty"></i>
																			<i class="fa fa-star empty"></i>
																		<?php elseif($reviews->ratting < 3): ?>
																			<i class="fa fa-star"></i>
																			<i class="fa fa-star"></i>
																			<i class="fa fa-star empty"></i>
																			<i class="fa fa-star empty"></i>
																			<i class="fa fa-star empty"></i>
																		<?php elseif($reviews->ratting < 4): ?>
																			<i class="fa fa-star"></i>
																			<i class="fa fa-star"></i>
																			<i class="fa fa-star"></i>
																			<i class="fa fa-star empty"></i>
																			<i class="fa fa-star empty"></i>
																		<?php elseif($reviews->ratting < 5): ?>
																			<i class="fa fa-star"></i>
																			<i class="fa fa-star"></i>
																			<i class="fa fa-star"></i>
																			<i class="fa fa-star"></i>
																			<i class="fa fa-star empty"></i>
																		<?php elseif($reviews->ratting < 6): ?>
																			<i class="fa fa-star"></i>
																			<i class="fa fa-star"></i>
																			<i class="fa fa-star"></i>
																			<i class="fa fa-star"></i>
																			<i class="fa fa-star"></i>
																		<?php endif; ?>
																	</div>
																</div>
																<div class="review-comment-date">
																	<div class="review-date">
																		<span><?php echo e($reviews->date); ?></span>
																	</div>
																</div>
															</div>
															<p><?php echo e($reviews->comment); ?></p>
														</div>
													</div>
												</div>
											</li>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</ul>
									</div>
								</div>
							</div>
							<div class="tab-pane fade show" id="return" role="tabpanel" aria-labelledby="return-tab" aria-expanded="true">
								<p><?php echo e($vendors->return_policies); ?></p>
							</div>
						</div>
					</div>	
				</div>
			</div>
			
		</div>
	</section>
	<!-- =========================== Product Detail =================================== -->
	
	<!-- =========================== Related Products =================================== -->
	<section class="gray">
		<div class="container-fluid">
			
			<div class="row">
				<div class="col-lg-12 col-md-12 mb-2">
					<h4 class="mb-0"><?php echo e(trans('labels.related_products')); ?></h4>
				</div>						
			</div>
			
			<div class="row">
			
				<div class="col-lg-12 col-md-12">
					<div class="owl-carousel products-slider owl-theme">
						<?php 
						$strings = array('#FDF7FF','#FDF3F0','#EDF7FD','#FFFAEA','#F1FFF6');
						$count = count($strings);
						?>
						<!-- Single Item -->
						<?php $__currentLoopData = $related_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="item">
							<div class="woo_product_grid no-hover">
								<a href="<?php echo e(URL::to('products/product-details/'.@$products['slug'])); ?>">
									<div class="woo_product_thumb">
										<?php
										$filename_from_url = parse_url($products['productimage']->image_url);
										$ext = pathinfo($filename_from_url['path'], PATHINFO_EXTENSION);
										?>
										<?php if($ext == "png"): ?>
											<img src="<?php echo e($products['productimage']->image_url); ?>" class="img-fluid" alt="" style="height: 335px; object-fit: scale-down; background-color: #f8f7f6;" title="<?php echo e($products['product_name']); ?>" />
										<?php else: ?>
											<img src="<?php echo e($products['productimage']->image_url); ?>" class="img-fluid" alt="" style="height: 335px; object-fit: scale-down;" title="<?php echo e($products['product_name']); ?>" />
										<?php endif; ?>
										<div class='curtain' style="background-color: <?php echo $strings[$key % $count]; ?>">
									    	<div class='shine'></div>
									  	</div>
									</div>
									<div class="woo_product_caption">
										<div class="woo_title mt-2">
											<h4 class="entry-title"><?php echo e(Str::limit($products->product_name, 53)); ?></h4>
											<h6><i class="fa fa-star filled"></i> <?php echo e(number_format($products->ratings_average,1)); ?></h6>
										</div>

										<div class="woo_price mt-2">
											<h6><?php echo e(Helper::CurrencyFormatter($products->product_price)); ?><span class="less_price"><?php echo e(Helper::CurrencyFormatter($products->discounted_price)); ?></span></h6>
										</div>

										<?php if($products->product_price): ?>
											<span class="post-article-cat theme-bg mt-2">Save <?php echo e(Helper::CurrencyFormatter($products->discounted_price - $products->product_price)); ?></span>
										<?php endif; ?>
									</div>
								</a>
								<div class="woo_product_cart hover">
									<ul>
										<?php if($products->is_wishlist == 1): ?>
											<li><a href="javascript:void();" onclick="RemoveWishList('<?php echo e($products->id); ?>','<?php echo e($products->product_name); ?>','<?php echo e(@Auth::user()->id); ?>')" class="woo_cart_btn btn_save"><?php echo e(trans('labels.wishlist')); ?> <i class="fas fa-heart i ml-2"></i></a></li>
										<?php else: ?>
										    <li><a href="javascript:void();" onclick="WishList('<?php echo e($products->id); ?>','<?php echo e($products->product_name); ?>','<?php echo e(@Auth::user()->id); ?>')" class="woo_cart_btn btn_save"><?php echo e(trans('labels.wishlist')); ?> <i class="ti-heart ml-2"></i></a></li>
										<?php endif; ?>
									</ul>
								</div>							
							</div>
						</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					
					</div>
				</div>
				
			</div>

			<input type="hidden" name="user_id" id="user_id" value="<?php echo e(@Auth::user()->id); ?>">
			<input type="hidden" name="product_id" id="product_id" value="<?php echo e($product->id); ?>">
			<input type="hidden" name="vendor_id" id="vendor_id" value="<?php echo e($product->vendor_id); ?>">
			<input type="hidden" name="product_name" id="product_name" value="<?php echo e($product->product_name); ?>">
			<input type="hidden" name="attribute" id="attribute" value="<?php echo e($product->attribute); ?>">
			<?php $__currentLoopData = $product['productimages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $images): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<input type="hidden" name="image" id="image" value="<?php echo e($images->image_name); ?>">
				<?php break; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<input type="hidden" name="qty" id="qty" value="1">
			<input type="hidden" name="price" id="price" value="<?php echo e($product->product_price); ?>">
			<input type="hidden" name="shipping_cost" id="shipping_cost" value="<?php echo e($product->shipping_cost); ?>">

			<?php if($product->tax_type == 'percent'): ?>
				<input type="hidden" name="tax_amount" id="tax_amount" value="<?php echo e($product->product_price*$product->tax/100); ?>">
			<?php else: ?>
				<input type="hidden" name="tax_amount" id="tax_amount" value="<?php echo e($product->tax); ?>">
			<?php endif; ?>
			<input type="hidden" name="tax" id="tax" value="<?php echo e($product->tax); ?>">
			<input type="hidden" name="currency_position" id="currency_position" value="<?php echo e($currency->currency_position); ?>">
			<input type="hidden" name="currency" id="currency" value="<?php echo e($currency->currency); ?>">
			<input type="hidden" name="tax_type" id="tax_type" value="<?php echo e($product->tax_type); ?>">
			<input type="hidden" name="slug" id="slug" value="<?php echo e($product->slug); ?>">

		</div>
	</section>
	<!-- =========================== Related Products =================================== -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripttop'); ?>
<script type="text/javascript">
	$('input[type="radio"]').change(function() {
		var currency_position = $('#currency_position').val();
		var currency = $('#currency').val();
		var tax = $('#tax').val();
		var tax_type = $('#tax_type').val();

		if(tax != 0) {
			if(tax_type == 'percent') {
				$('#tax_amount').val(parseFloat($(this).attr('price')*tax/100).toFixed(2));
				if (currency_position == "left") {
					$('#additional_tax').text(currency+parseFloat($(this).attr('price')*tax/100).toFixed(2));
				}
				if (currency_position == "right") {
					$('#additional_tax').text(parseFloat($(this).attr('price')*tax/100).toFixed(2)+currency);
				}
			} else {
				$('#tax_amount').val(parseFloat(tax).toFixed(2));
				if (currency_position == "left") {
					$('#additional_tax').text(currency+parseFloat(tax).toFixed(2));
				}
				if (currency_position == "right") {
					$('#additional_tax').text(parseFloat(tax).toFixed(2)+currency);
				}
			}
		}

		$('#price').val(parseFloat($(this).attr('price')));

		if (currency_position == "left") {
			$('.price').text(currency+parseFloat($(this).attr('price')).toFixed(2));

			if ($(this).attr('old-price') != "0") {
				$('.org_price').text(currency+parseFloat($(this).attr('old-price')).toFixed(2));
			}
		}
	    
	    if (currency_position == "right") {
	    	$('.price').text(parseFloat($(this).attr('price')).toFixed(2)+currency);

			if ($(this).attr('old-price') != "0") {
				$('.org_price').text(parseFloat($(this).attr('old-price')).toFixed(2)+currency);
			}
	    }

	    if ($(this).attr('qty') > 0) {
	    	$('#stock').html("<span class='text-success'><?php echo e(trans('labels.in_stock')); ?></span>");
	    	$(".cart").attr("disabled", false);
	    } else {
	    	$('#stock').html("<span class='text-danger'><?php echo e(trans('labels.out_stock')); ?></span>");
	    	$(".cart").attr("disabled", true);
	    }
	})

	function AddtoCart() {
	  "use strict";
	  var user_id = $('#user_id').val();
	  var product_id = $('#product_id').val();
	  var vendor_id = $('#vendor_id').val();
	  var product_name = $('#product_name').val();
	  var attribute = $('#attribute').val();
	  var image = $('#image').val();
	  var qty = $('#qty').val();
	  var price = $('#price').val();
	  var variation = $('input[name="variations"]:checked').attr('variation-name');
	  var tax = $('#tax_amount').val();
	  var slug = $('#slug').val();
	  var shipping_cost = $('#shipping_cost').val();

	  $('#preloader').show();
	  $.ajax({
	      headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	      },
	      url:"<?php echo e(URL::to('/product/addtocart')); ?>",
	      data: {
	          user_id: user_id,
	          product_id: product_id,
	          vendor_id: vendor_id,
	          product_name: product_name,
	          attribute: attribute,
	          image: image,
	          qty: qty,
	          price: price,
	          variation: variation,
	          tax: tax,
	          slug: slug,
	          shipping_cost: shipping_cost
	      },
	      method: 'POST', //Post method,
	      dataType: 'json',
	      success: function(response) {
	        $("#preloader").hide();
	          if (response.status == 1) {
	            $('#cartcnt').text(response.cartcnt);
  				$('.view-order-btn').show();
				localStorage.setItem("message",response.message)
	            location.reload();
	          } else {
	          	toast.error(response.message);
	          }
	      },
	      error: function(error) {
	          // $('#errormsg').show();
	      }
	  })
	};
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.web', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/eglobalm/public_html/resources/views/Front/product-details.blade.php ENDPATH**/ ?>