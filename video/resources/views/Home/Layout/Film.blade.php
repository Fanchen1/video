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
    <!-- js -->
    <script type="text/javascript" src="/Home/js/jquery-2.1.4.min.js"></script>
    <!-- //js -->
    <!-- banner-bottom-plugin -->
    <link href="/Home/css/owl.carousel.css" rel="stylesheet" type="text/css" media="all">
    <script src="/Home/js/owl.carousel.js"></script>
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
            <a href="index.html"><h1>One<span>Movies</span></h1></a>
        </div>

        <div class="w3_search">
            <form action="#" method="post">
                <input type="text" name="Search" placeholder="Search" required="">
                <input type="submit" value="Go">
            </form>
        </div>
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
                            <div class="toggle"><i class="fa fa-times fa-pencil"></i>
                                <div class="tooltip">点击我</div>
                            </div>
                            <div class="form">
                                <h3>登录到您的帐户</h3>
                                <form action="#" method="post">
                                    <input type="text" name="Username" placeholder="Username" required="">
                                    <input type="password" name="Password" placeholder="Password" required="">
                                    <input type="submit" value="Login">
                                </form>
                            </div>
                            <div class="form">
                                <h3>创建一个帐户</h3>
                                <form action="#" method="post">
                                    <input type="text" name="Username" placeholder="Username" required="">
                                    <input type="password" name="Password" placeholder="Password" required="">
                                    <input type="email" name="Email" placeholder="Email Address" required="">
                                    <input type="text" name="Phone" placeholder="Phone Number" required="">
                                    <input type="submit" value="Register">
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
        // Switches the Icon
        $(this).children('i').toggleClass('fa-pencil');
        // Switches the forms
        $('.form').animate({
            height: "toggle",
            'padding-top': 'toggle',
            'padding-bottom': 'toggle',
            opacity: "toggle"
        }, "slow");
    });
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
                    <a href="genres.html">电影</a>
                </li>
                <li>
                    <a href="faq.html">常问问题</a>
                </li>
                <li>
                    <a href="horror.html">行动</a>
                </li>
                <li>
                    <a href="genres.html">冒险</a>
                </li>
                <li>
                    <a href="comedy.html">喜剧</a>
                </li>
                <li>
                    <a href="icons.html">图标</a>
                </li>
                <li>
                    <a href="contact.html">联系我们</a>
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