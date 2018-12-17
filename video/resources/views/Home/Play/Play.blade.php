@extends('Home/Layout.Film')
@section('title', '播放')
@section('centent')

    <div class="container">
        <!-- /w3l-medile-movies-grids -->
        <div class="agileits-single-top">
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">首页</a></li>
                <li><a href="javaScript:window.history.go(-1);">详情</a></li>
                <li class="active">播放</li>
            </ol>
        </div>
        <div class="single-page-agile-info">
            <div class="show-top-grids-w3lagile">
                @if($status == 1){{--电影--}}
                    <div class="all-comments">
                        您正在播放的是：
                        <span style="color: #77fff3">
                                {{$data['movie_name']}}
                            </span>
                    </div> <br>
                    <div class="w3_agile_banner_bottom_grid" >
                        <iframe width="100%" height="450px" class="embed-responsive-item" src="{{$bo}}" frameborder="0" allowfullscreen="true" border="0" marginwidth="0" marginheight="0" scrolling="no">

                        </iframe>
                    </div>
                    <div class="all-comments">
                        线路：<br>
                        @foreach($xian as $k=>$v)
                            <button type="button" class="label label-primary"  style="padding: 10px 7px;" value="{{$v}}" onclick="dy('{{$v}}')">{{$k}}</button>
                        @endforeach
                    </div>
                    <div class="wthree-related-news-left">
                        <h4>剧集：</h4>
                            <div style="width: 55px;height: 50px; float: left;">
                                <a href="{{url('play?bo=movie&bo_id='.$data['movie_id'])}}" >
                                    <span class="label label-primary" style="padding: 10px 7px;">{{$data['movie_name']}}</span>
                                </a>
                            </div><br><br><br>
                        <h4>简介：</h4>{{$data['movie_brief']}}
                    </div>
                @elseif($status == 2){{--电视剧--}}
                    <div class="all-comments">
                        您正在播放的是：
                        <span style="color: #77fff3">
                            {{$data['teleplay_name']}}
                        </span>
                    </div> <br>
                    <div class="w3_agile_banner_bottom_grid" >
                        <iframe width="100%" height="450px" class="embed-responsive-item" src="{{$bo}}" frameborder="0" allowfullscreen="true" border="0" marginwidth="0" marginheight="0" scrolling="no">

                        </iframe>
                    </div>
                    <div class="all-comments">
                        线路：<br>
                        @foreach($xian as $k=>$v)
                            <button type="button" class="label label-primary"  style="padding: 10px 7px;" value="{{$v}}" onclick="dsj('{{$v}}')">{{$k}}</button>
                        @endforeach
                    </div>
                    <div class="wthree-related-news-left">
                        <h4>剧集：</h4>
                        <div style="width: 1100px;height: 200px">
                            @foreach($ji as $v)
                                <div style="width: 55px;height: 50px; float: left;">
                                    <a href="{{url('play?bo=teleplay&bo_id='.$data['teleplay_id'])}}&level={{$v['serie_level']}}" >
                                        <span class="label label-primary" style="padding: 10px 7px;">第{{$v['serie_level']}}集</span>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <h4>简介：</h4>{{$data['teleplay_brief']}}
                    </div>
                @elseif($status == 3){{--综艺--}}

                @elseif($status == 4){{--动漫--}}

                @endif

                <div class="clearfix"> </div>
            </div>

            <script>
                //电影
                function dy(xian){
                    $(".embed-responsive-item").attr('src',xian);
                }
                //电视剧
                function dsj(xian){
                    $(".embed-responsive-item").attr('src',xian);
                }
                //综艺
                function zy(xian){
                    $(".embed-responsive-item").attr('src',xian);
                }
                //动漫
                function dm(xian){
                    $(".embed-responsive-item").attr('src',xian);
                }

            </script>



            {{--<div class="w3_agile_banner_bottom_grid">--}}
                {{--<div id="owl-demo" class="owl-carousel owl-theme">--}}
                    {{--<div class="item">--}}
                        {{--<div class="w3l-movie-gride-agile w3l-movie-gride-agile1">--}}
                            {{--<a href="single.html" class="hvr-shutter-out-horizontal"><img src="/Home/images/m13.jpg" title="album-name" class="img-responsive" alt=" " />--}}
                                {{--<div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>--}}
                            {{--</a>--}}
                            {{--<div class="mid-1 agileits_w3layouts_mid_1_home">--}}
                                {{--<div class="w3l-movie-text">--}}
                                    {{--<h6><a href="single.html">Citizen Soldier</a></h6>--}}
                                {{--</div>--}}
                                {{--<div class="mid-2 agile_mid_2_home">--}}
                                    {{--<p>2016</p>--}}
                                    {{--<div class="block-stars">--}}
                                        {{--<ul class="w3l-ratings">--}}
                                            {{--<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-star-half-o" aria-hidden="true"></i></a></li>--}}
                                        {{--</ul>--}}
                                    {{--</div>--}}
                                    {{--<div class="clearfix"></div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="ribben">--}}
                                {{--<p>NEW</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="item">--}}
                        {{--<div class="w3l-movie-gride-agile w3l-movie-gride-agile1">--}}
                            {{--<a href="single.html" class="hvr-shutter-out-horizontal"><img src="/Home/images/m11.jpg" title="album-name" class="img-responsive" alt=" " />--}}
                                {{--<div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>--}}
                            {{--</a>--}}
                            {{--<div class="mid-1 agileits_w3layouts_mid_1_home">--}}
                                {{--<div class="w3l-movie-text">--}}
                                    {{--<h6><a href="single.html">X-Men</a></h6>--}}
                                {{--</div>--}}
                                {{--<div class="mid-2 agile_mid_2_home">--}}
                                    {{--<p>2016</p>--}}
                                    {{--<div class="block-stars">--}}
                                        {{--<ul class="w3l-ratings">--}}
                                            {{--<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-star-half-o" aria-hidden="true"></i></a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>--}}
                                        {{--</ul>--}}
                                    {{--</div>--}}
                                    {{--<div class="clearfix"></div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="ribben">--}}
                                {{--<p>NEW</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="item">--}}
                        {{--<div class="w3l-movie-gride-agile w3l-movie-gride-agile1">--}}
                            {{--<a href="single.html" class="hvr-shutter-out-horizontal"><img src="/Home/images/m12.jpg" title="album-name" class="img-responsive" alt=" " />--}}
                                {{--<div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>--}}
                            {{--</a>--}}
                            {{--<div class="mid-1 agileits_w3layouts_mid_1_home">--}}
                                {{--<div class="w3l-movie-text">--}}
                                    {{--<h6><a href="single.html">Greater</a></h6>--}}
                                {{--</div>--}}
                                {{--<div class="mid-2 agile_mid_2_home">--}}
                                    {{--<p>2016</p>--}}
                                    {{--<div class="block-stars">--}}
                                        {{--<ul class="w3l-ratings">--}}
                                            {{--<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-star-half-o" aria-hidden="true"></i></a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>--}}
                                        {{--</ul>--}}
                                    {{--</div>--}}
                                    {{--<div class="clearfix"></div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="ribben">--}}
                                {{--<p>NEW</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="item">--}}
                        {{--<div class="w3l-movie-gride-agile w3l-movie-gride-agile1">--}}
                            {{--<a href="single.html" class="hvr-shutter-out-horizontal"><img src="/Home/images/m7.jpg" title="album-name" class="img-responsive" alt=" " />--}}
                                {{--<div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>--}}
                            {{--</a>--}}
                            {{--<div class="mid-1 agileits_w3layouts_mid_1_home">--}}
                                {{--<div class="w3l-movie-text">--}}
                                    {{--<h6><a href="single.html">Light B/t Oceans</a></h6>--}}
                                {{--</div>--}}
                                {{--<div class="mid-2 agile_mid_2_home">--}}
                                    {{--<p>2016</p>--}}
                                    {{--<div class="block-stars">--}}
                                        {{--<ul class="w3l-ratings">--}}
                                            {{--<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>--}}
                                        {{--</ul>--}}
                                    {{--</div>--}}
                                    {{--<div class="clearfix"></div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="ribben">--}}
                                {{--<p>NEW</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="item">--}}
                        {{--<div class="w3l-movie-gride-agile w3l-movie-gride-agile1">--}}
                            {{--<a href="single.html" class="hvr-shutter-out-horizontal"><img src="/Home/images/m8.jpg" title="album-name" class="img-responsive" alt=" " />--}}
                                {{--<div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>--}}
                            {{--</a>--}}
                            {{--<div class="mid-1 agileits_w3layouts_mid_1_home">--}}
                                {{--<div class="w3l-movie-text">--}}
                                    {{--<h6><a href="single.html">The BFG</a></h6>--}}
                                {{--</div>--}}
                                {{--<div class="mid-2 agile_mid_2_home">--}}
                                    {{--<p>2016</p>--}}
                                    {{--<div class="block-stars">--}}
                                        {{--<ul class="w3l-ratings">--}}
                                            {{--<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-star-half-o" aria-hidden="true"></i></a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>--}}
                                        {{--</ul>--}}
                                    {{--</div>--}}
                                    {{--<div class="clearfix"></div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="ribben">--}}
                                {{--<p>NEW</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="item">--}}
                        {{--<div class="w3l-movie-gride-agile w3l-movie-gride-agile1">--}}
                            {{--<a href="single.html" class="hvr-shutter-out-horizontal"><img src="/Home/images/m9.jpg" title="album-name" class="img-responsive" alt=" " />--}}
                                {{--<div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>--}}
                            {{--</a>--}}
                            {{--<div class="mid-1 agileits_w3layouts_mid_1_home">--}}
                                {{--<div class="w3l-movie-text">--}}
                                    {{--<h6><a href="single.html">Central Intelligence</a></h6>--}}
                                {{--</div>--}}
                                {{--<div class="mid-2 agile_mid_2_home">--}}
                                    {{--<p>2016</p>--}}
                                    {{--<div class="block-stars">--}}
                                        {{--<ul class="w3l-ratings">--}}
                                            {{--<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-star-half-o" aria-hidden="true"></i></a></li>--}}
                                        {{--</ul>--}}
                                    {{--</div>--}}
                                    {{--<div class="clearfix"></div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="ribben">--}}
                                {{--<p>NEW</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="item">--}}
                        {{--<div class="w3l-movie-gride-agile w3l-movie-gride-agile1">--}}
                            {{--<a href="single.html" class="hvr-shutter-out-horizontal"><img src="/Home/images/m10.jpg" title="album-name" class="img-responsive" alt=" " />--}}
                                {{--<div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>--}}
                            {{--</a>--}}
                            {{--<div class="mid-1 agileits_w3layouts_mid_1_home">--}}
                                {{--<div class="w3l-movie-text">--}}
                                    {{--<h6><a href="single.html">Don't Think Twice</a></h6>--}}
                                {{--</div>--}}
                                {{--<div class="mid-2 agile_mid_2_home">--}}
                                    {{--<p>2016</p>--}}
                                    {{--<div class="block-stars">--}}
                                        {{--<ul class="w3l-ratings">--}}
                                            {{--<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-star-half-o" aria-hidden="true"></i></a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>--}}
                                        {{--</ul>--}}
                                    {{--</div>--}}
                                    {{--<div class="clearfix"></div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="ribben">--}}
                                {{--<p>NEW</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="item">--}}
                        {{--<div class="w3l-movie-gride-agile w3l-movie-gride-agile1">--}}
                            {{--<a href="single.html" class="hvr-shutter-out-horizontal"><img src="/Home/images/m17.jpg" title="album-name" class="img-responsive" alt=" " />--}}
                                {{--<div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>--}}
                            {{--</a>--}}
                            {{--<div class="mid-1 agileits_w3layouts_mid_1_home">--}}
                                {{--<div class="w3l-movie-text">--}}
                                    {{--<h6><a href="single.html">Peter</a></h6>--}}
                                {{--</div>--}}
                                {{--<div class="mid-2 agile_mid_2_home">--}}
                                    {{--<p>2016</p>--}}
                                    {{--<div class="block-stars">--}}
                                        {{--<ul class="w3l-ratings">--}}
                                            {{--<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-star-half-o" aria-hidden="true"></i></a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>--}}
                                        {{--</ul>--}}
                                    {{--</div>--}}
                                    {{--<div class="clearfix"></div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="ribben">--}}
                                {{--<p>NEW</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="item">--}}
                        {{--<div class="w3l-movie-gride-agile w3l-movie-gride-agile1">--}}
                            {{--<a href="single.html" class="hvr-shutter-out-horizontal"><img src="/Home/images/m15.jpg" title="album-name" class="img-responsive" alt=" " />--}}
                                {{--<div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>--}}
                            {{--</a>--}}
                            {{--<div class="mid-1 agileits_w3layouts_mid_1_home">--}}
                                {{--<div class="w3l-movie-text">--}}
                                    {{--<h6><a href="single.html">God’s Compass</a></h6>--}}
                                {{--</div>--}}
                                {{--<div class="mid-2 agile_mid_2_home">--}}
                                    {{--<p>2016</p>--}}
                                    {{--<div class="block-stars">--}}
                                        {{--<ul class="w3l-ratings">--}}
                                            {{--<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>--}}
                                        {{--</ul>--}}
                                    {{--</div>--}}
                                    {{--<div class="clearfix"></div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="ribben">--}}
                                {{--<p>NEW</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

        </div>
    </div>

@endsection






