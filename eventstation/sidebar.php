<?php 
 if ( is_woocommerce() ) {

	eventstation_sidebar_start();
		if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("shop-sidebar") ) : endif;
	eventstation_sidebar_end(); 
	
} elseif ( is_attachment() ) {

	$attachment_sidebar_select = ot_get_option( 'attachment_sidebar_select' );

	if ( !empty( $attachment_sidebar_select) ) {
		
		eventstation_post_sidebar_start();
			dynamic_sidebar( $attachment_sidebar_select ); 
		eventstation_sidebar_end();
		
	} else {
		
		eventstation_post_sidebar_start();
			if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("general-sidebar") ) : endif;
		eventstation_sidebar_end(); 
		
	}
	
} elseif( is_single() ) {
	
	$single_id = get_the_ID();
	$single_sidebar_select = ot_get_option( 'single_sidebar_select' );
	$single_sidebar = get_post_meta( $single_id, 'single_sidebar', true );
	
	if( !empty( $single_sidebar ) ) {
		eventstation_post_sidebar_start();
			dynamic_sidebar( $single_sidebar );
		eventstation_sidebar_end();
		
	} elseif ( !empty( $single_sidebar_select) ) {
		
		eventstation_post_sidebar_start();
			dynamic_sidebar( $single_sidebar_select ); 
		eventstation_sidebar_end();
		
	} else {
		
		eventstation_post_sidebar_start();
			if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("general-sidebar") ) : endif;
		eventstation_sidebar_end(); 
		
	}
	
} elseif ( is_category() ) {
	
	$cat = get_queried_object();
	$cat_id = $cat->term_id;
	$category_sidebar_settings = ot_get_option('sidebar_select_'. $cat_id); 

	if( !empty( $category_sidebar_settings ) ) {
		eventstation_sidebar_start();
			dynamic_sidebar( $category_sidebar_settings ); 
		eventstation_sidebar_end();
	} else {
		eventstation_sidebar_start();
			if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("general-sidebar") ) : endif;
		eventstation_sidebar_end(); 
	}
	
}elseif ( is_tag() ) {

	$tag_sidebar_select = ot_get_option( 'tag_sidebar_select' );

	if ( !empty( $tag_sidebar_select) ) {
		
		eventstation_post_sidebar_start();
			dynamic_sidebar( $tag_sidebar_select ); 
		eventstation_sidebar_end();
		
	} else {
		
		eventstation_post_sidebar_start();
			if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("general-sidebar") ) : endif;
		eventstation_sidebar_end(); 
		
	}
	
} elseif ( is_author() ) {

	$author_sidebar_select = ot_get_option( 'author_sidebar_select' );

	if ( !empty( $author_sidebar_select) ) {
		
		eventstation_post_sidebar_start();
			dynamic_sidebar( $author_sidebar_select ); 
		eventstation_sidebar_end();
		
	} else {
		
		eventstation_post_sidebar_start();
			if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("general-sidebar") ) : endif;
		eventstation_sidebar_end(); 
		
	}
	
} elseif ( is_search() ) {

	$search_sidebar_select = ot_get_option( 'search_sidebar_select' );

	if ( !empty( $search_sidebar_select) ) {
		
		eventstation_post_sidebar_start();
			dynamic_sidebar( $search_sidebar_select ); 
		eventstation_sidebar_end();
		
	} else {
		
		eventstation_post_sidebar_start();
			if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("general-sidebar") ) : endif;
		eventstation_sidebar_end(); 
		
	}
	
} elseif ( is_archive() ) {

	$archive_sidebar_select = ot_get_option( 'archive_sidebar_select' );

	if ( !empty( $archive_sidebar_select) ) {
		
		eventstation_post_sidebar_start();
			dynamic_sidebar( $archive_sidebar_select ); 
		eventstation_sidebar_end();
		
	} else {
		
		eventstation_post_sidebar_start();
			if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("general-sidebar") ) : endif;
		eventstation_sidebar_end(); 
		
	}
	
} else {
	
	eventstation_post_sidebar_start();
		if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("general-sidebar") ) : endif;
	eventstation_sidebar_end();
}