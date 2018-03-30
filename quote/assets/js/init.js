/* ==================================================
//  ____  _     _   _            _   _          _____ _                              
// |  _ \(_)___| |_(_)_ __   ___| |_(_)_   ____|_   _| |__   ___ _ __ ___   ___  ___ 
// | | | | / __| __| | '_ \ / __| __| \ \ / / _ \| | | '_ \ / _ \ '_ ` _ \ / _ \/ __|
// | |_| | \__ \ |_| | | | | (__| |_| |\ V /  __/| | | | | |  __/ | | | | |  __/\__ \
// |____/|_|___/\__|_|_| |_|\___|\__|_| \_/ \___||_| |_| |_|\___|_| |_| |_|\___||___/
//
/* ==================================================
/*-----------------------------------------------------------------------------------*/
/*  BACKGROUNDS
/*-----------------------------------------------------------------------------------*/
/* Slide Sync to Carousel */
jQuery(document).ready(function($){
  'use strict';
  jQuery('#headerwrap #prevslide').click(function(x) { x.preventDefault(); jQuery('#headerwrap').data('backstretch').prev(); });
  jQuery('#headerwrap #nextslide').click(function(x) { x.preventDefault(); jQuery('#headerwrap').data('backstretch').next(); });

  var windowsHeight = jQuery(window).height();
  var headerHeight = jQuery(".navbar-fixed-top").height();
  jQuery('#headerwrap').css('height', windowsHeight + 'px');
  jQuery('#headerwrap.half').css('height', windowsHeight/3 + 'px');

    //goto top
    jQuery('.gototop').click(function(event) {
      event.preventDefault();
      jQuery('html, body').animate({
        scrollTop: jQuery("body").offset().top
      }, 500);
    }); 

  /* Fix Heights Witin Certain Views */
  jQuery('#home-latest-posts .post-item, .post-type-archive-dt_portfolio_cpt .portfolio-item, #portfolio-ajax .portfolio-item').matchHeight();

  var sliderHeight = jQuery('#headerwrap').outerHeight();
  var sliderContentHeight = jQuery('#headerwrap.fullsize #bannertext').outerHeight();
  jQuery('#headerwrap.fullsize #bannertext').css({
    'margin-top' : sliderHeight /2,
    'top' : - sliderContentHeight /2
  });
}); 

jQuery(window).scroll(function() {
'use strict';
    var scroll_pos = 0;
    
    jQuery(document).scroll(function() { 
        var windowsHeight = jQuery(window).height();
        scroll_pos = jQuery(this).scrollTop();
        if(scroll_pos > windowsHeight) {              
            jQuery('#gototop').addClass('appear');
            jQuery('#gototop').removeClass('no-display');
        } else {
            jQuery('#gototop').addClass('no-display');
            jQuery('#gototop').removeClass('appear');
        }
    });

});
/*-----------------------------------------------------------------------------------*/
/*  PORTFOLIO
/*-----------------------------------------------------------------------------------*/
jQuery(window).load(function(){
  'use strict';
  var portfolio_selectors = jQuery('.portfolio-filter li a');
  if(portfolio_selectors!='undefined'){
    var portfolio = jQuery('.portfolio-items');
    portfolio.isotope({
      itemSelector : 'li',
      layoutMode : 'fitRows'
    });
    portfolio_selectors.on('click', function(){
      portfolio_selectors.removeClass('active');
      jQuery(this).addClass('active');
      var selector = jQuery(this).attr('data-filter');
      portfolio.isotope({ filter: selector });
      return false;
    });
  }
});

/*-----------------------------------------------------------------------------------*/
/*  FUNCTIONS
/*-----------------------------------------------------------------------------------*/
jQuery(window).load(function(){
  'use strict';
  jQuery('.dropdown-menu').addClass('dropdown-push-right');

  function resizebg() {
      jQuery('#headerwrap').backstretch("resize");
  }

  jQuery('.menu-close').on('click', function(){
    jQuery('.menu-close').toggleClass('fa-bars');
    jQuery('.menu-close').toggleClass('fa-times');
    jQuery('#menuToggle').toggleClass('active');
    jQuery('body').toggleClass('body-push-toright');
    jQuery('#theMenu').toggleClass('menu-open');    
    setTimeout(resizebg, 50);
    setTimeout(resizebg, 100);
    setTimeout(resizebg, 150);
    setTimeout(resizebg, 200)
    setTimeout(resizebg, 250);
    setTimeout(resizebg, 400);
  });

 // ADD SLIDEDOWN ANIMATION TO DROPDOWN //
  jQuery('.dropdown').on('show.bs.dropdown', function(e){
    jQuery(this).find('.dropdown-menu').first().stop(true, true).slideDown();
  });

  // ADD SLIDEUP ANIMATION TO DROPDOWN //
  jQuery('.dropdown').on('hide.bs.dropdown', function(e){
    jQuery(this).find('.dropdown-menu').first().stop(true, true).slideUp();
  });

  jQuery('.menu-item-has-children > a').addClass('dropdown-toggle');
  jQuery('.menu-item-has-children > a').attr('data-toggle', 'dropdown');

    jQuery('.backstretch').bind('resize', function(){
      jQuery('#headerwrap').backstretch("resize");
  });

});

