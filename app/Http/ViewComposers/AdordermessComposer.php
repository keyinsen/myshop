<?php
namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\AdminModel\AdminModel;
use App\OrderModel;
use App\MessageModel;

class AdordermessComposer
{
	public function  __construct()
	{
		
	}	
	
	public function compose(View $view)
	{
		$aid=session('Admin')['aid'];
		$aname=session('Admin')['nickname'];
		//待发货
    	$worderList=OrderModel::where('osid',2)->where('gsid',1)->get();
    	$mess=MessageModel::where('receiveid',$aid)->where('receivename',$aname)->where('state',0)->get();
		//dump($role_id);exit;
    	$mess1=count($mess);
    	$ordercount=count($worderList);
		$view->with('ordercount',$ordercount)->with('mess1',$mess1);
	}
}
