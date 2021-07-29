<section class="bg-position-center-top" style="background-image: url('<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_banner); ?>');">
      <div class="py-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-star">
              <li class="breadcrumb-item"><a class="text-nowrap" href="<?php echo e(URL::to('/')); ?>"><i class="dwg-home"></i><?php echo e(Helper::translation(3018,$translate)); ?></a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page"><?php echo e(Helper::translation(3018,$translate)); ?></li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 mb-0 text-white"><?php echo e(Helper::translation(3018,$translate)); ?></h1>
        </div>
      </div>
      </div>
    </section>
    <section class="why_choose">
      <div class="container">
          <div class="row border-bottom features mt-3 pt-3">
            <div class="col-lg-6 col-md-6 mt-3 mb-3 pt-3 pb-3 right-border border-data">
                  <div class="icon">
									<?php if($setting['setting']->box1_icon != ''): ?>
                                    <img src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($setting['setting']->box1_icon); ?>" alt="<?php echo e($setting['setting']->box1_title); ?>" class="img-fluid icon-img">
                                    <?php endif; ?>
									</div>
									<div class="info">
									<h3 class="pt-0"><?php echo e($setting['setting']->box1_title); ?></h3>
									<p class="no-margin"><?php echo nl2br($setting['setting']->box1_text) ?></p>
						         </div>
                            </div>
                   <div class="col-lg-6 col-md-6 mt-3 mb-3 pt-3 pb-3 border-data">
                        <div class="icon">
									<?php if($setting['setting']->box2_icon != ''): ?>
                                    <img src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($setting['setting']->box2_icon); ?>" alt="<?php echo e($setting['setting']->box2_title); ?>" class="img-fluid icon-img">
                                    <?php endif; ?>
									</div>
									<div class="info">
								    <h3 class="pt-0"><?php echo e($setting['setting']->box2_title); ?></h3>
								   <p class="no-margin"><?php echo nl2br($setting['setting']->box2_text) ?></p>
						       </div>
                           </div>
                <div class="col-lg-6 col-md-6 mt-3 mb-3 pt-3 pb-3 right-border">
                      <div class="icon">
									<?php if($setting['setting']->box3_icon != ''): ?>
                                    <img src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($setting['setting']->box3_icon); ?>" alt="<?php echo e($setting['setting']->box3_title); ?>" class="img-fluid icon-img">
                                    <?php endif; ?>
									</div>
									<div class="info">
									<h3 class="pt-0"><?php echo e($setting['setting']->box3_title); ?></h3>
									<p class="no-margin"><?php echo nl2br($setting['setting']->box3_text) ?></p>
						       </div>
                           </div>
                      <div class="col-lg-6 col-md-6 mt-3 mb-3 pt-3 pb-3 ">
                          <div class="icon">
									<?php if($setting['setting']->box4_icon != ''): ?>
                                    <img src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($setting['setting']->box4_icon); ?>" alt="<?php echo e($setting['setting']->box4_title); ?>" class="img-fluid icon-img">
                                    <?php endif; ?>
									</div>
									<div class="info">
									<h3 class="pt-0"><?php echo e($setting['setting']->box4_title); ?></h3>
								    <p class="no-margin"><?php echo nl2br($setting['setting']->box4_text) ?></p>
						        </div>
                           </div>
                       </div>
                     <div class="row border-bottom features pt-2 pb-5">
                     <div class="col-lg-12 col-md-12 mt-3 mb-3 pt-3 pb-3 text-center">
                     <h3><?php echo e($setting['setting']->three_box_heading); ?></h3>
                     </div>
                     <div class="col-lg-4 col-md-4 col-sm-12 mt-3 mb-3 pt-3 pb-3 right-border">
                       <div class="icon">
									<?php if($setting['setting']->box5_icon != ''): ?>
                                    <img src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($setting['setting']->box5_icon); ?>" alt="<?php echo e($setting['setting']->box5_title); ?>" class="img-fluid icon-img">
                                    <?php endif; ?>
									</div>
									<div class="info">
										<h3 class="pt-0"><?php echo e($setting['setting']->box5_title); ?></h3>
										<p class="no-margin"><?php echo nl2br($setting['setting']->box5_text) ?></p>
						             </div>
                                 </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 mt-3  mb-3 pt-3 pb-3 right-border">
                            <div class="icon">
									<?php if($setting['setting']->box6_icon != ''): ?>
                                    <img src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($setting['setting']->box6_icon); ?>" alt="<?php echo e($setting['setting']->box6_title); ?>" class="img-fluid icon-img">
                                    <?php endif; ?>
									</div>
									<div class="info">
										<h3 class="pt-0"><?php echo e($setting['setting']->box6_title); ?></h3>
										<p class="no-margin"><?php echo nl2br($setting['setting']->box6_text) ?></p>
						             </div>
                                 </div>
                           <div class="col-lg-4 col-md-4 col-sm-12 mt-3 mb-3 pt-3 pb-3">
                             <div class="icon">
									<?php if($setting['setting']->box7_icon != ''): ?>
                                    <img src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($setting['setting']->box7_icon); ?>" alt="<?php echo e($setting['setting']->box7_title); ?>" class="img-fluid icon-img">
                                    <?php endif; ?>
									</div>
									<div class="info">
										<h3 class="pt-0"><?php echo e($setting['setting']->box7_title); ?></h3>
										<p class="no-margin"><?php echo nl2br($setting['setting']->box7_text) ?></p>
						            </div>
                               </div>
                           </div>
                        </div>
        <!-- end /.container -->
           </section>   
           <section class="ash-bg">
              <div class="container">
                  <div class="row border-bottom features">
                    <div class="col-lg-12 col-md-12 mt-3 mb-3 pt-3 pb-3">
                    <h3 class="mb-3"><?php echo e($setting['setting']->content_title_one); ?></h3>
                    <div>
                    <?php echo html_entity_decode($setting['setting']->content_text_one) ?>
                    </div>
                    </div>
                  </div>
              </div>   
            </section>		
			<section class="white-bg">
               <div class="container">
                 <div class="row border-bottom features">
                    <div class="col-lg-12 col-md-12 mt-3 mb-3 pt-3 pb-3">
                    <h3 class="mb-3"><?php echo e($setting['setting']->content_title_two); ?></h3>
                     <div>
                    <?php echo html_entity_decode($setting['setting']->content_text_two) ?>
                    </div>
                    </div>
                 </div>
              </div>   
            </section>   
            <section class="ash-bg">
               <div class="container">
                 <div class="row border-bottom features">
                    <div class="col-lg-12 col-md-12 mt-3 mb-3 pt-3 pb-3">
                    <h3 class="mb-3"><?php echo e($setting['setting']->content_title_three); ?></h3>
                    <div>
                    <?php echo html_entity_decode($setting['setting']->content_text_three) ?>
                    </div>
                    </div>
                 </div>
              </div>   
            </section>   
            <section class="white-bg">
               <div class="container">
                 <div class="row features mt-3 pt-5 pb-5 mb-5">
                    <div class="col-lg-12 col-md-12 text-center">
                    <h3 class="mb-3 text-center"><?php echo e($setting['setting']->button_title); ?></h3>
                    </div>
                    <div class="col-md-8 mx-auto text-center">
                   <a href="<?php echo e(url('/register')); ?>" class="btn btn-primary btn-block"><i class="fa fa-chevron-circle-right"></i> <?php echo e(Helper::translation(3187,$translate)); ?></a>
                   </div>
                  </div>
              </div>
           </section>      
           </div>
              <!-- end /.col-md-12 -->
            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </section><?php /**PATH /var/www/html/resources/views/selling.blade.php ENDPATH**/ ?>