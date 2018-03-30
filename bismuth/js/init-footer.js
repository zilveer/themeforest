//======= ScrollTo ========= 
function scrollTo(target){
"use strict";
          var myArray = target.split('#');
          var targetPosition = jQuery('#' + myArray[1]).offset().top;
          jQuery('html,body').animate({ scrollTop: targetPosition}, 'slow');
}

jQuery(document).ready(function() {
"use strict";
//======= PrettyPhoto =========      
        jQuery("a[class^='prettyPhoto']").prettyPhoto({
            social_tools: false,
            theme: 'dark_square'
          });      
//======= Portfolio Flexslider ========= 
          jQuery('.flexslider').flexslider({
            animation: "slide",
            slideshow: true,
            slideshowSpeed: 3500,
            animationSpeed: 1000
          });
//======= Mobile Menu ========= 
 // jQuery(".navi2").setPosition("fixed");
 
 jQuery("#mobile").click(function(){
	jQuery('#mobi-menu').toggleClass('on').toggleClass('off');
	jQuery(this).toggleClass('opened').toggleClass('closed');
 });

});

 //initiating jQuery 
	jQuery(function($) { 
		$(document).ready( function() { 
			//enabling stickUp on the '.navbar-wrapper' class 
			$('.mmenufix').stickUp(); 
		}); 
	});

// Document ready
// $(function() {

//		jQuery("#collapse").hide();
//		jQuery("#collapse-menu").on("click", function () {
		
//		    jQuery("#collapse").slideToggle(300);
//		    return false;
		    
//		}, function () {
		    
//		    jQuery("#collapse").slideToggle(300);
//		    return false;
//		});
// });