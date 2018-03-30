<?php
/* Porfolio Pagination Simple Function */
if (!function_exists('pagenavi')) { 
	function pagenavi($query, $before = '', $after = '') {
	    
	    wp_reset_query();
	    global $wpdb, $paged;
	    
	    $pagenavi_options = array();
	    //$pagenavi_options['pages_text'] = ('Page %CURRENT_PAGE% of %TOTAL_PAGES%:');
	    $pagenavi_options['pages_text'] = ('');
	    $pagenavi_options['current_text'] = '%PAGE_NUMBER%';
	    $pagenavi_options['page_text'] = '%PAGE_NUMBER%';
	    $pagenavi_options['first_text'] = __('First Page', 'js_composer');
	    $pagenavi_options['last_text'] = __('Last Page', 'js_composer');
	    $pagenavi_options['next_text'] = __("Next", "js_composer");
	    $pagenavi_options['prev_text'] = __("Previous", "js_composer");
	    $pagenavi_options['dotright_text'] = '...';
	    $pagenavi_options['dotleft_text'] = '...';
	    $pagenavi_options['num_pages'] = 5; //continuous block of page numbers
	    $pagenavi_options['always_show'] = 0;
	    $pagenavi_options['num_larger_page_numbers'] = 0;
	    $pagenavi_options['larger_page_numbers_multiple'] = 5;
	 
	 	$output = "";
	 	
	    //If NOT a single Post is being displayed
	    if (!is_single()) {
	        $request = $query->request;
	        //intval - Get the integer value of a variable
	        $posts_per_page = intval(get_query_var('posts_per_page'));
	        //Retrieve variable in the WP_Query class.
	        if ( get_query_var('paged') ) {
	        $paged = get_query_var('paged');
	        } elseif ( get_query_var('page') ) {
	        $paged = get_query_var('page');
	        } else {
	        $paged = 1;
	        }
	        $numposts = $query->found_posts;
	        $max_page = $query->max_num_pages;
	 
	        //empty - Determine whether a variable is empty
	        if(empty($paged) || $paged == 0) {
	            $paged = 1;
	        }
	 
	        $pages_to_show = intval($pagenavi_options['num_pages']);
	        $larger_page_to_show = intval($pagenavi_options['num_larger_page_numbers']);
	        $larger_page_multiple = intval($pagenavi_options['larger_page_numbers_multiple']);
	        $pages_to_show_minus_1 = $pages_to_show - 1;
	        $half_page_start = floor($pages_to_show_minus_1/2);
	        //ceil - Round fractions up (http://us2.php.net/manual/en/function.ceil.php)
	        $half_page_end = ceil($pages_to_show_minus_1/2);
	        $start_page = $paged - $half_page_start;
	 
	        if($start_page <= 0) {
	            $start_page = 1;
	        }
	 
	        $end_page = $paged + $half_page_end;
	        if(($end_page - $start_page) != $pages_to_show_minus_1) {
	            $end_page = $start_page + $pages_to_show_minus_1;
	        }
	        if($end_page > $max_page) {
	            $start_page = $max_page - $pages_to_show_minus_1;
	            $end_page = $max_page;
	        }
	        if($start_page <= 0) {
	            $start_page = 1;
	        }
	 
	        $larger_per_page = $larger_page_to_show*$larger_page_multiple;
	        //round_num() custom function - Rounds To The Nearest Value.
	        $larger_start_page_start = (round_num($start_page, 10) + $larger_page_multiple) - $larger_per_page;
	        $larger_start_page_end = round_num($start_page, 10) + $larger_page_multiple;
	        $larger_end_page_start = round_num($end_page, 10) + $larger_page_multiple;
	        $larger_end_page_end = round_num($end_page, 10) + ($larger_per_page);
	 
	        if($larger_start_page_end - $larger_page_multiple == $start_page) {
	            $larger_start_page_start = $larger_start_page_start - $larger_page_multiple;
	            $larger_start_page_end = $larger_start_page_end - $larger_page_multiple;
	        }
	        if($larger_start_page_start <= 0) {
	            $larger_start_page_start = $larger_page_multiple;
	        }
	        if($larger_start_page_end > $max_page) {
	            $larger_start_page_end = $max_page;
	        }
	        if($larger_end_page_end > $max_page) {
	            $larger_end_page_end = $max_page;
	        }
	        if($max_page > 1 || intval($pagenavi_options['always_show']) == 1) {
	            $pages_text = str_replace("%CURRENT_PAGE%", number_format_i18n($paged), $pagenavi_options['pages_text']);
	            $pages_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pages_text);
	            $output .= $before.'<ul class="pagenavi">'."\n";
	 
	            if(!empty($pages_text)) {
	                $output .= '<li><span class="pages">'.$pages_text.'</span></li>';
	            }
	            if ($paged > 1) {
	            $output .= '<li class="prev">' . get_previous_posts_link($pagenavi_options['prev_text']) . '</li>';
	 			}
	 			
	            if ($start_page >= 2 && $pages_to_show < $max_page) {
	                $first_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['first_text']);
	                $output .= '<li><a href="'.esc_url(get_pagenum_link()).'" class="first" title="'.$first_page_text.'">1</a></li>';
	                if(!empty($pagenavi_options['dotleft_text'])) {
	                    $output .= '<li><span class="expand">'.$pagenavi_options['dotleft_text'].'</span></li>';
	                }
	            }
	 
	            if($larger_page_to_show > 0 && $larger_start_page_start > 0 && $larger_start_page_end <= $max_page) {
	                for($i = $larger_start_page_start; $i < $larger_start_page_end; $i+=$larger_page_multiple) {
	                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
	                    $output .= '<li><a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a></li>';
	                }
	            }
	 
	            for($i = $start_page; $i  <= $end_page; $i++) {
	                if($i == $paged) {
	                    $current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
	                    $output .= '<li><span class="current">'.$current_page_text.'</span></li>';
	                } else {
	                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
	                    $output .= '<li><a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a></li>';
	                }
	            }
	 
	            if ($end_page < $max_page) {
	                if(!empty($pagenavi_options['dotright_text'])) {
	                    $output .= '<li><span class="expand">'.$pagenavi_options['dotright_text'].'</span></li>';
	                }
	                $last_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['last_text']);
	                $output .= '<li><a href="'.esc_url(get_pagenum_link($max_page)).'" class="last" title="'.$last_page_text.'">'.$max_page.'</a></li>';
	            }
	            $output .= '<li class="next">' . get_next_posts_link($pagenavi_options['next_text'], $max_page) . '</li>';
	 
	            if($larger_page_to_show > 0 && $larger_end_page_start < $max_page) {
	                for($i = $larger_end_page_start; $i <= $larger_end_page_end; $i+=$larger_page_multiple) {
	                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
	                    $output .= '<li><a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a></li>';
	                }
	            }
	            $output .= '</ul>'.$after."\n";
	        }
	    }
	    
	    return $output;
	}
}

