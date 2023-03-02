@extends('layouts.web')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.category') }}
@endsection

@section('content')
	<!-- =========================== Breadcrumbs =================================== -->
	<div class="brd_wraps pt-2 pb-2">
		<div class="container">
			<nav aria-label="breadcrumb" class="simple_breadcrumbs">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#"><i class="ti-home"></i></a></li>
				<li class="breadcrumb-item active" aria-current="page">{{ trans('labels.category') }}</li>
			  </ol>
			</nav>
		</div>
	</div>
	<!-- =========================== Breadcrumbs =================================== -->

	<!-- =========================== Category =================================== -->

   	<section class="gray">
   		<div class="container">
   			@foreach (Helper::getCategory() as $category)
      		<div class="p-3 border-bottom fs-16 fw-600 text-center">
         		<h2><a href="{{URL::to('categories/products/'.$category->slug)}}"> {{$category->category_name}} </a></h2>
      		</div>
      		<div class="p-3 p-lg-4">
         		<div class="row">
         			@foreach (Helper::getSubcategory() as $sub)
	         			@if($sub->cat_id==$category->id)
			            <div class="col-lg-3 col-6 text-left">
			               	<h6 class="mb-3"><a class="text-reset fw-600 fs-14" href="{{URL::to('subcategories/products/'.$category->slug.'/'.$sub->slug)}}">{{$sub->subcategory_name}}</a></h6>
			               	<ul class="mb-3 list-unstyled pl-2">
			               		@foreach (Helper::InnerSubcategory() as $inner)
			               		@if($inner->subcat_id==$sub->id)
			                  	<li class="mb-2">
			                     	<a class="text-reset" href="{{URL::to('innersubcategories/products/'.$category->slug.'/'.$sub->slug.'/'.$inner->slug)}}">{{$inner->innersubcategory_name}}</a>
			                  	</li>
              		            @endif
              	            	@endforeach
			               	</ul>
			            </div>
			            @endif
		            @endforeach
         		</div>
      		</div>
      		@endforeach
      	</div>
   	</section>
	<!-- =========================== Category =================================== -->

@endsection

@section('scripttop')

@endsection