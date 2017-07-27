<?php
namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\AdminModel\AdminModel;

class ManagesComposer
{
	public function  __construct()
	{
		
	}	
	
	public function compose(View $view)
	{
		$admin_id=session('Admin')['admin_id'];
		$role_id=AdminModel::where('admin_id',$admin_id)->first()->role->role_id;
		//dump($role_id);exit;
		
		$view->with('role_id',$role_id);
	}
}
