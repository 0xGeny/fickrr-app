<div class="page-title-overlap pt-4" style="background-image: url('<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_banner); ?>');">
      <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-star">
              <li class="breadcrumb-item"><a class="text-nowrap" href="<?php echo e(URL::to('/')); ?>"><i class="dwg-home"></i><?php echo e(Helper::translation(2862,$translate)); ?></a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page"><?php echo e(Helper::translation(2989,$translate)); ?></li>
              </li>
             </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 mb-0 text-white"><?php echo e(Helper::translation(2990,$translate)); ?></h1>
        </div>
      </div>
    </div>
<div class="container mb-5 pb-3">
      <div class="bg-light box-shadow-lg rounded-lg overflow-hidden">
        <div class="row">
          <!-- Sidebar-->
          <aside class="col-lg-4">
            <!-- Account menu toggler (hidden on screens larger 992px)-->
            <div class="d-block d-lg-none p-4">
            <a class="btn btn-outline-accent d-block" href="#account-menu" data-toggle="collapse"><i class="dwg-menu mr-2"></i><?php echo e(Helper::translation(4878,$translate)); ?></a></div>
            <!-- Actual menu-->
            <?php if(Auth::user()->id != 1): ?>
            <?php echo $__env->make('dashboard-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
          </aside>
          <!-- Content-->
          <section class="<?php if(Auth::user()->id == 1): ?> col-lg-12 pl-4 <?php else: ?> col-lg-8 <?php endif; ?> pt-lg-4 pb-4 mb-3">
            <div class="pt-2 px-4 pl-lg-0 pr-xl-5">
              <h2 class="h3 pt-2 pb-4 mb-0 text-center text-sm-left border-bottom"><?php echo e(Helper::translation(2990,$translate)); ?><span class="badge badge-secondary font-size-sm text-body align-middle ml-2"><?php echo e(count($fav['item'])); ?></span></h2>
              <!-- Product-->
                <?php $no = 1; ?>
                <?php $__currentLoopData = $fav['item']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $featured): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                $price = Helper::price_info($featured->item_flash,$featured->regular_price);
                ?>
              <div class="media d-block d-sm-flex align-items-center py-4 border-bottom">
              <a class="d-block position-relative mb-3 mb-sm-0 mr-sm-4 mx-auto cart-img" href="<?php echo e(url('/favourites')); ?>/<?php echo e(base64_encode($featured->fav_id)); ?>/<?php echo e(base64_encode($featured->item_id)); ?>" onClick="return confirm('<?php echo e(Helper::translation(2991,$translate)); ?>');">
              <?php if($featured->item_preview!=''): ?>
              <img class="rounded-lg" src="<?php echo e(url('/')); ?>/public/storage/items/<?php echo e($featured->item_preview); ?>" alt="<?php echo e($featured->item_name); ?>">
              <?php else: ?>
              <img class="rounded-lg" src="<?php echo e(url('/')); ?>/public/img/no-image.png" alt="<?php echo e($featured->item_name); ?>">
              <?php endif; ?>
              <span class="close-floating" data-toggle="tooltip" title="Remove from Favorites"><i class="dwg-close"></i></span></a>
                <div class="media-body text-center text-sm-left">
                  <h3 class="h6 product-title mb-2"><a href="<?php echo e(URL::to('/item')); ?>/<?php echo e($featured->item_slug); ?>"><?php echo e(substr($featured->item_name,0,20).'...'); ?></a></h3>
                  <div class="d-inline-block text-accent"><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($price); ?></div><a class="d-inline-block text-accent font-size-ms border-left ml-2 pl-2" href="<?php echo e(URL::to('/shop')); ?>/item-type/<?php echo e($featured->item_type); ?>"><?php echo e(str_replace('-',' ',$featured->item_type)); ?></a>
                  <div class="form-inline pt-2">
                    <?php echo e(substr($featured->item_shortdesc,0,60).'...'); ?>

                    <a class="btn btn-primary btn-sm mx-auto mx-sm-0 my-2" href="<?php echo e(URL::to('/item')); ?>/<?php echo e($featured->item_slug); ?>"><i class="dwg-cart mr-1"></i><?php echo e(Helper::translation(4881,$translate)); ?></a></div>
                </div>
              </div>
              <?php $no++; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </section>
        </div>
      </div>
    </div><?php /**PATH D:\xampp\htdocs\fickrr\resources\views/my-favourite.blade.php ENDPATH**/ ?>