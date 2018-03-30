<?php 

define('WOOCOMMERCE_USE_CSS', false);

/*-----------------------------------------------------------------------------------*/
/* Hook in on activation */
/*-----------------------------------------------------------------------------------*/

global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action('init', 'morphis_woocommerce_image_dimensions', 1);

/*-----------------------------------------------------------------------------------*/
/* Alter layouts
/*-----------------------------------------------------------------------------------*/

// unhook woocommerce sidebar
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

// unhook woocommerce content wrapper start
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );

//unhook woocommerce content wrapper end
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

// hook pulp framework wrapper start
add_action( 'woocommerce_before_main_content', 'pulpf_wc_output_content_wrapper', 10 );

// hook pulp framework wrapper end
add_action( 'woocommerce_after_main_content', 'pulpf_wc_output_content_wrapper_end', 10 );

// pulp framework wrapper start
if ( !function_exists( 'pulpf_wc_output_content_wrapper' ) ) {

	function pulpf_wc_output_content_wrapper(  ) {
	
		echo '<div class="clear"></div>';
		echo '<div id="main" role="main" class="sixteen columns">';
		echo '<div class="blog-post single-default-page">';

	}
	
}	

// pulp framework wrapper end
if ( !function_exists( 'pulpf_wc_output_content_wrapper_end' ) ) {

	function pulpf_wc_output_content_wrapper_end(  ) {
		
		global $NHP_Options; 
		$options_morphis = $NHP_Options; 
					
		echo '		<div class="clear"></div>';
		echo '		</div>';
		echo '	</div>';
		echo '</div>';
				
		  if( $options_morphis['twitter_hide_below'] == '1' ) { 
				 twitter_strip($options_morphis['twitter_username']);
		  }

	}	
	
}	

function pulpf_get_sidebar_layout( $option_sidebar_layout ) {
	
	$sidebar_pos = '';
	
	$unique_sidebar_layout = $option_sidebar_layout;
	if( 'right_sidebar' == $unique_sidebar_layout ):
		$sidebar_pos = '2';
	elseif( 'left_sidebar' == $unique_sidebar_layout ):
		$sidebar_pos = '1';
	elseif( 'no_sidebar' == $unique_sidebar_layout):
		$sidebar_pos = '3';
	endif;
	
	return $sidebar_pos;
	
}

function pulpf_after_woocommerce_archive_description() {
	
	global $NHP_Options; 
	$options_morphis = $NHP_Options; 	
	$sidebar_pos = pulpf_get_sidebar_layout( get_post_meta(woocommerce_get_page_id('shop'),'_cmb_page_layout_sidebar',TRUE) );
	if( empty( $sidebar_pos ) ) { $sidebar_pos = $options_morphis['radio_img_select_sidebar']; }
	
	if($sidebar_pos == '1'):
		get_sidebar('woocommerce-left');
		echo '<div class="twelve columns omega">';
	elseif($sidebar_pos == '2'):
		echo '<div class="twelve columns alpha">';
	else:
		echo '<div>';
	endif;
	
}

add_action( 'woocommerce_archive_description', 'pulpf_after_woocommerce_archive_description' );
add_action( 'woocommerce_before_single_product', 'pulpf_after_woocommerce_archive_description' );

function pulpf_after_main_content_hook(){
	echo '</div>';
	
	global $NHP_Options; 
	$options_morphis = $NHP_Options; 
	$sidebar_pos = pulpf_get_sidebar_layout( get_post_meta(woocommerce_get_page_id('shop'),'_cmb_page_layout_sidebar',TRUE) );
	if( empty( $sidebar_pos ) ) { $sidebar_pos = $options_morphis['radio_img_select_sidebar']; }
	
	if($sidebar_pos == '2') :
		get_sidebar('woocommerce');
	endif;
	
}
add_action( 'woocommerce_after_main_content', 'pulpf_after_main_content_hook', 9 );

remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);


