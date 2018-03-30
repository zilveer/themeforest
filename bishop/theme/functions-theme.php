<?php
/**
 * Your Inspiration Themes
 *
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Theme setup file
 */



/**
 * Set up all theme data.
 *
 * @return void
 * @since 1.0.0
 */
function yit_setup_theme() {

    /**
     * Set up the content width value based on the theme's design.
     *
     * @see yit_content_width()
     *
     * @since Twenty Fourteen 1.0
     */
    if ( ! isset( $GLOBALS['content_width'] ) ) {
        $GLOBALS['content_width'] = apply_filters( 'yit-container-width-std', 1170 );
    }

    //This theme have a CSS file for the editor TinyMCE
    add_editor_style( 'css/editor-style.css' );

    //This theme support post thumbnails
    add_theme_support( 'post-thumbnails' );

    //This theme uses the menus
    add_theme_support( 'menus' );

    //Add default posts and comments RSS feed links to head
    add_theme_support( 'automatic-feed-links' );

    //This theme support post formats
    add_theme_support( 'post-formats', apply_filters( 'yit_post_formats_support', array( 'gallery', 'audio', 'video', 'quote' ) ) );

    // Title tag
    add_theme_support( "title-tag" );

    // custonm logo
    add_theme_support( 'custom-logo', array(
        'height'      => 61,
        'width'       => 200,
        'flex-height' => true,
    ) );

    if ( ! defined( 'HEADER_TEXTCOLOR' ) )
        define( 'HEADER_TEXTCOLOR', '' );

    // The height and width of your custom header. You can hook into the theme's own filters to change these values.
    // Add a filter to twentyten_header_image_width and twentyten_header_image_height to change these values.
    define( 'HEADER_IMAGE_WIDTH', apply_filters( 'yiw_header_image_width', 1170 ) );
    define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'yiw_header_image_height', 410 ) );

    // Don't support text inside the header image.
    if ( ! defined( 'NO_HEADER_TEXT' ) )
        define( 'NO_HEADER_TEXT', true );

    //This theme support custom header
    add_theme_support( 'custom-header' );

    //This theme support custom backgrounds
    add_theme_support( 'custom-backgrounds' );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list',
    ) );

    // We'll be using post thumbnails for custom header images on posts and pages.
    // We want them to be 940 pixels wide by 198 pixels tall.
    // Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
    // set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );
    $image_sizes = array(
        'blog_small'                        => array( 368, 266, true ),
        'blog_single_small'                 => array( 1140, 491, true ),
        'blog_masonry'                      => array( 380, 999),
        'blog_big'                          => array( 1140, 265, true ),
        'blog_single_big'                   => array( 1920, 443, true ),
        'blog_thumb'                        => array( 49, 49, true ),
        'blog_section'                      => array(269, 122, true),
        'blog_section_mobile'               => array(716, 325, true),
        'portfolio_filterable'              => array( 360, 392, true ),
        'portfolio_section'                 => array( 380, 414, true ),
        'portfolio_pinterest'               => 360,
        'portfolio_single_big'              => array( 1920, 596, true ),
        'portfolio_single_small'            => array( 680, 494, true ),
        'portfolio_single_big_placeholder'  => array( 1920, 362, true ),
        'thumb-testimonial' => array( 255, 255, true )
    );

    $image_sizes = apply_filters( 'yit_add_image_size', $image_sizes );

    foreach ( $image_sizes as $id_size => $size ) {
        add_image_size( $id_size, apply_filters( 'yit_' . $id_size . '_width', $size[0] ), apply_filters( 'yit_' . $id_size . '_height', $size[1] ), isset( $size[2] ) ? $size[2] : false );
    }

    //Set localization and load language file
    $locale = get_locale();
    $locale_file = YIT_THEME_PATH . "/languages/$locale.php";
    if ( is_readable( $locale_file ) )
        require_once( $locale_file );



    //remove wpml stylesheet
    define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);

    if( !defined( 'WPLANG' ) ) define( 'WPLANG', '' );

    if( WPLANG != '' ) {
        load_theme_textdomain( 'yit', dirname( locate_template( '/languages/' . WPLANG . '.mo' ) ) );
    } else {
        load_theme_textdomain( 'yit', get_template_directory() . '/languages' );
    }


    // Add support to woocommerce
    if ( defined('YIT_IS_SHOP') && YIT_IS_SHOP ) {
        add_theme_support( 'woocommerce' );
    }



    //Register menus
    register_nav_menus(
        array(
            'nav' => __( 'Main Navigation', 'yit' ),
            'mobile-nav' => __( 'Mobile Navigation', 'yit' ),
            'welcome-menu' => __( 'Welcome Menu', 'yit' ),
            'copyright_right' => __( 'Copyright Right', 'yit' ),
            'copyright_left' => __( 'Copyright Left', 'yit' ),
            'copyright_centered' => __( 'Copyright Centered', 'yit' )
        )
    );

    //create the menu items if they don't exist
    $menuname = 'Welcome Menu';
    if( !wp_get_nav_menu_object( $menuname ) ) {
        if( is_shop_installed() ) {
            $my_account_id = get_option('woocommerce_myaccount_page_id');
            if( $my_account_id ) {
                /* Assing my-account.php template to my-account page */
                update_post_meta( $my_account_id, '_wp_page_template', 'my-account.php' );

                $menu_id = wp_create_nav_menu($menuname);
                $my_account_url = get_permalink( wc_get_page_id( 'myaccount' ) );
                wp_update_nav_menu_item($menu_id, 0, array(
                    'menu-item-title' => __('My Account', 'yit'),
                    'menu-item-object' => 'page',
                    'menu-item-object-id' => get_option('woocommerce_myaccount_page_id'),
                    'menu-item-type' => 'post_type',
                    'menu-item-status' => 'publish'));

                wp_update_nav_menu_item($menu_id, 0, array(
                    'menu-item-title' =>  __('My Orders', 'yit'),
                    'menu-item-classes' => 'view-order',
                    'menu-item-url' => wc_get_endpoint_url('view-order', '',  $my_account_url ),
                    'menu-item-status' => 'publish'));

                if ( !defined( 'YITH_WCWL' ) ){
                    wp_update_nav_menu_item($menu_id, 0, array(
                        'menu-item-title' =>  __('My Wishlist', 'yit'),
                        'menu-item-classes' => 'wishlist',
                        'menu-item-url' => wc_get_endpoint_url('wishlist', '',  $my_account_url ),
                        'menu-item-status' => 'publish'));
                }

                wp_update_nav_menu_item($menu_id, 0, array(
                    'menu-item-title' =>  __('Edit Address', 'yit'),
                    'menu-item-classes' => 'edit-address',
                    'menu-item-url' => wc_get_endpoint_url('edit-address', '',  $my_account_url ),
                    'menu-item-status' => 'publish'));

                wp_update_nav_menu_item($menu_id, 0, array(
                    'menu-item-title' =>  __('Edit Account', 'yit'),
                    'menu-item-classes' => 'edit-account',
                    'menu-item-url' => wc_get_endpoint_url('edit-account', '',  $my_account_url ),
                    'menu-item-status' => 'publish'));


                wp_update_nav_menu_item($menu_id, 0, array(
                    'menu-item-title' =>  __('Logout', 'yit'),
                    'menu-item-classes' => 'customer-logout',
                    'menu-item-url' => wc_get_endpoint_url('customer-logout', '',  $my_account_url ),
                    'menu-item-status' => 'publish'));

                if( !has_nav_menu( 'welcome-menu' ) ){
                    $locations = get_theme_mod('nav_menu_locations');
                    $locations['welcome-menu'] = $menu_id;
                    set_theme_mod( 'nav_menu_locations', $locations );
                }
            }

        }


    }

}

