<?php
/**
 * Show options for ordering
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $wp_query;

if ( 1 == $wp_query->found_posts || ! woocommerce_products_will_display() )
	return;
?>
<form class="woocommerce-ordering clearfix" method="get">
	<div class="woocommerce-ordering-select">
		<label class="hide"><?php esc_html_e('Sorting:','jakiro')?></label>
		<div class="form-flat-select">
			<select name="orderby" class="orderby">
				<?php
					foreach ( $catalog_orderby_options as $id => $name )
						echo '<option value="' . esc_attr( $id ) . '" ' . selected( $orderby, $id, false ) . '>' . esc_attr( $name ) . '</option>';
				?>
			</select>
			<i class="fa fa-angle-down"></i>
		</div>
	</div>
	<?php
		// Keep query string vars intact
		foreach ( $_GET as $key => $val ) {
			if ( 'per_page' === $key || 'orderby' === $key || 'submit' === $key )
				continue;
			
			if ( is_array( $val ) ) {
				foreach( $val as $innerVal ) {
					echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
				}
			
			} else {
				echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
			}
		}
	?>
	<div class="woocommerce-ordering-select" style="margin: 0">
		<label class="hide"><?php esc_html_e('Show:','jakiro')?></label>
		<div class="form-flat-select">
			<select name="per_page" class="per_page">
				<?php 
				$catalog_per_page =  dh_get_theme_option('woo-per-page',12);
				$pager_page = isset($_GET['per_page']) ? $_GET['per_page'] :  $catalog_per_page;
				?>
				<option value="<?php echo esc_attr($catalog_per_page) ?>" <?php selected($pager_page,$catalog_per_page)?>><?php echo sprintf('%1$s',$catalog_per_page)?></option>
				<option value="<?php echo esc_attr($catalog_per_page * 2) ?>" <?php selected($pager_page,($catalog_per_page * 2))?>><?php echo sprintf('%1$s',($catalog_per_page * 2))?></option>
				<option value="<?php echo esc_attr($catalog_per_page * 3) ?>" <?php selected($pager_page,($catalog_per_page * 3))?>><?php echo sprintf('%1$s',($catalog_per_page * 3))?></option>
			</select>
			<i class="fa fa-angle-down"></i>
		</div>
	</div>
</form>
