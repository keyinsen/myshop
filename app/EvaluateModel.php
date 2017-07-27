<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 *
 * @author fy
 *
 */
class EvaluateModel extends Model
{
    protected $table='evaluate';
    protected $primaryKey = 'eva_id';
    
    //相对关联商品
    public function goods(){
    	return $this->belongsTo('App\GoodsModel','gid');
    }
    
    //相对关联商品
    public function user(){
    	return $this->belongsTo('App\UserModel','uid');
    }
}
