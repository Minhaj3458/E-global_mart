<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            <th><?php echo e(trans('labels.image')); ?></th>
            <th><?php echo e(trans('labels.type')); ?></th>
            <th><?php echo e(trans('labels.category')); ?></th>
            <th><?php echo e(trans('labels.product')); ?></th>
            <th><?php echo e(trans('labels.action')); ?></th>
        </tr>
    </thead>
    <tbody> 
        <?php $n=0 ?>
        <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>      
        <tr id="del-<?php echo e($row->id); ?>">
            <td><?php echo e(++$n); ?></td>
            <td><img src='<?php echo e(Helper::image_path($row->image)); ?>' class='media-object round-media height-50'></td>
            <td><?php echo e($row->type); ?></td>
            <td>
                <?php if($row->type == "category"): ?>
                    <?php echo e(@$row['category']->category_name); ?>

                <?php else: ?>
                    --
                <?php endif; ?>
            </td>
            <td>
                <?php if($row->type == "product"): ?>
                    <?php echo e(@$row['product']->product_name); ?>

                <?php else: ?>
                    --
                <?php endif; ?>
            </td>
            <td>
                <a href="<?php echo e(URL::to('admin/banner/show/'.$row->id)); ?>" class="success p-0 edit" title="<?php echo e(trans('labels.edit')); ?>" title="<?php echo e(trans('labels.edit')); ?>" data-original-title="<?php echo e(trans('labels.edit')); ?>">
                    <i class="ft-edit-2 font-medium-3 mr-2"></i>
                </a>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

        <?php endif; ?>
  </tbody>
</table><?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/banner/bannertable.blade.php ENDPATH**/ ?>