<?php
/**
 * Created by PhpStorm.
 * User: ruanxinwu
 * Date: 2018/9/27
 * Time: 14:26
 */

namespace App\Http\Traits;


use App\Exceptions\ApiException;

trait ControllerTraits
{
    // 成功返回
    public function apiResponseSuccess($data = array(),$code = ApiException::SUCCESS,$message = 'success')
    {
        return $this->apiResponse($code,$message,$data);
    }

    // 返回数据格式
    private function apiResponse($code,$message,$data = array())
    {
        return array(
            'code' => $code,
            'message' => $message,
            'data' => $data
        );
    }

    // 失败返回
    public function apiResponseError($code,$message = '',$exceptionClass = 'ApiException')
    {
        $exceptionClass = 'App\Exceptions\\' . $exceptionClass;
        if($message === '') {
            $message = isset($exceptionClass::$errorMessage[$code])?$exceptionClass::$errorMessage[$code]:'未知错误';
        }

        return $this->apiResponse($code,$message);
    }
}