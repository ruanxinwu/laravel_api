<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\ControllerTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DefaultController extends Controller
{
    use ControllerTraits;
    public function show(Request $request)
    {
        sleep(3);
        return $this->apiResponseSuccess(array(
            'user' => $request->user->name,
            'api' => $request->getRequestUri(),
            'method' => $request->getMethod(),
            'request_at' => $request->request_at,
            'request' => $request->all(),
            'response_at' => date('Y-m-d H:i:s',time()),
            //'response' => $response->original
        ));

    }
}
