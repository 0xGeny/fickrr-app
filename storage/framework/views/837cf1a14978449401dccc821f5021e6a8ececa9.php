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
    <?php if(Auth::user()->id == 1): ?>
    <div id="right-panel" class="right-panel">

        
                       <?php echo $__env->make('admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                       

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1><?php echo e(Helper::translation(5259,$translate)); ?></h1>
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
                           <form action="<?php echo e(route('admin.edit-vendor')); ?>" method="post" id="setting_form" enctype="multipart/form-data">
                           <?php echo e(csrf_field()); ?>

                           <?php endif; ?>
                           <div class="col-md-6">
                           <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1"><?php echo e(Helper::translation(2917,$translate)); ?> <span class="require">*</span></label>
                                                <input id="name" name="name" type="text" class="form-control" value="<?php echo e($edit['userdata']->name); ?>" required>
                                            </div>
                                            
                                             <div class="form-group">
                                                <label for="name" class="control-label mb-1"><?php echo e(Helper::translation(3111,$translate)); ?> <span class="require">*</span></label>
                                                <input id="username" name="username" type="text" class="form-control" value="<?php echo e($edit['userdata']->username); ?>" required>
                                            </div>
                                            
                                            
                                                <div class="form-group">
                                                    <label for="email" class="control-label mb-1"><?php echo e(Helper::translation(2915,$translate)); ?> <span class="require">*</span></label>
                                                    <input id="email" name="email" type="email" class="form-control" value="<?php echo e($edit['userdata']->email); ?>" required>
                                                   
                                                </div>
                                                
                                                <input type="hidden" name="user_type" value="vendor">
                                                
                                                <div class="form-group">
                                                    <label for="password" class="control-label mb-1"><?php echo e(Helper::translation(3113,$translate)); ?></label>
                                                    <input id="password" name="password" type="text" class="form-control">
                                                    
                                                </div>
                                                
                                                 <div class="form-group">
                                                    <label for="earnings" class="control-label mb-1"><?php echo e(Helper::translation(3106,$translate)); ?> (<?php echo e($allsettings->site_currency); ?>)</label>
                                                    <input id="earnings" name="earnings" type="text" class="form-control" value="<?php echo e($edit['userdata']->earnings); ?>">
                                                    
                                                </div>
                                                
                                                <div class="form-group">
                                                                    <label for="customer_earnings" class="control-label mb-1"><?php echo e(Helper::translation(4956,$translate)); ?></label>
                                                                    <input type="file" id="user_photo" name="user_photo" class="form-control-file">
                                                                </div>
                                                <?php if($edit['userdata']->user_photo != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/public/storage/users/<?php echo e($edit['userdata']->user_photo); ?>"  class="userphoto"/><?php else: ?> <img height="50" src="<?php echo e(url('/')); ?>/public/img/no-user.png"  class="userphoto"/>  <?php endif; ?>
                                                
                                                
                                                <?php if($addition_settings->subscription_mode == 1): ?>                
                                                <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Subscription Type? <span class="require">*</span></label>
                                                <select name="subscription_type" class="form-control" required>
                                                <option value=""></option>
                                                <option value="none" <?php if($edit['userdata']->user_subscr_type == 'None'): ?> selected <?php endif; ?>>None</option>
                                                <?php if($addition_settings->free_subscription == 1): ?>
                                                <option value="free" <?php if($edit['userdata']->user_subscr_type == 'Free'): ?> selected <?php endif; ?>>Free</option>
                                                <?php endif; ?>
                                                <?php $__currentLoopData = $subscribe['userdata']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscribe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($subscribe->subscr_id); ?>" <?php if($edit['userdata']->user_subscr_id == $subscribe->subscr_id): ?> selected <?php endif; ?>><?php echo e($subscribe->subscr_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                </div>
                                                <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Account Verification? <span class="require">*</span></label>
                                                <select name="user_document_verified" class="form-control" required>
                                                <option value=""></option>
                                                <option value="1" <?php if($edit['userdata']->user_document_verified == 1): ?> selected <?php endif; ?>><?php echo e(Helper::translation(5202,$translate)); ?></option>
                                                <option value="0" <?php if($edit['userdata']->user_document_verified == 0): ?> selected <?php endif; ?>><?php echo e(Helper::translation(5205,$translate)); ?></option>
                                                </select>
                                                </div>
                                                <?php endif; ?> 
                                                
                                                
                                                
                                                <input type="hidden" name="verified" value="1"> 
                                                
                                                <input type="hidden" name="save_photo" value="<?php echo e($edit['userdata']->user_photo); ?>">
                                                
                                                <input type="hidden" name="save_password" value="<?php echo e($edit['userdata']->password); ?>">
                                                
                                                <input type="hidden" name="save_auth_token" value="<?php echo e($edit['userdata']->user_auth_token); ?>">
                                                
                                                <input type="hidden" name="edit_id" value="<?php echo e($token); ?>">
                                                
                                                <input type="hidden" name="page_redirect" value="vendor">
                                       </div>
                                </div>
                             </div>
                            </div>
                            <div class="col-md-6">
                             <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                          <?php if($check_payment == 1): ?>
                              <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Vendor Payment Methods </label><br/>
                                                <?php $__currentLoopData = $payment_option; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <input id="user_payment_option" name="user_payment_option[]" type="checkbox" <?php if(in_array($payment,$get_payment)): ?> checked <?php endif; ?> class="noscroll_textarea" value="<?php echo e($payment); ?>"> <?php echo e($payment); ?> <br/>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                             </div>
                             <?php endif; ?>
                                     </div>
                                </div>
                            </div>
                           </div>
                           <div class="col-md-12 no-padding">
                             <div class="card-footer">
                                 <button type="submit" name="submit" class="btn btn-primary btn-sm"><i class="fa fa-dot-circle-o"></i> <?php echo e(Helper::translation(2876,$translate)); ?></button>
                                 <button type="reset" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i> <?php echo e(Helper::translation(4962,$translate)); ?> </button>
                                 <a href="<?php echo e(url('/vendor')); ?>/<?php echo e($encrypter->encrypt($edit['userdata']->user_token)); ?>" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-user"></i> Login as vendor </a>
                             </div>
                             </div>
                            </form>
                         </div> 
                     </div>
                </div>
            </div><!-- .animated -->
        </div>
        
        <!-- .content -->


    </div><!-- /#right-panel -->
    <?php else: ?>
    <?php echo $__env->make('admin.denied', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <!-- Right Panel -->


   <?php echo $__env->make('admin.javascript', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


</body>

</html>
<?php /**PATH /var/www/html/resources/views/admin/edit-vendor.blade.php ENDPATH**/ ?>