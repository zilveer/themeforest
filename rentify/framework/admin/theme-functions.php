<?php

/**
 * Utility functions for theme usage
 *
 * Contains necessary functions for theme usage
 *
 * Wordpress 3.6+
 *
 * @package    CHANGE_THEME_NAME
 * @author     UOU Apps <info@uouapps.com>
 * @author     Ata Alqadi <ata.alqadi@gmail.com>
 * @link       http://themeforest.net/user/uouapps
 */
?>
<?php
/** Tell WordPress to run xxl_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'rentify_setup' );
if ( ! isset( $content_width ) )
$content_width = 790;
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
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
 * @since CHANGE_THEME_NAME 1.0
 */
function rentify_setup(){
  add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form' ) );
  add_theme_support( 'automatic-feed-links' );
}


/**** ******************
    Theme Setup
****************** ***/

function rentify_theme_features()  {  
  add_theme_support( 'post-formats', array( 'aside', 'audio', 'image', 'link', 'quote', 'status', 'video', 'gallery' ) );
  add_theme_support( 'post-thumbnails');
  add_theme_support( 'custom-header' );
  add_theme_support( 'custom-background' );
  add_theme_support( 'title-tag' );
  add_theme_support( 'post-thumbnails' );
  load_theme_textdomain( 'rentify', get_template_directory() . '/language' );
}

add_action( 'after_setup_theme', 'rentify_theme_features' );

function rentify_excerpt_more( $more ) {
	return ' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . esc_html__('Read More', 'rentify') . '</a>';
}
add_filter( 'excerpt_more', 'rentify_excerpt_more' );


/**** **********************************************
              Theme Pagination
*********************************************** ***/

function rentify_pagination() {

  if( is_singular() )
    return;

  global $wp_query;

  /** Stop execution if there's only 1 page */
  if( $wp_query->max_num_pages <= 1 )
    return;

  $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
  $max   = intval( $wp_query->max_num_pages );

  /** Add current page to the array */
  if ( $paged >= 1 )
    $links[] = $paged;

  /** Add the pages around the current page to the array */
  if ( $paged >= 3 ) {
    $links[] = $paged - 1;
    $links[] = $paged - 2;
  }

  if ( ( $paged + 2 ) <= $max ) {
    $links[] = $paged + 2;
    $links[] = $paged + 1;
  }

  echo '<div class="text-center pt20"> <ul class="uou-paginatin list-unstyled">' . "\n";

  /** Previous Post Link */
  if ( get_previous_posts_link() )
    printf( '<li>%s</li>' . "\n", esc_url(get_previous_posts_link() ));

  /** Link to first page, plus ellipses if necessary */
  if ( ! in_array( 1, $links ) ) {
    $class = 1 == $paged ? ' class="active"' : '';

    printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

    if ( ! in_array( 2, $links ) )
      echo '<li>..</li>';
  }

  /** Link to current page, plus 2 pages in either direction if necessary */
  sort( $links );
  foreach ( (array) $links as $link ) {
    $class = $paged == $link ? ' class="active"' : '';
    printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
  }

  /** Link to last page, plus ellipses if necessary */
  if ( ! in_array( $max, $links ) ) {
    if ( ! in_array( $max - 1, $links ) )
      echo '<li>..</li>' . "\n";

    $class = $paged == $max ? ' class="active"' : '';
    printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
  }

  /** Next Post Link */
  if ( get_next_posts_link() )
    printf( '<li>%s</li>' . "\n", esc_url(get_next_posts_link() ));

  echo '</ul></div>' . "\n";

}

/* -------------------------------------------------------------------------
    START sb COMMENT WALKER CLASS
------------------------------------------------------------------------- */

class rentify_comment_walker extends Walker_Comment{

    /*initialize classwide variables*/

    var $tree_type = 'comment';
    var $db_fields = array('parent' => 'comment_parent', 'id' => 'comment_ID');
    function start_lvl(&$output, $depth = 0, $args = array()){

        $GLOBAL['comment_depth'] = $depth + 1; ?>
            <ul>
    <?php

    }
    function end_lvl(&$output, $depth = 0, $args = array()){

        $GLOBAL['comment_depth'] = $depth +1;?>
        </ul>

    <?php    
    }


    function start_el(&$output, $comment, $depth = 0, $args = array(), $id = 0){  

            $depth++;            
            $GLOBALS['comment_depth'] = $depth;
            $GLOBALS['comment'] = $comment;
            $parent_class = empty($args['has_children'])? '':'parent';
         ?>

         <li id="comment-<?php comment_ID(); ?>">
          <article <?php  comment_class( 'comment' ); ?> >
            <?php echo get_avatar( $comment, $size = '100'); ?>
              <div>
                    <header>
                          <a href = "" class="user"> <?php comment_author_link(); ?> </a>
                          <small> - says</small>
                          <span class="time-ago"> 
                            <?php 
                                echo esc_attr(human_time_diff( get_comment_time('U'), current_time('timestamp') ) . ' ago');

                            ?>  
                            -- 
                            <?php comment_reply_link(array_merge($args,array('depth'=>$depth,'max_depth'=>$args['max_depth'])));  ?> </span>
                    </header>
                    <?php if($comment->comment_approved == 0): ?>
                        <p> <i class="ico fa fa-exclamation-circle"></i> <?php esc_html_e('Your comment is awaiting to approve','rentify' ); ?> </p>
                    <?php endif; ?>
                    <p><?php comment_text(); ?></p>
            </div>
          </article>
        
    <?php }
    function end_el(&$output, $comment, $depth = 0, $args = array() ){ ?>
    </li>
    <?php }
}

