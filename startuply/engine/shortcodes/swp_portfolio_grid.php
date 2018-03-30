<?php

/*-----------------------------------------------------------------------------------*/
/*	Portfolio Grid VC Mapping (Backend)
/*-----------------------------------------------------------------------------------*/
			$portfolio_categs = get_terms('portfolio_cats', array(
				'hide_empty' => false
			));
			$portfolio_cats_array = array();
			foreach ($portfolio_categs as $portfolio_categ) {
				$portfolio_cats_array[$portfolio_categ->name] = $portfolio_categ->name;
			}



			vc_map(array(
				"name" => __("Portfolio Grid", "vivaco"),
				"icon" => "icon-sticky-notes",
				"base" => "vsc-portfolio-grid",
				"description" => "Masonry grid layout for portfolio items",
				"weight" => 20,
				"class" => "portfolio_grid_extended",
				"category" => __("Content", "vivaco"),
				"params" => array(
					array(
						"type" => "textfield",
						"class" => "",
						"admin_label" => true,
						"heading" => __("Number of items to display", "vivaco"),
						"param_name" => "number",
						"value" => 10,
						"description" => __("Use '-1' to include all your items", "vivaco")
					),
					array(
						"type" => "textfield",
						"class" => "",
						"admin_label" => true,
						"heading" => __("Number of columns", "vivaco"),
						"param_name" => "columns_number",
						"value" => 4,
						"description" => __("", "vivaco")
					),
					array(
						"type" => "textfield",
						"class" => "",
						"admin_label" => true,
						"heading" => __("Gutter width", "vivaco"),
						"param_name" => "gutter_width",
						"value" => '',
						"description" => __("this setting controls spacing between items e.g.: \"15\" will put 15px space from every side of an item", "vivaco")
					),
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => __("Show category filter controls?", "vivaco"),
						"param_name" => "show_filters",
						"value" => array(
							__( "Yes", "vivaco" ) => 'On',
							__( "No", "vivaco" ) => 'Off'
						),
						"description" => __("", "vivaco")
					),
					array(
						"type" => "checkbox",
						"class" => "",
						"heading" => __("Portfolio categories", "vivaco"),
						"param_name" => "categories",
						"value" => $portfolio_cats_array,
						"description" => __("Select from which categories to display (at least 1 required)", "vivaco")
					),
					array(
						'type' => 'colorpicker',
						'group' => 'Change color',
						'heading' => __('Custom Hover Color', 'vivaco'),
						'param_name' => 'hover_color',
					),
				)
			));





