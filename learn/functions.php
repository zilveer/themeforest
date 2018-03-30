<?php

//Custom fields:

if (!defined('LEARN_OPTIONS_DIR')) {
 define('LEARN_OPTIONS_DIR', get_template_directory());
}
if (!defined('LEARN_OPTIONS_URL')) {
 define('LEARN_OPTIONS_URL', get_template_directory_uri());
}
require_once get_template_directory() . '/framework/meta-boxes.php';
require_once get_template_directory() . '/shortcodes.php';
require_once get_template_directory() . '/framework/theme-options.php';
require_once get_template_directory() . '/framework/widget/recent-posts.php';
require_once get_template_directory() . '/framework/sensei.php';
require_once get_template_directory() . '/framework/theme-options/framework.php';
require_once get_template_directory() . '/framework/wp_bootstrap_navwalker.php';

if( is_admin() ) {
 
 require get_template_directory() . '/framework/nav-menus.php';

 } else {
 // Frontend functions and shortcodes
 require get_template_directory() . '/framework/menu-walker.php'; 
}

//Theme Set up:
function learn_theme_setup() {

   /*

     * Make theme available for translation.

     * Translations can be filed in the /languages/ directory.

     * If you're building a theme based on cubic, use a find and replace

     * to change 'cubic' to the name of your theme in all the template files

     */

    load_theme_textdomain( 'learn', get_template_directory() . '/languages' );

    /** Set Content width **/
    if ( ! isset( $content_width ) ) 
        $content_width = 900;
    /*
     * This theme uses a custom image size for featured images, displayed on
     * "standard" posts and pages.
     */
	  add_theme_support( 'custom-header' ); 
	  add_theme_support( 'custom-background' );
	
    add_theme_support( 'post-thumbnails' );
    // Adds RSS feed links to <head> for posts and comments.
    add_theme_support( 'automatic-feed-links' );
    // Switches default core markup for search form, comment form, and comments
    // to output valid HTML5.
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
    //Post formats
    add_theme_support( 'post-formats', array(
        'audio',  'gallery', 'image', 'video',
    ) );

    //Tags
    add_theme_support( 'title-tag' );

    // This theme uses wp_nav_menu() in one location.
  	register_nav_menus( array(
      'primary'   => esc_html__('Primary Menu', 'learn')
  	) );

    if( is_admin()  ) {
      new learn_Walker_Nav_Menu_Custom_Fields;
    }
}
add_action( 'after_setup_theme', 'learn_theme_setup' );

function learn_load_custom_wp_admin_style() {
        wp_register_style( 'custom_wp_admin_css', get_template_directory_uri() . '/framework/admin-style.css', false, '1.0.0' );
        wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'learn_load_custom_wp_admin_style' );


//disable WordPress sanitization to allow more than just $allowedtags from /wp-includes/kses.php
remove_filter('pre_user_description', 'wp_filter_kses');
//add sanitization for WordPress posts
add_filter( 'pre_user_description', 'wp_filter_post_kses');

