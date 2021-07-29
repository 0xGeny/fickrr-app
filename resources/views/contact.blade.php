@if($allsettings->maintenance_mode == 0)
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>{{ Helper::translation(2910,$translate) }} - {{ $allsettings->site_title }}</title>
@include('meta')
@include('style')
{!! NoCaptcha::renderJs() !!}
</head>
<body>
@include('header')
<section class="bg-position-center-top" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_banner }}');">
      <div class="py-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-star">
              <li class="breadcrumb-item"><a class="text-nowrap" href="{{ URL::to('/') }}"><i class="dwg-home"></i>{{ Helper::translation(2862,$translate) }}</a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page">{{ Helper::translation(2910,$translate) }}</li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 mb-0 text-white">{{ Helper::translation(2910,$translate) }}</h1>
        </div>
      </div>
      </div>
    </section>
   <!-- Outlet stores-->
    <div class="container px-0" id="map">
      <div class="row">
        <div class="col-lg-5 px-4 px-xl-5 py-5">
          <form method="POST" action="{{ route('contact') }}" id="contact_form"  class="needs-validation mb-3" novalidate>
          @csrf
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="cf-name">{{ Helper::translation(2917,$translate) }} <span class="text-danger">*</span></label>
                  <input class="form-control" type="text" id="from_name" name="from_name" data-bvalidator="required">
                  <div class="invalid-feedback">{{ Helper::translation(5952,$translate) }}</div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="cf-email">{{ Helper::translation(2915,$translate) }} <span class="text-danger">*</span></label>
                  <input class="form-control" type="text" id="cf-email" name="from_email" data-bvalidator="email,required">
                  <div class="invalid-feedback">{{ Helper::translation(5955,$translate) }}</div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="cf-message">{{ Helper::translation(2918,$translate) }} <span class="text-danger">*</span></label>
              <textarea class="form-control" id="cf-message" rows="6" name="message_text" data-bvalidator="required"></textarea>
              <div class="invalid-feedback">{{ Helper::translation(5958,$translate) }}</div>
            </div>
            <div class="form-group">
              <label for="cf-message">{{ Helper::translation(3244,$translate) }}<span class="text-danger">*</span></label>
              {!! app('captcha')->display() !!}
                @if ($errors->has('g-recaptcha-response'))
                  <span class="help-block">
                     <span class="red">{{ $errors->first('g-recaptcha-response') }}</span>
                  </span>
                 @endif
            </div>
            <button class="btn btn-primary" type="submit">{{ Helper::translation(2876,$translate) }}</button>
          </form>
        </div>
        <div class="col-lg-7 px-4 px-xl-5 py-5">
           <div class="row">
           <div class="col-md-6 mb-grid-gutter">
           <div class="card">
            <div class="card-body text-center"><i class="dwg-location h3 mt-2 mb-4 text-primary"></i>
              <h3 class="h6 mb-2">{{ Helper::translation(2913,$translate) }}</h3>
              <p class="font-size-sm text-muted">{{ $allsettings->office_address }}</p>
             </div>
            </div>
            </div>
            <div class="col-md-6 mb-grid-gutter"><a class="card" href="mailto:{{ $allsettings->office_email }}">
          <div class="card-body text-center"><i class="dwg-mail h3 mt-2 mb-4 text-primary"></i>
              <h3 class="h6 mb-3">{{ Helper::translation(2915,$translate) }}</h3>
              <p class="font-size-sm text-muted">{{ $allsettings->office_email }}</p>
             </div>
            </a>
          </div>
          <div class="col-md-6 mb-grid-gutter"><a class="card" href="tel:{{ $allsettings->office_phone }}">
            <div class="card-body text-center"><i class="dwg-phone h3 mt-2 mb-4 text-primary"></i>
              <h3 class="h6 mb-2">{{ Helper::translation(2914,$translate) }}</h3>
              <p class="font-size-sm text-muted">{{ $allsettings->office_phone }}</p>
            </div></a>
            </div>
          </div>
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