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
    //Content width. WP require it. So give to WordPress what is of WordPress
    if( !isset( $content_width ) ) { $content_width = yit_get_option( 'container-width' ); }
    
    //This theme have a CSS file for the editor TinyMCE
    add_editor_style( 'css/editor-style.css' );
    
    //This theme support post thumbnails
    add_theme_support( 'post-thumbnails' );
    
    //This theme uses the menues
    add_theme_support( 'menus' );
    
    //Add default posts and comments RSS feed links to head
    add_theme_support( 'automatic-feed-links' );
    
    //This theme support custom header
    add_theme_support( 'custom-headers' );
    
    //This theme support custom backgrounds
    add_theme_support( 'custom-backgrounds' );
    
    //This theme support post formats
    add_theme_support( 'post-formats', apply_filters( 'yit_post_formats_support', array( 'gallery', 'audio', 'video', 'quote' ) ) );
    
    // Title tag
    add_theme_support( "title-tag" );

    // custonm logo

    add_theme_support( 'custom-logo', array(
        'height'      => 58,
        'width'       => 155,
        'flex-height' => true,
    ) );
    
    // We'll be using post thumbnails for custom header images on posts and pages.
    // We want them to be 940 pixels wide by 198 pixels tall.
    // Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
    //set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );    
    $image_sizes = array(
        'blog_big'     => array( 890, 340, true ),
        'blog_small'   => array( 365, 340, true ),
        'blog_elegant' => array( 539, 230, true ),
        'blog_thumb'   => array( 55, 55, true ),
        'blog_thumb_recentpost'   => array( 270, 142, true ),
        'section_blog' => array( 581, 155, true ),
        'section_blog_sidebar' => array( 386, 155, true ),
        'section_services' => array( 175, 175, true ),
        'thumb-testimonial' => array( 87, 85, true ),
        'thumb-testimonial-slider' => array( 35, 35, true ),
        'thumb_portfolio_fulldesc_related' => array( 258, 170, true ),
        'thumb_portfolio_bigimage' => array( 656, 0 ),
        'thumb_portfolio_filterable' => array( 260, 168, true ),
        'thumb_portfolio_fulldesc' => array( 574, 340, true ),
        'section_portfolio' => array( 573, 285, true ),
        'section_portfolio_sidebar' => array( 385, 192, true ),
        'thumb_portfolio_2cols' => array( 560, 324, true ),
        'thumb_portfolio_3cols' => array( 360, 216, true ),
        'thumb_portfolio_4cols' => array( 260, 172, true ),
        'accordion_thumb' => array( 266, 266, true ),
        'featured_project_thumb' => array( 320, 154, true ),
        'thumb_portfolio_slide' => array( 560, 377, true ),
        'thumb_portfolio_pinterest' => array( 260, 0 ),
        'nav_menu' => array( 170, 0 ),
    );
    
    $image_sizes = apply_filters( 'yit_add_image_size', $image_sizes );
    
    foreach ( $image_sizes as $id_size => $size )               
        add_image_size( $id_size, apply_filters( 'yit_' . $id_size . '_width', $size[0] ), apply_filters( 'yit_' . $id_size . '_height', $size[1] ), isset( $size[2] ) ? $size[2] : false );
    
    //Register theme default header. Usually one
    register_default_headers( array(
        'theme_header' => array(
            'url' => '%s/images/headers/001.jpg',
            'thumbnail_url' => '%s/images/headers/thumb/001.jpg',
            /* translators: header image description */
            'description' => __( 'Design', 'yit' ) . ' 1'
        )
    ) );
    
    //Set localization and load language file
    $locale = get_locale();
    $locale_file = YIT_THEME_PATH . "/languages/$locale.php";
    if ( is_readable( $locale_file ) )
        require_once( $locale_file );
    
    //Register menus
    register_nav_menus(
        array(
            'nav' => __( 'Main navigation', 'yit' ),
            'top' => __( 'Top Bar', 'yit' )
        )
    );
    // Set in Theme Options > General > Settings
    if( yit_get_option( 'show-top-menu-login-register' ) ) add_filter('wp_nav_menu_items','add_logout_button', 10, 2);

	if ( !is_nav_menu( 'Top Menu' )) {
        $menu_id = wp_create_nav_menu( 'Top Menu' );
        $menu = array( 'menu-item-type' => 'custom', 'menu-item-url' => get_home_url('/'),'menu-item-title' => 'Home' );
        wp_update_nav_menu_item( $menu_id, 0, $menu );
		
		$locations = get_theme_mod('nav_menu_locations');
		$locations['top'] = $menu_id;  
		set_theme_mod('nav_menu_locations', $locations);
    }
    
    //Register sidebars
    register_sidebar( yit_sidebar_args( 'Default Sidebar' ) );
    register_sidebar( yit_sidebar_args( 'Blog Sidebar' ) );
    register_sidebar( yit_sidebar_args( '404 Sidebar' ) );
    register_sidebar( yit_sidebar_args( 'Nav Sidebar', 'Widget area for Navigation Bar', 'widget' ) );
    
    //User definded sidebars
    do_action( 'yit_register_sidebars' );
    
    //Register custom sidebars
    $sidebars = maybe_unserialize( yit_get_option( 'custom-sidebars' ) );
    if( is_array( $sidebars ) && ! empty( $sidebars ) ) {
        foreach( $sidebars as $sidebar ) {
            register_sidebar( yit_sidebar_args( $sidebar, '', 'widget', apply_filters( 'yit_custom_sidebar_title_wrap', 'h3' ) ) );
        }
    }
    
    //Footer with sidebar type widgets
    if( strstr( yit_get_option( 'footer-type' ), 'sidebar' ) ) {
        register_sidebar( yit_sidebar_args( "Footer Widgets Area", __( "The widget area used in Footer With Sidebar section", 'yit' ), 'widget span2', apply_filters( 'yit_footer_widget_area_wrap', 'h3' ) ) );
        register_sidebar( yit_sidebar_args( "Footer Sidebar", __( "The sidebar used in Footer With Sidebar section", 'yit' ), 'widget span6', apply_filters( 'yit_footer_widget_area_wrap', 'h3' ) ) );
    } else {
        //Footer sidebars
        for( $i = 1; $i <= yit_get_option( 'footer-rows', 0 ); $i++ ) {
            register_sidebar( yit_sidebar_args( "Footer Row $i", sprintf(  __( "The widget area #%d used in Footer section", 'yit' ), $i ), 'widget span' . ( 12 / yit_get_option( 'footer-columns' ) ), apply_filters( 'yit_footer_sidebar_' . $i . '_wrap', 'h3' ) ) );
        }
    }
}

