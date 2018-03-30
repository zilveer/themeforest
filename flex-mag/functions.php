<?php

/////////////////////////////////////
// Theme Setup
/////////////////////////////////////

if ( ! function_exists( 'mvp_setup' ) ) {
function mvp_setup(){
	load_theme_textdomain('mvp-text', get_template_directory() . '/languages');

	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );
	add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio' ) );
}
}
add_action('after_setup_theme', 'mvp_setup');

/////////////////////////////////////
// Enqueue Javascript/CSS Files
/////////////////////////////////////

if ( ! function_exists( 'mvp_scripts_method' ) ) {
function mvp_scripts_method() {
	global $wp_styles;
	wp_enqueue_style( 'mvp-reset', get_template_directory_uri() . '/css/reset.css' );
	wp_enqueue_style( 'mvp-fontawesome', '//netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css' );
	wp_enqueue_style( 'mvp-style', get_stylesheet_uri() );
	wp_enqueue_style( 'mvp-iecss', get_stylesheet_directory_uri() . "/css/iecss.css", array( 'mvp-style' )  );
	$wp_styles->add_data( 'mvp-iecss', 'conditional', 'lt IE 10' );
	$mvp_skin_layout = get_option('mvp_skin_layout'); if ($mvp_skin_layout == "Fashion") { if (isset($mvp_skin_layout)) {
	wp_enqueue_style( 'mvp-style-fashion', get_template_directory_uri() . '/css/style-fashion.css' );
	} } else if ($mvp_skin_layout == "Entertainment") { if (isset($mvp_skin_layout)) {
	wp_enqueue_style( 'mvp-style-entertainment', get_template_directory_uri() . '/css/style-entertainment.css' );
	} } else if ($mvp_skin_layout == "Sports") { if (isset($mvp_skin_layout)) {
	wp_enqueue_style( 'mvp-style-sports', get_template_directory_uri() . '/css/style-sports.css' );
	} } else if ($mvp_skin_layout == "Tech") { if (isset($mvp_skin_layout)) {
	wp_enqueue_style( 'mvp-style-tech', get_template_directory_uri() . '/css/style-tech.css' );
	} } else { }
	$mvp_respond = get_option('mvp_respond'); if ($mvp_respond == "true") { if (isset($mvp_respond)) {
	wp_enqueue_style( 'mvp-media-queries', get_template_directory_uri() . '/css/media-queries.css' );
	} }
	wp_register_script('mvp-flexmag', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '', true);
	wp_register_script('mvp-infinitescroll', get_template_directory_uri() . '/js/jquery.infinitescroll.min.js', array('jquery'), '', true);
	wp_register_script('mvp-autoloadpost', get_template_directory_uri() . '/js/autoloadpost.js', array('jquery'), '', true);
	wp_enqueue_script('mvp-flexmag');
	$mvp_infinite_scroll = get_option('mvp_infinite_scroll'); if ($mvp_infinite_scroll == "true") { if (isset($mvp_infinite_scroll)) {
	wp_enqueue_script('mvp-infinitescroll');
	} }
	$mvp_auto_load = get_option('mvp_auto_load'); if ($mvp_auto_load == "true" && is_singular() ) { if (isset($mvp_auto_load)) {
	wp_enqueue_script('mvp-autoloadpost');
	} }


}
}
add_action('wp_enqueue_scripts', 'mvp_scripts_method');

/////////////////////////////////////
// Theme Options
/////////////////////////////////////

require_once get_template_directory() . '/admin/admin-functions.php';
require_once get_template_directory() . '/admin/admin-interface.php';
require_once get_template_directory() . '/admin/theme-settings.php';

