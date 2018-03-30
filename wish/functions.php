<?php

/**

 * Wish functions and definitions

 *

 * @package Wish

 */





/**

 * Add Redux Framework & extras

 */

require get_template_directory() . '/framework/wph-widget-class.php';

require get_template_directory() . '/admin/admin-init.php';

require get_template_directory() . '/framework/widgets.php';

require get_template_directory() . '/custom-fields.php';

require get_template_directory() . '/framework/testimonial-widget/widget-testimonial.php';

require get_template_directory() . '/framework/footer-recent-posts/widget-post-thumbnail.php';



if ( function_exists( "is_woocommerce" ) ) {

    require_once ( get_template_directory() . '/woocommerce/wc-customized.php' );    //woocommerce shop plugin    

}



// Mega Menu

require get_template_directory() . '/menus/wish_megadropdown.php';













// tgm plugin init

//tgm plugins activation

require_once( get_template_directory() . '/framework/class-tgm-plugin-activation.php' );



//tgm hook

add_action( 'tgmpa_register', 'wish_register_required_plugins' );



function wish_register_required_plugins(){



            $plugins = array(



                                array(

                                    'name'                  => 'Meta Box',

                                    'slug'                  => 'meta-box',

                                    'required'              => true,

                                    'force_activation'      => false,

                                    'force_deactivation'    => false,

                                ),





                                array(



                                    'name'                  => 'WPBakery Visual Composer', // The plugin name

                                    'slug'                  => 'js_composer', // The plugin slug (typically the folder name)

                                    'source'                => get_template_directory_uri() . '/plugins/js_composer.zip', // The plugin source

                                    'required'              => true, // If false, the plugin is only 'recommended' instead of required

                                    'version'               => '4.11.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented

                                    'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch

                                    'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins

                                    'external_url'          => '', // If set, overrides default API URL and points to an external URL

                                ),



                                array(



                                    'name'                  => 'Slider Revolution', // The plugin name

                                    'slug'                  => 'revslider', // The plugin slug (typically the folder name)

                                    'source'                => get_template_directory_uri() . '/plugins/revslider.zip', // The plugin source

                                    'required'              => true, // If false, the plugin is only 'recommended' instead of required

                                    'version'               => '5.1.6', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented

                                    'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch

                                    'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins

                                    'external_url'          => '', // If set, overrides default API URL and points to an external URL

                                ),



                                array(



                                    'name'                  => 'Wish Core', // The core plugin for the orane theme

                                    'slug'                  => 'wish_core', // The plugin slug (typically the folder name)

                                    'source'                => get_template_directory_uri() . '/plugins/wish_core.zip', // The plugin source

                                    'required'              => true, // If false, the plugin is only 'recommended' instead of required

                                    'version'               => '1.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented

                                    'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch

                                    'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins

                                    'external_url'          => '', // If set, overrides default API URL and points to an external URL

                                ),



                                array(

                                    'name'                  => 'Wordpress Importer',

                                    'slug'                  => 'wordpress-importer',

                                    'required'              => false,

                                    'force_activation'      => false,

                                ),





                                array(

                                    'name'                  => 'Contact Form 7',

                                    'slug'                  => 'contact-form-7',

                                    'required'              => false,

                                    'force_activation'      => false,

                                ),



                                array(

                                    'name'                  => 'MailChimp for WordPress',

                                    'slug'                  => 'mailchimp-for-wp',

                                    'required'              => false,

                                    'force_activation'      => false,

                                ), 



                        );



                        $config = array(



                            'default_path' => '',                      // Default absolute path to pre-packaged plugins.

                            'menu'         => 'tgmpa-install-plugins', // Menu slug.

                            'has_notices'  => true,                    // Show admin notices or not.

                            'dismissable'  => false,                    // If false, a user cannot dismiss the nag message.

                            'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.

                            'is_automatic' => true,                   // Automatically activate plugins after installation or not.

                            'message'      => '',                      // Message to output right before the plugins table.



                        );



            tgmpa( $plugins, $config );

}

//ends tgm plugins activation





//stop visual composer from asking to activate, its not required in the built-into theme version

setcookie('vchideactivationmsg', '1', strtotime('+3 years'), '/');



// set revolution slider as a part of theme

if(function_exists( 'set_revslider_as_theme' )){

add_action( 'init', 'wish_revolution_as_theme' );

	function wish_revolution_as_theme() {

	 	set_revslider_as_theme();

	}

}





//remove redux annoying stuff

function wish_removeDemoModeLink() { // Be sure to rename this function to something more unique

    if ( class_exists('ReduxFrameworkPlugin') ) {

        remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );

    }

    if ( class_exists('ReduxFrameworkPlugin') ) {

        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    

    }

}

add_action('init', 'wish_removeDemoModeLink');



