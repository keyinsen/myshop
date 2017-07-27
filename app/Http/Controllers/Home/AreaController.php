<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\AreaModel;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo "hahahhaha";
    }

    /**
     * Show the form for creating a new resource.
     * 通过ajax选中省份 对应的城市执行显示
     * @return \Illuminate\Http\Response
     */
    public function city(Request $request)
    {
    	$area_id=$request->input('area_id');
    	$city=AreaModel::where('parent_id',$area_id)->get();
    	$city=$city->toArray();
    	//dump($city);exit;
    	return response()->json(['city'=>$city]);
    }
    
    /**
     * Show the form for creating a new resource.
     * 通过ajax选中城市 对应的县或者区执行显示
     * @return \Illuminate\Http\Response
     */
    public function county(Request $request)
    {
    	$area_id=$request->input('area_id');
    	$county=AreaModel::where('parent_id',$area_id)->get();
    	$county=$county->toArray();
    	//dump($city);exit;
    	return response()->json(['county'=>$county]);
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
