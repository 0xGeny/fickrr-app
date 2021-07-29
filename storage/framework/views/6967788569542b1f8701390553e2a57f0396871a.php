<aside class="col-lg-4">
            <div class="cz-sidebar-static h-100 border-right">
              <h6><?php echo e(Helper::translation(4950,$translate)); ?></h6>
              <?php if($user['user']->user_type == 'vendor'): ?>
            <div class="item-details badge-size" data-aos="fade-up" data-aos-delay="200">
                                    <ul>
                                        <?php if($sold_amount >= $badges['setting']->author_sold_level_six): ?>
                                        <div class="sidebar-card card--metadata">
                                            <div>
                                                    <img src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($badges['setting']->power_elite_author_icon); ?>" border="0" class="single-badges" title="<?php echo e($badges['setting']->author_sold_level_six_label); ?> : <?php echo e(Helper::translation(5982,$translate)); ?> <?php echo e($allsettings->site_currency); ?> <?php echo e($badges['setting']->author_sold_level_six); ?>+ <?php echo e(Helper::translation(5325,$translate)); ?> <?php echo e($allsettings->site_title); ?>"> <?php echo e($badges['setting']->author_sold_level_six_label); ?>

                                            </div>
                                            
                                        </div> 
                                        <?php endif; ?>
                                         <?php if($user['user']->country_badge == 1): ?>
                                        <?php if($country['view']->country_badges != ""): ?>
                                        <li>
                                          <img src="<?php echo e(url('/')); ?>/public/storage/flag/<?php echo e($country['view']->country_badges); ?>" border="0" class="icon-badges" title="<?php echo e(Helper::translation(5985,$translate)); ?> <?php echo e($country['view']->country_name); ?>">  
                                        </li>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if($featured_count->has($user['user']->id) ? count($featured_count[$user['user']->id]) : 0 != 0): ?>
                                        <li>
                                        <img src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($badges['setting']->featured_item_icon); ?>" border="0" class="other-badges" title="<?php echo e(Helper::translation(5994,$translate)); ?> <?php echo e($allsettings->site_title); ?>">
                                        </li>
                                        <?php endif; ?>
                                        <?php if($free_count->has($user['user']->id) ? count($free_count[$user['user']->id]) : 0 != 0): ?>
                                        <li>
                                        <img src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($badges['setting']->free_item_icon); ?>" border="0" class="other-badges" title="<?php echo e(Helper::translation(5997,$translate)); ?>">
                                        </li>
                                        <?php endif; ?>
                                        <?php if($tren_count->has($user['user']->id) ? count($tren_count[$user['user']->id]) : 0 != 0): ?>
                                         <li>
                                        <img src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($badges['setting']->trends_icon); ?>" border="0" class="other-badges" title="<?php echo e(Helper::translation(5991,$translate)); ?>">
                                        </li>
                                        <?php endif; ?>
                                        <?php if($user['user']->exclusive_author == 1): ?>
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
                                        <?php if($sold_amount >= $badges['setting']->author_sold_level_one && $badges['setting']->author_sold_level_two > $sold_amount): ?> 
                                        <li>
                                        <img src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($badges['setting']->author_sold_level_one_icon); ?>" border="0" class="other-badges" title="<?php echo e(Helper::translation(6009,$translate)); ?> 1: <?php echo e(Helper::translation(6012,$translate)); ?> <?php echo e($allsettings->site_currency); ?> <?php echo e($badges['setting']->author_sold_level_one); ?>+ <?php echo e(Helper::translation(5325,$translate)); ?> <?php echo e($allsettings->site_title); ?>">
                                        </li>
                                        <?php endif; ?>
                                        
                                        <?php if($sold_amount >= $badges['setting']->author_sold_level_two &&  $badges['setting']->author_sold_level_three > $sold_amount): ?> 
                                        <li>
                                        <img src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($badges['setting']->author_sold_level_two_icon); ?>" border="0" class="other-badges" title="<?php echo e(Helper::translation(6009,$translate)); ?> 2: <?php echo e(Helper::translation(6012,$translate)); ?> <?php echo e($allsettings->site_currency); ?> <?php echo e($badges['setting']->author_sold_level_two); ?>+ <?php echo e(Helper::translation(5325,$translate)); ?> <?php echo e($allsettings->site_title); ?>">
                                        </li>
                                        <?php endif; ?>
                                        <?php if($sold_amount >= $badges['setting']->author_sold_level_three &&  $badges['setting']->author_sold_level_four > $sold_amount): ?> 
                                        <li>
                                        <img src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($badges['setting']->	author_sold_level_three_icon); ?>" border="0" class="other-badges" title="<?php echo e(Helper::translation(6009,$translate)); ?> 3: <?php echo e(Helper::translation(6012,$translate)); ?> <?php echo e($allsettings->site_currency); ?> <?php echo e($badges['setting']->author_sold_level_three); ?>+ <?php echo e(Helper::translation(5325,$translate)); ?> <?php echo e($allsettings->site_title); ?>">
                                        </li>
                                        <?php endif; ?>
                                        <?php if($sold_amount >= $badges['setting']->author_sold_level_four &&  $badges['setting']->author_sold_level_five > $sold_amount): ?> 
                                        <li>
                                        <img src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($badges['setting']->author_sold_level_four_icon); ?>" border="0" class="other-badges" title="<?php echo e(Helper::translation(6009,$translate)); ?> 4: <?php echo e(Helper::translation(6012,$translate)); ?> <?php echo e($allsettings->site_currency); ?> <?php echo e($badges['setting']->author_sold_level_four); ?>+ <?php echo e(Helper::translation(5325,$translate)); ?> <?php echo e($allsettings->site_title); ?>">
                                        </li>
                                        <?php endif; ?>
                                        <?php if($sold_amount >= $badges['setting']->author_sold_level_five &&  $badges['setting']->author_sold_level_six > $sold_amount): ?> 
                                        <li>
                                        <img src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($badges['setting']->author_sold_level_five_icon); ?>" border="0" class="other-badges" title="<?php echo e(Helper::translation(6009,$translate)); ?> 5: <?php echo e(Helper::translation(6012,$translate)); ?> <?php echo e($allsettings->site_currency); ?> <?php echo e($badges['setting']->author_sold_level_five); ?>+ <?php echo e(Helper::translation(5325,$translate)); ?> <?php echo e($allsettings->site_title); ?>">
                                        </li>
                                        <?php endif; ?>
                                        <?php if($sold_amount >= $badges['setting']->author_sold_level_six): ?> 
                                        <li>
                                        <img src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($badges['setting']->author_sold_level_six_icon); ?>" border="0" class="other-badges" title="<?php echo e(Helper::translation(6009,$translate)); ?> 6: <?php echo e(Helper::translation(6012,$translate)); ?> <?php echo e($allsettings->site_currency); ?> <?php echo e($badges['setting']->author_sold_level_six); ?>+ <?php echo e(Helper::translation(5325,$translate)); ?> <?php echo e($allsettings->site_title); ?>">
                                        </li>
                                        <?php endif; ?>
                                        <?php if($sold_amount >= $badges['setting']->author_sold_level_six): ?>
                                        <li>
                                        <img src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($badges['setting']->power_elite_author_icon); ?>" border="0" class="other-badges" title="<?php echo e($badges['setting']->author_sold_level_six_label); ?> : Sold more than <?php echo e($allsettings->site_currency); ?> <?php echo e($badges['setting']->author_sold_level_six); ?>+ <?php echo e(Helper::translation(5325,$translate)); ?> <?php echo e($allsettings->site_title); ?>">
                                        </li>
                                        <?php endif; ?>
                                        <?php if($collect_amount >= $badges['setting']->author_collect_level_one && $badges['setting']->author_collect_level_two > $collect_amount): ?> 
                                        <li>
                                        <img src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($badges['setting']->author_collect_level_one_icon); ?>" border="0" class="other-badges" title="<?php echo e(Helper::translation(6015,$translate)); ?> 1: <?php echo e(Helper::translation(6018,$translate)); ?> <?php echo e($badges['setting']->author_collect_level_one); ?>+ <?php echo e(Helper::translation(6021,$translate)); ?> <?php echo e($allsettings->site_title); ?>">
                                        </li>
                                        <?php endif; ?>
                                        <?php if($collect_amount >= $badges['setting']->author_collect_level_two && $badges['setting']->author_collect_level_three > $collect_amount): ?> 
                                        <li>
                                        <img src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($badges['setting']->author_collect_level_two_icon); ?>" border="0" class="other-badges" title="<?php echo e(Helper::translation(6015,$translate)); ?> 2: <?php echo e(Helper::translation(6018,$translate)); ?> <?php echo e($badges['setting']->author_collect_level_two); ?>+ <?php echo e(Helper::translation(6021,$translate)); ?> <?php echo e($allsettings->site_title); ?>">
                                        </li>
                                        <?php endif; ?>
                                        <?php if($collect_amount >= $badges['setting']->author_collect_level_three && $badges['setting']->author_collect_level_four > $collect_amount): ?> 
                                        <li>
                                        <img src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($badges['setting']->author_collect_level_three_icon); ?>" border="0" class="other-badges" title="<?php echo e(Helper::translation(6015,$translate)); ?> 3: <?php echo e(Helper::translation(6018,$translate)); ?> <?php echo e($badges['setting']->author_collect_level_three); ?>+ <?php echo e(Helper::translation(6021,$translate)); ?> <?php echo e($allsettings->site_title); ?>">
                                        </li>
                                        <?php endif; ?>
                                        <?php if($collect_amount >= $badges['setting']->author_collect_level_four && $badges['setting']->author_collect_level_five > $collect_amount): ?> 
                                        <li>
                                        <img src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($badges['setting']->author_collect_level_four_icon); ?>" border="0" class="other-badges" title="<?php echo e(Helper::translation(6015,$translate)); ?> 4: <?php echo e(Helper::translation(6018,$translate)); ?> <?php echo e($badges['setting']->author_collect_level_four); ?>+ <?php echo e(Helper::translation(6021,$translate)); ?> <?php echo e($allsettings->site_title); ?>">
                                        </li>
                                        <?php endif; ?>
                                        <?php if($collect_amount >= $badges['setting']->author_collect_level_five && $badges['setting']->author_collect_level_six > $collect_amount): ?> 
                                        <li>
                                        <img src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($badges['setting']->author_collect_level_five_icon); ?>" border="0" class="other-badges" title="<?php echo e(Helper::translation(6015,$translate)); ?> 5: <?php echo e(Helper::translation(6018,$translate)); ?> <?php echo e($badges['setting']->author_collect_level_five); ?>+ <?php echo e(Helper::translation(6021,$translate)); ?> <?php echo e($allsettings->site_title); ?>">
                                        </li>
                                        <?php endif; ?>
                                        <?php if($collect_amount >= $badges['setting']->author_collect_level_six): ?> 
                                        <li>
                                        <img src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($badges['setting']->author_collect_level_six_icon); ?>" border="0" class="other-badges" title="<?php echo e(Helper::translation(6015,$translate)); ?> 6: <?php echo e(Helper::translation(6018,$translate)); ?> <?php echo e($badges['setting']->author_collect_level_six); ?>+ <?php echo e(Helper::translation(6021,$translate)); ?> <?php echo e($allsettings->site_title); ?>">
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
              <?php if($user['user']->profile_heading != ""): ?>
              <div data-aos="fade-up" data-aos-delay="200">
              <hr class="my-4">
              <h6><?php echo e(Helper::translation(3124,$translate)); ?></h6>
              <p class="font-size-ms text-muted">
              <b><?php echo e($user['user']->profile_heading); ?></b><br/>
              <?php echo e($user['user']->about); ?>

              </p>
              </div>
              <?php endif; ?>
              <div data-aos="fade-up" data-aos-delay="200">
              <hr class="my-4">
              <h6><?php echo e(Helper::translation(3206,$translate)); ?></h6>
              <a class="social-btn sb-facebook sb-outline sb-sm mr-2 mb-2" href="<?php echo e($user['user']->facebook_url); ?>" target="_blank"><i class="dwg-facebook"></i></a>
              <a class="social-btn sb-twitter sb-outline sb-sm mr-2 mb-2" href="<?php echo e($user['user']->twitter_url); ?>" target="_blank"><i class="dwg-twitter"></i></a>
              <a class="social-btn sb-pinterest sb-outline sb-sm mr-2 mb-2" href="<?php echo e($user['user']->gplus_url); ?>" target="_blank"><i class="dwg-google"></i></a>
              </div>
              <?php if(Auth::check()): ?>
              <?php if($addition_settings->subscription_mode == 0): ?>
              <div data-aos="fade-up" data-aos-delay="200">
                  <hr class="my-4">
                  <h6 class="pb-1"><?php echo e(Helper::translation(3204,$translate)); ?></h6>
                  <div class="form-group">
                      <input type="text" value="<?php echo e(URL::to('/')); ?>/?ref=<?php echo e($user['user']->id); ?>" id="myInput" class="form-control" readonly="readonly">
                    </div>
                    <a href="javascript:void(0)" onclick="myFunction()" class="btn btn-primary btn-sm"><?php echo e(Helper::translation(3205,$translate)); ?></a>
               </div>
              <?php else: ?>
              <?php if(Auth::user()->user_subscr_date >= date('Y-m-d')): ?>
                  <div data-aos="fade-up" data-aos-delay="200">
                  <hr class="my-4">
                  <h6 class="pb-1"><?php echo e(Helper::translation(3204,$translate)); ?></h6>
                  <div class="form-group">
                      <input type="text" value="<?php echo e(URL::to('/')); ?>/?ref=<?php echo e($user['user']->id); ?>" id="myInput" class="form-control" readonly="readonly">
                    </div>
                    <a href="javascript:void(0)" onclick="myFunction()" class="btn btn-primary btn-sm"><?php echo e(Helper::translation(3205,$translate)); ?></a>
                  </div> 
                  <?php endif; ?> 
              <?php endif; ?>    
              <?php endif; ?>
              <div data-aos="fade-up" data-aos-delay="200">
              <hr class="my-4">
              <ul class="profile-menu">
                <li>
                  <a href="<?php echo e(url('/user')); ?>/<?php echo e($user['user']->username); ?>"><span class="dwg-home"></span> <?php echo e(Helper::translation(2926,$translate)); ?></a>
                </li>
                <?php if($user['user']->user_type == 'vendor'): ?>
                <li>
                <a href="<?php echo e(url('/user-reviews')); ?>/<?php echo e($user['user']->username); ?>"><span class="dwg-star"></span> <?php echo e(Helper::translation(3207,$translate)); ?></a>
                </li>
                <?php endif; ?>
                <li>
                <a href="<?php echo e(url('/user-followers')); ?>/<?php echo e($user['user']->username); ?>"><span class="dwg-user"></span> <?php echo e(Helper::translation(3197,$translate)); ?> (<?php echo e($followercount); ?>)</a>
                </li>
                <li>
                <a href="<?php echo e(url('/user-following')); ?>/<?php echo e($user['user']->username); ?>"><span class="dwg-user"></span> <?php echo e(Helper::translation(3201,$translate)); ?> (<?php echo e($followingcount); ?>)</a>
                </li>
              </ul>
              </div>
              <?php if(Auth::check()): ?>
              <?php if($user['user']->username != Auth::user()->username): ?>
              <div data-aos="fade-up" data-aos-delay="200">
              <hr class="my-4">
              <h6 class="pb-1"><?php echo e(Helper::translation(2915,$translate)); ?> <?php echo e($user['user']->username); ?></h6>
              <form action="<?php echo e(route('user')); ?>" class="setting_form" id="item_form" method="post" enctype="multipart/form-data">
              <?php echo e(csrf_field()); ?>

              <div class="form-group">
                  <textarea name="message" class="form-control" id="author-message" rows="6" placeholder="<?php echo e(Helper::translation(3209,$translate)); ?>" data-bvalidator="required"></textarea>
                  <input type="hidden" name="from_email" value="<?php echo e(Auth::user()->email); ?>" />
                  <input type="hidden" name="from_name" value="<?php echo e(Auth::user()->name); ?>" />
                  <input type="hidden" name="to_email" value="<?php echo e($user['user']->email); ?>" />
                  <input type="hidden" name="to_name" value="<?php echo e($user['user']->name); ?>" />
                  <input type="hidden" name="to_id" value="<?php echo e($user['user']->id); ?>" />
                </div>
                <button class="btn btn-primary btn-sm btn-block" type="submit"><?php echo e(Helper::translation(3210,$translate)); ?></button>
              </form>
              </div>
              <?php endif; ?>
              <?php endif; ?>
              <?php if(Auth::guest()): ?>
              <div data-aos="fade-up" data-aos-delay="200">
              <hr class="my-4">
              <h6 class="pb-1"><?php echo e(Helper::translation(2915,$translate)); ?> <?php echo e($user['user']->username); ?></h6>
              <p class="font-size-ms text-muted">
                  <?php echo e(Helper::translation(3061,$translate)); ?> <a href="<?php echo e(url('/login')); ?>"><?php echo e(Helper::translation(3020,$translate)); ?></a> <?php echo e(Helper::translation(3062,$translate)); ?>

              </p>
              </div>
              <?php endif; ?> 
            </div>
          </aside><?php /**PATH D:\xampp\htdocs\fickrr\resources\views/user-menu.blade.php ENDPATH**/ ?>