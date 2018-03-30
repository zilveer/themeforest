<?php

/////////////////////////////////////
// Theme Setup
/////////////////////////////////////

if ( ! function_exists( 'mvp_setup' ) ) {
function mvp_setup(){
	load_theme_textdomain('mvp-text', get_template_directory() . '/languages');
	load_theme_textdomain('theia-post-slider', get_template_directory() . '/languages');
	load_theme_textdomain('framework_localize', get_template_directory() . '/languages');

	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );
}
}
add_action('after_setup_theme', 'mvp_setup');

/////////////////////////////////////
// Enqueue Javascript/CSS Files
/////////////////////////////////////

if ( ! function_exists( 'mvp_scripts_method' ) ) {
function mvp_scripts_method() {
	wp_register_script('iosslider', get_template_directory_uri() . '/js/jquery.iosslider.js', array('jquery'), '', true);
	wp_register_script('osage', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '', true);
	wp_register_script('infinitescroll', get_template_directory_uri() . '/js/jquery.infinitescroll.js', array('jquery'), '', true);
	wp_register_script('respond', get_template_directory_uri() . '/js/respond.min.js', array('jquery'), '', true);
	wp_register_script('retina', get_template_directory_uri() . '/js/retina.js', array('jquery'), '', true);
	wp_register_script('stickymojo', get_template_directory_uri() . '/js/stickyMojo.js', array('jquery'), '', true);
	wp_register_script('elastislide', get_template_directory_uri() . '/js/jquery.elastislide.js', array('jquery'), '', true);
	wp_register_script('flexslider', get_template_directory_uri() . '/js/jquery.flexslider.js', array('jquery'), '', true);

	wp_enqueue_script('iosslider');
	$mvp_sticky_sidebar = get_option('mvp_sticky_sidebar'); if ($mvp_sticky_sidebar == "true") { if (isset($mvp_sticky_sidebar)) {
	wp_enqueue_script('stickymojo');
	} }
	wp_enqueue_script('osage');
	wp_enqueue_script('infinitescroll');
	wp_enqueue_script('respond');
	wp_enqueue_script('retina');
	wp_enqueue_script('elastislide');
	wp_enqueue_script('flexslider');

	wp_enqueue_style( 'mvp-style', get_stylesheet_uri() );
	wp_enqueue_style( 'reset', get_template_directory_uri() . '/css/reset.css' );

	$mvp_respond = get_option('mvp_respond'); if ($mvp_respond == "true") { if (isset($mvp_respond)) {
	wp_enqueue_style( 'media-queries', get_template_directory_uri() . '/css/media-queries.css' );
	} }

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if (is_plugin_active('menufication/menufication.php')) {
	wp_enqueue_style( 'menufication', get_template_directory_uri() . '/css/menufication.css' );
	}


}
}
add_action('wp_enqueue_scripts', 'mvp_scripts_method');

/////////////////////////////////////
// Register Scores
/////////////////////////////////////

add_action( 'init', 'create_scores' );
function create_scores() {
	register_post_type( 'scoreboard',
		array(
			'labels' => array(
				'name' => __( 'Scores', 'mvp-text' ),
				'singular_name' => __( 'Score', 'mvp-text' )
			),
		'public' => true,
		'has_archive' => true,
		)
	);
}

add_action( 'init', 'scores_init' );
function scores_init() {
	// create a new taxonomy
	register_taxonomy(
		'scores_cat',
		'scoreboard',
		array(
			'label' => __( 'Score Categories', 'mvp-text' ),
			'rewrite' => array( 'slug' => 'scores' ),
			'hierarchical' => true,
			'query_var' => true
		)
	);
}

/////////////////////////////////////
// Add Scores Metabox
/////////////////////////////////////

$prefix = 'mvp_';

$meta_box = array(
    'id' => 'scores-box',
    'title' => 'Scores Info',
    'page' => 'scoreboard',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
		array(
            'name' => 'Score Status',
            'desc' => 'Enter score status (eg. "Fri 8:00pm" or "Final")',
            'id' => $prefix . 'status',
            'type' => 'text',
        ),
        array(
            'name' => 'Away Team Abbreviation',
            'desc' => 'Enter away team abbreviation (eg. "PHI")',
            'id' => $prefix . 'away_team',
            'type' => 'text',
        ),
        array(
            'name' => 'Home Team Abbreviation',
            'desc' => 'Enter home team abbreviation (eg. "PHI")',
            'id' => $prefix . 'home_team',
            'type' => 'text',
        ),
        array(
            'name' => 'Away Team Score',
            'desc' => 'Enter away team score (eg. "10")',
            'id' => $prefix . 'away_team_score',
            'type' => 'text',
	    'std' => ' 0'
        ),
	array(
            'name' => 'Home Team Score',
            'desc' => 'Enter home team score (eg. "10")',
            'id' => $prefix . 'home_team_score',
            'type' => 'text',
	    'std' => ' 0'
        ),
	array(
            'name' => 'Display Numerical Score?',
            'desc' => 'Check this box if you want to display the score',
            'id' => $prefix . 'show_score',
            'type' => 'checkbox'
        ),
	array(
            'name' => 'Link to post?',
            'desc' => 'Check this box if you want to the scoreboard item to link to the post',
            'id' => $prefix . 'link_post',
            'type' => 'checkbox'
        )
    )
);

