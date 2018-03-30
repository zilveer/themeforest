<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package unicase
 */

if ( ! function_exists( 'unicase_product_categories' ) ) {
	/**
	 * Display Product Categories
	 * Hooked into the `homepage` action in the homepage template
	 * @since  1.0.0
	 * @return void
	 */
	function unicase_product_categories( $args ) {

		if ( is_woocommerce_activated() ) {

			$args = apply_filters( 'unicase_product_categories_args', array(
				'limit' 			=> 3,
				'columns' 			=> 3,
				'child_categories' 	=> 0,
				'orderby' 			=> 'name',
				'title'				=> esc_html__( 'Product Categories', 'unicase' ),
				) );

			echo '<section class="unicase-product-section unicase-product-categories">';

			echo '<h2 class="section-title">' . esc_attr( $args['title'] ) . '</h2>';
			echo do_shortcode( '[product_categories number="' . $args['limit'] . '" columns="' . $args['columns'] . '" orderby="' . $args['orderby'] . '" parent="' . $args['child_categories'] . '"]' );

			echo '</section>';

		}
	}
}

if ( ! function_exists( 'unicase_recent_products' ) ) {
	/**
	 * Display Recent Products
	 * Hooked into the `homepage` action in the homepage template
	 * @since  1.0.0
	 * @return void
	 */
	function unicase_recent_products( $args ) {

		if ( is_woocommerce_activated() ) {

			$args = apply_filters( 'unicase_recent_products_args', array(
				'limit' 			=> 4,
				'columns' 			=> 4,
				'title'				=> esc_html__( 'Recent Products', 'unicase' ),
				) );

			echo '<section class="unicase-product-section unicase-recent-products">';

			echo '<h2 class="section-title">' . esc_attr( $args['title'] ) . '</h2>';
			echo do_shortcode( '[recent_products per_page="' . intval( $args['limit'] ) . '" columns="' . intval( $args['columns'] ) . '"]' );

			echo '</section>';

		}
	}
}

if ( ! function_exists( 'unicase_featured_products' ) ) {
	/**
	 * Display Featured Products
	 * Hooked into the `homepage` action in the homepage template
	 * @since  1.0.0
	 * @return void
	 */
	function unicase_featured_products( $args ) {

		if ( is_woocommerce_activated() ) {

			$args = apply_filters( 'unicase_featured_products_args', array(
				'limit' 			=> 4,
				'columns' 			=> 4,
				'title'				=> esc_html__( 'Featured Products', 'unicase' ),
				) );

			echo '<section class="unicase-product-section unicase-featured-products">';

			echo '<h2 class="section-title">' . esc_attr( $args['title'] ) . '</h2>';
			echo do_shortcode( '[featured_products per_page="' . intval( $args['limit'] ) . '" columns="' . intval( $args['columns'] ) . '"]' );

			echo '</section>';

		}
	}
}

if ( ! function_exists( 'unicase_popular_products' ) ) {
	/**
	 * Display Popular Products
	 * Hooked into the `homepage` action in the homepage template
	 * @since  1.0.0
	 * @return void
	 */
	function unicase_popular_products( $args ) {

		if ( is_woocommerce_activated() ) {

			$args = apply_filters( 'unicase_popular_products_args', array(
				'limit' 			=> 4,
				'columns' 			=> 4,
				'title'				=> esc_html__( 'Top Rated Products', 'unicase' ),
				) );

			echo '<section class="unicase-product-section unicase-popular-products">';

			echo '<h2 class="section-title">' . esc_attr( $args['title'] ) . '</h2>';
			echo do_shortcode( '[top_rated_products per_page="' . intval( $args['limit'] ) . '" columns="' . intval( $args['columns'] ) . '"]' );

			echo '</section>';

		}
	}
}

if ( ! function_exists( 'unicase_on_sale_products' ) ) {
	/**
	 * Display On Sale Products
	 * Hooked into the `homepage` action in the homepage template
	 * @since  1.0.0
	 * @return void
	 */
	function unicase_on_sale_products( $args ) {

		if ( is_woocommerce_activated() ) {

			$args = apply_filters( 'unicase_on_sale_products_args', array(
				'limit' 			=> 4,
				'columns' 			=> 4,
				'title'				=> esc_html__( 'On Sale', 'unicase' ),
				) );

			echo '<section class="unicase-product-section unicase-on-sale-products">';

			echo '<h2 class="section-title">' . esc_attr( $args['title'] ) . '</h2>';
			echo do_shortcode( '[sale_products per_page="' . intval( $args['limit'] ) . '" columns="' . intval( $args['columns'] ) . '"]' );

			echo '</section>';

		}
	}
}

if ( ! function_exists( 'unicase_homepage_content' ) ) {
	/**
	 * Display homepage content
	 * Hooked into the `homepage` action in the homepage template
	 * @since  1.0.0
	 * @return  void
	 */
	function unicase_homepage_content() {
		while ( have_posts() ) : the_post();

			get_template_part( 'templates/contents/content', 'page' );

		endwhile; // end of the loop.
	}
}

