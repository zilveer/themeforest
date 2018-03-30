<?php
/*
 * Important For any update
 *
 */

if ( class_exists('woocommerce') ) { 
 
/**
 * Add CSS Class To li For Products Except Single Product
 * @since   1.0
 * @return  array CSS Class
 */
function sama_woocommerce_post_class( $classes ) {
	global $majesty_options;
	$shortocde_layout = $majesty_options['shortcode_products_query'];
	$shop_layout = $majesty_options['shop_type'];
	if( in_array( 'product', $classes ) && in_array('type-product', $classes ) && ! is_singular('product') ) {
		
		if( $shortocde_layout == 'grid' ) {
			$classes[] = 'col-md-4 col-sm-6 col-st-6 col-xs-12 menu-item';
		} elseif( $shortocde_layout == 'grid4col' ) {
			$classes[] = 'col-md-3 col-sm-4 col-st-6 col-xs-12 menu-item';
		} elseif( $shortocde_layout == 'list' ) {
			$classes[] = 'menu-item-list col-md-6 col-sm-12';
		} elseif( $shortocde_layout == 'list2' ) {
			$classes[] = 'menu-item-list menu-item-list2 col-md-6 col-sm-12';
		} elseif( $shortocde_layout == 'gridfullwidth' ) {
			$classes[] = 'col-md-3 col-sm-6 col-xs-12 menu-item';
		} elseif( $shortocde_layout == 'masonry' || $shortocde_layout == 'masonryfullwidth' ) {
			$classes[] = 'menu-item';
		} elseif( $shortocde_layout == '4col' || $shortocde_layout == '3col' ) {
			$classes[] = 'menu-item';
		} else {
			if( is_shop() || is_product_category() || is_product_tag() ) {
				if( $shop_layout == 'shop-2col-withsidebar' ) {
					$classes[] = 'col-md-6 col-sm-6 col-st-6 col-xs-12 item';
				} elseif( $shop_layout == 'list2' ) {
					$classes[] = 'menu-item-list menu-item-list2 col-md-6 col-sm-12';
				} elseif( $shop_layout == '4col' || $shop_layout == '3col' || $shop_layout == '3colwithsidebar' ) {
					$classes[] = 'menu-item';
				} elseif( $shop_layout == 'list2sidebar' ) {
					$classes[] = 'menu-item-list menu-item-list2 col-md-12';
				} else {
					$classes[] = 'col-md-4 col-sm-6 col-st-6 col-xs-12 item';
				}
			}
		}
	}
	// CSS For Related Products
	if( in_array( 'product', $classes ) && in_array('type-product', $classes ) && ! empty(  $majesty_options['related_css'] ) ) {
		//if( $majesty_options['related_css'] == 'grid' ) {
			$classes[] = 'col-md-4 col-sm-4 col-st-6 col-xs-12 item';
		//}
	}
	return $classes;
}


/**
 * Declare related and upsells products display in single product
 * @since   1.0
 * @see  sama_woocommerce_post_class() variable used in this function
 * @return  void
 */
function sama_add_css_class_to_li_products() {
	global $majesty_options;
	/*$shop_layout = $majesty_options['shop_type'];
	if( $shop_layout == 'fullwidth' || $shop_layout == 'shopwithsidebar' || $shop_layout == 'shop-2col-withsidebar' ) {
		$majesty_options['related_css'] = 'grid';
	} elseif( $shop_layout == 'list2' || $shop_layout == 'list2sidebar' ) {
		$majesty_options['related_css'] = 'list';
	} elseif( $shop_layout == '4col' ) {
		$majesty_options['related_css'] = '3col';
	} elseif( $shop_layout == '3col' || $shop_layout == '3colwithsidebar' ) {
		$majesty_options['related_css'] = '3col';
	}*/
	$majesty_options['related_css'] = 'grid';
}


/**
 * wrap result_count && woocommerce_catalog_ordering
 * @since   1.0
 * @hooked woocommerce_result_count - 20
 * @hooked woocommerce_catalog_ordering - 30
 */
function sama_woocommerce_wrap_before_shop_loop() {
	echo '<div class="woo-catalog-filter">';
}

/**
 * End wrap result_count && woocommerce_catalog_ordering
 * @since   1.0
 * @hooked woocommerce_result_count - 20
 * @hooked woocommerce_catalog_ordering - 30
 */
function sama_woocommerce_wrap_after_before_shop_loop() {
	echo '</div>';
}


/**
 * Remove Default woocommerce style
 * @ since 1.0
 */
function sama_remove_woocommerce_style( $styles ) {
	return null;
}

/**
 * Remove PrettyPhoto woocommerce
 * @ since 1.0
 */
function sama_dequeue_scripts_woo() {
	wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
	wp_dequeue_script( 'prettyPhoto' );
	wp_dequeue_script( 'prettyPhoto-init' );
}

/**
 * Change Breadcrumb $args
 * @ since 1.0
 */
function sama_woocommerce_breadcrum_change(	$args ) {
	$args = array(
		'delimiter'   => '',
		'wrap_before' => '<nav class="woocommerce-breadcrumb" ' . ( is_single() ? 'itemscope itemtype="http://data-vocabulary.org/Breadcrumb"' : '' ) . '><ol class="breadcrumb">',
		'wrap_after'  => '</ol></nav>',
		'before'      => '<li>',
		'after'       => '</li>',
		'home'        => _x( 'Home', 'woocommerce', 'theme-majesty' )
	);
	return $args;
}

/**
 * Cart Link
 * Displayed a link to the cart including the number of items present and the cart total
 * @param  array $settings Settings
 * @return array           Settings
 * @since  1.0
 */
if ( ! function_exists( 'sama_cart_link' ) ) {
	function sama_cart_link() {
		?>
			<a class="cart-contents" href="#" title="<?php esc_html_e( 'View your shopping cart', 'theme-majesty' ); ?>">
				<i class="fa fa-shopping-cart"></i>&#160;<span class="count"><?php echo wp_kses_data( WC()->cart->get_cart_contents_count() );?></span>
			</a>
		<?php
	}
}

/**
 * Cart Fragments
 * Ensure cart contents update when products are added to the cart via AJAX
 * @param  array $fragments Fragments to refresh via AJAX
 * @return array            Fragments to refresh via AJAX
 * @since  1.0
 */
if ( ! function_exists( 'sama_cart_link_fragment' ) ) {
	function sama_cart_link_fragment( $fragments ) {
		global $woocommerce;

		ob_start();

		sama_cart_link();

		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}

/**
 * Hide WooCommerce Title in Archive page
 * @ since 1.0
 */
function sama_woocommerce_hidden_page_title( $title ) {
	
	return false;
}

function sama_woocommerce_pagination_args() {
	global $wp_query;
	return array(
		'base'         => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
		'format'       => '',
		'add_args'     => '',
		'current'      => max( 1, get_query_var( 'paged' ) ),
		'total'        => $wp_query->max_num_pages,
		'prev_text'    => esc_html__('Previous', 'theme-majesty'),
		'next_text'    => esc_html__('Next', 'theme-majesty'),
		'type'         => 'list',
		'end_size'     => 3,
		'mid_size'     => 3
	);
}

/**
 * Used in Woocommerce default loop to sort what is display first
 * For Layout Type List, Masonry, Grid
 *
 * @ since 1.0
 */
function sama_woocommerce_before_shop_loop_item() {
	global $majesty_options, $post;
	
	$shop_loop_masonry = sama_shop_masonry_loop();
	$shortocde_layout = $majesty_options['shortcode_products_query'];
	$shop_layout = $majesty_options['shop_type'];
	$woo_default_cols = array( '4col', '3col', '3colwithsidebar');
	
	// Important Hooks if you used list in woo loop and after that used any grid, or masonry add to cart button not display 
	// Leave its important hook
	remove_action( 'sama_woocommerce_loop_display_thumbnail_sale_flash', 'woocommerce_template_loop_product_thumbnail', 10 );
	remove_action( 'sama_woocommerce_masonry_loop_display_thumbnail_sale_flash', 'woocommerce_show_product_loop_sale_flash', 10 );
	remove_action( 'sama_woocommerce_loop_display_thumbnail_sale_flash', 'sama_woocommerce_show_product_loop_featured', 8 );
	remove_action( 'sama_woocommerce_loop_display_thumbnail_sale_flash', 'woocommerce_show_product_loop_sale_flash', 10 );
	remove_action( 'sama_woocommerce_loop_display_thumbnail_sale_flash', 'sama_woocommerce_template_loop_product_thumbnail', 10 );
	remove_action( 'sama_woocommerce_masonry_loop_display_thumbnail_sale_flash', 'sama_woocommerce_show_product_loop_featured', 8 );
	remove_action( 'sama_woocommerce_loop_display_list_excerpt', 'woocommerce_template_loop_rating', 19);
	remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
	remove_action('sama_woocommerce_loop_display_thumbnail_sale_flash', 'woocommerce_template_loop_product_link_open', 11 );
	remove_action('sama_woocommerce_loop_display_thumbnail_sale_flash', 'sama_woocommerce_template_loop_product_thumbnail', 12 );
	remove_action('sama_woocommerce_loop_display_thumbnail_sale_flash', 'woocommerce_template_loop_product_link_close', 13 );
		
	add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
	add_action('sama_woocommerce_loop_display_list_excerpt', 'woocommerce_template_loop_rating', 25);
	
	if( ( $shortocde_layout == '3col' || $shortocde_layout == '4col' ) || ( ( is_shop() || is_product_category() || is_product_tag() ) && in_array( $shop_layout, $woo_default_cols ) ) ) {
		remove_action( 'sama_woocommerce_loop_display_list_excerpt', 'woocommerce_template_loop_rating', 25);
		add_action( 'sama_woocommerce_loop_display_list_excerpt', 'woocommerce_template_loop_rating', 19);
	} 
		
	// Wrap single porduct in loop
	if( $shortocde_layout == 'list' ) {
		// List
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
		remove_action('sama_woocommerce_loop_display_list_excerpt', 'woocommerce_template_loop_rating', 25);
		remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
		echo '<div class="item-img"><div class="overlay_content"><div class="overlay_item">';
		echo woocommerce_get_product_thumbnail( 'majesty-thumb-100' );
		echo '<div class="overlay"><div class="icons">';
		do_action('sama_woocommerce_loop_display_list_add_to_cart');
		echo '<a class="button btn btn-gold margin0" href="'.  esc_url( get_permalink() ) .'" title="'. the_title_attribute(array('echo'=>false)) .'"><i class="fa fa-link"></i></a>';
		echo '</div><a class="close-overlay hidden">x</a></div></div></div></div>';
	} elseif( $shortocde_layout == 'list2' || ( ( is_shop() || is_product_category() || is_product_tag() ) && ( $shop_layout == 'list2' || $shop_layout == 'list2sidebar' ) ) ) {
		// List 2 Add to cart Button under image and excerpt
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
		if( $majesty_options['shop_display_thumbnail_in_list2'] ) {
			if ( has_post_thumbnail() && wp_attachment_is_image( get_post_thumbnail_id() ) ) {
				echo '<div class="item-img">';
				echo woocommerce_get_product_thumbnail( 'majesty-thumb-100' );
				echo '</div>';
			}
		}
		if( ! $majesty_options['shop_display_rate_in_list2'] ) {
			remove_action('sama_woocommerce_loop_display_list_excerpt', 'woocommerce_template_loop_rating', 25);
		}
		if( ! $majesty_options['shop_display_excerpt_in_list2'] ) {
			remove_action('sama_woocommerce_loop_display_list_excerpt', 'sama_woocommerce_get_custom_excerpt_display_list', 30);
		}
	} elseif( ( in_array( $shortocde_layout, $woo_default_cols ) ) || ( ( is_shop() || is_product_category() || is_product_tag() ) && in_array( $shop_layout, $woo_default_cols ) ) ) {
		
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
		remove_action('sama_woocommerce_loop_display_list_excerpt', 'sama_woocommerce_get_custom_excerpt_display_list', 30);
		add_action( 'sama_woocommerce_loop_display_thumbnail_sale_flash', 'sama_woocommerce_show_product_loop_featured', 8 );
		add_action( 'sama_woocommerce_loop_display_thumbnail_sale_flash', 'woocommerce_show_product_loop_sale_flash', 10 );
		add_action('sama_woocommerce_loop_display_thumbnail_sale_flash', 'woocommerce_template_loop_product_link_open', 11 );
		add_action('sama_woocommerce_loop_display_thumbnail_sale_flash', 'sama_woocommerce_template_loop_product_thumbnail', 12 );
		add_action('sama_woocommerce_loop_display_thumbnail_sale_flash', 'woocommerce_template_loop_product_link_close', 13 );
		do_action('sama_woocommerce_loop_display_thumbnail_sale_flash');
	} elseif( $shortocde_layout == 'masonry' || $shortocde_layout == 'masonryfullwidth') {
		// Masonry
		echo '<div class="overlay_content overlay-menu"><div class="overlay_item">';
		add_action( 'sama_woocommerce_masonry_loop_display_thumbnail_sale_flash', 'sama_woocommerce_show_product_loop_featured', 8 );
		add_action( 'sama_woocommerce_masonry_loop_display_thumbnail_sale_flash', 'woocommerce_show_product_loop_sale_flash', 10 );
		do_action('sama_woocommerce_masonry_loop_display_thumbnail_sale_flash');	
		if( ! empty( $majesty_options['shortcode_masonrry_loop'] ) )  {
			if( in_array( $majesty_options['shortcode_masonrry_loop'], $shop_loop_masonry ) ) {
				echo woocommerce_get_product_thumbnail( 'majesty-thumb-585' );
			} else {
				echo woocommerce_get_product_thumbnail( 'majesty-thumb-286' );
			}
			$majesty_options['shortcode_masonrry_loop'] ++;
		}
		echo '<div class="overlay"><div class="icons">';
	} else {
		// Grid
		echo '<div class="overlay_content overlay-menu"><div class="overlay_item">';
		add_action( 'sama_woocommerce_loop_display_thumbnail_sale_flash', 'sama_woocommerce_show_product_loop_featured', 8 );
		add_action( 'sama_woocommerce_loop_display_thumbnail_sale_flash', 'woocommerce_show_product_loop_sale_flash', 10 );
		add_action('sama_woocommerce_loop_display_thumbnail_sale_flash', 'woocommerce_template_loop_product_thumbnail', 10 );
		do_action('sama_woocommerce_loop_display_thumbnail_sale_flash');
		echo '<div class="overlay"><div class="icons">';
	}	
}
/**
 * Used in Woocommerce default loop to do some actions depend on layout display
 * For Layout Type List, Masonry, Grid
 *
 * @ since 1.0
 */
function sama_woocommerce_after_shop_loop_item() {
	// Wrap single porduct in loop
	global $majesty_options;
	$shortocde_layout = $majesty_options['shortcode_products_query'];
	$shop_layout = $majesty_options['shop_type'];
	$woo_default_cols = array( '4col', '3col', '3colwithsidebar');
	
	if( $shortocde_layout == 'list' ) {
		do_action('sama_woocommerce_loop_display_list_excerpt');
	} elseif( $shortocde_layout == 'list2' || ( ( is_shop() || is_product_category() || is_product_tag() ) && ( $shop_layout == 'list2' || $shop_layout == 'list2sidebar' ) ) ) {
		do_action('sama_woocommerce_loop_display_list_excerpt');
		do_action('sama_woocommerce_loop_display_list_add_to_cart');
	} elseif( (in_array( $shortocde_layout, $woo_default_cols )) || ( ( is_shop() || is_product_category() || is_product_tag() ) && in_array( $shop_layout, $woo_default_cols ) ) ) {
		do_action('sama_woocommerce_loop_display_list_excerpt');
		do_action('sama_woocommerce_loop_display_list_add_to_cart');
	} else {
		do_action('sama_woocommerce_loop_display_price_rate');
	}
}

/*
 * Used in Woocommerce Loop For Layout Type Masonry, Grid
 * Add Icon URL Link For Product
 *
 * @ since 1.0
 */
function sama_woocommerce_after_shop_loop_item_100() {
	global $majesty_options;
	$shortocde_layout = $majesty_options['shortcode_products_query'];
	$shop_layout = $majesty_options['shop_type'];
	$woo_default_cols = array( '4col', '3col', '3colwithsidebar');
	// Wrap single porduct in loop with icon link
	if( $shortocde_layout == 'list' || $shortocde_layout == 'list2' || ( ( is_shop() || is_product_category() || is_product_tag() ) && ( $shop_layout == 'list2' || $shop_layout == 'list2sidebar' ) )) {
	
	} elseif( in_array( $shortocde_layout, $woo_default_cols ) || ( ( is_shop() || is_product_category() || is_product_tag() ) && in_array( $shop_layout, $woo_default_cols ) ) ) {
	} else {
		// Add link icon to product
		echo '<a class="button btn btn-gold margin0" href="'.  esc_url( get_permalink() ) .'" title="'. the_title_attribute(array('echo'=>false)) .'"><i class="fa fa-link"></i></a>';
		echo '<a class="close-overlay hidden">x</a></div></div></div></div>';
	}
}

/*
 * Display Featured text for products
 *
 * @ since 1.0
 */
function sama_woocommerce_show_product_loop_featured() {
	global $product;
	$featured = get_post_meta( esc_attr( $product->id ), '_featured', true );
	if( $featured == 'yes' ) {
		echo '<span class="featured-product label red">' . esc_html__( 'Featured', 'theme-majesty' ) . '</span>';
	}
}

/*
 * Saleflash text
 *
 * @ since 1.0
 */
function sama_woocommerce_saleflash( $saleflash ) {
	return '<span class="onsale label">' . esc_html__( 'Sale!', 'theme-majesty' ) . '</span>';
}

/*
 * WooCommerce ShortCodes
 * Define Layout in Woocommerce shortcode is display
 * Change columns to be list, grid, masonry, masonry full width, grid full width
 * This filter inside woocommerce plugin class-wc-shortcodes.php
 * this variable used $majesty_options['shortcode_products_query'] && $majesty_options['shortcode_masonrry_loop'] = 1;
 * Declare Variable used in this functions
 *		sama_woocommerce_post_class()
 *		sama_woocommerce_before_shop_loop_item()
 *		sama_woocommerce_after_shop_loop_item()
 *		sama_woocommerce_after_shop_loop_item_100()
 * 
 * @ since 1.0
 */
function sama_woocommerce_shortcode_products_query( $args, $atts ) {
	global $majesty_options;
	$layout = $atts['columns'];
	$shortcode_layous = array( 'grid', 'list', 'masonry', 'masonryfullwidth', 'gridfullwidth', 'grid4col', 'list2', '4col', '3col');
	if( in_array( $layout, $shortcode_layous ) ) {
		$majesty_options['shortcode_products_query'] = $atts['columns'];
		$majesty_options['shortcode_masonrry_loop'] = 1;
		
	} else {
		$majesty_options['shortcode_products_query'] = 'grid';
	}
	return $args;
}

/*
 * WooCommerce ShortCodes
 * Product Categories
 * Change size of thumbnails for categories
 *
 * @ since 1.0
 */
function sama_woocommerce_subcategory_thumbnail( $category ) {
	$small_thumbnail_size  	= 'blog-majesty-thumb-450';
	$dimensions    			= wc_get_image_size( $small_thumbnail_size );
	$thumbnail_id  			= get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );

	if ( $thumbnail_id ) {
		$image = wp_get_attachment_image_src( $thumbnail_id, $small_thumbnail_size  );
		$image = $image[0];
	} else {
		$image = wc_placeholder_img_src();
	}

	if ( $image ) {
		// Prevent esc_url from breaking spaces in urls for image embeds
		// Ref: http://core.trac.wordpress.org/ticket/23605
		$image = str_replace( ' ', '%20', $image );

		echo '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( $category->name ) . '" class="img-responsive" />';
	}
}

/*
 * Single Products
---------------------------------------------------------*/
/*
 * wrap short description
 *
 * @ since 1.0
 */
function sama_woocommerce_short_description_wrap( $content ) {
	echo '<div class="desc-content">'. wp_kses_post($content) .'</div>'; 
}
/*
 * Change Large Thumbnail name in Single Product
 *
 * @ since 1.0
 */
function sama_custom_single_product_large_thumbnail_size( $thum_size ) {
	
	$product_layout = get_post_meta( get_the_ID(), '_sama_product_layout', true );
	if( $product_layout == 'leftsidebar2col' || $product_layout == 'rightsidebar2col' ) {
		$thum_size = 'majesty-thumb-555';
	}
	return $thum_size;
}
/*
 * Numner of Columns For Product Thumbnails
 *
 * @ since 1.0
 */
function sama_woocommerce_product_thumbnails_columns( $cols ) {
	return 4;
}
/*
 * Woo change gravatar size
 *
 * @ since 1.0
 */
function sama_woocommerce_review_gravatar_size( $size ) {
	return 80;
}

/*
 * wrap $args For woo comments
 *
 * @ since 1.0
 */
function sama_woocommerce_product_review_comment_form_args( $comment_form ) {
	
	$commenter = wp_get_current_commenter();
	$comment_form = array(
		'title_reply'          => have_comments() ? esc_html__( 'Add a review', 'woocommerce' ) : esc_html__( 'Be the first to review', 'woocommerce' ) . ' &ldquo;' . get_the_title() . '&rdquo;',
		'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'woocommerce' ),
		'comment_notes_before' => '',
		'comment_notes_after'  => '',
		'fields'               => array(
			'author' => '<div class="comment-form-author col-md-6 col-sm-6 col-sx-12">' .
						'<input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="'. esc_html__( 'NAME', 'theme-majesty' ) .' *" aria-required="true" /></div>',
			'email'  => '<div class="comment-form-email col-md-6 col-sm-6 col-sx-12">' .
						'<input class="form-control" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" placeholder="'. esc_html__( 'EMAIL', 'theme-majesty' ) .' *" aria-required="true" /></div>',
		),
		'label_submit'  => esc_html__( 'Submit', 'woocommerce' ),
		'logged_in_as'  => '',
		'comment_field' => ''
	);

	if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
		$comment_form['comment_field'] = '<p class="comment-form-rating"><label for="rating">' . esc_html__( 'Your Rating', 'woocommerce' ) .'</label><select name="rating" id="rating">
			<option value="">' . esc_html__( 'Rate&hellip;', 'woocommerce' ) . '</option>
			<option value="5">' . esc_html__( 'Perfect', 'woocommerce' ) . '</option>
			<option value="4">' . esc_html__( 'Good', 'woocommerce' ) . '</option>
			<option value="3">' . esc_html__( 'Average', 'woocommerce' ) . '</option>
			<option value="2">' . esc_html__( 'Not that bad', 'woocommerce' ) . '</option>
			<option value="1">' . esc_html__( 'Very Poor', 'woocommerce' ) . '</option>
		</select></p>';
	}

	$comment_form['comment_field'] .= '<div class="comment-form-comment col-md-12"><textarea id="comment" name="comment" placeholder="'. _x( 'YOUR COMMENT', 'noun', 'theme-majesty' ) .' *" aria-required="true"></textarea></div>';
	
	return $comment_form;
	
}

