<?php

namespace App\Http\Middleware;

use App\Exceptions\ApiException;
use App\Http\Traits\ControllerTraits;
use Closure;

class Permission
{
    use ControllerTraits;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$param)
    {
        $params = is_array($param)?$param:explode('|',$param);

        // 判断角色
        if($request->user->hasAnyRole($params)) {
            return $next($request);
        }

        // 判断权限
        foreach ($params as $value) {
            if ($request->user->can($value)) {
                return $next($request);
            }
        }

        return response()->json($this->apiResponseError(ApiException::FORBIDDEN));
    }
}
