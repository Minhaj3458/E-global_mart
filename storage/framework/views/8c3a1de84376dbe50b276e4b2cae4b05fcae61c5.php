<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            <th><?php echo e(trans('labels.image')); ?></th>
            <th><?php echo e(trans('labels.link')); ?></th>
            <th><?php echo e(trans('labels.status')); ?></th>
            <th><?php echo e(trans('labels.action')); ?></th>
        </tr>
    </thead>
    <tbody> 
        <?php $n=0 ?>
        <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>      
        <tr id="del-<?php echo e($row->id); ?>">
            <td><?php echo e(++$n); ?></td>
            <td><img src='<?php echo e(Helper::image_path($row->image)); ?>' class='media-object round-media height-150'></td>
            <td><a href="<?php echo e($row->link); ?>" target="_blank"><?php echo e(trans('labels.link')); ?></a></td>
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
                <a href="<?php echo e(URL::to('admin/slider/show/'.$row->id)); ?>" class="success p-0 edit" title="<?php echo e(trans('labels.edit')); ?>" title="<?php echo e(trans('labels.edit')); ?>" data-original-title="<?php echo e(trans('labels.edit')); ?>">
                    <i class="ft-edit-2 font-medium-3 mr-2"></i>
                </a>
                <?php if(env('Environment') == 'sendbox'): ?>
                    <a href="javascript:void(0);" class="danger p-0" onclick="myFunction()">
                        <i class="ft-trash font-medium-3"></i>
                    </a>
                <?php else: ?>
                    <a href="javascript:void(0);" class="danger p-0" data-original-title="<?php echo e(trans('labels.delete')); ?>" title="<?php echo e(trans('labels.delete')); ?>" onclick="do_delete('<?php echo e($row->id); ?>','<?php echo e(route('admin.slider.delete')); ?>','<?php echo e(trans('labels.delete_slider')); ?>','<?php echo e(trans('labels.delete')); ?>')">
                        <i class="ft-trash font-medium-3"></i>
                    </a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

        <?php endif; ?>
  </tbody>
</table><?php /**PATH /home/eglobalm/public_html/resources/views/Admin/slider/slidertable.blade.php ENDPATH**/ ?>