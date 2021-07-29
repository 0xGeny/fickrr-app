<?php if($allsettings->maintenance_mode == 0): ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title><?php echo e(Helper::translation(3028,$translate)); ?> - <?php echo e($allsettings->site_title); ?></title>
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
              <li class="breadcrumb-item"><a class="text-nowrap" href="<?php echo e(URL::to('/')); ?>"><i class="dwg-home"></i><?php echo e(Helper::translation(3028,$translate)); ?></a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page"><?php echo e(Helper::translation(3028,$translate)); ?></li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 mb-0 text-white"><?php echo e(Helper::translation(3028,$translate)); ?></h1>
        </div>
      </div>
      </div>
    </section>
<div class="container py-5 mt-md-2 mb-2">
      <div class="row">
      <section class="col-lg-8">
          <?php $__currentLoopData = $user['user']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if($count_sale->has($user->id) != 0): ?>
          <?php
          $membership = date('m/d/Y',strtotime($user->created_at));
          $membership_date = explode("/", $membership);
          $year = (date("md", date("U", mktime(0, 0, 0, $membership_date[0], $membership_date[1], $membership_date[2]))) > date("md")
                                        ? ((date("Y") - $membership_date[2]) - 1)
                                        : (date("Y") - $membership_date[2]));
          $referral_count = $user->referral_count;  
          ?>
          <div class="d-sm-flex justify-content-between mt-lg-4 mb-4 pb-3 pb-sm-2 border-bottom prod-item" data-aos="fade-up" data-aos-delay="200">
            <div class="media media-ie-fix d-block d-sm-flex text-sm-left">
            <a href="<?php echo e(url('/user')); ?>/<?php echo e($user->username); ?>" class="d-inline-block mx-auto mr-sm-4" style="width: 7rem;">
             <?php if($user->user_photo != ''): ?>
             <img src="<?php echo e(url('/')); ?>/public/storage/users/<?php echo e($user->user_photo); ?>" alt="<?php echo e($user->name); ?>" class="img-rounded">
             <?php else: ?>
             <img src="<?php echo e(url('/')); ?>/public/img/no-user.png" alt="<?php echo e($user->name); ?>" class="img-rounded">
             <?php endif; ?>
             </a>
              <div class="media-body pt-2">
                <h3 class="product-title font-size-base mb-2"><a href="<?php echo e(url('/user')); ?>/<?php echo e($user->username); ?>"><?php echo e($user->name); ?> <?php if($addition_settings->subscription_mode == 1): ?> <?php if($user->user_document_verified == 1): ?> <span class="badges-success"><i class="dwg-check-circle danger"></i> <?php echo e(Helper::translation(5202,$translate)); ?></span><?php endif; ?> <?php endif; ?></a></h3>
                <?php if($user->country_badge == 1): ?>
                <div class="badges-icon">
                <ul>
                 <?php if($user->country_badges != ""): ?>
                   <li>
                     <img src="<?php echo e(url('/')); ?>/public/storage/flag/<?php echo e($user->country_badges); ?>" border="0" class="icon-badges" title="<?php echo e(Helper::translation(5985,$translate)); ?> <?php echo e($user->country_name); ?>">  
                   </li>
                    <?php endif; ?>
                     <?php if($user->exclusive_author == 1): ?>
                      <li>
                       <img src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($badges['setting']->exclusive_author_icon); ?>" border="0" class="other-badges" title="<?php echo e(Helper::translation(5988,$translate)); ?> <?php echo e($allsettings->site_title); ?>">
                       </li>
                       <?php endif; ?>
                       <?php if($year == 1): ?>
                       <li>
                       <img src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($badges['setting']->one_year_icon); ?>" border="0" class="other-badges" title="<?php echo e($year); ?> <?php echo e(Helper::translation(6000,$translate)); ?> <?php echo e($allsettings->site_title); ?> <?php echo e(Helper::translation(6003,$translate)); ?> <?php echo e($year); ?> <?php echo e(Helper::translation(6006,$translate)); ?>">
                       </li>
                       <?php endif; ?>
                       <?php if($year == 2): ?>
                        <li>
                        <img src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($badges['setting']->two_year_icon); ?>" border="0" class="other-badges" title="<?php echo e($year); ?> <?php echo e(Helper::translation(6000,$translate)); ?> <?php echo e($allsettings->site_title); ?> <?php echo e(Helper::translation(6003,$translate)); ?> <?php echo e($year); ?> <?php echo e(Helper::translation(6006,$translate)); ?>">
                        </li>
                        <?php endif; ?>
                        <?php if($year == 3): ?>
                        <li>
                        <img src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($badges['setting']->three_year_icon); ?>" border="0" class="other-badges" title="<?php echo e($year); ?> <?php echo e(Helper::translation(6000,$translate)); ?> <?php echo e($allsettings->site_title); ?> <?php echo e(Helper::translation(6003,$translate)); ?> <?php echo e($year); ?> <?php echo e(Helper::translation(6006,$translate)); ?>">
                         </li>
                         <?php endif; ?>
                        <?php if($year == 4): ?>
                        <li>
                        <img src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($badges['setting']->four_year_icon); ?>" border="0" class="other-badges" title="<?php echo e($year); ?> <?php echo e(Helper::translation(6000,$translate)); ?> <?php echo e($allsettings->site_title); ?> <?php echo e(Helper::translation(6003,$translate)); ?> <?php echo e($year); ?> <?php echo e(Helper::translation(6006,$translate)); ?>">
                        </li>
                        <?php endif; ?>
                        <?php if($year == 5): ?>
                        <li>
                        <img src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($badges['setting']->five_year_icon); ?>" border="0" class="other-badges" title="<?php echo e($year); ?> <?php echo e(Helper::translation(6000,$translate)); ?> <?php echo e($allsettings->site_title); ?> <?php echo e(Helper::translation(6003,$translate)); ?> <?php echo e($year); ?> <?php echo e(Helper::translation(6006,$translate)); ?>">
                        </li>
                        <?php endif; ?> 
                        <?php if($year == 6): ?>
                        <li>
                        <img src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($badges['setting']->six_year_icon); ?>" border="0" class="other-badges" title="<?php echo e($year); ?> <?php echo e(Helper::translation(6000,$translate)); ?> <?php echo e($allsettings->site_title); ?> <?php echo e(Helper::translation(6003,$translate)); ?> <?php echo e($year); ?> <?php echo e(Helper::translation(6006,$translate)); ?>">
                        </li>
                        <?php endif; ?>
                        <?php if($year == 7): ?>
                        <li>
                        <img src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($badges['setting']->seven_year_icon); ?>" border="0" class="other-badges" title="<?php echo e($year); ?> <?php echo e(Helper::translation(6000,$translate)); ?> <?php echo e($allsettings->site_title); ?> <?php echo e(Helper::translation(6003,$translate)); ?> <?php echo e($year); ?> <?php echo e(Helper::translation(6006,$translate)); ?>">
                       </li>
                       <?php endif; ?>
                       <?php if($year == 8): ?>
                       <li>
                       <img src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($badges['setting']->eight_year_icon); ?>" border="0" class="other-badges" title="<?php echo e($year); ?> <?php echo e(Helper::translation(6000,$translate)); ?> <?php echo e($allsettings->site_title); ?> <?php echo e(Helper::translation(6003,$translate)); ?> <?php echo e($year); ?> <?php echo e(Helper::translation(6006,$translate)); ?>">
                       </li>
                       <?php endif; ?>
                       <?php if($year == 9): ?>
                       <li>
                         <img src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($badges['setting']->nine_year_icon); ?>" border="0" class="other-badges" title="<?php echo e($year); ?> <?php echo e(Helper::translation(6000,$translate)); ?> <?php echo e($allsettings->site_title); ?> <?php echo e(Helper::translation(6003,$translate)); ?> <?php echo e($year); ?> <?php echo e(Helper::translation(6006,$translate)); ?>">
                         </li>
                       <?php endif; ?>
                       <?php if($year >= 10): ?>
                       <li>
                        <img src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($badges['setting']->ten_year_icon); ?>" border="0" class="other-badges" title="<?php if($year >= 10): ?> 10+ <?php else: ?> <?php echo e($year); ?> <?php endif; ?> <?php echo e(Helper::translation(6000,$translate)); ?> <?php echo e($allsettings->site_title); ?> <?php echo e(Helper::translation(6003,$translate)); ?> <?php if($year >= 10): ?> 10+ <?php else: ?> <?php echo e($year); ?> <?php endif; ?> <?php echo e(Helper::translation(6006,$translate)); ?>">
                         </li>
                         <?php endif; ?>
                        <?php if($referral_count >= $badges['setting']->author_referral_level_one && $badges['setting']->author_referral_level_two > $referral_count): ?> 
                        <li>
                         <img src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($badges['setting']->author_referral_level_one_icon); ?>" border="0" class="other-badges" title="<?php echo e(Helper::translation(6024,$translate)); ?> 1: <?php echo e(Helper::translation(6027,$translate)); ?> <?php echo e($badges['setting']->author_referral_level_one); ?>+ <?php echo e(Helper::translation(3002,$translate)); ?>">
                         </li>
                         <?php endif; ?>
                         <?php if($referral_count >= $badges['setting']->author_referral_level_two && $badges['setting']->author_referral_level_three > $referral_count): ?> 
                         <li>
                          <img src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($badges['setting']->author_referral_level_two_icon); ?>" border="0" class="other-badges" title="<?php echo e(Helper::translation(6024,$translate)); ?> 2: <?php echo e(Helper::translation(6027,$translate)); ?> <?php echo e($badges['setting']->author_referral_level_two); ?>+ <?php echo e(Helper::translation(3002,$translate)); ?>">
                           </li>
                          <?php endif; ?>
                          <?php if($referral_count >= $badges['setting']->author_referral_level_three && $badges['setting']->author_referral_level_four > $referral_count): ?> 
                           <li>
                           <img src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($badges['setting']->author_referral_level_three_icon); ?>" border="0" class="other-badges" title="<?php echo e(Helper::translation(6024,$translate)); ?> 3: <?php echo e(Helper::translation(6027,$translate)); ?> <?php echo e($badges['setting']->author_referral_level_three); ?>+ <?php echo e(Helper::translation(3002,$translate)); ?>">
                           </li>
                         <?php endif; ?>
                         <?php if($referral_count >= $badges['setting']->author_referral_level_four && $badges['setting']->author_referral_level_five > $referral_count): ?> 
                          <li>
                            <img src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($badges['setting']->author_referral_level_four_icon); ?>" border="0" class="other-badges" title="<?php echo e(Helper::translation(6024,$translate)); ?> 4: <?php echo e(Helper::translation(6027,$translate)); ?> <?php echo e($badges['setting']->author_referral_level_four); ?>+ <?php echo e(Helper::translation(3002,$translate)); ?>">
                             </li>
                          <?php endif; ?>
                          <?php if($referral_count >= $badges['setting']->author_referral_level_five && $badges['setting']->author_referral_level_six > $referral_count): ?> 
                           <li>
                            <img src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($badges['setting']->author_referral_level_five_icon); ?>" border="0" class="other-badges" title="<?php echo e(Helper::translation(6024,$translate)); ?> 5: <?php echo e(Helper::translation(6027,$translate)); ?> <?php echo e($badges['setting']->author_referral_level_five); ?>+ <?php echo e(Helper::translation(3002,$translate)); ?>">
                            </li>
                         <?php endif; ?>
                         <?php if($referral_count >= $badges['setting']->author_referral_level_six): ?> 
                           <li>
                            <img src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($badges['setting']->author_referral_level_six_icon); ?>" border="0" class="other-badges" title="<?php echo e(Helper::translation(6024,$translate)); ?> 6: <?php echo e(Helper::translation(6027,$translate)); ?> <?php echo e($badges['setting']->author_referral_level_six); ?>+ <?php echo e(Helper::translation(3002,$translate)); ?>">
                            </li>
                         <?php endif; ?>
                         </ul>
                         </div>
                         <?php endif; ?>
                <div class="font-size-sm"><?php echo e($count_items->has($user->id) ? count($count_items[$user->id]) : 0); ?> Items</div>
                <div class="font-size-sm"><?php echo e(Helper::translation(3077,$translate)); ?> <?php echo e(date("F Y", strtotime($user->created_at))); ?></div>
                <div class="font-size-sm"><?php if($user->country_badge == 1): ?><?php echo e($user->country_name); ?><?php endif; ?></div>
              </div>
            </div>
            <div class="pt-2 pl-sm-3 mx-auto mx-sm-0 text-center">
             <p><span class="sale-count"><?php echo e($count_sale->has($user->id) ? count($count_sale[$user->id]) : 0); ?></span><br/><?php echo e(Helper::translation(2930,$translate)); ?></p>
             <?php
             $count_rating = Helper::count_rating($user->ratings);
             ?>
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
          </div>
          <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <div class="pagination-area">
          <div class="turn-page" id="itempager"></div>
          </div>
        </section>
        <aside class="col-lg-4">
          <!-- Sidebar-->
          <div class="cz-sidebar border-left ml-lg-auto" id="blog-sidebar">
            <div class="cz-sidebar-header box-shadow-sm">
              <button class="close ml-auto" type="button" data-dismiss="sidebar" aria-label="Close"><span class="d-inline-block font-size-xs font-weight-normal align-middle"><?php echo e(Helper::translation(6069,$translate)); ?></span><span class="d-inline-block align-middle ml-2" aria-hidden="true">×</span></button>
            </div>
            <div class="cz-sidebar-body py-lg-1" data-simplebar="init" data-simplebar-auto-hide="true"><div class="simplebar-wrapper" style="margin: -4px -16px -4px -30px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" style="height: auto; overflow: hidden;"><div class="simplebar-content" style="padding: 4px 16px 4px 30px;">
              <!-- Categories-->
              <div class="widget widget-links mb-grid-gutter pb-grid-gutter border-bottom">
                <h3 class="widget-title"><?php echo e(Helper::translation(2879,$translate)); ?></h3>
                <?php if(count($category['view']) != 0): ?>
                <ul class="widget-list">
                <?php $__currentLoopData = $category['view']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li class="widget-list-item"><a class="widget-list-link d-flex justify-content-between align-items-center" href="<?php echo e(URL::to('/shop/category/')); ?>/<?php echo e($cat->category_slug); ?>"><span><?php echo e($cat->category_name); ?></span></a></li>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                </ul>
                <?php endif; ?>
              </div>
              <!-- Trending posts-->
              <div class="widget mb-grid-gutter pb-grid-gutter border-bottom">
                <h3 class="widget-title"><?php echo e(Helper::translation(3181,$translate)); ?></h3>
                <?php if(count($popular['items']) != 0): ?>
                <?php $no = 1; ?>
                <?php $__currentLoopData = $popular['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $featured): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="media align-items-center mb-3"><a href="<?php echo e(URL::to('/item')); ?>/<?php echo e($featured->item_slug); ?>">
                <?php if($featured->item_preview!=''): ?>
                <img class="rounded" src="<?php echo e(url('/')); ?>/public/storage/items/<?php echo e($featured->item_preview); ?>" width="64" alt="<?php echo e($featured->item_name); ?>">
                <?php else: ?>
                <img class="rounded" src="<?php echo e(url('/')); ?>/public/img/no-image.png" width="64" alt="<?php echo e($featured->item_name); ?>">
                <?php endif; ?>
                </a>
                  <div class="media-body pl-3">
                    <h6 class="blog-entry-title font-size-sm mb-0"><a href="<?php echo e(URL::to('/item')); ?>/<?php echo e($featured->item_slug); ?>"><?php echo e(substr($featured->item_name,0,20).'...'); ?></a></h6><span class="font-size-ms text-muted"><?php echo e(Helper::translation(3034,$translate)); ?> <a href="<?php echo e(URL::to('/user')); ?>/<?php echo e($featured->username); ?>" class="blog-entry-meta-link"><?php echo e($featured->username); ?></a></span>
                  </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
              </div>
              </div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 1070px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: hidden;"><div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div></div></div>
          </div>
        </aside>
       </div>
    </div>
<?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php else: ?>
<?php echo $__env->make('503', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?><?php /**PATH /var/www/html/fickrr/resources/views/top-authors.blade.php ENDPATH**/ ?>