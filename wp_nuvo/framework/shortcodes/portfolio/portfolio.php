<?php
add_shortcode('cs-portfolio', 'cs_portfolio_render');
add_action('wp_enqueue_scripts','add_lib_script');
function cs_portfolio_render($atts, $content = null) {
    $use_portfolio = 1;
    if($use_portfolio == 1 || $use_portfolio == true){
        global $post, $wp_query, $portfolio_options, $pagination_options;

        extract(shortcode_atts(array(
			'category' 				=> '',
			'type' 					=> 'grid',
			'columns' 				=> 3,
			'crop_image' 			=> false,
			'width_image' 			=> 300,
			'height_image' 			=> 200,
			'layout' 				=> 'style1',
			'style' 				=> 'style1',
			'filter' 				=> false,
			'show_pages' 			=> false,
			'show_pages_number' 	=> false,
			'show_page_nav' 		=> false,
			'show_title' 			=> false,
			'show_category' 		=> false,
			'show_description' 		=> false,
			'posts_per_page' 		=> -1,
			'max_posts_per_page' 	=> '',
			'excerpt_length' 		=> -1,
			'enlarge' 				=> '',
			'view_online' 			=> '',
			'read_more' 			=> '-1',
			'orderby' 				=> 'none',
			'order' 				=> 'none'
		), $atts));
		$layout=$style;
        $crop_image=($crop_image=='false')?false:$crop_image;
        // set post for page
		($posts_per_page == '')? $posts_per_page = -1 : "";

		//set page
        $paged = 1;

		// get max post
		$count_max_post = get_max_post(array(
			"category" 			=> $category,
			"posts_per_page" 	=> $posts_per_page,
			"orderby" 			=> $orderby,
			"paged" 			=> $paged,
			"max_post" 			=> true
		));

		// build args
		$args = build_args_portfolio(array(
			"category" 			=> $category,
			"posts_per_page" 	=> $posts_per_page,
			"orderby" 			=> $orderby,
			"paged" 			=> $paged
		));

		// set span
        $span = set_span_portfolio($columns);

		// set portfolio options
        $portfolio_options = set_portfolio_options(array(
			"span"				=> $span,
			"show_title"		=> $show_title,
			"show_category"		=> $show_category,
			"show_description"	=> $show_description,
			"excerpt_length"	=> $excerpt_length,
			"columns"			=> $columns,
			"crop_image"		=> $crop_image,
			"width_image"		=> $width_image,
			"height_image"		=> $height_image,
			"style"				=> $style,
			"enlarge"			=> $enlarge,
			"view_online"		=> $view_online,
			"read_more"			=> $read_more
		));

		// set pagination options
		$pagination_options = set_pagination_options(array(
			"show_pages"		=> $show_pages,
			"show_pages_number"	=> $show_pages_number,
			"show_page_nav"		=> $show_page_nav,
		));

		// add lib js

        $wp_query = new WP_Query($args);
		$count_post = $wp_query->post_count;
        ob_start();
        if ($wp_query->have_posts()) {
            // get filter
			if ($filter == true || $filter == 1) {
                get_template_part('framework/templates/portfolio/portfolio-filters');
            }

			// get portfolio items
			get_portfolio_items(array(
				"wp_query" 				=> $wp_query,
				"columns" 				=> $columns,
				"type" 					=> $type,
				"span" 					=> $span,
				"style" 				=> $style,
				"layout" 				=> $layout,
				"count_max_post"		=> $count_max_post,
				"count_post" 			=> $count_post,
				"max_posts_per_page" 	=> $max_posts_per_page
			));

			// js
			portfolio_js($atts);
		} else {
            echo "<span class='notfound'>No portfolio found!</span>";
        }
        wp_reset_query();
        wp_reset_postdata();
        return ob_get_clean();
    }else{
        return '';
    }
}

function get_max_post($arrayData){
	$args = build_args_portfolio($arrayData);
	$wp_query = new WP_Query($args);
	$count = $wp_query->post_count;
	return $count;
}