function add_logout_button( $nav, $args )
{
	if( is_user_logged_in() )
	{
		if( $args->theme_location == 'top' )
			return $nav.'<li><a href="' . wp_logout_url( home_url() ) . '"> ' . __('Logout', 'yit') . ' </a></li>';
		return $nav;
	}
	else
	{
		if( $args->theme_location == 'top' )
			if( is_shop_installed() )
			{
				$accountPage = get_permalink( get_option('woocommerce_myaccount_page_id') );
				return $nav.'<li><a href="' . $accountPage . '">' . __('Login', 'yit') . ' / ' . __('Register', 'yit') . '</a></li>';
			}
			else
				return $nav.'<li><a href="' . wp_login_url() . '">' . __('Login', 'yit') . '</a></li>'.wp_register(' / ','', false);
		return $nav;
	}
}

function yit_include_woocommerce_functions() {
    if ( ! is_shop_installed() ) return;

    include_once locate_template( basename( YIT_THEME_FUNC_DIR ) . '/woocommerce.php' );
}
add_action( 'yit_loaded', 'yit_include_woocommerce_functions' );

wp_oembed_add_provider( '#https?://(?:api\.)?soundcloud\.com/.*#i', 'http://soundcloud.com/oembed', true );

function yit_meta_like_body( $css ) {
    $body_bg = yit_get_option( 'background-style' );
    
    return $css . '.blog-big .meta, .blog-small .meta { background: ' . $body_bg['color'] . '; }';
}
add_filter( 'yit_custom_style', 'yit_meta_like_body' );

/**
 * Remove Shortcode tab in the Theme Options
 * 
 * @param array $tree
 * @return array
 * @since 1.0.0
 */
function yit_remove_tab_sc( $tree ) {
    if( isset( $tree['shortcodes'] ) )
        { unset( $tree['shortcodes'] ); }
    
    return $tree;
}

/**
 * Remove Items option from the magnifier
 * 
 * @param array $array
 * @return array
 * @since 1.3
 */
function yit_remove_items_options_yith_wcmg( $array ) {

    foreach( $array as $key => $option ) {
        if( isset( $option['id'] ) && $option['id'] == 'yith_wcmg_slider_items' ) {
            unset( $array[$key] );
        }
    }

    return $array;
}



/**
 * Add a back to top button
 *
 */
function yit_back_to_top() {
    if ( yit_get_option('back-top') ) {
        echo '<div id="back-top"><a href="#top">' . __('Back to top', 'yit') . '</a></div>';
    }
}

