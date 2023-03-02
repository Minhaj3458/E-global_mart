
<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.vendors')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <section id="configuration">
            <div class="row">
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
                            <div class="card-body">
                                <div class="px-3">
                                    <form class="form form-horizontal striped-rows form-bordered" method="post" action="<?php echo e(route('admin.vendors.update')); ?>" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <div class="form-body">
                                            <h4 class="form-section"><i class="ft-user"></i> <?php echo e(trans('labels.basic_info')); ?></h4>
                                            <div class="form-group row">
                                                <label class="col-md-2 label-control" for="name"><?php echo e(trans('labels.store_name')); ?></label>
                                                <div class="col-md-10">
                                                    <input type="text" id="name" class="form-control" placeholder="<?php echo e(trans('labels.store_name')); ?>" name="name" id="name" value="<?php echo e($data->name); ?>">
                                                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 label-control" for="email"><?php echo e(trans('labels.email')); ?></label>
                                                <div class="col-md-10">
                                                    <input type="text" id="email" class="form-control" placeholder="<?php echo e(trans('labels.email')); ?>" name="email" id="email" value="<?php echo e($data->email); ?>">
                                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>

                                            <div class="form-group row last">
                                                <label class="col-md-2 label-control" for="mobile"><?php echo e(trans('labels.mobile')); ?></label>
                                                <div class="col-md-10">
                                                    <input type="text" id="mobile" class="form-control" placeholder="<?php echo e(trans('labels.mobile')); ?>" name="mobile" id="mobile" value="<?php echo e($data->mobile); ?>">
                                                    <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>

                                            <div class="form-group row last">
                                                <label class="col-md-2 label-control" for="store_address"><?php echo e(trans('labels.address')); ?></label>
                                                <div class="col-md-10">
                                                    <textarea class="form-control" name="store_address" id="store_address" placeholder="<?php echo e(trans('labels.address')); ?>"><?php echo e($data->store_address); ?></textarea>
                                                    <?php $__errorArgs = ['store_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 label-control"><?php echo e(trans('labels.logo')); ?></label>
                                                <div class="col-md-10">
                                                    <label id="profile_pic" class="file center-block">
                                                        <input type="file" name="profile_pic" id="profile_pic">
                                                    </label>
                                                    <br>
                                                    <?php $__errorArgs = ['profile_pic'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    <br>
                                                    <img src='<?php echo e(Helper::image_path($data->profile_pic)); ?>' class='media-object round-media height-50'>
                                                </div>
                                            </div>

                                            <h4 class="form-section"><i class="ft-file-text"></i> <?php echo e(trans('labels.payments')); ?></h4>

                                            <div class="form-group row">
                                                <label class="col-md-2 label-control" for="bank_name"><?php echo e(trans('labels.bank_name')); ?></label>
                                                <div class="col-md-10">
                                                    <input type="text" id="bank_name" class="form-control" placeholder="<?php echo e(trans('labels.bank_name')); ?>" name="bank_name" value="<?php echo e(@$bankdata->bank_name); ?>">
                                                    <?php $__errorArgs = ['bank_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 label-control" for="account_type"><?php echo e(trans('labels.account_type')); ?></label>
                                                <div class="col-md-10">
                                                    <input type="text" id="account_type" class="form-control" placeholder="<?php echo e(trans('labels.account_type')); ?>" name="account_type" value="<?php echo e(@$bankdata->account_type); ?>">
                                                    <?php $__errorArgs = ['account_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 label-control" for="account_number"><?php echo e(trans('labels.account_number')); ?></label>
                                                <div class="col-md-10">
                                                    <input type="text" id="account_number" class="form-control" placeholder="<?php echo e(trans('labels.account_number')); ?>" name="account_number" value="<?php echo e(@$bankdata->account_number); ?>">
                                                    <?php $__errorArgs = ['account_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 label-control" for="routing_number"><?php echo e(trans('labels.routing_number')); ?></label>
                                                <div class="col-md-10">
                                                    <input type="text" id="routing_number" class="form-control" placeholder="Bank Routing Number" name="routing_number" value="<?php echo e(@$bankdata->routing_number); ?>">
                                                    <?php $__errorArgs = ['routing_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>

                                            <h4 class="form-section"><i class="fa fa-globe"></i> <?php echo e(trans('labels.social_accounts')); ?></h4>

                                            <div class="form-group row">
                                                <label class="col-md-2 label-control" for="facebook"><?php echo e(trans('labels.facebook')); ?></label>
                                                <div class="col-md-10">
                                                    <input type="text" id="facebook" class="form-control" placeholder="<?php echo e(trans('labels.facebook')); ?>" name="facebook" value="<?php echo e($data->facebook); ?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 label-control" for="instagram"><?php echo e(trans('labels.instagram')); ?></label>
                                                <div class="col-md-10">
                                                    <input type="text" id="instagram" class="form-control" placeholder="<?php echo e(trans('labels.instagram')); ?>" name="instagram" value="<?php echo e($data->instagram); ?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 label-control" for="twitter"><?php echo e(trans('labels.twitter')); ?></label>
                                                <div class="col-md-10">
                                                    <input type="text" id="twitter" class="form-control" placeholder="<?php echo e(trans('labels.twitter')); ?>" name="twitter" value="<?php echo e($data->twitter); ?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 label-control" for="google"><?php echo e(trans('labels.google')); ?></label>
                                                <div class="col-md-10">
                                                    <input type="text" id="google" class="form-control" placeholder="<?php echo e(trans('labels.google')); ?>" name="google" value="<?php echo e($data->google); ?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 label-control" for="youtube"><?php echo e(trans('labels.youtube')); ?></label>
                                                <div class="col-md-10">
                                                    <input type="text" id="youtube" class="form-control" placeholder="<?php echo e(trans('labels.youtube')); ?>" name="youtube" value="<?php echo e($data->youtube); ?>">
                                                </div>
                                            </div>

                                            <h4 class="form-section"><i class="fa fa-image"></i><?php echo e(trans('labels.banner_settings')); ?></h4>

                                            <div class="form-group row last">
                                                <label class="col-md-2 label-control" for="store_banner"><?php echo e(trans('labels.banners')); ?> (1500x450)</label>
                                                <div class="col-md-10">
                                                    <input type="file" id="store_banner" class="form-control" name="store_banner" value="<?php echo e($data->store_banner); ?>">
                                                    <div class="row">
                                                    <?php $__currentLoopData = $getbanners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="col-2 pr-0">
                                                            <div class="card px-1">
                                                                <div class="text-center py-3">
                                                                    <img src='<?php echo e(Helper::image_path($banner->image)); ?>' class='media-object round-media height-50'>
                                                                </div>
                                                                <span class="tags float-left">
                                                                    <span class="badge bg-danger white" onclick="do_delete('<?php echo e($banner->id); ?>','<?php echo e(route('admin.vendors.delete')); ?>','<?php echo e(trans('labels.delete_image')); ?>','<?php echo e(trans('labels.delete')); ?>')">Delete</span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-actions text-right">
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript">
    function do_delete(id,page_name,name,titles)
    {
        Swal.fire({
            title: '<?php echo e(trans('labels.are_you_sure')); ?>',
            text: "<?php echo e(trans('labels.delete_text')); ?> "+name+"!",
            type: 'error',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<?php echo e(trans('labels.yes')); ?>',
            cancelButtonText: '<?php echo e(trans('labels.no')); ?>'
        }).then((t) => {
            if(t.value==true){  
                $('#preloader').show();
                $.ajax({
                     headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: page_name,
                    type: "POST",
                    data : {'id':id},

                    success:function(data)
                    { 
                        $('#preloader').hide();
                        if(data == 1000)
                        {
                            location.reload();    
                        }
                        else
                        {
                            Swal.fire({type: 'error',title: '<?php echo e(trans('labels.cancelled')); ?>',showConfirmButton: false,timer: 1500});
                        }    
                    },error:function(data){
                        $('#preloader').hide();
                        console.log("AJAX error in request: " + JSON.stringify(data, null, 2));
                    }
                });
            }
            else
            {
                Swal.fire({type: 'error',title: '<?php echo e(trans('labels.cancelled')); ?>',showConfirmButton: false,timer: 1500});

            }
        });

    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/eglobalm/public_html/resources/views/Admin/vendors/profile.blade.php ENDPATH**/ ?>