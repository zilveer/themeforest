<?php

/* Allow for localization */
load_theme_textdomain ( 'onioneye' );


/*-----------------------------------------------------------------------------------*/
/* Options Framework Theme */
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'optionsframework_init' ) ) {

	/* Set the file path based on whether the Options Framework Theme is a parent theme or child theme */
	
	define( 'OPTIONS_FRAMEWORK_URL', TEMPLATEPATH . '/admin/' );
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/' );
	
	require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php' );

}


/*-----------------------------------------------------------------------------------*/
/* Includes */
/*-----------------------------------------------------------------------------------*/

require_once( get_template_directory() . '/function-includes/theme-functions.php' );
require_once( get_template_directory() . '/function-includes/enqueues.php' );
require_once( get_template_directory() . '/function-includes/widgets.php' );
require_once( get_template_directory() . '/function-includes/custom-post-types.php' );
require_once( get_template_directory() . '/function-includes/portfolio-metaboxes.php' );
require_once( get_template_directory() . '/function-includes/slider-metaboxes.php' );
require_once( get_template_directory() . '/function-includes/theme-shortcodes/column-shortcodes.php' );
require_once( get_template_directory() . '/function-includes/theme-shortcodes/contact-form-shortcode/contact-form-shortcode.php' );
require_once( get_template_directory() . '/function-includes/theme-shortcodes/contact-info-shortcode.php' );
require_once( get_template_directory() . '/function-includes/theme-shortcodes/google-maps-shortcode.php' );


/*-----------------------------------------------------------------------------------*/
/*	Theme Support
/*-----------------------------------------------------------------------------------*/

add_theme_support( 'menus' ); // add custom menus support
add_theme_support('automatic-feed-links');
add_theme_support( 'post-thumbnails', array( 'post', 'my_portfolio', 'my_slider' ) );
set_post_thumbnail_size(9999, 9999); // Default post thumbnail size
add_image_size( 'single-post-thumbnail', 400, 9999 ); // Permalink thumbnail size
add_image_size( 'portfolio-thumbnail', 210, 9999 ); // Permalink thumbnail size
add_image_size( 'slider-image', 9999, 9999 ); // Slider thumbnail size
add_image_size( 'full-size', 9999, 9999 ); // Full size image 


/*-----------------------------------------------------------------------------------*/
/*	Register The Main Menu
/*-----------------------------------------------------------------------------------*/

function register_menu() {
	register_nav_menu( 'main', __( 'Main Navigation Menu', 'onioneye' ) );
}

add_action('init', 'register_menu');


/*-----------------------------------------------------------------------------------*/
/* Excerpt
/*-----------------------------------------------------------------------------------*/

function eq_new_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'eq_new_excerpt_length' );

