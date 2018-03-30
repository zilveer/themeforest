<?php

/**
 * @package WordPress
 * @subpackage MPC WP Boilerplate
 * @since 1.0
 */

define('MPC_THEME_ROOT', get_template_directory_uri());

/* ---------------------------------------------------------------- */
/*	Globals
/* ---------------------------------------------------------------- */

global $mpcth_settings;
global $mpcth_cake;
global $ID;
global $mpcth_options;
global $mpcth_sidebar_options;
global $mpcth_options_name;

$mpcth_options_name = 'mpcth_options_theme_skittles';

$mpcth_sidebar_options = get_option('mpcth_sidebar_options');

$mpcth_options = get_option($mpcth_options_name);

/* ---------------------------------------------------------------- */
/*	Settings
/* ---------------------------------------------------------------- */

$mpcth_cake = Array(
	/* main */
	'themeName'		=> 'mpc-wp-skittles',
	'topMenu'		=> (isset($mpcth_options['mpcth_basic_top_menu']) ? (bool)$mpcth_options['mpcth_basic_top_menu'] : false),
	'topRibbon'		=> (isset($mpcth_options['mpcth_basic_top_ribbon']) ? (bool)$mpcth_options['mpcth_basic_top_ribbon'] : false),
	'layoutStyle'	=> (isset($mpcth_options['mpcth_basic_layout_style']) ? $mpcth_options['mpcth_basic_layout_style'] : 'fluid'), /* fixed or fluid */
	'menuPosition' 	=> (isset($mpcth_options['mpcth_basic_menu_position']) ? $mpcth_options['mpcth_basic_menu_position'] : 'page'), /* header or page ( menu displayed on the left side of a page ) */
	'logoPosition'	=> (isset($mpcth_options['mpcth_basic_logo_position']) ? $mpcth_options['mpcth_basic_logo_position'] : 'page'), /* header or page ( logo displayed on the left side of a page ) */

	/* socials */
	'socialOrder' => Array('dribbble', 'facebook', 'flickr', 'lastfm', 'linkedin', 'rss', 'stumbleupon', 'tumblr', 'twitter', 'gplus', 'mail', 'pinterest', 'vimeo', 'instagram'),
	'socialBackground' => 'square' /* square, circle, none */
);

/* Enable the shortcodes to work in sidebar & footer */
add_filter('widget_text', 'do_shortcode');

/*-----------------------------------------------------------------------------------*/
/*	Setup Theme
/*-----------------------------------------------------------------------------------*/

function mpcth_setup(){
	if (!isset($content_width)) $content_width = 960;

	if (function_exists('add_theme_support')) {
		add_theme_support('post-thumbnails');
		add_image_size('mpcth-blog-thumbnail', 215, 215, true);
		add_image_size('mpcth-portfolio-thumbnail', 215, 215, true);
		//add_image_size('mpcth-gallery-thumbnail', 215, 215, true);

		add_theme_support( 'automatic-feed-links');

		// add editor styles
		add_editor_style();

		// add post format support
		add_theme_support('post-formats', array('aside', 'gallery', 'link', 'status', 'image', 'quote', 'audio', 'video'));
		add_post_type_support('portfolio', 'post-formats');
		//add_post_type_support('gallery', 'post-formats');
	}
}

add_action( 'after_setup_theme', 'mpcth_setup' );

/* ---------------------------------------------------------------- */
/*	Massive Panel
/* ---------------------------------------------------------------- */

if ( !function_exists( 'mpcth_optionsframework_init' ) ) {

	require_once (get_template_directory() . '/mpc-wp-boilerplate/massive-panel/options-framework.php');

	// visual panel include
	require_once (get_template_directory() . '/mpc-wp-boilerplate/php/mpcth-admin-visual-options.php');
}

/*-----------------------------------------------------------------------------------*/
/*	Location Files / Language Files
/*-----------------------------------------------------------------------------------*/

load_theme_textdomain('mpcth', get_template_directory().'/languages');

$locale = get_locale();
$locale_file = MPC_THEME_ROOT."/languages/$locale.php";
if ( is_readable($locale_file) )
	require_once($locale_file);

/*-----------------------------------------------------------------------------------*/
/*	Register Menu
/*-----------------------------------------------------------------------------------*/

if (function_exists('register_nav_menus')) {

	register_nav_menus(array('main' => __('Main Navigation Menu', 'mpcth')));

	if($mpcth_cake['topMenu'])
		register_nav_menus(array('top' => __('Top Navigation Menu', 'mpcth')));
}

/*-----------------------------------------------------------------------------------*/
/*	Add CSS & JS
/*-----------------------------------------------------------------------------------*/

