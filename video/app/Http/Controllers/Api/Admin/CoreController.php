<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use QL\QueryList;
class CoreController extends Controller
{
    private $query;
    private $url;
    private $headers = [
        // 伪造http头
        'headers' => [
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36',
        ]
    ];
    //设置实例化 ，采集主地址
    public function __construct(){
        $this->query = new QueryList;//实例化
        $this->url = 'https://www.360kan.com';//采集主地址
    }

    /**
     * 采集电影列表数据
     * createtime 最近上映    rankhot  最近热映    rankpoint 最近好评
     * @param int $page
     * @param string $Lately
     * @return array|Array
     */
    public function dyList(Request $request)
    {

        $CfilmUrl = $request ->input('CfilmUrl'); //采集地址 ， 页码 ， 分类
        $CfilmPage = $request ->input('CfilmPage'); //采集地址 ， 页码 ， 分类
        $CfilmClassify = $request ->input('CfilmClassify'); //采集地址 ， 页码 ， 分类
        if(empty($CfilmUrl) || empty($CfilmPage)){
            return var_json('00001','请求缺少参数！');
        }
        //是否有分类
        if(empty($CfilmClassify)){
            $CfilmClassify = 1;
        }

        //查询分类
        $ClassifyCat = DB::table('classify')
        ->select('cat')
        ->where(['c_id'=>$CfilmClassify , 'c_status'=>1])
        ->first();
        $ClassifyCat = json_decode(json_encode($ClassifyCat) ,true);
        if(empty($ClassifyCat) ){
            $ClassifyCat = 'all';
        }
        // 采集
        $rules = [
            'movie_name' => ['.s-tab-main .s1', 'text', ''],//电影名
            'movie_details_url' => ['.s-tab-main a.js-tongjic', 'href', ''],//电影详情地址
            'movie_img' => ['.s-tab-main .cover.g-playicon img', 'src', ''],//电影图片
            'movie_year' => ['.s-tab-main .hint', 'text'],//电影年月
        ];
        // createtime 最近上映    rankhot  最近热映    rankpoint 最近好评
        $data = $this->query
            ->get($CfilmUrl , ['cat'=>'all','year'=>'all','area'=>'all','act'=>'all','rank'=>'rankhot','cat'=>$ClassifyCat['cat'],'pageno'=>$CfilmPage,''],$this->headers)
            ->rules($rules)
            ->queryData();
        //是否采集到
        if(empty($data)){ //未采集到
            file_put_contents('./error.txt',date('Y-m-d H:i:s',time())."----------电影--采集不到请及时更换！！！！\r\n",FILE_APPEND);
            return var_json('00005','电影--采集不到请及时更换！！！！');
        }else{ //采集到了
            // 判断是否有重复的
            $movie = DB::table('movie')
                ->select('movie_name' ,'movie_img' , 'movie_details_url','movie_year')
                ->get();
            $movie = json_decode(json_encode($movie) , true);
            //去重
                foreach($movie as $k=>$v) {
                    foreach ($data as $kk => $vv) {
                        if (in_array($vv['movie_name'], $v)) {
                            unset($data[$kk]);
                        }
                    }
                }
                if(empty($data)){ //有重复的
                    return var_json('00001','暂无新资源，换一下试试！');
                }
                //赋值
                foreach ($data as $key=>$value){
                    $data[$key]['classify_id'] = $CfilmClassify;
                    $data[$key]['movie_status'] = 1;
                    $data[$key]['movie_ctime'] = time();
                }
            //  入库
                $res = DB::table('movie')->insert($data);
                if($res){
                    return var_json('','已更新资源');
                }else{
                    file_put_contents('./error.txt',date('Y-m-d H:i:s',time())."----------电影--添加失败请检查！！！！\r\n",FILE_APPEND);
                    return var_json('00001','添加失败');
                }
        }
    }

