@extends('layouts.admin')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.payout_request') }}
@endsection
@section('css')

@endsection
@section('content')
    <div class="content-wrapper">
        <section id="striped-light">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ trans('labels.payout_request') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="card-block">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ trans('labels.srno') }}</th>
                                            <th>{{ trans('labels.vendor_name') }}</th>
                                            <th>{{ trans('labels.amount') }}</th>
                                            <th>{{ trans('labels.status') }}</th>
                                            <th>{{ trans('labels.type') }}</th>
                                            <th>{{ trans('labels.created_at') }}</th>
                                            @if(Auth::user()->type == 1)
                                                <th>{{ trans('labels.action') }}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $n=0 @endphp
                                        @foreach($data as $row)
                                        <tr>
                                            <td>{{$row->request_id}}</td>
                                            <td>{{$row['vendors']->name}}</td>
                                            <td>
                                                {{ trans('labels.Requested_amount') }} : <b>{{Helper::CurrencyFormatter($row->amount)}}</b> <br>
                                                {{ trans('labels.Admin_commission') }} ({{$row->commission_pr}}%) : - <b>{{Helper::CurrencyFormatter($row->commission)}}</b> <br><br>
                                                {{ trans('labels.Payable_amount') }} : <b>{{Helper::CurrencyFormatter($row->paid_amount)}}</b>
                                            </td>
                                            <td>
                                                @if($row->status == 1)
                                                    <span class="badge badge-warning">{{ trans('labels.pending') }}</span>
                                                @else
                                                    <span class="badge badge-success">{{ trans('labels.paid') }}</span>
                                                @endif
                                            </td>
                                            <td>{{$row->payment_method}}</td>
                                            <td>{{$row->created_at}}</td>
                                            @if(Auth::user()->type == 1)
                                            <td>
                                                @if($row->status == 1)
                                                    <span class="badge badge-info pay-now" data-request-id="{{$row->request_id}}" data-vendor-name="{{$row['vendors']->name}}" data-vendor-id="{{$row['vendors']->id}}" data-amount="{{$row->paid_amount}}" data-bank-name="{{$row['bank']->bank_name}}" data-account-type="{{$row['bank']->account_type}}" data-account-number="{{$row['bank']->account_number}}" data-routing-number="{{$row['bank']->routing_number}}">{{ trans('labels.pay_now') }}</span>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="float-right">
                                    {{$data->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

<!-- Modal PayNow-->
<div class="modal fade text-left" id="PayNow" tabindex="-1" role="dialog" aria-labelledby="RditProduct"
aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <label class="modal-title text-text-bold-600" id="RditProduct">{{ trans('labels.pay') }}</label>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="errorr" style="color: red;"></div>
      
      <form method="post" action="{{ route('admin.payout.update') }}" method="post">
      {{csrf_field()}}
        <div class="modal-body">

            <table class="table table-striped mar-no">
              <tbody>
              <tr>
                  <td>{{ trans('labels.Bank_name') }}</td>
                  <td id="bank_name"></td>
              </tr>
              <tr>
                  <td>{{ trans('labels.Account_type') }}</td>
                  <td id="account_type"></td>
              </tr>
              <tr>
                  <td>{{ trans('labels.Account_number') }}</td>
                  <td id="account_number"></td>
              </tr>
              <tr>
                  <td>{{ trans('labels.Routing_number') }}</td>
                  <td id="routing_number"></td>
              </tr>
              </tbody>
          </table>

          <label># </label>
          <div class="form-group">
            <input type="text" class="form-control" name="request_id" id="request_id" readonly="">
          </div>

          <label>{{ trans('labels.vendor_name') }} </label>
          <div class="form-group">
            <input type="text" class="form-control" name="vendor_name" id="vendor_name" readonly="">
            <input type="hidden" class="form-control" name="vendor_id" id="vendor_id" readonly="">
          </div>

          <label>{{ trans('labels.Payable_amount') }} </label>
          <div class="form-group">
            <input type="text" class="form-control" name="pay_amount" id="pay_amount" readonly="">
          </div>

          <label>{{ trans('labels.payment_methods') }} </label>
          <div class="form-group">
            <select class="form-control" name="payment_method" required>
                <option value="">{{ trans('labels.select_method') }}</option>
                <option value="cash">{{ trans('labels.cash') }}</option>
                <option value="bank">{{ trans('labels.bank_payment') }}</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-raised btn-primary" value="{{ trans('labels.submit') }}">
        </div>
      </form>
    </div>
  </div>
</div>
@section('scripttop')

<script type="text/javascript">
    $(document).ready(function(){
       $(".pay-now").click(function(){ // Click to only happen on announce links

         $("#request_id").val($(this).attr('data-request-id'));
         $("#vendor_name").val($(this).attr('data-vendor-name'));
         $("#vendor_id").val($(this).attr('data-vendor-id'));
         $("#pay_amount").val($(this).attr('data-amount'));
         $("#bank_name").text($(this).attr('data-bank-name'));
         $("#account_type").text($(this).attr('data-account-type'));
         $("#account_number").text($(this).attr('data-account-number'));
         $("#routing_number").text($(this).attr('data-routing-number'));
         $('#PayNow').modal('show');
       });
    });
</script>
@endsection