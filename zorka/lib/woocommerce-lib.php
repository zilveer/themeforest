<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/26/15
 * Time: 10:59 AM
 */
global $zorka_product_layout;
if (!function_exists('zorka_woocommerce_reset_loop')) {
	/**
	 * Reset the loop's index and columns when we're done outputting a product loop.
	 *
	 * @subpackage    Loop
	 */
	function zorka_woocommerce_reset_loop()
	{
		global $zorka_product_layout;
		$zorka_product_layout = '';
	}
}

add_filter('loop_shop_per_page', 'zorka_show_products_per_page');
function zorka_show_products_per_page()
{
	$page_size = isset($_GET['page_size']) ? wc_clean($_GET['page_size']) : 12;
	return $page_size;
}

if (!function_exists('woocommerce_template_loop_product_thumbnail')) :
	/**
	 * Get the product thumbnail for the loop.
	 *
	 * @access public
	 * @subpackage    Loop
	 * @return void
	 */
	function woocommerce_template_loop_product_thumbnail()
	{
		global $product, $zorka_data;
		$archive_product_image_hover_effect = isset($zorka_data['archive-product-image-hover-effect']) ? $zorka_data['archive-product-image-hover-effect'] : 'translate-top-to-bottom';
		$attachment_ids = $product->get_gallery_attachment_ids();
		$secondary_image = '';
		$class_arr = array('product-images-hover');
		$class_arr[] = $archive_product_image_hover_effect;

		if ($attachment_ids) {
			$secondary_image_id = $attachment_ids['0'];
			$secondary_image = wp_get_attachment_image($secondary_image_id, apply_filters('shop_catalog', 'shop_catalog'));
		}
		?>
		<?php if (has_post_thumbnail()) : ?>
		<?php if (empty($secondary_image) || ($archive_product_image_hover_effect == 'none')) : ?>
			<div class="product-thumb-one">
				<?php echo woocommerce_get_product_thumbnail(); ?>
			</div>
		<?php else: ?>
			<div class="<?php echo join(' ',$class_arr); ?>">
				<div class="product-thumb-primary">
					<?php echo woocommerce_get_product_thumbnail(); ?>
				</div>
				<div class="product-thumb-secondary">
					<?php echo wp_kses_post($secondary_image); ?>
				</div>
			</div>
		<?php endif; ?>
	<?php endif; ?>
	<?php
	}
endif;


/*Add meta New*/
// Display Fields
add_action('woocommerce_product_options_general_product_data', 'zorka_woocommerce_add_custom_general_fields');

function zorka_woocommerce_add_custom_general_fields()
{
	echo '<div class="options_group">';
	woocommerce_wp_checkbox(
		array(
			'id' => 'zorka_product_new',
			'label' => esc_html__('Product New', 'zorka')
		)
	);
	echo '</div>';
}


// Save Fields
add_action('woocommerce_process_product_meta', 'zorka_woo_add_custom_general_fields_save');
function zorka_woo_add_custom_general_fields_save($post_id)
{
	//product-new
	$zorka_product_new = isset($_POST['zorka_product_new']) ? 'yes' : 'no';
	update_post_meta($post_id, 'zorka_product_new', $zorka_product_new);
}


//Add custom column into Product Page
add_filter('manage_edit-product_columns', 'zorka_columns_into_product_list');
function zorka_columns_into_product_list($defaults)
{
	$defaults['zorka_product_new'] = 'New';
	return $defaults;
}

//Add rows value into Product Page
add_action('manage_product_posts_custom_column', 'zorka_column_into_product_list', 10, 2);
function zorka_column_into_product_list($column, $post_id)
{
	switch ($column) {
		case 'zorka_product_new':
			echo get_post_meta($post_id, 'zorka_product_new', true);
			break;
	}
}


add_filter("manage_edit-product_sortable_columns", "zorka_sortable_columns");
// Make these columns sortable
function zorka_sortable_columns()
{
	return array(
		'zorka_product_new' => 'zorka_product_new'
	);
}

add_action('pre_get_posts', 'zorka_event_column_orderby');
function zorka_event_column_orderby($query)
{
	if (!is_admin())
		return;
	$orderby = $query->get('orderby');
	if ('zorka_product_new' == $orderby) {
		$query->set('meta_key', 'zorka_product_new');
		$query->set('orderby', 'meta_value_num');
	}
}

/*Add meta Hot end*/

add_filter('woocommerce_get_price_html_from_to', 'zorka_woocommerce_get_price_html_from_to', 10, 4);
function zorka_woocommerce_get_price_html_from_to($price, $from, $to, $this)
{
	$price = '<ins>' . ((is_numeric($to)) ? wc_price($to) : $to) . '</ins> <del>' . ((is_numeric($from)) ? wc_price($from) : $from) . '</del>';
	return $price;
}

function zorka_product_search_form($form)
{
	$form = '<form role="search" class="zorka-search-form" method="get" id="searchform" action="' . home_url('/') . '">
                <input type="text" value="' . get_search_query() . '" name="s" id="s"  placeholder="' . esc_html__('Search for products', 'woocommerce') . '">
                <button type="submit"><i class="pe-7s-search"></i></button>
                <input type="hidden" name="post_type" value="product" />
     		</form>';
	return $form;
}

add_filter('get_product_search_form', 'zorka_product_search_form');


/*check out*/
remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10);
add_action('woocommerce_checkout_login_form', 'woocommerce_checkout_login_form', 10);

