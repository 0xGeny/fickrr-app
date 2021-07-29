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
                        <h1><?php echo e(Helper::translation(5610,$translate)); ?></h1>
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
                           <form action="<?php echo e(route('admin.preferred-settings')); ?>" method="post" id="setting_form" enctype="multipart/form-data">
                           <?php echo e(csrf_field()); ?>

                           <?php endif; ?>
                           <div class="col-md-6">
                           <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(2877,$translate)); ?> <span class="require">*</span></label>
                                                                                                
                                                <select name="site_blog_display" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" <?php if($setting['setting']->site_blog_display == 1): ?> selected <?php endif; ?>><?php echo e(Helper::translation(5013,$translate)); ?></option>
                                                <option value="0" <?php if($setting['setting']->site_blog_display == 0): ?> selected <?php endif; ?>><?php echo e(Helper::translation(5922,$translate)); ?></option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(5409,$translate)); ?> <span class="require">*</span></label>
                                                                                                
                                                <select name="site_features_display" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" <?php if($setting['setting']->site_features_display == 1): ?> selected <?php endif; ?>><?php echo e(Helper::translation(5013,$translate)); ?></option>
                                                <option value="0" <?php if($setting['setting']->site_features_display == 0): ?> selected <?php endif; ?>><?php echo e(Helper::translation(5922,$translate)); ?></option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                              <label for="product_approval" class="control-label mb-1">Subscription<span class="require">*</span></label><br/>
                                              <select name="subscription_mode" class="form-control" required>
                                                        <option value=""></option>
                                                        <option value="1" <?php if($additional['setting']->subscription_mode == 1): ?> selected <?php endif; ?>><?php echo e(Helper::translation(5013,$translate)); ?></option>
                                                        <option value="0" <?php if($additional['setting']->subscription_mode == 0): ?> selected <?php endif; ?>><?php echo e(Helper::translation(5922,$translate)); ?></option>
                                              </select>
                                            </div>
                                            <?php /*?><input type="hidden" name="subscription_mode" value="0"><?php */?>
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
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(3005,$translate)); ?> <span class="require">*</span></label>
                                                <select name="site_newsletter_display" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" <?php if($setting['setting']->site_newsletter_display == 1): ?> selected <?php endif; ?>><?php echo e(Helper::translation(5013,$translate)); ?></option>
                                                <option value="0" <?php if($setting['setting']->site_newsletter_display == 0): ?> selected <?php endif; ?>><?php echo e(Helper::translation(5922,$translate)); ?></option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(3018,$translate)); ?> <span class="require">*</span></label>
                                                                                                
                                                <select name="site_selling_display" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" <?php if($setting['setting']->site_selling_display == 1): ?> selected <?php endif; ?>><?php echo e(Helper::translation(5013,$translate)); ?></option>
                                                <option value="0" <?php if($setting['setting']->site_selling_display == 0): ?> selected <?php endif; ?>><?php echo e(Helper::translation(5922,$translate)); ?></option>
                                                </select>
                                            </div>
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
</html><?php /**PATH D:\xampp\htdocs\fickrr\resources\views/admin/preferred-settings.blade.php ENDPATH**/ ?>