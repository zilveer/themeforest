<?php
/**
 * Product Slide
 * @package by Theme Record
 * @auther: MattMao
*/
add_shortcode('product_slide', 'theme_product_slide_list');

function theme_product_slide_list( $atts, $content = null)
{
	extract(shortcode_atts(
        array(
			'title' => 'Recent Products',
			'cat' => '',
			'posts_per_page' => '8',
    ), $atts));

	$cat_array = explode(',', $cat);

	$output = '<div class="product-slide-list post-slide-list post-carousel">'."\n";
	$output .= '<h3 class="title">'.$title.'</h3>'."\n";
	$output .= theme_product_slide_loop($title, $cat_array, $posts_per_page);
	$output .= '</div>'."\n";

	return $output;
}


function theme_product_slide_loop($title, $cat_array, $posts_per_page) 
{
	global $post;

	if(empty($cat_array[0]))
	{
		$args = array( 
			'post_type' => 'product',
			'posts_per_page' => $posts_per_page,
			'post_status' => 'publish'
		);
	}
	else
	{
		$args = array(
			'post_type' => 'product',
			'posts_per_page' => $posts_per_page,
			'post_status' => 'publish',
			'tax_query' => array( 
				array( 
					'taxonomy' => 'product-category', 
					'field' => 'id', 
					'terms' => $cat_array, 
					'operator' => 'IN'
				)
			)
		);
	}
	
	$query = new WP_Query( $args );

	global $tr_config;
	$currency = $tr_config['currency'];
	$loop_count = 0;

	$output = '<ul class="clearfix">'."\n";

	while ($query->have_posts()) 
	{ 
		$query->the_post();
		$title = get_the_title();
		$loop_count++; 
		$product_price = get_meta_option('product_price');


		if(has_post_thumbnail())
		{
			$output .= '<li>'."\n";
			$output .= '<div class="post-thumb post-thumb-hover post-thumb-preload">';
			$output .= '<a href="'.get_permalink().'" title="'.$title.'" class="loader-icon">';
			$output .= get_featured_image($post_id=NULL, 'column-4', 'wp-preload-image', $title);
			$output .= '</a>';
			$output .= '</div>'."\n";			
			$output .= '<h1 class="item-title"><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h1>'."\n";
			if($product_price) { $output .= '<div class="price meta"><span>'.price_currency_symbol($currency).'</span>'.$product_price.'</div>'; }
			$output .= '</li>'."\n";
		}

	}
	wp_reset_postdata();

	$output .= '</ul>'."\n";

	return $output;
}

?>