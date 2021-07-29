@if($allsettings->maintenance_mode == 0)
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>{{ Helper::translation(3200,$translate) }} - {{ $allsettings->site_title }}</title>
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
            <h2 class="h3 pt-2 pb-4 mb-4 text-center text-sm-left border-bottom">@if($followingcount <= 1) {{ Helper::translation(3200,$translate) }} @else {{ Helper::translation(3201,$translate) }} @endif<span class="badge badge-secondary font-size-sm text-body align-middle ml-2">{{ $followingcount }}</span></h2>
        <div class="row pt-2">
        <div class="col-lg-12 col-md-12 col-sm-12 px-2 mb-grid-gutter">
        @foreach($viewfollowing['view'] as $follower)
        <div class="d-sm-flex justify-content-between mt-lg-4 mb-4 pb-3 pb-sm-2 border-bottom prod-item" data-aos="fade-up" data-aos-delay="200">
            <div class="media media-ie-fix d-block d-sm-flex text-sm-left">
            <a href="{{ url('/user') }}/{{ $follower->username }}" class="d-inline-block mx-auto mr-sm-4" style="width: 7rem;">
            @if($follower->user_photo != '')
            <img src="{{ url('/') }}/public/storage/users/{{ $follower->user_photo }}" alt="{{ $follower->username }}" class="img-rounded">
            @else
            <img src="{{ url('/') }}/public/img/no-user.png" alt="{{ $follower->username }}" class="img-rounded">
            @endif
            </a>
              <div class="media-body pt-2">
                <h3 class="product-title font-size-base mb-2">
                 <a href="{{ url('/user') }}/{{ $follower->username }}">{{ $follower->username }} </a>
                 </h3>
                <div class="font-size-sm">{{ Helper::translation(3077,$translate) }}: {{ date("F Y", strtotime($follower->created_at))}}</div>
                <div class="font-size-sm">{{ Helper::translation(3199,$translate) }} : @if($follower->country !='') {{ $follower->country_name }} @else - @endif</div>
              </div>
            </div>
            <div class="pt-2 pl-sm-3 mx-auto mx-sm-0 text-center">
             <a href="{{ url('/user') }}/{{ $follower->username }}" class="btn btn-primary btn-sm">{{ Helper::translation(3078,$translate) }}</a>
            </div>
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