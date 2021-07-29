<?php

namespace Fickrr\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Blog extends Model
{
    
	/* category */
	
	protected $table = 'category';
  
  public static function getblogcatData()
  {

    $value=DB::table('blog_category')->where('drop_status','=','no')->where('blog_category_status','=',1)->orderBy('blog_cat_id', 'desc')->get(); 
    return $value;
	
  }
  
  
  public static function getblogcategoryData()
  {

    $value=DB::table('blog_category')->where('drop_status','=','no')->orderBy('blog_cat_id', 'desc')->get(); 
    return $value;
	
  }
  
  public static function previous_post($post_id){
    $value = DB::table('post')->where('post_id', '<', $post_id)->orderBy('post_id','desc')->first();
	return $value;
  } 
  
  public static function previous_count($post_id)
  {

    $get=DB::table('post')->where('post_id', '<', $post_id)->orderBy('post_id','desc')->get(); 
    $value = $get->count(); 
    return $value;
	
  }
  
  
  public static function next_post($post_id){
    $value = DB::table('post')->where('post_id', '>', $post_id)->orderBy('post_id','asc')->first();
	return $value;
  } 
  
  public static function next_count($post_id)
  {

    $get=DB::table('post')->where('post_id', '>', $post_id)->orderBy('post_id','asc')->get(); 
    $value = $get->count(); 
    return $value;
	
  }
  
  
  public static function editsingleData($slug){
    $value = DB::table('post')
      ->where('post_slug', $slug)
	  ->first();
	return $value;
  }   
  
  public static function saveblogcategoryData($data){
   
      DB::table('blog_category')->insert($data);
     
 
    }
  
  public static function deleteBlogcategorydata($blog_cat_id,$data){
    
		
	DB::table('blog_category')
      ->where('blog_cat_id', $blog_cat_id)
      ->update($data);
	
  }
  
  
  public static function updatesingleData($slug,$data){
    DB::table('post')
      ->where('post_slug', $slug)
      ->update($data);
  }
  
  
  
  
  public static function editblogcategoryData($blog_cat_id){
    $value = DB::table('blog_category')
      ->where('blog_cat_id', $blog_cat_id)
      ->first();
	return $value;
  }
  
  
  public static function updatecatBlogData($blog_cat_id,$data){
    DB::table('blog_category')
      ->where('blog_cat_id', $blog_cat_id)
      ->update($data);
  }
  
  
  
  
  /* category */
  
  
  /* post */
  
  
 
  
  
   public static function getgrouppostData()
  {

    $value=DB::table('post')->where('post_status','=',1)->orderBy('post_id', 'desc')->get()->groupBy('blog_cat_id'); 
    return $value;
	
  }	
  
  
  public static function getpostcategoryData()
  {

    $value=DB::table('blog_category')->where('drop_status','=','no')->orderBy('blog_cat_id', 'desc')->get(); 
    return $value;
	
  }
  
  
  
  public static function getpostData()
  {

    $value=DB::table('post')->join('blog_category','blog_category.blog_cat_id','post.blog_cat_id')->orderBy('post.post_id', 'desc')->get(); 
    return $value;
	
  }
  
  public static function allpostData()
  {

    $value=DB::table('post')->join('blog_category','blog_category.blog_cat_id','post.blog_cat_id')->where('post.post_status','=',1)->orderBy('post.post_id', 'desc')->get(); 
    return $value;
	
  }
  
  
  public static function catpostData($id)
  {

    $value=DB::table('post')->join('blog_category','blog_category.blog_cat_id','post.blog_cat_id')->where('post.blog_cat_id','=',$id)->where('post.post_status','=',1)->orderBy('post.post_id', 'desc')->get(); 
    return $value;
	
  }
  
  
  
