<?php
/************************************************************************
* Admin Functions/Filters
*************************************************************************/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Adds Woocommerce to themeoptions panel
if ( !function_exists( 'woo_admin_panel_section' ) ) {
	function woo_admin_panel_section( $sections ) {
		//$sections = array();
		$sections[] = array(
			'title' => __( 'WooCommerce', 'ninezeroseven' ),
			'desc' => __( 'Settings for Woocommerce, change how many displayed and more. :)', 'ninezeroseven' ),
			'icon' => 'el-icon-shopping-cart',
			// Leave this as a blank section, no options just some intro text set above.
			'fields' => array(
				array(
					'id'        => 'opts-shop-layout',
					'type'      => 'image_select',
					'title'     => __( 'Single Page Layout', 'ninezeroseven' ),
					'subtitle'  => __( 'Layout for single shop pages', 'ninezeroseven' ),

					//Must provide key => value(array:title|img) pairs for radio options
					'options'   => array(
						'no-sidebar' => array( 'alt' => 'Full Width',        'img' => get_template_directory_uri() . '/includes/admin/assets/img/1col.png' ),
						'sidebar-left' => array( 'alt' => 'Left Sidebar',   'img' => get_template_directory_uri() . '/includes/admin/assets/img/2cl.png' ),
						'default' => array( 'alt' => 'Right Sidebar',  'img' => get_template_directory_uri() . '/includes/admin/assets/img/2cr.png' ),
					),
					'default' => 'default'
				),
				array(
					'id'        => 'opts-shop-count',
					'type'      => 'slider',
					'title'     => __( 'Shop Count', 'ninezeroseven' ),
					'subtitle'  => __( 'How many to display on shop page', 'ninezeroseven' ),
					// 'desc'      => __('Slider description. Min: 1, max: 500, step: 1, default value: 250', 'ninezeroseven'),
					"default"   => 10,
					"min"       => 2,
					"step"      => 1,
					"max"       => 100,
					'display_value' => 'label'
				),
				array(
					'id'        => 'opts-shop-columns',
					'type'      => 'slider',
					'title'     => __( 'Shop Columns', 'ninezeroseven' ),
					'subtitle'  => __( 'Changes how many displayed per row', 'ninezeroseven' ),
					// 'desc'      => __('Slider description. Min: 1, max: 500, step: 1, default value: 250', 'ninezeroseven'),
					"default"   => 3,
					"min"       => 2,
					"step"      => 1,
					"max"       => 5,
					'display_value' => 'label'
				),

				/************************************************************************
				* Related
				*************************************************************************/
				array(
					'id'        => 'opts-related-count',
					'type'      => 'slider',
					'title'     => __( 'Related Count', 'ninezeroseven' ),
					'subtitle'  => __( 'How many related items to show', 'ninezeroseven' ),
					// 'desc'      => __('Slider description. Min: 1, max: 500, step: 1, default value: 250', 'ninezeroseven'),
					"default"   => 3,
					"min"       => 1,
					"step"      => 1,
					"max"       => 20,
					'display_value' => 'label'
				),
				array(
					'id'        => 'opts-related-columns',
					'type'      => 'slider',
					'title'     => __( 'Related Columns', 'ninezeroseven' ),
					'subtitle'  => __( 'How many displayed per row', 'ninezeroseven' ),
					// 'desc'      => __('Slider description. Min: 1, max: 500, step: 1, default value: 250', 'ninezeroseven'),
					"default"   => 3,
					"min"       => 2,
					"step"      => 1,
					"max"       => 5,
					'display_value' => 'label'
				),
				/************************************************************************
				* Upsell
				*************************************************************************/
				array(
					'id'        => 'opts-upsell-count',
					'type'      => 'slider',
					'title'     => __( 'Upsell Count', 'ninezeroseven' ),
					'subtitle'  => __( 'How many upsell items to show', 'ninezeroseven' ),
					// 'desc'      => __('Slider description. Min: 1, max: 500, step: 1, default value: 250', 'ninezeroseven'),
					"default"   => 3,
					"min"       => 1,
					"step"      => 1,
					"max"       => 20,
					'display_value' => 'label'
				),
				array(
					'id'        => 'opts-upsell-columns',
					'type'      => 'slider',
					'title'     => __( 'Upsell Columns', 'ninezeroseven' ),
					'subtitle'  => __( 'How many displayed per row', 'ninezeroseven' ),
					// 'desc'      => __('Slider description. Min: 1, max: 500, step: 1, default value: 250', 'ninezeroseven'),
					"default"   => 3,
					"min"       => 2,
					"step"      => 1,
					"max"       => 5,
					'display_value' => 'label'
				),

			)
		);
		return $sections;
	}
	add_filter( 'redux/options/wbc907_data/sections', 'woo_admin_panel_section' );
}


