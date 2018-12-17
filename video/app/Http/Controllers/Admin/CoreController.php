<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use QL\QueryList;
class CoreController extends Controller
{
    private $ql;
    private $domin;
    private $opts = [
        // 伪造http头
        'headers' => [
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36',
        ]
    ];

    //初始化采集类
    public function __construct()
    {
        $this->ql = new QueryList();
        $this->domin = "https://www.360kan.com";
    }

    #采集电视剧--列表数据
    public function dsjList()
    {
        $urlDs  = $this->domin.'/dianshi/list';
        $rules = [
            'title' => ['.s-tab-main .title .s1', 'text', ''],
            'url' => ['.s-tab-main a.js-tongjic', 'href', ''],
            'img' => ['.s-tab-main  img', 'src', ''],
            'js' => ['.s-tab-main .hint', 'text', ''],
            'star' => ['.s-tab-main .star', 'text', '']
        ];
        $data = $this->ql->get($urlDs , '',$this->opts)->rules($rules)->queryData();
        if(empty($data)){
            file_put_contents('./error.txt',date('Y-m-d H:i:s',time())."----------电视剧--采集不到请及时更换！！！！\r\n",FILE_APPEND);
            return [];
        }else{
            return $data;
        }

    }
    #采集电视剧--详情数据 ------有问题
    public function dsjDetails(){
        $dsj = $this->dsjList();
        $rules = [
            'title' => ['h1', 'text'],
            'img' => ['.s-cover-img img', 'src', ''],
//            'url'=>['.s-top-list-ji .num-tab-main a','href'],
        ];
//        foreach($dsj as $k=>$v){
//            $url= $this->domin . $v['url'];
//            $jian[] = $this->ql->get($url )->rules($rules)->queryData();
//        }
        $rules2 = [
            'url'=>['.s-top-list-ji .num-tab-main a','href'],
        ];
        foreach($dsj as $kk=>$vv){
            $url= $this->domin . $vv['url'];
            $jian2[] = $this->ql->get($url )->rules($rules2)->queryData();
        }
        print_r($jian2);exit;
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
        $dylist = $request ->input();
        if(empty($dylist['CfilmUrl']) || empty($dylist['CfilmPage']) || empty($dylist['CfilmClassify'])){
            return Error('00001','请求缺少参数！' );
        }
        //查询分类
            $dylist['ClassifyCat'] = DB::table('classify')
                ->select('cat')
                ->where(['c_id'=>$dylist['CfilmClassify'] , 'c_status'=>1])
                ->first();
            $ClassifyCat = json_decode(json_encode($dylist['ClassifyCat']) ,true);
            if(empty($ClassifyCat) ){
                $ClassifyCat = 'all';
            }
         // 采集
        $rules = [
            'movie_name' => ['.s-tab-main .s1', 'text', ''],
            'movie_details_url' => ['.s-tab-main a.js-tongjic', 'href', ''],
            'movie_img' => ['.s-tab-main .cover.g-playicon img', 'src', ''],
            'movie_year' => ['.s-tab-main .hint', 'text'],
        ];
        // createtime 最近上映    rankhot  最近热映    rankpoint 最近好评
        $data = $this->ql->get($dylist['CfilmUrl'] , ['cat'=>'all','year'=>'all','area'=>'all','act'=>'all','rank'=>'rankhot','cat'=>$ClassifyCat['cat'],'pageno'=>$dylist['CfilmPage'],''],$this->opts)->rules($rules)->queryData();
        if(empty($data)){
            file_put_contents('./error.txt',date('Y-m-d H:i:s',time())."----------电影--采集不到请及时更换！！！！\r\n",FILE_APPEND);
            return Error('00001' , '电影--采集不到请及时更换！！！！');
        }else{
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
            if(empty($data)){
                return Error('00001' , '暂无新资源，换一下试试！');
            }
            foreach ($data as $key=>$value){
                $data[$key]['classify_id'] = $dylist['CfilmClassify'];
                $data[$key]['movie_status'] = 1;
            }
            print_r($data);
//          入库
            $res = DB::table('movie')->insert($data);
            if($res){
                return SuccessOk('200','已更新资源','');
            }else{
                return Error('00001' , '添加失败');
            }
        }
    }