/*
 * Number OF Related products
 *
 * @ since 1.0
 */
function sama_woocommerce_related_products_args( $args ) {
	$args['posts_per_page'] = 3;
	return $args;
}

/*
 * Wrap Layout For Single Product
 *
 * @ since 1.0
 */
function sama_woocommerce_woocommerce_before_main_content() {
	global $majesty_options;
	
	if( is_product() ) {
		
		$product_layout = get_post_meta( get_the_ID(), '_sama_product_layout', true );	
		if( $product_layout == 'rightsidebar' || $product_layout == 'rightsidebar2col' ) {
			if( $product_layout == 'rightsidebar2col' ) {
				echo '<div class="single-menu padding-100"><div class="container"><div class="row"><div class="col-md-9 col-sm-12 woorightsidebar2col">';
			} else {
				echo '<div class="single-menu padding-100"><div class="container"><div class="row"><div class="col-md-9 col-sm-12 woorightsidebar">';
			}
		} elseif( $product_layout == 'leftsidebar' || $product_layout == 'leftsidebar2col' ) {
			echo '<div class="single-menu padding-100"><div class="container">';
			do_action('sama_get_woo_sidebar');
			if( $product_layout == 'rightsidebar2col' ) {
				echo '<div class="col-md-9 col-sm-12 wooleftsidebar2col">';
			} else {
				echo '<div class="col-md-9 col-sm-12 wooleftsidebar">';
			}
		} else {
			// Layout Full Width
			echo '<div class="single-menu padding-100 woofullwidth"><div class="container"><div class="row">';
		}
	} else {
		$shop_layout = $majesty_options['shop_type'];
		$sidebar_pos = $majesty_options['shop_sid_pos'];
		if( $shop_layout == 'fullwidth' || $shop_layout == 'list2' || $shop_layout == '4col' || $shop_layout == '3col' ) {
			if( $shop_layout == 'list2' ) {
				echo '<div class="section shop-full-width"><div class="container padding-100"><div class="row"><div class="shop-menu-list "><div class="woocommerce-menu-list-2">';
			} elseif ( $shop_layout == '4col' ) {
				echo '<div class="section shop-full-width"><div class="container padding-100"><div class="row"><div class="shop-columns4 "><div class="woocommerce-columns woocommerce-4columns">';
			} elseif ( $shop_layout == '3col' ) {
				echo '<div class="section shop-full-width"><div class="container padding-100"><div class="row"><div class="shop-columns3 "><div class="woocommerce-columns woocommerce-3columns">';
			} else {
				echo '<div class="section shop-full-width"><div class="container padding-100"><div class="row"><div class="menu_grid our-menu text-center"><div class="menu-type">';
			}
		} else {
			$css = '';
			if( $majesty_options['shop_type'] == 'shop-2col-withsidebar' ) {
				$css = ' shop-2col';
			} elseif( $majesty_options['shop_type'] == 'list2sidebar' ) {
				$css = ' shop-menu-list-1col';
			} elseif( $majesty_options['shop_type'] == '3colwithsidebar' ) {
				$css = ' woocommerce-columns woocommerce-3columns woocommerce-3columnssidebar';
			} 
			if( $sidebar_pos == 'left' ) {
				echo '<div class="section shop-with-sidebar'. esc_attr($css) .'"><div class="container padding-100"><div class="row">';
				do_action('sama_get_woo_sidebar');
				echo '<div class="menu_grid our-menu text-center col-md-9"><div class="menu-type">';
			} else {
				echo '<div class="section shop-with-sidebar'. esc_attr($css) .'"><div class="container padding-100"><div class="row"><div class="menu_grid our-menu text-center col-md-9"><div class="menu-type row">';
			}
			
		}
	}
}

