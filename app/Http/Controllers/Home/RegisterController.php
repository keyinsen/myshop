<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ValidateRegister;
use App\UserModel;
use Gregwar\Captcha\CaptchaBuilder;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Home/register');
    }
    
    //失效
    public function reginImg(Request $request,$id){
    	$builder = new CaptchaBuilder();
    	$builder->build($width = 100, $height = 40, $font =null);
    	$phrase = $builder->getPhrase();
    	$request->session()->put('reginimg','');
    	$request->session()->put('reginimg',$phrase);
    	header("Cache-Control: no-cache, must-revalidate");
    	header('Content-Type: image/jpeg');
    	$builder->output();
    }
    //注册验证主要代码
    public function validregis(ValidateRegister $request){
    	$post=$request->input();
    	$uname=$post['uname'];
    	$password=$post['password'];
    	$reginImg=$post['p'];
    	$isuname=UserModel::where('uname',$uname)->get();
    	//dump($reginImg.'  '.session('loginimg'));exit;
    	if(strtolower(session('loginimg'))==strtolower($reginImg)){
    	if(count($isuname)==0){
    		$newuname=new UserModel();
    		$newuname->uname=$request->uname;
    		$newuname->password=$request->password;
    		$date=new \DateTime();
    		$time=$date->format('Y-m-d H:i:s');
    		$newuname->password=$request->password;
    		$newuname->lasttime=$time;
    		$row=$newuname->save();
    	
    		if($row){
    			$user=UserModel::where('uname',$uname)->where('password',$password)->get()[0];
    			$request->session()->put('USER',$user->toArray());
    			$request->session()->put('loginimg','');
    			return response()->json([
    					'msg'=>'注册成功',
    					'status'=>'200',
    					'url'=>'index'
    			]);
    		}
    		
    	}else{
    		
    		return response()->json([
    				'msg'=>'用户名已被使用',
    				'status'=>'10000',
    		]);
    	}
    	}else{
    		$request->session()->put('loginimg','');
    		return response()->json([
    				'msg'=>'验证码错误，点击图片刷新重试',
    				'status'=>'11000',
    		]);
    	}
    	
    }

}
