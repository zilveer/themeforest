/* WPBandit Theme Plugin v1.1 */
(function($,window,document,undefined){var methods={init:function(){},nav_dropdown:function(opts){var options=$.extend({},{"submenu":"ul.sub-menu","speed":"fast"},opts);return this.each(function(){var nav_items=$(this).children("li");nav_items.children(options.submenu).hide();nav_items.hover(function(){$(this).children(options.submenu).slideDown(options.speed);},function(){$(this).children(options.submenu).hide();});});},nav_mobile:function(opts){var options=$.extend({},{"autoHide":true,"before":false,"containerClass":"select-nav","defaultOption":"Navigate to...","deviceWidth":768,"menuClass":"nav","subMenuClass":"sub-menu","subMenuDash":"&ndash;","useWindowWidth":true},opts);var nav=$(this);var navTimeout;$(window).resize(function(){clearTimeout(navTimeout);navTimeout=setTimeout(function(){nav.wpbandit("nav_mobile",options);},500);});var width=(options.useWindowWidth===true)?$(window).width():screen.width;if(width<options.deviceWidth){var container=$('<div class="'+options.containerClass+'"></div>');var menu=$('<select class="'+options.menuClass+'"></select>');if($("."+options.containerClass).length>0){return;}if(options.before){$(this).before(container);}else{$(this).after(container);}menu.appendTo(container);$("<option />",{"selected":"selected","value":"","text":options.defaultOption}).appendTo(menu);$(this).find("a").each(function(){var el=$(this);var optionText=el.text();var optionValue=el.attr("href");var optionParents=el.parents("."+options.subMenuClass);var len=optionParents.length;if(len>0){dash=Array(len+1).join(options.subMenuDash);optionText=dash+" "+optionText;}$("<option />",{"html":optionText,"value":optionValue,"selected":(this.href==window.location.href),}).appendTo(menu);});menu.change(function(){window.location=$(this).find("option:selected").val();});}},sc_accordion:function(opts){var options=$.extend({},{"trigger":".title a","toggle":".inner"},opts);return this.each(function(){var container=$(this);var trigger=container.find(options.trigger);var panels=container.find(options.toggle);panels.hide();trigger.click(function(e){e.preventDefault();var target=$(this).parent().next();if(!target.is(":visible")){panels.slideUp();target.slideDown();container.find(".title").removeClass("active");$(this).parent().addClass("active");}});});},sc_alert:function(opts){var options=$.extend({},{"button":".alert-close"},opts);return this.each(function(){var alert=$(this);var button_close=alert.children(options.button);button_close.click(function(e){e.preventDefault();alert.slideUp();});});},sc_tabs:function(opts){var options=$.extend({},{"tabs":".tab","trigger":".tabs-nav a"},opts);return this.each(function(){var tabs=$(this).find(options.tabs);var trigger=$(this).find(options.trigger);trigger.filter(":first").addClass("active");tabs.filter(":first").show();trigger.click(function(e){e.preventDefault();tabs.hide();tabs.filter(this.hash).show();trigger.removeClass("active");$(this).addClass("active");});});},sc_toggle:function(opts){var options=$.extend({},{"trigger":".title","toggle":".inner"},opts);return this.each(function(){var trigger=$(this).children(options.trigger);var content=$(this).children(options.toggle);trigger.toggle(function(){$(this).addClass("active");content.slideDown();},function(){$(this).removeClass("active");content.slideUp();});});},widget_tabs:function(opts){var options=$.extend({},{"tabs":".wpb-tab","trigger":".wpb-tabs a"},opts);return this.each(function(){var tabs=$(this).find(options.tabs);var trigger=$(this).find(options.trigger);trigger.filter(":first").addClass("active");tabs.filter(":first").show();trigger.click(function(e){e.preventDefault();tabs.hide();tabs.filter(this.hash).show();trigger.removeClass("active");$(this).addClass("active");});});},scroll_top:function(opts){var options=$.extend({},{"speed":"slow"},opts);return this.each(function(){$(this).click(function(e){e.preventDefault();$("html, body").animate({scrollTop:0},options.speed);});});},sticky_footer:function(opts){var options=$.extend({},{"pushDiv":"#sticky-footer-push"},opts);var footer=$(this);wpbPositionFooter(footer,options.pushDiv);$(window).scroll(function(){wpbPositionFooter(footer,options.pushDiv);}).resize(function(){wpbPositionFooter(footer,options.pushDiv);});function wpbPositionFooter(footer,pushDiv){var docHeight=$(document.body).height()-$(pushDiv).height();if(docHeight<$(window).height()){var diff=$(window).height()-docHeight;if(!$(pushDiv).length>0){footer.before('<div id="'+pushDiv.substring(1,pushDiv.length)+'"></div>');}$(pushDiv).height(diff);}}},portfolio_category_filter:function(opts){var options=$.extend({},{"currentClass":"current"},opts);return this.each(function(){var filters=$(this).children("li");filters.find("a").click(function(e){e.preventDefault();var category=$(this).attr("data-filter");filters.removeClass(options.currentClass);$(this).parent().addClass(options.currentClass);$(".isotope").isotope({filter:category});});});},portfolio_size_switcher:function(opts){var options=$.extend({},{"container":"#portfolio","isotope":true},opts);return this.each(function(){var switcherContainer=$(this);var defaultLayout=switcherContainer.attr("data-current");var switcherItems=$(this).find("li");var portfolioItems=$(options.container).children("div");switcherItems.find("a").each(function(e){if(defaultLayout==$(this).attr("data-layout")){$(this).parent().addClass("current");}});switcherItems.find("a").click(function(e){e.preventDefault();switcherItems.removeClass("current");$(this).parent().addClass("current");var oldLayout=switcherContainer.attr("data-current");var newLayout=$(this).attr("data-layout");switcherContainer.attr("data-current",newLayout);portfolioItems.removeClass(oldLayout).addClass(newLayout);if(options.isotope){$(".isotope").isotope("reLayout");}});});},};$.fn.wpbandit=function(method){if(methods[method]){return methods[method].apply(this,Array.prototype.slice.call(arguments,1));}else{if(typeof method==="object"||!method){return methods.init.apply(this,arguments);}else{$.error("Method "+method+" does not exist on jQuery.wpbandit");}}};})(jQuery,window,document);

