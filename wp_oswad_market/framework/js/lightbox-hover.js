jQuery.noConflict();
;(function($) {
	$.fn.showHide = function(params) {
		var defaults = {
			imgSelector : 	'a.thumbnail img',
			divHover	:	'div.fancybox_container',
			speed		:	200
		};
		
		var opts = $.extend({}, defaults, params);
		var timeout = new Array($(this).length);
		$(this).find(opts.divHover).hide();
		$(this).find(opts.imgSelector).bind('mouseover', function(){
			showDetail($(this).parent().parent().find(opts.divHover),opts.speed);
		}).bind('click', function(){
			showDetail($(this).parent().parent().find(opts.divHover),opts.speed);
		}).bind('mouseout', function(){
			hideDetail($(this).parent().parent().find(opts.divHover),opts.speed);
		});

		$(this).find(opts.divHover).bind('mouseover', function(){
			showDetail($(this),opts.speed);
		}).bind('mouseout', function(){
			hideDetail($(this),opts.speed);
		});

		//var timeout = null;
		var hideDetail = function (element,speed) {
			if (timeout[element.attr('id')])
				clearTimeout(timeout[element.attr('id')]);
			timeout[element.attr('id')] = setTimeout(function() {
				timeout[element.attr('id')] = null;
				element.fadeOut('slow');
				//element.slideUp();
			}, speed);
		}

		var showDetail = function (element,speed) {
			if (timeout[element.attr('id')])
				clearTimeout(timeout[element.attr('id')]);
			timeout[element.attr('id')] = setTimeout(function() {
				timeout[element.attr('id')] = null;
				element.fadeIn('slow');
				//element.slideDown();
			}, speed);
		}
	}
})(jQuery);