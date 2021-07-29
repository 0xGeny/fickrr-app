@if($allsettings->maintenance_mode == 0)
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>@if(Auth::user()->user_type == 'vendor') {{ Helper::translation(2930,$translate) }} @else {{ Helper::translation(2860,$translate) }} @endif - {{ $allsettings->site_title }}</title>
@include('meta')
@include('style')
</head>
<body>
@include('header')
@if($addition_settings->subscription_mode == 0)
	@include('my-sale')
@else
	@if(Auth::user()->user_type == 'vendor')
        @if(Auth::user()->user_subscr_date >= date('Y-m-d'))
            @include('my-sale')
        @else
            @include('expired')
        @endif
   @else
        @include('not-found')
   @endif
@endif
@include('footer')
@include('script')
</body>
</html>
@else
@include('503')
@endif