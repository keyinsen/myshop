<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 *
 * @author fy
 *
 */
class UserModel extends Model
{
    protected $table='user';
    protected $primaryKey = 'uid';
    protected $guarded = ['_token'];
    
//     public  function cartGoods(){
//     	return $this->belongsToMany('App\\GoodsModel','cart','uid','gid')->withPivot('num');
//     }
        public  function cartGoods(){
        	return $this->hasMany('App\\CartModel','uid');
        }
    
}
