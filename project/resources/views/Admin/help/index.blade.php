@extends('layouts.admin')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.help') }}
@endsection
@section('css')

@endsection
@section('content')
    <div class="content-wrapper">
        <section id="striped-light">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ trans('labels.help') }}</h4>
                        </div>
                        <div class="col-md-4">
                            <form method="GET" action="{{route('admin.help.search')}}">
                                <div class="input-group">
                                    <input type="text" id="search" name="search" placeholder="Type & Enter" value="{{ request()->get('search') }}" class="form-control round">
                                    <div class="input-group-append">
                                        <button class="input-group-text" id="basic-addon4"><i class="ft-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="card-block">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ trans('labels.username') }}</th>
                                            <th>{{ trans('labels.contact_info') }}</th>
                                            <th>{{ trans('labels.subject') }}</th>
                                            <th>{{ trans('labels.message') }}</th>
                                            <th>{{ trans('labels.created_at') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $n=0 @endphp
                                        @foreach($data as $row)
                                        <tr>
                                            <td>{{$row->first_name}} {{$row->last_name}}</td>
                                            <td>{{$row->mobile}} <br> {{$row->email}} </td>
                                            <td>{{$row->subject}}</td>
                                            <td>{{$row->message}}</td>
                                            <td>{{$row->created_at}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="float-right">
                                    {{$data->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection