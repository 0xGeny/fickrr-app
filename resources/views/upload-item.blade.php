@if($allsettings->maintenance_mode == 0)
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>@if(Auth::user()->user_type == 'vendor') {{ Helper::translation(2931,$translate) }} @else {{ Helper::translation(2860,$translate) }} @endif - {{ $allsettings->site_title }}</title>
@include('meta')
@include('style')
</head>
<body>
@include('header')
@if($addition_settings->subscription_mode == 0)
	@include('upload-my-item')
@else
	@if(Auth::user()->user_type == 'vendor')
        @if(Auth::user()->user_subscr_date >= date('Y-m-d'))
            @include('upload-my-item')
        @else
            @include('expired')
        @endif
   @else
        @include('not-found')
   @endif
@endif
@include('footer')
@include('script')
<script type="text/javascript">
	$(document).ready(function(){
	'use strict';
	$("#mp4").hide();
	$("#youtube").hide();	
	$('#video_preview_type').on('change', function() {
      if ( this.value == 'youtube')
      
      {
	     $("#youtube").show();
		 $("#mp4").hide();
	  }	
	  else if ( this.value == 'mp4')
	  {
	     $("#mp4").show();
		 $("#youtube").hide();
	  }
	  else
	  {
	      $("#mp4").hide();
		  $("#youtube").hide();
	  }
	  
	 });
});
</script>
@include('upload-size')
</body>
</html>
@else
@include('503')
@endif