    /**
     * 采集电视剧列表数据
     * createtime 最近上映    rankhot  最近热映    rankpoint 最近好评
     * @param int $page
     * @param string $Lately
     * @return array|Array
     */
    public function dsjList(Request $request)
    {

        $teleplayUrl = $request ->input('teleplayUrl'); //采集地址 ， 页码 ， 分类
        $teleplayPage = $request ->input('teleplayPage'); //采集地址 ， 页码 ， 分类
        $teleplayClassify = $request ->input('teleplayClassify'); //采集地址 ， 页码 ， 分类
        if(empty($teleplayUrl) || empty($teleplayPage)){
            return var_json('00001','请求缺少参数！');
        }
        //是否有分类
        if(empty($teleplayClassify)){
            $teleplayClassify = 1;
        }

        //查询分类
        $ClassifyCat = DB::table('classify')
            ->select('cat')
            ->where(['c_id'=>$teleplayClassify , 'c_status'=>1])
            ->first();
        $ClassifyCat = json_decode(json_encode($ClassifyCat) ,true);
        if(empty($ClassifyCat) ){
            $ClassifyCat = 'all';
        }

        // 采集
        $rules = [
            'teleplay_name' => ['.s-tab-main .s1', 'text', ''],//电视剧名
            'teleplay_details_url' => ['.s-tab-main a.js-tongjic', 'href', ''],//电视剧详情地址
            'teleplay_img' => ['.s-tab-main .cover.g-playicon img', 'src', ''],//电视剧图片
            'teleplay_year' => ['.s-tab-main .hint', 'text'],//电视剧年月
        ];
        // createtime 最近上映    rankhot  最近热映    rankpoint 最近好评
        $data = $this->query
            ->get($teleplayUrl , ['cat'=>'all','year'=>'all','area'=>'all','act'=>'all','rank'=>'rankhot','cat'=>$ClassifyCat['cat'],'pageno'=>$teleplayPage,''],$this->headers)
            ->rules($rules)
            ->queryData();

//        print_r($data);exit;

        //是否采集到
        if(empty($data)){ //未采集到
            file_put_contents('./error.txt',date('Y-m-d H:i:s',time())."----------电视剧--采集不到请及时更换！！！！\r\n",FILE_APPEND);
            return var_json('00005','电视剧--采集不到请及时更换！！！！');
        }else{ //采集到了
            // 判断是否有重复的
            $movie = DB::table('teleplay')
                ->select('teleplay_name' ,'teleplay_img' , 'teleplay_details_url','teleplay_year')
                ->get();
            $movie = json_decode(json_encode($movie) , true);
//            //去重
            foreach($movie as $k=>$v) {
                foreach ($data as $kk => $vv) {
                    if (in_array($vv['teleplay_name'], $v)) {
                        unset($data[$kk]);
                    }
                }
            }

            if(empty($data)){ //有重复的
                return var_json('00001','暂无新资源，换一下试试！');
            }
            //赋值
            foreach ($data as $key=>$value){
                $data[$key]['classify_id'] = $teleplayClassify;
                $data[$key]['teleplay_status'] = 1;
                $data[$key]['teleplay_ctime'] = time();
            }
//            print_r($data);
            //  入库

            $res = DB::table('teleplay')->insert($data);
            if($res){
                return var_json('','已更新资源');
            }else{
                file_put_contents('./error.txt',date('Y-m-d H:i:s',time())."----------电影--添加失败请检查！！！！\r\n",FILE_APPEND);
                return var_json('00001','添加失败');
            }
        }
    }



    /**
     * 搜索尝鲜详情地址
     * @param $url
     * @param $key
     * @return mixed
     */
    public function getCx(Request $request){
        $url = $request->input('url');
        $key = $request->input('key');
        if(empty($url) || empty($key)){
            return Error('0001' , '缺少参数！');
        }

//        $dizhi  = 'www.156zy.cc';//死的
//        $key = '无敌破坏王';//死的
        $url1 = 'http://'.$url.'/index.php?m=vod-search';
        $arr = ['wd'=>$key,'submit'=>'search'];
        $html = curl_post($url1,$arr);
        $rules = [
            'url'=>['.xing_vb4:eq(0) a','href','']
        ];
        $data = $this->query->html($html)->rules($rules)->queryData();
        if(empty($data)){
            return SuccessOk('200','搜不到','');
        }

        $data[0]['url']    = 'http://'.$url.$data[0]['url'];
        $res = $data[0]['url'] ;

        //获取尝鲜影片的地址图片详情
        $rules = [
            'dyname'=>['.vodh h2','text'],
            'dydesc'=>['.vodplayinfo:eq(1)','text',''],
            'dylogo'=>['.lazy','src'],
            'dyyear'=>['.vodinfobox ul li:eq(6)','text'],

            'dyaddr'=>['ul:eq(6) li','text']
        ];
        $datass = $this->query->get($res)->rules($rules)->queryData();
        if(empty($datass)){
            return SuccessOk('200','搜不到','');
        }else{
            return SuccessOk('200','搜索成功','',$datass);
        }



    }




}
