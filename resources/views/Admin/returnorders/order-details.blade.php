@extends('layouts.admin')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.orders') }}
@endsection
@section('css')

@endsection
@section('content')
    <div class="content-wrapper">
        @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
            @php
                Session::forget('success');
            @endphp
        </div>
        @endif

        @if(Session::has('danger'))
        <div class="alert alert-danger">
            {{ Session::get('danger') }}
            @php
                Session::forget('danger');
            @endphp
        </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <h4>{{trans('labels.return_order')}} # {{$order_info->return_number}}</h4>
            </div>
        </div>
        <section class="invoice-template">
            <div class="card">
                <div class="card-body p-3">
                    <div id="invoice-template" class="card-block">
                        <!-- Invoice Company Details -->
                        <div id="invoice-company-details" class="row">
                            <div class="col-6 text-left">
                                <img src="{{$order_info['vendors']->image_url}}" alt="company logo" class="mb-2" width="70">
                                <ul class="px-0 list-unstyled">
                                    <li>{{$order_info['vendors']->store_address}}</li>
                                </ul>
                            </div>
                            <div class="col-6 text-right">
                                <h2>{{trans('labels.invoice')}}</h2>
                                <p class="pb-3"><a href="{{URL::to('admin/orders/order-details/'.$order_info->order_number)}}"> # {{$order_info->order_number}} </a></p>
                            </div>
                        </div>
                        <!--/ Invoice Company Details -->
                        <!-- Invoice Customer Details -->
                        <div id="invoice-customer-details" class="row pt-2">
                            <div class="col-sm-12 text-left">
                                <p class="text-muted">{{trans('labels.bill_to')}}</p>
                            </div>
                            <div class="col-6 text-left">
                                <ul class="px-0 list-unstyled">
                                    <li class="text-bold-800">{{$order_info->full_name}}</li>
                                    <li class="text-bold-800">{{$order_info->email}}</li>
                                    <li class="text-bold-800">{{$order_info->mobile}}</li>
                                    <li>{{$order_info->street_address}},</li>
                                    <li>{{$order_info->landmark}},</li>
                                    <li>{{$order_info->pincode}}.</li>
                                </ul>
                            </div>
                            <div class="col-6 text-right">
                                <p><span class="text-muted">{{trans('labels.invoice_date')}} :</span> {{$order_info->date}}</p>
                                <p><span class="text-muted">{{trans('labels.return_reason')}} :</span> {{$order_info->return_reason}}</p>
                                @if($order_info->comment != "")
                                <p><span class="text-muted">{{trans('labels.comment')}} :</span> {{$order_info->comment}}</p>
                                @endif
                                <div class="btn-group">
                                    @if(Auth::user()->type == 3)
                                        @if ($order_info->status != 9 && $order_info->status != 10)
                                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                            @if ($order_info->status == 7)
                                                {{trans('labels.accept')}} <span class="caret"></span>
                                            @endif
                                            @if ($order_info->status == 8)
                                                {{trans('labels.in_process')}} <span class="caret"></span>
                                            @endif
                                            @if ($order_info->status == 10)
                                                {{trans('labels.reject')}} <span class="caret"></span>
                                            @endif
                                            
                                        </a>
                                        <ul class="dropdown-menu">
                                            @if ($order_info->status == 7)
                                                <button class="dropdown-item changeStatus active" data-id="{{$order_info->id}}"  data-status="7">{{trans('labels.accept')}}</button>
                                                <button class="dropdown-item changeStatus" data-id="{{$order_info->id}}"  data-status="8">{{trans('labels.in_process')}}</button>
                                                <button class="dropdown-item changeStatus"  data-id="{{$order_info->id}}" data-status="9">{{trans('labels.completed')}}</button>
                                                <button class="dropdown-item reject" data-order-id="{{$order_info->id}}" data-status="10">{{trans('labels.reject')}}</button>
                                            @endif
                                            @if ($order_info->status == 8)
                                                <button class="dropdown-item changeStatus" data-id="{{$order_info->id}}"  data-status="7">{{trans('labels.accept')}}</button>
                                                <button class="dropdown-item changeStatus active" data-id="{{$order_info->id}}"  data-status="8">{{trans('labels.in_process')}}</button>
                                                <button class="dropdown-item changeStatus"  data-id="{{$order_info->id}}" data-status="9">{{trans('labels.completed')}}</button>
                                                <button class="dropdown-item reject" data-order-id="{{$order_info->id}}" data-status="10">{{trans('labels.reject')}}</button>
                                            @endif
                                        </ul>
                                        @endif
                                        @if ($order_info->status == 9)
                                            <button class="btn btn-raised btn-primary">{{trans('labels.completed')}}</button>
                                        @endif

                                        @if ($order_info->status == 10)
                                            <button class="btn btn-raised btn-primary">{{trans('labels.reject')}}</button>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!--/ Invoice Customer Details -->
                        <ul id="progressbar">
                            @if($order_info->status == 7)
                                <li class="step0 text-left active" id="step1">{{trans('labels.return_request')}} <br> {{$order_info->returned_at}}</li>
                                <li class="step0 text-center" id="step2">{{trans('labels.in_process')}}</li>
                                <li class="step0 text-right" id="step3">{{trans('labels.completed')}}</li>
                            @endif
                            @if($order_info->status == 8)
                                <li class="step0 text-left active" id="step1">{{trans('labels.return_request')}} <br> {{$order_info->returned_at}}</li>
                                <li class="step0 text-center active" id="step2">{{trans('labels.in_process')}} <br> {{$order_info->accepted_at}}</li>
                                <li class="step0 text-right" id="step3">{{trans('labels.completed')}}</li>
                            @endif
                            @if($order_info->status == 9)
                                <li class="step0 text-left active" id="step1">{{trans('labels.return_request')}} <br> {{$order_info->returned_at}}</li>
                                <li class="step0 text-center active" id="step2">{{trans('labels.in_process')}} <br> {{$order_info->accepted_at}}</li>
                                <li class="step0 text-right active" id="step3">{{trans('labels.completed')}} <br> {{$order_info->completed_at}}</li>
                            @endif
                            @if($order_info->status == 10)
                                <li class="step0 text-left active" id="step1">{{trans('labels.return_request')}} <br> {{$order_info->returned_at}}</li>
                                <li class="step0 text-center active" id="step2">{{trans('labels.return_rejected')}} <br> {{$order_info->rejected_at}} <br> {{$order_info->vendor_comment}}</li>
                                <li class="step0 text-right" id="step3">{{trans('labels.completed')}}</li>
                            @endif
                        </ul>
                        <!-- Invoice Items Details -->
                        <div id="invoice-items-details" class="pt-2">
                            <div class="row">
                                <div class="table-responsive col-sm-12">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>{{ trans('labels.image') }}</th>
                                                <th>{{ trans('labels.name') }}</th>
                                                <th>{{ trans('labels.price') }}</th>
                                                <th>{{ trans('labels.qty') }}</th>
                                                <th>{{ trans('labels.tax') }}</th>
                                                <th>{{ trans('labels.shipping_charge') }}</th>
                                                <th>{{ trans('labels.order_total') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($order_data as $row)

                                            @if ($row->discount_amount == "")
                                                @php $grand_total = $row->subtotal+$row->tax+$row->shipping_cost; @endphp
                                            @else
                                                @php $grand_total = $row->subtotal+$row->tax+$row->shipping_cost-$row->discount_amount; @endphp
                                            @endif
                                            <tr>
                                                <td><img class="media-object round-media height-50" src="{{$row->image_url}}" alt="Generic placeholder image" /></td>
                                                <td>{{$row->product_name}} @if($row->variation != "")({{$row->variation}}) @endif</td>
                                                <td>{{Helper::CurrencyFormatter($row->price)}}</td>
                                                <td>{{$row->qty}}</td>
                                                <td>{{Helper::CurrencyFormatter($row->tax)}}</td>
                                                <td>{{Helper::CurrencyFormatter($row->shipping_cost)}}</td>
                                                <td>{{Helper::CurrencyFormatter($row->order_total)}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 text-left">
                                    <p class="lead">{{ trans('labels.payment_methods') }}</p>
                                    <div class="row">
                                        <div class="col-12">
                                            <table class="table table-borderless table-sm">
                                                <tbody>
                                                    <tr>
                                                        <!-- payment_type = COD : 1, Wallet : 2, RazorPay : 3, Stripe : 4, Flutterwave : 5 , Paystack : 6-->
                                                        <td>
                                                            @if($order_info->payment_type == 1)
                                                                {{ trans('labels.cod') }}
                                                            @endif

                                                            @if($order_info->payment_type == 2)
                                                                {{ trans('labels.wallet') }}
                                                            @endif

                                                            @if($order_info->payment_type == 3)
                                                                {{ trans('labels.RazorPay') }}
                                                            @endif

                                                            @if($order_info->payment_type == 4)
                                                                {{ trans('labels.Stripe') }}
                                                            @endif

                                                            @if($order_info->payment_type == 5)
                                                                {{ trans('labels.Flutterwave') }}
                                                            @endif

                                                            @if($order_info->payment_type == 6)
                                                                {{ trans('labels.Paystack') }}
                                                            @endif
                                                        </td>
                                                        <td class="text-right">{{$order_info->payment_id}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <p class="lead">{{ trans('labels.Total_due') }}</p>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>{{ trans('labels.sub_total') }}</td>
                                                    <td class="text-right">{{Helper::CurrencyFormatter($order_info->subtotal)}}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ trans('labels.tax') }}</td>
                                                    <td class="text-right">{{Helper::CurrencyFormatter($order_info->tax)}}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ trans('labels.Shipping_charges') }}</td>
                                                    <td class="text-right">{{Helper::CurrencyFormatter($order_info->shipping_cost)}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold-800">{{ trans('labels.total') }}</td>
                                                    <td class="text-bold-800 text-right">{{Helper::CurrencyFormatter($order_info->grand_total)}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Invoice Footer -->
                        <div id="invoice-footer mt-3">
                            <div class="row">
                                <div class="col-md-9 col-sm-12">
                                    <p>* After successful return of this item, amount will be credited to user wallet</p>
                                </div>
                            </div>
                        </div>
                        <!--/ Invoice Footer -->
                    </div>
                </div>
            </div>
        </section>
    </div>


@endsection
@section('scripttop')

<!-- Modal -->
<div id="RejectReturn" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-left">{{trans('labels.write_reason')}}</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <input type="hidden" name="order_id" id="data-order-id">
            <input type="hidden" name="status" id="data-status">
            <label for="vendor_comment" class="col-form-label">{{trans('labels.reason')}}</label>
            <textarea class="form-control" id="vendor_comment" name="vendor_comment"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('labels.close')}}</button>
        <button type="button" class="btn btn-primary" onclick="StatusUpdate()">{{trans('labels.save')}}</button>
      </div>
    </div>

  </div>
