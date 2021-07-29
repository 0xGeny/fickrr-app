<?php if($allsettings->maintenance_mode == 0): ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title><?php echo e(Helper::translation(3178,$translate)); ?> - <?php echo e($allsettings->site_title); ?></title>
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
              <li class="breadcrumb-item text-nowrap active" aria-current="page"><?php echo e(Helper::translation(3178,$translate)); ?></li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 mb-0 text-white"><?php echo e(Helper::translation(3178,$translate)); ?></h1>
        </div>
      </div>
      </div>
    </section>
<div class="container py-5 mt-md-2 mb-2">
      <div class="row pt-3 mx-n2">
         <aside class="col-lg-4">
          <!-- Sidebar-->
          <form action="<?php echo e(route('shop')); ?>" id="search_form2" method="post"  enctype="multipart/form-data">
          <?php echo e(csrf_field()); ?>

          <div class="cz-sidebar rounded-lg box-shadow-lg" id="shop-sidebar">
            <div class="cz-sidebar-header box-shadow-sm">
              <button class="close ml-auto" type="button" data-dismiss="sidebar" aria-label="Close"><span class="d-inline-block font-size-xs font-weight-normal align-middle"><?php echo e(Helper::translation(6069,$translate)); ?></span><span class="d-inline-block align-middle ml-2" aria-hidden="true">&times;</span></button>
            </div>
            <div class="cz-sidebar-body" data-simplebar data-simplebar-auto-hide="true">
              
              <!-- Filter by Brand-->
              <div class="widget cz-filter mb-4 pb-4 border-bottom">
                <h3 class="widget-title"><?php echo e(Helper::translation(2937,$translate)); ?></h3>
                <div class="input-group-overlay input-group-sm mb-2">
                  <input class="cz-filter-search form-control form-control-sm appended-form-control" type="text" placeholder="<?php echo e(Helper::translation(4857,$translate)); ?>">
                  <div class="input-group-append-overlay"><span class="input-group-text"><i class="czi-search"></i></span></div>
                </div>
                <?php if(count($getWell['type']) != 0): ?>
                <ul class="widget-list cz-filter-list list-unstyled pt-1" style="max-height: 12rem;" data-simplebar data-simplebar-auto-hide="false">
                  <?php $__currentLoopData = $getWell['type']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" type="checkbox" id="<?php echo e($value->item_type_slug); ?>" name="item_type[]" value="<?php echo e($value->item_type_slug); ?>">
                      <label class="custom-control-label cz-filter-item-text" for="<?php echo e($value->item_type_slug); ?>"><?php echo e($value->item_type_name); ?></label>
                    </div>
                  </li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 </ul>
                <?php endif; ?> 
              </div>
              <!-- Categories-->
              <div class="widget cz-filter mb-4 pb-4 border-bottom">
                <h3 class="widget-title"><?php echo e(Helper::translation(2879,$translate)); ?></h3>
                <div class="input-group-overlay input-group-sm mb-2">
                  <input class="cz-filter-search form-control form-control-sm appended-form-control" type="text" placeholder="<?php echo e(Helper::translation(4857,$translate)); ?>">
                  <div class="input-group-append-overlay"><span class="input-group-text"><i class="dwg-search"></i></span></div>
                </div>
                <?php if(count($category['view']) != 0): ?>
                <ul class="widget-list cz-filter-list list-unstyled pt-1" style="max-height: 12rem;" data-simplebar data-simplebar-auto-hide="false">
                  <?php $__currentLoopData = $category['view']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" type="checkbox" id="<?php echo e($cat->cat_id); ?>" name="category_names[]" value="<?php echo e('category_'.$cat->cat_id); ?>">
                      <label class="custom-control-label cz-filter-item-text" for="<?php echo e($cat->cat_id); ?>"><?php echo e($cat->category_name); ?></label>
                      <?php $__currentLoopData = $cat->subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <br/>
                      <span class="ml-2"><input class="custom-control-input" type="checkbox" id="<?php echo e($sub_category->subcat_id); ?>" name="category_names[]" value="<?php echo e('subcategory_'.$sub_category->subcat_id); ?>">
                      <label class="custom-control-label cz-filter-item-text" for="<?php echo e($sub_category->subcat_id); ?>"><?php echo e($sub_category->subcategory_name); ?></label>
                      </span>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    
                  </li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                </ul>
                <?php endif; ?>
              </div>
              <div class="widget cz-filter mb-4 pb-4 border-bottom">
                <h3 class="widget-title"><?php echo e(Helper::translation(4851,$translate)); ?></h3>
                <div class="input-group-overlay input-group-sm mb-2">
                  <select class="cz-filter-search form-control form-control-sm appended-form-control" name="orderby">
                  <option value="desc"><?php echo e(Helper::translation(4854,$translate)); ?></option>
                  <option value="asc"><?php echo e(Helper::translation(3179,$translate)); ?></option>
                  <option value="desc"><?php echo e(Helper::translation(3180,$translate)); ?></option>
                 </select>            
                </div>
              </div>
              <!-- Price range-->
              <?php if(count($itemData['item']) != 0): ?>
              <div class="widget mb-4 pb-4 border-bottom">
                <h3 class="widget-title"><?php echo e(Helper::translation(2888,$translate)); ?></h3>
                <div class="cz-range-slider" data-start-min="<?php echo e($minprice['price']->regular_price); ?>" data-start-max="<?php echo e($maxprice['price']->extended_price); ?>" data-min="<?php echo e($allsettings->site_range_min_price); ?>" data-max="<?php echo e($allsettings->site_range_max_price); ?>" data-step="1">
                  <div class="cz-range-slider-ui"></div>
                  <div class="d-flex pb-1">
                    <div class="w-50 pr-2 mr-2">
                      <div class="input-group input-group-sm">
                        <div class="input-group-prepend"><span class="input-group-text"><?php echo e($allsettings->site_currency_symbol); ?></span></div>
                        <input class="form-control cz-range-slider-value-min" type="text" name="min_price">
                      </div>
                    </div>
                    <div class="w-50 pl-2">
                      <div class="input-group input-group-sm">
                        <div class="input-group-prepend"><span class="input-group-text"><?php echo e($allsettings->site_currency_symbol); ?></span></div>
                        <input class="form-control cz-range-slider-value-max" type="text" name="max_price">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php endif; ?>
              <div class="input-group-append">
                  <button class="btn btn-primary btn-sm font-size-base" type="submit"><?php echo e(Helper::translation(4857,$translate)); ?></button>
             </div>
              <!-- Filter by Brand-->
           </div>
          </div>
          </form>
        </aside>
        <div class="col-lg-8">
         <div class="row pt-2 mx-n2">
        <!-- Product-->
        <?php if(count($itemData['item']) != 0): ?>
        <?php $no = 1; ?>
        <?php $__currentLoopData = $itemData['item']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $featured): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
        $price = Helper::price_info($featured->item_flash,$featured->regular_price);
        $count_rating = Helper::count_rating($featured->ratings);
        ?>
        <div class="col-lg-4 col-md-4 col-sm-6 px-2 mb-3 prod-item">
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
                    </div><?php echo e($featured->username); ?> <?php if($addition_settings->subscription_mode == 1): ?> <?php if($featured->user_document_verified == 1): ?> <span class="badges-success"><i class="dwg-check-circle danger"></i> <?php echo e(Helper::translation(5202,$translate)); ?></span><?php endif; ?> <?php endif; ?></a>
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
       <div class="text-right">
            <div class="turn-page" id="itempager"></div>
       </div>
       <?php else: ?>
       <div><?php echo e(Helper::translation(6072,$translate)); ?></div>
       <?php endif; ?>
       </div>
        </div>
      </div>
    </div>
<?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php else: ?>
<?php echo $__env->make('503', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?><?php /**PATH /var/www/html/fickrr/resources/views/shop.blade.php ENDPATH**/ ?>