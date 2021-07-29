<?php

namespace Fickrr\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Fickrr\Http\Controllers\Controller;
use Fickrr\Models\Settings;
use Fickrr\Models\Items;
use Fickrr\Models\Members;
use Fickrr\Models\Pages;
use Fickrr\Models\Blog;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
		
    }
    public function admin()
    {
        
		$sid = 1;
		$setting['setting'] = Settings::editGeneral($sid);
		
		$today = date('d F Y');
		$first_day = date('d F Y', strtotime('-1 days'));
		$second_day = date('d F Y', strtotime('-2 days'));
		$third_day = date('d F Y', strtotime('-3 days'));
		$fourth_day = date('d F Y', strtotime('-4 days'));
		$fifth_day = date('d F Y', strtotime('-5 days'));
		$sixth_day = date('d F Y', strtotime('-6 days'));
		
		$data1 = date('Y-m-d');
		$data2 = date('Y-m-d', strtotime('-1 days'));
		$data3 = date('Y-m-d', strtotime('-2 days'));
		$data4 = date('Y-m-d', strtotime('-3 days'));
		$data5 = date('Y-m-d', strtotime('-4 days'));
		$data6 = date('Y-m-d', strtotime('-5 days'));
		$data7 = date('Y-m-d', strtotime('-6 days'));
		
		$view1 = Items::orderdataCheck($data1);
		$view2 = Items::orderdataCheck($data2);
		$view3 = Items::orderdataCheck($data3);
		$view4 = Items::orderdataCheck($data4);
		$view5 = Items::orderdataCheck($data5);
		$view6 = Items::orderdataCheck($data6);
		$view7 = Items::orderdataCheck($data7);
		
		$approved = Items::itemapprovedCheck(1);
		$unapproved = Items::itemapprovedCheck(0);
		$rejected = Items::itemapprovedCheck(2);
		$totalvendor = Members::getmemberData();
		$totalpages = Pages::totalpageData();
		$totalorder = Items::totalorderData();
		$totalitems = Items::totalitemCheck();
		$totalpost = Blog::totalblogData();
		$itemcomment = Items::totalitemcommentCheck();
		
		return view('admin.index', [ 'setting' => $setting, 'today' => $today, 'first_day' => $first_day, 'second_day' => $second_day, 'third_day' => $third_day, 'fourth_day' => $fourth_day, 'fifth_day' => $fifth_day, 'sixth_day' => $sixth_day, 'view1' => $view1, 'view2' => $view2, 'view3' => $view3, 'view4' => $view4, 'view5' => $view5, 'view6' => $view6, 'view7' => $view7, 'approved' => $approved, 'unapproved' => $unapproved, 'rejected' => $rejected, 'totalvendor' => $totalvendor, 'totalpages' => $totalpages, 'totalorder' => $totalorder, 'totalitems' => $totalitems, 'totalpost' => $totalpost, 'itemcomment' => $itemcomment]);
		
		
    }
}
