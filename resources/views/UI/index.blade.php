@extends('UI.front')



@section('nav')
    @include('UI.nav_index')
@endsection


@section('content')
    <div class="slider-area block" id="home">
            <div class="bg-img" style="background-image:url({{ asset('UI/img/header.WebP')}});">
                <div class="overlay">
                    <div class="container">
                        <div class="content-slider-area slider-height d-flex align-items-center text-white">
                            <div class="row justify-content-center text-center">
                                <div class="col-lg-10 col-md-10 col-12">
                                    <h2>{{__('front.header-title')}}</h2>
                                    <h1>{{__('front.header-subtitle')}}</h1>
                                    <div class="link-menu"><a href="{{ route('menu') }}">{{__('front.header-link')}}</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <div class="about-area block" id="about">
        <div class="container">
            <div class="bg-about">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="content-about">
                            <h2>{{__('front.about-title')}}</h2>
                            <p>{{__('front.about-paragraph1')}}</p>
                            <p>{{__('front.about-paragraph2')}}</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-img">
                            <img src="{{ asset('UI/img/about.WebP')}}" alt="{{ t('thailand restaurant') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="offer-area block" id="offer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="box-offer">
                        <i class="fa fa-parachute-box"></i>
                        <h2>{{__('front.trusted-supplies')}}</h2>
                        <p>{{__('front.trusted-supplies-paragraph')}}</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="box-offer">
                        <i class="fa fa-truck"></i>
                        <h2>{{__('front.fast-delivery')}}</h2>
                        <p>{{__('front.fast-delivery-paragraph')}}</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="box-offer">
                        <i class="fa fa-utensils"></i>
                        <h2>{{__('front.original-recipes')}}</h2>
                        <p>{{__('front.original-recipes-paragraph')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="menu-area block" id="menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="menu-area-img">
                        <img src="{{ asset('UI/img/menu-area.png')}}" alt="{{ t('thailand restaurant') }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="content-menu">
                        <h2>{{__('front.menu-area-title')}}</h2>
                        <p>{{__('front.menu-area-paragraph')}}</p>
                        <div class="link-menu">
                            <a href="{{ route('menu') }}">{{__('front.menu-area-link')}}<span></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (isset($imageGalleries))
        @if ($imageGalleries->count() > 0)
            <div class="gallery-area block" id="gallery">
                <div class="owl-carousel owl-theme">
                    @foreach ($imageGalleries as $imageGallery)
                        <div class="item">
                            <img src="{{ $imageGallery->image }}" alt="{{ t('thailand restaurant') }}">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endif



    <div class="contact-area block" id="contact">
        <div class="container">
            <div class="form-contact">
                <div class="text-center">
                    <h2>{{__('front.form-contact-title')}}</h2>
                    <p>{{__('front.form-contact-subtitle')}}</p>
                </div>


                <br>
                <div class="alert alert-success d-none" role="alert"></div>


                <form action="{{ route('contact_store') }}" method="POST" class="formAction">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4 col-md-12">
                            <div class="form-group">
                                <input type="text" name="full_name" class="custom-input" placeholder="{{__('front.input-name')}}" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="form-group">

                            <input type="text" name="phone" class="custom-input" placeholder="{{__('front.input-phone')}}" autocomplete="off">
                        </div>

                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="form-group">
                                <input type="email" name="email" class="custom-input" placeholder="{{__('front.input-email')}}" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea name="message" class="custom-input" placeholder="{{__('front.input-message')}}" rows="6"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 text-center">
                            <button class="btn-save" type="submit">{{__('front.form-contact-btn')}}</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer')

<script>
        $(document).on('click', '.btn-save', function (event) {
                event.preventDefault();
                let form = jQuery(this).parents('form'),
                    formAction = form.attr('action'),
                    formData = new FormData($('.formAction')[0]);
            jQuery('.is-invalid').removeClass('is-invalid');
            jQuery.ajax({
                    type: 'post',
                    url: formAction,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.status) {
                            $('.formAction')[0].reset();
                            jQuery('.alert-success').removeClass('d-none');
                            jQuery('.alert-success').text(response.message);
                            jQuery('.text-danger').remove();
                            setTimeout(function () {
                                jQuery('.alert-success').addClass('d-none');
                            }, 5000);
                        }
                    },
                    error: function (response) {
                        let error = response.responseJSON
                        jQuery('.text-danger').remove();
                        for (let index in error.errors) {
                            form.find('[name="' + index + '"]').addClass('is-invalid');
                            form.find('[name="' + index + '"]').parents('.form-group').append(('<div class="text-danger" >' + error.errors[index][0] + '</div>'));
                        }
                    }
                });
            });

            $(document).ajaxStart(function () {
                jQuery('.fa-spin').removeClass('invisible');
            }).ajaxStop(function () {
                jQuery('.fa-spin').addClass('invisible');
            });
    </script>
@endsection
