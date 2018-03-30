<?php
/**
 * Theme Stylesheet Options
 * Refer to Theme Options
 * @package Magzilla
 * @since 	Magzilla 1.0
 **/
global $ft_option;
function fave_custom_styling(){

	global $ft_option;

	/*Body Typo*/
	$body_typo				= $ft_option['body_typo'];
	$body_font_size 	    = $body_typo['font_size'];
	$body_line_height  		= $body_typo['line_height'];
	$body_font_weight  		= $body_typo['font_weight'];
	$body_font_style  		= $body_typo['font_style'];
	$body_letter_spacing  	= $body_typo['letter_spacing'];
	$body_text_transform  	= $body_typo['text_transform'];

	$body_text_color 	    = isset( $ft_option['body_text_color'] ) ? $ft_option['body_text_color'] : '#282828';
	$body_bg_color  	    = isset( $ft_option['body_bg_color'] ) ? $ft_option['body_bg_color'] : '#ffffff';

	/*Titles Typo*/
	$titles_typo				= $ft_option['titles_typo'];
	$titles_typo_font_size 	    = $titles_typo['font_size'];
	$titles_typo_line_height  		= $titles_typo['line_height'];
	$titles_typo_font_weight  		= $titles_typo['font_weight'];
	$titles_typo_font_style  		= $titles_typo['font_style'];
	$titles_typo_letter_spacing  	= $titles_typo['letter_spacing'];
	$titles_typo_text_transform  	= $titles_typo['text_transform'];

	$site_layout 		    = isset( $ft_option['site_layout'] ) ? $ft_option['site_layout'] : 'wide-layout';
	$background_type 	    = isset( $ft_option['background_type'] ) ? $ft_option['background_type'] : '';
	$background_patterns    = isset( $ft_option['background_patterns'] ) ? $ft_option['background_patterns'] : '';
	$site_bg_image          = isset( $ft_option['site_bg_image'] ) ? $ft_option['site_bg_image'] : '';

	$bg_repeat              = isset( $ft_option['bg_repeat'] ) ? $ft_option['bg_repeat'] : '';
	$bg_attachment          = isset( $ft_option['bg_attachment'] ) ? $ft_option['bg_attachment'] : '';
	$bg_position            = isset( $ft_option['bg_position'] ) ? $ft_option['bg_position'] : '';
	$bg_size                = isset( $ft_option['bg_size'] ) ? $ft_option['bg_size'] : '';
	$bg_color               = isset( $ft_option['bg_color'] ) ? $ft_option['bg_color'] : '';

	$logo_margin_top        = isset( $ft_option['site_logo_margin_top'] ) ? $ft_option['site_logo_margin_top'] : '';
	$logo_margin_bottom        = isset( $ft_option['site_logo_margin_bottom'] ) ? $ft_option['site_logo_margin_bottom'] : '';

	/*Main Menu Typo*/
	$main_nav_typo 			= $ft_option['main_nav_typo'];
	$google_main_nav        = isset( $ft_option['google_main_nav'] ) ? $ft_option['google_main_nav'] : 0;
	$standard_main_nav      = isset( $ft_option['standard_main_nav'] ) ? $ft_option['standard_main_nav'] : 0;
	$main_nav_font_size     = $main_nav_typo['font_size'];

	$main_nav_line_height  	  = $main_nav_typo['line_height'];
	$main_nav_font_weight  	  = $main_nav_typo['font_weight'];
	$main_nav_font_style  	  = $main_nav_typo['font_style'];
	$main_nav_letter_spacing  = $main_nav_typo['letter_spacing'];
	$main_nav_text_transform  = $main_nav_typo['text_transform'];


	/*Top Menu Typo*/
	$top_nav_typo 			= $ft_option['top_nav_typo'];
	$google_secondary_nav   = isset( $ft_option['google_secondary_nav'] ) ? $ft_option['google_secondary_nav'] : 0;
	$standard_secondary_nav = isset( $ft_option['standard_secondary_nav'] ) ? $ft_option['standard_secondary_nav'] : 0;
	$top_nav_font_size      = $top_nav_typo['font_size'];
	$top_nav_line_height  	= $top_nav_typo['line_height'];
	$top_nav_font_weight  	= $top_nav_typo['font_weight'];
	$top_nav_font_style  	= $top_nav_typo['font_style'];
	$top_nav_letter_spacing = $top_nav_typo['letter_spacing'];
	$top_nav_text_transform = $top_nav_typo['text_transform'];
	$topnav_text_color      = isset( $ft_option['topnav_text_color'] ) ? $ft_option['topnav_text_color'] : 0;
	$topnav_bg_color        = isset( $ft_option['topnav_bg_color'] ) ? $ft_option['topnav_bg_color'] : '#f7f7f7';
	$topnav_border_bottom_color   = isset( $ft_option['topnav_border_bottom_color'] ) ? $ft_option['topnav_border_bottom_color'] : '#D1D1D1';

	/*Main Nav*/
	$mainnav_bg_color      = isset( $ft_option['mainnav_bg_color'] ) ? $ft_option['mainnav_bg_color'] : '#ffffff';
	$mainnav_text_color    = isset( $ft_option['mainnav_text_color'] ) ? $ft_option['mainnav_text_color'] : '#000000';
	$mainnav_border_color   = isset( $ft_option['mainnav_border_color'] ) ? $ft_option['mainnav_border_color'] : '#E3E3E3';

	/*Mobile Nav*/
	$mobile_nav_color        = isset( $ft_option['mobile_nav_color'] ) ? $ft_option['mobile_nav_color'] : '#ffffff';
	$mobile_nav_border_color = isset( $ft_option['mobile_nav_border_color'] ) ? $ft_option['mobile_nav_border_color'] : '#E3E3E3';
	$mobile_nav_icons_color  = isset( $ft_option['mobile_nav_icons_color'] ) ? $ft_option['mobile_nav_icons_color'] : '#000000';


	$footer_bg_color        = isset( $ft_option['footer_bg_color'] ) ? $ft_option['footer_bg_color'] : '#333333';
	$footer_titles_color    = isset( $ft_option['footer_titles_color'] ) ? $ft_option['footer_titles_color'] : '#cccccc';
	$footer_links_color     = isset( $ft_option['footer_links_color'] ) ? $ft_option['footer_links_color'] : '#ffffff';
	$footer_bottom_bg_color = isset( $ft_option['footer_bottom_bg_color'] ) ? $ft_option['footer_bottom_bg_color'] : '#000000';
	$footer_bottom_text_color = isset( $ft_option['footer_bottom_text_color'] ) ? $ft_option['footer_bottom_text_color'] : '#666666';

	/*Logo Typo*/
	$logo_typo 				= $ft_option['logo_typo'];
	$google_font_logo       = isset( $ft_option['google_font_logo'] ) ? $ft_option['google_font_logo'] : 0;
	$standard_font_logo     = isset( $ft_option['standard_font_logo'] ) ? $ft_option['standard_font_logo'] : 0;
	$logo_font_size      	= $logo_typo['font_size'];
	$logo_line_height       = $logo_typo['line_height'];
	$logo_font_weight       = $logo_typo['font_weight'];
	$logo_font_style  		= $logo_typo['font_style'];
	$logo_letter_spacing 	= $logo_typo['letter_spacing'];
	$logo_text_transform 	= $logo_typo['text_transform'];

	$text_logo_color      = isset( $ft_option['text_logo_color'] ) ? $ft_option['text_logo_color'] : '#000000';
	$tagline_color      = isset( $ft_option['tagline_color'] ) ? $ft_option['tagline_color'] : '#141414';
	$header_backgroud_color      = isset( $ft_option['header_bg_color'] ) ? $ft_option['header_bg_color'] : '#ffffff';


	/*Modules Titles Typo*/
	$module_title_typo 			= $ft_option['module_title_typo'];
	$google_font_module_title = isset( $ft_option['google_font_module_title'] ) ? $ft_option['google_font_module_title'] : 0;
	$standard_font_module_title = isset( $ft_option['standard_font_module_title'] ) ? $ft_option['standard_font_module_title'] : 0;
	
	$module_title_font_size   = $module_title_typo['font_size'];
	$module_title_line_height = $module_title_typo['line_height'];
	$module_title_font_weight = $module_title_typo['font_weight'];
	$module_title_font_style  		= $module_title_typo['font_style'];
	$module_title_letter_spacing 	= $module_title_typo['letter_spacing'];
	$module_title_text_transform 	= $module_title_typo['text_transform'];

	/*Post titles small typo*/
	$post_title_small_typo 		 = $ft_option['post_title_small_typo'];
	$post_title_small_font_size   = $post_title_small_typo['font_size'];
	$post_title_small_line_height = $post_title_small_typo['line_height'];
	$post_title_small_font_weight = $post_title_small_typo['font_weight'];
	$post_title_small_font_style  		= $post_title_small_typo['font_style'];
	$post_title_small_letter_spacing 	= $post_title_small_typo['letter_spacing'];
	$post_title_small_text_transform 	= $post_title_small_typo['text_transform'];

	/*Post titles big typo*/
	$post_title_big_typo 		 = $ft_option['post_title_big_typo'];
	$post_title_big_font_size   = $post_title_big_typo['font_size'];
	$post_title_big_line_height = $post_title_big_typo['line_height'];
	$post_title_big_font_weight = $post_title_big_typo['font_weight'];
	$post_title_big_font_style  		= $post_title_big_typo['font_style'];
	$post_title_big_letter_spacing 	= $post_title_big_typo['letter_spacing'];
	$post_title_big_text_transform 	= $post_title_big_typo['text_transform'];


	/*Widget Title*/
	$widgets_title_typo 		 = $ft_option['widgets_title_typo'];
	$google_font_widget_title    = isset( $ft_option['google_font_widget_title'] ) ? $ft_option['google_font_widget_title'] : 0;
	$standard_font_widget_title  = isset( $ft_option['standard_font_widget_title'] ) ? $ft_option['standard_font_widget_title'] : 0;
	$widget_title_font_size   = $widgets_title_typo['font_size'];
	$widget_title_line_height = $widgets_title_typo['line_height'];
	$widget_title_font_weight = $widgets_title_typo['font_weight'];
	$widget_title_font_style  		= $widgets_title_typo['font_style'];
	$widget_title_letter_spacing 	= $widgets_title_typo['letter_spacing'];
	$widget_title_text_transform 	= $widgets_title_typo['text_transform'];

	$widget_title_align = isset( $ft_option['widget_title_align'] ) ? $ft_option['widget_title_align'] : 'left';


	/*Breadcrumb Typo*/
	$breadcrumb_typo 		 = $ft_option['breadcrumb_typo'];
	$google_font_breadcrumb      = isset( $ft_option['google_font_breadcrumb'] ) ? $ft_option['google_font_breadcrumb'] : 0;
	$standard_font_breadcrumb    = isset( $ft_option['standard_font_breadcrumb'] ) ? $ft_option['standard_font_breadcrumb'] : 0;
	$breadcrumb_font_size   = $breadcrumb_typo['font_size'];
	$breadcrumb_line_height = $breadcrumb_typo['line_height'];
	$breadcrumb_font_weight = $breadcrumb_typo['font_weight'];
	$breadcrumb_font_style  		= $breadcrumb_typo['font_style'];
	$breadcrumb_letter_spacing 	= $breadcrumb_typo['letter_spacing'];
	$breadcrumb_text_transform 	= $breadcrumb_typo['text_transform'];

	/*Single Title*/
	$single_title_typo 		 = $ft_option['single_title_typo'];
	$google_font_single_title    = isset( $ft_option['google_font_single_title'] ) ? $ft_option['google_font_single_title'] : 0;
	$standard_font_single_title  = isset( $ft_option['standard_font_single_title'] ) ? $ft_option['standard_font_single_title'] : 0;
	$single_title_font_size   = $single_title_typo['font_size'];
	$single_title_line_height = $single_title_typo['line_height'];
	$single_title_font_weight = $single_title_typo['font_weight'];
	$single_title_font_style  		= $single_title_typo['font_style'];
	$single_title_letter_spacing 	= $single_title_typo['letter_spacing'];
	$single_title_text_transform 	= $single_title_typo['text_transform'];


	/*Post Meta Typo*/
	$post_meta_typo 		 = $ft_option['post_meta_typo'];
	$google_font_post_meta       = isset( $ft_option['google_font_post_meta'] ) ? $ft_option['google_font_post_meta'] : 0;
	$standard_font_post_meta     = isset( $ft_option['standard_font_post_meta'] ) ? $ft_option['standard_font_post_meta'] : 0;
	$post_meta_font_size   = $post_meta_typo['font_size'];
	$post_meta_line_height = $post_meta_typo['line_height'];
	$post_meta_font_weight = $post_meta_typo['font_weight'];
	$post_meta_font_style  		= $post_meta_typo['font_style'];
	$post_meta_letter_spacing 	= $post_meta_typo['letter_spacing'];
	$post_meta_text_transform 	= $post_meta_typo['text_transform'];


	/*Single Meta Typo*/
	$single_meta_typo 		 = $ft_option['single_meta_typo'];
	$google_font_single_meta     = isset( $ft_option['google_font_single_meta'] ) ? $ft_option['google_font_single_meta'] : 0;
	$standard_font_single_meta   = isset( $ft_option['standard_font_single_meta'] ) ? $ft_option['standard_font_single_meta'] : 0;
	$single_meta_font_size   = $single_meta_typo['font_size'];
	$single_meta_line_height = $single_meta_typo['line_height'];
	$single_meta_font_weight = $single_meta_typo['font_weight'];
	$single_meta_font_style  		= $single_meta_typo['font_style'];
	$single_meta_letter_spacing 	= $single_meta_typo['letter_spacing'];
	$single_meta_text_transform 	= $single_meta_typo['text_transform'];

	/*Single Sections Typo*/
	$single_sections_typo 		 = $ft_option['single_sections_typo'];
	$google_font_single_sections   = isset( $ft_option['google_font_single_sections'] ) ? $ft_option['google_font_single_sections'] : 0;
	$standard_font_single_sections = isset( $ft_option['standard_font_single_sections'] ) ? $ft_option['standard_font_single_sections'] : 0;
	$single_sections_font_size   = $single_sections_typo['font_size'];
	$single_sections_line_height = $single_sections_typo['line_height'];
	$single_sections_font_weight = $single_sections_typo['font_weight'];
	$single_sections_font_style  		= $single_sections_typo['font_style'];
	$single_sections_letter_spacing 	= $single_sections_typo['letter_spacing'];
	$single_sections_text_transform 	= $single_sections_typo['text_transform'];


	$google_font_section_title      = isset( $ft_option['google_font_section_title'] ) ? $ft_option['google_font_section_title'] : 0;
	$standard_font_section_title    = isset( $ft_option['standard_font_section_title'] ) ? $ft_option['standard_font_section_title'] : 0;

	$google_font_headings      = isset( $ft_option['google_font_headings'] ) ? $ft_option['google_font_headings'] : 0;
	$standard_font_headings    = isset( $ft_option['standard_font_headings'] ) ? $ft_option['standard_font_headings'] : 0;

	$h1_font_size    = isset( $ft_option['h1_font_size'] ) ? $ft_option['h1_font_size'] : 40;
	$h1_line_height  = isset( $ft_option['h1_line_height'] ) ? $ft_option['h1_line_height'] : 48;
	$h1_font_weight  = isset( $ft_option['h1_font_weight'] ) ? $ft_option['h1_font_weight'] : 500;

	$h2_font_size    = isset( $ft_option['h2_font_size'] ) ? $ft_option['h2_font_size'] : 32;
	$h2_line_height  = isset( $ft_option['h2_line_height'] ) ? $ft_option['h2_line_height'] : 40;
	$h2_font_weight  = isset( $ft_option['h2_font_weight'] ) ? $ft_option['h2_font_weight'] : 500;

	$h3_font_size    = isset( $ft_option['h3_font_size'] ) ? $ft_option['h3_font_size'] : 24;
	$h3_line_height  = isset( $ft_option['h3_line_height'] ) ? $ft_option['h3_line_height'] : 32;
	$h3_font_weight  = isset( $ft_option['h3_font_weight'] ) ? $ft_option['h3_font_weight'] : 500;

	$h4_font_size    = isset( $ft_option['h4_font_size'] ) ? $ft_option['h4_font_size'] : 20;
	$h4_line_height  = isset( $ft_option['h4_line_height'] ) ? $ft_option['h4_line_height'] : 28;
	$h4_font_weight  = isset( $ft_option['h4_font_weight'] ) ? $ft_option['h4_font_weight'] : 500;

	$h5_font_size    = isset( $ft_option['h5_font_size'] ) ? $ft_option['h5_font_size'] : 18;
	$h5_line_height  = isset( $ft_option['h5_line_height'] ) ? $ft_option['h5_line_height'] : 26;
	$h5_font_weight  = isset( $ft_option['h5_font_weight'] ) ? $ft_option['h5_font_weight'] : 700;

	$h6_font_size    = isset( $ft_option['h6_font_size'] ) ? $ft_option['h6_font_size'] : 16;
	$h6_line_height  = isset( $ft_option['h6_line_height'] ) ? $ft_option['h6_line_height'] : 24;
	$h6_font_weight  = isset( $ft_option['h6_font_weight'] ) ? $ft_option['h6_font_weight'] : 700;

	$sidebar_bg_color       = isset( $ft_option['sidebar_bg_color'] ) ? $ft_option['sidebar_bg_color'] : '#f7f7f7';
	$sidebar_pending_top    = isset( $ft_option['sidebar_pending_top'] ) ? $ft_option['sidebar_pending_top'] : 30;
	$sidebar_pending_bottom = isset( $ft_option['sidebar_pending_bottom'] ) ? $ft_option['sidebar_pending_bottom'] : 30;
	$sidebar_pending_left   = isset( $ft_option['sidebar_pending_left'] ) ? $ft_option['sidebar_pending_left'] : 30;
	$sidebar_pending_right  = isset( $ft_option['sidebar_pending_right'] ) ? $ft_option['sidebar_pending_right'] : 30;

	$header_5_bg_color  = isset( $ft_option['header_5_bg_color'] ) ? $ft_option['header_5_bg_color'] : '#ffffff';
	$header_5_text_color  = isset( $ft_option['header_5_text_color'] ) ? $ft_option['header_5_text_color'] : '#000000';
	$header_5_text_hover_color  = isset( $ft_option['header_5_text_hover_color'] ) ? $ft_option['header_5_text_hover_color'] : '#ffffff';

	$sidebar_border = $ft_option['sidebar_border'];

	$bg_img_url = get_template_directory_uri().'/admin/assets/images/pattern/';
	?>

	<style type="text/css">

		/********************** Body **********************/
		<?php
		if( isset( $ft_option['google_body'] ) && $ft_option['google_body'] != '0' ) {
			$body_font = '"'.$ft_option['google_body'].'", serif';
		} elseif( isset( $ft_option['standard_body'] ) && $ft_option['standard_body'] != '0') {
			$body_font = $ft_option['standard_body'];
		}
		?>

		<?php if( ( isset( $ft_option['google_body'] ) && $ft_option['google_body'] != '0' ) || ( isset( $ft_option['standard_body'] ) && $ft_option['standard_body'] != '0' ) ) { ?>

		body,
		.calendar caption,
		.calendar,
		.value-number,
		.value-text,
		.progress-bar,
		.form-control,
		.mag-info,
		.post-tags a,
		.btn,
		.wpcf7-submit {
			font-family: <?php echo $body_font; ?>;
		}


		<?php } ?>

		body {
			font-size: <?php echo $body_font_size; ?>px;
			line-height: <?php echo $body_line_height; ?>px;
			color: <?php echo $body_text_color; ?>;
			background-color: <?php echo $body_bg_color; ?>;
		    font-weight: <?php echo $body_font_weight; ?>;
		    font-style: <?php echo $body_font_style; ?>;
		    letter-spacing: <?php echo $body_letter_spacing; ?>px;
		    text-transform: <?php echo $body_text_transform; ?>;
		}
		@media (max-width: 480px) {
			body {
				font-size: 14px;
				line-height: 24px;
				color: <?php echo $body_text_color; ?>;
				background-color: <?php echo $body_bg_color; ?>;
			}
			.continue-reading {
				font-size: <?php echo $body_font_size - 4; ?>px;
			}
		}

		#bbpress-forums, 
		#bbpress-forums ul.bbp-lead-topic, 
		#bbpress-forums ul.bbp-topics, 
		#bbpress-forums ul.bbp-forums, 
		#bbpress-forums ul.bbp-replies, 
		#bbpress-forums ul.bbp-search-results {
			font-size: <?php echo $body_font_size; ?>px;
			line-height: <?php echo $body_line_height; ?>px;
			color: <?php echo $body_text_color; ?>;
		    font-weight: <?php echo $body_font_weight; ?>;
		    font-style: <?php echo $body_font_style; ?>;
		    letter-spacing: <?php echo $body_letter_spacing; ?>px;
		    text-transform: <?php echo $body_text_transform; ?>;
		}
		
		.comment-entry {
			font-size: <?php echo $body_font_size; ?>px;
			line-height: <?php echo $body_line_height; ?>px;
			color: <?php echo $body_text_color; ?>;
		    font-weight: <?php echo $body_font_weight; ?>;
		    font-style: <?php echo $body_font_style; ?>;
		    letter-spacing: <?php echo $body_letter_spacing; ?>px;
		    text-transform: <?php echo $body_text_transform; ?>;
		}
		/****************************************** Titles and headings *************************************/
		<?php
		if( isset( $ft_option['google_font_titles'] ) && $ft_option['google_font_titles'] != '0') {
			$headings_font = '"'.$ft_option['google_font_titles'].'", sans-serif';
		} elseif( isset( $ft_option['standard_font_titles'] ) && $ft_option['standard_font_titles'] != '0') {
			$headings_font = $ft_option['standard_font_titles'];
		}
		?>

		<?php if( ( isset( $ft_option['google_font_titles'] ) && $ft_option['google_font_titles'] != '0' ) || ( isset( $ft_option['standard_font_titles'] ) && $ft_option['standard_font_titles'] != '0' ) ) { ?>

		.widget .post-title.module-small-title,
		.widget .post-title.module-big-title,
		.widget .post-title,
		.archive .post-title,
		.archive .post-title.module-big-title, 
		.archive .post-title.module-small-title,
		.overlay,
		.wp-caption .image-credits,
		.score-label,
		.widget_tags a,
		select,
		.table > thead > tr > th,
		.widget-social-profiles,
		.modal-title,
		.modal,
		.post-navigation a,
		.comment-author,
		.comment-date,
		.reply,
		.slider-label,
		.post-gallery,
		.wp-caption-text,
		.progress-title,
		.widget-tabs .nav > li > a,
		.video-gallery-top,
		.video-gallery,
		.breadcrumb,
		.page-title,
		.sitemap h2,
		.magazilla-main-nav .post-title.module-small-title {
			font-family: <?php echo $headings_font; ?>;
		}
		.archive .post-title {
			font-size: <?php echo $titles_typo_font_size; ?>px;
			line-height: <?php echo $titles_typo_line_height; ?>px;
			font-weight: <?php echo $titles_typo_font_weight; ?>;
			font-style: <?php echo $titles_typo_font_style; ?>;
		    letter-spacing: <?php echo $titles_typo_letter_spacing; ?>px;
			text-transform: <?php echo $titles_typo_text_transform; ?>; 
		}
		.search-results .page-title,
		.search-result-posts .post-title,
		.archive .page-title {
			font-size: <?php echo $titles_typo_font_size - 8; ?>px;
			line-height: <?php echo $titles_typo_line_height - 8; ?>px;
		}
		<?php } ?>

		/* ******************************************************** */
		/* Site Layout
		/* ******************************************************** */

		<?php

		$bg = '';
		if( $background_type == "bg_pattern" ) {

			if( !empty($background_patterns) ):
				$bg = 'background-image: url("'.$bg_img_url.$background_patterns.'.png");';
			endif;

		} elseif ( $background_type == "custom_image" ) {

			if( !empty($site_bg_image) ):
				$bg = 'background-image: url("'.$site_bg_image.'");';
			endif;

		}
		?>

		<?php if( $site_layout == "boxed-layout" || $site_layout == "framed-layout" ) { ?>
		.boxed-layout {
			background-color: <?php echo $bg_color; ?>;
		<?php echo $bg; ?>
			background-repeat: <?php echo $bg_repeat; ?>;
			background-position: <?php echo $bg_position; ?>;
			background-size: <?php echo $bg_size; ?>;
			background-attachment: <?php echo $bg_attachment; ?>;
		}
		<?php } ?>

		<?php
		$container_width = $ft_option['site_container_width'];
		$actual_container = $container_width + 30;

		$boxed_external_wrap = $actual_container + 30;
		?>

		@media (min-width: 1200px) {

			.container {
				max-width: <?php echo $actual_container; ?>px;
				width: auto;
			}

			.boxed-layout .external-wrap {
				max-width: <?php echo $boxed_external_wrap; ?>px;
			}
		}

		<?php if( $site_layout == "framed-layout" ) { ?>
		.framed-layout {
			margin: 30px auto !important;
		}
		<?php } ?>


		/* *********************************************************
		/* Logo Settings
		/* *********************************************************/

		<?php
		if( !empty($logo_margin_top) ) {
			$logo_margin_top = 'margin-top: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $logo_margin_top ) ? $logo_margin_top : $logo_margin_top . 'px' ) . ';';
		}
		if( !empty($logo_margin_bottom) ) {
			$logo_margin_bottom = 'margin-bottom: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $logo_margin_bottom ) ? $logo_margin_bottom : $logo_margin_bottom . 'px' ) . ';';
		}
		?>
		.logo-wrap, .header-7 .logo-wrap {
		<?php echo $logo_margin_top; ?>;
		<?php echo $logo_margin_bottom; ?>;
		}

		.mag-info {
			color: <?php echo $tagline_color; ?>
		}

		.header-1,
		.header-2,
		.header-3,
		.header-4,
		.header-6 {
		    background-color: <?php echo $header_backgroud_color; ?>;
		}


		/* ******************************************************** */
		/* Primary Nav
		/* ******************************************************** */
		<?php
		if( $google_main_nav != '0') {
			$primary_nav = '"'.$google_main_nav.'", sans-serif';
		} elseif( $standard_main_nav != '0') {
			$primary_nav = $standard_main_nav;
		}
		?>

		<?php if( $google_main_nav != '0' || $standard_main_nav != '0' ) { ?>
		.magazilla-main-nav,
		.mobile-menu,
		.header-5,
		.header-7 {
			font-family: <?php echo $primary_nav; ?>;
		}
		<?php } ?>
		.magazilla-main-nav .nav > li > a,
		.mobile-menu .nav > li > a,
		.header-5 > li > a,
		.header-7 > li > a {
			font-size: <?php echo $main_nav_font_size; ?>px;
			/*background-color: #fff;*/
		    font-style: <?php echo $main_nav_font_style; ?>;
		    letter-spacing: <?php echo $main_nav_letter_spacing; ?>px;
		    text-transform: <?php echo $main_nav_text_transform; ?>;
		}

		[class*="navbar-header-"] .nav > li > a {
			line-height: <?php echo $main_nav_line_height; ?>px;
			font-weight: <?php echo $main_nav_font_weight; ?>;
		}

		/* ******************************************************** */
		/* Secondary Nav
		/* ******************************************************** */
		<?php
		if( $google_secondary_nav != '0') {
			$secondary_nav = '"'.$google_secondary_nav.'", sans-serif';
		} elseif( $standard_secondary_nav != '0') {
			$secondary_nav = $standard_secondary_nav;
		}
		?>

		<?php if( $google_secondary_nav != '0' || $standard_secondary_nav != '0' ) { ?>

		.magazilla-top-nav {
			font-family: <?php echo $secondary_nav; ?>;
		}

		<?php } ?>
		.magazilla-top-nav .navbar-nav > li > a {
			font-size: <?php echo $top_nav_font_size; ?>px;
			font-style: <?php echo $top_nav_font_style; ?>;
		    letter-spacing: <?php echo $top_nav_letter_spacing; ?>px;
		    text-transform: <?php echo $top_nav_text_transform; ?>;
		    color: <?php echo $topnav_text_color; ?>;
			line-height: <?php echo $top_nav_line_height; ?>px;
			font-weight: <?php echo $top_nav_font_weight; ?>;
		}
		.magazilla-top-nav { /* external wrap */
			background-color: <?php echo $topnav_bg_color; ?>;
			border-top: none;
			border-right: none;
			border-bottom: 1px solid <?php echo $topnav_border_bottom_color; ?>;
			border-left: none;
		}
		.magazilla-top-nav .top-menu {
			background-color: <?php echo $topnav_bg_color; ?>;
			border-top: none;
			border-right: none;
			border-left: none;
			border-bottom: none;
		}
		.magazilla-top-nav .navbar-nav .post-author-social-links a:hover,
		.magazilla-top-nav .navbar-nav .post-author-social-links  a,
		.magazilla-top-nav .navbar-nav .post-author-social-links:hover  a { 
			color: <?php echo $topnav_text_color; ?>; 
		}
		/* ******************************************************** */
		/* Header 5
		/* ******************************************************** */
		.header-5,
		.header-7 {
			background-color: <?php echo $header_5_bg_color; ?>;
		}
		.header-5 .navbar-nav > li > a,
		.header-7 .navbar-nav > li > a {
			color: <?php echo $header_5_text_color; ?>;
			font-size: 14px;
    		text-transform: uppercase;
		}

		/* ******************************************************** */
		/* Main Menu
		/* ******************************************************** */
		.magazilla-main-nav .nav > ul > li > a,
		.mobile-menu .nav > ul > li > a,
		.header-5 > ul > li > a,
		.header-7 > ul > li > a {
		    background-color: <?php echo $mainnav_bg_color; ?>;
		    color: <?php echo $mainnav_text_color; ?>;
		}

		[class*="navbar-header-"] {
		    border-bottom-color: <?php echo $mainnav_border_color; ?>;
		}
		

		/* ******************************************************** */
		/* Mobile Menu
		/* ******************************************************** */
		.mobile-menu .navbar-header {
			background-color: <?php echo $mobile_nav_color; ?>;
			border-bottom: 1px solid <?php echo $mobile_nav_border_color; ?>;
		}
		.mobile-menu .mobile-menu-btn, .mobile-menu .mobile-search-btn {
			color: <?php echo $mobile_nav_icons_color; ?>;
		}

		/* ******************************************************** */
		/* Footer
		/* ******************************************************** */
		.footer {
			background-color: <?php echo $footer_bg_color; ?>;
		}
		.footer,
		.footer .widget .post-author-for-archive .post-meta li,
		.footer .widget-body,
		.footer .widget-title,
		.footer .post-author i,
		.footer .post-date a {
			color: <?php echo $footer_titles_color; ?>;
		}
		.footer .widget .post-author-social-links a,
		.footer .post-title a,
		.footer .post-author a,
		.footer .widget a,
		.footer .widget li:before {
			color: <?php echo $footer_links_color; ?>;
		}
		.footer .widget-title {
			border-bottom: 1px solid rgba(255,255,255, .2);
		}
		.bottom-footer {
			background-color: <?php echo $footer_bottom_bg_color; ?>;
			color: <?php echo $footer_bottom_text_color; ?>;
		}


		<?php
		if( $google_font_logo != '0') {
			$logo_font = '"'.$google_font_logo.'"';
		} elseif( $standard_font_logo != '0') {
			$logo_font = $standard_font_logo;
		}
		?>

		<?php if( $google_font_logo != '0' || $standard_font_logo != '0' ) { ?>

		h1.favethemes_text_logo,
		.mobile-menu .navbar-brand {
			font-family: <?php echo $logo_font; ?>;
		}

		<?php } ?>

		h1.favethemes_text_logo,
		.mobile-menu .navbar-brand {
			font-size: <?php echo $logo_font_size; ?>px;
			line-height: <?php echo $logo_line_height; ?>px;
			font-weight: <?php echo $logo_font_weight; ?>;
			font-style: <?php echo $logo_font_style; ?>;
		    letter-spacing: <?php echo $logo_letter_spacing; ?>px;
		    text-transform: <?php echo $logo_text_transform; ?>;
			color: <?php echo $text_logo_color; ?>;
		}
		.mobile-menu .navbar-brand {
			font-size: <?php echo $logo_font_size - 14; ?>px;
			line-height: <?php echo $logo_line_height - 14; ?>px;
			letter-spacing: <?php echo $logo_letter_spacing - 10; ?>px;
		}
		h1.favethemes_text_logo a {
			color: <?php echo $text_logo_color; ?>;
		}


		/* ******************************************************** */
		/* Modules Titles
		/* ******************************************************** */
		<?php
		if( $google_font_module_title != '0') {
			$module_title_font = '"'.$google_font_module_title.'"';
		} elseif( $standard_font_module_title != '0') {
			$module_title_font = $standard_font_module_title;
		}
		?>

		<?php if( $google_font_module_title != '0' || $standard_font_module_title != '0' ) { ?>
		.post-title.module-big-title,
		.post-title.module-small-title,
		.gallery-title-big,
		.gallery-title-small {
			font-family: <?php echo $module_title_font; ?>;
		}
		<?php } ?>

		<?php
		if( $google_font_section_title != '0') {
			$section_title_font = '"'.$google_font_section_title.'"';
		} elseif( $standard_font_section_title != '0') {
			$section_title_font = $standard_font_section_title;
		}
		?>

		<?php if( $google_font_section_title != '0' || $standard_font_section_title != '0' ) { ?>
		.module-category,
		.module-top-topics {
			font-family: <?php echo $section_title_font; ?>;
			font-size: <?php echo $module_title_font_size; ?>px;
			line-height: <?php echo $module_title_line_height; ?>px;
			font-weight: <?php echo $module_title_font_weight; ?>;
			font-style: <?php echo $module_title_font_style; ?>;
		    letter-spacing: <?php echo $module_title_letter_spacing; ?>px;
		    text-transform: <?php echo $module_title_text_transform; ?>;
		}
		<?php } ?>

		/* Options for SMALL titles */
		.module-4-three-cols .module-big-title,
		.module-5-three-cols .module-big-title,
		.fave-post-set-layout .module-small-title,
		.post .module-small-title,
		.module-small-title,
		.gallery-title-small,
		.slide .gallery-title-small,
		/*.thumb .gallery-title-small,*/
		.thumb.big-thumb .gallery-title-small{
			font-size: <?php echo $post_title_small_font_size; ?>px;
			line-height: <?php echo $post_title_small_line_height; ?>px;
			margin: 0 0 10px;
			font-weight: <?php echo $post_title_small_font_weight; ?>;
			font-style: <?php echo $post_title_small_font_style; ?>;
		    letter-spacing: <?php echo $post_title_small_letter_spacing; ?>px;
		    text-transform: <?php echo $post_title_small_text_transform; ?>;
		}
		@media (max-width: 1199px) and (min-width: 992px) {
			.thumb.big-thumb .gallery-title-small,
			.gallery-4 .thumb .gallery-title-small {			
				font-size: <?php echo $post_title_small_font_size - 4; ?>px;;
				line-height: <?php echo $post_title_small_line_height - 6; ?>px;
				margin: 0;
			}
		}
		@media (max-width: 991px){ 
			.thumb.big-thumb .gallery-title-small,
			.gallery-4 .thumb .gallery-title-small  {
				font-size: <?php echo $post_title_small_font_size - 6; ?>px;
				line-height: <?php echo $post_title_small_line_height - 8; ?>px;
			}
		}
		.gallery-title-small.title-cols-4 {
			font-size: <?php echo $post_title_small_font_size - 4; ?>px;
			line-height: <?php echo $post_title_small_line_height - 4; ?>px;
			margin: 0 0 10px;
			font-weight: <?php echo $post_title_small_font_weight; ?>;
			font-style: <?php echo $post_title_small_font_style; ?>;
		    letter-spacing: <?php echo $post_title_small_letter_spacing; ?>px;
		    text-transform: <?php echo $post_title_small_text_transform; ?>;
		}
		/* Options for BIG titles */
		.banner-slide .gallery-title-big,
		.wpb_wrapper .module-big-title,
		.module-big-title,
		.sitemap h2 {
			font-size: <?php echo $post_title_big_font_size; ?>px;
			line-height: <?php echo $post_title_big_line_height; ?>px;
			margin: 0 0 10px;
			font-weight: <?php echo $post_title_big_font_weight; ?>;

			font-style: <?php echo $post_title_big_font_style; ?>;
		    letter-spacing: <?php echo $post_title_big_letter_spacing; ?>px;
		    text-transform: <?php echo $post_title_big_text_transform; ?>;
		}
		@media (min-width: 992px) and (max-width: 1199px) {
			.banner-slide .gallery-title-big,
			.wpb_wrapper .module-big-title,
			.module-big-title {
				font-size: <?php echo $post_title_big_font_size - 6; ?>px;
				line-height: <?php echo $post_title_big_line_height - 4; ?>px;
			}
			.post .module-small-title, 
			.module-small-title {
				font-size: <?php echo $post_title_small_font_size - 2; ?>px;
				line-height: <?php echo $post_title_small_line_height - 2; ?>px;
			}
		}
		@media (max-width: 991px) {
			.banner-slide .gallery-title-big,
			.wpb_wrapper .module-big-title,
			.module-big-title,
			.archive .post-title {
				font-size: <?php echo $post_title_big_font_size - 6; ?>px;
				line-height: <?php echo $post_title_big_line_height - 8; ?>px;
				margin: 20px 0 10px;
			}
			.post .module-small-title, 
			.module-small-title {
				font-size: <?php echo $post_title_small_font_size - 4; ?>px;
				line-height: <?php echo $post_title_small_line_height - 6; ?>px;
				margin: 0 0 10px;
			}
		}
		@media (max-width: 767px) {
			.banner-slide .gallery-title-big,
			.wpb_wrapper .module-big-title,
			.module-big-title,
			.archive .post-title {
				font-size: <?php echo $post_title_big_font_size - 10; ?>px;
				line-height: <?php echo $post_title_big_line_height - 12; ?>px;
				margin: 20px 0 10px;
			}
			.post .module-small-title, 
			.module-small-title {
				font-size: <?php echo $post_title_small_font_size - 6; ?>px;
				line-height: <?php echo $post_title_small_line_height - 8; ?>px;
				margin: 0 0 10px;
			}
		}
		
		
		.widget .widget-body .module-small-title {
			font-size: <?php echo $post_title_small_font_size - 4; ?>px;
			line-height: <?php echo $post_title_small_line_height - 6; ?>px;
			margin: 0 0 10px;
			font-weight: <?php echo $post_title_small_font_weight; ?>;
			font-style: <?php echo $post_title_small_font_style; ?>;
		    letter-spacing: <?php echo $post_title_small_letter_spacing; ?>px;
		    text-transform: <?php echo $post_title_small_text_transform; ?>;
		}
		.widget .widget-body .module-big-title {
			font-size: <?php echo $post_title_big_font_size - 4; ?>px;
			line-height: <?php echo $post_title_big_line_height - 4; ?>px;
			margin: 0 0 10px;
			font-weight: <?php echo $post_title_big_font_weight; ?>;

			font-style: <?php echo $post_title_big_font_style; ?>;
		    letter-spacing: <?php echo $post_title_big_letter_spacing; ?>px;
		    text-transform: <?php echo $post_title_big_text_transform; ?>;
		}
		@media (min-width: 768px) and (max-width: 991px) {
			.widget .widget-body .module-big-title {
				font-size: <?php echo $post_title_big_font_size - 6; ?>px;
				line-height: <?php echo $post_title_big_line_height - 8; ?>px;
				margin: 0 0 10px;
			}
		}




		
		.thumb .gallery-title-small {
			font-size: <?php echo $post_title_small_font_size - 2; ?>px;;
			line-height: <?php echo $post_title_small_line_height - 2; ?>px;
			margin: 0 0 10px;
			font-weight: <?php echo $post_title_small_font_weight; ?>;
			font-style: <?php echo $post_title_small_font_style; ?>;
	    	letter-spacing: <?php echo $post_title_small_letter_spacing; ?>px;
	    	text-transform: <?php echo $post_title_small_text_transform; ?>;
		}
		@media (min-width: 768px) and (max-width: 991px) { 
			.thumb .gallery-title-small {
				font-size: <?php echo $post_title_small_font_size - 4; ?>px;;
				line-height: <?php echo $post_title_small_line_height - 6; ?>px;
				margin: 0;
			}
		}
		@media (max-width: 991px) {
			.thumb .gallery-title-small,
			.thumb.small-thumb .gallery-title-small {
				font-size: <?php echo $post_title_small_font_size - 6; ?>px;;
				line-height: <?php echo $post_title_small_line_height - 8; ?>px;
				margin: 0;
			}
		}
		
		
		/* Options for BIG titles on mobile */
		/* IMPORTANT: MUST have same option on small at line #237 */
		@media (min-width: 768px) and (max-width: 979px) {
			.module-5-two-cols .module-big-title,
			.module-4-two-cols .module-big-title,
			.module-8-two-cols .gallery-title-small {
				font-size: <?php echo $post_title_big_font_size - 10; ?>px;
				line-height: <?php echo $post_title_big_line_height - 10; ?>px;
				margin: 0 0 10px;
				font-weight: <?php echo $post_title_big_font_weight; ?>;
				font-style: <?php echo $post_title_big_font_style; ?>;
		    	letter-spacing: <?php echo $post_title_big_letter_spacing; ?>px;
		    	text-transform: <?php echo $post_title_big_text_transform; ?>;
			}
			.gallery-title-small,
			.slide .gallery-title-small {
				font-size: <?php echo $post_title_small_font_size - 6; ?>px;;
				line-height: <?php echo $post_title_small_line_height - 6; ?>px;
				margin: 0 0 10px;
				font-weight: <?php echo $post_title_small_font_weight; ?>;
				font-style: <?php echo $post_title_small_font_style; ?>;
		    	letter-spacing: <?php echo $post_title_small_letter_spacing; ?>px;
		    	text-transform: <?php echo $post_title_small_text_transform; ?>;
			}
		}
		/* IMPORTANT: MUST have same option on small at line #237 */
		@media (max-width: 767px) {
			.module-small-title {
				font-size: <?php echo $post_title_small_font_size - 2; ?>px;;
				line-height: <?php echo $post_title_small_line_height - 2; ?>px;
				margin: 0 0 10px;
				font-weight: <?php echo $post_title_small_font_weight; ?>;
				font-style: <?php echo $post_title_small_font_style; ?>;
		    	letter-spacing: <?php echo $post_title_small_letter_spacing; ?>px;
		    	text-transform: <?php echo $post_title_small_text_transform; ?>;
			}
		}
		@media (max-width: 480px) {
			.module-big-title,
			.module-1 .module-big-title,
			.module-2 .module-big-title,
			.module-6 .module-big-title,
			.module-4-two-cols .module-big-title,
			.module-5-two-cols .module-big-title,
			.widget .widget-body .module-big-title {
				font-size: <?php echo $post_title_small_font_size; ?>px;;
				line-height: <?php echo $post_title_small_line_height; ?>px;
				margin: 0 0 10px;
				font-weight: <?php echo $post_title_small_font_weight; ?>;
				font-style: <?php echo $post_title_small_font_style; ?>;
		    	letter-spacing: <?php echo $post_title_small_letter_spacing; ?>px;
		    	text-transform: <?php echo $post_title_small_text_transform; ?>;
			}
			.module-small-title {
				font-size: <?php echo $post_title_small_font_size - 2; ?>px;;
				line-height: <?php echo $post_title_small_line_height - 2; ?>px;
				margin: 0 0 10px;
				font-weight: <?php echo $post_title_small_font_weight; ?>;
				font-style: <?php echo $post_title_small_font_style; ?>;
		    	letter-spacing: <?php echo $post_title_small_letter_spacing; ?>px;
		    	text-transform: <?php echo $post_title_small_text_transform; ?>;
			}
			.gallery-title-small,
			.slide .gallery-title-small {
				font-size: <?php echo $post_title_small_font_size - 6; ?>px;;
				line-height: <?php echo $post_title_small_line_height - 6; ?>px;
				margin: 0 0 10px;
				font-weight: <?php echo $post_title_small_font_weight; ?>;
				font-style: <?php echo $post_title_small_font_style; ?>;
		    	letter-spacing: <?php echo $post_title_small_letter_spacing; ?>px;
		    	text-transform: <?php echo $post_title_small_text_transform; ?>;
			}
			.widget .widget-body .module-small-title {
				font-size: <?php echo $post_title_small_font_size - 6; ?>px;
				line-height: <?php echo $post_title_small_line_height - 8; ?>px;
				margin: 0 0 10px;
				font-weight: <?php echo $post_title_small_font_weight; ?>;
				font-style: <?php echo $post_title_small_font_style; ?>;
		    	letter-spacing: <?php echo $post_title_small_letter_spacing; ?>px;
		    	text-transform: <?php echo $post_title_small_text_transform; ?>;
			}
		}

		/* ******************************************************** */
		/* Widgets Titles
		/* ******************************************************** */
		<?php
		if( $google_font_widget_title != '0') {
			$widget_title_font = '"'.$google_font_widget_title.'"';
		} elseif( $standard_font_widget_title != '0') {
			$widget_title_font = $standard_font_widget_title;
		}
		?>

		<?php if( $google_font_widget_title != '0' || $standard_font_widget_title != '0' ) { ?>
		.module-top,
		.widget-title,
		.wpb_wrapper .widget-title,
		.widget-tabs .nav > li > a,
		.widget-social-profiles .social-count,
		.widget-social-profiles .social-text,
		.widget-social-profiles .social-button a {
			font-family: <?php echo $widget_title_font; ?>;
		}

		<?php } ?>

		.widget-top {
			text-align: <?php echo $widget_title_align; ?>;
		}

		.widget-title,
		.wpb_wrapper .widget-title,
		.widget-tabs .nav > li > a {
			font-size: <?php echo $widget_title_font_size; ?>px;
			line-height: <?php echo $widget_title_line_height; ?>px;
			font-weight: <?php echo $widget_title_font_weight; ?>;

			font-style: <?php echo $widget_title_font_style; ?>;
	    	letter-spacing: <?php echo $widget_title_letter_spacing; ?>px;
	    	text-transform: <?php echo $widget_title_text_transform; ?>;
		}

		/* ******************************************************** */
		/* Breadcrumb
		/* ******************************************************** */
		<?php
		if( $google_font_breadcrumb != '0') {
			$breadcrumb_font = '"'.$google_font_breadcrumb.'"';
		} elseif( $standard_font_breadcrumb != '0') {
			$breadcrumb_font = $standard_font_breadcrumb;
		}
		?>

		<?php if( $google_font_breadcrumb != '0' || $standard_font_breadcrumb != '0' ) { ?>

		.breadcrumb {
			font-family: <?php echo $breadcrumb_font; ?>;
		}

		<?php } ?>

		.breadcrumb {
			font-size: <?php echo $breadcrumb_font_size; ?>px;
			line-height: <?php echo $breadcrumb_line_height; ?>px;
			font-weight: <?php echo $breadcrumb_font_weight; ?>;
			font-style: <?php echo $breadcrumb_font_style; ?>;
	    	letter-spacing: <?php echo $breadcrumb_letter_spacing; ?>px;
	    	text-transform: <?php echo $breadcrumb_text_transform; ?>;
		}

		/* ******************************************************** */
		/* Single Post Title
		/* ******************************************************** */
		<?php
		if( $google_font_single_title != '0') {
			$single_title_font = '"'.$google_font_single_title.'"';
		} elseif( $standard_font_single_title != '0') {
			$single_title_font = $standard_font_single_title;
		}
		?>

		<?php if( $google_font_single_title != '0' || $standard_font_single_title != '0' ) { ?>

		.entry-title {
			font-family: <?php echo $single_title_font; ?>;
		}

		<?php } ?>

		.entry-title,
		.page-title {
			font-size: <?php echo $single_title_font_size; ?>px;
			line-height: <?php echo $single_title_line_height; ?>px;
			font-weight: <?php echo $single_title_font_weight; ?>;
			font-style: <?php echo $single_title_font_style; ?>;
	    	letter-spacing: <?php echo $single_title_letter_spacing; ?>px;
	    	text-transform: <?php echo $single_title_text_transform; ?>;
		}
		@media (min-width: 768px) and (max-width: 991px) {
			.entry-title,
			.page-title,
			.full-screen-cover .entry-title,
			.wide-cover .entry-title {
				font-size: <?php echo $single_title_font_size - 16; ?>px;
				line-height: <?php echo $single_title_line_height - 16; ?>px;
			}
		}
		@media (max-width: 767px) {
			.entry-title,
			.page-title,
			.full-screen-cover .entry-title,
			.wide-cover .entry-title  {
				font-size: <?php echo $single_title_font_size - 20; ?>px;
				line-height: <?php echo $single_title_line_height - 20; ?>px;
			}
		}
		@media (max-width: 480px) {
			.entry-title,
			.page-title,
			.full-screen-cover .entry-title,
			.wide-cover .entry-title  {
				font-size: <?php echo $single_title_font_size - 24; ?>px;
				line-height: <?php echo $single_title_line_height - 24; ?>px;
			}
		}
		/* ******************************************************** */
		/* Posts Meta
		/* ******************************************************** */
		<?php
		if( $google_font_post_meta != '0') {
			$post_meta_font = '"'.$google_font_post_meta.'"';
		} elseif( $standard_font_post_meta != '0') {
			$post_meta_font = $standard_font_post_meta;
		}
		?>

		<?php if( $google_font_post_meta != '0' || $standard_font_post_meta != '0' ) { ?>

		.post-meta,
		.post-author,
		.post-meta .post-category a,
		.comment-author,
		.comment-date,
		.comment-reply-link {
			font-family: <?php echo $post_meta_font; ?>;
		}

		<?php } ?>

		.post-meta li,
		.widget-body .post-meta li,
		.post-author,
		.widget .post-author-for-archive .post-author {
			font-size: <?php echo $post_meta_font_size; ?>px;
			line-height: <?php echo $post_meta_line_height; ?>px;
			font-weight: <?php echo $post_meta_font_weight; ?>;
			font-style: <?php echo $post_meta_font_style; ?>;
	    	letter-spacing: <?php echo $post_meta_letter_spacing; ?>px;
	    	text-transform: <?php echo $post_meta_text_transform; ?>;
		}
		@media (min-width: 768px) and (max-width: 991px) {
			.post-meta li,
			.widget-body .post-meta li,
			.post-author,
			.widget .post-author-for-archive .post-author {
				font-size: <?php echo $post_meta_font_size - 2; ?>px;
				line-height: <?php echo $post_meta_line_height - 4; ?>px;
			}
		}
		.post-meta i.fa-calendar-o,
		.post-meta i.fa-file-o {
			font-size: <?php echo $post_meta_font_size - 2; ?>px;
			top: -1px;
			position: relative;
			margin-right: 2px;
		}

		@media (max-width: 480px) {
			.post-meta li,
			.widget-body .post-meta li,
			.post-author {
				font-size: <?php echo $post_meta_font_size - 2; ?>px;
				line-height: <?php echo $post_meta_line_height - 2; ?>px;
				font-weight: <?php echo $post_meta_font_weight; ?>;
				font-style: <?php echo $post_meta_font_style; ?>;
		    	letter-spacing: <?php echo $post_meta_letter_spacing; ?>px;
		    	text-transform: <?php echo $post_meta_text_transform; ?>;
			}
		}

		/* ******************************************************** */
		/* Single Post Meta
		/* ******************************************************** */
		<?php
		if( $google_font_single_meta != '0') {
			$single_meta_font = '"'.$google_font_single_meta.'"';
		} elseif( $standard_font_single_meta != '0') {
			$single_meta_font = $standard_font_single_meta;
		}
		?>

		<?php if( $google_font_single_meta != '0' || $standard_font_single_meta != '0' ) { ?>

		.single-post .entry-header .post-meta,
		.single-post .entry-header .post-author,
		.single-post .entry-header .post-meta .post-category a {
			font-family: <?php echo $single_meta_font; ?>;
		}

		<?php } ?>

		.single-post .entry-header .post-meta,
		.single-post .entry-header .post-author {
			font-size: <?php echo $single_meta_font_size; ?>px;
			line-height: <?php echo $single_meta_line_height; ?>px;
			font-weight: <?php echo $single_meta_font_weight; ?>;
			font-style: <?php echo $single_meta_font_style; ?>;
	    	letter-spacing: <?php echo $single_meta_letter_spacing; ?>px;
	    	text-transform: <?php echo $single_meta_text_transform; ?>;
		}

		/* ******************************************************** */
		/* Single Post Sections Titles
		/* ******************************************************** */
		<?php
		if( $google_font_single_sections != '0') {
			$single_sections_font = '"'.$google_font_single_sections.'"';
		} elseif( $standard_font_single_sections != '0') {
			$single_sections_font = $standard_font_single_sections;
		}
		?>

		<?php if( $google_font_single_sections != '0' || $standard_font_single_sections != '0' ) { ?>

		.post-tags .module-title,
		.post-about-the-author .module-title,
		.related-post .module-title,
		.comment-respond .module-title,
		.post-comments .module-title {
			font-family: <?php echo $single_sections_font; ?>;
		}

		<?php } ?>

		.post-tags .module-title,
		.post-about-the-author .module-title,
		.related-post .module-title,
		.comment-respond .module-title,
		.post-comments .module-title {
			font-size: <?php echo $single_sections_font_size; ?>px;
			line-height: <?php echo $single_sections_line_height; ?>px;
			font-weight: <?php echo $single_sections_font_weight; ?>;
			font-style: <?php echo $single_sections_font_style; ?>;
	    	letter-spacing: <?php echo $single_sections_letter_spacing; ?>px;
	    	text-transform: <?php echo $single_sections_text_transform; ?>;
		}
		/* ******************************************************** */
		/* Headings
		/* ******************************************************** */
		<?php
		if( $google_font_headings != '0') {
			$headings_font = '"'.$google_font_headings.'"';
		} elseif( $standard_font_headings != '0') {
			$headings_font = $standard_font_headings;
		}
		?>

		<?php if( $google_font_headings != '0' || $standard_font_headings != '0' ) { ?>
		.entry-content h1,
		.entry-content h2,
		.entry-content h3,
		.entry-content h4,
		.entry-content h5,
		.entry-content h6 {
			font-family: <?php echo $headings_font; ?>;
		}
		<?php } ?>

		.entry-content h1 {
			font-size: <?php echo $h1_font_size; ?>px;
			line-height: <?php echo $h1_line_height; ?>px;
			font-weight: <?php echo $h1_font_weight; ?>;
		}
		.entry-content h2 {
			font-size: <?php echo $h2_font_size; ?>px;
			line-height: <?php echo $h2_line_height; ?>px;
			font-weight: <?php echo $h2_font_weight; ?>;
		}
		.entry-content h3 {
			font-size: <?php echo $h3_font_size; ?>px;
			line-height: <?php echo $h3_line_height; ?>px;
			font-weight: <?php echo $h3_font_weight; ?>;
		}
		.entry-content h4 {
			font-size: <?php echo $h4_font_size; ?>px;
			line-height: <?php echo $h4_line_height; ?>px;
			font-weight: <?php echo $h4_font_weight; ?>;
		}
		.entry-content h5 {
			font-size: <?php echo $h5_font_size; ?>px;
			line-height: <?php echo $h5_line_height; ?>px;
			font-weight: <?php echo $h5_font_weight; ?>;
		}
		.entry-content h6 {
			font-size: <?php echo $h6_font_size; ?>px;
			line-height: <?php echo $h6_line_height; ?>px;
			font-weight: <?php echo $h6_font_weight; ?>;
		}


		@media (max-width: 767px) {
			.entry-content h1,
			.entry-content h1 {
				font-size: <?php echo $h1_font_size - 16; ?>px;
				line-height: <?php echo $h1_line_height - 16; ?>px;
			}
			.entry-content h2,
			.entry-content h1 {
				font-size: <?php echo $h2_font_size - 12; ?>px;
				line-height: <?php echo $h2_line_height - 12; ?>px;
			}
			.entry-content h3,
			.entry-content h1 {
				font-size: <?php echo $h3_font_size - 8; ?>px;
				line-height: <?php echo $h3_line_height - 8; ?>px;
			}
			.entry-content h4,
			.entry-content h1 {
				font-size: <?php echo $h4_font_size - 4; ?>px;
				line-height: <?php echo $h4_line_height - 4; ?>px;
			}
			.entry-content h5,
			.entry-content h1 {
				font-size: <?php echo $h5_font_size - 2; ?>px;
				line-height: <?php echo $h5_line_height -2 ; ?>px;
			}
			.entry-content h6,
			.entry-content h1 {
				font-size: <?php echo $h6_font_size; ?>px;
				line-height: <?php echo $h6_line_height; ?>px;
			}
		}


		/* ******************************************************** */
		/* Colors
		/* ******************************************************** */
		<?php $main_site_color = isset( $ft_option['main_site_color'] ) ? $ft_option['main_site_color'] : '#1b8289'; ?>
		<?php $main_color_rgb = fave_hex2rgb($main_site_color); ?>
		a,
		a:hover,
		.post-total-comments a,
		.thumb-content .post-meta .post-total-comments a,
		.calendar caption,
		.navbar-inverse .navbar-nav > li > a:hover,
		.navbar-inverse .navbar-nav > .open > a,
		.navbar-inverse .navbar-nav > .open > a:focus,
		.navbar-inverse .navbar-nav > .open > a:hover,
		.navbar-inverse .navbar-nav > li.dropdown:hover > a,
		.btn-link,
		.post-pagination .pagination .active a,
		.post-pagination .pagination a:hover,
		.reply,
		.post-review p,
		.post-review h4,
		.progress-bar,
		.progress-title,
		.widget-tabs .nav > li.active > a,
		.icon_rollover_color,
		.componentWrapper .qualityOver,
		ul li a:hover,
		.megamenu-links-4-cols > li > ul > li > a:hover,
		.megamenu-links-3-cols > li > ul > li > a:hover,
		.magazilla-top-nav-dark .navbar-nav > li:hover > a,
		.magazilla-top-nav-light .navbar-nav > li > a:hover,
		.dropdown-menu > li > a:hover,
		.footer .widget .post-author-social-links a:hover,
		.footer .post-title a:hover,
		.footer .post-author a:hover,
		.gallery-title-small a:hover,
		.header-5 .menu-tab-nav > li.tab-link.active > a,
		.header-7 .menu-tab-nav > li.tab-link.active > a {
			color: <?php echo $main_site_color; ?>;
		}

		.btn-theme,
		.post-category a,
		.module-category a,
		.header-5 .navbar-nav > li > a:hover, 
		.header-5 .navbar-nav > li > a:focus,
		.header-7 .navbar-nav > li > a:hover, 
		.header-7 .navbar-nav > li > a:focus,
		.feedburner-subscribe,
		.wpcf7-submit,
		.banner-slide .owl-theme .owl-controls .owl-nav div:hover {
			background-color: <?php echo $main_site_color; ?>;
		}

		.btn-theme:hover {
			background-color: rgba( <?php echo $main_color_rgb['r']; ?>, <?php echo $main_color_rgb['g']; ?>, <?php echo $main_color_rgb['b']; ?>, .75);
		}
		.post-review {
			background-color: rgba( <?php echo $main_color_rgb['r']; ?>, <?php echo $main_color_rgb['g']; ?>, <?php echo $main_color_rgb['b']; ?>, .1);
		}
		.module-title,
		.blockquote-left,
		.blockquote-right,
		.blockquote-center,
		.widget-title,
		.widget-tabs .nav-tabs > li.active > a,
		.widget-tabs .nav-tabs > li.active > a:focus,
		.widget-tabs .nav-tabs > li.active > a:hover {
			border-color: <?php echo $main_site_color; ?>;
		}

		.widget_archives ul li:before {
			border-color: transparent <?php echo $main_site_color; ?>;
		}

		[class*="navbar-header-"] .nav > li > a,
		.nav .open > a,
		.nav .open > a:focus,
		.nav .open > a:hover,
		.post-pagination .pagination .active {
			border-bottom-color: <?php echo $main_site_color; ?>;
		}

		.post-review-bars {
			border-top-color: <?php echo $main_site_color; ?>;
		}

		.score-label,
		.widget_tags a,
		.post-tags a,
		#today,
		.widget-instagramm-slider .owl-theme .owl-controls .owl-nav div,
		.navbar-inverse,
		[class*="navbar-header-"] .nav > li > a:hover,
		.owl-carousel-menu.owl-theme .owl-controls .owl-nav div,
		.nav .open > a,
		.review,
		.jspDrag,
		.grid-banner-slide .owl-theme .owl-controls .owl-nav div,
		.category-label a,
		.dropdown-menu .yamm-content .nav > li > a:hover {
			background-color: <?php echo $main_site_color; ?>;
		}

		.playlist-video.selected,
		.playlist-video:hover {
			border-left: 3px solid <?php echo $main_site_color; ?>;
		}

		.comment-body-author, .bypostauthor {
			background-color: rgba( <?php echo $main_color_rgb['r']; ?>, <?php echo $main_color_rgb['g']; ?>, <?php echo $main_color_rgb['b']; ?>, .05);

			border: 1px solid rgba( <?php echo $main_color_rgb['r']; ?>, <?php echo $main_color_rgb['g']; ?>, <?php echo $main_color_rgb['b']; ?>, .2);
		}
		#favethemes_mobile_nav>li {
			border-left: 3px solid <?php echo $main_site_color ?>;
		}
		/* ******************************************************** */
		/* Sidebar
		/* ******************************************************** */
		.sidebar,
		.wpb_widgetised_column {
			background-color: <?php echo $sidebar_bg_color; ?>;
			border: <?php echo $sidebar_border['width'].'px  '.$sidebar_border['style'].' '.$sidebar_border['color'];?>;
			padding-top: <?php echo $sidebar_pending_top; ?>px;
			padding-bottom: <?php echo $sidebar_pending_bottom; ?>px;
			padding-left: <?php echo $sidebar_pending_left; ?>px;
			padding-right: <?php echo $sidebar_pending_right; ?>px;
		}

		/* ******************************************************** */
		/* Categories and taxonomy colors
		/* ******************************************************** */
		<?php

		$categories = get_categories();

		if($categories){
			foreach($categories as $category) {

				$fave_cat_id = $category->cat_ID;
				$meta = get_option( '_fave_category_'.$fave_cat_id );

				//$fave_cat_color = trim($fave_cat_color);


				if ( $meta['color_type'] == 'custom' ) { ?>

		a.cat-color-<?php echo $fave_cat_id; ?>, .module-title-color-<?php echo $fave_cat_id; ?> a, .cat-section-head-<?php echo $fave_cat_id; ?> a {
			background-color: <?php echo $meta['color']; ?>;
		}
		.cat-author-color-<?php echo $fave_cat_id; ?> i {
			color: <?php echo $meta['color']; ?>;
		}

		[class*="navbar-header-"] .nav > li.fave-menu-cat-<?php echo $fave_cat_id; ?> > a {
			border-bottom-color: <?php echo $meta['color']; ?>;
		}

		.dropdown-menu > li.fave-menu-cat-<?php echo $fave_cat_id; ?> > a:focus,
		[class*="navbar-header-"] .nav > li.fave-menu-cat-<?php echo $fave_cat_id; ?> > a:hover,
		[class*="navbar-header-"] .nav > li.fave-menu-cat-<?php echo $fave_cat_id; ?> > ul > li > a:hover,
		[class*="navbar-header-"] .nav > li.fave-menu-cat-<?php echo $fave_cat_id; ?> > ul > li ul.menu-tab-nav li > a:hover,
		[class*="navbar-header-"] .nav > li.fave-menu-cat-<?php echo $fave_cat_id; ?> > ul > li .owl-nav div {
			background-color: <?php echo $meta['color']; ?>;
		}

		#favethemes_mobile_nav li.fave-menu-cat-<?php echo $fave_cat_id; ?> {
			border-left-color: <?php echo $meta['color']; ?>;
		}

		<?php
	}
}
}


