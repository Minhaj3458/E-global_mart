<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ trans('labels.category') }}</th>
            <th>{{ trans('labels.subcategory') }}</th>
            <th>{{ trans('labels.product_price') }}</th>
            <th>{{ trans('labels.vendor_name') }}</th>
            <th>{{ trans('labels.product_name') }}</th>
            <th>{{ trans('labels.stock') }}</th>
        </tr>
    </thead>
    <tbody>
        @php $n=0 @endphp
        @forelse($data as $row)
        <tr id="del-{{$row->id}}">
            <td>{{++$n}}</td>
            <td>{{$row['category']->category_name}}</td>
            <td>{{$row['subcategory']->subcategory_name}}</td>
            <td>{{$row->product_price}}</td>
            <td>
                {{$row->user->name}}
            </td>
            <td>
                {{$row->product_name}}
            </td>
            <td>
                {{$row->product_qty}}
            </td>
        </tr>
        @empty

        @endforelse
  </tbody>
</table>
<nav aria-label="Page navigation example">
    @if ($data->hasPages())
    <ul class="pagination justify-content-end" role="navigation">
        {{-- Previous Page Link --}}
        @if ($data->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true">&lsaquo;</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $data->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
            </li>
        @endif

        <?php
            $start = $data->currentPage() - 2; // show 3 pagination links before current
            $end = $data->currentPage() + 2; // show 3 pagination links after current
            if($start < 1) {
                $start = 1; // reset start to 1
                $end += 1;
            }
            if($end >= $data->lastPage() ) $end = $data->lastPage(); // reset end to last page
        ?>

        @if($start > 1)
            <li class="page-item">
                <a class="page-link" href="{{ $data->url(1) }}">{{1}}</a>
            </li>
            @if($data->currentPage() != 4)
                {{-- "Three Dots" Separator --}}
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
            @endif
        @endif
            @for ($i = $start; $i <= $end; $i++)
                <li class="page-item {{ ($data->currentPage() == $i) ? ' active' : '' }}">
                    <a class="page-link" href="{{ $data->url($i) }}">{{$i}}</a>
                </li>
            @endfor
        @if($end < $data->lastPage())
            @if($data->currentPage() + 3 != $data->lastPage())
                {{-- "Three Dots" Separator --}}
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
            @endif
            <li class="page-item">
                <a class="page-link" href="{{ $data->url($data->lastPage()) }}">{{$data->lastPage()}}</a>
            </li>
        @endif

        {{-- Next Page Link --}}
        @if ($data->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $data->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true">&rsaquo;</span>
            </li>
        @endif
    </ul>
    @endif
</nav>
