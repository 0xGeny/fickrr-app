@if($allsettings->maintenance_mode == 0)
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>{{ Helper::translation(3097,$translate) }} - {{ $allsettings->site_title }}</title>
@include('meta')
@include('style')
</head>
<body>
@include('header')
@if(Auth::user()->user_type == 'vendor')
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
          <h1 class="h3 mb-0 text-white">{{ Helper::translation(3097,$translate) }}</h1>
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
          <section class="col-lg-8 pt-lg-4 pb-4 mb-3" id="printable">
            <div class="pt-2 px-4 pl-lg-0 pr-xl-5">
              <div class="row mx-n2 pt-2">
              <div class="col pull-left">
                                <div class="dashboard__title">
                                    <h3>{{ Helper::translation(3097,$translate) }}</h3>
                                </div>
                            </div>
                <div class="col pull-right">
                   <a href="javascript:void(0);" class="btn btn-success btn-sm theme-button print">{{ Helper::translation(3098,$translate) }}</a>
                </div>
              </div>
              <div class="row mt-3 pt-3 mb-3">
                    <div class="invoice_logo col pull-left">
                                    <img src="{{ url('/') }}/public/storage/settings/{{ $allsettings->site_logo }}" alt="">
                                </div>
                                <div class="info col pull-right">
                                    <h4>{{ Helper::translation(3099,$translate) }}</h4>
                                    <p>{{ Helper::translation(3100,$translate) }} #{{ $checkout['view']->purchase_token }}</p>
                                </div>
                        </div>
                        <hr/>
                        <div class="row mt-3 pt-3">
                                <div class="address col pull-left">
                                    <h5 class="bold">{{ $checkout['view']->order_firstname }} {{ $checkout['view']->order_lastname }}</h5>
                                    <p>{{ $checkout['view']->order_address }}</p>
                                    <p>{{ $checkout['view']->order_city }}, {{ $checkout['view']->order_zipcode }}</p>
                                    <p>{{ $checkout['view']->order_country }}</p>
                                </div>
                                <div class="date_info col pull-right">
                                    <p>
                                     <span>{{ Helper::translation(3101,$translate) }} : </span>{{ date("d M Y", strtotime($checkout['view']->payment_date)) }}</p>
                                     <p class="status">
                                     <span>{{ Helper::translation(2873,$translate) }} : </span><span @if($checkout['view']->payment_status == 'completed') class="badge badge-success" @else class="badge badge-danger" @endif>{{ $checkout['view']->payment_status }}</span></p>
                                </div>
                                </div>
                         <div class="row mt-3 pt-3">       
                         <div class="invoice">
                            <div class="invoice__detail">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>{{ Helper::translation(3102,$translate) }}</th>
                                                <th>{{ Helper::translation(3103,$translate) }}</th>
                                                <th>{{ Helper::translation(3042,$translate) }}</th>
                                                <th>{{ Helper::translation(3104,$translate) }}</th>
                                                <th>{{ Helper::translation(3105,$translate) }}</th>
                                                <th>{{ Helper::translation(2888,$translate) }}</th>
                                                <th>{{ Helper::translation(3106,$translate) }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @php $earn = 0; @endphp
                                        @foreach($order['view'] as $order)
                                            <tr>
                                                <td>{{ date("d M Y", strtotime($order->start_date)) }}</td>
                                                <td>{{ date("d M Y", strtotime($order->end_date)) }}</td>
                                                <td><a href="{{ URL::to('/user') }}/{{ $order->username }}" class="theme-color">{{ $order->username }}</a></td>
                                                <td class="detail">
                                                    <a href="{{ URL::to('/item') }}/{{ $order->item_slug }}" class="theme-color">{{ substr($order->item_name,0,30).'...' }}</a>
                                                </td>
                                                <td>{{ $order->payment_type }}</td>
                                                <td>{{ $allsettings->site_currency_symbol }}{{ $order->item_price }}</td>
                                                <td>{{ $allsettings->site_currency_symbol }}{{ $order->vendor_amount }}</td>
                                            </tr>
                                            @php $earn += $order->vendor_amount; @endphp
                                        @endforeach    
                                       </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                   </div>
                   <hr/>
                   <div class="row mt-3 pt-3">
                   <div class="pricing_info col pull-right">
                        <p>{{ Helper::translation(3107,$translate) }} : {{ $allsettings->site_currency_symbol }}{{ $earn }}</p>
                        <p class="bold">{{ Helper::translation(2896,$translate) }} : {{ $allsettings->site_currency_symbol }}{{ $earn }}</p>
                  </div>
                  </div>
               </div>
          </section>
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