<?php if($allsettings->maintenance_mode == 0): ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title><?php echo e(Helper::translation(3181,$translate)); ?> - <?php echo e($allsettings->site_title); ?></title>
<?php echo $__env->make('meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="bg-position-center-top" style="background-image: url('<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_banner); ?>');">
      <div class="py-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-star">
              <li class="breadcrumb-item"><a class="text-nowrap" href="<?php echo e(URL::to('/')); ?>"><i class="dwg-home"></i><?php echo e(Helper::translation(2862,$translate)); ?></a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page"><?php echo e(Helper::translation(3181,$translate)); ?></li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 mb-0 text-white"><?php echo e(Helper::translation(3181,$translate)); ?></h1>
        </div>
      </div>
      </div>
    </section>
<div class="container py-5 mt-md-2 mb-2">
      <div class="row pt-2 mx-n2">
        <!-- Product-->
        <?php $no = 1; ?>
        <?php $__currentLoopData = $popular['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $featured): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
        $price = Helper::price_info($featured->item_flash,$featured->regular_price);
        $count_rating = Helper::count_rating($featured->ratings);
        ?>
        <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-grid-gutter prod-item" data-aos="fade-up" data-aos-delay="200">
          <!-- Product-->
          <div class="card product-card-alt">
            <div class="product-thumb">
              <?php if(Auth::guest()): ?> 
              <a class="btn-wishlist btn-sm" href="<?php echo e(url('/')); ?>/login"><i class="dwg-heart"></i></a>
              <?php endif; ?>
              <?php if(Auth::check()): ?>
              <?php if($featured->user_id != Auth::user()->id): ?>
              <a class="btn-wishlist btn-sm" href="<?php echo e(url('/item')); ?>/<?php echo e(base64_encode($featured->item_id)); ?>/favorite/<?php echo e(base64_encode($featured->item_liked)); ?>"><i class="dwg-heart"></i></a>
              <?php endif; ?>
              <?php endif; ?>
              <div class="product-card-actions"><a class="btn btn-light btn-icon btn-shadow font-size-base mx-2" href="<?php echo e(URL::to('/item')); ?>/<?php echo e($featured->item_slug); ?>"><i class="dwg-eye"></i></a>
                <a class="btn btn-light btn-icon btn-shadow font-size-base mx-2" href="<?php echo e(URL::to('/item')); ?>/<?php echo e($featured->item_slug); ?>"><i class="dwg-cart"></i></a>
              </div><a class="product-thumb-overlay" href="<?php echo e(URL::to('/item')); ?>/<?php echo e($featured->item_slug); ?>"></a>
                            <?php if($featured->item_preview!=''): ?>
                            <img src="<?php echo e(url('/')); ?>/public/storage/items/<?php echo e($featured->item_preview); ?>" alt="<?php echo e($featured->item_name); ?>">
                            <?php else: ?>
                            <img src="<?php echo e(url('/')); ?>/public/img/no-image.png" alt="<?php echo e($featured->item_name); ?>">
                            <?php endif; ?>
            </div>
            <div class="card-body">
              <div class="d-flex flex-wrap justify-content-between align-items-start pb-2">
                <div class="text-muted font-size-xs mr-1"><a class="product-meta font-weight-medium" href="<?php echo e(URL::to('/shop')); ?>/item-type/<?php echo e($featured->item_type); ?>"><?php echo e(str_replace('-',' ',$featured->item_type)); ?></a></div>
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
               </div>
              <h3 class="product-title font-size-sm mb-2"><a href="<?php echo e(URL::to('/item')); ?>/<?php echo e($featured->item_slug); ?>"><?php echo e(substr($featured->item_name,0,20).'...'); ?></a></h3>
              <div class="card-footer d-flex align-items-center font-size-xs">
              <a class="blog-entry-meta-link" href="<?php echo e(URL::to('/user')); ?>/<?php echo e($featured->username); ?>">
                    <div class="blog-entry-author-ava">
                    <?php if($featured->user_photo!=''): ?>
                    <img src="<?php echo e(url('/')); ?>/public/storage/users/<?php echo e($featured->user_photo); ?>" alt="<?php echo e($featured->username); ?>">
                    <?php else: ?>
                    <img src="<?php echo e(url('/')); ?>/public/img/no-user.png" alt="<?php echo e($featured->username); ?>">
                    <?php endif; ?>
                    </div><?php echo e($featured->username); ?> <?php if($addition_settings->subscription_mode == 1): ?> <?php if($featured->verified == 1): ?> <span class="badges-success"><i class="dwg-check-circle danger"></i> <?php echo e(Helper::translation(5202,$translate)); ?></span><?php endif; ?> <?php endif; ?></a>
                  <div class="ml-auto text-nowrap"><i class="dwg-time"></i> <?php echo e(date('d M Y',strtotime($featured->updated_item))); ?></div>
                </div>
              <div class="d-flex flex-wrap justify-content-between align-items-center">
                <div class="font-size-sm mr-2"><i class="dwg-download text-muted mr-1"></i><?php echo e($featured->item_sold); ?><span class="font-size-xs ml-1"><?php echo e(Helper::translation(2930,$translate)); ?></span>
                </div>
                <div><?php if($featured->item_flash == 1): ?><del class="price-old"><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($featured->regular_price); ?></del><?php endif; ?> <span class="bg-faded-accent text-accent rounded-sm py-1 px-2"><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($price); ?></span></div>
              </div>
            </div>
          </div>
        </div>
        <!-- Product-->
        <?php $no++; ?>
	    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       </div>
       <div class="row mb-3">
       <div class="col-md-12  text-right">
            <div class="turn-page" id="itempager"></div>
       </div>         
       </div>
    </div>
<?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php else: ?>
<?php echo $__env->make('503', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?><?php /**PATH D:\xampp\htdocs\fickrr\resources\views/popular-items.blade.php ENDPATH**/ ?>