add_action('admin_menu', 'scores_add_box');

// Add meta box
function scores_add_box() {
	global $meta_box;

	add_meta_box($meta_box['id'], $meta_box['title'], 'scores_show_box', $meta_box['page'], $meta_box['context'], $meta_box['priority']);
}

// Callback function to show fields in meta box
function scores_show_box() {
	global $meta_box, $post;

	// Use nonce for verification
	echo '<input type="hidden" name="scores_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

	echo '<table class="form-table">';

	foreach ($meta_box['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);

		echo '<tr>',
				'<th style="width:20%"><label for="', $field['id'], '"><strong>', $field['name'], ':</strong></label></th>',
				'<td>';
		switch ($field['type']) {
			case 'text':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />',
					'<br /><small>', $field['desc'],'</small>';
				break;
			case 'textarea':
				echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>',
					'<br />', $field['desc'];
				break;
			case 'select':
				echo '<select name="', $field['id'], '" id="', $field['id'], '">';
				foreach ($field['options'] as $option) {
					echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
				}
				echo '</select>';
				break;
			case 'radio':
				foreach ($field['options'] as $option) {
					echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
				}
				break;
			case 'checkbox':
				echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
				break;
		}
		echo 	'<td>',
			'</tr>';
	}

	echo '</table>';
}

add_action('save_post', 'scores_save_data');

// Save data from meta box
function scores_save_data($post_id) {
	global $meta_box;

	// verify nonce
	if ( !isset( $_POST['scores_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['scores_meta_box_nonce'], basename(__FILE__) ) ) {
		return $post_id;
	}

	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}

	// check permissions
	if (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}

	foreach ($meta_box['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = isset( $_POST[$field['id']] ) ? $_POST[$field['id']] : '';

		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}

/////////////////////////////////////
// Theme Options
/////////////////////////////////////

require_once(TEMPLATEPATH . '/admin/admin-functions.php');
require_once(TEMPLATEPATH . '/admin/admin-interface.php');
require_once(TEMPLATEPATH . '/admin/theme-settings.php');

if ( ! function_exists( 'my_wp_head' ) ) {
function my_wp_head() {
	$wallad = get_option('mvp_wall_ad');
	$primarytheme = get_option('mvp_primary_theme');
	$heading = get_option('mvp_heading_color');
	$mainmenu = get_option('mvp_menu_color');
	$menutext = get_option('mvp_menu_text');
	$link = get_option('mvp_link_color');
	$linkhover = get_option('mvp_link_hover');
	$slider_headline = get_option('mvp_slider_headline');
	$menu_font = get_option('mvp_menu_font');
	$headline_font = get_option('mvp_headline_font');
	$google_slider = preg_replace("/ /","+",$slider_headline);
	$google_menu = preg_replace("/ /","+",$menu_font);
	$google_headlines = preg_replace("/ /","+",$headline_font);
	echo "
<style type='text/css'>

@import url(//fonts.googleapis.com/css?family=$google_slider:100,200,300,400,500,600,700,800,900|$google_menu:100,200,300,400,500,600,700,800,900|$google_headlines:100,200,300,400,500,600,700,800,900|Acme:400|Oswald:400,700|Open+Sans:400,700,800&subset=latin,latin-ext,cyrillic,cyrillic-ext,greek-ext,greek,vietnamese);

a, a:visited {
	color: $link;
	}

a:hover,
h2 a:hover,
#sidebar-wrapper .sidebar-list-text p a:hover,
#footer-widget-wrapper .sidebar-list-text p a:hover,
#footer-nav .menu li a:hover {
	color: $linkhover;
	}

#wallpaper {
	background: url($wallad) no-repeat 50% 0;
	}

#info-wrapper,
span.post-header,
h4.widget-header,
h4.sidebar-header,
h1.cat-title,
span.post-header {
	background: $heading;
	}

span.home-header-wrap h4.widget-header:after,
span.sidebar-header-wrap h4.sidebar-header:after,
h4.post-header span.post-header:after,
span.cat-title-contain h1.cat-title:after {
	border-color: transparent transparent transparent $heading;
	}

span.home-header-wrap,
span.sidebar-header-wrap,
h4.post-header,
span.cat-title-contain {
	border-bottom: 1px solid $heading;
	}

#social-sites-wrapper ul li,
nav .menu li:hover ul li a:hover,
h3.post-cat,
.woocommerce span.onsale,
.woocommerce-page span.onsale,
span.post-tags-header,
.post-tags a:hover,
span.post-tags-header,
.post-tags a:hover,
.tag-cloud a:hover,
 .woocommerce .widget_price_filter .ui-slider .ui-slider-range {
	background: $primarytheme;
	}

.woocommerce .widget_price_filter .ui-slider .ui-slider-handle {
	background-color: $primarytheme;
	}

.headlines-list h3,
nav .menu li:hover a,
h1.cat-heading,
.blog-layout1-text h3,
.blog-layout2-text h3 {
	color: $primarytheme;
	}

#nav-wrapper,
#search-bar {
	background: $mainmenu;
	}

nav .menu li a {
	color: $menutext;
	}

h2.featured-headline,
h2.standard-headline,
#content-area h1,
#content-area h2,
#content-area h3,
#content-area h4,
#content-area h5,
#content-area h6 {
	font-family: '$slider_headline', sans-serif;
	}

nav .menu li a {
	font-family: '$menu_font', sans-serif;
	}

.headlines-main-text h2 a,
#sidebar-wrapper .sidebar-list-text p a,
#footer-widget-wrapper .sidebar-list-text p a,
.blog-layout1-text h2 a,
.blog-layout2-text h2 a,
h1.story-title,
.related-text a,
.prev-post a,
.next-post a,
#woo-content h1.page-title,
#woo-content h1,
#woo-content h2,
#woo-content h3,
#woo-content h4,
#woo-content h5,
#woo-content h6,
h2.widget-feat-headline,
h2.widget-stand-headline {
	font-family: '$headline_font', sans-serif;
	}

#menufication-outer-wrap.menufication-transition-in #menufication-scroll-container {
	overflow-y: auto !important;
	}

</style>
	";
}
}
add_action( 'wp_head', 'my_wp_head' );

