<?php
/**
 * General functions used to integrate this theme with WooCommerce.
 *
 * @package unicase
 */

/**
 * Before Content
 * Wraps all WooCommerce content in wrappers which match the theme markup
 * @since   1.0.0
 * @return  void
 */

if ( ! function_exists( 'unicase_before_wc_content' ) ) {
	function unicase_before_wc_content() {
		ob_start();
	}
}

/**
 * After Content
 * Closes the wrapping divs
 * @since   1.0.0
 * @return  void
 */
if ( ! function_exists( 'unicase_after_wc_content' ) ) {
	function unicase_after_wc_content() {
		$page_layout_args = unicase_get_page_layout_args();
		$output = ob_get_clean();
		$layout_args = apply_filters( 'unicase_shop_page_layout_args', array( 'main_content' => $output, 'sidebar_action' => 'unicase_shop_sidebar' ) );
		unicase_get_template( 'layouts/' . $page_layout_args['layout'] . '.php', $layout_args );
	}
}

/**
 * 
 * @since 1.0.0
 * @return void
 */
if( ! function_exists( 'unicase_shop_sidebar' ) ) {
	function unicase_shop_sidebar() {
		woocommerce_get_sidebar();
	}
}

/**
 * Default loop columns on product archives
 * @return integer products per row
 * @since  1.0.0
 */
if( ! function_exists( 'unicase_loop_columns' ) ) {
	function unicase_loop_columns() {
		
		$page_layout_args = unicase_get_page_layout_args();
		if( ! empty( $page_layout_args['products_per_row'] ) ) {
			$products_per_row = $page_layout_args['products_per_row'] ;
		} else {
			$products_per_row = 3 ;
		}
		return apply_filters( 'unicase_loop_columns', $products_per_row ); // 3 products per row
	}
}

/**
 * Add wrappers for breadcrumb default args
 * @param array $args
 * @return array $args modified to include 'col-full' class
 */
if( ! function_exists( 'unicase_breadcrumb_defaults' ) ) {
	function unicase_breadcrumb_defaults( $args ) {
		$args['delimiter']		= '<span class="delimiter">&#47;</span>';
		$args['wrap_before'] 	= '<nav class="woocommerce-breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '><div class="container">';
		$args['wrap_after'] 	= '</div></nav><!-- /.woocommerce-breadcrumb -->';

		return $args;
	}
}

/**
 * Add 'woocommerce-active' class to the body tag
 * @param  array $classes
 * @return array $classes modified to include 'woocommerce-active' class
 */
if( ! function_exists( 'unicase_woocommerce_body_class' ) ) {
	function unicase_woocommerce_body_class( $classes ) {
		if ( is_woocommerce_activated() ) {
			$classes[] = 'woocommerce-active';
		}

		return $classes;
	}
}

/**
 * Cart Fragments
 * Ensure cart contents update when products are added to the cart via AJAX
 * @param  array $fragments Fragments to refresh via AJAX
 * @return array            Fragments to refresh via AJAX
 */
