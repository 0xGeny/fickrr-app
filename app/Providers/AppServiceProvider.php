<?php

namespace Fickrr\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Schema;
use Fickrr\Models\Members;
use Fickrr\Models\Settings;
use Fickrr\Models\Category;
use Fickrr\Models\Pages;
use Fickrr\Models\Comment;
use Fickrr\Models\Items; 
use Fickrr\Models\SubCategory;
use Fickrr\Models\Languages;
use Illuminate\Support\Facades\View;
use Auth;
use URL;
use Illuminate\Support\Facades\Config;
use Cookie;
use Illuminate\Support\Facades\Crypt;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
		$admin = Members::adminData();
		View::share('admin', $admin);
		
		$member_count = Members::footermemberData();
		View::share('member_count', $member_count);
		
		$total_sale = Items::totalsaleitemCount();
		View::share('total_sale', $total_sale);
		
		$total_files = Items::totalfileItems();
		View::share('total_files', $total_files);
		
		$getWell['type'] = Items::gettypeStatus();
		View::share('getWell', $getWell);
		
		
		$allsettings = Settings::allSettings();
		View::share('allsettings', $allsettings);
		
		$additional = Settings::editAdditional();
		View::share('additional', $additional);
		
		$addition_settings = Settings::editAdditional();
		View::share('addition_settings', $addition_settings);
		
		
		$allattributes = Settings::allAttributes();
		View::share('allattributes', $allattributes);
		
		$attr_field_type = array('multi-select' => 'Multi Select', 'single-select' => 'Single Select');
	    View::share('attr_field_type', $attr_field_type);
		
		$demo_mode = 'off'; // on
		View::share('demo_mode', $demo_mode);
		
		$help_id = 13;
		$count_help = Pages::helppageCount($help_id);
		if($count_help != 0)
		{
		  $help['page'] = Pages::editpageData($help_id);
		  View::share('help', $help);
		}
		View::share('count_help', $count_help);
		
		if($allsettings->stripe_mode == 0) 
		{ 
		$stripe_publish_key = $allsettings->test_publish_key; 
		$stripe_secret_key = $allsettings->test_secret_key;
		
		}
		else
		{ 
		$stripe_publish_key = $allsettings->live_publish_key;
		$stripe_secret_key = $allsettings->live_secret_key;
		}
		View::share('stripe_publish_key', $stripe_publish_key);
		View::share('stripe_secret_key', $stripe_secret_key);
		
		
		$country['country'] = Settings::allCountry();
		View::share('country', $country);

		$state['state'] = Settings::allState();
		View::share('state', $state);

		$city['city'] = Settings::allCity();
		View::share('city', $city);
				
		$allpages['pages'] = Pages::menupageData();
		View::share('allpages', $allpages);
		
		$encrypter = app('Illuminate\Contracts\Encryption\Encrypter');
		View::share('encrypter', $encrypter);
		
		$footerpages['pages'] = Pages::footermenuData();
		View::share('footerpages', $footerpages);
		if($addition_settings->subscription_mode == 1)
		{
		$permission = array('dashboard' => 'Dashboard', 'settings' => 'Settings', 'items' => 'Items', 'subscription' => 'Subscription', 'refund' => 'Refund Request', 'rating' => 'Rating & Reviews', 'withdrawal' => 'Withdrawal Request', 'blog' => 'Blog', 'pages' => 'Pages', 'features' => 'Features', 'selling' => 'Start Selling', 'contact' => 'Contact', 'newsletter' => 'Newsletter', 'languages' => 'Languages');
		}
		else
		{
		$permission = array('dashboard' => 'Dashboard', 'settings' => 'Settings', 'items' => 'Items', 'refund' => 'Refund Request', 'rating' => 'Rating & Reviews', 'withdrawal' => 'Withdrawal Request', 'blog' => 'Blog', 'pages' => 'Pages', 'features' => 'Features', 'selling' => 'Start Selling', 'contact' => 'Contact', 'newsletter' => 'Newsletter', 'languages' => 'Languages');
		}
		View::share('permission', $permission);
		
		$durations = array('1 Month','2 Month','3 Month','4 Month','5 Month','6 Month','1 Year','2 Year','3 Year','4 Year','5 Year');
		View::share('durations', $durations);
		
		$item_sale_type = array('limited' => 'Limited Items','unlimited' => 'Unlimited Items');
		View::share('item_sale_type', $item_sale_type);
		
		$storage_space = array('limited' => 'Limited Space','unlimited' => 'Unlimited Space');
		View::share('storage_space', $storage_space);
		
		$storage_space_type = array('MB','GB','TB');
		View::share('storage_space_type', $storage_space_type);
		
		$languages['view'] = Languages::allLanguage();
		View::share('languages', $languages);
		
		$alllang['data'] = Languages::allLanguage();
		View::share('alllang', $alllang);
		
		if(!empty(Cookie::get('translate')))
		{
		$translate = Cookie::get('translate');
		   $lang_title['view'] = Languages::getLanguage($translate);
		   $language_title = $lang_title['view']->language_name;
		}
		else
		{
		  $default_count = Languages::defaultLanguageCount();
		  if($default_count == 0)
		  { 
		  $translate = "en";
		  $lang_title['view'] = Languages::getLanguage($translate);
		   $language_title = $lang_title['view']->language_name;
		  }
		  else
		  {
		  $default['lang'] = Languages::defaultLanguage();
		  $translate =  $default['lang']->language_code;
		  $lang_title['view'] = Languages::getLanguage($translate);
		   $language_title = $lang_title['view']->language_name;
		  }
		 
		}
		View::share('translate', $translate);
		View::share('language_title', $language_title);
		
		
		$minprice['price'] = Items::minpriceData();
		View::share('minprice', $minprice);
		
		$maxprice['price'] = Items::maxpriceData();
		View::share('maxprice', $maxprice);
		
		
		$minprice_count = Items::minpriceCount();
		View::share('minprice_count', $minprice_count);
		
		$maxprice_count = Items::maxpriceCount();
		View::share('maxprice_count', $maxprice_count);
		
		
		$maincategory['view'] = Category::footercategoryData();
		View::share('maincategory', $maincategory);
		
		$maincategory_two['view'] = Category::footercategoryData();
		View::share('maincategory_two', $maincategory_two);
		//$cartitem['item'] = Items::getcartData();
