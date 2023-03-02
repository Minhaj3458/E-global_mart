<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.products')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <section class="basic-elements">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-header"><?php echo e(trans('labels.add_product')); ?></div>
                </div>
            </div>
            <?php if(Session::has('danger')): ?>
            <div class="alert alert-danger">
                <?php echo e(Session::get('danger')); ?>

                <?php
                    Session::forget('danger');
                ?>
            </div>
            <?php endif; ?>
            <form class="form" method="post" action="<?php echo e(route('admin.products.store')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0"><?php echo e(trans('labels.product_info')); ?></h6>
                            </div>
                            <div class="card-body">
                                <div class="px-3">
                                    <div class="form-group row">
                                      <label for="cat_id" class="col-sm-2 col-form-label"><?php echo e(trans('labels.category')); ?></label>
                                      <div class="col-sm-10">
                                        <select class="form-control" name="cat_id" id="cat_id">
                                            <option value="" selected disabled><?php echo e(trans('placeholder.select_category')); ?></option>
                                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->id); ?>" <?php echo e(old('cat_id') == $category->id ? 'selected' : ''); ?>><?php echo e($category->category_name); ?></option>
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
                                    </div>
                                    <div class="form-group row">
                                      <label for="subcat_id" class="col-sm-2 col-form-label"><?php echo e(trans('labels.subcategory')); ?></label>
                                      <div class="col-sm-10">
                                        <select class="form-control" name="subcat_id" id="subcat_id">
                                            <option value="" selected disabled><?php echo e(trans('placeholder.select_subcategory')); ?></option>
                                        </select>
                                        <?php $__errorArgs = ['subcat_id'];
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
                                      <label for="innersubcat_id" class="col-sm-2 col-form-label"><?php echo e(trans('labels.innersubcategory')); ?></label>
                                      <div class="col-sm-10">
                                        <select class="form-control" name="innersubcat_id" id="innersubcat_id">
                                            <option value="" selected disabled><?php echo e(trans('placeholder.select_innersubcategory')); ?></option>
                                        </select>
                                        <?php $__errorArgs = ['innersubcat_id'];
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
                                      <label for="product_name" class="col-sm-2 col-form-label"><?php echo e(trans('labels.product_name')); ?></label>
                                      <div class="col-sm-10">
                                        <input type="text" class="form-control" id="product_name" name="product_name" placeholder="<?php echo e(trans('placeholder.product')); ?>" value="<?php echo e(old('product_name')); ?>">
                                        <?php $__errorArgs = ['product_name'];
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
                                      <label for="brand" class="col-sm-2 col-form-label"><?php echo e(trans('labels.brand')); ?></label>
                                      <div class="col-sm-10">
                                        <select class="form-control" name="brand" id="brand">
                                            <option value="" selected disabled><?php echo e(trans('labels.select')); ?></option>
                                            <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brands): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                              <option value="<?php echo e($brands->id); ?>" <?php if(old('brand') == $brands->id): ?> selected <?php endif; ?>><?php echo e($brands->brand_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['brand'];
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
                                      <label for="brand" class="col-sm-2 col-form-label"><?php echo e(trans('labels.sku')); ?></label>
                                      <div class="col-sm-10">
                                        <input type="text" class="form-control" id="sku" name="sku" placeholder="<?php echo e(trans('placeholder.sku')); ?>" value="<?php echo e(old('sku')); ?>">
                                        <?php $__errorArgs = ['sku'];
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
                                      <label for="image" class="col-sm-2 col-form-label"><?php echo e(trans('labels.image')); ?></label>
                                      <div class="col-sm-10">
                                        <input type="file" class="form-control" id="image" name="image[]" multiple="true">
                                        <?php $__errorArgs = ['image'];
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
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0"><?php echo e(trans('labels.tags')); ?></h6>
                            </div>
                            <div class="card-body">
                                <div class="px-3">
                                  <div class="form-group row">
                                    <label for="tags" class="col-sm-2 col-form-label"><?php echo e(trans('labels.tags')); ?></label>
                                    <div class="col-sm-10">
                                      <div class="edit-on-delete form-control" data-tags-input-name="tags"></div>
                                      <p class="text-muted"><?php echo e(trans('labels.tags_note')); ?></p>
                                      <?php $__errorArgs = ['tags'];
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
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0"><?php echo e(trans('labels.price_or_variation')); ?></h6>
                            </div>
                            <div class="card-body">
                                <div class="px-3">

                                  <div class="form-group row">
                                    <label for="is_variation" class="col-sm-2 col-form-label"><?php echo e(trans('labels.is_variation_available')); ?></label>
                                    <div class="col-sm-10">
                                      <input  type="checkbox" class="is_variation big-checkbox" name="is_variation" value="on" 
                                      <?php if(old('is_variation') == 'on'): ?> checked <?php endif; ?>/>
                                    </div>
                                  </div>

                                  <div class="form-group row default_price" <?php if(old('is_variation') == 'on'): ?> style="display: none;" <?php endif; ?>>
                                    <label for="product_price" class="col-sm-2 col-form-label"><?php echo e(trans('labels.price')); ?></label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" id="product_price" name="product_price" placeholder="<?php echo e(trans('placeholder.price')); ?>" value="<?php echo e(old('product_price')); ?>">
                                      <?php $__errorArgs = ['product_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                  </div>

                                  <div class="form-group row default_price" <?php if(old('is_variation') == 'on'): ?> style="display: none;" <?php endif; ?>>
                                    <label for="discounted_price" class="col-sm-2 col-form-label"><?php echo e(trans('labels.discounted_price')); ?></label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" id="discounted_price" name="discounted_price" placeholder="<?php echo e(trans('placeholder.discounted_price')); ?>" value="<?php echo e(old('discounted_price')); ?>">
                                      <?php $__errorArgs = ['discounted_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                  </div>

                                  <div class="form-group row default_price" <?php if(old('is_variation') == 'on'): ?> style="display: none;" <?php endif; ?>>
                                    <label for="product_qty" class="col-sm-2 col-form-label"><?php echo e(trans('labels.qty')); ?></label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" id="product_qty" name="product_qty" placeholder="<?php echo e(trans('placeholder.product_qty')); ?>" value="<?php echo e(old('product_qty')); ?>">
                                      <?php $__errorArgs = ['product_qty'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                  </div>

                                  <div class="form-group row variation" <?php if(old('is_variation') != 'on'): ?> style="display: none;" <?php endif; ?>>
                                    <label for="attribute" class="col-sm-2 col-form-label"><?php echo e(trans('labels.attribute')); ?></label>
                                    <div class="col-sm-10">
                                      <select class="form-control" name="attribute" id="attribute">
                                          <option selected disabled value=""><?php echo e(trans('placeholder.select_attribute')); ?></option>
                                          <?php $__currentLoopData = $attribute; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attributes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <option value="<?php echo e($attributes->id); ?>" <?php if(old('attribute') == $attributes->id): ?> selected <?php endif; ?>><?php echo e($attributes->attribute); ?></option>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      </select>
                                      <?php $__errorArgs = ['attribute'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                  </div>

                                  <div class="row panel-body variation" <?php if(old('is_variation') != 'on'): ?> style="display: none;" <?php endif; ?>>

                                    <?php if(old('variation')): ?>
                                      <?php $__currentLoopData = old('variation'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $quty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <div class="row removeclass<?php echo e($loop->index); ?>">
                                      
                                      <div class="col-sm-3 nopadding">
                                        <div class="form-group">
                                          <label for="variation" class="col-form-label"><?php echo e(trans('labels.variation')); ?></label>
                                            <input type="text" class="form-control" name="variation[<?php echo e($i); ?>]" id="variation" value="<?php echo e($quty); ?>" placeholder="Variation">
                                            <?php if($errors->has('variation.'.$i)): ?>
                                                <span class="text-danger"><?php echo e(trans('labels.required')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                      </div>

                                      <div class="col-sm-3 nopadding">
                                        <div class="form-group">
                                          <label for="price" class="col-form-label"><?php echo e(trans('labels.price')); ?></label>
                                            <input type="text" class="form-control" id="price" name="price[<?php echo e($i); ?>]" pattern="[0-9]+" value="<?php echo e(old('price')[$loop->index]); ?>" placeholder="Price">
                                            <?php if($errors->has('price.'.$i)): ?>
                                                <span class="text-danger"><?php echo e(trans('labels.required')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                      </div>

                                      <div class="col-sm-3 nopadding">
                                        <div class="form-group">
                                          <label for="discounted_variation_price" class="col-form-label"><?php echo e(trans('labels.discounted_price')); ?></label>
                                            <input type="text" class="form-control" id="discounted_variation_price" name="discounted_variation_price[<?php echo e($i); ?>]" pattern="[0-9]+" placeholder="<?php echo e(trans('placeholder.discounted_variation_price')); ?>" value="<?php echo e(old('discounted_variation_price')[$loop->index]); ?>">
                                            <?php if($errors->has('discounted_variation_price.'.$i)): ?>
                                                <span class="text-danger"><?php echo e(trans('labels.required')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                      </div>
                                      
                                      <div class="col-sm-2 nopadding">
                                        <div class="form-group">
                                          <label for="qty" class="col-form-label"><?php echo e(trans('labels.qty')); ?></label>
                                          <input type="text" class="form-control" name="qty[<?php echo e($i); ?>]" pattern="[0-9]+" id="qty" value="<?php echo e(old('qty')[$loop->index]); ?>" placeholder="<?php echo e(trans('labels.qty')); ?>">
                                          <?php if($errors->has('qty.'.$i)): ?>
                                              <span class="text-danger"><?php echo e(trans('labels.required')); ?></span>
                                          <?php endif; ?>
                                        </div>
                                      </div>

                                      <?php if($loop->index == 0): ?>
                                        <div class="col-sm-1 nopadding">
                                          <div class="form-group">
                                            <div class="input-group">
                                              <div class="input-group-btn pt-30">
                                                <button class="btn btn-success" type="button" onclick="variation_fields();"> + </button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      <?php else: ?>
                                        <div class="col-sm-1 nopadding">
                                          <div class="form-group">
                                            <div class="input-group">
                                              <div class="input-group-btn pt-30">
                                                <button class="btn btn-danger" type="button" onclick="remove_variation_fields('<?php echo e($loop->index); ?>');"> - </button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      <?php endif; ?>
                                      </div>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>

                                      <div class="col-sm-3 nopadding">
                                        <div class="form-group">
                                          <label for="variation" class="col-form-label"><?php echo e(trans('labels.variation')); ?></label>
                                            <input type="text" class="form-control" name="variation[]" id="variation" value="<?php echo e(old('variation')); ?>" placeholder="Variation">
                                        </div>
                                      </div>

                                      <div class="col-sm-3 nopadding">
                                        <div class="form-group">
                                          <label for="price" class="col-form-label"><?php echo e(trans('labels.price')); ?></label>
                                            <input type="text" class="form-control" id="price" name="price[]" pattern="[0-9]+" value="<?php echo e(old('price')); ?>" placeholder="Price">
                                        </div>
                                      </div>

                                      <div class="col-sm-3 nopadding">
                                        <div class="form-group">
                                          <label for="discounted_variation_price" class="col-form-label"><?php echo e(trans('labels.discounted_price')); ?></label>
                                            <input type="text" class="form-control" id="discounted_variation_price" name="discounted_variation_price[]" pattern="[0-9]+" placeholder="<?php echo e(trans('placeholder.discounted_price')); ?>">
                                        </div>
                                      </div>
                                      
                                      <div class="col-sm-2 nopadding">
                                        <div class="form-group">
                                          <label for="qty" class="col-form-label"><?php echo e(trans('labels.qty')); ?></label>
                                          <input type="text" class="form-control" name="qty[]" pattern="[0-9]+" id="qty" placeholder="<?php echo e(trans('labels.qty')); ?>">
                                        </div>
                                      </div>

                                      <div class="col-sm-1 nopadding">
                                        <div class="form-group">
                                          <div class="input-group">
                                            <div class="input-group-btn pt-30">
                                              <button class="btn btn-success" type="button"  onclick="variation_fields();"> + </button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    <?php endif; ?>

                                    <div class="clear"></div>

                                  </div>

                                  <div id="variation_fields"></div>

                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0"><?php echo e(trans('labels.product_description')); ?></h6>
                            </div>
                            <div class="card-body">
                                <div class="px-3">
                                  <div class="form-group row">
                                    <label for="description" class="col-sm-2 col-form-label"><?php echo e(trans('labels.description')); ?></label>
                                    <div class="col-sm-10">
                                      <textarea class="form-control" id="description" name="description" rows="6" placeholder="<?php echo e(trans('placeholder.description')); ?>"><?php echo e(old('description')); ?></textarea>
                                      <?php $__errorArgs = ['description'];
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
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0"><?php echo e(trans('labels.shipping_configuration')); ?></h6>
                            </div>
                            <div class="card-body">
                                <div class="px-3">
                                    <ul class="list-group list-group-flush">
                                      <li class="list-group-item border-none"><?php echo e(trans('labels.free_shipping')); ?>

                                        <span class="float-right">
                                          <input type="checkbox" class="big-checkbox" name="free_shipping" id="free_shipping" value="free_shipping" 
                                          <?php if(old('free_shipping') == 'free_shipping'): ?> checked <?php endif; ?>>
                                        </span>
                                      </li>
                                      <li class="list-group-item border-none"><?php echo e(trans('labels.flat_rate')); ?>

                                        <span class="float-right">
                                          <input type="checkbox" class="big-checkbox" name="flat_rate" id="flat_rate" value="flat_rate" <?php if(old('flat_rate') == 'flat_rate'): ?> checked <?php endif; ?>>
                                        </span>
                                      </li>
                                      <li class="list-group-item border-none flat_rate_shipping_div" <?php if(old('flat_rate') != 'flat_rate'): ?> style="display: none" <?php endif; ?>>
                                        <?php echo e(trans('labels.shipping_cost')); ?>

                                        <span class="float-right">
                                          <input type="text" class="form-control" id="shipping_cost" name="shipping_cost" placeholder="<?php echo e(trans('placeholder.shipping_cost')); ?>" value="0">
                                          <?php $__errorArgs = ['shipping_cost'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </span>
                                      </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0"><?php echo e(trans('labels.return_policy')); ?></h6>
                            </div>
                            <div class="card-body">
                                <div class="px-3">
                                  <ul class="list-group list-group-flush">
                                      <li class="list-group-item border-none"><?php echo e(trans('labels.is_return_available')); ?>

                                        <span class="float-right">
                                          <input type="checkbox" class="big-checkbox" name="is_return" id="is_return" value="is_return" <?php if(old('is_return') == 'is_return'): ?> checked <?php endif; ?>>
                                        </span>
                                      </li>
                                      <li class="list-group-item border-none is_return_div"  <?php if(old('is_return') != 'is_return'): ?> style="display: none" <?php endif; ?>>
                                        <?php echo e(trans('labels.days')); ?>

                                        <span class="float-right">
                                          <input type="text" class="form-control" id="return_days" name="return_days" placeholder="<?php echo e(trans('placeholder.return_days')); ?>" value="0">
                                          <?php $__errorArgs = ['return_days'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </span>
                                      </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0"><?php echo e(trans('labels.featured')); ?></h6>
                            </div>
                            <div class="card-body">
                                <div class="px-3">
                                  <ul class="list-group list-group-flush">
                                    <li class="list-group-item border-none"><?php echo e(trans('labels.status')); ?>

                                      <span class="float-right">
                                        <input type="checkbox" class="big-checkbox" name="is_featured" id="is_featured" value="is_featured" <?php if(old('is_featured') == 'is_featured'): ?> checked <?php endif; ?>>
                                      </span>
                                    </li>
                                  </ul>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0"><?php echo e(trans('labels.hot_deals')); ?></h6>
                            </div>
                            <div class="card-body">
                                <div class="px-3">
                                  <ul class="list-group list-group-flush">
                                    <li class="list-group-item border-none"><?php echo e(trans('labels.status')); ?>

                                      <span class="float-right">
                                        <input type="checkbox" class="big-checkbox" class="big-checkbox" name="is_hot" id="is_hot" value="is_hot" <?php if(old('is_hot') == 'is_hot'): ?> checked <?php endif; ?>>
                                      </span>
                                    </li>
                                  </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0"><?php echo e(trans('labels.low_stoke_qty_warning')); ?></h6>
                            </div>
                            <div class="card-body">
                                <div class="px-3">
                                    <div class="form-group row">
                                      <label for="available_stock" class="col-sm-4 col-form-label"><?php echo e(trans('labels.qty')); ?></label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control" id="available_stock" name="available_stock" placeholder="<?php echo e(trans('placeholder.available_stock')); ?>" value="0">
                                        <?php $__errorArgs = ['available_stock'];
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
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0"><?php echo e(trans('labels.estimate_shipping_time')); ?></h6>
                            </div>
                            <div class="card-body">
                                <div class="px-3">
                                    <div class="form-group row">
                                      <label for="est_shipping_days" class="col-sm-4 col-form-label"><?php echo e(trans('labels.days')); ?></label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control" id="est_shipping_days" name="est_shipping_days" placeholder="<?php echo e(trans('placeholder.est_shipping_days')); ?>" value="0">
                                        <?php $__errorArgs = ['est_shipping_days'];
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
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0"><?php echo e(trans('labels.vat_and_tax')); ?></h6>
                            </div>
                            <div class="card-body">
                                <div class="px-3">
                                    <div class="form-group row">
                                      <label for="" class="col-sm-4 col-form-label"><?php echo e(trans('labels.vat')); ?></label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control" id="tax" name="tax" placeholder="<?php echo e(trans('placeholder.tax')); ?>" value="0">
                                        <?php $__errorArgs = ['tax'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                        <select class="form-control mt-3" name="tax_type" id="tax_type">
                                            <option value="amount"><?php echo e(trans('labels.flat')); ?></option>
                                            <option value="percent"><?php echo e(trans('labels.percent')); ?></option>
                                        </select>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="text-right">
                        <a href="<?php echo e(route('admin.products')); ?>" class="btn btn-raised btn-warning mr-1">
                            <i class="ft-x"></i> <?php echo e(trans('labels.cancel')); ?>

                        </a>
                        <?php if(env('Environment') == 'sendbox'): ?>
                            <button type="button" class="btn btn-raised btn-primary" onclick="myFunction()"> <i class="fa fa-check-square-o"></i> <?php echo e(trans('labels.save')); ?></button>
                        <?php else: ?>
                            <button type="submit" id="btn_add_category" class="btn btn-raised btn-primary"> <i class="fa fa-check-square-o"></i> <?php echo e(trans('labels.save')); ?></button>
                        <?php endif; ?>
                    </div>
                </div>                
            </form>
        </section>
    </div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripttop'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript">
  var variationdata = 1;
  function variation_fields() {
   
      variationdata++;
      var objTo = document.getElementById('variation_fields')
      var divtest = document.createElement("div");
      divtest.setAttribute("class", "row variation removeclass"+variationdata);
      var rdiv = 'removeclass'+variationdata;
      divtest.innerHTML = '<div class="col-sm-3 nopadding"> <div class="form-group"> <label for="variation" class="col-form-label">Variation</label> <input type="text" class="form-control" name="variation[]" id="variation" placeholder="Variation" > </div></div><div class="col-sm-3 nopadding"> <div class="form-group"> <label for="price" class="col-form-label">Price</label> <input type="text" class="form-control" id="price" name="price[]" pattern="[0-9]+" placeholder="Price" > </div></div><div class="col-sm-3 nopadding"> <div class="form-group"> <label for="discounted_variation_price" class="col-form-label">Discounted Price</label> <input type="text" class="form-control" id="discounted_variation_price" name="discounted_variation_price[]" pattern="[0-9]+" placeholder="<?php echo e(trans('placeholder.discounted_price')); ?>"> </div></div><div class="col-sm-2 nopadding"> <div class="form-group"> <label for="qty" class="col-form-label"><?php echo e(trans('labels.qty')); ?></label> <input type="text" class="form-control" name="qty[]" pattern="[0-9]+" id="qty"> </div></div><div class="col-sm-1 nopadding"> <div class="form-group"> <div class="input-group"> <div class="input-group-btn pt-30"> <button class="btn btn-danger" type="button" onclick="remove_variation_fields('+ variationdata +');"> - </button> </div></div></div></div><div class="clear"></div>';
      
      objTo.appendChild(divtest)
  }
  function remove_variation_fields(rid) {
     $('.removeclass'+rid).remove();
  }

  $(document).ready(function($) {
      $("#cat_id").change(function () {
          var cat_id = $("#cat_id").val();
          $.ajax({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              type:'POST',
              url:"<?php echo e(route('admin.products.subcat')); ?>",
              data:{      
              'cat_id':cat_id
              },
              dataType: "json",
              success: function(response) {
                  let html ='';
                  html = '<option value=""><?php echo e(trans('placeholder.select_subcategory')); ?></option>';
                  for(i in response){              
                      html+='<option value="'+response[i].id+'">'+response[i].subcategory_name+'</option>'
                  }
                  $('#subcat_id').html(html);
              },              
          });
      });

      $("#subcat_id").change(function () {
          var subcat_id = $("#subcat_id").val();
          $.ajax({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              type:'POST',
              url:"<?php echo e(route('admin.products.innersubcat')); ?>",
              data:{      
              'subcat_id':subcat_id
              },
              dataType: "json",
              success: function(response) {
                  let html ='';
                  html = '<option value=""><?php echo e(trans('placeholder.select_innersubcategory')); ?></option>';
                  for(i in response){              
                      html+='<option value="'+response[i].id+'">'+response[i].innersubcategory_name+'</option>'
                  }
                  $('#innersubcat_id').html(html);
              },              
          });
      });
  });

  $(document).ready(function(){
      $('.is_variation').change(function(){
          if(this.checked) {
              $('.variation').fadeIn('slow');
              $('.default_price').fadeOut('slow');
          } else {
              $('.variation').fadeOut('slow');
              $('.default_price').fadeIn('slow');
          }
      });
  });

  $(document).ready(function() {
      var imagesPreview = function(input, placeToInsertImagePreview) {
          if (input.files) {
              var filesAmount = input.files.length;
              $('div.gallery').html('');
              var n=0;
              for (i = 0; i < filesAmount; i++) {
                  var reader = new FileReader();
                  reader.onload = function(event) {
                      $($.parseHTML('<div>')).attr('class', 'imgdiv').attr('id','img_'+n).html('<img src="'+event.target.result+'" class="img-fluid">').appendTo(placeToInsertImagePreview); 
                      n++;
                  }
                  reader.readAsDataURL(input.files[i]);                                  
              }
          }
      };

      $('#image').on('change', function() {
          imagesPreview(this, 'div.gallery');
      });
  });
  var images = [];
  function removeimg(id){
      images.push(id);
      $("#img_"+id).remove();
      $('#remove_'+id).remove();
      $('#removeimg').val(images.join(","));
      input.replaceWith(input.val('').clone(true));
  }

  $("#price").on("keypress keyup blur",function (event) {
      $(this).val($(this).val().replace(/[^0-9\.|\,]/g,''));
      // debugger;
      if(event.which == 44)
      {
          return true;
      }
      if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57  )) {
          event.preventDefault();
      }
  });

  $(document).ready(function(){

      $("#free_shipping").on("change",function(){
          $('#flat_rate').prop('checked', false); // Unchecks it
          $(".flat_rate_shipping_div").hide();
      });

      $("#flat_rate").on('change', function() {
          if ($(this).is(':checked')) {
              $(".flat_rate_shipping_div").show();
              $('#free_shipping').prop('checked', false); // Unchecks it
          }
          else {
             $(".flat_rate_shipping_div").hide();
          }
      });

      $("#is_return").on('change', function() {
          if ($(this).is(':checked')) {
              $(".is_return_div").show();
              $('#free_shipping').prop('checked', false); // Unchecks it
          }
          else {
             $(".is_return_div").hide();
          }
      });
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/eglobalm/public_html/resources/views/Admin/products/add.blade.php ENDPATH**/ ?>