if( taxonomy_exists('video-categories') ) {

$video_cats = get_terms( 'video-categories' );

	if($video_cats) {
		foreach($video_cats as $term) {

			$fave_term_id = $term->term_id;
			$meta = get_option( '_fave_video_category_'.$fave_term_id );

			//$fave_cat_color = trim($fave_cat_color);


			if ( $meta['color_type'] == 'custom' ) { ?>

				a.cat-color-<?php echo $fave_term_id; ?>, .module-title-color-<?php echo $fave_term_id; ?> a, .cat-section-head-<?php echo $fave_term_id; ?> a {
					background-color: <?php echo $meta['color']; ?>;
				}
				.cat-author-color-<?php echo $fave_term_id; ?> i {
					color: <?php echo $meta['color']; ?>;
				}

				[class*="navbar-header-"] .nav > li.fave-menu-video-cat-<?php echo $fave_term_id; ?> > a {
					border-bottom-color: <?php echo $meta['color']; ?>;
				}

				.dropdown-menu > li.fave-menu-video-cat-<?php echo $fave_term_id; ?> > a:focus, .dropdown-menu > li.fave-menu-video-cat-<?php echo $fave_term_id; ?> > a:hover, [class*="navbar-header-"] .nav > li.fave-menu-video-cat-<?php echo $fave_term_id; ?> > a:hover {
					background-color: <?php echo $meta['color']; ?>;
				}

				#favethemes_mobile_nav li.fave-menu-video-cat-<?php echo $fave_term_id; ?> {
					border-left-color: <?php echo $meta['color']; ?>;
				}

				<?php
			}
		}
	}

}


