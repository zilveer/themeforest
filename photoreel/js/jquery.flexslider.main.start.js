jQuery(window).load(function() {
/*global jQuery:false */
"use strict";
	
  jQuery('.mainflex').flexslider({
	animation: "slide",
	slideshow: true,                //Boolean: Animate slider automatically
	slideshowSpeed: 10000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
	animationDuration: 900
    });
  
});