<?php

namespace App\Http\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{

    //protected $table = '';

    const CREATED_AT = null;
    const UPDATED_AT = null;

    protected $hidden = ['id'];

    protected $fillable = ['order_no'];
    public static function findOrderNo($orderNo,$selects = ['*'])
    {
        return self::query()->select($selects)->where('order_no','=',$orderNo)->first();
    }

}
