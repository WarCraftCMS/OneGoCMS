$('.server-section-slider-for').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    infinite: false,
    fade: true,
    asNavFor: '.server-section-slider-nav'
});
$('.server-section-slider-nav').slick({
    slidesToShow: 2,
    slidesToScroll: 1,
    infinite: false,
    asNavFor: '.server-section-slider-for',
    arrows: true,
    focusOnSelect: true,
    responsive: [
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]
});
$('.streams-slider').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    arrows: true,
    responsive: [
        {
            breakpoint: 1300,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]
});

var streams = [];
$(".streams-slider .slick-slide").each(function () {
    streams.push($(this).find(".streams__slider-item-content").html());
    if (!$(this).hasClass("slick-active")) {
        $(this).find(".streams__slider-item-content").html("");
    }
});

$('.streams-slider').on('afterChange', function (event, slick, currentSlide, nextSlide) {
    setTimeout(function(){
        $(".streams-slider .slick-slide").each(function () {
            if ($(this).hasClass("slick-active")) {
                if (!$(this).find(".streams__slider-item-content").html()) {
                    $(this).find(".streams__slider-item-content").html(streams[$(this).index()]);
                }
            } else {
                $(this).find(".streams__slider-item-content").html("");
            }
        });
    }, 50);
});

$('.main-rating').MVisionToggleClass({
    classButton: 'main-rating__switch-item',
    toggleClassButton: 'active',
    dataButtonAttr: 'data-open-tab',
    classBox: 'main-rating__content-tab',
    toggleClassBox: 'active',
    dataBoxAttr: 'data-name-tab',
    defaultElement: true,
    defaultIndexElement: 0,
});

$('.form').MVisionToggleClass({
    classButton: 'form__switch-item',
    toggleClassButton: 'active',
    dataButtonAttr: 'data-open-tab',
    classBox: 'form__group',
    toggleClassBox: 'active',
    dataBoxAttr: 'data-name-tab',
});

$('.password-switch').click(function() {
    let input = $(this).parent().find('input');

    if($(this).hasClass('active'))
    {
        $(this).removeClass('active');
        input.attr('type', 'password');
    }
    else
    {
        $(this).addClass('active');
        input.attr('type', 'text');
    }
});

$(document).ready(function(){
    $('.spoiler__title').click(function (event) {
        event.preventDefault();

        if(!$(this).parent().hasClass('active'))
        {
            $(this).parent().addClass('active');

            $(this).parent().find('.spoiler__content').eq(0).slideDown(200, function() {
                $(this).css('display', 'block');
            });
        }
        else
        {
            $(this).parent().removeClass('active');

            $(this).parent().find('.spoiler__content').eq(0).slideUp(200, function() {
                $(this).css('display', 'none');
            });
        }
    });
});