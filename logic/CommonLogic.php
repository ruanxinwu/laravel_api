<?php
/**
 * Created by PhpStorm.
 * User: ruanxinwu
 * Date: 2018/10/23
 * Time: 10:57
 */

namespace Logic;


use GuzzleHttp\Client;
use Illuminate\Support\Facades\Mail;
use OSS\Core\OssException;
use OSS\OssClient;
use PhpOffice\PhpSpreadsheet\IOFactory;

class CommonLogic
{
    /**
     * 发送邮件
     * @param array $config
     */
    public function sendEmail(array $config = [])
    {
        Mail::send('mail.sendMail',['data' => $config['data']],function($mail)use($config){
            $mail->to($config['to'])->subject($config['subject']);

            if(!empty($config['cc'])){
                $mail->cc($config['cc']);
            }
            if(!empty($config['attach'])){
                $mail->attach($config['attach']['file'],['as' => $config['attach']['as']]);
            }
        });
    }

    /**
     * 过滤不需要的字段
     * @param $collection(原始数据)
     * @param $condition($collection需要保留的键)
     * @return array $collection
     */
    public function filter(array $collection,array $condition)
    {
        foreach ($collection as $key => $value){
            if(!in_array($key,$condition)){
                unset($collection[$key]);
            }
        }
        return $collection;
    }

    /**
     * 校验参数是否合法
     * @param $params(原始数据)
     * @param $condition(必须传递的参数)
     * @return bool true(合法) false(不合法)
     */
    public function verifyParams(array $params,array $condition)
    {
        foreach ($condition as $value){
            if(!key_exists($value,$params)){
                return false;
            }
        }
        return true;
    }

    /**
     * 给目标数组赋值
     * @param $array(目标数组)
     * @param $params(需要的值)
     * @return array
     */
    public function assignment($array,$params)
    {
        foreach ($params as $key => $value){
            if(key_exists($key,$array)){
                array_push($array,$value);
            }else{
                $array[$key] = $value;
            }
        }
        return $array;
    }

    /**
     * http请求
     * @param array $config
     * @return object
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function httpRequest(array $config)
    {
        $request = (new Client())->request($config['method'],$config['url'],[
            'verify' => false, // https不需要证书
            'form_params' => isset($config['data'])?$config['data']:null, // post请求表单数据
        ]);
        return json_decode($request->getBody()->getContents());
    }

    /**
     * 上传文件到阿里云OSS
     * @param $object(上传之后的文件)
     * @param $file(被上传的文件)
     * @param $bucket(容器)
     * @return null
     * @throws \OSS\Core\OssException
     */
    public function uploadFileAliyunOss($object, $file, $bucket)
    {
        $client = new OssClient(env('ALIYUN_OSS_ACCESS_KEY_ID'),
           env('ALIYUN_OSS_ACCESS_KEY_SECRET'),env('ALIYUN_OSS_ENDPOINT'));
        $client->setTimeout(3600);
        $client->setConnectTimeout(10);
        return $client->uploadFile($bucket,$object,$file);
    }

    /**
     * @param $file
     * @param string $fileType
     * @return array
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     */
    public function readExcel($file,$fileType = 'xlsx')
    {
       return IOFactory::createReader($fileType)->load($file)
                    ->getActiveSheet()->toArray();
    }
}