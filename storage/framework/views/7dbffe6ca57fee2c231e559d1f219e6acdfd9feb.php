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
    <?php if(in_array('subscription',$avilable)): ?>
    <div id="right-panel" class="right-panel">

        
                       <?php echo $__env->make('admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                       

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1><?php echo e(Helper::translation(6216,$translate)); ?></h1>
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
                            <div class="card-header">
                                <strong class="card-title"><?php echo e(Helper::translation(6216,$translate)); ?></strong>
                            </div>
                             <div class="card-body">
                 <?php if($demo_mode == 'on'): ?>
                                 <?php echo $__env->make('admin.demo-mode', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                 <?php else: ?>
                                 <form action="<?php echo e(route('admin.edit-subscription')); ?>" method="post" id="setting_form" enctype="multipart/form-data">
                                 <?php echo e(csrf_field()); ?>

                                 <?php endif; ?>
                                 <div class="col-md-6">
                                        <div class="form-group">
                                                <label for="name" class="control-label mb-1"><?php echo e(Helper::translation(6204,$translate)); ?> <span class="require">*</span></label>
                                                <input id="subscr_name" name="subscr_name" type="text" class="form-control" data-bvalidator="required" value="<?php echo e($edit['subscri']->subscr_name); ?>">
                                            </div>                                   
                                            
                                            
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1"><?php echo e(Helper::translation(2888,$translate)); ?> (<?php echo e($allsettings->site_currency_symbol); ?>) <span class="require">*</span></label>
                                                <input id="subscr_price" name="subscr_price" type="text" class="form-control" data-bvalidator="required,min[1]" value="<?php echo e($edit['subscri']->subscr_price); ?>">
                                            </div>
                                            
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> <?php echo e(Helper::translation(6144,$translate)); ?> <span class="require">*</span></label>
                                                <select name="subscr_duration" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <?php $__currentLoopData = $durations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $duration): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($duration); ?>" <?php if($edit['subscri']->subscr_duration == $duration): ?> selected <?php endif; ?>><?php echo e($duration); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> <?php echo e(Helper::translation(6207,$translate)); ?> <span class="require">*</span></label>
                                                <select name="subscr_item_level" id="subscr_item_level" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <?php $__currentLoopData = $item_sale_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($key); ?>" <?php if($edit['subscri']->subscr_item_level == $key): ?> selected <?php endif; ?>><?php echo e($value); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                
                                            </div>
                                            
                                             <div id="limit_item" <?php if($edit['subscri']->subscr_item_level == 'limited'): ?> class="form-group force-block" <?php else: ?> class="form-group force-none" <?php endif; ?>>
                                                <label for="name" class="control-label mb-1"><?php echo e(Helper::translation(6198,$translate)); ?> <span class="require">*</span></label>
                                                <input id="subscr_item" name="subscr_item" type="text" class="form-control" data-bvalidator="required,digit,min[1]" value="<?php echo e($edit['subscri']->subscr_item); ?>">
                                            </div> 
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> <?php echo e(Helper::translation(6201,$translate)); ?> <span class="require">*</span></label>
                                                <select name="subscr_space_level" id="subscr_space_level" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <?php $__currentLoopData = $storage_space; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($key); ?>" <?php if($edit['subscri']->subscr_space_level == $key): ?> selected <?php endif; ?>><?php echo e($value); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                
                                            </div>
                                            <div id="limit_space" <?php if($edit['subscri']->subscr_space_level == 'limited'): ?> class="force-block" <?php else: ?> class="force-none" <?php endif; ?>>
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1"><?php echo e(Helper::translation(6210,$translate)); ?> <span class="require">*</span></label>
                                                <div class="row">
                                                <div class="col-md-6">
                                                <input id="subscr_space" name="subscr_space" type="text" class="form-control" data-bvalidator="required,digit,min[1]" value="<?php echo e($edit['subscri']->subscr_space); ?>">
                                                </div>
                                                <div class="col-md-6">
                                                <select name="subscr_space_type" id="subscr_space_type" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <?php $__currentLoopData = $storage_space_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($value); ?>" <?php if($edit['subscri']->subscr_space_type == $value): ?> selected <?php endif; ?>><?php echo e($value); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                </div>
                                                </div>
                                            </div> 
                                            </div>
                                      </div>
                                      
                                      <div class="col-md-6">
                                      
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(6117,$translate)); ?> <span class="require">*</span></label>
                                                <select name="subscr_email_support" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" <?php if($edit['subscri']->subscr_email_support == 1): ?> selected <?php endif; ?>><?php echo e(Helper::translation(2970,$translate)); ?></option>
                                                <option value="0" <?php if($edit['subscri']->subscr_email_support == 0): ?> selected <?php endif; ?>><?php echo e(Helper::translation(2971,$translate)); ?></option>
                                                </select>
                                                
                                            </div>       
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(6213,$translate)); ?> <span class="require">*</span></label>
                                                <select name="subscr_payment_mode" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" <?php if($edit['subscri']->subscr_payment_mode == 1): ?> selected <?php endif; ?>><?php echo e(Helper::translation(2970,$translate)); ?></option>
                                                <option value="0" <?php if($edit['subscri']->subscr_payment_mode == 0): ?> selected <?php endif; ?>><?php echo e(Helper::translation(2971,$translate)); ?></option>
                                                </select>
                                            </div>
                                            
                                            
                                            
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1"><?php echo e(Helper::translation(4971,$translate)); ?></label>
                                                <input id="subscr_order" name="subscr_order" type="text" class="form-control" data-bvalidator="digit,min[0]" value="<?php echo e($edit['subscri']->subscr_order); ?>">
                                            </div> 
                                            
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> <?php echo e(Helper::translation(2873,$translate)); ?> <span class="require">*</span></label>
                                                <select name="subscr_status" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" <?php if($edit['subscri']->subscr_status == 1): ?> selected <?php endif; ?>><?php echo e(Helper::translation(2874,$translate)); ?></option>
                                                <option value="0" <?php if($edit['subscri']->subscr_status == 0): ?> selected <?php endif; ?>><?php echo e(Helper::translation(2875,$translate)); ?></option>
                                                </select>
                                                
                                            </div>   
                                             
                                        </div>
                                        <input type="hidden" name="subscr_id" value="<?php echo e($edit['subscri']->subscr_id); ?>"> 
                                        <div class="col-md-12">
                                                        <button type="submit" name="submit" class="btn btn-primary btn-sm">
                                                            <i class="fa fa-dot-circle-o"></i> <?php echo e(Helper::translation(2876,$translate)); ?>

                                                        </button>
                                                        <button type="reset" class="btn btn-danger btn-sm">
                                                            <i class="fa fa-ban"></i> <?php echo e(Helper::translation(4962,$translate)); ?>

                                                        </button>
                                                    </div>
                                          
                     </form>
                     </div>
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
<?php /**PATH D:\xampp\htdocs\fickrr\resources\views/admin/edit-subscription.blade.php ENDPATH**/ ?>