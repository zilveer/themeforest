<?php
/**
 * sakura functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, sakura_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'sakura_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */


$upl = dirname(__FILE__)."/../../uploads/";
if (!file_exists($upl)) {
 if (!@mkdir($upl))
 {
   echo "Please create directory ".realpath($upl)."/ with chmod 777";
 }
}

if ( ! isset( $content_width ) )
	$content_width = 640;

require_once ( get_template_directory() . '/theme-options.php' );
require_once ( get_template_directory() . '/widgets.php' );


add_theme_support( 'post-thumbnails' ); // Add it for posts
set_post_thumbnail_size( 90, 90, true );

/** Tell WordPress to run sakura_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'sakura_setup' );

if ( ! function_exists( 'sakura_setup' ) ):

function sakura_post_has_image() {
$imagelink = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
    return $imagelink[0];
}

function sakura_postimage($width,$height, $im_id = 0) {

   if (!$im_id) $im_id = get_the_ID();

    $scriptpath = get_template_directory_uri(); 
    
    /*
    $attachments = get_children(array('post_parent' => $im_id, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order'));
    
    if (!is_array($attachments)) {
        $image = $scriptpath."/images/default.gif";
        return $scriptpath.'/plugins/woo-tumblog/functions/thumb.php?src='.$image.'&w='.$width.'&h='.$height.'&zc=1';
    }
    else {
    
    $img = array_shift($attachments);
    */
    
    $imagelink = wp_get_attachment_image_src( get_post_thumbnail_id( $im_id ), 'full' );
    
    $image = $imagelink[0];
      if ($image)  return $scriptpath.'/plugins/woo-tumblog/functions/thumb.php?src='.htmlentities($image).'&amp;w='.$width.'&amp;h='.$height.'&amp;zc=1&amp;q=100&amp;nores=1';
}


function sakura_img($url, $w, $h)
{
   $pluginurl = get_template_directory_uri()."/plugins/woo-tumblog/";
   $_url = get_template_directory_uri();
   $_url = preg_replace('/^(http:\/\/[^\/]+\/)(.*)$/', '\\1', $url);
   $url = str_replace($_url, '', $url);
   return $pluginurl.'/functions/thumb.php?src='.$url.'&amp;w='. $w .'&amp;h='. $h .'&amp;zc=1&amp;q=100';
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override sakura_setup() in a child theme, add your own sakura_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Ten 1.0
 */
 
function sakura_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	//add_theme_support( 'post-thumbnails' );

	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'sakura' ),
	) );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'sakura', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.

	// This theme allows users to set a custom background
	//add_custom_background();

	// Your changeable header business starts here
	define( 'HEADER_TEXTCOLOR', '' );
	// No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
	define( 'HEADER_IMAGE', '%s/images/headers/path.jpg' );

	// The height and width of your custom header. You can hook into the theme's own filters to change these values.
	// Add a filter to sakura_header_image_width and sakura_header_image_height to change these values.
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'sakura_header_image_width', 940 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'sakura_header_image_height', 198 ) );

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be 940 pixels wide by 198 pixels tall.
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	//set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

	// Don't support text inside the header image.
	define( 'NO_HEADER_TEXT', true );

	// Add a way for the custom header to be styled in the admin panel that controls
	// custom headers. See sakura_admin_header_style(), below.
   
}
endif;

if ( ! function_exists( 'sakura_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in sakura_setup().
 *
 * @since Twenty Ten 1.0
 */
function sakura_admin_header_style() {
?>
<style type="text/css">
/* Shows the same border as on front end */
#headimg {
	border-bottom: 1px solid #000;
	border-top: 4px solid #000;
}
/* If NO_HEADER_TEXT is false, you would style the text with these selectors:
	#headimg #name { }
	#headimg #desc { }
*/
</style>
<?php
}
endif;

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since Twenty Ten 1.0
 */
function sakura_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'sakura_page_menu_args' );

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Twenty Ten 1.0
 * @return int
 */
function sakura_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'sakura_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Twenty Ten 1.0
 * @return string "Continue Reading" link
 */
