@if($allsettings->maintenance_mode == 0)
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>{{ Helper::translation(3028,$translate) }} - {{ $allsettings->site_title }}</title>
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
              <li class="breadcrumb-item"><a class="text-nowrap" href="{{ URL::to('/') }}"><i class="dwg-home"></i>{{ Helper::translation(3028,$translate) }}</a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page">{{ Helper::translation(3028,$translate) }}</li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 mb-0 text-white">{{ Helper::translation(3028,$translate) }}</h1>
        </div>
      </div>
      </div>

    </section>



<div class="container py-5 mt-md-2 mb-2">

      <div class="row">
      <section class="col-lg-8">

	<div class="d-sm-flex mt-lg-4 mb-4 pb-3 pb-sm-2 border-bottom" data-aos="fade-up" data-aos-delay="200" style="">
            <div class="media media-ie-fix d-block d-sm-flex text-sm-left">
            Sort By : 
              <div class="media-body pl-5">
		<select name="sort_by" id="sort_by" class="form-control" onchange="change_sort_by(this.value)">
                  <option value="">Select</option> 
                  <option value="name">Name</option>
                  <option value="newest">Newest</option>
                  <option value="oldest">Oldest</option>
                </select>
              </div>
            </div>
            <div class="pt-2 pl-sm-3 mx-auto mx-sm-0 text-center">
              
                                                  
            </div>
          </div>


          @foreach($user['user'] as $user)
          @if($count_sale->has($user->id) != 0)
          @php
          $membership = date('m/d/Y',strtotime($user->created_at));
          $membership_date = explode("/", $membership);
          $year = (date("md", date("U", mktime(0, 0, 0, $membership_date[0], $membership_date[1], $membership_date[2]))) > date("md")
                                        ? ((date("Y") - $membership_date[2]) - 1)
                                        : (date("Y") - $membership_date[2]));
          $referral_count = $user->referral_count;  
          @endphp
          <div class="d-sm-flex justify-content-between mt-lg-4 mb-4 pb-3 pb-sm-2 border-bottom prod-item" data-aos="fade-up" data-aos-delay="200">
            <div class="media media-ie-fix d-block d-sm-flex text-sm-left">
            <a href="{{ url('/user') }}/{{ $user->username }}" class="d-inline-block mx-auto mr-sm-4" style="width: 7rem;">
             @if($user->user_photo != '')
             <img src="{{ url('/') }}/public/storage/users/{{ $user->user_photo }}" alt="{{ $user->name }}" class="img-rounded">
             @else
             <img src="{{ url('/') }}/public/img/no-user.png" alt="{{ $user->name }}" class="img-rounded">
             @endif
             </a>
              <div class="media-body pt-2">
                <h3 class="product-title font-size-base mb-2"><a href="{{ url('/user') }}/{{ $user->username }}">{{ $user->name }} @if($addition_settings->subscription_mode == 1) @if($user->user_document_verified == 1) <span class="badges-success"><i class="dwg-check-circle danger"></i> {{ Helper::translation(5202,$translate) }}</span>@endif @endif</a></h3>
                @if($user->country_badge == 1)
                <div class="badges-icon">
                <ul>
                 @if($user->country_badges != "")
                   <li>
                     <img src="{{ url('/') }}/public/storage/flag/{{ $user->country_badges }}" border="0" class="icon-badges" title="{{ Helper::translation(5985,$translate) }} {{ $user->country_name }}">  
                   </li>
                    @endif
                     @if($user->exclusive_author == 1)
                      <li>
                       <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->exclusive_author_icon }}" border="0" class="other-badges" title="{{ Helper::translation(5988,$translate) }} {{ $allsettings->site_title }}">
                       </li>
                       @endif
                       @if($year == 1)
                       <li>
                       <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->one_year_icon }}" border="0" class="other-badges" title="{{ $year }} {{ Helper::translation(6000,$translate) }} {{ $allsettings->site_title }} {{ Helper::translation(6003,$translate) }} {{ $year }} {{ Helper::translation(6006,$translate) }}">
                       </li>
                       @endif
                       @if($year == 2)
                        <li>
                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->two_year_icon }}" border="0" class="other-badges" title="{{ $year }} {{ Helper::translation(6000,$translate) }} {{ $allsettings->site_title }} {{ Helper::translation(6003,$translate) }} {{ $year }} {{ Helper::translation(6006,$translate) }}">
                        </li>
                        @endif
                        @if($year == 3)
                        <li>
                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->three_year_icon }}" border="0" class="other-badges" title="{{ $year }} {{ Helper::translation(6000,$translate) }} {{ $allsettings->site_title }} {{ Helper::translation(6003,$translate) }} {{ $year }} {{ Helper::translation(6006,$translate) }}">
                         </li>
                         @endif
                        @if($year == 4)
                        <li>
                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->four_year_icon }}" border="0" class="other-badges" title="{{ $year }} {{ Helper::translation(6000,$translate) }} {{ $allsettings->site_title }} {{ Helper::translation(6003,$translate) }} {{ $year }} {{ Helper::translation(6006,$translate) }}">
                        </li>
                        @endif
                        @if($year == 5)
                        <li>
                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->five_year_icon }}" border="0" class="other-badges" title="{{ $year }} {{ Helper::translation(6000,$translate) }} {{ $allsettings->site_title }} {{ Helper::translation(6003,$translate) }} {{ $year }} {{ Helper::translation(6006,$translate) }}">
                        </li>
                        @endif 
                        @if($year == 6)
                        <li>
                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->six_year_icon }}" border="0" class="other-badges" title="{{ $year }} {{ Helper::translation(6000,$translate) }} {{ $allsettings->site_title }} {{ Helper::translation(6003,$translate) }} {{ $year }} {{ Helper::translation(6006,$translate) }}">
                        </li>
                        @endif
                        @if($year == 7)
                        <li>
                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->seven_year_icon }}" border="0" class="other-badges" title="{{ $year }} {{ Helper::translation(6000,$translate) }} {{ $allsettings->site_title }} {{ Helper::translation(6003,$translate) }} {{ $year }} {{ Helper::translation(6006,$translate) }}">
                       </li>
                       @endif
                       @if($year == 8)
                       <li>
                       <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->eight_year_icon }}" border="0" class="other-badges" title="{{ $year }} {{ Helper::translation(6000,$translate) }} {{ $allsettings->site_title }} {{ Helper::translation(6003,$translate) }} {{ $year }} {{ Helper::translation(6006,$translate) }}">
                       </li>
                       @endif
                       @if($year == 9)
                       <li>
                         <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->nine_year_icon }}" border="0" class="other-badges" title="{{ $year }} {{ Helper::translation(6000,$translate) }} {{ $allsettings->site_title }} {{ Helper::translation(6003,$translate) }} {{ $year }} {{ Helper::translation(6006,$translate) }}">
                         </li>
                       @endif
                       @if($year >= 10)
                       <li>
                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->ten_year_icon }}" border="0" class="other-badges" title="@if($year >= 10) 10+ @else {{ $year }} @endif {{ Helper::translation(6000,$translate) }} {{ $allsettings->site_title }} {{ Helper::translation(6003,$translate) }} @if($year >= 10) 10+ @else {{ $year }} @endif {{ Helper::translation(6006,$translate) }}">
                         </li>
                         @endif
                        @if($referral_count >= $badges['setting']->author_referral_level_one && $badges['setting']->author_referral_level_two > $referral_count) 
                        <li>
                         <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->author_referral_level_one_icon }}" border="0" class="other-badges" title="{{ Helper::translation(6024,$translate) }} 1: {{ Helper::translation(6027,$translate) }} {{ $badges['setting']->author_referral_level_one }}+ {{ Helper::translation(3002,$translate) }}">
                         </li>
                         @endif
                         @if($referral_count >= $badges['setting']->author_referral_level_two && $badges['setting']->author_referral_level_three > $referral_count) 
                         <li>
                          <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->author_referral_level_two_icon }}" border="0" class="other-badges" title="{{ Helper::translation(6024,$translate) }} 2: {{ Helper::translation(6027,$translate) }} {{ $badges['setting']->author_referral_level_two }}+ {{ Helper::translation(3002,$translate) }}">
                           </li>
                          @endif
                          @if($referral_count >= $badges['setting']->author_referral_level_three && $badges['setting']->author_referral_level_four > $referral_count) 
                           <li>
                           <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->author_referral_level_three_icon }}" border="0" class="other-badges" title="{{ Helper::translation(6024,$translate) }} 3: {{ Helper::translation(6027,$translate) }} {{ $badges['setting']->author_referral_level_three }}+ {{ Helper::translation(3002,$translate) }}">
                           </li>
                         @endif
                         @if($referral_count >= $badges['setting']->author_referral_level_four && $badges['setting']->author_referral_level_five > $referral_count) 
                          <li>
                            <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->author_referral_level_four_icon }}" border="0" class="other-badges" title="{{ Helper::translation(6024,$translate) }} 4: {{ Helper::translation(6027,$translate) }} {{ $badges['setting']->author_referral_level_four }}+ {{ Helper::translation(3002,$translate) }}">
                             </li>
                          @endif
                          @if($referral_count >= $badges['setting']->author_referral_level_five && $badges['setting']->author_referral_level_six > $referral_count) 
                           <li>
                            <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->author_referral_level_five_icon }}" border="0" class="other-badges" title="{{ Helper::translation(6024,$translate) }} 5: {{ Helper::translation(6027,$translate) }} {{ $badges['setting']->author_referral_level_five }}+ {{ Helper::translation(3002,$translate) }}">
                            </li>
                         @endif
                         @if($referral_count >= $badges['setting']->author_referral_level_six) 
                           <li>
                            <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->author_referral_level_six_icon }}" border="0" class="other-badges" title="{{ Helper::translation(6024,$translate) }} 6: {{ Helper::translation(6027,$translate) }} {{ $badges['setting']->author_referral_level_six }}+ {{ Helper::translation(3002,$translate) }}">
                            </li>
                         @endif
                         </ul>
                         </div>
                         @endif
                <div class="font-size-sm">{{ $count_items->has($user->id) ? count($count_items[$user->id]) : 0 }} Items</div>
                <div class="font-size-sm">{{ Helper::translation(3077,$translate) }} {{ date("F Y", strtotime($user->created_at)) }}</div>
                <div class="font-size-sm">@if($user->country_badge == 1){{ $user->country_name }}@endif</div>
              </div>
            </div>
            <div class="pt-2 pl-sm-3 mx-auto mx-sm-0 text-center">
             <p><span class="sale-count">{{ $count_sale->has($user->id) ? count($count_sale[$user->id]) : 0 }}</span><br/>{{ Helper::translation(2930,$translate) }}</p>
             @php
             $count_rating = Helper::count_rating($user->ratings);
             @endphp
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
          </div>
          @endif
          @endforeach
          <div class="pagination-area">
          <div class="turn-page" id="itempager"></div>
          </div>
        </section>
        <aside class="col-lg-4">
          <!-- Sidebar-->
          <div class="cz-sidebar border-left ml-lg-auto" id="blog-sidebar">
            <div class="cz-sidebar-header box-shadow-sm">
              <button class="close ml-auto" type="button" data-dismiss="sidebar" aria-label="Close"><span class="d-inline-block font-size-xs font-weight-normal align-middle">{{ Helper::translation(6069,$translate) }}</span><span class="d-inline-block align-middle ml-2" aria-hidden="true">×</span></button>
            </div>
            <div class="cz-sidebar-body py-lg-1" data-simplebar="init" data-simplebar-auto-hide="true"><div class="simplebar-wrapper" style="margin: -4px -16px -4px -30px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" style="height: auto; overflow: hidden;"><div class="simplebar-content" style="padding: 4px 16px 4px 30px;">
              <!-- Categories-->
              <div class="widget widget-links mb-grid-gutter pb-grid-gutter border-bottom">
                <h3 class="widget-title">{{ Helper::translation(2879,$translate) }}</h3>
                @if(count($category['view']) != 0)
                <ul class="widget-list">
                @foreach($category['view'] as $cat)
                  <li class="widget-list-item"><a class="widget-list-link d-flex justify-content-between align-items-center" href="{{ URL::to('/shop/category/') }}/{{$cat->category_slug}}"><span>{{ $cat->category_name }}</span></a></li>
                 @endforeach 
                </ul>
                @endif
              </div>
              <!-- Trending posts-->
              <div class="widget mb-grid-gutter pb-grid-gutter border-bottom">
                <h3 class="widget-title">{{ Helper::translation(3181,$translate) }}</h3>
                @if(count($popular['items']) != 0)
                @php $no = 1; @endphp
                @foreach($popular['items'] as $featured)
                <div class="media align-items-center mb-3"><a href="{{ URL::to('/item') }}/{{ $featured->item_slug }}">
                @if($featured->item_preview!='')
                <img class="rounded" src="{{ url('/') }}/public/storage/items/{{ $featured->item_preview }}" width="64" alt="{{ $featured->item_name }}">
                @else
                <img class="rounded" src="{{ url('/') }}/public/img/no-image.png" width="64" alt="{{ $featured->item_name }}">
                @endif
                </a>
                  <div class="media-body pl-3">
                    <h6 class="blog-entry-title font-size-sm mb-0"><a href="{{ URL::to('/item') }}/{{ $featured->item_slug }}">{{ substr($featured->item_name,0,20).'...' }}</a></h6><span class="font-size-ms text-muted">{{ Helper::translation(3034,$translate) }} <a href="{{ URL::to('/user') }}/{{ $featured->username }}" class="blog-entry-meta-link">{{ $featured->username }}</a></span>
                  </div>
                </div>
                @endforeach
                @endif
              </div>
              </div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 1070px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: hidden;"><div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div></div></div>
          </div>
        </aside>
       </div>
    </div>

<script>
function change_sort_by(sortby)
{
var url = "<?php echo url()->current(); ?>?sortby="+sortby;
//alert(url);
location.href = url;
}
</script>

@include('footer')
@include('script')
</body>
</html>
@else
@include('503')
@endif