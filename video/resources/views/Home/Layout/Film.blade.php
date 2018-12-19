<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
        function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- //for-mobile-apps -->
    <link href="/Home/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link href="/Home/css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="/Home/css/contactstyle.css" type="text/css" media="all" />
    <link rel="stylesheet" href="/Home/css/faqstyle.css" type="text/css" media="all" />
    <link href="/Home/css/single.css" rel='stylesheet' type='text/css' />
    <link href="/Home/css/medile.css" rel='stylesheet' type='text/css' />
    <!-- banner-slider -->
    <link href="/Home/css/jquery.slidey.min.css" rel="stylesheet">
    <!-- //banner-slider -->
    <!-- pop-up -->
    <link href="/Home/css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
    <!-- //pop-up -->
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="/Home/css/font-awesome.min.css" />
    <!-- //font-awesome icons -->
    <!-- list-css -->
    <link rel="stylesheet" href="/Home/list-css/list.css" type="text/css" media="all" />
    <!-- //list-css -->

    <!-- news-css -->
    <link rel="stylesheet" href="/Home/news-css/news.css" type="text/css" media="all" />
    <!-- //news-css -->

    <!-- js -->
    <script type="text/javascript" src="/Home/js/jquery-2.1.4.min.js"></script>
    <!-- //js -->
    <!-- banner-bottom-plugin -->
    <link href="/Home/css/owl.carousel.css" rel="stylesheet" type="text/css" media="all">
    <script src="/Home/js/owl.carousel.js"></script>
    {{--视频--}}

    <!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->



    <script>
        $(document).ready(function() {
            $("#owl-demo").owlCarousel({

                autoPlay: 3000, //Set AutoPlay to 3 seconds

                items : 5,
                itemsDesktop : [640,4],
                itemsDesktopSmall : [414,3]

            });

        });
    </script>



    <!-- //banner-bottom-plugin -->
    <!---<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700italic,700,400italic,300italic,300' rel='stylesheet' type='text/css'>--->
    <!-- start-smoth-scrolling -->
    <script type="text/javascript" src="/Home/js/move-top.js"></script>
    <script type="text/javascript" src="/Home/js/easing.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event){
                event.preventDefault();
                $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
            });
        });
    </script>
    <!-- start-smoth-scrolling -->
</head>

<body>
<!-- 头部 -->
<div class="header">
    <div class="container">
        <div class="w3layouts_logo">
            <a href="{{url('/')}}">
                <h2>
                    <span style="color: #3dffc7">小</span>
                    <span style="color: #7979ff">白</span>
                    <span style="color: #fd7cff">影</span>
                    <span style="color: #ff7471">音</span>
                </h2>
            </a>
        </div>

        <div class="w3_search">
            <select name="" id="isso">
                <option value="1">电影</option>
                <option value="2">电视剧</option>
                {{--<option value="3">综艺</option>--}}
                <option value="3">动漫</option>
            </select>
            <form action="#" method="post">
                <input type="text" name="Search" placeholder="Search" required="">
                <input type="button" id="so" value="Go" data-toggle="modal">
            </form>
        </div>
        <script src="/layui/layui.all.js"></script>
        <script>
            $('#so').click(function(){
                var search = $('[name=Search]').val();
                var isso = $('#isso').val();
                if(search == ''){
                    layer.msg('搜索不能为空！', { anim: 1});
                    return false;
                }
                $.ajax({
                    url:'/index.php/fresh',
                    data:{search:search,isso:isso,'_token':'{{csrf_token()}}'},
                    type:'post',
                    dataType:'json',
                    success:function( json_info ){
                        if(json_info.status == 200){
                            window.location.href = json_info.url;
                        }else{
                            layer.msg(json_info.msg, { anim: 1});
                            return false;
                        }
                    }

                })
            });
        </script>

        <div class="w3l_sign_in_register">
            <ul>
                <li><a href="#" data-toggle="modal" data-target="#myModal">一键登录 GO</a></li>
            </ul>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
<!-- 头部结束 -->

