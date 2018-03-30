<?php
/**
 * Heat functions and definitions
 *
 * @package WordPress
 * @subpackage Heat
 * @since Heat 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 730;

/**
 * Options Tree.
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
include_once( trailingslashit( get_template_directory() ) . 'option-tree/ot-loader.php' );

include_once( trailingslashit( get_template_directory() ) . 'inc/theme-options.php' );
	
/**
 * Tell WordPress to run mega_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'mega_setup' );

if ( ! function_exists( 'mega_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function mega_setup() {

	/* Make Heat available for translation.
	 * Translations can be added to the /languages/ directory.
	 */
	load_theme_textdomain( 'mega', get_template_directory() . '/languages' );

	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	require( get_template_directory() . '/inc/widgets.php' );
	
	// Load up our theme shortcodes and related code.
	require( get_template_directory() . '/inc/shortcodes.php' );
	require( get_template_directory() . '/inc/tinymce/tinymce.php' );

	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'mega' ) );

	// Add support for a variety of post formats
	add_theme_support( 'post-formats', array( 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio' ) );

	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page and custom backgrounds
	add_theme_support( 'post-thumbnails' );
	
	if ( function_exists( 'add_image_size' ) ) {
		add_image_size( 'gallery-thumb', 338, '', true ); // Thumb for Photo Gallery
		add_image_size( 'video-gallery-thumb', 450, '', true ); // Thumb for Video Gallery
		add_image_size( 'blog-thumb', 257, '', true ); // Thumb for Blog
	}
	
}
endif; // mega_setup

// Auto plugin activation
require_once( get_template_directory() . '/inc/class-tgm-plugin-activation.php' );
add_action('tgmpa_register', 'mega_register_required_plugins');
function mega_register_required_plugins() {
	$plugins = array(
		array(
			'name' 		=> 'Contact Form 7',
			'slug' 		=> 'contact-form-7',
			'required' 	=> false
		),
		array(
			'name' 		=> 'AddThis Share',
			'slug' 		=> 'addthis',
			'required' 	=> false
		),
	);

	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'mega';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', 'mega' ),
			'menu_title'                       			=> __( 'Install Plugins', 'mega' ),
			'installing'                       			=> __( 'Installing Plugin: %s', 'mega' ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', 'mega' ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', 'mega' ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'mega' ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'mega' ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa($plugins, $config);
}

/**
 * Registering a post type called "Portfolios".
 */
function create_portfolio_type() {
	register_post_type( 'portfolio',
		array(
			'labels' => array(
				'name' => __( 'Portfolios', 'mega' ),
				'singular_name' => __( 'Portfolio', 'mega' ),
				'add_new' => _x( 'Add New', 'portfolio', 'mega' ),
				'add_new_item' => __( 'Add New Portfolio', 'mega' ),
				'edit_item' => __( 'Edit Portfolio', 'mega' ),
				'new_item' => __( 'New Portfolio', 'mega' ),
				'all_items' => __( 'All Portfolios', 'mega' ),
				'view_item' => __( 'View Portfolio', 'mega' ),
				'search_items' => __( 'Search Portfolio', 'mega' ),
				'not_found' =>  __( 'No portfolios found', 'mega' ),
				'not_found_in_trash' => __( 'No portfolios found in Trash', 'mega' )
			),
			'publicly_queryable' => true,
			'show_ui' => true, 
			'show_in_menu' => true,
			'show_in_nav_menus' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'portfolio', 'with_front' => false ),
			'capability_type' => 'post',
			'has_archive' => false,
			'public' => true,
			'hierarchical' => false,
			'menu_position' => 5,
			'exclude_from_search' => true,
			'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' )
		)
	);
}
add_action( 'init', 'create_portfolio_type' );

// create taxonomy, categories for the post type "Portfolios"
function create_portfolio_taxonomies() {
	$labels = array(
		'name' => __( 'Categories', 'mega' ),
		'singular_name' => __( 'Category', 'mega' ),
		'all_items' => __( 'All Categories', 'mega' ),
	); 
	register_taxonomy( 'portfolio-category', array( 'portfolio' ), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_tagcloud' => false,
		'show_in_nav_menus' => false,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'portfolio-category' ),
	) );
}
add_action( 'init', 'create_portfolio_taxonomies' );

