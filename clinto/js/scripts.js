// DOM Ready
jQuery(document).ready(function() {
	"use strict";

	// Responsive Projects, iPhone/iPad URL bar hides itself on pageload
	if (navigator.userAgent.indexOf('iPhone') !== -1) {
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);
	}

	function hideURLbar() {
		window.scrollTo(0, 0);
	}

	jQuery('#nav_menu > li > .dropdown-toggle').dropdownHover({delay: 500,instantlyCloseOthers: true});

	jQuery('.carousel').carousel({interval: 6000});

	selectnav('nav_menu');
	if ( jQuery('#nav_menu').height() > 50 ) {
		jQuery('#nav_menu').css( 'display', 'none' );
		jQuery('.selectnav').css( 'display', 'block' ).css('margin', '4px 0 0 25px').css('float', 'right');
	}

	jQuery('body').on('touchstart.dropdown', '.dropdown-menu', function (e) {e.stopPropagation();})
		.on('touchstart.dropdown', '.dropdown-submenu', function (e) {e.preventDefault();});

	jQuery('section.body').affix({offset: {top: function() {return jQuery('section.body').offset().top - 130; }}});
	jQuery("section.body").bind('cssClassChanged', function(){
		jQuery('.fixed:first').toggleClass('affix', jQuery(this).hasClass('affix'));
    });

	// Swing effect
	jQuery('.brand').hover(function() {jQuery(this).addClass('swing');}, function() {jQuery(this).removeClass('swing');});
	jQuery('#homepage-three-steps .span4').hover(function() {jQuery(this).find('.icon-bg').addClass('swing');}, function() {jQuery(this).find('.icon-bg').removeClass('swing');});


	jQuery('#sponsor').elastislide();

	jQuery('.author-avatar').popover();
});

jQuery(window).load(function(){
	"use strict";

/*
	jQuery("#masonry").masonry({
		itemSelector: '.entry-event',
		isAnimated: false,
		columnWidth: function( containerWidth ) {
			var col = 300;
			if(containerWidth < 744) {
				col = containerWidth;
			}
			else if(containerWidth === 744) {
				col = 248;
			}
			else if(containerWidth === 960) {
				col = 320;
			}
			else if(containerWidth === 1200) {
				col = 400;
			}
			return col;
		}
	});
*/
});

//********************************************************
// Custom jQuery Plugins
//********************************************************

// outside the scope of the jQuery plugin to
// keep track of all dropdowns
var $allDropdowns = jQuery();

// if instantlyCloseOthers is true, then it will instantly
// shut other nav items when a new one is hovered over
jQuery.fn.dropdownHover = function() {
	"use strict";

	// the element we really care about
	// is the dropdown-toggle's parent
	$allDropdowns = $allDropdowns.add(this.parent());

	return this.each(function() {
		var $this = jQuery(this).parent(),
		defaults = {
			delay: 500,
			instantlyCloseOthers: true
		},
		data = {
			delay: jQuery(this).data('delay'),
			instantlyCloseOthers: jQuery(this).data('close-others')
		},
		options = jQuery.extend(true, {}, defaults, options, data),
		timeout;

		$this.hover(function() {
			if(options.instantlyCloseOthers === true) {
				$allDropdowns.removeClass('open');
			}

			window.clearTimeout(timeout);
			jQuery(this).addClass('open');
		}, function() {
			timeout = window.setTimeout(function() {
				$this.removeClass('open');
			}, options.delay);
		});
	});
};

// Create a closure
(function(){
	"use strict";
	// Your base, I'm in it!
	var originalAddClassMethod = jQuery.fn.addClass;

	jQuery.fn.addClass = function(){
		// Execute the original method.
		var result = originalAddClassMethod.apply( this, arguments );

		// trigger a custom event
		jQuery(this).trigger('cssClassChanged');

		// return the original result
		return result;
	};
})();