<?php if($allsettings->maintenance_mode == 0): ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title><?php echo e(Helper::translation(6105,$translate)); ?> - <?php echo e($allsettings->site_title); ?></title>
<?php echo $__env->make('meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php if($addition_settings->subscription_mode == 1): ?>
<section class="bg-position-center-top" style="background-image: url('<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_banner); ?>');">
      <div class="py-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-star">
              <li class="breadcrumb-item"><a class="text-nowrap" href="<?php echo e(URL::to('/')); ?>"><i class="dwg-home"></i><?php echo e(Helper::translation(2862,$translate)); ?></a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page"><?php echo e(Helper::translation(6105,$translate)); ?></li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 mb-0 text-white"><?php echo e(Helper::translation(6105,$translate)); ?></h1>
        </div>
      </div>
      </div>
    </section>
<div class="faq-section section-padding">
		<div class="container py-5 mt-md-2 mb-2">
            <div class="row">
                <div class="col-lg-12" data-aos="fade-up" data-aos-delay="200">
                  <?php if($addition_settings->subscription_title != ""): ?>
                  <h1><?php echo e($addition_settings->subscription_title); ?></h1>
                  <?php endif; ?>
                  <?php if($addition_settings->subscription_desc != ""): ?>
                  <div class="font-size-md"><?php echo html_entity_decode($addition_settings->subscription_desc); ?></div>
                  <?php endif; ?>
                 </div>
              </div>
			<div class="row">
                <?php $__currentLoopData = $subscription['view']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 				<div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
 					<div class="single-price-item wow fadeInLeft" data-wow-delay=".3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
 						<h5><?php echo e($subscription->subscr_name); ?></h5>
 						<div class="price-box">
 							<p><b><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($subscription->subscr_price); ?></b>/ <?php echo e($subscription->subscr_duration); ?></p>
 						</div>
                        <hr>
 						<div class="price-list">
 							<ul>
                                <?php if($subscription->subscr_item_level == 'limited'): ?>
 								<li><i class="fa fa-check" aria-hidden="true"></i> <?php echo e($subscription->subscr_item); ?> <?php echo e(Helper::translation(5442,$translate)); ?></li>
                                <?php else: ?>
                                <li><i class="fa fa-check" aria-hidden="true"></i> <?php echo e(Helper::translation(6108,$translate)); ?></li>
                                <?php endif; ?>
                                <?php if($subscription->subscr_space_level == 'limited'): ?>
 								<li><i class="fa fa-check" aria-hidden="true"></i> <?php echo e($subscription->subscr_space); ?><?php echo e($subscription->subscr_space_type); ?> <?php echo e(Helper::translation(6111,$translate)); ?></li>
                                <?php else: ?>
                                <li><i class="fa fa-check" aria-hidden="true"></i> <?php echo e(Helper::translation(6114,$translate)); ?></li>
                                <?php endif; ?>
								<li><?php if($subscription->subscr_email_support == 1): ?><i class="fa fa-check" aria-hidden="true"></i><?php else: ?><i class="fa fa-times" aria-hidden="true"></i><?php endif; ?> <?php echo e(Helper::translation(6117,$translate)); ?></li>										
								<li><?php if($subscription->subscr_payment_mode == 1): ?><i class="fa fa-check" aria-hidden="true"></i><?php else: ?><i class="fa fa-times" aria-hidden="true"></i><?php endif; ?> <?php echo e(Helper::translation(6120,$translate)); ?></li>
								<li><?php if($subscription->subscr_payment_mode == 1): ?><i class="fa fa-check" aria-hidden="true"></i> <?php echo e(Helper::translation(6126,$translate)); ?><?php else: ?><i class="fa fa-times" aria-hidden="true"></i> <?php echo e(Helper::translation(6126,$translate)); ?><?php endif; ?></li>
								<li><i class="fa fa-check" aria-hidden="true"></i> <?php echo e(Helper::translation(6129,$translate)); ?></li>
 							</ul>
 						</div>
 						<?php if(Auth::guest()): ?>																			
						<a href="<?php echo e(URL::to('/login')); ?>" class="main-btn small-btn">
						<span><?php echo e(Helper::translation(6132,$translate)); ?></span> <i class="fa fa-caret-right" aria-hidden="true"></i>
						</a>
                        <?php else: ?>
                        <?php if(Auth::user()->id != 1): ?>
                        <?php /*?>@if(Auth::user()->user_subscr_date < date('Y-m-d'))<?php */?>
                        <a href="<?php echo e(URL::to('/confirm-subscription')); ?>/<?php echo e(base64_encode($subscription->subscr_id)); ?>" class="main-btn small-btn">
						<span><?php echo e(Helper::translation(6132,$translate)); ?></span> <i class="fa fa-caret-right" aria-hidden="true"></i>
						</a>
                        <?php /*?>@endif<?php */?>
                        <?php endif; ?>
                        <?php endif; ?>
 					</div>
 				</div>
 				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
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
<?php endif; ?><?php /**PATH /var/www/html/fickrr/resources/views/subscription.blade.php ENDPATH**/ ?>