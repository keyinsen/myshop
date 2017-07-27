<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CategoryModel;
use App\AttrValueModel;
use App\AttrModel;
use App\GoodsAttrValModel;
use App\GoodsModel;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$cateparent=CategoryModel::where('parentid',0)->get();
       $cateList=CategoryModel::orderBy('parentname','desc')->get();	
       return view('admin/category')->with('cateList',$cateList)->with('cateparent',$cateparent);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *  新增类别
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	//dump($request->input());
    	$parentid=$request->input('parentcate');
        $cname=$request->input('cname');
        $zcname=$request->input('zcname');
        if($parentid==0){
        	$cate=new CategoryModel();
        	$cate->cname=$cname;
        	$cate->save();
        	$newid=$cate->cid;
        	$newname=$cate->cname;
        	$cate1=new CategoryModel();
        	$cate1->parentid=$newid;
        	$cate1->parentname=$newname;
        	$cate1->cname=$zcname;
        	$cate1->save();
        }else{
        	$cate=new CategoryModel();
        	$parentcate=CategoryModel::where('cid',$parentid)->first();
        	$cate->parentname=$parentcate->cname;
        	$cate->parentid=$parentcate->cid;
        	$cate->cname=$zcname;
        	$cate->save();
        }
        redirect('admin/category')->send();
    }

 	/**
     * Display the specified resource.
     *  在添加规格参数信息中，需要运用ajax来进行选择类别对应的规格
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ajaxCate(Request $request)
    {
        $cid=$request->input('addcid');
		$cate=AttrModel::where('cid',$cid)->get();
		//$sql='select * from shop_attr where cid=?';
		$attrname=$cate->toArray();
		if(count($attrname)>0){
			return response()->json([
					'status'=>1,
					'attrname'=>$attrname
			]);
		}else{
			return response()->json([
					'status'=>-1,
			]);
		}
		
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$cateList=CategoryModel::all();
        $editList=CategoryModel::where('cid',$id)->first();
        return view('admin/category')->with('cateList',$cateList)
        ->with('editList',$editList);
        
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
        $cname=$request->input('cname');
        $cate=new CategoryModel();
        $cate->where('cid',$id)->update(['cname'=>$cname]);
        redirect('admin/category')->send();
    }

    /**
     * Remove the specified resource from storage.
     *  删除类别
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
    	//判断类别为主类别还是子类别，如果是主类别还要删除其子类别
    	
    	$cid=CategoryModel::where('cid',$array[0])->first();
    	//dump($cid->parentid);exit;
    	//删除类别
    	$result1=CategoryModel::where('cid',$array[0])->delete();
    	if(count($result1)>0){
    		
    		$attrname=AttrModel::where('cid',$array[0])->get();
    		//删除类别下的规格
    		$result2=AttrModel::where('cid',$array[0])->delete();
    		if(count($result2)>0){
    			//删除类别下的每个规格的参数
    			foreach ($attrname as $attr){
    				AttrValueModel::where('attr_id',$attr->attr_id)->delete();
    				GoodsAttrValModel::where('attr_id',$attr->attr_id)->delete();
    			}
    			
    			if($cid->parentid==0){
    				$array1=array();
    				$cidList=CategoryModel::where('parentid',$cid->cid)->get();
    				foreach ($cidList as $cidt){
    					array_push($array1, $cidt->cid);
    				}
    				GoodsModel::where('cid',$array1)->delete();
    			}else{
    				GoodsModel::where('cid',$array[0])->delete();
    			}
    			
    			return response()->json([
    					'status'=>1
    				]);
    		}else{
    			return response()->json([
    					'status'=>-2,
    					'mess'=>'类别下的规格不错在或者删除发生错误'
    			]);
    		}	
    	}else{
    		return response()->json([
    				'status'=>-1,
    				'mess'=>'删除的类别不存在或者删除发生错误'
    		]);
    	}
    }
}
