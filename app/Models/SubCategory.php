<?php

namespace Fickrr\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class SubCategory extends Model
{
    
	/* category */
	
	protected $table = 'subcategory';
	protected $fillable     =   [
                                    'subcat_id',
                                    'subcategory_name',
									'subcategory_status'
                                ];
  
  
  public function Category(){
      return $this->belongsTo(Category::class);
   }
   
   public static function getsinglesubcatData($item_cat_id)
  {

    $value=DB::table('subcategory')->where('subcat_id','=',$item_cat_id)->first(); 
    return $value;
	
  }	
  
   public static function getsubcategoryData()
  {

    $value=DB::table('subcategory')->where('drop_status','=','no')->orderBy('subcat_id', 'desc')->get(); 
    return $value;
	
  }
  
}
