<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.subcategory')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <section id="basic-form-layouts">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-header"><?php echo e(trans('labels.edit_subcategory')); ?></div>
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
                                <form class="form" method="post" action="<?php echo e(route('admin.subcategory.update')); ?>">
                                <?php echo csrf_field(); ?>
                                    <div class="form-body">
                                        <input type="hidden" name="subcat_id" id="subcat_id" value="<?php echo e($data->id); ?>" class="form-control">

                                        <div class="form-group">
                                            <label for="cat_id"><?php echo e(trans('labels.category')); ?></label>
                                            <select class="form-control" name="cat_id" id="cat_id">
                                                <option value=""><?php echo e(trans('placeholder.select_category')); ?></option>
                                                <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value='<?php echo e($category->id); ?>' <?php echo e(($data->cat_id == $category->id) ? 'selected' : ''); ?>><?php echo e($category->category_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php $__errorArgs = ['cat_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="subcategory_name"><?php echo e(trans('labels.subcategory_name')); ?></label>
                                            <input type="text" id="subcategory_name" class="form-control" name="subcategory_name" value="<?php echo e($data->subcategory_name); ?>" placeholder="<?php echo e(trans('placeholder.subcategory')); ?>">
                                            <?php $__errorArgs = ['subcategory_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>

                                    <div class="form-actions center">
                                        <a href="<?php echo e(route('admin.subcategory')); ?>" class="btn btn-raised btn-warning mr-1">
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/eglobalm/public_html/resources/views/Admin/subcategory/show.blade.php ENDPATH**/ ?>