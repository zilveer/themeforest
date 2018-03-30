<?php

/*
*	Header Helper functions
*
* 	@version	1.0
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

 /**
 * Print Logo
 */
function blade_grve_print_logo( $mode = 'default', $align = '' ) {

	if ( !empty( $align ) ) {
		$align = 'grve-position-' . $align;
	}
	$grve_disable_logo = '';
	if ( is_singular() ) {
		$grve_disable_logo = blade_grve_post_meta( 'grve_disable_logo', $grve_disable_logo );
	} else if( blade_grve_is_woo_shop() ) {
		$grve_disable_logo = blade_grve_post_meta_shop( 'grve_disable_logo', $grve_disable_logo );
	}

	if ( 'yes' != $grve_disable_logo ) {

		$logo_custom_link_url = blade_grve_option( 'logo_custom_link_url' );
		$logo_link_url = home_url( '/' );
		if( !empty( $logo_custom_link_url ) ) {
			$logo_link_url = $logo_custom_link_url;
		}

		if ( blade_grve_visibility( 'logo_as_text_enabled' ) ) {
?>
		<!-- Logo As Text-->
		<div class="grve-logo grve-logo-text <?php echo esc_attr( $align ); ?>">
			<div class="grve-wrapper">
				<a href="<?php echo esc_url( $logo_link_url ); ?>"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a>
			</div>
		</div>
<?php
		} else {
?>
		<!-- Logo -->
		<div class="grve-logo <?php echo esc_attr( $align ); ?>">
			<div class="grve-wrapper">
				<a href="<?php echo esc_url( $logo_link_url ); ?>">
<?php
				switch( $mode ) {
					case 'side':
						blade_grve_print_logo_data( 'logo_side', 'grve-logo-side' );
					break;
					case 'responsive':
						blade_grve_print_logo_data( 'logo_responsive', 'grve-logo-responsive'  );
					break;
					default:
						blade_grve_print_logo_data( 'logo', 'grve-default');
						blade_grve_print_logo_data( 'logo_light', 'grve-light');
						blade_grve_print_logo_data( 'logo_dark', 'grve-dark');
						blade_grve_print_logo_data( 'logo_sticky', 'grve-sticky');
					break;
				}
?>
				</a>
			</div>
		</div>
		<!-- End Logo -->
<?php
		}
	}
}

 /**
 * Get Logo Data
 */
function blade_grve_print_logo_data( $logo_id, $logo_class ) {

	$logo_url = blade_grve_option( $logo_id, '', 'url' );

	$logo_attributes = array();
	$logo_attributes[] = 'data-no-retina=""';
	$logo_width = blade_grve_option( $logo_id, '', 'width' );
	$logo_height = blade_grve_option( $logo_id, '', 'height' );

	if ( !empty( $logo_width ) && !empty( $logo_height ) ) {
		$logo_attributes[] = 'width="' . esc_attr( $logo_width ) . '"';
		$logo_attributes[] = 'height="' . esc_attr( $logo_height ) . '"';
	}

	if ( !empty( $logo_url ) ) {
?>
		<img class="<?php echo esc_attr( $logo_class ); ?>" src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr( get_bloginfo('name') ); ?>" <?php echo implode( ' ', $logo_attributes ); ?>>
<?php
	}

}


 /**
 * Prints correct title/subtitle for all cases
 */
function blade_grve_header_title() {
	global $post;
	$page_title = $page_description = $page_reversed = '';

	//Shop
	if( blade_grve_woocommerce_enabled() ) {

		if ( is_shop() && !is_search() ) {
			$post_id = wc_get_page_id( 'shop' );
			$page_title   = get_the_title( $post_id );
			$page_description = get_post_meta( $post_id, 'grve_description', true );
			return array(
				'title' => $page_title,
				'description' => $page_description,
			);
		} else if( is_product_taxonomy() ) {
			$page_title  = single_term_title("", false);
			$page_description = category_description();
			return array(
				'title' => $page_title,
				'description' => $page_description,
			);
		}
	}

	//Main Pages
	if ( is_front_page() && is_home() ) {
		// Default homepage
		$page_title = get_bloginfo( 'name' );
		$page_description = get_bloginfo( 'description' );
	} else if ( is_front_page() ) {
		// static homepage
		$page_title = get_bloginfo( 'name' );
		$page_description = get_bloginfo( 'description' );
	} else if ( is_home() ) {
		// blog page
		$page_title = get_bloginfo( 'name' );
		$page_description = get_bloginfo( 'description' );
	} else if( is_search() ) {
		$page_description = esc_html__( 'Search Results for :', 'blade' );
		$page_title = esc_attr( get_search_query() );
		$page_reversed = 'reversed';
	} else if ( is_singular() ) {
		$post_id = $post->ID;
		$page_title = get_the_title();
		$page_description = get_post_meta( $post_id, 'grve_description', true );
	} else if ( is_archive() ) {
		//Post Categories
		if ( is_category() || is_tax( 'portfolio_category' ) || is_tax( 'portfolio_field' ) ) {
			$page_title = single_cat_title("", false);
			$page_description = category_description();
		} else if ( is_tag() ) {
			$page_description = esc_html__( "Posts Tagged :", 'blade' );
			$page_title = single_tag_title("", false);
			$page_reversed = 'reversed';
		} else if ( is_author() ) {
			global $author;
			$userdata = get_userdata( $author );
			$page_description = esc_html__( "Posts By :", 'blade' );
			$page_title = $userdata->display_name;
			$page_reversed = 'reversed';
		} else if ( is_day() ) {
			$page_description = esc_html__( "Daily Archives :", 'blade' );
			$page_title = get_the_time( 'l, F j, Y' );
			$page_reversed = 'reversed';
		} else if ( is_month() ) {
			$page_description = esc_html__( "Monthly Archives :", 'blade' );
			$page_title = get_the_time( 'F Y' );
			$page_reversed = 'reversed';
		} else if ( is_year() ) {
			$page_description = esc_html__( "Yearly Archives :", 'blade' );
			$page_title = get_the_time( 'Y' );
			$page_reversed = 'reversed';
		} else {
			$page_title = esc_html__( "Archives", 'blade' );
		}
	} else {
		$page_title = get_bloginfo( 'name' );
		$page_description = get_bloginfo( 'description' );
	}

	return array(
		'title' => $page_title,
		'description' => $page_description,
		'reversed' => $page_reversed,
	);


}

 /**
 * Check title visibility
 */