/////////////////////////////////////
// Register Widgets
/////////////////////////////////////

if ( !function_exists( 'mvp_sidebars_init' ) ) {
	function mvp_sidebars_init() {
		register_sidebar(array(
			'id' => 'homepage-widget',
			'name' => 'Homepage Widget Area',
			'before_widget' => '<div id="%1$s" class="widget-home-wrapper %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<span class="home-header-wrap"><h4 class="widget-header">',
			'after_title' => '</h3></span>',
		));

		register_sidebar(array(
			'id' => 'sidebar-home-widget',
			'name' => 'Sidebar Home Widget Area',
			'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<span class="sidebar-header-wrap"><h4 class="sidebar-header">',
			'after_title' => '</h3></span>',
		));

		register_sidebar(array(
			'id' => 'sidebar-widget',
			'name' => 'Sidebar Widget Area',
			'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<span class="sidebar-header-wrap"><h4 class="sidebar-header">',
			'after_title' => '</h3></span>',
		));

		register_sidebar(array(
			'id' => 'footer-widget',
			'name' => 'Footer Widget Area',
			'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="footer-widget-header">',
			'after_title' => '</h4>',
		));

		register_sidebar(array(
			'id' => 'sidebar-woo-widget',
			'name' => 'WooCommerce Sidebar Widget Area',
			'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<span class="sidebar-header-wrap"><h4 class="sidebar-header">',
			'after_title' => '</h3></span>',
		));

	}
}
add_action( 'widgets_init', 'mvp_sidebars_init' );

include("widgets/widget-ad.php");
include("widgets/widget-catlist.php");
include("widgets/widget-facebook.php");
include("widgets/widget-featured.php");
include("widgets/widget-gallery.php");
include("widgets/widget-headlines.php");
include("widgets/widget-sidecat.php");
include("widgets/widget-tags.php");

/////////////////////////////////////
// Register Custom Menus
/////////////////////////////////////

if ( !function_exists( 'register_menus' ) ) {
function register_menus() {
	register_nav_menus(
		array(
			'main-menu' => __( 'Main Menu', 'mvp-text' ),
			'footer-menu' => __( 'Footer Menu', 'mvp-text' ),)
	  	);
	  }
}
add_action( 'init', 'register_menus' );


class select_menu_walker extends Walker_Nav_Menu{

	 function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "";
	}


	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "";
	}

	 function start_el( &$output, $object, $depth = 0, $args = array(), $current_object_id = 0 ) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $object->classes ) ? array() : (array) $object->classes;
		$classes[] = 'menu-item-' . $object->ID;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $object->ID, $object, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

		$attributes  = ! empty( $object->attr_title ) ? ' title="'  . esc_attr( $object->attr_title ) .'"' : '';
		$attributes .= ! empty( $object->target )     ? ' target="' . esc_attr( $object->target     ) .'"' : '';
		$attributes .= ! empty( $object->xfn )        ? ' rel="'    . esc_attr( $object->xfn        ) .'"' : '';
		$attributes .= ! empty( $object->url )        ? ' href="'   . esc_attr( $object->url        ) .'"' : '';

		$sel_val =  ' value="'   . esc_attr( $object->url        ) .'"';

		//check if the menu is a submenu
		switch ($depth){
		  case 0:
			   $dp = "";
			   break;
		  case 1:
			   $dp = "-";
			   break;
		  case 2:
			   $dp = "--";
			   break;
		  case 3:
			   $dp = "---";
			   break;
		  case 4:
			   $dp = "----";
			   break;
		  default:
			   $dp = "";
		}

		$output .= $indent . '<option'. $sel_val . $id . $value . '>'.$dp;

		$item_output = $args->before;
		//$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $object->title, $object->ID ) . $args->link_after;
		//$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $object, $depth, $args );
	}

	function end_el( &$output, $object, $depth = 0, $args = array() ) {
		$output .= "</option>\n";
	}

}

/////////////////////////////////////
// Register Custom Background
/////////////////////////////////////

$custombg = array(
	'default-color' => 'f5f5f5',
);
add_theme_support( 'custom-background', $custombg );

/////////////////////////////////////
// Register Thumbnails
/////////////////////////////////////

if ( function_exists( 'add_theme_support' ) ) {
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 1000, 600, true );
add_image_size( 'post-thumb', 660, 400, true );
add_image_size( 'medium-thumb', 360, 220, true );
add_image_size( 'small-thumb', 150, 90, true );
}

