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
    @if(in_array('blog',$avilable)) 
    <div id="right-panel" class="right-panel">

        
                       @include('admin.header')
                       

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>{{ Helper::translation(5250,$translate) }}</h1>
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
                       <form action="{{ route('admin.edit-post') }}" method="post" enctype="multipart/form-data">
                        
                        {{ csrf_field() }}
                        @endif
                        <div class="card">
                           
                           
                           
                           <div class="col-md-8">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                          
                                          
                                          <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(5025,$translate) }} <span class="require">*</span></label>
                                                <input id="post_title" name="post_title" type="text" class="form-control" value="{{ $edit['post']->post_title }}" required>
                                            </div>
                                            
                                            
                                            <div class="form-group">
                                                <label for="cat_id" class="control-label mb-1">{{ Helper::translation(3084,$translate) }} <span class="require">*</span></label>
                                                
                                                <select name="blog_cat_id" class="form-control" required>
                                                <option value=""></option>
                                                @foreach($catData['view'] as $category)
                                                <option value="{{ $category->blog_cat_id }}" @if($edit['post']->blog_cat_id == $category->blog_cat_id) selected="selected" @endif>{{ $category->blog_category_name }}</option>
                                                @endforeach   
                                                </select>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_desc" class="control-label mb-1">{{ Helper::translation(2940,$translate) }}<span class="require">*</span></label>
                                                
                                            <textarea name="post_short_desc" rows="6"  class="form-control" required>{{ $edit['post']->post_short_desc }}</textarea>
                                            </div>
                                            
                                             <div class="form-group">
                                                <label for="site_desc" class="control-label mb-1">{{ Helper::translation(2941,$translate) }}<span class="require">*</span></label>
                                                
                                            <textarea name="post_desc" id="summary-ckeditor" rows="6"  class="form-control">{{ html_entity_decode($edit['post']->post_desc) }}</textarea>
                                            </div>
                                                
                                            <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">{{ Helper::translation(5040,$translate) }}<span class="require">*</span></label>
                                                
                                            <input type="file" id="post_image" name="post_image" class="form-control-file" @if($edit['post']->post_image == '') required @endif>
                                            @if($edit['post']->post_image != '')
                                                <img height="50" width="50" src="{{ url('/') }}/public/storage/post/{{ $edit['post']->post_image }}" />
                                                @endif
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_desc" class="control-label mb-1">{{ Helper::translation(2974,$translate) }}</label>
                                                
                                            <textarea name="post_tags" rows="6"  class="form-control">{{ $edit['post']->post_tags }}</textarea>
                                            <small>({{ Helper::translation(5043,$translate) }} <strong>{{ Helper::translation(2968,$translate) }}:</strong> {{ Helper::translation(5046,$translate) }})</small>
                                            </div>
                                                                                      
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> {{ Helper::translation(2873,$translate) }} <span class="require">*</span></label>
                                                <select name="post_status" class="form-control" required>
                                                <option value=""></option>
                                                <option value="1" @if($edit['post']->post_status == 1) selected="selected" @endif>{{ Helper::translation(2874,$translate) }}</option>
                                                <option value="0" @if($edit['post']->post_status == 0) selected="selected" @endif>{{ Helper::translation(2875,$translate) }}</option>
                                                </select>
                                                
                                            </div>   
                                        
                                            
                                            
                                                                                       
                                            
                                          <input type="hidden" name="save_post_image" value="{{ $edit['post']->post_image }}">     
                                         <input type="hidden" name="post_id" value="{{ $edit['post']->post_id }}">       
                                        
                                    </div>
                                </div>

                            </div>
                            </div>
                            
                            
                            
                             <div class="col-md-6">
                             
                             
                             
                             
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
