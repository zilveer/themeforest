<?php
/**
 * Portfolios
 * @package by Theme Record
 * @auther: MattMao
*/
add_shortcode('portfolio', 'theme_portfolio_list');

function theme_portfolio_list( $atts, $content = null)
{
	extract(shortcode_atts(
        array(
			'column' => '3',
			'cat' => '',
			'posts_per_page' => '9'
    ), $atts));

	$cat_array = explode(',', $cat);

	if(empty($cat_array[0]))
	{
		$cat_args = array(	
			'taxonomy'	=> 'portfolio-category',
			'hide_empty'=> 0
		);

	}
	else
	{
		$cat_args = array(	
			'taxonomy'	=> 'portfolio-category',
			'include' => $cat_array,
			'hide_empty'=> 0
		);
	}
	
	$output = '<div class="portfolio-list portfolio-classic-list">'."\n";
	$output .= theme_portfolio_loop($column, $cat_array, $posts_per_page);
	$output .= '</div>'."\n";

	return $output;
}



function theme_portfolio_loop($column, $cat_array, $posts_per_page) 
{
	global $post;

	if(empty($cat_array[0]))
	{
		$args = array( 
			'post_type' => 'portfolio',
			'posts_per_page' => $posts_per_page,
			'order' => 'ASC',
			'orderby' => 'menu_order',
			'post_status' => 'publish'
		);
	}
	else
	{
		$args = array(
			'post_type' => 'portfolio',
			'posts_per_page' => $posts_per_page,
			'order' => 'ASC',
			'orderby' => 'menu_order',
			'post_status' => 'publish',
			'tax_query' => array( 
				array( 
					'taxonomy' => 'portfolio-category', 
					'field' => 'id', 
					'terms' => $cat_array, 
					'operator' => 'IN'
				)
			)
		);
	}
	
	$query = new WP_Query( $args );

	switch($column)
	{
		case 2: $col = 'col-2-1'; $size = 'column-2'; break;
		case 3: $col = 'col-3-1'; $size = 'column-3'; break;
		case 4: $col = 'col-4-1'; $size = 'column-4'; break;
	}

	$output = '<ul class="clearfix">'."\n";

	while ($query->have_posts()) 
	{ 
		$query->the_post();
		$title = get_the_title();

		#
		#Get icon
		#
		$media_type = get_meta_option('portfolio_type');

		switch($media_type)
		{
			case 'image': $icon = 'item-image'; break;
			case 'slideshow': $icon = 'item-gallery'; break;
			case 'video': $icon = 'item-video'; break;
		}

		#
		#Get item class
		#
		$item_class = 'class="item post-item '.$icon.' '.$col.'"';

		if(has_post_thumbnail())
		{
			$output .= '<li '.$item_class.'>'."\n";
			$output .= '<div class="post-thumb post-thumb-hover post-thumb-preload">';
			$output .= '<a href="'.get_permalink().'" title="'.$title.'" class="loader-icon">';
			$output .= get_featured_image($post_id=NULL, $size, 'wp-preload-image', $title);
			$output .= '</a>';
			$output .= '</div>'."\n";
			$output .= '<h1 class="title"><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h1>'."\n";
			$output .= get_the_term_list( $post->ID, 'portfolio-category', '<div class="cats meta">', ', ', '</div>' );
			$output .= '</li>'."\n";
		}

	}
	wp_reset_postdata();

	$output .= '</ul>'."\n";

	return $output;
}

?>