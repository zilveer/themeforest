<?php
/**
 * Woocommerce functions
 */

add_action('after_setup_theme', 'tmm_add_wc_theme_support');

function tmm_add_wc_theme_support() {
	add_theme_support( 'woocommerce' );
}

/* ---------------------------------------------------------------------- */
/* 	Header Cart Widget
/* ---------------------------------------------------------------------- */

/* Check either display cart widget in nav menu or not */
if ( !function_exists('tmm_show_header_cart') ) {
	function tmm_show_header_cart() {
		if (TMM::get_option('tmm_cart_widget_insert') === '1'){
			return true;
		}
		return false;
	}
}

/* Update cart widget in nav menu when products are added to the cart via AJAX */
if ( !function_exists('tmm_add_to_cart_fragment') ) {
	function tmm_add_to_cart_fragment( $fragments ) {
		global $woocommerce;

		$fragments['span.cart-products-count'] = '<span class="cart-products-count">' . $woocommerce->cart->cart_contents_count . '</span>';

		return $fragments;
	}
}

add_filter('add_to_cart_fragments', 'tmm_add_to_cart_fragment');

/* ---------------------------------------------------------------------- */
/* 	Add Meta Box
/* ---------------------------------------------------------------------- */

add_action('add_meta_boxes', 'tmm_wc_add_meta_boxes');

function tmm_wc_add_meta_boxes() {
	add_meta_box('tmm_product_options', __('Custom Product Options', 'cardealer'), 'tmm_product_options_meta_box', 'product', 'side', 'low');
}

if ( !function_exists('tmm_product_options_meta_box') ) {
	function tmm_product_options_meta_box() {
		global $post;
		$custom = get_post_custom($post->ID);
		$page_sidebar_position = (isset($custom['page_sidebar_position'][0])) ? $custom['page_sidebar_position'][0] : TMM::get_option('product_sidebar_position');
		include(TMM_THEME_PATH . '/woocommerce/tmm_templates/product_sidebar_position_mb.php');
	}
}

/* ---------------------------------------------------------------------- */
/* 	Retrieve Shop Page id
/* ---------------------------------------------------------------------- */

if ( !function_exists('tmm_wc_shop_page_id') ) {
	function tmm_wc_shop_page_id( $post_id ) {

		if (is_shop()) {
			$shop_page_id = wc_get_page_id('shop');

			if ($shop_page_id) {
				return $shop_page_id;
			}
		}

		return $post_id;
	}
}

add_filter('tmm_post_id', 'tmm_wc_shop_page_id');

/* ---------------------------------------------------------------------- */
/* 	On Post Save
/* ---------------------------------------------------------------------- */

add_action('save_post', 'tmm_wc_save_post');

function tmm_wc_save_post() {
	global $post;
	if(!empty($post) && $post->post_type === 'product' && isset($_POST['page_sidebar_position'])){
		update_post_meta($post->ID, 'page_sidebar_position', $_POST['page_sidebar_position']);
	}
}

/* ---------------------------------------------------------------------- */
/* 	Enqueue Scripts
/* ---------------------------------------------------------------------- */

if ( !function_exists('tmm_enqueue_woo_scripts') ) {
	function tmm_enqueue_woo_scripts() {
       
        if (TMM::get_option('def_woo_styles')==='0'){
            wp_enqueue_style('tmm_woo', TMM_THEME_URI . '/woocommerce/assets/css/woocommerce.css');
            wp_enqueue_style('tmm_woo_layout', TMM_THEME_URI . '/woocommerce/assets/css/woocommerce-layout.css');
//            wp_enqueue_style('tmm_woo_smallscr', TMM_THEME_URI . '/woocommerce/assets/css/woocommerce-smallscreen.css');
        }

		wp_dequeue_script('wc-add-to-cart');
		wp_deregister_script('wc-add-to-cart');
		wp_enqueue_script( 'wc-add-to-cart', TMM_THEME_URI . '/woocommerce/assets/js/frontend/add-to-cart.js' , array( 'jquery' ), false, true );

	}

    function tmm_remove_woo_scripts(){
    
        if (TMM::get_option('def_woo_styles') === '0'){
            add_filter('woocommerce_enqueue_styles', '__return_false');
        }else{
            add_filter('woocommerce_template_path', '__return_false');
        } 
        
    }
}

add_action('wp_enqueue_scripts', 'tmm_enqueue_woo_scripts');

/* Disable Woocommerce General Styles */
add_action('init', 'tmm_remove_woo_scripts');

/* ---------------------------------------------------------------------- */
/* 	Set Image Sizes
/* ---------------------------------------------------------------------- */

