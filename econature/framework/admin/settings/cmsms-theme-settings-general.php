<?php 
/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version 	1.2.1
 * 
 * Admin Panel General Options
 * Created by CMSMasters
 * 
 */


function cmsms_options_general_tabs() {
	$tabs = array();
	
	$tabs['general'] = __('General', 'cmsmasters');
	$tabs['sidebar'] = __('Sidebars', 'cmsmasters');
	$tabs['sitemap'] = __('Sitemap', 'cmsmasters');
	$tabs['error'] = __('404', 'cmsmasters');
	$tabs['lightbox'] = __('Lightbox', 'cmsmasters');
	$tabs['code'] = __('Custom Codes', 'cmsmasters');
	//WPML Installer handler
	$tabs['wpml'] = __('WPML Installer', 'cmsmasters');
	
	if (class_exists('Cmsms_Form_Builder')) {
		$tabs['recaptcha'] = __('reCAPTCHA', 'cmsmasters');
	}
	
	return $tabs;
}


function cmsms_options_general_sections() {
	$tab = cmsms_get_the_tab();
	
	switch ($tab) {
	case 'general':
		$sections = array();
		
		$sections['general_section'] = __('General Options', 'cmsmasters');
		
		break;
	case 'sidebar':
		$sections = array();
		
		$sections['sidebar_section'] = __('Custom Sidebars', 'cmsmasters');
		
		break;
	//WPML Installer
	case 'wpml':
		$sections = array();
		
		$sections['wpml_section'] = __('WPML Installer', 'cmsmasters');
		
		break;
	case 'sitemap':
		$sections = array();
		
		$sections['sitemap_section'] = __('Sitemap Page Options', 'cmsmasters');
		
		break;
	case 'error':
		$sections = array();
		
		$sections['error_section'] = __('404 Error Page Options', 'cmsmasters');
		
		break;
	case 'lightbox':
		$sections = array();
		
		$sections['lightbox_section'] = __('Theme Lightbox Options', 'cmsmasters');
		
		break;
	case 'code':
		$sections = array();
		
		$sections['code_section'] = __('Custom Codes', 'cmsmasters');
		
		break;
	case 'recaptcha':
		$sections = array();
		
		$sections['recaptcha_section'] = __('Form Builder Plugin reCAPTCHA Keys', 'cmsmasters');
		
		break;
	}
	
	return $sections;	
} 


