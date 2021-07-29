<?php if($allsettings->maintenance_mode == 0): ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title><?php if($allsettings->site_blog_display == 1): ?> <?php echo e($edit['post']->post_title); ?> <?php else: ?> <?php echo e(Helper::translation(2860,$translate)); ?> <?php endif; ?> - <?php echo e($allsettings->site_title); ?></title>
<?php echo $__env->make('meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php if($allsettings->site_blog_display == 1): ?>
<section class="bg-position-center-top" style="background-image: url('<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_banner); ?>');">
      <div class="py-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-star">
              <li class="breadcrumb-item"><a class="text-nowrap" href="<?php echo e(URL::to('/')); ?>"><i class="dwg-home"></i><?php echo e(Helper::translation(2862,$translate)); ?></a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page"><?php echo e(Helper::translation(2877,$translate)); ?></li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 mb-0 text-white"><?php echo e($edit['post']->post_title); ?></h1>
        </div>
      </div>
      </div>
    </section>
    <div class="container pb-5">
      <div class="row pt-5 mt-md-2">
        <section class="col-lg-8">
          <!-- Post meta-->
          <div class="d-flex flex-wrap justify-content-between align-items-center pb-4 mt-n1" data-aos="fade-up" data-aos-delay="200">
            <div class="d-flex align-items-center font-size-sm mb-2"><span class="blog-entry-meta-link"><?php echo e(date('d M Y', strtotime($edit['post']->post_date))); ?></span><span class="blog-entry-meta-divider"></span><span class="blog-entry-meta-link"><i class="dwg-eye"></i><?php echo e($edit['post']->post_view); ?></span></div>
            <div class="font-size-sm mb-2"><a class="blog-entry-meta-link text-nowrap" href="#comments" data-scroll><i class="dwg-message"></i><?php echo e($count); ?></a></div>
          </div>
          <!-- Gallery-->
          <div class="cz-gallery row pb-2" data-aos="fade-up" data-aos-delay="200">
            <div class="col-sm-12">
            <?php if($edit['post']->post_image!=''): ?>
            <a class="gallery-item rounded-lg mb-grid-gutter" href="<?php echo e(url('/')); ?>/public/storage/post/<?php echo e($edit['post']->post_image); ?>" data-sub-html="<?php echo e($edit['post']->post_title); ?>"><img src="<?php echo e(url('/')); ?>/public/storage/post/<?php echo e($edit['post']->post_image); ?>" alt="<?php echo e($edit['post']->post_title); ?>"><span class="gallery-item-caption"><?php echo e($edit['post']->post_title); ?></span></a>
            <?php else: ?>
            <img src="<?php echo e(url('/')); ?>/public/img/no-image.png" alt="<?php echo e($edit['post']->post_title); ?>">
            <?php endif; ?>
            </div>
          </div>
          <!-- Post content-->
          <?php echo html_entity_decode($edit['post']->post_desc); ?>
          <!-- Post tags + sharing-->
          <div class="d-flex flex-wrap justify-content-between pt-2 pb-4 mb-1">
            <div class="mt-3"><span class="d-inline-block align-middle text-muted font-size-sm mr-3 mb-2"><?php echo e(__('Share post:')); ?></span>
            <a class="share-button social-btn sb-facebook mr-2 mb-2" data-share-url="<?php echo e(URL::to('/single')); ?>/<?php echo e($edit['post']->post_slug); ?>" data-share-network="facebook" data-share-text="<?php echo e($edit['post']->post_short_desc); ?>" data-share-title="<?php echo e($edit['post']->post_title); ?>" data-share-via="<?php echo e($allsettings->site_title); ?>" data-share-tags="" data-share-media="<?php echo e(url('/')); ?>/public/storage/post/<?php echo e($edit['post']->post_image); ?>" href="javascript:void(0)">
                                                        <i class="dwg-facebook"></i>
                                                    </a>
            <a class="share-button social-btn sb-twitter mr-2 mb-2" data-share-url="<?php echo e(URL::to('/single')); ?>/<?php echo e($edit['post']->post_slug); ?>" data-share-network="twitter" data-share-text="<?php echo e($edit['post']->post_short_desc); ?>" data-share-title="<?php echo e($edit['post']->post_title); ?>" data-share-via="<?php echo e($allsettings->site_title); ?>" data-share-tags="" data-share-media="<?php echo e(url('/')); ?>/public/storage/post/<?php echo e($edit['post']->post_image); ?>" href="javascript:void(0)">
                                                        <i class="dwg-twitter"></i>
                                                    </a>                                        
            <a class="share-button social-btn sb-pinterest mr-2 mb-2" data-share-url="<?php echo e(URL::to('/single')); ?>/<?php echo e($edit['post']->post_slug); ?>" data-share-network="googleplus" data-share-text="<?php echo e($edit['post']->post_short_desc); ?>" data-share-title="<?php echo e($edit['post']->post_title); ?>" data-share-via="<?php echo e($allsettings->site_title); ?>" data-share-tags="" data-share-media="<?php echo e(url('/')); ?>/public/storage/post/<?php echo e($edit['post']->post_image); ?>" href="javascript:void(0)">
                                                         <i class="dwg-google"></i>
                                                    </a>
            <a class="share-button social-btn sb-linkedin mr-2 mb-2" data-share-url="<?php echo e(URL::to('/single')); ?>/<?php echo e($edit['post']->post_slug); ?>" data-share-network="linkedin" data-share-text="<?php echo e($edit['post']->post_short_desc); ?>" data-share-title="<?php echo e($edit['post']->post_title); ?>" data-share-via="<?php echo e($allsettings->site_title); ?>" data-share-tags="" data-share-media="<?php echo e(url('/')); ?>/public/storage/post/<?php echo e($edit['post']->post_image); ?>" href="javascript:void(0)">
                                                        <i class="dwg-linkedin"></i>
                                                    </a>                                        
            </div>
          </div>
          <!-- Post navigation-->
          <nav class="entry-navigation" aria-label="Post navigation">
          <?php if(!empty($previous_count)): ?>
          <a class="entry-navigation-link" href="<?php echo e(URL::to('/single')); ?>/<?php echo e($previous->post_slug); ?>" data-toggle="popover" data-placement="top" data-trigger="hover" data-html="true" data-content="&lt;div class=&quot;media align-items-center&quot;&gt;&lt;img src=<?php echo e(url('/')); ?>/public/storage/post/<?php echo e($previous->post_image); ?> width=&quot;60&quot; class=&quot;mr-3&quot; alt=&quot;Post thumb&quot;&gt;&lt;div class=&quot;media-body&quot;&gt;&lt;h6  class=&quot;font-size-sm font-weight-semibold mb-0&quot;&gt;<?php echo e($previous->post_title); ?>&lt;/h6&gt;&lt;span class=&quot;d-block font-size-xs text-muted&quot;&gt;<?php echo e(date('d M Y', strtotime($previous->post_date))); ?>&lt;/span&gt;&lt;/div&gt;&lt;/div&gt;"><i class="dwg-arrow-left mr-2"></i><span class="d-none d-sm-inline"><?php echo e(__('Prev post')); ?></span></a>
          <?php endif; ?>
          <a class="entry-navigation-link" href="<?php echo e(URL::to('/blog')); ?>"><i class="dwg-view-list mr-2"></i><span class="d-none d-sm-inline"><?php echo e(__('All posts')); ?></span></a>
          <?php if(!empty($next_count)): ?>
          <a class="entry-navigation-link" href="<?php echo e(URL::to('/single')); ?>/<?php echo e($next->post_slug); ?>" data-toggle="popover" data-placement="top" data-trigger="hover" data-html="true" data-content="&lt;div class=&quot;media align-items-center&quot;&gt;&lt;img src=<?php echo e(url('/')); ?>/public/storage/post/<?php echo e($next->post_image); ?> width=&quot;60&quot; class=&quot;mr-3&quot; alt=&quot;Post thumb&quot;&gt;&lt;div class=&quot;media-body&quot;&gt;&lt;h6  class=&quot;font-size-sm font-weight-semibold mb-0&quot;&gt;<?php echo e($next->post_title); ?>&lt;/h6&gt;&lt;span class=&quot;d-block font-size-xs text-muted&quot;&gt;<?php echo e(date('d M Y', strtotime($next->post_date))); ?>&lt;/span&gt;&lt;/div&gt;&lt;/div&gt;"><span class="d-none d-sm-inline"><?php echo e(__('Next post')); ?></span><i class="dwg-arrow-right ml-2"></i></a>
          <?php endif; ?>
          </nav>
          <!-- Comments-->
          <?php if(Auth::guest()): ?>
          <div class="pt-2 mt-5" id="comments">
          <h5><?php echo e(__('You must be')); ?> <a href="<?php echo e(URL::to('/login')); ?>"><?php echo e(__('logged')); ?></a> <?php echo e(__('in to post a comment')); ?></h5>
          </div>
          <?php endif; ?>
          <?php if(Auth::check()): ?>
          <div class="pt-2 mt-5" id="comments">
            <h2 class="h4"><?php echo e(Helper::translation(3054,$translate)); ?><span class="badge badge-secondary font-size-sm text-body align-middle ml-2"><?php echo e($count); ?></span></h2>
            <!-- comment-->
            <?php if($count != 0): ?>
            <?php $no = 1; ?>
            <?php $__currentLoopData = $comment['display']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="media py-4">
            <?php if($comment->user_photo != ''): ?>
            <img class="rounded-circle" width="50" src="<?php echo e(url('/')); ?>/public/storage/users/<?php echo e($comment->user_photo); ?>" alt="<?php echo e($comment->name); ?>"/>
            <?php else: ?>
            <img class="rounded-circle" width="50" src="<?php echo e(url('/')); ?>/public/img/no-user.png" alt="<?php echo e($comment->name); ?>"/>
            <?php endif; ?>
              <div class="media-body pl-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <h6 class="font-size-md mb-0"><?php echo e($comment->name); ?></h6>
                </div>
                <p class="font-size-md mb-1"><?php echo e($comment->comment_content); ?></p><span class="font-size-ms text-muted"><i class="dwg-time align-middle mr-2"></i><?php echo e(date('d M Y', strtotime($comment->comment_date))); ?></span>
              </div>
            </div>
            <?php $no++; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <!-- Post comment form-->
            <div class="card border-0 box-shadow my-2">
              <div class="card-body">
                <div class="media">
                <?php if(Auth::user()->user_photo != ''): ?>
                <img class="rounded-circle" width="50" src="<?php echo e(url('/')); ?>/public/storage/users/<?php echo e(Auth::user()->user_photo); ?>" alt="<?php echo e(Auth::user()->name); ?>"/>
                <?php else: ?>
                <img class="rounded-circle" width="50" src="<?php echo e(url('/')); ?>/public/img/no-user.png" alt="<?php echo e(Auth::user()->name); ?>"/>
                <?php endif; ?>
                  <form class="media-body needs-validation ml-3" action="<?php echo e(route('single')); ?>" method="post" novalidate>
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>">
                                <input type="hidden" name="post_id" value="<?php echo e($edit['post']->post_id); ?>">
                    <div class="form-group">
                      <textarea class="form-control" rows="4" placeholder="<?php echo e(Helper::translation(3186,$translate)); ?>" name="comment_content" required></textarea>
                      <div class="invalid-feedback"><?php echo e(__('Please write your comment.')); ?></div>
                    </div>
                    <button class="btn btn-primary btn-sm" type="submit"><?php echo e(Helper::translation(3064,$translate)); ?></button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <?php endif; ?>
        </section>
        <aside class="col-lg-4">
          <!-- Sidebar-->
          <div class="cz-sidebar border-left ml-lg-auto" id="blog-sidebar">
            <div class="cz-sidebar-header box-shadow-sm">
              <button class="close ml-auto" type="button" data-dismiss="sidebar" aria-label="Close"><span class="d-inline-block font-size-xs font-weight-normal align-middle"><?php echo e(__('Close sidebar')); ?></span><span class="d-inline-block align-middle ml-2" aria-hidden="true">&times;</span></button>
            </div>
            <div class="cz-sidebar-body py-lg-1" data-simplebar data-simplebar-auto-hide="true">
              <!-- Categories-->
              <div class="widget widget-links mb-grid-gutter pb-grid-gutter border-bottom">
                <h3 class="widget-title"><?php echo e(Helper::translation(2879,$translate)); ?></h3>
                <ul class="widget-list">
                  <?php $__currentLoopData = $catData['post']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li class="widget-list-item"><a class="widget-list-link d-flex justify-content-between align-items-center" href="<?php echo e(URL::to('/blog')); ?>/category/<?php echo e($post->blog_cat_id); ?>/<?php echo e($post->blog_category_slug); ?>"><span><?php echo e($post->blog_category_name); ?></span><span class="font-size-xs text-muted ml-3"><?php echo e($category_count->has($post->blog_cat_id) ? count($category_count[$post->blog_cat_id]) : 0); ?></span></a></li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              </div>
              <!-- Trending posts-->
              <div class="widget mb-grid-gutter pb-grid-gutter border-bottom">
                <h3 class="widget-title"><?php echo e(Helper::translation(2881,$translate)); ?></h3>
                <?php $__currentLoopData = $blogPost['latest']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="media align-items-center mb-3">
                <a href="<?php echo e(URL::to('/single')); ?>/<?php echo e($post->post_slug); ?>" title="<?php echo e($post->post_title); ?>">
                   <?php if($post->post_image!=''): ?>
                   <img class="rounded" src="<?php echo e(url('/')); ?>/public/storage/post/<?php echo e($post->post_image); ?>" width="64" alt="<?php echo e($post->post_title); ?>">
                   <?php else: ?>
                   <img src="<?php echo e(url('/')); ?>/public/img/no-image.png" alt="<?php echo e($post->post_title); ?>" width="64">
                   <?php endif; ?>
                </a>
                <div class="media-body pl-3">
                    <h6 class="blog-entry-title font-size-sm mb-0"><a href="<?php echo e(URL::to('/single')); ?>/<?php echo e($post->post_slug); ?>"><?php echo e($post->post_title); ?></a></h6><span class="font-size-ms text-muted"><span class='blog-entry-meta-link'><i class="dwg-time"></i><?php echo e(date('d M Y', strtotime($post->post_date))); ?></span></span>
                  </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
               </div>
              <!-- Popular tags-->
              <div class="widget mb-grid-gutter">
                <h3 class="widget-title"><?php echo e(Helper::translation(2974,$translate)); ?></h3>
                <?php $__currentLoopData = $post_tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tags): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a class="btn-tag mr-2 mb-2" href="<?php echo e(url('/blog')); ?>/<?php echo e(strtolower(str_replace(' ','-',$tags))); ?>"><?php echo e($tags); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
              <!-- Promo banner-->
            </div>
          </div>
        </aside>
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
<?php endif; ?><?php /**PATH D:\xampp\htdocs\fickrr\resources\views/single.blade.php ENDPATH**/ ?>