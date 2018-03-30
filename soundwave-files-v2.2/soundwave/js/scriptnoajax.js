(function ($) {

  $(document)
    .ready(function () {
	
	
	 if(jQuery().prettyPhoto) {
                  jQuery("a[data-rel^='prettyPhoto']").prettyPhoto({
                     animation_speed: 'fast', // fast/slow/normal 
                     slideshow: 5000, // false OR interval time in ms 
                     autoplay_slideshow: false, // true/false 
                     opacity: 0.80, // Value between 0 and 1 
                     show_title: true, // true/false 
                     allow_resize: true, // Resize the photos bigger than viewport. true/false 
                     default_width: 540,
                     default_height: 344,
					 deeplinking : false,
                     counter_separator_label: '/', // The separator for the gallery counter 1 "of" 2
                     theme: 'pp_default', // light_rounded / dark_rounded / light_square / dark_square / facebook
                     horizontal_padding: 20, // The padding on each side of the picture 
                     autoplay: true, // Automatically start videos: True/False 					
                     ie6_fallback: true,
                  });
               }

               if(jQuery().prettyPhoto) {
                  jQuery("a[data-rel^='prettyPhoto-widget']").prettyPhoto({
                     animation_speed: 'fast', // fast/slow/normal 
                     slideshow: 5000, // false OR interval time in ms 
                     autoplay_slideshow: false, // true/false 
                     opacity: 0.80, // Value between 0 and 1 
                     show_title: true, // true/false 
                     allow_resize: true, // Resize the photos bigger than viewport. true/false 
                     default_width: 540,
                     default_height: 344,
					 deeplinking : false,
                     counter_separator_label: '/', // The separator for the gallery counter 1 "of" 2
                     theme: 'pp_default', // light_rounded / dark_rounded / light_square / dark_square / facebook
                     horizontal_padding: 20, // The padding on each side of the picture 
                     autoplay: true, // Automatically start videos: True/False 					
                     ie6_fallback: true,
                  });
               }

               if(jQuery().prettyPhoto) {
                  jQuery("a[data-rel^='prettyPhoto-cover']").prettyPhoto({
                     animation_speed: 'fast', // fast/slow/normal 
                     slideshow: 5000, // false OR interval time in ms 
                     autoplay_slideshow: false, // true/false 
                     opacity: 0.80, // Value between 0 and 1 
                     show_title: true, // true/false 
                     allow_resize: true, // Resize the photos bigger than viewport. true/false 
                     default_width: 540,
                     default_height: 344,
					 deeplinking : false,
                     counter_separator_label: '/', // The separator for the gallery counter 1 "of" 2
                     theme: 'pp_default', // light_rounded / dark_rounded / light_square / dark_square / facebook
                     horizontal_padding: 20, // The padding on each side of the picture 
                     autoplay: false, // Automatically start videos: True/False 					
                     ie6_fallback: true,
                  });
               }

	// -------------------------------------------------------------------------------------------------------
    // First Word
    // -------------------------------------------------------------------------------------------------------

	
      		  $('.footer-col h4')
			  .each(function () {
			  var h = $(this)
				.html();
			  var index = h.indexOf(' ');
			  if (index == -1) {
				index = h.length;
			  }
			  $(this)
				.html('<span style="color:#fff; font-weight:300;">' + h.substring(0, index) + '</span>' + h.substring(index, h.length));
			  }); 	
		
	
	});
	
})(window.jQuery);