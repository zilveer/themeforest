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

define( 'CX_ACTIVATE_K', 'cx_c26ff42d96d5fd8c09f91' );
define( 'CX_ACTIVATE_T', 'Mindig Theme' );



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
        'height'      => 34,
        'width'       => 167,
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
        'blog_small'                            => array( 283, 170, true ),
        'blog_masonry'                          => array( 283, 0),
        'blog_big'                              => array( 1138, 547, true ),
        'blog_single_big'                       => array( 1138, 547, true ),
        'blog_thumb'                            => array( 49, 49, true ),
        'blog_section'                          => array( 97, 72, true ),
        'testimonial-thumbnail'                 => array(268, 0),
        'testimonial-thumb'                     => array(63, 63, true),
        'thumb_team_big'                        => array(380, 310, true),
        'portfolio_big'                         => array(554, 368),
        'portfolio_small'                       => array(263, 325, true),
        'portfolio_thumb'                       => array(40, 40, true),
        'portfolio_single_big_featured'         => array(763, 532, true),
        'woocommerce_color_label_variations'    => array(27, 27, true),
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
            'nav'                => __( 'Main Navigation', 'yit' ),
            'mobile-nav'         => __( 'Mobile Navigation', 'yit' ),
            'welcome-menu'       => __( 'Welcome Menu', 'yit' ),
            'copyright_right'    => __( 'Copyright Right', 'yit' ),
            'copyright_left'     => __( 'Copyright Left', 'yit' ),
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

                if ( defined( 'YITH_WCWL' ) ){
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

    // Default Sidebar
    register_sidebar( yit_sidebar_args( "Default Sidebar", __( "The default widgets area ready to use.", 'yit' ), 'widget', 'h3' ) );

    // Mobile Sidebar
    register_sidebar( yit_sidebar_args( "Mobile Sidebar", __( "The widgets area used in the side menu of mobile, in bottom part. The widgets compatible with this are widget are: YIT Woocommerce Login, Text and Custom Menu.", 'yit' ), 'widget', 'h3' ) );

    //Register footer sidebar
    for( $i = 1; $i <= yit_get_option( 'footer-rows', 0 ); $i++ ) {
        register_sidebar( yit_sidebar_args( "Footer Row $i", sprintf(  __( "The widget area #%d used in Footer section", 'yit' ), $i ), 'widget col-sm-' . ( 12 / yit_get_option( 'footer-columns' ) ), apply_filters( 'yit_footer_sidebar_' . $i . '_wrap', 'h3' ) ) );
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
        $blog_single_type = yit_get_option( 'blog-single-type' );
        $classes[] = empty( $blog_single_type ) ? 'blog-single' : 'blog-single blog-single-' . $blog_single_type;
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

        $morphbutton =  array(
            'src'           => YIT_THEME_ASSETS_URL . '/css/morphbutton.css',
            'enqueue'       => true,
            'registered'    => false
        );

        $ui_morphing_button   = array(
            'src'       => YIT_THEME_ASSETS_URL . '/js/uiMorphingButton_inflow.js',
            'enqueue'   => true,
            'deps'      => array('jquery')
        );

        if( ( is_page_template( 'blog.php' ) || is_search() || is_singular( 'post' ) || is_home()|| is_archive() || is_category() || is_tag() || yit_is_old_ie() ) && is_singular( 'post' ) ){
            YIT_Asset()->set( 'style', 'morphbutton-stylesheet', $morphbutton, 'after', 'blog-stylesheet' );
            YIT_Asset()->set( 'script', 'ui-morphing-button', $ui_morphing_button, 'last' );
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

if ( ! function_exists( 'yit_exclude_categories_list_widget' ) ) {
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

if( ! function_exists( 'yit_portfolio_layout_values' ) ){
    /**
     * Unset unused portfolio layout
     *
     * @param $layouts
     *
     * @return string[]
     * @since  2.0.0
     * @author Antonio La Rocca <antonio.larocca@yithems.com>
     */
    function yit_portfolio_layout_values( $layouts ){
        unset( $layouts['default'] );
        unset( $layouts['columns'] );
        unset( $layouts['common'] );

        return $layouts;
    }
}

if( ! function_exists( 'yit_portfolio_single_layout_values' ) ){
    /**
     * Add portfolio single layout
     *
     * @param $layouts
     *
     * @return string[]
     * @since  2.0.0
     * @author Antonio La Rocca <antonio.larocca@yithems.com>
     */
    function yit_portfolio_single_layout_values( $layouts ){
        $layouts['big_image'] = __( 'Big Image', 'yit' );

        return $layouts;
    }
}

if( ! function_exists( 'init_portfolio_layouts' ) ){
    /**
     * Add portfolio single layout setup on after setup theme
     *
     * @since  2.0.0
     * @author Antonio La Rocca <antonio.larocca@yithems.com>
     */
    function init_portfolio_layouts(){
        if ( function_exists( 'YIT_Portfolio' ) ) {
            add_filter( 'yit_cptu_' . YIT_Portfolio()->portfolios_post_type . '_layout_values', 'yit_portfolio_layout_values' );
            add_filter( 'yit_cptu_' . YIT_Portfolio()->portfolios_post_type . '_single_layout_values', 'yit_portfolio_single_layout_values' );
        }
    }
}

/**
 * WORDPRESS SOCIAL PLUGIN SUPPORT
 */


global $WORDPRESS_SOCIAL_LOGIN_VERSION;
if ( isset( $WORDPRESS_SOCIAL_LOGIN_VERSION ) ) {

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
        if ( get_option( 'wsl_settings_hide_wp_login' ) == 1 ) {
            $authenticate_base_url = WORDPRESS_SOCIAL_LOGIN_PLUGIN_URL . "/services/authenticate.php?";
        }

        $provider_id   = @ $item["provider_id"];
        $provider_name = @ $item["provider_name"];

        $current_page_url = 'http';
        if ( isset( $_SERVER["HTTPS"] ) && ( $_SERVER["HTTPS"] == "on" ) ) {
            $current_page_url .= "s";
        }
        $current_page_url .= "://";
        if ( $_SERVER["SERVER_PORT"] != "80" ) {
            $current_page_url .= $_SERVER["HTTP_HOST"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        }
        else {
            $current_page_url .= $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
        }

        $authenticate_url = $authenticate_base_url . "provider=" . $provider_id . "&redirect_to=" . urlencode( $current_page_url );

        $wsl_settings_use_popup = get_option( 'wsl_settings_use_popup' );

        ob_start();

        $fix_icon_name = array(
            'live'   => 'windows',
            'yahoo!' => 'yahoo',
            'google' => 'google-plus',
        );

        if ( $wsl_settings_use_popup == 1 ) {
            ?>
            <a rel="nofollow" href="javascript:void(0);" title="Connect with <?php echo $provider_name ?>" class="wsl_connect_with_provider link_socials" data-provider="<?php echo $provider_id ?>" data-normal="#dbdbdb" data-hover="#1f1f1f">
                <i class="fa fa-<?php echo str_replace( array_keys( $fix_icon_name ), array_values( $fix_icon_name ), strtolower( $provider_id ) ) ?>" style="color:#b1b1b1; font-size: 18px"></i>
            </a>
        <?php
        }
        elseif ( $wsl_settings_use_popup == 2 ) {
            ?>
            <a rel="nofollow" href="<?php echo esc_url( $authenticate_url ) ?>" title="Connect with <?php echo $provider_name ?>" class="wsl_connect_with_provider link_socials" data-normal="#dbdbdb" data-hover="#1f1f1f">
                <i class="fa fa-<?php echo str_replace( array_keys( $fix_icon_name ), array_values( $fix_icon_name ), strtolower( $provider_id ) ) ?>" style="color:#b1b1b1; font-size: 18px"></i>
            </a>
        <?php
        }

        return ob_get_clean();

    }

    add_filter( 'wsl_alter_hook_provider_icon_markup', 'wsl_alter_hook_provider_icon_markup' );

    function yit_wsl_style() {
        global $WORDPRESS_SOCIAL_LOGIN_VERSION;

        if ( ! isset( $WORDPRESS_SOCIAL_LOGIN_VERSION ) ) {
            return;
        }

        ?>
        <style type="text/css">

            #wp-social-login-connect-options a.link_socials, .wp-social-login-widget .wp-social-login-provider-list i{
                display: inline-block;
                width: 30px;
                height: 30px;
                line-height: 32px;
                text-align: center;
                border: 1px solid #dbdbdb;
            }

            #wp-social-login-connect-options a.link_socials:hover, #wp-social-login-connect-options a.link_socials:hover i, .wp-social-login-widget .wp-social-login-provider-list i:hover {
                color: #000 !important;
                border-color: #1f1f1f;
            }

        </style>
    <?php
    }

    add_action( 'wp_head', 'yit_wsl_style' );
    add_action( 'login_head', 'yit_wsl_style' );
}


function yit_newsletter_show_placeholder( $placeholder, $shortcode ){

    if( $shortcode == 'newsletter_form'){
        return true;
    }else{
        return $placeholder;
    }

}


if( ! function_exists( 'yit_get_testimonial_list_array' ) ){
    /**
     * Get the list of testimonials
     *
     * Retrieve an array of testimonials, if the plugin is active
     *
     * @param array
     * @since  2.0.0
     * @param array $default_value | an array with the default value
     * @return Array
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     */
    function yit_get_testimonial_list_array( $default_value = array() ){
        $testimonials_list = array();
        if( function_exists( 'YIT_Testimonial' ) && is_admin() ){
            $testimonials = new WP_Query(
                array(
                    'post_type' => YIT_Testimonial()->testimonial_post_type,
                    'posts_per_page' => -1
                )
            );
            if( ! empty( $testimonials ) ){

                if( ! empty( $default_value ) ){
                    $testimonials_list = $default_value;
                }

                foreach( $testimonials->posts as $testimonial ){
                    $testimonials_list[ $testimonial->ID ] = $testimonial->post_title;
                }
            }else{
                $testimonials_list = false;
            }
        }else {
            $testimonials_list = false;
        }

        return $testimonials_list;
    }
}

if( ! function_exists( 'yit_unregister_faq_widget' ) ){
    /**
     * Unregister Faq Filter Widget
     *
     *
     * @param array
     * @since  2.0.0
     * @return void
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     */
    function yit_unregister_faq_widget(){
        if( class_exists( 'YIT_Faq_Filters' ) ) {
            unregister_widget('YIT_Faq_Filters');
        }
    }
}
add_action( 'widgets_init', 'yit_unregister_faq_widget', 20 );

if( ! function_exists( 'yit_remove_default_shortcodes' ) ){
    /**
     * Remove Swiper Slider Shortcodes from shortcodes list
     *
     *
     * @param array
     * @since  2.0.0
     * @return void
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     */

    function yit_remove_default_shortcodes( $shortcodes_list ){

        unset(
        $shortcodes_list['swiper_products_slider'],
        $shortcodes_list['lastpost'],
        $shortcodes_list['banner'],
        $shortcodes_list['review_slider']
        );

        return $shortcodes_list;
    }
}
add_filter( 'yit-shortcode-plugin-init', 'yit_remove_default_shortcodes' );

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



/* ============================== */
/* MOBILE HEADER MENU             */
/* ============================== */

function yit_mobile_menu_trigger() {
    ?>
    <!-- HEADER MENU TRIGGER -->
    <div id="mobile-menu-trigger" class="mobile-menu-trigger"><a href="#" data-effect="st-effect-4" class="glyphicon glyphicon-align-justify visible-xs"></a></div>
<?php
}
add_action( 'yit_header', 'yit_mobile_menu_trigger', 45 );


if ( class_exists( 'BuddyPress' ) ) {
    /**
     * Check version of buddypress and load js
     *
     *
     * @since  2.0.0
     * @return void
     * @author Francesco Licandro <francesco.licandro@yithemes.com>
     */

    function yit_buddypress_scripts() {

        if ( version_compare( preg_replace( '/-beta-([0-9]+)/', '', bp_get_version() ), '2.1', '<' ) ) {
            wp_dequeue_script( 'bp-parent-js' );
            wp_enqueue_script( 'yit-bp-js', YIT_URL . '/buddypress/js/buddypress-2.0.x/buddypress.js', bp_core_get_js_dependencies() );
        }
    }

    add_action( 'wp_enqueue_scripts', 'yit_buddypress_scripts', 20 );

}

/**
 * === YIW links problem fix ===
 */

if( !function_exists( 'yit_removeYIWLink_notice' ) ) {
    /**
     * Add an admin notice about the YIWLink fix
     *
     *
     * @return void
     * @author Corrado Porzio <corradoporzio@gmail.com>
     * @since 2.0
     */
    function yit_removeYIWLink_notice() { ?>

        <div id="setting-error-yit-communication" class="updated settings-error yit_removeYIWLink_notice">
            <p>
                <strong>
                    <p><?php echo __( 'Please, update your DB to use the latest version of', 'yit' ); ?> <?php echo wp_get_theme()->get( 'Name' ); ?> <?php echo __( 'theme', 'yit' ); ?>.</p>
                    <p class="action_links"><a href="#" id="yit_removeYIWLink_update"><?php echo __( 'UPDATE NOW', 'yit' ); ?></a></p>
                </strong>
            </p>
        </div> <?php
    }
}

if( !function_exists( 'yit_removeYIWLink_js' ) ) {
    /**
     * Add a js script about the YIWLink fix
     *
     *
     * @return void
     * @author Corrado Porzio <corradoporzio@gmail.com>
     * @since 2.0
     */
function yit_removeYIWLink_js() { ?>
    <script type="text/javascript">

        jQuery(document).ready(function($){

            $( '#yit_removeYIWLink_update').click(function(){

                $( ".yit_removeYIWLink_notice .action_links" ).html( '<p><i class="fa fa-refresh fa-spin"></i> <?php echo __( 'Loading', 'yit' ); ?>...</p>' );

                var data = {
                    'action': 'yit_removeYIWLink',
                    'start_update': 1
                };

                $.post( ajaxurl, data, function( response ) {
                    $( ".yit_removeYIWLink_notice .action_links" ).html( response );
                });

            });

        });

    </script> <?php
}
}

if( !function_exists( 'yit_removeYIWLink' ) ) {
    /**
     * The function that fix the YIWLink problem
     *
     *
     * @return void
     * @author Corrado Porzio <corradoporzio@gmail.com>
     * @since 2.0
     */
    function yit_removeYIWLink() {

        $start_update = intval( $_POST['start_update'] );

        if ( $start_update == 1 ) {

            yit_execute_removeYIWLink();

            set_transient( 'yit_removeYIWLink', true );
            echo '<p><i class="fa fa-check"></i> ' . __( 'Updated', 'yit' ) . '!</p>';

        }

        die();
    }
}

if ( is_admin() && false === get_transient( 'yit_removeYIWLink' ) && version_compare( wp_get_theme()->get( 'Version' ), '1.0.3', '<=')  ) {

    add_action( 'admin_notices', 'yit_removeYIWLink_notice' );
    add_action( 'admin_footer', 'yit_removeYIWLink_js' );
    add_action( 'wp_ajax_yit_removeYIWLink', 'yit_removeYIWLink' );

}


if(!function_exists('yit_execute_removeYIWLink')) {
    /**
     * The function that fix the YIWLink problem
     *
     *
     * @return void
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     * @author Andrea Frascaspata <andrea.frascaspata@yithemes.com>
     * @since 2.0
     */
    function yit_execute_removeYIWLink(){

        global $wpdb;

        $db = array(); // all backup will be in this array

        $yit_tables = yit_get_wp_tables();

        set_time_limit( 0 );

        /* === START EXPORT CONTENT === */

        // retrive all values of tables
        foreach ( $yit_tables['wp'] as $table ) {
            if ( $table == 'posts' ) {
                $where = " WHERE post_type <> 'revision'";
            }
            else {
                $where = '';
            }

            $db[$table] = $wpdb->get_results( "SELECT * FROM {$wpdb->$table}{$where}", ARRAY_A );
        }

        if ( ! empty( $yit_tables['plugins'] ) ) {
            foreach ( $yit_tables['plugins'] as $table_prefix ) {



                $tables = $wpdb->get_results( "SHOW TABLES LIKE '{$wpdb->prefix}{$table_prefix}'", ARRAY_A );
                if ( count( $tables ) != 0 ) {
                    foreach ( $tables as $key => $table_array ) {
                        foreach ( $table_array as $k => $table ) {
                            $table_no_prefix = preg_replace( "/^{$wpdb->prefix}/", '', $table );
                            $db[$table_no_prefix] = $wpdb->get_results( "SELECT * FROM {$table}", ARRAY_A );
                        }
                    }
                }
            }
        }

        $sql_options = array();
        foreach ( $yit_tables['options'] as $option ) {
            if ( strpos( $option, '%' ) !== FALSE ) {
                $operator = 'LIKE';
            }
            else {
                $operator = '=';
            }
            $sql_options[] = "option_name $operator '$option'";
        }

        $sql_options = implode( ' OR ', $sql_options );

        $sql = "SELECT option_name, option_value, autoload FROM {$wpdb->options} WHERE $sql_options;";

        $db['options'] = $wpdb->get_results( $sql, ARRAY_A );

        array_walk_recursive( $db, 'convert_yit_url' , 'in_export' );

        /* === END EXPORT CONTENT === */

        /* === START IMPORT CONTENT === */

        array_walk_recursive( $db, 'convert_yit_url', 'in_import' );

        // tables
        $tables     = array_keys( $db );
        $db_tables  = $wpdb->get_col( "SHOW TABLES" );
        $theme_name = is_child_theme() ? strtolower( wp_get_theme()->parent()->get( 'Name' ) ) : strtolower( wp_get_theme()->get( 'Name' ) );

        foreach ( $tables as $key => $table ) {

            if ( $table != 'options' && in_array( ( $wpdb->prefix . $table ), $db_tables ) ) {
                // delete all row of each table
                $wpdb->query( "TRUNCATE TABLE {$wpdb->prefix}{$table}" );

                $insert = array();
                foreach ( $db[$table] as $id => $data ) {
                    $insert[] = yit_make_insert_SQL( $data );
                }

                if ( ! empty( $db[$table] ) ) {

                    $num_rows    = count( $insert );
                    $step        = 5000;
                    $insert_step = intval( ceil( $num_rows / $step ) );
                    $fields      = implode( '`, `', array_keys( $db[$table][0] ) );

                    for ( $i = 0; $i < $insert_step; $i ++ ) {

                        $insert_row = implode( ', ', array_slice( $insert, ( $i * $step ), $step ) );
                        $wpdb->query( "INSERT INTO `{$wpdb->prefix}{$table}` ( `$fields` ) VALUES " . $insert_row );
                    }
                }
            }
            elseif ( $table == 'options' ) {

                $options_iterator = new ArrayIterator( $db[ $table ] );

                foreach ( $options_iterator as $id => $data ) {

                    if( $data['option_name'] == ( 'theme_mods_' . $theme_name ) ) {
                        $data_child = $data;
                        $data_child['option_name'] = $data_child['option_name'] . '-child';
                        $options_iterator->append( $data_child );
                    }

                    $fields  = implode( "`,`", array_keys( $data ) );
                    $values  = implode( "', '", array_values( array_map( 'esc_sql', $data ) ) );
                    $updates = '';

                    foreach ( $data as $k => $v ) {
                        $v = esc_sql( $v );
                        $updates .= "{$k} = '{$v}',";
                    }

                    $updates = substr( $updates, 0, - 1 );

                    $query = "INSERT INTO {$wpdb->prefix}{$table}
                          (`{$fields}`)
                        VALUES
                          ('{$values}')
                        ON DUPLICATE KEY UPDATE
                          {$updates};";

                    $wpdb->query( $query );
                }
            }
        }
    }
}



if( !function_exists( 'yit_make_insert_SQL' ) ) {
    /**
     * The function that fix the YIWLink problem
     *
     *
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     * @since 2.0
     */
    function yit_make_insert_SQL( $data ) {
        global $wpdb;

        $fields           = array_keys( $data );
        $formatted_fields = array();
        foreach ( $fields as $field ) {
            if ( isset( $wpdb->field_types[$field] ) ) {
                $form = $wpdb->field_types[$field];
            }
            else {
                $form = '%s';
            }
            $formatted_fields[] = $form;
        }
        $insert_data = implode( ', ', $formatted_fields );
        return $wpdb->prepare( "( $insert_data )", $data );
    }
}


if( !function_exists( 'convert_yit_url' ) ) {
    /**
     * The function that fix the YIWLink problem
     *
     *
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     * @author Andrea Frascaspata <andrea.frascaspata@yithemes.com>
     * @since 2.0
     **/
    function convert_yit_url( &$item, $key, $type ) {

        if( yit_string_is_serialized( $item ) ){
            $item = maybe_unserialize( $item );
            $item_type = 'serialized';
        }elseif( yit_string_is_json( $item ) ){
            $find =false;

            $item = json_decode( $item, true );

            $item_type = 'json_encoded';
        }else {
            $item_type = 'string';
        }

        switch ( $type ) {

            case 'in_import' :

                $upload_dir             = wp_upload_dir();
                $importer_uploads_url   = $upload_dir['baseurl'];
                $importer_site_url      = site_url();

                if ( ! is_object( $item ) && ! is_a( $item, '__PHP_Incomplete_Class' ) ) {
                    if ( is_array( $item ) ) {
                        array_walk_recursive( $item, 'convert_yit_url', $type );
                        if( $item_type == 'serialized' ){
                            $item = serialize( $item );
                        } elseif( $item_type == 'json_encoded' ) {
                            $item = json_encode( $item );
                        }
                    }
                    else {
                        $item = str_replace( '%uploadsurl%', $importer_uploads_url, $item );
                        $item = str_replace( '%siteurl%', $importer_site_url, $item );
                    }
                }
                break;

            case 'in_export' :

                yit_update_db_value('mindig',$item,$item_type,$type);

                break;
        }
    }
}


if( !function_exists( 'yit_update_db_value' ) ) {
    /**
     * The function that fix the YIWLink problem
     *
     * @author Andrea Frascaspata <andrea.frascaspata@yithemes.com>
     * @since 2.0
     */
    function yit_update_db_value($dir,&$item,$item_type,$type){

        $importer_uploads_url   = 'http://yourinspirationtheme.com/demo/'.$dir.'/files';
        $importer_site_url      = 'http://yourinspirationtheme.com/demo/'.$dir;

        if ( ! is_object( $item ) && ! is_a( $item, '__PHP_Incomplete_Class' ) ) {
            if ( is_array( $item ) ) {
                array_walk_recursive( $item, 'convert_yit_url' , $type );
                if( $item_type == 'serialized' ){
                    $item = serialize( $item );
                } elseif( $item_type == 'json_encoded' ) {
                    $item = json_encode( $item );
                }
            }
            else {
                $parsed_site_url = @parse_url( $importer_site_url );
                $item            = str_replace( $importer_uploads_url, '%uploadsurl%', $item );
                $item            = str_replace( str_replace( $parsed_site_url['scheme'] . '://' . $parsed_site_url['host'], '', $importer_uploads_url ), '%uploadsurl%', $item );
                $item            = str_replace( $importer_site_url, '%siteurl%', $item );
            }
        }
    }
}



if( !function_exists( 'yit_get_wp_tables' ) ) {
    /**
     * The function that fix the YIWLink problem
     *
     *
     * @return void
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     * @since 2.0
     */
    function yit_get_wp_tables(){
        global $wpdb;

        return apply_filters( 'yit_yiw_link_data_tables', array(
                'wp' => array(
                    'posts',
                ),

                'options' => array(
                    'yit-panel-options_mindig',
                    'widget_rss',
                    'yit-panel-options_mindig_defaults'
                ),

                'plugins' => array(),
            )
        );
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

/* Essentials Grid Plugin */
if( class_exists( 'Essential_Grid' ) ) {
    add_filter( 'yit_yiw_link_data_tables', 'yit_remove_link_add_essgrid_tables' );
}

if( ! function_exists( 'yit_remove_link_add_essgrid_tables' ) ) {
    /**
     * add Revolution Slider table to export functions
     *
     * @author   Andrea Frascaspata  <andrea.frascaspata@yithemes.com>
     *
     * @param array
     * @param $tables
     *
     * @return mixed array
     * @since    1.0.2
     */
    function yit_remove_link_add_essgrid_tables( $tables ) {
        global $wpdb;

        $tables['plugins'][] = str_replace( $wpdb->prefix, '', Essential_Grid::TABLE_GRID );

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

if( ! function_exists( 'yit_remove_ess_grid_banner' ) ) {
    /**
     * Remove the Wordpress Essential Grid Banner
     *
     *
     * @return string  The html
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     * @since 2.0
     */
    function yit_remove_ess_grid_banner() {
        update_option( 'tp_eg_valid', true );
        update_option( 'tp_eg_valid-notice', false );
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

if( ! function_exists( 'yit_deregister_style' ) ) {
    /**
     * Remove css plugin
     *
     * @author Andrea Frascaspata <andrea.frascaspata@yithemes.com>
     * @since 2.0
     */
    function yit_deregister_style() {
        // js composer shortcode fix
        wp_deregister_style( 'prettyphoto' );
    }
}
