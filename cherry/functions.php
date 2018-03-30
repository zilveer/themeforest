<?php
@define( 'PARENT_DIR', get_template_directory() );
@define( 'CHILD_DIR', get_stylesheet_directory() );

@define( 'PARENT_URL', get_template_directory_uri() );
@define( 'CHILD_URL', get_stylesheet_directory_uri() );

// Re-define meta box path and URL
define( 'RWMB_URL', trailingslashit( get_template_directory_uri() . '/admin/meta-box-master/' ) );
define( 'RWMB_DIR', trailingslashit( get_stylesheet_directory(). '/admin/meta-box-master/' ) );

/*-----------------------------------------------------------------------------------*/
/* Initialize the Options Framework
/* http://wptheming.com/options-framework-theme/
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/' );
	require_once (PARENT_DIR . '/admin/options-framework.php');
}

// Include the meta box script
require_once RWMB_DIR . 'meta-box.php';

// Include the meta box
include PARENT_DIR.'/lib/metaboxes.php';

//Admin enque script for metabox
function theme_admin_metabox_script_loader() {
    wp_enqueue_script( 'jquery-custom-admin', get_template_directory_uri() . '/javascripts/jquery.custom.admin.js', array( 'jquery' ), '1.2.3', true );
}
add_action( 'admin_enqueue_scripts', 'theme_admin_metabox_script_loader' );

include PARENT_DIR.'/lib/post-thumb-pos.php';

// Include post types
require_once PARENT_DIR . '/lib/post-types.php';
// Include sidebars
require_once PARENT_DIR . '/lib/sidebars.php';

 /**
 * Returns an array of system fonts
 */

function options_typography_get_os_fonts() {
	// OS Font Defaults
	$os_faces = array(
		'Arial, sans-serif' => 'Arial',
		'"Avant Garde", sans-serif' => 'Avant Garde',
		'Cambria, Georgia, serif' => 'Cambria',
		'Copse, sans-serif' => 'Copse',
		'Garamond, "Hoefler Text", Times New Roman, Times, serif' => 'Garamond',
		'Georgia, serif' => 'Georgia',
		'"Helvetica Neue", Helvetica, sans-serif' => 'Helvetica Neue',
		'Tahoma, Geneva, sans-serif' => 'Tahoma',
		'Lucida Sans Unicode, Lucida Grande, sans-serif' => 'Lucida'
	);
	return $os_faces;
}

/**
 * Returns a select list of Google fonts
 */

function options_typography_get_google_fonts() {
	// Google Font Defaults
	$google_faces = array(
		'Arvo, serif' => 'Arvo',
		'Copse, sans-serif' => 'Copse',
		'Droid Sans, sans-serif' => 'Droid Sans',
		'Droid Serif, serif' => 'Droid Serif',
		'Lobster, cursive' => 'Lobster',
		'Nobile, sans-serif' => 'Nobile',
		'Open Sans, sans-serif' => 'Open Sans',
		'Oswald, sans-serif' => 'Oswald',
		'Pacifico, cursive' => 'Pacifico',
		'Rokkitt, serif' => 'Rokkit',
		'Oswald, sans-serif' => 'Oswald',
		'PT Sans, sans-serif' => 'PT Sans',
		'Quattrocento, serif' => 'Quattrocento',
		'Raleway, cursive' => 'Raleway',
		'Ubuntu, sans-serif' => 'Ubuntu',
		'Yanone Kaffeesatz, sans-serif' => 'Yanone Kaffeesatz'
	);
	return $google_faces;
}


/* 
 * Returns a typography option in a format that can be outputted as inline CSS
 */
 
function options_typography_font_styles($option, $selectors) {
		$output = $selectors . ' {';
		$output .= ' color:' . $option['color'] .'; ';
		$output .= 'font-family:' . $option['face'] . '; ';
		$output .= 'font-weight:' . $option['style'] . '; ';
		$output .= 'font-size:' . $option['size'] . '; ';
		$output .= '}';
		$output .= "\n";
		return $output;
}

/**
 * Checks font options to see if a Google font is selected.
 * If so, options_typography_enqueue_google_font is called to enqueue the font.
 * Ensures that each Google font is only enqueued once.
 */
 
