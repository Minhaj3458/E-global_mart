<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>{{ trans('labels.srno')}}</th>
            <th>{{ trans('labels.coupon_name') }}</th>
            <th>{{ trans('labels.amount') }}</th>
            <th>{{ trans('labels.quantity') }}</th>
            <th>{{ trans('labels.start_date') }} - {{ trans('labels.end_date') }}</th>
            <th>{{ trans('labels.status') }}</th>
            <th>{{ trans('labels.action') }}</th>
        </tr>
    </thead>
    <tbody> 
        @php $n=0 @endphp
        @foreach($data as $row)      
        <tr id="del-{{$row->id}}">
            <td>{{++$n}}</td>
            <td>{{$row->coupon_name}}</td>
            <td>
                @if($row->type == 0)
                    {{$row->percentage}}%
                @endif
                @if($row->type == 1)
                    {{Helper::CurrencyFormatter($row->amount)}}
                @endif
            </td>
            <td>
                @if($row->quantity == 0)
                    {{trans('labels.unlimited')}}
                @elseif($row->quantity == 1)
                    {{$row->times}}
                @else
                    -
                @endif
            </td>
            <td><span class="badge badge-info">{{$row->start_date}}</span> <span class="badge badge-warning">{{$row->end_date}}</span></td>
            <td id="tdstatus{{$row->id}}">
                @if (env('Environment') == 'sendbox')
                    @if($row->status=='1') 
                        <span class="btn btn-raised btn-outline-success round btn-min-width mr-1 mb-1" onclick="myFunction()">
                        <span class="green-text">{{ trans('labels.active') }}</span>
                        </span>
                    @else 
                        <span class="btn btn-raised btn-outline-danger round btn-min-width mr-1 mb-1" onclick="myFunction()">
                            <span class="red-text">{{ trans('labels.deactive') }}</span>
                        </span>
                    @endif
                @else
                    @if($row->status=='1') 
                        <span class="btn btn-raised btn-outline-success round btn-min-width mr-1 mb-1 changeStatus" data-status="2" data-id="{{$row->id}}">
                        <span class="green-text">{{ trans('labels.active') }}</span>
                        </span>
                    @else 
                        <span class="btn btn-raised btn-outline-danger round btn-min-width mr-1 mb-1 changeStatus" data-status="1" data-id="{{$row->id}}">
                            <span class="red-text">{{ trans('labels.deactive') }}</span>
                        </span>
                    @endif
                @endif
            </td>
            <td>
                <a href="{{URL::to('admin/coupons/show/'.$row->id)}}" class="success p-0 edit" title="{{ trans('labels.edit') }}" title="{{ trans('labels.edit') }}" data-original-title="{{ trans('labels.edit') }}">
                    <i class="ft-edit-2 font-medium-3 mr-2"></i>
                </a>
                @if (env('Environment') == 'sendbox')
                    <a href="javascript:void(0);" class="danger p-0" onclick="myFunction()">
                        <i class="ft-trash font-medium-3"></i>
                    </a>
                @else
                    <a href="javascript:void(0);" class="danger p-0" data-original-title="{{ trans('labels.delete') }}" title="{{ trans('labels.delete') }}" onclick="do_delete('{{$row->id}}','{{route('admin.coupons.delete')}}','{{ trans('labels.delete_coupons') }}','{{ trans('labels.delete') }}')">
                        <i class="ft-trash font-medium-3"></i>
                    </a>
                @endif
            </td>
        </tr>
        @endforeach
  </tbody>
</table>
<div class="float-right">
    {{$data->links()}}
</div>