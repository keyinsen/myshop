<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\RecaddressModel;
use App\CartModel;
use Symfony\Component\VarDumper\Cloner\Data;
use App\OrderModel;
use App\OrderDetailModel;
use App\UserModel;
use App\GoodsModel;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
   //显示用户订单数据
    public function index()
    {
    	
        $uid=session('USER')['uid'];
        
        //全部订单
        $orderList=OrderModel::where('uid',$uid)->paginate(5);
        //未付款
        $norderList=OrderModel::where('uid',$uid)->where('osid',1)->paginate(5);
        //已付款
        $rorderList=OrderModel::where('uid',$uid)->where('osid',2)->paginate(5);
        //已取消
        $corderList=OrderModel::where('uid',$uid)->where('osid',3)->paginate(5);
        //交易完成
        $cmorderList=OrderModel::where('uid',$uid)->where('osid',4)->paginate(5);
        return view('home/uorder')
        ->with('orderList',$orderList)->with('norderList',$norderList)
        ->with('rorderList',$rorderList)->with('corderList',$corderList)
        ->with('cmorderList',$cmorderList);
    }
    
    /**
     * 根据订单号进行搜索
     */
	public function search(Request $request){
		$norderList=array();
		$rorderList=array();
		$corderList=array();
		$cmorderList=array();
		$uid=session('USER')['uid'];
		$ocode=$request->input('ocode');
		if(ctype_space($ocode)||empty($ocode)){
    		redirect('home/order/index')->send();
    	}
		//全部订单
		$orderList=OrderModel::where('uid',$uid)->where('ocode',$ocode)->paginate(2);
		
		return view('home/uorder')
		->with('orderList',$orderList)->with('norderList',$norderList)
		->with('rorderList',$rorderList)->with('corderList',$corderList)
		->with('cmorderList',$cmorderList);
	}
    
    
    /**
     * Show the form for creating a new resource.
     *  通过购物车过来提交订单信息，生成订单表和详情表
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    	$uid=session('USER')['uid'];
    	$is_rec=true;
    	$gid=array();
    	$recid_gid=explode('_', $request->input('recid_gid'));
    	$mess=$request->input('mess');
    	//取出收货地址ID 和商品的Id
    	foreach ($recid_gid as $regid){
    		if($is_rec){
    			$recid=$regid;
    			$is_rec=false;
    		}else{
    			array_push($gid, $regid);
    		}
    	}
    	
    	//dump($recid);exit;
    	//创建事务，事务的开启
    	DB::beginTransaction();
    	$date=new \DateTime();
    	$datetime=$date->format('YmdHis');
    	//生成订单编号
    	$ocode=$uid.$datetime;
    	//dump($ocode);exit;
    	//新增订单信息
    	$newoid=new OrderModel();
    	$newoid->ocode=$ocode;
    	$newoid->uid=$uid;
    	$newoid->rec_id=$recid;
    	$newoid->ocode=$ocode;
    	$newoid->message=$mess;
    	$newoid->save();
    	//返回新增的id
    	$newid=$newoid->oid;
    	
    	foreach ($gid as $g){
    		
    		$userCartRow=CartModel::where('uid',$uid)->where('gid',$g)->first();

    		$orderDatail=new OrderDetailModel();
    		$orderDatail->oid=$newid;
    		$orderDatail->gid=$userCartRow->gid;
    		$orderDatail->gname=$userCartRow->gname;
    		$orderDatail->price=$userCartRow->price;
    		$orderDatail->num=$userCartRow->num;
    		$orderDatail->discount=$userCartRow->discount;
    		$orderDatail->imgpath=$userCartRow->img_path;
    		$orderDatail->save();
    		
    		$goodsnum=GoodsModel::where('gid',$g)->first();
    		if($goodsnum->num<$userCartRow->num){
    			//当前商品库存小于要购买的数量，执行回滚
    			DB::rollBack();
    			return response()->json([
    					'status'=>-1,
    					'mess'=>$goodsnum->gname
    			]);
    		}
    	}
    	foreach ($gid as $g){
    		$goods=GoodsModel::where('gid',$g)->first();
    		$userCartRow=CartModel::where('uid',$uid)->where('gid',$g)->first();
    		GoodsModel::where('gid',$g)->update(['num'=>$goods->num-$userCartRow->num]);
    	}
    	//提交事务
    	DB::commit();
//     	//删除购物车信息
    	foreach ($gid as $g){
    		//dump($ctid);
    		CartModel::where('uid',$uid)->where('gid',$g)->delete();
    	}
    	return response()->json([
    			'status'=>1,
    			//'mess'=>$goodsnum->gname
    	]);
    	
    }
    
    
    /**
     * Show the form for creating a new resource.
     *  通过商品详情过来提交订单信息，生成订单表和详情表
     * @return \Illuminate\Http\Response
     */
    public function gcreate(Request $request)
    {
    	$uid=session('USER')['uid'];
    	$recid_g_n=explode('_', $request->input('recid_g_n'));
    	$mess=$request->input('mess');
    	//dump($mess);exit;
    	//取出收货地址ID 和商品的Id
    	
    			$recid=$recid_g_n[0];
    			$gid=$recid_g_n[1];
    			$num=$recid_g_n[2];
    			//dump($num);exit;
    	//dump($recid);exit;
    	//创建事务，事务的开启
    	DB::beginTransaction();
    	$date=new \DateTime();
    	$datetime=$date->format('YmdHis');
    	//生成订单编号
    	$ocode=$uid.$datetime;
    	//dump($ocode);exit;
    	 //dump($gid);exit;
    	//新增订单信息
    	$newoid=new OrderModel();
    	$newoid->ocode=$ocode;
    	$newoid->uid=$uid;
    	$newoid->rec_id=$recid;
    	$newoid->ocode=$ocode;
    	$newoid->message=$mess;
    	
    	$newoid->save();
    	//返回新增的id
    	$newid=$newoid->oid;
    	 

    		$userGoodsRow=GoodsModel::where('gid',$gid)->first();
    		$orderDatail=new OrderDetailModel();
    		$orderDatail->oid=$newid;
    		$orderDatail->gid=$userGoodsRow->gid;
    		$orderDatail->gname=$userGoodsRow->gname;
    		$orderDatail->price=$userGoodsRow->price;
    		$orderDatail->num=$num;
    		$orderDatail->discount=$userGoodsRow->discount;
    		$orderDatail->imgpath=$userGoodsRow->img_path;
    		$orderDatail->save();
    		
    	 if($userGoodsRow->num<$num){
    	 	//当前商品库存小于要购买的数量，执行回滚
    	 	DB::rollBack();
    	 	return response()->json([
    	 			'status'=>-1,
    	 			'mess'=>$goodsnum->gname
    	 	]);
    	 }else{
    	 	GoodsModel::where('gid',$gid)->update(['num'=>$userGoodsRow->num-$num]);
    	 	DB::commit();
    	 	return response()->json([
    	 			'status'=>1,
    	 			//'mess'=>$goodsnum->gname
    	 	]);
    	 }
    }

    /**
     * Store a newly created resource in storage.
     *  点击支付后执行
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function pay(Request $request)
    {
    	$uid=session('USER')['uid'];
    	$oid=$request->input('oid');
    	//获取当前用户的账户余额
    	$loan=UserModel::where('uid',$uid)->select('loan')->first()->loan;
    	if($loan>0){
    		$order=OrderModel::where('oid',$oid)->where('uid',$uid)->first();
    		$goodsList=$order->orderDetail;
    		$total=0;
    		foreach ($goodsList as $g){
    			$total+=$g->price*$g->discount*$g->num;
    		}
    		if($loan-$total>=0){
    			$loan=$loan-$total;
    			$res1=UserModel::where('uid',$uid)->update(['loan'=>$loan]);
    			$date=new \DateTime();
    			$paytime=$date->format('Y-m-d H:i:s');
    			$res2=OrderModel::where('oid',$oid)->where('uid',$uid)->update(['osid'=>2,'paytime'=>$paytime]);
    			if($res1&&$res2){
    				return response()->json([
    						'status'=>1,
    						'mess'=>'支付成功！'
    				]);
    			}else{
    				return response()->json([
    						'status'=>-1,
    						'mess'=>'支付失败！'
    				]);
    			}
    		}else{
    			return response()->json([
    					'status'=>0,
    					'mess'=>'账户余额不足'
    			]);
    		}
    	}else{
    		return response()->json([
    				'status'=>0,
    				'mess'=>'账户余额不足'
    		]);
    	}
    	
    }

    /**
     * Display the specified resource.
     * 通过购物车创建订单信息，只是显示数据在界面，不存入数据库
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
    	//dump($request->input());exit;
        $uid=session('USER')['uid'];
        $cartid_num=$request->input();
       // dump($cartid_num);exit;
        $update=new CartModel();
        //更新购物车信息
        $cartid=array();
        foreach ($cartid_num as $k=>$v){
        	$v=explode('_', $v);
        	$cart_id=$v[0];
        	$num=$v[1];
        	$result=$update->where('cart_id',$cart_id)->update(['num'=>$num]);
        	//$result1=cart
        	
        	array_push($cartid, $cart_id);
        }
        $cartArray=array();
        //将购物车选择的商品信息遍历存放到一个数组里面
        foreach ($cartid as $ctid){
        	//dump($ctid);
        	$cartList=CartModel::where('uid',$uid)->where('cart_id',$ctid)->first();
        	//当后台删除此商品信息时候，购物车里面的信息将会一同删除，因此要进行确实商品是否存在
        	$result1=GoodsModel::where('gid',$cartList->gid)->first();
        	if(count($result1)==0){
        		redirect('home/cart')->send();
        	}
        	array_push($cartArray, $cartList);
        }
        
        $addressList=RecaddressModel::where('uid',$uid)->get();
        return view('home/order')->with('addressList',$addressList)
        ->with('cartArray',$cartArray);
    }
    
    /**
     * Display the specified resource.
     * 通过商品详情页面创建订单信息，只是显示数据在界面，不存入数据库
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function gshow(Request $request)
    {
    	$uid=session('USER')['uid'];
    	$gid_num=$request->input();
    	foreach ($gid_num as $k=>$v){
    		$gid=$k;
    		$num=$v;
    	}
    	$cartArray=array();
    	//选择的商品信息存放到一个数组里面
    	$goodinfo=GoodsModel::where('gid',$gid)->first();
    	array_push($cartArray, $goodinfo);    
    	$addressList=RecaddressModel::where('uid',$uid)->get();
    	return view('home/order')->with('addressList',$addressList)
    	->with('cartArray',$cartArray)->with('num',$num);
    }

    /**
     * Show the form for editing the specified resource.
     * 执行取消订单操作
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function oCancel(Request $request)
    {
    	$uid=session('USER')['uid'];
    	$oid=$request->input('oid');
    	$order=OrderModel::where('oid',$oid)->where('uid',$uid)->first();
    	$res=OrderModel::where('oid',$oid)->where('uid',$uid)->update(['osid'=>3]);
    	foreach($order->orderDetail as $g){
    		$goods=GoodsModel::where('gid',$g->gid)->first();
    		GoodsModel::where('gid',$g->gid)->update(['num'=>$goods->num+$g->num]);
    	}
    	if($res){
    		return response()->json([
    				'status'=>1,
    				'mess'=>'订单已取消！'
    		]);
    	}else{
    		return response()->json([
    				'status'=>-1,
    				'mess'=>'订单取消失败！'
    		]);
    	}
    }
    
    

    /**
     * Update the specified resource in storage.
     * 执行确认收货
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function recipient(Request $request)
    {
        $oid=$request->input('oid');
        $uid=session('USER')['uid'];
        $date=new \DateTime();
        $time=$date->format('Y-m-d H:i:s');
        OrderModel::where('uid',$uid)->where('oid',$oid)->update(['osid'=>4,'comptime'=>$time]);
        
        return response()->json([
        		'status'=>1
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *  删除订单
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function del(Request $request)
    {
        $uid=session('USER')['uid'];
    	$oid=$request->input('oid');
    	$order=new OrderModel();
    	$res=$order->where('oid',$oid)->where('uid',$uid)->delete();
    	if($res){
    		//$deloid=$order->oid;
    		$res1=OrderDetailModel::where('oid',$oid)->delete();
    		if($res1){
    			return response()->json([
    					'status'=>1,
    					'mess'=>'订单删除成功！'
    			]);
    		}else{
    			return response()->json([
    					'status'=>0,
    					'mess'=>'订单删除失败,用户订单详情不存在！'
    			]);
    		}
    	}else{
    		return response()->json([
    				'status'=>-1,
    				'mess'=>'订单删除失败,用户订单不存在！'
    		]);
    	}
    	
    }
}
