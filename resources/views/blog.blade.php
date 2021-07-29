@if($allsettings->maintenance_mode == 0)
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>@if($allsettings->site_blog_display == 1) {{ $slug }} @else {{ Helper::translation(2860,$translate) }} @endif - {{ $allsettings->site_title }}</title>
@include('meta')
@include('style')
</head>
<body>
@include('header')
@if($allsettings->site_blog_display == 1)
<section class="bg-position-center-top" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_banner }}');">
      <div class="py-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-star">
              <li class="breadcrumb-item"><a class="text-nowrap" href="{{ URL::to('/') }}"><i class="dwg-home"></i>{{ Helper::translation(2862,$translate) }}</a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page">{{ $slug }}</li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 mb-0 text-white">{{ Helper::translation(2877,$translate) }}</h1>
        </div>
      </div>
      </div>
    </section>
<div class="container pb-5 mb-2 mb-md-4">
      <div class="row pt-5 mt-2">
        <!-- Entries list-->
        <section class="col-lg-8">
          <!-- Entry-->
          @foreach($blogData['post'] as $post)
          <article class="blog-list border-bottom pb-4 mb-5 li-item" data-aos="fade-up" data-aos-delay="200">
            <div class="left-column">
              <div class="d-flex align-items-center font-size-sm pb-2 mb-1">
                 <div class="blog-entry-meta-link">
                  <i class="dwg-time"></i>{{ date('d M Y', strtotime($post->post_date)) }}
                  </div>
                  <span class="blog-entry-meta-divider"></span>
                  <span class="blog-entry-meta-link text-nowrap"><i class="dwg-message"></i>{{ $comments->has($post->post_id) ? count($comments[$post->post_id]) : 0 }}</span>
                  <span class="blog-entry-meta-divider"></span>
                  <span class="blog-entry-meta-link text-nowrap"><i class="dwg-eye"></i>{{ $post->post_view }}</span>
                  </div>
              <h2 class="h5 blog-entry-title"><a href="{{ URL::to('/single') }}/{{ $post->post_slug }}">{{ $post->post_title }}</a></h2>
            </div>
            <div class="right-column cz-gallery">
              <a class="blog-entry-thumb mb-3 gallery-item rounded-lg mb-grid-gutter" href="{{ url('/') }}/public/storage/post/{{ $post->post_image }}" data-sub-html="{{ $post->post_title }}">
              @if($post->post_image!='')
              <img src="{{ url('/') }}/public/storage/post/{{ $post->post_image }}" alt="{{ $post->post_title }}">
              @else
              <img src="{{ url('/') }}/public/img/no-image.png" alt="{{ $post->post_title }}">
              @endif
              <span class="gallery-item-caption">{{ $post->post_title }}</span>
              </a>
              <div class="d-flex justify-content-between mb-1">
                <div class="font-size-sm text-muted pr-2 mb-2">
                <a href="{{ URL::to('/blog') }}/category/{{ $post->blog_cat_id }}/{{ $post->blog_category_slug }}" class="blog-entry-meta-link">
                <i class="dwg-menu-circle"></i>{{ $post->blog_category_name }}</a></div>
              </div>
              <p class="font-size-sm">{{ substr($post->post_short_desc,0,300).'...' }}</p>
            </div>
          </article>
          @endforeach
          <div class="text-right">
            <div class="turn-page" id="post-pager"></div>
          </div>
        </section>
        <aside class="col-lg-4">
          <!-- Sidebar-->
          <div class="cz-sidebar border-left ml-lg-auto" id="blog-sidebar">
             <div class="cz-sidebar-body py-lg-1" data-simplebar data-simplebar-auto-hide="true">
              <!-- Categories-->
              <div class="widget widget-links mb-grid-gutter pb-grid-gutter border-bottom">
                <h3 class="widget-title">{{ Helper::translation(2879,$translate) }}</h3>
                <ul class="widget-list">
                  @foreach($catData['post'] as $post)
                  <li class="widget-list-item">
                  <a class="widget-list-link d-flex justify-content-between align-items-center" href="{{ URL::to('/blog') }}/category/{{ $post->blog_cat_id }}/{{ $post->blog_category_slug }}"><span>{{ $post->blog_category_name }}</span><span class="font-size-xs text-muted ml-3">{{ $category_count->has($post->blog_cat_id) ? count($category_count[$post->blog_cat_id]) : 0 }}</span></a></li>
                  @endforeach
                </ul>
              </div>
              <!-- Trending posts-->
              <div class="widget mb-grid-gutter pb-grid-gutter border-bottom">
                <h3 class="widget-title">{{ Helper::translation(2881,$translate) }}</h3>
                @foreach($blogPost['latest'] as $post)
                <div class="media align-items-center mb-3">
                <a href="{{ URL::to('/single') }}/{{ $post->post_slug }}" title="{{ $post->post_title }}">
                   @if($post->post_image!='')
                   <img class="rounded" src="{{ url('/') }}/public/storage/post/{{ $post->post_image }}" width="64" alt="{{ $post->post_title }}">
                   @else
                   <img src="{{ url('/') }}/public/img/no-image.png" alt="{{ $post->post_title }}" width="64">
                   @endif
                </a>
                <div class="media-body pl-3">
                    <h6 class="blog-entry-title font-size-sm mb-0"><a href="{{ URL::to('/single') }}/{{ $post->post_slug }}">{{ $post->post_title }}</a></h6><span class="font-size-ms text-muted"><span class='blog-entry-meta-link'><i class="dwg-time"></i>{{ date('d M Y', strtotime($post->post_date)) }}</span></span>
                  </div>
                </div>
                @endforeach 
               </div>
            </div>
          </div>
        </aside>
      </div>
    </div>
@else
@include('not-found')
@endif
@include('footer')
@include('script')
</body>
</html>
@else
@include('503')
@endif