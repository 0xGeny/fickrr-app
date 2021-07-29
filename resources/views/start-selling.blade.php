@if($allsettings->maintenance_mode == 0)
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>
@if($allsettings->site_selling_display == 1) 
@if(Auth::guest())
{{ Helper::translation(3018,$translate) }}
@else
@if(Auth::user()->user_type == 'vendor')
{{ Helper::translation(3018,$translate) }}
@else
{{ Helper::translation(2860,$translate) }} 
@endif
@endif 
@else 
{{ Helper::translation(2860,$translate) }} 
@endif - {{ $allsettings->site_title }}
</title>
@include('meta')
@include('style')
</head>
<body>
@include('header')
@if($allsettings->site_selling_display == 1)
@if(Auth::guest())
@include('selling')
@else
@if(Auth::user()->user_type == 'vendor')
@include('selling')
@else
@include('not-found')
@endif
@endif
@else
@include('not-found')
@endif
@include('footer')
@include('script')
</body>
</html>
@else
@include('503')
@endif