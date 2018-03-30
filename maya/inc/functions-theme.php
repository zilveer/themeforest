<?php
/**
 * The functions of theme
 *
 * @package WordPress
 * @subpackage YIW Themes
 * @since 1.0
 */

include dirname(__FILE__) . '/infinity-portfolio.php';

// plugin managment system
include dirname(__FILE__) . '/yiw-plugin.php';

// image
include dirname(__FILE__) . '/image.php';

if ( ! function_exists( 'is_plugin_active' ) )
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

// default theme setup
function yiw_theme_setup() {
    global $wp_version;

    // This theme styles the visual editor with editor-style.css to match the theme style.
    add_editor_style( 'css/editor-style.css' );

    // Title tag
    add_theme_support( "title-tag" );

    // custonm logo

    add_theme_support( 'custom-logo', array(
        'height'      => 79,
        'width'       => 229,
        'flex-height' => true,
    ) );

    // This theme uses post thumbnails
    add_theme_support( 'post-thumbnails' );

    // This theme uses the menues
    add_theme_support( 'menus' );

    // Add default posts and comments RSS feed links to head
    add_theme_support( 'automatic-feed-links' );

    // Post Format support.
    //add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

    // Post Format support.
    //add_theme_support( 'post-formats', array( 'aside', 'gallery' ) ); // Your changeable header business starts here
    if ( ! defined( 'HEADER_TEXTCOLOR' ) )
        define( 'HEADER_TEXTCOLOR', '' );

    // No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
    if ( ! defined( 'HEADER_IMAGE' ) )
        define( 'HEADER_IMAGE', '%s/images/fixed-images/001.jpg' );

    // The height and width of your custom header. You can hook into the theme's own filters to change these values.
    // Add a filter to twentyten_header_image_width and twentyten_header_image_height to change these values.
    define( 'HEADER_IMAGE_WIDTH', apply_filters( 'yiw_header_image_width', 960 ) );
    define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'yiw_header_image_height', 338 ) );

    // We'll be using post thumbnails for custom header images on posts and pages.
    // We want them to be 940 pixels wide by 198 pixels tall.
    // Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
    //set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );
    $image_sizes = array(
        'thumb_recentposts'     => array( 55,  55,  true ),
        'thumb_testimonial'     => array( 94,  94,  true ),
        'thumb-slider-elastic'  => array( 150, 59,  true ),
        'thumb_portfolio_3cols' => array( 280, 143, true, '#portfolio li img, #portfolio li .thumb, ' ),
        'thumb_portfolio_slider'=> array( 205, 118, true, '.portfolio-slider li a img, .portfolio-slider li a, .portfolio-slider li' ),
        'thumb_portfolio_big'   => array( 617, 295, true, '#portfolio-bigimage img' ),
        'thumb_gallery'         => array( 208, 168, true, '.gallery-wrap li img, .gallery-wrap .internal_page_item' ),
        'thumb_more_projects'   => array( 86,  86,  true ),
        'blog_elegant'          => array( 450, 0,   true ),
        'blog_big'              => array( 720, 0,   true ),
        'blog_small'            => array( 288, 266, true ),
        'nivo_slider'           => array( 608, 269, true ),
        'features_tab_icon'     => array( 20,  20,  true ),
    );

    yiw_set_sizes_theme_option( $image_sizes );

    foreach ( $image_sizes as $id_size => $size )
        add_image_size( $id_size, apply_filters( 'yiw_' . $id_size . '_width', $size[0] ), apply_filters( 'yiw_' . $id_size . '_height', $size[1] ), $size[2] );

//     global $_wp_additional_image_sizes;
//     yiw_debug($_wp_additional_image_sizes);

    // Don't support text inside the header image.
    if ( ! defined( 'NO_HEADER_TEXT' ) )
        define( 'NO_HEADER_TEXT', true );

    // Add a way for the custom header to be styled in the admin panel that controls
    // custom headers. See twentyten_admin_header_style(), below.
    if( version_compare( $wp_version, '3.4', ">=" ) )
        add_theme_support( 'custom-header', array( 'admin-head-callback' => 'yiw_admin_header_style' ) );
    else
        add_custom_image_header( '', 'yiw_admin_header_style' );

    // ... and thus ends the changeable header business.

    // Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
    register_default_headers( array(
        'design1' => array(
            'url' => '%s/images/fixed-images/001.jpg',
            'thumbnail_url' => '%s/images/fixed-images/thumb/001.jpg',
            /* translators: header image description */
            'description' => __( 'Design', 'yiw' ) . ' 1'
        ),
        'design2' => array(
            'url' => '%s/images/fixed-images/002.jpg',
            'thumbnail_url' => '%s/images/fixed-images/thumb/002.jpg',
            /* translators: header image description */
            'description' => __( 'Design', 'yiw' ) . ' 2'
        ),
        'design3' => array(
            'url' => '%s/images/fixed-images/003.jpg',
            'thumbnail_url' => '%s/images/fixed-images/thumb/003.jpg',
            /* translators: header image description */
            'description' => __( 'Design', 'yiw' ) . ' 3'
        ),
        'design4' => array(
            'url' => '%s/images/fixed-images/004.jpg',
            'thumbnail_url' => '%s/images/fixed-images/thumb/004.jpg',
            /* translators: header image description */
            'description' => __( 'Design', 'yiw' ) . ' 4'
        ),
        'design5' => array(
            'url' => '%s/images/fixed-images/005.jpg',
            'thumbnail_url' => '%s/images/fixed-images/thumb/005.jpg',
            /* translators: header image description */
            'description' => __( 'Design', 'yiw' ) . ' 5'
        ),
    ) );

    $locale = get_locale();
    $locale_file = TEMPLATEPATH . "/languages/$locale.php";
    if ( is_readable( $locale_file ) )
        require_once( $locale_file );

    // This theme uses wp_nav_menu() in more locations.
    register_nav_menus(
        array(
            'nav'           => __( 'Navigation' ),
            'topbar'        => __( 'Navigation in the top bar', 'yiw' )
        )
    );

    // images size
    //add_image_size( 'thumb', 100, 100 );

    // sidebars registers
    register_sidebar( yiw_sidebar_args( 'Default Sidebar', __( 'This sidebar will be shown in all pages with empty sidebar or without any sidebat set.', 'yiw' ) ) );

    register_sidebar( yiw_sidebar_args( 'Blog Sidebar', __( 'The sidebar showed on page with Blog template', 'yiw' ) ) );
    register_sidebar( yiw_sidebar_args( 'Gallery Sidebar', __( 'The sidebar shown on Gallery pages', 'yiw' ) ) );

    register_sidebar( yiw_sidebar_args( 'Shop Sidebar', __( 'The sidebar for all shop pages', 'yiw' ) ) );
    register_sidebar( yiw_sidebar_args( 'Testimonials Sidebar', __( 'The sidebar used in Testimonials Single Template.', 'yiw'), 'widget', 'h3' ) );

    if ( is_plugin_active( 'qtranslate/qtranslate.php' ) )
        register_sidebar( yiw_sidebar_args( 'qTranslate row', __( 'The sidebar used in the topbar. ONLY For qTranslate widget.', 'yiw'), 'widget', 'h3' ) );

    do_action( 'yiw_register_sidebars' );

    // add sidebar created from plugin
    $sidebars = maybe_unserialize( yiw_get_option( 'sidebars' ) );
    if( is_array( $sidebars ) && ! empty( $sidebars ) )
    {
        foreach( $sidebars as $sidebar )
        {
            register_sidebar( yiw_sidebar_args( $sidebar, '', 'widget', 'h3' ) );
        }
    }

    // footer sidebars
    for( $i = 1; $i <= yiw_get_option( 'footer_rows', 0 ); $i++ )
        register_sidebar( yiw_sidebar_args( "Footer Row $i", __( "The widget area nr. {$i} used in Footer section", 'yiw'), 'widget', 'h3' ) );
}

/**
 * Helper function to extract the file path of the plugin file from the
 * plugin slug, if the plugin is installed.
 *
 * @param string $slug Plugin slug (typically folder name) as provided by the developer
 * @return string Either file path for plugin if installed, or just the plugin slug
 */
function _get_plugin_basename_from_slug( $slug ) {

    include_once ABSPATH . '/wp-admin/includes/plugin.php';

    $keys = array_keys( get_plugins() );

    foreach ( $keys as $key ) {
        if ( preg_match( '|^' . $slug .'|', $key ) )
            return $key;
    }

    return $slug;

}

