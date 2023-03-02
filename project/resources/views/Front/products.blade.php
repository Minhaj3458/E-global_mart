@extends('layouts.web')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.products') }}
@endsection

@section('content')
	<!-- =========================== Breadcrumbs =================================== -->
	<div class="brd_wraps pt-2 pb-2">
		<div class="container">
			<nav aria-label="breadcrumb" class="simple_breadcrumbs">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{URL::to('/')}}"><i class="ti-home"></i></a></li>
				<li class="breadcrumb-item"><a href="#">{{$breadcrumbs->category_name}}</a></li>
				@if($breadcrumbs->subcategory_name != "")
				<li class="breadcrumb-item"><a href="#">{{$breadcrumbs->subcategory_name}}</a></li>
				@endif
				@if($breadcrumbs->innersubcategory_name != "")
				<li class="breadcrumb-item active" aria-current="page">{{$breadcrumbs->innersubcategory_name}}</li>
				@endif
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
							<h4 class="ssh_heading">{{trans('labels.close_filter')}}</h4>
							<button onclick="closeFilterSearch()" class="w3-bar-item w3-button w3-large"><i class="ti-close"></i></button>
						</div>
						<div class="search-sidebar-body">
							<a href="{{URL::to('/categories')}}"><h4 class="ml-4 mt-4"><i class="fa fa-arrow-left"></i> {{ trans('labels.all_categories') }}</h4></a>
							@foreach ($categories as $category)
							<!-- Single Option -->
							<div class="single_search_boxed">
								<div class="widget-boxed-header">
									<a href="{{URL::to('categories/products/'.$category->slug)}}"><h4 class="ml-4 mt-4">{{$category->category_name}}</h4></a>
								</div>
								<div class="widget-boxed-body">
									<div class="side-list no-border">
										<div class="filter-card">
											@foreach ($subcategory as $sub)
											<!-- Single Filter Card -->
											@if($sub->cat_id==$category->id)
											<div class="single_filter_card">
												<a href="{{URL::to('subcategories/products/'.$category->slug.'/'.$sub->slug)}}"><h5>- {{$sub->subcategory_name}}</h5></a>
												@if(count($innersubcategory) > 0)
												<div class="card-body">
													<div class="inner_widget_link">
														<ul>
															@foreach ($innersubcategory as $inner)
															@if($inner->subcat_id==$sub->id)
															<li><a href="{{URL::to('innersubcategories/products/'.$category->slug.'/'.$sub->slug.'/'.$inner->slug)}}">- {{$inner->innersubcategory_name}}</a></li>
												            @endif
											            	@endforeach
														</ul>
													</div>
												</div>
												@endif
											</div>
											@endif
											@endforeach
										</div>
									</div>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
				@if(count($products) == 0)
					<div class="col-lg-9 col-md-12 text-center">
						<img src="{{Helper::image_path('no-data.png')}}">
						<h2 class="error_title mt-4">{{ trans('labels.no_product') }}</h2>
						<p><span class="text-primary">{{trans('labels.woops')}}</span> {{ trans('labels.try_another_category') }}</p>
						<a href="{{URL::to('/')}}" class="btn btn-primary">{{ trans('labels.go_home_page') }}</a>
					</div>
				@else
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
										<label class="sorter-label" for="sorter">{{ trans('labels.sort_by') }}</label>
										<select id="sorter" data-role="sorter" class="product-sorter-options">
											<option value="new" selected="selected" data-type="{{$type}}" data-category="{{@$categoryslug}}" data-subcategory="{{@$subcategoryslug}}" data-slug="{{$slug}}">{{ trans('labels.new_arrivals') }}</option>
											<option value="price-high-to-low" data-type="{{$type}}" data-category="{{@$categoryslug}}" data-subcategory="{{@$subcategoryslug}}" data-slug="{{$slug}}">{{ trans('labels.p_high_to_low') }}</option>
											<option value="price-low-to-high" data-type="{{$type}}" data-category="{{@$categoryslug}}" data-subcategory="{{@$subcategoryslug}}" data-slug="{{$slug}}">{{ trans('labels.p_low_to_high') }}</option>
											<option value="ratting-high-to-low" data-type="{{$type}}" data-category="{{@$categoryslug}}" data-subcategory="{{@$subcategoryslug}}" data-slug="{{$slug}}">{{ trans('labels.r_high_to_low') }}</option>
											<option value="ratting-low-to-high" data-type="{{$type}}" data-category="{{@$categoryslug}}" data-subcategory="{{@$subcategoryslug}}" data-slug="{{$slug}}">{{ trans('labels.r_low_to_high') }}</option>
										</select>
									</div>
								</div>
							</div>
						</div>

						<div class="row" id="product-filter">
							@include('Front.categoryfilterproduct')
						</div>	
						
						<div class="ajax-load text-center">
						    <button type="button" class="btn mb-1 btn-outline-primary text-center" onclick="loadmore()">{{ trans('labels.load_more') }}</button>
						</div>

						<div class="no-record text-center dn">
						    {{ trans('labels.no_more_record') }}
						</div>
					</div>
				@endif
			</div>
		</div>
	</section>
	<!-- =========================== Search Products =================================== -->
@endsection

@section('scripttop')

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
            url:"{{ URL::to('product/productfilter') }}",
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
            url:"{{ URL::to('product/productfilter') }}",
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

@endsection