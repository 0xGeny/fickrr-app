<?php

namespace Fickrr\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rule;
use Fickrr\Models\Pages;

class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    
    public function view_profile_settings()
    {
        return view('profile-settings');
    }
	
	
	public function view_page($page_slug)
	{
	
	  $page['page'] = Pages::editpageData($page_slug);
	  
	  $data = array('page' => $page);
	  return view('page')->with($data);
	
	}
	
	
	
	
	
	
}
