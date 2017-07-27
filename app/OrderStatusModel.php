<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 *
 * @author fy
 *
 */
class OrderStatusModel extends Model
{
    protected $table='status_order';
    protected $primaryKey = 'osid';
}
