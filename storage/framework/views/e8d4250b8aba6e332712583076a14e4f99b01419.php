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
    <?php if(in_array('items',$avilable)): ?> 
    <div id="right-panel" class="right-panel">

        
                       <?php echo $__env->make('admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                       

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1><?php echo e(Helper::translation(3097,$translate)); ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <a href="<?php echo e(url('/admin/orders')); ?>" class="btn btn-success btn-sm"><i class="fa fa-chevron-left"></i> <?php echo e(Helper::translation(5175,$translate)); ?></a>
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

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title"><?php echo e(Helper::translation(3097,$translate)); ?></strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(Helper::translation(2920,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2938,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(3142,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(3101,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2866,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(5652,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(5655,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(5658,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(5661,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(5664,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(5667,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(5670,$translate)); ?>?</th>
                                            <th><?php echo e(Helper::translation(2999,$translate)); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no = 1; ?>
                                    <?php $__currentLoopData = $itemData['item']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($no); ?></td>
                                            <td><?php echo e($order->item_name); ?> </td>
                                            <td><a href="<?php echo e(URL::to('/user')); ?>/<?php echo e($order->username); ?>" target="_blank" class="blue-color"><?php echo e($order->username); ?></a></td>
                                            
                                            <td><?php echo e(date('d F Y', strtotime($order->start_date))); ?> </td>
                                            <?php if($order->coupon_code != ""): ?>
                                            <td><?php echo e($order->coupon_code); ?> </td>
                                            <?php else: ?>
                                            <td align="center">-</td>
                                            <?php endif; ?>
                                            <?php if($order->coupon_type != ""): ?>
                                            <td><?php echo e($order->coupon_type); ?> </td>
                                            <?php else: ?>
                                            <td align="center">-</td>
                                            <?php endif; ?>
                                            <?php if($order->coupon_type != ""): ?>
                                            <?php if($order->coupon_type == 'fixed'): ?>
                                            <td><?php echo e($order->coupon_value); ?> <?php echo e($allsettings->site_currency); ?> </td>
                                            <?php else: ?>
                                            <td><?php echo e($order->item_price - $order->discount_price); ?> <?php echo e($allsettings->site_currency); ?> </td>
                                            <?php endif; ?>
                                            <?php else: ?>
                                            <td align="center">-</td>
                                            <?php endif; ?>
                                            <td><?php echo e($order->vendor_amount); ?> <?php echo e($allsettings->site_currency); ?> </td>
                                            <td><?php echo e($order->admin_amount); ?> <?php echo e($allsettings->site_currency); ?></td>
                                            <td><?php echo e($order->total_price); ?> <?php echo e($allsettings->site_currency); ?></td>
                                            <td><?php if($order->order_status == 'completed'): ?> <span class="badge badge-success"><?php echo e(Helper::translation(5673,$translate)); ?></span> <?php else: ?> <span class="badge badge-danger"><?php echo e(Helper::translation(5676,$translate)); ?></span> <?php endif; ?></td>
                                            <td>
                                            <?php if($order->approval_status == ''): ?>
                                            <a href="<?php echo e(URL::to('/admin/order-details')); ?>/<?php echo e($order->ord_id); ?>/vendor" class="btn btn-success btn-sm" title="<?php echo e(Helper::translation(5679,$translate)); ?>" onClick="return confirm('<?php echo e(Helper::translation(5682,$translate)); ?>?');"><i class="fa fa-money"></i>&nbsp; <?php echo e(Helper::translation(5475,$translate)); ?></a> 
                                            <a href="<?php echo e(URL::to('/admin/order-details')); ?>/<?php echo e($order->ord_id); ?>/buyer" class="btn btn-danger btn-sm" title="<?php echo e(Helper::translation(5685,$translate)); ?>" onClick="return confirm('<?php echo e(Helper::translation(5688,$translate)); ?>?');"><i class="fa fa-close"></i>&nbsp;<?php echo e(Helper::translation(5691,$translate)); ?></a>
                                            
                                            <?php else: ?>
                                            <?php echo e($order->approval_status); ?>

                                            <?php endif; ?>
                                            </td>
                                            <td><a href="<?php echo e(URL::to('/admin/more-info')); ?>/<?php echo e($order->purchase_token); ?>" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i>&nbsp; <?php echo e(Helper::translation(2999,$translate)); ?></a></td>
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
<?php /**PATH D:\xampp\htdocs\fickrr\resources\views/admin/order-details.blade.php ENDPATH**/ ?>