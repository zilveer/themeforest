<?php

/*** FUNCTIONS
 ****************************************************************/
 
include('includes/functions-comment.php');
include('includes/functions-setup.php');
include('includes/functions-menu.php');
include('includes/functions-sidebar.php');
include('post-like.php');

/*** ADMIN POSTS
 ****************************************************************/
 
include('admin/options.php');
include('admin/post.php');
include('admin/page.php');

/*** WIDGETS
 ****************************************************************/
 
include('includes/widgets/blog1.php');
include('includes/widgets/blog2.php');
include('includes/widgets/event1.php');
include('includes/widgets/event2.php');
include('includes/widgets/audio1.php');
include('includes/widgets/audio2.php');
include('includes/widgets/photo.php');
include('includes/widgets/video.php');
include('includes/widgets/like.php');
include('includes/widgets/youtube.php');
include('includes/widgets/vimeo.php');
include('includes/widgets/twitter.php');
include('includes/widgets/slider.php');
include('includes/widgets/flickr.php');
include('includes/widgets/soundcloud.php');

/*** SHORTCODES
 ****************************************************************/
 
include('includes/shortcodes/shortcode.php');
include('includes/shortcodes/blog.php');
include('includes/shortcodes/photo1.php');
include('includes/shortcodes/photo2.php');
include('includes/shortcodes/video1.php');
include('includes/shortcodes/video2.php');
include('includes/shortcodes/audio1.php');
include('includes/shortcodes/audio2.php');
include('includes/shortcodes/event1.php');
include('includes/shortcodes/event2.php');
include('includes/shortcodes/mix.php');
include('includes/shortcodes/cinema.php');

/*** ENQUEUE SCRIPT & STYLE
 ****************************************************************/

function wize_enqueue_script() {
    wp_enqueue_script('slider-revolution', get_template_directory_uri() . '/js/slider.revolution.js', array('jquery'), false, true);
    wp_enqueue_script('slider-tools', get_template_directory_uri() . '/js/slider.tools.js', array('jquery'), false, true);
    wp_enqueue_script('prettyPhoto', get_template_directory_uri() . '/js/prettyPhoto.js', array('jquery'), false, true);
    wp_enqueue_script('backstretch', get_template_directory_uri() . '/js/backstretch.js', array('jquery'), false, true);
	wp_enqueue_script('carouFredSel', get_template_directory_uri() . '/js/carouFredSel.js', array('jquery'), false, true);
    wp_enqueue_script('easy-ticker', get_template_directory_uri() . '/js/easy-ticker.js', array('jquery'), false, true);
    wp_enqueue_script('hoverex', get_template_directory_uri() . '/js/hoverex.js', array('jquery'), false, true);
    wp_enqueue_script('idTabs', get_template_directory_uri() . '/js/idTabs.js', array('jquery'), false, true);
    wp_enqueue_script('flexslider', get_template_directory_uri() . '/js/flexslider.js', array('jquery'), false, true);
	wp_enqueue_script('royal', get_template_directory_uri() . '/js/royal.js', array('jquery'), false, true);
	wp_enqueue_script('sdk', get_template_directory_uri() . '/js/sdk.js', array('jquery'), false, true);
	wp_enqueue_script('audioplayer', get_template_directory_uri() . '/js/audioplayer.js', array('jquery'), false, true);
	wp_enqueue_script('soundmanager2', get_template_directory_uri() . '/js/soundmanager2.js', array('jquery'), false, false);
	wp_enqueue_script('nativeflashradiov3', get_template_directory_uri() . '/radio/nativeflashradiov3.js', array('jquery'), false, true);
    wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js', array('jquery'), false, true);
}

