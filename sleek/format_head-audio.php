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

$head_class = '';

// Add Class if has featured image
if( has_post_thumbnail() ){
	$head_class .= ' featured-image--true';
}else{
	$head_class .= ' featured-image--false';
}

$embed_url = get_post_meta( get_the_ID(), 'format_embed_url', true );

// check if the embed link is a direct audio file
$head_class .= sleek_url_is_audiofile( $embed_url ) ? ' embed-audiofile' : '';


echo '<div class="format-head format-head--audio '.$head_class.'">';

	echo '<div class="post__media">';

		// embed link

		if( $embed_url ){
			global $wp_embed;
			$post_embed = $wp_embed->run_shortcode('[embed]'. $embed_url .'[/embed]');

			if(
				sleek_url_is_audiofile( $embed_url ) &&
				has_post_thumbnail()
			){
				if( $post_size == 'large' ){
					if( is_single() ){
						the_post_thumbnail( 'xl' );
					}else{
						the_post_thumbnail( 'l' );
					}
				}else if( $post_size == 'small' ){
					the_post_thumbnail( 'sm' );
				}else{
					the_post_thumbnail( 'm' );
				}
			}

			echo do_shortcode( $post_embed );

		}

		// fallback to featured image
		elseif( has_post_thumbnail() ){

			if( !is_single() ){
				echo '<a href="'.get_the_permalink().'" title="'.get_the_title().'">';
			}

			if( $post_size == 'large' ){
				if( is_single() ){
					the_post_thumbnail( 'xl' );
				}else{
					the_post_thumbnail( 'l' );
				}
			}else{
				the_post_thumbnail( 'm' );
			}

			if( !is_single() ){
				echo '</a>';
			}

		}

	echo '</div>';
echo '</div>';
