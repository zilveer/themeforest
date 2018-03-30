<?php
/* load language - if it exists */
load_theme_textdomain( 'flatbox', get_template_directory() . '/languages' );
$locale = get_locale();
$locale_file = get_template_directory() . "/languages/$locale.php";
if ( is_readable( $locale_file ) ) require_once( $locale_file );

/* add admin options */
$reinstall_error_msg = __( 'Please reinstall the theme, one of the files is missing (utils/admin/index.php)', 'flatbox' );
if (file_exists( get_template_directory() . '/utils/admin/index.php' ))
	require_once( 'utils/admin/index.php' );
else
	wp_die( $reinstall_error_msg );

/* meta box */
define( 'RWMB_URL', trailingslashit( get_stylesheet_directory_uri() . '/utils/meta-box' ) );
define( 'RWMB_DIR', trailingslashit( get_template_directory() . '/utils/meta-box' ) );
if (file_exists( RWMB_DIR . 'meta-box.php' ))
	require_once RWMB_DIR . 'meta-box.php';
else
	wp_die( $reinstall_error_msg );
if (file_exists( RWMB_DIR . 'meta-box-config.php' ))
	include RWMB_DIR . 'meta-box-config.php';
else
	wp_die( $reinstall_error_msg );

/* add image resizer script */
if (file_exists( get_template_directory() . '/utils/aq_resizer.php' ))
	require_once( 'utils/aq_resizer.php' );
else
	wp_die( $reinstall_error_msg );

/* obtain some admin settings */
global $smof_data;
$css3_animation = $smof_data['css3_animation'];
if ($css3_animation) {
	$smof_data['css3_animation_class'] = ' animated ' . $css3_animation;
	$smof_data['css3_animation_attribs'] = ' class="animated ' . $css3_animation . '"';
} else {
	$smof_data['css3_animation_class'] = $smof_data['css3_animation_attribs'] = '';
}

/* shortcodes */
if (file_exists(get_template_directory() . '/utils/shortcodes.php'))
	require_once('utils/shortcodes.php');
else
	wp_die( $reinstall_error_msg );

/* sidebar widgets */
if (file_exists( get_template_directory() . '/utils/custom-widgets.php' ))
	require_once( 'utils/custom-widgets.php' );
else
	wp_die( $reinstall_error_msg );

/* custom post types */
if (file_exists( get_template_directory() . '/utils/custom-post-types.php' ))
	require_once( 'utils/custom-post-types.php' );
else
	wp_die( $reinstall_error_msg );

if(is_admin()) {
    require_once locate_template('utils/plugins.php');
}


add_action( 'after_setup_theme', 'flatbox_theme_setup' );
function flatbox_theme_setup() {
	add_theme_support( 'custom-header' );
	add_theme_support( 'custom-background') ;
	add_theme_support( 'automatic-feed-links' );

	/* Menu Settings */
	register_nav_menus( array(
		'main_menu'   => __( 'Main Menu', 'flatbox' )
	) );

	add_filter( 'wp_nav_menu_objects', 'add_menu_parent_class' );
	add_filter('nav_menu_css_class', 'remove_some_menu_classes', 420 ,3);

	add_filter( 'jpeg_quality', 'flatbox_jpeg_quality' );
	add_filter('paginate_links_attributes', 'paginate_links_attributes');

	// include custom posts types in categories, tags or archive listing
	add_filter( 'pre_get_posts', 'flatbox_add_custom_types' );
	add_action ( 'init', 'flatbox_register_taxonomys',0);

	add_filter('excerpt_more', 'new_excerpt_more');
	add_filter('excerpt_length', 'custom_excerpt_length', 999);
	add_action( 'widgets_init', 'flatbox_widgets_init' );
	add_action ( 'comment_form_before', 'flatbox_comment_form_sep' );
	add_action ( 'comment_form_must_log_in_after', 'flatbox_comment_form_sep' );

	add_action( 'wp_enqueue_scripts', 'flatbox_scripts_function' );
	add_action( 'wp_enqueue_scripts', 'add_IE', 10 );
}

if ( ! isset( $content_width ) ) $content_width = 940;


/* add search box at the end of the main menu */
$header_search_form = (isset($smof_data['header_search_form'])) ? $smof_data['header_search_form'] : true;


// add special class to parent menu elements
function add_menu_parent_class( $items ) {
	$parents = array();
	foreach ( $items as $item ) {
		if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) $parents[] = $item->menu_item_parent;
	}
	foreach ( $items as $item ) {
		if ( in_array( $item->ID, $parents ) ) $item->classes[] = 'arrow'; 
	}
	return $items;    
}

function remove_some_menu_classes($classes, $item, $args){
  if(strpos($item->url, '#') !== false)
    // in the 2nd array put the classes you want removed
    return array_diff($classes, array('current_page_item', 'current-menu-item'));

  return $classes;
}

