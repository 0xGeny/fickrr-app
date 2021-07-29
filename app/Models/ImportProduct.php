<?php

namespace Fickrr\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Auth;
use Fickrr\Models\Import;
use Fickrr\Models\Items;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportProduct implements ToModel
{
	
   public function model(array $row)
    {
	     
	    
           $data = Items::findProduct($row[2]);
		   if($row[33] == ""){ $item_views = 0; } else { $item_views = $row[33]; }
		   if($row[34] == ""){ $free_download = 0; } else { $free_download = $row[34]; }
		   if($row[41] == ""){ $download_count = 0; } else { $download_count = $row[41]; }
		   if($row[42] == ""){ $item_flash = 0; } else { $item_flash = $row[42]; }
		   if($row[43] == ""){ $item_flash_request = 0; } else { $item_flash_request = $row[43]; }
           if (empty($data)) {
          
					  return new Import([
					   'user_id'    => $row[1], 
					   'item_token' => $row[2],
					   'item_name' => $row[3],
					   'item_slug' => $row[4],
					   'item_desc' => $row[5],
					   'item_shortdesc' => $row[6],
					   'item_thumbnail' => $row[7],
					   'item_preview' => $row[8],
					   'item_file' => $row[9],
					   'item_category' => $row[10],
					   'item_category_type' => $row[11],
					   'item_type_cat_id' => $row[12],
					   'item_type' => $row[13],
					   'regular_price' => $row[14],
					   'extended_price' => $row[15],
					   'compatible_browsers' => $row[16],
					   'package_includes' => $row[17],
					   'package_includes_two' => $row[18],
					   'columns' => $row[19],
					   'layout' => $row[20],
					   'package_includes_three' => $row[21],
					   'layered' => $row[22],
					   'cs_version' => $row[23],
					   'print_dimensions' => $row[24],
					   'pixel_dimensions' => $row[25],
					   'package_includes_four' => $row[26],
					   'demo_url' => $row[27],
					   'video_preview_type' => $row[28],
					   'video_file' => $row[29],
					   'video_url' => $row[30],
					   'item_tags' => $row[31],
					   'item_liked' => $row[32],
					   'item_views' => $item_views,
					   'free_download' => $free_download,
					   'item_featured' => $row[35],
					   'item_sold' => $row[36],
					   'future_update' => $row[37],
					   'item_support' => $row[38],
					   'created_item' => $row[39],
					   'updated_item' => $row[40],
					   'download_count' => $download_count,
					   'item_flash' => $item_flash,
					   'item_flash_request' => $item_flash_request,
					   'item_allow_seo' => $row[44],
					   'item_seo_keyword' => $row[45],
					   'item_seo_desc' => $row[46],
					   'drop_status' => $row[47],
					   'item_status' => $row[48],
					]);
		  
		  
              } 
     
	    
	
        
    }
   
   
  
  
}