<!--登录--注册-->
<div class="modal video-modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                登录 &  注册
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <section>
                <div class="modal-body">
                    <div class="w3_login_module">
                        <div class="module form-module">
                            <div class="toggle" >
                                <i class="fa fa-times fa-pencil"></i>
                                <div class="tooltip">点击我</div>
                            </div>
                            <div class="form"  name="Login">
                                <h3>登录到您的帐户</h3>
                                <form action="#" method="post">
                                    <input type="text" name="Username" placeholder="Username" required="">
                                    <input type="password" name="Password" placeholder="Password" required="">
                                    <input type="button" value="Login">
                                </form>
                            </div>
                            <div class="form"  name="chuang">
                                <h3>创建一个帐户</h3>
                                <form action="#" method="post">
                                    <input type="text" name="Username" placeholder="Username" required="">
                                    <input type="password" name="Password" placeholder="Password" required="">
                                    <input type="email" name="Email" placeholder="Email Address" required="">
                                    <input type="text" name="Phone" placeholder="Phone Number" required="">
                                    <input type="button" value="Register">
                                </form>
                            </div>
                            <div class="form" name="wang">
                                <h3>忘记密码</h3>
                                <form action="#" method="post">
                                    <input type="text" name="Username" placeholder="Username" required="">
                                    <input type="password" name="Password" placeholder="Password" required="">
                                    <input type="email" name="Email" placeholder="Email Address" required="">
                                    <input type="text" name="Phone" placeholder="Phone Number" required="">
                                    <input type="button" value="sd">
                                </form>
                            </div>
                            <div class="cta"><a href="#">难道你忘记密码了吗?</a></div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<script>
    $('.toggle').click(function(){
        $(this).children('i').toggleClass('fa-pencil');
        if($('[name=Login]').is(':visible')){　　//如果node是隐藏的则显示node元素，否则隐藏
            $('[name=chuang]').show(1000);
            $('[name=Login]').hide(1000);
            $('[name=wang]').hide(1000);
        }else{
            $('[name=Login]').show(1000);
            $('[name=chuang]').hide(1000);
            $('[name=wang]').hide(1000);
        }
    });
    $('.cta').click(function(){
        if($('[name=Login]').is(':visible')){
            $('[name=wang]').show(1000);
            $('[name=Login]').hide(1000);
            $('[name=chuang]').hide(1000);
        }else{
            $('[name=Login]').show(1000);
            $('[name=wang]').hide(1000);
            $('[name=chuang]').hide(1000);
        }
    })
</script>

{{-- 中间 --}}
@yield('centent')


<!-- 页脚 -->
<div class="footer">
    <div class="container">

        <div class="col-md-5 w3ls_footer_grid1_left">
            <p>Copyright &copy; 2016.Company name All rights reserved.</p> <p>-----视频均来源于Web，如有侵权请<a target="_blank" href="tencent://Message/?Uin=2784279750websiteName=www.qq.com&Menu=yes">联系我</a></p>
        </div>
        <div class="col-md-7 w3ls_footer_grid1_right">
            <ul>
                <li>
                    <a href="{{url('moreMovie')}}">电影</a>
                </li>
                <li>
                    <a href="{{url('moreTeleplay')}}">电视剧</a>
                </li>
                <li>
                    <a href="horror.html">综艺</a>
                </li>
                <li>
                    <a href="genres.html">动漫</a>
                </li>
                {{--<li>--}}
                    {{--<a href="comedy.html">喜剧</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a href="icons.html">图标</a>--}}
                {{--</li>--}}
                <li>
                    <a href="tencent://Message/?Uin=2784279750websiteName=www.qq.com&Menu=yes">联系我</a>
                </li>
            </ul>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
<!-- //页脚结束 -->

<!-- 引导核心JavaScript-->
<script src="/Home/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        $(".dropdown").hover(
            function() {
                $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
                $(this).toggleClass('open');
            },
            function() {
                $('.dropdown-menu', this).stop( true, true ).slideUp("fast");
                $(this).toggleClass('open');
            }
        );
    });
</script>
<!-- //引导核心JavaScript 结束-->

<!-- 这里结束滚动图标-->
<script type="text/javascript">
    $(document).ready(function() {
        /*
            var defaults = {
            containerID: 'toTop', // fading element id
            containerHoverID: 'toTopHover', // fading element hover id
            scrollSpeed: 1200,
            easingType: 'linear'
            };
        */

        $().UItoTop({ easingType: 'easeOutQuart' });

    });
</script>
<!-- /这里结束滚动图标 结束 -->

</body>
</html>