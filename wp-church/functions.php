<?php
/**
 * WP-Church functions & definitions
 *
 */
 
 
 
 /******************************************************************
 * custom paths
 ******************************************************************/
 
define("NETLABS_INCLUDES_PATH", TEMPLATEPATH . '/includes');
define("NETLABS_CUSTPAGES_PATH", TEMPLATEPATH . '/options');

require_once (NETLABS_CUSTPAGES_PATH . '/custom-post-types.php');
require_once (NETLABS_INCLUDES_PATH . '/widgets.php');
require_once (NETLABS_INCLUDES_PATH . '/custom_functions.php');

require_once (NETLABS_CUSTPAGES_PATH . '/meta-box-extended-functions.php');
include_once 'options/meta-box-functions.php';
include 'options/meta-box-options.php';




 /******************************************************************
 * setup the admin
 ******************************************************************/
add_action('admin_menu', 'netstudio_theme_options');
add_action('admin_head', 'netstudio_admin_head');
define("HT_OPTIONS_PATH", TEMPLATEPATH . '/options');
require_once (HT_OPTIONS_PATH . '/admin-config.php');
require_once (HT_OPTIONS_PATH . '/admin-functions.php');
require_once (HT_OPTIONS_PATH . '/admin-options.php');
require_once (HT_OPTIONS_PATH . '/admin-content.php');



 /******************************************************************
 * theme setup functions
 ******************************************************************/
 
if ( ! isset( $content_width ) )
	$content_width = 550;

add_action( 'after_setup_theme', 'netlabs_setup' );

if ( ! function_exists( 'netlabs_setup' ) ):

function netlabs_setup() {
	add_editor_style();
	add_theme_support( 'custom-background' );
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'slider', 958, 340, true );
	add_image_size( 'imlink', 300, 150, true );
	add_image_size( 'fppost', 70, 70, true );  
	add_theme_support( 'automatic-feed-links' );
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'wp-church' ),
	) );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'wp-church');

	$locale = get_locale();
}

endif;


function netlabs_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'netlabs_page_menu_args' );



/**********************************************************
 * Returns a "Continue Reading" link for excerpts
 *********************************************************/
function wp_church_continue_reading_link() {
	return ' <p><a class="more-link" href="'. get_permalink() . '">' . __( '<span>Read more</span>', 'wp-church' ) . '</a></p>';
}



/**********************************************************
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and wp_church_continue_reading_link().
 *********************************************************/

function wp_church_auto_excerpt_more( $more ) {
	return '' . wp_church_continue_reading_link();
}
add_filter( 'excerpt_more', 'wp_church_auto_excerpt_more' );



/**********************************************************
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *********************************************************/
 
function wp_church_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= wp_church_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'wp_church_custom_excerpt_more' );



/**********************************************************
 * Remove inline styles printed when the gallery shortcode is used.
 *********************************************************/
 
function wp_church_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'wp_church_remove_gallery_css' );



/**********************************************************
 * functions for comments and pingbacks.
 *********************************************************/

if ( ! function_exists( 'wp_church_comment' ) ) :
function wp_church_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 60 ); ?>
			<?php printf( __( '%s ', 'wp-church' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', 'wp-church' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'wp-church' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'wp-church' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'wp-church' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'wp-church'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;



 /******************************************************************
 * register the widgets
 ******************************************************************/
 
function wp_church_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'wp-church' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'wp-church' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li><div class="clear"></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Index page left', 'wp-church' ),
		'id' => 'index-left',
		'description' => __( 'Index page left side', 'wp-church' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Index page center', 'wp-church' ),
		'id' => 'index-center',
		'description' => __( 'Index page center', 'wp-church' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Index page right', 'wp-church' ),
		'id' => 'index-right',
		'description' => __( 'Index page right', 'wp-church' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Calendar Widget Area', 'wp-church' ),
		'id' => 'calendar-widget-area',
		'description' => __( 'The calendar widget area', 'wp-church' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li><div class="clear"></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer left', 'wp-church' ),
		'id' => 'footer-left',
		'description' => __( 'Footer Left', 'wp-church' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer center', 'wp-church' ),
		'id' => 'footer-center',
		'description' => __( 'Footer center', 'wp-church' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer right', 'wp-church' ),
		'id' => 'footer-right',
		'description' => __( 'Footer right', 'wp-church' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

}

add_action( 'widgets_init', 'wp_church_widgets_init' );



 /******************************************************************
 * Removes the default styles that are packaged with the Recent Comments widget.
 ******************************************************************/
function wp_church_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'wp_church_remove_recent_comments_style' );




 /******************************************************************
 * Prints HTML with meta information for the current post—date/time and author.
 ******************************************************************/

if ( ! function_exists( 'wp_church_posted_on' ) ) :
function wp_church_posted_on() {
	printf( __( '<span class="%1$s">On</span> %2$s in %4$s ', 'wp-church' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'wp-church' ), get_the_author() ),
			get_the_author()
		),
		sprintf( '%1$s',
			get_the_category_list( ', ' )
		)
	);
}
endif;


 /******************************************************************
 * Prints HTML with meta information for the current post (category, tags and permalink).
 ******************************************************************/

if ( ! function_exists( 'wp_church_posted_in' ) ) :
function wp_church_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'wp-church' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'wp-church' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'wp-church' );
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
