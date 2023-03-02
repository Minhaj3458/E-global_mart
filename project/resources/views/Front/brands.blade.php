@extends('layouts.web')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.brands') }}
@endsection

@section('content')
	<!-- =========================== Breadcrumbs =================================== -->
	<div class="brd_wraps pt-2 pb-2">
		<div class="container">
			<nav aria-label="breadcrumb" class="simple_breadcrumbs">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{URL::to('/')}}"><i class="ti-home"></i></a></li>
				<li class="breadcrumb-item active" aria-current="page">{{ trans('labels.brands') }}</li>
			  </ol>
			</nav>
		</div>
	</div>
	<!-- =========================== Breadcrumbs =================================== -->

	<!-- =========================== Search Products =================================== -->
	<section class="sixcol">
		<div class="container-fluid">
			
			<div class="row">

				<div class="col-lg-12 col-md-12">
					
					<!-- Shorter Toolbar -->
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="toolbar toolbar-products">
								<div class="toolbar-sorter sorter">
									<input type="hidden" name="brand" id="brand" value="{{@$products[0]->brand}}">
									<label class="sorter-label" for="sorter">{{ trans('labels.sort_by') }}</label>
									<select id="sorter" data-role="sorter" class="sorter-options">
										<option value="new" data-type="brand">{{ trans('labels.new_arrivals') }}</option>
										<option value="price-high-to-low" data-type="brand">{{ trans('labels.p_high_to_low') }}</option>
										<option value="price-low-to-high" data-type="brand">{{ trans('labels.p_low_to_high') }}</option>
										<option value="ratting-high-to-low" data-type="brand">{{ trans('labels.r_high_to_low') }}</option>
										<option value="ratting-low-to-high" data-type="brand">{{ trans('labels.r_low_to_high') }}</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					
					<!-- row -->
					<div class="row" id="product-filter">
						@include('Front.filterproduct');					
					</div>
					<!-- row -->
					
				</div>

				<div class="ajax-load text-center">
				    <button type="button" class="btn mb-1 btn-outline-primary text-center" onclick="loadmore()">{{ trans('labels.load_more') }}</button>
				</div>

				<div class="no-record text-center dn">
				    {{ trans('labels.no_more_record') }}
				</div>
				
			</div>
		</div>
	</section>
	<!-- =========================== Search Products =================================== -->

@endsection

@section('scripttop')
<script type="text/javascript">
	var brand = $("#brand").val();
	var page = 1;
	function loadmore() {
	    var type = $('#sorter :selected').attr('data-type');
	    var value = $('#sorter :selected').text();
	    page++;
	    loadMoreData(page,type,value);
	};

	function loadMoreData(page,type,value){
	    $.ajax({
	            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
	            type:'POST',
	            url:"{{ URL::to('product/filter') }}",
	            data:{
	                'value': value,
	            	'type': type,
	                'brand':brand,
	                'page':page
	            },
	            dataType: "json",
	            beforeSend: function(){
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

	$('.sorter-options').change(function() {
        value=$(this).val();
       	var type = $('option:selected', this).attr('data-type');
        page = 1;
        $('.no-record').hide();
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:'POST',
            url:"{{ URL::to('product/filter') }}",
            data:{      
                'value': value,
            	'brand': brand,
            	'type': type,
            },
            dataType: "json",
            beforeSend: function(){
                $('.ajax-load').show();
            }
        })
        .done(function(response){
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
        .fail(function(jqXHR, ajaxOptions, thrownError){
            alert('server not responding...');
        });
    });
</script>
@endsection