if ( !function_exists( 'options_typography_google_fonts' ) ) {
	function options_typography_google_fonts() {
		$all_google_fonts = array_keys( options_typography_get_google_fonts() );
		// Define all the options that possibly have a unique Google font
		$body_typography = of_get_option('body_typography', array('size' => '12px','face' => 'Lucida Sans Unicode, Lucida Grande, sans-serif','style' => 'normal','color' => '#747779'));
		$menu_typography = of_get_option('menu_typography', array('size' => '16px','face' => 'Oswald, sans-serif','style' => 'normal','color' => '#000000'));
		$h1_typography = of_get_option('h1_typography', array('size' => '30px','face' => 'Lucida Sans Unicode, Lucida Grande, sans-serif','style' => 'normal','color' => '#000000'));
		$h2_typography = of_get_option('h2_typography', array('size' => '24px','face' => 'Lucida Sans Unicode, Lucida Grande, sans-serif','style' => 'normal','color' => '#000000'));
		$h3_typography = of_get_option('h3_typography', array('size' => '18px','face' => 'Lucida Sans Unicode, Lucida Grande, sans-serif','style' => 'normal','color' => '#000000'));
		$h4_typography = of_get_option('h4_typography', array('size' => '14px','face' => 'Lucida Sans Unicode, Lucida Grande, sans-serif','style' => 'bold','color' => '#000000'));
		$h5_typography = of_get_option('h5_typography', array('size' => '12px','face' => 'Lucida Sans Unicode, Lucida Grande, sans-serif','style' => 'bold','color' => '#000000'));
		// Get the font face for each option and put it in an array
		$selected_fonts = array(
			$body_typography['face'],
			$menu_typography['face'],
			$h1_typography['face'],
			$h2_typography['face'],
			$h3_typography['face'],
			$h4_typography['face'],
			$h5_typography['face'] );
		// Remove any duplicates in the list
		$selected_fonts = array_unique($selected_fonts);
		// Check each of the unique fonts against the defined Google fonts
		// If it is a Google font, go ahead and call the function to enqueue it
		foreach ( $selected_fonts as $font ) {
			if ( in_array( $font, $all_google_fonts ) ) {
				options_typography_enqueue_google_font($font);
			}
		}
	}
}

add_action( 'wp_enqueue_scripts', 'options_typography_google_fonts' );

/**
 * Enqueues the Google $font that is passed
 */
 
function options_typography_enqueue_google_font($font) {
	$font = explode(',', $font);
	$font = $font[0];
	// Certain Google fonts need slight tweaks in order to load properly
	// Like our friend "Raleway"
	if ( $font == 'Raleway' )
		$font = 'Raleway:100';
	$font = str_replace(" ", "+", $font);
	wp_enqueue_style( "options_typography_$font", "http://fonts.googleapis.com/css?family=$font", false, null, 'all' );
}

/*
 * override default filter for 'textarea' sanitization.
 */
 
add_action('admin_init','optionscheck_change_santiziation', 100);
 
function optionscheck_change_santiziation() {
    remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
    add_filter( 'of_sanitize_textarea', 'st_custom_sanitize_textarea' );
}

function st_custom_sanitize_textarea($input) {
    global $allowedposttags;
    $custom_allowedtags["embed"] = array(
      "src" => array(),
      "type" => array(),
      "allowfullscreen" => array(),
      "allowscriptaccess" => array(),
      "height" => array(),
          "width" => array()
      );
    	$custom_allowedtags["script"] = array();
    	$custom_allowedtags["a"] = array('href' => array(),'title' => array());
    	$custom_allowedtags["img"] = array('src' => array(),'title' => array(),'alt' => array());
    	$custom_allowedtags["br"] = array();
    	$custom_allowedtags["em"] = array();
    	$custom_allowedtags["strong"] = array();
      $custom_allowedtags = array_merge($custom_allowedtags, $allowedposttags);
      $output = wp_kses( $input, $custom_allowedtags);
    return $output;
        $of_custom_allowedtags = array_merge($of_custom_allowedtags, $allowedtags);
        $output = wp_kses( $input, $of_custom_allowedtags);
    return $output;
}


require_once (PARENT_DIR . '/lib/shortcodes-ultimate/shortcodes-ultimate.php');
require_once (PARENT_DIR . '/lib/widgets.php');
require_once (PARENT_DIR . '/lib/custom-scripts.php');
 
//REMOVE VERSION STRING FROM HEADER
remove_action('wp_head', 'wp_generator'); 
 
function options_stylesheets_alt_style()   {
	if ( of_get_option('stylesheet') ) {
		wp_enqueue_style( 'options_stylesheets_alt_style', of_get_option('stylesheet'), array(), null );
	}
}
add_action( 'wp_enqueue_scripts', 'options_stylesheets_alt_style' );

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

// Register Core Stylesheets
if ( !function_exists( 'st_registerstyles' ) && !is_admin() ) {

add_action('get_header', 'st_registerstyles');
function st_registerstyles() {
	$theme  = wp_get_theme();
	$version = $theme['Version'];
	$slideshow = of_get_option('slideshow_select'); 
  	$stylesheets = wp_enqueue_style('cherry', get_template_directory_uri().'/styles/skeleton.css', false, $version, 'screen, projection');
    $stylesheets .= wp_enqueue_style('theme', get_template_directory_uri().'/style.css', 'cherry', $version, 'screen, projection');
  	$stylesheets .= wp_enqueue_style('layout', get_template_directory_uri().'/styles/layout.css', 'cherry', $version, 'screen, projection');
    $stylesheets .= wp_enqueue_style('formalize', get_template_directory_uri().'/styles/formalize.css', 'cherry', $version, 'screen, projection');
    $stylesheets .= wp_enqueue_style('superfish', get_template_directory_uri().'/styles/superfish.css', 'cherry', $version, 'screen, projection');
	$stylesheets .= wp_enqueue_style('responsiveslides', get_template_directory_uri().'/styles/responsiveslides.css', 'cherry', $version, 'screen, projection');
	$stylesheets .= wp_enqueue_style('prettyphoto', get_template_directory_uri().'/styles/prettyPhoto.css', 'cherry', $version, 'screen, projection');
	$stylesheets .= wp_enqueue_style('isotope', get_template_directory_uri().'/styles/isotope.css', 'cherry', $version, 'screen, projection');
	$stylesheets .= wp_enqueue_style('map', get_template_directory_uri().'/lib/map/map.css', 'cherry', $version, 'screen, projection');
	
	$stylesheets .= wp_enqueue_style('slideshow-sequence', get_template_directory_uri().'/styles/sequencejs-theme.modern-slide-in.css', 'cherry', $version, 'screen, projection');
	$stylesheets .= wp_enqueue_style('slideshow-camera', get_template_directory_uri().'/styles/camera.css', 'cherry', $version, 'screen, projection');
		echo apply_filters ('child_add_stylesheets',$stylesheets);
}

}

