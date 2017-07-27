<?php
namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\UserModel;
use App\CartModel;
use App\MessageModel;

class HeadComposer
{
	public function  __construct()
	{
		
	}	
	
	public function compose(View $view)
	{
		$cartList='';
		$mess=-1;
		if(!empty(session('USER'))){
			$uid=session('USER')['uid'];
			$cartList=CartModel::where('uid',$uid)->limit(5)->get();
			
			$uname=session('USER')['uname'];
			$mess=MessageModel::where('receiveid',$uid)->where('receivename',$uname)->where('state',0)->get();
			$mess=count($mess);
		}
		//dump($cartList);exit;
		//dump(count($cartList));exit;
		$view->with('cartList',$cartList)->with('mess',$mess);
	}
}