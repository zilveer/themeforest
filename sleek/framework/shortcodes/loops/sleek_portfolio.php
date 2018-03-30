<?php

/*------------------------------------------------------------*/
/*	Add Shortcode
/*------------------------------------------------------------*/

// add_shortcode('portfolio', 'sleek_portfolio');



/*------------------------------------------------------------*/
/*	Shortcode: Portfolio
/*------------------------------------------------------------*/

/*
[portfolio posts_per_page="3" pagination="none" style="list" category="category-slug" sort_by="date" sort_order="DESC"]

@posts_per_page:
	- number
	- -1: unlimited
	- empty: [default] WP setting for posts per page
@pagination:
	-load_more [default]
	-pager TODO
	-none
@style:
	-list [default] TODO
	-masonry TODO
	-grid TODO
	-carousel TODO
@category:
	-category slug: show only chosen categories, separated by coma
	-empty: all categories selected
@sort_by:
	-date [default]
	-comment_count
	-[all worpdress order & orderby params supported]
@sort_order:
	-ASC
	-DESC [default]
*/

if( !function_exists( 'sleek_portfolio' ) ){
function sleek_portfolio($atts, $content = null) {

	extract( shortcode_atts( array(
		 'posts_per_page' 	=> get_option('posts_per_page')
		,'pagination' 		=> ''
		,'style' 			=> 'list'
		,'category' 		=> ''
		,'sort_by' 			=> ''
		,'sort_order' 		=> ''
	), $atts ) );

	// create new array to send as params
	$atts = array();
	$atts['posts_per_page'] = $posts_per_page;
	$atts['paged'] 			= 1;
	$atts['style'] 			= $style;
	$atts['category'] 		= $category;
	$atts['sort_by'] 		= $sort_by;
	$atts['sort_order'] 	= $sort_order;

	// get id for
	$id = 'sleek_'.uniqid();

	// call loop template with parameters
	$loop = sleek_portfolio_loop($atts);

	// return shortcode wrapper, pagination and returned content
	$output = '';
	$output .= '<div id="'.$id.'" data-shortcode="sleek_portfolio" data-posts_per_page="'.$posts_per_page.'" data-current_page="1" data-max_pages="'.$loop['max_num_pages'].'" data-style="'.$style.'" data-category="'.$category.'" data-sort_by="'.$sort_by.'" data-sort_order="'.$sort_order.'">';

		$output .= '<div class="loop-container">';
			$output .= $loop['html'];
		$output .= '</div>';

		// pagination
		if( ((int)$loop['max_num_pages'] > 1 )
			&& ( (int)$posts_per_page != -1 )
			&& ( $pagination != 'none' )
		){
			// return appropriate pagination
			switch ($pagination){
				case 'load_more':
					$output .= '<a class="js-load-more load-more load-more--sleek-loop js-skip-ajax no-js-hidden" href="#" data-id="'.$id.'">Load More</a>';
					break;
				case 'pager':
					$output .= 'PAGER';
					break;
			}
		}

	$output .= '</div>';

	return $output;
}



/*------------------------------------------------------------*/
/*	Loop: Portfolio
/*------------------------------------------------------------*/

function sleek_portfolio_loop($atts) {

	// d($atts);

	$query = new WP_Query( array(
		 'post_type' 			=> 'sleek-portfolio'
		,'posts_per_page' 		=> $atts['posts_per_page']
		,'paged' 				=> $atts['paged']
		,'category_portfolio' 	=> $atts['category']
		,'orderby' 				=> $atts['sort_by']
		,'order' 				=> $atts['sort_order']
	));
	// d($query);

	$max_num_pages = $query->max_num_pages;

	$html = '';
	if ( $query->have_posts() ):
	while ( $query->have_posts() ) : $query->the_post();

		$html .= '<article id="post-'.get_the_ID().'" class="'.implode(' ',get_post_class('post')).'" data-max_num_pages="'.$max_num_pages.'">';
		$html .= '<h2> Portfolio Loop: <a href="'.get_the_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h2>';

		$html .= get_the_term_list(get_the_ID(),'category_portfolio');

		$html .= sleek_get_wp_excerpt(5);

		$html .= '</article>';

		endwhile;
	else:
		$html .= __('Sorry, no posts were found.', 'sleek');
	endif;
	wp_reset_postdata();

	// generate and return output
	$output = array();
	$output['max_num_pages'] = $max_num_pages;
	$output['html'] = $html;
	return $output;
}
}