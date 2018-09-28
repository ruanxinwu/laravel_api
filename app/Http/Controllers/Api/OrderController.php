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
        $model = new Order();
        dd($model->datas());
        return $this->apiResponseSuccess($model->datas());
    }
    public function ab(){}
}
