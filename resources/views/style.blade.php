@include('version')
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="author" content="{{ $allsettings->site_title }}">
@if($allsettings->site_favicon != '')
<link rel="apple-touch-icon" href="{{ url('/') }}/public/storage/settings/{{ $allsettings->site_favicon }}">
<link rel="shortcut icon" href="{{ url('/') }}/public/storage/settings/{{ $allsettings->site_favicon }}">
@endif
<link rel="stylesheet" href="{{ URL::to('resources/views/theme/validate/themes/red/red.css') }}" />
<link rel="stylesheet" href="{{ URL::to('resources/views/theme/pagination/pagination.css') }}">
<link rel="stylesheet" media="screen" href="{{ URL::to('resources/views/theme/css/vendor.min.css') }}">
<link rel="stylesheet" media="screen" href="{{ URL::to('resources/views/theme/css/theme.min.css') }}">
@include('dynamic')
<link type="text/css" href="{{ URL::to('resources/views/theme/countdown/jquery.countdown.css?v=1.0.0.0') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ URL::to('resources/views/theme/video/video.css') }}">
<link href="{{ URL::to('resources/views/theme/cookie/cookiealert.css') }}" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="{{ URL::to('resources/views/theme/animate/aos.css') }}" />
<link rel="stylesheet" href="{{ URL::to('resources/views/theme/autosearch/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ URL::to('resources/views/admin/template/datepicker/picker.css') }}">
<link href="{{ asset('resources/views/admin/template/dragdrop/css/jquery.filer.css') }}" rel="stylesheet">
@if($translate == 'ar')
<link rel="stylesheet" href="{{ URL::to('resources/views/theme/css/rtl.css') }}" />
@endif
<link rel="stylesheet" href="{{ URL::to('resources/views/theme/css/font-awesome.min.css') }}">
