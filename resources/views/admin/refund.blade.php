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
    @if(in_array('refund',$avilable))
    <div id="right-panel" class="right-panel">

        
                       @include('admin.header')
                       

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>{{ Helper::translation(3143,$translate) }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    
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
                                <strong class="card-title">{{ Helper::translation(3143,$translate) }}</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>{{ Helper::translation(2920,$translate) }}</th>
                                            <th>{{ Helper::translation(3173,$translate) }}</th>
                                            <th>{{ Helper::translation(2938,$translate) }}</th>
                                            <th>{{ Helper::translation(3042,$translate) }}</th>
                                            <th>{{ Helper::translation(3146,$translate) }}</th>
                                            <th>{{ Helper::translation(5811,$translate) }}</th>
                                            <th>{{ Helper::translation(2922,$translate) }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $no = 1; @endphp
                                    @foreach($itemData['item'] as $refund)
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{ $refund->ref_purchased_token }} </td>
                                            <td>{{ $refund->item_name }} </td>
                                            <td><a href="{{ URL::to('/user') }}/{{ $refund->username }}" target="_blank" class="blue-color">{{ $refund->username }}</a></td>
                                            <td>{{ $refund->ref_refund_reason }} </td>
                                            <td>{{ $refund->ref_refund_comment }}</td>
                                            <td>
                                            @if($refund->ref_refund_approval == "") 
                                            <a href="{{ URL::to('/admin/refund') }}/{{ $refund->ref_order_id }}/{{ $refund->refund_id }}/buyer" class="btn btn-success btn-sm" title="{{ Helper::translation(5685,$translate) }}"><i class="fa fa-money"></i>&nbsp; {{ Helper::translation(5814,$translate) }}</a> 
                                            <a href="{{ URL::to('/admin/refund') }}/{{ $refund->ref_order_id }}/{{ $refund->refund_id }}/vendor" class="btn btn-danger btn-sm" title="{{ Helper::translation(5679,$translate) }}"><i class="fa fa-close"></i>&nbsp; {{ Helper::translation(5817,$translate) }}</a>
                                            @else
                                            @if($refund->ref_refund_approval == 'accepted') <span class="badge badge-success">{{ Helper::translation(5823,$translate) }}</span> @else <span class="badge badge-danger">{{ Helper::translation(5820,$translate) }}</span> @endif
                                            
                                            @endif
                                            </td>
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
