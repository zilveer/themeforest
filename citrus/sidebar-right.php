<?php
wp_reset_query();
global $post;

if( is_page() ):

	dttheme_show_sidebar('page',$post->ID, 'right');

elseif( is_singular('post') ):

	dttheme_show_sidebar('post',$post->ID, 'right');
		
elseif( is_singular('product') ):

	$disable = dttheme_option('woo',"disable-shop-everywhere-right-sidebar-for-product-layout");
	if( is_null($disable) ):
		if(function_exists('dynamic_sidebar') && dynamic_sidebar('shop-everywhere-sidebar-right') ): endif;
	endif;
	
elseif( is_post_type_archive('dt_portfolios') ):
	
	if(function_exists('dynamic_sidebar') && dynamic_sidebar('custom-post-portfolio-archives-sidebar-right') ): endif;

	$disable = dttheme_option('specialty',"disable-everywhere-right-sidebar-for-portfolio-archives");
	if( is_null($disable) ):
		if(function_exists('dynamic_sidebar') && dynamic_sidebar(('display-everywhere-sidebar-right')) ): endif;
	endif;
	

elseif( is_post_type_archive('product') ):

	dttheme_show_sidebar('page',get_option('woocommerce_shop_page_id'), 'right');
	
	if(function_exists('dynamic_sidebar') && dynamic_sidebar('shop-everywhere-sidebar-right') ): endif;
	
elseif( class_exists('woocommerce') && is_product_category() ):

	$disable = dttheme_option('woo',"disable-shop-everywhere-right-sidebar-for-product-category-layout");
	if( is_null($disable) ):
		if(function_exists('dynamic_sidebar') && dynamic_sidebar('shop-everywhere-sidebar-right') ): endif;
	endif;

elseif( class_exists('woocommerce') && is_product_tag() ):

	$disable = dttheme_option('woo',"disable-shop-everywhere-right-sidebar-for-product-tag-layout");
	if( is_null($disable) ):
		if(function_exists('dynamic_sidebar') && dynamic_sidebar('shop-everywhere-sidebar-right') ): endif;
	endif;
	
elseif( is_archive() ):

	if(function_exists('dynamic_sidebar') && dynamic_sidebar('post-archives-sidebar-right') ): endif;

	$disable = dttheme_option('specialty',"disable-everywhere-right-sidebar-for-post-archives");
	if( is_null($disable) ):
		if(function_exists('dynamic_sidebar') && dynamic_sidebar(('display-everywhere-sidebar-right')) ): endif;
	endif;

elseif( is_search() ):

	if(function_exists('dynamic_sidebar') && dynamic_sidebar('search-sidebar-right') ): endif;

	$disable = dttheme_option('specialty',"disable-everywhere-right-sidebar-for-search");
	if( is_null($disable) ):
		if(function_exists('dynamic_sidebar') && dynamic_sidebar(('display-everywhere-sidebar-right')) ): endif;
	endif;
	
elseif( is_404() ):

	if(function_exists('dynamic_sidebar') && dynamic_sidebar('not-found-404-sidebar-right') ): endif;

	$disable = dttheme_option('specialty',"disable-everywhere-right-sidebar-for-not-found-404");
	if( is_null($disable) ):
		if(function_exists('dynamic_sidebar') && dynamic_sidebar(('display-everywhere-sidebar-right')) ): endif;
	endif;

else:
	if(function_exists('dynamic_sidebar') && dynamic_sidebar(('display-everywhere-sidebar-right')) ): endif;
endif;

?>