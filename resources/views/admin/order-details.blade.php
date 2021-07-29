<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    
    @include('admin.stylesheet')
</head>

<body>
    
    @include('admin.navigation')

    <!-- Right Panel -->
    @if(in_array('items',$avilable)) 
    <div id="right-panel" class="right-panel">

        
                       @include('admin.header')
                       

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>{{ Helper::translation(3097,$translate) }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <a href="{{ url('/admin/orders') }}" class="btn btn-success btn-sm"><i class="fa fa-chevron-left"></i> {{ Helper::translation(5175,$translate) }}</a>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        
         @if (session('success'))
    <div class="col-sm-12">
        <div class="alert  alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
    </div>
@endif

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">{{ Helper::translation(3097,$translate) }}</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>{{ Helper::translation(2920,$translate) }}</th>
                                            <th>{{ Helper::translation(2938,$translate) }}</th>
                                            <th>{{ Helper::translation(3142,$translate) }}</th>
                                            <th>{{ Helper::translation(3101,$translate) }}</th>
                                            <th>{{ Helper::translation(2866,$translate) }}</th>
                                            <th>{{ Helper::translation(5652,$translate) }}</th>
                                            <th>{{ Helper::translation(5655,$translate) }}</th>
                                            <th>{{ Helper::translation(5658,$translate) }}</th>
                                            <th>{{ Helper::translation(5661,$translate) }}</th>
                                            <th>{{ Helper::translation(5664,$translate) }}</th>
                                            <th>{{ Helper::translation(5667,$translate) }}</th>
                                            <th>{{ Helper::translation(5670,$translate) }}?</th>
                                            <th>{{ Helper::translation(2999,$translate) }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $no = 1; @endphp
                                    @foreach($itemData['item'] as $order)
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{ $order->item_name }} </td>
                                            <td><a href="{{ URL::to('/user') }}/{{ $order->username }}" target="_blank" class="blue-color">{{ $order->username }}</a></td>
                                            
                                            <td>{{ date('d F Y', strtotime($order->start_date)) }} </td>
                                            @if($order->coupon_code != "")
                                            <td>{{ $order->coupon_code }} </td>
                                            @else
                                            <td align="center">-</td>
                                            @endif
                                            @if($order->coupon_type != "")
                                            <td>{{ $order->coupon_type }} </td>
                                            @else
                                            <td align="center">-</td>
                                            @endif
                                            @if($order->coupon_type != "")
                                            @if($order->coupon_type == 'fixed')
                                            <td>{{ $order->coupon_value }} {{ $allsettings->site_currency }} </td>
                                            @else
                                            <td>{{ $order->item_price - $order->discount_price }} {{ $allsettings->site_currency }} </td>
                                            @endif
                                            @else
                                            <td align="center">-</td>
                                            @endif
                                            <td>{{ $order->vendor_amount }} {{ $allsettings->site_currency }} </td>
                                            <td>{{ $order->admin_amount }} {{ $allsettings->site_currency }}</td>
                                            <td>{{ $order->total_price }} {{ $allsettings->site_currency }}</td>
                                            <td>@if($order->order_status == 'completed') <span class="badge badge-success">{{ Helper::translation(5673,$translate) }}</span> @else <span class="badge badge-danger">{{ Helper::translation(5676,$translate) }}</span> @endif</td>
                                            <td>
                                            @if($order->approval_status == '')
                                            <a href="{{ URL::to('/admin/order-details') }}/{{ $order->ord_id }}/vendor" class="btn btn-success btn-sm" title="{{ Helper::translation(5679,$translate) }}" onClick="return confirm('{{ Helper::translation(5682,$translate) }}?');"><i class="fa fa-money"></i>&nbsp; {{ Helper::translation(5475,$translate) }}</a> 
                                            <a href="{{ URL::to('/admin/order-details') }}/{{ $order->ord_id }}/buyer" class="btn btn-danger btn-sm" title="{{ Helper::translation(5685,$translate) }}" onClick="return confirm('{{ Helper::translation(5688,$translate) }}?');"><i class="fa fa-close"></i>&nbsp;{{ Helper::translation(5691,$translate) }}</a>
                                            
                                            @else
                                            {{ $order->approval_status }}
                                            @endif
                                            </td>
                                            <td><a href="{{ URL::to('/admin/more-info') }}/{{ $order->purchase_token }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i>&nbsp; {{ Helper::translation(2999,$translate) }}</a></td>
                                        </tr>
                                        
                                        @php $no++; @endphp
                                   @endforeach     
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

 
                </div>
            </div>
        </div>


    </div>
    @else
    @include('admin.denied')
    @endif
    


   @include('admin.javascript')


</body>

</html>
