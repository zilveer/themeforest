// Parallax Home Page Loader
// ======================
jQuery("body.download").queryLoader2({
        barColor: "#e7d408",
        backgroundColor: "#e7d408",
        percentage: true,
        barHeight: 3,
        completeAnimation: "grow",
        minimumTime: 200
    });
// Dropdown
//----------
jQuery(document).ready(function(){"use strict";
if( jQuery('body').find('.header-4').length>0 ) {
    jQuery('#mukam_header ul.nav.navbar-nav > li').each( function() {
        jQuery(this).addClass('menu-style1 menu1-c');
    });
}
});
jQuery(document).ready(function(){"use strict";
    jQuery( '.menu-item-has-children' ).each( function() {
        jQuery(this).addClass('dropdown');
    });
      
    jQuery( '.menu-item:not(.menu-item-has-children) .menu-link' ).each( function() {
        jQuery(this).addClass('trigger');
    });
    
    jQuery('ul.nav li.dropdown').hover(function() {
      jQuery(this).find('>.dropdown-menu').stop(true, true).delay(50).fadeIn(400);
    }, function() {
      jQuery(this).find('>.dropdown-menu').stop(true, true).delay(300).fadeOut(400);
    });  

});


// Fixed Header
// ======================

jQuery(window).load(function() {"use strict";
if( jQuery('body').find('.parallax-homepage').length>0 ) {
    var fixclass = jQuery( '.mukam-waypoint2' ).data( 'animateUp' ),
        loaded = ' mukam-header2 ' + fixclass;

    jQuery('#mukam_header').attr('id','mukam_header2').removeAttr('mukam_header');
    jQuery('#mukam_header2').attr( 'class' , loaded);
    
    // Parallax Fix
    //-------------
    var head2 = jQuery( '#mukam_header2' );
    jQuery( '.mukam-waypoint2' ).each( function(i) {
    var el = jQuery( this ),
        animClassDown = el.data( 'animateDown' ),
        animClassUp = el.data( 'animateUp' );
 
    el.waypoint( function( direction ) {
        if( direction === 'down' && animClassDown ) {
            head2.attr('class', 'mukam-header2 ' + animClassDown);
        }
        else if( direction === 'up' && animClassUp ){
            head2.attr('class', 'mukam-header2 ' + animClassUp);
        }
        }, { offset: '75px' } );
} );

}

else {

    // Fixed Header
    // ======================
    var head = jQuery( '#mukam_header' );
    jQuery( '.mukam-waypoint' ).each( function(i) {"use strict";
        var el = jQuery( this ),
            animClassDown = el.data( 'animateDown' ),
            animClassUp = el.data( 'animateUp' );
     
        el.waypoint( function( direction ) {
            if( direction === 'down' && animClassDown ) {
                head.attr('class', 'mukam-header ' + animClassDown);
            }
            else if( direction === 'up' && animClassUp ){
                head.attr('class', 'mukam-header ' + animClassUp);
            }
        }, { offset: '-1px' } );
    } );
}
});
// Mega Menu
//----------
jQuery(document).ready(function(){"use strict";
jQuery( ".multi .dropdown-menu .dropdown-menu" ).removeClass( "dropdown-menu" );
});
// Tab Active
// ======================
jQuery(window).load(function() { 
    if( jQuery('body').find('.tab-content').length>0 ) {       
            jQuery('.tab-content div:first-child').addClass('active in');
    }
});

// Show Hide TopSection
// ======================
jQuery(document).ready(function() {"use strict";
        jQuery('.top-section-container .showhide .trans-topsection').click(function() {
          jQuery('.top-section').slideToggle( 300, "linear", function() {
          jQuery('.mukam-waypoint').css('marginTop', jQuery('.mukam-header').outerHeight(true) );
            // Animation complete.
          });
        });
});

