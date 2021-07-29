<div class="page-title-overlap pt-4" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_banner }}');">
      <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-star">
              <li class="breadcrumb-item"><a class="text-nowrap" href="{{ URL::to('/') }}"><i class="dwg-home"></i>{{ Helper::translation(2930,$translate) }}</a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page">{{ Helper::translation(2930,$translate) }}</li>
              </li>
             </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 mb-0 text-white">{{ Helper::translation(2930,$translate) }}</h1>
        </div>
      </div>
    </div>
<div class="container mb-5 pb-3">
      <div class="bg-light box-shadow-lg rounded-lg overflow-hidden">
        <div class="row">
          <aside class="col-lg-4">
            <div class="d-block d-lg-none p-4">
            <a class="btn btn-outline-accent d-block" href="#account-menu" data-toggle="collapse"><i class="dwg-menu mr-2"></i>{{ Helper::translation(4878,$translate) }}</a></div>
            @if(Auth::user()->id != 1)
            @include('dashboard-menu')
            @endif
          </aside>
          <section class="col-lg-8 pt-lg-4 pb-4 mb-3">
            <div class="pt-2 px-4 pl-lg-0 pr-xl-5">
              <h2 class="h3 py-2 text-center text-sm-left">{{ Helper::translation(2930,$translate) }}</h2>
              <div class="row mx-n2 pt-2">
                <div class="col-md-4 col-sm-12 px-2 mb-4">
                  <div class="bg-secondary h-100 rounded-lg p-4 text-center">
                    <h3 class="font-size-sm text-muted">{{ Helper::translation(3039,$translate) }}</h3>
                    <p class="h2 mb-2">{{ $allsettings->site_currency_symbol }}{{ $total_sale }}</p>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12 px-2 mb-4">
                  <div class="bg-secondary h-100 rounded-lg p-4 text-center">
                    <h3 class="font-size-sm text-muted">{{ Helper::translation(3169,$translate) }}</h3>
                    <p class="h2 mb-2">{{ $allsettings->site_currency_symbol }}{{ $purchase_sale }}</p>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12 px-2 mb-4">
                  <div class="bg-secondary h-100 rounded-lg p-4 text-center">
                    <h3 class="font-size-sm text-muted">{{ Helper::translation(3170,$translate) }}</h3>
                    <p class="h2 mb-2">{{ $allsettings->site_currency_symbol }}{{ $credit_amount }}</p>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12 px-2 mb-4">
                  <div class="bg-secondary h-100 rounded-lg p-4 text-center">
                    <h3 class="font-size-sm text-muted">{{ Helper::translation(3171,$translate) }}</h3>
                    <p class="h2 mb-2">{{ $allsettings->site_currency_symbol }}{{ $drawal_amount }}</p>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12 px-2 mb-4">
                  <div class="bg-secondary h-100 rounded-lg p-4 text-center">
                    <h3 class="font-size-sm text-muted">{{ Helper::translation(5721,$translate) }}</h3>
                    <p class="h2 mb-2">{{ $allsettings->site_currency_symbol }}{{ Auth::user()->referral_amount }}</p>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12 px-2 mb-4">
                  <div class="bg-secondary h-100 rounded-lg p-4 text-center">
                    <h3 class="font-size-sm text-muted">Total Referrals</h3>
                    <p class="h2 mb-2">{{ Auth::user()->referral_count }}</p>
                  </div>
                </div>
              </div>
              <div class="row mx-n2">
                <div class="col-md-12">
                        <div class="statement_table table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>{{ Helper::translation(3172,$translate) }}</th>
                                        <th>{{ Helper::translation(3173,$translate) }}</th>
                                        <th>{{ Helper::translation(3175,$translate) }}</th>
                                        <th>{{ Helper::translation(2888,$translate) }}</th>
                                        <th>{{ Helper::translation(3106,$translate) }}</th>
                                        <th>{{ Helper::translation(2922,$translate) }}</th>
                                    </tr>
                                </thead>
                                <tbody id="listShow">
                                @foreach($orderData['item'] as $item)
                                    <tr class="prod-item">
                                        <td>{{ date("d M Y", strtotime($item->payment_date)) }}</td>
                                        <td class="author">{{ $item->purchase_token }}</td>
                                        <td class="type">
                                            {{ $item->payment_type }}
                                        </td>
                                        <td>{{ $item->total }} {{ $allsettings->site_currency }}</td>
                                        <td class="earning theme-color">{{ $item->vendor_amount }} {{ $allsettings->site_currency }}</td>
                                        <td>
                                            <a href="{{ URL::to('/sales') }}/{{ $item->purchase_token }}" class="btn btn-success btn-sm">{{ Helper::translation(3177,$translate) }}</a>
                                        </td>
                                    </tr>
                                @endforeach 
                               </tbody>
                            </table>
                            <div class="pagination-area">
                           <div class="turn-page" id="itempager"></div>
                        </div>
                       </div>
                    </div>
               </div>
            </div>
          </section>
        </div>
      </div>
    </div>