/*-----------------------------------------------------------------------------------*/
/*  NICESCROLL
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function(){
'use strict';
    jQuery("html").niceScroll({
      cursorcolor: '#202020',
      cursorwidth: 15,
      cursorborderradius: 0,
      cursorborder: '0px solid #fff',
      zindex: 10
    });
});

/*-----------------------------------------------------------------------------------*/
/*  SNOOOOOOOOTH SCROLL - SO SMOOTH
/*-----------------------------------------------------------------------------------*/
jQuery(function() {
'use strict';
  jQuery('a[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = jQuery(this.hash);
      target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
      var headerHeight = jQuery(".navbar-fixed-top").height();
      if (target.length) {
        jQuery('html,body').animate({
          scrollTop: target.offset().top - headerHeight
          }, 1000);
        return false;
      }
    }
  });
});

/*-----------------------------------------------------------------------------------*/
/*  SEARCH BAR
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function($){
'use strict';
  jQuery('#search-wrapper, #search-wrapper input').hide();

  jQuery('.search-trigger').click(function(e) {
    e.preventDefault();
  });

  jQuery('.search-trigger').click(function(){
    jQuery('#search-wrapper').slideDown(300, function() {
      var check=jQuery(this).is(":hidden");
      if(check == true) {
          jQuery('#search-wrapper input').fadeOut(600);
      } else {
        jQuery("#search-wrapper input").focus();
        jQuery('#search-wrapper input').slideDown(200);
      }
    });
  });

  jQuery('.close-trigger').click(function(){
    jQuery('#search-wrapper').slideUp(300);
  });

});

/*-----------------------------------------------------------------------------------*/
/*  PRELOADER
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function($){
'use strict';
  jQuery(window).load(function(){
    jQuery('#preloader').fadeOut('slow',function(){jQuery(this).remove();});
  });
});

jQuery(document).ready(function() {
 
  jQuery("#testimonials-slider").owlCarousel({ 
      navigation : false, // Show next and prev buttons
      slideSpeed : 300,
      paginationSpeed : 400,
      singleItem:true,
      navigationText : ["<i class=\"fa fa-angle-left\"></i>","<i class=\"fa fa-angle-right\"></i>"],
  });

  jQuery("#tweet-slider").owlCarousel({ 
      navigation : false, // Show next and prev buttons
      slideSpeed : 300,
      paginationSpeed : 400,
      singleItem:true,
      navigationText : ["<i class=\"fa fa-angle-left\"></i>","<i class=\"fa fa-angle-right\"></i>"],
  });

  jQuery("#logo-carousel").owlCarousel({ 
      autoPlay: 5000, //Set AutoPlay to 3 seconds 
      items : 4,
      itemsDesktop : [1199,3],
      itemsDesktopSmall : [979,3],
       navigation : true, // Show next and prev buttons
       navigationText : ["<i class=\"fa fa-angle-left\"></i>","<i class=\"fa fa-angle-right\"></i>"],
  });

  jQuery("#related-carousel").owlCarousel({
      items: 3,
      pagination: true,
      navigationText: [
        "<i class='fa fa-angle-left icon-white'></i>",
        "<i class='fa fa-angle-right icon-white'></i>"
      ]
  });
 
});

/*-----------------------------------------------------------------------------------*/
/*  CONTACT FORM
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function($){
  'use strict';

  jQuery('#contactform').submit(function(){
    var action = jQuery(this).attr('action');
    jQuery("#message").slideUp(750,function() {
    jQuery('#message').hide();
    jQuery('#submit').attr('disabled','disabled');
    $.post(action, {
      name: jQuery('#name').val(),
      email: jQuery('#email').val(),
      website: jQuery('#website').val(),
      comments: jQuery('#comments').val()
    },
      function(data){
        document.getElementById('message').innerHTML = data;
        jQuery('#message').slideDown('slow');
        jQuery('#submit').removeAttr('disabled');
        if(data.match('success') != null) jQuery('#contactform').slideUp('slow');
        jQuery(window).trigger('resize');
      }
    );
    });
    return false;
  });
  
});

jQuery( document ).ready( function( $ ) {
  'use strict';
    $( 'input.search-field' ).addClass( 'form-control' );
    $( '.widget input.search-field' ).addClass( 'form-control' );
    $( '.widget input.search-submit, input.search-submit, a.comment-reply-link,  .wpcf7-submit, .nav-links a, .load-more-posts a, .load-more-projects a' ).addClass( 'btn btn-primary btn-outlined' );
    $( '.widget_rss ul' ).addClass( 'media-list' );
    $( 'table#wp-calendar' ).addClass( 'table table-striped');
    $('.entry-content table, .post-content table').addClass('table');
    $('.entry-content dl, .post-content dl').addClass('dl-horizontal');

    $('.post .gallery').magnificPopup({
      delegate: 'a', // child items selector, by clicking on it popup will open
      type: 'image'
      // other options
    });
    $('.portfolio-item .overlay .preview.lb').magnificPopup({
      type: 'image'
      // other options
    });
} );

( function ( $ ) {
'use strict';
jQuery(document).ready(function(){
jQuery(window).bind('load', function () {
    parallaxInit();             
  });
  function parallaxInit() {
    var testMobile = isMobile.any();
    var topActive = jQuery('body').hasClass('topnav-active');
    if (testMobile) {
      jQuery('body, html').css({'margin-left':'0'});      
      jQuery('body').removeClass('body-push-toright');
      jQuery('#theMenu').removeClass('menu-open');
      if (topActive) { } else { jQuery('body').css({'padding-left':'60px'}); }     
    }
  } 
  parallaxInit();  
}); 
var testMobile;
var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
};
}( jQuery ));