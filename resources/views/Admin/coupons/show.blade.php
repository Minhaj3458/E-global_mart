@extends('layouts.admin')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.coupons') }}
@endsection
@section('css')

@endsection
@section('content')
    <div class="content-wrapper">
        <section id="basic-form-layouts">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-header">{{ trans('labels.edit_coupons') }}</div>
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
                                <form class="form" method="post" action="{{ route('admin.coupons.update') }}" enctype="multipart/form-data">
                                @csrf
                                    <div class="form-body">
                                        <input type="hidden" name="coupon_id" id="coupon_id" value="{{$data->id}}" class="form-control">
                                        <div class="form-group">
                                            <label for="coupon_name">{{ trans('labels.coupon_name') }}</label>
                                            <input type="text" id="coupon_name" class="form-control" name="coupon_name" placeholder="{{ trans('placeholder.coupon_name') }}" value="{{$data->coupon_name}}">
                                            @error('coupon_name')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="type">{{ trans('labels.type') }}</label>
                                            <select name="type" id="type" class="form-control" onchange="showType(this)">
                                                <option value="">{{ trans('placeholder.select_type') }}</option>
                                                <option value="0" {{ $data->type == 0 ? 'selected' : ''}}>{{ trans('labels.discount_by_percentage') }}</option>
                                                <option value="1" {{ $data->type == 1 ? 'selected' : ''}}>{{ trans('labels.discount_by_amount') }}</option>
                                            </select>
                                             @error('type')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>

                                        <div class="form-group @if($data->type == 1) d-none @endif" id="percentage_div">
                                            <label for="percentage">{{ trans('labels.percentage') }}</label>
                                            <input type="text" id="percentage" class="form-control" name="percentage" placeholder="{{ trans('placeholder.percentage') }}" value="{{$data->percentage}}">
                                            @error('percentage')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>

                                        <div class="form-group @if($data->type == 0) d-none @endif" id="amount_div">
                                            <label for="amount">{{ trans('labels.amount') }}</label>
                                            <input type="text" id="amount" class="form-control" name="amount" placeholder="{{ trans('placeholder.amount') }}" value="{{$data->amount}}">
                                            @error('amount')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="quantity">{{ trans('labels.quantity') }}</label>
                                            <select name="quantity" id="quantity" class="form-control" onchange="showQuantity(this)">
                                                <option value="">{{ trans('placeholder.select_quantity') }}</option>
                                                <option value="0" {{ $data->quantity == 0 ? 'selected' : ''}}>{{ trans('labels.unlimited') }}</option>
                                                <option value="1" {{ $data->quantity == 1 ? 'selected' : ''}}>{{ trans('labels.limited') }}</option>
                                            </select>
                                            @error('quantity')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>

                                        <div class="form-group @if($data->quantity == 0) d-none @endif" id="show_times">
                                            <label for="times">{{ trans('labels.value') }}</label>
                                            <input type="text" id="times" class="form-control" name="times" placeholder="{{ trans('placeholder.value') }}" value="{{$data->times}}">
                                            @error('times')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="start_date">{{ trans('labels.start_date') }}</label>
                                                    <input type="date" id="start_date" class="form-control" name="start_date" placeholder="{{ trans('placeholder.start_date') }}" value="{{$data->start_date}}">
                                                    @error('start_date')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="end_date">{{ trans('labels.end_date') }}</label>
                                                    <input type="date" id="end_date" class="form-control" name="end_date" placeholder="{{ trans('placeholder.end_date') }}" value="{{$data->end_date}}">
                                                    @error('end_date')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="min_amount">{{ trans('labels.min_order_amount') }}</label>
                                            <input type="text" id="min_amount" class="form-control" name="min_amount" placeholder="{{ trans('labels.min_order_amount') }}" value="{{$data->min_amount}}">
                                            @error('min_amount')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        
                                    </div>

                                    <div class="form-actions center">
                                        <a href="{{ route('admin.coupons') }}" class="btn btn-raised btn-warning mr-1">
                                            <i class="ft-x"></i> {{ trans('labels.cancel') }}
                                        </a>
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
@section('scripttop')
@section('script')
<script type="text/javascript">
    function showType(select){
       if(select.value==0){
        document.getElementById('percentage_div').classList.remove('d-none');
        document.getElementById('percentage_div').style.display = "block";
        document.getElementById('amount_div').style.display = "none";
       } else{
        document.getElementById('amount_div').classList.remove('d-none');
        document.getElementById('amount_div').style.display = "block";
        document.getElementById('percentage_div').style.display = "none";
       }
    };

    function showQuantity(select){
       if(select.value==1){
        document.getElementById('show_times').classList.remove('d-none');
        document.getElementById('show_times').style.display = "block";
       } else{
        document.getElementById('show_times').style.display = "none";
       }
    };
</script>
@endsection