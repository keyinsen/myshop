<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\AdminModel\AdminModel;

class ManageController extends Controller
{
    /**
     * Display a listing of the resource.
     * 系统管理员对普通管理员的管理界面信息
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //$role=RoleModel::all();
    	$manageList=AdminModel::where('role_id',2)->get();
    	//dump($role);exit;
        return view('admin/power')->with('manageList',$manageList);
    }

    /**
     * Show the form for creating a new resource.
     * 恢复停用
     * @return \Illuminate\Http\Response
     */
    public function huifu(Request $request,$id)
    {
    	AdminModel::where('admin_id',$id)->update(['deleted_at'=>0]);
    	redirect('admin/manage')->send();
    }

    /**
     * Store a newly created resource in storage.
     *  新增管理员
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       	
      $aname=$request->input('aname');
      //$pwd=$request->input('aname');
      $is=AdminModel::where('aname',$aname)->get();
      if(count($is)>0){
      	redirect('admin/manage')->with('manageerror','刚才新增账户已存在！')->send();
      }else{
      	//dump($request->except('_token'));exit;
      	
      	$admin=new AdminModel();
      	$date=new \DateTime();
      	$time=$date->format('YmdHis');
      	$admin->aid=$time;
      	$admin->password=$request->input('password');
      	$admin->aname=$request->input('aname');
      	$admin->nickname=$request->input('nickname');
      	$admin->save();
      	redirect('admin/manage')->send();
      }
        
    }


    /**
     * Show the form for editing the specified resource.
     *  显示要修改普通管理员信息
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $editList=AdminModel::where('admin_id',$id)->first();
       //$role=RoleModel::all();
       $manageList=AdminModel::where('role_id',2)->get();
       //dump($role);exit;
       return view('admin/power')->with('manageList',$manageList)
       ->with('editList',$editList);
    }

    /**
     * Update the specified resource in storage.
     *  执行修改普通管理员信息
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       AdminModel::where('admin_id',$id)->update($request->except('_token','_method'));
       redirect('admin/manage')->send();
    }

    /**
     * Remove the specified resource from storage.
     * 删除 管理员
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function del(Request $request)
    {
    	$removeid=explode('_', $request->input('removeid'));
    	$array=array();
    	
    	
    	foreach ($removeid as $re){
    		array_push($array, $re);
    	}
    	$relut=AdminModel::whereIn('admin_id',$array)->update(['deleted_at'=>1]);
    	if($relut>0){
    		return  response()->json([
    			'status'=>1	
    		]);
    	}
    	//redirect('admin/manage');
    	//dump($removeid);
    	
    }
}
