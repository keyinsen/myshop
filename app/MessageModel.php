<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 *
 * @author fy
 *
 */
class MessageModel extends Model
{
    protected $table='message';
    protected $primaryKey = 'mid';
}
