<?php
namespace App\Http\ViewComposers;


use Illuminate\Contracts\View\View;
use App\UserModel;

class UserComposer
{
	public function  __construct()
	{
		
	}	
	
	public function compose(View $view)
	{
		if(!empty(session('USER'))){
			$uid=session('USER')['uid'];
			$userinfo=UserModel::where('uid',$uid)->first();
			$view->with('userinfo',$userinfo);
			//return view('home/uperinfo')->with('userinfo',$userinfo);
		}
	}
}
