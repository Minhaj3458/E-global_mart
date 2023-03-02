@extends('layouts.admin')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.business_setting') }}
@endsection
@section('css')

@endsection
@section('content')
    <div class="content-wrapper">
        <section id="basic-form-layouts">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-header">{{ trans('labels.add_level') }}</div>
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
                                <form class="form" method="post" action="{{ route('admin.business_setting.store') }}" enctype="multipart/form-data">
                                @csrf
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label for="lavel">{{ trans('labels.lavel') }}</label>
                                            <input type="number" id="lavel" class="form-control" name="level" placeholder="{{ trans('placeholder.lavel') }}" value="{{old('level')}}">
                                            @error('level')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="amount">{{ trans('labels.amount') }}</label>
                                            <input type="number" id="amount" class="form-control" name="amount" placeholder="{{ trans('placeholder.amount') }}" value="{{old('amount')}}">
                                            @error('amount')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>

                                        <div class="gallery"></div>
                                    </div>
                                    <div class="form-actions center">
                                        <a href="{{ route('admin.business_setting') }}" class="btn btn-raised btn-warning mr-1"><i class="ft-x"></i> {{ trans('labels.cancel') }}</a>
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
