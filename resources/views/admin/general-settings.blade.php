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
                        <h1>{{ Helper::translation(5283,$translate) }}</h1>
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
                           <form action="{{ route('admin.general-settings') }}" method="post" id="setting_form" enctype="multipart/form-data">
                           {{ csrf_field() }}
                           @endif
                          
                           <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(5286,$translate) }} <span class="require">*</span></label>
                                                <input id="site_title" name="site_title" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->site_title }}" required>
                                            </div>
                                            
                                             <div class="form-group">
                                                <label for="site_desc" class="control-label mb-1">{{ Helper::translation(5289,$translate) }}<span class="require">*</span></label>
                                                
                                            <textarea name="site_desc" id="site_desc" rows="6" placeholder="site description" class="form-control noscroll_textarea" maxlength="160" required>{{ $setting['setting']->site_desc }}</textarea>
                                            </div>
                                                
                                               <div class="form-group">
                                                <label for="site_keywords" class="control-label mb-1">{{ Helper::translation(5292,$translate) }}<span class="require">*</span></label>
                                                
                                            <textarea name="site_keywords" id="site_keywords" rows="6" placeholder="separate keywords with commas" class="form-control noscroll_textarea" maxlength="160" required>{{ $setting['setting']->site_keywords }}</textarea>
                                            </div>  
                                                
                                                                                      
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(5295,$translate) }}? <span class="require">*</span></label>
                                                <select name="item_approval" class="form-control" required>
                                                <option value=""></option>
                                                <option value="1" @if($setting['setting']->item_approval == 1) selected @endif>{{ Helper::translation(2970,$translate) }}</option>
                                                <option value="0" @if($setting['setting']->item_approval == 0) selected @endif>{{ Helper::translation(2971,$translate) }}</option>
                                                </select>
                                                <small>({{ Helper::translation(5298,$translate) }}) </small>
                                                
                                            </div>  
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(5301,$translate) }}</label>
                                                <input id="office_email" name="office_email" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->office_email }}" required>
                                            </div>
                                                
                                             <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(5304,$translate) }}</label>
                                                <input id="office_phone" name="office_phone" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->office_phone }}" required>
                                            </div> 
                                            
                                            <div class="form-group">
                                                <label for="site_desc" class="control-label mb-1">{{ Helper::translation(5307,$translate) }}<span class="require">*</span></label>
                                                
                                            <textarea name="office_address" id="office_address" rows="6" class="form-control noscroll_textarea" required>{{ $setting['setting']->office_address}}</textarea>
                                            </div>  
                                            
                                            
                                            <div class="form-group">
                                                <label for="banner_heading" class="control-label mb-1">{{ Helper::translation(5310,$translate) }} <span class="require">*</span></label>
                                                <input id="site_newsletter" name="site_newsletter" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->site_newsletter }}" required>
                                            </div> 
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(5313,$translate) }}</label>
                                                <input id="google_analytics" name="google_analytics" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->google_analytics }}">
                                                <span>Example : UA-xxxxxx-1</span>
                                            </div>
                                            
                                           <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(5316,$translate) }}?</label>
                                                <select name="multi_language" class="form-control" required>
                                                <option value=""></option>
                                                <option value="1" @if($setting['setting']->multi_language == "1") selected @endif>{{ Helper::translation(2970,$translate) }}</option>
                                                <option value="0" @if($setting['setting']->multi_language == "0") selected @endif>{{ Helper::translation(2971,$translate) }}</option>
                                                </select>
                                                
                                                
                                            </div> 
                                            <div class="form-group">
                                              <label for="product_approval" class="control-label mb-1">{{ Helper::translation(5319,$translate) }}?<span class="require">*</span></label><br/>                                         <select name="email_verification" class="form-control" required>
                                                        <option value=""></option>
                                                        <option value="1" @if($setting['setting']->email_verification == 1) selected @endif>{{ Helper::translation(5325,$translate) }}</option>
                                                        <option value="0" @if($setting['setting']->email_verification == 0) selected @endif>{{ Helper::translation(5328,$translate) }}</option>
                                                        </select>
                                                        <small>({{ Helper::translation(5322,$translate) }})</small>
                                            </div>
                                            
                                           <div class="form-group">
                                              <label for="product_approval" class="control-label mb-1">{{ Helper::translation(5331,$translate) }}?<span class="require">*</span></label><br/>                                         <select name="payment_verification" class="form-control" required>
                                                        <option value=""></option>
                                                        <option value="1" @if($setting['setting']->payment_verification == 1) selected @endif>{{ Helper::translation(5325,$translate) }}</option>
                                                        <option value="0" @if($setting['setting']->payment_verification == 0) selected @endif>{{ Helper::translation(5328,$translate) }}</option>
                                                        </select>
                                                        <small>({{ Helper::translation(5334,$translate) }})</small>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_loader_display" class="control-label mb-1">{{ Helper::translation(5337,$translate) }}<span class="require">*</span></label><br/>
                                               
                                                <select name="cookie_popup" class="form-control" required>
                                                <option value=""></option>
                                                
                                                <option value="1" @if($setting['setting']->cookie_popup == 1) selected @endif>{{ Helper::translation(2970,$translate) }}</option>
                                                <option value="0" @if($setting['setting']->cookie_popup == 0) selected @endif>{{ Helper::translation(2971,$translate) }}</option>
                                                </select>
                                              </div>
                                            
                                            <div class="form-group">
                                                <label for="site_desc" class="control-label mb-1">{{ Helper::translation(5340,$translate) }} <span class="require">*</span></label>
                                                
                                            <textarea name="cookie_popup_text" id="cookie_popup_text" rows="4" class="form-control noscroll_textarea" required>{{ $setting['setting']->cookie_popup_text}}</textarea>
                                            </div> 
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(5343,$translate) }} <span class="require">*</span></label>
                                                <input id="cookie_popup_button" name="cookie_popup_button" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->cookie_popup_button }}" required>
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
                                                <label for="banner_heading" class="control-label mb-1">{{ Helper::translation(5346,$translate) }} <span class="require">*</span></label>
                                                <input id="site_banner_heading" name="site_banner_heading" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->site_banner_heading }}" required>
                                            </div>  
                                            
                              <div class="form-group">
                                                <label for="banner_heading" class="control-label mb-1">{{ Helper::translation(5349,$translate) }} <span class="require">*</span></label>
                                                <input id="site_banner_subheading" name="site_banner_subheading" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->site_banner_subheading }}" required>
                                            </div>              
                             
                             
                             <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">{{ Helper::translation(5352,$translate) }} ({{ Helper::translation(5355,$translate) }} 24 x 24)<span class="require">*</span></label>
                                                
                                            <input type="file" id="site_favicon" name="site_favicon" class="form-control-file" @if($setting['setting']->site_favicon == '') required @endif>
                                            @if($setting['setting']->site_favicon != '')
                                                <img height="24" src="{{ url('/') }}/public/storage/settings/{{ $setting['setting']->site_favicon }}" />
                                                @endif
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_logo" class="control-label mb-1">{{ Helper::translation(5358,$translate) }} ({{ Helper::translation(2946,$translate) }} 180 x 50)<span class="require">*</span></label>
                                                
                                            <input type="file" id="site_logo" name="site_logo" class="form-control-file" @if($setting['setting']->site_logo == '') required @endif>
                                            @if($setting['setting']->site_logo != '')
                                                <img height="24" src="{{ url('/') }}/public/storage/settings/{{ $setting['setting']->site_logo }}" />
                                                @endif
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">{{ Helper::translation(5361,$translate) }} ({{ Helper::translation(2946,$translate) }} 1920 x 300)<span class="require">*</span></label>
                                                
                                            <input type="file" id="site_banner" name="site_banner" class="form-control-file" @if($setting['setting']->site_banner == '') required @endif>
                                            @if($setting['setting']->site_banner != '')
                                                <img height="24" src="{{ url('/') }}/public/storage/settings/{{ $setting['setting']->site_banner }}" />
                                                @endif
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(5364,$translate) }}?<span class="require">*</span></label>
                                                <select name="watermark_option" class="form-control" required>
                                                <option value=""></option>
                                                <option value="1" @if($setting['setting']->watermark_option == "1") selected @endif>{{ Helper::translation(2970,$translate) }}</option>
                                                <option value="0" @if($setting['setting']->watermark_option == "0") selected @endif>{{ Helper::translation(2971,$translate) }}</option>
                                                </select>
                                                
                                                
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_logo" class="control-label mb-1">{{ Helper::translation(5367,$translate) }}</label>
                                                
                                            <input type="file" id="site_watermark" name="site_watermark" class="form-control-file">
                                            @if($setting['setting']->site_watermark != '')
                                                <img height="150" src="{{ url('/') }}/public/storage/settings/{{ $setting['setting']->site_watermark }}" />
                                                @endif
                                            </div>
                                            
                                           
                                            <div class="form-group">
                                                <label for="site_loader_display" class="control-label mb-1">{{ Helper::translation(5370,$translate) }}<span class="require">*</span></label><br/>
                                               
                                                <select name="site_loader_display" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" @if($setting['setting']->site_loader_display == 1) selected @endif>{{ Helper::translation(5325,$translate) }}</option>
                                                <option value="0" @if($setting['setting']->site_loader_display == 0) selected @endif>{{ Helper::translation(5328,$translate) }}</option>
                                                </select>
                                                
                                             </div>
                                            
                                            <div class="form-group">
                                                <label for="site_loader_image" class="control-label mb-1">{{ Helper::translation(5373,$translate) }} (200 X 200)<span class="require">*</span></label>
                                                
                                            <input type="file" id="site_loader_image" name="site_loader_image" class="form-control-file" @if($setting['setting']->site_loader_image == '') data-bvalidator="required,extension[gif]" data-bvalidator-msg="{{ Helper::translation(5376,$translate) }}" @else data-bvalidator="extension[gif]" data-bvalidator-msg="{{ Helper::translation(5376,$translate) }}" @endif>
                                            @if($setting['setting']->site_loader_image != '')
                                                <img height="50" src="{{ url('/') }}/public/storage/settings/{{ $setting['setting']->site_loader_image }}" />
                                                @endif
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(5379,$translate) }} <span class="require">*</span></label>
                                                <input id="site_flash_end_date" name="site_flash_end_date" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->site_flash_end_date }}" required>
                                            </div> 
                                            
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(5382,$translate) }} <span class="require">*</span></label>
                                                <input id="site_free_end_date" name="site_free_end_date" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->site_free_end_date }}" required>
                                            </div> 
                                            
                                            
                                            <div class="form-group">
                                              <label for="product_approval" class="control-label mb-1">{{ Helper::translation(5385,$translate) }}?<span class="require">*</span></label><br/>                                         <select name="maintenance_mode" class="form-control" required>
                                                        <option value=""></option>
                                                        <option value="1" @if($setting['setting']->maintenance_mode == 1) selected @endif>{{ Helper::translation(5325,$translate) }}</option>
                                                        <option value="0" @if($setting['setting']->maintenance_mode == 0) selected @endif>{{ Helper::translation(5328,$translate) }}</option>
                                                        </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(5388,$translate) }}</label>
                                                <input id="m_mode_title" name="m_mode_title" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->m_mode_title }}" @if($setting['setting']->maintenance_mode == 1) required @endif>
                                                
                                            </div>
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(5391,$translate) }}</label>
                                                <input id="m_mode_content" name="m_mode_content" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->m_mode_content }}" @if($setting['setting']->maintenance_mode == 1) required @endif>
                                                
                                            </div>
                                            <div class="form-group">
                                              <label for="product_approval" class="control-label mb-1">{{ Helper::translation(5394,$translate) }}?<span class="require">*</span></label><br/>                                         <select name="home_blog_display" class="form-control" required>
                                                        <option value=""></option>
                                                        <option value="1" @if($setting['setting']->home_blog_display == 1) selected @endif>{{ Helper::translation(5325,$translate) }}</option>
                                                        <option value="0" @if($setting['setting']->home_blog_display == 0) selected @endif>{{ Helper::translation(5328,$translate) }}</option>
                                              </select>
                                            </div>
                                            
                                             <div class="form-group">
                                                <label for="site_loader_display" class="control-label mb-1">{{ Helper::translation(5397,$translate) }}<span class="require">*</span></label><br/>
                                               
                                                <select name="item_support_link" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                @foreach($page['view'] as $page)
                                                <option value="{{ $page->page_slug }}" @if($setting['setting']->item_support_link == $page->page_slug) selected @endif>{{ $page->page_title }}</option>
                                                @endforeach
                                                </select>
                                                <small>({{ Helper::translation(5400,$translate) }})</small>
                                             </div>
                                               
                                              <div class="form-group">
                                              <label for="product_approval" class="control-label mb-1">Google Recaptcha?<span class="require">*</span></label><br/>
                                              <select name="site_google_recaptcha" class="form-control" required>
                                                        <option value=""></option>
                                                        <option value="1" @if($additional->site_google_recaptcha == 1) selected @endif>{{ Helper::translation(5325,$translate) }}</option>
                                                        <option value="0" @if($additional->site_google_recaptcha == 0) selected @endif>{{ Helper::translation(5328,$translate) }}</option>
                                              </select>
                                            </div> 
                                            
                                                <input type="hidden" name="save_banner" value="{{ $setting['setting']->site_banner }}">
                                                <input type="hidden" name="save_logo" value="{{ $setting['setting']->site_logo }}">
                                                <input type="hidden" name="save_favicon" value="{{ $setting['setting']->site_favicon }}">
                                                <input type="hidden" name="save_watermark" value="{{ $setting['setting']->site_watermark }}">
                                                <input type="hidden" name="save_loader_image" value="{{ $setting['setting']->site_loader_image }}">
                                                <input type="hidden" name="sid" value="1">
                             
                             
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
