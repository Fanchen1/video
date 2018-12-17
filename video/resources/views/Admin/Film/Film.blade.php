@extends('Admin/Layout.Film')
@section('title', '电影添加')

@section('centent')
    <div id="page-wrapper">
        <div id="page-inner">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <button type="button" class="btn btn-sm btn-info" id="shou">手动添加电影</button> ||
                            <button type="button" class="btn btn-sm btn-info" id="zi">自动采集</button>
                        </div>
                        <div class="panel-body"  name='shou'>
                            <form role="form">
                                <div class="form-group">
                                    <label>电影名称</label>
                                    <input class="form-control" type="text" name="filmName">
                                    <p class="help-block">填写电影名称</p>
                                </div>
                                <div class="form-group">
                                    <label>电影年月</label>
                                    <input class="form-control" type="text" name="filmYear">
                                    <p class="help-block">填写电影年月</p>
                                </div>
                                <div class="form-group">
                                    <label>电影分类</label>
                                    <select class="form-control" name="ZfilmClassify">
                                        <option value="1">全部</option>
                                        @foreach($classify as $v)
                                            <option value="{{$v['c_id']}}">{{$v['c_name']}}</option>
                                        @endforeach
                                    </select>
                                    <p class="help-block">填写电影分类</p>
                                </div>
                                <div class="form-group">
                                    <label>电影简介</label>
                                    <textarea class="form-control" rows="3" name="filmBrief"></textarea>
                                    <p class="help-block">填写电影简介</p>
                                </div>

                                <div class="form-group">
                                    <label>电影图片路径</label>
                                    <input class="form-control" type="text" name="filmImg">
                                    <p class="help-block">填写电影图片路径</p>
                                </div>
                                <div class="form-group">
                                    <label>电影播放详情地址</label>
                                    <input class="form-control" type="text" name="filmDetails">
                                    <p class="help-block">电影播放详情地址</p>
                                </div>
                                <div class="form-group">
                                    <label>电影播放原路径</label>
                                    <input class="form-control" type="text" name="filmYuan">
                                    <p class="help-block">填写电影播放原路径</p>
                                </div>
                                <button type="button" class="btn btn-info" id="yuan">一键添加</button>
                            </form>
                        </div>
                        <div class="panel-body"  name='zi' style="display:none">
                            <form role="form">
                                <div class="form-group">
                                    <label>电影扒取地址</label>
                                    <input class="form-control" type="text" name="CfilmUrl" value="https://www.360kan.com/dianying/list">
                                    <p class="help-block">请填写电影扒取地址</p>
                                </div>
                                <div class="form-group">
                                    <label>电影采集分类数据</label>
                                    <select class="form-control" name="CfilmClassify">
                                        <option value="1">全部</option>
                                        @foreach($classify as $v)
                                            <option value="{{$v['c_id']}}">{{$v['c_name']}}</option>
                                        @endforeach
                                    </select>
                                    <p class="help-block">电影采集分类数据</p>
                                </div>
                                <div class="form-group">
                                    <label>电影采集页数</label>
                                    <input class="form-control" type="number" name="CfilmPage" value="1">
                                    <p class="help-block">请填写电影采集页数</p>
                                </div>

                                <button type="button" class="btn btn-info" id="cai">一键添加</button>
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
        {{--table选项塔--}}
        $('#shou').click(function(){
            $('[name=zi]').hide();
            $('[name=shou]').show();
        });
        $('#zi').click(function(){
            $('[name=shou]').hide();
            $('[name=zi]').show();
        });
        // 手动采集
        $('#yuan').click(function(){
          var filmName =  $('[name=filmName]').val();//填写电影名称
          var filmYear =  $('[name=filmYear]').val();//填写电影年月
          var filmBrief =  $('[name=filmBrief]').val();//填写电影简介
          var filmImg =  $('[name=filmImg]').val();//填写电影图片路径
          var filmYuan =  $('[name=filmYuan]').val();//填写电影播放原路径
          var ZfilmClassify =  $('[name=ZfilmClassify]').val();//填写电影分类
          var filmDetails =  $('[name=filmDetails]').val();//填写电影分类

            if(filmName == ''){ //填写电影名称
                layer.msg('电影名称不能为空', { anim: 2});
                return false;
            }
            if(filmYear == ''){ //填写电影年月c
                layer.msg('电影年月不能为空', { anim: 2});
                return false;
            }
            if(filmBrief == ''){//填写电影简介
                layer.msg('电影简介不能为空', { anim: 2});
                return false;
            }
            if(filmImg == ''){//填写电影图片路径
                layer.msg('电影图片路径不能为空', { anim: 2});
                return false;
            }
            if(filmYuan == ''){//填写电影播放原路径
                layer.msg('电影播放原路径不能为空', { anim: 2});
                return false;
            }
        //    提交
            $.ajax({
                url:'dyAddDo',
                data:{filmName:filmName,filmYear:filmYear,filmBrief:filmBrief,filmImg:filmImg,filmYuan:filmYuan,ZfilmClassify:ZfilmClassify,filmDetails:filmDetails,'_token':'{{csrf_token()}}'},
                type:'post',
                dataType:'json',
                success:function( json_info ){
                    if(json_info.status == 200){
                        layer.msg(json_info.msg, { anim: 2});
                    }else{
                        layer.msg(json_info.msg, { anim: 2});
                    }
                }
            });
        });
        // 自动采集
        $('#cai').click(function(){
            var CfilmUrl = $('[name=CfilmUrl]').val();
            var CfilmPage = $('[name=CfilmPage]').val();
            var CfilmClassify = $('[name=CfilmClassify]').val();
            if(CfilmUrl == ''){
                layer.msg('电影扒取地址不能为空', { anim: 2});
                return false;
            }
            if(CfilmPage == ''){
                layer.msg('电影采集页数不能为空', { anim: 2});
                return false;
            }
            //    提交
            $.ajax({
                url:'caidy',
                data:{CfilmUrl:CfilmUrl,CfilmPage:CfilmPage,CfilmClassify:CfilmClassify,'_token':'{{csrf_token()}}'},
                type:'post',
                dataType:'json',
                success:function( json_info ){
                    if(json_info.status == 200){
                        layer.msg(json_info.msg, { anim: 2});
                    }else{
                        layer.msg(json_info.msg, { anim: 2});
                    }
                }
            });

        });

    </script>
@endsection