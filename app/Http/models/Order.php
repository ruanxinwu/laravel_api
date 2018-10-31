<?php

namespace App\Http\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    //use SoftDeletes;

    //protected $table = '';

    const CREATED_AT = null;
    const UPDATED_AT = null;

    protected $hidden = ['id'];

    protected $fillable = ['order_no','demo']; // 白名单

    //protected $guarded = ['*']; // 黑名单，黑名单和白名单同时只能使用一个

    public function scopePopular($query,$status)
    {
        return $query->where('status',$status);
    }
}
