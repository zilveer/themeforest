var zoom = 16;
var latitude = 41.040585;
var longitude = 28.970257;


jQuery(window).bind("load", function () {
    var timeout = setTimeout(function () {
        //jQuery(".product-mini-gallery img").trigger("loadImagesNow");
        jQuery(".brands-slider img").trigger("loadImagesNow");
        checkMiniGalleries();
    }, 1000);
});


jQuery(window).load(function () {

//Checkbox custom CSS


    if (jQuery('.md-check').length > 0) {
        jQuery('.md-check').iCheck({
            checkboxClass: 'md-check'

        });
    }


    //Featured, Arrival Tab controller


    jQuery('.panel-title > a').click(function (e) {
        e.preventDefault();
        jQuery('.panel-collapse.in').collapse('hide');


        var targetAccordion = jQuery(jQuery(this).attr('href'));

        targetAccordion.collapse('show');


    });


//PlaceHolders controller for input

    jQuery('input,textarea').focus(function () {
        jQuery(this).data('placeholder', jQuery(this).attr('placeholder'))
        jQuery(this).attr('placeholder', '');
    });
    jQuery('input,textarea').blur(function () {
        jQuery(this).attr('placeholder', jQuery(this).data('placeholder'));
    });


//DropDown Menu

    jQuery(".top-menu .dropdown").hover(
        function () {
            jQuery(this).addClass('open');
        },
        function () {
            jQuery(this).removeClass('open');
        }
    );


//Mega Menu

    jQuery('.mega-menu > a').hover(

        function () {

            jQuery('.top-menu .dropdown.open').removeClass('open');

            jQuery(this).parent().addClass('active');

            jQuery(this).parent().find('.mega-menu-holder').addClass('shown').fadeIn(0);


        },
        function (event) {
            trgt = jQuery(event.relatedTarget);

            if (!trgt.hasClass('shown')) {

                jQuery(this).parent().find('.mega-menu-holder.shown').fadeOut(0).removeClass('shown');
                jQuery(this).parent().removeClass('active');
            }


        }

    );


    jQuery('.mega-menu-holder').mouseleave(function (event) {


        if (jQuery(this).hasClass('shown')) {
            jQuery(this).fadeOut(0).removeClass('shown');
            jQuery(this).parent().removeClass('active');
        }
    });


//Top menu select (responsive mode) controller


    jQuery('.top-drop-menu').change(function () {
        var loc = (jQuery(this).find('option:selected').val());
        window.location = loc;

    });

//Google Map Activator
    var mapIsNotActive = true;
    setupCustomMap();

    jQuery('.payment-method-buttons button').click(function (e) {
        e.preventDefault();
        jQuery(this).toggleClass('selected');
    });
    jQuery('.section-shopping-cart-page .cart-item .close-btn').click(function (event) {
        event.preventDefault();
        el = jQuery(this).parent().parent();
        el.fadeOut(function () {
            el.remove();
        });
    });


    function setupCustomMap() {
        if (jQuery('.map-holder').length > 0 && mapIsNotActive) {

            var styles = [
                {
                    "featureType": "landscape",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "visibility": "simplified"
                        },
                        {
                            "color": "#E6E6E6"
                        }
                    ]
                },
                {
                    "featureType": "administrative",
                    "stylers": [
                        {
                            "visibility": "simplified"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "visibility": "on"
                        },
                        {
                            "saturation": -100
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#808080"
                        },
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "stylers": [
                        {
                            "color": "#CECECE"
                        },
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "stylers": [
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#E5E5E5"
                        },
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "road.local",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        },
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {}
            ];
            if (jQuery('.map').hasClass('center')) {
                var lt = (latitude);
                var ld = (longitude);
            } else {
                var lt = (latitude + 0.0027);
                var ld = (longitude - 0.010);
            }


            var options = {
                mapTypeControlOptions: {
                    mapTypeIds: ['Styled']
                },
                center: new google.maps.LatLng(lt, ld),
                zoom: zoom,
                disableDefaultUI: true,
                scrollwheel: false,
                mapTypeId: 'Styled'
            };
            var div = document.getElementById('map');


            var map = new google.maps.Map(div, options);

            var styledMapType = new google.maps.StyledMapType(styles, {
                name: 'Styled'
            });
            var image = 'images/contactMarker.png';
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(latitude, longitude),
                map: map,
                icon: image
            });
            map.mapTypes.set('Styled', styledMapType);

            mapIsNotActive = false;


        }

    }


