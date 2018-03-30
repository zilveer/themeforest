/**
 * Scrubnails
 * Author: Chris Johnson (me@cmj.io / http://explore.js)
 * Version: 1.0
 * Dependencies: jQuery
 */

(function($) {
$.fn.Scrubnails = function(options) {

	var Modernizr = window.Modernizr;
	if(!Modernizr.touch) {

		if (!this.length) { return this; }
		var opts = $.extend(true, {}, $.fn.Scrubnails.defaults, options);

		this.each(function() {
			var $this = $(this);

			// build images
			for(var i = 0; i < opts.images.length; i++){
				
				for (var key in opts.images[i]) {
					var itemImages = opts.images[i][key];
					var itemId = key;
					
					var div = $this.find("div[data-album-id='album_"+itemId+"'] a:first").addClass('nail');

					for(var j = 0; j < itemImages.length; j++){
						var img = $('<img/>').addClass('frame')
							.attr('src',itemImages[j])
							.css({ display: 'block', position: 'absolute', top: 0, left: 0, zIndex: 1000 })
							.hide();
						div.append(img);
						div.find('img:first').css("visibility", "hidden");
						div.find('img.frame').first().show();
					}
					
				}
			}

			$(".nail").mousemove(function(e){
				var self = this;
				var x = (e.pageX - $(self).offset().left);
				var width = $(this).width();
				var imageCount = $(this).find('img.frame').length;
				var step = Math.floor(width / imageCount);
				var max = 0;
				var min = 0;
				var idx = 0;
				

				loop();

				function loop(){
					if(x >= min && x < max + step){
						$(self).find('img.frame').hide();
						$(self).find('img.frame').eq(idx).show();
					}else{
						$(self).find('img.frame').hide();
						min = max;
						max = max + step;
						idx = idx + 1;
						$(self).find('img.frame').eq(idx).show();
						loop();
					}
				}
			});

			$(".nail").mouseout(function(e){
				$(this).find('img.frame').hide();
				$(this).find('img.frame').first().show();
			});


		});


		return this;

	} else {
		return false;
	}
};

// default options
$.fn.Scrubnails.defaults = {
  images: []
};

})(jQuery);