add_filter('body_class', 'zorka_body_class');
function zorka_body_class($classes)
{
	$classes[] = 'woocommerce';
	$action = isset($_GET['action']) ? $_GET['action'] : '';
	if (isset($action)) {
		switch ($action) {
			case 'yith-woocompare-view-table':
				$classes[] = 'woocommerce-compare-page';
				break;
		}
	}
	return $classes;
}

add_filter('woocommerce_output_related_products_args', 'zorka_related_products_args');
function zorka_related_products_args($args)
{

	$args['posts_per_page'] = 8; // 4 related products
	return $args;
}



if (!function_exists('woocommerce_show_product_images_quick_view')) {

	/**
	 * Output the product image before the single product summary.
	 *
	 * @subpackage    Product
	 */
	function woocommerce_show_product_images_quick_view()
	{
		wc_get_template('single-product/product-image-quick-view.php');
	}
}

/*cart*/
remove_action('woocommerce_cart_collaterals', 'woocommerce_cart_totals');

/*quick-view*/
if (!function_exists('zorka_woocommerce_template_loop_quick_view')) {
	function zorka_woocommerce_template_loop_quick_view()
	{
		wc_get_template('loop/quick-view.php');
	}

	add_action('woocommerce_before_shop_loop_item_title', 'zorka_woocommerce_template_loop_quick_view', 15);
}

if (!function_exists('zorka_woocommerce_template_loop_link')) {
	function zorka_woocommerce_template_loop_link()
	{
		wc_get_template('loop/link.php');
	}

	add_action('woocommerce_before_shop_loop_item_title', 'zorka_woocommerce_template_loop_link', 20);
}

/*Change the add to cart text on single product pages*/
if (!function_exists('zorka_custom_cart_button_text')) {
	function zorka_custom_cart_button_text() {
		return esc_html__('Add to cart', 'zorka' );
	}
	add_filter( 'woocommerce_product_single_add_to_cart_text', 'zorka_custom_cart_button_text' );    // 2.1 +
}
/*Change the add to cart text on product archives*/
if (!function_exists('zorka_woocommerce_product_add_to_cart_text')) {
	function zorka_woocommerce_product_add_to_cart_text() {
		global $product;
		$product_type = $product->product_type;
		switch ( $product_type ) {
			case 'external':
				return esc_html__('Buy product', 'zorka' );
				break;
			case 'grouped':
				return esc_html__('View products', 'zorka' );
				break;
			case 'simple':
				return esc_html__('Add to cart', 'zorka' );
				break;
			case 'variable':
				return esc_html__('Select options', 'zorka' );
				break;
			default:
				return esc_html__('Read more', 'zorka' );
		}
	}
	add_filter( 'woocommerce_product_add_to_cart_text' , 'zorka_woocommerce_product_add_to_cart_text' );
}

if (!function_exists('woocommerce_version_check')) {
	function woocommerce_version_check( $version = '2.1',$operator = '>=' ) {
		if ( class_exists( 'WooCommerce' ) ) {
			global $woocommerce;
			if( version_compare( $woocommerce->version, $version, $operator ) ) {
				return true;
			}
		}
		return false;
	}
}

if (woocommerce_version_check('2.4.0','<')) {
	/**
	 * Display the classes for the product cat div.
	 *
	 * @since 2.4.0
	 * @param string|array $class One or more classes to add to the class list.
	 * @param object $category object Optional.
	 */
	function wc_product_cat_class( $class = '', $category = null ) {
		// Separates classes with a single space, collates classes for post DIV
		echo 'class="' . esc_attr( join( ' ', wc_get_product_cat_class( $class, $category ) ) ) . '"';
	}

	/**
	 * Get the classes for the product cat div.
	 *
	 * @since 2.4.0
	 * @param string|array $class One or more classes to add to the class list.
	 * @param object $category object Optional.
	 */
	function wc_get_product_cat_class( $class = '', $category = null ) {
		global $woocommerce_loop;

		$classes   = is_array( $class ) ? $class : array_map( 'trim', explode( ' ', $class ) );
		$classes[] = 'product-category';
		$classes[] = 'product';

		if ( ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] == 0 || $woocommerce_loop['columns'] == 1 ) {
			$classes[] = 'first';
		}

		if ( $woocommerce_loop['loop'] % $woocommerce_loop['columns'] == 0 ) {
			$classes[] = 'last';
		}

		$classes = apply_filters( 'product_cat_class', $classes, $class, $category );

		return array_unique( array_filter( $classes ) );
	}
}

/*================================================
	QUICK VIEW
================================================== */

add_action('g5plus_before_quick_view_product_summary', 'woocommerce_show_product_sale_flash', 10);
add_action('g5plus_before_quick_view_product_summary', 'woocommerce_show_product_images_quick_view', 20);

if (!function_exists('g5plus_template_quick_view_product_title')) {
	function g5plus_template_quick_view_product_title() {
		wc_get_template( 'quick-view/title.php' );
	}
	add_action('g5plus_quick_view_product_summary','g5plus_template_quick_view_product_title',5);
}

if (!function_exists('g5plus_template_quick_view_product_rating')) {
	function g5plus_template_quick_view_product_rating() {
		wc_get_template( 'quick-view/rating.php' );
	}
	add_action('g5plus_quick_view_product_summary','g5plus_template_quick_view_product_rating',10);
}

add_action('g5plus_quick_view_product_summary','woocommerce_template_single_price',15);
add_action('g5plus_quick_view_product_summary','woocommerce_template_single_excerpt',20);
add_action('g5plus_quick_view_product_summary','woocommerce_template_single_add_to_cart',30);
add_action('g5plus_quick_view_product_summary','woocommerce_template_single_meta',40);
add_action('g5plus_quick_view_product_summary','woocommerce_template_single_sharing',50);