/////////////////////////////////////
// Title Meta Data
/////////////////////////////////////

add_theme_support( 'title-tag' );

function mvp_filter_home_title(){
if ( ( is_home() && ! is_front_page() ) || ( ! is_home() && is_front_page() ) ) {
    $mvpHomeTitle = get_bloginfo( 'name', 'display' );
    $mvpHomeDesc = get_bloginfo( 'description', 'display' );
    return $mvpHomeTitle . " - " . $mvpHomeDesc;
}
}
add_filter( 'pre_get_document_title', 'mvp_filter_home_title');

/////////////////////////////////////
// Add Custom Meta Box
/////////////////////////////////////

/* Fire our meta box setup function on the post editor screen. */
add_action( 'load-post.php', 'mvp_post_meta_boxes_setup' );
add_action( 'load-post-new.php', 'mvp_post_meta_boxes_setup' );

/* Meta box setup function. */
if ( !function_exists( 'mvp_post_meta_boxes_setup' ) ) {
function mvp_post_meta_boxes_setup() {

	/* Add meta boxes on the 'add_meta_boxes' hook. */
	add_action( 'add_meta_boxes', 'mvp_add_post_meta_boxes' );

	/* Save post meta on the 'save_post' hook. */
	add_action( 'save_post', 'mvp_save_video_embed_meta', 10, 2 );
	add_action( 'save_post', 'mvp_save_featured_headline_meta', 10, 2 );
	add_action( 'save_post', 'mvp_save_photo_credit_meta', 10, 2 );
	add_action( 'save_post', 'mvp_save_featured_image_meta', 10, 2 );
	add_action( 'save_post', 'mvp_save_post_template_meta', 10, 2 );
}
}

/* Create one or more meta boxes to be displayed on the post editor screen. */
if ( !function_exists( 'mvp_add_post_meta_boxes' ) ) {
function mvp_add_post_meta_boxes() {

	add_meta_box(
		'mvp-video-embed',			// Unique ID
		esc_html__( 'Video/Audio Embed', 'mvp-text' ),		// Title
		'mvp_video_embed_meta_box',		// Callback function
		'post',					// Admin page (or post type)
		'normal',				// Context
		'high'					// Priority
	);

	add_meta_box(
		'mvp-featured-headline',			// Unique ID
		esc_html__( 'Featured Headline', 'mvp-text' ),		// Title
		'mvp_featured_headline_meta_box',		// Callback function
		'post',					// Admin page (or post type)
		'normal',				// Context
		'high'					// Priority
	);

	add_meta_box(
		'mvp-photo-credit',			// Unique ID
		esc_html__( 'Photo Credit', 'mvp-text' ),		// Title
		'mvp_photo_credit_meta_box',		// Callback function
		'post',					// Admin page (or post type)
		'normal',				// Context
		'high'					// Priority
	);

	add_meta_box(
		'mvp-post-template',			// Unique ID
		esc_html__( 'Post Template', 'mvp-text' ),		// Title
		'mvp_post_template_meta_box',		// Callback function
		'post',					// Admin page (or post type)
		'side',					// Context
		'core'					// Priority
	);

	add_meta_box(
		'mvp-featured-image',			// Unique ID
		esc_html__( 'Featured Image Show/Hide', 'mvp-text' ),		// Title
		'mvp_featured_image_meta_box',		// Callback function
		'post',					// Admin page (or post type)
		'side',					// Context
		'core'					// Priority
	);

}
}

/* Display the post meta box. */
if ( !function_exists( 'mvp_featured_headline_meta_box' ) ) {
function mvp_featured_headline_meta_box( $object, $box ) { ?>

	<?php wp_nonce_field( basename( __FILE__ ), 'mvp_featured_headline_nonce' ); ?>

	<p>
		<label for="mvp-featured-headline"><?php _e( "Add a custom featured headline that will be displayed in the featured slider.", 'example' ); ?></label>
		<br />
		<input class="widefat" type="text" name="mvp-featured-headline" id="mvp-featured-headline" value="<?php echo esc_html__( get_post_meta( $object->ID, 'mvp_featured_headline', true ) ); ?>" size="30" />
	</p>

<?php }
}

/* Display the post meta box. */
if ( !function_exists( 'mvp_video_embed_meta_box' ) ) {
function mvp_video_embed_meta_box( $object, $box ) { ?>

	<?php wp_nonce_field( basename( __FILE__ ), 'mvp_video_embed_nonce' ); ?>

	<p>
		<label for="mvp-video-embed"><?php _e( "Enter your video or audio embed code.", 'mvp-text' ); ?></label>
		<br />
		<textarea class="widefat" name="mvp-video-embed" id="mvp-video-embed" cols="50" rows="5"><?php echo esc_html__( get_post_meta( $object->ID, 'mvp_video_embed', true ) ); ?></textarea>
	</p>

<?php }
}