// Search Widget Open - Close
// ======================
var searchCheck = "close";
jQuery(document).ready(function() {"use strict";

    jQuery( ".search-widget .social-box" ).click(function() {
        if( searchCheck == "close") {
          jQuery('.search-widget').addClass( 'open' );  
          jQuery('.search').addClass( 'open' );
          jQuery('.search-widget .social-box').addClass( 'open' );
          searchCheck = "open"
        }
        else {
          jQuery('.search-widget').removeClass( 'open' );  
          jQuery('.search').removeClass( 'open');
          jQuery('.search-widget .social-box').removeClass( 'open' );
          searchCheck = "close"
        }
    });
});



jQuery(document).ready(function($) {"use strict";
    $('#commentrespond  input#submit').addClass('buton b_inherit buton-2 buton-mini');
});

  //
  // WoocommerceQuantiy
    jQuery( document ).on( 'click', '.plus, .minus', function($) {"use strict";

    // Get values
    var qty    = jQuery( this ).closest( '.quantity' ).find( '.qty' ),
      currentVal  = parseFloat( qty.val() ),
      max     = parseFloat( qty.attr( 'max' ) ),
      min     = parseFloat( qty.attr( 'min' ) ),
      step    = qty.attr( 'step' );

    // Format values
    if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
    if ( max === '' || max === 'NaN' ) max = '';
    if ( min === '' || min === 'NaN' ) min = 0;
    if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

    // Change the value
    if ( jQuery( this ).is( '.plus' ) ) {

      if ( max && ( max == currentVal || currentVal > max ) ) {
        qty.val( max );
      } else {
        qty.val( currentVal + parseFloat( step ) );
      }

    } else {

      if ( min && ( min == currentVal || currentVal < min ) ) {
        qty.val( min );
      } else if ( currentVal > 0 ) {
        qty.val( currentVal - parseFloat( step ) );
      }

    }

    // Trigger change event
    qty.trigger( 'change' );

  }); 
// Pretty Photo
// ====================== 
jQuery(document).ready(function(){"use strict";
    jQuery("a[data-rel^='prettyPhoto']").prettyPhoto({
        theme: "light_square"
    });
  });

// TOGGLE
// ======================
jQuery(document).ready(function() {"use strict";
    jQuery('.toggle').each(function() {
        var tis = jQuery(this);
        tis.click(function() {
            tis.next('div').slideToggle( 400, "easeInCirc", function() {
            tis.toggleClass('title-active'); 
            });
        });
    });
});

// Blog Home Page Slider
// ======================
jQuery(window).load(function() {"use strict";
if( jQuery('body').find('#foo3').length>0 ) {
jQuery("#foo3").carouFredSel({
    responsive: true,
    width: "100%",
    height: "variable",
    items: {    width: 1920,
                height: "auto",
                visible: {
                    min: 1,
                    max: 1
                }
            },
    auto : false,
    prev    : { 
                button  : ".html_carousel .prev",
                key     : "left"
            },
            next    : { 
                button  : ".html_carousel .next",
                key     : "right"
            },
    scroll      : {
            fx          : "crossfade",
            easing      : "linear"
    }
});
}
});

// Latest Work Carousel
// ======================
jQuery(window).load(function() {"use strict";
if( jQuery('body').find('#carousellatest').length>0 ) {
    jQuery("#carousellatest").carouFredSel({
            responsive: true,
            scroll: 1,
            auto: false,
            items: {
                width: 370,
                height: 350,
                visible: {
                    min: 1,
                    max: 10
                }
            },
            prev    : { 
                button  : ".carousel-container .prev",
                key     : "left"
            },
            next    : { 
                button  : ".carousel-container .next",
                key     : "right"
            }
            
    }); 
}
});

// Latest Product
// ======================
jQuery(window).load(function() {"use strict";
if( jQuery('body').find('#latestproduct-carousel').length>0 ) {
    jQuery("#latestproduct-carousel").carouFredSel({
            responsive: true,
            scroll: 1,
            auto: false,
            
            items: {
                width: 300,
                visible: {
                    min: 1,
                    max: 4
                }
            },
            prev    : { 
                button  : ".latestproduct-container .prev",
                key     : "left"
            },
            next    : { 
                button  : ".latestproduct-container .next",
                key     : "right"
            }
            
    }); 
}
});

