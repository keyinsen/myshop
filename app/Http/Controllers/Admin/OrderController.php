<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\OrderModel;
use App\OrderDetailModel;
use App\GoodsModel;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
	//订单显示
    public function index()
    {
    	//全部订单
    	$orderList=OrderModel::paginate(10);
    	//未付款
    	$norderList=OrderModel::where('osid',1)->paginate(10);
    	//待发货
    	$worderList=OrderModel::where('osid',2)->where('gsid',1)->paginate(10);
    	//待签收
    	$rworderList=OrderModel::where('gsid',2)->paginate(10);
    	//已取消
    	$corderList=OrderModel::where('osid',3)->paginate(10);
    	//交易完成
    	$rorderList=OrderModel::where('osid',4)->where('gsid',2)->paginate(10);
        return  view('admin/order')->with('orderList',$orderList)
        ->with('norderList',$norderList)->with('worderList',$worderList)
        ->with('rorderList',$rorderList)->with('corderList',$corderList)
        ->with('rworderList',$rworderList);
    }

    /**
     * Show the form for creating a new resource.
     *  执行 发货
     * @return \Illuminate\Http\Response
     */
    public function sendGoods(Request $request)
    {
    	$oid=$request->input('oid');
    	$time=new \DateTime();
    	$datetime=$time->format('Y-m-d H:i:s');
    	$update=OrderModel::where('oid',$oid)->update(['gsid'=>2,'sendtime'=>$datetime]);
    	if($update){
    		return response()->json(['status'=>1]);
    	}
    }
    
    /**
     * Store a newly created resource in storage.
     * 订单查询
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkorder(Request $request)
    {
    	//只显示一条订单
    	$norderList=array();
    	$worderList=array();
    	$corderList=array();
    	$rworderList=array();
    	$rorderList=array();
    	$orderList=array();
    	$ocode=$request->input('orderid');
    	$orderList=OrderModel::where('ocode',$ocode)->get();
    	 return  view('admin/order')->with('orderList',$orderList)
        ->with('norderList',$norderList)->with('worderList',$worderList)
        ->with('rorderList',$rorderList)->with('corderList',$corderList)
        ->with('rworderList',$rworderList);
    }

    /**
     * Store a newly created resource in storage.
     * 更新已签收
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Sign(Request $request)
    {
    	$oid=$request->input('oid');
    	$update=OrderModel::where('oid',$oid)->update(['gsid'=>3]);
    	if($update){
    		return response()->json(['status'=>1]);
    	}
    }

    /**
     * Display the specified resource.
     *  显示订单详情
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$orderRow=OrderModel::where('oid',$id)->first();
    	$address=$orderRow->recaddress;
    	return view('admin/orderdetail')->with('orderRow',$orderRow)
    	->with('address',$address);
       return  view('admin/orderdetail');
    }


    /**
     * Update the specified resource in storage.
     * 更新订单的商品信息
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ajaxupdate(Request $request)
    {
        $data['num']=$request->input('num');
        $data['price']=$request->input('price');
        $data['discount']=$request->input('discount');
        $oid=$request->input('oid');
        $gid=$request->input('gid');
        $update=OrderDetailModel::where('oid',$oid)->where('gid',$gid)
        ->update($data);
        
        return response()->json([
        		'status'=>1
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * 删除订单
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function del(Request $request)
    {
    	
    	$oid=$request->input('oid');
		$order=OrderModel::where('oid',$oid)->first();
    	if($order->osid==3){
    	foreach($order->orderDetail as $g){
    		$goods=GoodsModel::where('gid',$g->gid)->first();
    		GoodsModel::where('gid',$g->gid)->update(['num'=>$goods->num+$g->num]);
    	}
    	}
    	OrderModel::where('oid',$oid)->delete();
    	OrderDetailModel::where('oid',$oid)->delete();
    	
    	return response()->json(['status'=>1]);
    }
}
