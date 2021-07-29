<?php

namespace Fickrr\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Ratings extends Model
{
    
	/* ratings */
	
	protected $table = 'item_ratings';
	
  
  
  public function Items(){
      return $this->belongsTo(Items::class);
   }
   
   
  
}