if ( ! function_exists( 'mvp_theme_options' ) ) {
function mvp_theme_options() {
	$wallad = get_option('mvp_wall_ad');
	$primarytheme = get_option('mvp_primary_theme');
	$topnavbg = get_option('mvp_top_nav_bg');
	$topnavtext = get_option('mvp_top_nav_text');
	$flybutbg = get_option('mvp_fly_but_bg');
	$flybutlines = get_option('mvp_fly_but_lines');
	$topnavhover = get_option('mvp_top_nav_hover');
	$headlines = get_option('mvp_headlines');
	$headlineshover = get_option('mvp_headlines_hover');
	$link = get_option('mvp_link_color');
	$linkhover = get_option('mvp_link_hover');
	$featured_font = get_option('mvp_featured_font');
	$headline_font = get_option('mvp_headline_font');
	$heading_font = get_option('mvp_heading_font');
	$content_font = get_option('mvp_content_font');
	$menu_font = get_option('mvp_menu_font');
	$google_featured = preg_replace("/ /","+",$featured_font);
	$google_headlines = preg_replace("/ /","+",$headline_font);
	$google_heading = preg_replace("/ /","+",$heading_font);
	$google_content = preg_replace("/ /","+",$content_font);
	$google_menu = preg_replace("/ /","+",$menu_font);

	echo "
<style type='text/css'>

@import url(//fonts.googleapis.com/css?family=Oswald:400,700|Lato:400,700|Work+Sans:900|Montserrat:400,700|Open+Sans:800|Playfair+Display:400,700,900|Quicksand|Raleway:200,400,700|Roboto+Slab:400,700|$google_featured:100,200,300,400,500,600,700,800,900|$google_headlines:100,200,300,400,500,600,700,800,900|$google_heading:100,200,300,400,400italic,500,600,700,700italic,800,900|$google_content:100,200,300,400,400italic,500,600,700,700italic,800,900|$google_menu:100,200,300,400,500,600,700,800,900&subset=latin,latin-ext,cyrillic,cyrillic-ext,greek-ext,greek,vietnamese);

#wallpaper {
	background: url($wallad) no-repeat 50% 0;
	}
body,
.blog-widget-text p,
.feat-widget-text p,
.post-info-right,
span.post-excerpt,
span.feat-caption,
span.soc-count-text,
#content-main p,
#commentspopup .comments-pop,
.archive-list-text p,
.author-box-bot p,
#post-404 p,
.foot-widget,
#home-feat-text p,
.feat-top2-left-text p,
.feat-wide1-text p,
.feat-wide4-text p,
#content-main table,
.foot-copy p,
.video-main-text p {
	font-family: '$content_font', sans-serif;
	}

a,
a:visited,
.post-info-name a {
	color: $link;
	}

a:hover {
	color: $linkhover;
	}

.fly-but-wrap,
span.feat-cat,
span.post-head-cat,
.prev-next-text a,
.prev-next-text a:visited,
.prev-next-text a:hover {
	background: $primarytheme;
	}

.fly-but-wrap {
	background: $flybutbg;
	}

.fly-but-wrap span {
	background: $flybutlines;
	}

.woocommerce .star-rating span:before {
	color: $primarytheme;
	}

.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle {
	background-color: $primarytheme;
	}

.woocommerce span.onsale,
.woocommerce #respond input#submit.alt,
.woocommerce a.button.alt,
.woocommerce button.button.alt,
.woocommerce input.button.alt,
.woocommerce #respond input#submit.alt:hover,
.woocommerce a.button.alt:hover,
.woocommerce button.button.alt:hover,
.woocommerce input.button.alt:hover {
	background-color: $primarytheme;
	}

span.post-header {
	border-top: 4px solid $primarytheme;
	}

#main-nav-wrap,
nav.main-menu-wrap,
.nav-logo,
.nav-right-wrap,
.nav-menu-out,
.nav-logo-out,
#head-main-top {
	-webkit-backface-visibility: hidden;
	background: $topnavbg;
	}

nav.main-menu-wrap ul li a,
.nav-menu-out:hover ul li:hover a,
.nav-menu-out:hover span.nav-search-but:hover i,
.nav-menu-out:hover span.nav-soc-but:hover i,
span.nav-search-but i,
span.nav-soc-but i {
	color: $topnavtext;
	}

.nav-menu-out:hover li.menu-item-has-children:hover a:after,
nav.main-menu-wrap ul li.menu-item-has-children a:after {
	border-color: $topnavtext transparent transparent transparent;
	}

.nav-menu-out:hover ul li a,
.nav-menu-out:hover span.nav-search-but i,
.nav-menu-out:hover span.nav-soc-but i {
	color: $topnavhover;
	}

.nav-menu-out:hover li.menu-item-has-children a:after {
	border-color: $topnavhover transparent transparent transparent;
	}

.nav-menu-out:hover ul li ul.mega-list li a,
.side-list-text p,
.row-widget-text p,
.blog-widget-text h2,
.feat-widget-text h2,
.archive-list-text h2,
h2.author-list-head a,
.mvp-related-text a {
	color: $headlines;
	}

ul.mega-list li:hover a,
ul.side-list li:hover .side-list-text p,
ul.row-widget-list li:hover .row-widget-text p,
ul.blog-widget-list li:hover .blog-widget-text h2,
.feat-widget-wrap:hover .feat-widget-text h2,
ul.archive-list li:hover .archive-list-text h2,
ul.archive-col-list li:hover .archive-list-text h2,
h2.author-list-head a:hover,
.mvp-related-posts ul li:hover .mvp-related-text a {
	color: $headlineshover !important;
	}

span.more-posts-text,
a.inf-more-but,
#comments-button a,
#comments-button span.comment-but-text {
	border: 1px solid $link;
	}

span.more-posts-text,
a.inf-more-but,
#comments-button a,
#comments-button span.comment-but-text {
	color: $link !important;
	}

#comments-button a:hover,
#comments-button span.comment-but-text:hover,
a.inf-more-but:hover,
span.more-posts-text:hover {
	background: $link;
	}

nav.main-menu-wrap ul li a,
ul.col-tabs li a,
nav.fly-nav-menu ul li a,
.foot-menu .menu li a {
	font-family: '$menu_font', sans-serif;
	}

.feat-top2-right-text h2,
.side-list-text p,
.side-full-text p,
.row-widget-text p,
.feat-widget-text h2,
.blog-widget-text h2,
.prev-next-text a,
.prev-next-text a:visited,
.prev-next-text a:hover,
span.post-header,
.archive-list-text h2,
#woo-content h1.page-title,
.woocommerce div.product .product_title,
.woocommerce ul.products li.product h3,
.video-main-text h2,
.mvp-related-text a {
	font-family: '$headline_font', sans-serif;
	}

.feat-wide-sub-text h2,
#home-feat-text h2,
.feat-top2-left-text h2,
.feat-wide1-text h2,
.feat-wide4-text h2,
.feat-wide5-text h2,
h1.post-title,
#content-main h1.post-title,
#post-404 h1,
h1.post-title-wide,
#content-main blockquote p,
#commentspopup #content-main h1 {
	font-family: '$featured_font', sans-serif;
	}

h3.home-feat-title,
h3.side-list-title,
#infscr-loading,
.score-nav-menu select,
h1.cat-head,
h1.arch-head,
h2.author-list-head,
h3.foot-head,
.woocommerce ul.product_list_widget span.product-title,
.woocommerce ul.product_list_widget li a,
.woocommerce #reviews #comments ol.commentlist li .comment-text p.meta,
.woocommerce .related h2,
.woocommerce div.product .woocommerce-tabs .panel h2,
.woocommerce div.product .product_title,
#content-main h1,
#content-main h2,
#content-main h3,
#content-main h4,
#content-main h5,
#content-main h6 {
	font-family: '$heading_font', sans-serif;
	}

</style>
	";
}
}
add_action( 'wp_head', 'mvp_theme_options' );

/////////////////////////////////////
// Register Widgets
/////////////////////////////////////

