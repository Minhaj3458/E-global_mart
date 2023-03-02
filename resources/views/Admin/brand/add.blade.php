@extends('layouts.admin')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.brand') }}
@endsection
@section('css')

@endsection
@section('content')
    <div class="content-wrapper">
        <section id="basic-form-layouts">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-header">{{ trans('labels.add_brand') }}</div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            @if(Session::has('danger'))
                            <div class="alert alert-danger">
                                {{ Session::get('danger') }}
                                @php
                                    Session::forget('danger');
                                @endphp
                            </div>
                            @endif
                            <div class="px-3">
                                <form class="form" method="post" action="{{ route('admin.brand.store') }}" enctype="multipart/form-data">
                                @csrf
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label for="brand_name">{{ trans('labels.brand') }}</label>
                                            <input type="text" id="brand_name" class="form-control" name="brand_name" placeholder="{{ trans('placeholder.brand') }}" value="{{old('brand_name')}}">
                                            @error('brand_name')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="icon">{{ trans('labels.image') }} (140X140)</label>
                                            <input type="file" id="icon" class="form-control" name="icon" >
                                            @error('icon')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="gallery"></div>
                                    </div>
                                    <div class="form-actions center">
                                        <a href="{{ route('admin.brand') }}" class="btn btn-raised btn-warning mr-1"><i class="ft-x"></i> {{ trans('labels.cancel') }}</a>
                                        @if (env('Environment') == 'sendbox')
                                            <button type="button" class="btn btn-raised btn-primary" onclick="myFunction()"> <i class="fa fa-check-square-o"></i> {{ trans('labels.save') }}</button>
                                        @else
                                            <button type="submit" id="btn_add_category" class="btn btn-raised btn-primary"> <i class="fa fa-check-square-o"></i> {{ trans('labels.save') }}</button>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
