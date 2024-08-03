$(document).ready(function(){

    let time = $('.timer').attr('data-time');
    tick(time);

    setInterval(function() {
        tick(time);
    }, 1000);

    function tick(time){
        let currentTime = Math.round(new Date().getTime() / 1000.0);
        let leftTime = Math.abs(time - currentTime);
        let date = convert(leftTime);

        $('.timer-days span').html(date.d);
        $('.timer-hours span').html(date.h);
        $('.timer-minutes span').html(date.m);
        $('.timer-seconds span').html(date.s);
    }

    function convert(time){
        let d = time / (3600*24) ^ 0;
        let h = ( time - d * 3600 * 24 ) / 3600 ^ 0;
        let m = ( time - h * 3600 -d * 3600 * 24 ) / 60 ^ 0;
        let s = time - h * 3600 - d * 3600 * 24 - m * 60;
        if(d < 10){ d = '0' + d;}
        if(h < 10){ h = '0' + h;}
        if(m < 10){ m = '0' + m;}
        if(s < 10){ s = '0' + s;}
        return {
            d: d,
            h: h,
            m: m,
            s: s,
        };
    }
});