function cmsms_options_general_fields($set_tab = false) {
	if ($set_tab) {
		$tab = $set_tab;
	} else {
		$tab = cmsms_get_the_tab();
	}
	
	$options = array();
	
	switch ($tab) {
	case 'general':
		$options[] = array( 
			'section' => 'general_section', 
			'id' => CMSMS_SHORTNAME . '_theme_layout', 
			'title' => __('Theme Layout', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => 'liquid', 
			'choices' => array( 
				__('Liquid', 'cmsmasters') . '|liquid', 
				__('Boxed', 'cmsmasters') . '|boxed' 
			) 
		);
		
		$options[] = array( 
			'section' => 'general_section', 
			'id' => CMSMS_SHORTNAME . '_responsive', 
			'title' => __('Responsive Layout', 'cmsmasters'), 
			'desc' => __('enable', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'general_section', 
			'id' => CMSMS_SHORTNAME . '_retina', 
			'title' => __('High Resolution', 'cmsmasters'), 
			'desc' => __('enable', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'general_section', 
			'id' => CMSMS_SHORTNAME . '_preload', 
			'title' => __('Ajax Preloader', 'cmsmasters'), 
			'desc' => __('enable', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 0 
		);
		
		$options[] = array( 
			'section' => 'general_section', 
			'id' => CMSMS_SHORTNAME . '_preload_bg', 
			'title' => __('Preloader Background Color', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'color', 
			'std' => '#ffffff' 
		);
		
		$options[] = array( 
			'section' => 'general_section', 
			'id' => CMSMS_SHORTNAME . '_preload_color', 
			'title' => __('Preloader Bar Color', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'color', 
			'std' => '#dadada' 
		);
		
		$options[] = array( 
			'section' => 'general_section', 
			'id' => CMSMS_SHORTNAME . '_preload_effect', 
			'title' => __('Preloader Animation Effect', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'select', 
			'std' => 'grow', 
			'choices' => array( 
				__('Grow', 'cmsmasters') . '|grow', 
				__('Fade', 'cmsmasters') . '|fade', 
				__('Minimal', 'cmsmasters') . '|minimal', 
				__('Flash', 'cmsmasters') . '|flash', 
				__('Barber Shop', 'cmsmasters') . '|barber-shop', 
				__('Mac OSX', 'cmsmasters') . '|mac-osx', 
				__('Fill Left', 'cmsmasters') . '|fill-left', 
				__('Flat Top', 'cmsmasters') . '|flat-top', 
				__('Big Counter', 'cmsmasters') . '|big-counter', 
				__('Corner Indicator', 'cmsmasters') . '|corner-indicator', 
				__('Bounce', 'cmsmasters') . '|bounce', 
				__('Loading Bar', 'cmsmasters') . '|loading-bar', 
				__('Center Circle', 'cmsmasters') . '|center-circle', 
				__('Center Atom', 'cmsmasters') . '|center-atom', 
				__('Center Radar', 'cmsmasters') . '|center-radar', 
				__('Center Simple', 'cmsmasters') . '|center-simple' 
			) 
		);
		
		$options[] = array( 
			'section' => 'general_section', 
			'id' => CMSMS_SHORTNAME . '_preload_percentage', 
			'title' => __('Preloader Percentage', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 0 
		);
		
		break;
	case 'sidebar':
		$options[] = array( 
			'section' => 'sidebar_section', 
			'id' => CMSMS_SHORTNAME . '_sidebar', 
			'title' => __('Custom Sidebars', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'sidebar', 
			'std' => '' 
		);
		
		break;
	//WPML 
	case 'wpml':
		$options[] = array( 
			'section' => 'wpml_section', 
			'id' => CMSMS_SHORTNAME . '_wpml', 
			'title' => __('Add WPML Plugin', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'wpml', 
			'std' => '' 
		);
		
		break;
	case 'sitemap':
		$options[] = array( 
			'section' => 'sitemap_section', 
			'id' => CMSMS_SHORTNAME . '_sitemap_nav', 
			'title' => __('Website Pages', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'sitemap_section', 
			'id' => CMSMS_SHORTNAME . '_sitemap_categs', 
			'title' => __('Blog Archives by Categories', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'sitemap_section', 
			'id' => CMSMS_SHORTNAME . '_sitemap_tags', 
			'title' => __('Blog Archives by Tags', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'sitemap_section', 
			'id' => CMSMS_SHORTNAME . '_sitemap_month', 
			'title' => __('Blog Archives by Month', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'sitemap_section', 
			'id' => CMSMS_SHORTNAME . '_sitemap_pj_categs', 
			'title' => __('Portfolio Archives by Categories', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'sitemap_section', 
			'id' => CMSMS_SHORTNAME . '_sitemap_pj_tags', 
			'title' => __('Portfolio Archives by Tags', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		break;
	case 'error':
		$options[] = array( 
			'section' => 'error_section', 
			'id' => CMSMS_SHORTNAME . '_error_bg_color', 
			'title' => __('Background Color', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'rgba', 
			'std' => '#3d3d3d|100' 
		);
		
		$options[] = array( 
			'section' => 'error_section', 
			'id' => CMSMS_SHORTNAME . '_error_bg_image', 
			'title' => __('Background Image', 'cmsmasters'), 
			'desc' => __('Choose your custom error page background image.', 'cmsmasters'), 
			'type' => 'upload', 
			'std' => '', 
			'frame' => 'select', 
			'multiple' => false 
		);
		
		$options[] = array( 
			'section' => 'error_section', 
			'id' => CMSMS_SHORTNAME . '_error_search', 
			'title' => __('Search Line', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'error_section', 
			'id' => CMSMS_SHORTNAME . '_error_sitemap_button', 
			'title' => __('Sitemap Button', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'error_section', 
			'id' => CMSMS_SHORTNAME . '_error_sitemap_link', 
			'title' => __('Sitemap Page URL', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => '', 
			'class' => '' 
		);
		
		break;
	case 'lightbox':
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => CMSMS_SHORTNAME . '_ilightbox_skin', 
			'title' => __('Skin', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'select', 
			'std' => 'dark', 
			'choices' => array( 
				__('Dark', 'cmsmasters') . '|dark', 
				__('Light', 'cmsmasters') . '|light', 
				__('Mac', 'cmsmasters') . '|mac', 
				__('Metro Black', 'cmsmasters') . '|metro-black', 
				__('Metro White', 'cmsmasters') . '|metro-white', 
				__('Parade', 'cmsmasters') . '|parade', 
				__('Smooth', 'cmsmasters') . '|smooth' 
			) 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => CMSMS_SHORTNAME . '_ilightbox_path', 
			'title' => __('Path', 'cmsmasters'), 
			'desc' => __('Sets path for switching windows', 'cmsmasters'), 
			'type' => 'radio', 
			'std' => 'vertical', 
			'choices' => array( 
				__('Vertical', 'cmsmasters') . '|vertical', 
				__('Horizontal', 'cmsmasters') . '|horizontal' 
			) 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => CMSMS_SHORTNAME . '_ilightbox_infinite', 
			'title' => __('Infinite', 'cmsmasters'), 
			'desc' => __('Sets the ability to infinite the group', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 0 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => CMSMS_SHORTNAME . '_ilightbox_aspect_ratio', 
			'title' => __('Keep Aspect Ratio', 'cmsmasters'), 
			'desc' => __('Sets the resizing method used to keep aspect ratio within the viewport', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => CMSMS_SHORTNAME . '_ilightbox_mobile_optimizer', 
			'title' => __('Mobile Optimizer', 'cmsmasters'), 
			'desc' => __('Make lightboxes optimized for giving better experience with mobile devices', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => CMSMS_SHORTNAME . '_ilightbox_max_scale', 
			'title' => __('Max Scale', 'cmsmasters'), 
			'desc' => __('Sets the maximum viewport scale of the content', 'cmsmasters'), 
			'type' => 'number', 
			'std' => 1, 
			'min' => 0.1, 
			'max' => 2, 
			'step' => 0.05 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => CMSMS_SHORTNAME . '_ilightbox_min_scale', 
			'title' => __('Min Scale', 'cmsmasters'), 
			'desc' => __('Sets the minimum viewport scale of the content', 'cmsmasters'), 
			'type' => 'number', 
			'std' => 0.2, 
			'min' => 0.1, 
			'max' => 2, 
			'step' => 0.05 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => CMSMS_SHORTNAME . '_ilightbox_inner_toolbar', 
			'title' => __('Inner Toolbar', 'cmsmasters'), 
			'desc' => __('Bring buttons into windows, or let them be over the overlay', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 0 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => CMSMS_SHORTNAME . '_ilightbox_smart_recognition', 
			'title' => __('Smart Recognition', 'cmsmasters'), 
			'desc' => __('Sets content auto recognize from web pages', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 0 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => CMSMS_SHORTNAME . '_ilightbox_fullscreen_one_slide', 
			'title' => __('Fullscreen One Slide', 'cmsmasters'), 
			'desc' => __('Decide to fullscreen only one slide or hole gallery the fullscreen mode', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 0 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => CMSMS_SHORTNAME . '_ilightbox_fullscreen_viewport', 
			'title' => __('Fullscreen Viewport', 'cmsmasters'), 
			'desc' => __('Sets the resizing method used to fit content within the fullscreen mode', 'cmsmasters'), 
			'type' => 'select', 
			'std' => 'center', 
			'choices' => array( 
				__('Center', 'cmsmasters') . '|center', 
				__('Fit', 'cmsmasters') . '|fit', 
				__('Fill', 'cmsmasters') . '|fill', 
				__('Stretch', 'cmsmasters') . '|stretch' 
			) 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => CMSMS_SHORTNAME . '_ilightbox_controls_toolbar', 
			'title' => __('Toolbar Controls', 'cmsmasters'), 
			'desc' => __('Sets buttons be available or not', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => CMSMS_SHORTNAME . '_ilightbox_controls_arrows', 
			'title' => __('Arrow Controls', 'cmsmasters'), 
			'desc' => __('Enable the arrow buttons', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 0 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => CMSMS_SHORTNAME . '_ilightbox_controls_fullscreen', 
			'title' => __('Fullscreen Controls', 'cmsmasters'), 
			'desc' => __('Sets the fullscreen button', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => CMSMS_SHORTNAME . '_ilightbox_controls_thumbnail', 
			'title' => __('Thumbnails Controls', 'cmsmasters'), 
			'desc' => __('Sets the thumbnail navigation', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => CMSMS_SHORTNAME . '_ilightbox_controls_keyboard', 
			'title' => __('Keyboard Controls', 'cmsmasters'), 
			'desc' => __('Sets the keyboard navigation', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => CMSMS_SHORTNAME . '_ilightbox_controls_mousewheel', 
			'title' => __('Mouse Wheel Controls', 'cmsmasters'), 
			'desc' => __('Sets the mousewheel navigation', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => CMSMS_SHORTNAME . '_ilightbox_controls_swipe', 
			'title' => __('Swipe Controls', 'cmsmasters'), 
			'desc' => __('Sets the swipe navigation', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => CMSMS_SHORTNAME . '_ilightbox_controls_slideshow', 
			'title' => __('Slideshow Controls', 'cmsmasters'), 
			'desc' => __('Enable the slideshow feature and button', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 0 
		);
		
		break;
	case 'code':
		$options[] = array( 
			'section' => 'code_section', 
			'id' => CMSMS_SHORTNAME . '_google_analytics', 
			'title' => __('Google Analytics', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'textarea', 
			'std' => '', 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'code_section', 
			'id' => CMSMS_SHORTNAME . '_custom_css', 
			'title' => __('Custom CSS', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'textarea', 
			'std' => '', 
			'class' => 'allowlinebreaks' 
		);
		
		$options[] = array( 
			'section' => 'code_section', 
			'id' => CMSMS_SHORTNAME . '_custom_js', 
			'title' => __('Custom JavaScript', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'textarea', 
			'std' => '', 
			'class' => 'allowlinebreaks' 
		);
		
		$options[] = array( 
			'section' => 'code_section', 
			'id' => CMSMS_SHORTNAME . '_api_key', 
			'title' => __('Twitter API key', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => '', 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'code_section', 
			'id' => CMSMS_SHORTNAME . '_api_secret', 
			'title' => __('Twitter API secret', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => '', 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'code_section', 
			'id' => CMSMS_SHORTNAME . '_access_token', 
			'title' => __('Twitter Access token', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => '', 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'code_section', 
			'id' => CMSMS_SHORTNAME . '_access_token_secret', 
			'title' => __('Twitter Access token secret', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => '', 
			'class' => '' 
		);
		
		break;
	case 'recaptcha':
		$options[] = array( 
			'section' => 'recaptcha_section', 
			'id' => CMSMS_SHORTNAME . '_recaptcha_public_key', 
			'title' => __('reCAPTCHA Public Key', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => '', 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'recaptcha_section', 
			'id' => CMSMS_SHORTNAME . '_recaptcha_private_key', 
			'title' => __('reCAPTCHA Private Key', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => '', 
			'class' => '' 
		);
		
		break;
	}
	
	return $options;	
}

