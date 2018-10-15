<?php

namespace App\Http\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use SoftDeletes;

    //protected $table = '';

    const CREATED_AT = null;
    const UPDATED_AT = null;

    protected $hidden = ['id'];

    protected $fillable = ['order_no'];

    protected $dates;
    /**
     * query by order_no
     * @param $orderNo
     * @param array $selects
     * @return \Illuminate\Database\Eloquent\Builder|Model|null|object
     */
    public static function findOrderNo($orderNo,$selects = ['*'])
    {
        return self::query()->select($selects)->where('order_no','=',$orderNo)->first();
    }

}
