<!DOCTYPE html>
<html>
    <head>
        <?php if($allsettings->site_favicon != ''): ?>
        <link rel="apple-touch-icon" href="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_favicon); ?>">
        <link rel="shortcut icon" href="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_favicon); ?>">
        <?php endif; ?>
        <title><?php echo e($allsettings->m_mode_title); ?></title>
        <link rel="stylesheet" href="<?php echo e(asset('public/assets/css/503.css')); ?>">
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title"><?php echo e($allsettings->m_mode_content); ?></div>
            </div>
        </div>
    </body>
</html><?php /**PATH D:\xampp\htdocs\fickrr\resources\views/503.blade.php ENDPATH**/ ?>