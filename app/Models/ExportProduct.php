<?php

namespace Fickrr\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Auth;
use Fickrr\Models\Items;
use Maatwebsite\Excel\Concerns\FromCollection;
/*use Maatwebsite\Excel\Concerns\WithHeadings;*/
/*class ExportProduct implements FromCollection, WithHeadings*/

class ExportProduct implements FromCollection
{

   protected $table = 'items';
   
   public function collection()
    {
        return Items::GetAllProducts();
    }
  
    public function headings(): array
    {
        return [
            'item_id',
            'user_id',
            'item_token',
            'item_name',
            'item_slug',
			'item_desc',
			'item_shortdesc',
			'item_thumbnail',
			'item_preview',
			'item_file',
			'item_category',
			'item_category_type',
			'item_type_cat_id',
			'item_type',
			'regular_price',
			'extended_price',
			'compatible_browsers',
			'package_includes',
			'package_includes_two',
			'columns',
			'layout',
			'package_includes_three',
			'layered',
			'cs_version',
			'print_dimensions',
			'pixel_dimensions',
			'package_includes_four',
			'demo_url',
			'video_preview_type',
			'video_file',
			'video_url',
			'item_tags',
			'item_liked',
			'item_views',
			'free_download',
			'item_featured',
			'item_sold',
			'future_update',
			'item_support',
			'created_item',
			'updated_item',
			'download_count',
			'item_flash',
			'item_flash_request',
			'item_allow_seo',
			'item_seo_keyword',
			'item_seo_desc',
			'drop_status',
			'item_status'
			
			
        ];
    }

  
}