</div>

@endsection
@section('script')
<script type="text/javascript">    
    //Change Status
    $('body').on('click','.changeStatus',function() {
        let status=$(this).attr('data-status');
        let id=$(this).attr('data-id');
        
        Swal.fire({
            title: '{{ trans('labels.are_you_sure') }}',
            text: "{{ trans('labels.change_status') }}",
            type: 'error',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '{{ trans('labels.yes') }}',
            cancelButtonText: '{{ trans('labels.no') }}'
        }).then((t) => {
            if(t.value==true){
                $('#preloader').show();
                $.ajax({
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{route("admin.returnorders.changeStatus")}}',
                    type: "POST",
                    data : {'id':id,'status':status},
                    success:function(data)
                    { 
                        $('#preloader').hide();
                        location.reload();
                    },error:function(data){
                        $('#preloader').hide();
                        console.log("AJAX error in request: " + JSON.stringify(data, null, 2));
                    }
                });
            }
            else
            {
                Swal.fire({type: 'error',title: '{{ trans('labels.cancelled') }}',showConfirmButton: false,timer: 1500});
            }
        });
    });

    function StatusUpdate() {
        let id=$('#data-order-id').val();
        let status=$('#data-status').val();
        let vendor_comment=$('#vendor_comment').val();
        
        $('#preloader').show();
        $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{route("admin.returnorders.changeStatus")}}',
            type: "POST",
            data : {'id':id,'status':status,'vendor_comment':vendor_comment},
            success:function(data)
            { 
                $('#preloader').hide();
                location.reload();
            },error:function(data){
                $('#preloader').hide();
                console.log("AJAX error in request: " + JSON.stringify(data, null, 2));
            }
        });
    }

    $(document).ready(function(){
       $(".reject").click(function(){ // Click to only happen on announce links

         $("#data-order-id").val($(this).attr('data-order-id'));
         $("#data-status").val($(this).attr('data-status'));
         $('#RejectReturn').modal('show');
       });
    });
</script>
@endsection