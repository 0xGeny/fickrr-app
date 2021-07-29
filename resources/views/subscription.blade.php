@if($allsettings->maintenance_mode == 0)
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>{{ Helper::translation(6105,$translate) }} - {{ $allsettings->site_title }}</title>
@include('meta')
@include('style')
</head>
<body>
@include('header')
@if($addition_settings->subscription_mode == 1)
<section class="bg-position-center-top" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_banner }}');">
      <div class="py-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-star">
              <li class="breadcrumb-item"><a class="text-nowrap" href="{{ URL::to('/') }}"><i class="dwg-home"></i>{{ Helper::translation(2862,$translate) }}</a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page">{{ Helper::translation(6105,$translate) }}</li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 mb-0 text-white">{{ Helper::translation(6105,$translate) }}</h1>
        </div>
      </div>
      </div>
    </section>
<div class="faq-section section-padding">
		<div class="container py-5 mt-md-2 mb-2">
            <div class="row">
                <div class="col-lg-12" data-aos="fade-up" data-aos-delay="200">
                  @if($addition_settings->subscription_title != "")
                  <h1>{{ $addition_settings->subscription_title }}</h1>
                  @endif
                  @if($addition_settings->subscription_desc != "")
                  <div class="font-size-md">@php echo html_entity_decode($addition_settings->subscription_desc); @endphp</div>
                  @endif
                 </div>
              </div>
			<div class="row">
                @foreach($subscription['view'] as $subscription)
 				<div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
 					<div class="single-price-item wow fadeInLeft" data-wow-delay=".3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
 						<h5>{{ $subscription->subscr_name }}</h5>
 						<div class="price-box">
 							<p><b>{{ $allsettings->site_currency_symbol }}{{ $subscription->subscr_price }}</b>/ {{ $subscription->subscr_duration }}</p>
 						</div>
                        <hr>
 						<div class="price-list">
 							<ul>
                                @if($subscription->subscr_item_level == 'limited')
 								<li><i class="fa fa-check" aria-hidden="true"></i> {{ $subscription->subscr_item }} {{ Helper::translation(5442,$translate) }}</li>
                                @else
                                <li><i class="fa fa-check" aria-hidden="true"></i> {{ Helper::translation(6108,$translate) }}</li>
                                @endif
                                @if($subscription->subscr_space_level == 'limited')
 								<li><i class="fa fa-check" aria-hidden="true"></i> {{ $subscription->subscr_space }}{{ $subscription->subscr_space_type }} {{ Helper::translation(6111,$translate) }}</li>
                                @else
                                <li><i class="fa fa-check" aria-hidden="true"></i> {{ Helper::translation(6114,$translate) }}</li>
                                @endif
								<li>@if($subscription->subscr_email_support == 1)<i class="fa fa-check" aria-hidden="true"></i>@else<i class="fa fa-times" aria-hidden="true"></i>@endif {{ Helper::translation(6117,$translate) }}</li>										
								<li>@if($subscription->subscr_payment_mode == 1)<i class="fa fa-check" aria-hidden="true"></i>@else<i class="fa fa-times" aria-hidden="true"></i>@endif {{ Helper::translation(6120,$translate) }}</li>
								<li>@if($subscription->subscr_payment_mode == 1)<i class="fa fa-check" aria-hidden="true"></i> {{ Helper::translation(6126,$translate) }}@else<i class="fa fa-times" aria-hidden="true"></i> {{ Helper::translation(6126,$translate) }}@endif</li>
								<li><i class="fa fa-check" aria-hidden="true"></i> {{ Helper::translation(6129,$translate) }}</li>
 							</ul>
 						</div>
 						@if(Auth::guest())																			
						<a href="{{ URL::to('/login') }}" class="main-btn small-btn">
						<span>{{ Helper::translation(6132,$translate) }}</span> <i class="fa fa-caret-right" aria-hidden="true"></i>
						</a>
                        @else
                        @if(Auth::user()->id != 1)
                        <?php /*?>@if(Auth::user()->user_subscr_date < date('Y-m-d'))<?php */?>
                        <a href="{{ URL::to('/confirm-subscription') }}/{{ base64_encode($subscription->subscr_id) }}" class="main-btn small-btn">
						<span>{{ Helper::translation(6132,$translate) }}</span> <i class="fa fa-caret-right" aria-hidden="true"></i>
						</a>
                        <?php /*?>@endif<?php */?>
                        @endif
                        @endif
 					</div>
 				</div>
 				@endforeach	
 			</div>
		</div>
	</div>
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