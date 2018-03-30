;(function($) {

"use strict";

var $body = $('body');
// var $head = $('head');
// var $mainWrapper = $('#main-wrapper');



// Mediaqueries
// ---------------------------------------------------------
// var XS = window.matchMedia('(max-width:767px)');
// var SM = window.matchMedia('(min-width:768px) and (max-width:991px)');
// var MD = window.matchMedia('(min-width:992px) and (max-width:1199px)');
// var LG = window.matchMedia('(min-width:1200px)');
// var XXS = window.matchMedia('(max-width:480px)');
// var SM_XS = window.matchMedia('(max-width:991px)');
// var LG_MD = window.matchMedia('(min-width:992px)');

$(document).ready(function() {







  $(".swipebox").swipebox();
});

$(window).load(function(){
  // ISOTOPE FILTERS
  $('#portfolio').each(function() {
    var $container = $('.portfolio-filters-content');
    // initialize
    $container.masonry({
      itemSelector: 'article'
    });

    var filterFns = {};

    $('#portfolio .filters li a').on( 'click', function() {
      var filterValue = $( this ).attr('data-filter');
      // use filterFn if matches value
      filterValue = filterFns[ filterValue ] || filterValue;
      $container.isotope({ filter: filterValue });

      $('#portfolio .filters li a').each(function(){
        $(this).removeClass("active");
      });
      $(this).addClass("active");

      return false;
    });
  });
});



// Touch
// ---------------------------------------------------------
var dragging = false;

$body.on('touchmove', function() {
  dragging = true;
});

$body.on('touchstart', function() {
  dragging = false;
});



}(jQuery));