//remove redux from under the tools menu

add_action( 'admin_menu', 'wish_remove_redux_menu',12 );

function wish_remove_redux_menu() {

    remove_submenu_page('tools.php','redux-about');

}





/**

 * Set the content width based on the theme's design and stylesheet.

 */

if ( ! isset( $content_width ) ) {

	$content_width = 640; /* pixels */

}



if ( ! function_exists( 'wish_setup' ) ) :

/**

 * Sets up theme defaults and registers support for various WordPress features.

 *

 * Note that this function is hooked into the after_setup_theme hook, which

 * runs before the init hook. The init hook is too late for some features, such

 * as indicating support for post thumbnails.

 */

function wish_setup() {





	add_image_size('post-project-image', 550, 700, true);

    add_image_size('post-blog-layout', 1000, 378, true);

	add_image_size('post-sidebar-image', 300, 450, true);

	add_image_size('team-thumb', 100, 100, true);

	add_image_size('clients-thumb', 165, 125, true);

	add_image_size('project-thumb', 480, 330, true);

	add_image_size('project-thumb-tall', 480, 660, true);

	add_image_size('widget_testimonial_thumb', 100, 100, true);



	add_image_size('project-slider-big', 1000, 1000, true);

	add_image_size('project-slider-thumb', 240, 240, true);

	add_image_size('team-carousel-large', 660, 550, true);

	add_image_size('team-carousel-thumb', 90, 90, true);

	add_image_size('wish-intro-item', 50, 50, true);

	add_image_size('wish-intro-icon', 23, 23, true);

	add_image_size('wish-parallax-item-thumb', 290, 194, true);

	

	add_image_size('projects_thumb', 250, 250, true);



	add_image_size('wish-blog-carousel', 450, 240, true);

	add_image_size('portfolio_grid_image', 240, 420, true);

	add_image_size('footer_posts', 65, 65, true);

	add_image_size('type_post_image', 548, 400, true);



	/*

	 * Make theme available for translation.

	 * Translations can be filed in the /languages/ directory.

	 * If you're building a theme based on Wish, use a find and replace

	 * to change 'wish' to the name of your theme in all the template files

	 */

	load_theme_textdomain( 'wish', get_template_directory() . '/languages' );



	// Add default posts and comments RSS feed links to head.

	add_theme_support( 'automatic-feed-links' );



	/*

	 * Let WordPress manage the document title.

	 * By adding theme support, we declare that this theme does not use a

	 * hard-coded <title> tag in the document head, and expect WordPress to

	 * provide it for us.

	 */

	add_theme_support( 'title-tag' );



	/*

	 * Enable support for Post Thumbnails on posts and pages.

	 *

	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails

	 */

	add_theme_support( 'post-thumbnails' );



	// add woocommerce support

	add_theme_support( 'woocommerce' );



	// This theme uses wp_nav_menu() in one location.

	register_nav_menus( array(

		'primary' => esc_html__( 'Primary Menu', 'wish' ),

	) );



	/*

	 * Switch default core markup for search form, comment form, and comments

	 * to output valid HTML5.

	 */

	add_theme_support( 'html5', array(

		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',

	) );



	/*

	 * Enable support for Post Formats.

	 * See http://codex.wordpress.org/Post_Formats

	 */

	add_theme_support( 'post-formats', array(

		'image', 'video', 'gallery', 'audio'

	) );



	// Set up the WordPress core custom background feature.

	add_theme_support( 'custom-background', apply_filters( 'wish_custom_background_args', array(

		'default-color' => 'ffffff',

		'default-image' => '',

	) ) );

}

endif; // wish_setup

add_action( 'after_setup_theme', 'wish_setup' );



/**

 * Register widget area.

 *

 * @link http://codex.wordpress.org/Function_Reference/register_sidebar

 */

