// PhotoSwipe
(function(window, $, PhotoSwipe){
	$(document).ready(function(){
	
		$photoswipe = $('#block-gallery');
		
		if ($photoswipe.length) {
		
			if (navigator.userAgent.match('WebKit') != null) {
				isWebkit = true;
				grabInCursor = '-webkit-grabbing';
			} else if (navigator.userAgent.match('Gecko') != null) {
				isGecko = true;
				grabInCursor = '-moz-grabbing';
			} else if (navigator.userAgent.match('MSIE 9') != null) {
				grabInCursor = 'move';
			} else if (navigator.userAgent.match('MSIE 10') != null) {
				grabInCursor = 'move';
			}
				
			var options = {
				enableMouseWheel: true,
				enableKeyboard: true,
				jQueryMobile: false,
				backButtonHideEnabled: false,
				imageScaleMethod: "fitNoUpscale",
				fadeInSpeed: 0,
				captionAndToolbarOpacity: 0.92,
				captionAndToolbarShowEmptyCaptions: false,
				nextPreviousSlideSpeed: 250,
				getImageCaption: function(item) { return $(item).attr('title'); }
			};
					
			var galleryItem = $('#block-gallery .gallery-item a').photoSwipe(options);
			
			// onShow
			galleryItem.addEventHandler(PhotoSwipe.EventTypes.onShow, function(e){
			
				var uilayer = $('.ps-uilayer');
				
				uilayer.bind('mousedown mouseup', function(e) {
					if(e.type === 'mousedown'){
						$(this).css('cursor', '' + grabInCursor + '');
					}
					if(e.type === 'mouseup'){
						  $(this).css('cursor', '');
					}
				});
			});
		
		}
			
	});
			
			
}(window, window.jQuery, window.Code.PhotoSwipe));

// Pushing new images into gallery. Used in jquery.gallery.js
var galleryPushImages = function( $links, instance_id ) {
    var src, title, caption, image, meta;
    // Pushing new links into "originalImages" array
    window.Code.PhotoSwipe.instances[instance_id].originalImages = jQuery.merge(window.Code.PhotoSwipe.instances[0].originalImages, $links.toArray());
    // Pushing new images in gallery cache one by one
    for ( var i = 0; i < $links.length; i++ )  {
        // Getting image params
        src = window.Code.PhotoSwipe.instances[instance_id].settings.getImageSource($links[i]);
        caption = jQuery($links[i]).attr('title');
        meta = window.Code.PhotoSwipe.instances[instance_id].settings.getImageMetaData($links[i]);
        // Pushing
        window.Code.PhotoSwipe.instances[instance_id].cache.images.push( new window.Code.PhotoSwipe.Image.ImageClass($links[i], src, caption, meta) );
        // Binding clicking events on new images
        $links[i].__photoSwipeClickHandler = window.Code.PhotoSwipe.onTriggerElementClick.bind(window.Code.PhotoSwipe.instances[0]);
        window.Code.Util.Events.add($links[i], 'click', $links[i].__photoSwipeClickHandler);
    }
}