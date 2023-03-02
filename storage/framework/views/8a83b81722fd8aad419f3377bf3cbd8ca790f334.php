<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.coupons')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <section id="basic-form-layouts">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-header"><?php echo e(trans('labels.add_coupons')); ?></div>
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
                                <form class="form" method="post" action="<?php echo e(route('admin.coupons.store')); ?>" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                    <div class="form-body">

                                        <div class="form-group">
                                            <label for="coupon_name"><?php echo e(trans('labels.coupon_name')); ?></label>
                                            <input type="text" id="coupon_name" class="form-control" name="coupon_name" placeholder="<?php echo e(trans('placeholder.coupon_name')); ?>">
                                            <?php $__errorArgs = ['coupon_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="type"><?php echo e(trans('labels.type')); ?></label>
                                            <select name="type" id="type" class="form-control" onchange="showType(this)">
                                                <option value=""><?php echo e(trans('placeholder.select_type')); ?></option>
                                                <option value="0"><?php echo e(trans('labels.discount_by_percentage')); ?></option>
                                                <option value="1"><?php echo e(trans('labels.discount_by_amount')); ?></option>
                                            </select>
                                            <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div class="form-group" id="show_percentage" style="display:none;">
                                            <label for="percentage"><?php echo e(trans('labels.percentage')); ?></label>
                                            <input type="text" id="percentage" class="form-control" name="percentage" placeholder="<?php echo e(trans('placeholder.percentage')); ?>">
                                            <?php $__errorArgs = ['percentage'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div class="form-group" id="show_amount" style="display:none;">
                                            <label for="amount"><?php echo e(trans('labels.amount')); ?></label>
                                            <input type="text" id="amount" class="form-control" name="amount" placeholder="<?php echo e(trans('placeholder.amount')); ?>">
                                            <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="quantity"><?php echo e(trans('labels.quantity')); ?></label>
                                            <select name="quantity" id="quantity" class="form-control" onchange="showQuantity(this)">
                                                <option value=""><?php echo e(trans('placeholder.select_quantity')); ?></option>
                                                <option value="0"><?php echo e(trans('labels.unlimited')); ?></option>
                                                <option value="1"><?php echo e(trans('labels.limited')); ?></option>
                                            </select>
                                            <?php $__errorArgs = ['quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div class="form-group" id="show_times" style="display:none;">
                                            <label for="times"><?php echo e(trans('labels.value')); ?></label>
                                            <input type="text" id="times" class="form-control" name="times" placeholder="<?php echo e(trans('placeholder.value')); ?>">
                                            <?php $__errorArgs = ['times'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="start_date"><?php echo e(trans('labels.start_date')); ?></label>
                                                    <input type="date" id="start_date" class="form-control" name="start_date" placeholder="<?php echo e(trans('placeholder.start_date')); ?>">
                                                    <?php $__errorArgs = ['start_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="end_date"><?php echo e(trans('labels.end_date')); ?></label>
                                                    <input type="date" id="end_date" class="form-control" name="end_date" placeholder="<?php echo e(trans('placeholder.end_date')); ?>">
                                                    <?php $__errorArgs = ['end_date'];
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
                                        <div class="form-group">
                                            <label for="min_amount"><?php echo e(trans('labels.min_order_amount')); ?></label>
                                            <input type="text" id="min_amount" class="form-control" name="min_amount" placeholder="<?php echo e(trans('labels.min_order_amount')); ?>" value="<?php echo e(old('min_amount')); ?>">
                                            <?php $__errorArgs = ['min_amount'];
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
                                        <a href="<?php echo e(route('admin.coupons')); ?>" class="btn btn-raised btn-warning mr-1">
                                            <i class="ft-x"></i> <?php echo e(trans('labels.cancel')); ?>

                                        </a>
                                        <?php if(env('Environment') == 'sendbox'): ?>
                                            <button type="button" class="btn btn-raised btn-primary" onclick="myFunction()"> <i class="fa fa-check-square-o"></i> <?php echo e(trans('labels.save')); ?></button>
                                        <?php else: ?>
                                            <button type="submit" id="btn_add_category" class="btn btn-raised btn-primary"> <i class="fa fa-check-square-o"></i> <?php echo e(trans('labels.save')); ?></button>
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript">
    function showType(select){
       if(select.value==0){
        document.getElementById('show_percentage').style.display = "block";
        document.getElementById('show_amount').style.display = "none";
       } else{
        document.getElementById('show_percentage').style.display = "none";
        document.getElementById('show_amount').style.display = "block";
       }
    };

    function showQuantity(select){
       if(select.value==1){
        document.getElementById('show_times').style.display = "block";
       } else{
        document.getElementById('show_times').style.display = "none";
       }
    };
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/eglobalm/public_html/resources/views/Admin/coupons/add.blade.php ENDPATH**/ ?>