if ( ! function_exists( 'is_woocommerce_active' ) ) {
    function is_woocommerce_active() {
        $active_plugins = (array) get_option( 'active_plugins', array() );

        if ( is_multisite() )
            $active_plugins = array_merge( $active_plugins, get_site_option( 'active_sitewide_plugins', array() ) );


        $woo = _get_plugin_basename_from_slug( 'woocommerce' );
        return in_array( $woo, $active_plugins ) || array_key_exists( $woo, $active_plugins );
    }
}

global $woocommerce;

if ( is_plugin_active( 'jigoshop/jigoshop.php' ) )
    include 'jigoshop.php';
elseif ( isset( $woocommerce ) )
    include 'woocommerce.php';

if ( ! function_exists( 'yiw_admin_header_style' ) ) :
    /**
     * Styles the header image displayed on the Appearance > Header admin panel.
     *
     * Referenced via add_custom_image_header() in twentyten_setup().
     *
     * @since Twenty Ten 1.0
     */
    function yiw_admin_header_style() {
        ?>
        <style type="text/css"> /* Shows the same border as on front end */ #headimg { border-bottom: 1px solid #000; border-top: 4px solid #000; } /* If NO_HEADER_TEXT is false, you would style the text with these selectors: #headimg #name { } #headimg #desc { } */</style>
    <?php
    }
endif;

function yiw_unregister_comments_widget( $widgets ) {
    $widgets[] = 'WP_Widget_Recent_Comments';
    return $widgets;
}
add_filter( 'yiw_exlude_widgets', 'yiw_unregister_comments_widget' );

// decide the layout of the theme, changing the class of body
function yiw_theme_layout_body_class( $classes ) {
    $classes[] = yiw_get_option( 'theme_layout', 'stretched' ) . '-layout';
    return $classes;
}
add_filter( 'body_class', 'yiw_theme_layout_body_class' );

