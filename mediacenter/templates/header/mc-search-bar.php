<?php
/**
 * Search Bar
 *
 * @author      Ibrahim Ibn Dawood
 * @package     Templates/Sections
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if( is_rtl() ) {
	$dir_value = 'rtl';
} else {
	$dir_value = 'ltr';
}

if( is_woocommerce_activated() ) :
$dropdown_categories 	= '';
$selected_cat 			= isset( $_GET['product_cat'] ) ? $_GET['product_cat'] : '0';
$group_addon_es_class  	= '';
	
if( apply_filters( 'mc_enable_search_dropdown_categories', true ) ) {
	$dropdown_categories = wp_dropdown_categories( apply_filters( 'mc_search_dropdown_categories_args', array( 
		'show_option_all' 	=> __( 'All Categories', 'mediacenter' ), 
		'taxonomy' 			=> 'product_cat',
		'hide_if_empty'		=> true,
		'name'				=> 'product_cat',
		'selected'			=> $selected_cat,
		'value_field'		=> 'slug',
		'echo'				=> 0,
	) ) );

	if( ! empty( $dropdown_categories ) ) {
		$group_addon_es_class = 'has-categories-dropdown';
	}
}
?>
<div class="mc-search-bar">
	<form role="search" method="get" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
		<div class="input-group">
			<label class="sr-only screen-reader-text" for="s"><?php  echo __( 'Search for:', 'mediacenter' );?></label>
			<input type="text" class="search-field" dir="<?php echo esc_attr( $dir_value ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" placeholder="<?php echo esc_attr( __( 'Search for products', 'mediacenter' ) ); ?>" />
			<div class="input-group-addon <?php echo esc_attr( $group_addon_es_class ); ?>">
				<?php echo $dropdown_categories; ?>
				<button type="submit"><i class="fa fa-search"></i></button>
        		<input type="hidden" id="search-param" name="post_type" value="product" />
        	</div>
    	</div>
	</form>
</div>
<?php else : ?>
<div class="mc-search-bar">
	<form method="get" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
		<div class="input-group">
			<label class="sr-only screen-reader-text" for="s"><?php  echo __( 'Search for:', 'mediacenter' );?></label>
        	<input type="text" class="search-field" dir="<?php echo esc_attr( $dir_value ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" placeholder="<?php echo esc_attr( __( 'Search', 'mediacenter' ) ); ?>" />
    		<div class="input-group-addon">
    			<button type="submit"><i class="fa fa-search"></i></button>
    		</div>
    	</div>
	</form>
</div>
<?php endif; ?>