if ( ! function_exists( 'unicase_cart_link_fragment' ) ) {
	function unicase_cart_link_fragment( $fragments ) {
		global $woocommerce;

		ob_start();

		unicase_cart_link();

		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}

/**
 * Cross-sells Products Args
 * @param  int $args cross-sell products args
 * @since 1.0.0
 * @return  int $args cross-sell products args
 */
if ( ! function_exists( 'unicase_cross_sells_products_args' ) ) {
	function unicase_cross_sells_products_args( $args ) {
		$args = apply_filters( 'unicase_cross_sells_products_args', 4 );

		return $args;
	}
}

/**
 * Product gallery thumnail columns
 * @return integer number of columns
 * @since  1.0.0
 */
if ( ! function_exists( 'unicase_thumbnail_columns' ) ) {
	function unicase_thumbnail_columns() {
		return intval( apply_filters( 'unicase_product_thumbnail_columns', 4 ) );
	}
}

/**
 * Products per page
 * @return integer number of products
 * @since  1.0.0
 */
if ( ! function_exists( 'unicase_products_per_page' ) ) {
	function unicase_products_per_page() {
		return intval( apply_filters( 'unicase_products_per_page', 12 ) );
	}
}

/**
 * Query WooCommerce Extension Activation.
 * @var  $extension main extension class name
 * @return boolean
 */
if ( ! function_exists( 'is_woocommerce_extension_activated' ) ) {
	function is_woocommerce_extension_activated( $extension = 'WC_Bookings' ) {
		return class_exists( $extension ) ? true : false;
	}
}

if ( ! function_exists( 'unicase_cart_coupon_display' ) ) {

	/**
	 * Output the cart coupon.
	 *
	 * @subpackage	Cart
	 */
	function unicase_cart_coupon_display() {
		unicase_get_template( 'shop/cart-coupon.php' );
	}
}

if ( ! function_exists( 'unicase_product_action_buttons' ) ) {
	/**
	 * Output the action buttons.
	 *
	 */
	function unicase_product_action_buttons() {
		unicase_get_template( 'shop/action-buttons.php' );
	}
}

if ( ! function_exists( 'unicase_get_brands_taxonomy' ) ) {
	/**
	 * Products Brand Taxonomy
	 * @return string
	 * @since  1.0.0
	 */
	function unicase_get_brands_taxonomy() {
		return apply_filters( 'unicase_product_brand_taxonomy', '' );
	}
}

if ( ! function_exists( 'unicase_get_recent_products_args' ) ) {
	/**
	 * Get Recent Products Args
	 * @return string
	 * @since  1.0.0
	 */
	function unicase_get_recent_products_args( $atts = array(), $category_atts = array() ) {
		$atts = shortcode_atts( array(
			'per_page' 	=> '11',
			'columns' 	=> '4',
			'orderby' 	=> 'date',
			'order' 	=> 'desc'
		), $atts );

		$category_atts = shortcode_atts( array(
			'taxonomy' 		=> 'product_cat',
			'terms' 		=> '',
			'field' 		=> 'slug',
			'operator' 		=> 'IN'
		), $category_atts );

		$query_args = array(
			'post_type'           => 'product',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => $atts['per_page'],
			'orderby'             => $atts['orderby'],
			'order'               => $atts['order'],
			'meta_query'          => WC()->query->get_meta_query()
		);

		if( !empty( $category_atts['terms'] ) ) {
			$query_args['tax_query'] = array( $category_atts );
		}

		return apply_filters( 'unicase_get_recent_products_args', $query_args );
	}
}

if ( ! function_exists( 'unicase_get_sale_products_args' ) ) {
	/**
	 * Get Sale Products Args
	 * @return string
	 * @since  1.0.0
	 */
	function unicase_get_sale_products_args( $atts = array(), $category_atts = array() ) {
		$atts = shortcode_atts( array(
			'per_page' => '12',
			'columns'  => '4',
			'orderby'  => 'title',
			'order'    => 'asc'
		), $atts );

		$category_atts = shortcode_atts( array(
			'taxonomy' 		=> 'product_cat',
			'terms' 		=> '',
			'field' 		=> 'slug',
			'operator' 		=> 'IN'
		), $category_atts );

		$query_args = array(
			'posts_per_page'	=> $atts['per_page'],
			'orderby' 			=> $atts['orderby'],
			'order' 			=> $atts['order'],
			'no_found_rows' 	=> 1,
			'post_status' 		=> 'publish',
			'post_type' 		=> 'product',
			'meta_query' 		=> WC()->query->get_meta_query(),
			'post__in'			=> array_merge( array( 0 ), wc_get_product_ids_on_sale() )
		);

		if( !empty( $category_atts['terms'] ) ) {
			$query_args['tax_query'] = array( $category_atts );
		}

		return apply_filters( 'unicase_get_sale_products_args', $query_args );
	}
}

if ( ! function_exists( 'unicase_get_best_selling_products_args' ) ) {
	/**
	 * Get Best Selling Products Args
	 * @return string
	 * @since  1.0.0
	 */
	function unicase_get_best_selling_products_args( $atts = array(), $category_atts = array() ) {
		$atts = shortcode_atts( array(
			'per_page' => '12',
			'columns'  => '4'
		), $atts );

		$category_atts = shortcode_atts( array(
			'taxonomy' 		=> 'product_cat',
			'terms' 		=> '',
			'field' 		=> 'slug',
			'operator' 		=> 'IN'
		), $category_atts );

		$query_args = array(
			'post_type'           => 'product',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => $atts['per_page'],
			'meta_key'            => 'total_sales',
			'orderby'             => 'meta_value_num',
			'meta_query'          => WC()->query->get_meta_query()
		);

		if( !empty( $category_atts['terms'] ) ) {
			$query_args['tax_query'] = array( $category_atts );
		}

		return apply_filters( 'unicase_get_best_selling_products_args', $query_args );
	}
}

if ( ! function_exists( 'unicase_get_featured_products_args' ) ) {
	/**
	 * Get Featured Products Args
	 * @return string
	 * @since  1.0.0
	 */
	function unicase_get_featured_products_args( $atts = array(), $category_atts = array() ) {
		$atts = shortcode_atts( array(
			'per_page' => '12',
			'columns'  => '4',
			'orderby'  => 'date',
			'order'    => 'desc'
		), $atts );

		$meta_query   = WC()->query->get_meta_query();
		$meta_query[] = array(
			'key'   => '_featured',
			'value' => 'yes'
		);

		$category_atts = shortcode_atts( array(
			'taxonomy' 		=> 'product_cat',
			'terms' 		=> '',
			'field' 		=> 'slug',
			'operator' 		=> 'IN'
		), $category_atts );

		$query_args = array(
			'post_type'           => 'product',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => $atts['per_page'],
			'orderby'             => $atts['orderby'],
			'order'               => $atts['order'],
			'meta_query'          => $meta_query
		);

		if( !empty( $category_atts['terms'] ) ) {
			$query_args['tax_query'] = array( $category_atts );
		}

		return apply_filters( 'unicase_get_featured_products_args', $query_args );
	}
}

if ( ! function_exists( 'unicase_get_top_rated_products_args' ) ) {
	/**
	 * Get Top Rated Products Args
	 * @return string
	 * @since  1.0.0
	 */
	function unicase_get_top_rated_products_args( $atts = array(), $category_atts = array() ) {
		$atts = shortcode_atts( array(
			'per_page' => '12',
			'columns'  => '4',
			'orderby'  => 'title',
			'order'    => 'asc'
		), $atts );

		$category_atts = shortcode_atts( array(
			'taxonomy' 		=> 'product_cat',
			'terms' 		=> '',
			'field' 		=> 'slug',
			'operator' 		=> 'IN'
		), $category_atts );

		$query_args = array(
			'post_type'           => 'product',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
			'orderby'             => $atts['orderby'],
			'order'               => $atts['order'],
			'posts_per_page'      => $atts['per_page'],
			'meta_query'          => WC()->query->get_meta_query()
		);

		if( !empty( $category_atts['terms'] ) ) {
			$query_args['tax_query'] = array( $category_atts );
		}

		return apply_filters( 'unicase_get_top_rated_products_args', $query_args );
	}
}

if( ! function_exists( 'unicase_get_product_attr_taxonomies' ) ) {
	/**
	 * Get All Product Attribute Taxonomies
	 * @since   1.0.0
	 * @return  array
	 */
	function unicase_get_product_attr_taxonomies() {
		$product_taxonomies = array();
		$attribute_taxonomies = wc_get_attribute_taxonomies();
		if ( $attribute_taxonomies ) {
			foreach ( $attribute_taxonomies as $tax ) {
				$product_taxonomies[wc_attribute_taxonomy_name( $tax->attribute_name )] = $tax->attribute_label;
			}
		}

		return $product_taxonomies;
	}
}

if ( ! function_exists( 'unicase_wrap_star_rating' ) ) {
	/**
	 * Adds a wrapper to star rating
	 * @return string wrapped star rating html
	 * @since 1.0.0
	 */
	function unicase_wrap_star_rating( $rating_html ) {
		return '<div class="star-rating-wrapper">' . $rating_html . '</div>';
	}
}

if( !function_exists( 'unicase_display_mini_cart' ) ) {
	/**
	 * Mini Cart Display
	 * @since   1.0.0
	 * @return  void
	 */
	function unicase_display_mini_cart() {
		unicase_get_template( 'shop/unicase_mini_cart.php' );
	}
}

if( !function_exists( 'unicase_mini_cart_add_to_cart_fragment' ) ) {
	/**
	 * Mini Cart Ajax Update Fragments
	 * @since   1.0.0
	 * @return  array
	 */
	function unicase_mini_cart_add_to_cart_fragment( $fragments ) {
		ob_start();
	
		echo '<div class="mini-cart-items">';
		woocommerce_mini_cart();
		echo '</div>';
		
		$fragments['.unicase-mini-cart div.mini-cart-items'] = ob_get_clean();
		$fragments['.unicase-mini-cart span.item-count'] = '<span class="item-count">' . WC()->cart->get_cart_contents_count() . '</span>';
		$fragments['.unicase-mini-cart span.cart-count'] = '<span class="cart-count">' . WC()->cart->get_cart_contents_count() . esc_html__( ' Item(s)-', 'unicase' ) . WC()->cart->get_cart_subtotal() . '</span>';
		
		return $fragments;
	}
}

function unicase_single_product_add_to_cart() {
	global $product;

	if( apply_filters( 'unicase_is_catalog_mode_disabled', TRUE ) ) {
		do_action( 'woocommerce_' . $product->product_type . '_add_to_cart'  );
	} else {
		if( $product->is_type( 'external' ) ) {
			do_action( 'woocommerce_' . $product->product_type . '_add_to_cart'  );
		}
	}
}

if( ! function_exists( 'unicase_shop_tab_pane' ) ) {
	/**
	 * Grid/List View Switcher
	 *
	 * @since 1.0.0
	 * @return void
	 */
	function unicase_shop_tab_pane() {
		$default_shop_view = apply_filters( 'unicase_default_shop_view', 'grid' );
		?>
		<div class="view-switcher pull-left flip">
			<span class="key"><?php esc_html_e( 'View as:', 'unicase' ); ?></span>
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="grid-list-button-item grid-view<?php if( $default_shop_view == 'grid' ) : ?> active<?php endif; ?>">
					<a href="#grid-view" data-toggle="tab"></a>
				</li>
				<li role="presentation" class="grid-list-button-item list-view<?php if( $default_shop_view == 'list' ) : ?> active<?php endif; ?>">
					<a href="#list-view" data-toggle="tab"></a>
				</li>
			</ul>
		</div>
		<?php
	}
}

if( ! function_exists( 'unicase_loop_list_view' ) ) {
	/**
	 * Displays Products in List View
	 *
	 * @since 1.0.0
	 * @return void
	 */
	function unicase_loop_list_view() {
		$default_shop_view = apply_filters( 'unicase_default_shop_view', 'grid' );
		?>
		<div id="list-view" class="tab-pane<?php if( $default_shop_view == 'list' ) : ?> active<?php endif; ?>">
			<ul class="list-view-products">
				
				<?php woocommerce_product_subcategories(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php unicase_get_template( 'shop/content-product-list-view.php' ); ?>

				<?php endwhile; // end of the loop. ?>

			</ul>
		</div>
		<?php
	}
}

if( ! function_exists( 'unicase_loop_view_wrap_start' ) ) {
	/**
	 * Products in Grid/List View Wrapper Start
	 *
	 * @since 1.0.0
	 * @return void
	 */
	function unicase_loop_view_wrap_start() {
		$default_shop_view = apply_filters( 'unicase_default_shop_view', 'grid' );
		?>
		<div class="tab-content">
			<div id="grid-view" class="tab-pane<?php if( $default_shop_view == 'grid' ) : ?> active<?php endif; ?>">
		<?php
	}
}

if( ! function_exists( 'unicase_loop_view_wrap_end' ) ) {
	/**
	 * Products in Grid/List View Wrapper End
	 *
	 * @since 1.0.0
	 * @return void
	 */
	function unicase_loop_view_wrap_end() {
		?>
			</div>
			<?php unicase_loop_list_view(); ?>
		</div>
		<?php
	}
}

if( ! function_exists( 'unicase_single_product_share_icons' ) ) {
	function unicase_single_product_share_icons() {
		
		if( apply_filters( 'unicase_show_single_product_share', TRUE ) ) :

			$url = get_permalink();
			$title = get_the_title();

			if( has_post_thumbnail() ) {
				$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );

				if( isset( $thumbnail[0] ) ) {
					$thumbnail_src = $thumbnail[0];
				}
			}

			$single_product_social_icons_args = apply_filters( 'single_product_social_icons_args', array(
				'facebook'		=> array(
					'share_url'	=> 'http://www.facebook.com/sharer.php',
					'icon'		=> 'fa fa-facebook',
					'name'		=> esc_html__( 'Facebook', 'unicase' ),
					'params'	=> array(
						'u'				=> 'url'
					)
				),
				'twitter'		=> array(
					'share_url'	=> 'https://twitter.com/share',
					'icon'		=> 'fa fa-twitter',
					'name'		=> esc_html__( 'Twitter', 'unicase' ),
					'params'	=> array(
						'url'			=> 'url',
						'text'			=> 'title',
						'via'			=> 'via',
						'hastags'		=> 'hastags'
					)
				),
				'google_plus'	=> array(
					'share_url'	=> 'https://plus.google.com/share',
					'name'		=> esc_html__( 'Google Plus', 'unicase' ),
					'icon'		=> 'fa fa-google-plus',
					'params'	=> array(
						'url'			=> 'url'
					)
				),
				'pinterest'		=> array(
					'share_url'	=> 'https://pinterest.com/pin/create/bookmarklet/',
					'name'		=> esc_html__( 'Pinterest', 'unicase' ),
					'icon'		=> 'fa fa-pinterest',
					'params'	=> array(
						'media'			=> 'thumbnail_src',
						'url'			=> 'url',
						'is_video'		=> 'is_video',
						'description'	=> 'title'
					)
				),
				'digg'			=> array(
					'share_url'	=> 'http://digg.com/submit',
					'name'		=> esc_html__( '', 'unicase' ),
					'icon'		=> 'fa fa-digg',
					'params'	=> array(
						'url'			=> 'url',
						'title'			=> 'title',
					)
				),
				'email'			=> array(
					'share_url'	=> 'mailto:yourfriend@email.com',
					'name'		=> esc_html__( 'Email', 'unicase' ),
					'icon'		=> 'fa fa-envelope',
					'params'	=> array(
						'subject'		=> 'title',
						'body'			=> 'url',
					)
				),
			) );
			?>
			<div class="social-icons">
				<ul class="list-unstyled list-social-icons">
				<?php foreach( $single_product_social_icons_args as $key => $social_icon ): ?>
					<?php 
						$query_args = array();
						foreach( $social_icon['params'] as $param_key => $param ) {

							if( isset( $$param ) ) {
								$query_args[ $param_key ] = $$param;
							}
						}

						$share_url = add_query_arg( $query_args, $social_icon['share_url'] );
					?>
					<li class="<?php echo esc_attr( $key ); ?>">
						<a class="<?php echo esc_attr( $social_icon['icon'] ); ?>" href="<?php echo esc_url( $share_url ); ?>" title="<?php esc_attr( $social_icon['name'] ); ?>"></a>
					</li>
				<?php endforeach; ?>
				</ul>
			</div>
			<?php
		endif;
	}
}

if( ! function_exists( 'woocommerce_product_loop_start' ) ) {
	function woocommerce_product_loop_start( $echo = true ) {
		ob_start();
		
		global $woocommerce_loop;

		$woocommerce_loop['loop'] = 0;
		$product_loop_classes_arr = apply_filters( 'unicase_product_loop_classes', array( 'products' ) );

		$columns = apply_filters( 'loop_shop_columns', 3 );

		if( isset( $woocommerce_loop['columns'] ) ) {
			$columns = $woocommerce_loop['columns'];
		}

		$product_loop_classes_arr[] = 'columns-' . $columns;

		if( is_array( $product_loop_classes_arr ) ) {
			$loop_classes = implode( ' ', $product_loop_classes_arr );
		}

		?>
		<ul class="<?php echo esc_attr( $loop_classes ); ?>">
		<?php

		if ( $echo ) {
			echo ob_get_clean();
		}
		else {
			return ob_get_clean();
		}
	}
}

if( ! function_exists( 'unicase_show_wc_page_title' ) ) {
	function unicase_show_wc_page_title( $show ) {
		
		if(	is_shop() ) {
			return false;
		}

		return $show;
	}
}

if( ! function_exists( 'unicase_single_product_style' ) ) {
	function unicase_single_product_style() {
		return apply_filters( 'unicase_single_product_style', 'style-1' );
	}
}

if( ! function_exists( 'unicase_get_compare_page_url' ) ) {
	function unicase_get_compare_page_url() {
		return apply_filters( 'unicase_compare_page_url', '' );
	}
}

if( ! function_exists( 'unicase_loop_page_jumbotron' ) ) {
	function unicase_loop_page_jumbotron() {
		$layout_args = unicase_get_page_layout_args();

		if( ! empty( $layout_args['shop_jumbotron'] ) ) {
			echo wp_kses_post( $layout_args['shop_jumbotron'] );
		}
	}
}

if( ! function_exists( 'unicase_products_live_search' ) ) {
	function unicase_products_live_search() {
		if ( isset( $_REQUEST['fn'] ) && 'get_ajax_search' == $_REQUEST['fn'] ) {

			$query_args = apply_filters( 'unicase_live_search_query_args', array(
				'posts_per_page' 	=> 10,
				'no_found_rows' 	=> true,
				'post_type'			=> 'product',
				'meta_query'		=> array(
					array(
						'key' => '_visibility',
						'value' => array( 'search', 'visible' ),
						'compare' => 'IN'
					)
				)
			) );

			if( isset( $_REQUEST['terms'] ) ) {
				$query_args['s'] = $_REQUEST['terms'];
			}

			$search_query = new WP_Query( $query_args );

			$results = array( );
			if ( $search_query->get_posts() ) {
			    foreach ( $search_query->get_posts() as $the_post ) {
					$title = get_the_title( $the_post->ID );
			        if ( has_post_thumbnail( $the_post->ID ) ) {
						$post_thumbnail_ID = get_post_thumbnail_id( $the_post->ID );
						$post_thumbnail_src = wp_get_attachment_image_src( $post_thumbnail_ID, 'thumbnail' );
					} else{
						$dimensions = wc_get_image_size( 'thumbnail' );
						$post_thumbnail_src = array(
							wc_placeholder_img_src(),
							esc_attr( $dimensions['width'] ),
							esc_attr( $dimensions['height'] )
						);
					}

					$product = new WC_Product( $the_post->ID );
					$price = $product->get_price_html();
					$brand = '';
					$title = html_entity_decode( $title , ENT_QUOTES, 'UTF-8' );

					$brand_taxonomy = unicase_get_brands_taxonomy();
					if( ! empty( $brand_taxonomy ) ) {
					    $terms = wc_get_product_terms( $the_post->ID, $brand_taxonomy, array( 'fields' => 'names' ) );
					    if ( $terms && ! is_wp_error( $terms ) ) {
							$brand_links = array();
							foreach ( $terms as $term ) {
								if( isset($term->name) ) {
									$brand_links[] = $term->name;
								}
							}
							$brand = join( ", ", $brand_links );
						}
					}

					$results[] = array(
						'value' 	=> $title,
						'url' 		=> get_permalink( $the_post->ID ),
						'tokens' 	=> explode( ' ', $title ),
						'image' 	=> $post_thumbnail_src[0],
						'price'		=> $price,
						'brand'		=> $brand,
						'id'		=> $the_post->ID
					);
			    }
			}

			wp_reset_postdata();
			echo json_encode( $results );
		}
		die();
	}
}

if( ! function_exists( 'unicase_product_labels' ) ) {
	function unicase_product_labels( $product_id = false ) {
		
		global $product;

		$product_id = ( $product_id ) ? $product_id : $product->id;
		$labels = get_the_terms( $product_id, 'product_label' );
		$product_labels = '';

		if ( $labels && ! is_wp_error( $labels ) ){
			foreach( $labels as $label ){
				$product_labels .= '<div class="ribbon label-' . esc_attr( $label->term_id ) . '"><span>' . esc_html( $label->name ) . '</span></div>';
			}
		}

		echo $product_labels;

	}
}

if( ! function_exists( 'unicase_product_label_style' ) ) {
	function unicase_product_label_style() {
		?>
		<style type="text/css">
			<?php
				$product_labels = get_categories( array( 'taxonomy' => 'product_label') );
				$product_label_css = '';
				if ( $product_labels && ! is_wp_error( $product_labels ) && empty( $product_labels['errors'] ) ){
					foreach( $product_labels as $product_label ){
						if( isset( $product_label->term_id ) ){
							$background_color = get_woocommerce_term_meta( $product_label->term_id , 'background_color', true );
							$text_color = get_woocommerce_term_meta( $product_label->term_id , 'text_color', true );

							$product_label_css .= '.label-' . $product_label->term_id . ' > span {';
							$product_label_css .= 'color: '. $text_color . ';';
							$product_label_css .= '}';

							$product_label_css .= '.label-' .$product_label->term_id . '.ribbon:after {';
							$product_label_css .= 'border-color: '. $background_color . ';';
							$product_label_css .= '}';
						}
					}
				}
				echo $product_label_css;
			?>
		</style>
		<?php
	}
}

/**
 * Returns the sale flash badge HTML
 * 
 * @return string
 */
if( ! function_exists( 'unicase_product_sale_flash' ) ) {
	function unicase_product_sale_flash() {
		$sale_flash = '<div class="ribbon primary"><span class="onsale">' . esc_html__( 'Sale!', 'unicase' ) . '</span></div>';
		return $sale_flash;
	}
}

/**
 * Functions for getting parts of a price, in html, used by get_price_html.
 *
 * @param  string $from String or float to wrap with 'from' text
 * @param  mixed $to String or float to wrap with 'to' text
 * @return string
 */
if( ! function_exists( 'unicase_product_get_price_html_from_to' ) ) {
	function unicase_product_get_price_html_from_to( $price, $from, $to, $this ) {
		$price = '<ins>' . ( ( is_numeric( $to ) ) ? wc_price( $to ) : $to ) . '</ins> <del>' . ( ( is_numeric( $from ) ) ? wc_price( $from ) : $from ) . '</del>';

		return apply_filters( 'unicase_product_get_price_html_from_to', $price, $from, $to, $this );
	}
}

if( ! function_exists( 'unicase_product_variation_sale_price_html' ) ) {
	function unicase_product_variation_sale_price_html( $price, $wc_product_variation ){
		$display_price         = $wc_product_variation->get_display_price();
		$display_regular_price = $wc_product_variation->get_display_price( $wc_product_variation->get_regular_price() );
		$display_sale_price    = $wc_product_variation->get_display_price( $wc_product_variation->get_sale_price() );

		$price = '<ins>' . wc_price( $display_sale_price ) . '</ins> <del>' . wc_price( $display_regular_price ) . '</del>' . $wc_product_variation->get_price_suffix();

		return apply_filters( 'unicase_product_variation_sale_price_html', $price, $wc_product_variation );
	}
}

if( ! function_exists( 'unicase_wc_pagination' ) ) {
	function unicase_wc_pagination() {
		if ( ! woocommerce_products_will_display() ) {
			return;
		}
		woocommerce_pagination();
	}
}