function sakura_continue_reading_link() {
	return ' <span class="read-more"><a href="'. get_permalink() . '">#LINK#</a></span>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and sakura_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string An ellipsis
 */
function sakura_auto_excerpt_more( $more ) {
	return ' &hellip;' . sakura_continue_reading_link();
}
add_filter( 'excerpt_more', 'sakura_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function sakura_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= sakura_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'sakura_custom_excerpt_more' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Twenty Ten's style.css.
 *
 * @since Twenty Ten 1.0
 * @return string The gallery style filter, with the styles themselves removed.
 */
function sakura_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'sakura_remove_gallery_css' );

//add_filter('get_comment_date', 'multipop_date_replace');

function multipop_date_replace($text) {
   $d=strtotime($text);
   $d=get_the_time('M jS');
	return $d;
}

if ( ! function_exists( 'sakura_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own sakura_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Ten 1.0
 */
function sakura_comment2( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	
	if ($depth==1)
	{
	   $av_size=80;
	}
	else
	{
	   $av_size=40;
	}
	
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php
			   ob_start();
			   echo get_stylesheet_directory_uri();
			   $u=ob_get_clean();
   			$s = get_avatar( $comment, $av_size, $u.'/images/def_ava'.($av_size==40 ? '_min' : '').'.jpg' );
            $s = str_replace("1.gra", "gra", $s);
            $s = str_replace("0.gra", "gra", $s);
            echo $s;
   	   ?>
		</div><!-- .comment-author .vcard -->

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="to_mod"><?php _e( 'Your comment is awaiting moderation.', 'sakura' ); ?></em>
		<?php endif; ?>

		<div class="comment-meta commentmetadata">
	   <?php printf( __( 'by: %s, ', 'sakura' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'sakura' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'sakura' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->


	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'sakura' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'sakura'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}

function sakura_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	
	if ($depth==1)
	{
	   $av_size=80;
	}
	else
	{
	   $av_size=40;
	}
	
			   ob_start();
			   echo get_stylesheet_directory_uri();
			   $u=ob_get_clean();
	
	switch ( $comment->comment_type ) :
		case '' :
	?>

      <div class="comment_bg level_<?php echo $depth; ?>" id="comment-<?php comment_ID(); ?>"> 
        <div class="comment"> 
          
			<?php
			   // <a href="#"><img src="usr/featured-posts/3.jpg" width="60" height="60" class="shadow_dark" /></a> 
			   echo '<a>';
			   ob_start();
   			echo get_avatar( $comment, $av_size, $u.'/images/def_ava'.($av_size==40 ? '_min' : '').'.jpg' );
   			$av = ob_get_clean();
            $av = str_replace("1.gra", "gra", $av);
            $av = str_replace("0.gra", "gra", $av);
   			echo str_replace('class=\'', 'class=\'shadow_dark ', $av);
   			echo '</a>';
   	   ?>          
          <?php comment_text(); ?>
          <div class="comment_meta"> 
            <a href="#" class="ico_link date"><?php printf( __( '%1$s at %2$s', 'sakura' ), get_comment_date(),  get_comment_time() ); ?></a> 
            <?php
               ob_start();
               echo get_comment_author_link();
               $l = ob_get_clean();
               $l = str_replace("'url", "'url ico_link author", $l);
               if (!preg_match('/ico_link author/', $l))
               {
                  $l = '<a class="ico_link author nofollow">'.$l.'</a>';
               }
               echo $l;
            ?>
            <?php
            
            global $post;
            if ($post->comment_status!='closed')
               echo '<a href="#" class="ico_link comments">reply</a>';
            ?>
          </div> 
        </div> 
      </div> 

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'sakura' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'sakura'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}

endif;

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override sakura_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since Twenty Ten 1.0
 * @uses register_sidebar
 */
 
function sakura_widgets_init() {
	// Area 1, located at the top of the sidebar.
	global $left_block_args;
	register_sidebar( $left_block_args=array(
		'name' => __( 'PRIMARY widget area', 'sakura' ),
		'id' => 'primary-widget-area',
		'description' => __( 'Left block', 'sakura' ),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div><div class="widget_b"></div>',
		'before_title' => '<div class="header">',
		'after_title' => '</div>',
	) );

   /*
	register_sidebar( array(
		'name' => __( 'Start page blocks', 'sakura' ),
		'id' => 'main-widget-area',
		'description' => __( 'Start page blocks', 'sakura' ),
		'before_widget' => '',
		'after_widget' => '<break />',
		'before_title' => '<h1 class="_cf">',
		'after_title' => '</h1>',
	) );
	*/

	register_sidebar( array(
		'name' => __( 'Left footer widget area', 'sakura' ),
		'id' => 'bottom-left',
		'description' => __( 'Left bottom block', 'sakura' ),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div><div class="widget_b"></div>',
		'before_title' => '<div class="header">',
		'after_title' => '</div>',
	) );

	register_sidebar( array(
		'name' => __( 'Center footer widget area', 'sakura' ),
		'id' => 'bottom-center',
		'description' => __( 'Center bottom block', 'sakura' ),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div><div class="widget_b"></div>',
		'before_title' => '<div class="header">',
		'after_title' => '</div>',
	) );

	register_sidebar( array(
		'name' => __( 'Right footer widget area', 'sakura' ),
		'id' => 'bottom-right',
		'description' => __( 'Right bottom block', 'sakura' ),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div><div class="widget_b"></div>',
		'before_title' => '<div class="header">',
		'after_title' => '</div>',
	) );
	
   /*
	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area', 'sakura' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'The secondary widget area', 'sakura' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'sakura' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'sakura' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'sakura' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'sakura' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'sakura' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'sakura' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 6, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'sakura' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 'sakura' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	*/
}
/** Register sidebars by running sakura_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'sakura_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * @since Twenty Ten 1.0
 */
function sakura_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'sakura_remove_recent_comments_style' );

if ( ! function_exists( 'sakura_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since Twenty Ten 1.0
 */
function sakura_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'sakura' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'sakura' ), get_the_author() ),
			get_the_author()
		)
	);
}