if ( !function_exists( 'mvp_sidebars_init' ) ) {
	function mvp_sidebars_init() {
		register_sidebar(array(
			'id' => 'homepage-widget',
			'name' => 'Homepage Widget Area',
			'before_widget' => '<div id="%1$s" class="home-widget left relative %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="home-title-wrap left relative"><h3 class="side-list-title">',
			'after_title' => '</h3></div>',
		));

		register_sidebar(array(
			'id' => 'sidebar-widget',
			'name' => 'Sidebar Widget Area',
			'before_widget' => '<div id="%1$s" class="side-widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="post-header"><span class="post-header">',
			'after_title' => '</span></h4>',
		));

		register_sidebar(array(
			'id' => 'sidebar-widget-home-left',
			'name' => 'Home Left Sidebar Widget Area',
			'before_widget' => '<div id="%1$s" class="side-widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="post-header"><span class="post-header">',
			'after_title' => '</span></h4>',
		));

		register_sidebar(array(
			'id' => 'sidebar-widget-home',
			'name' => 'Home Right Sidebar Widget Area',
			'before_widget' => '<div id="%1$s" class="side-widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="post-header"><span class="post-header">',
			'after_title' => '</span></h4>',
		));

		register_sidebar(array(
			'id' => 'sidebar-widget-post',
			'name' => 'Post/Page Sidebar Widget Area',
			'before_widget' => '<div id="%1$s" class="side-widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="post-header"><span class="post-header">',
			'after_title' => '</span></h4>',
		));

		register_sidebar(array(
			'id' => 'footer-widget',
			'name' => 'Footer Widget Area',
			'before_widget' => '<div id="%1$s" class="foot-widget left relative %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="foot-head">',
			'after_title' => '</h3>',
		));

		register_sidebar(array(
			'id' => 'sidebar-woo-widget',
			'name' => 'WooCommerce Sidebar Widget Area',
			'before_widget' => '<div id="%1$s" class="side-widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="post-header"><span class="post-header">',
			'after_title' => '</span></h4>',
		));

	}
}
add_action( 'widgets_init', 'mvp_sidebars_init' );

include("widgets/widget-ad.php");
include("widgets/widget-catlist.php");
include("widgets/widget-catrow.php");
include("widgets/widget-gallery.php");
include("widgets/widget-facebook.php");
include("widgets/widget-pop.php");
include("widgets/widget-tagfeat.php");
include("widgets/widget-taglist.php");
include("widgets/widget-tagrow.php");
include("widgets/widget-tags.php");

/////////////////////////////////////
// Register Custom Menus
/////////////////////////////////////

if ( !function_exists( 'register_menus' ) ) {
function register_menus() {
	register_nav_menus(
		array(
			'main-menu' => __( 'Main Menu', 'mvp-text' ),
			'mobile-menu' => __( 'Fly-Out Menu', 'mvp-text' ),
			'footer-menu' => __( 'Footer Menu', 'mvp-text' ))
	  	);
	  }
}
add_action( 'init', 'register_menus' );

/////////////////////////////////////
// Register Mega Menu
/////////////////////////////////////

add_filter( 'walker_nav_menu_start_el', 'wpse63345_walker_nav_menu_start_el', 10, 4 );

function wpse63345_walker_nav_menu_start_el( $item_output, $item, $depth, $args ) {
	global $wp_query;
    // The mega dropdown only applies to the main navigation.
    // Your theme location name may be different, "main" is just something I tend to use.
    if ( 'main-menu' !== $args->theme_location )
        return $item_output;

    // The mega dropdown needs to be added to one specific menu item.
    // I like to add a custom CSS class for that menu via the admin area.
    // You could also do an item ID check.
    if ( in_array( 'mega-dropdown', $item->classes ) ) {
        global $wp_query;
        global $post;
        $thePostID = $post->ID;
	$thumbnail = '';
 	if( has_post_thumbnail( $post->ID ) ) {
   		$thumbnail = get_the_post_thumbnail( $post->ID );
  	}

        $subposts = get_posts( 'numberposts=5&cat=' . $item->object_id );

	$item_output .= '<div class="mega-dropdown"><ul class="mega-list">';
            foreach( $subposts as $post ) :
                setup_postdata( $post );
		if ( has_post_format( 'video' )) {
                $item_output .= '<li><a href="'. get_permalink( $post->ID ) .'"><div class="mega-img">';
		$item_output .= get_the_post_thumbnail( $post->ID, 'mvp-mid-thumb', array( 'class' => 'unlazy') );
		$item_output .= '<div class="feat-vid-but"><i class="fa fa-play fa-3"></i></div></div>';
		$item_output .= get_the_title( $post->ID );
                $item_output .= '</a></li>';
		} else {
                $item_output .= '<li><a href="'. get_permalink( $post->ID ) .'"><div class="mega-img">';
		$item_output .= get_the_post_thumbnail( $post->ID, 'mvp-mid-thumb', array( 'class' => 'unlazy') );
		$item_output .= '</div>';
		$item_output .= get_the_title( $post->ID );
                $item_output .= '</a></li>';
		}
            endforeach;
	$item_output .= '</ul></div>';

    }

    return $item_output;
}

/////////////////////////////////////
// Register Custom Background
/////////////////////////////////////

$custombg = array(
	'default-color' => 'ffffff',
);
add_theme_support( 'custom-background', $custombg );

/////////////////////////////////////
// Register Thumbnails
/////////////////////////////////////

