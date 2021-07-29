<div class="page-title-overlap pt-4" style="background-image: url('<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_banner); ?>');">
      <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-star">
              <li class="breadcrumb-item"><a class="text-nowrap" href="<?php echo e(URL::to('/')); ?>"><i class="dwg-home"></i><?php echo e(Helper::translation(2862,$translate)); ?></a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page"><?php echo e(Helper::translation(3024,$translate)); ?></li>
              </li>
             </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 mb-0 text-white"><?php echo e(Helper::translation(3024,$translate)); ?></h1>
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
          <?php if(count($orderData['item']) != 0): ?>
          <section class="col-lg-8 pt-lg-4 pb-4 mb-3">
            <div class="pt-2 px-4 pl-lg-0 pr-xl-5">
              <div class="row mx-n2 pt-2">
                <?php if(Auth::user()->user_type == 'customer'): ?>
                <div class="col-md-3 col-sm-12 px-2 mb-4">
                  <div class="bg-secondary h-100 rounded-lg p-4 text-center">
                    <h3 class="font-size-sm text-muted"><?php echo e(Helper::translation(3169,$translate)); ?></h3>
                    <p class="h2 mb-2"><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($purchase_sale); ?></p>
                  </div>
                </div>
                <div class="col-md-3 col-sm-12 px-2 mb-4">
                  <div class="bg-secondary h-100 rounded-lg p-4 text-center">
                    <h3 class="font-size-sm text-muted"><?php echo e(Helper::translation(3171,$translate)); ?></h3>
                    <p class="h2 mb-2"><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($drawal_amount); ?></p>
                  </div>
                </div>
                <div class="col-md-3 col-sm-12 px-2 mb-4">
                  <div class="bg-secondary h-100 rounded-lg p-4 text-center">
                    <h3 class="font-size-sm text-muted"><?php echo e(Helper::translation(5721,$translate)); ?></h3>
                    <p class="h2 mb-2"><?php echo e($allsettings->site_currency_symbol); ?><?php echo e(Auth::user()->referral_amount); ?></p>
                  </div>
                </div>
                <div class="col-md-3 col-sm-12 px-2 mb-4">
                  <div class="bg-secondary h-100 rounded-lg p-4 text-center">
                    <h3 class="font-size-sm text-muted">Total Referrals</h3>
                    <p class="h2 mb-2"><?php echo e(Auth::user()->referral_count); ?></p>
                  </div>
                </div>
                <?php endif; ?>
              </div>
              <?php $__currentLoopData = $orderData['item']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="media d-block d-sm-flex align-items-center py-4 border-bottom prod-item">
              <a class="d-block mb-3 mb-sm-0 mr-sm-4 mx-auto" href="<?php echo e(url('/item')); ?>/<?php echo e($item->item_slug); ?>" style="width: 12.5rem;">
              <?php if($item->item_thumbnail!=''): ?>
              <img class="rounded-lg purchase-img" src="<?php echo e(url('/')); ?>/public/storage/items/<?php echo e($item->item_thumbnail); ?>" alt="<?php echo e($item->item_name); ?>">
              <?php else: ?>
              <img class="rounded-lg purchase-img" src="<?php echo e(url('/')); ?>/public/img/no-image.png" alt="<?php echo e($item->item_name); ?>">
              <?php endif; ?>
              </a>
                <div class="d-block mb-3 mb-sm-0 mr-sm-4 mx-auto">
                  <h3 class="h6 product-title mb-2"><a href="<?php echo e(url('/item')); ?>/<?php echo e($item->item_slug); ?>"><?php echo e($item->item_name); ?></a></h3>
                  <div class="font-size-sm"><strong><?php echo e(Helper::translation(2888,$translate)); ?>:</strong> <?php echo e($allsettings->site_currency_symbol); ?><?php echo e($item->item_price); ?></div>
                  <div class="d-flex align-items-center justify-content-center justify-content-sm-start">
                   <?php if($item->approval_status != 'payment released to customer'): ?>
                   <?php if($item->approval_status == 'payment released to vendor'): ?>
                    <?php if($item->rating != 0): ?>
                    <a class="d-block text-muted text-center my-2" href="javascript:void(0);" data-toggle="modal" data-target="#myModal_<?php echo e($item->ord_id); ?>">
                      <div class="star-rating">
                      <?php if($item->rating == 1): ?>
                      <i class="sr-star dwg-star-filled active"></i>
                      <i class="sr-star dwg-star"></i>
                      <i class="sr-star dwg-star"></i>
                      <i class="sr-star dwg-star"></i>
                      <i class="sr-star dwg-star"></i>
                      <?php endif; ?>
                      <?php if($item->rating == 2): ?>
                      <i class="sr-star dwg-star-filled active"></i>
                      <i class="sr-star dwg-star-filled active"></i>
                      <i class="sr-star dwg-star"></i>
                      <i class="sr-star dwg-star"></i>
                      <i class="sr-star dwg-star"></i>
                      <?php endif; ?>
                      <?php if($item->rating == 3): ?>
                      <i class="sr-star dwg-star-filled active"></i>
                      <i class="sr-star dwg-star-filled active"></i>
                      <i class="sr-star dwg-star-filled active"></i>
                      <i class="sr-star dwg-star"></i>
                      <i class="sr-star dwg-star"></i>
                      <?php endif; ?>
                      <?php if($item->rating == 4): ?>
                      <i class="sr-star dwg-star-filled active"></i>
                      <i class="sr-star dwg-star-filled active"></i>
                      <i class="sr-star dwg-star-filled active"></i>
                      <i class="sr-star dwg-star-filled active"></i>
                      <i class="sr-star dwg-star"></i>
                      <?php endif; ?>
                      <?php if($item->rating == 5): ?>
                      <i class="sr-star dwg-star-filled active"></i>
                      <i class="sr-star dwg-star-filled active"></i>
                      <i class="sr-star dwg-star-filled active"></i>
                      <i class="sr-star dwg-star-filled active"></i>
                      <i class="sr-star dwg-star-filled active"></i>
                      <?php endif; ?>
                      </div>
                      <div class="font-size-xs"><?php echo e(Helper::translation(6060,$translate)); ?></div>
                      </a>
                      <?php else: ?>
                      <a class="d-block text-muted text-center my-2" href="javascript:void(0);" data-toggle="modal" data-target="#myModal_<?php echo e($item->ord_id); ?>">
                      <div class="star-rating">
                      <i class="sr-star dwg-star"></i>
                      <i class="sr-star dwg-star"></i>
                      <i class="sr-star dwg-star"></i>
                      <i class="sr-star dwg-star"></i>
                      <i class="sr-star dwg-star"></i>
                      </div>
                      <div class="font-size-xs"><?php echo e(Helper::translation(6060,$translate)); ?></div>
                      </a>
                      <?php endif; ?>
                      <?php endif; ?>
                      <?php endif; ?>
                  </div>
                  <?php if($item->approval_status != 'payment released to customer'): ?>
                  <div class="d-flex mt-2 pt-2">
                  <a href="<?php echo e(url('/purchases')); ?>/<?php echo e($item->item_token); ?>" class="btn btn-success btn-sm mr-3"><i class="dwg-download mr-1"></i><?php echo e(Helper::translation(3144,$translate)); ?></a>
                  <a href="<?php echo e(url('/invoice')); ?>/<?php echo e($item->item_token); ?>/<?php echo e($item->ord_id); ?>" class="btn btn-primary btn-sm mr-3"><i class="dwg-download mr-1"></i><?php echo e(Helper::translation(6063,$translate)); ?></a>
                  </div>
                  <?php endif; ?>
                </div>
                <div class="d-block mb-3 mb-sm-0 mr-sm-4 mx-auto">
                <div class="font-size-sm mb-1"><strong><?php echo e(Helper::translation(3173,$translate)); ?>:</strong> <?php echo e($item->ord_id); ?></div>
                <div class="font-size-sm mb-1"><strong><?php echo e(Helper::translation(6051,$translate)); ?>:</strong> <?php echo e($item->purchase_token); ?></div>
                <div class="font-size-sm mb-1"><strong><?php echo e(Helper::translation(3102,$translate)); ?></strong> <?php echo e(date("d F Y", strtotime($item->start_date))); ?></div>
                <div class="font-size-sm mb-1"><strong><?php echo e(Helper::translation(3103,$translate)); ?></strong> <?php echo e(date("d F Y", strtotime($item->end_date))); ?></div>
                <div class="font-size-sm mb-1"><strong><?php echo e(Helper::translation(3105,$translate)); ?></strong> <?php echo e($item->license); ?></div>
                  <?php if($item->approval_status != 'payment released to customer'): ?>
                  <div class="font-size-sm mb-1"><strong><?php echo e(Helper::translation(3143,$translate)); ?></strong> <a href="javascript:void(0);" data-toggle="modal" data-target="#refund_<?php echo e($item->ord_id); ?>"> <?php echo e(Helper::translation(6066,$translate)); ?></a></div>
                  <?php endif; ?>
                </div>
              </div>
              <div class="modal fade" id="myModal_<?php echo e($item->ord_id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo e(Helper::translation(3153,$translate)); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form action="<?php echo e(route('purchases')); ?>" method="post" id="profile_form" enctype="multipart/form-data">
      <?php echo e(csrf_field()); ?> 
      <div class="modal-body">
                    <input type="hidden" name="item_id" value="<?php echo e($item->item_id); ?>">
                    <input type="hidden" name="ord_id" value="<?php echo e($item->ord_id); ?>">
                    <input type="hidden" name="item_token" value="<?php echo e($item->item_token); ?>">
                    <input type="hidden" name="user_id" value="<?php echo e($item->user_id); ?>">
                    <input type="hidden" name="item_user_id" value="<?php echo e($item->item_user_id); ?>">
                    <input type="hidden" name="item_url" value="<?php echo e(url('/item')); ?>/<?php echo e($item->item_slug); ?>/<?php echo e($item->item_id); ?>">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><?php echo e(Helper::translation(3154,$translate)); ?></label>
            <select name="rating" class="form-control" required>
                                        <option value="1" <?php if($item->rating == 1): ?> selected <?php endif; ?>>1</option>
                                        <option value="2" <?php if($item->rating == 2): ?> selected <?php endif; ?>>2</option>
                                        <option value="3" <?php if($item->rating == 3): ?> selected <?php endif; ?>>3</option>
                                        <option value="4" <?php if($item->rating == 4): ?> selected <?php endif; ?>>4</option>
                                        <option value="5" <?php if($item->rating == 5): ?> selected <?php endif; ?>>5</option>
                                    </select>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label"><?php echo e(Helper::translation(3155,$translate)); ?></label>
           <select name="rating_reason" class="form-control" required>
                                            <option value="design" <?php if($item->rating_reason == 'design'): ?> selected <?php endif; ?>><?php echo e(Helper::translation(3156,$translate)); ?></option>
                                            <option value="customization" <?php if($item->rating_reason == 'customization'): ?> selected <?php endif; ?>><?php echo e(Helper::translation(3157,$translate)); ?></option>
                                            <option value="support" <?php if($item->rating_reason == 'support'): ?> selected <?php endif; ?>><?php echo e(Helper::translation(3055,$translate)); ?></option>
                                            <option value="performance" <?php if($item->rating_reason == 'performance'): ?> selected <?php endif; ?>><?php echo e(Helper::translation(3158,$translate)); ?></option>
                                            <option value="documentation" <?php if($item->rating_reason == 'documentation'): ?> selected <?php endif; ?>><?php echo e(Helper::translation(3159,$translate)); ?></option>
                                        </select>
          </div>
          <div class="form-group">
          <label for="message-text" class="col-form-label"><?php echo e(Helper::translation(3054,$translate)); ?></label>
          <textarea name="rating_comment" id="rating_comment" class="form-control" required><?php echo e($item->rating_comment); ?></textarea>
                            <p><?php echo e(Helper::translation(3160,$translate)); ?></p>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><?php echo e(Helper::translation(4926,$translate)); ?></button>
        <button type="submit" class="btn btn-primary btn-sm"><?php echo e(Helper::translation(3161,$translate)); ?></button>
      </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="refund_<?php echo e($item->ord_id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo e(Helper::translation(3143,$translate)); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo e(route('refund')); ?>" method="post" id="profile_form" enctype="multipart/form-data">
      <?php echo e(csrf_field()); ?>

      <div class="modal-body">
          <input type="hidden" name="item_id" value="<?php echo e($item->item_id); ?>">
                    <input type="hidden" name="ord_id" value="<?php echo e($item->ord_id); ?>">
                    <input type="hidden" name="purchased_token" value="<?php echo e($item->purchase_token); ?>">
                    <input type="hidden" name="item_token" value="<?php echo e($item->item_token); ?>">
                    <input type="hidden" name="user_id" value="<?php echo e($item->user_id); ?>">
                    <input type="hidden" name="item_user_id" value="<?php echo e($item->item_user_id); ?>">
                    <input type="hidden" name="item_url" value="<?php echo e(url('/item')); ?>/<?php echo e($item->item_slug); ?>/<?php echo e($item->item_id); ?>">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><?php echo e(Helper::translation(3146,$translate)); ?></label>
            <select name="refund_reason" class="form-control" required>
                             <option value="<?php echo e(Helper::translation(3147,$translate)); ?>"><?php echo e(Helper::translation(3147,$translate)); ?></option>
                                            <option value="<?php echo e(Helper::translation(3148,$translate)); ?>"><?php echo e(Helper::translation(3148,$translate)); ?></option>
                                            <option value="<?php echo e(Helper::translation(3149,$translate)); ?>"><?php echo e(Helper::translation(3149,$translate)); ?></option>
                                            <option value="<?php echo e(Helper::translation(3150,$translate)); ?>"><?php echo e(Helper::translation(3150,$translate)); ?></option>
                                            <option value="<?php echo e(Helper::translation(3151,$translate)); ?>"><?php echo e(Helper::translation(3151,$translate)); ?></option>
                                        </select>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label"><?php echo e(Helper::translation(3054,$translate)); ?></label>
            <textarea name="refund_comment" id="refund_comment" class="form-control" required></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><?php echo e(Helper::translation(4926,$translate)); ?></button>
        <button type="submit" class="btn btn-primary btn-sm"><?php echo e(Helper::translation(3152,$translate)); ?></button>
      </div>
      </form>
    </div>
  </div>
 </div>
     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <!-- Product-->
       </div>
       <div class="pagination-area">
        <div class="turn-page" id="itempager"></div>
         </div>
          </section>
          <?php else: ?>
          <section class="col-lg-8 pt-lg-4 pb-4 mb-3">
             <div class="pt-2 px-4 pl-lg-0 pr-xl-5" align="center">
             <?php echo e(Helper::translation(4929,$translate)); ?>

             </div>
             </section>
              <?php endif; ?>
        </div>
      </div>
    </div><?php /**PATH /var/www/html/resources/views/my-purchase.blade.php ENDPATH**/ ?>