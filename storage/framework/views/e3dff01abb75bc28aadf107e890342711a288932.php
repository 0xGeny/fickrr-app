<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    
    <?php echo $__env->make('admin.stylesheet', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>

<body>
    
    <?php echo $__env->make('admin.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Right Panel -->
    <?php if(in_array('settings',$avilable)): ?>
    <div id="right-panel" class="right-panel">

       
                       <?php echo $__env->make('admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                       

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Badges Settings</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    
                </div>
            </div>
        </div>
        
        <?php if(session('success')): ?>
    <div class="col-sm-12">
        <div class="alert  alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
    </div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div class="col-sm-12">
        <div class="alert  alert-danger alert-dismissible fade show" role="alert">
            <?php echo e(session('error')); ?>

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
    </div>
<?php endif; ?>


<?php if($errors->any()): ?>
    <div class="col-sm-12">
     <div class="alert  alert-danger alert-dismissible fade show" role="alert">
     <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      
         <?php echo e($error); ?>

      
     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
     </div>
    </div>   
 <?php endif; ?>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                       
                        
                        
                      
                        <div class="card">
                           <?php if($demo_mode == 'on'): ?>
                           <?php echo $__env->make('admin.demo-mode', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                           <?php else: ?>
                           <form action="<?php echo e(route('admin.badges-settings')); ?>" method="post" enctype="multipart/form-data">
                           <?php echo e(csrf_field()); ?>

                           <?php endif; ?>
                          
                         
                          
                           <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">Exclusive Author Badge<span class="require">*</span></label>
                                                
                                            <input type="file" id="exclusive_author_icon" name="exclusive_author_icon" class="form-control-file" <?php if($setting['setting']->exclusive_author_icon == ''): ?> required <?php endif; ?>>
                                            <?php if($setting['setting']->exclusive_author_icon != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($setting['setting']->exclusive_author_icon); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            
                                            
                                            
                                            <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">Trends Badge<span class="require">*</span></label>
                                                
                                            <input type="file" id="trends_icon" name="trends_icon" class="form-control-file" <?php if($setting['setting']->trends_icon == ''): ?> required <?php endif; ?>>
                                            <?php if($setting['setting']->trends_icon != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($setting['setting']->trends_icon); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            
                                            
                                            
                                             
                                            
                                           
                                    </div>
                                </div>

                            </div>
                            </div>
                            
                           
                            
                             <div class="col-md-6">
                             
                             
                             <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                             
                             
                                        <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">Featured Item Badge<span class="require">*</span></label>
                                                
                                            <input type="file" id="featured_item_icon" name="featured_item_icon" class="form-control-file" <?php if($setting['setting']->featured_item_icon == ''): ?> required <?php endif; ?>>
                                            <?php if($setting['setting']->featured_item_icon != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($setting['setting']->featured_item_icon); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            
                                            
                                            <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">Free Item Badge<span class="require">*</span></label>
                                                
                                            <input type="file" id="free_item_icon" name="free_item_icon" class="form-control-file" <?php if($setting['setting']->free_item_icon == ''): ?> required <?php endif; ?>>
                                            <?php if($setting['setting']->free_item_icon != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($setting['setting']->free_item_icon); ?>" />
                                                <?php endif; ?>
                                            </div>
                                                
                                                
                                                <input type="hidden" name="sid" value="1">
                             
                             
                             </div>
                                </div>

                            </div>
                             
                             
                             
                             </div>
                             
                             <div class="col-md-12"><div class="card-body"><h4>Year of Membership Badges</h4></div></div>
                             
                             
                             <div class="col-md-6">
                             
                             
                             <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                            
                             
                                        <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">1 Year Badge<span class="require">*</span></label>
                                                
                                            <input type="file" id="one_year_icon" name="one_year_icon" class="form-control-file" <?php if($setting['setting']->one_year_icon == ''): ?> required <?php endif; ?>>
                                            <?php if($setting['setting']->one_year_icon != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($setting['setting']->one_year_icon); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            
                                            
                                            <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">2 Years Badge<span class="require">*</span></label>
                                                
                                            <input type="file" id="two_year_icon" name="two_year_icon" class="form-control-file" <?php if($setting['setting']->two_year_icon == ''): ?> required <?php endif; ?>>
                                            <?php if($setting['setting']->two_year_icon != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($setting['setting']->two_year_icon); ?>" />
                                                <?php endif; ?>
                                            </div>
                                                
                                             <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">3 Years Badge<span class="require">*</span></label>
                                                
                                            <input type="file" id="three_year_icon" name="three_year_icon" class="form-control-file" <?php if($setting['setting']->three_year_icon == ''): ?> required <?php endif; ?>>
                                            <?php if($setting['setting']->three_year_icon != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($setting['setting']->three_year_icon); ?>" />
                                                <?php endif; ?>
                                            </div>    
                                                
                                              
                                            <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">4 Years Badge<span class="require">*</span></label>
                                                
                                            <input type="file" id="four_year_icon" name="four_year_icon" class="form-control-file" <?php if($setting['setting']->four_year_icon == ''): ?> required <?php endif; ?>>
                                            <?php if($setting['setting']->four_year_icon != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($setting['setting']->four_year_icon); ?>" />
                                                <?php endif; ?>
                                            </div>   
                                                
                                            
                                            
                                            <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">5 Years Badge<span class="require">*</span></label>
                                                
                                            <input type="file" id="five_year_icon" name="five_year_icon" class="form-control-file" <?php if($setting['setting']->five_year_icon == ''): ?> required <?php endif; ?>>
                                            <?php if($setting['setting']->five_year_icon != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($setting['setting']->five_year_icon); ?>" />
                                                <?php endif; ?>
                                            </div>   
                             
                             
                             </div>
                                </div>

                            </div>
                             
                             
                             
                             </div>
                             
                             
                             <div class="col-md-6">
                             
                             
                             <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                             
                             
                                        <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">6 Years Badge<span class="require">*</span></label>
                                                
                                            <input type="file" id="six_year_icon" name="six_year_icon" class="form-control-file" <?php if($setting['setting']->six_year_icon == ''): ?> required <?php endif; ?>>
                                            <?php if($setting['setting']->six_year_icon != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($setting['setting']->six_year_icon); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            
                                            
                                            <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">7 Years Badge<span class="require">*</span></label>
                                                
                                            <input type="file" id="seven_year_icon" name="seven_year_icon" class="form-control-file" <?php if($setting['setting']->seven_year_icon == ''): ?> required <?php endif; ?>>
                                            <?php if($setting['setting']->seven_year_icon != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($setting['setting']->seven_year_icon); ?>" />
                                                <?php endif; ?>
                                            </div>
                                                
                                             <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">8 Years Badge<span class="require">*</span></label>
                                                
                                            <input type="file" id="eight_year_icon" name="eight_year_icon" class="form-control-file" <?php if($setting['setting']->eight_year_icon == ''): ?> required <?php endif; ?>>
                                            <?php if($setting['setting']->eight_year_icon != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($setting['setting']->eight_year_icon); ?>" />
                                                <?php endif; ?>
                                            </div>    
                                                
                                              
                                            <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">9 Years Badge<span class="require">*</span></label>
                                                
                                            <input type="file" id="nine_year_icon" name="nine_year_icon" class="form-control-file" <?php if($setting['setting']->nine_year_icon == ''): ?> required <?php endif; ?>>
                                            <?php if($setting['setting']->nine_year_icon != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($setting['setting']->nine_year_icon); ?>" />
                                                <?php endif; ?>
                                            </div>   
                                                
                                            
                                            
                                            <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">10 Years Badge<span class="require">*</span></label>
                                                
                                            <input type="file" id="ten_year_icon" name="ten_year_icon" class="form-control-file" <?php if($setting['setting']->ten_year_icon == ''): ?> required <?php endif; ?>>
                                            <?php if($setting['setting']->ten_year_icon != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($setting['setting']->ten_year_icon); ?>" />
                                                <?php endif; ?>
                                            </div>   
                             
                            
                             </div>
                                </div>

                            </div>
                             
                             
                             
                             </div>
                             
                             
                             
                             <div class="col-md-12"><div class="card-body"><h4>Sold Author Level</h4></div></div>
                             
                             
                             <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                            
                                        
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Sold Level 1 (<?php echo e($allsettings->site_currency); ?>)<span class="require">*</span></label><br/>
                                               <input id="author_sold_level_one" name="author_sold_level_one" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->author_sold_level_one); ?>" required>
                                                
                                                
                                             </div>
                                             
                                             
                                             <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Sold Level 2 (<?php echo e($allsettings->site_currency); ?>)<span class="require">*</span></label><br/>
                                               <input id="author_sold_level_two" name="author_sold_level_two" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->author_sold_level_two); ?>" required>
                                                
                                                
                                             </div>
                                             
                                             
                                              <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Sold Level 3 (<?php echo e($allsettings->site_currency); ?>)<span class="require">*</span></label><br/>
                                               <input id="author_sold_level_three" name="author_sold_level_three" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->author_sold_level_three); ?>" required>
                                                
                                                
                                             </div>
                                             
                                             
                                             <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Sold Level 4 (<?php echo e($allsettings->site_currency); ?>)<span class="require">*</span></label><br/>
                                               <input id="author_sold_level_four" name="author_sold_level_four" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->author_sold_level_four); ?>" required>
                                             </div>
                                             
                                             
                                             <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Sold Level 5 (<?php echo e($allsettings->site_currency); ?>)<span class="require">*</span></label><br/>
                                               <input id="author_sold_level_five" name="author_sold_level_five" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->author_sold_level_five); ?>" required>
                                             </div>
                                             
                                             
                                             <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Sold Level 6+ (<?php echo e($allsettings->site_currency); ?>)<span class="require">*</span></label><br/>
                                               <input id="author_sold_level_six" name="author_sold_level_six" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->author_sold_level_six); ?>" required>
                                               
                                             </div>
                                             
                                             
                                             
                                             <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Power Elite Author Label (sold level 6+)<span class="require">*</span></label><br/>
                                               <input id="author_sold_level_six_label" name="author_sold_level_six_label" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->author_sold_level_six_label); ?>" placeholder="Power Elite Author" required>
                                             </div>
                                            
                                      
                                        
                                    </div>
                                </div>

                            </div>
                            </div>
                            
                            
                            
                            <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                      
                                          <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">Level 1 Badge<span class="require">*</span></label>
                                                
                                            <input type="file" id="author_sold_level_one_icon" name="author_sold_level_one_icon" class="form-control-file" <?php if($setting['setting']->author_sold_level_one_icon == ''): ?> required <?php endif; ?>>
                                            <?php if($setting['setting']->author_sold_level_one_icon != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($setting['setting']->author_sold_level_one_icon); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            
                                            
                                            
                                            <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">Level 2 Badge<span class="require">*</span></label>
                                                
                                            <input type="file" id="author_sold_level_two_icon" name="author_sold_level_two_icon" class="form-control-file" <?php if($setting['setting']->author_sold_level_two_icon == ''): ?> required <?php endif; ?>>
                                            <?php if($setting['setting']->author_sold_level_two_icon != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($setting['setting']->author_sold_level_two_icon); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            
                                            
                                            
                                             <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">Level 3 Badge<span class="require">*</span></label>
                                                
                                            <input type="file" id="author_sold_level_three_icon" name="author_sold_level_three_icon" class="form-control-file" <?php if($setting['setting']->author_sold_level_three_icon == ''): ?> required <?php endif; ?>>
                                            <?php if($setting['setting']->author_sold_level_three_icon != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($setting['setting']->author_sold_level_three_icon); ?>" />
                                                <?php endif; ?>
                                            </div>
                                       
                                        
                                        
                                           <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">Level 4 Badge<span class="require">*</span></label>
                                                
                                            <input type="file" id="author_sold_level_four_icon" name="author_sold_level_four_icon" class="form-control-file" <?php if($setting['setting']->author_sold_level_four_icon == ''): ?> required <?php endif; ?>>
                                            <?php if($setting['setting']->author_sold_level_four_icon != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($setting['setting']->author_sold_level_four_icon); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            
                                            
                                            <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">Level 5 Badge<span class="require">*</span></label>
                                                
                                            <input type="file" id="author_sold_level_five_icon" name="author_sold_level_five_icon" class="form-control-file" <?php if($setting['setting']->author_sold_level_five_icon == ''): ?> required <?php endif; ?>>
                                            <?php if($setting['setting']->author_sold_level_five_icon != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($setting['setting']->author_sold_level_five_icon); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            
                                            
                                            <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">Level 6 Badge<span class="require">*</span></label>
                                                
                                            <input type="file" id="author_sold_level_six_icon" name="author_sold_level_six_icon" class="form-control-file" <?php if($setting['setting']->author_sold_level_six_icon == ''): ?> required <?php endif; ?>>
                                            <?php if($setting['setting']->author_sold_level_six_icon != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($setting['setting']->author_sold_level_six_icon); ?>" />
                                                <?php endif; ?>
                                            </div> 
                                            
                                            
                                            
                                            <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">Power Elite Author Badge<span class="require">*</span></label>
                                                
                                            <input type="file" id="power_elite_author_icon" name="power_elite_author_icon" class="form-control-file" <?php if($setting['setting']->power_elite_author_icon == ''): ?> required <?php endif; ?>>
                                            <?php if($setting['setting']->power_elite_author_icon != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($setting['setting']->power_elite_author_icon); ?>" />
                                                <?php endif; ?>
                                            </div> 
                                      
                                        
                                    </div>
                                </div>

                            </div>
                            </div>
                            
                            
                            
                            <div class="col-md-12"><div class="card-body"><h4>Collector Author Level</h4></div></div>
                            
                            <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Collected Level 1 (items)<span class="require">*</span></label><br/>
                                               <input id="author_collect_level_one" name="author_collect_level_one" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->author_collect_level_one); ?>" required>
                                                
                                                
                                             </div>
                                             
                                             
                                             <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Collected Level 2 (items)<span class="require">*</span></label><br/>
                                               <input id="author_collect_level_two" name="author_collect_level_two" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->author_collect_level_two); ?>" required>
                                                
                                                
                                             </div>
                                             
                                             
                                              <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Collected Level 3 (items)<span class="require">*</span></label><br/>
                                               <input id="author_collect_level_three" name="author_collect_level_three" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->author_collect_level_three); ?>" required>
                                                
                                                
                                             </div>
                                             
                                             
                                             <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Collected Level 4 (items)<span class="require">*</span></label><br/>
                                               <input id="author_collect_level_four" name="author_collect_level_four" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->author_collect_level_four); ?>" required>
                                             </div>
                                             
                                             
                                             <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Collected Level 5 (items)<span class="require">*</span></label><br/>
                                               <input id="author_collect_level_five" name="author_collect_level_five" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->author_collect_level_five); ?>" required>
                                             </div>
                                             
                                             
                                             <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Collected Level 6+ (items)<span class="require">*</span></label><br/>
                                               <input id="author_collect_level_six" name="author_collect_level_six" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->author_collect_level_six); ?>" required>
                                              
                                             </div>
                                            
                                      
                                        
                                    </div>
                                </div>

                            </div>
                            </div>
                            
                            
                            <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                             
                             
                                       
                                       
                                          <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">Level 1 Badge<span class="require">*</span></label>
                                                
                                            <input type="file" id="author_collect_level_one_icon" name="author_collect_level_one_icon" class="form-control-file" <?php if($setting['setting']->author_collect_level_one_icon == ''): ?> required <?php endif; ?>>
                                            <?php if($setting['setting']->author_collect_level_one_icon != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($setting['setting']->author_collect_level_one_icon); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            
                                            
                                            
                                            <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">Level 2 Badge<span class="require">*</span></label>
                                                
                                            <input type="file" id="author_collect_level_two_icon" name="author_collect_level_two_icon" class="form-control-file" <?php if($setting['setting']->author_collect_level_two_icon == ''): ?> required <?php endif; ?>>
                                            <?php if($setting['setting']->author_collect_level_two_icon != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($setting['setting']->author_collect_level_two_icon); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            
                                            
                                            
                                             <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">Level 3 Badge<span class="require">*</span></label>
                                                
                                            <input type="file" id="author_collect_level_three_icon" name="author_collect_level_three_icon" class="form-control-file" <?php if($setting['setting']->author_collect_level_three_icon == ''): ?> required <?php endif; ?>>
                                            <?php if($setting['setting']->author_collect_level_three_icon != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($setting['setting']->author_collect_level_three_icon); ?>" />
                                                <?php endif; ?>
                                            </div>
                                       
                                        
                                        
                                           <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">Level 4 Badge<span class="require">*</span></label>
                                                
                                            <input type="file" id="author_collect_level_four_icon" name="author_collect_level_four_icon" class="form-control-file" <?php if($setting['setting']->author_collect_level_four_icon == ''): ?> required <?php endif; ?>>
                                            <?php if($setting['setting']->author_collect_level_four_icon != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($setting['setting']->author_collect_level_four_icon); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            
                                            
                                            <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">Level 5 Badge<span class="require">*</span></label>
                                                
                                            <input type="file" id="author_collect_level_five_icon" name="author_collect_level_five_icon" class="form-control-file" <?php if($setting['setting']->author_collect_level_five_icon == ''): ?> required <?php endif; ?>>
                                            <?php if($setting['setting']->author_collect_level_five_icon != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($setting['setting']->author_collect_level_five_icon); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            
                                            
                                            <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">Level 6 Badge<span class="require">*</span></label>
                                                
                                            <input type="file" id="author_collect_level_six_icon" name="author_collect_level_six_icon" class="form-control-file" <?php if($setting['setting']->author_collect_level_six_icon == ''): ?> required <?php endif; ?>>
                                            <?php if($setting['setting']->author_collect_level_six_icon != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($setting['setting']->author_collect_level_six_icon); ?>" />
                                                <?php endif; ?>
                                            </div>  
                                      
                            
                                    </div>
                                </div>

                            </div>
                            </div>
                            
                             <div class="col-md-12"><div class="card-body"><h4>Referral Author Level</h4></div></div>
                             
                             <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Referred Level 1 (members)<span class="require">*</span></label><br/>
                                               <input id="author_referral_level_one" name="author_referral_level_one" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->author_referral_level_one); ?>" required>
                                                
                                                
                                             </div>
                                             
                                             
                                             <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Referred Level 2 (members)<span class="require">*</span></label><br/>
                                               <input id="author_referral_level_two" name="author_referral_level_two" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->author_referral_level_two); ?>" required>
                                                
                                                
                                             </div>
                                             
                                             
                                              <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Referred Level 3 (members)<span class="require">*</span></label><br/>
                                               <input id="author_referral_level_three" name="author_referral_level_three" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->author_referral_level_three); ?>" required>
                                                
                                                
                                             </div>
                                             
                                             
                                             <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Referred Level 4 (members)<span class="require">*</span></label><br/>
                                               <input id="author_referral_level_four" name="author_referral_level_four" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->author_referral_level_four); ?>" required>
                                             </div>
                                             
                                             
                                             <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Referred Level 5 (members)<span class="require">*</span></label><br/>
                                               <input id="author_referral_level_five" name="author_referral_level_five" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->author_referral_level_five); ?>" required>
                                             </div>
                                             
                                             
                                             <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Referred Level 6+ (members)<span class="require">*</span></label><br/>
                                               <input id="author_referral_level_six" name="author_referral_level_six" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->author_referral_level_six); ?>" required>
                                              
                                             </div>
                                            
                                      
                                        
                                    </div>
                                </div>

                            </div>
                            </div>
                            
                            
                            
                            <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                            
                                       
                                          <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">Level 1 Badge<span class="require">*</span></label>
                                                
                                            <input type="file" id="author_referral_level_one_icon" name="author_referral_level_one_icon" class="form-control-file" <?php if($setting['setting']->author_referral_level_one_icon == ''): ?> required <?php endif; ?>>
                                            <?php if($setting['setting']->author_referral_level_one_icon != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($setting['setting']->author_referral_level_one_icon); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            
                                            
                                            
                                            <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">Level 2 Badge<span class="require">*</span></label>
                                                
                                            <input type="file" id="author_referral_level_two_icon" name="author_referral_level_two_icon" class="form-control-file" <?php if($setting['setting']->author_referral_level_two_icon == ''): ?> required <?php endif; ?>>
                                            <?php if($setting['setting']->author_referral_level_two_icon != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($setting['setting']->author_referral_level_two_icon); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            
                                            
                                            
                                             <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">Level 3 Badge<span class="require">*</span></label>
                                                
                                            <input type="file" id="author_referral_level_three_icon" name="author_referral_level_three_icon" class="form-control-file" <?php if($setting['setting']->author_referral_level_three_icon == ''): ?> required <?php endif; ?>>
                                            <?php if($setting['setting']->author_referral_level_three_icon != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($setting['setting']->author_referral_level_three_icon); ?>" />
                                                <?php endif; ?>
                                            </div>
                                       
                                        
                                        
                                           <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">Level 4 Badge<span class="require">*</span></label>
                                                
                                            <input type="file" id="author_referral_level_four_icon" name="author_referral_level_four_icon" class="form-control-file" <?php if($setting['setting']->author_referral_level_four_icon == ''): ?> required <?php endif; ?>>
                                            <?php if($setting['setting']->author_referral_level_four_icon != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($setting['setting']->author_referral_level_four_icon); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            
                                            
                                            <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">Level 5 Badge<span class="require">*</span></label>
                                                
                                            <input type="file" id="author_referral_level_five_icon" name="author_referral_level_five_icon" class="form-control-file" <?php if($setting['setting']->author_referral_level_five_icon == ''): ?> required <?php endif; ?>>
                                            <?php if($setting['setting']->author_referral_level_five_icon != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($setting['setting']->author_referral_level_five_icon); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            
                                            
                                            <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">Level 6 Badge<span class="require">*</span></label>
                                                
                                            <input type="file" id="author_referral_level_six_icon" name="author_referral_level_six_icon" class="form-control-file" <?php if($setting['setting']->author_referral_level_six_icon == ''): ?> required <?php endif; ?>>
                                            <?php if($setting['setting']->author_referral_level_six_icon != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/public/storage/badges/<?php echo e($setting['setting']->author_referral_level_six_icon); ?>" />
                                                <?php endif; ?>
                                            </div>  
                                      
                                        
                                    </div>
                                </div>

                            </div>
                            </div>
                             
                             <input type="hidden" name="save_exclusive_author_icon" value="<?php echo e($setting['setting']->exclusive_author_icon); ?>">
                            <input type="hidden" name="save_author_sold_level_one_icon" value="<?php echo e($setting['setting']->author_sold_level_one_icon); ?>">
                            <input type="hidden" name="save_author_sold_level_two_icon" value="<?php echo e($setting['setting']->author_sold_level_two_icon); ?>">
                            <input type="hidden" name="save_author_sold_level_three_icon" value="<?php echo e($setting['setting']->author_sold_level_three_icon); ?>">
                            <input type="hidden" name="save_author_sold_level_four_icon" value="<?php echo e($setting['setting']->author_sold_level_four_icon); ?>">
                            <input type="hidden" name="save_author_sold_level_five_icon" value="<?php echo e($setting['setting']->author_sold_level_five_icon); ?>">
                            <input type="hidden" name="save_author_sold_level_six_icon" value="<?php echo e($setting['setting']->author_sold_level_six_icon); ?>">
                            <input type="hidden" name="save_author_collect_level_one_icon" value="<?php echo e($setting['setting']->author_collect_level_one_icon); ?>">
                            <input type="hidden" name="save_author_collect_level_two_icon" value="<?php echo e($setting['setting']->author_collect_level_two_icon); ?>">
                            <input type="hidden" name="save_author_collect_level_three_icon" value="<?php echo e($setting['setting']->author_collect_level_three_icon); ?>">
                            <input type="hidden" name="save_author_collect_level_four_icon" value="<?php echo e($setting['setting']->author_collect_level_four_icon); ?>">
                            <input type="hidden" name="save_author_collect_level_five_icon" value="<?php echo e($setting['setting']->author_collect_level_five_icon); ?>">
                            <input type="hidden" name="save_author_collect_level_six_icon" value="<?php echo e($setting['setting']->author_collect_level_six_icon); ?>">
                            <input type="hidden" name="save_author_referral_level_one_icon" value="<?php echo e($setting['setting']->author_referral_level_one_icon); ?>">
                            <input type="hidden" name="save_author_referral_level_two_icon" value="<?php echo e($setting['setting']->author_referral_level_two_icon); ?>">
                            <input type="hidden" name="save_author_referral_level_three_icon" value="<?php echo e($setting['setting']->author_referral_level_three_icon); ?>">
                            <input type="hidden" name="save_author_referral_level_four_icon" value="<?php echo e($setting['setting']->author_referral_level_four_icon); ?>">
                            <input type="hidden" name="save_author_referral_level_five_icon" value="<?php echo e($setting['setting']->author_referral_level_five_icon); ?>">
                            <input type="hidden" name="save_author_referral_level_six_icon" value="<?php echo e($setting['setting']->author_referral_level_six_icon); ?>">
                            <input type="hidden" name="save_trends_icon" value="<?php echo e($setting['setting']->trends_icon); ?>">
                            <input type="hidden" name="save_featured_item_icon" value="<?php echo e($setting['setting']->featured_item_icon); ?>">
                            <input type="hidden" name="save_power_elite_author_icon" value="<?php echo e($setting['setting']->power_elite_author_icon); ?>">
                            <input type="hidden" name="save_free_item_icon" value="<?php echo e($setting['setting']->free_item_icon); ?>">
                            <input type="hidden" name="save_one_year_icon" value="<?php echo e($setting['setting']->one_year_icon); ?>">
                            <input type="hidden" name="save_two_year_icon" value="<?php echo e($setting['setting']->two_year_icon); ?>">
                            <input type="hidden" name="save_three_year_icon" value="<?php echo e($setting['setting']->three_year_icon); ?>">
                            <input type="hidden" name="save_four_year_icon" value="<?php echo e($setting['setting']->four_year_icon); ?>">
                            <input type="hidden" name="save_five_year_icon" value="<?php echo e($setting['setting']->five_year_icon); ?>">
                            <input type="hidden" name="save_six_year_icon" value="<?php echo e($setting['setting']->six_year_icon); ?>">
                            <input type="hidden" name="save_seven_year_icon" value="<?php echo e($setting['setting']->seven_year_icon); ?>">
                            <input type="hidden" name="save_eight_year_icon" value="<?php echo e($setting['setting']->eight_year_icon); ?>">
                            <input type="hidden" name="save_nine_year_icon" value="<?php echo e($setting['setting']->nine_year_icon); ?>">
                            <input type="hidden" name="save_ten_year_icon" value="<?php echo e($setting['setting']->ten_year_icon); ?>">
                            
                             <div class="col-md-12 no-padding">
                             <div class="card-footer">
                                                        <button type="submit" name="submit" class="btn btn-primary btn-sm">
                                                            <i class="fa fa-dot-circle-o"></i> Submit
                                                        </button>
                                                        <button type="reset" class="btn btn-danger btn-sm">
                                                            <i class="fa fa-ban"></i> Reset
                                                        </button>
                                                    </div>
                             
                             </div>
                             
                            
                            </form>
                            
                                                    
                                                    
                                                 
                            
                        </div> 

                     
                    
                    
                    </div>
                    

                </div>
            </div><!-- .animated -->
        </div><!-- .content -->


    </div><!-- /#right-panel -->
    <?php else: ?>
    <?php echo $__env->make('admin.denied', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <!-- Right Panel -->


   <?php echo $__env->make('admin.javascript', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


</body>

</html>
<?php /**PATH D:\xampp\htdocs\fickrr\resources\views/admin/badges-settings.blade.php ENDPATH**/ ?>