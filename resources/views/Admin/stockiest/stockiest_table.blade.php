<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            {{-- <th>{{ trans('labels.user_id')}}</th> --}}
            <th>{{ trans('labels.user_name')}}</th>
            <th>{{ trans('labels.user_email')}}</th>
            <th>{{ trans('labels.user_number')}}</th>
            <th>{{ trans('labels.stock_name') }}</th>
            <th>{{ trans('labels.address') }}</th>
            {{-- <th>{{ trans('labels.add_date') }}</th> --}}
            <th>{{ trans('labels.action') }}</th>
        </tr>
    </thead>
    <tbody>
        @php $n=0 @endphp
        @foreach($data as $row)
        <tr id="del-{{$row->id}}">
            <td>{{++$n}}</td>
            {{-- <td>{{$row->user_id}}</td> --}}
            <td>{{$row->user->name}}</td>
            <td>{{$row->user->email}}</td>
            <td>{{$row->user->mobile}}</td>
            <td>{{$row->stock_name}}</td>
            <td>{{$row->address}}</td>
            {{-- <th>{{$row->created_at->format('Y-m-d ')}}</th> --}}
            <td>
                <a href="{{URL::to('admin/stockiest/edit/'.$row->id)}}" class="success p-0 edit" title="{{ trans('labels.edit') }}" title="{{ trans('labels.edit') }}" data-original-title="{{ trans('labels.edit') }}">
                    <i class="ft-edit-2 font-medium-3 mr-2"></i>
                </a>
                @if (env('Environment') == 'sendbox')
                <a href="javascript:void(0);" class="danger p-0" onclick="myFunction()">
                    <i class="ft-trash font-medium-3"></i>
                </a>
                @else
                <a href="javascript:void(0);" class="danger p-0" data-original-title="{{ trans('labels.delete') }}" title="{{ trans('labels.delete') }}" onclick="do_delete('{{$row->id}}','{{route('admin.stockiest.delete',$row->id)}}','{{ trans('labels.delete_stock') }}','{{ trans('labels.delete') }}')">
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
