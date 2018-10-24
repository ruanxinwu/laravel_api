<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ApiException;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;
use App\Http\Traits\ControllerTraits;
class LoginController extends Controller
{
    use ControllerTraits;
    public $successStatus = 200;


    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        if(Auth::attempt(['name' => request('name'), 'password' => request('password')])){
            request()->user = $user = Auth::user();
            $token = $user->createToken();
            return response()->json($this->apiResponseSuccess(array('token' => $token)), $this->successStatus);
        }
        else{
            return response()->json($this->apiResponseError(ApiException::LOGIN_UNAUTHORISED),401);
        }
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $input = $request->all();

        // 校验参数合法性
        $validator = Validator::make($input,User::registerRules());
        if ($validator->fails()) {
            return response()->json($this->apiResponseError(ApiException::REGISTER_ERROR,$validator->errors()->getMessages()), 401);
        }

        //密码加密
        $input['password'] = bcrypt($input['password']);

        // 用户保存数据库
        $user = User::query()->create($input);

        // 修改用户token
        $token = $user->createToken();

        return response()->json($this->apiResponseSuccess(array('token' => $token)), $this->successStatus);
    }

    /**
     * api loginOut
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginOut(Request $request)
    {
        User::query()->updateOrCreate(
            ['api_token' => $request->get('token')],
            ['api_token' => null]
        );
        return response()->json($this->apiResponseSuccess());
    }
}
