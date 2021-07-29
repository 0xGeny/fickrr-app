<?php

namespace Fickrr\Http\Controllers;

use Illuminate\Http\Request;
use Fickrr\Models\Members;
use Fickrr\Models\Settings;
use Fickrr\Models\Items;
use Fickrr\Models\Blog;
use Fickrr\Models\Category;
use Fickrr\Models\Comment;
use Fickrr\Models\Pages;
use Fickrr\Models\Attribute;
use Fickrr\Models\SubCategory;
use Fickrr\Models\Subscription;
use Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Auth;
use Illuminate\Validation\Rule;
use URL;
use Illuminate\Support\Facades\Cookie;
use Redirect;
use Storage;
//use Spatie\Sitemap\SitemapGenerator;

class CommonController extends Controller
{
    
	
	public function cookie_translate($id)
	{
	
	  Cookie::queue(Cookie::make('translate', $id, 3000));
      return Redirect::back()->withCookie('translate');
	  
	}
	
	
	public function login_as_vendor($user_token)
	{
	   $encrypter = app('Illuminate\Contracts\Encryption\Encrypter');
	   $vendor_token   = $encrypter->decrypt($user_token);
	      
		  if(Auth::check())
		  {
		     if(Auth::user()->id == 1)
			 {
				  Auth::logout();
				  $count_data = Members::logData($vendor_token);
				  $vendor_details = Members::editData($vendor_token);
				  $email = $vendor_details->email;
				  $password = base64_decode($vendor_details->user_auth_token);
				  
				  if (Auth::attempt(['email' => $email, 'password' => $password, 'verified' => 1, 'drop_status' => 'no'])) 
				  {
					 return redirect('/profile-settings');
				  }
				  else
				  {
					 return redirect('/login')->with('error', 'These credentials do not match our records.');
				  }
			 }
			 else
			 {
			    return redirect('/login')->with('error', 'These credentials do not match our records.');
			 }	  
		  }
		  else
		  {
		     return redirect('/404');
		  }	  
		  
	   
	
	   
	}
	
	public function upgrade_bank_details()
	{
	   return view('upgrade-bank-details');
	  
	}
	
	public function view_subscription()
	{
	 $subscription['view'] = Subscription::viewSubscription();
	 $data = array('subscription' => $subscription);  
	 return view('subscription')->with($data);
	}
	
	public function view_start_selling()
	{
	  $setting['setting'] = Settings::editSelling();
	  $data = array('setting' => $setting);
	  return view('start-selling')->with($data);
	}
	
	
	public function view_preview($item_slug,$item_id)
	{
	   $item['item'] = Items::singleitemData($item_slug,$item_id);
	   $data = array('item' => $item);
	   return view('preview')->with($data);
	}
	public function autoComplete(Request $request) {
	    
        $query = $request->get('term','');
        
        //$products=Items::autoSearch($query);
		   $today = date("Y-m-d");
		   $additional['settings'] = Settings::editAdditional();
		   if($additional['settings']->subscription_mode == 1)
		   {
			
			$products = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('users.user_subscr_date','>=',$today)->where('items.item_name', 'LIKE', '%'. $query. '%')->where('items.item_status','=',1)->where('items.drop_status','=','no')->orderBy('items.item_name', 'asc')->get();
		   }
		   else
		   {
		   $products=Items::autoSearch($query);
		   }	
        $data=array();
        foreach ($products as $product) {
                $data[]=array('value'=>$product->item_name,'id'=>$product->item_id);
        }
        if(count($data))
             return $data;
        else
            return ['value'=>'No Result Found','id'=>''];
    }
	
	public function not_found()
	{
	  return view('404');
	}
	