if( !function_exists( 'yit_remove_wp_admin_bar' ) ) {
    /**
     * Remove the wp admin bar in frontend if user is logged in
     */
    function yit_remove_wp_admin_bar() {
        if ( yit_get_option( 'general-lock-down-admin' ) == '1' &&  ( ( defined('YIT_DEBUG') && ! YIT_DEBUG ) ) || ! defined( 'YIT_DEBUG' )  ){
            add_filter( 'show_admin_bar', '__return_false' );
        }
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
     * @since    2.1.0
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

            //set_transient( 'yit_removeYIWLink', true );
            echo '<p><i class="fa fa-check"></i> ' . __( 'Updated', 'yit' ) . '!</p>';

        }

        die();
    }
}


if ( is_admin() && false === get_transient( 'yit_removeYIWLink' ) && version_compare( wp_get_theme()->get( 'Version' ), '2.1.7', '<=')  ) {

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

                yit_update_db_value('http://yourinspirationtheme.com/demo/','cheope',$item,$item_type,$type);
                yit_update_db_value('http://www.yourinspirationtheme.com/demo/','cheope',$item,$item_type,$type);

                yit_update_db_value('http://yourinspirationweb.com/demo/','cheope',$item,$item_type,$type);
                yit_update_db_value('http://www.yourinspirationweb.com/demo/','cheope',$item,$item_type,$type);

                yit_update_db_value('http://yourinspirationweb.com/demo/','memento',$item,$item_type,$type);
                yit_update_db_value('http://yourinspirationtheme.com/demo/','memento',$item,$item_type,$type);
                yit_update_db_value('http://yourinspirationweb.com/demo/','sheeva',$item,$item_type,$type);
                yit_update_db_value('http://yourinspirationtheme.com/demo/','sheeva',$item,$item_type,$type);
                yit_update_db_value('http://yourinspirationweb.com/demo/','pinkrio',$item,$item_type,$type);
                yit_update_db_value('http://yourinspirationtheme.com/demo/','pinkrio',$item,$item_type,$type);

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

                $importer_uploads_url   = $base_url.$dir.'/files';
                $importer_site_url      = $base_url.$dir;

                $current_item = '' . $item; //clone

                $item         = str_replace( $importer_uploads_url, '%uploadsurl%', $item );
                if ( !(strcmp( $current_item, $item ) == 0) ) {
                    $parsed_site_url = @parse_url( $importer_site_url );
                    $item            = str_replace( str_replace( $parsed_site_url['scheme'] . '://' . $parsed_site_url['host'], '', $importer_uploads_url ), '%uploadsurl%', $item );
                }

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

                'options' => array(),

                'plugins' => array(),
            )
        );
    }
}


/* === CHECK FOR NON STANDARD WORDPRESS TABLE == */
/* Revolution Slider Plugin */
add_filter( 'yit_yiw_link_data_tables', 'yit_remove_link_add_revslider_tables' );


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

        $tables['plugins'][] = 'revslider_slides';
        $tables['plugins'][] = 'revslider_sliders';

        return $tables;
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

if( !function_exists( 'is_catalog_mode_installed' ) ) {
    /**
     * Detect if there is a wc catalog mode plugin installed
     *
     *
     * @return bool
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

function yit_force_cache_enqueue() {
    wp_enqueue_style( 'yit-style', str_replace( 'http:', 'https:', YIT_CACHE_URL ) . '/style.css' );
    wp_enqueue_style( 'yit-cache', str_replace( 'http:', 'https:', YIT_CACHE_URL ) . '/custom.css' );
}

if(is_ssl() && get_option('woocommerce_force_ssl_checkout')=='yes') {
    add_action( 'wp_head', 'yit_force_cache_enqueue', 10 );
}

/* ========= removed embedded wishlist ========= */

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
    function yit_remove_embedded_wishlist() {
        $theme_name =  wp_get_theme()->get( 'Name' );
        ?>

        <div id="setting-remove-wishlist-yit-communication" class="updated settings-error yit_remove_embedded_wishlist">
            <p>
                <strong>
                    <p><?php echo __( 'From this Cheope version, "Yith Woocommerce Wishlist" will be used as a plugin (like YITH Woocommerce Compare), so please from now on if you want to update Yith Woocommerce Wishlist, remove "cheope/theme/plugins/yit_wishlist" directory as described in the changelog.', 'yit' ); ?> <?php echo $theme_name; ?> <?php echo __( 'theme', 'yit' ); ?>.</p>
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

/* ======== removed embedded magnifier ======== */

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
                    <p><?php echo __( 'From this Cheope version, "Yith WooCommerce Zoom Magnifier" will be used as a plugin (like YITH WooCommerce Compare), so please from now on if you want to update Yith WooCommerce Zoom Magnifier, remove "cheope/theme/plugins/yit_magnifier" directory as described in the changelog.', 'yit' ); ?> <?php echo wp_get_theme()->get( 'Name' ); ?> <?php echo __( 'theme', 'yit' ); ?>.</p>
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