/* Infinite Scroll Pagination */
if (!function_exists('pagenavi_infinite')) { 
	function pagenavi_infinite($query, $before = '', $after = '') {
	    
	    wp_reset_query();
	    global $wpdb, $paged;
	    
	    $pagenavi_options = array();
	    //$pagenavi_options['pages_text'] = ('Page %CURRENT_PAGE% of %TOTAL_PAGES%:');
	    $pagenavi_options['pages_text'] = ('');
	    $pagenavi_options['current_text'] = '%PAGE_NUMBER%';
	    $pagenavi_options['page_text'] = '%PAGE_NUMBER%';
	    $pagenavi_options['next_text'] = __("Show More", "js_composer");
	    $pagenavi_options['num_pages'] = 5; //continuous block of page numbers
	    $pagenavi_options['always_show'] = 0;
	    $pagenavi_options['num_larger_page_numbers'] = 0;
	    $pagenavi_options['larger_page_numbers_multiple'] = 5;
	 
	 	$output = "";
	 	
	    //If NOT a single Post is being displayed
	    if (!is_single()) {
	        $request = $query->request;
	        //intval - Get the integer value of a variable
	        $posts_per_page = intval(get_query_var('posts_per_page'));
	        //Retrieve variable in the WP_Query class.
	        if ( get_query_var('paged') ) {
	        $paged = get_query_var('paged');
	        } elseif ( get_query_var('page') ) {
	        $paged = get_query_var('page');
	        } else {
	        $paged = 1;
	        }
	        $numposts = $query->found_posts;
	        $max_page = $query->max_num_pages;
	 
	        //empty - Determine whether a variable is empty
	        if(empty($paged) || $paged == 0) {
	            $paged = 1;
	        }
	 
	        $pages_to_show = intval($pagenavi_options['num_pages']);
	        $larger_page_to_show = intval($pagenavi_options['num_larger_page_numbers']);
	        $larger_page_multiple = intval($pagenavi_options['larger_page_numbers_multiple']);
	        $pages_to_show_minus_1 = $pages_to_show - 1;
	        $half_page_start = floor($pages_to_show_minus_1/2);
	        //ceil - Round fractions up (http://us2.php.net/manual/en/function.ceil.php)
	        $half_page_end = ceil($pages_to_show_minus_1/2);
	        $start_page = $paged - $half_page_start;
	 
	        if($start_page <= 0) {
	            $start_page = 1;
	        }
	 
	        $end_page = $paged + $half_page_end;
	        if(($end_page - $start_page) != $pages_to_show_minus_1) {
	            $end_page = $start_page + $pages_to_show_minus_1;
	        }
	        if($end_page > $max_page) {
	            $start_page = $max_page - $pages_to_show_minus_1;
	            $end_page = $max_page;
	        }
	        if($start_page <= 0) {
	            $start_page = 1;
	        }
	 
	        $larger_per_page = $larger_page_to_show*$larger_page_multiple;
	        //round_num() custom function - Rounds To The Nearest Value.
	        $larger_start_page_start = (round_num($start_page, 10) + $larger_page_multiple) - $larger_per_page;
	        $larger_start_page_end = round_num($start_page, 10) + $larger_page_multiple;
	        $larger_end_page_start = round_num($end_page, 10) + $larger_page_multiple;
	        $larger_end_page_end = round_num($end_page, 10) + ($larger_per_page);
	 
	        if($larger_start_page_end - $larger_page_multiple == $start_page) {
	            $larger_start_page_start = $larger_start_page_start - $larger_page_multiple;
	            $larger_start_page_end = $larger_start_page_end - $larger_page_multiple;
	        }
	        if($larger_start_page_start <= 0) {
	            $larger_start_page_start = $larger_page_multiple;
	        }
	        if($larger_start_page_end > $max_page) {
	            $larger_start_page_end = $max_page;
	        }
	        if($larger_end_page_end > $max_page) {
	            $larger_end_page_end = $max_page;
	        }

	        if($max_page > 1 || intval($pagenavi_options['always_show']) == 1) {
	            $pages_text = str_replace("%CURRENT_PAGE%", number_format_i18n($paged), $pagenavi_options['pages_text']);
	            $pages_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pages_text);
	            $output .= $before.'<ul class="pagenavi">'."\n";
	 
	            if(!empty($pages_text)) {
	                $output .= '<li><span class="pages">'.$pages_text.'</span></li>';
	            }

	            $output .= '<li class="next">'.get_next_posts_link($pagenavi_options['next_text'], $max_page).'</li>';
	 
	            $output .= '</ul>'.$after."\n";
	        }
	    }
	    
	    return $output;
	}
}

// Shortcode
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass($el_class);

global $post;

// Narrow by categories
if($portfolio_categories == 'portfolio')
$portfolio_categories = '';

// Post teasers count
if ( $portfolio_post_number != '' && !is_numeric($portfolio_post_number) ) $portfolio_post_number = -1;
if ( $portfolio_post_number != '' && is_numeric($portfolio_post_number) ) $portfolio_post_number = $portfolio_post_number;

// Columns
$portfolio_full = null;
if ($portfolio_wall==true) {
	$portfolio_full = 'portfolio-full-width wall-effect';

	if ( $portfolio_columns_count=="2clm") { $portfolio_columns_count = 'col-full-6'; }
	if ( $portfolio_columns_count=="3clm") { $portfolio_columns_count = 'col-full-4'; }
	if ( $portfolio_columns_count=="4clm") { $portfolio_columns_count = 'col-full-3'; }
	if ( $portfolio_columns_count=="5clm") { $portfolio_columns_count = 'col-full-2'; }
	if ( $portfolio_columns_count=="6clm") { $portfolio_columns_count = 'col-full-1'; }
} 