/**
 * Remove the class no-js when javascript is activated
 *
 * We add the action at the start of head, to do this operation immediatly, without gap of all libraries loading
 */
function yit_detect_javascript() {
	?>
	<script type="text/javascript">document.documentElement.className = document.documentElement.className.replace( 'no-js', '' ) + ' yes-js js_active js'</script>
	<?php
}

/**
 * Adjust content_width value for image attachment template.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return void
 */
function yit_content_width() {
    $full_width = $GLOBALS['content_width'];
    $sidebar_width = $full_width * ( 25 / 100 );   // 25% (col-3)
    $sidebar = yit_get_sidebars();

    if ( 'sidebar-double' == $sidebar['layout'] ) {
        $GLOBALS['content_width'] -= $sidebar_width * 2;
    } elseif ( 'sidebar-no' != $sidebar['layout'] ) {
        $GLOBALS['content_width'] -= $sidebar_width;
    }

    $GLOBALS['content_width'] -= 30;
}
add_action( 'template_redirect', 'yit_content_width' );


/**
 * Register the extra body classes to add in the pages
 *
 * @param array $classes
 *
 * @return array
 * @since 1.0.0
 */
function yit_add_body_class( $classes ) {
    $classes[] = yit_get_option('general-layout-type') . '-layout';
    $classes = yit_detect_browser_body_class( $classes );

    if( is_singular( 'post' ) ){
        $classes[] = 'blog-single-' . yit_get_option( 'blog-single-type' );
    }

    if( yit_get_option( 'general-activate-responsive' ) == 'yes' ){
        $classes[] = 'responsive';
    }

    return $classes;
}

/**
 * Extend the default WordPress post classes.
 *
 * Adds a post class to denote:
 * Non-password protected page with a post thumbnail.
 *
 * @since Twenty Fourteen 1.0
 *
 * @param array $classes A list of existing post class values.
 * @return array The filtered post class list.
 */
function yit_post_classes( $classes ) {
    if ( ! post_password_required() && has_post_thumbnail() ) {
        $classes[] = 'has-post-thumbnail';
    }

    return $classes;
}
add_filter( 'post_class', 'yit_post_classes' );

/**
 * Register foote sidebars
 */
add_action( 'widgets_init', 'yit_add_footer_sidebar' );
function yit_add_footer_sidebar() {

    for( $i = 1; $i <= yit_get_option( 'footer-rows', 0 ); $i++ ) {
        register_sidebar( yit_sidebar_args( "Footer Row $i", sprintf(  __( "The widget area #%d used in Footer section", 'yit' ), $i ), 'widget col-sm-' . ( 12 / yit_get_option( 'footer-columns' ) ), apply_filters( 'yit_footer_sidebar_' . $i . '_wrap', 'h5' ) ) );
    }
}

if( ! function_exists( 'remove_equals_from_special_chars' ) ){
    function remove_equals_from_special_chars( $chars ){

        unset( $chars['/[=\[](.*?)[=\]]/'] );
        $chars[ '/[\[](.*?)[\]]/' ] = '<span class="title-highlight">$1</span>';

        return $chars;
    }
}

// Remove Open Sans that WP adds from frontend

if ( ! function_exists( 'remove_wp_open_sans' ) ) :
    function remove_wp_open_sans() {
        wp_deregister_style( 'open-sans' );
        wp_register_style( 'open-sans', false );
    }

    add_action( 'wp_enqueue_scripts', 'remove_wp_open_sans' );
    // Uncomment below to remove from admin
    // add_action('admin_enqueue_scripts', 'remove_wp_open_sans');
