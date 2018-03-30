<?php
/**
 * Show options for ordering
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
mango_sidebar_filter();
?>

	<?php
	global $mango_settings;
	$current_page_id =  mango_current_page_id();   
	$mango_layout_columns = get_post_meta ( $current_page_id, 'mango_page_layout', true ) ? get_post_meta ( $current_page_id, 'mango_page_layout', true ) : '';	 
	
   if($mango_settings['mango_shop_layout']=="no" || $mango_layout_columns=="no"){
	?>
		<button type="button" id="shop-side-btn" 
			<?php if($mango_settings['mango_sidefilter_layout'] =='left'){?>
			class="pull-left filter-btn"
			<?php } if($mango_settings['mango_sidefilter_layout'] =='right') {?>
			class="pull-right filter-btn">
			<?php } ?>
			<span class="sr-only"><?php __("Toggle navigation",'mango') ?>
			</span>
			<i class="fa fa-navicon"></i>
		   <?php _e("FILTER",'mango') ?>
		</button>
	<?php } ?>
<div class="filter-row-box">
    <form class="woocommerce-ordering" method="get">
    <span class="filter-row-label"><?php _e("Sort by",'woocommerce')?></span>
    <div class="small-selectbox sort-selectbox clearfix">
        <select id="sort" name="orderby" class="selectbox">
            <?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
                <option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
            <?php endforeach; ?>
        </select>
    </div><!-- End .normal-selectbox-->
        <?php
        // Keep query string vars intact
        foreach ( $_GET as $key => $val ) {
            if ( 'orderby' === $key || 'submit' === $key ) {
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
    <button type="submit" class="sort-arrow" title="<?php _e("Sort",'woocommerce')?>"><?php _e("Sort",'woocommerce')?></button>
    </form>
</div><!-- End .filter-row-box -->