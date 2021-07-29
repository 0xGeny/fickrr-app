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
    @if(in_array('languages',$avilable)) 
    <div id="right-panel" class="right-panel">

        
                       @include('admin.header')
                       

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>{{ Helper::translation(5244,$translate) }}</h1>
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
                       @if($demo_mode == 'on')
                           @include('admin.demo-mode')
                           @else
                       <form action="{{ route('admin.edit-language') }}" method="post" id="setting_form" enctype="multipart/form-data">
                        
                        {{ csrf_field() }}
                        @endif
                        <div class="card">
                           
                           
                           
                           <div class="col-md-8">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        
                                            
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(2917,$translate) }} <span class="require">*</span></label>
                                                <input id="language_name" name="language_name" type="text" class="form-control" data-bvalidator="required" value="{{ $edit['view']->language_name }}">
                                            </div>
                                            
                                            
                                             <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(5019,$translate) }} : </label>
                                                <strong>{{ $edit['view']->language_code }}</strong>
                                                
                                            </div>  
                                            
                                            
                                             <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(4971,$translate) }}</label>
                                                <input id="language_order" name="language_order" type="text" class="form-control" data-bvalidator="digit" value="{{ $edit['view']->language_order }}">
                                            </div>      
                                                                              
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> {{ Helper::translation(5487,$translate) }}?<span class="require">*</span></label>
                                                <select name="language_default" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" @if($edit['view']->language_default == 1) selected @endif>{{ Helper::translation(2970,$translate) }}</option>
                                                <option value="0" @if($edit['view']->language_default == 0) selected @endif>{{ Helper::translation(2971,$translate) }}</option>
                                                </select>
                                              
                                            </div>   
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> {{ Helper::translation(2873,$translate) }}<span class="require">*</span></label>
                                                <select name="language_status" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" @if($edit['view']->language_status == 1) selected @endif>{{ Helper::translation(2874,$translate) }}</option>
                                                <option value="0" @if($edit['view']->language_status == 0) selected @endif>{{ Helper::translation(2875,$translate) }}</option>
                                                </select>
                                                
                                            </div>
                                           
                                        
                                    </div>
                                </div>

                            </div>
                            </div>
                            
                            
                            
                             <div class="col-md-6">
                             
                             
                             <input type="hidden" name="language_token" value="{{ $edit['view']->language_token }}">
                             
                             </div>
                            
                            
                            <div class="card-footer">
                                                        <button type="submit" name="submit" class="btn btn-primary btn-sm">
                                                            <i class="fa fa-dot-circle-o"></i> {{ Helper::translation(2876,$translate) }}
                                                        </button>
                                                        <button type="reset" class="btn btn-danger btn-sm">
                                                            <i class="fa fa-ban"></i> {{ Helper::translation(4962,$translate) }}
                                                        </button>
                                                    </div>
                                                    
                                                    
                                                 
                            
                        </div> 

                    
                    </form> 
                    
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
