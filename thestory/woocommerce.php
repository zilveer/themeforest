<?php

get_header();

$pexeto_woo = new stdClass();

$pexeto_woo->is_shop = is_shop() || is_product_taxonomy() || is_product_tag();
$pexeto_woo->content_class = 'content-box';
if($pexeto_woo->is_shop){
	$pexeto_woo->content_class.=' pexeto-woo-columns-'.pexeto_woo_column_num();
}

//get all the page meta data (settings) needed (function located in unctions/meta.php)
$pexeto_woo->defaults = array(
	'slider' => 'none',
	'layout' => 'right',
	'sidebar' => 'default',
	'header_display' => array('show_title'=>'off')
);
$pexeto_woo->custom_settings= array();

if(is_product()){
	$pexeto_woo->custom_settings= array(
		'layout'=>pexeto_option('woo_product_layout'),
		'sidebar'=>pexeto_option('woo_product_sidebar')
		);
}else{
	$pexeto_woo->page_id = wc_get_page_id('shop');
	if(!empty($pexeto_woo->page_id) && $pexeto_woo->page_id!=-1){
		$pexeto_woo->custom_settings= array_merge(
			pexeto_get_post_meta($pexeto_woo->page_id, array('layout','header_display','sidebar','slider')),
			pexeto_get_header_title($pexeto_woo->page_id));
	}
}

$pexeto_page = array_merge($pexeto_woo->defaults, $pexeto_woo->custom_settings);
//include the before content template
locate_template( array( 'includes/html-before-content.php' ), true, true );
?>
<div class="<?php echo $pexeto_woo->content_class; ?>">
<?php
//display the page content
woocommerce_content();
wp_link_pages();

if(is_product()){
	//print sharing
	echo pexeto_get_share_btns_html( $post->ID, 'product' );
}


?>
<div class="clear"></div>
</div>
<?php

if ( pexeto_option( 'page_comments' ) ) {
	//include the comments template
	comments_template();
}


//include the after content template
locate_template( array( 'includes/html-after-content.php' ), true, true );

get_footer();
?>
