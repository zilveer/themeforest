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



echo '<div class="format-head format-head--status format-head--overlay">';

	echo '<div class="post__media" style="background-image:url('.$featured_image_url.');">';
		echo '<img src="'.$featured_image_url.'" alt="'.get_the_title().'" />';
		if( !is_single() ){
			echo '<a class="post__media-permalink" href="'.get_the_permalink().'" title="'.get_the_title().'"></a>';
		}
	echo '</div>';



	echo '<div class="post__text">';

		echo '<div class="icon-heading">';
			echo '<i class="icon-twitter"></i>';
		echo '</div>';



		if( $post->post_excerpt ){

			if( is_single() ){

				echo '<div class="quote">';
				sleek_wp_excerpt('sleek_excerpt_length', false);
				echo '</div>';

			}else{

				echo '<a class="quote" href="' . get_the_permalink() . '" title="' . get_the_title() . '">';
				sleek_wp_excerpt('sleek_excerpt_length', false);
				echo '</a>';

			}
		}



		$author = get_post_meta( get_the_ID(), 'format_author', true ) ? get_post_meta( get_the_ID(), 'format_author', true ) : '';

		if( $author ){
			echo '<div class="dash"></div>';

			echo '<div class="author">';
				if( get_post_meta( get_the_ID(), 'format_link', true ) ){
					echo '<a target="_blank" href="' . get_post_meta( get_the_ID(), 'format_link', true ) . '" title="' . $author . '">' . $author . '</a>';
				}else{
					echo $author;
				}
			echo '</div>';
		}

	echo '</div>'; // /post__text
echo '</div>'; // /format-head