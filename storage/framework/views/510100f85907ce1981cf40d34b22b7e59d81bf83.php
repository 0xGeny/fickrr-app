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
                        <h1><?php echo e(Helper::translation(3130,$translate)); ?></h1>
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
                           <form action="<?php echo e(route('admin.email-settings')); ?>" method="post" id="checkout_form" enctype="multipart/form-data">
                           <?php echo e(csrf_field()); ?>

                           <?php endif; ?>
                           <div class="col-md-6">
                             <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="form-group">
                                          <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(2906,$translate)); ?> <span class="require">*</span></label>
                                           <input id="sender_name" name="sender_name" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->sender_name); ?>" data-bvalidator="required">
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
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(2907,$translate)); ?> <span class="require">*</span></label>
                                                <input id="sender_email" name="sender_email" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->sender_email); ?>" data-bvalidator="required,email"></div><input type="hidden" name="sid" value="1">
                             </div>
                                </div>
                              </div>
                             </div>
                             <div class="col-md-12"><div class="card-body"><h4><?php echo e(Helper::translation(5262,$translate)); ?></h4></div></div>
                             <div class="col-md-6">
                               <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(5265,$translate)); ?> <span class="require">*</span></label>
                                                <input id="mail_driver" name="mail_driver" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->mail_driver); ?>" data-bvalidator="required"> <small><?php echo e(Helper::translation(2968,$translate)); ?> : mail</small></div>
                                    <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(5268,$translate)); ?> <span class="require">*</span></label>
                                                <input id="mail_port" name="mail_port" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->mail_port); ?>" data-bvalidator="required"> <small><?php echo e(Helper::translation(2968,$translate)); ?> : 25</small></div><div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(5271,$translate)); ?></label>
                                                <input id="mail_password" name="mail_password" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->mail_password); ?>"> <small><?php echo e(Helper::translation(2968,$translate)); ?> : test123</small>
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
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(5274,$translate)); ?> <span class="require">*</span></label>
                                                <input id="mail_host" name="mail_host" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->mail_host); ?>" data-bvalidator="required"> <small><?php echo e(Helper::translation(2968,$translate)); ?> : mail.mailtrap.io</small></div>
                                   <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(5277,$translate)); ?> </label>
                                                <input id="mail_username" name="mail_username" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->mail_username); ?>"> <small><?php echo e(Helper::translation(2968,$translate)); ?> : sample@sample.com</small></div><div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(5280,$translate)); ?> </label>
                                                <input id="mail_encryption" name="mail_encryption" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->mail_encryption); ?>"> <small><?php echo e(Helper::translation(2968,$translate)); ?> : tls or ssl</small></div>                  
                               </div>
                                </div>
                              </div>
                             </div>
                             <div class="col-md-12 no-padding">
                             <div class="card-footer">
                                  <button type="submit" name="submit" class="btn btn-primary btn-sm">
                                      <i class="fa fa-dot-circle-o"></i> <?php echo e(Helper::translation(2876,$translate)); ?>

                                  </button>
                                  <button type="reset" class="btn btn-danger btn-sm">
                                       <i class="fa fa-ban"></i> <?php echo e(Helper::translation(4962,$translate)); ?>

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
</html><?php /**PATH D:\xampp\htdocs\fickrr\resources\views/admin/email-settings.blade.php ENDPATH**/ ?>