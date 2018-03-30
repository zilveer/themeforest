<!-- ================================================== -->

<!-- =============== START FIT VIDS ================ -->

<!-- ================================================== -->



jQuery('.navbar-nav > li').each(function(index){

    if(jQuery(this).hasClass('current-menu-item') || jQuery(this).hasClass('current-menu-parent')) {

        jQuery(this).addClass('active');

    }

});



jQuery(document).ready(function(){ "use strict";



    jQuery('article').fitVids();



    if(jQuery('.revolutionSliderContainer').length){

        jQuery('body').addClass('top-slider');

    }



    jQuery('.tab-content').each(function(index) {

        jQuery(this).find('.tab-pane').first().addClass('in active');

    });





});



<!-- ================================================== -->

<!-- =============== END FIT VIDS ================ -->

<!-- ================================================== -->



<!-- ================================================== -->

<!-- =============== START LSTS ICONS COLORS ================ -->

<!-- ================================================== -->



jQuery(document).ready(function(){ "use strict";



		jQuery('.primary-list').each(function(){



			var color = jQuery(this).data('icons-color');



			jQuery(this).find('i').css('color',color);



		});



});



<!-- ================================================== -->

<!-- =============== END LSTS ICONS COLORS ================ -->

<!-- ================================================== -->



<!-- ================================================== -->

<!-- =============== START BLOG OPTION JS ================ -->

<!-- ================================================== -->



jQuery(document).ready(function(){ "use strict";



		function blogOption() {

			jQuery('.post-article').each(function(){



				var baseHeight = jQuery(this).find('.thumbnail-article').height();



				jQuery(this).css('min-height',baseHeight + 10);



			});

		};



    jQuery('.breadcrumb-container').each(function(){



      if (jQuery(this).find('.nav-posts').length > 0) {

        jQuery(this).css('margin-right','90px')

      };



    });



		blogOption();



		jQuery(window).resize(function(){

			blogOption();

		});



});



<!-- ================================================== -->

<!-- =============== END BLOG OPTION JS ================ -->

<!-- ================================================== -->



<!-- ================================================== -->

<!-- =============== START ROYAL SLIDER ================ -->

<!-- ================================================== -->



jQuery(document).ready(function(){ "use strict";



    jQuery('.rsClubix').royalSlider({

        arrowsNavAutoHide: false,

        autoScaleSliderHeight: 500,

        thumbsFitInViewport: false,

        startSlideId: 0,

        globalCaption: false,

        autoScaleSlider: true,

        loop: false,

        navigateByClick: true,

        arrowsNav:true,

        arrowsNavHideOnTouch: true,

        controlNavigation: false,

        preloadNearbyImages:true,

        imageScalePadding: 0,

        video: {

            autoHideBlocks: false,

            autoHideArrows: true,

            youTubeCode: '<iframe src="http://www.youtube.com/embed/%id%?rel=1&autoplay=1&showinfo=0" frameborder="no"></iframe>',

            vimeoCode: '<iframe src="http://player.vimeo.com/video/%id%?byline=0&amp;portrait=0&amp;autoplay=1" frameborder="no" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>'

        }

    });



});



<!-- ================================================== -->

<!-- =============== END ROYAL SLIDER ================ -->

<!-- ================================================== -->



<!-- ================================================== -->

<!-- =============== START ISOTOPE ================ -->

<!-- ================================================== -->



jQuery(document).ready(function(){ "use strict";



  function isotope() {



    var container = jQuery('.filter-container');



    container.imagesLoaded(function() {

      container.isotope();

    });



    container.isotope();



    var jQueryoptionSets = jQuery('.categories-portfolio .option-set'),

        jQueryoptionLinks = jQueryoptionSets.find('a');



    jQueryoptionLinks.click(function(){

      var jQuerythis = jQuery(this);

      if ( jQuerythis.hasClass('selected') ) {

         return false;

      }

      var jQueryoptionSet = jQuerythis.parents('.option-set');

      jQueryoptionSet.find('.selected').removeClass('selected');

      jQuerythis.addClass('selected');



      var options = {},

          key = jQueryoptionSet.attr('data-option-key'),

          value = jQuerythis.attr('data-option-value');

      value = value === 'false' ? false : value;

      options[ key ] = value;

      if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {

        changeLayoutMode( jQuerythis, options )

      } else {

        container.isotope( options );

      }



        return false;

    });



    function hoverEvents() {



      jQuery(this).css('overflow','inherit')



    };



    function unHoverEvents() {



      jQuery(this).css('overflow','hidden')



    };



    container.hover(hoverEvents,unHoverEvents);



  };



  isotope();



  jQuery(window).resize(function(){



    isotope();



  });



});



<!-- ================================================== -->

