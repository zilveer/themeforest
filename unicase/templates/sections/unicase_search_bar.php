<?php
/**
 * Search Bar
 *
 * @author  Transvelo
 * @package Unicase/Templates
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( is_rtl() ) {
	$dir_value = 'rtl';
} else {
	$dir_value = 'ltr';
}
?>
<?php if( is_woocommerce_activated() ) : ?>
<div class="search-area product-search-area">
	<form method="get" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
		<div class="input-group">
			<?php if( apply_filters( 'unicase_enable_search_categories_filter', TRUE ) ) : ?>
			<div class="input-group-addon search-categories">
				<?php
					$selected_cat = isset( $_GET['product_cat'] ) ? $_GET['product_cat'] : "0";
						
					wp_dropdown_categories( apply_filters( 'unicase_search_categories_filter_args', array( 
						'show_option_all' 	=> esc_html__( 'All Categories', 'unicase' ), 
						'taxonomy' 			=> 'product_cat',
						'hide_if_empty'		=> 1,
						'name'				=> 'product_cat',
						'selected'			=> $selected_cat,
						'value_field'		=> 'slug',
					) ) );
				?>
			</div>
			<?php endif; ?>
			<label class="sr-only screen-reader-text" for="search"><?php  echo esc_html__( 'Search for:', 'unicase' );?></label>
        	<input type="text" id="search" class="search-field" dir="<?php echo esc_attr( $dir_value ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" placeholder="<?php echo esc_attr( esc_html__( 'Search for products', 'unicase' ) ); ?>" />
    		<div class="input-group-addon">
    			<input type="hidden" id="search-param" name="post_type" value="product" />
    			<button type="submit"><i class="fa fa-search"></i></button>
    		</div>
    	</div>
	</form>
</div>
<?php else : ?>
<div class="search-area">
	<form method="get" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
		<div class="input-group">
			<label class="sr-only screen-reader-text" for="search"><?php  echo esc_html__( 'Search for:', 'unicase' );?></label>
        	<input type="text" id="search" class="search-field" dir="<?php echo esc_attr( $dir_value ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" placeholder="<?php echo esc_attr( esc_html__( 'Search', 'unicase' ) ); ?>" />
    		<div class="input-group-addon">
    			<button type="submit"><i class="fa fa-search"></i></button>
    		</div>
    	</div>
	</form>
</div>
<?php endif; ?>