function sama_woocommerce_woocommerce_after_main_content() {
	global $majesty_options;
	
	if( is_product() ) {
		$product_layout = get_post_meta( get_the_ID(), '_sama_product_layout', true );
		if( $product_layout == 'rightsidebar' || $product_layout == 'rightsidebar2col' ) {
			echo '</div>';
			do_action('sama_get_woo_sidebar');
			echo '</div></div></div>';
		} elseif( $product_layout == 'leftsidebar' || $product_layout == 'leftsidebar2col' ) {
			echo '</div></div></div>';
		}
		if( empty( $product_layout ) || $product_layout == 'fullwidth' ) {
			// Layout Full Width
			echo '</div></div></div>';
		}
		if( is_product() ) {
			do_action('sama_display_upsells_related_products');
		}
	} else {
		$shop_layout = $majesty_options['shop_type'];
		$sidebar_pos = $majesty_options['shop_sid_pos'];
		echo '</div></div>';
		if( ( $shop_layout != 'fullwidth' &&  $shop_layout != 'list2' && $shop_layout != '4col' && $shop_layout != '3col' ) && $sidebar_pos == 'right' ) {
			do_action('sama_get_woo_sidebar');
		}
		echo '</div></div></div>';
	}
}

/*
 * wrap images
 *
 * @ since 1.0
 */