function sakura_posted_on_by() {
		echo sprintf( '<a class="ico_link author" href="%1$s" title="%2$s">%3$s</a>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'sakura' ), get_the_author() ),
			get_the_author()
		);
}

function sakura_posted_on_date() {
	printf( __( '%1$s', 'sakura' ),
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark" class="ico_link date">%3$s</a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		)
	);
}

function sakura_posted_on_date2($dates = TRUE) {

   global $post;
   
         $cats = wp_get_post_categories($post->ID);

         foreach (get_pages() as $p)
         {
            $pp = new Portfolio(array("post" => $p->ID));
            $c = $pp->get_cat();
            if (in_array($c, $cats)) $dates = FALSE;
         }

   if (!$dates)
   {
      echo '<div class="article_t"></div>';
      return;
   }

   $class = sakura_post_type();   
   
   echo '<div class="article_t"> <div class="post_type '.$class.'"><a href="';
   //the_permalink();


		$types = array(
		   "article",
		   "image",
		   "link",
		   "audio",
		   "video",
		   "quote"
		);
		
		 $tumblog_items = array(	'text'	=> get_option('woo_articles_term_id'),
										'image' 	=> get_option('woo_images_term_id'),
										'audio' 	=> get_option('woo_audio_term_id'),
										'video' 	=> get_option('woo_video_term_id'),
										'quote'	=> get_option('woo_quotes_term_id'),
										'link' 	=> get_option('woo_links_term_id')
									);
		
    	$category_id = $tumblog_items[$class];
    	
    	$term = &get_term($category_id, 'tumblog');
    	// Get the URL of Articles Tumblog Taxonomy
    	$href = $category_link = get_term_link( $term, 'tumblog' );

      echo $href;

   echo '"></a>';
	//echo '<div>%2$s</div><span>%3$s</span>';
	echo '<div>';
	the_time('j');
	echo '</div><span>';
	the_time('M');
	echo '</span>
	</div> </div>';
}

