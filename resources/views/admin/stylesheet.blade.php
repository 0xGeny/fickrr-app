@include('version')
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $allsettings->site_title }}</title>
@if($allsettings->site_favicon != '')
<link rel="apple-touch-icon" href="{{ url('/') }}/public/storage/settings/{{ $allsettings->site_favicon }}">
<link rel="shortcut icon" href="{{ url('/') }}/public/storage/settings/{{ $allsettings->site_favicon }}">
@endif
<link rel="stylesheet" href="{{ URL::to('resources/views/admin/template/vendors/bootstrap/dist/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::to('resources/views/admin/template/vendors/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ URL::to('resources/views/admin/template/vendors/themify-icons/css/themify-icons.css') }}">
<link rel="stylesheet" href="{{ URL::to('resources/views/admin/template/vendors/flag-icon-css/css/flag-icon.min.css') }}">
<link rel="stylesheet" href="{{ URL::to('resources/views/admin/template/vendors/selectFX/css/cs-skin-elastic.css') }}">
<link rel="stylesheet" href="{{ URL::to('resources/views/admin/template/vendors/jqvmap/dist/jqvmap.min.css') }}">
<link rel="stylesheet" href="{{ URL::to('resources/views/admin/template/vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ URL::to('resources/views/admin/template/vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ URL::to('resources/views/admin/template/assets/css/style.css') }}">
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="{{ URL::to('resources/views/admin/template/datepicker/picker.css') }}"> 
<link href="{{ asset('resources/views/admin/template/dragdrop/css/jquery.filer.css') }}" rel="stylesheet">