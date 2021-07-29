<?php if($allsettings->maintenance_mode == 0): ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title><?php echo e(Helper::translation(6135,$translate)); ?> - <?php echo e($allsettings->site_title); ?></title>
<?php echo $__env->make('meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="bg-position-center-top" style="background-image: url('<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_banner); ?>');">
      <div class="py-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-star">
              <li class="breadcrumb-item"><a class="text-nowrap" href="<?php echo e(URL::to('/')); ?>"><i class="dwg-home"></i><?php echo e(Helper::translation(2862,$translate)); ?></a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page"><?php echo e(Helper::translation(6135,$translate)); ?></li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 mb-0 text-white"><?php echo e(Helper::translation(6135,$translate)); ?></h1>
        </div>
      </div>
      </div>
    </section>
<div class="faq-section section-padding subscribe-details" data-aos="fade-up" data-aos-delay="200">
		<div class="container py-5 mt-md-2 mb-2">
			<div class="row">
         <div class="col-sm-6 col-md-7 col-lg-7 subscribe-details">
            <div class="mb-3">
                <h4 class="mb-3"><?php echo e(Helper::translation(6138,$translate)); ?></h4>
                <div class="card-body">
                    <p><label><?php echo e(Helper::translation(6141,$translate)); ?> :</label> <?php echo e($subscr['view']->subscr_name); ?></p>
                    <p><label><?php echo e(Helper::translation(2888,$translate)); ?> :</label> <?php echo e($allsettings->site_currency_symbol); ?> <?php echo e($subscr['view']->subscr_price); ?></p>
                    <p><label><?php echo e(Helper::translation(6144,$translate)); ?> :</label> <?php echo e($subscr['view']->subscr_duration); ?></p>
                    <?php if($subscr['view']->subscr_item_level == 'limited'): ?>
                    <p><label><?php echo e(Helper::translation(6147,$translate)); ?> :</label> <?php echo e($subscr['view']->subscr_item); ?> <?php echo e(Helper::translation(5442,$translate)); ?></p>
                    <?php else: ?>
                    <p><label><?php echo e(Helper::translation(6147,$translate)); ?> :</label> <?php echo e(Helper::translation(6165,$translate)); ?></p>
                    <?php endif; ?>
                    <?php if($subscr['view']->subscr_space_level == 'limited'): ?>
                    <p><label><?php echo e(Helper::translation(6150,$translate)); ?> :</label> <?php echo e($subscr['view']->subscr_space); ?><?php echo e($subscr['view']->subscr_space_type); ?></p>
                    <?php else: ?>
                    <p><label><?php echo e(Helper::translation(6150,$translate)); ?> :</label> <?php echo e(Helper::translation(6165,$translate)); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-5 col-lg-5">
            <div>
                <h4 class="mb-3"><?php echo e(Helper::translation(2902,$translate)); ?>

                </h4>
                <div class="card-body">
                    <form action="<?php echo e(route('confirm-subscription')); ?>" class="needs-validation" id="checkout_form" method="post" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                    <?php $no = 1; ?>
                        <?php $__currentLoopData = $get_payment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="lebel">
                           <input id="opt1-<?php echo e($payment); ?>" name="payment_method" type="radio" class="auto-width" value="<?php echo e($payment); ?>" <?php if($no == 1): ?> checked <?php endif; ?> data-bvalidator="required">
                           <label for="opt1-<?php echo e($payment); ?>" ><?php echo e($payment); ?></label>      
                        </div>
                        <?php if($payment == 'stripe'): ?>
                                <div class="row" id="ifYes" style="display:none;">
                                  <div class="col-md-12 mb-3">
                                        <div class="stripebox">
                                        <label for="card-element"><?php echo e(Helper::translation(2903,$translate)); ?></label>
                                        <div id="card-element">
                                        </div>
                                        <div id="card-errors" role="alert"></div>
                                        </div>
                                    </div>    
                                </div>        
                                <?php endif; ?>
                                <?php $no++; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <input type="hidden" name="website_url" value="<?php echo e(url('/')); ?>">
                                <input type="hidden" name="user_subscr_id" value="<?php echo e($subscr['view']->subscr_id); ?>">
                                <input type="hidden" name="user_subscr_type" value="<?php echo e($subscr['view']->subscr_name); ?>">
                                <input type="hidden" name="user_subscr_date" value="<?php echo e($subscr['view']->subscr_duration); ?>">
                                <input type="hidden" name="user_subscr_item_level" value="<?php echo e($subscr['view']->subscr_item_level); ?>">
                                <input type="hidden" name="user_subscr_item" value="<?php echo e($subscr['view']->subscr_item); ?>">
                                <input type="hidden" name="user_subscr_space_level" value="<?php echo e($subscr['view']->subscr_space_level); ?>">
                                <input type="hidden" name="user_subscr_space" value="<?php echo e($subscr['view']->subscr_space); ?>">
                                <input type="hidden" name="user_subscr_space_type" value="<?php echo e($subscr['view']->subscr_space_type); ?>">
                                <input type="hidden" name="token" class="token">
                                <input type="hidden" name="reference" value="<?php echo e(Paystack::genTranxRef()); ?>">
                         <div class="mx-auto">
                        <button type="submit" class="btn btn-primary"><?php echo e(Helper::translation(2876,$translate)); ?></button></div>
                    </form>
                </div>
            </div>
        </div>
        </div>
      </div>
	</div>
<?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php else: ?>
<?php echo $__env->make('503', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?><?php /**PATH D:\xampp\htdocs\fickrr\resources\views/confirm-subscription.blade.php ENDPATH**/ ?>