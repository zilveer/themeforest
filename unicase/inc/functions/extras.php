<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package unicase
 */

if ( ! function_exists( 'is_unicase_customizer_enabled' ) ) {
	/**
	 * Check whether the Unicase Customizer settings ar enabled
	 * @return boolean
	 * @since  1.0.0
	 */
	function is_unicase_customizer_enabled() {
		return apply_filters( 'unicase_customizer_enabled', true );
	}
}

if ( ! function_exists( 'unicase_page_menu_args' ) ) {
	/**
	 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
	 *
	 * @param array $args Configuration arguments.
	 * @return array
	 */
	function unicase_page_menu_args( $args ) {
		$args['show_home'] = true;
		return $args;
	}
}

if ( ! function_exists( 'unicase_body_classes' ) ) {
	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 * @return array
	 */
	function unicase_body_classes( $classes ) {
		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}

		if ( ! function_exists( 'woocommerce_breadcrumb' ) ) {
			$classes[]	= 'no-wc-breadcrumb';
		}

		/**
		 * What is this?!
		 * Take the blue pill, close this file and forget you saw the following code.
		 * Or take the red pill, filter unicase_make_me_cute and see how deep the rabbit hole goes...
		 */
		$cute	= apply_filters( 'unicase_make_me_cute', false );

		if ( true === $cute ) {
			$classes[] = 'unicase-cute';
		}

		$layout_args = unicase_get_page_layout_args();

		if( isset( $layout_args['layout_name'] ) ) {
			$classes[] = $layout_args['layout_name'];
		}

		if( isset( $layout_args['body_class'] ) ) {
			$classes[] = $layout_args['body_class'];
		}

		if( apply_filters( 'unicase_enable_echo', TRUE ) ) {
			$classes[] = 'echo-enabled';
		}

		$classes[] = apply_filters( 'unicase_layout_style', 'stretched' );

		return $classes;
	}
}

/**
 * Query WooCommerce activation
 */
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated() {
		return class_exists( 'WooCommerce' ) ? true : false;
	}
}

if ( ! function_exists( 'is_dokan_activated' ) ) {
	function is_dokan_activated() {
		return class_exists( 'WeDevs_Dokan' ) ? true : false;
	}
}

if( ! function_exists( 'is_vc_activated' ) ) {
	function is_vc_activated() {
		return class_exists( 'WPBakeryVisualComposerAbstract' ) ? TRUE : FALSE;
	}
}

if( ! function_exists( 'is_revslider_activated' ) ) {
	function is_revslider_activated() {
		return class_exists( 'RevSlider' ) ? TRUE : FALSE ;
	}
}

if( ! function_exists( 'is_extensions_activated' ) ) {
	function is_extensions_activated() {
		return class_exists( 'Unicase_Extensions' ) ? TRUE : FALSE;
	}
}

if( ! function_exists( 'is_redux_activated' ) ) {
	function is_redux_activated() {
		return class_exists( 'ReduxFrameworkPlugin' ) ? TRUE : FALSE;
	}	
}

if( ! function_exists( 'is_wpml_activated' ) ) {
	function is_wpml_activated() {
		return function_exists('icl_object_id') ? TRUE : FALSE;
	}
}

if ( ! function_exists( 'unicase_html_tag_schema' ) ) {
	/**
	 * Schema type
	 * @return string schema itemprop type
	 */
	function unicase_html_tag_schema() {
		$schema 	= 'http://schema.org/';
		$type 		= 'WebPage';

		// Is single post
		if ( is_singular( 'post' ) ) {
			$type 	= 'Article';
		}

		// Is author page
		elseif ( is_author() ) {
			$type 	= 'ProfilePage';
		}

		// Is search results page
		elseif ( is_search() ) {
			$type 	= 'SearchResultsPage';
		}

		echo 'itemscope="itemscope" itemtype="' . esc_attr( $schema ) . esc_attr( $type ) . '"';
	}
}