function wish_widgets_init() {

	register_sidebar( array(

		'name'          => esc_html__( 'Sidebar', 'wish' ),

		'id'            => 'sidebar-1',

		'description'   => esc_html__('Sidebar in blog posts. Can be enabled/disabled from the theme options page.', 'wish'),

		'before_widget' => '<aside id="%1$s" class="widget %2$s">',

		'after_widget'  => '</aside>',

		'before_title'  => '<h3>',

		'after_title'   => '</h3>',

	) );

	register_sidebar( array(

		'name'          => esc_html__( 'Footer Widget 1', 'wish' ),

		'id'            => 'f-w-1',

		'description'   => esc_html__('Footer Widget Area, first column. Can be enabled/disabled from the theme options page.', 'wish'),

		'before_widget' => '<div class="animated" data-animation="fadeInUp" data-animation-delay="500">',

		'after_widget'  => '</div>',

		'before_title'  => '<h3>',

		'after_title'   => '</h3>',

	) );

	register_sidebar( array(

		'name'          => esc_html__( 'Footer Widget 2', 'wish' ),

		'id'            => 'f-w-2',

		'description'   => esc_html__('Footer Widget Area, second column. Can be enabled/disabled from the theme options page.', 'wish'),

		'before_widget' => '<div class="animated" data-animation="fadeInUp" data-animation-delay="500">',

		'after_widget'  => '</div>',

		'before_title'  => '<h3>',

		'after_title'   => '</h3>',

	) );

	register_sidebar( array(

		'name'          => esc_html__( 'Footer Widget 3', 'wish' ),

		'id'            => 'f-w-3',

		'description'   => esc_html__('Footer Widget Area, third column. Can be enabled/disabled from the theme options page.','wish'),

		'before_widget' => '<div class="animated" data-animation="fadeInUp" data-animation-delay="500">',

		'after_widget'  => '</div>',

		'before_title'  => '<h3>',

		'after_title'   => '</h3>',

	) );

	register_sidebar( array(

		'name'          => esc_html__( 'Footer Widget 4', 'wish' ),

		'id'            => 'f-w-4',

		'description'   => esc_html__('Footer Widget Area, fourth column. Can be enabled/disabled from the theme options page.', 'wish' ),

		'before_widget' => '<div class="animated" data-animation="fadeInUp" data-animation-delay="500">',

		'after_widget'  => '</div>',

		'before_title'  => '<h3>',

		'after_title'   => '</h3>',

	) );

	

	register_sidebar( array(

		'name'          => esc_html__( 'Footer Widget 1 Level 1', 'wish' ),

		'id'            => 'f-w-5',

		'description'   => esc_html__('Seconday Footer Widget Area, fourth column. Can be enabled/disabled from the theme options page.', 'wish' ),

		'before_widget' => '<div class="animated" data-animation="fadeInUp" data-animation-delay="500">',

		'after_widget'  => '</div>',

		'before_title'  => '<h3>',

		'after_title'   => '</h3>',

	) );

	register_sidebar( array(

		'name'          => esc_html__( 'Footer Widget 2 Level 1', 'wish' ),

		'id'            => 'f-w-6',

		'description'   => esc_html__('Seconday Footer Widget Area, fourth column. Can be enabled/disabled from the theme options page.','wish' ),

		'before_widget' => '<div class="animated" data-animation="fadeInUp" data-animation-delay="500">',

		'after_widget'  => '</div>',

		'before_title'  => '<h3>',

		'after_title'   => '</h3>',

	) );

	register_sidebar( array(

		'name'          => esc_html__( 'Footer Widget 3 Level 1', 'wish' ),

		'id'            => 'f-w-7',

		'description'   => esc_html__('Seconday Footer Widget Area, fourth column. Can be enabled/disabled from the theme options page.','wish' ),

		'before_widget' => '<div class="animated" data-animation="fadeInUp" data-animation-delay="500">',

		'after_widget'  => '</div>',

		'before_title'  => '<h3>',

		'after_title'   => '</h3>',

	) );

	register_sidebar( array(

		'name'          => esc_html__( 'Footer Widget 4 Level 1', 'wish' ),

		'id'            => 'f-w-8',

		'description'   => esc_html__('Seconday Footer Widget Area, fourth column. Can be enabled/disabled from the theme options page.','wish' ),

		'before_widget' => '<div class="animated" data-animation="fadeInUp" data-animation-delay="500">',

		'after_widget'  => '</div>',

		'before_title'  => '<h3>',

		'after_title'   => '</h3>',

	) );



	register_sidebar( array(

	'name'          => esc_html__( 'Shop Sidebar', 'wish' ),

	'id'            => 'shop-sidebar',

	'description'   => esc_html__('Woocommerce Sidebar in shop pages. Can be enabled/disabled from the theme options page.','wish' ),

	'before_widget' => '<aside id="%1$s" class="widget %2$s">',

	'after_widget'  => '</aside>',

	'before_title'  => '<h3>',

	'after_title'   => '</h3>',

	) );







}

add_action( 'widgets_init', 'wish_widgets_init' );



/**

 * Enqueue scripts and styles.

 */