/* Display the post meta box. */
if ( !function_exists( 'mvp_photo_credit_meta_box' ) ) {
function mvp_photo_credit_meta_box( $object, $box ) { ?>

	<?php wp_nonce_field( basename( __FILE__ ), 'mvp_photo_credit_nonce' ); ?>

	<p>
		<label for="mvp-photo-credit"><?php _e( "Add a photo credit for the featured image.", 'mvp-text' ); ?></label>
		<br />
		<input class="widefat" type="text" name="mvp-photo-credit" id="mvp-photo-credit" value="<?php echo esc_html__( get_post_meta( $object->ID, 'mvp_photo_credit', true ) ); ?>" size="30" />
	</p>

<?php }
}
/* Display the post meta box. */
if ( !function_exists( 'mvp_post_template_meta_box' ) ) {
function mvp_post_template_meta_box( $object, $box ) { ?>

	<?php wp_nonce_field( basename( __FILE__ ), 'mvp_post_template_nonce' ); $selected = esc_html__( get_post_meta( $object->ID, 'mvp_post_template', true ) ); ?>

	<p>
		<label for="mvp-post-template"><?php _e( "Select from the default post template or a full-width template.", 'mvp-text' ); ?></label>
		<br /><br />
		<select class="widefat" name="mvp-post-template" id="mvp-post-template">
            		<option value="default" <?php selected( $selected, 'default' ); ?>>Default</option>
            		<option value="fullwidth" <?php selected( $selected, 'fullwidth' ); ?>>Full-width</option>
        	</select>
	</p>
<?php }
}

/* Display the post meta box. */
if ( !function_exists( 'mvp_featured_image_meta_box' ) ) {
function mvp_featured_image_meta_box( $object, $box ) { ?>

	<?php wp_nonce_field( basename( __FILE__ ), 'mvp_featured_image_nonce' ); $selected = esc_html__( get_post_meta( $object->ID, 'mvp_featured_image', true ) ); ?>

	<p>
		<label for="mvp-featured-image"><?php _e( "Select to show or hide the featured image from automatically displaying in this post.", 'mvp-text' ); ?></label>
		<br /><br />
		<select class="widefat" name="mvp-featured-image" id="mvp-featured-image">
            		<option value="show" <?php selected( $selected, 'show' ); ?>>Show</option>
            		<option value="hide" <?php selected( $selected, 'hide' ); ?>>Hide</option>
        	</select>
	</p>
<?php }
}

