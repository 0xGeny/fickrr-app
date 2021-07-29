<?php

namespace Fickrr\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Fickrr\Http\Controllers\Controller;
use Session;
use Fickrr\Models\Languages;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class LanguageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
		
    }
	
	
	
	public function view_languages()
	{
	  
	  $language['view'] = Languages::viewLanguage(); 
	  $data = array('language' => $language);
	  return view('admin.languages')->with($data);
	
	}
	
	
	public function edit_keywords($code)
	{
	   $language['view'] = Languages::getLanguage($code);
	   $keyword['view'] =  Languages::getKeyword($code);
	   $data = array('language' => $language, 'keyword' => $keyword);
	   return view('admin.edit-keywords')->with($data);
	}
	
	public function save_keywords(Request $request)
	{
	   $keyword_text = $request->input('keyword_text');
	   $keyword_token = $request->input('keyword_token');
	   $keyword_id = $request->input('keyword_id');
	   $language_code = $request->input('language_code');
	   
	   $request->validate([
							'keyword_text' => 'required',
							
							
							
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
		
		   foreach($keyword_id as $index => $id)
			{
				 $keyword = $keyword_text[$index];
				 $token = $keyword_token[$index];
				 $code = $language_code;
				 $key_id = $id;
				 
				 $data = array('keyword_text' => $keyword);
				 Languages::updateKeyword($key_id,$code,$token,$data);
				 
				 
			}

         
		   return redirect()->back()->with('success', 'Updated successfully.');
		
		}
		
		
	
	}
    
	
	public function add_keywords()
	{
	   return view('admin.add-keywords');
	}
	
	
	public function insert_keywords(Request $request)
	{
	
	   $keyword_text = $request->input('keyword_text');
	   $keyword_token = $this->generateRandomString();
	   $language_code = $request->input('language_code');
	   $keyword_parent = $request->input('keyword_parent');
	   if(!empty($request->input('keyword_enable')))
	   {
	   $keyword_enable = $request->input('keyword_enable');
	   }
	   else
	   {
	   $keyword_enable = 0;
	   }
	   	   
	   
	   $request->validate([
							'keyword_text' => 'required',
							
							
							
         ]);
		 $rules = array(
				
				'keyword_text' => ['required',  Rule::unique('keywords') -> where(function($sql){ $sql->where('keyword_parent','!=','');})],
				
				
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
	        
		  
			  
			   $data = array('keyword_token' => $keyword_token, 'keyword_label' => $keyword_text, 'keyword_text' => $keyword_text, 'language_code' => $language_code, 'keyword_parent' => $keyword_parent);
			   
			   
			   $insertedId = Languages::saveOnebyOne($data);
			   if($keyword_enable == 1)
			   {
			   	$viewer['all'] = Languages::getSimpleData($language_code);
			   	foreach($viewer['all'] as $views)
			   	{
				   $record = array('keyword_token' => $keyword_token, 'keyword_label' => $keyword_text, 'keyword_text' => $keyword_text, 'language_code' => $views->language_code, 'keyword_parent' => $insertedId);
				   Languages::saveKeywords($record);
			   	}
			  }	
			   
			   return redirect()->back()->with('success', 'Added successfully.');
			
			   
			   
		}
	
	}
	
	
	
	
	public function add_language()
    {
	   return view('admin.add-language');
	}
	
	
	public function edit_language($token)
	{
	   $edit['view'] = Languages::singleLangugage($token);
	  return view('admin.edit-language',[ 'edit' => $edit]);
	}
	
	public function generateRandomString($length = 25) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
    }
	
	
	
	public function update_language(Request $request)
	{
	
	   $language_name = $request->input('language_name');
	   
	   $language_order = $request->input('language_order');
	   $language_default = $request->input('language_default');
	   $language_status = $request->input('language_status');
	   $language_token = $request->input('language_token');
	   	   
	   
	   $request->validate([
							
							'language_name' => 'required',
							
							
         ]);
		 $rules = array(
				
				/*'language_code' => ['required', Rule::unique('languages') ->ignore($language_token, 'language_token') -> where(function($sql){ $sql->where('language_status','!=','');})],*/
				
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
	        
		  
			  
			   $data = array('language_name' => $language_name, 'language_order' => $language_order, 'language_default' => $language_default, 'language_status' => $language_status);
			   
			   
			   if($language_default == 1)
			   {  
			       $record = array('language_default' => 0);
			       Languages::removeDefaultLanguage($language_token,$record);
			   }
			   
			   Languages::updateLanguage($language_token,$data);
			   
			  		   
			   return redirect('/admin/languages')->with('success', 'Updated successfully.');
			
			   
			   
		}
	
	
	
	}
	
	
	public function save_language(Request $request)
	{
	
	   $language_name = $request->input('language_name');
	   $language_token = $this->generateRandomString();
	   $language_code = $request->input('language_code');
	   $language_order = $request->input('language_order');
	   $language_default = $request->input('language_default');
	   $language_status = $request->input('language_status');
	   	   
	   
	   $request->validate([
							'language_code' => 'required',
							'language_name' => 'required',
							
							
         ]);
		 $rules = array(
				
				'language_code' => ['required',  Rule::unique('languages') -> where(function($sql){ $sql->where('language_status','!=','');})],
				
				
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
	        
		  
			  
			   $data = array('language_token' => $language_token, 'language_name' => $language_name, 'language_code' => $language_code, 'language_order' => $language_order, 'language_default' => $language_default, 'language_status' => $language_status);
			   
			   Languages::saveLanguage($data);
			   
			   if($language_code != 'en')
			   {
			       $code = "en";
				   $language['view'] = Languages::getKeywordData($code);
				   foreach($language['view'] as $translate)
				   {
				       $keyword_token = $translate->keyword_token;
					   $parent = $translate->keyword_id;
					   $keyword_text = $translate->keyword_text;
					   $keyword_label = $translate->keyword_label;
					   $extra_data = array('keyword_token' => $keyword_token, 'keyword_label' => $keyword_label, 'keyword_text' => $keyword_text, 'language_code' => $language_code, 'keyword_parent' => $parent);
					   $check_keyword = Languages::checkKeywords($language_code,$keyword_token);
					   if($check_keyword == 0)
					   {
					     Languages::saveKeywords($extra_data);
					   }
				   }
				    
			   }
			   
			   
			   return redirect('/admin/languages')->with('success', 'Added successfully.');
			
			   
			   
		}
	
	}
	
	
	
	public function delete_languages($token,$code)
	{
	   
	   Languages::deleteLanguages($token);
	   if($code != 'en')
	   {
	      Languages::deleteKeyword($code);
	   }
	  
	  return redirect()->back()->with('success', 'Delete successfully.');
	
	}
	
	
	
}
