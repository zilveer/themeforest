<!DOCTYPE html>

<!--// OPEN HTML //-->
<html <?php language_attributes(); ?>>

	<!--// OPEN HEAD //-->
	<head>
		<?php
			
			global $post;
			$post_id = 0;
			
			if ( ( function_exists('is_shop') && is_shop() ) || ( function_exists('is_product_category') && is_product_category() ) ) {
				$post_id = wc_get_page_id( 'shop' );
			} else {
				$post_id = $post->ID;
			}
			
			$options = get_option('sf_dante_options');
			$enable_responsive = $options['enable_responsive'];
			$is_responsive = "responsive-fluid";
			if (!$enable_responsive) {
				$is_responsive = "responsive-fixed";
			}
			$header_layout = $options['header_layout'];
			$page_layout = $options['page_layout'];
			$enable_logo_fade = $options['enable_logo_fade'];
			$enable_page_shadow = $options['enable_page_shadow'];
			$enable_top_bar = $options['enable_tb'];
			$enable_mini_header = $options['enable_mini_header'];
			$enable_header_shadow = $options['enable_header_shadow'];
			
			$page_class = $header_wrap_class = $logo_class = $ss_enable = "";
			
			if (isset($_GET['header'])) {
				$header_layout = $_GET['header'];
			}
			
			if (($header_layout == "header-3" || $header_layout == "header-4" || $header_layout == "header-5") && !( is_page_template( 'template-fw.php' ) || is_page_template( 'template-fw-alt.php' ) )) {
				$header_wrap_class = " container";
				$page_class .= "header-overlay ";
			}
			
			global $sf_catalog_mode;
			if (isset($options['enable_catalog_mode'])) {
				$enable_catalog_mode = $options['enable_catalog_mode'];
				if ($enable_catalog_mode) {
					$sf_catalog_mode = true;
					$page_class = "catalog-mode ";
				}
			}
			
			if ($enable_mini_header) { 
			$page_class .= "mini-header-enabled ";
			}
			
			if ($enable_page_shadow) { 
			$page_class .= "page-shadow ";
			}
			
			if ($enable_header_shadow) {
			$page_class .= "header-shadow ";
			}
			
			if ($enable_logo_fade) {
			$logo_class = "logo-fade";
			}

			if (isset($_GET['layout'])) {
				$page_layout = $_GET['layout'];
			}
			
			$page_class .= "layout-".$page_layout." ";
			
			if (isset($options['ss_enable'])) {
				$ss_enable = $options['ss_enable'];
			} else {
				$ss_enable = true;
			}
			
			global $post, $remove_promo_bar, $enable_one_page_nav;
			$extra_page_class = $description = "";
			if ($post) {
				$extra_page_class = sf_get_post_meta($post->ID, 'sf_extra_page_class', true);
				$remove_promo_bar = sf_get_post_meta($post->ID, 'sf_remove_promo_bar', true);
				$enable_one_page_nav = sf_get_post_meta($post->ID, 'sf_enable_one_page_nav', true);
			}
		?>
		
		<!--// SITE TITLE //-->
		<title><?php wp_title( '|', true, 'right' ); ?></title>
			
		<!--// SITE META //-->
		<meta charset="<?php bloginfo( 'charset' ); ?>" />	
		<?php if ($enable_responsive) { ?><meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<?php } ?>
		<?php if (isset($options['custom_ios_title']) && $options['custom_ios_title'] != "") { ?><meta name="apple-mobile-web-app-title" content="<?php echo $options['custom_ios_title']; ?>">
		<?php } ?>
		
		<!--// PINGBACK & FAVICON //-->
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<?php if (isset($options['custom_favicon']) && $options['custom_favicon'] != "") { ?><link rel="shortcut icon" href="<?php echo $options['custom_favicon']; ?>" /><?php } ?>
		
		<?php if (isset($options['custom_ios_icon144']) && $options['custom_ios_icon144'] != "") { ?>
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $options['custom_ios_icon144']; ?>" />
		<?php } ?>
		<?php if (isset($options['custom_ios_icon114']) && $options['custom_ios_icon114'] != "") { ?>
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $options['custom_ios_icon114']; ?>" />
		<?php } ?>
		<?php if (isset($options['custom_ios_icon72']) && $options['custom_ios_icon72'] != "") { ?>
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $options['custom_ios_icon72']; ?>" />
		<?php } ?>
		<?php if (isset($options['custom_ios_icon57']) && $options['custom_ios_icon57'] != "") { ?>
		<link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo $options['custom_ios_icon57']; ?>" />
		<?php } ?>
				
		<?php
			$custom_fonts = $google_font_one = $google_font_two = $google_font_three = "";

			$body_font_option = $options['body_font_option'];
			if (isset($options['google_standard_font'])) {
			$google_font_one = $options['google_standard_font'];
			}
			$headings_font_option = $options['headings_font_option'];
			if (isset($options['google_heading_font'])) {
			$google_font_two = $options['google_heading_font'];
			}
			$menu_font_option = $options['menu_font_option'];
			if (isset($options['google_menu_font'])) {
			$google_font_three = $options['google_menu_font'];
			}			
			    
			if ($body_font_option == "google" && $google_font_one != "") {
				$custom_fonts .= "'".$google_font_one."', ";
			}
			if ($headings_font_option == "google" && $google_font_two != "") {
				$custom_fonts .= "'".$google_font_two."', ";
			}
			if ($menu_font_option == "google" && $google_font_three != "") {
				$custom_fonts .= "'".$google_font_three."', ";
			}
			
			$fontdeck_js = $options['fontdeck_js'];
		?>
		<?php if (($body_font_option == "google") || ($headings_font_option == "google") || ($menu_font_option == "google")) { ?>
		<!--// GOOGLE FONT LOADER //-->
		<script>
			var html = document.getElementsByTagName('html')[0];
			html.className += '  wf-loading';
			setTimeout(function() {
			  html.className = html.className.replace(' wf-loading', '');
			}, 3000);
			
			WebFontConfig = {
			    google: { families: [<?php echo $custom_fonts; ?> 'Vidaloka'] }
			};
			
			(function() {
				document.getElementsByTagName("html")[0].setAttribute("class","wf-loading")
				//  NEEDED to push the wf-loading class to your head
				document.getElementsByTagName("html")[0].setAttribute("className","wf-loading")
				// for IE
			
			var wf = document.createElement('script');
				wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
				 '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
				wf.type = 'text/javascript';
				wf.async = 'false';
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(wf, s);
			})();
		</script>
		<?php } ?>
		<?php if (($body_font_option == "fontdeck") || ($headings_font_option == "fontdeck") || ($menu_font_option == "fontdeck")) { ?>
		<!--// FONTDECK LOADER //-->
		<?php echo $fontdeck_js; ?>
		<?php } ?>	
		
		<?php if ($options['google_analytics'] != "") {
			echo $options['google_analytics'];
		} ?>
		
		<!--// WORDPRESS HEAD HOOK //-->
		<?php wp_head(); ?>
	
	<!--// CLOSE HEAD //-->
	</head>
	
	<!--// OPEN BODY //-->
	<body <?php body_class($page_class.' '.$is_responsive.' '.$extra_page_class); ?>>
		
		<?php  
			// MOBILE MENU
			echo sf_mobile_menu();
		?>
		
		<!--// OPEN #container //-->
		<?php if ($page_layout == "fullwidth") { ?>
		<div id="container">
		<?php } else { ?>
		<div id="container" class="boxed-layout">
		<?php } ?>
			
			<!--// OPEN #main-container //-->
			<div id="main-container" class="clearfix">
				
				<?php if (is_page()) {
					global $post;
					$show_posts_slider = sf_get_post_meta($post->ID, 'sf_posts_slider', true);
					$rev_slider_alias = sf_get_post_meta($post->ID, 'sf_rev_slider_alias', true);
					$layerSlider_ID = sf_get_post_meta($post->ID, 'sf_layerslider_id', true);
									
					if ($show_posts_slider) {
						sf_swift_slider();
					} else if ($rev_slider_alias != "") { ?>
						<div class="home-slider-wrap">
							<?php putRevSlider($rev_slider_alias); ?>
						</div>
				<?php } else if ($layerSlider_ID != "") { ?>
					<div class="home-slider-wrap">
						<?php echo do_shortcode('[layerslider id="'.$layerSlider_ID.'"]'); ?>
					</div>
				<?php }
					}
				?>
								
				<?php 
					// Page Heading
					sf_page_heading();
				?>
				
				<?php
					// Page container handling
					$pb_fw_mode = false;
					$fw_override = false;
					
					if ( $post && is_singular() ) {
					
						global $sf_pb_active;
									
						$sidebar_config = sf_get_post_meta($post_id, 'sf_sidebar_config', true);
						if ( isset($_GET['sidebar']) ) {
							$sidebar_config = $_GET['sidebar'];
						}
						
						if ( is_singular('portfolio') ) {
							$sidebar_config = "no-sidebars";
						}
						
						$pb_active = sf_get_post_meta($post_id, '_spb_js_status', true);
						
						if ( $sidebar_config != "no-sidebars" || post_password_required() ) {
							$pb_fw_mode = false;
						} else if ( $pb_active == "true" ) {
							$pb_fw_mode = true;
						}
						
						if ( function_exists('is_product') && is_product() && $sidebar_config == "no-sidebars" ) {
							$pb_fw_mode = true;
						}
						
						if ( is_page_template( 'template-fw.php' ) || is_page_template( 'template-fw-alt.php' ) ) {
							$pb_fw_mode = true;
						}
						
						if ( is_singular( 'portfolio' ) ) {
							$fw_media_display = sf_get_post_meta($post->ID, 'sf_fw_media_display', true);
							if ( $fw_media_display == "fw-media" ) {
								$fw_override = true;
							}
						}

						$sf_pb_active = $pb_fw_mode;
					}
					
					// Check if page should be enabled in full width mode
					if ($pb_fw_mode || $fw_override) { ?>
					<!--// OPEN .pb-fw-wrap //-->
					<div class="pb-fw-wrap">
					<?php } else { ?>
					<!--// OPEN .container //-->
					<div class="container">
				<?php } ?>
				
					<!--// OPEN #page-wrap //-->
					<div id="page-wrap">