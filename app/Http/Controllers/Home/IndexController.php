<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;


use App\Http\Controllers\Controller;
use App\GoodsModel;
use App\CategoryModel;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$count=count(GoodsModel::all());
    	$goodsList=GoodsModel::offset($count-8)->limit(6)->where('status',1)->get();
    	$goodsList1=GoodsModel::offset($count-14)->limit(6)->where('status',1)->get();
    	$category=CategoryModel::all();
        return view('Home/index')->with('goodsList',$goodsList)->with('goodsList1',$goodsList1)->with('category',$category);
       
    }

}
