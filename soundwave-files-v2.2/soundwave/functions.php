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
include('admin/mix.php');
include('admin/artist.php');
include('admin/slider.php');
include('admin/options.php');

/*** WIDGETS
 ****************************************************************/
include('includes/widgets/widget-flickr.php');
include('includes/widgets/widget-blog.php');
include('includes/widgets/widget-events.php');
include('includes/widgets/widget-videos.php');
include('includes/widgets/widget-photos.php');
include('includes/widgets/widget-audio.php');
include('includes/widgets/widget-soundcloud.php');
include('includes/widgets/widget-twitter.php');

/*** SHORTCODES
 ****************************************************************/
include('includes/shortcodes/shortcode.php');
include('includes/shortcodes/shortcode-blog.php');
include('includes/shortcodes/shortcode-audio.php');
include('includes/shortcodes/shortcode-event.php');
include('includes/shortcodes/shortcode-video.php');
include('includes/shortcodes/shortcode-photo.php');
include('includes/shortcodes/shortcode-artist.php');
include('includes/shortcodes/shortcode-mix.php');
include('includes/shortcodes/shortcode-soundcloud.php');

/*** ENQUEUE SCRIPT & STYLE
 ****************************************************************/
add_action('wp_enqueue_scripts', 'wizedesign_load_javascript');
add_action('init', 'loadSetupReference');
add_action('admin_head', 'wize_load_adminscripts');
function wizedesign_load_javascript() {
	wp_enqueue_script('flexslider', get_template_directory_uri() . '/js/flexslider.js', array( 'jquery' ), false, true );
    wp_enqueue_script('fullwidthAudioPlayer', get_template_directory_uri() . '/js/fullwidthAudioPlayer.js', array( 'jquery' ), false, true );
	wp_enqueue_script('jPlayerRadio', get_template_directory_uri() . '/js/jPlayerRadio.js', array( 'jquery' ), false, true );
	wp_enqueue_script('prettyPhoto', get_template_directory_uri() . '/js/prettyPhoto.js', array('jquery'), false, true );
	wp_enqueue_script('backstretch', get_template_directory_uri() . '/js/backstretch.js', array('jquery'), false, true );
	wp_enqueue_script('hoverex', get_template_directory_uri() . '/js/hoverex.js', array('jquery'), false, true );
	wp_enqueue_script('gmap', get_template_directory_uri() . '/js/gmap.js', array('jquery'), false, true );
	wp_enqueue_script('idTabs', get_template_directory_uri() . '/js/idTabs.js', array('jquery'), false, true );
	wp_enqueue_script('firstword', get_template_directory_uri() . '/js/firstword.js', array('jquery'), false, true );
	wp_enqueue_script('scriptnoajax', get_template_directory_uri() . '/js/scriptnoajax.js', array('jquery'), false, true );
	wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js', array('jquery'), false, true );
    wp_enqueue_script('map', 'http://maps.googleapis.com/maps/api/js?sensor=false', array('jquery'), false, true );	
		
}

function wize_load_adminscripts() {
 	if(!is_admin() ) {
 		return ;
 	}
 	global $pagenow;
 	if(in_array( $pagenow, array('post.php', 'post-new.php' ) ) ) {
	    wp_enqueue_script('setup-js', get_stylesheet_directory_uri() . '/admin/post/js/setup.js');
        wp_enqueue_script('ui-custom-js', get_stylesheet_directory_uri() . '/admin/post/js/ui-custom.js');
        wp_enqueue_script('datepicker-js', get_stylesheet_directory_uri() . '/admin/post/js/datepicker.js');
		wp_enqueue_script('upload-js', get_stylesheet_directory_uri() . '/admin/post/js/upload.js');
	}	
}

function loadSetupReference() {
$protocol = is_ssl() ? 'https' : 'http';
$font = of_get_option('font_pred');
    if (is_admin()) {
        wp_enqueue_style('setup', get_template_directory_uri() . '/admin/post/css/options-panel.css');
        wp_enqueue_style('datepicker', get_template_directory_uri() . '/admin/post/css/datepicker.css');
    } else {
		wp_enqueue_script('jquery');	
		wp_enqueue_script('soundmanager2', get_template_directory_uri() . '/js/soundmanager2.js', array('jquery'));
		wp_enqueue_style('style', get_stylesheet_uri() );
		wp_enqueue_style('css-option', get_template_directory_uri() . '/css-option.php');
        wp_enqueue_style('prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css');
        wp_enqueue_style('shortcodes', get_template_directory_uri() . '/css/shortcodes.css');
		wp_enqueue_style('slider', get_template_directory_uri() . '/css/slider.css');
		wp_enqueue_style('hover', get_template_directory_uri() . '/css/hover.css');	
		if (of_get_option('active_resp', '1') == '1') {
		wp_enqueue_style('responsive', get_template_directory_uri() . '/css/responsive.css');
		}
		wp_enqueue_style('font', "$protocol://fonts.googleapis.com/css?family=$font:400,700,900,300" );
		if (of_get_option('active_player', '1') == '1') {
		wp_enqueue_style('player', get_template_directory_uri() . '/css/player.css');
		} 
    }
		if (of_get_option('active_ajax', '1') == '1') {
			add_action('wp_enqueue_scripts', 'aws_load_scripts');
			function aws_load_scripts() {
			wp_enqueue_script('history', get_template_directory_uri() . '/js/jquery.history.js', array('jquery'));
			wp_enqueue_script('ajax', get_template_directory_uri() . '/js/ajax.js', array('jquery'));
			$data = array(
				'rootUrl' 		=> site_url() . '/',
				'rootTheme'     => get_template_directory_uri() . '/',
				'loader' 		=> get_option('loader')
			);
			wp_localize_script('ajax', 'aws_data', $data);
		    } 
		}
}

/*** EXCERPT
 ****************************************************************/
function custom_excerpt_length($length) {
    return 65;
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

function pag_full_wz($pages = '', $range = 4) {
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
	echo'
	<div class="pagination-bottom-media">
	<div class="pagination-pos">';
	
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
	echo'	
    </div>
    </div><!-- end .pagination-pos -->';
    }
}

function pag_half_wz($pages = '', $range = 4) {
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
	echo'
	<div class="pagination-bottom">
	<div class="pagination-pos">';
	
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
	echo'	
    </div>
    </div><!-- end .pagination-pos -->';
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
    load_theme_textdomain('wizedesign', get_template_directory() . '/languages');
}
add_action ('init', 'theme_init');

?>