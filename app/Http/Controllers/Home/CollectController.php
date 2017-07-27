<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CollectModel;

class CollectController extends Controller
{
    /**
     * Display a listing of the resource.
     * 显示商品收藏
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$uid=session('USER')['uid'];
    	$collect=CollectModel::where('uid',$uid)->paginate(5);
        return view('home/ucollect')->with('collect',$collect);
    }
    //收藏商品
    public function add(Request $request)
    {
       $uid=session('USER')['uid'];
       $gid=$request->input('gid');
       $result=CollectModel::where('uid',$uid)->where('gid',$gid)->get();
       if(count($result)>0){
       	return  response()->json([
       			'status'=>2
       	]);
       }else{
       	$coll=new CollectModel();
       	$coll->uid=$uid;
       	$coll->gid=$gid;
       	$coll->save();
       	return  response()->json([
       			'status'=>1
       	]);
       }
    }
    /**
     * Remove the specified resource from storage.
     * 删除收藏的商品
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $uid=session('USER')['uid'];
        CollectModel::where('uid',$uid)->where('gid',$id)->delete();
        redirect('home/collect')->send();
    }
}
