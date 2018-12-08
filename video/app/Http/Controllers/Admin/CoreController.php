<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

    #采集电视剧列表数据
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

    #采集电影列表数据
    public function dyList()
    {
        $urlDy = $this->domin.'/dianying/list';
        $rules = [
            'title' => ['.s-tab-main .s1', 'text', ''],
            'url' => ['.s-tab-main a.js-tongjic', 'href', ''],
            'img' => ['.s-tab-main .cover.g-playicon img', 'src', ''],
            'year' => ['.s-tab-main .hint', 'text'],
            'star' => ['.s-tab-main .star', 'text', '']
        ];
        $data = $this->ql->get($urlDy , '',$this->opts)->rules($rules)->queryData();
        if(empty($data)){
            file_put_contents('./error.txt',date('Y-m-d H:i:s',time())."----------电影--采集不到请及时更换！！！！\r\n",FILE_APPEND);
            return [];
        }else{
            return $data;
        }
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
