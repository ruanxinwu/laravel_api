<?php
/**
 * Created by PhpStorm.
 * User: ruanxinwu
 * Date: 2018/9/27
 * Time: 13:29
 */

namespace App\Exceptions;


use phpDocumentor\Reflection\Types\Self_;

class ApiException extends \Exception
{
    const SUCCESS = 200;
    const ERROR = 400;
    const FORBIDDEN = 403;
    const LOGIN_UNAUTHORISED = 10000;//nauthorised
    const REGISTER_ERROR = 10001;
    const TOKEN_ERROR = 10002;

    public static $errorMessage = array(
        self::SUCCESS => 'success',
        self::ERROR => '错误',
        self::FORBIDDEN => '无权访问',
        self::LOGIN_UNAUTHORISED => '用户名和密码不匹配',
        self::REGISTER_ERROR => '注册失败',
        self::TOKEN_ERROR => '无效token',
    );
}