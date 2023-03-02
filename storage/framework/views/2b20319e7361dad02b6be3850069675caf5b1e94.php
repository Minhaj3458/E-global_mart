<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.vendor_details')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="content-wrapper"><!--User Profile Starts-->

        <!--About section starts-->
        <section id="about">
            <div class="row">
                <div class="col-12">
                    <div class="content-header"><?php echo e(trans('labels.about')); ?></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-block mt-2">
                                <img src='<?php echo e(Helper::image_path($data->profile_pic)); ?>' class='media-object round-media height-50'>
                                <div class="mb-3">
                                    <h3 class="text-bold-500 primary mt-2"><?php echo e($data->name); ?></h3>
                                    <div class="vendor_ratting">
                                    <i class="icon-star"></i>
                                    <span>
                                        <?php if(!empty($data['rattings'][0])): ?>
                                            <?php echo e($data['rattings'][0]->avg_ratting); ?>

                                        <?php else: ?>
                                            0.0
                                        <?php endif; ?>
                                        <?php echo e(trans('labels.average_rattings')); ?>

                                    </span>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <ul class="no-list-style">
                                            <li class="mb-2">
                                                <span class="text-bold-500 primary"><a><i class="ft-mail font-small-3"></i> <?php echo e(trans('labels.email')); ?></a></span>
                                                <a class="display-block overflow-hidden"><?php echo e($data->email); ?></a>
                                            </li>
                                            <li class="mb-2">
                                                <span class="text-bold-500 primary"><a><i class="ft-smartphone font-small-3"></i> <?php echo e(trans('labels.mobile')); ?></a></span>
                                                <span class="display-block overflow-hidden"><?php echo e($data->mobile); ?></span>
                                            </li>
                                            <li class="mb-2">
                                                <span class="text-bold-500 primary"><a><i class="ft-home font-small-3"></i> <?php echo e(trans('labels.address')); ?></a></span>
                                                <span class="display-block overflow-hidden"><?php echo e($data->store_address); ?></span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <ul class="no-list-style">
                                            <li class="mb-2">
                                                <span class="text-bold-500 primary"><a><i class="ft-smartphone font-small-3"></i> <?php echo e(trans('labels.status')); ?></a></span>
                                                <span class="display-block overflow-hidden">
                                                    <?php if($data->is_verified == 0): ?>
                                                        <?php echo e(trans('labels.unverified')); ?>

                                                    <?php else: ?>
                                                        <?php echo e(trans('labels.verified')); ?>

                                                    <?php endif; ?>
                                                </span>
                                            </li>
                                            <li class="mb-2">
                                                <span class="text-bold-500 primary"><a><i class="ft-monitor font-small-3"></i> <?php echo e(trans('labels.website')); ?></a></span>
                                                <a class="display-block overflow-hidden"><a href="<?php echo e(URL::to('vendor-details/'.$data->id)); ?>" target="_blank"> <?php echo e(trans('labels.go_to_store')); ?></a>
                                            </li>
                                            <li class="mb-2">
                                                <span class="text-bold-500 primary"><a><i class="ft-book font-small-3"></i> <?php echo e(trans('labels.joined')); ?></a></span>
                                                <span class="display-block overflow-hidden"><?php echo e(Helper::date_format($data->created_at)); ?></span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <ul class="no-list-style">
                                            <li class="mb-2">
                                                <span class="text-bold-500 primary"><a><i class="ft-monitor font-small-3"></i> <?php echo e(trans('labels.bank_name')); ?></a></span>
                                                <span class="display-block overflow-hidden"><?php echo e(@$bankdata->bank_name); ?></span>
                                            </li>
                                            <li class="mb-2">
                                                <span class="text-bold-500 primary"><a><i class="ft-book font-small-3"></i> <?php echo e(trans('labels.account_type')); ?></a></span>
                                                <span class="display-block overflow-hidden"><?php echo e(@$bankdata->account_type); ?></span>
                                            </li>
                                            <li class="mb-2">
                                                <span class="text-bold-500 primary"><a><i class="ft-book font-small-3"></i> <?php echo e(trans('labels.account_number')); ?></a></span>
                                                <span class="display-block overflow-hidden"><?php echo e(@$bankdata->account_number); ?></span>
                                            </li>
                                            <li class="mb-2">
                                                <span class="text-bold-500 primary"><a><i class="ft-book font-small-3"></i> <?php echo e(trans('labels.routing_number')); ?></a></span>
                                                <span class="display-block overflow-hidden"><?php echo e(@$bankdata->routing_number); ?></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                      <h4 class="card-title mb-0"><?php echo e(trans('labels.monthly_orders')); ?></h4>
                    </div>
                    <div class="card-body">
                      <p class="font-medium-2 text-muted text-center pb-2"><?php echo e(trans('labels.six_months_sales')); ?></p>
                      <div class="card-block">
                        <div id="piechart" class="height-400 lineAreaDashboard">
                        </div>
                      </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="row" matchHeight="card">
                    <div class="col-xl-6 col-lg-6 col-12">
                        <div class="card bg-success">
                            <div class="card-body">
                                <div class="px-3 py-3">
                                    <div class="media">
                                        <div class="media-body white text-left">
                                            <h3><?php echo e($ttlorders); ?></h3>
                                            <span><?php echo e(trans('labels.total_orders')); ?></span>
                                        </div>
                                        <div class="media-right align-self-center">
                                            <i class="icon-speedometer white font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-12">
                        <div class="card bg-danger">
                            <div class="card-body">
                                <div class="px-3 py-3">
                                    <div class="media">
                                        <div class="media-body white text-left">
                                            <h3><?php echo e($ttlcancelorders); ?></h3>
                                            <span><?php echo e(trans('labels.total_cancel_orders')); ?></span>
                                        </div>
                                        <div class="media-right align-self-center">
                                            <i class="icon-close white font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-12">
                        <div class="card bg-warning">
                            <div class="card-body">
                                <div class="px-3 py-3">
                                    <div class="media">
                                        <div class="media-body white text-left">
                                            <h3><?php echo e($ttlreturnorders); ?></h3>
                                            <span><?php echo e(trans('labels.total_return_orders')); ?></span>
                                        </div>
                                        <div class="media-left align-self-center">
                                            <i class="icon-action-undo white font-large-2 float-left"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-12">
                        <div class="card bg-primary">
                            <div class="card-body">
                                <div class="px-3 py-3">
                                    <div class="media">
                                        <div class="media-body white text-left">
                                            <h3><?php echo e($ttlpendingorders); ?></h3>
                                            <span><?php echo e(trans('labels.total_pending_orders')); ?></span>
                                        </div>
                                        <div class="media-left align-self-center">
                                            <i class="icon-graph white font-large-2 float-left"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-12">
                        <div class="card bg-danger">
                            <div class="card-body">
                                <div class="px-3 py-3">
                                    <div class="media">
                                        <div class="media-body white text-left">
                                            <h3><?php echo e(Helper::CurrencyFormatter($ttlpending->wallet)); ?></h3>
                                            <span>Pending Settlement</span>
                                        </div>
                                        <div class="media-right align-self-center">
                                            <i class="icon-wallet white font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-12">
                        <div class="card bg-success">
                            <div class="card-body">
                                <div class="px-3 py-3">
                                    <div class="media">
                                        <div class="media-body white text-left">
                                            <h3><?php echo e(Helper::CurrencyFormatter($ttlearning)); ?></h3>
                                            <span><?php echo e(trans('labels.total_earnings')); ?></span>
                                        </div>
                                        <div class="media-right align-self-center">
                                            <i class="icon-bar-chart white font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section id="striped-light">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><?php echo e(trans('labels.transaction_history')); ?></h4>
                        </div>
                        <div class="card-body">
                            <div class="card-block">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(trans('labels.request_id')); ?></th>
                                            <th><?php echo e(trans('labels.name')); ?></th>
                                            <th><?php echo e(trans('labels.amount')); ?></th>
                                            <th><?php echo e(trans('labels.action')); ?></th>
                                            <th><?php echo e(trans('labels.paid_date')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $payoutdetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($row->request_id); ?></td>
                                            <td><?php echo e($row['vendors']->name); ?></td>
                                            <td>
                                                <?php echo e(trans('labels.requested_amount')); ?> : <b><?php echo e(Helper::CurrencyFormatter($row->amount)); ?></b> <br>
                                                <?php echo e(trans('labels.admin_commission')); ?> (<?php echo e($row->commission_pr); ?>%) : - <b><?php echo e(Helper::CurrencyFormatter($row->commission)); ?></b> <br><br>
                                                <?php echo e(trans('labels.payable_amount')); ?> : <b><?php echo e(Helper::CurrencyFormatter($row->paid_amount)); ?></b>
                                            </td>
                                            <td>
                                                <?php if($row->status == 1): ?>
                                                    <span class="badge badge-warning"><?php echo e(trans('labels.pending')); ?></span>
                                                <?php else: ?>
                                                    <span class="badge badge-success"><?php echo e(trans('labels.paid')); ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e($row->paid_at); ?></td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--About section ends-->
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripttop'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    // 
    google.charts.load('current', {'packages':['corechart']});

    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

    var data = google.visualization.arrayToDataTable([
        ['Month Name', 'amount'],

            <?php
            foreach($orders as $order) {
                echo "['".$order->month_name."', ".$order->amount."],";
            }
            ?>
    ]);

      var options = {
        title: 'Monthly earnings',
        is3D: true,
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart'));

      chart.draw(data, options);
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/vendors/vendor-details.blade.php ENDPATH**/ ?>