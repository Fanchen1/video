@extends('Home/Layout.Film')
@section('title', '首页')
@section('centent')
    <div class="centent">
        <!-- 导航 -->
        <div class="movies_nav">
            <div class="container">
                <nav class="navbar navbar-default">
                    <div class="navbar-header navbar-left">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
                        <nav>
                            <ul class="nav navbar-nav">
                                <li class="active"><a href="{{url('/')}}">首页</a></li>

                                <li><a href="{{url('moreMovie')}}">电影</a></li>
                                <li><a href="{{url('moreTeleplay')}}">电视剧</a></li>

                                <li><a href="short-codes.html">综艺</a></li>
                                <li><a href="list.html">动漫</a></li>
                                {{--<li class="dropdown">--}}
                                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">分类<b class="caret"></b></a>--}}
                                    {{--<ul class="dropdown-menu multi-column columns-3">--}}
                                        {{--<li>--}}
                                            {{--<div class="col-sm-4">--}}
                                                {{--<ul class="multi-column-dropdown">--}}
                                                    {{--<li><a href="genres.html">行动</a></li>--}}
                                                    {{--<li><a href="genres.html">传</a></li>--}}
                                                    {{--<li><a href="genres.html">犯罪</a></li>--}}
                                                    {{--<li><a href="genres.html">家庭</a></li>--}}
                                                    {{--<li><a href="horror.html">恐怖</a></li>--}}
                                                    {{--<li><a href="genres.html">浪漫</a></li>--}}
                                                    {{--<li><a href="genres.html">体育</a></li>--}}
                                                    {{--<li><a href="genres.html">战争</a></li>--}}
                                                {{--</ul>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-sm-4">--}}
                                                {{--<ul class="multi-column-dropdown">--}}
                                                    {{--<li><a href="genres.html">冒险</a></li>--}}
                                                    {{--<li><a href="comedy.html">喜剧</a></li>--}}
                                                    {{--<li><a href="genres.html">记录</a></li>--}}
                                                    {{--<li><a href="genres.html">幻想</a></li>--}}
                                                    {{--<li><a href="genres.html">惊悚</a></li>--}}
                                                {{--</ul>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-sm-4">--}}
                                                {{--<ul class="multi-column-dropdown">--}}
                                                    {{--<li><a href="genres.html">动画</a></li>--}}
                                                    {{--<li><a href="genres.html">服装</a></li>--}}
                                                    {{--<li><a href="genres.html">戏剧</a></li>--}}
                                                    {{--<li><a href="genres.html">历史</a></li>--}}
                                                    {{--<li><a href="genres.html">音乐</a></li>--}}
                                                    {{--<li><a href="genres.html">心理</a></li>--}}
                                                {{--</ul>--}}
                                            {{--</div>--}}
                                            {{--<div class="clearfix"></div>--}}
                                        {{--</li>--}}
                                    {{--</ul>--}}
                                {{--</li>--}}
                                {{--<li class="dropdown">--}}
                                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">国家 <b class="caret"></b></a>--}}
                                    {{--<ul class="dropdown-menu multi-column columns-3">--}}
                                        {{--<li>--}}
                                            {{--<div class="col-sm-4">--}}
                                                {{--<ul class="multi-column-dropdown">--}}
                                                    {{--<li><a href="genres.html">亚洲</a></li>--}}
                                                    {{--<li><a href="genres.html">法国</a></li>--}}
                                                    {{--<li><a href="genres.html">台湾</a></li>--}}
                                                    {{--<li><a href="genres.html">美国</a></li>--}}
                                                {{--</ul>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-sm-4">--}}
                                                {{--<ul class="multi-column-dropdown">--}}
                                                    {{--<li><a href="genres.html">中国</a></li>--}}
                                                    {{--<li><a href="genres.html">HongCong</a></li>--}}
                                                    {{--<li><a href="genres.html">日本</a></li>--}}
                                                    {{--<li><a href="genres.html">泰国</a></li>--}}
                                                {{--</ul>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-sm-4">--}}
                                                {{--<ul class="multi-column-dropdown">--}}
                                                    {{--<li><a href="genres.html">欧元</a></li>--}}
                                                    {{--<li><a href="genres.html">印度</a></li>--}}
                                                    {{--<li><a href="genres.html">韩国</a></li>--}}
                                                    {{--<li><a href="genres.html">英国</a></li>--}}
                                                {{--</ul>--}}
                                            {{--</div>--}}
                                            {{--<div class="clearfix"></div>--}}
                                        {{--</li>--}}
                                    {{--</ul>--}}
                                {{--</li>--}}
                            </ul>
                        </nav>
                    </div>
                </nav>
            </div>
        </div>
        <!-- 导航结束 -->
        <!-- 横幅 -->
        <div id="slidey" style="display:none;">
            <ul>
                @foreach($dyTop as $v)
                    <li><img src="{{$v['movie_top_img']}}" alt=" "><p class='title'><a href="{{url('/index.php/playDetails?movie='.$v['movie_id'])}}">{{$v['movie_name']}}</a></p><p class='description'>{{$v['movie_brief']}}</p></li>
                @endforeach
            </ul>
        </div>
        <script src="/Home/js/jquery.slidey.js"></script>
        <script src="/Home/js/jquery.dotdotdot.min.js"></script>
        <script type="text/javascript">
            $("#slidey").slidey({
                interval: 8000,
                listCount: 5,
                autoplay: false,
                showList: true
            });
            $(".slidey-list-description").dotdotdot();
        </script>
        <!-- //横幅结束 -->
        <!-- 旗底-->
        {{--<div class="banner-bottom">--}}
            {{--<div class="container">--}}
                {{--<div class="w3_agile_banner_bottom_grid">--}}
                    {{--<div id="owl-demo" class="owl-carousel owl-theme">--}}

                        {{--<div class="item">--}}
                                {{--<div class="w3l-movie-gride-agile w3l-movie-gride-agile1">--}}
                                    {{--<a href="single.html" class="hvr-shutter-out-horizontal"><img src="/Home/images/m15.jpg" title="album-name" class="img-responsive" alt=" " />--}}
                                        {{--<div class="w3l-action-icon">--}}
                                            {{--<i class="fa fa-play-circle" aria-hidden="true"></i>--}}
                                        {{--</div>--}}
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
            {{--</div>--}}
        {{--</div>--}}
        <!-- //旗底结束 -->
        <div class="general_social_icons">
            <nav class="social">
                <ul>
                    <li class="w3_twitter"><a href="#">Twitter <i class="fa fa-twitter"></i></a></li>
                    <li class="w3_facebook"><a href="#">Facebook <i class="fa fa-facebook"></i></a></li>
                    <li class="w3_dribbble"><a href="#">Dribbble <i class="fa fa-dribbble"></i></a></li>
                    <li class="w3_g_plus"><a href="#">Google+ <i class="fa fa-google-plus"></i></a></li>
                </ul>
            </nav>
        </div>
            {{--电影--}}
        <div class="general">
            <h4 class="latest-text w3_latest_text">
                <span style="color: #ff6469">电</span>
                <span style="color: #ff43f6">影</span>
                <span style="color: #74ff72">专</span>
                <span style="color: #6d76ff">区</span>
            </h4>
            <div class="container">
                <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                    {{--分类--}}
                    <ul id="myTab" class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">全部</a>
                        </li>
                        <li role="presentation">
                            <a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">喜剧</a>
                        </li>
                        <li role="presentation">
                            <a href="#rating" id="rating-tab" role="tab" data-toggle="tab" aria-controls="rating" aria-expanded="true">动作</a>
                        </li>
                        <li role="presentation">
                            <a href="{{url('moreMovie')}}" >..........</a>
                        </li>
                    </ul>
                    {{--电影内容--}}
                    <div id="myTabContent" class="tab-content">
                        {{--全部--}}
                        <div role="tabpanel" class="tab-pane fade active in" id="home" aria-labelledby="home-tab">
                            <div class="w3_agile_featured_movies">
                                @foreach($dyQuan as $v)
                                    <div class="col-md-2 w3l-movie-gride-agile">
                                        <a href="{{url('/index.php/playDetails?movie='.$v['movie_id'])}}" class="hvr-shutter-out-horizontal">
                                            <img src="{{$v['movie_img']}}" title="{{$v['movie_name']}}" class="img-responsive" alt=" " style="width: 175px;height: 245px;"/>
                                        <div class="w3l-action-icon">
                                            <i class="fa fa-play-circle" aria-hidden="true"></i>
                                        </div>
                                    </a>
                                    <div class="mid-1 agileits_w3layouts_mid_1_home">
                                        <div class="w3l-movie-text">
                                            <h6><a href="{{url('/index.php/playDetails?movie='.$v['movie_id'])}}">{{$v['movie_name']}}</a></h6>
                                        </div>
                                        <div class="mid-2 agile_mid_2_home">
                                            <p>{{$v['movie_year']}}</p>
                                            <div class="block-stars">
                                                <ul class="w3l-ratings">
                                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                                    {{--<li><a href="#"><i class="fa fa-star-half-o" aria-hidden="true"></i></a></li>--}}
                                                </ul>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="ribben">
                                        <p>新</p>
                                    </div>
                                </div>
                                @endforeach
                                <div class="clearfix"> </div>
                            </div>
                        </div>
                        {{--喜剧--}}
                        <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
                            @foreach($dyXi as $v)
                                <div class="col-md-2 w3l-movie-gride-agile">
                                    <a href="{{url('/index.php/playDetails?movie='.$v['movie_id'])}}" class="hvr-shutter-out-horizontal">
                                        <img src="{{$v['movie_img']}}" title="{{$v['movie_name']}}" class="img-responsive" alt=" "  style="width: 175px;height: 245px;" />
                                        <div class="w3l-action-icon">
                                            <i class="fa fa-play-circle" aria-hidden="true"></i>
                                        </div>
                                    </a>
                                    <div class="mid-1 agileits_w3layouts_mid_1_home">
                                        <div class="w3l-movie-text">
                                            <h6><a href="{{url('/index.php/playDetails?movie='.$v['movie_id'])}}">{{$v['movie_name']}}</a></h6>
                                        </div>
                                        <div class="mid-2 agile_mid_2_home">
                                            <p>{{$v['movie_year']}}</p>
                                            <div class="block-stars">
                                                <ul class="w3l-ratings">
                                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                                    {{--<li><a href="#"><i class="fa fa-star-half-o" aria-hidden="true"></i></a></li>--}}
                                                    {{--<li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>--}}
                                                    {{--<li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>--}}
                                                    {{--<li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>--}}
                                                </ul>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="ribben">
                                        <p>新</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{--动作--}}
                        <div role="tabpanel" class="tab-pane fade" id="rating" aria-labelledby="rating-tab">
                            @foreach($dyDong as $k=>$v)
                                <div class="col-md-2 w3l-movie-gride-agile">
                                    <a href="{{url('/index.php/playDetails?movie='.$v['movie_id'])}}" class="hvr-shutter-out-horizontal">
                                        <img src="{{$v['movie_img']}}" title="{{$v['movie_name']}}" class="img-responsive" alt=" "  style="width: 175px;height: 245px;" />
                                        <div class="w3l-action-icon">
                                            <i class="fa fa-play-circle" aria-hidden="true"></i>
                                        </div>
                                    </a>
                                    <div class="mid-1 agileits_w3layouts_mid_1_home">
                                        <div class="w3l-movie-text">
                                            <h6><a href="{{url('/index.php/playDetails?movie='.$v['movie_id'])}}">{{$v['movie_name']}}</a></h6>
                                        </div>
                                        <div class="mid-2 agile_mid_2_home">
                                            <p>{{$v['movie_year']}}</p>
                                            <div class="block-stars">
                                                <ul class="w3l-ratings">
                                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                                    {{--<li><a href="#"><i class="fa fa-star-half-o" aria-hidden="true"></i></a></li>--}}
                                                    {{--<li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>--}}
                                                </ul>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="ribben">
                                        <p>新</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- //一般的 -->
        {{--电视剧--}}
        <div class="general">
            <h4 class="latest-text w3_latest_text">
                <span style="color: #d6a7ff">电</span>
                <span style="color: #3dffc7">视</span>
                <span style="color: #7979ff">剧</span>
                <span style="color: #fd7cff">专</span>
                <span style="color: #ff7471">区</span>

            </h4>
            <div class="container">
                <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                    {{--分类--}}
                    <ul id="myTab" class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">全部</a>
                        </li>
                        <li role="presentation">
                            <a href="{{url('moreTeleplay')}}" >..........</a>
                        </li>
                    </ul>
                    {{--电视剧内容--}}
                    <div id="myTabContent" class="tab-content">
                        {{--全部--}}
                        <div role="tabpanel" class="tab-pane fade active in" id="home" aria-labelledby="home-tab">
                            <div class="w3_agile_featured_movies">
                                @foreach($dsjQuan as $v)
                                    <div class="col-md-2 w3l-movie-gride-agile">
                                        <a href="{{url('/index.php/playDetails?teleplay='.$v['teleplay_id'])}}" class="hvr-shutter-out-horizontal">
                                            <img src="{{$v['teleplay_img']}}" title="{{$v['teleplay_name']}}" class="img-responsive" alt=" " style="width: 175px;height: 245px;"/>
                                            <div class="w3l-action-icon">
                                                <i class="fa fa-play-circle" aria-hidden="true"></i>
                                            </div>
                                        </a>
                                        <div class="mid-1 agileits_w3layouts_mid_1_home">
                                            <div class="w3l-movie-text">
                                                <h6><a href="{{url('/index.php/playDetails?teleplay='.$v['teleplay_id'])}}">{{$v['teleplay_name']}}</a></h6>
                                            </div>
                                            <div class="mid-2 agile_mid_2_home">
                                                <p>{{$v['teleplay_year']}}</p>
                                                <div class="block-stars">
                                                    <ul class="w3l-ratings">
                                                        <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                                        {{--<li><a href="#"><i class="fa fa-star-half-o" aria-hidden="true"></i></a></li>--}}
                                                    </ul>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div class="ribben">
                                            <p>新</p>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="clearfix"> </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>






        {{----}}
        <!-- 弹出框-->
        <script src="/Home/js/jquery.magnific-popup.js" type="text/javascript"></script>
        <!--//弹出框结束 -->

        <div id="small-dialog" class="mfp-hide">
            <!---<iframe src="https://player.vimeo.com/video/164819130?title=0&byline=0"></iframe>--->
        </div>
        <div id="small-dialog1" class="mfp-hide">
            <!---<iframe src="https://player.vimeo.com/video/148284736"></iframe>--->
        </div>
        <div id="small-dialog2" class="mfp-hide">
            <!---<iframe src="https://player.vimeo.com/video/165197924?color=ffffff&title=0&byline=0&portrait=0"></iframe>--->
        </div>
        <script>
            $(document).ready(function() {
                $('.w3_play_icon,.w3_play_icon1,.w3_play_icon2').magnificPopup({
                    type: 'inline',
                    fixedContentPos: false,
                    fixedBgPos: true,
                    overflowY: 'auto',
                    closeBtnInside: true,
                    preloader: false,
                    midClick: true,
                    removalDelay: 300,
                    mainClass: 'my-mfp-zoom-in'
                });

            });
        </script>
        <!-- //最新电视连续剧 结束 -->
    </div>
@endsection
