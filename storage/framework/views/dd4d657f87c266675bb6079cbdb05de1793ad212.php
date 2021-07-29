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
    <?php if(in_array('selling',$avilable)): ?>
    <div id="right-panel" class="right-panel">

       
                       <?php echo $__env->make('admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                       

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Start Selling</h1>
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
                           <form action="<?php echo e(route('admin.start-selling')); ?>" method="post" id="item_form" enctype="multipart/form-data">
                           <?php echo e(csrf_field()); ?>

                           <?php endif; ?>
                           <div class="col-md-4">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Box 1 Icon ( 75 X 75px )</label>
                                                <input type="file" id="box1_icon" name="box1_icon" class="form-control-file" <?php if($setting['setting']->box1_icon == ''): ?> data-bvalidator="required" <?php endif; ?>>
                                                <?php if($setting['setting']->box1_icon != ''): ?>
                                                <img height="24" src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($setting['setting']->box1_icon); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            
                                           
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Box 1 Title</label>
                                                <input id="box1_title" name="box1_title" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->box1_title); ?>" data-bvalidator="required">
                                            </div>
                                            
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Box 1 Content</label>
                                                <textarea name="box1_text" id="box1_text" rows="6" class="form-control noscroll_textarea" maxlength="160" required><?php echo e($setting['setting']->box1_text); ?></textarea>
                                            </div>
                                             
                                             
                                             
                                            
                                             <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Box 3 Icon ( 75 X 75px )</label>
                                                <input type="file" id="box3_icon" name="box3_icon" class="form-control-file" <?php if($setting['setting']->box3_icon == ''): ?> data-bvalidator="required" <?php endif; ?>>
                                                <?php if($setting['setting']->box3_icon != ''): ?>
                                                <img height="24" src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($setting['setting']->box3_icon); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            
                                           
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Box 3 Title</label>
                                                <input id="box3_title" name="box3_title" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->box3_title); ?>" data-bvalidator="required">
                                            </div>
                                            
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Box 3 Content</label>
                                                <textarea name="box3_text" id="box3_text" rows="6" class="form-control noscroll_textarea" maxlength="160" required><?php echo e($setting['setting']->box3_text); ?></textarea>
                                            </div>
                                                
                                                
                                        
                                    </div>
                                </div>

                            </div>
                            </div>
                            
                            
                            
                             <div class="col-md-4">
                             
                             
                             <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                             
                             
                            
                                            
                                           
                                            
                                           <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Box 2 Icon ( 75 X 75px )</label>
                                                <input type="file" id="box2_icon" name="box2_icon" class="form-control-file" <?php if($setting['setting']->box2_icon == ''): ?> data-bvalidator="required" <?php endif; ?>>
                                                <?php if($setting['setting']->box2_icon != ''): ?>
                                                <img height="24" src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($setting['setting']->box2_icon); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            
                                           
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Box 2 Title</label>
                                                <input id="box2_title" name="box2_title" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->box2_title); ?>" data-bvalidator="required">
                                            </div>
                                            
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Box 2 Content</label>
                                                <textarea name="box2_text" id="box2_text" rows="6" class="form-control noscroll_textarea" maxlength="160" required><?php echo e($setting['setting']->box2_text); ?></textarea>
                                            </div>
                                             
                                              
                                                
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Box 4 Icon ( 75 X 75px )</label>
                                                <input type="file" id="box4_icon" name="box4_icon" class="form-control-file" <?php if($setting['setting']->box4_icon == ''): ?> data-bvalidator="required" <?php endif; ?>>
                                                <?php if($setting['setting']->box4_icon != ''): ?>
                                                <img height="24" src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($setting['setting']->box4_icon); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            
                                           
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Box 4 Title</label>
                                                <input id="box4_title" name="box4_title" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->box4_title); ?>" data-bvalidator="required">
                                            </div>
                                            
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Box 4 Content</label>
                                                <textarea name="box4_text" id="box4_text" rows="6" class="form-control noscroll_textarea" maxlength="160" required><?php echo e($setting['setting']->box4_text); ?></textarea>
                                            </div>   
                             
                             
                             </div>
                                </div>

                            </div>
                             
                             
                             
                             </div>
                             
                             
                             
                             <div class="col-md-4">
                                <h4 align="center" class="mt-3 mb-3"> Layout Look</h4>
                                <img  src="<?php echo e(url('/')); ?>/public/img/layout.jpg" class="layout-img" />
                             </div>
                             
                             
                             
                             
                             <div class="col-md-12">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        
                                            
                                           
                                            
                                           
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Three Box Title</label>
                                                <input id="three_box_heading" name="three_box_heading" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->three_box_heading); ?>" data-bvalidator="required">
                                            </div>
                                            
                                            
                                           
                                                
                                        
                                    </div>
                                </div>

                            </div>
                            </div>
                            
                            
                            
                            
                            <div class="col-md-4">
                             
                             
                             <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                             
                             
                            
                                             
                                           
                                            
                                           <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Box 5 Icon ( 75 X 75px )</label>
                                                <input type="file" id="box5_icon" name="box5_icon" class="form-control-file" <?php if($setting['setting']->box5_icon == ''): ?> data-bvalidator="required" <?php endif; ?>>
                                                <?php if($setting['setting']->box5_icon != ''): ?>
                                                <img height="24" src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($setting['setting']->box5_icon); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            
                                           
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Box 5 Title</label>
                                                <input id="box5_title" name="box5_title" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->box5_title); ?>" data-bvalidator="required">
                                            </div>
                                            
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Box 5 Content</label>
                                                <textarea name="box5_text" id="box5_text" rows="6" class="form-control noscroll_textarea" maxlength="160" required><?php echo e($setting['setting']->box5_text); ?></textarea>
                                            </div>
                                             
                                        
                             </div>
                                </div>

                            </div>
                             
                             
                             
                             </div>
                             
                             
                             <div class="col-md-4">
                             
                             
                             <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                             
                             
                            
                                            
                                           
                                            
                                           <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Box 6 Icon ( 75 X 75px )</label>
                                                <input type="file" id="box6_icon" name="box6_icon" class="form-control-file" <?php if($setting['setting']->box6_icon == ''): ?> data-bvalidator="required" <?php endif; ?>>
                                                <?php if($setting['setting']->box6_icon != ''): ?>
                                                <img height="24" src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($setting['setting']->box6_icon); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            
                                           
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Box 6 Title</label>
                                                <input id="box6_title" name="box6_title" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->box6_title); ?>" data-bvalidator="required">
                                            </div>
                                            
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Box 6 Content</label>
                                                <textarea name="box6_text" id="box6_text" rows="6" class="form-control noscroll_textarea" maxlength="160" required><?php echo e($setting['setting']->box6_text); ?></textarea>
                                            </div>
                                             
                                        
                             </div>
                                </div>

                            </div>
                             
                             
                             
                             </div>
                             
                             
                             
                             <div class="col-md-4">
                             
                             
                             <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                             
                             
                            
                                             
                                           
                                            
                                           <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Box 7 Icon ( 75 X 75px )</label>
                                                <input type="file" id="box7_icon" name="box7_icon" class="form-control-file" <?php if($setting['setting']->box7_icon == ''): ?> data-bvalidator="required" <?php endif; ?>>
                                                <?php if($setting['setting']->box7_icon != ''): ?>
                                                <img height="24" src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($setting['setting']->box7_icon); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            
                                           
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Box 7 Title</label>
                                                <input id="box7_title" name="box7_title" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->box7_title); ?>" data-bvalidator="required">
                                            </div>
                                            
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Box 7 Content</label>
                                                <textarea name="box7_text" id="box7_text" rows="6" class="form-control noscroll_textarea" maxlength="160" required><?php echo e($setting['setting']->box7_text); ?></textarea>
                                            </div>
                                             
                                        
                             </div>
                                </div>

                            </div>
                             
                             
                             
                             </div>
                             
                             
                             
                             <div class="col-md-12">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        
                                            
                                           
                                            
                                           
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Title 1</label>
                                                <input id="content_title_one" name="content_title_one" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->content_title_one); ?>" data-bvalidator="required">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Content 1</label>
                                               
                                                <textarea name="content_text_one" id="summary-ckeditor" rows="6" placeholder="separate keywords with commas" class="form-control noscroll_textarea" maxlength="160" required><?php echo e(html_entity_decode($setting['setting']->content_text_one)); ?></textarea>
                                            </div>
                                           
                                                
                                        
                                    </div>
                                </div>

                            </div>
                            </div>
                            
                             
                             
                             <div class="col-md-12">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        
                                            
                                           
                                            
                                           
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Title 2</label>
                                                <input id="content_title_two" name="content_title_two" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->content_title_two); ?>" data-bvalidator="required">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Content 2</label>
                                               
                                                
                                                 <textarea name="content_text_two" id="summary-ckeditor2" rows="6" placeholder="separate keywords with commas" class="form-control noscroll_textarea" maxlength="160" required><?php echo e(html_entity_decode($setting['setting']->content_text_two)); ?></textarea>
                                            </div>
                                           
                                                
                                        
                                    </div>
                                </div>

                            </div>
                            </div>
                            
                            
                            
                            
                            <div class="col-md-12">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        
                                            
                                           
                                            
                                           
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Title 3</label>
                                                <input id="content_title_three" name="content_title_three" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->content_title_three); ?>" data-bvalidator="required">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Content 3</label>
                                                
                                                
                                                <textarea name="content_text_three" id="summary-ckeditor3" rows="6" placeholder="separate keywords with commas" class="form-control noscroll_textarea" maxlength="160" required><?php echo e(html_entity_decode($setting['setting']->content_text_three)); ?></textarea>
                                            </div>
                                           
                                                
                                        
                                    </div>
                                </div>

                            </div>
                            </div>
                            
                            
                            
                            <div class="col-md-12">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        
                                            
                                           
                                            
                                           
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Button Title</label>
                                                <input id="button_title" name="button_title" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->button_title); ?>" data-bvalidator="required">
                                            </div>
                                            
                                           
                                           
                                                
                                        
                                    </div>
                                </div>

                            </div>
                            </div>
                                            <input type="hidden" name="sid" value="1">
                                            <input type="hidden" name="save_box1_icon" value="<?php echo e($setting['setting']->box1_icon); ?>">
                                            <input type="hidden" name="save_box3_icon" value="<?php echo e($setting['setting']->box3_icon); ?>">
                                            <input type="hidden" name="save_box2_icon" value="<?php echo e($setting['setting']->box2_icon); ?>">
                                            <input type="hidden" name="save_box4_icon" value="<?php echo e($setting['setting']->box4_icon); ?>"> 
                                            <input type="hidden" name="save_box5_icon" value="<?php echo e($setting['setting']->box5_icon); ?>"> 
                                            <input type="hidden" name="save_box6_icon" value="<?php echo e($setting['setting']->box6_icon); ?>">
                                            <input type="hidden" name="save_box7_icon" value="<?php echo e($setting['setting']->box7_icon); ?>"> 
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
<?php /**PATH D:\xampp\htdocs\fickrr\resources\views/admin/start-selling.blade.php ENDPATH**/ ?>