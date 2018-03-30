<?php
/**************************************************************************************************/
/* Define Constants */
/**************************************************************************************************/

define('THEMEROOT', get_template_directory_uri());
define('REDUX', get_template_directory());
define('IMAGES', THEMEROOT . '/images');


/**************************************************************************************************/
/* Theme Setup  */
/**************************************************************************************************/

add_action( 'after_setup_theme', 'Theme2035_setup' );

function Theme2035_setup(){

global $content_width;
global $theme_prefix;
if ( ! isset( $content_width ) ) $content_width = 1200;

if ( function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 848, 400, true);
}

add_theme_support( 'post-formats', array(
    'audio', 'gallery', 'link', 'quote', 'video'
));

load_theme_textdomain( '2035Themes-fm', get_template_directory().'/languages' );

add_action('init', 'Theme2035_register_menus');

add_theme_support( 'automatic-feed-links' );

add_theme_support( 'title-tag' );

}

/**************************************************************************************************/
/* Admin Framework  */
/**************************************************************************************************/

if ( !class_exists( 'ReduxFramework' ) && file_exists( REDUX . '/admin/ReduxCore/framework.php' ) ) {
    require_once( REDUX . '/admin/ReduxCore/framework.php' );
}
if ( !isset( $redux_demo ) && file_exists( REDUX . '/admin/blog/blog-config.php' ) ) {
    require_once( REDUX . '/admin/blog/blog-config.php' );
}

/**************************************************************************************************/
/* Custom Styles */
/**************************************************************************************************/

include_once 'inc/customcss.php';
include_once 'inc/customjs.php';

/**************************************************************************************************/
/* Custom Widgets */
/**************************************************************************************************/

$widgets = array(
    '/inc/custom-widgets/author.php',
    '/inc/custom-widgets/social-media.php',
    '/inc/custom-widgets/instagram.php',
    '/inc/custom-widgets/pinterest.php',
    '/inc/custom-widgets/twitter.php',
    '/inc/custom-widgets/recent-posts.php',
    '/inc/custom-widgets/most-popular.php',
);
$widgets = apply_filters( 'Theme2035-widgets', $widgets );
foreach ( $widgets as $widget ) {
    locate_template( $widget, true );
}


if (!function_exists('Theme2035_register_sidebars')) {
    function Theme2035_register_sidebars() {
        if (function_exists('register_sidebar')) {
            register_sidebar(
                array(
                'name' => __( 'Main Sidebar', '2035Themes-fm' ),
                'id' => 'sidebar-1',
                'description' => __( 'Main Sidebar', '2035Themes-fm' ),
                'before_widget' => '<div class="sidebar-widget clearfix">',
                'after_widget' => '</div>',
                'before_title' => '<h6>',
                'after_title' => '</h6><hr>',
            ));
            register_sidebar(
                array(
                'name' => __( 'Footer 1 Widget', '2035Themes-fm' ),
                'id' => 'footer-1',
                'description' => __( 'Footer 1 Widget', '2035Themes-fm' ),
                'before_widget' => '<div class="sidebar-widget clearfix">',
                'after_widget' => '</div>',
                'before_title' => '<h6>',
                'after_title' => '</h6><hr>',
            ));
            register_sidebar(
                array(
                'name' => __( 'Footer 2 Widget', '2035Themes-fm' ),
                'id' => 'footer-2',
                'description' => __( 'Footer 2 Widget', '2035Themes-fm' ),
                'before_widget' => '<div class="sidebar-widget clearfix">',
                'after_widget' => '</div>',
                'before_title' => '<h6>',
                'after_title' => '</h6><hr>',
            ));
            register_sidebar(
                array(
                'name' => __( 'Footer 3 Widget', '2035Themes-fm' ),
                'id' => 'footer-3',
                'description' => __( 'Footer 3 Widget', '2035Themes-fm' ),
                'before_widget' => '<div class="sidebar-widget clearfix">',
                'after_widget' => '</div>',
                'before_title' => '<h6>',
                'after_title' => '</h6><hr>',
            )); 
            register_sidebar(
                array(
                'name' => __( 'Footer 4 Widget', '2035Themes-fm' ),
                'id' => 'footer-4',
                'description' => __( 'Footer 4 Widget', '2035Themes-fm' ),
                'before_widget' => '<div class="sidebar-widget clearfix">',
                'after_widget' => '</div>',
                'before_title' => '<h6>',
                'after_title' => '</h6><hr>',
            ));       
        }
    }
    add_action( 'widgets_init', 'Theme2035_register_sidebars');
}

require_once('inc/custom-sidebars/customsidebars.php');

/**************************************************************************************************/
/* Register Css */
/**************************************************************************************************/

