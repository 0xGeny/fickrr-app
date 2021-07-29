@if($allsettings->maintenance_mode == 0)
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>{{ Helper::translation(3015,$translate) }} - {{ $allsettings->site_title }}</title>
@include('meta')
@include('style')
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
              <li class="breadcrumb-item text-nowrap active" aria-current="page">{{ Helper::translation(3015,$translate) }}</li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 mb-0 text-white">{{ Helper::translation(3015,$translate) }}</h1>
        </div>
      </div>
      </div>
    </section>
<div class="container py-4 py-lg-5 my-4">
      <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
          <div class="card py-2 mt-4">
            <form method="POST" action="{{ route('reset') }}"  id="login_form" class="card-body needs-validation">
               @csrf 
               <input type="hidden" name="user_token" value="{{ $token }}">
              <div class="form-group">
                <label for="recover-email">{{ Helper::translation(3113,$translate) }}</label>
               <div class="password-toggle">
                    <input class="form-control prepended-form-control" type="password" name="password" placeholder="{{ Helper::translation(3113,$translate) }}" data-bvalidator="required">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <label class="password-toggle-btn">
                      <input class="custom-control-input" type="checkbox"><i class="dwg-eye password-toggle-indicator"></i><span class="sr-only">{{ Helper::translation(4866,$translate) }}</span>
                    </label>
                  </div>
              </div>
              <div class="form-group">
                 <label for="pass">{{ Helper::translation(3114,$translate) }}</label>
                 <div class="password-toggle">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ Helper::translation(3243,$translate) }}" data-bvalidator="required">
                    <label class="password-toggle-btn">
                      <input class="custom-control-input" type="checkbox"><i class="dwg-eye password-toggle-indicator"></i><span class="sr-only">{{ Helper::translation(4866,$translate) }}</span>
                    </label>
                  </div>
                 </div>
              <button class="btn btn-primary" type="submit">{{ Helper::translation(3012,$translate) }}</button>
            </form>
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