else {
	$portfolio_full = 'portfolio-normal-width';

	if ( $portfolio_columns_count=="2clm") { $portfolio_columns_count = 'col-md-6'; }
	if ( $portfolio_columns_count=="3clm") { $portfolio_columns_count = 'col-md-4'; }
	if ( $portfolio_columns_count=="4clm") { $portfolio_columns_count = 'col-md-3'; }
	if ( $portfolio_columns_count=="5clm") { $portfolio_columns_count = 'col-md-3'; }
	if ( $portfolio_columns_count=="6clm") { $portfolio_columns_count = 'col-md-3'; }
}

// Portfolio-Listed
if ($portfolio_layout=="listed-portfolio") {
	$portfolio_full = 'portfolio-listed wall-effect';
	$portfolio_columns_count = 'col-listed-1';
}

// Portfolio-Masonry-Block
if ($portfolio_layout=="masonry-block-portfolio") {
	$portfolio_full = 'portfolio-masonry-block wall-effect';
	$portfolio_columns_count = 'col-block-1';
}

// Carousel Portfolio
if ($portfolio_layout=="carousel-portfolio") {
	$portfolio_columns_count = 'col-carousel-1';
}

// Striped Portfolio
if ($portfolio_layout=="striped-portfolio") {
	$portfolio_full = 'portfolio-striped wall-effect';
	$portfolio_columns_count = 'col-striped-1';
}

// Scrollable Portfolio
if ($portfolio_layout=="scrollable-portfolio") {
	$portfolio_full = 'portfolio-scrollable wall-effect';
	$portfolio_columns_count = 'col-scrollable-1';
}

// Pagination
if ( get_query_var('paged') ) {
	$paged = get_query_var('paged');
} elseif ( get_query_var('page') ) {
	$paged = get_query_var('page');
} else {
	$paged = 1;
}

// Arguments
$args = array( 
	'posts_per_page' => $portfolio_post_number, 
	'post_type' => 'portfolio',
	'paged' => $paged,
	'project-category' => $portfolio_categories,
	'orderby' => $orderby,
	'order' => $order
);

// Common Classes
$portfolio_sortable = null;
if ($portfolio_wall==true) {
	$portfolio_sortable = 'portfolio-full-width';
} else {
	$portfolio_sortable = 'portfolio-normal-width';
}

// Animation
$animation_loading_class = null;
if ($animation_loading == "yes") {
	$animation_loading_class = ' animated-content ';
}

$animation_effect_class = null;
if ($animation_loading == "yes") {
	$animation_effect_class = $animation_loading_effects;
} else {
	$animation_effect_class = '';
}

$animation_delay_class = null;
if ($animation_loading == "yes" && !empty($animation_delay)) {
	$animation_delay_class = ' data-delay="'.$animation_delay.'"';
}

// Carousel
$carousel_mode = null;
$carousel_data = null;
if ($portfolio_layout == 'carousel-portfolio') {
	$carousel_mode = 'carousel-enabled';
	$carousel_data = 'data-items="'.$carousel_portfolio_item.'" data-navigation="'.$carousel_portfolio_navigation.'" data-pagination="'.$carousel_portfolio_pagination.'" data-autoplay="'.$carousel_portfolio_autoplay.'" data-items-tablet="'.$carousel_portfolio_item_tablet.'" data-items-mobile="'.$carousel_portfolio_item_mobile.'"';
} else {
	$carousel_mode = null;
	$carousel_data = null;
}


// Run query
$my_query = new WP_Query($args);

$filter_enabled = null;
$filter_animation = null;

if($portfolio_sortable_animation == "yes") {
	$filter_animation = ' filter-animated';
}

if($portfolio_sortable_mode == "yes" && $portfolio_layout=="grid-portfolio" || $portfolio_layout == "masonry-portfolio" || $portfolio_layout == "listed-portfolio" || $portfolio_layout == "masonry-block-portfolio") {
	$filter_enabled = 'isotope'.$filter_animation.'';
} else {
	$filter_enabled = 'no-isotope';
}
if($portfolio_sortable_mode == "yes" && $portfolio_layout=="grid-portfolio" || $portfolio_sortable_mode == "yes" && $portfolio_layout=="masonry-portfolio" || $portfolio_sortable_mode == "yes" && $portfolio_layout=="listed-portfolio" || $portfolio_sortable_mode == "yes" && $portfolio_layout=="masonry-block-portfolio") {
$output .= '<div id="portfolio-filter" class="row '.$portfolio_sortable.'">
				<ul class="option-set" data-option-key="filter">
					<li class="has-items"><a class="selected drop-selected" href="#filter" data-option-value="*">'.$portfolio_sortable_name.'</a></li>';
					// If you change the order of filter category
					$args_mod = array(
	                    'orderby'                  => 'name',
	                    'order'                    => 'ASC',
	                    'taxonomy'                 => 'project-category'
					);

					$list_categories = get_categories($args_mod);
					//$list_categories = get_categories("taxonomy=project-category");

					foreach ($list_categories as $list_category) :
					if(empty($portfolio_categories)){
						$output .= '<li><a href="#filter" class="' . strtolower(str_replace(" ","-", ($list_category->slug))) . '" data-option-value=".' . strtolower(str_replace(" ","-", ($list_category->slug))) . '">' . $list_category->name . '</a></li>';
					}
					else{
						if(strstr($portfolio_categories, $list_category->slug))
						{	
							$output .= '<li><a href="#filter" class="' . strtolower(str_replace(" ","-", ($list_category->slug))) . '" data-option-value=".' . strtolower(str_replace(" ","-", ($list_category->slug))) . '">' . $list_category->name . '</a></li>';
						}
					}
					endforeach;
$output .= '	</ul>
			</div>';
}

$infinite_scroll_output = null;
$infinite_scroll_method_data = null;
if ($portfolio_pagination == "yes" && $portfolio_infinite_scroll == true) {
	$infinite_scroll_output = ' infinite-scroll-enabled';
	$infinite_scroll_method_data = ' data-method="'.$portfolio_infinite_scroll_method.'"';
}
else if ($portfolio_pagination == "yes" && $portfolio_infinite_scroll == false) {
	$infinite_scroll_output = ' infinite-scroll-disabled';
	$infinite_scroll_method_data = '';
}
else {
	$infinite_scroll_output = ' infinite-scroll-disabled';
	$infinite_scroll_method_data = '';
}