function mpcth_enqueue_scripts() {
	global $mpcth_settings;

	require_once(get_template_directory() . '/mpc-wp-boilerplate/php/mpcth-settings.php');

	/* CSS */

	// Shortcodes Styles
	wp_enqueue_style('shortcodes-style', MPC_THEME_ROOT.'/mpc-wp-boilerplate/css/shortcodes.css');

	// Fancybox Styles
	wp_enqueue_style('fancybox-style', MPC_THEME_ROOT.'/mpc-wp-boilerplate/css/fancybox.css');

	// Open Sans Import
	wp_enqueue_style('lato-font', 'http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic');

	// Flex Slider
	wp_enqueue_style('mpcth-flexslider-css', MPC_THEME_ROOT.'/mpc-wp-boilerplate/plugins/flexslider/flexslider.css');

	/* JS */

	// HTML 5
	wp_enqueue_script('html5', MPC_THEME_ROOT.'/mpc-wp-boilerplate/js/html5.js', array('jquery'));

	// MPC WP Boilerplate JS
	wp_enqueue_script('mpcth-js', MPC_THEME_ROOT.'/mpc-wp-boilerplate/js/mpcth-functions.js', array('jquery'), '1.0', true);
	wp_localize_script('mpcth-js', 'ajaxurl', admin_url('admin-ajax.php'));

	// Custom Theme JS
	wp_enqueue_script('mpcth-theme-js', MPC_THEME_ROOT.'/mpc-wp-boilerplate/js/mpcth-theme.js', array('jquery'), '1.0', true);

	// Shortcodes JS
	wp_enqueue_script('mpcth-shortcodes-js', MPC_THEME_ROOT.'/mpc-wp-boilerplate/js/mpcth-shortcodes.js', array('jquery'), '1.0', true);

	// jQuery Easing
	wp_enqueue_script('jquery-easing', MPC_THEME_ROOT.'/mpc-wp-boilerplate/js/jquery.easing.min.js', array('jquery'), '1.3', true);

	// Fancybox
	wp_enqueue_script('jquery-fancybox', MPC_THEME_ROOT.'/mpc-wp-boilerplate/js/jquery.fancybox.js', array('jquery'), '1.3.4', true);

	// Validate Script
	wp_enqueue_script('jquery-validate', MPC_THEME_ROOT.'/mpc-wp-boilerplate/js/jquery.validate.min.js', array('jquery'), '1.8.1', true);

	// Flex Slider
	wp_enqueue_script('mpcth-flexslider-js', MPC_THEME_ROOT.'/mpc-wp-boilerplate/plugins/flexslider/jquery.flexslider-min.js', array('jquery'), '1.0', true);

	// Spin Loader
	wp_enqueue_script('spin-loader', MPC_THEME_ROOT.'/mpc-wp-boilerplate/js/spin.min.js', '1.2.8', true);

	// Tweeter API
	wp_enqueue_script('api-twitter', 'http://widgets.twimg.com/j/2/widget.js', '1.0', true);

	// oEmbed used for twitter
	wp_enqueue_script('jquery-oembed', MPC_THEME_ROOT.'/mpc-wp-boilerplate/js/jquery.oembed.js', array('jquery'), '1.0', true);

	// Cufon Fonts
	$mpcth_custom_fonts = get_option('mpcth_custom_fonts');

	if(isset($mpcth_custom_fonts))
		wp_enqueue_script('mpcth-custom-fonts', MPC_THEME_ROOT . '/mpc-wp-boilerplate/massive-panel/js/cufon.js', array('jquery'), '1.0', true);

	// Blog load more - enqueue & passing data to JS
	wp_enqueue_style('isotope-style', MPC_THEME_ROOT.'/mpc-wp-boilerplate/css/isotope.css');
	wp_enqueue_script('isotope', MPC_THEME_ROOT.'/mpc-wp-boilerplate/js/jquery.isotope.min.js', array('jquery'), '', true);
	wp_enqueue_script('imagesLoaded', MPC_THEME_ROOT.'/mpc-wp-boilerplate/js/imagesLoaded.js', array('jquery'), '', true);
}
add_action('wp_enqueue_scripts', 'mpcth_enqueue_scripts');

function mpcth_admin_enqueue_scripts() {
	wp_enqueue_style('lato-font-admin', 'http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic');
}
add_action('admin_enqueue_scripts', 'mpcth_admin_enqueue_scripts');
add_action('admin_head', 'mpcth_admin_enqueue_scripts');

/* ---------------------------------------------------------------- */
/*	Load More Hook
/* ---------------------------------------------------------------- */

