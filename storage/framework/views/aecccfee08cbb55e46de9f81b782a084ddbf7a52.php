<!-- ============================================================== -->
<!-- Top header  -->
<!-- ============================================================== -->
<!-- Start Navigation -->
<div class="header">
    <div class="header_topbar light">
        <div class="container">
            <div class="row">
            
                <div class="col-lg-6 col-md-6 col-sm-6 col-4">
                    <!--<ul class="tp-list nbr ml-2">-->
                    <!--    <li class="dropdown dropdown-currency hidden-xs hidden-sm">-->
                    <!--        <select class="tp-list nbr ml-2 changeLang">-->
                    <!--            <option value="en" <?php echo e(session()->get('locale') == 'en' ? 'selected' : ''); ?>><?php echo e(trans('labels.ltr')); ?></option>-->
                    <!--            <option value="ar" <?php echo e(session()->get('locale') == 'ar' ? 'selected' : ''); ?>><?php echo e(trans('labels.rtl')); ?></option>-->
                    <!--        </select>-->
                    <!--    </li>-->
                    <!--</ul>-->
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-8">
                    <?php if(@Auth::user()->id != ""): ?>
                    <div class="topbar_menu">
                        <ul <?php if(session()->get('locale') == 'en' OR session()->get('locale') == ''): ?> style="float: right;" <?php endif; ?>>
                            <li class="hide-m"><a href="<?php echo e(URL::to('order-history')); ?>"><i class="ti-bag"></i><?php echo e(trans('labels.account')); ?></a></li>
                            <li><a href="<?php echo e(URL::to('wishlist')); ?>"><i class="ti-heart"></i><?php echo e(trans('labels.wishlist')); ?></a></li>
                            <li><a href="<?php echo e(URL::to('logout')); ?>"><i class="ti-key"></i><?php echo e(trans('labels.logout')); ?></a></li>
                        </ul>
                    </div>
                    <?php else: ?>
                    <div class="topbar_menu">
                        <ul <?php if(session()->get('locale') == 'en' OR session()->get('locale') == ''): ?> style="float: right;" <?php endif; ?>>
                            <li><a href="<?php echo e(URL::to('signin')); ?>"><i class="ti-user"></i><?php echo e(trans('labels.login')); ?></a></li>
                            <li><a href="<?php echo e(URL::to('vendor-signup')); ?>"><i class="ti-users"></i><?php echo e(trans('labels.become_vendor')); ?></a></li>
                        </ul>
                    </div>
                    <?php endif; ?>                   
                </div>
            
            </div>
        </div>
    </div>
    
    <!-- Main header -->
    <div class="main_header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-2 col-md-2 col-sm-3 col-4 mt-2">
                    <a class="nav-brand" href="<?php echo e(URL::to('/')); ?>">
                        <img src="<?php echo e(Helper::webinfo()->image); ?>" class="logo" alt="" />
                    </a>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-9 col-8">
                    <!-- Show on Mobile & iPad -->
                    <div class="blocks shop_cart d-xl-none d-lg-none">
                        <div class="single_shop_cart">
                            <div class="ss_cart_left">
                                <a class="cart_box" data-toggle="collapse" href="#mySearch" role="button" aria-expanded="false" aria-controls="mySearch"><i class="ti-search"></i></a>
                            </div>
                        </div>
                        <div class="single_shop_cart">
                            <div class="ss_cart_left">
                                <?php if(@Auth::user()->id != ""): ?>
                                    <?php if(!request()->is('cart') && !request()->is('checkout')): ?>
                                        <a href="#" onclick="openRightMenu()" id="openRightMenu" class="cart_box">
                                    <?php else: ?>
                                        <a href="#" class="cart_box">
                                    <?php endif; ?>
                                        <span class="qut_counter"><?php echo e(Storage::disk('local')->get("cart")); ?></span><i class="ti-shopping-cart"></i>
                                    </a>
                                <?php else: ?>
                                    <a href="#"  onclick="openRightMenu()" id="openRightMenu" class="cart_box"><span class="qut_counter">0</span><i class="ti-shopping-cart"></i></a>
                                <?php endif; ?>
                            </div>
                            <div class="ss_cart_content">
                                <strong><?php echo e(trans('labels.my_cart')); ?></strong>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Show on Desktop -->
                    <div class="blocks shop_cart d-none d-xl-block d-lg-block" <?php if(session()->get('locale') == 'en' OR session()->get('locale') == ''): ?> style="float: right;" <?php endif; ?>>
                        <div class="single_shop_cart">
                            <div class="ss_cart_left">
                                <?php if(@Auth::user()->id != ""): ?>
                                    <?php if(!request()->is('cart') && !request()->is('checkout')): ?>
                                        <a href="#" onclick="openRightMenu()" id="openRightMenu" class="cart_box">
                                    <?php else: ?>
                                        <a href="#" class="cart_box">
                                    <?php endif; ?>
                                        <span class="qut_counter"><?php echo e(Storage::disk('local')->get("cart")); ?></span><i class="ti-shopping-cart"></i>
                                    </a>
                                <?php else: ?>
                                    <a href="#"  onclick="openRightMenu()" id="openRightMenu" class="cart_box"><span class="qut_counter">0</span><i class="ti-shopping-cart"></i></a>
                                <?php endif; ?>
                            </div>
                            <div class="ss_cart_content">
                                <strong><?php echo e(trans('labels.my_cart')); ?></strong>
                            </div>
                        </div>
                    </div>
                    
                    <div class="blocks search_blocks d-none d-xl-block d-lg-block ml-5">
                        <form method="get" action="<?php echo e(URL::to('/search')); ?>">
                            <div class="input-group">
                                <input type="text" name="item" class="form-control" id="search-box" placeholder="Search entire store here..." style="border-radius: 0px !important;" autocomplete="off">
                                <div class="input-group-append">
                                    <button class="btn search_btn" type="submit" style="border-radius: 0px !important;"><i class="ti-search"></i></button>
                                </div>
                                <div id="countryList" class="item-list"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="collapse" id="mySearch">
            <div class="blocks search_blocks">
                <form method="get" action="<?php echo e(URL::to('/search')); ?>">
                    <div class="input-group">
                        <input type="text" name="item" class="form-control" id="mobile-search-box" placeholder="Search entire store here..." style="border-radius: 0px !important;" autocomplete="off">
                        <div class="input-group-append">
                            <button class="btn search_btn" type="submit" style="border-radius: 0px !important;"><i class="ti-search"></i></button>
                        </div>
                        <div id="ProductSuggestions" class="item-list"></div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
    
    <div class="header_nav">
        <div class="container"> 
            <div class="row align-item-center">
                <div class="col-lg-3 col-md-4 col-sm-8 col-10">
                    <!-- For Desktop -->
                    <div class="shopby_categories d-none d-xl-block d-lg-block">
                        <a class="shop_category" data-toggle="collapse" href="#myCategories" role="button" aria-expanded="false" aria-controls="myCategories"><i class="ti-menu"></i>Shop by categories</a>
                        <div class="collapse" id="myCategories">
                            <div id="cats_menu">
                                <ul>
                                    <?php $count = 0; ?>
                                    <?php $__currentLoopData = Helper::getCategory(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($count == 6) break; ?>
                                        <li class="active has-sub"><a href="<?php echo e(URL::to('categories/products/'.$category->slug)); ?>"><span><?php echo e($category->category_name); ?></span></a>
                                            <ul>
                                                <?php $__currentLoopData = Helper::getSubcategory(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($sub->cat_id==$category->id): ?>
                                                 <li class="has-sub"><a href="<?php echo e(URL::to('subcategories/products/'.$category->slug.'/'.$sub->slug)); ?>"><span><?php echo e($sub->subcategory_name); ?></span></a>
                                                    <ul>
                                                        <?php $__currentLoopData = Helper::InnerSubcategory(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($inner->subcat_id==$sub->id): ?>
                                                        <li><a href="<?php echo e(URL::to('innersubcategories/products/'.$category->slug.'/'.$sub->slug.'/'.$inner->slug)); ?>"><span><?php echo e($inner->innersubcategory_name); ?></span></a></li>
                                                        <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
                                                 </li>
                                                <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                       </li>
                                    <?php $count++; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <li><a href="<?php echo e(URL::to('/categories')); ?>"><span>View All <i class="fa fa-arrow-right" aria-hidden="true"></i></span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Left Collapse navigation -->
                    <div class="w3-ch-sideBar-left w3-bar-block w3-card-2 w3-animate-right"  style="display:none;right:0;" id="leftMenu">
                        <div class="rightMenu-scroll">
                            <div class="flixel">
                                <h4 class="cart_heading">Navigation</h4>
                                <button onclick="closeLeftMenu()" class="w3-bar-item w3-button w3-large"><i class="ti-close"></i></button>
                            </div>
                            
                            <div class="right-ch-sideBar">
                                
                                <div class="side_navigation_collapse">
                                    <div class="d-navigation">
                                        <ul id="side-menu">
                                            <?php $count = 0; ?>
                                            <?php $__currentLoopData = Helper::getCategory(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($count == 6) break; ?>
                                            <li class="dropdown">
                                                <a href="<?php echo e(URL::to('categories/products/'.$category->slug)); ?>"><?php echo e($category->category_name); ?><span class="ti-angle-left"></span></a>
                                                <ul class="nav nav-second-level">
                                                    <?php $__currentLoopData = Helper::getSubcategory(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($sub->cat_id==$category->id): ?>
                                                        <li class="dropdown"><a href="<?php echo e(URL::to('subcategories/products/'.$category->slug.'/'.$sub->slug)); ?>">- <?php echo e($sub->subcategory_name); ?> <span class="ti-angle-left"></span></a>
                                                            <ul class="nav nav-third-level">
                                                            <?php $__currentLoopData = Helper::InnerSubcategory(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($inner->subcat_id==$sub->id): ?>
                                                                <li><a href="<?php echo e(URL::to('innersubcategories/products/'.$category->slug.'/'.$sub->slug.'/'.$inner->slug)); ?>">-- <?php echo e($inner->innersubcategory_name); ?></a></li>
                                                            <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </ul>
                                                        </li>
                                                    <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </li>
                                            <?php $count++; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <li><a href="<?php echo e(URL::to('/categories')); ?>"><span>View All <i class="fa fa-arrow-right" aria-hidden="true"></i></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <!-- Left Collapse navigation -->
                    
                    <!-- For Mobile -->
                    <div class="shopby_categories d-xl-none d-lg-none">
                        <a class="shop_category" href="#" onclick="openLeftMenu()"><i class="ti-menu"></i>Shop By categories</a>
                    </div>
                    
                </div>
                
                <div class="col-lg-9 col-md-8 col-sm-4 col-2">
                    <nav id="navigation" class="navigation navigation-landscape">
                        <div class="nav-header">
                            <div class="nav-toggle"></div>
                        </div>
                        <div class="nav-menus-wrapper" <?php if(session()->get('locale') == 'en' OR session()->get('locale') == ''): ?> style="transition-property: none;float: right;" <?php endif; ?>>
                            <ul class="nav-menu">
                                
                                <li class="<?php echo e(request()->is('/') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('/')); ?>">Home</a></li>
                                <li class="<?php echo e(request()->is('categories') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('/categories')); ?>">All Category</a></li>
                                <li class="<?php echo e(request()->is('new-products') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('/new-products')); ?>">New Products</a></li>
                                
                                <li class="<?php echo e(request()->is('featured-products') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('/featured-products')); ?>">Featured Products</a></li>
                                <li class="<?php echo e(request()->is('hot-products') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('/hot-products')); ?>">Hot Products</a></li>
                                
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        
    </div>
    
</div>
<!-- End Navigation -->
<div class="clearfix"></div>
<!-- ============================================================== -->
<!-- Top header  -->
<!-- ============================================================== --><?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/includes/web/header.blade.php ENDPATH**/ ?>