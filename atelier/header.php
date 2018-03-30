<!DOCTYPE html>

<!--// OPEN HTML //-->
<html <?php language_attributes(); ?>>

	<!--// OPEN HEAD //-->
	<head>
		
		<!-- Manually set render engine for Internet Explorer, prevent any plugin overrides -->
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE10">
		
		<?php
	        $page_class = "";

			if ( function_exists( 'sf_page_classes' ) ) {
				$page_classes = sf_page_classes();
				$page_class = $page_classes['page'];
			}

	        global $post, $sf_options;
	        $extra_page_class = $page_header_type = "";
	        $page_layout      = $sf_options['page_layout'];
	        $header_layout    = $sf_options['header_layout'];
	        if ( isset( $_GET['layout'] ) ) {
	            $page_layout = $_GET['layout'];
	        }
	        if ( $post ) {
	            $extra_page_class = sf_get_post_meta( $post->ID, 'sf_extra_page_class', true );
	        }
	        if ( is_page() && $post ) {
	            $page_header_type = sf_get_post_meta( $post->ID, 'sf_page_header_type', true );
	        }
			if ( $page_header_type == "below-slider" && $page_layout == "boxed" ) {
				add_action( 'sf_before_page_container', 'sf_pageslider', 20 );
	        } else if ( $page_header_type == "below-slider" && ( $header_layout != "header-vert" || $header_layout != "header-vert-right" ) ) {
	            add_action( 'sf_container_start', 'sf_pageslider', 5 );
	        } else {
	            add_action( 'sf_container_start', 'sf_pageslider', 30 );
	        }

	        if ( $page_header_type == "naked-light" || $page_header_type == "naked-dark" ) {
	            remove_action( 'sf_main_container_start', 'sf_breadcrumbs', 20 );
	        }
	    ?>

		<?php wp_head(); ?>

	<!--// CLOSE HEAD //-->
	</head>

	<!--// OPEN BODY //-->
	<body <?php body_class($page_class.' '.$extra_page_class); ?>>

		<?php
			/**
			 * @hooked - sf_site_loading - 5
			 * @hooked - sf_fullscreen_search - 6
			 * @hooked - sf_mobile_menu - 10
			 * @hooked - sf_mobile_cart - 20
			 * @hooked - sf_sideslideout - 40
			**/
			do_action('sf_before_page_container');
		?>

		<!--// OPEN #container //-->
		<div id="container">

			<?php
				/**
				 * @hooked - sf_pageslider - 5 (if above header)
				 * @hooked - sf_mobile_header - 10
				 * @hooked - sf_header_wrap - 20
				**/
				do_action('sf_container_start');
			?>

			<!--// OPEN #main-container //-->
			<div id="main-container" class="clearfix">

				<?php
					/**
					 * @hooked - sf_pageslider - 10 (if standard)
					 * @hooked - sf_breadcrumbs - 20
					 * @hooked - sf_page_heading - 30
					**/
					do_action('sf_main_container_start');
				?>