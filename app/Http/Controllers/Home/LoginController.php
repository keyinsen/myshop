<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ValidateLogin;
use App\GoodsModel;
use Gregwar\Captcha\CaptchaBuilder;
use App\UserModel;
use Symfony\Component\HttpFoundation\Session\Session;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Home/login');
    }
    //生成验证码
    public function loginImg(Request $request,$id){
//        exit;
        //生成对象
    	$builder = new CaptchaBuilder();
    	////可以设置图片宽高及字体
    	$builder->build($width = 100, $height = 40, $font =null);
        //获取验证码的内容
    	$phrase = $builder->getPhrase();
    	//存入session
    	$request->session()->put('loginimg',$phrase);
    	//生成图片
    	header("Cache-Control: no-cache, must-revalidate");
    	header('Content-Type: image/jpeg');
         $builder->output();
    }
    //登入验证
    public function validlogin(ValidateLogin $request){
    	$loginimg=$request->get('loginimg');
    	$uname=$request->get('uname');
    	$password=$request->get('password');
    	//dump($loginimg);
    	//dump($loginimg.'  '.session('loginimg'));exit;
    	if(strtolower(session('loginimg'))==strtolower($loginimg)){
    		$user=UserModel::where('uname',$uname)->where('password',$password)->where('deleted_at',0)->select('uid','uname')->get();
    		//dump($user);exit;
    		if(count($user)==1){
    			$request->session()->put('USER',$user[0]->toArray());
    			$date=new \DateTime();
    			$time=$date->format('Y-m-d H:i:s');
    	
    			$update=new UserModel();
    			$update->where('uid',$user[0]->uid)->update(['lasttime'=>$time]);
    			$request->session()->put('loginimg','');
    			redirect('home/index')->send();
    		}else{
    			
    			$error='用户名或者密码错误！';
    			redirect('home/login')->with('error',$error)->send();
    		}
    	}else{
    		$error='验证码错误！点击图片刷新验证';
    		$request->session()->put('loginimg','');
    		redirect('home/login')->with('error',$error)->send();
    	}
     	
    }
    
    public function ajaxvalidlogin(ValidateLogin $request){
    	
    	//$request->input();
    	$uname=$request->get('uname');
    	$pwd=$request->get('password');
    	$user=UserModel::where('uname',$uname)->where('password',$pwd)->where('deleted_at',0)->select('uid','uname')->get();
    		if(count($user)==1){
    			$request->session()->put('USER',$user[0]->toArray());
    			$date=new \DateTime();
    			$time=$date->format('Y-m-d H:i:s');
    	
    			$update=new UserModel();
    			$update->where('uid',$user[0]->uid)->update(['lasttime'=>$time]);
    		return	response()->json([
    					'staus'=>1,
    					'data'=>$user
    			]);
    		}else{
    			
    		return	response()->json([
    					'staus'=>-1,
    					'mess'=>'账号或者密码错误!'
    			]);
    		}
    }
    
    public function outLogin(Request $request)
    {
    	$request->session()->put('USER','');
    	redirect('home/index')->send();
    }


}
