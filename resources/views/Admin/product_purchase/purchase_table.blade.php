<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ trans('labels.supplier_name')}}</th>
            <th>{{ trans('labels.store_name') }}</th>
            <th>{{ trans('labels.product_name') }}</th>
            <th>{{ trans('labels.quantity_sup') }}</th>
            <th>{{ trans('labels.price_sup') }}</th>
            <th>{{ trans('labels.action') }}</th>
        </tr>
    </thead>
    <tbody>
        {{-- @php $n=0 @endphp
        @foreach($data as $row)
        <tr id="del-{{$row->id}}">
            <td>{{++$n}}</td>
            <td>{{$row->name}}</td>
            <td>{{$row->owner_name}}</td>
            <td>{{$row->store_name}}</td>
            <td>{{$row->email}}</td>
            <td>{{$row->number}}</td>
            <td>{{$row->website}}</td>
            <td>
                <a href="{{URL::to('admin/supplier/edit/'.$row->id)}}" class="success p-0 edit" title="{{ trans('labels.edit') }}" title="{{ trans('labels.edit') }}" data-original-title="{{ trans('labels.edit') }}">
                    <i class="ft-edit-2 font-medium-3 mr-2"></i>
                </a>
                @if (env('Environment') == 'sendbox')
                <a href="javascript:void(0);" class="danger p-0" onclick="myFunction()">
                    <i class="ft-trash font-medium-3"></i>
                </a>
               @else
                <a href="javascript:void(0);" class="danger p-0" data-original-title="{{ trans('labels.delete') }}" title="{{ trans('labels.delete') }}" onclick="do_delete('{{$row->id}}','{{route('admin.supplier.delete')}}','{{ trans('labels.delete_category') }}','{{ trans('labels.delete') }}')">
                    <i class="ft-trash font-medium-3"></i>
                </a>
               @endif
            </td>
        </tr>
        @endforeach --}}
  </tbody>
</table>
<div class="float-right">
    {{-- {{$data->links()}} --}}
</div>
