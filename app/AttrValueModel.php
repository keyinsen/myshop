<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 *
 * @author fy
 *
 */
class AttrValueModel extends Model
{
    protected $table='attr_value';
	protected $primaryKey = 'avid';
	
	
	public function attrname(){
		return $this->belongsTo('App\\AttrModel','attr_id');
	}
}
