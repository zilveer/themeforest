(function($){
"use strict";





$(document).ready(function(){


$("#nav").superfish({
      delay: 0,
      animation: {opacity:'show',height:'show'},
      speed: 'normal'
}).supposition();

$("#navmain").superfish({
      delay: 0,
      animation: {opacity:'show',height:'show'},
      speed: 'normal'
}).supposition();

$('html').click(function(e) {
    $('#event-details').slideUp();
});

$('.event-close-button a').click(function(e) {
    $('#event-details').slideUp();
    e.preventDefault();
    e.stopPropagation();
});

$('#eventbox').click(function (e) {
    $('#event-details').slideDown();
    e.preventDefault();
    e.stopPropagation();
});

$('.header-search input:text').click(function (e) {
  $(this).animate({'width' : '200px'});
});

$(".fitvids").fitVids();

$('.navigate').slicknav();
$('.slicknav_icon').click(function(){
  $(this).toggleClass('open');
});

/* Scroll to Top */
$(window).scroll(function(){
    if ($(this).scrollTop() > 500) {
    jQuery('.scrollup').fadeIn();
    } else {
    jQuery('.scrollup').fadeOut();
    }
});
$('.scrollup').click(function(){
    $("html, body").animate({ scrollTop: 0 }, 600);
    return false;
});
/* Scroll to Top */

$('.flexslider').flexslider({
  slideshow: false,
  animation: "slide",
  animationLoop: false,
});

$('.sidebar').theiaStickySidebar({
  additionalMarginTop: 30
});

});

})(jQuery);