function sama_woocommerce_before_single_product_summary_before_product_images() {
	$product_layout = get_post_meta( get_the_ID(), '_sama_product_layout', true );
	if( $product_layout == 'leftsidebar' || $product_layout == 'rightsidebar' ) {
		$css = 'col-md-12 images-block';
	} elseif( $product_layout == 'leftsidebar2col' || $product_layout == 'rightsidebar2col' ) {
		$css = 'col-md-6 col-sm-6 col-st-6 images-block';
	} else {
		$css = 'col-md-6 images-block';
	}
	echo '<div class="'. esc_attr( $css ) .'">';
	if( $product_layout == 'leftsidebar2col' || $product_layout == 'rightsidebar2col' ) {
		echo '<div class="images-container">';
	}
}

/*
 * End wrap product images and wrap oroduct info like title, price , excerpt, ..
 *
 * @ since 1.0
 */
function sama_woocommerce_before_single_product_summary_after_product_images() {
	$product_layout = get_post_meta( get_the_ID(), '_sama_product_layout', true );
	if( $product_layout == 'leftsidebar' || $product_layout == 'rightsidebar' ) {
		$css = 'col-md-12';
	} elseif( $product_layout == 'leftsidebar2col' || $product_layout == 'rightsidebar2col' ) {
		$css = 'col-md-6 col-sm-6 col-st-6';
	} else {
		$css = 'col-md-6';
	}
	echo '</div>';
	if( $product_layout == 'leftsidebar2col' || $product_layout == 'rightsidebar2col' ) {
		echo '</div>';
	}
	echo '<div class="menu-desc '. esc_attr($css) .'">';
}

