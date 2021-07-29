@if($allsettings->maintenance_mode == 0)
<!DOCTYPE html>
<html lang="en">
<head>
<title>{{ $item['item']->item_name }} - {{ $allsettings->site_title }}</title>
@if($allsettings->site_favicon != '')
<link rel="apple-touch-icon" href="{{ url('/') }}/public/storage/settings/{{ $allsettings->site_favicon }}">
<link rel="shortcut icon" href="{{ url('/') }}/public/storage/settings/{{ $allsettings->site_favicon }}">
@endif
<link rel="stylesheet" href="{{ URL::to('resources/views/theme/preview/css/bootstrap.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ URL::to('resources/views/theme/preview/css/app.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ URL::to('resources/views/theme/preview/css/style.css') }}" type="text/css" />
</head>

<body>
<div id="header-bar">
<header id="header" class="navbar navbar-fixed-top bg-white-only box-shadow"  data-spy="affix" data-offset-top="1">
<div class="navbar-header text-center">
         @if($allsettings->site_logo != '')
         <a href="{{ URL::to('/') }}" class="navbar-brand m-r-lg">
         <img src="{{ url('/') }}/public/storage/settings/{{ $allsettings->site_logo }}" alt="{{ $allsettings->site_title }}"  class="img-fluid">
         </a>
         @endif
</div>
<ul class="nav navbar-nav text-center deskonly">
<li>
     <div class="">
       <a href="{{ URL::to('/item') }}/{{ $item['item']->item_slug }}" class="btn btn-md w-sm btn-success m-r-sm m-t-xxs"><strong>{{ Helper::translation(3074,$translate) }}</strong></a>
       <a href="{{ $item['item']->demo_url }}" class="btn btn-link btn-md"><i class="fa fa-remove m-r-xs m-t-xxs"></i>{{ Helper::translation(3108,$translate) }}</a>
     </div>
</li>
</ul>  
</div>
</header>
<iframe id="preview-frame" class="w-full h-full" src="{{ $item['item']->demo_url }}" name="preview-frame" frameborder="0" noresize="noresize">
</iframe>
<!-- / footer -->
<script src="{{ URL::to('resources/views/theme/preview/js/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ URL::to('resources/views/theme/preview/js/bootstrap.js') }}"></script>
</body>
</html>
@else
@include('503')
@endif