function blade_grve_check_title_visibility() {

	$blog_title = blade_grve_option( 'blog_title', 'sitetitle' );

	if ( is_front_page() && is_home() ) {
		// Default homepage
		if ( 'none' == $blog_title ) {
			return false;
		}
	} elseif ( is_front_page() ) {
		// static homepage
		if ( 'yes' == blade_grve_post_meta( 'grve_disable_title' ) || ( blade_grve_is_woo_shop() && 'yes' == blade_grve_post_meta_shop( 'grve_disable_title' ) ) ) {
			return false;
		}
	} elseif ( is_home() ) {
		// blog page
		if ( 'none' == $blog_title ) {
			return false;
		}
	} else {
		if ( ( is_singular() && 'yes' == blade_grve_post_meta( 'grve_disable_title' ) ) || ( blade_grve_is_woo_shop() && 'yes' == blade_grve_post_meta_shop( 'grve_disable_title' ) ) ) {
			return false;
		}
	}

	return true;

}

/**
 * Prints side Header Background Image
 */
 if ( !function_exists('blade_grve_print_side_header_bg_image') ) {

	function blade_grve_print_side_header_bg_image() {

		if ( 'custom' == blade_grve_option( 'header_side_bg_mode' ) ) {
			$grve_header_custom_bg = array(
				'bg_mode' => 'custom',
				'bg_image_id' => blade_grve_option( 'header_side_bg_image', '', 'id' ),
				'bg_position' => blade_grve_option( 'header_side_bg_position', 'center-center' ),
				'pattern_overlay' => blade_grve_option( 'header_side_pattern_overlay' ),
				'color_overlay' => blade_grve_option( 'header_side_color_overlay' ),
				'opacity_overlay' => blade_grve_option( 'header_side_opacity_overlay' ),
			);
			blade_grve_print_title_bg_image( $grve_header_custom_bg );
		}

	}
}

function blade_grve_print_title_bg_image( $grve_page_title = array() ) {

	$image_url = '';
	$bg_mode = blade_grve_array_value( $grve_page_title, 'bg_mode', 'color' );

	if ( 'color' != $bg_mode ) {

		$bg_position = blade_grve_array_value( $grve_page_title, 'bg_position', 'center-center' );

		$media_id = '0';



		if ( 'featured' == $bg_mode ) {
			$grve_woo_shop = blade_grve_is_woo_shop();
			if ( is_singular() || $grve_woo_shop ) {
				if ( $grve_woo_shop ) {
					$id = wc_get_page_id( 'shop' );
				} else {
					$id = get_the_ID();
				}
				if( has_post_thumbnail( $id ) ) {
					$media_id = get_post_thumbnail_id( $id );
				}
			}
		} else if ( 'custom' ) {
			$media_id = blade_grve_array_value( $grve_page_title, 'bg_image_id' );
		}
		$full_src = wp_get_attachment_image_src( $media_id, 'blade-grve-fullscreen' );
		$image_url = $full_src[0];

		if( !empty( $image_url ) ) {
			echo '<div class="grve-background-wrapper">';
			blade_grve_print_overlay_container( $grve_page_title );
			echo '<div class="grve-bg-image grve-bg-' . esc_attr( $bg_position ) . '" style="background-image: url(' . esc_url( $image_url ) . ');"></div>';
			echo '</div>';
		}
	}

}

 /**
 * Prints title/subtitle ( Page )
 */
