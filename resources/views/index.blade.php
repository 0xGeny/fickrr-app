@if($allsettings->maintenance_mode == 0)
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>{{ Helper::translation(2862,$translate) }} - {{ $allsettings->site_title }}</title>
@include('meta')
@include('style')
</head>
<body>
@include('header')
	<!-- <section class="bg-position-center-top" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_banner }}');">
				<div class="mb-lg-3 pb-4 pt-5">
					<div class="container">
						<div class="row mb-4 mb-sm-5">
							<div class="col-lg-7 col-md-9 text-center mx-auto">
								<h1 class="text-white line-height-base">{{ $allsettings->site_banner_heading }}</h1>
								<h2 class="h4 text-white font-weight-light">{{ $allsettings->site_banner_subheading }}</h2>
							</div>
						</div>
						<form action="{{ route('shop') }}" id="search_form" method="post" class="form-noborder searchbox" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="row mb-4 mb-sm-5">
							<div class="col-lg-6 col-md-8 mx-auto text-center">
								<div class="input-group input-group-overlay input-group-lg">
									<div class="input-group-prepend-overlay"><span class="input-group-text"><i class="dwg-search"></i></span></div>
									<input class="form-control form-control-lg prepended-form-control rounded-right-0" type="text" id="product_item" name="product_item" placeholder="{{ Helper::translation(3030,$translate) }}"><div class="input-group-append">
										<button class="btn btn-primary btn-lg font-size-base" type="submit">{{ Helper::translation(3031,$translate) }}</button>
									</div>
								</div>
							</div>
						</div>
						</form>
					</div>
				</div>
			</section> -->



@if(count($featured['items']) != 0)
<section class="container mb-lg-1" data-aos="fade-up" data-aos-delay="200">
      <!-- Heading-->
      <div class="d-flex flex-wrap justify-content-between align-items-center pt-1 border-bottom pb-4 mb-4">
        <h2 class="h3 mb-0 pt-3 mr-2" data-aos="fade-down" data-aos-delay="100">{{ Helper::translation(3027,$translate) }}</h2>
        <div class="pt-3" data-aos="fade-down" data-aos-delay="100">
          <a class="btn btn-outline-accent" href="{{ URL::to('/') }}/featured-items">{{ Helper::translation(4839,$translate) }}<i class="dwg-arrow-right font-size-ms ml-1"></i></a>
        </div>
      </div>
      <!-- Grid-->
      <div class="row pt-2 mx-n2">
        <!-- Product-->
        @php $no = 1; @endphp
        @foreach($featured['items'] as $featured)
        @php
        $price = Helper::price_info($featured->item_flash,$featured->regular_price);
        $count_rating = Helper::count_rating($featured->ratings);
        @endphp
        <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-grid-gutter">
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
                <div>@if($featured->item_flash == 1)<del class="price-old">{{ $allsettings->site_currency_symbol }}{{ $featured->regular_price }}</del>@endif <span class="bg-faded-accent text-accent rounded-sm py-1 px-2">{{ $allsettings->site_currency_symbol }}{{ $price }}</span></div>
              </div>
            </div>
          </div>
        </div>
        <!-- Product-->
        @php $no++; @endphp
	    @endforeach
       </div>
    </section>
    @endif
    @if(count($popular['items']) != 0)
<section class="container mb-lg-1" data-aos="fade-up" data-aos-delay="200" style="display:none;">
      <!-- Heading-->
      <div class="d-flex flex-wrap justify-content-between align-items-center pt-1 border-bottom pb-4 mb-4">
        <h2 class="h3 mb-0 pt-3 mr-2" data-aos="fade-down" data-aos-delay="100">{{ Helper::translation(3181,$translate) }}</h2>
        <div class="pt-3" data-aos="fade-down" data-aos-delay="100">
          <a class="btn btn-outline-accent" href="{{ URL::to('/') }}/popular-items">{{ Helper::translation(4839,$translate) }}<i class="dwg-arrow-right font-size-ms ml-1"></i></a>
        </div>
      </div>
      <!-- Grid-->
      <div class="row pt-2 mx-n2">
        <!-- Product-->
        @php $no = 1; @endphp
        @foreach($popular['items'] as $featured)
        @php
        $price = Helper::price_info($featured->item_flash,$featured->regular_price);
        $count_rating = Helper::count_rating($featured->ratings);
        @endphp
        <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-grid-gutter">
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
                <div>@if($featured->item_flash == 1)<del class="price-old">{{ $allsettings->site_currency_symbol }}{{ $featured->regular_price }}</del>@endif <span class="bg-faded-accent text-accent rounded-sm py-1 px-2">{{ $allsettings->site_currency_symbol }}{{ $price }}</span></div>
              </div>
            </div>
          </div>
        </div>
        <!-- Product-->
        @php $no++; @endphp
	    @endforeach
       </div>
    </section>
    @endif
    @if(count($flash['items']) != 0)
