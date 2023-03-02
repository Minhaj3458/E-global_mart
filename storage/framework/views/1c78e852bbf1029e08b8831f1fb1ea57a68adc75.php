<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.terms_conditions')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <section id="basic-form-layouts">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-header"><?php echo e(trans('labels.terms_conditions')); ?></div>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-12">
                    <?php if(Session::has('success')): ?>
                    <div class="alert alert-success">
                        <?php echo e(Session::get('success')); ?>

                        <?php
                            Session::forget('success');
                        ?>
                    </div>
                    <?php endif; ?>
                    <?php if(Session::has('danger')): ?>
                    <div class="alert alert-danger">
                        <?php echo e(Session::get('danger')); ?>

                        <?php
                            Session::forget('danger');
                        ?>
                    </div>
                    <?php endif; ?>
                    <div class="card">
                        <div class="card-header"></div>
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
                                <form class="form" method="post" action="<?php echo e(route('admin.terms-conditions.update')); ?>">
                                <?php echo csrf_field(); ?>
                                    <div class="form-body">
                                        <input type="hidden" name="id" class="form-control" value="<?php echo e($data->id); ?>">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label><?php echo e(trans('labels.terms_conditions')); ?></label>
                                                <textarea class="form-control" name="terms_conditions" id="terms_conditions" rows="5" placeholder="<?php echo e(trans('labels.terms_conditions')); ?>"><?php echo e($data->terms_conditions); ?></textarea>
                                                <?php $__errorArgs = ['terms_conditions'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions right">
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/eglobalm/public_html/resources/views/Admin/terms-conditions/index.blade.php ENDPATH**/ ?>