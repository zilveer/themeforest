/*
 * Plugin
 */

/* *********************************************************************************************************************
 * Multiple dropdown menu
 */
jQuery.fn.multipleDropDown = function() {

	var nav = this;

	// Check all menu items
	nav.children('li').each(function() {

        var me = jQuery(this);

		// If exist child ul
		if ( me.find('ul').length > 0  ) {

            me.children('a').click(function(e){
				if (jQuery(this).attr('href') == '#'){
					e.preventDefault();
				}
			});

			// Add arrow for current parent
			var currItem = me.children('a');
			currItem.addClass('sub');

			// Show 1st level submenu
			var currChild = me.children('ul');
			var hasActive = false;

			// If exists active child mark all parents active
			if ( me.find('.active').length > 0  ) {
                me.addClass('active');
			}

			// Over
            var currParent = currItem.parent();
            currParent.hover(function() {

                var me = jQuery(this);
                var me_parent = me.parent();
                var me_submenu = me.children('ul.sub-menu');

				if ( me.hasClass('active') ) {
					hasActive = true;
				}
				else {
                    me.addClass('active');
				}

				currChild.stop( true, true ).fadeIn(100);


                var submenu_width = me_parent.offset().left + me_parent.width() + currChild.width();

                if ( me_parent.hasClass('sub-menu') ){
                    me_submenu.css({
                        'left': -1 + 1 + me_parent.width()
                    });
                }

                if ( me_parent.hasClass('sub-menu') && submenu_width >= jQuery(window).width() ){
                    me_submenu.css({
                        'left': -1 * currChild.width()
                    });
                }

			}, function() {
				if ( !hasActive ){
                    currParent.removeClass('active');
				}

				currChild.stop( true, true ).hide();

				hasActive = false;
			});
		}
	});

};



/* *********************************************************************************************************************
 * String width
 */
jQuery.fn.textWidth = function(){


    var html_calc = jQuery('#html_calc');

    if (html_calc.length > 0){
        html_calc.css('font-size',jQuery(this).css('font-size'));
        html_calc.html(jQuery(this).html());
    }else{
        var nhtml_calc = jQuery('<span id="html_calc">' + jQuery(this).html() + '</span>');
        nhtml_calc.css('font-size',jQuery(this).css('font-size')).hide();
        nhtml_calc.prependTo('body');
        html_calc = nhtml_calc;
    }

	return html_calc.width();
};



/* *********************************************************************************************************************
 * Same height for boxes - .boxgroup
 */
jQuery.fn.sameHeight = function(){
	return this.height( Math.max.apply(this, jQuery.map( this , function(e){ return jQuery(e).height() }) ) );
};



/* *********************************************************************************************************************
 * Check if element is on viewport
 */

jQuery.fn.isOnScreen = function(){

	var win = jQuery(window);

	var viewport = {
		top : win.scrollTop(),
		left : win.scrollLeft()
	};
	viewport.right = viewport.left + win.width();
	viewport.bottom = viewport.top + win.height();

	var bounds = this.offset();
	bounds.right = bounds.left + this.outerWidth();
	bounds.bottom = bounds.top + this.outerHeight();

	return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));

};



/* *********************************************************************************************************************
 * Smooth scroll
 */

jQuery.fn.smoothScroll = function() {
	var who = this;

	if ( who.length != 0 ) {
		var scrollDel = 750;
		var inScroll = false;

		who.click(function() {
			if ( !inScroll ) {
				var where;

				if ( jQuery(this).attr("href") == '#top' )
					where = 0;
				else
					where = jQuery(this).attr("href");

				jQuery(window).scrollTo(where, {
					duration: scrollDel,
					onAfter: function() {
						inScroll = false;
					}
				});

				inScroll = true;
			}

			return false;
		});
	}
};

/* *********************************************************************************************************************
 * Initialization of google maps
 */

jQuery.fn.initGoogleMaps = function () {

    // LOAD GOOGLE MAPS JS
    var script = document.createElement("script");
    script.type = "text/javascript";
    script.src = "//maps.googleapis.com/maps/api/js?sensor=true&callback=initialize";
    document.body.appendChild(script);

};

/*
 * Viewport - jQuery selectors for finding elements in viewport
 *
 * Copyright (c) 2008-2009 Mika Tuupola
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Project home:
 *  http://www.appelsiini.net/projects/viewport
 *
 */
(function($){$.belowthefold=function(element,settings){var fold=$(window).height()+$(window).scrollTop();return fold<=$(element).offset().top-settings.threshold;};$.abovethetop=function(element,settings){var top=$(window).scrollTop();return top>=$(element).offset().top+$(element).height()-settings.threshold;};$.rightofscreen=function(element,settings){var fold=$(window).width()+$(window).scrollLeft();return fold<=$(element).offset().left-settings.threshold;};$.leftofscreen=function(element,settings){var left=$(window).scrollLeft();return left>=$(element).offset().left+$(element).width()-settings.threshold;};$.inviewport=function(element,settings){return!$.rightofscreen(element,settings)&&!$.leftofscreen(element,settings)&&!$.belowthefold(element,settings)&&!$.abovethetop(element,settings);};$.extend($.expr[':'],{"below-the-fold":function(a,i,m){return $.belowthefold(a,{threshold:0});},"above-the-top":function(a,i,m){return $.abovethetop(a,{threshold:0});},"left-of-screen":function(a,i,m){return $.leftofscreen(a,{threshold:0});},"right-of-screen":function(a,i,m){return $.rightofscreen(a,{threshold:0});},"in-viewport":function(a,i,m){return $.inviewport(a,{threshold:0});}});})(jQuery);