function blade_grve_print_header_title( $mode = 'page') {
	global $post;

	if ( blade_grve_check_title_visibility() ) {

        $item_type = str_replace ( '_' , '-', $mode );
		$grve_page_title_id = 'grve-' . $item_type  . '-title';
		$grve_page_title = array(
			'height' => blade_grve_option( $mode . '_title_height' ),
			'min_height' => blade_grve_option( $mode . '_title_min_height' ),
			'title_color' => blade_grve_option( $mode . '_title_color' ),
			'title_color_custom' => blade_grve_option( $mode . '_title_color_custom' ),
			'caption_color' => blade_grve_option( $mode . '_description_color' ),
			'caption_color_custom' => blade_grve_option( $mode . '_description_color_custom' ),
			'content_position' => blade_grve_option( $mode . '_title_content_position' ),
			'content_animation' => blade_grve_option( $mode . '_title_content_animation' ),
			'bg_mode' => blade_grve_option( $mode . '_title_bg_mode' ),
			'bg_image_id' => blade_grve_option( $mode . '_title_bg_image', '', 'id' ),
			'bg_position' => blade_grve_option( $mode . '_title_bg_position' ),
			'bg_color' => blade_grve_option( $mode . '_title_bg_color', 'dark' ),
			'bg_color_custom' => blade_grve_option( $mode . '_title_bg_color_custom' ),
			'pattern_overlay' => blade_grve_option( $mode . '_title_pattern_overlay' ),
			'color_overlay' => blade_grve_option( $mode . '_title_color_overlay' ),
			'color_overlay_custom' => blade_grve_option( $mode . '_title_color_overlay_custom' ),
			'opacity_overlay' => blade_grve_option( $mode . '_title_opacity_overlay' ),
		);

		$header_data = blade_grve_header_title();
		$header_title = isset( $header_data['title'] ) ? $header_data['title'] : '';
		$header_description = isset( $header_data['description'] ) ? $header_data['description'] : '';
		$header_reversed = isset( $header_data['reversed'] ) ? $header_data['reversed'] : '';

		$grve_woo_shop = blade_grve_is_woo_shop();

		if ( is_singular() || $grve_woo_shop  ) {
			if ( $grve_woo_shop ) {
				$post_id = wc_get_page_id( 'shop' );
			} else {
				$post_id = $post->ID;
			}

			$grve_custom_title_options = get_post_meta( $post_id, 'grve_custom_title_options', true );
			$grve_page_title_custom = blade_grve_array_value( $grve_custom_title_options, 'custom' );
			if ( 'custom' == $grve_page_title_custom ) {
				$grve_page_title = $grve_custom_title_options;
			}
		} else if ( is_tag() || is_category() || blade_grve_is_woo_category() || blade_grve_is_woo_tag() ) {
			$category_id = get_queried_object_id();
			$grve_custom_title_options = blade_grve_get_term_meta( $category_id, 'grve_custom_title_options' );
			$grve_page_title_custom = blade_grve_array_value( $grve_custom_title_options, 'custom' );
			if ( 'custom' == $grve_page_title_custom ) {
				$grve_page_title = $grve_custom_title_options;
			}
		}

		$grve_wrapper_title_classes = array( 'grve-page-title' );

		$bg_mode = blade_grve_array_value( $grve_page_title, 'bg_mode', 'color' );
		if ( 'color' == $bg_mode ) {
			$grve_wrapper_title_classes[] = 'grve-with-title';
		} else {
			$grve_wrapper_title_classes[] = 'grve-with-image';
		}

		$grve_title_classes = array( 'grve-title', 'clearfix' );
		$grve_caption_classes = array( 'grve-description', 'clearfix' );
		$grve_subheading_classes = array( 'grve-title-meta', 'grve-subheading', 'grve-list-divider', 'clearfix' );

		$content_position = blade_grve_array_value( $grve_page_title, 'content_position', 'center-center' );
		$content_animation = blade_grve_array_value( $grve_page_title, 'content_animation', 'fade-in' );
		$page_title_height = blade_grve_array_value( $grve_page_title, 'height', '350' );
		$page_title_min_height = blade_grve_array_value( $grve_page_title, 'min_height', '320' );


		$page_title_bg_color = blade_grve_array_value( $grve_page_title, 'bg_color', 'dark' );
		if ( 'custom' != $page_title_bg_color ) {
			$grve_wrapper_title_classes[] = 'grve-bg-' . $page_title_bg_color;
		}

		$page_title_color = blade_grve_array_value( $grve_page_title, 'title_color', 'light' );
		if ( 'custom' != $page_title_color ) {
			$grve_title_classes[] = 'grve-text-' . $page_title_color;
		}
		$page_title_caption_color = blade_grve_array_value( $grve_page_title, 'caption_color', 'light' );
		if ( 'custom' != $page_title_caption_color ) {
			$grve_caption_classes[] = 'grve-text-' . $page_title_caption_color;
			$grve_subheading_classes[] = 'grve-text-' . $page_title_caption_color;
		}

		$grve_wrapper_title_classes = implode( ' ', $grve_wrapper_title_classes );
		$grve_title_classes = implode( ' ', $grve_title_classes );
		$grve_caption_classes = implode( ' ', $grve_caption_classes );
		$grve_subheading_classes = implode( ' ', $grve_subheading_classes );
?>
	<!-- Page Title -->
	<div id="<?php echo esc_attr( $grve_page_title_id ); ?>" class="<?php echo esc_attr( $grve_wrapper_title_classes ); ?>" data-height="<?php echo esc_attr( $page_title_height ); ?>">
		<div class="grve-wrapper clearfix" style="height:<?php echo esc_attr( $page_title_height ); ?>px; min-height:<?php echo esc_attr( $page_title_min_height ); ?>px;">
			<?php do_action( 'blade_grve_page_title_top' ); ?>
			<div class="grve-content grve-align-<?php echo esc_attr( $content_position ); ?>" data-animation="<?php echo esc_attr( $content_animation ); ?>">
				<div class="grve-container">
				<?php if( 'post' == $mode ) { ?>
						<ul class="<?php echo esc_attr( $grve_subheading_classes ); ?>">
							<?php if ( blade_grve_visibility( 'post_author_visibility' ) ) { ?>
							<li><span class="grve-author"><?php esc_html_e( 'By', 'blade' ); ?> <a href="#grve-about-author"><?php the_author(); ?></a></span></li>
							<?php } ?>
							<li><span class="grve-day"><?php echo esc_html( get_the_date() ); ?></span></li>
						</ul>
				<?php } ?>
				<?php if ( empty( $header_reversed ) ) { ?>
					<h1 class="<?php echo esc_attr( $grve_title_classes ); ?>"><span><?php echo esc_html( $header_title ); ?></span></h1>
					<?php if ( !empty( $header_description ) ) { ?>
					<div class="<?php echo esc_attr( $grve_caption_classes ); ?>"><?php echo wp_kses_post( $header_description ); ?></div>
					<?php } ?>
				<?php } else { ?>
					<?php if ( !empty( $header_description ) ) { ?>
					<div class="<?php echo esc_attr( $grve_caption_classes ); ?>"><?php echo wp_kses_post( $header_description ); ?></div>
					<?php } ?>
					<h1 class="<?php echo esc_attr( $grve_title_classes ); ?>"><span><?php echo esc_html( $header_title ); ?></span></h1>
				<?php } ?>
				</div>
			</div>
			<?php do_action( 'blade_grve_page_title_bottom' ); ?>
		</div>
		<?php blade_grve_print_title_bg_image( $grve_page_title ); ?>
	</div>
	<!-- End Page Title -->
<?php
	}
}

 /**
 * Prints Anchor Menu
 */
function blade_grve_print_anchor_menu( $mode = 'page') {

	$item_type = str_replace ( '_' , '-', $mode );
	$grve_anchor_id = 'grve-' . $item_type  . '-anchor';
	if ( blade_grve_is_woo_shop() ) {
		$anchor_nav_menu = blade_grve_post_meta_shop( 'grve_anchor_navigation_menu' );
	} else {
		$anchor_nav_menu = blade_grve_post_meta( 'grve_anchor_navigation_menu' );
	}

	if ( !empty( $anchor_nav_menu ) ) {

		$grve_anchor_fullwidth = blade_grve_option( $mode . '_anchor_menu_fullwidth' );
		$grve_anchor_alignment = blade_grve_option( $mode . '_anchor_menu_alignment', 'left' );
		$grve_anchor_current_link = blade_grve_option( $mode . '_anchor_menu_highlight_current' );

		$grve_anchor_classes = array( 'grve-anchor-menu', 'clearfix' );
		if ( '1' == $grve_anchor_current_link ) {
			$grve_anchor_classes[] = 'grve-current-link';
		}
		if ( '1' == $grve_anchor_fullwidth ) {
			$grve_anchor_classes[] = ' grve-fullwidth';
		}
		$grve_anchor_classes[] = 'grve-align-' . $grve_anchor_alignment ;
		$grve_anchor_classes = implode( ' ', $grve_anchor_classes );
?>
		<!-- ANCHOR MENU -->
		<div id="<?php echo esc_attr( $grve_anchor_id ); ?>" class="<?php echo esc_attr( $grve_anchor_classes ); ?>">
			<div class="grve-anchor-wrapper">
				<div class="grve-container">
					<a href="#" class="grve-anchor-btn"><i class="grve-icon-menu"></i></a>
					<?php
					wp_nav_menu(
						array(
							'menu' => $anchor_nav_menu, /* menu id */
							'container' => false, /* no container */
						)
					);
					?>
				</div>
			</div>
		</div>
		<!-- END ANCHOR MENU -->
<?php
	}
}

 /**
 * Prints header breadcrumbs
 */