function new_excerpt_more( $more ) {
    global $post;
	return '... <a class="read-more" href="'. get_permalink( $post->ID ) . '">' . __( 'Read The Rest &rarr;', 'onioneye' ) . '</a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );

function wpe_excerptlength_news( $length ) {
    return 15;
}

function wpe_excerptlength_teaser( $length ) {
    return 41;
}
function wpe_excerptlength_index( $length ) {
    return 90;
}
function wpe_excerptmore( $more ) {
    return '...';
}

function wpe_excerpt( $length_callback='', $more_callback='' ) {
    global $post;
	
    if( function_exists( $length_callback ) ){
        add_filter( 'excerpt_length', $length_callback );
    }
    if( function_exists( $more_callback ) ){
        add_filter( 'excerpt_more', $more_callback );
    }
    $output = get_the_excerpt();
    $output = apply_filters( 'wptexturize', $output );
    $output = apply_filters( 'convert_chars', $output );
    $output = '<p>'.$output.'</p>';
    echo $output;
}


/*-----------------------------------------------------------------------------------*/
/* Comments
/*-----------------------------------------------------------------------------------*/

function mytheme_comment( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>

   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
      <article id="comment-<?php comment_ID(); ?>">
      
      <div class="comment-authors group">
         <p class="avatar"><?php echo get_avatar( $comment,$size='34',$default='<path_to_url>' ); ?></p>
		 <p class="author-link"><?php printf( __( '<cite class="fn">%s</cite>', 'onioneye' ), get_comment_author_link() ) ?></p>
		 
		 <p class="author-meta">
		 	<?php printf(__( '%1$s at %2$s', 'onioneye' ), get_comment_date(),  get_comment_time() ) ?></a><?php edit_comment_link( __( '(Edit)', 'onioneye' ),'  ','' ) ?>
		    // <?php comment_reply_link( array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>    
		 </p>
      </div>
      
      <?php if ( $comment->comment_approved == '0' ) : ?>
         <em><?php _e( 'Your comment is awaiting moderation.', 'onioneye' ) ?></em>
         <br />
      <?php endif; ?>

      <?php comment_text() ?>
     </article>
<?php
}



/*-----------------------------------------------------------------------------------*/
/* Custom Walker
/*-----------------------------------------------------------------------------------*/

class Nfr_Menu_Walker extends Walker_Nav_Menu{

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


//replace all the default ampersands with much nicer ones in the titles
add_filter( 'the_title', 'highlight_red_yoga_mats' );

function highlight_red_yoga_mats( $content ) {
    $content = str_replace('&amp;', '<span class="amp">&amp;</span>', $content ); //replace the content here
    return $content;
}


/* add facebook and twitter functions to the end of every post */
function share_this($content){
	// Display the share buttons in a specific order if the single portfolio item view is active; otherwise, if the single blog post is being currently viewed, display the buttons in a different order. 
    if ( is_singular( 'portfolio' ) ) {
        $content .= '<div class="share-this">' .  
	                    '<div class="facebook-like-button">' . 
	                        '<iframe src="http://www.facebook.com/plugins/like.php?href='. urlencode( get_permalink( $post->ID ) ) . 
							'&amp;layout=button_count&amp;show_faces=false&amp;width=200&amp;action=like&amp;colorscheme=light&amp;height=21"' . 
							'scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:200px; height:21px;" allowTransparency="true"></iframe>' .
	                    '</div>' . 
	                    '<div class="plusone"><g:plusone size="medium" href="'.get_permalink().'"></g:plusone></div>' .
	                    '<div><a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a></div>' .
                	'</div>';
    }
	else if ( !is_feed() && !is_home() && !is_page() && !is_singular( 'portfolio' ) ) {
		$content .= '<div class="share-this group">' . 
						'<span class="share">' . __('Share &rarr;', 'onioneye') . '</span>' .
	                    '<div><a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a></div>' .		 
	                    '<div class="plusone"><g:plusone size="medium" href="'.get_permalink().'"></g:plusone></div>' .
	                    '<div class="facebook-like-button">' . 
	                        '<iframe src="http://www.facebook.com/plugins/like.php?href='. urlencode( get_permalink( $post->ID ) ) . 
							'&amp;layout=button_count&amp;show_faces=false&amp;width=200&amp;action=like&amp;colorscheme=light&amp;height=21"' . 
							'scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:200px; height:21px;" allowTransparency="true"></iframe>' .
	                    '</div>' . 
                	'</div>';
	}
	
    return $content;
}
add_action('the_content', 'share_this');


/* output the version of the style sheet and other files in the theme */
function of_file_version( $path ) {
	
    // get the absolute path to the file
    $pathToFile = TEMPLATEPATH . '/' . $path;
    
    //check if the file exists
    if ( file_exists( $pathToFile ) ) {
        // return the time the file was last modified
        echo filemtime( $pathToFile );
    }
    else {
        // let them know the file wasn't found
        _e( 'File Not Found', 'onioneye' );
    }
}

/* Get the version of the style sheet and other files in the theme */
function of_get_the_file_version( $path ) {
	
    // get the absolute path to the file
    $pathToFile = TEMPLATEPATH . '/' . $path;
    
    //check if the file exists
    if ( file_exists( $pathToFile ) ) {
        // return the time the file was last modified
        return filemtime( $pathToFile );
    }
    else {
        // let them know the file wasn't found
        return __( 'File Not Found', 'onioneye' );
    }
}

?>