if ( function_exists( 'add_theme_support' ) ) {
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 1000, 600, true );
add_image_size( 'mvp-post-thumb', 1000, 600, true );
add_image_size( 'mvp-medium-thumb', 450, 270, true );
add_image_size( 'mvp-mid-thumb', 300, 180, true );
add_image_size( 'mvp-small-thumb', 80, 80, true );
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
	add_action( 'save_post', 'mvp_save_post_template_meta', 10, 2 );
	add_action( 'save_post', 'mvp_save_featured_image_meta', 10, 2 );
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
		esc_html__( 'Featured Image Caption', 'mvp-text' ),		// Title
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

	<?php wp_nonce_field( 'mvp_save_featured_headline_meta', 'mvp_featured_headline_nonce' ); ?>

	<p>
		<label for="mvp-featured-headline"><?php esc_html_e( "Add a custom featured headline that will be displayed in the featured slider.", 'mvp-text' ); ?></label>
		<br />
		<input class="widefat" type="text" name="mvp-featured-headline" id="mvp-featured-headline" value="<?php echo esc_html( get_post_meta( $object->ID, 'mvp_featured_headline', true ) ); ?>" size="30" />
	</p>

<?php }
}

/* Display the post meta box. */
if ( !function_exists( 'mvp_video_embed_meta_box' ) ) {
function mvp_video_embed_meta_box( $object, $box ) { ?>

	<?php wp_nonce_field( 'mvp_save_video_embed_meta', 'mvp_video_embed_nonce' ); ?>

	<p>
		<label for="mvp-video-embed"><?php esc_html_e( "Enter your video or audio embed code.", 'mvp-text' ); ?></label>
		<br />
		<input class="widefat" type="text" name="mvp-video-embed" id="mvp-video-embed" value="<?php echo esc_html( get_post_meta( $object->ID, 'mvp_video_embed', true ) ); ?>" />
	</p>

<?php }
}

/* Display the post meta box. */
if ( !function_exists( 'mvp_photo_credit_meta_box' ) ) {
function mvp_photo_credit_meta_box( $object, $box ) { ?>

	<?php wp_nonce_field( 'mvp_save_photo_credit_meta', 'mvp_photo_credit_nonce' ); ?>

	<p>
		<label for="mvp-photo-credit"><?php esc_html_e( "Add a caption and/or photo credit information for the featured image.", 'mvp-text' ); ?></label>
		<br />
		<input class="widefat" type="text" name="mvp-photo-credit" id="mvp-photo-credit" value="<?php echo esc_html( get_post_meta( $object->ID, 'mvp_photo_credit', true ) ); ?>" size="30" />
	</p>

<?php }
}

/* Display the post meta box. */
if ( !function_exists( 'mvp_post_template_meta_box' ) ) {
function mvp_post_template_meta_box( $object, $box ) { ?>

	<?php wp_nonce_field( 'mvp_save_post_template_meta', 'mvp_post_template_nonce' ); $selected = esc_html( get_post_meta( $object->ID, 'mvp_post_template', true ) ); ?>

	<p>
		<label for="mvp-post-template"><?php esc_html_e( "Select a template for your post.", 'mvp-text' ); ?></label>
		<br /><br />
		<select class="widefat" name="mvp-post-template" id="mvp-post-template">
			<?php $mvp_post_layout = get_option('mvp_post_layout'); if($mvp_post_layout == 'Template 2') { ?>
				<option value="temp2" <?php selected( $selected, 'temp2' ); ?>>Template 2</option>
			<?php } else if($mvp_post_layout == 'Template 3') { ?>
				<option value="temp3" <?php selected( $selected, 'temp3' ); ?>>Template 3</option>
			<?php } else if($mvp_post_layout == 'Template 4') { ?>
				<option value="temp4" <?php selected( $selected, 'temp4' ); ?>>Template 4</option>
			<?php } else if($mvp_post_layout == 'Template 5') { ?>
				<option value="temp5" <?php selected( $selected, 'temp5' ); ?>>Template 5</option>
			<?php } else if($mvp_post_layout == 'Template 6') { ?>
				<option value="temp6" <?php selected( $selected, 'temp6' ); ?>>Template 6</option>
			<?php } else if($mvp_post_layout == 'Template 7') { ?>
				<option value="temp7" <?php selected( $selected, 'temp7' ); ?>>Template 7</option>
			<?php } else if($mvp_post_layout == 'Template 8') { ?>
				<option value="temp8" <?php selected( $selected, 'temp8' ); ?>>Template 8</option>
			<?php } else { ?>
				<option value="temp1" <?php selected( $selected, 'temp1' ); ?>>Template 1</option>
			<?php } ?>
			<?php $mvp_post_layout = get_option('mvp_post_layout'); if($mvp_post_layout !== 'Template 1') { ?>
            			<option value="temp1" <?php selected( $selected, 'temp1' ); ?>>Template 1</option>
			<?php } ?>
			<?php $mvp_post_layout = get_option('mvp_post_layout'); if($mvp_post_layout !== 'Template 2') { ?>
            			<option value="temp2" <?php selected( $selected, 'temp2' ); ?>>Template 2</option>
			<?php } ?>
			<?php $mvp_post_layout = get_option('mvp_post_layout'); if($mvp_post_layout !== 'Template 3') { ?>
				<option value="temp3" <?php selected( $selected, 'temp3' ); ?>>Template 3</option>
			<?php } ?>
			<?php $mvp_post_layout = get_option('mvp_post_layout'); if($mvp_post_layout !== 'Template 4') { ?>
				<option value="temp4" <?php selected( $selected, 'temp4' ); ?>>Template 4</option>
			<?php } ?>
			<?php $mvp_post_layout = get_option('mvp_post_layout'); if($mvp_post_layout !== 'Template 5') { ?>
				<option value="temp5" <?php selected( $selected, 'temp5' ); ?>>Template 5</option>
			<?php } ?>
			<?php $mvp_post_layout = get_option('mvp_post_layout'); if($mvp_post_layout !== 'Template 6') { ?>
				<option value="temp6" <?php selected( $selected, 'temp6' ); ?>>Template 6</option>
			<?php } ?>
			<?php $mvp_post_layout = get_option('mvp_post_layout'); if($mvp_post_layout !== 'Template 7') { ?>
				<option value="temp7" <?php selected( $selected, 'temp7' ); ?>>Template 7</option>
			<?php } ?>
			<?php $mvp_post_layout = get_option('mvp_post_layout'); if($mvp_post_layout !== 'Template 8') { ?>
				<option value="temp8" <?php selected( $selected, 'temp8' ); ?>>Template 8</option>
			<?php } ?>
        	</select>
	</p>
<?php }
}

