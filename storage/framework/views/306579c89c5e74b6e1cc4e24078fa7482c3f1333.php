<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            <th><?php echo e(trans('labels.attribute')); ?></th>
            <th><?php echo e(trans('labels.status')); ?></th>
            <th><?php echo e(trans('labels.action')); ?></th>
        </tr>
    </thead>
    <tbody> 
        <?php $n=0 ?>
        <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>      
        <tr id="del-<?php echo e($row->id); ?>">
            <td><?php echo e(++$n); ?></td>
            <td><?php echo e($row->attribute); ?></td>
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
                <a href="<?php echo e(URL::to('admin/attribute/show/'.$row->id)); ?>" class="success p-0 edit" title="<?php echo e(trans('labels.edit')); ?>" title="<?php echo e(trans('labels.edit')); ?>" data-original-title="<?php echo e(trans('labels.edit')); ?>">
                    <i class="ft-edit-2 font-medium-3 mr-2"></i>
                </a>
                <?php if(env('Environment') == 'sendbox'): ?>
                    <a href="javascript:void(0);" class="danger p-0" onclick="myFunction()">
                        <i class="ft-trash font-medium-3"></i>
                    </a>
                <?php else: ?>
                    <a href="javascript:void(0);" class="danger p-0" data-original-title="<?php echo e(trans('labels.delete')); ?>" title="<?php echo e(trans('labels.delete')); ?>" onclick="do_delete('<?php echo e($row->id); ?>','<?php echo e(route('admin.attribute.delete')); ?>','<?php echo e(trans('labels.delete_attribute')); ?>','<?php echo e(trans('labels.delete')); ?>')">
                        <i class="ft-trash font-medium-3"></i>
                    </a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

        <?php endif; ?>
  </tbody>
</table>
<nav aria-label="Page navigation example">
    <?php if($data->hasPages()): ?>
    <ul class="pagination justify-content-end" role="navigation">
        
        <?php if($data->onFirstPage()): ?>
            <li class="page-item disabled" aria-disabled="true" aria-label="<?php echo app('translator')->get('pagination.previous'); ?>">
                <span class="page-link" aria-hidden="true">&lsaquo;</span>
            </li>
        <?php else: ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo e($data->previousPageUrl()); ?>" rel="prev" aria-label="<?php echo app('translator')->get('pagination.previous'); ?>">&lsaquo;</a>
            </li>
        <?php endif; ?>

        <?php
            $start = $data->currentPage() - 2; // show 3 pagination links before current
            $end = $data->currentPage() + 2; // show 3 pagination links after current
            if($start < 1) {
                $start = 1; // reset start to 1
                $end += 1;
            } 
            if($end >= $data->lastPage() ) $end = $data->lastPage(); // reset end to last page
        ?>

        <?php if($start > 1): ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo e($data->url(1)); ?>"><?php echo e(1); ?></a>
            </li>
            <?php if($data->currentPage() != 4): ?>
                
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
            <?php endif; ?>
        <?php endif; ?>
            <?php for($i = $start; $i <= $end; $i++): ?>
                <li class="page-item <?php echo e(($data->currentPage() == $i) ? ' active' : ''); ?>">
                    <a class="page-link" href="<?php echo e($data->url($i)); ?>"><?php echo e($i); ?></a>
                </li>
            <?php endfor; ?>
        <?php if($end < $data->lastPage()): ?>
            <?php if($data->currentPage() + 3 != $data->lastPage()): ?>
                
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
            <?php endif; ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo e($data->url($data->lastPage())); ?>"><?php echo e($data->lastPage()); ?></a>
            </li>
        <?php endif; ?>

        
        <?php if($data->hasMorePages()): ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo e($data->nextPageUrl()); ?>" rel="next" aria-label="<?php echo app('translator')->get('pagination.next'); ?>">&rsaquo;</a>
            </li>
        <?php else: ?>
            <li class="page-item disabled" aria-disabled="true" aria-label="<?php echo app('translator')->get('pagination.next'); ?>">
                <span class="page-link" aria-hidden="true">&rsaquo;</span>
            </li>
        <?php endif; ?>
    </ul>
    <?php endif; ?>
</nav><?php /**PATH /home/eglobalm/public_html/resources/views/Admin/attribute/attributetable.blade.php ENDPATH**/ ?>