//    Lightbox activator

    if (jQuery('a[data-rel="prettyphoto"]').length > 0) {
        jQuery('a[data-rel="prettyphoto"]').prettyPhoto();
    }


//SinglePage slide activator
    if (jQuery('.single-product-slider').length > 0) {

        var singlePSlider = jQuery(".single-product-slider").carouFredSel({
            auto: false
        });

        jQuery(".single-product-gallery .next-btn").click(function (event) {
            event.preventDefault();
            jQuery('.single-product-slider').trigger("next", 1);

        });


        jQuery(".single-product-gallery .prev-btn").click(function (event) {
            event.preventDefault();
            jQuery('.single-product-slider').trigger("prev", 1);

        });


        if (jQuery('.single-product-vertical-gallery').length > 0) {

            jQuery('.single-product-vertical-gallery ul').carouFredSel({
                direction: 'up',
                auto: false,
                items: 4,
                circular: true
            });

            jQuery(".single-product-vertical-gallery .up-btn").click(function (event) {
                event.preventDefault();
                jQuery('.single-product-vertical-gallery ul').trigger("next", 1);

            });


            jQuery(".single-product-vertical-gallery .down-btn").click(function (event) {
                event.preventDefault();
                jQuery('.single-product-vertical-gallery ul').trigger("prev", 1);

            });


            jQuery(".single-product-vertical-gallery .vertical-gallery-item").click(function (event) {
                event.preventDefault();
                tid = jQuery(this).attr('href');
                targetSlide = jQuery(".single-product-gallery-item" + tid);

                singlePSlider.trigger('slideTo', targetSlide);

            });

        }


//        Horizontal Single page gallery

        if (jQuery('.single-product-horizontal-gallery').length > 0) {
            jQuery('.single-product-horizontal-gallery ul').carouFredSel({

                auto: false,

                circular: true
            });

            jQuery(".single-product-horizontal-gallery .next-btn").click(function (event) {
                event.preventDefault();
                jQuery('.single-product-horizontal-gallery ul').trigger("next", 1);

            });


            jQuery(".single-product-horizontal-gallery .prev-btn").click(function (event) {
                event.preventDefault();
                jQuery('.single-product-horizontal-gallery ul').trigger("prev", 1);

            });


            jQuery(".single-product-horizontal-gallery .horizontal-gallery-item").click(function (event) {
                event.preventDefault();
                tid = jQuery(this).attr('href');
                targetSlide = jQuery(".single-product-gallery-item" + tid);

                singlePSlider.trigger('slideTo', targetSlide);

            });

        }
    }


//Color Options background color setters (radio buttons)
    if (jQuery('.color-option').length > 0) {
        jQuery('.color-option').each(function () {

            color = jQuery(this).attr('data-color');
            jQuery(this).css('background-color', color);
        });

    }


//Rating Star activator
    /*
     if (jQuery('.star').length > 0) {
     jQuery('.star').raty({
     starOff: 'images/star-off.png',
     starOn: 'images/star-on.png',
     score: function() {
     return jQuery(this).attr('data-score');
     }
     });
     }*/


//Sidebar Price Slider
    if (jQuery('.price-slider').length > 0) {
        jQuery('.price-slider').slider({
            min: 100,
            max: 700,
            step: 10,
            value: [100, 400],
            handle: "square"

        });
    }


//Sidebar widget activator
    if (jQuery('.accordion-widget').length > 0) {
        jQuery('.category-accordions .accordion-body').parent().find('.accordion-toggle').toggleClass('collapsed');

        jQuery('.category-accordions .accordion-body').collapse("hide");


        jQuery('.accordion-body').on('hidden', function () {


        });

        jQuery('.accordion-body').on('shown', function () {

        });

    }


    //prodLazy();