if ( ! function_exists( 'unicase_social_icons' ) ) {
	/**
	 * Display social icons
	 * If the subscribe and connect plugin is active, display the icons.
	 * @link http://wordpress.org/plugins/subscribe-and-connect/
	 * @since 1.0.0
	 */
	function unicase_social_icons() {
		if ( class_exists( 'Subscribe_And_Connect' ) ) {
			echo '<div class="subscribe-and-connect-connect">';
			subscribe_and_connect_connect();
			echo '</div>';
		}
	}
}

if ( ! function_exists( 'unicase_get_sidebar' ) ) {
	/**
	 * Display unicase sidebar
	 * @uses get_sidebar()
	 * @since 1.0.0
	 */
	function unicase_get_sidebar() {
		
		$layout_args = unicase_get_page_layout_args();
		if( ! empty( $layout_args['sidebar'] ) ) {
			get_sidebar( $layout_args['sidebar'] );
		} else {
			get_sidebar();
		}
	}
}

if( ! function_exists( 'unicase_breadcrumb' ) ) {
	/**
	 * Display unicase breadcrumb
	 * @uses woocommerce_breadcrumb()
	 * @since 1.0.0
	 */
	function unicase_breadcrumb() {

		if( is_woocommerce_activated() && apply_filters( 'unicase_show_breadcrumb', TRUE ) ) {
			woocommerce_breadcrumb();
		}
	}
}

/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package unicase
 */

if ( ! function_exists( 'unicase_homepage_tabs' ) ) {
	/**
	 * Display product homepage tabs
	 * Hooked into the `homepage` action in the product homepage tabs
	 * @since  1.0.0
	 * @return  void
	 */
	function unicase_homepage_tabs( $tabs = array(), $product_items = 3, $product_columns = 3 ) {

		if( is_woocommerce_activated() ) {
	   		
	   		$default_tabs = apply_filters( 'unicase_homepage_tabs_args', array(
	   			array(
	   				'shortcode'		=> 'top_rated_products',
	   				'title'			=> esc_html__( 'Popular', 'unicase' ),
				),
	   			array(
	   				'shortcode'		=> 'featured_products',
	   				'title'			=> esc_html__( 'Featured', 'unicase' ),
				),
				array(
	   				'shortcode'		=> 'recent_products',
	   				'title'			=> esc_html__( 'New Products', 'unicase' ),
				),
				
			) );

			if( empty( $tabs ) ) {
				$tabs = $default_tabs;
			}

			unicase_get_template( 'sections/home-page-tabs.php', array( 'tabs' => $tabs, 'product_items' => $product_items, 'product_columns' => $product_columns ) );
		}
	}
}

if ( ! function_exists( 'unicase_products_tabs_carousel' ) ) {
	/**
	 * Display products tabs carousel
	 * Hooked into the `homepage` action in the products carousel
	 * @since  1.0.0
	 * @return  void
	 */
	function unicase_products_tabs_carousel( $title = '', $product_content = 'recent_products', $tabs_content = array(), $carousel_items = 4, $disable_touch_drag = FALSE ) {

		if( is_woocommerce_activated() ) {

			$title = ! empty( $title ) ? $title : esc_html__( 'New Arrivals', 'unicase' );

			$query_args = apply_filters( 'unicase_products_tabs_carousel_query_args', array(
			    'post_type'           => 'product',
			    'post_status'         => 'publish',
			    'ignore_sticky_posts' => 1,
			    'posts_per_page'      => 12,
			    'orderby'             => 'date',
			    'order'               => 'desc',
			    'meta_query'          => WC()->query->get_meta_query()
			) );

			$cat_args = apply_filters( 'unicase_products_tabs_carousel_cat_args', array(
				'taxonomy' 		=> 'product_cat',
				'terms' 		=> '',
				'field' 		=> 'slug',
				'operator' 		=> 'IN'
			) );

			$tabs = array();

			foreach( $tabs_content as $key => $tab ) {
				if( !empty( $tab['slug'] ) ) {
					if( $tab['slug'] == 'unicase-all-categories' ) {
						$cat_args['terms'] = '';
					} else {
						$cat_args['terms'] = $tab['slug'];
					}
					$method_name = 'unicase_get_'.$product_content.'_args';
					if( function_exists( $method_name ) ) {
						$query_args = $method_name( $query_args, $cat_args );
					}

					$tabs[] = array( 
						'content'		=> $query_args,
						'title'			=> ( !empty( $tab['title'] ) ? $tab['title'] : $tab['slug'] ),
					);
				}
			}
			
			unicase_get_template( 'sections/home-page-tabs-carousel.php', array( 'title' => $title, 'product_content' => $product_content, 'tabs' => $tabs, 'carousel_items' =>$carousel_items, 'disable_touch_drag' => $disable_touch_drag ) );
		    
			wp_enqueue_script( 'owl-carousel-js', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), '1.10.2', true );
		}
	}
}

