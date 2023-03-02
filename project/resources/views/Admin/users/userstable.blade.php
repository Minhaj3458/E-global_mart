<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>{{ trans('labels.srno') }}</th>
            <th>{{ trans('labels.image') }}</th>
            <th>{{ trans('labels.name') }}</th>
            <th>{{ trans('labels.email') }}</th>
            <th>{{ trans('labels.mobile') }}</th>
            <th>{{ trans('labels.status') }}</th>
        </tr>
    </thead>
    <tbody> 
        @php $n=0 @endphp
        @forelse($data as $row)      
        <tr id="del-{{$row->id}}">
            <td>{{++$n}}</td>
            <td>
                <img src='{{Helper::image_path($row->profile_pic)}}' class='media-object round-media height-50'>
            </td>
            <td>{{$row->name}}</td>
            <td>{{$row->email}}</td>
            <td>{{$row->mobile}}</td>
            <td id="tdstatus{{$row->id}}"> 
                @if($row->is_available=='1') 
                    <span class="btn btn-raised btn-outline-success round btn-min-width mr-1 mb-1 changeStatus" data-status="2" data-id="{{$row->id}}">
                      <span class="green-text">{{ trans('labels.active') }}</span>
                    </span>
                @else 
                    <span class="btn btn-raised btn-outline-danger round btn-min-width mr-1 mb-1 changeStatus" data-status="1" data-id="{{$row->id}}">
                        <span class="red-text">{{ trans('labels.deactive') }}</span>
                    </span>
                @endif
            </td>
        </tr>
        @empty

        @endforelse
  </tbody>
</table>
<div class="float-right">
    {{$data->links()}}
</div>