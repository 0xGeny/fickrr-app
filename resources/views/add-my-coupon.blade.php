<div class="page-title-overlap pt-4" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_banner }}');">
      <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-star">
              <li class="breadcrumb-item"><a class="text-nowrap" href="{{ URL::to('/') }}"><i class="dwg-home"></i>{{ Helper::translation(2862,$translate) }}</a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page">{{ Helper::translation(2865,$translate) }}</li>
              </li>
             </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 mb-0 text-white">{{ Helper::translation(2865,$translate) }}</h1>
        </div>
      </div>
    </div>
<div class="container mb-5 pb-3">
      <div class="bg-light box-shadow-lg rounded-lg overflow-hidden">
        <div class="row">
          <!-- Sidebar-->
          <aside class="col-lg-4">
            <!-- Account menu toggler (hidden on screens larger 992px)-->
            <div class="d-block d-lg-none p-4">
            <a class="btn btn-outline-accent d-block" href="#account-menu" data-toggle="collapse"><i class="dwg-menu mr-2"></i>{{ Helper::translation(4878,$translate) }}</a></div>
            <!-- Actual menu-->
            @if(Auth::user()->id != 1)
            @include('dashboard-menu')
            @endif
          </aside>
          <!-- Content-->
          <section class="col-lg-8 pt-lg-4 pb-4 mb-3 coupon">
            <div class="pt-2 px-4 pl-lg-0 pr-xl-5">
              <h2 class="h3 pt-2 pb-4 mb-0 text-center text-sm-left border-bottom">{{ Helper::translation(2865,$translate) }}</h2>
              <form action="{{ route('add-coupon') }}" class="needs-validation mt-3 pt-3" id="profile_form" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-fn">{{ Helper::translation(2866,$translate) }} <span class="require">*</span></label>
                  <input id="coupon_code" name="coupon_code" type="text" class="form-control" data-bvalidator="required">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-ln">{{ Helper::translation(2867,$translate) }} <span class="require">*</span></label>
                 <input id="coupon_value" name="coupon_value" type="text" class="form-control" data-bvalidator="required,min[1]">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-email">{{ Helper::translation(2868,$translate) }} <span class="require">*</span></label>
                  <input id="coupon_start_date" name="coupon_start_date" type="text" class="form-control" autocomplete="off" data-bvalidator="required">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-email">{{ Helper::translation(2869,$translate) }} <span class="require">*</span></label>
                  <input id="coupon_end_date" name="coupon_end_date" type="text" class="form-control" autocomplete="off" data-bvalidator="required">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-email">{{ Helper::translation(2870,$translate) }} <span class="require">*</span></label>
                  <select name="discount_type" class="form-control" data-bvalidator="required">
                         <option value=""></option>
                         <option value="percentage">{{ Helper::translation(2871,$translate) }}</option>
                         <option value="fixed">{{ Helper::translation(2872,$translate) }}</option>
                         </select>
                </div>
              </div> 
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-email">{{ Helper::translation(2873,$translate) }} <span class="require">*</span></label>
                  <select name="coupon_status" class="form-control" data-bvalidator="required">
                        <option value=""></option>
                         <option value="1">{{ Helper::translation(2874,$translate) }}</option>
                         <option value="0">{{ Helper::translation(2875,$translate) }}</option>
                         </select>
                </div>
              </div>
              <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
              <div class="col-12">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                  <button class="btn btn-primary mt-3 mt-sm-0" type="submit">{{ Helper::translation(2876,$translate) }}</button>
                </div>
              </div>
            </div>
          </form>
          </div>
          </section>
        </div>
      </div>
    </div>