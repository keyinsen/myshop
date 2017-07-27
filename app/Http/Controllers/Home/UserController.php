<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\UserModel;
use App\CartModel;
use App\Http\Requests\UserValidate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	if(!empty(session('USER'))){
    		$uid=session('USER')['uid'];
    		//清除掉密码输入错误的提示
    		$request->session()->put('pwderror','');
        	$userinfo=UserModel::where('uid',$uid)->first();
        	return view('home/uperinfo')->with('userinfo',$userinfo);
    	}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Store a newly created resource in storage.
     * 显示账户余额
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function menory()
    {
    	 if(!empty(session('USER'))){
    	 	$uid=session('USER')['uid'];
    	 $userinfo=UserModel::where('uid',$uid)->first();
        	return view('home/umenory')->with('userinfo',$userinfo);
    	 }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *  信息修改
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
   	 if(!empty(session('USER'))){
    		$uid=session('USER')['uid'];
    		$update=UserModel::where('uid',$uid)->update($request->input());
    	
    		$request->session()->put('filename','');
    		if($update){
    			return response()->json([
    				'status'=>1,
    			
    			]);
    		}else{
    			return response()->json([
    					'status'=>-1,
    					 
    			]);
    		}
    	}
    }

    /**
     * Update the specified resource in storage.
     * 显示修改密码的界面信息
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pwd()
    {
    	if(!empty(session('USER'))){
    		return view('home/usafe');
    	}
    	
    }

     /**
     * Update the specified resource in storage.
     * 执行修改密码
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pwdEdit(UserValidate $request)
    {
    	if(!empty(session('USER'))){
    		$uid=session('USER')['uid'];
    		//原始密码
    		$pwd=$request->input('pwd');
    		$newpwd=$request->input('password');
    		$user=UserModel::where('uid',$uid)->where('password',$pwd)->first();
    		if(count($user)==0){
    			$request->session()->put('pwderror','你输入的原始密码是错的哦');
    			redirect('home/pwd')->send();
    		}else{
    			$data=['password'=>$newpwd];
    			$update=UserModel::where('uid',$uid)->update($data);
    			if($update){
    				$request->session()->put('pwderror','');
    				$request->session()->put('USER','');
    				redirect('home/index')->send();
    			}
    		}
    	}
    	
    }
}
