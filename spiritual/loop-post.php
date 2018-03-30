<?php 	
$swm_blog_exclude_cat = explode(',', get_theme_mod('swm_blog_exclude_cats'));

$swm_blog_pagination_style = get_theme_mod( 'swm_blog_pagination_style', 'standard' );
$swm_blog_section = ( $swm_blog_pagination_style == 'infinite-scroll' ) ? 'swm-item-entries' : 'blog-main-section';

	$args = array(
		'category__not_in' => $swm_blog_exclude_cat,
		'post_type'		=> 'post',
		'order'	=> 'desc',
		'orderby'	=> 'date',		
		'paged' => $paged
	);
	
	$wp_query = new WP_Query($args); 		

	echo '<section>';

	echo '<div id="'.$swm_blog_section.'">';
	
	while ($wp_query->have_posts()) : $wp_query->the_post();
		
		$postid = get_the_ID();		
		$post_format = get_post_format() ? get_post_format() : 'standard';
		$swm_date_box_on = '';

		if ( get_theme_mod('swm_show_date_box',1) == 1 ) {
			$swm_date_box_on =  'swm_date_box_on';
		}

		if (is_sticky()) {
			$classes = array( 'swm-infinite-item-selector post-entry', 'swm_blog_post',$swm_date_box_on, 'sticky' );
		} else {
			$classes = array( 'swm-infinite-item-selector post-entry', 'swm_blog_post',$swm_date_box_on );
		}		

		echo "<article class='".implode(" ", get_post_class($classes))."'  >";

		echo swm_post_date();

		echo '<div class="swm_post_content">';
		echo swm_post_title();
		echo '<div class="swm_post_format">';
		echo swm_display_post_format();			
		echo '</div>';

		echo swm_post_summary_content();
		
		echo '</div>';
		echo '</article>';

	endwhile;

	echo '</div>';

	echo '<div class="clear"></div>';

	echo '<div class="right">';
	swm_blog_pagination();
	echo '</div>';

	echo '<div class="clear"></div>';

	echo '</section>';

	wp_reset_postdata(); wp_reset_query();



?>