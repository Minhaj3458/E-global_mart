<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.popup_banner')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <section id="basic-form-layouts">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-header"><?php echo e(trans('labels.edit_popupbanner')); ?></div>
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
                                <form class="form" method="post" action="<?php echo e(route('admin.popupbanner.update')); ?>" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                    <div class="form-body">
                                        <input type="hidden" name="brand_id" id="brand_id" value="<?php echo e($data->id); ?>" class="form-control">
                                        <input type="hidden" name="old_img" id="old_img" value="<?php echo e($data->icon); ?>" class="form-control">
                                        <div class="form-group">
                                            <label for="type" class="col-form-label"><?php echo e(trans('labels.type')); ?>:</label>
                                            <select name="type" class="form-control"id="type">
                                                <option value=""><?php echo e(trans('placeholder.select_type')); ?></option>
                                                <option value="category" <?php echo e($data->type == "category"  ? 'selected' : ''); ?>><?php echo e(trans('labels.category')); ?></option>
                                                <option value="product" <?php echo e($data->type == "product"  ? 'selected' : ''); ?>><?php echo e(trans('labels.product')); ?></option>
                                            </select>
                                        </div>
                                        <div class="category gravity" <?php if($data->type != "category"): ?> style="display: none;" <?php endif; ?>>
                                            <div class="form-group">
                                                <label for="cat_id" class="col-form-label"><?php echo e(trans('labels.category')); ?>:</label>
                                                <select name="cat_id" class="form-control"id="cat_id">
                                                    <option value=""><?php echo e(trans('placeholder.select_category')); ?></option>
                                                    <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($category->id); ?>" <?php echo e(($data->cat_id == $category->id) ? 'selected' : ''); ?>><?php echo e($category->category_name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="category gravity" <?php if($data->type != "product"): ?> style="display: none;" <?php endif; ?>>
                                            <div class="form-group">
                                                <label for="product_id" class="col-form-label"><?php echo e(trans('labels.product')); ?>:</label>
                                                <select name="product_id" class="form-control" id="product_id">
                                                    <option value=""><?php echo e(trans('placeholder.select_product')); ?></option>
                                                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($product->id); ?>" <?php echo e(($data->product_id == $product->id) ? 'selected' : ''); ?>><?php echo e($product->product_name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="image"><?php echo e(trans('labels.image')); ?></label>
                                            <input type="file" id="image" class="form-control" name="image" >
                                            <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <img src='<?php echo e(Helper::image_path($data->image)); ?>' class='media-object round-media height-50'>
                                    </div>

                                    <div class="form-actions center">
                                        <a href="<?php echo e(route('admin.popupbanner')); ?>" class="btn btn-raised btn-warning mr-1"><i class="ft-x"></i> <?php echo e(trans('labels.cancel')); ?></a>
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
<script type="text/javascript">
    $(document).ready(function(){
        $('#type').on('change', function() {
            if ( this.value == 'category'){
                $(".category").show();
                $(".product").hide();
            }
            if ( this.value == 'product'){
                $(".product").show();
                $(".category").hide();
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/eglobalm/public_html/resources/views/Admin/popupbanner/show.blade.php ENDPATH**/ ?>