if ( ! function_exists( 'unicase_categorized_blog' ) ) {
	/**
	 * Returns true if a blog has more than 1 category.
	 *
	 * @return bool
	 */
	function unicase_categorized_blog() {
		if ( false === ( $all_the_cool_cats = get_transient( 'unicase_categories' ) ) ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories( array(
				'fields'     => 'ids',
				'hide_empty' => 1,

				// We only need to know if there is more than one category.
				'number'     => 2,
			) );

			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( 'unicase_categories', $all_the_cool_cats );
		}

		if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so unicase_categorized_blog should return true.
			return true;
		} else {
			// This blog has only 1 category so unicase_categorized_blog should return false.
			return false;
		}
	}
}

if ( ! function_exists( 'unicase_category_transient_flusher' ) ) {
	/**
	 * Flush out the transients used in unicase_categorized_blog.
	 */
	function unicase_category_transient_flusher() {
		// Like, beat it. Dig?
		delete_transient( 'unicase_categories' );
	}
}

add_action( 'edit_category', 'unicase_category_transient_flusher' );
add_action( 'save_post',     'unicase_category_transient_flusher' );

if ( ! function_exists( 'unicase_default_blog_widgets' ) ) {
	function unicase_default_blog_widgets() {
		$widget_args = array(
			'before_widget' => '<aside class="widget">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
			'widget_id'     => '',
		);

		$widget_args['widget_id'] = 'search-2';
		$widget_args['before_widget'] = '<aside class="widget widget_search">';
		the_widget( 'WP_Widget_Search', array( 'title' => esc_html__('Search', 'unicase' ) ), $widget_args );

		$widget_args['widget_id'] = 'recent-posts-1';
		$widget_args['before_widget'] = '<aside class="widget widget_recent_entries">';
		the_widget( 'WP_Widget_Recent_Posts', array( 'title' => esc_html__('Recent Posts', 'unicase' ) ), $widget_args );

		$widget_args['widget_id'] = 'rrecent-comments-1';
		$widget_args['before_widget'] = '<aside class="widget widget_recent_comments">';
		the_widget( 'WP_Widget_Recent_Comments', array( 'title' => esc_html__('Recent Comments', 'unicase' ) ), $widget_args );

		$widget_args['widget_id'] = 'categories-1';
		$widget_args['before_widget'] = '<aside class="widget widget_categories">';
		the_widget( 'WP_Widget_Categories', array( 'title' => esc_html__('Categories', 'unicase' ) ), $widget_args );

		$widget_args['widget_id'] = 'meta-1';
		$widget_args['before_widget'] = '<aside class="widget widget_meta">';
		the_widget( 'WP_Widget_Meta', array( 'title' => esc_html__('Meta', 'unicase' ) ), $widget_args );
	}
}

if ( ! function_exists( 'unicase_default_homepage_widgets' ) ) {
	function unicase_default_homepage_widgets(){
		$widget_args = array(
			'before_widget' => '<aside class="widget">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
			'widget_id'     => '',
		);

		$widget_args['widget_id'] = 'unicase_nav_menu-1';
		$widget_args['before_widget'] = '<aside class="widget widget_unicase_nav_menu">';
		the_widget( 'UC_WP_Nav_Menu_Widget', array( 'title' => esc_html__('Categories', 'unicase' ), 'icon_class' => 'fa fa-align-justify', 'display_type' => 'type-1', 'nav_menu' => 'vertical-menu' ), $widget_args );

		$widget_args['widget_id'] = 'woocommerce_products-1';
		$widget_args['before_widget'] = '<aside class="widget woocommerce widget_products">';
		the_widget( 'WC_Widget_Products', array( 'title' => __( 'Special Products', 'unicase' ), 'show' => 'featured', 'number' => '3', 'orderby' => 'DESC', 'order' => 'date', 'id' => 'featured-products-footer' ), $widget_args );

		$widget_args['widget_id'] = 'woocommerce_products-2';
		$widget_args['before_widget'] = '<aside class="widget woocommerce widget_products">';
		the_widget( 'WC_Widget_Products', array( 'title' => __( 'Sale Products', 'unicase' ), 'show' => 'onsale', 'number' => '3', 'orderby' => 'DESC', 'order' => 'date', 'id' => 'onsale-products-footer' ), $widget_args );
		
		$widget_args['widget_id'] = 'widget_products_carousel-1';
		$widget_args['before_widget'] = '<aside class="widget unicase widget_products_carousel">';
		the_widget( 'UC_Widget_Products_Carousel', array( 'title' => __( 'Hot Deals', 'unicase' ), 'number' => '5', 'show' => 'onsale' ), $widget_args );
	}
}