endif;

/**
 * === Start Blog Functions ===
 */

if( ! function_exists( 'yit_add_blog_stylesheet' ) ) {

    /**
     * Register/Enqueue the blog stylesheet
     *
     * @return void
     * @since 2.0.0
     * @author Andrea Grillo    <andrea.grillo@yithems.com>
     */

    function yit_add_blog_stylesheet(){
        $blog = array(
            'src'           => YIT_THEME_ASSETS_URL . '/css/blog.css',
            'enqueue'       => true,
            'registered'    => false
        );

        $page_slider = array(
            'src'           => YIT_THEME_ASSETS_URL . '/css/page-slider.css',
            'enqueue'       => true,
            'registered'    => false
        );

        if( is_page_template( 'blog.php' ) || is_search() || is_singular( 'post' ) || is_home()|| is_archive() || is_category() || is_tag() || yit_is_old_ie() ){
            YIT_Asset()->set( 'style', 'blog-stylesheet', $blog, 'before', 'comment-stylesheet' );

            if( is_singular( 'post' ) || yit_is_old_ie() ) {
                YIT_Asset()->set( 'style', 'page-slider', $page_slider, 'after', 'blog-stylesheet' );
            }
        }
    }
}

if( ! function_exists( 'yit_blog_big_post_start' ) ){
    /**
     * Start the blog post
     *
     * @return void
     * @since 2.0.0
     * @author Antonio La Rocca <antonio.larocca@yithems.com>
     * @author Andrea Grillo    <andrea.grillo@yithems.com>
     */

    function yit_blog_big_post_start( $position = 'next-post' ){
		global $post;

        if ( is_null( $post ) || empty( $post ) ) { return; }

//		if( YIT_Request()->is_ajax && isset( $_REQUEST['post_id'] ) ){
//			$post = get_post( intval( $_REQUEST['post_id'] ) );
//		}

		if( ( is_singular( 'post' ) || YIT_Request()->is_ajax && $post->post_type == 'post' ) && yit_get_option( 'blog-single-type' ) == 'big' ) {
            $post_format    = ( ! get_post_format() ) ? 'standard' : get_post_format();
            $show_thumbnail = ( yit_get_option( 'blog-single-show-featured-image' ) == 'yes' && has_post_thumbnail() && $post_format == 'standard' ) ? true : false;
            ?>

            <?php if( $position != 'next-post' ) : ?>
                <div id="current" class="slide-tab current-post blog_big">
            <?php endif; ?>
            <?php if( $show_thumbnail && $post_format == 'standard' ) : ?>
                <?php yit_get_template( 'blog/post-formats/' . $post_format . '.php', array( 'show_date' => false, 'blog_type' => yit_get_option( 'blog-single-type' ), 'doing_ajax'     => ( defined( 'DOING_AJAX' )  && DOING_AJAX  ) ? true : false ) ) ?>
            <?php else: ?>
                <?php $args = array(
                    'post_format'    => $post_format,
                    'image_size'     => YIT_Registry::get_instance()->image->get_size( 'blog_single_big' ),
                    'show_date'      => ( yit_get_option( 'blog-single-show-date' ) == 'yes' ) ? true : false,
                    'blog_type'      => yit_get_option( 'blog-single-type' ),
                    'doing_ajax'     => ( defined( 'DOING_AJAX' )  && DOING_AJAX  ) ? true : false
                );


                if( $post_format != 'quote' ) {
                    yit_get_template( 'blog/post-formats/' . $post_format . '.php', $args );
                }elseif( $post_format == 'quote' && has_post_thumbnail() ) {
                    yit_image( 'size=blog_single_big&class=img-responsive' );
                }
            endif;
        }
    }
}

if( ! function_exists( 'yit_blog_big_post_end' ) ){

    function yit_blog_big_post_end(){

        if( is_singular( 'post' ) && yit_get_option( 'blog-single-type' ) == 'big' ){
            echo '</div>';
        }
    }
}

add_action( 'wp_ajax_blog_next_post', 'yit_blog_big_next_post' );
add_action( 'wp_ajax_nopriv_blog_next_post', 'yit_blog_big_next_post');

