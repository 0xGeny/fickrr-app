<?php if($allsettings->maintenance_mode == 0): ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title><?php echo e(Helper::translation(3097,$translate)); ?> - <?php echo e($allsettings->site_title); ?></title>
<?php echo $__env->make('meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php if(Auth::user()->user_type == 'vendor'): ?>
<div class="page-title-overlap pt-4" style="background-image: url('<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_banner); ?>');">
      <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-star">
              <li class="breadcrumb-item"><a class="text-nowrap" href="<?php echo e(URL::to('/')); ?>"><i class="dwg-home"></i><?php echo e(Helper::translation(2930,$translate)); ?></a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page"><?php echo e(Helper::translation(2930,$translate)); ?></li>
              </li>
             </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 mb-0 text-white"><?php echo e(Helper::translation(3097,$translate)); ?></h1>
        </div>
      </div>
    </div>
<div class="container mb-5 pb-3">
      <div class="bg-light box-shadow-lg rounded-lg overflow-hidden">
        <div class="row">
          <aside class="col-lg-4">
            <div class="d-block d-lg-none p-4">
            <a class="btn btn-outline-accent d-block" href="#account-menu" data-toggle="collapse"><i class="dwg-menu mr-2"></i><?php echo e(Helper::translation(4878,$translate)); ?></a></div>
            <?php if(Auth::user()->id != 1): ?>
            <?php echo $__env->make('dashboard-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
          </aside>
          <section class="col-lg-8 pt-lg-4 pb-4 mb-3" id="printable">
            <div class="pt-2 px-4 pl-lg-0 pr-xl-5">
              <div class="row mx-n2 pt-2">
              <div class="col pull-left">
                                <div class="dashboard__title">
                                    <h3><?php echo e(Helper::translation(3097,$translate)); ?></h3>
                                </div>
                            </div>
                <div class="col pull-right">
                   <a href="javascript:void(0);" class="btn btn-success btn-sm theme-button print"><?php echo e(Helper::translation(3098,$translate)); ?></a>
                </div>
              </div>
              <div class="row mt-3 pt-3 mb-3">
                    <div class="invoice_logo col pull-left">
                                    <img src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_logo); ?>" alt="">
                                </div>
                                <div class="info col pull-right">
                                    <h4><?php echo e(Helper::translation(3099,$translate)); ?></h4>
                                    <p><?php echo e(Helper::translation(3100,$translate)); ?> #<?php echo e($checkout['view']->purchase_token); ?></p>
                                </div>
                        </div>
                        <hr/>
                        <div class="row mt-3 pt-3">
                                <div class="address col pull-left">
                                    <h5 class="bold"><?php echo e($checkout['view']->order_firstname); ?> <?php echo e($checkout['view']->order_lastname); ?></h5>
                                    <p><?php echo e($checkout['view']->order_address); ?></p>
                                    <p><?php echo e($checkout['view']->order_city); ?>, <?php echo e($checkout['view']->order_zipcode); ?></p>
                                    <p><?php echo e($checkout['view']->order_country); ?></p>
                                </div>
                                <div class="date_info col pull-right">
                                    <p>
                                     <span><?php echo e(Helper::translation(3101,$translate)); ?> : </span><?php echo e(date("d M Y", strtotime($checkout['view']->payment_date))); ?></p>
                                     <p class="status">
                                     <span><?php echo e(Helper::translation(2873,$translate)); ?> : </span><span <?php if($checkout['view']->payment_status == 'completed'): ?> class="badge badge-success" <?php else: ?> class="badge badge-danger" <?php endif; ?>><?php echo e($checkout['view']->payment_status); ?></span></p>
                                </div>
                                </div>
                         <div class="row mt-3 pt-3">       
                         <div class="invoice">
                            <div class="invoice__detail">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th><?php echo e(Helper::translation(3102,$translate)); ?></th>
                                                <th><?php echo e(Helper::translation(3103,$translate)); ?></th>
                                                <th><?php echo e(Helper::translation(3042,$translate)); ?></th>
                                                <th><?php echo e(Helper::translation(3104,$translate)); ?></th>
                                                <th><?php echo e(Helper::translation(3105,$translate)); ?></th>
                                                <th><?php echo e(Helper::translation(2888,$translate)); ?></th>
                                                <th><?php echo e(Helper::translation(3106,$translate)); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $earn = 0; ?>
                                        <?php $__currentLoopData = $order['view']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e(date("d M Y", strtotime($order->start_date))); ?></td>
                                                <td><?php echo e(date("d M Y", strtotime($order->end_date))); ?></td>
                                                <td><a href="<?php echo e(URL::to('/user')); ?>/<?php echo e($order->username); ?>" class="theme-color"><?php echo e($order->username); ?></a></td>
                                                <td class="detail">
                                                    <a href="<?php echo e(URL::to('/item')); ?>/<?php echo e($order->item_slug); ?>" class="theme-color"><?php echo e(substr($order->item_name,0,30).'...'); ?></a>
                                                </td>
                                                <td><?php echo e($order->payment_type); ?></td>
                                                <td><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($order->item_price); ?></td>
                                                <td><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($order->vendor_amount); ?></td>
                                            </tr>
                                            <?php $earn += $order->vendor_amount; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
                                       </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                   </div>
                   <hr/>
                   <div class="row mt-3 pt-3">
                   <div class="pricing_info col pull-right">
                        <p><?php echo e(Helper::translation(3107,$translate)); ?> : <?php echo e($allsettings->site_currency_symbol); ?><?php echo e($earn); ?></p>
                        <p class="bold"><?php echo e(Helper::translation(2896,$translate)); ?> : <?php echo e($allsettings->site_currency_symbol); ?><?php echo e($earn); ?></p>
                  </div>
                  </div>
               </div>
          </section>
        </div>
      </div>
    </div>
    <?php else: ?>
    <?php echo $__env->make('not-found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php else: ?>
<?php echo $__env->make('503', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?><?php /**PATH D:\xampp\htdocs\fickrr\resources\views/order-details.blade.php ENDPATH**/ ?>