function mpcth_load_more_hook($query, $type = 'blog') {
	global $mpcth_settings;

	wp_enqueue_script('mpcth-isotope', MPC_THEME_ROOT.'/mpc-wp-boilerplate/js/mpcth-isotope.js', array('jquery', 'isotope'), '1.0');

	$paginationInfo = array(
		'max_pages'					=> $query->max_num_pages,
		'posts_count'				=> $query->found_posts,
		'posts_per_page'			=> $query->post_count,
		'post_type'					=> ($type == 'blog' ? 'post' : $type),
		'page'						=> mpcth_get_paged(),
		'next_page_link'			=> next_posts($query->max_num_pages, false),
		'path'						=> MPC_THEME_ROOT,
		'loading_text'				=> __('Loading...', 'mpcth'),
		'load_more_text'			=> __('Load More', 'mpcth'),
		'to_end_text'				=> __('Left', 'mpcth'),
		'blog_type'					=> $mpcth_settings[$type.'Type'],
		'blog_post_width_max'		=> $mpcth_settings[$type.'PostWidthMax'],
		'blog_post_width_min'		=> $mpcth_settings[$type.'PostWidthMin'],
		'mpcth_settings'			=> $mpcth_settings,
		'query_vars'				=> $query->query
	);

	wp_localize_script('mpcth-isotope', 'paginationInfo', $paginationInfo);
}

add_action('mpcth_add_load_more', 'mpcth_load_more_hook', 10, 2);

/*-----------------------------------------------------------------------------------*/
/*	Register Portfolio Post Type
/*-----------------------------------------------------------------------------------*/

function mpcth_register_portfolio() {
	register_taxonomy('mpcth_portfolio_category', 'portfolio', array(
		'hierarchical' => true,
		'show_ui' => true,
		'query_var' => true,
	)); // add unique categories to portfolio section

	wp_insert_term('Uncategorized', 'mpcth_portfolio_category', array(
		'name' => __('Uncategorized', 'mpcth'),
		'slug' => 'uncategorized',
		'taxonomy' => 'mpcth_portfolio_category',
		'description' => '',
		'category_description' => '',
		'cat_name' => __('Uncategorized', 'mpcth'),
		'category_nicename' => 'uncategorized'
	));

	$portfolio_args = array(
			'label' => __('Portfolio', 'mpcth'),
			'singular_label' => __('Portfolio', 'mpcth'),
			'public' => true,
			'show_ui' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => true,
			'supports' => array('title', 'editor', 'thumbnail', 'comments'),
			'taxonomies' => array('post_tag')
	);

	register_post_type('portfolio', $portfolio_args);
}
add_action('init', 'mpcth_register_portfolio');

function mpcth_add_portfolio_default_category($post_ID) {
	global $wpdb;

	if(!has_term('', 'mpcth_portfolio_category', $post_ID)){
		$cat = array(1);
		wp_set_object_terms($post_ID, $cat, 'mpcth_portfolio_category');
	}
}
add_action('publish_portfolio', 'mpcth_add_portfolio_default_category');

/*-----------------------------------------------------------------------------------*/
/*	Register Gallery Post Type
/*-----------------------------------------------------------------------------------*/

// function mpcth_register_gallery() {
// 	register_taxonomy('mpcth_gallery_category', 'gallery', array(
// 		'hierarchical' => true,
// 		'show_ui' => true,
// 		'query_var' => true,
// 	)); // add unique categories to gallery section

// 	wp_insert_term('Uncategorized', 'mpcth_gallery_category', array(
// 		'name' => __('Uncategorized', 'mpcth'),
// 		'slug' => 'uncategorized',
// 		'taxonomy' => 'mpcth_gallery_category',
// 		'description' => '',
// 		'category_description' => '',
// 		'cat_name' => __('Uncategorized', 'mpcth'),
// 		'category_nicename' => 'uncategorized'
// 	));

// 	$gallery_args = array(
// 			'label' => __('Gallery', 'mpcth'),
// 			'singular_label' => __('Gallery', 'mpcth'),
// 			'public' => true,
// 			'show_ui' => true,
// 			'capability_type' => 'post',
// 			'hierarchical' => false,
// 			'rewrite' => true,
// 			'supports' => array('title', 'editor', 'thumbnail', 'comments'),
// 			'taxonomies' => array('post_tag')
// 	);

// 	register_post_type('gallery', $gallery_args);
// }
// add_action('init', 'mpcth_register_gallery');

// function mpcth_add_gallery_default_category($post_ID) {
// 	global $wpdb;

// 	if(!has_term('', 'mpcth_gallery_category', $post_ID)){
// 		$cat = array(1);
// 		wp_set_object_terms($post_ID, $cat, 'mpcth_gallery_category');
// 	}
// }
// add_action('publish_gallery', 'mpcth_add_gallery_default_category');

/*-----------------------------------------------------------------------------------*/
/*	Aside Menu Function
/*-----------------------------------------------------------------------------------*/

function mpcth_aside_menu(){
	global $mpcth_cake;

	if($mpcth_cake['menuPosition'] == 'page'):
		if(has_nav_menu('main')):
			wp_nav_menu(array(
						'theme_location' => 'main',
						'container' => '',
						'after' => '<span class="mpcth-menu-ribbon"></span>',
						'menu_id' => 'mpcth_menu'));
		else:
			echo '<ul id="nav">';
				wp_list_pages('title_li=');
			echo '</ul>';
		endif;
	endif;
}

