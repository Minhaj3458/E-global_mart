<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.payments')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <section id="basic-form-layouts">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-header"><?php echo e($paymentdetails->payment_name); ?> <?php echo e(trans('labels.payment_configuration')); ?> </div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col-md-12">
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
                                <form class="form" method="post" action="<?php echo e(route('admin.payments.update')); ?>">
                                <?php echo csrf_field(); ?>
                                    <div class="form-body">
                                        <input type="hidden" name="id" id="id" value="<?php echo e($paymentdetails->id); ?>" class="form-control">
                                        <div class="form-group">
                                            <label><?php echo e(trans('labels.Environment')); ?></label>
                                            <select id="environment" name="environment" class="form-control">
                                                <option selected="selected" value=""><?php echo e(trans('labels.Choose')); ?></option>
                                                <option value="0" <?php echo e($paymentdetails->environment == 0  ? 'selected' : ''); ?>><?php echo e(trans('labels.Production')); ?></option>
                                                <option value="1" <?php echo e($paymentdetails->environment == 1  ? 'selected' : ''); ?>><?php echo e(trans('labels.Sendbox')); ?></option>
                                            </select>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <?php if($paymentdetails->payment_name == "Stripe"): ?>
                                                <label>
                                                        <?php echo e(trans('labels.Stripe_public_key')); ?>

                                                </label>
                                                <input type="text" name="test_public_key" class="form-control" placeholder="<?php echo e(trans('labels.Stripe_public_key')); ?>" value="<?php echo e($paymentdetails->test_public_key); ?>">
                                                <?php endif; ?>

                                                <?php if($paymentdetails->payment_name == "RazorPay"): ?>
                                                <label>
                                                        <?php echo e(trans('labels.RazorPay_public_key')); ?>

                                                </label>
                                                <input type="text" name="test_public_key" class="form-control" placeholder="<?php echo e(trans('labels.RazorPay_public_key')); ?>" value="<?php echo e($paymentdetails->test_public_key); ?>">
                                                <?php endif; ?>

                                                <?php if($paymentdetails->payment_name == "Flutterwave"): ?>
                                                <label>
                                                        <?php echo e(trans('labels.Flutterwave_public_key')); ?>

                                                </label>
                                                <input type="text" name="test_public_key" class="form-control" placeholder="<?php echo e(trans('labels.Flutterwave_public_key')); ?>" value="<?php echo e($paymentdetails->test_public_key); ?>">
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <?php if($paymentdetails->payment_name == "Stripe"): ?>
                                                <label>
                                                        <?php echo e(trans('labels.Stripe_Secret_key')); ?>

                                                </label>
                                                <input type="text" name="test_secret_key" class="form-control" placeholder="<?php echo e(trans('labels.Stripe_Secret_key')); ?>" value="<?php echo e($paymentdetails->test_secret_key); ?>">
                                                <?php endif; ?> 

                                                <?php if($paymentdetails->payment_name == "RazorPay"): ?>
                                                <label>
                                                        <?php echo e(trans('labels.RazorPay_Secret_key')); ?>

                                                </label>
                                                <input type="text" name="test_secret_key" class="form-control" placeholder="<?php echo e(trans('labels.RazorPay_Secret_key')); ?>" value="<?php echo e($paymentdetails->test_secret_key); ?>">
                                                <?php endif; ?>

                                                <?php if($paymentdetails->payment_name == "Flutterwave"): ?>
                                                <label>
                                                        <?php echo e(trans('labels.Flutterwave_Secret_key')); ?>

                                                </label>
                                                <input type="text" name="test_secret_key" class="form-control" placeholder="<?php echo e(trans('labels.Flutterwave_Secret_key')); ?>" value="<?php echo e($paymentdetails->test_secret_key); ?>">
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">

                                            <?php if($paymentdetails->payment_name == "Stripe"): ?>
                                            <label>
                                                    <?php echo e(trans('labels.Stripe_Production_Public_key')); ?>

                                            </label>
                                            <input type="text" name="live_public_key" class="form-control" placeholder="<?php echo e(trans('labels.Stripe_Production_Public_key')); ?>" value="<?php echo e($paymentdetails->live_public_key); ?>">
                                            <?php endif; ?>

                                            <?php if($paymentdetails->payment_name == "RazorPay"): ?> 
                                            <label>
                                                    <?php echo e(trans('labels.RazorPay_Production_Public_key')); ?>

                                            </label>
                                            <input type="text" name="live_public_key" class="form-control" placeholder="<?php echo e(trans('labels.RazorPay_Production_Public_key')); ?>" value="<?php echo e($paymentdetails->live_public_key); ?>">
                                            <?php endif; ?>

                                            <?php if($paymentdetails->payment_name == "Flutterwave"): ?> 
                                            <label>
                                                    <?php echo e(trans('labels.Flutterwave_Production_Public_key')); ?>

                                            </label>
                                            <input type="text" name="live_public_key" class="form-control" placeholder="<?php echo e(trans('labels.Flutterwave_Production_Public_key')); ?>" value="<?php echo e($paymentdetails->live_public_key); ?>">
                                            <?php endif; ?>

                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php if($paymentdetails->payment_name == "Stripe"): ?>
                                            <label>
                                                    <?php echo e(trans('labels.Stripe_Production_Secret_key')); ?>

                                            </label>
                                            <input type="text" name="live_secret_key" class="form-control" placeholder="<?php echo e(trans('labels.Stripe_Production_Secret_key')); ?>" value="<?php echo e($paymentdetails->live_secret_key); ?>">
                                            <?php endif; ?>

                                            <?php if($paymentdetails->payment_name == "RazorPay"): ?> 
                                            <label>
                                                    <?php echo e(trans('labels.RazorPay_Production_Secret_key')); ?>

                                            </label>
                                            <input type="text" name="live_secret_key" class="form-control" placeholder="<?php echo e(trans('labels.RazorPay_Production_Secret_key')); ?>" value="<?php echo e($paymentdetails->live_secret_key); ?>">
                                            <?php endif; ?>

                                            <?php if($paymentdetails->payment_name == "Flutterwave"): ?> 
                                            <label>
                                                    <?php echo e(trans('labels.Flutterwave_Production_Secret_key')); ?>

                                            </label>
                                            <input type="text" name="live_secret_key" class="form-control" placeholder="<?php echo e(trans('labels.Flutterwave_Production_Secret_key')); ?>" value="<?php echo e($paymentdetails->live_secret_key); ?>">
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <?php if($paymentdetails->payment_name == "Flutterwave"): ?> 
                                            <label>
                                                    <?php echo e(trans('labels.encryption_key')); ?>

                                            </label>
                                            <input type="text" name="encryption_key" class="form-control" placeholder="<?php echo e(trans('labels.encryption_key')); ?>" value="<?php echo e($paymentdetails->encryption_key); ?>">
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="form-actions center">
                                        <a href="<?php echo e(route('admin.payments')); ?>" class="btn btn-raised btn-warning mr-1">
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/eglobalm/public_html/resources/views/Admin/payment/manage-payment.blade.php ENDPATH**/ ?>