$output .= '
	<div class="row '.$portfolio_full.$el_class .'">';
	if($portfolio_layout=="grid-portfolio") {
		$output .= '
		<div id="portfolio-items" class="grid-portfolio '.$filter_enabled.$infinite_scroll_output.'"'.$infinite_scroll_method_data.'>';
	} else if($portfolio_layout=="masonry-portfolio") {
		$output .= '
		<div id="portfolio-items" class="masonry-portfolio '.$filter_enabled.$infinite_scroll_output.'"'.$infinite_scroll_method_data.'>';
	} else if($portfolio_layout=="masonry-block-portfolio") {
		$output .= '
		<div id="portfolio-items" class="masonry-block-portfolio '.$filter_enabled.$infinite_scroll_output.'"'.$infinite_scroll_method_data.'>';
	} else if($portfolio_layout=="listed-portfolio") {
		$output .= '
		<div id="portfolio-items" class="listed-portfolio '.$filter_enabled.$infinite_scroll_output.'"'.$infinite_scroll_method_data.'>';
	} else if($portfolio_layout=="striped-portfolio") {
		$output .= '
		<div id="portfolio-items" class="striped-portfolio">';
	} else if($portfolio_layout=="scrollable-portfolio") {
		$output .= '
		<div id="portfolio-items" class="scrollable-portfolio">';
	} else if($portfolio_layout=="carousel-portfolio") {
		$output .= '
		<div id="portfolio-items" class="carousel-portfolio '.$carousel_mode.'" '.$carousel_data.'>';
	}
		

$x= 0;
$y = 0;

while($my_query->have_posts()) : $my_query->the_post();

if ($portfolio_layout=="grid-portfolio" || $portfolio_layout == "masonry-portfolio" || $portfolio_layout == "masonry-block-portfolio" || $portfolio_layout == "striped-portfolio" || $portfolio_layout == "scrollable-portfolio" || $portfolio_layout=="carousel-portfolio") {
	$classX = ($x%2) ? '' : '';
} else {
	$classX = ($x%2) ? ' reverse-layout' : '';
	$x++;
}

if ($portfolio_layout=="grid-portfolio" || $portfolio_layout == "masonry-portfolio" || $portfolio_layout == "listed-portfolio" || $portfolio_layout == "striped-portfolio" || $portfolio_layout == "scrollable-portfolio" || $portfolio_layout=="carousel-portfolio") {
	$classY = '';
} else {
	$y++;
	if ( $y == 1 ) {
		$classY = '<div class="single-portfolio grid-sizer col-block-1 normal-size"></div>';
	} else {
		$classY = '';
	}
}

$output .= $classY;

// Get the Categories from Portfolio
$terms = get_the_terms($post->id,"project-category");
$list_categories = NULL;

if ( !empty($terms) ){
	foreach ( $terms as $term ) {
	   	$list_categories .= strtolower($term->slug) . ' ';
	}
}

// Get the Attributes from Portfolio
$attrs = get_the_terms( $post->ID, 'project-attribute' );
$attributes_fields = NULL;

if ( !empty($attrs) ){
 	foreach ( $attrs as $attr ) {
   		$attributes_fields[] = $attr->name;
	}
 	$on_attributes = join( " / ", $attributes_fields );
}

$post_id = $my_query->post->ID;

$img_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
$img_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'portfolio-thumb' );
$img_masonry_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'portfolio-masonry-thumb' );
$img_wall_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'portfolio-wall-thumb' );

// Masonry Block Size
if($portfolio_layout=="masonry-block-portfolio") {
	$img_url_normal = wp_get_attachment_image_src( get_post_thumbnail_id(), 'masonry-block-normal-size' );
	$img_url_wide = wp_get_attachment_image_src( get_post_thumbnail_id(), 'masonry-block-wide-size' );
	$img_url_tall = wp_get_attachment_image_src( get_post_thumbnail_id(), 'masonry-block-tall-size' );
	$img_url_big = wp_get_attachment_image_src( get_post_thumbnail_id(), 'masonry-block-big-size' );
}

// Alt Text
$alt = ( get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true) ) ? get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true) : get_the_title();

// Meta Functions
$masonry_block_size = null;
if($portfolio_layout=="masonry-block-portfolio") {
	$masonry_block_size = get_post_meta($post->ID, '_az_masonry_block_thumb_size', true);
}

$custom_project_type = get_post_meta($post->ID, '_az_project_type', true);

$external_url = get_post_meta($post->ID, '_az_external_project_url', true);
$fancy_gallery = get_post_meta($post->ID, '_az_fancy_gallery', true);
$fancy_video = get_post_meta($post->ID, '_az_fancy_video', true);
$fancy_image_popup = get_post_meta($post->ID, '_az_fancy_image_full', true);
$fancy_image_gallery = get_post_meta($post->ID, '_az_fancy_image_gallery', true);

$images = explode(',', $fancy_image_gallery);

$customFancyImg = (!empty($fancy_image_popup)) ? $fancy_image_popup : $img_url[0];

if(!empty($fancy_gallery)) { $fancy_gallery = 'data-fancybox-group="'. strtolower($fancy_gallery) .'"'; }

$portfolio_hover_class = $portfolio_hover_color = $portfolio_hover_text = $portfolio_hover_line = $portfolio_hover_icon = $portfolio_general_class = null;
if ($portfolio_colorize==true) {
	$colorize_project = get_post_meta($post->ID, '_az_project_colorize', true);
	$colorize_project_opacity = get_post_meta($post->ID, '_az_project_colorize_opacity', true);

	$rgb = implode(',', hex2rgb($colorize_project));

	if (!empty($colorize_project)) {
		$portfolio_hover_color = ' style="background-color: rgba('.$rgb.', '.$colorize_project_opacity.');"';
		$portfolio_hover_text = ' class="colorize-portfolio"';
		$portfolio_hover_class = $portfolio_hover_line = $portfolio_hover_icon = $portfolio_general_class = ' colorize-portfolio';
	} else {
		$portfolio_hover_color = ' style="background-color: rgba(255,255,255, '.$colorize_project_opacity.');"';
		$portfolio_general_class = ' colorize-portfolio';
	}
}

