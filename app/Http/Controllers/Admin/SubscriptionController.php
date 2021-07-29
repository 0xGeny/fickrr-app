<?php

namespace Fickrr\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Fickrr\Http\Controllers\Controller;
use Session;
use Fickrr\Models\Subscription;
use Fickrr\Models\Settings;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
		
    }
	
	
	
	public function subscription()
    {
	    $sid = 1;
		$setting['setting'] = Settings::editGeneral($sid);
      	$subscription['view'] = Subscription::getsubscriData();
		$additional = Settings::editAdditional();
		return view('admin.subscription',[ 'subscription' => $subscription, 'setting' => $setting, 'sid' => $sid, 'additional' => $additional]);
    }
    
	
	public function add_subscription()
	{
	   
	   return view('admin.add-subscription');
	}
	
	
	public function pack_slug($string){
		   $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
		   return $slug;
    }
	
	
	public function subscription_content(Request $request)
	{
	
	  $subscription_title = $request->input('subscription_title');
	  
	  
	  $subscription_desc = htmlentities($request->input('subscription_desc'));
	  
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
		
		  $data = array('subscription_title' => $subscription_title, 'subscription_desc' => $subscription_desc);
 
			Settings::updateAdditionData($data);
            return redirect()->back()->with('success', 'Update successfully.');
		
		
	    }
	  
	
	}
	
	public function save_free_subscription(Request $request)
	{
	
	  $subscr_duration = $request->input('subscr_duration');
	  $subscr_items = $request->input('subscr_items');
	  $subscr_spaces = $request->input('subscr_spaces');
	  $user_subscr_type = $request->input('user_subscr_type');
	  $user_subscr_price = $request->input('user_subscr_price');
	  $sid = $request->input('sid');
	  $free_subscription = $request->input('free_subscription');
	  
	  $request->validate([
		                    
							
							
							'subscr_duration' => 'required',
							'subscr_items' => 'required',
							'subscr_spaces' => 'required',
							
							
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
		
		  $data = array('free_subscr_duration' => $subscr_duration, 'free_subscr_item' => $subscr_items, 'free_subscr_space' => $subscr_spaces, 'free_subscr_type' => $user_subscr_type, 'free_subscr_price' => $user_subscr_price, 'free_subscription' => $free_subscription);
 
			Settings::updateAdditionData($data);
            return redirect()->back()->with('success', 'Update successfully.');
		
		
	    }
	  
	
	}
	
	public function save_subscription(Request $request)
	{
 
         
		 
		 $subscr_name = $request->input('subscr_name');
		 $subscr_slug = $this->pack_slug($subscr_name);
		 $subscr_price = $request->input('subscr_price');
		 $subscr_duration = $request->input('subscr_duration');
		 $subscr_item_level = $request->input('subscr_item_level');
		 if(!empty($request->input('subscr_item')))
		 {
		 $subscr_item = $request->input('subscr_item');
		 }
		 else
		 {
		 $subscr_item = 0;
		 }
		 $subscr_space_level = $request->input('subscr_space_level');
		 if(!empty($request->input('subscr_space')))
		 {
		 $subscr_space = $request->input('subscr_space');
		 }
		 else
		 {
		 $subscr_space = 0;
		 }
		 if(!empty($request->input('subscr_space_type')))
		 {
		 $subscr_space_type = $request->input('subscr_space_type');
		 }
		 else
		 {
		 $subscr_space_type = "";
		 }
		 if(!empty($request->input('subscr_order')))
		 {
		 $subscr_order = $request->input('subscr_order');
		 }
		 else
		 {
		 $subscr_order = 0;
		 }
		 $subscr_email_support = $request->input('subscr_email_support');
		 $subscr_payment_mode = $request->input('subscr_payment_mode');
		 $subscr_status = $request->input('subscr_status');
		 
		 
         
		 $request->validate([
		                    
							
							'subscr_price' => 'required',
							'subscr_duration' => 'required',
							'subscr_status' => 'required',
							'subscr_item_level' => 'required',
							'subscr_space_level' => 'required',
							
							
         ]);
		 $rules = array(
				'subscr_name' => ['required', 'max:255', Rule::unique('subscription') -> where(function($sql){ $sql->where('subscr_drop_status','=','no');})],
				'subscr_price' => ['required',  Rule::unique('subscription') -> where(function($sql){ $sql->where('subscr_drop_status','=','no');})],
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
		
		   
		 
		$data = array('subscr_name' => $subscr_name, 'subscr_slug' => $subscr_slug, 'subscr_price' => $subscr_price, 'subscr_duration' => $subscr_duration, 'subscr_item_level' => $subscr_item_level, 'subscr_item' => $subscr_item, 'subscr_space_level' => $subscr_space_level, 'subscr_space' => $subscr_space, 'subscr_space_type' => $subscr_space_type, 'subscr_order' => $subscr_order, 'subscr_email_support' => $subscr_email_support, 'subscr_payment_mode' => $subscr_payment_mode, 'subscr_status' => $subscr_status);
        Subscription::insertsubData($data);
        return redirect()->back()->with('success', 'Insert successfully.');
            
 
       } 
     
    
  }
  
  
  
  public function delete_subscription($subscr_id){

      
	  $data = array('subscr_drop_status' => 'yes');
      Subscription::deleteSubscrdata($subscr_id,$data);
	  
	  return redirect()->back()->with('success', 'Delete successfully.');

    
  }
  
  
  public function edit_subscription($subscr_id)
	{
	   
	   $edit['subscri'] = Subscription::editsubData($subscr_id);
	   return view('admin.edit-subscription', [ 'edit' => $edit, 'subscr_id' => $subscr_id]);
	}
	
	
	
	public function update_subscription(Request $request)
	{
	   $subscr_id = $request->input('subscr_id');
	   $subscr_name = $request->input('subscr_name');
		 $subscr_slug = $this->pack_slug($subscr_name);
		 $subscr_price = $request->input('subscr_price');
		 $subscr_duration = $request->input('subscr_duration');
		 $subscr_item_level = $request->input('subscr_item_level');
		 if(!empty($request->input('subscr_item')))
		 {
		 $subscr_item = $request->input('subscr_item');
		 }
		 else
		 {
		 $subscr_item = 0;
		 }
		 $subscr_space_level = $request->input('subscr_space_level');
		 if(!empty($request->input('subscr_space')))
		 {
		 $subscr_space = $request->input('subscr_space');
		 }
		 else
		 {
		 $subscr_space = 0;
		 }
		 if(!empty($request->input('subscr_space_type')))
		 {
		 $subscr_space_type = $request->input('subscr_space_type');
		 }
		 else
		 {
		 $subscr_space_type = "";
		 }
		 if(!empty($request->input('subscr_order')))
		 {
		 $subscr_order = $request->input('subscr_order');
		 }
		 else
		 {
		 $subscr_order = 0;
		 }
		 $subscr_email_support = $request->input('subscr_email_support');
		 $subscr_payment_mode = $request->input('subscr_payment_mode');
		 $subscr_status = $request->input('subscr_status');
		 
		 
         
		 $request->validate([
		                    
							
							'subscr_price' => 'required',
							'subscr_duration' => 'required',
							'subscr_status' => 'required',
							'subscr_item_level' => 'required',
							'subscr_space_level' => 'required',
							
							
         ]);
		 $rules = array(
		         'subscr_name' => ['required', 'max:255', Rule::unique('subscription') ->ignore($subscr_id, 'subscr_id') -> where(function($sql){ $sql->where('subscr_drop_status','=','no');})],
				 'subscr_price' => ['required',  Rule::unique('subscription') ->ignore($subscr_id, 'subscr_id') -> where(function($sql){ $sql->where('subscr_drop_status','=','no');})],
				
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
		
		   
		 
		
		
		$data = array('subscr_name' => $subscr_name, 'subscr_slug' => $subscr_slug, 'subscr_price' => $subscr_price, 'subscr_duration' => $subscr_duration, 'subscr_item_level' => $subscr_item_level, 'subscr_item' => $subscr_item, 'subscr_space_level' => $subscr_space_level, 'subscr_space' => $subscr_space, 'subscr_space_type' => $subscr_space_type, 'subscr_order' => $subscr_order, 'subscr_email_support' => $subscr_email_support, 'subscr_payment_mode' => $subscr_payment_mode, 'subscr_status' => $subscr_status);
		
        Subscription::updatesubData($subscr_id,$data);
        return redirect()->back()->with('success', 'Update successfully.');
            
 
       } 
      
      
     
       
	
	
	}
	
  
	
	
	
}
