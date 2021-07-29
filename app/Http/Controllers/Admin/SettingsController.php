<?php

namespace Fickrr\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Fickrr\Http\Controllers\Controller;
use Session;
use Fickrr\Models\Settings;
use Fickrr\Models\Pages;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Image;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	    
		
	public function media_settings()
	{
	
	    $sid = 1;
		$setting['setting'] = Settings::editGeneral($sid);
		$additional['setting'] = Settings::editAdditional();
		
		return view('admin.media-settings', [ 'setting' => $setting, 'sid' => $sid, 'additional' => $additional]);
	
	}
	
	
	
	public function badges_settings()
	{
	
	    $sid = 1;
		$setting['setting'] = Settings::editBadges($sid);
		
		return view('admin.badges-settings', [ 'setting' => $setting, 'sid' => $sid]);
	
	}
	
	
	public function update_badges_settings(Request $request)
	{
	
	   $author_sold_level_one = $request->input('author_sold_level_one');
	   $author_sold_level_two = $request->input('author_sold_level_two');
	   $author_sold_level_three = $request->input('author_sold_level_three');
	   $author_sold_level_four = $request->input('author_sold_level_four');
	   $author_sold_level_five = $request->input('author_sold_level_five');
	   $author_sold_level_six = $request->input('author_sold_level_six');
	   $author_sold_level_six_label = $request->input('author_sold_level_six_label');
	   
	   $author_collect_level_one = $request->input('author_collect_level_one');
	   $author_collect_level_two = $request->input('author_collect_level_two');
	   $author_collect_level_three = $request->input('author_collect_level_three');
	   $author_collect_level_four = $request->input('author_collect_level_four');
	   $author_collect_level_five = $request->input('author_collect_level_five');
	   $author_collect_level_six = $request->input('author_collect_level_six');
	   
	   
	   $author_referral_level_one = $request->input('author_referral_level_one');
	   $author_referral_level_two = $request->input('author_referral_level_two');
	   $author_referral_level_three = $request->input('author_referral_level_three');
	   $author_referral_level_four = $request->input('author_referral_level_four');
	   $author_referral_level_five = $request->input('author_referral_level_five');
	   $author_referral_level_six = $request->input('author_referral_level_six');
	   
	   
	   $save_exclusive_author_icon = $request->input('save_exclusive_author_icon');
	   $save_author_sold_level_one_icon = $request->input('save_author_sold_level_one_icon');
	   $save_author_sold_level_two_icon = $request->input('save_author_sold_level_two_icon');
	   $save_author_sold_level_three_icon = $request->input('save_author_sold_level_three_icon');
	   $save_author_sold_level_four_icon = $request->input('save_author_sold_level_four_icon');
	   $save_author_sold_level_five_icon = $request->input('save_author_sold_level_five_icon');
	   $save_author_sold_level_six_icon = $request->input('save_author_sold_level_six_icon');
	   
	   $save_author_collect_level_one_icon = $request->input('save_author_collect_level_one_icon');
	   $save_author_collect_level_two_icon = $request->input('save_author_collect_level_two_icon');
	   $save_author_collect_level_three_icon = $request->input('save_author_collect_level_three_icon');
	   $save_author_collect_level_four_icon = $request->input('save_author_collect_level_four_icon');
	   $save_author_collect_level_five_icon = $request->input('save_author_collect_level_five_icon');
	   $save_author_collect_level_six_icon = $request->input('save_author_collect_level_six_icon');
	   
	   $save_author_referral_level_one_icon = $request->input('save_author_referral_level_one_icon');
	   $save_author_referral_level_two_icon = $request->input('save_author_referral_level_two_icon');
	   $save_author_referral_level_three_icon = $request->input('save_author_referral_level_three_icon');
	   $save_author_referral_level_four_icon = $request->input('save_author_referral_level_four_icon');
	   $save_author_referral_level_five_icon = $request->input('save_author_referral_level_five_icon');
	    $save_author_referral_level_six_icon = $request->input('save_author_referral_level_six_icon');
		
		$save_trends_icon = $request->input('save_trends_icon');
		$save_featured_item_icon = $request->input('save_featured_item_icon');
		$save_power_elite_author_icon = $request->input('save_power_elite_author_icon');
		$save_free_item_icon = $request->input('save_free_item_icon');
		
		$save_one_year_icon = $request->input('save_one_year_icon');
		$save_two_year_icon = $request->input('save_two_year_icon');
		$save_three_year_icon = $request->input('save_three_year_icon');
		$save_four_year_icon = $request->input('save_four_year_icon');
		$save_five_year_icon = $request->input('save_five_year_icon');
		$save_six_year_icon = $request->input('save_six_year_icon');
		$save_seven_year_icon = $request->input('save_seven_year_icon');
		$save_eight_year_icon = $request->input('save_eight_year_icon');
		$save_nine_year_icon = $request->input('save_nine_year_icon');
		$save_ten_year_icon = $request->input('save_ten_year_icon');
		
	   
	   $sid = $request->input('sid');
	   $allsettings = Settings::allSettings();
	   $image_size = $allsettings->site_max_image_size;
	   
	   
	    $request->validate([
							'author_sold_level_one' => 'required|numeric|min:0',
							'author_sold_level_two' => 'required|numeric|min:0',
							'author_sold_level_three' => 'required|numeric|min:0',
							'author_sold_level_four' => 'required|numeric|min:0',
							'author_sold_level_five' => 'required|numeric|min:0',
							'author_sold_level_six' => 'required|numeric|min:0',
							
							'author_collect_level_one' => 'required|numeric|min:0',
							'author_collect_level_two' => 'required|numeric|min:0',
							'author_collect_level_three' => 'required|numeric|min:0',
							'author_collect_level_four' => 'required|numeric|min:0',
							'author_collect_level_five' => 'required|numeric|min:0',
							'author_collect_level_six' => 'required|numeric|min:0',
							
							'author_referral_level_one' => 'required|numeric|min:0',
							'author_referral_level_two' => 'required|numeric|min:0',
							'author_referral_level_three' => 'required|numeric|min:0',
							'author_referral_level_four' => 'required|numeric|min:0',
							'author_referral_level_five' => 'required|numeric|min:0',
							'author_referral_level_six' => 'required|numeric|min:0',
							
							'exclusive_author_icon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
                            'trends_icon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
                            'featured_item_icon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
                            'free_item_icon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
                            'one_year_icon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
                            'two_year_icon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
                            'three_year_icon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
                            'four_year_icon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
                            'five_year_icon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
                            'six_year_icon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
                            'seven_year_icon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
                            'eight_year_icon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
                            'nine_year_icon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
                            'ten_year_icon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
                            'ten_year_icon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
                            'author_sold_level_one_icon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
                            'author_sold_level_two_icon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
                            'author_sold_level_three_icon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
                            'author_sold_level_four_icon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
                            'author_sold_level_five_icon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
                            'author_sold_level_six_icon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
                            'power_elite_author_icon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
                            'author_collect_level_one_icon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
                            'author_collect_level_two_icon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
                            'author_collect_level_three_icon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
                            'author_collect_level_four_icon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
                            'author_collect_level_five_icon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
                            'author_collect_level_six_icon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
                            'author_referral_level_one_icon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
                            'author_referral_level_two_icon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
                            'author_referral_level_three_icon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
                            'author_referral_level_four_icon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
                            'author_referral_level_five_icon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
                            'author_referral_level_six_icon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
							
							
         ]);
		 
		  
		 
         
		 
		 $rules = array(
				
				
				
	     );
		 
		 $messsages = array(
		      
	    );
		 
		$validator = Validator::make($request->all(), $rules,$messsages);
		
		if ($validator->fails()) 
		{
		 $failedRules = $validator->failed();
		 return back()->withErrors($validator);
		} 
		else
		{
		
		  if ($request->hasFile('exclusive_author_icon')) 
		  {
		    $column = 'exclusive_author_icon'; 
			Settings::dropBadges($column); 
		    $image = $request->file('exclusive_author_icon');
			$img_name = time() . '1.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/badges');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$exclusive_author_icon = $img_name;
		  }
		  else
		  {
		     $exclusive_author_icon = $request->input('save_exclusive_author_icon');
		  }
		  
		  if ($request->hasFile('author_sold_level_one_icon')) 
		  {
		    $column = 'author_sold_level_one_icon'; 
			Settings::dropBadges($column); 
		    $image = $request->file('author_sold_level_one_icon');
			$img_name = time() . '2.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/badges');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$author_sold_level_one_icon = $img_name;
		  }
		  else
		  {
		     $author_sold_level_one_icon = $request->input('save_author_sold_level_one_icon');
		  }
		  
		  
		  if ($request->hasFile('author_sold_level_two_icon')) 
		  {
		    $column = 'author_sold_level_two_icon'; 
			Settings::dropBadges($column); 
		    $image = $request->file('author_sold_level_two_icon');
			$img_name = time() . '3.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/badges');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$author_sold_level_two_icon = $img_name;
		  }
		  else
		  {
		     $author_sold_level_two_icon = $request->input('save_author_sold_level_two_icon');
		  }
		  
		  
		  if ($request->hasFile('author_sold_level_three_icon')) 
		  {
		    $column = 'author_sold_level_three_icon'; 
			Settings::dropBadges($column); 
		    $image = $request->file('author_sold_level_three_icon');
			$img_name = time() . '4.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/badges');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$author_sold_level_three_icon = $img_name;
		  }
		  else
		  {
		     $author_sold_level_three_icon = $request->input('save_author_sold_level_three_icon');
		  }
		  
		  
		  if ($request->hasFile('author_sold_level_four_icon')) 
		  {
		    $column = 'author_sold_level_four_icon'; 
			Settings::dropBadges($column); 
		    $image = $request->file('author_sold_level_four_icon');
			$img_name = time() . '5.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/badges');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$author_sold_level_four_icon = $img_name;
		  }
		  else
		  {
		     $author_sold_level_four_icon = $request->input('save_author_sold_level_four_icon');
		  }
		  
		  
		  if ($request->hasFile('author_sold_level_five_icon')) 
		  {
		    $column = 'author_sold_level_five_icon'; 
			Settings::dropBadges($column); 
		    $image = $request->file('author_sold_level_five_icon');
			$img_name = time() . '6.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/badges');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$author_sold_level_five_icon = $img_name;
		  }
		  else
		  {
		     $author_sold_level_five_icon = $request->input('save_author_sold_level_five_icon');
		  }
		  
		  
		  if ($request->hasFile('author_sold_level_six_icon')) 
		  {
		    $column = 'author_sold_level_six_icon'; 
			Settings::dropBadges($column); 
		    $image = $request->file('author_sold_level_six_icon');
			$img_name = time() . '7.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/badges');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$author_sold_level_six_icon = $img_name;
		  }
		  else
		  {
		     $author_sold_level_six_icon = $request->input('save_author_sold_level_six_icon');
		  }
		  
		  
		  
		  
		  if ($request->hasFile('author_collect_level_one_icon')) 
		  {
		    $column = 'author_collect_level_one_icon'; 
			Settings::dropBadges($column); 
		    $image = $request->file('author_collect_level_one_icon');
			$img_name = time() . '8.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/badges');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$author_collect_level_one_icon = $img_name;
		  }
		  else
		  {
		     $author_collect_level_one_icon = $request->input('save_author_collect_level_one_icon');
		  }
		  
		  
		  
		  if ($request->hasFile('author_collect_level_two_icon')) 
		  {
		    $column = 'author_collect_level_two_icon'; 
			Settings::dropBadges($column); 
		    $image = $request->file('author_collect_level_two_icon');
			$img_name = time() . '9.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/badges');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$author_collect_level_two_icon = $img_name;
		  }
		  else
		  {
		     $author_collect_level_two_icon = $request->input('save_author_collect_level_two_icon');
		  }
		  
		  
		  
		  if ($request->hasFile('author_collect_level_three_icon')) 
		  {
		    $column = 'author_collect_level_three_icon'; 
			Settings::dropBadges($column); 
		    $image = $request->file('author_collect_level_three_icon');
			$img_name = time() . '10.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/badges');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$author_collect_level_three_icon = $img_name;
		  }
		  else
		  {
		     $author_collect_level_three_icon = $request->input('save_author_collect_level_three_icon');
		  }
		  
		  
		  
		  if ($request->hasFile('author_collect_level_four_icon')) 
		  {
		    $column = 'author_collect_level_four_icon'; 
			Settings::dropBadges($column); 
		    $image = $request->file('author_collect_level_four_icon');
			$img_name = time() . '11.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/badges');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$author_collect_level_four_icon = $img_name;
		  }
		  else
		  {
		     $author_collect_level_four_icon = $request->input('save_author_collect_level_four_icon');
		  }
		  
		  
		  
		  if ($request->hasFile('author_collect_level_five_icon')) 
		  {
		    $column = 'author_collect_level_five_icon'; 
			Settings::dropBadges($column); 
		    $image = $request->file('author_collect_level_five_icon');
			$img_name = time() . '12.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/badges');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$author_collect_level_five_icon = $img_name;
		  }
		  else
		  {
		     $author_collect_level_five_icon = $request->input('save_author_collect_level_five_icon');
		  }
		  
		  
		  
		  if ($request->hasFile('author_collect_level_six_icon')) 
		  {
		    $column = 'author_collect_level_six_icon'; 
			Settings::dropBadges($column); 
		    $image = $request->file('author_collect_level_six_icon');
			$img_name = time() . '13.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/badges');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$author_collect_level_six_icon = $img_name;
		  }
		  else
		  {
		     $author_collect_level_six_icon = $request->input('save_author_collect_level_six_icon');
		  }
		  
		 
		 
		  if ($request->hasFile('author_referral_level_one_icon')) 
		  {
		    $column = 'author_referral_level_one_icon'; 
			Settings::dropBadges($column); 
		    $image = $request->file('author_referral_level_one_icon');
			$img_name = time() . '14.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/badges');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$author_referral_level_one_icon = $img_name;
		  }
		  else
		  {
		     $author_referral_level_one_icon = $request->input('save_author_referral_level_one_icon');
		  } 
		  
		  
		  if ($request->hasFile('author_referral_level_two_icon')) 
		  {
		    $column = 'author_referral_level_two_icon'; 
			Settings::dropBadges($column); 
		    $image = $request->file('author_referral_level_two_icon');
			$img_name = time() . '15.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/badges');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$author_referral_level_two_icon = $img_name;
		  }
		  else
		  {
		     $author_referral_level_two_icon = $request->input('save_author_referral_level_two_icon');
		  } 
		  
		  
		  
		  
		  if ($request->hasFile('author_referral_level_three_icon')) 
		  {
		    $column = 'author_referral_level_three_icon'; 
			Settings::dropBadges($column); 
		    $image = $request->file('author_referral_level_three_icon');
			$img_name = time() . '16.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/badges');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$author_referral_level_three_icon = $img_name;
		  }
		  else
		  {
		     $author_referral_level_three_icon = $request->input('save_author_referral_level_three_icon');
		  } 
		  
		  
		  
		  if ($request->hasFile('author_referral_level_four_icon')) 
		  {
		    $column = 'author_referral_level_four_icon'; 
			Settings::dropBadges($column); 
		    $image = $request->file('author_referral_level_four_icon');
			$img_name = time() . '17.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/badges');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$author_referral_level_four_icon = $img_name;
		  }
		  else
		  {
		     $author_referral_level_four_icon = $request->input('save_author_referral_level_four_icon');
		  } 
		  
		  
		  
		  if ($request->hasFile('author_referral_level_five_icon')) 
		  {
		    $column = 'author_referral_level_five_icon'; 
			Settings::dropBadges($column); 
		    $image = $request->file('author_referral_level_five_icon');
			$img_name = time() . '18.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/badges');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$author_referral_level_five_icon = $img_name;
		  }
		  else
		  {
		     $author_referral_level_five_icon = $request->input('save_author_referral_level_five_icon');
		  } 
		  
		  
		  
		  if ($request->hasFile('author_referral_level_six_icon')) 
		  {
		    $column = 'author_referral_level_six_icon'; 
			Settings::dropBadges($column); 
		    $image = $request->file('author_referral_level_six_icon');
			$img_name = time() . '19.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/badges');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$author_referral_level_six_icon = $img_name;
		  }
		  else
		  {
		     $author_referral_level_six_icon = $request->input('save_author_referral_level_six_icon');
		  } 
		  
		  
		  
		  if ($request->hasFile('trends_icon')) 
		  {
		    $column = 'trends_icon'; 
			Settings::dropBadges($column); 
		    $image = $request->file('trends_icon');
			$img_name = time() . '20.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/badges');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$trends_icon = $img_name;
		  }
		  else
		  {
		     $trends_icon = $request->input('save_trends_icon');
		  } 
		  
		  
		  
		  if ($request->hasFile('featured_item_icon')) 
		  {
		    $column = 'featured_item_icon'; 
			Settings::dropBadges($column); 
		    $image = $request->file('featured_item_icon');
			$img_name = time() . '21.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/badges');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$featured_item_icon = $img_name;
		  }
		  else
		  {
		     $featured_item_icon = $request->input('save_featured_item_icon');
		  } 
		  
		  
		  if ($request->hasFile('power_elite_author_icon')) 
		  {
		    $column = 'power_elite_author_icon'; 
			Settings::dropBadges($column); 
		    $image = $request->file('power_elite_author_icon');
			$img_name = time() . '22.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/badges');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$power_elite_author_icon = $img_name;
		  }
		  else
		  {
		     $power_elite_author_icon = $request->input('save_power_elite_author_icon');
		  } 
		  
		  
		  
		  if ($request->hasFile('free_item_icon')) 
		  {
		    $column = 'free_item_icon'; 
			Settings::dropBadges($column); 
		    $image = $request->file('free_item_icon');
			$img_name = time() . '23.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/badges');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$free_item_icon = $img_name;
		  }
		  else
		  {
		     $free_item_icon = $request->input('save_free_item_icon');
		  } 
		  
		  
		  if ($request->hasFile('one_year_icon')) 
		  {
		    $column = 'one_year_icon'; 
			Settings::dropBadges($column); 
		    $image = $request->file('one_year_icon');
			$img_name = time() . '24.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/badges');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$one_year_icon = $img_name;
		  }
		  else
		  {
		     $one_year_icon = $request->input('save_one_year_icon');
		  } 
		  
		  
		  if ($request->hasFile('two_year_icon')) 
		  {
		    $column = 'two_year_icon'; 
			Settings::dropBadges($column); 
		    $image = $request->file('two_year_icon');
			$img_name = time() . '25.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/badges');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$two_year_icon = $img_name;
		  }
		  else
		  {
		     $two_year_icon = $request->input('save_two_year_icon');
		  } 
		  
		  
		  if ($request->hasFile('three_year_icon')) 
		  {
		    $column = 'three_year_icon'; 
			Settings::dropBadges($column); 
		    $image = $request->file('three_year_icon');
			$img_name = time() . '26.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/badges');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$three_year_icon = $img_name;
		  }
		  else
		  {
		     $three_year_icon = $request->input('save_three_year_icon');
		  } 
		  
		  
		  
		  if ($request->hasFile('four_year_icon')) 
		  {
		    $column = 'four_year_icon'; 
			Settings::dropBadges($column); 
		    $image = $request->file('four_year_icon');
			$img_name = time() . '27.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/badges');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$four_year_icon = $img_name;
		  }
		  else
		  {
		     $four_year_icon = $request->input('save_four_year_icon');
		  } 
		  
		  
		  
		  if ($request->hasFile('five_year_icon')) 
		  {
		    $column = 'five_year_icon'; 
			Settings::dropBadges($column); 
		    $image = $request->file('five_year_icon');
			$img_name = time() . '28.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/badges');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$five_year_icon = $img_name;
		  }
		  else
		  {
		     $five_year_icon = $request->input('save_five_year_icon');
		  } 
		  
		  
		  if ($request->hasFile('six_year_icon')) 
		  {
		    $column = 'six_year_icon'; 
			Settings::dropBadges($column); 
		    $image = $request->file('six_year_icon');
			$img_name = time() . '29.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/badges');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$six_year_icon = $img_name;
		  }
		  else
		  {
		     $six_year_icon = $request->input('save_six_year_icon');
		  } 
		  
		  
		  if ($request->hasFile('seven_year_icon')) 
		  {
		    $column = 'seven_year_icon'; 
			Settings::dropBadges($column); 
		    $image = $request->file('seven_year_icon');
			$img_name = time() . '30.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/badges');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$seven_year_icon = $img_name;
		  }
		  else
		  {
		     $seven_year_icon = $request->input('save_seven_year_icon');
		  } 
		  
		  
		  
		  if ($request->hasFile('eight_year_icon')) 
		  {
		    $column = 'eight_year_icon'; 
			Settings::dropBadges($column); 
		    $image = $request->file('eight_year_icon');
			$img_name = time() . '31.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/badges');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$eight_year_icon = $img_name;
		  }
		  else
		  {
		     $eight_year_icon = $request->input('save_eight_year_icon');
		  } 
		  
		  
		  if ($request->hasFile('nine_year_icon')) 
		  {
		    $column = 'nine_year_icon'; 
			Settings::dropBadges($column); 
		    $image = $request->file('nine_year_icon');
			$img_name = time() . '32.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/badges');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$nine_year_icon = $img_name;
		  }
		  else
		  {
		     $nine_year_icon = $request->input('save_nine_year_icon');
		  } 
		  
		  
		  if ($request->hasFile('ten_year_icon')) 
		  {
		    $column = 'ten_year_icon'; 
			Settings::dropBadges($column); 
		    $image = $request->file('ten_year_icon');
			$img_name = time() . '33.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/badges');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$ten_year_icon = $img_name;
		  }
		  else
		  {
		     $ten_year_icon = $request->input('save_ten_year_icon');
		  }
		
		
		$data = array('author_sold_level_one' => $author_sold_level_one, 'author_sold_level_two' => $author_sold_level_two, 'author_sold_level_three' => $author_sold_level_three, 'author_sold_level_four' => $author_sold_level_four, 'author_sold_level_five' => $author_sold_level_five, 'author_sold_level_six' => $author_sold_level_six, 'author_collect_level_one' => $author_collect_level_one, 'author_collect_level_two' => $author_collect_level_two, 'author_collect_level_three' => $author_collect_level_three, 'author_collect_level_four' => $author_collect_level_four, 'author_collect_level_five' => $author_collect_level_five, 'author_collect_level_six' => $author_collect_level_six, 'author_referral_level_one' => $author_referral_level_one, 'author_referral_level_two' => $author_referral_level_two, 'author_referral_level_three' => $author_referral_level_three, 'author_referral_level_four' => $author_referral_level_four, 'author_referral_level_five' => $author_referral_level_five, 'author_referral_level_six' => $author_referral_level_six, 'exclusive_author_icon' => $exclusive_author_icon, 'author_sold_level_one_icon' => $author_sold_level_one_icon, 'author_sold_level_two_icon' => $author_sold_level_two_icon, 'author_sold_level_three_icon' => $author_sold_level_three_icon, 'author_sold_level_four_icon' => $author_sold_level_four_icon, 'author_sold_level_five_icon' => $author_sold_level_five_icon, 'author_sold_level_six_icon' => $author_sold_level_six_icon,  'author_collect_level_one_icon' => $author_collect_level_one_icon, 'author_collect_level_two_icon' => $author_collect_level_two_icon, 'author_collect_level_three_icon' => $author_collect_level_three_icon, 'author_collect_level_four_icon' => $author_collect_level_four_icon, 'author_collect_level_five_icon' => $author_collect_level_five_icon, 'author_collect_level_six_icon' => $author_collect_level_six_icon, 'author_referral_level_one_icon' => $author_referral_level_one_icon, 'author_referral_level_two_icon' => $author_referral_level_two_icon, 'author_referral_level_three_icon' => $author_referral_level_three_icon, 'author_referral_level_four_icon' => $author_referral_level_four_icon, 'author_referral_level_five_icon' => $author_referral_level_five_icon, 'author_referral_level_six_icon' => $author_referral_level_six_icon, 'author_sold_level_six_label' => $author_sold_level_six_label, 'trends_icon' => $trends_icon, 'featured_item_icon' => $featured_item_icon, 'power_elite_author_icon' => $power_elite_author_icon, 'free_item_icon' => $free_item_icon, 'one_year_icon' => $one_year_icon, 'two_year_icon' => $two_year_icon, 'three_year_icon' => $three_year_icon, 'four_year_icon' => $four_year_icon, 'five_year_icon' => $five_year_icon, 'six_year_icon' => $six_year_icon, 'seven_year_icon' => $seven_year_icon, 'eight_year_icon' => $eight_year_icon, 'nine_year_icon' => $nine_year_icon, 'ten_year_icon' => $ten_year_icon);
        Settings::updateBadges($sid,$data);
        return redirect()->back()->with('success', 'Update successfully.');
		
		}
	   
	   
	   
	   
	 
	}
	
	
	public function color_settings()
	{
	
	    $sid = 1;
		$setting['setting'] = Settings::editGeneral($sid);
		
		return view('admin.color-settings', [ 'setting' => $setting, 'sid' => $sid]);
	
	}
	
	
	public function update_color_settings(Request $request)
	{
	  	$site_theme_color = $request->input('site_theme_color');
		$site_button_color = $request->input('site_button_color');
		$site_header_color = $request->input('site_header_color');
		$site_footer_color = $request->input('site_footer_color');
		$site_button_hover = $request->input('site_button_hover');
	  	$sid = $request->input('sid');
	     
         
		 $request->validate([
		 
					'site_theme_color' => 'required',
					'site_button_color' => 'required',
					'site_header_color' => 'required',
					'site_footer_color' => 'required',			
							
							
							
         ]);
		 
		  
		 
         
		 
		 $rules = array(
				
				
				
	     );
		 
		 $messsages = array(
		      
	    );
		 
		$validator = Validator::make($request->all(), $rules,$messsages);
		
		if ($validator->fails()) 
		{
		 $failedRules = $validator->failed();
		 return back()->withErrors($validator);
		} 
		else
		{
		
			  
		 
		 
		$data = array('site_theme_color' => $site_theme_color, 'site_button_color' => $site_button_color, 'site_header_color' => $site_header_color,  'site_footer_color' => $site_footer_color, 'site_button_hover' => $site_button_hover);
 
			Settings::updatemailData($sid, $data);
            return redirect()->back()->with('success', 'Update successfully.');
            
 
       } 
     
	
	
	
	}
	
	
	
	
	public function update_media_settings(Request $request)
	{
	
	   $site_max_image_size = $request->input('site_max_image_size');
	   $site_max_file_size = $request->input('site_max_file_size');
	   $site_s3_storage = $request->input('site_s3_storage');
	   $aws_access_key_id = $request->input('aws_access_key_id');
	   $aws_secret_access_key = $request->input('aws_secret_access_key');
	   $aws_default_region = $request->input('aws_default_region');
	   $aws_bucket = $request->input('aws_bucket');
		        
         
		 $request->validate([
							'site_max_image_size' => 'required',
							'site_max_file_size' => 'required',
							'site_s3_storage' => 'required',
							
							
         ]);
		 
		  $sid = $request->input('sid');
		 
         
		 
		 $rules = array(
				
				
				
	     );
		 
		 $messsages = array(
		      
	    );
		 
		$validator = Validator::make($request->all(), $rules,$messsages);
		
		if ($validator->fails()) 
		{
		 $failedRules = $validator->failed();
		 return back()->withErrors($validator);
		} 
		else
		{
		
			  
		 
		 
		$data = array('site_max_image_size' => $site_max_image_size, 'site_max_file_size' => $site_max_file_size, 'site_s3_storage' => $site_s3_storage, 'aws_access_key_id' => $aws_access_key_id, 'aws_secret_access_key' => $aws_secret_access_key, 'aws_default_region' => $aws_default_region, 'aws_bucket' => $aws_bucket);
 
            
            
			Settings::updatemailData($sid, $data);
			
            return redirect()->back()->with('success', 'Update successfully.');
            
 
       } 
     
	
	
	}
		
	
	
	public function currency_settings()
    {
        
		$sid = 1;
		$setting['setting'] = Settings::editGeneral($sid);
		
		return view('admin.currency-settings', [ 'setting' => $setting, 'sid' => $sid]);
		
    }
	
	
	
	public function update_currency_settings(Request $request)
	{
	
	     
		 $sid = $request->input('sid');
		 
		 $site_currency_code = $request->input('site_currency_code');
		 $site_currency_symbol = $request->input('site_currency_symbol');
		
		
		 
         
		 $request->validate([
							
							'site_currency_code' => 'required',
							'site_currency_symbol' => 'required',
							
         ]);
		 $rules = array(
				
				
	     );
		 
		 $messsages = array(
		      
	    );
		 
		$validator = Validator::make($request->all(), $rules,$messsages);
		
		if ($validator->fails()) 
		{
		 $failedRules = $validator->failed();
		 return back()->withErrors($validator);
		} 
		else
		{
		
		
		 
		$data = array('site_currency' => $site_currency_code, 'site_currency_symbol' => $site_currency_symbol);
        Settings::updategeneralData($sid, $data);
        return redirect()->back()->with('success', 'Update successfully.');
            
 
       } 
     
       
	
	
	} 
	
		
	/* general settings */
	
	public function general_settings()
    {
        
		$sid = 1;
		$setting['setting'] = Settings::editGeneral($sid);
		$page['view'] = Pages::pagelinkData();
		$additional = Settings::editAdditional();
		return view('admin.general-settings', [ 'setting' => $setting, 'sid' => $sid, 'page' => $page, 'additional' => $additional]);
		
    }
	
	public function demo_mode()
	{
	   return redirect()->back()->with('error', 'This is Demo version. You can not delete');
	}
	
	
	
	public function update_demo_mode(Request $request)
	{
	   return redirect()->back()->with('error', 'This is Demo version. You can not add or change any thing');
	}
	
	
	
	 public function update_general_settings(Request $request)
	{
	
	     $site_title = $request->input('site_title');
	     $site_desc = $request->input('site_desc');
         $site_keywords = $request->input('site_keywords');
		 $sid = $request->input('sid');
		 $site_banner_heading = $request->input('site_banner_heading');
		 $site_banner_subheading = $request->input('site_banner_subheading');
		 $item_approval = $request->input('item_approval');
		 $office_email = $request->input('office_email');
		 $office_phone = $request->input('office_phone');
		 $office_address = $request->input('office_address');
		 $site_newsletter = $request->input('site_newsletter');
		 $site_flash_end_date = $request->input('site_flash_end_date');
		 $site_free_end_date = $request->input('site_free_end_date');
		 $google_analytics = $request->input('google_analytics');
		 $watermark_option = $request->input('watermark_option');
         $allsettings = Settings::allSettings();
		 $image_size = $allsettings->site_max_image_size;
		  
		  $multi_language = $request->input('multi_language');
		  $email_verification = $request->input('email_verification');
		  $payment_verification = $request->input('payment_verification');
		  $home_blog_display = $request->input('home_blog_display');
		  $maintenance_mode = $request->input('maintenance_mode');
		  $m_mode_title = $request->input('m_mode_title');
		  $m_mode_content = $request->input('m_mode_content');
		  $site_loader_display = $request->input('site_loader_display');
		  $save_loader_image = $request->input('save_loader_image');
		  $cookie_popup = $request->input('cookie_popup');
		  $cookie_popup_text = $request->input('cookie_popup_text');
		  $cookie_popup_button = $request->input('cookie_popup_button');
		  $item_support_link = $request->input('item_support_link');
		  
		  $site_google_recaptcha = $request->input('site_google_recaptcha');
		 
		 $request->validate([
							'site_title' => 'required',
							'site_favicon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
							'site_logo' => 'mimes:jpeg,jpg,png|max:'.$image_size,
							'site_banner' => 'mimes:jpeg,jpg,png|max:'.$image_size,
							'site_watermark' => 'mimes:jpeg,jpg,png|max:'.$image_size,
							
         ]);
		 $rules = array(
				
				
	     );
		 
		 $messsages = array(
		      
	    );
		 
		$validator = Validator::make($request->all(), $rules,$messsages);
		
		if ($validator->fails()) 
		{
		 $failedRules = $validator->failed();
		 return back()->withErrors($validator);
		} 
		else
		{
		
		if ($request->hasFile('site_favicon')) {
		     
			Settings::dropFavicon($sid); 
		   
			$image = $request->file('site_favicon');
			$img_name = time() . '.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/settings');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$fav_image = $img_name;
		  }
		  else
		  {
		     $fav_image = $request->input('save_favicon');
		  }
		  
		  
		  
		  if ($request->hasFile('site_logo')) {
		     
			Settings::dropLogo($sid); 
		   
			$image = $request->file('site_logo');
			$img_name = time() . '11.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/settings');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$logo_image = $img_name;
		  }
		  else
		  {
		     $logo_image = $request->input('save_logo');
		  }
		  
		  
		  
		  if ($request->hasFile('site_banner')) {
		     
			Settings::dropBanner($sid); 
		   
			$image = $request->file('site_banner');
			$img_name = time() . '11.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/settings');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$banner_image = $img_name;
		  }
		  else
		  {
		     $banner_image = $request->input('save_banner');
		  }
		  
		  if ($request->hasFile('site_loader_image')) {
		     
			Settings::dropLoader($sid); 
		   
			$image = $request->file('site_loader_image');
			$img_name = time() . '6713.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/settings');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$site_loader_image = $img_name;
		  }
		  else
		  {
		     $site_loader_image = $save_loader_image;
		  }
		  
		  		  
		  if ($request->hasFile('site_watermark')) {
		     
			Settings::dropWatermark($sid); 
		   
			$image = $request->file('site_watermark');
			$img_name = time() . '141.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/settings');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$site_watermark = $img_name;
		  }
		  else
		  {
		     $site_watermark = $request->input('save_watermark');
		  }
		  
		 
		 
		$data = array('site_title' => $site_title, 'site_desc' => $site_desc, 'site_keywords' => $site_keywords, 'site_favicon' => $fav_image, 'site_logo' => $logo_image,  'site_banner' => $banner_image, 'site_banner_heading' => $site_banner_heading, 'site_banner_subheading' => $site_banner_subheading, 'item_approval' => $item_approval,  'office_address' => $office_address, 'office_email' => $office_email, 'office_phone' => $office_phone, 'site_flash_end_date' => $site_flash_end_date, 'site_free_end_date' => $site_free_end_date, 'site_newsletter' => $site_newsletter, 'site_watermark' => $site_watermark, 'google_analytics' => $google_analytics, 'watermark_option' => $watermark_option, 'multi_language' => $multi_language, 'email_verification' => $email_verification, 'payment_verification' => $payment_verification, 'home_blog_display' => $home_blog_display, 'maintenance_mode' => $maintenance_mode, 'm_mode_title' => $m_mode_title, 'm_mode_content' => $m_mode_content, 'site_loader_image' => $site_loader_image, 'site_loader_display' => $site_loader_display, 'cookie_popup' => $cookie_popup, 'cookie_popup_text' => $cookie_popup_text, 'cookie_popup_button' => $cookie_popup_button, 'item_support_link' => $item_support_link);
 
            
            
			Settings::updategeneralData($sid, $data);
			$addition_data = array('site_google_recaptcha' => $site_google_recaptcha);
			Settings::updateAdditionData($addition_data);
            return redirect()->back()->with('success', 'Update successfully.');
            
 
       } 
     
       
	
	
	} 
	
	/* general settings */
	
	
	public function limitation_settings()
	{
	
	    $sid = 1;
		$setting['setting'] = Settings::editGeneral($sid);
		
		return view('admin.limitation-settings', [ 'setting' => $setting, 'sid' => $sid]);
	
	}
	
	public function update_limitation_settings(Request $request)
	{
	   	   
	      
	   $site_item_per_page = $request->input('site_item_per_page');
	   $site_comment_per_page = $request->input('site_comment_per_page');
	   $site_post_per_page = $request->input('site_post_per_page');
	   $site_review_per_page = $request->input('site_review_per_page');
	   $site_menu_category = $request->input('site_menu_category');
	   $menu_categories_order = $request->input('menu_categories_order');
	   $footer_menu_display_categories = $request->input('footer_menu_display_categories');
	   $footer_menu_categories_order = $request->input('footer_menu_categories_order');
	   $home_featured_items = $request->input('home_featured_items');
	   $home_flash_items = $request->input('home_flash_items');
	   $home_popular_items = $request->input('home_popular_items');
	   $site_newest_files = $request->input('site_newest_files');
	   $home_blog_post = $request->input('home_blog_post');
	   $home_free_items = $request->input('home_free_items');
	   $site_range_min_price = $request->input('site_range_min_price');
	   $site_range_max_price = $request->input('site_range_max_price');
	   	   
	   $sid = $request->input('sid');
	         
         
		 $request->validate([
		 
							
							
							
							
         ]);
		 
		  
		 
         
		 
		 $rules = array(
				
				
				
	     );
		 
		 $messsages = array(
		      
	    );
		 
		$validator = Validator::make($request->all(), $rules,$messsages);
		
		if ($validator->fails()) 
		{
		 $failedRules = $validator->failed();
		 return back()->withErrors($validator);
		} 
		else
		{
		
		 
		   $data = array('site_item_per_page' => $site_item_per_page, 'site_post_per_page' => $site_post_per_page, 'home_featured_items' => $home_featured_items, 'home_flash_items' => $home_flash_items, 'home_popular_items' => $home_popular_items, 'site_newest_files' => $site_newest_files, 'home_blog_post' => $home_blog_post, 'site_comment_per_page' => $site_comment_per_page, 'site_review_per_page' => $site_review_per_page, 'site_range_min_price' => $site_range_min_price, 'site_range_max_price' => $site_range_max_price, 'site_menu_category' => $site_menu_category, 'menu_categories_order' => $menu_categories_order, 'home_free_items' => $home_free_items, 'footer_menu_display_categories' => $footer_menu_display_categories, 'footer_menu_categories_order' => $footer_menu_categories_order);
 
			Settings::updategeneralData($sid, $data);
            return redirect()->back()->with('success', 'Update successfully.');
            
 
       } 
     
	
	
	}
	
	
	
	
  
  /* country settings */
  
  
  public function country_settings()
    {
        
		
		$country['data'] = Settings::getcountryData();
		return view('admin.country-settings',[ 'country' => $country]);
    }
	
	
	public function add_country()
	{
	   
	   return view('admin.add-country');
	}
	
	
	public function save_country(Request $request)
	{
 
    
         $country_name = $request->input('country_name');
		 $allsettings = Settings::allSettings();
	   $image_size = $allsettings->site_max_image_size;        
         
		 $request->validate([
							'country_name' => 'required',
							'country_badges' => 'mimes:jpeg,jpg,png|required|max:'.$image_size,
							
							
         ]);
		 $rules = array(
				
				'country_name' => ['required', 'max:255', Rule::unique('country') -> where(function($sql){ $sql->where('country_name','!=','');})],
	     );
		 
		 $messsages = array(
		      
	    );
		 
		$validator = Validator::make($request->all(), $rules,$messsages);
		
		if ($validator->fails()) 
		{
		 $failedRules = $validator->failed();
		 return back()->withErrors($validator);
		} 
		else
		{
		
		if ($request->hasFile('country_badges')) 
		  {
		    
			$image = $request->file('country_badges');
			$img_name = time() . '147.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/flag');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$country_badges = $img_name;
		  }
		  else
		  {
		     $country_badges = "";
		  }
		
				 
		$data = array('country_name' => $country_name, 'country_badges' => $country_badges);
 
            
            Settings::savecountryData($data);
            return redirect('/admin/country-settings')->with('success', 'Insert successfully.');
            
 
       } 
     
    
  }
  
  
  
  public function delete_country($cid){

      
	  
      Settings::deleteCountrydata($cid);
	  
	  return redirect()->back()->with('success', 'Delete successfully.');

    
  }
  
  
  public function edit_country($cid)
	{
	   
	   $edit['country'] = Settings::editCountry($cid);
	   return view('admin.edit-country', [ 'edit' => $edit, 'cid' => $cid]);
	}
	
	
	
	public function update_country(Request $request)
	{
	
	   $country_name = $request->input('country_name');
	   $save_country_badges = $request->input('save_country_badges');
		   $allsettings = Settings::allSettings();
	   $image_size = $allsettings->site_max_image_size;        
         
		 $request->validate([
							'country_name' => 'required',
							'country_badges' => 'mimes:jpeg,jpg,png|max:'.$image_size,
							
							
         ]);
		 
		  $cid = $request->input('cid');
		 
         
		 
		 $rules = array(
				'country_name' => ['required', 'max:255', Rule::unique('country') ->ignore($cid, 'country_id') -> where(function($sql){ $sql->where('country_name','!=','');})],
				
				
	     );
		 
		 $messsages = array(
		      
	    );
		 
		$validator = Validator::make($request->all(), $rules,$messsages);
		
		if ($validator->fails()) 
		{
		 $failedRules = $validator->failed();
		 return back()->withErrors($validator);
		} 
		else
		{
		
			 if ($request->hasFile('country_badges')) 
		  {
		    Settings::dropFlag($cid); 
			$image = $request->file('country_badges');
			$img_name = time() . '147.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/flag');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$country_badges = $img_name;
		  }
		  else
		  {
		     $country_badges = $save_country_badges;
		  } 
		 
		 
		$data = array('country_name' => $country_name, 'country_badges' => $country_badges);
 
            
            
			Settings::updatecountryData($cid, $data);
            return redirect('/admin/country-settings')->with('success', 'Update successfully.');
            
 
       } 
     
       
	
	
	}
	
	
	
	
  /* country settings */	
  
  
  
  
  
  
  
  
  
  
  /* email settings */
  
  public function email_settings()
    {
        
		$sid = 1;
		$setting['setting'] = Settings::editGeneral($sid);
		
		return view('admin.email-settings', [ 'setting' => $setting, 'sid' => $sid]);
		
    }
	
	
	
	
	
	
	public function social_settings()
    {
        
		$sid = 1;
		$setting['setting'] = Settings::editGeneral($sid);
		
		return view('admin.social-settings', [ 'setting' => $setting, 'sid' => $sid]);
		
    }
	
	
	public function update_social_settings(Request $request)
	{
	    if(!empty($request->input('facebook_url')))
		{
	    $facebook = $request->input('facebook_url');
		}
		else
		{
		 $facebook = ""; 
		}
		
		if(!empty($request->input('twitter_url')))
		{
	    $twitter = $request->input('twitter_url');
		}
		else
		{
		$twitter = "";
		}
		
		if(!empty($request->input('gplus_url')))
		{
		$gplus = $request->input('gplus_url');
		}
		else
		{
		$gplus = "";
		}
		
		if(!empty($request->input('pinterest_url')))
		{
		$pinterest = $request->input('pinterest_url');
		}
		else
		{
		$pinterest = "";
		}
		
		if(!empty($request->input('linkedin_url')))
		{
		$linkedin = $request->input('linkedin_url');
		}
		else
		{
		$linkedin = "";
		}
		
		$instagram_url = $request->input('instagram_url');
		 
		$sid = $request->input('sid');
		
		$facebook_client_id = $request->input('facebook_client_id');
		$facebook_client_secret = $request->input('facebook_client_secret');
		$facebook_callback_url = $request->input('facebook_callback_url');
		$google_client_id = $request->input('google_client_id');
		$google_client_secret = $request->input('google_client_secret');
		$google_callback_url = $request->input('google_callback_url');
		$display_social_login = $request->input('display_social_login');
			 
		$data = array('facebook_url' => $facebook, 'twitter_url' => $twitter, 'gplus_url' => $gplus, 'pinterest_url' => $pinterest, 'linkedin_url' => $linkedin, 'instagram_url' => $instagram_url, 'facebook_client_id' => $facebook_client_id, 'facebook_client_secret' => $facebook_client_secret, 'facebook_callback_url' => $facebook_callback_url, 'google_client_id' => $google_client_id, 'google_client_secret' => $google_client_secret, 'google_callback_url' => $google_callback_url, 'display_social_login' => $display_social_login);
  		Settings::updatemailData($sid, $data);
        return redirect()->back()->with('success', 'Update successfully.');
       
	
		
	
	}
	
	
	
	public function update_email_settings(Request $request)
	{
	
	   $sender_name = $request->input('sender_name');
	   $sender_email = $request->input('sender_email');
	   $mail_driver = $request->input('mail_driver');
	   $mail_port = $request->input('mail_port');
	   $mail_password = $request->input('mail_password');
	   $mail_host = $request->input('mail_host');
	   $mail_username = $request->input('mail_username');
	   $mail_encryption = $request->input('mail_encryption');
		         
         
		 $request->validate([
							'sender_name' => 'required',
							'sender_email' => 'required',
							'mail_driver' => 'required',
							'mail_port' => 'required',
							'mail_host' => 'required',
							
							
         ]);
		 
		  $sid = $request->input('sid');
		 
         
		 
		 $rules = array(
				
				
				
	     );
		 
		 $messsages = array(
		      
	    );
		 
		$validator = Validator::make($request->all(), $rules,$messsages);
		
		if ($validator->fails()) 
		{
		 $failedRules = $validator->failed();
		 return back()->withErrors($validator);
		} 
		else
		{
		
			  
		 
		 
		$data = array('sender_name' => $sender_name, 'sender_email' => $sender_email, 'mail_driver' => $mail_driver, 'mail_host' => $mail_host, 'mail_port' => $mail_port, 'mail_username' => $mail_username, 'mail_password' => $mail_password, 'mail_encryption' => $mail_encryption);
 
            
            
			Settings::updatemailData($sid, $data);
            return redirect()->back()->with('success', 'Update successfully.');
            
 
       } 
     
      
	
	
	}
	
	
	/* email settings */
	
	
	public function preferred_settings()
    {
        
		$sid = 1;
		$setting['setting'] = Settings::editGeneral($sid);
		$additional['setting'] = Settings::editAdditional();
		return view('admin.preferred-settings', [ 'setting' => $setting, 'sid' => $sid, 'additional' => $additional]);
		
    }
	
	
	public function update_preferred_settings(Request $request)
	{
	
	     
		 $sid = $request->input('sid');
		 
		 
		 $site_blog_display = $request->input('site_blog_display');
		 $site_features_display = $request->input('site_features_display');
		 $site_newsletter_display = $request->input('site_newsletter_display');
		 $site_selling_display = $request->input('site_selling_display');
		 $subscription_mode = $request->input('subscription_mode'); 
		 
         
		 $request->validate([
							
							
							
							'site_blog_display' => 'required',
							'site_features_display' => 'required',
							'site_newsletter_display' => 'required',
							'site_selling_display' => 'required', 
							
         ]);
		 $rules = array(
				
				
	     );
		 
		 $messsages = array(
		      
	    );
		 
		$validator = Validator::make($request->all(), $rules,$messsages);
		
		if ($validator->fails()) 
		{
		 $failedRules = $validator->failed();
		 return back()->withErrors($validator);
		} 
		else
		{
		
		
		 
		$data = array('site_blog_display' => $site_blog_display, 'site_features_display' => $site_features_display, 'site_newsletter_display' => $site_newsletter_display, 'site_selling_display' => $site_selling_display);
        Settings::updategeneralData($sid, $data);
		$addition_data = array('subscription_mode' => $subscription_mode);
		Settings::updateAdditionData($addition_data);
        return redirect()->back()->with('success', 'Update successfully.');
            
 
       } 
     
       
	
	
	} 
	
	
	
	
	/* payment settings */
	
	public function payment_settings()
    {
        
		$sid = 1;
		$setting['setting'] = Settings::editGeneral($sid);
		$additional['setting'] = Settings::editAdditional();
		/*$payment_option = array('paypal','stripe','wallet','2checkout','paystack','localbank');*/
		$payment_option = array('paypal','stripe','wallet','paystack','localbank','razorpay','payhere','payumoney');
		$withdraw_option = array('paypal','stripe','paystack','localbank');
		$vendor_payment_option = array('paypal','stripe','razorpay','payhere','payumoney');
		$get_payment = explode(',', $setting['setting']->payment_option);
		$get_withdraw = explode(',', $setting['setting']->withdraw_option);
		$get_vendor_payment = explode(',', $setting['setting']->vendor_payment_option);
		return view('admin.payment-settings', [ 'setting' => $setting, 'sid' => $sid, 'payment_option' => $payment_option, 'withdraw_option' => $withdraw_option, 'get_payment' => $get_payment, 'get_withdraw' => $get_withdraw, 'additional' => $additional, 'vendor_payment_option' => $vendor_payment_option, 'get_vendor_payment' => $get_vendor_payment]);
		
    }
	
	
	public function update_payment_settings(Request $request)
	{
	
	   
	   $site_extra_fee = $request->input('site_extra_fee');
	   if(!empty($request->input('payment_option')))
	   {
	     $payment = "";
		 foreach($request->input('payment_option') as $payment_option)
		 {
		    $payment .= $payment_option.',';
		 }
		 $payment_method = rtrim($payment,',');
	   }
	   else
	   {
	   $payment_method = "";
	   }
	   
	   if(!empty($request->input('vendor_payment_option')))
	   {
	     $payment = "";
		 foreach($request->input('vendor_payment_option') as $payment_option)
		 {
		    $payment .= $payment_option.',';
		 }
		 $vendor_payment_option = rtrim($payment,',');
	   }
	   else
	   {
	   $vendor_payment_option = "";
	   }
	   
	   if(!empty($request->input('withdraw_option')))
	   {
	     $withdraw = "";
		 foreach($request->input('withdraw_option') as $withdraw_option)
		 {
		    $withdraw .= $withdraw_option.',';
		 }
		 $withdraw_method = rtrim($withdraw,',');
	   }
	   else
	   {
	   $withdraw_method = "";
	   }
	   $paypal_email = $request->input('paypal_email');
	   $paypal_mode = $request->input('paypal_mode');
	   $stripe_mode = $request->input('stripe_mode');
	   $test_publish_key = $request->input('test_publish_key');
	   $live_publish_key = $request->input('live_publish_key');
	   $test_secret_key = $request->input('test_secret_key');
	   $live_secret_key = $request->input('live_secret_key');
	   $site_minimum_withdrawal = $request->input('site_minimum_withdrawal');
	   $site_referral_commission = $request->input('site_referral_commission');
	   $site_non_exclusive_commission = $request->input('site_non_exclusive_commission'); 
	   $site_exclusive_commission = $request->input('site_exclusive_commission'); 
	   $two_checkout_mode = $request->input('two_checkout_mode');
	   $two_checkout_account = $request->input('two_checkout_account');
	   $two_checkout_publishable = $request->input('two_checkout_publishable');
	   $two_checkout_private = $request->input('two_checkout_private');
	   $paystack_public_key = $request->input('paystack_public_key');
	   $paystack_secret_key = $request->input('paystack_secret_key');
	   $paystack_merchant_email = $request->input('paystack_merchant_email');
	   $local_bank_details = $request->input('local_bank_details');
	   $razorpay_key = $request->input('razorpay_key');
	   $razorpay_secret = $request->input('razorpay_secret');
	   $per_sale_referral_commission = $request->input('per_sale_referral_commission');
	   
	   $payhere_mode = $request->input('payhere_mode');
	   $payhere_merchant_id = $request->input('payhere_merchant_id');
	   
	   $payumoney_mode = $request->input('payumoney_mode');
	   $payu_merchant_key = $request->input('payu_merchant_key');
	   $payu_salt_key = $request->input('payu_salt_key');
	   
	   $request->validate([
							'site_exclusive_commission' => 'required|numeric|min:0',
							'site_extra_fee' => 'required',
							'site_referral_commission' => 'required|numeric|min:0',
							'site_non_exclusive_commission' => 'required|numeric|min:0',
							
							
         ]);
		 
		  $sid = $request->input('sid');
		 
         
		 
		 $rules = array(
				
				
				
	     );
		 
		 $messsages = array(
		      
	    );
		 
		$validator = Validator::make($request->all(), $rules,$messsages);
		
		if ($validator->fails()) 
		{
		 $failedRules = $validator->failed();
		 return back()->withErrors($validator);
		} 
		else
		{
		
			  
		 
		 
		$data = array('site_extra_fee' => $site_extra_fee, 'payment_option' => $payment_method, 'withdraw_option' => $withdraw_method, 'paypal_email' => $paypal_email, 'paypal_mode' => $paypal_mode, 'stripe_mode' => $stripe_mode, 'test_publish_key' => $test_publish_key, 'test_secret_key' => $test_secret_key, 'live_publish_key' => $live_publish_key, 'live_secret_key' => $live_secret_key, 'site_minimum_withdrawal' => $site_minimum_withdrawal, 'site_referral_commission' => $site_referral_commission, 'site_exclusive_commission' => $site_exclusive_commission, 'site_non_exclusive_commission' => $site_non_exclusive_commission, 'two_checkout_mode' => $two_checkout_mode, 'two_checkout_account' => $two_checkout_account, 'two_checkout_publishable' => $two_checkout_publishable, 'two_checkout_private' => $two_checkout_private, 'paystack_public_key' => $paystack_public_key, 'paystack_secret_key' => $paystack_secret_key, 'paystack_merchant_email' => $paystack_merchant_email, 'local_bank_details' => $local_bank_details, 'vendor_payment_option' => $vendor_payment_option);
 
            
            
			Settings::updatemailData($sid, $data);
			$addition_data = array('razorpay_key' => $razorpay_key, 'razorpay_secret' => $razorpay_secret, 'per_sale_referral_commission' => $per_sale_referral_commission, 'payhere_mode' => $payhere_mode, 'payhere_merchant_id' => $payhere_merchant_id, 'payumoney_mode' => $payumoney_mode, 'payu_merchant_key' => $payu_merchant_key, 'payu_salt_key' => $payu_salt_key);
			Settings::updateAdditionData($addition_data);
            return redirect()->back()->with('success', 'Update successfully.');
            
 
       } 
     
       return redirect('/admin/payment-settings');
	   
		     
	}
	
	/* payment settings */
	
	
	/* start selling */
	
	
	public function start_selling()
	{
	  
	    $sid = 1;
		$setting['setting'] = Settings::editSelling();
		
		return view('admin.start-selling', [ 'setting' => $setting, 'sid' => $sid]);
	
	}
	
	public function update_start_selling(Request $request)
	{
	   $box1_title = $request->input('box1_title');
	   $box1_text = $request->input('box1_text');
	   $box3_title = $request->input('box3_title');
	   $box3_text = $request->input('box3_text');
	   $box2_title = $request->input('box2_title');
	   $box2_text = $request->input('box2_text');
	   $box4_title = $request->input('box4_title');
	   $box4_text = $request->input('box4_text');
	   $three_box_heading = $request->input('three_box_heading');
	   $box5_title = $request->input('box5_title');
	   $box5_text = $request->input('box5_text');
	   $box6_title = $request->input('box6_title');
	   $box6_text = $request->input('box6_text');
	   $box7_title = $request->input('box7_title');
	   $box7_text = $request->input('box7_text');
	   $content_title_one = $request->input('content_title_one');
	   $content_text_one = $request->input('content_text_one');
	   $content_title_two = $request->input('content_title_two');
	   $content_text_two = $request->input('content_text_two');
	   $content_title_three = $request->input('content_title_three');
	   $content_text_three = $request->input('content_text_three');
	   $button_title = $request->input('button_title');
	   
	   $sid = $request->input('sid');
	   $allsettings = Settings::allSettings();
	   $image_size = $allsettings->site_max_image_size;
	   
	   $request->validate([
							'box1_icon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
							'box2_icon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
							'box3_icon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
							'box4_icon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
							'box5_icon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
							'box6_icon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
							'box7_icon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
							
         ]);
		 
		 
	$rules = array(
				
				
				
	     );
		 
		 $messsages = array(
		      
	    );
		 
		$validator = Validator::make($request->all(), $rules,$messsages);
		
		if ($validator->fails()) 
		{
		 $failedRules = $validator->failed();
		 return back()->withErrors($validator);
		} 
		else
		{	
		 
		 if ($request->hasFile('box1_icon')) 
		  {
		    $column = 'box1_icon'; 
			Settings::dropSelling($column); 
		    $image = $request->file('box1_icon');
			$img_name = time() . '1.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/settings');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$box1_icon = $img_name;
		  }
		  else
		  {
		     $box1_icon = $request->input('save_box1_icon');
		  }
		  
		  
		  if ($request->hasFile('box2_icon')) 
		  {
		    $column = 'box2_icon'; 
			Settings::dropSelling($column); 
		    $image = $request->file('box2_icon');
			$img_name = time() . '2.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/settings');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$box2_icon = $img_name;
		  }
		  else
		  {
		     $box2_icon = $request->input('save_box2_icon');
		  }
		  
		  
		  
		  if ($request->hasFile('box3_icon')) 
		  {
		    $column = 'box3_icon'; 
			Settings::dropSelling($column); 
		    $image = $request->file('box3_icon');
			$img_name = time() . '3.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/settings');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$box3_icon = $img_name;
		  }
		  else
		  {
		     $box3_icon = $request->input('save_box3_icon');
		  }
		  
		  
		  
		  if ($request->hasFile('box4_icon')) 
		  {
		    $column = 'box4_icon'; 
			Settings::dropSelling($column); 
		    $image = $request->file('box4_icon');
			$img_name = time() . '4.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/settings');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$box4_icon = $img_name;
		  }
		  else
		  {
		     $box4_icon = $request->input('save_box4_icon');
		  }
		 
		 
		  if ($request->hasFile('box5_icon')) 
		  {
		    $column = 'box5_icon'; 
			Settings::dropSelling($column); 
		    $image = $request->file('box5_icon');
			$img_name = time() . '5.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/settings');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$box5_icon = $img_name;
		  }
		  else
		  {
		     $box5_icon = $request->input('save_box5_icon');
		  }
		  
		  
		  if ($request->hasFile('box6_icon')) 
		  {
		    $column = 'box6_icon'; 
			Settings::dropSelling($column); 
		    $image = $request->file('box6_icon');
			$img_name = time() . '6.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/settings');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$box6_icon = $img_name;
		  }
		  else
		  {
		     $box6_icon = $request->input('save_box6_icon');
		  }
		 
		 
		 
		  if ($request->hasFile('box7_icon')) 
		  {
		    $column = 'box7_icon'; 
			Settings::dropSelling($column); 
		    $image = $request->file('box7_icon');
			$img_name = time() . '7.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/settings');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$box7_icon = $img_name;
		  }
		  else
		  {
		     $box7_icon = $request->input('save_box7_icon');
		  }
		 
		 $data = array('box1_icon' => $box1_icon, 'box1_title' => $box1_title, 'box1_text' => $box1_text, 'box2_icon' => $box2_icon, 'box2_title' => $box2_title, 'box2_text' => $box2_text, 'box3_icon' => $box3_icon, 'box3_title' => $box3_title, 'box3_text' => $box3_text, 'box4_icon' => $box4_icon, 'box4_title' => $box4_title, 'box4_text' => $box4_text, 'three_box_heading' => $three_box_heading, 'box5_icon' => $box5_icon, 'box5_title' => $box5_title, 'box5_text' => $box5_text, 'box6_icon' => $box6_icon, 'box6_title' => $box6_title, 'box6_text' => $box6_text, 'box7_icon' => $box7_icon, 'box7_title' => $box7_title, 'box7_text' => $box7_text, 'content_title_one' => $content_title_one, 'content_text_one' => $content_text_one, 'content_title_two' => $content_title_two, 'content_text_two' => $content_text_two, 'content_title_three' => $content_title_three, 'content_text_three' => $content_text_three, 'button_title' => $button_title);
         Settings::updateSelling($sid,$data);
         return redirect()->back()->with('success', 'Update successfully.');
		 
		 
		 }
	   
	   
	
	}
	/* start selling */
	
	
	
	
   /* hightlights */
   
   public function highlights()
	{
	  
	  $sid = 1;
		$setting['setting'] = Settings::editGeneral($sid);
		
		return view('admin.highlights', [ 'setting' => $setting, 'sid' => $sid]);
	
	}
	
	
	public function update_highlights(Request $request)
	{
	
	    $site_icon1 = $request->input('site_icon1');
	    $site_icon2 = $request->input('site_icon2');
		$site_icon3 = $request->input('site_icon3');
		$site_icon4 = $request->input('site_icon4');
		
		$site_text1 = $request->input('site_text1');
		$site_text2 = $request->input('site_text2');
		$site_text3 = $request->input('site_text3');
		$site_text4 = $request->input('site_text4');
		
		
		$site_sub_text1 = $request->input('site_sub_text1');
		$site_sub_text2 = $request->input('site_sub_text2');
		$site_sub_text3 = $request->input('site_sub_text3');
		$site_sub_text4 = $request->input('site_sub_text4');
		         
         
		 $request->validate([
							'site_icon1' => 'required',
							'site_icon2' => 'required',
							'site_icon3' => 'required',
							'site_icon4' => 'required',
							'site_text1' => 'required',
							'site_text2' => 'required',
							'site_text3' => 'required',
							'site_text4' => 'required',
							
         ]);
		 
		  $sid = $request->input('sid');
		 
         
		 
		 $rules = array(
				
				
				
	     );
		 
		 $messsages = array(
		      
	    );
		 
		$validator = Validator::make($request->all(), $rules,$messsages);
		
		if ($validator->fails()) 
		{
		 $failedRules = $validator->failed();
		 return back()->withErrors($validator);
		} 
		else
		{
		
			  
		 
		 
		$data = array('site_icon1' => $site_icon1, 'site_icon2' => $site_icon2, 'site_icon3' => $site_icon3, 'site_icon4' => $site_icon4, 'site_text1' => $site_text1, 'site_text2' => $site_text2, 'site_text3' => $site_text3, 'site_text4' => $site_text4, 'site_sub_text1' => $site_sub_text1, 'site_sub_text2' => $site_sub_text2, 'site_sub_text3' => $site_sub_text3, 'site_sub_text4' => $site_sub_text4);
 
            
            
			Settings::updatemailData($sid, $data);
            return redirect()->back()->with('success', 'Update successfully.');
            
 
       } 
     
       
	
	
	}
	
  /* hightlights */	
	
	
	
}
