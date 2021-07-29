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
    <?php if(in_array('withdrawal',$avilable)): ?>
    <div id="right-panel" class="right-panel">

        
                       <?php echo $__env->make('admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                       

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1><?php echo e(Helper::translation(5625,$translate)); ?></h1>
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

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title"><?php echo e(Helper::translation(5625,$translate)); ?></strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(Helper::translation(2920,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(5895,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(3172,$translate)); ?></th>
                                            
                                            <th><?php echo e(Helper::translation(5898,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(3222,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(3223,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(5901,$translate)); ?></th>
                                            <th width="200"><?php echo e(Helper::translation(4816,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(3224,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2873,$translate)); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no = 1; ?>
                                    <?php $__currentLoopData = $itemData['item']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $withdraw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($no); ?></td>
                                            <td><a href="<?php echo e(URL::to('/user')); ?>/<?php echo e($withdraw->username); ?>" target="_blank" class="blue-color"><?php echo e($withdraw->username); ?></a></td>
                                            <td><?php echo e($withdraw->wd_date); ?> </td>
                                            <td><?php echo e($withdraw->withdraw_type); ?> </td>
                                            <td><?php if($withdraw->paypal_email != ""): ?> <?php echo e($withdraw->paypal_email); ?> <?php else: ?> <span>---</span> <?php endif; ?></td>
                                            <td><?php if($withdraw->stripe_email != ""): ?> <?php echo e($withdraw->stripe_email); ?> <?php else: ?> <span>---</span> <?php endif; ?></td>
                                            <td><?php if($withdraw->paystack_email != ""): ?> <?php echo e($withdraw->paystack_email); ?> <?php else: ?> <span>---</span> <?php endif; ?></td>
                                            <td width="200"><?php if($withdraw->bank_details != ""): ?> <?php echo nl2br($withdraw->bank_details); ?> <?php else: ?> <span>---</span> <?php endif; ?></td>
                                            <td><?php echo e($withdraw->wd_amount); ?> <?php echo e($allsettings->site_currency); ?></td>
                                            <td>
                                            <?php if($withdraw->wd_status == 'pending'): ?>
                                            <a href="<?php echo e(URL::to('/admin/withdrawal')); ?>/<?php echo e($withdraw->wd_id); ?>/<?php echo e($withdraw->wd_user_id); ?>" class="btn btn-success btn-sm" onClick="return confirm('<?php echo e(Helper::translation(5904,$translate)); ?>?');"><i class="fa fa-money"></i>&nbsp; <?php echo e(Helper::translation(5907,$translate)); ?></a>
                                            
                                            <?php else: ?>
                                            <span class="badge badge-success"><?php echo e($withdraw->wd_status); ?></span>
                                            <?php endif; ?>
                                            </td>
                                        </tr>
                                        
                                        <?php $no++; ?>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>     
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

 
                </div>
            </div>
        </div>


    </div>
    <?php else: ?>
    <?php echo $__env->make('admin.denied', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?> 
    


   <?php echo $__env->make('admin.javascript', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


</body>

</html>
<?php /**PATH D:\xampp\htdocs\fickrr\resources\views/admin/withdrawal.blade.php ENDPATH**/ ?>