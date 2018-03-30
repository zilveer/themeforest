<?php
/**
 * Your Inspiration Themes
 *
 * @package    WordPress
 * @subpackage Your Inspiration Themes
 * @author     Your Inspiration Themes Team <info@yithemes.com>
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
    //Content width. WP require it. So give to WordPress what is of WordPress
    if ( ! isset( $content_width ) ) {
        $content_width = yit_get_option( 'container-width' );
    }

    //This theme have a CSS file for the editor TinyMCE
    add_editor_style( 'css/editor-style.css' );

    //This theme support post thumbnails
    add_theme_support( 'post-thumbnails' );

    //This theme uses the menues
    add_theme_support( 'menus' );

    //Add default posts and comments RSS feed links to head
    add_theme_support( 'automatic-feed-links' );

    //This theme support post formats
    add_theme_support( 'post-formats', apply_filters( 'yit_post_formats_support', array( 'gallery', 'audio', 'video', 'quote' ) ) );

    // Title tag
    add_theme_support( "title-tag" );

    // custonm logo

    add_theme_support( 'custom-logo', array(
        'height'      => 76,
        'width'       => 200,
        'flex-height' => true,
    ) );

    if ( ! defined( 'HEADER_TEXTCOLOR' ) ) {
        define( 'HEADER_TEXTCOLOR', '' );
    }

    // The height and width of your custom header. You can hook into the theme's own filters to change these values.
    // Add a filter to twentyten_header_image_width and twentyten_header_image_height to change these values.
    define( 'HEADER_IMAGE_WIDTH', apply_filters( 'yiw_header_image_width', 1170 ) );
    define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'yiw_header_image_height', 410 ) );

    // Don't support text inside the header image.
    if ( ! defined( 'NO_HEADER_TEXT' ) ) {
        define( 'NO_HEADER_TEXT', true );
    }

    //This theme support custom header
    add_theme_support( 'custom-header' );

    //This theme support custom backgrounds
    add_theme_support( 'custom-backgrounds' );

    // We'll be using post thumbnails for custom header images on posts and pages.
    // We want them to be 940 pixels wide by 198 pixels tall.
    // Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
    // set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );
    $image_sizes = array(
        'blog_big'                         => array( 890, 0, true ),
        'blog_small'                       => array( 365, 320, true ),
        'blog_elegant'                     => array( 539, 0, true ),
        'blog_big_ribbon'                  => array( 760, 0, true ),
        'blog_small_ribbon'                => array( 370, 320, true ),
        'blog_sphera'                      => array( 280, 305, true ),
        'blog_bazar'                       => array( 858, 338, true ),
        'blog_thumb'                       => array( 75, 75, true ),
        'section_blog'                     => array( 263, 243, true ),
        'section_services'                 => array( 175, 175, true ),
        'thumb-testimonial'                => array( 41, 41, true ),
        'thumb-testimonial-circle'         => array( 100, 100, true ),
        'thumb-testimonial-quote'          => array( 87, 85, true ),
        'thumb-testimonial-square'         => array( 116, 116, true ),
        'thumb-testimonial-bazar'          => array( 62, 62, true ),
        'thumb_portfolio_fulldesc_related' => array( 258, 170, true ),
        'thumb_portfolio_bigimage'         => array( 656, 0 ),
        'thumb_portfolio_filterable'       => array( 260, 168, true ),
        'thumb_portfolio_fulldesc'         => array( 574, 340, true ),
        'thumb_portfolio_fulldesc_big'     => array( 1158, 400, true ),
        'section_video'                    => array( 162, 136, true ),
        'section_portfolio'                => array( 660, 360, true ),
        'section_portfolio_sidebar'        => array( 385, 192, true ),
        'section_portfolio_thumb'          => array( 164, 106, true ),
        'thumb_portfolio_2cols'            => array( 560, 324, true ),
        'thumb_portfolio_3cols'            => array( 360, 216, true ),
        'thumb_portfolio_4cols'            => array( 260, 172, true ),
        'accordion_thumb'                  => array( 266, 266, true ),
        'team_rounded_thumb'               => array( 130, 130, true ),
        'team_professional_thumb'          => array( 270, 270, true ),
        'team_professional_mini_thumb'     => array( 70, 70, true ),
        'featured_project_thumb'           => array( 320, 154, true ),
        'thumb_portfolio_slide'            => array( 560, 377, true ),
        'thumb_portfolio_pinterest'        => array( 260, 0 ),
        'nav_menu'                         => array( 170, 0 ),
    );

    $image_sizes = apply_filters( 'yit_add_image_size', $image_sizes );

    foreach ( $image_sizes as $id_size => $size ) {
        yit_add_image_size( $id_size, apply_filters( 'yit_' . $id_size . '_width', $size[0] ), apply_filters( 'yit_' . $id_size . '_height', $size[1] ), isset( $size[2] ) ? $size[2] : false );
    }

    //Register theme default header. Usually one
//     register_default_headers( array(
//         'theme_header' => array(
//             'url' => '%s/images/headers/001.jpg',
//             'thumbnail_url' => '%s/images/headers/thumb/001.jpg',
//             /* translators: header image description */
//             'description' => __( 'Design', 'yit' ) . ' 1'
//         )
//     ) );

    //Set localization and load language file
    $locale      = get_locale();
    $locale_file = YIT_THEME_PATH . "/languages/$locale.php";
    if ( is_readable( $locale_file ) ) {
        require_once( $locale_file );
    }

    //Register menus
    register_nav_menus(
        array(
            'nav' => __( 'Main navigation', 'yit' ),
            //'top' => __( 'Top Bar', 'yit' )
        )
    );

    //Register sidebars
    register_sidebar( yit_sidebar_args( 'Default Sidebar' ) );
    register_sidebar( yit_sidebar_args( 'Home Sidebar', 'Widget area for Home Page Template', 'home-widget span3' ) );
    register_sidebar( yit_sidebar_args( 'Blog Sidebar' ) );
    register_sidebar( yit_sidebar_args( '404 Sidebar' ) );
    register_sidebar( yit_sidebar_args( 'Header Sidebar', 'Widget area for Header', 'widget' ) );
    register_sidebar( yit_sidebar_args( 'Topbar Left', 'Left widget area for Tob Bar' ) );
    register_sidebar( yit_sidebar_args( 'Topbar Right', 'Right widget area for Tob Bar' ) );

    //User defined sidebars
    do_action( 'yit_register_sidebars' );

    //Register custom sidebars
    $sidebars = maybe_unserialize( yit_get_option( 'custom-sidebars' ) );
    if ( is_array( $sidebars ) && ! empty( $sidebars ) ) {
        foreach ( $sidebars as $sidebar ) {
            register_sidebar( yit_sidebar_args( $sidebar, '', 'widget', apply_filters( 'yit_custom_sidebar_title_wrap', 'h3' ) ) );
        }
    }

    //Footer with sidebar type widgets
    if ( strstr( yit_get_option( 'footer-type' ), 'sidebar' ) ) {
        register_sidebar( yit_sidebar_args( "Footer Widgets Area", __( "The widget area used in Footer With Sidebar section", 'yit' ), 'widget span2', apply_filters( 'yit_footer_widget_area_wrap', 'h3' ) ) );
        register_sidebar( yit_sidebar_args( "Footer Sidebar", __( "The sidebar used in Footer With Sidebar section", 'yit' ), 'widget span6', apply_filters( 'yit_footer_widget_area_wrap', 'h3' ) ) );
    } //else {
    //Footer sidebars
    for ( $i = 1; $i <= yit_get_option( 'footer-rows', 0 ); $i ++ ) {
        register_sidebar( yit_sidebar_args( "Footer Row $i", sprintf( __( "The widget area #%d used in Footer section", 'yit' ), $i ), 'widget span' . ( 12 / yit_get_option( 'footer-columns' ) ), apply_filters( 'yit_footer_sidebar_' . $i . '_wrap', 'h3' ) ) );
    }
    //}
}

