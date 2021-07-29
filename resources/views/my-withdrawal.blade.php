<div class="page-title-overlap pt-4" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_banner }}');">
      <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-star">
              <li class="breadcrumb-item"><a class="text-nowrap" href="{{ URL::to('/') }}"><i class="dwg-home"></i>{{ Helper::translation(2862,$translate) }}</a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page">{{ Helper::translation(3211,$translate) }}</li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 mb-0 text-white">{{ Helper::translation(3211,$translate) }}</h1>
        </div>
      </div>
    </div>
<div class="container mb-5 pb-3">
      <div class="bg-light box-shadow-lg rounded-lg overflow-hidden">
        <div class="row">
          <!-- Sidebar-->
          <aside class="col-lg-4">
           @include('dashboard-menu')
          </aside>
          <!-- Content-->
          <section class="col-lg-8 pt-lg-4 pb-4 mb-3">
            <div class="pt-2 px-4 pl-lg-0 pr-xl-5">
              <h2 class="h4 py-2 text-center text-sm-left">{{ Helper::translation(3212,$translate) }} <span class="link-color">{{ $allsettings->site_currency_symbol }}{{ $allsettings->site_minimum_withdrawal }}</span></h2>
              <form action="{{ route('withdrawal') }}" id="withdrawal_form" method="post" id="newsample_form" enctype="multipart/form-data">
             {{ csrf_field() }}
              <div class="row mx-n2 py-2">
                <div class="col-sm-6 px-2 mb-4">
                  <div class="bg-secondary h-100 rounded-lg p-4">
                    <h3 class="h5">{{ Helper::translation(3213,$translate) }}</h3>
                    <div class="options">
                                @php $no = 1; @endphp
                                            @foreach($withdraw_option as $withdraw) 
                                            <div class="custom-radio">
                                                <input type="radio" id="withdrawal-{{ $withdraw }}" name="withdrawal" value="{{ $withdraw }}" @if($no == 1) checked @endif>
                                                <label for="withdrawal-{{ $withdraw }}">
                                                    {{ $withdraw }}</label>
                                            </div>
                                            @php $no++; @endphp
                                            @endforeach
                                           <div class="row form-group" id="ifpaypal">
                                                <div class="col-md-12 mb-3 mb-md-0">
                                                  <label class="font-weight-bold" for="phone">{{ Helper::translation(3214,$translate) }}</label>
                                                    <input type="text" id="paypal_email" name="paypal_email" class="form-control" data-bvalidator="email,required">
                                                </div>
                                           </div> 
                                           <div class="row form-group" id="ifstripe">
                                                      <div class="col-md-12 mb-3 mb-md-0">
                                                        <label class="font-weight-bold" for="phone">{{ Helper::translation(3215,$translate) }}</label>
                                                        <input type="text" id="stripe_email" name="stripe_email" class="form-control" data-bvalidator="email,required">
                                                </div>
                                            </div> 
                                            <div class="row form-group" id="ifpaystack">
                                                      <div class="col-md-12 mb-3 mb-md-0">
                                                        <label class="font-weight-bold" for="phone">{{ Helper::translation(4947,$translate) }}</label>
                                                        <input type="text" id="paystack_email" name="paystack_email" class="form-control" data-bvalidator="email,required">
                                                </div>
                                            </div>
                                            <div class="row form-group" id="iflocalbank">
                                                      <div class="col-md-12 mb-3 mb-md-0">
                                                        <label class="font-weight-bold" for="phone">{{ Helper::translation(4816,$translate) }}</label>
                                                        <textarea id="bank_details" name="bank_details" class="form-control" data-bvalidator="required"></textarea>
                                                        <small><strong>{{ Helper::translation(2968,$translate) }}:</strong><br/>
                                                        {{ Helper::translation(5781,$translate) }} : Test Bank<br/>
                                                        {{ Helper::translation(5784,$translate) }} : Test Branch<br/>
                                                        {{ Helper::translation(5787,$translate) }} : 00000<br/>
                                                        {{ Helper::translation(5790,$translate) }} : 63632EF</small>
                                                </div>
                                            </div>
                                        </div>
                  </div>
                </div>
                <div class="col-sm-6 px-2 mb-4">
                  <div class="bg-secondary h-100 rounded-lg p-4">
                    <h3 class="h5">{{ Helper::translation(3216,$translate) }}</h3>
                    <div class="d-flex flex-wrap align-items-center py-1 mb-2">
                    <p class="subtitle">{{ Helper::translation(3217,$translate) }}</p>
                    <div class="options">
                                 <div>
                                  <label>
                                        <span class="circle"></span>{{ Helper::translation(3218,$translate) }}
                                                    <span class="bold">{{ $allsettings->site_currency }}{{ Auth::user()->earnings }} </span>
                                                </label>
                                            </div>
                                            <input type="hidden" name="available_balance" value="{{ base64_encode(Auth::user()->earnings) }}">
                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                            <input type="hidden" name="user_token" value="{{ Auth::user()->user_token }}">
                                            <div class="row form-group" id="ifstripe">
                                                      <div class="col-md-12 mb-3 mb-md-0">
                                                        <label class="font-weight-bold" for="phone">{{ $allsettings->site_currency }}</label>
                                                    <input type="text" id="rlicense" name="get_amount" class="form-control" data-bvalidator="digit,min[{{ $allsettings->site_minimum_withdrawal }}],max[{{ Auth::user()->earnings }}],required">
                                                </div>
                                            </div>
                                       </div>
                                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">{{ Helper::translation(3219,$translate) }}</button>
                  </div>
                </div>
              </div>
              </form>
              <h3 class="h5 pb-2">{{ Helper::translation(3220,$translate) }}</h3>
              <div class="table-responsive">
                <table class="table table-fixed font-size-sm mb-0">
                  <thead>
                    <tr>
                       <th>{{ Helper::translation(3172,$translate) }}</th>
                       <th>{{ Helper::translation(3213,$translate) }}</th>
                       <th>{{ Helper::translation(4944,$translate) }}</th>
                       <th>{{ Helper::translation(3224,$translate) }}</th>
                       <th>{{ Helper::translation(2873,$translate) }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($itemData['item'] as $withdrawal)
                                        <tr>
                                            <td>{{ date('d M Y', strtotime($withdrawal->wd_date)) }}</td>
                                            <td>{{ $withdrawal->withdraw_type }}</td>
                                            <td>
                                            @if($withdrawal->paypal_email != ""){{ $withdrawal->paypal_email }}@endif
                                            @if($withdrawal->stripe_email != ""){{ $withdrawal->stripe_email }}@endif
                                            @if($withdrawal->paystack_email != ""){{ $withdrawal->paystack_email }}@endif
                                            @if($withdrawal->bank_details != "") @php echo nl2br($withdrawal->bank_details); @endphp @endif
                                            </td>
                                            <td class="bold">{{ $withdrawal->wd_amount }} {{ $allsettings->site_currency }}</td>
                                           <td><span class="@if($withdrawal->wd_status == 'pending') wpending @else wpaid @endif">{{ $withdrawal->wd_status }}</span>
                                       </td>
                                    </tr>
                          @endforeach
                  </tbody>
                </table>
              </div>
             </div>
          </section>
        </div>
      </div>
    </div>