<?php

/**
 * WooCommerce options.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package THB WooCommerce
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * WooCommerce default skin.
 */
if ( ! function_exists( 'thb_woocommerce_skin' ) ) {
	function thb_woocommerce_skin() {
		if( thb_woocommerce_check() && thb_config( 'woocommerce', 'skin') ) {

			if ( version_compare( thb_get_woocommerce_version(), '2.1', '<' ) ) {
				define('WOOCOMMERCE_USE_CSS', false);
			} else {
				add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
			}

			thb_theme()->getFrontend()->addStyle( THB_TEMPLATE_URL . '/woocommerce/css/woocommerce.css', array(
				'deps' => array(),
				'name' => 'thb_woocommerce'
			));
		}
	}

	add_action( 'init', 'thb_woocommerce_skin' );
}

if ( ! function_exists( 'thb_woocommerce_options' ) ) {
	/**
	 * Main page WooCommerce options tab.
	 */
	function thb_woocommerce_options() {
		if( thb_woocommerce_check() && thb_config( 'woocommerce', 'options') ) {
			$thb_theme = thb_theme();
			$thb_page = $thb_theme->getAdmin()->getMainPage();

				$thb_tab = new THB_Tab( __('WooCommerce', 'thb_text_domain'), 'woocommerce' );
					$thb_container = $thb_tab->createContainer( __('General options', 'thb_text_domain'), 'woocommerce_general_options' );

					if ( thb_config( 'woocommerce', 'hide_cart_option') ) {
						$thb_field = new THB_CheckboxField( 'hide_cart' );
							$thb_field->setLabel( __( 'Hide cart icon in the menu', 'thb_text_domain' ) );
						$thb_container->addField($thb_field);
					}

					$thb_container = $thb_tab->createContainer( __('Shop & archive page options', 'thb_text_domain'), 'woocommerce_shop_options' );

					$thb_field = new THB_SelectField( 'shop_columns' );
						$thb_field->setLabel( __('Columns layout', 'thb_text_domain') );
						$thb_field->setOptions(array(
							'3' => '3',
							'4' => '4'
						));
					$thb_container->addField($thb_field);

					if ( thb_config( 'woocommerce', 'sidebar_shop') ) {
						$thb_field = new THB_SelectField( 'shop_sidebar' );
							$thb_field->setLabel( __('Shop page sidebar', 'thb_text_domain') );
							$thb_field->setHelp( __('Shop and Product archive page sidebar.', 'thb_text_domain') );
							$thb_field->setOptions(array(
								0 => __('No sidebar', 'thb_text_domain')
							));
							$thb_field->setOptions('thb_get_sidebars_for_select');
						$thb_container->addField($thb_field);

						$thb_field = new THB_SelectField( 'shop_sidebar_position' );
							$thb_field->setLabel( __('Shop page sidebar position', 'thb_text_domain') );
							$thb_field->setHelp( __('Shop and Product archive page sidebar position.', 'thb_text_domain') );
							$thb_field->setOptions(array(
								'sidebar-right' => __('Right', 'thb_text_domain'),
								'sidebar-left' => __('Left', 'thb_text_domain')
							));
						$thb_container->addField($thb_field);
					}

					$thb_field = new THB_NumberField('shop_products_per_page');
						$thb_field->setLabel( __('Products to show', 'thb_text_domain') );
						$thb_field->setHelp( __('Choose how many products will be displayed on Shop page.', 'thb_text_domain') );
					$thb_container->addField($thb_field);

					$thb_container = $thb_tab->createContainer( __('Product page options', 'thb_text_domain'), 'woocommerce_product_options' );

					$thb_field = new THB_NumberField('related_products_per_page');
						$thb_field->setLabel( __('Related product to show', 'thb_text_domain') );
						$thb_field->setHelp( __('Choose how many related posts will be displayed on single product page.', 'thb_text_domain') );
					$thb_container->addField($thb_field);

					if ( thb_config( 'woocommerce', 'sidebar_product') ) {
						$thb_field = new THB_SelectField( 'product_sidebar' );
							$thb_field->setLabel( __('Product page sidebar', 'thb_text_domain') );
							$thb_field->setOptions(array(
								0 => __('No sidebar', 'thb_text_domain')
							));
							$thb_field->setOptions('thb_get_sidebars_for_select');
						$thb_container->addField($thb_field);

						$thb_field = new THB_SelectField( 'product_sidebar_position' );
							$thb_field->setLabel( __('Product page sidebar position', 'thb_text_domain') );
							$thb_field->setOptions(array(
								'sidebar-right' => __('Right', 'thb_text_domain'),
								'sidebar-left' => __('Left', 'thb_text_domain')
							));
						$thb_container->addField($thb_field);
					}

				$thb_page->addTab($thb_tab);
		}
	}

	add_action( 'init', 'thb_woocommerce_options' );
}

if ( ! function_exists( 'thb_shop_columns_layout' ) ) {
	/**
	 * WooCommerce shop columns body classes.
	 *
	 * @return string
	 */
	function thb_shop_columns_layout( $classes ) {
		if( ! thb_woocommerce_check() ) {
			return $classes;
		}

		if( is_woocommerce() && ( is_shop() || is_tax() ) ) {
			$classes[] = 'thb-shop-' . thb_shop_loop_columns() .'col';
		}

		return $classes;
	}

	add_filter('body_class', 'thb_shop_columns_layout');
}

