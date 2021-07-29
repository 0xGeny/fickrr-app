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
                        <h1><?php echo e(Helper::translation(5283,$translate)); ?></h1>
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
                           <form action="<?php echo e(route('admin.general-settings')); ?>" method="post" id="setting_form" enctype="multipart/form-data">
                           <?php echo e(csrf_field()); ?>

                           <?php endif; ?>
                          
                           <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(5286,$translate)); ?> <span class="require">*</span></label>
                                                <input id="site_title" name="site_title" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->site_title); ?>" required>
                                            </div>
                                            
                                             <div class="form-group">
                                                <label for="site_desc" class="control-label mb-1"><?php echo e(Helper::translation(5289,$translate)); ?><span class="require">*</span></label>
                                                
                                            <textarea name="site_desc" id="site_desc" rows="6" placeholder="site description" class="form-control noscroll_textarea" maxlength="160" required><?php echo e($setting['setting']->site_desc); ?></textarea>
                                            </div>
                                                
                                               <div class="form-group">
                                                <label for="site_keywords" class="control-label mb-1"><?php echo e(Helper::translation(5292,$translate)); ?><span class="require">*</span></label>
                                                
                                            <textarea name="site_keywords" id="site_keywords" rows="6" placeholder="separate keywords with commas" class="form-control noscroll_textarea" maxlength="160" required><?php echo e($setting['setting']->site_keywords); ?></textarea>
                                            </div>  
                                                
                                                                                      
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(5295,$translate)); ?>? <span class="require">*</span></label>
                                                <select name="item_approval" class="form-control" required>
                                                <option value=""></option>
                                                <option value="1" <?php if($setting['setting']->item_approval == 1): ?> selected <?php endif; ?>><?php echo e(Helper::translation(2970,$translate)); ?></option>
                                                <option value="0" <?php if($setting['setting']->item_approval == 0): ?> selected <?php endif; ?>><?php echo e(Helper::translation(2971,$translate)); ?></option>
                                                </select>
                                                <small>(<?php echo e(Helper::translation(5298,$translate)); ?>) </small>
                                                
                                            </div>  
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(5301,$translate)); ?></label>
                                                <input id="office_email" name="office_email" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->office_email); ?>" required>
                                            </div>
                                                
                                             <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(5304,$translate)); ?></label>
                                                <input id="office_phone" name="office_phone" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->office_phone); ?>" required>
                                            </div> 
                                            
                                            <div class="form-group">
                                                <label for="site_desc" class="control-label mb-1"><?php echo e(Helper::translation(5307,$translate)); ?><span class="require">*</span></label>
                                                
                                            <textarea name="office_address" id="office_address" rows="6" class="form-control noscroll_textarea" required><?php echo e($setting['setting']->office_address); ?></textarea>
                                            </div>  
                                            
                                            
                                            <div class="form-group">
                                                <label for="banner_heading" class="control-label mb-1"><?php echo e(Helper::translation(5310,$translate)); ?> <span class="require">*</span></label>
                                                <input id="site_newsletter" name="site_newsletter" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->site_newsletter); ?>" required>
                                            </div> 
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(5313,$translate)); ?></label>
                                                <input id="google_analytics" name="google_analytics" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->google_analytics); ?>">
                                                <span>Example : UA-xxxxxx-1</span>
                                            </div>
                                            
                                           <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(5316,$translate)); ?>?</label>
                                                <select name="multi_language" class="form-control" required>
                                                <option value=""></option>
                                                <option value="1" <?php if($setting['setting']->multi_language == "1"): ?> selected <?php endif; ?>><?php echo e(Helper::translation(2970,$translate)); ?></option>
                                                <option value="0" <?php if($setting['setting']->multi_language == "0"): ?> selected <?php endif; ?>><?php echo e(Helper::translation(2971,$translate)); ?></option>
                                                </select>
                                                
                                                
                                            </div> 
                                            <div class="form-group">
                                              <label for="product_approval" class="control-label mb-1"><?php echo e(Helper::translation(5319,$translate)); ?>?<span class="require">*</span></label><br/>                                         <select name="email_verification" class="form-control" required>
                                                        <option value=""></option>
                                                        <option value="1" <?php if($setting['setting']->email_verification == 1): ?> selected <?php endif; ?>><?php echo e(Helper::translation(5325,$translate)); ?></option>
                                                        <option value="0" <?php if($setting['setting']->email_verification == 0): ?> selected <?php endif; ?>><?php echo e(Helper::translation(5328,$translate)); ?></option>
                                                        </select>
                                                        <small>(<?php echo e(Helper::translation(5322,$translate)); ?>)</small>
                                            </div>
                                            
                                           <div class="form-group">
                                              <label for="product_approval" class="control-label mb-1"><?php echo e(Helper::translation(5331,$translate)); ?>?<span class="require">*</span></label><br/>                                         <select name="payment_verification" class="form-control" required>
                                                        <option value=""></option>
                                                        <option value="1" <?php if($setting['setting']->payment_verification == 1): ?> selected <?php endif; ?>><?php echo e(Helper::translation(5325,$translate)); ?></option>
                                                        <option value="0" <?php if($setting['setting']->payment_verification == 0): ?> selected <?php endif; ?>><?php echo e(Helper::translation(5328,$translate)); ?></option>
                                                        </select>
                                                        <small>(<?php echo e(Helper::translation(5334,$translate)); ?>)</small>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_loader_display" class="control-label mb-1"><?php echo e(Helper::translation(5337,$translate)); ?><span class="require">*</span></label><br/>
                                               
                                                <select name="cookie_popup" class="form-control" required>
                                                <option value=""></option>
                                                
                                                <option value="1" <?php if($setting['setting']->cookie_popup == 1): ?> selected <?php endif; ?>><?php echo e(Helper::translation(2970,$translate)); ?></option>
                                                <option value="0" <?php if($setting['setting']->cookie_popup == 0): ?> selected <?php endif; ?>><?php echo e(Helper::translation(2971,$translate)); ?></option>
                                                </select>
                                              </div>
                                            
                                            <div class="form-group">
                                                <label for="site_desc" class="control-label mb-1"><?php echo e(Helper::translation(5340,$translate)); ?> <span class="require">*</span></label>
                                                
                                            <textarea name="cookie_popup_text" id="cookie_popup_text" rows="4" class="form-control noscroll_textarea" required><?php echo e($setting['setting']->cookie_popup_text); ?></textarea>
                                            </div> 
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(5343,$translate)); ?> <span class="require">*</span></label>
                                                <input id="cookie_popup_button" name="cookie_popup_button" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->cookie_popup_button); ?>" required>
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
                                                <label for="banner_heading" class="control-label mb-1"><?php echo e(Helper::translation(5346,$translate)); ?> <span class="require">*</span></label>
                                                <input id="site_banner_heading" name="site_banner_heading" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->site_banner_heading); ?>" required>
                                            </div>  
                                            
                              <div class="form-group">
                                                <label for="banner_heading" class="control-label mb-1"><?php echo e(Helper::translation(5349,$translate)); ?> <span class="require">*</span></label>
                                                <input id="site_banner_subheading" name="site_banner_subheading" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->site_banner_subheading); ?>" required>
                                            </div>              
                             
                             
                             <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1"><?php echo e(Helper::translation(5352,$translate)); ?> (<?php echo e(Helper::translation(5355,$translate)); ?> 24 x 24)<span class="require">*</span></label>
                                                
                                            <input type="file" id="site_favicon" name="site_favicon" class="form-control-file" <?php if($setting['setting']->site_favicon == ''): ?> required <?php endif; ?>>
                                            <?php if($setting['setting']->site_favicon != ''): ?>
                                                <img height="24" src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($setting['setting']->site_favicon); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_logo" class="control-label mb-1"><?php echo e(Helper::translation(5358,$translate)); ?> (<?php echo e(Helper::translation(2946,$translate)); ?> 180 x 50)<span class="require">*</span></label>
                                                
                                            <input type="file" id="site_logo" name="site_logo" class="form-control-file" <?php if($setting['setting']->site_logo == ''): ?> required <?php endif; ?>>
                                            <?php if($setting['setting']->site_logo != ''): ?>
                                                <img height="24" src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($setting['setting']->site_logo); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1"><?php echo e(Helper::translation(5361,$translate)); ?> (<?php echo e(Helper::translation(2946,$translate)); ?> 1920 x 300)<span class="require">*</span></label>
                                                
                                            <input type="file" id="site_banner" name="site_banner" class="form-control-file" <?php if($setting['setting']->site_banner == ''): ?> required <?php endif; ?>>
                                            <?php if($setting['setting']->site_banner != ''): ?>
                                                <img height="24" src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($setting['setting']->site_banner); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(5364,$translate)); ?>?<span class="require">*</span></label>
                                                <select name="watermark_option" class="form-control" required>
                                                <option value=""></option>
                                                <option value="1" <?php if($setting['setting']->watermark_option == "1"): ?> selected <?php endif; ?>><?php echo e(Helper::translation(2970,$translate)); ?></option>
                                                <option value="0" <?php if($setting['setting']->watermark_option == "0"): ?> selected <?php endif; ?>><?php echo e(Helper::translation(2971,$translate)); ?></option>
                                                </select>
                                                
                                                
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_logo" class="control-label mb-1"><?php echo e(Helper::translation(5367,$translate)); ?></label>
                                                
                                            <input type="file" id="site_watermark" name="site_watermark" class="form-control-file">
                                            <?php if($setting['setting']->site_watermark != ''): ?>
                                                <img height="150" src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($setting['setting']->site_watermark); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            
                                           
                                            <div class="form-group">
                                                <label for="site_loader_display" class="control-label mb-1"><?php echo e(Helper::translation(5370,$translate)); ?><span class="require">*</span></label><br/>
                                               
                                                <select name="site_loader_display" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" <?php if($setting['setting']->site_loader_display == 1): ?> selected <?php endif; ?>><?php echo e(Helper::translation(5325,$translate)); ?></option>
                                                <option value="0" <?php if($setting['setting']->site_loader_display == 0): ?> selected <?php endif; ?>><?php echo e(Helper::translation(5328,$translate)); ?></option>
                                                </select>
                                                
                                             </div>
                                            
                                            <div class="form-group">
                                                <label for="site_loader_image" class="control-label mb-1"><?php echo e(Helper::translation(5373,$translate)); ?> (200 X 200)<span class="require">*</span></label>
                                                
                                            <input type="file" id="site_loader_image" name="site_loader_image" class="form-control-file" <?php if($setting['setting']->site_loader_image == ''): ?> data-bvalidator="required,extension[gif]" data-bvalidator-msg="<?php echo e(Helper::translation(5376,$translate)); ?>" <?php else: ?> data-bvalidator="extension[gif]" data-bvalidator-msg="<?php echo e(Helper::translation(5376,$translate)); ?>" <?php endif; ?>>
                                            <?php if($setting['setting']->site_loader_image != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($setting['setting']->site_loader_image); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(5379,$translate)); ?> <span class="require">*</span></label>
                                                <input id="site_flash_end_date" name="site_flash_end_date" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->site_flash_end_date); ?>" required>
                                            </div> 
                                            
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(5382,$translate)); ?> <span class="require">*</span></label>
                                                <input id="site_free_end_date" name="site_free_end_date" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->site_free_end_date); ?>" required>
                                            </div> 
                                            
                                            
                                            <div class="form-group">
                                              <label for="product_approval" class="control-label mb-1"><?php echo e(Helper::translation(5385,$translate)); ?>?<span class="require">*</span></label><br/>                                         <select name="maintenance_mode" class="form-control" required>
                                                        <option value=""></option>
                                                        <option value="1" <?php if($setting['setting']->maintenance_mode == 1): ?> selected <?php endif; ?>><?php echo e(Helper::translation(5325,$translate)); ?></option>
                                                        <option value="0" <?php if($setting['setting']->maintenance_mode == 0): ?> selected <?php endif; ?>><?php echo e(Helper::translation(5328,$translate)); ?></option>
                                                        </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(5388,$translate)); ?></label>
                                                <input id="m_mode_title" name="m_mode_title" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->m_mode_title); ?>" <?php if($setting['setting']->maintenance_mode == 1): ?> required <?php endif; ?>>
                                                
                                            </div>
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(5391,$translate)); ?></label>
                                                <input id="m_mode_content" name="m_mode_content" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->m_mode_content); ?>" <?php if($setting['setting']->maintenance_mode == 1): ?> required <?php endif; ?>>
                                                
                                            </div>
                                            <div class="form-group">
                                              <label for="product_approval" class="control-label mb-1"><?php echo e(Helper::translation(5394,$translate)); ?>?<span class="require">*</span></label><br/>                                         <select name="home_blog_display" class="form-control" required>
                                                        <option value=""></option>
                                                        <option value="1" <?php if($setting['setting']->home_blog_display == 1): ?> selected <?php endif; ?>><?php echo e(Helper::translation(5325,$translate)); ?></option>
                                                        <option value="0" <?php if($setting['setting']->home_blog_display == 0): ?> selected <?php endif; ?>><?php echo e(Helper::translation(5328,$translate)); ?></option>
                                              </select>
                                            </div>
                                            
                                             <div class="form-group">
                                                <label for="site_loader_display" class="control-label mb-1"><?php echo e(Helper::translation(5397,$translate)); ?><span class="require">*</span></label><br/>
                                               
                                                <select name="item_support_link" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <?php $__currentLoopData = $page['view']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($page->page_slug); ?>" <?php if($setting['setting']->item_support_link == $page->page_slug): ?> selected <?php endif; ?>><?php echo e($page->page_title); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <small>(<?php echo e(Helper::translation(5400,$translate)); ?>)</small>
                                             </div>
                                               
                                              <div class="form-group">
                                              <label for="product_approval" class="control-label mb-1">Google Recaptcha?<span class="require">*</span></label><br/>
                                              <select name="site_google_recaptcha" class="form-control" required>
                                                        <option value=""></option>
                                                        <option value="1" <?php if($additional->site_google_recaptcha == 1): ?> selected <?php endif; ?>><?php echo e(Helper::translation(5325,$translate)); ?></option>
                                                        <option value="0" <?php if($additional->site_google_recaptcha == 0): ?> selected <?php endif; ?>><?php echo e(Helper::translation(5328,$translate)); ?></option>
                                              </select>
                                            </div> 
                                            
                                                <input type="hidden" name="save_banner" value="<?php echo e($setting['setting']->site_banner); ?>">
                                                <input type="hidden" name="save_logo" value="<?php echo e($setting['setting']->site_logo); ?>">
                                                <input type="hidden" name="save_favicon" value="<?php echo e($setting['setting']->site_favicon); ?>">
                                                <input type="hidden" name="save_watermark" value="<?php echo e($setting['setting']->site_watermark); ?>">
                                                <input type="hidden" name="save_loader_image" value="<?php echo e($setting['setting']->site_loader_image); ?>">
                                                <input type="hidden" name="sid" value="1">
                             
                             
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
    <?php else: ?>
    <?php echo $__env->make('admin.denied', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <!-- Right Panel -->


   <?php echo $__env->make('admin.javascript', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


</body>

</html>
<?php /**PATH D:\xampp\htdocs\fickrr\resources\views/admin/general-settings.blade.php ENDPATH**/ ?>