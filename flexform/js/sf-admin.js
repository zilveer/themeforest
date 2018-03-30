/*
*
*	Admin jQuery Functions
*	------------------------------------------------
*	Swift Framework v1.0
* 	Copyright Swift Ideas 2013 - http://www.swiftideas.net
*
*/

jQuery(function(jQuery) {
	
	// FIELD VARIABLES

	var $sidebar_config = jQuery('#sf_sidebar_config'), 
		$left_sidebar = jQuery('#sf_left_sidebar').parent().parent(),
		$right_sidebar = jQuery('#sf_right_sidebar').parent().parent();
	var $posts_slider_type = jQuery('#sf_posts_slider_type'), 
		$slider_posts_category = jQuery('#sf_posts_slider_category').parent().parent(),
		$slider_portfolio_category = jQuery('#sf_posts_slider_portfolio_category').parent().parent();
	var $thumb_type = jQuery('#sf_thumbnail_type'),
		$thumb_image = jQuery('#sf_thumbnail_image_description').parent().parent(),
		$thumb_video = jQuery('#sf_thumbnail_video_url').parent().parent(),
		$thumb_gallery = jQuery('#sf_thumbnail_gallery_description').parent().parent();
	var $link_type = jQuery('#sf_thumbnail_link_type'),
		$link_url = jQuery('#sf_thumbnail_link_url').parent().parent(),
		$link_image = jQuery('input[value="sf_thumbnail_link_image"]').parent().parent(),
		$link_video = jQuery('#sf_thumbnail_link_video_url').parent().parent();
	var $use_thumb_content = jQuery('#sf_thumbnail_content_main_detail'),
		$detail_type = jQuery('#sf_detail_type'),
		$detail_image = jQuery('#sf_detail_image_description').parent().parent(),
		$detail_video = jQuery('#sf_detail_video_url').parent().parent(),
		$detail_gallery = jQuery('#sf_detail_gallery_description').parent().parent(),
		$detail_slider = jQuery('#sf_detail_rev_slider_alias').parent().parent(),
		$detail_custom = jQuery('#sf_custom_media').parent().parent();
	
	
	// INITAL SHOW/HIDE CONFIG
	
	if ($posts_slider_type.val() == "post") {
		$slider_posts_category.css('display', 'block');
		$slider_portfolio_category.css('display', 'none');
	} else if ($posts_slider_type.val() == "portfolio") {
		$slider_posts_category.css('display', 'none');
		$slider_portfolio_category.css('display', 'block');
	} else if ($posts_slider_type.val() == "hybrid") {
		$slider_posts_category.css('display', 'block');
		$slider_portfolio_category.css('display', 'block');
	}
	
	if ($sidebar_config.val() == "no-sidebars") {
		$left_sidebar.css('display', 'none');
		$right_sidebar.css('display', 'none');
	} else if ($sidebar_config.val() == "left-sidebar") {
		$left_sidebar.css('display', 'block');
		$right_sidebar.css('display', 'none');
	} else if ($sidebar_config.val() == "right-sidebar") {
		$right_sidebar.css('display', 'block');
		$left_sidebar.css('display', 'none');
	} else if ($sidebar_config.val() == "both-sidebars") {
		$left_sidebar.css('display', 'block');
		$right_sidebar.css('display', 'block');
	}
	
	if ($thumb_type.val() == "none") {
		$thumb_image.css('display', 'none');
		$thumb_video.css('display', 'none');
		$thumb_gallery.css('display', 'none');
	} else if ($thumb_type.val() == "image") {
		$thumb_image.css('display', 'block');
		$thumb_video.css('display', 'none');
		$thumb_gallery.css('display', 'none');
	} else if ($thumb_type.val() == "video") {
		$thumb_image.css('display', 'none');
		$thumb_video.css('display', 'block');
		$thumb_gallery.css('display', 'none');
	} else if ($thumb_type.val() == "slider") {
		$thumb_image.css('display', 'none');
		$thumb_video.css('display', 'none');
		$thumb_gallery.css('display', 'block');
	}
	
	if ($link_type.val() == "link_to_post") {
		$link_url.css('display', 'none');
		$link_image.css('display', 'none');
		$link_video.css('display', 'none');
	} else if ($link_type.val() == "link_to_url" || $link_type.val() == "link_to_url_nw" ) {
		$link_url.css('display', 'block');
		$link_image.css('display', 'none');
		$link_video.css('display', 'none');
	} else if ($link_type.val() == "lightbox_thumb") {
		$link_url.css('display', 'none');
		$link_image.css('display', 'none');
		$link_video.css('display', 'none');
	} else if ($link_type.val() == "lightbox_image") {
		$link_url.css('display', 'none');
		$link_image.css('display', 'block');
		$link_video.css('display', 'none');
	} else if ($link_type.val() == "lightbox_video") {
		$link_url.css('display', 'none');
		$link_image.css('display', 'none');
		$link_video.css('display', 'block');
	}
	
	if ($use_thumb_content.is(':checked')) {
		$detail_type.parent().parent().css('display', 'none');
		$detail_image.css('display', 'none');
		$detail_video.css('display', 'none');
		$detail_gallery.css('display', 'none');
		$detail_slider.css('display', 'none');
		$detail_custom.css('display', 'none');
	} else {
		$detail_type.parent().parent().css('display', 'block');
		if ($detail_type.val() == "none") {
			$detail_image.css('display', 'none');
			$detail_video.css('display', 'none');
			$detail_gallery.css('display', 'none');
			$detail_slider.css('display', 'none');
			$detail_custom.css('display', 'none');
		} else if ($detail_type.val() == "image") {
			$detail_image.css('display', 'block');
			$detail_video.css('display', 'none');
			$detail_gallery.css('display', 'none');
			$detail_slider.css('display', 'none');
			$detail_custom.css('display', 'none');
		} else if ($detail_type.val() == "video") {
			$detail_image.css('display', 'none');
			$detail_video.css('display', 'block');
			$detail_gallery.css('display', 'none');
			$detail_slider.css('display', 'none');
			$detail_custom.css('display', 'none');
		} else if ($detail_type.val() == "slider") {
			$detail_image.css('display', 'none');
			$detail_video.css('display', 'none');
			$detail_gallery.css('display', 'block');
			$detail_slider.css('display', 'none');
			$detail_custom.css('display', 'none');
		} else if ($detail_type.val() == "layer-slider") {
			$detail_image.css('display', 'none');
			$detail_video.css('display', 'none');
			$detail_gallery.css('display', 'none');
			$detail_slider.css('display', 'block');
			$detail_custom.css('display', 'none');
		} else if ($detail_type.val() == "custom") {
			$detail_image.css('display', 'none');
			$detail_video.css('display', 'none');
			$detail_gallery.css('display', 'none');
			$detail_slider.css('display', 'none');
			$detail_custom.css('display', 'block');
		}
	}
	
	
	// ON CHANGE SHOW/HIDE CONFIG
	
	$sidebar_config.change(function() {
	  if (jQuery(this).val() == "no-sidebars") {
	  	$left_sidebar.css('display', 'none');
	  	$right_sidebar.css('display', 'none');
	  } else if (jQuery(this).val() == "left-sidebar") {
	  	$left_sidebar.css('display', 'block');
	  	$right_sidebar.css('display', 'none');
	  } else if (jQuery(this).val() == "right-sidebar") {
	  	$right_sidebar.css('display', 'block');
	  	$left_sidebar.css('display', 'none');
	  } else if (jQuery(this).val() == "both-sidebars") {
	  	$left_sidebar.css('display', 'block');
	  	$right_sidebar.css('display', 'block');
	  }
	});
	
	$posts_slider_type.change(function() {
	  if (jQuery(this).val() == "post") {
	  	$slider_posts_category.css('display', 'block');
	  	$slider_portfolio_category.css('display', 'none');
	  } else if (jQuery(this).val() == "portfolio") {
	  	$slider_posts_category.css('display', 'none');
	  	$slider_portfolio_category.css('display', 'block');
	  } else if (jQuery(this).val() == "hybrid") {
	  	$slider_posts_category.css('display', 'none');
	  	$slider_portfolio_category.css('display', 'none');
	  }
	});
	
	$thumb_type.change(function() {
		if (jQuery(this).val() == "none") {
			$thumb_image.css('display', 'none');
			$thumb_video.css('display', 'none');
			$thumb_gallery.css('display', 'none');
		} else if (jQuery(this).val() == "image") {
			$thumb_image.css('display', 'block');
			$thumb_video.css('display', 'none');
			$thumb_gallery.css('display', 'none');
		} else if (jQuery(this).val() == "video") {
			$thumb_image.css('display', 'none');
			$thumb_video.css('display', 'block');
			$thumb_gallery.css('display', 'none');
		} else if (jQuery(this).val() == "slider") {
			$thumb_image.css('display', 'none');
			$thumb_video.css('display', 'none');
			$thumb_gallery.css('display', 'block');
		}
	});

	$link_type.change(function() {	
		if (jQuery(this).val() == "link_to_post") {
			$link_url.css('display', 'none');
			$link_image.css('display', 'none');
			$link_video.css('display', 'none');
		} else if (jQuery(this).val() == "link_to_url" || $link_type.val() == "link_to_url_nw") {
			$link_url.css('display', 'block');
			$link_image.css('display', 'none');
			$link_video.css('display', 'none');
		} else if (jQuery(this).val() == "lightbox_thumb") {
			$link_url.css('display', 'none');
			$link_image.css('display', 'none');
			$link_video.css('display', 'none');
		} else if (jQuery(this).val() == "lightbox_image") {
			$link_url.css('display', 'none');
			$link_image.css('display', 'block');
			$link_video.css('display', 'none');
		} else if (jQuery(this).val() == "lightbox_video") {
			$link_url.css('display', 'none');
			$link_image.css('display', 'none');
			$link_video.css('display', 'block');
		}
	});
	
	$use_thumb_content.change(function() {
		if ($use_thumb_content.is(':checked')) {
			$detail_type.parent().parent().css('display', 'none');
			$detail_image.css('display', 'none');
			$detail_video.css('display', 'none');
			$detail_gallery.css('display', 'none');
			$detail_slider.css('display', 'none');
			$detail_custom.css('display', 'none');
		} else {
			$detail_type.parent().parent().css('display', 'block');
			if ($detail_type.val() == "none") {
				$detail_image.css('display', 'none');
				$detail_video.css('display', 'none');
				$detail_gallery.css('display', 'none');
				$detail_slider.css('display', 'none');
				$detail_custom.css('display', 'none');
			} else if ($detail_type.val() == "image") {
				$detail_image.css('display', 'block');
				$detail_video.css('display', 'none');
				$detail_gallery.css('display', 'none');
				$detail_slider.css('display', 'none');
				$detail_custom.css('display', 'none');
			} else if ($detail_type.val() == "video") {
				$detail_image.css('display', 'none');
				$detail_video.css('display', 'block');
				$detail_gallery.css('display', 'none');
				$detail_slider.css('display', 'none');
				$detail_custom.css('display', 'none');
			} else if ($detail_type.val() == "slider") {
				$detail_image.css('display', 'none');
				$detail_video.css('display', 'none');
				$detail_gallery.css('display', 'block');
				$detail_slider.css('display', 'none');
				$detail_custom.css('display', 'none');
			} else if ($detail_type.val() == "layer-slider") {
				$detail_image.css('display', 'none');
				$detail_video.css('display', 'none');
				$detail_gallery.css('display', 'none');
				$detail_slider.css('display', 'block');
				$detail_custom.css('display', 'none');
			} else if ($detail_type.val() == "custom") {
				$detail_image.css('display', 'none');
				$detail_video.css('display', 'none');
				$detail_gallery.css('display', 'none');
				$detail_slider.css('display', 'none');
				$detail_custom.css('display', 'block');
			}
		}
	});
	
	$detail_type.change(function() {
		if ($use_thumb_content.is(':checked')) {
			$detail_type.parent().parent().css('display', 'none');
			$detail_image.css('display', 'none');
			$detail_video.css('display', 'none');
			$detail_gallery.css('display', 'none');
			$detail_slider.css('display', 'none');
		} else {
			$detail_type.parent().parent().css('display', 'block');
			if (jQuery(this).val() == "none") {
				$detail_image.css('display', 'none');
				$detail_video.css('display', 'none');
				$detail_gallery.css('display', 'none');
				$detail_slider.css('display', 'none');
			} else if (jQuery(this).val() == "image") {
				$detail_image.css('display', 'block');
				$detail_video.css('display', 'none');
				$detail_gallery.css('display', 'none');
				$detail_slider.css('display', 'none');
			} else if (jQuery(this).val() == "video") {
				$detail_image.css('display', 'none');
				$detail_video.css('display', 'block');
				$detail_gallery.css('display', 'none');
				$detail_slider.css('display', 'none');
			} else if (jQuery(this).val() == "slider") {
				$detail_image.css('display', 'none');
				$detail_video.css('display', 'none');
				$detail_gallery.css('display', 'block');
				$detail_slider.css('display', 'none');
			} else if (jQuery(this).val() == "layer-slider") {
				$detail_image.css('display', 'none');
				$detail_video.css('display', 'none');
				$detail_gallery.css('display', 'none');
				$detail_slider.css('display', 'block');
			} else if ($detail_type.val() == "custom") {
				$detail_image.css('display', 'none');
				$detail_video.css('display', 'none');
				$detail_gallery.css('display', 'none');
				$detail_slider.css('display', 'none');
				$detail_custom.css('display', 'block');
			}
		}
	});
	
	
	
	jQuery('#media-items').bind('DOMNodeInserted',function(){
		jQuery('input[value="Insert into Post"]').each(function(){
				jQuery(this).attr('value','Use This Image');
		});
	});
	
	jQuery('.custom_upload_image_button').click(function() {
		formfield = jQuery(this).siblings('.custom_upload_image');
		preview = jQuery(this).siblings('.custom_preview_image');
		tb_show('', 'media-upload.php?type=image&TB_iframe=true');
		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			classes = jQuery('img', html).attr('class');
			id = classes.replace(/(.*?)wp-image-/, '');
			formfield.val(id);
			preview.attr('src', imgurl);
			tb_remove();
		}
		return false;
	});
	
	jQuery('.custom_clear_image_button').click(function() {
		var defaultImage = jQuery(this).parent().siblings('.custom_default_image').text();
		jQuery(this).parent().siblings('.custom_upload_image').val('');
		jQuery(this).parent().siblings('.custom_preview_image').attr('src', defaultImage);
		return false;
	});
	
	jQuery('.repeatable-add').click(function() {
		field = jQuery(this).closest('td').find('.custom_repeatable li:last').clone(true);
		fieldLocation = jQuery(this).closest('td').find('.custom_repeatable li:last');
		jQuery('input', field).val('').attr('name', function(index, name) {
			return name.replace(/(\d+)/, function(fullMatch, n) {
				return Number(n) + 1;
			});
		})
		field.insertAfter(fieldLocation, jQuery(this).closest('td'))
		return false;
	});
	
	jQuery('.repeatable-remove').click(function(){
		jQuery(this).parent().remove();
		return false;
	});
	
	
	// ALT BACKGROUND
	
	var altBackgroundValue = jQuery('.rwmb-meta-box').find('#sf_page_title_bg').val();
	if (altBackgroundValue != "") {
		jQuery('.rwmb-meta-box').find('.meta-altbg-preview').addClass(altBackgroundValue);
	}
	
	jQuery('#sf_page_title_bg').live('change',function(){
	    jQuery('.meta-altbg-preview').attr('class', 'meta-altbg-preview');
	    jQuery('.meta-altbg-preview').addClass(jQuery(this).val());
	});

});