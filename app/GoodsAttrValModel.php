<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 *
 * @author fy
 *
 */
class GoodsAttrValModel extends Model
{
    protected $table='goods_attr';
    
    /**
     * 通过类别的属性值获得对应的商品信息
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function choosegoodsIs(){
    	return $this->belongsTo('App\\GoodsModel','gid');
    }
    
}