function blade_grve_print_header_breadcrumbs( $mode = 'page') {

	$grve_disable_breadcrumbs = 'yes';

	if( blade_grve_visibility( $mode . '_breadcrumbs_enabled' ) ) {
		$grve_disable_breadcrumbs = 'no';
		if ( is_singular() ) {
			$grve_disable_breadcrumbs = blade_grve_post_meta( 'grve_disable_breadcrumbs', $grve_disable_breadcrumbs );
		} else if( blade_grve_is_woo_shop() ) {
			$grve_disable_breadcrumbs = blade_grve_post_meta_shop( 'grve_disable_breadcrumbs', $grve_disable_breadcrumbs );
		}
	}

	if ( 'yes' != $grve_disable_breadcrumbs  ) {

		$item_type = str_replace ( '_' , '-', $mode );
		$grve_breadcrumbs_id = 'grve-' . $item_type  . '-breadcrumbs';
		$grve_breadcrumbs_fullwidth = blade_grve_option( $mode . '_breadcrumbs_fullwidth' );
		$grve_breadcrumbs_alignment = blade_grve_option( $mode . '_breadcrumbs_alignment', 'left' );

		$grve_breadcrumbs_classes = array( 'grve-breadcrumbs', 'clearfix' );
		if ( '1' == $grve_breadcrumbs_fullwidth ) {
			$grve_breadcrumbs_classes[] = ' grve-fullwidth';
		}
		$grve_breadcrumbs_classes[] = 'grve-align-' . $grve_breadcrumbs_alignment ;
		$grve_breadcrumbs_classes = implode( ' ', $grve_breadcrumbs_classes );
?>
	<div id="<?php echo esc_attr( $grve_breadcrumbs_id ); ?>" class="<?php echo esc_attr( $grve_breadcrumbs_classes ); ?>">
		<div class="grve-breadcrumbs-wrapper">
			<div class="grve-container">
				<?php blade_grve_print_breadcrumbs(); ?>
			</div>
		</div>
	</div>
<?php
	}
}

/**
 * Prints header top bar text
 */
function blade_grve_print_header_top_bar_text( $text ) {
	if ( !empty( $text ) ) {
?>
		<li class="grve-topbar-item"><p><?php echo do_shortcode( $text ); ?></p></li>
<?php
	}
}

/**
 * Prints header top bar navigation
 */
function blade_grve_print_header_top_bar_nav( $position = 'left' ) {
?>
	<li class="grve-topbar-item">
		<nav class="grve-top-bar-menu grve-small-text grve-list-divider">
			<?php
				if( 'left' == $position ) {
					blade_grve_top_left_nav();
				} else {
					blade_grve_top_right_nav();
				}
			?>
		</nav>
	</li>
<?php
}

/**
 * Prints header top bar search icon
 */
function blade_grve_print_header_top_bar_search( $position = 'left' ) {
?>
	<li class="grve-topbar-item"><a href="#grve-search-modal" class="grve-icon-search grve-toggle-modal"></a></li>
<?php
}

/**
 * Prints header top bar form icon
 */
function blade_grve_print_header_top_bar_form( $position = 'left' ) {

	if( 'left' == $position ) {
		$modal_id = '#grve-top-left-form-modal';
	} else {
		$modal_id = '#grve-top-right-form-modal';
	}
?>
	<li class="grve-topbar-item"><a href="<?php echo esc_attr( $modal_id ); ?>" class="grve-icon-envelope grve-toggle-modal"></a></li>
<?php

}

/**
 * Prints header top bar socials
 */
function blade_grve_print_header_top_bar_socials( $options ) {

	$social_options = blade_grve_option('social_options');
	if ( !empty( $options ) && !empty( $social_options ) ) {
		?>
			<li class="grve-topbar-item">
				<ul class="grve-social">
		<?php
		foreach ( $social_options as $key => $value ) {
			if ( isset( $options[$key] ) && 1 == $options[$key] && $value ) {
				if ( 'skype' == $key ) {
					echo '<li><a href="' . esc_url( $value, array( 'skype', 'http', 'https' ) ) . '" class="fa fa-' . esc_attr( $key ) . '"></a></li>';
				} else {
					echo '<li><a href="' . esc_url( $value ) . '" target="_blank" class="fa fa-' . esc_attr( $key ) . '"></a></li>';
				}
			}
		}
		?>
				</ul>
			</li>
		<?php
	}

}

/**
 * Prints header top bar language selector
 */
function blade_grve_print_header_top_bar_language_selector() {

	//start language selector output buffer
    ob_start();

	$languages = '';

	//Polylang
	if( function_exists( 'pll_the_languages' ) ) {
		$languages = pll_the_languages( array( 'raw'=>1 ) );

		$lang_option_current = $lang_options = '';

		foreach ( $languages as $l ) {

			if ( !$l['current_lang'] ) {
				$lang_options .= '<li>';
				$lang_options .= '<a href="' . esc_url( $l['url'] ) . '" class="grve-language-item">';
				$lang_options .= '<img src="' . esc_url( $l['flag'] ) . '" alt="' . esc_attr( $l['name'] ) . '"/>';
				$lang_options .= esc_html( $l['name'] );
				$lang_options .= '</a>';
				$lang_options .= '</li>';
			} else {
				$lang_option_current .= '<a href="#" class="grve-language-item">';
				$lang_option_current .= '<img src="' . esc_url( $l['flag'] ) . '" alt="' . esc_attr( $l['name'] ) . '"/>';
				$lang_option_current .= esc_html( $l['name'] );
				$lang_option_current .= '</a>';
			}
		}

	}

	//WPML
	if ( defined( 'ICL_SITEPRESS_VERSION' ) && defined( 'ICL_LANGUAGE_CODE' ) ) {

		$languages = icl_get_languages( 'skip_missing=0' );
		if ( ! empty( $languages ) ) {

			$lang_option_current = $lang_options = '';

			foreach ( $languages as $l ) {

				if ( !$l['active'] ) {
					$lang_options .= '<li>';
					$lang_options .= '<a href="' . esc_url( $l['url'] ) . '" class="grve-language-item">';
					$lang_options .= '<img src="' . esc_url( $l['country_flag_url'] ) . '" alt="' . esc_attr( $l['language_code'] ) . '"/>';
					$lang_options .= esc_html( $l['native_name'] );
					$lang_options .= '</a>';
					$lang_options .= '</li>';
				} else {
					$lang_option_current .= '<a href="#" class="grve-language-item">';
					$lang_option_current .= '<img src="' . esc_url( $l['country_flag_url'] ) . '" alt="' . esc_attr( $l['language_code'] ) . '"/>';
					$lang_option_current .= esc_html( $l['native_name'] );
					$lang_option_current .= '</a>';
				}
			}
		}
	}
	if ( ! empty( $languages ) ) {

?>
	<li class="grve-topbar-item">
		<ul class="grve-language grve-small-text">
			<li>
				<?php echo wp_kses_post( $lang_option_current ); ?>
				<ul>
					<?php echo wp_kses_post( $lang_options ); ?>
				</ul>
			</li>
		</ul>
	</li>
<?php
	}
	//store the language selector buffer and clean
	$grve_lang_selector_out = ob_get_clean();
	echo apply_filters( 'blade_grve_header_top_bar_language_selector', $grve_lang_selector_out );
}


/**
 * Prints header top bar
 */
