// JavaScript Document


var windowW = 630;
if (document.body && document.body.offsetWidth) {
 windowW = document.body.offsetWidth;
}
if (document.compatMode=='CSS1Compat' &&
    document.documentElement &&
    document.documentElement.offsetWidth ) {
 windowW = document.documentElement.offsetWidth;
}
if (window.innerWidth && window.innerHeight) {
 windowW = window.innerWidth;
}


var $overlay = jQuery.noConflict();

$overlay(function(){	
	if (windowW > 767) {
				  
	$overlay('.portfolio-item a').hover(
		function () {
			//show overlay
			$overlay('.overlay', this).fadeIn(200);

		}, 
		function () {
			//hide overlay
			$overlay('.overlay', this).fadeOut(200);			
		}
	);
	}
	
	if (windowW <768) {
			$overlay('.overlay').css("display","visible");
	}
});