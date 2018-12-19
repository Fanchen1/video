<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <link href="/Admin/assets/css/bootstrap.css" rel="stylesheet" />
    <link href="/Admin/assets/css/font-awesome.css" rel="stylesheet" />
    <link href="/Admin/assets/css/basic.css" rel="stylesheet" />
    <link href="/Admin/assets/css/custom.css" rel="stylesheet" />
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>

<div id="wrapper">
    {{--导航栏--}}
    <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">
                @if(session('adminName')   == '')
                          首页
                @else
                          管理员
                @endif
            </a>
        </div>

        <div class="header-right">
            <a href="message-task.html" class="btn btn-info" title="New Message"><b>30 </b><i class="fa fa-envelope-o fa-2x"></i></a>
            <a href="message-task.html" class="btn btn-primary" title="New Task"><b>40 </b><i class="fa fa-bars fa-2x"></i></a>
            <a href="login.html" class="btn btn-danger" title="Logout"><i class="fa fa-exclamation-circle fa-2x"></i></a>
        </div>
    </nav>
    {{--导航栏结束--}}

    {{--左侧栏--}}
    <nav class="navbar-default navbar-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="main-menu">
                <li>
                    <div class="user-img-div">
                        @if(session('adminImg')   == '')
                            <img src="{{asset('/Admin/assets/img/user.png')}}"  />
                        @else
                            <img src="{{session('adminImg')}}" class="img-thumbnail">
                        @endif
                        <div class="inner-text">
                            @if(session('adminName')   == '')
                                神秘人
                            @else
                               姓名 ： {{session('adminName')}}
                            @endif
                            <br />
                            <small>上次登录：2周前</small>
                        </div>
                    </div>

                </li>


                <li>
                    <a href="#"><i class="fa fa-desktop "></i>视频管理<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="#">电影管理<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="{{url('dyAdd')}}"><i class="fa fa-plus "></i>电影添加</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-comments-o "></i>电影列表</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">电视剧管理<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="{{url('teleplayAdd')}}"><i class="fa fa-plus "></i>电视剧添加</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-comments-o "></i>电视剧列表</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="#">动漫管理<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="{{url('comicAdd')}}"><i class="fa fa-plus "></i>动漫添加</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-comments-o "></i>动漫列表</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">综艺管理<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="#"><i class="fa fa-plus "></i>综艺添加</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-comments-o "></i>综艺列表</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#">
                        <i class="fa fa-yelp ">
                        </i>分类管理
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{url('classifyAdd')}}"><i class="fa fa-coffee"></i>分类添加</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-flash "></i>分类列表</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="table.html"><i class="fa fa-flash "></i>Data Tables </a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-bicycle "></i>Forms <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="form.html"><i class="fa fa-desktop "></i>Basic </a>
                        </li>
                        <li>
                            <a href="form-advance.html"><i class="fa fa-code "></i>Advance</a>
                        </li>


                    </ul>
                </li>
                <li>
                    <a href="gallery.html"><i class="fa fa-anchor "></i>Gallery</a>
                </li>
                <li>
                    <a href="error.html"><i class="fa fa-bug "></i>Error Page</a>
                </li>
                <li>
                    <a href="login.html"><i class="fa fa-sign-in "></i>Login Page</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-sitemap "></i>Multilevel Link <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="#"><i class="fa fa-bicycle "></i>Second Level Link</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-flask "></i>Second Level Link</a>
                        </li>
                        <li>
                            <a href="#">Second Level Link<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="#"><i class="fa fa-plus "></i>Third Level Link</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-comments-o "></i>Third Level Link</a>
                                </li>

                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="blank.html"><i class="fa fa-square-o "></i>Blank Page</a>
                </li>
            </ul>

        </div>

    </nav>
    {{--左侧栏结束--}}

    {{--中间--}}
    @yield('centent')
    {{--中间结束--}}
</div>




{{--底部--}}
<div id="footer-sec">
    Copyright 逍遥子 &copy; 2018.逍遥子 版权所有 -------<a href="tencent://Message/?Uin=2784279750websiteName=www.qq.com&Menu=yes" >联系超管</a>
</div>
{{--底部结束--}}
<script src="/Admin/assets/js/jquery-1.10.2.js"></script>
<script src="/Admin/assets/js/bootstrap.js"></script>
<script src="/Admin/assets/js/jquery.metisMenu.js"></script>
<script src="/Admin/assets/js/custom.js"></script>



</body>
</html>
