<?php
require_once(ABSPATH.'wp-includes/class-oembed.php');
require_once('library/global_var.php');
/**
 * Google Authorship
 *---------------------------------------------------
 */
if ( ! function_exists( 'add_google_rel_author' ) ) {
    function add_google_rel_author() {
        if (is_single()){
            global $post;    
            $bk_author_id = $post->post_author;
            $bk_author_go = get_the_author_meta('googleplus', $bk_author_id);
            if ($bk_author_go != '') echo '<link rel="author" href="'.$bk_author_go.'" />';  
        }
    }
}
add_action('wp_head', 'add_google_rel_author');
/**
 * Get ajaxurl
 *---------------------------------------------------
 */
if ( ! function_exists( 'bk_ajaxurl' ) ) {
    function bk_ajaxurl() {
    ?>
        <script type="text/javascript">
            var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
        </script>
    <?php
    }
}
add_action('wp_head','bk_ajaxurl');
/**
 * http://codex.wordpress.org/Content_Width
 */
if ( ! isset($content_width)) {
	$content_width = 1050;
}
/**
 * Register scripts
 *---------------------------------------------------
 */
 
if ( ! function_exists( 'bk_scripts_method' ) ) {
    function bk_scripts_method() {
         
        global $bk_option;
        
        wp_enqueue_style('style', get_stylesheet_uri()); 
        
        wp_enqueue_style('flexslider', get_template_directory_uri() . '/css/flexslider.css'); 
        
        if ($bk_option['bk-rtl-sw']) {
            wp_enqueue_style('rtl', get_template_directory_uri() . '/css/rtl.css');
            if ($bk_option['bk-responsive-switch']) {wp_enqueue_style('rtl-responsive', get_template_directory_uri() . '/css/rtl-responsive.css');}; 
        }
        else {
            wp_enqueue_style('bkstyle', get_template_directory_uri() . '/css/bkstyle.css');
            if ($bk_option['bk-responsive-switch']) {wp_enqueue_style('responsive', get_template_directory_uri() . '/css/responsive.css');};  
        }   
        
        wp_enqueue_style('fa', get_template_directory_uri() . '/css/fonts/awesome-fonts/css/font-awesome.min.css');
        
        wp_enqueue_script( 'jquery' ); 
        
        if ( is_active_widget('','','bk_googlebadge')) {
            wp_enqueue_script('googlebadge', "https://apis.google.com/js/plusone.js", array('jquery'),false,true);
        }     
            
        wp_enqueue_script('flexslider-js', get_template_directory_uri() . '/js/jquery.flexslider.js', array('jquery'),false,true);
        
        wp_enqueue_script('jsmasonry-js', get_template_directory_uri() . '/js/masonry.pkgd.min.js', array('jquery'),false,true); 
        
        wp_enqueue_script('imagesloaded-plugin-js', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array('jquery'),false,true);  
        
            
        if ( is_active_widget('','','bk_ticker')) {
            wp_enqueue_script('ticker-js', get_template_directory_uri() . '/js/ticker.js', array('jquery'),false,true);
        }
        if ( is_active_widget('','','bk_masonry')) {
            wp_enqueue_script('masonry-load-post-js', get_template_directory_uri() . '/js/masonry-load-post.js', array('jquery'),false,true);
        }
        if ( is_active_widget('','','bk_classic_blog')) {
            wp_enqueue_script('classic-blog-load-post', get_template_directory_uri() . '/js/classic-blog-load-post.js', array('jquery'),false,true);
        }
        
        if ( is_active_widget('','','bk_main_slider')) {
            wp_enqueue_script('youtubeapi', "http://www.youtube.com/player_api", array('jquery'),false,true);
            wp_enqueue_script('froogaloop2', get_template_directory_uri() . '/js/froogaloop2.min.js', array('jquery'),false,true);
        }
        
        if ( is_category()) {
                wp_enqueue_script('youtubeapi', "http://www.youtube.com/player_api", array('jquery'),false,true);
                wp_enqueue_script('froogaloop2', get_template_directory_uri() . '/js/froogaloop2.min.js', array('jquery'),false,true);
            }
        
        if ( is_single() || is_active_widget('','','bk_review')) {
            wp_enqueue_script('bk_post_review', get_template_directory_uri() . '/js/bk_post_review.js', array('jquery'),false,true);
        }    
        
        if ( is_singular() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply',false,array(),false,true );  
        }
        
        wp_enqueue_script( 'fitvids',get_template_directory_uri() . '/js/jquery.fitvids.js', array('jquery'),false,true );
        
        wp_enqueue_script( 'customjs', get_template_directory_uri().'/js/customjs.js', array( 'jquery' ), false, true );  
    }
}
// enqueue base scripts and styles
add_action('wp_enqueue_scripts', 'bk_scripts_method');

