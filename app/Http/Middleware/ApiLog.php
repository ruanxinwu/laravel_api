<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class ApiLog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $array = array(
            'user' => isset($request->user->name)?$request->user->name:null,
            'api' => $request->getRequestUri(),
            'method' => $request->getMethod(),
            'request_at' => $request->request_at,
            'request' => $request->all(),
            'response_at' => date('Y-m-d H:i:s',time()),
            'response' => $response->original
        );
        Log::info('apiLog',$array);
        return $response;
    }


}