function build_args_portfolio($arrayData){
	extract($arrayData);
	if (isset($category) && $category != '') {
		$cats = explode(',', $category);
		$category = $term_cats = array();
		foreach ((array) $cats as $cat) :
			$category[] = trim($cat);
			$term_cats[] = get_term( $cat, 'portfolio_category' );
		endforeach;
		$args = array(
			'posts_per_page' => $posts_per_page,
			'tax_query' => array(
				array(
					'taxonomy' => 'portfolio_category',
					'field' => 'id',
					'terms' => $category
				)
			),
			'orderby' => $orderby,
			'order' => null,
			'post_type' => 'portfolio',
			'post_status' => 'publish',
			'paged' => $paged
		);
	} else {
		$args = array(
			'posts_per_page' => $posts_per_page,
			'orderby' => $orderby,
			'order' => null,
			'post_type' => 'portfolio',
			'post_status' => 'publish',
			'paged' => $paged
		);
	}
	if(isset($max_post) && $max_post == true){ $args['posts_per_page'] = -1; }
	if(isset($post__not_in)){ $args['post__not_in'] = $post__not_in; }
	return $args;
}

function set_span_portfolio($columns){
	$span = "";
    switch ($columns) {
        case 2: $span = " span6"; break;
        case 3: $span = " span4";  break;
        case 4: $span = " span3"; break;
        default: $span = "";
    }
	return $span;
}

function set_portfolio_options($arrayData){
	extract($arrayData);

	$portfolio_options = array();
	$portfolio_options['span'] = $span;
	$portfolio_options['show_title'] = $show_title;
	$portfolio_options['show_category'] = $show_category;
	$portfolio_options['show_description'] = $show_description;
	$portfolio_options['excerpt_length'] = $excerpt_length;
	$portfolio_options['columns'] = $columns;
	$portfolio_options['read_more'] = $read_more;
	$portfolio_options['crop_image'] = $crop_image;
	$portfolio_options['width_image'] = $width_image;
	$portfolio_options['height_image'] = $height_image;
	$portfolio_options['style'] = $style;
	$portfolio_options['enlarge'] = $enlarge;
	$portfolio_options['view_online'] = $view_online;

	return $portfolio_options;
}

function set_pagination_options($arrayData){
	extract($arrayData);

	$pagination_options = array();
	$pagination_options['show_pages'] = $show_pages;
	$pagination_options['show_pages_number'] = $show_pages_number;
	$pagination_options['show_page_nav'] = $show_page_nav;

	return $pagination_options;
}

function add_lib_script(){
	wp_enqueue_style('colorbox');
	wp_enqueue_style('portfolio-css', get_template_directory_uri().'/framework/shortcodes/portfolio/portfolio.css',array(), '1.0.0', 'all');
}

function get_portfolio_items($arrayData){
	extract($arrayData);
	if ($wp_query->have_posts()) {
		echo '<div id="cs_portfolio" class="cs-portfolio cs-portfolio-'.esc_attr($layout).' cs-portfolio-col'.esc_attr($columns).' '.esc_attr($style).'" data-columns="'.esc_attr($columns).'" data-type="'.esc_attr($type).'">';
		while ($wp_query->have_posts()) {
			$wp_query->the_post();
			$terms = get_the_terms($wp_query->post->ID, "portfolio_category");
			$project_cats = NULL;
			$project_names = array();
			if (!empty($terms)) {
				foreach ($terms as $term) {
					$project_cats .= strtolower($term->slug) . ' ';
					$project_names[] = $term->name;
				}
			}
			$_id = get_the_ID();
			echo 	"<div class='cs-portfolio-item class-test ".esc_attr($project_cats)."' data-id='".esc_attr($_id)."'>";
						get_template_part('framework/templates/portfolio/post', $layout);
			echo 	"</div>";
		}
		echo "</div>";

		if($count_max_post <= $max_posts_per_page){ $max_post = $count_max_post;
		}else if($count_max_post > $max_posts_per_page){
			if($max_posts_per_page == '-1'){ $max_post = $count_max_post;
			}else{ $max_post = $max_posts_per_page; }
		}else if($max_posts_per_page == ''){ $max_post = 0; }

		echo ($max_post != 0 && ($count_post < $max_post))? "<div id='cs-count-post-portfolio'>{$count_post} / {$max_post}</div>" : "";
	}
}