if ( ! function_exists( 'thb_shop_loop_columns' ) ) {
	/**
	 * Return WooCommerce loop columns number.
	 *
	 * @return string
	 */
	function thb_shop_loop_columns() {
		$shop_columns_default = '3';

		if( ! thb_woocommerce_check() ) {
			return $shop_columns_default;
		}

		if( is_woocommerce() && ( is_shop() || is_tax() ) ) {
			$shop_columns = thb_get_option('shop_columns');

			if( !empty($shop_columns) ) {
				return $shop_columns;
			}
		}

		return $shop_columns_default;
	}

	add_filter( 'loop_shop_columns', 'thb_shop_loop_columns' );
}

if ( ! function_exists( 'thb_shop_sidebar' ) ) {
	/**
	 * Return the class w-sidebar if sidebar is defined.
	 *
	 * @return array
	 */
	function thb_shop_sidebar( $classes ) {
		if( ! thb_woocommerce_check() ) {
			return $classes;
		}

		if( is_woocommerce() ) {
			foreach( $classes as $i => $class ) {
				if( $class == 'w-sidebar' ) {
					unset($classes[$i]);
				}
			}

			$classes[] = thb_get_shop_sidebar_position();
		}

		return $classes;
	}

	add_filter('body_class', 'thb_shop_sidebar', 99);
}

if ( ! function_exists( 'thb_get_shop_sidebar_position' ) ) {
	/**
	 * Return the Shop sidebar position.
	 *
	 * @return string
	 */
	function thb_get_shop_sidebar_position(  ) {
		if ( !thb_woocommerce_check() ) {
			return;
		}

		return thb_get_option( 'shop_sidebar_position' );
	}
}

if ( ! function_exists( 'thb_get_woocommerce_sidebar_name' ) ) {
	/**
	 * Return the WooCommerce sidebar name.
	 *
	 * @return string
	 */
	function thb_get_woocommerce_sidebar_name() {
		if ( !thb_woocommerce_check() ) {
			return;
		}

		$sidebar = '';

		if( is_product() ) {
			$sidebar = 'product_sidebar';
		}
		if( is_shop() || is_product_taxonomy() ) {
			$sidebar = 'shop_sidebar';
		}

		$sidebar_name = thb_get_option($sidebar);
		$sidebar_name = apply_filters( 'thb_get_woocommerce_sidebar_name', $sidebar_name );

		return $sidebar_name;
	}
}

if ( ! function_exists( 'thb_woocommerce_body_classes' ) ) {
	/**
	 * Return the sidebar position and visibility classes.
	 *
	 * @return string
	 */
	function thb_woocommerce_body_classes( $classes ) {
		if ( !thb_woocommerce_check() ) {
			return $classes;
		}

		if( is_woocommerce() ) {
			$sidebar_name = thb_get_woocommerce_sidebar_name();

			if( is_active_sidebar( $sidebar_name ) ) {
				$classes[] = 'w-sidebar';
				$classes[] = thb_get_option( $sidebar_name . '_position' );
			}
		}

		return $classes;
	}

	add_filter( 'body_class', 'thb_woocommerce_body_classes', 999 );
}

if ( ! function_exists( 'thb_replace_woocommerce_sidebar' ) ) {
	/**
	 * Replace the default sidebar with the THB sidebar
	 */
	function thb_replace_woocommerce_sidebar() {
		if ( !thb_woocommerce_check() ) {
			return;
		}

		function thb_woocommerce_sidebar( $sidebar ) {
			if ( is_woocommerce() ) {
				$sidebar = thb_get_woocommerce_sidebar_name();
			}

			return $sidebar;
		}

		remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
		add_filter( 'thb_page_sidebar', 'thb_woocommerce_sidebar' );
	}

	add_action( 'init', 'thb_replace_woocommerce_sidebar' );
}



if ( ! function_exists( 'thb_shop_products_per_page' ) ) {
	/**
	 * Return the shop items per page filter.
	 */
	function thb_shop_products_per_page( $posts_per_page ) {
		if ( !thb_woocommerce_check() ) {
			return $posts_per_page;
		}

		$option = thb_get_option('shop_products_per_page');
		if ( !empty( $option ) ) {
			$posts_per_page = $option;
		}

		return $posts_per_page;
	}

	add_filter( 'loop_shop_per_page', 'thb_shop_products_per_page', 20 );
}

if( !function_exists('thb_woocommerce_output_related_products') ) {
	/**
	 * Return the related items in single product
	 */
	function thb_woocommerce_output_related_products() {
		if ( !thb_woocommerce_check() ) {
			return;
		}

		$related_per_page = thb_get_option( 'related_products_per_page' );
		$related_columns = 4;

		if ( empty( $related_per_page ) ) {
			$related_per_page = 4;
		}

		if ( version_compare( thb_get_woocommerce_version(), '2.1', '<' ) ) {

			woocommerce_related_products( $related_per_page, $related_columns );

		} else {

			woocommerce_related_products(
				array(
					'columns' => $related_columns,
					'posts_per_page' => $related_per_page
				)
			);

		}
	}
}

/**
 * Upsell products
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product_summary', 'thb_upsell_display', 15);

if( !function_exists('thb_upsell_display') ) {
	function thb_upsell_display( $posts_per_page = '-1', $columns = 4, $orderby = 'rand' ) {
		woocommerce_get_template( 'single-product/up-sells.php', array(
			'posts_per_page'  => $posts_per_page,
			'orderby'    => $orderby,
			'columns'    => $columns
		));
	}
}


/**
 * Check demo store mode
 */
if ( ! function_exists( 'thb_woo_demostore_mode' ) ) {
	function thb_woo_demostore_mode( $classes ) {
		if( ! thb_woocommerce_check() ) {
			return $classes;
		}

		$demo_mode = get_option( 'woocommerce_demo_store' );

		if( $demo_mode == 'yes' ) {
			$classes[] = 'thb-demostore-mode';
		}

		return $classes;
	}

	add_filter( 'body_class', 'thb_woo_demostore_mode' );
}