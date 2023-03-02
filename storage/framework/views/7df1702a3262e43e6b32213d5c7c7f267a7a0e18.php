<head>
    <meta charset="utf-8" />
    <meta name="author" content="infotechgravity.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" id="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <meta property="og:title" content="<?php echo e(Helper::webinfo()->meta_title); ?>" />
    <meta property="og:description" content="<?php echo e(Helper::webinfo()->meta_description); ?>" />
    <meta property="og:image" content='<?php echo e(Helper::webinfo()->og_image); ?>' />

    <!-- favicon-icon  -->
    <link rel="icon" href='<?php echo e(Helper::webinfo()->favicon); ?>' type="image/x-icon">
    
    <title><?php echo $__env->yieldContent('title'); ?></title>
     
    <!-- Custom CSS -->
    <link href="<?php echo e(asset('storage/app/public/Webassets/css/styles.css')); ?>" rel="stylesheet">
    <link href="<?php echo asset('storage/app/public/Webassets/sweetalert/css/sweetalert.css'); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('storage/app/public/Webassets/css/toasty.css')); ?>" rel="stylesheet" />
</head><?php /**PATH E:\Laravel_Rcreation\eglobalmart\resources\views/includes/web/head.blade.php ENDPATH**/ ?>