function blade_grve_print_header_top_bar() {

	if ( blade_grve_visibility( 'top_bar_enabled' ) ) {
		if ( ( is_singular() && 'yes' == blade_grve_post_meta( 'grve_disable_top_bar' ) ) || ( blade_grve_is_woo_shop() && 'yes' == blade_grve_post_meta_shop( 'grve_disable_top_bar' ) ) ) {
			return;
		}

		$section_type = blade_grve_option( 'top_bar_section_type', 'fullwidth-background' );
		$top_bar_class = '';
		if( 'fullwidth-element' == $section_type ) {
			$top_bar_class = 'grve-fullwidth';
		}
?>

		<!-- Top Bar -->
		<div id="grve-top-bar" class="<?php echo esc_attr( $top_bar_class ); ?>">
			<div class="grve-wrapper clearfix">
				<div class="grve-container">

					<?php
					if ( blade_grve_visibility( 'top_bar_left_enabled' ) ) {
					?>
					<ul class="grve-bar-content grve-left-side">
						<?php

							//Top Left First Item Hook
							do_action( 'blade_grve_header_top_bar_left_first_item' );

							//Top Left Options
							$top_bar_left_options = blade_grve_option('top_bar_left_options');

							if ( !empty( $top_bar_left_options ) ) {
								foreach ( $top_bar_left_options as $key => $value ) {
									if( !empty( $value ) && '0' != $value ) {

										switch( $key ) {
											case 'menu':
												blade_grve_print_header_top_bar_nav( 'left' );
											break;
											case 'search':
												blade_grve_print_header_top_bar_search( 'left' );
											break;
											case 'form':
												blade_grve_print_header_top_bar_form( 'left' );
											break;
											case 'text':
												$grve_left_text = blade_grve_option('top_bar_left_text');
												blade_grve_print_header_top_bar_text( $grve_left_text );
											break;
											case 'language':
												blade_grve_print_header_top_bar_language_selector();
											break;
											case 'social':
												$top_bar_left_social_options = blade_grve_option('top_bar_left_social_options');
												blade_grve_print_header_top_bar_socials( $top_bar_left_social_options);
											break;
											default:
											break;
										}
									}
								}
							}

							//Top Left Last Item Hook
							do_action( 'blade_grve_header_top_bar_left_last_item' );

						?>
					</ul>
					<?php
						}
					?>

					<?php
					if ( blade_grve_visibility( 'top_bar_right_enabled' ) ) {
					?>
					<ul class="grve-bar-content grve-right-side">
						<?php

							//Top Right First Item Hook
							do_action( 'blade_grve_header_top_bar_right_first_item' );

							//Top Right Options
							$top_bar_right_options = blade_grve_option('top_bar_right_options');
							if ( !empty( $top_bar_right_options ) ) {
								foreach ( $top_bar_right_options as $key => $value ) {
									if( !empty( $value ) && '0' != $value ) {

										switch( $key ) {
											case 'menu':
												blade_grve_print_header_top_bar_nav( 'right' );
											break;
											case 'search':
												blade_grve_print_header_top_bar_search( 'right' );
											break;
											case 'form':
												blade_grve_print_header_top_bar_form( 'right' );
											break;
											case 'text':
												$grve_right_text = blade_grve_option('top_bar_right_text');
												blade_grve_print_header_top_bar_text( $grve_right_text );
											break;
											case 'language':
												blade_grve_print_header_top_bar_language_selector();
											break;
											case 'social':
												$top_bar_right_social_options = blade_grve_option('top_bar_right_social_options');
												blade_grve_print_header_top_bar_socials( $top_bar_right_social_options );
											break;
											default:
											break;
										}
									}
								}
							}

							//Top Right Last Item Hook
							do_action( 'blade_grve_header_top_bar_right_last_item' );

						?>


					</ul>
					<?php
						}
					?>
				</div>
			</div>
		</div>
		<!-- End Top Bar -->
<?php

	}
}

/**
 * Prints check header elements visibility
 */
function blade_grve_check_header_elements_visibility_responsive() {
	$header_menu_options = blade_grve_option('header_menu_options');
	if ( !empty( $header_menu_options ) ) {
		foreach ( $header_menu_options as $key => $value ) {
			if( !empty( $value ) && '0' != $value && 'cart' != $key && blade_grve_check_header_elements_visibility( $key ) ) {
				return true;
			}
		}
	}
	return false;
}

function blade_grve_check_header_elements_visibility( $item = 'none' ) {

	$visibility = false;

	if ( blade_grve_visibility( 'header_menu_options_enabled' ) ) {

		if ( is_singular() ) {
			$grve_disable_menu_items = blade_grve_post_meta( 'grve_disable_menu_items' );
			if ( 'yes' == blade_grve_array_value( $grve_disable_menu_items, $item  ) ) {
				return false;
			}
		}
		if ( blade_grve_is_woo_shop() ) {
			$grve_disable_menu_items = blade_grve_post_meta_shop( 'grve_disable_menu_items' );
			if ( 'yes' == blade_grve_array_value( $grve_disable_menu_items, $item  ) ) {
				return false;
			}
		}

		$header_menu_options = blade_grve_option('header_menu_options');
		if ( !empty( $header_menu_options ) ) {
			if ( isset( $header_menu_options[ $item ] ) && !empty( $header_menu_options[ $item ] ) && '0' != $header_menu_options[ $item ] ) {
				$visibility = true;
			}
		}

	}

	return $visibility;
}

/**
 * Prints header elements e.g: social, language selector, search
 */
