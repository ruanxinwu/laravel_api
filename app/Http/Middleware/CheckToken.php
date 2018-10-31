<?php

namespace App\Http\Middleware;

use App\Exceptions\ApiException;
use App\Http\Traits\ControllerTraits;
use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class CheckToken extends BaseMiddleware
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
        // 检测请求是否存在token
        try{
            $this->checkForToken($request);
        }catch(UnauthorizedHttpException $exception){
            return response()->json($this->apiResponseError(ApiException::ERROR,$exception->getMessage()));
        }

        try{
            // 校验token
            if( $user = $this->auth->parseToken()->authenticate()){
                $request->user = $user;
                return $next($request);
            }
            throw new UnauthorizedHttpException('jwt-auth', '未登录');
        }catch (\Exception $exception){
            return response()->json($this->apiResponseError(ApiException::TOKEN_ERROR,$exception->getMessage()));
        }
    }
}
