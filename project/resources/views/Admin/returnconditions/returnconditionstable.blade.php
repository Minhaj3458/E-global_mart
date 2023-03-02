<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>{{ trans('labels.srno') }}</th>
            <th>{{ trans('labels.returnconditions') }}</th>
            <th>{{ trans('labels.action') }}</th>
        </tr>
    </thead>
    <tbody> 
        @php $n=0 @endphp
        @foreach($data as $row)      
        <tr id="del-{{$row->id}}">
            <td>{{++$n}}</td>
            <td>{{$row->return_conditions}}</td>
            <td>
                <a href="{{URL::to('admin/returnconditions/show/'.$row->id)}}" class="success p-0 edit" title="{{ trans('labels.edit') }}" title="{{ trans('labels.edit') }}" data-original-title="{{ trans('labels.edit') }}">
                    <i class="ft-edit-2 font-medium-3 mr-2"></i>
                </a>
                @if (env('Environment') == 'sendbox')
                    <a href="javascript:void(0);" class="danger p-0" onclick="myFunction()">
                        <i class="ft-trash font-medium-3"></i>
                    </a>
                @else
                    <a href="javascript:void(0);" class="danger p-0" data-original-title="{{ trans('labels.delete') }}" title="{{ trans('labels.delete') }}" onclick="do_delete('{{$row->id}}','{{route('admin.returnconditions.delete')}}','{{ trans('labels.delete_returnconditions') }}','{{ trans('labels.delete') }}')">
                        <i class="ft-trash font-medium-3"></i>
                    </a>
                @endif
            </td>
        </tr>
        @endforeach
  </tbody>
</table>