$portfolio_scroll_thumb_width = $portfolio_scroll_thumb_width_result = null;
if ($portfolio_layout=="scrollable-portfolio") {
	$portfolio_scroll_thumb_width = get_post_meta($post->ID, '_az_project_scrollable_width', true);

	if (!empty($portfolio_scroll_thumb_width)) {
		$portfolio_scroll_thumb_width_result = ' style="width: '.$portfolio_scroll_thumb_width.'px;"';
	} else {
		$portfolio_scroll_thumb_width_result = '';
	}
}

$output .= '
			<div class="single-portfolio '.$masonry_block_size.' '.$portfolio_columns_count.$classX.$portfolio_general_class.$animation_loading_class.$animation_effect_class.' '.$list_categories.'"'.$animation_delay_class.$portfolio_scroll_thumb_width_result.'>';

// Normal Mode
if( $custom_project_type == "normal-mode" ) {
	if ($portfolio_layout=="masonry-block-portfolio") {
		$output .= '
				<div class="portfolio-post-thumb">
					<div class="portfolio-post-hover'.$portfolio_hover_class.'">
						<a class="portfolio-photo normal-mode" href="'. get_permalink($post_id) .'" title="'. get_the_title() .'"'.$portfolio_hover_color.'>
							<div class="portfolio-naming">
								<h3'.$portfolio_hover_text.'>'. get_the_title() .'</h3>
								<span class="line'.$portfolio_hover_line.'"></span>
								<h4'.$portfolio_hover_text.'>'. $on_attributes .'</h4>
							</div>
						</a>
					</div>';
				if ($masonry_block_size == "wide-size") {
					$output .= '
					<img src="'. $img_url_wide[0] .'" width="'.$img_url_wide[1].'" height="'.$img_url_wide[2].'" alt="'.$alt.'" class="img-full-responsive" />';
				}
				else if ($masonry_block_size == "tall-size") {
					$output .= '
					<img src="'. $img_url_tall[0] .'" width="'.$img_url_tall[1].'" height="'.$img_url_tall[2].'" alt="'.$alt.'" class="img-full-responsive" />';
				}
				else if ($masonry_block_size == "big-size") {
					$output .= '
					<img src="'. $img_url_big[0] .'" width="'.$img_url_big[1].'" height="'.$img_url_big[2].'" alt="'.$alt.'" class="img-full-responsive" />';
				}
				else {
					$output .= '
					<img src="'. $img_url_normal[0] .'" width="'.$img_url_normal[1].'" height="'.$img_url_normal[2].'" alt="'.$alt.'" class="img-full-responsive" />';
				}
				$output .= '
				</div>';

		$output .= '
			</div>
				';
	} else if ($portfolio_layout=="grid-portfolio" || $portfolio_layout == "masonry-portfolio" || $portfolio_layout=="carousel-portfolio") {
		$output .= '
				<div class="portfolio-post-thumb">
					<div class="portfolio-post-hover'.$portfolio_hover_class.'">
						<a class="portfolio-photo normal-mode" href="'. get_permalink($post_id) .'" title="'. get_the_title() .'"'.$portfolio_hover_color.'>
							<div class="portfolio-naming">
								<h3'.$portfolio_hover_text.'>'. get_the_title() .'</h3>
								<span class="line'.$portfolio_hover_line.'"></span>
								<h4'.$portfolio_hover_text.'>'. $on_attributes .'</h4>
							</div>
						</a>
					</div>';
				if ($portfolio_layout == "masonry-portfolio") {
					$output .= '
					<img src="'. $img_masonry_thumb[0] .'" width="'.$img_masonry_thumb[1].'" height="'.$img_masonry_thumb[2].'" alt="'.$alt.'" class="img-full-responsive" />';
				} else {
					if ($portfolio_wall==true) {
					$output .= '
					<img src="'. $img_wall_thumb[0] .'" width="'.$img_wall_thumb[1].'" height="'.$img_wall_thumb[2].'" alt="'.$alt.'" class="img-full-responsive" />';
					} else {
					$output .= '
					<img src="'. $img_thumb[0] .'" width="'.$img_thumb[1].'" height="'.$img_thumb[2].'" alt="'.$alt.'" class="img-full-responsive" />';
					}
				}
				$output .= '
				</div>';

		$output .= '
			</div>
				';
	} else if ($portfolio_layout=="striped-portfolio" || $portfolio_layout == "scrollable-portfolio") {
		$output .= '
				<div class="portfolio-post-thumb">
					<div class="portfolio-post-image" style="background-image: url('.$img_url[0].');"></div>
					<div class="portfolio-post-hover'.$portfolio_hover_class.'">
						<a class="portfolio-photo normal-mode" href="'. get_permalink($post_id) .'" title="'. get_the_title() .'"'.$portfolio_hover_color.'>
							<div class="portfolio-naming">
								<h3'.$portfolio_hover_text.'>'. get_the_title() .'</h3>
								<span class="line'.$portfolio_hover_line.'"></span>
								<h4'.$portfolio_hover_text.'>'. $on_attributes .'</h4>
							</div>
						</a>
					</div>
				</div>';

		$output .= '
			</div>
				';
	} else {
		$output .= '
			<div class="portfolio-post-thumb-listed">
				<a class="portfolio-photo normal-mode" href="'. get_permalink($post_id) .'" title="'. get_the_title() .'">
					<div class="portfolio-post-image" style="background-image: url('.$img_thumb[0].');"><span class="overlay-bg-portfolio"><i class="portfolio-icon read-icon"></i></span></div>
					<div class="portfolio-post-description">
						<div class="portfolio-naming">
							<h3>'. get_the_title() .'</h3>
							<span class="line"></span>
							<h4>'. $on_attributes .'</h4>
						</div>
					</div>
				</a>
			</div>
			</div>
			';
	}
}