function wish_scripts() {





	//scripts needed on all pages

	wp_register_style('all-stylesheets', get_template_directory_uri() . '/css/all-stylesheets.css', array(), '1', 'all' );

	wp_enqueue_style('all-stylesheets');

	wp_enqueue_style( 'wish-style', get_stylesheet_uri() );

	wp_enqueue_script( 'bootstrap.min', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '3.3.2', 3 );

	wp_enqueue_script( 'classie', get_template_directory_uri() . '/js/overlay-resizemenu/js/classie.js', array( 'jquery' ), '1.0.0', 3 );

	wp_enqueue_script( 'bootstrap-hover-dropdown', get_template_directory_uri() . '/js/bootstrap-hover/bootstrap-hover-dropdown.js', array( 'jquery' ), '2.0.10', 3 );



	wp_enqueue_script( 'jquery.easing.1.3', get_template_directory_uri() . '/js/jquery.easing/jquery.easing.1.3.js', array( 'jquery' ), '1.3', 3);

	wp_enqueue_script( 'jquery.appear', get_template_directory_uri() . '/js/animation/jquery.appear.js', array( 'jquery' ), '', 3 );



	wp_enqueue_script( 'retina', get_template_directory_uri() . '/js/retina/retina.js', array( 'jquery' ), '0.0.2', 3 );

	wp_enqueue_script( 'jquery.fitvids', get_template_directory_uri() . '/js/fitvids/jquery.fitvids.js', array( 'jquery' ), '1.1', 3 );

	wp_enqueue_script( 'SmoothScroll', get_template_directory_uri() . '/js/SmoothScroll/SmoothScroll.js', array( 'jquery' ), '0.9.9', 3 );

	

	wp_enqueue_script( 'meanmenu', get_template_directory_uri() . '/js/jquery.meanmenu.min.js', array( 'jquery' ), '2.0.6', 1 );



	wp_enqueue_script( 'wish_menu', get_template_directory_uri() . '/js/wish_menu.js', array( 'jquery' ), '', 1 );

	wp_enqueue_script( 'nav-scrollTo', get_template_directory_uri() . '/js/nav/jquery.scrollTo.js', array( 'jquery' ), '1.4.3', 3 );

	wp_enqueue_script( 'jquery.nav', get_template_directory_uri() . '/js/nav/jquery.nav.js', array( 'jquery' ), '2.2.0', 3 );





	wp_enqueue_script( 'jquery.sticky', get_template_directory_uri() . '/js/sticky/jquery.sticky.js', array( 'jquery' ), '1.0.0', 3 );

	

	wp_enqueue_script( 'googlemaps', '//maps.google.com/maps/api/js?sensor=false&amp;language=en', array( 'jquery' ), '', 3 );

	wp_enqueue_script( 'gmap3.min', get_template_directory_uri() . '/js/map/gmap3.min.js', array( 'jquery' ), '6.0.0', 3 );

	wp_enqueue_script( 'wis-custom', get_template_directory_uri() . '/js/custom/custom.js', array( 'jquery' ), '', 2 );

	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.custom.js', array('jquery') );

	



	// pass path to custom script

    $wish_path = array( 'path' => get_template_directory_uri() );

    wp_localize_script( 'wis-custom', 'wish_path', $wish_path );





	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {

		wp_enqueue_script( 'comment-reply' );

	}



	//css compiler in action

    global $redux_wish, $post;

    

    $auto_compile = 0;

    // $auto_compile = $redux_wish["wish-trouble-auto-compile"];

    $wish_floating_menu = $redux_wish['wish-floating-menu'];







    if( function_exists('rwmb_meta') && isset($post) ){

        $force_float_menu = rwmb_meta('wish_force_float_menu', $post->ID); //forcing a floating menu?

    }else{

        $force_float_menu = false;

    }



    //checks if the user has set auto compile or redux save compile

    if($auto_compile){

            $orane_css_compile = "";

            require get_template_directory() . '/css_compile.php';

    }



    wp_enqueue_style('wish-css-compile', get_template_directory_uri() . '/css/compile.css');

    



    //is menu fixed

    if ( (is_front_page() && $wish_floating_menu) || $force_float_menu) {

        wp_enqueue_style('wish-css-menu-compile', get_template_directory_uri() . '/css/menu_compiled_fixed.css');

    }else{

        wp_enqueue_style('wish-css-menu-compile', get_template_directory_uri() . '/css/menu_compiled.css');

    }

     



}

add_action( 'wp_enqueue_scripts', 'wish_scripts' );





/**

 * Custom template tags for this theme.

 */

require get_template_directory() . '/inc/template-tags.php';



/**

 * Custom functions that act independently of the theme templates.

 */

require get_template_directory() . '/inc/extras.php';



/**

 * Customizer additions.

 */

require get_template_directory() . '/inc/customizer.php';



/**

 * Load Jetpack compatibility file.

 */

require get_template_directory() . '/inc/jetpack.php';











/*=============================== Allow image insertion ====================================*/

add_filter('get_media_item_args', 'wish_allow_img_insertion');

function wish_allow_img_insertion($vars) {

    $vars['send'] = true; // 'send' as in "Send to Editor"

    return($vars);

}





/*=============================== Limit the excerpt length ====================================*/

function wish_custom_excerpt_length( $length ) {

	return 35;

}

add_filter( 'excerpt_length', 'wish_custom_excerpt_length', 999 );