/*
 * Add Css Clearfix after price
 *
 * @ since 1.0
 */
function sama_woocommerce_template_single_priceafter() {
	echo '<div class="clearfix"></div>';
}

/*
 * End Wrap before tabs
 *
 * @ since 1.0
 */
function sama_woocommerce_after_single_product_summary_before_tabs() {
	global $majesty_options;
	if( $majesty_options['shop_display_share_icon'] ) {
		get_template_part('tpl/shop-share-icon');
	}
	echo '</div>';
}

function sama_woocommerce_before_upsell_display() {
	global $product, $majesty_options;

	$upsells = $product->get_upsells();
	if ( sizeof( $upsells ) == 0 ) {
		return;
	} else {
		$majesty_options['product_has_upsells'] = true;
		echo '<div class="interest-in padding-100 text-center upsells-products white-bg-1"><div class="container"><div class="row"><div class="menu-type dark"><i class="icon-intro icon-large"></i>';
	}
}

function sama_woocommerce_after_upsell_display() {
	global $majesty_options;
	if( $majesty_options['product_has_upsells'] ) {
		echo '</div></div></div></div>';
	}
}

function sama_woocommerce_output_before_related_products() {
	global $product, $majesty_options;

	if ( empty( $product ) || ! $product->exists() ) {
		return;
	}
	$related = $product->get_related();
	if ( sizeof( $related ) == 0 ) {
		return;
	} else {
		$majesty_options['product_has_related'] = true;
		$css = ' white-bg-1';
		if( $majesty_options['product_has_upsells'] ) {
			$css = ' white-bg';
		}
		echo '<div class="interest-in padding-100 text-center related-products'. esc_attr( $css ) .'"><div class="container"><div class="row"><div class="menu-type dark"><i class="icon-intro icon-large"></i>';
	}
}

