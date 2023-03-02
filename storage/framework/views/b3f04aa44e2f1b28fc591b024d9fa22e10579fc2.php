<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.payout_request')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <section id="striped-light">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><?php echo e(trans('labels.payout_request')); ?></h4>
                        </div>
                        <div class="card-body">
                            <div class="card-block">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(trans('labels.srno')); ?></th>
                                            <th><?php echo e(trans('labels.vendor_name')); ?></th>
                                            <th><?php echo e(trans('labels.amount')); ?></th>
                                            <th><?php echo e(trans('labels.status')); ?></th>
                                            <th><?php echo e(trans('labels.type')); ?></th>
                                            <th><?php echo e(trans('labels.created_at')); ?></th>
                                            <?php if(Auth::user()->type == 1): ?>
                                                <th><?php echo e(trans('labels.action')); ?></th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $n=0 ?>
                                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($row->request_id); ?></td>
                                            <td><?php echo e($row['vendors']->name); ?></td>
                                            <td>
                                                <?php echo e(trans('labels.Requested_amount')); ?> : <b><?php echo e(Helper::CurrencyFormatter($row->amount)); ?></b> <br>
                                                <?php echo e(trans('labels.Admin_commission')); ?> (<?php echo e($row->commission_pr); ?>%) : - <b><?php echo e(Helper::CurrencyFormatter($row->commission)); ?></b> <br><br>
                                                <?php echo e(trans('labels.Payable_amount')); ?> : <b><?php echo e(Helper::CurrencyFormatter($row->paid_amount)); ?></b>
                                            </td>
                                            <td>
                                                <?php if($row->status == 1): ?>
                                                    <span class="badge badge-warning"><?php echo e(trans('labels.pending')); ?></span>
                                                <?php else: ?>
                                                    <span class="badge badge-success"><?php echo e(trans('labels.paid')); ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e($row->payment_method); ?></td>
                                            <td><?php echo e($row->created_at); ?></td>
                                            <?php if(Auth::user()->type == 1): ?>
                                            <td>
                                                <?php if($row->status == 1): ?>
                                                    <span class="badge badge-info pay-now" data-request-id="<?php echo e($row->request_id); ?>" data-vendor-name="<?php echo e($row['vendors']->name); ?>" data-vendor-id="<?php echo e($row['vendors']->id); ?>" data-amount="<?php echo e($row->paid_amount); ?>" data-bank-name="<?php echo e($row['bank']->bank_name); ?>" data-account-type="<?php echo e($row['bank']->account_type); ?>" data-account-number="<?php echo e($row['bank']->account_number); ?>" data-routing-number="<?php echo e($row['bank']->routing_number); ?>"><?php echo e(trans('labels.pay_now')); ?></span>
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            </td>
                                            <?php endif; ?>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                                <div class="float-right">
                                    <?php echo e($data->links()); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<!-- Modal PayNow-->
<div class="modal fade text-left" id="PayNow" tabindex="-1" role="dialog" aria-labelledby="RditProduct"
aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <label class="modal-title text-text-bold-600" id="RditProduct"><?php echo e(trans('labels.pay')); ?></label>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="errorr" style="color: red;"></div>
      
      <form method="post" action="<?php echo e(route('admin.payout.update')); ?>" method="post">
      <?php echo e(csrf_field()); ?>

        <div class="modal-body">

            <table class="table table-striped mar-no">
              <tbody>
              <tr>
                  <td><?php echo e(trans('labels.Bank_name')); ?></td>
                  <td id="bank_name"></td>
              </tr>
              <tr>
                  <td><?php echo e(trans('labels.Account_type')); ?></td>
                  <td id="account_type"></td>
              </tr>
              <tr>
                  <td><?php echo e(trans('labels.Account_number')); ?></td>
                  <td id="account_number"></td>
              </tr>
              <tr>
                  <td><?php echo e(trans('labels.Routing_number')); ?></td>
                  <td id="routing_number"></td>
              </tr>
              </tbody>
          </table>

          <label># </label>
          <div class="form-group">
            <input type="text" class="form-control" name="request_id" id="request_id" readonly="">
          </div>

          <label><?php echo e(trans('labels.vendor_name')); ?> </label>
          <div class="form-group">
            <input type="text" class="form-control" name="vendor_name" id="vendor_name" readonly="">
            <input type="hidden" class="form-control" name="vendor_id" id="vendor_id" readonly="">
          </div>

          <label><?php echo e(trans('labels.Payable_amount')); ?> </label>
          <div class="form-group">
            <input type="text" class="form-control" name="pay_amount" id="pay_amount" readonly="">
          </div>

          <label><?php echo e(trans('labels.payment_methods')); ?> </label>
          <div class="form-group">
            <select class="form-control" name="payment_method" required>
                <option value=""><?php echo e(trans('labels.select_method')); ?></option>
                <option value="cash"><?php echo e(trans('labels.cash')); ?></option>
                <option value="bank"><?php echo e(trans('labels.bank_payment')); ?></option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-raised btn-primary" value="<?php echo e(trans('labels.submit')); ?>">
        </div>
      </form>
    </div>
  </div>
</div>
<?php $__env->startSection('scripttop'); ?>

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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/payout/index.blade.php ENDPATH**/ ?>