function yit_include_woocommerce_functions() {
    if ( ! is_shop_installed() ) {
        return;
    }

    include_once locate_template( basename( YIT_THEME_FUNC_DIR ) . '/woocommerce.php' );
}

add_action( 'yit_loaded', 'yit_include_woocommerce_functions' );


wp_oembed_add_provider( '#https?://(?:api\.)?soundcloud\.com/.*#i', 'http://soundcloud.com/oembed', true );

function yit_meta_like_body( $css ) {
    $body_bg = yit_get_option( 'background-style' );

    return $css . '.blog-big .meta, .blog-small .meta { background: ' . $body_bg['color'] . '; }';
}

///**
// * Remove Items option from the magnifier
// *
// * @param array $array
// * @return array
// * @since 1.0
// */
//function yit_remove_items_options_yith_wcmg( $array ) {
//    foreach( $array['slider'] as $key => $option ) {
//        if( $option['id'] == 'yith_wcmg_slider_items' ) {
//            unset( $array['slider'][$key] );
//        }
//    }
//
//    return $array;
//}

/**
 * Remove Add to wishlist text option
 *
 */
function yit_remove_wishlist_text_option( $options ) {
    if( isset( $options['general_settings']['add_to_wishlist_text'] ) ){
        unset( $options['general_settings']['add_to_wishlist_text'] );
    }

    if ( isset( $options['general_settings'][7] ) && $options['general_settings'][7]['id'] == 'yith_wcwl_add_to_wishlist_text' ) {
        unset( $options['general_settings'][7] );
    }

    return $options;
}

