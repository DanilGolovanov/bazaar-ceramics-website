//Jquery doing the same thing as HTML DOM manipulation in JS, plugin 'slick' is used
//script below is cutomized in order to work with Production page slideshow

$(document).ready(function (){
    $('.slick-large').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        centerMode: true,
        fade: true,
        asNavFor: '.slick-nav'
    });
    $('.slick-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.slick-large',
        dots: false,
        centerMode: true,
        focusOnSelect: true
    });
})