<?php

namespace App\Http\Middleware\Admin;

use Closure;

class Authenticate
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
    		return $next($request);
    	}else{
    	
    		redirect(url('admin/login'))->send();
    	}
    }
}