//Product mini gallery


    jQuery(document).on("click", ".mini-prev", function (event) {
        event.preventDefault();
        jQuery(this).parent().find('.product-mini-gallery').trigger("prev", 1);
    });
    jQuery(document).on("click", ".mini-next", function (event) {
        event.preventDefault();
        jQuery(this).parent().find('.product-mini-gallery').trigger("next", 1);
    });


//Grid/list buttons switchers on product sidebar page
    if (jQuery('.grid-list-buttons').length > 0) {

        setTimeout(checkMiniGalleries, 200);
    }

    jQuery('.grid-list-buttons a').click(function (e) {
        e.preventDefault();
        setTimeout(checkMiniGalleries, 200);

    });


//Brand Slider activator
/*
    if (jQuery(".brands-slider").length > 0) {
        jQuery(".brands-slider img").lazyload({
            event: "loadImagesNow",
            effect: "fadeIn"
        });
    }

    allBrandItems = jQuery(".brands-slider img").length;
    jQuery(".brands-slider img").each(function (i) {

        src = jQuery(this).attr('src');
        jQuery(this).attr('data-original', src);
        jQuery(this).attr('src', "http://placehold.it/264x81/ffffff/333333/&text=Loading...");


        if (i + 1 >= allBrandItems) {

            startBrandsSlider();

        }
    });
*/
    startBrandsSlider();
    function startBrandsSlider() {
        jQuery('.section-brands-slider .brands-slider').carouFredSel({
            auto: false
        });


        jQuery(".section-brands-slider .brands-slider").parent().parent().find('.brands-next').click(function (event) {
            event.preventDefault();
            jQuery(this).parent().find('.brands-slider').trigger("next", 1);

        });

        jQuery(".section-brands-slider .brands-slider").parent().parent().find('.brands-prev').click(function (event) {
            event.preventDefault();
            jQuery(this).parent().find('.brands-slider').trigger("prev", 1);

        });

    }


//Image lazy activator
    if (jQuery("img.lazy").length > 0) {
        allImgs = jQuery("img.lazy").length;
        jQuery("img.lazy").each(function (i) {

            src = jQuery(this).attr('src');
            jQuery(this).attr('data-original', src);
            if (i + 1 >= allImgs) {

                jQuery("img.lazy").lazyload({
                    effect: "fadeIn"
                });

            }


        });


    }


//    Footer products image lazy activator
    if (jQuery(".footer-products").length > 0) {
        jQuery(".footer-products img").lazyload({
            effect: "fadeIn"
        });

    }


//    Tabs controller
    jQuery('.active-tab').click(function (event) {
        event.preventDefault();
    });
    jQuery('#homepage-products-tab .nav-tabs a.tab-control').click(function (event) {
        event.preventDefault();
        parentEl = jQuery(this).parent().parent().parent().parent();
        parentEl.find('.active-tab').text(jQuery(this).text());


        //jQuery("#homepage-products-tab  .active").removeClass('active');
        jQuery(this).tab('show');
        parentEl.addClass('active');


        if (parentEl.find('.hover-holder li.active').length > 0) {
            parentEl.find('.nav-tabs > li').addClass('active');
        }


        setTimeout(function () {
            checkMiniGalleries();

        }, 200);

    });


    function clearAnimations() {

        jQuery('.flex-caption .texts-holder:before,.flex-caption .texts-holder:after').animate({
            'opacity': 0
        });
        jQuery('.animated.bounceInUp').each(function () {
            jQuery('.animated.bounceInUp').removeClass('animated').removeClass('bounceInUp');
        });

        jQuery('.animated.bounceOutUp').each(function () {
            jQuery('.animated.bounceOutUp').removeClass('animated').removeClass('bounceOutUp');
        });


        jQuery('.animated.bounceInLeft').each(function () {
            jQuery('.animated.bounceInLeft').removeClass('animated').removeClass('bounceInLeft');
        });


    }


