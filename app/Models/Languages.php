<?php

namespace Fickrr\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Languages extends Model
{
    
	
	
	
	
  public static function viewLanguage()
  {

    $value=DB::table('languages')->orderBy('language_id', 'desc')->get(); 
    return $value;
	
  }	
  
  public static function allLanguage()
  {

    $value=DB::table('languages')->where('language_status', '=', 1)->orderBy('language_order', 'asc')->get(); 
    return $value;
	
  }
  
  public static function saveOnebyOne($data)
  {
   
      $id = DB::table('keywords')->insertGetId($data);
	  return $id;
     
 
  }
  
  public static function getSimpleData($code)
  {
    $value=DB::table('languages')->where('language_code', '!=', $code)->where('language_status', '=', 1)->orderBy('language_order', 'asc')->get(); 
    return $value;
	 
  }
  
  
  public static function defaultLanguage()
  {

    $value=DB::table('languages')->where('language_default', '=', 1)->where('language_status', '=', 1)->first(); 
    return $value;
	
  }
  
  public static function defaultLanguageCount()
  {

    $get=DB::table('languages')->where('language_default', '=', 1)->where('language_status', '=', 1)->get(); 
	$value = $get->count(); 
    return $value;
    
	
  }
  
  
  public static function getLanguageData($code)
  {
    $value=DB::table('languages')->where('language_code', '=', $code)->orderBy('language_id', 'asc')->get(); 
    return $value;
	 
  }
  
   public static function getKeywordData($code)
  {
    $value=DB::table('keywords')->where('language_code', '=', $code)->orderBy('keyword_id', 'asc')->get(); 
    return $value;
	 
  }
  
  
  public static function getLanguage($code)
  {

    $value=DB::table('languages')->where('language_code', '=', $code)->first(); 
    return $value;
	
  }	
  
  public static function en_Translate($id,$code)
  {

    $value=DB::table('keywords')->where('keyword_id', '=', $id)->where('language_code', '=', $code)->first(); 
    return $value;
	
  }	
  
  public static function other_Translate($id,$code)
  {

    $value=DB::table('keywords')->where('keyword_parent', '=', $id)->where('language_code', '=', $code)->first(); 
    return $value;
	
  }	
  
  
   public static function saveKeywords($data)
  {
   
      DB::table('keywords')->insert($data);
     
 
  }
  
  public static function saveLanguage($data)
  {
   
      DB::table('languages')->insert($data);
     
 
  }
  
  public static function deleteKeyword($code)
  {
     DB::table('keywords')->where('language_code', '=', $code)->where('keyword_parent', '!=', 0)->delete();
  }
  
  
  public static function deleteLanguages($token)
  {
     DB::table('languages')->where('language_token', '=', $token)->where('language_code', '!=', 'en')->delete();
  }
  
  
  public static function singleLangugage($token)
  {
     $value=DB::table('languages')->where('language_token', '=', $token)->first();
	 return $value;
  }
  
  
  public static function updateLanguage($token,$data){
    DB::table('languages')
      ->where('language_token', $token)
      ->update($data);
  }
  
  public static function checkLanguage($language_token)
  {
    $get=DB::table('languages')->where('language_token', $language_token)->get();
	$value = $get->count(); 
    return $value;
	 
  }
  
  
  public static function checkKeywords($language_code,$keyword_token)
  {
    $get=DB::table('keywords')->where('keyword_token', $keyword_token)->where('language_code', $language_code)->get();
	$value = $get->count(); 
    return $value;
	 
  }
  
  
  public static function removeDefaultLanguage($language_token,$record)
  {
    
	DB::table('languages')
      ->where('language_token','!=', $language_token)
      ->update($record);
  
  }
  
  
  public static function getKeyword($code)
  {
     $value=DB::table('keywords')->where('language_code', $code)->orderBy('keyword_id', 'asc')->get(); 
     return $value;
  }
  
  public static function updateKeyword($key_id,$code,$token,$data){
    DB::table('keywords')
      ->where('keyword_id', $key_id)
	  ->where('language_code', $code)
	  ->where('keyword_token', $token)
      ->update($data);
  }
  
  
  
}