/* Display the post meta box. */
if ( !function_exists( 'mvp_featured_image_meta_box' ) ) {
function mvp_featured_image_meta_box( $object, $box ) { ?>

	<?php wp_nonce_field( 'mvp_save_featured_image_meta', 'mvp_featured_image_nonce' ); $selected = esc_html( get_post_meta( $object->ID, 'mvp_featured_image', true ) ); ?>

	<p>
		<label for="mvp-featured-image"><?php esc_html_e( "Select to show or hide the featured image from automatically displaying in this post.", 'mvp-text' ); ?></label>
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
	if ( !isset( $_POST['mvp_video_embed_nonce'] ) || !wp_verify_nonce( $_POST['mvp_video_embed_nonce'], 'mvp_save_video_embed_meta' ) )
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
	if ( !isset( $_POST['mvp_featured_headline_nonce'] ) || !wp_verify_nonce( $_POST['mvp_featured_headline_nonce'], 'mvp_save_featured_headline_meta' ) )
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
	if ( !isset( $_POST['mvp_photo_credit_nonce'] ) || !wp_verify_nonce( $_POST['mvp_photo_credit_nonce'], 'mvp_save_photo_credit_meta' ) )
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
	if ( !isset( $_POST['mvp_post_template_nonce'] ) || !wp_verify_nonce( $_POST['mvp_post_template_nonce'], 'mvp_save_post_template_meta' ) )
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
	if ( !isset( $_POST['mvp_featured_image_nonce'] ) || !wp_verify_nonce( $_POST['mvp_featured_image_nonce'], 'mvp_save_featured_image_meta' ) )
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
		'decompress' => false,
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

if (!function_exists('get_pinterest')) {
function get_pinterest( $post_id ) {

	// Check for transient
	if ( ! ( $count = get_transient( 'get_pinterest' . $post_id ) ) ) {

    // Do API call
    $response = wp_remote_retrieve_body( wp_remote_get( 'http://api.pinterest.com/v1/urls/count.json?url=' . urlencode( get_permalink( $post_id ) ), array(

		'sslverify' => false,
		'compress' => true,
		'decompress' => false,
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

<?php $soc_tot = get_fb( $post_id ) + get_pinterest( $post_id ); if ($soc_tot > 999999999) {
		$soc_format = number_format($soc_tot / 1000000000, 1) . 'B';
	} else if ($soc_tot > 999999) {
		$soc_format = number_format($soc_tot / 1000000, 1) . 'M';
	} else if ($soc_tot > 999) {
        	$soc_format = number_format($soc_tot / 1000, 1) . 'K';
	} else {
		$soc_format = $soc_tot;
   	}
?>

			<?php if($soc_format==0) { ?>
			<?php } elseif($soc_format==1) { ?>
				<div class="share-count relative">
					<span class="soc-count-num"><?php echo esc_html( $soc_format ); ?></span>
					<span class="soc-count-text"><?php esc_html_e( 'Share', 'mvp-text' ); ?></span>
				</div><!--post-social-count-->
			<?php } else { ?>
				<div class="share-count relative">
					<span class="soc-count-num"><?php echo esc_html( $soc_format ); ?></span>
					<span class="soc-count-text"><?php esc_html_e( 'Shares', 'mvp-text' ); ?></span>
				</div><!--post-social-count-->
			<?php } ?>

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
						<?php echo get_comment_date(); ?> <?php esc_html_e( 'at', 'mvp-text'); ?> <?php echo get_comment_time(); ?>
						<?php edit_comment_link( __( 'Edit', 'mvp-text'), '(' , ')'); ?>
					</p>
				</div>
				<div class="text">
					<?php if ( $comment->comment_approved == '0' ) : ?>
						<p class="waiting_approval"><?php esc_html_e( 'Your comment is awaiting moderation.', 'mvp-text' ); ?></p>
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
		<p><?php esc_html_e( 'Pingback:', 'mvp-text' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'mvp-text' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
}

if ( !function_exists( 'mvpClickCommmentButton' ) ) {
function mvpClickCommmentButton($disqus_shortname){
    global $post;
    echo '
    <script type="text/javascript">
	jQuery(document).ready(function($) {
  	  $(".comment-click-'.$post->ID.'").on("click", function(){
  	    $(".com-click-id-'.$post->ID.'").show();
	    $(".disqus-thread-'.$post->ID.'").show();
  	    $(".com-but-'.$post->ID.'").hide();
	  });
	});
    </script>';
}
}

/////////////////////////////////////
// Related Posts
/////////////////////////////////////

if ( !function_exists( 'mvpRelatedPosts' ) ) {
function mvpRelatedPosts() {
    global $post;
    $orig_post = $post;

    $tags = wp_get_post_tags($post->ID);
    if ($tags) {

	$slider_exclude = esc_html(get_option('mvp_feat_posts_tags'));
	$tag_exclude_slider = get_term_by('slug', $slider_exclude, 'post_tag');
	$tag_id_exclude_slider =  $tag_exclude_slider->term_id;

        $tag_ids = array();
        foreach($tags as $individual_tag) {
		$excluded_tags = array($tag_id_exclude_slider);
      		if (in_array($individual_tag->term_id,$excluded_tags)) continue;
 		$tag_ids[] = $individual_tag->term_id;
	}
        $args=array(
            'tag__in' => $tag_ids,
	    'order' => 'DESC',
	    'orderby' => 'date',
            'post__not_in' => array($post->ID),
            'posts_per_page'=> 3,
            'ignore_sticky_posts'=> 1
        );
        $my_query = new WP_Query( $args );
        if( $my_query->have_posts() ) { ?>
            <div class="mvp-related-posts left relative">
		<h4 class="post-header"><span class="post-header"><?php _e( 'Recommended for you', 'mvp-text' ); ?></span></h4>
			<ul>
            		<?php while( $my_query->have_posts() ) { $my_query->the_post(); ?>
            			<li>
                		<div class="mvp-related-img left relative">
					<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
						<?php the_post_thumbnail('mvp-mid-thumb', array( 'class' => 'reg-img' )); ?>
						<?php the_post_thumbnail('mvp-small-thumb', array( 'class' => 'mob-img' )); ?>
					</a>
					<?php } ?>
				</div><!--related-img-->
				<div class="mvp-related-text left relative">
					<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
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
// Popular Posts
/////////////////////////////////////

if ( !function_exists( 'getCrunchifyPostViews' ) ) {
function getCrunchifyPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}
}

if ( !function_exists( 'setCrunchifyPostViews' ) ) {
function setCrunchifyPostViews($postID) {
    $count_key = 'post_views_count';
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
}

if ( !function_exists( 'mvp_post_views' ) ) {
function mvp_post_views(){
	$post_id = get_the_ID();
	$count_key = 'post_views_count';
	$n = get_post_meta($post_id, $count_key, true);
	if ($n > 999999999) {
		$n_format = number_format($n / 1000000000, 1) . 'B';
	} else if ($n > 999999) {
		$n_format = number_format($n / 1000000, 1) . 'M';
	} else if ($n > 999) {
        	$n_format = number_format($n / 1000, 1) . 'K';
	} else {
		$n_format = $n;
   	}

	echo $n_format;
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
         echo "<div class=\"pagination\"><span>".__( 'Page', 'mvp-text' )." ".$paged." ".__( 'of', 'mvp-text' )." ".$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; ".__( 'First', 'mvp-text' )."</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; ".__( 'Previous', 'mvp-text' )."</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">".__( 'Next', 'mvp-text' )." &rsaquo;</a>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>".__( 'Last', 'mvp-text' )." &raquo;</a>";
         echo "</div>\n";
     }
}
}

/////////////////////////////////////
// Auto Load Posts
/////////////////////////////////////

$auto_load = get_option('mvp_auto_load'); if ($auto_load == "true") { if (isset($auto_load)) {

function alnp_add_endpoint() {
    add_rewrite_endpoint( 'partial', EP_PERMALINK );
}

add_action( 'init', 'alnp_add_endpoint' );

/**
* When /partial endpoint is used on a post, get just the post html
**/
function alnp_template_redirect() {
    global $wp_query;

    // if this is not a request for partial or a singular object then bail
    if ( ! isset( $wp_query->query_vars['partial'] ) || ! is_singular() )
        return;

	// include custom template
    get_template_part('content-partial');

    exit;
}

add_action( 'template_redirect', 'alnp_template_redirect' );

function partial_endpoints_activate() {

    // ensure our endpoint is added before flushing rewrite rules
    alnp_add_endpoint();

}

register_activation_hook( __FILE__, 'partial_endpoints_activate' );


} }

/////////////////////////////////////
// Add/Remove User Contact Info
/////////////////////////////////////

if ( !function_exists( 'mvp_new_contactmethods' ) ) {
function mvp_new_contactmethods( $contactmethods ) {
    $contactmethods['facebook'] = 'Facebook'; // Add Facebook
    $contactmethods['twitter'] = 'Twitter'; // Add Twitter
    $contactmethods['pinterest'] = 'Pinterest'; // Add Pinterest
    $contactmethods['googleplus'] = 'Google Plus'; // Add Google Plus
    $contactmethods['instagram'] = 'Instagram'; // Add Instagram
    $contactmethods['linkedin'] = 'LinkedIn'; // Add LinkedIn

    return $contactmethods;
}
}
add_filter('user_contactmethods','mvp_new_contactmethods',10,1);

/////////////////////////////////////
// Disqus Comments
/////////////////////////////////////

$disqus_id = get_option('mvp_disqus_id'); if (isset($disqus_id)) {
if ( !function_exists( 'mvp_disqus_embed' ) ) {
function mvp_disqus_embed($disqus_shortname) {
    global $post;
    wp_enqueue_script('disqus_embed','http://'.$disqus_shortname.'.disqus.com/embed.js');
    echo '<div id="disqus_thread" class="disqus-thread-'.$post->ID.'"></div>
    <script type="text/javascript">
        var disqus_shortname = "'.$disqus_shortname.'";
        var disqus_title = "'.$post->post_title.'";
        var disqus_url = "'.get_permalink($post->ID).'";
        var disqus_identifier = "'.$disqus_shortname.'-'.$post->ID.'";
    </script>';
}
}
}

/////////////////////////////////////
// Footer Javascript
/////////////////////////////////////

if ( !function_exists( 'mvp_wp_footer' ) ) {
function mvp_wp_footer() {

?>

<script type="text/javascript">
jQuery(document).ready(function($) {

	// Back to Top Button
    	var duration = 500;
    	$('.back-to-top').click(function(event) {
          event.preventDefault();
          $('html, body').animate({scrollTop: 0}, duration);
          return false;
	});

	// Main Menu Dropdown Toggle
	$('.menu-item-has-children a').click(function(event){
	  event.stopPropagation();
	  location.href = this.href;
  	});

	$('.menu-item-has-children').click(function(){
    	  $(this).addClass('toggled');
    	  if($('.menu-item-has-children').hasClass('toggled'))
    	  {
    	  $(this).children('ul').toggle();
	  $('.fly-nav-menu').getNiceScroll().resize();
	  }
	  $(this).toggleClass('tog-minus');
    	  return false;
  	});

	// Main Menu Scroll
	$(window).load(function(){
	  $('.fly-nav-menu').niceScroll({cursorcolor:"#888",cursorwidth: 7,cursorborder: 0,zindex:999999});
	});

<?php if ( is_single() ) { ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  	$(".comment-click-<?php echo esc_html(get_the_ID()); ?>").on("click", function(){
  	  $(".com-click-id-<?php echo esc_html(get_the_ID()); ?>").show();
	  $(".disqus-thread-<?php echo esc_html(get_the_ID()); ?>").show();
  	  $(".com-but-<?php echo esc_html(get_the_ID()); ?>").hide();
  	});
	<?php endwhile; endif; ?>
<?php } else if ( is_page() ) { ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  	$(".comment-click").on("click", function(){
  	  $(".com-click-id-<?php echo esc_html(get_the_ID()); ?>").show();
  	  $("#disqus_thread").show();
  	  $(".com-but-click").hide();
  	});
	<?php endwhile; endif; ?>
<?php } ?>

<?php $mvp_infinite_scroll = get_option('mvp_infinite_scroll'); if ($mvp_infinite_scroll == "true") { if (isset($mvp_infinite_scroll)) { ?>
	// Infinite Scroll
	$('.infinite-content').infinitescroll({
	  navSelector: ".nav-links",
	  nextSelector: ".nav-links a:first",
	  itemSelector: ".infinite-post",
	  loading: {
		msgText: "<?php esc_html_e( 'Loading more posts...', 'mvp-text' ); ?>",
		finishedMsg: "<?php esc_html_e( 'Sorry, no more posts', 'mvp-text' ); ?>"
	  },
	  errorCallback: function(){ $(".inf-more-but").css("display", "none") }
	});
	$(window).unbind('.infscr');
	$(".inf-more-but").click(function(){
   		$('.infinite-content').infinitescroll('retrieve');
        	return false;
	});
	$(window).load(function(){
		if ($('.nav-links a').length) {
			$('.inf-more-but').css('display','inline-block');
		} else {
			$('.inf-more-but').css('display','none');
		}
	});
<?php } } ?>

$(window).load(function() {
  // The slider being synced must be initialized first
  $('.post-gallery-bot').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: true,
    slideshow: false,
    itemWidth: 80,
    itemMargin: 10,
    asNavFor: '.post-gallery-top'
  });

  $('.post-gallery-top').flexslider({
    animation: "fade",
    controlNav: false,
    animationLoop: true,
    slideshow: false,
    	  prevText: "&lt;",
          nextText: "&gt;",
    sync: ".post-gallery-bot"
  });
});

});

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

<style type="text/css">

<?php if(get_option('mvp_wall_ad')) { ?>
@media screen and (min-width: 1249px) {
	.home-left-col,
	.home-mid-col,
	.home-right-col {
		display: block !important;
		}

	#body-main-wrap {
		display: table;
		float: none;
		margin-left: auto;
		margin-right: auto;
		position: relative;
			top: auto;
			bottom: auto;
			left: auto;
			right: auto;
		width: 1200px;
		}

	.body-main-out,
	.body-main-in {
		margin-left: 0;
		right: auto;
		}

	#foot-widget-wrap {
		margin: 50px 0 30px;
		width: 100%;
		}

	.foot-widget {
		margin-left: 2.5%; /* 30px / 1200px */
		width: 30%; /* 360px / 1200px */
		}

	#foot-bot {
		margin: 10px 3%;
		width: 94%
		}
}
<?php } ?>

<?php $mvp_post_ad = get_option('mvp_post_ad'); if (! $mvp_post_ad) { ?>
.post-cont-out,
.post-cont-in {
	margin-right: 0;
	}
<?php } ?>
<?php $mvp_show_latest = get_option('mvp_show_latest'); if ($mvp_show_latest == "false") { ?>
.home-wrap-out2,
.home-wrap-in2 {
	margin-left: 0;
	}
@media screen and (max-width: 1099px) and (min-width: 768px) {
	.col-tabs-wrap {
		display: none;
		}
	.home .tabs-top-marg {
		margin-top: 50px !important;
		}
	.home .fixed {
		-webkit-box-shadow: 0 2px 3px 0 rgba(0,0,0,0.3);
	 	   -moz-box-shadow: 0 2px 3px 0 rgba(0,0,0,0.3);
	  	    -ms-box-shadow: 0 2px 3px 0 rgba(0,0,0,0.3);
	   	     -o-box-shadow: 0 2px 3px 0 rgba(0,0,0,0.3);
			box-shadow: 0 2px 3px 0 rgba(0,0,0,0.3);
		}
}
@media screen and (max-width: 767px) {
	ul.col-tabs li.latest-col-tab {
		display: none;
		}
	ul.col-tabs li {
		width: 50%;
		}
}
<?php } ?>
<?php $mvp_infinite_scroll = get_option('mvp_infinite_scroll'); if ($mvp_infinite_scroll == "true") { if (isset($mvp_infinite_scroll)) { ?>
.nav-links {
	display: none;
	}
<?php } } ?>

<?php $mvp_respond = get_option('mvp_respond'); if ($mvp_respond == "false") { if (isset($mvp_respond)) { ?>
#site,
#site-wrap {
width: 1600px;
}
<?php } } ?>

<?php global $post; if (!empty( $post )) { $mvp_post_temp = get_post_meta($post->ID, "mvp_post_template", true); if ( $mvp_post_temp == "temp2" || $mvp_post_temp == "temp4" || $mvp_post_temp == "temp6" || $mvp_post_temp == "temp8" ) { ?>
.post-wrap-out1,
.post-wrap-in1 {
	margin-right: 0;
	}
#body-main-wrap {
	background: #fff;
	}
#main-nav-wrap {
	border-bottom: 1px solid #ddd;
	}
<?php } } ?>

<?php $mvp_latest_side = get_option('mvp_latest_side'); if ($mvp_latest_side == "Right") { if (isset($mvp_latest_side)) { ?>
.home-wrap-out2 {
	float: left;
	margin-left: 0;
	margin-right: -315px;
	}
.home-wrap-in2 {
	margin-left: 0;
	margin-right: 315px;
	}
.home-left-col {
	float: left;
	}
.home-mid-col {
	float: right;
	margin-left: 15px;
	margin-right: 0;
	}

@media screen and (max-width: 1399px) and (min-width: 1250px) {
.home-wrap-out2 {
	float: left;
	margin-left: 0;
	margin-right: -265px;
	}
.home-wrap-in2 {
	margin-left: 0;
	margin-right: 265px;
	}
}
@media screen and (max-width: 1249px) and (min-width: 1100px) {
.home-wrap-out2 {
	float: left;
	margin-left: 0;
	margin-right: -265px;
	}
.home-wrap-in2 {
	margin-left: 0;
	margin-right: 265px;
	}
}
@media screen and (max-width: 1099px) {
.home-wrap-out2,
.home-wrap-in2 {
	float: left;
	margin-left: 0;
	margin-right: 0;
	}
.home-mid-col {
	float: left;
	}
}
@media screen and (max-width: 479px) {
.home-mid-col {
	margin-left: 0;
	}
}
<?php } } ?>

<?php $mvp_fly_skin = get_option('mvp_fly_skin '); if ($mvp_fly_skin == "Light") { if (isset($mvp_fly_skin )) { ?>
#fly-wrap {
	background: #fff;
	}
ul.fly-bottom-soc li {
	border-top: 1px solid #666;
	}
nav.fly-nav-menu ul li {
	border-top: 1px solid #ddd;
	}
nav.fly-nav-menu ul li a {
	color: #555;
	}
nav.fly-nav-menu ul li a:hover {
	color: #bbb;
	}
nav.fly-nav-menu ul li ul.sub-menu {
	border-top: 1px solid #ddd;
	}
<?php } } ?>

<?php $mvp_score_skin = get_option('mvp_score_skin'); if ($mvp_score_skin == "Light") { if (isset($mvp_score_skin)) { ?>
#score-wrap {
	background: #fff;
	border-bottom: 1px solid #ddd;
	}
.score-nav-menu:before {
	border-top: 5px solid #555;
	}
.score-nav-menu select {
	background: #eee;
	color: #555;
	}
.score-nav-menu select option {
	background: #fff;
	color: #555;
	}
ul.score-list li {
	background: #eee;
	border: 1px solid #eee;
	}
ul.score-list li:hover {
	background: #fff;
	border: 1px solid #ddd;
	}
.score-top p,
.score-bot p {
	color: #555;
	}
.es-nav span a {
	color: #555;
	}
.es-nav span:hover a {
	color: #222;
	}
.es-nav span.es-nav-prev,
.es-nav span.es-nav-next {
	background: #fff;
	}
.es-nav span.es-nav-prev {
	border-left: 1px solid #ddd;
	border-right: 1px solid #ddd;
	}
.es-nav span.es-nav-next {
	border-left: 1px solid #ddd;
	}
<?php } } ?>

<?php global $post; if (!empty( $post )) { $mvp_post_temp = get_post_meta($post->ID, "mvp_post_template", true); if ( $mvp_post_temp == "temp5" || $mvp_post_temp == "temp6" || $mvp_post_temp == "temp7" || $mvp_post_temp == "temp8" ) { ?>
#main-nav-wrap {
	border-bottom: none;
	}
<?php } } ?>

<?php $mvp_logo_loc = get_option('mvp_logo_loc'); if($mvp_logo_loc == 'Left of leaderboard' || $mvp_logo_loc == 'Wide below leaderboard') { ?>
.nav-left-wrap {
	width: 60px;
	}
.nav-logo-out {
	margin-left: -60px;
	}
.nav-logo-in {
	margin-left: 60px;
	}
.nav-logo-show {
	padding-right: 20px;
	width: 200px;
	height: 50px;
	}
.nav-logo-show img {
	width: auto;
	}
.nav-left-width {
	width: 280px !important;
	}
.nav-logo-out-fade {
	margin-left: -280px;
	}
.nav-logo-in-fade {
	margin-left: 280px;
	}
<?php } ?>

<?php $customcss = get_option('mvp_customcss'); if ($customcss) { echo wp_kses_post($customcss); } ?>
</style>

<?php }

}

