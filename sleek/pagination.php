<?php

$theme_settings = sleek_theme_settings();

// if called from custom page_blog query, use $blog_pagination defined there
if( isset($wp_query->sleek_page_blog_pagination) ){
	$pagination_type = $wp_query->sleek_page_blog_pagination;
// if index
}elseif( is_home() ){
	$pagination_type = $theme_settings->posts['blog_home_pagination'];
// if archive pages
}elseif( is_archive() || is_search() ){
	$pagination_type = $theme_settings->posts['archive_pagination'];
}



if( $pagination_type == 'off' ){
	return;
}


/*	Classic Pagination
/*------------------------------------------------------------*/

if( $pagination_type == 'pagination' ){
	echo '<div class="pagination pagination--classic">';
		sleek_wp_pagination();
	echo '</div>';
}



/*	Load More Button
/*------------------------------------------------------------*/

if( $pagination_type == 'load_more' ){
	sleek_wp_load_more('load_more');
}



/*	Auto Load More
/*------------------------------------------------------------*/

if( $pagination_type == 'auto' ){
	sleek_wp_load_more('auto');
}