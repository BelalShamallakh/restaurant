$(function () {
    "use strict";

    $('.navbar-toggler').click(function () {
        $('.navbar').toggleClass('active');
        $('body').toggleClass('canvas-open');
    });

    $('.navbar-toggler').click(function () {
        $('.navbar-toggler-icon').toggleClass('active');
    });



    $(".nav-item.scroll-item").on("click", function (e) {
        e.preventDefault();
        $("html, body").animate({
                scrollTop: $("#" + $(this).data("scroll")).offset().top - 85,
            },
            1000
        );
    });

    $(window).scroll(function () {
        $('.block').each(function () {
            if ($(window).scrollTop() >= $(this).offset().top - 90) {
                var blockID = $(this).attr('id');
                $('.navbar-nav .nav-item').removeClass('active');
                $('.navbar-nav .nav-item[data-scroll="' + blockID + '"]').addClass('active')

            }
        })
    })

    var $headerArea = $(".header-area");

    $(window).on("scroll load", function () {
        var scroll = $(window).scrollTop();

        if (scroll >= 120) {
            $headerArea.addClass("header-fixed");
        } else {
            $headerArea.removeClass("header-fixed");
        }

        if (scroll >= 250) {
            $headerArea.addClass("header-transitioned");
        } else {
            $headerArea.removeClass("header-transitioned");
        }

        if (scroll >= 500) {
            $headerArea.addClass("header-on");
        } else {
            $headerArea.removeClass("header-on");
        }

    })

    $(".scroll-top").on("click", function (e) {
        $("html , body").animate({
            scrollTop: 0,
        }, 1000);
    });

    $('.testimonial-area .owl-carousel').owlCarousel({
        loop: true,
        nav: false,
        dots: true,
        rtl: true,
        item: 1,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    })



    $('.gallery-area .owl-carousel').owlCarousel({
        loop: true,
        nav: true,
        rtl: true,

        responsive: {
            0: {
                items: 2
            },
            768: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    })

});