/*-----------------------------------------------------------------------------------*/
/*	Display Logo
/*-----------------------------------------------------------------------------------*/

function mpcth_display_logo(){
	global $mpcth_options;

	$link = get_home_url();
	$output = '<a id="mpcth_logo" href="'.$link.'">';
	if(isset($mpcth_options['mpcth_use_text_logo']) && $mpcth_options['mpcth_use_text_logo']) {
		if(isset($mpcth_options['mpcth_text_logo']) && $mpcth_options['mpcth_text_logo'] != '')
			$output .= '<h1>' . $mpcth_options['mpcth_text_logo'] . '</h1>';
	} else {
		if(isset($mpcth_options['mpcth_logo']) && $mpcth_options['mpcth_logo'] != '')
			$output .= '<img src="' . $mpcth_options['mpcth_logo'] . '" alt="Logo">';
		else
			$output .= '<h1>' . get_bloginfo('name') . '</h1>';
	}

	if(isset($mpcth_options['mpcth_text_logo_description']) && $mpcth_options['mpcth_text_logo_description'] == '1')
		$output .= '<small>' . get_bloginfo('description') . '</small>';

	$output .= '</a>';

	return $output;
}

/* ---------------------------------------------------------------- */
/* Display Social Icons
/* ---------------------------------------------------------------- */

function mpcth_get_social_icons() {
	global $mpcth_cake;
	global $mpcth_options;

	echo '<ul class="mpcth-social-icons">';
		foreach($mpcth_cake['socialOrder'] as $social) {
			if($mpcth_options['mpcth_social_'.$social] != '') { ?>
				<li>
					<a href="<?php echo $mpcth_options['mpcth_social_'.$social]; ?>" class="mpcth-social-<?php echo $social; ?>">
						<span class="mpcth-social-bg mpcth-social-bg-<?php echo $mpcth_cake['socialBackground']; ?>">
							<span class="mpcth-sc-icon-<?php echo $social; ?>"></span>
						</span>
						<span class="mpcth-social-bg-over mpcth-social-bg-<?php echo $mpcth_cake['socialBackground']; ?>">
							<span class="mpcth-sc-icon-<?php echo $social; ?>"></span>
						</span>
					</a>
				</li>
		<?php }
		}
	echo '</ul>';
}

/*-----------------------------------------------------------------------------------*/
/*	Display Top Widget Area
/*-----------------------------------------------------------------------------------*/

function mpcth_display_top_area($id = 'mpcth_top_widget_area') {
	echo '<div id="mpcth_top_widget_area">';
		echo '<div id="mpcth_top_widget_area_content" class="mpcth-top-widget-hidden">';
			echo '<ul>';
				dynamic_sidebar($id);
			echo '</ul>';
		echo '</div>';
		echo '<div class="mpcth-clear-fix"></div>';
		echo '<div id="mpcth_top_widget_area_handle" class="mpcth-sc-icon-plus"></div>';
	echo '</div>';
}

/* ---------------------------------------------------------------- */
/* Get query page
/* ---------------------------------------------------------------- */

// function mpcth_get_paged($query) {
function mpcth_get_paged() {
	if(get_query_var('page') != '')
		$paged = get_query_var('page');
	else
		$paged = get_query_var('paged');

	$paged = $paged > 1 ? $paged : 1;

	return $paged;
}

/*-----------------------------------------------------------------------------------*/
/*	Add Fancybox
/*-----------------------------------------------------------------------------------*/

function mpcth_add_fancybox($post_meta, $page_type = '') {
	$output = '';
	if($page_type == '')
		$page_type = 'blog';

	if(isset($post_meta['lightbox_enabled'][0]) && $post_meta['lightbox_enabled'][0] == 'on') {
		$type = '';
		$asset = $post_meta['lightbox_source'][0];
		$asset_type = strtolower($asset);

		$search = preg_match('/.(jpg|jpeg|gif|png|bmp)/', $asset_type);

		if($search == 1) {
			$type = 'mpcth-image';
			$search = 0;
		}

		$search = preg_match('/.(vimeo)./', $asset_type);

		if($search == 1) {
			$type = 'mpcth-vimeo-video';
			$search = 0;
		}

		$search = preg_match('/.(youtube)/', $asset_type);

		if($search == 1) {
			$type = 'mpcth-youtube-video';
			$search = 0;
		}

		$search = preg_match('/.(swf)/', $asset_type);
		if($search == 1) {
			$type = 'mpcth-swf';
			$search = 0;
		}

		if($type == '') {
			$type = 'mpcth-iframe';
		}

		if($page_type != 'portfolio') {
			$output .= '<a class="mpcth-fancybox mpcth-sc-fancybox '.$type.'"  href="'.$asset.'" title="'.$post_meta['lightbox_caption'][0].'"><span class="mpcth-fancybox-background"></span><span class="mpcth-fancybox-info">'.__('Lightbox Available', 'mpcth').'</span></a>';
		} else {
			$output .= '<a class="mpcth-fancybox mpcth-sc-fancybox '.$type.'"  href="'.$asset.'" title="'.$post_meta['lightbox_caption'][0].'"><span class="mpcth-sc-icon-resize-full"></span></a>';
		}
	}

	echo $output;
}