/**
 * Add the style for variations dropdowns scrollable.
 */
function yit_scrollable_variations() {
    if ( is_shop_installed() && ! is_product() ) {
        return;
    }

    if ( yit_get_option( 'shop-variations-scrollable' ) ) : ?>
        <style>
            .variations .select-wrapper .sbOptions {
                max-height: <?php echo yit_get_option( 'shop-variations-scrollable-height' ) ?>px !important;
                overflow: scroll;
            }
        </style>
    <?php
    endif;
}

/**
 * Add a back to top button
 *
 */
function yit_back_to_top() {
    if ( yit_get_option( 'back-top' ) ) {
        echo '<div id="back-top"><a href="#top">' . apply_filters( 'yit_back_to_top_text', __( 'Back to top', 'yit' ) ) . '</a></div>';
    }
}

/*
 * Remove the query string from static contents
 */
function yit_remove_script_version( $src ) {
    if ( yit_get_option( 'remove_script_version' ) ) {
        $parts = explode( '?v', $src );
        return $parts[0];
    }
    else {
        return $src;
    }
}

if ( ! function_exists( 'yit_string_is_serialized' ) ) {
    /**
     * Check if a string is serialized
     *
     * @author   Andrea Grillo  <andrea.grillo@yithemes.com>
     *
     * @param $string
     *
     * @internal param string $src
     * @return bool | true if string is serialized, false otherwise
     * @since    2.3.0
     */
    function yit_string_is_serialized( $string ) {
        $data = @unserialize( $string );
        return ! $data ? $data : true;
    }
}

if ( ! function_exists( 'yit_string_is_json' ) ) {
    /**
     * Check if a string is json
     *
     * @author   Andrea Grillo  <andrea.grillo@yithemes.com>
     *
     * @param $string
     *
     * @internal param string $src
     * @return bool | true if string is json, false otherwise
     * @since    2.3.0
     */
    function yit_string_is_json( $string ) {
        $data = @json_decode( $string );
        return $data == NULL ? false : true;
    }
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
     * @since    2.3.0
     */
    function yit_icl_translate( $context, $domain,$name, $string ) {

        global $sitepress;

        if ( isset( $sitepress ) ) {

            $name = "[" . $domain . "]" . $name;

            yit_wpml_register_string( $context, $name, $string );

            return yit_wpml_string_translate( $context, $name, $string );

        }
        else {
            return sprintf( __( '%s', $domain ), $string );
        }
    }
}

