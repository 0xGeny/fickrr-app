<?php

namespace Fickrr\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Fickrr\Models\Settings;
use Fickrr\Models\Members;
use Fickrr\Models\Items;
use Fickrr\Models\Attribute;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
/*use Intervention\Image\Image;*/
use Illuminate\Support\Facades\File;
use Fickrr\Http\Controllers\Controller;
use Auth;
use Mail;
use URL;
use Image;
use Storage;
use Illuminate\Support\Str;



class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
		
    }
	
	public function view_attribute($type_id)
	{
	   $edit['item'] = Items::viewItemtype($type_id);
	   $data = array('edit' => $edit);
	   
	   return view('admin.attributes')->with($data);
	}
	
	
	public function view_item_type_delete($id)
	{
	    $data = array('item_type_drop_status'=>'yes');
	  
        
      Items::deleteItemtype($id,$data);
	  
	  return redirect()->back()->with('success', 'Delete successfully.');
	}
	
	
	public function edit_item_type($id)
	{
	   $edit['item_type'] = Items::viewItemtype($id);
	   $data = array('edit' => $edit);
	   
	   return view('admin.edit-item-type')->with($data);
	
	}
	
	
	public function view_items()
	{
	  
	  $itemData['item'] = Items::getentireItem();
	  $viewitem['type'] = Items::gettypeItem();
	  $encrypter = app('Illuminate\Contracts\Encryption\Encrypter');
	  $data = array('itemData' => $itemData, 'viewitem' => $viewitem, 'encrypter' => $encrypter);
	  return view('admin.items')->with($data);
	}
	
	
	public function update_edit_item_type(Request $request)
	{
	
	     $item_type_name = $request->input('item_type_name');
		 $item_type_slug = $this->item_slug($item_type_name);
		 $item_type_status = $request->input('item_type_status');
		 $item_type_id = $request->input('item_type_id');
		 
		 $request->validate([
							'item_type_name' => 'required',
							'item_type_status' => 'required',
							
         ]);
		 $rules = array(
		 
		        'item_type_name' => ['required', 'max:255', Rule::unique('item_type') ->ignore($item_type_id, 'item_type_id') -> where(function($sql){ $sql->where('item_type_drop_status','=','no');})],
				
				
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
		
		
		 
		$data = array('item_type_name' => $item_type_name, 'item_type_slug' => $item_type_slug, 'item_type_status' => $item_type_status);
       
        Items::editItemtype($item_type_id, $data);
            
 
       } 
     
       return redirect('/admin/item-type')->with('success', 'Update successfully.');
	
	}
	
	public function save_add_item_type(Request $request)
	{
	   
	     $item_type_name = $request->input('item_type_name');
		 $item_type_slug = $this->item_slug($item_type_name);
		 $item_type_status = $request->input('item_type_status');
		 
		 
		 
         
		 $request->validate([
							'item_type_name' => 'required',
							'item_type_status' => 'required',
							
         ]);
		 $rules = array(
				'item_type_name' => ['required', 'max:255', Rule::unique('item_type') -> where(function($sql){ $sql->where('item_type_drop_status','=','no');})],
				
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
		
		
		 
		$data = array('item_type_name' => $item_type_name, 'item_type_slug' => $item_type_slug, 'item_type_status' => $item_type_status);
        Items::insertItemtype($data);
        
            
 
       } 
     
       return redirect('/admin/item-type')->with('success', 'Insert successfully.');
	
	}
	
	
	
	public function view_order_single($token)
	{
	  $itemData['item'] = Items::adminorderItem($token);
	  $data = array('itemData' => $itemData);
	  return view('admin.order-details')->with($data);
	}
	
	
	public function view_more_info($token)
	{
	   $itemData['item'] = Items::getsingleOrder($token);
	   $data = array('itemData' => $itemData);
	   return view('admin.more-info')->with($data);
	 
	}
	
	public function view_item_type()
	{
	 
	  $itemData['item'] = Items::gettypeItem();
	  $data = array('itemData' => $itemData);
	  return view('admin.item-type')->with($data);
	
	}
	
	
	public function view_add_item_type()
	{
	 
	  
	  return view('admin.add-item-type');
	
	}
	
	
	public function view_item_type_status($id,$status)
	{
	  if($status == 0)
	  {
	     $data = array("item_type_status" => 1);
	     Items::updateitemType($id,$data);
	  }
	  else
	  {
	     $data = array("item_type_status" => 0);
	     Items::updateitemType($id,$data);
	  }
	 
	  return redirect()->back()->with('success','Item type has been updated'); 
	}
	
	
	public function view_refund()
	{
	  
	  $itemData['item'] = Items::getrefundItem();
	   $data = array('itemData' => $itemData);
	   return view('admin.refund')->with($data);
	}
	
	
	public function view_rating()
	{
	   $itemData['item'] = Items::getratingItem();
	   $data = array('itemData' => $itemData);
	   return view('admin.rating')->with($data);
	}
	
	
	public function rating_delete($rating_id)
	{
	   Items::dropRating($rating_id);
	   return redirect()->back()->with('success','Item rating has been removed'); 
	 
	}
	
	
	public function view_withdrawal()
	{
	  $itemData['item'] = Items::getwithdrawalData();
	   $data = array('itemData' => $itemData);
	   return view('admin.withdrawal')->with($data);
	}
	
	
	public function view_withdrawal_update($wd_id,$user_id)
	{
	         $drawal_data = array('wd_status' => 'paid');
			 Items::updatedrawalData($wd_id,$user_id,$drawal_data);
			 
	         $buyer['info'] = Members::singlebuyerData($user_id);
			 $user_token = $buyer['info']->user_token;
			 $to_name = $buyer['info']->name;
			 $to_email = $buyer['info']->email;
			 $sid = 1;
			$setting['setting'] = Settings::editGeneral($sid);
			$admin_name = $setting['setting']->sender_name;
			$admin_email = $setting['setting']->sender_email;
			$currency = $setting['setting']->site_currency;
			$with['data'] = Items::singledrawalData($wd_id);
			$wd_amount = $with['data']->wd_amount;
			
			$data = array('to_name' => $to_name, 'to_email' => $to_email, 'wd_amount' => $wd_amount, 'currency' => $currency);
			Mail::send('admin.user_withdrawal_mail', $data , function($message) use ($admin_name, $admin_email, $to_name, $to_email) {
					$message->to($to_email, $to_name)
							->subject('Payment Withdrawal Request Accepted');
					$message->from($admin_email,$admin_name);
				});
	   return redirect()->back()->with('success','Payment withdrawal request has been completed'); 			
	   
	}
	
	
	
	public function view_payment_refund($ord_id,$refund_id,$user_type)
	{
	  $order = $ord_id; 
	  $ordered['data'] = Items::singleorderData($order);
	  $user_id = $ordered['data']->user_id;
	  $item_user_id = $ordered['data']->item_user_id;
	  $vendor_amount = $ordered['data']->vendor_amount;
	  $total_price = $ordered['data']->total_price;
	  $admin_amount = $ordered['data']->admin_amount;
	  $approval_status = $ordered['data']->approval_status;
	  
	  
	  if($user_type == "buyer")
	  {
	  
	      if($approval_status == "")
		  {
		  
		    $buyer['info'] = Members::singlebuyerData($user_id);
			 $user_token = $buyer['info']->user_token;
			 $to_name = $buyer['info']->name;
			 $to_email = $buyer['info']->email;
			 $buyer_earning = $buyer['info']->earnings + $total_price;
			 $record = array('earnings' => $buyer_earning);
			 Members::updatepasswordData($user_token, $record);
			 
			$orderdata = array('approval_status' => 'payment released to buyer');
			$refundata = array('ref_refund_approval' => 'accepted');
			Items::singleorderupData($order,$orderdata);
			Items::refundupData($refund_id,$refundata);
			Items::deleteRating($ord_id);
			
			
			
			$sid = 1;
			$setting['setting'] = Settings::editGeneral($sid);
			$admin_name = $setting['setting']->sender_name;
			$admin_email = $setting['setting']->sender_email;
			$currency = $setting['setting']->site_currency;
			$data = array('to_name' => $to_name, 'to_email' => $to_email, 'total_price' => $total_price, 'currency' => $currency);
			Mail::send('admin.buyer_refund_mail', $data , function($message) use ($admin_name, $admin_email, $to_name, $to_email) {
					$message->to($to_email, $to_name)
							->subject('Payment Refund Accepted');
					$message->from($admin_email,$admin_name);
				});
				
				
			
			return redirect()->back()->with('success','Payment released to buyer'); 
		
		  
		     
		  }
		  else if($approval_status == 'payment released to buyer')
		  {
		     $refundata = array('ref_refund_approval' => 'accepted');
			 Items::refundupData($refund_id,$refundata);
			 Items::deleteRating($ord_id);
		     return redirect()->back()->with('success','Payment released to buyer');
		  }
		  else if($approval_status == 'payment released to vendor')
		  {
		  
		     $buyer['info'] = Members::singlebuyerData($user_id);
			 $user_token = $buyer['info']->user_token;
			 $to_name = $buyer['info']->name;
			 $to_email = $buyer['info']->email;
			 $buyer_earning = $buyer['info']->earnings + $total_price;
			 $record = array('earnings' => $buyer_earning);
			 Members::updatepasswordData($user_token, $record);
			 
			$orderdata = array('approval_status' => 'payment released to buyer');
			$refundata = array('ref_refund_approval' => 'accepted');
			Items::singleorderupData($order,$orderdata);
			Items::refundupData($refund_id,$refundata);
			Items::deleteRating($ord_id);
			
			
			 $vendor['info'] = Members::singlevendorData($item_user_id);
			 $vendor_token = $vendor['info']->user_token;
			 $to_name = $vendor['info']->name;
			 $to_email = $vendor['info']->email;
			 $vendor_earning = $vendor['info']->earnings - $vendor_amount;
			 $record_vendor = array('earnings' => $vendor_earning);
			 Members::updatevendorRecord($vendor_token, $record_vendor);
			 
			 
			 $admin['info'] = Members::adminData();
			 $admin_token = $admin['info']->user_token;
			 $admin_earning = $admin['info']->earnings - $admin_amount;
			 $admin_record = array('earnings' => $admin_earning);
			 Members::updateadminData($admin_token, $admin_record);
			
			
			
			$sid = 1;
			$setting['setting'] = Settings::editGeneral($sid);
			$admin_name = $setting['setting']->sender_name;
			$admin_email = $setting['setting']->sender_email;
			$currency = $setting['setting']->site_currency;
			$data = array('to_name' => $to_name, 'to_email' => $to_email, 'total_price' => $total_price, 'currency' => $currency);
			Mail::send('admin.buyer_refund_mail', $data , function($message) use ($admin_name, $admin_email, $to_name, $to_email) {
					$message->to($to_email, $to_name)
							->subject('Payment Refund Accepted');
					$message->from($admin_email,$admin_name);
				});
				
				
			
			return redirect()->back()->with('success','Payment released to buyer'); 
		
		  
		  
		    
		  }
	  
	  
	  
	  }
	  if($user_type == "vendor")
	  {
	         
			 $buyer['info'] = Members::singlebuyerData($user_id);
			 $user_token = $buyer['info']->user_token;
			 $to_name = $buyer['info']->name;
			 $to_email = $buyer['info']->email;
			 $sid = 1;
			$setting['setting'] = Settings::editGeneral($sid);
			$admin_name = $setting['setting']->sender_name;
			$admin_email = $setting['setting']->sender_email;
			$currency = $setting['setting']->site_currency;
			$refundata = array('ref_refund_approval' => 'declined');
			 Items::refundupData($refund_id,$refundata);
			$data = array('to_name' => $to_name, 'to_email' => $to_email, 'total_price' => $total_price, 'currency' => $currency);
			Mail::send('admin.buyer_declined_mail', $data , function($message) use ($admin_name, $admin_email, $to_name, $to_email) {
					$message->to($to_email, $to_name)
							->subject('Payment Refund Declined');
					$message->from($admin_email,$admin_name);
				});
			 
			  
	         
		    return redirect()->back()->with('success','Your refund request is declined');
	  
	  } 
	  
	  
	  
	  
	
	
	}
	
	
	
	
	public function view_payment_approval($ord_id,$user_type)
	{
	  $order = $ord_id; 
	  $ordered['data'] = Items::singleorderData($order);
	  $user_id = $ordered['data']->user_id;
	  $item_user_id = $ordered['data']->item_user_id;
	  $vendor_amount = $ordered['data']->vendor_amount;
	  $total_price = $ordered['data']->total_price;
	  $admin_amount = $ordered['data']->admin_amount;
	  
	  if($user_type == "vendor")
	  {
	     
		 $vendor['info'] = Members::singlevendorData($item_user_id);
		 $user_token = $vendor['info']->user_token;
		 $to_name = $vendor['info']->name;
		 $to_email = $vendor['info']->email;
		 $vendor_earning = $vendor['info']->earnings + $vendor_amount;
		 $record = array('earnings' => $vendor_earning);
		 Members::updatepasswordData($user_token, $record);
		 
		 
		 $admin['info'] = Members::adminData();
		 $admin_token = $admin['info']->user_token;
		 $admin_earning = $admin['info']->earnings + $admin_amount;
		 $admin_record = array('earnings' => $admin_earning);
		 Members::updateadminData($admin_token, $admin_record);
		 
		 
		$orderdata = array('approval_status' => 'payment released to vendor');
		Items::singleorderupData($order,$orderdata);
		 
		$sid = 1;
		$setting['setting'] = Settings::editGeneral($sid);
		$admin_name = $setting['setting']->sender_name;
		$admin_email = $setting['setting']->sender_email;
		$currency = $setting['setting']->site_currency;
		$check_email_support = Members::getuserSubscription($item_user_id);
		if($check_email_support == 1)
		{
			$data = array('to_name' => $to_name, 'to_email' => $to_email, 'vendor_amount' => $vendor_amount, 'currency' => $currency);
			Mail::send('admin.vendor_payment_mail', $data , function($message) use ($admin_name, $admin_email, $to_name, $to_email) {
					$message->to($to_email, $to_name)
							->subject('New Payment Approved');
					$message->from($admin_email,$admin_name);
				});
		}	
			
		
		return redirect()->back()->with('success','Payment released to vendor'); 
		 
	  }
	  else if($user_type == "buyer")
	  {
	     
		 $buyer['info'] = Members::singlebuyerData($user_id);
		 $user_token = $buyer['info']->user_token;
		 $to_name = $buyer['info']->name;
		 $to_email = $buyer['info']->email;
		 $buyer_earning = $buyer['info']->earnings + $total_price;
		 $record = array('earnings' => $buyer_earning);
		 Members::updatepasswordData($user_token, $record);
		 
		$orderdata = array('approval_status' => 'payment released to buyer');
		Items::singleorderupData($order,$orderdata);
		Items::deleteRating($ord_id);
		
		$sid = 1;
		$setting['setting'] = Settings::editGeneral($sid);
		$admin_name = $setting['setting']->sender_name;
		$admin_email = $setting['setting']->sender_email;
		$currency = $setting['setting']->site_currency;
		$data = array('to_name' => $to_name, 'to_email' => $to_email, 'total_price' => $total_price, 'currency' => $currency);
		Mail::send('admin.buyer_payment_mail', $data , function($message) use ($admin_name, $admin_email, $to_name, $to_email) {
				$message->to($to_email, $to_name)
						->subject('Payment Approval Cancelled');
				$message->from($admin_email,$admin_name);
			});
			
			
		
		return redirect()->back()->with('success','Payment released to buyer'); 
		
		 
	  }
	  
	  
	  
	
	
	}
	
	public function delete_orders($delete,$ord_id)
	{
	   $encrypter = app('Illuminate\Contracts\Encryption\Encrypter');
	   $order_id   = $encrypter->decrypt($ord_id);
	   Items::deleteEntire($order_id);
	   return redirect()->back()->with('success','Order has been deleted'); 
	
	}
	public function complete_orders($ord_id)
	{
	  $purchase_token = base64_decode($ord_id);
	  $purchased_token = $purchase_token;
		    		$payment_status = 'completed';
					$orderdata = array('order_status' => $payment_status);
					$checkoutdata = array('payment_status' => $payment_status);
					Items::singleordupdateData($purchased_token,$orderdata);
					Items::singlecheckoutData($purchased_token,$checkoutdata);
					$token = $purchased_token;
					$checking = Items::getcheckoutData($token);
					$order_id = $checking->order_ids;
					$order_loop = explode(',',$order_id);
					  
					  foreach($order_loop as $order)
					  {
						
						$getitem['item'] = Items::getorderData($order);
						$token = $getitem['item']->item_token;
						$item['display'] = Items::solditemData($token);
						$item_sold = $item['display']->item_sold + 1;
						$item_token = $token; 
						$data = array('item_sold' => $item_sold);
					    Items::updateitemData($item_token,$data);
					  }
					  /* referral per sale earning */
						$logged_id = $checking->user_id;
						$buyer_details = Members::singlebuyerData($logged_id);
						$referral_by = $buyer_details->referral_by;
						$additional_setting = Settings::editAdditional();
						$referral_commission = $additional_setting->per_sale_referral_commission;
						$check_referral = Members::referralCheck($referral_by);
						  if($check_referral != 0)
						  {
							  $referred['display'] = Members::referralUser($referral_by);
							  $wallet_amount = $referred['display']->earnings + $referral_commission;
							  $referral_amount = $referred['display']->referral_amount + $referral_commission;
							  $update_data = array('earnings' => $wallet_amount, 'referral_amount' => $referral_amount);
							  Members::updateReferral($referral_by,$update_data);
						   } 
					/* referral per sale earning */
		return redirect()->back()->with('success', 'Payment details has been completed');			  
	
	}
	
	
	public function view_orders()
	{
	   
	   $itemData['item'] = Items::getorderItem();
	   $data = array('itemData' => $itemData);
	   return view('admin.orders')->with($data);
	}
	
	
	
	public function edit_item($token)
	{
	 
	  
		$edit['item'] = Items::edititemData($token);
		$type_id = $edit['item']->item_type;
		$getcount  = Items::getimagesCount($token);
		$item_image['item'] = Items::getimagesData($token);
		$cat_name = $edit['item']->item_category_type; 
        $cat_id = $edit['item']->item_category;
		
		
		$getvendor['view'] = Members::getvendorData();
		$type_name = Items::slugItemtype($type_id);
		$typer_id = $type_name->item_type_id;
		$attribute['fields'] = Attribute::againAttribute($typer_id,$token);
		if(count($attribute['fields']) != 0)
		{
		 $attri_field['display'] = Attribute::againAttribute($typer_id,$token);
		}
		else
		{
		  $attri_field['display'] = Attribute::selectedAttribute($typer_id);
		}
		$data = array(  'edit' => $edit, 'token' => $token, 'item_image' => $item_image, 'getcount' => $getcount, 'cat_id' => $cat_id, 'cat_name' => $cat_name,  'getvendor' => $getvendor, 'type_name' => $type_name, 'attri_field' => $attri_field, 'attribute' => $attribute, 'typer_id' => $typer_id);
	  
	   return view('admin.edit-item')->with($data);
	    
	}
	
	
	public function drop_image_item($dropimg,$token)
	{
	   
	   $token = base64_decode($token); 
	   Items::deleteimgdata($token);
	  
	  return redirect()->back()->with('success', 'Delete successfully.');
	
	}
	
	
	
	
	public function manage_item()
	{
	 
	  
	  $itemData['item'] = Items::getitemData();
	  return view('manage-item',[ 'itemData' => $itemData]);
	}
	
	
	public function featured_item_request($featured,$item_token)
	{
	   if($featured == 'yes')
	   {
	     $featured_text = 'no';
	   }
	   else
	   {
	     $featured_text = 'yes';
	   }
	   $data = array('item_featured'=> $featured_text);
	   
	   Items::updateitemData($item_token,$data);
	   
	   return redirect()->back();
	
	}
	
	
	public function delete_item_request($token)
	{
	
	  $data = array('drop_status'=>'yes', 'item_status' => 0);
	  
      Items::admindeleteData($token,$data);
	  
	  return redirect()->back()->with('success', 'Item Deleted Successfully.');
	
	}
	

    
    public function upload_item($itemtype)
    {
	    $encrypter = app('Illuminate\Contracts\Encryption\Encrypter');
	    $type_id   = $encrypter->decrypt($itemtype);
		$itemWell['type'] = Items::gettypeItem();       
		$getvendor['view'] = Members::getvendorData();
		$attribute['fields'] = Attribute::selectedAttribute($type_id);
		$type_name = Items::viewItemtype($type_id);
		$data = array('getvendor' => $getvendor, 'itemWell' => $itemWell, 'attribute' => $attribute, 'type_id' => $type_id, 'type_name' => $type_name);
        return view('admin.upload-item')->with($data);
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
	
	/*public function item_slug($string){
		   $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
		   return $slug;
    }*/
	
	public function item_slug($string){
		   $slug=strtolower(str_replace(' ', '-', $string));
		   return $slug;
    }
	
	
	
	public function update_attribute(Request $request)
	{
	   if(!empty($request->input('compatible_browsers')))
	   {
	   $compatible_browsers = $request->input('compatible_browsers');
	   }
	   else
	   {
	   $compatible_browsers = $request->input('save_compatible_browsers');
	   }
	   if(!empty($request->input('package_includes_two')))
	   {
	   $package_includes_two = $request->input('package_includes_two');
	   }
	   else
	   {
	   $package_includes_two = $request->input('save_package_includes_two');
	   }
	   if(!empty($request->input('layout')))
	   {
	   $layout = $request->input('layout');
	   }
	   else
	   {
	   $layout = $request->input('save_layout');
	   }
	   if(!empty($request->input('package_includes_three')))
	   {
	   $package_includes_three = $request->input('package_includes_three');
	   }
	   else
	   {
	   $package_includes_three = $request->input('save_package_includes_three');
	   }
	   if(!empty($request->input('package_includes_four')))
	   {
	   $package_includes_four = $request->input('package_includes_four');
	   }
	   else
	   {
	   $package_includes_four = $request->input('save_package_includes_four');
	   }
	   if(!empty($request->input('package_includes')))
	   {
	   $package_includes = $request->input('package_includes');
	   }
	   else
	   {
	   $package_includes = $request->input('save_package_includes');
	   }
	   if(!empty($request->input('columns')))
	   {
	   $columns = $request->input('columns');
	   }
	   else
	   {
	   $columns = $request->input('save_columns');
	   }
	   if(!empty($request->input('cs_version')))
	   {
	   $cs_version = $request->input('cs_version');
	   }
	   else
	   {
	   $cs_version = $request->input('save_cs_version');
	   }
	   $attr_id = $request->input('attr_id');
	   
	   $data = array('compatible_browsers' => $compatible_browsers, 'package_includes' => $package_includes, 'package_includes_two' => $package_includes_two, 'columns' => $columns, 'layout' => $layout, 'package_includes_three' => $package_includes_three, 'cs_version' => $cs_version, 'package_includes_four' => $package_includes_four);
			
	   Items::updateAttribute($attr_id,$data);
	   
	   return redirect()->back()->with('success', 'Update successfully');
	   
	
	}
	
	
	
	public function update_items(Request $request)
	{
	   
	   $item_name = $request->input('item_name');
	   $item_slug = $this->item_slug($item_name);
	   $item_token = $request->input('item_token');
	   $item_desc = htmlentities($request->input('item_desc'));
	   $seller_refund_term = $request->input('seller_refund_term');
	   $item_category = $request->input('item_category');
	   $split = explode("_", $item_category);
         
       $cat_id = $split[1];
	   $cat_name = $split[0];
	   
	   $item_type = $request->input('item_type');
	   $type_id = $request->input('type_id');
	   $demo_url = $request->input('demo_url');
	   $video_url = $request->input('video_url');
	   $item_tags = $request->input('item_tags');
	   $regular_price = $request->input('regular_price');
	   $item_shortdesc = $request->input('item_shortdesc');
	   $free_download = $request->input('free_download');
	   $item_flash = $request->input('item_flash');
	   
	   
	   
	   
	   if(!empty($request->input('extended_price')))
	   {
	   $extended_price = $request->input('extended_price');
	   }
	   else
	   {
	    $extended_price = 0;
	   }
	   
	   if(!empty($request->input('future_update')))
	   {
	   $future_update = $request->input('future_update');
	   }
	   else
	   {
	   $future_update = 0;
	   }
	   
	   if(!empty($request->input('item_support')))
	   {
	   $item_support = $request->input('item_support');
	   }
	   else
	   {
	   $item_support = 0;
	   }
	   
	   if(!empty($request->input('video_preview_type')))
	   {
	   $video_preview_type = $request->input('video_preview_type');
	   }
	   else
	   {
	   $video_preview_type = "";
	   }
	   $video_url = $request->input('video_url');
	   
	   $user_id = $request->input('user_id');
	   $allsettings = Settings::allSettings();
	   $item_approval = $allsettings->item_approval;
	   $item_status = $request->input('item_status');
	   $item_approve_status = "Item updated successfully.";
	   
	   $seller_money_back = $request->input('seller_money_back');
	   if(!empty($request->input('seller_money_back_days')))
	   {
	   $seller_money_back_days = $request->input('seller_money_back_days');
	   }
	   else
	   {
	   $seller_money_back_days = 0;
	   }
	   
	   
	   
	   $allsettings = Settings::allSettings();
	   $image_size = $allsettings->site_max_image_size;
	   $file_size = $allsettings->site_max_file_size;
	   $watermark = $allsettings->site_watermark;
	   $url = URL::to("/");
	   
	   $save_file = $request->input('save_file');
	   
	   $file_type = $request->input('file_type');
	   if(!empty($request->input('item_file_link')))
	   {
	   $item_file_link = $request->input('item_file_link');
	   }
	   else
	   {
	   $item_file_link = "";  
	   }
	   
	   if(!empty($save_file))
	   {
		   $request->validate([
								'item_name' => 'required',
								'item_desc' => 'required',
								'seller_refund_term' => 'required',
								/*'item_thumbnail' => 'mimes:jpeg,jpg,png|max:'.$image_size.'|dimensions:width=80,height=80',*/
								'item_thumbnail' => 'mimes:jpeg,jpg,png|max:'.$image_size,
								'item_preview' => 'mimes:jpeg,jpg,png|max:'.$image_size,
								'item_file' => 'mimes:zip|max:'.$file_size,
								'item_screenshot.*' => 'image|mimes:jpeg,jpg,png|max:'.$image_size,
								
		   ]);
	   }
	   else
	   {
	      if($file_type == 'file')
		  {
			  $request->validate([
									'item_name' => 'required',
									'item_desc' => 'required',
									'seller_refund_term' => 'required',
									'item_thumbnail' => 'mimes:jpeg,jpg,png|max:'.$image_size,
									'item_preview' => 'mimes:jpeg,jpg,png|max:'.$image_size,
									'item_file' => 'required|mimes:zip|max:'.$file_size,
									'item_screenshot.*' => 'image|mimes:jpeg,jpg,png|max:'.$image_size,
									
			   ]);
		   }
		   else
		   {
		      $request->validate([
									'item_name' => 'required',
									'item_desc' => 'required',
									'seller_refund_term' => 'required',
									'item_thumbnail' => 'mimes:jpeg,jpg,png|max:'.$image_size,
									'item_preview' => 'mimes:jpeg,jpg,png|max:'.$image_size,
									/*'item_file' => 'required|mimes:zip|max:'.$file_size,*/
									'item_screenshot.*' => 'image|mimes:jpeg,jpg,png|max:'.$image_size,
									
			   ]);
		   }
	   
	   }
		 $rules = array(
				
				'item_name' => ['required', 'max:100', Rule::unique('items') ->ignore($item_token, 'item_token') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				
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
		    
		  if ($request->hasFile('item_thumbnail')) 
		  {
		    Items::droThumb($item_token);
			if($allsettings->watermark_option == 1)
			{
				$image = $request->file('item_thumbnail');
				$img_name = time() . '.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/storage/items');
				$imagePath = $destinationPath. "/".  $img_name;
				$image->move($destinationPath, $img_name);
				
				/* new code */		
				$watermarkImg=Image::make($url.'/public/storage/settings/'.$watermark);
				$img=Image::make($url.'/public/storage/items/'.$img_name);
				$wmarkWidth=$watermarkImg->width();
				$wmarkHeight=$watermarkImg->height();
	
				$imgWidth=$img->width();
				$imgHeight=$img->height();
	
				$x=0;
				$y=0;
				while($y<=$imgHeight){
					$img->insert($url.'/public/storage/settings/'.$watermark,'top-left',$x,$y);
					$x+=$wmarkWidth;
					if($x>=$imgWidth){
						$x=0;
						$y+=$wmarkHeight;
					}
				}
				$img->save(base_path('public/storage/items/'.$img_name));
				$item_thumbnail = $img_name;
				/* new code */
			 }
			 else
			 {
			    $image = $request->file('item_thumbnail');
				$img_name = time() . '.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/storage/items');
				$imagePath = $destinationPath. "/".  $img_name;
				$image->move($destinationPath, $img_name);
				$item_thumbnail = $img_name;
			 }	
			
		  }
		  else
		  {
		     $item_thumbnail = $request->input('save_thumbnail');
		  }
		  
		  
		  
		  if ($request->hasFile('item_preview')) 
		  {
		    Items::droPreview($item_token);
			if($allsettings->watermark_option == 1)
			{
				$image = $request->file('item_preview');
				$img_name = time() . '252.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/storage/items');
				$imagePath = $destinationPath. "/".  $img_name;
				$image->move($destinationPath, $img_name);
				/* new code */		
				$watermarkImg=Image::make($url.'/public/storage/settings/'.$watermark);
				$img=Image::make($url.'/public/storage/items/'.$img_name);
				$wmarkWidth=$watermarkImg->width();
				$wmarkHeight=$watermarkImg->height();
	
				$imgWidth=$img->width();
				$imgHeight=$img->height();
	
				$x=0;
				$y=0;
				while($y<=$imgHeight){
					$img->insert($url.'/public/storage/settings/'.$watermark,'top-left',$x,$y);
					$x+=$wmarkWidth;
					if($x>=$imgWidth){
						$x=0;
						$y+=$wmarkHeight;
					}
				}
				$img->save(base_path('public/storage/items/'.$img_name));
				$item_preview = $img_name;
				/* new code */
			}
			else
			{
			    $image = $request->file('item_preview');
				$img_name = time() . '252.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/storage/items');
				$imagePath = $destinationPath. "/".  $img_name;
				$image->move($destinationPath, $img_name);
				$item_preview = $img_name;
			}
			
		  }
		  else
		  {
		     $item_preview = $request->input('save_preview');
		  }
		  
		  
		  
		  
		  if ($request->hasFile('item_file')) 
		  {
			  $image = $request->file('item_file');
			  $img_name = time() . '147.'.$image->getClientOriginalExtension();
			  if($allsettings->site_s3_storage == 1)
			  {
			     Storage::disk('s3')->delete($request->input('save_file'));
				 Storage::disk('s3')->put($img_name, file_get_contents($image), 'public');
				 $item_file = $img_name;
			  }
			  else
			  {
			    Items::droFile($item_token);
				$destinationPath = public_path('/storage/items');
				$imagePath = $destinationPath. "/".  $img_name;
				$image->move($destinationPath, $img_name);
				$item_file = $img_name;
			  }	
			
		  }
		  else
		  {
		     $item_file = $request->input('save_file');
		  }
		  
		  
		  
		  if ($request->hasFile('video_file')) 
		  {
			  $image = $request->file('video_file');
			  $img_name = time() . '128.'.$image->getClientOriginalExtension();
			  if($allsettings->site_s3_storage == 1)
			  {
			     Storage::disk('s3')->delete($request->input('save_video_file'));
				 Storage::disk('s3')->put($img_name, file_get_contents($image), 'public');
				 $video_file = $img_name;
			  }
			  else
			  {
			    Items::drovideoFile($item_token);
				$destinationPath = public_path('/storage/items');
				$imagePath = $destinationPath. "/".  $img_name;
				$image->move($destinationPath, $img_name);
				$video_file = $img_name;
			  }	
			
		  }
		  else
		  {
		     $video_file = $request->input('save_video_file');
		  }
		  
		   
		 $updated_item = date('Y-m-d H:i:s'); 
		
		
		    $data = array('item_name' => $item_name, 'item_desc' => $item_desc, 'item_thumbnail' => $item_thumbnail, 'item_preview' => $item_preview, 'item_file' => $item_file, 'file_type' => $file_type, 'item_file_link' => $item_file_link, 'item_category' =>$cat_id, 'item_category_type' => $cat_name, 'item_type' => $item_type, 'regular_price' => $regular_price, 'extended_price' => $extended_price, 'demo_url' => $demo_url, 'item_tags' => $item_tags, 'item_status' => $item_status, 'item_shortdesc' => $item_shortdesc, 'free_download' => $free_download, 'item_slug' => $item_slug, 'video_url' => $video_url, 'future_update' => $future_update, 'item_support' => $item_support, 'updated_item' => $updated_item, 'item_flash' => $item_flash, 'video_preview_type' => $video_preview_type, 'video_file' => $video_file, 'item_type_cat_id' => $item_category, 'seller_refund_term' => $seller_refund_term, 'seller_money_back' => $seller_money_back, 'seller_money_back_days' => $seller_money_back_days);
			
		    Items::updateitemData($item_token,$data);
			
			Items::dropAttribute($item_token);
			
			$attribute['fields'] = Attribute::selectedAttribute($type_id);
			   foreach($attribute['fields'] as $attribute_field)
			   {
				   $multiple = $request->input('attributes_'.$attribute_field->attr_id);
				   if(isset($multiple))
				   {
					   if(count($multiple) != 0)
					   {
						   $attributes = "";
						   foreach($multiple as $browser)
						   {
							 $attributes .= $browser.',';
							 
						   }
						   $attributes_values = rtrim($attributes,",");
						   $data = array( 'item_token' => $item_token, 'attribute_id' => $attribute_field->attr_id, 'item_attribute_label' => $attribute_field->attr_label, 'item_attribute_values' => $attributes_values);
						   Items::saveAttribute($data);
					  }	 
				  }  
			   }
			
			if ($request->hasFile('item_screenshot')) 
			{
				if($allsettings->watermark_option == 1)
				{
					$files = $request->file('item_screenshot');
					foreach($files as $file)
					{
						$extension = $file->getClientOriginalExtension();
						$fileName = Str::random(5)."-".date('his')."-".Str::random(3).".".$extension;
						$folderpath  = public_path('/storage/items');
						$file->move($folderpath , $fileName);
						/* new code */		
						$watermarkImg=Image::make($url.'/public/storage/settings/'.$watermark);
						$img=Image::make($url.'/public/storage/items/'.$fileName);
						$wmarkWidth=$watermarkImg->width();
						$wmarkHeight=$watermarkImg->height();
			
						$imgWidth=$img->width();
						$imgHeight=$img->height();
			
						$x=0;
						$y=0;
						while($y<=$imgHeight){
							$img->insert($url.'/public/storage/settings/'.$watermark,'top-left',$x,$y);
							$x+=$wmarkWidth;
							if($x>=$imgWidth){
								$x=0;
								$y+=$wmarkHeight;
							}
						}
						$img->save(base_path('public/storage/items/'.$fileName));
						/* new code */
						$imgdata = array('item_token' => $item_token, 'item_image' => $fileName);
						Items::saveitemImages($imgdata);
					}
				}
				else
				{
				    $files = $request->file('item_screenshot');
					foreach($files as $file)
					{
						$extension = $file->getClientOriginalExtension();
						$fileName = Str::random(5)."-".date('his')."-".Str::random(3).".".$extension;
						$folderpath  = public_path('/storage/items');
						$file->move($folderpath , $fileName);
						$imgdata = array('item_token' => $item_token, 'item_image' => $fileName);
						Items::saveitemImages($imgdata);
					}
				}
		   }
		   
		   $getvendor['user'] = Members::singlebuyerData($user_id);
		   $token = $request->input('item_token');
			 $itemdata['data'] = Items::edititemData($token);
			 $item_id = $itemdata['data']->item_id;
			 $item_slug = $itemdata['data']->item_slug;
			 $item_url = URL::to('/item').'/'.$item_slug.'/'.$item_id;
		   $check_email_support = Members::getuserSubscription($user_id);
		   if($getvendor['user']->item_review_email == 1)
		   {
		       
			   $sid = 1;
			  $setting['setting'] = Settings::editGeneral($sid);
			  $admin_name = $setting['setting']->sender_name;
			  $admin_email = $setting['setting']->sender_email;
			  $record = array('item_url' => $item_url, 'item_name' => $item_name);
			  $to_name = $getvendor['user']->name;
			  $to_email = $getvendor['user']->email;
			  if($check_email_support == 1)
			  {
				   if($item_status == 1)
				   {
					  
					   Mail::send('admin.item_review_mail', $record, function($message) use ($admin_name, $admin_email, $to_email, $to_name) {
							$message->to($to_email, $to_name)
									->subject('Item Review Notifications');
							$message->from($admin_email,$admin_name);
						});
					  
				   }
				   if($item_status == 2)
				   {
				   
					/*$reject_data = array('drop_status' => 'yes');
					Items::rejectitemData($item_token,$reject_data);*/ 
					Mail::send('admin.item_rejected_mail', $record, function($message) use ($admin_name, $admin_email, $to_email, $to_name) {
							$message->to($to_email, $to_name)
									->subject('Item Rejected Notifications');
							$message->from($admin_email,$admin_name);
						});
				   
				   }
			   
			  } 
       
           }  
			
			
			return redirect('/admin/items')->with('success', $item_approve_status);
		
		
		}
	   
	   
	   
	   
	   
	   
	   
	
	}
	
	
	
	
	
	public function save_items(Request $request)
	{
	   
	   $item_name = $request->input('item_name');
	   $item_slug = $this->item_slug($item_name);
	   $item_desc = htmlentities($request->input('item_desc'));
	   $seller_refund_term = $request->input('seller_refund_term');
	   $item_category = $request->input('item_category');
	   
        $split = explode("_", $item_category);
         
       $cat_id = $split[1];
	   $cat_name = $split[0];
	   
	   
	   
	   $item_type = $request->input('item_type');
	   $type_id = $request->input('type_id');
	   $demo_url = $request->input('demo_url');
	   $item_tags = $request->input('item_tags');
	   $regular_price = $request->input('regular_price');
	   $item_shortdesc = $request->input('item_shortdesc');
	   $free_download = $request->input('free_download');
	   $video_url = $request->input('video_url');
	   $created_item = date('Y-m-d H:i:s');
	   $updated_item = date('Y-m-d H:i:s');
	   
	   $seller_money_back = $request->input('seller_money_back');
	   if(!empty($request->input('seller_money_back_days')))
	   {
	   $seller_money_back_days = $request->input('seller_money_back_days');
	   }
	   else
	   {
	   $seller_money_back_days = 0;
	   }
	   
	   
	   if(!empty($request->input('extended_price')))
	   {
	   $extended_price = $request->input('extended_price');
	   }
	   else
	   {
	    $extended_price = 0;
	   }
	   
	   if(!empty($request->input('future_update')))
	   {
	   $future_update = $request->input('future_update');
	   }
	   else
	   {
	   $future_update = 0;
	   }
	   
	   if(!empty($request->input('item_support')))
	   {
	   $item_support = $request->input('item_support');
	   }
	   else
	   {
	   $item_support = 0;
	   }
	   
	   $user_id = $request->input('user_id');
	   $item_token = $this->generateRandomString();
	   $allsettings = Settings::allSettings();
	   $item_approval = $allsettings->item_approval;
	   $item_status = $request->input('item_status');
	   $item_approve_status = "Item inserted successfully.";
	   
	   if(!empty($request->input('video_preview_type')))
	   {
	   $video_preview_type = $request->input('video_preview_type');
	   }
	   else
	   {
	   $video_preview_type = "";
	   }
	   $video_url = $request->input('video_url');   
	   
	   $allsettings = Settings::allSettings();
	   $image_size = $allsettings->site_max_image_size;
	   $file_size = $allsettings->site_max_file_size;
	   $watermark = $allsettings->site_watermark;
	   $url = URL::to("/");
	   
	   $file_type = $request->input('file_type');
	   if(!empty($request->input('item_file_link')))
	   {
	   $item_file_link = $request->input('item_file_link');
	   }
	   else
	   {
	   $item_file_link = "";  
	   }
	   if($file_type == 'file')
	   {
		   $request->validate([
								'item_name' => 'required',
								'item_desc' => 'required',
								'seller_refund_term' => 'required',
								/*'item_thumbnail' => 'required|mimes:jpeg,jpg,png|max:'.$image_size.'|dimensions:width=80,height=80',*/
								'item_thumbnail' => 'required|mimes:jpeg,jpg,png|max:'.$image_size,
								'item_preview' => 'required|mimes:jpeg,jpg,png|max:'.$image_size,
								'item_file' => 'mimes:zip|required|max:'.$file_size,
								'video_file' => 'mimes:mp4|max:'.$file_size,
								'item_screenshot.*' => 'image|mimes:jpeg,jpg,png|max:'.$image_size,
								
			 ]);
		}
		else
		{
		     $request->validate([
								'item_name' => 'required',
								'item_desc' => 'required',
								'seller_refund_term' => 'required',
								/*'item_thumbnail' => 'required|mimes:jpeg,jpg,png|max:'.$image_size.'|dimensions:width=80,height=80',*/
								'item_thumbnail' => 'required|mimes:jpeg,jpg,png|max:'.$image_size,
								'item_preview' => 'required|mimes:jpeg,jpg,png|max:'.$image_size,
								/*'item_file' => 'mimes:zip|required|max:'.$file_size,*/
								'video_file' => 'mimes:mp4|max:'.$file_size,
								'item_screenshot.*' => 'image|mimes:jpeg,jpg,png|max:'.$image_size,
								
			 ]);
		}	 
		 $rules = array(
				
				'item_name' => ['required', 'max:100', Rule::unique('items') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				
				
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
		    
		  if ($request->hasFile('item_thumbnail')) 
		  {
			
			if($allsettings->watermark_option == 1)
			{
			$image = $request->file('item_thumbnail');
			$img_name = time() . '.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/items');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			/* new code */		
			$watermarkImg=Image::make($url.'/public/storage/settings/'.$watermark);
            $img=Image::make($url.'/public/storage/items/'.$img_name);
            $wmarkWidth=$watermarkImg->width();
            $wmarkHeight=$watermarkImg->height();

			$imgWidth=$img->width();
			$imgHeight=$img->height();

			$x=0;
			$y=0;
			while($y<=$imgHeight){
				$img->insert($url.'/public/storage/settings/'.$watermark,'top-left',$x,$y);
				$x+=$wmarkWidth;
				if($x>=$imgWidth){
					$x=0;
					$y+=$wmarkHeight;
				}
			}
            $img->save(base_path('public/storage/items/'.$img_name));
			$item_thumbnail = $img_name;
			/* new code */
			}
			else
			{
			    $image = $request->file('item_thumbnail');
				$img_name = time() . '.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/storage/items');
				$imagePath = $destinationPath. "/".  $img_name;
				$image->move($destinationPath, $img_name);
				$item_thumbnail = $img_name;
			}
			
		  }
		  else
		  {
		     $item_thumbnail = "";
		  }
		  
		  
		  if ($request->hasFile('item_preview')) 
		  {
		    if($allsettings->watermark_option == 1)
			{
			$image = $request->file('item_preview');
			$img_name = time() . '252.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/items');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			/* new code */		
			$watermarkImg=Image::make($url.'/public/storage/settings/'.$watermark);
            $img=Image::make($url.'/public/storage/items/'.$img_name);
            $wmarkWidth=$watermarkImg->width();
            $wmarkHeight=$watermarkImg->height();

			$imgWidth=$img->width();
			$imgHeight=$img->height();

			$x=0;
			$y=0;
			while($y<=$imgHeight){
				$img->insert($url.'/public/storage/settings/'.$watermark,'top-left',$x,$y);
				$x+=$wmarkWidth;
				if($x>=$imgWidth){
					$x=0;
					$y+=$wmarkHeight;
				}
			}
            $img->save(base_path('public/storage/items/'.$img_name));
			$item_preview = $img_name;
			/* new code */
			}
			else
			{
			   $image = $request->file('item_preview');
			   $img_name = time() . '252.'.$image->getClientOriginalExtension();
			   $destinationPath = public_path('/storage/items');
			   $imagePath = $destinationPath. "/".  $img_name;
			   $image->move($destinationPath, $img_name);
			   $item_preview = $img_name;
			}
			
			
		  }
		  else
		  {
		     $item_preview = "";
		  }
		  
		  
		  if ($request->hasFile('item_file')) 
			  {
				  $image = $request->file('item_file');
				  $img_name = time() . '147.'.$image->getClientOriginalExtension();
				  if($allsettings->site_s3_storage == 1)
				  {
					 Storage::disk('s3')->put($img_name, file_get_contents($image), 'public');
					 $item_file = $img_name;
				  }
				  else
				  {
				
					$destinationPath = public_path('/storage/items');
					$imagePath = $destinationPath. "/".  $img_name;
					$image->move($destinationPath, $img_name);
					$item_file = $img_name;
				  }	
				
			  }
			  else
			  {
				 $item_file = "";
			  }
		    	  
		  
		  if ($request->hasFile('video_file')) 
		  {
			  $image = $request->file('video_file');
			  $img_name = time() . '128.'.$image->getClientOriginalExtension();
			  if($allsettings->site_s3_storage == 1)
			  {
				 Storage::disk('s3')->put($img_name, file_get_contents($image), 'public');
				 $video_file = $img_name;
			  }
			  else
			  {
			
				$destinationPath = public_path('/storage/items');
				$imagePath = $destinationPath. "/".  $img_name;
				$image->move($destinationPath, $img_name);
				$video_file = $img_name;
			  }	
			
		  }
		  else
		  {
		     $video_file = "";
		  }
		
		    $data = array('user_id' => $user_id, 'item_token' => $item_token, 'item_name' => $item_name, 'item_desc' => $item_desc, 'item_thumbnail' => $item_thumbnail, 'item_preview' => $item_preview, 'item_file' => $item_file, 'file_type' => $file_type, 'item_file_link' => $item_file_link, 'item_category' =>$cat_id, 'item_category_type' => $cat_name, 'item_type' => $item_type, 'regular_price' => $regular_price, 'extended_price' => $extended_price, 'demo_url' => $demo_url, 'item_tags' => $item_tags, 'item_status' => $item_status, 'item_shortdesc' => $item_shortdesc, 'free_download' => $free_download, 'item_slug' => $item_slug, 'video_url' => $video_url, 'future_update' => $future_update, 'item_support' => $item_support, 'created_item' => $created_item, 'updated_item' => $updated_item, 'video_preview_type' => $video_preview_type, 'video_file' => $video_file, 'item_type_cat_id' => $item_category, 'seller_refund_term' => $seller_refund_term, 'seller_money_back' => $seller_money_back, 'seller_money_back_days' => $seller_money_back_days);
			
		    Items::saveitemData($data);
			
			$attribute['fields'] = Attribute::selectedAttribute($type_id);
			   foreach($attribute['fields'] as $attribute_field)
			   {
				   if($request->input('attributes_'.$attribute_field->attr_id))
				   {
				    $multiple = $request->input('attributes_'.$attribute_field->attr_id);
				    if(count($multiple) != 0)
				    {
					   $attributes = "";
					   foreach($multiple as $browser)
					   {
						 $attributes .= $browser.',';
						 
					   }
					   $attributes_values = rtrim($attributes,",");
					   $data = array( 'item_token' => $item_token, 'attribute_id' => $attribute_field->attr_id, 'item_attribute_label' => $attribute_field->attr_label, 'item_attribute_values' => $attributes_values);
					   Items::saveAttribute($data);
				    }	
				  }   
			   }
			
			
			if ($request->hasFile('item_screenshot')) 
			{
				if($allsettings->watermark_option == 1)
				{
					$files = $request->file('item_screenshot');
					foreach($files as $file)
					{
						$extension = $file->getClientOriginalExtension();
						$fileName = Str::random(5)."-".date('his')."-".Str::random(3).".".$extension;
						$folderpath  = public_path('/storage/items');
						$file->move($folderpath , $fileName);
						/* new code */		
						$watermarkImg=Image::make($url.'/public/storage/settings/'.$watermark);
						$img=Image::make($url.'/public/storage/items/'.$fileName);
						$wmarkWidth=$watermarkImg->width();
						$wmarkHeight=$watermarkImg->height();
			
						$imgWidth=$img->width();
						$imgHeight=$img->height();
			
						$x=0;
						$y=0;
						while($y<=$imgHeight){
							$img->insert($url.'/public/storage/settings/'.$watermark,'top-left',$x,$y);
							$x+=$wmarkWidth;
							if($x>=$imgWidth){
								$x=0;
								$y+=$wmarkHeight;
							}
						}
						$img->save(base_path('public/storage/items/'.$fileName));
						/* new code */
						$imgdata = array('item_token' => $item_token, 'item_image' => $fileName);
						Items::saveitemImages($imgdata);
					}
				}
				else
				{
				   $files = $request->file('item_screenshot');
					foreach($files as $file)
					{
						$extension = $file->getClientOriginalExtension();
						$fileName = Str::random(5)."-".date('his')."-".Str::random(3).".".$extension;
						$folderpath  = public_path('/storage/items');
						$file->move($folderpath , $fileName);
						$imgdata = array('item_token' => $item_token, 'item_image' => $fileName);
						Items::saveitemImages($imgdata);
					}
				}
		 }
       
              
			
			
			return redirect('/admin/items')->with('success', $item_approve_status);
		
		
		}
	   
	   
	   
	   
	   
	   
	   
	
	}
	
	
	/* sales */
	
	public function view_sales()
	{
	  $orderData['item'] = Items::getuserCheckout();
	  
	  $total_sale = 0;
	  foreach($orderData['item'] as $item)
	  {
	    $total_sale += $item->total;
	  }
	  
	  $order['purchase'] = Items::getpurchaseCheckout();
	  
	  $purchase_sale = 0;
	  foreach($order['purchase'] as $item)
	  {
	    $purchase_sale += $item->total;
	  }
	  
	  return view('sales',[ 'orderData' => $orderData, 'total_sale' => $total_sale, 'purchase_sale' => $purchase_sale]); 
	 
	}
	
	
	
	public function view_order_details($token)
	{
	  $checkout['view'] = Items::singlecheckoutView($token);
	  $order['view'] = Items::getorderView($token);
	  return view('order-details',[ 'checkout' => $checkout, 'order' => $order]);
	}
	
	
	/* sales */
	
	
	
	/* refund */
	
	public function refund_request(Request $request)
	{
	  $item_id = $request->input('item_id');
	  $item_token = $request->input('item_token');
	  $user_id = $request->input('user_id');
	  $item_user_id = $request->input('item_user_id');
	  $ord_id = $request->input('ord_id');
	  $ref_refund_reason = $request->input('refund_reason');
	  $ref_refund_comment = $request->input('refund_comment');
	  $item_url = $request->input('item_url');
	  $refund_count = Items::checkRefund($item_token,$user_id);
	  
	  $savedata = array('ref_item_id' => $item_id, 'ref_order_id' => $ord_id, 'ref_item_token' => $item_token, 'ref_user_id' => $user_id, 'ref_item_user_id' => $item_user_id, 'ref_refund_reason' => $ref_refund_reason, 'ref_refund_comment' => $ref_refund_comment); 
	  
	  
	  
	  if($refund_count == 0)
	  {
	    Items::saveRefund($savedata);
		$userfrom['data'] = Members::singlebuyerData($user_id);
		$from_email = $userfrom['data']->email;
		$from_name = $userfrom['data']->name;
		$sid = 1;
		$setting['setting'] = Settings::editGeneral($sid);
		$admin_name = $setting['setting']->sender_name;
		$admin_email = $setting['setting']->sender_email;
		$record = array('from_name' => $from_name, 'from_email' => $from_email, 'item_url' => $item_url, 'ref_refund_reason' => $ref_refund_reason, 'ref_refund_comment' => $ref_refund_comment);
		Mail::send('refund_mail', $record, function($message) use ($admin_name, $admin_email, $from_email, $from_name) {
				$message->to($admin_email, $admin_name)
						->subject('Refund Request Received');
				$message->from($from_email,$from_name);
			});
		
		
		
	    return redirect('purchases')->with('success','Your refund request has been sent successfully');
	  }
	  else
	  {
	     
		 return redirect('purchases')->with('error','Sorry! Your refund request already sent');
	  }
	  
	  
	  
	
	}
	
	/* refund */
	
	
	
	
	
}
