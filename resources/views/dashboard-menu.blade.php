<div class="cz-sidebar-static rounded-lg box-shadow-lg px-0 pb-0 mb-5 mb-lg-0">
            <div class="px-4 mb-4">
              <div class="media align-items-center">
                <div class="img-thumbnail rounded-circle position-relative" style="width: 6.375rem;">
                @if(!empty(Auth::user()->user_photo))
                <img class="rounded-circle" src="{{ url('/') }}/public/storage/users/{{ Auth::user()->user_photo }}" alt="{{ Auth::user()->name }}">
                @else
                <img class="rounded-circle" src="{{ url('/') }}/public/img/no-user.png" alt="{{ Auth::user()->name }}">
                @endif
                </div>
                <div class="media-body pl-3">
                  <h3 class="font-size-base mb-0">{{ Auth::user()->name }} @if($addition_settings->subscription_mode == 1) @if(Auth::user()->user_type == 'vendor') @if(Auth::user()->user_document_verified == 1) <span class="badges-success"><i class="dwg-check-circle danger"></i> {{ Helper::translation(5202,$translate) }}</span> @endif @endif @endif</h3><span class="text-accent font-size-sm">{{ Auth::user()->email }}</span>
                  @if($addition_settings->subscription_mode == 1)
                  @if(Auth::user()->user_type == 'vendor') @if(Auth::user()->user_subscr_type != '')<span class="badge badge-info">{{ Auth::user()->user_subscr_type }} {{ Helper::translation(6156,$translate) }}</span><br/>@endif 
                  <span class="expire_on"><i class="dwg-time"></i> {{ Helper::translation(6168,$translate) }} {{ date('d M Y',strtotime(Auth::user()->user_subscr_date)) }}</span>
                  @endif
                  @endif
                </div>
              </div>
            </div>
            <div class="bg-secondary px-4 py-3">
              <h3 class="font-size-sm mb-0 text-muted">{{ Helper::translation(3231,$translate) }}</h3>
            </div>
            <ul class="list-unstyled mb-0">
            @if(Auth::user()->user_type == 'vendor')
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="{{ URL::to('/user') }}/{{ Auth::user()->username }}"><i class="dwg-home opacity-60 mr-2"></i>{{ Helper::translation(2926,$translate) }}</a></li>
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="{{ URL::to('/profile-settings') }}"><i class="dwg-settings opacity-60 mr-2"></i>{{ Helper::translation(2927,$translate) }}</a></li>
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="{{ URL::to('/purchases') }}"><i class="dwg-basket opacity-60 mr-2"></i>{{ Helper::translation(2928,$translate) }}</a></li>
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="{{ URL::to('/favourites') }}"><i class="dwg-heart opacity-60 mr-2"></i>{{ Helper::translation(2929,$translate) }}</a></li>
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="{{ URL::to('/coupon') }}"><i class="dwg-gift opacity-60 mr-2"></i>{{ Helper::translation(2919,$translate) }}</a></li>
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="{{ URL::to('/sales') }}"><i class="dwg-cart opacity-60 mr-2"></i>{{ Helper::translation(2930,$translate) }}</a></li>
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="{{ URL::to('/manage-item') }}"><i class="dwg-briefcase opacity-60 mr-2"></i>{{ Helper::translation(2932,$translate) }}</a></li>
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="{{ URL::to('/withdrawal') }}"><i class="dwg-currency-exchange opacity-60 mr-2"></i>{{ Helper::translation(2933,$translate) }}</a></li>
            @endif
            @if(Auth::user()->user_type == 'customer')
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="{{ URL::to('/user') }}/{{ Auth::user()->username }}"><i class="dwg-home opacity-60 mr-2"></i>{{ Helper::translation(2926,$translate) }}</a></li>
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="{{ URL::to('/profile-settings') }}"><i class="dwg-settings opacity-60 mr-2"></i>{{ Helper::translation(2927,$translate) }}</a></li>
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="{{ URL::to('/purchases') }}"><i class="dwg-basket opacity-60 mr-2"></i>{{ Helper::translation(2928,$translate) }}</a></li>
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="{{ URL::to('/favourites') }}"><i class="dwg-heart opacity-60 mr-2"></i>{{ Helper::translation(2929,$translate) }}</a></li>
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="{{ URL::to('/withdrawal') }}"><i class="dwg-currency-exchange opacity-60 mr-2"></i>{{ Helper::translation(2933,$translate) }}</a></li>
            @endif
            <li class="mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="{{ url('/logout') }}"><i class="dwg-sign-out opacity-60 mr-2"></i>{{ Helper::translation(3023,$translate) }}</a></li>
                </ul>
           </div>