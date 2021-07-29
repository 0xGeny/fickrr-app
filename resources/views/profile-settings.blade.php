@if($allsettings->maintenance_mode == 0)
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>@if(Auth::user()->id != 1) {{ Helper::translation(3109,$translate) }} @else {{ Helper::translation(2860,$translate) }} @endif  - {{ $allsettings->site_title }}</title>
@include('meta')
@include('style')
</head>
<body>
@include('header')
@if($addition_settings->subscription_mode == 0)
	@include('profile')
@else
	@if(Auth::user()->user_type == 'vendor')
        @include('profile')
   @elseif(Auth::user()->user_type == 'customer')
        @include('profile')
   @else
        @include('not-found')
   @endif
@endif
<?php /*?>@if($addition_settings->subscription_mode == 0)
	@include('profile')
@else
	@if(Auth::user()->user_type == 'vendor')
        @if(Auth::user()->user_subscr_date >= date('Y-m-d'))
            @include('profile')
        @else
            @include('expired')
        @endif
   @elseif(Auth::user()->user_type == 'customer')
        @include('profile')
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