<?php if($allsettings->maintenance_mode == 0): ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title><?php echo e(Helper::translation(3200,$translate)); ?> - <?php echo e($allsettings->site_title); ?></title>
<?php echo $__env->make('meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('user-box', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="container mb-5 pb-3">
      <div class="bg-light box-shadow-lg rounded-lg overflow-hidden">
        <div class="row">
          <!-- Sidebar-->
          <?php echo $__env->make('user-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <!-- Content-->
          <section class="col-lg-8 pt-lg-4 pb-md-4">
            <div class="pt-2 px-4 pl-lg-0 pr-xl-5">
            <h2 class="h3 pt-2 pb-4 mb-4 text-center text-sm-left border-bottom"><?php if($followingcount <= 1): ?> <?php echo e(Helper::translation(3200,$translate)); ?> <?php else: ?> <?php echo e(Helper::translation(3201,$translate)); ?> <?php endif; ?><span class="badge badge-secondary font-size-sm text-body align-middle ml-2"><?php echo e($followingcount); ?></span></h2>
        <div class="row pt-2">
        <div class="col-lg-12 col-md-12 col-sm-12 px-2 mb-grid-gutter">
        <?php $__currentLoopData = $viewfollowing['view']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $follower): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="d-sm-flex justify-content-between mt-lg-4 mb-4 pb-3 pb-sm-2 border-bottom prod-item" data-aos="fade-up" data-aos-delay="200">
            <div class="media media-ie-fix d-block d-sm-flex text-sm-left">
            <a href="<?php echo e(url('/user')); ?>/<?php echo e($follower->username); ?>" class="d-inline-block mx-auto mr-sm-4" style="width: 7rem;">
            <?php if($follower->user_photo != ''): ?>
            <img src="<?php echo e(url('/')); ?>/public/storage/users/<?php echo e($follower->user_photo); ?>" alt="<?php echo e($follower->username); ?>" class="img-rounded">
            <?php else: ?>
            <img src="<?php echo e(url('/')); ?>/public/img/no-user.png" alt="<?php echo e($follower->username); ?>" class="img-rounded">
            <?php endif; ?>
            </a>
              <div class="media-body pt-2">
                <h3 class="product-title font-size-base mb-2">
                 <a href="<?php echo e(url('/user')); ?>/<?php echo e($follower->username); ?>"><?php echo e($follower->username); ?> <?php if($follower->verified == 1): ?> <span class="badges-success"><i class="dwg-check-circle danger"></i> <?php echo e(Helper::translation(5202,$translate)); ?></span> <?php else: ?> <span class="badges-danger"><i class="dwg-close-circle danger"></i> <?php echo e(Helper::translation(5205,$translate)); ?></span> <?php endif; ?></a>
                 </h3>
                <div class="font-size-sm"><?php echo e(Helper::translation(3077,$translate)); ?>: <?php echo e(date("F Y", strtotime($follower->created_at))); ?></div>
                <div class="font-size-sm"><?php echo e(Helper::translation(3199,$translate)); ?> : <?php if($follower->country !=''): ?> <?php echo e($follower->country_name); ?> <?php else: ?> - <?php endif; ?></div>
              </div>
            </div>
            <div class="pt-2 pl-sm-3 mx-auto mx-sm-0 text-center">
             <a href="<?php echo e(url('/user')); ?>/<?php echo e($follower->username); ?>" class="btn btn-primary btn-sm"><?php echo e(Helper::translation(3078,$translate)); ?></a>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        </div>
        <div class="row mb-3">
       <div class="col-md-12  text-right">
            <div class="turn-page" id="itempager"></div>
       </div>         
       </div>
       </div>
        </section>
        </div>
      </div>
    </div>
<?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php else: ?>
<?php echo $__env->make('503', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?><?php /**PATH D:\xampp\htdocs\fickrr\resources\views/user-following.blade.php ENDPATH**/ ?>