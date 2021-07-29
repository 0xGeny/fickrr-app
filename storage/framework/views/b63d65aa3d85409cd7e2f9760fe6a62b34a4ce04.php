<div class="page-title-overlap pt-4" style="background-image: url('<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_banner); ?>');">
      <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-star">
              <li class="breadcrumb-item"><a class="text-nowrap" href="<?php echo e(URL::to('/')); ?>"><i class="dwg-home"></i><?php echo e(Helper::translation(2862,$translate)); ?></a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page"><?php echo e(Helper::translation(2934,$translate)); ?></li>
              </li>
             </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 mb-0 text-white"><?php echo e(Helper::translation(2934,$translate)); ?></h1>
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
          <section class="col-lg-8 pt-lg-4 pb-4 mb-3 coupon">
            <div class="pt-2 px-4 pl-lg-0 pr-xl-5">
              <h2 class="h3 pt-2 pb-4 mb-0 text-center text-sm-left border-bottom"><?php echo e(Helper::translation(2934,$translate)); ?></h2>
              <form action="<?php echo e(route('edit-coupon')); ?>" class="needs-validation mt-3 pt-3" id="profile_form" method="post" enctype="multipart/form-data">
            <?php echo e(csrf_field()); ?>

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-fn"><?php echo e(Helper::translation(2866,$translate)); ?> <span class="require">*</span></label>
                  <input id="coupon_code" name="coupon_code" type="text" class="form-control" value="<?php echo e($edit['value']->coupon_code); ?>" data-bvalidator="required">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-ln"><?php echo e(Helper::translation(2867,$translate)); ?> <span class="require">*</span></label>
                 <input id="coupon_value" name="coupon_value" type="text" class="form-control" data-bvalidator="required,min[1]" value="<?php echo e($edit['value']->coupon_value); ?>">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-email"><?php echo e(Helper::translation(2868,$translate)); ?> <span class="require">*</span></label>
                  <input id="coupon_start_date" name="coupon_start_date" type="text" class="form-control" autocomplete="off" data-bvalidator="required" value="<?php echo e($edit['value']->coupon_start_date); ?>">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-email"><?php echo e(Helper::translation(2869,$translate)); ?> <span class="require">*</span></label>
                  <input id="coupon_end_date" name="coupon_end_date" type="text" class="form-control" autocomplete="off" data-bvalidator="required" value="<?php echo e($edit['value']->coupon_end_date); ?>">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-email"><?php echo e(Helper::translation(2870,$translate)); ?> <span class="require">*</span></label>
                  <select name="discount_type" class="form-control" data-bvalidator="required">
                         <option value=""></option>
                         <option value="percentage" <?php if($edit['value']->discount_type == 'percentage'): ?> selected <?php endif; ?>><?php echo e(Helper::translation(2871,$translate)); ?></option>
                         <option value="fixed" <?php if($edit['value']->discount_type == 'fixed'): ?> selected <?php endif; ?>><?php echo e(Helper::translation(2872,$translate)); ?></option>
                         </select>       
                </div>
              </div> 
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-email"><?php echo e(Helper::translation(2873,$translate)); ?> <span class="require">*</span></label>
                  <select name="coupon_status" class="form-control" data-bvalidator="required">
                        <option value=""></option>
                         <option value="1" <?php if($edit['value']->coupon_status == 1): ?> selected <?php endif; ?>><?php echo e(Helper::translation(2874,$translate)); ?></option>
                         <option value="0" <?php if($edit['value']->coupon_status == 0): ?> selected <?php endif; ?>><?php echo e(Helper::translation(2875,$translate)); ?></option>
                         </select>
                </div>
              </div>
              <input type="hidden" name="coupon_id" value="<?php echo e(base64_encode($edit['value']->coupon_id)); ?>">
              <div class="col-12">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                  <button class="btn btn-primary mt-3 mt-sm-0" type="submit"><?php echo e(Helper::translation(2876,$translate)); ?></button>
                </div>
              </div>
            </div>
          </form>
          </div>
          </section>
        </div>
      </div>
    </div><?php /**PATH D:\xampp\htdocs\fickrr\resources\views/edit-my-coupon.blade.php ENDPATH**/ ?>