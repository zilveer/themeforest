<?php

if(!function_exists('theme_shortcode_masonry')){
function theme_shortcode_masonry($atts, $content = null, $code) {
	global $wp_filter;
	$the_content_filter_backup = $wp_filter['the_content'];
	extract(shortcode_atts(array(
		'number' => 10,
		'post_type' => 'post',
		'taxonomy' => false,
		'terms' => false,
		'column' => 3,
		'title' => 'true',
		'desc' => 'false',
		'desc_length' => 'default',
		'paging' => 'true',
		'lightbox' => 'false',
		'lightbox_fittoview' => '',
		'random' => 'false',
		'class' => '',
	), $atts));

	wp_enqueue_script( 'jquery-isotope');


	if($title === 'true'){
		$title = true;
	}else{
		$title = false;
	}
	if($desc === 'true'){
		$desc = true;
	}else{
		$desc = false;
	}

	if($lightbox == 'true'){
		if($lightbox_fittoview != ''){	
			$fittoview = ($lightbox_fittoview == 'false')?' data-fittoview="false"':' data-fittoview="true"';
		}else{
			$fittoview = '';
		}
	}

	$query = array(
		'posts_per_page' => (int)$number,
		'post_type'=>$post_type,
		'showposts' => $number
	);
	if($random === 'true'){
		$query['orderby'] = 'rand';
	}
	if($taxonomy && $terms){
		$query['tax_query'] = array(
			array(
				'taxonomy' => $taxonomy,
				'field' => 'slug',
				'terms' => explode(',',$terms)
			)
		);
	}

	if($desc_length != 'default'){
		$excerpt_constructor = new Theme_The_Excerpt_Length_Constructor($desc_length);
		add_filter( 'excerpt_length', array($excerpt_constructor,'get_length'));
	}

	if ($paging === 'true') {
		global $wp_version;
		if((is_front_page() || is_home() ) && version_compare($wp_version, "3.1", '>=')){//fix wordpress 3.1 paged query 
			$paged = (get_query_var('paged')) ?get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : 1);
		}else{
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		}
		$query['paged'] = $paged;
	}

	$r = new WP_Query($query);

	$output = '<ul class="masonry_items">';
	if ($r->have_posts()){
		while ($r->have_posts()){
			$r->the_post();
			$output .= '<li class="masonry_item">';
			$image_source = false;
			$masonry_image = get_post_meta(get_the_ID(), '_masonry_image', true);
			if(is_array($masonry_image) && isset($masonry_image['value'])){
				$image_source = $masonry_image;
			} else if(has_post_thumbnail()){
				$image_source = array('type'=>'attachment_id','value'=>get_post_thumbnail_id());
			}

			$href = get_permalink();

			$link_target = '';
			if($post_type == 'portfolio' && 'link' === get_post_meta(get_the_id(), '_type', true)) {
				$link = get_post_meta(get_the_ID(), '_link', true);
				$href = theme_get_superlink($link);
				$link_target = get_post_meta(get_the_ID(), '_link_target', true);
				if($link_target){
					$link_target = ' target="'.$link_target.'"';
				}
			}
			
			if($image_source){
				$image_src = theme_get_image_src($image_source, array(470));
				if($lightbox == 'true'){
					$output .= '<div class="masonry_item_image"><a class="fancybox"'.$fittoview.' href="'.theme_get_image_src($image_source, 'full').'" title="'.get_the_title().'"><img src="'.$image_src.'" alt="'.get_the_title().'" /><span class="masonry_item_image_overlay"></span></a></div>';
				} else {
					$output .= '<div class="masonry_item_image"><a href="'.$href.'"'.$link_target.' title="'.sprintf( __("Permanent Link to %s", 'striking-r'), get_the_title() ).'"><img src="'.$image_src.'" alt="'.get_the_title().'" /><span class="masonry_item_image_overlay"></span></a></div>';
				}
			}
			if($title){
				$output .= '<h4 class="masonry_item_title"><a href="'.$href.'"'.$link_target.' rel="bookmark" title="'.sprintf( __("Permanent Link to %s", 'striking-r'), get_the_title() ).'">'.get_the_title().'</a></h4>';
			}
			if($desc){
				$output .= '<div class="masonry_item_desc">'.apply_filters('the_excerpt', get_the_excerpt()).'</div>';
			}
			
			$output .= '</li>';
		}
	}
	$output .= '</ul>';
	$id = 'masonry_'.rand(10, 1000);

	if ($paging === 'true') {
		ob_start();
		theme_masonry_pagenavi('', '', $r, $paged);
		$output .= ob_get_clean();
	}

	wp_reset_postdata();
	$wp_filter['the_content'] = $the_content_filter_backup;

	if($desc_length != 'default'){
		remove_filter( 'excerpt_length', array($excerpt_constructor,'get_length'));
	}

	$output .= <<<HTML
<script>
	jQuery(document).ready(function($){
		var container = $('#{$id}').addClass('masonry_isotope');

		container.imagesLoaded(function(){
			container.children('ul').isotope({
				itemSelector: '.masonry_item',
				layoutMode: 'masonry',
				masonry: {
					gutter: 20
				}
			});
		});
	});
</script>
HTML;

	$class = 'masonry_column_'.$column;
	if(!$title && !$desc){
		$class .= ' masonry_only_image';
	} elseif($desc && $title){
		$class .= ' masonry_with_title_desc';
	} elseif($title){
		$class .= ' masonry_with_title';
	} elseif($desc){
		$class .= ' masonry_with_desc';
	}


	return '<div id="'.$id.'" class="masonry_container '.$class.'">'.$output.'</div>';
}
}
add_shortcode('masonry','theme_shortcode_masonry');

