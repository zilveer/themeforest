<?php

global $kowloonbay_redux_opts;

if (class_exists('WPLessPlugin')){
	$less = WPLessPlugin::getInstance();

	$less->addVariable('rsCustomLess', $kowloonbay_redux_opts['misc_rs_custom_less'] === '0' ? 'rs-custom.less' : 'rs-custom-blank.less' );

	$less->addVariable('transitionDuration', $kowloonbay_redux_opts['general_transition_duration'] );

	$less->addVariable('bodyTextFontFamily', '"' . $kowloonbay_redux_opts['typography_body_text']['font-family'] . '", Sans-Serif' );
	$less->addVariable('titleTextFontFamily', '"' . $kowloonbay_redux_opts['typography_title_text']['font-family'] . '", Sans-Serif' );

	$less->addVariable('bodyLightFontWeight', $kowloonbay_redux_opts['typography_body_light_font_weight'] );
	$less->addVariable('bodyMediumFontWeight', $kowloonbay_redux_opts['typography_body_medium_font_weight'] );
	$less->addVariable('bodyHeavyFontWeight', $kowloonbay_redux_opts['typography_body_heavy_font_weight'] );
	$less->addVariable('bodyTextLetterSpacing', $kowloonbay_redux_opts['typography_body_text_letter_spacing'] );

	$less->addVariable('titleMediumFontWeight', $kowloonbay_redux_opts['typography_title_medium_font_weight'] );
	$less->addVariable('titleHeavyFontWeight', $kowloonbay_redux_opts['typography_title_heavy_font_weight'] );

	$less->addVariable('bodyTextFontSize', $kowloonbay_redux_opts['typography_body_text']['font-size'] );
	$less->addVariable('webkitFontSmoothing', $kowloonbay_redux_opts['typography_enable_webkit_subpixel_antialiasing'] === '1' ? 'subpixel-antialiased':'antialiased' );

	$less->addVariable('bodyTextColor', $kowloonbay_redux_opts['color_scheme_body_text_color'] );
	$less->addVariable('titleTextColor', $kowloonbay_redux_opts['color_scheme_title_text_color'] );

	$less->addVariable('primaryColor', $kowloonbay_redux_opts['color_scheme_primary_color'] );
	$less->addVariable('bgColor', $kowloonbay_redux_opts['color_scheme_bg_color'] );
	$less->addVariable('homeBgColor', $kowloonbay_redux_opts['color_scheme_home_bg_color'] );

	$less->addVariable('linkColor', $kowloonbay_redux_opts['color_scheme_link_color'] );
	$less->addVariable('linkHoverColor', $kowloonbay_redux_opts['color_scheme_link_hover_color'] );

	$less->addVariable('imageHoverOverlayColor', $kowloonbay_redux_opts['color_scheme_image_hover_overlay_color'] );
	$less->addVariable('imageHoverOverlayOpacity', $kowloonbay_redux_opts['color_scheme_image_hover_overlay_opacity'] );

	$less->addVariable('preloaderBgColor', $kowloonbay_redux_opts['color_scheme_preloader_bg_color'] );
	$less->addVariable('iconColor', $kowloonbay_redux_opts['color_scheme_icon_color'] );
	$less->addVariable('footerTextColor', $kowloonbay_redux_opts['color_scheme_footer_text_color'] );

	$less->addVariable('baseLineHeight', $kowloonbay_redux_opts['dim_base_line_height'] );
	$less->addVariable('height1x', $kowloonbay_redux_opts['dim_base_height'] );
	$less->addVariable('pagePaddingH', $kowloonbay_redux_opts['dim_page_padding_h'] );
	$less->addVariable('pagePaddingV', $kowloonbay_redux_opts['dim_page_padding_v'] );
	$less->addVariable('multiLevelMenuBorderRadius', $kowloonbay_redux_opts['dim_multi_level_menu_border_radius'] );
	$less->addVariable('gutterWidth', $kowloonbay_redux_opts['dim_gutter_width'] );
	$less->addVariable('headerWrapperHeight', $kowloonbay_redux_opts['general_auto_adjust_header_height'] === '1' ? 'auto' : '@baseLineHeight * 2' );

	$less->addVariable('portfolioVideoPostersAlwaysCover', $kowloonbay_redux_opts['portfolio_video_posters_always_cover'] === '1' ? 'cover' : 'contain' );
	
	$less->addVariable('sectionHeadingInitialVisibility', $kowloonbay_redux_opts['animation_section_heading'] === 'no-animation' ? 'visible' : 'hidden' );
	$less->addVariable('sectionDescInitialVisibility', $kowloonbay_redux_opts['animation_section_desc'] === 'no-animation' ? 'visible' : 'hidden' );
	$less->addVariable('itemArrayInitialVisibility', $kowloonbay_redux_opts['animation_item_array'] === 'no-animation' ? 'visible' : 'hidden' );
}