function yiw_excerpt_text( $text, $excerpt_length = 50, $excerpt_more = '' ) {
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

function yiw_set_sizes_theme_option( &$image_sizes ) {
    foreach ( $image_sizes as $id => $size ) {
        $s = maybe_unserialize( yiw_get_option( $id ) );
        if ( isset( $s['width'] ) && ( ! empty( $s['width'] ) || $s['width'] == 0 ) && $s['width'] != $size[0] )
            $image_sizes[$id][0] = $s['width'];
        if ( isset( $s['height'] ) && ( ! empty( $s['height'] ) || $s['height'] == 0 ) && $s['height'] != $size[1] )
            $image_sizes[$id][1] = $s['height'];

        if ( isset( $size[3] ) && ! empty( $size[3] ) )
            add_action( 'yiw_custom_styles', create_function( '', "echo '$size[3] { width:".$image_sizes[$id][0]."px;height:".$image_sizes[$id][1]."px; }';" ) );
    }
}

/* product ribbons */
function yiw_product_ribbon() {
    $custom_ribbon = yiw_get_option( 'shop_products_ribbon', yiw_get_option( 'shop_products_tibbon' ) );      // retrocompatibilit�
    $custom_ribbon_added = yiw_get_option( 'shop_products_ribbon_added' );

    if ( ! empty( $custom_ribbon ) )
        echo ".products.ribbon li .buttons .add-to-cart { background-image:url('$custom_ribbon'); }";

    if ( ! empty( $custom_ribbon_added ) )
        echo ".products.ribbon li .buttons .add-to-cart.added { background-image:url('$custom_ribbon_added'); }";
}
add_action( 'yiw_custom_styles', 'yiw_product_ribbon' );

/* topbar cart ribbons */
function yiw_topbar_cart_ribbon() {
    $custom_ribbon = yiw_get_option( 'topbar_cart_ribbon' );

    if ( ! empty( $custom_ribbon ) )
        echo "#cart { background-image:url('$custom_ribbon'); }";
}
add_action( 'yiw_custom_styles', 'yiw_topbar_cart_ribbon' );


/** SLIDERS
-------------------------------------------------------------------- */


/**
 * vars for elegant slider
 */
function yiw_slider_elegant_scripts() {
    if ( yiw_slider_type() != 'elegant' )
        return;

    $easing = ( $eas = yiw_get_option( 'slider_elegant_easing') ) ? "'$eas'" : 'null';
    ?>
    <script type="text/javascript">
        var     yiw_slider_type = 'elegant',
            yiw_slider_elegant_easing = <?php echo $easing ?>,
            yiw_slider_elegant_fx = '<?php echo yiw_get_option('slider_elegant_effect') ?>', yiw_slider_elegant_speed = <?php echo yiw_get_option('slider_elegant_speed') * 1000 ?>, yiw_slider_elegant_timeout = <?php echo yiw_get_option('slider_elegant_timeout') * 1000 ?>, yiw_slider_elegant_caption_speed = <?php echo yiw_get_option('slider_elegant_caption_speed') * 1000 ?>;</script>
<?php
}

/**
 * vars for thumbnails slider
 */
function yiw_slider_thubmnails_scripts() {
    if ( yiw_slider_type() != 'thumbnails' )
        return;
    ?>
    <script type="text/javascript">
        var 	yiw_slider_type = 'thumbnails',
            yiw_slider_thumbnails_fx = '<?php yiw_slide_the('effect') ?>',
            yiw_slider_thumbnails_speed = <?php echo yiw_slide_get('speed') * 1000 ?>,
            yiw_slider_thumbnails_timeout = <?php echo yiw_slide_get('timeout') * 1000 ?>,
            yiw_slider_thumbnails_width = <?php echo apply_filters( 'slider_thumbnails_width', 960 ); ?>,
            yiw_slider_thumbnails_height = <?php echo apply_filters( 'slider_thumbnails_height', 308 ); ?>;
    </script>
<?php
}


/**
 * vars for nivo slider
 */
function yiw_slider_nivo_scripts() {
    if ( yiw_slider_type() != 'nivo' )
        return;

    ?>
    <script type="text/javascript">
        var     yiw_slider_type = 'nivo',
            yiw_slider_nivo_timeout = <?php echo yiw_get_option('slider_nivo_pause', 4) ?>  * 1000;
        yiw_slider_nivo_animspeed = <?php echo yiw_get_option('slider_nivo_speed', 0.5) ?> * 1000; yiw_slider_nivo_effect = '<?php echo yiw_get_option('slider_nivo_effect', 'fade') ?>';</script>
<?php
}


/**
 * vars for cycle slider
 */
function yiw_slider_cycle_scripts() {
    if ( yiw_slider_type() != 'cycle' )
        return;

    $easing = ( $eas = yiw_get_option( 'slider_cycle_easing') ) ? "'$eas'" : 'null';
    ?>
    <script type="text/javascript">
        var     yiw_slider_type = 'cycle',
            yiw_slider_cycle_easing = <?php echo $easing ?>,
            yiw_slider_cycle_fx = '<?php echo yiw_get_option('slider_cycle_effect', 'fade') ?>', yiw_slider_cycle_speed = <?php echo yiw_get_option('slider_cycle_speed', 0.5) * 1000 ?>, yiw_slider_cycle_timeout = <?php echo yiw_get_option('slider_cycle_timeout', 5) * 1000 ?>;</script>
<?php
}



/**
 * vars for unoslider slider
 */
function yiw_slider_unoslider_scripts() {
    if ( yiw_slider_type() != 'unoslider' )
        return;

    $next = __( 'Next', 'yiw' );
    $prev = __( 'Prev', 'yiw' );
    $play = __( 'Play', 'yiw' );
    $stop = __( 'Stop', 'yiw' );

    $responsive = yiw_get_option('responsive', 0);
    $use_preset = yiw_slide_get('use_preset');
    $presets = yiw_slide_get('preset');
    $interval = yiw_slide_get('interval');

    if ( is_serialized( $presets ) )
        $presets = unserialize( $presets );
    else if ( ! is_array( $presets ) )
        $presets = explode( ',', $presets );

    global $yiw_unoslider_animations;

    if ( empty( $presets ) )
        $presets = json_encode( array_values( $yiw_unoslider_animations ) );
    elseif ( count($presets) == 1 )
        $presets = "'" . $presets[0] . "'";
    else
        $presets = json_encode($presets);

    $booleans = array( 'autohide_indicator', 'autohide_navigation', 'autostart', 'timebar', 'pause_on_mouseover', 'continuous', 'infinite_loop' );
    foreach ( $booleans as $id )
        ${$id} = yiw_slide_get( $id ) ? 'true' : 'false';
    ?>
    <script type="text/javascript">
        var     yiw_slider_type = 'unoslider',
            yiw_slider_unoslider_theme               = '<?php yiw_slide_the('theme') ?>',
            yiw_slider_unoslider_responsive          = <?php echo $responsive ? 'true' : 'false' ?>,
            yiw_slider_unoslider_width               = <?php yiw_slide_the('width') ?>,
            yiw_slider_unoslider_height              = <?php yiw_slide_the('height') ?>,
            yiw_slider_unoslider_indicator           = <?php echo ( ! yiw_slide_get('indicator' ) ) ? 'false' : '{ autohide: ' . $autohide_indicator . ' }'  ?>,
            yiw_slider_unoslider_navigation          = <?php echo ( ! yiw_slide_get('navigation' ) ) ? 'false' : '{ autohide: ' . $autohide_navigation . ", prev: '$prev', next: '$next', play: '$play', stop: '$stop' }"  ?>,
            yiw_slider_unoslider_slideshow           = <?php echo ( ! yiw_slide_get('enable_slideshow' ) ) ? 'false' : '{ autostart: ' . $autostart . ', speed: ' . $interval . ', timer: ' . $timebar . ', hoverPause: ' . $pause_on_mouseover . ', continuous: ' . $continuous . ', infinite: ' . $infinite_loop . ' }'  ?>,
            yiw_slider_unoslider_interval            = <?php yiw_slide_the('interval') ?>,
            yiw_slider_unoslider_block               = { vertical: <?php yiw_slide_the('vertical_blocks') ?>, horizontal: <?php yiw_slide_the('horizontal_blocks') ?> },
            yiw_slider_unoslider_preset              = <?php if ( $use_preset ) echo $presets; else echo 'false' ?>,
            yiw_slider_unoslider_animation           = { speed : <?php yiw_slide_the('speed') ?>, delay : <?php yiw_slide_the('delay_blocks') ?><?php if ( ! $use_preset ) : ?>, transition : '<?php yiw_slide_the('transition') ?>', variation : '<?php yiw_slide_the('variation') ?>', pattern : '<?php yiw_slide_the('pattern') ?>', direction : '<?php yiw_slide_the('direction') ?>'<?php endif; ?> };
    </script>
<?php
}


/**
 * vars for elastic slider
 */
function yiw_slider_elastic_scripts() {
    if ( yiw_slider_type() != 'elastic' )
        return;
    ?>
    <script type="text/javascript">
        var     yiw_slider_type = 'elastic',
            yiw_slider_elastic_speed = <?php echo yiw_slide_get('speed') * 1000 ?>,
            yiw_slider_elastic_timeout = <?php echo yiw_slide_get('timeout') * 1000 ?>, yiw_slider_elastic_autoplay = <?php echo yiw_slide_get('autoplay') ? 'true' : 'false' ?>, yiw_slider_elastic_animation = '<?php yiw_slide_the('animation') ?>';</script>
<?php
}



if( !is_admin() ) {
    add_action( 'wp_print_scripts', 'yiw_slider_elegant_scripts' );
    add_action( 'wp_print_scripts', 'yiw_slider_cycle_scripts' );
    add_action( 'wp_print_scripts', 'yiw_slider_unoslider_scripts' );
    add_action( 'wp_print_scripts', 'yiw_slider_elastic_scripts' );
    add_action( 'wp_print_scripts', 'yiw_slider_nivo_scripts' );
    add_action( 'wp_print_scripts', 'yiw_slider_thubmnails_scripts' );
}


function yiw_slider_elastic_height() {
    ?>.ei-slider {height:<?php echo yiw_get_option('slider_elastic_height') ?>px;}<?php
} add_action( 'yiw_custom_styles', 'yiw_slider_elastic_height' ); /** * Different excerpt size * * @return int */ function yiw_excerpt_length() { return 10; } function yiw_news_excerpt_length() { return 15; } /** * Different excerpt more text * * @return string */ function yiw_excerpt_more() { return '...'; } /** * Echo the excerpt with specific number of words * * @param int|string $limit * @param string $more_text * * @return string */ function yiw_excerpt( $limit = 25, $more_text = '', $echo = true ) { $limit_cb = create_function( '', "return $limit;" ); $moret_cb = create_function( '', "return '$more_text';" ); add_filter( 'excerpt_length', $limit_cb ); add_filter( 'excerpt_more', $moret_cb ); if ( $echo ) the_excerpt(); else return get_the_excerpt(); remove_filter( 'excerpt_length', $limit_cb ); remove_filter( 'excerpt_more', $moret_cb ); } function yiw_prettyphoto_style() { ?>
    <script type="text/javascript">
        var yiw_prettyphoto_style = '<?php echo yiw_get_option('portfolio_skin_lightbox') ?>';
    </script>
<?php
}
add_action( 'wp_print_scripts', 'yiw_prettyphoto_style' );


/**
 * Get Page ID by page name
 *
 * @param string $page_name
 *
 * @return string|int
 */
function yiw_get_pageID_by_pagename( $page_name ) {
    global $wpdb;
    return $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '$page_name'");
}


/**
 * Return icon path by filename
 *
 * @param string $icon
 * @param string $size
 *
 * @return string
 */
function yiw_get_url_icon($icon, $size = 32)
{
    global $icons_name;

    $path = "/images/icons/{$icon}{$size}.png";

    if( file_exists( STYLESHEETPATH . $path ) )
        return get_template_directory_uri() . "/images/icons/{$icon}{$size}.png";
    else
        return get_template_directory_uri() . "/images/icons/{$icon}.png";
}


/**
 * Return post content with read more link (if needed)
 *
 * @param int|string $limit
 * @param string $more_text
 *
 * @return string
 */
function yiw_content( $what = 'content', $limit = 25, $more_text = '' ) {
    if ( $what == 'content' )
        $content = get_the_content();
    else if ( $what == 'excerpt' )
        $content = get_the_excerpt();

    if ( empty( $content ) ) return;
    $content = explode( ' ', $content );
    /*
        if ( count( $content ) >= $limit ) {
            array_pop( $content );
            if( $more_text != "" )
                $readmore = implode( " ", $content ) . '<a class="read-more" href="' . get_permalink() . '">' . $more_text . '</a>';
            else
                $content = implode( " ", $content ) . ' &#91;...&#93;';
        } else
            $content = implode( " ", $content );
    */
    if ( ! empty( $more_text ) ) {
        array_pop( $content );
        $more_text = '<a class="read-more" href="' . get_permalink() . '">' . $more_text . '</a>';
    }

    // split
    if ( count( $content ) >= $limit ) {
        $split_content = '';
        for ( $i = 0; $i < $limit; $i++ )
            $split_content .= $content[$i] . ' ';

        $content = $split_content . '...';
    } else {
        $content = implode( " ", $content );
    }

    // TAGS UNCLOSED
    $tags = array();
    // get all tags opened
    preg_match_all("/(<([\w]+)[^>]*>)/", $content, $tags_opened, PREG_SET_ORDER);
    foreach ( $tags_opened as $tag )
        $tags[] = $tag[2];

    // get all tags closed and remove it from the tags opened.. the rest will be closed at the end of the content
    preg_match_all("/(<\/([\w]+)[^>]*>)/", $content, $tags_closed, PREG_SET_ORDER);
    foreach ( $tags_closed as $tag )
        unset( $tags[ array_search( $tag[2], $tags ) ] );

    // close the tags
    if ( ! empty( $tags ) )
        foreach ( $tags as $tag )
            $content .= "</$tag>";

    $content = preg_replace( '/\[.+\]/', '', $content );
    $content = preg_replace( '/<img[^>]+./', '', $content ); //remove images
    $content = apply_filters( 'the_content', $content );
    $content = str_replace( ']]>', ']]&gt;', $content );

    return $content.$more_text;
}


/**
 * Return the page breadcrumbs
 *
 */
function the_breadcrumb() {
    //if ( is_page_with_breadcrumb() ) :

    $delimiter = ' > ';
    $home = __( 'Home Page', 'yiw' ); // text for the 'Home' link
    $before = '<a class="no-link current" href="#">'; // tag before the current crumb
    $after = '</a>'; // tag after the current crumb

    if ( !is_home() && !is_front_page() || is_paged() ) {

        echo '<div id="crumbs" class="theme_breadcumb">';

        global $post;
        $homeLink = site_url();
        echo '<a class="home" href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';

        if ( is_category() ) {
            global $wp_query;
            $cat_obj = $wp_query->get_queried_object();
            $thisCat = $cat_obj->term_id;
            $thisCat = get_category($thisCat);
            $parentCat = get_category($thisCat->parent);
            if ( $thisCat->parent != 0 )
                echo get_category_parents( $parentCat, TRUE, ' ' . $delimiter . ' ' );
            echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;

        } elseif ( is_day() ) {
            echo '<a class="no-link" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
            echo '<a class="no-link" href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
            echo $before . get_the_time('d') . $after;

        } elseif ( is_month() ) {
            echo '<a class="no-link" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
            echo $before . get_the_time('F') . $after;

        } elseif ( is_year() ) {
            echo $before . get_the_time('Y') . $after;

        } elseif ( is_single() && !is_attachment() ) {
            if ( get_post_type() != 'post' ) {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                echo '<a class="no-link" href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
                echo $before . get_the_title() . $after;
            } else {
                $cat = get_the_category(); $cat = $cat[0];
                echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                echo $before . get_the_title() . $after;
            }

        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
            $post_type = get_post_type_object(get_post_type());
            echo $before . $post_type->labels->singular_name . $after;

        } elseif ( is_attachment() ) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID); $cat = $cat[0];
            echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
            echo '<a class="no-link" href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
            echo $before . get_the_title() . $after;

        } elseif ( is_page() && !$post->post_parent ) {
            echo $before . get_the_title() . $after;

        } elseif ( is_page() && $post->post_parent ) {
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            while ( $parent_id ) {
                $page = get_post($parent_id);
                $breadcrumbs[] = '<a class="no-link" href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                $parent_id  = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            foreach ( $breadcrumbs as $crumb )
                echo $crumb . ' ' . $delimiter . ' ';
            echo $before . get_the_title() . $after;

        } elseif ( is_search() ) {
            echo $before . 'Search results for "' . get_search_query() . '"' . $after;

        } elseif ( is_tag() ) {
            echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;

        } elseif ( is_author() ) {
            global $author;
            $userdata = get_userdata($author);
            echo $before . 'Articles posted by ' . $userdata->display_name . $after;

        } elseif ( is_404() ) {
            echo $before . 'Error 404' . $after;
        }

        if ( yiw_is_paged() ) {
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() )
                echo ' (';
            echo $before . __('Page', 'yiw') . ' ' . yiw_get_post_current_page() . $after;
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() )
                echo ')';
        }

        echo '<div class="breadcrumb-end"></div>';
        echo '</div>';

    }

    //endif;
}

