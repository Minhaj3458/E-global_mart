<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            <th><?php echo e(trans('labels.name')); ?></th>
            <th><?php echo e(trans('labels.owner_name')); ?></th>
            <th><?php echo e(trans('labels.store_name')); ?></th>
            <th><?php echo e(trans('labels.email')); ?></th>
            <th><?php echo e(trans('labels.number')); ?></th>
            <th><?php echo e(trans('labels.website')); ?></th>
            <th><?php echo e(trans('labels.action')); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php $n=0 ?>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr id="del-<?php echo e($row->id); ?>">
            <td><?php echo e(++$n); ?></td>
            <td><?php echo e($row->name); ?></td>
            <td><?php echo e($row->owner_name); ?></td>
            <td><?php echo e($row->store_name); ?></td>
            <td><?php echo e($row->email); ?></td>
            <td><?php echo e($row->number); ?></td>
            <td><?php echo e($row->website); ?></td>
            <td>
                <a href="<?php echo e(URL::to('admin/supplier/edit/'.$row->id)); ?>" class="success p-0 edit" title="<?php echo e(trans('labels.edit')); ?>" title="<?php echo e(trans('labels.edit')); ?>" data-original-title="<?php echo e(trans('labels.edit')); ?>">
                    <i class="ft-edit-2 font-medium-3 mr-2"></i>
                </a>
                <?php if(env('Environment') == 'sendbox'): ?>
                <a href="javascript:void(0);" class="danger p-0" onclick="myFunction()">
                    <i class="ft-trash font-medium-3"></i>
                </a>
               <?php else: ?>
                <a href="javascript:void(0);" class="danger p-0" data-original-title="<?php echo e(trans('labels.delete')); ?>" title="<?php echo e(trans('labels.delete')); ?>" onclick="do_delete('<?php echo e($row->id); ?>','<?php echo e(route('admin.supplier.delete')); ?>','<?php echo e(trans('labels.delete_category')); ?>','<?php echo e(trans('labels.delete')); ?>')">
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
<?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/supplier/suppliertable.blade.php ENDPATH**/ ?>