<div class="page-title-overlap pt-4" style="background-image: url('<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_banner); ?>');">
      <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-star">
              <li class="breadcrumb-item"><a class="text-nowrap" href="<?php echo e(URL::to('/')); ?>"><i class="dwg-home"></i><?php echo e(Helper::translation(2862,$translate)); ?></a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page"><?php echo e(Helper::translation(2919,$translate)); ?></li>
              </li>
             </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 mb-0 text-white"><?php echo e(Helper::translation(2919,$translate)); ?></h1>
        </div>
      </div>
    </div>
<div class="container mb-5 pb-3">
      <div class="bg-light box-shadow-lg rounded-lg overflow-hidden">
        <div class="row">
          <!-- Sidebar-->
          <aside class="col-lg-4">
            <!-- Account menu toggler (hidden on screens larger 992px)-->
            <div class="d-block d-lg-none p-4">
            <a class="btn btn-outline-accent d-block" href="#account-menu" data-toggle="collapse"><i class="dwg-menu mr-2"></i><?php echo e(Helper::translation(4878,$translate)); ?></a></div>
            <!-- Actual menu-->
            <?php if(Auth::user()->id != 1): ?>
            <?php echo $__env->make('dashboard-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
          </aside>
          <!-- Content-->
          <section class="col-lg-8 pt-lg-4 pb-4 mb-3">
            <div class="pt-2 px-4 pl-lg-0 pr-xl-5">
              <h2 class="h3 pt-2 pb-4 mb-0 text-center text-sm-left border-bottom"><?php echo e(Helper::translation(2919,$translate)); ?></h2>
              <!-- Product-->
                <div class="row">
                 <div class="col-lg-12 col-md-12 text-right mb-3 mt-3">
                 <a href="<?php echo e(URL::to('/add-coupon')); ?>" class="btn btn-success btn-sm"><?php echo e(Helper::translation(2865,$translate)); ?></a>
                 </div>
                 </div>
                 <div class="row">
                    <div class="col-md-12">
                        <div class="statement_table table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><?php echo e(Helper::translation(2920,$translate)); ?></th>
                                        <th><?php echo e(Helper::translation(2866,$translate)); ?></th>
                                        <th><?php echo e(Helper::translation(2921,$translate)); ?></th>
                                        <th><?php echo e(Helper::translation(2867,$translate)); ?></th>
                                        <th><?php echo e(Helper::translation(2873,$translate)); ?></th>
                                        <th><?php echo e(Helper::translation(2922,$translate)); ?></th>
                                    </tr>
                                </thead>
                                <tbody id="listShow">
                                    <?php $no = 1; ?>
                                    <?php $__currentLoopData = $couponData['view']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="prod-item">
                                            <td><?php echo e($no); ?></td>
                                            <td><?php echo e($coupon->coupon_code); ?> </td>
                                            <td><?php echo e($coupon->discount_type); ?></td>
                                            <td><?php if($coupon->discount_type == 'fixed'): ?><?php echo e($allsettings->site_currency); ?> <?php endif; ?><?php echo e($coupon->coupon_value); ?><?php if($coupon->discount_type == 'percentage'): ?>%<?php endif; ?> </td>
                                            <td><?php if($coupon->coupon_status == 1): ?> <span class="badge badge-success"><?php echo e(Helper::translation(2874,$translate)); ?></span> <?php else: ?> <span class="badge badge-danger"><?php echo e(Helper::translation(2875,$translate)); ?></span> <?php endif; ?></td>
                                            <td>
                                            <a href="<?php echo e(URL::to('/edit-coupon')); ?>/<?php echo e(base64_encode($coupon->coupon_id)); ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp; <?php echo e(Helper::translation(2923,$translate)); ?></a> 
                                            <?php if($demo_mode == 'on'): ?> 
                                            <a href="demo-mode" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;<?php echo e(Helper::translation(2924,$translate)); ?></a>
                                            <?php else: ?> 
                                            <a href="<?php echo e(URL::to('/coupon')); ?>/<?php echo e(base64_encode($coupon->coupon_id)); ?>" class="btn btn-danger btn-sm" onClick="return confirm('<?php echo e(Helper::translation(2925,$translate)); ?>');"><i class="fa fa-trash"></i>&nbsp;<?php echo e(Helper::translation(2924,$translate)); ?></a> 
                                             <?php endif; ?>
                                             </td>
                                        </tr>
                                        <?php $no++; ?>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>     
                                   </tbody>
                            </table>
                            <div class="pagination-area">
                           <div class="turn-page" id="itempager"></div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
          </section>
        </div>
      </div>
    </div><?php /**PATH D:\xampp\htdocs\fickrr\resources\views/my-coupon.blade.php ENDPATH**/ ?>