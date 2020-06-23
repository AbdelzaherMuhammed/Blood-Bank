<!DOCTYPE html>
<html lang="en">
@inject('client' ,'App\Models\Client' )
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--bootstrap file css-->
    <link rel="stylesheet" href="{{asset('front/css/bootstrap.min.css')}}">
    <!--Plugins file css-->
    <link rel="stylesheet" href="{{asset('front/css/slick.css')}}">
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="{{asset('front/css/slick-theme.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/jquery-nao-calendar.cs')}}s">
    <!--google-font-->
    <link href="https://fonts.googleapis.com/css?family=Cairo:400,600,700&display=swap" rel="stylesheet">
    {{--    select2 package--}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
    <!--main file css-->
    <link rel="stylesheet" href="{{asset('front/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/style.css')}}">
    <title>بنك الدم</title>
</head>

<body>
<!--Loading Page-->
<div class="loading-page">
    <div class="spinner">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
    </div>
</div>
<!--header section-->
<section class="header">
    <!--top-bar-->
    <div class="top-bar py-2">
        <div class="container">
            <!--row of top-bar-->
            <div class="d-flex justify-content-between">
                <div>
                    <a href="{{url('/')}}" class="ar px-1">عربى</a>
                    <a href="" class="en px-1">EN</a>
                </div>
                <div>
                    <ul class="list-unstyled">
                        <li class="d-inline-block mx-2"><a class="facebook" href="{{$settings->fb_link}}"
                                                           target="_blank"><i
                                    class="fab fa-facebook-f"></i></a></li>
                        <li class="d-inline-block mx-2"><a class="insta" href="{{$settings->inst_link}}"
                                                           target="_blank"><i
                                    class="fab fa-instagram"></i></a></li>
                        <li class="d-inline-block mx-2"><a class="twitter" href="{{$settings->tw_link}}"
                                                           target="_blank"><i
                                    class="fab fa-twitter"></i></a></li>
                        <li class="d-inline-block mx-2"><a class="whatsapp" href="{{$settings->whatsapp}}"><i
                                    class="fab fa-whatsapp"></i></a></li>
                    </ul>
                </div>
                @if(auth()->guard('client-web')->check())
                    <div class="connect">
                        <div class="dropdown">
                            <a class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                <span> مرحبا بك </span> &nbsp;{{auth()->guard('client-web')->user()->name}}
                            </a>
                            <div class="dropdown-menu text-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{url('/')}}"> <i
                                        class="fas fa-home ml-2"></i>الرئيسيه</a>

                                <a class="dropdown-item"
                                   href="{{url(route('client-profile' , auth()->guard('client-web')->user()->id))}}">
                                    <i class="fas fa-user-alt ml-2"></i>معلوماتى</a>
                                <a class="dropdown-item" href="{{route('post-favourite')}}"> <i class="far fa-heart ml-2"></i>المفضلة</a>
                                <a class="dropdown-item" href="{{route('contact')}}"> <i class="fas fa-phone ml-2"></i>تواصل
                                    معنا</a>
                                <a class="dropdown-item" href="{{route('client-logout')}}"> <i
                                        class="fas fa-sign-out-alt ml-2"></i>خروج</a>
                            </div>
                        </div>
                    </div>


                @endif
            </div>

            <!--End row-->
        </div>
        <!--End container-->
    </div>
    <!--End top-bar-->
    <!--navbar-->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('front/imgs/logo.png')}}" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{url('/')}}">الرئيسيه <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('about')}}">عن بنك الدم</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('post')}}">المقالات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('donation')}}">طلبات التبرع</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('about')}}">من نحن</a>
                    </li>
                    <li class="nav-item cont">
                        <a class="nav-link" href="{{route('contact')}}">اتصل بنا</a>
                    </li>

                    <li class="nav-item cont">
                        <a class="nav-link" href="{{route('home')}}">اداره</a>
                    </li>
                    @if(!auth()->guard('client-web')->check())
                        <li style="float: left" class="mr-lg-auto"><a class="signin"
                                                                      href="{{route('client-register')}}">انشاء حساب
                                جديد</a>
                        </li>
                        <li style="float: left" class="pr-3"><a class="btn bg"
                                                                href="{{route('client-login')}}">الدخول</a></li>
                    @endif
                </ul>
            </div>
        </div>
        <!--End container-->
    </nav>
    <!--End Nav-->
</section>

<!--Start content -->
@yield('content')
{{-- End content --}}
<!--Footer-->
<footer>
    <div class="main-footer py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4  offset-1">
                    <img src="{{asset('front/imgs/logo.png')}}" alt="">
                    <h5 class="my-3">بنك الدم</h5>
                    <p class="pl-4"> {{$settings->long_desc}}
                    </p>
                </div>
                <div class="col-md-3">
                    <h6 class="">الرئيسية</h6>
                    <ul class="list-unstyled">
                        <li class="py-2"><a href="{{route('about')}}">عن بنك الدم</a></li>
                        <li class="py-2"><a href="">المقالات</a></li>
                        <li class="py-2"><a href="donation.html">عن التبرع</a></li>
                        <li class="py-2"><a href="{{route('about')}}">من نحن</a></li>
                        <li class="py-2"><a href="contact.html">اتصل بنا</a></li>
                    </ul>
                </div>
                <div class="col-md-4 available">
                    <h6 class="mb-5">متوفر على</h6>
                    <a href="{{$settings->google_play_link}}" target="_blank" class="my-3"><img
                            src="{{asset('front/imgs/google1.png')}}" alt=""></a>
                    <a href="{{$settings->app_store_link}}" target="_blank" class="my-3"><img
                            src="{{asset('front/imgs/ios1.png')}}" alt=""></a>
                </div>
            </div>
        </div>
        <!--End container-->
    </div>
    <!--End main-footer-->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <ul class="list-unstyled">
                        <li class="d-inline-block mx-2"><a class="facebook" href="{{$settings->fb_link}}"><i
                                    class="fab fa-facebook-f"></i></a></li>
                        <li class="d-inline-block mx-2"><a class="insta" href="{{$settings->inst_link}}"><i
                                    class="fab fa-instagram"></i></a></li>
                        <li class="d-inline-block mx-2"><a class="twitter" href="{{$settings->tw_link}}"><i
                                    class="fab fa-twitter"></i></a></li>
                        <li class="d-inline-block mx-2"><a class="whatsapp" href="{{$settings->whatsapp}}"><i
                                    class="fab fa-whatsapp"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <p class="text-center">جميع الحقوق محفوظه لـ <span>بنك الدم</span> &copy; 2020</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--End Footer-->
<!--scrollUp-->
<div class="scrollUp">
    <i class="fas fa-chevron-up"></i>
</div>
<!--jquery/bootstrap/main file js-->

<script src="{{asset('front/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('front/js/slick.min.js')}}"></script>
<script src="{{asset('front/js/jquery-nao-calendar.js')}}"></script>
<script src="{{asset('front/js/popper.min.js')}}"></script>
<script src="{{asset('front/js/bootstrap.min.js')}}"></script>
<script src="{{asset('front/js/main.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
@stack('scripts')
@stack('select2')
</body>


</html>
