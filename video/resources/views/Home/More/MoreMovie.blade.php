@extends('Home/Layout.Film')
@section('title', '，列表')
@section('centent')
    <div class="w3l-medile-movies-grids">
        @if($status == 1){{--电影--}}<br>
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
                                    <li ><a href="{{url('/')}}">首页</a></li>
                                    <li class="active"><a href="{{url('moreMovie')}}">电影</a></li>
                                    <li><a href="{{url('moreTeleplay')}}">电视剧</a></li>
                                    <li><a href="{{url('moreComic')}}">动漫</a></li>
                                    {{--<li><a href="short-codes.html">综艺</a></li>--}}
                                </ul>
                            </nav>
                        </div>
                    </nav>
                </div>
            </div>
                <br><br>
            <div class="movie-browse-agile">
                <div class="browse-agile-w3ls general-w3ls">
                    <div class="tittle-head">
                        <h4 class="latest-text">
                            <span style="color: #8bff82">影</span>
                            <span style="color: #77fff3">音</span>
                            <span style="color: #7f82ff">列</span>
                            <span style="color: #ff6ef7">表</span>
                        </h4>
                        <div class="container">
                            <div class="agileits-single-top">
                                <ol class="breadcrumb">
                                    <li><a href="{{url('/')}}">首页</a></li>
                                    <li class="active">影音列表</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <!-- /latest-movies1 -->
                        <div class="browse-inner-come-agile-w3">
                            @foreach($data as $v)
                                <div class="col-md-2 w3l-movie-gride-agile">
                                    <a href="{{url('/index.php/playDetails?movie='.$v->movie_id)}}" class="hvr-shutter-out-horizontal">
                                        <img src="{{$v->movie_img}}" title="{{$v->movie_name}}" alt=" " style="width: 175px;height: 245px;" />
                                        <div class="w3l-action-icon">
                                            <i class="fa fa-play-circle" aria-hidden="true"></i>
                                        </div>
                                    </a>
                                    <div class="mid-1">
                                        <div class="w3l-movie-text">
                                            <h6><a href="{{url('/index.php/playDetails?movie='.$v->movie_id)}}">{{$v->movie_name}}</a></h6>
                                        </div>
                                        <div class="mid-2">
                                            <p>{{$v->movie_year}}</p>
                                            <div class="block-stars">
                                                <ul class="w3l-ratings">
                                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>

                                                </ul>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>

                                    </div>
                                    <div class="ribben two">
                                        <p>推荐</p>
                                    </div>
                                </div>
                            @endforeach
                            <div class="clearfix"> </div>
                        </div>
                    </div>
                </div>

                <div class="blog-pagenat-wthree">
                    {{$data->links()}}
                </div>
            </div>
        @elseif($status == 2){{--电视剧--}}
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
                                        <li ><a href="{{url('/')}}">首页</a></li>

                                        <li ><a href="{{url('moreMovie')}}">电影</a></li>
                                        <li class="active"><a href="{{url('moreTeleplay')}}">电视剧</a></li>
                                        <li><a href="{{url('moreComic')}}">动漫</a></li>
                                        {{--<li><a href="short-codes.html">综艺</a></li>--}}

                                    </ul>
                                </nav>
                            </div>
                        </nav>
                    </div>
                </div>
            <div class="movie-browse-agile">
            <div class="browse-agile-w3ls general-w3ls">
                <div class="tittle-head">
                    <h4 class="latest-text">
                        <span style="color: #8bff82">影</span>
                        <span style="color: #77fff3">音</span>
                        <span style="color: #7f82ff">列</span>
                        <span style="color: #ff6ef7">表</span>
                    </h4>
                    <div class="container">
                        <div class="agileits-single-top">
                            <ol class="breadcrumb">
                                <li><a href="{{url('/')}}">首页</a></li>
                                <li class="active">影音列表</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="browse-inner-come-agile-w3">
                        @foreach($data as $v)
                            <div class="col-md-2 w3l-movie-gride-agile">
                                <a href="{{url('/index.php/playDetails?teleplay='.$v->teleplay_id)}}" class="hvr-shutter-out-horizontal">
                                    <img src="{{$v->teleplay_img}}" title="{{$v->teleplay_name}}" alt=" " style="width: 175px;height: 245px;" />
                                    <div class="w3l-action-icon">
                                        <i class="fa fa-play-circle" aria-hidden="true"></i>
                                    </div>
                                </a>
                                <div class="mid-1">
                                    <div class="w3l-movie-text">
                                        <h6><a href="{{url('/index.php/playDetails?teleplay='.$v->teleplay_id)}}">{{$v->teleplay_name}}</a></h6>
                                    </div>
                                    <div class="mid-2">
                                        <p>{{$v->teleplay_year}}</p>
                                        <div class="block-stars">
                                            <ul class="w3l-ratings">
                                                <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                                <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                                <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                                <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                                <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>

                                            </ul>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                </div>
                                <div class="ribben two">
                                    <p>推荐</p>
                                </div>
                            </div>
                        @endforeach
                        <div class="clearfix"> </div>
                    </div>
                </div>
            </div>

            <div class="blog-pagenat-wthree">
                {{$data->links()}}
            </div>
        </div>
        @elseif($status == 3){{--动漫--}}
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
                                    <li ><a href="{{url('/')}}">首页</a></li>

                                    <li ><a href="{{url('moreMovie')}}">电影</a></li>
                                    <li ><a href="{{url('moreTeleplay')}}">电视剧</a></li>
                                    <li class="active"><a href="{{url('moreComic')}}">动漫</a></li>
                                    {{--<li><a href="short-codes.html">综艺</a></li>--}}

                                </ul>
                            </nav>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="movie-browse-agile">
                <div class="browse-agile-w3ls general-w3ls">
                    <div class="tittle-head">
                        <h4 class="latest-text">
                            <span style="color: #8bff82">影</span>
                            <span style="color: #77fff3">音</span>
                            <span style="color: #7f82ff">列</span>
                            <span style="color: #ff6ef7">表</span>
                        </h4>
                        <div class="container">
                            <div class="agileits-single-top">
                                <ol class="breadcrumb">
                                    <li><a href="{{url('/')}}">首页</a></li>
                                    <li class="active">影音列表</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="browse-inner-come-agile-w3">
                            @foreach($data as $v)
                                <div class="col-md-2 w3l-movie-gride-agile">
                                    <a href="{{url('/index.php/playDetails?comic='.$v->comic_id)}}" class="hvr-shutter-out-horizontal">
                                        <img src="{{$v->comic_img}}" title="{{$v->comic_name}}" alt=" " style="width: 175px;height: 245px;" />
                                        <div class="w3l-action-icon">
                                            <i class="fa fa-play-circle" aria-hidden="true"></i>
                                        </div>
                                    </a>
                                    <div class="mid-1">
                                        <div class="w3l-movie-text">
                                            <h6><a href="{{url('/index.php/playDetails?comic='.$v->comic_id)}}">{{$v->comic_name}}</a></h6>
                                        </div>
                                        <div class="mid-2">
                                            <p>{{$v->comic_year}}</p>
                                            <div class="block-stars">
                                                <ul class="w3l-ratings">
                                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>

                                                </ul>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>

                                    </div>
                                    <div class="ribben two">
                                        <p>推荐</p>
                                    </div>
                                </div>
                            @endforeach
                            <div class="clearfix"> </div>
                        </div>
                    </div>
                </div>

                <div class="blog-pagenat-wthree">
                    {{$data->links()}}
                </div>
            </div>
        @endif





        {{--<div class="review-slider">--}}
            {{--<h4 class="latest-text">Movie Reviews</h4>--}}
            {{--<div class="container">--}}
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
                {{--<!--body wrapper end-->--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>
@endsection