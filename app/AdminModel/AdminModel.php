<?php

namespace App\AdminModel;

use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
   protected $table='admin';
   protected $primaryKey = 'admin_id';
   
   //管理员表有角色表的id，所以是管理员表相对管理角色表
   public  function role(){
   	return  $this->belongsTo('App\AdminModel\RoleModel', 'role_id');
   }
}
