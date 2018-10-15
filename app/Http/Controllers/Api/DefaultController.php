<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\models\Order;
use App\Http\Traits\ControllerTraits;
use App\User;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DefaultController extends Controller
{
    use ControllerTraits;
    public $da;
    public function show(Request $request)
    {
        pd_var(Order::onlyTrashed()->get());
    }

}
