<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\GoodsModel;
use App\AdminModel\AdminModel;
use App\EvaluateModel;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	//商品详情
    public function index($gid)
    {
    	$result=GoodsModel::where('gid',$gid)->get();
    	if(count($result)!=0){
    	$goodsAttrVal=GoodsModel::where('gid',$gid)->first()->belongsTOAttrVal;
    	$goodsInfo=GoodsModel::where('gid',$gid)->first();
    	$goodsType=GoodsModel::where('gid',$gid)->first()->categorys;
    	$admin=AdminModel::where('deleted_at',0)->get();
    	$evaluate=EvaluateModel::where('gid',$gid)->get();
    	$evaluategoods=EvaluateModel::where('gid',$gid)->where('evascore','>',4)->get();
    	$evaluatezgoods=EvaluateModel::where('gid',$gid)->whereIn('evascore',[2,3])->get();
    	$evaluatengoods=EvaluateModel::where('gid',$gid)->where('evascore',1)->get();
       return  view('home/goods')->
       with('goodsAttrVal',$goodsAttrVal)->with('evaluatezgoods',$evaluatezgoods)->
       with('goodsInfo',$goodsInfo)->with('evaluategoods',$evaluategoods)->
       with('goodsType',$goodsType)->with('admin',$admin)
       ->with('evaluate',$evaluate)->with('evaluatengoods',$evaluatengoods);
    	}else{
    		redirect('home/index')->send();
    	}
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
