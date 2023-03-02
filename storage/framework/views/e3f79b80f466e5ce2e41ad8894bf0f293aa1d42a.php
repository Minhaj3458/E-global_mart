<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th><?php echo e(trans('labels.srno')); ?></th>
            <th><?php echo e(trans('labels.name')); ?></th>
            <th><?php echo e(trans('labels.status')); ?></th>
            <th><?php echo e(trans('labels.action')); ?></th>
        </tr>
    </thead>
    <tbody> 
        <?php $n=0 ?>
        <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>      
        <tr id="del-<?php echo e($row->id); ?>">
            <td><?php echo e(++$n); ?></td>
            <td><?php echo e($row->payment_name); ?></td>
            <td id="tdstatus<?php echo e($row->id); ?>"> 
                <?php if(env('Environment') == 'sendbox'): ?>
                    <?php if($row->status=='1'): ?> 
                        <span class="btn btn-raised btn-outline-success round btn-min-width mr-1 mb-1" onclick="myFunction()">
                        <span class="green-text"><?php echo e(trans('labels.active')); ?></span>
                        </span>
                    <?php else: ?> 
                        <span class="btn btn-raised btn-outline-danger round btn-min-width mr-1 mb-1" onclick="myFunction()">
                            <span class="red-text"><?php echo e(trans('labels.deactive')); ?></span>
                        </span>
                    <?php endif; ?>
                <?php else: ?>
                    <?php if($row->status=='1'): ?> 
                        <span class="btn btn-raised btn-outline-success round btn-min-width mr-1 mb-1 changeStatus" data-status="2" data-id="<?php echo e($row->id); ?>">
                        <span class="green-text"><?php echo e(trans('labels.active')); ?></span>
                        </span>
                    <?php else: ?> 
                        <span class="btn btn-raised btn-outline-danger round btn-min-width mr-1 mb-1 changeStatus" data-status="1" data-id="<?php echo e($row->id); ?>">
                            <span class="red-text"><?php echo e(trans('labels.deactive')); ?></span>
                        </span>
                    <?php endif; ?>
                <?php endif; ?>
            </td>
            <td>
                <?php if($row->payment_name != 'COD' && $row->payment_name != 'Wallet'): ?>
                    <a href="<?php echo e(URL::to('admin/payments/manage-payment/'.$row->id)); ?>" class="success p-0" data-original-title="<?php echo e(trans('labels.view')); ?>" title="<?php echo e(trans('labels.view')); ?>">
                        <span class="badge badge-warning"><?php echo e(trans('labels.view')); ?></span>
                    </a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

        <?php endif; ?>
  </tbody>
</table><?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/payment/paymenttable.blade.php ENDPATH**/ ?>