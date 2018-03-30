<?php

    // Add Theme Support

    add_theme_support( 'woocommerce' );
    add_filter( 'woocommerce_enqueue_styles', '__return_false' );

    // Remove Unwanted Actions

    remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
	remove_filter( 'woocommerce_before_shop_loop_item_title', 'woocommerce_before_shop_loop_item_title', 10 );
	remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);
	remove_filter( 'woocommerce_subcategory_thumbnail', 'woocommerce_subcategory_thumbnail', 10 );

    // Add shop sidebar

	function krown_shop_widgets_init() {

		register_sidebar( array(
			'name' => __('Shop widget area', 'krown'),
			'id' => 'krown_shop_widget',
			'description' => __('The shop\'s filtering header area', 'krown'),
			'before_widget' => '<div id="%1$s" class="widget %2$s clearfix">',
			'after_widget' => '</div>',
			'before_title' => '<span class="title">',
			'after_title' => '</span>',
		) );

	}  

	add_action( 'widgets_init', 'krown_shop_widgets_init' );

	// Change order by wording (remove the sorty by word and keep everything ready for translation)

	add_filter( 'gettext', 'theme_sort_change', 20, 3 );
	function theme_sort_change( $translated_text, $text, $domain ) {

	    if ( is_woocommerce() ) {

	        switch ( $translated_text ) {

	            case 'Sort by popularity' :
	                $translated_text = __( 'Popularity', 'krown' );
	                break;

	            case 'Sort by average rating' :
	                $translated_text = __( 'Average rating', 'krown' );
	                break;

	            case 'Sort by newness' :
	                $translated_text = __( 'Newest', 'krown' );
	                break;

	            case 'Sort by price: low to high' :
	                $translated_text = __( 'Price (low to high)', 'krown' );
	                break;

	            case 'Sort by price: high to low' :
	                $translated_text = __( 'Price (high to low)', 'krown' );
	                break;

	            case 'Select a category' :
	                $translated_text = __( 'All', 'krown' );
	                break;

	        }

	    }

	    return $translated_text;
	}

	// The function below deregisters the WooCommerce scripts on pages which have nothing to do with WOO. I've wrapped this function to allow for easy disablement is there are any issues with it.

	if ( ! function_exists( 'krown_handle_woo_scripts' ) ) {

		function krown_handle_woo_scripts() {

			if ( ! ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) ) {

				wp_dequeue_script( 'wc-add-to-cart' );
				wp_dequeue_script( 'jquery-blockui' ); 
				wp_dequeue_script( 'jquery-placeholder' ); 
				wp_dequeue_script( 'jquery-cookie' ); 
				wp_dequeue_script( 'wc-country-select' ); 
				wp_dequeue_script( 'jquery-payment' ); 
				wp_dequeue_script( 'wc-credit-card-form' ); 
				wp_dequeue_script( 'woocommerce' );

			}

		}

	}

	add_action( 'wp_enqueue_scripts', 'krown_handle_woo_scripts', 101 );

	// Embed new "add-to-cart-variation" .js file

	function krown_variable_add_to_cart() {

		wc_get_template( 'single-product/add-to-cart/variation.php' );

		wp_dequeue_script( 'wc-add-to-cart-variation' );
		wp_enqueue_script( 'krown-add-to-cart-variation', get_template_directory_uri() . '/js/krown-add-to-cart-variation.js', array( 'jquery', 'wp-util' ) );

		wp_localize_script(
			'krown-add-to-cart-variation', 
			'wc_add_to_cart_variation_params',
			array(
				'i18n_no_matching_variations_text' => esc_attr__( 'Sorry, no products matched your selection. Please choose a different combination.', 'krown' ),
				'i18n_make_a_selection_text'       => esc_attr__( 'Select product options before adding this product to your cart.', 'krown' ),
				'i18n_unavailable_text'            => esc_attr__( 'Sorry, this product is unavailable. Please choose a different combination.', 'krown' )
			)
		);

	}

	add_action( 'woocommerce_variable_add_to_cart', 'krown_variable_add_to_cart', 31 );

	// Display X products per page

	add_filter( 'loop_shop_per_page', create_function( '$cols', 'return ' . get_option( 'krown_shop_per', '12' ) . ';' ), 20 );

	// Search icon

	if ( ! function_exists( 'krown_product_search_form' ) ) {

		function krown_product_search_form( $form ) {

		    $form = '
			<div id="main-search"><form role="search" method="get" id="searchform" class="search-form" action="' . home_url( '/' ) . '">
				<label class="screen-reader-text hidden" for="s">' . __( 'Search:', 'krown' ) . '</label>
				<input type="search" data-value="Type and hit Enter" value="' . __( 'Type and hit Enter', 'krown' ) . '" name="s" id="s" />
				<i class="fa fa-search"></i>
				<input id="submit_s" type="submit" />
				<input type="hidden" name="post_type" value="product" />
		    </form></div>';
		    return $form;
			
		}

	}

	add_filter( 'get_product_search_form', 'krown_product_search_form' );

	// Build WooCommerce secondary header

	function krown_woo_header() {

		if ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) {

			echo '<aside id="shop-sidebar" class="clearfix">';

			if ( is_shop() || is_product_category() || is_product_tag() )  {
				dynamic_sidebar( 'krown_shop_widget' );
			} else if ( is_singular( 'product' ) ) {
				woocommerce_breadcrumb();
			} else if ( is_cart() || is_checkout() || is_account_page() ) {
				woocommerce_breadcrumb();
			}

			get_product_search_form();
			echo '</aside>';

		}

	}


	// Change home for breadcrumbs


	function krown_woocommerce_breadcrumbs() {
		return array(
			'delimiter' => '<span class="sep">&#47;</span>',
			'wrap_before' => '<nav class="woocommerce-breadcrumb" itemprop="breadcrumb">',
			'wrap_after' => '</nav>',
			'before' => '',
			'after' => '',
			'home' => __( 'Shop', 'krown' ),
		);
	}
	function krown_breadcrumb_home_url() {
		return get_permalink( get_option( 'krown_shop_page' ) );
	}

	add_filter( 'woocommerce_breadcrumb_home_url', 'krown_breadcrumb_home_url' );
	add_filter( 'woocommerce_breadcrumb_defaults', 'krown_woocommerce_breadcrumbs' );

	// Custom rating icons

    function krown_woocommerce_rating() {

        global $wpdb;
        global $post;

        $count = $wpdb->get_var("
            SELECT COUNT(meta_value) FROM $wpdb->commentmeta
            LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
            WHERE meta_key = 'rating'
            AND comment_post_ID = $post->ID
            AND comment_approved = '1'
            AND meta_value > 0
        ");

        $rating = $wpdb->get_var("
            SELECT SUM(meta_value) FROM $wpdb->commentmeta
            LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
            WHERE meta_key = 'rating'
            AND comment_post_ID = $post->ID
            AND comment_approved = '1'
        ");

        if ( ! ( $count == 0 || $rating == 0 ) ) {
            $average = number_format( $rating / $count, 2 );
        } else {
            $average = 0;
        }

        echo '<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="star-rating visible clearfix" title="' . sprintf( __( 'Rated %d out of 5', 'krown' ), $average ) . '">';
        for ( $i = .5; $i <= 5; $i+=.5 ){
            if ( $i <= $average ) {
                echo '<b class="half-star"></b>';
            } else {
                echo '<b class="no half-star"></b>';
            }
        }
        echo '</div>';
        
    }

    if ( get_option( 'woocommerce_enable_review_rating' ) == 'yes' ) {
        add_filter( 'woocommerce_single_product_summary', 'krown_woocommerce_rating', 15 );
    }

    // Remove related products

    function krown_remove_related_products( $args ) {
		return array();
	}

	if ( get_option( 'krown_shop_related' ) == 'show' ) {
		add_filter( 'woocommerce_related_products_args','krown_remove_related_products', 10 ); 
	}

	// Remove thumbanils

	remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );

	// Retina thumbnail

	if ( class_exists( 'MultiPostThumbnails' ) ) {

		new MultiPostThumbnails( array(
			'label' => 'Retina Featured Image',
			'id' => 'retina-thumbnail',
			'post_type' => 'product'
		) );

	}

	// Add grid class

	function krown_body_class( $classes ) {
	    if ( is_shop() || is_product_category() || is_product_tag() ) {
	    	array_push( $classes, ' shop-grid' );
	    }
	    return $classes;
	}

	add_filter('body_class', 'krown_body_class');

	// WooCommerce Variations ?! 

	/*function woocommerce_variable_add_to_cart() {
		global $product;

		// Enqueue variation scripts
		//wp_enqueue_script( 'wc-add-to-cart-variation' );

		// Get Available variations?
		$get_variations = sizeof( $product->get_children() ) <= apply_filters( 'woocommerce_ajax_variation_threshold', 30, $product );

		// Load the template
		wc_get_template( 'single-product/add-to-cart/variable.php', array(
			'available_variations' => $get_variations ? $product->get_available_variations() : false,
			'attributes'           => $product->get_variation_attributes(),
			'selected_attributes'  => $product->get_variation_default_attributes()
		) );
	}*/

?>