function blade_grve_print_header_elements( $grve_sidearea_data = '') {

		$header_menu_options = blade_grve_option('header_menu_options');
		$grve_header_mode = blade_grve_option( 'header_mode', 'default' );

		$align = '';
		if ( 'side' != $grve_header_mode ) {
			$align = 'grve-position-left';
		}

?>
		<!-- Header Elements -->
		<div class="grve-header-elements <?php echo esc_attr( $align ); ?>">
			<div class="grve-wrapper">
				<ul>
<?php

			if ( !empty( $grve_sidearea_data ) ) {
				blade_grve_print_header_sidearea_button( $grve_sidearea_data, 'list' );
			}
			$header_menu_social_mode = blade_grve_option('header_menu_social_mode', 'modal');
			do_action( 'blade_grve_header_elements_first_item' );

			if ( !empty( $header_menu_options ) ) {
				foreach ( $header_menu_options as $key => $value ) {
					if( !empty( $value ) && '0' != $value && blade_grve_check_header_elements_visibility( $key ) ) {
						if ( 'search' == $key ) {
						?>
							<li class="grve-header-element"><a href="#grve-search-modal" class="grve-toggle-modal"><span class="grve-item"><i class="grve-icon-search"></i></span></a></li>
						<?php
						} else if ( 'language' == $key ) {
						?>
							<li class="grve-header-element"><a href="#grve-language-modal" class="grve-toggle-modal"><span class="grve-item"><i class="grve-icon-globe"></i></span></a></li>
						<?php
						} else if ( 'form' == $key ) {
						?>
							<li class="grve-header-element"><a href="#grve-menu-form-modal" class="grve-toggle-modal"><span class="grve-item"><i class="grve-icon-envelope"></i></span></a></li>
						<?php
						} else if ( 'cart' == $key && blade_grve_woocommerce_enabled() ) {
							global $woocommerce;
						?>
							<li class="grve-header-element">
								<a href="#grve-cart-area" class="grve-toggle-hiddenarea">
									<span class="grve-item">
										<i class="grve-icon-cart"></i>
									</span>
								</a>
								<span class="grve-purchased-items"><?php echo esc_html( $woocommerce->cart->cart_contents_count ); ?></span>
							</li>
						<?php
						} else if ( 'social' == $key ) {
							$header_social_options = blade_grve_option('header_menu_social_options');
							$social_options = blade_grve_option('social_options');
							if( 'modal' == $header_menu_social_mode ) {
						?>
							<li class="grve-header-element"><a href="#grve-socials-modal" class="grve-toggle-modal"><span class="grve-item"><i class="grve-icon-socials"></i></span></a></li>
						<?php
							} else {

								if ( !empty( $header_social_options ) && !empty( $social_options ) ) {

									foreach ( $social_options as $key => $value ) {
										if ( isset( $header_social_options[$key] ) && 1 == $header_social_options[$key] && $value ) {
											if ( 'skype' == $key ) {
												echo '<li class="grve-header-element"><a href="' . esc_url( $value, array( 'skype', 'http', 'https' ) ) . '"><span class="grve-item"><i class="fa fa-' . esc_attr( $key ) . '"></i></span></a></li>';
											} else {
												echo '<li class="grve-header-element"><a href="' . esc_url( $value ) . '" target="_blank"><span class="grve-item"><i class="fa fa-' . esc_attr( $key ) . '"></i></span></a></li>';
											}
										}
									}

								}

							}
						}
					}
				}
			}

			do_action( 'blade_grve_header_elements_last_item' );
?>
				</ul>
			</div>
		</div>
		<!-- End Header Elements -->
<?php


}

/**
 * Prints header elements e.g: social, language selector, search
 */
function blade_grve_print_header_elements_responsive() {

	$header_menu_options = blade_grve_option('header_menu_options');
	if ( !empty( $header_menu_options ) ) {
		foreach ( $header_menu_options as $key => $value ) {
			if( !empty( $value ) && '0' != $value && blade_grve_check_header_elements_visibility( $key ) ) {
				if ( 'search' == $key ) {
				?>
					<div class="grve-header-responsive-elements">
						<div class="grve-wrapper">
							<div class="grve-widget">
								<?php get_search_form(); ?>
							</div>
						</div>
					</div>
				<?php
				} else if ( 'language' == $key ) {
				?>
					<div class="grve-header-responsive-elements">
						<div class="grve-wrapper">
							<?php blade_grve_print_language_modal_selector(); ?>
						</div>
					</div>
				<?php
				} else if ( 'form' == $key ) {
				?>
					<div class="grve-header-responsive-elements">
						<div class="grve-wrapper">
							<div class="grve-newsletter">
								<?php blade_grve_print_contact_form( 'header_menu_form' ); ?>
							</div>
						</div>
					</div>
				<?php
				} else if ( 'social' == $key ) {
					$header_social_options = blade_grve_option('header_menu_social_options');
					$social_options = blade_grve_option('social_options');
					if ( !empty( $header_social_options ) && !empty( $social_options ) ) {
?>
						<!-- Responsive social Header Elements -->
						<div class="grve-header-responsive-elements">
							<div class="grve-wrapper">
								<ul>
<?php
									foreach ( $social_options as $key => $value ) {
										if ( isset( $header_social_options[$key] ) && 1 == $header_social_options[$key] && $value ) {
											if ( 'skype' == $key ) {
												echo '<li class="grve-header-responsive-element"><a href="' . esc_url( $value, array( 'skype', 'http', 'https' ) ) . '"><span class="grve-item"><i class="fa fa-' . esc_attr( $key ) . '"></i></span></a></li>';
											} else {
												echo '<li class="grve-header-responsive-element"><a href="' . esc_url( $value ) . '" target="_blank"><span class="grve-item"><i class="fa fa-' . esc_attr( $key ) . '"></i></span></a></li>';
											}
										}
									}
?>
								</ul>
							</div>
						</div>
						<!-- End Social Header Elements -->
<?php
					}
				}
			}
		}
	}

}



/**
 * Prints Form modals
 */
