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
                        <h1><?php echo e(Helper::translation(5211,$translate)); ?></h1>
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
                           <form action="<?php echo e(route('admin.edit-administrator')); ?>" method="post" id="setting_form" enctype="multipart/form-data">
                           <?php echo e(csrf_field()); ?>

                           <?php endif; ?>
                           <div class="col-md-6">
                           <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="form-group">
                                                <label for="name" class="control-label mb-1"><?php echo e(Helper::translation(2917,$translate)); ?> <span class="require">*</span></label>
                                                <input id="name" name="name" type="text" class="form-control" value="<?php echo e($edit['userdata']->name); ?>" data-bvalidator="required">
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1"><?php echo e(Helper::translation(3111,$translate)); ?> <span class="require">*</span></label>
                                                <input id="username" name="username" type="text" class="form-control" value="<?php echo e($edit['userdata']->username); ?>" data-bvalidator="required">
                                            </div>
                                            <div class="form-group">
                                                    <label for="email" class="control-label mb-1"><?php echo e(Helper::translation(2915,$translate)); ?> <span class="require">*</span></label>
                                                    <input id="email" name="email" type="text" class="form-control" value="<?php echo e($edit['userdata']->email); ?>" data-bvalidator="email,required">
                                              </div>
                                              <input type="hidden" name="user_type" value="admin">
                                               <div class="form-group">
                                                    <label for="password" class="control-label mb-1"><?php echo e(Helper::translation(3113,$translate)); ?></label>
                                                    <input id="password" name="password" type="text" class="form-control">
                                                </div>
                                                <?php if(Auth::user()->id == 1): ?>
                                                 <div class="form-group">
                                                    <label for="earnings" class="control-label mb-1"><?php echo e(Helper::translation(3106,$translate)); ?> (<?php echo e($allsettings->site_currency_symbol); ?>)</label>
                                                    <input id="earnings" name="earnings" type="text" class="form-control" value="<?php echo e($edit['userdata']->earnings); ?>" data-bvalidator="min[0]">
                                                </div>
                                                <?php endif; ?>
                                                <div class="form-group">
                                                                    <label for="customer_earnings" class="control-label mb-1"><?php echo e(Helper::translation(4956,$translate)); ?></label>
                                                                    <input type="file" id="user_photo" name="user_photo" class="form-control-file" data-bvalidator="extension[jpg:png:jpeg]" data-bvalidator-msg="<?php echo e(Helper::translation(2944,$translate)); ?>"><?php if($edit['userdata']->user_photo != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/public/storage/users/<?php echo e($edit['userdata']->user_photo); ?>"  class="userphoto"/><?php else: ?> <img height="50" src="<?php echo e(url('/')); ?>/public/img/no-user.png"  class="userphoto"/>  <?php endif; ?></div>
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
                                    <label for="customer_earnings" class="control-label mb-1"><strong><?php echo e(Helper::translation(4959,$translate)); ?></strong></label><br/><br/>
                                    <?php $edituser = explode(',', $edit['userdata']->user_permission); ?>
                                    <?php $__currentLoopData = $permission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                     <span><input type="checkbox" id="user_permission[]" name="user_permission[]" value="<?php echo e($key); ?>" <?php if(in_array($key,$edituser)): ?> checked <?php endif; ?>> <?php echo e($value); ?></span><br/>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </div>
                              </div>
                                </div>
                              </div>
                             </div>
                             <input type="hidden" name="save_photo" value="<?php echo e($edit['userdata']->user_photo); ?>">
                             <input type="hidden" name="save_password" value="<?php echo e($edit['userdata']->password); ?>">
                             <input type="hidden" name="user_token" value="<?php echo e($edit['userdata']->user_token); ?>">
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
</html><?php /**PATH D:\xampp\htdocs\fickrr\resources\views/admin/edit-administrator.blade.php ENDPATH**/ ?>