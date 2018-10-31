<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\models\Order;
use App\Http\Traits\ControllerTraits;
use App\User;
use function foo\func;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Logic\BaseLogic;
use Logic\OrderLogic;
use OSS\Core\OssException;
use OSS\OssClient;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tymon\JWTAuth\JWTAuth;

class DefaultController extends Controller
{
    use ControllerTraits;
    public function show(Request $request)
    {
        $model = new OrderLogic();
        pd($model->scope(1));
    }

}
