@if($allsettings->maintenance_mode == 0)
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>{{ Helper::translation(2899,$translate) }} - {{ $allsettings->site_title }}</title>
@include('meta')
@include('style')
</head>
<body>
@include('header')
<div class="page-title-overlap pt-4" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_banner }}');">
      <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-star">
              <li class="breadcrumb-item"><a class="text-nowrap" href="{{ URL::to('/') }}"><i class="dwg-home"></i>{{ Helper::translation(2862,$translate) }}</a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page">{{ Helper::translation(2899,$translate) }}</li>
              </li>
             </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 mb-0 text-white">{{ Helper::translation(2899,$translate) }}</h1>
        </div>
      </div>
    </div>
<div class="container mb-5 pb-3">
      <div class="bg-light box-shadow-lg rounded-lg overflow-hidden">
        <div class="row">
         
          <!-- Content-->
          @if($cart_count != 0)
          <section class="col-lg-8 pt-2 pt-lg-4 pb-4 mb-3">
          <form action="{{ route('checkout') }}" class="needs-validation" id="checkout_form" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="pt-2 px-4 pr-lg-0 pl-xl-5">
             <input type="hidden" name="order_firstname" value="{{ Auth::user()->name }}"> 
             <input type="hidden" name="order_email" value="{{ Auth::user()->email }}">
             <div class="widget mb-3 d-lg-none">
                <h2 class="widget-title">{{ Helper::translation(2900,$translate) }}</h2>
                @php 
                $subtotal = 0;
                $order_id = '';
                $item_price = '';
                $item_userid = '';
                $item_user_type = '';
                $commission = 0;
                $vendor_amount = 0;
                $single_price = 0;
                $coupon_code = ""; 
                $new_price = 0;
                @endphp
                @foreach($cart['item'] as $cart)
                <div class="media align-items-center pb-2 border-bottom">
                <a class="d-block mr-2" href="{{ url('/item') }}/{{ $cart->item_slug }}">
                @if($cart->item_thumbnail!='')
                <img class="rounded-sm" width="64" src="{{ url('/') }}/public/storage/items/{{ $cart->item_thumbnail }}" alt="{{ $cart->item_name }}"/>
                @else
                <img class="rounded-sm" width="64" src="{{ url('/') }}/public/img/no-image.png" alt="{{ $cart->item_name }}"/>
                @endif
                </a>
                  <div class="media-body pl-1">
                    <h6 class="widget-product-title"><a href="{{ url('/item') }}/{{ $cart->item_slug }}">{{ $cart->item_name }}</a></h6>
                    <div class="widget-product-meta"><span class="text-accent border-right pr-2 mr-2">{{ $allsettings->site_currency_symbol }} {{ $cart->item_price }}</span><span class="font-size-xs text-muted">{{ $cart->license }}@if($cart->license == 'regular') ({{ Helper::translation(2890,$translate) }}) @elseif($cart->license == 'extended') ({{ Helper::translation(2891,$translate) }}) @endif</span></div>
                  </div>
                </div>
                @php 
                $subtotal += $cart->item_price;
                $order_id .= $cart->ord_id.',';
                $item_price .= $cart->item_price.','; 
                $item_userid .= $cart->item_user_id.','; 
                $item_user_type .= $cart->exclusive_author; 
                $amount_price = $subtotal;
                $single_price = $cart->item_price;
                if($cart->discount_price != 0)
                {
                    $price = $cart->discount_price;
                    $new_price += $cart->discount_price;
                    $coupon_code = $cart->coupon_code;
                }
                else
                {
                   $price = $cart->item_price;
                   $new_price += $cart->item_price;
                   $coupon_code = "";
                }
				if($item_user_type == 1)
                {
                   $commission +=($price * $allsettings->site_exclusive_commission) / 100;
                }
                else
                {
                   $commission +=($price * $allsettings->site_non_exclusive_commission) / 100;
                }
                @endphp
                @endforeach
                <ul class="list-unstyled font-size-sm py-3">
                @if($allsettings->site_extra_fee != 0)
                  <li class="d-flex justify-content-between align-items-center"><span class="mr-2">{{ Helper::translation(2901,$translate) }}</span><span class="text-right">{{ $allsettings->site_currency_symbol }} {{ $allsettings->site_extra_fee }}</span></li>
                  @endif
                  @if($coupon_code != "")
                  @php 
                  $coupon_discount = $subtotal - $new_price;
                  $final = $new_price + $allsettings->site_extra_fee;
                  $last_price =  $new_price;
                  $priceamount = $new_price;
                  @endphp
                  <li class="d-flex justify-content-between align-items-center font-size-base"><span class="mr-2">{{ Helper::translation(2895,$translate) }}</span><span class="text-right">{{ $coupon_discount }} {{ $allsettings->site_currency }}</span></li>
                  @else
                  @php 
                  $final = $subtotal+$allsettings->site_extra_fee; 
                  $last_price =  $subtotal;
                  $priceamount = $subtotal;
                  @endphp
                  @endif 
                  <li class="d-flex justify-content-between align-items-center font-size-base"><span class="mr-2">{{ Helper::translation(2896,$translate) }}</span><span class="text-right">{{ $allsettings->site_currency_symbol }} {{ $final }}</span></li>
                </ul>
                @php
                $vendor_amount = $priceamount - $commission;
                @endphp
                <input type="hidden" name="order_id" value="{{ rtrim($order_id,',') }}">
                <input type="hidden" name="item_prices" value="{{ base64_encode(rtrim($item_price,',')) }}">
                <input type="hidden" name="item_user_id" value="{{ rtrim($item_userid,',') }}">
                <input type="hidden" name="amount" value="{{ base64_encode($last_price) }}">
                <input type="hidden" name="processing_fee" value="{{ base64_encode($allsettings->site_extra_fee) }}">
                <input type="hidden" name="website_url" value="{{ url('/') }}">
                <input type="hidden" name="admin_amount" value="{{ base64_encode($commission) }}">
                <input type="hidden" name="vendor_amount" value="{{ base64_encode($vendor_amount) }}">
                <input type="hidden" name="token" class="token">
                <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}">
               </div>
              <div class="accordion mb-2" id="payment-method" role="tablist">
                @php $no = 1; @endphp
                @foreach($get_payment as $payment)
                @php 
                if($payment == '2checkout')
                {
                $payment = 'twocheckout';
                }
                else
                {
                $payment = $payment;
                }
                @endphp
                <div class="card">
                  <div class="card-header" role="tab">
                    <h3 class="accordion-heading"><a href="#{{ $payment }}" id="{{ $payment }}" data-toggle="collapse">{{ Helper::translation(4899,$translate) }} @if($payment == 'twocheckout') {{ Helper::translation(4902,$translate) }} @else {{ $payment }} @endif<span class="accordion-indicator"><i data-feather="chevron-up"></i></span></a></h3>
                  </div>
                  <div class="collapse @if($no == 1) show @endif" id="{{ $payment }}" data-parent="#payment-method" role="tabpanel">
                  @if($payment == 'paypal')
                    <div class="card-body font-size-sm custom-control custom-radio">
                      <p><span class='font-weight-medium'><input id="opt1-{{ $payment }}" name="payment_method" type="radio" class="custom_radio" value="{{ $payment }}" @if($no == 1) checked @endif data-bvalidator="required"> {{ Helper::translation(5937,$translate) }}</span> - {{ Helper::translation(4905,$translate) }}</p>
                      <button class="btn btn-primary" type="submit">{{ Helper::translation(4908,$translate) }}</button>
                    </div>
                    @endif
                  @if($payment == 'stripe')
                    <div class="card-body font-size-sm custom-radio custom-control">
                      <p><span class='font-weight-medium'><input id="opt1-{{ $payment }}" name="payment_method" type="radio" class="custom_radio"  value="{{ $payment }}" @if($no == 1) checked @endif data-bvalidator="required"> {{ Helper::translation(5940,$translate) }}</span> - {{ Helper::translation(2903,$translate) }}</p>
                      <div class="stripebox mb-3" id="ifYes" style="display:none;">
                        <label for="card-element">{{ Helper::translation(2903,$translate) }}</label>
                        <div id="card-element"></div>
                        <div id="card-errors" role="alert"></div>
                      </div>
                      <button class="btn btn-primary" type="submit">{{ Helper::translation(4911,$translate) }}</button>
                    </div> 
                    @endif
                    @if($payment == 'wallet')
                    <div class="card-body font-size-sm custom-control custom-radio">
                      <p><span class='font-weight-medium'><input id="opt1-{{ $payment }}" name="payment_method" type="radio" class="custom_radio" value="{{ $payment }}" @if($no == 1) checked @endif data-bvalidator="required"> {{ Helper::translation(5943,$translate) }}</span> - ({{ $allsettings->site_currency }} {{ Auth::user()->earnings }})</p>
                      <button class="btn btn-primary" type="submit">{{ Helper::translation(4914,$translate) }}</button>
                    </div>
                    @endif
                    @if($payment == 'twocheckout')
                    <div class="card-body font-size-sm custom-control custom-radio">
                      <p><span class='font-weight-medium'><input id="opt1-{{ $payment }}" name="payment_method" type="radio" class="custom_radio" value="{{ $payment }}" @if($no == 1) checked @endif data-bvalidator="required"> {{ Helper::translation(4902,$translate) }}</span></p>
                      <button class="btn btn-primary" type="submit">{{ Helper::translation(4917,$translate) }}</button>
                    </div>
                    @endif
                    @if($payment == 'paystack')
                    <div class="card-body font-size-sm custom-control custom-radio">
                      <p><span class='font-weight-medium'><input id="opt1-{{ $payment }}" name="payment_method" type="radio" class="custom_radio" value="{{ $payment }}" @if($no == 1) checked @endif data-bvalidator="required"> {{ Helper::translation(5946,$translate) }}</span></p>
                      <button class="btn btn-primary" type="submit">{{ Helper::translation(4920,$translate) }}</button>
                    </div>
                    @endif
                    @if($payment == 'localbank')
                    <div class="card-body font-size-sm custom-control custom-radio">
                      <p><span class='font-weight-medium'><input id="opt1-{{ $payment }}" name="payment_method" type="radio" class="custom_radio" value="{{ $payment }}" @if($no == 1) checked @endif data-bvalidator="required"> {{ Helper::translation(5949,$translate) }}</span></p>
                      <button class="btn btn-primary" type="submit">{{ Helper::translation(4923,$translate) }}</button>
                    </div>
                    @endif
                    @if($payment == 'razorpay')
                    <div class="card-body font-size-sm custom-control custom-radio">
                      <p><span class='font-weight-medium'><input id="opt1-{{ $payment }}" name="payment_method" type="radio" class="custom_radio" value="{{ $payment }}" @if($no == 1) checked @endif data-bvalidator="required"> {{ __('Razorpay') }}</span></p>
                      <button class="btn btn-primary" type="submit">Checkout with Razorpay</button>
                    </div>
                    @endif
                    @if($payment == 'payhere')
                    <div class="card-body font-size-sm custom-control custom-radio">
                      <p><span class='font-weight-medium'><input id="opt1-{{ $payment }}" name="payment_method" type="radio" class="custom_radio" value="{{ $payment }}" @if($no == 1) checked @endif data-bvalidator="required"> {{ __('Payhere') }}</span></p>
                      <button class="btn btn-primary" type="submit">Checkout with Payhere</button>
                    </div>
                    @endif
                    @if($payment == 'payumoney')
                    <div class="card-body font-size-sm custom-control custom-radio">
                      <p><span class='font-weight-medium'><input id="opt1-{{ $payment }}" name="payment_method" type="radio" class="custom_radio" value="{{ $payment }}" @if($no == 1) checked @endif data-bvalidator="required"> {{ __('Payumoney') }}</span></p>
                      <button class="btn btn-primary" type="submit">Checkout with Payumoney</button>
                    </div>
                    @endif
                  </div>
                </div>
                @php $no++; @endphp
                @endforeach
              </div>
            </div>
            </form>
          </section>
          <aside class="col-lg-4 d-none d-lg-block">
            <hr class="d-lg-none">
            <div class="cz-sidebar-static h-100 ml-auto border-left">
              <div class="widget mb-3">
                <h2 class="widget-title text-center">{{ Helper::translation(2900,$translate) }}</h2>
                @php 
                $subtotal = 0;
                $order_id = '';
                $item_price = '';
                $item_userid = '';
                $item_user_type = '';
                $commission = 0;
                $vendor_amount = 0;
                $single_price = 0;
                $coupon_code = ""; 
                $new_price = 0;
                @endphp
                @foreach($mobile['item'] as $cart)
                <div class="media align-items-center pb-3 mb-3 border-bottom">
                <a class="d-block mr-2" href="{{ url('/item') }}/{{ $cart->item_slug }}">
                @if($cart->item_thumbnail!='')
                <img class="rounded-sm" width="64" src="{{ url('/') }}/public/storage/items/{{ $cart->item_thumbnail }}" alt="{{ $cart->item_name }}"/>
                @else
                <img class="rounded-sm" width="64" src="{{ url('/') }}/public/img/no-image.png" alt="{{ $cart->item_name }}"/>
                @endif
                </a>
                  <div class="media-body pl-1">
                    <h6 class="widget-product-title"><a href="{{ url('/item') }}/{{ $cart->item_slug }}">{{ $cart->item_name }}</a></h6>
                    <div class="widget-product-meta"><span class="text-accent border-right pr-2 mr-2">{{ $allsettings->site_currency_symbol }} {{ $cart->item_price }}</span><span class="font-size-xs text-muted">{{ $cart->license }}@if($cart->license == 'regular') ({{ Helper::translation(2890,$translate) }}) @elseif($cart->license == 'extended') ({{ Helper::translation(2891,$translate) }}) @endif</span></div>
                  </div>
                </div>
                @php 
                $subtotal += $cart->item_price;
                $order_id .= $cart->ord_id.',';
                $item_price .= $cart->item_price.','; 
                $item_userid .= $cart->item_user_id.','; 
                $item_user_type .= $cart->exclusive_author; 
                $amount_price = $subtotal;
                $single_price = $cart->item_price;
                if($cart->discount_price != 0)
                {
                    $price = $cart->discount_price;
                    $new_price += $cart->discount_price;
                    $coupon_code = $cart->coupon_code;
                }
                else
                {
                   $price = $cart->item_price;
                   $new_price += $cart->item_price;
                   $coupon_code = "";
                }
				if($item_user_type == 1)
                {
                   $commission +=($price * $allsettings->site_exclusive_commission) / 100;
                }
                else
                {
                   $commission +=($price * $allsettings->site_non_exclusive_commission) / 100;
                }
                @endphp
                @endforeach
                <ul class="list-unstyled font-size-sm pt-3 pb-2 border-bottom">
                @if($allsettings->site_extra_fee != 0)
                  <li class="d-flex justify-content-between align-items-center"><span class="mr-2">{{ Helper::translation(2901,$translate) }}</span><span class="text-right">{{ $allsettings->site_currency_symbol }} {{ $allsettings->site_extra_fee }}</span></li>
                  @endif
                  @if($coupon_code != "")
                  @php 
                  $coupon_discount = $subtotal - $new_price;
                  $final = $new_price + $allsettings->site_extra_fee;
                  $last_price =  $new_price;
                  $priceamount = $new_price;
                  @endphp
                  <li class="d-flex justify-content-between align-items-center"><span class="mr-2">{{ Helper::translation(2895,$translate) }}</span><span class="text-right">{{ $coupon_discount }} {{ $allsettings->site_currency }}</span></li>
                  @else
                  @php 
                  $final = $subtotal+$allsettings->site_extra_fee; 
                  $last_price =  $subtotal;
                  $priceamount = $subtotal;
                  @endphp
                  @endif 
                  <h3 class="font-weight-normal text-center my-4">{{ $allsettings->site_currency_symbol }} {{ $final }}</h3>
                  </ul>
               </div>
            </div>
          </aside>
          @else
          <section class="col-lg-12 pt-2 pt-lg-4 pb-4 mb-3">
          <div class="pt-2 px-4 pr-lg-0 pl-xl-5">
          <div class="col-lg-12" data-aos="fade-up" data-aos-delay="200">
          <div class="font-size-md">{{ Helper::translation(2898,$translate) }}</div>
          </div>
          </div>
          </section>
          @endif
        </div>
      </div>
    </div>
@include('footer')
@include('script')
</body>
</html>
@else
@include('503')
@endif