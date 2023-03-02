<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            
            <th><?php echo e(trans('labels.user_name')); ?></th>
            <th><?php echo e(trans('labels.user_email')); ?></th>
            <th><?php echo e(trans('labels.user_number')); ?></th>
            <th><?php echo e(trans('labels.stock_name')); ?></th>
            <th><?php echo e(trans('labels.address')); ?></th>
            
            <th><?php echo e(trans('labels.action')); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php $n=0 ?>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr id="del-<?php echo e($row->id); ?>">
            <td><?php echo e(++$n); ?></td>
            
            <td><?php echo e($row->user->name); ?></td>
            <td><?php echo e($row->user->email); ?></td>
            <td><?php echo e($row->user->mobile); ?></td>
            <td><?php echo e($row->stock_name); ?></td>
            <td><?php echo e($row->address); ?></td>
            
            <td>
                <a href="<?php echo e(URL::to('admin/stockiest/edit/'.$row->id)); ?>" class="success p-0 edit" title="<?php echo e(trans('labels.edit')); ?>" title="<?php echo e(trans('labels.edit')); ?>" data-original-title="<?php echo e(trans('labels.edit')); ?>">
                    <i class="ft-edit-2 font-medium-3 mr-2"></i>
                </a>
                <?php if(env('Environment') == 'sendbox'): ?>
                <a href="javascript:void(0);" class="danger p-0" onclick="myFunction()">
                    <i class="ft-trash font-medium-3"></i>
                </a>
                <?php else: ?>
                <a href="javascript:void(0);" class="danger p-0" data-original-title="<?php echo e(trans('labels.delete')); ?>" title="<?php echo e(trans('labels.delete')); ?>" onclick="do_delete('<?php echo e($row->id); ?>','<?php echo e(route('admin.stockiest.delete',$row->id)); ?>','<?php echo e(trans('labels.delete_stock')); ?>','<?php echo e(trans('labels.delete')); ?>')">
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

</div>
<?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/stockiest/stockiest_table.blade.php ENDPATH**/ ?>