if ( ! function_exists( 'unicase_products_carousel' ) ) {
	/**
	 * Display products carousel
	 * Hooked into the `homepage` action in the products carousel
	 * @since  1.0.0
	 * @return  void
	 */
	function unicase_products_carousel( $title = '', $type = 'type-1', $product_content = 'recent_products', $category_slug = '', $carousel_items = 4, $disable_touch_drag = FALSE, $product_ids = '' ) {

		if( is_woocommerce_activated() ) {

			$title = ! empty( $title ) ? $title : esc_html__( 'New Arrivals', 'unicase' );

			$query_args = apply_filters( 'unicase_products_carousel_query_args', array(
			    'post_type'           => 'product',
			    'post_status'         => 'publish',
			    'ignore_sticky_posts' => 1,
			    'posts_per_page'      => 12,
			    'orderby'             => 'date',
			    'order'               => 'desc',
			    'meta_query'          => WC()->query->get_meta_query()
			) );

			$cat_args = apply_filters( 'unicase_products_carousel_cat_args', array(
				'taxonomy' 		=> 'product_cat',
				'terms' 		=> '',
				'field' 		=> 'slug',
				'operator' 		=> 'IN'
			) );

			if( empty( $category_slug ) || $category_slug == 'unicase-all-categories' ) {
				$cat_args['terms'] = '';
			} else {
				$cat_args['terms'] = $category_slug;
			}
			
			$method_name = 'unicase_get_'.$product_content.'_args';

			if( $product_content == 'products' ) {
				if( ! empty( $product_ids ) ) {
					$query_args['post__in'] = explode(",", $product_ids);
				}
			} elseif( function_exists( $method_name ) ) {
			    $query_args = $method_name( $query_args, $cat_args );
			}
			
			if( $type == 'type-2' ) {
				unicase_get_template( 'sections/products-carousel-2.php', array( 'title' => $title, 'product_content' => $product_content, 'query_args' => $query_args, 'carousel_items' =>$carousel_items, 'disable_touch_drag' => $disable_touch_drag ) );
			} else {
				unicase_get_template( 'sections/products-carousel-1.php', array( 'title' => $title, 'product_content' => $product_content, 'query_args' => $query_args, 'carousel_items' =>$carousel_items, 'disable_touch_drag' => $disable_touch_drag ) );
			}
		    
			wp_enqueue_script( 'owl-carousel-js', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), '1.10.2', true );
		}
	}
}

if ( ! function_exists( 'unicase_blog_carousel' ) ) {
	/**
	 * Display blog carousel
	 * Hooked into the `homepage` action in the blog carousel
	 * @since  1.0.0
	 * @return  void
	 */
	function unicase_blog_carousel( $title = '', $limit = 12 , $orderby = 'title', $order = 'ASC', $disable_touch_drag = FALSE ) {

		$title = ! empty( $title ) ? $title : esc_html__( 'Blog', 'unicase' );

		$query_args = apply_filters( 'unicase_blog_carousel_query_args', array(
			'orderby'				=> $orderby,
			'order'					=> $order,
			'posts_per_page'		=> $limit,
			'no_found_rows'			=> true,
			'post_status'			=> 'publish',
			'ignore_sticky_posts'	=> true
	    ) );
	    
		wp_enqueue_script( 'owl-carousel-js', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), '1.10.2', true );

		unicase_get_template( 'sections/blog-carousel.php', array( 'query_args' => $query_args, 'title' => $title, 'disable_touch_drag' => $disable_touch_drag ) );
	}
}

if ( ! function_exists( 'unicase_brands_carousel' ) ) {
	/**
	 * Display brands carousel
	 * Hooked into the `homepage` action in the brands carousel
	 * @since  1.0.0
	 * @return  void
	 */
	function unicase_brands_carousel( $title = '', $limit = 12 , $has_no_products = FALSE, $orderby = 'title', $order = 'ASC', $include = '', $disable_touch_drag = FALSE ) {

		if( is_woocommerce_activated() ) {

			$title = ! empty( $title ) ? $title : esc_html__( 'Brands', 'unicase' );
		
			$brand_taxonomy = unicase_get_brands_taxonomy();

			if( ! empty( $brand_taxonomy ) ) {

				$args = apply_filters( 'unicase_brands_carousel_args', array(
					'orderby'			=> $orderby,
					'order'				=> $order,
					'number'			=> $limit,
					'hide_empty'    	=> $has_no_products,
				) );

				if( !empty( $include ) ) {
					$args['include'] = $include;
				}

			    $terms = get_terms( $brand_taxonomy, $args );
			    
				if( ! is_wp_error( $terms ) && !empty( $terms ) ) {
					wp_enqueue_script( 'owl-carousel-js', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), '1.10.2', true );

					unicase_get_template( 'sections/brands-carousel.php', array( 'terms' => $terms, 'title' => $title, 'disable_touch_drag' => $disable_touch_drag ) );
				}
			}
		}
	}
}