if( ! function_exists( 'yit_blog_big_next_post' ) ){
    /**
     * Get the next blog post with an ajax call
     *
     * @return void
     * @since 2.0.0
     * @author Antonio La Rocca <antonio.larocca@yithems.com>
     * @author Andrea Grillo    <andrea.grillo@yithems.com>
     */
    function yit_blog_big_next_post(){
		global $post;

        if ( is_null( $post ) || empty( $post ) ) { return; }

		if( YIT_Request()->is_ajax && isset( $_REQUEST['post_id'] ) ){
			$post = get_post( intval( $_REQUEST['post_id'] ) );
		}

		if( ( is_singular( 'post' ) || YIT_Request()->is_ajax && $post->post_type == 'post' ) && yit_get_option( 'blog-single-type' ) == 'big' ) {

            $blog_type_options = array(
                'blog_single_type'  => yit_get_option( 'blog-single-type' ),
                'is_next_post'      => true
            );

            $image_size = YIT_Registry::get_instance()->image->get_size( 'blog_single_big' );

            $next_post = get_previous_post( );

            if( $next_post == '' || $next_post == null ){

                $args = array(
                    'order' => 'DESC',
                    'order_by' => 'date'
                );

                $posts = get_posts( $args );

                if( ! empty( $posts ) ){
                    $next_post = $posts[0];
                }
            }

            $post = $next_post;
            setup_postdata($post);
            $has_post_thumbnail = has_post_thumbnail();
            $placeholder = ! $has_post_thumbnail ? 'class="placeholder no-featured" style="height: ' . $image_size['height'] .'px;"' : 'class="placeholder" style="max-height: ' . $image_size['height'] .'px;"';
            ?>
            <div id="next" class='slide-tab next-post hidden-content' data-post_id="<?php the_ID() ?>">
                <div class='big-image'>
                    <div <?php echo $placeholder; ?>>
                        <?php if( $has_post_thumbnail ) : ?>
                            <?php yit_image( array( 'post_id' =>  get_the_ID(), 'size' => 'blog_single_big', 'class' => 'img-responsive' ) ); ?>
                        <?php endif; ?>
                        <div class="inner">
                            <div class="info-overlay">
                                <div class="read-more-label"><?php _e( 'VIEW NEXT POST', 'yit' ) ?></div>
                                <div class="read-more-title"><?php the_title() ?></div>
                            </div>
                        </div>
                    </div>
                    <?php yit_blog_big_post_start( 'next-post' ) ?>
                </div>
                <div class='container'>
                    <?php
                    remove_action( 'yit_primary', 'yit_start_primary', 5 );
                    remove_action( 'yit_primary', 'yit_end_primary', 90 );
                    remove_action( 'yit_content_loop', 'yit_content_loop', 10 );
                    add_action( 'yit_content_loop', 'yit_blog_single_loop' );
                    yit_get_template( 'primary/loop/single.php', $blog_type_options );
                    if( ! YIT_Request()->is_ajax ){
                        comments_template();
                    }
                    add_action( 'yit_primary', 'yit_end_primary', 90 );
                    ?>
                </div>
            </div>
            <?php

            if( defined('DOING_AJAX') && DOING_AJAX ){
                die();
            }
        }
    }
}

if( ! function_exists( 'yit_blog_single_loop' ) ){
    /**
     * Add the loop in the single template
     *
     * @return void
     * @since 2.0.0
     * @author Antonio La Rocca <antonio.larocca@yithems.com>
     * @author Andrea Grillo    <andrea.grillo@yithems.com>
     */
    function yit_blog_single_loop(){
        if( is_singular( 'post' ) && yit_get_option( 'blog-single-type' ) == 'big' ){
            do_action( 'yit_loop' );
        }
    }
}

if( ! function_exists( 'yit_get_comments_template' ) ){
    /**
     * Get the comments template
     *
     * @return mixed
     * @since 2.0.0
     * @author Andrea Grillo <andrea.grillo@yithems.com>
     */

    function yit_get_comments_template(){
        return include( YIT_PATH . '/comments.php' );
    }
}

//Hide the footer
if( ! function_exists( 'yit_hide_footer' ) ) {

    /**
     * Change the footer type options to hide the footer
     *
     * @return void
     * @since 2.0.0
     * @author Andrea Grillo    <andrea.grillo@yithems.com>
     */
    function yit_hide_footer() {
        return 'none';
    }
}


if( !function_exists('yit_curPageURL') ) {
    /**
     * Retrieve the current complete url
     *
     * @since 1.0
     */
    function yit_curPageURL() {
        $pageURL = 'http';
        if ( isset( $_SERVER["HTTPS"] ) AND $_SERVER["HTTPS"] == "on" )
            $pageURL .= "s";

        $pageURL .= "://";

        if ( isset( $_SERVER["SERVER_PORT"] ) AND $_SERVER["SERVER_PORT"] != "80" )
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        else
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];

        return $pageURL;
    }
}
/**
 * === END Blog Functions ===
 */


if( !function_exists( 'yit_excerpt_text' ) ) {
    /**
     * Cut the text
     *
     * @author Andrea Grillo  <andrea.grillo@yithemes.com>
     *
     * @param string $text
     * @param int $excerpt_length
     * @param string $excerpt_more
     * @return string
     * @since 1.0.0
     */
    function yit_excerpt_text( $text, $excerpt_length = 50, $excerpt_more = '' ) {
        $words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
        if ( count($words) > $excerpt_length ) {
            array_pop($words);
            $text = implode(' ', $words);
            $text = $text . $excerpt_more;
        } else {
            $text = implode(' ', $words);
        }

        echo $text;
    }
}


/**
 * VISUAL COMPOSER
 * Remove admin notice
 */
function yit_remove_notice_visual_composer() {
    if ( isset( $GLOBALS['wpVC_setup'] ) ) {
        remove_action( 'admin_notices', array( $GLOBALS['wpVC_setup'], 'adminNoticeLicenseActivation' ) );
    }
}
add_action( 'admin_init', 'yit_remove_notice_visual_composer' );

