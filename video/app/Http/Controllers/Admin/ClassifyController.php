<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class ClassifyController extends Controller
{
	public function classifyAdd(){
		$power =  DB::table('classify')->where(['c_status'=>1])->get();
        $power =  json_decode(json_encode($power),true);
        $Menu=$this->recursion($power );
		//print_r($Menu);exit;
		return view('Admin/Classify.classify',compact('Menu'));
	}
	public function classifyAdddo(){
		$data=$_POST;
		//print_r($data);exit;
		if($data['power_id'] == 0){
            $power = 0;
            $level = 1;
        }else{
            $power = $data['power_id'];
            $levels =  DB::table('classify')->where(['c_id'=>$data['power_id']])->first();
            $levels =  json_decode(json_encode($levels),true);
            $level = $levels['level']+1;
        }
        if(empty($data['cat'])){
            $cat = 'all';
        }
        //添加
        $menu = [
            'c_name'=>$data['CatName'],
            'parent_id'=>$power,
            'level'=> $level,
            'c_ctime'=>time(),
            'c_status'=>1,
			'cat'=>$data['cat']
        ];
		$data=DB::table('classify')->insert($menu);
		if($data){
			return SuccessOk('200','ok','','');
		}else{
			return Error('00001','no','');
		}
	}
	public function recursion($arr,$parent_id=0){
        static $data=[];
        foreach($arr as $k => $v){
            if($v['parent_id'] == $parent_id){
                $data[]=$v;
                $this->recursion($arr,$v['c_id']);
            }
        }
        return $data;
    }

}