// Latest Product
// ======================
jQuery(window).load(function() {"use strict";
if( jQuery('body').find('#latestproduct-carousel-2').length>0 ) {
    jQuery("#latestproduct-carousel-2").carouFredSel({
            responsive: true,
            scroll: 1,
            auto: false,
            
            items: {
                width: 300,
                visible: {
                    min: 1,
                    max: 4
                }
            },
            prev    : { 
                button  : ".latestproduct-container #prev2",
                key     : "left"
            },
            next    : { 
                button  : ".latestproduct-container #next2",
                key     : "right"
            }
            
    }); 
}
});

// Latest Product
// ======================
jQuery(window).load(function() {"use strict";
if( jQuery('body').find('#latestproduct-carousel-3').length>0 ) {
    jQuery("#latestproduct-carousel-3").carouFredSel({
            responsive: true,
            scroll: 1,
            auto: false,
            
            items: {
                width: 300,
                visible: {
                    min: 1,
                    max: 4
                }
            },
            prev    : { 
                button  : ".latestproduct-container #prev3",
                key     : "left"
            },
            next    : { 
                button  : ".latestproduct-container #next3",
                key     : "right"
            }
            
    }); 
}
});

// Our Client
// ======================
jQuery(window).load(function() {"use strict";
  jQuery('.clientslider').flexslider({
    directionNav: false,
    animation: "slide",
    animationLoop: false,
    itemWidth: 218,
    itemMargin: 0,
    minItems: 2,
    maxItems: 5
  });
});

// Our Client's SAY
// ======================
jQuery(window).load(function() {"use strict";
  jQuery('.happyclientslider').flexslider({
    directionNav: false,
    animation: "fade",
    animationLoop: true,
    itemWidth: 684,
    itemMargin: 0,
    minItems: 1,
    maxItems: 1
  });
});

// Post Slider
// ======================
jQuery(window).load(function() {"use strict";
  jQuery('.post-slider').flexslider({
    controlNav: false,             
    directionNav: true,  
    animation: "fade",
    animationLoop: false,
    itemWidth: 805,
    itemMargin: 0,
    minItems: 1,
    maxItems: 1,
    prevText: "",
    nextText: ""
  });
});

jQuery(window).load(function() {"use strict";
    if( jQuery('body').find('.fullcarousel').length>0 ) {
    jQuery('.fullcarousel').flexslider({
          animation: "slide",
          animationLoop: true,
          touch: true, 
          controlNav: false,            
          directionNav: false,
          itemWidth: 384,
          itemMargin: 0,
          minItems: 5,
          maxItems: 5,
          move: 1 
    });
    }
  });

jQuery(window).load(function() {"use strict";
    if( jQuery('body').find('.fullcarousel').length>0 ) {
    jQuery('.fullcarousel2').flexslider({
          animation: "slide",
          animationLoop: true,
          touch: true,
          reverse: true, 
          controlNav: false,            
          directionNav: false,
          itemWidth: 384,
          itemMargin: 0,
          minItems: 5,
          maxItems: 5,
          move: 1 
    });
    }
  });


// Parallax Plugin
// ======================
jQuery(document).ready(function(){"use strict";
if ( jQuery( window ).width() > 1024 ) { 
  jQuery.stellar({
    horizontalScrolling: false,
    scrollProperty: 'scroll',
    positionProperty: 'position',
  });
}
});

// Parallax Home Page Slider
// ======================
jQuery(document).ready(function() {"use strict";
  jQuery('.homepage-slider').flexslider({
        animation: "swing",
        direction: "vertical", 
        slideshow: true,
        slideshowSpeed: 3500,
        animationDuration: 1000,
        directionNav: false,
        controlNav: true,
        touch: false
  });
});

