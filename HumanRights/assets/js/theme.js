jQuery(document).ready(function() {
    "use strict";
    /**
     * Skip link focus fix
     */
    ( function() {
    	var is_webkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1,
    	    is_opera  = navigator.userAgent.toLowerCase().indexOf( 'opera' )  > -1,
    	    is_ie     = navigator.userAgent.toLowerCase().indexOf( 'msie' )   > -1;

    	if ( ( is_webkit || is_opera || is_ie ) && document.getElementById && window.addEventListener ) {
    		window.addEventListener( 'hashchange', function() {
    			var element = document.getElementById( location.hash.substring( 1 ) );

    			if ( element ) {
    				if ( ! /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) )
    					element.tabIndex = -1;

    				element.focus();
    			}
    		}, false );
    	}
    })();

    /**
     * Responsive Videos
     */
    ( function() {
    	jQuery('.site-content').fitVids();
    })();

    /**
     * Initialise Menu Toggle
     */
    ( function() {
        jQuery('.wpc-menu li.menu-item-has-children').each( function() {
            jQuery(this).prepend('<div class="nav-toggle-subarrow"><i class="fa fa-angle-down"></i></div>');
        })
        jQuery('#nav-toggle').click(
            function () {
                jQuery('.main-navigation .wpc-menu').toggleClass("wpc-menu-mobile");
                if ( jQuery(this).hasClass('nav-toggle-active') ) {
                    jQuery(this).removeClass('nav-toggle-active');
                } else {
                    jQuery(this).addClass('nav-toggle-active');
                }
            }
        );
        jQuery('.nav-toggle-subarrow, .nav-toggle-subarrow .nav-toggle-subarrow').click(
            function () {
                jQuery(this).parent().toggleClass("nav-toggle-dropdown");
            }
        );
    } )();

    /**
     * Parallax Section
     */
    ( function() {
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

        var testMobile = isMobile.any();

        jQuery('.wpc_row_parallax').each(function() {
    		var $this = jQuery(this);
    		var bg    = $this.find('.wpc_parallax_bg');
            
            jQuery(bg).css('backgroundImage', 'url(' + $this.data('bg') + ')');

            if (testMobile == null) {
                jQuery(bg).addClass('not-mobile');
                jQuery(bg).removeClass('is-mobile');
                jQuery(bg).parallax('50%', 0.4);
            }
            else {
                //jQuery(bg).css('backgroundAttachment', 'inherit');
                jQuery(bg).removeClass('not-mobile');
                jQuery(bg).addClass('is-mobile');
            }
        });
    })();

    /**
     * Fixed Navigation.
     */
    ( function() {
        
        if ( header_fixed_setting.fixed_header == '1' ) {
            var header_fixed = jQuery('.fixed-on');
            var p_to_top     = header_fixed.position().top;

            jQuery(window).scroll(function(){
                if(jQuery(document).scrollTop() > p_to_top) {
                    header_fixed.addClass('header-fixed');
                    header_fixed.stop().animate({},300);

                    if ( jQuery('#site-navigation').hasClass('toggled') ) {
                        jQuery('.nav-menu').css({ 'height' : jQuery(window).height() + 'px', 'overflow' : 'auto' });
                        header_fixed.stop().animate({},300); 
                    }

                } else {
                    header_fixed.removeClass('header-fixed');
                    header_fixed.stop().animate({},300); 
                }
            });
        }

    })();

    /**
     * Call magnificPopup when use
     */
    ( function() {
        //WordPress gallery lightbox
        jQuery('.gallery-lightbox').magnificPopup({
            delegate: '.gallery-item a',
            type:'image',
            zoom: {
                enabled:true
            }
        });
    })();

    /**
     * Fix slider padding issue.
     */
    ( function() {
        jQuery('.rev_slider_wrapper').parents('.vc_row').find('.vc_col-sm-12').css({"padding-left": "0px","padding-right": "0px"});
    })();

    /**
     * Back To Top
     */
    ( function() {
        jQuery('#btt').fadeOut();
        jQuery(window).scroll(function() {
            if(jQuery(this).scrollTop() != 0) {
                jQuery('#btt').fadeIn();    
            } else {
                jQuery('#btt').fadeOut();
            }
        });

        jQuery('#btt').click(function() {
            jQuery('body,html').animate({scrollTop:0},800);
        });
    })();

});
