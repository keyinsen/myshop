<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\AdminModel\AdminModel;
use App\Http\Requests\FileValidate;

class FileLoadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FileValidate $request)
    {
   		 $filename='';
     		$admin_id=session('Admin')['admin_id'];
    		$userinfo=AdminModel::where('admin_id',$admin_id)->first();
    		$file=$request->file('picpath');
    		if($file->isValid()){
    			$entension = $file -> getClientOriginalExtension(); //上传文件的后缀.
    			$date=new \DateTime();
    			$datetime=$date->format("YmdHsm");
    			$filename=md5($admin_id.$datetime.rand(0,10000)).'.'.$entension;
    			$file -> move(public_path().'/img/dataimg',$filename);
    			$request->session()->put('filename',$filename);
    		}
   		 return response()->json([
   		 		'status'=>1,
   		 		'img'=>$filename
   		 ]);
    }

     public function goodsImg(FileValidate $request)
    {
   		 $filename='';
    		$file=$request->file('imgpath');
    		//dump($file);exit;
    		
    		if($file->isValid()){
    			$entension = $file -> getClientOriginalExtension(); //上传文件的后缀.
    			$date=new \DateTime();
    			$datetime=$date->format("YmdHsm");
    			$filename=md5($datetime.rand(0,100000)).'.'.$entension;
    			$file -> move(public_path().'/img/dataimg',$filename);
    			$filename='http://localhost/ShopProject/public/img/dataimg/'.$filename;
    		}
   		 return response()->json([
   		 		'status'=>1,
   		 		'img'=>$filename
   		 ]);
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
