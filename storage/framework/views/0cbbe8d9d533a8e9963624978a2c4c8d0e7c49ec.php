<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.help')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <section id="striped-light">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><?php echo e(trans('labels.help')); ?></h4>
                        </div>
                        <div class="col-md-4">
                            <form method="GET" action="<?php echo e(route('admin.help.search')); ?>">
                                <div class="input-group">
                                    <input type="text" id="search" name="search" placeholder="Type & Enter" value="<?php echo e(request()->get('search')); ?>" class="form-control round">
                                    <div class="input-group-append">
                                        <button class="input-group-text" id="basic-addon4"><i class="ft-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="card-block">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(trans('labels.username')); ?></th>
                                            <th><?php echo e(trans('labels.contact_info')); ?></th>
                                            <th><?php echo e(trans('labels.subject')); ?></th>
                                            <th><?php echo e(trans('labels.message')); ?></th>
                                            <th><?php echo e(trans('labels.created_at')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $n=0 ?>
                                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($row->first_name); ?> <?php echo e($row->last_name); ?></td>
                                            <td><?php echo e($row->mobile); ?> <br> <?php echo e($row->email); ?> </td>
                                            <td><?php echo e($row->subject); ?></td>
                                            <td><?php echo e($row->message); ?></td>
                                            <td><?php echo e($row->created_at); ?></td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                                <div class="float-right">
                                    <?php echo e($data->links()); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/eglobalm/public_html/resources/views/Admin/help/index.blade.php ENDPATH**/ ?>