/*Register Fonts*/
function learn_theme_fonts_url() {
    $fonts_url = '';
    
    $lato = _x( 'on', 'Lato font: on or off', 'learn' );
    $open_sans = _x( 'on', 'Open Sans font: on or off', 'learn' );
    $mon = _x( 'on', 'Montserrat font: on or off', 'learn' );
    $ral = _x( 'on', 'Raleway font: on or off', 'learn' );
    $ind = _x( 'on', 'Indie Flower font: on or off', 'learn' );

    if ( 'off' !== $mon || 'off' !== $open_sans || 'off' !== $lato  || 'off' !== $ral  || 'off' !== $ind ) {
        $font_families = array();
 
        if ( 'off' !== $lato ) {
            $font_families[] = 'Lato:300,400,700,900';
        }
        if ( 'off' !== $open_sans ) {
            $font_families[] = 'Open Sans:300,400,600,700,800';
        }
        if ( 'off' !== $ral ) {
            $font_families[] = 'Raleway:400,500,600,700,800';
        }
        if ( 'off' !== $ind ) {
            $font_families[] = 'Indie Flower';
        }
        if ( 'off' !== $mon ) {
            $font_families[] = 'Montserrat:400,700';
        }
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }
 
    return esc_url_raw( $fonts_url );

}
/*
Enqueue scripts and styles.
*/
function learn_theme_scripts() {
    wp_enqueue_style( 'learn-fonts', learn_theme_fonts_url(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'learn_theme_scripts' );

function learn_theme_scripts_styles() {

	$protocol = is_ssl() ? 'https' : 'http';

    /** All frontend css files **/
    wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/css/bootstrap.css');
    wp_enqueue_style( 'superfish', get_template_directory_uri().'/css/superfish.css');
    wp_enqueue_style( 'owlcarousel', get_template_directory_uri().'/css/owl.carousel.css');
    wp_enqueue_style( 'fancybox', get_template_directory_uri().'/js/fancybox/source/jquery.fancybox.css');
    wp_enqueue_style( 'fontello', get_template_directory_uri().'/fontello/css/fontello.css');
	  wp_enqueue_style( 'fontawesome', get_template_directory_uri().'/css/font-awesome.min.css');
    wp_enqueue_style( 'learn-woocommerce', get_template_directory_uri().'/css/woocommerce.css');
    wp_enqueue_style( 'learn-singlecourse', get_template_directory_uri().'/css/single_course.css');
	  wp_enqueue_style( 'learn-style', get_stylesheet_uri(), array(), '21-05-2015' );
    if(learn_theme_option('color_scheme2')){
      wp_enqueue_style( 'learn-color2', get_template_directory_uri().'/css/color2.css');
    }
		
    /** Js for comment on single post **/    
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ){
    	wp_enqueue_script( 'comment-reply' );
	}

  // Load custom color scheme file
  $color_1 = learn_theme_option('custom_color_1');
  $color_2 = learn_theme_option('custom_color_2');
  if ( intval( learn_theme_option( 'custom_color_scheme' ) ) && ($color_1  || $color_2) ) {

      $upload_dir = wp_upload_dir();
      $dir        = path_join( $upload_dir['baseurl'], 'custom-css' );
      $file       = $dir . '/color-scheme.css';
      wp_enqueue_style( 'learn-color-scheme', $file, 1.0 );
  }

    /** All frontend js files **/
  wp_enqueue_script("googlemaps", "$protocol://maps.googleapis.com/maps/api/js?v=3.exp&hl=en&sensor=true",array('jquery'),false,true);
  wp_enqueue_script("bootstrap", get_template_directory_uri()."/js/bootstrap.min.js",array('jquery'),false,true);
  wp_enqueue_script("superfish", get_template_directory_uri()."/js/superfish.js",array('jquery'),false,true);
  wp_enqueue_script("fitvids", get_template_directory_uri()."/js/jquery.fitvids.js",array('jquery'),false,true);
	wp_enqueue_script("owlcarousel", get_template_directory_uri()."/js/owl.carousel.min.js",array('jquery'),false,false);
  wp_enqueue_script("retina", get_template_directory_uri()."/js/retina.min.js",array('jquery'),false,true);
	wp_enqueue_script("placeholder", get_template_directory_uri()."/js/jquery.placeholder.js",array('jquery'),false,true);
	wp_enqueue_script("classie", get_template_directory_uri()."/js/classie.js",array('jquery'),false,true);
  wp_enqueue_script("fancybox", get_template_directory_uri()."/js/fancybox/source/jquery.fancybox.pack.js",array('jquery'),false,true);
  wp_enqueue_script("fancyboxhp", get_template_directory_uri()."/js/fancybox/source/helpers/jquery.fancybox-media.js",array('jquery'),false,true);
  wp_enqueue_script("learn-fancy-func", get_template_directory_uri()."/js/fancy_func.js",array('jquery'),false,true);
	wp_enqueue_script("learn-custom", get_template_directory_uri()."/js/custom.js",array('jquery'),false,true);
}
add_action( 'wp_enqueue_scripts', 'learn_theme_scripts_styles');

if(!function_exists('learn_custom_frontend_style')){
	function learn_custom_frontend_style(){
    $background = learn_theme_option( "bg_head" );
    $bg_footer = '';
    $bread = '';
    $bg_top = '';
    $bg_boxed = '';
    $bg_nav = '';
    $bg_copyr = '';
    $color_menu = '';
    $bg_css = ! empty( $background['color'] ) ? "{$background['color']}" : '';

  if ( ! empty( $background['image'] ) ) {
   $bg_css .= " url({$background['image']})";
   $bg_css .= " {$background['repeat']}";
   $bg_css .= " {$background['position_x']} {$background['position_y']}";
   $bg_css .= " {$background['attachment']}";
   $bg_css .= ! empty( $background['size'] ) ? " {$background['size']}" : '';
  }
 
  if( ! empty($bg_css)){
    $bg_css = '#sub-header{background:'.$bg_css.'}';
  }
  if(learn_theme_option( 'bg_footer' )){
    $bg_footer = 'footer{background:'.learn_theme_option( 'bg_footer' ).'}';
  }
  if( !learn_theme_option( 'breadcrumb' )){
    $bread = '.breadcrumb li{display: none;} .breadcrumb{margin-top: 0;} #main_content{padding-top: 30px;}';
  }
  if( learn_theme_option( 'bg_top' )){
    $bg_top = 'header.top-header{background: '.learn_theme_option( 'bg_top' ).'; border: none;}';
  }
  if( learn_theme_option( 'bg_boxed' )){
    $bg_boxed = 'body.boxed{background: '.learn_theme_option( 'bg_boxed' ).';}';
  }
  if( learn_theme_option( 'bg_nav' )){
    $bg_nav = 'nav.top-menu, .sf-menu ul li a, ul.sf-menu .mega-menu-container{background: '.learn_theme_option( 'bg_nav' ).'; } .sf-menu li:hover, .sf-menu li.sfHover, .current-menu-item{ background: none; }';
  }
  if( learn_theme_option( 'color_menu' )){
    $color_menu = 'ul.sf-menu li a{color: '.learn_theme_option( 'color_menu' ).'}';
  }
  if( learn_theme_option( 'bg_copyr' )){
    $bg_copyr = '#copy_right{background: '.learn_theme_option( 'bg_copyr' ).'}';
  }
  $bg_css .= learn_theme_option('custom_css');
  $bg_css .= $bg_top;
  $bg_css .= $bg_boxed;
  $bg_css .= $bg_nav;
  $bg_css .= $color_menu;
  $bg_css .= $bg_footer;
  $bg_css .= $bg_copyr;
  $bg_css .= $bread;

  if(! empty($bg_css)){
	echo '<style type="text/css">'.$bg_css.'</style>';
    }
}
}

add_action('wp_head', 'learn_custom_frontend_style');


// Widget Sidebar
function learn_widgets_init() {
	register_sidebar( array(
    'name'          => esc_html__( 'Primary Sidebar', 'learn' ),
    'id'            => 'sidebar-1',        
		'description'   => esc_html__( 'Appears in the sidebar section of the site.', 'learn' ),        
		'before_widget' => '<div id="%1$s" class="widget %2$s">',        
		'after_widget'  => '</div>',        
		'before_title'  => '<h4 class="widget_title">',        
		'after_title'   => '</h4>'
    ) );
  register_sidebar( array(
    'name'          => esc_html__( 'Course Sidebar', 'learn' ),
    'id'            => 'sidebar-course',        
    'description'   => esc_html__( 'Appears in the sidebar section of the courses.', 'learn' ),        
    'before_widget' => '<div id="%1$s" class="widget %2$s">',        
    'after_widget'  => '</div>',        
    'before_title'  => '<h4 class="widget_title">',        
    'after_title'   => '</h4>'
    ) );
  register_sidebar( array(
    'name'          => esc_html__( 'Lesson Widget', 'learn' ),
    'id'            => 'lesson-widget',        
    'description'   => esc_html__( 'Appears in the sidebar section of the courses.', 'learn' ),        
    'before_widget' => '<div id="%1$s" class="widget %2$s">',        
    'after_widget'  => '</div>',        
    'before_title'  => '<h4 class="widget_title">',        
    'after_title'   => '</h4>'
    ) );
  register_sidebar( array(
		'name'          => esc_html__( 'Footer One Widget Area', 'learn' ),
		'id'            => 'footer-area-1',
		'description'   => esc_html__( 'Footer Widget that appears on the Footer.', 'learn' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Two Widget Area', 'learn' ),
		'id'            => 'footer-area-2',
		'description'   => esc_html__( 'Footer Widget that appears on the Footer.', 'learn' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Three Widget Area', 'learn' ),
		'id'            => 'footer-area-3',
		'description'   => esc_html__( 'Footer Widget that appears on the Footer.', 'learn' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Fourth Widget Area', 'learn' ),
		'id'            => 'footer-area-4',
		'description'   => esc_html__( 'Footer Widget that appears on the Footer.', 'learn' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
	) );    
 
}
add_action( 'widgets_init', 'learn_widgets_init' );

//Socials footer
function learn_socials() {
 $output  = array();
 $socials = array_filter( (array) learn_theme_option( 'socials' ) );
 
 if ( empty( $socials ) ) {
  return;
 }

 foreach ( (array) $socials as $name => $value ) {
  $display = $name;

  if ( $name == 'google' ) {
   $display = 'googleplus';
   $name    = 'google+';
  }

  if ( $name == 'mail' ) {
   $value   = 'mailto:' . esc_attr( $value );
  } else {
   $value = esc_url( $value );
  }

  $output[] = sprintf(
   '<li class="%s"><a href="%s" class="bb-%s" target="_blank">%s</a></li>',
   $display,
   $value,
   esc_attr( $name ),
   esc_attr( $name ),
   $display
  );
 }

 if ( $output ) {
  echo implode( "\n\t", $output );
 }
}

//Get search courses
function learn_template_chooser_course($template)   
{    
  global $wp_query;   
  $post_type = get_query_var('post_type');   
  if( $wp_query->is_search && $post_type == 'course' )   
  {
    return locate_template('course-search.php');  //  redirect to archive-search.php
  }   
  return $template;   
}
add_filter('template_include', 'learn_template_chooser_course');

/*Add extra fields for user*/
add_action( 'show_user_profile', 'learn_add_extra_social_links' );
add_action( 'edit_user_profile', 'learn_add_extra_social_links' );

function learn_add_extra_social_links( $user )
{
    ?>
        <h3><?php esc_html_e('Extra Info User', 'learn'); ?></h3>

        <table class="form-table">
            <tr>
                <th><label for="phone_profile"><?php esc_html_e('Phone Number', 'learn'); ?></label></th>
                <td><input type="text" name="phone_profile" value="<?php echo esc_attr(get_the_author_meta( 'phone_profile', $user->ID )); ?>" class="regular-text" /></td>
            </tr>
            <tr>
                <th><label for="facebook_profile"><?php esc_html_e('Facebook', 'learn'); ?></label></th>
                <td><input type="text" name="facebook_profile" value="<?php echo esc_attr(get_the_author_meta( 'facebook_profile', $user->ID )); ?>" class="regular-text" /></td>
            </tr>

            <tr>
                <th><label for="twitter_profile"><?php esc_html_e('Twitter', 'learn'); ?></label></th>
                <td><input type="text" name="twitter_profile" value="<?php echo esc_attr(get_the_author_meta( 'twitter_profile', $user->ID )); ?>" class="regular-text" /></td>
            </tr>

            <tr>
                <th><label for="google_profile"><?php esc_html_e('Google+', 'learn'); ?></label></th>
                <td><input type="text" name="google_profile" value="<?php echo esc_attr(get_the_author_meta( 'google_profile', $user->ID )); ?>" class="regular-text" /></td>
            </tr>
        </table>
    <?php
}

add_action( 'personal_options_update', 'learn_save_extra_social_links' );
add_action( 'edit_user_profile_update', 'learn_save_extra_social_links' );

function learn_save_extra_social_links( $user_id )
{
    update_user_meta( $user_id,'phone_profile', sanitize_text_field( $_POST['phone_profile'] ) );
    update_user_meta( $user_id,'facebook_profile', sanitize_text_field( $_POST['facebook_profile'] ) );
    update_user_meta( $user_id,'twitter_profile', sanitize_text_field( $_POST['twitter_profile'] ) );
    update_user_meta( $user_id,'google_profile', sanitize_text_field( $_POST['google_profile'] ) );
}


/** Custom theme option post excerpt **/
function learn_excerpt() {

  if(learn_theme_option('excerpt_length')){
    $limit = learn_theme_option('excerpt_length');
  }else{
    $limit = 15;
  }
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}

/** Excerpt Section Blog Post **/
function learn_blog_excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}

/*Limit Archive Page*/
function learn_limit_posts_per_archive_page() {
  if ( is_archive() ){
    set_query_var('posts_per_archive_page', 20); // or use variable key: posts_per_page
  }
}
add_filter('pre_get_posts', 'learn_limit_posts_per_archive_page');

/*Breadcrumbs*/
function learn_breadcrumbs() {
    $text['home']     = esc_html__('Home', 'learn'); // text for the 'Home' link
    $text['category'] = '%s'; // text for a category page
    $text['tax']      = '%s'; // text for a taxonomy page
    $text['search']   = '%s'; // text for a search results page
    $text['tag']      = '%s'; // text for a tag page
    $text['author']   = '%s'; // text for an author page
    $text['404']      = '404'; // text for the 404 page
 
    $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $showOnHome  = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $delimiter   = ''; // delimiter between crumbs
    $before      = '<li class="active">'; // tag before the current crumb
    $after       = '</li>'; // tag after the current crumb
    
 
    global $post;
    $homeLink = home_url('/') . '';
    $linkBefore = '<li>';
    $linkAfter = '</li>';
    $linkAttr = ' rel="v:url" property="v:title"';
    $link = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;
 
    if (is_home() || is_front_page()) {
 
        if ($showOnHome == 1) echo '<div id="crumbs"><a href="' . esc_url($homeLink) . '">' . $text['home'] . '</a></div>';
 
    } else {
 
        echo '<ol class="breadcrumb">' . sprintf($link, esc_url($homeLink), $text['home']) . $delimiter;
 
        
        if ( is_category() ) {
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0) {
                $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
                $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                echo htmlspecialchars_decode( $cats );
            }
            echo htmlspecialchars_decode( $before ) . sprintf($text['category'], single_cat_title('', false)) . htmlspecialchars_decode( $after );
 
        } elseif( is_tax() ){
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0) {
                $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
                $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                echo htmlspecialchars_decode( $cats );
            }
            echo htmlspecialchars_decode( $before ) . sprintf($text['tax'], single_cat_title('', false)) . htmlspecialchars_decode( $after );
        
        }elseif ( is_search() ) {
            echo htmlspecialchars_decode( $before ) . sprintf($text['search'], get_search_query()) . htmlspecialchars_decode( $after );
 
        } elseif ( is_day() ) {
            echo sprintf($link, esc_url(get_year_link(get_the_time('Y'))), get_the_time('Y')) . $delimiter;
            echo sprintf($link, esc_url(get_month_link(get_the_time('Y'),get_the_time('m'))), get_the_time('F')) . $delimiter;
            echo htmlspecialchars_decode( $before ) . get_the_time('d') . htmlspecialchars_decode( $after );
 
        } elseif ( is_month() ) {
            echo sprintf($link, esc_url(get_year_link(get_the_time('Y'))), get_the_time('Y')) . $delimiter;
            echo htmlspecialchars_decode( $before ) . get_the_time('F') . htmlspecialchars_decode( $after );
 
        } elseif ( is_year() ) {
            echo htmlspecialchars_decode( $before ) . get_the_time('Y') . htmlspecialchars_decode( $after );
 
        } elseif ( is_single() && !is_attachment() ) {
            if ( get_post_type() != 'post' ) {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                if ( get_post_type() == 'course' || get_post_type() == 'lesson' ) {
                 printf(''); //Translate breadcrumb.
             }else{
              printf($link, esc_url($homeLink) . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
             }
                if ($showCurrent == 1) echo htmlspecialchars_decode( $delimiter ) . $before . get_the_title() . $after;
            } else {
                $cat = get_the_category(); $cat = $cat[0];
                $cats = get_category_parents($cat, TRUE, $delimiter);
                if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                echo htmlspecialchars_decode( $cats );
                if ($showCurrent == 1) echo htmlspecialchars_decode( $before ) . get_the_title() . $after;
            }
 
        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
            $post_type = get_post_type_object(get_post_type());
            echo htmlspecialchars_decode( $before ) . $post_type->labels->singular_name . htmlspecialchars_decode( $after );
 
        } elseif ( is_attachment() ) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID); $cat = $cat[0];
            $cats = get_category_parents($cat, TRUE, $delimiter);
            $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
            $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
            echo htmlspecialchars_decode( $cats );
            printf($link, esc_url(get_permalink($parent)), $parent->post_title);
            if ($showCurrent == 1) echo htmlspecialchars_decode( $delimiter ) . $before . get_the_title() . $after;
 
        } elseif ( is_page() && !$post->post_parent ) {
            if ($showCurrent == 1) echo htmlspecialchars_decode( $before ) . get_the_title() . $after;
 
        } elseif ( is_page() && $post->post_parent ) {
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = sprintf($link, esc_url(get_permalink($page->ID)), get_the_title($page->ID));
                $parent_id  = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            for ($i = 0; $i < count($breadcrumbs); $i++) {
                echo htmlspecialchars_decode( $breadcrumbs[$i] );
                if ($i != count($breadcrumbs)-1) echo htmlspecialchars_decode( $delimiter );
            }
            if ($showCurrent == 1) echo htmlspecialchars_decode( $delimiter ) . $before . get_the_title() . $after;
 
        } elseif ( is_tag() ) {
            echo htmlspecialchars_decode( $before ) . sprintf($text['tag'], single_tag_title('', false)) . $after;
 
        } elseif ( is_author() ) {
             global $author;
            $userdata = get_userdata($author);
            echo htmlspecialchars_decode( $before ) . sprintf($text['author'], $userdata->display_name) . $after;
 
        } elseif ( is_404() ) {
            echo htmlspecialchars_decode( $before ) . $text['404'] . $after;
        }
 
        if ( get_query_var('paged') ) {
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() );
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() );
        }
 
        echo '</ol>';
 
    }
}

