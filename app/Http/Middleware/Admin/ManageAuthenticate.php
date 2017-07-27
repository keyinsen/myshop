<?php

namespace App\Http\Middleware\Admin;

use Closure;
use App\AdminModel\AdminModel;

class ManageAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
    	if(!empty(session('Admin'))){
    		//如果验证通过继续执行所要进的页面
    		$admin_id=session('Admin')['admin_id'];
    		$role_id=AdminModel::where('admin_id',$admin_id)->first()->role->role_id;
    		if($role_id==1){
    			return $next($request);
    		}else{
    			redirect(url('admin/index'))->send();
    		}
    		
    	}else{
    		 
    		redirect(url('admin/login'))->send();
    	}
    }
}