/*-----------------------------------------------------------------------------------*/
/*	Portfolio Grid Render (Front-end)
/*-----------------------------------------------------------------------------------*/
function vsc_portfolio_grid($atts, $content = null) {
	extract(shortcode_atts(array(
		"number" => "-1",
		"categories" => "",
		"columns_number" => "4",
		"show_filters" => "On",
		"gutter_width" => "",
		"hover_color" => ""
	), $atts));

	global $post;

	//setting a random id
	$rnd_id = vsc_random_id(3);

	$token = wp_generate_password(5, false, false);

	wp_enqueue_script('vsc-isotope');
	wp_enqueue_script('vsc-custom-isotope-portfolio');

	$args = array(
		'grid_manager' => 1,
		'grid_phone' => 1,
		'grid_tablet' => 2,
		'grid_small' => $columns_number,
		'grid_wide' => $columns_number,
		'grid_very_wide' => $columns_number,
		'grid_normal' => $columns_number,
		'grid_gutter_width' => 0
	);

	wp_localize_script('vsc-custom-isotope-portfolio', 'vsc_grid_' . $token, array(
		'id' => $rnd_id, 'gutter_width' => $gutter_width, 'vals' => $args
	));

	// wp_localize_script( 'vsc-custom-isotope-portfolio', 'vals', $args );

	$layout = get_post_meta($post->ID, 'vsc_portfolio_columns', true);
	$navig = get_post_meta($post->ID, 'vsc_portfolio_navigation', true);
	$nav_number = get_post_meta($post->ID, 'vsc_nav_number', true);

	$cats = explode(",", $categories);

	$portfolio_categs = get_terms('portfolio_cats', array(
		'hide_empty' => false
	));
	$categ_list = '';

	foreach ($cats as $categ) {
		foreach ($portfolio_categs as $portfolio_categ) {
			if ($categ === $portfolio_categ->name) {
				$categ_list .= $portfolio_categ->slug . ', ';
			}
		}
	}

	//fallback categories
	$args = array(
		'post_type' => 'portfolio',
		'taxonomy' => 'portfolio_cats'
	);
	$categ_fall = get_categories($args);
	$categ_use = array();
	$i = 0;
	foreach ($categ_fall as $cate) {
		$categ_use[$i] = $cate->name;
		$i++;
	}
	$cats = array_filter($cats);
	if (empty($cats)) {
		$cats = array_merge($cats, $categ_use);
	}


	$term_list = '';
	$list = '';

	if ($show_filters == 'On'){
		foreach ($cats as $cat) {
			$to_replace = array(
				' ',
				'/',
				'&'
			);
			$intermediate_replace = strtolower(str_replace($to_replace, '-', $cat));
			$str = preg_replace('/--+/', '-', $intermediate_replace);
			if (function_exists('icl_t')) {
				$term_list .= '<li><a class="btn btn-outline-color base_clr_txt base_clr_bg base_clr_brd" href="#filter" data-option-value=".' . get_taxonomy_cat_ID($cat) . '">' . icl_t('Portfolio Category', 'Term ' . get_taxonomy_cat_ID($cat) . '', $cat) . '</a></li>';
			} else
				$term_list .= '<li><a class="btn btn-outline-color base_clr_txt base_clr_bg base_clr_brd" href="#filter" data-option-value=".' . get_taxonomy_cat_ID($cat) . '">' . $cat . '</a></li>';
			$list .= $cat . ', ';
		}
	}


	$output = '';
	$output .= '<div class="vivaco-grid" id="gridwrapper_' . $rnd_id . '" data-token="' . $token . '">';
	$output .= '<div id="options">';
	$output .= '<ul id="filters" class="option-set clearfix" data-option-key="filter">';
	if ($show_filters == 'On'){
		$output .= '<li><a class="btn btn-outline-color base_clr_txt base_clr_bg base_clr_brd selected" href="#filter" data-option-value="*">' . __('All', 'vivaco') . '</a></li>';
	}
	$output .= $term_list;
	$output .= '</ul>';
	$output .= '</div>';
	$output .= '<div class="space"></div>';

	$output .= '<div id="portfolio-wrapper">';
	$output .= '<ul class="portfolio grid isotope grid_' . $rnd_id . '">';

	if ( $number != '-1' ) $number = intval($number);

	$args = array(
		'post_type' => 'portfolio',
		'posts_per_page' => $number,
		'term' => 'portfolio_cats',
		'portfolio_cats' => $categ_list,
		'orderby' => 'date',
		'order' => 'desc'
	);

	$my_query = new WP_Query($args);
	if ($my_query->have_posts()) {
		while ($my_query->have_posts()):
			$my_query->the_post();

			$terms = get_the_terms(get_the_ID(), 'portfolio_cats');
			$term_val = '';
			if ($terms) {
				foreach ($terms as $term) {
					$term_val .= get_taxonomy_cat_ID($term->name) . ' ';
				}
			}

			$port_box = get_post_meta($post->ID, 'vsc_port_box', true);
			$port_thumbnail = get_post_meta($post->ID, 'vsc_port_thumbnail', true);
			$port_link = get_post_meta($post->ID, 'vsc_port_link', true);
			$port_video = get_post_meta($post->ID, 'vsc_port_video', true);

			$lgal = get_post_meta($post->ID, 'vsc_port_gallery', true);

			$gal_output = '';
			if (!empty($lgal)) {
				foreach ($lgal as $gal_item) {
					$gal_item_url = $gal_item['vsc_gl_url']['url'];
					$gal_item_title = get_post($gal_item['vsc_gl_url']['id'])->post_excerpt;

					$gal_output .= '<a class="hidden_image " href="' . $gal_item_url . '" title="' . $gal_item_title . '"></a>';

				}
			}

			$thumb_id = get_post_thumbnail_id($post->ID);

			$image_url = wp_get_attachment_url($thumb_id);

			$grid_thumbnail = $image_url;
			$item_class = 'item-small';

			switch ($port_thumbnail) {
				case 'portfolio-big':
					//$grid_thumbnail = aq_resize($image_url, 566, 440, true);
					$grid_thumbnail = $image_url;
					$item_class = 'item-wide';
					break;
				case 'portfolio-small':
					//$grid_thumbnail = aq_resize($image_url, 305, 251, true);
					$grid_thumbnail = $image_url;
					$item_class = 'item-small';
					break;
				case 'half-horizontal':
					//$grid_thumbnail = aq_resize($image_url, 566, 219, true);
					$grid_thumbnail = $image_url;
					$item_class = 'item-long';
					break;
				case 'half-vertical':
					//$grid_thumbnail = aq_resize($image_url, 281, 440, true);
					$grid_thumbnail = $image_url;
					$item_class = 'item-high';
					break;
			}

			$copy = $terms;
			$res = '';
			if ($terms) {
				foreach ($terms as $term) {
					if (function_exists('icl_t')) {
						$res .= icl_t('Portfolio Category', 'Term ' . get_taxonomy_cat_ID($term->name) . '', $term->name);
					} else
						$res .= $term->name;
					if (next($copy)) {
						$res .= ', ';
					}
				}
			}

			$output .= '<li class="grid-item ' . $term_val . ' ' . $item_class . '">';

			$grid_thumbnail_size = false;

			$grid_thumbnail_path = $_SERVER['DOCUMENT_ROOT'] . parse_url($grid_thumbnail, PHP_URL_PATH);
			if ( !empty($grid_thumbnail) && file_exists($grid_thumbnail_path) ) {
				$grid_thumbnail_size = getimagesize($grid_thumbnail_path);
			}

			$inner_output = '';
			if ($grid_thumbnail_size) {
				$inner_output .= '<img src="' . $grid_thumbnail . '" width="' . $grid_thumbnail_size[0] . '" height="' . $grid_thumbnail_size[1] . '" alt="" />';
			} else {
				$inner_output .= '<img src="' . $grid_thumbnail . '" alt="" />';
			}

			$inner_output .= '<div class="grid-item-on-hover wave-mouseover" data-color="' . $hover_color . '">';
			$inner_output .= '<div class="grid-child">';
			$inner_output .= '<div class="grid-text-title"><h3 class="grid-item-title">' . get_the_title() . '</h3></div>';
			$inner_output .= '<div class="grid-text-subtitle"><span class="grid-item-subtitle">' . $res . '</span></div>';
			$inner_output .= '</div>';
			$inner_output .= '<div class="helper"></div>';
			$inner_output .= '</div>';

			$test_link = '';
			if ($port_box == 'link_to_page') {
				$test_link = '<a class="portfolio" href="' . get_permalink($post->ID) . '">' . $inner_output . '</a>';
			} else if ($port_box == 'link_to_link') {
				$test_link = '<a class="portfolio" href="' . $port_link . '">' . $inner_output . '</a>';
			} else if ($port_box == 'lightbox_to_image') {
				$test_link = '<a class="portfolio" href="' . wp_get_attachment_url($thumb_id) . '" data-pretty="prettyPhoto[port_gal]" title="' . get_the_title() . '">' . $inner_output . '</a>';
			} else if ($port_box == 'lightbox_to_video') {
				$test_link = '<a class="portfolio" href="' . $port_video . '" data-pretty="prettyPhoto[port_gal]" title="' . get_the_title() . '">' . $inner_output . '</a>';
			} else if ($port_box == 'lightbox_to_gallery') {
				$test_link = '<a href="' . wp_get_attachment_url($thumb_id) . '" data-pretty="prettyPhoto[gallery_' . $post->ID . ']" title="' . get_the_title() . '" >' . $inner_output . '</a>' . $gal_output;
			}

			$output .= $test_link;

			$output .= '</li>';
		endwhile;
	}
	wp_reset_query();
	$output .= '</ul>';
	$output .= '</div>';
	$output .= '</div>';
	$output .= '<div class="space"></div>';

	return $output;
}
add_shortcode("vsc-portfolio-grid", "vsc_portfolio_grid");
