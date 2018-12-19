<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class ComicController extends Controller
{
    /**
     * .动漫添加
     */
    public function comicAdd(){
        //       查分类
        $classify = DB::table('classify')
            ->select('c_id' , 'c_name','cat')
            ->where(['parent_id'=>11,'c_status'=>1])
            ->get();
        $classify = json_decode(json_encode($classify),true);
        if(empty($classify)){
            $classify = [];
        }
//        查电视剧父级id
        $comic_parent = json_decode(DB::table('comic')
            ->where('comic_status','=',1)
            ->get(),true);
        return view('Admin/Comic.Comic' ,compact('classify' ,'comic_parent' ));
    }

    /**
     * 执行动漫添加
     * @param Request $request
     * @return false|string
     */
    public function comicAddDo(Request $request){
        $comic=$request->input();
        if(
            empty($comic['ComicName']) ||
            empty($comic['ComicYear']) ||
            empty($comic['ComicImg'])  ||
            empty($comic['ComicClassify']) ||
            empty($comic['ComicDetails']) ||
            empty($comic['ComicYuan']) ||
            empty($comic['ComicBrief'])
        ){
            return Error('00001' , '缺少参数');
        }
        if(!$comic['power_id'] == 0){//入剧集表
            $data = [
                'comic_serie_href'=>$comic['ComicYuan'],
                'comic_id'=>$comic['power_id'],
                'comic_serie_level'=>$comic['ComicName'],
                'comic_serie_status'=>1,
                'comic_serie_ctime'=>time()
            ];
            //优化作去重

            $res =  DB::table('comic_serie')->insert($data);
            if($res){
                return SuccessOk('200','添加动漫剧集 成功' ,'');
            }else{
                return Error('00001' , '添加动漫剧集 失败');
            }
        }else{//入电视剧表
            $data = [
                'comic_name'=>$comic['ComicName'],
                'comic_img'=>$comic['ComicImg'],
                'comic_details_url'=>$comic['ComicDetails'],
                'classify_id'=>$comic['ComicClassify'],
                'comic_yuan_url'=>$comic['ComicYuan'],
                'comic_brief'=>$comic['ComicBrief'],
                'comic_year'=>$comic['ComicYear'],
                'comic_status'=>1,
                'comic_ctime'=>time(),
            ];
            //优化作去重
            $res=DB::table('comic')
                ->insert($data);
            if($res){
                return SuccessOk('200','添加动漫 成功','');
            }else{
                return Error('00001' , '添加动漫 失败');
            }
        }




    }

    public function caiComic(Request $request){
        $dm = $request->input();
        if(empty($dm['ComicUrl']) || empty($dm['ComicClassify']) || empty($dm['ComicPage'])){
            return Error('0001','缺少参数');
        }
        $res = curlRequest(config('domainApi').'dmList' , $dm);
        print_r($res);exit;
        return $res;
    }


}