// FancyBox Mode
if( $custom_project_type == "fancybox-mode" ) {

/* FancyBox Video */
if( !empty($fancy_video)) {
	if ($portfolio_layout=="masonry-block-portfolio") {
		$output .= '
				<div class="portfolio-post-thumb">
					<div class="portfolio-post-hover'.$portfolio_hover_class.'">
						<a class="portfolio-photo fancybox-media" href="'.$fancy_video.'" title="'. get_the_title() .'" '.$fancy_gallery.''.$portfolio_hover_color.'>
							<i class="portfolio-icon fancy-video'.$portfolio_hover_icon.'"></i>
							<div class="portfolio-naming">
								<h3'.$portfolio_hover_text.'>'. get_the_title() .'</h3>
								<span class="line'.$portfolio_hover_line.'"></span>
								<h4'.$portfolio_hover_text.'>'. $on_attributes .'</h4>
							</div>
						</a>
					</div>';
				if ($masonry_block_size == "wide-size") {
					$output .= '
					<img src="'. $img_url_wide[0] .'" width="'.$img_url_wide[1].'" height="'.$img_url_wide[2].'" alt="'.$alt.'" class="img-full-responsive" />';
				}
				else if ($masonry_block_size == "tall-size") {
					$output .= '
					<img src="'. $img_url_tall[0] .'" width="'.$img_url_tall[1].'" height="'.$img_url_tall[2].'" alt="'.$alt.'" class="img-full-responsive" />';
				}
				else if ($masonry_block_size == "big-size") {
					$output .= '
					<img src="'. $img_url_big[0] .'" width="'.$img_url_big[1].'" height="'.$img_url_big[2].'" alt="'.$alt.'" class="img-full-responsive" />';
				}
				else {
					$output .= '
					<img src="'. $img_url_normal[0] .'" width="'.$img_url_normal[1].'" height="'.$img_url_normal[2].'" alt="'.$alt.'" class="img-full-responsive" />';
				}
				$output .= '
				</div>';

		$output .= '
			</div>
				';
	} else if ($portfolio_layout=="grid-portfolio" || $portfolio_layout == "masonry-portfolio" || $portfolio_layout=="carousel-portfolio") {
		$output .= '
				<div class="portfolio-post-thumb">
					<div class="portfolio-post-hover'.$portfolio_hover_class.'">
						<a class="portfolio-photo fancybox-media" href="'.$fancy_video.'" title="'. get_the_title() .'" '.$fancy_gallery.''.$portfolio_hover_color.'>
							<i class="portfolio-icon fancy-video'.$portfolio_hover_icon.'"></i>
							<div class="portfolio-naming">
								<h3'.$portfolio_hover_text.'>'. get_the_title() .'</h3>
								<span class="line'.$portfolio_hover_line.'"></span>
								<h4'.$portfolio_hover_text.'>'. $on_attributes .'</h4>
							</div>
						</a>
					</div>';
				if ($portfolio_layout == "masonry-portfolio") {
					$output .= '
					<img src="'. $img_masonry_thumb[0] .'" width="'.$img_masonry_thumb[1].'" height="'.$img_masonry_thumb[2].'" alt="'.$alt.'" class="img-full-responsive" />';
				} else {
					if ($portfolio_wall==true) {
					$output .= '
					<img src="'. $img_wall_thumb[0] .'" width="'.$img_wall_thumb[1].'" height="'.$img_wall_thumb[2].'" alt="'.$alt.'" class="img-full-responsive" />';
					} else {
					$output .= '
					<img src="'. $img_thumb[0] .'" width="'.$img_thumb[1].'" height="'.$img_thumb[2].'" alt="'.$alt.'" class="img-full-responsive" />';
					}
				}
				$output .= '
				</div>';

		$output .= '
			</div>
				';
	} else if ($portfolio_layout=="striped-portfolio" || $portfolio_layout == "scrollable-portfolio") {
		$output .= '
				<div class="portfolio-post-thumb">
					<div class="portfolio-post-image" style="background-image: url('.$img_url[0].');"></div>
					<div class="portfolio-post-hover'.$portfolio_hover_class.'">
						<a class="portfolio-photo fancybox-media" href="'.$fancy_video.'" title="'. get_the_title() .'" '.$fancy_gallery.''.$portfolio_hover_color.'>
							<i class="portfolio-icon fancy-video'.$portfolio_hover_icon.'"></i>
							<div class="portfolio-naming">
								<h3'.$portfolio_hover_text.'>'. get_the_title() .'</h3>
								<span class="line'.$portfolio_hover_line.'"></span>
								<h4'.$portfolio_hover_text.'>'. $on_attributes .'</h4>
							</div>
						</a>
					</div>
				</div>';
		$output .= '
			</div>
				';
	} else {
		$output .= '
			<div class="portfolio-post-thumb-listed">
				<a class="portfolio-photo fancybox-media" href="'.$fancy_video.'" title="'. get_the_title() .'" '.$fancy_gallery.'>
					<div class="portfolio-post-image" style="background-image: url('.$img_thumb[0].');"><span class="overlay-bg-portfolio"><i class="portfolio-icon fancy-video"></i></span></div>
					<div class="portfolio-post-description">
						<div class="portfolio-naming">
							<h3>'. get_the_title() .'</h3>
							<span class="line"></span>
							<h4>'. $on_attributes .'</h4>
						</div>
					</div>
				</a>
			</div>
			</div>
			';
	}
}

/* FancyBox Image / Image Gallery Popup */
else {
	if ($portfolio_layout=="masonry-block-portfolio") {
		$output .= '
				<div class="portfolio-post-thumb">
					<div class="portfolio-post-hover'.$portfolio_hover_class.'">
						<a class="portfolio-photo fancybox-thumb" href="'.$customFancyImg.'" title="'. get_the_title() .'" '.$fancy_gallery.''.$portfolio_hover_color.'>
							<i class="portfolio-icon fancy-image'.$portfolio_hover_icon.'"></i>
							<div class="portfolio-naming">
								<h3'.$portfolio_hover_text.'>'. get_the_title() .'</h3>
								<span class="line'.$portfolio_hover_line.'"></span>
								<h4'.$portfolio_hover_text.'>'. $on_attributes .'</h4>
							</div>';
		$output .= '	
						</a>
					</div>';
					// FancyBox Gallery
					if(!empty($fancy_image_gallery)){
						foreach($images as $image):
						$src = wp_get_attachment_image_src( $image, 'full' );
						$alt = ( get_post_meta($image, '_wp_attachment_image_alt', true) ) ? get_post_meta($image, '_wp_attachment_image_alt', true) : 'Insert Alt Text';
						$output .= '
						<a class="fancybox-thumb hidden" title="'.$alt.'" href="'.$src[0].'" '.$fancy_gallery.'></a>';
						endforeach;
					}
				if ($masonry_block_size == "wide-size") {
					$output .= '
					<img src="'. $img_url_wide[0] .'" width="'.$img_url_wide[1].'" height="'.$img_url_wide[2].'" alt="'.$alt.'" class="img-full-responsive" />';
				}
				else if ($masonry_block_size == "tall-size") {
					$output .= '
					<img src="'. $img_url_tall[0] .'" width="'.$img_url_tall[1].'" height="'.$img_url_tall[2].'" alt="'.$alt.'" class="img-full-responsive" />';
				}
				else if ($masonry_block_size == "big-size") {
					$output .= '
					<img src="'. $img_url_big[0] .'" width="'.$img_url_big[1].'" height="'.$img_url_big[2].'" alt="'.$alt.'" class="img-full-responsive" />';
				}
				else {
					$output .= '
					<img src="'. $img_url_normal[0] .'" width="'.$img_url_normal[1].'" height="'.$img_url_normal[2].'" alt="'.$alt.'" class="img-full-responsive" />';
				}
				$output .= '
				</div>';

		$output .= '
			</div>
			';
	} else if ($portfolio_layout=="grid-portfolio" || $portfolio_layout == "masonry-portfolio" || $portfolio_layout=="carousel-portfolio") {
		$output .= '
				<div class="portfolio-post-thumb">
					<div class="portfolio-post-hover'.$portfolio_hover_class.'">
						<a class="portfolio-photo fancybox-thumb" href="'.$customFancyImg.'" title="'. get_the_title() .'" '.$fancy_gallery.''.$portfolio_hover_color.'>
							<i class="portfolio-icon fancy-image'.$portfolio_hover_icon.'"></i>
							<div class="portfolio-naming">
								<h3'.$portfolio_hover_text.'>'. get_the_title() .'</h3>
								<span class="line'.$portfolio_hover_line.'"></span>
								<h4'.$portfolio_hover_text.'>'. $on_attributes .'</h4>
							</div>';
		$output .= '	
						</a>
					</div>';
					// FancyBox Gallery
					if(!empty($fancy_image_gallery)){
						foreach($images as $image):
						$src = wp_get_attachment_image_src( $image, 'full' );
						$alt = ( get_post_meta($image, '_wp_attachment_image_alt', true) ) ? get_post_meta($image, '_wp_attachment_image_alt', true) : 'Insert Alt Text';
						$output .= '
						<a class="fancybox-thumb hidden" title="'.$alt.'" href="'.$src[0].'" '.$fancy_gallery.'></a>';
						endforeach;
					}
				if ($portfolio_layout == "masonry-portfolio") {
					$output .= '
					<img src="'. $img_masonry_thumb[0] .'" width="'.$img_masonry_thumb[1].'" height="'.$img_masonry_thumb[2].'" alt="'.$alt.'" class="img-full-responsive" />';
				} else {
					if ($portfolio_wall==true) {
					$output .= '
					<img src="'. $img_wall_thumb[0] .'" width="'.$img_wall_thumb[1].'" height="'.$img_wall_thumb[2].'" alt="'.$alt.'" class="img-full-responsive" />';
					} else {
					$output .= '
					<img src="'. $img_thumb[0] .'" width="'.$img_thumb[1].'" height="'.$img_thumb[2].'" alt="'.$alt.'" class="img-full-responsive" />';
					}
				}
				$output .= '
				</div>';

		$output .= '
			</div>
			';
	} else if ($portfolio_layout=="striped-portfolio" || $portfolio_layout == "scrollable-portfolio") {
		$output .= '
				<div class="portfolio-post-thumb">
					<div class="portfolio-post-image" style="background-image: url('.$img_url[0].');"></div>
					<div class="portfolio-post-hover'.$portfolio_hover_class.'">
						<a class="portfolio-photo fancybox-thumb" href="'.$customFancyImg.'" title="'. get_the_title() .'" '.$fancy_gallery.''.$portfolio_hover_color.'>
							<i class="portfolio-icon fancy-image'.$portfolio_hover_icon.'"></i>
							<div class="portfolio-naming">
								<h3'.$portfolio_hover_text.'>'. get_the_title() .'</h3>
								<span class="line'.$portfolio_hover_line.'"></span>
								<h4'.$portfolio_hover_text.'>'. $on_attributes .'</h4>
							</div>';
		$output .= '	
						</a>
					</div>';
					// FancyBox Gallery
					if(!empty($fancy_image_gallery)){
						foreach($images as $image):
						$src = wp_get_attachment_image_src( $image, 'full' );
						$alt = ( get_post_meta($image, '_wp_attachment_image_alt', true) ) ? get_post_meta($image, '_wp_attachment_image_alt', true) : 'Insert Alt Text';
						$output .= '
						<a class="fancybox-thumb hidden" title="'.$alt.'" href="'.$src[0].'" '.$fancy_gallery.'></a>';
						endforeach;
					}
				$output .= '
				</div>';

		$output .= '
			</div>
			';
	} else {
		$output .= '
			<div class="portfolio-post-thumb-listed">
				<a class="portfolio-photo fancybox-thumb" href="'.$customFancyImg.'" title="'. get_the_title() .'" '.$fancy_gallery.'>
					<div class="portfolio-post-image" style="background-image: url('.$img_thumb[0].');"><span class="overlay-bg-portfolio"><i class="portfolio-icon fancy-image"></i></span></div>
					<div class="portfolio-post-description">
						<div class="portfolio-naming">
							<h3>'. get_the_title() .'</h3>
							<span class="line"></span>
							<h4>'. $on_attributes .'</h4>
						</div>
					</div>';
		$output .= '		
				</a>
			</div>';
			// FancyBox Gallery
			if(!empty($fancy_image_gallery)){
				foreach($images as $image):
				$src = wp_get_attachment_image_src( $image, 'full' );
				$alt = ( get_post_meta($image, '_wp_attachment_image_alt', true) ) ? get_post_meta($image, '_wp_attachment_image_alt', true) : 'Insert Alt Text';
				$output .= '
				<a class="fancybox-thumb hidden" title="'.$alt.'" href="'.$src[0].'" '.$fancy_gallery.'></a>';
				endforeach;
			}
		$output .=	
		'</div>';
	}
}

}

