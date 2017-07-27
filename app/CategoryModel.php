<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 *
 * @author fy
 *
 */
class CategoryModel extends Model
{
   protected $table='category';
    protected $primaryKey = 'cid';
    
    public function attr(){
    	return $this->hasMany('App\\AttrModel','cid');
    }
    
    public function goodsIs(){
    	return $this->hasMany('App\\GoodsModel','cid');
    }
}
