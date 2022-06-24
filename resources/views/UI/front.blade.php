<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="shortcut icon" href="{{ asset('UI/favicon.ico')}}" type="image/x-icon"/>
    <link rel="icon" href="{{ asset('UI/favicon.ico')}}" type="image/x-icon"/>
    <link rel="apple-touch-icon" href="{{ asset('UI/favicon.ico')}}"/>
    <meta name="robots" content="index,follow">
    <meta name="robots" content="ALL">
    <meta name="rating" content="General">
    <meta name="revisit-after" content="1 days">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">


    <meta name="google-site-verification" content="cY-CJW0wLSzycNe3iidBz_TbTViLv4VO85YP8N7vmSM" />
    <title>{{ t("Thailandy") }} @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('UI/favicon.ico')}}">
    <link  rel="stylesheet" type="text/css"  href="{{ asset('UI/css/plugin.css')}}">
    <link  rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link  rel="stylesheet" type="text/css" href="{{ asset('UI/css/style.css')}}?v=14">
    @if (app()->getLocale() == "en")
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600;700;800;900&display=swap">
        <link  rel="stylesheet" type="text/css" href="{{ asset('UI/css/ltr.css')}}">
    @else
        <link  rel="stylesheet" type="text/css" href="{{ asset('UI/css/rtl.css')}}">
    @endif

    @yield('style')

    </head>

<body>
    <div class="main">
    <header class="header-area header-position">
        <nav class="navbar navbar-expand-lg  ">
            <div class="container position-relative">
                <a class="navbar-brand" href="{{ route('index') }}">
                    <img src="{{ asset('UI/img/Thailandy.WebP') }}" alt="{{ t('thailand restaurant') }}">
                </a>
                <button class="navbar-toggler p-0" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-inner">
                    <button class="navbar-toggler d-lg-none">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="navbar-nav ml-auto align-items-center">
                            @yield('nav')

                    </div>
                </div>
            </div>
        </nav>


    </header>

    @yield('content')


    <div class="footer-area">
        <div class="scroll-top">
            <i class="fa fa-arrow-up"></i>
        </div>
        <div class="footer-widgets">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="footer-widget">
                            <h2>{{__('front.footer-address')}}</h2>
                            <p>
                                <a href="https://goo.gl/maps/STyLbjhrhwMhMLo79" target="_blank">
                                   Building GB-7465 <br>Thuwal Saudi Arabia
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="footer-widget">
                            <h2>{{__('front.footer-follow')}}</h2>
                            <ul class="social-list">
                                <li><a href="https://www.facebook.com/thailandy" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="https://twitter.com/thailandy" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="https://instagram.com/thailandy" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="" target="https://wa.me/+972592633100"><i class="fab fa-whatsapp"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="footer-widget">
                            <h2>{{__('front.footer-contact')}}</h2>
                            <p>
                                <a href="mailto:info@thailandy.com" target="_blank">Info@thailandy.com</a>
                                <br>
                                <a href="tel:+966128024031">+97259 263 3100</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                <p>{{__('front.copyright')}}</p>
            </div>
        </div>
    </div>

    <div class="change-language">
        @if (app()->getLocale() == "en")
            <a href="{{ LaravelLocalization::getLocalizedURL('ar') }}">
                <img src="{{ asset('UI/img/ar.svg')}}" alt="arabic language">
            </a>
        @else
            <a href="{{ LaravelLocalization::getLocalizedURL('en') }}">
                <img src="{{ asset('UI/img/en.svg')}}" alt="English language">
            </a>
        @endif

    </div>
 </div>
    <script src="{{ asset('UI/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('UI/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('UI/js/owl.carousel.js') }}"></script>
    <script src="https://afarkas.github.io/lazysizes/lazysizes.min.js"></script>
    <script src="{{ asset('UI/js/main.js') }}?v=20"></script>

    @yield('footer')

</body>

</html>

