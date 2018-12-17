@extends('Home/Layout.Film')
@section('title', '详情')
@section('centent')
    <div class="container">
        <div class="agileits-news-top">
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">首页</a></li>
                <li class="active">详情</li>
            </ol>
        </div>
        <div class="agileinfo-news-top-grids">
            <div class="col-md-8 wthree-top-news-left">

            @if($status == 1) {{--电影--}}
                <div class="wthree-related-news-left">
                    <h4>{{$data['movie_name']}}</h4>
                    <div class="wthree-news-top-left">
                        <div class="col-md-6 w3-agileits-news-left" >

                            <div class="col-sm-5 wthree-news-img" style="top: 10px;">
                                {{--<a href="news-single.html"><img src="" alt="" /></a>--}}
                                <a href="{{url('play?bo=movie&bo_id='.$data['movie_id'])}}" class="hvr-shutter-out-horizontal">
                                    <img src="{{$data['movie_img']}}" title="{{$data['movie_name']}}" class="img-responsive" alt=" " />
                                    <div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>
                                </a>

                            </div>
                            <div class="col-sm-7 wthree-news-info" style="left: 50px;width:180px;">
                                <h5>影片：<a href="">{{$data['movie_name']}}</a></h5>
                                <p>年份：{{$data['movie_year']}}</p>
                               <p>立即播放：
                                   <a href="{{url('play?bo=movie&bo_id='.$data['movie_id'])}}"><span class="label label-primary" style="padding: 10px 12px;">快速播放</span></a>
                               </p>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="wthree-related-news-left">
                    <h4>剧集：</h4>
                    <p>
                        <a href="{{url('play?bo=movie&bo_id='.$data['movie_id'])}}">
                            <span class="label label-primary" style="padding: 10px 7px;">{{$data['movie_name']}}</span>
                        </a>
                    </p><br>
                    <h4>简介：</h4>{{$data['movie_brief']}}
                </div>
            @else    {{--电视剧--}}
                <div class="wthree-related-news-left">
                    <h4>{{$data['teleplay_name']}}</h4>
                    <div class="wthree-news-top-left">
                        <div class="col-md-6 w3-agileits-news-left" >

                            <div class="col-sm-5 wthree-news-img" style="top: 10px;">
                                {{--<a href="news-single.html"><img src="" alt="" /></a>--}}
                                <a href="{{url('play?bo=teleplay&bo_id='.$data['teleplay_id'])}}&level=1" class="hvr-shutter-out-horizontal">
                                    <img src="{{$data['teleplay_img']}}" title="{{$data['teleplay_name']}}" class="img-responsive" alt=" " />
                                    <div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>
                                </a>
                            </div>
                            <div class="col-sm-7 wthree-news-info" style="left: 50px;width:180px;">
                                <h5>影片：<a href="">{{$data['teleplay_name']}}</a></h5>
                                <p>集：{{$data['teleplay_year']}}</p>
                                <p>立即播放：
                                    <b>
                                        <a href="{{url('play?bo=teleplay&bo_id='.$data['teleplay_id'])}}&level=1">
                                            <span class="label label-primary" style="padding: 10px 12px;">快速播放</span>
                                        </a>
                                    </b>
                                </p>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="wthree-related-news-left">
                    <h4>剧集：</h4>
                    <div style="width: 750px;height: 200px">
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
            @endif






            </div>
            <div class="col-md-4 wthree-news-right">
                <!-- news-right-top -->
                <div class="news-right-top">
                    <div class="wthree-news-right-heading">
                        <h3>评论专区</h3>
                    </div>
                    <div class="wthree-news-right-top">
                        <div class="news-grids-bottom">
                            <!-- date -->
                            <div id="design" class="date">
                                <div id="cycler">
                                    {{--<div class="date-text">--}}
                                        {{--<a href="news-single.html">August 15,2016</a>--}}
                                        {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>--}}
                                    {{--</div>--}}
                                    {{--<div class="date-text">--}}
                                        {{--<a href="news-single.html">July 08,2016 <span class="blinking"><img src="/Home/images/new.png" alt="" /></span></a>--}}
                                        {{--<p>Nullam non turpis sit amet metus tristique egestas et et orci.</p>--}}
                                    {{--</div>--}}
                                    {{--<div class="date-text">--}}
                                        {{--<a href="news-single.html">February 15,2016</a>--}}
                                        {{--<p>Duis venenatis ac ipsum vel ultricies in placerat quam</p>--}}
                                    {{--</div>--}}
                                    {{--<div class="date-text">--}}
                                        {{--<a href="news-single.html">January 15,2016 <span class="blinking"><img src="/Home/images/new.png" alt="" /></span></a>--}}
                                        {{--<p>Pellentesque ullamcorper fringilla ipsum, ornare dapibus velit volutpat sit amet.</p>--}}
                                    {{--</div>--}}
                                    {{--<div class="date-text">--}}
                                        {{--<a href="news-single.html">September 24,2016</a>--}}
                                        {{--<p>In lobortis ipsum mi, ac imperdiet elit pellentesque at.</p>--}}
                                    {{--</div>--}}
                                    {{--<div class="date-text">--}}
                                        {{--<a href="news-single.html">August 15,2016</a>--}}
                                        {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>--}}
                                    {{--</div>--}}
                                    {{--<div class="date-text">--}}
                                        {{--<a href="news-single.html">July 08,2016 <span class="blinking"><img src="/Home/images/new.png" alt="" /></span></a>--}}
                                        {{--<p>Nullam non turpis sit amet metus tristique egestas et et orci.</p>--}}
                                    {{--</div>--}}
                                    {{--<div class="date-text">--}}
                                        {{--<a href="news-single.html">February 15,2016</a>--}}
                                        {{--<p>Duis venenatis ac ipsum vel ultricies in placerat quam</p>--}}
                                    {{--</div>--}}

                                    {{--<div class="date-text">--}}
                                        {{--<a href="news-single.html">September 24,2016</a>--}}
                                        {{--<p>In lobortis ipsum mi, ac imperdiet elit pellentesque at.</p>--}}
                                    {{--</div>--}}
                                    <div class="date-text">
                                        <a href="#">12 12,2018
                                            <span class="blinking">
                                                <img src="/Home/images/new.png" alt="" />
                                            </span>
                                        </a>
                                        <p>此版块尚未完工哦！此版块此时正在“快马加鞭来的路上”，亲，请耐心等待哦！</p>
                                    </div>
                                </div>
                                <script>
                                    function blinker() {
                                        $('.blinking').fadeOut(500);
                                        $('.blinking').fadeIn(500);
                                    }
                                    setInterval(blinker, 1000);
                                </script>
                                <script>
                                    function cycle($item, $cycler){
                                        setTimeout(cycle, 2000, $item.next(), $cycler);

                                        $item.slideUp(1000,function(){
                                            $item.appendTo($cycler).show();
                                        });
                                    }
                                    cycle($('#cycler div:first'),  $('#cycler'));
                                </script>
                            </div>
                            <!-- //date -->
                        </div>
                    </div>
                </div>
                <!-- //news-right-top -->
            </div>

        </div>
    </div>
    {{--<div class="w3l-latest-movies-grids">--}}
        {{--<h4 class="latest-text w3_latest_text">Latest Movies</h4>--}}
        {{--<div class="container">--}}
            {{--<!-- /latest-movies -->--}}
            {{--<div class="browse-inner">--}}
                {{--<div class="col-md-2 w3l-movie-gride-agile">--}}
                    {{--<a href="single.html" class="hvr-shutter-out-horizontal"><img src="/Home/images/m7.jpg" title="album-name" alt=" " />--}}
                        {{--<div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>--}}
                    {{--</a>--}}
                    {{--<div class="mid-1">--}}
                        {{--<div class="w3l-movie-text">--}}
                            {{--<h6><a href="single.html">Light B/t Oceans</a></h6>--}}
                        {{--</div>--}}
                        {{--<div class="mid-2">--}}

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

                        {{--</div>--}}

                    {{--</div>--}}
                    {{--<div class="ribben">--}}
                        {{--<p>NEW</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-md-2 w3l-movie-gride-agile">--}}
                    {{--<a href="single.html" class="hvr-shutter-out-horizontal"><img src="/Home/images/m8.jpg" title="album-name" alt=" " />--}}
                        {{--<div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>--}}
                    {{--</a>--}}
                    {{--<div class="mid-1">--}}
                        {{--<div class="w3l-movie-text">--}}
                            {{--<h6><a href="single.html">The BFG</a></h6>--}}
                        {{--</div>--}}
                        {{--<div class="mid-2">--}}

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

                        {{--</div>--}}

                    {{--</div>--}}
                    {{--<div class="ribben">--}}
                        {{--<p>NEW</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-md-2 w3l-movie-gride-agile">--}}
                    {{--<a href="single.html" class="hvr-shutter-out-horizontal"><img src="/Home/images/m9.jpg" title="album-name" alt=" " />--}}
                        {{--<div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>--}}
                    {{--</a>--}}
                    {{--<div class="mid-1">--}}
                        {{--<div class="w3l-movie-text">--}}
                            {{--<h6><a href="single.html">Central Intelligence</a></h6>--}}
                        {{--</div>--}}
                        {{--<div class="mid-2">--}}

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

                        {{--</div>--}}

                    {{--</div>--}}
                    {{--<div class="ribben">--}}
                        {{--<p>NEW</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-md-2 w3l-movie-gride-agile">--}}
                    {{--<a href="single.html" class="hvr-shutter-out-horizontal"><img src="/Home/images/m10.jpg" title="album-name" alt=" " />--}}
                        {{--<div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>--}}
                    {{--</a>--}}
                    {{--<div class="mid-1">--}}
                        {{--<div class="w3l-movie-text">--}}
                            {{--<h6><a href="single.html">Don't Think Twice</a></h6>--}}
                        {{--</div>--}}
                        {{--<div class="mid-2">--}}

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

                        {{--</div>--}}

                    {{--</div>--}}
                    {{--<div class="ribben">--}}
                        {{--<p>NEW</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-md-2 w3l-movie-gride-agile">--}}
                    {{--<a href="single.html" class="hvr-shutter-out-horizontal"><img src="/Home/images/m11.jpg" title="album-name" alt=" " />--}}
                        {{--<div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>--}}
                    {{--</a>--}}
                    {{--<div class="mid-1">--}}
                        {{--<div class="w3l-movie-text">--}}
                            {{--<h6><a href="single.html">X-Men</a></h6>--}}
                        {{--</div>--}}
                        {{--<div class="mid-2">--}}

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

                        {{--</div>--}}

                    {{--</div>--}}
                    {{--<div class="ribben">--}}
                        {{--<p>NEW</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-md-2 w3l-movie-gride-agile">--}}
                    {{--<a href="single.html" class="hvr-shutter-out-horizontal"><img src="/Home/images/m12.jpg" title="album-name" alt=" " />--}}
                        {{--<div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>--}}
                    {{--</a>--}}
                    {{--<div class="mid-1">--}}
                        {{--<div class="w3l-movie-text">--}}
                            {{--<h6><a href="single.html">Greater</a></h6>--}}
                        {{--</div>--}}
                        {{--<div class="mid-2">--}}

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

                        {{--</div>--}}

                    {{--</div>--}}
                    {{--<div class="ribben">--}}
                        {{--<p>NEW</p>--}}
                    {{--</div>--}}
                {{--</div>--}}


            {{--</div>--}}
            {{--<!-- //latest-movies -->--}}

        {{--</div>--}}
    {{--</div>--}}
    <!-- 弹出框-->
    <script src="/Home/js/jquery.magnific-popup.js" type="text/javascript"></script>
    <!--//弹出框结束 -->
@endsection