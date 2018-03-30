$(window).load(function() {
		$('.flexslider').flexslider({
          animation: "fade"
    	});


		$('.flexslider2').flexslider({
			animation: "slide",              //String: Select your animation type, "fade" or "slide"
			slideDirection: "horizontal",
	        start: function(slider){ // init the height of the first item on start
	            var $new_height = slider.slides.eq(0).height();     
	            slider.height($new_height);                                     
	        },          
	        before: function(slider){ // init the height of the next item before slide
	            var $new_height = slider.slides.eq(slider.animatingTo).height();                
	            if($new_height != slider.height()){
	                slider.animate({ height: $new_height  }, 300);
	            }
	        }          
		});
});