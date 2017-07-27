<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;


use App\Http\Controllers\Controller;
use App\CategoryModel;
use App\AttrModel;
use phpDocumentor\Reflection\Types\Integer;
use App\GoodsAttrValModel;
use App\GoodsModel;
use App\AttrValueModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Symfony\Component\VarDumper\Cloner\DumperInterface;
use Illuminate\Support\Facades\DB;



class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	//商品类别
    public function index($cid,Request $request)
    {      
    		
        	//类别特征（类别属性名），每个商品的类别属性名
        	$categoryAttr=CategoryModel::where('cid',$cid)->first();
        	if(!empty($categoryAttr)){
        		$typename=$categoryAttr->toArray();
        		if($categoryAttr->parentid==0){
        			$categoryType=$categoryAttr->attr;
        			$array=array();
        			$zcid=CategoryModel::where('parentid',$categoryAttr->cid)->get();
        			foreach ($zcid as $c){
        				array_push($array, $c->cid);
        			}
        			$goodsList=GoodsModel::whereIn('cid',$array)->where('status',1)->paginate(8);
        			
        		}else{
        			$categoryAttr=CategoryModel::where('cid',$categoryAttr->parentid)->first();
        			$categoryType=$categoryAttr->attr;
        			$goodsList=GoodsModel::where('cid',$cid)->where('status',1)->paginate(8);
        		}
        		return view('Home/category')->with('categoryType',$categoryType)
        		->with('goodsList',$goodsList)
        		->with('typename',$typename);
        	}
        //如果找不到类别，就默认用第一个主类别下的商品信息
        $categoryAttr=CategoryModel::first();
        $array=array();
        $zcid=CategoryModel::where('parentid',$categoryAttr->cid)->get();
        foreach ($zcid as $c){
        	array_push($array, $c->cid);
        }
        //遍历出所以默认类别下的子类别
        $typename=CategoryModel::first();
        $categoryType=$categoryAttr->attr;
        $goodsList=GoodsModel::whereIn('cid',$array)->where('status',1)->paginate(8);
        $request->session()->forget('avid');
        return view('Home/category')->with('categoryType',$categoryType)->with('goodsList',$goodsList)
        ->with('typename',$typename); 
    }
    public  function choose(Request $request){
    	$name=[];
    	$avid=[];
    	$attr_id=[];
    	$chose=[];
    	$chose1=[];
    	$cid='';
    	$url=[];
    	$url1=[];
    	$index=0;
    	//dump($request->input());
    	//$filter=$request->input();
    	//每个a标签的查询字符串
    	$strget='';
    	foreach ($request->input() as $k=>$v){
    		if(($k!='?page')&&($k!='page')){
    		//拆分成 属性值id 属性名id 属性值 类别id
    		$valattrname=explode('_', $v);
    		//取里面的所有属性值id
    		array_push($avid, (int)$valattrname[0]);
    		//取里面的所有属性名id
    		array_push($attr_id, (int)$valattrname[1]);
    		//取里面的所有属性值
    		array_push($name, $valattrname[2]);
    		//取类别id
    		$cid=$valattrname[3];
    		$strget.='&'.$k.'='.$v;
    		}
    	}
    	//取所选的属性值对应的撤销get查询字符串
    	foreach ($request->input() as $k=>$v){
    		if(($k!='?page')&&($k!='page')){
    		array_push($url, '&'.$k.'='.$v);
    		}
    	}
    	//dump($url);exit;
    	foreach($request->input() as $k=>$v){
    		if(($k!='?page')&&($k!='page')){
    		$valattrname=explode('_', $v);
    		$chose1['name']= $k;
    		$chose1['value']= $valattrname[2];
    		$chose1['cid']=$cid;
    			$str='';
    			$url1=$url;
    			array_splice($url1, $index,1);
    			foreach ($url1 as $u1){
    				$str.=$u1;
    			}
    			$chose1['url']= $str;
    		
    		array_push($chose, $chose1);
    	    $index=$index+1;
    		}
    	}
    	//类别特征（类别属性名），每个商品的类别属性名
    	$categoryAttr=CategoryModel::where('cid',$cid)->first();
    	//对应的类别    
    	
    	if(!empty($categoryAttr)){
    		$typename=$categoryAttr->toArray();
    		$categoryType=$categoryAttr->attr;
    		//$goodsList=GoodsModel::where('cid',$cid)->paginate(8);
    		$a=[];
    		foreach ($categoryType as $ca){
    			$b='';
    			//过滤选中的属性名称
    			foreach ($attr_id as $attr){
    				if($ca->attr_id==$attr){
    					$b='';
    					break;
    				}
    				$b=$ca;
    			}
    			if(!empty($b)){
    				array_push($a, $b);
    			}
    		}
			$categoryType=$a;
			//取属性值对应的商品信息
			$avidstr='';
			$is_avid=true;
			foreach ($avid as $av){
				if($is_avid){
					$avidstr.='?';
					$is_avid=false;
				}else{
					$avidstr.=',?';
				}
				
			}
			array_push($avid, count($avid));
			//取属性值对应的商品信息  
			$sql= 'select * from shop_goods where gid in (
select count.gid from (select gid, count(gid) as num from shop_goods_attr where avid in('.$avidstr.') group by gid)
as count where count.num=?) and status=1';
			$goodsList=DB::select($sql,$avid);
			 $perPage = 3;
			  if ($request->has('?page')) {
			      $current_page = $request->input('?page');
			      $current_page = $current_page <= 0 ? 1 :$current_page;
			  } else {
			      $current_page = 1;
			  }
			  if(is_object($goodsList)){
			  $items = array_slice($goodsList->toArray(), ($current_page-1)*$perPage, $perPage); //注释1
			  }else{
			  	$items = array_slice($goodsList, ($current_page-1)*$perPage, $perPage); //注释1
			  }
			  $total = count($goodsList);
			  $str1='';
			  foreach ($url as $a){
			  	$str1.=$a;
			  }
			  //dump($url);exit;
			  $paginator=new LengthAwarePaginator($items, $total, $perPage,$current_page,[
			  		//'path' => Paginator::resolveCurrentPath(), //注释2
			  		'pageName' => 'page',
			  ]);
			  $paginator->setPath('category?'.$str1.'&');
			   $goodsData = $paginator->toArray()['data'];
			   $goodsList=[];
			   //$goodsData=compact('goodsData', 'paginator');
			   //dump($goodsData['goodsData'][0]->gid);exit;
			  // dump($goodsList);exit;
		return view('Home/category')->with('categoryType',$categoryType)->with('goodsList',$goodsList)->with('goodsData',compact('goodsData', 'paginator'))
        					->with('typename',$typename)->with('chose',$chose)->with('strget',$strget);
    	}
    }

}
