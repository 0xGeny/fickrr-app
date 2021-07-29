<?php

namespace Fickrr\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Fickrr\Http\Controllers\Controller;
use Session;
use Fickrr\Models\Blog;
use Fickrr\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Fickrr\Models\Settings;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
		
    }
	
	
	/* category */
	
	public function blog_category()
    {
        
		
		$categoryData['category'] = Blog::getblogcategoryData();
		return view('admin.blog-category',[ 'categoryData' => $categoryData]);
    }
    
	
	public function add_blog_category()
	{
	   
	   return view('admin.add-blog-category');
	}
	
	
	public function category_slug($string){
		   $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
		   return $slug;
    }
	
	
	
	public function save_blog_category(Request $request)
	{
 
    
         $blog_category_name = $request->input('blog_category_name');
		 $blog_category_slug = $this->category_slug($blog_category_name);
		 $blog_category_status = $request->input('blog_category_status');
		 
		 
		 
		 
         
		 $request->validate([
							'blog_category_name' => 'required',
							'blog_category_status' => 'required',
							
         ]);
		 $rules = array(
				'blog_category_name' => ['required', 'max:255', Rule::unique('blog_category') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				
	     );
		 
		 $messsages = array(
		      
	    );
		 
		$validator = Validator::make($request->all(), $rules,$messsages);
		
		if ($validator->fails()) 
		{
		 $failedRules = $validator->failed();
		 return back()->withErrors($validator);
		} 
		else
		{
		
		
		 
		$data = array('blog_category_name' => $blog_category_name, 'blog_category_slug' => $blog_category_slug, 'blog_category_status' => $blog_category_status);
        Blog::saveblogcategoryData($data);
        return redirect('/admin/blog-category')->with('success', 'Insert successfully.');    
 
       } 
     
    
  }
  
  
  
  public function delete_blog_category($blog_cat_id){

      $data = array('drop_status'=>'yes');
	  
        
      Blog::deleteBlogcategorydata($blog_cat_id,$data);
	  
	  return redirect()->back()->with('success', 'Delete successfully.');

    
  }
  
  
  public function edit_blog_category($blog_cat_id)
	{
	   
	   $edit['category'] = Blog::editblogcategoryData($blog_cat_id);
	   return view('admin.edit-blog-category', [ 'edit' => $edit, 'blog_cat_id' => $blog_cat_id]);
	}
	
	
	
	public function update_blog_category(Request $request)
	{
	
	    $blog_category_name = $request->input('blog_category_name');
		 $blog_category_slug = $this->category_slug($blog_category_name);
		 $blog_category_status = $request->input('blog_category_status');
		 
		 
         $blog_cat_id = $request->input('blog_cat_id');
		 $request->validate([
							'blog_category_name' => 'required',
							'blog_category_status' => 'required',
							
         ]);
		 $rules = array(
				'blog_category_name' => ['required', 'max:255', Rule::unique('blog_category') ->ignore($blog_cat_id, 'blog_cat_id') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				
	     );
		 
		 $messsages = array(
		      
	    );
		 
		$validator = Validator::make($request->all(), $rules,$messsages);
		
		if ($validator->fails()) 
		{
		 $failedRules = $validator->failed();
		 return back()->withErrors($validator);
		} 
		else
		{
		
		
		$data = array('blog_category_name' => $blog_category_name, 'blog_category_slug' => $blog_category_slug, 'blog_category_status' => $blog_category_status);
		Blog::updatecatBlogData($blog_cat_id, $data);
		return redirect('/admin/blog-category')->with('success', 'Update successfully.');  
            
 
       } 
     
       
	
	
	}
	
	
	/* category */
	
	
	
	/* posts */
	
	
	public function posts()
    {
        
		
		$postData['post'] = Blog::getpostData();
		$comments = Blog::getcountcommentData();
		return view('admin.post',[ 'postData' => $postData, 'comments' => $comments]);
    }
	
	
	public function add_post()
	{
	   
	   
	   $catData['view'] = Blog::getpostcategoryData();
		return view('admin.add-post',[ 'catData' => $catData]);
	}
	
	
	public function post_slug($string){
		   $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
		   return $slug;
    }
	
	
	public function save_post(Request $request)
	{
 
    
         $post_title = $request->input('post_title');
		 $post_short_desc = $request->input('post_short_desc');
		 $post_desc = htmlentities($request->input('post_desc'));
         $post_slug = $this->post_slug($post_title);
		 $post_status = $request->input('post_status');
		 $blog_cat_id = $request->input('blog_cat_id');
		 $post_tags = $request->input('post_tags');
		 
		 
		$allsettings = Settings::allSettings();
		  $image_size = $allsettings->site_max_image_size;
		 
		 
         
		 $request->validate([
							'post_title' => 'required',
							'post_short_desc' => 'required',
							'post_desc' => 'required',
							'post_image' => 'required|mimes:jpeg,jpg,png|max:'.$image_size,
							'post_status' => 'required',
							'blog_cat_id' => 'required',
							
         ]);
		 $rules = array(
				
				
	     );
		 
		 $messsages = array(
		      
	    );
		 
		$validator = Validator::make($request->all(), $rules,$messsages);
		
		if ($validator->fails()) 
		{
		 $failedRules = $validator->failed();
		 return back()->withErrors($validator);
		} 
		else
		{
		
		$post_date = date('Y-m-d');
		
		if ($request->hasFile('post_image')) {
		     
				   
			$image = $request->file('post_image');
			$img_name = time() . '.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/post');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$post_image = $img_name;
		  }
		  else
		  {
		     $post_image = "";
		  }
		 
		$data = array('post_title' => $post_title, 'post_slug' => $post_slug, 'post_short_desc' => $post_short_desc, 'post_image' => $post_image, 'post_desc' => $post_desc, 'post_date' => $post_date, 'post_status' => $post_status, 'blog_cat_id' => $blog_cat_id, 'post_tags' => $post_tags);
        Blog::insertpostData($data);
		return redirect('/admin/post')->with('success', 'Insert successfully.');
        
            
 
       } 
     
    
  }
  
	
	
	public function delete_post($post_id){

      
	  
      Blog::deletePostdata($post_id);
	  
	  return redirect()->back()->with('success', 'Delete successfully.');

    
  }
  
  
  public function edit_post($post_id)
	{
	   
	   $edit['post'] = Blog::editpostData($post_id);
	   $catData['view'] = Blog::getpostcategoryData();
	   return view('admin.edit-post', [ 'edit' => $edit, 'post_id' => $post_id, 'catData' => $catData]);
	}
	
	
	
	public function update_post(Request $request)
	{
	
	   $post_title = $request->input('post_title');
		 $post_short_desc = $request->input('post_short_desc');
		 $post_desc = htmlentities($request->input('post_desc'));
         $post_slug = $this->post_slug($post_title);
		 $post_status = $request->input('post_status');
		 $blog_cat_id = $request->input('blog_cat_id');
		 
		 $save_post_image = $request->input('save_post_image');
		 $post_id = $request->input('post_id');
		 $post_tags = $request->input('post_tags');
		 
		 $allsettings = Settings::allSettings();
		  $image_size = $allsettings->site_max_image_size;
		 
         
		 $request->validate([
							'post_title' => 'required',
							'post_short_desc' => 'required',
							'post_desc' => 'required',
							'post_image' => 'mimes:jpeg,jpg,png|max:'.$image_size,
							'post_status' => 'required',
							'blog_cat_id' => 'required',
							
         ]);
		 $rules = array(
				
				
	     );
		 
		 $messsages = array(
		      
	    );
		 
		$validator = Validator::make($request->all(), $rules,$messsages);
		
		if ($validator->fails()) 
		{
		 $failedRules = $validator->failed();
		 return back()->withErrors($validator);
		} 
		else
		{
		
		
		$post_date = date('Y-m-d');
		
		if ($request->hasFile('post_image')) 
		{
		     
			Blog::dropBlogimage($post_id);	   
			$image = $request->file('post_image');
			$img_name = time() . '.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/post');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$post_image = $img_name;
		  }
		  else
		  {
		     $post_image = $save_post_image;
		  }
		 
		$data = array('post_title' => $post_title, 'post_slug' => $post_slug, 'post_short_desc' => $post_short_desc, 'post_image' => $post_image, 'post_desc' => $post_desc, 'post_date' => $post_date, 'post_status' => $post_status, 'blog_cat_id' => $blog_cat_id, 'post_tags' => $post_tags);
		
		
		
        Blog::updatepostData($post_id, $data);
        return redirect('/admin/post')->with('success', 'Update successfully.');
            
 
       } 
     
       
	
	
	}
	
	
	/* posts */
	
	
	/* comments */
	
	
	public function comments($post_id)
	{
	  $commentData['post'] = Blog::getcommentData($post_id);
	  return view('admin.comment',[ 'commentData' => $commentData]);
	}
	
	
	public function delete_comment($delete,$comment_id){

      
	  
      Blog::deleteCommentdata($comment_id);
	  
	  return redirect()->back()->with('success', 'Delete successfully.');

    
  }
  
  public function comment_status($status,$comment_id)
  {
     if($status == 0)
	 {
	   $status_value = 1;
	 }
	 else
	 {
	   $status_value = 0;
	 }
	 
	 $data = array( 'comment_status' => $status_value);
	 
	 Blog::updatecommentData($comment_id, $data);
     return redirect()->back()->with('success', 'Update successfully.');
  
  }
  
  
	/* comments */
	
	
	
	
	
}
