/*
 * Slider Lite jQuery
 * http://themefocus.co
 *
 * Copyright 2012, ThemeFocus
 */
(function($) {
	"use strict";
    var SlideLite = function(element, options){
		
		var settings = $.extend({}, options);
		
		var items = $(element).find('img');
		var index = 0;
		var before = 0;
		var canClick = true;
		
		if(items.length > 1) $(element).append('<span class="prev"></span><span class="next"></span>');
		
		$(items).each(function(id, element) {
            if(id !== 0) $(element).fadeOut(0);
        });
		
		$(element).find('.prev').click(function(e) {
			canClick = false;
            index += -1;
			if(index < 0) index = items.length - 1;
			freshImages();
        });
		
		$(element).find('.next').click(function(e) {
			canClick = false;
            index += 1;
			if(index > items.length - 1) index = 0;
			freshImages();
        });
		
		function freshImages(){
			if(before == index){
				canClick = true;
				return false;
			}
			$(items[before]).fadeOut(400);
			$(items[index]).fadeIn(800,'',function(){canClick = true;});
			before = index;
		}
	 };
	
	$.fn.slideLite = function(options){
		 return this.each(function(key, value){
            var slideLite = new SlideLite(this, options);
        });
	};
})(jQuery);