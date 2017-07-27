<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Gregwar\Captcha\CaptchaBuilder;
use App\Http\Requests\ValidateLogin;
use App\AdminModel\AdminModel;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/login');
    }
    public function loginImg(Request $request,$id){
    	$builder = new CaptchaBuilder();
    	$builder->build($width = 100, $height = 40, $font =null);
    	$phrase = $builder->getPhrase();
    	$request->session()->put('valiimg',$phrase);
    	header("Cache-Control: no-cache, must-revalidate");
    	header('Content-Type: image/jpeg');
    	$builder->output();
    }
    //登入
    public function validlogin(ValidateLogin $request){
    	$loginimg=$request->get('valiimg');
    	$uname=$request->get('uname');
    	$password=$request->get('password');
    	if(strtolower(session('valiimg'))==strtolower($loginimg)){
    		$user=AdminModel::where('aname',$uname)->where('password',$password)->where('deleted_at',0)->get();
    
    		if(count($user)==1){
    			$request->session()->put('Admin',$user[0]->toArray());
    			//dump(session('USER'));exit;
    			$request->session()->put('valiimg','');
    			$request->session()->put('aderror','');
    			redirect('admin/index')->send();
    		}else{
    			$error='用户名或者密码错误！';
    			redirect('admin/login')->with('aderror',$error)->send();
    		}
    	}else{
    		$error='验证码错误！';
    		$request->session()->put('valiimg','');
    		redirect('admin/login')->with('aderror',$error)->send();
    	}
    
    }
}
