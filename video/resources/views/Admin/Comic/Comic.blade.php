@extends('Admin/Layout.Film')
@section('title', '动漫添加')

@section('centent')
    <div id="page-wrapper">
        <div id="page-inner">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <button type="button" class="btn btn-sm btn-info" id="tele">手动添动漫</button>
                            <button type="button" class="btn btn-sm btn-info" id="tele_one">自动采集动漫</button>
                        </div>

                        <div class="panel-body"  name='tele'>
                            <form role="form">
                                <div class="form-group">
                                    <label>动漫名称</label>
                                    <input class="form-control" type="text" name="ComicName">
                                    <p class="help-block">请填写动漫名称</p>
                                </div>
                                <div class="form-group">
                                    <label>发行年月</label>
                                    <input class="form-control" type="text" name="ComicYear">
                                    <p class="help-block">发行年月</p>
                                </div>
                                <div class="form-group">
                                    <label>动漫图片路径</label>
                                    <input class="form-control" type="text" name="ComicImg">
                                    <p class="help-block">填写动漫图片路径</p>
                                </div>
                                <div class="form-group">
                                    <label>分类</label>
                                    <select class="form-control" name="ComicClassify">
                                        <option value="1">全部</option>
                                        @foreach($classify as $v)
                                            <option value="{{$v['c_id']}}">{{$v['c_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>动漫详情地址</label>
                                    <input class="form-control" type="text" name="ComicDetails">
                                    <p class="help-block">请填写动漫详情地址</p>
                                </div>

                                <div class="form-group">
                                    <label>动漫原地址</label>
                                    <input class="form-control" type="text" name="ComicYuan">
                                    <p class="help-block">动漫原地址</p>
                                </div>
                                <div class="form-group">
                                    <label>动漫父级</label>
                                    <select name="power_id" >
                                        <option value="0">——请选择——</option>
                                        @foreach($comic_parent as $v)
                                            <option  value="{{$v['comic_id']}}">{{$v['comic_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>动漫简介</label>
                                    <textarea class="form-control" rows="3" name="ComicBrief"></textarea>
                                    <p class="help-block">填写动漫简介</p>
                                </div>
                                <button type="button" class="btn btn-info" id="tele2">一键添加</button>
                            </form>
                        </div>

                        <div class="panel-body"  name='tele_one' style="display:none">
                            <form role="form">
                                <div class="form-group">
                                    <label>动漫地址</label>
                                    <input class="form-control" type="text" name="ComicUrl" value="http://www.360kan.com/dongman/list">
                                    <p class="help-block">动漫扒取地址</p>
                                </div>

                                <div class="form-group">
                                    <label>分类</label>
                                    <select class="form-control" name="CaiComicClassify">
                                        <option value="1">全部</option>
                                        @foreach($classify as $v)
                                            <option value="{{$v['c_id']}}">{{$v['c_name']}}</option>
                                        @endforeach
                                    </select>
                                    <p class="help-block">动漫分类</p>
                                </div>

                                <div class="form-group">
                                    <label>动漫采集页数</label>
                                    <input class="form-control" type="number" name="ComicPage" value="1">
                                    <p class="help-block">请填写动漫采集页数</p>
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
            var ComicName =  $('[name=ComicName]').val();//填写电视剧名称
            var ComicYear = $('[name=ComicYear]').val();//填写电视剧发行年月
            var ComicImg = $('[name=ComicImg]').val();//填写电视剧图片路径
            var ComicClassify = $('[name=ComicClassify]').val();//填写电视剧分类
            var ComicDetails = $('[name=ComicDetails]').val();//填写电视剧详情地址
            var ComicYuan = $('[name=ComicYuan]').val();//填写电视剧原地址
            var power_id = $('[name=power_id]').val();//填写电视剧父级id
            var ComicBrief = $('[name=ComicBrief]').val();//填写电视剧简介

            if(ComicName == ''){ //填写电影名称
                layer.msg('动漫名称不能为空', { anim: 2});
                return false;
            }

            if(ComicYear == ''){ //填写电视剧发行年月
                layer.msg('动漫发行年月不能为空', { anim: 2});
                return false;
            }

            if(ComicImg == ''){ //填写电视剧图片路径
                layer.msg('动漫图片路径不能为空', { anim: 2});
                return false;
            }


            if(ComicDetails == ''){ //填写电视剧详情地址
                layer.msg('动漫详情地址不能为空', { anim: 2});
                return false;
            }

            if(ComicYuan == ''){ //填写电视剧详情地址
                layer.msg('动漫原地址不能为空', { anim: 2});
                return false;
            }
            if(ComicBrief == ''){ //填写电视剧简介
                layer.msg('动漫简介不能为空', { anim: 2});
                return false;
            }
            //    提交
            $.ajax({
                url:'comicAddDo',
                data:{
                    ComicName:ComicName,
                    ComicYear:ComicYear,
                    ComicImg:ComicImg,
                    ComicClassify:ComicClassify,
                    ComicDetails:ComicDetails,
                    ComicYuan:ComicYuan,
                    power_id:power_id,
                    ComicBrief:ComicBrief,
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
            var ComicUrl = $('[name=ComicUrl]').val();
            var ComicClassify = $('[name=CaiComicClassify]').val();
            var ComicPage = $('[name=ComicPage]').val();
            $.ajax({
                url:'caiComic',
                data:{ComicUrl:ComicUrl,ComicClassify:ComicClassify,ComicPage:ComicPage,'_token':"{{csrf_token()}}"},
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