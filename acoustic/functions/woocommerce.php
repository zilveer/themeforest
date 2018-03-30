<?php if ( woocommerce_enabled() ):

	// Skip the default woocommerce styling and use our boilerplate.
	if ( !function_exists('ci_deregister_woocommerce_styles') ) {
		function ci_deregister_woocommerce_styles()  {
			wp_deregister_style('woocommerce-general');
		}
		add_filter('woocommerce_enqueue_styles', 'ci_deregister_woocommerce_styles');
	}

	add_action( 'wp_enqueue_scripts', 'ci_woocommerce_boilerplate', 9 );
	if( !function_exists('ci_woocommerce_boilerplate') ):
	function ci_woocommerce_boilerplate() {
		// Skip the default woocommerce styling and use our boilerplate.
		wp_enqueue_style('ci-woocommerce', get_child_or_parent_file_uri('/css/ci_woocommerce.css'));
	}
	endif;

	// Declares WooCommerce support
	add_action( 'after_setup_theme', 'woocommerce_support' );
	function woocommerce_support() {
		add_theme_support( 'woocommerce' );
	}

	// Override the related products function so that it outputs the right number of products and columns
	if ( !function_exists( 'woocommerce_output_related_products' ) ):
	function woocommerce_output_related_products() {
		$args = array(
			'posts_per_page' => 3,
			'columns'        => 4,
			'orderby'        => 'rand'
		);
		woocommerce_related_products( $args );
	}
	endif;

	// Change number of columns in product loop
	add_filter('loop_shop_columns', 'ci_loop_show_columns');
	if( !function_exists('ci_loop_show_columns') ):
	function ci_loop_show_columns() {
		return 3;
	}
	endif;


	//
	// Unhook the following functions as they are either not needed, or needed in a place where a hook is not available
	// therefore called directly from the template files.
	//

	// Remove result count, e.g. "Showing 1–10 of 22 results"
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

	// Remove result cound and catalog ordering hooks. We call them manually.
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

	// Remove breadcrumbs
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

	// Remove the link that surrounds the product in shop loop.
	remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

	// Move thumbnail to woocommerce_before_shop_loop_item hook
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
	add_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_thumbnail', 10 );

	// Move price after the thumbnail.
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
	add_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_price', 10 );

	// We don't need the Rating.
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

	// Show categories after the title.
	add_action( 'woocommerce_after_shop_loop_item_title', 'ci_woocommerce_after_shop_loop_item_title_categories', 5 );

	// Move the Add to Cart button after the categories.
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 10 );

	// We don't need the coupon form in the checkout page. It's included in the cart page.
	remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );

	// Move cross sell display from collaterals to right after the table.
	remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
	add_action( 'woocommerce_after_cart_table', 'woocommerce_cross_sell_display' );


	if ( ! function_exists( 'woocommerce_template_loop_product_title' ) ):
	function woocommerce_template_loop_product_title() {
		?>
		<h4 itemprop="name" class="product-title pair-title">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h4>
		<?php
	}
	endif;


	if( ! function_exists( 'ci_woocommerce_after_shop_loop_item_title_categories' ) ):
	function ci_woocommerce_after_shop_loop_item_title_categories() {
		?>
		<p class="pair-sub">
			<?php echo get_the_term_list( get_the_ID(), 'product_cat', '', ', ', '' ); ?>
		</p>
		<?php
	}
	endif;

	// Override the product thumbnail hooked function, as we just want change its output.
	if ( !function_exists( 'woocommerce_template_loop_product_thumbnail' ) ):
	function woocommerce_template_loop_product_thumbnail() {
		?>
		<div class="product-thumb event-flyer gradient">
			<a href="<?php the_permalink(); ?>">
				<?php echo woocommerce_get_product_thumbnail(); ?>
			</a>
		</div>
		<?php
	}
	endif;


	// Replace the default placeholder image with ours (it has the right dimentions).
	add_filter('woocommerce_placeholder_img_src', 'ci_change_woocommerce_placeholder_img_src');
	if ( !function_exists( 'ci_change_woocommerce_placeholder_img_src' ) ):
	function ci_change_woocommerce_placeholder_img_src( $src ) {
		return get_child_or_parent_file_uri('/images/placeholder.png');
	}
	endif;
	
	add_filter('woocommerce_placeholder_img', 'ci_woocommerce_placeholder_img');
	if ( !function_exists( 'ci_woocommerce_placeholder_img' ) ):
	function ci_woocommerce_placeholder_img( $html ) {
		$html = preg_replace('/width="[[:alnum:]%]*"/', '', $html);
		$html = preg_replace('/height="[[:alnum:]%]*"/', '', $html);
		return $html;
	}
	endif;

	// Allow users to view more products on shop pages.
	add_filter( 'loop_shop_per_page', 'ci_woocommerce_loop_shop_per_page', 20 );
	if ( !function_exists( 'ci_woocommerce_loop_shop_per_page' ) ):
	function ci_woocommerce_loop_shop_per_page( $num ) {
		$custom = intval( ci_setting( 'products_per_page' ) );
		if ( $custom === - 1 || $custom > 0 ) {
			return $custom;
		}

		return $num;
	}
	endif;

endif; // woocommerce_enabled()