// Parallax Home Page Text Size
// ======================
if( jQuery('body').find('.homepage-slider').length>0 ) {
jQuery(".homepage-slider p").fitText(1.8, { maxFontSize: '88px' });
}

// PORTFOLIO
// ======================
if( jQuery('body').find('.latest-work-grid').length>0 ) {
jQuery(function(jQuery) {"use strict";
    var nav=jQuery('.latest-word-grid-container .menu-widget');
    var container=jQuery('.latest-work-grid');
    container.imagesLoaded( function(){ 
    container.masonry({
    isAnimated: true,
    itemSelector:'.latest-work-item:not(.hidden)',
    columnWidth: '.grid-sizer',
});
});
    container.masonry();
 // Filter for Portfolio
    jQuery('.latest-word-grid-container .menu-widget a').click(function(e){
        var menuactive = jQuery(this).attr('href');
        var category = jQuery(this).attr('href').replace('#','');
        nav.find('li').removeClass('active'); /* Portfolio menu remove active */
        nav.find('li.slug-'+category).addClass('active');
        container.find('.latest-work-item').removeClass('hidden'); 
        container.find('.latest-work-item:not(.'+category+')').addClass('hidden');

        container.masonry({
        isAnimated: true,
        itemSelector:'.latest-work-item:not(.hidden)',
        columnWidth: '.grid-sizer',
        });

        container.masonry();
        container.find('.'+category).show(500);
        container.find('.latest-work-item:not(.'+category+')').hide(500);
        location.hash = category;
        e.preventDefault(); 

    });

    if(location.hash!=''){
        jQuery('a[href="'+location.hash+'"]').trigger('click');
    }
});
}

// Portfolio Page
// Portfolio Style 1
// ======================
if( jQuery('body').find('.portfolio-1-wrapper').length>0 ) {
jQuery(function(jQuery) {"use strict";
    var nav=jQuery('.portfolio-style-1-filter');
    var container=jQuery('.portfolio-1-wrapper');
    container.imagesLoaded( function(){ 
    container.masonry({
    isAnimated: true,
    itemSelector:'.portfolio-item:not(.hidden)',
    columnWidth: '.grid-sizer',
});
});
    container.masonry();
 // Filter for Portfolio
    jQuery('.portfolio-style-1-filter a').click(function(e){
        var menuactive = jQuery(this).attr('href');
        var category = jQuery(this).attr('href').replace('#','');
        nav.find('li').removeClass('active'); /* Portfolio menu remove active */
        nav.find('li.slug-'+category).addClass('active');
        container.find('.portfolio-item').removeClass('hidden'); 
        container.find('.portfolio-item:not(.'+category+')').addClass('hidden');

        container.masonry({
        isAnimated: true,
        itemSelector:'.portfolio-item:not(.hidden)',
        columnWidth: '.grid-sizer',
        });

        container.masonry();
        container.find('.'+category).show(500);
        container.find('.portfolio-item:not(.'+category+')').hide(500);
        location.hash = category;
        e.preventDefault(); 

    });

    if(location.hash!=''){
        jQuery('a[href="'+location.hash+'"]').trigger('click');
    }
});
}

// Portfolio Style 2
// ======================
if( jQuery('body').find('.portfolio-2-wrapper').length>0 ) {
jQuery(function(jQuery) {"use strict";
    var nav=jQuery('.portfolio-style-1-filter');
    var container=jQuery('.portfolio-2-wrapper');
    container.imagesLoaded( function(){ 
    container.masonry({
    isAnimated: true,
    itemSelector:'.portfolio-item-2:not(.hidden)',
    columnWidth: '.grid-sizer',
    gutter: 15,
});
});
    container.masonry();
 // Filter for Portfolio
    jQuery('.portfolio-style-1-filter a').click(function(e){
        var menuactive = jQuery(this).attr('href');
        var category = jQuery(this).attr('href').replace('#','');
        nav.find('li').removeClass('active'); /* Portfolio menu remove active */
        nav.find('li.slug-'+category).addClass('active');
        container.find('.portfolio-item-2').removeClass('hidden'); 
        container.find('.portfolio-item-2:not(.'+category+')').addClass('hidden');

        container.masonry({
        isAnimated: true,
        itemSelector:'.portfolio-item-2:not(.hidden)',
        columnWidth: '.grid-sizer',
        });

        container.masonry();
        container.find('.'+category).show(500);
        container.find('.portfolio-item-2:not(.'+category+')').hide(500);
        location.hash = category;
        e.preventDefault(); 

    });

    if(location.hash!=''){
        jQuery('a[href="'+location.hash+'"]').trigger('click');
    }
});
}

