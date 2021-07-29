<?php

namespace Fickrr\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Fickrr\Http\Controllers\Controller;
use Session;
use Fickrr\Models\Pages;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
		
    }
	
	
	
	public function pages()
    {
        
		
		$pageData['pages'] = Pages::getpageData();
		return view('admin.pages',[ 'pageData' => $pageData]);
    }
    
	
	public function add_page()
	{
	   
	   return view('admin.add-page');
	}
	
	
	public function page_slug($string){
		   $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
		   return $slug;
    }
	
	
	
	public function save_page(Request $request)
	{
 
    
         $page_title = $request->input('page_title');
		 $page_desc = htmlentities($request->input('page_desc'));
         $page_slug = $this->page_slug($page_title);
		 $page_status = $request->input('page_status');
		 $main_menu = $request->input('main_menu');
		 $footer_menu = $request->input('footer_menu');
		 if($request->input('menu_order'))
		 {
		    $menu_order = $request->input('menu_order');
		 }
		 else
		 {
		   $menu_order = 0;
		 }
		
		 
		 
         
		 $request->validate([
							'page_title' => 'required',
							'page_desc' => 'required',
							'page_status' => 'required',
							
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
		
		
		 
		$data = array('page_title' => $page_title, 'page_desc' => $page_desc, 'page_slug' => $page_slug, 'page_status' => $page_status, 'main_menu' => $main_menu, 'footer_menu' => $footer_menu, 'menu_order' => $menu_order);
        Pages::insertpageData($data);
		return redirect('/admin/pages')->with('success', 'Insert successfully.');
        
            
 
       } 
     
    
  }
  
  
  
  public function delete_pages($page_id){

      
	  
      Pages::deletePagedata($page_id);
	  
	  return redirect()->back()->with('success', 'Delete successfully.');

    
  }
  
  
  public function edit_page($page_id)
	{
	   
	   $edit['page'] = Pages::editpageID($page_id);
	   return view('admin.edit-page', [ 'edit' => $edit, 'page_id' => $page_id]);
	}
	
	
	
	public function update_page(Request $request)
	{
	
	   $page_title = $request->input('page_title');
		 $page_desc = htmlentities($request->input('page_desc'));
         $page_slug = $this->page_slug($page_title);
		 $page_status = $request->input('page_status');
		 
		 $page_id = $request->input('page_id');
		 $main_menu = $request->input('main_menu');
		 $footer_menu = $request->input('footer_menu');
		 if($request->input('menu_order'))
		 {
		    $menu_order = $request->input('menu_order');
		 }
		 else
		 {
		   $menu_order = 0;
		 }
		 
         
		 $request->validate([
							'page_title' => 'required',
							'page_desc' => 'required',
							'page_status' => 'required',
							
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
		
		
		$data = array('page_title' => $page_title, 'page_desc' => $page_desc, 'page_slug' => $page_slug, 'page_status' => $page_status, 'main_menu' => $main_menu, 'footer_menu' => $footer_menu, 'menu_order' => $menu_order);
        Pages::updatepageData($page_id, $data);
        return redirect('/admin/pages')->with('success', 'Update successfully.');  
        
       } 
     
       
	
	
	}
	
  
	
	
	
}