	public function view_new_items()
	{
	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   $today = date("Y-m-d");
	   $additional['settings'] = Settings::editAdditional();
	   if($additional['settings']->subscription_mode == 1)
	   {
	   $newest['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('users.user_subscr_date','>=',$today)->where('items.item_status','=',1)->where('items.drop_status','=','no')->orderBy('items.item_id', 'desc')->get();
	   }
	   else
	   {
	   $newest['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->orderBy('items.item_id', 'desc')->get();
	   }
	   $data = array('setting' => $setting, 'newest' => $newest);
	   return view('new-releases')->with($data);
	}
	
	
	public function view_tags($type,$slug)
	{
	   $nslug = str_replace("-"," ",$slug);
	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   $today = date("Y-m-d");
	   $additional['settings'] = Settings::editAdditional();
	   if($additional['settings']->subscription_mode == 1)
	   {
	   $itemData['item'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('users.user_subscr_date','>=',$today)->where('items.item_status','=',1)->where('items.item_tags', 'LIKE', "%$nslug%")->where('items.drop_status','=','no')->orderBy('items.item_id', 'desc')->get();
	   }
	   else
	   {
	   $itemData['item'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.item_tags', 'LIKE', "%$nslug%")->where('items.drop_status','=','no')->orderBy('items.item_id', 'desc')->get();
	   }
	   $data = array('setting' => $setting, 'itemData' => $itemData, 'slug' => $slug);
	   return view('tag')->with($data);
	}
	
	
	public function view_featured_items()
	{
	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   $today = date("Y-m-d");
	   $additional['settings'] = Settings::editAdditional();
	   if($additional['settings']->subscription_mode == 1)
	   {
	   $featured['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('users.user_subscr_date','>=',$today)->where('items.item_status','=',1)->where('items.item_featured','=','yes')->where('items.drop_status','=','no')->orderBy('items.item_id', 'desc')->get();
	   }
	   else
	   {
	   $featured['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.item_featured','=','yes')->where('items.drop_status','=','no')->orderBy('items.item_id', 'desc')->get();
	   }
	   $data = array('setting' => $setting, 'featured' => $featured);
	   return view('featured-items')->with($data);
	}
	
	public function view_popular_items()
	{
	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   $today = date("Y-m-d");
	   $additional['settings'] = Settings::editAdditional();
	   if($additional['settings']->subscription_mode == 1)
	   {
	   $popular['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('users.user_subscr_date','>=',$today)->where('items.item_status','=',1)->where('items.drop_status','=','no')->orderBy('items.item_views', 'desc')->get();
	   }
	   else
	   {
	   $popular['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->orderBy('items.item_views', 'desc')->get();
	   }
	   $data = array('setting' => $setting, 'popular' => $popular);
	   return view('popular-items')->with($data);
	}
	
	
	public function view_free_items()
	{
	    $today = date("Y-m-d");
	   $additional['settings'] = Settings::editAdditional();
	   if($additional['settings']->subscription_mode == 1)
	   {
	  $free['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('users.user_subscr_date','>=',$today)->where('items.item_status','=',1)->where('items.free_download','=',1)->where('items.drop_status','=','no')->orderBy('items.item_id', 'desc')->get();
	  }
	  else
	  {
	  $free['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.free_download','=',1)->where('items.drop_status','=','no')->orderBy('items.item_id', 'desc')->get();
	  }
	  $sid = 1;
	  $setting['setting'] = Settings::editGeneral($sid);
	  
	  if($setting['setting']->site_free_end_date < date("Y-m-d"))
	  {
	     $data = array('free_download' => 0);
		 Items::updateFree($data);
	  }
	  
	  return view('free-items',[ 'free' => $free, 'setting' => $setting]);
	  
	}
	
	
		

    public function view_index()
	{
	   $today = date("Y-m-d");
	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   $additional['settings'] = Settings::editAdditional();
	   $blog['data'] = Blog::homeblogData();
	   $comments = Blog::getgroupcommentData();
	   $review['data'] = Items::homereviewsData();
	   $totalmembers = Members::getmemberData();
	   $totalsales = Items::totalsaleitemCount();
	   $totalfiles = Items::totalfileItems();
	   $total['earning'] = Items::totalearningCount();
	   if($additional['settings']->subscription_mode == 1)
	   {
	   $featured['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('users.user_subscr_date','>=',$today)->where('items.item_status','=',1)->where('items.item_featured','=','yes')->where('items.drop_status','=','no')->orderBy('items.item_id', 'desc')->take($setting['setting']->home_featured_items)->get();
	   $popular['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('users.user_subscr_date','>=',$today)->where('items.item_status','=',1)->where('items.drop_status','=','no')->orderBy('items.item_views', 'desc')->take($setting['setting']->home_popular_items)->get();
	   $flash['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('users.user_subscr_date','>=',$today)->where('items.item_status','=',1)->where('items.drop_status','=','no')->where('items.item_flash','=',1)->orderBy('items.item_id', 'desc')->take($setting['setting']->home_flash_items)->get();
	   $free['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('users.user_subscr_date','>=',$today)->where('items.item_status','=',1)->where('items.drop_status','=','no')->where('items.free_download','=',1)->orderBy('items.item_id', 'desc')->take($setting['setting']->home_free_items)->get();
	   $newest['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('users.user_subscr_date','>=',$today)->where('items.item_status','=',1)->where('items.drop_status','=','no')->orderBy('items.item_id', 'desc')->take($setting['setting']->site_newest_files)->get();
	   }
	   else
	   {
	   $featured['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.item_featured','=','yes')->where('items.drop_status','=','no')->orderBy('items.item_id', 'desc')->take($setting['setting']->home_featured_items)->get();
	   $popular['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->orderBy('items.item_views', 'desc')->take($setting['setting']->home_popular_items)->get();
	   $flash['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->where('items.item_flash','=',1)->orderBy('items.item_id', 'desc')->take($setting['setting']->home_flash_items)->get();
	   $free['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->where('items.free_download','=',1)->orderBy('items.item_id', 'desc')->take($setting['setting']->home_free_items)->get();
	   $newest['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->orderBy('items.item_id', 'desc')->take($setting['setting']->site_newest_files)->get();
	   }
	   
	   $totalearning = 0;
	   foreach($total['earning'] as $earning)
	   {
	     $totalearning += $earning->total_price;
	   } 
	   
	   
	   $data = array('blog' => $blog, 'comments' => $comments, 'review' => $review, 'totalmembers' => $totalmembers, 'totalsales' => $totalsales, 'totalfiles' => $totalfiles, 'totalearning' => $totalearning, 'featured' => $featured, 'newest' => $newest, 'free' => $free, 'popular' => $popular, 'flash' => $flash);
	  //SitemapGenerator::create(URL::to('/'))->writeToFile('sitemap.xml');
	  
	  return view('index')->with($data);
	}
	
	public function payment_cancel()
	{
	  return view('cancel');
	}
	

    public function user_verify($user_token)
    {
        $data = array('verified'=>'1');
		$user['user'] = Members::verifyuserData($user_token, $data);
		
		return redirect('login')->with('success','Your e-mail is verified. You can now login.');
    }
	
	public function view_forgot()
	{
	   return view('forgot');
	}
	
	public function view_contact()
	{
	   return view('contact');
	}
	
	
	public function view_reset($token)
	{
	  $data = array('token' => $token);
	  return view('reset')->with($data);
	}
	
	
	public function view_unfollow($unfollow,$my_id,$follow_id)
	{
	  Items::unFollow($my_id,$follow_id);
	  return redirect()->back();
	  
	}
	
	public function view_free_item($download,$item_token)
	{
	
	  $token = base64_decode($item_token);
	  $allsettings = Settings::allSettings();
	  $item['data'] = Items::edititemData($token);
	  $item_count = $item['data']->download_count + 1;
	  $data = array('download_count' => $item_count);
	  Items::updateitemData($token,$data);
	  
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
	      
		  /*$headers = ['Content-Type: application/octet-stream'];
		  $new_name = uniqid().time().'.zip';
		  
		  $filename = uniqid().time().'.zip';
	      $tempfile = tempnam(sys_get_temp_dir(), $filename);
		  copy($item['data']->item_file_link, $tempfile);
		  return response()->download($tempfile, $filename);*/
		  return redirect($item['data']->item_file_link);
		  
	  }	  
	  
	 
	
	}
	
	
	
	
	public function view_follow($my_id,$follow_id)
	{
	   $user_id = $follow_id;
	   $followcheck = Items::getfollowuserCheck($user_id);
	   $data = array('follower_user_id' => $my_id, 'following_user_id' => $follow_id);
	   if($followcheck == 0)
	   {
	       Items::saveFollow($data);
	   }
	   else
	   {
	      return redirect()->back();
	   }
	   return redirect()->back();
	   
	}
	
	
	public function view_top_authors()
	{
	  
	  /*$user['user'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->leftJoin('item_order','item_order.item_user_id','users.id')->leftJoin('country','country.country_id','users.country')->where('users.drop_status','=','no')->where('users.id','!=',1)->orderByRaw('count(*) DESC')->groupBy('item_order.item_user_id')->get();*/

	if(isset($_GET['sortby']) && $_GET['sortby']=='name')
	{
	  $user['user'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->leftJoin('item_order','item_order.item_user_id','users.id')->leftJoin('country','country.country_id','users.country')->where('users.drop_status','=','no')->where('users.id','!=',1)->orderByRaw('users.name ASC')->groupBy('item_order.item_user_id')->get();
	}
	else if(isset($_GET['sortby']) && $_GET['sortby']=='newest')
	{
	  $user['user'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->leftJoin('item_order','item_order.item_user_id','users.id')->leftJoin('country','country.country_id','users.country')->where('users.drop_status','=','no')->where('users.id','!=',1)->orderByRaw('users.id DESC')->groupBy('item_order.item_user_id')->get();
	}
	else if(isset($_GET['sortby']) && $_GET['sortby']=='oldest')
	{
	  $user['user'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->leftJoin('item_order','item_order.item_user_id','users.id')->leftJoin('country','country.country_id','users.country')->where('users.drop_status','=','no')->where('users.id','!=',1)->orderByRaw('users.id ASC')->groupBy('item_order.item_user_id')->get();
	}
	else
	{
	  $user['user'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->leftJoin('item_order','item_order.item_user_id','users.id')->leftJoin('country','country.country_id','users.country')->where('users.drop_status','=','no')->where('users.id','!=',1)->orderByRaw('users.user_document_verified DESC')->groupBy('item_order.item_user_id')->get();
	}
//print_r($_GET); die;


//	  $user['user'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->leftJoin('item_order','item_order.item_user_id','users.id')->leftJoin('country','country.country_id','users.country')->where('users.drop_status','=','no')->where('users.id','!=',1)->orderByRaw('users.user_document_verified DESC')->groupBy('item_order.item_user_id')->get();
//echo '<pre>'; print_r($user['user']); die;
	  $count_items = Items::getgroupItems();
	  $count_sale = Items::getgroupSale();
	  $sid = 1;
	   $badges['setting'] = Settings::editBadges($sid);
	   $category['view'] = Category::with('SubCategory')->where('category_status','=','1')->where('drop_status','=','no')->orderBy('menu_order','asc')->get();
	   $popular['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->orderBy('items.item_views', 'desc')->take(5)->get();
	  $data = array('user' => $user,'count_items' => $count_items, 'count_sale' => $count_sale, 'badges' => $badges, 'category' => $category, 'popular' => $popular);
	  return view('top-authors')->with($data);
	}
	
	
	
	public function view_user_reviews($slug)
	{
	
	  $user['user'] = Members::getInuser($slug);
	   $user_id = $user['user']->id;
	   
	   /* badges */
	   $sid = 1;
	   $badges['setting'] = Settings::editBadges($sid);
	   $sold['item'] = Items::SoldAmount($user_id);
	   $sold_amount = 0;
	   foreach($sold['item'] as $iter)
	   {
			$sold_amount += $iter->total_price;
	   }
	   $country['view'] = Settings::editCountry($user['user']->country);
	   $membership = date('m/d/Y',strtotime($user['user']->created_at));
	  $membership_date = explode("/", $membership);
      $year = (date("md", date("U", mktime(0, 0, 0, $membership_date[0], $membership_date[1], $membership_date[2]))) > date("md")
		? ((date("Y") - $membership_date[2]) - 1)
		: (date("Y") - $membership_date[2]));
	  
	   $collect_amount = Items::CollectedAmount($user_id);
	   $referral_count = $user['user']->referral_count;
	   /* badges */
	   
	   
	   $itemData['item'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.user_id','=',$user_id)->where('items.item_status','=',1)->where('items.drop_status','=','no')->orderBy('items.item_id', 'desc')->get();
	   
	   $since = date("F Y", strtotime($user['user']->created_at));
	   
	   $getitemcount = Items::getuseritemCount($user_id);
	   
	   $getsalecount = Items::getsaleitemCount($user_id);
	   
	   
	   
		  $getreview  = Items::getreviewData($user_id);
		  if($getreview !=0)
		  {
			  $review['view'] = Items::getreviewRecord($user_id);
			  $top = 0;
			  $bottom = 0;
			  foreach($review['view'] as $review)
			  {
				 if($review->rating == 1) { $value1 = $review->rating*1; } else { $value1 = 0; }
				 if($review->rating == 2) { $value2 = $review->rating*2; } else { $value2 = 0; }
				 if($review->rating == 3) { $value3 = $review->rating*3; } else { $value3 = 0; }
				 if($review->rating == 4) { $value4 = $review->rating*4; } else { $value4 = 0; }
				 if($review->rating == 5) { $value5 = $review->rating*5; } else { $value5 = 0; }
				 
				 $top += $value1 + $value2 + $value3 + $value4 + $value5;
				 $bottom += $review->rating;
				 
			  }
			  if(!empty(round($top/$bottom)))
			  {
				$count_rating = round($top/$bottom);
			  }
			  else
			  {
				$count_rating = 0;
			  }
			  
			  
			  
		  }
		  else
		  {
			$count_rating = 0;
			$bottom = 0;
		  }
	   
	    $ratingview['list'] = Items::getreviewUser($user_id);
		$countreview = Items::getreviewCountUser($user_id);
		
		if (Auth::check())
		{
		$followcheck = Items::getfollowuserCheck($user_id);
		}
		else
		{
		 $followcheck = 0;
		}
		
		$followingcount = Items::getfollowingCount($user_id);
		
		$followercount = Items::getfollowerCount($user_id);
		
		$featured_count = Items::getfeaturedUser($user_id);
	   $free_count = Items::getfreeUser($user_id);
	   $tren_count = Items::getTrendUser($user_id);
		
	   $data = array('user' => $user, 'since' => $since, 'itemData' => $itemData, 'getitemcount' => $getitemcount, 'getsalecount' => $getsalecount, 'count_rating' => $count_rating, 'bottom' => $bottom, 'ratingview' => $ratingview, 'countreview' => $countreview, 'getreview' => $getreview, 'followcheck' => $followcheck, 'followingcount' =>  $followingcount, 'followercount' => $followercount, 'badges' => $badges, 'sold_amount' => $sold_amount, 'country' => $country, 'year' => $year, 'collect_amount' => $collect_amount, 'referral_count' => $referral_count, 'featured_count' => $featured_count, 'free_count' => $free_count, 'tren_count' => $tren_count);
	   return view('user-reviews')->with($data);
	
	}
	
	
	public function view_user_followers($slug)
	{
	  $user['user'] = Members::getInuser($slug);
	   $user_id = $user['user']->id;
	   
	   /* badges */
	   $sid = 1;
	   $badges['setting'] = Settings::editBadges($sid);
	   $sold['item'] = Items::SoldAmount($user_id);
	   $sold_amount = 0;
	   foreach($sold['item'] as $iter)
	   {
			$sold_amount += $iter->total_price;
	   }
	   $country['view'] = Settings::editCountry($user['user']->country);
	   $membership = date('m/d/Y',strtotime($user['user']->created_at));
	  $membership_date = explode("/", $membership);
      $year = (date("md", date("U", mktime(0, 0, 0, $membership_date[0], $membership_date[1], $membership_date[2]))) > date("md")
		? ((date("Y") - $membership_date[2]) - 1)
		: (date("Y") - $membership_date[2]));
	  
	   $collect_amount = Items::CollectedAmount($user_id);
	   $referral_count = $user['user']->referral_count;
	   /* badges */
	   
	   
	   $itemData['item'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.user_id','=',$user_id)->where('items.item_status','=',1)->where('items.drop_status','=','no')->orderBy('items.item_id', 'desc')->get();
	   
	   $since = date("F Y", strtotime($user['user']->created_at));
	   
	   $getitemcount = Items::getuseritemCount($user_id);
	   
	   $getsalecount = Items::getsaleitemCount($user_id);
	   
	   
	   
		  $getreview  = Items::getreviewData($user_id);
		  if($getreview !=0)
		  {
			  $review['view'] = Items::getreviewRecord($user_id);
			  $top = 0;
			  $bottom = 0;
			  foreach($review['view'] as $review)
			  {
				 if($review->rating == 1) { $value1 = $review->rating*1; } else { $value1 = 0; }
				 if($review->rating == 2) { $value2 = $review->rating*2; } else { $value2 = 0; }
				 if($review->rating == 3) { $value3 = $review->rating*3; } else { $value3 = 0; }
				 if($review->rating == 4) { $value4 = $review->rating*4; } else { $value4 = 0; }
				 if($review->rating == 5) { $value5 = $review->rating*5; } else { $value5 = 0; }
				 
				 $top += $value1 + $value2 + $value3 + $value4 + $value5;
				 $bottom += $review->rating;
				 
			  }
			  if(!empty(round($top/$bottom)))
			  {
				$count_rating = round($top/$bottom);
			  }
			  else
			  {
				$count_rating = 0;
			  }
			  
			  
			  
		  }
		  else
		  {
			$count_rating = 0;
			$bottom = 0;
		  }
	   
	    $ratingview['list'] = Items::getreviewUser($user_id);
		$countreview = Items::getreviewCountUser($user_id);
		
		if (Auth::check())
		{
		$followcheck = Items::getfollowuserCheck($user_id);
		
		}
		else
		{
		 $followcheck = 0;
		 
		}
		$followingcount = Items::getfollowingCount($user_id);
		
		$followercount = Items::getfollowerCount($user_id);
		
		$viewfollowing['view'] = Items::getfollowerView($user_id);
		
		$featured_count = Items::getfeaturedUser($user_id);
	   $free_count = Items::getfreeUser($user_id);
	   $tren_count = Items::getTrendUser($user_id);
		//$viewfollowing['view'] = Follow::with('followers')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('follow.following_user_id','=',$user_id)->orderBy('follow.fid', 'desc')->get();
		
	   $data = array('user' => $user, 'since' => $since, 'itemData' => $itemData, 'getitemcount' => $getitemcount, 'getsalecount' => $getsalecount, 'count_rating' => $count_rating, 'bottom' => $bottom, 'ratingview' => $ratingview, 'countreview' => $countreview, 'getreview' => $getreview, 'followcheck' => $followcheck, 'followingcount' =>  $followingcount, 'followercount' => $followercount, 'viewfollowing' => $viewfollowing, 'badges' => $badges, 'sold_amount' => $sold_amount, 'country' => $country, 'year' => $year, 'collect_amount' => $collect_amount, 'referral_count' => $referral_count, 'featured_count' => $featured_count, 'free_count' => $free_count, 'tren_count' => $tren_count);
	   return view('user-followers')->with($data); 
	  
	}
	
	
	
	public function view_user_following($slug)
	{
	  $user['user'] = Members::getInuser($slug);
	   $user_id = $user['user']->id;
	   
	   /* badges */
	   $sid = 1;
	   $badges['setting'] = Settings::editBadges($sid);
	   $sold['item'] = Items::SoldAmount($user_id);
	   $sold_amount = 0;
	   foreach($sold['item'] as $iter)
	   {
			$sold_amount += $iter->total_price;
	   }
	   $country['view'] = Settings::editCountry($user['user']->country);
	   $membership = date('m/d/Y',strtotime($user['user']->created_at));
	  $membership_date = explode("/", $membership);
      $year = (date("md", date("U", mktime(0, 0, 0, $membership_date[0], $membership_date[1], $membership_date[2]))) > date("md")
		? ((date("Y") - $membership_date[2]) - 1)
		: (date("Y") - $membership_date[2]));
	  
	   $collect_amount = Items::CollectedAmount($user_id);
	   $referral_count = $user['user']->referral_count;
	   /* badges */
	   
	   
	   $itemData['item'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.user_id','=',$user_id)->where('items.item_status','=',1)->where('items.drop_status','=','no')->orderBy('items.item_id', 'desc')->get();
	   
	   $since = date("F Y", strtotime($user['user']->created_at));
	   
	   $getitemcount = Items::getuseritemCount($user_id);
	   
	   $getsalecount = Items::getsaleitemCount($user_id);
	   
	   
	   
		  $getreview  = Items::getreviewData($user_id);
		  if($getreview !=0)
		  {
			  $review['view'] = Items::getreviewRecord($user_id);
			  $top = 0;
			  $bottom = 0;
			  foreach($review['view'] as $review)
			  {
				 if($review->rating == 1) { $value1 = $review->rating*1; } else { $value1 = 0; }
				 if($review->rating == 2) { $value2 = $review->rating*2; } else { $value2 = 0; }
				 if($review->rating == 3) { $value3 = $review->rating*3; } else { $value3 = 0; }
				 if($review->rating == 4) { $value4 = $review->rating*4; } else { $value4 = 0; }
				 if($review->rating == 5) { $value5 = $review->rating*5; } else { $value5 = 0; }
				 
				 $top += $value1 + $value2 + $value3 + $value4 + $value5;
				 $bottom += $review->rating;
				 
			  }
			  if(!empty(round($top/$bottom)))
			  {
				$count_rating = round($top/$bottom);
			  }
			  else
			  {
				$count_rating = 0;
			  }
			  
			  
			  
		  }
		  else
		  {
			$count_rating = 0;
			$bottom = 0;
		  }
	   
	    $ratingview['list'] = Items::getreviewUser($user_id);
		$countreview = Items::getreviewCountUser($user_id);
		
		if (Auth::check())
		{
		$followcheck = Items::getfollowuserCheck($user_id);
		
		}
		else
		{
		 $followcheck = 0;
		 
		}
		$followingcount = Items::getfollowingCount($user_id);
		
		$followercount = Items::getfollowerCount($user_id);
		
		$viewfollowing['view'] = Items::getfollowingView($user_id);
		
		$featured_count = Items::getfeaturedUser($user_id);
	   $free_count = Items::getfreeUser($user_id);
	   $tren_count = Items::getTrendUser($user_id);
		//$viewfollowing['view'] = Follow::with('followers')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('follow.following_user_id','=',$user_id)->orderBy('follow.fid', 'desc')->get();
		
	   $data = array('user' => $user, 'since' => $since, 'itemData' => $itemData, 'getitemcount' => $getitemcount, 'getsalecount' => $getsalecount, 'count_rating' => $count_rating, 'bottom' => $bottom, 'ratingview' => $ratingview, 'countreview' => $countreview, 'getreview' => $getreview, 'followcheck' => $followcheck, 'followingcount' =>  $followingcount, 'followercount' => $followercount, 'viewfollowing' => $viewfollowing, 'badges' => $badges, 'sold_amount' => $sold_amount, 'country' => $country, 'year' => $year, 'collect_amount' => $collect_amount, 'referral_count' => $referral_count, 'featured_count' => $featured_count, 'free_count' => $free_count, 'tren_count' => $tren_count);
	   return view('user-following')->with($data); 
	  
	}
	
	
	
	
	
	public function view_user($slug)
	{
	   
	   $user['user'] = Members::getInuser($slug);
	   $user_id = $user['user']->id;
	   
	   /* badges */
	   $sid = 1;
	   $badges['setting'] = Settings::editBadges($sid);
	   $sold['item'] = Items::SoldAmount($user_id);
	   $sold_amount = 0;
	   foreach($sold['item'] as $iter)
	   {
			$sold_amount += $iter->total_price;
	   }
	   $country['view'] = Settings::editCountry($user['user']->country);
	   $membership = date('m/d/Y',strtotime($user['user']->created_at));
	  $membership_date = explode("/", $membership);
      $year = (date("md", date("U", mktime(0, 0, 0, $membership_date[0], $membership_date[1], $membership_date[2]))) > date("md")
		? ((date("Y") - $membership_date[2]) - 1)
		: (date("Y") - $membership_date[2]));
	  
	   $collect_amount = Items::CollectedAmount($user_id);
	   $referral_count = $user['user']->referral_count;
	   /* badges */
	   
	   
	   
	   $itemData['item'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.user_id','=',$user_id)->where('items.item_status','=',1)->where('items.drop_status','=','no')->orderBy('items.item_id', 'desc')->get();
	   
	   
	   $since = date("F Y", strtotime($user['user']->created_at));
	   
	   $getitemcount = Items::getuseritemCount($user_id);
	   
	   $getsalecount = Items::getsaleitemCount($user_id);
	   
	   if (Auth::check())
		{
		$followcheck = Items::getfollowuserCheck($user_id);
		}
		else
		{
		 $followcheck = 0;
		}
	   
	   $followingcount = Items::getfollowingCount($user_id);
	   
	   $followercount = Items::getfollowerCount($user_id);
	   
		  $getreview  = Items::getreviewData($user_id);
		  if($getreview !=0)
		  {
			  $review['view'] = Items::getreviewRecord($user_id);
			  $top = 0;
			  $bottom = 0;
			  foreach($review['view'] as $review)
			  {
				 if($review->rating == 1) { $value1 = $review->rating*1; } else { $value1 = 0; }
				 if($review->rating == 2) { $value2 = $review->rating*2; } else { $value2 = 0; }
				 if($review->rating == 3) { $value3 = $review->rating*3; } else { $value3 = 0; }
				 if($review->rating == 4) { $value4 = $review->rating*4; } else { $value4 = 0; }
				 if($review->rating == 5) { $value5 = $review->rating*5; } else { $value5 = 0; }
				 
				 $top += $value1 + $value2 + $value3 + $value4 + $value5;
				 $bottom += $review->rating;
				 
			  }
			  if(!empty(round($top/$bottom)))
			  {
				$count_rating = round($top/$bottom);
			  }
			  else
			  {
				$count_rating = 0;
			  }
			  
			  
			  
		  }
		  else
		  {
			$count_rating = 0;
			$bottom = 0;
		  }
	   
	   $featured_count = Items::getfeaturedUser($user_id);
	   $free_count = Items::getfreeUser($user_id);
	   $tren_count = Items::getTrendUser($user_id);
	  
	   $data = array('user' => $user, 'since' => $since, 'itemData' => $itemData, 'getitemcount' => $getitemcount, 'getsalecount' => $getsalecount, 'count_rating' => $count_rating, 'bottom' => $bottom, 'getreview' => $getreview, 'followcheck' => $followcheck, 'followingcount' => $followingcount, 'followercount' => $followercount, 'badges' => $badges, 'sold_amount' => $sold_amount, 'country' => $country, 'year' => $year, 'collect_amount' => $collect_amount, 'referral_count' => $referral_count, 'featured_count' => $featured_count, 'free_count' => $free_count, 'tren_count' => $tren_count);
	   return view('user')->with($data);
	}
	
	
	public function send_message(Request $request)
	{
	  $message_text = $request->input('message');
	  $from_email = $request->input('from_email');
	  $from_name = $request->input('from_name');
	  $to_email = $request->input('to_email');
	  $to_name = $request->input('to_name');
	  $user_id = $request->input('to_id');
	  $check_email_support = Members::getuserSubscription($user_id);
	  if($check_email_support == 1)
	  {
	  		
		$record = array('message_text' => $message_text, 'from_name' => $from_name);
		Mail::send('user_mail', $record, function($message) use ($from_name, $from_email, $to_email, $to_name) {
			$message->to($to_email, $to_name)
					->subject('New message received');
			$message->from($from_email,$from_name);
		});
		
	   }	
       
        return redirect()->back()->with('success','Your message has been sent successfully');     
		
	
	
	}
	
	
	
	public function update_reset(Request $request)
	{
	
	   $user_token = $request->input('user_token');
	   $password = bcrypt($request->input('password'));
	   $password_confirmation = $request->input('password_confirmation');
	   $data = array("user_token" => $user_token);
	   $value = Members::verifytokenData($data);
	   $user['user'] = Members::gettokenData($user_token);
	   if($value)
	   {
	   
	      $request->validate([
							'password' => 'required|confirmed|min:6',
							
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
		   
		   $record = array('password' => $password);
           Members::updatepasswordData($user_token, $record);
           return redirect('login')->with('success','Your new password updated successfully. Please login now.');
		
		}
	   
	   
	   }
	   else
	   {
              
			  return redirect()->back()->with('error', 'These credentials do not match our records.');
       }
	   
	   
	
	}
	
	
	
	public function update_forgot(Request $request)
	{
	   $email = $request->input('email');
	   
	   $data = array("email"=>$email);
 
       $value = Members::verifycheckData($data);
	   $user['user'] = Members::getemailData($email);
       
	   if($value)
	   {
			
		$user_token = $user['user']->user_token;
		$name = $user['user']->name;
		$sid = 1;
		$setting['setting'] = Settings::editGeneral($sid);
		
		$from_name = $setting['setting']->sender_name;
        $from_email = $setting['setting']->sender_email;
		
		$record = array('user_token' => $user_token);
		Mail::send('forgot_mail', $record, function($message) use ($from_name, $from_email, $email, $name, $user_token) {
			$message->to($email, $name)
					->subject('Forgot Password');
			$message->from($from_email,$from_name);
		});
 
         return redirect('forgot')->with('success','We have e-mailed your password reset link!');     
			  
       }
	   else
	   {
              
			  return redirect()->back()->with('error', 'These credentials do not match our records.');
       }
	   
	  
	   
	   
	   
	}
	
	/* shop */
	
	
	public function view_all_items()
	{
	  /*$itemData['item'] = Items::allitemData();*/
	  $today = date("Y-m-d");
	  $additional['settings'] = Settings::editAdditional();
	  if($additional['settings']->subscription_mode == 1)
	  {
	  $itemData['item'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('users.user_subscr_date','>=',$today)->where('items.item_status','=',1)->where('items.drop_status','=','no')->orderBy('items.item_id', 'asc')->get();
	  }
	  else
	  {
	  $itemData['item'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->orderBy('items.item_id', 'asc')->get();
	  }
	  $catData['item'] = Items::getitemcatData();
	  $category['view'] = Category::with('SubCategory')->where('category_status','=','1')->where('drop_status','=','no')->orderBy('menu_order','asc')->get();
	  
	  return view('shop',[ 'itemData' => $itemData, 'catData' => $catData, 'category' => $category]);
	  
	}
	
	
	public function view_flash_items()
	{
	  $today = date("Y-m-d");
	   $additional['settings'] = Settings::editAdditional();
	   if($additional['settings']->subscription_mode == 1)
	   {
	  $itemData['item'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('users.user_subscr_date','>=',$today)->where('items.item_status','=',1)->where('items.item_flash','=',1)->where('items.drop_status','=','no')->orderBy('items.item_id', 'desc')->get();
	  }
	  else
	  {
	   $itemData['item'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.item_flash','=',1)->where('items.drop_status','=','no')->orderBy('items.item_id', 'desc')->get();
	  }
	  $sid = 1;
	  $setting['setting'] = Settings::editGeneral($sid);
	  
	  if($setting['setting']->site_flash_end_date < date("Y-m-d"))
	  {
	     $data = array('item_flash' => 0);
		 Items::updateFlash($data);
	  }
	  return view('flash-sale',[ 'itemData' => $itemData, 'setting' => $setting]);
	  
	}
	
	
	
	
	
	
	
	public function view_all_list_items()
	{
	  $itemData['item'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->orderBy('items.item_id', 'asc')->get();
	  $catData['item'] = Items::getitemcatData();
	  
	  return view('shop-list',[ 'itemData' => $itemData, 'catData' => $catData]);
	  
	}
	
	
	
	
	public function view_category_types($type,$slug)
	{
	  $today = date("Y-m-d");
	  $additional['settings'] = Settings::editAdditional();
	  if($additional['settings']->subscription_mode == 1)
	  { 
			  if($type == 'item-type')
			  {
				  $itemData['item'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('users.user_subscr_date','>=',$today)->where('items.item_status','=',1)->where('items.drop_status','=','no')->where('items.item_type','=',$slug)->orderBy('items.item_id', 'desc')->get();
			  }
			  else
			  {
				if($type == 'category')
				{
				   $category_data = Category::getcategorysingle($slug);
				   $category_id = $category_data->cat_id;
				}
				else
				{
				  $category_data = Category::getsubcategorysingle($slug);
				  $category_id = $category_data->subcat_id;
				}
				$itemData['item'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('users.user_subscr_date','>=',$today)->where('items.item_status','=',1)->where('items.drop_status','=','no')->where('items.item_category_type','=',$type)->where('items.item_category','=',$category_id)->orderBy('items.item_id', 'desc')->get();
			  }
	   }
	   else
	   {
	         if($type == 'item-type')
			  {
				  $itemData['item'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->where('items.item_type','=',$slug)->orderBy('items.item_id', 'desc')->get();
			  }
			  else
			  {
				if($type == 'category')
				{
				   $category_data = Category::getcategorysingle($slug);
				   $category_id = $category_data->cat_id;
				}
				else
				{
				  $category_data = Category::getsubcategorysingle($slug);
				  $category_id = $category_data->subcat_id;
				}
				$itemData['item'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->where('items.item_category_type','=',$type)->where('items.item_category','=',$category_id)->orderBy('items.item_id', 'desc')->get();
			  }
	   
	   
	   }	  
	  
	  $catData['item'] = Items::getitemcatData();
	  $category['view'] = Category::with('SubCategory')->where('category_status','=','1')->where('drop_status','=','no')->orderBy('menu_order','asc')->get();
	  
	  return view('shop',[ 'itemData' => $itemData, 'catData' => $catData, 'category' => $category]);
	  
	}
	
	
	
	
	
	
	public function view_shop_items(Request $request)
	{
	  $today = date("Y-m-d");
	  $additional['settings'] = Settings::editAdditional();
	  $product_item = $request->input('product_item');
	  if(!empty($request->input('category_names')))
	   {
	      
		  $category_no = "";
		  foreach($request->input('category_names') as $category_value)
		  {
		     $category_no .= $category_value.',';
		  }
		  $category_names = rtrim($category_no,",");
		  
	   }
	   else
	   {
	     $category_names = "";
	   }
	  if(!empty($request->input('item_type')))
	   {
	      
		  $itemtype = "";
		  foreach($request->input('item_type') as $item_type)
		  {
		     $itemtype .= $item_type.',';
		  }
		  $item_types = rtrim($itemtype,",");
		  
	   }
	   else
	   {
	     $item_types = "";
	   } 
	  if(!empty($request->input('orderby')))
	  { 
	  $orderby = $request->input('orderby');
	  }
	  else
	  {
	  $orderby = "desc";
	  }
	  $min_price = $request->input('min_price');
	  $max_price = $request->input('max_price'); 
	  if($product_item != "" ||  $orderby != "" || $min_price != "" || $max_price != "")
	  {
	  
	  
		  if($additional['settings']->subscription_mode == 1)
		  {
			  $itemData['item'] = Items::with('ratings')
							  ->leftjoin('users', 'users.id', '=', 'items.user_id')
							  ->where('users.user_subscr_date','>=',$today)
							  ->where('items.item_status','=',1)
							  ->where('items.drop_status','=','no')
							  ->where(function ($query) use ($product_item,$orderby,$min_price,$max_price,$item_types,$category_names) { 
							  $query->where('items.item_name', 'LIKE', "%$product_item%");
							  if ($min_price != "" || $max_price != "")
							  {
							  $query->where('items.regular_price', '>', $min_price);
							  $query->where('items.regular_price', '<', $max_price);
							  }
							  if ($item_types != "")
							  {
							  $query->whereRaw('FIND_IN_SET(items.item_type,"'.$item_types.'")');
							  }
							  if ($category_names != "")
							  {
							  $query->whereRaw('FIND_IN_SET(items.item_type_cat_id,"'.$category_names.'")');
							  }
							  })->orderBy('items.regular_price', $orderby)->get();
			}
			else
			{
				$itemData['item'] = Items::with('ratings')
							  ->leftjoin('users', 'users.id', '=', 'items.user_id')
							  ->where('items.item_status','=',1)
							  ->where('items.drop_status','=','no')
							  ->where(function ($query) use ($product_item,$orderby,$min_price,$max_price,$item_types,$category_names) { 
							  $query->where('items.item_name', 'LIKE', "%$product_item%");
							  if ($min_price != "" || $max_price != "")
							  {
							  $query->where('items.regular_price', '>', $min_price);
							  $query->where('items.regular_price', '<', $max_price);
							  }
							  if ($item_types != "")
							  {
							  $query->whereRaw('FIND_IN_SET(items.item_type,"'.$item_types.'")');
							  }
							  if ($category_names != "")
							  {
							  $query->whereRaw('FIND_IN_SET(items.item_type_cat_id,"'.$category_names.'")');
							  }
							  })->orderBy('items.regular_price', $orderby)->get();
			}				  
							  
						  
	  }
	  else
	  {
	   	
		  if($additional['settings']->subscription_mode == 1)
		  {   
	       $itemData['item'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('users.user_subscr_date','>=',$today)->where('items.item_status','=',1)->where('items.drop_status','=','no')->orderBy('items.item_id', 'asc')->get();     
		  }
		  else
		  {
		    $itemData['item'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->orderBy('items.item_id', 'asc')->get();
		  } 
	   
	  }
	 	 
	 
	$category['view'] = Category::with('SubCategory')->where('category_status','=','1')->where('drop_status','=','no')->orderBy('menu_order','asc')->get();
	$type = "";
	$meta_keyword = "";
	$meta_desc = "";
	
	return view('shop',[ 'itemData' => $itemData, 'category' => $category, 'type' => $type, 'meta_keyword' => $meta_keyword, 'meta_desc' => $meta_desc]);
	}
	
	
	
	
	
	/*public function view_shop_items(Request $request)
	{
	  
	 if(!empty($request->input('product_item')))
	 {
	 $product_item = $request->input('product_item');
	 
	 $itemData['item'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->where('items.item_name', 'LIKE', "%$product_item%")->orderBy('items.item_id', 'desc')->get();
	   
	 } 
	 else if(!empty($request->input('category')))
	 {
	 
	 $category = $request->input('category');
	 $split = explode("_", $category);
	 $cat_id = $split[1];
	 $cat_name = $split[0];
	 
	 
	 $itemData['item'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->where('items.item_category','=',$cat_id)->where('items.item_category_type','=',$cat_name)->orderBy('items.item_id', 'desc')->get();
	 }
	 else if(!empty($request->input('product_item')) && !empty($request->input('category')))
	 {
	    $product_item = $request->input('product_item');
		$category = $request->input('category');
		 $split = explode("_", $category);
		 $cat_id = $split[1];
		 $cat_name = $split[0];
		 $itemData['item'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->where('items.item_name', 'LIKE', "%$product_item%")->where('items.item_category','=',$cat_id)->where('items.item_category_type','=',$cat_name)->orderBy('items.item_id', 'desc')->get();
	 }
	 else
	 {
	   $itemData['item'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->orderBy('items.item_id', 'desc')->get();;
	 }
	 
	 $catData['item'] = Items::getitemcatData();
	
	return view('shop',[ 'itemData' => $itemData, 'catData' => $catData]);
	}*/
	/* shop */
	
	
	/* item */
	
	
	public function view_single_item($item_slug)
	{
	  
	  $sid = 1;
	  $badges['setting'] = Settings::editBadges($sid);
	  $check_if_item = Items::AgainData($item_slug);
	  
	  if($check_if_item != 0)
	  {
	      $item['item'] = Items::singleitemData($item_slug);
		  $view_count = $item['item']->item_views + 1;
		  $count_data = array('item_views' => $view_count);
		  $item_id = $item['item']->item_id;
		  Items::updatefavouriteData($item_id,$count_data);
		  $membership = date('m/d/Y',strtotime($item['item']->created_at));
		  $membership_date = explode("/", $membership);
		  $year = (date("md", date("U", mktime(0, 0, 0, $membership_date[0], $membership_date[1], $membership_date[2]))) > date("md")
			? ((date("Y") - $membership_date[2]) - 1)
			: (date("Y") - $membership_date[2]));
		  
		  $token = $item['item']->item_token;
		  $trends = Items::trendsCount($token);
		  $item_cat_id = $item['item']->item_category;
		  $item_user_id = $item['item']->user_id;
		  $item_cat_type = $item['item']->item_category_type;
		  $country['view'] = Settings::editCountry($item['item']->country);
		  
		  $sold['item'] = Items::SoldAmount($item_user_id);
		  $sold_amount = 0;
		  foreach($sold['item'] as $iter)
		  {
			$sold_amount += $iter->total_price;
		  }
		  $collect_amount = Items::CollectedAmount($item_user_id);
		  $referral_count = $item['item']->referral_count;
		  
		  
		  
		  if($item_cat_type == 'category')
		  {
			 $category['name'] = Category::getsinglecatData($item_cat_id);
			 $category_name = $category['name']->category_name;
		  }
		  else if($item_cat_type == 'subcategory')
		  {
			$category['name'] = SubCategory::getsinglesubcatData($item_cat_id);
			$category_name = $category['name']->subcategory_name;
		  }
		  else
		  {
			$category_name = "";
		  }
		  
		  $item_tags = explode(',',$item['item']->item_tags);
		  
		  $getcount  = Items::getimagesCount($token);
		  $item_image['item'] = Items::getsingleimagesData($token);
		  $item_allimage = Items::getimagesData($token);
		  $itemData['item'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->where('items.user_id','=',$item_user_id)->where('items.item_id','!=',$item_id)->orderBy('items.item_id', 'asc')->take(3)->get();
		  
		  if (Auth::check()) 
		  {
		  $checkif_purchased = Items::ifpurchaseCount($token);
		  }
		  else
		  {
			$checkif_purchased = 0;
		  }
		  
		  $getreview  = Items::getreviewCount($item_id);
		  if($getreview !=0)
		  {
			  $review['view'] = Items::getreviewView($item_id);
			  $top = 0;
			  $bottom = 0;
			  foreach($review['view'] as $review)
			  {
				 if($review->rating == 1) { $value1 = $review->rating*1; } else { $value1 = 0; }
				 if($review->rating == 2) { $value2 = $review->rating*2; } else { $value2 = 0; }
				 if($review->rating == 3) { $value3 = $review->rating*3; } else { $value3 = 0; }
				 if($review->rating == 4) { $value4 = $review->rating*4; } else { $value4 = 0; }
				 if($review->rating == 5) { $value5 = $review->rating*5; } else { $value5 = 0; }
				 
				 $top += $value1 + $value2 + $value3 + $value4 + $value5;
				 $bottom += $review->rating;
				 
			  }
			  if(!empty(round($top/$bottom)))
			  {
				$count_rating = round($top/$bottom);
			  }
			  else
			  {
				$count_rating = 0;
			  }
			  
			  
			  
		  }
		  else
		  {
			$count_rating = 0;
		  }
		  
		  $getreviewdata['view']  = Items::getreviewItems($item_id);
		  
			  
		  $comment['view'] = Comment::with('ReplyComment')->leftjoin('users', 'users.id', '=', 'item_comments.comm_user_id')->where('item_comments.comm_item_id','=',$item_id)->orderBy('comm_id', 'asc')->get();
		  
		  $comment_count = $comment['view']->count();
		  
		   
		   $viewattribute['details'] = Attribute::getattributeViews($token);
		   $setting['setting'] = Settings::editGeneral($sid);
		  $page_slug = $setting['setting']->item_support_link;
		  $page['view'] = Pages::editpageData($page_slug);
		  
		  $related['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->where('items.user_id','=',$item_user_id)->where('items.item_id','!=',$item_id)->orderBy('items.item_id', 'desc')->inRandomOrder()->take(4)->get();

		  $relatedbycategory['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->where('items.item_id','!=',$item_id)->where('items.user_id','!=',$item_user_id)->where('items.item_id','!=',$item_id)->orderBy('items.item_id', 'desc')->inRandomOrder()->take(4)->get();

		  $data = array('item' => $item, 'getcount' => $getcount, 'item_image' => $item_image, 'item_allimage' => $item_allimage, 'category_name' => $category_name, 'item_tags' => $item_tags, 'itemData' => $itemData, 'checkif_purchased' => $checkif_purchased, 'getreview' => $getreview, 'count_rating' => $count_rating, 'getreviewdata' => $getreviewdata, 'comment' => $comment, 'comment_count' => $comment_count, 'badges' => $badges, 'country' => $country, 'trends' => $trends, 'year' => $year, 'sold_amount' => $sold_amount, 'collect_amount' => $collect_amount, 'referral_count' => $referral_count, 'viewattribute' => $viewattribute, 'item_slug' => $item_slug, 'page' => $page, 'related' => $related, 'check_if_item' => $check_if_item, 'relatedbycategory' => $relatedbycategory);
		 }
		 else
		 {
		    $data = array('check_if_item' => $check_if_item);
		 } 

//echo  '<pre>';print_r($data);die;
	     return view('item')->with($data);
	}
	
	
	/* item */
	
	
	/* contact */
	
	public function update_contact(Request $request)
	{
	
	  $from_name = $request->input('from_name');
	  $from_email = $request->input('from_email');
	  $message_text = $request->input('message_text');
	  $sid = 1;
	  $setting['setting'] = Settings::editGeneral($sid);
	  $admin_name = $setting['setting']->sender_name;
	  $admin_email = $setting['setting']->sender_email;
	  
	  $record = array('from_name' => $from_name, 'from_email' => $from_email, 'message_text' => $message_text, 'contact_date' => date('Y-m-d'));
	  $contact_count = Items::getcontactCount($from_email);
	  if($contact_count == 0)
	  {
	  
	     $request->validate([
							'from_name' => 'required',
							'from_email' => 'required|email',
							'message_text' => 'required',
							'g-recaptcha-response' => 'required|captcha',
							
							
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
	  
	  
			  Items::saveContact($record);
			  Mail::send('contact_mail', $record, function($message) use ($admin_name, $admin_email, $from_email, $from_name) {
						$message->to($admin_email, $admin_name)
								->subject('Contact');
						$message->from($from_email,$from_name);
					});
			  return redirect()->back()->with('success','Your message has been sent successfully');
			  
		}	  
			  
	  }
	  else
	  {
	  return redirect()->back()->with('error','Sorry! Your message already sent');
	  }
	  
	  
	
	}
	
	/* contact */
	
	
	/* newsletter */
	
	public function generateRandomString($length = 25) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
	return $randomString;
    }
	
	
	public function activate_newsletter($token)
	{
	   
	   $check = Members::checkNewsletter($token);
	   if($check == 1)
	   {
	      
		  $data = array('news_status' => 1);
		
		  Members::updateNewsletter($token,$data);
		  
		  return redirect('/newsletter')->with('success', 'Thank You! Your subscription has been confirmed!');
		  
	   }
	   else
	   {
	       return redirect('/newsletter')->with('error', 'This email address already subscribed');
	   }
	
	}
	
	
	public function view_newsletter()
	{
	 
	  return view('newsletter');
	
	}
	
	
	public function update_newsletter(Request $request)
	{
	
	   $news_email = $request->input('news_email');
	   $news_status = 0;
	   $news_token = $this->generateRandomString();
	   
	   $request->validate([
							
							'news_email' => 'required|email',
							
							
							
         ]);
		 $rules = array(
		 
		      'news_email' => ['required',  Rule::unique('newsletter') -> where(function($sql){ $sql->where('news_status','=',0);})],
								
	     );
		 
		 $messsages = array(
		      
	    );
		 
		$validator = Validator::make($request->all(), $rules,$messsages);
		
		if ($validator->fails()) 
		{
		 $failedRules = $validator->failed();
		 /*return back()->withErrors($validator);*/
		 return redirect()->back()->with('error', 'This email address already subscribed.');
		} 
		else
		{
		
		
		$data = array('news_email' => $news_email, 'news_token' => $news_token, 'news_status' => $news_status);
		
		Members::savenewsletterData($data);
		
		$sid = 1;
		$setting['setting'] = Settings::editGeneral($sid);
		
		$from_name = $setting['setting']->sender_name;
        $from_email = $setting['setting']->sender_email;
		$activate_url = URL::to('/newsletter').'/'.$news_token;
		
		$record = array('activate_url' => $activate_url);
		Mail::send('newsletter_mail', $record, function($message) use ($from_name, $from_email, $news_email) {
			$message->to($news_email)
					->subject('Newsletter');
			$message->from($from_email,$from_name);
		});
		
			   
		return redirect()->back()->with('success', 'Your email address subscribed. You will receive a confirmation email.');
		
		}
	   
	
	}
	
	
	
	/* newsletter */
	
	
	
	
}
