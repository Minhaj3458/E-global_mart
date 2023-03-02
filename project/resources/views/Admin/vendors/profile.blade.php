@extends('layouts.admin')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.vendors') }}
@endsection
@section('css')

@endsection
@section('content')
    <div class="content-wrapper">
        <section id="configuration">
            <div class="row">
                    <div class="col-md-12">
                        @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                            @php
                                Session::forget('success');
                            @endphp
                        </div>
                        @endif
                        @if(Session::has('danger'))
                        <div class="alert alert-danger">
                            {{ Session::get('danger') }}
                            @php
                                Session::forget('danger');
                            @endphp
                        </div>
                        @endif
                        <div class="card">
                            <div class="card-body">
                                <div class="px-3">
                                    <form class="form form-horizontal striped-rows form-bordered" method="post" action="{{ route('admin.vendors.update') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-body">
                                            <h4 class="form-section"><i class="ft-user"></i> {{trans('labels.basic_info')}}</h4>
                                            <div class="form-group row">
                                                <label class="col-md-2 label-control" for="name">{{trans('labels.store_name')}}</label>
                                                <div class="col-md-10">
                                                    <input type="text" id="name" class="form-control" placeholder="{{trans('labels.store_name')}}" name="name" id="name" value="{{$data->name}}">
                                                    @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 label-control" for="email">{{trans('labels.email')}}</label>
                                                <div class="col-md-10">
                                                    <input type="text" id="email" class="form-control" placeholder="{{trans('labels.email')}}" name="email" id="email" value="{{$data->email}}">
                                                    @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="form-group row last">
                                                <label class="col-md-2 label-control" for="mobile">{{trans('labels.mobile')}}</label>
                                                <div class="col-md-10">
                                                    <input type="text" id="mobile" class="form-control" placeholder="{{trans('labels.mobile')}}" name="mobile" id="mobile" value="{{$data->mobile}}">
                                                    @error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="form-group row last">
                                                <label class="col-md-2 label-control" for="store_address">{{trans('labels.address')}}</label>
                                                <div class="col-md-10">
                                                    <textarea class="form-control" name="store_address" id="store_address" placeholder="{{trans('labels.address')}}">{{$data->store_address}}</textarea>
                                                    @error('store_address')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 label-control">{{trans('labels.logo')}}</label>
                                                <div class="col-md-10">
                                                    <label id="profile_pic" class="file center-block">
                                                        <input type="file" name="profile_pic" id="profile_pic">
                                                    </label>
                                                    <br>
                                                    @error('profile_pic')<span class="text-danger">{{ $message }}</span>@enderror
                                                    <br>
                                                    <img src='{{Helper::image_path($data->profile_pic)}}' class='media-object round-media height-50'>
                                                </div>
                                            </div>

                                            <h4 class="form-section"><i class="ft-file-text"></i> {{trans('labels.payments')}}</h4>

                                            <div class="form-group row">
                                                <label class="col-md-2 label-control" for="bank_name">{{trans('labels.bank_name')}}</label>
                                                <div class="col-md-10">
                                                    <input type="text" id="bank_name" class="form-control" placeholder="{{trans('labels.bank_name')}}" name="bank_name" value="{{@$bankdata->bank_name}}">
                                                    @error('bank_name')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 label-control" for="account_type">{{trans('labels.account_type')}}</label>
                                                <div class="col-md-10">
                                                    <input type="text" id="account_type" class="form-control" placeholder="{{trans('labels.account_type')}}" name="account_type" value="{{@$bankdata->account_type}}">
                                                    @error('account_type')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 label-control" for="account_number">{{trans('labels.account_number')}}</label>
                                                <div class="col-md-10">
                                                    <input type="text" id="account_number" class="form-control" placeholder="{{trans('labels.account_number')}}" name="account_number" value="{{@$bankdata->account_number}}">
                                                    @error('account_number')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 label-control" for="routing_number">{{trans('labels.routing_number')}}</label>
                                                <div class="col-md-10">
                                                    <input type="text" id="routing_number" class="form-control" placeholder="Bank Routing Number" name="routing_number" value="{{@$bankdata->routing_number}}">
                                                    @error('routing_number')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <h4 class="form-section"><i class="fa fa-globe"></i> {{trans('labels.social_accounts')}}</h4>

                                            <div class="form-group row">
                                                <label class="col-md-2 label-control" for="facebook">{{trans('labels.facebook')}}</label>
                                                <div class="col-md-10">
                                                    <input type="text" id="facebook" class="form-control" placeholder="{{trans('labels.facebook')}}" name="facebook" value="{{$data->facebook}}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 label-control" for="instagram">{{trans('labels.instagram')}}</label>
                                                <div class="col-md-10">
                                                    <input type="text" id="instagram" class="form-control" placeholder="{{trans('labels.instagram')}}" name="instagram" value="{{$data->instagram}}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 label-control" for="twitter">{{trans('labels.twitter')}}</label>
                                                <div class="col-md-10">
                                                    <input type="text" id="twitter" class="form-control" placeholder="{{trans('labels.twitter')}}" name="twitter" value="{{$data->twitter}}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 label-control" for="google">{{trans('labels.google')}}</label>
                                                <div class="col-md-10">
                                                    <input type="text" id="google" class="form-control" placeholder="{{trans('labels.google')}}" name="google" value="{{$data->google}}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 label-control" for="youtube">{{trans('labels.youtube')}}</label>
                                                <div class="col-md-10">
                                                    <input type="text" id="youtube" class="form-control" placeholder="{{trans('labels.youtube')}}" name="youtube" value="{{$data->youtube}}">
                                                </div>
                                            </div>

                                            <h4 class="form-section"><i class="fa fa-image"></i>{{trans('labels.banner_settings')}}</h4>

                                            <div class="form-group row last">
                                                <label class="col-md-2 label-control" for="store_banner">{{trans('labels.banners')}} (1500x450)</label>
                                                <div class="col-md-10">
                                                    <input type="file" id="store_banner" class="form-control" name="store_banner" value="{{$data->store_banner}}">
                                                    <div class="row">
                                                    @foreach($getbanners as $banner)
                                                        <div class="col-2 pr-0">
                                                            <div class="card px-1">
                                                                <div class="text-center py-3">
                                                                    <img src='{{Helper::image_path($banner->image)}}' class='media-object round-media height-50'>
                                                                </div>
                                                                <span class="tags float-left">
                                                                    <span class="badge bg-danger white" onclick="do_delete('{{$banner->id}}','{{route('admin.vendors.delete')}}','{{ trans('labels.delete_image') }}','{{ trans('labels.delete') }}')">Delete</span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-actions text-right">
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
@endsection
@section('script')
<script type="text/javascript">
    function do_delete(id,page_name,name,titles)
    {
        Swal.fire({
            title: '{{ trans('labels.are_you_sure') }}',
            text: "{{ trans('labels.delete_text') }} "+name+"!",
            type: 'error',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '{{ trans('labels.yes') }}',
            cancelButtonText: '{{ trans('labels.no') }}'
        }).then((t) => {
            if(t.value==true){  
                $('#preloader').show();
                $.ajax({
                     headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: page_name,
                    type: "POST",
                    data : {'id':id},

                    success:function(data)
                    { 
                        $('#preloader').hide();
                        if(data == 1000)
                        {
                            location.reload();    
                        }
                        else
                        {
                            Swal.fire({type: 'error',title: '{{ trans('labels.cancelled') }}',showConfirmButton: false,timer: 1500});
                        }    
                    },error:function(data){
                        $('#preloader').hide();
                        console.log("AJAX error in request: " + JSON.stringify(data, null, 2));
                    }
                });
            }
            else
            {
                Swal.fire({type: 'error',title: '{{ trans('labels.cancelled') }}',showConfirmButton: false,timer: 1500});

            }
        });

    }
</script>
@endsection