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

    public function indexDsCollect(){
        $rules = [
            'title' => ['#js-dianshi .w-newfigure-detail .s1', 'text'],
//            'url' => ['ul:eq(10) a.js-link', 'href', ''],
//            'img' => ['ul:eq(10) .js-playicon img', 'data-src', ''],
//            'pf' => ['ul:eq(10) .s2', 'text', ''],
//            'js' => ['ul:eq(10) .w-newfigure-hint', 'text'],
        ];
        $data = $this->ql->get($this->domin , '',$this->opts)->rules($rules)->queryData();
        print_r($data);exit;
        return $data;
    }









}