if( !function_exists( 'yit_get_registered_nav_menus' ) ) {
    /**
     * Retireve all registered menus
     *
     * @return array
     * @since 1.0.0
     */
    function yit_get_registered_nav_menus() {
        $menus = get_terms( 'nav_menu' );
        $return = array();

        foreach( $menus as $menu ) {
            array_push( $return, $menu->name );
        }

        return $return;
    }
}
if( !function_exists( 'yit_og' ) ) {
    function yit_og(){

        if( !function_exists('is_plugin_active') ) {
            require_once ABSPATH . "/wp-admin/includes/plugin.php";
        }

        if( yit_get_option('general-enable-open-graph') == 'no' || is_plugin_active( 'wordpress-seo/wp-seo.php' ) ) return;

        /**
         * Create the og tag description with properly content, based on the current queried object.
         */
        $queried_object = get_queried_object();

        $ogcontent  = array();
        $ogcontent['site_name'] = get_bloginfo( 'name' );
        $ogcontent['title'] = function_exists( 'wp_get_document_title' ) ? wp_get_document_title() : wp_title( '-', false, 'right' );

        // For posts, pages and products
        if( isset( $queried_object->post_type ) ) {
            $post    = get_post( $queried_object->ID );
            $ogcontent['url'] = get_permalink( $post );
            $ogcontent['description'] = $post->post_excerpt ? $post->post_excerpt : wp_trim_words( $post->post_content );


            if( has_post_thumbnail( $post->ID ) ) {
                $image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) , 'medium');
                $ogcontent['image'] = $image_url[0];
            }

        } else if( isset( $queried_object->taxonomy ) && $queried_object->taxonomy ) {

            $ogcontent['description'] = $queried_object->description;

            if(  function_exists( 'WC' ) ){
                $term_thumbnail = get_woocommerce_term_meta( $queried_object->term_id, 'thumbnail_id', true );
                $imgs = wp_get_attachment_image_src( $term_thumbnail, 'medium' );
                if( $imgs[0] ){
                    $ogcontent['image'] = $imgs[0];
                }
            }
        }

        $type =  apply_filters( 'yit_og_type' , $queried_object );
        if($type) $ogcontent['type'] = $type;

        // If the taxonomy or post don't have content, use the site description
        if( (is_home() || is_front_page())  && empty( $ogcontent['description'] ) ) {
            $ogcontent['description'] = get_bloginfo( 'description' );
        }

        if( empty( $ogcontent['image'] ) && yit_get_option( 'header-custom-logo' ) == 'yes' && yit_get_option( 'header-custom-logo-image' ) != '' ) {
            $ogcontent['image'] = yit_get_option( 'header-custom-logo-image' );
        }

        $ogcontent['description'] = isset( $ogcontent['description'] ) ? apply_filters( 'yit_og_description', strip_tags(strip_shortcodes(preg_replace("~(?:\[/?)[^/\]]+/?\]~s", '', $ogcontent['description'])))) : '';

        foreach( $ogcontent as $property => $content ){
            echo "<meta property='og:". $property."' content='" . $content . "'/>\n";
        }

    }

}

//if( ! function_exists( 'yit_add_buddypress_tables' ) ){
//    /**
//     * add BBP table to export functions
//     *
//     * @author   Andrea Grillo  <andrea.grillo@yithemes.com>
//     *
//     * @param array
//     * @param $tables
//     *
//     * @return mixed array
//     * @since    1.0.2
//     */
//    function yit_add_buddypress_tables( $tables ){
//        $tables['plugins'][] = 'bp%';
//        $tables['options'][] = 'bp%';
//
//        return $tables;
//    }
//}
/**
 * SoundCloud functions
*/
if( ! function_exists( 'soundcloud_oembed_params' ) ){
    function soundcloud_oembed_params( $embed, $params ) {
        global $soundcloud_oembed_params;
        $soundcloud_oembed_params = $params;
        return preg_replace_callback( '/src="(https?:\/\/(?:w|wt)\.soundcloud\.(?:com|dev)\/[^"]*)/i', 'soundcloud_oembed_params_callback', $embed );
    }
}

if( ! function_exists( 'soundcloud_oembed_params_callback' ) ){
    function soundcloud_oembed_params_callback( $match ) {
        global $soundcloud_oembed_params;

        // Convert URL to array
        $url = parse_url( urldecode( $match[1] ) );
        // Convert URL query to array
        parse_str( $url['query'], $query_array );
        // Build new query string
        $query = http_build_query( array_merge( $query_array, $soundcloud_oembed_params ) );

        $search  = array( 'show_artwork=0', 'show_artwork=1', 'auto_play=0', 'auto_play=1', 'show_comments=0', 'show_comments=1' );
        $replace = array( 'show_artwork=false', 'show_artwork=true', 'auto_play=false', 'auto_play=true', 'show_comments=false', 'show_comments=true' );

        $query = str_replace( $search, $replace, $query );

        return 'src="' . $url['scheme'] . '://' . $url['host'] . $url['path'] . '?' . $query;
    }
}

/**
 * Fix comments list in buddypress pages
 */
if( ! function_exists( 'yit_fix_bp_comments_list' ) ){
   function yit_fix_bp_comments_list( $comments, $post_id ) {
        global $wp_query;

        $post = $wp_query->get_queried_object();

        if ( in_array( $post->ID, bp_core_get_directory_page_ids() ) ) {
            return array();
        }

        return $comments;
    }
}


if( function_exists( 'buddypress' ) ){
    add_filter( 'comments_array', 'yit_fix_bp_comments_list', 10, 2 );
}

//if( ! function_exists( 'yit_add_revslider_tables' ) ) {
//    /**
//     * add revslider table to export functions
//     *
//     * @author   Andrea Grillo  <andrea.grillo@yithemes.com>
//     *
//     * @param array
//     * @param $tables
//     *
//     * @return mixed array
//     * @since    2..0.0
//     */
//    function yit_add_revslider_tables( $tables ) {
//        global $wpdb;
//
//        $tables['plugins'][] = str_replace( $wpdb->prefix, '', GlobalsRevSlider::$table_sliders );
//        $tables['plugins'][] = str_replace( $wpdb->prefix, '', GlobalsRevSlider::$table_slides );
//        $tables['plugins'][] = str_replace( $wpdb->prefix, '', GlobalsRevSlider::$table_settings );
//        $tables['plugins'][] = str_replace( $wpdb->prefix, '', GlobalsRevSlider::$table_css );
//        $tables['plugins'][] = str_replace( $wpdb->prefix, '', GlobalsRevSlider::$table_layer_anims );
//
//        return $tables;
//    }
//}