if(!function_exists('theme_masonry_pagenavi')){
function theme_masonry_pagenavi($before = '', $after = '', $masonry_query, $paged) {
	global $wpdb, $wp_query;
	
	// if (is_single())
	// 	return;
	
	$pagenavi_options = array(
		//'pages_text' => __('Page %CURRENT_PAGE% of %TOTAL_PAGES%','striking-r'),
		'pages_text' => '',
		'current_text' => '%PAGE_NUMBER%',
		'page_text' => '%PAGE_NUMBER%',
		'first_text' => __('&laquo; First','striking-r'),
		'last_text' => __('Last &raquo;','striking-r'),
		'next_text' => __('&raquo;','striking-r'),
		'prev_text' => __('&laquo;','striking-r'),
		'dotright_text' => __('...','striking-r'),
		'dotleft_text' => __('...','striking-r'),
		'style' => 1,
		'num_pages' => 4,
		'always_show' => 0,
		'num_larger_page_numbers' => 3,
		'larger_page_numbers_multiple' => 10,
		'use_pagenavi_css' => 0,
	);
	
	$request = $masonry_query->request;
	$posts_per_page = intval(get_query_var('posts_per_page'));
	global $wp_version;
	if((is_front_page() || is_home() ) && version_compare($wp_version, "3.1", '>=')){//fix wordpress 3.1 paged query 
		$paged = (get_query_var('paged')) ?intval(get_query_var('paged')) : intval(get_query_var('page'));
	}else{
		$paged = intval(get_query_var('paged'));
	}
	
	$numposts = $masonry_query->found_posts;
	$max_page = intval($masonry_query->max_num_pages);
	
	if (empty($paged) || $paged == 0)
		$paged = 1;
	$pages_to_show = intval($pagenavi_options['num_pages']);
	$larger_page_to_show = intval($pagenavi_options['num_larger_page_numbers']);
	$larger_page_multiple = intval($pagenavi_options['larger_page_numbers_multiple']);
	$pages_to_show_minus_1 = $pages_to_show - 1;
	$half_page_start = floor($pages_to_show_minus_1 / 2);
	$half_page_end = ceil($pages_to_show_minus_1 / 2);
	$start_page = $paged - $half_page_start;
	
	if ($start_page <= 0)
		$start_page = 1;
	
	$end_page = $paged + $half_page_end;
	if (($end_page - $start_page) != $pages_to_show_minus_1) {
		$end_page = $start_page + $pages_to_show_minus_1;
	}
	
	if ($end_page > $max_page) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = $max_page;
	}
	
	if ($start_page <= 0)
		$start_page = 1;
	
	$larger_pages_array = array();
	if ($larger_page_multiple)
		for($i = $larger_page_multiple; $i <= $max_page; $i += $larger_page_multiple)
			$larger_pages_array[] = $i;
	
	if ($max_page > 1 || intval($pagenavi_options['always_show'])) {
		$pages_text = str_replace("%CURRENT_PAGE%", number_format_i18n($paged), $pagenavi_options['pages_text']);
		$pages_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pages_text);
		echo $before . '<div class="wp-pagenavi">' . "\n";
		switch(intval($pagenavi_options['style'])){
			// Normal
			case 1:
				if (! empty($pages_text)) {
					echo '<span class="pages">' . $pages_text . '</span>';
				}
				if ($start_page >= 2 && $pages_to_show < $max_page) {
					$first_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['first_text']);
					echo '<a href="' . esc_url(get_pagenum_link()) . '" class="first" title="' . $first_page_text . '">' . $first_page_text . '</a>';
					if (! empty($pagenavi_options['dotleft_text'])) {
						echo '<span class="extend">' . $pagenavi_options['dotleft_text'] . '</span>';
					}
				}
				$larger_page_start = 0;
				foreach($larger_pages_array as $larger_page) {
					if ($larger_page < $start_page && $larger_page_start < $larger_page_to_show) {
						$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($larger_page), $pagenavi_options['page_text']);
						echo '<a href="' . esc_url(get_pagenum_link($larger_page)) . '" class="page" title="' . $page_text . '">' . $page_text . '</a>';
						$larger_page_start++;
					}
				}
				previous_posts_link($pagenavi_options['prev_text']);
				for($i = $start_page; $i <= $end_page; $i++) {
					if ($i == $paged) {
						$current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
						echo '<span class="current">' . $current_page_text . '</span>';
					} else {
						$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
						echo '<a href="' . esc_url(get_pagenum_link($i)) . '" class="page" title="' . $page_text . '">' . $page_text . '</a>';
					}
				}
				next_posts_link($pagenavi_options['next_text'], $max_page);
				$larger_page_end = 0;
				foreach($larger_pages_array as $larger_page) {
					if ($larger_page > $end_page && $larger_page_end < $larger_page_to_show) {
						$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($larger_page), $pagenavi_options['page_text']);
						echo '<a href="' . esc_url(get_pagenum_link($larger_page)) . '" class="page" title="' . $page_text . '">' . $page_text . '</a>';
						$larger_page_end++;
					}
				}
				if ($end_page < $max_page) {
					if (! empty($pagenavi_options['dotright_text'])) {
						echo '<span class="extend">' . $pagenavi_options['dotright_text'] . '</span>';
					}
					$last_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['last_text']);
					echo '<a href="' . esc_url(get_pagenum_link($max_page)) . '" class="last" title="' . $last_page_text . '">' . $last_page_text . '</a>';
				}
				break;
			// Dropdown
			case 2:
				echo '<form action="' . htmlspecialchars($_SERVER['PHP_SELF']) . '" method="get">' . "\n";
				echo '<select size="1" onchange="document.location.href = this.options[this.selectedIndex].value;">' . "\n";
				for($i = 1; $i <= $max_page; $i++) {
					$page_num = $i;
					if ($page_num == 1) {
						$page_num = 0;
					}
					if ($i == $paged) {
						$current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
						echo '<option value="' . esc_url(get_pagenum_link($page_num)) . '" selected="selected" class="current">' . $current_page_text . "</option>\n";
					} else {
						$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
						echo '<option value="' . esc_url(get_pagenum_link($page_num)) . '">' . $page_text . "</option>\n";
					}
				}
				echo "</select>\n";
				echo "</form>\n";
				break;
		}
		echo '</div>' . $after . "\n";
	}
}
}