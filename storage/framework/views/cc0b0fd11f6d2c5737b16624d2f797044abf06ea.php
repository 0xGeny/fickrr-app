<div class="page-title-overlap pt-4" style="background-image: url('<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_banner); ?>');">
      <div class="container d-flex flex-wrap flex-sm-nowrap justify-content-center justify-content-sm-between align-items-center pt-2">
        <div class="media media-ie-fix align-items-center pb-3">
          <div class="img-thumbnail rounded-circle position-relative" style="width: 8rem;">
          <?php if($user['user']->user_photo != ''): ?>
          <img class="rounded-circle" src="<?php echo e(url('/')); ?>/public/storage/users/<?php echo e($user['user']->user_photo); ?>" alt="<?php echo e($user['user']->username); ?>">
          <?php else: ?>
          <img src="<?php echo e(url('/')); ?>/public/img/no-user.png" alt="<?php echo e($user['user']->username); ?>">
          <?php endif; ?>
          </div>
          <div class="media-body pl-3">
            <h3 class="text-light font-size-lg mb-0"><?php echo e($user['user']->username); ?> <?php if($addition_settings->subscription_mode == 1): ?> <?php if($user['user']->user_document_verified == 1): ?> <span class="badges-success"><i class="dwg-check-circle danger"></i> <?php echo e(Helper::translation(5202,$translate)); ?></span> <?php endif; ?> <?php endif; ?></h3>
            <span class="d-block text-light font-size-ms opacity-60 py-1">
            <?php if($user['user']->user_type == 'vendor'): ?>
            <?php if($user['user']->country_badge == 1): ?><?php echo e($country['view']->country_name); ?>,<?php endif; ?> <?php endif; ?> <?php if($user['user']->user_type == 'customer'): ?> <?php if($user['user']->country != ''): ?> <?php echo e($country['view']->country_name); ?>, <?php endif; ?> <?php endif; ?> <?php echo e(Helper::translation(3077,$translate)); ?> <?php echo e($since); ?></span>
            <?php if($user['user']->user_freelance == 1): ?>
            <span class="badge badge-success"><i class="dwg-check mr-1"></i><?php echo e(Helper::translation(3208,$translate)); ?></span>
            <?php endif; ?>
            <?php if(Auth::guest()): ?>
            <div class="mt-2">
            <a class="btn btn-primary btn-sm btn-shadow" href="javascript:void(0);" onClick="alert('<?php echo e(Helper::translation(6099,$translate)); ?>');"><?php echo e(Helper::translation(3202,$translate)); ?></a>
            </div>
            <?php endif; ?>
            <?php if(Auth::check()): ?>
            <?php if($user['user']->username != Auth::user()->username): ?>
            <?php if($followcheck == 0): ?>
            <div class="mt-2">
            <a href="<?php echo e(url('/user')); ?>/<?php echo e(Auth::user()->id); ?>/<?php echo e($user['user']->id); ?>" class="btn btn-primary btn-shadow btn-sm"><?php echo e(Helper::translation(3202,$translate)); ?></a>
            </div>
            <?php else: ?>
            <div class="mt-2">
            <a href="<?php echo e(url('/user')); ?>/unfollow/<?php echo e(Auth::user()->id); ?>/<?php echo e($user['user']->id); ?>" class="btn btn-primary btn-shadow btn-sm"><?php echo e(Helper::translation(3203,$translate)); ?></a>
            </div>
            <?php endif; ?>
            <?php endif; ?>
            <?php endif; ?>
          </div>
        </div>
        <?php if($user['user']->user_type == 'vendor'): ?>
        <div class="d-flex">
          <div class="text-sm-right mr-5">
            <div class="text-light font-size-base"><?php echo e(Helper::translation(3039,$translate)); ?></div>
            <h3 class="text-light"><?php echo e($getsalecount); ?></h3>
          </div>
          <div class="text-sm-right">
            <div class="text-light font-size-base"><?php echo e(Helper::translation(3196,$translate)); ?></div>
            <div class="star-rating">
                    <?php if($count_rating == 0): ?>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <?php endif; ?>
                    <?php if($count_rating == 1): ?>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <?php endif; ?>
                    <?php if($count_rating == 2): ?>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <?php endif; ?>
                    <?php if($count_rating == 3): ?>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <?php endif; ?>
                    <?php if($count_rating == 4): ?>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star"></i>
                    <?php endif; ?>
                    <?php if($count_rating == 5): ?>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <?php endif; ?>
                </div>
            <div class="text-light opacity-60 font-size-xs">(<?php echo e($getreview); ?>)</div>
          </div>
        </div>
        <?php endif; ?>
      </div>
    </div><?php /**PATH /var/www/html/resources/views/user-box.blade.php ENDPATH**/ ?>