function sakura_meta()
{
   ?>
   
      <?php sakura_posted_on_date(); ?>
      <?php
         ob_start();
         comments_popup_link( __( 'Leave a comment', 'sakura' ), __( '1 Comment', 'sakura' ), __( '% Comments', 'sakura' ) );
         $l = ob_get_clean();
         $l = str_replace('">', '" class="ico_link comments">', $l);
         if (!preg_match('/ico_link comments/', $l))
         {
            //$l = '<a class="ico_link comments nofollow">'.$l.'</a>';
            $l = '';
         }
         echo $l;
      ?>
		   <?php
			   $tags_list = get_the_tag_list( '', ', ' );
			   if ( $tags_list ):
		   ?>
		      <span class="ico_link tags">
		         <?php echo $tags_list; ?>
			   </span> 
		   <?php endif; ?>
      <?php sakura_posted_on_by(); ?>
      
	   <?php if ( count( get_the_category() ) ) : ?>
		   <span class="ico_link categories">
			   <?php echo get_the_category_list( ', ' ); ?>
		   </span>
	   <?php endif; ?>

      <?php
      edit_post_link( __( 'Edit', 'sakura' ), '<span class="ico_link edit">', '</span>' );
      ?>
   
   <?php
}

function sakura_posted_on_date3() {
   ?>
   
      <div class="article_b"></div> 
        <div class="article_footer"> 
          <div class="article_footer_s"> 
            <?php sakura_meta(); ?>
          </div> 
        </div> 
        <div class="article_footer_b"></div> 
   
   <?php
}

function sakura_post_before()
{
   $type = sakura_post_type();


   $show = 0;
         global $post;
         $cats = wp_get_post_categories($post->ID);

         foreach (get_pages() as $p)
         {
            $pp = new Portfolio(array("post" => $p->ID));
            $c = $pp->get_cat();
            if (in_array($c, $cats)) $show = 1;
         }

if ($show) return;

   if ($type)
   {
      $func = "woo_tumblog_".$type."_content";
      if (function_exists($func))
         echo $func(get_the_ID());
   }
}

function sakura_permalink($s) {
   $type = sakura_post_type();
   if ( $type == "link" )
   {
      echo get_post_meta(get_the_ID(),'link-url',true);
   }
   else
   {
      echo $s;
   }
   //return $s;
}

function sakura_post_type()
{
   $id = get_the_ID();
   $tumblog_list = get_the_term_list( $id, 'tumblog', '' , '|' , ''  );
   $tumblog_list = strip_tags($tumblog_list);
   $tumblog_array = explode('|', $tumblog_list);
   $tumblog_results = '';
   $sentinel = false;

   $tumblog_items = array(
   'articles'      => get_option('woo_articles_term_id'),
  'images'        => get_option('woo_images_term_id'),
  'audio'         => get_option('woo_audio_term_id'),
  'video'         => get_option('woo_video_term_id'),
  'quotes'        => get_option('woo_quotes_term_id'),
  'links'         => get_option('woo_links_term_id')
  );

   
   foreach ($tumblog_array as $location_item) {
      $tumblog_id = get_term_by( 'name', $location_item, 'tumblog' );
      
      if( !isset($tumblog_id->term_id) ) {
        $tumblog_id->term_id = null;
      }
      
      if ( $tumblog_items['articles'] == $tumblog_id->term_id && !$sentinel ) {
              $tumblog_results = 'text';
              $sentinel = true;
      } elseif ($tumblog_items['images'] == $tumblog_id->term_id && !$sentinel ) {
              $tumblog_results = 'image';
              $sentinel = true;
      } elseif ($tumblog_items['audio'] == $tumblog_id->term_id && !$sentinel) {
              $tumblog_results = 'audio';
              $sentinel = true;
      } elseif ($tumblog_items['video'] == $tumblog_id->term_id && !$sentinel) {
              $tumblog_results = 'video';
              $sentinel = true;
      } elseif ($tumblog_items['quotes'] == $tumblog_id->term_id && !$sentinel) {
              $tumblog_results = 'quote';
              $sentinel = true;
      } elseif ($tumblog_items['links'] == $tumblog_id->term_id && !$sentinel) {
              $tumblog_results = 'link';
              $sentinel = true;
      } else {
              $tumblog_results = 'text';
              $sentinel = false;
      }
   }  
   return $tumblog_results;     
}

endif;

