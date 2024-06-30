<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Document Title -->
    <title>Beshkanweb</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="favicon.png">
    <!-- CSS Files -->
    <!--==== Google Fonts ====-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700" rel="stylesheet">
    <!--==== Bootstrap css file ====-->
    <link rel="stylesheet" href="{{asset('assets/hamed/css/bootstrap.min.css')}}">
    <!--==== Font-Awesome css file ====-->
    <link rel="stylesheet" href="{{asset('assets/hamed/css/font-awesome.min.css')}}">
    <!--==== Style css file ====-->
    <link rel="stylesheet" href="{{asset('assets/hamed/css/style.css')}}">
    <!--==== Responsive css file ====-->
    <link rel="stylesheet" href="{{asset('assets/hamed/css/responsive.css')}}">


</head>

<body style="font-family: Tahoma">
    <!-- Preloader -->
    <div class="preLoader">
        <div class="preload-inner">
            <div class="sk-cube-grid">
                <div class="sk-cube sk-cube1"></div>
                <div class="sk-cube sk-cube2"></div>
                <div class="sk-cube sk-cube3"></div>
                <div class="sk-cube sk-cube4"></div>
                <div class="sk-cube sk-cube5"></div>
                <div class="sk-cube sk-cube6"></div>
                <div class="sk-cube sk-cube7"></div>
                <div class="sk-cube sk-cube8"></div>
                <div class="sk-cube sk-cube9"></div>
            </div>
        </div>
    </div>
    <!-- End Of Preloader -->

    <!-- Main header -->
    <header class="header">
        <!-- Start Header Navbar-->
        <div class="main-header inner-header header-2">
            <div class="main-menu-wrap">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-3 col-lg-3 col-md-4 col-6">
                            <!-- Logo -->
                            <div class="logo">
                                <a href="#">
                                    <img src="{{asset('assets/hamed/img/logo.png')}}" data-rjs="2" alt="jironis">

                                </a>
                            </div>
                            <!-- End of Logo -->
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-4 col-6 menu-button">
                            <div class="menu--inner-area clearfix">
                                <div class="menu-wraper">
                                    <nav>
                                        <!-- Header-menu -->
                                        <div class="header-menu dosis">
                                            <ul>
                                                <li><a href="{{url('login')}}">خرید آنلاین</a></li>
                                                <li><a href="{{url('register')}}">اکانت رایگان</a></li>
                                                <li><a href="{{url('tutorial')}}">آموزش</a></li>
                                                <li><a href="{{url('/')}}">صفحه اصلی</a></li>
                                            </ul>
                                        </div>
                                        <!-- End of Header-menu -->
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-5 d-md-block d-none">
                            <div class="urgent-call text-right">
                                <a href="{{url('login')}}" class="btn">ورود</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header Navbar-->
    </header>
    <!-- End of Main header -->

    <!-- home banner area -->
    <div class="banner-area-inner">
        <div class="banner-inner-area banner-area1 banner2">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <!-- banner text -->
                        <div class="banner-text-inner">
                            <h1>ارائه اکانت تست رایگان</h1>
                            <p>قبل از خرید به صورت آنلاین یک سرویس آزمایشی رایگان دریافت کنید.</p>
                            <a href="{{url('register')}}" class="btn">اکانت رایگان</a>
                            <a href="{{url('register')}}" class="btn">خرید آنلاین</a>
                        </div>
                        <!-- banner text -->
                    </div>
                    <div class="col-lg-5 offset-lg-1 col-md-4 offse-xl-2">
                        <div class="banner-shape-wrap">
                            <div class="banner-shape-inner">
                                <img src="{{asset('assets/hamed/img/banner/shaps1.png')}}" alt="" class='shape shape1 rotate3d'>
                                <img src="{{asset('assets/hamed/img/banner/shaps2.png')}}" alt="" class='shape shape2 rotate2d'>
                                <img src="{{asset('assets/hamed/img/banner/shaps3.png')}}" alt="" class='shape shape3 rotate-2d'>
                                <img src="{{asset('assets/hamed/img/banner/shaps4.png')}}" alt="" class='shape shape4 rotate3d'>
                                <img src="{{asset('assets/hamed/img/banner/shaps5.png')}}" alt="" class='shape shape5 rotate2d'>
                                <img src="{{asset('assets/hamed/img/banner/shaps6.png')}}" alt="" class='shape shape6 rotate-2d'>
                                <img src="{{asset('assets/hamed/img/banner/shaps7.png')}}" alt="" class='shape shape7 rotate3d'>
                            </div>
                        </div>
                        <!-- banner image-->
                        <div class="banner-image">
                            <img src="{{asset('assets/hamed/img/banner/mockup.png')}}" alt="">
                        </div>
                        <!--End of banner image-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of home banner area -->

    <!-- feature area -->
    <section class="pb-110" id='features'>
        <div class="container">
            <div class="row justify-content-center">
                <div style="text-align: right;direction: rtl" class="col-md-12 col-lg-8">
                    <!-- section title -->
                    <div>
                        <h2>فروش ویژه با 50 درصد تخفیف</h2>
                        <p>تخفیف ویژه فروش برای مدت محدود خواهد بود و کلیه سرویسها  به صورت نیم بها  به فروش می رسد.</p>
                    </div>
                    <!-- End of section title -->
                </div>
            </div>

            <!--/.row-->
        </div>
        <!--/.container-->
    </section><!-- End of feature area -->
                        <!-- nav tab content -->
                        <div class="tab-content price-content">
                            <div class="tab-pane fade active show" id="month" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6 col-lg-4">
                                        <!--Single price plan -->
                                        <div class="single-price-plan active text-center">
                                            <div class="single-price-top">
                                                <h3>سرویس نا محدود</h3>
                                                <span>قیمت: 100 هزار تومان</span>
                                                <span>تخفیف ویژه: 50 درصد</span>
                                                <span>مبلغ پرداختی: 50 هزار تومان</span>
                                            </div>
                                            <div class="single-price-body">
                                                <div class="price-list">
                                                    <ul>
                                                        <li>
                                                            <span><i class="fa fa-check" aria-hidden="true"></i></span>
                                                            ترافیک: نامحدود
                                                        </li>
                                                        <li>
                                                            <span><i class="fa fa-check" aria-hidden="true"></i></span>
                                                            اعتبار: 30 روز
                                                        </li>
                                                        <li>
                                                            <span><i class="fa fa-check" aria-hidden="true"></i></span>
                                                            تحویل آنی کانفیگ
                                                        </li>
                                                        <li>
                                                            <span><i class="fa fa-check" aria-hidden="true"></i></span>
                                                            6 کاربره
                                                        </li>
                                                        <li>
                                                            <span><i class="fa fa-check" aria-hidden="true"></i></span>
                                                            پشتیبانی آنلاین 24 ساعته
                                                        </li>
                                                    </ul>
                                                </div>
                                                <a href="{{url('register')}}" class="btn">سفارش</a>
                                            </div>
                                        </div>
                                        <!--end of Single price plan -->
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <!--Single price plan -->
                                        <div class="single-price-plan text-center">
                                            <div class="single-price-top">
                                                <h4>سرویس حجمی</h4>
                                                <span>قیمت: 60 هزار تومان</span>
                                                 <span>تخفیف ویژه: 50 درصد</span>
                                                <span>مبلغ پرداختی: 30 هزار تومان</span>
                                            </div>
                                            <div class="single-price-body">
                                                <div class="price-list">
                                                    <ul>
                                                        <li>
                                                            <span><i class="fa fa-check" aria-hidden="true"></i></span>
                                                            ترافیک: 40 گیگابایت
                                                        </li>
                                                        <li>
                                                            <span><i class="fa fa-check" aria-hidden="true"></i></span>
                                                            اعتبار: 30 روز
                                                        </li>
                                                        <li>
                                                            <span><i class="fa fa-check" aria-hidden="true"></i></span>
                                                            تحویل آنی کانفیگ
                                                        </li>
                                                        <li>
                                                            <span><i class="fa fa-check" aria-hidden="true"></i></span>
                                                            تعداد کاربر: نا محدود
                                                        </li>
                                                        <li>
                                                            <span><i class="fa fa-check" aria-hidden="true"></i></span>
                                                            پشتیبانی آنلاین 24 ساعته
                                                        </li>
                                                    </ul>
                                                </div>
                                                <a href="#" class="btn">به زودی</a>
                                            </div>
                                        </div>
                                        <!--end of Single price plan -->
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <!--Single price plan -->
                                        <div class="single-price-plan text-center">
                                            <div class="single-price-top">
                                                <h3>سرویس رایگان</h3>
                                                <span>قیمت: رایگان</span>
                                            </div>
                                            <div class="single-price-body">
                                                <div class="price-list">
                                                    <ul>
                                                        <li>
                                                            <span><i style="direction: rtl" class="fa fa-check" aria-hidden="true"></i></span>
                                                            ترافیک: نامحدود
                                                        </li>
                                                        <li>
                                                            <span><i class="fa fa-check" aria-hidden="true"></i></span>
                                                            اعتبار: 3 روز
                                                        </li>
                                                        <li>
                                                            <span><i class="fa fa-check" aria-hidden="true"></i></span>
                                                            دریافت آنی کانفیگ
                                                        </li>
                                                        <li>
                                                            <span><i class="fa fa-check" aria-hidden="true"></i></span>
