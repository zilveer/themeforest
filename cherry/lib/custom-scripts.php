<?php //Custom scripts in options panel
if (!function_exists('optionsframework_custom_scripts')) {

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {
	
	//Show/hide First Section
	jQuery('#homepage_first_section').click(function() {
		jQuery('#section-homepage_first_section_title,#section-homepage_left_module_title,#section-homepage_left_module_editor,#section-homepage_right_module_title,#section-homepage_right_module_editor').fadeToggle(400);
	});
	
	if (jQuery('#homepage_first_section:checked').val() !== undefined) {
		jQuery('#section-homepage_first_section_title,#section-homepage_left_module_title,#section-homepage_left_module_editor,#section-homepage_right_module_title,#section-homepage_right_module_editor').show();
	}
	
	//Show/hide Second Section
	jQuery('#homepage_second_section').click(function() {
		jQuery('#section-homepage_second_section_title,#section-homepage_portfolio_title,#section-homepage_portfolio_editor,#section-portfolio_select_categories,#section-portfolio_nr_posts,#section-home_portfolio_hover').fadeToggle(400);
	});
	
	if (jQuery('#homepage_second_section:checked').val() !== undefined) {
		jQuery('#section-homepage_second_section_title,#section-homepage_portfolio_title,#section-homepage_portfolio_editor,#section-portfolio_select_categories,#section-portfolio_nr_posts,#section-home_portfolio_hover').show();
	}
	
	//Show/hide Third Section
	jQuery('#homepage_third_section').click(function() {
		jQuery('#section-homepage_third_section_title,#section-sponsors_nr_posts').fadeToggle(400);
	});
	
	if (jQuery('#homepage_third_section:checked').val() !== undefined) {
		jQuery('#section-homepage_third_section_title,#section-sponsors_nr_posts').show();
	}
	
	
	//Show/hide logo options
	jQuery('#use_logo_image').click(function() {
		jQuery('#section-header_logo,#section-logo_width,#section-logo_height').fadeToggle(400);
	});
	
	if (jQuery('#use_logo_image:checked').val() !== undefined) {
		jQuery('#section-header_logo,#section-logo_width,#section-logo_height').show();
	}
	
	//Show/hide favicon options
	jQuery('#use_favicon').click(function() {
		jQuery('#section-favicon_logo').fadeToggle(400);
	});
	
	if (jQuery('#use_favicon:checked').val() !== undefined) {
		jQuery('#section-favicon_logo').show();
	}
	//Show/hide admin logo options
	jQuery('#use_wp_admin_logo').click(function() {
		jQuery('#section-wp_admin_logo').fadeToggle(400);
	});
	
	if (jQuery('#use_wp_admin_logo:checked').val() !== undefined) {
		jQuery('#section-wp_admin_logo').show();
	}
	//Show/hide slideshow options
	function HideAll() {
		jQuery("#section-auto_animate").css("display", "none");
		jQuery("#section-randomize_order").css("display", "none");
		jQuery("#section-display_navigation").css("display", "none");
		jQuery("#section-display_pager").css("display", "none");
		jQuery("#section-camera_display_thumb_pager").css("display", "none");
		jQuery("#section-camera_loader").css("display", "none");
		jQuery("#section-camera_effect").css("display", "none");
		
		jQuery("#section-body_background").css("display", "none");
		jQuery("#section-pattern_background").css("display", "none");
	}
	HideAll();
	
	var group = jQuery('#slideshow_select');
	group.change( function() {
		
		if(jQuery(this).val() == 'classic') {
			jQuery('#section-auto_animate, #section-randomize_order, #section-display_navigation, #section-display_pager').show();
			jQuery('#section-camera_display_thumb_pager, #section-camera_loader, #section-camera_effect').hide();
		
		} else if(jQuery(this).val() == 'sequence') {
			jQuery('#section-auto_animate, #section-display_navigation, #section-display_pager').show();
			jQuery('#section-camera_display_thumb_pager, #section-camera_loader, #section-camera_effect, #section-randomize_order').hide();

		} else if(jQuery(this).val() == 'camera') {
			jQuery('#section-auto_animate, #section-display_navigation, #section-display_pager, #section-camera_loader, #section-camera_effect, #section-camera_display_thumb_pager').show();
			jQuery('#section-randomize_order').hide();
			
		} else {
			HideAll();
		}
		
	});
	
	var grouplayout = jQuery('#layout_style');
	grouplayout.change( function() {
		
		if(jQuery(this).val() == 'boxed') {
			jQuery('#section-body_background, #section-pattern_background').show();
		
		} else if(jQuery(this).val() == 'full') {
			jQuery('#section-body_background, #section-pattern_background').hide();
			
		} else {
			HideAll();
		}
		
	});
	
	
	//If selected display
	if (jQuery('#slideshow_select option:selected').val() == 'classic') {
		jQuery('#section-auto_animate, #section-randomize_order, #section-display_navigation, #section-display_pager').show();
	}
	
	if (jQuery('#slideshow_select option:selected').val() == 'sequence') {
		jQuery('#section-auto_animate, #section-display_navigation, #section-display_pager').show();
	}
	
	if (jQuery('#slideshow_select option:selected').val() == 'camera') {
		jQuery('#section-auto_animate, #section-display_navigation, #section-display_pager, #section-camera_loader, #section-camera_effect, #section-camera_display_thumb_pager').show();
	}
	
	//If selected layout
	if (jQuery('#layout_style option:selected').val() == 'boxed') {
		jQuery('#section-body_background, #section-pattern_background').show();
	}
	
});
</script>

<?php } }