//pagination
function learn_pagination($prev = '<i class="fa fa-angle-double-left"></i>', $next = '<i class="fa fa-angle-double-right"></i>', $pages='') {
    global $wp_query, $wp_rewrite;
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    if($pages==''){
        global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
    }
    $pagination = array(
      'base'      => str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
      'format'    => '',
      'current'   => max( 1, get_query_var('paged') ),
      'total'     => $pages,		
      'type'      => 'list',
      'prev_text' => $prev,
      'next_text' => $next,
      'end_size'  => 3,
      'mid_size'  => 3
    );
    $return =  paginate_links( $pagination );
	echo str_replace( "<ul class='page-numbers'>", '', $return );
}

//page header
function learn_page_header() {

    if( ! is_page_template( 'page-templates/template-fullwidth-not-header.php' ) ) {
    
      $bg = '';
      $sub = '';
      $des = '';
      $title = '';
      $output = array();

      if( is_page() || is_singular( 'product' )){

          $title = get_the_title();
          $sub = get_post_meta(get_the_ID(),'_cmb_page_sub', true);
          $des = get_post_meta(get_the_ID(),'_cmb_page_des', true);

          if ( function_exists('rwmb_meta') ) { 
              $images = rwmb_meta('_cmb_bg_header', "type=image" ); 
              $bg = $images ? $images[0]['full_url'] : ''; 
          }   
      } elseif( is_single() || is_home() || is_tag() || is_category() || is_search() || is_date() ) {
          $title = esc_html__('Learn Blog','learn');
      }elseif (is_author()) {

          if(is_author('admin')){

            $title = esc_html__('Learn Blog','learn');

          }else{

            $title = esc_html__('Teacher','learn');
            $sub = esc_html__('Ex utamur fierent tacimates duis choro an','learn');
            $des = esc_html__('Caulie dandelion maize lentil collard greens radish arugula sweet pepper water.','learn');
          }
      }elseif ( is_archive('course') ) {
          $title = single_cat_title( '', false );
          $sub = esc_html__('Ex utamur fierent tacimates duis choro an','learn');
          $des = esc_html__('Caulie dandelion maize lentil collard greens radish arugula sweet pepper water.','learn');
      }
      if( is_singular( 'tribe_events' )){
        $title = esc_html__('Event Details','learn');
      }
      if(is_post_type_archive('tribe_events')){
        $title = esc_html__('All Events', 'learn');
      }

      $sub = $sub ? $sub : learn_theme_option( "sub_head" );
      $des = $des ? $des : learn_theme_option( "des_head" );

      if( $title ) {
          $output[] = sprintf( '<h1>%s</h1>', $title );
      }

      if( $sub ) {
          $output[] = sprintf(  '<p class="lead boxed">%s</p>', $sub );
      }

       if( $des ) {
          $output[] = sprintf(  '<p class="lead">%s</p>', $des );
      }
      ?>
      <?php if( !is_singular( 'course' ) && !is_singular( 'lesson' ) && !is_singular( 'question' ) ) { ?>
      <section id="sub-header" <?php if($bg) { ?> style="background: url(<?php echo esc_url($bg); ?>) no-repeat center center;" <?php } ?>>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center">
                    <?php echo implode('', $output); ?>
                </div>
            </div><!-- End row -->
        </div><!-- End container -->
        <div class="divider_top"></div>
      </section><!-- End sub-header -->
      <?php }else{ 
        if( is_singular( 'lesson' ) || is_singular( 'question' ) ){ 
          echo ""; 
        }else{
          $content_post = get_post(get_the_ID());
          if( $content_post ) {
            echo do_shortcode( $content_post->post_content );
          }
        }
       }?>
  <?php
  }
}