//		View::share('cartitem', $cartitem);
		
	    //$cartcount = Items::getcartCount();
//		View::share('cartcount', $cartcount);
		
		
		
			
		$categories['menu'] = Category::with('SubCategory')->where('category_status','=','1')->where('drop_status','=','no')->take($allsettings->site_menu_category)->orderBy('menu_order',$allsettings->menu_categories_order)->get();
		View::share('categories', $categories);
		
		$item_type_text = array('scripts' => 'Scripts', 'themes' => 'Themes', 'plugins' => 'Plugins', 'print' => 'Print', 'graphics' => 'Graphics', 'mobile-apps' => 'Mobile Apps');
		View::share('item_type_text', $item_type_text);
		
		view()->composer('*', function($view){
            $view_name = str_replace('.', '-', $view->getName());
            view()->share('view_name', $view_name);
        });
		
		view()->composer('*', function($view)
		{
			if (Auth::check()) {
			    $user['avilable'] = Members::logindataUser(Auth::user()->id);
			   $avilable = explode(',',$user['avilable']->user_permission);
			    $cartcount = Items::getcartCount();
				$view->with('cartcount', $cartcount);
				
				
			}else {
			    $avilable = "";
				$view->with('cartcount', 0);
				
			}
			view()->share('avilable', $avilable);
		});
		view()->composer('*', function($viewcart)
		{
			if (Auth::check()) {
			    $cartitem['item'] = Items::getcartData();
				$viewcart->with('cartitem', $cartitem);
				
			}else {
				$viewcart->with('cartitem', 0);
			}
		});
		
		
		/*view()->composer('*', function($view) {
             $view->with('item_comments', Comment::with('children')->whereNull('comm_parent_id')->orderBy('comm_id', 'asc')->get());
        });*/
		
		
		Config::set('filesystems.disks.s3.key', $allsettings->aws_access_key_id);
		Config::set('filesystems.disks.s3.secret', $allsettings->aws_secret_access_key);
		Config::set('filesystems.disks.s3.region', $allsettings->aws_default_region);
		Config::set('filesystems.disks.s3.bucket', $allsettings->aws_bucket);
		
		Config::set('paystack.publicKey', $allsettings->paystack_public_key);
		Config::set('paystack.secretKey', $allsettings->paystack_secret_key);
		Config::set('paystack.merchantEmail', $allsettings->paystack_merchant_email);
		Config::set('paystack.paymentUrl', 'https://api.paystack.co');
		
		
		Config::set('mail.driver', $allsettings->mail_driver);
		Config::set('mail.host', $allsettings->mail_host);
		Config::set('mail.port', $allsettings->mail_port);
		Config::set('mail.username', $allsettings->mail_username);
		Config::set('mail.password', $allsettings->mail_password);
		Config::set('mail.encryption', $allsettings->mail_encryption);
		
		Config::set('services.facebook.client_id', $allsettings->facebook_client_id);
		Config::set('services.facebook.client_secret', $allsettings->facebook_client_secret);
		Config::set('services.facebook.redirect', $allsettings->facebook_callback_url);
		Config::set('services.google.client_id', $allsettings->google_client_id);
		Config::set('services.google.client_secret', $allsettings->google_client_secret);
		Config::set('services.google.redirect', $allsettings->google_callback_url);
		
		
		
    }
}