  public static function getpopularData()
  {

    $value=DB::table('post')->where('post_status','=',1)->orderBy('post_view', 'desc')->take(5)->get(); 
    return $value;
	
  }
  
  
  public static function getlatestData()
  {

    $value=DB::table('post')->where('post_status','=',1)->orderBy('post_id', 'desc')->take(5)->get(); 
    return $value;
	
  }
  
  
  public static function insertpostData($data){
   
      DB::table('post')->insert($data);
     
 
    }
	
	
  public static function deletePostdata($post_id){
  
    $image = DB::table('post')->where('post_id', '=', $post_id)->first();
    $file= $image->post_image;
    $filename = public_path().'/storage/post/'.$file;
    File::delete($filename);
    
	DB::table('post')->where('post_id', '=', $post_id)->delete();	
	
	
  }	
  
  
  
  public static function editpostData($post_id){
    $value = DB::table('post')
      ->where('post_id', $post_id)
      ->first();
	return $value;
  }
  
  
  
   public static function updatepostData($post_id,$data){
    DB::table('post')
      ->where('post_id', $post_id)
      ->update($data);
  }
  
  
  public static function dropBlogimage($post_id)
	  {
		 $image = DB::table('post')->where('post_id', $post_id)->first();
			$file= $image->post_image;
			$filename = public_path().'/storage/post/'.$file;
			File::delete($filename);
	  }
  
  /* post */
  
  
  
  /* comment */
  
  
  public static function commentCheck($post_id,$user_id)
  {

    $get=DB::table('post_comment')->where('post_id','=', $post_id)->where('user_id','=', $user_id)->get();
	$value = $get->count(); 
    return $value;
	
  }
  
  public static function savecommentData($data){
   
      DB::table('post_comment')->insert($data);
     
 
    }
	
	
   public static function getcommentData($post_id)
  {

    $value=DB::table('post_comment')->join('users','users.id','post_comment.user_id')->where('post_comment.post_id','=',$post_id)->orderBy('post_comment.comment_id', 'desc')->get(); 
    return $value;
	
  }	
  
  public static function getgroupcommentData()
  {

    $value=DB::table('post_comment')->where('comment_status','=',1)->get()->groupBy('post_id'); 
    return $value;
	
  }	
  
  
  
  public static function getcommentCount($post_id)
  {

    $get=DB::table('post_comment')->where('post_id','=',$post_id)->where('comment_status','=',1)->orderBy('comment_id', 'desc')->get(); 
    $value = $get->count(); 
	return $value;
	
  }	
  
  
  public static function getcountcommentData()
  {

    /*$value=DB::table('post_comment')->join('users','users.id','post_comment.user_id')->orderBy('post_comment.comment_id', 'desc')->get()->groupBy('post_comment.post_id'); 
    return $value;*/
	$value=DB::table('post_comment')->get()->groupBy('post_id'); 
    return $value;
	
  }	
  
   public static function updatecommentData($comment_id, $data){
    DB::table('post_comment')
      ->where('comment_id', $comment_id)
      ->update($data);
  }
  
  public static function deleteCommentdata($comment_id){
  
   
    
	DB::table('post_comment')->where('comment_id', '=', $comment_id)->delete();	
	
	
  }	
  
  /* comment */
  
  
  
  /* tags */
  
   public static function alltagData($slug)
  {

    $value=DB::table('post')->join('blog_category','blog_category.blog_cat_id','post.blog_cat_id')->where('post.post_tags', 'LIKE', "%$slug%")->where('post.post_status','=',1)->orderBy('post.post_id', 'desc')->get(); 
    return $value;
	
  }
  
  /* tags */
  
  
  /* home blog */
  
  public static function homeblogData()
  {

    $value=DB::table('post')->where('post_status','=',1)->orderBy('post_id', 'desc')->take(3)->get(); 
    return $value;
	
  }
  
  /* home blog */
  
  
  public static function totalblogData()
  {

    $get=DB::table('post')->where('post_status','=',1)->orderBy('post_id', 'desc')->get(); 
    $value = $get->count(); 
    return $value;
	
  }
  
  
  
  
  
  
  
}