add_action( 'learn_after_header', 'learn_page_header' );


/* Custom form search */
function learn_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" class="search-form input-group" action="' . home_url( '/' ) . '" >  
    	      <input class="form-control" type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="'.esc_html__('Search...', 'learn').'" />
            <span class="input-group-btn">
              <button class="btn btn-default" type="submit"><i class="icon-search"></i></button>
            </span>
            </form>';
    return $form;
}
add_filter( 'get_search_form', 'learn_search_form' );

/* Custom comment List: */
function learn_theme_comment($comment, $args, $depth) {    
   $GLOBALS['comment'] = $comment; 
   $rate               = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) ); ?>
    <li>
      <div class="comment-body" id="comment-<?php comment_ID(); ?>">

        <div><?php echo get_avatar($comment,$size='80',$default='http://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536' ); ?></div>
        <div class="comment_right clearfix">
          <div class="comment_info">
            <?php printf(esc_html__('%s','learn'), get_comment_author()) ?><span>|</span> <?php the_time( get_option( 'date_format' ) ); ?> <span>|</span><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
            <?php if ( is_singular( 'course' ) ) {  ?>
            <?php if($rate) { ?>
            <div class="rating">
              <?php
              for ( $i = 1; $i <= 5; $i ++ ) {
               if ( $i <= $rate ) {
                echo '<i class="fa fa-star"></i>';
               } else {
                echo '<i class="fa fa-star-o"></i>';
               }
              }
              ?>
            </div><!-- end rating -->
            <?php } } ?>
          </div>          
          <?php if ($comment->comment_approved == '0'){ ?>
              <p><em><?php esc_html_e('Your comment is awaiting moderation.','learn') ?></em></p>
          <?php }else{ ?>
              <?php comment_text() ?>
          <?php } ?>
        </div>
        
      </div>
    </li>
   