// enqueue admin scripts and styles    
if ( ! function_exists( 'bk_post_admin_scripts_and_styles' ) ) {
    function bk_post_admin_scripts_and_styles($hook) {
        wp_register_style( 'bkadmin',  get_template_directory_uri(). '/css/admin.css', array(), '' );
        wp_enqueue_style('bkadmin'); // enqueue it	
    	// loading admin styles only on edit + posts + new posts
    	if( $hook == 'post.php' || $hook == 'post-new.php' ) {
    			wp_register_script( 'post-review-admin',  get_template_directory_uri() . '/js/post-review-admin.js', array(), '', true);
    			wp_enqueue_script( 'post-review-admin' ); // enqueue it
   		}
    }
}
add_action('admin_enqueue_scripts', 'bk_post_admin_scripts_and_styles');

if ( ! function_exists( 'bk_theme_setup' ) ){

    function bk_theme_setup() {
    	add_image_size( 'bk239_130', 239, 130, true );			// related posts thumbnails
    	add_image_size( 'bk75_75', 75, 75, true );              // sub post thumb
        add_image_size( 'bk100_100', 100, 100, true );			// main slider control thumb
        add_image_size( 'bk330_220', 330, 220, true );          // main post thumb
       	add_image_size( 'bk530_416', 530, 416, true );			// grid big
    	add_image_size( 'bk270_210', 270, 210, true );          // grid small
        add_image_size( 'bk262_400', 262, 400, true );          // carousel card
        add_image_size( 'bk1050_600', 1050, 600, true );        // main slider
        add_image_size( 'bk205_300', 205, 300, true );          // mega menu
        add_image_size( 'bk690_395', 690, 395, true );          // module hero
        add_image_size( 'bk262_262', 262, 262, true );          // carousel thumb
        add_image_size( 'bk559_280', 559, 280, true );
    }
}
add_action( 'after_setup_theme', 'bk_theme_setup' );
 
/**
 * Register sidebars and widgetized areas.
 *---------------------------------------------------
 */
 if ( ! function_exists( 'bk_widgets_init' ) ) {
    function bk_widgets_init() {
    
    	
        register_sidebar( array(
    		'name' => __('Home Full-width Section Top', 'bkninja'),
    		'id' => 'fullwidth_section_top',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget' => '</div>',
    		'before_title' => '<div class="bk-header"><div class="bk-title"><h3>',
    		'after_title' => '</h3></div></div>',
            'description'   => __('Full-width section under main navigation of Homepage template. Drag [Full-width module] here like Module Grid etc.', 'bkninja'),
    	) );
        
        register_sidebar( array(
    		'name' => __('Home Content Section', 'bkninja'),
    		'id' => 'content_section',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget' => '</div>',
    		'before_title' => '<div class="bk-header"><div class="bk-title"><h3>',
    		'after_title' => '</h3></div></div>',
            'description'   => __('Content section of Homepage template. Drag [Content module] here like Module Posts One etc.', 'bkninja'),
    	) );
        
        register_sidebar( array(
    		'name' => __('Home Sidebar', 'bkninja'),
    		'id' => 'home_sidebar',
    		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    		'after_widget' => '</aside>',
    		'before_title' => '<div class="bk-header"><div class="bk-title"><h3>',
    		'after_title' => '</h3></div></div>',
            'description'   => __('Sidebar of Homepage template. Drag [Sidebar widget] here like Widget Tabs etc.', 'bkninja'),
    	) );
            
        register_sidebar( array(
    		'name' => __('Home Full-width Section Bottom', 'bkninja'),
    		'id' => 'fullwidth_section_bottom',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget' => '</div>',
    		'before_title' => '<div class="bk-header"><div class="bk-title"><h3>',
    		'after_title' => '</h3></div></div>',
            'description'   => __('Full-width section above footer of Homepage template. Drag [Full-width module] here like Module Grid etc.', 'bkninja'),
    	) );        
        
        register_sidebar( array(
    		'name' => __('Page Sidebar', 'bkninja'),
    		'id' => 'page_sidebar',
    		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    		'after_widget' => '</aside>',
    		'before_title' => '<div class="bk-header"><div class="bk-title"><h3>',
    		'after_title' => '</h3></div></div>',
            'description'   => __('Sidebar of all other pages excluding Homepage template.', 'bkninja'),
    	) );
    
        register_sidebar( array(
    		'name' => __('Footer Sidebar 1', 'bkninja'),
    		'id' => 'footer_sidebar_1',
    		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    		'after_widget' => '</aside>',
    		'before_title' => '<div class="bk-header"><div class="bk-title"><h3>',
    		'after_title' => '</h3></div></div>',
    	) );
        
        register_sidebar( array(
    		'name' => __('Footer Sidebar 2', 'bkninja'),
    		'id' => 'footer_sidebar_2',
    		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    		'after_widget' => '</aside>',
    		'before_title' => '<div class="bk-header"><div class="bk-title"><h3>',
    		'after_title' => '</h3></div></div>',
    	) );
        
        register_sidebar( array(
    		'name' => __('Footer Sidebar 3', 'bkninja'),
    		'id' => 'footer_sidebar_3',
    		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    		'after_widget' => '</aside>',
    		'before_title' => '<div class="bk-header"><div class="bk-title"><h3>',
    		'after_title' => '</h3></div></div>',
    	) );
    }
}
add_action( 'widgets_init', 'bk_widgets_init' );


