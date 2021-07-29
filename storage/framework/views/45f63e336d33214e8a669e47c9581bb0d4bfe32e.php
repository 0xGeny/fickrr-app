<?php echo $__env->make('version', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="author" content="<?php echo e($allsettings->site_title); ?>">
<?php if($allsettings->site_favicon != ''): ?>
<link rel="apple-touch-icon" href="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_favicon); ?>">
<link rel="shortcut icon" href="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_favicon); ?>">
<?php endif; ?>
<link rel="stylesheet" href="<?php echo e(URL::to('resources/views/theme/validate/themes/red/red.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(URL::to('resources/views/theme/pagination/pagination.css')); ?>">
<link rel="stylesheet" media="screen" href="<?php echo e(URL::to('resources/views/theme/css/vendor.min.css')); ?>">
<link rel="stylesheet" media="screen" href="<?php echo e(URL::to('resources/views/theme/css/theme.min.css')); ?>">
<?php echo $__env->make('dynamic', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<link type="text/css" href="<?php echo e(URL::to('resources/views/theme/countdown/jquery.countdown.css?v=1.0.0.0')); ?>" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo e(URL::to('resources/views/theme/video/video.css')); ?>">
<link href="<?php echo e(URL::to('resources/views/theme/cookie/cookiealert.css')); ?>" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="<?php echo e(URL::to('resources/views/theme/animate/aos.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(URL::to('resources/views/theme/autosearch/jquery-ui.css')); ?>">
<link rel="stylesheet" href="<?php echo e(URL::to('resources/views/admin/template/datepicker/picker.css')); ?>">
<link href="<?php echo e(asset('resources/views/admin/template/dragdrop/css/jquery.filer.css')); ?>" rel="stylesheet">
<?php if($translate == 'ar'): ?>
<link rel="stylesheet" href="<?php echo e(URL::to('resources/views/theme/css/rtl.css')); ?>" />
<?php endif; ?>
<link rel="stylesheet" href="<?php echo e(URL::to('resources/views/theme/css/font-awesome.min.css')); ?>">
<?php /**PATH D:\xampp\htdocs\fickrr\resources\views/style.blade.php ENDPATH**/ ?>