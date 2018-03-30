<?php
/**
 * Morphis functions and definitions
 *
 * @package WordPress
 * @subpackage Morphis
 */

/**
 * Tell WordPress to run morphis_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'morphis_setup' );

if ( ! function_exists( 'morphis_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override morphis_setup() in a child theme, add your own morphis_setup to your child theme's
 * functions.php file.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To style the visual editor.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links, and Post Formats.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 * 
 */

function morphis_setup() {

	/* Make Morphis available for translation.
	 * Translations can be added to the /languages/ directory.
	 * 
	 */
	load_theme_textdomain( 'morphis', get_template_directory() . '/languages' );
	
	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );
		
	// This theme uses featured Images (also known as post thumbnails) 
	add_theme_support( 'post-thumbnails' );	
	
	// add support for woocommerce
	add_theme_support( 'woocommerce' );	
	
	// Generate slider thumbs
	add_image_size( 'ei-slider-thumbnail', 150, 59, true );			

	// Twitter Oauth
	require_once( get_template_directory() . '/api/twitter/twitteroauth.php' );
	
	// Twitter Widget
	require( get_template_directory() . '/inc/twitter-widget.php' );
	
	// Flickr Widget
	require( get_template_directory() . '/inc/flickr-widget.php' );
	
	// Instagram Widget
	require( get_template_directory() . '/inc/instagram-widget.php' );
	
	// Contact Details Widget
	require( get_template_directory() . '/inc/contact-widget.php' );
	
	// Video Widget
	require( get_template_directory() . '/inc/video-widget.php' );
	
	// Headquarter Widget
	require( get_template_directory() . '/inc/contact-page-widget.php' );
	
	// Twitter API
	require_once( get_template_directory() . '/api/twitter/twitter.php' );
	
	// Theme Styles
	require_once( get_template_directory() . '/inc/theme-styles.php' );
	
	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// This theme uses wp_nav_menu() in one location.
	//register_nav_menu( 'primary', __( 'Primary Menu', 'morphis' ) );

	// Add support for a variety of post formats
	add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image', 'chat', 'video', 'audio' ) );

	// Add TinyMce Custom Buttons for Shortcodes
	require( get_template_directory() . '/inc/shortcodes/pulp-framework-shortcodes.php' );	
	
	// Require Morphis - NHP Theme Options Framework.	 
	//require( get_template_directory() . '/theme-options.php' );
	// if( is_admin() ) {
		get_template_part('theme', 'options');
	// }
	
	// woocommerce integration
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		require_once( get_template_directory() . '/inc/woocommerce-init.php' );
		add_action( 'init', 'initialize_woocommerce_theme_option', 999 );
	}
	
	//portfolio filter walker
	require_once(get_template_directory() . '/lib/portfolio_filter_walker.class.php');
	
	global $slider_options;		
	$slider_options = array( 
						'caroufredsel' => 'CarouFredSel',
						'eislider' => 'Elastic Image (EI) Slider' 
					);

	global $morphis_is_admin;
	$morphis_is_admin = is_admin();
	
	/* TGM Plugin Activation */
	require_once( get_template_directory() . '/plugins/class-tgm-plugin-activation.php' );
}
endif; // morphis_setup

/* TGM Plugi Activation */
function pulpf_tgm_plugin_activation() {
	 /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        // Layer Slider
		 array(
            'name'			=> 'LayerSlider WP', // The plugin name
            'slug'			=> 'LayerSlider', // The plugin slug (typically the folder name)
            'source'			=> get_template_directory() . '/plugins/layersliderwp-5.1.1.installable.zip', // The plugin source
            'required'			=> false, // If false, the plugin is only 'recommended' instead of required
            'version'			=> '5.1.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'		=> '', // If set, overrides default API URL and points to an external URL
        ),
		
    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'morphis' ),
            'menu_title'                      => __( 'Install Plugins', 'morphis' ),
            'installing'                      => __( 'Installing Plugin: %s', 'morphis' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'morphis' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'morphis' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'morphis' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'morphis' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'morphis' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'morphis' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'morphis' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'morphis' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'morphis' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'morphis' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'morphis' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'morphis' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'morphis' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'morphis' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'pulpf_tgm_plugin_activation' );


/**
 * Setup Front-end NHP Theme Options
 *
 * @since 1.9.8
 * @uses $NHP_Options
 */
if ( ! function_exists( 'pf_setup_theme_options' ) ) {	
	function pf_setup_theme_options() {
		if( !is_admin() ) {
			$theme_data_getter = wp_get_theme();
			$opt_name = str_replace(" ", "_", strtolower($theme_data_getter->get('Name')));
			global $NHP_Options;
			// get all options
			$NHP_Options = get_option( $opt_name );

			global $nhp_opt_obj;
			$args = array();
			$args['opt_name'] = $opt_name;
			$nhp_opt_obj = new NHP_Options( array(), $args, array() );
		}
	}
}
add_action( 'init', 'pf_setup_theme_options', 0 );
  

/**
 * Get NHP Theme Options
 *
 * @since 1.9.8
 * @uses $NHP_Options
 */
if ( ! function_exists( 'pf_get_theme_option' ) ) {
	function pf_get_theme_option( $option_id, $default = null ) {	
		global $NHP_Options, $morphis_is_admin;		
		// check first if this is admin
		if( $morphis_is_admin ) {
			return $NHP_Options->get( $option_id );
		} else {
			// check if the option is available
			if( !empty( $NHP_Options[$option_id] ) ) {
				return $NHP_Options[$option_id];
			} else {
				return $default;
			}
		}
	}	
}
 

function initialize_woocommerce_theme_option() {	
/**
 * WooCommerce Products per page
 **/
global $NHP_Options, $morphis_is_admin;	
	
if( $morphis_is_admin ) {
	$products_per_page = $NHP_Options->get('woocommerce_items_per_page');
} else {
	$products_per_page = $NHP_Options['woocommerce_items_per_page'];
}
add_filter('loop_shop_per_page', create_function('$cols', 'return ' . $products_per_page . ';'));
}


/*-----------------------------------------------------------------------------------*/
/*	Content Width
/*-----------------------------------------------------------------------------------*/
if( ! isset( $content_width ) ) $content_width = 700;


/*-----------------------------------------------------------------------------------*/
/*	Register WP3.0+ Menus
/*-----------------------------------------------------------------------------------*/

if( !function_exists( '_register_menu' ) ) {
    function _register_menu() {
	    register_nav_menu('primary-menu', __('Primary Menu', 'morphis'));    	
    }

    add_action('init', '_register_menu');
}


/**
 * Sets the post excerpt length to 40 words.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 */
if( !function_exists( 'theme_excerpt_length' ) ) {
	function theme_excerpt_length( $length ) {
		return 25;
	}
	add_filter( 'excerpt_length', 'theme_excerpt_length' );
}


/**
 * Returns a "Continue Reading" link for excerpts
 */
if( !function_exists( 'theme_continue_reading_link' ) ) {
	function theme_continue_reading_link() {
		return ' <a href="'. esc_url( get_permalink() ) . '">' . morphis_read_more_text() . '</a>';
	}
}

/**
 * Read More text
 *
 * @since	1.0.0
 */ 
if( !function_exists( 'morphis_read_more_text' ) ) {
	function morphis_read_more_text() {
		return __( "Read the rest", 'morphis' );
	}
}
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and theme_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
if( !function_exists( 'theme_auto_excerpt_more' ) ) {
	function theme_auto_excerpt_more( $more ) {
		return ' &hellip;' . theme_continue_reading_link();
	}
	add_filter( 'excerpt_more', 'theme_auto_excerpt_more' );
}
/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
if( !function_exists( 'theme_custom_excerpt_more' ) ) {
function theme_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= theme_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'theme_custom_excerpt_more' );
}

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
if( !function_exists( 'theme_page_menu_args' ) ) {
	function theme_page_menu_args( $args ) {
		$args['show_home'] = true;
		return $args;
	}
	add_filter( 'wp_page_menu_args', 'theme_page_menu_args' );
}

/**
 * Get PostID from URL
 *
 * 
 */
if( !function_exists( 'getPostIDFromURL' ) ) {
	function getPostIDFromURL() {
		
		// get post id from calling post with unique sidebar
		$url = explode('?', 'http://'.$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
		
		if(!empty($url[1]) ):
			$urlid = substr($url[1], 2);
			$postid = $urlid;
			
			$urlnumber = explode('=', $url[1]);
			if( isset( $urlnumber[1] ) ) {
				$tempPostID =  $urlnumber[1];
			} else {
				$tempPostID = '';
			}
			if( $tempPostID != '' || !empty($tempPostID) ):
				$postid = $tempPostID;
			endif;
			
		else:
			$postid = url_to_postid($url[0]);
		endif;
		
		return $postid;
		
	}
}

/**
 * Register our sidebars and widgetized areas.
 *
 * 
 */
if( !function_exists( '_widgets_init' ) ) {
function _widgets_init() {
	
	global $NHP_Options, $morphis_is_admin;
	if( $morphis_is_admin ) {
		$sidebar_position = $NHP_Options->get('radio_img_select_sidebar');
	} else {
		$sidebar_position = $NHP_Options['radio_img_select_sidebar'];
	}
	
	$unique_sidebar_position = '';
	
	$postid = getPostIDFromURL();
	
	if ($postid != '') :
		// get unique sidebar layout 
		$unique_sidebar_position = get_post_meta($postid, '_cmb_post_single_layout_sidebar', true);
		
	endif;

	if ($postid != '') :
		// get unique sidebar layout 
		$unique_sidebar_position = get_post_meta($postid, '_cmb_page_layout_sidebar', true);		
	endif;
	
	
	if($unique_sidebar_position != '' && $unique_sidebar_position != 'default_sidebar'):
		switch ( $unique_sidebar_position ) {
			case 'right_sidebar':
				$sidebar_position_class = 'sidebar-borders';
				break;
			case 'left_sidebar':
				$sidebar_position_class = 'sidebar-borders-left';
				break;
			case 'no_sidebar':
				$sidebar_position_class = 'sidebar-borders';
				break;
		}
	else: 
		if( $sidebar_position == '1' ){
			$sidebar_position_class = 'sidebar-borders-left';
		} else {
			$sidebar_position_class = 'sidebar-borders';
		}
		
	endif;
	
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'morphis' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s container-frame '.$sidebar_position_class.'">',
		'after_widget' => "</aside>",
		'before_title' => '<h6 class="widget-title">',
		'after_title' => '</h6>',
	) );
	
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		register_sidebar( array(
			'name' => __( 'WooCommerce Sidebar', 'morphis' ),
			'id' => 'woocommerce-widgets-sidebar',
			'description' => __( 'A widget area used for all WooCommerce Pages', 'morphis' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s '.$sidebar_position_class.'">',
			'after_widget' => '</div>',
			'before_title' => '<h6 class="widget-title">',
			'after_title' => '</h6>',
		) );
	}
	
	register_sidebar( array(
		'name' => __( 'Footer First Column', 'morphis' ),
		'id' => 'footer-first-column',
		'description' => __( 'An optional widget area for your site footer', 'morphis' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
		'before_title' => '<h6 class="widget-title">',
		'after_title' => '</h6>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Second Column', 'morphis' ),
		'id' => 'footer-second-column',
		'description' => __( 'An optional widget area for your site footer', 'morphis' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
		'before_title' => '<h6 class="widget-title">',
		'after_title' => '</h6>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Third Column', 'morphis' ),
		'id' => 'footer-third-column',
		'description' => __( 'An optional widget area for your site footer', 'morphis' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
		'before_title' => '<h6 class="widget-title">',
		'after_title' => '</h6>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Fourth Column', 'morphis' ),
		'id' => 'footer-fourth-column',
		'description' => __( 'An optional widget area for your site footer', 'morphis' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
		'before_title' => '<h6 class="widget-title">',
		'after_title' => '</h6>',
	) );
	
	// Sidebar Manager Post Type
	$sidebar_manager_loop = new WP_Query( array( 
						'post_type' => 'sidebar_manager',
						'orderby' => 'menu_order',
						'posts_per_page' => -1,
						'order' => 'ASC'
					) );

	if( $sidebar_manager_loop->have_posts() ) {

	  while ($sidebar_manager_loop->have_posts()) : $sidebar_manager_loop->the_post();	  
	  	
		register_sidebar( array(
			'name' => __( 'Sidebar Manager : ' . get_the_title(), 'morphis' ),
			'id' => 'sm-' . get_the_ID(),
			'description' => __( 'A widget area for your unique page sidebars. Select this widget sidebar on the "Unique Page Sidebar Settings" on your Page/Post.', 'morphis' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s '.$sidebar_position_class.'">',
        	'after_widget' => '</div>',
			'before_title' => '<h6 class="widget-title">',
			'after_title' => '</h6>',
		) );	
		
	  endwhile;	
	  
	}
	
	// End Sidebar Manager Post Type
}

add_action( 'widgets_init', '_widgets_init' );

}


/**
 * Allow shortcodes in text widgets
 *
 * 
 */
add_filter('widget_text', 'shortcode_unautop');
add_filter('widget_text', 'do_shortcode');


if ( ! function_exists( 'morphis_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function morphis_content_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>" class="clearfix">			
			<div class="nav-previous"><?php next_posts_link( __( '&larr; Older posts', 'morphis' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'morphis' ) ); ?></div>
		</nav><!-- #nav-above -->
	<?php endif;
}
endif; // morphis_content_nav

/**
 * Return the URL for the first link found in the post content.
 *
 * 
 * @return string|bool URL or false when no link is present.
 */
if( !function_exists( 'morphis_url_grabber' ) ) {
	function morphis_url_grabber() {
		if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) )
			return false;

		return esc_url_raw( $matches[1] );
	}
}

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 */
if( !function_exists( 'morphis_footer_sidebar_class' ) ) {
	function morphis_footer_sidebar_class() {
		$count = 0;

		if ( is_active_sidebar( 'sidebar-3' ) )
			$count++;

		if ( is_active_sidebar( 'sidebar-4' ) )
			$count++;

		if ( is_active_sidebar( 'sidebar-5' ) )
			$count++;

		$class = '';

		switch ( $count ) {
			case '1':
				$class = 'one';
				break;
			case '2':
				$class = 'two';
				break;
			case '3':
				$class = 'three';
				break;
		}

		if ( $class )
			echo 'class="' . $class . '"';
	}
}

if ( ! function_exists( 'morphis_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own morphis_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * 
 */
function morphis_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'morphis' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'morphis' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment comment-wrap clearfix">
		
			
			<footer class="comment-meta clearfix">
				
					<?php
						$avatar_size = 68;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 39;

						echo '<div class="avatar clearfix">' . get_avatar( $comment, $avatar_size ) . '</div>';
						echo '<div class="meta clearfix">';
						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s on %2$s ', 'morphis'),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'morphis' ), get_comment_date(), get_comment_time() )
							)
							
						);
						edit_comment_link( __( 'Edit', 'morphis' ), '<span class="edit-link">', '</span>' ); 
						?>
					<div class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'morphis' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div><!-- .reply -->
					<?php if ( $comment->comment_approved == '0' ) : ?>
						<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'morphis' ); ?></em>
						<br />
					<?php endif; ?>
					<?php
						echo '</div>';
					?>					
													
				
				<div class="comment-content comment"><?php comment_text(); ?></div>
			

			</footer>
	
			

			
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for morphis_comment()

