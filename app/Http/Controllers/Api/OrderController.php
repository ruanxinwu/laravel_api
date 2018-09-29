<?php

namespace App\Http\Controllers\Api;

use App\Http\models\Order;
use App\Http\Traits\ControllerTraits;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    use ControllerTraits;
    public function index(Request $request)
    {
        $file = $request->file('ss');
        $test = $file->extension();
        $store = $file->store('ruan123');
        //$test = $file->storeAs('jo','这个名字我自己定义.xlsx');
        //$test = 0;
        pd($file,$test,$store);
    }
    public function ab(){}
}