require_once("widgets/widget_twitter.php");
require_once("widgets/widget_post_review.php");
require_once("widgets/widget_google_badge.php");
require_once("widgets/widget_flickr.php");
require_once("widgets/widget_tabs.php");
require_once("widgets/widget_social_counter.php");
require_once("widgets/widget_slider.php");
require_once("widgets/widget_facebook.php");
require_once("widgets/widget_ads_banner.php");
require_once("widgets/widget_login.php");

require_once("widgets/module_ticker.php");
require_once("widgets/module_grid.php");
require_once("widgets/module_main_slider.php");
require_once("widgets/module_carousel.php");
require_once("widgets/module_masonry.php");
require_once("widgets/module_post_one.php");
require_once("widgets/module_post_two.php");
require_once("widgets/module_post_three.php");
require_once("widgets/module_post_four.php");
require_once("widgets/module_post_hero.php");
require_once("widgets/module_row.php");
require_once("widgets/module_classic_blog.php");

require_once("library/mega_menu.php");
require_once("library/core.php");
require_once("library/load_post.php");
require_once("library/custom_css.php");
require_once("library/translation.php");

// Re-define meta box path and URL
define( 'RWMB_URL', trailingslashit( get_stylesheet_directory_uri() . '/framework/meta-box' ) );
define( 'RWMB_DIR', trailingslashit( get_stylesheet_directory() . '/framework/meta-box' ) );
// Include the meta box script
require_once RWMB_DIR . 'meta-box.php';
require_once('library/meta_box_config.php');

require_once ('framework/taxonomy-meta/taxonomy-meta.php');
require_once('library/taxonomy-meta-config.php');



/**
 * Register menu locations
 *---------------------------------------------------
 */
if ( ! function_exists( 'bk_register_menu' ) ) {
    function bk_register_menu() {
        
        register_nav_menu('menu-main',__( 'Main Menu' ));
        register_nav_menu('menu-top',__( 'Top Menu' ));
        
    }
}
add_action( 'init', 'bk_register_menu' );


/**
 * Add support for the featured images (also known as post thumbnails).
 */
if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );
}

if ( !function_exists( 'bk_add_theme_format' ) ) { 
    function bk_add_theme_format() {
        if ( function_exists( 'add_theme_support' ) ) {
        add_theme_support( 'post-formats', array( 'gallery', 'video', 'image', 'audio' ) );
        }
    }
}
add_action('after_setup_theme', 'bk_add_theme_format');

/**
 * ReduxFramework
 */

if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/framework/ReduxFramework/ReduxCore/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/framework/ReduxFramework/ReduxCore/framework.php' );
}
if ( !isset( $bk_option ) && file_exists( dirname( __FILE__ ) . '/library/theme-option.php' ) ) {
    require_once( dirname( __FILE__ ) . '/library/theme-option.php' );
}
/**
 * Tag cloud
 */
//Register tag cloud filter callback
add_filter('widget_tag_cloud_args', 'tag_widget_limit');

//Limit number of tags inside widget
function tag_widget_limit($args){

 //Check if taxonomy option inside widget is set to tags
 if(isset($args['taxonomy']) && $args['taxonomy'] == 'post_tag'){
  $args['number'] = 16; //Limit number of tags
  $args['orderby'] = 'count'; //Order by counts
  $args['order'] = 'DESC';
 }

 return $args;
}


function bk_widget_shortcode( $atts ) {

// Configure defaults and extract the attributes into variables
extract( shortcode_atts( 
	array('name' => ''), 
	$atts 
));

ob_start();
the_widget($name,$atts); 
$output = ob_get_clean();

return $output;
}
add_shortcode('widget','bk_widget_shortcode'); 