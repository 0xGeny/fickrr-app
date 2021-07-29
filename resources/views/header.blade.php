<header class="bg-light box-shadow-sm navbar-sticky">
  <!-- Topbar-->
  @if($allsettings->site_header_top_bar == 1)
  <div class="topbar topbar-dark bg-dark">
    <div class="container">
      <div>
        @if($allsettings->multi_language == 1)
        <div class="topbar-text dropdown disable-autohide"><a class="topbar-link dropdown-toggle" href="javascript:void(0);" data-toggle="dropdown">{{ $language_title }}</a>
          <ul class="dropdown-menu">
            @foreach($languages['view'] as $language) 
            <li><a class="dropdown-item pb-1" href="{{ URL::to('/translate') }}/{{ $language->language_code }}">{{ $language->language_name }}</a></li>
            @endforeach
          </ul>
        </div>
        @endif
        <div class="topbar-text text-nowrap d-none d-md-inline-block border-left border-light pl-3 ml-3"></div>
      </div>
      <div class="topbar-text dropdown d-md-none ml-auto"><a class="topbar-link dropdown-toggle" href="#" data-toggle="dropdown">{{ Helper::translation(3018,$translate) }} / {{ Helper::translation(2910,$translate) }}@if($allsettings->site_blog_display == 1) / {{ Helper::translation(2877,$translate) }}@endif</a>
        <ul class="dropdown-menu dropdown-menu-right">
          @if(Auth::guest())
          <li><a class="dropdown-item" href="{{ URL::to('/start-selling') }}"><i class="dwg-cart text-muted mr-2"></i>{{ Helper::translation(3018,$translate) }}</a></li>
          @else
          @if(Auth::user()->user_type == 'vendor')
          <li><a class="dropdown-item" href="{{ URL::to('/manage-item') }}"><i class="dwg-cart text-muted mr-2"></i>{{ Helper::translation(3018,$translate) }}</a></li>
          @endif
          @endif
          <li><a class="dropdown-item" href="{{ URL::to('/contact') }}"><i class="dwg-support text-muted mr-2"></i>{{ Helper::translation(2910,$translate) }}</a></li>
          @if($allsettings->site_blog_display == 1)
          <li><a class="dropdown-item" href="{{ URL::to('/blog') }}"><i class="dwg-image text-muted mr-2"></i>{{ Helper::translation(2877,$translate) }}</a></li>
          @endif
        </ul>
      </div>
      <div class="d-none d-md-block ml-3 text-nowrap">
        @if($allsettings->site_selling_display == 1)
        @if(Auth::guest())
        <a class="topbar-link d-none d-md-inline-block" href="{{ URL::to('/start-selling') }}"><i class="dwg-cart mt-n1"></i>{{ Helper::translation(3018,$translate) }}</a>
        @else
        @if(Auth::user()->user_type == 'vendor')
        <a class="topbar-link d-none d-md-inline-block" href="{{ URL::to('/manage-item') }}"><i class="dwg-cart mt-n1"></i>{{ Helper::translation(3018,$translate) }}</a>
        @endif
        @endif
        @endif
        <a class="topbar-link ml-3 pl-3 border-left border-light d-none d-md-inline-block" href="{{ URL::to('/contact') }}"><i class="dwg-support mt-n1"></i>{{ Helper::translation(2910,$translate) }}</a>
        @if($allsettings->site_blog_display == 1)
        <a class="topbar-link ml-3 border-left border-light pl-3 d-none d-md-inline-block" href="{{ URL::to('/blog') }}"><i class="dwg-image mt-n1"></i>{{ Helper::translation(2877,$translate) }}</a>
        @endif
      </div>
    </div>
  </div>
  @endif

  <!-- Remove "navbar-sticky" class to make navigation bar scrollable with the page.-->
  <div class="navbar-sticky">
    <div class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        @if($allsettings->site_logo != '')
        <a class="navbar-brand d-none d-sm-block mr-4 order-lg-1" href="{{ URL::to('/') }}" style="min-width: 7rem;">
         <img width="200" src="{{ url('/') }}/public/storage/settings/{{ $allsettings->site_logo }}" alt="{{ $allsettings->site_title }}"/>
       </a>
       @endif
       @if($allsettings->site_favicon != '')
       <a class="navbar-brand d-sm-none mr-2 order-lg-1" href="{{ URL::to('/') }}" style="min-width: 4.625rem;">
         <img width="74" src="{{ url('/') }}/public/storage/settings/{{ $allsettings->site_favicon }}" alt="{{ $allsettings->site_title }}"/>
       </a>
       @endif
       <div class="navbar-toolbar d-flex align-items-center order-lg-3">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"><span class="navbar-toggler-icon"></span></button><a class="navbar-tool d-none d-lg-flex" href="#searchBox" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="searchBox"><span class="navbar-tool-tooltip">{{ Helper::translation(4857,$translate) }}</span>
          <div class="navbar-tool-icon-box" style="display:none;"><i class="navbar-tool-icon dwg-search"></i></div></a>
          <a class="navbar-tool d-none d-lg-flex" href="{{ URL::to('/favourites') }}"><span class="navbar-tool-tooltip">{{ Helper::translation(2989,$translate) }}</span>
            <div class="navbar-tool-icon-box"><i class="navbar-tool-icon dwg-heart"></i></div></a>
            @if(Auth::guest())
            <a class="navbar-tool ml-1 mr-n1" href="{{ URL::to('/login') }}"><span class="navbar-tool-tooltip">{{ Helper::translation(3231,$translate) }}</span>
              <div class="navbar-tool-icon-box"><i class="navbar-tool-icon dwg-user"></i></div></a>
              @endif
              @if (Auth::check())
              <div class="navbar-tool dropdown ml-2">
                <a class="navbar-tool-icon-box border dropdown-toggle" @if(Auth::user()->id == 1) href="{{ url('/admin') }}" target="_blank" @else href="{{ URL::to('/user') }}/{{ Auth::user()->username }}" @endif>         @if(!empty(Auth::user()->user_photo))
                  <img width="32" src="{{ url('/') }}/public/storage/users/{{ Auth::user()->user_photo }}" alt="{{ Auth::user()->name }}"/>
                  @else
                  <img src="{{ url('/') }}/public/img/no-user.png" alt="{{ Auth::user()->name }}">
                  @endif
                </a>
                <a class="navbar-tool-text ml-n1" @if(Auth::user()->id == 1) href="{{ url('/admin') }}" target="_blank" @else href="{{ URL::to('/user') }}/{{ Auth::user()->username }}" @endif>
                  <small>{{ Auth::user()->name }}</small>{{ $allsettings->site_currency_symbol }}{{ Auth::user()->earnings }}
                </a>
                <div class="dropdown-menu dropdown-menu-right" style="min-width: 14rem;">
                  @if(Auth::user()->user_type == 'vendor')
                  <a class="dropdown-item d-flex align-items-center" href="{{ URL::to('/user') }}/{{ Auth::user()->username }}"><i class="dwg-home opacity-60 mr-2"></i>{{ Helper::translation(2926,$translate) }}</a>
                  <a class="dropdown-item d-flex align-items-center" href="{{ URL::to('/profile-settings') }}"><i class="dwg-settings opacity-60 mr-2"></i>{{ Helper::translation(2927,$translate) }}</a>
                  <a class="dropdown-item d-flex align-items-center" href="{{ URL::to('/purchases') }}"><i class="dwg-basket opacity-60 mr-2"></i>{{ Helper::translation(2928,$translate) }}</a>
                  <a class="dropdown-item d-flex align-items-center" href="{{ URL::to('/favourites') }}"><i class="dwg-heart opacity-60 mr-2"></i>{{ Helper::translation(2929,$translate) }}</a>
                  <a class="dropdown-item d-flex align-items-center" href="{{ URL::to('/coupon') }}"><i class="dwg-gift opacity-60 mr-2"></i>{{ Helper::translation(2919,$translate) }}</a>
                  <a class="dropdown-item d-flex align-items-center" href="{{ URL::to('/sales') }}"><i class="dwg-cart opacity-60 mr-2"></i>{{ Helper::translation(2930,$translate) }}</a>
                  <a class="dropdown-item d-flex align-items-center" href="{{ URL::to('/manage-item') }}"><i class="dwg-briefcase opacity-60 mr-2"></i>{{ Helper::translation(2932,$translate) }}</a>
                  <a class="dropdown-item d-flex align-items-center" href="{{ URL::to('/withdrawal') }}"><i class="dwg-currency-exchange opacity-60 mr-2"></i>{{ Helper::translation(2933,$translate) }}</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item d-flex align-items-center" href="{{ url('/logout') }}"><i class="dwg-sign-out opacity-60 mr-2"></i>{{ Helper::translation(3023,$translate) }}</a>
                  @endif
                  @if(Auth::user()->user_type == 'customer')
                  <a class="dropdown-item d-flex align-items-center" href="{{ URL::to('/user') }}/{{ Auth::user()->username }}"><i class="dwg-home opacity-60 mr-2"></i>{{ Helper::translation(2926,$translate) }}</a>
                  <a class="dropdown-item d-flex align-items-center" href="{{ URL::to('/profile-settings') }}"><i class="dwg-settings opacity-60 mr-2"></i>{{ Helper::translation(2927,$translate) }}</a> 
                  <a class="dropdown-item d-flex align-items-center" href="{{ URL::to('/purchases') }}"><i class="dwg-basket opacity-60 mr-2"></i>{{ Helper::translation(2928,$translate) }}</a>
                  <a class="dropdown-item d-flex align-items-center" href="{{ URL::to('/favourites') }}"><i class="dwg-heart opacity-60 mr-2"></i>{{ Helper::translation(2929,$translate) }}</a>
                  <a class="dropdown-item d-flex align-items-center" href="{{ URL::to('/withdrawal') }}"><i class="dwg-currency-exchange opacity-60 mr-2"></i>{{ Helper::translation(2933,$translate) }}</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item d-flex align-items-center" href="{{ url('/logout') }}"><i class="dwg-sign-out opacity-60 mr-2"></i>{{ Helper::translation(3023,$translate) }}</a>
                  @endif
                  @if(Auth::user()->user_type == 'admin')
                  <a class="dropdown-item d-flex align-items-center" href="{{ url('/admin') }}"><i class="dwg-settings opacity-60 mr-2"></i>{{ Helper::translation(3022,$translate) }}</a>
                  <a class="dropdown-item d-flex align-items-center" href="{{ url('/logout') }}"><i class="dwg-sign-out opacity-60 mr-2"></i>{{ Helper::translation(3023,$translate) }}</a>
                  @endif
                </div>
              </div>
              @endif
              <div class="navbar-tool dropdown ml-3"><a class="navbar-tool-icon-box bg-secondary dropdown-toggle" href="{{ url('/cart') }}"><span class="navbar-tool-label">{{ $cartcount }}</span><i class="navbar-tool-icon dwg-cart"></i></a>
                <!-- Cart dropdown-->
                @if($cartcount != 0)
                <div class="dropdown-menu dropdown-menu-right" style="width: 20rem;">
                  <div class="widget widget-cart px-3 pt-2 pb-3">
                    <div data-simplebar data-simplebar-auto-hide="false">
                      @php $subtotall = 0; @endphp
                      @foreach($cartitem['item'] as $cart)
                      <div class="widget-cart-item pb-2 mb-2 border-bottom">
                        <a href="{{ url('/cart') }}/{{ base64_encode($cart->ord_id) }}" class="close text-danger" onClick="return confirm('{{ Helper::translation(2892,$translate) }}');"><span aria-hidden="true">&times;</span></a>
                        <div class="media align-items-center"><a class="d-block mr-2" href="{{ url('/item') }}/{{ $cart->item_slug }}">
                          @if($cart->item_thumbnail!='')
                          <img width="64" src="{{ url('/') }}/public/storage/items/{{ $cart->item_thumbnail }}" alt="{{ $cart->item_name }}"/>
                          @else
                          <img width="64" src="{{ url('/') }}/public/img/no-image.png" alt="{{ $cart->item_name }}"/>
                          @endif
                        </a>
                        <div class="media-body">
                          <h6 class="widget-product-title"><a href="{{ url('/item') }}/{{ $cart->item_slug }}">{{ substr($cart->item_name,0,20).'...' }}</a></h6>
                          <div class="widget-product-meta"><span class="text-accent mr-2">{{ $allsettings->site_currency_symbol }} {{ $cart->item_price }}</span></div>
                        </div>
                      </div>
                    </div>
                    @php $subtotall += $cart->item_price; @endphp
                    @endforeach
                  </div>
                  <div class="d-flex flex-wrap justify-content-between align-items-center py-3">
                    <div class="font-size-sm mr-2 py-2"><span class="text-muted">{{ Helper::translation(2896,$translate) }}:</span><span class="text-accent font-size-base ml-1">{{ $allsettings->site_currency_symbol }} {{ $subtotall }}</span></div><a class="btn btn-outline-secondary btn-sm" href="{{ url('/cart') }}">{{ Helper::translation(3021,$translate) }}<i class="dwg-arrow-right ml-1 mr-n1"></i></a></div><a class="btn btn-primary btn-sm btn-block" href="{{ url('/checkout') }}"><i class="dwg-card mr-2 font-size-base align-middle"></i>{{ Helper::translation(2899,$translate) }}</a>
                  </div>
                </div>
                @endif
              </div>
            </div>
            <div class="collapse navbar-collapse mr-auto order-lg-2" id="navbarCollapse">
              <!-- Search-->
              <div class="input-group-overlay d-lg-none my-3">
                <div class="input-group-prepend-overlay"><span class="input-group-text"><i class="dwg-search"></i></span></div>
                <form action="{{ route('shop') }}" id="search_form1" method="post"  enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <input class="form-control prepended-form-control" type="text" name="product_item" placeholder="{{ Helper::translation(3030,$translate) }}">
                </form>
              </div>
              <!-- Primary menu-->
              <ul class="navbar-nav">
                <li class="nav-item dropdown"><a class="nav-link" href="{{ URL::to('/') }}">{{ Helper::translation(2862,$translate) }}</a>
                </li>
              </li>
              <li class="nav-item dropdown"><a class="nav-link" href="{{ url('/photographers') }}"> Photographers</a></li>              
              <li class="nav-item dropdown"><a class="nav-link" href="
                /"> Mint A Token</a></li>
                <!--  <li class="nav-item dropdown"><a class="nav-link" href="{{ url('/top-authors') }}">{{ Helper::translation(3028,$translate) }}</a></li> -->
              </ul>
            </div>
          </div>
        </div>
        <!-- Search collapse-->
        <div class="search-box collapse" id="searchBox" style="display:hide;">
          <div class="card pt-2 pb-4 border-0 rounded-0">
            <div class="container">
              <div class="input-group-overlay">
                <div class="input-group-prepend-overlay"><span class="input-group-text"><i class="dwg-search"></i></span></div>
                <form action="{{ route('shop') }}" id="search_form2" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <input class="form-control prepended-form-control" type="text" name="product_item" id="product_item_top" placeholder="{{ Helper::translation(3030,$translate) }} jhjh ">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>