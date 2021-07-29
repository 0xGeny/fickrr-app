<aside class="col-lg-4">
            <div class="cz-sidebar-static h-100 border-right">
              
              @if($user['user']->user_type == 'vendor')
            <div class="item-details badge-size" data-aos="fade-up" data-aos-delay="200" style="display:none">
                                    <ul>
                                        @if($sold_amount >= $badges['setting']->author_sold_level_six)
                                        <div class="sidebar-card card--metadata">
                                            <div>
                                                    <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->power_elite_author_icon }}" border="0" class="single-badges" title="{{ $badges['setting']->author_sold_level_six_label }} : {{ Helper::translation(5982,$translate) }} {{ $allsettings->site_currency }} {{ $badges['setting']->author_sold_level_six }}+ {{ Helper::translation(5325,$translate) }} {{ $allsettings->site_title }}"> {{ $badges['setting']->author_sold_level_six_label }}
                                            </div>
                                            
                                        </div> 
                                        @endif
                                         @if($user['user']->country_badge == 1)
                                        @if($country['view']->country_badges != "")
                                        <li>
                                          <img src="{{ url('/') }}/public/storage/flag/{{ $country['view']->country_badges }}" border="0" class="icon-badges" title="{{ Helper::translation(5985,$translate) }} {{ $country['view']->country_name }}">  
                                        </li>
                                        @endif
                                        @endif
                                        @if($featured_count->has($user['user']->id) ? count($featured_count[$user['user']->id]) : 0 != 0)
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->featured_item_icon }}" border="0" class="other-badges" title="{{ Helper::translation(5994,$translate) }} {{ $allsettings->site_title }}">
                                        </li>
                                        @endif
                                        @if($free_count->has($user['user']->id) ? count($free_count[$user['user']->id]) : 0 != 0)
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->free_item_icon }}" border="0" class="other-badges" title="{{ Helper::translation(5997,$translate) }}">
                                        </li>
                                        @endif
                                        @if($tren_count->has($user['user']->id) ? count($tren_count[$user['user']->id]) : 0 != 0)
                                         <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->trends_icon }}" border="0" class="other-badges" title="{{ Helper::translation(5991,$translate) }}">
                                        </li>
                                        @endif
                                        @if($user['user']->exclusive_author == 1)
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
                                        @if($sold_amount >= $badges['setting']->author_sold_level_one && $badges['setting']->author_sold_level_two > $sold_amount) 
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->author_sold_level_one_icon }}" border="0" class="other-badges" title="{{ Helper::translation(6009,$translate) }} 1: {{ Helper::translation(6012,$translate) }} {{ $allsettings->site_currency }} {{ $badges['setting']->author_sold_level_one }}+ {{ Helper::translation(5325,$translate) }} {{ $allsettings->site_title }}">
                                        </li>
                                        @endif
                                        
                                        @if($sold_amount >= $badges['setting']->author_sold_level_two &&  $badges['setting']->author_sold_level_three > $sold_amount) 
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->author_sold_level_two_icon }}" border="0" class="other-badges" title="{{ Helper::translation(6009,$translate) }} 2: {{ Helper::translation(6012,$translate) }} {{ $allsettings->site_currency }} {{ $badges['setting']->author_sold_level_two }}+ {{ Helper::translation(5325,$translate) }} {{ $allsettings->site_title }}">
                                        </li>
                                        @endif
                                        @if($sold_amount >= $badges['setting']->author_sold_level_three &&  $badges['setting']->author_sold_level_four > $sold_amount) 
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->	author_sold_level_three_icon }}" border="0" class="other-badges" title="{{ Helper::translation(6009,$translate) }} 3: {{ Helper::translation(6012,$translate) }} {{ $allsettings->site_currency }} {{ $badges['setting']->author_sold_level_three }}+ {{ Helper::translation(5325,$translate) }} {{ $allsettings->site_title }}">
                                        </li>
                                        @endif
                                        @if($sold_amount >= $badges['setting']->author_sold_level_four &&  $badges['setting']->author_sold_level_five > $sold_amount) 
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->author_sold_level_four_icon }}" border="0" class="other-badges" title="{{ Helper::translation(6009,$translate) }} 4: {{ Helper::translation(6012,$translate) }} {{ $allsettings->site_currency }} {{ $badges['setting']->author_sold_level_four }}+ {{ Helper::translation(5325,$translate) }} {{ $allsettings->site_title }}">
                                        </li>
                                        @endif
                                        @if($sold_amount >= $badges['setting']->author_sold_level_five &&  $badges['setting']->author_sold_level_six > $sold_amount) 
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->author_sold_level_five_icon }}" border="0" class="other-badges" title="{{ Helper::translation(6009,$translate) }} 5: {{ Helper::translation(6012,$translate) }} {{ $allsettings->site_currency }} {{ $badges['setting']->author_sold_level_five }}+ {{ Helper::translation(5325,$translate) }} {{ $allsettings->site_title }}">
                                        </li>
                                        @endif
                                        @if($sold_amount >= $badges['setting']->author_sold_level_six) 
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->author_sold_level_six_icon }}" border="0" class="other-badges" title="{{ Helper::translation(6009,$translate) }} 6: {{ Helper::translation(6012,$translate) }} {{ $allsettings->site_currency }} {{ $badges['setting']->author_sold_level_six }}+ {{ Helper::translation(5325,$translate) }} {{ $allsettings->site_title }}">
                                        </li>
                                        @endif
                                        @if($sold_amount >= $badges['setting']->author_sold_level_six)
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->power_elite_author_icon }}" border="0" class="other-badges" title="{{ $badges['setting']->author_sold_level_six_label }} : Sold more than {{ $allsettings->site_currency }} {{ $badges['setting']->author_sold_level_six }}+ {{ Helper::translation(5325,$translate) }} {{ $allsettings->site_title }}">
                                        </li>
                                        @endif
                                        @if($collect_amount >= $badges['setting']->author_collect_level_one && $badges['setting']->author_collect_level_two > $collect_amount) 
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->author_collect_level_one_icon }}" border="0" class="other-badges" title="{{ Helper::translation(6015,$translate) }} 1: {{ Helper::translation(6018,$translate) }} {{ $badges['setting']->author_collect_level_one }}+ {{ Helper::translation(6021,$translate) }} {{ $allsettings->site_title }}">
                                        </li>
                                        @endif
                                        @if($collect_amount >= $badges['setting']->author_collect_level_two && $badges['setting']->author_collect_level_three > $collect_amount) 
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->author_collect_level_two_icon }}" border="0" class="other-badges" title="{{ Helper::translation(6015,$translate) }} 2: {{ Helper::translation(6018,$translate) }} {{ $badges['setting']->author_collect_level_two }}+ {{ Helper::translation(6021,$translate) }} {{ $allsettings->site_title }}">
                                        </li>
                                        @endif
                                        @if($collect_amount >= $badges['setting']->author_collect_level_three && $badges['setting']->author_collect_level_four > $collect_amount) 
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->author_collect_level_three_icon }}" border="0" class="other-badges" title="{{ Helper::translation(6015,$translate) }} 3: {{ Helper::translation(6018,$translate) }} {{ $badges['setting']->author_collect_level_three }}+ {{ Helper::translation(6021,$translate) }} {{ $allsettings->site_title }}">
                                        </li>
                                        @endif
                                        @if($collect_amount >= $badges['setting']->author_collect_level_four && $badges['setting']->author_collect_level_five > $collect_amount) 
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->author_collect_level_four_icon }}" border="0" class="other-badges" title="{{ Helper::translation(6015,$translate) }} 4: {{ Helper::translation(6018,$translate) }} {{ $badges['setting']->author_collect_level_four }}+ {{ Helper::translation(6021,$translate) }} {{ $allsettings->site_title }}">
                                        </li>
                                        @endif
                                        @if($collect_amount >= $badges['setting']->author_collect_level_five && $badges['setting']->author_collect_level_six > $collect_amount) 
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->author_collect_level_five_icon }}" border="0" class="other-badges" title="{{ Helper::translation(6015,$translate) }} 5: {{ Helper::translation(6018,$translate) }} {{ $badges['setting']->author_collect_level_five }}+ {{ Helper::translation(6021,$translate) }} {{ $allsettings->site_title }}">
                                        </li>
                                        @endif
                                        @if($collect_amount >= $badges['setting']->author_collect_level_six) 
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->author_collect_level_six_icon }}" border="0" class="other-badges" title="{{ Helper::translation(6015,$translate) }} 6: {{ Helper::translation(6018,$translate) }} {{ $badges['setting']->author_collect_level_six }}+ {{ Helper::translation(6021,$translate) }} {{ $allsettings->site_title }}">
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
              @if($user['user']->profile_heading != "")
              <div data-aos="fade-up" data-aos-delay="200">
              
              <h6>{{ Helper::translation(3124,$translate) }}</h6>
              <p class="font-size-ms text-muted">
              <b>{{ $user['user']->profile_heading }}</b><br/>
              {{ $user['user']->about }}
              </p>
              </div>
              @endif
              <div data-aos="fade-up" data-aos-delay="200">
              <hr class="my-4">
              <h6>{{ Helper::translation(3206,$translate) }}</h6>
              <a class="social-btn sb-facebook sb-outline sb-sm mr-2 mb-2" href="{{ $user['user']->facebook_url }}" target="_blank"><i class="dwg-facebook"></i></a>
              <a class="social-btn sb-twitter sb-outline sb-sm mr-2 mb-2" href="{{ $user['user']->twitter_url }}" target="_blank"><i class="dwg-twitter"></i></a>
              <a class="social-btn sb-pinterest sb-outline sb-sm mr-2 mb-2" href="{{ $user['user']->gplus_url }}" target="_blank"><i class="dwg-google"></i></a>
              </div>
              
              <div data-aos="fade-up" data-aos-delay="200">
              <hr class="my-4">
              <ul class="profile-menu">
                <li>
                  <a href="{{ url('/user') }}/{{ $user['user']->username }}"><span class="dwg-home"></span> {{ Helper::translation(2926,$translate) }}</a>
                </li>
                @if($user['user']->user_type == 'vendor')
                <li>
                <a href="{{ url('/user-reviews') }}/{{ $user['user']->username }}"><span class="dwg-star"></span> {{ Helper::translation(3207,$translate) }}</a>
                </li>
                @endif
                <li>
                <a href="{{ url('/user-followers') }}/{{ $user['user']->username }}"><span class="dwg-user"></span> {{ Helper::translation(3197,$translate) }} ({{ $followercount }})</a>
                </li>
                <li>
                <a href="{{ url('/user-following') }}/{{ $user['user']->username }}"><span class="dwg-user"></span> {{ Helper::translation(3201,$translate) }} ({{ $followingcount }})</a>
                </li>
              </ul>
              </div>
              @if (Auth::check())
              @if($user['user']->username != Auth::user()->username)
              <div data-aos="fade-up" data-aos-delay="200">
              <hr class="my-4">
              <h6 class="pb-1">{{ Helper::translation(2915,$translate) }} {{ $user['user']->username }}</h6>
              <form action="{{ route('user') }}" class="setting_form" id="item_form" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="form-group">
                  <textarea name="message" class="form-control" id="author-message" rows="6" placeholder="{{ Helper::translation(3209,$translate) }}" data-bvalidator="required"></textarea>
                  <input type="hidden" name="from_email" value="{{ Auth::user()->email }}" />
                  <input type="hidden" name="from_name" value="{{ Auth::user()->name }}" />
                  <input type="hidden" name="to_email" value="{{ $user['user']->email }}" />
                  <input type="hidden" name="to_name" value="{{ $user['user']->name }}" />
                  <input type="hidden" name="to_id" value="{{ $user['user']->id }}" />
                </div>
                <button class="btn btn-primary btn-sm btn-block" type="submit">{{ Helper::translation(3210,$translate) }}</button>
              </form>
              </div>
              @endif
              @endif
              @if(Auth::guest())
              <div data-aos="fade-up" data-aos-delay="200">
              <hr class="my-4">
              <h6 class="pb-1">{{ Helper::translation(2915,$translate) }} {{ $user['user']->username }}</h6>
              <p class="font-size-ms text-muted">
                  {{ Helper::translation(3061,$translate) }} <a href="{{ url('/login') }}">{{ Helper::translation(3020,$translate) }}</a> {{ Helper::translation(3062,$translate) }}
              </p>
              </div>
              @endif 
            </div>
          </aside>