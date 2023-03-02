<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            <?php if(Auth::user()->type == 1): ?>
            <th class="text-center"><?php echo e(trans('labels.vendor_name')); ?></th>
            <?php endif; ?>
            <th><?php echo e(trans('labels.return_number')); ?></th>
            <th><?php echo e(trans('labels.customer')); ?></th>
            <th><?php echo e(trans('labels.product_details')); ?></th>
            <th><?php echo e(trans('labels.date')); ?></th>
            <th><?php echo e(trans('labels.action')); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php $n=0 ?>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr id="del-<?php echo e($row->id); ?>">
            <td><?php echo e(++$n); ?></td>
            <?php if(Auth::user()->type == 1): ?>
            <td class="text-center"><?php echo e($row['vendors']->name); ?></td>
            <?php endif; ?>
            <td><?php echo e($row->return_number); ?></td>
            <td>
                <?php echo e($row->full_name); ?><br>
                <?php echo e($row->mobile); ?><br>
                <?php echo e($row->email); ?>

            </td>
            <td>
                <?php echo e($row->product_name); ?><br>
                <?php echo e(Helper::CurrencyFormatter($row->order_total)); ?>

            </td>
            <td><?php echo e($row->date); ?></td>
            <td>
                <a href="<?php echo e(URL::to('admin/returnorders/order-details/'.$row->return_number)); ?>" class="success p-0" data-original-title="<?php echo e(trans('labels.view')); ?>" title="<?php echo e(trans('labels.view')); ?>">
                    <span class="badge badge-warning"><?php echo e(trans('labels.view')); ?></span>
                </a>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<div class="float-right">
    <?php echo e($data->links()); ?>

</div><?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/returnorders/ordersstable.blade.php ENDPATH**/ ?>