// Build Query vars for dynamic theme option CSS from Options Framework

if ( !function_exists( 'production_stylesheet' )) {

function production_stylesheet($public_query_vars) {
    $public_query_vars[] = 'get_styles';
    return $public_query_vars;
}
add_filter('query_vars', 'production_stylesheet');
}

if ( !function_exists( 'theme_css' ) ) {
add_action('template_redirect', 'theme_css');
function theme_css(){
    $css = get_query_var('get_styles');
    if ($css == 'css'){
        include_once (PARENT_DIR . '/style.php');
        exit;  //This stops WP from loading any further
    }
}
}

if ( !function_exists( 'st_header_scripts' ) && !is_admin() ) {

add_action('init', 'st_header_scripts');
function st_header_scripts() {
  $slideshow = of_get_option('slideshow_select'); 
  $javascripts  = wp_enqueue_script('jquery');
  $javascripts .= wp_enqueue_script('custom',get_template_directory_uri() ."/javascripts/app.js",array('jquery'),'1.2.3',true);
	$javascripts .= wp_enqueue_script('superfish',get_template_directory_uri() ."/javascripts/superfish.js",array('jquery'),'1.2.3',true);
	$javascripts .= wp_enqueue_script('formalize',get_template_directory_uri() ."/javascripts/jquery.formalize.min.js",array('jquery'),'1.2.3',true);
	$javascripts .= wp_enqueue_script('slideshow',get_template_directory_uri() ."/javascripts/responsiveslides.min.js",array('jquery'),'1.2.3',true);
	$javascripts .= wp_enqueue_script('prettyphoto',get_template_directory_uri() ."/javascripts/jquery.prettyPhoto.js",array('jquery'),'1.2.3',true);
	$javascripts .= wp_enqueue_script('caroufred',get_template_directory_uri() ."/javascripts/jquery.carouFredSel-6.1.0-packed.js",array('jquery'),'1.2.3',true);
	$javascripts .= wp_enqueue_script('isotope',get_template_directory_uri() ."/javascripts/jquery.isotope.min.js",array('jquery'),'1.2.3',true);
	$javascripts .= wp_enqueue_script('mobilemenu',get_template_directory_uri() ."/javascripts/jquery.mobilemenu.js",array('jquery'),'1.2.3',true);
	$javascripts .= wp_enqueue_script('fitvids',get_template_directory_uri() ."/javascripts/jquery.fitvids.js",array('jquery'),'1.2.3',true);
	$javascripts .= wp_enqueue_script('google-map',"http://maps.google.com/maps/api/js?sensor=false");
	echo apply_filters ('child_add_javascripts',$javascripts);
}

}

//Add scripts with home check
add_action( 'wp', 'wpse47305_check_home' );
function wpse47305_check_home() {
    if ( is_home() )
        add_action( 'wp_enqueue_scripts', 'st_header_scripts_home' );
}

if ( !function_exists( 'st_header_scripts_home' ) && !is_admin() ) {
function st_header_scripts_home() {
  $slideshow = of_get_option('slideshow_select');
  $javascripts  = wp_enqueue_script('jquery'); 
	if (($slideshow == "sequence")) {
		$javascripts .= wp_enqueue_script('slideshow-sequence',get_template_directory_uri() ."/javascripts/sequence.jquery-min.js",array('jquery'),'1.2.3',true);
	}
	if (($slideshow == "camera")){
		$javascripts .= wp_enqueue_script('easing',get_template_directory_uri() ."/javascripts/jquery.easing.1.3.js",array('jquery'),'1.2.3',true);
		$javascripts .= wp_enqueue_script('slideshow-camera',get_template_directory_uri() ."/javascripts/camera.min.js",array('jquery'),'1.2.3',true);
	}
	echo apply_filters ('child_add_javascripts',$javascripts);
}

}

// Clean HTML
add_filter('the_content', 'shortcode_empty_paragraph_fix');

function shortcode_empty_paragraph_fix($content)
{   
$array = array (
	'<p>[' => '[', 
	']</p>' => ']', 
	']<br />' => ']'
);
$content = strtr($content, $array);
return $content;
}