function alter_brightness($colourstr, $steps) {
   $colourstr = str_replace('#','',$colourstr);

  $rhex = substr($colourstr,0,2);
  $ghex = substr($colourstr,2,2);
  $bhex = substr($colourstr,4,2);

  $r = hexdec($rhex);
  $g = hexdec($ghex);
  $b = hexdec($bhex);

  $r = dechex(max(0,min(255,$r + $steps)));
  $g = dechex(max(0,min(255,$g + $steps)));  
  $b = dechex(max(0,min(255,$b + $steps)));

  $r = str_pad($r,2,"0",STR_PAD_LEFT);
  $g = str_pad($g,2,"0",STR_PAD_LEFT);
  $b = str_pad($b,2,"0",STR_PAD_LEFT);

  $cor = '#'.$r.$g.$b;

  return $cor;
}

function alter_brightness2($colourstr, $steps) {
   return '#000';
}


/* enable and set thumbnail sizes */
if (function_exists( 'add_theme_support' )) {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 120, 120, true );
	add_image_size( 'thumbnail', 120, 120, true );
	add_image_size( 'medium', 480, 320, true );
	add_image_size( 'large', 940, 480, true );
}
function flatbox_jpeg_quality( $quality ) {
	return 95;
}


/* pagination */
function paginate_links_attributes() {
	return 'class="button' . $smof_data['css3_animation_class'] . '"';
}

function pagination_pages() {
	global $wp_query;
	$pages = '';
	$max = $wp_query->max_num_pages;
	if (!$current = get_query_var('paged')) $current = 1;
	if ($max > 1) $pages = '<span class="pages">Page ' . $current . ' of ' . $max . '</span>'."\r\n";
	return $pages;
}
function pagination_links() {
	global $wp_query;
	$max = $wp_query->max_num_pages;
	if ($max > 1) {
		if (!$current = get_query_var('paged')) $current = 1;
		$a['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
		$a['total'] = $max;
		$a['current'] = $current;
		echo '<div class="pagination ">'.paginate_links($a).'</div>';
	}
}

// include custom posts types in categories, tags or archive listing
function flatbox_add_custom_types( $query ) {
	if ( !is_admin() || is_category() || is_tag() || is_archive() ) {
		if ($query->is_main_query()) {
			//$query->set( 'post_type', array( 'post', 'page', 'nav_menu_item', 'portfolio', 'portfolio-items', 'staff-members', 'testimonials' ) );
		}
		return $query;
	}
}


//Register the taxonomy for the project categories
function flatbox_register_taxonomys(){
register_taxonomy(
    'project-category', 
    'project-category', 
    array ('hierarchical' => true, 'label' => __('Project Categories', 'flatbox' ))
    );  // portfolio categories
}

/* excerpt settings */
function new_excerpt_more($more) {
	global $post;
	return '&#46;&#46;&#46;<p></p> <a class="morestyle" href="'. get_permalink($post->ID) . '">' . __( 'Continue Reading', 'flatbox' ) . '</a>';
}

function custom_excerpt_length( $length ) {
	return 28;
}

/* widgets */
function flatbox_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Page Sidebar', 'flatbox' ),
		'id' => 'page-sidebar',
		'description' => __( 'Widget area for your main site sidebar', 'flatbox' ),
		'before_widget' => '<div class="%2$s sep">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="wtitle">',
		'after_title' => '</h3><div class=""></div>',
	));

	register_sidebar( array(
		'name' => __( 'Footer Area One', 'flatbox' ),
		'id' => 'sidebar-1',
		'description' => __( 'An optional widget area for your site footer', 'flatbox' ),
		'before_widget' => '<div class="%2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area Two', 'flatbox' ),
		'id' => 'sidebar-2',
		'description' => __( 'An optional widget area for your site footer', 'flatbox' ),
		'before_widget' => '<div class="%2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area Three', 'flatbox' ),
		'id' => 'sidebar-3',
		'description' => __( 'An optional widget area for your site footer', 'flatbox' ),
		'before_widget' => '<div class="%2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

		register_sidebar( array(
		'name' => __( 'Footer Area Four', 'flatbox' ),
		'id' => 'sidebar-4',
		'description' => __( 'An optional widget area for your site footer', 'flatbox' ),
		'before_widget' => '<div class="%2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Extra Menu', 'flatbox' ),
		'id' => 'sidebar_extra',
		'description' => __( 'Extra menu widgets', 'flatbox' ),
		'before_widget' => '<div class="%2$s wmenu_b">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="wmenu_t">',
		'after_title' => '</h3>',
	) );
}

// functions to run on activation - flush to clear rewrites
if ( is_admin() ) {
	if ( isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
		$wp_rewrite->flush_rules();
	}
	// check for theme updates
	if ( !empty($smof_data["themeforest_username"]) && !empty($smof_data["themeforest_apikey"]) ) {
		require_once("utils/updater/theme-update.php");
		ThemeUpdater::init( $smof_data["themeforest_username"], $smof_data["themeforest_apikey"], 'liviu_cerchez' );
	}
}

function content() {
	return str_replace(']]>', ']]&gt;', apply_filters('the_content', do_shortcode(get_the_content())));
}

function flatbox_comment_form_sep() {
	echo '<div class="sep sep-reply"></div>';
}