/*-----------------------------------------------------------------------------------*/
/*	Display Pagination
/*-----------------------------------------------------------------------------------*/

function mpcth_display_standard_pagination($query, $type = 'blog') {
	$big = 999999999; // need an unlikely integer

	$paged = mpcth_get_paged();

	echo '<div class="mpcth-pagination">';
	echo paginate_links( array(
	 'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	 'current' => max( 1, $paged ),
	 'prev_text' => '',
	 'next_text' => '',
	 'total' => $query->max_num_pages
	) );

	echo '</div>';

	mpcth_load_more_hook($query, $type);
}

add_action('mpcth_add_standard_pagination' ,'mpcth_display_standard_pagination');

/* ---------------------------------------------------------------- */
/*	Display Load More
/* ---------------------------------------------------------------- */

function mpcth_display_loadmore($info = 'true') {
	echo '<div id="mpcth_lm_container"></div>';
	echo '<div id="mpcth_lm">';
		mpcth_add_corners();
		echo '<a href="#" class="mpcth-lm-button ' . ($info == 'true' ? 'mpcth-lm-info' : '') . '">';
			_e('Load More', 'mpcth');
		echo '</a>';

		echo '<span id="mpcth_lm_spin"></span>';
	echo '</div>';
}

/* ---------------------------------------------------------------- */
/*	Display Comments
/* ---------------------------------------------------------------- */

function mpcth_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	if(get_comment_author_email() == get_the_author_meta('email')){
		$author = "mpcth-post-author";
	} else {
		$author ="";
	}

	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e('Pingback:', 'mpcth'); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __('(Edit)', 'mpcth'), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :

		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment <?php echo $author; ?>">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 60 );
					printf('<cite>%1$s </cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span> ' . __('Post author', 'mpcth') . '</span>' : ''
					);

					_e('Posted on ', 'mpcth');
					printf('<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						sprintf( __('%1$s <span>at</span> %2$s', 'mpcth'), get_comment_date(), get_comment_time() )
					);

					comment_reply_link( array_merge( $args, array( 'reply_text' => __(' - Reply', 'mpcth'), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );
				?>
			</header><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'mpcth'); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __('Edit', 'mpcth')); ?>
			</section><!-- .comment-content -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}

/* ---------------------------------------------------------------- */
/*	Display Page Background
/* ---------------------------------------------------------------- */

function mpcth_display_embed_background($source, $display_toggler) {
	$type = '';

	if (strpos($source, 'youtu.be') !== false || strpos($source, 'youtube.com') !== false) {
		if(strpos($source, 'youtu.be') !== false) {
			$match = str_replace('http://youtu.be/', '', $source);
			$match = str_replace('youtu.be/', '', $match);
		} else {
			$match = str_replace('http://www.youtube.com/watch?v=', '', $source);
			$match = str_replace('www.youtube.com/watch?v=', '', $match);
		}
		$type = 'youtube';
	} elseif (strpos($source, 'vimeo.com') !== false) {
		$match = str_replace('http://vimeo.com/', '', $source);
		$match = str_replace('vimeo.com/', '', $match);
		$type = 'vimeo';
	} elseif (strpos($source, 'maps.google') !== false) {
		$match = '';
		$type = 'maps';
	}

	if(strpos($match, '?') !== false)
		$match = substr($match, 0, strpos($match, '?'));

	if(strpos($match, '&') !== false)
		$match = substr($match, 0, strpos($match, '&'));

	if($type == 'youtube') {
		echo '<div id="mpcth_background_container">';
		echo '<iframe width="100%" height="100%" src="http://www.youtube.com/embed/' . $match . '?rel=0&loop=1&controls=0&autoplay=1" frameborder="0" allowfullscreen></iframe>';
		echo '</div>';
	} elseif($type == 'vimeo') {
		echo '<div id="mpcth_background_container">';
		echo '<iframe src="http://player.vimeo.com/video/' . $match . '?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff&amp;autoplay=1&amp;loop=1" width="100%" height="100%" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
		echo '</div>';
	} elseif($type == 'maps') {
		echo '<div id="mpcth_background_container">';
		echo '<iframe width="110%" height="105%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="' . $source . '&iwloc=B&output=embed" style="margin-left: -10%; margin-top: -1%"></iframe>';
		echo '</div>';
	}

	if($display_toggler) {
		echo '<div id="mpcth_content_toggler">';
			echo '<a href="#" id="mpcth_content_toggler_show">' . __('Show Content', 'mpcth') . '</a>';
			echo '<a href="#" id="mpcth_content_toggler_hide">' . __('Hide Content', 'mpcth') . '</a>';
		echo '</div>';
	}
}