// Content Product
function pulpf_content_product_list_classes( $classes, $woocommerce_loop ){

	// add column classes
	global $NHP_Options; 
	$options_morphis = $NHP_Options; 
	$sidebar_pos = pulpf_get_sidebar_layout( get_post_meta(woocommerce_get_page_id('shop'),'_cmb_page_layout_sidebar',TRUE) );
	if( empty( $sidebar_pos ) ) { $sidebar_pos = $options_morphis['radio_img_select_sidebar']; }
	$columns = 'four columns';

	if( '1' == $sidebar_pos ) : //left
		$columns	= 'four columns';
		$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 3 ); 
	elseif( '2' == $sidebar_pos ) : // right 
		$columns	= 'four columns';
		$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 3 ); 
	else : // no sidebar
		$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 ); 
	endif;
	
	// finally add classes
	$classes[] = $columns;
	if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
		$classes[] = 'omega';
	if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
		$classes[] = 'alpha';

	return $classes;
		
}
add_filter( 'morphis_content_product_list_classes', 'pulpf_content_product_list_classes', 10, 2 );

// after shop loop item
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
//remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

function pulpf_product_list_clearer( $woocommerce_loop ) {

	// add column classes
	global $NHP_Options; 
	$options_morphis = $NHP_Options; 
	$sidebar_pos = pulpf_get_sidebar_layout( get_post_meta(woocommerce_get_page_id('shop'),'_cmb_page_layout_sidebar',TRUE) );
	if( empty( $sidebar_pos ) ) { $sidebar_pos = $options_morphis['radio_img_select_sidebar']; }
	$columns = 'four columns';

	if( '1' == $sidebar_pos ) : //left
		$columns	= 'four columns';
		$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 3 ); 
	elseif( '2' == $sidebar_pos ) : // right 
		$columns	= 'four columns';
		$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 3 ); 
	else : // no sidebar
		$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 ); 
	endif;

	if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) :
		echo '<li class="clearer"><div class="clear"></div></li>';
	endif;
	
}
add_action( 'morphis_product_list_clearer', 'pulpf_product_list_clearer', 10 );


/*-----------------------------------------------------------------------------------*/
/* Define image sizes / hard crop */
/*-----------------------------------------------------------------------------------*/

function morphis_woocommerce_image_dimensions() {

// Image sizes
update_option( 'woocommerce_thumbnail_image_width', '100' ); // Image gallery thumbs
update_option( 'woocommerce_thumbnail_image_height', '100' );
update_option( 'woocommerce_single_image_width', '600' ); // Featured product image
update_option( 'woocommerce_single_image_height', '600' ); 
update_option( 'woocommerce_catalog_image_width', '400' ); // Product category thumbs
update_option( 'woocommerce_catalog_image_height', '400' );

// Hard Crop [0 = false, 1 = true]
update_option( 'woocommerce_thumbnail_image_crop', 1 );
update_option( 'woocommerce_single_image_crop', 1 ); 
update_option( 'woocommerce_catalog_image_crop', 1 );

}


// WooCommerce before and after main content

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);


/**
 * WooCommerce Breadcrumb
 **/
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

/**
 * WooCommerce Product Navigation
 **/
remove_action('woocommerce_pagination', 'woocommerce_pagination', 10);
function pulp_woocommerce_pagination() {
		global $wp_query;
		echo '<div class="clear"></div>';
		numbered_pagination($wp_query->max_num_pages);		
}
add_action( 'woocommerce_pagination', 'pulp_woocommerce_pagination', 10);


/* 
 WooCommerce Related Products
*/
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
function pulp_woocommerce_output_related_products() {
		woocommerce_related_products( 3, 3 ); 
}
add_action( 'woocommerce_after_single_product_summary', 'pulp_woocommerce_output_related_products', 80);

remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
add_action( 'woocommerce_after_shop_loop', 'pulp_woocommerce_pagination', 10 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
add_action( 'woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 30 );
?>