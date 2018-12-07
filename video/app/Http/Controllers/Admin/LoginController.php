<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    //后台登录视图
    public function Login(Request $request){
        if($request->isMethod('get')){
            return view('Admin/Login.Login');
        }elseif ($request->isMethod('post')){
            $data['adminName'] =  $request->input('admin_name');//接受数据
            $data['adminPwd'] =  $request->input('admin_pwd');//接受数据
            if(empty($data['adminName'])){ //判断账号
                return Error('','账号不能为空');
            }
            if(empty($data['adminPwd'])){//判断密码
                return Error('','密码不能为空');
            }
            //跨域传输
            $url = config('domainApi').'LoginApi';
            $admin=json_decode(curlRequest($url,$data),true);
            if(empty($admin) ) {
                return Error('010101', '系统错误');
            }
            if($admin['status'] == '00001'){
                return Error('010101', '系统错误');
            }else if($admin['status'] == '00002'){
                return Error('00002','账号或密码不正确！');
            }else if($admin['status'] == '00003'){
                return Error('00002','此管理员不在正常状态下！');
            }else if($admin['status'] == '10000'){
                //success 存管理员姓名
                session(['adminName' => $admin['data']['adminName']]);
                session(['adminImg' => 'http://'.$_SERVER['HTTP_HOST'].$admin['data']['adminImg']]);
                return SuccessOk(200,$admin['data']['adminName'] . '--欢迎你的到来',config('domainAdmin').'/' );
            }

        }


    }













}