function mpcth_display_image_background($source, $pattern, $display_toggler) {
	if(preg_match("/[^.]+(\.(jpg|jpeg|png|gif|bmp))$/", strtolower($source))) {
		if($pattern == 'on') {
			$pattern_style = 'background-repeat: repeat;';
		} else {
			$pattern_style = 'background-size: cover; ';
			$pattern_style .= 'background-position: center; ';
			$pattern_style .= 'background-repeat: no-repeat; ';
			$pattern_style .= '-ms-filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\'' . $source . '\', sizingMethod=\'scale\'); ';
			$pattern_style .= 'filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\'' . $source . '\', sizingMethod=\'scale\');';
		}

		echo '<div id="mpcth_background_container" style="background-image: url(\'' . $source . '\'); ' . $pattern_style . '"></div>';

		if($display_toggler) {
			echo '<div id="mpcth_content_toggler">';
				echo '<a href="#" id="mpcth_content_toggler_show">' . __('Show Content', 'mpcth') . '</a>';
				echo '<a href="#" id="mpcth_content_toggler_hide">' . __('Hide Content', 'mpcth') . '</a>';
			echo '</div>';
		}
	}
}

/* ---------------------------------------------------------------- */
/*	Get Categories - for portfolio & blog
/* ---------------------------------------------------------------- */

function mpcth_get_query_categories($categories, $type = 'blog') {
	if($type != 'blog')
		$all_categories = get_categories(array('taxonomy' => 'mpcth_portfolio_category', 'hide_empty' => 1));
	else
		$all_categories = get_categories(array('hide_empty' => 1));

	// make a list of categories that should be displayed (for WP query)
	$display_categories = '';

	if(isset($categories[0])) {
		$categories = unserialize($categories[0]);

		foreach($all_categories as $key) {
			if((isset($categories[$key->slug]) && $categories[$key->slug] == 'on') || !isset($categories[$key->slug]))
				$display_categories .= $key->slug.', ';
		}
	}

	return $display_categories;
}

/* ---------------------------------------------------------------- */
/*	Get Filter Categories - for portfolio & blog
/* ---------------------------------------------------------------- */

function mpcth_get_filter_categories($categories, $type = 'blog') {
	if($type != 'blog')
		$all_categories = get_categories(array('taxonomy' => 'mpcth_portfolio_category', 'hide_empty' => 1));
	else
		$all_categories = get_categories(array('hide_empty' => 1));

	if(isset($categories[0])) {
		$categories = unserialize($categories[0]);

		$filter_categories = '';
		$filter_categories .= '<div class="mpcth-'.$type.'-categories mpcth-filterable-categories"><ul>';
		$filter_categories .= '<li class="active" data-link="post"><a href="">'.__('All', 'mpcth').'</a></li>';

		foreach($all_categories as $key) {
			if((isset($categories[$key->slug]) && $categories[$key->slug] == 'on') || !isset($categories[$key->slug])) {
				$filter_categories .= '<li data-link="'.$key->slug.'">';
				if($type == 'blog')
					$filter_categories .= '<a href="" title="'.$key->slug.'">'.$key->name.'</a></li>';
				else
					$filter_categories .= '<a href="" title="'.$key->slug.'">'.$key->name.'</a></li>';
			}
		}

		$filter_categories .= '</ul></div>';

		return $filter_categories;
	}
}

/* ---------------------------------------------------------------- */
/*	Get Sidebar Position - for Single, Blog, Portfolio, Page
/* ---------------------------------------------------------------- */

function mpcth_get_sidebar_position($position) {
	if(isset($position[0]))
		$sidebar_position = $position[0];
	else
		$sidebar_position = 'none';

	return $sidebar_position;
}

/*-----------------------------------------------------------------------------------*/
/*	Register Standard Sidebar & Footer
/*
/*	footer can display 1 - 5 columns (default 3)
/*-----------------------------------------------------------------------------------*/