/*=============================== Replaces the excerpt "more" text by a link ====================================*/

function wish_new_excerpt_more($more) {

    global $post;

	return '...<div class="readmore animated" data-animation="fadeInUp" data-animation-delay="600"><a class="moretag" href="'. esc_url( get_permalink() ). '">' . esc_html__('Read More', 'wish') .'</a></div>';

}

add_filter('excerpt_more', 'wish_new_excerpt_more');







add_filter('get_avatar','wish_add_gravatar_class');



function wish_add_gravatar_class($class) {

    $class = str_replace("class='avatar", "class='media-object img-circle", $class);

    return $class;

}

/////////////////////////////////////////////////////////  customize comment form

function wish_comment( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment;

		if ( 'div' == $args['style'] ) {

			$tag = 'div';

			$add_below = 'comment';

		} else {

			$tag = 'li';

			$add_below = 'div-comment';

		}

?>

		<<?php echo esc_attr($tag); ?> <?php comment_class( empty( $args['has_children'] ) ? 'media' : 'parent media' ) ?> id="comment-<?php comment_ID() ?>" >

		 <a class="pull-left" href="#">

			<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>

            	</a>

		<?php if ( 'div' != $args['style'] ) : ?>

		<div id="div-comment-<?php comment_ID(); ?>" class="media-body">

		<?php endif; ?>







                   <div><span class="media-heading"><?php printf(  '%s' , get_comment_author_link() ); ?></span><span class="date pull-right"><?php

				/* translators: 1: date, 2: time */

				printf( '%1$s' , get_comment_date() ); ?></a><?php edit_comment_link( esc_html__( '(Edit)', 'wish' ), '&nbsp;&nbsp;', '' );

			?></span>





		<?php if ( '0' == $comment->comment_approved ) : ?>

		<em class="comment-awaiting-moderation"><?php esc_html_e( '<br>Your comment is awaiting moderation.', 'wish' ) ?></em>

		</div>

		<?php endif; ?>



  <p><?php comment_text( get_comment_id(), array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?><?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?> <i class="fa fa-angle-double-right"></i></p>







		<?php if ( 'div' != $args['style'] ) : ?>

		</div>

		<?php endif; ?>

<?php

	}





	/*=================================== Reduce post title in sidebar ===============================*/

function wish_get_words($sentence, $count = 8) {

  preg_match("/(?:\w+(?:\W+|$)){0,$count}/", $sentence, $matches);

  return $matches[0];

}



// woocommerce stuff

//add own wrappers in woocommerce

//unlock the wrappers

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);

remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);





//my theme wrappers

add_action('woocommerce_before_main_content', 'wish_wrapper_start', 10);

add_action('woocommerce_after_main_content', 'wish_wrapper_end', 10);



//start the woocommerce wrapper

function wish_wrapper_start() {

  echo '<div class="shop-main"><section class="woo-shop"><div class="container shop-products">';

}





//end the woocommmerce wrapper

function wish_wrapper_end() {

  echo '</div></section></div>';

}











//the css compiler
function wish_compile_css($css) {

      $filename = get_template_directory() . '/css/compile.css';
      global $wp_filesystem;

      if( empty( $wp_filesystem ) ) {
        require_once( ABSPATH .'/wp-admin/includes/file.php' );
        WP_Filesystem();
      }

      if( $wp_filesystem ) {

        $wp_filesystem->put_contents(
            $filename,
            $css,
            FS_CHMOD_FILE // predefined mode settings for WP files
        );

      }
}//end of function

//the css compiler
function wish_compile_menu_css($css){

      $filename = get_template_directory() . '/css/menu_compiled.css';
      global $wp_filesystem;

      if( empty( $wp_filesystem ) ) {
        require_once( ABSPATH .'/wp-admin/includes/file.php' );
        WP_Filesystem();
      }

      if( $wp_filesystem ) {

        $wp_filesystem->put_contents(
            $filename,
            $css,
            FS_CHMOD_FILE // predefined mode settings for WP files
        );

      }
}//end of function


//wish_compile fixed menu
function wish_compile_menu_css_fixed($css){

      $filename = get_template_directory() . '/css/menu_compiled_fixed.css';
      global $wp_filesystem;

      if( empty( $wp_filesystem ) ) {
        require_once( ABSPATH .'/wp-admin/includes/file.php' );
        WP_Filesystem();
      }

      if( $wp_filesystem ) {

        $wp_filesystem->put_contents(
            $filename,
            $css,
            FS_CHMOD_FILE // predefined mode settings for WP files
        );

      }
}//end of function









// footer text quick codes

