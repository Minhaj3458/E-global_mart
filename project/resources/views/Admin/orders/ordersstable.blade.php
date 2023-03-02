<table class="table table-striped table-responsive-sm table-striped">
    <thead>
        <tr>
            <th>{{trans('labels.srno')}}</th>
            @if(Auth::user()->type == 1)
            <th class="text-center">{{ trans('labels.vendor_name') }}</th>
            @endif
            <th class="text-center">{{ trans('labels.order_number') }}</th>
            <th class="text-center">{{ trans('labels.no_of_products') }}</th>
            <th class="text-center">{{ trans('labels.customer') }}</th>
            <th class="text-center">{{ trans('labels.order_total') }}</th>
            <th class="text-center">{{ trans('labels.date') }}</th>
            <th class="text-center">{{ trans('labels.action') }}</th>
        </tr>
    </thead>
    <tbody>
        @php $n=0 @endphp
        @foreach($data as $row)
        <tr id="del-{{$row->id}}">
            <td class="text-center">{{++$n}}</td>
            @if(Auth::user()->type == 1)
            <td class="text-center">{{$row['vendors']->name}}</td>
            @endif
            <td class="text-center">{{$row->order_number}}</td>
            <td class="text-center">{{$row->no_products}}</td>
            <td class="text-center">{{$row->full_name}}</td>
            <td class="text-center">{{Helper::CurrencyFormatter($row->grand_total)}}</td>
            <td class="text-center">{{$row->date}}</td>
            <td class="text-center">
                <a href="{{URL::to('admin/orders/order-details/'.$row->order_number)}}" class="success p-0" data-original-title="{{ trans('labels.view') }}" title="{{ trans('labels.view') }}">
                    <span class="badge badge-warning">{{trans('labels.view')}}</span>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="float-right">
    {{$data->links()}}
</div>