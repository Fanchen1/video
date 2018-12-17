<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TvController extends Controller
{
    //电影添加
    public function dyAdd(){
//        查分类
        $classify = DB::table('classify')
            ->select('c_id' , 'c_name','cat')
            ->where(['parent_id'=>1,'c_status'=>1])
            ->get();
        $classify = json_decode(json_encode($classify),true);
        if(empty($classify)){
            $classify = [];
        }
//        print_r($classify);exit;
       return view('Admin/Film.Film',compact('classify'));
    }
    //电影手动执行添加
    public function dyAddDo(Request $request){
        $dy = $request ->input();
//        print_r($dy);exit;
        if(empty($dy['filmName']) ||
            empty($dy['filmYear']) ||
            empty($dy['filmBrief']) ||
            empty($dy['filmImg']) ||
            empty($dy['filmYuan']) ||
            empty($dy['ZfilmClassify']) ||
            empty($dy['filmDetails'])
        ){
            return Error('00001','请求缺少参数！' );
        }
        $data = [
            'movie_name'=>$dy['filmName'],
            'movie_year'=>$dy['filmYear'],
            'movie_brief'=>$dy['filmBrief'],
            'movie_img'=>$dy['filmImg'],
            'movie_yuan_url'=>$dy['filmYuan'],
            'classify_id'=>$dy['ZfilmClassify'],
            'movie_details_url'=>$dy['filmDetails'],
            'movie_status'=>1
        ];
//        print_r($data);exit;
        // 判断是否有重复的
        $movie = DB::table('movie')
            ->select('movie_name' ,'movie_img' , 'movie_details_url','movie_year')
            ->get();
        $movie = json_decode(json_encode($movie) , true);
        $repeated =1;  //不重复
        foreach ($movie as $k=>$v){
            if(in_array($data['movie_name'] , $v)){
                $repeated =0;//重复
            }
        }
        if($repeated == 0){//重复
            return Error('00001' , '这条资源已经重复了！换一个试试吧！');
        }else{
//            print_r($data);exit;
           $isRes =  DB::table('movie')->insert($data);
           if($isRes){
               return SuccessOk('200','已更新资源','');
           }else{
               return Error('00001' , '添加失败');
           }
        }


    }

    //采集电影后台
    public function caidy(Request $request){
        $data = $request->input();
        if(empty($data['CfilmUrl']) || empty($data['CfilmClassify']) || empty($data['CfilmPage'])){
            return Error('00001','参数不能为空！');
        }
          $res = curlRequest( config('domainApi').'dyList' , $data);
          return $res;
    }











}
