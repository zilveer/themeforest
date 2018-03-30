<?php

/*--------------------------------------------------*/
/* Template Name: Blog #1
/*--------------------------------------------------*/

get_header();

if (is_front_page()) {
    $paged = (get_query_var('page')) ? get_query_var('page') : 1;
}

$number      = get_post_meta($post->ID, "page_number", true);
$category    = get_post_meta($post->ID, "page_category", true);
$page_layout = wize_page_sidebar_layout();
$page_slider = wize_page_slider_layout();
$query       = array(
    'post_type' => 'post',
    'category_name' => $category,
    'posts_per_page' => $number,
    'paged' => $paged
);

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
	<div id="blog-right">';
    break;
		
    case "sidebar-full":
        echo '
	<div id="blog-full">';
    break;
		
    case "sidebar-right":
        echo '
	<div id="blog-left">';
    break;
}

$wp_query = new WP_Query($query);
if (have_posts())
    while ($wp_query->have_posts()):
        $wp_query->the_post();
        $image_id = get_post_thumbnail_id($post->ID);
        $cover    = wp_get_attachment_image_src($image_id, 'Bl1PhVd');
        $no_cover = get_template_directory_uri();
        $category = get_the_category();
        
		/* display */
		
        echo '
		<div class="bl1">
			<div class="bl1-cover">';
        if ($image_id) {
            echo '
				<img src="' . esc_url($cover[0]) . '" alt="' . esc_attr(get_the_title()) . '" />';
        } else {
            echo '
				<img src="' . esc_url($no_cover) . '/images/no-cover/bl1.png" alt="no-cover" />';
        }
        echo '
				<div class="bl1-cat">' . esc_html($category[0]->cat_name, "wizedesign") . '</div>
			</div><!-- end .bl1-cover -->
			<div class="bl1-text">
				<div class="bl1-title">
					<h2><a href="' . esc_url(get_permalink()) . '">';
            if (strlen($post->post_title) > 63) {
                echo substr(the_title($before = '', $after = '', FALSE), 0, 63) . '...';
            } else {
                the_title();
            }
            echo '</a></h2>
				</div><!-- end .bl1-title -->
				<p>' . wize_excerpt(270) . '</p>
				<div class="bl1-date">' . get_the_date('l, d F Y') . '</div>
				<div class="bl1-lvc">
					' . wize_like_info($post->ID) . '
					<div class="info-view">' . wize_get_views(get_the_ID()) . '</div>
					<div class="info-com">' . get_comments_number() . '</div>
				</div><!-- end .bl1-lvc -->
			</div><!-- end .bl1-text -->';
        if (is_sticky()) {
            echo '
			<div class="sticky">' . esc_html__("Featured", "wizedesign") . '</div>';
        }
        echo '
		</div><!-- end .bl1 -->';
		
    endwhile;

if (function_exists("wize_pagination")) {
    wize_pagination();
}

echo '
	</div><!-- end #blog(left&full&right) -->';

switch ($page_layout) {
    case "sidebar-left":
		if ( is_active_sidebar( 'blog-one-page' ) ) {
			echo '
	<div id="sidebar-left">';
        dynamic_sidebar('blog-one-page');
			echo '
	</div><!-- end #sidebar-left -->';
		}
    break;
		
    case "sidebar-right":
		if ( is_active_sidebar( 'blog-one-page' ) ) {
			echo '
	<div id="sidebar-right">';
        dynamic_sidebar('blog-one-page');
			echo '
	</div><!-- end #sidebar-right -->';
		}
    break;
}

get_footer();