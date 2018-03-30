(function($){
	"use strict";
	$(document).ready(function(){
		if ($('.dfd-fullscreen-video-container').length==0) {
			var $video_container = $('<div class="dfd-fullscreen-video-container"><a href="#close-video" class="fullscreen-video-close"></a></div>');
			$video_container.appendTo('body');
		} else {
			var $video_container = $('.dfd-fullscreen-video-container');
		}
		$('.dfd-fullscreen-video').each(function(){
			$(this).find('a').each(function(){
				var $a=$(this);
				var video_id=$a.attr('data-video-id');
				var video_source=$a.attr('data-video-source');
				var $iframe;
				if(!video_id||!video_source){
					return true;
				}
				switch(video_source) {
					case'youtube':
						$iframe=$(['<iframe width="100%" height="100%" src="https://www.youtube.com/embed/',video_id,'?wmode=opaque&autoplay=1" frameborder="0" class="youtube-video" allowfullscreen></iframe>'].join(''));
						break;
					case'vimeo':
						$iframe=$(['<iframe src="https://player.vimeo.com/video/',video_id,'?portrait=0&autoplay=1&rel=0" width="100%" height="100%" frameborder="0"></iframe>'].join(''));
						break;
					default:
						return true;
				}
				$a.on('click',function(e){
					e.preventDefault();
					$video_container.fadeIn('slow');
					setTimeout(function() {
						$video_container.append($iframe);
					}, 300);
				});
				$video_container.find('a.fullscreen-video-close').on('click',function(e){
					e.preventDefault();
					$video_container.fadeOut('slow').find('iframe').remove();
				});
			});
		});
	});
})(jQuery);