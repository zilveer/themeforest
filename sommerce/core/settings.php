<?php        
/**
 * Core of Framework  
 * 
 * Main includes for all framework.     
 * 
 * @package WordPress
 * @subpackage WP Framework YI
 * @since 1.0
 */

// Make theme available for translation
// Translations can be filed in the /languages/ directory
load_theme_textdomain( 'yiw', TEMPLATEPATH . '/languages' );      

function warning_version_wp() {
    global $theme_update_notice, $pagenow, $wp_version;
    //if ( $pagenow == "themes.php") {
    if( version_compare($wp_version, YIW_MINIMUM_WP_VERSION, "<") ) :
?>
        <div id="message" class="error fade">
        <?php printf( __( 'The theme you are using requires WordPress version %s or higher. So, many features of it will not perform correctly.', 'yiw' ), YIW_MINIMUM_WP_VERSION ) ?>
        </div>
<?php
    endif;
    //}
}               

function yiw_container_width() {
    global $content_width;
    
    ?>
    .wrapper-content { width:<?php echo $content_width; ?>px; }
    <?php
}                                   

/**
 * @var string The global message 
 * @since 1.0
 */  
$yiw_message = '';                 

/**
 * @var array The tags allowed to insert it on theme options 
 * @since 1.0
 */  
$yiw_tags_allowed = array(
    'name_site' => get_bloginfo('name'),
    'description_site' => get_bloginfo('description'),
    'site_url' => site_url(),
    'date' => date_i18n( get_option('date_format'), time() )
);                           

/**
 * @var array The global array with all file includes of all shortcodes 
 * @since 1.0
 */  
$yiw_shortcodes_includes = array();   

/**
 * @var array Global layout of the current page 
 * @since 1.0
 */  
$yiw_layout = '';   

/**
 * @var object The global object for the slider 
 * @since 1.0
 */  
$yiw_slider = new YIW_Slider();
add_action( 'wp_head', array( $yiw_slider, 'init' ), 1 );  

/**
 * @var object The global object for the mobile detecting 
 * @since 1.0
 */  
$yiw_mobile = new Mobile_Detect();     
   

/**
 * Save the layout of the current page in global var
 *
 * @since 1.0
 */
function yiw_register_layout() {
    global $yiw_layout, $post, $wp_query;
    
    if( $wp_query->is_posts_page )
        $post_id = get_option( 'page_for_posts' );
    else if ( isset($post->ID) ) 
        $post_id = $post->ID;
    else
        $post_id = 0;
    
    $layout = ( $layout=get_post_meta( $post_id, '_layout_page', true ) ) ? $layout : YIW_DEFAULT_LAYOUT_PAGE;
    
    $ex = array(
        'sidebar-right' => apply_filters( 'yiw_force_sidebar_right', array() ),
        'sidebar-left'  => apply_filters( 'yiw_force_sidebar_left', array() ),
        'sidebar-no'    => apply_filters( 'yiw_force_sidebar_no', array() ),
    );
    
    // force layouts
    if ( $post_id != 0 ) {
        foreach ( $ex as $layout_force => $ids ) {
            if ( empty( $ids ) )
                continue;
            
            if ( ! is_array( $ids ) )
                $ids = array( $ids );
            
            foreach ( $ids as $id ) {
                if ( $id == $post->ID ) {
                    $layout = $layout_force;
                    break;
                }
            }
        }
    }
    
    $yiw_layout = apply_filters( 'yiw_layout_page', $layout );
}
add_filter( 'wp_head', 'yiw_register_layout', 1 );           

/**
 * Register all core scripts js.
 *
 * @since 1.0
 */
