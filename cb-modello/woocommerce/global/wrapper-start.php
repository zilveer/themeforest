<?php
/**
 * Content wrappers
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$template = get_option('template');

switch( $template ) {
	case 'twentyeleven' :
		echo '<div id="primary"><div id="content" role="main">';
		break;
	case 'twentytwelve' :
		echo '<div id="primary" class="site-content"><div id="content" role="main">';
		break;
	case 'twentythirteen' :
		echo '<div id="primary" class="site-content"><div id="content" role="main" class="entry-content twentythirteen">';
		break;
	default :

		global $post;
		$cbtheme_shop=new cbtheme();
		$cbtheme_shop->page_header('',$type='shop');

	break; } //switch end 
	

	$cb_post_options=cb_get_post_options($post->ID);
	$cb_sidebars=cb_get_sidebars($post->ID);
	$cb_header_options=cb_get_header_options($post->ID);
	?>
	<div id="content" <?php if($cb_sidebars['side']=='yes') { ?>class="side"<?php } ?>>
	
	
	<?php 

	
	
	?><?php
	global $wp_query;
	$cat = $wp_query->get_queried_object();
	/*if(!is_product_category()){if(get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true )==''){
if($cb_post_options['title']=='yes'||$cb_post_options['title']=='') {if ( apply_filters( 'woocommerce_show_page_title', true ) ) : echo '<h1 class="title">';?>
				<?php woocommerce_page_title().'</h1>';
	 endif;}
	 }
	 }*/?>
				<?php 
					if(is_product_category()) {
if($cat->description!='')echo '<div class="term-description">'.$cat->description.'</div>'; 
   $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
					$image = wp_get_attachment_url( $thumbnail_id );
					if($image) echo '<img src="'.$image.'" alt="category image" class="category_image"/>';
} ?>
				<div class="cl"></div>
				
				
<?php if($cb_header_options['header_type']!='slider_head') echo '<div class="wrapme head_title"><span class="title">';
if($cb_header_options['show_bread']=='yes'&&$cb_post_options['show_bread']!='no'){
    if($type!='shop') { if(function_exists('yoast_breadcrumb')){
        yoast_breadcrumb('<span class="bread_wrap"><span class="wrapme"><span id="breadcrumbs">','</span><span class="cl"></span></span></span>');
    }

	else { echo '<span class="bread_wrap"><span class="wrapme">'; woocommerce_breadcrumb(); echo '</span></span>'; }}
}
if($cb_header_options['header_type']!='slider_head') 	echo '</span></div>';
?>