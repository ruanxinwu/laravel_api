<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Traits\ControllerTraits;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\JWTAuth;
use Logic\BaseLogic;
class AuthenticateController extends Controller
{
    use ControllerTraits;

    /**
     * 登录
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('name', 'password');
        $token = Auth::guard('api')->attempt($credentials);
        if($token === false){
            return response()->json($this->apiResponseError(ApiException::LOGIN_UNAUTHORISED));
        }
        return response()->json($this->apiResponseSuccess(['token' => $token]));
    }

    /**
     * 安全登出
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        try{
            Auth::guard('api')->logout();
        }catch(\Exception $exception){
            return response()->json($this->apiResponseError(ApiException::ERROR,$exception->getMessage()));
        }
        return response()->json($this->apiResponseSuccess());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $baseLogic = new BaseLogic();
        $input = $request->only('name','password','c_password');

        // 校验参数合法性
        $validator = Validator::make($input,User::registerRules());
        if ($validator->fails()) {
            return response()->json($this->apiResponseError(ApiException::REGISTER_ERROR,$validator->errors()->getMessages()), 401);
        }

        //密码加密
        $password = $input['password'];
        $input['password'] = bcrypt($password);

        // 用户保存数据库
        try{
            User::query()->create($baseLogic->filter($input,['name','password']));
        }catch (QueryException $exception){
            return response()->json($this->apiResponseError($exception->getCode(),$exception->getMessage()));
        }

        // 生成token返回
        $token = Auth::guard('api')->attempt(['name' => $input['name'],'password' => $password]);
        if($token === false){
            return response()->json($this->apiResponseError(ApiException::LOGIN_UNAUTHORISED));
        }
        return response()->json($this->apiResponseSuccess(['token' => $token]));
    }
}
