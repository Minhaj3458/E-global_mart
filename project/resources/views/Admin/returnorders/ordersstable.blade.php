<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            @if(Auth::user()->type == 1)
            <th class="text-center">{{ trans('labels.vendor_name') }}</th>
            @endif
            <th>{{ trans('labels.return_number') }}</th>
            <th>{{ trans('labels.customer') }}</th>
            <th>{{ trans('labels.product_details') }}</th>
            <th>{{ trans('labels.date') }}</th>
            <th>{{ trans('labels.action') }}</th>
        </tr>
    </thead>
    <tbody>
        @php $n=0 @endphp
        @foreach($data as $row)
        <tr id="del-{{$row->id}}">
            <td>{{++$n}}</td>
            @if(Auth::user()->type == 1)
            <td class="text-center">{{$row['vendors']->name}}</td>
            @endif
            <td>{{$row->return_number}}</td>
            <td>
                {{$row->full_name}}<br>
                {{$row->mobile}}<br>
                {{$row->email}}
            </td>
            <td>
                {{$row->product_name}}<br>
                {{Helper::CurrencyFormatter($row->order_total)}}
            </td>
            <td>{{$row->date}}</td>
            <td>
                <a href="{{URL::to('admin/returnorders/order-details/'.$row->return_number)}}" class="success p-0" data-original-title="{{ trans('labels.view') }}" title="{{ trans('labels.view') }}">
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