<section class="container mb-lg-1 flash-sale" data-aos="fade-up" data-aos-delay="200" style="display:none;">
      <!-- Heading-->
      <div class="d-flex flex-wrap justify-content-between align-items-center pt-1 border-bottom pb-4 mb-4">
        <h2 class="h3 mb-0 pt-3 mr-2" data-aos="fade-down" data-aos-delay="100">{{ Helper::translation(2993,$translate) }}</h2>
        <div class="pt-3" data-aos="fade-down" data-aos-delay="100">
          <a class="btn btn-outline-accent" href="{{ URL::to('/') }}/flash-sale">{{ Helper::translation(4839,$translate) }}<i class="dwg-arrow-right font-size-ms ml-1"></i></a>
        </div>
      </div>
      <!-- Grid-->
      <div class="row pt-2 mx-n2">
        <!-- Product-->
        @php $no = 1; @endphp
        @foreach($flash['items'] as $featured)
        @php
        $price = Helper::price_info($featured->item_flash,$featured->regular_price);
        $count_rating = Helper::count_rating($featured->ratings);
        @endphp
        <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-grid-gutter">
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
                <div>@if($featured->item_flash == 1)<del class="price-old">{{ $allsettings->site_currency_symbol }}{{ $featured->regular_price }}</del>@endif <span class="price-badge rounded-sm py-1 px-2">{{ $allsettings->site_currency_symbol }}{{ $price }}</span></div>
              </div>
            </div>
          </div>
        </div>
        <!-- Product-->
        @php $no++; @endphp
	    @endforeach
       </div>
    </section>
    @endif
    @if(count($free['items']) != 0)