// External Mode
if( $custom_project_type == "output-mode" ) {
	if ($portfolio_layout=="masonry-block-portfolio") {
		$output .= '
				<div class="portfolio-post-thumb">
					<div class="portfolio-post-hover'.$portfolio_hover_class.'">
						<a class="portfolio-photo" href="'.$external_url.'" title="'. get_the_title() .'" target="_blank"'.$portfolio_hover_color.'>
							<i class="portfolio-icon external-url'.$portfolio_hover_icon.'"></i>
							<div class="portfolio-naming">
								<h3'.$portfolio_hover_text.'>'. get_the_title() .'</h3>
								<span class="line'.$portfolio_hover_line.'"></span>
								<h4'.$portfolio_hover_text.'>'. $on_attributes .'</h4>
							</div>
						</a>
					</div>';
				if ($masonry_block_size == "wide-size") {
					$output .= '
					<img src="'. $img_url_wide[0] .'" width="'.$img_url_wide[1].'" height="'.$img_url_wide[2].'" alt="'.$alt.'" class="img-full-responsive" />';
				}
				else if ($masonry_block_size == "tall-size") {
					$output .= '
					<img src="'. $img_url_tall[0] .'" width="'.$img_url_tall[1].'" height="'.$img_url_tall[2].'" alt="'.$alt.'" class="img-full-responsive" />';
				}
				else if ($masonry_block_size == "big-size") {
					$output .= '
					<img src="'. $img_url_big[0] .'" width="'.$img_url_big[1].'" height="'.$img_url_big[2].'" alt="'.$alt.'" class="img-full-responsive" />';
				}
				else {
					$output .= '
					<img src="'. $img_url_normal[0] .'" width="'.$img_url_normal[1].'" height="'.$img_url_normal[2].'" alt="'.$alt.'" class="img-full-responsive" />';
				}
				$output .= '
				</div>';

		$output .= '
			</div>
				';
	} else if ($portfolio_layout=="grid-portfolio" || $portfolio_layout == "masonry-portfolio" || $portfolio_layout=="carousel-portfolio") {
		$output .= '
				<div class="portfolio-post-thumb">
					<div class="portfolio-post-hover'.$portfolio_hover_class.'">
						<a class="portfolio-photo" href="'.$external_url.'" title="'. get_the_title() .'" target="_blank"'.$portfolio_hover_color.'>
							<i class="portfolio-icon external-url'.$portfolio_hover_icon.'"></i>
							<div class="portfolio-naming">
								<h3'.$portfolio_hover_text.'>'. get_the_title() .'</h3>
								<span class="line'.$portfolio_hover_line.'"></span>
								<h4'.$portfolio_hover_text.'>'. $on_attributes .'</h4>
							</div>
						</a>
					</div>';
				if ($portfolio_layout == "masonry-portfolio") {
					$output .= '
					<img src="'. $img_masonry_thumb[0] .'" width="'.$img_masonry_thumb[1].'" height="'.$img_masonry_thumb[2].'" alt="'.$alt.'" class="img-full-responsive" />';
				} else {
					if ($portfolio_wall==true) {
					$output .= '
					<img src="'. $img_wall_thumb[0] .'" width="'.$img_wall_thumb[1].'" height="'.$img_wall_thumb[2].'" alt="'.$alt.'" class="img-full-responsive" />';
					} else {
					$output .= '
					<img src="'. $img_thumb[0] .'" width="'.$img_thumb[1].'" height="'.$img_thumb[2].'" alt="'.$alt.'" class="img-full-responsive" />';
					}
				}
				$output .= '
				</div>';

		$output .= '
			</div>
				';
	} else if ($portfolio_layout=="striped-portfolio" || $portfolio_layout == "scrollable-portfolio") {
		$output .= '
				<div class="portfolio-post-thumb">
					<div class="portfolio-post-image" style="background-image: url('.$img_url[0].');"></div>
					<div class="portfolio-post-hover'.$portfolio_hover_class.'">
						<a class="portfolio-photo" href="'.$external_url.'" title="'. get_the_title() .'" target="_blank"'.$portfolio_hover_color.'>
							<i class="portfolio-icon external-url'.$portfolio_hover_icon.'"></i>
							<div class="portfolio-naming">
								<h3'.$portfolio_hover_text.'>'. get_the_title() .'</h3>
								<span class="line'.$portfolio_hover_line.'"></span>
								<h4'.$portfolio_hover_text.'>'. $on_attributes .'</h4>
							</div>
						</a>
					</div>
				</div>';
		$output .= '
			</div>
				';
	} else {
		$output .= '
			<div class="portfolio-post-thumb-listed">
				<a class="portfolio-photo" href="'.$external_url.'" title="'. get_the_title() .'" target="_blank">
					<div class="portfolio-post-image" style="background-image: url('.$img_thumb[0].');"><span class="overlay-bg-portfolio"><i class="portfolio-icon external-url"></i></span></div>
					<div class="portfolio-post-description">
						<div class="portfolio-naming">
							<h3>'. get_the_title() .'</h3>
							<span class="line"></span>
							<h4>'. $on_attributes .'</h4>
						</div>
					</div>
				</a>
			</div>
			</div>
			';	
	}
}