//    Homepage 1 slider activator
    setupSliderStyle1();

    function setupSliderStyle1() {


        if (jQuery('.flexslider').length > 0) {
            jQuery('.flexslider').flexslider({
                prevText: "",
                nextText: "",
                slideshow: true,
                start: function (slider) {
                    jQuery('.flexslider').find('.preloader').removeClass('loading');
                    cs = slider.find('.slide').eq(slider.currentSlide);


                    bl = cs.find('.flex-caption .back-layer');
                    flimg = cs.find('.flex-caption .front-layer .image');
                    fltxt = cs.find('.flex-caption .front-layer .texts-holder');


                    bl.find('.anim').addClass('animated bounceInUp');


                    setTimeout(function () {


                        flimg.find('.anim').addClass('animated bounceInLeft');


                    }, 500);

                    setTimeout(function () {


                        fltxt.find('.anim').addClass('animated bounceInUp');


                    }, 800);


                },
                after: function (slider) {
                    jQuery('.flexslider').find('.preloader').removeClass('loading');
                    cs = slider.find('.slide').eq(slider.currentSlide);


                    bl = cs.find('.flex-caption .back-layer');
                    flimg = cs.find('.flex-caption .front-layer .image');
                    fltxt = cs.find('.flex-caption .front-layer .texts-holder');

                    bl.find('.anim').addClass('animated bounceInUp');

                    setTimeout(function () {


                        flimg.find('.anim').addClass('animated bounceInLeft');


                    }, 500);

                    setTimeout(function () {


                        fltxt.find('.anim').addClass('animated bounceInUp');


                    }, 800);

                },
                before: function (slider) {
                    jQuery('.flexslider').find('.preloader').addClass('loading');
                    cs = slider.find('.slide').eq(slider.currentSlide);
                    el = cs.find('.flex-caption div');
                    bl = cs.find('.flex-caption .back-layer');
                    fl = cs.find('.flex-caption .front-layer');
                    clearAnimations();
                    fl.find('.anim').addClass('animated bounceOutUp');

                    bl.find('.anim').addClass('animated bounceOutUp');


                }
            });

        }

    }


//    Top page cart close button
    jQuery('.top-cart-holder .hover-holder .remove-item').click(function (event) {
        event.preventDefault();
        jQuery(this).parent().parent().fadeOut(function () {
            jQuery(this).remove();
        });
    });


//Contact form setup

    checkContactForm();
    function checkContactForm() {
        if (jQuery(".contact-form").length > 0) {


            //  triggers contact form validation
            var formStatus = jQuery(".contact-form").validate();
            //   ===================================================== 
            //sending contact form
            jQuery(".contact-form").submit(function (e) {
                e.preventDefault();

                if (formStatus.errorList.length === 0) {
                    jQuery(".contact-form .submit").fadeOut(function () {
                        jQuery('#loading').css('visibility', 'visible');
                        jQuery.post('submit.php', jQuery(".contact-form").serialize(),
                            function (data) {
                                jQuery(".contact-form input,.contact-form textarea").not('.submit').val('');

                                jQuery('.message-box').html(data);


                                jQuery('#loading').css('visibility', 'hidden');
                                jQuery(".contact-form .submit").removeClass('disabled').css('display', 'block');
                            }

                        );
                    });


                }

            });
        }
    }
});

//Mini Gallery Controller "in products"

var miniGallerySliders = new Array();


function checkMiniGalleries() {

    jQuery(document).ready(function (jQuery) {
        indx = jQuery('.tab-pane.active').attr('id');

        if (jQuery('.product-mini-gallery').length > 0) {

            jQuery('.product-mini-gallery').carouFredSel({
                auto: false
            });


        }
    });

}

function prodLazy() {
    jQuery(document).ready(function (jQuery) {
        if (jQuery(".product-mini-gallery").length > 0) {

            allminigalleries = jQuery(".product-mini-gallery img").length;
            jQuery(".product-mini-gallery img").each(function (i) {

                src = jQuery(this).attr('src');
                jQuery(this).attr('data-original', src);
                jQuery(this).attr('src', "http://placehold.it/212x218/ffffff/dddddd/&text=Loading...");


                if (i + 1 >= allminigalleries) {
                    checkMiniGalleries();

                }
            });
            jQuery(".product-mini-gallery img").lazyload({
                event: "loadImagesNow",
                effect: "fadeIn"
            });
        }
    });
}