if( !function_exists( 'is_catalog_mode_installed' ) ) {
    /**
     * Detect if there is a wc catalog mode plugin installed
     *
     *
     * @return void
     * @since 2.3.x
     */
    function is_catalog_mode_installed() {
        global $wc_cvo;
        if( isset( $wc_cvo )) {
            return true;
        } else {
            return false;
        }
    }
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

if ( is_admin() && false === get_transient( 'yit_removeYIWLink' ) && version_compare( wp_get_theme()->get( 'Version' ), '2.4.7', '<=')  ) {

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

                yit_update_db_value('http://demo.yithemes.com/','bazar',$item,$item_type,$type);
                yit_update_db_value('http://yourinspirationtheme.com/demo/','bazar',$item,$item_type,$type);
                yit_update_db_value('http://www.yourinspirationweb.com/demo/','bazar',$item,$item_type,$type);
                yit_update_db_value('http://yourinspirationtheme.com/tf/','bazar',$item,$item_type,$type);

                yit_update_db_value('http://demo.yithemes.com/','cheope',$item,$item_type,$type);
                yit_update_db_value('http://yourinspirationtheme.com/demo/','cheope',$item,$item_type,$type);
                yit_update_db_value('http://www.yourinspirationweb.com/demo/','cheope',$item,$item_type,$type);
                yit_update_db_value('http://yourinspirationtheme.com/tf/','cheope',$item,$item_type,$type);

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
    function yit_update_db_value($base_url,$dir,&$item,$item_type,$type){
        $importer_uploads_url   = $base_url.$dir.'/files';
        $importer_site_url      = $base_url.$dir;

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
                    'postmeta'
                ),

                'options' => array(
                    'yit-panel-options_bazar',
                    'widget_rss',
                    'yit-panel-options_bazar_defaults',
                    'yit-notifier-cache_bazar',
                    'transient_feed_ae7750599bbe148aeb7fbf6610deb87c',
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

function yit_force_cache_enqueue() {
    wp_enqueue_style( 'yit-style', str_replace( 'http:', 'https:', YIT_CACHE_URL ) . '/style.css' );
    wp_enqueue_style( 'yit-cache', str_replace( 'http:', 'https:', YIT_CACHE_URL ) . '/custom.css' );
}

if(is_ssl() && get_option('woocommerce_force_ssl_checkout')=='yes') {
    add_action( 'wp_head', 'yit_force_cache_enqueue', 10 );
}

/* removed embedded wishlist */

if ( is_admin() && file_exists( get_template_directory() . "/theme/plugins/yith_wishlist" ) ) {
    add_action( 'admin_notices', 'yit_remove_embedded_wishlist' );
    add_action( 'admin_footer', 'yit_removeWishlistDirectory_js' );
    add_action( 'wp_ajax_yit_removeWishlistDirectory', 'yit_removeWishlistDirectory' );
}

if( !function_exists( 'yit_remove_embedded_wishlist' ) ) {
    /**
     * Add an admin notice about the YIWLink fix
     *
     *
     * @return void
     * @author Andrea Frascaspata <andreafrascaspata@yithemes.com>
     * @since 2.0
     */
    function yit_remove_embedded_wishlist() { ?>

        <div id="setting-remove-wishlist-yit-communication" class="updated settings-error yit_remove_embedded_wishlist">
            <p>
                <strong>
                    <p><?php echo __( 'From this Bazar version, "Yith Woocommerce Wishlist" will be used as a plugin (like YITH Woocommerce Compare), so please from now on if you want to update Yith Woocommerce Wishlist, remove "bazar/theme/plugins/yit_wishlist" directory as described in the changelog.', 'yit' ); ?> <?php echo wp_get_theme()->get( 'Name' ); ?> <?php echo __( 'theme', 'yit' ); ?>.</p>
                    <p>Note* If your are not able to remove the directory with the link below, do it through FTP.</p>
                    <p class="action_links"><a href="#" id="yit_remove_embedded_wishlist_button"><?php echo __( 'REMOVE IT NOW', 'yit' ); ?></a></p>
                </strong>
            </p>
        </div> <?php
    }
}

if( !function_exists( 'yit_removeWishlistDirectory_js' ) ) {
    /**
     * Add a js script about the YIWLink fix
     *
     *
     * @return void
     * @author Andrea Frascaspata <andreafrascaspata@yithemes.com>
     * @since 2.0
     */
    function yit_removeWishlistDirectory_js() { ?>
        <script type="text/javascript">

            jQuery(document).ready(function($){

                $( '#yit_remove_embedded_wishlist_button').click(function(){

                    $( ".yit_remove_embedded_wishlist .action_links" ).html( '<p><i class="fa fa-refresh fa-spin"></i> <?php echo __( 'Loading', 'yit' ); ?>...</p>' );

                    var data = {
                        'action': 'yit_removeWishlistDirectory',
                        'start_remove': 1
                    };

                    $.post( ajaxurl, data, function( response ) {
                        $( ".yit_remove_embedded_wishlist .action_links" ).html( response );
                        location.reload();
                    });

                });

            });

        </script> <?php
    }
}

if( !function_exists( 'yit_removeWishlistDirectory' ) ) {
    /**
     * The function that fix the YIWLink problem
     *
     *
     * @return void
     * @author Andrea Frascaspata <andreafrascaspata@yithemes.com>
     * @since 2.0
     */
    function yit_removeWishlistDirectory() {

        $start_remove = intval( $_POST['start_remove'] );

        $wishlist_path = get_template_directory() . "/theme/plugins/yith_wishlist" ;

        if ( file_exists( $wishlist_path ) && $start_remove ) {

            rrmdir($wishlist_path);

            echo '<p><i class="fa fa-check"></i> ' . __( 'REMOVED', 'yit' ) . '!</p>';

        }

        die();
    }
}

/* end removed embededd wishlist */

/* removed embedded yith_magnifier */

if ( is_admin() && file_exists( get_template_directory() . "/theme/plugins/yith_magnifier" ) ) {
    add_action( 'admin_notices', 'yit_remove_embedded_magnifier' );
    add_action( 'admin_footer', 'yit_removeMagnifierDirectory_js' );
    add_action( 'wp_ajax_yit_removeMagnifierDirectory', 'yit_removeMagnifierDirectory' );
}

if( !function_exists( 'yit_remove_embedded_magnifier' ) ) {
    /**
     * Add an admin notice about the YIWLink fix
     *
     *
     * @return void
     * @author Andrea Frascaspata <andreafrascaspata@yithemes.com>
     * @since 2.0
     */
    function yit_remove_embedded_magnifier() { ?>

        <div id="setting-remove-magnifier-yit-communication" class="updated settings-error yit_remove_embedded_magnifier">
            <p>
                <strong>
                    <p><?php echo __( 'From this Bazar version, "Yith Woocommerce Zoom Magnifier" will be used as a plugin (like YITH Woocommerce Compare), so please from now on if you want to update Yith Woocommerce Zoom Magnifier, remove "bazar/theme/plugins/yit_magnifier" directory as described in the changelog.', 'yit' ); ?> <?php echo wp_get_theme()->get( 'Name' ); ?> <?php echo __( 'theme', 'yit' ); ?>.</p>
                    <p>Note* If your are not able to remove the directory with the link below, do it through FTP.</p>
                    <p class="action_links"><a href="#" id="yit_remove_embedded_magnifier_button"><?php echo __( 'REMOVE IT NOW', 'yit' ); ?></a></p>
                </strong>
            </p>
        </div> <?php
    }
}

if( !function_exists( 'yit_removeMagnifierDirectory_js' ) ) {
    /**
     * Add a js script about the YIWLink fix
     *
     *
     * @return void
     * @author Andrea Frascaspata <andreafrascaspata@yithemes.com>
     * @since 2.0
     */
function yit_removeMagnifierDirectory_js() { ?>
    <script type="text/javascript">

        jQuery(document).ready(function($){

            $( '#yit_remove_embedded_magnifier_button').click(function(){

                $( ".yit_remove_embedded_magnifier .action_links" ).html( '<p><i class="fa fa-refresh fa-spin"></i> <?php echo __( 'Loading', 'yit' ); ?>...</p>' );

                var data = {
                    'action': 'yit_removeMagnifierDirectory',
                    'start_remove': 1
                };

                $.post( ajaxurl, data, function( response ) {
                    $( ".yit_remove_embedded_magnifier .action_links" ).html( response );
                    location.reload();
                });

            });

        });

    </script> <?php
}
}

if( !function_exists( 'yit_removeMagnifierDirectory' ) ) {
    /**
     * The function that fix the YIWLink problem
     *
     *
     * @return void
     * @author Andrea Frascaspata <andreafrascaspata@yithemes.com>
     * @since 2.0
     */
    function yit_removeMagnifierDirectory() {

        $start_remove = intval( $_POST['start_remove'] );

        $magnifier_path = get_template_directory() . "/theme/plugins/yith_magnifier" ;

        if ( file_exists( $magnifier_path ) && $start_remove ) {

            rrmdir($magnifier_path);

            echo '<p><i class="fa fa-check"></i> ' . __( 'REMOVED', 'yit' ) . '!</p>';

        }

        die();
    }
}

/* end removed magnifier wishlist */



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


if ( ! function_exists( 'yit_get_ajax_loader_gif_url' ) ) {
    function yit_get_ajax_loader_gif_url() {
        return YIT_THEME_ASSETS_URL . '/images/ajax-loader.gif';
    }
}


