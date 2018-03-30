<?php

/* Set the content width based on the theme's design and stylesheet. */
if( ! isset( $content_width ) )
    $content_width = 1090;
 
function onioneye_adjust_content_width() {

	global $content_width;
 
    if( is_page_template( 'template-page-with-sidebar.php' ) ) {
    	$content_width = 731;
    }
    
    if( is_singular( 'post' ) ) {
    	$content_width = 817;
    }
    
}

add_action( 'template_redirect', 'onioneye_adjust_content_width' );


/*-----------------------------------------------------------------------------------*/
/* Theme Includes */
/*-----------------------------------------------------------------------------------*/

require_once( get_template_directory() . '/functions/options.php' );
require_once( get_template_directory() . '/functions/theme-functions.php' );
require_once( get_template_directory() . '/functions/enqueues.php' );
require_once( get_template_directory() . '/functions/widgets.php' );
require_once( get_template_directory() . '/functions/plugins.php' );


/*-----------------------------------------------------------------------------------*/
/*	Theme Support
/*-----------------------------------------------------------------------------------*/

// Adding WP 3+ Functions & Theme Support
function onioneye_theme_support() {
	
	add_theme_support('post-thumbnails', array( 'post', 'portfolio' ));
	add_theme_support('custom-background');
	add_theme_support('automatic-feed-links'); // rss thingy
	add_theme_support('menus'); // wp menus	
	add_theme_support('title-tag'); // 4.1 and up
	add_theme_support('html5', array('gallery', 'caption'));
	register_nav_menu('main', __( 'The header menu', 'onioneye' ));
	
	/* Allow for localization */
	load_theme_textdomain ('onioneye');
	
}

// launching this stuff after theme setup
add_action('after_setup_theme', 'onioneye_theme_support');	


/*-----------------------------------------------------------------------------------*/
/* Excerpts
/*-----------------------------------------------------------------------------------*/

function onioneye_excerpt_more( $more ) {
    global $post;
	return '&hellip; <span class="read-btn"><a class="read-more" href="'. esc_url(get_permalink($post->ID)) . '">' . esc_html__('Read More', 'onioneye') . '</a></span>';
}
add_filter( 'excerpt_more', 'onioneye_excerpt_more' );

function onioneye_excerpt_length( $length ) {
	return 48;
}
add_filter( 'excerpt_length', 'onioneye_excerpt_length' );


/*-----------------------------------------------------------------------------------*/
/* Thumbnail Size Options
/*-----------------------------------------------------------------------------------*/

if(function_exists('add_image_size')) {
	set_post_thumbnail_size(820, 9999); // Default post thumbnail size
	add_image_size('mid-size', 600, 9999); // Post thumbnail size
	add_image_size('content-width', 1090, 9999); // Permalink thumbnail size
}


/*-----------------------------------------------------------------------------------*/
/* The Title HTML Element
/*-----------------------------------------------------------------------------------*/

if (!function_exists('_wp_render_title_tag')) { 
    function onioneye_render_title() {
?>
		<!-- title -->	
		<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
    }
    add_action( 'wp_head', 'onioneye_render_title' );
    
    /**
	 * Create a nicely formatted and more specific title element text for output
	 * in head of document, based on current view.
	 *
	 * @global int $paged WordPress archive pagination page count.
	 * @global int $page  WordPress paginated post page count.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	function onioneye_wp_title( $title, $sep ) {
		global $paged, $page;
	
		if ( is_feed() ) {
			return $title;
		}
	
		// Add the site name.
		$title .= get_bloginfo( 'name', 'display' );
	
		// Add the site description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title = "$title $sep $site_description";
		}
	
		// Add a page number if necessary.
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title = "$title $sep " . sprintf( __( 'Page %s', 'onioneye' ), max( $paged, $page ) );
		}
	
		return $title;
	}
	add_filter( 'wp_title', 'onioneye_wp_title', 10, 2 );
    
} // end if


/*-----------------------------------------------------------------------------------*/
/* Search Function
/*-----------------------------------------------------------------------------------*/

add_filter('pre_get_posts', 'onioneye_cpt_search');
/**
 * This function modifies the main WordPress query to include an array of post types instead of the default 'post' post type.
 *
 * @param mixed $query The original query
 * @return $query The amended query
 */
function onioneye_cpt_search($query) {
    if (!is_admin() && $query->is_search)
		$query->set('post_type', array('post', 'portfolio'));
    return $query;
};


/*-----------------------------------------------------------------------------------*/
/* Comment Layout
/*-----------------------------------------------------------------------------------*/
		
function onioneye_post_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="comment-body group">
			<header class="comment-author vcard">
				<?php echo get_avatar( $comment, 45 ); ?>
				<?php echo '<cite class="fn">' . get_comment_author_link() . '</cite>'; ?>
				<div class="comment-meta">
					<time datetime="<?php echo esc_attr(get_comment_time('Y-m-d')); ?>"><?php echo esc_html(get_comment_time('F jS, Y')); ?></time>
					<span class="bullet">&nbsp;&middot;&nbsp;</span>
					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
					<?php edit_comment_link(esc_html__('&nbsp;&middot;&nbsp; Edit', 'onioneye'),'  ','') ?>
				</div>
			</header>
			<?php if ($comment->comment_approved == '0') : ?>
       			<div class="help">
          			<p><?php esc_html_e('Your comment is awaiting moderation.', 'onioneye') ?></p>
          		</div>
			<?php endif; ?>
			<section class="comment_content group">
				<?php comment_text() ?>
			</section>
		</article>
    <!-- </li> is added by wordpress automatically -->
<?php
} 


