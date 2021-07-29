<aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                @if($allsettings->site_logo != '')
                <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ url('/') }}/public/storage/settings/{{ $allsettings->site_logo }}"  alt="{{ $allsettings->site_title }}" width="180"/></a>
                @else
                <a class="navbar-brand" href="{{ url('/') }}">{{ substr($allsettings->site_title,0,10) }}</a>
                @endif
                @if($allsettings->site_favicon != '')
                <a class="navbar-brand hidden" href="{{ url('/') }}"><img src="{{ url('/') }}/public/storage/settings/{{ $allsettings->site_favicon }}"  alt="{{ $allsettings->site_title }}" width="24"/></a>
                @else
                <a class="navbar-brand hidden" href="{{ url('/') }}">{{ substr($allsettings->site_title,0,1) }}</a>
                @endif
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    @if(in_array('dashboard',$avilable))
                    <li class="active">
                        <a href="{{ url('/admin') }}"> <i class="menu-icon fa fa-dashboard"></i>{{ Helper::translation(5421,$translate) }} </a>
                    </li>
                    @endif
                    @if(in_array('settings',$avilable))
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-gears"></i>{{ Helper::translation(5406,$translate) }}</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-gear"></i><a href="{{ url('/admin/general-settings') }}">{{ Helper::translation(5283,$translate) }}</a></li>
                            <li><i class="fa fa-gear"></i><a href="{{ url('/admin/color-settings') }}">{{ Helper::translation(5154,$translate) }}</a></li>
                            <li><i class="fa fa-gear"></i><a href="{{ url('/admin/currency-settings') }}">{{ Helper::translation(5187,$translate) }}</a></li>
                            <li><i class="fa fa-gear"></i><a href="{{ url('/admin/country-settings') }}">{{ Helper::translation(5181,$translate) }}</a></li>
                            <li><i class="fa fa-gear"></i><a href="{{ url('/admin/email-settings') }}">{{ Helper::translation(3130,$translate) }}</a></li>
                            <li><i class="fa fa-gear"></i><a href="{{ url('/admin/media-settings') }}">{{ Helper::translation(5565,$translate) }}</a></li>
                            <li><i class="fa fa-gear"></i><a href="{{ url('/admin/badges-settings') }}">{{ Helper::translation(5076,$translate) }}</a></li>
                            <li><i class="fa fa-gear"></i><a href="{{ url('/admin/payment-settings') }}">{{ Helper::translation(5604,$translate) }}</a></li>
                            <li><i class="fa fa-gear"></i><a href="{{ url('/admin/social-settings') }}">{{ Helper::translation(5607,$translate) }}</a></li>
                            <li><i class="fa fa-gear"></i><a href="{{ url('/admin/limitation-settings') }}">{{ Helper::translation(5493,$translate) }}</a></li>
                            <li><i class="fa fa-gear"></i><a href="{{ url('/admin/preferred-settings') }}">{{ Helper::translation(5610,$translate) }}</a></li>
                        </ul>
                    </li>
                   @endif
                   @if(Auth::user()->id == 1) 
                   <li class="menu-item-has-children dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i>{{ Helper::translation(5613,$translate) }}</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-user"></i><a href="{{ url('/admin/administrator') }}">{{ Helper::translation(5058,$translate) }}</a></li>
                            <li><i class="fa fa-user"></i><a href="{{ url('/admin/customer') }}">{{ Helper::translation(5196,$translate) }}</a></li>
                            <li><i class="fa fa-user"></i><a href="{{ url('/admin/vendor') }}">{{ Helper::translation(5616,$translate) }}</a></li>
                         </ul>
                    </li>
                    @endif                   
                    @if(in_array('items',$avilable)) 
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-location-arrow"></i>{{ Helper::translation(5442,$translate) }}</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-location-arrow"></i><a href="{{ url('/admin/category') }}">{{ Helper::translation(3084,$translate) }}</a></li>
                            <li><i class="menu-icon fa fa-location-arrow"></i><a href="{{ url('/admin/sub-category') }}">{{ Helper::translation(5052,$translate) }}</a></li>
                            <li><i class="menu-icon fa fa-location-arrow"></i><a href="{{ url('/admin/items') }}">{{ Helper::translation(5442,$translate) }}</a></li>
                            <li><i class="menu-icon fa fa-location-arrow"></i><a href="{{ url('/admin/item-type') }}">{{ Helper::translation(2937,$translate) }}</a></li>
                            <li><i class="menu-icon fa fa-location-arrow"></i><a href="{{ url('/admin/attributes') }}">{{ Helper::translation(5067,$translate) }}</a></li>
                            <li><i class="menu-icon fa fa-location-arrow"></i><a href="{{ url('/admin/orders') }}">{{ Helper::translation(5619,$translate) }}</a></li>
                        </ul>
                    </li>
                    @endif
                    @if(in_array('subscription',$avilable))
                    @if($addition_settings->subscription_mode == 1)
                    <li>
                        <a href="{{ url('/admin/subscription') }}"> <i class="menu-icon fa fa-user"></i>{{ Helper::translation(6105,$translate) }} </a>
                    </li>
                    @endif
                    @endif
                    @if(in_array('refund',$avilable))
                    <li>
                        <a href="{{ url('/admin/refund') }}"> <i class="menu-icon fa fa-paper-plane"></i>{{ Helper::translation(3143,$translate) }} </a>
                    </li>
                    @endif
                    @if(in_array('rating',$avilable))
                    <li>
                        <a href="{{ url('/admin/rating') }}"> <i class="menu-icon fa fa-star"></i>{{ Helper::translation(5622,$translate) }} </a>
                    </li>
                    @endif
                    @if(in_array('withdrawal',$avilable))
                    <li>
                        <a href="{{ url('/admin/withdrawal') }}"> <i class="menu-icon fa fa-money"></i>{{ Helper::translation(5625,$translate) }} </a>
                    </li>
                    @endif
                    @if(in_array('blog',$avilable))
                    @if($allsettings->site_blog_display == 1)
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-comments-o"></i>{{ Helper::translation(2877,$translate) }}</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-comments-o"></i><a href="{{ url('/admin/blog-category') }}">{{ Helper::translation(3084,$translate) }}</a></li>
                            <li><i class="menu-icon fa fa-comments-o"></i><a href="{{ url('/admin/post') }}">{{ Helper::translation(5628,$translate) }}</a></li>
                        </ul>
                    </li>
                    @endif
                    @endif
                    @if(in_array('pages',$avilable))
                    <li>
                        <a href="{{ url('/admin/pages') }}"> <i class="menu-icon fa fa-file-text-o"></i>{{ Helper::translation(3029,$translate) }} </a>
                    </li>
                    @endif
                    @if(in_array('features',$avilable))
                    @if($allsettings->site_features_display == 1)
                    <li>
                        <a href="{{ url('/admin/highlights') }}"> <i class="menu-icon fa fa-magic"></i>{{ Helper::translation(5409,$translate) }} </a>
                    </li>
                    @endif
                    @endif
                    @if(in_array('selling',$avilable))
                    @if($allsettings->site_selling_display == 1)
                    <li>
                        <a href="{{ url('/admin/start-selling') }}"> <i class="menu-icon fa fa-shopping-cart"></i>{{ Helper::translation(3018,$translate) }} </a>
                    </li>
                    @endif
                    @endif
                    @if(in_array('contact',$avilable))
                    <li>
                        <a href="{{ url('/admin/contact') }}"> <i class="menu-icon fa fa-address-book-o"></i>{{ Helper::translation(2910,$translate) }} </a>
                    </li>
                    @endif
                    @if(in_array('newsletter',$avilable))
                    @if($allsettings->site_newsletter_display == 1)
                    <li>
                        <a href="{{ url('/admin/newsletter') }}"> <i class="menu-icon fa fa-newspaper-o"></i>{{ Helper::translation(3005,$translate) }} </a>
                    </li>
                    @endif
                    @endif
                    @if(in_array('languages',$avilable))
                    <li>
                        <a href="{{ url('/admin/languages') }}"> <i class="menu-icon fa fa-language"></i>{{ Helper::translation(5478,$translate) }} </a>
                    </li>
                    @endif
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>