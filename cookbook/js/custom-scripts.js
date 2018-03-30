"use strict";

/**************************************
MB CUSTOM SCRIPTS

EMBED SCROLL PROTECT

***************************************/



/*************************************************************

EMBED SCROLL PROTECT

AUTHOR: Michael Bregnbak
DESCRIPTION: When embedding content sometimes scrolling when mouse is over embedded content will interact with content instead of scrolling page (e.g. zoom on Google Maps). 
The Embed Scroll Protect will protect against this by creating an invisible overlay. Clicking this overlay will remove it and allow users to interact with content.
HOW-TO-USE: $('.some-selector').embedScrollProtect();
Now you can put class some-selector on e.g. Google Maps iframe.

*************************************************************/


	(function ( $ ) {
	 
	    $.fn.embedScrollProtect = function() {

	        // add markup
	        this.wrap('<div class="embed-scroll-protect-wrapper"></div>');
	        this.before('<div class="embed-scroll-protect-overlay"></div>')

	        var $wrapper = $('.embed-scroll-protect-wrapper');
	        var $overlay = $('.embed-scroll-protect-overlay');
	 
	        // add css
	        $wrapper.css({
	        	position: 'relative',
	        });
	        $overlay.css({
	        	position: 'absolute',
	        	top: 0,
	        	left: 0,
	        	width: '100%',
	        	height: '100%',
	        	"z-index": 997,
	        });

	        // on click event
	        $overlay.on('click', function() {
	        	$(this).remove();	
	        })

	        return this;
	 
	    };
	 
	}( jQuery ));

