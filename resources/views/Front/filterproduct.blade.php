<!-- row -->
<?php 
$strings = array('#FDF7FF','#FDF3F0','#EDF7FD','#FFFAEA','#F1FFF6');
$counts = count($strings);
?>
@foreach($products as $keys => $product)
<div class="col-2xl-2 col-xl-3 col-lg-4 col-sm-6 mb-4">
	<div class="woo_product_grid no-hover">
		
		<a href="{{URL::to('products/product-details/'.$product->slug)}}">
			<div class="woo_product_thumb">
				<?php
					$filename_from_url = parse_url($product['productimage']->image_url);
					$ext = pathinfo($filename_from_url['path'], PATHINFO_EXTENSION);
				?>
				<img src="{{$product['productimage']->image_url}}" class="img-fluid lazyload product-box-image @if($ext=='png') gray-bg @endif" title="{{$product['product_name']}}" />
				<div class='curtain' style="background-color: <?php echo $strings[$keys % $counts]; ?>">
			    	<div class='shine'></div>
			  	</div>
			</div>

			<div class="woo_product_caption">
				<div class="woo_title mt-2">
					<h4 class="entry-title">{{ Str::limit($product->product_name, 53) }}</h4>
					<h6><i class="fa fa-star filled"></i> {{number_format($product->ratings_average,1)}}</h6>
				</div>
				<div class="woo_price mt-2">
					<h6>{{Helper::CurrencyFormatter($product->product_price)}}<span class="less_price">{{Helper::CurrencyFormatter($product->discounted_price)}}</span></h6>
				</div>
				@if($product->product_price)
					<span class="post-article-cat theme-bg mt-2">{{ trans('labels.save') }} {{Helper::CurrencyFormatter($product->discounted_price - $product->product_price)}}</span>
				@endif
			</div>
		</a>
		<div class="woo_product_cart hover">
			<ul>
				@if ($product->is_wishlist == 1)
					<li><a href="javascript:void();" onclick="RemoveWishList('{{$product->id}}','{{$product->product_name}}','{{@Auth::user()->id}}')" class="woo_cart_btn btn_save">{{ trans('labels.wishlist') }} <i class="fas fa-heart i ml-2"></i></a></li>
				@else
				    <li><a href="javascript:void();" onclick="WishList('{{$product->id}}','{{$product->product_name}}','{{@Auth::user()->id}}')" class="woo_cart_btn btn_save">{{ trans('labels.wishlist') }} <i class="ti-heart ml-2"></i></a></li>
				@endif
			</ul>
		</div>								
	</div>
</div>
@endforeach
<!-- row