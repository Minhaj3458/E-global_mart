@extends('layouts.web')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.terms') }}
@endsection

@section('content')
	<!-- =========================== Breadcrumbs =================================== -->
	<div class="brd_wraps pt-2 pb-2">
		<div class="container">
			<nav aria-label="breadcrumb" class="simple_breadcrumbs">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#"><i class="ti-home"></i></a></li>
				<li class="breadcrumb-item active" aria-current="page">{{ trans('labels.terms') }}</li>
			  </ol>
			</nav>
		</div>
	</div>
	<!-- =========================== Breadcrumbs =================================== -->

	<!-- =========================== Terms & Conditions =================================== -->

   	<section>
   		<div class="container">
   			<h2 class="text-center">{{ trans('labels.terms') }}</h2>
   			<div class="row">

   				<div class="col-lg-12 col-md-12 col-sm-12">
   					<p>{!! nl2br(e($termsconditions->terms_conditions)) !!}</p>
   				</div>
   				
   			</div>
   		</div>
   	</section>
	<!-- =========================== Category =================================== -->

@endsection

@section('scripttop')

@endsection