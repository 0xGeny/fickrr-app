<!DOCTYPE html>
<html>
    <head>
        @if($allsettings->site_favicon != '')
        <link rel="apple-touch-icon" href="{{ url('/') }}/public/storage/settings/{{ $allsettings->site_favicon }}">
        <link rel="shortcut icon" href="{{ url('/') }}/public/storage/settings/{{ $allsettings->site_favicon }}">
        @endif
        <title>{{ $allsettings->m_mode_title }}</title>
        <link rel="stylesheet" href="{{ asset('public/assets/css/503.css') }}">
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">{{ $allsettings->m_mode_content }}</div>
            </div>
        </div>
    </body>
</html>