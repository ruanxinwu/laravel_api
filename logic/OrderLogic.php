<?php
namespace Logic;

use App\Http\models\Order;
use Illuminate\Support\Facades\Mail;

class OrderLogic extends CommonLogic
{
    public function demo()
    {
        return Order::findOrderNo(123);
    }
}