function wize_enqueue_style() {
	$protocol	= is_ssl() ? 'https' : 'http';
    $fontpri	= of_get_option('font_pred');
    $fontsec	= of_get_option('font_sec');
	$disable	= of_get_option('disable_responsive', '1');
	$style       = of_get_option('type_style');	
	wp_enqueue_style('style', get_stylesheet_uri());
	wp_enqueue_style('options', get_template_directory_uri() . '/css/css_options.php');
	wp_enqueue_style('prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css');
    wp_enqueue_style('slider', get_template_directory_uri() . '/css/slider.css');
    wp_enqueue_style('shortcodes', get_template_directory_uri() . '/css/shortcodes.css');
	wp_enqueue_style('royal', get_template_directory_uri() . '/css/royal.css');
    wp_enqueue_style('hoverex', get_template_directory_uri() . '/css/hoverex.css');
	wp_enqueue_style('player', get_template_directory_uri() . '/css/player.css');
    wp_enqueue_style('woocommerce', get_template_directory_uri() . '/css/woocommerce.css');
    wp_enqueue_style('fontpri', "$protocol://fonts.googleapis.com/css?family=$fontpri:400,700,900,300");
    wp_enqueue_style('fontsec', "$protocol://fonts.googleapis.com/css?family=$fontsec:400,700,900,300");
	if (!$disable == '1') {
		wp_enqueue_style('responsive', get_template_directory_uri() . '/css/responsive.css');
	}
	
	switch ($style) {
		case "dark":
			wp_enqueue_style('dark', get_template_directory_uri() . '/css/dark.css');
		break;
		 
		case "light":
			wp_enqueue_style('light', get_template_directory_uri() . '/css/light.css');
		break;
	}
	
}

add_action( 'wp_enqueue_scripts', 'wize_enqueue_script' );
add_action( 'wp_enqueue_scripts', 'wize_enqueue_style' );

/*** ADMIN SCRIPT & STYLE
 ****************************************************************/
 
function wize_admin_script() {
    wp_enqueue_script('custom-js', get_template_directory_uri() . '/admin/post/js/custom.js');
    wp_enqueue_script('setup-js', get_template_directory_uri() . '/admin/post/js/setup.js');
	wp_enqueue_script('datepicker-js', get_stylesheet_directory_uri() . '/admin/post/js/datepicker.js');
	wp_enqueue_script('upload-js', get_stylesheet_directory_uri() . '/admin/post/js/upload.js');
}

function wize_admin_style() {
    wp_register_style('options-panel', get_template_directory_uri() . '/admin/post/css/options-panel.css');
	wp_register_style('datepicker', get_template_directory_uri() . '/admin/post/css/datepicker.css');
    wp_enqueue_style('options-panel' );
	wp_enqueue_style('datepicker' );
}

add_action( 'admin_enqueue_scripts', 'wize_admin_script' );
add_action( 'admin_enqueue_scripts', 'wize_admin_style' );

/*** AJAX SCRIPT
 ****************************************************************/
 
$ajax = of_get_option('active_ajax', '1') == '1';

if ($ajax) {
	function wize_load_scripts() {
		wp_enqueue_script('history', get_template_directory_uri() . '/js/jquery.history.js', array('jquery'));
		wp_enqueue_script('ajax', get_template_directory_uri() . '/js/ajax.js', array('jquery'));
		$data = array(
			'rootUrl' 	=> site_url() . '/',
			'rootTheme' => get_template_directory_uri() . '/',
			'loader' 	=> get_option('loader')
			);
		wp_localize_script('ajax', 'aws_data', $data);
	} 
	add_action( 'wp_enqueue_scripts', 'wize_load_scripts' );
}

/*** EXCERPT
 ****************************************************************/
 
function wize_excerpt_length($length) {
    return 80;
}

function wize_excerpt_more($excerpt) {
    return str_replace('...', '...', $excerpt);
}

add_filter('excerpt_length', 'wize_excerpt_length', 999);
add_filter('wp_trim_excerpt', 'wize_excerpt_more');

function wize_excerpt($limit, $source = null) {
    if ($source == "content" ? ($excerpt = get_the_content()) : ($excerpt = get_the_excerpt()));
    $excerpt = preg_replace(" (\[.*?\])", '', $excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $limit);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = trim(preg_replace('/\s+/', ' ', $excerpt));
    $excerpt = $excerpt . '...';
    return $excerpt;
}

