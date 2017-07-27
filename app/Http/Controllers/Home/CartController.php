<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;


use App\Http\Controllers\Controller;
use App\UserModel;
use App\CartModel;
use App\GoodsModel;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	if(!empty(session('USER'))){
    		$uid=session('USER')['uid'];
    		$cartList=CartModel::where('uid',$uid)->get();
    		//dump($cartList);exit;
    		return view('home/cart')->with('cartList',$cartList);
    	}
    }
    
    /**
     * 在类别 和主页添加商品到购物车
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxAddGoods(Request $request)
    {
    //	dump($request->input());exit;
    	if(!empty(session('USER'))){
    		$uid=session('USER')['uid'];
    		$gid=$request->input('gid');
    		$usercart=new CartModel();
    		$is_goods=$usercart->where('uid',$uid)->where('gid',$gid)->first();
    		$usercart->gname=$request->input('gname');
    		$usercart->img_path=$request->input('img_path');
    		//dump($usercart->img_path);exit;
    		$usercart->discount=$request->input('discount');
    		$usercart->price=$request->input('price');
    		$usercart->uid=$uid;
    		$usercart->gid=$gid;
    		if(count($is_goods)==0){
    			$usercart->num=1;
    			if($usercart->save()){
    				return response()->json([
    						'gid'=>$gid,
    						'status'=>1,
    						'mess'=>'添加成功！'
    				]);	
    			}
    		}else{
    			$data=$request->input();
    			$data['num']=$is_goods->num+1;
    			$usercart->num=$is_goods->num+1;
    		    $goodsnum=GoodsModel::where('gid',$gid)->first()->num;
    		   // dump($data);exit;
    		    if($goodsnum<$data['num']){
    		    	return response()->json([
    		    			'gid'=>$gid,
    		    			'status'=>-2,
    		    			'mess'=>'添加商品到购物车不能超出库存'

    		    	]);
    		    }
    		    //限购20
    		    if($data['num']>20){
    		    	return response()->json([
    		    			'gid'=>$gid,
    		    			'status'=>-3,
    		    			'mess'=>'添加到购物车的商品只能是20件'
    		    
    		    	]);
    		    }
    			$is_up=$usercart->where('gid',$gid)->where('uid',$uid)->update($data);
    			if($is_up){
    				return response()->json([
    						'gid'=>$gid,
    						'status'=>2,
    						'mess'=>'商品成功添加到购物车！'
    						
    				]);
    			}
    		}
    	}else{
    		return response()->json([
    				'status'=>-1,
    				'mess'=>'未登入'
    		]);
    	}
    	 
    }
    
    /**
     *  在商品详情界面添加商品到购物车
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    
    //购物车商品添加
    public function ajaxginfoAddGoods(Request $request){
    	//dump($request->input());exit;
    	if(!empty(session('USER'))){
    		$uid=session('USER')['uid'];
    		$gid=$request->input('gid');
    		$num=$request->input('num');
    		$usercart=new CartModel();
    		$is_goods=$usercart->where('uid',$uid)->where('gid',$gid)->first();
    		$usercart->gname=$request->input('gname');
    		$usercart->img_path=$request->input('img_path');
    		$usercart->discount=$request->input('discount');
    		$usercart->price=$request->input('price');
    		$usercart->uid=$uid;
    		$usercart->gid=$gid;
    		$usercart->num=$num;
    		//查看添加的商品到购物车是否超出库存
    		    $goodsnum=GoodsModel::where('gid',$gid)->first()->num;
    		    if($goodsnum<$num){
    		    	return response()->json([
    		    		  'gid'=>$gid,
    		    		    'status'=>-2,
    		    		    'mess'=>'你购物车此商品数量不能超出库存'
    		 
    		    		]);
    		     }
    		     if($num>20){
    		     	return response()->json([
    		     			'gid'=>$gid,
    		     			'status'=>-3,
    		     			'mess'=>'只能限购20件'
    
    		     	]);
    		     }
    		if(count($is_goods)==0){
    			
    			if($usercart->save()){
    				return response()->json([
    						'gid'=>$gid,
    						'status'=>1,
    						'mess'=>'添加成功！'
    				]);
    			}else{
    				return response()->json([
    						'gid'=>$gid,
    						'status'=>-100,
    						'mess'=>'添加失败！'
    				]);
    			}
    		}else{
    			//$data
    			//array_splice($request->input(), 2);
    			//dump($var)
    			$data=$request->input();
    			$data['num']=$is_goods->num+$num;
    			//dump($data);exit;
    			//查看添加的商品到购物车是否超出库存
    			$goodsnum=GoodsModel::where('gid',$gid)->first()->num;
    			if($data['num']>20){
    				return response()->json([
    						'gid'=>$gid,
    						'status'=>-3,
    						'mess'=>'只能限购20件'
    			
    				]);
    			}
    			if($goodsnum<$data['num']){
    				return response()->json([
    						'gid'=>$gid,
    						'status'=>-2,
    						'mess'=>'添加商品信息不能超出库存'
    
    				]);
    			}else{
    				$is_up=$usercart->where('gid',$gid)->where('uid',$uid)->update($data);
    				if($is_up){
    					return response()->json([
    							'gid'=>$gid,
    							'status'=>2,
    							'mess'=>'更新成功！'
   
    					]);
    				}
    			}
    			
    		}
    	}else{
    		return response()->json([
    				'status'=>-1,
    				'mess'=>'未登入'
    		]);
    	}
    }
		
    
    /**
     *
     * 在购物车要提交商品信息的时候判断库存量
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function kucun(Request $request)
    {
    	//dump($request->input('data'));exit;
    	$gid=explode('&', $request->input('data'));
    	foreach ($gid as $g){
    		$gid_num=explode('_', $g);
    		$gids=$gid_num[0];
    		$num=$gid_num[1];
    		$good=GoodsModel::where('gid',$gids)->first();
    		if($good->num<$num){
    			return response()->json([
    					'status'=>-1,
    					'mess'=>$good->gname
    			]);
    		}
    	}
    	return response()->json([
    			'status'=>1,
    			'mess'=>$good->gname
    	]);
    }
    
    
    /**
     * 在菜单栏进行购物车商品信息的删除
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxDelete(Request $request)
    {
    	if(!empty(session('USER'))){
    		$uid=session('USER')['uid'];
    		$gid=$request->input('gid');
    		$usercart=new CartModel();
    		//$de_goods=DB::delete('delete from shop_cart where uid=? and gid=?',[$uid,$gid]);
    		$de_goods=$usercart->where('uid',$uid)->where('gid',$gid)->delete();
 
    		if($de_goods>0){
    			
    				return response()->json([
    						'gid'=>$gid,
    						'status'=>1,
    						'mess'=>'删除成功！'
    				]);

    		}else{
    			 
    			
    				return response()->json([
    						'gid'=>$gid,
    						'status'=>'-1',
    						'mess'=>'删除失败！'
    	
    				]);
    			 
    			 
    		}
    	}
    }
    


}
