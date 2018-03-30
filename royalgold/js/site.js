jQuery('html').removeClass('no-js');
if (!(('ontouchstart' in window) || (navigator.maxTouchPoints > 0) || (navigator.msMaxTouchPoints > 0))) jQuery('html').addClass('no-touch');

jQuery(document).ready(function () {

	if (jQuery('html').hasClass('no-touch')) jQuery('.tooltip').tip();

	jQuery('.collapse .collapse-title').on('click', function(e){
		var $li = jQuery(this).parent('li'), $ul = $li.parent('.collapse');
		if ($ul.hasClass('only-one-visible')) { // check if only one collapse can be opened at a time
			jQuery('li',$ul).not($li).removeClass('active');
		}
		$li.toggleClass('active');
		jQuery(window).resize();
		e.preventDefault();
	});

	if (jQuery('html').hasClass('no-touch')) {
		jQuery('#menu li').hover(
			function () { jQuery(this).addClass("hover"); },
			function () { jQuery(this).removeClass("hover"); }
		);
	}
	jQuery('#menu li.menu-item-has-children > a, #menu li.page_item_has_children > a, #menu li.current-menu-parent > a').on('click', function (e) {
		var parent = jQuery(e.target).parent();
		if (!parent.parents('.hover').length) {
			jQuery('#menu li.menu-item-has-children, #menu li.page_item_has_children').not(parent).removeClass('hover');
		}
		parent.toggleClass('hover');
		parent.toggleClass('expand-menu');
		e.preventDefault();
	});

	jQuery('#menu.expand-childs li.current-menu-ancestor').addClass('hover expand-menu');

	jQuery('.menu-toggle').on('click', function(e) {
		jQuery('#header').toggleClass('hide-menu');
		return false;
	});

	jQuery('.supersized-fullscreen').on('click', function (e) {
		jQuery('body').toggleClass("expand-supersized");
		jQuery(window).resize();
		e.preventDefault();
	});

});

/* A fix for the iOS orientationchange zoom bug */
!function(a){function m(){d.setAttribute("content",g),h=!0}function n(){d.setAttribute("content",f),h=!1}function o(b){return a.orientation,90==Math.abs(a.orientation)?(h&&m(),void 0):(l=b.accelerationIncludingGravity,i=Math.abs(l.x),j=Math.abs(l.y),0==j||i/j>1.2?h&&n():h||m(),void 0)}var b=navigator.userAgent;if(/iPhone|iPad|iPod/.test(navigator.platform)&&/OS [1-5]_[0-9_]* like Mac OS X/i.test(b)&&b.indexOf("AppleWebKit")>-1&&-1==b.indexOf("CriOS")){var c=a.document;if(c.querySelector){var d=c.querySelector("meta[name=viewport]");if(d){var i,j,l,e=d&&d.getAttribute("content"),f=e+",maximum-scale=1",g=e+",maximum-scale=10",h=!0;a.addEventListener("orientationchange",m,!1),a.addEventListener("devicemotion",o,!1)}}}}(this);

/* personal tooltip script */
(function(a){a.fn.tip=function(b){return this.each(function(){var c={offset:5};b&&a.extend(c,b);var d=a(this),e=a("#tooltip"),f=d.attr("title");return f&&""!=f?(0==e.length&&(e=a('<div id="tooltip"></div>'),e.appendTo("body")),d.removeAttr("title").data("tip",f),d.on("mouseenter",function(){$target=a(this),e.html($target.data("tip")),a(window).width()<1.5*e.outerWidth()&&e.css("max-width",a(window).width()/2);var d=$target.offset().left+$target.outerWidth()/2-e.outerWidth()/2,f=$target.offset().top-e.outerHeight()-c.offset;if(0>d?(d=$target.offset().left+$target.outerWidth()/2-c.offset,e.addClass("left")):e.removeClass("left"),d+e.outerWidth()>a(window).width()?(d=$target.offset().left-e.outerWidth()+$target.outerWidth()/2+c.offset,e.addClass("right")):e.removeClass("right"),0>f){var f=$target.offset().top+$target.outerHeight()+c.offset;e.addClass("top")}else e.removeClass("top");e.css({left:d,top:f,display:"block"}).stop().animate({opacity:0.9},100)}),d.on("mouseleave click",function(){$target=a(this),e.stop().css({opacity:0,display:'none'})}),void 0):!1})}})(jQuery);