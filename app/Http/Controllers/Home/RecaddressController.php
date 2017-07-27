<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\RecaddressModel;
use App\AreaModel;
use App\Http\Requests\RecAddressValidate;


class RecaddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *  显示用户收货地址信息
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!empty(session('USER'))){
        	$uid=session('USER')['uid'];
        	$addressList=RecaddressModel::where('uid',$uid)->get();
        	//地区省份列表
        	//$province=AreaModel::where('parent_id','0')->get();
        	return view('home/uaddress')->with('addressList',$addressList);
        	//->with('province',$province);
        }
    }
 
    //添加收货地址
    public function store(Request $request){
    	//dump($request->input());
    	if(!empty(session('USER'))){
    		$uid=session('USER')['uid'];
    	$province=$request->input('province');
    	$city=$request->input('city');
    	$county=$request->input('county');
   
    		//添加地址
    		$data=$request->except('_token','rec_id');
    		$add=new RecaddressModel();
    		$add->uid=$uid;
    		$add->recname=$data['recname'];
    		$add->province=$province;
    		$add->city=$city;
    		$add->county=$county;
    		$add->tel=$data['tel'];
    		$add->postcode=$data['postcode'];
    		$add->detail=$data['detail'];
    		$add=$add->save();
    		if($add){
    			redirect('home/address')->send();
    		}
    	}
    }

 	
    public function edit($id)
    {
     if(!empty(session('USER'))){
        	$uid=session('USER')['uid'];
        	$addressList=RecaddressModel::where('uid',$uid)->get();
			$editAddress=RecaddressModel::where('uid',$uid)->where('rec_id',$id)->first();
        	//return view('home/uaddress')->com()
        	return view('home/uaddress')->with('addressList',$addressList)
			->with('editAddress',$editAddress);
        }
    }

   //更新收货地址
    public function update(Request $request, $id)
    {
    	
     if(!empty(session('USER'))){
     	//dump($request->input());
        	$uid=session('USER')['uid'];
            $data=$request->except('_token','_method');
            $province=$request->input('province');
            $city=$request->input('city');
            $county=$request->input('county');
    		$data['province']=$province;
    		$data['city']=$city;
    		$data['county']=$county;
    		$updates=new RecaddressModel();
    		$relu=$updates->where('rec_id',$id)->where('uid',$uid)->update($data);
    	
    			redirect('home/address')->send();
    		
     	}
    }
	//删除收货地址
    public function del(Request $request)
    {
    	if(!empty(session('USER'))){
    		$uid=session('USER')['uid'];
    		$rec_id=$request->input('rec_id');
    		$del=RecaddressModel::where('uid',$uid)->where('rec_id',$rec_id)->delete();
    	if(count($del)==1){
    		return  response()->json([
    				'status'=>1
    		]);
    	}else{
    		return  response()->json([
    				'status'=>-1
    		]);
    	}
    	}
    }
}
