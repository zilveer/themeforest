jQuery(document).ready(function() {
	/** Post Admin - Show Approprite Metaboxes when Post Format selected **/
	var galleryMetabox = jQuery('#mega-meta-box-post-gallery');
	var galleryTrigger = jQuery('#post-format-gallery');	
	galleryMetabox.css('display', 'none');
	var quoteMetabox = jQuery('#mega-meta-box-post-quote');
	var quoteTrigger = jQuery('#post-format-quote');	
	quoteMetabox.css('display', 'none');
	var videoMetabox = jQuery('#mega-meta-box-post-video');
	var videoTrigger = jQuery('#post-format-video');	
	videoMetabox.css('display', 'none');
	var audioMetabox = jQuery('#mega-meta-box-post-audio');
	var audioTrigger = jQuery('#post-format-audio');	
	audioMetabox.css('display', 'none');
	jQuery('#post-formats-select input').change( function() {	
		if(jQuery(this).val() == 'gallery') {
			hideAllExcept(galleryMetabox);
		} else if ( jQuery(this).val() == 'quote' ) {
			hideAllExcept(quoteMetabox);
		} else if (jQuery(this).val() == 'video') {
			hideAllExcept(videoMetabox);
		} else if (jQuery(this).val() == 'audio') {
			hideAllExcept(audioMetabox);
		} else {
			galleryMetabox.css('display', 'none');
			quoteMetabox.css('display', 'none');
			videoMetabox.css('display', 'none');
			audioMetabox.css('display', 'none');
		}		
	});
	if (galleryTrigger.is(':checked'))
		galleryMetabox.css('display', 'block');
	if (quoteTrigger.is(':checked'))
		quoteMetabox.css('display', 'block');
	if (audioTrigger.is(':checked'))
		audioMetabox.css('display', 'block');
	if (videoTrigger.is(':checked'))
		videoMetabox.css('display', 'block');
	function hideAllExcept(metabox) {
		galleryMetabox.css('display', 'none');
		quoteMetabox.css('display', 'none');
		videoMetabox.css('display', 'none');
		audioMetabox.css('display', 'none');
		metabox.css('display', 'block');
	}	
	/** Show Appropriate Metaboxes when Template selected **/
	var pageGallery = jQuery('#mega-meta-box-page-gallery');
	pageGallery.css('display', 'none');
	var pagePhotos = jQuery('#mega-meta-box-page-photos');
	pagePhotos.css('display', 'none');
	var pageFullWidthSlider = jQuery('#mega-meta-box-page-photos-full-width-slider');
	pageFullWidthSlider.css('display', 'none');
	var pageSlider = jQuery('#mega-meta-box-page-photos-slider');
	pageSlider.css('display', 'none');
	var pageVideoGallery = jQuery('#mega-meta-box-page-videos');
	pageVideoGallery.css('display', 'none');
	var pageVisibleNearbyImages = jQuery('#mega-meta-box-page-visible-nearby-images');
	pageVisibleNearbyImages.css('display', 'none');
	if ( jQuery('#page_template').val() == 'page-gallery.php' ) {
		pagePhotos.css('display', 'block');
		pageGallery.css('display', 'block');
	} else if (jQuery('#page_template').val() == 'page-full-width-slider.php' ) {
		pageFullWidthSlider.css('display', 'block');
		pageGallery.css('display', 'block');
	} else if (jQuery('#page_template').val() == 'page-slider.php' ) {
		pageSlider.css('display', 'block');
		pageGallery.css('display', 'block');
	} else if (jQuery('#page_template').val() == 'page-gallery-video.php' ) {
		pageVideoGallery.css('display', 'block');
		pageGallery.css('display', 'block');
	} else if (jQuery('#page_template').val() == 'page-gallery-visible-nearby.php' ) {
		pageVisibleNearbyImages.css('display', 'block');
		pageGallery.css('display', 'block');
	}
	jQuery("#page_template").change(function(){
		if ( jQuery(this).val() == 'page-gallery.php') {
			pageGallery.css('display', 'block');
			pagePhotos.css('display', 'block');
			pageFullWidthSlider.css('display', 'none');
			pageSlider.css('display', 'none');
			pageVideoGallery.css('display', 'none');
			pageVisibleNearbyImages.css('display', 'none');
		} else if (jQuery(this).val() == 'page-full-width-slider.php') {
			pageGallery.css('display', 'block');
			pageFullWidthSlider.css('display', 'block');
			pageSlider.css('display', 'none');
			pagePhotos.css('display', 'none');
			pageVideoGallery.css('display', 'none');
			pageVisibleNearbyImages.css('display', 'none');
		} else if (jQuery(this).val() == 'page-slider.php') {
			pageGallery.css('display', 'block');
			pageSlider.css('display', 'block');
			pageFullWidthSlider.css('display', 'none');
			pagePhotos.css('display', 'none');
			pageVideoGallery.css('display', 'none');
			pageVisibleNearbyImages.css('display', 'none');
		} else if (jQuery(this).val() == 'page-gallery-video.php') {
			pageGallery.css('display', 'block');
			pageVideoGallery.css('display', 'block');
			pagePhotos.css('display', 'none');
			pageFullWidthSlider.css('display', 'none');
			pageSlider.css('display', 'none');
			pageVisibleNearbyImages.css('display', 'none');
		} else if (jQuery(this).val() == 'page-gallery-visible-nearby.php') {
			pageGallery.css('display', 'block');
			pageVisibleNearbyImages.css('display', 'block');
			pagePhotos.css('display', 'none');
			pageFullWidthSlider.css('display', 'none');
			pageSlider.css('display', 'none');
			pageVideoGallery.css('display', 'none');
		} else {
			pageGallery.css('display', 'none');
			pagePhotos.css('display', 'none');
			pageFullWidthSlider.css('display', 'none');
			pageSlider.css('display', 'none');
			pageVideoGallery.css('display', 'none');
			pageVisibleNearbyImages.css('display', 'none');
		}
	});
	/** Gallery Admin - Switch between Image Gallery/Full Width Slider/Slider/Video Gallery/Gallery with Visible Nearby Images **/
	var galleryTypeSelect = jQuery('#mega_gallery_script'),
		galleryFullWidthSlider = jQuery('#mega-meta-box-gallery-post-type-slider-settings'),
		galleryImage = jQuery('#mega-meta-box-gallery'),
		galleryVideo = jQuery('#mega-meta-box-gallery-video'),
		currentGallery = galleryTypeSelect.val();
	gallerySwitch(currentGallery);
	galleryTypeSelect.change( function() {
		currentGallery = jQuery(this).val();       
		gallerySwitch(currentGallery);
	});
    
	function gallerySwitch(currentGallery) {
		if ( currentGallery == 'Image Gallery' ) {
			galleryFullWidthSlider.css('display', 'none');
			galleryVideo.css('display', 'none');
			galleryImage.css('display', 'block');
		} else if ( currentGallery == 'Video Gallery' ) {
			galleryFullWidthSlider.css('display', 'none');
			galleryImage.css('display', 'none');
			galleryVideo.css('display', 'block');
		} else if ( currentGallery == 'Full Width Slider' ) {
			galleryImage.css('display', 'none');
			galleryVideo.css('display', 'none');
			galleryFullWidthSlider.css('display', 'block');
		} else {
			galleryImage.css('display', 'none');
			galleryVideo.css('display', 'none');
			galleryFullWidthSlider.css('display', 'none');
		}
	}
});