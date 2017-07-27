<?php

namespace App\Http\Controllers\Home;

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
    public function index()
    {
    	
    	$uid=session('USER')['uid'];
    	$uname=session('USER')['uname'];
    	//获取通过接受者id和接收者账户
    	$mess=MessageModel::where('receiveid',$uid)->where('receivename',$uname)->orderBy('sendtime','desc')->get();
        return view('home/umessage')->with('mess',$mess);
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
    	$message->sendid=session('USER')['uid'];
     	$message->sendname=session('USER')['uname'];
     	$message->receiveid=$request->input('receiveid');
     	$message->receivename=$request->input('receivename');
     	$message->ctmess=$request->input('mess');
       	$date=new \DateTime();
       	$message->sendtime=$date->format('Y-m-d H:i:s');
       	$message->save();
       	redirect('home/message/'.$request->input('admin_id'))->send();
    }

    /**
     * Display the specified resource.
     *  显示留言界面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$uid=session('USER')['uid'];
    	$uname=UserModel::where('uid',$uid)->first();
    	$result=AdminModel::where('admin_id',$id)->orWhere('aid',$id)->first();
    	if(!empty($result)){
    		$admin=$result;
    	}else{
    		redirect('home/index')->send();
    	}
    	//在用户里，接收人当前用户的Id + 用户的账号来更新 ，表示当前用户查看了消息
    	MessageModel::where('receiveid',$uid)->where('receivename',$uname->uname)->update(['state'=>1]);
    	$sql='select * from shop_message where (sendid=? and receiveid=?) or (sendid=? and receiveid=?) order by sendtime '; 
    	$mess=DB::select($sql,[$uid,$admin->aid,$admin->aid,$uid]);
        return view('home/umessageui')->with('admin',$admin)
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
        //
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
        //
    }

    //删除
    public function destroy($id)
    {
    	$uid=session('USER')['uid'];
        $admin_id=$id;
        $sql='delete from shop_message where (sendid=? and receiveid=?) or (sendid=? and receiveid=?)';
        DB::select($sql,[$uid,$admin_id,$admin_id,$uid]);
        redirect('home/message')->send();
    }
}
