<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\AdminModel\AdminModel;
use App\MessageModel;
use Illuminate\Support\Facades\DB;
use App\UserModel;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	//用户留言信息
    public function index()
    {
    	$aid=session('Admin')['aid'];
    	$aname=session('Admin')['nickname'];
    	//接收人对应的发送人 是 1对多得关系，所以根据发送人的id 来进行降序
    	$mess=MessageModel::where('receiveid',$aid)->where('receivename',$aname)->orderBy('sendid','desc')->orderBy('sendtime','desc')->get();
        return view('admin/message')->with('mess',$mess);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$message=new MessageModel();
    	$message->sendid=session('Admin')['aid'];
     	$message->sendname=session('Admin')['nickname'];
     	$message->receiveid=$request->input('receiveid');
     	$message->receivename=$request->input('receivename');
     	$message->ctmess=$request->input('mess');
       	$date=new \DateTime();
       	$message->sendtime=$date->format('Y-m-d H:i:s');
       	$message->save();
       	redirect('admin/message/'.$message->receiveid)->send();
    }

    /**
     * Display the specified resource.
     *  留言界面显示与某个用户的留言消息
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$aid=session('Admin')['aid'];
    	$aname=AdminModel::where('aid',$aid)->first();
    	$result=UserModel::where('uid',$id)->first();
    	if(!empty($result)){
    		$user=$result;
    	}else{
    		redirect('admin/index')->send();
    	}
    	MessageModel::where('receiveid',$aid)->where('receivename',$aname->nickname)->update(['state'=>1]);
    	$sql='select * from shop_message where (sendid=? and receiveid=?) or (sendid=? and receiveid=?) order by sendtime '; 
    	$mess=DB::select($sql,[$aid,$user->uid,$user->uid,$aid]);
        return view('admin/messageui')->with('user',$user)
        ->with('mess',$mess);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //用户留言信息删除
    public function destroy($id)
    {
    	//dump($id);exit;
    	$admin_id=session('Admin')['aid'];
    	//获取要删除的用户id
        $uid=$id;
        $sql='delete from shop_message where (sendid=? and receiveid=?) or (sendid=? and receiveid=?)';
        DB::select($sql,[$uid,$admin_id,$admin_id,$uid]);
        redirect('admin/message')->send();
    }
}