function wish_footer_shortcodes($string){



    $string = str_replace("[current-year]", date("Y") , $string );

    $string = str_replace("[site-tagline]", get_bloginfo ( 'description' ), $string);

    $string = str_replace("[site-title]", get_bloginfo('name'), $string);

    $string = str_replace("[logout-url]", esc_url( wp_logout_url() ), $string);

    $string = str_replace("[login-url]", esc_url( wp_login_url() ), $string);

    $string = str_replace("[site-url]", esc_url( get_site_url() ), $string);



    return $string;



}













//helper functions

function wish_line2fontawesome($title){

		//<i class="fa fa-envelope"></i>

     $title1 = preg_replace("/\|(.+?)\|/", '<i class="fa $1"></i>', $title);

     return $title1;



}



function wish_brackets2span($string){

		//<i class="fa fa-envelope"></i>

     $string = str_replace("[section]", "<span>" , $string );

     $string = str_replace("[/section]", "</span>" , $string );

     return $string;



}









function wish_post_classes( $classes ) {

    $class_key = array_search( 'container', $classes );

 

    if ( false !== $class_key ) {

        unset( $classes[ $class_key ] );

    }

 

    return $classes;

}

add_filter( 'post_class', 'wish_post_classes' );







// filter html

function wish_filter_html($html){

    return $html;

}





//Build styles for visual composer vc_templates

function wish_buildStyle( $bg_image = '', $bg_color = '', $bg_image_repeat = '', $font_color = '', $padding = '', $margin_bottom = '' ) {

        $has_image = false;

        $style = '';

        if ( (int) $bg_image > 0 && ( $image_url = wp_get_attachment_url( $bg_image, 'large' ) ) !== false ) {

            $has_image = true;

            $style .= "background-image: url(" . esc_url($image_url) . ");";

        }

        if ( ! empty( $bg_color ) ) {

            $style .= vc_get_css_color( 'background-color', $bg_color );

        }

        if ( ! empty( $bg_image_repeat ) && $has_image ) {

            if ( 'cover' === $bg_image_repeat ) {

                $style .= "background-repeat:no-repeat;background-size: cover;";

            } elseif ( 'contain' === $bg_image_repeat ) {

                $style .= "background-repeat:no-repeat;background-size: contain;";

            } elseif ( 'no-repeat' === $bg_image_repeat ) {

                $style .= 'background-repeat: no-repeat;';

            }

        }

        if ( ! empty( $font_color ) ) {

            $style .= vc_get_css_color( 'color', $font_color ); // 'color: '.$font_color.';';

        }

        if ( $padding != '' ) {

            $style .= 'padding: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $padding ) ? $padding : $padding . 'px' ) . ';';

        }

        if ( $margin_bottom != '' ) {

            $style .= 'margin-bottom: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $margin_bottom ) ? $margin_bottom : $margin_bottom . 'px' ) . ';';

        }



        return empty( $style ) ? '' : ' style="' . esc_attr( $style ) . '"';

}















//redux save callback, compiles css and stuff

add_action('redux/options/redux_wish/saved', 'wish_redux_save', 10, 2);



function wish_redux_save($data, $changed_values) {

    global $redux_wish;

    // $auto_compile = $redux_wish["wish-trouble-auto-compile"];

    $auto_compile = false;

    //check if the user has set auto compile or redux save compile

    if(!$auto_compile){

        $orane_css_compile = "";

        require get_template_directory() . '/css_compile.php';

        require get_template_directory() . '/css_head_compile.php';

    }



}





//redirect for underconstruction mode

function wish_template_redirect()

{



        global $redux_wish;

        global $post;

        $wish_underconstruct_page = isset($redux_wish['wish-underconstruct-page']) ? $redux_wish['wish-underconstruct-page'] : "" ;

        $wish_underconstruct_enabled = isset($redux_wish['wish-underconstruction-enable']) ? $redux_wish['wish-underconstruction-enable'] : false;

        $wish_underconstruct_date = isset($redux_wish['wish-underconstruct-date']) ? $redux_wish['wish-underconstruct-date'] : "";



        $temp_date = explode("/",$wish_underconstruct_date);

        $temp_month = isset($temp_date[0]) ? $temp_date[0] : 0;

        $temp_day = isset($temp_date[1]) ? $temp_date[1] : 0;

        $temp_year = isset($temp_date[2]) ? $temp_date[2] : 0;



        $date_array = array(

            'temp_month' => $temp_month,

            'temp_day' => $temp_day,

            'temp_year' => $temp_year,

        );



        



        if(preg_match("/login|admin|dashboard|account/i",$_SERVER['REQUEST_URI']) > 0){

            return false;

        }







        if( ! is_user_logged_in() && $wish_underconstruct_enabled )

        {

            if($post->ID != $wish_underconstruct_page){

                wp_redirect( get_permalink($wish_underconstruct_page) );

                exit();

            }

            wp_register_script( 'wish-countdown', get_template_directory_uri() . '/js/jquery.countdown.min.js', array( 'jquery' ), '', 2 );

            wp_localize_script( 'wish-countdown', 'object_date', $date_array );

            wp_enqueue_script( 'wish-countdown');

        }







}

