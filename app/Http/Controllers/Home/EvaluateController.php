<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\OrderModel;
use App\EvaluateModel;

class EvaluateController extends Controller
{
    /**
     * Display a listing of the resource.
     *  用户管理里面的评价
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$uid=session('USER')['uid'];
    	$evaluate=EvaluateModel::where('uid',$uid)->paginate(5);
    	//dump($evaluate[0]->goods);exit;
    	return view('home/uevaluate')->with('evaluate',$evaluate);
    }

    

    /**
     * Store a newly created resource in storage.
     * 提交评价
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
    	$uid=session('USER')['uid'];
    	$data=$request->input('data');
       foreach ($data as $da){
       	$evalute=new EvaluateModel();
       	$date=new \DateTime();
       	$evalute->uid=$uid;
       $evalute->gid=$da['gid'];
       $evalute->evascore=$da['radio'];
       $evalute->evadescript=$da['text'];
       $evalute->evatime=$date->format('Y-m-d H:i:s');
       $evalute->save();
       }
       return response()->json([
       		'status'=>1
       ]);
    }

    /**
     * Display the specified resource.
     *  显示要评价的商品界面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $uid=session('USER')['uid'];
    	$goodList=OrderModel::where('uid',$uid)->where('oid',$id)->first()->orderDetail;
    	//dump($goodList);exit;
        return  view('home/evaluate')->with('goodList',$goodList);
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

    /**
     * Remove the specified resource from storage.
     * 删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $uid=session('USER')['uid'];
        EvaluateModel::where('uid',$uid)->where('gid',$id)->delete();
        redirect('home/evaluate')->send();
    }
}
