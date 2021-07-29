<?php

namespace Fickrr\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Fickrr\Http\Controllers\Controller;
use Session;
use Fickrr\Models\Members;
use Fickrr\Models\Settings;
use Fickrr\Models\Items;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Fickrr\Models\Subscription;
use Auth;

class MembersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	/* customer */
	
    public function customer()
    {
        
		
		$userData['data'] = Members::getuserData();
		return view('admin.customer',[ 'userData' => $userData]);
    }
	
	public function upgrade_customer($token,$subcr_id)
	{
	   
	        
			$subscr['view'] = Subscription::editsubData($subcr_id);
			$subscri_date = $subscr['view']->subscr_duration;
			$subscr_value = "+".$subscri_date;
			$subscr_date = date('Y-m-d', strtotime($subscr_value));
			$user_subscr_item_level = $subscr['view']->subscr_item_level;
			$user_subscr_item = $subscr['view']->subscr_item;
			$user_subscr_space_level = $subscr['view']->subscr_space_level;
			$user_subscr_space = $subscr['view']->subscr_space;
			$user_subscr_space_type = $subscr['view']->subscr_space_type;
			$user_subscr_type = $subscr['view']->subscr_name;
			$checkoutdata = array('user_subscr_type' => $user_subscr_type, 'user_subscr_date' => $subscr_date, 'user_subscr_item_level' => $user_subscr_item_level, 'user_subscr_item' => $user_subscr_item, 'user_subscr_space_level' => $user_subscr_space_level, 'user_subscr_space' => $user_subscr_space, 'user_subscr_space_type' => $user_subscr_space_type, 'user_purchase_token' => '');
			Subscription::confirmupgradeData($token,$checkoutdata);
			return redirect()->back()->with('success', 'Membership has been upgrade');
	   
	} 
	
	public function add_customer()
	{
	   
	   return view('admin.add-customer');
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
	
	public function save_customer(Request $request)
	{
 
         $additional_settings = Settings::editAdditional();
		 
		 if(!empty($request->input('subscription_type')))
		 {
			 
			 if($request->input('subscription_type') == 'free')
			 {
			 $free_subscr_type = $additional_settings->free_subscr_type;
			 $free_subscr_price = $additional_settings->free_subscr_price;
			 $free_subscr_duration = $additional_settings->free_subscr_duration;
			 $free_subscr_item = $additional_settings->free_subscr_item;
			 $free_subscr_space = $additional_settings->free_subscr_space;
			 $subscr_value = "+".$free_subscr_duration;
			 $user_subscr_item_level = 'limited';
			 $user_subscr_space_level = 'limited';
			 $user_subscr_space_type = 'MB';
			 $subscr_date = date('Y-m-d', strtotime($subscr_value));
			 $subscr_id = 0;
			 }
			 else if($request->input('subscription_type') == 'none')
			 {
			 $free_subscr_type = 'None';
			 $free_subscr_price = $additional_settings->free_subscr_price;
			 $free_subscr_duration = $additional_settings->free_subscr_duration;
			 $free_subscr_item = 0;
			 $free_subscr_space = 0;
			 $subscr_value = "+".$free_subscr_duration;
			 $user_subscr_item_level = 'limited';
			 $user_subscr_space_level = 'limited';
			 $user_subscr_space_type = 'MB';
			 $subscr_date = date('Y-m-d', strtotime('-1 days'));
			 $subscr_id = 0;
			 }
			 else
			 {
			    $subscr_id = $request->input('subscription_type');
			    $subscr['view'] = Subscription::editsubData($subscr_id);
				$free_subscr_type = $subscr['view']->subscr_name;
				$free_subscr_price = $subscr['view']->subscr_price;
				$free_subscr_duration = $subscr['view']->subscr_duration;
				$free_subscr_item = $subscr['view']->subscr_item;
				$free_subscr_space = $subscr['view']->subscr_space;
				$subscr_value = "+".$free_subscr_duration;
				$user_subscr_item_level = $subscr['view']->subscr_item_level;
				$user_subscr_space_level = $subscr['view']->subscr_space_level;
				$user_subscr_space_type = $subscr['view']->subscr_space_type;
				$subscr_date = date('Y-m-d', strtotime($subscr_value));
				
			 }
		 }
         $name = $request->input('name');
		 $username = $request->input('username');
		 $page_redirect = $request->input('page_redirect');
         $email = $request->input('email');
		 $user_type = $request->input('user_type');
		 $password = bcrypt($request->input('password'));
		 $user_auth_token = base64_encode($request->input('password'));
		 if(!empty($request->input('earnings')))
		 {
		 $earnings = $request->input('earnings');
         }
		 else
		 {
		   $earnings = 0;
		 }
		 
		 
		 $allsettings = Settings::allSettings();
		  $image_size = $allsettings->site_max_image_size;
         
		 $request->validate([
							'name' => 'required',
							'username' => 'required',
							'password' => 'min:6',
							'email' => 'required|email',
							'user_photo' => 'mimes:jpeg,jpg,png,gif|max:'.$image_size,
							
         ]);
		 $rules = array(
				'username' => ['required', 'regex:/^[\w-]*$/', 'max:255', Rule::unique('users') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				'email' => ['required', 'email', 'max:255', Rule::unique('users') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				
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
		
		if ($request->hasFile('user_photo')) {
			$image = $request->file('user_photo');
			$img_name = time() . '.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/users');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$user_image = $img_name;
		  }
		  else
		  {
		     $user_image = "";
		  }
		  $verified = $request->input('verified');
		  $token = $this->generateRandomString();
		  $days_ago = date('Y-m-d', strtotime('-3 days'));
		  $user_document_verified = $request->input('user_document_verified');
		 if($additional_settings->subscription_mode == 1)
		 {
			if($user_type == 'vendor')
			{ 
			  
				$data = array('name' => $name, 'username' => $username, 'email' => $email, 'user_type' => $user_type, 'password' => $password, 'earnings' => $earnings, 'user_photo' => $user_image, 'verified' => $verified, 'user_document_verified' => $user_document_verified, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'user_token' => $token, 'user_subscr_id' => $subscr_id, 'user_subscr_type' => $free_subscr_type, 'user_subscr_price' => $free_subscr_price, 'user_subscr_date' => $subscr_date, 'user_subscr_item_level' => $user_subscr_item_level, 'user_subscr_item' => $free_subscr_item, 'user_subscr_space_level' => $user_subscr_space_level, 'user_subscr_space' => $free_subscr_space, 'user_subscr_space_type' => $user_subscr_space_type, 'user_auth_token' => $user_auth_token);
			  
			}
			else
			{
			   $data = array('name' => $name, 'username' => $username, 'email' => $email, 'user_type' => $user_type, 'password' => $password, 'earnings' => $earnings, 'user_photo' => $user_image, 'verified' => $verified, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'user_token' => $token, 'user_auth_token' => $user_auth_token);
			}
		}
		else
		{
		   $data = array('name' => $name, 'username' => $username, 'email' => $email, 'user_type' => $user_type, 'password' => $password, 'earnings' => $earnings, 'user_photo' => $user_image, 'verified' => $verified, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'user_token' => $token, 'user_auth_token' => $user_auth_token);
		}	
			
            
            Members::insertData($data);
            return redirect('/admin/'.$page_redirect)->with('success', 'Insert successfully.');
            
 
       } 
     
    
  }
  
  
  public function delete_customer($token){

      $get_member = Members::editData($token);
	  $user_id = $get_member->id;
	  
      $data = array('drop_status'=>'yes');
	  
	  $item_data = array('drop_status'=>'yes', 'item_status' => 0);
	  
	  Items::dropItems($item_data,$user_id);
      Members::deleteData($token,$data);
	  
	  return redirect()->back()->with('success', 'Delete successfully.');

    
  }
  
  public function edit_customer($token)
	{
	   
	   $edit['userdata'] = Members::editData($token);
	   return view('admin.edit-customer', [ 'edit' => $edit, 'token' => $token]);
	}
	
	
	public function update_customer(Request $request)
	{
	   $additional_settings = Settings::editAdditional();
		 
		 if(!empty($request->input('subscription_type')))
		 {
			 
			 if($request->input('subscription_type') == 'free')
			 {
			 $free_subscr_type = $additional_settings->free_subscr_type;
			 $free_subscr_price = $additional_settings->free_subscr_price;
			 $free_subscr_duration = $additional_settings->free_subscr_duration;
			 $free_subscr_item = $additional_settings->free_subscr_item;
			 $free_subscr_space = $additional_settings->free_subscr_space;
			 $subscr_value = "+".$free_subscr_duration;
			 $user_subscr_item_level = 'limited';
			 $user_subscr_space_level = 'limited';
			 $user_subscr_space_type = 'MB';
			 $subscr_date = date('Y-m-d', strtotime($subscr_value));
			 $subscr_id = 0;
			 }
			 else if($request->input('subscription_type') == 'none')
			 {
			 $free_subscr_type = 'None';
			 $free_subscr_price = $additional_settings->free_subscr_price;
			 $free_subscr_duration = $additional_settings->free_subscr_duration;
			 $free_subscr_item = 0;
			 $free_subscr_space = 0;
			 $subscr_value = "+".$free_subscr_duration;
			 $user_subscr_item_level = 'limited';
			 $user_subscr_space_level = 'limited';
			 $user_subscr_space_type = 'MB';
			 $subscr_date = date('Y-m-d', strtotime('-1 days'));
			 $subscr_id = 0;
			 }
			 else
			 {
			    $subscr_id = $request->input('subscription_type');
			    $subscr['view'] = Subscription::editsubData($subscr_id);
				$free_subscr_type = $subscr['view']->subscr_name;
				$free_subscr_price = $subscr['view']->subscr_price;
				$free_subscr_duration = $subscr['view']->subscr_duration;
				$free_subscr_item = $subscr['view']->subscr_item;
				$free_subscr_space = $subscr['view']->subscr_space;
				$subscr_value = "+".$free_subscr_duration;
				$user_subscr_item_level = $subscr['view']->subscr_item_level;
				$user_subscr_space_level = $subscr['view']->subscr_space_level;
				$user_subscr_space_type = $subscr['view']->subscr_space_type;
				$subscr_date = date('Y-m-d', strtotime($subscr_value));
				
			 }
		 }
		 if(!empty($request->input('user_payment_option')))
		   {
			 $payment = "";
			 foreach($request->input('user_payment_option') as $payment_option)
			 {
				$payment .= $payment_option.',';
			 }
			 $user_payment_option = rtrim($payment,',');
		   }
		   else
		   {
		   $user_payment_option = "";
		   }
	   $name = $request->input('name');
	   $username = $request->input('username');
	   $page_redirect = $request->input('page_redirect');
         $email = $request->input('email');
		 $user_type = $request->input('user_type');
		 
		 if(!empty($request->input('password')))
		 {
		 $password = bcrypt($request->input('password'));
		 $user_auth_token = base64_encode($request->input('password'));
		 $pass = $password;
		 }
		 else
		 {
		 $pass = $request->input('save_password');
		 $user_auth_token = $request->input('save_auth_token');
		 }
		 
		 if(!empty($request->input('earnings')))
		 {
		 $earnings = $request->input('earnings');
         }
		 else
		 {
		   $earnings = 0;
		 }
		 
		  $token = $request->input('edit_id');
		  $verified = $request->input('verified');
		 $allsettings = Settings::allSettings();
		  $image_size = $allsettings->site_max_image_size;
         $user_document_verified = $request->input('user_document_verified');
		 $request->validate([
							'name' => 'required',
							'username' => 'required',
							'password' => 'min:6',
							'email' => 'required|email',
							'user_photo' => 'mimes:jpeg,jpg,png,gif|max:'.$image_size,
							
         ]);
		 $rules = array(
				'username' => ['required', 'regex:/^[\w-]*$/', 'max:255', Rule::unique('users') ->ignore($token, 'user_token') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				'email' => ['required', 'email', 'max:255', Rule::unique('users') ->ignore($token, 'user_token') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				
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
		
		if ($request->hasFile('user_photo')) {
		     
			Members::droPhoto($token); 
		   
			$image = $request->file('user_photo');
			$img_name = time() . '.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/users');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$user_image = $img_name;
		  }
		  else
		  {
		     $user_image = $request->input('save_photo');
		  }
		  
		 
		 
		
 
            
           if($additional_settings->subscription_mode == 1)
		 {
			if($user_type == 'vendor')
			{ 
			  
				$data = array('name' => $name, 'username' => $username, 'email' => $email, 'user_type' => $user_type, 'password' => $pass, 'earnings' => $earnings, 'user_photo' => $user_image, 'updated_at' => date('Y-m-d H:i:s'), 'user_subscr_id' => $subscr_id, 'user_subscr_type' => $free_subscr_type, 'user_subscr_price' => $free_subscr_price, 'user_subscr_date' => $subscr_date, 'user_subscr_item_level' => $user_subscr_item_level, 'user_subscr_item' => $free_subscr_item, 'user_subscr_space_level' => $user_subscr_space_level, 'user_subscr_space' => $free_subscr_space, 'user_subscr_space_type' => $user_subscr_space_type, 'user_payment_option' => $user_payment_option, 'verified' => $verified, 'user_document_verified' => $user_document_verified, 'user_auth_token' => $user_auth_token);
			  
			}
			else
			{
			  $data = array('name' => $name, 'username' => $username, 'email' => $email, 'user_type' => $user_type, 'password' => $pass, 'earnings' => $earnings, 'user_photo' => $user_image, 'updated_at' => date('Y-m-d H:i:s'), 'verified' => $verified, 'user_auth_token' => $user_auth_token);
			}
		}
		else
		{
		   $data = array('name' => $name, 'username' => $username, 'email' => $email, 'user_type' => $user_type, 'password' => $pass, 'earnings' => $earnings, 'user_photo' => $user_image, 'updated_at' => date('Y-m-d H:i:s'), 'verified' => $verified, 'user_auth_token' => $user_auth_token);
		}	
		
		 
			Members::updateData($token, $data);
            return redirect('/admin/'.$page_redirect)->with('success', 'Update successfully.');
            
 
       } 
     
       
	
	
	}
	
	/* customer */
	
	
	/* vendor */
	
	public function vendor()
    {
        
		$userData['data'] = Members::getvendorData();
		return view('admin.vendor',[ 'userData' => $userData]);
    }
	
	public function add_vendor()
	{
	   $subscribe['userdata'] = Subscription::viewSubscription();
	   return view('admin.add-vendor', [ 'subscribe' => $subscribe]);
	}
	
	
	public function edit_vendor($token)
	{
	   
	   $edit['userdata'] = Members::editData($token);
	   $subscribe['userdata'] = Subscription::viewSubscription();
	   $check_payment = Members::getdirectSubscription($edit['userdata']->id);
	   $get_payment = explode(',', $edit['userdata']->user_payment_option);
	   $sid = 1;
	    $setting['setting'] = Settings::editGeneral($sid);
		$payment_option = explode(',', $setting['setting']->vendor_payment_option);
	   return view('admin.edit-vendor', [ 'edit' => $edit, 'token' => $token, 'subscribe' => $subscribe, 'check_payment' => $check_payment, 'get_payment' => $get_payment, 'payment_option' => $payment_option]);
	}
	
	/* vendor */
	
    
	
	/* edit profile */
	
	
	public function edit_profile()
    {
        $token = Auth::user()->id;
		$edit['userdata'] = Members::editprofileData($token);
		
		return view('admin.edit-profile', [ 'edit' => $edit, 'token' => $token]);
		
    }
	
	
	
	public function update_profile(Request $request)
	{
	
	   $name = $request->input('name');
	   $username = $request->input('username');
         $email = $request->input('email');
		 $user_type = $request->input('user_type');
		 
		 if(!empty($request->input('password')))
		 {
		 $password = bcrypt($request->input('password'));
		 $pass = $password;
		 }
		 else
		 {
		 $pass = $request->input('save_password');
		 }
		 
		 
		 
		  $token = $request->input('edit_id');
		 
         $allsettings = Settings::allSettings();
		  $image_size = $allsettings->site_max_image_size;
		 $request->validate([
							'name' => 'required',
							'username' => 'required',
							'email' => 'required|email',
							'user_photo' => 'mimes:jpeg,jpg,png,gif|max:'.$image_size,
							
         ]);
		 $rules = array(
				'username' => ['required', 'regex:/^[\w-]*$/', 'max:255', Rule::unique('users') ->ignore($token, 'id') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				'email' => ['required', 'email', 'max:255', Rule::unique('users') ->ignore($token, 'id') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				
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
		
		if ($request->hasFile('user_photo')) {
		     
			Members::droprofilePhoto($token); 
		   
			$image = $request->file('user_photo');
			$img_name = time() . '.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/users');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$user_image = $img_name;
		  }
		  else
		  {
		     $user_image = $request->input('save_photo');
		  }
		  
		 
		 
		$data = array('name' => $name, 'username' => $username, 'email' => $email,'user_type' => $user_type, 'password' => $pass, 'user_photo' => $user_image, 'updated_at' => date('Y-m-d H:i:s'));
 
            
            
			Members::updateprofileData($token, $data);
            return redirect()->back()->with('success', 'Update successfully.');
            
 
       } 
     
       
	
	
	}
	
	/* edit profile */
	
	
	/* administrator */
	
	public function administrator()
    {
        
		
		$userData['data'] = Members::getadminData();
		return view('admin.administrator',[ 'userData' => $userData]);
    }
	
	public function add_administrator()
	{
	   
	   return view('admin.add-administrator');
	}
	
	
	public function save_administrator(Request $request)
	{
 
         $sid = 1;
		 $setting['setting'] = Settings::editGeneral($sid);
		 $site_max_image_size = $setting['setting']->site_max_image_size;
		 $name = $request->input('name');
		 $username = $request->input('username');
         $email = $request->input('email');
		 $user_type = $request->input('user_type');
		 $password = bcrypt($request->input('password'));
		 if(!empty($request->input('earnings')))
		 {
		 $earnings = $request->input('earnings');
         }
		 else
		 {
		   $earnings = 0;
		 }
		 $page_url = '/admin/administrator';
		 if(!empty($request->input('user_permission')))
	     {
	      
		  $user_permission = "";
		  foreach($request->input('user_permission') as $permission)
		  {
		     $user_permission .= $permission.',';
		  }
		  $user_permissions = rtrim($user_permission,",");
		  
	     }
	     else
	     {
	     $user_permissions = "";
	     }
		 
         
		 $request->validate([
							'name' => 'required',
							'username' => 'required',
							'password' => 'min:6',
							'email' => 'required|email',
							'user_photo' => 'mimes:jpeg,jpg,png|max:'.$site_max_image_size,
							
         ]);
		 $rules = array(
				'username' => ['required', 'regex:/^[\w-]*$/', 'max:255', Rule::unique('users') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				'email' => ['required', 'email', 'max:255', Rule::unique('users') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				
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
		
		if ($request->hasFile('user_photo')) {
			$image = $request->file('user_photo');
			$img_name = time() . '.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/users');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$user_image = $img_name;
		  }
		  else
		  {
		     $user_image = "";
		  }
		  $verified = 1;
		  $token = $this->generateRandomString();
		 
		$data = array('name' => $name, 'username' => $username, 'email' => $email, 'user_type' => $user_type, 'password' => $password, 'earnings' => $earnings, 'user_photo' => $user_image, 'verified' => $verified, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'user_token' => $token, 'user_permission' => $user_permissions);
 
            
            Members::insertData($data);
            return redirect($page_url)->with('success', 'Insert successfully.');
            
 
       } 
     
    
  }
  
  public function delete_administrator($token){

      $data = array('drop_status'=>'yes');
	  
      Members::deleteData($token,$data);
	  
	  return redirect()->back()->with('success', 'Delete successfully.');

    
  }
  
  public function edit_administrator($token)
	{
	   
	   $edit['userdata'] = Members::editData($token);
	   return view('admin.edit-administrator', [ 'edit' => $edit, 'token' => $token]);
	}
	
	
	public function update_administrator(Request $request)
	{
	
	   $sid = 1;
		 $setting['setting'] = Settings::editGeneral($sid);
		 $site_max_image_size = $setting['setting']->site_max_image_size;
		 $name = $request->input('name');
		 $username = $request->input('username');
         $email = $request->input('email');
		 $user_type = $request->input('user_type');
		 if(!empty($request->input('password')))
		 {
		 $password = bcrypt($request->input('password'));
		 $pass = $password;
		 }
		 else
		 {
		 $pass = $request->input('save_password');
		 }
		 if(!empty($request->input('earnings')))
		 {
		 $earnings = $request->input('earnings');
         }
		 else
		 {
		   $earnings = 0;
		 }
		 $page_url = '/admin/administrator';
		 if(!empty($request->input('user_permission')))
	     {
	      
		  $user_permission = "";
		  foreach($request->input('user_permission') as $permission)
		  {
		     $user_permission .= $permission.',';
		  }
		  $user_permissions = rtrim($user_permission,",");
		  
	     }
	     else
	     {
	     $user_permissions = "";
	     }
		 $token = $request->input('user_token');
         
		 $request->validate([
							'name' => 'required',
							'username' => 'required',
							'password' => 'min:6',
							'email' => 'required|email',
							'user_photo' => 'mimes:jpeg,jpg,png|max:'.$site_max_image_size,
							
         ]);
		 $rules = array(
				'username' => ['required', 'regex:/^[\w-]*$/', 'max:255', Rule::unique('users') ->ignore($token, 'user_token') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				'email' => ['required', 'email', 'max:255', Rule::unique('users') ->ignore($token, 'user_token') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				
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
		
		if ($request->hasFile('user_photo')) {
			$image = $request->file('user_photo');
			$img_name = time() . '.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/users');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$user_image = $img_name;
		  }
		  else
		  {
		     $user_image = $request->input('save_photo');
		  }
		  $data = array('name' => $name, 'username' => $username, 'email' => $email, 'user_type' => $user_type, 'password' => $pass, 'earnings' => $earnings, 'user_photo' => $user_image, 'updated_at' => date('Y-m-d H:i:s'), 'user_permission' => $user_permissions);
          Members::updateData($token, $data);
          return redirect($page_url)->with('success', 'Update successfully.');
            
 
       } 
	
	
	}
  
	
	/* administrator */
	
	
	
	
}