<!-- =============== END ISOTOPE ================ -->

<!-- ================================================== -->



<!-- ================================================== -->

<!-- =============== START CANCEL BUTTONS ================ -->

<!-- ================================================== -->



jQuery(document).ready(function(){ "use strict";



  jQuery('article.simple-event.end .right > a , .event-widget figure > section > div a.canceled , .breadcrumb-container .nav-posts.canceled , .events-widget article .right .buy.canceled a').click(function(event){



    event.preventDefault();



  });



});



<!-- ================================================== -->

<!-- =============== END CANCEL BUTTONS ================ -->

<!-- ================================================== -->



<!-- ================================================== -->

<!-- =============== START PRETTYPHOTO ================ -->

<!-- ================================================== -->



jQuery("*[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:9999, autoplay_slideshow: false});



<!-- ================================================== -->

<!-- =============== END PRETTYPHOTO ================ -->

<!-- ================================================== -->



<!-- ================================================== -->

<!-- =============== START OWL CAROUSEL ================ -->

<!-- ================================================== -->



jQuery(document).ready(function(){ "use strict";



  jQuery('.owl-albums').owlCarousel({

    items:1,

    loop:false,

    margin:10,

    lazyLoad:true,

    merge: true,

    nav: true,

    navText: ['<i class="fa fa-caret-left"></i>','<i class="fa fa-caret-right"></i>'],

    responsive:{

      960:{

        items:2

      }

    }

  });



    jQuery('.owl-event-widget').owlCarousel({

        items:1,

        loop:false,

        margin:10,

        lazyLoad:true,

        merge: true,

        nav: true,

        navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']

    });



  jQuery('.owl-events-albums').owlCarousel({

    items:1,

    loop:false,

    margin:20,

    lazyLoad:true,

    merge: true,

    nav: true,

    responsive:{

      1600:{

        items:7

      },

      1366:{

        items:5

      },

      1024:{

        items:4

      },

      768:{

        items:3

      },

      480:{

        items:2

      },

      330:{

        items:1

      }

    }

  });



  // if (jQuery(window).width() > 1600) {

  //   if (jQuery('.owl-stage .owl-item').size() < 7) {

  //     jQuery('.owl-events-albums').addClass('center-items');

  //   } else {

  //     jQuery('.owl-events-albums').removeClass('center-items');

  //   };

  // } else {

  //   jQuery(window).resize(function(){

  //       if (jQuery(window).width() > 1600) {

  //         if (jQuery('.owl-stage .owl-item').size() < 7) {

  //           jQuery('.owl-events-albums').addClass('center-items');

  //         } else {

  //           jQuery('.owl-events-albums').removeClass('center-items');

  //         };

  //       }

  //   });

  // };



  // if (jQuery(window).width() > 1024) {

  //   if (jQuery('.owl-stage .owl-item').size() < 4) {

  //     jQuery('.owl-events-albums').addClass('center-items');

  //   } else {

  //     jQuery('.owl-events-albums').removeClass('center-items');

  //   };

  // } else {

  //   jQuery(window).resize(function(){

  //       if (jQuery(window).width() > 1024) {

  //         if (jQuery('.owl-stage .owl-item').size() < 4) {

  //           jQuery('.owl-events-albums').addClass('center-items');

  //         } else {

  //           jQuery('.owl-events-albums').removeClass('center-items');

  //         };

  //       }

  //   });

  // };



  // if (jQuery(window).width() > 768) {

  //   if (jQuery('.owl-stage .owl-item').size() < 3) {

  //     jQuery('.owl-events-albums').addClass('center-items');

  //   } else {

  //     jQuery('.owl-events-albums').removeClass('center-items');

  //   };

  // } else {

  //   jQuery(window).resize(function(){

  //       if (jQuery(window).width() > 768) {

  //         if (jQuery('.owl-stage .owl-item').size() < 3) {

  //           jQuery('.owl-events-albums').addClass('center-items');

  //         } else {

  //           jQuery('.owl-events-albums').removeClass('center-items');

  //         };

  //       }

  //   });

  // };



  // if (jQuery(window).width() > 480) {

  //   if (jQuery('.owl-stage .owl-item').size() < 2) {

  //     jQuery('.owl-events-albums').addClass('center-items');

  //   } else {

  //     jQuery('.owl-events-albums').removeClass('center-items');

  //   };

  // } else {

  //   jQuery(window).resize(function(){

  //       if (jQuery(window).width() > 480) {

  //         if (jQuery('.owl-stage .owl-item').size() < 2) {

  //           jQuery('.owl-events-albums').addClass('center-items');

  //         } else {

  //           jQuery('.owl-events-albums').removeClass('center-items');

  //         };

  //       }

  //   });

  // };



});



<!-- ================================================== -->

<!-- =============== END OWL CAROUSEL ================ -->

<!-- ================================================== -->



<!-- ================================================== -->

<!-- =============== START AFFIX MENU ================ -->

<!-- ================================================== -->



jQuery(document).ready(function(){ "use strict";



    var menuBeforeAffix = jQuery('.header').outerHeight();



    jQuery('.menu-affix').affix({

    offset: {

      top: menuBeforeAffix

    }

    });



    jQuery('.menu-affix').on('affix-top.bs.affix', function () {

        jQuery('.menu-affix').prev('.before-affix-menu').remove();

    });



    jQuery('.menu-affix').on('affix.bs.affix', function () {

        jQuery('.menu-affix').before('<div class="before-affix-menu"></div>');

    });



});



<!-- ================================================== -->

<!-- =============== END AFFIX MENU ================ -->

<!-- ================================================== -->



<!-- ================================================== -->

<!-- =============== START WOOCOMMERCE JS ================ -->

<!-- ================================================== -->



jQuery('.woocommerce-tabs .entry-content .comment-respond .comment-form span a').click(function(event){ "use strict";

  event.preventDefault();

  jQuery('.woocommerce-tabs .entry-content .comment-respond .comment-form span a').removeClass('active in');

  jQuery(this).addClass('active in');

});



function starRate() {

    jQuery('.woocommerce-tabs .entry-content .comment-respond .comment-form span a.active').each(function(){

        jQuery(this).prev().addClass('hover-02')

        jQuery(this).prev().prev().addClass('hover-02')

        jQuery(this).prev().prev().prev().addClass('hover-02')

        jQuery(this).prev().prev().prev().prev().addClass('hover-02')

        jQuery(this).next().removeClass('hover-02')

        jQuery(this).next().next().removeClass('hover-02')

        jQuery(this).next().next().next().removeClass('hover-02')

        jQuery(this).next().next().next().next().removeClass('hover-02')

    });

};

setInterval(starRate, 10);

function hover5() {

    jQuery(this).prev().addClass('hover')

    jQuery(this).prev().prev().addClass('hover')

    jQuery(this).prev().prev().prev().addClass('hover')

    jQuery(this).prev().prev().prev().prev().addClass('hover')

};

function unHover5() {

    jQuery(this).prev().removeClass('hover')

    jQuery(this).prev().prev().removeClass('hover')

    jQuery(this).prev().prev().prev().removeClass('hover')

    jQuery(this).prev().prev().prev().prev().removeClass('hover')

};

jQuery('.woocommerce-tabs .entry-content .comment-respond .comment-form span a').hover(hover5,unHover5);



jQuery("#shiptobilling .input-checkbox").change(function() {

   if(this.checked) {

       jQuery('.shipping_address').slideUp();

   } else {

       jQuery('.shipping_address').slideDown();

   }

});



jQuery("#createaccount").change(function() {

   if(this.checked) {

       jQuery('.create-account').slideDown();

   } else {

       jQuery('.create-account').slideUp();

   }

});



jQuery('.payment_methods li').click(function() {

    jQuery('.payment_methods li').find('.payment_box').removeClass('active-box');

    jQuery(this).find('.payment_box').addClass('active-box');

});



<!-- ================================================== -->

<!-- =============== END WOOCOMMERCE JS ================ -->

<!-- ================================================== -->



<!-- ================================================== -->

<!-- =============== START SELECT2 ================ -->

<!-- ================================================== -->



jQuery(".chzn-done").select2();



<!-- ================================================== -->

<!-- =============== END SELECT2 ================ -->

<!-- ================================================== -->



<!-- ================================================== -->

<!-- =============== START NICESCROLL ================ -->

<!-- ================================================== -->



// jQuery(document).ready(function(){



//   jQuery('body.nicescroll , .ablums-posts-right article .right , .filter-container.ablums-posts-bottom article .right , .post-article.single-post .content-album-article .right , .base-player .playlist-container').niceScroll();



// });



<!-- ================================================== -->

<!-- =============== END NICESCROLL ================ -->

<!-- ================================================== -->




<!-- ================================================== -->

<!-- =============== START SHOP PRODUCTS ================ -->

<!-- ================================================== -->



jQuery(document).ready(function(){ "use strict";



  function prodHeight() {



    jQuery('li.product').each(function(){



      var prodH = jQuery(this).outerHeight();



      jQuery(this).find('.product-buttons').css('height', prodH)



    });



  };


  prodHeight();
  

  jQuery(window).resize(function(){



    prodHeight();



  });



  jQuery(window).load(prodHeight);



});



<!-- ================================================== -->

<!-- =============== END SHOP PRODUCTS ================ -->

<!-- ================================================== -->