/* Save the meta box's post metadata. */
if ( !function_exists( 'mvp_save_video_embed_meta' ) ) {
function mvp_save_video_embed_meta( $post_id, $post ) {

	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['mvp_video_embed_nonce'] ) || !wp_verify_nonce( $_POST['mvp_video_embed_nonce'], basename( __FILE__ ) ) )
		return $post_id;

	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );

	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	/* Get the posted data and sanitize it for use as an HTML class. */
	$new_meta_value = ( isset( $_POST['mvp-video-embed'] ) ? balanceTags( $_POST['mvp-video-embed'] ) : '' );

	/* Get the meta key. */
	$meta_key = 'mvp_video_embed';

	/* Get the meta value of the custom field key. */
	$meta_value = get_post_meta( $post_id, $meta_key, true );

	/* If a new meta value was added and there was no previous value, add it. */
	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );

	/* If the new meta value does not match the old value, update it. */
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );

	/* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );
} }

/* Save the meta box's post metadata. */
if ( !function_exists( 'mvp_save_featured_headline_meta' ) ) {
function mvp_save_featured_headline_meta( $post_id, $post ) {

	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['mvp_featured_headline_nonce'] ) || !wp_verify_nonce( $_POST['mvp_featured_headline_nonce'], basename( __FILE__ ) ) )
		return $post_id;

	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );

	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	/* Get the posted data and sanitize it for use as an HTML class. */
	$new_meta_value = ( isset( $_POST['mvp-featured-headline'] ) ? balanceTags( $_POST['mvp-featured-headline'] ) : '' );

	/* Get the meta key. */
	$meta_key = 'mvp_featured_headline';

	/* Get the meta value of the custom field key. */
	$meta_value = get_post_meta( $post_id, $meta_key, true );

	/* If a new meta value was added and there was no previous value, add it. */
	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );

	/* If the new meta value does not match the old value, update it. */
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );

	/* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );
} }

/* Save the meta box's post metadata. */
if ( !function_exists( 'mvp_save_photo_credit_meta' ) ) {
function mvp_save_photo_credit_meta( $post_id, $post ) {

	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['mvp_photo_credit_nonce'] ) || !wp_verify_nonce( $_POST['mvp_photo_credit_nonce'], basename( __FILE__ ) ) )
		return $post_id;

	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );

	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	/* Get the posted data and sanitize it for use as an HTML class. */
	$new_meta_value = ( isset( $_POST['mvp-photo-credit'] ) ? balanceTags( $_POST['mvp-photo-credit'] ) : '' );

	/* Get the meta key. */
	$meta_key = 'mvp_photo_credit';

	/* Get the meta value of the custom field key. */
	$meta_value = get_post_meta( $post_id, $meta_key, true );

	/* If a new meta value was added and there was no previous value, add it. */
	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );

	/* If the new meta value does not match the old value, update it. */
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );

	/* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );
} }

/* Save the meta box's post metadata. */
if ( !function_exists( 'mvp_save_post_template_meta' ) ) {
function mvp_save_post_template_meta( $post_id, $post ) {

	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['mvp_post_template_nonce'] ) || !wp_verify_nonce( $_POST['mvp_post_template_nonce'], basename( __FILE__ ) ) )
		return $post_id;

	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );

	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	/* Get the posted data and sanitize it for use as an HTML class. */
	$new_meta_value = ( isset( $_POST['mvp-post-template'] ) ? balanceTags( $_POST['mvp-post-template'] ) : '' );

	/* Get the meta key. */
	$meta_key = 'mvp_post_template';

	/* Get the meta value of the custom field key. */
	$meta_value = get_post_meta( $post_id, $meta_key, true );

	/* If a new meta value was added and there was no previous value, add it. */
	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );

	/* If the new meta value does not match the old value, update it. */
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );

	/* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );
} }

/* Save the meta box's post metadata. */
if ( !function_exists( 'mvp_save_featured_image_meta' ) ) {
function mvp_save_featured_image_meta( $post_id, $post ) {

	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['mvp_featured_image_nonce'] ) || !wp_verify_nonce( $_POST['mvp_featured_image_nonce'], basename( __FILE__ ) ) )
		return $post_id;

	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );

	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	/* Get the posted data and sanitize it for use as an HTML class. */
	$new_meta_value = ( isset( $_POST['mvp-featured-image'] ) ? balanceTags( $_POST['mvp-featured-image'] ) : '' );

	/* Get the meta key. */
	$meta_key = 'mvp_featured_image';

	/* Get the meta value of the custom field key. */
	$meta_value = get_post_meta( $post_id, $meta_key, true );

	/* If a new meta value was added and there was no previous value, add it. */
	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );

	/* If the new meta value does not match the old value, update it. */
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );

	/* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );
} }

/////////////////////////////////////
// Add Content Limit
/////////////////////////////////////

if ( !function_exists( 'excerpt' ) ) {
function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}
}

if ( !function_exists( 'content' ) ) {
function content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  }
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content);
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}
}

/////////////////////////////////////
// Social Shares
/////////////////////////////////////

if (!function_exists('get_fb')) {
function get_fb( $post_id ) {

	// Check for transient
	if ( ! ( $count = get_transient( 'get_fb' . $post_id ) ) ) {

    // Do API call
    $response = wp_remote_retrieve_body( wp_remote_get( 'http://api.facebook.com/restserver.php?method=links.getStats&format=json&urls=' . urlencode( get_permalink( $post_id ) ), array(

		'sslverify' => false,
		'compress' => true,
		'timeout' => 5

	) ) );

    // If error in API call, stop and don't store transient
    if ( is_wp_error( $response ) )
      return 'error';

    // Decode JSON
    $json = json_decode( $response, true );

    // Set total count
    if(isset($json[0])){
    $count = absint( $json[0]['total_count'] );
	} else { }

	// Set transient to expire every 30 minutes
	set_transient( 'get_fb' . $post_id, absint( $count ), 30 * MINUTE_IN_SECONDS );
 
	}

 return absint( $count );
} }

if (!function_exists('get_plusones')) {
function get_plusones( $post_id )  {

	// Check for transient
	if ( ! ( $count = get_transient( 'get_plusones' . $post_id ) ) ) {

   $args = array(
            'method' => 'POST',
            'headers' => array(
                // setup content type to JSON
                'Content-Type' => 'application/json'
            ),
            // setup POST options to Google API
            'body' => json_encode(array(
                'method' => 'pos.plusones.get',
                'id' => 'p',
                'method' => 'pos.plusones.get',
                'jsonrpc' => '2.0',
                'key' => 'p',
                'apiVersion' => 'v1',
                'params' => array(
                    'nolog'=>true,
                    'id'=> get_permalink( $post_id ),
                    'source'=>'widget',
                    'userId'=>'@viewer',
                    'groupId'=>'@self'
                )
             )),
             // disable checking SSL certificates
		'compress' => true,
            	'sslverify'=>false,
		'timeout' => 5
        );

    // retrieves JSON with HTTP POST method for current URL
    $json_string = wp_remote_post("https://clients6.google.com/rpc", $args);

    if (is_wp_error($json_string)){
        // return zero if response is error
        return "0";
    } else {
        $json = json_decode($json_string['body'], true);
        // return count of Google +1 for requsted URL
        $count = intval( $json['result']['metadata']['globalCounts']['count'] );
    }

	// Set transient to expire every 30 minutes
	set_transient( 'get_plusones' . $post_id, absint( $count ), 30 * MINUTE_IN_SECONDS );
 
	}

 return absint( $count );
} }

if (!function_exists('get_pinterest')) {
function get_pinterest( $post_id ) {

	// Check for transient
	if ( ! ( $count = get_transient( 'get_pinterest' . $post_id ) ) ) {

    // Do API call
    $response = wp_remote_retrieve_body( wp_remote_get( 'http://api.pinterest.com/v1/urls/count.json?url=' . urlencode( get_permalink( $post_id ) ), array(

		'sslverify' => false,
		'compress' => true,
		'timeout' => 5

	) ) );

    // If error in API call, stop and don't store transient
    if ( is_wp_error( $response ) )
      return 'error';
	$json_string = preg_replace('/^receiveCount\((.*)\)$/', "\\1", $response);
    // Decode JSON
    $json = json_decode( $json_string );

    // Set total count
    $count = absint( $json->count );

	// Set transient to expire every 30 minutes
	set_transient( 'get_pinterest' . $post_id, absint( $count ), 30 * MINUTE_IN_SECONDS );
 
	}

 return absint( $count );
} }

if (!function_exists('mvp_share_count')) {
function mvp_share_count() {

	$post_id = get_the_ID(); ?>

<?php $soc_tot = get_fb( $post_id ) + get_plusones( $post_id ) + get_pinterest( $post_id ); if ($soc_tot > 999999999) {
		$soc_format = number_format($soc_tot / 1000000000, 1) . 'B';
	} else if ($soc_tot > 999999) {
		$soc_format = number_format($soc_tot / 1000000, 1) . 'M';
	} else if ($soc_tot > 999) {
        	$soc_format = number_format($soc_tot / 1000, 1) . 'K';
	} else {
		$soc_format = $soc_tot;
   	}
?>
	<div class="share-count">
	<?php if($soc_format==0) { ?><?php } elseif($soc_format==1) { ?><span class="social-count-num"><?php echo $soc_format; ?></span><span class="social-count-text"><?php _e( 'share', 'mvp-text' ); ?></span><?php } else { ?><span class="social-count"><span class="social-count-num"><?php echo $soc_format; ?></span> <span class="social-count-text"><?php _e( 'shares', 'mvp-text' ); ?></span><?php } ?>
	</div><!--share-count-->

<?php } }

/////////////////////////////////////
// Comments
/////////////////////////////////////

if ( !function_exists( 'mvp_comment' ) ) {
function mvp_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">


		<div class="comment-wrapper" id="comment-<?php comment_ID(); ?>">
			<div class="comment-inner">

				<div class="comment-avatar">
					<?php echo get_avatar( $comment, 46 ); ?>
				</div>

				<div class="commentmeta">
					<p class="comment-meta-1">
						<?php printf( __( '%s ', 'mvp-text'), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
					</p>
					<p class="comment-meta-2">
						<?php echo get_comment_date(); ?> <?php _e( 'at', 'mvp-text'); ?> <?php echo get_comment_time(); ?>
						<?php edit_comment_link( __( 'Edit', 'mvp-text'), '(' , ')'); ?>
					</p>

				</div>

				<div class="text">

					<?php if ( $comment->comment_approved == '0' ) : ?>
						<p class="waiting_approval"><?php _e( 'Your comment is awaiting moderation.', 'mvp-text' ); ?></p>
					<?php endif; ?>

					<div class="c">
						<?php comment_text(); ?>
					</div>

				</div><!-- .text  -->
				<div class="clear"></div>
				<div class="comment-reply"><span class="reply"><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></span></div>
			</div><!-- comment-inner  -->
		</div><!-- comment-wrapper  -->
	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'mvp-text' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'mvp-text' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
}

/////////////////////////////////////
// Popular Posts
/////////////////////////////////////

if ( !function_exists( 'popularPosts' ) ) {
function popularPosts($num) {
    global $wpdb;

    $posts = $wpdb->get_results("SELECT comment_count, ID, post_title FROM $wpdb->posts ORDER BY comment_count DESC LIMIT 0 , $num");

    foreach ($posts as $post) {
        setup_postdata($post);
        $id = $post->ID;
        $title = $post->post_title;
        $count = $post->comment_count;

        if ($count != 0) {
            $popular .= '<li>';
            $popular .= '<a href="' . get_permalink($id) . '" title="' . $title . '">' . $title . '</a> ';
            $popular .= '</li>';
        }
    }
    return $popular;
}
}

/////////////////////////////////////
// Related Posts
/////////////////////////////////////

if ( !function_exists( 'getRelatedPosts' ) ) {
function getRelatedPosts( $count=3) {
    global $post;
    $orig_post = $post;

    $tags = wp_get_post_tags($post->ID);
    if ($tags) {

	$slider_exclude = get_option('mvp_slider_tags');
	$tag_exclude_slider = get_term_by('slug', $slider_exclude, 'post_tag');
	$tag_id_exclude_slider =  $tag_exclude_slider->term_id;

	$feat_post_exclude = get_option('mvp_feat_post_tags');
	$tag_exclude_feat_post = get_term_by('slug', $feat_post_exclude, 'post_tag');
	$tag_id_exclude_feat_post =  $tag_exclude_feat_post->term_id;

        $tag_ids = array();
        foreach($tags as $individual_tag) {
		$excluded_tags = array($tag_id_exclude_slider,$tag_id_exclude_feat_post);
      		if (in_array($individual_tag->term_id,$excluded_tags)) continue;
 		$tag_ids[] = $individual_tag->term_id;
	}
        $args=array(
            'tag__in' => $tag_ids,
	    'order' => 'DESC',
	    'orderby' => 'date',
            'post__not_in' => array($post->ID),
            'posts_per_page'=> $count, // Number of related posts that will be shown.
            'ignore_sticky_posts'=>1
        );
        $my_query = new WP_Query( $args );
        if( $my_query->have_posts() ) { ?>
            <div id="related-posts"  class="post-section">
		<h4 class="post-header"><span class="post-header"><?php _e( 'Recommended for you', 'mvp-text' ); ?></span></h4>
			<ul>
            		<?php while( $my_query->have_posts() ) { $my_query->the_post(); ?>
            			<li>
                		<div class="related-image">
					<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_post_thumbnail('medium-thumb'); ?></a>
					<?php } ?>
				</div><!--related-image-->
				<div class="related-text">
					<a href="<?php the_permalink() ?>" class="main-headline"><?php the_title(); ?></a>
				</div><!--related-text-->
            			</li>
            		<?php }
            echo '</ul></div>';
        }
    }
    $post = $orig_post;
    wp_reset_query();
}
}

/////////////////////////////////////
// Pagination
/////////////////////////////////////

if ( !function_exists( 'pagination' ) ) {
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
}

/////////////////////////////////////
// Add/Remove User Contact Info
/////////////////////////////////////

if ( !function_exists( 'new_contactmethods' ) ) {
function new_contactmethods( $contactmethods ) {
    $contactmethods['facebook'] = 'Facebook'; // Add Facebook
    $contactmethods['twitter'] = 'Twitter'; // Add Twitter
    $contactmethods['pinterest'] = 'Pinterest'; // Add Pinterest
    $contactmethods['googleplus'] = 'Google Plus'; // Add Google Plus
    $contactmethods['instagram'] = 'Instagram'; // Add Instagram
    $contactmethods['linkedin'] = 'LinkedIn'; // Add LinkedIn
    unset($contactmethods['yim']); // Remove YIM
    unset($contactmethods['aim']); // Remove AIM
    unset($contactmethods['jabber']); // Remove Jabber

    return $contactmethods;
}
}
add_filter('user_contactmethods','new_contactmethods',10,1);

/////////////////////////////////////
// Footer Javascript
/////////////////////////////////////

if ( !function_exists( 'mvp_wp_footer' ) ) {
function mvp_wp_footer() {

?>

<?php $mvp_infinite_scroll = get_option('mvp_infinite_scroll'); if ($mvp_infinite_scroll == "true") { if (isset($mvp_infinite_scroll)) { ?>
<script type="text/javascript">
//<![CDATA[
jQuery(document).ready(function($) {
"use strict";
$('.infinite-content').infinitescroll({
	navSelector: ".nav-links",
	nextSelector: ".nav-links a:first",
	itemSelector: ".infinite-post",
	loading: {
		msgText: "<?php _e( 'Loading More Posts...', 'mvp-text' ); ?>",
		finishedMsg: "<?php _e( 'Sorry, No More Posts', 'mvp-text' ); ?>"
	}
});

});
//]]>
</script>
<?php } } ?>

<script type='text/javascript'>
//<![CDATA[
jQuery(document).ready(function($) {

  $(window).load(function(){
 	 $('.gallery-thumbs').flexslider({
 	   animation: "slide",
 	   controlNav: false,
 	   animationLoop: false,
 	   slideshow: false,
 	   itemWidth: 75,
 	   itemMargin: 10,
    	   prevText: "&lt;",
           nextText: "&gt;",
  	  asNavFor: '.gallery-slider'
 	 });

 	 $('.gallery-slider').flexslider({
 	   animation: "slide",
  	  controlNav: false,
  	  animationLoop: false,
  	  slideshow: false,
    	  prevText: "&lt;",
          nextText: "&gt;",
  	  sync: ".gallery-thumbs"
 	 });
	});

$('.carousel').elastislide({
	imageW 	: 160,
	minItems	: 1,
	margin		: 3
});

});
//]]>
</script>

<?php }

}
add_action( 'wp_footer', 'mvp_wp_footer' );

/////////////////////////////////////
// Site Layout
/////////////////////////////////////

if ( !function_exists( 'mvp_site_layout' ) ) {
function mvp_site_layout() {

?>

<?php if(get_option('mvp_site_layout') == 'Boxed' || get_option('mvp_wall_ad')) { ?>
<style type="text/css">

@media screen and (min-width: 1003px) {

#site {
	float: none;
	margin: 0 auto;
	width: 1000px;
	}

#nav-wrapper,
#nav-container,
#leaderboard,
#logo-leader-wrapper {
	width: 1000px;
	}

nav {
	max-width: 71%; /* 710px / 1000px */
	}