    #采集电影--详情数据
    public function dyDetails()
    {
        $dy = $this->dyList('2' , 'createtime');
        print_r($dy);exit;
        $rules = [
            'title' => ['h1', 'text', ''],
            'url' => ['.top-list-btns .btn-play', 'href', ''],
            'img' => ['.s-cover-img img', 'src', ''],
        ];
        foreach($dy as $k=>$v){
            $url= $this->domin . $v['url'];
            $jian2[] = $this->ql->get($url )->rules($rules)->queryData();
        }

        foreach($jian2 as $kk=>$vv){
            foreach($vv as $kkk=>$vvv){
                $dy[$kk]['title'] = $vvv['title'];
                $dy[$kk]['url'] = $vvv['url'];
                $dy[$kk]['img'] = $vvv['img'];
                $dy[$kk]['status'] = 1;
                $dy[$kk]['time'] = time();

            }

        }
//        $res =  DB::table('film')->insert($dy);
//        print_r($res);exit;
    }




    #采集综艺列表数据
    public function zyList()
    {
        $urlZy = $this->domin.'/zongyi/list';
        $rules = [
            'title' => ['.s-tab-main .title .s1', 'text', ''],
            'url' => ['.s-tab-main a.js-tongjic', 'href', ''],
            'img' => ['.s-tab-main  img', 'src', ''],
            'series' => ['.s-tab-main .hint', 'text', ''],
            'star' => ['.s-tab-main .star', 'text', '']
        ];
        $data = $this->ql->get( $urlZy , '',$this->opts)->rules($rules)->queryData();
        if(empty($data)){
            file_put_contents('./error.txt',date('Y-m-d H:i:s',time())."----------综艺--采集不到及时请更换！！！！\r\n",FILE_APPEND);
            return [];
        }else{
            return $data;
        }
    }

    #采集动漫列表数据
    public function dmList()
    {
        $urlDm = $this->domin.'/dongman/list';
        $rules = [
            'title' => ['.s-tab-main .title .s1', 'text', ''],
            'url' => ['.s-tab-main a.js-tongjic', 'href', ''],
            'img' => ['.s-tab-main  img', 'src', ''],
            'series' => ['.list.g-clear .hint', 'text', ''],
        ];
        $data = $this->ql->get( $urlDm , '',$this->opts)->rules($rules)->queryData();
        if(empty($data)){
            file_put_contents('./error.txt',date('Y-m-d H:i:s',time())."----------动漫--采集不到请及时更换！！！！\r\n",FILE_APPEND);
            return [];
        }else{
            return $data;
        }
    }

    ##### 搜索
    #搜索尝鲜详情地址 url  $key,$dizhi
    public function getCx($url , $key){
//        $dizhi  = 'www.156zy.cc';//死的
//        $key = '无敌破坏王';//死的
        $url = 'http://'.$url.'/index.php?m=vod-search';
        $arr = ['wd'=>$key,'submit'=>'search'];
        $html = curl_post($url,$arr);
        $rules = [
            'url'=>['.xing_vb4:eq(0) a','href','']
        ];
        $data = $this->ql->html($html)->rules($rules)->queryData();
        $data[0]['url']    = 'http://'.$url.$data[0]['url'];
        $res = $data[0]['url'] ;
        return $res;
    }
    //获取尝鲜影片的地址图片详情
    public function getCxData($url){
        $rules = [
            'dyname'=>['.vodh h2','text'],
            'dydesc'=>['.vodplayinfo:eq(1)','text',''],
            'dylogo'=>['.lazy','src'],
            'dyaddr'=>['ul:eq(6) li','text']
        ];
        $datass = $this->ql->get($url)->rules($rules)->queryData();
        return $datass;
    }




}