add_action( 'template_redirect', 'wish_template_redirect' );













//theme hooks

require get_template_directory() . '/inc/theme_hooks.php';



// theme update service

require get_template_directory() . '/inc/theme-update-checker.php';



$WishUpdateChecker = new ThemeUpdateChecker(

                            'wish',

                            'http://redhawk-studio.com/themes/updates/wish-metadata.json'

                            );

							////////////////////////////////////////////// posts carousal ajax

add_action('init','wish_ajax_return_200');



//molvi update



	function wish_ajax_return_200(){

		

		if(isset($_POST['action']) && esc_attr($_POST['action'])==200){

			

			 

$args = array( 'numberposts' => sanitize_text_field($_POST['amount_posts']), 'post_type' => 'post', 'suppress_filters' => false );

$myposts = get_posts( $args );

$numItems3 = count($myposts);

$last_index = $numItems3 - 1;

$pre_post = '';

$pre_ID = '';

$pre_Link = '';

$Next_Link = '';

$next_post = '';

$i=0;

$s = '';

//print_r($myposts);

foreach( $myposts as $key => $post ) :	setup_postdata($post);    ?>

<?php 

if($_POST['postID']==$post->ID){

	if($key >= 1) { $pre_post = $key - 1; 

	$pre_ID = $myposts[$pre_post]->ID;

	}

	$lastPropertyId = '';

	if(sanitize_text_field($_POST['postID'])==$post->ID && (sanitize_text_field($_POST['postID'])!=$myposts[$last_index]->ID)){

		$next_post = $key + 1;

		$next_ID = $myposts[$next_post]->ID;

		}

		

		break;

		

}

?>

<?php endforeach; ?>



				<?php wp_reset_postdata(); ?>

			<?php

if(!empty($pre_ID)){ $pre_Link = '<a access="'.sanitize_text_field($_POST['amount_posts']).'" href="#" class="pull-left prevPost" alt="'.$pre_ID.'">' . esc_html__('Previous Post', 'wish') . '</a>'; }

if(!empty($next_ID)){ $Next_Link = '<a access="'.sanitize_text_field($_POST['amount_posts']).'" href="#" class="pull-right nextPost" alt="'.$next_ID.'">' . esc_html__('Next Post', 'wish') . '</a>'; }

		

			$post_7 = get_post(sanitize_text_field($_POST['postID']));

			$post_date = 'NEWS / '.date("d.m.y", strtotime($post_7->post_date));

			$mInfo1 = '<div class="col-md-12 inv_desc">';

            $mInfo1.='<p class="news_date">'.$post_date.'</p>

			

			<h6>'.$post_7->post_title.'</h6>

           <p class="newsCont mCustomScrollbar">'.get_the_post_thumbnail( sanitize_text_field( $_POST['postID'] ), 'medium',array('class' => 'post_carousal_thumb') ).$post_7->post_content.'</p>

			

			<p>'.$pre_Link.$Next_Link.'</p></div>';

			echo wish_filter_html($mInfo1);

			

	exit;

			}

		}

	///////////////////////////////////////// ajax 201

	add_action('init','wish_ajax_return_201');

	



	function wish_ajax_return_201(){

		

		if(isset($_POST['action']) && $_POST['action']==201){

			

			 

$args = array( 'numberposts' => sanitize_text_field($_POST['amount_posts']), 'post_type' => 'post', 'suppress_filters' => false );

$myposts = get_posts( $args );

$pre_post = '';

$pre_ID = '';

$pre_Link = '';

$Next_Link = '';

$next_ID = '';

$i=0;

$s = '';

foreach( $myposts as $key => $post ) :	setup_postdata($post); $numItems3 = count($myposts);   ?>

<?php 

if($_POST['postID']==$post->ID){

	if($key >= 1) { $pre_post = $key - 1; 

	$pre_ID = $myposts[$pre_post]->ID;

	}

	if($_POST['postID']==$post->ID && (++$i != $numItems3)){

		$next_post = $key + 1;

		$next_ID = $myposts[$next_post]->ID;

		}

		

		break;

		

}

?>

<?php endforeach; ?>



				<?php wp_reset_postdata(); ?>

			<?php

			

$thumb_id = get_post_thumbnail_id(sanitize_text_field($_POST['postID']));

$thumb_detail = wp_get_attachment_image_src($thumb_id, array(200,300));

if(!empty($pre_ID)){ $pre_Link = '<a access="'.sanitize_text_field($_POST['amount_posts']).'" href="#" class="pull-left prevPost" alt="'.$pre_ID.'">' . esc_html__('Previous Post', 'wish') . '</a>'; }

if(!empty($next_ID)){ $Next_Link = '<a access="'.sanitize_text_field($_POST['amount_posts']).'" href="#" class="pull-right nextPost" alt="'.$next_ID.'">' . esc_html__('Next Post', 'wish') . '</a>'; }

		

			$post_7 = get_post(sanitize_text_field($_POST['postID']));

			$post_date = 'NEWS / '.date("d.m.y", strtotime($post_7->post_date));

			$mInfo1 = '<div class="col-md-12 inv_desc">';

            $mInfo1.='<p class="news_date">'.$post_date.'</p>

			

			<h6>'.$post_7->post_title.'</h6>

           <p class="newsCont mCustomScrollbar">'.get_the_post_thumbnail( sanitize_text_field($_POST['postID']), 'medium', array('class' => 'post_carousal_thumb') ).$post_7->post_content.'</p>

			

			<p>'.$pre_Link.$Next_Link.'</p></div>';

			echo wish_filter_html($mInfo1);

			

	exit;

			}

		}

	

	////////////////////////////////////////////////////// end of ajax 201