/** Tell WordPress to run cherry_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'cherry_setup' );

if ( ! function_exists( 'cherry_setup' ) ):

function cherry_setup() {
	
	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 620, 310, true ); // default Post Thumbnail dimensions (cropped)

	// additional image sizes
	bt_add_image_size( 'blog-single', 620, 310, array( 'left', 'top' ) );
	bt_add_image_size( 'slideshow-thumbnail', 970, 400 , array( 'left', 'top' ) );
	bt_add_image_size( 'slideshow-camera-thumbnail', 1200, 500 , array( 'left', 'top' ) );
	bt_add_image_size( 'camera-thumbnail', 100, 75 , array( 'left', 'top' ) );
	bt_add_image_size( 'sequence-thumbnail', 266, 568 , array( 'left', 'top' ) );
	bt_add_image_size( 'sequence-thumbnail-mini', 60, 128 , array( 'left', 'top' ) );
	bt_add_image_size( 'page-thumbnail', 970, 400 , array( 'left', 'top' ) );
	bt_add_image_size( 'blog-thumbnail-3-col', 300, 300 , array( 'left', 'top' ) );
	bt_add_image_size( 'portfolio-thumbnail-4-col', 220, 300 , array( 'left', 'top' ) );
	bt_add_image_size( 'portfolio-thumbnail-3-col', 300, 413 , array( 'left', 'top' ) );
	bt_add_image_size( 'portfolio-thumbnail-2-col', 470, 641 , array( 'left', 'top' ) );
	bt_add_image_size( 'portfolio-thumbnail-1-col', 970, 1000 , array( 'left', 'top' ) );
	bt_add_image_size( 'sponsors', 300, 9999); //207x180 pixels

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );
	
	// Enable shortcodes in widgets
	add_filter('widget_text', 'do_shortcode');
	
	// Register the available menus
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'cherry' ),
		'secondary' => __( 'Footer Navigation', 'cherry' )
	));
	
	if ( ! isset( $content_width ) ) $content_width = 900;

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'okthemes', PARENT_DIR . '/languages' );

	$locale = get_locale();
	$locale_file = PARENT_DIR . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );
		
	}
	endif;

/**
 * Sets the post excerpt length to 40 characters.
 */
if ( !function_exists( 'cherry_excerpt_length' ) ) {

function cherry_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'cherry_excerpt_length' );

}
/**
 * Returns a "Continue Reading" link for excerpts
 */

if ( !function_exists( 'cherry_continue_reading_link' ) ) {

function cherry_continue_reading_link() {
	return '<p><a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&#187;</span>', 'cherry' ) . '</a></p>';
}
}
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and cherry_continue_reading_link().
 */

if ( !function_exists( 'cherry_auto_excerpt_more' ) ) {

function cherry_auto_excerpt_more( $more ) {
	return ' &hellip;' . cherry_continue_reading_link();
}
add_filter( 'excerpt_more', 'cherry_auto_excerpt_more' );

}


/**
 * Removes inline styles printed when the gallery shortcode is used.
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Remove read more jump
 */

if ( !function_exists( 'remove_more_jump_link' ) ) {

function remove_more_jump_link($link) { 
	$offset = strpos($link, '#more-');
	if ($offset) {
	$end = strpos($link, '"',$offset);
	}
	if ($end) {
	$link = substr_replace($link, '', $offset, $end-$offset);
	}
	return $link;
	}
	add_filter('the_content_more_link', 'remove_more_jump_link');

}

/** Pagination */
function pagination($pages = '', $range = 4)
{  
     $showitems = ($range * 2)+1;  
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
 
     if(1 != $pages)
     {
         echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
         echo "</div>\n";
     }
}

