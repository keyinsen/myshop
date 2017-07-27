<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\AdminModel\AdminModel;
use App\Http\Requests\AdminperValidate;
use App\Http\Requests\UserValidate;
use App\AdminModel\RoleModel;
use App\MessageModel;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$admin_id=session('Admin')['admin_id'];
        $admininfo=AdminModel::where('admin_id',$admin_id)->first();
        //dump($admininfo->role);exit;
        return view('admin/perinfo')->with('admininfo',$admininfo);
    }


    
    /**
     * Show the form for editing the specified resource.
     *
     * 个人密码修改 显示界面
     * @return \Illuminate\Http\Response
     */
    public function persafe()
    {
    	return view('admin/safe');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     *  执行个人密码修改
     * @return \Illuminate\Http\Response
     */
    public function safe(UserValidate $request)
    {
    	$admin_id=session('Admin')['admin_id'];
    	$pwd=$request->input('pwd');
    	$newpwd=$request->input('password');
    		$is_admin=AdminModel::where('admin_id',$admin_id)
    		->where('password',$pwd)->get();
    		if(count($is_admin)==1){
    			$is_update=AdminModel::where('admin_id',$admin_id)->update(['password'=>$newpwd]);
    			if(!$is_update){
    				 redirect('admin/persafe')->with('safeerror','你输入的新密码与原始密码一致，无需修改')->send();
    			}else{
    				$request->session()->put('safeerror','');
    				$request->session()->put('Admin','');
    				return view('admin/login');
    			}
    		}else{
    			redirect('admin/persafe')->with('safeerror','你输入的原始密码有误')->send();
    		}
    }

    /**
     * Update the specified resource in storage.
     *  个人信息修改
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function perupdate(AdminperValidate $request)
    {
        $admin_id=session('Admin')['admin_id'];
        $aid=session('Admin')['aid'];
        $nickname=$request->input('nickname');
        $image=$request->input('image');
        $result=AdminModel::where('admin_id',$admin_id)->update([
        		'nickname'=>$nickname,
        		'image'=>$image	
        ]);
        MessageModel::where('receiveid',$aid)->update(['receivename'=>$nickname]);
        MessageModel::where('sendid',$aid)->update(['sendname'=>$nickname]);
        $user=AdminModel::where('admin_id',$admin_id)->get();
        if($result>0){
        	$request->session()->put('Admin',$user[0]->toArray());
        	redirect('admin/perinfo')->send();
        }else{
        	redirect('admin/perinfo')->send();
        }
    }


}
