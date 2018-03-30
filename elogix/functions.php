<?php
/*-----------------------------------------------------------------------------------*/
/*	Load Translation Text Domain
/*-----------------------------------------------------------------------------------*/

load_theme_textdomain('framework');

/* ----------------------------------------------------- */
/* Include */
/* ----------------------------------------------------- */

include('framework/functions/sidebars.php');
include('framework/functions/scripts.php');
include('framework/functions/work-custom-post-type.php');
include('framework/functions/sidebar_generator.php');

// Widgets
include('framework/functions/widgets/twitter.php');
include('framework/functions/widgets/flickr.php');
include('framework/functions/widgets/sponsor.php');
include('framework/functions/widgets/embed.php');

/* ----------------------------------------------------- */
/* Shortcodes */
/* ----------------------------------------------------- */

require_once ('framework/functions/shortcodes.php');

add_filter('widget_text', 'do_shortcode');
add_filter('widget_title', 'do_shortcode');
add_filter('textarea', 'do_shortcode');

/* ----------------------------------------------------- */
/* Custom Menu */
/* ----------------------------------------------------- */

add_theme_support( 'menus' );
register_nav_menu('main', 'Main Menu');

/* ----------------------------------------------------- */
/* General */
/* ----------------------------------------------------- */

// Post Thumbnails
if ( function_exists( 'add_image_size' ) ) add_theme_support( 'post-thumbnails' );

	if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'single-thumb', 670, 270, true );
	add_image_size( 'blog-thumb', 200, 200, true );
	add_image_size( 'work-thumb', 215, 140, true );
	add_image_size( 'work-detail', 600, 0, false );
}

/* ----------------------------------------------------- */

// Modify the_excerpt() Function
function new_excerpt_more($more) {
       global $post;
    $readmore = __('read more', 'framework');
	return '.. <a href="'. get_permalink($post->ID) . '" class="readmore">' . $readmore .'</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

function custom_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/* ----------------------------------------------------- */

// Max. Content Width
if ( ! isset( $content_width ) ) $content_width = 670;

/* ----------------------------------------------------- */

// Add Theme Support
add_theme_support('automatic-feed-links');

/* ----------------------------------------------------- */
/* Breadcrumb Navigation */
/* ----------------------------------------------------- */

function the_breadcrumb() {
	if (!is_home()) {
		echo '<a href="';
		echo home_url();
		echo '">';
		bloginfo('name');
		echo "</a>";
		if (is_category() || is_single()) {
			the_category(' ');
			if (is_single()) {
				the_title();
			}
		} elseif (is_page() && !is_page_template('page-home.php') && !is_page_template('page-work.php')) {
			echo the_title();
		}
		elseif (is_page() && is_page_template('page-home.php')) {
			_e('Home', 'framework');
		}
		elseif (is_page() && is_page_template('page-work.php')) {
			_e('Work', 'framework');
		}
		} elseif (is_home()) {
			echo '<a href="';
			echo home_url();
			echo '">';
			bloginfo('name');
			echo "</a>";
			echo "Blog";
		}
}

/* ---------------------------------------------------- */
/* Styling Comments										*/
/* ---------------------------------------------------- */

function mytheme_comment( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>

   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
   <div class="comment-entry clearfix"> 
   		
   		<div class="avatar"><?php echo get_avatar( $comment,$size='34',$default='<path_to_url>' ); ?></div>
         
         <div class="comment-text">
         
			 <div class="author">
			 	<span><?php printf( __( '%s', 'framework'), get_comment_author_link() ) ?></span>
			 	<div class="date">
			 	<?php printf(__('%1$s at %2$s', 'framework'), get_comment_date(),  get_comment_time() ) ?></a><?php edit_comment_link( __( '(Edit)', 'framework'),'  ','' ) ?>
			   	· <?php comment_reply_link( array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>  </div>  
			 </div>
			 
			 <div class="text"><?php comment_text() ?></div>
			 
			 
			 <?php if ( $comment->comment_approved == '0' ) : ?>
	         <em><?php _e( 'Your comment is awaiting moderation.', 'framework' ) ?></em>
	         <br />
	      	<?php endif; ?>
	      	
      	</div>
      
   </div>
<?php
}

/* ----------------------------------------------------- */
/* Include Metabox Framework */
/* ----------------------------------------------------- */

class Works_Walker extends Walker_Category {
   function start_el(&$output, $category, $depth, $args) {
   
      $cat_name = esc_attr( $category->name);
	  $link = '<a href="#" data-filter=".term'.$category->term_id.'">' . $cat_name . '</a>';

      if ( 'list' == $args['style'] ) {
          $output .= '<li';
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

/* ----------------------------------------------------- */
/* Include Metabox Framework */
/* ----------------------------------------------------- */

// Re-define meta box path and URL
define( 'RWMB_URL', trailingslashit( get_template_directory_uri() . '/framework/functions/meta-box' ) );
define( 'RWMB_DIR', trailingslashit( TEMPLATEPATH . '/framework/functions/meta-box' ) );
// Include the meta box script
require_once RWMB_DIR . 'meta-box.php';


// Include the meta box definition (This is the file where you define meta boxes, see `demo/demo.php`)
include get_template_directory().'/framework/functions/work-meta-box.php';


/* ----------------------------------------------------- */
/* Include Theme Options Framework */
/* ----------------------------------------------------- */

if ( !function_exists( 'optionsframework_init' ) ) {

	/* Set the file path based on whether we're in a child theme or parent theme */
	
	if ( STYLESHEETPATH == TEMPLATEPATH ) {
		define('OPTIONS_FRAMEWORK_URL', TEMPLATEPATH . '/admin/');
		define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/');
	} else {
		define('OPTIONS_FRAMEWORK_URL', TEMPLATEPATH . '/admin/');
		define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/');
	}
	
	require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');
}


/* ----------------------------------------------------- */
/* EOF */
/* ----------------------------------------------------- */

?>