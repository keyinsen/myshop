<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 *
 * @author fy
 *
 */
class CollectModel extends Model
{
    protected $table='collect';
    protected $primaryKey = 'collect_id';
    
    //相对关联商品信息
    public function goods(){
    	return $this->belongsTo('App\GoodsModel','gid');
    }
}
