<?php

get_header();

echo '
	<div id="wrap" class="fixed">
	
	<div class="page-title">
		<h1 class="blog">' . esc_html__('Search Results for:', 'wizedesign') . ' ' . $_GET['s'] . '</h1>
	</div>';
	
$page_layout = of_get_option('sidebar_archive');
$src         = null;
$count       = 0;

switch ($page_layout) {
    case "left-sidebar":
        echo '
	<div id="blog-right">';
    break;
		
    case "right-sidebar":
        echo '
	<div id="blog-left">';
    break;
}

if (have_posts())
    while (have_posts()):
        the_post();
        $count++;
        $image_id = get_post_thumbnail_id($post->ID);
        $cover    = wp_get_attachment_image_src($image_id, 'Bl2Sng');
        $no_cover = get_template_directory_uri();
        $category = get_the_category();
		
		/* display */
		
        $src .= '
		<div class="bl2 fixed">
			<div class="bl2-cover">';
        if ($image_id) {
            $src .= '
				<img src="' . esc_url($cover[0]) . '" alt="' . esc_attr(get_the_title()) . '" />';
        } else {
            $src .= '
				<img src="' . esc_url($no_cover) . '/images/no-cover/bl2.png" alt="no-cover" />';
        }
		$src .= '
			</div><!-- end .bl2-cover -->
			<div class="bl2-text">
				<div class="bl2-title">
					<h2><a href="' . esc_url(get_permalink()) . '">' . get_the_title() . '</a></h2>
				</div><!-- end .bl2-title -->
				<p>' . wize_excerpt(550) . '</p>
				<div class="bl2-lvc">
					' . wize_like_info($post->ID) . '
					<div class="info-view">' . wize_get_views(get_the_ID()) . '</div>
					<div class="info-com">' . get_comments_number() . '</div>
				</div><!-- end .bl2-lvc -->
				<div class="bl2-date">' . get_the_date('l, d F Y') . '</div>
			</div><!-- end .bl2-text -->';
        if (is_sticky()) {
            $src .= '
			<div class="sticky">' . esc_html__("Featured", "wizedesign") . '</div>';
        }
        $src .= '
		</div><!-- end .bl2 fixed -->';
		
    endwhile;

echo $src;

if (function_exists("wize_pagination")) {
    wize_pagination();
}

echo '
	</div><!-- end #blog(left&full&right) -->';

if ($count == 0) {
    echo '
		<div class="error-404">
			<h4>' . esc_html__( "No posts were found!", "wizedesign" ) . '</h4>
		</div><!-- end .error-404 -->';
}

switch ($page_layout) {
    case "left-sidebar":
		if ( is_active_sidebar( 'sidebar-page' ) ) {
			echo '
	<div id="sidebar-left">';
        dynamic_sidebar( 'sidebar-page' );
			echo '
	</div><!-- end .sidebar-left -->';
		}
    break;
	
    case "right-sidebar":
		if ( is_active_sidebar( 'sidebar-page' ) ) {
			echo '
	<div id="sidebar-right">';
		dynamic_sidebar( 'sidebar-page' );
			echo '
	</div><!-- end .sidebar-right -->';
		}
    break;
}

get_footer();