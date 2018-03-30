// JavaScript Document
jQuery(document).ready(function() {
    'use strict';

    /************************************************************************************ PARALLAX ENDS */

    /************************************************************************************ STICKY NAVIGATION STARTS */

    jQuery("#navigation").sticky({
        topSpacing: 0
    });

    //

    
    jQuery('.team-popup-modal').appendTo('body');
    jQuery('#team .team-popup-modal').remove();

    /************************************************************************************ STICKY NAVIGATION ENDS */
	
	/************************************************************************************ Fitvids post type Gallery start */

   jQuery(".video").fitVids();

    /************************************************************************************ Fitvids post type Gallery ENDS */

    /************************************************************************************ DROPDOWN HOVER MENU STARTS */    
	
	jQuery('.js-activated').dropdownHover().dropdown();

    /************************************************************************************ DROPDOWN HOVER MENU ENDS */

    /************************************************************************************ ONEPAGE NAVIGATION STARTS */


    /************************************************************************************ ONEPAGE NAVIGATION ENDS */

    /************************************************************************************ PAGE ANIMATED ITEMS STARTS */

   
	jQuery('.animated').appear(function() {
		var elem = jQuery(this);
		var animation = elem.data('animation');
		if (!elem.hasClass('visible')) {
			var animationDelay = elem.data('animation-delay');
			if (animationDelay) {

				setTimeout(function() {
					elem.addClass(animation + " visible");
				}, animationDelay);

			} else {
				elem.addClass(animation + " visible");
			}
		}
	});

    /************************************************************************************ PAGE ANIMATED ITEMS ENDS */


/* ************************************************************************************** Features With Gallery Starts */

    var imgg = jQuery('.wish-gallery-features .gal-img-list ul li:first-child').find('img').attr('data-img');
    jQuery('.gal-img-show').html("<img src='"+imgg+"'>");

jQuery('.wish-gallery-features .gal-img-list ul a').on('click', function(e){
    e.preventDefault();
    var imgg = jQuery(this).find('img').attr('data-img');
    jQuery('.gal-img-show').html("<img src='"+imgg+"' class='img-responsive'>");
});



/* ************************************************************************************** Features With Gallery ends */




    /************************************************************************************ WE BUILD CAROUSEL STARTS */

    //Sort random function

    function random(owlSelector) {
        owlSelector.children().sort(function() {
            return Math.round(Math.random()) - 0.5;
        }).each(function() {
            jQuery(this).appendTo(owlSelector);
        });
    }

if(jQuery().owlCarousel) {

    jQuery(".we-build-carousel").owlCarousel({
        autoPlay: false,
        slideSpeed: 500,
        items: 1,
        itemsDesktop: [1199, 1],
        itemsDesktopSmall: [979, 1],
        itemsTablet: [768, 1],
        itemsMobile: [479, 1],
        autoHeight: true,
        pagination: true,
        navigation: false,
        transitionStyle: "fade",
        navigationText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
    });

}//end check if owl carousel    

    /************************************************************************************ WE BUILD CAROUSEL ENDS */

    /************************************************************************************ PROJECTS CAROUSEL STARTS */

    //Sort random function


    function random(owlSelector) {
        owlSelector.children().sort(function() {
            return Math.round(Math.random()) - 0.5;
        }).each(function() {
            jQuery(this).appendTo(owlSelector);
        });
    }

if(jQuery().owlCarousel) {

    jQuery(".projects-carousel").owlCarousel({
        autoPlay: 5000,
        slideSpeed: 500,
        items: 4,
        itemsDesktop: [1199, 4],
        itemsDesktopSmall: [979, 3],
        itemsTablet: [768, 2],
        itemsMobile: [479, 1],
        autoHeight: true,
        pagination: true,
        navigation: false,
        transitionStyle: "fade",
        navigationText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
    });

}//end if
    /************************************************************************************ PROJECTS CAROUSEL ENDS */

    /************************************************************************************ PICTURES CAROUSEL STARTS */

    //Sort random function
    function random(owlSelector) {
        owlSelector.children().sort(function() {
            return Math.round(Math.random()) - 0.5;
        }).each(function() {
            jQuery(this).appendTo(owlSelector);
        });
    }

if(jQuery().owlCarousel) {

    jQuery(".pictures-carousel").owlCarousel({
        autoPlay: 5000,
        slideSpeed: 500,
        items: 1,
        itemsDesktop: [1199, 1],
        itemsDesktopSmall: [979, 1],
        itemsTablet: [768, 1],
        itemsMobile: [479, 1],
        autoHeight: true,
        pagination: false,
        navigation: true,
        transitionStyle: "fade",
        navigationText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
    });

}//end if
    /************************************************************************************ PICTURES CAROUSEL ENDS */

    /************************************************************************************ OUR CHEFS CAROUSEL STARTS */

    //Sort random function


    function random(owlSelector) {
        owlSelector.children().sort(function() {
            return Math.round(Math.random()) - 0.5;
        }).each(function() {
            jQuery(this).appendTo(owlSelector);
        });
    }

if(jQuery().owlCarousel) {

    jQuery(".our-chefs-carousel").owlCarousel({
        autoPlay: false,
        slideSpeed: 500,
        items: 1,
        itemsDesktop: [1199, 1],
        itemsDesktopSmall: [979, 1],
        itemsTablet: [768, 1],
        itemsMobile: [479, 1],
        autoHeight: true,
        pagination: false,
        navigation: true,
        transitionStyle: "fade",
        navigationText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
    });

}
    /************************************************************************************ OUR CHEFS CAROUSEL ENDS */

    /************************************************************************************ GALLERY CAROUSEL STARTS */

    //Sort random function


    function random(owlSelector) {
        owlSelector.children().sort(function() {
            return Math.round(Math.random()) - 0.5;
        }).each(function() {
            jQuery(this).appendTo(owlSelector);
        });
    }

if(jQuery().owlCarousel) {

    jQuery(".gallery-carousel").owlCarousel({
        autoPlay: false,
        slideSpeed: 500,
        items: 6,
        itemsDesktop: [1199, 6],
        itemsDesktopSmall: [979, 4],
        itemsTablet: [768, 3],
        itemsMobile: [479, 2],
        autoHeight: true,
        pagination: true,
        navigation: false,
        transitionStyle: "fade",
        navigationText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
    });

}
    /************************************************************************************ GALLERY CAROUSEL ENDS */

    /************************************************************************************ OUR SELECTION CAROUSEL STARTS */

    //Sort random function


    function random(owlSelector) {
        owlSelector.children().sort(function() {
            return Math.round(Math.random()) - 0.5;
        }).each(function() {
            jQuery(this).appendTo(owlSelector);
        });
    }

if(jQuery().owlCarousel) {

    jQuery(".our-selection-carousel").owlCarousel({
        autoPlay: false,
        slideSpeed: 500,
        items: 4,
        itemsDesktop: [1199, 4],
        itemsDesktopSmall: [979, 3],
        itemsTablet: [768, 2],
        itemsMobile: [479, 1],
        autoHeight: true,
        pagination: true,
        navigation: false,
        transitionStyle: "fade",
        navigationText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
    });

}
    /************************************************************************************ OUR SELECTION CAROUSEL ENDS */

    /************************************************************************************ BLOG CAROUSEL STARTS */

    //Sort random function
    function random(owlSelector) {
        owlSelector.children().sort(function() {
            return Math.round(Math.random()) - 0.5;
        }).each(function() {
            jQuery(this).appendTo(owlSelector);
        });
    }

if(jQuery().owlCarousel) {

    jQuery(".blog-carousel").owlCarousel({
        autoPlay: false,
        slideSpeed: 500,
        items: 3,
        itemsDesktop: [1199, 3],
        itemsDesktopSmall: [979, 2],
        itemsTablet: [768, 1],
        itemsMobile: [479, 1],
        autoHeight: true,
        pagination: false,
        navigation: true,
        transitionStyle: "fade",
        navigationText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
    });

}
    /************************************************************************************ BLOG CAROUSEL ENDS */

    /************************************************************************************ TESTIMONIALS CAROUSEL STARTS */

    //Sort random function


    function random(owlSelector) {
        owlSelector.children().sort(function() {
            return Math.round(Math.random()) - 0.5;
        }).each(function() {
            jQuery(this).appendTo(owlSelector);
        });
    }

if(jQuery().owlCarousel) {
    
    jQuery(".testimonial-carousel").owlCarousel({
        autoPlay: 5000,
        slideSpeed: 500,
        items: 1,
        itemsDesktop: [1199, 1],
        itemsDesktopSmall: [979, 1],
        itemsTablet: [768, 1],
        itemsMobile: [479, 1],
        autoHeight: true,
        pagination: true,
        navigation: false,
        transitionStyle: "fade",
        navigationText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
    });

}//end if
    /************************************************************************************ TESTIMONIALS CAROUSEL ENDS */

    /************************************************************************************ FITVID STARTS */

    jQuery(".fitvid").fitVids();

    /************************************************************************************ FITVID ENDS */

    /************************************************************************************ TO TOP STARTS */

    jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() > 100) {
            jQuery('.scrollup').fadeIn();
        } else {
            jQuery('.scrollup').fadeOut();
        }
    });

    jQuery('.scrollup').on("click", function() {
        jQuery("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });

    /************************************************************************************ TO TOP ENDS */

    /************************************************************************************ MAGNIFIC POPUP STARTS */


if(jQuery().magnificPopup) {

	
    jQuery('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
        /*disableOn: 700,*/
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });

    jQuery('.image-popup-vertical-fit').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        mainClass: 'mfp-img-mobile',
        image: {
            verticalFit: true
        }

    });

    jQuery('.image-popup-fit-width').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        image: {
            verticalFit: false
        }
    });

    jQuery('.image-popup-no-margins').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        closeBtnInside: false,
        fixedContentPos: true,
        mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
        image: {
            verticalFit: true
        },
        zoom: {
            enabled: true,
            duration: 300 // don't foget to change the duration also in CSS
        }
    });

    jQuery('.simple-ajax-popup-align-top').magnificPopup({
        type: 'inline',
        alignTop: true,
        overflowY: 'scroll' // as we know that popup content is tall we set scroll overflow by default to avoid jump
    });

}





    jQuery(document).ready(function() {

if(jQuery().magnificPopup) {
	
        jQuery('.popup-with-form').magnificPopup({
            type: 'inline',
            preloader: false,
            focus: '#name',

            // When elemened is focused, some mobile browsers in some cases zoom in
            // It looks not nice, so we disable it:
            callbacks: {
                beforeOpen: function() {
                    if (jQuery(window).width() < 700) {
                        this.st.focus = false;
                    } else {
                        this.st.focus = '#name';
                    }
                }
            }
        });

}


    });


    /************************************************************************************ MAGNIFIC POPUP ENDS */

    /************************************************************************************ PRELOADER STARTS */

    jQuery(window).load(function() {

        jQuery('#preloader').fadeOut('slow');

    });

    /************************************************************************************ PRELOADER ENDS */

    /************************************************************************************ MAP STARTS */

    
	(function($) {
        "use strict"; // Start of use strict

        jQuery(document).ready(function() {

            jQuery(window).trigger("resize");

            init_google_map();

        });

    })(jQuery); // End of use strict


    /* ---------------------------------------------
     Google map
     --------------------------------------------- */

    var gmMapDiv = jQuery("#map-canvas");

    function init_google_map() {
        (function($) {

            // Open/Close map        
            jQuery("#see-map").click(function() {
                jQuery(this).toggleClass("js-active");

                if (jQuery("html").hasClass("mobile")) {
                    gmMapDiv.hide();
                    gmMapDiv.gmap3({
                        action: "destroy"
                    }).empty().remove();
                } else {
                    gmMapDiv.slideUp(function() {
                        gmMapDiv.gmap3({
                            action: "destroy"
                        }).empty().remove();
                    })
                }

                gmMapDiv.slideToggle(400, function() {

                    if (jQuery("#see-map").hasClass("js-active")) {
                        jQuery(".google-map").append(gmMapDiv);
                        init_map();
                    }

                });

                setTimeout(function() {
                    jQuery("html, body").animate({
                        scrollTop: jQuery("#see-map").offset().top
                    }, "slow", "easeInBack");
                }, 100);


                return false;
            });
        })(jQuery);
    }



    function init_map() {
        (function($) {
            if (gmMapDiv.length) {

                var gmCenterAddress = gmMapDiv.attr("data-address");
                var gmMarkerAddress = gmMapDiv.attr("data-address");
                var gmColor = gmMapDiv.attr("data-color");


                gmMapDiv.gmap3({
                    action: "init",
                    marker: {
                        address: gmMarkerAddress,
                        options: {
                            icon: wish_path.path + "/images/icons/map-marker.png"
                        }
                    },
                    map: {
                        options: {
                            styles: [{
                                "featureType": "water",
                                "elementType": "geometry",
                                "stylers": [{
                                    "color": gmColor
                                }, {
                                    "lightness": 17
                                }]
                            }, {
                                "featureType": "landscape",
                                "elementType": "geometry",
                                "stylers": [{
                                    "color": gmColor
                                }, {
                                    "lightness": 20
                                }]
                            }, {
                                "featureType": "road.highway",
                                "elementType": "geometry.fill",
                                "stylers": [{
                                    "color": gmColor
                                }, {
                                    "lightness": 17
                                }]
                            }, {
                                "featureType": "road.highway",
                                "elementType": "geometry.stroke",
                                "stylers": [{
                                    "color": gmColor
                                }, {
                                    "lightness": 29
                                }, {
                                    "weight": 0.2
                                }]
                            }, {
                                "featureType": "road.arterial",
                                "elementType": "geometry",
                                "stylers": [{
                                    "color": gmColor
                                }, {
                                    "lightness": 18
                                }]
                            }, {
                                "featureType": "road.local",
                                "elementType": "geometry",
                                "stylers": [{
                                    "color": gmColor
                                }, {
                                    "lightness": 16
                                }]
                            }, {
                                "featureType": "poi",
                                "elementType": "geometry",
                                "stylers": [{
                                    "color": gmColor
                                }, {
                                    "lightness": 21
                                }]
                            }, {
                                "elementType": "labels.text.stroke",
                                "stylers": [{
                                    "visibility": "on"
                                }, {
                                    "color": gmColor
                                }, {
                                    "lightness": 16
                                }]
                            }, {
                                "elementType": "labels.text.fill",
                                "stylers": [{
                                    "saturation": 36
                                }, {
                                    "color": gmColor
                                }, {
                                    "lightness": 40
                                }]
                            }, {
                                "elementType": "labels.icon",
                                "stylers": [{
                                    "visibility": "off"
                                }]
                            }, {
                                "featureType": "transit",
                                "elementType": "geometry",
                                "stylers": [{
                                    "color": gmColor
                                }, {
                                    "lightness": 19
                                }]
                            }, {
                                "featureType": "administrative",
                                "elementType": "geometry.fill",
                                "stylers": [{
                                    "color": gmColor
                                }, {
                                    "lightness": 20
                                }]
                            }, {
                                "featureType": "administrative",
                                "elementType": "geometry.stroke",
                                "stylers": [{
                                    "color": gmColor
                                }, {
                                    "lightness": 17
                                }, {
                                    "weight": 1.2
                                }]
                            }, ],
                            zoom: 14,
                            zoomControl: true,
                            zoomControlOptions: {
                                style: google.maps.ZoomControlStyle.SMALL
                            },
                            mapTypeControl: false,
                            scaleControl: false,
                            scrollwheel: false,
                            streetViewControl: false,
                            draggable: true
                        }
                    }
                });
            }
        })(jQuery);
    }


    /************************************************************************************ MAP ENDS */

    /************************************************************************************ COMING SOON PAGE COUNTER STARTS */

    (function($) {
        "use strict"; // Start of use strict

        var finalDate = '2016/01/01';

        jQuery('div#counter').countdown(finalDate)
            .on('update.countdown', function(event) {

                jQuery(this).html(event.strftime('<span>%D <em>days</em></span>' +
                    '<span>%H <em>hours</em></span>' +
                    '<span>%M <em>minutes</em></span>' +
                    '<span>%S <em>seconds</em></span>'));

            });

    });






	}); //ends jQuery(document).ready

	/************************************************************************************ OVERLAY NAVIGATION ENDS */

	function init() {
		window.addEventListener('scroll', function(e) {
			var distanceY = window.pageYOffset || document.documentElement.scrollTop,
				shrinkOn = 90,
				nav = document.querySelector("nav");
			tc = document.querySelector("div#tc");
			if (distanceY > shrinkOn) {
				classie.add(nav, "smaller");
			} else {
				if (classie.has(nav, "smaller")) {
					classie.remove(nav, "smaller");
				}
			}
			if (distanceY > shrinkOn) {
				classie.add(tc, "hide");
			} else {
				if (classie.has(tc, "hide")) {
					classie.remove(tc, "hide");
				}
			}
		});
	}
	window.onload = init();


	/************************************************************************************ OVERLAY NAVIGATION ENDS */