if ( ! function_exists( '_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * 
 *
 * 
 */
function _posted_on() {

	$posted_on = __( 'Posted on', 'morphis' );
	$by = __( 'by', 'morphis' );
	
	printf( '<span class="sep">' . $posted_on . ' </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> ' . $by . ' </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'morphis' ), get_the_author() ) ),
		get_the_author()
	);
}
endif;

/**
 * Adds two classes to the array of body classes.
 * The first is if the site has only had one author with published posts.
 * The second is if a singular post being displayed
 *
 * 
 */
if( !function_exists( 'morphis_body_classes' ) ) {
	function morphis_body_classes( $classes ) {
		
		global $NHP_Options;

		if ( function_exists( 'is_multi_author' ) && ! is_multi_author() )
			$classes[] = 'single-author';

		if ( is_singular() && ! is_home() )
			$classes[] = 'singular';
			
		// skins classes
		$classes[] = $NHP_Options['select_skin'] . '-skin';	

		return $classes;
	}
	add_filter( 'body_class', 'morphis_body_classes' );
}

/**
 * Include jQuery plugins and libraries.
 *
 *
 */
if( !function_exists( 'wpt_enqueue_scripts' ) ) {
    function wpt_enqueue_scripts() {
	
		global $NHP_Options;
		// get calling page/post 's ID
		$postid = getPostIDFromURL();
		
		// enqueue theme stylesheet
		wp_enqueue_style( 'morphis-styleheet', get_stylesheet_uri() );
		
		// styles enqueue
		// jPlayer
		wp_register_style('morphis-jplayer', get_template_directory_uri() . '/css/jPlayer.css', false, '1.0.0', 'all');		
		wp_enqueue_style('morphis-jplayer');
		// prettyPhoto
		wp_register_style('morphis-prettyphoto', get_template_directory_uri() . '/css/prettyPhoto.css', false, '1.0.0', 'all');		
		wp_enqueue_style('morphis-prettyphoto');
		
		//if( !empty($NHP_Options['option_disable_responsive_grid']) ) {
			$nhp_options_option_disable_responsive_grid = $NHP_Options['option_disable_responsive_grid'];		
			if( !$nhp_options_option_disable_responsive_grid == '1' ) {
				// responsive
				wp_register_style('morphis-responsive', get_template_directory_uri() . '/css/responsive.css', false, '1.0.0', 'all');		
				wp_enqueue_style('morphis-responsive');
			}
		//}
				
		// sliders
		wp_register_style('morphis-eislider', get_template_directory_uri() . '/css/ei-slider.css', false, '1.0.0', 'all');		
		
		$unique_home_slider = get_post_meta($postid,'_cmb_home_slider',TRUE);
		$nhp_options_option_select_slider = $NHP_Options['select_slider'];		
		if($nhp_options_option_select_slider == 'eislider'):
			if($unique_home_slider == 'eislider'):
				wp_enqueue_style('morphis-eislider');
			elseif($unique_home_slider == ''):
				wp_enqueue_style('morphis-eislider');
			else:
			endif;
		elseif($nhp_options_option_select_slider == 'caroufredsel'):
			if($unique_home_slider == 'eislider'):
				wp_enqueue_style('morphis-eislider');
			endif;
		endif;
		
		// theme skins
		$nhp_options_option_select_skins = $NHP_Options['select_skin'];	
		wp_register_style('morphis-themeskins', get_template_directory_uri() . '/css/skins/' . $nhp_options_option_select_skins . '/'. $nhp_options_option_select_skins . '.css', false, '1.0.0', 'all');		
		wp_enqueue_style('morphis-themeskins');	

		// woocommerce style
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
      		//plugin is activated
	  		wp_register_style('woocommerce-style', get_template_directory_uri() . '/css/woocommerce-style.css', false, '1.0.0', 'all');		
   		}		
		wp_enqueue_style('woocommerce-style');
		
		// theme styles	
		global $wp_query;
		$page_id = $wp_query->get_queried_object_id();
		//wp_register_style('morphis-themestyles', home_url() . '/?theme-styles=css&page_id=' . $page_id, false, '1.0.0', 'all');		
		//wp_enqueue_style('morphis-themestyles');
		
		// dynamic stylesheet
		wp_register_style('morphis-dynamic-stylesheet', get_template_directory_uri() . '/css/dynamic.css', false, '1.0.0', 'all');	
		wp_enqueue_style('morphis-dynamic-stylesheet');
		$custom_css = get_custom_css( $page_id );
		wp_add_inline_style( 'morphis-dynamic-stylesheet', $custom_css );
		
        // Register our scripts		
		wp_register_script('jQueryEasing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', 'jquery', '1.3.0', TRUE);				
		wp_register_script('carouFredSel', get_template_directory_uri() . '/js/jquery.carouFredSel.js', 'jquery', '5.5.0', TRUE);		
		wp_register_script('prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', 'jquery', '3.1.3', TRUE);
		wp_register_script('jFlickrFeed', get_template_directory_uri() . '/js/jflickrfeed.min.js', 'jquery', '1.0.0', TRUE);
		wp_register_script('hoverIntent', get_template_directory_uri() . '/js/jquery.hoverIntent.minified.js');
		wp_register_script('jPlayer', get_template_directory_uri() . '/js/jquery.jplayer.min.js', 'jquery', '2.1.0', TRUE);
		wp_register_script('quicksand', get_template_directory_uri() . '/js/jquery.quicksand.js', 'jquery', '1.2.2', TRUE);
		wp_register_script('animaterotate', get_template_directory_uri() . '/js/jquery-animate-css-rotate-scale.js');
		wp_register_script('jquerycsstransform', get_template_directory_uri() . '/js/jquery-css-transform.js');
		wp_register_script('wpt_custom', get_template_directory_uri() . '/js/script.js', 'jquery', '1.0', TRUE);
		wp_register_script('wpt_custom_quicksand', get_template_directory_uri() . '/js/custom.quicksand.js', 'jquery', '1.0', TRUE);
		wp_register_script('modernizr', get_template_directory_uri() . '/js/libs/modernizr-2.6.2.min.js', 'jquery', '2.6.2', TRUE);
		wp_register_script('fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', 'jquery', '1.0', TRUE);
		wp_register_script('tabs', get_template_directory_uri() . '/js/tabs.js', 'jquery', '1.0', TRUE);
		wp_register_script('eislider', get_template_directory_uri() . '/js/jquery.eislideshow.js', 'jquery', '1.0', TRUE);
		wp_register_script('masonry', get_template_directory_uri() . '/js/jquery.masonry.min.js', 'jquery', '2.1.05', TRUE);	
		wp_register_script('spectragram', get_template_directory_uri() . '/js/spectragram.min.js', 'jquery', '1.0.0', TRUE);	
		wp_register_script('imagesloaded', get_template_directory_uri() . '/js/jquery.imagesloaded.min.js', 'jquery', '1.0.0', TRUE);
		wp_enqueue_script('spectragram');	
				
		// home page sliders
		// get unique page slider
		$postID = pf_current_ID();
		$unique_selected_slider = get_post_meta($postID,'_cmb_home_slider',TRUE); 		
		$nhp_options_home_slider = $NHP_Options['select_slider'];		
		if( is_page_template( 'template-home.php' ) ) :
			if( $nhp_options_home_slider == 'eislider' ) :
				if($unique_selected_slider == '' || $unique_selected_slider == 'eislider') :
					wp_enqueue_script('eislider');					
				endif;				
			elseif( $nhp_options_home_slider == 'caroufredsel' ) :
				if($unique_selected_slider == '' || $unique_selected_slider == 'caroufredsel') :					
				elseif( $unique_selected_slider == 'eislider' ):
					wp_enqueue_script('eislider');					
				endif;	
			elseif( $nhp_options_home_slider == 'layerslider' ) :
				if($unique_selected_slider == '' || $unique_selected_slider == 'layerslider') :					
				elseif( $unique_selected_slider == 'eislider' ):
					wp_enqueue_script('eislider');					
				endif;	
			endif;		
		endif;
		
		// load masonry
		if( is_home() || is_page_template( 'template-home-masonry.php' ) ) :
			wp_enqueue_script('masonry');												
		endif;
	
		wp_enqueue_script('carouFredSel');	
				
		// Enqueue our scripts
    	wp_enqueue_script('jquery');    	    	
    	wp_enqueue_script('jQueryEasing');    	    			
		//wp_enqueue_script('scrollTo');
		wp_enqueue_script('hoverIntent');
		
		// load jPlayer on page with post format video and audio
		if( is_home() || is_page_template( 'template-home.php' ) || is_page_template( 'template-blog.php' ) || (is_page_template( 'portfolio.php' )) || ( 'portfolio' == get_post_type() ) || has_post_format('video') || has_post_format('audio') || is_page_template( 'template-home-masonry.php' ) ) :
				wp_enqueue_script('jPlayer');
		endif;		
		
		// load portfolio scripts: quicksand, 
		if( is_page_template( 'portfolio.php' ) ):
			wp_enqueue_script('quicksand');
			wp_enqueue_script('animaterotate');
			wp_enqueue_script('jquerycsstransform');
			wp_enqueue_script('wpt_custom_quicksand');	
		endif;		
					
		wp_enqueue_script('modernizr');
		wp_enqueue_script('prettyPhoto');
		wp_enqueue_script('fitvids');		
		wp_enqueue_script('jFlickrFeed');
		
		if( function_exists( 'is_woocommerce' ) ) {
			if (!is_woocommerce()) {
				wp_enqueue_script('tabs');						
			}
		} else {
			wp_enqueue_script('tabs');	
		}
		
		// load single scripts only on single pages
        if( is_singular() ) wp_enqueue_script( 'comment-reply' );
		
		// Get Theme Options
		
		$enableSlider = $NHP_Options['toggleSlider'];		
			
		// Load the custom slider settings.			
		$enableSlider = true;
		$slidePauseDuration = $NHP_Options['slidePauseDuration'];
		$slideDuration = $NHP_Options['slideDuration'];
		$animationEasing = $NHP_Options['animationEasing'];
		$animationEffect = $NHP_Options['animationEffect'];						
		$go_to_string = __( 'Go to...', 'morphis' );
		$nhp_options_responsive_grids = '0';
		//if( !empty( $NHP_Options['option_disable_responsive_grid'] ) ) {
			$nhp_options_responsive_grids = $NHP_Options['option_disable_responsive_grid'];
		//}
		// Assign Values for Slider Settings
		$data = array(
					'duration' => $slideDuration, 
					'pauseDuration' => $slidePauseDuration, 
					'easing' => $animationEasing, 
					'fx' => $animationEffect,
					'responsive' => $nhp_options_responsive_grids,
					'go_to_string' => $go_to_string,
		);	
		
		wp_localize_script( 'wpt_custom', 'caroufredsel_slider_settings', $data );		
		
		//Rounding of images			
		$disableRounding = isset( $NHP_Options['disable_rounding'] ) ? $NHP_Options['disable_rounding'] : '0';
		$data_rounding = array('imageRounding' => $disableRounding);
		wp_localize_script( 'wpt_custom', 'roundThisBlog', $data_rounding );
		
		// Load Custom Scripts
		wp_enqueue_script('wpt_custom');
		wp_enqueue_script('imagesloaded');
		
    }    
	
	
    add_action('wp_enqueue_scripts', 'wpt_enqueue_scripts');
}


/*	Register and load custom meta box javascript */

if( !function_exists( 'custom_meta_box_js' ) ) {
    function custom_meta_box_js($hook) {
    	if ($hook == 'post.php' || $hook == 'post-new.php') {
    		wp_register_script('custom_meta_box', get_template_directory_uri() . '/custom/jquery.custom.meta.js', 'jquery');
    		wp_enqueue_script('custom_meta_box');
    	}
    }
    
    add_action('admin_enqueue_scripts','custom_meta_box_js',10,1);
}


/**
 * Slides Post Type.
 *
 *
 */
 
if( !function_exists( 'register_cpt_slide' ) ) {
add_action( 'init', 'register_cpt_slide' );

function register_cpt_slide() {

    $labels = array( 
        'name' => _x( 'Slides', 'noun', 'morphis' ),
        'singular_name' => _x( 'Slide', 'noun', 'morphis' ),
        'add_new' => _x( 'Add New', 'verb', 'morphis' ),
        'add_new_item' => _x( 'Add New Slide', 'verb', 'morphis' ),
        'edit_item' => _x( 'Edit Slide', 'verb', 'morphis' ),
        'new_item' => _x( 'New Slide', 'noun', 'morphis' ),
        'view_item' => __( 'View Slide', 'verb', 'morphis' ),
        'search_items' => _x( 'Search Slides', 'verb', 'morphis' ),
        'not_found' => _x( 'No slides found', 'noun', 'morphis' ),
        'not_found_in_trash' => _x( 'No slides found in Trash', 'noun', 'morphis' ),
        'parent_item_colon' => _x( 'Parent Slide:', 'noun', 'morphis' ),
        'menu_name' => _x( 'Slides', 'noun', 'morphis' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => __('A Custom Post Type for creating image slides', 'morphis'),
        'supports' => array( 'title', 'thumbnail' ),
        
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        
        
        'show_in_nav_menus' => false,
        'publicly_queryable' => false,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'slide', $args );
}
}

/**
 * Portfolio Post Type.
 *
 *
 */
if( !function_exists( 'register_cpt_portfolio' ) ) {
add_action( 'init', 'register_cpt_portfolio' );

function register_cpt_portfolio() {

	global $NHP_Options, $morphis_is_admin;	
	
	if( $morphis_is_admin ) {
		$portfolio_slug_name = $NHP_Options->get('portfolio_slug_name');
	} else {
		$portfolio_slug_name = $NHP_Options['portfolio_slug_name'];
	}
	
	if(empty($portfolio_slug_name)):
		$portfolio_slug_name = 'portfolios';
	endif;

    $labels = array( 
        'name' => _x( 'Portfolios', 'noun', 'morphis' ),
        'singular_name' => _x( 'Portfolio', 'noun', 'morphis' ),
        'add_new' => _x( 'Add New', 'verb', 'morphis' ),
        'add_new_item' => _x( 'Add New Portfolio', 'verb', 'morphis' ),
        'edit_item' => _x( 'Edit Portfolio', 'verb', 'morphis' ),
        'new_item' => _x( 'New Portfolio', 'noun', 'morphis' ),
        'view_item' => __( 'View Portfolio', 'noun', 'morphis' ),
        'search_items' => _x( 'Search Portfolios', 'verb', 'morphis' ),
        'not_found' => _x( 'No slides found', 'noun', 'morphis' ),
        'not_found_in_trash' => _x( 'No slides found in Trash', 'noun', 'morphis' ),
        'parent_item_colon' => _x( 'Parent Portfolio:', 'noun', 'morphis' ),
        'menu_name' => _x( 'Portfolio', 'noun', 'morphis' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => __('A Custom Post Type for creating portfolio items', 'morphis'),
        'supports' => array( 'title', 'thumbnail' ),
        
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        
        
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array('slug' => $portfolio_slug_name),
        'capability_type' => 'post'
    );

	$labels_portfolio_cats = array(
		'name' => _x( 'Portfolio Categories', 'taxonomy general name', 'morphis' ),
		'singular_name' => _x( 'Portfolio Category', 'taxonomy singular name', 'morphis' ),
		'search_items' =>  __( 'Search Portfolio Category', 'morphis' ),
		'all_items' => __( 'All Portfolio Categories', 'morphis' ),
		'parent_item' => __( 'Parent Portfolio Category', 'morphis' ),
		'parent_item_colon' => __( 'Parent Portfolio Category:', 'morphis' ),
		'edit_item' => __( 'Edit Portfolio Category', 'morphis' ), 
		'update_item' => __( 'Update Portfolio Category', 'morphis' ),
		'add_new_item' => __( 'Add New Portfolio Category', 'morphis' ),
		'new_item_name' => __( 'New Portfolio Category Name', 'morphis' ),
		'menu_name' => __( 'Portfolio Category', 'morphis' ),
	  ); 
	  
	  $labels_skills_cats = array(
		'name' => _x( 'Portfolio Skills', 'taxonomy general name', 'morphis' ),
		'singular_name' => _x( 'Portfolio Skills', 'taxonomy singular name', 'morphis' ),
		'search_items' =>  __( 'Search Portfolio Skills', 'morphis' ),
		'all_items' => __( 'All Portfolio Skills', 'morphis' ),
		'parent_item' => __( 'Parent Portfolio Skills', 'morphis' ),
		'parent_item_colon' => __( 'Parent Portfolio Skills:', 'morphis' ),
		'edit_item' => __( 'Edit Portfolio Skills', 'morphis' ), 
		'update_item' => __( 'Update Portfolio Skills', 'morphis' ),
		'add_new_item' => __( 'Add New Portfolio Skills', 'morphis' ),
		'new_item_name' => __( 'New Portfolio Skills Name', 'morphis' ),
		'menu_name' => __( 'Portfolio Skills', 'morphis' ),
	  ); 
	
    register_post_type( 'portfolio', $args );
	flush_rewrite_rules();
	register_taxonomy("Skills", array("portfolio"), array("hierarchical" => true, "label" => __("Skills", "morphis"), "labels" => $labels_skills_cats, "singular_label" => __("Skill", "morphis"), "rewrite" => true));
	register_taxonomy("Categories", array("portfolio"), array("hierarchical" => true, "label" => __("Categories", "morphis"), "labels" => $labels_portfolio_cats, "singular_label" => __("Category", "morphis"), "rewrite" => true));
	
}
}

/**
 * Services Post Type.
 *
 *
 */
if( !function_exists( 'register_cpt_services' ) ) {
add_action( 'init', 'register_cpt_services' );

function register_cpt_services() {

    $labels = array( 
        'name' => _x( 'Services', 'noun', 'morphis' ),
        'singular_name' => _x( 'Service', 'noun', 'morphis' ),
        'add_new' => _x( 'Add New', 'verb', 'morphis' ),
        'add_new_item' => _x( 'Add New Service', 'verb', 'morphis' ),
        'edit_item' => _x( 'Edit Service', 'verb', 'morphis' ),
        'new_item' => _x( 'New Service', 'noun', 'morphis' ),
        'view_item' => __( 'View Service', 'verb', 'morphis' ),
        'search_items' => _x( 'Search Services', 'verb', 'morphis' ),
        'not_found' => _x( 'No services found', 'noun', 'morphis' ),
        'not_found_in_trash' => _x( 'No services found in Trash', 'noun', 'morphis' ),
        'parent_item_colon' => _x( 'Parent services:',  'noun', 'morphis' ),
        'menu_name' => _x( 'Services', 'noun', 'morphis' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => __('A Custom Post Type for creating services boxes in the Home Page.', 'morphis'),
        'supports' => array( 'title' ),
        
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        
        
        'show_in_nav_menus' => false,
        'publicly_queryable' => false,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'services', $args );
}
}


/**
 * Sidebar Manager Post Type.
 *
 *
 */
if( !function_exists( 'register_cpt_sidebar_manager' ) ) {
add_action( 'init', 'register_cpt_sidebar_manager' );

function register_cpt_sidebar_manager() {

    $labels = array( 
        'name' => _x( 'Sidebar Manager', 'noun', 'morphis' ),
        'singular_name' => _x( 'Sidebar', 'noun', 'morphis' ),
        'add_new' => _x( 'Add New', 'verb', 'morphis' ),
        'add_new_item' => _x( 'Add New Sidebar Area', 'verb', 'morphis' ),
        'edit_item' => _x( 'Edit Sidebar Area', 'verb', 'morphis' ),
        'new_item' => _x( 'New Sidebar Area', 'noun', 'morphis' ),
        'view_item' => __( 'View Sidebar Area', 'verb', 'morphis' ),
        'search_items' => _x( 'Search Sidebar Area', 'verb', 'morphis' ),
        'not_found' => _x( 'No Sidebar Area found', 'noun', 'morphis' ),
        'not_found_in_trash' => _x( 'No Sidebar Area found in Trash', 'noun', 'morphis' ),
        'parent_item_colon' => _x( 'Parent Sidebar Area:',  'noun', 'morphis' ),
        'menu_name' => _x( 'Sidebar Manager', 'noun', 'morphis' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => __('A Custom Post Type for creating Sidebar Areas.', 'morphis'),
        'supports' => array( 'title' ),
        
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        
        
        'show_in_nav_menus' => false,
        'publicly_queryable' => false,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'sidebar_manager', $args );
}
}

/* 
 * Custom Metaboxes and Fields 
 *
 */
 if( !function_exists( 'metaboxes' ) ) {
$prefix = '_cmb_'; // Prefix for all fields
function metaboxes( $meta_boxes ) {
	global $prefix;
	
	// meta boxes for Portfolio Settings
	$meta_boxes[] = array(
		'id' => 'portfolio_settings',
		'title' => __('Portfolio Settings', 'morphis'),
		'pages' => array('portfolio'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => __('Client Name', 'morphis'),
				'desc' => __('Enter portfolio client (optional)', 'morphis'),
				'id' => $prefix . 'client_name',
				'type' => 'text'
			),
			array(
				'name' => __('Date Completed', 'morphis'),
				'desc' => __('Select date the project was completed. (optional)', 'morphis'),
				'id'   => $prefix . 'date_completed',
				'type' => 'text_date',
			),			
			array(
				'name' => __('Information about the project', 'morphis'),
				'desc' => __('Enter some information/description about the project. (optional)', 'morphis'),
				'id'   => $prefix . 'info_desc',
				'type' => 'wysiwyg',
			),
			array(
				'name' => __('Another optional description of the project.', 'morphis'),
				'desc' => __('Enter optional description about the project. (optional)', 'morphis'),
				'id'   => $prefix . 'info_optional_desc',
				'type' => 'wysiwyg',
			),
			array(
				'name' => __('Launch Project Link', 'morphis'),
				'desc' => __('Enter link address to the project. Example: http://www.google.com', 'morphis'),
				'id' => $prefix . 'launch_link',
				'type' => 'text'
			),
			array(
				'name' => __('Optional Link to Page', 'morphis'),
				'desc' => __('Enter link address, when clicked, for this portfolio. Example: http://www.yoursite.com/page/', 'morphis'),
				'id' => $prefix . 'optional_link_page',
				'type' => 'text'
			),			
		),
	);
	
	// metabox for uploading square crops
	$meta_boxes[] = array(
		'id' => 'featured_lightbox_image',
		'title' => __('Uncropped Featured Image Lightbox Upload', 'morphis'),
		'pages' => array('portfolio', 'post'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => __('Uncropped Lightbox Image', 'morphis'),
				'desc' => __('Upload the <strong>uncropped</strong> image or enter an URL for use on this item\'s lightbox. You should upload the <strong>square cropped</strong> version of this image to the <strong>Featured Image/Post Thumbnails</strong> feature.', 'morphis'),
				'id'   => $prefix . 'feature_uncropped_image',
				'type' => 'file',
			)			
		),
	);
	
	// meta boxes for Portfolio Attribute Settings
	$meta_boxes[] = array(
		'id' => 'portfolio__attributes_settings',
		'title' => __('Portfolio User-defined Sidebar Attribute Names Settings', 'morphis'),
		'pages' => array('portfolio'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => __('Client Name', 'morphis'),
				'desc' => __('Enter any text name you want for this attribute. Example: Company Name, Photograper, Artist, etc.', 'morphis'),
				'id' => $prefix . 'client_name_att',
				'type' => 'text_medium',
				'std' => __( 'Client Name', 'morphis' ),
			),
			array(
				'name' => __('Date Completed', 'morphis'),
				'desc' => __('Enter any text name you want for this attribute. Example: Date Hired, Date Submitted, Date of Shoot, etc.', 'morphis'),
				'id' => $prefix . 'date_completed_att',
				'type' => 'text_medium',
				'std' => __( 'Date Completed', 'morphis' ),
			),
			array(
				'name' => __('Skills & Technologies', 'morphis'),
				'desc' => __('Enter any text name you want for this attribute. Example: Materials Used, Instruments, Camera Model, etc.', 'morphis'),
				'id' => $prefix . 'skills_tech_att',
				'type' => 'text_medium',
				'std' => __( 'Skills &amp; Technologies', 'morphis' ),
			),
			array(
				'name' => __('Categories', 'morphis'),
				'desc' => __('Enter any text name you want for category attribute of Portfolio. Example: Event, Promo, Genre, etc.', 'morphis'),
				'id' => $prefix . 'categories_att',
				'type' => 'text_medium',
				'std' => __( 'Categories', 'morphis' ),
			),
			array(
				'name' => __('Launch Project', 'morphis'),
				'desc' => __('Enter any text name you want for the project link attribute. Example: Go to Website, Launch, View Website, etc.', 'morphis'),
				'id' => $prefix . 'launch_project_att',
				'type' => 'text_medium',
				'std' => __( 'Launch Project', 'morphis' ),
			),
		),
	);
	
	
	// meta boxes for Portfolio Attachments
	$meta_boxes[] = array(
		'id' => 'portfolio_attachment',
		'title' => __('Portfolio Attachment', 'morphis'),
		'pages' => array('portfolio'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name'    => __('Select Attachment', 'morphis'),
				'desc'    => __('Select which media attachment for this portfolio.', 'morphis'),
				'id'      => $prefix . 'select_attachment',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('Image', 'morphis'), 'value' => 'image', ),
					array( 'name' => __('Multiple Image', 'morphis'), 'value' => 'multiple_image', ),
					array( 'name' => __('Slideshow', 'morphis'), 'value' => 'slideshow', ),
					array( 'name' => __('Vimeo Video', 'morphis'), 'value' => 'vimeo', ),
					array( 'name' => __('Youtube Video', 'morphis'), 'value' => 'youtube', ),
				),
			),
			array(
				'name' => __('Image Attachment', 'morphis'),
				'desc' => __('Upload an image or enter an URL. Best to have an image with a minimum width of 700px.', 'morphis'),
				'id'   => $prefix . 'attachment_image',
				'type' => 'file',
			),
			array(
				'name'    => __('Multiple Image Attachment', 'morphis'),
				'desc'    => __('Click <b>Upload/Insert</b> link to upload your images. Then select the <b>\'Gallery\'</b> tab and click <b>\'Insert Gallery\'</b>.  Best to have an image with a minimum width of 700px.', 'morphis'),
				'id'      => $prefix . 'attachment_multiple_images',
				'type'    => 'wysiwyg',
				'options' => array(	'textarea_rows' => 12, ),
			),
			array(
				'name' => __('Vimeo Video Embed Code', 'morphis'),
				'desc' => __('Enter Vimeo video embed code.', 'morphis'),
				'id'   => $prefix . 'attachment_vimeo',
				'type' => 'textarea',
			),
			array(
				'name' => __('Youtube Video Embed Code', 'morphis'),
				'desc' => __('Enter Youtube video embed code.', 'morphis'),
				'id'   => $prefix . 'attachment_youtube',
				'type' => 'textarea',
			),
			array(
				'name'    => __('Slideshow Gallery Attachment', 'morphis'),
				'desc'    => __('Click <b>Upload/Insert</b> link to upload your images. Then select the <b>\'Gallery\'</b> tab and click <b>\'Insert Gallery\'</b>.  Best to have an image with a minimum width of 700px.', 'morphis'),
				'id'      => $prefix . 'attachment_slideshow',
				'type'    => 'wysiwyg',
				'options' => array(	'textarea_rows' => 12, ),
			),
		),
	);
	
	// meta boxes for Slides
	$meta_boxes[] = array(
		'id' => 'slides_setting',
		'title' => __('Slide Image Settings', 'morphis'),
		'pages' => array('slide'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(			
			array(
				'name' => __('Slide Image', 'morphis'),
				'desc' => __('Upload an image or enter an URL. Optimal size should be 1600px x 500px.', 'morphis'),
				'id'   => $prefix . 'slide_image_upload',
				'type' => 'file',
			),
			array(
				'name' => __('Slide Video', 'morphis'),
				'desc' => __('Enter a <b>Vimeo Video ID</b> or <b>YouTube embed video link</b>. <span style="color: blue;">Example</span>: <strong>Vimeo</strong> (<span style="color: red;">use Vimeo ID</span>)- <i><span style="color: green;">47100629</span></i>; <strong>Youtube</strong> - <i><span style="color: green;">http://youtu.be/9eqK5_k1GtA</span></i>. This will override the <strong>Slide Image</strong> option from above', 'morphis'),
				'id'   => $prefix . 'slide_video_upload',
				'type' => 'text',
			),
			array(
				'name' => __('Main Caption', 'morphis'),
				'desc' => __('Enter the main caption for this slide.', 'morphis'),
				'id'   => $prefix . 'main_caption',
				'type' => 'text',
			),
			array(
	            'name' => __('Main Caption Color', 'morphis'),
	            'desc' => __('Set the color for this caption', 'morphis'),
	            'id'   => $prefix . 'main_caption_color',
	            'type' => 'colorpicker',
				'std'  => '#ffffff'
	        ),
			array(
				'name' => __('Secondary Caption', 'morphis'),
				'desc' => __('Enter the secondary caption for this slide.', 'morphis'),
				'id'   => $prefix . 'secondary_caption',
				'type' => 'text',
			),
			array(
	            'name' => __('Secondary Caption Color', 'morphis'),
	            'desc' => __('Set the color for this caption', 'morphis'),
	            'id'   => $prefix . 'sec_caption_color',
	            'type' => 'colorpicker',
				'std'  => '#ffffff'
	        ),
			array(
				'name' => __('Link Caption', 'morphis'),
				'desc' => __('Type the link caption for this slide. This is used for the <b>carouFredsel</b> slider only. (Optional)', 'morphis'),
				'id'   => $prefix . 'link_caption',
				'type' => 'text',
			),
			array(
				'name' => __('Link Address', 'morphis'),
				'desc' => __('Type the link address (href) for this slide. Example: http://www.google.com.', 'morphis'),
				'id'   => $prefix . 'link_address',
				'type' => 'text',
			),
			array(
				'name' => __('Disable Dot Overlay', 'morphis'),
				'desc' => __('You can disable the dots overlay from the image. This is used for the <b>ei slider</b> only.', 'morphis'),
				'id'   => $prefix . 'toggle_dot_overlay',
				'type' => 'checkbox'				
			),
		),
	);
	
	// meta boxes for Services Post Type
	$meta_boxes[] = array(
		'id' => 'services_setting',
		'title' => __('Services Settings', 'morphis'),
		'pages' => array('services'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(			
			array(
				'name' => __('Service Image Icon', 'morphis'),
				'desc' => __('Upload an image or enter an URL.', 'morphis'),
				'id'   => $prefix . 'service_image_upload',
				'type' => 'file',
			),
			array(
				'name' => __('Service Image URL', 'morphis'),
				'desc' => __('The URL link when the Service Image is clicked. Example: http://google.com', 'morphis'),
				'id'   => $prefix . 'service_link_image_upload',
				'type' => 'text',
			),
			array(
				'name' => __('Service Description', 'morphis'),
				'desc' => __('Enter service description', 'morphis'),
				'id'   => $prefix . 'service_description',
				'type' => 'textarea_code',
			),
		),
	);
	
	global $layerslider;
	// meta boxes for Pages 
	$meta_boxes[] = array(
		'id' => 'headline_box',
		'title' => __('Home Page Settings', 'morphis'),
		'pages' => array('page'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => __('Home Page Slider', 'morphis'),
				'desc' => __('Choose your slider for the homepage', 'morphis'),
				'id'   => $prefix . 'home_slider',
				'type' => 'select',
				'options' => array(
					array( 'name' => '', 'value' => '', ),
					array( 'name' => __('EI Slider', 'morphis'), 'value' => 'eislider', ),
					array( 'name' => __('CarouFredSel Slider', 'morphis'), 'value' => 'caroufredsel', ),
					array( 'name' => __( 'LayerSlider', 'morphis' ), 'value' => 'layerslider' ),
				),
				'std' => ''
			),		
			array(
				'name'    => __('Layer Slider ID', 'morphis'),
				'desc'    => __('Enter the LayerSlider </strong>ID</strong> to use as the slider. Example: 1', 'morphis'),
				'id'      => $prefix . 'layer_slider_id',
				'type'    => 'text_small',
			),
			array(
				'name'    => __('Headline Main Caption', 'morphis'),
				'desc'    => __('Enter the Headline\'s main caption. You can use HTML tags.', 'morphis'),
				'id'      => $prefix . 'headline_main_caps',
				'type'    => 'textarea_code',
				'options' => array(	'textarea_rows' => 6, ),
			),
			array(
				'name'    => __('Headline Secondary Caption', 'morphis'),
				'desc'    => __('Enter the Headline\'s optional secondary caption. You can use HTML tags.', 'morphis'),
				'id'      => $prefix . 'headline_sec_caps',
				'type'    => 'textarea_code',
				'options' => array(	'textarea_rows' => 4, ),
			),
			array(
				'name'    => __('Headline Paragraph', 'morphis'),
				'desc'    => __('Enter the Headline\'s optional paragraph content. This is useful when you want to say something about your company. You can use HTML tags.', 'morphis'),
				'id'      => $prefix . 'headline_para',
				'type'    => 'textarea_code',
				'options' => array(	'textarea_rows' => 8, ),
			),
		),
	);
	
	// meta box for Post: Link post format 
	$meta_boxes[] = array(
		'id' => 'link_pf_settings',
		'title' => __('Link Post Format Settings', 'morphis'),
		'pages' => array('post'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(			
			array(
				'name' => __('URL', 'morphis'),
				'desc' => __('Insert the URL Address you wish to link to.', 'morphis'),
				'id'   => $prefix . 'link_pf_url',
				'type' => 'text',
			),
		),
	);
	
	// meta box for Post: Video post format 
	$meta_boxes[] = array(
		'id' => 'video_pf_settings',
		'title' => __('Video Post Format Settings', 'morphis'),
		'pages' => array('post'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(			
			array(
				'name' => __('Video Height', 'morphis'),
				'desc' => __('Your video height. Example: 350.', 'morphis'),
				'id'   => $prefix . 'video_pf_height',
				'type' => 'text_small',
			),
			array(
				'name' => __('M4V Video File Upload', 'morphis'),
				'desc' => __('Upload or enter the URL of your M4V video file. <a href="http://jplayer.org/latest/developer-guide/#jPlayer-fundamentals" target="_blank">See why you have to include M4V video format.</a>', 'morphis'),
				'id'   => $prefix . 'video_pf_m4v',
				'type' => 'file',
			),
			array(
				'name' => __('OGV Video File Upload', 'morphis'),
				'desc' => __('Upload or enter the URL of your OGV video file.', 'morphis'),
				'id'   => $prefix . 'video_pf_ogv',
				'type' => 'file',
			),
			array(
				'name' => __('WebMV Video File Upload', 'morphis'),
				'desc' => __('Upload or enter the URL of your WEBMV video file.', 'morphis'),
				'id'   => $prefix . 'video_pf_webmv',
				'type' => 'file',
			),
			array(
				'name' => __('Video File Preview', 'morphis'),
				'desc' => __('Upload or enter the URL of the video file preview.', 'morphis'),
				'id'   => $prefix . 'video_pf_file_preview',
				'type' => 'file',
			),
			array(
				'name' => '',
				'desc' => __('<p style="text-align:center;">Or</p>', 'morphis'),
				'id'   => $prefix . 'or_embed',
				'type' => 'title',
			),
			array(
				'name' => __('Embedded Code', 'morphis'),
				'desc' => __('Insert your embed code for video here. You can embed Youtube and Vimeo videos.', 'morphis'),
				'id'   => $prefix . 'video_pf_embedded',
				'type' => 'textarea',
			),
		),
	);
	
		// meta box for Post: Video post format 
	$meta_boxes[] = array(
		'id' => 'audio_pf_settings',
		'title' => __('Audio Post Format Settings', 'morphis'),
		'pages' => array('post'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(						
			array(
				'name' => __('MP3 Audio File Upload', 'morphis'),
				'desc' => __('Upload or enter the URL of your MP3 video file. <a href="http://jplayer.org/latest/developer-guide/#jPlayer-fundamentals" target="_blank">See why you have to include MP3 audio format.</a>', 'morphis'),
				'id'   => $prefix . 'audio_pf_mp3',
				'type' => 'file',
			),
			array(
				'name' => __('OGG Audio File Upload', 'morphis'),
				'desc' => __('Upload or enter the URL of your OGG audio file.', 'morphis'),
				'id'   => $prefix . 'audio_pf_ogg',
				'type' => 'file',
			),
		),
	);
	
	
	// meta box for Post: Image post format 
	$meta_boxes[] = array(
		'id' => 'image_pf_settings',
		'title' => __('Image Post Format Settings', 'morphis'),
		'pages' => array('post'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(			
			array(
				'name' => __('Upload or Enter the URL of your image.', 'morphis'),
				'desc' => __('Upload or type the URL of the image you want for this post.', 'morphis'),
				'id'   => $prefix . 'image_pf_upload',
				'type' => 'file',
			),
		),
	);
	
	// meta box for Post: Status post format 
	$meta_boxes[] = array(
		'id' => 'status_pf_settings',
		'title' => __('Status Post Format Settings', 'morphis'),
		'pages' => array('post'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(			
			array(
				'name' => __('Your Status Message', 'morphis'),
				'desc' => __('Type your Status Message here.', 'morphis'),
				'id'   => $prefix . 'status_pf_message',
				'type' => 'textarea',
			),
		),
	);
	
	// meta box for Post: Quote post format 
	$meta_boxes[] = array(
		'id' => 'quote_pf_settings',
		'title' => __('Quote Post Format Settings', 'morphis'),
		'pages' => array('post'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(			
			array(
				'name' => __('Quote text', 'morphis'),
				'desc' => __('Enter your quote.', 'morphis'),
				'id'   => $prefix . 'quote_pf_text',
				'type' => 'textarea',
			),
			array(
				'name' => __('Quote Cite', 'morphis'),
				'desc' => __('Enter the cite for this quote.', 'morphis'),
				'id'   => $prefix . 'quote_cite_pf_text',
				'type' => 'text',
			),
		),
	);
	
	// meta box for Post: Chat post format 
	$meta_boxes[] = array(
		'id' => 'chat_pf_settings',
		'title' => __('Chat Post Format Settings', 'morphis'),
		'pages' => array('post'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(			
			array(
				'name' => __('Dialogue', 'morphis'),
				'desc' => __('Enter a dialogue (chat). Place a colon(:) after the chat name for every line. <br /> <b>Example</b>: <br /> <em>Tourist: Could you give us directions to Olive Garden?</em> <br /> <em>New Yorker: No, but I could give you directions to an actual Italian restaurant.</em>', 'morphis'),
				'id'   => $prefix . 'chat_pf_text',
				'type' => 'textarea',
			),
		),
	);
	
	// meta box for Aside Post.
	$meta_boxes[] = array(
		'id' => 'aside_pf_settings',
		'title' => __('Aside Post Format Settings', 'morphis'),
		'pages' => array('post'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(			
			array(
				'name' => __('Aside Message', 'morphis'),
				'desc' => __('Enter your Aside post message.</em>', 'morphis'),
				'id'   => $prefix . 'aside_pf_text',
				'type' => 'textarea',
			),
		),
	);
	
	
	// meta box for Contact Page Template.
	$meta_boxes[] = array(
		'id' => 'contact_page_template_mb',
		'title' => __('Contact Form Settings', 'morphis'),
		'pages' => array('page'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(			
			array(
				'name' => __('Recipient Name', 'morphis'),
				'desc' => __('Type the Recipient Name of the email when someone contacts you via the Contact Form.', 'morphis'),
				'id'   => $prefix . 'contact_page_template_mb_recipient_name',
				'type' => 'text',
			),
			array(
				'name' => __('Recipient Email', 'morphis'),
				'desc' => __('This is your email address. This is where you want the contact form to send the message.', 'morphis'),
				'id'   => $prefix . 'contact_page_template_mb_recipient_email',
				'type' => 'text',
			),
			array(
				'name' => __('Name Placeholder Text', 'morphis'),
				'desc' => __('Enter the placeholder text for the name field.', 'morphis'),
				'id'   => $prefix . 'contact_page_template_mb_name_placeholder',
				'type' => 'text',
				'std' => __( 'Your Name here', 'morphis' ),
			),
			array(
				'name' => __('Email Placeholder Text', 'morphis'),
				'desc' => __('Enter the placeholder text for the email field.', 'morphis'),
				'id'   => $prefix . 'contact_page_template_mb_email_placeholder',
				'type' => 'text',
				'std' => 'your@email.com'
			),
			array(
				'name' => __('Message Placeholder Text', 'morphis'),
				'desc' => __('Enter the placeholder text for the message field.', 'morphis'),
				'id'   => $prefix . 'contact_page_template_mb_message_placeholder',
				'type' => 'text',
				'std' => __( 'Your Message Here.', 'morphis' ),
			),
		),
	);
	
	
	// meta box for Unique Page Template layout
	$meta_boxes[] = array(
		'id' => 'page_layout',
		'title' => __('Unique Page Layout Settings', 'morphis'),
		'pages' => array('page', 'product'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(			
			array(
				'name' => __('Blog Post Layout', 'morphis'),
				'desc' => __('Choose Layout for the Blog Template.', 'morphis'),
				'id'   => $prefix . 'page_layout_main',
				'type' => 'select',
				'options' => array(
					array( 'name' => __('Use Default Global Setting', 'morphis'), 'value' => '', ),
					array( 'name' => __('Default Layout', 'morphis'), 'value' => '1', ),
					array( 'name' => __('Small Image Layout', 'morphis'), 'value' => '2', ),
					array( 'name' => __('Full Content Layout', 'morphis'), 'value' => '3', )
				),
			),			
			array(
				'name' => __('Sidebar Layout', 'morphis'),
				'desc' => __('Choose Sidebar Layout for this page.', 'morphis'),
				'id'   => $prefix . 'page_layout_sidebar',
				'type' => 'select',
				'options' => array(
					array( 'name' => __('Use Default Global Setting', 'morphis'), 'value' => 'default_sidebar', ),
					array( 'name' => __('Right Sidebar', 'morphis'), 'value' => 'right_sidebar', ),
					array( 'name' => __('Left Sidebar', 'morphis'), 'value' => 'left_sidebar', ),
					array( 'name' => __('Full Width - No Sidebar', 'morphis'), 'value' => 'no_sidebar', )
				),
			),	
			array(
				'name'    => __('Exclude Category(s)', 'morphis'),
				'desc'    => sprintf( __('Choose which Categories you want to exclude for showing in the Blog Page Template (Blog Archive). If you are not seeing anything here, you should add <b>Categories</b> and categorize each of your Post items first. <a href="%sedit-tags.php?taxonomy=category">Click here</a> to add categories.', 'morphis'), admin_url() ),
				'id'      => $prefix . 'exclude_post_cat_multi',
				'type'    => 'multicheck',
				'options' => getPortfolioTaxonomies('category'),
			),
		),
	);
	
	// Unique Sidebars
	$meta_boxes[] = array(
		'id' => 'unique_page_sidebars',
		'title' => __('Unique Page Sidebar Settings', 'morphis'),
		'pages' => array('page', 'product', 'post'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(			
			array(
				'name' => __('Page Sidebar', 'morphis'),
				'desc' => sprintf( __('Select the sidebar you want to use. You can create your <b>Sidebar Area</b> using the <a href="%1$sedit.php?post_type=sidebar_manager">Sidebar Manager</a> and then drag-drop your widgets on your created <b>Sidebar Area</b> on the <a href="%1$swidgets.php">Widgets Management Page</a>.', 'morphis'), admin_url() ),
				'id'   => $prefix . 'page_sidebar',
				'type' => 'select',
				'options' => getAllCustomSidebars()
			)
		),
	);
	
	
	// meta box for Portfolio Page Template layout
	$meta_boxes[] = array(
		'id' => 'portfolio_page_layout',
		'title' => __('Portfolio Page Layout Settings', 'morphis'),
		'pages' => array('page'), // post type
		'desc' => __('This will overide the Global Post Settings from the Theme Options.', 'morphis'),
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(			
			array(
				'name' => __('Portfolio Column Layout', 'morphis'),
				'desc' => __('Choose Layout for the Portfolio.', 'morphis'),
				'id'   => $prefix . 'portfolio_column_layout',
				'type' => 'select',
				'options' => array(
					array( 'name' => __('Use Global Portfolio Settings', 'morphis'), 'value' => '', ),
					array( 'name' => __('4 Columns', 'morphis'), 'value' => '1', ),
					array( 'name' => __('3 Columns', 'morphis'), 'value' => '2', ),
					array( 'name' => __('2 Columns', 'morphis'), 'value' => '3', ),
					array( 'name' => __('3 Columns w/ Sidebar', 'morphis'), 'value' => '4', )
				),
				'std' => ''
			),			
			array(
				'name' => __('Portfolio Page show the most', 'morphis'),
				'desc' => __('The Portfolio Page template supports pagination. Enter how many portfolio items per page will show the most. This must be numeric.', 'morphis'),
				'id'   => $prefix . 'portfolio_show_the_most',
				'type' => 'text_small',
				'std' => '',
			),	
			array(
				'name'    => __('Exclude Portfolio Category', 'morphis'),
				'desc'    => sprintf( __('Choose which Portfolio Categories you want to exclude for showing in the Portfolio Page Template. If you are not seeing anything here, you should add <b>Portfolio Categories</b> and categorize each of your portfolio item first. <a href="%sedit-tags.php?taxonomy=Categories&post_type=portfolio">Click here</a> to add categories.', 'morphis'), admin_url() ),
				'id'      => $prefix . 'exclude_portfolio_cat_multi',
				'type'    => 'multicheck',
				'options' => getPortfolioTaxonomies('Categories'),
			),
			array(
				'name'    => __('Portfolio Slogan/Headline', 'morphis'),
				'desc'    => __('Enter the Portfolio Page\'s Slogan/Headline. You can use HTML tags.', 'morphis'),
				'id'      => $prefix . 'portfolio_headline',
				'type'    => 'textarea_code',
				'options' => array(	'textarea_rows' => 6, ),
			),
			array(
				'name'    => __('Portfolio Description', 'morphis'),
				'desc'    => __('Enter the Headline\'s optional description. You can use HTML tags.', 'morphis'),
				'id'      => $prefix . 'portfolio_headline_desc',
				'type'    => 'textarea_code',
				'options' => array(	'textarea_rows' => 4, ),
			),
		),
	);
	
	
	// meta box for Posts Layout
	$meta_boxes[] = array(
		'id' => 'post_layout',
		'title' => __('Post Layout Settings', 'morphis'),
		'pages' => array('post'), // post type
		'desc' => __('This will overide the Global Post Settings from the Theme Options.', 'morphis'),
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(			
			array(
				'name' => __('Single Post Layout', 'morphis'),
				'desc' => __('Choose Layout for the single post.', 'morphis'),
				'id'   => $prefix . 'post_single_layout',
				'type' => 'select',
				'options' => array(
					array( 'name' => __('Use Global Portfolio Settings', 'morphis'), 'value' => '', ),
					array( 'name' => __('2 Column Layout', 'morphis'), 'value' => '1', ),
					array( 'name' => __('3 Column Layout', 'morphis'), 'value' => '2', )									
				),
				'std' => ''
			),
			array(
				'name' => __('Sidebar Layout', 'morphis'),
				'desc' => __('Choose Sidebar Layout for this post.', 'morphis'),
				'id'   => $prefix . 'post_single_layout_sidebar',
				'type' => 'select',
				'options' => array(
					array( 'name' => __('Use Default Global Setting', 'morphis'), 'value' => 'default_sidebar', ),
					array( 'name' => __('Right Sidebar', 'morphis'), 'value' => 'right_sidebar', ),
					array( 'name' => __('Left Sidebar', 'morphis'), 'value' => 'left_sidebar', ),
					array( 'name' => __('Full Width - No Sidebar', 'morphis'), 'value' => 'no_sidebar', )
				),
			),	
		),
	);
	
	// meta box for Home - Masonry Page Template
	$meta_boxes[] = array(
		'id' => 'masonry_page_layout',
		'title' => __('Masonry Layout Settings', 'morphis'),
		'pages' => array('page'), // post type
		'desc' => __('Set up your Masonry layout settings', 'morphis'),
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(			
			array(
				'name'    => __('Items Select', 'morphis'),
				'desc'    => __('Here you can select whether <b>Portfolio Items</b> or <b>Post Items</b> will be shown on the Masonry page. (optional)', 'morphis'),
				'id'      => $prefix . 'masonry_items_select',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('Post Items', 'morphis'), 'value' => 'post', ),
					array( 'name' => __('Portfolio Items', 'morphis'), 'value' => 'portfolio', )
				),
				'std' => 'portfolios'
			),		
			array(
				'name' => __('No. of Posts to Show', 'morphis'),
				'desc' => __('The Masonry layout gets all the latest posts or portfolios. Here, you can set how many posts to show.', 'morphis'),
				'id'   => $prefix . 'masonry_show_the_most',
				'type' => 'text',
				'type' => 'text_small',
				'std' => '15'
			),						
			array(
				'name'    => __('Exclude Posts Categories', 'morphis'),
				'desc'    => sprintf( __('Choose which Categories you want to exclude for showing in the Home Page - Masonry Page Template. If you are not seeing anything here, you should add <b>Categories</b> for your posts and categorize each of your post items first. <a href="%sedit-tags.php?taxonomy=category">Click here</a> to add categories.', 'morphis') , admin_url() ),
				'id'      => $prefix . 'exclude_masonry_cat_multi',
				'type'    => 'multicheck',
				'options' => getPostCategories(),
			),
			array(
				'name'    => __('Exclude Portfolio Items Categories', 'morphis'),
				'desc'    => sprintf( __('Choose which Categories you want to exclude for showing in the Home Page - Masonry Page Template. If you are not seeing anything here, you should add <b>Portfolio Categories</b> for your portfolios and categorize each of your portfolio items first. <a href="%sedit-tags.php?taxonomy=Categories&post_type=portfolio">Click here</a> to add Portfolio Categories.', 'morphis'), admin_url() ),
				'id'      => $prefix . 'exclude_masonry_portfolio_cat_multi',
				'type'    => 'multicheck',
				'options' => getPortfolioTaxonomies('Categories'),
			),
			array(
				'name'    => __('Masonry Slogan/Headline', 'morphis'),
				'desc'    => __('Enter the Masonry Page\'s Slogan/Headline. You can use HTML tags.', 'morphis'),
				'id'      => $prefix . 'masonry_headline',
				'type'    => 'textarea_code',
				'options' => array(	'textarea_rows' => 6, ),
			),
			array(
				'name'    => __('Masonry Description', 'morphis'),
				'desc'    => __('Enter the Headline\'s optional description. You can use HTML tags.', 'morphis'),
				'id'      => $prefix . 'masonry_headline_desc',
				'type'    => 'textarea_code',
				'options' => array(	'textarea_rows' => 4, ),
			),
		),
	);
	
	// meta box for Page Individual Background Images
	$meta_boxes[] = array(
		'id' => 'unique_full_bg',
		'title' => __('Page Full Background Image Settings', 'morphis'),
		'pages' => array('post', 'page', 'portfolio'), // post type
		'desc' => __('Set here if you want a Full Background Image instead of patterns. This will overide the Global Post Settings from the Theme Options.', 'morphis'),
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(			
			array(
				'name' => __('Full Background Image', 'morphis'),
				'desc' => __('Upload your image or enter an URL for your full background image.', 'morphis'),
				'id'   => $prefix . 'unique_full_bg_image',
				'type' => 'file',
			),
			array(
				'name' => __('Make Image Tiled', 'morphis'),
				'desc' => __('You can make the background image into a tiled/repeating image pattern.', 'morphis'),
				'id'   => $prefix . 'toggle_full_bg_tile',
				'type' => 'checkbox'				
			)
		),
	);
	
	// meta boxes for Headline on Pages Posts
    $meta_boxes[] = array(
        'id' => 'headline_box_pages_posts',
        'title' => __('Page/Post Headline Settings', 'morphis'),
        'pages' => array('page','post'), // post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
        'fields' => array(                
            array(
                'name'    => __('Headline Main Caption', 'morphis'),
                'desc'    => __('Enter the Headline\'s main caption. You can use HTML tags.', 'morphis'),
                'id'      => $prefix . 'headline_pages_posts_main_caps',
                'type'    => 'textarea_code',
                'options' => array(    'textarea_rows' => 6, ),
            ),
            array(
                'name'    => __('Headline Secondary Caption', 'morphis'),
                'desc'    => __('Enter the Headline\'s optional secondary caption. You can use HTML tags.', 'morphis'),
                'id'      => $prefix . 'headline_pages_posts_sec_caps',
                'type'    => 'textarea_code',
                'options' => array(    'textarea_rows' => 4, ),
            ),
            array(
                'name'    => __('Headline Paragraph', 'morphis'),
                'desc'    => __('Enter the Headline\'s optional paragraph content. This is useful when you want to say something about your company. You can use HTML tags.', 'morphis'),
                'id'      => $prefix . 'headline_pages_posts_para',
                'type'    => 'textarea_code',
                'options' => array(    'textarea_rows' => 8, ),
            ),
        ),
    );
	
	
	return $meta_boxes;
	
}

add_filter( 'cmb_meta_boxes', 'metaboxes' );
}


/**
 * Get All Custom Sidebars from Sidebar Manager
 *
 *
 */
if ( !function_exists( 'getAllCustomSidebars' ) ) {
	function getAllCustomSidebars() {
		$allCustomSidebars = array();
		foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
			$pos = strpos($sidebar['id'],'footer-');
				if($pos === false) {
					$allCustomSidebars[] = array(
						'name' => $sidebar['name'],
						'value' => $sidebar['id']
					);
				}
		}
		return $allCustomSidebars;
	}
}


/**
 * Get Portfolio Custom Post Type Taxonomies.
 *
 *
 */
if ( !function_exists( 'getPortfolioTaxonomies' ) ) {
	function getPortfolioTaxonomies($taxonomy) {
		
		$portfolioSlugs = array();	
		$portfolioTerms = get_terms( $taxonomy ); 	
		
		foreach($portfolioTerms as $v){
			$portfolioSlugs[$v->term_id] = $v->name; 
		}
		
		return $portfolioSlugs;
	}
}

if ( !function_exists( 'getPostCategories' ) ) {
function getPostCategories() {
	
	$categoryItems = array();
	$categories = get_categories(array('type' => 'post','child_of' => 0,'orderby' => 'name','order' => 'ASC','hide_empty' => true));
	
	foreach($categories as $catty){
		$categoryItems[$catty->term_id] = $catty->name;
	}
	
	return $categoryItems;
}
}


if ( !function_exists( 'be_initialize_cmb_meta_boxes' ) ) {
// Initialize the metabox class
add_action( 'init', 'be_initialize_cmb_meta_boxes', 9999 );
function be_initialize_cmb_meta_boxes() {
	if ( !class_exists( 'cmb_Meta_Box' ) ) {
		require_once( 'lib/metabox/init.php' );
	}
}
}

/**
 * Truncate Words.
 *
 *
 */
if ( !function_exists( 'truncateWords' ) ) {
	function truncateWords($input, $numwords, $padding="")
	{
		$output = strtok($input, " \n");
		while(--$numwords > 0) $output .= " " . strtok(" \n");
		
		if($output != $input) $output .= $padding;
		$text = preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', $output);
		return $text;
	}
}

/**
 * Get URL of first image in a post.
 *
 *
 */
if ( !function_exists( 'catch_that_image' ) ) {
function catch_that_image() {
	global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	$first_img = $matches [1] [0];

	// no image found display default image instead
	if(empty($first_img)){
		$first_img = "/images/default.jpg";
	}
	return $first_img;
}
}

/**
 * jPlayer Video Function
 *
 *
 */
if ( !function_exists( 'jPlayer_video' ) ) {
    function jPlayer_video($postid, $simple = false) {
	
    	$video_height = get_post_meta($postid, '_cmb_video_pf_height', true);
    	$video_m4v = get_post_meta($postid, '_cmb_video_pf_m4v', true);
    	$video_ogv = get_post_meta($postid, '_cmb_video_pf_ogv', true);
    	$video_webmv = get_post_meta($postid, '_cmb_video_pf_webmv', true);
    	$video_file_preview = get_post_meta($postid, '_cmb_video_pf_file_preview', true);
    	$video_embedded = get_post_meta($postid, '_cmb_video_pf_embedded', true);
	
    ?>
    <script type="text/javascript">
    	jQuery(document).ready(function(){
		
    		if(jQuery().jPlayer) {
    			jQuery("#jquery_jplayer_<?php echo $postid; ?>").jPlayer({
				
    				ready: function () {
    					jQuery(this).jPlayer("setMedia", {
    						<?php if($video_m4v != '') : ?>
    						m4v: "<?php echo $video_m4v; ?>",
    						<?php endif; ?>
    						<?php if($video_ogv != '') : ?>
    						ogv: "<?php echo $video_ogv; ?>",
    						<?php endif; ?>
							<?php if($video_webmv != '') : ?>
    						webmv: "<?php echo $video_webmv; ?>",
    						<?php endif; ?>
    						<?php if ($video_file_preview != '') : ?>
    						poster: "<?php echo $video_file_preview; ?>"
    						<?php endif; ?>
    					});
    				},
					play: function() { // To avoid both jPlayers playing together.
						$(this).jPlayer("pauseOthers");
					},
    				size: {
    				    cssClass: "jp-responsive"
    				},
    				swfPath: "<?php echo get_template_directory_uri(); ?>/js",    				
    				supplied: "<?php if($video_m4v != '') : ?>m4v, <?php endif; ?><?php if($video_webmv != '') : ?>webmv, <?php endif; ?><?php if($video_ogv != '') : ?>ogv, <?php endif; ?> all",
					cssSelectorAncestor: "#jp_container_<?php echo $postid; ?>"
    			});
    		}
    	});
    </script>

	<!--container for everything-->
	<div id="jp_container_<?php echo $postid; ?>" class="jp-video jp-video-360p jp-responsive">						
		<!--container in which our video will be played-->
		<div id="jquery_jplayer_<?php echo $postid; ?>" class="jp-jplayer"></div>							
		<!--main containers for our controls-->
		<div class="jp-gui">
			<div class="jp-interface">
				<div class="jp-controls-holder">							
					<!--play and pause buttons-->
					<a href="javascript:;" class="jp-play" tabindex="1"><?php _e( 'play', 'morphis' ); ?></a>
					<a href="javascript:;" class="jp-pause" tabindex="1"><?php _e( 'pause', 'morphis' ); ?></a>
					<span class="separator sep-1"></span>									 
					<!--progress bar-->
					<div class="jp-progress">
						<div class="jp-seek-bar">
							<div class="jp-play-bar"><span></span></div>
						</div>
					</div>									 
					<!--time notifications-->
					<div class="jp-current-time"></div>
					<?php if($simple == false) { ?>
					<span class="time-sep">/</span>
					<div class="jp-duration"></div>
					<span class="separator sep-2"></span>									 
					<!--mute / unmute toggle-->
					<a href="javascript:;" class="jp-mute" tabindex="1" title="mute"><?php _e( 'mute', 'morphis' ); ?></a>
					<a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute"><?php _e( 'unmute', 'morphis' ); ?></a>									 
					<!--volume bar-->
					<div class="jp-volume-bar">
						<div class="jp-volume-bar-value"><span class="handle"></span></div>
					</div>
					<span class="separator sep-2"></span>									 
					<!--full screen toggle-->
					<a href="javascript:;" class="jp-full-screen" tabindex="1" title="full screen"><?php _e( 'full screen', 'morphis' ); ?></a>
					<a href="javascript:;" class="jp-restore-screen" tabindex="1" title="restore screen"><?php _e( 'restore screen', 'morphis' ); ?></a>									
					<?php } ?>
				</div><!--end jp-controls-holder-->
			</div><!--end jp-interface-->
		</div><!--end jp-gui-->							
		<!--unsupported message-->
		<div class="jp-no-solution">
			<span><?php echo __('Update Required', 'morphis'); ?></span>
			<?php echo __('To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/">Flash plugin</a>.', 'morphis'); ?>
		</div>				
	</div><!--end jp_container_1-->
	<div class="clear"></div>

    <?php }
}


/**
 * Embed Vimeo, Youtube, etc. Video Function
 *
 *
 */
if ( !function_exists( 'morphis_embed_video' ) ) {
	function morphis_embed_video($postid = "", $embeddedCode) {
		 ?>
		 <div class='video-figure video-fitvids'>
			<?php echo stripslashes(htmlspecialchars_decode($embeddedCode)); ?>
		 </div>		 
		 <?php 
	}
}


/**
 * jPlayer Audio Function
 *
 *
 */
if ( !function_exists( 'jPlayer_audio' ) ) {
    function jPlayer_audio($postid, $simple = false) {
	    	
    	$audio_mp3 = get_post_meta($postid, '_cmb_audio_pf_mp3', true);
    	$audio_ogg = get_post_meta($postid, '_cmb_audio_pf_ogg', true);    	
	
    ?>
    <script type="text/javascript">
    	jQuery(document).ready(function(){		
    		if(jQuery().jPlayer) {
    			jQuery("#jquery_jplayer_<?php echo $postid; ?>").jPlayer({				
    				ready: function () {
    					jQuery(this).jPlayer("setMedia", {
    						<?php if($audio_mp3 != '') : ?>
    						mp3: "<?php echo $audio_mp3; ?>",
    						<?php endif; ?>
    						<?php if($audio_ogg != '') : ?>
    						ogg: "<?php echo $audio_ogg; ?>",
    						<?php endif; ?>							
    					});
    				},
					play: function() { // To avoid both jPlayers playing together.
						$(this).jPlayer("pauseOthers");
					},
    				size: {
    				    cssClass: "jp-responsive"
    				},
    				swfPath: "<?php echo get_template_directory_uri(); ?>/js",    				
    				supplied: "<?php if($audio_mp3 != '') : ?>mp3, <?php endif; ?><?php if($audio_ogg != '') : ?>ogg, <?php endif; ?> all",
					cssSelectorAncestor: "#jp_container_<?php echo $postid; ?>"
    			});
    		}
    	});
    </script>

	<!--container for everything-->
	<div id="jp_container_<?php echo $postid; ?>" class="jp-audio jp-responsive">						
		<!--container in which our video will be played-->
		<div id="jquery_jplayer_<?php echo $postid; ?>" class="jp-jplayer"></div>							
		<!--main containers for our controls-->
		<div class="jp-gui">
			<div class="jp-interface">
				<div class="jp-controls-holder">							
					<!--play and pause buttons-->
					<a href="javascript:;" class="jp-play" tabindex="1"><?php _e( 'play', 'morphis' ); ?></a>
					<a href="javascript:;" class="jp-pause" tabindex="1"><?php _e( 'pause', 'morphis' ); ?></a>
					<span class="separator sep-1"></span>									 
					<!--progress bar-->
					<div class="jp-progress">
						<div class="jp-seek-bar">
							<div class="jp-play-bar"><span></span></div>
						</div>
					</div>									 
					<!--time notifications-->
					
					<div class="jp-current-time"></div>
					<?php if($simple == false) { ?>
					<span class="time-sep">/</span>
					<div class="jp-duration"></div>
					<span class="separator sep-2"></span>							
					<!--mute / unmute toggle-->
					<a href="javascript:;" class="jp-mute" tabindex="1" title="mute"><?php _e( 'mute', 'morphis' ); ?></a>
					<a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute"><?php _e( 'unmute', 'morphis' ); ?></a>									 
					<!--volume bar-->
					<div class="jp-volume-bar">
						<div class="jp-volume-bar-value"><span class="handle"></span></div>
					</div>
					<span class="separator sep-2"></span>									 
					<?php } ?>									
				</div><!--end jp-controls-holder-->
			</div><!--end jp-interface-->
		</div><!--end jp-gui-->							
		<!--unsupported message-->
		<div class="jp-no-solution">
			<span><?php echo __('Update Required', 'morphis'); ?></span>
			<?php echo __('To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/">Flash plugin</a>.', 'morphis'); ?>
		</div>						
	</div><!--end jp_container_2-->
	

    <?php }
}

/**
 * Gallery / Slideshow Function
 *
 *
 */

if ( !function_exists( 'gallery_carouFredSel' ) ) {
    function gallery_carouFredSel($postid, $the_content = "") { ?>
        <script type="text/javascript">
		jQuery(document).ready(function( $ ) {		
    		if(jQuery().carouFredSel && $('#post-format-slides-<?php echo $postid; ?>').length != 0 ) {	
			
				function caroufredselPreloadGalleryImages<?php echo $postid; ?>() {
					var $caroufredselImages = $('#post-format-slides-<?php echo $postid; ?>').find('img');
					var caroufredselImagesCount = $caroufredselImages.length;
					loaded	= 0;
					
					return $.Deferred(
					
						function(dfd) {
					
							$caroufredselImages.each( function( i ) {														
								
									$('<img/>').load( function() {
									
										if( ++loaded === caroufredselImagesCount ) {
											
											dfd.resolve();
											
										}
									
									}).attr( 'src', $(this).attr('src') );
									
								
							});
							
						}
						
					).promise();
					
				} // end preload
			

				//$.when( caroufredselPreloadGalleryImages<?php echo $postid; ?>() ).done( function() {
									
				$('#post-format-slides-<?php echo $postid; ?>').carouFredSel({	
					circular: true,
					responsive: true,
					items 		: { 
						width : 520,
						height: 'variable',
						visible: 1
					},						
					prev	: {	
						button	: "#slider-down-<?php echo $postid; ?>",
						key		: "down"
					},
					next	: { 
						button	: "#slider-up-<?php echo $postid; ?>",
						key		: "up"
					},
					pagination: "#slider-pagination-<?php echo $postid; ?>",
					auto : {
						easing		: "linear",
						duration	: 1300,
						pauseDuration: 4000,
						pauseOnHover: true,
					},
					scroll : {
						fx : 'crossfade'
					}
				});							
			}	
			
		});
    	</script>
    <?php 
	
		preg_match('/\[gallery.*ids=.(.*).\]/', $the_content, $ids);
		$gallery_ids = array();
		if(isset($ids[1])) {
			$gallery_ids = explode(",", $ids[1]);
		}
		
		if(!empty($gallery_ids[0])) {
		
			if( !empty($gallery_ids) ) {
				echo '<div id="post-format-slider-' .$postid . '" class="post-format-slider">';
				echo '<div id="post-format-slides-' .$postid . '" class="slider_class">';	
				foreach( $gallery_ids as $gallery_id ) {                
					$src = wp_get_attachment_image_src( $gallery_id, 'full' );     
					echo "<div><a href='$src[0]' rel='prettyPhoto[pp_gal_".$postid."]' class='slide-hover-effect' title=''><img src='$src[0]' width='700' height='520' /></a></div>";
				}
				echo '</div>';
				echo '<div id="slider-pagination-'.$postid.'" class="slider-pagination"></div><a href="#" id="slider-up-'.$postid.'" class="slider-up"></a><a href="#" id="slider-down-'.$postid.'" class="slider-down"></a>';
				echo '</div>';
			}
			
		} else {
			
			$args = array(
				'orderby' => 'menu_order',
				'order'	=>	'ASC',
				'post_type' => 'attachment',
				'post_parent' => $postid,
				'post_mime_type' => 'image',
				'post_status' => null,
				'numberposts' => -1,
				'exclude' => get_post_thumbnail_id($postid)
			);
			$attachments = get_posts($args);
			if( !empty($attachments) ) {
				echo '<div id="post-format-slider-' .$postid . '" class="post-format-slider">';
				echo '<div id="post-format-slides-' .$postid . '" class="slider_class">';			
				foreach( $attachments as $attachment ) {                
					$src = wp_get_attachment_image_src( $attachment->ID, 'full' );
					$alt = get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true );
					$title_text = ( !empty($attachment->post_content) ) ? $attachment->post_content : $attachment->post_title;                
					echo "<div><a href='$src[0]' rel='prettyPhoto[pp_gal". $postid ."]' class='slide-hover-effect' title='$title_text'><img src='$src[0]' alt='$alt' title='$title_text'/></a></div>";
			   
				}
				echo '</div>';
				echo '<div id="slider-pagination-'.$postid.'" class="slider-pagination"></div><a href="#" id="slider-up-'.$postid.'" class="slider-up"></a><a href="#" id="slider-down-'.$postid.'" class="slider-down"></a>';
				echo '</div>';
			}
			
		} // end gallery
	
    }
}

/**
 * Multiple Images Portfolio Attachment
 *
 *
 */

if ( !function_exists( 'gallery_multiple_image' ) ) {
    function gallery_multiple_image($postid) { 
	
		$portfolio_attachment_multi = get_post_meta($postid,'_cmb_attachment_multiple_images',TRUE);
		preg_match('/\[gallery.*ids=.(.*).\]/', $portfolio_attachment_multi, $ids);
		$gallery_ids = explode(",", $ids[1]);
	
		if(!empty($gallery_ids[0])) {
		
			if( !empty($gallery_ids) ) {
				echo '<div style="display: block;" class="half-bottom">';
				foreach( $gallery_ids as $gallery_id ) {                
					$src = wp_get_attachment_image_src( $gallery_id, 'full' );
					$alt =''; 
					echo "<div class='multi_image'><a href='$src[0]' rel='prettyPhoto' class='slide-hover-effect' title=''><img src='$src[0]' alt='$alt' /></a></div>";
			   
				}
				echo '</div>';
			}
		
		} else {
		
			$args = array(
				'order' => 'ASC',
				'orderby' => 'menu_order',
				'post_type' => 'attachment',
				'post_parent' => $postid,
				'post_mime_type' => 'image',
				'post_status' => null,
				'numberposts' => -1,
				'exclude' => get_post_thumbnail_id($postid)
			);
			$attachments = get_children($args);
			if( !empty($attachments) ) {
				echo '<div style="display: block;" class="half-bottom">';
				foreach( $attachments as $attachment ) {                
					$src = wp_get_attachment_image_src( $attachment->ID, 'full' );
					$alt = ( !empty($attachment->post_content) ) ? $attachment->post_content : $attachment->post_title;                
					echo "<div class='multi_image'><a href='$src[0]' rel='prettyPhoto' class='slide-hover-effect' title=''><img src='$src[0]' alt='$alt' /></a></div>";
			   
				}
				echo '</div>';
			}
		
		}
	
         
    }
}


/**
 * Twitter Strip AJAX
 *
 *
 */
if ( !function_exists( 'morphis_twitter_strip_ajax' ) ) {

	function morphis_twitter_strip_ajax() {
		global $NHP_Options;
		$app = array();
		
		if( is_admin() ){
			$app['consumer_key'] = trim( $NHP_Options->get( 'twitter_consumer_key' ) );
			$app['consumer_secret'] = trim( $NHP_Options->get( 'twitter_consumer_secret' ) );
			$app['access_token'] = trim( $NHP_Options->get( 'twitter_access_token' ) );
			$app['access_token_secret'] = trim( $NHP_Options->get( 'twitter_access_token_secret' ) );
			
		} else {
			$app['consumer_key'] = trim( $NHP_Options['twitter_consumer_key'] );
			$app['consumer_secret'] = trim( $NHP_Options['twitter_consumer_secret'] );
			$app['access_token'] = trim( $NHP_Options['twitter_access_token'] );
			$app['access_token_secret'] = trim( $NHP_Options['twitter_access_token_secret'] );
		}
		
		$username = $_POST['user_id'];	
		$count = $_POST['count'];	
		$widgetized = $_POST['widgetized'];	
		
		// Twitter API class
		$twitterClass = new PulpFramework_Twitter( $username, (int) $count, (boolean) $widgetized, $app );
		$twitterOutput = $twitterClass->Render();	
		echo $twitterOutput;
		die();
		
	}
	
}
add_action( 'wp_ajax_morphis_action_twitter_strip_ajax', 'morphis_twitter_strip_ajax' );
add_action('wp_ajax_nopriv_morphis_action_twitter_strip_ajax', 'morphis_twitter_strip_ajax');
/**
 * Twitter Strip
 *
 *
 */

if ( !function_exists( 'twitter_strip' ) ) {

	function twitter_strip($username) { 
		
	?>
	
	<script type="text/javascript">
		jQuery(document).ready(function($){			
			var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';			
			$.ajax({
				type: "POST",
				url: ajaxurl,
				data: {
					action: 'morphis_action_twitter_strip_ajax',
					user_id: '<?php echo $username ?>',
					count: 1,
					widgetized: '0',
				},
				success: function(response) {	
					$('#tweet-strip .container .sixteen').append( response );
				}
			});			
		});		
	</script>
	
		 <!-- TWITTER STRIP -->				
		<div id="tweet-strip"><div class="container"><div class="sixteen columns"><div class="tweet-icon"></div></div></div></div>
		<!-- END TWITTER STRIP -->
		
<?php }
	
}

/**
 * Custom Numbered Pagination
 *
 *
 */
if ( !function_exists( 'numbered_pagination' ) ) {
function numbered_pagination($pages = '', $range = 2)
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
         echo "<ul class='pagination clearfix'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."'>&laquo;</a></li>";
         if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a></li>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<li><span class='current'>".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a></li>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a></li>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>&raquo;</a></li>";
         echo "</ul>\n";
     }
}
}

/**
 * Using Theme Styles and Skins Options
 *
 *
 */
 if ( !function_exists( 'add_theme_skins_and_styles' ) ) {
function add_theme_skins_and_styles( $wp ) {
    if (!empty( $_GET['theme-styles'] ) && $_GET['theme-styles'] == 'css') {
        # get theme options
        header( 'Content-Type: text/css' );
        get_template_part( 'inc/theme-styles' );
        exit;
    }
}
add_action( 'parse_request', 'add_theme_skins_and_styles' );
}

/**
 * Google Analytics Tracking
 *
 *
 */
if ( !function_exists( 'add_googleanalytics' ) ) {
	function add_googleanalytics() { 
		if( !is_admin() ) {
			global $NHP_Options;
			$trackingID = $NHP_Options['google_analytics_id'];
			if( $trackingID != '' ) {
				?>				
				<script type="text/javascript">
					var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
					document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
				</script>
				<script type="text/javascript">
					try{ 
					var pageTracker = _gat._getTracker("<?php echo $trackingID; ?>");
					pageTracker._trackPageview();
					} catch(err) {}
				</script>				
				<?php 
			}
		} 
	}
	add_action('wp_footer', 'add_googleanalytics');	
}


/**
 * Contact Form
 *
 *
 */
if( !function_exists( 'contact_form' ) ) {

	function contact_form($pageid = '') {
	
		?>
		<script type="text/javascript">
		/* -------------- Contact Form - Ajax --------------*/	
			jQuery(document).ready(function($){				
				var messageDelay = 2000;  // How long to display status messages (in milliseconds)
						
				// Init the form once the document is ready
				init();

				// Initialize the form
				function init() {				  
				  // Make submitForm() the form's submit handler.		  
				  $('#contactForm-<?php echo $pageid; ?>').submit( submitForm );
				}
				
				// Submit the form via Ajax
				function submitForm() {
				  var contactForm = $(this);

				  // Are all the fields filled in?
				  if ( !$('#name').val() || !$('#email').val() || !$('#message').val() ) {
					// No; display a warning message and return to the form
					$('#incompleteMessage').fadeIn().delay(messageDelay).fadeOut();
					contactForm.fadeOut().delay(messageDelay).fadeIn();
				  } else {
					// Yes; submit the form to the PHP script via Ajax
					$('#sendingMessage').fadeIn();			
					$.ajax( {
					  url: "<?php echo get_admin_url(); ?>admin-ajax.php" + "?ajax=true&post_id=<?php echo $pageid; ?>",
					  type: contactForm.attr( 'method' ),
					  data: contactForm.serialize(),
					  success: submitFinished
					} );
				  }

				  // Prevent the default form submission occurring
				  return false;
				}

				// Handle the Ajax response
				function submitFinished( response ) {
				  response = $.trim( response );
				  $('#sendingMessage').fadeOut();

				  if ( response == "success" || response == "success0" || response == "success-1" ) {
					// Form submitted successfully:
					// 1. Display the success message
					// 2. Clear the form fields			
					$('#successMessage').fadeIn().delay(messageDelay).fadeOut();
					$('#name').val( "" );
					$('#email').val( "" );
					$('#url').val( "" );
					$('#message').val( "" );
				  } else {
					// Form submission failed: Display the failure message,
					// then redisplay the form
					$('#failureMessage').fadeIn().delay(messageDelay).fadeOut();			
				  }
				}				
			});
		</script>
		<form id="contactForm-<?php echo $pageid; ?>" method="post" class="contact-form">
		   <fieldset>
			   <ul>
					<li> 
						<input type="text" id="name" name="name" placeholder="<?php echo get_post_meta($pageid, '_cmb_contact_page_template_mb_name_placeholder', true); ?>" required autofocus />								
					</li>
					<li>
						<input type="email" id="email" name="email" placeholder="<?php echo get_post_meta($pageid, '_cmb_contact_page_template_mb_email_placeholder', true); ?>" required />								
					</li>
					<li>
						<textarea id="message" name="message" rows="9" cols="10" id="message" required placeholder="<?php echo get_post_meta($pageid, '_cmb_contact_page_template_mb_message_placeholder', true); ?>"></textarea>
					</li>
					<input type="hidden" name="action" value="process_contact_form"/>
			   </ul>
			   
			   <button class="button" type="submit" id="sendMessage" name="sendMessage" type="reset"><?php echo __('Submit Form', 'morphis'); ?></button>			    			  
			   <button class="button" type="reset"><?php echo __('Reset', 'morphis'); ?></button>
			</fieldset>
		</form>	
		
		<div id="sendingMessage" class="statusMessage"><p><?php echo __('Sending your message. Please wait...', 'morphis'); ?></p></div>
		<div id="successMessage" class="statusMessage"><p><?php echo __('Thanks for sending your message! We\'ll get back to you shortly.', 'morphis'); ?></p></div>
		<div id="failureMessage" class="statusMessage"><p><?php echo __('There was a problem sending your message. Please try again.', 'morphis'); ?></p></div>
		<div id="incompleteMessage" class="statusMessage"><p><?php echo __('Please complete all the fields in the form before sending.', 'morphis'); ?></p></div>		
		<?php 	
	}

}

if( !function_exists( 'process_contact_form' ) ) {

function process_contact_form() {
$postid = $_GET["post_id"];	
$recipient_name = get_post_meta($postid, '_cmb_contact_page_template_mb_recipient_name', true);
$recipient_email = get_post_meta($postid, '_cmb_contact_page_template_mb_recipient_email', true);
$blog_title = get_bloginfo('name');

if(isset( $_POST['name'] )) {
	$sender_name = "from " . $_POST['name'];
}

// Define some constants
define( "RECIPIENT_NAME", $recipient_name );
define( "RECIPIENT_EMAIL", $recipient_email );
define( "EMAIL_SUBJECT", $blog_title . __( " Contact Form Message ", 'morphis' ) . $sender_name);

// Read the form values
$success = false;
$senderName = isset( $_POST['name'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $_POST['name'] ) : "";
$senderEmail = isset( $_POST['email'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['email'] ) : "";
$message = isset( $_POST['message'] ) ? preg_replace( "/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/", "", $_POST['message'] ) : "";

// If all values exist, send the email
if ( $senderName && $senderEmail && $message ) {
  $recipient = RECIPIENT_NAME . " <" . RECIPIENT_EMAIL . ">";
  $headers = __("From: ", "morphis") . $senderName . " <" . $senderEmail . ">" . "\r\n" . __('Reply-To: ', 'morphis') . $senderEmail . "\r\n" . 'X-Mailer: PHP/' . phpversion();
  $success = wp_mail( $recipient, EMAIL_SUBJECT, $message, $headers );
}

// Return an appropriate response to the browser
if ( isset($_GET["ajax"]) ) {
  echo $success ? "success" : "error";
} else {
?>
<html>
  <head>
    <title></title>
  </head>
  <body>
  <?php if ( $success ) echo __("<p>Thanks for sending your message! We'll get back to you shortly.</p>", "morphis") ?>
  <?php if ( !$success ) echo __("<p>There was a problem sending your message. Please try again.</p>", "morphis") ?>
  <p><?php echo __('Click your browser\'s Back button to return to the page.', 'morphis'); ?></p>
  
  </body>
</html>
<?php } 
	}
	
	add_action('wp_ajax_process_contact_form', 'process_contact_form');
	add_action('wp_ajax_nopriv_process_contact_form', 'process_contact_form');
	
}


/**
 * Retrieve Ajax Item
 *
 *
 */
if ( !function_exists( 'retrieve_portfolio_item' ) ) {
function retrieve_portfolio_item() {
	
	if ( !wp_verify_nonce( $_REQUEST['nonce'], "retrieve_portfolio_item_nonce")) {			
		  exit("No naughty business please");
	}
	
	// portfolio navigation
	$post_id = $_GET["post_id"]; //get the 'post_id' coming from jQuery ajax data 
	$prev_id = $_REQUEST["prev_post_id"]; // get the previous portfolio id for navigation
	$next_id = $_REQUEST["next_post_id"]; // get the next portfolio id for navigation
	
	
	//navigation
	$new_nav = '<ul class="portfolio-nav clearfix">
					<li><a href="#" class="portfolio-content-link previous-portfolio" data-post_id="'. $_REQUEST["prev_post_id"] .'">' . __('Previous', 'morphis') . '</a></li>
					<li><a href="#" class="portfolio-content-link next-portfolio" data-post_id="'. $_REQUEST["next_post_id"] .'">' . __('Next', 'morphis') . '</a></li>	
					<li><a href="#" class="close-portfolio">' . __( 'Close', 'morphis' ) . '</a></li>														
				</ul>';
	
?>
	<div id="portfolio-single">
			<div id="content" class="portfolio-single clearfix">				
				<div id="shownPortfolio" class="twelve columns alpha">
				
					<h4 class="entry-title"><?php echo get_the_title($post_id); ?></h4>					
					<h6 class="portfolio-client"><?php echo get_post_meta($post_id, '_cmb_client_name', TRUE); ?></h6>
					<p class="portfolio-info-desc"><?php echo wpautop(do_shortcode(get_post_meta($post_id, '_cmb_info_desc', TRUE))); ?></p>
					
					<!-- Portfolio Attachment -->
					<?php $portfolio_attachment = get_post_meta($post_id,'_cmb_select_attachment',TRUE); ?>																	
					<?php if($portfolio_attachment == 'slideshow') : ?>						
						
						<?php  
							$gallery_ids = '';
							$portfolio_attachment_slideshow = get_post_meta($post_id,'_cmb_attachment_slideshow',TRUE);
							preg_match('/\[gallery.*ids=.(.*).\]/', $portfolio_attachment_slideshow, $ids);
							if( isset( $ids[1] ) ) {
								$gallery_ids = explode(",", $ids[1]);
							}
							
							if(!empty($gallery_ids[0])) {
							
								if( !empty($gallery_ids) ) {
									echo '<div id="post-format-slider">';
									echo '<div id="post-format-slides">';
									foreach( $gallery_ids as $gallery_id ) {                
										$src = wp_get_attachment_image_src( $gallery_id, 'full' );
										$caption = get_thumbnail_caption( $gallery_id );
										$alt = ''; //( !empty($attachment->post_content) ) ? $attachment->post_content : $attachment->post_title;                
										echo "<div><a href='$src[0]' rel='prettyPhoto[pp_gal_".$post_id."]' class='slide-hover-effect' title='$caption'><img src='$src[0]' alt='$alt' width='700' height='520' /></a></div>";
								   
									}
									echo '</div>';
									echo '<div id="slider-pagination" class="slider-pagination"></div><a href="#" id="slider-up" class="slider-up"></a><a href="#" id="slider-down" class="slider-down"></a>';
									echo '</div>';
								}
								
							} else {
							
								$args = array(
									'orderby' => 'menu_order',
									'order' => 'ASC',
									'post_type' => 'attachment',
									'post_parent' => $post_id,
									'post_mime_type' => 'image',
									'post_status' => null,
									'numberposts' => -1,
									'exclude' => get_post_thumbnail_id($post_id)
								);
								$attachments = get_posts($args);
								if( !empty($attachments) ) {
									echo '<div id="post-format-slider">';
									echo '<div id="post-format-slides">';
									foreach( $attachments as $attachment ) {                
										$src = wp_get_attachment_image_src( $attachment->ID, 'full' );
										$caption = get_thumbnail_caption( $attachment->ID );
										$alt = ( !empty($attachment->post_content) ) ? $attachment->post_content : $attachment->post_title;                
										echo "<div><a href='$src[0]' rel='prettyPhoto[pp_gal_".$post_id."]' class='slide-hover-effect' title='$caption'><img src='$src[0]' alt='$alt' width='700' height='520' /></a></div>";
								   
									}
									echo '</div>';
									echo '<div id="slider-pagination" class="slider-pagination"></div><a href="#" id="slider-up" class="slider-up"></a><a href="#" id="slider-down" class="slider-down"></a>';
									echo '</div>';
								}
								
							}							
						
						?>
					<?php elseif($portfolio_attachment == 'multiple_image') : ?>
					
						<?php gallery_multiple_image($post_id); ?>
						
					<?php elseif($portfolio_attachment == 'image') : ?>
						
						<?php $image_pf = get_post_meta($post_id,'_cmb_attachment_image',TRUE); ?>							
						<?php if ( $image_pf != '' ) { ?>
						<?php // $img_size = getimagesize($image_pf); ?>
							<?php // if(is_array($img_size)) { ?>						
								<?php // $aspectHeight =  calculate_image_height($img_size['0'], $img_size['1'], 700); ?>
								<div class="overlay squared half-bottom">
									<figure>
										<a class="icon-view" href="<?php echo $image_pf; ?>" rel="prettyPhoto" title=""></a>
										<a class="icon-link" href="<?php echo get_permalink($post_id); ?>"></a>
										<a href="<?php echo $image_pf; ?>" class="overlay-lightbox" rel="prettyPhoto" title="<?php echo get_the_title ($post_id); ?>">
											<img src="<?php echo $image_pf; ?>" alt="<?php echo get_the_title ($post_id); ?>" />
										</a>
									</figure>
								</div>	
							<?php // } ?>
						<?php } ?>
					<?php elseif($portfolio_attachment == 'vimeo') : ?>
						<div class="video-figure half-bottom">
						<?php $codeEmbed = get_post_meta($post_id, '_cmb_attachment_vimeo', true); ?>						
						<?php echo stripslashes(htmlspecialchars_decode($codeEmbed)); ?>
						</div>
					<?php elseif($portfolio_attachment == 'youtube') : ?>
						<div class="video-figure half-bottom">
						<?php $codeEmbed = get_post_meta($post_id, '_cmb_attachment_youtube', true); ?>						
						<?php echo stripslashes(htmlspecialchars_decode($codeEmbed)); ?>
						</div>
					<?php endif; ?>
					<!-- End Portfolio Attachment -->
					
					
					<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'morphis' ) . '</span>', 'after' => '</div>' ) ); ?>
					
				</div>
				<div id="shownPortfolioMeta" class="four columns omega sidebar-right">
					
						<dl class="portfolio-meta sidebar-borders">
													
							<?php // get user-defined attributes name ?>
							<?php $ud_att_client = get_post_meta($post_id, '_cmb_client_name_att', TRUE); ?>
							<?php $ud_att_date = get_post_meta($post_id, '_cmb_date_completed_att', TRUE); ?>
							<?php $ud_att_skills = get_post_meta($post_id, '_cmb_skills_tech_att', TRUE); ?>
							<?php $ud_att_portfolio_cats = get_post_meta($post_id, '_cmb_categories_att', TRUE); ?>
							<?php $ud_att_launch_proj = get_post_meta($post_id, '_cmb_launch_project_att', TRUE); ?>
												
							 <?php $ud_att_client = $ud_att_client != ''  ? $ud_att_client : __('Client', 'morphis'); ?>
							 <?php $ud_att_date = $ud_att_date != ''  ? $ud_att_date : __('Date', 'morphis'); ?>
							 <?php $ud_att_skills = $ud_att_skills != ''  ? $ud_att_skills : __('Skills &amp; Technologies', 'morphis'); ?>
							 <?php $ud_att_portfolio_cats = $ud_att_portfolio_cats != ''  ? $ud_att_portfolio_cats : __('Categories', 'morphis'); ?>
							 <?php $ud_att_launch_proj = $ud_att_launch_proj != ''  ? $ud_att_launch_proj : __('Launch Project', 'morphis'); ?>
							 
						
							<?php echo $new_nav; // display navigation ?>
							<?php $att_client = get_post_meta($post_id, '_cmb_client_name', TRUE); ?>
							<?php $att_date = get_post_meta($post_id, '_cmb_date_completed', TRUE); ?>
							<?php $att_skills = get_the_terms( $post_id, 'Skills'); ?>
							<?php $att_portfolio_cats = get_the_terms( $post_id, 'Categories'); ?>
							<?php $att_optional_desc = get_post_meta($post_id, '_cmb_info_optional_desc', TRUE); ?>
							<?php $att_launch_proj = get_post_meta($post_id, '_cmb_launch_link', TRUE); ?>
							
							<?php if($att_client != ''): ?>
							<dt><?php echo $ud_att_client; ?></dt>
								<dd><?php echo $att_client; ?></dd>
							<?php endif; ?>
							<?php if($att_date != ''): ?>
							<dt><?php echo $ud_att_date; ?></dt>
								<dd><?php echo $att_date; ?></dd>
							<?php endif; ?>
							<?php if(!empty($att_skills)): ?>
							<dt><?php echo $ud_att_skills; ?></dt>
								<dd>
								  	<ul id="skills-list" class="clearfix">
									<?php $skills_list = $att_skills; ?>
										<?php foreach( $skills_list as $skill ) { ?>
											<li><?php echo $skill->name; ?></li>	
										<?php } ?>
									</ul>
								</dd>
							<?php endif; ?>
							<?php if(!empty($att_portfolio_cats)): ?>
							<dt><?php echo $ud_att_portfolio_cats; ?></dt>
								<dd>
									<ul id="" class="clearfix">
									<?php $portfolio_cats = $att_portfolio_cats; ?>
										<?php foreach( $portfolio_cats as $portfolio_cat ) { ?>
											<li><?php echo $portfolio_cat->name; ?></li>	
										<?php } ?>
									</ul>
								</dd>
							<?php endif; ?>
							<?php if($att_optional_desc != ''): ?>
							<p><?php echo $att_optional_desc; ?></p>
							<?php endif; ?>
							<?php if($att_launch_proj != ''): ?>
							<a href="<?php echo $att_launch_proj; ?>" class="read-this"><?php echo $ud_att_launch_proj; ?></a>
							<?php endif; ?>
						</dl>
				</div>
				<div class="clear"></div>
			
			</div>		
		<hr />
		</div>
	
	<?php		
	die();	
}
add_action('wp_ajax_retrieve_portfolio_item', 'retrieve_portfolio_item');
add_action('wp_ajax_nopriv_retrieve_portfolio_item', 'retrieve_portfolio_item');	
}

if ( !function_exists( 'enqueue_custom_portfolio_script' ) ) {
	function enqueue_custom_portfolio_script() {   
	   wp_register_script('wpt_custom_portfolio', get_template_directory_uri() . '/js/custom.portfolio.js', 'jquery', '1.0', TRUE);
	   wp_localize_script( 'wpt_custom_portfolio', 'customAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'nonce' => wp_create_nonce( 'retrieve_portfolio_item_nonce' ))); 			
	   wp_enqueue_script('wpt_custom_portfolio');
	}
	add_action( 'init', 'enqueue_custom_portfolio_script' );
}

/**
 * Simple Aspect Ratio Calculator
 *
 *
 */
if ( !function_exists( 'calculate_image_height' ) ) {
	function calculate_image_height($origWidth, $origHeight, $newWidth) {	
		return round(( $origHeight / $origWidth ) * $newWidth);	
	}
}

/**
 * Portfolio Post Type Exclude "Categories" Taxonomy
 *
 *
 */
if ( !function_exists( 'portfolio_template_query_args_func' ) ) {
	function portfolio_template_query_args_func( $args, $excluded_cats ) {
		if ( count( $excluded_cats ) > 0 ) {		
			$args['tax_query'] = array(
					array(
						'taxonomy' => 'Categories',
						'terms' => $excluded_cats,
						'field' => 'id',
						'operator' => 'NOT IN',
					),
				);						
		}		
		return $args;	
	}
	add_filter('portfolio_template_query_args', 'portfolio_template_query_args_func', 10, 2);
}

/**
 * Get All Social Links
 *
 *
 */
if ( !function_exists( 'get_social_links' ) ) {
	function get_social_links() {		
		global $NHP_Options;
		//$arrSocialLinks = $NHP_Options->sections[8]['fields'];
		foreach ($NHP_Options as $key => $value) {
			if (substr($key, 0, 11) == "arr_social_" || ( false !== strpos( $key, 'twitter_username' ) ) ) {
				$socialLinks[] = $key;
			}
		}		
		return $socialLinks;
	}
}


/**
 * Get All Portfolio
 *
 *
 */
if ( !function_exists( 'get_all_portfolio_list' ) ) {
	function get_all_portfolio_list() {
		$portfolio_list = array();	
		$args = array( 'posts_per_page' => -1, 'post_type' => 'portfolio' );	
		$portfolio_posts = get_posts( $args );	
		
		foreach ( $portfolio_posts as $portfolio_post ) :
			$portfolio_list[$portfolio_post->ID] = '<b>' . $portfolio_post->post_title . '</b> - ' . __( 'Portfolio ID', 'morphis' ) . ': <b>' . $portfolio_post->ID . '</b>';
		endforeach; 

		wp_reset_postdata();
		return $portfolio_list;
	}
}


if ( !function_exists( 'custom_img_caption_shortcode' ) ) {
add_shortcode('wp_caption', 'custom_img_caption_shortcode');
add_shortcode('caption', 'custom_img_caption_shortcode');

/**
 * The Caption shortcode.
 *
 * Allows a plugin to replace the content that would otherwise be returned. The
 * filter is 'img_caption_shortcode' and passes an empty string, the attr
 * parameter and the content parameter values.
 *
 * The supported attributes for the shortcode are 'id', 'align', 'width', and
 * 'caption'.
 *
 * @since 2.6.0
 *
 * @param array $attr Attributes attributed to the shortcode.
 * @param string $content Optional. Shortcode content.
 * @return string
 */
function custom_img_caption_shortcode($attr, $content = null) {

	// Allow plugins/themes to override the default caption template.
	$output = apply_filters('img_caption_shortcode', '', $attr, $content);
	if ( $output != '' )
		return $output;

	extract(shortcode_atts(array(
		'id'	=> '',
		'align'	=> 'alignnone',
		'width'	=> '',
		'caption' => ''
	), $attr));

	if ( 1 > (int) $width || empty($caption) )
		return $content;

	if ( $id ) $id = 'id="' . esc_attr($id) . '" ';

	return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '" style="width: ' . ((int) $width) . 'px">'
	. do_shortcode( $content ) . '<div class="wp-caption-text image-caption"><p>' . $caption . '</p></div></div>';
}
}

if ( !function_exists( 'enqueue_native_gallery_style' ) ) {
	function enqueue_native_gallery_style() {
		wp_register_style( 'nativegallery', get_template_directory_uri() . '/css/nativeGallery.css', '', time(), 'all' );
		wp_enqueue_style('nativegallery');
	}
}


/**
 * Get Vimeo ID from iframe embed code
 *
 * 
 */
if ( !function_exists( 'getVimeoID' ) ) {
function getVimeoID($str) {
	$vim_id = trim(substr($str, strpos($str,'video') + 6, (strpos($str,'&quot; width')) - (strpos($str,'video') + 6)));

	return $vim_id;
}
}

/**
 * Get YouTube ID from iframe embed code
 *
 * 
 */
if ( !function_exists( 'getYoutubeID' ) ) {
	function getYoutubeID($str) {	

		$stat = preg_match('#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#', $str, $matches);
		if( isset( $matches[0] ) ) {
			return $matches[0];
		} else {
			return '';
		}
	}
}

/**
 * Get Current Page URL
 *
 * 
 */
 if ( !function_exists( 'curPageURL' ) ) {
function curPageURL() {

	$pageURL = 'http';
	if( isset( $_SERVER["HTTPS"] ) ) {
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
	$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
	$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
	
}
}

/**
 * Slides Sorting
 *
 * 
 */
if ( !function_exists( 'slides_sort_page' ) ) {
	function slides_sort_page() {
		$slides_sort_page = add_submenu_page('edit.php?post_type=slide', __( 'Sort Slide Items', 'morphis' ), __('Sort Slide Items', 'morphis'), 'edit_posts', basename(__FILE__), 'slides_sort');
		
		add_action('admin_print_styles-' . $slides_sort_page, 'enqueue_sort_styles');
		add_action('admin_print_scripts-' . $slides_sort_page, 'enqueue_sort_scripts');
	}
	
	add_action('admin_menu', 'slides_sort_page');
}

if ( !function_exists( 'slides_sort' ) ) {

	function slides_sort() {
		$slides = new WP_Query('post_type=slide&posts_per_page=-1&orderby=menu_order&order=ASC');
	?>
		<div class="wrap">
			<div id="icon-tools" class="icon32"><br /></div>
			<h2><?php _e('Sort Slides', 'morphis'); ?></h2>
			<p><?php _e('Sort and/or re-order your slides. Top item should be the first on the slider.', 'morphis'); ?></p>

			<ul id="slides-items">
				<?php while( $slides->have_posts() ) : $slides->the_post(); ?>
					<?php if( get_post_status() == 'publish' ) { ?>
						<li id="<?php the_id(); ?>" class="menu-item">
							<dl class="menu-item-bar">
								<dt class="menu-item-handle">
									<span class="menu-item-title"><?php the_title(); ?></span>
								</dt>
								<dt class="menu-item-handle">
									<?php $slide_item_image = get_post_meta(get_the_ID(),'_cmb_slide_image_upload',TRUE); ?>								
									<img src="<?php echo $slide_item_image; ?>" width="100" style="margin: 0 auto;"/>
								</dt>
							</dl>
							<ul class="menu-item-transport"></ul>							
						</li>
					<?php } ?>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			</ul>
		</div>
	<?php }

}

if ( !function_exists( 'save_slide_sorting' ) ) {
	function save_slide_sorting() {
		global $wpdb;
		
		$order = explode(',', $_POST['order']);		
		$counter = 0;
		
		foreach($order as $slide_id) {
			$wpdb->update($wpdb->posts, array('menu_order' => $counter), array('ID' => $slide_id));
			$counter++;
		}

		die(1);
	}
	add_action('wp_ajax_slides_sort', 'save_slide_sorting');
}

if ( !function_exists( 'enqueue_sort_scripts' ) ) {
	function enqueue_sort_scripts() {
		wp_enqueue_script('jquery-ui-sortable');
		wp_register_script('slides_sort', get_template_directory_uri() . '/custom/slides_sort.js', 'jquery', '1.0.0', TRUE);
		$data = array( 'alert_error' => __( 'There was an error saving the update.', 'morphis' ) );			
		wp_localize_script( 'slides_sort', 'slides_sort_data', $data );
		wp_enqueue_script( 'slides_sort' );
	}
}

if ( !function_exists( 'enqueue_sort_styles' ) ) {
	function enqueue_sort_styles() {
		wp_enqueue_style('nav-menu');
	}
}

/**
 * Portfolio Items Sorting
 *
 * 
 */
if ( !function_exists( 'portfolio_items_sort_page' ) ) {
	function portfolio_items_sort_page() {
		$portfolio_items_sort_page = add_submenu_page('edit.php?post_type=portfolio', __('Sort Portfolio Items', 'morphis'), __('Sort Portfolio Items', 'morphis'), 'edit_posts', 'portfolio', 'portfolio_item_sort');
		
		
		add_action('admin_print_styles-' . $portfolio_items_sort_page, 'enqueue_portfolio_sort_styles');
		add_action('admin_print_scripts-' . $portfolio_items_sort_page, 'enqueue_portfolio_sort_scripts');
	}
	
	add_action('admin_menu', 'portfolio_items_sort_page');
}

if ( !function_exists( 'portfolio_item_sort' ) ) {

	function portfolio_item_sort() {
		$portfolio_items = new WP_Query('post_type=portfolio&posts_per_page=-1&orderby=menu_order&order=ASC');
	?>
		<div class="wrap">
			<div id="icon-tools" class="icon32"><br /></div>
			<h2><?php _e('Sort Portfolio Items', 'morphis'); ?></h2>
			<p><?php _e('Sort and/or re-order your portfolio items for showing on Portfolio Page. Top item will be the first item on the portfolio page.', 'morphis'); ?></p>

			<ul id="portfolio-items">
				<?php while( $portfolio_items->have_posts() ) : $portfolio_items->the_post(); ?>
					<?php if( get_post_status() == 'publish' ) { ?>
						<li id="<?php the_id(); ?>" class="menu-item">
							<dl class="menu-item-bar">
								<dt class="menu-item-handle">
									<span class="menu-item-title"><?php the_title(); ?></span>
								</dt>
								<dt class="menu-item-handle">
									<?php $featured_url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) ); ?>									
									<img src="<?php echo $featured_url; ?>" width="100" style="margin: 0 auto;"/>
								</dt>
							</dl>
							<ul class="menu-item-transport"></ul>
						</li>
					<?php } ?>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			</ul>
		</div>
	<?php }

}

if ( !function_exists( 'save_portfolio_sorting' ) ) {
	function save_portfolio_sorting() {
		global $wpdb;
		
		$order = explode(',', $_POST['order']);		
		$counter = 0;
		
		foreach($order as $portfolio_item_id) {
			$wpdb->update($wpdb->posts, array('menu_order' => $counter), array('ID' => $portfolio_item_id));
			$counter++;
		}

		die(1);
	}
	add_action('wp_ajax_portfolio_item_sort', 'save_portfolio_sorting');
}

if ( !function_exists( 'enqueue_portfolio_sort_scripts' ) ) {
	function enqueue_portfolio_sort_scripts() {
		wp_enqueue_script('jquery-ui-sortable');
		wp_register_script('portfolio_item_sort', get_template_directory_uri() . '/custom/portfolio_item_sort.js', 'jquery', '1.0.0', TRUE);
		$data = array( 'alert_error' => __( 'There was an error saving the update.', 'morphis' ) );			
		wp_localize_script( 'portfolio_item_sort', 'portfolio_item_sort_data', $data );
		wp_enqueue_script( 'portfolio_item_sort' );
	}
}

if ( !function_exists( 'enqueue_portfolio_sort_styles' ) ) {
	function enqueue_portfolio_sort_styles() {
		wp_enqueue_style('nav-menu');
		wp_register_style('portfolio-sorting', get_template_directory_uri() . '/css/portfolio-sorting.css', false, '1.0.0', 'all');		
		wp_enqueue_style('portfolio-sorting');
	}
}





/**
 * Services Items Sorting
 *
 * 
 */
if ( !function_exists( 'services_items_sort_page' ) ) {
	function services_items_sort_page() {
		$services_items_sort_page = add_submenu_page('edit.php?post_type=services', __('Sort Services Items', 'morphis'), __('Sort Services Items', 'morphis'), 'edit_posts', 'services', 'services_item_sort');
		
		add_action('admin_print_styles-' . $services_items_sort_page, 'enqueue_services_sort_styles');
		add_action('admin_print_scripts-' . $services_items_sort_page, 'enqueue_services_sort_scripts');
	}
	
	add_action('admin_menu', 'services_items_sort_page');
}

if ( !function_exists( 'services_item_sort' ) ) {

	function services_item_sort() {
		$services_items = new WP_Query('post_type=services&posts_per_page=-1&orderby=menu_order&order=ASC');
	?>
		<div class="wrap">
			<div id="icon-tools" class="icon32"><br /></div>
			<h2><?php _e('Sort Services Items', 'morphis'); ?></h2>
			<p><?php _e('Sort and/or re-order your Services items for showing on Services section - Home Page. Top item will be the first item.', 'morphis'); ?></p>

			<ul id="services-items">
				<?php while( $services_items->have_posts() ) : $services_items->the_post(); ?>
					<?php if( get_post_status() == 'publish' ) { ?>
						<li id="<?php the_id(); ?>" class="menu-item">
							<dl class="menu-item-bar">
								<dt class="menu-item-handle">
									<span class="menu-item-title"><?php the_title(); ?></span>
								</dt>								
							</dl>
							<ul class="menu-item-transport"></ul>
						</li>
					<?php } ?>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			</ul>
		</div>
	<?php }

}

if ( !function_exists( 'save_services_sorting' ) ) {

	function save_services_sorting() {
		global $wpdb;
		
		$order = explode(',', $_POST['order']);
		
		$counter = 0;
		
		foreach($order as $services_item_id) {
			$wpdb->update($wpdb->posts, array('menu_order' => $counter), array('ID' => $services_item_id));
			$counter++;
		}

		die(1);
	}

	add_action('wp_ajax_services_item_sort', 'save_services_sorting');

}

if ( !function_exists( 'enqueue_services_sort_scripts' ) ) {
	function enqueue_services_sort_scripts() {
		wp_enqueue_script('jquery-ui-sortable');
		wp_register_script('services_item_sort', get_template_directory_uri() . '/custom/services_item_sort.js', 'jquery', '1.0.0', TRUE);
		$data = array( 'alert_error' => __( 'There was an error saving the update.', 'morphis' ) );			
		wp_localize_script( 'services_item_sort', 'services_item_sort_data', $data );
		wp_enqueue_script( 'services_item_sort' );
	}
}

if ( !function_exists( 'enqueue_services_sort_styles' ) ) {
	function enqueue_services_sort_styles() {
		wp_enqueue_style('nav-menu');
	}
}

/**
 * Get global Page ID
 *
 * @since 1.0.0
 * @uses $wp_query
 */
if ( ! function_exists( 'pf_current_ID' ) ) {
	function pf_current_ID() {
		global $wp_query;
		$current_ID = null;
		if( isset( $wp_query->post ) ) {
			$current_ID = $wp_query->post->ID;
		}
		return $current_ID;
	}	
}


/**
 * Get LayerSider Slides
 *
 * @since 1.0.0
 * @uses $wpdb
 */
function get_layerslider_list() {
	
	// Get WPDB Object
    global $wpdb;
	
	$layerslides = array();
	
    // Table name
    $table_name = $wpdb->prefix . "layerslider";
 
    // Get sliders
    $sliders = $wpdb->get_results( "SELECT * FROM $table_name
                                        WHERE flag_hidden = '0' AND flag_deleted = '0'
                                        ORDER BY date_c ASC LIMIT 100" );
 
    // Iterate over the sliders
    foreach($sliders as $key => $item) {		
        $layerslides[$item->id] = $item->name;
    }
	
	return $layerslides;
	
}

function get_thumbnail_caption( $id ) {	
	$thumb = get_post( $id );
	return $thumb->post_excerpt;	
}

function morphis_remove_script_version( $src ){
	$parts = explode( '?', $src );
	return $parts[0];
}
add_filter( 'script_loader_src', 'morphis_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', 'morphis_remove_script_version', 15, 1 );