// function to display number of posts.
function wpb_set_post_views($postID) {
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

// function to track views.
function wpb_track_post_views ($post_id) {
    if ( !is_single() ) return;
    if ( empty ( $post_id) ) {
        global $post;
        $post_id = $post->ID;    
    }
    wpb_set_post_views($post_id);
}
add_action( 'wp_head', 'wpb_track_post_views');

// function to get views.
function wpb_get_post_views($postID){
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count.'';
}

/** WP nav menu description */

class Description_Walker extends Walker_Nav_Menu {
    /**
     * Start the element output.
     *
     * @param  string $output Passed by reference. Used to append additional content.
     * @param  object $item   Menu item data object.
     * @param  int $depth     Depth of menu item. May be used for padding.
     * @param  array $args    Additional strings.
     * @return void
     */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

        $classes     = empty ( $item->classes ) ? array () : (array) $item->classes;

        $class_names = join(
            ' '
        ,   apply_filters(
                'nav_menu_css_class'
            ,   array_filter( $classes ), $item
            )
        );

        ! empty ( $class_names )
            and $class_names = ' class="'. esc_attr( $class_names ) . '"';

        $output .= "<li id='menu-item-$item->ID' $class_names>";

        $attributes  = '';

        ! empty( $item->attr_title )
            and $attributes .= ' title="'  . esc_attr( $item->attr_title ) .'"';
        ! empty( $item->target )
            and $attributes .= ' target="' . esc_attr( $item->target     ) .'"';
        ! empty( $item->xfn )
            and $attributes .= ' rel="'    . esc_attr( $item->xfn        ) .'"';
        ! empty( $item->url )
            and $attributes .= ' href="'   . esc_attr( $item->url        ) .'"';

        // insert description for top level elements only
        $description = ( ! empty ( $item->description ) and 0 == $depth )
            ? '<span class="nav_desc">' . esc_attr( $item->description ) . '</span>' : '';

        $title = apply_filters( 'the_title', $item->title, $item->ID );

        $item_output = $args->before
            . "<a $attributes>"
            . $args->link_before
            . $title
            . '</a> '
            . $args->link_after
            . $description
            . $args->after;

        // Since $output is called by reference we don't need to return anything.
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

/** Comment Styles */

if ( ! function_exists( 'st_comments' ) ) :
function st_comments($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
<div id="comment-<?php comment_ID(); ?>" class="single-comment clearfix">
    <div class="comment-author vcard"> <?php echo get_avatar($comment,$size='64'); ?></div>
    <div class="comment-meta commentmetadata">
            <?php if ($comment->comment_approved == '0') : ?>
            <em><?php _e('Comment is awaiting moderation','smpl');?></em> <br />
            <?php endif; ?>
            <h6><?php echo ''.get_comment_author_link(). '' ?></h6>
            <span class="comment-reply-link"><?php comment_reply_link(array_merge( $args, array('reply_text' => __('Reply','smpl'),'depth' => $depth, 'max_depth' => $args['max_depth']))); ?></span>
            <span class="comment-date"><?php echo ''. get_comment_date(). '' ?></span>
            <div class="clear"></div>
            <?php comment_text() ?>
    </div>
</div>
<!-- </li> -->
<?php  }
endif;

if ( ! function_exists( 'cherry_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since cherry 1.0
 */
function cherry_posted_on() {
	
	printf( __( '<div class="%1$s"><div class="%2$s">%4$s</div><div class="%3$s">%5$s</div></div>', 'cherry' ),
		'post-meta-holder','post-meta-holder-date','post-meta-holder-comments',
		sprintf( '<span class="gg_day">%1$s</span><span class="gg_month">%2$s</span><span class="gg_year">%3$s</span>',
			get_the_date('j'),
			get_the_date('M'),
			get_the_date('Y')
		),
		sprintf( '<span class="gg_comments">%2$s</span><span class="gg_views">%1$s</span>',
			wpb_get_post_views(get_the_ID()),
			get_comments_number()
		)
	);
}

endif;

if ( ! function_exists( 'cherry_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since cherry 1.0
 */
function cherry_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s.', 'cherry' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s.', 'cherry' );
	} 
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}

endif;

// Remove rel attribute from the category list
function remove_category_list_rel($output)
{
  $output = str_replace(' rel="category"', '', $output);
  return $output;
}
add_filter('wp_list_categories', 'remove_category_list_rel');
add_filter('the_category', 'remove_category_list_rel');

// Header Functions

// Hook to add content before header

if ( !function_exists( 'st_above_header' ) ) {

function st_above_header() {
    do_action('st_above_header');
}

} // endif

// Primary Header Function

if ( !function_exists( 'st_header' ) ) {

function st_header() {
  do_action('st_header');
}

}

// Opening #header div with flexible grid

if ( !function_exists( 'st_header_open' ) ) {
	function st_header_open() {
	  echo "<div id=\"header\" class=\"sixteen columns\">\n<div class=\"inner\">\n";
	}
} // endif

add_action('st_header','st_header_open', 1);


// Hookable theme option field to add content to header
if ( !function_exists( 'st_header_extras' ) ) {

function st_header_extras() {

}
} // endif

add_action('st_header','st_header_extras', 2);


// Build the logo
if ( !function_exists( 'st_logo' ) ) {

function st_logo() {
	// Displays H1 or DIV based on whether we are on the home page or not (SEO)
	$heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div';
	if (of_get_option('use_logo_image')) {
		$class="graphic";
	} else {
		$class="text"; 		
	}
	$st_logo  = '<div class="logo-wrap"><'.$heading_tag.' id="site-title" class="'.$class.'"><a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo('name','display')).'">'.get_bloginfo('name').'</a></'.$heading_tag.'>'. "\n";
	if (of_get_option('display_site_tagline')) {
	$st_logo .= '<span class="site-desc '.$class.'">'.get_bloginfo('description').'</span>'. "\n";
	}
	$st_logo .= '</div>';
	echo apply_filters ( 'child_logo' , $st_logo);
}
} // endif

add_action('st_header','st_logo', 3);

if ( !function_exists( 'logostyle' ) ) {

function logostyle() {
	if (of_get_option('use_logo_image')) {
	$logo768w = of_get_option('logo_width') / 1.2;
	$logo768h = of_get_option('logo_height') / 1.2;
	$logo480w = of_get_option('logo_width') / 1.6;	
	$logo480h = of_get_option('logo_height') / 1.6;		
	echo '<style type="text/css">
	#header #site-title.graphic a {
		background-image: url('.of_get_option('header_logo').');
		width: '.of_get_option('logo_width').'px;
		height: '.of_get_option('logo_height').'px; 
	}
	@media only screen and (min-width: 768px) and (max-width: 959px) {
		#header #site-title.graphic a {
			width: '.$logo768w.'px;
			height: '.$logo768h.'px; 
		}
	}
	@media only screen and (min-width: 480px) and (max-width: 767px) {
		#header #site-title.graphic a {
			width: '.$logo480w.'px;
			height: '.$logo480h.'px; 
		}
		
	}
	</style>';
	}
}

} //endif

