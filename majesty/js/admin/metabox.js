(function( $ ) {
	"use strict";
	$(function() {
		
		hideallmetaboxslider();
		var slidertype = $( ".page-slider-type select option:selected" ).val();		
		if( slidertype != '' ) {
			hidemetaboxslider(slidertype);
		}
		
		$('.page-slider-type select').change(function () {
			var slidertype = $( ".page-slider-type select option:selected" ).val();
			if( slidertype != '' ) {
				hidemetaboxslider(slidertype);
			} else {
				hideallmetaboxslider();
			}
		});
		
		// MetaBox In Post Format
		displayMetaboxes();
		// Show/hide metaboxes on change event
		$("input[name='post_format']").change(function() {
			displayMetaboxes();
		});
	});
	
	function displayMetaboxes() {
        // Hide all post format metaboxes
		$('.post-oembed, .post-video-mp4, .post-video-webm, .post-video-ogg, .post-video-poster, .post-video-attr').hide();
		// Get current post format
		var postformat = $("input[name='post_format']:checked").attr("id");
		if( postformat == 'post-format-video' ) {
			$('.post-oembed, .post-video-mp4, .post-video-webm, .post-video-ogg, .post-video-poster, .post-video-attr').show();
		}
		if( postformat == 'post-format-audio' ) {
			$('.post-oembed').show();
		}
	}
	
	/*
	 *	Used To hide Slider MetaBox depend on end user select
	 */
	function hidemetaboxslider( slidertype ) {
		if( slidertype == 'skipper' ) {
			hideallmetaboxslider();
			$('#_sama_skipper_settings_repeat').closest('.cmb-repeat-group-wrap').show();
			$('#_sama_skipper_slides_repeat').closest('.cmb-repeat-group-wrap').show();				
		} else if( slidertype == 'bgndgallery' ) {
			hideallmetaboxslider();
			$('#_sama_bgslider_settings_repeat').closest('.cmb-repeat-group-wrap').show();
		} else if( slidertype == 'youtubebg' ) {
			hideallmetaboxslider();
			$('#_sama_youtube_settings_repeat').closest('.cmb-repeat-group-wrap').show();
		} else if( slidertype == 'vimeobg' ) {
			hideallmetaboxslider();
			$('#_sama_vimeo_settings_repeat').closest('.cmb-repeat-group-wrap').show();
		} else if( slidertype == 'h5video' ) {
			hideallmetaboxslider();
			$('#_sama_h5video_settings_repeat').closest('.cmb-repeat-group-wrap').show();
		} else if( slidertype == 'fullscreenbg' ) {
			hideallmetaboxslider();
			$('#_sama_fullscreenbg_settings_repeat').closest('.cmb-repeat-group-wrap').show();
		} else if( slidertype == 'parallaxbg' ) {
			hideallmetaboxslider();
			$('#_sama_parallaxbg_settings_repeat').closest('.cmb-repeat-group-wrap').show();
		} else if( slidertype == 'interactivebg' ) {
			hideallmetaboxslider();
			$('#_sama_interactivebg_settings_repeat').closest('.cmb-repeat-group-wrap').show();
		} else if( slidertype == 'movementbg' ) {
			hideallmetaboxslider();
			$('#_sama_movementbg_settings_repeat').closest('.cmb-repeat-group-wrap').show();
		} else if( slidertype == 'swiper' ) {
			hideallmetaboxslider();
			$('#_sama_swiper_settings_repeat').closest('.cmb-repeat-group-wrap').show();
			$('#_sama_swiper_slides_repeat').closest('.cmb-repeat-group-wrap').show();
		}
	}
		
	/*
	 *	Used To hide All MetaBox For Slider types
	 */
	//$.fn.hideallmetaboxslider = function() {
	function hideallmetaboxslider() {
		var slidersmeta = ['#_sama_skipper_settings_repeat', '#_sama_skipper_slides_repeat', '#_sama_bgslider_settings_repeat', '#_sama_youtube_settings_repeat', '#_sama_vimeo_settings_repeat', '#_sama_h5video_settings_repeat', '_sama_fullscreenbg_settings_repeat', '#_sama_fullscreenbg_settings_repeat', '#_sama_parallaxbg_settings_repeat', '#_sama_interactivebg_settings_repeat', '#_sama_movementbg_settings_repeat', '#_sama_swiper_settings_repeat', '#_sama_swiper_slides_repeat'];
		
		$(slidersmeta).each(function() {
			$(this).closest('.cmb-repeat-group-wrap').hide();
		});			
	}
})(jQuery);