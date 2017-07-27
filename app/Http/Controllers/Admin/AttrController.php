<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CategoryModel;
use App\AttrModel;
use App\AttrValueModel;
use App\GoodsAttrValModel;

class AttrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$cate=CategoryModel::where('parentid',0)->get();
    	$specList=AttrModel::orderBy('cid','asc')->orderBy('attr_id','asc')->paginate(10);
    	
    	//dump($specList);exit;
        return view('admin/spec')->with('cate',$cate)->with('specList',$specList);
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
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$attr=new AttrModel();
    	$attr->cid=$request->input('cid');
    	$attr->title=$request->input('title');
        $attr->save();
        redirect('admin/spec')->send();
    }

   
    /**
     * Display the specified resource.
     *  在商品添加、修改页面通过ajax，根据类别id显示对应的属性
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$attrname=AttrModel::where('cid',$id)->get()->toArray();
    	$zcate=CategoryModel::where('parentid',$id)->get()->toArray();
    	return response()->json([
    			'status'=>1,
    			'attr'=>$attrname,
    			'zcate'=>$zcate
    	]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cate=CategoryModel::all();
    	$specList=AttrModel::orderBy('cid','asc')->paginate(10);
    	$editList=AttrModel::where('attr_id',$id)->first();
    	return view('admin/spec')->with('cate',$cate)
    	->with('specList',$specList)->with('editList',$editList);
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
        $attr=new AttrModel();
        $attr->where('attr_id',$id)->update($request->except('_token','_method'));
        redirect('admin/spec')->send();
    }

    /**
     * Remove the specified resource from storage.
     * 删除属性名，以及对应的属性值（规格 和此规格对应的参数）
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function del(Request $request)
    {
    	$removeid=explode('_', $request->input('removeid'));
    	$array=array();
    	foreach ($removeid as $re){
    		array_push($array, $re);
    	}
    	//dump($array);exit;
    	
    	//删除规格
    	$reattr=AttrModel::whereIn('attr_id',$array)->delete();
    	if(count($reattr)>0){
    		//删除选中的规格中对应的规格参数值
    		$revalue=AttrValueModel::whereIn('attr_id',$array)->delete();
    		if(count($revalue)>0){
    			//删除商品拥有此规格的所有规格参数值
    			$result=GoodsAttrValModel::whereIn('attr_id',$array)->delete();
    			if(count($result)>0){
    				return  response()->json([
    						'status'=>1
    				]);
    			}else{
    				return  response()->json([
    						'status'=>-3,
    						'mess'=>'删除商品拥有的规格参数值发生错误或者规格参数值不存在'
    				]);
    			}
    		}else{
    			return  response()->json([
    					'status'=>-2,
    					'mess'=>'删除规格参数发生错误或者规格参数不存在'
    			]);
    		}
    		
    	}else{
    		return  response()->json([
    				'status'=>-1,
    				'mess'=>'删除规格发生错误或者规格不存在'
    		]);
    	}
    	
    	
    }
}
