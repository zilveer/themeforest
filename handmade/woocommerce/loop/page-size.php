<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/23/2016
 * Time: 9:25 AM
 */
global $wp_query,$g5plus_options;
$product_show_catalog_page_size = isset($g5plus_options['product_show_catalog_page_size']) ? $g5plus_options['product_show_catalog_page_size'] : 0;
if ( 1 == $wp_query->found_posts || ! woocommerce_products_will_display() || ($product_show_catalog_page_size == 0) ) {
	return;
}
$product_per_page = $g5plus_options['product_per_page'];
if (empty($product_per_page)) {
	$product_per_page = 12;
}

$page_size = isset( $_GET['page_size'] ) ? wc_clean( $_GET['page_size'] ) : $product_per_page;
$page_size_arr = apply_filters( 'g5plus_woocommerce_catalog_page_size', array(
	'12' => __('12','g5plus-handmade'),
	'24' => __('24','g5plus-handmade'),
	'36' => __('36','g5plus-handmade'),
	'-1' => __('All','g5plus-handmade')
) );
if (!array_key_exists($product_per_page,$page_size_arr)) {
	$page_sizes = array();
	foreach ($page_size_arr as $key => $value ) {
		if ($key > $product_per_page) {
			$page_sizes[$product_per_page] = $product_per_page;
		}
		$page_sizes[$key] = $value;
	}
	$page_size_arr = $page_sizes;
}
?>
<form class="woocommerce-page-size" method="get">
	<span><?php _e('Show:','g5plus-handmade'); ?></span>
	<select name="page_size" id="page_size" onchange="this.form.submit()">
		<?php foreach ( $page_size_arr as $id => $name ) : ?>
			<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $page_size, $id ); ?>><?php echo esc_html( $name ); ?></option>
		<?php endforeach; ?>
	</select>
	<?php
	// Keep query string vars intact
	foreach ( $_GET as $key => $val ) {
		if ( 'page_size' === $key || 'submit' === $key ) {
			continue;
		}
		if ( is_array( $val ) ) {
			foreach( $val as $innerVal ) {
				echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
			}
		} else {
			echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
		}
	}
	?>
</form>