add_action('wp_head', 'logostyle');

// Navigation (menu)
if ( !function_exists( 'st_navbar' ) ) {

function st_navbar() {
	echo '<div id="navigation" class="row twelve columns">';
	if ( has_nav_menu( 'primary' ) ) {
		wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary', 'walker' => new Description_Walker));
	}
	echo '</div><!--/#navigation-->';
}

} //endif
add_action('st_header','st_navbar', 4);

if ( !function_exists( 'st_header_close' ) ) {

function st_header_close() {
	echo "</div></div><!--/#header-->";
}
} //endif

add_action('st_header','st_header_close', 5);



// Hook to add content after header

if ( !function_exists( 'st_below_header' ) ) {

function st_below_header() {
    do_action('st_below_header');
}

} //endif


add_action( 'login_head', 'namespace_login_style' );
/**
 * Replaces the login header logo
 */
function namespace_login_style() {
	if (of_get_option('use_wp_admin_logo')) {
    echo '<style>.login h1 a { background-image: url( '.of_get_option('wp_admin_logo').' ) !important; background-size:auto; width:auto; height:auto; margin-bottom:15px; }</style>';
	}
}

// End Header Functions


// Before Content - st_before_content($columns);

if ( !function_exists( 'st_before_content' ) ) {

	function st_before_content($columns) {

	// Set the default
	
	if (empty($columns)) {
	$columns = 'twelve alpha add15pxmargin';
	} else {
	// Check the function for a returned variable
	$columns = $columns;
	}
	
	// Example of further conditionals:
	// (be sure to add the excess of 16 to st_before_sidebar as well)
	
	if (is_page_template('onecolumn-page.php')) {
	$columns = 'sixteen';
	}
	
	// check to see if bbpress is installed
	
	if ( class_exists( 'bbPress' ) ) {
	// force wide on bbPress pages
	if (is_bbpress()) {
	$columns = 'sixteen';
	}
	
	// unless it's the member profile
	if (bbp_is_user_home()) {
	$columns = 'twelve omega add15pxmargin';
	}
	
	} // bbPress

	// Apply the markup
	echo "<div id=\"content\" class=\"$columns columns\">";
	}
}


// After Content

if (! function_exists('st_after_content'))  {
    function st_after_content() {
    	echo "\t\t</div><!-- /.columns (#content) -->\n";
    }
}

// Page headline

if (! function_exists('st_page_headline'))  {
    function st_page_headline() {
    	// Apply the markup
		$page_headlines = rwmb_meta( 'gg_page_headline' );
		if (!is_front_page()) {
		
		if (of_get_option('header_breadcrumbs')=='yes') {	
		echo "<div class=\"page_headline_wrapper\"><div class=\"container\"><div class=\"page_headline sixteen columns\">";
		} else {
		echo "<div class=\"page_headline_wrapper add-bottom\"><div class=\"container\"><div class=\"page_headline sixteen columns\">";	
		}
		
		echo "<div class=\"twelve columns alpha add15pxmargin\">";
		

		if (is_archive() && !is_category()&& !is_tag()) {
			echo "<h1 class=\"page_headline_heading\">";	
				if ( is_day() ) : printf( __( 'Daily Archives: %s', 'cherry' ), get_the_date() );
				elseif ( is_month() ) : printf( __( 'Monthly Archives: %s', 'cherry' ), get_the_date('F Y') );
				elseif ( is_year() ) : printf( __( 'Yearly Archives: %s', 'cherry' ), get_the_date('Y') );
				endif;
			echo "</h1>";
		} elseif (is_category()) {
			echo "<h1 class=\"page_headline_heading\">";	
				printf( __( 'Category Archives: %s', 'cherry' ), single_cat_title( '', false ) );
			echo "</h1>";	
			$category_description = category_description();
			if ( ! empty( $category_description ) )	echo '<p>' . $category_description . '</p>';
		} elseif (is_search()) {
			echo "<h1 class=\"page_headline_heading\">";	
				printf( __( 'Search Results for: %s', 'cherry' ), '' . get_search_query() . '' );
			echo "</h1>";
		} elseif (is_404()) {
			echo "<h1 class=\"page_headline_heading\">";	
				_e( 'Not Found', 'cherry' );
			echo "</h1>";
		} elseif (is_tag()) {
			echo "<h1 class=\"page_headline_heading\">";	
				printf( __( 'Tag Archives: %s', 'cherry' ), '<span class="bolder">' . single_tag_title( '', false ) . '</span>' );
			echo "</h1>";			
		} else {
			if ( have_posts() ) while ( have_posts() ) : the_post();
				echo "<h1 class=\"page_headline_heading\">";
					the_title();
				echo "</h1>";
			endwhile;
		}
		
		if ($page_headlines) {
		if ( (!is_single()) || (!is_archive()) ) {
		foreach ( $page_headlines as $page_headline )
				{
					echo "<p class=\"page_headline_subtitle\">$page_headline</p>";
				}
		}}
				
		echo "</div>";
		
		if (of_get_option('header_search_form')=='yes') {
		
		echo '<div class="header_form four columns omega add15pxmargin"><form action="'.$_SERVER['PHP_SELF'].'" class="main-search" method="get">
        <input class="text_input" type="text" value="Search" name="s" id="s" />
        <input type="submit" class="submit-button" name="submit" value="Search"></form></div>';
		
		}
		
		if ( (has_post_thumbnail() && is_page())) {
			the_post_thumbnail('page-thumbnail');
		}
				
		echo "</div></div></div>";
		}
    }
}