/**
 * Add a message if you have selected an image that it's not existing
 */
function yiw_message_bg_image_missing() {
    $image_path = yiw_get_option( 'body_bg_image', 'custom' );

    if ( yiw_get_option( 'body_bg_type' ) == 'color-unit' || $image_path == 'custom' || file_exists( dirname(__FILE__) . '/../' . $image_path ) )
        return;

    echo '<div id="message" class="error">';
    _e( "Since this theme version, some body backgrounds images are removed. Please, check again in Theme Options -> Colors, to choose your favourite background.",'yiw');
    echo '</div>';
}
add_action('admin_notices', 'yiw_message_bg_image_missing');

/**
 * Add style of body
 *
 * @since 1.0
 */
function yiw_body_style() {

// 	if ( yiw_get_option( 'theme_layout' ) != 'boxed' )
// 		return;

    $role = '';

    $bg_type = yiw_get_option( 'body_bg_type' );
    $color_bg = yiw_get_option( 'body_bg_color' );

    switch ( $bg_type ) {

        case 'color-unit' :
            $role = 'background:' . $color_bg . ';';
            break;

        case 'bg-image' :
            $image = yiw_get_option( 'body_bg_image', 'custom' );

            // image
            if ( $image != 'custom' ) {
                $url_image = get_template_directory_uri() . '/' . $image;
                $position = 'top center';
                $repeat = 'repeat';
                $attachment = 'fixed';
            } else {
                $url_image = esc_url( yiw_get_option( 'body_bg_image_custom', '' ) );
                $position = yiw_get_option( 'body_bg_image_custom_position' );
                $repeat = yiw_get_option( 'body_bg_image_custom_repeat' );
                $attachment = yiw_get_option( 'body_bg_image_custom_attachment' );
            }

            if ( $url_image != '' )
                $url_image = " url('$url_image')";

            $attrs = array(
                "background-color: $color_bg",
                "background-image: $url_image",
                "background-position: $position",
                "background-repeat: $repeat",
                "background-attachment: $attachment"
            );

            $role = implode( ";\n", $attrs );
            break;
    }
    ?>

    body, .stretched-layout .wrapper {
    <?php echo $role ?>
    }
<?php
}
add_action( 'yiw_custom_styles', 'yiw_body_style' );


/**
 * Add style of header
 *
 * @since 1.0
 */
function yiw_header_style() {
    $role = '';

    $bg_type = yiw_get_option( 'header_bg_type' );
    $color_bg = yiw_get_option( 'header_bg_color' );
    $header_opacity = yiw_get_option( 'header_opacity', 1 );

    if ( ! empty( $color_bg ) && $header_opacity != 1 ) {
        $header_bg = str_replace( '#', '', $color_bg );

        if ( strlen( $color_bg ) == 3 ) {
            $color_bg = $color_bg{0}.$color_bg{0}.$color_bg{1}.$color_bg{1}.$color_bg{2}.$color_bg{2};
        }

        //break up the color in its RGB components
        $r = hexdec(substr($color_bg,0,2));
        $g = hexdec(substr($color_bg,2,2));
        $b = hexdec(substr($color_bg,4,2));

        $color_bg = "rgba($r,$g,$b,0.$header_opacity)";
    }

    switch ( $bg_type ) {

        case 'color-unit' :
            $role = '#header { background:' . $color_bg . '; }';
            break;

        case 'bg-image' :
            $image = yiw_get_option( 'header_bg_image' );

            // image
            $url_image = yiw_get_option( 'header_bg_image_custom' );
            $position = yiw_get_option( 'header_bg_image_custom_position' );
            $repeat = yiw_get_option( 'header_bg_image_custom_repeat' );

            $uploads = wp_upload_dir();
            $url_image = str_replace( '%siteurl%', site_url(), $url_image );
            $url_image = str_replace( '%templateurl%', get_template_directory_uri(), $url_image );
            $url_image = str_replace( '%contentsurl%', $uploads['baseurl'], $url_image );

            if ( empty( $url_image ) ) {
                if ( ! empty( $color_bg ) ) $role = '#header { background:' . $color_bg . '; }';
            } else {
                $role = '#header { background:' . $color_bg . ' url(\'' . $url_image . '\') ' . $repeat . ' ' . $position . '; }';
            }

            break;

    }

    echo $role;
}
add_action( 'yiw_custom_styles', 'yiw_header_style' );


/**
 * Add style of body
 *
 * @since 1.1.1
 */
/*function yiw_content_style() {

	if ( yiw_get_option( 'theme_layout' ) != 'boxed' )
            return;

	$color_bg = yiw_get_option( 'content_bg_color' );

	if ( $color_bg == '' || $color_bg == '#fff' || $color_bg == '#ffffff' )
	   return;

        ?>
        .boxed-layout .wrapper{
            background-color: <?php echo $color_bg ?>;
        }
        <?php
}
add_action( 'yiw_custom_styles', 'yiw_content_style' );*/




/** ADMIN
-------------------------------------------------------------------- */

// add new type to theme options
function yiw_select_with_header_preview( $value ) {

    if ( isset( $value['id'] ) )
        $id_container = 'id="' . $value['id'] . '-option" ';

    // deps
    if ( isset( $value['deps'] ) ) {
        $value['deps']['id_input'] = yiw_option_id( $value['deps']['id'], false );
        $deps[ $value['id'] ] = $value['deps'];
        $class_dep = ' yiw-deps';
        $fade_color_dep = '<div class="fade_color"></div>';
    }
    ?>
    <div <?php echo $id_container ?>class="rm_option rm_input rm_select<?php echo $class_dep ?> rm_with_preview"> <label for="<?php yiw_option_id( $value['id'] ); ?>"><?php echo $value['name']; ?></label> <select name="<?php yiw_option_name( $value['id'] ); ?>" id="<?php yiw_option_id( $value['id'] ); ?>" <?php if( isset( $value['button'] ) ) : ?>style="width:240px;" <?php endif ?>><?php foreach ($value['options'] as $val => $option) { ?> <option value="<?php echo $val ?>" <?php selected( yiw_get_option( $value['id'], $value['std'] ), $val ) ?>><?php echo $option; ?></option><?php } ?></select><?php if( isset( $value['button'] ) ) : ?> <input type="submit" value="<?php echo $value['button']; ?>" class="button" name="<?php yiw_option_id( $value['id'] ); ?>_save" id="<?php yiw_option_id( $value['id'] ); ?>_save"><?php endif ?> <small><?php echo $value['desc']; ?></small><div class="clearfix"></div><?php $style = ( $value['std'] == 'custom' ) ? ' style="display:none;"' : ''; ?>
        <div class="preview"<?php echo $style ?>><img class="min" src="<?php echo get_template_directory_uri() . '/' . yiw_get_option( $value['id'], $value['std'] ) ?>" title="<?php _e( 'Click to expand the image to the natural size', 'yiw' ) ?>" /></div>
        <script type="text/javascript">
            jQuery(document).ready(function($){
                var select = $('#<?php yiw_option_id( $value['id'] ); ?>');
                var preview = $('#<?php echo $value['id'] ?>-option .preview'); var change_preview = function(){ var value = select.val(); if ( value != 'custom' ) { preview.find('img').attr('src', '<?php echo get_template_directory_uri() . '/'; ?>'+value); preview.show(); } else { preview.hide(); } }; select.change(change_preview).keypress(change_preview); preview.find('img').click(function(){ $(this).toggleClass('min'); if ( $(this).hasClass('min') ) $(this).attr('title', '<?php _e( 'Click to expand the image to the natural size', 'yiw' ) ?>'); else $(this).attr('title', '<?php _e( 'Click to minimize the image', 'yiw' ) ?>'); }); });</script></div>
<?php
}
add_action( 'yiw_panel_type_header_preview', 'yiw_select_with_header_preview' );