if ( ! function_exists( 'flatbox_comment' ) ) {

	function flatbox_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
			// Display trackbacks differently than normal comments.
		?>
			<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
					<p><?php _e( 'Pingback:', 'flatbox' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'flatbox' ) ); ?></p>
		<?php
				break;
			default :
			// Proceed with normal comments.
			global $post; ?>

			<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
				<div class="clearfix">
					<div class="comment-author"><?php echo get_avatar( $comment, 80 ); ?></div>
					<div class="comment-body">
						<h6 class="bold"><?php echo get_comment_author_link( $comment->comment_ID ); ?> <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'flatbox' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></h6>
						<p class="date"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><span class="icon-date-gray"></span><?php
							/* translators: 1: date, 2: time */
							printf( __( '%1$s at %2$s', 'flatbox' ), get_comment_date(), get_comment_time() ); ?></a></p>
				<?php if ( $comment->comment_approved == '0' ) : ?>
						<div class="alert notice">
							<p><em><?php _e( 'Your comment is awaiting moderation.', 'flatbox' ); ?> <?php edit_comment_link( __( 'Edit', 'flatbox' ) ); ?></em></p>
							<br />
							<?php comment_text(); ?>
						</div>
				<?php else: ?>
						<?php comment_text(); ?>
						<?php edit_comment_link( __( 'Edit', 'flatbox' ) ); ?>
				<?php endif; ?>

					</div>
				</div>
			<?php
			break;
		endswitch; // end comment_type check
	}

} // function_exists

// enqueue the scripts
function flatbox_scripts_function() {

	wp_register_style( 'main-style',get_template_directory_uri() . '/style.css', array(), '','all' ,true);

	wp_register_style( 'com1',get_template_directory_uri() . '/css/default.css', array(), '','all' );
	wp_register_style( 'com2',get_template_directory_uri() . '/css/component.css', array(), '','all' );
	wp_register_style( 'com3',get_template_directory_uri() . '/css/component2.css', array(), '','all' );

	wp_register_style( 'newstyle',get_template_directory_uri() . '/css/newstyle.css', array(), '','all' );

	wp_enqueue_style( 'newstyle' );

	wp_enqueue_style( 'main-style' );

	wp_enqueue_style( 'com1' );
	wp_enqueue_style( 'com2' );
	wp_enqueue_style( 'com3' );

	if ( current_user_can('manage_options')){
		wp_enqueue_script('site_js2', get_template_directory_uri() . '/js/site2.js', array(),'',true);
	}else{
		wp_enqueue_script('site_js', get_template_directory_uri() . '/js/site.js', array(),'',true);
	}

	// wp_enqueue_script('jquery');  

	// wp_enqueue_script('car1', get_template_directory_uri() . '/js/car/jquery-1.7.2.min.js', array('jquery'),'','',true);
	 wp_enqueue_script('car2', get_template_directory_uri() . '/js/car/jquery.easing.1.3.js', array(),'',true);
	 wp_enqueue_script('car3', get_template_directory_uri() . '/js/car/jquery.jcarousel.min.js', array(),'',true);
	 wp_enqueue_script('car4', get_template_directory_uri() . '/js/car/custom.js', array(),'',true);


	 wp_enqueue_script('media4', get_template_directory_uri() . '/js/mediaelement-and-player.min.js', array('jquery'),'',true);
	 wp_enqueue_script('superfish4', get_template_directory_uri() . '/js/superfish.js', array('jquery'),'',true);
	 wp_enqueue_script('dchart', get_template_directory_uri() . '/js/jquery.donutchart.js', array('jquery'),'',true);

	
	 wp_enqueue_script('twi-js', get_template_directory_uri() . '/js/new/twitterFetcher_v10_min.js', array('jquery'),'',true);

	 wp_enqueue_script('m1-js', get_template_directory_uri() . '/js/new/classie.js', array('jquery'),'',true);
	 wp_enqueue_script('m2-js', get_template_directory_uri() . '/js/new/gnmenu.js', array('jquery'),'','',true);
	
	 wp_enqueue_script('common-js', get_template_directory_uri() . '/js/jquery.common.min.js', array('jquery'),'',true);

	if ( is_page_template('template-contact.php') ) {
		wp_enqueue_script('forms-js', get_template_directory_uri() . '/js/jquery.forms.min.js', array('jquery'),'',true);
	}

	wp_enqueue_script('infiniteisotope-js', get_template_directory_uri() . '/js/jquery.infiniteisotope.min.js', array('jquery'),'',true);
	
	wp_enqueue_script('way-js', get_template_directory_uri() . '/js/new/ticker.js', array('jquery'),'',true);

	wp_enqueue_script('c1', get_template_directory_uri() . '/js/car/modernizr.custom.js', array('jquery'),'',true);
	wp_enqueue_script('c2', get_template_directory_uri() . '/js/car/toucheffects.js', array('jquery'),'',true);
}

function add_IE() {
	$IE = (preg_match('|MSIE ([0-9].[0-9]{1,2})|',$_SERVER['HTTP_USER_AGENT'],$matched));
	if ( $IE ) {
		wp_register_script( 'IE_js', get_template_directory_uri() . '/js/ie.js' );
    	wp_enqueue_script( 'IE_js' );
 	}
}  