if(function_exists('register_sidebar')) {
	register_sidebar(array(
		'id' => 'mpcth_main_sidebar',
		'name' => __('Main Sidebar', 'mpcth'),
		'description' => __('This is a standard sidebar for pages.', 'mpcth'),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h5 class="widget_title sidebar_widget_title">',
		'after_title' => '</h5>'
	));

	if(isset($mpcth_options['mpcth_top_widget_area']) && $mpcth_options['mpcth_top_widget_area']) {
		/* Create different number of top widget area columns */
		$tw_col_num = isset($mpcth_options['mpcth_top_widget_area_columns']) ? $mpcth_options['mpcth_top_widget_area_columns'] : 3;
		$tw_col_num = $tw_col_num == '' || $tw_col_num > 5 ? 3 : $tw_col_num;

		register_sidebar(array(
			'id' => 'mpcth_top_widget_area',
			'name' => __('Top Widget Area', 'mpcth'),
			'description' => __('This is top widget area.', 'mpcth'),
			'before_widget' => '<li id="%1$s" data-row="' . $tw_col_num . '" class="widget widget_' . $tw_col_num . ' %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<h5 class="widget_title top_widget_title">',
			'after_title' => '</h5>'
		));
	}
}

/*-----------------------------------------------------------------------------------*/
/*	Register Custom Sidebars and Footers
/*-----------------------------------------------------------------------------------*/

$mpcth_sidebar_options = get_option('mpcth_sidebar_options');

if(isset($mpcth_sidebar_options['custom_sidebars'])) {
	if(!isset($mpcth_sidebar_options['custom_sidebars']['sidebar']))
		$mpcth_sidebar_options['custom_sidebars']['sidebar'] = array();
	if(!isset($mpcth_sidebar_options['custom_sidebars']['footer']))
		$mpcth_sidebar_options['custom_sidebars']['footer'] = array();
	if(!isset($mpcth_sidebar_options['custom_sidebars']['top_area']))
		$mpcth_sidebar_options['custom_sidebars']['top_area'] = array();

	foreach($mpcth_sidebar_options['custom_sidebars']['sidebar'] as $post => $id) {
		if(function_exists('register_sidebar')) {
			$page = get_page($id);
			register_sidebar(array(
				'id' => 'custom_sidebar_' . $id,
				'name' => $page->post_title . __(' Sidebar', 'mpcth'),
				'description' => __('This is a custom sidebar for ', 'mpcth') . $page->post_title . __(' page.', 'mpcth'),
				'before_widget' => '<li id="%1$s" class="widget %2$s">',
				'after_widget' => '</li>',
				'before_title' => '<h5 class="widget_title sidebar_widget_title">',
				'after_title' => '</h5>'
			));
		}
	}
	foreach($mpcth_sidebar_options['custom_sidebars']['top_area'] as $post => $id) {
		if(function_exists('register_sidebar')) {
			$page = get_page($id);
			$meta = get_post_custom($id);
			$tw_col_num = isset($meta['top_area_columns']) ? $meta['top_area_columns'][0] : 3;
			$tw_col_num = $tw_col_num == '' || $tw_col_num > 5 ? 3 : $tw_col_num;
			register_sidebar(array(
				'id' => 'custom_top_area_' . $id,
				'name' => $page->post_title . __(' Top Area', 'mpcth'),
				'description' => __('This is a custom top area for ', 'mpcth') . $page->post_title . __(' page.', 'mpcth'),
				'before_widget' => '<li id="%1$s" data-row="' . $tw_col_num . '" class="widget widget_' . $tw_col_num . ' %2$s">',
				'after_widget' => '</li>',
				'before_title' => '<h5 class="widget_title sidebar_widget_title">',
				'after_title' => '</h5>'
			));
		}
	}
}

/* ---------------------------------------------------------------- */
/* Cache Twitter
/* ---------------------------------------------------------------- */

add_action('wp_ajax_cache_twitter', 'mpc_cache_twitter');
function mpc_cache_twitter() {
	$tweets = isset($_POST['tweets']) ? $_POST['tweets'] : '';
	$id = isset($_POST['id']) ? $_POST['id'] : '';
	$number = isset($_POST['number']) ? $_POST['number'] : '';

	if(!empty($tweets) && !empty($id) && !empty($number)) {
		set_transient('mpcth_twitter_' . $id . '_' . $number, $tweets, 900); // 15min
	}

	die();
}

/* ---------------------------------------------------------------- */
/*	Add Corners
/* ---------------------------------------------------------------- */

function mpcth_add_corners() {
	echo '<span class="mpcth-corner-tl"></span>';
	echo '<span class="mpcth-corner-tr"></span>';
	echo '<span class="mpcth-corner-bl"></span>';
	echo '<span class="mpcth-corner-br"></span>';
}

/* ---------------------------------------------------------------- */
/*	WP Head - styles from the admin panel
/* ---------------------------------------------------------------- */

require_once(TEMPLATEPATH.'/mpc-wp-boilerplate/php/mpcth-custom-head.php');

function mpcth_add_head() {
	mpcth_add_custom_styles();
}

add_action('wp_head', 'mpcth_add_head');

/* ---------------------------------------------------------------- */
/*	Admin Head - styles for admin panel
/* ---------------------------------------------------------------- */

function mpcth_add_admin_head() {
	mpcth_admin_alternative_styles();
}

add_action('admin_head', 'mpcth_add_admin_head');

