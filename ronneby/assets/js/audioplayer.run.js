(function($){
	"use strict";
	
	$(document).ready(function($){
		$.fn.addAudioPlayer = function() {
			$(this).each(function() {
				if(!$(this).find('div.audioplayer').length && $(this).find('audio').length) {
					$('audio').audioPlayer();
				}
			});
			return this;
		};
		$('.post.format-audio').addAudioPlayer();
		/*
		addAudioPlayer();
		if($('.post').length > 0) {
			$('.post').parent().observeDOM(function(){ 
				addAudioPlayer();
			});
		}
		*/
	});
})(jQuery);
