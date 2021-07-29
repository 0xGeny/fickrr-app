<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo e(Helper::translation(2905,$translate)); ?></title>
</head>
<body class="preload dashboard-upload">
<div class="dashboard_contents">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dashboard_title_area">
                            <div class="pull-left">
                                <div class="dashboard__title">
                                    <h2><?php echo e(Helper::translation(2905,$translate)); ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
               </div>
               <div class="row">
                    <div class="col-lg-8 col-md-7">
                        <p><strong> <?php echo e(Helper::translation(2906,$translate)); ?> : </strong> <?php echo e($from_name); ?></p>   
                        <p><strong> <?php echo e(Helper::translation(2907,$translate)); ?> : </strong> <?php echo e($from_email); ?></p>
                        <p><strong> <?php echo e(Helper::translation(2908,$translate)); ?> : </strong> <a href="<?php echo e($item_url); ?>"><?php echo e($item_url); ?></a></p>
                        <p><strong> <?php echo e(Helper::translation(2909,$translate)); ?> : </strong> <?php echo e($comm_text); ?></p>   
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html><?php /**PATH D:\xampp\htdocs\fickrr\resources\views/comment_mail.blade.php ENDPATH**/ ?>