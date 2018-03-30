<?php
/*
 *  Author: Michele Gobbi | @dynamick.it
 *  URL: dynamick.it | @dynamick
 *  Custom functions, support, custom post types and more.
 */

/*
 * ========================================================================
 * External Modules/Files
 * ========================================================================
 */

require_once dirname( __FILE__ ) . '/framework/bootstrap-shortcodes.php';
require_once dirname( __FILE__ ) . '/framework/class-tgm-plugin-activation.php';
require_once dirname( __FILE__ ) . '/framework/bootstrap_walker_menu.php';
require_once dirname( __FILE__ ) . '/framework/bootstrap_breadcrumbs.php';

/*
 * ========================================================================
 * OptionTree inclusion
 * ========================================================================
 */

/**
 * Optional: set 'ot_show_pages' filter to false.
 * This will hide the settings & documentation pages.
 */
add_filter( 'ot_show_pages', '__return_false' );

/**
 * Optional: set 'ot_show_new_layout' filter to false.
 * This will hide the "New Layout" section on the Theme Options page.
 */
add_filter( 'ot_show_new_layout', '__return_false' );

/**
 * Required: set 'ot_theme_mode' filter to true.
 */
add_filter( 'ot_theme_mode', '__return_true' );

/**
 * Required: include OptionTree.
 */
require_once dirname( __FILE__ ) . '/option-tree/ot-loader.php';

/**
 * Theme Options
 */
require_once dirname( __FILE__ ) . '/framework/theme-options.php'  ;

/*
 * ========================================================================
 * WP LESS EMBEDDING
 * ========================================================================
 */

#require dirname(__FILE__) . '/framework/wp-less/bootstrap-for-theme.php';
if ( class_exists( 'WPLessPlugin' ) and function_exists( 'ot_get_option' ) ) {

	add_action('init', 'lessc_init');

	function lessc_init() {
		$less = WPLessPlugin::getInstance();

		// set the legacy configuration
		$config = $less->getConfiguration();
		if (!WP_DEBUG)
			$config->setCompilationStrategy('legacy');

		// set some less variables
		$bg = explode ( ',', get_option_tree( 'my_background' ) ) ;
		$less->setVariables( array(
			'primary_color'   => ot_get_option( 'primary_color', '#E7492F' ),
			'secondary_color' => ot_get_option( 'secondary_color', '#649F0B' ),
			'bg_color'        => empty($bg[0]) ? '#FAFAFA' : $bg[0],
			'bg_image'        => empty($bg[4]) ? 'url(' . get_template_directory_uri() . '/img/diamond-pattern.png)' : "url({$bg[4]})",
			'bg_repeat'       => empty($bg[1]) ? 'repeat' : $bg[1],
			'bg_position'     => empty($bg[3]) ? 'left top' : $bg[3],
			'bg_attachment'   => empty($bg[2]) ? 'scroll' : $bg[2]
				)
		);

		$less->dispatch();
	}
}

/*
 * ========================================================================
 * Envato Wordpress toolkit
 * ========================================================================
 */
if ( function_exists( 'ot_get_option' ) ) {

	add_action('admin_init', 'on_admin_init');

	function on_admin_init() {

		if ( ot_get_option( 'tfcheck' ) == 1 ) {

	    // include the library
	    include_once( dirname( __FILE__ ) . '/envato-wordpress-toolkit-library/class-envato-wordpress-theme-upgrader.php');

			$themeforestid = ot_get_option('themeforestid','demonstudio');
			$tfsecrectapikey = ot_get_option('tfsecrectapikey','xxxxxxxav7hny3p1ptm7xxxxxxxx');

	    $upgrader = new Envato_WordPress_Theme_Upgrader($themeforestid , $tfsecrectapikey );
	    $upgrader->check_for_theme_update();
	    $upgrader->upgrade_theme();

	  }
	}
}

/*
 * ========================================================================
 * Theme Support
 * ========================================================================
 */

if ( ! isset( $content_width ) )
	$content_width = 900;

