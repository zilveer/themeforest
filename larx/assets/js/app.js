(function ($, window, document, undefined) {
    'use strict';

    jQuery(document).ready(function(){

        /* ==============================================
            COUNTDOWN CALL
        =============================================== */

        if(jQuery.find('#counter')[0]) {
            jQuery('#counter').countdown('2015/12/06 12:00:00').on('update.countdown', function(event) {
                var $this = jQuery(this).html(event.strftime(''
                    + '<div class="counter-container"><div class="counter-box first"><div class="number">%-D</div><span>Day%!d<span></div>'
                    + '<div class="counter-box"><div class="number">%H</div><span>Hours</span></div>'
                    + '<div class="counter-box"><div class="number">%M</div><span>Minutes</span></div>'
                    + '<div class="counter-box last"><div class="number">%S</div><span>Seconds</span></div></div>'
                ));
            });
        };                

    });

    jQuery(window).load(function(){
        /* ==============================================
         STICKY NAVBAR CALL
         =============================================== */

        jQuery("#header").sticky({ topSpacing: 0 });

        /* ==============================================
         PAGE PRELOADER
         =============================================== */

        jQuery("#preloader").delay(900).fadeOut(500);

    });       

	/* ==============================================
     CLOSE COLLAPSE NAV ON MOBILE DEVICES
     =============================================== */
	
	jQuery(document).on('click','.navbar-collapse.in',function(e) {
		if( jQuery(e.target).is('a') && jQuery(e.target).attr('class') != 'dropdown-toggle' ) {
			jQuery(this).collapse('hide');
		}
	});
	

})(jQuery, window, document);