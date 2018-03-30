//Admin area javascripts

jQuery(document).ready(function ($) {

	/**Page metaboxes for loop templates**/

	jQuery('#_custom_page_options').hide(); // Default Hide
	jQuery('#_gallery_template_options').hide(); // Default Hide
	jQuery('#_gallery_template_options').hide(); // Default Hide
	jQuery('#blank_template_options').hide(); // Default Hide

	if (jQuery("#page_template :selected").val() == 'page-templates/news-page.php') {
		jQuery('#_custom_page_options').show();
		jQuery('#coming_soon_template_options').hide(); // Default Hide
		jQuery('#_gallery_template_options').hide(); // Default Hide
		jQuery('#blank_template_options').hide(); // Default Hide
	} else if (jQuery("#page_template :selected").val() == 'page-templates/attachments-gallery.php') {
		jQuery('#_custom_page_options').hide();
		jQuery('#coming_soon_template_options').hide();
		jQuery('#_gallery_template_options').show(); // Default Hide
		jQuery('#blank_template_options').hide(); // Default Hide
	} else if (jQuery("#page_template :selected").val() == 'page-templates/coming-soon.php') {
		jQuery('#_custom_page_options').hide();
		jQuery('#_gallery_template_options').hide(); // Default Hide
		jQuery('#coming_soon_template_options').show(); // Default Hide
		jQuery('#blank_template_options').hide(); // Default Hide
	} else if (jQuery("#page_template :selected").val() == 'page-templates/page-blank.php') {
		jQuery('#_custom_page_options').hide();
		jQuery('#_gallery_template_options').hide(); // Default Hide
		jQuery('#coming_soon_template_options').hide(); // Default Hide
		jQuery('#blank_template_options').show(); // Default Hide
	} else {
		jQuery('#_custom_page_options').hide(); // Default Hide
		jQuery('#coming_soon_template_options').hide(); // Default Hide
		jQuery('#_gallery_template_options').hide(); // Default Hide
		jQuery('#blank_template_options').hide(); // Default Hide
	}

	jQuery('#page_template').change(function () {

		if (jQuery("#page_template :selected").val() == 'page-templates/news-page.php') {
			jQuery('#_custom_page_options').show();
			jQuery('#_gallery_template_options').hide(); // Default Hide
			jQuery('#coming_soon_template_options').hide(); // Default Hide
			jQuery('#blank_template_options').hide(); // Default Hide
		} else if (jQuery("#page_template :selected").val() == 'page-templates/attachments-gallery.php') {
			jQuery('#_custom_page_options').hide();
			jQuery('#coming_soon_template_options').hide();
			jQuery('#_gallery_template_options').show(); // Default Hide
			jQuery('#blank_template_options').hide(); // Default Hide
		} else if (jQuery("#page_template :selected").val() == 'page-templates/attachments-gallery-3.php') {
			jQuery('#_custom_page_options').hide();
			jQuery('#coming_soon_template_options').hide();
			jQuery('#_gallery_modify_options').show(); // Default Hide
			jQuery('#blank_template_options').hide(); // Default Hide
		} else if (jQuery("#page_template :selected").val() == 'page-templates/coming-soon.php') {
			jQuery('#_custom_page_options').hide();
			jQuery('#_gallery_template_options').hide(); // Default Hide
			jQuery('#coming_soon_template_options').show(); // Default Hide
			jQuery('#blank_template_options').hide(); // Default Hide
		} else if (jQuery("#page_template :selected").val() == 'page-templates/page-blank.php') {
			jQuery('#_custom_page_options').hide();
			jQuery('#_gallery_template_options').hide(); // Default Hide
			jQuery('#coming_soon_template_options').hide(); // Default Hide
			jQuery('#blank_template_options').show(); // Default Hide
		} else {
			jQuery('#_custom_page_options').hide(); // Default Hide
			jQuery('#_gallery_template_options').hide(); // Default Hide
			jQuery('#coming_soon_template_options').hide(); // Default Hide
			jQuery('#blank_template_options').hide(); // Default Hide
		}

	});

	/**Post featured metaboxes for different post formats**/

	if (jQuery('body').hasClass('post-type-post')) {

		var $post_format_metaboxes = jQuery('#post-format-audio-feature, #post-format-video-feature, #post-format-gallery-feature, #post-format-quote-feature');

		var crum_pf_selected = jQuery("#post-formats-select").find('input:radio[name=post_format]:checked').val();

		$post_format_metaboxes.hide(); // Default Hide

		jQuery('#post-format-' + crum_pf_selected + '-feature').show();

		jQuery('#post-formats-select').find('input:radio[name=post_format]').change(function () {

			$post_format_metaboxes.hide(); // Hide during changing

			crum_pf_selected = jQuery("#post-formats-select").find('input:radio[name=post_format]:checked').val();

			if (this.value == crum_pf_selected) {
				jQuery('#post-format-' + crum_pf_selected + '-feature').show();
			}

		});
	}

});