if ( function_exists( 'add_theme_support' ) ) {

	// Add Menu Support
	add_theme_support( 'menus' );

	// Add Thumbnail Theme Support
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'large', 700, '', true ); // Large Thumbnail
	add_image_size( 'medium', 250, '', true ); // Medium Thumbnail
	add_image_size( 'small', 80, 80, true ); // Small Thumbnail
	add_image_size( 'portfolio', 768, 400, true ); // Small Thumbnail
	add_image_size( 'slides', 2200, 472, true ); // Custom Thumbnail Size call using the_post_thumbnail('slides');
	add_image_size( 'box_slides', 768, 893, true ); // Custom Thumbnail Size call using the_post_thumbnail('slides');

	// Add Support for Custom Backgrounds - Uncomment below if you're going to use
	/*
	add_theme_support( 'custom-background', array(
		'default-color' => 'FFF',
		'default-image' => get_template_directory_uri() . '/img/diamond-pattern.png'
		));
	*/
	// Add Support for Custom Header - Uncomment below if you're going to use
	add_theme_support( 'custom-header', array(
		'default-image'         => get_template_directory_uri() . '/img/clinto-header.png',
		'header-text'           => false,
		'default-text-color'    => '000',
		'width'                 => '116',
		'height'                => 40,
		'random-default'        => false
	));

	// Enables post and comment RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Localisation Support
	load_theme_textdomain( 'eventorganiser', get_template_directory() . '/languages' );
	load_theme_textdomain( 'clinto', get_template_directory() . '/languages' );
	load_theme_textdomain( 'spritz', get_template_directory() . '/languages' );
}

/*
 * ========================================================================
 * Functions
 * ========================================================================
 */

// Load Custom Theme Scripts using Enqueue

function spritz_scripts() {
	if ( ! is_admin() ) {
		wp_register_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.js', false, false, true ); // Modernizr with version Number at the end
		wp_enqueue_script( 'modernizr' ); // Enqueue it!

		wp_register_script( 'selectnav', get_template_directory_uri() . '/js/selectnav.min.js', false, false, true ); // SelectNav script with version number
		wp_enqueue_script( 'selectnav'); // Enqueue it!

        //* Enqueue Masonry
        //wp_enqueue_script( 'masonry' );
        wp_enqueue_script( 'masonry', get_bloginfo( 'stylesheet_directory' ) . '/js/masonry.min.js', '', '', true );

        //* Initialize Masonry
        wp_enqueue_script( 'masonry-init', get_bloginfo( 'stylesheet_directory' ) . '/js/masonry-init.js', '', '', true );

		 wp_register_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '1.0.0', true ); // Bootstrap script with version number
		wp_enqueue_script( 'bootstrap' ); // Enqueue it!

		wp_register_script( 'elastislide', get_template_directory_uri() . '/js/jquery.elastislide.js', array('jquery'), '1.0.0', true ); // Bootstrap script with version number
		wp_enqueue_script( 'elastislide' ); // Enqueue it!

		wp_register_script( 'spritzscripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0', true ); // Spritz script with version number
		wp_enqueue_script( 'spritzscripts' ); // Enqueue it!

    }
}

// Loading Conditional Scripts
// use it for conditional javascript inclusions

function conditional_scripts() {
	if ( is_page( 'pagenamehere' ) ) {
		wp_register_script( 'scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0' ); // Our Script for Conditional loading
		wp_enqueue_script( 'scriptname' ); // Enqueue it!
	}
}

// Load Optimised Google Analytics in the footer

function add_google_analytics() {
	if ( function_exists( 'ot_get_option') ) :
		$google  = "<!-- Optimised Asynchronous Google Analytics -->";
		$google .= "<script>"; // Change the UA-XXXXXXXX-X to your Account ID
		$google .= "var _gaq=[['_setAccount','" . ot_get_option( 'analytics_uid', 'UA-xxxxxx-3' ) . "'],['_trackPageview']];
	            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
	            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
	            s.parentNode.insertBefore(g,s)}(document,'script'));";
		$google .= "</script>";
		echo $google;
	endif;
}