if(isset($_POST['newstitle'])){

$preLink ='';

$NextLink = '';

if(!empty($_POST['prev_post'])){ $preLink = '<a access="'.sanitize_text_field($_POST['amount_posts']).'" href="'.esc_url($_POST['prev_post']).'" class="pull-left prevPost" alt="'.sanitize_text_field($_POST['prev_postid']).'">' . esc_html__('Previous Post', 'wish') . '</a>'; }

if(!empty($_POST['next_post'])){ $NextLink = '<a access="'.sanitize_text_field($_POST['amount_posts']).'" href="'.esc_url($_POST['next_post']).'" class="pull-right nextPost" alt="'.sanitize_text_field($_POST['next_postid']).'">' . esc_html__('Next Post', 'wish') . '</a>'; }

$post_7 = get_post(sanitize_text_field($_POST['thumb']));



	$mInfo = '<div class="col-md-12 inv_desc">';

            $mInfo.='<p class="news_date">'.sanitize_text_field($_POST['date']).'</p>

			

			<h6>'.$post_7->post_title.'</h6>

           <p class="newsCont mCustomScrollbar">'.get_the_post_thumbnail( sanitize_text_field( $_POST['thumb'] ), 'medium', array('class' => 'post_carousal_thumb') ).$post_7->post_content.'</p>

			

			<p>'.$preLink.$NextLink.'</p></div>';

			echo wish_filter_html($mInfo);

	exit;

	}	













//conditional enqueue scripts functions

function wish_parallax_enqueue(){

    wp_enqueue_script( 'jquery.parallax-1.1.3.min', get_template_directory_uri() . '/js/parallax/jquery.parallax-1.1.3.js', array( 'jquery' ), '1.1.3', 1 );

    wp_enqueue_script( 'jquery.localscroll-1.2.7-min', get_template_directory_uri() . '/js/parallax/jquery.localscroll-1.2.7-min.js', array( 'jquery' ), '1.2.7', 3 );

    wp_enqueue_script( 'jquery.scrollTo-1.4.2-min', get_template_directory_uri() . '/js/parallax/jquery.scrollTo-1.4.2-min.js', array( 'jquery' ), '1.4.2', 3 );



}









//return redux global variable

function wish_redux(){

    global $redux_wish;

    return $redux_wish;

}







//enqueue footer 1 scripts

function wish_enq_footer1(){

    wp_enqueue_script( 'wish-magnific-popup', get_template_directory_uri() . '/js/magnific-popup/jquery.magnific-popup.min.js', array( 'jquery' ), '0.9.9', 3 );

}





//WordPress preview customizer scripts

function wish_customize_preview_js() {

    wp_enqueue_script( 'wish_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );

}





//enqueue Visual Composer front-end js

function wish_enq_vc_row(){

    wp_enqueue_script( 'wpb_composer_front_js' );

}







//kses helper functions (a tags only)

function wish_kses_a(){

    $return = array(

                    'a' => array(

                        'href' => array(),

                        'title' => array(),

                        'alt' => array(),

                    ),

                );



    return $return;



}



//kses common html

function wish_kses_common(){



    $allowed_html = array(

        'a' => array(

            'href' => array (),

            'title' => array ()),

        'abbr' => array(

            'title' => array ()),

        'acronym' => array(

            'title' => array ()),

        'b' => array(),

        'blockquote' => array(

            'cite' => array ()),

        'cite' => array (),

        'code' => array(),

        'del' => array(

            'datetime' => array ()),

        'em' => array (), 'i' => array (),

        'q' => array(

            'cite' => array ()),

        'strike' => array(),

        'strong' => array(),

    );



    return $allowed_html;



}