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
                        <h1><?php echo e(Helper::translation(6105,$translate)); ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <a href="<?php echo e(url('/admin/add-subscription')); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> <?php echo e(Helper::translation(6189,$translate)); ?></a>
                        </ol>
                    </div>
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
        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title"><?php echo e(Helper::translation(6105,$translate)); ?></strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(Helper::translation(2920,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2917,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2888,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(6144,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(4971,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2873,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2922,$translate)); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no = 1; ?>
                                    <?php $__currentLoopData = $subscription['view']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($no); ?></td>
                                            <td width="200"><?php echo e($subscription->subscr_name); ?> </td>
                                           <td><?php echo e($allsettings->site_currency_symbol); ?> <?php echo e($subscription->subscr_price); ?> </td>
                                           <td><?php echo e($subscription->subscr_duration); ?> </td>
                                           <td><?php echo e($subscription->subscr_order); ?> </td>
                                            <td><?php if($subscription->subscr_status == 1): ?> <span class="badge badge-success"><?php echo e(Helper::translation(2874,$translate)); ?></span> <?php else: ?> <span class="badge badge-danger"><?php echo e(Helper::translation(2875,$translate)); ?></span> <?php endif; ?></td>
                                            <td><a href="edit-subscription/<?php echo e($subscription->subscr_id); ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp; <?php echo e(Helper::translation(2923,$translate)); ?></a> 
                                            <?php if($demo_mode == 'on'): ?> 
                                            <a href="demo-mode" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;<?php echo e(Helper::translation(2924,$translate)); ?></a>
                                            <?php else: ?> 
                                            <a href="subscription/<?php echo e($subscription->subscr_id); ?>" class="btn btn-danger btn-sm" onClick="return confirm('<?php echo e(Helper::translation(5064,$translate)); ?>?');"><i class="fa fa-trash"></i>&nbsp;<?php echo e(Helper::translation(2924,$translate)); ?></a><?php endif; ?></td>
                                        </tr>
                                        
                                        <?php $no++; ?>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>     
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

 
                </div>
                
                
                
                <div class="row">
                <div class="col-md-12">
                  <div class="card">
                            <div class="card-header">
                                <strong class="card-title"><?php echo e(Helper::translation(6192,$translate)); ?></strong><br/><small>(<?php echo e(Helper::translation(6195,$translate)); ?>)</small>
                            </div>
                             <div class="card-body">
                 <?php if($demo_mode == 'on'): ?>
                                 <?php echo $__env->make('admin.demo-mode', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                 <?php else: ?>
                                 <form action="<?php echo e(route('admin.free-subscription')); ?>" method="post" id="setting_form" enctype="multipart/form-data">
                                 <?php echo e(csrf_field()); ?>

                                 <?php endif; ?>
                                  
                                 <div class="col-md-6">
                                 
                                   <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Free Subscription? <span class="require">*</span></label>
                                                <select name="free_subscription" class="form-control" required>
                                                <option value=""></option>
                                                <option value="1" <?php if($additional->free_subscription == 1): ?> selected <?php endif; ?>><?php echo e(Helper::translation(5013,$translate)); ?></option>
                                                <option value="0" <?php if($additional->free_subscription == 0): ?> selected <?php endif; ?>><?php echo e(Helper::translation(5922,$translate)); ?></option>
                                                </select>
                                            </div>
                                  <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> <?php echo e(Helper::translation(6144,$translate)); ?> <span class="require">*</span></label>
                                                <select name="subscr_duration" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <?php  
                                                for($i=1;$i<=365;$i++){ 
                                                if($i==1){ $day_text = "day"; } else { $day_text = "days"; }
                                                $dates = $i.' '.$day_text;
                                                ?>
                                                <option value="<?php echo e($dates); ?>" <?php if($additional->free_subscr_duration == $dates): ?> selected <?php endif; ?>><?php echo e($dates); ?></option>
                                                <?php } ?>
                                                </select>
                                                
                                            </div> 
                                            
                                      </div>
                                      
                                      <div class="col-md-6">      
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1"><?php echo e(Helper::translation(6198,$translate)); ?> <span class="require">*</span></label>
                                                <input id="subscr_items" name="subscr_items" type="text" class="form-control" data-bvalidator="required,digit,min[1]" value="<?php echo e($additional->free_subscr_item); ?>">
                                            </div> 
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1"><?php echo e(Helper::translation(6201,$translate)); ?> (MB) <span class="require">*</span></label>
                                                <input id="subscr_spaces" name="subscr_spaces" type="text" class="form-control" data-bvalidator="required,digit,min[1]" value="<?php echo e($additional->free_subscr_space); ?>">
                                            </div> 
                                        </div>
                                        
                                        <input type="hidden" name="user_subscr_type" value="Free">
                                        <input type="hidden" name="user_subscr_price" value="0">
                                        <input type="hidden" name="sid" value="<?php echo e($sid); ?>">
                                        <div class="col-md-12">    
                                
                                                        <button type="submit" name="submit" class="btn btn-primary btn-sm">
                                                            <i class="fa fa-dot-circle-o"></i> <?php echo e(Helper::translation(2876,$translate)); ?>

                                                        </button>
                                                       
                                                 
                                                 </div>   
                     </form>
                     </div>
                     </div>                   
                </div>
                </div>
                
                <div class="row">
                <div class="col-md-12">
                  <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Subscription Content</strong>
                            </div>
                             <div class="card-body">
                                 <?php if($demo_mode == 'on'): ?>
                                 <?php echo $__env->make('admin.demo-mode', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                 <?php else: ?>
                                 <form action="<?php echo e(route('admin.subscription')); ?>" method="post" id="order_form" enctype="multipart/form-data">
                                 <?php echo e(csrf_field()); ?>

                                 <?php endif; ?>
                                  
                                 <div class="col-md-6">
                                 
                                   
                                  <div class="form-group">
                                                <label for="name" class="control-label mb-1"><?php echo e(Helper::translation(5025,$translate)); ?> </label>
                                                <input id="subscription_title" name="subscription_title" type="text" class="form-control" value="<?php echo e($additional->subscription_title); ?>">
                                            </div> 
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1"><?php echo e(Helper::translation(2941,$translate)); ?> </label>
                                                <textarea name="subscription_desc" id="summary-ckeditor" rows="6" class="form-control"><?php echo e(html_entity_decode($additional->subscription_desc)); ?></textarea>
                                                
                                            </div> 
                                      </div>
                                      
                                      <div class="col-md-6">      
                                            
                                             
                                        </div>
                                        
                                        
                                        <div class="col-md-12">    
                                
                                                        <button type="submit" name="submit" class="btn btn-primary btn-sm">
                                                            <i class="fa fa-dot-circle-o"></i> <?php echo e(Helper::translation(2876,$translate)); ?>

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
<?php /**PATH D:\xampp\htdocs\fickrr\resources\views/admin/subscription.blade.php ENDPATH**/ ?>