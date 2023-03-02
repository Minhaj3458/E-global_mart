<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.products')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<!-- =========================== Breadcrumbs =================================== -->
	<div class="brd_wraps pt-2 pb-2">
		<div class="container">
			<nav aria-label="breadcrumb" class="simple_breadcrumbs">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo e(URL::to('/')); ?>"><i class="ti-home"></i></a></li>
				<li class="breadcrumb-item"><a href="#"><?php echo e($breadcrumbs->category_name); ?></a></li>
				<?php if($breadcrumbs->subcategory_name != ""): ?>
				<li class="breadcrumb-item"><a href="#"><?php echo e($breadcrumbs->subcategory_name); ?></a></li>
				<?php endif; ?>
				<?php if($breadcrumbs->innersubcategory_name != ""): ?>
				<li class="breadcrumb-item active" aria-current="page"><?php echo e($breadcrumbs->innersubcategory_name); ?></li>
				<?php endif; ?>
			  </ol>
			</nav>
		</div>
	</div>
	<!-- =========================== Breadcrumbs =================================== -->
	
	<!-- =========================== Search Products =================================== -->
	<section class="gray sixcol">
		<div class="container-fluid">			
				
			<div class="row">
				<!-- Single Product -->
				<div class="col-lg-3 col-md-12">
					<div class="search-sidebar sm-sidebar" id="filter_search"  style="left:0;">
						<div class="search-sidebar_header">
							<h4 class="ssh_heading"><?php echo e(trans('labels.close_filter')); ?></h4>
							<button onclick="closeFilterSearch()" class="w3-bar-item w3-button w3-large"><i class="ti-close"></i></button>
						</div>
						<div class="search-sidebar-body">
							<a href="<?php echo e(URL::to('/categories')); ?>"><h4 class="ml-4 mt-4"><i class="fa fa-arrow-left"></i> <?php echo e(trans('labels.all_categories')); ?></h4></a>
							<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<!-- Single Option -->
							<div class="single_search_boxed">
								<div class="widget-boxed-header">
									<a href="<?php echo e(URL::to('categories/products/'.$category->slug)); ?>"><h4 class="ml-4 mt-4"><?php echo e($category->category_name); ?></h4></a>
								</div>
								<div class="widget-boxed-body">
									<div class="side-list no-border">
										<div class="filter-card">
											<?php $__currentLoopData = $subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<!-- Single Filter Card -->
											<?php if($sub->cat_id==$category->id): ?>
											<div class="single_filter_card">
												<a href="<?php echo e(URL::to('subcategories/products/'.$category->slug.'/'.$sub->slug)); ?>"><h5>- <?php echo e($sub->subcategory_name); ?></h5></a>
												<?php if(count($innersubcategory) > 0): ?>
												<div class="card-body">
													<div class="inner_widget_link">
														<ul>
															<?php $__currentLoopData = $innersubcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<?php if($inner->subcat_id==$sub->id): ?>
															<li><a href="<?php echo e(URL::to('innersubcategories/products/'.$category->slug.'/'.$sub->slug.'/'.$inner->slug)); ?>">- <?php echo e($inner->innersubcategory_name); ?></a></li>
												            <?php endif; ?>
											            	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
														</ul>
													</div>
												</div>
												<?php endif; ?>
											</div>
											<?php endif; ?>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</div>
									</div>
								</div>
							</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
					</div>
				</div>
				<?php if(count($products) == 0): ?>
					<div class="col-lg-9 col-md-12 text-center">
						<img src="<?php echo e(Helper::image_path('no-data.png')); ?>">
						<h2 class="error_title mt-4"><?php echo e(trans('labels.no_product')); ?></h2>
						<p><span class="text-primary"><?php echo e(trans('labels.woops')); ?></span> <?php echo e(trans('labels.try_another_category')); ?></p>
						<a href="<?php echo e(URL::to('/')); ?>" class="btn btn-primary"><?php echo e(trans('labels.go_home_page')); ?></a>
					</div>
				<?php else: ?>
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="filter_search_opt">
								<a href="javascript:void(0);" onclick="openFilterSearch()"><i class="ti-reload"></i></a>
							</div>
						</div>
					</div>
					<div class="col-lg-9 col-md-12">
						
						<!-- Shorter Toolbar -->
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="toolbar toolbar-products">
									<div class="toolbar-sorter sorter">
										<label class="sorter-label" for="sorter"><?php echo e(trans('labels.sort_by')); ?></label>
										<select id="sorter" data-role="sorter" class="product-sorter-options">
											<option value="new" selected="selected" data-type="<?php echo e($type); ?>" data-category="<?php echo e(@$categoryslug); ?>" data-subcategory="<?php echo e(@$subcategoryslug); ?>" data-slug="<?php echo e($slug); ?>"><?php echo e(trans('labels.new_arrivals')); ?></option>
											<option value="price-high-to-low" data-type="<?php echo e($type); ?>" data-category="<?php echo e(@$categoryslug); ?>" data-subcategory="<?php echo e(@$subcategoryslug); ?>" data-slug="<?php echo e($slug); ?>"><?php echo e(trans('labels.p_high_to_low')); ?></option>
											<option value="price-low-to-high" data-type="<?php echo e($type); ?>" data-category="<?php echo e(@$categoryslug); ?>" data-subcategory="<?php echo e(@$subcategoryslug); ?>" data-slug="<?php echo e($slug); ?>"><?php echo e(trans('labels.p_low_to_high')); ?></option>
											<option value="ratting-high-to-low" data-type="<?php echo e($type); ?>" data-category="<?php echo e(@$categoryslug); ?>" data-subcategory="<?php echo e(@$subcategoryslug); ?>" data-slug="<?php echo e($slug); ?>"><?php echo e(trans('labels.r_high_to_low')); ?></option>
											<option value="ratting-low-to-high" data-type="<?php echo e($type); ?>" data-category="<?php echo e(@$categoryslug); ?>" data-subcategory="<?php echo e(@$subcategoryslug); ?>" data-slug="<?php echo e($slug); ?>"><?php echo e(trans('labels.r_low_to_high')); ?></option>
										</select>
									</div>
								</div>
							</div>
						</div>

						<div class="row" id="product-filter">
							<?php echo $__env->make('Front.categoryfilterproduct', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						</div>	
						
						<div class="ajax-load text-center">
						    <button type="button" class="btn mb-1 btn-outline-primary text-center" onclick="loadmore()"><?php echo e(trans('labels.load_more')); ?></button>
						</div>

						<div class="no-record text-center dn">
						    <?php echo e(trans('labels.no_more_record')); ?>

						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<!-- =========================== Search Products =================================== -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripttop'); ?>

<script type="text/javascript">
	var page = 1;
	function loadmore() {
	    var type = $('#sorter option:selected').attr('data-type');
	    var categoryslug = $('#sorter option:selected').attr('data-category');
	    var subcategoryslug = $('#sorter option:selected').attr('data-subcategory');
	    var slug = $('#sorter option:selected').attr('data-slug');
	    var value = $("#sorter").val();
	    page++;
	    loadMoreData(page,type,categoryslug,subcategoryslug,slug,value);
	};

	function loadMoreData(page,type,categoryslug,subcategoryslug,slug,value){

	    $.ajax(
        {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'POST',
            url:"<?php echo e(URL::to('product/productfilter')); ?>",
            data:{      
                'value': value,
            	'type': type,
            	'categoryslug': categoryslug,
            	'subcategoryslug': subcategoryslug,
            	'slug': slug,
                'page':page
            },
            dataType: "json",
            beforeSend: function()
            {
                $('.ajax-load').show();
            }
        })
        .done(function(response)
        {
            if(response.getitem.next_page_url == null){
            	$("#product-filter").append(response.ResponseData);
            	lazyload();
                $('.no-record').show();
                $('.ajax-load').hide();
                return;
            }
            $('.ajax-load').show();
            $("#product-filter").append(response.ResponseData);
            lazyload();
        })
        .fail(function(jqXHR, ajaxOptions, thrownError)
        {
            alert('server not responding...');
        });
	}

	$('.product-sorter-options').change(function() {
        value=$(this).val();
       	var type = $('option:selected', this).attr('data-type');
       	var categoryslug = $('#sorter option:selected').attr('data-category');
       	var subcategoryslug = $('#sorter option:selected').attr('data-subcategory');
       	var slug = $('#sorter option:selected').attr('data-slug');
        page = 1;
        $('.no-record').hide();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'POST',
            url:"<?php echo e(URL::to('product/productfilter')); ?>",
            data:{      
                'value': value,
            	'type': type,
            	'categoryslug': categoryslug,
            	'subcategoryslug': subcategoryslug,
            	'slug': slug
            },
            dataType: "json",
            beforeSend: function()
            {
                $('.ajax-load').show();
            }
        })
        .done(function(response)
        {
            if(response.getitem.next_page_url == null){
            	$("#product-filter").html(response.ResponseData);
            	lazyload();
                $('.no-record').show();
                $('.ajax-load').hide();
                return;
            }
            $('.ajax-load').show();
            $("#product-filter").html(response.ResponseData);
            lazyload();
        })
        .fail(function(jqXHR, ajaxOptions, thrownError)
        {
            alert('server not responding...');
        });
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.web', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/eglobalm/public_html/resources/views/Front/products.blade.php ENDPATH**/ ?>