if( is_woocommerce_activated() ) {
	if ( ! function_exists( 'unicase_default_product_filter_widgets' ) ) {
		function unicase_default_product_filter_widgets() {
			$widget_args = array(
				'before_widget' => '<aside class="widget">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
				'widget_id'     => '',
			);

			$widget_args['widget_id'] = 'woocommerce_product_categories-1';
			$widget_args['before_widget'] = '<aside class="woocommerce widget_product_categories">';
			the_widget( 'WC_Widget_Product_Categories', array( 'title' => esc_html__('Categories', 'unicase' ), 'orderby' => 'name', 'hierarchical' => 1 ), $widget_args );

			$widget_args['widget_id'] = 'woocommerce_price_filter-1';
			$widget_args['before_widget'] = '<aside class="widget woocommerce widget_price_filter">';
			the_widget( 'WC_Widget_Price_Filter', array( 'title' => esc_html__('Filter by Price', 'unicase' ) ), $widget_args );

			$widget_args['widget_id'] = 'woocommerce_layered_nav_filters-1';
			$widget_args['before_widget'] = '<aside class="widget woocommerce widget_layered_nav">';
			the_widget( 'WC_Widget_Layered_Nav', array( 'title' => esc_html__('Active Filters', 'unicase' ) ), $widget_args );
		}
	}

	if ( ! function_exists( 'unicase_default_shop_widgets' ) ) {
		function unicase_default_shop_widgets() {
			$widget_args = array(
				'before_widget' => '<aside class="widget">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
				'widget_id'     => '',
			);

			$widget_args['widget_id'] = 'unicase_products_filter-1';
			$widget_args['before_widget'] = '<aside class="widget widget_unicase_products_filter">';
			the_widget( 'UC_Products_Filter_Widget', array( 'title' => esc_html__('Filter By', 'unicase' ), 'sidebar' => 'product-filters-1' ), $widget_args );

			$widget_args['widget_id'] = 'woocommerce_products-1';
			$widget_args['before_widget'] = '<aside class="widget woocommerce widget_products">';
			the_widget( 'WC_Widget_Products', array( 'title' => __( 'Featured Products', 'unicase' ), 'show' => 'featured', 'number' => '3', 'orderby' => 'DESC', 'order' => 'date', 'id' => 'featured-products-footer' ), $widget_args );

			$widget_args['widget_id'] = 'woocommerce_products-2';
			$widget_args['before_widget'] = '<aside class="widget woocommerce widget_products">';
			the_widget( 'WC_Widget_Products', array( 'title' => __( 'Special Products', 'unicase' ), 'show' => 'onsale', 'number' => '3', 'orderby' => 'DESC', 'order' => 'date', 'id' => 'onsale-products-footer' ), $widget_args );

			$widget_args['widget_id'] = 'widget_products_carousel-1';
			$widget_args['before_widget'] = '<aside class="widget unicase widget_products_carousel">';
			the_widget( 'UC_Widget_Products_Carousel', array( 'title' => __( 'Hot Deals', 'unicase' ), 'number' => '5', 'show' => 'onsale' ), $widget_args );
		}
	}
}