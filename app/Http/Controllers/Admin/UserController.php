<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\UserModel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$userList=UserModel::paginate(7);
        return view('admin/user')->with('userList',$userList);
    }

   //新增用户界面显示
    public function create()
    {
        return view('admin/useradd');
    }
   //查询用户信息
    public function searchuser(Request $request)
    {
    	$user=$request->input('user');
    	$userList=array();
    	if(!ctype_space($user)&&!empty($user)){
    		$userList=UserModel::where('uid',$user)->orWhere('uname',$user)->paginate(7);
    		return view('admin/user')->with('userList',$userList);
    	}
    	return view('admin/user')->with('userList',$userList);
    }

   //新增用户
    public function store(Request $request)
    {
    	$username=$request->input('uname');
    	$row=UserModel::where('uname',$username)->select('uid')->get();
    	if($row){
    		$user=new UserModel($request->input());
    		$re=$user->save();
    	}
    	redirect('admin/user')->send();
    }


    //恢复删除的用户
    
   public function huifu($id){
   		UserModel::where('uid',$id)->update(['deleted_at'=>0]);
   		redirect('admin/user')->send();
   }
   
   //指定某个用户的修改信息界面
    public function edit($id)
    {
    	
        $editList=UserModel::where('uid',$id)->first();
        return view('admin/useradd')->with('editList',$editList);
    }

   //更新用户信息
    public function update(Request $request, $id)
    {
       $re=UserModel::where('uid',$id)->update($request->except('_token','_method'));
      // dump($re);exit;
       if($re!=0){
       	redirect('admin/user')->send();
       }else{
       	redirect('admin/user')->with('userror','之前操作你并没有做任何修改')->send();
       }
    }

    //删除用户信息
    public function del(Request $request)
    {
    $removeid=explode('_', $request->input('removeid'));
    	$array=array();
    	
    	
    	foreach ($removeid as $re){
    		array_push($array, $re);
    	}
    	$relut=UserModel::whereIn('uid',$array)->update(['deleted_at'=>1]);
    	if($relut>0){
    		return  response()->json([
    			'status'=>1	
    		]);
    	}
    }
}
