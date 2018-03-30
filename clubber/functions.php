<?php

/*** FUNCTIONS
 ****************************************************************/
include('includes/functions-comment.php');
include('includes/functions-setup.php');
include('includes/functions-menu.php');
include('includes/functions-layout.php');
include('includes/functions-sidebar.php');

/*** ADMIN POSTS
 ****************************************************************/
include('admin/audio.php');
include('admin/video.php');
include('admin/photo.php');
include('admin/event.php');
include('admin/slide.php');
include('admin/options.php');

/*** WIDGETS
 ****************************************************************/
include('includes/widgets/widget-twitter.php');
include('includes/widgets/widget-flickr.php');
include('includes/widgets/widget-blog.php');
include('includes/widgets/widget-events.php');
include('includes/widgets/widget-videos.php');
include('includes/widgets/widget-photos.php');
include('includes/widgets/widget-audio.php');
include('includes/widgets/widget-soundcloud.php');

/*** SHORTCODES
 ****************************************************************/
include('includes/shortcodes/shortcode-posts.php');
include('includes/shortcodes/shortcode.php');
include('includes/shortcodes/shortcode-soundcloud.php');

/*** EXCERPT
 ****************************************************************/
function custom_excerpt_length($length) {
    return 45;
}
add_filter('excerpt_length', 'custom_excerpt_length', 999);
function new_excerpt_more($excerpt) {
    return str_replace('[...]', '...', $excerpt);
}
add_filter('wp_trim_excerpt', 'new_excerpt_more');
function the_excerpt_max_event($charlength) {
	$excerpt = get_the_excerpt();
	$charlength++;
	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo '...';
	} else {
		echo $excerpt;
	}
}
function the_excerpt_max($charlength) {
	$items_src   = null;
	$excerpt = get_the_excerpt();
	$charlength++;
	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			$items_src .= ' ' . mb_substr( $subex, 0, $excut ) . ' ';
			$items_src .= '...';
			return $items_src;
		} else {
			return $subex;
		}
	} else {
		return $excerpt;
	}
}

/*** PAGE NAVIGATION
 ****************************************************************/

function pagination($pages = '', $range = 4) {
    $showitems = ($range * 2) + 1;
    global $paged;
    if (empty($paged))
        $paged = 1;
    if ($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if (!$pages) {
            $pages = 1;
        }
    }
    if (1 != $pages) {
        echo "<div class=\"pagination\">";
        if ($paged > 2 && $paged > $range + 1 && $showitems < $pages)
            echo "<a href='" . get_pagenum_link(1) . "'>&laquo; First</a>";
        if ($paged > 1 && $showitems < $pages)
            echo "<a href='" . get_pagenum_link($paged - 1) . "'>&lsaquo; Previous</a>";
        for ($i = 1; $i <= $pages; $i++) {
            if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
                echo ($paged == $i) ? "<span class=\"current\">" . $i . "</span>" : "<a href='" . get_pagenum_link($i) . "' class=\"inactive\">" . $i . "</a>";
            }
        }
        if ($paged < $pages && $showitems < $pages)
            echo "<a href=\"" . get_pagenum_link($paged + 1) . "\">Next &rsaquo;</a>";
        if ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages)
            echo "<a href='" . get_pagenum_link($pages) . "'>Last &raquo;</a>";
        echo "</div>\n";
    }
}

/*** CATEGORY POST TYPES
 ****************************************************************/
function cat_post_types() {
    global $post;
    if (is_single() && !is_attachment()) {
        if (get_post_type() != 'post') {
            $post_type = get_post_type_object(get_post_type());
            $slug      = $post_type->rewrite;
            echo '' . $post_type->labels->singular_name . '';
        }
    }
}
add_filter('sidebars_widgets', 'disable_footer_widgets');
function disable_footer_widgets($sidebars_widgets) {
    if (is_single())
        $sidebars_widgets['audio_widget'] = false;
    return $sidebars_widgets;
}

/*** TAGCLOUD FONT SIZE
 ****************************************************************/
add_filter('widget_tag_cloud_args', 'wz_tag_cloud_filter', 90);
function wz_tag_cloud_filter($args = array()) {
$args['smallest'] = 14;
$args['largest'] = 14;
$args['unit'] = 'px';
return $args;
}


/*** LANGUAGES poEDIT
 ****************************************************************/
function theme_init(){
    load_theme_textdomain('clubber', get_template_directory() . '/languages');
}
add_action ('init', 'theme_init');



/*** FIXED
 ****************************************************************/

add_theme_support('automatic-feed-links');
if ( ! isset( $content_width ) ) $content_width = 900;

?>