if ( ! function_exists( 'sakura_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Twenty Ten 1.0
 */
function sakura_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'sakura' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'sakura' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'sakura' );
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

function trim_the_content( $the_contents = '', $read_more_tag = '...READ MORE', $perma_link_to = '', $all_words = 45 ) {
	// make the list of allowed tags
	$allowed_tags = array( 'a', 'abbr', 'b', 'blockquote', 'b', 'cite', 'code', 'div', 'em', 'fon', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'hr', 'i', 'img', 'label', 'i', 'p', 'pre', 'span', 'strong', 'title', 'ul', 'ol', 'li', 'object', 'embed', 'param' );
	if( $the_contents != '' && $all_words > 0 ) {
		// process allowed tags
		$allowed_tags = '<' . implode( '><', $allowed_tags ) . '>';
		$the_contents = str_replace( ' ]]>', ' ]]>', $the_contents );
		$the_contents = strip_tags( $the_contents, $allowed_tags );
		// exclude HTML from counting words
		if( $all_words > count( preg_split( '/[\s]+/', strip_tags( $the_contents ), -1 ) ) ) return $the_contents;
		// count all
		$all_chunks = preg_split( '/([\s]+)/', $the_contents, -1, PREG_SPLIT_DELIM_CAPTURE );
		$the_contents = '';
		$count_words = 0;
		$enclosed_by_tag = false;
		foreach( $all_chunks as $chunk ) {
			// is tag opened?
			if( 0 < preg_match( '/<[^>]*$/s', $chunk ) ) $enclosed_by_tag = true;
			elseif( 0 < preg_match( '/>[^<]*$/s', $chunk ) ) $enclosed_by_tag = false; 			// get entire word 			if( !$enclosed_by_tag && '' != trim( $chunk ) && substr( $chunk, -1, 1 ) != '>' ) $count_words ++;
			$the_contents .= $chunk;
			if( $count_words >= $all_words && !$enclosed_by_tag ) break;
		}
                // note the class named 'more-link'. style it on your own
		$the_contents = $the_contents . '' . $read_more_tag . '';
		// native WordPress check for unclosed tags
		$the_contents = force_balance_tags( $the_contents );
	}
	return $the_contents;
}

// unregister all default WP Widgets
function unregister_default_wp_widgets() {

   unregister_widget('WP_Widget_Search');

	/*
	
	unregister_widget('WP_Widget_Pages');

	unregister_widget('WP_Widget_Calendar');

	unregister_widget('WP_Widget_Archives');

	unregister_widget('WP_Widget_Links');

	unregister_widget('WP_Widget_Meta');

	unregister_widget('WP_Widget_Search');

	unregister_widget('WP_Widget_Text');

	unregister_widget('WP_Widget_Categories');

	unregister_widget('WP_Widget_Recent_Posts');

	unregister_widget('WP_Widget_Recent_Comments');

	unregister_widget('WP_Widget_RSS');

	unregister_widget('WP_Widget_Tag_Cloud');
	
	*/
}

add_action('widgets_init', 'unregister_default_wp_widgets', 1);

function autoexpand_rel_wlightbox ($content) {
	global $post;
	//return $content;
	$pattern        = "/(<a(?![^>]*?rel=['\"]lightbox.*)[^>]*?href=['\"][^'\"]+?\.(?:bmp|gif|jpg|jpeg|png)['\"][^\>]*)>/i";
	$replacement    = '$1 rel="lightbox">';
	$content = preg_replace($pattern, $replacement, $content);
	return $content;
}

add_filter('the_content', 'autoexpand_rel_wlightbox', 99);
add_filter('the_excerpt', 'autoexpand_rel_wlightbox', 99);

add_filter('the_permalink', 'sakura_permalink', 99);
//add_filter('get_the_permalink', 'sakura_permalink', 99);


/* shortcodes: begin */


function clear() {
    return '<br class="clear" />';
}
add_shortcode('clear', 'clear');


function one_fourth($atts, $content = null, $align = null) {
	extract(shortcode_atts(array(
		"align" => '',
		"frame" => ''
	), $atts)); 
	if ($atts['align']=='right') $align=' right_align';
	if ($atts['frame']=='true' or $atts['frame']=='yes' or $atts['frame']=='t' or $atts['frame']=='y'  or $atts['frame']=='1') $frame=' framed';
    return '<div class="one-fourth'.$align.''.$frame.'">'.$content.'</div>';
}
add_shortcode('one-fourth', 'one_fourth');


function three_fourth($atts, $content = null, $align = null) {
	extract(shortcode_atts(array(
		"align" => '',
		"frame" => ''
	), $atts)); 
	if ($atts['align']=='right') $align=' right_align';
	if ($atts['frame']=='true' or $atts['frame']=='yes' or $atts['frame']=='t' or $atts['frame']=='y'  or $atts['frame']=='1') $frame=' framed';
    return '<div class="three-fourth'.$align.''.$frame.'">'.$content.'</div>';
}
add_shortcode('three-fourth', 'three_fourth');


function one_third($atts, $content = null, $align = null) {
	extract(shortcode_atts(array(
		"align" => '',
		"frame" => ''
	), $atts)); 
	if ($atts['align']=='right') $align=' right_align';
	if ($atts['frame']=='true' or $atts['frame']=='yes' or $atts['frame']=='t' or $atts['frame']=='y'  or $atts['frame']=='1') $frame=' framed';
    return '<div class="one-third'.$align.''.$frame.'">'.$content.'</div>';
}
add_shortcode('one-third', 'one_third');


function two_third($atts, $content = null, $align = null) {
	extract(shortcode_atts(array(
		"align" => '',
		"frame" => ''
	), $atts)); 
	if ($atts['align']=='right') $align=' right_align';
	if ($atts['frame']=='true' or $atts['frame']=='yes' or $atts['frame']=='t' or $atts['frame']=='y'  or $atts['frame']=='1') $frame=' framed';
    return '<div class="two-third'.$align.''.$frame.'">'.$content.'</div>';
}
add_shortcode('two-third', 'two_third');


function one_half($atts, $content = null) {
	extract(shortcode_atts(array(
		"align" => '',
		"frame" => ''
	), $atts)); 
	if ($atts['align']=='right') $align=' right_align';
	if ($atts['frame']=='true' or $atts['frame']=='yes' or $atts['frame']=='t' or $atts['frame']=='y'  or $atts['frame']=='1') $frame=' framed';
    return '<div class="one-half'.$align.''.$frame.'">'.$content.'</div>';
}
add_shortcode('one-half', 'one_half');


function frame($atts, $content = null, $align = null) {
	extract(shortcode_atts(array(
		"align" => ''
	), $atts)); 
	if ($atts['align']=='right') $align=' right_align';
	if ($atts['align']=='left') $align=' left_align';
    return '<div class="framed'.$align.'">'.$content.'</div>';
}
add_shortcode('frame', 'frame');


function toggle($atts, $content = null) {
	extract(shortcode_atts(array(
		"title" => ''
	), $atts)); 
    return '<div class="toggle"><a href="#" class="question"><i class="q_a"></i>'.$title.'</a><div class="answer" style="display: none;">'.$content.'</div></div>';
}
add_shortcode('toggle', 'toggle');


function question($atts, $content = null) {
	extract(shortcode_atts(array(
		"frame" => ''
	), $atts)); 
	if ($atts['frame']=='true' or $atts['frame']=='yes' or $atts['frame']=='t' or $atts['frame']=='y'  or $atts['frame']=='1') $frame=' framed';
    return '<div class="question'.$frame.'"><div class="que_ico"></div>'.$content.'</div>';
}
add_shortcode('question', 'question');

function alert($atts, $content = null) {
	extract(shortcode_atts(array(
		"frame" => ''
	), $atts)); 
	if ($atts['frame']=='true' or $atts['frame']=='yes' or $atts['frame']=='t' or $atts['frame']=='y'  or $atts['frame']=='1') $frame=' framed';
    return '<div class="alert'.$frame.'"><div class="alert_ico"></div>'.$content.'</div>';
}
add_shortcode('alert', 'alert');

function approved($atts, $content = null) {
	extract(shortcode_atts(array(
		"frame" => ''
	), $atts)); 
	if ($atts['frame']=='true' or $atts['frame']=='yes' or $atts['frame']=='t' or $atts['frame']=='y'  or $atts['frame']=='1') $frame=' framed';
    return '<div class="approved'.$frame.'"><div class="approved_ico"></div>'.$content.'</div>';
}
add_shortcode('approved', 'approved');


function tooltip($atts, $content = null) {
	extract(shortcode_atts(array(
		"title" => '',
		"href" => ''
	), $atts)); 
	if ($atts['frame']=='true' or $atts['frame']=='yes' or $atts['frame']=='t' or $atts['frame']=='y'  or $atts['frame']=='1') $frame=' framed';
	if (!$atts['href']) { $tag='span'; $href='';} else { $tag='a';  $href='href="'.$atts['href'].'"';}
    return '<'.$tag.' '.$href.' class="tooltip'.$frame.'">'.$title.'<span class="tooltip_c">'.$content.'</span></'.$tag.'>';
}
add_shortcode('tooltip', 'tooltip');

function fb_img_caption_shortcode($x=null, $attr, $content){
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
    return '<div style="width: ' . ((int) $width) . 'px" ' . $id . 'class="wp-caption ' . $align . '">'
    . $content . '<p class="wp-caption-text">' . $caption . '</p></div>';
}
add_filter('img_caption_shortcode', 'fb_img_caption_shortcode', 10, 3);




if( !empty($_POST['send_contacts']) )
{
   if ($_POST["send_f"]!="send_f") $ret='are you real?';
   else
   {
      $em=get_settings('admin_email');
      //$em="alexandroik@gmail.com";
      wp_mail($em, 'Feedback', "Someone wrote this to you:
      
Name: ".$_POST["f_name"]."
Email: ".$_POST["f_email"]."
Comment:
".$_POST["f_comment"]."
");
      $ret="Feedback has been sent to the administrator.";
   }
   echo $ret; exit;
}

if (preg_match('/\/category\/([^\/]+)\//', $_SERVER["REQUEST_URI"], $m))
   $c = $m[1];
elseif (isset($_GET['category_name'])) 
   $c = $_GET["category_name"];
elseif ( isset($_GET['cat']) )
   $c = $_GET['cat'];

if ( !empty($c) )
{
   $cats = get_categories();
   foreach ($cats as $cat)
   {
   if (strtolower($cat->cat_name) != $c && $cat->cat_ID != $c) continue;
   foreach (get_pages() as $p)
   {
      $pp = new Portfolio(array( "post" => $p->ID ));
      //echo $p->cat_cat()." ".$cat->cat_ID."\n";
      if ($pp->get_cat() == $cat->cat_ID)
      {
         Header("Location: ".get_page_link($p->ID));
         //echo "redir"; exit;
      }
   }
   }
}

function get_arts_patterns($tt, $type, $get_all = false)
{

   $options = get_option("sample_theme_options");

                     $files = array();

                     $folders = array("/images/".$tt."s/all/", "/images/".$tt."s/".$type."/");
                     if ($get_all) $folders = array(
                           "/images/".$tt."s/all/",
                           "/images/".$tt."s/day/",
                           "/images/".$tt."s/night/",
                        );

                     foreach ($folders as $folder)
                     if ($handle = @opendir(dirname(__FILE__).$folder)) {
                        while (false !== ($file = readdir($handle))) {
                           if (preg_match('/(^\.|\~$)/', $file)) continue;
                           if (!preg_match('/\.(gif|png|jpg|jpeg)$/', $file)) continue;
                           if (preg_match('/\_mini\.[a-zA-Z]{3,4}$/', $file)) continue;
                           $files[] = $folder.$file;
                        }
                        closedir($handle);
                     }


                     $types = array($type);
                     if ($get_all) $types = array('day', 'night');

                     foreach ($types as $type) {
                     $custom_key = "custom_".$tt."_".$type;
                     $custom_key_prefix = "/../../uploads/";
                     if ($options[$custom_key])
                     {
                        $fname = $custom_key_prefix.$options[$custom_key];
                        $real = dirname(__FILE__).$fname;
                        if (file_exists( $real) )
                        {
                           $files[] = $fname;
                        }
                     }
                     }

                     sort($files);

                     return $files;
}

/* shortcodes: end */
