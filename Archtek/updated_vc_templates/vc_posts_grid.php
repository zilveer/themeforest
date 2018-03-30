<?php

extract(shortcode_atts(array(
    'grid_categories' => '',
    'grid_teasers_count' => '',
    'type' => 'grid',
    'grid_columns_count' => '3',
    'grid_layout' => 'thumbnail_title_text', 
    'display_thumbnail' => 'true',
    'display_meta' => 'true',
    'orderby' => 'ID',
    'order' => 'ASC',
    'el_class' => '',
), $atts));


if(trim($grid_categories) == '') {
    echo '<div class="error box">' . __('Cannot generate Blog Posts element. Categories must be defined.', 'uxbarn') . '</div>';
	return;
}
 
$columns_class = ' large-3 ';
if($grid_columns_count == '3') {
	$columns_class = ' large-4 ';
}

// Prepare values for different types
$type_class = '';
$thumbnail_size = 'theme-blog-element';
$thumbnail_class_array = array( 'class' => 'border' );

if($type == 'list') {
	
	$type_class = ' list-item-style ';
	$thumbnail_size = 'theme-tiny-square';
	$thumbnail_class_array = array();
	
}



// Use category name method (not recommended)

/*
$cat_id_array = array();

if(trim($grid_categories) != '') {
	
	$cat_array = explode(',', $grid_categories);
		
	foreach($cat_array as $cat_name) {
		
		$cat_id = get_cat_ID($cat_name);
		
		if($cat_id != 0) {
			array_push($cat_id_array, $cat_id);
		}
	}
	
}

echo var_dump($cat_id_array);

if(trim($grid_categories) == '' || empty($cat_id_array) ) {
    return '<div class="error box">' . __('Cannot generate Blog Posts shortcode. Categories must be defined.', 'uxbarn') . '</div>';
}

$columns_class = ' large-3 ';
if($grid_columns_count == 3) {
	$columns_class = ' large-4 ';
}

$args = array(); 
if($grid_teasers_count == '') {
    $args = array(
        'post_type' => 'post',
        'nopaging' => true,
        'category__in' => $cat_id_array,
        'orderby' => $orderby,
        'order' => $order,
    );
    
} else {
	
	if( ! is_numeric(trim($grid_teasers_count))) {
	    $grid_teasers_count = 4;
	}
		
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $grid_teasers_count,
        'category__in' => $cat_id_array,
        'orderby' => $orderby,
        'order' => $order,
    );
}
 */

// Use category ID method
$args = array(); 
if($grid_teasers_count == '') {
    $args = array(
        'post_type' => 'post',
        'nopaging' => true,
        'cat' => $grid_categories,
        'orderby' => $orderby,
        'order' => $order,
    );
    
} else {
	
	if( ! is_numeric(trim($grid_teasers_count))) {
	    $grid_teasers_count = 4;
	}
		
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $grid_teasers_count,
        'cat' => $grid_categories,
        'orderby' => $orderby,
        'order' => $order,
    );
}

$custom_posts = new WP_Query($args);

$output = '<div class="wpb_teaser_grid blog-element ' . $type_class . ' ' . $el_class . '">';
$col_run = 1;
$post_count_run = 1; // for comparing with the post count to check whether it's the last item
$max_col = $grid_columns_count;

if($custom_posts->have_posts()) {
    while($custom_posts->have_posts()) {
        $custom_posts->the_post();
		
	
		// Prepare all code strings to be set later
		$thumbnail_code = '';
		if(has_post_thumbnail() && $display_thumbnail == 'true') {
			
			// Default from Featured Image
			$thumbnail = get_the_post_thumbnail(get_the_ID(), $thumbnail_size, $thumbnail_class_array);
			
			// If there is alternate thumbnail specified, use it instead.
			$alt_thumbnail_url = uxbarn_get_array_value(get_post_meta(get_the_ID(), 'uxbarn_post_alternate_thumbnail'), 0);
			if(trim($alt_thumbnail_url) != '') {
				
				$attachment_id = uxbarn_get_attachment_id_from_src( $alt_thumbnail_url );
				
				// Get an array: [0] => url, [1] => width, [2] => height
				$thumbnail = wp_get_attachment_image( $attachment_id, $thumbnail_size, false, $thumbnail_class_array );
				
			}
			
			$thumbnail_code = 
				'<div class="blog-element-thumbnail">
					<a href="' . get_permalink() . '" class="image-link">' . $thumbnail . '</a>
				</div>';
		}
			
		$meta_code = 
			'<div class="blog-element-meta">
				<span class="blog-element-date">' . get_the_time(get_option('date_format')) . '</span>
				<a class="blog-element-comments" href="' . get_comments_link() . '">' . uxbarn_get_comment_count_text(get_comments_number()) . '</a>
			</div>';
			
		$title_code = '<h4 class="blog-element-title"><a href="' . get_permalink() . '">' . uxbarn_trim_string(get_the_title(), 70) . '</a></h4>';
		
		if($display_meta == 'true') {
			$title_code .= $meta_code;
		}
		
		
		if($type == 'grid') { // Grid style
	        
			$excerpt = uxbarn_get_array_value(get_post_meta(get_the_ID(), 'uxbarn_post_excerpt'), 0);
	        if(trim($excerpt) != '') {
	            $excerpt = uxbarn_the_excerpt_max_charlength($excerpt, 90);
	        } else {
	            $excerpt = uxbarn_the_excerpt_max_charlength( get_the_excerpt(), 90 );
	        }
			$excerpt_code = '<p>' . $excerpt . '</p>';
			
			// If it's the first column, start a new row
			if($col_run == 1) {
				$output .= '<div class="row">';
			}
			
			
			$output .= '<div class="uxb-col ' . $columns_class . ' columns">';
			
			if($grid_layout == 'title_thumbnail_text') {
				
				$output .= $title_code . $thumbnail_code . $excerpt_code;
				
			} else if($grid_layout == 'thumbnail_title_text') {
				
				$output .= $thumbnail_code . $title_code . $excerpt_code;
				
			} else if($grid_layout == 'thumbnail_text') {
				
				$output .= $thumbnail_code . $excerpt_code;
				
			} else if($grid_layout == 'thumbnail_title') {
					
				$output .= $thumbnail_code . $title_code;
				
			}
			
			$output .= '</div>'; // close class="uxb-col"
			
			//echo $post_count_run . ' ' . $custom_posts->post_count . '<br/>';
			
			// If it's the last item in that row OR it's the last item of this query, end the row
			if($col_run == $max_col || $post_count_run == $custom_posts->post_count) {
				$output .= '</div>'; // close the blog row
				$col_run = 1;
			} else {
				$col_run += 1;
			}
			
			$post_count_run += 1;
		
		} else { // if($type == 'grid') and this one is for "list" style
			
			$output .= '<div class="blog-element-item">';
			
			$has_thumbnail_class = '';
			if( ! has_post_thumbnail() ) {
				$has_thumbnail_class = ' no-thumbnail ';
			}
			
			$output .= $thumbnail_code . '<div class="blog-element-title-wrapper ' . $has_thumbnail_class . '">' . $title_code . '</div>';
			
			$output .= '</div>'; // close class="blog-element-item"
			
		}
		
	}
}

wp_reset_postdata();

$output .= '</div>'; // close class="wpb_teaser_grid"

echo $output;