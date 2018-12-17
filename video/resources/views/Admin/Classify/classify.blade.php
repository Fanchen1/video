@extends('Admin/Layout.Film')
@section('title', '电影添加')

@section('centent')
    <div id="page-wrapper">
        <div id="page-inner">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <button type="button" class="btn btn-sm btn-info" id="shou">手动添加分类</button> ||
                            <button type="button" class="btn btn-sm btn-info" id="zi">自动采集分类</button>
                        </div>
                        <div class="panel-body"  name='shou'>
                            <form role="form">
                                <div class="form-group">
                                    <select name="power_id" >
                                        <option value="0">——请选择——</option>
                                        @foreach($Menu as $v)
                                        <option  value="{{$v['c_id']}}">{{str_repeat( '--', $v['level'] - 1 )}}{{$v['c_name']}}</option>
                                        @endforeach
                                     </select>
                                        <label>分类名称</label>
                                        <input class="form-control" type="text" name="CatName">
                                        <p class="help-block">填写分类名称</p>
                                </div>
                                <div class="form-group">
                                    <label>cat</label>
                                    <input class="form-control" type="text" name="cat" value="all">
                                    <p class="help-block">请填写关键字</p>
                                </div>
                                <button type="button" class="btn btn-info" id="yuan">一键添加</button>
                            </form>
                        </div>
                        <div class="panel-body"  name='zi' style="display:none">
                            <form role="form">
                                <div class="form-group">
                                    <label>电影名称</label>
                                    <input class="form-control" type="text" name="CfilmUrl">
                                    <p class="help-block">电影扒取地址</p>
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
          var CatName =  $('[name=CatName]').val();//填写分类名称
		  var power_id = $('[name=power_id]').val();
		  var cat = $('[name=cat]').val();
            if(CatName == ''){ //填写分类名称
                layer.msg('分类名称不能为空', { anim: 2});
                return false;
            }
            if(cat == ''){
                layer.msg('关键字不能为空', { anim: 2});
                return false;
            }
        //    提交
            $.ajax({
                url:'classifyAddDo',
                data:{CatName:CatName,power_id:power_id ,cat:cat,'_token':'{{csrf_token()}}'},
                type:'post',
                dataType:'json',
                success:function( json_info ){
					if(json_info.status=='200'){
						alert('成功');
					}else{
						alert('失败');
					}
                }
            });
        });

        // 自动采集
        $('#cai').click(function(){
            var CfilmUrl = $('[name=CfilmUrl]').val();
            if(CfilmUrl == ''){
                layer.msg('电影扒取地址不能为空', { anim: 2});
                return false;
            }
        });

    </script>
@endsection