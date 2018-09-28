<?php

namespace App\Http\Middleware;

use App\Exceptions\ApiException;
use App\Http\Traits\ControllerTraits;
use App\User;
use Closure;
use Illuminate\Support\Facades\DB;

class CheckToken
{
    use ControllerTraits;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->request_at =  date('Y-m-d H:i:s',time());

        // 获取token,如果get和post同时传的话，取get的token
        $token = $request->get('token');
        $user = DB::table('users')
            ->select(['id','name','email'])
            ->where([['api_token','=',$token],['expire_at','>',date('Y-m-d H:i:s',time())]])
            ->first();
        if($user === null) {
            return response()->json($this->apiResponseError(ApiException::TOKEN_ERROR));
        }
        // 存储用户信息
        $request->user = $user;
        $response = $next($request);
        return $response;
    }
}
