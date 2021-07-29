<?php

namespace Fickrr\Http\Controllers;

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
use Auth;
use Mail;
use URL;
use Image;
use Storage;
use Twocheckout;
use Twocheckout_Charge;
use Twocheckout_Error;
use Paystack;
use PDF;
use Illuminate\Support\Str;
use Razorpay\Api\Api;
use Currency;


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
	
	
	public function favourites_item()
	{
	   $fav['item'] = Items::getfavitemData();
	   $data = array('fav' => $fav);
	   
	   return view('favourites')->with($data);
	}
	
	
	
	
	
	public function view_coupon(Request $request)
	{
	   $allsettings = Settings::allSettings();
	   $coupon = $request->input('coupon');
	   $user_id = Auth::user()->id;
	   $coupon_key = uniqid();
	   $check_coupon = Items::checkCoupon($coupon);
	   if($check_coupon == 1)
	   {
	      $single = Items::singleCoupon($coupon);
	      $coupondata['get'] = Items::getCoupon($coupon,$user_id);
		  foreach($coupondata['get'] as $couponview)
		  {
		     $order_id = $couponview->ord_id;
			 $coupon_id = $single->coupon_id;
			 $coupon_code = $single->coupon_code;
			 $coupon_type = $single->discount_type;
			 $coupon_value = $single->coupon_value;
			 $price = $couponview->item_price;
			 if($coupon_type == 'percentage')
			 {
			 $discount = ($coupon_value * $price) / 100;
			 $discount_price = $price - $discount;
			 $data = array('coupon_key' => $coupon_key, 'coupon_id' => $coupon_id, 'coupon_code' => $coupon_code, 'coupon_type' => $coupon_type, 'coupon_value' => $coupon_value, 'discount_price' => $discount_price);
			 Items::updateCoupon($order_id,$data);
			 }
			 else
			 {
			    if($coupon_value < $price)
				{
			     $discount = $coupon_value;
				 $discount_price = $price - $discount;
				 $data = array('coupon_key' => $coupon_key, 'coupon_id' => $coupon_id, 'coupon_code' => $coupon_code, 'coupon_type' => $coupon_type, 'coupon_value' => $coupon_value, 'discount_price' => $discount_price);
			 Items::updateCoupon($order_id,$data);
				}
				else
				{
				 $discount = 0; 
				 return redirect()->back()->with('error', 'Invalid Coupon Code or Expired');
				}
			 }
			
		  }
		  return redirect()->back()->with('success', 'Coupon Added Successfully.');
	   }
	   else
	   {
	      return redirect()->back()->with('error', 'Invalid Coupon Code or Expired');
	   }
	
	}
	
	
	public function invoice_download($product_token,$order_id)
	{
	    $logged = Auth::user()->id;
		$check_purchased = Items::checkPurchased($logged,$product_token);
		if($check_purchased != 0)
		{
		  $item['data'] = Items::solditemData($product_token);
		  $order_details = Items::singleorderData($order_id);
		  $pdf_filename = $order_details->ord_id.'-'.$order_details->purchase_token.'-'.$item['data']->item_slug.'.pdf';
		  $product_slug = $item['data']->item_slug;
		  $product_id = $item['data']->item_id;
		  $user_id = $order_details->user_id;
		  $user_details = Members::singlebuyerData($user_id);
		  $data = ['order_id' => $order_details->ord_id, 'purchase_id' => $order_details->purchase_token, 'purchase_date' => $order_details->start_date, 'expiry_date' => $order_details->end_date, 'license' => $order_details->license, 'product_name' => $order_details->item_name, 'product_slug' => $product_slug, 'payment_token' => $order_details->payment_token, 'payment_type' => $order_details->payment_type, 'product_price' => $order_details->item_price, 'username' => $user_details->username, 'product_id' => $product_id ];
        
        $pdf = PDF::loadView('pdf_view', $data);  
        return $pdf->download($pdf_filename);
	    
		}
		else
		{
		  return redirect('404');
		}
	}
	
	public function remove_coupon($remove,$coupon)
	{  
	   $user_id = Auth::user()->id;
	   $data = array('coupon_id' => '', 'coupon_code' => '', 'coupon_type' => '', 'coupon_value' => '', 'discount_price' => 0);
	   Items::removeCoupon($coupon,$user_id,$data);
	   return redirect()->back()->with('success', 'Coupon Removed Successfully.');
	}	
	
	
	public function remove_favourites_item($favid,$itemid)
	{
	    $fav_id = base64_decode($favid);
		$item_id = base64_decode($itemid);
		Items::dropFavitem($fav_id);
		$get['item'] = Items::selecteditemData($item_id);
		$liked = $get['item']->item_liked - 1;
		$record = array('item_liked' => $liked);
		Items::updatefavouriteData($item_id,$record);
	    return redirect()->back()->with('success', 'Item removed to favorite');
	}
	
	
	public function view_favorite_item($itemid,$favorite,$liked)
	{  
	   $item_id = base64_decode($itemid);
	   $like = base64_decode($liked) + 1;
	   $log_user = Auth::user()->id;
	   $getcount  = Items::getfavouriteCount($item_id,$log_user);
	   if($getcount == 0)
	   {
	      $data = array ('item_id' => $item_id, 'user_id' => $log_user);
		  Items::savefavouriteData($data);
		  $record = array('item_liked' => $like);
		  Items::updatefavouriteData($item_id,$record);
		  return redirect()->back()->with('success', 'Item added to favorite');
		  
	   }
	   else
	   {
	     return redirect()->back()->with('error', 'Sorry Item already added to favorite');
	   }
	  
	
	}
	
	
	public function view_withdrawal()
	{
	  $allsettings = Settings::allSettings();
	  $withdraw_option = explode(',', $allsettings->withdraw_option);
	  $itemData['item'] = Items::getdrawalData();
	  $data = array('withdraw_option' => $withdraw_option, 'itemData' => $itemData);
	  
	  return view('withdrawal')->with($data);
	}
	
	
	
	public function add_post_comment(Request $request)
	{
	    $comm_text = $request->input('comm_text');
		$comm_user_id = $request->input('comm_user_id');
		$comm_item_user_id = $request->input('comm_item_user_id');
		$comm_item_id = $request->input('comm_item_id');
		$item_url = $request->input('comm_item_url');
		
		$comm_date = date('Y-m-d H:i:s');
		$comment_data = array('comm_user_id' => $comm_user_id, 'comm_item_user_id' => $comm_item_user_id, 'comm_item_id' => $comm_item_id, 'comm_text' => $comm_text, 'comm_date' => $comm_date);
		Items::savecommentData($comment_data);
		$item_user_id = $comm_item_user_id;
		$user_id = $comm_user_id;
		$getvendor['user'] = Members::singlevendorData($item_user_id);
		$getbuyer['user'] = Members::singlebuyerData($user_id);
		$check_email_support = Members::getuserSubscription($item_user_id);
		if($getvendor['user']->item_comment_email == 1)
		{
		   if($check_email_support == 1)
		   {
				$from_name = $getbuyer['user']->name;
				$from_email = $getbuyer['user']->email;
				
				$to_name = $getvendor['user']->name;
				$to_email = $getvendor['user']->email;
				
				$record = array('item_url' => $item_url, 'from_name' => $from_name, 'from_email' => $from_email, 'comm_text' => $comm_text);
				Mail::send('comment_mail', $record, function($message) use ($from_email, $from_name, $to_name, $to_email) {
						$message->to($to_email, $to_name)
								->subject('New Comment Received');
						$message->from($from_email,$from_name);
					});
			 }		
		}	
		
		return redirect()->back();
		
	}
	
	
	
	public function reply_post_comment(Request $request)
	{
	    $comm_text = $request->input('comm_text');
		$comm_user_id = $request->input('comm_user_id');
		$comm_item_user_id = $request->input('comm_item_user_id');
		$comm_item_id = $request->input('comm_item_id');
		$comm_id = $request->input('comm_id');
		$item_url = $request->input('comm_item_url');
		$comm_date = date('Y-m-d H:i:s');
		$comment_data = array('comm_user_id' => $comm_user_id, 'comm_item_user_id' => $comm_item_user_id, 'comm_item_id' => $comm_item_id, 'comm_id' => $comm_id, 'comm_text' => $comm_text, 'comm_date' => $comm_date);
		Items::replycommentData($comment_data);
		
		$item_user_id = $comm_item_user_id;
		$user_id = $comm_user_id;
		$getvendor['user'] = Members::singlevendorData($item_user_id);
		$getbuyer['user'] = Members::singlebuyerData($user_id);
		$check_email_support = Members::getuserSubscription($item_user_id);
		if($getvendor['user']->item_comment_email == 1)
		{
		    if($check_email_support == 1)
		    {
				$from_name = $getbuyer['user']->name;
				$from_email = $getbuyer['user']->email;
				
				$to_name = $getvendor['user']->name;
				$to_email = $getvendor['user']->email;
				
				$record = array('item_url' => $item_url, 'from_name' => $from_name, 'from_email' => $from_email, 'comm_text' => $comm_text);
				Mail::send('comment_mail', $record, function($message) use ($from_email, $from_name, $to_name, $to_email) {
						$message->to($to_email, $to_name)
								->subject('New Comment Received');
						$message->from($from_email,$from_name);
					});
			}		
		}
		
		
		
		return redirect()->back()->with('success', 'Your comment has been sent');
		
	}
	
	
	public function withdrawal_request(Request $request)
	{
	   $withdrawal = $request->input('withdrawal');
	   $paypal_email = $request->input('paypal_email');
	   $stripe_email = $request->input('stripe_email');
	   $available_balance = base64_decode($request->input('available_balance'));
	   $get_amount = $request->input('get_amount');
	   $user_id = $request->input('user_id');
	   $token = $request->input('user_token');
	   $wd_data = date('Y-m-d');
	   $wd_status = "pending";
	   $paystack_email = $request->input('paystack_email');
	   $bank_details = $request->input('bank_details');
	   
	   $drawal_data = array('wd_user_id' => $user_id, 'withdraw_type' => $withdrawal, 'paypal_email' => $paypal_email, 'stripe_email' => $stripe_email, 'wd_amount' => $get_amount, 'wd_status' => $wd_status, 'wd_date' => $wd_data, 'bank_details' => $bank_details, 'paystack_email' => $paystack_email);
	   if($available_balance >= $get_amount)
	   {
	     Items::savedrawalData($drawal_data);
		 $less_amount = $available_balance - $get_amount;
		 $data = array('earnings' => $less_amount);
		 Members::updateData($token,$data);
		 return redirect()->back()->with('success', 'Your withdrawal request has been sent');
	   }
	   else
	   {
	     return redirect()->back()->with('error', 'Sorry Please check your available balance');
	   }
	   
	   
	   
	}
	
	
	public function edit_item($token)
	{
	 
		
		
		
		$edit['item'] = Items::edititemData($token);
		$type_id = $edit['item']->item_type;
		$getcount  = Items::getimagesCount($token);
		$item_image['item'] = Items::getimagesData($token);
		$cat_name = $edit['item']->item_category_type; 
        $cat_id = $edit['item']->item_category;
		
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
		
		$data = array(    'edit' => $edit, 'token' => $token, 'item_image' => $item_image, 'getcount' => $getcount, 'cat_id' => $cat_id, 'cat_name' => $cat_name, 'type_name' => $type_name, 'attri_field' => $attri_field, 'attribute' => $attribute, 'typer_id' => $typer_id);
	  
	   if($edit['item']->user_id == Auth::user()->id)
	   { 
	   return view('edit-item')->with($data);
	   }
	   else
	   {
	    return view('404');
	   }
	    
	}
	
	
	public function drop_image_item($dropimg,$token)
	{
	   
	   $token = base64_decode($token); 
	   Items::deleteimgdata($token);
	  
	  return redirect()->back()->with('success', 'Delete successfully.');
	
	}
	
	
	
	
	public function manage_item()
	{
	 
	  
	  $itemData['item'] = Items::getmanageitemData();
	  $encrypter = app('Illuminate\Contracts\Encryption\Encrypter');
	  $viewitem['type'] = Items::gettypeItem();
	  return view('manage-item',[ 'itemData' => $itemData, 'encrypter' => $encrypter, 'viewitem' => $viewitem]);
	}
	
	
	public function delete_item_request($token)
	{
	   $encrypter = app('Illuminate\Contracts\Encryption\Encrypter');
	   $token_key   = $encrypter->decrypt($token);
	   
	  $check_data = Items::checkDels($token_key);
	  if($check_data == 1)
	  {
	  $data = array('drop_status'=>'yes', 'item_status' => 0);
	  
      /*Items::deleteData($token_key,$data);*/
	  Items::admindeleteData($token_key,$data);
	  
	  return redirect()->back()->with('success', 'Your Item Deleted Successfully.');
	  }
	  else
	  {
	    return redirect('404');
	  }
	  
	  
	
	}
	

    
    public function upload_item($itemtype)
    {
	    
		$encrypter = app('Illuminate\Contracts\Encryption\Encrypter');
	    $type_id   = $encrypter->decrypt($itemtype);
		$itemWell['type'] = Items::gettypeItem();       
		$attribute['fields'] = Attribute::selectedAttribute($type_id);
		$type_name = Items::viewItemtype($type_id);
		$data = array('itemWell' => $itemWell, 'attribute' => $attribute, 'type_id' => $type_id, 'type_name' => $type_name);
        return view('upload-item')->with($data);
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
	
	public function item_slug($string){
		   $slug=strtolower(str_replace(' ', '-', $string));
		   return $slug;
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
	   $item_flash_request = $request->input('item_flash_request');
	   $allsettings = Settings::allSettings();
	   $item_approval = $allsettings->item_approval;
	   $additional_settings = Settings::editAdditional();
	   
	   $seller_money_back = $request->input('seller_money_back');
	   if(!empty($request->input('seller_money_back_days')))
	   {
	   $seller_money_back_days = $request->input('seller_money_back_days');
	   }
	   else
	   {
	   $seller_money_back_days = 0;
	   }
	   
	   $file_type = $request->input('file_type');
	   if(!empty($request->input('item_file_link')))
	   {
	   $item_file_link = $request->input('item_file_link');
	   }
	   else
	   {
	   $item_file_link = "";  
	   }
	   
	   if($item_approval == 1)
	   {
	      $item_status = 1;
		  $item_approve_status = "Your item updated successfully.";
	   }
	   else
	   {
	      $item_status = 0;
		  $item_approve_status = "Thanks for your submission. Once admin will approved your item. will publish on our marketplace.";
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
	   
	   $watermark = $allsettings->site_watermark;
	   $image_size = $allsettings->site_max_image_size;
	   $file_size = $allsettings->site_max_file_size;
	   $url = URL::to("/");
	   
	   $save_file = $request->input('save_file');
	   
	   if(!empty($save_file))
	   {
	   
	       $occupy_size = $this->changeType($this->available_space(Auth::user()->id), 'B' ,'KB');
		   if($additional_settings->subscription_mode == 1)
		   {
			   if(Auth::user()->user_subscr_space_level == 'limited')
			   {
					
					if(Auth::user()->user_subscr_space_type == 'MB')
					{ 
					$maxsize = $this->changeType(Auth::user()->user_subscr_space, 'MB', 'KB'); 
					} 
					elseif(Auth::user()->user_subscr_space_type == 'GB')
					{
					$maxsize = $this->changeType(Auth::user()->user_subscr_space, 'GB', 'KB');
					}
					else
					{
					$maxsize = $this->changeType(Auth::user()->user_subscr_space, 'TB', 'KB');
					}
					if($occupy_size < $maxsize)
					{
					  $overall_size = $maxsize - $occupy_size;
					  $round_size = round($overall_size);
					}
					else
					{
					   $overall_size = $maxsize;
					   $round_size = round($overall_size);
					}  
		   
					  $request->validate([
										'item_name' => 'required',
										'item_desc' => 'required',
										'seller_refund_term' => 'required',
										/*'item_thumbnail' => 'mimes:jpeg,jpg,png|max:'.$image_size.'|dimensions:width=80,height=80',*/
										'item_thumbnail' => 'mimes:jpeg,jpg,png|max:'.$image_size,
										'item_preview' => 'mimes:jpeg,jpg,png|max:'.$image_size,
										'item_file' => 'mimes:zip|max:'.$round_size,
										'video_file' => 'mimes:mp4|max:'.$round_size,
										'item_screenshot.*' => 'image|mimes:jpeg,jpg,png|max:'.$image_size,
										
					 ]);
				}
			}	
			else
			{
			    $request->validate([
									'item_name' => 'required',
									'item_desc' => 'required',
									'seller_refund_term' => 'required',
									/*'item_thumbnail' => 'mimes:jpeg,jpg,png|max:'.$image_size.'|dimensions:width=80,height=80',*/
									'item_thumbnail' => 'mimes:jpeg,jpg,png',
									'item_preview' => 'mimes:jpeg,jpg,png',
									'item_file' => 'mimes:zip',
									'video_file' => 'mimes:mp4',
									'item_screenshot.*' => 'image|mimes:jpeg,jpg,png',
									
				 ]);
			}	 
		 
	  }
	  else
	  {
	    
		   $occupy_size = $this->changeType($this->available_space(Auth::user()->id), 'B' ,'KB');
		   if($additional_settings->subscription_mode == 1)
		   {
			   if(Auth::user()->user_subscr_space_level == 'limited')
			   {
					
					if(Auth::user()->user_subscr_space_type == 'MB')
					{ 
					$maxsize = $this->changeType(Auth::user()->user_subscr_space, 'MB', 'KB'); 
					} 
					elseif(Auth::user()->user_subscr_space_type == 'GB')
					{
					$maxsize = $this->changeType(Auth::user()->user_subscr_space, 'GB', 'KB');
					}
					else
					{
					$maxsize = $this->changeType(Auth::user()->user_subscr_space, 'TB', 'KB');
					}
					if($occupy_size < $maxsize)
					{
					  $overall_size = $maxsize - $occupy_size;
					  $round_size = round($overall_size);
					}
					else
					{
					   $overall_size = $maxsize;
					   $round_size = round($overall_size);
					}  
					if($file_type == 'file')
					{
						 $request->validate([
											'item_name' => 'required',
											'item_desc' => 'required',
											'seller_refund_term' => 'required',
											'item_thumbnail' => 'mimes:jpeg,jpg,png|max:'.$image_size.'|dimensions:width=80,height=80',
											'item_preview' => 'mimes:jpeg,jpg,png|max:'.$image_size,
											'item_file' => 'required|mimes:zip|max:'.$round_size,
											'video_file' => 'mimes:mp4|max:'.$round_size,
											'item_screenshot.*' => 'image|mimes:jpeg,jpg,png|max:'.$image_size,
											
						 ]);
					 }
					 else
					 {
					    $request->validate([
											'item_name' => 'required',
											'item_desc' => 'required',
											'seller_refund_term' => 'required',
											'item_thumbnail' => 'mimes:jpeg,jpg,png|max:'.$image_size.'|dimensions:width=80,height=80',
											'item_preview' => 'mimes:jpeg,jpg,png|max:'.$image_size,
											/*'item_file' => 'required|mimes:zip|max:'.$round_size,*/
											'video_file' => 'mimes:mp4|max:'.$round_size,
											'item_screenshot.*' => 'image|mimes:jpeg,jpg,png|max:'.$image_size,
											
						 ]);
					 }
				}
			}	
			else
			{
			   $request->validate([
									'item_name' => 'required',
									'item_desc' => 'required',
									'seller_refund_term' => 'required',
									'item_thumbnail' => 'mimes:jpeg,jpg,png|dimensions:width=80,height=80',
									'item_preview' => 'mimes:jpeg,jpg,png',
									'item_file' => 'required|mimes:zip',
									'video_file' => 'mimes:mp4',
									'item_screenshot.*' => 'image|mimes:jpeg,jpg,png',
									
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
		
		
		    $data = array('item_name' => $item_name, 'item_desc' => $item_desc, 'item_thumbnail' => $item_thumbnail, 'item_preview' => $item_preview, 'item_file' => $item_file, 'file_type' => $file_type, 'item_file_link' => $item_file_link, 'item_category' =>$cat_id, 'item_category_type' => $cat_name, 'item_type' => $item_type, 'regular_price' => $regular_price, 'extended_price' => $extended_price, 'demo_url' => $demo_url, 'item_tags' => $item_tags, 'item_status' => $item_status, 'item_shortdesc' => $item_shortdesc, 'free_download' => $free_download, 'item_slug' => $item_slug, 'video_url' => $video_url, 'future_update' => $future_update, 'item_support' => $item_support, 'updated_item' => $updated_item, 'item_flash_request' => $item_flash_request, 'video_preview_type' => $video_preview_type, 'video_file' => $video_file, 'item_type_cat_id' => $item_category, 'seller_refund_term' => $seller_refund_term, 'seller_money_back' => $seller_money_back, 'seller_money_back_days' => $seller_money_back_days);
			
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
		 if($getvendor['user']->item_update_email == 1)
		 {
		    if($check_email_support == 1)
			{
				  $sid = 1;
				  $setting['setting'] = Settings::editGeneral($sid);
				  $admin_name = $setting['setting']->sender_name;
				  $admin_email = $setting['setting']->sender_email;
				  $record = array('item_url' => $item_url);
				  $checkdata['order'] = Items::getorderStatus($item_id,$user_id);
				  foreach($checkdata['order'] as $order)
				  { 
				  $to_name = $order->username;
				  $to_email = $order->email;
				  Mail::send('item_update_mail', $record, function($message) use ($admin_name, $admin_email, $to_email, $to_name) {
						$message->to($to_email, $to_name)
								->subject('Item Update Notifications');
						$message->from($admin_email,$admin_name);
					});
			  }
			  		
		  }	
			
			
			
		 
		 }     
			
			
			return redirect()->back()->with('success', $item_approve_status);
		
		
		}
	   
	   
	   
	   
	   
	   
	   
	
	}
	
	
	
	public function changeType($size, $from, $to){
        $arr = ['B', 'KB', 'MB', 'GB', 'TB'];
        $tSayi = array_search($to, $arr);
        $eSayi = array_search($from, $arr);
        $pow = $eSayi - $tSayi;
        /*return $size * pow(1024, $pow) . ' ' . $to;*/
		return $size * pow(1024, $pow);
    }
	
	
	public static function available_space($user_id)
	{
	    $check_user_count = Items::checkItemUser($user_id);
		if($check_user_count != 0)
		{
			$allsettings = Settings::allSettings();
			$item['display'] = Items::getItemStorage($user_id);
			$occupy_size = 0;
			if($allsettings->site_s3_storage == 1)
			{
			   foreach($item['display'] as $item)
			   {
			       $occupy_size += File::size(Storage::disk('s3')->url($item->item_file));
				   if(!empty($item->video_file))
				   {
				   $occupy_size += File::size(Storage::disk('s3')->url($item->video_file));
				   }
			   }
			}
			else
			{
			   foreach($item['display'] as $item)
			   {
			        $occupy_size += File::size(public_path('storage/items/'.$item->item_file));
					if(!empty($item->video_file))
				    {
					  $occupy_size += File::size(public_path('storage/items/'.$item->video_file));
					}
			   }
			   		
			}
	    }
		else
		{
		  $occupy_size = 0;  
		} 
		return $occupy_size;
		
	}
	
	public function save_items(Request $request)
	{
	   
	   $item_name = $request->input('item_name');
	   $item_slug = $this->item_slug($item_name);
	   $item_desc = htmlentities($request->input('item_desc'));
	   $seller_refund_term = $request->input('seller_refund_term');
	//    $item_category = $request->input('item_category');
	   
    //    $split = explode("_", $item_category);
         
       $cat_id = 5;
	   $cat_name = "graphics";
	   
	   $item_type = $request->input('item_type');
	   $type_id = $request->input('type_id');
	   $demo_url = $request->input('demo_url');
	   $item_tags = $request->input('item_tags');
	   $regular_price = $request->input('regular_price');
	   $item_shortdesc = $request->input('item_shortdesc');
	   $free_download = "";
	   $video_url = $request->input('video_url');
	   $created_item = date('Y-m-d H:i:s');
	   $updated_item = date('Y-m-d H:i:s');
	   
	   
	   
	   
	   
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
	   $item_flash_request = $request->input('item_flash_request');
	   
	   $user_id = $request->input('user_id');
	   $item_token = $this->generateRandomString();
	   $allsettings = Settings::allSettings();
	   $item_approval = $allsettings->item_approval;
	   
	   if(!empty($request->input('video_preview_type')))
	   {
	   $video_preview_type = $request->input('video_preview_type');
	   }
	   else
	   {
	   $video_preview_type = "";
	   }
	//    $video_url = $request->input('video_url'); 
	   $file_type = "$request->input('file_type')";
	   if(!empty($request->input('item_file_link')))
	   {
	   $item_file_link = $request->input('item_file_link');
	   }
	   else
	   {
	   $item_file_link = "";  
	   }
	   
	   if($item_approval == 1)
	   {
	      $item_status = 1;
		  $item_approve_status = "Your item updated successfully.";
	   }
	   else
	   {
	      $item_status = 0;
		  $item_approve_status = "Thanks for your submission. Once admin will approved your item. will publish on our marketplace.";
	   }
	   
	   $seller_money_back = $request->input('seller_money_back');
	   if(!empty($request->input('seller_money_back_days')))
	   {
	   $seller_money_back_days = $request->input('seller_money_back_days');
	   }
	   else
	   {
	   $seller_money_back_days = 0;
	   }
	   
	   $watermark = $allsettings->site_watermark;
	   $image_size = $allsettings->site_max_image_size;
	   $file_size = $allsettings->site_max_file_size;
	   $url = URL::to("/");
	   $occupy_size = $this->changeType($this->available_space(Auth::user()->id), 'B' ,'KB');
	   $additional_settings = Settings::editAdditional();
	   if($additional_settings->subscription_mode == 1)
	   {
		   if(Auth::user()->user_subscr_space_level == 'limited')
		   {
				
				if(Auth::user()->user_subscr_space_type == 'MB')
				{ 
				$maxsize = $this->changeType(Auth::user()->user_subscr_space, 'MB', 'KB'); 
				} 
				elseif(Auth::user()->user_subscr_space_type == 'GB')
				{
				$maxsize = $this->changeType(Auth::user()->user_subscr_space, 'GB', 'KB');
				}
				else
				{
				$maxsize = $this->changeType(Auth::user()->user_subscr_space, 'TB', 'KB');
				}
				if($occupy_size < $maxsize)
				{
				  $overall_size = $maxsize - $occupy_size;
				  $round_size = round($overall_size);
				}
				else
				{
				   $overall_size = $maxsize;
				   $round_size = round($overall_size);
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
									'item_file' => 'mimes:zip|required|max:'.$round_size,
									'video_file' => 'mimes:mp4|max:'.$round_size,
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
									/*'item_file' => 'mimes:zip|required|max:'.$round_size,*/
									'video_file' => 'mimes:mp4|max:'.$round_size,
									'item_screenshot.*' => 'image|mimes:jpeg,jpg,png|max:'.$image_size,
									
				 ]);
			  }	 
		  }	
	  }	  
	  else
	  {
	     if($file_type == 'file')
		 {
	        $request->validate([
								'item_name' => 'required',
								'item_desc' => 'required',
								'seller_refund_term' => 'required',
								/*'item_thumbnail' => 'required|mimes:jpeg,jpg,png|max:'.$image_size.'|dimensions:width=80,height=80',*/
								'item_thumbnail' => 'required|mimes:jpeg,jpg,png|max:'.$image_size,
								'item_preview' => 'required|mimes:jpeg,jpg,png|max:'.$image_size,
								'item_file' => 'mimes:zip|required',
								'video_file' => 'mimes:mp4',
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
								/*'item_file' => 'mimes:zip|required',*/
								'video_file' => 'mimes:mp4',
								'item_screenshot.*' => 'image|mimes:jpeg,jpg,png|max:'.$image_size,
								
			 ]);
		  
		  }	 
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
			  
		  $data = array('user_id' => $user_id, 'item_token' => $item_token, 'item_name' => $item_name, 'item_desc' => $item_desc, 'item_thumbnail' => $item_thumbnail, 'item_preview' => $item_preview, 'item_file' => $item_file, 'file_type' => $file_type, 'item_file_link' => $item_file_link, 'item_category' =>$cat_id, 'item_category_type' => $cat_name, 'item_type' => $item_type, 'regular_price' => $regular_price, 'extended_price' => $extended_price, 'demo_url' => $demo_url, 'item_tags' => $item_tags, 'item_status' => $item_status, 'item_shortdesc' => $item_shortdesc, 'free_download' => $free_download, 'item_slug' => $item_slug, 'video_url' => $video_url, 'future_update' => $future_update, 'item_support' => $item_support, 'created_item' => $created_item, 'updated_item' => $updated_item, 'item_flash_request' => $item_flash_request, 'video_preview_type' => $video_preview_type, 'video_file' => $video_file, 'item_type_cat_id' => 5, 'seller_refund_term' => $seller_refund_term, 'seller_money_back' => $seller_money_back, 'seller_money_back_days' => $seller_money_back_days);
			
			
			
			
			
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
       
       
              
			$user_item_count = Items::checkItemUser(Auth::user()->id); 
		  if(Auth::user()->user_subscr_item_level == 'limited')
		  {
		     if(Auth::user()->user_subscr_item > $user_item_count)
			 {  
			  
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
			}
			else
			{
			  return redirect()->back()->with('error', 'Sorry! Your items limit reached.');
			}
		}
		else
		{
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
		}	
		return redirect()->back()->with('success', $item_approve_status);
		
		
		}
	   
	   
	   
	   
	   
	   
	   
	
	}
	
	
	
	
	
	public function contact_support(Request $request)
	{
	   $support_subject = $request->input('support_subject');
	   $support_msg = $request->input('support_msg');
	   $to_email = $request->input('to_address');
	   $from_email = $request->input('from_address');
	   $to_name = $request->input('to_name');
	   $from_name = $request->input('from_name');
	   $item_url = $request->input('item_url');
	   $user_id = $request->input('to_id');
	   $check_email_support = Members::getuserSubscription($user_id);
	   
	    $sid = 1;
		$setting['setting'] = Settings::editGeneral($sid);
		
		$admin_name = $setting['setting']->sender_name;
        $admin_email = $setting['setting']->sender_email;
		
		$record = array('to_name' => $to_name, 'from_name' => $from_name, 'from_email' => $from_email, 'item_url' => $item_url, 'support_msg' => $support_msg, 'support_subject' => $support_subject);
		Mail::send('support_mail', $record, function($message) use ($admin_name, $admin_email, $to_email, $from_email, $to_name, $from_name) {
			$message->to($admin_email, $admin_name)
					->subject('Contact Support');
			$message->from($from_email,$from_name);
		});
		
		if($check_email_support == 1)
	    {
			Mail::send('support_mail', $record, function($message) use ($admin_name, $admin_email, $to_email, $from_email, $to_name, $from_name) {
				$message->to($to_email, $to_name)
						->subject('Contact Support');
				$message->from($from_email,$from_name);
			});
		}
	   
	  return redirect()->back()->with('success', 'Thank You! Your message sent successfully'); 
	  
	
	}
	
	
	/* cart */
	
	public function show_cart()
	{
	  $cart['item'] = Items::getcartData();
	  $cart_count = Items::getcartCount();
	   $data = array('cart' => $cart, 'cart_count' => $cart_count);
	   
	   return view('cart')->with($data);
	}
	
	
	public function remove_cart_item($ordid)
	{
	  
	   $ord_id = base64_decode($ordid); 
	   Items::deletecartdata($ord_id);
	  
	  return redirect()->back()->with('success', 'Cart item removed');
	  
	}
	
	public function remove_clear_item()
	{
	  
	   $user_id = Auth::user()->id; 
	   Items::deletecartempty($user_id);
	  
	  return redirect()->back()->with('success', 'Cart items removed');
	  
	}
	
	public function view_cart(Request $request)
	{
	  $item_price = $request->input('item_price');
	  $user_id = $request->input('user_id');
	  $item_id = $request->input('item_id');
	  $item_name = $request->input('item_name');
	  $item_user_id = $request->input('item_user_id');
	  $item_token = $request->input('item_token');
	  $additional['setting'] = Settings::editAdditional();
	  $getmember['views'] = Members::singlevendorData($item_user_id);
	  $user_exclusive_type = $getmember['views']->exclusive_author;
	  
	  $split = explode("_", $item_price);
         
       $price = base64_decode($split[0]);
	   $license = $split[1];
	   if($license == 'regular')
	   {
	     $start_date = date('Y-m-d');
		 $end_date = date('Y-m-d', strtotime('+6 month'));
	   }
	   else if($license == 'extended')
	   {
	     $start_date = date('Y-m-d');
		 $end_date = date('Y-m-d', strtotime('+12 month'));
	   }
	   
	   $order_status = 'pending';
	   
	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   
	   if($additional['setting']->subscription_mode == 0)
	   {
		   if($user_exclusive_type == 1)
		   {
		   $commission = ($setting['setting']->site_exclusive_commission * $price) / 100;
		   }
		   else
		   {
		   $commission = ($setting['setting']->site_non_exclusive_commission * $price) / 100;
		   }
		   $vendor_amount = $price - $commission;
		   $admin_amount = $commission;
		}
		else
		{
		   
		   $count_mode = Settings::checkuserSubscription($item_user_id);
		   if($count_mode == 1)
		   {
		     $vendor_amount = $price;
			 $admin_amount = 0;
		   }
		   else
		   {
		       if($user_exclusive_type == 1)
			   {
			   $commission = ($setting['setting']->site_exclusive_commission * $price) / 100;
			   }
			   else
			   {
			   $commission = ($setting['setting']->site_non_exclusive_commission * $price) / 100;
			   }
			   $vendor_amount = $price - $commission;
			   $admin_amount = $commission;
		   }
		}   
	   
	   
	   $getcount  = Items::getorderCount($item_id,$user_id,$order_status);
	   
	   $savedata = array('user_id' => $user_id, 'item_id' => $item_id, 'item_name' => $item_name, 'item_user_id' => $item_user_id, 'item_token' => $item_token, 'license' => $license, 'start_date' => $start_date, 'end_date' => $end_date, 'item_price' => $price, 'vendor_amount' => $vendor_amount, 'admin_amount' => $admin_amount, 'total_price' => $price, 'order_status' => $order_status);
	   
	   
	   $updatedata = array('license' => $license, 'start_date' => $start_date, 'end_date' => $end_date, 'item_price' => $price, 'total_price' => $price);
	   
	   
	   if($additional['setting']->subscription_mode == 0)
	   {
		   if($getcount == 0)
		   {
			  Items::savecartData($savedata);
			 
			  return redirect('cart')->with('success','Item has been added to cart'); 
		   }
		   else
		   {
			  Items::updatecartData($item_id,$user_id,$order_status,$updatedata);
			  
			  return redirect('cart')->with('success','Item has been updated to cart'); 
		   }
	   }
	   else
	   {
	      Items::deletecartremove($user_id);
		  Items::savecartData($savedata);
	      return redirect('cart')->with('success','Item has been updated to cart'); 
	   } 
	   
	  
	
	}
	
	
	/* cart */
	
	
	/* checkout */
	
	public function show_checkout()
	{
	 
	 $cart['item'] = Items::getcartData();
	  $cart_count = Items::getcartCount();
	  $mobile['item'] = Items::getcartData();
	  $sid = 1;
	  $setting['setting'] = Settings::editGeneral($sid);
	  $additional['setting'] = Settings::editAdditional();
	  if($cart_count != 0)
	  {
		  $last_order = Items::lastorderData();
		  $item_user_id = $last_order->item_user_id;
		  $count_mode = Settings::checkuserSubscription($item_user_id);
		  $vendor_details = Members::singlevendorData($item_user_id);
		  if($additional['setting']->subscription_mode == 0)
		  {
			$get_payment = explode(',', $setting['setting']->payment_option);
		  }
		  else
		  {
			 if($count_mode == 1)
			 {
				$get_payment = explode(',', $vendor_details->user_payment_option);
			 }
			 else
			 {
				$get_payment = explode(',', $setting['setting']->payment_option);
			 }
		  }
	  }
	  else
	  {
	     $get_payment = explode(',', $setting['setting']->payment_option);
	  }
	  $data = array('cart' => $cart, 'cart_count' => $cart_count, 'get_payment' => $get_payment, 'mobile' => $mobile);
	   
	   return view('checkout')->with($data);
	 
	
	}
	
	public function confirm_2checkout(Request $request)
	{
	
	   $token = $request->input('token');
	   $user_id = $request->input('user_id');
	   $user_name = $request->input('user_name');
	   $user_email = $request->input('user_email');
	   $product_names = $request->input('product_names');
	   $amount = base64_decode($request->input('amount'));
	   $site_currency = $request->input('site_currency');
	   $two_checkout_private = $request->input('two_checkout_private');
	   $two_checkout_account = $request->input('two_checkout_account');
	   $two_checkout_mode = $request->input('two_checkout_mode');
	   $purchase_token = $request->input('purchase_token');
	   $user_phone = rand(444444,999999);
	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   include(app_path() . '/2Checkout/Twocheckout.php');
						Twocheckout::privateKey($two_checkout_private); 
		                Twocheckout::sellerId($two_checkout_account); 
		                Twocheckout::sandbox($two_checkout_mode);
						Twocheckout::verifySSL(false); 
						try {
							$charge = Twocheckout_Charge::auth(array(
								"merchantOrderId" => $purchase_token,
								"token"      => $token,
								"currency"   => $site_currency,
								"total"      => $amount,
								"billingAddr" => array(
									"name" => $user_name,
									"addrLine1" => $user_name,
									"city" => $user_name,
									"state" => "US",
									"zipCode" => $user_phone,
									"country" => "US",
									"email" => $user_email,
									"phoneNumber" => $user_phone
								)
							));
							
						if ($charge['response']['responseCode'] == 'APPROVED')
			            {
						
							$payment_token = $charge['response']['transactionId'];
							 $payment_status = 'completed';
							$purchased_token = $purchase_token;
							$orderdata = array('payment_token' => $payment_token, 'order_status' => $payment_status);
							$checkoutdata = array('payment_token' => $payment_token, 'payment_status' => $payment_status);
							Items::singleordupdateData($purchased_token,$orderdata);
							Items::singlecheckoutData($purchased_token,$checkoutdata);
							
							$token = $purchased_token;
							$check['display'] = Items::getcheckoutData($token);
							$order_id = $check['display']->order_ids;
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
							/* manual payment verification : OFF */
							if($setting['setting']->payment_verification == 0)
							{
							   
								  $ordered['data'] = Items::singleorderData($order);
								  $user_id = $ordered['data']->user_id;
								  $item_user_id = $ordered['data']->item_user_id;
								  $vendor_amount = $ordered['data']->vendor_amount;
								  $total_price = $ordered['data']->total_price;
								  $admin_amount = $ordered['data']->admin_amount;
								  
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
								  $admin_name = $setting['setting']->sender_name;
								  $admin_email = $setting['setting']->sender_email;
								  $currency = $setting['setting']->site_currency;
								  $check_email_support = Members::getuserSubscription($vendor['info']->id);
								  if($check_email_support == 1)
	                              {
									  $record_data = array('to_name' => $to_name, 'to_email' => $to_email, 'vendor_amount' => $vendor_amount, 'currency' => $currency);
									  Mail::send('admin.vendor_payment_mail', $record_data , function($message) use ($admin_name, $admin_email, $to_name, $to_email) {
												$message->to($to_email, $to_name)
														->subject('New Payment Approved');
												$message->from($admin_email,$admin_name);
											});
							      }
							   
							}
							/* manual payment verification : OFF */
							
							
						  }
						
						
						$data_record = array('payment_token' => $payment_token);
						return view('success')->with($data_record);
					
					
				   }
				   else
				   {
						   return redirect('/cancel');
				   }
			} 
			catch (Twocheckout_Error $e)
			{
						
				echo $e->getMessage();
			}
	
	
	}
	
	public function view_checkout(Request $request)
	{
	   
	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   $cart_count = Items::getcartCount();
	   $additional['setting'] = Settings::editAdditional();
	   $additional_view = Settings::editAdditional();
	   $cart['item'] = Items::getcartData();
	   $mobile['item'] = Items::getcartData();
	   
	   
	   
	   $order_firstname = $request->input('order_firstname');
	   $order_lastname = $request->input('order_lastname');
	   $order_company = $request->input('order_company');
	   $order_email = $request->input('order_email');
	   $order_country = $request->input('order_country');
	   $order_address = $request->input('order_address');
	   $order_city = $request->input('order_city');
	   $token = $request->input('token');
	   $order_zipcode = $request->input('order_zipcode');
	   $order_notes = $request->input('order_notes');
	   $purchase_token = rand(111111,999999);
	   $order_id = $request->input('order_id');
	   $item_prices = base64_decode($request->input('item_prices'));
	   $item_user_id = $request->input('item_user_id');
	   $user_id = Auth::user()->id;
	   $amount = base64_decode($request->input('amount'));
	   $processing_fee = base64_decode($request->input('processing_fee'));
	   $user_email = Auth::user()->email;
	   $user_token = Auth::user()->user_token;
	   $buyer_wallet_amount = Auth::user()->earnings;
	   $final_amount = $amount + $processing_fee;
	   $payment_method = $request->input('payment_method');
	   $website_url = $request->input('website_url');
	   $payment_date = date('Y-m-d');
	   $payment_status = 'pending';
	   $reference = $request->input('reference');
	   
	   /* subscription code */
	   
	   if($cart_count != 0)
	   {
		  $last_order = Items::lastorderData();
		  $item_user_id = $last_order->item_user_id;
		  $count_mode = Settings::checkuserSubscription($item_user_id);
		  $vendor_details = Members::singlevendorData($item_user_id);
		  if($additional['setting']->subscription_mode == 0)
		  {
			  $paypal_email = $setting['setting']->paypal_email;
	          $paypal_mode = $setting['setting']->paypal_mode;
			  if($paypal_mode == 1)
			   {
				 $paypal_url = "https://www.paypal.com/cgi-bin/webscr";
			   }
			   else
			   {
				 $paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
			   }
			   $vendor_amount = base64_decode($request->input('vendor_amount'));
	           $admin_amount = base64_decode($request->input('admin_amount'));
			   
			   $stripe_mode = $setting['setting']->stripe_mode;
			   if($stripe_mode == 0)
			   {
				 $stripe_publish_key = $setting['setting']->test_publish_key;
				 $stripe_secret_key = $setting['setting']->test_secret_key;
			   }
			   else
			   {
				 $stripe_publish_key = $setting['setting']->live_publish_key;
				 $stripe_secret_key = $setting['setting']->live_secret_key;
			   }
			   $razorpay_key = $additional_view->razorpay_key;
			   
			   $payhere_mode = $additional_view->payhere_mode;
			   if($payhere_mode == 1)
			   {
			     $payhere_url = 'https://www.payhere.lk/pay/checkout';
			   }
			   else
			   {
			   $payhere_url = 'https://sandbox.payhere.lk/pay/checkout';
			   }
			   $payhere_merchant_id = $additional['setting']->payhere_merchant_id;
			   
			    $MERCHANT_KEY = $additional_view->payu_merchant_key; // add your id
				$SALT = $additional_view->payu_salt_key; // add your id
				if($additional_view->payumoney_mode == 1)
				{
				$PAYU_BASE_URL = "https://secure.payu.in";
				}
				else
				{
				$PAYU_BASE_URL = "https://test.payu.in";
				}
			   $get_payment = explode(',', $setting['setting']->payment_option);
	           
		  }
		  else
		  {
			 if($count_mode == 1)
			 {
				$paypal_email = $vendor_details->user_paypal_email;
	            $paypal_mode = $vendor_details->user_paypal_mode;
				  if($paypal_mode == 1)
				   {
					 $paypal_url = "https://www.paypal.com/cgi-bin/webscr";
				   }
				   else
				   {
					 $paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
				   }
				   $vendor_amount = base64_decode($request->input('vendor_amount')) + base64_decode($request->input('admin_amount'));
	               $admin_amount = 0;
				   
				   $stripe_mode = $vendor_details->user_stripe_mode;
				   if($stripe_mode == 0)
				   {
					 $stripe_publish_key = $vendor_details->user_test_publish_key;
					 $stripe_secret_key = $vendor_details->user_test_secret_key;
				   }
				   else
				   {
					 $stripe_publish_key = $vendor_details->user_live_publish_key;
					 $stripe_secret_key = $vendor_details->user_live_secret_key;
				   }
				   $razorpay_key = $vendor_details->user_razorpay_key;
				   
				   $payhere_mode = $vendor_details->user_payhere_mode;
				   if($payhere_mode == 1)
				   {
					 $payhere_url = 'https://www.payhere.lk/pay/checkout';
				   }
				   else
				   {
				   $payhere_url = 'https://sandbox.payhere.lk/pay/checkout';
				   }
				   $payhere_merchant_id = $vendor_details->user_payhere_merchant_id;
				   
				   $MERCHANT_KEY = $vendor_details->user_payu_merchant_key; // add your id
					$SALT = $vendor_details->user_payu_salt_key; // add your id
					if($vendor_details->user_payumoney_mode == 1)
					{
					$PAYU_BASE_URL = "https://secure.payu.in";
					}
					else
					{
					$PAYU_BASE_URL = "https://test.payu.in";
					}
				   $get_payment = explode(',', $vendor_details->user_payment_option);
			 }
			 else
			 {
				  $paypal_email = $setting['setting']->paypal_email;
				  $paypal_mode = $setting['setting']->paypal_mode;
				  if($paypal_mode == 1)
				   {
					 $paypal_url = "https://www.paypal.com/cgi-bin/webscr";
				   }
				   else
				   {
					 $paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
				   }
				   $vendor_amount = base64_decode($request->input('vendor_amount'));
	               $admin_amount = base64_decode($request->input('admin_amount'));
				   
				   $stripe_mode = $setting['setting']->stripe_mode;
				   if($stripe_mode == 0)
				   {
					 $stripe_publish_key = $setting['setting']->test_publish_key;
					 $stripe_secret_key = $setting['setting']->test_secret_key;
				   }
				   else
				   {
					 $stripe_publish_key = $setting['setting']->live_publish_key;
					 $stripe_secret_key = $setting['setting']->live_secret_key;
				   }
				   $razorpay_key = $additional_view->razorpay_key;
				   
				   $payhere_mode = $additional_view->payhere_mode;
				   if($payhere_mode == 1)
				   {
					 $payhere_url = 'https://www.payhere.lk/pay/checkout';
				   }
				   else
				   {
				   $payhere_url = 'https://sandbox.payhere.lk/pay/checkout';
				   }
				   $payhere_merchant_id = $additional_view->payhere_merchant_id;
				   
				   $MERCHANT_KEY = $additional_view->payu_merchant_key; // add your id
					$SALT = $additional_view->payu_salt_key; // add your id
					if($additional_view->payumoney_mode == 1)
					{
					$PAYU_BASE_URL = "https://secure.payu.in";
					}
					else
					{
					$PAYU_BASE_URL = "https://test.payu.in";
					}
				   $get_payment = explode(',', $setting['setting']->payment_option);
			 }
		  }
	  }
	  $totaldata = array('cart' => $cart, 'cart_count' => $cart_count, 'get_payment' => $get_payment, 'mobile' => $mobile);
	  /* subscription code */ 
	   
	   
	   
	   $getcount  = Items::getcheckoutCount($purchase_token,$user_id,$payment_status);
	   
	   $savedata = array('purchase_token' => $purchase_token, 'order_ids' => $order_id, 'item_prices' => $item_prices, 'item_user_id' => $item_user_id, 'user_id' => $user_id, 'total' => $amount, 'vendor_amount' => $vendor_amount, 'admin_amount' => $admin_amount, 'processing_fee' => $processing_fee, 'payment_type' => $payment_method, 'payment_date' => $payment_date, 'order_firstname' => $order_firstname, 'order_lastname' => $order_lastname, 'order_company' => $order_company, 'order_email' => $order_email, 'order_country' => $order_country, 'order_address' => $order_address, 'order_city' => $order_city, 'order_zipcode' => $order_zipcode, 'order_notes' => $order_notes, 'payment_status' => $payment_status);
	   
	   $updatedata = array('order_ids' => $order_id, 'item_prices' => $item_prices, 'item_user_id' => $item_user_id, 'total' => $amount, 'vendor_amount' => $vendor_amount, 'admin_amount' => $admin_amount, 'processing_fee' => $processing_fee, 'payment_type' => $payment_method, 'payment_date' => $payment_date, 'order_firstname' => $order_firstname, 'order_lastname' => $order_lastname, 'order_company' => $order_company, 'order_email' => $order_email, 'order_country' => $order_country, 'order_address' => $order_address, 'order_city' => $order_city, 'order_zipcode' => $order_zipcode, 'order_notes' => $order_notes);
	   
	   
	   /* settings */
	   
	   
	   $site_currency = $setting['setting']->site_currency;
	   
	   $success_url = $website_url.'/success/'.$purchase_token;
	   $cancel_url = $website_url.'/cancel';
	   $payhere_success_url = $website_url.'/payhere-success/'.$purchase_token;
	   
	   
	   $two_checkout_mode = $setting['setting']->two_checkout_mode;
	   $two_checkout_account = $setting['setting']->two_checkout_account;
	   $two_checkout_publishable = $setting['setting']->two_checkout_publishable;
	   $two_checkout_private = $setting['setting']->two_checkout_private;
	   
	   /* settings */
	   
	   
	   if($getcount == 0)
	   {
	      Items::savecheckoutData($savedata);
		  
		  
		  $order_loop = explode(',',$order_id);
		  $item_names = "";
		  foreach($order_loop as $order)
		  {
		    $single_order = Items::getorderData($order);
			$buyer_id = $single_order->item_user_id;
			$buyer_info['view'] = Members::singlebuyerData($buyer_id);
			$buyer_type = $buyer_info['view']->exclusive_author;
			$count_mode = Settings::checkuserSubscription($buyer_id);
			if($single_order->coupon_type == 'fixed')
			{
			    $price_item = $single_order->item_price - $single_order->coupon_value;
			}
			else if($single_order->coupon_type == 'percentage')
			{
				$price_item = $single_order->discount_price;
			}
			else
			{
			   $price_item = $single_order->item_price;
			}
			if($additional['setting']->subscription_mode == 0)
		    {
				if($buyer_type == 1)
				{
				$commission =($price_item * $setting['setting']->site_exclusive_commission) / 100;
				}
				else
				{
				$commission =($price_item * $setting['setting']->site_non_exclusive_commission) / 100;
				}
				$amount_price = $commission;
				$vendor_price = $price_item - $commission;
			}
			else
			{
			    if($count_mode == 1)
				{
				    
				  	$vendor_price = $price_item;
				  	$amount_price = 0;
				  
				}
				else
				{
				    
					if($buyer_type == 1)
					{
					$commission =($price_item * $setting['setting']->site_exclusive_commission) / 100;
					}
					else
					{
					$commission =($price_item * $setting['setting']->site_non_exclusive_commission) / 100;
					}
					$amount_price = $commission;
					$vendor_price = $price_item - $commission;
				}
			}	
		    $orderdata = array('purchase_token' => $purchase_token, 'payment_type' => $payment_method, 'vendor_amount' => $vendor_price, 'admin_amount' => $amount_price, 'total_price' => $price_item);
			Items::singleorderupData($order,$orderdata);
			$item['name'] = Items::singleorderData($order);
			$item_names .= $item['name']->item_name;
					   
		  }
		  $item_names_data = rtrim($item_names,',');
		  
		  
		  if($payment_method == 'paypal')
		  {
		     
			 $paypal = '<form method="post" id="paypal_form" action="'.$paypal_url.'">
			  <input type="hidden" value="_xclick" name="cmd">
			  <input type="hidden" value="'.$paypal_email.'" name="business">
			  <input type="hidden" value="'.$item_names_data.'" name="item_name">
			  <input type="hidden" value="'.$purchase_token.'" name="item_number">
			  <input type="hidden" value="'.$final_amount.'" name="amount">
			  <input type="hidden" value="'.$site_currency.'" name="currency_code">
			  <input type="hidden" value="'.$success_url.'" name="return">
			  <input type="hidden" value="'.$cancel_url.'" name="cancel_return">
			  		  
			</form>';
			$paypal .= '<script>window.paypal_form.submit();</script>';
			echo $paypal;
					 
			 
		  }
		  else if($payment_method == 'payumoney')
		  {
		        if($site_currency != 'INR')
			   {
		       $convert = Currency::convert($site_currency,'INR',$final_amount);
			   $convertedAmount = $convert['convertedAmount'];
			   $price_amount = $convertedAmount;
			   }
			   else
			   {
			   $price_amount = $final_amount;
			   }
		        $action = '';
				$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
				$posted = array();
				$posted = array(
					'key' => $MERCHANT_KEY,
					'txnid' => $txnid,
					'amount' => $price_amount,
					'udf1' => $purchase_token,
					'firstname' => $order_firstname,
					'email' => $order_email,
					'productinfo' => $item_names_data,
					'surl' => $website_url.'/payu_success',
					'furl' => $website_url.'/cancel',
					'service_provider' => 'payu_paisa',
				);
				$payu_success = $website_url.'/payu_success';
				
				if(empty($posted['txnid'])) {
					$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
				} 
				else 
				{
					$txnid = $posted['txnid'];
				}
				$hash = '';
				$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
				if(empty($posted['hash']) && sizeof($posted) > 0) {
					$hashVarsSeq = explode('|', $hashSequence);
					$hash_string = '';  
					foreach($hashVarsSeq as $hash_var) {
						$hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
						$hash_string .= '|';
					}
					$hash_string .= $SALT;
				
					$hash = strtolower(hash('sha512', $hash_string));
					$action = $PAYU_BASE_URL . '/_payment';
				} 
				elseif(!empty($posted['hash'])) 
				{
					$hash = $posted['hash'];
					$action = $PAYU_BASE_URL . '/_payment';
				}
				$paymoney = '<form action="'.$action.'" method="post" name="payumoney_form">
            <input type="hidden" name="key" value="'.$MERCHANT_KEY.'" />
            <input type="hidden" name="hash" value="'.$hash.'"/>
            <input type="hidden" name="txnid" value="'.$txnid.'" />
			<input type="hidden" name="udf1" value="'.$purchase_token.'" />
            <input type="hidden" name="amount" value="'.$price_amount.'" />
            <input type="hidden" name="firstname" id="firstname" value="'.$order_firstname.'" />
            <input type="hidden" name="email" id="email" value="'.$order_email.'" />
            <input type="hidden" name="productinfo" value="'.$item_names_data.'">
            <input type="hidden" name="surl" value="'.$payu_success.'" />
            <input type="hidden" name="furl" value="'.$cancel_url.'" />
            <input type="hidden" name="service_provider" value="payu_paisa"  />
			</form>';
			/*if(!$hash) {*/
            $paymoney .= '<script>window.payumoney_form.submit();</script>';
			/*}*/
			echo $paymoney;

		  }
		  else if($payment_method == 'payhere')
		  {
		      if($site_currency != 'LKR')
			   {
		       $convert = Currency::convert($site_currency,'LKR',$final_amount);
			   $convertedAmount = $convert['convertedAmount'];
			   $price_amount = $convertedAmount;
			   }
			   else
			   {
			   $price_amount = $final_amount;
			   }
		      $payhere = '<form method="post" action="'.$payhere_url.'" id="payhere_form">   
							<input type="hidden" name="merchant_id" value="'.$payhere_merchant_id.'">
							<input type="hidden" name="return_url" value="'.$payhere_success_url.'">
							<input type="hidden" name="cancel_url" value="'.$cancel_url.'">
							<input type="hidden" name="notify_url" value="'.$cancel_url.'">  
							<input type="hidden" name="order_id" value="'.$purchase_token.'">
							<input type="hidden" name="items" value="'.$item_names_data.'"><br>
							<input type="hidden" name="currency" value="LKR">
							<input type="hidden" name="amount" value="'.$price_amount.'">  
							
							<input type="hidden" name="first_name" value="'.$order_firstname.'">
							<input type="hidden" name="last_name" value="'.$order_lastname.'"><br>
							<input type="hidden" name="email" value="'.$order_email.'">
							<input type="hidden" name="phone" value="'.$order_zipcode.'"><br>
							<input type="hidden" name="address" value="'.$order_address.'">
							<input type="hidden" name="city" value="'.$order_city.'">
							<input type="hidden" name="country" value="'.$order_country.'">
							  
						</form>'; 
						$payhere .= '<script>window.payhere_form.submit();</script>';
			            echo $payhere;
		  }
		  else if($payment_method == 'twocheckout')
		  {
		    
			$record = array('final_amount' => $final_amount, 'purchase_token' => $purchase_token, 'payment_method' => $payment_method, 'item_names_data' => $item_names_data, 'site_currency' => $site_currency, 'website_url' => $website_url, 'two_checkout_private' => $two_checkout_private, 'two_checkout_account' => $two_checkout_account, 'two_checkout_mode' => $two_checkout_mode, 'token' => $token, 'two_checkout_publishable' => $two_checkout_publishable);
       return view('order-confirm')->with($record);
			
		  }
		  else if($payment_method == 'paystack')
		  {
		       if($site_currency != 'NGN')
			   {
		       $convert = Currency::convert($site_currency,'NGN',$final_amount);
			   $convertedAmount = $convert['convertedAmount'];
			   $price_amount = $convertedAmount * 100;
			   }
			   else
			   {
			   $price_amount = $final_amount * 100;
			   }
		       $callback = $website_url.'/paystack';
			   $csf_token = csrf_token();
			   
			   $paystack = '<form method="post" id="stack_form" action="'.route('paystack').'">
					  <input type="hidden" name="_token" value="'.$csf_token.'">
					  <input type="hidden" name="email" value="'.$user_email.'" >
					  <input type="hidden" name="order_id" value="'.$purchase_token.'">
					  <input type="hidden" name="amount" value="'.$price_amount.'">
					  <input type="hidden" name="quantity" value="1">
					  <input type="hidden" name="currency" value="NGN">
					  <input type="hidden" name="reference" value="'.$reference.'">
					  <input type="hidden" name="callback_url" value="'.$callback.'">
					  <input type="hidden" name="metadata" value="'.$purchase_token.'">
					  <input type="hidden" name="key" value="'.$setting['setting']->paystack_secret_key.'">
					</form>';
					$paystack .= '<script>window.stack_form.submit();</script>';
					echo $paystack;
			 
		  }
		  else if($payment_method == 'razorpay')
		  {
		       $additional['settings'] = Settings::editAdditional();
			   if($site_currency != 'INR')
			   {
		       $convert = Currency::convert($site_currency,'INR',$final_amount);
			   $convertedAmount = $convert['convertedAmount'];
			   $price_amount = $convertedAmount * 100;
			   }
			   else
			   {
			   $price_amount = $final_amount * 100;
			   }
			   $csf_token = csrf_token();
			   $logo_url = $website_url.'/public/storage/settings/'.$setting['setting']->site_logo;
			   $script_url = $website_url.'/resources/views/theme/js/vendor.min.js';
			   $callback = $website_url.'/razorpay';
			   $razorpay = '
			   <script type="text/javascript" src="'.$script_url.'"></script>
			   <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
			   <script>
				var options = {
					"key": "'.$razorpay_key.'",
					"amount": "'.$price_amount.'", 
					"currency": "INR",
					"name": "'.$item_names_data.'",
					"description": "'.$purchase_token.'",
					"image": "'.$logo_url.'",
					"callback_url": "'.$callback.'",
					"prefill": {
						"name": "'.$order_firstname.'",
						"email": "'.$order_email.'"
						
					},
					"notes": {
						"address": "'.$order_address.'"
						
						
					},
					"theme": {
						"color": "'.$setting['setting']->site_theme_color.'"
					}
				};
				var rzp1 = new Razorpay(options);
				rzp1.on("payment.failed", function (response){
						alert(response.error.code);
						alert(response.error.description);
						alert(response.error.source);
						alert(response.error.step);
						alert(response.error.reason);
						alert(response.error.metadata);
				});
				
				$(window).on("load", function() {
					 rzp1.open();
					e.preventDefault();
					});
				</script>';
				echo $razorpay;
					
					
		  }
		  else if($payment_method == 'localbank')
		  {
		    $bank_details = $setting['setting']->local_bank_details;
		    $bank_data = array('purchase_token' => $purchase_token, 'bank_details' => $bank_details);
	        return view('bank-details')->with($bank_data);
		  }
		  else if($payment_method == 'wallet')
		  {
		      if($buyer_wallet_amount >= $final_amount)
			   {    
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
					 
					 $earn_wallet = $buyer_wallet_amount - $final_amount;
					$walet_data = array('earnings' => $earn_wallet); 
					Members::updateData($user_token,$walet_data); 
					  foreach($order_loop as $order)
					  {
						
						$getitem['item'] = Items::getorderData($order);
						$token = $getitem['item']->item_token;
						$item['display'] = Items::solditemData($token);
						$item_sold = $item['display']->item_sold + 1;
						$item_token = $token; 
						$data = array('item_sold' => $item_sold);
					    Items::updateitemData($item_token,$data);
						/* manual payment verification : OFF */
						if($setting['setting']->payment_verification == 0)
						{
						   
							  $ordered['data'] = Items::singleorderData($order);
							  $user_id = $ordered['data']->user_id;
							  $item_user_id = $ordered['data']->item_user_id;
							  $vendor_amount = $ordered['data']->vendor_amount;
							  $total_price = $ordered['data']->total_price;
							  $admin_amount = $ordered['data']->admin_amount;
							  
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
							  $admin_name = $setting['setting']->sender_name;
							  $admin_email = $setting['setting']->sender_email;
							  $currency = $setting['setting']->site_currency;
							  $check_email_support = Members::getuserSubscription($vendor['info']->id);
							  if($check_email_support == 1)
							  {
								  $record_data = array('to_name' => $to_name, 'to_email' => $to_email, 'vendor_amount' => $vendor_amount, 'currency' => $currency);
								  Mail::send('admin.vendor_payment_mail', $record_data , function($message) use ($admin_name, $admin_email, $to_name, $to_email) {
											$message->to($to_email, $to_name)
													->subject('New Payment Approved');
											$message->from($admin_email,$admin_name);
										});
							  }			
						 
						   
						}
						/* manual payment verification : OFF */
						
						
					  }
					  /* referral per sale earning */
						$logged_id = Auth::user()->id;
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
					return redirect('success');
			   }
			   else
			   {
			      return redirect()->back()->with('error', 'Please check your wallet balance amount');
			   }
		  }
		  /* stripe code */
		  else if($payment_method == 'stripe')
		  {
		     
			 			 
				$stripe = array(
					"secret_key"      => $stripe_secret_key,
					"publishable_key" => $stripe_publish_key
				);
			 
				\Stripe\Stripe::setApiKey($stripe['secret_key']);
			 
				
				$customer = \Stripe\Customer::create(array(
					'email' => $order_email,
					'source'  => $token
				));
			 
				
				$item_name = $item_names_data;
				$item_price = $amount * 100;
				$currency = $site_currency;
				$order_id = $purchase_token;
			 
				
				$charge = \Stripe\Charge::create(array(
					'customer' => $customer->id,
					'amount'   => $item_price,
					'currency' => $currency,
					'description' => $item_name,
					'metadata' => array(
						'order_id' => $order_id
					)
				));
			 
				
				$chargeResponse = $charge->jsonSerialize();
			 
				
				if($chargeResponse['paid'] == 1 && $chargeResponse['captured'] == 1) 
				{
			 
					
										
					$payment_token = $chargeResponse['balance_transaction'];
					$payment_status = 'completed';
					$purchased_token = $order_id;
					$orderdata = array('payment_token' => $payment_token, 'order_status' => $payment_status);
					$checkoutdata = array('payment_token' => $payment_token, 'payment_status' => $payment_status);
					Items::singleordupdateData($purchased_token,$orderdata);
					Items::singlecheckoutData($purchased_token,$checkoutdata);
					
					$token = $purchased_token;
					$check['display'] = Items::getcheckoutData($token);
					$order_id = $check['display']->order_ids;
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
						/* subscription code */
						$additional['setting'] = Settings::editAdditional();
						$ordered['data'] = Items::singleorderData($order);
						$item_user_id = $ordered['data']->item_user_id;
						$vendor['info'] = Members::singlevendorData($item_user_id);
						$to_name = $vendor['info']->name;
						$to_email = $vendor['info']->email;
						$vendor_amount = $ordered['data']->vendor_amount;
						$admin_name = $setting['setting']->sender_name;
						$admin_email = $setting['setting']->sender_email;
						$currency = $setting['setting']->site_currency;
						$count_mode = Settings::checkuserSubscription($item_user_id);
						/* manual payment verification : OFF */
						if($additional['setting']->subscription_mode == 0)
						{
							if($setting['setting']->payment_verification == 0)
							{
							   
								  
								  $user_id = $ordered['data']->user_id;
								  
								  $total_price = $ordered['data']->total_price;
								  $admin_amount = $ordered['data']->admin_amount;
								  
								  
								  $user_token = $vendor['info']->user_token;
								  
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
							 
							}
							
							$record_data = array('to_name' => $to_name, 'to_email' => $to_email, 'vendor_amount' => $vendor_amount, 'currency' => $currency);
							Mail::send('admin.vendor_payment_mail', $record_data , function($message) use ($admin_name, $admin_email, $to_name, $to_email) {
												$message->to($to_email, $to_name)
														->subject('New Payment Approved');
												$message->from($admin_email,$admin_name);
											});
						}	
						else
						{
						   if($count_mode == 1)
						   {
							   
								  $orderdata = array('approval_status' => 'payment released to vendor');
								  Items::singleorderupData($order,$orderdata);
								  $check_email_support = Members::getuserSubscription($vendor['info']->id);
								  if($check_email_support == 1)
								  {
									  $record_data = array('to_name' => $to_name, 'to_email' => $to_email, 'vendor_amount' => $vendor_amount, 'currency' => $currency);
									  Mail::send('admin.vendor_payment_mail', $record_data , function($message) use ($admin_name, $admin_email, $to_name, $to_email) {
												$message->to($to_email, $to_name)
														->subject('New Payment Approved');
												$message->from($admin_email,$admin_name);
											});
								  }
						   }
						   else
						   {
							  
							  if($setting['setting']->payment_verification == 0)
							 {
								  $user_id = $ordered['data']->user_id;
								  
								  $total_price = $ordered['data']->total_price;
								  $admin_amount = $ordered['data']->admin_amount;
								  
								  
								  $user_token = $vendor['info']->user_token;
								  
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
								  
								  
								  $check_email_support = Members::getuserSubscription($vendor['info']->id);
								  if($check_email_support == 1)
								  {
									  $record_data = array('to_name' => $to_name, 'to_email' => $to_email, 'vendor_amount' => $vendor_amount, 'currency' => $currency);
									  Mail::send('admin.vendor_payment_mail', $record_data , function($message) use ($admin_name, $admin_email, $to_name, $to_email) {
												$message->to($to_email, $to_name)
														->subject('New Payment Approved');
												$message->from($admin_email,$admin_name);
											});
								  }
							 
							  }
							  
							  
						   }
						   
						   
						}	
						/* manual payment verification : OFF */
						/* subscription code */
												
						
					  }
					
					/* referral per sale earning */
						$logged_id = Auth::user()->id;
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
					$data_record = array('payment_token' => $payment_token);
					return view('success')->with($data_record);
					
					
				}
		     
		  
		  }
		  /* stripe code */
		  
		 
		  
	   }
	   else
	   {
	   
	      Items::updatecheckoutData($purchase_token,$user_id,$payment_status,$updatedata);
		  $order_loop = explode(',',$order_id);
		  foreach($order_loop as $order)
		  {
		    $single_order = Items::getorderData($order);
			$buyer_id = $single_order->item_user_id;
			$buyer_info['view'] = Members::singlebuyerData($buyer_id);
			$buyer_type = $buyer_info['view']->exclusive_author;
			if($single_order->coupon_type == 'fixed')
			{
			$price_item = $single_order->item_price - $single_order->coupon_value;
			}
			else if($single_order->coupon_type == 'percentage')
			{
			$price_item = $single_order->discount_price;
			}
			else
			{
			$price_item = $single_order->item_price;
			}
			if($buyer_type == 1)
			{
			$commission =($price_item * $setting['setting']->site_exclusive_commission) / 100;
			}
			else
			{
			$commission =($price_item * $setting['setting']->site_non_exclusive_commission) / 100;
			}
			$amount_price = $commission;
			$vendor_price = $price_item - $commission;
		    $orderdata = array('purchase_token' => $purchase_token, 'payment_type' => $payment_method, 'vendor_amount' => $vendor_price, 'admin_amount' => $amount_price, 'total_price' => $price_item);
			Items::singleorderupData($order,$orderdata);
			$item['name'] = Items::singleorderData($order);
			$item_names .= $item['name']->item_name;

		   
		  }
		  $item_names_data = rtrim($item_names,',');
		  
		  
		  if($payment_method == 'paypal')
		  {
		     
			 $paypal = '<form method="post" id="paypal_form" action="'.$paypal_url.'">
			  <input type="hidden" value="_xclick" name="cmd">
			  <input type="hidden" value="'.$paypal_email.'" name="business">
			  <input type="hidden" value="'.$item_names_data.'" name="item_name">
			  <input type="hidden" value="'.$purchase_token.'" name="item_number">
			  <input type="hidden" value="'.$final_amount.'" name="amount">
			  <input type="hidden" value="'.$site_currency.'" name="currency_code">
			  <input type="hidden" value="'.$success_url.'" name="return">
			  <input type="hidden" value="'.$cancel_url.'" name="cancel_return">
			  		  
			</form>';
			$paypal .= '<script>window.paypal_form.submit();</script>';
			echo $paypal;
		 
		  }
		  else if($payment_method == 'payhere')
		  {
		      if($site_currency != 'LKR')
			   {
		       $convert = Currency::convert($site_currency,'LKR',$final_amount);
			   $convertedAmount = $convert['convertedAmount'];
			   $price_amount = $convertedAmount * 100;
			   }
			   else
			   {
			   $price_amount = $final_amount * 100;
			   }
		      $payhere = '<form method="post" action="'.$payhere_url.'" id="payhere_form">   
							<input type="hidden" name="merchant_id" value="'.$payhere_merchant_id.'">
							<input type="hidden" name="return_url" value="'.$payhere_success_url.'">
							<input type="hidden" name="cancel_url" value="'.$cancel_url.'">
							<input type="hidden" name="notify_url" value="'.$cancel_url.'"> 
							<input type="hidden" name="order_id" value="'.$purchase_token.'">
							<input type="hidden" name="items" value="'.$item_names_data.'"><br>
							<input type="hidden" name="currency" value="LKR">
							<input type="hidden" name="amount" value="'.$price_amount.'">  
							
							<input type="hidden" name="first_name" value="'.$order_firstname.'">
							<input type="hidden" name="last_name" value="'.$order_lastname.'"><br>
							<input type="hidden" name="email" value="'.$order_email.'">
							<input type="hidden" name="phone" value="'.$order_zipcode.'"><br>
							<input type="hidden" name="address" value="'.$order_address.'">
							<input type="hidden" name="city" value="'.$order_city.'">
							<input type="hidden" name="country" value="'.$order_country.'">
							  
						</form>'; 
						$payhere .= '<script>window.payhere_form.submit();</script>';
			            echo $payhere;
		  }
		  else if($payment_method == 'twocheckout')
		  {
		    
			$record = array('final_amount' => $final_amount, 'purchase_token' => $purchase_token, 'payment_method' => $payment_method, 'item_names_data' => $item_names_data, 'site_currency' => $site_currency, 'website_url' => $website_url, 'two_checkout_private' => $two_checkout_private, 'two_checkout_account' => $two_checkout_account, 'two_checkout_mode' => $two_checkout_mode, 'token' => $token, 'two_checkout_publishable' => $two_checkout_publishable);
       return view('order-confirm')->with($record);
			
		  }
		  else if($payment_method == 'paystack')
		  {
		       if($site_currency != 'NGN')
			   {
		       $convert = Currency::convert($site_currency,'NGN',$final_amount);
			   $convertedAmount = $convert['convertedAmount'];
			   $price_amount = $convertedAmount * 100;
			   }
			   else
			   {
			    $price_amount = $final_amount * 100; 
			   }
		       $callback = $website_url.'/paystack';
			   $csf_token = csrf_token();
			   $paystack = '<form method="post" id="stack_form" action="'.route('paystack').'">
					  <input type="hidden" name="_token" value="'.$csf_token.'">
					  <input type="hidden" name="email" value="'.$user_email.'" >
					  <input type="hidden" name="order_id" value="'.$purchase_token.'">
					  <input type="hidden" name="amount" value="'.$price_amount.'">
					  <input type="hidden" name="quantity" value="1">
					  <input type="hidden" name="currency" value="NGN">
					  <input type="hidden" name="reference" value="'.$reference.'">
					  <input type="hidden" name="callback_url" value="'.$callback.'">
					  <input type="hidden" name="metadata" value="'.$purchase_token.'">
					  <input type="hidden" name="key" value="'.$setting['setting']->paystack_secret_key.'">
					</form>';
					$paystack .= '<script>window.stack_form.submit();</script>';
					echo $paystack;
			 
		  }
		  else if($payment_method == 'razorpay')
		  {
		       $additional['settings'] = Settings::editAdditional();
			   if($site_currency != 'INR')
			   {
		       $convert = Currency::convert($site_currency,'INR',$final_amount);
			   $convertedAmount = $convert['convertedAmount'];
			   $price_amount = $convertedAmount * 100;
			   }
			   else
			   {
			   $price_amount = $final_amount * 100;
			   }
			   $csf_token = csrf_token();
			   $logo_url = $website_url.'/public/storage/settings/'.$setting['setting']->site_logo;
			   $script_url = $website_url.'/resources/views/theme/js/vendor.min.js';
			   $callback = $website_url.'/razorpay';
			   $razorpay = '
			   <script type="text/javascript" src="'.$script_url.'"></script>
			   <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
			   <script>
				var options = {
					"key": "'.$razorpay_key.'",
					"amount": "'.$price_amount.'", 
					"currency": "INR",
					"name": "'.$item_names_data.'",
					"description": "'.$purchase_token.'",
					"image": "'.$logo_url.'",
					"callback_url": "'.$callback.'",
					"prefill": {
						"name": "'.$order_firstname.'",
						"email": "'.$order_email.'"
						
					},
					"notes": {
						"address": "'.$order_address.'"
						
						
					},
					"theme": {
						"color": "'.$setting['setting']->site_theme_color.'"
					}
				};
				var rzp1 = new Razorpay(options);
				rzp1.on("payment.failed", function (response){
						alert(response.error.code);
						alert(response.error.description);
						alert(response.error.source);
						alert(response.error.step);
						alert(response.error.reason);
						alert(response.error.metadata);
				});
				
				$(window).on("load", function() {
					 rzp1.open();
					e.preventDefault();
					});
				</script>';
				echo $razorpay;
					
					
		  }
		  else if($payment_method == 'localbank')
		  {
		    $bank_details = $setting['setting']->local_bank_details;
		    $bank_data = array('purchase_token' => $purchase_token, 'bank_details' => $bank_details);
	        return view('bank-details')->with($bank_data);
		  }
          /* stripe code */
		  else if($payment_method == 'stripe')
		  {
		     
			 			 
				$stripe = array(
					"secret_key"      => $stripe_secret_key,
					"publishable_key" => $stripe_publish_key
				);
			 
				\Stripe\Stripe::setApiKey($stripe['secret_key']);
			 
				
				$customer = \Stripe\Customer::create(array(
					'email' => $order_email,
					'source'  => $token
				));
			 
				
				$item_name = $item_names_data;
				$item_price = $amount * 100;
				$currency = $site_currency;
				$order_id = $purchase_token;
			 
				
				$charge = \Stripe\Charge::create(array(
					'customer' => $customer->id,
					'amount'   => $item_price,
					'currency' => $currency,
					'description' => $item_name,
					'metadata' => array(
						'order_id' => $order_id
					)
				));
			 
				
				$chargeResponse = $charge->jsonSerialize();
			 
				
				if($chargeResponse['paid'] == 1 && $chargeResponse['captured'] == 1) 
				{
			 
					
										
					$payment_token = $chargeResponse['balance_transaction'];
					$payment_status = 'completed';
					$purchased_token = $order_id;
					$orderdata = array('payment_token' => $payment_token, 'order_status' => $payment_status);
					$checkoutdata = array('payment_token' => $payment_token, 'payment_status' => $payment_status);
					Items::singleordupdateData($purchased_token,$orderdata);
					Items::singlecheckoutData($purchased_token,$checkoutdata);
					
					$token = $purchased_token;
					$check['display'] = Items::getcheckoutData($token);
					$order_id = $check['display']->order_ids;
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
						/* manual payment verification : OFF */
						if($setting['setting']->payment_verification == 0)
						{
						   
							  $ordered['data'] = Items::singleorderData($order);
							  $user_id = $ordered['data']->user_id;
							  $item_user_id = $ordered['data']->item_user_id;
							  $vendor_amount = $ordered['data']->vendor_amount;
							  $total_price = $ordered['data']->total_price;
							  $admin_amount = $ordered['data']->admin_amount;
							  
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
							  $admin_name = $setting['setting']->sender_name;
							  $admin_email = $setting['setting']->sender_email;
							  $currency = $setting['setting']->site_currency;
							  $check_email_support = Members::getuserSubscription($vendor['info']->id);
							  if($check_email_support == 1)
							  {
								  $record_data = array('to_name' => $to_name, 'to_email' => $to_email, 'vendor_amount' => $vendor_amount, 'currency' => $currency);
								  Mail::send('admin.vendor_payment_mail', $record_data , function($message) use ($admin_name, $admin_email, $to_name, $to_email) {
											$message->to($to_email, $to_name)
													->subject('New Payment Approved');
											$message->from($admin_email,$admin_name);
										});
							  }			
						 
						   
						}
						/* manual payment verification : OFF */
						
						
					  }
					/* referral per sale earning */
						$logged_id = Auth::user()->id;
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
					$data_record = array('payment_token' => $payment_token);
					return view('success')->with($data_record);
					
					
				}
		     
		  
		  }
		  /* stripe code */

		  
		  
	   }
	   return view('checkout')->with($totaldata);
	
	
	}
	
	
	public function razorpay_payment(Request $request)
    {
	    $sid = 1;
	    $setting['setting'] = Settings::editGeneral($sid);
		$additional['settings'] = Settings::editAdditional();
        $input = $request->all();

        $api = new Api($additional['settings']->razorpay_key, $additional['settings']->razorpay_secret);

        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        
        $user_id = Auth::user()->id;

        //dd($paymentDetails);
         //print_r($paymentDetails);
		if(count($input)  && !empty($input['razorpay_payment_id'])) 
		{
		
		 $payment_token = $input['razorpay_payment_id'];
		 $purchased_token = $payment->description;
		 $payment_status = 'completed';
		 $orderdata = array('payment_token' => $payment_token, 'order_status' => $payment_status);
		 $checkoutdata = array('payment_token' => $payment_token, 'payment_status' => $payment_status);
		 Items::singleordupdateData($purchased_token,$orderdata);
		 Items::singlecheckoutData($purchased_token,$checkoutdata);
		 $token = $purchased_token;
		 $check['display'] = Items::getcheckoutData($token);
		 $order_id = $check['display']->order_ids;
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
							/* subscription code */
							$additional['setting'] = Settings::editAdditional();
							$ordered['data'] = Items::singleorderData($order);
							$item_user_id = $ordered['data']->item_user_id;
							$vendor['info'] = Members::singlevendorData($item_user_id);
							$to_name = $vendor['info']->name;
							$to_email = $vendor['info']->email;
							$vendor_amount = $ordered['data']->vendor_amount;
							$admin_name = $setting['setting']->sender_name;
							$admin_email = $setting['setting']->sender_email;
							$currency = $setting['setting']->site_currency;
							$count_mode = Settings::checkuserSubscription($item_user_id);
							/* manual payment verification : OFF */
							if($additional['setting']->subscription_mode == 0)
							{
								if($setting['setting']->payment_verification == 0)
								{
								   
									  
									  $user_id = $ordered['data']->user_id;
									  
									  $total_price = $ordered['data']->total_price;
									  $admin_amount = $ordered['data']->admin_amount;
									  
									  
									  $user_token = $vendor['info']->user_token;
									  
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
								 
								}
								
								$record_data = array('to_name' => $to_name, 'to_email' => $to_email, 'vendor_amount' => $vendor_amount, 'currency' => $currency);
								Mail::send('admin.vendor_payment_mail', $record_data , function($message) use ($admin_name, $admin_email, $to_name, $to_email) {
													$message->to($to_email, $to_name)
															->subject('New Payment Approved');
													$message->from($admin_email,$admin_name);
												});
							}	
							else
							{
							   if($count_mode == 1)
							   {
								   
									  $orderdata = array('approval_status' => 'payment released to vendor');
									  Items::singleorderupData($order,$orderdata);
									  $check_email_support = Members::getuserSubscription($vendor['info']->id);
									  if($check_email_support == 1)
									  {
										  $record_data = array('to_name' => $to_name, 'to_email' => $to_email, 'vendor_amount' => $vendor_amount, 'currency' => $currency);
										  Mail::send('admin.vendor_payment_mail', $record_data , function($message) use ($admin_name, $admin_email, $to_name, $to_email) {
													$message->to($to_email, $to_name)
															->subject('New Payment Approved');
													$message->from($admin_email,$admin_name);
												});
									  }
							   }
							   else
							   {
								  
								  if($setting['setting']->payment_verification == 0)
								 {
									  $user_id = $ordered['data']->user_id;
									  
									  $total_price = $ordered['data']->total_price;
									  $admin_amount = $ordered['data']->admin_amount;
									  
									  
									  $user_token = $vendor['info']->user_token;
									  
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
									  
									  
									  $check_email_support = Members::getuserSubscription($vendor['info']->id);
									  if($check_email_support == 1)
									  {
										  $record_data = array('to_name' => $to_name, 'to_email' => $to_email, 'vendor_amount' => $vendor_amount, 'currency' => $currency);
										  Mail::send('admin.vendor_payment_mail', $record_data , function($message) use ($admin_name, $admin_email, $to_name, $to_email) {
													$message->to($to_email, $to_name)
															->subject('New Payment Approved');
													$message->from($admin_email,$admin_name);
												});
									  }
								 
								  }
								  
								  
							   }
							   
							   
							}	
							/* manual payment verification : OFF */
							/* subscription code */

		                											
		}
		/* referral per sale earning */
		$logged_id = Auth::user()->id;
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
		$data_record = array('payment_token' => $payment_token);
		return view('success')->with($data_record);
		
		
	    } 
		else
		{
		  return redirect('/cancel');
		}
		
        
    }
	
	
	public function redirectToGateway()
    {
        return Paystack::getAuthorizationUrl()->redirectNow();
    }
	
	public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();
		$sid = 1;
	    $setting['setting'] = Settings::editGeneral($sid);

        //dd($paymentDetails);
         //print_r($paymentDetails);
		if (array_key_exists('data', $paymentDetails) && array_key_exists('status', $paymentDetails['data']) && ($paymentDetails['data']['status'] === 'success')) 
		{
		 // echo "Transaction was successful - ".$paymentDetails['data']['reference']. ' - '.$paymentDetails['data']['metadata'];
		 
		 $payment_token = $paymentDetails['data']['reference'];
		 $purchase_token = $paymentDetails['data']['metadata'];
		 $payment_status = 'completed';
		 $purchased_token = $purchase_token;
		 $orderdata = array('payment_token' => $payment_token, 'order_status' => $payment_status);
		 $checkoutdata = array('payment_token' => $payment_token, 'payment_status' => $payment_status);
		 Items::singleordupdateData($purchased_token,$orderdata);
		 Items::singlecheckoutData($purchased_token,$checkoutdata);
		 $token = $purchased_token;
		 $check['display'] = Items::getcheckoutData($token);
		 $order_id = $check['display']->order_ids;
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
		                /* manual payment verification : OFF */
						if($setting['setting']->payment_verification == 0)
						{
						   
							  $ordered['data'] = Items::singleorderData($order);
							  $user_id = $ordered['data']->user_id;
							  $item_user_id = $ordered['data']->item_user_id;
							  $vendor_amount = $ordered['data']->vendor_amount;
							  $total_price = $ordered['data']->total_price;
							  $admin_amount = $ordered['data']->admin_amount;
							  
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
							  $admin_name = $setting['setting']->sender_name;
							  $admin_email = $setting['setting']->sender_email;
							  $currency = $setting['setting']->site_currency;
							  $check_email_support = Members::getuserSubscription($vendor['info']->id);
							  if($check_email_support == 1)
							  {
								  $record_data = array('to_name' => $to_name, 'to_email' => $to_email, 'vendor_amount' => $vendor_amount, 'currency' => $currency);
								  Mail::send('admin.vendor_payment_mail', $record_data , function($message) use ($admin_name, $admin_email, $to_name, $to_email) {
											$message->to($to_email, $to_name)
													->subject('New Payment Approved');
											$message->from($admin_email,$admin_name);
										});
							  }			
						 
						   
						}
						/* manual payment verification : OFF */
											
		}
		/* referral per sale earning */
		$logged_id = Auth::user()->id;
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
		$data_record = array('payment_token' => $payment_token);
		return view('success')->with($data_record);
						
			
		}
		else
		{
		  return redirect('/cancel');
		}
		
    }
	
	
	public function view_success()
	{
	  return view('success');
	}
	
	public function paypal_success($ord_token, Request $request)
	{
	$sid = 1;
	$setting['setting'] = Settings::editGeneral($sid);
	$payment_token = $request->input('tx');
	$payment_status = 'completed';
	$purchased_token = $ord_token;
	$orderdata = array('payment_token' => $payment_token, 'order_status' => $payment_status);
	$checkoutdata = array('payment_token' => $payment_token, 'payment_status' => $payment_status);
	Items::singleordupdateData($purchased_token,$orderdata);
	Items::singlecheckoutData($purchased_token,$checkoutdata);
	
	$token = $purchased_token;
	$check['display'] = Items::getcheckoutData($token);
	$order_id = $check['display']->order_ids;
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
		/* subscription code */
		$additional['setting'] = Settings::editAdditional();
		$ordered['data'] = Items::singleorderData($order);
		$item_user_id = $ordered['data']->item_user_id;
		$vendor['info'] = Members::singlevendorData($item_user_id);
		$to_name = $vendor['info']->name;
		$to_email = $vendor['info']->email;
		$vendor_amount = $ordered['data']->vendor_amount;
		$admin_name = $setting['setting']->sender_name;
		$admin_email = $setting['setting']->sender_email;
		$currency = $setting['setting']->site_currency;
		$count_mode = Settings::checkuserSubscription($item_user_id);
		/* manual payment verification : OFF */
		if($additional['setting']->subscription_mode == 0)
		{
			if($setting['setting']->payment_verification == 0)
			{
			   
				  
				  $user_id = $ordered['data']->user_id;
				  
				  $total_price = $ordered['data']->total_price;
				  $admin_amount = $ordered['data']->admin_amount;
				  
				  
				  $user_token = $vendor['info']->user_token;
				  
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
			 
			}
			
			$record_data = array('to_name' => $to_name, 'to_email' => $to_email, 'vendor_amount' => $vendor_amount, 'currency' => $currency);
			Mail::send('admin.vendor_payment_mail', $record_data , function($message) use ($admin_name, $admin_email, $to_name, $to_email) {
								$message->to($to_email, $to_name)
										->subject('New Payment Approved');
								$message->from($admin_email,$admin_name);
							});
		}	
		else
		{
		   if($count_mode == 1)
		   {
		       
			      $orderdata = array('approval_status' => 'payment released to vendor');
				  Items::singleorderupData($order,$orderdata);
				  $check_email_support = Members::getuserSubscription($vendor['info']->id);
				  if($check_email_support == 1)
				  {
					  $record_data = array('to_name' => $to_name, 'to_email' => $to_email, 'vendor_amount' => $vendor_amount, 'currency' => $currency);
					  Mail::send('admin.vendor_payment_mail', $record_data , function($message) use ($admin_name, $admin_email, $to_name, $to_email) {
								$message->to($to_email, $to_name)
										->subject('New Payment Approved');
								$message->from($admin_email,$admin_name);
							});
				  }
		   }
		   else
		   {
		      
			  if($setting['setting']->payment_verification == 0)
			 {
			      $user_id = $ordered['data']->user_id;
				  
				  $total_price = $ordered['data']->total_price;
				  $admin_amount = $ordered['data']->admin_amount;
				  
				  
				  $user_token = $vendor['info']->user_token;
				  
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
				  
				  
				  $check_email_support = Members::getuserSubscription($vendor['info']->id);
				  if($check_email_support == 1)
				  {
					  $record_data = array('to_name' => $to_name, 'to_email' => $to_email, 'vendor_amount' => $vendor_amount, 'currency' => $currency);
					  Mail::send('admin.vendor_payment_mail', $record_data , function($message) use ($admin_name, $admin_email, $to_name, $to_email) {
								$message->to($to_email, $to_name)
										->subject('New Payment Approved');
								$message->from($admin_email,$admin_name);
							});
				  }
			 
			  }
			  
		      
		   }
		   
		   
		}	
		/* manual payment verification : OFF */
		/* subscription code */
		
		
		
	}
	
	/* referral per sale earning */
	    $logged_id = Auth::user()->id;
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
	$result_data = array('payment_token' => $payment_token);
	return view('success')->with($result_data);
	
	}
	
	
	
	
	public function payu_success(Request $request)
	{
	$sid = 1;
	$setting['setting'] = Settings::editGeneral($sid);
	$payment_token = $request->input('txnid');
	$payment_status = 'completed';
	$purchased_token = $request->input('udf1');
	$orderdata = array('payment_token' => $payment_token, 'order_status' => $payment_status);
	$checkoutdata = array('payment_token' => $payment_token, 'payment_status' => $payment_status);
	Items::singleordupdateData($purchased_token,$orderdata);
	Items::singlecheckoutData($purchased_token,$checkoutdata);
	
	$token = $purchased_token;
	$check['display'] = Items::getcheckoutData($token);
	$order_id = $check['display']->order_ids;
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
		/* subscription code */
		$additional['setting'] = Settings::editAdditional();
		$ordered['data'] = Items::singleorderData($order);
		$item_user_id = $ordered['data']->item_user_id;
		$vendor['info'] = Members::singlevendorData($item_user_id);
		$to_name = $vendor['info']->name;
		$to_email = $vendor['info']->email;
		$vendor_amount = $ordered['data']->vendor_amount;
		$admin_name = $setting['setting']->sender_name;
		$admin_email = $setting['setting']->sender_email;
		$currency = $setting['setting']->site_currency;
		$count_mode = Settings::checkuserSubscription($item_user_id);
		/* manual payment verification : OFF */
		if($additional['setting']->subscription_mode == 0)
		{
			if($setting['setting']->payment_verification == 0)
			{
			   
				  
				  $user_id = $ordered['data']->user_id;
				  
				  $total_price = $ordered['data']->total_price;
				  $admin_amount = $ordered['data']->admin_amount;
				  
				  
				  $user_token = $vendor['info']->user_token;
				  
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
			 
			}
			
			$record_data = array('to_name' => $to_name, 'to_email' => $to_email, 'vendor_amount' => $vendor_amount, 'currency' => $currency);
			Mail::send('admin.vendor_payment_mail', $record_data , function($message) use ($admin_name, $admin_email, $to_name, $to_email) {
								$message->to($to_email, $to_name)
										->subject('New Payment Approved');
								$message->from($admin_email,$admin_name);
							});
		}	
		else
		{
		   if($count_mode == 1)
		   {
		       
			      $orderdata = array('approval_status' => 'payment released to vendor');
				  Items::singleorderupData($order,$orderdata);
				  $check_email_support = Members::getuserSubscription($vendor['info']->id);
				  if($check_email_support == 1)
				  {
					  $record_data = array('to_name' => $to_name, 'to_email' => $to_email, 'vendor_amount' => $vendor_amount, 'currency' => $currency);
					  Mail::send('admin.vendor_payment_mail', $record_data , function($message) use ($admin_name, $admin_email, $to_name, $to_email) {
								$message->to($to_email, $to_name)
										->subject('New Payment Approved');
								$message->from($admin_email,$admin_name);
							});
				  }
		   }
		   else
		   {
		      
			  if($setting['setting']->payment_verification == 0)
			 {
			      $user_id = $ordered['data']->user_id;
				  
				  $total_price = $ordered['data']->total_price;
				  $admin_amount = $ordered['data']->admin_amount;
				  
				  
				  $user_token = $vendor['info']->user_token;
				  
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
				  
				  
				  $check_email_support = Members::getuserSubscription($vendor['info']->id);
				  if($check_email_support == 1)
				  {
					  $record_data = array('to_name' => $to_name, 'to_email' => $to_email, 'vendor_amount' => $vendor_amount, 'currency' => $currency);
					  Mail::send('admin.vendor_payment_mail', $record_data , function($message) use ($admin_name, $admin_email, $to_name, $to_email) {
								$message->to($to_email, $to_name)
										->subject('New Payment Approved');
								$message->from($admin_email,$admin_name);
							});
				  }
			 
			  }
			  
		      
		   }
		   
		   
		}	
		/* manual payment verification : OFF */
		/* subscription code */
		
		
		
	}
	
	/* referral per sale earning */
	    $logged_id = Auth::user()->id;
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
	$result_data = array('payment_token' => $payment_token);
	return view('success')->with($result_data);
	
	}
	
	
	
	
	public function payhere_success($ord_token, Request $request)
	{
	$sid = 1;
	$setting['setting'] = Settings::editGeneral($sid);
	
	$payment_status = 'completed';
	$purchased_token = $ord_token;
	$orderdata = array( 'order_status' => $payment_status);
	$checkoutdata = array( 'payment_status' => $payment_status);
	Items::singleordupdateData($purchased_token,$orderdata);
	Items::singlecheckoutData($purchased_token,$checkoutdata);
	
	$token = $purchased_token;
	$check['display'] = Items::getcheckoutData($token);
	$order_id = $check['display']->order_ids;
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
		/* subscription code */
		$additional['setting'] = Settings::editAdditional();
		$ordered['data'] = Items::singleorderData($order);
		$item_user_id = $ordered['data']->item_user_id;
		$vendor['info'] = Members::singlevendorData($item_user_id);
		$to_name = $vendor['info']->name;
		$to_email = $vendor['info']->email;
		$vendor_amount = $ordered['data']->vendor_amount;
		$admin_name = $setting['setting']->sender_name;
		$admin_email = $setting['setting']->sender_email;
		$currency = $setting['setting']->site_currency;
		$count_mode = Settings::checkuserSubscription($item_user_id);
		/* manual payment verification : OFF */
		if($additional['setting']->subscription_mode == 0)
		{
			if($setting['setting']->payment_verification == 0)
			{
			   
				  
				  $user_id = $ordered['data']->user_id;
				  
				  $total_price = $ordered['data']->total_price;
				  $admin_amount = $ordered['data']->admin_amount;
				  
				  
				  $user_token = $vendor['info']->user_token;
				  
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
			 
			}
			
			$record_data = array('to_name' => $to_name, 'to_email' => $to_email, 'vendor_amount' => $vendor_amount, 'currency' => $currency);
			Mail::send('admin.vendor_payment_mail', $record_data , function($message) use ($admin_name, $admin_email, $to_name, $to_email) {
								$message->to($to_email, $to_name)
										->subject('New Payment Approved');
								$message->from($admin_email,$admin_name);
							});
		}	
		else
		{
		   if($count_mode == 1)
		   {
		       
			      $orderdata = array('approval_status' => 'payment released to vendor');
				  Items::singleorderupData($order,$orderdata);
				  $check_email_support = Members::getuserSubscription($vendor['info']->id);
				  if($check_email_support == 1)
				  {
					  $record_data = array('to_name' => $to_name, 'to_email' => $to_email, 'vendor_amount' => $vendor_amount, 'currency' => $currency);
					  Mail::send('admin.vendor_payment_mail', $record_data , function($message) use ($admin_name, $admin_email, $to_name, $to_email) {
								$message->to($to_email, $to_name)
										->subject('New Payment Approved');
								$message->from($admin_email,$admin_name);
							});
				  }
		   }
		   else
		   {
		      
			  if($setting['setting']->payment_verification == 0)
			 {
			      $user_id = $ordered['data']->user_id;
				  
				  $total_price = $ordered['data']->total_price;
				  $admin_amount = $ordered['data']->admin_amount;
				  
				  
				  $user_token = $vendor['info']->user_token;
				  
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
				  
				  
				  $check_email_support = Members::getuserSubscription($vendor['info']->id);
				  if($check_email_support == 1)
				  {
					  $record_data = array('to_name' => $to_name, 'to_email' => $to_email, 'vendor_amount' => $vendor_amount, 'currency' => $currency);
					  Mail::send('admin.vendor_payment_mail', $record_data , function($message) use ($admin_name, $admin_email, $to_name, $to_email) {
								$message->to($to_email, $to_name)
										->subject('New Payment Approved');
								$message->from($admin_email,$admin_name);
							});
				  }
			 
			  }
			  
		      
		   }
		   
		   
		}	
		/* manual payment verification : OFF */
		/* subscription code */
		
		
		
	}
	
	/* referral per sale earning */
	    $logged_id = Auth::user()->id;
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
	$payment_token = "";	
	$result_data = array('payment_token' => $payment_token);
	return view('success')->with($result_data);
	
	}
	
	/* checkout */
	
	
	/* purchases */
	
	public function view_purchases()
	{
	  $orderData['item'] = Items::getuserOrders();
	  $order['purchase'] = Items::getpurchaseCheckout();
	  
	  $purchase_sale = 0;
	  foreach($order['purchase'] as $item)
	  {
	    $purchase_sale += $item->total;
	  }
	  	  
	  $drawal['view'] = Items::getdrawalView();
	  $drawal_amount = 0;
	  foreach($drawal['view'] as $drawal)
	  {
	    $drawal_amount += $drawal->wd_amount;
	  }
	  return view('purchases',[ 'orderData' => $orderData, 'purchase_sale' => $purchase_sale, 'drawal_amount' => $drawal_amount]); 
	 
	}
	
	
	
	public function purchases_download($token)
	{
	    $allsettings = Settings::allSettings();
		$logged_id = Auth::user()->id;
		$check_sold = Items::checkSold($token,$logged_id);
		if($check_sold != 0)
		{
			$item['data'] = Items::solditemData($token);
			if($item['data']->file_type == 'file')
			{
				if($allsettings->site_s3_storage == 1)
				{
				$myFile = Storage::disk('s3')->url($item['data']->item_file);
				$newName = uniqid().time().'.zip';
				header("Cache-Control: public");
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=" . basename($newName));
				header("Content-Type: application/octet-stream");
				return readfile($myFile);
				}			
				else
				{
				$filename = public_path().'/storage/items/'.$item['data']->item_file;
				$headers = ['Content-Type: application/octet-stream'];
				$new_name = uniqid().time().'.zip';
				return response()->download($filename,$new_name,$headers);
				}
			}
			else
			{
			   return redirect($item['data']->item_file_link);
			}
		}
		else
		{
		return redirect('404');
		}
		
	}
	
	
	public function rating_purchases(Request $request)
	{
	  $item_id = $request->input('item_id');
	  $item_token = $request->input('item_token');
	  $user_id = $request->input('user_id');
	  $item_user_id = $request->input('item_user_id');
	  $rating = $request->input('rating');
	  $ord_id = $request->input('ord_id');
	  $rating_reason = $request->input('rating_reason');
	  $item_url = $request->input('item_url');
	  $rating_date = date('Y-m-d H:i:s');
	  
	  $rating_comment = $request->input('rating_comment');
	  $rating_count = Items::checkRating($item_token,$user_id);
	  
	  $savedata = array('or_item_id' => $item_id, 'order_id' => $ord_id, 'or_item_token' => $item_token, 'or_user_id' => $user_id, 'or_item_user_id' => $item_user_id, 'rating' => $rating, 'rating_reason' => $rating_reason, 'rating_comment' => $rating_comment, 'rating_date' => $rating_date); 
	  
	  $updata = array('rating' => $rating, 'rating_reason' => $rating_reason, 'rating_comment' => $rating_comment, 'rating_date' => $rating_date); 
	  
	  if($rating_count == 0)
	  {
	  
	    Items::saveRating($savedata);
		$userto['data'] = Members::singlevendorData($item_user_id);
		$userfrom['data'] = Members::singlebuyerData($user_id);
		$to_email = $userto['data']->email;
		$to_name  = $userto['data']->name;
		$buyer_review = $userto['data']->buyer_review_email;
		if($buyer_review == 1)
		{
		  $from_email = $userfrom['data']->email;
		  $from_name = $userfrom['data']->name;
		  $sid = 1;
		  $setting['setting'] = Settings::editGeneral($sid);
		  $admin_name = $setting['setting']->sender_name;
		  $admin_email = $setting['setting']->sender_email;
		  $check_email_support = Members::getuserSubscription($item_user_id);
		  if($check_email_support == 1)
		  {
			  $record = array('to_name' => $to_name, 'from_name' => $from_name, 'from_email' => $from_email, 'item_url' => $item_url, 'rating' => $rating, 'rating_reason' => $rating_reason, 'rating_comment' => $rating_comment);
			  Mail::send('rating_mail', $record, function($message) use ($admin_name, $admin_email, $to_email, $from_email, $to_name, $from_name) {
					$message->to($to_email, $to_name)
							->subject('Item Rating Received');
					$message->from($from_email,$from_name);
				});
		   }		
		
	    }
		
		
		 
	  }
	  else
	  {
	     Items::updateRating($item_token,$user_id,$updata);
	  }
	  
	  return redirect('purchases')->with('success','Rating has been updated');
	
	}
	
	/* purchases */
	
	
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
	  
	  $credit['order'] = Items::getcreditOrder();
	  
	  $credit_amount = 0;
	  foreach($credit['order'] as $order)
	  {
	    $credit_amount += $order->vendor_amount;
	  }
	  
	  
	  $drawal['view'] = Items::getdrawalView();
	  $drawal_amount = 0;
	  foreach($drawal['view'] as $drawal)
	  {
	    $drawal_amount += $drawal->wd_amount;
	  }
	  
	  return view('sales',[ 'orderData' => $orderData, 'total_sale' => $total_sale, 'purchase_sale' => $purchase_sale, 'credit_amount' => $credit_amount, 'drawal_amount' => $drawal_amount]); 
	 
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
	  $purchased_token = $request->input('purchased_token');
	  $user_id = $request->input('user_id');
	  $item_user_id = $request->input('item_user_id');
	  $ord_id = $request->input('ord_id');
	  $ref_refund_reason = $request->input('refund_reason');
	  $ref_refund_comment = $request->input('refund_comment');
	  $item_url = $request->input('item_url');
	  $refund_count = Items::checkRefund($item_token,$user_id);
	  
	  $savedata = array('ref_item_id' => $item_id, 'ref_order_id' => $ord_id, 'ref_item_token' => $item_token, 'ref_purchased_token' => $purchased_token,  'ref_user_id' => $user_id, 'ref_item_user_id' => $item_user_id, 'ref_refund_reason' => $ref_refund_reason, 'ref_refund_comment' => $ref_refund_comment); 
	  
	  
	  
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
