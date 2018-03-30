<?php
$wtstyle = veda_opts_get('wtitle-style', '');
if(!empty($wtstyle)):
	echo "<div class='{$wtstyle}'>";
endif;
	wp_reset_query();
	$post = veda_global_variables('post');
	
	if( is_page() ):
		$page_id = ($post->ID == 0) ? get_queried_object_id() : $post->ID;
		veda_show_sidebar('page',$page_id, 'left');
	elseif( is_single() ):
	
		if( is_singular('post') ) {
	
			$id = ($post->ID == 0) ? get_queried_object_id() : $post->ID;
			veda_show_sidebar('post',$id, 'left');
		} elseif( is_singular('dt_portfolios') ) {
	
			$id = ($post->ID == 0) ? get_queried_object_id() : $post->ID;
			veda_show_sidebar('dt_portfolios',$id, 'left');
		} elseif( is_singular('product') ) {
	
			if( is_active_sidebar('product-detail-sidebar-left') ):
				dynamic_sidebar('product-detail-sidebar-left');
			endif;
	
			$enable = veda_option('woo','show-shop-standard-left-sidebar-for-product-layout');
			if( $enable ):
				if( is_active_sidebar('shop-everywhere-sidebar-left') ):
					dynamic_sidebar('shop-everywhere-sidebar-left');
				endif;
			endif;		
		} else {
			veda_show_sidebar('',$id, 'left');
		}
	elseif( class_exists('woocommerce') && is_post_type_archive('product') ):
		veda_show_sidebar('page',get_option('woocommerce_shop_page_id'), 'left');
	elseif( class_exists('woocommerce') && is_product_category() ):
	
		if( is_active_sidebar('product-category-sidebar-left') ):
			dynamic_sidebar('product-category-sidebar-left');
		endif;
	
		$enable = veda_option('woo','show-shop-standard-left-sidebar-for-product-category-layout');
		if( $enable ):
			if( is_active_sidebar('shop-everywhere-sidebar-left') ):
				dynamic_sidebar('shop-everywhere-sidebar-left');
			endif;
		endif;	
	elseif( class_exists('woocommerce') && is_product_tag() ):
	
		if( is_active_sidebar('product-tag-sidebar-left') ):
			dynamic_sidebar('product-tag-sidebar-left');
		endif;
	
		$enable = veda_option('woo','show-shop-standard-left-sidebar-for-product-tag-layout');
		if( $enable ):
			if( is_active_sidebar('shop-everywhere-sidebar-left') ):
				dynamic_sidebar('shop-everywhere-sidebar-left');
			endif;
		endif;	
	elseif( is_tax() ):
	
		$tax = get_query_var( 'taxonomy' );
		if( $tax == 'portfolio_entries' ) {
	
			if( is_active_sidebar('custom-post-portfolio-archives-sidebar-left') ):
				dynamic_sidebar('custom-post-portfolio-archives-sidebar-left');
			endif;
	
			$enable = veda_option('pageoptions','show-standard-left-sidebar-for-portfolio-archives');
			if( $enable ):
				if( is_active_sidebar('standard-sidebar-left') ):
					dynamic_sidebar('standard-sidebar-left');
				endif;
			endif;
		} else {
			if( is_active_sidebar($tax.'-archives-sidebar-left') ):
				dynamic_sidebar($tax.'-archives-sidebar-left');
			endif;
	
			$standard = 'disable-standard-left-sidebar-for-'.$tax;
			$disable = veda_option('pageoptions',$standard);
			if( is_null($disable) ):
				if( is_active_sidebar('standard-sidebar-left') ):
					dynamic_sidebar('standard-sidebar-left');
				endif;
			endif;		
		}
	elseif( is_archive() || is_search() ):
	
		if( is_active_sidebar('post-archives-sidebar-left') ):
			dynamic_sidebar('post-archives-sidebar-left');
		endif;
	
		$enable = veda_option('pageoptions','show-standard-left-sidebar-for-post-archives');
		if($enable):
			if( is_active_sidebar('standard-sidebar-left') ):
				dynamic_sidebar('standard-sidebar-left');
			endif;
		endif;
	elseif( is_home() ):
	
		$page_id = get_option('page_for_posts');
		veda_show_sidebar('page',$page_id, 'left');

		$enable = veda_option('pageoptions','show-standard-left-sidebar-for-post-archives');
		if($enable):
			if( is_active_sidebar('standard-sidebar-left') ):
				dynamic_sidebar('standard-sidebar-left');
			endif;
		endif;		
	else:
		if( is_active_sidebar('standard-sidebar-left') ):
			dynamic_sidebar('standard-sidebar-left');
		endif;
	endif;
if(!empty($wtstyle)):	
	echo "</div>";
endif;