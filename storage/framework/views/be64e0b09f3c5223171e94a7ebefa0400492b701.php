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
    <?php if(in_array('settings',$avilable)): ?> 
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">

       
                       <?php echo $__env->make('admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                       

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1><?php echo e(Helper::translation(5493,$translate)); ?></h1>
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
                           <form action="<?php echo e(route('admin.limitation-settings')); ?>" method="post" id="setting_form" enctype="multipart/form-data">
                           <?php echo e(csrf_field()); ?>

                           <?php endif; ?>
                          
                           <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                           
                                              
                                            
                                            <div class="form-group">
                                                <label for="product_per_page" class="control-label mb-1"><?php echo e(Helper::translation(5496,$translate)); ?><span class="require">*</span></label>
                                                <input id="site_item_per_page" name="site_item_per_page" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->site_item_per_page); ?>" data-bvalidator="required,min[1]">
                                            </div> 
                                            
                                            <div class="form-group">
                                                <label for="comment_per_page" class="control-label mb-1"><?php echo e(Helper::translation(5499,$translate)); ?><span class="require">*</span></label>
                                                <input id="site_comment_per_page" name="site_comment_per_page" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->site_comment_per_page); ?>" data-bvalidator="required,min[1]">
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
                                                <label for="post_per_page" class="control-label mb-1"><?php echo e(Helper::translation(5502,$translate)); ?><span class="require">*</span></label>
                                                <input id="site_post_per_page" name="site_post_per_page" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->site_post_per_page); ?>" data-bvalidator="required,min[1]">
                                            </div> 
                                            
                                             <div class="form-group">
                                                <label for="review_per_page" class="control-label mb-1"><?php echo e(Helper::translation(5505,$translate)); ?><span class="require">*</span></label>
                                                <input id="site_review_per_page" name="site_review_per_page" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->site_review_per_page); ?>" data-bvalidator="required,min[1]">
                                            </div> 
                                            
                                           <input type="hidden" name="sid" value="1">
                             
                             
                             </div>
                                </div>

                            </div>
                             
                             
                             
                             </div>
                             
                             <div class="col-md-12"><div class="card-body"><h4><?php echo e(Helper::translation(5508,$translate)); ?></h4></div></div>
                             
                             <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(5511,$translate)); ?>? <span class="require">*</span></label><br/>
                                               <input id="site_menu_category" name="site_menu_category" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->site_menu_category); ?>" data-bvalidator="required">
                                                
                                                
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
                                                <label for="site_loader_display" class="control-label mb-1"><?php echo e(Helper::translation(5514,$translate)); ?>?<span class="require">*</span></label><br/>
                                               
                                                <select name="menu_categories_order" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="asc" <?php if($setting['setting']->menu_categories_order == 'asc'): ?> selected <?php endif; ?>><?php echo e(Helper::translation(5517,$translate)); ?></option>
                                                <option value="desc" <?php if($setting['setting']->menu_categories_order == 'desc'): ?> selected <?php endif; ?>><?php echo e(Helper::translation(5520,$translate)); ?></option>
                                                </select>
                                                
                                             </div>
                                             <small><?php echo e(Helper::translation(5523,$translate)); ?> | <?php echo e(Helper::translation(5526,$translate)); ?></small>
                                             
                                             
                                             
                                    </div>
                                </div>

                            </div>
                            </div>
                            
                            
                            <div class="col-md-12"><div class="card-body"><h4><?php echo e(Helper::translation(5529,$translate)); ?></h4></div></div>
                            
                            <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(5532,$translate)); ?>? <span class="require">*</span></label><br/>
                                               <input id="footer_menu_display_categories" name="footer_menu_display_categories" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->footer_menu_display_categories); ?>" data-bvalidator="required">
                                                
                                                
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
                                                <label for="site_loader_display" class="control-label mb-1"><?php echo e(Helper::translation(5514,$translate)); ?>?<span class="require">*</span></label><br/>
                                               
                                                <select name="footer_menu_categories_order" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="asc" <?php if($setting['setting']->footer_menu_categories_order == 'asc'): ?> selected <?php endif; ?>><?php echo e(Helper::translation(5517,$translate)); ?></option>
                                                <option value="desc" <?php if($setting['setting']->footer_menu_categories_order == 'desc'): ?> selected <?php endif; ?>><?php echo e(Helper::translation(5520,$translate)); ?></option>
                                                </select>
                                                
                                             </div>
                                             <small><?php echo e(Helper::translation(5523,$translate)); ?> | <?php echo e(Helper::translation(5526,$translate)); ?></small>
                                             
                                             
                                             
                                    </div>
                                </div>

                            </div>
                            </div>
                             
                             
                             <div class="col-md-12"><div class="card-body"><h4><?php echo e(Helper::translation(5535,$translate)); ?></h4></div></div>
                             
                             
                             <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(5538,$translate)); ?> <span class="require">*</span></label><br/>
                                               <input id="home_featured_items" name="home_featured_items" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->home_featured_items); ?>" data-bvalidator="required">
                                                
                                                
                                             </div>
                                             
                                             
                                             <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(5541,$translate)); ?> <span class="require">*</span></label><br/>
                                               <input id="home_flash_items" name="home_flash_items" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->home_flash_items); ?>" data-bvalidator="required">
                                                
                                                
                                             </div>
                                            
                                      
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(5544,$translate)); ?> <span class="require">*</span></label><br/>
                                               <input id="home_blog_post" name="home_blog_post" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->home_blog_post); ?>" data-bvalidator="required">
                                                
                                                
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
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(5547,$translate)); ?> <span class="require">*</span></label><br/>
                                               <input id="home_popular_items" name="home_popular_items" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->home_popular_items); ?>" data-bvalidator="required">
                                                
                                                
                                             </div>
                                            
                                          <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(5550,$translate)); ?> <span class="require">*</span></label><br/>
                                               <input id="site_newest_files" name="site_newest_files" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->site_newest_files); ?>" data-bvalidator="required">
                                                
                                                
                                             </div>
                                             
                                             
                                             
                                              <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(5553,$translate)); ?> <span class="require">*</span></label><br/>
                                               <input id="home_free_items" name="home_free_items" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->home_free_items); ?>" data-bvalidator="required">
                                                
                                                
                                             </div>
                                                
                                        
                                    </div>
                                </div>

                            </div>
                            </div>
                             
                              <div class="col-md-12"><div class="card-body"><h4><?php echo e(Helper::translation(5556,$translate)); ?></h4></div></div>
                              
                              
                              <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        
                                            
                                             <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(5559,$translate)); ?> <span class="require">*</span></label><br/>
                                               <input id="site_range_min_price" name="site_range_min_price" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->site_range_min_price); ?>" data-bvalidator="required">
                                                
                                                
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
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(5562,$translate)); ?> <span class="require">*</span></label><br/>
                                               <input id="site_range_max_price" name="site_range_max_price" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->site_range_max_price); ?>" data-bvalidator="required">
                                                
                                                
                                             </div>
                                            
                                          
                                                
                                        
                                    </div>
                                </div>

                            </div>
                            </div>
                              
                              
                             
                             <div class="col-md-12 no-padding">
                             <div class="card-footer">
                                 <button type="submit" name="submit" class="btn btn-primary btn-sm"><i class="fa fa-dot-circle-o"></i> <?php echo e(Helper::translation(2876,$translate)); ?></button>
                                 <button type="reset" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i> <?php echo e(Helper::translation(4962,$translate)); ?> </button>
                             </div>
                             
                             </div>
                             
                            
                            </form>
                            
                                                    
                                                    
                                                 
                            
                        </div> 

                     
                    
                    
                    </div>
                    

                </div>
            </div><!-- .animated -->
        </div><!-- .content -->


    </div><!-- /#right-panel -->
    <!-- Right Panel -->
    <?php else: ?>
    <?php echo $__env->make('admin.denied', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

   <?php echo $__env->make('admin.javascript', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


</body>

</html>
<?php /**PATH D:\xampp\htdocs\fickrr\resources\views/admin/limitation-settings.blade.php ENDPATH**/ ?>