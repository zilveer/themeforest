<?php

/*--------------------------------------------------*/
/* Template Name: Photo #2
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
        'post_type' => 'photo',
        'posts_per_page' => $number,
        'paged' => $paged
    );
} else {
    $query = array(
        'post_type' => 'photo',
        'posts_per_page' => $number,
        'paged' => $paged,
        'tax_query' => array(
            array(
                'taxonomy' => 'photos',
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
        $venue    = get_post_meta($post->ID, 'ph_venue', true);
        $date     = get_post_meta($post->ID, 'ph_date', true);
        $time     = strtotime($date);
        $year     = date('Y', $time);
        $month    = date('F', $time);
        $day      = date('d', $time);
        
        /* display */
        
        echo '
		<div class="pv2">
			<div class="pv2-cover">
				<div class="he-wrap he-wize">';
        if ($image_id) {
            echo '
					<img src="' . esc_url($cover[0]) . '" alt="' . esc_attr(get_the_title()) . '" />';
        } else {
            echo '
					<img src="' . esc_url($no_cover) . '/images/no-cover/media.png" alt="no-cover" />';
        }
        echo '
					<div class="he-view">
						<div class="bgmedia a0" data-animate="zoomIn">		
							<a href="' . esc_url(get_permalink()) . '" class="pv2-photo a2" data-animate="zoomIn"></a>
							<div class="pv2-lv">
								' . wize_like_info($post->ID) . '
								<div class="info-view">' . wize_get_views(get_the_ID()) . '</div>
							</div><!-- end .pv2-lkvw -->
						</div><!-- end .bgw a0 -->
					</div><!-- end .he-view -->
				</div><!-- end .he-wrap he-wize -->
				<div class="pv2-info">
					<div class="pv2-title">	
						<h2><a href="' . esc_url(get_permalink()) . '">' . get_the_title() . '</a></h2>
					</div><!-- end .pv2-title -->';
        if ($venue) {
            echo '
					<div class="pv2-venue">' . esc_html($venue, "wizedesign") . '</div>';
        }
        if ($date) {
            echo '
					<div class="pv2-date">' . esc_html($day, "wizedesign") . ' ' . esc_html($month, "wizedesign") . ' ' . esc_html($year, "wizedesign") . '</div>';
        }
        echo '
				</div><!-- end .pv2-info -->
			</div><!-- end .pv2-cover -->
		</div><!-- end .pv2 -->';
		
    endwhile;

if (function_exists("wize_pagination")) {
    wize_pagination();
}

echo '
		</div><!-- end .media(lr&full) -->
	</div><!-- end #media(left&full&right) -->';

switch ($page_layout) {
    case "sidebar-left":
		if ( is_active_sidebar( 'photo-page' ) ) {
			echo '
	<div id="sidebar-left">';
        dynamic_sidebar( 'photo-page' );
			echo '
	</div><!-- end .sidebar-left -->';
		}
    break;
	
    case "sidebar-right":
		if ( is_active_sidebar( 'photo-page' ) ) {
			echo '
	<div id="sidebar-right">';
		dynamic_sidebar( 'photo-page' );
			echo '
	</div><!-- end .sidebar-right -->';
		}
    break;
}

get_footer();