function sama_woocommerce_output_after_related_products() {
	global $majesty_options;
	
	if( $majesty_options['product_has_related'] ) {
		echo '</div></div></div></div>';
		$majesty_options['product_has_related'] = false;
	}
}

/*
 * Thumb Product Single Size Depend on OWLCarousel choosed from theme options
 *
 * @ since 1.0
 */
function sama_custom_single_product_small_thumbnail_size( $thum_size ) {
	global $majesty_options;
	if( $majesty_options['shop_display_single_images'] == 'owlcarousel' ) {
		if( $thum_size == 'shop_thumbnail' ) {
			$thum_size = 'majesty-slider-thumb';
		}
	}
	return $thum_size;
}

if ( ! function_exists( 'sama_display_single_product_images_thumbnails' ) ) {

	/**
	 * Output the product image before the single product summary.
	 *
	 * @subpackage	Product
	 */
	function sama_display_single_product_images_thumbnails() {
		get_template_part( 'includes/woocommerce/single-proudct-images/theme-product-image' );
	}
}

/*
 * End wrap for single product && Display Sidebar
 *
 * @ since 1.0
 */
function sama_before_woo_sidebar() {
	if( is_product() ) {
		$product_layout = get_post_meta( get_the_ID(), '_sama_product_layout', true );
		if( $product_layout == 'rightsidebar' ) {
			echo '</div>';
			do_action('sama_get_woo_sidebar');
			echo '</div></div></div></div>';
		} elseif( $product_layout == 'leftsidebar' ) {
			echo '</div></div></div></div></div>';
		}
		if( $product_layout != 'leftsidebar' || $product_layout != 'rightsidebar' ) {
			// Layout Full Width
			echo '</div></div></div>';
		}
		if( is_product() ) {
			do_action('sama_display_upsells_related_products');
		}
	}
}