if ( !function_exists('tmm_set_woocommerce_image_sizes') ) {
	function tmm_set_woocommerce_image_sizes() {

		$catalog = array(
			'width' 	=> '460',
			'height'	=> '290',
			'crop'		=> 1
		);

		$single = array(
			'width' 	=> '550',
			'height'	=> '600',
			'crop'		=> 1
		);

		$thumbnail = array(
			'width' 	=> '170',
			'height'	=> '190',
			'crop'		=> 1
		);

		update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
		update_option( 'shop_single_image_size', $single ); 		// Single product image
		update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
	}
}

if (!TMM::get_option('tmm_set_wc_image_sizes')) {
	add_action('admin_init', 'tmm_set_woocommerce_image_sizes', 1);
	TMM::update_option('tmm_set_wc_image_sizes', true);
}

/* ---------------------------------------------------------------------- */
/* 	Set Image Placeholder
/* ---------------------------------------------------------------------- */

if ( !function_exists('tmm_set_woocommerce_image_placeholder') ) {
	function tmm_set_woocommerce_image_placeholder() {

		add_filter('woocommerce_placeholder_img_src', 'tmm_wc_woocommerce_placeholder_img_src', 10);

		function tmm_wc_woocommerce_placeholder_img_src() {
			$size = 'shop_thumbnail_image_size';
			if(is_product_category()){
				$size = 'shop_catalog_image_size';
			}
			if(is_product()){
				$size = 'shop_single_image_size';
			}

			$image_size = get_option($size);
			$w = $image_size['width'];
			$h = $image_size['height'];

			return 'http://placehold.it/' . $w . 'x' . $h . '&amp;text=NO IMAGE';
		}

		add_filter('woocommerce_placeholder_img', 'tmm_wc_woocommerce_placeholder_img' , 10 , 3);

		function tmm_wc_woocommerce_placeholder_img($src, $size, $dimensions) {
			return '<img data-size="'.$size.'" src="http://placehold.it/' . esc_attr( $dimensions['width'] ) . 'x' . esc_attr( $dimensions['height'] ) . '&text=NO IMAGE" alt="' . __( 'Placeholder', 'cardealer' ) . '" width="' . esc_attr( $dimensions['width'] ) . '" class="woocommerce-placeholder wp-post-image" height="' . esc_attr( $dimensions['height'] ) . '" />';
		}

		add_filter('post_thumbnail_html', 'tmm_wc_post_thumbnail_html', 10 , 5);

		function tmm_wc_post_thumbnail_html($html, $post_id, $post_thumbnail_id, $size, $attr) {

			if (get_post_type($post_id) === 'product') {

				$image_link  = wp_get_attachment_url( $post_thumbnail_id );
				$image_size = get_option($size . '_image_size');

				if ($image_link) {
					$path = wp_upload_dir();
					$temp = explode('wp-content/uploads', $image_link);
					$image_path = $path['basedir'] . $temp[1];
				}

				if (!$image_link || !file_exists($image_path)) {

					$w = $image_size['width'];
					$h = $image_size['height'];

					return '<img src="http://placehold.it/' . $w . 'x' . $h . '&text=NO IMAGE" alt="' . __( 'Placeholder', 'cardealer' ) . '" width="' . $w . '" class="woocommerce-placeholder wp-post-image" height="' . $h . '" />';
				} else {

					$info = pathinfo($image_path);
					$thumb_path = str_replace($info['filename'], $info['filename'] . '-' . $image_size['width'] . 'x' . $image_size['height'], $image_path);

					if (!file_exists($thumb_path)) {
						TMM_Helper::resize_image($image_link, $image_size['width'] . '*' . $image_size['height']);
					}

				}
			}

			return $html;
		}

		add_filter('woocommerce_single_product_image_thumbnail_html', 'tmm_woocommerce_single_product_image_thumbnail_html', 10, 4);

		function tmm_woocommerce_single_product_image_thumbnail_html($html, $attachment_id, $post_id, $image_class) {

			$image_size = get_option('shop_thumbnail_image_size');
			$image_link  = wp_get_attachment_url( $attachment_id );

			if ($image_link) {

				$path = wp_upload_dir();
				$temp = explode('wp-content/uploads', $image_link);
				$image_path = $path['basedir'] . $temp[1];
				$info = pathinfo($image_path);
				$thumb_path = str_replace($info['filename'], $info['filename'] . '-' . $image_size['width'] . 'x' . $image_size['height'], $image_path);

				if (!file_exists($thumb_path)) {
					$new_img = TMM_Helper::resize_image($image_link, $image_size['width'] . '*' . $image_size['height']);

					if (strpos($new_img, 'placehold.it') !== false) {

						$w = $image_size['width'];
						$h = $image_size['height'];

						return '<img src="http://placehold.it/' . $w . 'x' . $h . '&text=NO IMAGE" alt="' . __( 'Placeholder', 'cardealer' ) . '" width="' . $w . '" class="woocommerce-placeholder wp-post-image" height="' . $h . '" />';

					}
				}

			}

			return $html;
		}

	}
}