// add new type to theme options
function yiw_select_with_bg_preview( $value ) {

    if ( isset( $value['id'] ) )
        $id_container = 'id="' . $value['id'] . '-option" ';

    // deps
    if ( isset( $value['deps'] ) ) {
        $value['deps']['id_input'] = yiw_option_id( $value['deps']['id'], false );
        $deps[ $value['id'] ] = $value['deps'];
        $class_dep = ' yiw-deps';
        $fade_color_dep = '<div class="fade_color"></div>';
    }
    ?>
    <div <?php echo $id_container ?>class="rm_option rm_input rm_select<?php echo $class_dep ?> rm_with_preview rm_with_bg_preview"> <label for="<?php yiw_option_id( $value['id'] ); ?>"><?php echo $value['name']; ?></label> <select name="<?php yiw_option_name( $value['id'] ); ?>" id="<?php yiw_option_id( $value['id'] ); ?>" <?php if( isset( $value['button'] ) ) : ?>style="width:240px;" <?php endif ?>><?php foreach ($value['options'] as $val => $option) { ?> <option value="<?php echo $val ?>" <?php selected( yiw_get_option( $value['id'], $value['std'] ), $val ) ?>><?php echo $option; ?></option><?php } ?></select><?php if( isset( $value['button'] ) ) : ?> <input type="submit" value="<?php echo $value['button']; ?>" class="button" name="<?php yiw_option_id( $value['id'] ); ?>_save" id="<?php yiw_option_id( $value['id'] ); ?>_save"><?php endif ?> <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
        <?php
        $url = get_template_directory_uri().'/'.yiw_get_option( $value['id'], $value['std'] );
        $color = yiw_get_option( $value['id_colors'] );

        $style = array(
            "background-color:$color;",
            "background-image:url('$url');",
            "background-position:top center;"
        );
        $style = implode( '', $style );

        $style_preview = ( yiw_get_option( $value['id'], $value['std'] ) == 'custom' ) ? ' style="display:none"' : '';
        ?>
        <div class="preview"<?php echo $style_preview ?>><div class="img" style="<?php echo $style ?>"></div></div>
        <script type="text/javascript">
            jQuery(document).ready(function($){
                var select = $('#<?php yiw_option_id( $value['id'] ); ?>');
                var text_color = $('#<?php yiw_option_id( $value['id_colors'] ); ?>'); var preview = $('#<?php echo $value['id'] ?>-option .preview'); preview.css('cursor', 'pointer').attr('title', '<?php _e( 'Click here to update the color selected above', 'yiw' ) ?>'); select.change(function(){ var value = $(this).val(); if ( value != 'custom' ) { $('.img', preview).css({'background-image':'url(<?php echo get_template_directory_uri() . '/'; ?>'+value+')'}); preview.show(); } else { preview.hide(); } }); preview.click(function(){ var value = text_color.val(); $('.img', preview).css({'background-color':value}); }); });</script></div>
<?php
}
add_action( 'yiw_panel_type_bg_preview', 'yiw_select_with_bg_preview' );

function yiw_select_skin_option_type( $value ) {
    if ( isset( $value['id'] ) )
        $id_container = 'id="' . $value['id'] . '-option" ';
    ?>
    <div <?php echo $id_container ?>class="rm_option rm_input rm_select"> <label for="<?php yiw_option_id( $value['id'] ); ?>"><?php echo $value['name']; ?></label> <select name="<?php yiw_option_name( $value['id'] ); ?>" id="<?php yiw_option_id( $value['id'] ); ?>" <?php if( isset( $value['button'] ) ) : ?>style="width:240px;" <?php endif ?>><?php foreach ($value['options'] as $val => $option) { ?> <option value="<?php echo $val ?>" <?php selected( yiw_get_option( $value['id'], $value['std'] ), $val ) ?>><?php echo $option; ?></option><?php } ?></select><?php if( isset( $value['button'] ) ) : ?> <input type="submit" value="<?php echo $value['button']; ?>" class="button" name="<?php yiw_option_id( $value['id'] ); ?>_save" id="<?php yiw_option_id( $value['id'] ); ?>_save"><?php endif ?> <input type="hidden" name="yiw-callback-save" value="yiw_select_skins_option" /> <small><?php echo $value['desc']; ?></small><div class="clearfix"></div></div>
<?php
}
add_action( 'yiw_panel_type_select_skin', 'yiw_select_skin_option_type' );

function yiw_select_skins_option() {
    global $yiw_theme_options, $yiw_colors, $yiw_skins;

    $selected_skin = yiw_post_option( 'select_skin' );
    if( $selected_skin == '' || $selected_skin == yiw_get_option( 'select_skin' ) )
        return;

    $tab = yiw_get_current_tab();

    $skin_code = unserialize( base64_decode( file_get_contents( dirname(__FILE__) . '/../skins/' . $selected_skin . '.txt' ) ) );

    // esclude le opzioni che non servono alle skin
    $exclude = yiw_options_of_tab( array( 'sliders', 'contact', 'sliders', 'accordions', 'sections', 'sidebars', 'general' => array( 'responsive', 'images', 'footer' ) ) );
    $exclude = array_merge( $exclude, array(
        'favicon',
        'date_format',
        'logo',
        'logo_width',
        'logo_height',
        'use_logo',
        'logo_use_description',
        'slider_unoslider_slides',
        'slider_sheeva_slides',
        'slider_elegant_slides',
        'slider_cycle_slides',
        'slider_elastic_slides'
    ) );

    $defaults = yiw_get_default_options();

    foreach ( $exclude as $id )
        if ( isset( $skin_code[$id] ) )
            unset( $skin_code[$id], $defaults[$id] );

    //yiw_debug($skin_code);

//     // the slides already existing
//     $slides = maybe_unserialize( yiw_get_option( 'slider_'.$skin[$selected_skin]['slider_type'].'_slides' ) );
//
//     // if there are already some images into the slider, doesn't add the default images
//     if ( ! empty( $slides ) )
//         unset( $skin[$selected_skin]['slider_'.$skin[$selected_skin]['slider_type'].'_slides'] );
//
//     // retrieve the default color for the navigation
//     foreach ( $yiw_colors[$skin[$selected_skin]['nav_type'].'-navigation']['options'] as $color_id => $value )
//         $skin[$selected_skin]['colors_'.$color_id] = $value['default'];

    $skin_code = wp_parse_args( $skin_code, $defaults );
    $yiw_theme_options = wp_parse_args( $skin_code, $yiw_theme_options );

    // save the skin selected
    $yiw_theme_options['select_skin'] = $selected_skin;

    //yiw_debug( $defaults );

    yiw_update_theme_options();

    $url = admin_url( 'themes.php' ) . "?page=$_GET[page]&tab=$tab&message=saved";
    yiw_end_process( $url );
    die;
}

function yiw_array_splice_assoc( &$source, $need, $previous ) {
    $return = array();

    foreach( $source as $key => $value ) {
        if( $key == $previous ) {
            $keys = array_keys( $need );
            $key_need = array_shift( $keys );
            $value_need = $need[$key_need];

            $return[$key_need] = $value_need;
        }

        $return[$key] = $value;
    }

    $source = $return;
}

/**
 * Set the configuration for the product sliders shortcode
 */
function yiw_product_slider_configuration() {
    $sec = yiw_get_option('shop_product_slider_interval', 6);
    if ( ! yiw_get_option('shop_product_slider_autoplay') )
        $sec = 0;
    ?>
    <script type="text/javascript">
        var     yiw_product_slider_interval = <?php echo $sec; ?>;</script>
<?php
}
add_action( 'wp_print_scripts', 'yiw_product_slider_configuration' );


/**
 * Return the absolute position of an object
 *
 * @since 1.0
 */
function yiw_slide_get_style( $style ) {
    $return = '';

    foreach( $style as $p => $v ) {
        if($v!='') $return .= $p . ':' . $v . 'px;';
    }

    return $return;
}