// Facebook script

function add_facebook_script() {
	$appId = ot_get_option( 'facebook_app_id', '235354229916474' );

	$fbscript  = "<div id=\"fb-root\"></div>";
	$fbscript .= "<script>(function(d, s, id) {";
	$fbscript .= "  var js, fjs = d.getElementsByTagName(s)[0];";
	$fbscript .= "  if (d.getElementById(id)) return;";
	$fbscript .= "  js = d.createElement(s); js.id = id;";
	$fbscript .= "  js.src = \"//connect.facebook.net/it_IT/all.js#xfbml=1&appId={$appId}\";";
	$fbscript .= "  fjs.parentNode.insertBefore(js, fjs);";
	$fbscript .= "}(document, 'script', 'facebook-jssdk'));</script>";

    echo $fbscript;
}

// Threaded Comments

function enable_threaded_comments() {
	if ( ! is_admin() ) {
		if ( is_singular() AND comments_open() AND ( get_option( 'thread_comments' ) == 1 ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}

// Custom Comments Callback

function spritzcomments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	extract( $args, EXTR_SKIP );

	if ( 'div' == $args['style'] ) {
		$tag       = 'div';
		$add_below = 'comment';
	} else {
		$tag       = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
		<article id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<header>
		<div class="comment-author vcard">
			<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, '180' ); ?>
			<?php printf(__( '<cite class="fn">%s</cite> <span class="says">says:</span>', 'spritz' ), get_comment_author_link()) ?>
		</div>
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'spritz' ) ?></em>
			<br />
		<?php endif; ?>
		<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
			<?php printf( __( '%1$s at %2$s', 'spritz' ), get_comment_date(),  get_comment_time() ) ?></a><?php edit_comment_link( __( '(Edit)', 'spritz' ),'  ','' ); ?>
		</div>
	</header>
	<div class="comment-text">
		<?php comment_text() ?>
	</div>

	<div class="reply">
		<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
		</article>
	<?php endif; ?>
<?php
}

// Theme Stylesheets using Enqueue

function spritz_styles() {

	wp_register_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'bootstrap' ); // Enqueue it!

	wp_register_style( 'responsive', get_template_directory_uri() . '/css/bootstrap-responsive.min.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'responsive' ); // Enqueue it!

	if ( class_exists( 'WPLessPlugin' ) ) {
		wp_register_style( 'style', get_template_directory_uri() . '/css/style.less', array(), '1.0', 'all' );
		wp_enqueue_style( 'style' ); // Enqueue it!
	} else {
		wp_register_style( 'style', get_template_directory_uri() . '/css/precompiled-style.css', array(), '1.0', 'all' );
		wp_enqueue_style( 'style' ); // Enqueue it!
	}

	wp_register_style( 'fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'fontawesome' ); // Enqueue it!


	wp_register_style( 'fonts', 'http://fonts.googleapis.com/css?family=Open+Sans:300,700|Merriweather:400,700', array(), '1.0', 'all' );
	wp_enqueue_style( 'fonts' ); // Enqueue it!

	wp_register_style( 'elastislide', get_template_directory_uri() . '/css/elastislide.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'elastislide' ); // Enqueue it!

}

// Register Spritz's Navigation menu, other than header menu defined above

function register_spritz_menu() {
	register_nav_menus( array( // Using array to specify more menus if needed
		'top-bar'       => __( 'Header Menu', 'spritz' ), // custom menu 1
		'custom-menu1'  => __( 'Custom Menu 1', 'spritz' ), // custom menu 1
		'custom-menu2'  => __( 'Custom Menu 2', 'spritz' ), // custom menu 2
		'custom-menu3'  => __( 'Custom Menu 3', 'spritz' )  // custom menu 3
	));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup

function my_wp_nav_menu_args( $args = '' ) {
	$args['container'] = false;
	return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items

function my_css_attributes_filter( $var ) {
	return is_array( $var ) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist

function remove_category_rel_from_category_list( $thelist ) {
	return str_replace( 'rel="category tag"', 'rel="tag"', $thelist );
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme

function add_slug_to_body_class( $classes ) {
	global $post;
	if ( is_home() ) {
		$key = array_search( 'blog', $classes );
		if ( $key > -1 )
			unset( $classes[$key] );
	} elseif ( is_page() ) {
		$classes[] = sanitize_html_class( $post->post_name );
	} elseif ( is_singular() ) {
		$classes[] = sanitize_html_class( $post->post_name );
	}

	return $classes;
}

add_filter('get_avatar','change_avatar_css');

function change_avatar_css($class) {
	$class = str_replace( "class='avatar", "class='avatar img-circle", $class) ;
	return $class;
}

// If Dynamic Sidebar Exists

if ( function_exists( 'register_sidebar' ) ) {

	// Define Sidebar Widget Area 1 - footer 1° col

	register_sidebar( array(
		'name'          => __( 'Footer Col 1', 'spritz' ),
		'description'   => __( 'The first widget area in the footer, on the left', 'spritz' ),
		'id'            => 'widget-area-1',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3  class="">',
		'after_title'   => '</h3>'
	));

	// Define Sidebar Widget Area 2 - footer 2° col

	register_sidebar( array(
		'name'          => __( 'Footer Col 2', 'spritz' ),
		'description'   => __( 'The second widget area in the footer', 'spritz' ),
		'id'            => 'widget-area-2',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>'
	));

	// Define Sidebar Widget Area 3 - footer 3° col

	register_sidebar( array(
		'name'          => __( 'Footer Col 3', 'spritz' ),
		'description'   => __( 'The third widget area in the footer', 'spritz' ),
		'id'            => 'widget-area-3',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>'
	));

	// Define Sidebar Widget Area 4 - footer 4° col

	register_sidebar( array(
		'name'          => __( 'Footer Col 4', 'spritz' ),
		'description'   => __( 'The last widget area in the footer, on the right', 'spritz' ),
		'id'            => 'widget-area-4',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>'
	));

}

// Remove wp_head() injected Recent Comment styles

function my_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array(
		$wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
		'recent_comments_style'
	));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin

function spritz_pagination($max_num_pages) {
	$big = 999999999;
	echo paginate_links( array(
		'base'    => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
		'format'  => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'total'   => $max_num_pages
	));
}

// Custom Excerpts
// Create 20 Word Callback for Index page Excerpts, call using spritz_excerpt('spritz_index');

function spritz_index( $length ) {
	return 30;
}

// Create 40 Word Callback for Custom Post Excerpts, call using spritz_excerpt('spritz_custom_post');
function spritz_custom_post( $length ) {
	return 40;
}

// Create the Custom Excerpts callback

function spritz_excerpt( $length_callback = '', $more_callback = '' ) {
	global $post;
	if ( function_exists( $length_callback ) ) {
		add_filter( 'excerpt_length', $length_callback );
	}
	if ( function_exists( $more_callback ) ) {
		add_filter( 'excerpt_more', $more_callback );
	}
	$output = get_the_excerpt();
	$output = apply_filters( 'wptexturize', $output );
	$output = apply_filters( 'convert_chars', $output );
	$output = '<p class="excerpt">' . $output . '</p>';
	echo $output;
}

// Custom View Article link to Post

function spritz_view_article( $more ) {
	global $post;
	return '... <a class="view-article" href="' . get_permalink( $post->ID ) . '">' . __( 'View Article', 'spritz' ) . '</a>';
}

// Remove 'text/css' from our enqueued stylesheet

function html5_style_remove( $tag ) {
	return preg_replace( '~\s+type=["\'][^"\']++["\']~', '', $tag );
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail

function remove_thumbnail_dimensions( $html ) {
	$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
	return $html;
}

// Custom Gravatar in Settings > Discussion

function spritzgravatar ( $avatar_defaults ) {
	$myavatar                   = get_template_directory_uri() . '/img/default-avatar.png';
	$avatar_defaults[$myavatar] = "Custom Gravatar";
	return $avatar_defaults;
}

/**
 * Prints HTML with meta information for the current post—date/time.
 *
 * @since Spritz  1.0
 */

if ( ! function_exists( 'spritz_posted_on' ) ) :
	function spritz_posted_on() {
		printf( '<a href="%1$s" rel="bookmark" class="posted_on"><time datetime="%2$s">%3$s</time></a>',
				get_permalink(),
				get_the_date('c'),
				get_the_date()
		);
	}
endif;

/**
 * Prints HTML with meta information for the current post—date/time in a short format.
 *
 * @since Spritz  1.0
 */

if ( ! function_exists( 'spritz_short_posted_on' ) ) :
	function spritz_short_posted_on() {
		printf( '<a href="%1$s" rel="bookmark" class="post-date"><time datetime="%2$s"><span>%3$s</span>%4$s</time></a>',
			get_permalink(),
			get_the_date('c'),
			get_the_date('j'),
			get_the_date('M')
		);
	}
endif;

/**
 * Prints HTML with meta information for the current post—date/time for an event in short format
 *
 * @since Spritz  1.0
 */

if ( ! function_exists( 'spritz_event_posted_on' ) ) :
	function spritz_event_posted_on($date) {
        //setlocale(LC_ALL, 'it_IT'); // FIXED!
        //setlocale(LC_ALL, 'en_EN');
		$timestamp = strtotime($date);
		$day = date('D', $timestamp);
		printf( '<a href="%1$s" rel="bookmark" class="post-date"><time datetime="%2$s"><span>%3$s</span>%4$s</time></a>',
			get_permalink(),
			date('c', $timestamp),
			date('j', $timestamp),
			strftime('%b', $timestamp)
		);
	}
endif;

/**
 * Prints HTML with meta information for the current author.
 *
 * @since Spritz 1.0
 */

if ( ! function_exists( 'spritz_posted_by' ) ) :
	function spritz_posted_by() {
		printf( __( 'Published by', 'spritz' ).' %1$s',
			sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
				get_author_posts_url( get_the_author_meta( 'ID' ) ),
				sprintf( esc_attr__( 'Published by', 'spritz' ).' %1$s', get_the_author() ),
				get_the_author() )
		);
	}
endif;

/**
 * Customise the Spritz comments fields with HTML5 form elements
 *
 *	Adds support for 	placeholder
 *						required
 *						type="email"
 *						type="url"
 *
 * @since Spritz 1.0
 */

function spritz_comments() {

	$req = get_option( 'require_name_email' );
	$commenter = wp_get_current_commenter();
	$aria_req = ( $req ? " aria-required='true'" : '' );

	$fields =  array(
		'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'spritz' ) . ( $req ? '<span class="required">*</span>' : '' ) .'</label> ' .
 		            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' placeholder = "' . __( 'How could we call you?', 'spritz' ). '"' . ( $req ? ' required' : '' ) . '/></p>',
 		'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'spritz' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' .
 		            '<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' placeholder="' . __( 'How could we contact you?', 'spritz' ). '"' . ( $req ? ' required' : '' ) . ' /></p>',
 		'url'    => '' /*'<p class="comment-form-url"><label for="url">' . __( 'Website' ) . '</label>' .
 		            '<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" placeholder="Have you got a website?" /></p>'*/
 	);

 	return $fields;
 }

function spritz_commentfield() {

	$commentArea = '<p class="comment-form-comment"><label for="comment">' . __( 'Comment', 'spritz' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required placeholder="' . __( 'What do you want ask me?', 'spritz' ). '"	></textarea></p>';

	return $commentArea;

}

 add_filter( 'comment_form_default_fields', 'spritz_comments' );
 add_filter( 'comment_form_field_comment', 'spritz_commentfield' );

/*
 * ========================================================================
 * Actions + Filters + ShortCodes
 * ========================================================================
 */

// Add Actions

add_action ( 'init', 				'spritz_scripts' ); // Add Custom Scripts
add_action ( 'wp_footer', 			'add_google_analytics' ); // Google Analytics optimised in footer
add_action ( 'get_header', 			'enable_threaded_comments' ); // Enable Threaded Comments
add_action ( 'wp_enqueue_scripts',	'spritz_styles' ); // Add Theme Stylesheet
add_action ( 'init', 				'register_spritz_menu' ); // Add Spritz Menu
add_action ( 'widgets_init', 		'my_remove_recent_comments_style' ); // Remove inline Recent Comment Styles from wp_head()
add_action ( 'init', 				'spritz_pagination' ); // Add our HTML5 Pagination

# add_action( 'wp_print_scripts', 	'conditional_scripts' ); // Add Conditional Page Scripts
# add_action( 'wp_footer', 			'add_facebook_script' ); // Facebook SDK

// Remove Actions
// uncomment at will

# remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
# remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
# remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
# remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
# remove_action( 'wp_head', 'index_rel_link' ); // Index link
# remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // Prev link
# remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // Start link
# remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
# remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version
# remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
# remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
# remove_action( 'wp_head', 'rel_canonical' );
# remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

// Add Filters

add_filter( 'avatar_defaults', 		'spritzgravatar' ); // Custom Gravatar in Settings > Discussion
add_filter( 'body_class', 			'add_slug_to_body_class' ); // Add slug to body class (Starkers build)
add_filter( 'widget_text', 			'do_shortcode' ); // Allow shortcodes in Dynamic Sidebar
add_filter( 'widget_text', 			'shortcode_unautop' ); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter( 'wp_nav_menu_args', 	'my_wp_nav_menu_args' ); // Remove surrounding <div> from WP Navigation
add_filter( 'the_category', 		'remove_category_rel_from_category_list' ); // Remove invalid rel attribute
add_filter( 'the_excerpt', 			'shortcode_unautop' ); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter( 'the_excerpt', 			'do_shortcode' ); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter( 'excerpt_more', 		'spritz_view_article' ); // Add 'View Article' button instead of [...] for Excerpts
add_filter( 'post_thumbnail_html', 	'remove_thumbnail_dimensions', 10 ); // Remove width and height dynamic attributes to thumbnails
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 ); // Remove width and height dynamic attributes to post images
# add_filter( 'style_loader_tag', 	'html5_style_remove' ); // Remove 'text/css' from enqueued stylesheet
# add_filter( 'nav_menu_css_class', 'my_css_attributes_filter', 100, 1 ); // Remove Navigation <li> injected classes (Commented out by default)
# add_filter( 'nav_menu_item_id', 	'my_css_attributes_filter', 100, 1 ); // Remove Navigation <li> injected ID (Commented out by default)
# add_filter( 'page_css_class', 	'my_css_attributes_filter', 100, 1 ); // Remove Navigation <li> Page ID's (Commented out by default)

/*
* ========================================================================
*  Social Badges
* ========================================================================
*/

function spritz_twitter_badge() {
	$twitter_url 	= ot_get_option( 'twitter_url', "https://twitter.com/dynamick" );
	$twitter_label 	= __( 'follow @dynamick', 'spritz' );
	$twitter_lang 	= "en";
	$ret 			= <<<EOF
<a href="{$twitter_url}" class="twitter-follow-button" data-show-count="true" data-lang="{$twitter_lang}" data-size="large">{$twitter_label}</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
EOF;
	return $ret;
}

function spritz_mailchimp_form() {
	$placeholder 		= __( 'Add your email', 'spritz' );
	$subscribe_label 	= __( 'Subscribe', 'spritz' );
	$action 			= ot_get_option( 'mailchimp_link_url', '#' );
	$ret 				= <<<EOF
	<!-- Begin MailChimp Signup Form -->
	<form action="{$action}" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
		<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="{$placeholder}" required>
		<input type="submit" value="{$subscribe_label}" name="subscribe" id="mc-embedded-subscribe" class="btn btn-info">
	</form>
	<!--End mc_embed_signup-->
EOF;
	return $ret;
}

function curPageURL() {
	$pageURL = 'http';
	if ( $_SERVER["HTTPS"] == "on" )
		$pageURL .= "s";
	$pageURL .= "://";
	if ( $_SERVER["SERVER_PORT"] != "80" )
		$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
	else
		$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	return $pageURL;
}

/*
* ========================================================================
* Include the TGM_Plugin_Activation class.
* ========================================================================
*/

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 */

function my_theme_register_required_plugins() {

	$plugins = array(

		// This is an example of how to include a plugin pre-packaged with a theme
		/*
		array(
			'name'     				=> 'TGM Example Plugin', // The plugin name
			'slug'     				=> 'tgm-example-plugin', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/lib/plugins/tgm-example-plugin.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),*/

		array(
			'name' 				=> 'Event Organiser',
			'slug' 				=> 'event-organiser',
			'force_activation' 	=> true,
			'required' 			=> true
		),
		array(
			'name' 				=> 'WP-LESS',
			'slug' 				=> 'wp-less',
			'force_activation' 	=> true,
			'required' 			=> true
		)

	);

	$theme_text_domain = 'spritz';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'           => $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
		'default_path'     => '',                         	// Default absolute path to pre-packaged plugins
		//'parent_menu_slug' => 'themes.php', 				// Default parent menu slug
		//'parent_url_slug'  => 'themes.php', 				// Default parent URL slug
		'menu'             => 'install-required-plugins', 	// Menu slug
		'has_notices'      => true,                       	// Show admin notices or not
		'is_automatic'     => false,					   	// Automatically activate plugins after installation or not
		'message'          => '',							// Message to output right before the plugins table
		'strings'          => array(
			'page_title'                      => __( 'Install Required Plugins', $theme_text_domain ),
			'menu_title'                      => __( 'Install Plugins', $theme_text_domain ),
			'installing'                      => __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
			'oops'                            => __( 'Something went wrong with the plugin API.', $theme_text_domain ),
			'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link'                   => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                          => __( 'Return to Required Plugins Installer', $theme_text_domain ),
			'plugin_activated'                => __( 'Plugin activated successfully.', $theme_text_domain ),
			'complete'                        => __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
			'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );

}

/*
* ========================================================================
* Various Functions
* ========================================================================
*/

/* Get the background image for the blog header */

function get_blog_header_image() {
	$src = '';

	if ( function_exists( 'ot_get_option' ) ) {
		$src = ot_get_option( 'blog_header_image' );
	}

	if ( ! $src ) {
		$src = get_template_directory_uri() . '/img/panorama.jpg';
	}
	return $src;
}

/* Get the custom background image */

function get_custom_background() {
	$bg   = '';
	$mods = get_option( 'theme_mods_clinto' );
	if ( ! empty ( $mods['background_image_thumb'] ) ) {
		$bg = $mods['background_image_thumb'];
	}
	if ( $bg == '' )
		$bg = get_template_directory_uri() . '/img/diamond-pattern.png';
	return $bg;
}

/*
* ========================================================================
* Version 2.0 Functions
* ========================================================================
*/

/*
if ( ! function_exists( 'clinto_header_style' ) ) :

function clinto_header_style() {

	if ( function_exists('get_option_tree') ) {
		$bg = explode ( ',', get_option_tree( 'my_background' ) ) ;
		$bg_img = $bg[4];
	} else
		return;

	?>
	<style type="text/css" id="custom-background-css">
		body, section.body {
			background-color:<?php echo $bg[0] ?>;
			background-image:url('<?php echo $bg[4] ?>');
			background-repeat:<?php echo $bg[1] ?>;
			background-position:<?php echo $bg[3] ?>;
			background-attachment:<?php echo $bg[2]; ?>
		}
	</style>
	<?php
}
endif;
*/

?>