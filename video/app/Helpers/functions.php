<?php


/**
 * 比较标准的接口输出函数
 * @param string  $info 消息
 * @param integer $code 接口错误码，很关键的参数
 * @param array   $data 附加数据
 * $param string  $location 重定向
 * @return array
 */
function var_json( $status = 10000,$msg = '', $data =[]) {
    $out['status'] = $status ?: 0;
    $out['msg'] = $msg ?: ($out['status'] ? 'error' : 'success');
    $out['data'] = $data ?: array();
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($out, JSON_UNESCAPED_UNICODE);
    exit(0);
}

/**
使用curl方式实现get或post请求
@param $url 请求的url地址
@param $data 发送的post数据 如果为空则为get方式请求
return 请求后获取到的数据
 */
function curlRequest($url,$data = ''){
    $ch = curl_init();
    $params[CURLOPT_URL] = $url;    //请求url地址
    $params[CURLOPT_HEADER] = false; //是否返回响应头信息
    $params[CURLOPT_RETURNTRANSFER] = true; //是否将结果返回
    $params[CURLOPT_FOLLOWLOCATION] = true; //是否重定向
    $params[CURLOPT_TIMEOUT] = 30; //超时时间
    if(!empty($data)){
        $params[CURLOPT_POST] = true;
        $params[CURLOPT_POSTFIELDS] = $data;
    }
    $params[CURLOPT_SSL_VERIFYPEER] = false;//请求https时设置,还有其他解决方案
    $params[CURLOPT_SSL_VERIFYHOST] = false;//请求https时,其他方案查看其他博文
    curl_setopt_array($ch, $params); //传入curl参数
    $content = curl_exec($ch); //执行
    curl_close($ch); //关闭连接
    return $content;
}

/**
 * 自封的curl方法
 * @param $url 地址
 * @param string $data post参数
 * @return mixed
 */
function curlKua($url , $data=''){
    $ch = curl_init();
    curl_setopt($ch ,CURLOPT_URL, $url);
    curl_setopt($ch ,CURLOPT_RETURNTRANSFER, 1);
    if(!empty($data)){//为post的提交
        curl_setopt($ch ,CURLOPT_POST , 1 );//为post的提交
        curl_setopt($ch ,CURLOPT_POSTFIELDS , $data );//post 参数
    }
    curl_setopt($ch ,CURLOPT_SSL_VERIFYPEER , 0 );//HTTPS 禁止 cURL 验证对等证书
    curl_setopt($ch ,CURLOPT_SSL_VERIFYHOST	, 0  );// 0 为不检查名称。
    $res = curl_exec($ch);	//执行
    $error = curl_error($ch);//错误
    curl_close($ch);//关闭curl
    return $res ;
}

/**
 * 正确返回值
 * @param $msg 正确提示
 * @param string $data 返回参数
 * @return false|string
 */
function SuccessOk($status='200',$msg,$url, $data=''){
    return json_encode(
        ['status'=>$status , 'msg'=>$msg , 'url'=>$url, 'data'=>$data]
    );
}

/**
 * 错误返回值
 * @param $msg 错误提示
 * @param string $data 返回参数
 * @return false|string
 */
function Error($status='00001',$msg, $data=''){
    return json_encode(
        ['status'=>$status , 'msg'=>$msg , 'data'=>$data]
    );
}







?>