// Before Sidebar - do_action('st_before_sidebar')

// call up the action
if ( !function_exists( 'before_sidebar' ) ) {
	
	function before_sidebar($columns) {
	if (empty($columns)) {
	// Set the default
	$columns = 'four omega add15pxmargin';
	} else {
	// Check the function for a returned variable
	$columns = $columns;
	}
	echo '<div id="sidebar" class="'.$columns.' columns" role="complementary">';
	}
} //endif
// create our hook
add_action( 'st_before_sidebar', 'before_sidebar');  

// After Sidebar
if ( !function_exists( 'after_sidebar' ) ) {
	function after_sidebar() {
	// Additional Content could be added here
	   echo '</div><!-- #sidebar -->';
	}
} //endif
add_action( 'st_after_sidebar', 'after_sidebar');  


// Before Footer
if (!function_exists('st_before_footer'))  {
    function st_before_footer() {
			echo "</div>"; //close main container
			echo '<div class="footer-wrapper-wide"><div class="container"><div id="footer" class="sixteen columns">';
    }
}

if ( !function_exists( 'st_footer' ) ) {

// The Footer
add_action('wp_footer', 'st_footer');
	do_action('st_footer');
	function st_footer() {
		
		//Retrieve and verify sidebars 
		global $footer_sidebar_1, $footer_sidebar_2, $footer_sidebar_3, $footer_sidebar_4, $sidebar_footer1_exists, $sidebar_footer2_exists, $sidebar_footer3_exists, $sidebar_footer4_exists;
		
		$footer_sidebar_1 = rwmb_meta('gg_first-footer-widget-area');
		$footer_sidebar_2 = rwmb_meta('gg_second-footer-widget-area');
		$footer_sidebar_3 = rwmb_meta('gg_third-footer-widget-area');
		$footer_sidebar_4 = rwmb_meta('gg_fourth-footer-widget-area');
		$sidebar_list = of_get_option('sidebar_list');
		
		if ($sidebar_list) : $sidebar_footer1_exists = in_array_r($footer_sidebar_1, $sidebar_list); else : $sidebar_footer1_exists = false; endif;
		if ($sidebar_list) : $sidebar_footer2_exists = in_array_r($footer_sidebar_2, $sidebar_list); else : $sidebar_footer2_exists = false; endif;
		if ($sidebar_list) : $sidebar_footer3_exists = in_array_r($footer_sidebar_3, $sidebar_list); else : $sidebar_footer3_exists = false; endif;
		if ($sidebar_list) : $sidebar_footer4_exists = in_array_r($footer_sidebar_4, $sidebar_list); else : $sidebar_footer4_exists = false; endif;
		
		get_sidebar("footer");
		

		// prints site credits
		echo '</div></div></div><div class="credits-wrapper-wide"><div class="container"><div id="credits" class="sixteen columns">';
		
		echo '<div class="twelve columns alpha add15pxmargin alignleft">';
		if ( has_nav_menu( 'secondary' ) ) {
			wp_nav_menu( array( 'container_class' => 'menu-footer', 'theme_location' => 'secondary'));
		}
		echo '</div>'; //close twelve columns
		
		echo '<div class="four columns omega add15pxmargin alignright">';
		if (of_get_option("footer_copyright")){
			echo '<p>'.of_get_option('footer_copyright').'</p>';
		}
		echo '</div>'; //close four columns
		
		echo '</div>'; //close #credits
}

}


// After Footer

