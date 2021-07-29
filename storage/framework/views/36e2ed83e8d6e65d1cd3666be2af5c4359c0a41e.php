<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <title><?php echo e($product_name); ?></title>
</head>
<body>
  <table width="100%" border="0">
      <tr>
        <td colspan="3">
          <?php if($allsettings->site_logo != ''): ?>
          <a href="<?php echo e(URL::to('/')); ?>" target="_blank">
          <img width="200" src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_logo); ?>" alt="<?php echo e($allsettings->site_title); ?>"/>
          </a>
          <?php endif; ?>
        </td>
      </tr>
      <tr>
        <td colspan="3">
        <h3><?php echo e(Helper::translation(6039,$translate)); ?></h3>
        <p><?php echo e(Helper::translation(6042,$translate)); ?><strong><?php echo e($license); ?></strong><br/>
        <?php echo e(Helper::translation(6045,$translate)); ?>

        </p>
        </td>
      </tr> 
      <tr>
       <td colspan="3">
         <table cellpadding="0" cellspacing="10">
          <tr>
            <td><strong><?php echo e(Helper::translation(2938,$translate)); ?></strong></td>
            <td>:</td>
            <td><?php echo e($product_name); ?></td>
          </tr>
          <tr>
            <td><strong><?php echo e(Helper::translation(2908,$translate)); ?></strong></td>
            <td>:</td>
            <td><a href="<?php echo e(URL::to('/')); ?>/item/<?php echo e($product_slug); ?>" target="_blank"><?php echo e(URL::to('/')); ?>/item/<?php echo e($product_slug); ?></a></td>
          </tr>
          <tr>
            <td><strong><?php echo e(Helper::translation(2888,$translate)); ?></strong></td>
            <td>:</td>
            <td><?php echo e($allsettings->site_currency); ?> <?php echo e($product_price); ?></td>
          </tr>
          <tr>
            <td><strong><?php echo e(Helper::translation(6048,$translate)); ?></strong></td>
            <td>:</td>
            <td><?php echo e($username); ?></td>
          </tr>
          <tr>
            <td><strong><?php echo e(Helper::translation(3173,$translate)); ?></strong></td>
            <td>:</td>
            <td><?php echo e($order_id); ?></td>
          </tr>
          <tr>
            <td><strong><?php echo e(Helper::translation(6051,$translate)); ?></strong></td>
            <td>:</td>
            <td><?php echo e($purchase_id); ?></td>
          </tr>
          <tr>
            <td><strong><?php echo e(Helper::translation(3102,$translate)); ?></strong></td>
            <td>:</td>
            <td><?php echo e(date("d M Y", strtotime($purchase_date))); ?></td>
          </tr>
          <tr>
            <td><strong><?php echo e(Helper::translation(3103,$translate)); ?></strong></td>
            <td>:</td>
            <td><?php echo e(date("d M Y", strtotime($expiry_date))); ?></td>
          </tr>
          <tr>
            <td><strong><?php echo e(Helper::translation(3175,$translate)); ?></strong></td>
            <td>:</td>
            <td><?php echo e($payment_type); ?></td>
          </tr>
          <tr>
            <td><strong><?php echo e(Helper::translation(6054,$translate)); ?></strong></td>
            <td>:</td>
            <td><?php echo e($payment_token); ?></td>
          </tr>
        </table>
      </td>
    </tr>  
    <tr>
      <td colspan="3">
      <p><?php echo e(Helper::translation(6057,$translate)); ?> <a href="<?php echo e(URL::to('/')); ?>" target="_blank"><strong><?php echo e(URL::to('/')); ?></strong></a></p>
      </td>
    </tr>      
    </table>
</body>
</body>
</html><?php /**PATH D:\xampp\htdocs\fickrr\resources\views/pdf_view.blade.php ENDPATH**/ ?>