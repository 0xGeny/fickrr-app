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
    @if(Auth::user()->id == 1)
    <div id="right-panel" class="right-panel">

        
                       @include('admin.header')
                       

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>{{ Helper::translation(5259,$translate) }}</h1>
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


@if ($errors->any())
    <div class="col-sm-12">
     <div class="alert  alert-danger alert-dismissible fade show" role="alert">
     @foreach ($errors->all() as $error)
      
         {{$error}}
      
     @endforeach
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
                           @if($demo_mode == 'on')
                           @include('admin.demo-mode')
                           @else
                           <form action="{{ route('admin.edit-vendor') }}" method="post" id="setting_form" enctype="multipart/form-data">
                           {{ csrf_field() }}
                           @endif
                           <div class="col-md-6">
                           <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(2917,$translate) }} <span class="require">*</span></label>
                                                <input id="name" name="name" type="text" class="form-control" value="{{ $edit['userdata']->name }}" required>
                                            </div>
                                            
                                             <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(3111,$translate) }} <span class="require">*</span></label>
                                                <input id="username" name="username" type="text" class="form-control" value="{{ $edit['userdata']->username }}" required>
                                            </div>
                                            
                                            
                                                <div class="form-group">
                                                    <label for="email" class="control-label mb-1">{{ Helper::translation(2915,$translate) }} <span class="require">*</span></label>
                                                    <input id="email" name="email" type="email" class="form-control" value="{{ $edit['userdata']->email }}" required>
                                                   
                                                </div>
                                                
                                                <input type="hidden" name="user_type" value="vendor">
                                                
                                                <div class="form-group">
                                                    <label for="password" class="control-label mb-1">{{ Helper::translation(3113,$translate) }}</label>
                                                    <input id="password" name="password" type="text" class="form-control">
                                                    
                                                </div>
                                                
                                                 <div class="form-group">
                                                    <label for="earnings" class="control-label mb-1">{{ Helper::translation(3106,$translate) }} ({{ $allsettings->site_currency }})</label>
                                                    <input id="earnings" name="earnings" type="text" class="form-control" value="{{ $edit['userdata']->earnings }}">
                                                    
                                                </div>
                                                
                                                <div class="form-group">
                                                                    <label for="customer_earnings" class="control-label mb-1">{{ Helper::translation(4956,$translate) }}</label>
                                                                    <input type="file" id="user_photo" name="user_photo" class="form-control-file">
                                                                </div>
                                                @if($edit['userdata']->user_photo != '')
                                                <img height="50" src="{{ url('/') }}/public/storage/users/{{ $edit['userdata']->user_photo }}"  class="userphoto"/>@else <img height="50" src="{{ url('/') }}/public/img/no-user.png"  class="userphoto"/>  @endif
                                                
                                                
                                                @if($addition_settings->subscription_mode == 1)                
                                                <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Subscription Type? <span class="require">*</span></label>
                                                <select name="subscription_type" class="form-control" required>
                                                <option value=""></option>
                                                <option value="none" @if($edit['userdata']->user_subscr_type == 'None') selected @endif>None</option>
                                                @if($addition_settings->free_subscription == 1)
                                                <option value="free" @if($edit['userdata']->user_subscr_type == 'Free') selected @endif>Free</option>
                                                @endif
                                                @foreach($subscribe['userdata'] as $subscribe)
                                                <option value="{{ $subscribe->subscr_id }}" @if($edit['userdata']->user_subscr_id == $subscribe->subscr_id) selected @endif>{{ $subscribe->subscr_name }}</option>
                                                @endforeach
                                                </select>
                                                </div>
                                                <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Account Verification? <span class="require">*</span></label>
                                                <select name="user_document_verified" class="form-control" required>
                                                <option value=""></option>
                                                <option value="1" @if($edit['userdata']->user_document_verified == 1) selected @endif>{{ Helper::translation(5202,$translate) }}</option>
                                                <option value="0" @if($edit['userdata']->user_document_verified == 0) selected @endif>{{ Helper::translation(5205,$translate) }}</option>
                                                </select>
                                                </div>
                                                @endif 
                                                
                                                
                                                
                                                <input type="hidden" name="verified" value="1"> 
                                                
                                                <input type="hidden" name="save_photo" value="{{ $edit['userdata']->user_photo }}">
                                                
                                                <input type="hidden" name="save_password" value="{{ $edit['userdata']->password }}">
                                                
                                                <input type="hidden" name="save_auth_token" value="{{ $edit['userdata']->user_auth_token }}">
                                                
                                                <input type="hidden" name="edit_id" value="{{ $token }}">
                                                
                                                <input type="hidden" name="page_redirect" value="vendor">
                                       </div>
                                </div>
                             </div>
                            </div>
                            <div class="col-md-6">
                             <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                          @if($check_payment == 1)
                              <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">Vendor Payment Methods </label><br/>
                                                @foreach($payment_option as $payment)
                                                <input id="user_payment_option" name="user_payment_option[]" type="checkbox" @if(in_array($payment,$get_payment)) checked @endif class="noscroll_textarea" value="{{ $payment }}"> {{ $payment }} <br/>
                                                @endforeach
                                             </div>
                             @endif
                                     </div>
                                </div>
                            </div>
                           </div>
                           <div class="col-md-12 no-padding">
                             <div class="card-footer">
                                 <button type="submit" name="submit" class="btn btn-primary btn-sm"><i class="fa fa-dot-circle-o"></i> {{ Helper::translation(2876,$translate) }}</button>
                                 <button type="reset" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i> {{ Helper::translation(4962,$translate) }} </button>
                                 <a href="{{ url('/vendor') }}/{{ $encrypter->encrypt($edit['userdata']->user_token) }}" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-user"></i> Login as vendor </a>
                             </div>
                             </div>
                            </form>
                         </div> 
                     </div>
                </div>
            </div><!-- .animated -->
        </div>
        
        <!-- .content -->


    </div><!-- /#right-panel -->
    @else
    @include('admin.denied')
    @endif
    <!-- Right Panel -->


   @include('admin.javascript')


</body>

</html>
