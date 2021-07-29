@if($allsettings->maintenance_mode == 0)
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>{{ Helper::translation(3207,$translate) }} - {{ $allsettings->site_title }}</title>
@include('meta')
@include('style')
</head>
<body>
@include('header')
@include('user-box')
<div class="container mb-5 pb-3">
      <div class="bg-light box-shadow-lg rounded-lg overflow-hidden">
        <div class="row">
          <!-- Sidebar-->
          @include('user-menu')
          <!-- Content-->
          <section class="col-lg-8 pt-lg-4 pb-md-4">
            <div class="pt-2 px-4 pl-lg-0 pr-xl-5">
            <h2 class="h3 pt-2 pb-4 mb-4 text-center text-sm-left border-bottom">{{ Helper::translation(3207,$translate) }}<span class="badge badge-secondary font-size-sm text-body align-middle ml-2">{{ $countreview }}</span></h2>
        <div class="row pt-2">
        <div class="col-lg-12 col-md-12 col-sm-12 px-2 mb-grid-gutter">
        @foreach($ratingview['list'] as $review)
        <div class="product-review pb-4 mb-4 border-bottom prod-item" data-aos="fade-up" data-aos-delay="200">
                <div class="d-flex mb-3">
                  <div class="media media-ie-fix align-items-center mr-4 pr-2">
                                    <a href="{{ url('/user') }}/{{ $review->username }}">
                                    @if($review->user_photo != '')
                                    <img class="rounded-circle" width="50" src="{{ url('/') }}/public/storage/users/{{ $review->user_photo }}" alt="{{ $review->username }}">
                                    @else
                                    <img src="{{ url('/') }}/public/img/no-user.png" alt="{{ $review->username }}" class="rounded-circle" width="50">
                                    @endif
                                    </a>
                      <div class="media-body pl-3">
                      <a href="{{ url('/user') }}/{{ $review->username }}">
                      <h6 class="font-size-sm mb-0">
                      {{ $review->username }} 
                      </h6>
                      </a>
                      <a href="{{ url('/item') }}/{{ $review->item_slug }}/{{ $review->item_id }}" class="theme-color">{{ $review->item_name }}</a><br/>
                      <span class="font-size-ms text-muted">{{ date('F d Y, h:i:s', strtotime($review->rating_date)) }}</span></div>
                  </div>
                  <div class="user-review" align="center">
                    <div class="star-rating" align="center">
                    @if($review->rating == 0)
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    @endif
                    @if($review->rating == 1)
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    @endif
                    @if($review->rating == 2)
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    @endif
                    @if($review->rating == 3)
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    @endif
                    @if($review->rating == 4)
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star"></i>
                    @endif
                    @if($review->rating == 5)
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    @endif
                    </div>
                    <div class="review_tag">{{ $review->rating_reason }}</div>
                  </div>
                </div>
                <p class="font-size-md mb-2">{{ $review->rating_comment }}</p>
              </div>
              @endforeach
              </div>
        </div>
        <div class="row mb-3">
       <div class="col-md-12  text-right">
            <div class="turn-page" id="itempager"></div>
       </div>         
       </div>
       </div>
        </section>
        </div>
      </div>
    </div>
@include('footer')
@include('script')
</body>
</html>
@else
@include('503')
@endif