endwhile;

wp_reset_query();

$output .= '
		</div>';
$output .= '
	</div>';

$infinite_scroll_class_nav = null;
if ($portfolio_infinite_scroll == true && $portfolio_infinite_scroll_method == "twitter") {
	$infinite_scroll_class_nav = ' twitter-style';
}
else if ($portfolio_infinite_scroll == true && $portfolio_infinite_scroll_method == "manual") {
	$infinite_scroll_class_nav = ' manual-style';
}
else {
	$infinite_scroll_class_nav = '';
}

if ($portfolio_pagination == "yes" && $portfolio_layout =="grid-portfolio" || $portfolio_pagination == "yes" && $portfolio_layout=="masonry-portfolio" || $portfolio_pagination == "yes" && $portfolio_layout=="listed-portfolio" || $portfolio_pagination == "yes" && $portfolio_layout=="masonry-block-portfolio") {
		
	$output .= '
	<div class="portfolio-pagination-wrap '.$portfolio_full.$infinite_scroll_output.$infinite_scroll_class_nav.'">';
	
	if ($portfolio_pagination == "yes" && $portfolio_infinite_scroll == true) {
		$output .= '<div class="loader-infinite"></div>';
		$output .= 
		pagenavi_infinite($my_query);	
	}
	else {
		$output .= 
		pagenavi($my_query);	
	}
								
	$output .= '
	</div>';
}

echo $output.$this->endBlockComment('az_portfolio_grid');



?>