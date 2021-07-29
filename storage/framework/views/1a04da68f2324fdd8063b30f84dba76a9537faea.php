<aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <?php if($allsettings->site_logo != ''): ?>
                <a class="navbar-brand" href="<?php echo e(url('/')); ?>"><img src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_logo); ?>"  alt="<?php echo e($allsettings->site_title); ?>" width="180"/></a>
                <?php else: ?>
                <a class="navbar-brand" href="<?php echo e(url('/')); ?>"><?php echo e(substr($allsettings->site_title,0,10)); ?></a>
                <?php endif; ?>
                <?php if($allsettings->site_favicon != ''): ?>
                <a class="navbar-brand hidden" href="<?php echo e(url('/')); ?>"><img src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_favicon); ?>"  alt="<?php echo e($allsettings->site_title); ?>" width="24"/></a>
                <?php else: ?>
                <a class="navbar-brand hidden" href="<?php echo e(url('/')); ?>"><?php echo e(substr($allsettings->site_title,0,1)); ?></a>
                <?php endif; ?>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <?php if(in_array('dashboard',$avilable)): ?>
                    <li class="active">
                        <a href="<?php echo e(url('/admin')); ?>"> <i class="menu-icon fa fa-dashboard"></i><?php echo e(Helper::translation(5421,$translate)); ?> </a>
                    </li>
                    <?php endif; ?>
                    <?php if(in_array('settings',$avilable)): ?>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-gears"></i><?php echo e(Helper::translation(5406,$translate)); ?></a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-gear"></i><a href="<?php echo e(url('/admin/general-settings')); ?>"><?php echo e(Helper::translation(5283,$translate)); ?></a></li>
                            <li><i class="fa fa-gear"></i><a href="<?php echo e(url('/admin/color-settings')); ?>"><?php echo e(Helper::translation(5154,$translate)); ?></a></li>
                            <li><i class="fa fa-gear"></i><a href="<?php echo e(url('/admin/currency-settings')); ?>"><?php echo e(Helper::translation(5187,$translate)); ?></a></li>
                            <li><i class="fa fa-gear"></i><a href="<?php echo e(url('/admin/country-settings')); ?>"><?php echo e(Helper::translation(5181,$translate)); ?></a></li>
                            <li><i class="fa fa-gear"></i><a href="<?php echo e(url('/admin/email-settings')); ?>"><?php echo e(Helper::translation(3130,$translate)); ?></a></li>
                            <li><i class="fa fa-gear"></i><a href="<?php echo e(url('/admin/media-settings')); ?>"><?php echo e(Helper::translation(5565,$translate)); ?></a></li>
                            <li><i class="fa fa-gear"></i><a href="<?php echo e(url('/admin/badges-settings')); ?>"><?php echo e(Helper::translation(5076,$translate)); ?></a></li>
                            <li><i class="fa fa-gear"></i><a href="<?php echo e(url('/admin/payment-settings')); ?>"><?php echo e(Helper::translation(5604,$translate)); ?></a></li>
                            <li><i class="fa fa-gear"></i><a href="<?php echo e(url('/admin/social-settings')); ?>"><?php echo e(Helper::translation(5607,$translate)); ?></a></li>
                            <li><i class="fa fa-gear"></i><a href="<?php echo e(url('/admin/limitation-settings')); ?>"><?php echo e(Helper::translation(5493,$translate)); ?></a></li>
                            <li><i class="fa fa-gear"></i><a href="<?php echo e(url('/admin/preferred-settings')); ?>"><?php echo e(Helper::translation(5610,$translate)); ?></a></li>
                        </ul>
                    </li>
                   <?php endif; ?>
                   <?php if(Auth::user()->id == 1): ?> 
                   <li class="menu-item-has-children dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i><?php echo e(Helper::translation(5613,$translate)); ?></a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-user"></i><a href="<?php echo e(url('/admin/administrator')); ?>"><?php echo e(Helper::translation(5058,$translate)); ?></a></li>
                            <li><i class="fa fa-user"></i><a href="<?php echo e(url('/admin/customer')); ?>"><?php echo e(Helper::translation(5196,$translate)); ?></a></li>
                            <li><i class="fa fa-user"></i><a href="<?php echo e(url('/admin/vendor')); ?>"><?php echo e(Helper::translation(5616,$translate)); ?></a></li>
                         </ul>
                    </li>
                    <?php endif; ?>                   
                    <?php if(in_array('items',$avilable)): ?> 
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-location-arrow"></i><?php echo e(Helper::translation(5442,$translate)); ?></a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-location-arrow"></i><a href="<?php echo e(url('/admin/category')); ?>"><?php echo e(Helper::translation(3084,$translate)); ?></a></li>
                            <li><i class="menu-icon fa fa-location-arrow"></i><a href="<?php echo e(url('/admin/sub-category')); ?>"><?php echo e(Helper::translation(5052,$translate)); ?></a></li>
                            <li><i class="menu-icon fa fa-location-arrow"></i><a href="<?php echo e(url('/admin/items')); ?>"><?php echo e(Helper::translation(5442,$translate)); ?></a></li>
                            <li><i class="menu-icon fa fa-location-arrow"></i><a href="<?php echo e(url('/admin/item-type')); ?>"><?php echo e(Helper::translation(2937,$translate)); ?></a></li>
                            <li><i class="menu-icon fa fa-location-arrow"></i><a href="<?php echo e(url('/admin/attributes')); ?>"><?php echo e(Helper::translation(5067,$translate)); ?></a></li>
                            <li><i class="menu-icon fa fa-location-arrow"></i><a href="<?php echo e(url('/admin/orders')); ?>"><?php echo e(Helper::translation(5619,$translate)); ?></a></li>
                        </ul>
                    </li>
                    <?php endif; ?>
                    <?php if(in_array('subscription',$avilable)): ?>
                    <?php if($addition_settings->subscription_mode == 1): ?>
                    <li>
                        <a href="<?php echo e(url('/admin/subscription')); ?>"> <i class="menu-icon fa fa-user"></i><?php echo e(Helper::translation(6105,$translate)); ?> </a>
                    </li>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php if(in_array('refund',$avilable)): ?>
                    <li>
                        <a href="<?php echo e(url('/admin/refund')); ?>"> <i class="menu-icon fa fa-paper-plane"></i><?php echo e(Helper::translation(3143,$translate)); ?> </a>
                    </li>
                    <?php endif; ?>
                    <?php if(in_array('rating',$avilable)): ?>
                    <li>
                        <a href="<?php echo e(url('/admin/rating')); ?>"> <i class="menu-icon fa fa-star"></i><?php echo e(Helper::translation(5622,$translate)); ?> </a>
                    </li>
                    <?php endif; ?>
                    <?php if(in_array('withdrawal',$avilable)): ?>
                    <li>
                        <a href="<?php echo e(url('/admin/withdrawal')); ?>"> <i class="menu-icon fa fa-money"></i><?php echo e(Helper::translation(5625,$translate)); ?> </a>
                    </li>
                    <?php endif; ?>
                    <?php if(in_array('blog',$avilable)): ?>
                    <?php if($allsettings->site_blog_display == 1): ?>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-comments-o"></i><?php echo e(Helper::translation(2877,$translate)); ?></a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-comments-o"></i><a href="<?php echo e(url('/admin/blog-category')); ?>"><?php echo e(Helper::translation(3084,$translate)); ?></a></li>
                            <li><i class="menu-icon fa fa-comments-o"></i><a href="<?php echo e(url('/admin/post')); ?>"><?php echo e(Helper::translation(5628,$translate)); ?></a></li>
                        </ul>
                    </li>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php if(in_array('pages',$avilable)): ?>
                    <li>
                        <a href="<?php echo e(url('/admin/pages')); ?>"> <i class="menu-icon fa fa-file-text-o"></i><?php echo e(Helper::translation(3029,$translate)); ?> </a>
                    </li>
                    <?php endif; ?>
                    <?php if(in_array('features',$avilable)): ?>
                    <?php if($allsettings->site_features_display == 1): ?>
                    <li>
                        <a href="<?php echo e(url('/admin/highlights')); ?>"> <i class="menu-icon fa fa-magic"></i><?php echo e(Helper::translation(5409,$translate)); ?> </a>
                    </li>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php if(in_array('selling',$avilable)): ?>
                    <?php if($allsettings->site_selling_display == 1): ?>
                    <li>
                        <a href="<?php echo e(url('/admin/start-selling')); ?>"> <i class="menu-icon fa fa-shopping-cart"></i><?php echo e(Helper::translation(3018,$translate)); ?> </a>
                    </li>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php if(in_array('contact',$avilable)): ?>
                    <li>
                        <a href="<?php echo e(url('/admin/contact')); ?>"> <i class="menu-icon fa fa-address-book-o"></i><?php echo e(Helper::translation(2910,$translate)); ?> </a>
                    </li>
                    <?php endif; ?>
                    <?php if(in_array('newsletter',$avilable)): ?>
                    <?php if($allsettings->site_newsletter_display == 1): ?>
                    <li>
                        <a href="<?php echo e(url('/admin/newsletter')); ?>"> <i class="menu-icon fa fa-newspaper-o"></i><?php echo e(Helper::translation(3005,$translate)); ?> </a>
                    </li>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php if(in_array('languages',$avilable)): ?>
                    <li>
                        <a href="<?php echo e(url('/admin/languages')); ?>"> <i class="menu-icon fa fa-language"></i><?php echo e(Helper::translation(5478,$translate)); ?> </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><?php /**PATH /var/www/html/resources/views/admin/navigation.blade.php ENDPATH**/ ?>