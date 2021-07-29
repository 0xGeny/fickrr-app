@if($allsettings->maintenance_mode == 0)
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>{{ Helper::translation(3024,$translate) }} - {{ $allsettings->site_title }}</title>
@include('meta')
@include('style')
</head>
<body>
@include('header')
<?php /*?>@if($addition_settings->subscription_mode == 0)
	@include('my-purchase')
@else
	@if(Auth::user()->user_type == 'vendor')
        @if(Auth::user()->user_subscr_date >= date('Y-m-d'))
            @include('my-purchase')
        @else
            @include('expired')
        @endif
   @elseif(Auth::user()->user_type == 'customer')
        @include('my-purchase')
   @else
        @include('not-found')
   @endif
@endif<?php */?>
@if($addition_settings->subscription_mode == 0)
	@include('my-purchase')
@else
	@if(Auth::user()->user_type == 'vendor')
        @include('my-purchase')
   @elseif(Auth::user()->user_type == 'customer')
        @include('my-purchase')
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