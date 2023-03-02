@extends('layouts.admin')
@section('title')
    {{Helper::webinfo()->site_title}} | {{trans('labels.vendor_details')}}
@endsection
@section('css')

@endsection
@section('content')

    <div class="content-wrapper"><!--User Profile Starts-->

        <!--About section starts-->
        <section id="about">
            <div class="row">
                <div class="col-12">
                    <div class="content-header">{{trans('labels.about')}}</div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-block mt-2">
                                <img src='{{Helper::image_path($data->profile_pic)}}' class='media-object round-media height-50'>
                                <div class="mb-3">
                                    <h3 class="text-bold-500 primary mt-2">{{$data->name}}</h3>
                                    <div class="vendor_ratting">
                                    <i class="icon-star"></i>
                                    <span>
                                        @if(!empty($data['rattings'][0]))
                                            {{$data['rattings'][0]->avg_ratting}}
                                        @else
                                            0.0
                                        @endif
                                        {{trans('labels.average_rattings')}}
                                    </span>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <ul class="no-list-style">
                                            <li class="mb-2">
                                                <span class="text-bold-500 primary"><a><i class="ft-mail font-small-3"></i> {{trans('labels.email')}}</a></span>
                                                <a class="display-block overflow-hidden">{{$data->email}}</a>
                                            </li>
                                            <li class="mb-2">
                                                <span class="text-bold-500 primary"><a><i class="ft-smartphone font-small-3"></i> {{trans('labels.mobile')}}</a></span>
                                                <span class="display-block overflow-hidden">{{$data->mobile}}</span>
                                            </li>
                                            <li class="mb-2">
                                                <span class="text-bold-500 primary"><a><i class="ft-home font-small-3"></i> {{trans('labels.address')}}</a></span>
                                                <span class="display-block overflow-hidden">{{$data->store_address}}</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <ul class="no-list-style">
                                            <li class="mb-2">
                                                <span class="text-bold-500 primary"><a><i class="ft-smartphone font-small-3"></i> {{trans('labels.status')}}</a></span>
                                                <span class="display-block overflow-hidden">
                                                    @if($data->is_verified == 0)
                                                        {{trans('labels.unverified')}}
                                                    @else
                                                        {{trans('labels.verified')}}
                                                    @endif
                                                </span>
                                            </li>
                                            <li class="mb-2">
                                                <span class="text-bold-500 primary"><a><i class="ft-monitor font-small-3"></i> {{trans('labels.website')}}</a></span>
                                                <a class="display-block overflow-hidden"><a href="{{URL::to('vendor-details/'.$data->id)}}" target="_blank"> {{trans('labels.go_to_store')}}</a>
                                            </li>
                                            <li class="mb-2">
                                                <span class="text-bold-500 primary"><a><i class="ft-book font-small-3"></i> {{trans('labels.joined')}}</a></span>
                                                <span class="display-block overflow-hidden">{{Helper::date_format($data->created_at)}}</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <ul class="no-list-style">
                                            <li class="mb-2">
                                                <span class="text-bold-500 primary"><a><i class="ft-monitor font-small-3"></i> {{trans('labels.bank_name')}}</a></span>
                                                <span class="display-block overflow-hidden">{{@$bankdata->bank_name}}</span>
                                            </li>
                                            <li class="mb-2">
                                                <span class="text-bold-500 primary"><a><i class="ft-book font-small-3"></i> {{trans('labels.account_type')}}</a></span>
                                                <span class="display-block overflow-hidden">{{@$bankdata->account_type}}</span>
                                            </li>
                                            <li class="mb-2">
                                                <span class="text-bold-500 primary"><a><i class="ft-book font-small-3"></i> {{trans('labels.account_number')}}</a></span>
                                                <span class="display-block overflow-hidden">{{@$bankdata->account_number}}</span>
                                            </li>
                                            <li class="mb-2">
                                                <span class="text-bold-500 primary"><a><i class="ft-book font-small-3"></i> {{trans('labels.routing_number')}}</a></span>
                                                <span class="display-block overflow-hidden">{{@$bankdata->routing_number}}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                      <h4 class="card-title mb-0">{{trans('labels.monthly_orders')}}</h4>
                    </div>
                    <div class="card-body">
                      <p class="font-medium-2 text-muted text-center pb-2">{{trans('labels.six_months_sales')}}</p>
                      <div class="card-block">
                        <div id="piechart" class="height-400 lineAreaDashboard">
                        </div>
                      </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="row" matchHeight="card">
                    <div class="col-xl-6 col-lg-6 col-12">
                        <div class="card bg-success">
                            <div class="card-body">
                                <div class="px-3 py-3">
                                    <div class="media">
                                        <div class="media-body white text-left">
                                            <h3>{{$ttlorders}}</h3>
                                            <span>{{trans('labels.total_orders')}}</span>
                                        </div>
                                        <div class="media-right align-self-center">
                                            <i class="icon-speedometer white font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-12">
                        <div class="card bg-danger">
                            <div class="card-body">
                                <div class="px-3 py-3">
                                    <div class="media">
                                        <div class="media-body white text-left">
                                            <h3>{{$ttlcancelorders}}</h3>
                                            <span>{{trans('labels.total_cancel_orders')}}</span>
                                        </div>
                                        <div class="media-right align-self-center">
                                            <i class="icon-close white font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-12">
                        <div class="card bg-warning">
                            <div class="card-body">
                                <div class="px-3 py-3">
                                    <div class="media">
                                        <div class="media-body white text-left">
                                            <h3>{{$ttlreturnorders}}</h3>
                                            <span>{{trans('labels.total_return_orders')}}</span>
                                        </div>
                                        <div class="media-left align-self-center">
                                            <i class="icon-action-undo white font-large-2 float-left"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-12">
                        <div class="card bg-primary">
                            <div class="card-body">
                                <div class="px-3 py-3">
                                    <div class="media">
                                        <div class="media-body white text-left">
                                            <h3>{{$ttlpendingorders}}</h3>
                                            <span>{{trans('labels.total_pending_orders')}}</span>
                                        </div>
                                        <div class="media-left align-self-center">
                                            <i class="icon-graph white font-large-2 float-left"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-12">
                        <div class="card bg-danger">
                            <div class="card-body">
                                <div class="px-3 py-3">
                                    <div class="media">
                                        <div class="media-body white text-left">
                                            <h3>{{Helper::CurrencyFormatter($ttlpending->wallet)}}</h3>
                                            <span>Pending Settlement</span>
                                        </div>
                                        <div class="media-right align-self-center">
                                            <i class="icon-wallet white font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-12">
                        <div class="card bg-success">
                            <div class="card-body">
                                <div class="px-3 py-3">
                                    <div class="media">
                                        <div class="media-body white text-left">
                                            <h3>{{Helper::CurrencyFormatter($ttlearning)}}</h3>
                                            <span>{{trans('labels.total_earnings')}}</span>
                                        </div>
                                        <div class="media-right align-self-center">
                                            <i class="icon-bar-chart white font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section id="striped-light">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{trans('labels.transaction_history')}}</h4>
                        </div>
                        <div class="card-body">
                            <div class="card-block">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{trans('labels.request_id')}}</th>
                                            <th>{{trans('labels.name')}}</th>
                                            <th>{{trans('labels.amount')}}</th>
                                            <th>{{trans('labels.action')}}</th>
                                            <th>{{trans('labels.paid_date')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($payoutdetails as $row)
                                        <tr>
                                            <td>{{$row->request_id}}</td>
                                            <td>{{$row['vendors']->name}}</td>
                                            <td>
                                                {{trans('labels.requested_amount')}} : <b>{{Helper::CurrencyFormatter($row->amount)}}</b> <br>
                                                {{trans('labels.admin_commission')}} ({{$row->commission_pr}}%) : - <b>{{Helper::CurrencyFormatter($row->commission)}}</b> <br><br>
                                                {{trans('labels.payable_amount')}} : <b>{{Helper::CurrencyFormatter($row->paid_amount)}}</b>
                                            </td>
                                            <td>
                                                @if($row->status == 1)
                                                    <span class="badge badge-warning">{{trans('labels.pending')}}</span>
                                                @else
                                                    <span class="badge badge-success">{{trans('labels.paid')}}</span>
                                                @endif
                                            </td>
                                            <td>{{$row->paid_at}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--About section ends-->
    </div>

@endsection
@section('scripttop')
@endsection
@section('script')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    // 
    google.charts.load('current', {'packages':['corechart']});

    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

    var data = google.visualization.arrayToDataTable([
        ['Month Name', 'amount'],

            @php
            foreach($orders as $order) {
                echo "['".$order->month_name."', ".$order->amount."],";
            }
            @endphp
    ]);

      var options = {
        title: 'Monthly earnings',
        is3D: true,
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart'));

      chart.draw(data, options);
    }
</script>
@endsection