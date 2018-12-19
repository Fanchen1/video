<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use QL\QueryList;
class IndexController extends Controller
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


    //首页
    public function Index(){
    //     查出电影 推荐
        $dyTop  =  DB::table('movie')
            ->where(['movie_status'=>2])
            -> limit(6)
            ->get();
        $dyTop = json_decode(json_encode($dyTop) , true);
//        print_r($dyTop);exit;
        foreach ($dyTop as $k=>$v){
            $dyTop[$k]['movie_details_url']  = $this->domin . $v['movie_details_url'];
        }
    //查出电影 全部 前 12条
        $dyQuan  =  DB::table('movie')
            ->where(['movie_status'=>1])
            ->where(['movie_year'=>config('Year')])
            ->select('movie_id','movie_name','movie_img','movie_year','movie_details_url')
            -> limit(12)
            ->get();
        $dyQuan = json_decode(json_encode($dyQuan) , true);

        foreach ($dyQuan as $k=>$v){
            $dyQuan[$k]['movie_details_url']  = $this->domin . $v['movie_details_url'];
            if(strlen($v['movie_name']) > 25){
                $dyQuan[$k]['movie_name']  = str_replace( substr($v['movie_name'] , -6),'...',$v['movie_name'] );
            }
        }
//        print_r($dyQuan);exit;
    //查出电影 喜剧  前 12条
        $dyXi  =  DB::table('movie')
            ->where('movie_status','!=',0)
            ->where(['classify_id'=>2 ])
            ->where(['movie_year'=>config('Year')])
            ->select('movie_id','movie_name','movie_img','movie_year','movie_details_url')
            -> limit(12)
            ->get();
        $dyXi = json_decode(json_encode($dyXi) , true);
        foreach ($dyXi as $k=>$v){
            $dyXi[$k]['movie_details_url']  = $this->domin . $v['movie_details_url'];
            if(strlen($v['movie_name']) > 25){
                $dyXi[$k]['movie_name']  = str_replace( substr($v['movie_name'] , -6),'...',$v['movie_name'] );
            }
        }
    //查出电影 动作  前 12条
        $dyDong  =  DB::table('movie')
            ->where('movie_status','!=',0)
            ->where(['classify_id'=>4])
            ->where(['movie_year'=>config('Year')])
            ->select('movie_id','movie_name','movie_img','movie_year','movie_details_url')
            -> limit(12)
            ->get();
        $dyDong = json_decode(json_encode($dyDong) , true);
        foreach ($dyDong as $k=>$v){
            $dyDong[$k]['movie_details_url']  = $this->domin . $v['movie_details_url'];
            if(strlen($v['movie_name']) > 25){
                $dyDong[$k]['movie_name']  = str_replace( substr($v['movie_name'] , -6),'...',$v['movie_name'] );
            }
        }

        //查出电视剧 全部 前 12条
        $dsjQuan  =  DB::table('teleplay')
            ->where(['teleplay_status'=>1])
            ->select('teleplay_id','teleplay_name','teleplay_img','teleplay_year','teleplay_details_url')
            -> limit(12)
            ->get();
        $dsjQuan = json_decode(json_encode($dsjQuan) , true);

        foreach ($dsjQuan as $k=>$v){
            $dyQuan[$k]['teleplay_details_url']  = $this->domin . $v['teleplay_details_url'];
            if(strlen($v['teleplay_name']) > 25){
                $dyQuan[$k]['teleplay_name']  = str_replace( substr($v['teleplay_name'] , -6),'...',$v['teleplay_name'] );
            }
        }

        //查出动漫 全部 前 12条
        $dmQuan  =  DB::table('comic')
            ->where(['comic_status'=>1])
            ->select('comic_id','comic_name','comic_img','comic_year','comic_details_url')
            -> limit(12)
            ->get();
        $dmQuan = json_decode(json_encode($dmQuan) , true);

        foreach ($dmQuan as $k=>$v){
            $dmQuan[$k]['comic_details_url']  = $this->domin . $v['comic_details_url'];
            if(strlen($v['comic_name']) > 25){
                $dmQuan[$k]['comic_name']  = str_replace( substr($v['comic_name'] , -6),'...',$v['comic_name'] );
            }
        }

//        print_r($dmQuan);exit;
        return view('Home/Index.Index',
                    [
                        'dyTop'=>$dyTop ,//电影推荐
                        'dyQuan'=>$dyQuan,//电影全部
                        'dyXi'=>$dyXi,//电影喜剧
                        'dyDong'=>$dyDong,//电影动作
                        'dsjQuan'=>$dsjQuan,//电视剧
                        'dmQuan'=>$dmQuan,//动漫
                    ]);
    }

    //播放详情
    public function playDetails(Request $request){
        $movie = $request ->input('movie');//电影
        $teleplay = $request ->input('teleplay');//电视剧
        $comic = $request ->input('comic');//动漫
        if(!empty($movie)){ //电影
            //查电影表
            $movie_Details = (array)DB::table('movie')
                ->where(['movie_id'=>$movie])
                ->where('movie_status','!=' , 0)
                ->first();
            if(empty($movie_Details)){
                echo "<script>alert('此视频暂时无法播放！')</script>";
                return '此视频暂时无法播放！请返回';
            }
//            print_r($movie_Details);exit;
            if( empty($movie_Details['movie_yuan_url']) || empty($movie_Details['movie_brief'])){
                $movie_url = $this->domin . $movie_Details['movie_details_url'];
                $rules = [
                    'movie_brief' => ['.top-info-detail .item-desc', 'text', ''],
                    'movie_yuan_url' => ['.top-list-btns .btn-play', 'href', ''],
                ];
                // createtime 最近上映    rankhot  最近热映    rankpoint 最近好评
                $data = $this->ql->get($movie_url , '',$this->opts)->rules($rules)->queryData();
                if(empty($data)){
                    echo "<script>alert('此视频暂时无法播放！')</script>";
                    file_put_contents('./error.txt',date('Y-m-d H:i:s',time()).$movie_Details['movie_name']."----------系统错误！此电影没有获取到原地址和简介\r\n" ,FILE_APPEND);
                    return '此视频暂时无法播放！请返回';
                }
                //转一维
                foreach($data as $k=>$v){
                    $updatas['movie_brief'] = $v['movie_brief'];
                }
                $updatas['movie_yuan_url']  = $data[0]['movie_yuan_url'];
                //入库
                    $res = DB::table('movie')->where(['movie_id'=>$movie])->update($updatas);
                    if($res){
                        $movie_list = (array)DB::table('movie')
                            ->where(['movie_id'=>$movie])
                            ->where('movie_status','!=' , 0)
                            ->first();
                        return view('Home/Details.Details',['status'=>1,'data'=>$movie_list]);//传电影
                    }else{
                        echo "<script>alert('此视频暂时无法播放！')</script>";
                        file_put_contents('./error.txt',date('Y-m-d H:i:s',time()).$movie_Details['movie_name']."----------系统错误！此电影原地址和简介入库失败\r\n" ,FILE_APPEND);
                        return '此视频暂时无法播放！请返回';
                    }
            }
            return view('Home/Details.Details',['status'=>1,'data'=>$movie_Details]);//传电影
        }else if(!empty($teleplay)){//电视剧
            //查电视剧
            $teleplay_Details = (array)DB::table('teleplay')
                ->where(['teleplay_id'=>$teleplay])
                ->where('teleplay_status','!=' , 0)
                ->first();
            if(empty($teleplay_Details)){
                echo "<script>alert('此视频暂时无法播放！')</script>";
                return '此视频暂时无法播放！请返回';
            }
            //判断有没有第一集
            if(empty($teleplay_Details['teleplay_yuan_url'])){
                // 采集
                $rules = [
                    'teleplay_yuan_url' => ['.s-top-list-ji .num-tab-main a:hover', 'href', ''],
                    'teleplay_brief' => ['.s-top-info-detail .item-desc', 'text', ''],
                ];
                $data = $this->ql->get($this->domin.$teleplay_Details['teleplay_details_url'] )->rules($rules)->queryData();
                $res=DB::table('teleplay')
                    ->where(['teleplay_id'=>$teleplay])
                    ->update(['teleplay_yuan_url'=>$data[0]['teleplay_yuan_url'],'teleplay_brief'=>$data[1]['teleplay_brief']]);
                if($res){
                    echo "请刷新页面";
                    return "<script>alert('请刷新页面')</script>";
                }else{
                    echo "<script>alert('此视频暂时无法播放！')</script>";
                    file_put_contents('./error.txt',date('Y-m-d H:i:s',time()).$teleplay_Details['teleplay_name']."----------系统错误！此电视剧原地址和简介入库失败\r\n" ,FILE_APPEND);
                    return '此视频暂时无法播放！请返回';
                }
            }else {
                $rule=[
                    'serie_href'=>['.s-top-list-ji .num-tab-main a','href',''],
                    'serie_level'=>['.s-top-list-ji .num-tab-main a','text',''],
                ];
                $res = $this->ql->get($this->domin.$teleplay_Details['teleplay_details_url']  )->rules($rule)->queryData();
                //转一维
                $href= (array_values(array_unique($this->array_column($res,'serie_href'))));
                $level= array_values(array_unique($this->array_column($res,'serie_level')));
                //取出 杂乱信息
                $del=array_search('......',$level);
                $del2=array_search('展开更多',$level);
                $del3=array_search('收起',$level);
                $del4=array_search('#',$href);
                //判断有没有 杂乱信息
                if(!empty($del) || !empty($del2) || !empty($del3)  || !empty($del4) ){
                    unset($level[$del]);
                    unset($level[$del2]);
                    unset($level[$del3]);
                    unset($href[$del4]);
                    $level=array_values($level);
                    $href=array_values($href);
                    foreach($level as $k=>$v){
                        $data3[]['serie_level']=(int)rtrim($v);
                    }
                    foreach($href as $k=>$v){
                        $data3[$k]['serie_href']=$v;
                    }
                }else{//没有 杂乱信息
                    foreach($res as $k=>$v){
                        $data3[$k]['serie_level']=(int)rtrim($v['serie_level']);
                        $data3[$k]['serie_href']=$v['serie_href'];
                    }
                }
                foreach($data3 as $k=>$v){
                    $data3[$k]['teleplay_id']=$teleplay_Details['teleplay_id'];
                    $data3[$k]['serie_status']='1';
                    $data3[$k]['serie_ctime']=time();
                }
                $serie_level = array_column($data3, 'serie_level');//取出要排序的值
                array_multisort($serie_level,SORT_ASC,$data3);//根据排序的值 进行排序
                $ku=json_decode(DB::table('serie')->where(['teleplay_id'=>$teleplay,'serie_status'=>1])->get(),true);
                foreach($ku as $k=>$v) {
                    foreach ($data3 as $kk => $vv) {
                        if (in_array($vv['serie_href'], $v)) {
                            unset($data3[$k]);
                        }
                    }
                }
                $result=DB::table("serie")->insert($data3);
                if($result){
                    //查电视剧
                    $teleplay_Details = (array)DB::table('teleplay')
                        ->where(['teleplay_id'=>$teleplay])
                        ->where('teleplay_status','!=' , 0)
                        ->first();
                    $teleplay_ji= DB::table('serie')
                        ->where(['teleplay_id'=>$teleplay])
                        ->where('serie_status','!=' , 0)
                        ->orderBy('serie_level', 'ASC')
                        ->get();
                    $teleplay_ji = json_decode(json_encode($teleplay_ji) ,true);
                    $serie_level = array_column($teleplay_ji, 'serie_level');//取出要排序的值
                    array_multisort($serie_level,SORT_ASC,$teleplay_ji);//根据排序的值 进行排序
                    return view('Home/Details.Details',['status'=>2,'data'=>$teleplay_Details , 'ji'=>$teleplay_ji]);//传电视剧
                }else{
                    echo "<script>alert('此视频暂时无法播放！')</script>";
                    file_put_contents('./error.txt',date('Y-m-d H:i:s',time()).$teleplay_Details['teleplay_name']."----------系统错误！此电视剧原地址和简介入库失败\r\n" ,FILE_APPEND);
                    return '此视频暂时无法播放！请返回';
                }
            }



        }else if(!empty($comic)) {//动漫
            //查动漫
            $comic_Details = (array)DB::table('comic')
                ->where(['comic_id'=>$comic])
                ->where('comic_status','!=' , 0)
                ->first();

            if(empty($comic_Details)){
                echo "<script>alert('此视频暂时无法播放！')</script>";
                return '此视频暂时无法播放！请返回';
            }
//            print_r($comic_Details);exit;
            //判断有没有第一集
            if(empty($comic_Details['comic_yuan_url'])){
                // 采集
                $rules = [
                    'comic_yuan_url' => ['.m-series-number-container a:hover', 'href', ''],
                    'comic_brief' => ['.m-top-info-detail .item-desc', 'text', ''],
                ];
                $data = $this->ql->get($this->domin.$comic_Details['comic_details_url'] )->rules($rules)->queryData();
                $res=DB::table('comic')
                    ->where(['comic_id'=>$comic])
                    ->update(['comic_yuan_url'=>$data[0]['comic_yuan_url'],'comic_brief'=>$data[1]['comic_brief']]);
                if($res){
                    echo "请刷新页面";
                    return "<script>alert('请刷新页面')</script>";
                }else{
                    echo "<script>alert('此视频暂时无法播放！')</script>";
                    file_put_contents('./error.txt',date('Y-m-d H:i:s',time()).$comic_Details['comic_name']."----------系统错误！此动漫原地址和简介入库失败\r\n" ,FILE_APPEND);
                    return '此视频暂时无法播放！请返回';
                }
            }else {
                $rule=[
                    'comic_serie_href'=>['.m-series-number-container a','href',''],
                    'comic_serie_level'=>['.m-series-number-container a','text',''],
                ];
                $res = $this->ql->get($this->domin.$comic_Details['comic_details_url']  )->rules($rule)->queryData();
                //转一维
                $href= (array_values(array_unique($this->array_column($res,'comic_serie_href'))));
                $level= array_values(array_unique($this->array_column($res,'comic_serie_level')));
                //取出 杂乱信息
                $del=array_search('...',$level);
                $del2=array_search('展开',$level);
                $del3=array_search('收起',$level);
                $del4=array_search('###',$href);
                $del5=array_search('####',$href);
                //判断有没有 杂乱信息
                if(!empty($del) || !empty($del2) || !empty($del3)  || !empty($del4) ){
                    unset($level[$del]);
                    unset($level[$del2]);
                    unset($level[$del3]);
                    unset($href[$del4]);
                    unset($href[$del5]);
                    $level=array_values($level);
                    $href=array_values($href);
                    foreach($level as $k=>$v){
                        $data3[]['comic_serie_level']=(int)rtrim($v);
                    }
                    foreach($href as $k=>$v){
                        $data3[$k]['comic_serie_href']=$v;
                    }
                }else{//没有 杂乱信息
                    foreach($res as $k=>$v){
                        $data3[$k]['comic_serie_level']=(int)rtrim($v['comic_serie_level']);
                        $data3[$k]['comic_serie_href']=$v['comic_serie_href'];
                    }
                }
                foreach($data3 as $k=>$v){
                    $data3[$k]['comic_id']=$comic_Details['comic_id'];
                    $data3[$k]['comic_serie_status']='1';
                    $data3[$k]['comic_serie_ctime']=time();
                }
                $serie_level = array_column($data3, 'comic_serie_level');//取出要排序的值
                array_multisort($serie_level,SORT_ASC,$data3);//根据排序的值 进行排序
                $ku=json_decode(DB::table('comic_serie')->where(['comic_id'=>$comic,'comic_serie_status'=>1])->get(),true);
//                print_r($ku);exit;
                foreach($ku as $k=>$v) {
                    foreach ($data3 as $kk => $vv) {
                        if (in_array($vv['comic_serie_href'], $v)) {
                            unset($data3[$k]);
                        }
                    }
                }
                $result=DB::table("comic_serie")->insert($data3);
                if($result){
                    //查电视剧
                    $comic_Details = (array)DB::table('comic')
                        ->where(['comic_id'=>$comic])
                        ->where('comic_status','!=' , 0)
                        ->first();
                    $comic_ji= DB::table('comic_serie')
                        ->where(['comic_id'=>$comic])
                        ->where('comic_serie_status','!=' , 0)
                        ->orderBy('comic_serie_level', 'ASC')
                        ->get();

                    $comic_ji = json_decode(json_encode($comic_ji) ,true);
                    $serie_level = array_column($comic_ji, 'comic_serie_level');//取出要排序的值
                    array_multisort($serie_level,SORT_ASC,$comic_ji);//根据排序的值 进行排序
                    return view('Home/Details.Details',['status'=>3,'data'=>$comic_Details , 'ji'=>$comic_ji]);//传动漫
                }else{
                    echo "<script>alert('此视频暂时无法播放！')</script>";
                    file_put_contents('./error.txt',date('Y-m-d H:i:s',time()).$comic_Details['comic_name']."----------系统错误！此动漫原地址和简介入库失败\r\n" ,FILE_APPEND);
                    return '此视频暂时无法播放！请返回';
                }
            }

        }

        //else if(){

      // }
    }

    //视频播放
    public function Play(Request $request){
        $bo = $request ->input('bo');
        $bo_id = $request ->input('bo_id');
        if( $bo  == 'movie'){//电影
            $movie =  (array)DB::table('movie')
                        ->where(['movie_id'=>$bo_id])
                        ->where('movie_status','!=' , 0)
                        ->first();
            $Fang = config('play') ;
            foreach ($Fang as $k=>$v){
                $Fang[$k] = $v.$movie['movie_yuan_url'];
            }
            $xianLu = $Fang['线路一'];
//            print_r($xianLu);exit;
           return view('Home/Play.Play',['status'=>1,'data'=>$movie, 'bo'=> $xianLu, 'xian'=>$Fang]);
        }else if ( $bo  == 'teleplay'){//电视剧
            $level = $request ->input('level');
            if(empty($level)){
                echo "<script>alert('此视频暂时无法播放！')</script>";
                return '此视频暂时无法播放！请返回';
            }
            //子表
            $serie = (array)DB::table('serie')
                ->where('serie_level','=',$level)
                ->where('teleplay_id','=',$bo_id)
                ->where('serie_status' ,'!=' , 0)
                ->first();
            //父表
            $teleplay = (array)DB::table('teleplay')
                ->where('teleplay_id','=',$bo_id)
                ->where('teleplay_status' ,'!=' , 0)
                ->first();
            //集数
            $teleplay_ji= DB::table('serie')
                ->where(['teleplay_id'=>$bo_id])
                ->where('serie_status','!=' , 0)
                ->orderBy('serie_level', 'ASC')
                ->get();
            $teleplay_ji = json_decode(json_encode($teleplay_ji) ,true);
            $serie_level = array_column($teleplay_ji, 'serie_level');//取出要排序的值
            array_multisort($serie_level,SORT_ASC,$teleplay_ji);//根据排序的值 进行排序
            if(empty($teleplay_ji) || empty($teleplay)){
                echo "<script>alert('此视频暂时无法播放！')</script>";
                return '此视频暂时无法播放！请返回';
            }
//            print_r($teleplay_ji);exit;
            $Fang = config('play') ;
            foreach ($Fang as $k=>$v){
                $Fang[$k] = $v.$serie['serie_href'];
            }
            $xianLu = $Fang['线路一'];
            return view('Home/Play.Play',['status'=>2,'data'=>$teleplay,'ji'=>$teleplay_ji,'bo'=> $xianLu, 'xian'=>$Fang]);
        }else if ( $bo  == 'comic') {//动漫
            $level = $request ->input('level');
            if(empty($level)){
                echo "<script>alert('此视频暂时无法播放！')</script>";
                return '此视频暂时无法播放！请返回';
            }
            //子表
            $comic_serie = (array)DB::table('comic_serie')
                ->where('comic_serie_level','=',$level)
                ->where('comic_id','=',$bo_id)
                ->where('comic_serie_status' ,'!=' , 0)
                ->first();
            //父表
            $comic = (array)DB::table('comic')
                ->where('comic_id','=',$bo_id)
                ->where('comic_status' ,'!=' , 0)
                ->first();
            //集数
            $comic_ji= DB::table('comic_serie')
                ->where(['comic_id'=>$bo_id])
                ->where('comic_serie_status','!=' , 0)
                ->orderBy('comic_serie_level', 'ASC')
                ->get();
            $comic_ji = json_decode(json_encode($comic_ji) ,true);
            $serie_level = array_column($comic_ji, 'comic_serie_level');//取出要排序的值
            array_multisort($serie_level,SORT_ASC,$comic_ji);//根据排序的值 进行排序
            if(empty($comic_ji) || empty($comic)){
                echo "<script>alert('此视频暂时无法播放！')</script>";
                return '此视频暂时无法播放！请返回';
            }
            $Fang = config('play') ;
            foreach ($Fang as $k=>$v){
                $Fang[$k] = $v.$comic_serie['comic_serie_href'];
            }
            $xianLu = $Fang['线路一'];
            return view('Home/Play.Play',['status'=>3,'data'=>$comic,'ji'=>$comic_ji,'bo'=> $xianLu, 'xian'=>$Fang]);
        }


//





    }

    //更多列表  电影
    public function moreMovie(Request $request){
       $movie = DB::table('movie')
                    ->where('movie_status', '!=',0)
                    ->select('movie_id','movie_name','movie_img','movie_year')
                    ->paginate(18);
//          print_r($movie);exit;
          foreach ($movie as $k=>$v){
              if(strlen($v->movie_name) > 25){
                      $v->movie_name  = str_replace( substr($v->movie_name , -6),'...',$v->movie_name );
              }
          }

          //print_r($movie);exit;
       return view('Home/More.MoreMovie' , ['status'=>1 ,'data'=>$movie]);
    }

    //更多列表  电视剧
    public function moreTeleplay(Request $request){
        $teleplay = DB::table('teleplay')
            ->where('teleplay_status', '!=',0)
            ->select('teleplay_id','teleplay_name','teleplay_img','teleplay_year')
            ->paginate(18);
//          print_r($movie);exit;
        foreach ($teleplay as $k=>$v){
            if(strlen($v->teleplay_name) > 25){
                $v->teleplay_name  = str_replace( substr($v->teleplay_name , -6),'...',$v->teleplay_name );
            }
        }

        //print_r($movie);exit;
        return view('Home/More.MoreMovie' , ['status'=>2 ,'data'=>$teleplay]);
    }

    //更多列表 动漫
    public function moreComic(Request $request){
        $comic = DB::table('comic')
            ->where('comic_status', '!=',0)
            ->select('comic_id','comic_name','comic_img','comic_year')
            ->paginate(18);
//          print_r($movie);exit;
        foreach ($comic as $k=>$v){
            if(strlen($v->comic_name) > 25){
                $v->comic_name  = str_replace( substr($v->comic_name , -6),'...',$v->comic_name );
            }
        }

        //print_r($movie);exit;
        return view('Home/More.MoreMovie' , ['status'=>3 ,'data'=>$comic]);
    }


    /**
     * 尝鲜
     * @param Request $request
     * @return false|string
     */
    public function fresh(Request $request){
        $chang = $request->input();
        if(empty($chang['search']) || empty($chang['isso'])){
            return Error('0001','缺少参数！');
        }
        $url = '156zy.cc/';//地址1
        $url2 = 'www.zuidazy.net';//地址2
        if($chang['isso'] == 1){//电影
            $movie  = (array)DB::table('movie')
                ->where('movie_name', 'like','%'.$chang['search'].'%')
                ->first();
           if(empty($movie)){//表里面没有
               $data =  $this->cxdy($url , $chang['search']);
               if($data == 'error'){
                   file_put_contents('./error.txt',date('Y-m-d H:i:s',time())."----------尝鲜电影添加有误--请检查！！！！\r\n",FILE_APPEND);
                   return Error('0001' , '系统错误！');
               }elseif (empty($data)){
                   return Error('0001' , '没有查到数据！');
               }else{
                  return SuccessOk('200' , '搜索成功' ,'soList?server=movie&id='.$data);
               }
            //展示
           }else{//表有
               return SuccessOk('200' , '搜索成功' ,'soList?server=movie&id='.$movie['movie_id']);
               //展示
           }
        }elseif ($chang['isso'] == 2){//电视剧
            $teleplay  = (array)DB::table('teleplay')
                ->where('teleplay_name', 'like','%'.$chang['search'].'%')
                ->first();
            if(empty($teleplay)){//表里面没有
                $data =  $this->cxdsj($url , $chang['search']);
                if($data == 'error'){
                    file_put_contents('./error.txt',date('Y-m-d H:i:s',time())."----------尝鲜电视剧添加有误--请检查！！！！\r\n",FILE_APPEND);
                    return Error('0001' , '系统错误！');
                }elseif (empty($data)){
                    return Error('0001' , '没有查到数据！');
                }else{
                    return SuccessOk('200' , '搜索成功' ,'soList?server=teleplay&id='.$data);
                }
                //展示
            }else{//表有
                return SuccessOk('200' , '搜索成功' ,'soList?server=teleplay&id='.$teleplay['teleplay_id']);
                //展示
            }
        }elseif ($chang['isso'] == 3) {//动漫
            $comic  = (array)DB::table('comic')
                ->where('comic_name', 'like','%'.$chang['search'].'%')
                ->first();
            if(empty($comic)){//表里面没有
                $data =  $this->cxdm($url , $chang['search']);
                if($data == 'error'){
                    file_put_contents('./error.txt',date('Y-m-d H:i:s',time())."----------尝鲜动漫添加有误--请检查！！！！\r\n",FILE_APPEND);
                    return Error('0001' , '系统错误！');
                }elseif (empty($data)){
                    return Error('0001' , '没有查到数据！');
                }else{
                    return SuccessOk('200' , '搜索成功' ,'soList?server=comic&id='.$data);
                }
                //展示
            }else{//表有
//                print_r($comic);exit;
                return SuccessOk('200' , '搜索成功' ,'soList?server=comic&id='.$comic['comic_id']);
                //展示
            }
        }elseif ($chang['isso'] == 4) {//综艺

        }



    }

    /**
     * 搜索展示
     * @param Request $request
     */
    public  function soList(Request $request){
       $server =  $request->input('server');
       $id =  $request->input('id');
       if($server == 'movie'){//电影
         $movie = (array) DB::table('movie')->where(['movie_id'=>$id])->first();
         if(empty($movie)){
            echo '没有搜到！请返回';
         }else{
             if( empty($movie['movie_yuan_url']) || empty($movie['movie_brief'])){
                 $movie_url = $this->domin . $movie['movie_details_url'];
                 $rules = [
                     'movie_brief' => ['.top-info-detail .item-desc', 'text', ''],
                     'movie_yuan_url' => ['.top-list-btns .btn-play', 'href', ''],
                 ];
                 // createtime 最近上映    rankhot  最近热映    rankpoint 最近好评
                 $data = $this->ql->get($movie_url , '',$this->opts)->rules($rules)->queryData();
                 if(empty($data)){
                     echo "<script>alert('此视频暂时无法播放！')</script>";
                     file_put_contents('./error.txt',date('Y-m-d H:i:s',time()).$movie['movie_name']."----------系统错误！此电影没有获取到原地址和简介\r\n" ,FILE_APPEND);
                     return '此视频暂时无法播放！请返回';
                 }
                 //转一维
                 foreach($data as $k=>$v){
                     $updatas['movie_brief'] = $v['movie_brief'];
                 }
                 $updatas['movie_yuan_url']  = $data[0]['movie_yuan_url'];
                 //入库
                 $res = DB::table('movie')->where(['movie_id'=>$movie])->update($updatas);
                 if($res){
                     $movie_list = (array)DB::table('movie')
                         ->where(['movie_id'=>$movie])
                         ->where('movie_status','!=' , 0)
                         ->first();
                     return view('Home/Details.Details',['status'=>1,'data'=>$movie_list]);//传电影
                 }else{
                     echo "<script>alert('此视频暂时无法播放！')</script>";
                     file_put_contents('./error.txt',date('Y-m-d H:i:s',time()).$movie['movie_name']."----------系统错误！此电影原地址和简介入库失败\r\n" ,FILE_APPEND);
                     return '此视频暂时无法播放！请返回';
                 }
             }
             return view('Home/Details.Details',['status'=>1,'data'=>$movie]);//传电影
         }

       }else if($server == 'teleplay'){//电视剧
           $teleplay = (array) DB::table('teleplay')->where(['teleplay_id'=>$id])->first();
           if(empty($teleplay)){
               echo '没有搜到！请返回';
           }else{
               $teleplay_ji= DB::table('serie')
                   ->where(['teleplay_id'=>$teleplay['teleplay_id']])
                   ->where('serie_status','!=' , 0)
                   ->orderBy('serie_level', 'ASC')
                   ->get();
               $teleplay_ji =  json_decode(json_encode($teleplay_ji) , true);
               if(empty($teleplay_ji)){
                           //判断有没有第一集
                           if(empty($teleplay['teleplay_yuan_url'])){
                               // 采集
                               $rules = [
                                   'teleplay_yuan_url' => ['.s-top-list-ji .num-tab-main a:hover', 'href', ''],
                                   'teleplay_brief' => ['.s-top-info-detail .item-desc', 'text', ''],
                               ];
                               $data = $this->ql->get($this->domin.$teleplay['teleplay_details_url'] )->rules($rules)->queryData();
                               $res=DB::table('teleplay')
                                   ->where(['teleplay_id'=>$teleplay])
                                   ->update(['teleplay_yuan_url'=>$data[0]['teleplay_yuan_url'],'teleplay_brief'=>$data[1]['teleplay_brief']]);
                               if($res){
                                   echo "请刷新页面";
                                   return "<script>alert('请刷新页面')</script>";
                               }else{
                                   echo "<script>alert('此视频暂时无法播放！')</script>";
                                   file_put_contents('./error.txt',date('Y-m-d H:i:s',time()).$teleplay['teleplay_name']."----------系统错误！此电视剧原地址和简介入库失败\r\n" ,FILE_APPEND);
                                   return '此视频暂时无法播放！请返回';
                               }
                           }else {
                               $rule=[
                                   'serie_href'=>['.s-top-list-ji .num-tab-main a','href',''],
                                   'serie_level'=>['.s-top-list-ji .num-tab-main a','text',''],
                               ];
                               $res = $this->ql->get($this->domin.$teleplay['teleplay_details_url']  )->rules($rule)->queryData();
                               //转一维
                               $href= (array_values(array_unique($this->array_column($res,'serie_href'))));
                               $level= array_values(array_unique($this->array_column($res,'serie_level')));
                               //取出 杂乱信息
                               $del=array_search('......',$level);
                               $del2=array_search('展开更多',$level);
                               $del3=array_search('收起',$level);
                               $del4=array_search('#',$href);
                               //判断有没有 杂乱信息
                               if(!empty($del) || !empty($del2) || !empty($del3)  || !empty($del4) ){
                                   unset($level[$del]);
                                   unset($level[$del2]);
                                   unset($level[$del3]);
                                   unset($href[$del4]);
                                   $level=array_values($level);
                                   $href=array_values($href);
                                   foreach($level as $k=>$v){
                                       $data3[]['serie_level']=(int)rtrim($v);
                                   }
                                   foreach($href as $k=>$v){
                                       $data3[$k]['serie_href']=$v;
                                   }
                               }else{//没有 杂乱信息
                                   foreach($res as $k=>$v){
                                       $data3[$k]['serie_level']=(int)rtrim($v['serie_level']);
                                       $data3[$k]['serie_href']=$v['serie_href'];
                                   }
                               }
                               foreach($data3 as $k=>$v){
                                   $data3[$k]['teleplay_id']=$teleplay['teleplay_id'];
                                   $data3[$k]['serie_status']='1';
                                   $data3[$k]['serie_ctime']=time();
                               }
                               $serie_level = array_column($data3, 'serie_level');//取出要排序的值
                               array_multisort($serie_level,SORT_ASC,$data3);//根据排序的值 进行排序
                               $ku=json_decode(DB::table('serie')->where(['teleplay_id'=>$teleplay,'serie_status'=>1])->get(),true);
                               foreach($ku as $k=>$v) {
                                   foreach ($data3 as $kk => $vv) {
                                       if (in_array($vv['serie_href'], $v)) {
                                           unset($data3[$k]);
                                       }
                                   }
                               }
                               $result=DB::table("serie")->insert($data3);
                               if($result){
                                   //查电视剧
                                   $teleplay = (array)DB::table('teleplay')
                                       ->where(['teleplay_id'=>$teleplay])
                                       ->where('teleplay_status','!=' , 0)
                                       ->first();
                                   $teleplay_ji= DB::table('serie')
                                       ->where(['teleplay_id'=>$teleplay])
                                       ->where('serie_status','!=' , 0)
                                       ->orderBy('serie_level', 'ASC')
                                       ->get();
                                   $teleplay_ji = json_decode(json_encode($teleplay_ji) ,true);
                               }else{
                                   echo "<script>alert('此视频暂时无法播放！')</script>";
                                   file_put_contents('./error.txt',date('Y-m-d H:i:s',time()).$teleplay['teleplay_name']."----------系统错误！此电视剧原地址和简介入库失败\r\n" ,FILE_APPEND);
                                   return '此视频暂时无法播放！请返回';
                               }
                           }
                       }
               $serie_level = array_column($teleplay_ji, 'serie_level');//取出要排序的值
               $dada[] = array_multisort($serie_level,SORT_ASC,$teleplay_ji);//根据排序的值 进行排序
               return view('Home/Details.Details',['status'=>2,'data'=>$teleplay , 'ji'=>$teleplay_ji]);//传电视剧

           }
       }else if($server == 'comic') {//动漫
           $comic = (array) DB::table('comic')->where(['comic_id'=>$id])->first();
           if(empty($comic)){
               echo '没有搜到！请返回';
           }else {
               if(empty($comic)){
                   echo "<script>alert('此视频暂时无法播放！')</script>";
                   return '此视频暂时无法播放！请返回';
               }else{
                   $comic_ji= DB::table('comic_serie')
                       ->where(['comic_id'=>$comic['comic_id']])
                       ->where('comic_serie_status','!=' , 0)
                       ->orderBy('comic_serie_level', 'ASC')
                       ->get();
                   $comic_ji =  json_decode(json_encode($comic_ji) , true);
                   if(empty($comic_ji)) {
                       //判断有没有第一集
                       if (empty($comic['comic_yuan_url'])) {
                           // 采集
                           $rules = [
                               'comic_yuan_url' => ['.m-series-number-container a:hover', 'href', ''],
                               'comic_brief' => ['.m-top-info-detail .item-desc', 'text', ''],
                           ];
                           $data = $this->ql->get($this->domin . $comic['comic_details_url'])->rules($rules)->queryData();
                           $res = DB::table('comic')
                               ->where(['comic_id' => $comic])
                               ->update(['comic_yuan_url' => $data[0]['comic_yuan_url'], 'comic_brief' => $data[1]['comic_brief']]);
                           if ($res) {
                               echo "请刷新页面";
                               return "<script>alert('请刷新页面')</script>";
                           } else {
                               echo "<script>alert('此视频暂时无法播放！')</script>";
                               file_put_contents('./error.txt', date('Y-m-d H:i:s', time()) . $comic['comic_name'] . "----------系统错误！此动漫原地址和简介入库失败\r\n", FILE_APPEND);
                               return '此视频暂时无法播放！请返回';
                           }
                       } else {
                           $rule = [
                               'comic_serie_href' => ['.m-series-number-container a', 'href', ''],
                               'comic_serie_level' => ['.m-series-number-container a', 'text', ''],
                           ];
                           $res = $this->ql->get($this->domin . $comic['comic_details_url'])->rules($rule)->queryData();
                           //转一维
                           $href = (array_values(array_unique($this->array_column($res, 'comic_serie_href'))));
                           $level = array_values(array_unique($this->array_column($res, 'comic_serie_level')));
                           //取出 杂乱信息
                           $del = array_search('...', $level);
                           $del2 = array_search('展开', $level);
                           $del3 = array_search('收起', $level);
                           $del4 = array_search('###', $href);
                           $del5 = array_search('####', $href);
                           //判断有没有 杂乱信息
                           if (!empty($del) || !empty($del2) || !empty($del3) || !empty($del4)) {
                               unset($level[$del]);
                               unset($level[$del2]);
                               unset($level[$del3]);
                               unset($href[$del4]);
                               unset($href[$del5]);
                               $level = array_values($level);
                               $href = array_values($href);
                               foreach ($level as $k => $v) {
                                   $data3[]['comic_serie_level'] = (int)rtrim($v);
                               }
                               foreach ($href as $k => $v) {
                                   $data3[$k]['comic_serie_href'] = $v;
                               }
                           } else {//没有 杂乱信息
                               foreach ($res as $k => $v) {
                                   $data3[$k]['comic_serie_level'] = (int)rtrim($v['comic_serie_level']);
                                   $data3[$k]['comic_serie_href'] = $v['comic_serie_href'];
                               }
                           }
                           foreach ($data3 as $k => $v) {
                               $data3[$k]['comic_id'] = $comic['comic_id'];
                               $data3[$k]['comic_serie_status'] = '1';
                               $data3[$k]['comic_serie_ctime'] = time();
                           }
                           $serie_level = array_column($data3, 'comic_serie_level');//取出要排序的值
                           array_multisort($serie_level, SORT_ASC, $data3);//根据排序的值 进行排序
                           $ku = json_decode(DB::table('comic_serie')->where(['comic_id' => $comic, 'comic_serie_status' => 1])->get(), true);
                           //                print_r($ku);exit;
                           foreach ($ku as $k => $v) {
                               foreach ($data3 as $kk => $vv) {
                                   if (in_array($vv['comic_serie_href'], $v)) {
                                       unset($data3[$k]);
                                   }
                               }
                           }
                           $result = DB::table("comic_serie")->insert($data3);
                           if ($result) {
                               //查电视剧
                               $comic_Details = (array)DB::table('comic')
                                   ->where(['comic_id' => $comic])
                                   ->where('comic_status', '!=', 0)
                                   ->first();
                               $comic_ji = DB::table('comic_serie')
                                   ->where(['comic_id' => $comic])
                                   ->where('comic_serie_status', '!=', 0)
                                   ->orderBy('comic_serie_level', 'ASC')
                                   ->get();

                               $comic_ji = json_decode(json_encode($comic_ji), true);

                           } else {
                               echo "<script>alert('此视频暂时无法播放！')</script>";
                               file_put_contents('./error.txt', date('Y-m-d H:i:s', time()) . $comic['comic_name'] . "----------系统错误！此动漫原地址和简介入库失败\r\n", FILE_APPEND);
                               return '此视频暂时无法播放！请返回';
                           }
                       }
                   }
                   $serie_level = array_column($comic_ji, 'comic_serie_level');//取出要排序的值
                   array_multisort($serie_level, SORT_ASC, $comic_ji);//根据排序的值 进行排序
                   return view('Home/Details.Details', ['status' => 3, 'data' => $comic, 'ji' => $comic_ji]);//传动漫

               }
           }
       }
    }


    /**
     * 尝鲜电影
     * @param $url
     * @param $key
     * @return array|string
     */
    public function cxdy($url ,$key ){
        $so = json_decode(curlRequest(config('domainApi').'getCx' ,['url'=>$url, 'key'=>$key] ),true);
        if(empty($so['data'])){
            return [];
        }
        //入库
        foreach($so['data'] as $k=>$v){
            $data['movie_name'] = $v['dyname'];
            $data['movie_img'] = $v['dylogo'];
            $data['classify_id'] = 1;
            $data['movie_yuan_url'] = substr( $v['dyaddr'] , strpos( $v['dyaddr'] ,'$' )+1);
            $data['movie_brief'] = $v['dydesc'];
            $data['movie_year'] = substr( $v['dyyear'] , strpos( $v['dyyear'] ,'：' )+3);
            $data['movie_status'] = 3;
            $data['movie_ctime'] = time();
        }
        $res =  DB::table('movie')->insertGetId($data);
        if($res){
            //查表
           return $res;
        }else{
            return 'error';
        }



    }


    /**
     * 尝鲜电视剧
     * @param $url
     * @param $key
     * @return array|string
     */
    public function cxdsj($url ,$key ){
        $so = json_decode(curlRequest(config('domainApi').'getCx' ,['url'=>$url, 'key'=>$key] ),true);
        if(empty($so['data'])){
            return [];
        }
        //入库
        $data = [
            'teleplay_name'=>$so['data'][0]['dyname'],
            'teleplay_img'=>$so['data'][0]['dylogo'],
            'classify_id'=>10,
            'teleplay_yuan_url'=> substr($so['data'][0]['dyaddr'], strpos($so['data'][0]['dyaddr'], '$') + 1),
            'teleplay_brief'=>$so['data'][0]['dydesc'],
            'teleplay_year'=> substr($so['data'][0]['dyyear'], strpos($so['data'][0]['dyyear'], '：') + 3),
            'teleplay_status'=>3,
            'teleplay_ctime'=>time(),
        ];


        try{
            $teleplay = DB::table('teleplay')
                ->insertGetId($data);
            foreach($so['data'] as $k=>$v) {
                $ji[$k]['serie_href'] = substr($v['dyaddr'], strpos($v['dyaddr'], '$') + 1);
                $ji[$k]['serie_level'] =  substr(
                    substr(
                        substr($v['dyaddr'], 0,strpos($v['dyaddr'], '$')) ,
                        strpos(substr($v['dyaddr'], 0,strpos($v['dyaddr'], '$')), '第')+3
                    ),0,
                    strrpos(
                        substr(
                            substr($v['dyaddr'], 0,strpos($v['dyaddr'], '$')) ,
                            strpos(substr($v['dyaddr'], 0,strpos($v['dyaddr'], '$')), '第')+3
                        ), '集')
                );
                $ji[$k]['teleplay_id'] = $teleplay;
                $ji[$k]['serie_status'] = 1;
                $ji[$k]['serie_ctime'] = time();

            }
            DB::table('serie')->insert($ji);
            return $teleplay;
        }catch(\Exception $e){
            return 'error';
        }






    }

    /**
     * 尝鲜动漫
     * @param $url
     * @param $key
     * @return array|string
     */
    public function cxdm($url ,$key ){
        $so = json_decode(curlRequest(config('domainApi').'getCx' ,['url'=>$url, 'key'=>$key] ),true);
        if(empty($so['data'])){
            return [];
        }
        //入库
        $data = [
            'comic_name'=>$so['data'][0]['dyname'],
            'comic_img'=>$so['data'][0]['dylogo'],
            'classify_id'=>11,
            'comic_yuan_url'=> substr($so['data'][0]['dyaddr'], strpos($so['data'][0]['dyaddr'], '$') + 1),
            'comic_brief'=>$so['data'][0]['dydesc'],
            'comic_year'=> substr($so['data'][0]['dyyear'], strpos($so['data'][0]['dyyear'], '：') + 3),
            'comic_status'=>3,
            'comic_ctime'=>time(),
        ];
        try{
            $comic = DB::table('comic')
                ->insertGetId($data);
            foreach($so['data'] as $k=>$v) {
                $ji[$k]['comic_serie_href'] = substr($v['dyaddr'], strpos($v['dyaddr'], '$') + 1);
                $ji[$k]['comic_serie_level'] =  substr(
                    substr(
                        substr($v['dyaddr'], 0,strpos($v['dyaddr'], '$')) ,
                        strpos(substr($v['dyaddr'], 0,strpos($v['dyaddr'], '$')), '第')+3
                    ),0,
                    strrpos(
                        substr(
                            substr($v['dyaddr'], 0,strpos($v['dyaddr'], '$')) ,
                            strpos(substr($v['dyaddr'], 0,strpos($v['dyaddr'], '$')), '第')+3
                        ), '集')
                );
                $ji[$k]['comic_id'] = $comic;
                $ji[$k]['comic_serie_status'] = 1;
                $ji[$k]['comic_serie_ctime'] = time();

            }
            DB::table('comic_serie')->insert($ji);
            return $comic;
        }catch(\Exception $e){
            return 'error';
        }






    }

    //数组专一维
    public function array_column($input, $columnKey, $indexKey = NULL){
        $columnKeyIsNumber = (is_numeric($columnKey)) ? TRUE : FALSE;
        $indexKeyIsNull = (is_null($indexKey)) ? TRUE : FALSE;
        $indexKeyIsNumber = (is_numeric($indexKey)) ? TRUE : FALSE;
        $result = array();
        foreach ((array)$input AS $key => $row)
        {
            if ($columnKeyIsNumber)
            {
                $tmp = array_slice($row, $columnKey, 1);
                $tmp = (is_array($tmp) && !empty($tmp)) ? current($tmp) : NULL;
            }
            else
            {
                $tmp = isset($row[$columnKey]) ? $row[$columnKey] : NULL;
            }
            if ( ! $indexKeyIsNull)
            {
                if ($indexKeyIsNumber)
                {
                    $key = array_slice($row, $indexKey, 1);
                    $key = (is_array($key) && ! empty($key)) ? current($key) : NULL;
                    $key = is_null($key) ? 0 : $key;
                }
                else
                {
                    $key = isset($row[$indexKey]) ? $row[$indexKey] : 0;
                }
            }

            $result[$key] = $tmp;
        }

        return $result;
    }

}
