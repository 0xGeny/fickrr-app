@if($allsettings->maintenance_mode == 0)
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>{{ Helper::translation(3178,$translate) }} - {{ $allsettings->site_title }}</title>
@include('meta')
@include('style')
</head>
<body>
@include('header')
<section class="bg-position-center-top" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_banner }}');">
      <div class="py-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-star">
              <li class="breadcrumb-item"><a class="text-nowrap" href="{{ URL::to('/') }}"><i class="dwg-home"></i>{{ Helper::translation(2862,$translate) }}</a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page">{{ Helper::translation(3178,$translate) }}</li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 mb-0 text-white">{{ Helper::translation(3178,$translate) }}</h1>
        </div>
      </div>
      </div>
    </section>
<div class="container py-5 mt-md-2 mb-2">
      <div class="row pt-3 mx-n2">
         <aside class="col-lg-4">
          <!-- Sidebar-->
          <form action="{{ route('shop') }}" id="search_form2" method="post"  enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="cz-sidebar rounded-lg box-shadow-lg" id="shop-sidebar">
            <div class="cz-sidebar-header box-shadow-sm">
              <button class="close ml-auto" type="button" data-dismiss="sidebar" aria-label="Close"><span class="d-inline-block font-size-xs font-weight-normal align-middle">{{ Helper::translation(6069,$translate) }}</span><span class="d-inline-block align-middle ml-2" aria-hidden="true">&times;</span></button>
            </div>
            <div class="cz-sidebar-body" data-simplebar data-simplebar-auto-hide="true">
              
              <!-- Filter by Brand-->
              <div class="widget cz-filter mb-4 pb-4 border-bottom">
                <h3 class="widget-title">{{ Helper::translation(2937,$translate) }}</h3>
                <div class="input-group-overlay input-group-sm mb-2">
                  <input class="cz-filter-search form-control form-control-sm appended-form-control" type="text" placeholder="{{ Helper::translation(4857,$translate) }}">
                  <div class="input-group-append-overlay"><span class="input-group-text"><i class="czi-search"></i></span></div>
                </div>
                @if(count($getWell['type']) != 0)
                <ul class="widget-list cz-filter-list list-unstyled pt-1" style="max-height: 12rem;" data-simplebar data-simplebar-auto-hide="false">
                  @foreach($getWell['type'] as $value)
                  <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" type="checkbox" id="{{ $value->item_type_slug }}" name="item_type[]" value="{{ $value->item_type_slug }}">
                      <label class="custom-control-label cz-filter-item-text" for="{{ $value->item_type_slug }}">{{ $value->item_type_name }}</label>
                    </div>
                  </li>
                  @endforeach
                 </ul>
                @endif 
              </div>
              <!-- Categories-->
              <div class="widget cz-filter mb-4 pb-4 border-bottom">
                <h3 class="widget-title">{{ Helper::translation(2879,$translate) }}</h3>
                <div class="input-group-overlay input-group-sm mb-2">
                  <input class="cz-filter-search form-control form-control-sm appended-form-control" type="text" placeholder="{{ Helper::translation(4857,$translate) }}">
                  <div class="input-group-append-overlay"><span class="input-group-text"><i class="dwg-search"></i></span></div>
                </div>
                @if(count($category['view']) != 0)
                <ul class="widget-list cz-filter-list list-unstyled pt-1" style="max-height: 12rem;" data-simplebar data-simplebar-auto-hide="false">
                  @foreach($category['view'] as $cat)
                  <li class="cz-filter-item d-flex justify-content-between align-items-center mb-1">
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" type="checkbox" id="{{ $cat->cat_id }}" name="category_names[]" value="{{ 'category_'.$cat->cat_id }}">
                      <label class="custom-control-label cz-filter-item-text" for="{{ $cat->cat_id }}">{{ $cat->category_name }}</label>
                      @foreach($cat->subcategory as $sub_category)
                      <br/>
                      <span class="ml-2"><input class="custom-control-input" type="checkbox" id="{{ $sub_category->subcat_id }}" name="category_names[]" value="{{ 'subcategory_'.$sub_category->subcat_id }}">
                      <label class="custom-control-label cz-filter-item-text" for="{{ $sub_category->subcat_id }}">{{ $sub_category->subcategory_name }}</label>
                      </span>
                      @endforeach
                    </div>
                    
                  </li>
                  @endforeach 
                </ul>
                @endif
              </div>
              <div class="widget cz-filter mb-4 pb-4 border-bottom">
                <h3 class="widget-title">{{ Helper::translation(4851,$translate) }}</h3>
                <div class="input-group-overlay input-group-sm mb-2">
                  <select class="cz-filter-search form-control form-control-sm appended-form-control" name="orderby">
                  <option value="desc">{{ Helper::translation(4854,$translate) }}</option>
                  <option value="asc">{{ Helper::translation(3179,$translate) }}</option>
                  <option value="desc">{{ Helper::translation(3180,$translate) }}</option>
                 </select>            
                </div>
              </div>
              <!-- Price range-->
              @if(count($itemData['item']) != 0)
              <div class="widget mb-4 pb-4 border-bottom">
                <h3 class="widget-title">{{ Helper::translation(2888,$translate) }}</h3>
                <div class="cz-range-slider" data-start-min="{{ $minprice['price']->regular_price }}" data-start-max="{{ $maxprice['price']->extended_price }}" data-min="{{ $allsettings->site_range_min_price }}" data-max="{{ $allsettings->site_range_max_price }}" data-step="1">
                  <div class="cz-range-slider-ui"></div>
                  <div class="d-flex pb-1">
                    <div class="w-50 pr-2 mr-2">
                      <div class="input-group input-group-sm">
                        <div class="input-group-prepend"><span class="input-group-text">{{ $allsettings->site_currency_symbol }}</span></div>
                        <input class="form-control cz-range-slider-value-min" type="text" name="min_price">
                      </div>
                    </div>
                    <div class="w-50 pl-2">
                      <div class="input-group input-group-sm">
                        <div class="input-group-prepend"><span class="input-group-text">{{ $allsettings->site_currency_symbol }}</span></div>
                        <input class="form-control cz-range-slider-value-max" type="text" name="max_price">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endif
              <div class="input-group-append">
                  <button class="btn btn-primary btn-sm font-size-base" type="submit">{{ Helper::translation(4857,$translate) }}</button>
             </div>
              <!-- Filter by Brand-->
           </div>
          </div>
          </form>
        </aside>
        <div class="col-lg-8">
         <div class="row pt-2 mx-n2">
        <!-- Product-->
        @if(count($itemData['item']) != 0)
        @php $no = 1; @endphp
        @foreach($itemData['item'] as $featured)
        @php
        $price = Helper::price_info($featured->item_flash,$featured->regular_price);
        $count_rating = Helper::count_rating($featured->ratings);
        @endphp
        <div class="col-lg-4 col-md-4 col-sm-6 px-2 mb-3 prod-item">
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
       <div class="text-right">
            <div class="turn-page" id="itempager"></div>
       </div>
       @else
       <div>{{ Helper::translation(6072,$translate) }}</div>
       @endif
       </div>
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