function sama_woocommerce_get_custom_excerpt_display_list() {
	
	$excerpt_length = apply_filters('woocommerce_dislay_list_excerpt', 13);
	sama_woocommerce_get_custom_excerpt($excerpt_length);
}
function sama_woocommerce_get_custom_excerpt( $excerpt_length = 13 ) {
	global $post;
	if( isset( $excerpt_length) ) {
		$excerpt_length = $excerpt_length;
	} else {
		$excerpt_length = 13;
	}
	
	$content = $post->post_excerpt;
	if( empty ( $content) ) {
		$content = get_the_content();
	}
	$content = strip_shortcodes($content);
	$content = str_replace(']]>', ']]&gt;', $content);
	$content = strip_tags($content);
	$excerpt_length = absint( $excerpt_length );	
	$words = explode(' ', $content, $excerpt_length + 1);
	if( count( $words ) > $excerpt_length ) {
		array_pop($words);
		$content = implode(' ', $words);
	}
  $output = '<p>'. $content .'.</p>';
  echo wp_kses_post($output);
}

/**
 * Control Number Of products Display in shop page
 *
 * @ since 1.0
 */
function sama_loop_shop_per_page( $cols ) {
	global $majesty_options;
	
	return absint( $majesty_options['products_per_page'] );
}

