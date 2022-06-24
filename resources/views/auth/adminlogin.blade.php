




<!DOCTYPE html>


<html lang="ar" dir="rtl">

<!-- begin::Head -->

<head>
    @php
    // For Get Setting item
        $setting = App\Setting::first();
    @endphp



    <!--end::Base Path -->
    <meta charset="utf-8" />
    <title>تسجيل الدخول</title>
    <meta name="description" content="Login page example">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--begin::Fonts -->

    <link href="{{ asset('dashboard/assets/css/demo1/pages/general/login/login-1.css')}}" rel="stylesheet" type="text/css" />


    <link href="{{ asset('dashboard/assets/css/demo6/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />

	@if (isset($setting))
	<link rel="shortcut icon" href="{{ asset ($setting->miniLogo)}}" />
    @endif

    <script src="https://kit.fontawesome.com/c888a3fd76.js" crossorigin="anonymous"></script>




</head>
<body
    class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

    <!-- begin:: Page -->
    <div class="kt-grid kt-grid--ver kt-grid--root">
        <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v1" id="kt_login">
            <div
                class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile">

                <!--begin::Aside-->
                <div class="kt-grid__item kt-grid__item--order-tablet-and-mobile-2 kt-grid kt-grid--hor kt-login__aside"
                    style="background-color: #b41d4f">
                    <div class="kt-grid__item">

                        @php
                            $setting =App\Setting::first();
                        @endphp

                        <a href="{{ route('index') }}" class="kt-login__logo">
                            <img src="{{asset('UI/front/img/logo_white.svg')}}" alt="">

                        </a>

                    </div>
                    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver">
                        <div class="kt-grid__item kt-grid__item--middle">
                            @if (isset($setting))

                            <h1 class="kt-login__title"> {{$setting->blog_name}}</h1>
                            @endif
                            <h4 class="kt-login__subtitle"></h4>
                        </div>
                    </div>


                </div>

                <!--begin::Aside-->

                <!--begin::Content-->
                <div
                    class="kt-grid__item kt-grid__item--fluid  kt-grid__item--order-tablet-and-mobile-1  kt-login__wrapper">

                    <!--begin::Head-->


                    <!--end::Head-->

                    <!--begin::Body-->
                    <div class="kt-login__body">
                            <!--begin::Signin-->
                            <div class="kt-login__form">
                                <div class="kt-login__title">
                                    <i class="fas fa-user-shield fa-5x text-primary"></i>

                                    <h3>تسجيل الدخول</h3>
                                </div>
                                @if ($errors->count() > 0)
                                    @foreach ($errors->all() as $error)

                                        <div class="alert alert-dismissible fade show" style="background-color:#e43b62;color:white" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <strong>تنبيه : </strong> {{ $error }}.
                                        </div>
                                    @endforeach

                                @endif
                                <!--begin::Form-->
                                <form id="form_login" class="kt-form" action="{{ route('loginAdmin') }}" method="POST" >
                                    @csrf
                                    <div class="form-group">
                                        <input class="form-control @error('email') is-invalid @enderror" type="text" placeholder="البريد الإلكتروني" name="email"
                                            autocomplete="off">
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="form-group">
                                        <input class="form-control @error('password') is-invalid @enderror" type="password" placeholder="كلمة المرور" name="password">
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <!--begin::Action-->
                                    <div class="kt-login__actions">
                                        <button type="submit"
                                            class="btn btn-primary btn-sm- btn-block">تسجيل الدخول</button>
                                    </div>
                                </form>



                            </div>



                    </div>

                </div>

            </div>
        </div>
    </div>




</body>

<!-- end::Body -->

</html>

