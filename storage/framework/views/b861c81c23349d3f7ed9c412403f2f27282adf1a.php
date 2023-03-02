<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.brand')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <section id="basic-form-layouts">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-header"><?php echo e(trans('labels.edit_brand')); ?></div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            <?php if(Session::has('danger')): ?>
                            <div class="alert alert-danger">
                                <?php echo e(Session::get('danger')); ?>

                                <?php
                                    Session::forget('danger');
                                ?>
                            </div>
                            <?php endif; ?>
                            <div class="px-3">
                                <form class="form" method="post" action="<?php echo e(route('admin.brand.update')); ?>" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                    <div class="form-body">
                                        <input type="hidden" name="brand_id" id="brand_id" value="<?php echo e($data->id); ?>" class="form-control">
                                        <input type="hidden" name="old_img" id="old_img" value="<?php echo e($data->icon); ?>" class="form-control">
                                        <div class="form-group">
                                            <label for="brand_name"><?php echo e(trans('labels.brand_name')); ?></label>
                                            <input type="text" id="brand_name" class="form-control" name="brand_name" value="<?php echo e($data->brand_name); ?>" placeholder="<?php echo e(trans('placeholder.brand')); ?>">
                                            <?php if($errors->has('brand_name')): ?>
                                                <span class="text-danger"><?php echo e($errors->first('brand_name')); ?></span>
                                            <?php endif; ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="icon"><?php echo e(trans('labels.image')); ?> (140X140)</label>
                                            <input type="file" id="icon" class="form-control" name="icon" >
                                            <?php if($errors->has('icon')): ?>
                                                <span class="text-danger"><?php echo e($errors->first('icon')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <img src='<?php echo e(Helper::image_path($data->icon)); ?>' class='media-object round-media height-50'>
                                    </div>

                                    <div class="form-actions center">
                                        <a href="<?php echo e(route('admin.brand')); ?>" class="btn btn-raised btn-warning mr-1">
                                            <i class="ft-x"></i> <?php echo e(trans('labels.cancel')); ?>

                                        </a>
                                        <?php if(env('Environment') == 'sendbox'): ?>
                                            <button type="button" class="btn btn-raised btn-primary" onclick="myFunction()"> <i class="fa fa-check-square-o"></i> <?php echo e(trans('labels.update')); ?></button>
                                        <?php else: ?>
                                            <button type="submit" id="btn_add_category" class="btn btn-raised btn-primary"> <i class="fa fa-check-square-o"></i> <?php echo e(trans('labels.update')); ?></button>
                                        <?php endif; ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripttop'); ?>
<?php $__env->startSection('script'); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/eglobalm/public_html/resources/views/Admin/brand/show.blade.php ENDPATH**/ ?>