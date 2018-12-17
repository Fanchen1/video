@extends('Admin/Layout.Film')
@section('title', '电影添加')

@section('centent')
    <div id="page-wrapper">
        <div id="page-inner">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <button type="button" class="btn btn-sm btn-info" id="tele">手动添加电视剧</button>
                            <button type="button" class="btn btn-sm btn-info" id="tele_one">自动采集电视剧</button>
                        </div>

                        <div class="panel-body"  name='tele'>
                            <form role="form">
                                <div class="form-group">
                                    <label>电视剧名称</label>
                                    <input class="form-control" type="text" name="teleplayName">
                                    <p class="help-block">请填写电视剧名称</p>
                                </div>
                                <div class="form-group">
                                    <label>发行年月</label>
                                    <input class="form-control" type="text" name="teleplayYear">
                                    <p class="help-block">发行年月</p>
                                </div>
                                <div class="form-group">
                                    <label>电影图片路径</label>
                                    <input class="form-control" type="text" name="teleplayImg">
                                    <p class="help-block">填写电影图片路径</p>
                                </div>
                                <div class="form-group">
                                    <label>分类</label>
                                    <select class="form-control" name="CfilmClassify">
                                        <option value="1">全部</option>
                                        @foreach($classify as $v)
                                            <option value="{{$v['c_id']}}">{{$v['c_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>详情地址</label>
                                    <input class="form-control" type="text" name="teleplayDetails">
                                    <p class="help-block">请填写详情地址</p>
                                </div>

                                <div class="form-group">
                                    <label>原地址</label>
                                    <input class="form-control" type="text" name="teleplayYuan">
                                    <p class="help-block">原地址</p>
                                </div>
                                <div class="form-group">
                                    <label>父级</label>
                                        <select name="power_id" >
                                            <option value="0">——请选择——</option>
                                            @foreach($teleplay_parent as $v)
                                            <option  value="{{$v['teleplay_id']}}">{{str_repeat( '--', $v['level'] - 1 )}}{{$v['teleplay_name']}}</option>
                                            @endforeach
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label>电视剧简介</label>
                                    <textarea class="form-control" rows="3" name="teleplayBrief"></textarea>
                                    <p class="help-block">填写电视剧简介</p>
                                </div>
                                <button type="button" class="btn btn-info" id="tele2">一键添加</button>
                            </form>
                        </div>

                        <div class="panel-body"  name='tele_one' style="display:none">
                            <form role="form">
                                <div class="form-group">
                                    <label>电视剧地址</label>
                                    <input class="form-control" type="text" name="teleplayUrl" value="http://www.360kan.com/dianshi/list">
                                    <p class="help-block">电视剧扒取地址</p>
                                </div>

                                <div class="form-group">
                                    <label>分类</label>
                                    <select class="form-control" name="teleplayClassify">
                                        <option value="1">全部</option>
                                        @foreach($classify as $v)
                                            <option value="{{$v['c_id']}}">{{$v['c_name']}}</option>
                                        @endforeach
                                    </select>
                                    <p class="help-block">电视剧分类</p>
                                </div>

                                <div class="form-group">
                                    <label>电影采集页数</label>
                                    <input class="form-control" type="number" name="teleplayPage" value="1">
                                    <p class="help-block">请填写电影采集页数</p>
                                </div>
                                <button type="button" class="btn btn-info" id="tele_one2">一键添加</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="/js/jquery-3.2.1.min.js"></script>
    <script src="/layui/layui.all.js"></script>
    <script>
        //table 选项塔
        $('#tele').click(function(){
            $('[name=shou]').hide();
            $('[name=zi]').hide();
            $('[name=tele]').show();
            $('[name=tele_one]').hide();
        });
        $('#tele_one').click(function(){
            $('[name=shou]').hide();
            $('[name=zi]').hide();
            $('[name=tele]').hide();
            $('[name=tele_one]').show();
        });
        //手动
        $('#tele2').click(function(){
            var teleplayName =  $('[name=teleplayName]').val();//填写电视剧名称
            var teleplayYear = $('[name=teleplayYear]').val();//填写电视剧发行年月
            var teleplayImg = $('[name=teleplayImg]').val();//填写电视剧图片路径
            var CfilmClassify = $('[name=CfilmClassify]').val();//填写电视剧分类
            var teleplayDetails = $('[name=teleplayDetails]').val();//填写电视剧详情地址
            var teleplayYuan = $('[name=teleplayYuan]').val();//填写电视剧原地址
            var power_id = $('[name=power_id]').val();//填写电视剧父级id
            var teleplayBrief = $('[name=teleplayBrief]').val();//填写电视剧简介

            if(teleplayName == ''){ //填写电影名称
                layer.msg('电视剧名称不能为空', { anim: 2});
                return false;
            }

            if(teleplayYear == ''){ //填写电视剧发行年月
                layer.msg('电视剧发行年月不能为空', { anim: 2});
                return false;
            }

            if(teleplayImg == ''){ //填写电视剧图片路径
                layer.msg('电视剧图片路径不能为空', { anim: 2});
                return false;
            }


            if(teleplayDetails == ''){ //填写电视剧详情地址
                layer.msg('电视剧详情地址不能为空', { anim: 2});
                return false;
            }

            if(teleplayDetails == ''){ //填写电视剧详情地址
                layer.msg('电视剧详情地址不能为空', { anim: 2});
                return false;
            }
            if(teleplayYuan == ''){ //填写电视剧详情地址
                layer.msg('电视剧原地址不能为空', { anim: 2});
                return false;
            }
            if(teleplayBrief == ''){ //填写电视剧简介
                layer.msg('电视剧简介不能为空', { anim: 2});
                return false;
            }
            //    提交
            $.ajax({
                url:'teleplayAddDo',
                data:{
                    teleplayName:teleplayName,
                    teleplayYear:teleplayYear,
                    teleplayImg:teleplayImg,
                    CfilmClassify:CfilmClassify,
                    teleplayDetails:teleplayDetails,
                    teleplayYuan:teleplayYuan,
                    power_id:power_id,
                    teleplayBrief:teleplayBrief,
                    '_token':"{{csrf_token()}}"
                },
                type:'post',
                dataType:'json',
                success:function( json_info ){
                    if(json_info.status=='200'){
                        layer.msg(json_info.msg, { anim: 2});
                    }else{
                        layer.msg(json_info.msg, { anim: 2});
                    }
                }
            });
        });
        // 自动采集
        $('#tele_one2').click(function(){
            var teleplayUrl = $('[name=teleplayUrl]').val();
            var teleplayClassify = $('[name=teleplayClassify]').val();
            var teleplayPage = $('[name=teleplayPage]').val();
            $.ajax({
                url:'caidsj',
                data:{teleplayUrl:teleplayUrl,teleplayClassify:teleplayClassify,teleplayPage:teleplayPage,'_token':"{{csrf_token()}}"},
                type:'post',
                dataType:'json',
                success:function( json_info ){
                    if(json_info.status=='200'){
                        layer.msg(json_info.msg, { anim: 2});
                    }else{
                        layer.msg(json_info.msg, { anim: 2});
                    }
                }
            });
        });
    </script>
@endsection