<?php if($allsettings->maintenance_mode == 0): ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title><?php echo e(Helper::translation(4782,$translate)); ?> - <?php echo e($allsettings->site_title); ?></title>
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
              <li class="breadcrumb-item text-nowrap active" aria-current="page"><?php echo e(Helper::translation(4782,$translate)); ?></li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 mb-0 text-white"><?php echo e(Helper::translation(4782,$translate)); ?></h1>
        </div>
      </div>
      </div>
    </section>
<div class="container py-5 mt-md-2 mb-2">
      <div class="row">
      <div class="col-md-12" data-aos="fade-up" data-aos-delay="200">
                    <div class="cardify term_modules">
                        <div class="row justify-content-center">
                        <div class="col-md-6 mx-auto">
                        <h3 align="center"><?php echo e(Helper::translation(4783,$translate)); ?> <span>:</span> <?php echo e($allsettings->site_currency); ?><?php echo e($final_amount); ?></h3>
                        </div>
                        </div> 
                        <div class="row justify-content-center pb-2 mb-2 mt-2 pt-2">
                <div class="col-md-6 mx-auto">
                    <div class="card bg-light mb-3">
                <div class="card-body">
                <form action="<?php echo e(route('2checkout')); ?>" class="needs-validation" id="subscribe_form" method="post" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                   <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label class="info-title black" for="exampleInputName"><?php echo e(Helper::translation(4784,$translate)); ?> <span class="red">*</span></label>
                                        <input id="ccNo" type="text" size="20" value="" class="form-control" autocomplete="off" data-bvalidator="required" placeholder="<?php echo e(Helper::translation(4785,$translate)); ?>" />
                                    </div>
                                </div>
                             </div>
                       <div class="row">
                       <div class="col-md-6">
                                    <div class="form-group">
                                    <label class="info-title black" for="exampleInputName"><?php echo e(Helper::translation(4786,$translate)); ?> <span class="red">*</span></label>
                                        <input type="number" size="2" id="expMonth" class="form-control" data-bvalidator="required,maxlen[2]" placeholder="<?php echo e(Helper::translation(4790,$translate)); ?>" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label class="info-title black" for="exampleInputName"><?php echo e(Helper::translation(4787,$translate)); ?> <span class="red">*</span></label>
                                        <input type="number" size="4" id="expYear" class="form-control" data-bvalidator="required,maxlen[4]" placeholder="<?php echo e(Helper::translation(4791,$translate)); ?>" />
                                    </div>
                                </div>
                                </div>     
                     <div class="row">
                       <div class="col-sm-12">
                                    <div class="form-group">
                                    <label class="info-title black" for="exampleInputName"><?php echo e(Helper::translation(4788,$translate)); ?> <span class="red">*</span></label>
                                        <input id="cvv" size="4" type="number" class="form-control" value="" autocomplete="off" data-bvalidator="required,maxlen[4]" />
                                    </div>
                                </div>
                                </div>
                                <input type="hidden" name="two_checkout_private" value="<?php echo e($two_checkout_private); ?>">
                                <input type="hidden" name="two_checkout_account" value="<?php echo e($two_checkout_account); ?>">
                                <input type="hidden" name="two_checkout_mode" value="<?php echo e($two_checkout_mode); ?>">
                                <input type="hidden" name="purchase_token" value="<?php echo e($purchase_token); ?>">
                                <input type="hidden" name="token" value="<?php echo e($token); ?>">
                                <input type="hidden" name="site_currency" value="<?php echo e($site_currency); ?>">
                                <input type="hidden" name="amount" value="<?php echo e(base64_encode($final_amount)); ?>">
                                <input type="hidden" name="product_names" value="<?php echo e($item_names_data); ?>">
                                <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>">
                                <input type="hidden" name="user_name" value="<?php echo e(Auth::user()->name); ?>">
                                <input type="hidden" name="user_email" value="<?php echo e(Auth::user()->email); ?>">
                                <div class="mx-auto">
                        <button type="submit" class="btn btn-primary btn-block"><?php echo e(Helper::translation(4789,$translate)); ?></button>
                        </div>
                   </form>
                   </div>
                   </div>
                   </div>
                   </div>
                   <!-- end /.term -->
                    </div>
                    <!-- end /.term_modules -->
                </div>
       </div>
    </div>
<?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!--- 2Checkout --->
<script type="text/javascript" src="https://www.2checkout.com/checkout/api/2co.min.js"></script>
<script>
            
			
			
            var successCallback = function(data) {
                var myForm = document.getElementById('subscribe_form');

                
                myForm.token.value = data.response.token.token;

                
                myForm.submit();
            };

           
            var errorCallback = function(data) {
                if (data.errorCode === 200) {
                    tokenRequest();
                } else {
                    alert(data.errorMsg);
                }
            };

            var tokenRequest = function() {
                
                var args = {
                    sellerId: "<?php echo e($two_checkout_account); ?>",
                    publishableKey: "<?php echo e($two_checkout_publishable); ?>",
                    ccNo: $("#ccNo").val(),
                    cvv: $("#cvv").val(),
                    expMonth: $("#expMonth").val(),
                    expYear: $("#expYear").val()
					
                };

               
                TCO.requestToken(successCallback, errorCallback, args);
            };
			
			

            $(function() {
			
			  
                
                TCO.loadPubKey('sandbox');

                $("#subscribe_form").submit(function(e) {
                    
                    tokenRequest();

                    
                    return false;
                });
				
				
				
				
            });
			
			
			
 </script>
<!-- 2Checkout --->
</body>
</html>
<?php else: ?>
<?php echo $__env->make('503', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?><?php /**PATH D:\xampp\htdocs\fickrr\resources\views/order-confirm.blade.php ENDPATH**/ ?>