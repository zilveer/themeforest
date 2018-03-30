jQuery(document).ready(function() {
   
	//Favicon Image Upload favicon = id
	jQuery('#TR_favicon_button').click(function() {
			 formfield = jQuery('#TR_favicon').attr('name');
			 tb_show('', 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true');
			 destination = 'add_favicon';			 
			 return false;
	});

	//Logo Image Upload 
	jQuery('#TR_logo_button').click(function() {
			 formfield = jQuery('#TR_logo').attr('name');
			 tb_show('', 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true');
			 destination = 'add_logo';			 
			 return false;
	});

	//Announcement Image Upload 
	jQuery('#TR_ac_bg_image_button').click(function() {
			 formfield = jQuery('#TR_ac_bg_image').attr('name');
			 tb_show('', 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true');
			 destination = 'add_ac_bg_image';			 
			 return false;
	});

	//Header Background Image Upload 
	jQuery('#TR_header_bg_image_button').click(function() {
			 formfield = jQuery('#TR_header_bg_image').attr('name');
			 tb_show('', 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true');
			 destination = 'add_header_bg_image';			 
			 return false;
	});

	//Slideshow Background Image Upload 
	jQuery('#TR_slideshow_bg_image_button').click(function() {
			 formfield = jQuery('#TR_slideshow_bg_image').attr('name');
			 tb_show('', 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true');
			 destination = 'add_slideshow_bg_image';			 
			 return false;
	});

	//Page header Background Image Upload 
	jQuery('#TR_page_header_bg_image_button').click(function() {
			 formfield = jQuery('#TR_page_header_bg_image').attr('name');
			 tb_show('', 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true');
			 destination = 'add_page_header_bg_image';			 
			 return false;
	});

	//Footer Widgets Background Image Upload 
	jQuery('#TR_footer_widgets_bg_image_button').click(function() {
			 formfield = jQuery('#TR_footer_widgets_bg_image').attr('name');
			 tb_show('', 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true');
			 destination = 'add_footer_widgets_bg_image';			 
			 return false;
	});

	//Footer Contact Background Image Upload 
	jQuery('#TR_footer_contact_bg_image_button').click(function() {
			 formfield = jQuery('#TR_footer_contact_bg_image').attr('name');
			 tb_show('', 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true');
			 destination = 'add_footer_contact_bg_image';			 
			 return false;
	});

	//Footer Copyright Background Image Upload 
	jQuery('#TR_footer_copyright_bg_image_button').click(function() {
			 formfield = jQuery('#TR_footer_copyright_bg_image').attr('name');
			 tb_show('', 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true');
			 destination = 'add_footer_copyright_bg_image';			 
			 return false;
	});

	window.send_to_editor = function(html) {
		switch(destination)
		{ 
			case 'add_favicon':
				imgurl2 = jQuery('img',html).attr('src');
				jQuery('#TR_favicon').val(imgurl2);
			break;

			case 'add_logo':
				imgurl2 = jQuery('img',html).attr('src');
				jQuery('#TR_logo').val(imgurl2);
			break;

			case 'add_ac_bg_image':
				imgurl2 = jQuery('img',html).attr('src');
				jQuery('#TR_ac_bg_image').val(imgurl2);
			break;

			case 'add_slideshow_bg_image':
				imgurl2 = jQuery('img',html).attr('src');
				jQuery('#TR_slideshow_bg_image').val(imgurl2);
			break;

			case 'add_page_header_bg_image':
				imgurl2 = jQuery('img',html).attr('src');
				jQuery('#TR_page_header_bg_image').val(imgurl2);
			break;

			case 'add_header_bg_image':
				imgurl2 = jQuery('img',html).attr('src');
				jQuery('#TR_header_bg_image').val(imgurl2);
			break;

			case 'add_footer_widgets_bg_image':
				imgurl2 = jQuery('img',html).attr('src');
				jQuery('#TR_footer_widgets_bg_image').val(imgurl2);
			break;

			case 'add_footer_contact_bg_image':
				imgurl2 = jQuery('img',html).attr('src');
				jQuery('#TR_footer_contact_bg_image').val(imgurl2);
			break;
		}
		tb_remove();
	}

});