function portfolio_js($stringJSON){
    wp_register_script('isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js',array(), 'jquery', '1.0');
    wp_enqueue_script('isotope');
    wp_register_script('cs-jm-direction', get_template_directory_uri() . '/js/jquery.jm-direction.js', array(), '1.0');
    wp_enqueue_script('cs-jm-direction');
    wp_enqueue_script('jquery-colorbox');
	wp_register_script( 'cs_custom_portfolio', get_template_directory_uri() . '/js/custom_portfolio.js' );
	wp_localize_script( 'cs_custom_portfolio', 'cs_custom_portfolio', $stringJSON );
	wp_localize_script( 'cs_custom_portfolio', 'cs_custom_portfolio_ajaxurl', array('url'=>admin_url('admin-ajax.php')));
	wp_enqueue_script( 'cs_custom_portfolio' );
}

#################
// ajax handle //
#################
add_action("wp_ajax_get_items_portfolio", "get_items_portfolio");
add_action("wp_ajax_nopriv_get_items_portfolio", "get_items_portfolio");
function get_items_portfolio(){
	global $post, $wp_query, $portfolio_options, $pagination_options;
	extract($_REQUEST);

	(!isset($category))? $category = "" : "";
	(!isset($enlarge))? $enlarge = "" : "";
	(!isset($show_pages_number))? $show_pages_number = false : "";
	(!isset($show_page_nav))? $show_page_nav = false : "";
	(!isset($show_pages))? $show_pages = false : "";
	(!isset($crop_image))? $crop_image = false : "";
	$paged = 1;


	// get max post no limit
	$count_max_post = get_max_post(array(
		"category" 			=> $category,
		"posts_per_page" 	=> $posts_per_page,
		"orderby" 			=> $orderby,
		"paged" 			=> $paged,
		"max_post" 			=> true
	));

	$post__not_in = not_in($post_has);

	// build args
	$args = build_args_portfolio(array(
		"category" 			=> $category,
		"posts_per_page" 	=> $posts_per_page,
		"orderby" 			=> $orderby,
		"paged" 			=> $paged,
		"post__not_in"		=> $post__not_in
	));
	//print_r($args);die;
	// set span
	$span = set_span_portfolio($columns);

	// set portfolio options
	$portfolio_options = set_portfolio_options(array(
		"span"				=> $span,
		"show_title"		=> $show_title,
		"show_category"		=> $show_category,
		"show_description"	=> $show_description,
		"excerpt_length"	=> $excerpt_length,
		"columns"			=> $columns,
		"crop_image"		=> $crop_image,
		"width_image"		=> $width_image,
		"height_image"		=> $height_image,
		"style"				=> $style,
		"enlarge"			=> $enlarge,
		"view_online"		=> $view_online,
		"read_more"			=> $read_more
	));

	// set pagination options
	$pagination_options = set_pagination_options(array(
		"show_pages"		=> $show_pages,
		"show_pages_number"	=> $show_pages_number,
		"show_page_nav"		=> $show_page_nav,
	));

	$wp_query = new WP_Query($args);
	$resultHtml = build_item_portfolio(array(
		"wp_query" 		=> $wp_query,
		"columns" 		=> $columns,
		"type" 			=> $type,
		"span" 			=> $span,
		"style" 		=> $style,
		"position_top" 	=> $position_top,
		"layout" 		=> $layout
	));

	$result = array(
		"html"				=> $resultHtml,
		"count_max_post" 	=> $count_max_post
	);
	echo json_encode($result);

	die;
}

function not_in($string){
	$arr = explode(',', $string);
	return $arr;
}

function build_item_portfolio($arrayData){
	extract($arrayData);
	if ($wp_query->have_posts()) {
		ob_start();
		while ($wp_query->have_posts()) {
			$wp_query->the_post();
			$terms = get_the_terms($wp_query->post->ID, "portfolio_category");
			$project_cats = NULL;
			$project_names = array();
			if (!empty($terms)) {
				foreach ($terms as $term) {
					$project_cats .= strtolower($term->slug) . ' ';
					$project_names[] = $term->name;
				}
			}
			$_id = get_the_ID();
			echo 	"<div class='cs-portfolio-item ".esc_attr($project_cats)."' post-id='".esc_attr($_id)."'>";
						get_template_part('framework/templates/portfolio/post', $layout);
			echo 	"</div>";
		}
	}
	return ob_get_clean();
}
?>