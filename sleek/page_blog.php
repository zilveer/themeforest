<?php
/*
Used to create blog list on regular page
*/

if( !get_post_meta( get_the_ID(), 'blog_use', true ) ){
	return;
}



// Gather needed fields
$blog_title = get_post_meta( get_the_ID(), 'blog_title', true );
$blog_title_above = get_post_meta( get_the_ID(), 'blog_title_above', true );
$blog_display_style = get_post_meta( get_the_ID(), 'blog_display_style', true );
$blog_count = get_post_meta( get_the_ID(), 'blog_count', true );
$blog_pagination = get_post_meta( get_the_ID(), 'blog_pagination', true );
$blog_category = get_post_meta( get_the_ID(), 'blog_category', true );

$blog_cats = '';
if( $blog_category ){
	foreach( $blog_category as $blog_cat ){
		$blog_cats .= $blog_cat . ',';
	}
}



// Loop Classes
$loop_classes = '';
$loop_classes .= ' loop-container--style-'.$blog_display_style;
if( $blog_display_style == 'masonry' || $blog_display_style == 'newspaper' ){
	$loop_classes .= ' js-loop-is-masonry';
}



// Query

// If static page or static page set as homepage
if( !is_front_page() ){
	$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
}else{
	$paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
}

$temp_query = $wp_query; // backup original query

global $wp_query;
$wp_query = null;
$wp_query = new WP_Query( array(
	 'posts_per_page' => $blog_count
	,'paged' => $paged
	,'cat' => $blog_cats
));

if ( $wp_query->have_posts() ):

	echo '<div class="sleek-blog sleek-blog--page sleek-blog--style-'.$blog_display_style.'">';

		if( isset($blog_title) && $blog_title ){
			echo '<h2 style="text-align:center;">';
			if( $blog_title_above ){
				echo '<span class="above">'.$blog_title_above.'</span>';
			}
			echo $blog_title;
			echo '</h2>';
		}

		echo '<div class="loop-container loop-container--wp '.$loop_classes.'">';

		// pass info to loop items / feature heads
		$wp_query->sleek_page_blog_display 	  = $blog_display_style;
		$wp_query->sleek_page_blog_pagination = $blog_pagination;

		while ( $wp_query->have_posts() ) : $wp_query->the_post();
			get_template_part( 'loop_item', $blog_display_style );
		endwhile;

		echo '</div>';

		get_template_part('pagination');

	echo '</div>';

endif;

$wp_query = $temp_query;
wp_reset_postdata();
