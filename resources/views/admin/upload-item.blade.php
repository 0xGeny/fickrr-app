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
                        <h1>{{ Helper::translation(2931,$translate) }} - {{ $type_name->item_type_name }}</h1>
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
                        <form action="{{ route('admin.upload-item') }}" class="setting_form" id="item_form" method="post" enctype="multipart/form-data">
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
                                                   @foreach($itemWell['type'] as $value) 
                                                    <option value="{{ $value->item_type_slug }}">{{ $value->item_type_name }}</option>
                                                   @endforeach  
                                                </select>
                                            </div><?php */?>
                                            
                                            <input type="hidden" name="item_type" value="{{ $type_name->item_type_slug }}">
                                            <input type="hidden" name="type_id" value="{{ $type_id }}">
                                            
                                            <div class="form-group">
                                                <label for="site_desc" class="control-label mb-1">{{ Helper::translation(2938,$translate) }}<span class="require">*</span></label>
                                               <input type="text" id="item_name" name="item_name" class="form-control" data-bvalidator="required,maxlen[100]"> 
                                            
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_desc" class="control-label mb-1">{{ Helper::translation(2940,$translate) }}<span class="require">*</span></label>
                                                <textarea name="item_shortdesc" rows="6"  class="form-control" data-bvalidator="required"></textarea>
                                            
                                            </div>
                                            
                                             <div class="form-group">
                                                <label for="site_desc" class="control-label mb-1">{{ Helper::translation(2941,$translate) }}<span class="require">*</span></label>
                                                
                                            <textarea name="item_desc" id="summary-ckeditor" rows="6"  class="form-control" data-bvalidator="required"></textarea>
                                            </div>
                                            
                                            
                                            <div class="form-group">
                                                <label for="site_desc" class="control-label mb-1">{{ Helper::translation(2943,$translate) }} <span class="require">*</span> </label><br/>
                                                <input type="file" id="item_thumbnail" name="item_thumbnail" class="files"><small>({{ Helper::translation(2946,$translate) }} : 80x80px)</small>
                                           
                                            </div>
                                                
                                            
                                            <div class="form-group">
                                                <label for="site_desc" class="control-label mb-1">{{ Helper::translation(2945,$translate) }} <span class="require">*</span> </label><br/>
                                                <input type="file" id="item_preview" name="item_preview" class="files"><small>({{ Helper::translation(2946,$translate) }} : 361x230px)</small>
                                           
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">Upload Main File Type <span class="require">*</span></label>
                                               <select name="file_type" id="file_type" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                    <option value="file">File</option>
                                                    <option value="link">Link/URL</option>
                                                </select>
                                            </div>
                                            
                                            
                                             <div class="form-group" id="main_file">
                                                <label for="site_desc" class="control-label mb-1">{{ Helper::translation(2947,$translate) }}  <span class="require">*</span> </label><br/>
                                                <input type="file" id="item_file" name="item_file" class="files"><small>({{ Helper::translation(2948,$translate) }})</small>
                                           
                                            </div>  
                                            
                                            <div class="form-group" id="main_link">
                                                <label for="name" class="control-label mb-1">Main File Link/URL <span class="require">*</span></label>
                                                <input type="text" id="item_file_link" name="item_file_link" class="form-control" data-bvalidator="required,url">
                                                
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_desc" class="control-label mb-1">{{ Helper::translation(2950,$translate) }}  </label><br/>
                                                <input type="file" id="item_screenshot" name="item_screenshot[]" class="files"><small>({{ Helper::translation(2946,$translate) }} : 750x430px)</small>
                                           
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(5229,$translate) }} </label>
                                               <select name="video_preview_type" id="video_preview_type" class="form-control">
                                                <option value=""></option>
                                                    <option value="youtube">{{ Helper::translation(5925,$translate) }}</option>
                                                    <option value="mp4">{{ Helper::translation(5928,$translate) }}</option>
                                                </select>
                                            </div>
                                            
                                            
                                            <div class="form-group" id="youtube">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(2967,$translate) }} <span class="require">*</span></label>
                                                
                                                <input type="text" id="video_url" name="video_url" class="form-control" data-bvalidator="required">
                                                 <small>({{ Helper::translation(2968,$translate) }} : https://www.youtube.com/watch?v=C0DPdy98e4c)</small>
                                            </div>
                                            
                                            <div class="form-group" id="mp4">
                                                <label for="site_desc" class="control-label mb-1">{{ Helper::translation(5910,$translate) }} <span class="require">*</span></label><br/>
                                                <input type="file" id="video_file" name="video_file" class="files"><small>({{ Helper::translation(5913,$translate) }})</small>
                                           
                                            </div>  
                                            
                                             <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(2969,$translate) }}?<span class="require">*</span></label>
                                               <select name="free_download" id="free_download" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                    <option value="1">{{ Helper::translation(2970,$translate) }}</option>
                                                    <option value="0">{{ Helper::translation(2971,$translate) }}</option>
                                                </select>
                                            </div>
                                           
                                           
                                           <div class="form-group">
                                                <label for="site_desc" class="control-label mb-1">{{ Helper::translation(2974,$translate) }}</label>
                                                <textarea name="item_tags" id="item_tags" class="form-control"></textarea>
                                                <small>({{ Helper::translation(2975,$translate) }})</small>
                                            
                                            </div> 
                                            
                                            
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(2977,$translate) }}<span class="require">*</span></label>
                                                <select name="future_update" id="future_update" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                    <option value="1">{{ Helper::translation(2970,$translate) }}</option>
                                                    <option value="0">{{ Helper::translation(2971,$translate) }}</option>
                                                </select>
                                               
                                            </div>  
                                            
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(2978,$translate) }}<span class="require">*</span></label>
                                                <select name="item_support" id="item_support" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                    <option value="1">{{ Helper::translation(2970,$translate) }}</option>
                                                    <option value="0">{{ Helper::translation(2971,$translate) }}</option>
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
                                            <option value="">{{ Helper::translation(5931,$translate) }}</option>
                                            @foreach($categories['menu'] as $menu)
                                                <option value="category_{{ $menu->cat_id }}">{{ $menu->category_name }}</option>
                                                @foreach($menu->subcategory as $sub_category)
                                                <option value="subcategory_{{$sub_category->subcat_id}}"> - {{ $sub_category->subcategory_name }}</option>
                                                @endforeach  
                                            @endforeach
                                            </select>
                                                
                                            </div>
                                            
                                            @foreach($attribute['fields'] as $attribute_field)
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
                                           
                                           <div class="form-group">
                                                <label for="site_desc" class="control-label mb-1">{{ Helper::translation(6237,$translate) }} <span class="require">*</span></label>
                                                
                                            <textarea name="seller_refund_term" rows="6"  class="form-control" data-bvalidator="required"></textarea>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> {{ Helper::translation(6240,$translate) }}? <span class="require">*</span></label>
                                                <select name="seller_money_back" id="seller_money_back" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1">{{ Helper::translation(2970,$translate) }}</option>
                                                 <option value="0">{{ Helper::translation(2971,$translate) }}</option>
                                                </select>
                                                
                                            </div>
                                            <div class="form-group" id="back_money">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(6243,$translate) }}? </label>
                                                <input type="text" id="seller_money_back_days" name="seller_money_back_days" class="form-control" data-bvalidator="min[1]">
                                                
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(2966,$translate) }} </label>
                                                <input type="text" id="demo_url" name="demo_url" class="form-control" data-bvalidator="url">
                                                
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(2979,$translate) }} </label>
                                                <input type="text" id="regular_price" name="regular_price"  class="form-control" data-bvalidator="digit,min[1],required">
                                                ({{ $allsettings->site_currency }})
                                            </div>  
                                            
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(2980,$translate) }} </label>
                                                
                                                <input type="text" id="extended_price" name="extended_price" class="form-control" data-bvalidator="digit,min[1]">
                                                ({{ $allsettings->site_currency }})
                                            </div> 
                                            
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> {{ Helper::translation(3142,$translate) }} <span class="require">*</span></label>
                                                <select name="user_id" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                @foreach($getvendor['view'] as $user)
                                                <option value="{{ $user->id }}">{{ $user->username }}</option>
                                                @endforeach
                                                </select>
                                                
                                            </div>                                                                               
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> {{ Helper::translation(2873,$translate) }} <span class="require">*</span></label>
                                                <select name="item_status" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1">{{ Helper::translation(5232,$translate) }}</option>
                                                <option value="0">{{ Helper::translation(3092,$translate) }}</option>
                                                </select>
                                                
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
        </div>
 

        <!-- .content -->


    </div><!-- /#right-panel -->
    @else
    @include('admin.denied')
    @endif 
    <!-- Right Panel -->


   @include('admin.javascript')

<script type="text/javascript">
	$(document).ready(function(){
	'use strict';
	$("#mp4").hide();
	$("#youtube").hide();	
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
