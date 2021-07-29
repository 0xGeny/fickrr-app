<?php if($allsettings->maintenance_mode == 0): ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>
<?php if($allsettings->site_selling_display == 1): ?> 
<?php if(Auth::guest()): ?>
<?php echo e(Helper::translation(3018,$translate)); ?>

<?php else: ?>
<?php if(Auth::user()->user_type == 'vendor'): ?>
<?php echo e(Helper::translation(3018,$translate)); ?>

<?php else: ?>
<?php echo e(Helper::translation(2860,$translate)); ?> 
<?php endif; ?>
<?php endif; ?> 
<?php else: ?> 
<?php echo e(Helper::translation(2860,$translate)); ?> 
<?php endif; ?> - <?php echo e($allsettings->site_title); ?>

</title>
<?php echo $__env->make('meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php if($allsettings->site_selling_display == 1): ?>
<?php if(Auth::guest()): ?>
<?php echo $__env->make('selling', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php else: ?>
<?php if(Auth::user()->user_type == 'vendor'): ?>
<?php echo $__env->make('selling', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php else: ?>
<?php echo $__env->make('not-found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php endif; ?>
<?php else: ?>
<?php echo $__env->make('not-found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php else: ?>
<?php echo $__env->make('503', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?><?php /**PATH D:\xampp\htdocs\fickrr\resources\views/start-selling.blade.php ENDPATH**/ ?>