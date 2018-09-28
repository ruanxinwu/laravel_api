<?php

namespace App\Http\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    protected $table = 'users';

    protected $hidden = ['id'];
    public function datas()
    {
        return self::find(2);
    }
}
