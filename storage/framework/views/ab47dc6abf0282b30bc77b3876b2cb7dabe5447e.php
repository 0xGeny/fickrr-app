<?php if($allsettings->maintenance_mode == 0): ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title><?php echo e(Helper::translation(3207,$translate)); ?> - <?php echo e($allsettings->site_title); ?></title>
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
            <h2 class="h3 pt-2 pb-4 mb-4 text-center text-sm-left border-bottom"><?php echo e(Helper::translation(3207,$translate)); ?><span class="badge badge-secondary font-size-sm text-body align-middle ml-2"><?php echo e($countreview); ?></span></h2>
        <div class="row pt-2">
        <div class="col-lg-12 col-md-12 col-sm-12 px-2 mb-grid-gutter">
        <?php $__currentLoopData = $ratingview['list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="product-review pb-4 mb-4 border-bottom prod-item" data-aos="fade-up" data-aos-delay="200">
                <div class="d-flex mb-3">
                  <div class="media media-ie-fix align-items-center mr-4 pr-2">
                                    <a href="<?php echo e(url('/user')); ?>/<?php echo e($review->username); ?>">
                                    <?php if($review->user_photo != ''): ?>
                                    <img class="rounded-circle" width="50" src="<?php echo e(url('/')); ?>/public/storage/users/<?php echo e($review->user_photo); ?>" alt="<?php echo e($review->username); ?>">
                                    <?php else: ?>
                                    <img src="<?php echo e(url('/')); ?>/public/img/no-user.png" alt="<?php echo e($review->username); ?>" class="rounded-circle" width="50">
                                    <?php endif; ?>
                                    </a>
                      <div class="media-body pl-3">
                      <a href="<?php echo e(url('/user')); ?>/<?php echo e($review->username); ?>">
                      <h6 class="font-size-sm mb-0">
                      <?php echo e($review->username); ?> 
                      </h6>
                      </a>
                      <a href="<?php echo e(url('/item')); ?>/<?php echo e($review->item_slug); ?>/<?php echo e($review->item_id); ?>" class="theme-color"><?php echo e($review->item_name); ?></a><br/>
                      <span class="font-size-ms text-muted"><?php echo e(date('F d Y, h:i:s', strtotime($review->rating_date))); ?></span></div>
                  </div>
                  <div class="user-review" align="center">
                    <div class="star-rating" align="center">
                    <?php if($review->rating == 0): ?>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <?php endif; ?>
                    <?php if($review->rating == 1): ?>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <?php endif; ?>
                    <?php if($review->rating == 2): ?>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <?php endif; ?>
                    <?php if($review->rating == 3): ?>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <?php endif; ?>
                    <?php if($review->rating == 4): ?>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star"></i>
                    <?php endif; ?>
                    <?php if($review->rating == 5): ?>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <?php endif; ?>
                    </div>
                    <div class="review_tag"><?php echo e($review->rating_reason); ?></div>
                  </div>
                </div>
                <p class="font-size-md mb-2"><?php echo e($review->rating_comment); ?></p>
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
<?php endif; ?><?php /**PATH /var/www/html/resources/views/user-reviews.blade.php ENDPATH**/ ?>