/* Theme Javascript */
jQuery(document).ready(function($) {
	
	/* Navigation
	/*-----------------------------------------------------------------------*/

	// Nav Dropdown
	$('#nav, .dropdown-btn').wpbandit('nav_dropdown');

	// Nav Mobile
	$('#header-nav').wpbandit('nav_mobile');


	/* Shortcodes
	/*-----------------------------------------------------------------------*/

	// Shortcode : Accordion
	$('.accordion').wpbandit('sc_accordion');

	// Shortcode : Alert
	$('.alert').wpbandit('sc_alert');

	// Shortcode : Tabs
	$('.tabs').wpbandit('sc_tabs');

	// Shortcode : Toggle
	$('.toggle').wpbandit('sc_toggle');


	/* Miscellaneous
	/*-----------------------------------------------------------------------*/

	// fancyBox
	if ($.fn.fancybox) {
		// add fancybox attributes
		$(".gallery-icon a").attr("rel", "gallery");
		$(".gallery-icon a").addClass("fancybox");

		// fancybox
		$('.fancybox').fancybox();

		// fancyBox media helper
		$('.fancybox-media').fancybox({
			openEffect  : 'none',
			closeEffect : 'none',
			helpers : {
				media : {}
			}
		});
	}

	// Table odd rows class
	$('table tr:odd').addClass('alt');

	// Scroll To Top
	$('#footer a#to-top').wpbandit('scroll_top');
	
});

jQuery(window).load(function() {
	// Sticky footer
	setTimeout(function() { 
		jQuery('#footer').wpbandit('sticky_footer');
	}, 200);
});


