<?php

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



$featured_image_url = '';
if( has_post_thumbnail() ){

	switch( $post_size ){
		case 'small':
			$featured_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'portrait-m' );
			$featured_image_url = $featured_image_url[0];
			break;

		case 'medium':
			$featured_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'square-m' );
			$featured_image_url = $featured_image_url[0];
			break;

		default:
			$featured_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'xl' );
			$featured_image_url = $featured_image_url[0];
			break;
	}
}


echo '<div class="format-head format-head--image format-head--overlay">';

	echo '<div class="post__media" style="background-image:url('.$featured_image_url.');">';
		echo '<img src="'.$featured_image_url.'" alt="'.get_the_title().'" />';
		if( !is_single() ){
			echo '<a class="post__media-permalink" href="'.get_the_permalink().'" title="'.get_the_title().'"></a>';
		}
	echo '</div>';



	echo '<div class="post__text">';

		if( !is_single() ){
			echo '<h2>';
				echo '<a href="'. get_the_permalink().'" title="'. get_the_title().'">'.get_the_title().'</a>';
			echo '</h2>';
		}else{
			echo '<h1>';
				the_title();
			echo '</h1>';
		}

		sleek_wp_excerpt('sleek_excerpt_length', false);

	echo '</div>';

echo '</div>';