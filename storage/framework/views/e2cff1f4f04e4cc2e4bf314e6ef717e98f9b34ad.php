<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th><?php echo e(trans('labels.srno')); ?></th>
            <th><?php echo e(trans('labels.image')); ?></th>
            <th><?php echo e(trans('labels.name')); ?></th>
            <th><?php echo e(trans('labels.email')); ?></th>
            <th><?php echo e(trans('labels.mobile')); ?></th>
            <th><?php echo e(trans('labels.status')); ?></th>
        </tr>
    </thead>
    <tbody> 
        <?php $n=0 ?>
        <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>      
        <tr id="del-<?php echo e($row->id); ?>">
            <td><?php echo e(++$n); ?></td>
            <td>
                <img src='<?php echo e(Helper::image_path($row->profile_pic)); ?>' class='media-object round-media height-50'>
            </td>
            <td><?php echo e($row->name); ?></td>
            <td><?php echo e($row->email); ?></td>
            <td><?php echo e($row->mobile); ?></td>
            <td id="tdstatus<?php echo e($row->id); ?>"> 
                <?php if($row->is_available=='1'): ?> 
                    <span class="btn btn-raised btn-outline-success round btn-min-width mr-1 mb-1 changeStatus" data-status="2" data-id="<?php echo e($row->id); ?>">
                      <span class="green-text"><?php echo e(trans('labels.active')); ?></span>
                    </span>
                <?php else: ?> 
                    <span class="btn btn-raised btn-outline-danger round btn-min-width mr-1 mb-1 changeStatus" data-status="1" data-id="<?php echo e($row->id); ?>">
                        <span class="red-text"><?php echo e(trans('labels.deactive')); ?></span>
                    </span>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

        <?php endif; ?>
  </tbody>
</table>
<div class="float-right">
    <?php echo e($data->links()); ?>

</div><?php /**PATH /home/eglobalm/public_html/resources/views/Admin/users/userstable.blade.php ENDPATH**/ ?>