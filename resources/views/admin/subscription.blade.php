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
    @if(in_array('subscription',$avilable))
    <div id="right-panel" class="right-panel">

        
                       @include('admin.header')
                       

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>{{ Helper::translation(6105,$translate) }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <a href="{{ url('/admin/add-subscription') }}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> {{ Helper::translation(6189,$translate) }}</a>
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
@if (session('error'))
    <div class="col-sm-12">
        <div class="alert  alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
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
                                <strong class="card-title">{{ Helper::translation(6105,$translate) }}</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>{{ Helper::translation(2920,$translate) }}</th>
                                            <th>{{ Helper::translation(2917,$translate) }}</th>
                                            <th>{{ Helper::translation(2888,$translate) }}</th>
                                            <th>{{ Helper::translation(6144,$translate) }}</th>
                                            <th>{{ Helper::translation(4971,$translate) }}</th>
                                            <th>{{ Helper::translation(2873,$translate) }}</th>
                                            <th>{{ Helper::translation(2922,$translate) }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $no = 1; @endphp
                                    @foreach($subscription['view'] as $subscription)
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td width="200">{{ $subscription->subscr_name }} </td>
                                           <td>{{ $allsettings->site_currency_symbol }} {{ $subscription->subscr_price }} </td>
                                           <td>{{ $subscription->subscr_duration }} </td>
                                           <td>{{ $subscription->subscr_order }} </td>
                                            <td>@if($subscription->subscr_status == 1) <span class="badge badge-success">{{ Helper::translation(2874,$translate) }}</span> @else <span class="badge badge-danger">{{ Helper::translation(2875,$translate) }}</span> @endif</td>
                                            <td><a href="edit-subscription/{{ $subscription->subscr_id }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp; {{ Helper::translation(2923,$translate) }}</a> 
                                            @if($demo_mode == 'on') 
                                            <a href="demo-mode" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;{{ Helper::translation(2924,$translate) }}</a>
                                            @else 
                                            <a href="subscription/{{ $subscription->subscr_id }}" class="btn btn-danger btn-sm" onClick="return confirm('{{ Helper::translation(5064,$translate) }}?');"><i class="fa fa-trash"></i>&nbsp;{{ Helper::translation(2924,$translate) }}</a>@endif</td>
                                        </tr>
                                        
                                        @php $no++; @endphp
                                   @endforeach     
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

 
                </div>
                
                
                
                <div class="row">
                <div class="col-md-12">
                  <div class="card">
                            <div class="card-header">
                                <strong class="card-title">{{ Helper::translation(6192,$translate) }}</strong><br/><small>({{ Helper::translation(6195,$translate) }})</small>
                            </div>
                             <div class="card-body">
                 @if($demo_mode == 'on')
                                 @include('admin.demo-mode')
                                 @else
                                 <form action="{{ route('admin.free-subscription') }}" method="post" id="setting_form" enctype="multipart/form-data">
                                 {{ csrf_field() }}
                                 @endif
                                  
                                 <div class="col-md-6">
                                 
                                   <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Free Subscription? <span class="require">*</span></label>
                                                <select name="free_subscription" class="form-control" required>
                                                <option value=""></option>
                                                <option value="1" @if($additional->free_subscription == 1) selected @endif>{{ Helper::translation(5013,$translate) }}</option>
                                                <option value="0" @if($additional->free_subscription == 0) selected @endif>{{ Helper::translation(5922,$translate) }}</option>
                                                </select>
                                            </div>
                                  <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> {{ Helper::translation(6144,$translate) }} <span class="require">*</span></label>
                                                <select name="subscr_duration" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                @php  
                                                for($i=1;$i<=365;$i++){ 
                                                if($i==1){ $day_text = "day"; } else { $day_text = "days"; }
                                                $dates = $i.' '.$day_text;
                                                @endphp
                                                <option value="{{ $dates }}" @if($additional->free_subscr_duration == $dates) selected @endif>{{ $dates }}</option>
                                                @php } @endphp
                                                </select>
                                                
                                            </div> 
                                            
                                      </div>
                                      
                                      <div class="col-md-6">      
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(6198,$translate) }} <span class="require">*</span></label>
                                                <input id="subscr_items" name="subscr_items" type="text" class="form-control" data-bvalidator="required,digit,min[1]" value="{{ $additional->free_subscr_item }}">
                                            </div> 
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(6201,$translate) }} (MB) <span class="require">*</span></label>
                                                <input id="subscr_spaces" name="subscr_spaces" type="text" class="form-control" data-bvalidator="required,digit,min[1]" value="{{ $additional->free_subscr_space }}">
                                            </div> 
                                        </div>
                                        
                                        <input type="hidden" name="user_subscr_type" value="Free">
                                        <input type="hidden" name="user_subscr_price" value="0">
                                        <input type="hidden" name="sid" value="{{ $sid }}">
                                        <div class="col-md-12">    
                                
                                                        <button type="submit" name="submit" class="btn btn-primary btn-sm">
                                                            <i class="fa fa-dot-circle-o"></i> {{ Helper::translation(2876,$translate) }}
                                                        </button>
                                                       
                                                 
                                                 </div>   
                     </form>
                     </div>
                     </div>                   
                </div>
                </div>
                
                <div class="row">
                <div class="col-md-12">
                  <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Subscription Content</strong>
                            </div>
                             <div class="card-body">
                                 @if($demo_mode == 'on')
                                 @include('admin.demo-mode')
                                 @else
                                 <form action="{{ route('admin.subscription') }}" method="post" id="order_form" enctype="multipart/form-data">
                                 {{ csrf_field() }}
                                 @endif
                                  
                                 <div class="col-md-6">
                                 
                                   
                                  <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(5025,$translate) }} </label>
                                                <input id="subscription_title" name="subscription_title" type="text" class="form-control" value="{{ $additional->subscription_title }}">
                                            </div> 
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(2941,$translate) }} </label>
                                                <textarea name="subscription_desc" id="summary-ckeditor" rows="6" class="form-control">{{ html_entity_decode($additional->subscription_desc) }}</textarea>
                                                
                                            </div> 
                                      </div>
                                      
                                      <div class="col-md-6">      
                                            
                                             
                                        </div>
                                        
                                        
                                        <div class="col-md-12">    
                                
                                                        <button type="submit" name="submit" class="btn btn-primary btn-sm">
                                                            <i class="fa fa-dot-circle-o"></i> {{ Helper::translation(2876,$translate) }}
                                                        </button>
                                                       
                                                 
                                                 </div>   
                     </form>
                     </div>
                     </div>                   
                </div>
                </div>
                
            </div><!-- .animated -->
        </div><!-- .content -->


    </div><!-- /#right-panel -->
    @else
    @include('admin.denied')
    @endif
    <!-- Right Panel -->


   @include('admin.javascript')


</body>

</html>
