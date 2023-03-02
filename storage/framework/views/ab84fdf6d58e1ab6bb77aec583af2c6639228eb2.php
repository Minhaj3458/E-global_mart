<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            <th><?php echo e(trans('labels.category')); ?></th>
            <th><?php echo e(trans('labels.subcategory')); ?></th>
            <th><?php echo e(trans('labels.product_price')); ?></th>
            <th><?php echo e(trans('labels.vendor_name')); ?></th>
            <th><?php echo e(trans('labels.product_name')); ?></th>
            <th><?php echo e(trans('labels.stock')); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php $n=0 ?>
        <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr id="del-<?php echo e($row->id); ?>">
            <td><?php echo e(++$n); ?></td>
            <td><?php echo e($row['category']->category_name); ?></td>
            <td><?php echo e($row['subcategory']->subcategory_name); ?></td>
            <td><?php echo e($row->product_price); ?></td>
            <td>
                <?php echo e($row->user->name); ?>

            </td>
            <td>
                <?php echo e($row->product_name); ?>

            </td>
            <td>
                <?php echo e($row->product_qty); ?>

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
</nav>
<?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/products/admin_product_showtable.blade.php ENDPATH**/ ?>