add_action('init', 'tmm_set_woocommerce_image_placeholder');

/* ---------------------------------------------------------------------- */
/* 	Change number of related products on product page
/* ---------------------------------------------------------------------- */

/**
 *
 * Change number of related products on product page
 * Set your own value for 'posts_per_page'
 *
 */
function woo_related_products_limit() {
	global $product;

	$args['posts_per_page'] = 6;
	return $args;
}

add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args' );
  function jk_related_products_args( $args ) {
	  $args['posts_per_page'] = 3; // 4 related products
	  $args['columns'] = 3; // arranged in 2 columns
	  return $args;
  }

/* ---------------------------------------------------------------------- */
/* 	Override Default Product Search Form
/* ---------------------------------------------------------------------- */

add_filter( 'get_product_search_form' , 'woo_custom_product_searchform' );

/**
 * woo_custom_product_searchform
 *
 * @access      public
 * @since       1.0
 * @return      void
 */
function woo_custom_product_searchform( $form ) {

	$form = '<form role="search" method="get" id="searchform" action="' . esc_url( home_url( '/'  ) ) . '">
		<div>
			<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . __( 'Product Search', 'woocommerce' ) . '" />
			<button type="submit" id="searchsubmit" title="'. esc_attr__( 'Product Search', 'woocommerce' ) .'"></button>
			<input type="hidden" name="post_type" value="product" />
		</div>
	</form>';

	return $form;

}

/* ---------------------------------------------------------------------- */
/* 	Shop Archive Page Title and Breadcrumbs
/* ---------------------------------------------------------------------- */

/**
 * Remove default Shop archive page title
 */
if ( !function_exists('tmm_woocommerce_show_page_title') ) {
	function tmm_woocommerce_show_page_title() {
		return false;
	}
}

add_filter( 'woocommerce_show_page_title', 'tmm_woocommerce_show_page_title' );

/**
 * Display custom Shop archive page title.
 * @param  string $title
 */
if ( !function_exists('tmm_woocommerce_before_main_content') ) {
	function tmm_woocommerce_before_main_content() {

		if ( is_shop() ) {
			$shop_page_id = wc_get_page_id('shop');
			$hide_title = false;

			if ($shop_page_id) {
				$hide_title = (int) get_post_meta($shop_page_id, 'hide_single_page_title', true);
			}

			if (!$hide_title) {
			?>
			<div class="page-subheader">
				<h2 class="page-title">
					<?php woocommerce_page_title( ) ?>
				</h2><!-- /.page-title -->
				<?php tmm_breadcrumbs(); ?>
			</div>
			<?php
			}
		}

	}
}

add_action( 'woocommerce_before_main_content', 'tmm_woocommerce_before_main_content', 30 );

/**
 * 	Remove default breadcrumbs output
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

/**
 * Retrieve filtered breadcrumbs output
 */
if ( !function_exists('tmm_wc_breadcrumbs_items') ) {
	function tmm_wc_breadcrumbs_items() {
		if (is_woocommerce()) {
			$args = array(
				'delimiter'   => '&nbsp;',
				'wrap_before' => '',
				'wrap_after'  => '',
				'before'      => '',
				'after'       => '',
			);
			ob_start();
			woocommerce_breadcrumb($args);
			return ob_get_clean();
		}
	}
}

add_filter( 'tmm_breadcrumbs_custom_items', 'tmm_wc_breadcrumbs_items', 10 );

/* ---------------------------------------------------------------------- */
/* 	Single Product Page (Move WooCommerce Product Tabs To Under Product Summary On The Right In Canvas)
/* ---------------------------------------------------------------------- */

// Removes tabs from their original loaction
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );

// Inserts tabs under the main right product content
add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 60 );

/* ---------------------------------------------------------------------- */
/* 	Change Archive Product Layout
/* ---------------------------------------------------------------------- */

add_action( 'woocommerce_before_shop_loop', 'tmm_woocommerce_before_shop_loop', 40 );

