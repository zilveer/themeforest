jQuery(document).ready(function($) {

	var ww = window.innerWidth;

	$(function(){
		$(".toggleMenu").click(function(e) {
			e.preventDefault();
			$(this).toggleClass("menu-active");
			$("#primary-main-menu").toggle();
		});
		adjustMenu();
	});

	$(window).bind('resize orientationchange', function() {
		ww = window.innerWidth;
		adjustMenu();
	});

	var adjustMenu = function() {
		if (ww < 979) {
			if (!$(".toggleMenu").hasClass("menu-active")) {
				$("#primary-main-menu").hide();
			} else {
				$("#primary-main-menu").show();
			}
			$("#primary-main-menu li").unbind('mouseenter mouseleave');
			$("#primary-main-menu li a.parent").unbind('click').bind('click', function(e) {
				// must be attached to anchor element to prevent bubbling
				e.preventDefault();
				$(this).parent("li").toggleClass("hover");
			});
		} 
		else if (ww >= 979) {
			$("#primary-main-menu").show();
			$("#primary-main-menu li").removeClass("hover");
			$("#primary-main-menu li a").unbind('click');
			$("#primary-main-menu li").unbind('mouseenter mouseleave').bind('mouseenter mouseleave', function() {
				// must be attached to li so that mouseleave is not triggered when hover over submenu
				$(this).toggleClass('hover');
			});
		}
	}
});