function sama_woocommerce_template_loop_product_thumbnail() {
	echo woocommerce_get_product_thumbnail( 'majesty-shop-400' );
}

function sama_display_shop_categories() {
	global $majesty_options;
	
	$active = '';
	if( is_shop() ) {
		$active = ' activeFilter';
	}
	$txt_show_all = $majesty_options['shop_txt_link'];
	$args = array(
		'hide_empty' => false,
		'hierarchical' => 1,
		'child_of' => 0,
		'parent' => '',
		'pad_counts' => false,
	);
	$categories 	= get_terms( 'product_cat', $args );
	$shop_page_url 	= get_permalink( woocommerce_get_page_id( 'shop' ) );
	$filter_html 	= ' <div class="product-cats menu-bar text-center light"><ul class="clearfix menu-fillter">';
	if( ! empty( $txt_show_all )  ) {
		$filter_html   .= '<li class="'. esc_attr( $active ) .'"><a href="'. esc_url( $shop_page_url ) .'" class="text-center">'. esc_attr( $txt_show_all ) .'</a></li>';
	}
	foreach( $categories as $cat ) {
		$active = '';
		if( is_product_category( $cat->slug ) ) {
			$active = ' activeFilter';
		}
		$filter_html .= '<li class="'. esc_attr( $active ) .'"><a href="'. esc_url( get_term_link( $cat ) ) .'" class="text-center">'. esc_attr( $cat->name ) .'</a></li>';
	}
	$filter_html .= '</ul></div>';
	echo $filter_html;
}
/**
 * Change Default Woocommerce Thumbnails Size
 *
 * @ since 1.0
 */
function sama_woocommerce_image_dimensions() {
	global $pagenow;
 
	if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
		return;
	}

  	$catalog = array(
		'width' 	=> '450',	// px
		'height'	=> '450',	// px
		'crop'		=> 1 		// true
	);

	$single = array(
		'width' 	=> '808',	// px
		'height'	=> '406',	// px
		'crop'		=> 1 		// true
	);

	$thumbnail = array(
		'width' 	=> '60',	// px
		'height'	=> '60',	// px
		'crop'		=> 1 		// false
	);

	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}
}