3 کاربره                                                        </li>
                                                        <li>
                                                            <span><i class="fa fa-times" aria-hidden="true"></i></span>
                                                            پشتیبانی 24 ساعته
                                                        </li>
                                                    </ul>
                                                </div>
                                                <a href="{{url('register')}}" class="btn">دریافت رایگان</a>
                                            </div>
                                        </div>
                                        <!--end of Single price plan -->
                                    </div>
                                </div>
                            </div>

                        <!-- End of nav tab content -->


    <footer class="footer">
        <div class="footerbg">
            <img src="{{asset('assets/hamed/img/footer-bg.png')}}" class='svg' alt="">
        </div>
        <div class="footer-top pt-120 pb-110">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <!-- footer widget -->
                        <div class="footer-widget">
                            <div class="footer-logo">
                                <a href="#"><img src="{{asset('assets/hamed/img/logo.png')}}" alt=""></a>
                            </div>
                        </div>
                        <!--End of footer widget -->
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="footer-widget">


                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="footer-widget">

                        </div>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </footer>

    <!-- back to top -->
    <div class="back-to-top">
        <a href="#"><i class="fa fa-chevron-up"></i></a>
    </div>
    <!-- back to top -->


    <!-- JS Files -->
    <!-- ==== JQuery 3.3.1 js file==== -->
    <script src="{{asset('assets/hamed/js/jquery-3.3.1.min.js')}}"></script>

    <!-- ==== Bootstrap js file==== -->
    <script src="{{asset('assets/hamed/js/bootstrap.bundle.min.js')}}"></script>

    <!-- ==== JQuery Waypoint js file==== -->
    <script src="{{asset('assets/hamed/plugins/waypoints/jquery.waypoints.min.js')}}"></script>

    <!-- ==== Parsley js file==== -->
    <script src="{{asset('assets/hamed/plugins/parsley/parsley.min.js')}}"></script>

    <!-- ==== parallax js==== -->
    <script src="{{asset('assets/hamed/plugins/parallax/parallax.js')}}"></script>

    <!-- ==== Owl Carousel js file==== -->
    <script src="{{asset('assets/hamed/plugins/owl-carousel/owl.carousel.min.js')}}"></script>

    <!-- ==== Menu  js file==== -->
    <script src="{{asset('assets/hamed/js/menu.min.js')}}"></script>

    <!-- ===video popup=== -->
    <script src="{{asset('assets/hamed/plugins/Magnific-Popup/jquery.magnific-popup.min.js')}}"></script>

    <!-- ====Counter js file=== -->
    <script src="{{asset('assets/hamed/plugins/waypoints/jquery.counterup.min.js')}}"></script>

    <!-- ==== Script js file==== -->
    <script src="{{asset('assets/hamed/js/scripts.js')}}"></script>

    <!-- ==== Custom js file==== -->
    <script src="{{asset('assets/hamed/js/custom.js')}}"></script>
    <script src="{{asset('assets/js/crisp.js')}}"></script>
    </body>

    </html>