/************************************************************************
* Meta Boxes
*************************************************************************/

if ( !function_exists( 'wbc_shop_meta_boxes' ) ) {

	function wbc_shop_meta_boxes( $metaboxes ) {

		$boxSections = array();
		$boxSections[] = array(
			//'title' => __('Home Settings', 'ninezeroseven'),
			//'desc' => __('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'ninezeroseven'),
			'icon_class' => 'icon-large',
			'icon' => 'el-icon-home',
			'fields' => array(
				array(

					'id'        => 'opts-shop-layout',
					'type'      => 'image_select',
					'title'     => __( 'Page Layout', 'ninezeroseven' ),
					'options'   => array(
						'no-sidebar'   => array( 'alt' => 'Full Width',     'img' => get_template_directory_uri() . '/includes/admin/options/configs/img/1col.png' ),
						'sidebar-left' => array( 'alt' => 'Left Sidebar',   'img' => get_template_directory_uri() . '/includes/admin/options/configs/img/2cl.png' ),
						'default'      => array( 'alt' => 'Right Sidebar',  'img' => get_template_directory_uri() . '/includes/admin/options/configs/img/2cr.png' ),
					)
				),
				array(
					'id'       => 'opts-single-shop-sidebar',
					'title'    => __( 'Sidebar', 'ninezeroseven' ),
					'desc'     => __( 'You can create additional sidebars under Appearance > Widgets.', 'ninezeroseven' ),
					'type'     => 'select',
					'data'     => 'sidebars',
					'required' => array( 'opts-shop-layout', '=', array( 'sidebar-left', 'default' ) )
				),
				array(
					'id'       => 'opts-page-menu-override',
					'title'    => __( 'Main Menu', 'ninezeroseven' ),
					'desc'     => __( 'You can create additional menus under Appearance > Menus.', 'ninezeroseven' ),
					'type'     => 'select',
					'data'     => 'menus',
				),

			)
		);

		$metaboxes[] = array(
			'id'            => 'wbc-shop-options',
			'title'         => __( 'Page Options', 'ninezeroseven' ),
			'post_types'    => array( 'product' ),
			//'page_template' => array('page-test.php'),
			//'post_format'   => array('image'),
			'position'      => 'side', // normal, advanced, side
			'priority'      => 'core', // high, core, default, low
			'sections'      => $boxSections
		);

		return $metaboxes;
	}
	// add_filter( 'wbc_theme_meta_boxes', 'wbc_shop_meta_boxes' );
}




/************************************************************************
* Filters/Actions
*************************************************************************/
// Change Shop Count
if ( !function_exists( 'wbc_shop_count_option' ) ) {

	function wbc_shop_count_option( $count = '' ) {
		$wbc_option = get_option( 'wbc907_data' );

		if ( isset( $wbc_option['opts-shop-count'] ) && is_numeric( $wbc_option['opts-shop-count'] ) )
			return $wbc_option['opts-shop-count'];

		return $count;
	}
	add_filter( 'wbc_shop_page_loop_count', 'wbc_shop_count_option' );
}
// Change Shop Columns
if ( !function_exists( 'wbc_shop_column_option' ) ) {

	function wbc_shop_column_option( $cols = '' ) {
		$wbc_option = get_option( 'wbc907_data' );

		if ( isset( $wbc_option['opts-shop-columns'] ) && is_numeric( $wbc_option['opts-shop-columns'] ) )
			return $wbc_option['opts-shop-columns'];

		return $cols;
	}
	add_filter( 'wbc_shop_page_columns', 'wbc_shop_column_option' );
}

// Change Related Count
if ( !function_exists( 'wbc_related_count_option' ) ) {

	function wbc_related_count_option( $count = '' ) {
		$wbc_option = get_option( 'wbc907_data' );

		if ( isset( $wbc_option['opts-related-count'] ) && is_numeric( $wbc_option['opts-related-count'] ) )
			return $wbc_option['opts-related-count'];

		return $count;
	}
	add_filter( 'wbc_related_item_count', 'wbc_related_count_option' );
}
// Change Related Columns
if ( !function_exists( 'wbc_related_column_option' ) ) {

	function wbc_related_column_option( $cols = '' ) {
		$wbc_option = get_option( 'wbc907_data' );

		if ( isset( $wbc_option['opts-related-columns'] ) && is_numeric( $wbc_option['opts-related-columns'] ) )
			return $wbc_option['opts-related-columns'];

		return $cols;
	}
	add_filter( 'wbc_related_column_count', 'wbc_related_column_option' );
}

