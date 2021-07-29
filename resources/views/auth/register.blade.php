@if($allsettings->maintenance_mode == 0)
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>{{ Helper::translation(3233,$translate) }} - {{ $allsettings->site_title }}</title>
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
              <li class="breadcrumb-item text-nowrap active" aria-current="page">{{ Helper::translation(3233,$translate) }}</li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 mb-0 text-white">{{ Helper::translation(3233,$translate) }}</h1>
        </div>
      </div>
      </div>
    </section>
<div class="container py-4 py-lg-5 my-4">
      <div class="row">
        <div class="col-md-6 mx-auto">
          <div class="card border-0 box-shadow">
            <div class="card-body">
              <h2 class="h4 mb-3">{{ Helper::translation(3234,$translate) }}</h2>
              <p class="font-size-sm text-muted mb-4">{{ Helper::translation(3236,$translate) }}</p>
              <form method="POST" action="{{ route('register') }}" id="login_form" class="needs-validation" novalidate>
                @csrf
                <div class="row">
              <input type="hidden" name="user_type" value="customer">
              <div class="col-sm-6">
               <div class="form-group">
                <label for="email_ad">{{ Helper::translation(4827,$translate) }} <span class="required">*</span></label>
                 <select id="user_type" class="form-control" name="user_type" data-bvalidator="required" onChange="handleUserTypeChange(this.value)">
                 <option value="vendor" @if(request()->get('type')=='vendor') selected="selected" @endif>Photographer</option>
                 <option value="customer" @if(request()->get('type')=='customer') selected="selected" @endif>Buyer</option>
                </select>
                </div>
             </div>
                </div>
                <div class="row">
                <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-fn">First Name <span class="required">*</span></label>
                  <input id="name" type="text" class="form-control" name="fname" placeholder="First name" value="{{ old('fname') }}" data-bvalidator="required" autocomplete="name" autofocus>    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                       @enderror
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-fn">Last Name</label>
                  <input id="name" type="text" class="form-control" name="lname" placeholder="Last name" value="{{ old('lname') }}" autocomplete="name" autofocus>    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                       @enderror
                </div>
              </div>
              <!-- <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-fn">{{ Helper::translation(3237,$translate) }} <span class="required">*</span></label>
                  <input id="name" type="text" class="form-control" name="name" placeholder="{{ Helper::translation(3238,$translate) }}" value="{{ old('name') }}" data-bvalidator="required" autocomplete="name" autofocus>    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                       @enderror
                </div>
              </div> -->
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-ln">{{ Helper::translation(3111,$translate) }} <span class="required">*</span></label>
                  <input id="username" type="text" name="username" class="form-control" placeholder="{{ Helper::translation(3239,$translate) }}" data-bvalidator="required">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-email">{{ Helper::translation(3240,$translate) }} <span class="required">*</span></label>
                  <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{ Helper::translation(3241,$translate) }}"  autocomplete="email" data-bvalidator="email,required">
                         @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-pass">{{ Helper::translation(3113,$translate) }} <span class="required">*</span></label>
                  <div class="password-toggle">
                    <input id="password" type="password" class="form-control" name="password" placeholder="{{ Helper::translation(3242,$translate) }}" autocomplete="new-password" data-bvalidator="required">@error('password')
                        <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                       </span>
                     @enderror
                    <label class="password-toggle-btn">
                      <input class="custom-control-input" type="checkbox"><i class="dwg-eye password-toggle-indicator"></i><span class="sr-only">{{ Helper::translation(4866,$translate) }}</span>
                    </label>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-confirm-pass">{{ Helper::translation(3114,$translate) }} <span class="required">*</span></label>
                  <div class="password-toggle">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ Helper::translation(3243,$translate) }}" data-bvalidator="equal[password],required" autocomplete="new-password">
                    <label class="password-toggle-btn">
                      <input class="custom-control-input" type="checkbox"><i class="dwg-eye password-toggle-indicator"></i><span class="sr-only">{{ Helper::translation(4866,$translate) }}</span>
                    </label>
                  </div>
                </div>
              </div>
              @if( request()->get('type') !== 'customer') 
              <div class="col-sm-6">
              <div class="form-group">
                  <label for="account-country">Country<span class="require">*</span></label>
                  <select name="country" id="country" class="form-control" data-bvalidator="required">
                                    <option value="">Select Country</option>
                                    @foreach($country['country'] as $country)
                                    <option value="{{ $country->country_id }}">{{ $country->country_name }}</option>
                             @endforeach
                     </select>       
                </div>
                </div>
                <div class="col-sm-6">
              <div class="form-group">
                  <label for="account-state">State<span class="require">*</span></label>
                  <select name="state" id="state" class="form-control" data-bvalidator="required">
                                    <option value="">Select State</option>
                                    @foreach($state['state'] as $state)
                                    <option value="{{ $state->id }}" >{{ $state->name }}</option>
                             @endforeach
                     </select>       
                </div>
                </div>
              <div class="col-sm-6">
              <div class="form-group">
                  <label for="account-city">City<span class="require">*</span></label>
                  <select name="city" id="city" class="form-control" data-bvalidator="required">
                                    <option value="">Select City</option>
                                    @foreach($city['city'] as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                             @endforeach
                     </select>       
                </div>
                </div> 
                <div class="col-sm-6"></div>
                <div class="col-sm-12" style="color: red;font-size: small;margin-bottom: 10px;">MANDATORY: At Least One of the Following for Verification Purposes</div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-ppa">PPA Profile Link</label>
                  <input type="text" class="form-control" name="ppa_profile" value="" placeholder="Enter your PPA Profile Link">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-ppa">Website Link</label>
                  <input type="text" class="form-control" name="website" value="" placeholder="Enter Website Link">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-facebook">Facebook Page</label>
                  <input type="text" class="form-control" name="facebook_url" value="" placeholder="ex: https://www.facebook.com">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-twitter">Twitter Handle</label>
                  <input type="text" class="form-control" name="twitter_url" value="" placeholder="ex: https://www.twitter.com">
                </div>
              </div>

              @endif

              @if($additional->site_google_recaptcha == 1)
              <div class="col-sm-12">
              <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                <label>{{ Helper::translation(3244,$translate) }} <span class="required">*</span></label>
                {!! app('captcha')->display() !!}
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="help-block">
                                 <strong class="red">{{ $errors->first('g-recaptcha-response') }}</strong>
                            </span>
                     @endif
              </div>
              </div>
              @endif
              <div class="col-12">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                  <div class="custom-checkbox d-block">
                    <a href="{{ URL::to('/login') }}" class="nav-link-inline font-size-sm">{{ Helper::translation(3245,$translate) }} {{ Helper::translation(3225,$translate) }}</a>
                  </div>
                  <button class="btn btn-primary mt-3 mt-sm-0" type="submit">{{ Helper::translation(3233,$translate) }}</button>
                </div>
              </div>
            </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@include('footer')
@include('script')
<script>
function handleUserTypeChange(val){
window.location.href="/register?type="+val
}
</script>
</body>
</html>
@else
@include('503')
@endif