function yiw_register_scripts() {
    wp_register_script( 'jquery-cycle',       YIW_FRAMEWORK_URL . 'includes/js/jquery.cycle.min.js', array('jquery'), '2.94');
    wp_register_script( 'jquery-easing',      YIW_FRAMEWORK_URL . 'includes/js/jquery.easing.1.3.js', array('jquery'), '1.3');
    wp_register_script( 'jquery-prettyPhoto', YIW_FRAMEWORK_URL . 'includes/js/jquery.prettyPhoto.js', array('jquery'), '3.0');
    wp_register_script( 'jquery-tipsy',       YIW_FRAMEWORK_URL . 'includes/js/jquery.tipsy.js', array('jquery'));
    wp_register_script( 'jquery-tweetable',   YIW_FRAMEWORK_URL . 'includes/js/twitter-text.js', array('jquery'));
    wp_register_script( 'jquery-jcarousel',   YIW_FRAMEWORK_URL . 'includes/js/jquery.jcarousel.min.js', array('jquery'));         
    wp_register_script( 'jquery-nivo',        YIW_FRAMEWORK_URL . 'includes/js/jquery.nivo.slider.pack.js', array('jquery'), '2.5.2' );
    wp_register_script( 'cufon',              YIW_FRAMEWORK_URL . 'includes/js/cufon-yui.js', array('jquery'), '1.09i' );
}
add_filter( 'init', 'yiw_register_scripts' ); 
   

/**
 * Register all core styles js.
 *
 * @since 1.0
 */
function yiw_register_styles() {
    wp_register_style( 'prettyPhoto',       YIW_FRAMEWORK_URL . 'includes/css/prettyPhoto.css' ); 
    wp_register_style( 'jquery-tipsy',      YIW_FRAMEWORK_URL . 'includes/css/tipsy.css' );         
}
add_filter( 'init', 'yiw_register_styles' );          
   

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since 1.0
 */
function yiw_page_menu_args( $args ) {
    $args['show_home'] = true;
    $args['menu_class'] = 'menu';
    return $args;
}
add_filter( 'wp_page_menu_args', 'yiw_page_menu_args' ); 

/**
 * Add new roles css for the customizations
 * 
 * @since 1.0                
 */  
function yiw_css_custom()
{
    $uploads = wp_upload_dir();
    $custom_style = stripslashes_deep( yiw_get_option( 'custom_style', '' ) );
    
    $custom_style = str_replace( '%siteurl%', site_url(), $custom_style );
    $custom_style = str_replace( '%templateurl%', get_template_directory_uri(), $custom_style );
    $custom_style = str_replace( '%contentsurl%', $uploads['baseurl'], $custom_style );
    ?><style type="text/css"><?php
        yiw_custom_css_roles( 'colors' );
        yiw_custom_css_roles( 'fonts' );
        echo $custom_style;
        do_action( 'yiw_custom_styles' );
    ?>
</style>
<?php 
}
                    
/**
 * Include the custom script javascript into the theme
 * @since 1.0
 */  
function yiw_custom_js()
{
    yiw_string_( '<script type="text/javascript">', stripslashes_deep( yiw_get_option( 'custom_js', '' ) ), '</script>' );
}                                    

if ( ! function_exists( 'yiw_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentyten_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since 1.0
 */
function yiw_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    
    if( isset($GLOBALS['count']) ) $GLOBALS['count']++;
    else $GLOBALS['count'] = 1; 
    
    switch ( $comment->comment_type ) :
        case '' :
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <div id="comment-<?php comment_ID(); ?>" class="comment-container">
            <div class="comment-author vcard">
                <?php echo get_avatar( $comment, 75 ); ?>
                <?php printf( __( '%s ', 'yiw' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
            </div><!-- .comment-author .vcard -->
            
            <div class="comment-meta commentmetadata">
                <?php if ( $comment->comment_approved == '0' ) : ?>
                    <em class="moderation"><?php _e( 'Your comment is awaiting moderation.', 'yiw' ); ?></em>
                    <br />
                <?php endif; ?>
                
                <div class="intro">
                    <div class="commentDate">
                      <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                        <?php
                            /* translators: 1: date, 2: time */
                            printf( __( '%1$s at %2$s', 'yiw' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'yiw' ), ' ' );
                        ?>
                    </div>

                    <div class="commentNumber">#&nbsp;<?php echo $GLOBALS['count'] ?></div>
                </div>
                    
                <div class="comment-body"><?php comment_text(); ?></div>
                
                
                <div class="reply group">
                    <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                </div><!-- .reply -->
            </div><!-- .comment-meta .commentmetadata -->
        </div><!-- #comment-##  -->

    <?php
            break;
        case 'pingback'  :
        case 'trackback' :
    ?>
    <li class="post pingback">
        <p><?php _e( 'Pingback:', 'yiw' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'yiw'), ' ' ); ?></p>
    <?php
            break;
    endswitch;
}
endif;

?>