/*-----------------------------------------------------------------------------------*/
/* Custom Walker
/*-----------------------------------------------------------------------------------*/

class Onioneye_Menu_Walker extends Walker_Nav_Menu {

	/**
    * Traverse elements to create list from elements.
    *
    * Display one element if the element doesn't have any children otherwise,
    * display the element and its children. Will only traverse up to the max
    * depth and no ignore elements under that depth. It is possible to set the
    * max depth to include all depths, see walk() method.
    *
    * This method shouldn't be called directly, use the walk() method instead.
    *
    * @since 2.5.0
    *
    * @param object $element Data object
    * @param array $children_elements List of elements to continue traversing.
    * @param int $max_depth Max depth to traverse.
    * @param int $depth Depth of current element.
    * @param array $args
    * @param string $output Passed by reference. Used to append additional content.
    * @return null Null on failure with no changes to parameters.
    */
    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

		if ( !$element )
        	return;

        $id_field = $this->db_fields['id'];

        //display this element
        if ( is_array( $args[0] ) )
            $args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );

        //Adds the 'parent' class to the current item if it has children               
        if( ! empty( $children_elements[$element->$id_field] ) ) {
       		array_push($element->classes,'parent');
        }

        $cb_args = array_merge( array(&$output, $element, $depth), $args);

        call_user_func_array(array(&$this, 'start_el'), $cb_args);

        $id = $element->$id_field;

        // descend only when the depth is right and there are childrens for this element
        if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {

        	foreach( $children_elements[ $id ] as $child ){

            	if ( !isset($newlevel) ) {
                	$newlevel = true;
                    //start the child delimiter
                    $cb_args = array_merge( array(&$output, $depth), $args);
                    call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
                }
                	$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
           	}
            unset( $children_elements[ $id ] );
        }

        if ( isset($newlevel) && $newlevel ){
    	    //end the child delimiter
            $cb_args = array_merge( array(&$output, $depth), $args);
            call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
        }

        //end this element
        $cb_args = array_merge( array(&$output, $element, $depth), $args);
        call_user_func_array(array(&$this, 'end_el'), $cb_args);
	}
}


/*-----------------------------------------------------------------------------------*/
/*	Miscellaneous
/*-----------------------------------------------------------------------------------*/

// This will ensure that the text content of widgets is parsed for shortcodes and those shortcodes are ran. Awesome.
add_filter('widget_text', 'do_shortcode');

//Enable AutoEmbeds from Plain Text URLs in Text Widgets
add_filter( 'widget_text', array( $wp_embed, 'run_shortcode' ), 8 );
add_filter( 'widget_text', array( $wp_embed, 'autoembed'), 8 );

// setup code for the metronet plugin, that lets you easily reorder posts by drag and drop
add_filter( 'metronet_reorder_post_types', 'onioneye_slug_set_reorder' );
function onioneye_slug_set_reorder( $post_types ) {
    $post_types = array( 'portfolio' );
    return $post_types;
}

/* Custom ajax loader in the contact form 7 plugin */
add_filter('wpcf7_ajax_loader', 'my_wpcf7_ajax_loader');
function my_wpcf7_ajax_loader () {
	return get_template_directory_uri() . '/images/contact-form-loader.gif';
}

?>