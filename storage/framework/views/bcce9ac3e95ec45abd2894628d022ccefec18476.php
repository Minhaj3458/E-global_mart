<!-- ============================ Call To Action ================================== -->
<section class="theme-bg call_action_wrap-wrap">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        
        <div class="call_action_wrap">
          <div class="call_action_wrap-head">
            <h3><?php echo e(trans('labels.subscribe_newsletter')); ?></h3>
            <span><?php echo e(trans('labels.subscribe_newsletter_text')); ?></span>
          </div>
          <div class="newsletter_box">
            <form method="post" action="<?php echo e(URL::to('/subscribe')); ?>">
              <?php echo csrf_field(); ?>
              <div class="input-group">
                <input type="text" class="form-control" name="subscribe" placeholder="Enter email to Subscribe ...">
                <div class="input-group-append">
                  <button class="btn search_btn" type="submit"><i class="fas fa-arrow-alt-circle-right"></i></button>
                </div>
              </div>
              <?php $__errorArgs = ['subscribe'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </form>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</section>
<!-- ============================ Call To Action End ================================== -->
<!-- ============================ Footer Start ================================== -->
<footer class="dark-footer skin-dark-footer style-2">
  <div class="before-footer">
    <div class="container">
      <div class="row">
    
        <div class="col-lg-4 col-md-4">
          <div class="single_facts">
            <div class="facts_icon">
              <i class="ti-shopping-cart"></i>
            </div>
            <div class="facts_caption">
              <h4><?php echo e(trans('labels.home_delivery')); ?></h4>
              <p><?php echo e(trans('labels.home_delivery_text')); ?></p>
            </div>
          </div>
        </div>
        
        <div class="col-lg-4 col-md-4">
          <div class="single_facts">
            <div class="facts_icon">
              <i class="ti-money"></i>
            </div>
            <div class="facts_caption">
              <h4><?php echo e(trans('labels.money_back_guarantee')); ?></h4>
              <p><?php echo e(trans('labels.money_back_guarantee_text')); ?></p>
            </div>
          </div>
        </div>
        
        <div class="col-lg-4 col-md-4">
          <div class="single_facts last">
            <div class="facts_icon">
              <i class="ti-headphone-alt"></i>
            </div>
            <div class="facts_caption">
              <h4><?php echo e(trans('labels.online_support')); ?></h4>
              <p><?php echo e(trans('labels.online_support_text')); ?></p>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
  
  <div class="footer-middle">
    <div class="container">
      <div class="row">
        
        <div class="col-lg-3 col-md-4">
          <div class="footer_widget">
            <h4 class="extream"><?php echo e(trans('labels.contact_info')); ?></h4>
            
            <div class="address_infos">
              <ul>
                <li><i class="ti-home theme-cl"></i><?php echo e(Helper::webinfo()->address); ?></li>
                <li><i class="ti-headphone-alt theme-cl"></i><?php echo e(Helper::webinfo()->contact); ?></li>
                <li><i class="ti-email theme-cl"></i><?php echo e(Helper::webinfo()->email); ?></li>
              </ul>
            </div>
            
          </div>
        </div>
            
        <div class="col-lg-3 col-md-2">
          <div class="footer_widget">
            <h4 class="widget_title"><?php echo e(trans('labels.categories')); ?></h4>
            <ul class="footer-menu">
              <?php $count = 0; ?>
              <?php $__currentLoopData = Helper::getCategory(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($count == 4) break; ?>
                <li><a href="<?php echo e(URL::to('categories/products/'.$category->slug)); ?>"><?php echo e($category->category_name); ?></a></li>
                <?php $count++; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </div>
        </div>
        
        <div class="col-lg-3 col-md-2">
          <div class="footer_widget">
            <h4 class="widget_title"><?php echo e(trans('labels.latest_news')); ?></h4>
            <ul class="footer-menu">
              <li><a <?php if(Auth::user()): ?> href="<?php echo e(URL::to('offers')); ?>" <?php else: ?> href="<?php echo e(URL::to('signin')); ?>" <?php endif; ?>><?php echo e(trans('labels.offers_deals')); ?></a></li>
              <li><a <?php if(Auth::user()): ?> href="<?php echo e(URL::to('order-history')); ?>" <?php else: ?> href="<?php echo e(URL::to('signin')); ?>" <?php endif; ?>><?php echo e(trans('labels.orders')); ?></a></li>
              <li><a <?php if(Auth::user()): ?> href="<?php echo e(URL::to('wishlist')); ?>" <?php else: ?> href="<?php echo e(URL::to('signin')); ?>" <?php endif; ?>><?php echo e(trans('labels.wishlist')); ?></a></li>
            </ul>
          </div>
        </div>
        
        <div class="col-lg-3 col-md-2">
          <div class="footer_widget">
            <h4 class="widget_title"><?php echo e(trans('labels.customer_support')); ?></h4>
            <ul class="footer-menu">
              <li><a href="<?php echo e(URL::to('about-us')); ?>"><?php echo e(trans('labels.about_us')); ?></a></li>
              <li><a href="<?php echo e(URL::to('terms-conditions')); ?>"><?php echo e(trans('labels.terms_conditions')); ?></a></li>
              <li><a href="<?php echo e(URL::to('privacy-policy')); ?>"><?php echo e(trans('labels.privacy_policy')); ?></a></li>
              <li><a <?php if(Auth::user()): ?> href="<?php echo e(URL::to('help')); ?>" <?php else: ?> href="<?php echo e(URL::to('signin')); ?>" <?php endif; ?>><?php echo e(trans('labels.help')); ?></a></li>
            </ul>
          </div>
        </div>
        
      </div>
    </div>
  </div>
  
  <div class="footer-bottom">
    <div class="container">
      <div class="row align-items-center">
        
        <div class="col-lg-6 col-md-8">
          <p class="mb-0"><?php echo e(Helper::webinfo()->copyright); ?></p>
        </div>
        
        <div class="col-lg-6 col-md-6 text-right">
          <ul class="footer_social_links">
            <?php if(Helper::webinfo()->facebook != ""): ?>
            <li><a href="<?php echo e(Helper::webinfo()->facebook); ?>" target="_blank"><i class="ti-facebook"></i></a></li>
            <?php endif; ?>
            <?php if(Helper::webinfo()->twitter != ""): ?>
            <li><a href="<?php echo e(Helper::webinfo()->twitter); ?>" target="_blank"><i class="ti-twitter"></i></a></li>
            <?php endif; ?>
            <?php if(Helper::webinfo()->instagram != ""): ?>
            <li><a href="<?php echo e(Helper::webinfo()->instagram); ?>" target="_blank"><i class="ti-instagram"></i></a></li>
            <?php endif; ?>
            <?php if(Helper::webinfo()->linkedin != ""): ?>
            <li><a href="<?php echo e(Helper::webinfo()->linkedin); ?>" target="_blank"><i class="ti-linkedin"></i></a></li>
            <?php endif; ?>
          </ul>
        </div>
        
      </div>
    </div>
  </div>
</footer>
<!-- ============================ Footer End ================================== -->
      <!-- cart -->
      <div id="cart-display">
        <?php echo $__env->make('includes.web.cart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
      <!-- cart -->
      <!-- Product View -->
      <div class="modal fade" id="viewproduct-over" tabindex="-1" role="dialog" aria-labelledby="add-payment" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content" id="view-product">
            <span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
            <div class="modal-body">
              <div class="row align-items-center">
          
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="sp-wrap gallerys">
                </div>
              </div>
              
              <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="woo_pr_detail">
                  
                  <div class="woo_cats_wrps">
                    <a href="#" class="woo_pr_cats" id="category_name"></a>
                    <span class="woo_pr_trending"><?php echo e(trans('labels.trending')); ?></span>
                  </div>
                  <h2 class="woo_pr_title" id="product_name"></h2>
                  
                  <div class="woo_pr_reviews">
                    <div class="woo_pr_rating">
                      <i class="fa fa-star filled"></i>
                      <i class="fa fa-star filled"></i>
                      <i class="fa fa-star filled"></i>
                      <i class="fa fa-star filled"></i>
                      <i class="fa fa-star"></i>
                      <span class="woo_ave_rat">4.8</span>
                    </div>
                    <div class="woo_pr_total_reviews">
                      <a href="#"><?php echo e(trans('labels.random_reviews_count')); ?></a>
                    </div>
                  </div>
                  
                  <div class="woo_pr_price">
                    <div class="woo_pr_offer_price">
                      <h3 id="discounted_price"></h3> <span id="product_price" class="org_price"></span>
                    </div>
                  </div>
                  
                  <div class="woo_pr_short_desc">
                    <p id="description"></p>
                  </div>
                  
                  <div class="woo_pr_color flex_inline_center mb-3">
                    <div class="woo_pr_varient">
                      
                    </div>
                    <div class="woo_colors_list pl-3">
                      <span id="variation"></span>
                      <?php echo e($errors->login->first('variation')); ?>

                    </div>
                  </div>
                  
                  <div class="woo_btn_action">
                    <div class="col-12 col-lg-auto">
                      <button type="submit" class="btn btn-block btn-dark mb-2"><?php echo e(trans('labels.add_cart')); ?><i class="ti-shopping-cart-full ml-2"></i></button>
                    </div>
                    <div class="col-12 col-lg-auto">
                      <button class="btn btn-gray btn-block mb-2" data-toggle="button"><?php echo e(trans('labels.wishlist')); ?> <i class="ti-heart ml-2"></i></button>
                    </div>
                  </div>
                  
                </div>
              </div>
              
            </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Modal -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <?php /**PATH E:\Laravel_Rcreation\eglobalmart\resources\views/includes/web/footer.blade.php ENDPATH**/ ?>