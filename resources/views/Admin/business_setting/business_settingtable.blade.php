<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ trans('labels.lavel')}}</th>
            <th>{{ trans('labels.amount') }}</th>
            <th>{{ trans('labels.action') }}</th>
        </tr>
    </thead>
    <tbody>
        @php $n=0 @endphp
        @foreach($data as $row)
        <tr id="del-{{$row->id}}">
            <td>{{++$n}}</td>
            <td>{{$row->level}}</td>
            <td>{{$row->amount}}</td>
            <td>
                <a href="{{URL::to('admin/business_setting/edit/'.$row->id)}}" class="success p-0 edit" title="{{ trans('labels.edit') }}" title="{{ trans('labels.edit') }}" data-original-title="{{ trans('labels.edit') }}">
                    <i class="ft-edit-2 font-medium-3 mr-2"></i>
                </a>
            </td>
        </tr>
        @endforeach
  </tbody>
</table>
<div class="float-right">
    {{$data->links()}}
</div>