/**
 * Return the brigthness of a color
 *
 * @return bool TRUE = is brigth; FALSE = is dark
 */
function yiw_is_bright( $hex ) {
    $hex = str_replace( '#', '', $hex );

    //break up the color in its RGB components
    $r = hexdec(substr($hex,0,2));
    $g = hexdec(substr($hex,2,2));
    $b = hexdec(substr($hex,4,2));

    //do simple weighted avarage
    //
    //(This might be overly simplistic as different colors are perceived
    // differently. That is a green of 128 might be brighter than a red of 128.
    // But as long as it's just about picking a white or black text color...)
    if($r + $g + $b > 382){
        return true; //bright color, use dark font
    }else{
        return false; //dark color, use bright font
    }
}


/********************************************************/
/*                 LayerSlider get sliders              */
/********************************************************/

function layerslider_get_sliders() {

    // Get WPDB Object
    global $wpdb;

    // Table name
    $table_name = $wpdb->prefix . "layerslider";

    if ( $wpdb->get_var("SHOW TABLES LIKE '$table_name'") == null ) {
        return;
    }

    $slides = $wpdb->get_results("SELECT * FROM $table_name
								  WHERE flag_hidden = '0'
								  AND flag_deleted = '0'
								  ORDER BY date_c DESC" );

    if ( ! is_array( $slides ) || empty( $slides ) )
        return array();

    foreach ( $slides as $slide )
        $sliders[ $slide->id ] = empty( $slide->name ) ? 'Unamed' : $slide->name;
    return $sliders;
}
// function yiw_import_slider_layers_options( $options ) {
//     $options[] = 'layerslider_slides';
//     return $options;
// }
// add_filter( 'yiw_sample_data_options', 'yiw_import_slider_layers_options' );


function yiw_add_layerslider_tables( $tables ) {
    $tables[] = 'layerslider';
    return $tables;
}
add_filter( 'yit_sample_data_tables', 'yiw_add_layerslider_tables' );


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
        case 'pingback'  :
        case 'trackback' :
            ?>
            <li class="post pingback"><p><?php _e( 'Pingback:', 'yiw' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'yiw'), ' ' ); ?></p>
            <?php
            break;

        default :
            ?>
            <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><div id="comment-<?php comment_ID(); ?>" class="comment-container group"><div class="comment-author vcard"><?php echo get_avatar( $comment, 55 ); ?><div class="intro"><?php printf( __( '%s', 'yiw' ), sprintf( '<span class="fn"><cite >%s</cite> '.__( 'says', 'yiw' ).':</span>', get_comment_author_link() ) ); ?> <a class="commentDate" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                                <?php
                                /* translators: 1: date, 2: time */
                                printf( __( '%1$s', 'yiw' ), get_comment_date() ); ?></a><br />
                            <?php edit_comment_link( __( '(Edit)', 'yiw' ), ' ' );?></div></div><!-- .comment-author .vcard --><div class="comment-meta commentmetadata"><?php if ( $comment->comment_approved == '0' ) : ?> <em class="moderation"><?php _e( 'Your comment is awaiting moderation.', 'yiw' ); ?></em> <br /><?php endif; ?><div class="comment-body"><?php comment_text(); ?></div><div class="reply group"><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></div><!-- .reply --></div><!-- .comment-meta .commentmetadata --></div><!-- #comment-##  -->
            <?php
            break;
    endswitch;
}

function yiw_holiday() {
    if( !yiw_get_option( 'in_vacation' ) ) {
        return false;
    }

    switch( yiw_get_option( 'in_vacation_style' ) ) {
        case 'general'  :
            echo "#vacation{ background: url(" . get_template_directory_uri() . "/images/vacation/general.png) no-repeat top center; }";
            echo "#vacation, #vacation p, #vacation li{ color: #323030; }";
            echo "#vacation span, #vacation p  span, #vacation li  span{ color: #950707; }";
            break;
        case 'christmas':
            echo "#vacation{ background: url(" . get_template_directory_uri() . "/images/vacation/christmas.png) no-repeat top center; }";
            echo "#vacation, #vacation p, #vacation li{ color: #fff; }";
            echo "#vacation span, #vacation p  span, #vacation li  span{ color: #fff; }";
            break;
        case 'summer'   :
            echo "#vacation{ background: url(" . get_template_directory_uri() . "/images/vacation/summer.png) no-repeat top center; }";
            echo "#vacation, #vacation p, #vacation li{ color: #374e56; }";
            echo "#vacation span, #vacation p  span, #vacation li  span{ color: #188eba; }";
            break;
        case 'custom'   :
            echo "#vacation{ background: url(" . yiw_get_option( 'in_vacation_bg' ) . ") no-repeat top center; }";
            break;
    }
}
add_action( 'yiw_custom_styles', 'yiw_holiday' );

// Register slides texts to translation
function wpml_slides_translation() {
    $sliders = array( 'elegant', 'flash', 'rotating', 'thumbnails', 'nivo', 'cycle', 'unoslider' );

    foreach( $sliders as $slider => $name ) {
        $slides = maybe_unserialize( yiw_get_option( 'slider_' . $name . '_slides' ) );

        if ( !empty( $slides ) ) {
            foreach( $slides as $k => $slide ) {
                if( isset( $slides[$k]['slide_title'] ) ) { $slides[$k]['slide_title'] = icl_register_string( 'yiw',  $name . '_slide_' . $k . '_slide_title', $slide['slide_title'] ); }
                if( isset( $slides[$k]['tooltip_content'] ) ) { $slides[$k]['tooltip_content'] = icl_register_string( 'yiw', $name . '_slide_' . $k . '_tooltip_content', $slide['tooltip_content'] ); }
                if( isset( $slides[$k]['extra_tooltip_content'] ) ) { $slides[$k]['extra_tooltip_content'] = icl_register_string( 'yiw', $name . '_slide_' . $k . '_extra_tooltip_content', $slide['extra_tooltip_content'] ); }
                if( isset( $slides[$k]['image_url'] ) ) { $slides[$k]['image_url'] = icl_register_string( 'yiw', $name . '_slide_' . $k . '_image_url', $slide['image_url'] ); }
                if( isset( $slides[$k]['url_video'] ) ) { $slides[$k]['url_video'] = icl_register_string( 'yiw', $name . '_slide_' . $k . '_url_video', $slide['url_video'] ); }
                if( isset( $slides[$k]['extra_tooltip_image'] ) ) { $slides[$k]['extra_tooltip_image'] = icl_register_string( 'yiw', $name . '_slide_' . $k . '_extra_tooltip_image', $slide['extra_tooltip_image'] ); }
                if( isset( $slides[$k]['extra_tooltip_url'] ) ) { $slides[$k]['extra_tooltip_url'] = icl_register_string( 'yiw', $name . '_slide_' . $k . '_extra_tooltip_url', $slide['extra_tooltip_url'] ); }
                if( isset( $slides[$k]['extra_tooltip_x_pos'] ) ) { $slides[$k]['extra_tooltip_x_pos'] = icl_register_string( 'yiw', $name . '_slide_' . $k . '_extra_tooltip_x_pos', $slide['extra_tooltip_x_pos'] ); }
                if( isset( $slides[$k]['extra_tooltip_y_pos'] ) ) { $slides[$k]['extra_tooltip_y_pos'] = icl_register_string( 'yiw', $name . '_slide_' . $k . '_extra_tooltip_y_pos', $slide['extra_tooltip_y_pos'] ); }
            }
        }
    }
}

// Filter the slide title for the current language
function wpml_slide_title( $slide_title ) {
    $sliders = array( 'elegant', 'flash', 'rotating', 'thumbnails', 'nivo', 'cycle', 'unoslider' );

    foreach( $sliders as $slider ) {
        $slides = maybe_unserialize( yiw_get_option( 'slider_' . $slider . '_slides' ) );

        foreach( ( array ) $slides as $k => $slide ) {
            if ( isset( $slide['slide_title'] ) && $slide['slide_title'] == $slide_title ) {
                $slide_title = icl_t( 'yiw', $slider . '_slide_' . $k . '_slide_title', $slide['slide_title'] );
            }
        }
    }

    return $slide_title;
}

// Filter the slide content for the current language
function wpml_tooltip_content( $tooltip_content ) {
    $sliders = array( 'elegant', 'flash', 'rotating', 'thumbnails', 'nivo', 'cycle', 'unoslider' );

    foreach( $sliders as $slider ) {
        $slides = maybe_unserialize( yiw_get_option( 'slider_' . $slider . '_slides' ) );

        foreach( ( array ) $slides as $k => $slide ) {
            if ( isset( $slide['tooltip_content'] ) && $slide['tooltip_content'] == $tooltip_content ) {
                $tooltip_content = icl_t( 'yiw', $slider . '_slide_' . $k . '_tooltip_content', $slide['tooltip_content'] );
            }
        }
    }

    return $tooltip_content;
}

