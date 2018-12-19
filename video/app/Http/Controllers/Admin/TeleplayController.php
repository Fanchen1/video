<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class TeleplayController extends Controller
{
    /**
     * 添加视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function teleplayAdd(){
        //       查分类
        $classify = DB::table('classify')
            ->select('c_id' , 'c_name','cat')
            ->where(['parent_id'=>10,'c_status'=>1])
            ->get();
        $classify = json_decode(json_encode($classify),true);
        if(empty($classify)){
            $classify = [];
        }
//        查电视剧父级id
        $teleplay_parent = json_decode(DB::table('teleplay')
            ->where('teleplay_status','=',1)
            ->get(),true);
        return view('Admin/Teleplay.Teleplay' ,compact('classify' ,'teleplay_parent' ));
    }
    /**
     * 执行添加
     * @param Request $request
     * @return false|string
     */
    public function teleplayAddDo(Request $request){
        $teleplay=$request->input();
        if(
            empty($teleplay['teleplayName']) ||
            empty($teleplay['teleplayYear']) ||
            empty($teleplay['teleplayImg'])  ||
            empty($teleplay['CfilmClassify']) ||
            empty($teleplay['teleplayDetails']) ||
            empty($teleplay['teleplayYuan']) ||
            empty($teleplay['teleplayBrief'])
        ){
            return Error('00001' , '缺少参数');
        }
        if(!$teleplay['power_id'] == 0){//入剧集表
            $data = [
                'serie_href'=>$teleplay['teleplayYuan'],
                'teleplay_id'=>$teleplay['power_id'],
                'serie_level'=>$teleplay['teleplayName'],
                'serie_status'=>1,
                'serie_ctime'=>time()
            ];
            //优化作去重
           $res =  DB::table('serie')->insert($data);
           if($res){
               return SuccessOk('200','添加剧集 成功' ,'');
           }else{
               return Error('00001' , '添加剧集 失败');
           }
        }else{//入电视剧表
            $data = [
                'teleplay_name'=>$teleplay['teleplayName'],
                'teleplay_img'=>$teleplay['teleplayImg'],
                'teleplay_details_url'=>$teleplay['teleplayDetails'],
                'classify_id'=>$teleplay['CfilmClassify'],
                'teleplay_yuan_url'=>$teleplay['teleplayYuan'],
                'teleplay_brief'=>$teleplay['teleplayBrief'],
                'teleplay_year'=>$teleplay['teleplayYear'],
                'teleplay_status'=>1,
                'teleplay_ctime'=>time(),
            ];
            //优化作去重
            $res=DB::table('teleplay')
                ->insert($data);
            if($res){
                return SuccessOk('200','添加电视剧 成功','');
            }else{
                return Error('00001' , '添加电视剧 失败');
            }
        }
    }
    /**
     * 采集电视剧
     * @param Request $request
     * @return false|mixed|string
     */
    public function caiDsj(Request $request){
        $dsj = $request->input();
        if(empty($dsj['teleplayUrl']) || empty($dsj['teleplayClassify']) || empty($dsj['teleplayPage'])){
            return Error('0001','缺少参数');
        }
        $res = curlRequest(config('domainApi').'dsjList' , $dsj);
        return $res;
    }




}
