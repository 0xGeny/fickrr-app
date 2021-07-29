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
    @if(in_array('settings',$avilable)) 
    <div id="right-panel" class="right-panel">

       
                       @include('admin.header')
                       

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>{{ Helper::translation(5565,$translate) }}</h1>
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
                           <form action="{{ route('admin.media-settings') }}" method="post" id="checkout_form" enctype="multipart/form-data">
                           {{ csrf_field() }}
                           @endif
                          
                           <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(5568,$translate) }}<span class="require">*</span></label>
                                                <input id="site_max_image_size" name="site_max_image_size" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->site_max_image_size }}" data-bvalidator="required,digit,min[1]"> <small>{{ Helper::translation(2968,$translate) }} : 1000</small>
                                            </div>
                                            
                                           
                                           
                                    </div>
                                </div>

                            </div>
                            </div>
                            
                            
                            
                             <div class="col-md-6">
                             
                             
                             <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                             
                               
                             <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(5571,$translate) }}<span class="require">*</span></label>
                                                <input id="site_max_file_size" name="site_max_file_size" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->site_max_file_size }}" data-bvalidator="required,digit,min[1]"> <small>{{ Helper::translation(2968,$translate) }} : 1000</small>
                                            </div>
                             
                            
                             
                             </div>
                                </div>

                            </div>
                             
                             <input type="hidden" name="sid" value="1">
                             
                             </div>
                             
                             
                             
                            <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        
                                         <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(5574,$translate) }}</label>
                                                <select name="site_s3_storage" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="0" @if($setting['setting']->site_s3_storage == 0) selected @endif>{{ Helper::translation(5577,$translate) }}</option>
                                                <option value="1" @if($setting['setting']->site_s3_storage == 1) selected @endif>{{ Helper::translation(5580,$translate) }}</option>
                                                </select>
                                                
                                                
                                            </div>   
                                           
                                            
                                           
                                           
                                    </div>
                                </div>

                            </div>
                            </div>
                             
                             <div class="col-md-12"><h5>{{ Helper::translation(5583,$translate) }}</h5></div>
                             
                             
                             <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(5586,$translate) }}</label>
                                                <input id="aws_access_key_id" name="aws_access_key_id" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->aws_access_key_id }}">
                                            </div>
                                        
                                         <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(5589,$translate) }}</label>
                                                <input id="aws_secret_access_key" name="aws_secret_access_key" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->aws_secret_access_key }}"> 
                                            </div>
                                           
                                    </div>
                                </div>

                            </div>
                            </div>
                             
                            <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(5592,$translate) }}</label>
                                                <input id="aws_default_region" name="aws_default_region" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->aws_default_region }}">
                                                <small>{{ Helper::translation(2968,$translate) }} : us-east-2</small>
                                            </div>
                                        
                                         <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(5595,$translate) }}</label>
                                                <input id="aws_bucket" name="aws_bucket" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->aws_bucket }}"> <small>{{ Helper::translation(2968,$translate) }} : {{ Helper::translation(5598,$translate) }}</small>
                                            </div>
                                           
                                    </div>
                                </div>

                            </div>
                            </div> 
                            
                            
                             <div class="col-md-12 no-padding">
                             <div class="card-footer">
                                 <button type="submit" name="submit" class="btn btn-primary btn-sm"><i class="fa fa-dot-circle-o"></i> {{ Helper::translation(2876,$translate) }}</button>
                                 <button type="reset" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i> {{ Helper::translation(4962,$translate) }} </button>
                             </div>
                             
                             </div>
                             
                            
                            </form>
                            
                                                    
                                                    
                                                 
                            
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
