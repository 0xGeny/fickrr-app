<?php

namespace Fickrr\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Subscription extends Model
{
    
	/* subscription */
	
  
  public static function getsubscriData()
  {

    $value=DB::table('subscription')->where('subscr_drop_status','=','no')->orderBy('subscr_id', 'desc')->get(); 
    return $value;
	
  }
  
  public static function viewSubscription()
  {
  $value=DB::table('subscription')->where('subscr_status','=',1)->where('subscr_drop_status','=','no')->orderBy('subscr_id', 'asc')->get(); 
    return $value;
  
  }
  
  
  public static function upsubscribeData($user_id,$updatedata)
  {
    DB::table('users')
      ->where('id', $user_id)
	  ->update($updatedata);
  }
  
  
  public static function confirmsubscriData($user_id,$checkoutdata)
  {
    DB::table('users')
      ->where('id', $user_id)
	  ->update($checkoutdata);
  }
  
  
  public static function confirmupgradeData($token,$checkoutdata)
  {
    DB::table('users')
      ->where('user_token', $token)
	  ->update($checkoutdata);
  }
  
  
  public static function insertsubData($data){
   
      DB::table('subscription')->insert($data);
     
 
    }
	
   public static function deleteSubscrdata($subscr_id,$data){
   
    
    DB::table('subscription')
      ->where('subscr_id', $subscr_id)
      ->update($data);
		
	
	
  }	
  
  
  public static function editsubData($subscr_id){
    $value = DB::table('subscription')
      ->where('subscr_id', $subscr_id)
      ->first();
	return $value;
  }
	
	
	
  public static function updatesubData($subscr_id,$data){
    DB::table('subscription')
      ->where('subscr_id', $subscr_id)
      ->update($data);
  }
  	
  public static function getSubscription($subscr_id)
  {
  $value=DB::table('subscription')->where('subscr_status','=',1)->where('subscr_drop_status','=','no')->where('subscr_id','=',$subscr_id)->first(); 
    return $value;
  
  }
 
  /* subscription */
  
  
  
	
	
	
	
	
  
  
  
  
}