if (!function_exists('st_after_footer'))  {
	
    function st_after_footer() {
			echo "</div>"; //close .container (before credits)
			echo "</div>"; //close .credits-wrapper-wide			
			echo "</div>"; //close .master-wrapper 
			
			// Get slideshows
			$slideshow = of_get_option('slideshow_select'); 
			
			// Classic slideshow
			if (($slideshow == "classic")) {
				echo '<script type="text/javascript">
				if(jQuery("#slider3").length > 0){
					jQuery(document).ready(function($) {
						$(function () {
							$("#slider3").responsiveSlides({
							auto: '.of_get_option('auto_animate','false').',
							pager: '.of_get_option('display_pager','false').',
							nav: '.of_get_option('display_navigation','true').',
							random: '.of_get_option('randomize_order','false').',
							speed: 1000,  
							namespace: "centered-btns"
						  });
						});
					});
				}
				</script>';
			}
			
			// Sequence slideshow
			if (($slideshow == "sequence")) {
				echo '<script type="text/javascript">
				if(jQuery("#sequence").length > 0){
					jQuery(document).ready(function($) {
						var options = {
							autoPlay: '.of_get_option('auto_animate','false').',
							nextButton: '.of_get_option('display_navigation','true').',
							prevButton: '.of_get_option('display_navigation','true').',
							animateStartingFrameIn: true,
							autoPlayDelay: 3000,
							preloader: true,
							pauseOnHover: false,
							preloadTheseFrames: [1]
						};
						
						var sequence = $("#sequence").sequence(options).data("sequence");
					
						sequence.afterLoaded = function(){
							$("#nav").fadeIn(100);
							$("#nav li:nth-child("+(sequence.settings.startingFrameID)+") img").addClass("active");
						}
					
						sequence.beforeNextFrameAnimatesIn = function(){
							$("#nav li:not(:nth-child("+(sequence.nextFrameID)+")) img").removeClass("active");
							$("#nav li:nth-child("+(sequence.nextFrameID)+") img").addClass("active");
						}
						
						$("#nav li").click(function(){
							$(this).children("img").removeClass("active").children("img").addClass("active");
							sequence.nextFrameID = $(this).index()+1;
							sequence.goTo(sequence.nextFrameID);
						});
					});
				}
				</script>';
			}
			
			// Camera slideshow
			if (($slideshow == "camera")) {
				echo '<script type="text/javascript">
				if(jQuery("#camera_wrap_1").length > 0){
					jQuery(document).ready(function($) {
						$(function(){
							$("#camera_wrap_1").camera({
								navigation: '.of_get_option('display_navigation','true').',
								pagination: '.of_get_option('display_pager','false').',
								autoAdvance: '.of_get_option('auto_animate','false').',
								fx: "'.of_get_option('camera_effect','random').'",
								thumbnails: '.of_get_option('camera_display_thumb_pager','false').',
								loader: "'.of_get_option('camera_loader','bar').'"
							});
						});
					});
				}
				</script>';
			}
			
			// Google Analytics
			if (of_get_option('footer_scripts') <> "" ) {
				echo '<script type="text/javascript">'.stripslashes(of_get_option('footer_scripts')).'</script>';
			}
			
			
    }
}


// Enable Shortcodes in excerpts and widgets
add_filter('widget_text', 'do_shortcode');
add_filter( 'the_excerpt', 'do_shortcode');
add_filter('get_the_excerpt', 'do_shortcode');


if (!function_exists('get_image_path'))  {
function get_image_path() {
	global $post;
	$id = get_post_thumbnail_id();
	// check to see if NextGen Gallery is present
	if(stripos($id,'ngg-') !== false && class_exists('nggdb')){
	$nggImage = nggdb::find_image(str_replace('ngg-','',$id));
	$thumbnail = array(
	$nggImage->imageURL,
	$nggImage->width,
	$nggImage->height
	);
	// otherwise, just get the wp thumbnail
	} else {
	$thumbnail = wp_get_attachment_image_src($id,'full', true);
	}
	$theimage = $thumbnail[0];
	return $theimage;
}
}


function in_array_r($needle, $haystack, $strict = true) {
	foreach ($haystack as $item) {
		if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
			return true;
		}
	}

	return false;
}

/**
 * Breadcrumbs
 */

function dimox_breadcrumbs() {
 
  $delimiter = ' &raquo;';
  $home = 'Home'; // text for the 'Home' link
  $before = '<li><span class="current">'; // tag before the current crumb
  $after = '</span></li>'; // tag after the current crumb
 
  if ( !is_home() && !is_front_page() || is_paged() ) {
    echo '<div class="breadcrumbs_wrapper_arrow"><div class="breadcrumbs_wrapper"><div class="container"><div id="crumbs" class="breadcrumbs sixteen columns"><ul>';
 
    global $post;
    $homeLink = home_url();
    echo '<li><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . '</li>';
 
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
 
    } elseif ( is_day() ) {
      echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . '</li>';
      echo '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . '</li>';
      echo $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . '</li>';
      echo $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->name . '</a> ' . $delimiter . '</li>';
        echo $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        echo '<li>'.get_category_parents($cat, TRUE, ' ' . $delimiter . ' ').'</li>';
        echo $before . get_the_title() . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);

      echo '<li><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . '</li>';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' </li>';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_search() ) {
      echo $before . 'Search results for "' . get_search_query() . '"' . $after;
 
    } elseif ( is_tag() ) {
      echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . 'Articles posted by ' . $userdata->display_name . $after;
 
    } elseif ( is_404() ) {
      echo $before . 'Error 404' . $after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo '<li>' . __('Page','cherry') . ' ' . get_query_var('paged') . '</li>';
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '</ul></div></div></div><div class="clear"></div><div class="container"><span class="bread_arrow"></span></div></div>';
 
  }
} // end dimox_breadcrumbs()

