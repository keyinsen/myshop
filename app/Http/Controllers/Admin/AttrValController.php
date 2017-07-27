<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CategoryModel;
use App\AttrValueModel;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use App\AttrModel;

class AttrValController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    	$cate=CategoryModel::where('parentid',0)->get();
    	$specvalList=AttrValueModel::orderBy('attr_id')->orderBy('avid')->Paginate(10);
    	return  view('admin/specval')->with('cate',$cate)
    	->with('specvalList',$specvalList);
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
     *  添加规格参数
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	//dump($request->input());exit;
        $attr_id=$request->input('attr_id');
        $value=$request->input('value');
        $attrval=new AttrValueModel();
        $re=$attrval->where('value',$value)->where('attr_id',$attr_id)->get();
       // dump(count($re));exit;
        if(count($re)==0){
        	$attrval->attr_id=$attr_id;
        	$attrval->value=$value;
        	$attrval->save();
        }
        
        redirect('admin/specval')->send();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $attrval=AttrValueModel::where('attr_id',$id)->get()->toArray();
        if(count($attrval)>0){
        	return response()->json([
        			'status'=>1,
        			'attrval'=>$attrval
        	]);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *  修改参数值
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$cate=CategoryModel::all();
    	$specvalList=AttrValueModel::orderBy('attr_id')->orderBy('avid')->Paginate(10);
    	$editList=AttrValueModel::where('avid',$id)->first();
    	$editCid=$editList->attrname->category->cid;
    	$editAttrList=AttrModel::where('cid',$editCid)->get();
    	return  view('admin/specval')->with('cate',$cate)
    	->with('specvalList',$specvalList)
    	->with('editList',$editList)->with('editAttrList',$editAttrList);
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
    	$cid=$request->input('cid');
    	$attr_id=$request->input('attr_id');
    	$value=$request->input('value');
    	//更新属性值和对应的属性名称
    	AttrValueModel::where('avid',$id)->update(['value'=>$value,'attr_id'=>$attr_id]);
    	//更新对应类别
        AttrModel::where('attr_id',$attr_id)->update(['cid'=>$cid]);
        redirect('admin/specval')->send();
    }

    /**
     * Remove the specified resource from storage.
     *  删除、批量删除
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
    	//删除规格值
    	$revalue=AttrValueModel::whereIn('avid',$array)->delete();
    	if(count($revalue)>0){
    		//删除商品规格值
    		$result=GoodsAttrValModel::whereIn('avid',$array)->delete();
    		if(count($result)>0){
    			return  response()->json([
    					'status'=>1
    			]);
    		}else{
    			return  response()->json([
    					'status'=>-2
    			]);
    		}
    	}else{
    		return  response()->json([
    				'status'=>-1
    		]);
    	}

    }
}