function blade_grve_print_contact_form( $option = 'header_menu_form' ) {

	if ( blade_grve_is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {
		$contact_form_id = blade_grve_option( $option );
		if ( !empty( $contact_form_id ) ) {
			echo do_shortcode('[contact-form-7 id="' . esc_attr( $contact_form_id ) . '"]');
		}
	}

}

function blade_grve_print_form_modals() {
?>
		<div id="grve-top-left-form-modal" class="grve-modal">
			<div class="grve-modal-wrapper">
				<div class="grve-modal-content">
					<div class="grve-modal-form">
						<div class="grve-modal-item">
							<?php blade_grve_print_contact_form( 'top_bar_left_form' ); ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="grve-top-right-form-modal" class="grve-modal">
			<div class="grve-modal-wrapper">
				<div class="grve-modal-content">
					<div class="grve-modal-form">
						<div class="grve-modal-item">
							<?php blade_grve_print_contact_form( 'top_bar_right_form' ); ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="grve-menu-form-modal" class="grve-modal">
			<div class="grve-modal-wrapper">
				<div class="grve-modal-content">
					<div class="grve-modal-form">
						<div class="grve-modal-item">
							<?php blade_grve_print_contact_form( 'header_menu_form' ); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php
}

/**
 * Prints Search modal
 */
function blade_grve_print_search_modal() {
		$form = '';
?>
		<div id="grve-search-modal" class="grve-modal">
			<div class="grve-modal-wrapper">
				<div class="grve-modal-content">
					<div class="grve-modal-item">
						<?php echo blade_grve_modal_wpsearch( $form ); ?>
					</div>
				</div>
			</div>
		</div>
<?php

}

/**
 * Prints header language selector
 * WPML/Polylang is required
 * Can be used to add custom php code for other translation flags.
 */
if( !function_exists( 'blade_grve_print_language_modal_selector' ) ) {
	function blade_grve_print_language_modal_selector() {

		//start language selector output buffer
		ob_start();
?>
		<ul class="grve-language">
<?php
		//Polylang
		if( function_exists( 'pll_the_languages' ) ) {
			$languages = pll_the_languages( array( 'raw'=>1 ) );
			if ( ! empty( $languages ) ) {
				foreach ( $languages as $l ) {
					echo '<li>';
					if ( !$l['current_lang'] ) {
						echo '<a href="' . esc_url( $l['url'] ) . '">';
					} else {
						echo '<a href="#" class="active">';
					}
					echo esc_html( $l['name'] );

					echo '</a></li>';
				}
			}
		}

		//WPML
		if ( defined( 'ICL_SITEPRESS_VERSION' ) && defined( 'ICL_LANGUAGE_CODE' ) ) {
			$languages = icl_get_languages( 'skip_missing=0' );
			if ( ! empty( $languages ) ) {
				foreach ( $languages as $l ) {
					echo '<li>';
					if ( !$l['active'] ) {
						echo '<a href="' . esc_url( $l['url'] ) . '">';
					} else {
						echo '<a href="#" class="active">';
					}
					echo esc_html( $l['native_name'] );

					echo '</a></li>';
				}
			}
		}
?>
		</ul>
<?php
		//store the language selector buffer and clean
		$grve_lang_selector_out = ob_get_clean();
		echo apply_filters( 'blade_grve_language_modal_selector', $grve_lang_selector_out );
	}
}

function blade_grve_print_language_modal() {
?>
	<div id="grve-language-modal" class="grve-modal">
		<div class="grve-modal-wrapper">
			<div class="grve-modal-content">
				<div class="grve-modal-item">
					<?php blade_grve_print_language_modal_selector(); ?>
				</div>
			</div>
		</div>
	</div>
<?php

}

function blade_grve_print_social_modal() {

	$header_menu_options = blade_grve_option('header_menu_options');
	$header_menu_social_mode = blade_grve_option('header_menu_social_mode', 'modal');
	$show_social_modal = false;

	if ( !empty( $header_menu_options ) ) {
		if ( isset( $header_menu_options['social'] ) && !empty( $header_menu_options['social'] ) && '0' != $header_menu_options['social'] ) {
			if( 'modal' == $header_menu_social_mode ) {
				$show_social_modal = true;
			}
		}
	}


	if( $show_social_modal ) {
		global $blade_grve_social_list;

?>
	<div id="grve-socials-modal" class="grve-modal">
		<div class="grve-modal-wrapper">
			<div class="grve-modal-content grve-align-center">
				<div class="grve-modal-item">
		<?php
				$header_social_options = blade_grve_option('header_menu_social_options');
				$social_options = blade_grve_option('social_options');

					if ( !empty( $header_social_options ) && !empty( $social_options ) ) {
		?>
					<ul class="grve-social-texts grve-link-text">
		<?php

						foreach ( $social_options as $key => $value ) {
							if ( isset( $header_social_options[$key] ) && 1 == $header_social_options[$key] && $value ) {
								if ( 'skype' == $key ) {
									echo '<li><a href="' . esc_url( $value, array( 'skype', 'http', 'https' ) ) . '"><span>' . esc_html( $blade_grve_social_list[$key] ) . '</span></a></li>';
								} else {
									echo '<li><a href="' . esc_url( $value ) . '" target="_blank"><span>' . esc_html( $blade_grve_social_list[$key] ) . '</span></a></li>';
								}
							}
						}
		?>
					</ul>
		<?php
					}

		?>
				</div>
			</div>
		</div>
	</div>
<?php
	}
}

/**
 * Gets side area data
 */
function blade_grve_get_sidearea_data() {

	$grve_sidebar_visibility = 'no';
	$grve_sidebar_id = '';

	if ( ! is_singular() ) {
		//Overview Pages
		if( blade_grve_woocommerce_enabled() && is_woocommerce() ) {
			if ( is_shop() && !is_search() ) {
				$grve_sidebar_visibility =  blade_grve_post_meta_shop( 'grve_sidearea_visibility', blade_grve_option( 'page_sidearea_visibility' ) );
				$grve_sidebar_id = blade_grve_post_meta_shop( 'grve_sidearea_sidebar', blade_grve_option( 'page_sidearea_sidebar' ) );
			} else {
				$grve_sidebar_visibility = blade_grve_option( 'product_tax_sidearea_visibility' );
				$grve_sidebar_id = blade_grve_option( 'product_tax_sidearea_sidebar' );
			}
		} else {
			$grve_sidebar_visibility = blade_grve_option( 'blog_sidearea_visibility' );
			$grve_sidebar_id = blade_grve_option( 'blog_sidearea_sidebar' );
		}
	} else {

		global $post;
		$post_id = $post->ID;
		$post_type = get_post_type( $post_id );

		switch( $post_type ) {
			case 'product':
				$grve_sidebar_visibility =  blade_grve_post_meta( 'grve_sidearea_visibility', blade_grve_option( 'product_sidearea_visibility' ) );
				$grve_sidebar_id = blade_grve_post_meta( 'grve_sidearea_sidebar', blade_grve_option( 'product_sidearea_sidebar' ) );
			break;
			case 'portfolio':
				$grve_sidebar_visibility =  blade_grve_post_meta( 'grve_sidearea_visibility', blade_grve_option( 'portfolio_sidearea_visibility' ) );
				$grve_sidebar_id = blade_grve_post_meta( 'grve_sidearea_sidebar', blade_grve_option( 'portfolio_sidearea_sidebar' ) );
			break;
			case 'post':
				$grve_sidebar_visibility =  blade_grve_post_meta( 'grve_sidearea_visibility', blade_grve_option( 'post_sidearea_visibility' ) );
				$grve_sidebar_id = blade_grve_post_meta( 'grve_sidearea_sidebar', blade_grve_option( 'post_sidearea_sidebar' ) );
			break;
			case 'page':
			default:
				$grve_sidebar_visibility =  blade_grve_post_meta( 'grve_sidearea_visibility', blade_grve_option( 'page_sidearea_visibility' ) );
				$grve_sidebar_id = blade_grve_post_meta( 'grve_sidearea_sidebar', blade_grve_option( 'page_sidearea_sidebar' ) );
			break;
		}
	}

	return array(
		'visibility' => $grve_sidebar_visibility,
		'sidebar' => $grve_sidebar_id,
	);
}

/**
 * Prints header side area toggle button
 */
function blade_grve_print_header_sidearea_button( $sidearea_data, $mode = '' ) {

	$grve_sidebar_visibility = $sidearea_data['visibility'];
	$grve_sidebar_id = $sidearea_data['sidebar'];

	if ( 'yes' == $grve_sidebar_visibility ) {
		if ( 'list' == $mode ) {
?>
		<li class="grve-header-element">
			<a href="#grve-sidearea" class="grve-sidearea-btn grve-toggle-hiddenarea">
				<span class="grve-item"><i class="grve-icon-bullets-v"></i></span>
			</a>
		</li>
<?php
		} else {
?>
		<div class="grve-header-elements grve-position-left">
			<div class="grve-wrapper">
				<ul>
					<li class="grve-header-element">
						<a href="#grve-sidearea" class="grve-sidearea-btn grve-toggle-hiddenarea">
							<span class="grve-item"><i class="grve-icon-bullets-v"></i></span>
						</a>
					</li>
				</ul>
			</div>
		</div>
<?php
		}
	}
}

/**
 * Prints header hidden area toggle button
 */
function blade_grve_print_header_hiddenarea_button() {
	$grve_responsive_menu_selection = blade_grve_option( 'menu_responsive_toggle_selection', 'icon' );
	$grve_responsive_menu_text = blade_grve_option( 'menu_responsive_toggle_text');
?>
	<div class="grve-hidden-menu-btn grve-position-right">
		<div class="grve-header-element">
			<a href="#grve-hidden-menu" class="grve-toggle-hiddenarea">
				<span class="grve-item">
					<?php if ( 'icon' == $grve_responsive_menu_selection ) { ?>
					<i class="grve-icon-menu"></i>
					<?php } else {?>
					<span class="grve-label"><?php echo esc_html( $grve_responsive_menu_text ); ?></span>
					<?php } ?>
				</span>
			</a>
		</div>
	</div>
<?php

}

/**
 * Prints Side Area
 */
function blade_grve_print_side_area( $sidearea_data ) {

	$grve_sidebar_visibility = $sidearea_data['visibility'];
	$grve_sidebar_id = $sidearea_data['sidebar'];

	if ( 'yes' == $grve_sidebar_visibility ) {
?>
	<aside id="grve-sidearea" class="grve-hidden-area">
		<div class="grve-hiddenarea-wrapper">
			<!-- Close Button -->
			<div class="grve-close-btn-wrapper">
				<div class="grve-close-btn grve-close-arrow"><span></span></div>
			</div>
			<!-- End Close Button -->
			<div class="grve-hiddenarea-content">
				<?php
					if( is_active_sidebar( $grve_sidebar_id ) ) {
						dynamic_sidebar( $grve_sidebar_id );
					} else {
						if( current_user_can( 'administrator' ) ) {
							echo esc_html__( 'No widgets found in Side Area!', 'blade'  ) . "<br/>" .
							"<a href='" . admin_url() . "widgets.php'>" .
							esc_html__( "Activate Widgets", 'blade' ) .
							"</a>";
						}
					}
				?>
			</div>

		</div>
	</aside>
<?php
	}
}


/**
 * Prints Shop Cart Responsive link
 */
function blade_grve_print_cart_responsive_link() {

	if ( blade_grve_woocommerce_enabled() && blade_grve_check_header_elements_visibility( 'cart' ) ) {

		global $woocommerce;
?>
		<div class="grve-header-elements grve-position-right">
			<div class="grve-wrapper">
				<ul>
					<li class="grve-header-element">
						<a href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>">
							<span class="grve-item">
								<i class="grve-icon-cart"></i>
							</span>
						</a>
						<span class="grve-purchased-items"><?php echo esc_html( $woocommerce->cart->cart_contents_count ); ?></span>
					</li>
				</ul>
			</div>
		</div>

<?php

	}
}

/**
 * Prints Shop Cart
 */
function blade_grve_print_cart_area() {

	if ( blade_grve_woocommerce_enabled() && blade_grve_check_header_elements_visibility( 'cart' ) ) {

?>

		<div id="grve-cart-area" class="grve-hidden-area">
			<div class="grve-hiddenarea-wrapper">
				<!-- Close Button -->
				<div class="grve-close-btn-wrapper">
					<div class="grve-close-btn grve-close-arrow"><span></span></div>
				</div>
				<!-- End Close Button -->
				<div class="grve-hiddenarea-content">
					<div class="grve-shopping-cart-content"></div>
				</div>
			</div>
		</div>

<?php
	}

}

/**
 * Prints Hidden Menu
 */
function blade_grve_print_hidden_menu() {

	$grve_menu_open_type = blade_grve_option( 'menu_responsive_open_type', 'toggle' );
	$grve_hidden_menu_align = blade_grve_option( 'menu_responsive_align', 'left' );

	$grve_hidden_menu_classes = array( 'grve-hidden-area' );
	$grve_hidden_menu_classes[] = 'grve-' . $grve_menu_open_type . '-menu';
	$grve_hidden_menu_classes[] = 'grve-align-' . $grve_hidden_menu_align;

	$grve_hidden_menu_class_string = implode( ' ', $grve_hidden_menu_classes );

?>
	<nav id="grve-hidden-menu" class="<?php echo esc_attr( $grve_hidden_menu_class_string ); ?>">
		<div class="grve-hiddenarea-wrapper">
			<!-- Close Button -->
			<div class="grve-close-btn-wrapper">
				<div class="grve-close-btn grve-close-arrow"><span></span></div>
			</div>
			<!-- End Close Button -->
			<div class="grve-hiddenarea-content">
				<div class="grve-menu-wrapper">
					<?php
						$grve_main_menu = blade_grve_get_header_nav();
						if ( $grve_main_menu != 'disabled' ) {
							blade_grve_header_nav( $grve_main_menu );
						}
					?>
				</div>
				<?php blade_grve_print_header_elements_responsive(); ?>
			</div>

		</div>
	</nav>
<?php

}

function blade_grve_print_item_nav_link( $post_id,  $direction, $title = '' ) {

	$icon_class = 'arrow-right';
	if ( 'prev' == $direction ) {
		$icon_class = 'arrow-left';
	}
?>
	<li><a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>" class="grve-icon-<?php echo esc_attr( $icon_class ); ?>" title="<?php echo esc_attr($title); ?>"></a></li>
<?php
}


/**
 * Check Theme Loader Visibility
 */
function blade_grve_check_theme_loader_visibility() {

	$grve_theme_loader = '';

	if ( is_singular() ) {
		$grve_theme_loader = blade_grve_post_meta( 'grve_theme_loader' );
	}
	if ( blade_grve_is_woo_shop() ) {
		$grve_theme_loader = blade_grve_post_meta_shop( 'grve_theme_loader' );
	}

	if( empty( $grve_theme_loader ) ) {
		return blade_grve_visibility( 'theme_loader' );
	} else {
		if ( 'yes' == $grve_theme_loader ) {
			return true;
		} else {
			return false;
		}
	}

}

/**
 * Prints Tracking code
 */
add_action('wp_head', 'blade_grve_print_tracking_code');
if ( !function_exists('blade_grve_print_tracking_code') ) {

	function blade_grve_print_tracking_code() {
		$tracking_code = blade_grve_option( 'tracking_code' );
		if ( !empty( $tracking_code ) ) {
			echo "" . $tracking_code;
		}
	}
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
