@if($allsettings->maintenance_mode == 0)
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>{{ Helper::translation(3211,$translate) }} - {{ $allsettings->site_title }}</title>
@include('meta')
@include('style')
</head>
<body>
@include('header')
@if($addition_settings->subscription_mode == 0)
	@include('my-withdrawal')
@else
	@if(Auth::user()->user_type == 'vendor')
        @include('my-withdrawal')
   @elseif(Auth::user()->user_type == 'customer')
        @include('my-withdrawal')
   @else
        @include('not-found')
   @endif
@endif
<?php /*?>@if($addition_settings->subscription_mode == 0)
	@include('my-withdrawal')
@else
	@if(Auth::user()->user_type == 'vendor')
        @if(Auth::user()->user_subscr_date >= date('Y-m-d'))
            @include('my-withdrawal')
        @else
            @include('expired')
        @endif
   @elseif(Auth::user()->user_type == 'customer')
        @include('my-withdrawal')
   @else
        @include('not-found')
   @endif
@endif<?php */?>
@include('footer')
@include('script')
</body>
</html>
@else
@include('503')
@endif