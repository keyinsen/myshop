<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 *
 * @author fy
 *
 */
class OrderModel extends Model
{
     protected $table='order';
     protected $primaryKey = 'oid';
     public $timestamps = true;
     
     public function orderDetail(){
     	return $this->hasMany('App\OrderDetailModel','oid');
     }
     
     //相对关联 订单表，关联订单状态表，相对于订单状态，本模型外键为订单状态表的主键 
     public function orderStatus(){
     	return $this->belongsTo('App\OrderStatusModel', 'osid');
     }
     
     public function recaddress(){
     	return $this->belongsTo('App\RecaddressModel', 'rec_id');
     }
     
     public function goodsStatus(){
     	return $this->belongsTo('App\GoodsStatusModel', 'gsid');
     }
}
