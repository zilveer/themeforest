<?php

/*-------Woocommerce modifications----------*/

/* Contents:
	- Style & Scripts
	- Product columns filter
	- Custom catalog order
	- Woocommerce Main content wrapper
	- Changing 'add to cart' buttons text
	- Modifying Product Loop layout
    - Adding store page title to breadcrumbs wrapper
    - Adding advanced shop title
    - Modifying shop control buttons
    - Adding view all Link
    - Products per page filter
    - Adding list/grid view
    - Moving add_to_cart button
    - Adding new custom Badge
    - Modifying Pagination args
	- Modifying Single Product layout
    - Breadcrumbs
    - Images wrapper
    - Compare button moving
    - Wishlist button moving
    - Social shares
    - Tabs modification
    - Reviews avatar size
    - Up-sells Products
    - Related Products
    - Adding single product pagination
  - Checkout modification
    - Adding new mark-up
    - Add payment method heading
    - Custom chekout fields order output
	- Add meta box for activating extra gallery on product hover
	- Add meta box for adding custom Product Badge
	- Catalog Mode Function
	- Variables Products fix
	- Shop on Front Page
 */

if ( class_exists('Woocommerce') ) {

	// ----- Style & Scripts

	// Deactivating Woocommerce styles
	if ( version_compare( WOOCOMMERCE_VERSION, "2.1" ) >= 0 ) {
		add_filter( 'woocommerce_enqueue_styles', '__return_false' );
	} else {
		define( 'WOOCOMMERCE_USE_CSS', false );
	}

	// Adding new styles
	if ( ! function_exists( 'pt_woo_custom_style' ) ) {
		function pt_woo_custom_style() {
			wp_register_style( 'plumtree-woo-styles', get_template_directory_uri() . '/woo-styles.css', null, 1.0, 'screen' );
			wp_enqueue_style( 'plumtree-woo-styles' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'pt_woo_custom_style' );


	// ----- Product columns filter
	if ( ! function_exists( 'pt_loop_shop_columns' ) ) {
		function pt_loop_shop_columns(){
			$qty = (handy_get_option('store_columns') != '') ? handy_get_option('store_columns') : '3';
			return $qty;
		}
	}
	add_filter('loop_shop_columns', 'pt_loop_shop_columns');


	// ----- Custom catalog order
	if ( ! function_exists( 'pt_default_catalog_orderby' ) ) {
		function pt_default_catalog_orderby(){
			return 'date'; // Can also use title and price
		}
	}
	if ( !get_option('woocommerce_default_catalog_orderby') ) {
		add_filter('woocommerce_default_catalog_orderby', 'pt_default_catalog_orderby');
	}


	// ----- Woocommerce Main content wrapper
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

	if (!function_exists('pt_theme_wrapper_start')) {
		function pt_theme_wrapper_start() { ?>
			<main class="site-content<?php if (function_exists('pt_main_content_class')) pt_main_content_class(); ?>" itemscope="itemscope" itemprop="mainContentOfPage"><!-- Main content -->
		<?php }
	}

	if (!function_exists('pt_theme_wrapper_end')) {
		function pt_theme_wrapper_end() { ?>
			</main><!-- end of Main content -->
		<?php }
	}

	add_action('woocommerce_before_main_content', 'pt_theme_wrapper_start', 10);
	add_action('woocommerce_after_main_content', 'pt_theme_wrapper_end', 10);


	// ----- Changing 'add to cart' buttons text
	if ( ! function_exists( 'pt_custom_woocommerce_product_add_to_cart_text' ) ) {
		function pt_custom_woocommerce_product_add_to_cart_text() {
			global $product;
			$product_type = $product->product_type;
			switch ( $product_type ) {
				case 'external':
					$text = __('Buy product', 'plumtree');
					return '<i title="'.esc_attr($text).'" class="fa fa-shopping-cart">'.esc_attr($text).'</i>';
				break;
				case 'grouped':
					$text = __('View products', 'plumtree');
					return '<i title="'.esc_attr($text).'" class="fa fa-search">'.esc_attr($text).'</i>';
				break;
				case 'simple':
					$text = __('Add to cart', 'plumtree');
					if( $product->get_price() == 0 ||  $product->get_price() == '') {
						return  '<i title="'.esc_attr($text).'" class="fa fa-search">'.esc_attr($text).'</i>';
					} else {
						return  '<i title="'.esc_attr($text).'" class="fa fa-shopping-cart">'.esc_attr($text).'</i>';
					}
				break;
				case 'variable':
					$text = __('Select options', 'plumtree');
					return '<i title="'.esc_attr($text).'" class="fa fa-search">'.esc_attr($text).'</i>';
				break;
				default:
					$text = __('Read more', 'plumtree');
					return '<i title="'.esc_attr($text).'" class="fa fa-search">'.esc_attr($text).'</i>';
			}
		}
	}
	function pt_custom_woocommerce_is_purchasable( $purchasable, $product ){
	    if( $product->get_price() == 0 || $product->get_price() == '')
	        $purchasable = true;
	    return $purchasable;
	}
	add_filter( 'woocommerce_is_purchasable', 'pt_custom_woocommerce_is_purchasable', 10, 2 );
	add_filter( 'woocommerce_product_add_to_cart_text' , 'pt_custom_woocommerce_product_add_to_cart_text' );


	// ----- Modifying Product Loop layout
	remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

	// Adding store page title to breadcrumbs wrapper
	add_action( 'woocommerce_before_main_content', 'pt_store_title', 5 );
	if ( ! function_exists( 'pt_store_title' ) ) {
		function pt_store_title(){
			if ( (is_shop() || is_product_category() || is_product_tag()) && !is_front_page() ) {
				echo '<div class="col-md-6 col-sm-6 col-xs-12"><div class="page-title">'.esc_attr( get_the_title( get_option( 'woocommerce_shop_page_id' ) ) ).'</div></div>';
			}
		}
	}

	// Adding advanced shop title
	add_filter( 'woocommerce_page_title', 'custom_woocommerce_page_title');
	if ( ! function_exists( 'custom_woocommerce_page_title' ) ) {
		function custom_woocommerce_page_title( $page_title ) {
			if ( is_shop() ) {
				return __('All Products', 'plumtree');
			} else {
				return $page_title;
			}
		}
	}

	// Modifying shop control buttons
	add_action( 'woocommerce_before_shop_loop', 'pt_shop_controls_wrapper_start', 10 );
	if ( ! function_exists( 'pt_shop_controls_wrapper_start' ) ) {
		function pt_shop_controls_wrapper_start(){ ?>
			<div class="shop-controls-wrapper">
		<?php }
	}

	add_action( 'woocommerce_before_shop_loop', 'pt_shop_controls_wrapper_end', 40 );
	if ( ! function_exists( 'pt_shop_controls_wrapper_end' ) ) {
	function pt_shop_controls_wrapper_end(){ ?>
		</div>
	<?php }
	}

	// Adding view all Link
	add_action( 'woocommerce_before_shop_loop', 'pt_view_all_link', 25 );
	if ( ! function_exists( 'pt_view_all_link' ) ) {
		function pt_view_all_link(){
			global $wp_query;
			$paged    = max( 1, $wp_query->get( 'paged' ) );
			$per_page = $wp_query->get( 'posts_per_page' );
			$total    = $wp_query->found_posts;
			$first    = ( $per_page * $paged ) - $per_page + 1;
			$last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );

			/* Get vendor store pages */
			$vendor_shop = '';
			if ( class_exists('WCV_Vendors') ) {
				$vendor_shop = urldecode( get_query_var( 'vendor_shop' ) );
			}

			if ( $wp_query->max_num_pages > 1 && $vendor_shop == '' ) { ?>
				<a rel="nofollow" class="view-all" href="?showall=1"><?php _e('View All', 'plumtree'); ?></a>
			<?php }
			if( isset( $_GET['showall'] ) ){
				$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) ); ?>
			    <a rel="nofollow" class="view-all" href="<?php echo esc_url($shop_page_url); ?>"><?php _e('View Less', 'plumtree'); ?></a>
			<?php }
		}
	}

	// Special filters Sidebar
	if ( is_active_sidebar('filters-sidebar') && handy_get_option('filters_sidebar') == 'on' ) {
		add_action('woocommerce_before_shop_loop', 'pt_top_store_sidebar', 40);
	}
	if ( ! function_exists( 'pt_top_store_sidebar' ) ) {
		function pt_top_store_sidebar() { ?>
			<div id="filters-sidebar" class="widget-area">
				<span class="filter-head"><?php _e('Filters:', 'plumtree'); ?></span>
				<?php dynamic_sidebar('filters-sidebar'); ?>
			</div>
	 <?php }
 	}

	// Products per page filter
	if ( ! function_exists( 'pt_show_products_per_page' ) ) {
		function pt_show_products_per_page() {
			if( isset( $_GET['showall'] ) ){
				$qty = '-1';
			} else {
				$qty = (handy_get_option('store_per_page') != '') ? handy_get_option('store_per_page') : '6';
			}
			return $qty;
		}
	}
	add_filter('loop_shop_per_page', 'pt_show_products_per_page', 20 );

	// Adding list/grid view
	if ( ! function_exists( 'pt_view_switcher' ) ) {
		function pt_view_switcher() { ?>
			<div class="pt-view-switcher">
				<span class="pt-list<?php if(handy_get_option('default_list_type')=='list') echo ' active';?>" title="<?php _e('List View', 'plumtree'); ?>"><i class="custom-icon-list"></i></span>
				<span class="pt-grid<?php if(handy_get_option('default_list_type')=='grid') echo ' active';?>" title="<?php _e('Grid View', 'plumtree'); ?>"><i class="custom-icon-grid"></i></span>
			</div>
		<?php }
	}

	if ( (handy_get_option('list_grid_switcher')) === 'on' ) {
		add_action( 'woocommerce_before_shop_loop', 'pt_view_switcher', 35 );
	}

	// Moving add_to_cart button
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	if ( ! function_exists( 'pt_output_variables' ) ) {
		function pt_output_variables() {
	    	global $product;
			if( $product->product_type == "variable" && (is_shop() || is_product_category() || is_product_tag()) ){
				woocommerce_variable_add_to_cart();
				wc_get_template_part( 'loop/add-to-cart.php' );
			} else {
				wc_get_template_part( 'loop/add-to-cart.php' );
			}
		}
		add_action( 'woocommerce_after_shop_loop_item_title', 'pt_output_variables', 15 );
		add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 15 );
	}

	// Adding new custom Badge
	if ( ! function_exists( 'pt_output_custom_badge' ) ) {
		function pt_output_custom_badge(){
			global $post;
			$badge_text = get_post_meta( $post->ID, 'custom-badge-text' );
			$badge_class = get_post_meta( $post->ID, 'custom-badge-class' );
			if (isset($badge_class[0]) && ($badge_class[0] != '')) { $new_class = $badge_class[0]; } else { $new_class='custom-badge'; }
			if ( isset($badge_text[0]) && ( $badge_text[0] != '') ) { ?>
				<span class="<?php echo esc_attr($new_class); ?>"><?php echo esc_attr($badge_text[0]); ?></span>
			<?php }
		}
	}
	add_action( 'woocommerce_before_shop_loop_item_title', 'pt_output_custom_badge', 11 );

	// Modifying Pagination args
	if ( ! function_exists( 'pt_new_pagination_args' ) ) {
		function pt_new_pagination_args($args) {
			$args['prev_text'] = __( '<i class="fa fa-chevron-left"></i>', 'plumtree' );
			$args['next_text'] = __( '<i class="fa fa-chevron-right"></i>', 'plumtree' );
			return $args;
		}
	}
	add_filter('woocommerce_pagination_args','pt_new_pagination_args');

	// Inner Product wrapper
	function handy_inner_product_wrapper_start() {
			echo '<div class="inner-product-content fade-hover">';
	}
	function handy_inner_product_wrapper_end() {
			echo '</div>';
	}
	add_action('woocommerce_before_shop_loop_item', 'handy_inner_product_wrapper_start', 5);
	add_action('woocommerce_after_shop_loop_item', 'handy_inner_product_wrapper_end', 30);

	// Product extra Images
	function handy_product_extra_imgs_wrapper_start() {
		echo '<div class="product-img-wrapper">
						<div class="pt-extra-gallery-img images">
							<a href="'.get_the_permalink().'" title="'.__('View details', 'plumtree').'">';
	}
	function handy_product_extra_imgs_wrapper_end() {
		global $product, $post;
		echo '</a></div>';
		// Adding extra gallery if turned on
		$attachment_ids = $product->get_gallery_attachment_ids();
		$show_gallery = get_post_meta( $post->ID, 'pt_product_extra_gallery' );
		if ( $attachment_ids && ($show_gallery[0] == 'on') ) {
			$gallery_images = array();
			$count = 0;

			foreach ($attachment_ids as $attachment_id) {
				if ($count > 2 ) {
					continue;
				}
				$thumb = wp_get_attachment_image( $attachment_id, 'product-extra-gallery-thumb' );
				$link = wp_get_attachment_image_src( $attachment_id, 'shop_catalog' );
				$gallery_images[] = array(
					'thumb' => $thumb,
					'link' => $link[0],
				);
				$count++;
			}
		}
		if ( !empty($gallery_images) ) {
			echo '<ul class="pt-extra-gallery-thumbs">';
				foreach ($gallery_images as $gallery_image) {
					echo '<li><a href="'.$gallery_image['link'].'">'.$gallery_image['thumb'].'</a></li>';
				}
			echo '</ul>';
		}
		echo '</div>';
	}
	add_action('woocommerce_before_shop_loop_item_title', 'handy_product_extra_imgs_wrapper_start', 9);
	add_action('woocommerce_before_shop_loop_item_title', 'handy_product_extra_imgs_wrapper_end', 12);

	// Product Description wrapper
	function pt_link_to_product_start(){ ?>
		<a href="<?php esc_url(the_permalink()); ?>" class="link-to-product">
	<?php }
	function pt_link_to_product_end(){ ?>
		</a>
	<?php }
	add_action( 'woocommerce_shop_loop_item_title', 'pt_link_to_product_start', 9);
	add_action( 'woocommerce_shop_loop_item_title', 'pt_link_to_product_end', 11);

	function handy_product_description_wrapper_start() {
		echo '<div class="product-description-wrapper">';
	}
	add_action( 'woocommerce_shop_loop_item_title', 'handy_product_description_wrapper_start', 8);

	function handy_product_description() {
		global $post;

		if ( $post->post_excerpt ) : ?>
			<div class="short-description">
				<?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?>
			</div>
		<?php endif;
	}
	add_action( 'woocommerce_shop_loop_item_title', 'handy_product_description', 12);

	function handy_product_description_wrapper_end() {
		echo '</div>';
	}
	add_action( 'woocommerce_after_shop_loop_item_title', 'handy_product_description_wrapper_end', 35);

	// Product additional buttons wrapper
	function handy_additional_btns_wrapper_start() {
			echo '<div class="additional-buttons">';
	}
	function handy_additional_btns_wrapper_end() {
			echo '</div>';
	}
	function handy_add_wishlist_btn() {
		if ( ( class_exists( 'YITH_WCWL_Shortcode' ) ) && ( get_option('yith_wcwl_enabled') == true ) ) {
			$atts = array(
						'per_page' => 10,
						'pagination' => 'no',
				);
			echo YITH_WCWL_Shortcode::add_to_wishlist($atts);
		}
	}
	add_action( 'woocommerce_after_shop_loop_item', 'handy_additional_btns_wrapper_start', 5);
	add_action( 'woocommerce_after_shop_loop_item', 'handy_add_wishlist_btn', 20);
	add_action( 'woocommerce_after_shop_loop_item', 'handy_additional_btns_wrapper_end', 25);




	// ----- 8. Modifying Single Product layout

	// Breadcrumbs
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

	if ( (handy_get_option('store_breadcrumbs')) === 'on' ) {
		add_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 6 );
	}

	if ( ! function_exists( 'pt_breadcrumbs_wrap_begin' ) ) {
		function pt_breadcrumbs_wrap_begin(){ ?>
			<div class="breadcrumbs-wrapper col-md-12 col-sm-12 col-xs-12"><div class="container"><div class="row">
		<?php }
	}
	add_action( 'woocommerce_before_main_content', 'pt_breadcrumbs_wrap_begin', 4 );

	if ( ! function_exists( 'pt_breadcrumbs_wrap_end' ) ) {
		function pt_breadcrumbs_wrap_end(){ ?>
			</div></div></div>
		<?php }
	}
	add_action( 'woocommerce_before_main_content', 'pt_breadcrumbs_wrap_end', 7 );

	add_filter( 'woocommerce_breadcrumb_defaults', 'pt_custom_breadcrumbs' );
	if ( ! function_exists( 'pt_custom_breadcrumbs' ) ) {
		function pt_custom_breadcrumbs() {
			return array(
				'delimiter' => '<span> &#47; </span>',
				'wrap_before' => '<div class="col-md-6 col-sm-6 col-xs-12"><nav class="woocommerce-breadcrumb" itemprop="breadcrumb">',
				'wrap_after' => '</nav></div>',
				'before' => '',
				'after' => '',
				'home' => _x( 'Home', 'breadcrumb', 'plumtree' ),
			);
		}
	}

	// Images wrapper
	if ( ! function_exists( 'pt_images_wrapper_start' ) ) {
		function pt_images_wrapper_start(){ ?>
			<div class="images-wrapper">
		<?php }
	}

	if ( ! function_exists( 'pt_images_wrapper_end' ) ) {
		function pt_images_wrapper_end(){ ?>
			</div>
		<?php }
	}
	add_action('woocommerce_before_single_product_summary', 'pt_images_wrapper_start', 5);
	add_action('woocommerce_before_single_product_summary', 'pt_images_wrapper_end', 25);

	// Compare button moving
	if( ( class_exists('YITH_Woocompare_Frontend') ) && ( get_option('yith_woocompare_compare_button_in_product_page') == 'yes' ) ) {
		remove_action( 'woocommerce_single_product_summary', array( $yith_woocompare->obj, 'add_compare_link'), 35 );
		add_action( 'woocommerce_single_product_summary', array( $yith_woocompare->obj, 'add_compare_link'), 24  );
	}

	// Wishlist button moving
	if ( ( class_exists( 'YITH_WCWL_Shortcode' ) ) && ( get_option('yith_wcwl_enabled') == true ) && ( get_option('yith_wcwl_button_position') == 'shortcode' ) ) {
		function output_wishlist_button() {
			echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
		}
		add_action( 'woocommerce_single_product_summary', 'output_wishlist_button', 25  );
	}

	// Social shares
	if (handy_get_option('use_pt_shares_for_product')=='on') {
		remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
		add_action('woocommerce_single_product_summary', 'pt_share_buttons_output', 50);
	}

	// Tabs modification
	if ( ! function_exists( 'pt_custom_product_tabs' ) ) {
		function pt_custom_product_tabs( $tabs ) {
			global $post, $product;
			$product_content = $post->post_content;
			if ($product_content && $product_content!=='') {
				$tabs['description']['priority'] = 10;
			} else {
				unset( $tabs['description'] );
			}
			if( $product->has_attributes() || $product->has_dimensions() || $product->has_weight() ) {
				$tabs['additional_information']['title'] = __( 'Specification', 'plumtree' );
				$tabs['additional_information']['priority'] = 20;
			} else {
				unset( $tabs['additional_information'] );
			}
			return $tabs;
		}
	}
	add_filter( 'woocommerce_product_tabs', 'pt_custom_product_tabs', 98 );

	// Reviews avatar size
	if ( ! function_exists( 'pt_custom_review_gravatar' ) ) {
		function pt_custom_review_gravatar() {
			return '70';
		}
	}
	add_filter('woocommerce_review_gravatar_size', 'pt_custom_review_gravatar');

	// Up-sells Products
	remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
	if (handy_get_option('show_upsells')=='on') {
		if ( ! function_exists( 'pt_output_upsells' ) ) {
			function pt_output_upsells() {
				$upsell_qty = handy_get_option('upsells_qty');
				woocommerce_upsell_display( $upsell_qty, $upsell_qty ); // Display $per_page products in $cols
			}
		}
		add_action('woocommerce_after_single_product_summary', 'pt_output_upsells', 20);
	}

	// Related Products
	remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

	if ( ! function_exists( 'pt_output_related_products' ) ) {
		function pt_output_related_products($args) {
			$related_qty = handy_get_option('related_products_qty');
			$args['posts_per_page'] = $related_qty; // related products
			$args['columns'] = $related_qty; // arranged in columns
			return $args;
		}
	}
	add_filter( 'woocommerce_output_related_products_args', 'pt_output_related_products' );

	if (handy_get_option('show_related_products')=='on') {
		add_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 30);
	}

	// Adding single product pagination
	if ( handy_get_option('product_pagination') === 'on' ) {
		if ( ! function_exists( 'pt_single_product_pagi' ) ) {
			function pt_single_product_pagi(){
				if(is_product()) :
				?>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<nav class="navigation single-product-navi" role="navigation">
					<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'plumtree' ); ?></h1>
						<div class="nav-links">
							<?php previous_post_link('%link', '<i class="fa fa-angle-left"></i>&nbsp;&nbsp;&nbsp;'.__('Previous Product', 'plumtree')); ?>
							<?php next_post_link('%link', __('Next Product', 'plumtree').'&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-right"></i>'); ?>
						</div>
				</nav>
			</div>
				<?php
				endif;
			}
		}
		add_action( 'woocommerce_before_main_content', 'pt_single_product_pagi', 5 );
	}


	// ----- Checkout modification
	// Adding new mark-up
	if ( ! function_exists( 'pt_checkout_wrapper_start' ) ) {
		function pt_checkout_wrapper_start(){
			if ( class_exists('WooCommerce_Germanized') ) {
				echo '<div class="order-wrapper germanized">';
			} else {
				echo '<div class="order-wrapper">';
			}
		}
	}
	add_action( 'woocommerce_checkout_after_customer_details', 'pt_checkout_wrapper_start');

	if ( ! function_exists( 'pt_checkout_wrapper_end' ) ) {
		function pt_checkout_wrapper_end(){
			echo '</div>';
		}
	}
	add_action( 'woocommerce_checkout_after_order_review', 'pt_checkout_wrapper_end');

	// Add payment method heading
	if ( ! function_exists( 'pt_payments_heading' ) ) {
		function pt_payments_heading(){
			echo '<h3 id="payment_heading">'.__('Payment Methods', 'plumtree').'</h3>';
		}
	}
	add_action( 'woocommerce_review_order_before_payment', 'pt_payments_heading');

	// Custom chekout fields order output
	if ( ! function_exists( 'pt_default_address_fields' ) ) {
		function pt_default_address_fields( $fields ) {
		    $fields = array(
				'first_name' => array(
					'label'    => __( 'First Name', 'plumtree' ),
					'required' => true,
					'class'    => array( 'form-row-wide' ),
				),
				'last_name' => array(
					'label'    => __( 'Last Name', 'plumtree' ),
					'required' => true,
					'class'    => array( 'form-row-wide' ),
					'clear'    => true
				),
				'company' => array(
					'label' => __( 'Company Name', 'plumtree' ),
					'class' => array( 'form-row-wide' ),
				),
				'address_1' => array(
					'label'       => __( 'Address', 'plumtree' ),
					'placeholder' => _x( 'Street address', 'placeholder', 'plumtree' ),
					'required'    => true,
					'class'       => array( 'form-row-wide', 'address-field' )
				),
				'address_2' => array(
					'label'       => __( 'Additional address info', 'plumtree' ),
					'placeholder' => _x( 'Apartment, suite, unit etc. (optional)', 'placeholder', 'plumtree' ),
					'class'       => array( 'form-row-wide', 'address-field' ),
					'required'    => false,
					'clear'    	  => true
				),
				'country' => array(
					'type'     => 'country',
					'label'    => __( 'Country', 'plumtree' ),
					'required' => true,
					'class'    => array( 'form-row-wide', 'address-field', 'update_totals_on_change' ),
				),
				'city' => array(
					'label'       => __( 'Town / City', 'plumtree' ),
					'placeholder' => __( 'Town / City', 'plumtree' ),
					'required'    => true,
					'class'       => array( 'form-row-wide', 'address-field' )
				),
				'state' => array(
					'type'        => 'state',
					'label'       => __( 'State / County', 'plumtree' ),
					'placeholder' => __( 'State / County', 'plumtree' ),
					'required'    => true,
					'class'       => array( 'form-row-wide', 'address-field' ),
					'validate'    => array( 'state' )
				),
				'postcode' => array(
					'label'       => __( 'Postcode / Zip', 'plumtree' ),
					'placeholder' => __( 'Postcode / Zip', 'plumtree' ),
					'required'    => true,
					'class'       => array( 'form-row-wide', 'address-field' ),
					'clear'       => true,
					'validate'    => array( 'postcode' )
				),
			);
			return $fields;
		}
	}
	add_filter( 'woocommerce_default_address_fields' , 'pt_default_address_fields' );


	// ----- Add meta box for activating extra gallery on product hover

	add_action( 'add_meta_boxes', 'pt_product_extra_gallery_metabox' );
	add_action( 'save_post', 'pt_product_extra_gallery_save' );

	if ( ! function_exists( 'pt_product_extra_gallery_metabox' ) ) {
		function pt_product_extra_gallery_metabox() {
		    add_meta_box( 'product_extra_gallery', 'Product Extra Gallery', 'pt_product_extra_gallery_call', 'product', 'side', 'default' );
		}
	}

	if ( ! function_exists( 'pt_product_extra_gallery_call' ) ) {
		function pt_product_extra_gallery_call($post) {
			global $post;
			wp_nonce_field( 'pt_product_extra_gallery_call', 'pt_product_extra_gallery_nonce' );
			// Get previous meta data
			$values = get_post_custom($post->ID);
			$check = isset( $values['pt_product_extra_gallery'] ) ? esc_attr( $values['pt_product_extra_gallery'][0] ) : 'off';
			?>
			<div class="product-extra-gallery">
				<label for="pt_product_extra_gallery"><input type="checkbox" name="pt_product_extra_gallery" id="pt_product_extra_gallery" <?php checked( $check, 'on' ); ?> /><?php _e( 'Use extra gallery for this product', 'plumtree' ) ?></label>
				<p><?php _e( 'Check the checkbox if you want to use extra gallery (appeared on hover) for this product. The first 3 images of the product gallery are going to be used for gallery.', 'plumtree'); ?></p>
			</div>
			<?php
		}
	}

	// When the post is saved, saves our custom data
	if ( ! function_exists( 'pt_product_extra_gallery_save' ) ) {
		function pt_product_extra_gallery_save( $post_id ) {
		    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		            return;

		    if ( ( isset ( $_POST['pt_product_extra_gallery_nonce'] ) ) && ( ! wp_verify_nonce( $_POST['pt_product_extra_gallery_nonce'], 'pt_product_extra_gallery_call' ) ) )
		            return;

		    if ( ! current_user_can( 'edit_post', $post_id ) ) {
		            return;
		    }

		    // OK, we're authenticated: we need to find and save the data
		    $chk = isset( $_POST['pt_product_extra_gallery'] ) && $_POST['pt_product_extra_gallery'] ? 'on' : 'off';
			update_post_meta( $post_id, 'pt_product_extra_gallery', $chk );
		}
	}


	// ----- Add meta box for adding custom Product Badge

	add_action( 'add_meta_boxes', 'pt_product_custom_badge_metabox' );
	add_action( 'save_post', 'pt_product_custom_badge_save' );

	if ( ! function_exists( 'pt_product_custom_badge_metabox' ) ) {
		function pt_product_custom_badge_metabox() {
		    add_meta_box( 'product_custom_badge', 'Product Custom Badge', 'pt_product_custom_badge_call', 'product', 'side', 'default' );
		}
	}

	if ( ! function_exists( 'pt_product_custom_badge_call' ) ) {
		function pt_product_custom_badge_call($post) {
			global $post;
			wp_nonce_field( 'pt_product_custom_badge_call', 'pt_product_custom_badge_nonce' );
			// Get previous meta data
			$stored_meta = get_post_meta( $post->ID );
			?>
			<div class="product-custom-badge">
				<p><?php _e( 'This block should be used for adding custom "Badge/Label". Below you can enter your own text for the label & add additional class for further CSS styling', 'plumtree'); ?></p>
			    <p>
			        <label for="custom-badge-text"><?php _e( 'Label Text', 'plumtree' )?></label>
			        <input type="text" name="custom-badge-text" id="custom-badge-text" value="<?php if ( isset ( $stored_meta['custom-badge-text'] ) ) echo esc_attr($stored_meta['custom-badge-text'][0]); ?>" />
			    </p>
			    <p>
			        <label for="custom-badge-class"><?php _e( 'Label Class', 'plumtree' )?></label>
			        <input type="text" name="custom-badge-class" id="custom-badge-class" value="<?php if ( isset ( $stored_meta['custom-badge-class'] ) ) echo esc_attr($stored_meta['custom-badge-class'][0]); ?>" />
			    </p>
			</div>
			<?php
		}
	}

	// When the post is saved, saves our custom data
	if ( ! function_exists( 'pt_product_custom_badge_save' ) ) {
		function pt_product_custom_badge_save( $post_id ) {
		    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		            return;

		    if ( ( isset ( $_POST['pt_product_custom_badge_nonce'] ) ) && ( ! wp_verify_nonce( $_POST['pt_product_custom_badge_nonce'], 'pt_product_custom_badge_call' ) ) )
		            return;

		    if ( ! current_user_can( 'edit_post', $post_id ) ) {
		            return;
		    }

		    // OK, we're authenticated: we need to find and save the data
		    if( isset( $_POST[ 'custom-badge-text' ] ) ) {
				update_post_meta( $post_id, 'custom-badge-text', sanitize_text_field( $_POST[ 'custom-badge-text' ] ) );
			}
		    if( isset( $_POST[ 'custom-badge-class' ] ) ) {
				update_post_meta( $post_id, 'custom-badge-class', sanitize_text_field( $_POST[ 'custom-badge-class' ] ) );
			}
		}
	}


	// ----- Catalog Mode Function
	if (handy_get_option('catalog_mode') == 'on') {
		remove_action( 'woocommerce_after_shop_loop_item_title', 'pt_output_variables', 15 );
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 15 );
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
	}


	// ----- Variables Products fix
	// Display Price For Variable Product With Same Variations Prices
	add_filter('woocommerce_available_variation', 'pt_variables_price_fix', 10, 3);

	if ( ! function_exists( 'pt_variables_price_fix' ) ) {
		function pt_variables_price_fix( $value, $object = null, $variation = null ) {
			if ($value['price_html'] == '') {
				$value['price_html'] = '<span class="price">' . $variation->get_price_html() . '</span>';
			}
			return $value;
		}
	}


	// ----- Shop on front page functions
	if (!function_exists('pt_front_page_shop_output')) {

		function pt_front_page_shop_output() {
			remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );

			// Adding content area if front page
			function pt_output_shop_description() {
				if ( is_post_type_archive( 'product' ) ) {
					$shop_page   = get_post( wc_get_page_id( 'shop' ) );
					if ( $shop_page ) {
						$description = wc_format_content( $shop_page->post_content );
						if ( $description ) {
							echo '<div class="entry-content">' . $description . '</div>';
						}
					}
				}
			}
			add_action( 'woocommerce_archive_description', 'pt_output_shop_description', 10 );

			// Removing controls if shop = front_page
			if ( is_post_type_archive( 'product' ) && is_front_page() ) {
				remove_action( 'woocommerce_before_main_content', 'pt_breadcrumbs_wrap_begin', 4 );
				remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 6 );
				remove_action( 'woocommerce_before_main_content', 'pt_breadcrumbs_wrap_end', 7 );
			}

			// new title position if shop = front_page
			function pt_new_title_pos() {
				if ( apply_filters( 'woocommerce_show_page_title', true ) && is_front_page() ) : ?>
					<h1 class="page-title shop-front"><?php woocommerce_page_title(); ?></h1>
				<?php endif;
			}
			add_action('woocommerce_before_shop_loop', 'pt_new_title_pos', 1);
		}
	}

	if ( handy_get_option('front_page_shop') === 'on') {
		add_action('woocommerce_before_main_content','pt_front_page_shop_output', 1);
	}


	/* WooCommerce Germanized fixes */
	if (class_exists('WooCommerce_Germanized')) {
		remove_action( 'woocommerce_review_order_before_payment', 'woocommerce_gzd_template_checkout_payment_title' );
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_gzd_template_single_tax_info', wc_gzd_get_hook_priority( 'loop_tax_info' ) );
		add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_gzd_template_single_tax_info', 20 );
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_gzd_template_single_shipping_costs_info', wc_gzd_get_hook_priority( 'loop_shipping_costs_info' ) );
		add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_gzd_template_single_shipping_costs_info', 25 );
	}

} // end of file
