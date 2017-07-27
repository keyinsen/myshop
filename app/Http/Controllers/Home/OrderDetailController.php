<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\OrderModel;
use App\RecaddressModel;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *   显示订单详情页面 的数据
     * @return \Illuminate\Http\Response
     */
    public function index($oid)
    {
    	//订单信息
    	$uid=session('USER')['uid'];
    	$orderList=OrderModel::where('oid',$oid)->first();
    	$rec_id=$orderList->rec_id;
    	$rec=RecaddressModel::where('uid',$uid)->where('rec_id',$rec_id)->first();
    	
    	
        return view('home/orderdetail')->with('orderList',$orderList)
        ->with('rec',$rec);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