.prev {
	left: 0;
	}

.next {
	right: 0;
	}

#footer {
	width: 960px;
	}

</style>
<?php } ?>

<?php global $post; $mvp_post_temp = get_post_meta($post->ID, "mvp_post_template", true); if ($mvp_post_temp == "fullwidth") { ?>
<style type="text/css">
.post-section,
#disqus_thread,
#comments {
	margin: 0 2% 20px; /* 20px / 1000px */
	width: 96%; /* 960px / 1000px */
	}
</style>
<?php } ?>

<?php if(get_option('mvp_customcss')) { ?>
<style type="text/css">
<?php $customcss = get_option('mvp_customcss'); if ($customcss) { echo stripslashes($customcss); } ?>
</style>
<?php } ?>

<?php }

}

add_action( 'wp_head', 'mvp_site_layout' );

/////////////////////////////////////
// Miscellaneous
/////////////////////////////////////

// Set Content Width
if ( ! isset( $content_width ) ) $content_width = 620;

// Add RSS links to <head> section
add_theme_support( 'automatic-feed-links' );

add_action('init', 'do_output_buffer');
function do_output_buffer() {
        ob_start();
}

// Prevents double posts on second page

add_filter('redirect_canonical','pif_disable_redirect_canonical');

function pif_disable_redirect_canonical($redirect_url) {
    if (is_singular()) $redirect_url = false;
return $redirect_url;
}

/////////////////////////////////////
// WooCommerce
/////////////////////////////////////

add_theme_support( 'woocommerce' );


?>