/* -------------------------------------------------------------------------
    END sb COMMENT WALKER CLASS
------------------------------------------------------------------------- */



/* -------------------------------------------------------------------------
    START CUSTOM COMMENT FORM FOR sb
------------------------------------------------------------------------- */

function sb_custom_comment_form($defaults){
    
    $defaults['comment_notes_before'] = '';
    $defaults['id_form'] = "comment-form";
    $defaults['title_reply'] = _e('<h4>Join Conversation</h4>','rentify');
    $defaults['comment_field'] = '<div class="uou-post-comment-form">
                                    <div class = "row">
                                      <div class = "col-md-12"><textarea  class="mt20" name="comment" id="" cols="20" rows="5" placeholder="Your Comment"></textarea></div>
                                    </div>
                                  </div>';
    $defaults['comment_notes_after'] ='';
    return $defaults;
}

add_filter('comment_form_defaults', 'sb_custom_comment_form');

/* -------------------------------------------------------------------------
    END CUSTOM COMMENT FORM FOR sb
------------------------------------------------------------------------- */



/* -------------------------------------------------------------------------
    START CUSTOM COMMENT FORM FIELD FOR sb
------------------------------------------------------------------------- */

function sb_custom_comment_form_fields(){

    $commenter = wp_get_current_commenter();
    $req = get_option('require_name_email' );

    $aria_req = $req? "aria-required='true'" : '';
    

    $fields = array(
            'author' => '<div class = "row">
                        <div class="col-sm-4">
                                <input type="text"  name="author" value="'.esc_attr($commenter['comment_author']).'" placeholder="Name*" '.$aria_req.' >
                        </div>',
            'email' => '<div class="col-sm-4">
                                <input type="text"  name="email" value="'.esc_attr($commenter['comment_author_email']).'" class="m-email m-required" placeholder="Email*" '.$aria_req.' >
                        </div>',
            'url' => '<div class="col-sm-4">
                            <input type="text"  name="url" value="'.esc_attr($commenter['comment_author_url'] ).'" placeholder="Website">
                    </div>
                    </div>'                      
        );

    return $fields;

}

add_filter('comment_form_default_fields','sb_custom_comment_form_fields');

/* -------------------------------------------------------------------------
    END CUSTOM COMMENT FORM FIELD FOR sb
------------------------------------------------------------------------- */




/*-------------------------------------------------------------------------
  START CUSTOMIZED COMMENT SUBMIT BUTTON
------------------------------------------------------------------------- */

function sb_comment_submit_button(){
  echo '<div class = "row"><div class = "col-sm-12"><button type="submit" class="btn btn-primary">Add Comment</button></div></div>';
}
add_action('comment_form','sb_comment_submit_button');

/*-------------------------------------------------------------------------
  START CUSTOMIZED COMMENT SUBMIT BUTTON
------------------------------------------------------------------------- */


// Short Title **************************************************************

function ShortenText($text)
{
// Change to the number of characters you want to display
$chars_limit = 20;
$chars_text = strlen($text);
$text = $text." ";
$text = substr($text,0,$chars_limit);
$text = substr($text,0,strrpos($text,' '));
if ($chars_text > $chars_limit)
{
  $text = $text."...";
}
return $text;
}



// login registration *************************************************************************************************
function sb_create_account(){
    //You may need some data validation here
    $user = ( isset($_POST['uname']) ? $_POST['uname'] : '' );
    $pass = ( isset($_POST['upass']) ? $_POST['upass'] : '' );
    $email = ( isset($_POST['uemail']) ? $_POST['uemail'] : '' );

    if ( !username_exists( $user )  && !email_exists( $email ) ) {
       $user_id = wp_create_user( $user, $pass, $email );
       if( !is_wp_error($user_id) ) {
           //user has been created
           $user = new WP_User( $user_id );
           $user->set_role( 'contributor' );
           //Redirect
           wp_redirect( 'home_url()' );
           exit;
       } else {
           //$user_id is a WP_Error object. Manage the error
       }
    }

}
add_action('init','sb_create_account');

/** 
 * ******************************* Title tag filter ******************************* *******************************
 */
function sb_title_filter( $title, $sep, $seplocation ) {
    global $type;
    // get special index page type (if any)
    if( is_category() ) $type = 'Category';
    elseif( is_tag() ) $type = 'Tag';
    elseif( is_author() ) $type . 'Author';
    elseif( is_date() || is_archive() ) $type = 'Archives';
    else $type = false;
 
    // get the page number
    if( get_query_var( 'paged' ) ) 
        $page_num = get_query_var( 'paged' ); // on index
    elseif( get_query_var( 'page' ) ) 
        $page_num = get_query_var( 'page' ); // on single
    else $page_num = false;
 
    // strip title separator
    $title = trim( str_replace( $sep, '', $title ) );
     
    // determine order based on seplocation
    $parts = array( get_bloginfo( 'name' ), $type, $title, $page_num );
    if( $seplocation == 'left' ) 
        $parts = array_reverse( $parts );
 
     
    // strip blanks, implode, and return title tag
    $parts = array_filter( $parts );
    return implode( ' ' . $sep . ' ', $parts );
     
}
add_filter( 'wp_title', 'sb_title_filter', 10, 3 );
