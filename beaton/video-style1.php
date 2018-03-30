<?php

/*--------------------------------------------------*/
/* Template Name: Video #1
/*--------------------------------------------------*/

get_header();

if (is_front_page()) {
    $paged = (get_query_var('page')) ? get_query_var('page') : 1;
}

$number      = get_post_meta($post->ID, "page_number", true);
$category    = get_post_meta($post->ID, "page_category", true);
$page_layout = wize_page_sidebar_layout();
$page_slider = wize_page_slider_layout();
if (!$category) {
    $query = array(
        'post_type' => 'video',
        'posts_per_page' => $number,
        'paged' => $paged
    );
} else {
    $query = array(
        'post_type' => 'video',
        'posts_per_page' => $number,
        'paged' => $paged,
        'tax_query' => array(
            array(
                'taxonomy' => 'videos',
                'field' => 'slug',
                'terms' => $category
            )
        )
    );
}

switch ($page_slider) {
    case "sliderfull":
        require_once('slider-full.php');
    break;
    
    case "sliderboxed":
        require_once('slider-boxed.php');
    break;
}

echo '	
	<div id="wrap" class="fixed">';
	
if (!is_front_page()) {
    echo '
	<div class="page-title">
		<h1 class="blog">' . get_the_title() . '</h1>
	</div>';
}

switch ($page_layout) {
    case "sidebar-left":
        echo '
	<div id="media-right">
		<div class="media-lr">';
    break;
		
    case "sidebar-full":
        echo '
	<div id="media-full">
		<div class="media-full">';
    break;
		
    case "sidebar-right":
        echo '
	<div id="media-left">
		<div class="media-lr">';
    break;
}

$wp_query = new WP_Query($query);
if (have_posts())
    while ($wp_query->have_posts()):
        $wp_query->the_post();
        global $post;
        $image_id = get_post_thumbnail_id();
        $cover    = wp_get_attachment_image_src($image_id, 'Bl1PhVd');
        $no_cover = get_template_directory_uri();
        $venue    = get_post_meta($post->ID, 'vd_venue', true);
        $youtube  = get_post_meta($post->ID, 'vd_youtube', true);
        $vimeo    = get_post_meta($post->ID, 'vd_vimeo', true);
        $date     = get_post_meta($post->ID, 'vd_date', true);
        $time     = strtotime($date);
        $year     = date('Y', $time);
        $month    = date('F', $time);
        $day      = date('d', $time);
        
		/* display */
		
        echo '
		<div class="pv1">
			<div class="pv1-cover">
				<div class="pv1-bg"></div>';
        if ($image_id) {
            echo '
				<img src="' . esc_url($cover[0]) . '" alt="' . esc_attr(get_the_title()) . '" />';
        } else {
            echo '
				<img src="' . esc_url($no_cover) . '/images/no-cover/media.png" alt="no-cover" />';
        }
        echo '
				<div class="pv1-title">';
		if ($venue) {
			echo '
					<div class="pv1-venue">' . esc_html($venue, "wizedesign") . '</div>';
		}
		echo '
					<h2><a href="' . esc_url(get_permalink()) . '">' . get_the_title() . '</a></h2>	
				</div><!-- end .pv1-title -->
				<div class="pv1-lv">
					' . wize_like_info($post->ID) . '
					<div class="info-view">' . wize_get_views(get_the_ID()) . '</div>
				</div><!-- end .pv1-lv -->';
		if ($date) {
			echo '
				<div class="pv1-date">' . esc_html($day, "wizedesign") . ' ' . esc_html($month, "wizedesign") . ' ' . esc_html($year, "wizedesign") . '</div>';
		}
        if ($youtube) {
            echo '
				<a href="http://youtu.be/' . esc_attr($youtube) . '" data-rel="prettyPhoto"><div class="pv1-play"></div></a>';
        } elseif ($vimeo) {
            echo '
				<a href="http://vimeo.com/' . esc_attr($vimeo) . '" data-rel="prettyPhoto"><div class="pv1-play"></div></a>';
        }
        
        echo '		
			</div><!-- end .pv1-cover -->
		</div><!-- end .pv1 -->';
		
    endwhile;


if (function_exists("wize_pagination")) {
    wize_pagination();
}

echo '
		</div><!-- end .media(lr&full) -->
	</div><!-- end #media(left&full&right) -->';

switch ($page_layout) {
    case "sidebar-left":
		if ( is_active_sidebar( 'video-page' ) ) {
			echo '
	<div id="sidebar-left">';
        dynamic_sidebar( 'video-page' );
			echo '
	</div><!-- end .sidebar-left -->';
		}
    break;
	
    case "sidebar-right":
		if ( is_active_sidebar( 'video-page' ) ) {
			echo '
	<div id="sidebar-right">';
		dynamic_sidebar( 'video-page' );
			echo '
	</div><!-- end .sidebar-right -->';
		}
    break;
}

get_footer();