//if( ! function_exists( 'yit_add_faqs_tables' ) ) {
//    /**
//     * add faqs table to export functions
//     *
//     * @author   Andrea Grillo  <andrea.grillo@yithemes.com>
//     *
//     * @param array
//     * @param $tables
//     *
//     * @return mixed array
//     * @since    2..0.0
//     */
//    function yit_add_faqs_tables( $tables ){
//    $tables['plugins'][] = YIT_Faq()->term_meta_table_name;
//
//    return $tables;
//    }
//    }

//    if( ! function_exists( 'yit_add_bbpress_tables' ) ) {
//        /**
//         * add bbpress table to export functions
//         *
//         * @author   Andrea Grillo  <andrea.grillo@yithemes.com>
//         *
//         * @param array
//         * @param $tables
//         *
//         * @return mixed array
//         * @since    2..0.0
//         */
//    function yit_add_bbpress_tables( $tables ){
//        $tables['options'][] = '_bbp%';
//
//        return $tables;
//    }
//}

if( ! function_exists( 'yit_string_is_serialized' ) ) {
     /**
     * Check if a string is serialized
     *
     * @author   Andrea Grillo  <andrea.grillo@yithemes.com>
     *
     * @param $string
     *
     * @internal param string $src
     * @return bool | true if string is serialized, false otherwise
     * @since    2.0.0
     */
    function yit_string_is_serialized( $string ) {
        $data = @unserialize( $string );
        return ! $data ? $data : true;
    }
}

if( ! function_exists( 'yit_string_is_json' ) ){
    /**
     * Check if a string is json
     *
     * @author   Andrea Grillo  <andrea.grillo@yithemes.com>
     *
     * @param $string
     *
     * @internal param string $src
     * @return bool | true if string is json, false otherwise
     * @since    2.0.0
     */
    function yit_string_is_json( $string ) {
        $data = @json_decode( $string );
        return $data == NULL ? false : true;
    }
}

if( ! function_exists( 'yit_remove_script_version' ) ) {
    /**
     * Remove the script version from the script and styles
     *
     * @author Andrea Grillo  <andrea.grillo@yithemes.com>
     *
     * @param string $src
     * @return string
     * @since 1.0.0
     */
    function yit_remove_script_version( $src ) {
        if( yit_get_option( 'general-remove-scripts-version' ) == 'yes' ) {
            $parts = explode( '?v', $src );
            return $parts[0];
        } else {
            return $src;
        }
    }

}

if(!function_exists("yit_exclude_categories_list_widget"))   {
	/*
   * exclude categories(selected in the theme options) from wordpress widget categories
   *
   * @return void
   * @since 2.0
   * @author Andrea Frascaspata <andrea.frascaspata@yithemes.com>
   */
	function yit_exclude_categories_list_widget($args){
		$cat_args = array('exclude' =>str_replace("-","",yit_get_excluded_categories(2)));
		return array_merge($args,$cat_args);
	}
}

/* PORTFOLIO QUICK VIEW */
function yit_load_portfolio_quick_view_ajax() {
	if ( ! isset( $_REQUEST['item_id'] ) ) {
		die();
	}

	$item_id = intval( $_REQUEST['item_id'] );

	// set the main wp query for the product
	wp( 'p=' . $item_id . '&post_type=' . get_post_type( $item_id ) );

	// force classic layout
	add_filter( 'yit_portfolio_layout', 'yit_force_classic_portfolio_layout' );

	?>
	<link type="text/css" rel="stylesheet" href="<?php echo YIT_THEME_TEMPLATES_URL . '/portfolios/single/css/style.css'; ?>" />
	<?php

	do_action( 'yit_primary' );

	die();
}
add_action( 'wp_ajax_yit_load_portfolio_quick_view', 'yit_load_portfolio_quick_view_ajax' );
add_action( 'wp_ajax_nopriv_yit_load_portfolio_quick_view', 'yit_load_portfolio_quick_view_ajax' );

function yit_force_classic_portfolio_layout( $layout ) {
	return 'small_image';
}

