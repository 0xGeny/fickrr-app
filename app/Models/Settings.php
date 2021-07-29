<?php

namespace Fickrr\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Settings extends Model
{
    
	
	/* start selling */
	
	  public static function checkuserSubscription($user_id)
	  {
	  $today = date('Y-m-d');
	  $get=DB::table('users')->leftJoin('subscription','subscription.subscr_id','users.user_subscr_id')->where('subscription.subscr_status','=',1)->where('subscription.subscr_drop_status','=','no')->where('users.id','=',$user_id)->where('users.user_subscr_date','>',$today)->where('subscription.subscr_payment_mode','=',1)->get();
	  $value = $get->count(); 
	  return $value;
	  
	  }
	
	
	public static function editAdditional(){
		$value = DB::table('additional_settings')
		  ->where('sno', 1)
		  ->first();
		return $value;
	  }
	  
	  
	  public static function updateAdditionData($data){
		DB::table('additional_settings')
		  ->where('sno', 1)
		  ->update($data);
	  }
	
	public static function editSelling(){
		$value = DB::table('start_selling')
		  ->where('st_id', 1)
		  ->first();
		return $value;
	  }
	
	
	public static function dropSelling($column)
	  {
		 $image = DB::table('start_selling')->where('st_id', 1)->first();
			$file= $image->$column;
			$filename = public_path().'/storage/settings/'.$file;
			File::delete($filename);
	  }
	  
	  
	  public static function updateSelling($sid,$data){
		DB::table('start_selling')
		  ->where('st_id', 1)
		  ->update($data);
	  }
	
	/* start selling */
	
		
	/* general settings */

	  public static function editGeneral($sid){
		$value = DB::table('settings')
		  ->where('sid', 1)
		  ->first();
		return $value;
	  }
	  
	  
	  public static function updategeneralData($sid,$data){
		DB::table('settings')
		  ->where('sid', 1)
		  ->update($data);
	  }
	  
	  public static function getcountryData()
	  {
	
		$value=DB::table('country')->orderBy('country_name', 'asc')->get(); 
		return $value;
		
	  }
	  
	  public static function dropBadges($column)
	  {
		 $image = DB::table('badges')->where('badge_id', 1)->first();
			$file= $image->$column;
			$filename = public_path().'/storage/badges/'.$file;
			File::delete($filename);
	  }
	  
	  
	  public static function dropFavicon($sid)
	  {
		 $image = DB::table('settings')->where('sid', 1)->first();
			$file= $image->site_favicon;
			$filename = public_path().'/storage/settings/'.$file;
			File::delete($filename);
	  }
	  
	  
	  public static function dropLogo($sid)
	  {
		 $image = DB::table('settings')->where('sid', 1)->first();
			$file= $image->site_logo;
			$filename = public_path().'/storage/settings/'.$file;
			File::delete($filename);
	  }
	  
	  
	  public static function dropWatermark($sid)
	  {
		 $image = DB::table('settings')->where('sid', 1)->first();
			$file= $image->site_watermark;
			$filename = public_path().'/storage/settings/'.$file;
			File::delete($filename);
	  }
	  
	  public static function dropLoader($sid)
	  {
		 $image = DB::table('settings')->where('sid', 1)->first();
			$file= $image->site_loader_image;
			$filename = public_path().'/storage/settings/'.$file;
			File::delete($filename);
	  }
	  
	  
	  public static function dropBanner($sid)
	  {
		 $image = DB::table('settings')->where('sid', 1)->first();
			$file= $image->site_banner;
			$filename = public_path().'/storage/settings/'.$file;
			File::delete($filename);
	  }
	  
	  
	  public static function dropadBanner($sid)
	  {
		 $image = DB::table('settings')->where('sid', 1)->first();
			$file= $image->site_blog_adbanner;
			$filename = public_path().'/storage/settings/'.$file;
			File::delete($filename);
	  }
	  
	  
	  public static function dropcountBanner($sid)
	  {
		 $image = DB::table('settings')->where('sid', 1)->first();
			$file= $image->site_count_bg;
			$filename = public_path().'/storage/settings/'.$file;
			File::delete($filename);
	  }
  
  
	/* general settings */
	
	/* badges settings */
	
	public static function editBadges($sid){
		$value = DB::table('badges')
		  ->where('badge_id', 1)
		  ->first();
		return $value;
	  }
	  
	  
	  public static function updateBadges($sid,$data){
    DB::table('badges')
      ->where('badge_id', $sid)
      ->update($data);
  }
	
	/* badges settings */
	
	
	
  
  /* country settings */
  
  public static function savecountryData($data){
   
      DB::table('country')->insert($data);
     
 
    }
	
	
	public static function dropFlag($cid)
	  {
		$image = DB::table('country')->where('country_id', $cid)->first();
			$file= $image->country_badges;
			$filename = public_path().'/storage/flag/'.$file;
			File::delete($filename);
	  }
	
	public static function deleteCountrydata($cid){
    
	$image = DB::table('country')->where('country_id', $cid)->first();
			$file= $image->country_badges;
			$filename = public_path().'/storage/flag/'.$file;
			File::delete($filename);
	DB::table('country')->where('country_id', '=', $cid)->delete();	
	
	
  }
	
	
  public static function editCountry($cid){
    $value = DB::table('country')
      ->where('country_id', $cid)
      ->first();
	return $value;
  }	
  
  
  public static function updatecountryData($cid,$data){
    DB::table('country')
      ->where('country_id', $cid)
      ->update($data);
  }
  
  public static function allCountry(){
    $value = DB::table('country')
      ->orderBy('country_name', 'asc')
      ->get();
	return $value;
  }
	
  public static function allState(){
    $value = DB::table('states')
      ->orderBy('name', 'asc')
      ->get();
	return $value;
  }
	
  public static function allCity(){
    $value = DB::table('cities')
	  ->orderBy('name', 'asc')
	  ->skip(0)->take(100)
      ->get();
	return $value;
  }
	
  /* country settings */	
	
  
  
  
  /* all settings */
  
  public static function allSettings(){
    $value = DB::table('settings')
      ->where('sid', 1)
      ->first();
	return $value;
  }
  
  
  /* all settings */
  
  /* attributes */
  
  public static function allAttributes(){
    $value = DB::table('attributes')
      ->where('attr_id', 1)
      ->first();
	return $value;
  }
  
  /* attributes */
  
  
  
  /* email settings */
  
  public static function updatemailData($sid,$data){
    DB::table('settings')
      ->where('sid', $sid)
      ->update($data);
  }
  
  /* email settings */
  
}
