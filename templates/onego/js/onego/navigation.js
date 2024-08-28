$(document).ready(function () {

    $('.open-main-menu').click(function (event) {
        if ($('.nav__links').is(':hidden')) {
            $('.nav__links').slideDown(300, function () {
                $(this).css('display', 'block');
            });
            $(this).addClass('active');
        } else {
            $('.nav__links').slideUp(300, function () {
                $(this).css('display', 'none');
            });
            $(this).removeClass('active');
        }
    });

    $(document).mouseup(function (e) {
        if (!$('.open-main-menu').is(e.target) && !$('.nav__links').is(e.target) && $('.nav__links').has(e.target).length === 0 && $(".open-main-menu").is(":visible")) {
            $(".open-main-menu").removeClass('active');
            $('.nav__links' + ':visible').slideUp(300, function () {
                $(this).css('display', 'none');
            });
        }
    });

    $(window).resize(function () {
        if (!$(".open-main-menu").is(":visible")) {
            $(".nav__links").removeAttr("style");
            $(".open-main-menu").removeClass('active');
            $(".nav__item-text--dropdown").removeClass('active');
            $(".nav__item-stroke").removeAttr("style");
        }
    });

    $('.nav__item-text--dropdown').click(function (event) {
        event.preventDefault();

        if($(window).outerWidth() > 1024)
            return;

        $(this).parent().parent().find('.nav__item-text--dropdown').not($(this)).removeClass('active');

        $(this).parent().parent().find('.nav__item-text--dropdown').not($(this)).parent().children('.nav__item-stroke').slideUp(300, function () {
            $(this).css('display', 'none');
        });

        if (!$(this).hasClass('active'))
        {
            $(this).parent().children('.nav__item-stroke').slideDown(300, function () {
                $(this).css('display', 'block');
            });
            $(this).addClass('active');
        } 
        else
        {
            $(this).parent().children('.nav__item-stroke').slideUp(300, function () {
                $(this).css('display', 'none');
            });
            $(this).removeClass('active');
        }
    });

    $(document).mouseup(function (e) {
        if($(window).outerWidth() > 1024)
            return;
        if (!$('.nav__item-text--dropdown').is(e.target) && $(".nav__item-text--dropdown").has(e.target).length === 0 && !$('.nav__item-stroke').is(e.target) && $(".nav__item-stroke").has(e.target).length === 0) {
            $(".nav__item-stroke").slideUp(300, function () {
                $(this).css('display', 'none');
            });
            $(".nav__item-text--dropdown").removeClass("active");
        }
    });

    $('.open-nav__button').click(function (event) {
        if (!$('body').hasClass('active-navigation'))
            $('body').addClass('active-navigation');
        else
            $('body').removeClass('active-navigation');
    });
    

    function restyleNavigation() {
        let scrollTop = $(document).scrollTop();
        let announceHeight = $('.announse').outerHeight() ?? 0;

        if (scrollTop > announceHeight) {
            if (!$('nav').hasClass('nav--fixed'))
                $('nav').addClass('nav--fixed');
        } else {
            if ($('nav').hasClass('nav--fixed'))
                $('nav').removeClass('nav--fixed');
        }
    }

    restyleNavigation();

    $(window).scroll(function () {
        restyleNavigation();
    });

    $('.langs__content-current').click(function (event) {
        if ($(this).parent().hasClass('active'))
            $(this).parent().removeClass('active');
        else
            $(this).parent().addClass('active');
    });

    $('.langs__content-arrow').click(function (event) {
        if ($(this).parent().hasClass('active'))
            $(this).parent().removeClass('active');
        else
            $(this).parent().addClass('active');
    });

    $(document).mouseup(function (e) {
        if (!$('.langs__content').is(e.target) && $('.langs__content').has(e.target).length === 0)
            $(".langs__content").removeClass('active');
    });
    
});