// Filter the slide image URL for the current language
function wpml_image_url( $image_url ) {
    $sliders = array( 'elegant', 'flash', 'rotating', 'thumbnails', 'nivo', 'cycle', 'unoslider' );

    foreach( $sliders as $slider ) {
        $slides = maybe_unserialize( yiw_get_option( 'slider_' . $slider . '_slides' ) );

        foreach( ( array ) $slides as $k => $slide ) {
            if ( isset( $slide['image_url'] ) && $slide['image_url'] == $image_url ) {
                $image_url = icl_t( 'yiw', $slider . '_slide_' . $k . '_image_url', $slide['image_url'] );
            }
        }
    }

    return $image_url;
}

function wpml_extra_tooltip_content( $extra_tooltip_content ) {
    $sliders = array( 'elegant', 'flash', 'rotating', 'thumbnails', 'nivo', 'cycle', 'unoslider' );

    foreach( $sliders as $slider ) {
        $slides = maybe_unserialize( yiw_get_option( 'slider_' . $slider . '_slides' ) );

        foreach( ( array ) $slides as $k => $slide ) {
            if ( isset( $slide['extra_tooltip_content'] ) && $slide['extra_tooltip_content'] == $extra_tooltip_content ) {
                $extra_tooltip_content = icl_t( 'yiw', $slider . '_slide_' . $k . '_extra_tooltip_content', $slide['extra_tooltip_content'] );
            }
        }
    }

    return $extra_tooltip_content;
}

function wpml_url_video( $url_video ) {
    $sliders = array( 'elegant', 'flash', 'rotating', 'thumbnails', 'nivo', 'cycle', 'unoslider' );

    foreach( $sliders as $slider ) {
        $slides = maybe_unserialize( yiw_get_option( 'slider_' . $slider . '_slides' ) );

        foreach( ( array ) $slides as $k => $slide ) {
            if ( isset( $slide['url_video'] ) && $slide['url_video'] == $url_video ) {
                $url_video = icl_t( 'yiw', $slider . '_slide_' . $k . '_url_video', $slide['url_video'] );
            }
        }
    }

    return $url_video;
}

function wpml_extra_tooltip_image( $extra_tooltip_image ) {
    $sliders = array( 'elegant', 'flash', 'rotating', 'thumbnails', 'nivo', 'cycle', 'unoslider' );

    foreach( $sliders as $slider) {
        $slides = maybe_unserialize( yiw_get_option( 'slider_' . $slider . '_slides' ) );

        foreach( ( array ) $slides as $k => $slide ) {
            if ( isset( $slide['extra_tooltip_image'] ) && $slide['extra_tooltip_image'] == $extra_tooltip_image ) {
                $extra_tooltip_image = icl_t( 'yiw', $slider . '_slide_' . $k . '_extra_tooltip_image', $slide['extra_tooltip_image'] );
            }
        }
    }

    return $extra_tooltip_image;
}

function wpml_extra_tooltip_url( $extra_tooltip_url ) {
    $sliders = array( 'elegant', 'flash', 'rotating', 'thumbnails', 'nivo', 'cycle', 'unoslider' );

    foreach( $sliders as $slider) {
        $slides = maybe_unserialize( yiw_get_option( 'slider_' . $slider . '_slides' ) );

        foreach( ( array ) $slides as $k => $slide ) {
            if ( isset( $slide['extra_tooltip_url'] ) && $slide['extra_tooltip_url'] == $extra_tooltip_url ) {
                $extra_tooltip_url = icl_t( 'yiw', $slider . '_slide_' . $k . '_extra_tooltip_url', $slide['extra_tooltip_url'] );
            }
        }
    }

    return $extra_tooltip_url;
}

function wpml_extra_tooltip_x_pos( $extra_tooltip_x_pos ) {
    $sliders = array( 'elegant', 'flash', 'rotating', 'thumbnails', 'nivo', 'cycle', 'unoslider' );

    foreach( $sliders as $slider ) {
        $slides = maybe_unserialize( yiw_get_option( 'slider_' . $slider . '_slides' ) );

        foreach( ( array ) $slides as $k => $slide ) {
            if ( isset( $slide['extra_tooltip_x_pos'] ) && $slide['extra_tooltip_x_pos'] == $extra_tooltip_x_pos ) {
                $extra_tooltip_x_pos = icl_t( 'yiw', $slider . '_slide_' . $k . '_extra_tooltip_x_pos', $slide['extra_tooltip_x_pos'] );
            }
        }
    }

    return $extra_tooltip_x_pos;
}

function wpml_extra_tooltip_y_pos( $extra_tooltip_y_pos ) {
    $sliders = array( 'elegant', 'flash', 'rotating', 'thumbnails', 'nivo', 'cycle', 'unoslider' );

    foreach( $sliders as $slider ) {
        $slides = maybe_unserialize( yiw_get_option( 'slider_' . $slider . '_slides' ) );

        foreach( ( array ) $slides as $k => $slide ) {
            if ( isset( $slide['extra_tooltip_y_pos'] ) && $slide['extra_tooltip_url'] == $extra_tooltip_y_pos ) {
                $extra_tooltip_y_pos = icl_t( 'yiw', $slider . '_slide_' . $k . '_extra_tooltip_y_pos', $slide['extra_tooltip_y_pos'] );
            }
        }
    }

    return $extra_tooltip_y_pos;
}

// WPML compability
// Fire filters if WPML is activate and its functions exists
if ( defined('ICL_SITEPRESS_VERSION') && function_exists( 'icl_register_string' ) && function_exists( 'icl_t' ) ) {
    add_action( 'admin_init', 'wpml_slides_translation' );

    add_filter( 'yiw_slide_title', 'wpml_slide_title' );
    add_filter( 'yiw_slide_subtitle', 'wpml_slide_title' );
    add_filter( 'yiw_slide_content', 'wpml_tooltip_content' );
    add_filter( 'yiw_slide_clean', 'wpml_tooltip_content' );
    add_filter( 'yiw_slide_image', 'wpml_image_url' );
    add_filter( 'yiw_slide_default', 'extra_tooltip_content' );
    add_filter( 'yiw_slide_clean', 'extra_tooltip_content' );
    add_filter( 'yiw_slide_default', 'url_video' );
    add_filter( 'yiw_slide_default', 'extra_tooltip_image' );
    add_filter( 'yiw_slide_default', 'extra_tooltip_url' );
    add_filter( 'yiw_slide_default', 'extra_tooltip_x_pos' );
    add_filter( 'yiw_slide_default', 'extra_tooltip_y_pos' );
}


if ( ! function_exists( 'yit_icl_translate' ) ) {
    /**
     * Add a string to string translation list and return it translation
     *
     * @author   Andrea Frascaspata  <andrea.frascaspata@yithemes.com>
     *
     * @param $context
     * @param $domain
     * @param $string
     * #param $name
     *
     * @return string | the string translation
     * @since    2.6.1
     */
    function yit_icl_translate( $context, $domain,$name, $string ) {

        global $sitepress;

        if( isset($sitepress) ) {
            $name = "[" . $domain . "]" . $name;

            // wpml string translation
            do_action( 'wpml_register_single_string', $context, $name, $string );

            $string = apply_filters( 'wpml_translate_single_string', $string, $context, $name );
        }

        return $string;
    }
}



/* === CHECK FOR NON STANDARD WORDPRESS TABLE == */
add_filter( 'yiw_yiw_link_data_tables', 'yiw_remove_link_add_layer_slider' );


if( ! function_exists( 'yiw_remove_link_add_layer_slider' ) ) {
    /**
     * add Layer Slider table to export functions
     *
     * @author   Andrea Grillo  <andrea.grillo@yithemes.com>
     * @author   Corrado Porzio  <corradoporzio@gmail.com>
     *
     * @param array
     * @param $tables
     *
     * @return mixed array
     * @since    1.0.2
     */
    function yiw_remove_link_add_layer_slider( $tables ) {
        global $wpdb;

        $tables['plugins'][] = 'layerslider';

        return $tables;
    }
}

if( ! function_exists( 'yiw_string_is_serialized' ) ) {
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
    function yiw_string_is_serialized( $string ) {
        $data = @unserialize( $string );
        return ! $data ? $data : true;
    }
}

if( ! function_exists( 'yiw_string_is_json' ) ){
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
    function yiw_string_is_json( $string ) {
        $data = @json_decode( $string );
        return $data == NULL ? false : true;
    }
}

