<?php if($allsettings->maintenance_mode == 0): ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title><?php echo e(Helper::translation(3233,$translate)); ?> - <?php echo e($allsettings->site_title); ?></title>
<?php echo $__env->make('meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo NoCaptcha::renderJs(); ?>

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
              <li class="breadcrumb-item text-nowrap active" aria-current="page"><?php echo e(Helper::translation(3233,$translate)); ?></li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 mb-0 text-white"><?php echo e(Helper::translation(3233,$translate)); ?></h1>
        </div>
      </div>
      </div>
    </section>
<div class="container py-4 py-lg-5 my-4">
      <div class="row">
        <div class="col-md-6 mx-auto">
          <div class="card border-0 box-shadow">
            <div class="card-body">
              <h2 class="h4 mb-3"><?php echo e(Helper::translation(3234,$translate)); ?></h2>
              <p class="font-size-sm text-muted mb-4"><?php echo e(Helper::translation(3236,$translate)); ?></p>
              <form method="POST" action="<?php echo e(route('register')); ?>" id="login_form" class="needs-validation" novalidate>
                <?php echo csrf_field(); ?>
                <div class="row">
              <input type="hidden" name="user_type" value="customer">
              <div class="col-sm-6">
               <div class="form-group">
                <label for="email_ad"><?php echo e(Helper::translation(4827,$translate)); ?> <span class="required">*</span></label>
                 <select id="user_type" class="form-control" name="user_type" data-bvalidator="required" onChange="handleUserTypeChange(this.value)">
                 <option value="vendor" <?php if(request()->get('type')=='vendor'): ?> selected="selected" <?php endif; ?>>Photographer</option>
                 <option value="customer" <?php if(request()->get('type')=='customer'): ?> selected="selected" <?php endif; ?>>Buyer</option>
                </select>
                </div>
             </div>
                </div>
                <div class="row">
                <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-fn">First Name <span class="required">*</span></label>
                  <input id="name" type="text" class="form-control" name="fname" placeholder="First name" value="<?php echo e(old('fname')); ?>" data-bvalidator="required" autocomplete="name" autofocus>    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                       <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-fn">Last Name</label>
                  <input id="name" type="text" class="form-control" name="lname" placeholder="Last name" value="<?php echo e(old('lname')); ?>" autocomplete="name" autofocus>    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                       <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
              </div>
              <!-- <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-fn"><?php echo e(Helper::translation(3237,$translate)); ?> <span class="required">*</span></label>
                  <input id="name" type="text" class="form-control" name="name" placeholder="<?php echo e(Helper::translation(3238,$translate)); ?>" value="<?php echo e(old('name')); ?>" data-bvalidator="required" autocomplete="name" autofocus>    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                       <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
              </div> -->
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-ln"><?php echo e(Helper::translation(3111,$translate)); ?> <span class="required">*</span></label>
                  <input id="username" type="text" name="username" class="form-control" placeholder="<?php echo e(Helper::translation(3239,$translate)); ?>" data-bvalidator="required">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-email"><?php echo e(Helper::translation(3240,$translate)); ?> <span class="required">*</span></label>
                  <input id="email" type="text" class="form-control" name="email" value="<?php echo e(old('email')); ?>" placeholder="<?php echo e(Helper::translation(3241,$translate)); ?>"  autocomplete="email" data-bvalidator="email,required">
                         <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-pass"><?php echo e(Helper::translation(3113,$translate)); ?> <span class="required">*</span></label>
                  <div class="password-toggle">
                    <input id="password" type="password" class="form-control" name="password" placeholder="<?php echo e(Helper::translation(3242,$translate)); ?>" autocomplete="new-password" data-bvalidator="required"><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback" role="alert">
                             <strong><?php echo e($message); ?></strong>
                       </span>
                     <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <label class="password-toggle-btn">
                      <input class="custom-control-input" type="checkbox"><i class="dwg-eye password-toggle-indicator"></i><span class="sr-only"><?php echo e(Helper::translation(4866,$translate)); ?></span>
                    </label>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-confirm-pass"><?php echo e(Helper::translation(3114,$translate)); ?> <span class="required">*</span></label>
                  <div class="password-toggle">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="<?php echo e(Helper::translation(3243,$translate)); ?>" data-bvalidator="equal[password],required" autocomplete="new-password">
                    <label class="password-toggle-btn">
                      <input class="custom-control-input" type="checkbox"><i class="dwg-eye password-toggle-indicator"></i><span class="sr-only"><?php echo e(Helper::translation(4866,$translate)); ?></span>
                    </label>
                  </div>
                </div>
              </div>
              <?php if( request()->get('type') !== 'customer'): ?> 
              <div class="col-sm-6">
              <div class="form-group">
                  <label for="account-country">Country<span class="require">*</span></label>
                  <select name="country" id="country" class="form-control" data-bvalidator="required">
                                    <option value="">Select Country</option>
                                    <?php $__currentLoopData = $country['country']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($country->country_id); ?>"><?php echo e($country->country_name); ?></option>
                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </select>       
                </div>
                </div>
                <div class="col-sm-6">
              <div class="form-group">
                  <label for="account-state">State<span class="require">*</span></label>
                  <select name="state" id="state" class="form-control" data-bvalidator="required">
                                    <option value="">Select State</option>
                                    <?php $__currentLoopData = $state['state']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($state->id); ?>" ><?php echo e($state->name); ?></option>
                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </select>       
                </div>
                </div>
              <div class="col-sm-6">
              <div class="form-group">
                  <label for="account-city">City<span class="require">*</span></label>
                  <select name="city" id="city" class="form-control" data-bvalidator="required">
                                    <option value="">Select City</option>
                                    <?php $__currentLoopData = $city['city']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($city->id); ?>"><?php echo e($city->name); ?></option>
                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </select>       
                </div>
                </div> 
                <div class="col-sm-6"></div>
                <div class="col-sm-12" style="color: red;font-size: small;margin-bottom: 10px;">MANDATORY: At Least One of the Following for Verification Purposes</div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-ppa">PPA Profile Link</label>
                  <input type="text" class="form-control" name="ppa_profile" value="" placeholder="Enter your PPA Profile Link">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-ppa">Website Link</label>
                  <input type="text" class="form-control" name="website" value="" placeholder="Enter Website Link">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-facebook">Facebook Page</label>
                  <input type="text" class="form-control" name="facebook_url" value="" placeholder="ex: https://www.facebook.com">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-twitter">Twitter Handle</label>
                  <input type="text" class="form-control" name="twitter_url" value="" placeholder="ex: https://www.twitter.com">
                </div>
              </div>

              <?php endif; ?>

              <?php if($additional->site_google_recaptcha == 1): ?>
              <div class="col-sm-12">
              <div class="form-group<?php echo e($errors->has('g-recaptcha-response') ? ' has-error' : ''); ?>">
                <label><?php echo e(Helper::translation(3244,$translate)); ?> <span class="required">*</span></label>
                <?php echo app('captcha')->display(); ?>

                                <?php if($errors->has('g-recaptcha-response')): ?>
                                    <span class="help-block">
                                 <strong class="red"><?php echo e($errors->first('g-recaptcha-response')); ?></strong>
                            </span>
                     <?php endif; ?>
              </div>
              </div>
              <?php endif; ?>
              <div class="col-12">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                  <div class="custom-checkbox d-block">
                    <a href="<?php echo e(URL::to('/login')); ?>" class="nav-link-inline font-size-sm"><?php echo e(Helper::translation(3245,$translate)); ?> <?php echo e(Helper::translation(3225,$translate)); ?></a>
                  </div>
                  <button class="btn btn-primary mt-3 mt-sm-0" type="submit"><?php echo e(Helper::translation(3233,$translate)); ?></button>
                </div>
              </div>
            </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script>
function handleUserTypeChange(val){
window.location.href="/register?type="+val
}
</script>
</body>
</html>
<?php else: ?>
<?php echo $__env->make('503', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?><?php /**PATH /var/www/html/fickrr/resources/views/auth/register.blade.php ENDPATH**/ ?>