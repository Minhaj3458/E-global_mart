<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th><?php echo e(trans('labels.srno')); ?></th>
            <th><?php echo e(trans('labels.coupon_name')); ?></th>
            <th><?php echo e(trans('labels.amount')); ?></th>
            <th><?php echo e(trans('labels.quantity')); ?></th>
            <th><?php echo e(trans('labels.start_date')); ?> - <?php echo e(trans('labels.end_date')); ?></th>
            <th><?php echo e(trans('labels.status')); ?></th>
            <th><?php echo e(trans('labels.action')); ?></th>
        </tr>
    </thead>
    <tbody> 
        <?php $n=0 ?>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>      
        <tr id="del-<?php echo e($row->id); ?>">
            <td><?php echo e(++$n); ?></td>
            <td><?php echo e($row->coupon_name); ?></td>
            <td>
                <?php if($row->type == 0): ?>
                    <?php echo e($row->percentage); ?>%
                <?php endif; ?>
                <?php if($row->type == 1): ?>
                    <?php echo e(Helper::CurrencyFormatter($row->amount)); ?>

                <?php endif; ?>
            </td>
            <td>
                <?php if($row->quantity == 0): ?>
                    <?php echo e(trans('labels.unlimited')); ?>

                <?php elseif($row->quantity == 1): ?>
                    <?php echo e($row->times); ?>

                <?php else: ?>
                    -
                <?php endif; ?>
            </td>
            <td><span class="badge badge-info"><?php echo e($row->start_date); ?></span> <span class="badge badge-warning"><?php echo e($row->end_date); ?></span></td>
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
                <a href="<?php echo e(URL::to('admin/coupons/show/'.$row->id)); ?>" class="success p-0 edit" title="<?php echo e(trans('labels.edit')); ?>" title="<?php echo e(trans('labels.edit')); ?>" data-original-title="<?php echo e(trans('labels.edit')); ?>">
                    <i class="ft-edit-2 font-medium-3 mr-2"></i>
                </a>
                <?php if(env('Environment') == 'sendbox'): ?>
                    <a href="javascript:void(0);" class="danger p-0" onclick="myFunction()">
                        <i class="ft-trash font-medium-3"></i>
                    </a>
                <?php else: ?>
                    <a href="javascript:void(0);" class="danger p-0" data-original-title="<?php echo e(trans('labels.delete')); ?>" title="<?php echo e(trans('labels.delete')); ?>" onclick="do_delete('<?php echo e($row->id); ?>','<?php echo e(route('admin.coupons.delete')); ?>','<?php echo e(trans('labels.delete_coupons')); ?>','<?php echo e(trans('labels.delete')); ?>')">
                        <i class="ft-trash font-medium-3"></i>
                    </a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </tbody>
</table>
<div class="float-right">
    <?php echo e($data->links()); ?>

</div><?php /**PATH /home/eglobalm/public_html/resources/views/Admin/coupons/couponstable.blade.php ENDPATH**/ ?>