function tmm_woocommerce_before_shop_loop() {
	$cols = (int) TMM::get_option('shop_page_columns');
	if (!$cols) $cols = 3;
	echo '<div class="woocommerce columns-'.$cols.'">';
}

add_action( 'woocommerce_after_shop_loop', 'tmm_woocommerce_after_shop_loop', 1 );

function tmm_woocommerce_after_shop_loop() {
	echo '</div>';
}

add_filter( 'loop_shop_per_page', 'tmm_loop_shop_per_page', 20 );

function tmm_loop_shop_per_page($per_page) {
	$number = TMM::get_option('shop_page_product_number');
	if($number){
		$per_page = (int) $number;
	}
	return $per_page;
}

add_filter( 'loop_shop_columns', 'tmm_loop_shop_columns', 20 );

function tmm_loop_shop_columns($cols) {
	$number = TMM::get_option('shop_page_columns');
	if($number){
		$cols = (int) $number;
	}
	return $cols;
}

/* ---------------------------------------------------------------------- */
/* 	Custom sidebar page id
/* ---------------------------------------------------------------------- */

if ( !function_exists('tmm_wc_custom_sidebar_page') ) {
	function tmm_wc_custom_sidebar_page( $id ) {

		if (is_shop()) {
			$id = get_option( 'woocommerce_shop_page_id' );
		}

		return $id;
	}
}

add_filter('tmm_custom_sidebar_page', 'tmm_wc_custom_sidebar_page');

/* prevent displaying sidebar by woocommerce */
function woocommerce_get_sidebar() {
	//void
}

/* ---------------------------------------------------------------------- */
/* 	Theme Options Tab
/* ---------------------------------------------------------------------- */

add_action( 'tmm_add_theme_options_tab', 'tmm_wc_add_settings_tab', 10 );
/**
 * Add Settings tab.
 */
function tmm_wc_add_settings_tab() {
	if ( current_user_can('manage_options') ) {
		if (class_exists('TMM_OptionsHelper')) {

			$content = array(
				array(
					'title' => __('Top Header Area', 'cardealer'),
					'type' => 'items_block',
					'items' => array(
						'tmm_cart_widget_insert' => array(
							'title' => __('Display Cart Widget in Nav Menu', 'cardealer'),
							'type' => 'checkbox',
							'default_value' => 1,
							'description' => __( 'This will display Cart Widget in navigation menu', 'cardealer' ),
							'custom_html' => '',
							'is_reset' => false
						),
						'tmm_cart_widget_title' => array(
							'title' => __('Cart Widget Title', 'cardealer'),
							'type' => 'text',
							'default_value' => '',
							'description' => '',
							'custom_html' => '',
							'is_reset' => false
						),
					)
				),
				array(
					'title' => __('Product Listing Page', 'cardealer'),
					'type' => 'items_block',
					'items' => array(
						'shop_page_columns' => array(
							'title' => __('Number of columns', 'cardealer'),
							'type' => 'select',
							'default_value' => '3',
							'values' => array(
								'2' => 2,
								'3' => 3,
								'4' => 4,
							),
							'description' => __('Number of columns on shop listing page', 'cardealer'),
							'custom_html' => ''
						),
						'shop_page_product_number' => array(
							'title' => __('Number of items per page', 'cardealer'),
							'type' => 'select',
							'default_value' => '12',
							'values' => array(
								'8' => 8,
								'9' => 9,
								'12' => 12,
								'15' => 15,
								'16' => 16,
								'18' => 18,
								'20' => 20,
								'21' => 21,
								'24' => 24,
								'-1' => __('All', 'cardealer'),
							),
							'description' => __('Number of items to show at a time per shop listing page', 'cardealer'),
							'custom_html' => ''
						),
					)
				),
				'def_woo_styles' => array(
					'title' => __('Use default WooCommerce styles', 'cardealer'),
					'type' => 'checkbox',
					'default_value' => 0,
					'description' => '',
					'custom_html' => ''
				),
				'sidebar_position' => array(
					'title' => __('Shop and Single Products Default Sidebar position', 'cardealer'),
					'type' => 'custom',
					'default_value' => 'sbr',
					'description' => '',
					'custom_html' => TMM::draw_free_page( TMM_THEME_PATH . '/woocommerce/tmm_templates/sidebar_position_option.php' )
				),
			);

			$sections = array(
				'name' => __("Woo Settings", 'cardealer'),
				'css_class' => 'shortcut-woo',
				'show_general_page' => true,
				'content' => $content,
				'child_sections' => array(),
				'menu_icon' => 'dashicons-cart'
			);

			TMM_OptionsHelper::$sections['woocommerce_tab'] = $sections;

		}
	}
}

