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
    <?php if(in_array('refund',$avilable)): ?>
    <div id="right-panel" class="right-panel">

        
                       <?php echo $__env->make('admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                       

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1><?php echo e(Helper::translation(3143,$translate)); ?></h1>
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
                                <strong class="card-title"><?php echo e(Helper::translation(3143,$translate)); ?></strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(Helper::translation(2920,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(3173,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2938,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(3042,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(3146,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(5811,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2922,$translate)); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no = 1; ?>
                                    <?php $__currentLoopData = $itemData['item']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $refund): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($no); ?></td>
                                            <td><?php echo e($refund->ref_purchased_token); ?> </td>
                                            <td><?php echo e($refund->item_name); ?> </td>
                                            <td><a href="<?php echo e(URL::to('/user')); ?>/<?php echo e($refund->username); ?>" target="_blank" class="blue-color"><?php echo e($refund->username); ?></a></td>
                                            <td><?php echo e($refund->ref_refund_reason); ?> </td>
                                            <td><?php echo e($refund->ref_refund_comment); ?></td>
                                            <td>
                                            <?php if($refund->ref_refund_approval == ""): ?> 
                                            <a href="<?php echo e(URL::to('/admin/refund')); ?>/<?php echo e($refund->ref_order_id); ?>/<?php echo e($refund->refund_id); ?>/buyer" class="btn btn-success btn-sm" title="<?php echo e(Helper::translation(5685,$translate)); ?>"><i class="fa fa-money"></i>&nbsp; <?php echo e(Helper::translation(5814,$translate)); ?></a> 
                                            <a href="<?php echo e(URL::to('/admin/refund')); ?>/<?php echo e($refund->ref_order_id); ?>/<?php echo e($refund->refund_id); ?>/vendor" class="btn btn-danger btn-sm" title="<?php echo e(Helper::translation(5679,$translate)); ?>"><i class="fa fa-close"></i>&nbsp; <?php echo e(Helper::translation(5817,$translate)); ?></a>
                                            <?php else: ?>
                                            <?php if($refund->ref_refund_approval == 'accepted'): ?> <span class="badge badge-success"><?php echo e(Helper::translation(5823,$translate)); ?></span> <?php else: ?> <span class="badge badge-danger"><?php echo e(Helper::translation(5820,$translate)); ?></span> <?php endif; ?>
                                            
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
<?php /**PATH /var/www/html/resources/views/admin/refund.blade.php ENDPATH**/ ?>