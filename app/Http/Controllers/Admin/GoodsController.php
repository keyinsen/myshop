<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CategoryModel;
use App\GoodsModel;
use App\GoodsAttrValModel;
use App\AttrModel;
use App\EvaluateModel;
use App\CollectModel;
use App\CartModel;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *  显示全部商品信息
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	//全部的商品信息
    	$goodsAll=GoodsModel::paginate(10);
    	//正在出售的商品信息
    	$goodsList=GoodsModel::where('status',1)->paginate(10);
    	//准备出售的商品信息
    	$ngoodsList=GoodsModel::where('status',0)->paginate(10);
    	//库存不足的商品信息
    	$kuList=GoodsModel::where('num','<','5')->paginate(10);
        return view('admin/goodsinfo')->with('goodsList',$goodsList)
        ->with('ngoodsList',$ngoodsList)->with('kuList',$kuList)
        ->with('goodsAll',$goodsAll);
    }
    
    
    /**
     * 
     *  搜索商品信息
     * @return \Illuminate\Http\Response
     */
    public function searchgoods(Request $request)
    {
    	$ngoodsList=array();
    	$kuList=array();
    	$goodsList=array();
    if(ctype_space($request->input('goodsname'))||empty($request->input('goodsname'))){
    		$goodsAll=array();
    	}else{
    		$goodsAll=GoodsModel::where('gname','like','%'.$request->input('goodsname').'%')->paginate(10);
    	}
    	
    	 return view('admin/goodsinfo')->with('goodsList',$goodsList)
        ->with('ngoodsList',$ngoodsList)->with('kuList',$kuList)
        ->with('goodsAll',$goodsAll);
    }

    /**
     * Show the form for creating a new resource.
     *  添加商品的显示界面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$cate=CategoryModel::where('parentid',0)->get();
    	//$zcate=CategoryModel::limit(1)->where()
    	$cateone=CategoryModel::limit(1)->first();
    	$zcate=CategoryModel::where('parentid',$cateone->cid)->get();
    	//dump($cateone);exit;
        return  view('admin/goods')->with('cate',$cate)
        ->with('cateone',$cateone)->with('zcate',$zcate);
    }

    /**
     * Store a newly created resource in storage.
     *  新增商品
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$goods=new GoodsModel();
    	$result=GoodsModel::where('gname',$request->input('gname'))->first();
    	//dump($result);exit;
    	if(count($result)==0){
    		$goods->gname=$request->input('gname');
    		$goods->cid=$request->input('cid');
    		$goods->tprice=$request->input('tprice');
    		$goods->price=$request->input('price');
    		$goods->num=$request->input('num');
    		$goods->discount=$request->input('discount');
    		$goods->img_path=$request->input('img_path');
    		$goods->img_path1=$request->input('img_path1');
    		$goods->img_path2=$request->input('img_path2');
    		$goods->img_path3=$request->input('img_path3');
    		$goods->descript=$request->input('descript');
    		$goods->save();
    		$gid=$goods->gid;
    		foreach ($request->input() as $k=>$v){
    			if(is_int($k)){
    				$goodsval=new GoodsAttrValModel();
    				$goodsval->attr_id=$k;
    				$goodsval->avid=$v;
    				$goodsval->gid=$gid;
    				$goodsval->save();
    			}
    		}	
    	}
    	
       redirect('admin/goods')->send();
    }
    
    /**
     * 上架商品
     */
    public function shelves(Request $request){
    	$gid=$request->input('gid');
    	$datatime=new \DateTime();
    	$date=$datatime->format('Y-m-d H:i:s');
    	//dump($gid);exit;
    	$result=GoodsModel::where('gid',$gid)->update(['status'=>1,'store_time'=>$date]);
    	return response()->json([
    				'status'=>1
    		]);
    }

    /**
     * Display the specified resource.
     *  显示商品详情
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$goodsone=GoodsModel::where('gid',$id)->first();
    	$goodattrval=GoodsModel::where('gid',$id)->first()->belongsTOAttrVal;
    	//dump($goodattrval);exit;
        return view('admin/goodsdetail')->with('goodsone',$goodsone)
        ->with('goodattrval',$goodattrval);
    }

    /**
     * Show the form for editing the specified resource.
     *  显示修改的界面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cate=CategoryModel::where('parentid',0)->get();
        //获取编辑商品信息
    	$editList=GoodsModel::where('gid',$id)->first();
    	$cid=CategoryModel::where('cid',$editList->cid)->first();
    	//获取此类别同级类别
    	$cates=CategoryModel::where('parentid',$cid->parentid)->get();
    	//获取商品的主类别，在前台进行关联出规格
    	$attrName=AttrModel::where('cid',$cid->parentid)->get();
    	//商品的规格值，在前台进行过滤，如果是商品的规格值 设置成选中
    	$attrval=GoodsModel::where('gid',$id)->first()->belongsTOAttrVal;
     	//dump($editList->parentid);
	//dump($attrval);exit;
        return  view('admin/goods')->with('cate',$cate)->with('cid',$cid)
        ->with('editList',$editList)->with('cates',$cates)
        ->with('attrName',$attrName)->with('attrval',$attrval);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //修改商品
    public function update(Request $request, $id)
    {
    	$update=new GoodsModel();
    	//dump($request->input());exit;
    	
    	$data['gname']=$request->input('gname');
    	$data['cid']=$request->input('cid');
    	$data['tprice']=$request->input('tprice');
    	$data['price']=$request->input('price');
    	$data['discount']=$request->input('discount');
    	$data['num']=$request->input('num');
    	$data['img_path']=$request->input('img_path');
    	$data['img_path1']=$request->input('img_path1');
    	$data['img_path2']=$request->input('img_path2');
    	$data['img_path3']=$request->input('img_path3');
    	CartModel::where('gid',$id)->update(
    			['gname'=>$data['gname'],
    			 'img_path'=>$data['img_path'],
    			 'price'=>$data['price'],
    			 'discount'=>$data['discount']
    			]			
    	);
    	$update->where('gid',$id)->update($data);
    	GoodsAttrValModel::where('gid',$id)->delete();
    	foreach ($request->input() as $k=>$v){
    		if(is_int($k)){
    			$goodsval=new GoodsAttrValModel();
    			$goodsval->attr_id=$k;
    			$goodsval->avid=$v;
    			$goodsval->gid=$id;
    			$goodsval->save();
    		}
    	}
    	redirect('admin/goods')->send();
    }

    /**
     * Remove the specified resource from storage.
     * 删除商品信息
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function del(Request $request)
    {
    $removeid=explode('_', $request->input('removeid'));
    //dump($removeid);exit;
    	$array=array();
    	foreach ($removeid as $re){
    		array_push($array, $re);
    	}
    	
    	//删除商品信息
    	$rel=GoodsModel::whereIn('gid',$array)->delete();
    	//删除收藏夹信息
    	CollectModel::whereIn('gid',$array)->delete();
    	//删除购物车信息
    	CartModel::whereIn('gid',$array)->delete();
    	//删除商品对应的评价
    	EvaluateModel::whereIn('gid',$array)->delete();
    	if(count($rel)>0){
    		//删除商品对应的规格值信息
    		$rel2=GoodsAttrValModel::whereIn('gid',$array)->delete();
    		
    		if(count($rel2)>0){
    			return  response()->json([
    					'status'=>1
    			]);
    		}else{
    			return  response()->json([
    					'status'=>-2,
    					'mess'=>'删除商品对应的规格参数不存在或者错误'
    			]);
    		}
    	}else {
    		return  response()->json([
    				'status'=>-1,
    				'mess'=>'删除商品不存在或者错误'
    		]);
    	}
    	
    	
    	
    }
}
