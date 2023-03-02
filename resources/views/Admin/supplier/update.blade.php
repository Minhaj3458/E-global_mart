@extends('layouts.admin')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.supplier') }}
@endsection
@section('css')

@endsection
@section('content')
    <div class="content-wrapper">
        <section id="basic-form-layouts">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-header">{{ trans('labels.update_supplier') }}</div>
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
                                <form class="form" method="post" action="{{ route('admin.supplier.update',$data->id) }}" enctype="multipart/form-data">
                                @csrf
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label for="name">{{ trans('labels.name') }}</label>
                                            <input type="text" id="name" class="form-control" name="name" placeholder="{{ trans('placeholder.name') }}" value="{{$data->name}}">
                                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="owner_name">{{ trans('labels.owner_name') }}</label>
                                            <input type="text" id="owner_name" class="form-control" name="owner_name" placeholder="{{ trans('placeholder.owner_name') }}" value="{{$data->owner_name}}">
                                            @error('owner_name')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="store_name">{{ trans('labels.store_name') }}</label>
                                            <input type="text" id="store_name" class="form-control" name="store_name" placeholder="{{ trans('placeholder.store_name') }}" value="{{$data->store_name}}">
                                            @error('store_name')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="email">{{ trans('labels.email') }}</label>
                                            <input type="email" id="email" class="form-control" name="email" placeholder="{{ trans('placeholder.email') }}" value="{{$data->email}}">
                                            @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="number">{{ trans('labels.number') }}</label>
                                            <input type="number" id="number" class="form-control" name="number" placeholder="{{ trans('placeholder.phone') }}" value="{{$data->number}}">
                                            @error('number')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="website">{{ trans('labels.website') }}</label>
                                            <input type="text" id="website" class="form-control" name="website" placeholder="{{ trans('placeholder.Website') }}" value="{{$data->website}}">
                                            @error('website')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>

                                        <div class="gallery"></div>
                                    </div>
                                    <div class="form-actions center">
                                        <a href="{{ route('admin.supplier') }}" class="btn btn-raised btn-warning mr-1"><i class="ft-x"></i> {{ trans('labels.cancel') }}</a>
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