// add filter to ensure the text Portfolio, or portfolio, is displayed when user updates a portfolio 
function portfolio_updated_messages( $messages ) {
  global $post, $post_ID;

  $messages['portfolio'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Portfolio updated. <a href="%s">View portfolio</a>', 'mega'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.', 'mega'),
    3 => __('Custom field deleted.', 'mega'),
    4 => __('Portfolio updated.', 'mega'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Portfolio restored to revision from %s', 'mega'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Portfolio published. <a href="%s">View portfolio</a>', 'mega'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Portfolio saved.', 'mega'),
    8 => sprintf( __('Portfolio submitted. <a target="_blank" href="%s">Preview portfolio</a>', 'mega'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Portfolio scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview portfolio</a>', 'mega'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i', 'mega' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Portfolio draft updated. <a target="_blank" href="%s">Preview portfolio</a>', 'mega'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}
add_filter( 'post_updated_messages', 'portfolio_updated_messages' );

// display contextual help for Portfolio

function portfolio_add_help_text( $contextual_help, $screen_id, $screen ) {
  // $contextual_help .= var_dump( $screen ); // use this to help determine $screen->id
  if ( 'portfolio' == $screen->id ) {
    $customize_display = '<p>' . __('The title field and the big Portfolio Editing Area are fixed in place, but you can reposition all the other boxes using drag and drop, and can minimize or expand them by clicking the title bar of each box. Use the Screen Options tab to unhide more boxes (Excerpt, Send Trackbacks, Custom Fields, Discussion, Slug, Author) or to choose a 1- or 2-column layout for this screen.', 'mega') . '</p>';

	get_current_screen()->add_help_tab( array(
		'id'      => 'customize-display',
		'title'   => __('Customizing This Display', 'mega'),
		'content' => $customize_display,
	) );

	$title_and_editor  = '<p>' . __('<strong>Title</strong> - Enter a title for your portfolio. After you enter a title, you&#8217;ll see the permalink below, which you can edit.', 'mega') . '</p>';
	$title_and_editor .= '<p>' . __('<strong>Portfolio editor</strong> - Enter the text for your portfolio. There are two modes of editing: Visual and HTML. Choose the mode by clicking on the appropriate tab. Visual mode gives you a WYSIWYG editor. Click the last icon in the row to get a second row of controls. The HTML mode allows you to enter raw HTML along with your portfolio text. You can insert media files by clicking the icons above the portfolio editor and following the directions. You can go to the distraction-free writing screen via the Fullscreen icon in Visual mode (second to last in the top row) or the Fullscreen button in HTML mode (last in the row). Once there, you can make buttons visible by hovering over the top area. Exit Fullscreen back to the regular portfolio editor.', 'mega') . '</p>';

	get_current_screen()->add_help_tab( array(
		'id'      => 'title-portfolio-editor',
		'title'   => __('Title and Portfolio Editor', 'mega'),
		'content' => $title_and_editor,
	) );

	$publish_box = '<p>' . __('<strong>Publish</strong> - You can set the terms of publishing your portfolio in the Publish box. For Status, Visibility, and Publish (immediately), click on the Edit link to reveal more options. Visibility includes options for password-protecting a portfolio or making it stay at the top of your blog indefinitely (sticky). Publish (immediately) allows you to set a future or past date and time, so you can schedule a portfolio to be published in the future or backdate a portfolio.', 'mega') . '</p>';

	if ( current_theme_supports( 'post-thumbnails' ) && post_type_supports( 'post', 'thumbnail' ) ) {
		$publish_box .= '<p>' . __('<strong>Featured Image</strong> - This allows you to associate an image with your portfolio without inserting it. This is usually useful only if your theme makes use of the featured image as a portfolio thumbnail on the home page, a custom header, etc.', 'mega') . '</p>';
	}

	get_current_screen()->add_help_tab( array(
		'id'      => 'publish-box',
		'title'   => __('Publish Box', 'mega'),
		'content' => $publish_box,
	) );

	$discussion_settings  = '<p>' . __('<strong>Send Trackbacks</strong> - Trackbacks are a way to notify legacy blog systems that you&#8217;ve linked to them. Enter the URL(s) you want to send trackbacks. If you link to other WordPress sites they&#8217;ll be notified automatically using pingbacks, and this field is unnecessary.', 'mega') . '</p>';
	$discussion_settings .= '<p>' . __('<strong>Discussion</strong> - You can turn comments and pings on or off, and if there are comments on the portfolio, you can see them here and moderate them.', 'mega') . '</p>';

	get_current_screen()->add_help_tab( array(
		'id'      => 'discussion-settings',
		'title'   => __('Discussion Settings', 'mega'),
		'content' => $discussion_settings,
	) );

	get_current_screen()->set_help_sidebar(
			'<p>' . sprintf(__('You can also create portfolio with the <a href="%s">Press This bookmarklet</a>.'), 'mega') . '</p>' .
			'<p><strong>' . __('For more information:', 'mega') . '</strong></p>' .
			'<p>' . __('<a href="http://codex.wordpress.org/Posts_Add_New_Screen" target="_blank">Documentation on Writing and Editing Posts</a>', 'mega') . '</p>' .
			'<p>' . __('<a href="http://wordpress.org/support/" target="_blank">Support Forums</a>', 'mega') . '</p>'
	);
  }
  return $contextual_help;
}
add_action( 'contextual_help', 'portfolio_add_help_text', 10, 3 );

/**
 * Registering a post type called "Galleries".
 */
function create_gallery_type() {
	register_post_type( 'gallery',
		array(
			'labels' => array(
				'name' => __( 'Galleries', 'mega' ),
				'singular_name' => __( 'Gallery', 'mega' ),
				'add_new' => _x('Add New', 'gallery', 'mega'),
				'add_new_item' => __( 'Add New Gallery', 'mega' ),
				'edit_item' => __( 'Edit Gallery', 'mega' ),
				'new_item' => __( 'New Gallery', 'mega' ),
				'all_items' => __( 'All Galleries', 'mega' ),
				'view_item' => __( 'View Gallery', 'mega' ),
				'search_items' => __( 'Search Gallery', 'mega' ),
				'not_found' =>  __( 'No galleries found', 'mega' ),
				'not_found_in_trash' => __( 'No galleries found in Trash', 'mega' )
			),
			'publicly_queryable' => true,
			'show_ui' => true, 
			'show_in_menu' => true,
			'show_in_nav_menus' => true,
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'has_archive' => false,
			'public' => true,
			'hierarchical' => false,
			'menu_position' => 5,
			'exclude_from_search' => true,
			'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' )
		)
	);
}
add_action( 'init', 'create_gallery_type' );

// create taxonomy, categories for the post type "Galleries"
function create_gallery_taxonomies() {
	$labels = array(
		'name' => __( 'Categories', 'mega' ),
		'singular_name' => __( 'Category', 'mega' ),
		'all_items' => __( 'All Categories', 'mega' ),
	); 
	register_taxonomy( 'gallery-category', array( 'gallery' ), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_tagcloud' => false,
		'show_in_nav_menus' => false,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'gallery-category' ),
	) );
}
add_action( 'init', 'create_gallery_taxonomies' );

// add filter to ensure the text Gallery, or gallery, is displayed when user updates a gallery 
function gallery_updated_messages( $messages ) {
  global $post, $post_ID;

  $messages['gallery'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Gallery updated. <a href="%s">View gallery</a>', 'mega'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.', 'mega'),
    3 => __('Custom field deleted.', 'mega'),
    4 => __('Gallery updated.', 'mega'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Gallery restored to revision from %s', 'mega'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Gallery published. <a href="%s">View gallery</a>', 'mega'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Gallery saved.', 'mega'),
    8 => sprintf( __('Gallery submitted. <a target="_blank" href="%s">Preview gallery</a>', 'mega'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Gallery scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview gallery</a>', 'mega'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i', 'mega' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Gallery draft updated. <a target="_blank" href="%s">Preview gallery</a>', 'mega'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}
add_filter( 'post_updated_messages', 'gallery_updated_messages' );

// display contextual help for Gallery

function gallery_add_help_text( $contextual_help, $screen_id, $screen ) {
  // $contextual_help .= var_dump( $screen ); // use this to help determine $screen->id
  if ( 'gallery' == $screen->id ) {
    $customize_display = '<p>' . __('The title field and the big Gallery Editing Area are fixed in place, but you can reposition all the other boxes using drag and drop, and can minimize or expand them by clicking the title bar of each box. Use the Screen Options tab to unhide more boxes (Excerpt, Send Trackbacks, Custom Fields, Discussion, Slug, Author) or to choose a 1- or 2-column layout for this screen.', 'mega') . '</p>';

	get_current_screen()->add_help_tab( array(
		'id'      => 'customize-display',
		'title'   => __('Customizing This Display', 'mega'),
		'content' => $customize_display,
	) );

	$title_and_editor  = '<p>' . __('<strong>Title</strong> - Enter a title for your gallery. After you enter a title, you&#8217;ll see the permalink below, which you can edit.', 'mega') . '</p>';
	$title_and_editor .= '<p>' . __('<strong>Gallery editor</strong> - Enter the text for your gallery. There are two modes of editing: Visual and HTML. Choose the mode by clicking on the appropriate tab. Visual mode gives you a WYSIWYG editor. Click the last icon in the row to get a second row of controls. The HTML mode allows you to enter raw HTML along with your gallery text. You can insert media files by clicking the icons above the gallery editor and following the directions. You can go to the distraction-free writing screen via the Fullscreen icon in Visual mode (second to last in the top row) or the Fullscreen button in HTML mode (last in the row). Once there, you can make buttons visible by hovering over the top area. Exit Fullscreen back to the regular gallery editor.', 'mega') . '</p>';

	get_current_screen()->add_help_tab( array(
		'id'      => 'title-gallery-editor',
		'title'   => __('Title and Gallery Editor', 'mega'),
		'content' => $title_and_editor,
	) );

	$publish_box = '<p>' . __('<strong>Publish</strong> - You can set the terms of publishing your gallery in the Publish box. For Status, Visibility, and Publish (immediately), click on the Edit link to reveal more options. Visibility includes options for password-protecting a gallery or making it stay at the top of your blog indefinitely (sticky). Publish (immediately) allows you to set a future or past date and time, so you can schedule a gallery to be published in the future or backdate a gallery.', 'mega') . '</p>';

	if ( current_theme_supports( 'post-thumbnails' ) && post_type_supports( 'post', 'thumbnail' ) ) {
		$publish_box .= '<p>' . __('<strong>Featured Image</strong> - This allows you to associate an image with your gallery without inserting it. This is usually useful only if your theme makes use of the featured image as a gallery thumbnail on the home page, a custom header, etc.', 'mega') . '</p>';
	}

	get_current_screen()->add_help_tab( array(
		'id'      => 'publish-box',
		'title'   => __('Publish Box', 'mega'),
		'content' => $publish_box,
	) );

	$discussion_settings  = '<p>' . __('<strong>Send Trackbacks</strong> - Trackbacks are a way to notify legacy blog systems that you&#8217;ve linked to them. Enter the URL(s) you want to send trackbacks. If you link to other WordPress sites they&#8217;ll be notified automatically using pingbacks, and this field is unnecessary.', 'mega') . '</p>';
	$discussion_settings .= '<p>' . __('<strong>Discussion</strong> - You can turn comments and pings on or off, and if there are comments on the gallery, you can see them here and moderate them.', 'mega') . '</p>';

	get_current_screen()->add_help_tab( array(
		'id'      => 'discussion-settings',
		'title'   => __('Discussion Settings', 'mega'),
		'content' => $discussion_settings,
	) );

	get_current_screen()->set_help_sidebar(
			'<p>' . sprintf(__('You can also create gallery with the <a href="%s">Press This bookmarklet</a>.'), 'mega') . '</p>' .
			'<p><strong>' . __('For more information:', 'mega') . '</strong></p>' .
			'<p>' . __('<a href="http://codex.wordpress.org/Posts_Add_New_Screen" target="_blank">Documentation on Writing and Editing Posts</a>', 'mega') . '</p>' .
			'<p>' . __('<a href="http://wordpress.org/support/" target="_blank">Support Forums</a>', 'mega') . '</p>'
	);
  }
  return $contextual_help;
}
add_action( 'contextual_help', 'gallery_add_help_text', 10, 3 );

/**
 * Sets the post excerpt length to 40 words.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 */
function mega_excerpt_length( $length ) {
		return 30;
}
add_filter( 'excerpt_length', 'mega_excerpt_length' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis.
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function mega_auto_excerpt_more( $more ) {
	return ' &hellip;';
}
add_filter( 'excerpt_more', 'mega_auto_excerpt_more' );

/**
 * Get taxonomies terms links.
 */
function custom_taxonomies_terms_links() {
	global $post, $post_id;
	// get post by post id
	$post = &get_post( $post->ID );
	// get post type by post
	$post_type = $post->post_type;
	// get post type taxonomies
	$taxonomies = get_object_taxonomies( $post_type );
	foreach ( $taxonomies as $taxonomy ) {
		// get the terms related to post
		$terms = get_the_terms( $post->ID, $taxonomy );
		if ( !empty( $terms ) ) {
			$out = array();
			foreach ( $terms as $term ) {
				$out[] = $term->name;
			}
			$return = '<div class="entry-category"><i class="foundicon-folder"></i> ' . join( ', ', $out ) . '</div><!-- .entry-category -->';
			return $return;
		}
	}
}

/**
 * Remove title attribute from images.
 */
function wp_get_attachment_image_attributes_title_filter( $attr ) {
	unset( $attr['title'] );
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'wp_get_attachment_image_attributes_title_filter' );

/**
 * Register our sidebars and widgetized areas.
 */
function mega_widgets_init() {

	register_widget( 'twitter' );

	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'mega' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Page Sidebar', 'mega' ),
		'id' => 'sidebar-2',
		'description' => __( 'An optional widget area for your pages', 'mega' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	) );
}
add_action( 'widgets_init', 'mega_widgets_init' );

if ( ! function_exists( 'mega_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function mega_content_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'mega' ); ?></h3>
			<div class="nav-previous"><?php next_posts_link( __( '<i class="icon-chevron-left"></i> Older Entries', 'mega' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer Entries <i class="icon-chevron-right"></i>', 'mega' ) ); ?></div>
		</nav><!-- #nav-above -->
	<?php endif;
}
endif; // mega_content_nav

if ( ! function_exists( 'mega_pagination_content_nav_load_more' ) ) :
/**
 * Display navigation with load more button for infinite scroll
 */
function mega_pagination_content_nav_load_more( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'mega' ); ?></h3>
			
			<?php $big = 999999999; // need an unlikely integer

			echo paginate_links( array(
				'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
				'format' => '?paged=%#%',
				'current' => max( 1, get_query_var('paged') ),
				'total' => $wp_query->max_num_pages,
				'prev_text' => __('Older', 'mega'),
				'next_text' => __('Newer', 'mega'),
				'mid_size' => 0,
				'end_size' => 0
			) ); ?>
			
			<?php $total_posts = $wp_query->found_posts; ?>
			
			<?php $data_tag = '';
				if ( is_category() )
					$data_tag = 'data-category="'. get_query_var('cat') .'"';
				if ( is_author() )
					$data_tag = 'data-author="'. get_query_var('author') .'"';
				if ( is_tag() )
					$data_tag = 'data-tag="'. get_query_var('tag') .'"';
				if ( is_date() )
					$data_tag = 'data-month="'. get_query_var('monthnum') .'" data-year="'.get_query_var('year').'"';
				if ( is_search() )
					$data_tag = 'data-search="'. get_query_var('s') .'"'; 
			?>
			
			<a id="load-more" href="#" <?php echo $data_tag;?> data-total-posts="<?php echo $total_posts; ?>" data-perpage="<?php echo get_option( 'posts_per_page' ); ?>">
				<span class="text"><i class="general foundicon-plus"></i> <?php _e('Load more', 'mega') ?></span>
				<span id="posts-count" data-loader="<?php echo get_template_directory_uri(); ?>/images/preloader.gif"></span>
			</a>
		</nav><!-- #nav-above -->
	<?php endif;
}
endif; // mega_pagination_content_nav_load_more

/**
 * Return the URL for the first link found in the post content.
 *
 * @return string|bool URL or false when no link is present.
 */
function mega_url_grabber() {
	if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) )
		return false;

	return esc_url_raw( $matches[1] );
}

if ( ! function_exists( 'mega_comment' ) ) :
/**
 * Template for comments and pingbacks.
 */
function mega_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'mega' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'mega' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="avatar vcard">
					<?php
						$avatar_size = 45;

						echo get_avatar( $comment, $avatar_size );

					?>

				</div><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'mega' ); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content">
			<div class="comment-author vcard">
					<?php

						// translators: 1: comment author, 2: date and time */
						printf( __( '%1$s on %2$s <span class="says"> - </span>', 'mega' ),
							
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s %2$s', 'mega' ), get_comment_date('M j, Y'), get_comment_time() )
							)
						);
						
						comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'mega' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );
							$show_sep = true;
							if ( $show_sep ) :
								$sep = '<span class="sep"> &middot; </span>';
							endif; // End if $show_sep
							edit_comment_link( __( 'Edit', 'mega' ), '' . $sep . '<span class="edit-link">', '</span>' );
					?>

			</div><!-- .comment-author .vcard -->
				
			<?php comment_text(); ?>
			
			</div>

		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for mega_comment()

if ( ! function_exists( 'mega_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function mega_posted_on() {
	printf( __( '<p><time class="entry-date" datetime="%2$s" pubdate>%3$s</time></p><span class="by-author"> <span class="sep"> / </span> <span class="author vcard"><a class="url fn n" href="%4$s" title="%5$s" rel="author"><i class="icon-user"></i> %6$s</a></span></span>', 'mega' ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'mega' ), get_the_author() ) ),
		get_the_author()
	);
}
endif;

	/**
	 * Create WP3 menu areas.
	 */
	register_nav_menus( array( 'primary' => 'Primary Menu', 'mobile_menu' => 'Mobile Menu' ) );

/**
 * Using a Custom Walker Function for wp_list_categories for portfolio.
 */
class Walker_Portfolio_Category extends Walker_Category {
   function start_el(&$output, $category, $depth, $args) {
      extract($args);
      $cat_name = esc_attr( $category->name);
      $cat_name = apply_filters( 'list_cats', $cat_name, $category );
	  $link = '<a href="#" data-filter=".'.$category->slug.'" ';
      if ( ! ( $use_desc_for_title == 0 || empty($category->description) ) )
         $link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
      $link .= '>';
      $link .= $cat_name;
      $link .= '</a>';
      if ( (! empty($feed_image)) || (! empty($feed)) ) {
         $link .= ' ';
         if ( empty($feed_image) )
            $link .= '(';
         $link .= '<a href="' . get_category_feed_link($category->term_id, $feed_type) . '"';
         if ( empty($feed) )
            $alt = ' alt="' . sprintf(__( 'Feed for all posts filed under %s', 'mega' ), $cat_name ) . '"';
         else {
            $title = ' title="' . $feed . '"';
            $alt = ' alt="' . $feed . '"';
            $name = $feed;
            $link .= $title;
         }
         $link .= '>';
         if ( empty($feed_image) )
            $link .= $name;
         else
            $link .= "<img src='$feed_image'$alt$title" . ' />';
         $link .= '</a>';
         if ( empty($feed_image) )
            $link .= ')';
      }
      if ( isset($show_count) && $show_count )
         $link .= ' (' . intval($category->count) . ')';
      if ( isset($show_date) && $show_date ) {
         $link .= ' ' . gmdate('Y-m-d', $category->last_update_timestamp);
      }
      if ( isset($current_category) && $current_category )
         $_current_category = get_category( $current_category );
      if ( 'list' == $args['style'] ) {
          $output .= '<li class="segment-'.rand(2, 99).'"';
          $class = 'cat-item cat-item-'.$category->term_id;
          if ( isset($current_category) && $current_category && ($category->term_id == $current_category) )
             $class .=  ' current-cat';
          elseif ( isset($_current_category) && $_current_category && ($category->term_id == $_current_category->parent) )
             $class .=  ' current-cat-parent';
          $output .=  '';
          $output .= ">$link\n";
       } else {
          $output .= "\t$link<br />\n";
       }
   }
}

/**
 * Adds custom taxonomies to the post class.
 */
if ( ! function_exists( 'custom_taxonomy_post_class' ) ) {

	function custom_taxonomy_post_class( $classes, $class, $ID ) {

			if ( ( 'portfolio' == get_post_type() ) ) {
	
				$taxonomy = 'portfolio-category';
			
			} else if ( ( 'gallery' == get_post_type() ) ) {
			
				$taxonomy = 'gallery-category';
			
			}
			
			if ( ! empty( $taxonomy ) ) {

				$terms = get_the_terms( (int) $ID, $taxonomy );
				
					if ( ! empty( $terms ) ) {

						foreach( (array) $terms as $order => $term ) {
					   
							if ( ! in_array( $term->slug, $classes ) ) {

								$classes[] = 'element ' . $term->slug . '';

							}
						
						}

					}
				
			}

            return $classes;

        }

    }
add_filter( 'post_class', 'custom_taxonomy_post_class', 10, 3 );

/**
 * Adds classes to the array of body classes.
 */
function mega_body_classes( $classes ) {

	if ( function_exists( 'is_multi_author' ) && ! is_multi_author() )
		$classes[] = 'single-author';

	if ( is_singular() && ! is_home() )
		$classes[] = 'singular';
		
	$gallery_script = get_post_meta( get_the_ID(), 'mega_gallery_script', true );
	if ( is_page_template('page-full-width-slider.php') || is_page_template('page-home-slider.php') || is_singular('gallery') && $gallery_script == 'Full Width Slider' ) {
		$classes[] = 'full-width-slider';
	}

	return $classes;
}
add_filter( 'body_class', 'mega_body_classes' );

/**
 * Video URL field.
 */
add_action( 'init', 'mega_init' );
function mega_init() {
        register_taxonomy_for_object_type( 'category', 'attachment' );
}

add_filter( 'attachment_fields_to_edit', 'mega_attachment_fields_to_edit', 10, 2 );
function mega_attachment_fields_to_edit( $fields, $post ) {
		$fields['mega-attachment-video-url'] = array(
			'label' => 'Video URL',
			'input' => 'text',
			'value' => get_post_meta( $post->ID, 'mega-attachment-video-url', true ),
			'show_in_edit' => false,
		);
        return $fields;
}

/**
 * Save Custom Values in media uploader.
 */
function mega_attachment_field_custom_save( $post, $attachment ) {
	if ( isset( $attachment['mega-attachment-video-url'] ) )
		update_post_meta( $post['ID'], 'mega-attachment-video-url', $attachment['mega-attachment-video-url'] );	
		
	return $post;
}
add_filter( 'attachment_fields_to_save', 'mega_attachment_field_custom_save', 10, 2 );

/**
 * Ajaxify Blog.
 */
function mega_ajax_blog() {
	$posts_per_page  = get_option( 'posts_per_page' );
	$nonce = $_POST['nonce'];		
	$author = $_POST['author'];
	$category = $_POST['category'];
	$tag = $_POST['tag'];
	$datemonth 	= $_POST['datemonth'];
	$dateyear = $_POST['dateyear'];
	$search = $_POST['search'];
	$offset = $_POST['offset'];	
	
	if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
        die ( 'Forbidden!');		

    query_posts( array(
					'offset' => $offset,
					'posts_per_page' => $posts_per_page,
					'post_status' => 'publish', 
					'author' => $author,					
					'cat' => $category,
					'tag' => $tag,
					'monthnum' => $datemonth,
					'dateyear' => $dateyear,
					's' => $search ) );
   	
    get_template_part( 'loop' );
  
	wp_reset_query();
  
    exit;
}
add_action( 'wp_ajax_mega_ajax_blog', 'mega_ajax_blog' ); 
add_action( 'wp_ajax_nopriv_mega_ajax_blog', 'mega_ajax_blog' );

/**
 * Ajaxify Gallery.
 */
function mega_ajax_gallery() {
	$offset = $_POST['offset'];	
	$numberposts = $_POST['numberposts'];	
	$pageid = $_POST['pageid'];
	$nonce = $_POST['nonce'];
	
	if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
        die ( 'Forbidden!' );
		
	$args = array(
            'orderby' => 'menu_order',
			'order' => 'ASC',
            'post_type' => 'attachment',
            'post_parent' => $pageid,
            'post_mime_type' => 'image',
            'post_status' => null,
            'numberposts' => $numberposts,
			'offset' => $offset
        );
        $attachments = get_posts( $args ); 
	
		$showtitle = get_post_meta( $pageid, 'mega_photos_title', true );
		
		if ( $attachments ) :
			foreach ( $attachments as $attachment ) :         
				$bigsrc =  wp_get_attachment_image_src( $attachment->ID, 'full' ); 
				$zoom  = $bigsrc[0];
				$src = wp_get_attachment_image_src( $attachment->ID, 'gallery-thumb' ); 
				$attachmenttitle = apply_filters( 'the_title', $attachment->post_title );
				$class = "media-image";
				?>
				
				<li class="gallery-item <?php echo $class;?>">
					<a href="<?php echo $zoom; ?>" rel="external" <?php if ( $showtitle == __( 'yes', 'mega' ) )  echo 'title="'. $attachmenttitle .'"'; ?>>
						<img src="<?php echo $src[0]; ?>" width="<?php echo $src[1];?>" height="<?php echo $src[2]; ?>" alt="<?php echo $attachmenttitle; ?>"  />
						<div class="entry-view-wrapper <?php echo $class; ?>"></div>
					</a>
				</li>   							
			
			<?php endforeach; 
		endif;

	exit;
}
add_action( 'wp_ajax_nopriv_mega_ajax_gallery', 'mega_ajax_gallery');
add_action( 'wp_ajax_mega_ajax_gallery', 'mega_ajax_gallery');

/**
 * Loads a set of CSS and/or Javascript documents. 
 */
function mega_enqueue_admin_scripts($hook) {
	wp_register_style( 'ot-admin-custom', get_template_directory_uri() . '/inc/css/ot-admin-custom.css' );
	if ( $hook == 'appearance_page_ot-theme-options' ) {
		wp_enqueue_style( 'ot-admin-custom' );
	}

	wp_register_style( 'admin.custom', get_template_directory_uri() . '/inc/css/admin.custom.css' );
	wp_register_script( 'jquery.admin.custom', get_template_directory_uri() . '/inc/jquery.admin.custom.js', array( 'jquery' ) );
	if( $hook != 'edit.php' && $hook != 'post.php' && $hook != 'post-new.php' ) 
		return;
	wp_enqueue_style( 'admin.custom' );
	wp_enqueue_script( 'jquery.admin.custom' );
}
add_action( 'admin_enqueue_scripts', 'mega_enqueue_admin_scripts' );

/**
 * A safe way to add/enqueue a CSS/JavaScript. 
 */
 function mega_enqueue_scripts() {
	// A safe way to register a JavaScript file.
	wp_register_script( 'jquery.shortcodes', get_template_directory_uri() . '/js/jquery.shortcodes.js', array( 'jquery-ui-tabs', 'jquery-ui-accordion' ) );
	wp_register_script( 'jquery.widgets', get_template_directory_uri() . '/js/jquery.widgets.js' );
	wp_register_script( 'jquery.iosslider.min', get_template_directory_uri() . '/js/jquery.iosslider.min.js', array( 'jquery' ), false, false );
	wp_register_script( 'jquery.isotope.min', get_template_directory_uri() . '/js/jquery.isotope.min.js', array( 'jquery' ), false, false );
	wp_register_script( 'jquery.blog', get_template_directory_uri() . '/js/jquery.blog.js' );
	wp_localize_script( 'jquery.blog', 'megaAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'nonce' => wp_create_nonce( 'ajax-nonce' ) ) );
	wp_register_script( 'jquery.galleries-list', get_template_directory_uri() . '/js/jquery.galleries-list.js', array(), false, true );
	wp_localize_script( 'jquery.galleries-list', 'megaAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'nonce' => wp_create_nonce( 'ajax-nonce' ) ) );
	wp_register_script( 'jquery.portfolio', get_template_directory_uri() . '/js/jquery.portfolio.js', array(), false, true );
	
	if ( is_page_template('page-portfolio.php') ) :
		wp_localize_script( 'jquery.portfolio', 'megaAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'nonce' => wp_create_nonce( 'ajax-nonce' ) ) );
	endif;
	
	wp_register_script( 'jquery.gallery', get_template_directory_uri() . '/js/jquery.gallery.js', array(), false, true );
	
	if ( is_page_template('page-gallery.php') || is_singular('gallery') ) :
		wp_localize_script( 'jquery.gallery', 'megaAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'nonce' => wp_create_nonce( 'ajax-nonce' ) ) );
	endif;
	
	wp_register_script( 'jquery.gallery-video', get_template_directory_uri() . '/js/jquery.gallery-video.js', array(), false, true );
	
	if ( is_page_template('page-gallery-video.php') || is_singular('gallery') ) :
		wp_localize_script( 'jquery.gallery-video', 'megaAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'nonce' => wp_create_nonce( 'ajax-nonce' ) ) );
	endif;
	
	wp_register_script( 'klass.min', get_template_directory_uri() . '/js/klass.min.js', array(), false, true );
	wp_register_script( 'code.photoswipe-3.0.5.min', get_template_directory_uri() . '/js/code.photoswipe-3.0.5.min.js', array(), false, true );
	wp_register_script( 'photoswipe-init', get_template_directory_uri() . '/js/photoswipe-init.js', array(), false, true );
	wp_register_script( 'jquery.royalslider.min', get_template_directory_uri() . '/js/jquery.royalslider.min.js', array(), false, true );
	wp_register_script( 'jquery.jtweetsanywhere-1.3.1.min', get_template_directory_uri() . '/js/jquery.jtweetsanywhere-1.3.1.min.js' );
	wp_register_script( 'jquery.jplayer.min', get_template_directory_uri() . '/js/jquery.jplayer.min.js', array(), false, true );
	
	wp_register_script( 'jquery.fancybox.pack', get_template_directory_uri() . '/js/jquery.fancybox.pack.js', array(), false, true );
	wp_register_script( 'jquery.fancybox-buttons', get_template_directory_uri() . '/js/jquery.fancybox-buttons.js', array(), false, true );
	wp_register_script( 'jquery.fancybox-media', get_template_directory_uri() . '/js/jquery.fancybox-media.js', array(), false, true );
	
	wp_register_script( 'jquery.mega', get_template_directory_uri() . '/js/jquery.mega.js', array( 'jquery' ), false, true );

	if ( ! is_404() ) {
	
		// A safe way to add/enqueue a JavaScript file.
		if ( is_singular('portfolio') || is_page_template('page-slider.php') ) :
			wp_enqueue_script( 'jquery.iosslider.min' );
		endif;
		
		if ( is_page_template('page-galleries-list.php') ) :
				wp_enqueue_script( 'jquery.isotope.min' );
				wp_enqueue_script( 'jquery.galleries-list' );
		endif;
		
		if ( is_page_template('page-portfolio.php') ) :
				wp_enqueue_script( 'jquery.isotope.min' );
				wp_enqueue_script( 'jquery.portfolio' );
		endif;
		
		if ( is_singular('gallery') ) :
			$gallery_script = get_post_meta( get_the_ID(), 'mega_gallery_script', true );
			if ( $gallery_script == 'Full Width Slider' || $gallery_script == 'Gallery with Visible Nearby Images' ) {
				wp_enqueue_script( 'jquery.royalslider.min');
			}
			else if ( $gallery_script == 'Slider' ) {
				wp_enqueue_script( 'jquery.iosslider.min' );
			}
			else if ( $gallery_script == 'Video Gallery' ) {
				wp_enqueue_script( 'jquery.isotope.min' );
				wp_enqueue_script('jquery.gallery-video');
				wp_enqueue_script('jquery.fancybox.pack');
				wp_enqueue_script('jquery.fancybox-buttons');
				wp_enqueue_script('jquery.fancybox-media');
			} else {
				wp_enqueue_script( 'jquery.isotope.min' );
				wp_enqueue_script('jquery.gallery');
				wp_enqueue_script( 'klass.min');
				wp_enqueue_script( 'code.photoswipe-3.0.5.min');
				wp_enqueue_script( 'photoswipe-init');
			}
		endif;
		
		if ( is_page_template('page-full-width-slider.php') || is_page_template('page-home-slider.php') || is_page_template('page-gallery-visible-nearby.php') ) :
			wp_enqueue_script( 'jquery.royalslider.min');
		endif;
		
		if ( is_page_template('page-gallery-video.php') ) :
			wp_enqueue_script( 'jquery.isotope.min' );
			wp_enqueue_script('jquery.gallery-video');
			wp_enqueue_script('jquery.fancybox.pack');
			wp_enqueue_script('jquery.fancybox-buttons');
			wp_enqueue_script('jquery.fancybox-media');
		endif;
		
		if ( is_home() || is_archive() || is_search() ) :
			wp_enqueue_script( 'jquery.isotope.min' );
			wp_enqueue_script('jquery.blog');
			wp_enqueue_script( 'jquery.jplayer.min' );
		endif;
		
		if ( is_home() || is_archive() || is_search() || is_singular('post') ) :
			wp_enqueue_script( 'jquery.jplayer.min' );
		endif;
		
		wp_enqueue_script( 'jquery.shortcodes' );
		
		if ( is_active_widget( false, false, 'widget_recent_twitter_updates', true ) && is_singular('post') ) {
			wp_enqueue_script( 'jquery.jtweetsanywhere-1.3.1.min' );
			wp_enqueue_script( 'jquery.widgets' );
		}
		
		if ( is_active_widget( false, false, 'widget_recent_twitter_updates', true ) && ( is_page() && ! is_page_template() ) ) {
			wp_enqueue_script( 'jquery.jtweetsanywhere-1.3.1.min' );
			wp_enqueue_script( 'jquery.widgets' );
		}
		
		wp_enqueue_script( 'jquery.mega' );
		
		if ( is_page_template('page-gallery.php') ) :
			wp_enqueue_script( 'jquery.isotope.min' );
			wp_enqueue_script('jquery.gallery');
			wp_enqueue_script( 'klass.min');
			wp_enqueue_script( 'code.photoswipe-3.0.5.min');
			wp_enqueue_script( 'photoswipe-init');
		endif;
	
	}
	
}
add_action( 'wp_enqueue_scripts', 'mega_enqueue_scripts' ); 

/**
 * Initialize jQuery Plugins.
 */
function mega_initialize_jquery_plugins() {
	
?>
	<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	<?php
	global $wp_the_query;
	$pageid = $wp_the_query->get_queried_object_id();
	$mediaType = get_post_meta( $pageid, 'mega_portfolio_type', true );
	?>
	
	<?php $gallery_script = get_post_meta( get_the_ID(), 'mega_gallery_script', true ); ?>
	<?php if ( is_singular( 'portfolio' ) && $mediaType == 'Images' || is_page_template('page-slider.php') || $gallery_script == 'Slider' ) { ?>
	<?php $iosslider_scrollbar = ot_get_option( 'iosslider_scrollbar' ); ?>
	<?php
	if ( ! empty( $iosslider_scrollbar ) ) {
		$iosslider_scrollbar = 'true';
	} else {
		$iosslider_scrollbar = 'false';
	}
	?>
			<script>
				jQuery(document).ready(function() {
					// cache container
					var $carouselGallery = jQuery('#carousel-gallery');				
					$carouselGallery.imagesLoaded( function(){
						initControl();
					});					
					jQuery(window).smartresize(function(){
						initControl();
					});
					
					// Deinitializing slider for tiny screens, and initialising for others
					var is_init = false;
					var initControl = function() {
						var mediaQueryId = getComputedStyle(document.body, ':after').getPropertyValue('content');
						if ( mediaQueryId == 'tiny' && is_init ) {	
							deinitIosSlider();
						} else if ( mediaQueryId != 'tiny' && !is_init ) {
							initIosSlider();
						}
					}
					
					// IosSlider initialization
					var slideNum = 1;
					var initIosSlider = function(){
						is_init = true;
					    var iosSlider = jQuery('.iosSlider').iosSlider({
							snapToChildren: true,
							desktopClickDrag: true,
							infiniteSlider: false,
							snapSlideCenter: false,
							stageCSS: {
								overflow: 'visible'
							},
							scrollbar: <?php echo $iosslider_scrollbar; ?>,
							scrollbarHide: false,
							scrollbarLocation: 'bottom',
							scrollbarMargin: '0px',
							scrollbarBorderRadius: '0px',
							scrollbarOpacity: 0.55,
							scrollbarBackground: '#111111',
							//startAtSlide: slideNum, 
							responsiveSlideContainer: true,
							responsiveSlides: true,
							frictionCoefficient: 0.98,
							onSliderResize: sliderResize,
							keyboardControls: true,
							onSlideComplete: slideComplete,
							navNextSelector: jQuery('.iosNext'),
							navPrevSelector: jQuery('.iosPrev'),
						});						
						sliderResize();		
					}
					
					// IosSlider DEinitialization
					var deinitIosSlider = function(){
						slideNum = jQuery('.iosSlider').data('args').currentSlideNumber;
						is_init = false;
						var iosSlider = jQuery('.iosSlider').iosSlider('destroy');
					};
				
					var sliderResize = function(args) {
						var setHeight = jQuery('.iosSlider .item:eq(0)').outerHeight(true);
     						jQuery('.iosSlider').css({
							height: setHeight
						});
					}
    		
					var slideComplete = function(args) {
						jQuery('.iosNext, .iosPrev').removeClass('iosUnselectable');    			
						if (args.currentSlideNumber == 1) {
							jQuery('.iosPrev').addClass('iosUnselectable');
						} else if (args.currentSliderOffset == args.data.sliderMax) {
							jQuery('.iosNext').addClass('iosUnselectable');
						}
					}	
				});
			</script>
	<?php } ?>
	
	<?php $gallery_script = get_post_meta( get_the_ID(), 'mega_gallery_script', true ); ?>
	<?php $imageAlignCenter = get_post_meta( $pageid, 'mega_slider_align', true );
	if ( $imageAlignCenter == __( 'yes', 'mega' ) )
		$imageAlignCenter = 'true';
	else $imageAlignCenter = 'false'; ?>
	
	<?php $imageScaleMode = get_post_meta( $pageid, 'mega_image_scale_mode', true );
	if ( $imageScaleMode == __( 'fit', 'mega' ) )
		$imageScaleMode = 'fit';
	else $imageScaleMode = 'fill'; ?>
	<?php if ( is_page_template('page-full-width-slider.php') && !post_password_required() || is_singular('gallery') && $gallery_script == 'Full Width Slider' && !post_password_required() ) { ?>
			<?php
			$royal_autoplay = ot_get_option( 'royal_autoplay' );
			$pause_on_hover = ot_get_option( 'pause_on_hover' );
			$delay = ot_get_option( 'delay' );
			$control_navigation = ot_get_option( 'control_navigation' );
			$fullscreen_function = ot_get_option( 'fullscreen_function' );
			
			if ( ! empty( $royal_autoplay ) ) {
				$royal_autoplay = 'true';
			} else {
				$royal_autoplay = 'false';
			}
			
			if ( ! empty( $pause_on_hover ) ) {
				$pause_on_hover = 'true';
			} else {
				$pause_on_hover = 'false';
			}
			
			if ( empty( $delay ) ) {
				$delay = 5500;
			}
			
			if ( ! empty( $control_navigation ) ) {
				$control_navigation = 'bullets';
			} else {
				$control_navigation = 'none';
			}
			
			if ( ! empty( $fullscreen_function ) && ! is_page_template('page-home-slider.php') ) {
				$fullscreen_function = 'true';
			} else {
				$fullscreen_function = 'false';
			}
			?>
			<script>
		jQuery(document).ready(function($) {
			var $fullWidthSlider = jQuery('#full-width-slider');
			
			var getMediaQueryId = function() {
				var mediaQueryId = getComputedStyle(document.body, ':after').getPropertyValue('content');
				if ( navigator.userAgent.match('MSIE 8') == null ) { 
					mediaQueryId = mediaQueryId.replace( /"/g, '' );
				}
				return mediaQueryId;
			}
			
			// returns imageScaleMode for slider depending on screen size
			var getImageScaleMode = function() {
				var mediaQueryId = getMediaQueryId();
				if ( mediaQueryId == 'tiny' ) {
					return 'fit-if-smaller';
				} else {
					return '<?php echo $imageScaleMode; ?>';					
				}
			}	
			
			// changing slider height depending on screen size
			var changeHeightToFit = function() {
				var mediaQueryId = getMediaQueryId();
				$fullWidthSlider.css({top: $('#header-wrapper').outerHeight(true), bottom: $('#colophon').outerHeight(true)});
			}
						
			//$fullWidthSlider.imagesLoaded( function(){
				//var $fullWidthSlider = jQuery('#full-width-slider');
				
			$fullWidthSlider.royalSlider({
				arrowsNav: false,
				numImagesToPreload: 3,
				keyboardNavEnabled: true,
				controlsInside: false,
				imageScaleMode: getImageScaleMode(),
				imageAlignCenter: <?php echo $imageAlignCenter; ?>,
				imageScalePadding: 0,
				arrowsNavAutoHide: false,
				autoScaleSlider: false,
				autoHeight: false,
				usePreloader: true,
				controlNavigation: '<?php echo $control_navigation; ?>',
				navigateByClick: true,
				startSlideId: 0,
				autoPlay: {
					enabled: <?php echo $royal_autoplay; ?>,
					pauseOnHover: <?php echo $pause_on_hover; ?>,
					delay: <?php echo $delay; ?>
				},
				transitionType: 'move',
				globalCaption: false,
				loop: true,
				slidesSpacing: 0,
				fadeinLoadedSlide: true,
				fullscreen: {
					enabled: <?php echo $fullscreen_function; ?>,
					nativeFS: true
				}
			});		
			
			$('#header-wrapper').imagesLoaded(function(){
				changeHeightToFit();
				var slider = $fullWidthSlider.data('royalSlider');
				// force updating size by adding "true" to updateSliderSize method
				slider.updateSliderSize(true);
			});
			
					
			// updating imageScaleMode and height depending on screen size
			jQuery(window).smartresize(function(){
				var slider = $fullWidthSlider.data('royalSlider');
				slider.st.imageScaleMode = getImageScaleMode();
				changeHeightToFit();
				// force updating size by adding "true" to updateSliderSize method
				slider.updateSliderSize(true);
			});
							
		});
			</script>
	<?php } ?>
	
	
	<?php if ( is_page_template('page-home-slider.php') ) { ?>
			<?php
			$royal_autoplay = ot_get_option( 'royal_autoplay' );
			$pause_on_hover = ot_get_option( 'pause_on_hover' );
			$delay = ot_get_option( 'delay' );
			$control_navigation = ot_get_option( 'control_navigation' );
			
			if ( ! empty( $royal_autoplay ) ) {
				$royal_autoplay = 'true';
			} else {
				$royal_autoplay = 'false';
			}
			
			if ( ! empty( $pause_on_hover ) ) {
				$pause_on_hover = 'true';
			} else {
				$pause_on_hover = 'false';
			}
			
			if ( empty( $delay ) ) {
				$delay = 5500;
			}
			
			if ( ! empty( $control_navigation ) ) {
				$control_navigation = 'bullets';
			} else {
				$control_navigation = 'none';
			}
			
			$imageAlignCenter = ot_get_option( 'home_slide_align' );
			if ( $imageAlignCenter == 'yes' )
				$imageAlignCenter = 'true';
			else $imageAlignCenter = 'false';
			
			$imageScaleMode = ot_get_option( 'home_slide_scale_mode' );
			if ( $imageScaleMode == 'fit' )
				$imageScaleMode = 'fit';
			else $imageScaleMode = 'fill';
			?>
			<script>
			jQuery(document).ready(function($) {
			var $fullWidthSlider = jQuery('#full-width-slider');
			
			var getMediaQueryId = function() {
				var mediaQueryId = getComputedStyle(document.body, ':after').getPropertyValue('content');
				if ( navigator.userAgent.match('MSIE 8') == null ) { 
					mediaQueryId = mediaQueryId.replace( /"/g, '' );
				}
				return mediaQueryId;
			}
			
			// returns imageScaleMode for slider depending on screen size
			var getImageScaleMode = function() {
				var mediaQueryId = getMediaQueryId();
				if ( mediaQueryId == 'tiny' ) {
					return 'fit-if-smaller';
				} else {
					return '<?php echo $imageScaleMode; ?>';					
				}
			}	
			
			// changing slider height depending on screen size
			var changeHeightToFit = function() {
				var mediaQueryId = getMediaQueryId();
				$fullWidthSlider.css({top: $('#header-wrapper').outerHeight(true), bottom: $('#colophon').outerHeight(true)});
			}
			
				//var $fullWidthSlider = jQuery('#full-width-slider');
				
				$fullWidthSlider.royalSlider({
					arrowsNav: false,
					numImagesToPreload: 3,
					keyboardNavEnabled: true,
					controlsInside: false,
					imageScaleMode: getImageScaleMode(),
					imageAlignCenter: <?php echo $imageAlignCenter ?>,
					imageScalePadding: 0,
					arrowsNavAutoHide: false,
					autoScaleSlider: false,
					autoHeight: false,
					usePreloader: true,
					controlNavigation: '<?php echo $control_navigation; ?>',
					navigateByClick: true,
					startSlideId: 0,
					autoPlay: {
						enabled: <?php echo $royal_autoplay; ?>,
						pauseOnHover: <?php echo $pause_on_hover; ?>,
						delay: <?php echo $delay; ?>
					},
					transitionType: 'move',
					globalCaption: false,
					loop: true,
					slidesSpacing: 0,
					fadeinLoadedSlide: true,
					fullscreen: {
						enabled: false,
						nativeFS: true
					}
				});
				
				$('#header-wrapper').imagesLoaded(function(){
					changeHeightToFit();
					var slider = $fullWidthSlider.data('royalSlider');
					// force updating size by adding "true" to updateSliderSize method
					slider.updateSliderSize(true);
				});
			
					
				// updating imageScaleMode and height depending on screen size
				jQuery(window).smartresize(function(){
					var slider = $fullWidthSlider.data('royalSlider');
					slider.st.imageScaleMode = getImageScaleMode();
					changeHeightToFit();
					// force updating size by adding "true" to updateSliderSize method
					slider.updateSliderSize(true);
				});
				
			});
			</script>
	<?php } ?>
	
	
	<?php $gallery_script = get_post_meta( get_the_ID(), 'mega_gallery_script', true ); ?>
	<?php if ( is_page_template( 'page-gallery-visible-nearby.php' ) || is_singular( 'gallery' ) && $gallery_script == 'Gallery with Visible Nearby Images' ) { ?>
			<script>
			jQuery(document).ready(function($) {
				// cache container
				var $galleryVisibleNearby = $('#gallery-visible-nearby');
				
				$galleryVisibleNearby.royalSlider({
					addActiveClass: true,
					arrowsNav: false,
					controlNavigation: 'none',
					autoScaleSlider: true, 
					autoScaleSliderWidth: 940,     
					autoScaleSliderHeight: 360,
					loop: true,
					fadeinLoadedSlide: false,
					globalCaption: false,
					keyboardNavEnabled: true,
					globalCaptionInside: false,
					imageScalePadding: 30,
					slidesSpacing: 0,

					visibleNearby: {
					  enabled: true,
					  centerArea: 0.5,
					  center: true,
					  breakpoint: 650,
					  breakpointCenterArea: 0.64,
					  navigateByCenterClick: true
					}
				});
			});
		</script>
	<?php } ?>
	
	<?php $tracking_code = ot_get_option( 'tracking_code' ); ?>
	<?php if ( ! empty( $tracking_code ) ) { ?>
		<?php echo $tracking_code; ?>
	<?php } ?>
<?php
}
add_action( 'wp_footer', 'mega_initialize_jquery_plugins' );

/**
 * Load up our theme meta boxes and related code.
 */
	require( get_template_directory() . '/inc/meta-functions.php' );
	require( get_template_directory() . '/inc/meta-box-post.php' );
	require( get_template_directory() . '/inc/meta-box-portfolio.php' );
	require( get_template_directory() . '/inc/meta-box-gallery.php' );
	require( get_template_directory() . '/inc/meta-box-page.php' );
	
/**
 * Load up our theme style and related code.
 */
	require( get_template_directory() . '/inc/style.php' );

/**
 * Get Attachement ID from URL.
 */
function mega_get_attachment_id( $url ) {

    $dir = wp_upload_dir();
    $dir = trailingslashit($dir['baseurl']);

    if( false === strpos( $url, $dir ) )
        return false;

    $file = basename($url);

    $query = array(
        'post_type' => 'attachment',
        'fields' => 'ids',
        'meta_query' => array(
            array(
                'value' => $file,
                'compare' => 'LIKE',
            )
        )
    );

    $query['meta_query'][0]['key'] = '_wp_attached_file';
    $ids = get_posts( $query );

    foreach( $ids as $id )
        if( $url == array_shift( wp_get_attachment_image_src($id, 'full') ) )
            return $id;

    $query['meta_query'][0]['key'] = '_wp_attachment_metadata';
    $ids = get_posts( $query );

    foreach( $ids as $id ) {

        $meta = wp_get_attachment_metadata($id);

        foreach( $meta['sizes'] as $size => $values )
            if( $values['file'] == $file && $url == array_shift( wp_get_attachment_image_src($id, $size) ) ) {
				return $id;
            }
    }

    return false;
}

/**
 * Customize Protected Gallery.
 */
function mega_custom_password_form() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	$output = '<form class="protected-post-form" action="' . get_option( 'siteurl' ) . '/wp-login.php?action=postpass" method="post">	
    <p class="protected">' . __( "This gallery is protected. To view it, enter the password below:", 'mega' ) . '</p>
	<input name="post_password" id="' . $label . '" type="password" size="20" /><input type="submit" name="Submit" value="' . esc_attr__( "Submit" ) . '" /></form>';
    return $output;
}
add_filter( 'the_password_form', 'mega_custom_password_form' );

/**
 * Get Vimeo & YouTube Thumbnail.
 */
function mega_get_video_image($url){
	if(preg_match('/youtube/', $url)) {			
		if(preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches)) {
			return "http://img.youtube.com/vi/".$matches[1]."/default.jpg";  
		}
	}
	elseif(preg_match('/vimeo/', $url)) {			
		if(preg_match('~^http://(?:www\.)?vimeo\.com/(?:clip:)?(\d+)~', $url, $matches))	{
				$id = $matches[1];	
				if (!function_exists('curl_init')) die('CURL is not installed!');
				$url = "http://vimeo.com/api/v2/video/".$id.".php";
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_TIMEOUT, 10);
				$output = unserialize(curl_exec($ch));
				$output = $output[0]["thumbnail_medium"]; 
				curl_close($ch);
				return $output;
		}
	}		
}

/**
 * Retrieve YouTube/Vimeo iframe code from URL.
 */
function mega_get_video( $postid, $width = 940, $height = 308 ) {	
	$video_url = get_post_meta( $postid, 'mega_youtube_vimeo_url', true );	
	if(preg_match('/youtube/', $video_url)) {			
		if(preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $video_url, $matches)) {
			$output = '<iframe width="'. $width .'" height="'. $height .'" src="http://www.youtube.com/embed/'.$matches[1].'?wmode=transparent&showinfo=0&rel=0" frameborder="0" allowfullscreen></iframe> ';
		}
		else {
			$output = __( 'Sorry that seems to be an invalid YouTube URL.', 'mega' );
		}			
	}
	elseif(preg_match('/vimeo/', $video_url)) {			
		if(preg_match('~^https://(?:www\.)?vimeo\.com/(?:clip:)?(\d+)~', $video_url, $matches))	{				
			$output = '<iframe src="http://player.vimeo.com/video/'. $matches[1] .'?title=0&amp;byline=0&amp;portrait=0" width="'. $width .'" height="'. $height .'" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>';         	
		}
		else {
			$output = __( 'Sorry that seems to be an invalid Vimeo URL.', 'mega' );
		}			
	}
	else {
		$output = __( 'Sorry that seems to be an invalid YouTube or Vimeo URL.', 'mega' );
	}	
	echo $output;	
}

/**
 * Get Image Percentage Size.
 */
function mega_get_image_size_percentage( $width, $height ) {
	$percent= 100;
	$ratio =  $width / $height ;
	
	if ( $ratio < 0.75 ) $percent = 37.5;
	else if ( $ratio < 0.92 ) $percent = 47;
	else if ( $ratio < 1.17 ) $percent = 56.3;
	else if ( $ratio < 1.42 ) $percent = 75;
	else if ( $ratio < 1.64 ) $percent = 84.5;
	else $percent = 100;
		
	return $percent;
}

/**
 * Filter Primary Typography Fields.
 */
function filter_typography_fields( $array, $field_id ) {
  if ( $field_id == 'primary_typography' ) {
    $array = array(
		'font-family'
    );
  }
  
  return $array;
}
add_filter( 'ot_recognized_typography_fields', 'filter_typography_fields', 10, 2 );

/**
 * Filter Menu Typography Fields.
 */
function filter_menu_typography_fields( $array, $field_id ) {
  if ( $field_id == 'menu_typography' ) {
    $array = array(
		'font-family'
    );
  }
  
  return $array;
}
add_filter( 'ot_recognized_typography_fields', 'filter_menu_typography_fields', 10, 2 );

/**
 * Filter Header Typography Fields.
 */
function filter_header_typography_fields( $array, $field_id ) {
  if ( $field_id == 'header_typography' ) {
    $array = array(
		'font-family'
    );
  }
  
  return $array;
}
add_filter( 'ot_recognized_typography_fields', 'filter_header_typography_fields', 10, 2 );

/**
 * Remove the WordPress Image Caption Extra 10px Width.
 */
class fixImageMargins{
    public $xs = 0; //change this to change the amount of extra spacing

    public function __construct(){
        add_filter('img_caption_shortcode', array(&$this, 'fixme'), 10, 3);
    }
    public function fixme($x=null, $attr, $content){

        extract(shortcode_atts(array(
                'id'    => '',
                'align'    => 'alignnone',
                'width'    => '',
                'caption' => ''
            ), $attr));

        if ( 1 > (int) $width || empty($caption) ) {
            return $content;
        }

        if ( $id ) $id = 'id="' . $id . '" ';

    return '<div ' . $id . 'class="wp-caption ' . $align . '" style="width: ' . ((int) $width + $this->xs) . 'px">'
    . $content . '<p class="wp-caption-text">' . $caption . '</p></div>';
    }
}
$fixImageMargins = new fixImageMargins();

// Gallery
function mega_clean( $var ) {
	return sanitize_text_field( $var );
}

// AddThis
function mega_addthis_post_exclude_filter( $display ) {
if ( 'gallery' == get_post_type() )
    $display = false;

return $display;
}
add_filter( 'addthis_post_exclude', 'mega_addthis_post_exclude_filter' );

/**
 * Custom admin bar callback.
 */
add_action( 'get_header', 'mega_filter_head' );

function mega_filter_head() {
	remove_action( 'wp_head', '_admin_bar_bump_cb' );
	
	if ( is_admin_bar_showing() ) {
		add_action( 'wp_head', 'mega_admin_bar_bump_cb' );
	}
	
}

function mega_admin_bar_bump_cb() { ?>
<style type="text/css" media="screen">
	#header-wrapper { margin-top: 28px !important; }
</style>
<?php
}