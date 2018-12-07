<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class LoginApiController extends Controller
{
    //登录api
    public function loginApi(Request $request){
        $data = $request->input();
        if(empty($data['adminName']) || empty($data['adminPwd'])){
            return var_json('00001','缺少参数');
        }
        //根据 admin_name 查找有没有这个账号
       $admin= (array)DB::table('admin')->where(['admin_name'=>$data['adminName']])->first();
       if(empty($admin)){//没有找到用户
           return var_json('00002','参数值错误',[]);
       }else{ //有这个管理员
           //判断密码
           $pwd = md5($data['adminPwd'] . $admin['admin_id'] . $admin['admin_salt']);
           if($admin['admin_pwd'] ==  $pwd ){
               if($admin['admin_status'] == 1){
                   $Fan = [
                       'adminName'=>$admin['admin_name'],
                       'adminImg'=>$admin['admin_img'],
                       'adminTime'=>$admin['admin_time']
                   ];
                   return var_json('10000','成功',$Fan);
               }else{
                   return var_json('00003','此管理员不在正常状态下',[]);
               }
           }else{
               return var_json('00002','参数值错误',[]);
           }
       }






    }


}
