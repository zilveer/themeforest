<!DOCTYPE html>

<!--// OPEN HTML //-->
<html <?php language_attributes(); ?>>

	<!--// OPEN HEAD //-->
	<head>
		
		<?php 
			// IE COMPATIBILITY 
			if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)) {
				echo('<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>');
			}
		?>
		
		<?php
			
			global $post;
			$post_id = 0;
			
			if ( ( function_exists('is_shop') && is_shop() ) || ( function_exists('is_product_category') && is_product_category() ) ) {
				$post_id = wc_get_page_id( 'shop' );
			} else {
				$post_id = $post->ID;
			}
			
			$options = get_option('sf_neighborhood_options');
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
			$header_overlay = $options['header_overlay'];
			$enable_promo_bar = $options['enable_promo_bar'];
			
			$page_class = $logo_class = $ss_enable = "";
			
			global $catalog_mode;
			
			if (isset($options['enable_catalog_mode'])) {
				$enable_catalog_mode = $options['enable_catalog_mode'];
				if ($enable_catalog_mode) {
					$catalog_mode = true;
					$page_class = "catalog-mode ";
				}
			}
			
			if (isset($options['mobile_header_tabletland'])) {
				if ($options['mobile_header_tabletland']) {
					$page_class .= 'mh-tabletland ';
				}
			}
			
			
			if ($enable_page_shadow) { 
			$page_class .= "page-shadow ";
			}
			
			if ($enable_header_shadow) {
			$page_class .= "header-shadow ";
			}
			
			if ($header_overlay) {
			//$page_class .= "header-overlay ";
			}
			
			if ($enable_promo_bar) {
			$page_class .= "has-promo-bar ";
			}
			
			if ($enable_logo_fade) {
			$logo_class = "logo-fade";
			}

			if (isset($_GET['layout'])) {
				$page_layout = $_GET['layout'];
			}
			
			if (isset($options['ss_enable'])) {
				$ss_enable = $options['ss_enable'];
			} else {
				$ss_enable = true;
			}
			
			$extra_page_class = "";
			if ($post) {
			$extra_page_class = sf_get_post_meta($post_id, 'sf_extra_page_class', true);
			}
		?>
		
		<!--// SITE TITLE //-->
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		
		
		<!--// SITE META //-->
		<meta charset="<?php bloginfo( 'charset' ); ?>" />	
		<?php if ($enable_responsive) { ?><meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1"><?php } ?>
		
		
		<!--// PINGBACK & FAVICON //-->
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<?php if (isset($options['custom_favicon'])) { ?><link rel="shortcut icon" href="<?php echo $options['custom_favicon']; ?>" /><?php } ?>
		
		<?php
			$custom_fonts = $google_font_one = $google_font_two = $google_font_three = $google_font_subset = $subset_output = "";
			
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
			
			if (isset($options['google_font_subset'])) {
			$google_font_subset = $options['google_font_subset'];
				$s = 0;
				if (is_array($google_font_subset)) {
					foreach ($google_font_subset as $subset) {
						if ($subset == "none") {
							break;
						}
						if ($s > 0) {
						$subset_output .= ','.$subset;
						} else {
						$subset_output = ':'.$subset;
						}
						$s++;
					}
				}
			}
			    
			if ($body_font_option == "google" && $google_font_one != "") {
				$custom_fonts .= "'".$google_font_one.$subset_output."', ";
			}
			if ($headings_font_option == "google" && $google_font_two != "") {
				$custom_fonts .= "'".$google_font_two.$subset_output."', ";
			}
			if ($menu_font_option == "google" && $google_font_three != "") {
				$custom_fonts .= "'".$google_font_three.$subset_output."', ";
			}
					?>
		<?php if (($body_font_option == "google") || ($headings_font_option == "google") || ($menu_font_option == "google")) { ?>
		<!--// GOOGLE FONT LOADER //-->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
			WebFont.load({
				google: { families: [<?php echo $custom_fonts; ?> 'Vidaloka'] }
			});
		</script>
		<?php } ?>
		
			<!--// LEGACY HTML5 SUPPORT //-->
			<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/excanvas.compiled.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js"></script>
		<![endif]-->
		
		<!--// WORDPRESS HEAD HOOK //-->
		<?php wp_head(); ?>
	
	<!--// CLOSE HEAD //-->
	</head>
	
	<!--// OPEN BODY //-->
	<body <?php body_class($page_class.' '.$is_responsive.' '.$extra_page_class); ?>>
		
		<!--// OPEN #container //-->
		<?php if ($page_layout == "fullwidth") { ?>
		<div id="container">
		<?php } else { ?>
		<div id="container" class="boxed-layout">
		<?php } ?>
			
			<?php
				if ($ss_enable && sf_woocommerce_activated()) {
					echo sf_super_search('header');
				}
			?>
			
			<!--// HEADER //-->
			<div class="header-wrap">
				<?php if ($enable_promo_bar) { ?>
					<!--// OPEN #promo-bar //-->
					<div id="promo-bar">
						<div class="container">
							<?php echo $options['promo_bar_text']; ?>
						</div>
					</div>
					
				<?php } ?>
			</div>
				
			<!--// OPEN #main-container //-->
			<div id="main-container" class="clearfix">
				
				<?php if ( is_page() ) {
						$show_posts_slider = sf_get_post_meta($post->ID, 'sf_posts_slider', true);
						$rev_slider_alias = sf_get_post_meta($post->ID, 'sf_rev_slider_alias', true);
						if ($show_posts_slider) {
							sf_swift_slider();
						} else if ($rev_slider_alias != "") { ?>
							<div class="home-slider-wrap">
								<?php 
									if ( function_exists('putRevSlider') ) {
										putRevSlider($rev_slider_alias);
									}
								?>
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
					
					if (is_singular() && $post) {
										
						global $sf_pb_active;
						
						$sidebar_config = sf_get_post_meta($post_id, 'sf_sidebar_config', true);
						if ( isset($_GET['sidebar']) ) {
							$sidebar_config = $_GET['sidebar'];
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

						$sf_pb_active = $pb_fw_mode;
					}
					
					// Check if page should be enabled in full width mode
					if ($pb_fw_mode) { ?>
					<!--// OPEN .pb-fw-wrap //-->
					<div class="pb-fw-wrap">
					<?php } else { ?>
					<!--// OPEN .container //-->
					<div class="container">
				<?php } ?>
				
					<!--// OPEN #page-wrap //-->
					<div id="page-wrap">