add_action( 'wp_head', 'mvp_site_layout' );

/////////////////////////////////////
// Remove Pages From Search Results
/////////////////////////////////////

if ( !is_admin() ) {

function mvp_SearchFilter($query) {
if ($query->is_search) {
$query->set('post_type', 'post');
}
return $query;
}

add_filter('pre_get_posts','mvp_SearchFilter');

}

/////////////////////////////////////
// Miscellaneous
/////////////////////////////////////

// Place Wordpress Admin Bar Above Main Navigation

if ( is_user_logged_in() ) {
	if ( is_admin_bar_showing() ) {
	function mvp_admin_bar() {
		echo "
			<style type='text/css'>
			.fixed {top: 32px !important;}
			</style>
		";
	}
	add_action( 'wp_head', 'mvp_admin_bar' );
	}
}

// Set Content Width
if ( ! isset( $content_width ) ) $content_width = 1000;

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

/*  Add responsive container to embeds
/* ------------------------------------ */
function alx_embed_html( $html ) {
    return '<div class="video-container">' . $html . '</div>';
}

add_filter( 'embed_oembed_html', 'alx_embed_html', 10, 3 );
add_filter( 'video_embed_html', 'alx_embed_html' ); // Jetpack

/////////////////////////////////////
// WooCommerce
/////////////////////////////////////

add_theme_support( 'woocommerce' );

?>