/* ---------------------------------------------------------------- */
/*	Custom Meta Boxes
/* ---------------------------------------------------------------- */

require_once(get_template_directory().'/mpc-wp-boilerplate/php/mpcth-custom-meta-boxes.php');

/* ---------------------------------------------------------------- */
/*	Shortcodes
/* ---------------------------------------------------------------- */

require_once(get_template_directory() . '/mpc-wp-boilerplate/tinymce/tinymce-settings.php');
require_once(get_template_directory().'/mpc-wp-boilerplate/php/mpcth-shortcodes.php');

/* ---------------------------------------------------------------- */
/*	Custom Widgets
/* ---------------------------------------------------------------- */

require_once(get_template_directory() . '/mpc-wp-boilerplate/php/mpcth-custom-widgets.php');

/* ---------------------------------------------------------------- */
/*	Plugins Autoloader
/* ---------------------------------------------------------------- */

/**
 * @package	   TGM-Plugin-Activation
 * @subpackage Example
 * @version	   2.3.6
 * @author	   Thomas Griffin <thomas@thomasgriffinmedia.com>
 * @author	   Gary Jones <gamajo@gamajo.com>
 * @copyright  Copyright (c) 2012, Thomas Griffin
 * @license	   http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'mpcth_required_plugins' );

function mpcth_required_plugins() {
	$plugins = array(
		array(
			'name'					=> 'JS Composer', // The plugin name
			'slug'					=> 'js_composer', // The plugin slug (typically the folder name)
			'source'				=> MPC_THEME_ROOT . '/mpc-wp-boilerplate/plugins/js_composer.zip', // The plugin source
			'required'				=> true, // If false, the plugin is only 'recommended' instead of required
			'version'				=> '4.7.4', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			//'force_activation'		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			//'force_deactivation'	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'			=> '' // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'					=> 'Quick Flickr Widget',
			'slug'					=> 'quick-flickr-widget',
			'source'				=> MPC_THEME_ROOT . '/mpc-wp-boilerplate/plugins/quick-flickr-widget.zip',
			'required'				=> true,
			'version'				=> '1.3',
			//'force_activation'		=> true,
			//'force_deactivation'	=> true,
			'external_url'			=> ''
		),
		array(
			'name'					=> 'Media Element Player',
			'slug'					=> 'media-element-html5-video-and-audio-player',
			'source'				=> MPC_THEME_ROOT . '/mpc-wp-boilerplate/plugins/media-element-html5-video-and-audio-player.zip',
			'required'				=> true,
			'version'				=> '2.10.3',
			//'force_activation'		=> true, //
			//'force_deactivation'	=> true, //
			'external_url'			=> '' //
		),
		array(
			'name'					=> 'Media Element Player - Skin',
			'slug'					=> 'mediaelementjs-skin',
			'source'				=> MPC_THEME_ROOT . '/mpc-wp-boilerplate/plugins/mediaelementjs-skin.zip',
			'required'				=> true,
			'version'				=> '1.0',
			//'force_activation'		=> true,
			//'force_deactivation'	=> true,
			'external_url'			=> ''
		),
	);

	$config = array(
		'domain'			=> 'mpcth',
		'default_path'		=> '',
//		'parent_menu_slug'	=> 'themes.php',
//		'parent_url_slug'	=> 'themes.php',
		'menu'				=> 'install-required-plugins',
		'has_notices'		=> true,
		'is_automatic'		=> true,
		'message'			=> '',
		'strings'			=> array(
			'page_title'								=> __( 'Install Required Plugins', 'mpcth' ),
			'menu_title'								=> __( 'Install Plugins', 'mpcth' ),
			'installing'								=> __( 'Installing Plugin: %s', 'mpcth' ), // %1$s = plugin name
			'oops'										=> __( 'Something went wrong with the plugin API.', 'mpcth' ),
			'notice_can_install_required'				=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ),
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ),
			'notice_cannot_install'						=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ),
			'notice_can_activate_required'				=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ),
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ),
			'notice_cannot_activate'					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ),
			'notice_ask_to_update'						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ),
			'notice_cannot_update'						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ),
			'install_link'								=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link'								=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'									=> __( 'Return to Required Plugins Installer', 'mpcth' ),
			'plugin_activated'							=> __( 'Plugin activated successfully.', 'mpcth' ),
			'complete'									=> __( 'All plugins installed and activated successfully. %s', 'mpcth' ),
			'nag_type'									=> 'updated'
		)
	);

	tgmpa($plugins, $config);
}

function custom_feeds($qv) {
	if (isset($qv['feed']) && !isset($qv['post_type']))
		$qv['post_type'] = get_post_types();
	return $qv;
}
add_filter('request', 'custom_feeds');

/* Modify VC */
require_once( TEMPLATEPATH . '/mpc-wp-boilerplate/php/mpcth-vc-compability.php' );

?>
