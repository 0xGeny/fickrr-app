<div class="page-title-overlap pt-4" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_banner }}');">
      <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-star">
              <li class="breadcrumb-item"><a class="text-nowrap" href="{{ URL::to('/') }}"><i class="dwg-home"></i>{{ Helper::translation(2862,$translate) }}</a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page">{{ Helper::translation(2919,$translate) }}</li>
              </li>
             </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 mb-0 text-white">{{ Helper::translation(2919,$translate) }}</h1>
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
          <section class="col-lg-8 pt-lg-4 pb-4 mb-3">
            <div class="pt-2 px-4 pl-lg-0 pr-xl-5">
              <h2 class="h3 pt-2 pb-4 mb-0 text-center text-sm-left border-bottom">{{ Helper::translation(2919,$translate) }}</h2>
              <!-- Product-->
                <div class="row">
                 <div class="col-lg-12 col-md-12 text-right mb-3 mt-3">
                 <a href="{{ URL::to('/add-coupon') }}" class="btn btn-success btn-sm">{{ Helper::translation(2865,$translate) }}</a>
                 </div>
                 </div>
                 <div class="row">
                    <div class="col-md-12">
                        <div class="statement_table table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>{{ Helper::translation(2920,$translate) }}</th>
                                        <th>{{ Helper::translation(2866,$translate) }}</th>
                                        <th>{{ Helper::translation(2921,$translate) }}</th>
                                        <th>{{ Helper::translation(2867,$translate) }}</th>
                                        <th>{{ Helper::translation(2873,$translate) }}</th>
                                        <th>{{ Helper::translation(2922,$translate) }}</th>
                                    </tr>
                                </thead>
                                <tbody id="listShow">
                                    @php $no = 1; @endphp
                                    @foreach($couponData['view'] as $coupon)
                                        <tr class="prod-item">
                                            <td>{{ $no }}</td>
                                            <td>{{ $coupon->coupon_code }} </td>
                                            <td>{{ $coupon->discount_type }}</td>
                                            <td>@if($coupon->discount_type == 'fixed'){{ $allsettings->site_currency }} @endif{{ $coupon->coupon_value }}@if($coupon->discount_type == 'percentage')%@endif </td>
                                            <td>@if($coupon->coupon_status == 1) <span class="badge badge-success">{{ Helper::translation(2874,$translate) }}</span> @else <span class="badge badge-danger">{{ Helper::translation(2875,$translate) }}</span> @endif</td>
                                            <td>
                                            <a href="{{ URL::to('/edit-coupon') }}/{{ base64_encode($coupon->coupon_id) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp; {{ Helper::translation(2923,$translate) }}</a> 
                                            @if($demo_mode == 'on') 
                                            <a href="demo-mode" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;{{ Helper::translation(2924,$translate) }}</a>
                                            @else 
                                            <a href="{{ URL::to('/coupon') }}/{{ base64_encode($coupon->coupon_id) }}" class="btn btn-danger btn-sm" onClick="return confirm('{{ Helper::translation(2925,$translate) }}');"><i class="fa fa-trash"></i>&nbsp;{{ Helper::translation(2924,$translate) }}</a> 
                                             @endif
                                             </td>
                                        </tr>
                                        @php $no++; @endphp
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