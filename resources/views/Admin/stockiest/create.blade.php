@extends('layouts.admin')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.manage_stockiest') }}
@endsection
@section('css')

@endsection
@section('content')
    <div class="content-wrapper">
        <section id="basic-form-layouts">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-header">{{ trans('labels.update_stock') }}</div>
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
                                <form class="form" method="post" action="{{ route('admin.stockiest.store') }}" enctype="multipart/form-data">
                                @csrf
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label for="user_id">{{ trans('labels.user_number') }}</label>
                                            <select class="form-control" name="user_id" id="user_id">
                                                <option value="">{{ trans('placeholder.user_number') }}</option>
                                                @foreach ($user as $show)
                                                    <option value="{{$show->id}}">{{$show->mobile}}</option>
                                                @endforeach
                                            </select>
                                            @error('user_id')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="stock_name">{{ trans('labels.stock_name') }}</label>
                                            <input type="text" id="stock_name" class="form-control" name="stock_name" placeholder="{{ trans('placeholder.stoct_name') }}" value="{{old('amount')}}">
                                            @error('stock_name')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="address">{{ trans('labels.address') }}</label>
                                            <textarea type="text" id="address" class="form-control" name="address" placeholder="{{ trans('placeholder.address') }}" value="{{old('address')}}"></textarea>
                                            @error('address')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>

                                        <div class="gallery"></div>
                                    </div>
                                    <div class="form-actions center">
                                        <a href="{{ route('admin.stockiest') }}" class="btn btn-raised btn-warning mr-1"><i class="ft-x"></i> {{ trans('labels.cancel') }}</a>
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
