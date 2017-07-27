<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 *
 * @author fy
 *
 */
class AttrModel extends Model
{
	protected $table='attr';
	protected $primaryKey = 'attr_id';
	public function attrValues(){
		return $this->hasMany('App\\AttrValueModel','attr_id');
	}
	
	//类别规格（特征属性）关联类别
	public function category(){
		return $this->belongsTo('App\CategoryModel','cid');
	}
}
