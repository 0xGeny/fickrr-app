<div class="page-title-overlap pt-4" style="background-image: url('<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_banner); ?>');">
      <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-star">
              <li class="breadcrumb-item"><a class="text-nowrap" href="<?php echo e(URL::to('/')); ?>"><i class="dwg-home"></i><?php echo e(Helper::translation(2862,$translate)); ?></a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page"><?php echo e(Helper::translation(2935,$translate)); ?></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page"><?php echo e($type_name->item_type_name); ?></li>
              </li>
             </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 mb-0 text-white"><?php echo e(Helper::translation(2935,$translate)); ?> <span class="dwg-arrow-right"></span> <?php echo e($type_name->item_type_name); ?></h1>
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
              <!-- Product-->
            <form action="<?php echo e(route('edit-item')); ?>" class="setting_form" id="item_form" method="post" enctype="multipart/form-data">
            <?php echo e(csrf_field()); ?>

            <div class="row">
             <div class="col-sm-12 mb-1">
              <div class="alert alert-info alert-with-icon font-size-sm mb-4" role="alert">
                <div class="alert-icon-box"><i class="alert-icon dwg-announcement"></i></div> <b><?php echo e(Helper::translation(2986,$translate)); ?></b><br/><?php echo e(Helper::translation(2987,$translate)); ?> <?php echo e(Helper::translation(2988,$translate)); ?>

              </div>
              </div>
              <div class="col-sm-12 mb-1">
              <div class="alert alert-info alert-with-icon font-size-sm mb-4" role="alert">
                <div class="alert-icon-box"><i class="alert-icon dwg-announcement"></i></div><b><?php echo e(Helper::translation(2983,$translate)); ?> :</b> <?php echo e(Helper::translation(5961,$translate)); ?><br/><b><?php echo e(Helper::translation(2985,$translate)); ?> :</b> <?php echo e(Helper::translation(5964,$translate)); ?>

                <?php if($addition_settings->subscription_mode == 1): ?>
                <?php if(Auth::user()->user_subscr_space_level == 'limited'): ?><br/><span class="red-color"><b><?php echo e(Helper::translation(6171,$translate)); ?> : </b><?php echo e(Helper::formatSizeUnits(Helper::available_space(Auth::user()->id))); ?></span><?php endif; ?>
                <?php endif; ?> 
              </div>
              </div>
              <div class="col-sm-12 mb-1">
              <h4><?php echo e(Helper::translation(2936,$translate)); ?></h4>
              </div>
              <input type="hidden" name="item_type" value="<?php echo e($edit['item']->item_type); ?>">
              <input type="hidden" name="type_id" value="<?php echo e($typer_id); ?>"> 
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="account-fn"><?php echo e(Helper::translation(2938,$translate)); ?> <span class="require">*</span> (<?php echo e(Helper::translation(2939,$translate)); ?>)</label>
                  <input type="text" id="item_name" name="item_name" <?php if($errors->has('item_name')): ?> class="form-control border-color" <?php else: ?> class="form-control" <?php endif; ?> data-bvalidator="required,maxlen[100]" value="<?php echo e($edit['item']->item_name); ?>">
                  <?php if($errors->has('item_name')): ?>
                  <span class="help-block">
                     <span class="red"><?php echo e($errors->first('item_name')); ?></span>
                  </span>
                 <?php endif; ?>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="account-fn"><?php echo e(Helper::translation(2940,$translate)); ?></label>
                  <textarea name="item_shortdesc" rows="6"  class="form-control"><?php echo e($edit['item']->item_shortdesc); ?></textarea>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="account-fn"><?php echo e(Helper::translation(2941,$translate)); ?> <span class="require">*</span></label>
                  <textarea name="item_desc" id="summary-ckeditor" rows="6"  <?php if($errors->has('item_desc')): ?> class="form-control border-color" <?php else: ?> class="form-control" <?php endif; ?> data-bvalidator="required"><?php echo e(html_entity_decode($edit['item']->item_desc)); ?></textarea>
                  <?php if($errors->has('item_desc')): ?>
                  <span class="help-block">
                     <span class="red"><?php echo e($errors->first('item_desc')); ?></span>
                  </span>
                 <?php endif; ?>
                </div>
              </div>
              <div class="col-sm-12 mt-4 mb-1">
              <h4 class="mt-4"><?php echo e(Helper::translation(2942,$translate)); ?></h4>
              </div>
              <div class="col-sm-6">
                <div class="form-group upload_wrapper">
                  <label for="account-fn"><?php echo e(Helper::translation(2943,$translate)); ?> <span class="require">*</span> (<?php echo e(Helper::translation(2946,$translate)); ?> : 80x80px)</label>
                  <div class="custom_upload">
                    <label for="thumbnail">
                      <input type="file" id="item_thumbnail" name="item_thumbnail" <?php if($errors->has('item_thumbnail')): ?> class="files border-color" <?php else: ?> class="files" <?php endif; ?>>
                      <?php if($edit['item']->item_thumbnail!=''): ?>
                      <img src="<?php echo e(url('/')); ?>/public/storage/items/<?php echo e($edit['item']->item_thumbnail); ?>" alt="<?php echo e($edit['item']->item_name); ?>" width="80">
                      <?php else: ?>
                      <img src="<?php echo e(url('/')); ?>/public/img/no-image.png" alt="<?php echo e($edit['item']->item_name); ?>" width="80">
                      <?php endif; ?>
                      </label>
                      <?php if($errors->has('item_thumbnail')): ?>
                      <span class="help-block">
                         <span class="red"><?php echo e($errors->first('item_thumbnail')); ?></span>
                      </span>
                     <?php endif; ?>
                 </div>
                </div>
              </div> 
              <div class="col-sm-6">
                <div class="form-group upload_wrapper">
                  <label for="account-fn"><?php echo e(Helper::translation(2945,$translate)); ?> <span class="require">*</span> (<?php echo e(Helper::translation(2946,$translate)); ?> : 361x230px)</label>
                  <div class="custom_upload">
                    <label for="thumbnail">
                      <input type="file" id="item_preview" name="item_preview" <?php if($errors->has('item_preview')): ?> class="files border-color" <?php else: ?> class="files" <?php endif; ?>>
                      <?php if($edit['item']->item_preview!=''): ?>
                      <img src="<?php echo e(url('/')); ?>/public/storage/items/<?php echo e($edit['item']->item_preview); ?>" alt="<?php echo e($edit['item']->item_name); ?>" width="80">
                      <?php else: ?>
                      <img src="<?php echo e(url('/')); ?>/public/img/no-image.png" alt="<?php echo e($edit['item']->item_name); ?>" width="80">
                      <?php endif; ?>
                      </label>
                      <?php if($errors->has('item_preview')): ?>
                      <span class="help-block">
                         <span class="red"><?php echo e($errors->first('item_preview')); ?></span>
                      </span>
                     <?php endif; ?>
                 </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-fn">Upload Main File Type <span class="require">*</span></label>
                  <select name="file_type" id="file_type" class="form-control" data-bvalidator="required">
                  <option value=""></option>
                  <option value="file" <?php if($edit['item']->file_type == 'file'): ?> selected <?php endif; ?>>File</option>
                  <option value="link" <?php if($edit['item']->file_type == 'link'): ?> selected <?php endif; ?>>Link/URL</option>
                  </select>
                </div>
              </div>
              <div id="main_file" <?php if($edit['item']->file_type == 'file'): ?> class="col-sm-6 display-block" <?php else: ?>  class="col-sm-6 display-none" <?php endif; ?>>
                <div class="form-group upload_wrapper">
                  <label for="account-fn"><?php echo e(Helper::translation(2947,$translate)); ?> <span class="require">*</span> (<?php echo e(Helper::translation(2948,$translate)); ?> <?php if($addition_settings->subscription_mode == 1): ?> <?php if(Auth::user()->user_subscr_space_level == 'limited'): ?>| Max Size : <?php echo e(Auth::user()->user_subscr_space); ?> <?php echo e(Auth::user()->user_subscr_space_type); ?> <?php endif; ?> <?php endif; ?>)</label>
                  <div class="custom_upload">
                    <label for="thumbnail">
                      <input type="file" id="item_file" name="item_file" <?php if($errors->has('item_file')): ?> class="files border-color" <?php else: ?> class="files" <?php endif; ?>>
                      <?php if($allsettings->site_s3_storage == 1): ?>
                      <?php $fileurl = Storage::disk('s3')->url($edit['item']->item_file); ?>
                      <a href="<?php echo e($fileurl); ?>" download><?php echo e($edit['item']->item_file); ?></a>
                      <?php else: ?>
                      <?php if($edit['item']->item_file!=''): ?>
                      <a href="<?php echo e(url('/')); ?>/public/storage/items/<?php echo e($edit['item']->item_file); ?>" download><?php echo e($edit['item']->item_file); ?></a>
                      <?php endif; ?>
                      <?php endif; ?>
                      </label>
                      <?php if($errors->has('item_file')): ?>
                      <span class="help-block">
                         <span class="red"><?php echo e($errors->first('item_file')); ?></span>
                      </span>
                     <?php endif; ?>
                 </div>
                </div>
              </div>
              <div id="main_link" <?php if($edit['item']->file_type == 'link'): ?> class="col-sm-6 display-block" <?php else: ?>  class="col-sm-6 display-none" <?php endif; ?>>
                <div class="form-group">
                  <label for="account-fn">Main File Link/URL <span class="require">*</span></label>
                  <input type="text" id="item_file_link" name="item_file_link" class="form-control" data-bvalidator="required,url" value="<?php echo e($edit['item']->item_file_link); ?>">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group upload_wrapper">
                  <label for="account-fn"><?php echo e(Helper::translation(2950,$translate)); ?> (<?php echo e(Helper::translation(2946,$translate)); ?> : 750x430px)</label>
                  <div class="custom_upload">
                    <label for="thumbnail">
                      <input type="file" id="item_screenshot" name="item_screenshot[]" class="files">
                      <?php $__currentLoopData = $item_image['item']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <span class="item-img"><img src="<?php echo e(url('/')); ?>/public/storage/items/<?php echo e($item->item_image); ?>" alt="<?php echo e($item->item_image); ?>" width="80">
                      <a href="<?php echo e(url('/edit-item')); ?>/dropimg/<?php echo e(base64_encode($item->itm_id)); ?>" onClick="return confirm('<?php echo e(Helper::translation(2892,$translate)); ?>');" class="drop-icon"><span class="dwg-trash drop-icon"></span></a>
                      </span>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </label>
                 </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-fn"><?php echo e(Helper::translation(5229,$translate)); ?></label>
                  <select name="video_preview_type" id="video_preview_type" <?php if($errors->has('video_file')): ?> class="form-control border-color" <?php else: ?> class="form-control" <?php endif; ?>>
                   <option value=""></option>
                   <option value="youtube" <?php if($edit['item']->video_preview_type == 'youtube'): ?> selected <?php endif; ?>><?php echo e(Helper::translation(5925,$translate)); ?></option>
                   <option value="mp4" <?php if($edit['item']->video_preview_type == 'mp4'): ?> selected <?php endif; ?>><?php echo e(Helper::translation(5928,$translate)); ?></option>
                  </select>
                  <?php if($errors->has('video_file')): ?>
                      <span class="help-block">
                         <span class="red"><?php echo e($errors->first('video_file')); ?></span>
                      </span>
                     <?php endif; ?>
                </div>
              </div>
              <div class="col-sm-6">
                <div id="youtube" <?php if($edit['item']->video_preview_type == 'youtube'): ?> class="form-group force-block" <?php else: ?> class="form-group force-none" <?php endif; ?>>
                  <label for="account-fn"><?php echo e(Helper::translation(2967,$translate)); ?> <span class="require">*</span></label>
                  <input type="text" id="video_url" name="video_url" class="form-control" data-bvalidator="required" value="<?php echo e($edit['item']->video_url); ?>">
                  <small>(<?php echo e(Helper::translation(2968,$translate)); ?> : https://www.youtube.com/watch?v=C0DPdy98e4c)</small>
                </div>
              </div>
              <div class="col-sm-6">
                <div id="mp4" <?php if($edit['item']->video_preview_type == 'mp4'): ?> class="form-group force-block upload_wrapper" <?php else: ?> class="form-group force-none upload_wrapper" <?php endif; ?>>
                  <label for="account-fn"><?php echo e(Helper::translation(5910,$translate)); ?> <span class="require">*</span> (<?php echo e(Helper::translation(5913,$translate)); ?> <?php if($addition_settings->subscription_mode == 1): ?> <?php if(Auth::user()->user_subscr_space_level == 'limited'): ?>| Max Size : <?php echo e(Auth::user()->user_subscr_space); ?> <?php echo e(Auth::user()->user_subscr_space_type); ?> <?php endif; ?> <?php endif; ?>)</label>
                  <div class="custom_upload">
                    <label for="thumbnail">
                      <input type="file" id="video_file" name="video_file" class="text_field files">
                      <?php if($allsettings->site_s3_storage == 1): ?>
                      <?php $videofileurl = Storage::disk('s3')->url($edit['item']->video_file); ?>
                      <a href="<?php echo e($videofileurl); ?>" download><?php echo e($edit['item']->video_file); ?></a>
                      <?php else: ?>
                      <?php if($edit['item']->video_file!=''): ?>
                      <a href="<?php echo e(url('/')); ?>/public/storage/items/<?php echo e($edit['item']->video_file); ?>"  download><?php echo e($edit['item']->video_file); ?></a><?php endif; ?>
                      <?php endif; ?>
                      </label>
                 </div>
                </div>
              </div>
              <div class="col-sm-12 mt-4 mb-1">
              <h4 class="mt-4"><?php echo e(Helper::translation(2951,$translate)); ?></h4>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-email"><?php echo e(Helper::translation(2952,$translate)); ?> <span class="require">*</span></label>
                  <select name="item_category" id="item_category" class="form-control" data-bvalidator="required">
                  <option value=""><?php echo e(Helper::translation(5931,$translate)); ?></option>
                  <?php $__currentLoopData = $categories['menu']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="category_<?php echo e($menu->cat_id); ?>" <?php if($cat_name == 'category'): ?> <?php if($menu->cat_id == $cat_id): ?> selected="selected" <?php endif; ?> <?php endif; ?>><?php echo e($menu->category_name); ?></option>
                  <?php $__currentLoopData = $menu->subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="subcategory_<?php echo e($sub_category->subcat_id); ?>" <?php if($cat_name == 'subcategory'): ?> <?php if($sub_category->subcat_id == $cat_id): ?> selected="selected" <?php endif; ?> <?php endif; ?>> - <?php echo e($sub_category->subcategory_name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
              </div>
              <?php if(count($attribute['fields']) != 0): ?>
              <?php $__currentLoopData = $attri_field['display']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute_field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-fn"><?php echo e($attribute_field->attr_label); ?> <span class="require">*</span></label>
                  <?php 
                  $field_value=explode(',',$attribute_field->attr_field_value); 
                  $checkpackage=explode(',',$attribute_field->item_attribute_values);
                  ?>
                  <?php if($attribute_field->attr_field_type == 'multi-select'): ?>
                  <div class="select-wrap select-wrap2">
                  <select  name="attributes_<?php echo e($attribute_field->attr_id); ?>[]" class="form-control" multiple="multiple" data-bvalidator="required">
                  <?php $__currentLoopData = $field_value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($field); ?>" <?php if(in_array($field,$checkpackage)): ?> selected="selected" <?php endif; ?>><?php echo e($field); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                  </div>
                  <?php endif; ?>
                  <?php if($attribute_field->attr_field_type == 'single-select'): ?>
                  <div class="select-wrap select-wrap2">
                  <select name="attributes_<?php echo e($attribute_field->attr_id); ?>[]" class="form-control" data-bvalidator="required">
                  <option value=""></option>
                  <?php $__currentLoopData = $field_value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($field); ?>" <?php if($attribute_field->item_attribute_values == $field): ?> selected <?php endif; ?>><?php echo e($field); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                  <span class="lnr lnr-chevron-down"></span>
                  </div>
                  <?php endif; ?>
                  <?php if($attribute_field->attr_field_type == 'textbox'): ?>
                  <input name="attributes_<?php echo e($attribute_field->attr_id); ?>[]" type="text" class="form-control" data-bvalidator="required">
                  <?php endif; ?>
                </div>
              </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php else: ?>
              <?php $__currentLoopData = $attri_field['display']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute_field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-fn"><?php echo e($attribute_field->attr_label); ?> <span class="require">*</span></label>
                  <?php $field_value=explode(',',$attribute_field->attr_field_value); ?>
                  <?php if($attribute_field->attr_field_type == 'multi-select'): ?>
                  <div class="select-wrap select-wrap2">
                  <select  name="attributes_<?php echo e($attribute_field->attr_id); ?>[]" class="form-control" multiple="multiple" data-bvalidator="required">
                  <?php $__currentLoopData = $field_value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($field); ?>"><?php echo e($field); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                  </div>
                  <?php endif; ?>
                  <?php if($attribute_field->attr_field_type == 'single-select'): ?>
                  <div class="select-wrap select-wrap2">
                  <select name="attributes_<?php echo e($attribute_field->attr_id); ?>[]" class="form-control" data-bvalidator="required">
                  <option value=""></option>
                  <?php $__currentLoopData = $field_value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($field); ?>"><?php echo e($field); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                  <span class="lnr lnr-chevron-down"></span>
                  </div>
                  <?php endif; ?>
                  <?php if($attribute_field->attr_field_type == 'textbox'): ?>
                  <input name="attributes_<?php echo e($attribute_field->attr_id); ?>[]" type="text" class="form-control" data-bvalidator="required">
                  <?php endif; ?>
                </div>
              </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="account-fn"><?php echo e(Helper::translation(6237,$translate)); ?> <span class="require">*</span></label>
                  <textarea name="seller_refund_term"  rows="6"  class="form-control" data-bvalidator="required"><?php echo e($edit['item']->seller_refund_term); ?></textarea>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="account-fn"><?php echo e(Helper::translation(6240,$translate)); ?>? <span class="require">*</span></label>
                  <select name="seller_money_back" id="seller_money_back" class="form-control" data-bvalidator="required">
                  <option value=""></option>
                  <option value="1" <?php if($edit['item']->seller_money_back == 1): ?> selected <?php endif; ?>><?php echo e(Helper::translation(2970,$translate)); ?></option>
                  <option value="0" <?php if($edit['item']->seller_money_back == 0): ?> selected <?php endif; ?>><?php echo e(Helper::translation(2971,$translate)); ?></option>
                  </select>
                </div>
              </div>
              <div id="back_money" <?php if($edit['item']->seller_money_back == 1): ?> class="col-sm-12 display-block" <?php else: ?>  class="col-sm-12 display-none" <?php endif; ?>>
                <div class="form-group">
                  <label for="account-fn"><?php echo e(Helper::translation(6243,$translate)); ?>?</label>
                  <input type="text" id="seller_money_back_days" name="seller_money_back_days" class="form-control" data-bvalidator="min[1]" value="<?php echo e($edit['item']->seller_money_back_days); ?>">
                  <small>(days)</small>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-fn"><?php echo e(Helper::translation(2966,$translate)); ?></label>
                  <input type="text" id="demo_url" name="demo_url" class="form-control" data-bvalidator="url" value="<?php echo e($edit['item']->demo_url); ?>">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-fn"><?php echo e(Helper::translation(2969,$translate)); ?> <span class="require">*</span></label>
                  <select name="free_download" id="free_download" class="form-control" data-bvalidator="required">
                  <option value=""></option>
                  <option value="1" <?php if($edit['item']->free_download == 1): ?> selected="selected" <?php endif; ?>><?php echo e(Helper::translation(2970,$translate)); ?></option>
                  <option value="0" <?php if($edit['item']->free_download == 0): ?> selected="selected" <?php endif; ?>><?php echo e(Helper::translation(2971,$translate)); ?></option>
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-fn"><?php echo e(Helper::translation(2972,$translate)); ?></label>
                  <select name="item_flash_request" id="item_flash_request" class="form-control">
                  <option value=""></option>
                  <option value="1" <?php if($edit['item']->item_flash_request == 1): ?> selected="selected" <?php endif; ?>><?php echo e(Helper::translation(2970,$translate)); ?></option>
                  <option value="0" <?php if($edit['item']->item_flash_request == 0): ?> selected="selected" <?php endif; ?>><?php echo e(Helper::translation(2971,$translate)); ?></option>
                  </select>
                  <small>(<?php echo e(Helper::translation(2973,$translate)); ?>)</small>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-fn"><?php echo e(Helper::translation(2974,$translate)); ?></label>
                  <textarea name="item_tags" id="item_tags" rows="6" class="form-control"><?php echo e($edit['item']->item_tags); ?></textarea>
                  <small>(<?php echo e(Helper::translation(2975,$translate)); ?>)</small>
                </div>
              </div>
              <div class="col-sm-12 mt-4 mb-1">
              <h4 class="mt-4"><?php echo e(Helper::translation(2976,$translate)); ?></h4>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-fn"><?php echo e(Helper::translation(2977,$translate)); ?> <span class="require">*</span></label>
                  <select name="future_update" id="future_update" class="form-control" data-bvalidator="required">
                  <option value=""></option>
                  <option value="1" <?php if($edit['item']->future_update == 1): ?> selected="selected" <?php endif; ?>><?php echo e(Helper::translation(2970,$translate)); ?></option>
                  <option value="0" <?php if($edit['item']->future_update == 0): ?> selected="selected" <?php endif; ?>><?php echo e(Helper::translation(2971,$translate)); ?></option>
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-fn"><?php echo e(Helper::translation(2978,$translate)); ?> <span class="require">*</span></label>
                  <select name="item_support" id="item_support" class="form-control" data-bvalidator="required">
                  <option value=""></option>
                  <option value="1" <?php if($edit['item']->item_support == 1): ?> selected="selected" <?php endif; ?>><?php echo e(Helper::translation(2970,$translate)); ?></option>
                  <option value="0" <?php if($edit['item']->item_support == 0): ?> selected="selected" <?php endif; ?>><?php echo e(Helper::translation(2971,$translate)); ?></option>
                  </select>
                </div>
              </div>
              <div class="col-sm-12 mt-4 mb-1">
              <h4 class="mt-4"><?php echo e(Helper::translation(2888,$translate)); ?></h4>
              </div>
              <div class="col-sm-6 mb-1">
                    <label class="font-weight-medium" for="unp-standard-price"><?php echo e(Helper::translation(2979,$translate)); ?> <span class="require">*</span></label>
                    <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text"><?php echo e($allsettings->site_currency); ?></span></div>
                      <input type="text" id="regular_price" name="regular_price" class="form-control" data-bvalidator="digit,min[1],required" value="<?php echo e($edit['item']->regular_price); ?>">
                    </div>
              </div>
              <div class="col-sm-6 mb-1">
                    <label class="font-weight-medium" for="unp-standard-price"><?php echo e(Helper::translation(2980,$translate)); ?> <span class="require">*</span></label>
                    <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text"><?php echo e($allsettings->site_currency); ?></span></div>
                      <input type="text" id="extended_price" name="extended_price" class="form-control" data-bvalidator="digit,min[1]" value="<?php if($edit['item']->extended_price==0): ?> <?php else: ?> <?php echo e($edit['item']->extended_price); ?> <?php endif; ?>">
                    </div>
              </div>
              <input type="hidden" name="save_file" value="<?php echo e($edit['item']->item_file); ?>">
              <input type="hidden" name="save_thumbnail" value="<?php echo e($edit['item']->item_thumbnail); ?>">
              <input type="hidden" name="save_preview" value="<?php echo e($edit['item']->item_preview); ?>">
              <input type="hidden" name="save_extended_price" value="<?php echo e($edit['item']->extended_price); ?>">
              <input type="hidden" name="item_token" value="<?php echo e($edit['item']->item_token); ?>">
              <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>">
              <input type="hidden" name="save_video_file" value="<?php echo e($edit['item']->video_file); ?>">
              <div class="col-12 pt-3 mt-3">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                <?php if($allsettings->item_approval == 0): ?>
                <button class="btn btn-primary btn-block" type="submit"><i class="dwg-cloud-upload font-size-lg mr-2"></i><?php echo e(Helper::translation(2981,$translate)); ?></button>
                <?php else: ?>
                <button class="btn btn-primary btn-block" type="submit"><i class="dwg-cloud-upload font-size-lg mr-2"></i><?php echo e(Helper::translation(2876,$translate)); ?></button>
                <?php endif; ?>
                </div>
              </div>
            </div>
          </form>  
            </div>
          </section>
        </div>
      </div>
    </div><?php /**PATH /var/www/html/resources/views/edit-my-item.blade.php ENDPATH**/ ?>