if( taxonomy_exists('gallery-categories') ) {

	$gallery_cats = get_terms( 'gallery-categories' );

	if($gallery_cats) {
		foreach($gallery_cats as $term) {

		$fave_term_id = $term->term_id;
		$meta = get_option( '_fave_gallery_category_'.$fave_term_id );

		//$fave_cat_color = trim($fave_cat_color);


		if ( $meta['color_type'] == 'custom' ) { ?>

				a.cat-color-<?php echo $fave_term_id; ?>, .module-title-color-<?php echo $fave_term_id; ?> a, .cat-section-head-<?php echo $fave_term_id; ?> a {
					background-color: <?php echo $meta['color']; ?>;
				}
				.cat-author-color-<?php echo $fave_term_id; ?> i {
					color: <?php echo $meta['color']; ?>;
				}
				[class*="navbar-header-"] .nav > li.fave-menu-gallery-cat-<?php echo $fave_term_id; ?> > a {
					border-bottom-color: <?php echo $meta['color']; ?>;
				}

				.dropdown-menu > li.fave-menu-gallery-cat-<?php echo $fave_term_id; ?> > a:focus, .dropdown-menu > li.fave-menu-gallery-cat-<?php echo $fave_term_id; ?> > a:hover, [class*="navbar-header-"] .nav > li.fave-menu-gallery-cat-<?php echo $fave_term_id; ?> > a:hover {
					background-color: <?php echo $meta['color']; ?>;
				}
				#favethemes_mobile_nav li.fave-menu-gallery-cat-<?php echo $fave_term_id; ?> {
					border-left-color: <?php echo $meta['color']; ?>;
				}
				<?php
			}
		}
	}
}
?>
/* ******************************************************** */
/* Custom CSS
/* ******************************************************** */
<?php if ( !empty( $ft_option['custom_css'] ) ):?>
<?php echo $ft_option['custom_css'];?>
<?php endif; ?>

	</style>

<?php } ?>
<?php add_action( 'wp_head', 'fave_custom_styling' );?>