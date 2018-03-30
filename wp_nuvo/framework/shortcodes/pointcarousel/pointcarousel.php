<?php
add_shortcode('cs-pointcarousel', 'cs_point_carousel_render');

function cs_point_carousel_render($atts, $content = null) {
	global $post, $wp_query;
	extract(shortcode_atts(array(
		'title' => '',
		'heading_size' =>'h3',
		'title_color' =>'',
		'subtitle' => '',
		'subtitle_heading_size'=>'h4',
		'description' => '',
		'category' => '',
		'styles'=> 'style-1',
		'crop_image' => false,
		'width_image' => 300,
		'height_image' => 200,
		'width_item' => 150,
		'margin_item' => 20,
		'auto_scroll' => 'false',
		'show_nav' => false,
		'same_height' => false,
		'show_title' => true,
		'show_description' => true,
		'excerpt_length' => 100,
		'read_more' => '',
		'rows' => 1,
		'posts_per_page' => 12,
		'meta_key' => '',
		'meta_value' => '',
		'orderby' => 'none',
		'order' => 'none',
		'el_class' => ''
	), $atts));
	$crop_image=($crop_image=='false')?false:$crop_image;
	
	$args = array(
			'posts_per_page' => $posts_per_page,
			'orderby' => $orderby,
			'order' => $order,
			'post_type' => 'pointofsale',
			'post_status' => 'publish'
	);
	
	if (isset($category) && $category != '') {
	
		$cats = explode(',', $category);
	
		$args['tax_query'] = array(
				array(
						'taxonomy' => 'pointofsale_category',
						'field' => 'term_id',
						'terms' => $cats
				)
		);
	}
	
	$wp_query = new WP_Query($args);

	$date = time() . '_' . uniqid(true);
	ob_start();

	wp_register_script('bxslider', get_template_directory_uri() . '/js/jquery.bxslider.js', 'jquery', '1.0', TRUE);
	wp_register_script('jm-bxslider', get_template_directory_uri() . '/js/jquery.jm-bxslider.js', 'jquery', '1.0', TRUE);

	wp_enqueue_script('jquery-colorbox');
	wp_enqueue_script('bxslider');
	wp_enqueue_script('jm-bxslider');
	$cl_show = '';
	if ($title != "" || $description != "") {
		$cl_show .= 'show-header';
	}
	if ($show_nav == true || $show_nav == 1) {
		$cl_show .= ' show-nav';
	}
	/* */
	$_title_color = '';
	if($title_color){
	    $_title_color = 'style="color:'.$title_color.'!important;"';
	}

 	require get_template_directory()."/framework/shortcodes/pointcarousel/styles/$styles.php";
    wp_reset_postdata();
    return ob_get_clean();
}