global $WORDPRESS_SOCIAL_LOGIN_VERSION;
if ( isset( $WORDPRESS_SOCIAL_LOGIN_VERSION ) ) {
	/**
	 * WORDPRESS SOCIAL PLUGIN SUPPORT
	 */

    if ( version_compare( preg_replace( '/-beta-([0-9]+)/', '', $WORDPRESS_SOCIAL_LOGIN_VERSION ), '2.2', '<=' ) ) {
        add_action( 'woocommerce_login_form_end', 'wsl_render_login_form_login_form' );
        add_filter( 'wsl_alter_hook_provider_icon_markup', 'wsl_alter_hook_provider_icon_markup' );
    }

    else {
        add_action( 'woocommerce_login_form_end', 'wsl_render_login_form_login' );
        add_filter( 'wsl_render_login_form_alter_provider_icon_markup', 'wsl_alter_hook_provider_icon_markup' );
    }

	function wsl_alter_hook_provider_icon_markup( $provider_id ) {
		global $WORDPRESS_SOCIAL_LOGIN_PROVIDERS_CONFIG;

		if ( in_array( $provider_id, array( 'Amazon', 'Blogger', 'Disqus', 'LiveJournal', 'Mail.ru', 'Odnoklassniki', 'PayPal', 'Skyrock.com', 'StackExchange', 'Twitch.tv', 'VKontakte' ) ) ) {
			return $provider_id;
		}

		foreach ( $WORDPRESS_SOCIAL_LOGIN_PROVIDERS_CONFIG as $the ) {
			if ( $the['provider_id'] == $provider_id ) {
				$item = $the;
				break;
			}
		}

		if ( ! isset( $item ) ) {
			return $provider_id;
		}

		$authenticate_base_url = site_url( 'wp-login.php', 'login_post' ) . ( strpos( site_url( 'wp-login.php', 'login_post' ), '?' ) ? '&' : '?' ) . "action=wordpress_social_authenticate&";

		// overwrite endpoint_url if need'd
		if( get_option( 'wsl_settings_hide_wp_login' ) == 1 ){
			$authenticate_base_url = WORDPRESS_SOCIAL_LOGIN_PLUGIN_URL . "/services/authenticate.php?";
		}

		$provider_id     = @ $item["provider_id"];
		$provider_name   = @ $item["provider_name"];

		$current_page_url = 'http';
		if (isset($_SERVER["HTTPS"]) && ($_SERVER["HTTPS"] == "on")) {
			$current_page_url .= "s";
		}
		$current_page_url .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$current_page_url .= $_SERVER["HTTP_HOST"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		}
		else {
			$current_page_url .= $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
		}

		$authenticate_url = $authenticate_base_url . "provider=" . $provider_id . "&redirect_to=" . urlencode( $current_page_url );

		$wsl_settings_use_popup = get_option( 'wsl_settings_use_popup' ) ;

		ob_start();

		$fix_icon_name = array(
			'live' => 'windows',
			'yahoo!' => 'yahoo',
			'google' => 'google-plus',
		);

		if( $wsl_settings_use_popup == 1 ){
			?>
			<a rel="nofollow" href="javascript:void(0);" title="Connect with <?php echo $provider_name ?>" class="wsl_connect_with_provider link_socials" data-provider="<?php echo $provider_id ?>" data-normal="#b1b1b1" data-hover="#000000">
				<i class="fa fa-<?php echo str_replace( array_keys( $fix_icon_name ), array_values( $fix_icon_name ), strtolower( $provider_id ) ) ?>" style="color:#b1b1b1; font-size: 18px"></i>
			</a>
		<?php
		}
		elseif( $wsl_settings_use_popup == 2 ){
			?>
			<a rel="nofollow" href="<?php echo esc_url( $authenticate_url ) ?>" title="Connect with <?php echo $provider_name ?>" class="wsl_connect_with_provider link_socials" data-normal="#b1b1b1" data-hover="#000000" >
				<i class="fa fa-<?php echo str_replace( array_keys( $fix_icon_name ), array_values( $fix_icon_name ), strtolower( $provider_id ) ) ?>" style="color:#b1b1b1; font-size: 18px"></i>
			</a>
		<?php
		}

		return ob_get_clean();

	}


	function yit_wsl_style() {
		global $WORDPRESS_SOCIAL_LOGIN_VERSION;

		if ( ! isset( $WORDPRESS_SOCIAL_LOGIN_VERSION ) ) return;

		?>
		<style type="text/css">

            div#wp-social-login-connect-options,.wp-social-login-widget .wp-social-login-provider-list, #header-sidebar .wp-social-login-widget .wp-social-login-provider-list{
                position: static;
                margin: 0;
                padding:  10px 10px 10px 0;
            }

            #header-sidebar .wp-social-login-widget {
                margin-top : -116px;
            }

            #header-sidebar .wp-social-login-widget .wp-social-login-provider-list{
                margin-top: 10px;
                padding: 0;
            }

           #header-sidebar .wp-social-login-widget .wp-social-login-provider-list a{
                margin: 0;
                padding: 0;
                line-height: 0;
            }

            .wp-social-login-widget .wp-social-login-provider-list a {
                margin-right: 5px;
            }

            #header-sidebar .wp-social-login-widget .wp-social-login-provider-list a:before,#header-sidebar .wp-social-login-widget .wp-social-login-provider-list a:after{
                content: none;
            }

            #wp-social-login-connect-options a.link_socials, .wp-social-login-widget .wp-social-login-provider-list i {
				display: inline-block;
				width: 30px;
				height: 30px;
				line-height: 32px;
				text-align: center;
				border: 1px solid #b1b1b1;
                padding: 0;
                box-sizing: border-box;
			}

			#wp-social-login-connect-options a.link_socials:hover, #wp-social-login-connect-options a.link_socials:hover i, .wp-social-login-widget .wp-social-login-provider-list i:hover {
				color: #000 !important;
				border-color: #000;
                box-sizing: border-box;
			}

            .link_socials, .link_socials:hover{
                border: 0;
                background: none;
                display: inline-block;
                margin-bottom: 10px !important;
            }

		</style>
		<?php
	}

	add_action( 'wp_head', 'yit_wsl_style' );
	add_action( 'login_head', 'yit_wsl_style' );
}

// replace "HOME" with icon
function yit_navigation_home_to_icon( $nav_menu, $args ) {
    return preg_replace( '/(<li[^>]*icon-home(-responsive)?[^>]*><a[^>]*>).*?(<\/a><\/li>)/', '$1<span class="glyphicon glyphicon-home"></span>$3', $nav_menu );
}
add_filter( 'wp_nav_menu', 'yit_navigation_home_to_icon', 10, 2 );

/* LIVE CHAT X */

define( 'CX_ACTIVATE_K', 'cx_c896iLyiitxLqrp16IHlg' );
define( 'CX_ACTIVATE_T', 'Bishop Theme' );

