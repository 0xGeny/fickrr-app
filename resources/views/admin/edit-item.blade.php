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
                        <h1>{{ Helper::translation(2935,$translate) }} - {{ $type_name->item_type_name }}</h1>
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
                           <form action="{{ route('admin.edit-item') }}" class="setting_form" id="item_form" method="post" enctype="multipart/form-data">
                           {{ csrf_field() }}
                           @endif
                          
                           
                             <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        <?php /*?><div class="form-group">
                                                <label for="name" class="control-label mb-1">Item Type <span class="require">*</span></label>
                                               
                                                <select name="item_type" id="item_type" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                   @foreach($getWell['type'] as $value)
                                                    
                                                    <option value="{{ $value->item_type_slug }}" @if($edit['item']->item_type == $value->item_type_slug) selected="selected" @endif>{{ $value->item_type_name }}</option>
                                                   @endforeach 
                                                </select>
                                            </div><?php */?>
                                            
                                             <input type="hidden" name="item_type" value="{{ $edit['item']->item_type }}">
                                            <input type="hidden" name="type_id" value="{{ $typer_id }}">
                                            
                                            <div class="form-group">
                                                <label for="site_desc" class="control-label mb-1">{{ Helper::translation(2938,$translate) }}<span class="require">*</span></label>
                                               <input type="text" id="item_name" name="item_name" class="form-control" value="{{ $edit['item']->item_name }}" data-bvalidator="required,maxlen[100]"> 
                                            
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_desc" class="control-label mb-1">{{ Helper::translation(2940,$translate) }}<span class="require">*</span></label>
                                                <textarea name="item_shortdesc" rows="6"  class="form-control" data-bvalidator="required">{{ $edit['item']->item_shortdesc }}</textarea>
                                            
                                            </div>
                                            
                                             <div class="form-group">
                                                <label for="site_desc" class="control-label mb-1">{{ Helper::translation(2941,$translate) }}<span class="require">*</span></label>
                                                
                                            <textarea name="item_desc" id="summary-ckeditor" rows="6"  class="form-control" data-bvalidator="required">{{ html_entity_decode($edit['item']->item_desc) }}</textarea>
                                            </div>
                                                
                                            
                                            <div class="form-group">
                                                <label for="site_desc" class="control-label mb-1">{{ Helper::translation(2943,$translate) }} <span class="require">*</span> </label><br/>
                                                <input type="file" id="item_thumbnail" name="item_thumbnail" class="files"><small>({{ Helper::translation(2946,$translate) }} : 80x80px)</small><br/>
                                        @if($edit['item']->item_thumbnail!='')
                                        <img src="{{ url('/') }}/public/storage/items/{{ $edit['item']->item_thumbnail }}" alt="{{ $edit['item']->item_name }}" class="item-thumb">
                                        @else
                                        <img src="{{ url('/') }}/public/img/no-image.png" alt="{{ $edit['item']->item_name }}" class="item-thumb">
                                        @endif
                                           
                                            </div>
                                            
                                            
                                            <div class="form-group">
                                                <label for="site_desc" class="control-label mb-1">{{ Helper::translation(2945,$translate) }} <span class="require">*</span> </label><br/>
                                                <input type="file" id="item_preview" name="item_preview" class="files"><small>({{ Helper::translation(2946,$translate) }} : 361x230px)</small><br/>
                                        @if($edit['item']->item_preview!='')
                                        <img src="{{ url('/') }}/public/storage/items/{{ $edit['item']->item_preview }}" alt="{{ $edit['item']->item_name }}" class="item-thumb">
                                        @else
                                        <img src="{{ url('/') }}/public/img/no-image.png" alt="{{ $edit['item']->item_name }}" class="item-thumb">
                                        @endif
                                           
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">Upload Main File Type <span class="require">*</span></label>
                                               <select name="file_type" id="file_type" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                    <option value="file" @if($edit['item']->file_type == 'file') selected @endif>File</option>
                                                    <option value="link" @if($edit['item']->file_type == 'link') selected @endif>Link/URL</option>
                                                </select>
                                            </div>
                                            
                                             <div id="main_file" @if($edit['item']->file_type == 'file') class="form-group display-block" @else  class="form-group display-none" @endif>
                                                <label for="site_desc" class="control-label mb-1">{{ Helper::translation(2947,$translate) }}  <span class="require">*</span> </label><br/>
                                                <input type="file" id="item_file" name="item_file" class="files"><small>({{ Helper::translation(2948,$translate) }})</small>
                                                   
                                                    @php
                                                    if($allsettings->site_s3_storage == 1)
                                                    {
                                                    if(Storage::disk('s3')->exists($edit['item']->item_file))
				                                    {
                                                    $fileurl = Storage::disk('s3')->url($edit['item']->item_file);
                                                    }
                                                    else
                                                    {
                                                    $fileurl = "";
                                                    }
                                                    @endphp
                                                    <br/><a href="{{ $fileurl }}" class="blue-color" download>{{ $edit['item']->item_file }}</a>
                                                    @php
                                                    }
                                                    else
                                                    {
                                                    @endphp
                                                    <br/>@if($edit['item']->item_file!='')<a href="{{ url('/') }}/public/storage/items/{{ $edit['item']->item_file }}" class="blue-color" download>{{ $edit['item']->item_file }}</a>@endif
                                                    @php
                                                    }
                                                    @endphp
                                                
                                           
                                            </div>  
                                            
                                            <div id="main_link" @if($edit['item']->file_type == 'link') class="form-group display-block" @else  class="form-group display-none" @endif>
                                                <label for="name" class="control-label mb-1">Main File Link/URL <span class="require">*</span></label>
                                                <input type="text" id="item_file_link" name="item_file_link" class="form-control" data-bvalidator="required,url" value="{{ $edit['item']->item_file_link }}">
                                                
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_desc" class="control-label mb-1">{{ Helper::translation(2950,$translate) }} </label><br/>
                                                <input type="file" id="item_screenshot" name="item_screenshot[]" class="files"><small>({{ Helper::translation(2946,$translate) }} : 750x430px)</small><br/><br/>@foreach($item_image['item'] as $item)
                                                    
                                                    <div class="item-img"><img src="{{ url('/') }}/public/storage/items/{{ $item->item_image }}" alt="{{ $item->item_image }}" class="item-thumb">
                                                    <a href="{{ url('/admin/edit-item') }}/dropimg/{{ base64_encode($item->itm_id) }}" onClick="return confirm('{{ Helper::translation(5064,$translate) }}?');" class="drop-icon"><span class="ti-trash drop-icon"></span></a>
                                                    </div>
                                                    
                                                    @endforeach
                                           <div class="clearfix"></div>
                                            </div> 
                                            
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(5229,$translate) }} </label>
                                               <select name="video_preview_type" id="video_preview_type" class="form-control">
                                                <option value=""></option>
                                                    <option value="youtube" @if($edit['item']->video_preview_type == 'youtube') selected @endif>{{ Helper::translation(5925,$translate) }}</option>
                                                    <option value="mp4" @if($edit['item']->video_preview_type == 'mp4') selected @endif>{{ Helper::translation(5928,$translate) }}</option>
                                                </select>
                                            </div>
                                            
                                            <div id="youtube" @if($edit['item']->video_preview_type == 'youtube') class="form-group force-block" @else class="form-group force-none" @endif>
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(2967,$translate) }} <span class="require">*</span></label>
                                                
                                                <input type="text" id="video_url" name="video_url" class="form-control" value="{{ $edit['item']->video_url }}" data-bvalidator="required">
                                        <small>({{ Helper::translation(2968,$translate) }} : https://www.youtube.com/watch?v=C0DPdy98e4c)</small>
                                            </div>
                                            
                                            <div id="mp4" @if($edit['item']->video_preview_type == 'mp4') class="form-group force-block" @else class="form-group force-none" @endif>
                                                <label for="site_desc" class="control-label mb-1">{{ Helper::translation(5910,$translate) }} <span class="require">*</span></label><br/>
                                                <input type="file" id="video_file" name="video_file" class="files"><small>({{ Helper::translation(5913,$translate) }})</small>
                                                    @php
                                                    if($allsettings->site_s3_storage == 1)
                                                    {
                                                    if(Storage::disk('s3')->exists($edit['item']->video_file))
				                                    {
                                                    $videofileurl = Storage::disk('s3')->url($edit['item']->video_file);
                                                    }
                                                    else
                                                    {
                                                    $videofileurl = "";
                                                    }
                                                    @endphp
                                                    <br/><a href="{{ $videofileurl }}" class="blue-color" download>{{ $edit['item']->video_file }}</a>
                                                    @php 
                                                    }
                                                    else
                                                    {
                                                    @endphp
                                                    <br/>@if($edit['item']->video_file!='')<a href="{{ url('/') }}/public/storage/items/{{ $edit['item']->video_file }}" class="blue-color" download>{{ $edit['item']->video_file }}</a>@endif
                                                    @php
                                                    }
                                                    @endphp
                                            </div>  
                                            
                                             <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(2969,$translate) }}?<span class="require">*</span></label>
                                               <select name="free_download" id="free_download" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                    <option value="1" @if($edit['item']->free_download == 1) selected="selected" @endif>{{ Helper::translation(2970,$translate) }}</option>
                                                    <option value="0" @if($edit['item']->free_download == 0) selected="selected" @endif>{{ Helper::translation(2971,$translate) }}</option>
                                                </select>
                                            </div>
                                           
                                           
                                           <div class="form-group">
                                                <label for="site_desc" class="control-label mb-1">{{ Helper::translation(2974,$translate) }}</label>
                                                <textarea name="item_tags" id="item_tags" class="form-control">{{ $edit['item']->item_tags }}</textarea>
                                                <small>({{ Helper::translation(2975,$translate) }})</small>
                                            
                                            </div> 
                                            
                                            
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(2977,$translate) }}<span class="require">*</span></label>
                                                <select name="future_update" id="future_update" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                    <option value="1" @if($edit['item']->future_update == 1) selected="selected" @endif>{{ Helper::translation(2970,$translate) }}</option>
                                                    <option value="0" @if($edit['item']->future_update == 0) selected="selected" @endif>{{ Helper::translation(2971,$translate) }}</option>
                                                </select>
                                               
                                            </div>  
                                            
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(2978,$translate) }}<span class="require">*</span></label>
                                                <select name="item_support" id="item_support" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                    <option value="1" @if($edit['item']->item_support == 1) selected="selected" @endif>{{ Helper::translation(2970,$translate) }}</option>
                                                    <option value="0" @if($edit['item']->item_support == 0) selected="selected" @endif>{{ Helper::translation(2971,$translate) }}</option>
                                                </select>
                                               
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
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(2952,$translate) }} <span class="require">*</span></label>
                                               <select name="item_category" id="item_category" class="form-control" data-bvalidator="required">
                                            <option value="">Select</option>
                                            @foreach($categories['menu'] as $menu)
                                                
                                                <option value="category_{{ $menu->cat_id }}" @if($cat_name == 'category') @if($menu->cat_id == $cat_id) selected="selected" @endif @endif>{{ $menu->category_name }}</option>
                                                @foreach($menu->subcategory as $sub_category)
                                                <option value="subcategory_{{$sub_category->subcat_id}}" @if($cat_name == 'subcategory') @if($sub_category->subcat_id == $cat_id) selected="selected" @endif @endif> - {{ $sub_category->subcategory_name }}</option>
                                                @endforeach  
                                            @endforeach
                                            </select>
                                                
                                            </div>
                                            @if(count($attribute['fields']) != 0)
                                            @foreach($attri_field['display'] as $attribute_field)
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ $attribute_field->attr_label }} <span class="require">*</span></label>
                                                @php 
                                                $field_value=explode(',',$attribute_field->attr_field_value); 
                                                $checkpackage=explode(',',$attribute_field->item_attribute_values);
                                                @endphp
                                                @if($attribute_field->attr_field_type == 'multi-select')
                                                <select  name="attributes_{{ $attribute_field->attr_id }}[]" class="form-control" multiple="multiple" data-bvalidator="required">
                                                @foreach($field_value as $field)
                                                <option value="{{ $field }}" @if(in_array($field,$checkpackage)) selected="selected" @endif>{{ $field }}</option>
                                                @endforeach
                                                </select>
                                                @endif
                                                @if($attribute_field->attr_field_type == 'single-select')
                                                <select name="attributes_{{ $attribute_field->attr_id }}[]" class="form-control" data-bvalidator="required">
                                                  <option value=""></option>
                                                  @foreach($field_value as $field)
                                                  <option value="{{ $field }}" @if($attribute_field->item_attribute_values == $field) selected @endif>{{ $field }}</option>
                                                  @endforeach
                                                </select>
                                                @endif
                                                @if($attribute_field->attr_field_type == 'textbox')
                                                <input name="attributes_{{ $attribute_field->attr_id }}[]" type="text" class="form-control" data-bvalidator="required">
                                                @endif
                                                
                                            </div>
                                          @endforeach
                                          @else
                                          @foreach($attri_field['display'] as $attribute_field)
                                             <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ $attribute_field->attr_label }} <span class="require">*</span></label>
                                                @php $field_value=explode(',',$attribute_field->attr_field_value); @endphp
                                                @if($attribute_field->attr_field_type == 'multi-select')
                                                <select  name="attributes_{{ $attribute_field->attr_id }}[]" class="form-control" multiple="multiple" data-bvalidator="required">
                                                @foreach($field_value as $field)
                                                <option value="{{ $field }}">{{ $field }}</option>
                                                @endforeach
                                                </select>
                                                @endif
                                                @if($attribute_field->attr_field_type == 'single-select')
                                                <select name="attributes_{{ $attribute_field->attr_id }}[]" class="form-control" data-bvalidator="required">
                                                  <option value=""></option>
                                                  @foreach($field_value as $field)
                                                  <option value="{{ $field }}">{{ $field }}</option>
                                                  @endforeach
                                                </select>
                                                @endif
                                                @if($attribute_field->attr_field_type == 'textbox')
                                                <input name="attributes_{{ $attribute_field->attr_id }}[]" type="text" class="form-control" data-bvalidator="required">
                                                @endif
                                                
                                            </div>
                                           @endforeach
                                          @endif
                                            
                                            <div class="form-group">
                                                <label for="site_desc" class="control-label mb-1">{{ Helper::translation(6237,$translate) }} <span class="require">*</span></label>
                                                
                                            <textarea name="seller_refund_term" rows="6"  class="form-control" data-bvalidator="required">{{ $edit['item']->seller_refund_term }}</textarea>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> {{ Helper::translation(6240,$translate) }}? <span class="require">*</span></label>
                                                <select name="seller_money_back" id="seller_money_back" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" @if($edit['item']->seller_money_back == 1) selected @endif>{{ Helper::translation(2970,$translate) }}</option>
                                                 <option value="0" @if($edit['item']->seller_money_back == 0) selected @endif>{{ Helper::translation(2971,$translate) }}</option>
                                                </select>
                                                
                                            </div>
                                            <div @if($edit['item']->seller_money_back == 1) class="form-group display-block" @else  class="form-group display-none" @endif>
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(6243,$translate) }}? </label>
                                                <input type="text" id="seller_money_back_days" name="seller_money_back_days" class="form-control" data-bvalidator="min[1]" value="{{ $edit['item']->seller_money_back_days }}">
                                                
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(2966,$translate) }}</label>
                                                <input type="text" id="demo_url" name="demo_url" class="form-control" value="{{ $edit['item']->demo_url }}" data-bvalidator="url">
                                                
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(2979,$translate) }} </label>
                                                <input type="text" id="regular_price" name="regular_price"  class="form-control" value="{{ $edit['item']->regular_price }}" data-bvalidator="digit,min[1],required">
                                                ({{ $allsettings->site_currency }})
                                            </div>  
                                            
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(2980,$translate) }} </label>
                                                
                                                <input type="text" id="extended_price" name="extended_price" class="form-control" value="@if($edit['item']->extended_price==0) @else {{ $edit['item']->extended_price }} @endif" data-bvalidator="digit,min[1]">
                                                ({{ $allsettings->site_currency }})
                                            </div> 
                                            
                                            @if($edit['item']->item_flash_request == 1)
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> {{ Helper::translation(2993,$translate) }} <span class="require">*</span></label>
                                                <select name="item_flash" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" @if($edit['item']->item_flash == 1) selected="selected" @endif>{{ Helper::translation(2874,$translate) }}</option>
                                                <option value="0" @if($edit['item']->item_flash == 0) selected="selected" @endif>{{ Helper::translation(2875,$translate) }}</option>
                                                
                                                </select>
                                                
                                            </div> 
                                            @else
                                            <input type="hidden" name="item_flash" value="0">
                                            @endif
                                            
                                                                                                                          
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> {{ Helper::translation(2873,$translate) }} <span class="require">*</span></label>
                                                <select name="item_status" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" @if($edit['item']->item_status == 1) selected="selected" @endif>{{ Helper::translation(5232,$translate) }}</option>
                                                <option value="0" @if($edit['item']->item_status == 0) selected="selected" @endif>{{ Helper::translation(3092,$translate) }}</option>
                                                <option value="2" @if($edit['item']->item_status == 2) selected="selected" @endif>{{ Helper::translation(5235,$translate) }}</option>
                                                </select>
                                                
                                            </div>   
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">    
                                        <input type="hidden" name="save_file" value="{{ $edit['item']->item_file }}">
                                        <input type="hidden" name="save_thumbnail" value="{{ $edit['item']->item_thumbnail }}">
                                        <input type="hidden" name="save_preview" value="{{ $edit['item']->item_preview }}">
                                        <input type="hidden" name="save_extended_price" value="{{ $edit['item']->extended_price }}">
                                        <input type="hidden" name="item_token" value="{{ $edit['item']->item_token }}">
                                        <input type="hidden" name="save_video_file" value="{{ $edit['item']->video_file }}">
                                          
                                           
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
        </div>
        
        
        <!-- .content -->


    </div><!-- /#right-panel -->
    @else
    @include('admin.denied')
    @endif
    <!-- Right Panel -->


@include('admin.javascript')
<script type="text/javascript">
	$(document).ready(function()
	{
	$('#video_preview_type').on('change', function() {
      if ( this.value == 'youtube')
      
      {
	     $("#youtube").show();
		 $("#mp4").hide();
	  }	
	  else if ( this.value == 'mp4')
	  {
	     $("#mp4").show();
		 $("#youtube").hide();
	  }
	  else
	  {
	      $("#mp4").hide();
		  $("#youtube").hide();
	  }
	  
	 });
});
</script>
</body>

</html>
