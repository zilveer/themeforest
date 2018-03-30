jQuery(document).ready(function() { 
    
	// Drop Down Menu
	jQuery('ul#main-menu').superfish({ 
        delay:       600,
        animation:   {opacity:'show',height:'show'},
        speed:       'fast',
        autoArrows:  true,
        dropShadows: false
    });

	// Gallery Hover Effect
	jQuery(".gallery-item .gallery-thumbnail .zoom-wrapper").hover(function(){		
		jQuery(this).animate({ opacity: 1 }, 300);
	}, function(){
		jQuery(this).animate({ opacity: 0 }, 300);
	});
	
	// PrettyPhoto
	jQuery(document).ready(function(){
		jQuery("a[rel^='prettyPhoto']").prettyPhoto();
	});
	
	// Mobile Menu

	// Create the dropdown base
	jQuery("<select />").appendTo("#main-menu-wrapper");
      
	// Create default option "Go to..."
	jQuery("<option />", {
		"selected": "selected",
		"value"   : "",
		"text"    : goText
	}).appendTo("#main-menu-wrapper select");
      
	// Populate dropdown with menu items
	jQuery("#main-menu a").each(function() {
		var el = jQuery(this);
		jQuery("<option />", {
			"value"   : el.attr("href"),
			"text"    : el.text()
		}).appendTo("#main-menu-wrapper select");
	});
	
	// To make dropdown actually work
	jQuery("#main-menu-wrapper select").change(function() {
		window.location = jQuery(this).find("option:selected").val();
	});
	
	// Quantity Buttons
	jQuery(function() {
		
		jQuery("form .qty-text").numeric();

		jQuery(".plusminus").click(function() {
			var jQuerybutton = jQuery(this);
			var oldValue = jQuerybutton.parent().find(".qty-text").val();
			
			if (jQuerybutton.val() == "+") {
				var newVal = parseFloat(oldValue) + 1;
			} 
			
			else {		
				if (oldValue > 1) {
					var newVal = parseFloat(oldValue) - 1;
				}
				
				else {
					var newVal = 1;
				}
			}
	
			jQuerybutton.parent().find(".qty-text").val(newVal);
	
	    });

	});
	
	// Disable backspace for quantity buttons
	jQuery(document).keypress(function(e){ 
	  var elid = jQuery(document.activeElement).is('.qty-text'); 
	  if(e.keyCode === 8 && elid){ 
	      return false; 
	  }; 
	});
	
	// Accordion
	jQuery(".accordion").accordion( { autoHeight: false } );

	// Toggle
	jQuery( ".toggle > .inner" ).hide();
	jQuery(".toggle .title").toggle(function(){
		jQuery(this).addClass("active").closest('.toggle').find('.inner').slideDown(200, 'easeOutCirc');
	}, function () {
		jQuery(this).removeClass("active").closest('.toggle').find('.inner').slideUp(200, 'easeOutCirc');
	});

	// Tabs
	jQuery(function() {
		jQuery(".tabs").tabs();
	});
	
});

if (slideshow_video == true) {

	jQuery(window).load(function(){  

		// Vimeo API nonsense
		var player = document.getElementById('player_1');
		$f(player).addEvent('ready', ready);
	
		function addEvent(element, eventName, callback) {
			(element.addEventListener) ? element.addEventListener(eventName, callback, false) : element.attachEvent(eventName, callback, false);
		}
 		
		function ready(player_id) {
   			var froogaloop = $f(player_id);
  
   			froogaloop.addEvent('play', function(data) {
    			jQuery('.flexslider').flexslider('pause');
    		});
    
    		froogaloop.addEvent('pause', function(data) {
     			jQuery('.flexslider').flexslider('play');
   			});
		}

		// Call fitVid before FlexSlider initializes, so the proper initial height can be retrieved.
		jQuery('.slider').fitVids().flexslider({
			animation: 'slide',
			controlNav: false,
			slideshow: slideshow_autoplay,
			slideshowSpeed: slideshow_speed,
			useCSS: false,
			smoothHeight: slideshow_video,
			start: function(slider){
				jQuery('body').removeClass('loading');
			},
			before: function(slider){
				$f(player).api('pause');
			}
		});
	});

}

else {
	jQuery('.slider').fitVids().flexslider({
		animation: 'slide',
		controlNav: false,
		slideshow: slideshow_autoplay,
		slideshowSpeed: slideshow_speed,
		useCSS: false,
		smoothHeight: slideshow_video
	});
}