function Theme2035_register_styles() { 
    global $theme_prefix;

    // Register
    
    wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css','','1'); 
    wp_register_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css','','1');
    wp_register_style('flexslider', get_template_directory_uri() . '/css/flexslider.css','','1');
    wp_register_style('slicknav', get_template_directory_uri() . '/css/slicknav.css','','1');
    wp_register_style('responsive', get_template_directory_uri() . '/css/responsive.css','','1');
    // Enqueue
    wp_enqueue_style('bootstrap'); 
    wp_enqueue_style('font-awesome');
    wp_enqueue_style('flexslider');
    wp_enqueue_style('slicknav');
    wp_enqueue_style('responsive');
    wp_enqueue_style( 'main', get_stylesheet_uri()); 
    wp_enqueue_style('main');    
}

add_action('wp_enqueue_scripts', 'Theme2035_register_styles');

/**************************************************************************************************/
/* Register Js */
/**************************************************************************************************/

if (is_admin() ){
    function Theme2035_custom_post_select(){    
        wp_register_script('init', get_template_directory_uri() . '/js/admin/init.js', 'jquery', '3.5.1');  
        wp_enqueue_script('init');
    }
}

add_action('admin_enqueue_scripts', 'Theme2035_custom_post_select');

// add admin scripts
add_action('admin_enqueue_scripts', 'Theme2035_ctup_wdscript');
function Theme2035_ctup_wdscript() {
    wp_enqueue_media();
    wp_enqueue_script('ads_script', get_template_directory_uri() . '/js/admin/upload-media.js', false, '1.0', true);
}

function Theme2035_register_js() {
    global $theme_prefix;
    // Register
    wp_register_script('modernizr', get_template_directory_uri() . '/js/modernizr-2.6.2-respond-1.1.0.min.js', '3.5.1');         
    wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', 'jquery', '3.5.1', TRUE);
    wp_register_script('flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', 'jquery', '', TRUE);
    wp_register_script('fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', 'jquery', '', TRUE);
    wp_register_script('superfish', get_template_directory_uri() . '/js/superfish.pack.1.4.1.js', 'jquery', '', TRUE);
    wp_register_script('slicknav', get_template_directory_uri() . '/js/jquery.slicknav.min.js', 'jquery', '', TRUE);
    wp_register_script('sticky', get_template_directory_uri() . '/js/theia-sticky-sidebar.js', 'jquery', '', TRUE);
    wp_register_script('main', get_template_directory_uri() . '/js/main.js', 'jquery', '', TRUE);

    // Enqueue
    wp_enqueue_script('modernizr');        
    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap');
    wp_enqueue_script('flexslider');
    wp_enqueue_script('fitvids');
    wp_enqueue_script('superfish');
    wp_enqueue_script('slicknav');
    wp_enqueue_script('sticky');
    wp_enqueue_script('main');

    
    $themepathjs = array( 'template_url' => get_template_directory_uri() );
    wp_localize_script( 'main', 'themepathjs', $themepathjs );
} 

add_action('wp_enqueue_scripts', 'Theme2035_register_js');

/**************************************************************************************************/
/* Include Meta Box  */
/**************************************************************************************************/

define( 'RWMB_URL', trailingslashit( get_template_directory_uri() . '/inc/meta-box' ) );
define( 'RWMB_DIR', trailingslashit( get_template_directory() . '/inc/meta-box' ) );
require_once RWMB_DIR . 'meta-box.php';
include_once 'inc/metabox.php';


/**************************************************************************************************/
/* Custom Image Size */
/**************************************************************************************************/

if ( function_exists( 'add_image_size' ) ) {
    add_image_size( 'full-featured-image', 1170, 0, true );             
    add_image_size( 'featured-image', 880, 0, true );          
    add_image_size( 'home-slider-3-grid', 400, 380, true );                
    add_image_size( 'home-slider-1-grid', 1170, 610, true );                
}

/**************************************************************************************************/
/* Pagination */
/**************************************************************************************************/

if ( !function_exists( 'Theme2035_pagination' ) ) {
        function Theme2035_pagination() {           
            if( !empty($options['extra_pagination']) && $options['extra_pagination'] == '1' ){
                        
                        global $wp_query;  

                        $total_pages = $wp_query->max_num_pages;  
                          
                        if ($total_pages > 1){  
                          
                          $current_page = max(1, get_query_var('paged'));  
                          
                            echo '<div id="pagination">';
                               
                            echo paginate_links(array(  
                              'base' => get_pagenum_link(1) . '%_%',  
                              'format' => '/page/%#%',  
                              'current' => $current_page,  
                              'total' => $total_pages,  
                            ));    
                            echo  '</div>';         
                        }  
                    }
            else{   
                       
                if( get_next_posts_link() || get_previous_posts_link() ) { 
                echo '<div class="pos-center">';
                    echo '<div class="pagination">';

                        if ( get_previous_posts_link() ) : ?>
                        <div class="next-post margint20"><?php previous_posts_link( __( '<i class="fa fa-angle-left"></i>Newer Post ', '2035Themes-fm' ) ); ?></div>
                        <?php endif;
                        if ( get_previous_posts_link() & get_next_posts_link()  ) :  echo "<div class='divider margint20'></div>"; endif;
                        if ( get_next_posts_link() ) : ?>
                        <div class="prev-post margint20"><?php next_posts_link( __( 'Older Post<i class="fa fa-angle-right"></i>', '2035Themes-fm' ) ); ?></div>
                        <?php endif; 

                    echo  '</div>';         
                echo  '</div>';         
            }
        }
    }
}


