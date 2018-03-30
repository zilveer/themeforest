<?php

/*--------------------------------------------------*/
/* Template Name: Dj Mixes
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
        'post_type' => 'mix',
        'posts_per_page' => $number,
        'paged' => $paged
    );
} else {
    $query = array(
        'post_type' => 'mix',
        'posts_per_page' => $number,
        'paged' => $paged,
        'tax_query' => array(
            array(
                'taxonomy' => 'mixes',
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
        $cover    = wp_get_attachment_image_src($image_id, 'SldFull');
		$coverMx  = wp_get_attachment_image_src($image_id, 'AdMx');
        $no_cover = get_template_directory_uri();
		$dj   	  = get_post_meta($post->ID, 'mx_dj', true);
		$genre    = get_post_meta($post->ID, 'mx_genre', true);
        $date     = get_post_meta($post->ID, 'mx_date', true);
		$sound      = get_post_meta($post->ID, 'mx_sd', true);
        $time     = strtotime($date);
        $year     = date('Y', $time);
        $month    = date('F', $time);
        $day      = date('d', $time);
        $player   = null;
        $playlist = null;
        $args     = array(
            'post_type' => 'attachment',
            'numberposts' => -1,
            'post_status' => null,
            'post_parent' => $post->ID
        );
        $attachments = get_posts($args);
        $arrImages =& get_children('post_type=attachment&orderby=title&order=ASC&post_mime_type=audio/mpeg&post_parent=' . get_the_ID());
        if ($arrImages) {
            foreach ($arrImages as $attachment) {
                $playlist .= '
				<a href="' . esc_url(wp_get_attachment_url($attachment->ID)) . '" class="fap-single-track mix-play no-ajax" title="' . esc_attr($attachment->post_title) . '" rel="' . esc_attr($coverMx[0]) . '" data-meta="#player-meta-mix' . esc_attr($post->ID) . '"></a>';
            }
        }
		
		$playsdc .= '
				<a href="' . esc_url($sound) . '" class="fap-single-track mix-play no-ajax"></a>';
		
		/* display */
		
        echo '
		<div class="mix">
			<div class="mix-cover">
				<div class="mix-bg"></div>';
        if ($image_id) {
            echo '
				<img src="' . esc_url($cover[0]) . '" alt="' . esc_attr( get_the_title() ) . '" />';
        } else {
            echo '
				<img src="' . esc_url($no_cover) . '/images/no-cover/mix.png" alt="no-cover" />';
        }
		if ($sound) {
			echo $playsdc;
		} else {
			echo $playlist;
		}
        echo '
			</div><!-- end .mix-cover -->
			<div class="mix-lv">
				' . wize_like_info($post->ID) . '
				<div class="info-view">' . wize_get_views(get_the_ID()) . '</div>
			</div><!-- end .mix-lv -->
			<div class="mix-title">
				<h2><a href="' . esc_url( get_permalink() ) . '">';
        if (strlen($post->post_title) > 60) {
            echo substr(get_the_title($before = '', $after = '', FALSE), 0, 60) . '...';
        } else {
            echo get_the_title();
        }
        echo '</a></h2>';
		if ($date) {
			echo '				
				<span>' . esc_html($day, "wizedesign") . ' ' . esc_html($month, "wizedesign") . ' ' . esc_html($year, "wizedesign") . '</span>';
			}
		echo '
			</div><!-- end .mix-title -->
			<div class="mix-info">';
		if ($dj) {
			echo '
				<div class="mix-dj">' . esc_html($dj, "wizedesign") . '</div>';	
			}
		if ($genre) {
			echo '
				<div class="mix-genre">' . esc_html($genre, "wizedesign") . '</div>';	
			}
		echo '
			</div><!-- end .mix-info -->
		</div><!-- end .mix -->';
		
		/* display  none */
		
		echo ' 
        <span id="player-meta-mix' . esc_attr($post->ID) . '" class="player-meta-mix">
			<a href="' . esc_url(get_permalink()) . '#mixsng-tracklist">' . esc_html__("tracklist", "wizedesign") . '</a>
			<div>' . esc_html($genre, "wizedesign") . '</div>
        </span><!-- end span#player-meta-mix -->';
		
    endwhile;

if (function_exists("wize_pagination")) {
    wize_pagination();
}

echo '
	</div><!-- end #blog(left&full&right) -->';

switch ($page_layout) {
    case "sidebar-left":
		if ( is_active_sidebar( 'mix-page' ) ) {
			echo '
	<div id="sidebar-left">';
        dynamic_sidebar( 'mix-page' );
			echo '
	</div><!-- end .sidebar-left -->';
		}
    break;
	
    case "sidebar-right":
		if ( is_active_sidebar( 'mix-page' ) ) {
			echo '
	<div id="sidebar-right">';
		dynamic_sidebar( 'mix-page' );
			echo '
	</div><!-- end .sidebar-right -->';
		}
    break;
}

get_footer();