<section class="container mb-lg-1 flash-sale" data-aos="fade-up" data-aos-delay="200" style="display:none;">
      <!-- Heading-->
      <div class="d-flex flex-wrap justify-content-between align-items-center pt-1 border-bottom pb-4 mb-4">
        <h2 class="h3 mb-0 pt-3 mr-2" data-aos="fade-down" data-aos-delay="100">{{ Helper::translation(3016,$translate) }}</h2>
        <div class="pt-3" data-aos="fade-down" data-aos-delay="100">
          <a class="btn btn-outline-accent" href="{{ URL::to('/') }}/free-items">{{ Helper::translation(4839,$translate) }}<i class="dwg-arrow-right font-size-ms ml-1"></i></a>
        </div>
      </div>
      <!-- Grid-->
      <div class="row pt-2 mx-n2">
        <!-- Product-->
        @php $no = 1; @endphp
        @foreach($free['items'] as $featured)
        @php
        $price = Helper::price_info($featured->item_flash,$featured->regular_price);
        $count_rating = Helper::count_rating($featured->ratings);
        @endphp
        <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-grid-gutter">
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
    </section>
    @endif
    @if(count($newest['items']) != 0)
    <section class="container pb-4 pb-md-5" data-aos="fade-up" data-aos-delay="200" style="display:none;">
      <div class="d-flex flex-wrap justify-content-between align-items-center pt-1 border-bottom pb-4 mb-4">
        <h2 class="h3 mb-0 pt-3 mr-2" data-aos="fade-down" data-aos-delay="100">{{ Helper::translation(4842,$translate) }}</h2>
        <div class="pt-3" data-aos="fade-down" data-aos-delay="100">
          <a class="btn btn-outline-accent" href="{{ URL::to('/new-releases') }}">{{ Helper::translation(4839,$translate) }}<i class="dwg-arrow-right font-size-ms ml-1"></i></a>
        </div>
      </div>
      <div class="row">
        <!-- Bestsellers-->
            @php $no = 1; @endphp
            @foreach($newest['items'] as $featured)
            @php
            $price = Helper::price_info($featured->item_flash,$featured->regular_price);
        $count_rating = Helper::count_rating($featured->ratings);
            @endphp
          <div class="col-lg-4 col-md-6 mb-2 py-3">
           <div class="widget">    
            <div class="media align-items-center pb-2 border-bottom">
            <a class="d-block mr-2" href="{{ URL::to('/item') }}/{{ $featured->item_slug }}">
            @if($featured->item_preview!='')
            <img width="64" src="{{ url('/') }}/public/storage/items/{{ $featured->item_preview }}" alt="{{ $featured->item_name }}">
            @else
            <img width="64" src="{{ url('/') }}/public/img/no-image.png" alt="{{ $featured->item_name }}">
            @endif
            </a>
              <div class="media-body">
                <h6 class="widget-product-title"><a href="{{ URL::to('/item') }}/{{ $featured->item_slug }}">{{ $featured->item_name }}</a></h6>
                <div class="widget-product-meta"><span class="text-accent">{{ $allsettings->site_currency_symbol }}{{ $price }}</span> @if($featured->item_flash == 1)<del class="price-old">{{ $allsettings->site_currency_symbol }}{{ $featured->regular_price }}</del>@endif</div>
              </div>
            </div>
           </div>
        </div>
            @php $no++; @endphp
            @endforeach
       </div>
    </section>
    @endif
    @if($allsettings->site_features_display == 'for hide')  // $allsettings->site_features_display == 1
    <section class="bg-size-cover bg-position-center pt-5 pb-4 pb-lg-5 feature-panel" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_banner }}');" style="display:none;">
      <div class="container pt-lg-3" data-aos="fade-up" data-aos-delay="200">
        <h2 class="h3 mb-3 pb-4 text-light text-center">{{ Helper::translation(3047,$translate) }} {{ $allsettings->site_title }}?</h2>
        <div class="row pt-lg-2 text-center">
          <div class="col-lg-3 col-sm-6 mb-grid-gutter" data-aos="fade-left" data-aos-delay="200">
            <div class="d-inline-block">
              <div class="media media-ie-fix align-items-center text-left"><span class="{{ $allsettings->site_icon1 }}"></span>
                <div class="media-body pl-3">
                  <h6 class="text-light font-size-base mb-1">{{ $allsettings->site_text1 }}</h6>
                  <p class="text-light font-size-ms opacity-70 mb-0">{{ $allsettings->site_sub_text1 }}</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 mb-grid-gutter" data-aos="fade-left" data-aos-delay="200">
            <div class="d-inline-block">
              <div class="media media-ie-fix align-items-center text-left"><span class="{{ $allsettings->site_icon2 }}"></span>
                <div class="media-body pl-3">
                  <h6 class="text-light font-size-base mb-1">{{ $allsettings->site_text2 }}</h6>
                  <p class="text-light font-size-ms opacity-70 mb-0">{{ $allsettings->site_sub_text2 }}</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 mb-grid-gutter" data-aos="fade-right" data-aos-delay="200">
            <div class="d-inline-block">
              <div class="media media-ie-fix align-items-center text-left"><span class="{{ $allsettings->site_icon3 }}"></span>
                <div class="media-body pl-3">
                  <h6 class="text-light font-size-base mb-1">{{ $allsettings->site_text3 }}</h6>
                  <p class="text-light font-size-ms opacity-70 mb-0">{{ $allsettings->site_sub_text3 }}</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 mb-grid-gutter" data-aos="fade-right" data-aos-delay="200">
            <div class="d-inline-block">
              <div class="media media-ie-fix align-items-center text-left"><span class="{{ $allsettings->site_icon4 }}"></span>
                <div class="media-body pl-3">
                  <h6 class="text-light font-size-base mb-1">{{ $allsettings->site_text4 }}</h6>
                  <p class="text-light font-size-ms opacity-70 mb-0">{{ $allsettings->site_sub_text4 }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    @endif
    @if(count($blog['data']) != 0)
    <section class="container pb-4 pb-md-5 homeblog" data-aos="fade-up" data-aos-delay="200" style="display:none;">
      <div class="d-flex flex-wrap justify-content-between align-items-center pt-1 border-bottom pb-4 mb-4">
        <h2 class="h3 mb-0 pt-3 mr-2" data-aos="fade-down" data-aos-delay="100">{{ Helper::translation(4845,$translate) }}</h2>
        <div class="pt-3" data-aos="fade-down" data-aos-delay="100">
          <a class="btn btn-outline-accent" href="{{ URL::to('/blog') }}">{{ Helper::translation(4848,$translate) }}<i class="dwg-arrow-right font-size-ms ml-1"></i></a>
        </div>
      </div>
        <div class="row">
          @php $no = 1; @endphp
          @foreach($blog['data'] as $post)
            <div class="col-lg-4 col-md-6 mb-2 py-3">
              <div class="card">
              <a class="blog-entry-thumb" href="{{ URL::to('/single') }}/{{ $post->post_slug }}" title="{{ $post->post_title }}">
              @if($post->post_image!='')
              <img class="card-img-top" src="{{ url('/') }}/public/storage/post/{{ $post->post_image }}" alt="{{ $post->post_title }}">
              @else
              <img class="card-img-top" src="{{ url('/') }}/public/img/no-image.png" alt="{{ $post->post_title }}">
              @endif
              </a>
                <div class="card-body">
                  <h2 class="h6 blog-entry-title"><a href="{{ URL::to('/single') }}/{{ $post->post_slug }}">{{ $post->post_title }}</a></h2>
                  <p class="font-size-sm">{{ substr($post->post_short_desc,0,80).'...' }}</p>
                  <div class="font-size-xs text-nowrap"><span class="blog-entry-meta-link text-nowrap">{{ date('d M Y', strtotime($post->post_date)) }}</span><span class="blog-entry-meta-divider mx-2"></span><span class="blog-entry-meta-link text-nowrap"><i class="dwg-message"></i>{{ $comments->has($post->post_id) ? count($comments[$post->post_id]) : 0 }}</span></div>
                </div>
              </div>
            </div>
            @php $no++; @endphp
            @endforeach
         </div>
        <!-- More button-->
     </section>
     @endif    
@include('footer')
@include('script')
</body>
</html>
@else
@include('503')
@endif