if ( ! function_exists( 'yiw_get_option_size' ) ) {
    /**
     * Return a size option with default value fallback
     *
     * @author   Andrea Fracsaspata  <andrea.frascaspata@yithemes.com>
     *
     * @return mixed array
     * @since    2.7.8
     */
    function yiw_get_option_size( $option_name , $default_width=255, $default_height=115, $default_crop=false) {

        $value =  yiw_get_option( $option_name );

        if(is_string( $value ) )  $size = explode( ',' , $value );

        $size['width']  = isset( $size[0] ) ? $size[0] : $default_width;
        $size['height'] = isset( $size[1] ) ? $size[1] : $default_height;
        $size['crop']   = isset( $size[2] ) ? $size[2] : $default_crop;

        return $size;
    }

}

/* remove embedded wishlist */

if ( is_admin() && file_exists( get_template_directory() . "/inc/yith_wishlist" ) ) {
    add_action( 'admin_notices', 'yiw_remove_embedded_wishlist' );
    add_action( 'admin_footer', 'yiw_removeWishlistDirectory_js' );
    add_action( 'wp_ajax_yiw_removeWishlistDirectory', 'yiw_removeWishlistDirectory' );
}

if( !function_exists( 'yiw_remove_embedded_wishlist' ) ) {
    /**
     * Add an admin notice about the YIWLink fix
     *
     *
     * @return void
     * @author Andrea Frascaspata <andreafrascaspata@yithemes.com>
     * @since 2.0
     */
    function yiw_remove_embedded_wishlist() { ?>

        <div id="setting-remove-wishlist-yit-communication" class="updated settings-error yiw_remove_embedded_wishlist">
            <p>
                <strong>
                    <p><?php echo __( 'From this Maya version, "Yith Woocommerce Wishlist" will be used as a plugin (like YITH Woocommerce Compare), so please from now on if you want to update Yith Woocommerce Wishlist, remove "maya/inc/yit_wishlist" directory as described in the changelog.', 'yiw' ); ?> <?php echo wp_get_theme()->get( 'Name' ); ?> <?php echo __( 'theme', 'yiw' ); ?>.</p>
                    <p>Note* If your are not able to remove the directory with the link below, do it through FTP.</p>
                    <p class="action_links"><a href="#" id="yiw_remove_embedded_wishlist_button"><?php echo __( 'REMOVE IT NOW', 'yiw' ); ?></a></p>
                </strong>
            </p>
        </div> <?php
    }
}

if( !function_exists( 'yiw_removeWishlistDirectory_js' ) ) {
    /**
     * Add a js script about the YIWLink fix
     *
     *
     * @return void
     * @author Andrea Frascaspata <andreafrascaspata@yithemes.com>
     * @since 2.0
     */
    function yiw_removeWishlistDirectory_js() { ?>
        <script type="text/javascript">

            jQuery(document).ready(function($){

                $( '#yiw_remove_embedded_wishlist_button').click(function(){

                    $( ".yiw_remove_embedded_wishlist .action_links" ).html( '<p><i class="fa fa-refresh fa-spin"></i> <?php echo __( 'Loading', 'yiw' ); ?>...</p>' );

                    var data = {
                        'action': 'yiw_removeWishlistDirectory',
                        'start_remove': 1
                    };

                    $.post( ajaxurl, data, function( response ) {
                        $( ".yiw_remove_embedded_wishlist .action_links" ).html( response );
                        location.reload();
                    });

                });

            });

        </script> <?php
    }
}

if( !function_exists( 'yiw_removeWishlistDirectory' ) ) {
    /**
     * The function that fix the YIWLink problem
     *
     *
     * @return void
     * @author Andrea Frascaspata <andreafrascaspata@yithemes.com>
     * @since 2.0
     */
    function yiw_removeWishlistDirectory() {

        $start_remove = intval( $_POST['start_remove'] );

        $wishlist_path = get_template_directory() . "/inc/yith_wishlist" ;

        if ( file_exists( $wishlist_path ) && $start_remove ) {

            rrmdir($wishlist_path);

            echo '<p><i class="fa fa-check"></i> ' . __( 'REMOVED', 'yiw' ) . '!</p>';

        }

        die();
    }
}

/* remove layer slider */

if ( is_admin() && file_exists( get_template_directory() . "/inc/LayerSlider" ) ) {
    add_action( 'admin_notices', 'yiw_remove_embedded_layerslider' );
    add_action( 'admin_footer', 'yiw_removeLayerSliderDirectory_js' );
    add_action( 'wp_ajax_yiw_removeLayerSliderDirectory', 'yiw_removeLayerSliderDirectory' );
}

if( !function_exists( 'yiw_remove_embedded_layerslider' ) ) {
    /**
     * Add an admin notice about the YIWLink fix
     *
     *
     * @return void
     * @author Andrea Frascaspata <andreafrascaspata@yithemes.com>
     * @since 2.0
     */
    function yiw_remove_embedded_layerslider() { ?>

        <div id="setting-remove-layerslider-yit-communication" class="updated settings-error yiw_remove_embedded_layerslider">
            <p>
                <strong>
                    <p><?php echo __( 'From this Maya version, "Layer Slider" will be used as a premium plugin, so please from now on if you want to update Layer Slider, remove "maya/inc/LayerSlider" directory as described in the changelog.', 'yiw' ); ?> <?php echo wp_get_theme()->get( 'Name' ); ?> <?php echo __( 'theme', 'yiw' ); ?>.</p>
                    <p>Note* If your are not able to remove the directory with the link below, do it through FTP.</p>
                    <p class="action_links"><a href="#" id="yiw_remove_embedded_layerslider_button"><?php echo __( 'REMOVE IT NOW', 'yiw' ); ?></a></p>
                </strong>
            </p>
        </div> <?php
    }
}

if( !function_exists( 'yiw_removeLayerSliderDirectory_js' ) ) {
    /**
     * Add a js script about the YIWLink fix
     *
     *
     * @return void
     * @author Andrea Frascaspata <andreafrascaspata@yithemes.com>
     * @since 2.0
     */
    function yiw_removeLayerSliderDirectory_js() { ?>
        <script type="text/javascript">

            jQuery(document).ready(function($){

                $( '#yiw_remove_embedded_layerslider_button').click(function(){

                    $( ".yiw_remove_embedded_wishlist .action_links" ).html( '<p><i class="fa fa-refresh fa-spin"></i> <?php echo __( 'Loading', 'yiw' ); ?>...</p>' );

                    var data = {
                        'action': 'yiw_removeLayerSliderDirectory',
                        'start_remove': 1
                    };

                    $.post( ajaxurl, data, function( response ) {
                        $( ".yiw_remove_embedded_layerslider .action_links" ).html( response );
                        location.reload();
                    });

                });

            });

        </script> <?php
    }
}

if( !function_exists( 'yiw_removeLayerSliderDirectory' ) ) {
    /**
     * Remove Layer Slider Directory
     *
     *
     * @return void
     * @author Andrea Frascaspata <andreafrascaspata@yithemes.com>
     * @since 2.0
     */
    function yiw_removeLayerSliderDirectory() {

        $start_remove = intval( $_POST['start_remove'] );

        $layer_slider_path = get_template_directory() . "/inc/LayerSlider" ;

        if ( file_exists( $layer_slider_path ) && $start_remove ) {

            rrmdir($layer_slider_path);

            echo '<p><i class="fa fa-check"></i> ' . __( 'REMOVED', 'yiw' ) . '!</p>';

        }

        die();
    }
}

if( !function_exists( 'rrmdir' ) ) {
    function rrmdir($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir."/".$object) == "dir")
                        rrmdir($dir."/".$object);
                    else unlink   ($dir."/".$object);
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }
}

if ( ! function_exists( 'yiw_get_ajax_loader_gif_url' ) ) {
    function yiw_get_ajax_loader_gif_url() {
        return get_template_directory_uri(). '/images/ajax-loader.gif';
    }
}

if( !function_exists( 'is_shop_installed' ) ) {
    /**
     * Detect if there is a shop plugin installed
     *
     * @return bool
     * @since 2.0.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    function is_shop_installed() {
        global $woocommerce;
        if( isset( $woocommerce ) || defined( 'JIGOSHOP_VERSION' ) ) {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * Return false if there is no pagination on current page
 *
 * @author Andrea Frascaspata <andrea.frascaspata@yithemes.com>
 * @since 2.0
 */
if ( ! function_exists( 'yiw_is_paged' ) ) {
    function yiw_is_paged() {

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
if ( ! function_exists( 'yiw_get_post_current_page' ) ) {
    function yiw_get_post_current_page() {

        $current_page = yiw_is_paged();

        $paged = $current_page ? $current_page : 1;

        return $paged;
    }
}