<?php
}

//Code Visual Compurso.
require_once get_template_directory() . '/vc_shortcode.php';

// Add new Param in Row
if(function_exists('vc_add_param')){

vc_add_param('vc_row',array(
  "type" => "dropdown",
  "heading" => esc_html__('Fullwidth', 'learn'),
  "param_name" => "fullwidth",
  "value" => array(   
                    esc_html__('No', 'learn') => 'no',  
                    esc_html__('Yes', 'learn') => 'yes',                                                                                
                  ),
  "description" => esc_html__("Select Fullwidth or not, Default: No fullwidth", "learn"),      
  ) 
);
	
vc_remove_param( "vc_row", "parallax" );
vc_remove_param( "vc_row", "parallax_image" );
vc_remove_param( "vc_row", "full_width" );
vc_remove_param( "vc_row", "full_height" );
vc_remove_param( "vc_row", "video_bg" );
vc_remove_param( "vc_row", "video_bg_parallax" );
vc_remove_param( "vc_row", "content_placement" );
vc_remove_param( "vc_row", "video_bg_url" );
vc_remove_param( "vc_row", "columns_placement" );
vc_remove_param( "vc_row", "gap" );
vc_remove_param( "vc_row", "equal_height" );
vc_remove_param( "vc_row", "parallax_speed_video" );
vc_remove_param( "vc_row", "parallax_speed_bg" );
vc_remove_element( "vc_basic_grid" );
vc_remove_element( "vc_masonry_grid" );
vc_remove_element( "vc_media_grid" );
vc_remove_element( "vc_masonry_media_grid" );
}
//}

