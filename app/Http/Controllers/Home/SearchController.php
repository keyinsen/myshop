<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\GoodsModel;
use App\CategoryModel;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$key=$request->input('key');
    	if(ctype_space($key)||empty($key)){
    		redirect('home/index')->send();
    	}
    	$goodsList=GoodsModel::where('gname','like','%'.$key.'%')->paginate(8);
    	if(count($goodsList)!=0){
    		//默认获取第一个商品的类别
    		$type=CategoryModel::where('cid',$goodsList[0]->cid)->first();
    		//通过类别获取父类别
    		$parentType=CategoryModel::where('cid',$type->parentid)->first();
    		//获取此类别的属性名
    		$categoryType=$parentType->attr;
    		//$goodsList=GoodsModel::where('cid',$cid)->paginate(8);
    	}else{
    		$categoryType='';
    	}
    	$typename=array();
    	return view('Home/category')->with('categoryType',$categoryType)
        ->with('goodsList',$goodsList)
        ->with('typename',$typename);
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
