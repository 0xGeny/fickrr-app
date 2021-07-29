@if($allsettings->maintenance_mode == 0)
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>{{ Helper::translation(3016,$translate) }} - {{ $allsettings->site_title }}</title>
@include('meta')
@include('style')
</head>
<body>
@include('header')
<section class="bg-position-center-top" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_banner }}');">
      <div class="container d-flex flex-column">
        <div class="row mt-auto">
        <div class="col-lg-8 col-sm-12 text-center mx-auto">
        <h2 class="mb-4 pt-5 title-page text-white">{{ Helper::translation(3016,$translate) }}</h2>
        <h3 class="lead mb-5 text-white">{{ Helper::translation(3017,$translate) }}</h3>
    </div>
</div>
<div class="row">
    <div class="col-lg-7 col-md-7 col-sm-12 mx-auto text-center mb-3 pb-3">
        <div class="countdown-timer">
                        <ul id="example">
                                <li class="pt-2 pb-1 mb-2"><span class="days">00</span><div>{{ Helper::translation(2995,$translate) }}</div></li>
                                <li class="pt-2 pb-1 mb-2"><span class="hours">00</span><div>{{ Helper::translation(2996,$translate) }}</div></li>
                                <li class="pt-2 pb-1 mb-2"><span class="minutes">00</span><div>{{ Helper::translation(2997,$translate) }}</div></li>
		                        <li class="pt-2 pb-1 mb-2"><span class="seconds">00</span><div>{{ Helper::translation(2998,$translate) }}</div></li>
                           </ul>
               </div>
        </div>
    </div> 
</div>
</section>
<div class="container py-5 mt-md-2 mb-2 flash-sale">
      <div class="row pt-2 mx-n2">
        <!-- Product-->
        @php $no = 1; @endphp
        @foreach($free['items'] as $featured)
        @php
        $price = Helper::price_info($featured->item_flash,$featured->regular_price);
        $count_rating = Helper::count_rating($featured->ratings);
        @endphp
        <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-grid-gutter prod-item" data-aos="fade-up" data-aos-delay="200">
          <!-- Product-->
          <div class="card product-card-alt">
            <div class="product-thumb">
              @if(Auth::guest()) 
              <a class="btn-wishlist btn-sm" href="{{ url('/') }}/login"><i class="dwg-heart"></i></a>
              @endif
              @if (Auth::check())
              @if($featured->user_id != Auth::user()->id)
              <a class="btn-wishlist btn-sm" href="{{ url('/item') }}/{{ base64_encode($featured->item_id) }}/favorite/{{ base64_encode($featured->item_liked) }}"><i class="dwg-heart"></i></a>
              @endif
              @endif
              <div class="product-card-actions"><a class="btn btn-light btn-icon btn-shadow font-size-base mx-2" href="{{ URL::to('/item') }}/{{ $featured->item_slug }}"><i class="dwg-eye"></i></a>
                <a class="btn btn-light btn-icon btn-shadow font-size-base mx-2" href="{{ URL::to('/item') }}/{{ $featured->item_slug }}"><i class="dwg-cart"></i></a>
              </div><a class="product-thumb-overlay" href="{{ URL::to('/item') }}/{{ $featured->item_slug }}"></a>
                            @if($featured->item_preview!='')
                            <img src="{{ url('/') }}/public/storage/items/{{ $featured->item_preview }}" alt="{{ $featured->item_name }}">
                            @else
                            <img src="{{ url('/') }}/public/img/no-image.png" alt="{{ $featured->item_name }}">
                            @endif
                          </div>
            <div class="card-body">
              <div class="d-flex flex-wrap justify-content-between align-items-start pb-2">
                <div class="text-muted font-size-xs mr-1"><a class="product-meta font-weight-medium" href="{{ URL::to('/shop') }}/item-type/{{ $featured->item_type }}">{{ str_replace('-',' ',$featured->item_type) }}</a></div>
                <div class="star-rating">
                    @if($count_rating == 0)
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    @endif
                    @if($count_rating == 1)
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    @endif
                    @if($count_rating == 2)
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    @endif
                    @if($count_rating == 3)
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    @endif
                    @if($count_rating == 4)
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star"></i>
                    @endif
                    @if($count_rating == 5)
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    @endif
                </div>
               </div>
              <h3 class="product-title font-size-sm mb-2"><a href="{{ URL::to('/item') }}/{{ $featured->item_slug }}">{{ substr($featured->item_name,0,20).'...' }}</a></h3>
              <div class="card-footer d-flex align-items-center font-size-xs">
              <a class="blog-entry-meta-link" href="{{ URL::to('/user') }}/{{ $featured->username }}">
                    <div class="blog-entry-author-ava">
                    @if($featured->user_photo!='')
                    <img src="{{ url('/') }}/public/storage/users/{{ $featured->user_photo }}" alt="{{ $featured->username }}">
                    @else
                    <img src="{{ url('/') }}/public/img/no-user.png" alt="{{ $featured->username }}">
                    @endif
                    </div>{{ $featured->username }} @if($addition_settings->subscription_mode == 1) @if($featured->user_document_verified == 1) <span class="badges-success"><i class="dwg-check-circle danger"></i> {{ Helper::translation(5202,$translate) }}</span>@endif @endif</a>
                  <div class="ml-auto text-nowrap"><i class="dwg-time"></i> {{ date('d M Y',strtotime($featured->updated_item)) }}</div>
                </div>
              <div class="d-flex flex-wrap justify-content-between align-items-center">
                <div class="font-size-sm mr-2"><i class="dwg-download text-muted mr-1"></i>{{ $featured->item_sold }}<span class="font-size-xs ml-1">{{ Helper::translation(2930,$translate) }}</span>
                </div>
                <div>@if($featured->item_flash == 1)<del class="price-old">{{ $allsettings->site_currency_symbol }}{{ $price }}</del> @else <del class="price-old">{{ $allsettings->site_currency_symbol }}{{ $featured->regular_price }}</del> @endif <span class="price-badge rounded-sm py-1 px-2">{{ Helper::translation(2992,$translate) }}</span></div>
              </div>
            </div>
          </div>
        </div>
        <!-- Product-->
        @php $no++; @endphp
	    @endforeach
       </div>
       <div class="row mb-3">
       <div class="col-md-12  text-right">
            <div class="turn-page" id="itempager"></div>
       </div>         
       </div>
    </div>
@include('footer')
@include('script')
@if(!empty($allsettings->site_free_end_date))
	<script type="text/javascript">
            $('#example').countdown({
                date: '{{ date("m/d/Y H:i:s", strtotime($allsettings->site_free_end_date)) }}',
                offset: -8,
                day: '{{ Helper::translation(5967,$translate) }}',
                days: '{{ Helper::translation(2995,$translate) }}'
            }, function () {
              'use strict';
            });
    </script>
    @endif
</body>
</html>
@else
@include('503')
@endif