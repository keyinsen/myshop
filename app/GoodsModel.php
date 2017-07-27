<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 *
 * @author fy
 *
 */
class GoodsModel extends Model
{
    protected $table='goods';
    protected $primaryKey = 'gid';
    
    public function goodsImage(){
    	return $this->hasMany('App\GoodsImageModel','gid');
    }
    
    public function categorys(){
    	return $this->belongsTo('App\\CategoryModel','cid');
    }
    
    public  function evaluate(){
    	return $this->hasMany('App\EvaluateModel','gid');
    }
    
    //商品特征值表 ，一个商品对应多个商品特征值,一个商品特征值对应多个商品
    //第一个参数是要关联的表，第2个参数是中间表（第三方表），第三个参数本模型的主键，第四个是关联模型的主键
    public function belongsTOAttrVal(){
    	return $this->belongsToMany('App\\AttrValueModel','goods_attr','gid','avid');
    }
}
