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
        pd(DB::table('users')->where('id',2)->toArray());
        return $this->apiResponseSuccess(Order::find(2)->toArray());
    }
}