// Change Upsell Count
if ( !function_exists( 'wbc_upsell_count_option' ) ) {

	function wbc_upsell_count_option( $count = '' ) {
		$wbc_option = get_option( 'wbc907_data' );

		if ( isset( $wbc_option['opts-upsell-count'] ) && is_numeric( $wbc_option['opts-upsell-count'] ) )
			return $wbc_option['opts-upsell-count'];

		return $count;
	}
	add_filter( 'wbc_upsell_item_count', 'wbc_upsell_count_option' );
}
// Change Upsell Columns
if ( !function_exists( 'wbc_upsell_column_option' ) ) {

	function wbc_upsell_column_option( $cols = '' ) {
		$wbc_option = get_option( 'wbc907_data' );

		if ( isset( $wbc_option['opts-upsell-columns'] ) && is_numeric( $wbc_option['opts-upsell-columns'] ) )
			return $wbc_option['opts-upsell-columns'];

		return $cols;
	}
	add_filter( 'wbc_upsell_column_count', 'wbc_upsell_column_option' );
}

/************************************************************************
* Color Filters
*************************************************************************/

if ( !function_exists( 'wbc_shop_primary_colors' ) ) {

	function wbc_shop_primary_colors( $colors ) {

		$new_css = array(
			'background-color' => '.woocommerce span.onsale,.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button',
			'border-color' => '.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button',
			'color' => '.woocommerce .woocommerce-message:before',
			'border-left-color' => '.woocommerce .woocommerce-message'
		);

		return wbc_arrays_to_options( $new_css , $colors );
	}

	add_filter( 'opts-primary-color', 'wbc_shop_primary_colors' );

}

//Page Content colors
if ( !function_exists( 'wbc_shop_content_color' ) ) {
	function wbc_shop_content_color( $colors ) {

		$new_css = array(
			'background-color' => '.woocommerce ul.products li.product .wbc-shop-item-wrap, .woocommerce-page ul.products li.product .wbc-shop-item-wrap',
		);


		return wbc_arrays_to_options( $new_css , $colors );
	}

	add_filter( 'opts-page-content-color', 'wbc_shop_content_color' );
}


//Single Page Layout
if ( !function_exists( 'wbc_single_page_layout' ) ) {
	function wbc_single_page_layout( $layout ) {

		if ( is_product() && is_single() ) {
			$wbc_options = get_option( 'wbc907_data' );

			if ( isset( $wbc_options['opts-shop-layout'] ) && !empty( $wbc_options['opts-shop-layout'] ) ) {
				switch ( $wbc_options['opts-shop-layout'] ) {
				case 'sidebar-left':
					$layout = 'template-page-left.php';
					break;

				case 'no-sidebar':
					$layout = 'default';
					break;

				default:
					$layout = 'right';
					break;
				}
			}
		}


		return $layout;
	}

	add_filter( 'wbc_shop_page_layout', 'wbc_single_page_layout' );
}

//Add Reusable Field support
if ( !function_exists( 'wbc_reuseable_shop_support' ) ) {

	function wbc_reuseable_shop_support( $post_types ) {

		$post_types[] = 'product';

		return $post_types;
	}
	add_filter( 'wbc_reuseable_support', 'wbc_reuseable_shop_support' );
}


if ( !function_exists( 'wbc_shop_reuseables' ) ) {

	function wbc_shop_reuseables( $post_id ) {

		if ( is_woocommerce() ) {

			if ( is_product() && is_single() ) {
				return get_the_id();
			}elseif ( is_shop() || is_product_category() || is_product_tag() ) {
				return wc_get_page_id( 'shop' );
			}
		}

		return $post_id;

	}

	add_filter( 'wbc_reuseable_before_id', 'wbc_shop_reuseables' );
	add_filter( 'wbc_reuseable_after_id', 'wbc_shop_reuseables' );

}
if ( !function_exists( 'wbc_shop_supports_reuseables' ) ) {
	function wbc_shop_supports_reuseables( $supports ) {

		if ( is_woocommerce() ) {

			if ( is_shop() || is_product_category() || is_product_tag() ) {
				return true;
			}
		}

		return $supports;
	}

	add_filter( 'wbc_reuseable_custom_post', 'wbc_shop_supports_reuseables' );
}
?>