// Portfolio Style 3
// ======================
if( jQuery('body').find('.portfolio-3-wrapper').length>0 ) {
jQuery(function(jQuery) {"use strict";
    var nav=jQuery('.portfolio-style-1-filter');
    var container=jQuery('.portfolio-3-wrapper');
    container.imagesLoaded( function(){ 
    container.masonry({
    isAnimated: true,
    itemSelector:'.portfolio-item-3:not(.hidden)',
    columnWidth: '.grid-sizer',
    gutter: 30,
});
});
    container.masonry();
 // Filter for Portfolio
    jQuery('.portfolio-style-1-filter a').click(function(e){
        var menuactive = jQuery(this).attr('href');
        var category = jQuery(this).attr('href').replace('#','');
        nav.find('li').removeClass('active'); /* Portfolio menu remove active */
        nav.find('li.slug-'+category).addClass('active');
        container.find('.portfolio-item-3').removeClass('hidden'); 
        container.find('.portfolio-item-3:not(.'+category+')').addClass('hidden');

        container.masonry({
        isAnimated: true,
        itemSelector:'.portfolio-item-3:not(.hidden)',
        columnWidth: '.grid-sizer',
        });

        container.masonry();
        container.find('.'+category).show(500);
        container.find('.portfolio-item-3:not(.'+category+')').hide(500);
        location.hash = category;
        e.preventDefault(); 

    });

    if(location.hash!=''){
        jQuery('a[href="'+location.hash+'"]').trigger('click');
    }
});
}

// BLOG
// Style 1
// ======================
if( jQuery('body').find('.blog-style-1').length>0 ) {
jQuery(function(jQuery) {"use strict";
    var container=jQuery('.blog-style-1');
    container.imagesLoaded( function(){ 
        container.masonry({
        isAnimated: true,
        itemSelector:'.blog-item',
        columnWidth: '.blog-sizer',
        gutter: 29,
        isResizable: true
    });
    });
});
}

// BLOG
// Style 3
// ======================
if( jQuery('body').find('.blog-style-3').length>0 ) {
jQuery(function(jQuery) {"use strict";
    var container=jQuery('.blog-style-3');
    container.imagesLoaded( function(){ 
        container.masonry({
        isAnimated: true,
        itemSelector:'.blog-item',
        columnWidth: '.blog-sizer',
        gutter: 30,
        isResizable: true
});
});
}); }

// ANIMATION
// ======================
jQuery(document).ready(function() {"use strict";
   var myclasses;
   var myclass;
   var ekclass;
jQuery('.blind').waypoint(function() {
   myclasses = this.className;
   myclass = myclasses.split(" ");
   ekclass = myclass[0].split("-");
    if ( ekclass[0] !== "no_animation" && myclass[1] === "blind") {
                jQuery(this).addClass('v '+ekclass[0]);
                                                   }
}, { offset: '70%' });
});

// ANIMATION SIDEBAR
// ======================
jQuery(document).ready(function() {"use strict";
   var myclasses;
   var myclass;
   var ekclass;
jQuery('.blindy').waypoint(function() {
   myclasses = this.className;
   myclass = myclasses.split(" ");
   ekclass = myclass[0].split("-");
    if ( ekclass[0] !== "no_animation" && myclass[1] === "blindy") {
                jQuery(this).addClass('v '+ekclass[0]);
                                                   }
}, { offset: '160%' });
});