/*** PAGE NAVIGATION
 ****************************************************************/
 
function wize_pagination($pages = '', $range = 5) {
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
        echo '
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
        echo '	
		</div>
    </div><!-- end .pagination-bottom -->';
    }
}

/*** TAGCLOUD FONT SIZE
 ****************************************************************/
 
function wize_tag($args = array()) {
    $args['smallest'] = 14;
    $args['largest']  = 14;
    $args['unit']     = 'px';
    return $args;
}

add_filter('widget_tag_cloud_args', 'wize_tag', 90);

/*** VIEWS
 ****************************************************************/
 
function wize_get_views($postID) {
    $count_key = 'post_views_count';
    $count     = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count . '';
}

function wize_set_views($postID) {
    $count_key = 'post_views_count';
    $count     = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

/*** PREVIOUS AND NEXT LINK
 ****************************************************************/
 
function wize_posts_prev($format) {
    $format = str_replace('href=', 'class="prev" href=', $format);
    return $format;
}

function wize_posts_next($format) {
    $format = str_replace('href=', 'class="next" href=', $format);
    return $format;
}

add_filter('previous_post_link', 'wize_posts_prev');
add_filter('next_post_link', 'wize_posts_next');

/*** TRACKLIST
 ****************************************************************/
 
function wize_track($content) {
    global $post;
    $metadata = get_post_meta($post->ID, 'song', true);
    foreach ((array) $metadata as $meta) {
        $content .= '
			<li><span>';
		if (strlen($post->post_title) > 50) {
            $content .= substr($meta['title'], 0, 50) . '...';
        } else {
            $content .= $meta['title'];
        }
		$content .= '</span></li>';
    }
    return $content;
}

/*** CONVERT RGB COLOR
 ****************************************************************/
 
function wize_hex2rgba($color, $opacity = false) {

	$default = 'rgb(0,0,0)';

	if(empty($color))
          return $default; 

        if ($color[0] == '#' ) {
        	$color = substr( $color, 1 );
        }

        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }

        $rgb =  array_map('hexdec', $hex);

        if($opacity){
        	if(abs($opacity) > 1)
        		$opacity = 1.0;
        	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
        	$output = 'rgb('.implode(",",$rgb).')';
        }

        return $output;
}

/*** LANGUAGES poEDIT
 ****************************************************************/
function wize_theme_init(){
    load_theme_textdomain('beaton', get_template_directory() . '/languages');
}

add_action ('init', 'wize_theme_init');

/*** WOOCOMMERCE
 ****************************************************************/

function wize_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

add_action( 'after_setup_theme', 'wize_woocommerce_support' );

// Remove each style one by one

function wize_dequeue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
	unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
	unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
	return $enqueue_styles;
}

add_filter( 'woocommerce_enqueue_styles', 'wize_dequeue_styles' );
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

function wize_remove_woo_widgets() {
    unregister_widget( 'WC_Widget_Recent_Products' );
    unregister_widget( 'WC_Widget_Featured_Products' );
    unregister_widget( 'WC_Widget_Product_Categories' );
    unregister_widget( 'WC_Widget_Product_Tag_Cloud' );
    unregister_widget( 'WC_Widget_Cart' );
    unregister_widget( 'WC_Widget_Layered_Nav' );
    unregister_widget( 'WC_Widget_Layered_Nav_Filters' );
    unregister_widget( 'WC_Widget_Price_Filter' );
    unregister_widget( 'WC_Widget_Product_Search' );
    unregister_widget( 'WC_Widget_Top_Rated_Products' );
    unregister_widget( 'WC_Widget_Recent_Reviews' );
    unregister_widget( 'WC_Widget_Recently_Viewed' );
    unregister_widget( 'WC_Widget_Best_Sellers' );
    unregister_widget( 'WC_Widget_Onsale' );
    unregister_widget( 'WC_Widget_Random_Products' );
}

add_action( 'widgets_init', 'wize_remove_woo_widgets' );