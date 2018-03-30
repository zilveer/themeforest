<?php

if( !has_post_thumbnail() ){
	return;
}

$theme_settings = sleek_theme_settings();
$display_style = 'list'; // default
$post_size = 'large'; // default

// If Loop - get display style
if( is_home() ){
	$display_style = $theme_settings->posts['blog_home_display_style'];
}
if( is_archive() ){
	$display_style = $theme_settings->posts['archive_display_style'];
}
if( isset($wp_query->sleek_page_blog_display) ){
	$display_style = $wp_query->sleek_page_blog_display;
}

// Get post size based on display style and masonry-size chosen
if( $display_style == 'masonry' ){
	$post_size = get_post_meta( get_the_ID(), 'loop_masonry_size', true );
}

if( $display_style == 'newspaper' ){
	$post_size = 'small';
}



echo '<div class="format-head format-head--standard">';

	echo '<div class="post__media">';

		echo '<a href="'.get_the_permalink().'" title="'.get_the_title().'">';

		if( $post_size == 'large' ){
			the_post_thumbnail( 'l' );
		}else if( $post_size == 'small' ){
			the_post_thumbnail( 'sm' );
		}else{
			the_post_thumbnail( 'm' );
		}

		echo '</a>';

	echo '</div>';
echo '</div>';
