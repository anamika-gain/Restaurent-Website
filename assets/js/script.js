(function($) {

    "use strict";

    // Back to top
    $.scrollUp({
        scrollText: '<i class="fa fa-arrow-up"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade'
    });

    // Menu sticky
    $(window).on('scroll', function() {
        var scroll = $(window).scrollTop();
        if (scroll < 20) {
            $(".header-area").removeClass("sticky-header");
        } else {
            $(".header-area").addClass("sticky-header");
        }
    });


    //js code for mobile menu toggle
    $(".menu-toggle").on("click", function() {
        $(this).toggleClass("is-active");
    });

    // testimonials
    $('.hero').owlCarousel({
        loop: true,
        dots: true,
        autoplay: false,
        nav: false,
        mouseDrag: true,
        autoplayTimeout: 10000,
        smartSpeed: 1000,
        responsive: {
            0: {
                items: 1,
                dots: false,
            },
            576: {
                items: 1
            },
            991: {
                items: 1
            },
            1024: {
                items: 1
            },
            1199: {
                items: 1
            }
        }
    });

    $(function() {
        $("#datepicker2").datepicker();
    });

    $("#datepicker").datepicker({
        dateFormat: 'dd/mm'
    });


    // Preloader Js
    $(document).on('ready', function() {
        $('.preloader').fadeOut(1000); // set duration in brackets    
    });

    $(".screenshot-gallery").each(function() {
        $(this).find(".popup-screenshot").magnificPopup({
            type: "image",
            gallery: {
                enabled: true
            }
        });
    });

    // Onload popup
    // $(window).on('load',function(){
    // 	setTimeout(function() {
    // 		$("#onload-popup").modal('show', {}, 500);
    // 	}, 3000);

    // });


    $(document).ready(function() {
        const minus = $('.quantity__minus');
        const plus = $('.quantity__plus');
        const input = $('.quantity__input');
        minus.click(function(e) {
            e.preventDefault();
            var value = input.val();
            if (value > 1) {
                value--;
            }
            input.val(value);
        });

        plus.click(function(e) {
            e.preventDefault();
            var value = input.val();
            value++;
            input.val(value);
        })
    });


})(jQuery);