/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.5.0-alpha
 * @author     Thomas Griffin
 * @author     Gary Jones
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/framework/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'learn_theme_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function learn_theme_register_required_plugins() {

    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        // Plugin Download the http://wordpress.org
        array(
            'name'               => 'Meta Box',
            'slug'               => 'meta-box',
            'required'           => true,
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
        array(            
            'name'               => 'WPBakery Visual Composer', // The plugin name.
            'slug'               => 'js_composer', // The plugin slug (typically the folder name).
            'source'             => 'http://oceanthemes.net/plugins-required/js_composer.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ),
        // This is an example of how to include a plugin from a private repo in your theme.

        array(            
            'name'               => 'Revolution Slider', // The plugin name.
            'slug'               => 'revslider', // The plugin slug (typically the folder name).
            'source'             => 'http://oceanthemes.net/plugins-required/revslider.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ),
        array(            
            'name'               => 'OT Testimonial', // The plugin name.
            'slug'               => 'ot_testimonial', // The plugin slug (typically the folder name).
            'source'             => 'http://oceanthemes.net/plugins-required/learn/ot_testimonial.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ),
        array(
            'name'               => 'Contact Form 7', // The plugin name
            'slug'               => 'contact-form-7', // The plugin slug (typically the folder name)
            'required'           => false, // If false, the plugin is only 'recommended' instead of required
        ),
        array(            
            'name'               => 'The Events Calendar', // The plugin name.
            'slug'               => 'the-events-calendar', // The plugin slug (typically the folder name).
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ),
        array(
            'name'               => 'MailChimp for WordPress', // The plugin name
            'slug'               => 'mailchimp-for-wp', // The plugin slug (typically the folder name)
            'required'           => false, // If false, the plugin is only 'recommended' instead of required
        ),
        array(            
            'name'               => 'Sensei', // The plugin name.
            'slug'               => 'sensei', // The plugin slug (typically the folder name).
            'source'             => 'http://oceanthemes.net/plugins-required/learn/sensei.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ),
        array(
            'name'               => 'Woocommerce', // The plugin name
            'slug'               => 'woocommerce', // The plugin slug (typically the folder name)
            'required'           => false, // If false, the plugin is only 'recommended' instead of required
        ),
    );

    /*
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are wrapped in a sprintf(), so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug'  => 'themes.php',            // Parent menu slug.
        'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => esc_html__( 'Install Required Plugins', 'learn' ),
            'menu_title'                      => esc_html__( 'Install Plugins', 'learn' ),
            'installing'                      => esc_html__( 'Installing Plugin: %s', 'learn' ), // %s = plugin name.
            'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'learn' ),
            'notice_can_install_required'     => _n_noop(
                'This theme requires the following plugin: %1$s.',
                'This theme requires the following plugins: %1$s.',
                'learn'
            ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop(
                'This theme recommends the following plugin: %1$s.',
                'This theme recommends the following plugins: %1$s.',
                'learn'
            ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop(
                'Sorry, but you do not have the correct permissions to install the %s plugin.',
                'Sorry, but you do not have the correct permissions to install the %s plugins.',
                'learn'
            ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop(
                'The following required plugin is currently inactive: %1$s.',
                'The following required plugins are currently inactive: %1$s.',
                'learn'
            ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop(
                'The following recommended plugin is currently inactive: %1$s.',
                'The following recommended plugins are currently inactive: %1$s.',
                'learn'
            ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop(
                'Sorry, but you do not have the correct permissions to activate the %s plugin.',
                'Sorry, but you do not have the correct permissions to activate the %s plugins.',
                'learn'
            ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop(
                'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
                'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
                'learn'
            ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop(
                'Sorry, but you do not have the correct permissions to update the %s plugin.',
                'Sorry, but you do not have the correct permissions to update the %s plugins.',
                'learn'
            ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop(
                'Begin installing plugin',
                'Begin installing plugins',
                'learn'
            ),
            'activate_link'                   => _n_noop(
                'Begin activating plugin',
                'Begin activating plugins',
                'learn'
            ),
            'return'                          => esc_html__( 'Return to Required Plugins Installer', 'learn' ),
            'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'learn' ),
            'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'learn' ), // %s = dashboard link.
            'contact_admin'                   => esc_html__( 'Please contact the administrator of this site for help.', 'learn' ),

            'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );

}
/*
$a = array(
  'primary' => 'Main Menu'
);
$b = base64_encode(maybe_serialize($a));
var_dump( $b );*/

?>