/**************************************************************************************************/
/* Search Form */
/**************************************************************************************************/

function Theme2035_my_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
    <label class="screen-reader-text" for="s">' . __( 'Search for:', '2035Themes-fm' ) . '</label>
    <input type="text" placeholder="'. __("Search...","2035Themes-fm") .'" value="' . get_search_query() . '" name="s" id="s" />
    <span class="search-icon"><i class="fa fa-search"></i></span>
    </form>';

    return $form;
}

add_filter( 'get_search_form', 'Theme2035_my_search_form' );

/**************************************************************************************************/
/* Register Menu */
/**************************************************************************************************/

function Theme2035_register_menus() {
    register_nav_menus( array( 'main-menu' => __('Main Menu(After the Logo)',"theme2035-fm")) );
    register_nav_menus( array( 'pre-header-menu' => __('Pre-Header Menu',"theme2035-fm")) );
}


/**************************************************************************************************/
/* TGM plugin activation */
/**************************************************************************************************/

include( get_template_directory() . '/inc/tgm/class-tgm-plugin-activation.php' );
include( get_template_directory() . '/inc/tgm/example.php' );


/**************************************************************************************************/
/* Custom Comments */
/**************************************************************************************************/

function Theme2035_comment( $comment, $args, $depth ) {
       $GLOBALS['comment'] = $comment; ?>
                                  
       <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
           <div id="comment-<?php comment_ID(); ?>" class="clearfix"> 
                <div class="user-comment-box clearfix">
                    <div class="col-lg-2 col-sm-2 col-xs-4">
                        <?php echo get_avatar($comment, $size = '130'); ?>
                    </div>
                    <div class="col-lg-10 col-sm-10 col-xs-8 comment-content">
                        <div class="clearfix">
                             <div class="author pull-left">
                                <h3><?php printf( __( '%s', '2035Themes-fm'), get_comment_author_link() ) ?></h3>
                                <div class="date"><p><?php echo esc_attr($post_date = get_comment_date('F j'));  ?></p></div>
                             </div>

                             <div class="comment-tools pull-right">
                                <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>  
                             </div>
                         </div>
                         <p><?php comment_text() ?></p>
                         <?php edit_comment_link( __( '(Edit)', '2035Themes-fm'),'  ','' ) ?>
                         <?php if ( $comment->comment_approved == '0' ) : ?>
                         <em><?php __( 'Your comment is awaiting moderation.', '2035Themes-fm' ) ?></em>
                        <?php endif; ?>
                        
                    </div>
                </div>
           </div>
       </li>

<?php }

if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
    wp_enqueue_script( 'comment-reply' );


/**************************************************************************************************/
/* Excerpt Read More */
/**************************************************************************************************/

function Theme2035_more_link() {
    return '<div class="third-font margint40 marginb30 pos-center"><a class="more-link" href="' . get_permalink() . '">' . __("Read More <span class='arrow-read'>&#8594;</span>","2035Themes-fm") . '</a></div>';
}
add_filter('the_content_more_link', 'Theme2035_more_link', 10, 2);


/**************************************************************************************************/
/* Walker Menu Nav */
/**************************************************************************************************/

require_once ('inc/menu-icon.php');

class description_walker extends Walker_Nav_Menu
{
      function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) 
      {
           global $wp_query;
           global $class;

           $class_names = $value = $varpost =  '';

           $classes = empty( $item->classes ) ? array() : (array) $item->classes;

           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
          

           $output .=  '<li id="menu-item-'. $item->ID . '" class="'.$class_names .'">';

           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
     
            $attributes .= ' href="' . $item->url . '"';
          
            $item_output = $args->before;
            $item_output .= '<div class="frame"><span class="helper"></span><a'. $attributes . '>';
          
            if (!empty($item->icon)){
            $item_output .= '<img alt="" src="' . $item->icon . '">';
            }
            $item_output .= "<span class='main-nav-text'>";
            $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID );
            $item_output .= $args->link_after;
            $item_output .= "</span>";
            $item_output .= '</a></div>';
            $item_output .= $args->after;
            

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
            }
}

?>