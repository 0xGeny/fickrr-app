<?php

namespace Fickrr\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Coupon extends Model
{
    
	
	
	
	/* coupon */
	
	
  
  public static function getCoupon($user_id)
  {

    $value=DB::table('coupon')->where('user_id','=',$user_id)->orderBy('coupon_id', 'desc')->get(); 
    return $value;
	
  }
  
      
  
  public static function insertCoupon($data){
   
      DB::table('coupon')->insert($data);
     
 
    }
  
  public static function deleteCoupon($couponid){
    
	
	DB::table('coupon')->where('coupon_id', '=', $couponid)->delete();
	
  }
  
  
  
  public static function editCoupon($couponid){
    $value = DB::table('coupon')
      ->where('coupon_id', '=', $couponid)
      ->first();
	return $value;
  }
  
  
  public static function updateCoupon($coupon_id, $data){
    DB::table('coupon')
      ->where('coupon_id', '=', $coupon_id)
      ->update($data);
  }
  
    
  
  /* coupon */
  
  
  
	
	
	
	
	
  
  
  
  
}
