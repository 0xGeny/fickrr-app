<?php

namespace Fickrr\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rule;
use Fickrr\Models\Members;
use Fickrr\Models\Subscription;
use Fickrr\Models\Settings;
use Auth;
use Currency;
use Razorpay\Api\Api;
use Paystack;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
	 
	use AuthenticatesUsers; 
	 
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* subscription */
	
	public function upgrade_subscription($id)
	{
	   $subscr_id = base64_decode($id);
	   $subscr['view'] = Subscription::getSubscription($subscr_id);
	   $sid = 1;
	  $setting['setting'] = Settings::editGeneral($sid);
	  $get_payment = explode(',', $setting['setting']->payment_option);
	   return view('confirm-subscription', ['subscr' => $subscr, 'get_payment' => $get_payment]);
	}
	
	public function paypal_success($ord_token, Request $request)
	{
	
	$payment_token = $request->input('tx');
	$purchased_token = $ord_token;
	$subscr_id = Auth::user()->user_subscr_id;
	$subscr['view'] = Subscription::editsubData($subscr_id);
	$subscri_date = $subscr['view']->subscr_duration;
	$user_subscr_item_level = $subscr['view']->subscr_item_level;
	$user_subscr_item = $subscr['view']->subscr_item;
	$user_subscr_space_level = $subscr['view']->subscr_space_level;
	$user_subscr_space = $subscr['view']->subscr_space;
	$user_subscr_space_type = $subscr['view']->subscr_space_type;
	$user_subscr_type = $subscr['view']->subscr_name;
	$subscr_value = "+".$subscri_date;
	$subscr_date = date('Y-m-d', strtotime($subscr_value));
	$user_id = Auth::user()->id;
	$checkoutdata = array('user_subscr_type' => $user_subscr_type, 'user_subscr_date' => $subscr_date, 'user_subscr_item_level' => $user_subscr_item_level, 'user_subscr_item' => $user_subscr_item, 'user_subscr_space_level' => $user_subscr_space_level, 'user_subscr_space' => $user_subscr_space, 'user_subscr_space_type' => $user_subscr_space_type);
	Subscription::confirmsubscriData($user_id,$checkoutdata);
	$result_data = array('payment_token' => $payment_token);
	return view('success')->with($result_data);
	
	}
	
	
	
	
	
	public function payhere_success($ord_token, Request $request)
	{
	
	$payment_token = "";
	$purchased_token = $ord_token;
	$subscr_id = Auth::user()->user_subscr_id;
	$subscr['view'] = Subscription::editsubData($subscr_id);
	$subscri_date = $subscr['view']->subscr_duration;
	$user_subscr_item_level = $subscr['view']->subscr_item_level;
	$user_subscr_item = $subscr['view']->subscr_item;
	$user_subscr_space_level = $subscr['view']->subscr_space_level;
	$user_subscr_space = $subscr['view']->subscr_space;
	$user_subscr_space_type = $subscr['view']->subscr_space_type;
	$user_subscr_type = $subscr['view']->subscr_name;
	$subscr_value = "+".$subscri_date;
	$subscr_date = date('Y-m-d', strtotime($subscr_value));
	$user_id = Auth::user()->id;
	$checkoutdata = array('user_subscr_type' => $user_subscr_type, 'user_subscr_date' => $subscr_date, 'user_subscr_item_level' => $user_subscr_item_level, 'user_subscr_item' => $user_subscr_item, 'user_subscr_space_level' => $user_subscr_space_level, 'user_subscr_space' => $user_subscr_space, 'user_subscr_space_type' => $user_subscr_space_type);
	Subscription::confirmsubscriData($user_id,$checkoutdata);
	$result_data = array('payment_token' => $payment_token);
	return view('success')->with($result_data);
	
	}
	
	
	
	public function payu_success(Request $request)
	{
	
	$payment_token = $request->input('txnid');
	$purchased_token = $request->input('udf1');
	$subscr_id = Auth::user()->user_subscr_id;
	$subscr['view'] = Subscription::editsubData($subscr_id);
	$subscri_date = $subscr['view']->subscr_duration;
	$user_subscr_item_level = $subscr['view']->subscr_item_level;
	$user_subscr_item = $subscr['view']->subscr_item;
	$user_subscr_space_level = $subscr['view']->subscr_space_level;
	$user_subscr_space = $subscr['view']->subscr_space;
	$user_subscr_space_type = $subscr['view']->subscr_space_type;
	$user_subscr_type = $subscr['view']->subscr_name;
	$subscr_value = "+".$subscri_date;
	$subscr_date = date('Y-m-d', strtotime($subscr_value));
	$user_id = Auth::user()->id;
	$checkoutdata = array('user_subscr_type' => $user_subscr_type, 'user_subscr_date' => $subscr_date, 'user_subscr_item_level' => $user_subscr_item_level, 'user_subscr_item' => $user_subscr_item, 'user_subscr_space_level' => $user_subscr_space_level, 'user_subscr_space' => $user_subscr_space, 'user_subscr_space_type' => $user_subscr_space_type);
	Subscription::confirmsubscriData($user_id,$checkoutdata);
	$result_data = array('payment_token' => $payment_token);
	return view('success')->with($result_data);
	
	}
	
	
	
	public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();
		$sid = 1;
	    $setting['setting'] = Settings::editGeneral($sid);

        
		if (array_key_exists('data', $paymentDetails) && array_key_exists('status', $paymentDetails['data']) && ($paymentDetails['data']['status'] === 'success')) 
		{
		 
		$payment_token = $paymentDetails['data']['reference'];
		$purchased_token = $paymentDetails['data']['metadata'];
		$subscr_id = Auth::user()->user_subscr_id;
		$subscr['view'] = Subscription::editsubData($subscr_id);
		$subscri_date = $subscr['view']->subscr_duration;
		$user_subscr_item_level = $subscr['view']->subscr_item_level;
		$user_subscr_item = $subscr['view']->subscr_item;
		$user_subscr_space_level = $subscr['view']->subscr_space_level;
		$user_subscr_space = $subscr['view']->subscr_space;
		$user_subscr_space_type = $subscr['view']->subscr_space_type;
		$user_subscr_type = $subscr['view']->subscr_name;
		$subscr_value = "+".$subscri_date;
		$subscr_date = date('Y-m-d', strtotime($subscr_value));
		$user_id = Auth::user()->id;
		$checkoutdata = array('user_subscr_type' => $user_subscr_type, 'user_subscr_date' => $subscr_date, 'user_subscr_item_level' => $user_subscr_item_level, 'user_subscr_item' => $user_subscr_item, 'user_subscr_space_level' => $user_subscr_space_level, 'user_subscr_space' => $user_subscr_space, 'user_subscr_space_type' => $user_subscr_space_type);
		Subscription::confirmsubscriData($user_id,$checkoutdata);
		$result_data = array('payment_token' => $payment_token);
		return view('success')->with($result_data);
		 
			
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
	
	public function update_subscription(Request $request)
	{
	   
	   
	
	   $user_subscr_id = $request->input('user_subscr_id');
	   $subscription_details = Subscription::editsubData($user_subscr_id);
	   $token = $request->input('token');
	   $price = $subscription_details->subscr_price;
	   $user_id = Auth::user()->id;
	   $user_name = Auth::user()->name;
	   $order_email = Auth::user()->email;
	   $purchase_token = rand(111111,999999);
	   $payment_method = $request->input('payment_method');
	   $user_subscr_type = $request->input('user_subscr_type');
	   $user_subscr_date = $request->input('user_subscr_date');
	   $user_subscr_item_level = $request->input('user_subscr_item_level');
	   $user_subscr_item = $request->input('user_subscr_item');
	   $user_subscr_space_level = $request->input('user_subscr_space_level');
	   $user_subscr_space = $request->input('user_subscr_space');
	   $user_subscr_space_type = $request->input('user_subscr_space_type');
	   $website_url = $request->input('website_url');
	   $subscr_value = "+".$user_subscr_date;
	   $subscr_date = date('Y-m-d', strtotime($subscr_value));
	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   $bank_details = $setting['setting']->local_bank_details;
	   $admin_amount = $price;
	   
	   if($payment_method == 'localbank')
	   {
	   $updatedata = array('user_subscr_price' => $price, 'user_subscr_id' => $user_subscr_id, 'user_purchase_token' => $purchase_token);
	   }
	   else
	   {
	   $updatedata = array('user_subscr_price' => $price, 'user_subscr_id' => $user_subscr_id);
	   }
	   
	   /* settings */
	   
	   $paypal_email = $setting['setting']->paypal_email;
	   $paypal_mode = $setting['setting']->paypal_mode;
	   $site_currency = $setting['setting']->site_currency;
	   if($paypal_mode == 1)
	   {
	     $paypal_url = "https://www.paypal.com/cgi-bin/webscr";
	   }
	   else
	   {
	     $paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
	   }
	   $success_url = $website_url.'/subscription-success/'.$purchase_token;
	   $cancel_url = $website_url.'/cancel';
	   
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
	   
	   $payhere_success_url = $website_url.'/subscription-payhere/'.$purchase_token;
	   
	   /* settings */
	   Subscription::upsubscribeData($user_id,$updatedata);
	   if($payment_method == 'paypal')
		  {
		     
			 $paypal = '<form method="post" id="paypal_form" action="'.$paypal_url.'">
			  <input type="hidden" value="_xclick" name="cmd">
			  <input type="hidden" value="'.$paypal_email.'" name="business">
			  <input type="hidden" value="'.$user_subscr_type.'" name="item_name">
			  <input type="hidden" value="'.$purchase_token.'" name="item_number">
			  <input type="hidden" value="'.$price.'" name="amount">
			  <input type="hidden" value="'.$site_currency.'" name="currency_code">
			  <input type="hidden" value="'.$success_url.'" name="return">
			  <input type="hidden" value="'.$cancel_url.'" name="cancel_return">
			  		  
			</form>';
			$paypal .= '<script>window.paypal_form.submit();</script>';
			echo $paypal;
					 
			 
		  }
		  else if($payment_method == 'payumoney')
		  {
		     $additional['settings'] = Settings::editAdditional();
			 $MERCHANT_KEY = $additional['settings']->payu_merchant_key; // add your id
					$SALT = $additional['settings']->payu_salt_key; // add your id
					if($additional['settings']->payumoney_mode == 1)
					{
					$PAYU_BASE_URL = "https://secure.payu.in";
					}
					else
					{
					$PAYU_BASE_URL = "https://test.payu.in";
					}
				if($site_currency != 'INR')
			   {
		       $convert = Currency::convert($site_currency,'INR',$price);
			   $convertedAmount = $convert['convertedAmount'];
			   $price_amount = $convertedAmount;
			   }
			   else
			   {
			   $price_amount = $price;
			   }
			   $action = '';
				$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
				$posted = array();
				$posted = array(
					'key' => $MERCHANT_KEY,
					'txnid' => $txnid,
					'amount' => $price_amount,
					'udf1' => $purchase_token,
					'firstname' => $user_name,
					'email' => $order_email,
					'productinfo' => $user_subscr_type,
					'surl' => $website_url.'/payu_subscription',
					'furl' => $website_url.'/cancel',
					'service_provider' => 'payu_paisa',
				);
				$payu_success = $website_url.'/payu_subscription';
				
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
            <input type="hidden" name="firstname" id="firstname" value="'.$user_name.'" />
            <input type="hidden" name="email" id="email" value="'.$order_email.'" />
            <input type="hidden" name="productinfo" value="'.$user_subscr_type.'">
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
		     $additional['settings'] = Settings::editAdditional();
		     $payhere_mode = $additional['settings']->payhere_mode;
			 if($payhere_mode == 1)
			 {
				$payhere_url = 'https://www.payhere.lk/pay/checkout';
			 }
			 else
			 {
				$payhere_url = 'https://sandbox.payhere.lk/pay/checkout';
			 }
			 $payhere_merchant_id = $additional['settings']->payhere_merchant_id;
			 if($site_currency != 'LKR')
			   {
		       $convert = Currency::convert($site_currency,'LKR',$price);
			   $convertedAmount = $convert['convertedAmount'];
			   $price_amount = $convertedAmount;
			   }
			   else
			   {
			   $price_amount = $price;
			   }
		      $payhere = '<form method="post" action="'.$payhere_url.'" id="payhere_form">   
							<input type="hidden" name="merchant_id" value="'.$payhere_merchant_id.'">
							<input type="hidden" name="return_url" value="'.$payhere_success_url.'">
							<input type="hidden" name="cancel_url" value="'.$cancel_url.'">
							<input type="hidden" name="notify_url" value="'.$cancel_url.'">  
							<input type="hidden" name="order_id" value="'.$purchase_token.'">
							<input type="hidden" name="items" value="'.$user_subscr_type.'"><br>
							<input type="hidden" name="currency" value="LKR">
							<input type="hidden" name="amount" value="'.$price_amount.'">  
							
							<input type="hidden" name="first_name" value="'.$user_name.'">
							<input type="hidden" name="last_name" value="'.$user_name.'"><br>
							<input type="hidden" name="email" value="'.$order_email.'">
							<input type="hidden" name="phone" value="'.$order_email.'"><br>
							<input type="hidden" name="address" value="'.$user_subscr_type.'">
							<input type="hidden" name="city" value="'.$user_name.'">
							<input type="hidden" name="country" value="'.$user_name.'">
							  
						</form>'; 
						$payhere .= '<script>window.payhere_form.submit();</script>';
			            echo $payhere;
		  
		  }
		 else if($payment_method == 'razorpay')
		  {
		       $additional['settings'] = Settings::editAdditional();
		       $convert = Currency::convert($site_currency,'INR',$price);
			   $convertedAmount = $convert['convertedAmount'];
			   $csf_token = csrf_token();
			   $price_amount = $convertedAmount * 100;
			   $logo_url = $website_url.'/public/storage/settings/'.$setting['setting']->site_logo;
			   $script_url = $website_url.'/resources/views/theme/js/vendor.min.js';
			   $callback = $website_url.'/subscription-razorpay';
			   $razorpay = '
			   <script type="text/javascript" src="'.$script_url.'"></script>
			   <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
			   <script>
				var options = {
					"key": "'.$additional['settings']->razorpay_key.'",
					"amount": "'.$price_amount.'", 
					"currency": "INR",
					"name": "'.$user_subscr_type.'",
					"description": "'.$purchase_token.'",
					"image": "'.$logo_url.'",
					"callback_url": "'.$callback.'",
					"prefill": {
						"name": "'.$user_name.'",
						"email": "'.$order_email.'"
						
					},
					"notes": {
						"address": "'.$user_subscr_type.'"
						
						
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
		   
		 else if($payment_method == 'paystack')
		  {
		       $convert = Currency::convert($site_currency,'NGN',$price);
			   $convertedAmount = $convert['convertedAmount'];
		       $callback = $website_url.'/subscription-paystack';
			   $csf_token = csrf_token();
			   $price_amount = $convertedAmount * 100;
			   $reference = $request->input('reference');
			   $paystack = '<form method="post" id="stack_form" action="'.route('paystack').'">
					  <input type="hidden" name="_token" value="'.$csf_token.'">
					  <input type="hidden" name="email" value="'.$order_email.'" >
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
		 
		 /* wallet */
		 if($payment_method == 'wallet')
		 {
		    if(Auth::user()->earnings >= $price)
			{
			        $user_token = Auth::user()->user_token;
			        $earn_wallet = Auth::user()->earnings - $price;
					$walet_data = array('earnings' => $earn_wallet); 
					Members::updateData($user_token,$walet_data);
					$checkoutdata = array('user_subscr_type' => $user_subscr_type, 'user_subscr_date' => $subscr_date, 'user_subscr_item_level' => $user_subscr_item_level, 'user_subscr_item' => $user_subscr_item, 'user_subscr_space_level' => $user_subscr_space_level, 'user_subscr_space' => $user_subscr_space, 'user_subscr_space_type' => $user_subscr_space_type);
					Subscription::confirmsubscriData($user_id,$checkoutdata);
					return view('success');
					
			} 
			else
			{
			    return redirect()->back()->with('error', 'Please check your wallet balance amount');
			}
		 
		 }
		 
		 /* localbank */
		 if($payment_method == 'localbank')
		 {
			$bank_data = array('purchase_token' => $purchase_token, 'bank_details' => $bank_details);
			return view('upgrade-bank-details')->with($bank_data);
		 }
		  
		  
		  /* stripe code */
		  if($payment_method == 'stripe')
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
			 
				
				$subscribe_name = $user_subscr_type;
				$subscribe_price = $price * 100;
				$currency = $site_currency;
				$book_id = $purchase_token;
			 
				
				$charge = \Stripe\Charge::create(array(
					'customer' => $customer->id,
					'amount'   => $subscribe_price,
					'currency' => $currency,
					'description' => $subscribe_name,
					'metadata' => array(
						'order_id' => $book_id
					)
				));
			 
				
				$chargeResponse = $charge->jsonSerialize();
			 
				
				if($chargeResponse['paid'] == 1 && $chargeResponse['captured'] == 1) 
				{
			 
					
										
					$payment_token = $chargeResponse['balance_transaction'];
					$purchased_token = $book_id;
					$checkoutdata = array('user_subscr_type' => $user_subscr_type, 'user_subscr_date' => $subscr_date, 'user_subscr_item_level' => $user_subscr_item_level, 'user_subscr_item' => $user_subscr_item, 'user_subscr_space_level' => $user_subscr_space_level, 'user_subscr_space' => $user_subscr_space, 'user_subscr_space_type' => $user_subscr_space_type);
					Subscription::confirmsubscriData($user_id,$checkoutdata);
					$data_record = array('payment_token' => $payment_token);
					return view('success')->with($data_record);
					
					
				}
		     
		  
		  }
		  /* stripe code */
		  $subscr_id = $user_subscr_id;
	   	  $subscr['view'] = Subscription::getSubscription($subscr_id);
	      $get_payment = explode(',', $setting['setting']->payment_option);
	      $totaldata = array('subscr' => $subscr, 'get_payment' => $get_payment);
		  return view('confirm-subscription')->with($totaldata);
	
	
	
	}
	
	/* subscription */
	
	
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
		 $subscr_id = Auth::user()->user_subscr_id;
		 $subscr['view'] = Subscription::editsubData($subscr_id);
		 $subscri_date = $subscr['view']->subscr_duration;
		 $user_subscr_item_level = $subscr['view']->subscr_item_level;
		 $user_subscr_item = $subscr['view']->subscr_item;
		 $user_subscr_space_level = $subscr['view']->subscr_space_level;
		 $user_subscr_space = $subscr['view']->subscr_space;
		 $user_subscr_space_type = $subscr['view']->subscr_space_type;
		 $user_subscr_type = $subscr['view']->subscr_name;
		 $subscr_value = "+".$subscri_date;
		 $subscr_date = date('Y-m-d', strtotime($subscr_value));
		 $user_id = Auth::user()->id;
		 $checkoutdata = array('user_subscr_type' => $user_subscr_type, 'user_subscr_date' => $subscr_date, 'user_subscr_item_level' => $user_subscr_item_level, 'user_subscr_item' => $user_subscr_item, 'user_subscr_space_level' => $user_subscr_space_level, 'user_subscr_space' => $user_subscr_space, 'user_subscr_space_type' => $user_subscr_space_type);
		 Subscription::confirmsubscriData($user_id,$checkoutdata);
		 $result_data = array('payment_token' => $payment_token);
		 return view('success')->with($result_data);
	    } 
		else
		{
		  return redirect('/cancel');
		}
		
        
    }
	
	
	
    public function view_profile_settings()
    {   
	    $user_id = Auth::user()->id;
	    $count_mode = Settings::checkuserSubscription($user_id);
	    $get_payment = explode(',', Auth::user()->user_payment_option);
	    /*$payment_option = array('paypal','stripe','paystack','razorpay');*/
		$sid = 1;
		$setting['setting'] = Settings::editGeneral($sid);
	
		$payment_option = explode(',', $setting['setting']->vendor_payment_option);
        return view('profile-settings', [ 'payment_option' => $payment_option, 'get_payment' => $get_payment, 'count_mode' => $count_mode]);
    }
	
	
	
	public function update_profile(Request $request)
	{
	
	   $name = $request->input('name');
	   $username = $request->input('username');
       $email = $request->input('email');
		 
		 
		 if(!empty($request->input('password')))
		 {
		 $password = bcrypt($request->input('password'));
		 $pass = $password;
		 $user_auth_token = base64_encode($request->input('password'));
		 }
		 else
		 {
		 $pass = $request->input('save_password');
		 $user_auth_token = $request->input('save_auth_token');
		 }
		  
		 
		 if(!empty($request->input('website')))
		 {
		 $website  = $request->input('website');
		 $website_url = $website;
		 }
		 else
		 {
		 $website_url = "";
		 }
		 $country = $request->input('country');
		 
		 $profile_heading = $request->input('profile_heading');
		 
		 $about = $request->input('about');
		 
		 if(!empty($request->input('facebook_url')))
		 {
		 $facebook_url  = $request->input('facebook_url');
		 $facebook = $facebook_url;
		 }
		 else
		 {
		 $facebook = "";
		 }
		 
		 
		 if(!empty($request->input('twitter_url')))
		 {
		 $twitter_url  = $request->input('twitter_url');
		 $twitter = $twitter_url;
		 }
		 else
		 {
		 $twitter = "";
		 }
		 
		 
		 if(!empty($request->input('gplus_url')))
		 {
		 $gplus_url  = $request->input('gplus_url');
		 $gplus = $gplus_url;
		 }
		 else
		 {
		 $gplus = "";
		 }
		 
		 
		 if(!empty($request->input('item_update_email')))
		 {
		 $item_update_email  = $request->input('item_update_email');
		 $item_update = $item_update_email;
		 }
		 else
		 {
		 $item_update = 0;
		 }
		 
		 
		 if(!empty($request->input('item_comment_email')))
		 {
		 $item_comment_email  = $request->input('item_comment_email');
		 $item_comment = $item_comment_email;
		 }
		 else
		 {
		 $item_comment = 0;
		 }
		 
		 
		 if(!empty($request->input('item_review_email')))
		 {
		 $item_review_email  = $request->input('item_review_email');
		 $item_review = $item_review_email;
		 }
		 else
		 {
		 $item_review = 0;
		 }
		 
		 
		 if(!empty($request->input('buyer_review_email')))
		 {
		 $buyer_review_email  = $request->input('buyer_review_email');
		 $buyer_review = $buyer_review_email;
		 }
		 else
		 {
		 $buyer_review = 0;
		 }
		 
		 
		 
		 if(!empty($request->input('user_freelance')))
		 {
		 $user_freelance  = $request->input('user_freelance');
		 $freelance = $user_freelance;
		 }
		 else
		 {
		 $freelance = 0;
		 }
		 
		 $country_badge = $request->input('country_badge');
		 $exclusive_author = $request->input('exclusive_author');
		 
		 
		 
		 /*  $earnings = $request->input('save_earnings');*/
		 $allsettings = Settings::allSettings();
		  $image_size = $allsettings->site_max_image_size;
		  
		  $id = $request->input('id');
		  
		  $token = $request->input('user_token');
		  
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
		   $user_paypal_email = $request->input('user_paypal_email');
		   $user_paypal_mode = $request->input('user_paypal_mode');
		   $user_stripe_mode = $request->input('user_stripe_mode');
		   $user_test_publish_key = $request->input('user_test_publish_key');
		   $user_test_secret_key = $request->input('user_test_secret_key');
		   $user_live_publish_key = $request->input('user_live_publish_key');
		   $user_live_secret_key = $request->input('user_live_secret_key');
		   $user_paystack_public_key = $request->input('user_paystack_public_key');
		   $user_paystack_secret_key = $request->input('user_paystack_secret_key');
		   $user_paystack_merchant_email = $request->input('user_paystack_merchant_email');
		   $user_razorpay_key = $request->input('user_razorpay_key');
		   $user_razorpay_secret = $request->input('user_razorpay_secret');
		   
		   $user_payhere_mode = $request->input('user_payhere_mode');
		   $user_payhere_merchant_id = $request->input('user_payhere_merchant_id');
		   $user_payumoney_mode = $request->input('user_payumoney_mode');
		   $user_payu_merchant_key = $request->input('user_payu_merchant_key');
		   $user_payu_salt_key = $request->input('user_payu_salt_key');
		   
		   
		   
		   $additional_settings = Settings::editAdditional();
         
		 $request->validate([
							'name' => 'required',
							'username' => 'required',
							'email' => 'required|email',
							'password' => 'confirmed|min:6',
							'user_photo' => 'mimes:jpeg,jpg,png,gif|max:'.$image_size,
							'user_banner' => 'mimes:jpeg,jpg,png,gif|max:'.$image_size,
							
         ]);
		 $rules = array(
				'username' => ['required', 'regex:/^[\w-]*$/', 'max:255', Rule::unique('users') ->ignore($id, 'id') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				'email' => ['required', 'email', 'max:255', Rule::unique('users') ->ignore($id, 'id') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				
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
		  
		 
		 if ($request->hasFile('user_banner')) {
		     
			Members::droBanner($token); 
		   
			$image = $request->file('user_banner');
			$img_name = time() . '456.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/users');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$user_banner = $img_name;
		  }
		  else
		  {
		     $user_banner = $request->input('save_banner');
		  }
		 
		 
		 
		 
		$data = array('password' => $pass, 'website' => $website_url, 'country' => $country, 'profile_heading' => $profile_heading, 'about' => $about, 'facebook_url' => $facebook, 'twitter_url' => $twitter, 'gplus_url' => $gplus,  'user_photo' => $user_image, 'user_banner' => $user_banner, 'item_update_email' => $item_update, 'item_comment_email' => $item_comment, 'item_review_email' => $item_review, 'buyer_review_email' => $buyer_review, 'updated_at' => date('Y-m-d H:i:s'), 'user_freelance' => $freelance, 'country_badge' => $country_badge, 'exclusive_author' => $exclusive_author, 'user_payment_option' => $user_payment_option, 'user_paypal_email' => $user_paypal_email, 'user_paypal_mode' => $user_paypal_mode, 'user_stripe_mode' => $user_stripe_mode, 'user_test_publish_key' => $user_test_publish_key, 'user_test_secret_key' => $user_test_secret_key, 'user_live_publish_key' => $user_live_publish_key, 'user_live_secret_key' => $user_live_secret_key, 'user_paystack_public_key' => $user_paystack_public_key,  'user_paystack_secret_key' => $user_paystack_secret_key, 'user_paystack_merchant_email' => $user_paystack_merchant_email, 'user_razorpay_key' => $user_razorpay_key, 'user_razorpay_secret' => $user_razorpay_secret, 'user_payhere_mode' => $user_payhere_mode, 'user_payhere_merchant_id' => $user_payhere_merchant_id, 'user_payumoney_mode' => $user_payumoney_mode, 'user_payu_merchant_key' => $user_payu_merchant_key, 'user_payu_salt_key' => $user_payu_salt_key, 'user_auth_token' => $user_auth_token);
 
           Members::updateData($token, $data);
           if(!empty($request->input('become-vendor')))
		   {
		   $become_vendor = $request->input('become-vendor');
		      if($become_vendor == 1)
			  {
			     if($additional_settings->subscription_mode == 1)
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
				 $days_ago = date('Y-m-d', strtotime('-3 days'));
					 if($additional_settings->free_subscription == 1)
					 {
					 $data_value = array('user_type' => 'vendor', 'user_subscr_type' => $free_subscr_type, 'user_subscr_price' => $free_subscr_price, 'user_subscr_date' => $subscr_date, 'user_subscr_item_level' => $user_subscr_item_level, 'user_subscr_item' => $free_subscr_item, 'user_subscr_space_level' => $user_subscr_space_level, 'user_subscr_space' => $free_subscr_space, 'user_subscr_space_type' => $user_subscr_space_type);
					 }
					 else
					 {
					  $data_value = array('user_type' => 'vendor', 'user_subscr_type' => $free_subscr_type, 'user_subscr_price' => $free_subscr_price, 'user_subscr_date' => $days_ago, 'user_subscr_item_level' => $user_subscr_item_level, 'user_subscr_item' => 0, 'user_subscr_space_level' => $user_subscr_space_level, 'user_subscr_space' => 0, 'user_subscr_space_type' => $user_subscr_space_type);
					 }
				 }
				 else
				 {
				 $data_value = array('user_type' => 'vendor');
				 }
				 Members::updateData($token, $data_value);
			  }  
		   }
		   else
		   {
			   $become_vendor = 0;
		   } 
		   return redirect()->back()->with('success', 'Update successfully.');
            
 
       } 
     
       
	
	
	}
	
	
	
	
}
