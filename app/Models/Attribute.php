<?php

namespace Fickrr\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Attribute extends Model
{
    
	/* attribute */
	
	public static function getattributeViews($token)
   {
   
     $value=DB::table('items_attributes')->where('item_token','=',$token)->orderBy('item_attribute_label', 'asc')->get(); 
     return $value;
   
   }
	
	
   public static function getattributeData()
  {

    $value=DB::table('attributes')->leftJoin('item_type','item_type.item_type_id','attributes.attr_category')->where('attributes.attr_drop_status','=','no')->orderBy('attributes.attr_id', 'desc')->get(); 
    return $value;
	
  }	
  
  
  public static function allAttribute(){
    $value = DB::table('attributes')
      ->where('attr_field_status', 1)
	  ->where('attr_drop_status', 'no')
	  ->orderBy('attr_field_order', 'asc')
      ->get();
	return $value;
  }
  
  public static function selectedAttribute($cat_id){
    $value = DB::table('attributes')
      ->where('attr_category', $cat_id)
	  ->where('attr_field_status', 1)
	  ->where('attr_drop_status', 'no')
	  ->orderBy('attr_field_order', 'asc')
      ->get();
	return $value;
  }
  
  public static function againAttribute($cat_id,$token){
    $value = DB::table('attributes')
	  ->join('items_attributes','items_attributes.attribute_id','attributes.attr_id')
	  ->where('items_attributes.item_token', $token)
      ->where('attributes.attr_category', $cat_id)
	  ->where('attributes.attr_field_status', 1)
	  ->where('attributes.attr_drop_status', 'no')
	  ->orderBy('attributes.attr_field_order', 'asc')
      ->get();
	return $value;
  }
  
  
  public static function insertattributeData($data){
   
      DB::table('attributes')->insert($data);
     
 
    }
	
	
	public static function deleteAttributedata($attr_id,$data){
    
		
	DB::table('attributes')
      ->where('attr_id', $attr_id)
      ->update($data);
	
  }
  
  
  public static function editattributeData($attr_id){
    $value = DB::table('attributes')
      ->where('attr_id', $attr_id)
      ->first();
	return $value;
  }
	
	
  
  
  
  public static function updateattributeData($attr_id, $data){
    DB::table('attributes')
      ->where('attr_id', $attr_id)
      ->update($data);
  }
  
  
  
  
  /* category */
  
  
  
  
  
  
  
  
}
