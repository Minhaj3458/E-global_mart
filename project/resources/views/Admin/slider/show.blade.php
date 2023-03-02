@extends('layouts.admin')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.sliders') }}
@endsection
@section('css')

@endsection
@section('content')
    <div class="content-wrapper">
        <section id="basic-form-layouts">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-header">{{ trans('labels.edit_slider') }}</div>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-12">
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
                                <form class="form" method="post" action="{{ route('admin.slider.update') }}" enctype="multipart/form-data">
                                @csrf
                                    <div class="form-body">
                                      <input type="hidden" name="slider_id" id="slider_id" value="{{$data->id}}" class="form-control">
                                      <input type="hidden" name="old_img" id="old_img" value="{{$data->image}}" class="form-control">
                                      <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                            <fieldset class="form-group">
                                                <label for="image">{{ trans('labels.image') }} (1920X820)</label>
                                                <input type="file" id="image" class="form-control" name="image" >
                                                @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                                            </fieldset>
                                            <img src='{{Helper::image_path($data->image)}}' class='media-object round-media height-150'>
                                        </div> 

                                        <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                            <fieldset class="form-group">
                                                <label for="link">{{ trans('labels.link') }}</label>
                                                <input type="text" class="form-control" id="link" name="link" placeholder="Link" value="{{$data->link}}">
                                                @error('link')<span class="text-danger">{{ $message }}</span>@enderror
                                            </fieldset>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="form-actions center">
                                        <a href="{{ route('admin.slider') }}" class="btn btn-raised btn-warning mr-1"><i class="ft-x"></i> {{ trans('labels.cancel') }}</a>
                                        @if (env('Environment') == 'sendbox')
                                            <button type="button" class="btn btn-raised btn-primary" onclick="myFunction()"> <i class="fa fa-check-square-o"></i> {{ trans('labels.update') }}</button>
                                        @else
                                            <button type="submit" id="btn_add_category" class="btn btn-raised btn-primary"> <i class="fa fa-check-square-o"></i> {{ trans('labels.update') }}</button>
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