if ( ! function_exists( 'yit_category_page_product_counter' ) ) {
    /**
     * Return html code of categories product number
     *
     * @author   Andrea Frascaspata  <andrea.frascaspata@yithemes.com>
     *
     * @param $count
     * @param $category
     *
     * @return string
     * @since    1.2.2
     */
    function yit_category_page_product_counter( $count, $category ) {
        return apply_filters( 'woocommerce_subcategory_count_html', ' <span class="count">(' . $count . ')</span>', $category );
    }
}

if( !function_exists( 'yit_remove_wp_admin_bar' ) ) {
    /**
     * Remove the wp admin bar in frontend if user is logged in
     *
     *
     * @return string  The html
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     * @since 2.0
     */
    function yit_remove_wp_admin_bar() {
        if ( yit_get_option( 'general-lock-down-admin' ) == 'yes' && ! current_user_can( 'administrator' ) ){
            add_filter( 'show_admin_bar', '__return_false' );
        }
    }
}

/* === CHECK FOR NON STANDARD WORDPRESS TABLE == */

/* Revolution Slider Plugin */
if( class_exists( 'GlobalsRevSlider' ) ) {
    add_filter( 'yit_yiw_link_data_tables', 'yit_remove_link_add_revslider_tables' );
}

if( ! function_exists( 'yit_remove_link_add_revslider_tables' ) ) {
    /**
     * add Revolution Slider table to export functions
     *
     * @author   Andrea Grillo  <andrea.grillo@yithemes.com>
     *
     * @param array
     * @param $tables
     *
     * @return mixed array
     * @since    1.0.2
     */
    function yit_remove_link_add_revslider_tables( $tables ) {
        global $wpdb;

        $tables['plugins'][] = str_replace( $wpdb->prefix, '', GlobalsRevSlider::$table_sliders );
        $tables['plugins'][] = str_replace( $wpdb->prefix, '', GlobalsRevSlider::$table_slides );

        return $tables;
    }
}

if( ! function_exists( 'yit_remove_ult_banner' ) ) {
    /**
     * Remove the Wordpress ULTimateAddOns Banner
     *
     *
     * @return string  The html
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     * @since 2.0
     */
    function yit_remove_ult_banner() {
        $args = apply_filters( 'yit_ult_args', array( 'status' => 'verified', 'code' => 200 ) );
        update_option( 'ultimate_license_activation', $args );
        set_transient( "ultimate_license_activation", true, 10*YEAR_IN_SECONDS );
    }
}

if( ! function_exists( 'yit_remove_rev_slider_banner' ) ) {
    /**
     * Remove the Wordpress ULTimateAddOns Banner
     *
     *
     * @return string  The html
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     * @since 2.0
     */
    function yit_remove_rev_slider_banner() {
        update_option( 'revslider-valid', true );
        update_option( 'revslider-valid-notice', false );
    }
}

if ( ! function_exists( 'yit_get_og_type' ) ) {

    function yit_get_og_type( $queried_object ) {

        $type = "";

        $is_shop = (function_exists( 'WC' ) && is_shop()) ;

        if ( (is_front_page() || is_home()) && ! $is_shop ) {
            $type = 'website';
        }
        else if ( isset( $queried_object->post_type ) ) {
            switch ( $queried_object->post_type ) {

                case 'post' :
                    $type = 'article';
                    break;
                case 'product' :
                    $type = 'product';
                    break;
            }
        }
        else if ( isset( $queried_object->taxonomy ) && $queried_object->taxonomy ) {

                switch ( $queried_object->taxonomy ) {
                    case 'product_cat' :
                        $type = 'product.group';
                        break;
                }

        }
        else if( $is_shop ) {
            $type = 'product.group';
        }

        return $type;
    }

}


if( ! function_exists( 'yit_add_testimonial_slider_script' ) ) {
    /**
     * Add Testimonail Slider Script
     *
     * @since  2.0.0
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     */
    function yit_add_testimonial_slider_script() {

        if( function_exists( 'YIT_Testimonial' ) ) {
            $options = array(
                'src'       => YIT_THEME_ASSETS_URL . '/js/yit-testimonial-frontend.js',
                'enqueue'   => true,
                'deps'      => array('jquery'),
            );

            if ( function_exists( 'YIT_Asset' ) && ! is_admin() ) {
                YIT_Asset()->set( 'script', 'yit-testimonial', $options );
            }
            else {
                wp_dequeue_script( 'yit-testimonial' );
            }
        }
    }
}

if( ! function_exists( 'yit_wpml_get_translated_id' ) ) {
    /**
     * Get the id of the current translation of the post/custom type
     *
     * @since  2.0.0
     * @author Andrea Frascaspata <andrea.frascaspata@yithemes.com>
     */
    function yit_wpml_get_translated_id( $id, $post_type ) {

        if ( function_exists( 'wpml_object_id_filter' ) ) {

            $id = wpml_object_id_filter( $id, $post_type, true );

        }

        return $id;
    }
}

/**
 * Return false if there is no pagination on current page
 *
 * @author Andrea Frascaspata <andrea.frascaspata@yithemes.com>
 * @since 2.0
 */
if ( ! function_exists( 'yit_is_paged' ) ) {
    function yit_is_paged() {

        $paged = get_query_var( 'paged' );

        return ! empty( $paged ) ? $paged : get_query_var( 'page' ) ;

    }
}

/**
 * Get current post page
 *
 * @author Andrea Frascaspata <andrea.frascaspata@yithemes.com>
 * @since 2.0
 */
if ( ! function_exists( 'yit_get_post_current_page' ) ) {
    function yit_get_post_current_page() {

        $current_page = yit_is_paged();

        $paged = $current_page ? $current_page : 1;

        return $paged;
    }
}



