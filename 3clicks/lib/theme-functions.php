<?php
/**
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Theme03
 * @subpackage G1_Theme
 * @since G1_Theme 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php

/**
 * Our Theme
 */
class G1_Theme {
    protected $id;
    protected $base_id;

    protected $version;
    const NAME = '3clicks';


    public function __construct( $id ) {
        $this->base_id = $id;
        $this->set_id( $id );

        $current_theme = wp_get_theme( self::NAME );
        $current_version = $current_theme->exists() ? $current_theme->get( 'Version' ) : '1.0.0';

        $this->set_version( $current_version );

        add_action( 'after_setup_theme', array( $this, 'setup_hooks' ) );
    }

    public function get_id() { return $this->id; }
    public function set_id( $val ) { $this->id = $val; }

    public function get_version() { return $this->version; }
    public function set_version( $val ) { $this->version = $val; }


    public function setup_hooks() {
        add_action( 'init', array($this, 'setup_session'), 1 );

        // WPML integration
        add_action( 'init', array( $this, 'setup_wpml' ) );

        add_filter( 'g1_site_id_markup', array( $this, 'change_site_id_markup_besides_front_page' ), 20 );

        // Enable post thumbnails
        add_action( 'init', array( $this, 'setup_post_thumbnails' ) );

        // Dynamic style cache revalidation
        add_action('update_option_' . $this->get_id(), array( $this, 'mark_dynamic_style_cache_as_invalid' ), 999, 2);

        // Set up shortcodes and related stuff
        $this->setup_shortcodes();

        // Set up widgets and related stuff
        $this->setup_widgets();

        // Register sidebars
        add_action( 'init', array( $this, 'setup_sidebars' ), 1 );

        // Register custom navigation locations
        add_action( 'init', array( $this, 'setup_nav_menus' ) );

        // Enable WP Auto Feed Links
        add_theme_support( 'automatic-feed-links' );

        $this->setup_post_formats();

        $this->load_embed_video_simple_interface();


        $this->setup_archive_templates();
        $this->setup_collections();
        $this->setup_single_templates();

        if ( is_plugin_active( 'revslider/revslider.php' ) ) {
            add_filter( 'g1_element_slider_choices' ,       array($this, 'add_rev_slider_choices') );
        }

        add_filter( 'default_content', array( $this, 'setup_default_discussion_options' ), 10, 2 );
        add_filter( 'embed_defaults', array( $this, 'embed_defaults' ), 999 );
    }

    public function mark_dynamic_style_cache_as_invalid ($old_value, $new_value) {
        $option_name = $this->get_id() . '_cache_dynamic_style';
        $dynamic_style_cache_enabled = $new_value['advanced_dynamic_style_cache'] === 'standard';

        if ( $dynamic_style_cache_enabled && $this->can_use_static_dynamic_style() ) {
            update_option($option_name, true);
        } else {
            delete_option($option_name);

            $use_cache_option_name = $this->get_id() . '_use_dynamic_style_cache';
            delete_option($use_cache_option_name);
        }
    }

    public function revalidate_dynamic_style_cache () {
        $force_cache_option_name = $this->get_id() . '_cache_dynamic_style';
        $force_cache = get_option( $force_cache_option_name) == true;

        if ( $force_cache ) {
            $file_cached = $this->cache_dynamic_style();

            // flag that indicates if we can use cached version
            $use_cache_option_name = $this->get_id() . '_use_dynamic_style_cache';

            if ( $file_cached ) {
                update_option($use_cache_option_name, true);

                $this->add_to_cache_log( __( 'Cache file was successfully saved on disk.', 'g1_theme'), 'success');
            } else {
                delete_option($use_cache_option_name);

                $this->add_to_cache_log( __( 'Caching process failed. Cache file was not saved on disk.', 'g1_theme'), 'error');
            }

            // regardless of whether caching was successful or not,
            // we need to remove this flag.
            // If options will be saved next time, this flag will be set again
            // and caching process will be repeated
            delete_option($force_cache_option_name);
        }
    }

    protected function add_to_cache_log ($message, $type) {
        $expire_after_one_hour = 60 * 60 * 1;

        $log_entry = array(
            'type' => $type,
            'message'  => $message,
            'date' => date('F j, Y, g:i a')
        );

        set_transient('g1_dynamic_style_cache_log', $log_entry, $expire_after_one_hour);
    }

    public function cache_dynamic_style () {
        require_once(ABSPATH . 'wp-admin/includes/file.php');

        WP_Filesystem();
        global $wp_filesystem;

        if (!$wp_filesystem) {
            return false;
        }

        $css_dir = trailingslashit( get_template_directory() ) . 'css/';

        // fetch styles content
        ob_start();
        $dont_send_headers = true;
        require_once( $css_dir . 'g1-dynamic-style.php' );
        $css = ob_get_clean();

        $filename = trailingslashit( $this->get_static_css_file_dir() ) . 'g1-dynamic-style.css';

        // if save correctly, use cached version
        if ( $wp_filesystem->exists( $filename ) ) {
            $wp_filesystem->delete( $filename );
        }

        if ( $wp_filesystem->put_contents( $filename, $css, FS_CHMOD_FILE) ) {
            return true;
        }

        return false;
    }

    public function can_use_static_dynamic_style () {
        return wp_is_writable($this->get_static_css_file_dir());
    }

    public function get_static_css_file_dir () {
        $upload_dir = wp_upload_dir();
        $dir = trailingslashit($upload_dir['basedir']);

        return $dir;
    }

    public function get_dynamic_style_file_url () {
        $use_dynamic_style_option_name = $this->get_id() . '_use_dynamic_style_cache';
        $use_dynamic_style = get_option($use_dynamic_style_option_name) == true;

        if ( $use_dynamic_style ) {
            $upload_dir = wp_upload_dir();

            $url = trailingslashit( $upload_dir['baseurl'] ) . 'g1-dynamic-style.css';
        } else {
            $url = trailingslashit( get_template_directory_uri() ) . 'css/g1-dynamic-style.php';
        }

        return $url;
    }

    /**
     * Set up the WordPress Multilingual Plugin if available
     *
     * You can read more about this plugin here:
     * http://wpml.org/
     */
    public function setup_wpml() {
        if ( G1_WPML_LOADED ) {

            // Remove @lang from term title
            global $sitepress;
            if ( $sitepress ) {
                add_filter('single_term_title', array( $sitepress, 'the_category_name_filter' ) );
            }
        }
    }


    public function embed_defaults ($args) {
        $args['height'] = round( $args['width'] * 9/16 );

        return $args;
    }

    public function setup_default_discussion_options ( $post_content, $post ) {
        if( !empty($post->post_type) ) {
            switch( $post->post_type ) {
                case 'page':
                    $post->comment_status = g1_get_theme_option('post_type_page', 'comment_status', 'open');
                    $post->ping_status = g1_get_theme_option('post_type_page', 'ping_status', 'open');
                    break;
            }
        }

        return $post_content;
    }


    public function add_rev_slider_choices ($choices) {
        if ( !class_exists('GlobalsRevSlider') ) {
            return array();
        }

        global $wpdb;

        $tableSliders = $wpdb->prefix . GlobalsRevSlider::TABLE_SLIDERS_NAME;

        $res = $wpdb->get_results( "SELECT id, title, alias FROM $tableSliders", ARRAY_A );

        foreach ($res as $slider) {
            $choices['revslider_'.$slider['alias']] = 'RevSlider: ' . $slider['title'] . ' (ID:' . $slider['id'] . ')';
        }

        return $choices;
    }



    public function setup_session () {
        if (defined('G1_CUSTOMIZE_MODE')) {
    	    $dontUseSession = !empty($_COOKIE['g1_dont_use_session']) ? (bool)$_COOKIE['g1_dont_use_session'] : false;

            if ($dontUseSession) {
                return;
            }

            if ( !session_id() ) {
                session_start();
            }

            // get
            $demo_nr = isset($_GET['demo']) ? (integer)$_GET['demo'] : null;

            if ($demo_nr !== null && $demo_nr >= 1 && $demo_nr <= 12) {
                $theme_id = $this->base_id;

                if ( $demo_nr >= 2 ) {
                    $theme_id .= '_v' . str_pad($demo_nr, 2, '0', STR_PAD_LEFT);
                }

                $_SESSION['theme_id'] = $theme_id;
            }

            // session
            $session_theme_id = isset($_SESSION['theme_id']) ? $_SESSION['theme_id'] : $this->base_id;

            if ($session_theme_id !== null) {
                $this->set_id( $session_theme_id );
            }
        }
    }

    public function gallery_shortcode ( $attr ) {
        $attr = wp_parse_args( $attr, array(
            'itemtag'    => 'li',
            'icontag'    => 'div',
            'captiontag' => 'div',
            'lightbox' => true
        ));

        $open_in_lightbox = $attr['lightbox'] !== 'false';

        if ( $open_in_lightbox ) {
            $attr['link'] = 'file';
        }

        $html = gallery_shortcode( $attr );

        $html = preg_replace( '/<br[^>]*>/i', '', $html );

        $open_tag_found = preg_match('/^\s*(<div[^>]*>)/i', $html, $open_matches);
        $close_tag_found = preg_match('/(<\/div>)\s*$/i', $html);

        // replace first opening and last closing tag
        if ( $open_tag_found && $close_tag_found ) {

            $open_div = $open_matches[1];
            $new_open_div = str_replace('div', 'figure', $open_div) . '<ol>';
            $html = str_replace($open_div, $new_open_div, $html);

            $html = preg_replace('/<\/div>\s*$/', '</ol></figure>', $html);

            $lightbox_group_id = rand();

            if ( $open_in_lightbox ) {
                $html = str_replace('<a', '<a data-g1-lightbox="gallery-'. $lightbox_group_id .'"', $html);
            }
        }

        return $html;
    }

    public function setup_post_formats () {
        add_theme_support(
            'post-formats',
            array(
                'aside',
                'gallery',
                'link',
                'image',
                'quote',
                'status',
                'video',
                'audio',
                'chat'
            )
        );

        require_once( G1_LIB_DIR . '/g1-post-formats/g1-post-formats.php' );
    }

    public function load_embed_video_simple_interface () {
        add_filter( 'embed_oembed_html', 'g1_youtube_simple_interface', 10, 3 );
        add_filter( 'embed_oembed_html', 'g1_vimeo_simple_interface', 10, 3 );
    }

    public function load_embed_video_rich_interface () {
        remove_filter( 'embed_oembed_html', 'g1_youtube_simple_interface' );
        remove_filter( 'embed_oembed_html', 'g1_vimeo_simple_interface' );
    }

    /**
     * @param $size
     *
     * @return boolean
     */
    public function get_crop_for_size ( $size ) {
        $image_size_properties = g1_get_theme_option('image_size', $size, array());

        if ( !empty($image_size_properties['crop']) ) {
            return (bool)($image_size_properties['crop'] === 'standard');
        }

        // size doesn't exist
        return false;
    }

    public function default_post_thumbnails_sizes_crops () {
        return array(
            'g1_max'        => false,
            'g1_two_third'  => false,
            'g1_one_half'   => true,
            'g1_one_third'  => true,
            'g1_one_fourth' => true,
            'g1_one_twelfth'=> true,
        );
    }

    public function setup_post_thumbnails() {
        // Enable post-thumbnails feature
        add_theme_support( 'post-thumbnails' );

        // Add image sizes based on our grid
        // Please note that modules can add their own sizes

        $unit_width = 55;
        $gutter_width = 28;

        add_image_size( 'g1_max', 968, 9999, $this->get_crop_for_size( 'g1_max' ) );

        add_image_size( 'g1_two_third',
            8*$unit_width + 7*$gutter_width,
            9999,
            $this->get_crop_for_size( 'g1_two_third' )
        );

        add_image_size( 'g1_one_half',
            482,
            round( 482 * (9/16) ),
            $this->get_crop_for_size( 'g1_one_half' )
        );

        add_image_size( 'g1_one_third',
            320,
            round( 320 * (9/16) ),
            $this->get_crop_for_size( 'g1_one_third' )
        );

        add_image_size( 'g1_one_third_flexible',
            320,
            9999,
            $this->get_crop_for_size( 'g1_one_third_flexible' )
        );

        add_image_size( 'g1_one_fourth',
            239,
            round( 239 * (9/16) ),
            $this->get_crop_for_size( 'g1_one_fourth' )
        );

        add_image_size( 'g1_one_fourth_flexible',
            239,
            9999,
            $this->get_crop_for_size( 'g1_one_fourth_flexible' )
        );


        add_image_size( 'g1_one_twelfth',
            $unit_width,
            $unit_width,
            $this->get_crop_for_size( 'g1_one_twelfth' )
        );
    }








    /**
     * Registers sidebars
     *
     * Registers permanent sidebars and custom ones from the sidedar generator
     */
    public function setup_sidebars() {
        $sidebars = g1_get_theme_option( 'sidebars', '', array() );

        // Normalize | sanitize
        foreach ( $sidebars as $index => $sidebar ) {
            $sidebar = preg_replace( '/[^0-9a-zA-Z_-]/', '-', $sidebar );
            $sidebar = preg_replace( '/\-{2,}/', '-', $sidebar );
            $sidebar = strtolower($sidebar);

            $sidebars[ $index ] = $sidebar;
        }

        // Prepend default sidebars
        array_unshift(
            $sidebars,
            'primary',
            'preheader-1',
            'preheader-2',
            'preheader-3',
            'preheader-4',
            'preheader-5',
            'prefooter-1',
            'prefooter-2',
            'prefooter-3',
            'prefooter-4',
            'prefooter-5'
        );

        $sidebars = apply_filters( 'g1_setup_sidebars', $sidebars );

        if ( count( $sidebars ) ) {
            foreach ( $sidebars as $sidebar) {
                if ( strlen( $sidebar ) ) {
                    register_sidebar( array(
                        'name'				=> $sidebar,
                        'id'				=> $sidebar,
                        'before_widget' 	=> '<section id="%1$s" class="widget %2$s g1-widget--cssclass">',
                        'after_widget' 		=> '</section>',
                        'before_title'  	=> '<header><h3 class="widgettitle">',
                        'after_title'   	=> '</h3></header>'

                    ));
                }
            }
        }
    }

    /**
     * Registers Custom Navigation Locations
     */
    public function setup_nav_menus() {
        register_nav_menus(  array(
            'primary_nav'   => __( 'Primary Navigation', 'g1_theme' ),
            'secondary_nav' => __( 'Secondary Navigation', 'g1_theme' ),
            'footer_nav'	=> __( 'Footer Navigation', 'g1_theme' ),
        ));
    }




    public function setup_shortcodes() {
        require_once( G1_LIB_DIR.'/g1-shortcodes/basic.php' );
        require_once( G1_LIB_DIR.'/g1-shortcodes/grid.php' );
        require_once( G1_LIB_DIR.'/g1-shortcodes/panels.php' );
        require_once( G1_LIB_DIR.'/g1-shortcodes/misc.php' );


        // gallery shortcode
        remove_shortcode( 'gallery' );
        add_shortcode( 'gallery', array($this, 'gallery_shortcode') );
        add_filter( 'use_default_gallery_style', '__return_false' );


        if ( is_admin() ) {
            require_once( G1_LIB_DIR.'/g1-shortcodes/admin/home_page_snippets.php' );
            require_once( G1_LIB_DIR.'/g1-shortcodes/admin/page_snippets.php' );
        }

        //add_shortcode('wp_caption', 'g1_img_caption_shortcode');
        //add_shortcode('caption', 'g1_img_caption_shortcode');
    }

    public function setup_widgets() {
        // Enable shortcodes in the Text Widget
        add_filter( 'widget_text', 'do_shortcode', 11 );

        // The title of a widget can be empty now
        add_filter( 'widget_title',  array( $this, 'allow_empty_widget_title' ), 9999 );
    }

    public function setup_archive_templates() {
        add_action( 'g1_archive_templates_register', array( $this, 'register_archive_templates' ), 8 );
    }

    public function setup_single_templates() {
        add_action( 'g1_single_templates_register', array( $this, 'register_single_templates' ), 8 );
    }

    public function setup_collections() {
        add_action( 'g1_collections_register', array( $this, 'register_collections' ), 8 );
    }


    public function allow_empty_widget_title( $title ) {
        $title = trim( $title );
        $title = ( $title === "&nbsp;" ) ? '' : $title;

        return $title;
    }




    public function register_archive_templates( $manager ) {
        $dir = '/';
        $uri = trailingslashit( get_template_directory_uri() ) . 'images/templates/';

        // Add archive templates
        $templates = array(
            '1col_sidebar_right' => array(
                'label' => __( '1 Column, Right Sidebar', 'g1_theme' ),
                'file'  => $dir . 'g1_template_archive_1col_sidebar_right.php',
                'icon'  => $uri . 'g1_template_archive_1col_sidebar_right.png',
            ),
            '1col_sidebar_left' => array(
                'label' => __( '1 Column, Left Sidebar', 'g1_theme' ),
                'file'  => $dir . 'g1_template_archive_1col_sidebar_left.php',
                'icon'  => $uri . 'g1_template_archive_1col_sidebar_left.png',
            ),
            '1col' => array(
                'label' => __( '1 Column', 'g1_theme' ),
                'file'  => $dir . 'g1_template_archive_1col.php',
                'icon'  => $uri . 'g1_template_archive_1col.png',
            ),
            '2col' => array(
                'label' => __( '2 Columns', 'g1_theme' ),
                'file'  => $dir . 'g1_template_archive_2col.php',
                'icon'  => $uri . 'g1_template_archive_2col.png',
            ),
            '2col_filterable' => array(
                'label' => __( '2 Columns Filterable', 'g1_theme' ),
                'file'  => $dir . 'g1_template_archive_2col_filterable.php',
                'icon'  => $uri . 'g1_template_archive_2col_filterable.png',
            ),
            '2col_gallery' => array(
                'label' => __( '2 Columns Gallery', 'g1_theme' ),
                'file'  => $dir . 'g1_template_archive_2col_gallery.php',
                'icon'  => $uri . 'g1_template_archive_2col_gallery.png',
            ),
            '2col_gallery_filterable' => array(
                'label' => __( '2 Columns Gallery Filterable', 'g1_theme' ),
                'file'  => $dir . 'g1_template_archive_2col_gallery_filterable.php',
                'icon'  => $uri . 'g1_template_archive_2col_gallery_filterable.png',
            ),
            '2col_sidebar_left' => array(
                'label' => __( '2 Columns, Left Sidebar', 'g1_theme' ),
                'file'  => $dir . 'g1_template_archive_2col_sidebar_left.php',
                'icon'  => $uri . 'g1_template_archive_2col_sidebar_left.png',
            ),
            '2col_filterable_sidebar_left' => array(
                'label' => __( '2 Columns Filterable, Left Sidebar', 'g1_theme' ),
                'file'  => $dir . 'g1_template_archive_2col_filterable_sidebar_left.php',
                'icon'  => $uri . 'g1_template_archive_2col_filterable_sidebar_left.png',
            ),
            '2col_gallery_sidebar_left' => array(
                'label' => __( '2 Columns Gallery, Left Sidebar', 'g1_theme' ),
                'file'  => $dir . 'g1_template_archive_2col_gallery_sidebar_left.php',
                'icon'  => $uri . 'g1_template_archive_2col_gallery_sidebar_left.png',
            ),
            '2col_gallery_filterable_sidebar_left' => array(
                'label' => __( '2 Columns Gallery Filterable, Left Sidebar', 'g1_theme' ),
                'file'  => $dir . 'g1_template_archive_2col_gallery_filterable_sidebar_left.php',
                'icon'  => $uri . 'g1_template_archive_2col_gallery_filterable_sidebar_left.png',
            ),
            '2col_sidebar_right' => array(
                'label' => __( '2 Column, Right Sidebar', 'g1_theme' ),
                'file'  => $dir . 'g1_template_archive_2col_sidebar_right.php',
                'icon'  => $uri . 'g1_template_archive_2col_sidebar_right.png',
            ),
            '2col_filterable_sidebar_right' => array(
                'label' => __( '2 Columns Filterable, Right Sidebar', 'g1_theme' ),
                'file'  => $dir . 'g1_template_archive_2col_filterable_sidebar_right.php',
                'icon'  => $uri . 'g1_template_archive_2col_filterable_sidebar_right.png',
            ),
            '2col_gallery_sidebar_right' => array(
                'label' => __( '2 Column Gallery, Right Sidebar', 'g1_theme' ),
                'file'  => $dir . 'g1_template_archive_2col_gallery_sidebar_right.php',
                'icon'  => $uri . 'g1_template_archive_2col_gallery_sidebar_right.png',
            ),
            '2col_gallery_filterable_sidebar_right' => array(
                'label' => __( '2 Columns Gallery Filterable, Right Sidebar', 'g1_theme' ),
                'file'  => $dir . 'g1_template_archive_2col_gallery_filterable_sidebar_right.php',
                'icon'  => $uri . 'g1_template_archive_2col_gallery_filterable_sidebar_right.png',
            ),
            '3col' => array(
                'label' => __( '3 Columns', 'g1_theme' ),
                'file'  => $dir . 'g1_template_archive_3col.php',
                'icon'  => $uri . 'g1_template_archive_3col.png',
            ),
            '3col_filterable' => array(
                'label' => __( '3 Columns Filterable', 'g1_theme' ),
                'file'  => $dir . 'g1_template_archive_3col_filterable.php',
                'icon'  => $uri . 'g1_template_archive_3col_filterable.png',
            ),
            '3col_masonry' => array(
                'label' => __( '3 Columns Masonry', 'g1_theme' ),
                'file'  => $dir . 'g1_template_archive_3col_masonry.php',
                'icon'  => $uri . 'g1_template_archive_3col_masonry.png',
            ),
            '3col_gallery' => array(
                'label' => __( '3 Columns Gallery', 'g1_theme' ),
                'file'  => $dir . 'g1_template_archive_3col_gallery.php',
                'icon'  => $uri . 'g1_template_archive_3col_gallery.png',
            ),
            '3col_gallery_filterable' => array(
                'label' => __( '3 Columns Gallery Filterable', 'g1_theme' ),
                'file'  => $dir . 'g1_template_archive_3col_gallery_filterable.php',
                'icon'  => $uri . 'g1_template_archive_3col_gallery_filterable.png',
            ),
            '4col' => array(
                'label' => __( '4 Columns', 'g1_theme' ),
                'file'  => $dir . 'g1_template_archive_4col.php',
                'icon'  => $uri . 'g1_template_archive_4col.png',
            ),
            '4col_masonry' => array(
                'label' => __( '4 Columns Masonry', 'g1_theme' ),
                'file'  => $dir . 'g1_template_archive_4col_masonry.php',
                'icon'  => $uri . 'g1_template_archive_4col_masonry.png',
            ),
            '4col_gallery' => array(
                'label' => __( '4 Columns Gallery', 'g1_theme' ),
                'file'  => $dir . 'g1_template_archive_4col_gallery.php',
                'icon'  => $uri . 'g1_template_archive_4col_gallery.png',
            ),
            '4col_filterable' => array(
                'label' => __( '4 Columns Filterable', 'g1_theme' ),
                'file'  => $dir . 'g1_template_archive_4col_filterable.php',
                'icon'  => $uri . 'g1_template_archive_4col_filterable.png',
            ),
        );

        foreach ( $templates as $id => $args ) {
            $manager->add_template( $id, $args );
        }
    }

    public function register_collections( $manager ) {
        $template_parts_dir = 'template-parts/';

        $templates = array(
            'one_fourth' => array(
                'file'              => $template_parts_dir . 'g1_collection_grid',
                'classes'           => array( 'g1-collection--grid', 'g1-collection--one-fourth', 'g1-collection--simple' ),
                'image_size'        => 'g1_one_fourth',
                'lightbox_group'    => 'g1-works',
                'force_placeholder' => true,
            ),
            'one_fourth_gallery' => array(
                'file'              => $template_parts_dir . 'g1_collection_grid',
                'classes'           => array( 'g1-collection--grid', 'g1-collection--one-fourth', 'g1-collection--gallery' ),
                'image_size'        => 'g1_one_fourth',
                'lightbox_group'    => 'g1-works',
                'force_placeholder' => true,
            ),
            'one_fourth_filterable' => array(
                'file'              => $template_parts_dir . 'g1_collection_filterable_grid',
                'classes'           => array( 'g1-collection--grid', 'g1-collection--one-fourth', 'g1-collection--filterable' ),
                'image_size'        => 'g1_one_fourth',
                'lightbox_group'    => 'g1-works',
                'force_placeholder' => true,
            ),
            'one_fourth_masonry' => array(
                'file'              => $template_parts_dir . 'g1_collection_masonry',
                'classes'           => array( 'g1-collection--grid', 'g1-collection--one-fourth', 'g1-collection--masonry' ),
                'image_size'        => 'g1_one_fourth_flexible',
                'lightbox_group'    => 'g1-works',
                'force_placeholder' => false,
            ),
            'one_third' => array(
                'file'              => $template_parts_dir . 'g1_collection_grid',
                'classes'           => array( 'g1-collection--grid', 'g1-collection--one-third', 'g1-collection--simple' ),
                'image_size'        => 'g1_one_third',
                'lightbox_group'    => 'g1-works',
                'force_placeholder' => true,
            ),
            'one_third_filterable' => array(
                'file'              => $template_parts_dir . 'g1_collection_filterable_grid',
                'classes'           => array( 'g1-collection--grid', 'g1-collection--one-third', 'g1-collection--filterable' ),
                'image_size'        => 'g1_one_third',
                'lightbox_group'    => 'g1-works',
                'force_placeholder' => true,
            ),
            'one_third_gallery' => array(
                'file'              => $template_parts_dir . 'g1_collection_grid',
                'classes'           => array( 'g1-collection--grid', 'g1-collection--one-third', 'g1-collection--gallery' ),
                'image_size'        => 'g1_one_third',
                'lightbox_group'    => 'g1-works',
                'force_placeholder' => true,
            ),
            'one_third_gallery_filterable' => array(
                'file'              => $template_parts_dir . 'g1_collection_filterable_grid',
                'classes'           => array( 'g1-collection--grid', 'g1-collection--one-third', 'g1-collection--gallery' ),
                'image_size'        => 'g1_one_third',
                'lightbox_group'    => 'g1-works',
                'force_placeholder' => true,
            ),
            'one_third_masonry' => array(
                'file'              => $template_parts_dir . 'g1_collection_masonry',
                'classes'           => array( 'g1-collection--grid', 'g1-collection--one-third', 'g1-collection--masonry' ),
                'image_size'        => 'g1_one_third_flexible',
                'lightbox_group'    => 'g1-works',
                'force_placeholder' => false,
            ),
            'one_half' => array(
                'file'              => $template_parts_dir . 'g1_collection_grid',
                'classes'           => array( 'g1-collection--grid', 'g1-collection--one-half', 'g1-collection--simple' ),
                'image_size'        => 'g1_one_half',
                'lightbox_group'    => 'g1-works',
                'force_placeholder' => true,
            ),
            'one_half_filterable' => array(
                'file'              => $template_parts_dir . 'g1_collection_filterable_grid',
                'classes'           => array( 'g1-collection--grid', 'g1-collection--one-half', 'g1-collection--filterable' ),
                'image_size'        => 'g1_one_half',
                'lightbox_group'    => 'g1-works',
                'force_placeholder' => true,
            ),
            'one_half_gallery' => array(
                'file'              => $template_parts_dir . 'g1_collection_grid',
                'classes'           => array( 'g1-collection--grid', 'g1-collection--one-half', 'g1-collection--gallery' ),
                'image_size'        => 'g1_one_half',
                'lightbox_group'    => 'g1-works',
                'force_placeholder' => true,
            ),
            'one_half_gallery_filterable' => array(
                'file'              => $template_parts_dir . 'g1_collection_filterable_grid',
                'classes'           => array( 'g1-collection--grid', 'g1-collection--one-half', 'g1-collection--gallery' ),
                'image_size'        => 'g1_one_half',
                'lightbox_group'    => 'g1-works',
                'force_placeholder' => true,
            ),
            'two_third' => array(
                'file'              => $template_parts_dir . 'g1_collection_grid',
                'classes'           => array( 'g1-collection--grid', 'g1-collection--two-third', 'g1-collection--simple' ),
                'image_size'        => 'g1_two_third',
                'lightbox_group'    => 'g1-works',
                'force_placeholder' => false,
            ),
            'max' => array(
                'file'              => $template_parts_dir . 'g1_collection_grid',
                'classes'           => array( 'g1-collection--grid', 'g1-collection--max', 'g1-collection--simple' ),
                'image_size'        => 'g1_max',
                'lightbox_group'    => 'g1-works',
                'force_placeholder' => false,
            ),
        );

        foreach ( $templates as $id => $args ) {
            $manager->add_collection( $id, $args );
        }
    }



    public function register_single_templates( $manager ) {
        $dir = '/';
        $uri = trailingslashit( get_template_directory_uri() ) . 'images/templates/';

        // Add archive templates
        $templates = array(
            'sidebar_right' => array(
                'label' => __( 'Sidebar Right', 'g1_theme' ),
                'file'  => $dir . 'g1_template_single_sidebar_right.php',
                'icon'  => $uri . 'g1_template_single_sidebar_right.png',
            ),
            'sidebar_left' => array(
                'label' => __( 'Sidebar Left', 'g1_theme' ),
                'file'  => $dir . 'g1_template_single_sidebar_left.php',
                'icon'  => $uri . 'g1_template_single_sidebar_left.png',
            ),
            'overview_right' => array(
                'label' => __( 'Overview Right', 'g1_theme' ),
                'file'  => $dir . 'g1_template_single_overview_right.php',
                'icon'  => $uri . 'g1_template_single_overview_right.png',
            ),
            'overview_left' => array(
                'label' => __( 'Overview Left', 'g1_theme' ),
                'file'  => $dir . 'g1_template_single_overview_left.php',
                'icon'  => $uri . 'g1_template_single_overview_left.png',
            ),
            'full' => array(
                'label' => __( 'Full', 'g1_theme' ),
                'file'  => $dir . 'g1_template_single_full.php',
                'icon'  => $uri . 'g1_template_single_full.png',
            ),
        );

        foreach ( $templates as $id => $args ) {
            $manager->add_template( $id, $args );
        }
    }


    public function get_theme_areas() {
        $result = array(
            '.g1-preheader'     => __( 'Preheader', 'g1_theme' ),
            '.g1-header'        => __( 'Header', 'g1_theme' ),
            '.g1-precontent'    => __( 'Precontent', 'g1_theme' ),
            '.g1-content'       => __( 'Content', 'g1_theme' ),
            '.g1-prefooter'     => __( 'Prefooter', 'g1_theme' ),
            '.g1-footer'        => __( 'Footer', 'g1_theme' ),
        );

        return $result;
    }

    public function change_site_id_markup_besides_front_page ( $markup ) {
        if ( !is_front_page() ) {
            $markup = '<p class="site-title"><a href="%1$s" title="'. __( 'Go back to the homepage', 'g1_theme' ) .'">%2$s</a></p>';
        }

        return $markup;
    }


    /**
     * Captures HTML with site identification.
     *
     * @return string
     */
    public function capture_site_id() {
        $out = '';

        // Get all required data
        $name = get_bloginfo( 'name' );
        $description = get_bloginfo( 'description' );
        $desktop_src = g1_get_theme_option( 'branding', 'logo' );

        // Compose logo element
        $out_desktop = '';
        $out_mobile = '';

        // image logo
        if ( ! empty( $desktop_src) ) {
            $set = array();

            // set desktop logo as a defualt for every media width
            $data = array(
                'data-g1-src-desktop' => $desktop_src,
                'data-g1-src-desktop-hdpi' => $desktop_src,
                'data-g1-src-mobile' => $desktop_src,
                'data-g1-src-mobile-hdpi' => $desktop_src,
            );

            // Desktop - HDPI screens
            $desktop_hdpi_src = g1_get_theme_option( 'branding', 'logo_hdpi' );
            if ( !empty( $desktop_hdpi_src ) ) {
                $data['data-g1-src-desktop-hdpi'] = $desktop_hdpi_src;
            }

            // Mobile
            $mobile_src = g1_get_theme_option( 'branding', 'logo_mobile' );
            if (  !empty( $mobile_src ) ) {
                $data['data-g1-src-mobile'] = $mobile_src;
            }

            // Mobile - HDPI screens
            $mobile_hdpi_src = g1_get_theme_option( 'branding', 'logo_mobile_hdpi' );
            if (  !empty( $mobile_hdpi_src ) ) {
                $data['data-g1-src-mobile-hdpi'] = $mobile_hdpi_src;
            } else if ( !empty( $desktop_hdpi_src ) ) {
                $data['data-g1-src-mobile-hdpi'] = $desktop_hdpi_src;
            }

            // markup
            $data_desktop_str =  sprintf(' %s="%s"', 'data-g1-src-desktop', esc_url( $data['data-g1-src-desktop'] ));
            $data_desktop_str .= sprintf(' %s="%s"', 'data-g1-src-desktop-hdpi', esc_url( $data['data-g1-src-desktop-hdpi'] ));

            $data_mobile_str =  sprintf(' %s="%s"', 'data-g1-src-mobile', esc_url( $data['data-g1-src-mobile'] ));
            $data_mobile_str .= sprintf(' %s="%s"', 'data-g1-src-mobile-hdpi', esc_url( $data['data-g1-src-mobile-hdpi'] ));

            $data_desktop_str = trim( $data_desktop_str );
            $data_mobile_str = trim( $data_mobile_str );

            $size_desktop = '';
            $logo_width = absint(g1_get_theme_option('branding', 'logo_width'));
            $logo_height = absint(g1_get_theme_option('branding', 'logo_height'));

            if ( !empty($logo_width) && !empty($logo_height) ) {
                $size_desktop = sprintf(' width="%s" height="%s"', $logo_width, $logo_height);
            }

            $size_mobile = '';
            $logo_mobile_width = absint(g1_get_theme_option('branding', 'logo_mobile_width'));
            $logo_mobile_height = absint(g1_get_theme_option('branding', 'logo_mobile_height'));

            if ( !empty($logo_mobile_width) && !empty($logo_mobile_height) ) {
                $size_mobile = sprintf(' width="%s" height="%s"', $logo_mobile_width, $logo_mobile_height);
            } else if ( !empty($logo_width) && !empty($logo_height) ) {
                $size_mobile = sprintf(' width="%s" height="%s"', $logo_width, $logo_height);
            }

            $out_desktop =
                '<img'. $size_desktop .' id="g1-logo" src="'. esc_url($desktop_src) .'" alt="'. esc_attr($name) .'" '. $data_desktop_str .' />
                <noscript><img src="'. esc_url($desktop_src) .'" alt="'. esc_attr($name) .'" /></noscript>';

            $out_mobile =
                '<img'. $size_mobile .' id="g1-mobile-logo" src="'. esc_url($data['data-g1-src-mobile']) .'" alt="'. esc_attr($name) .'" '. $data_mobile_str .' />';

            // text logo
        } else {
            $out_desktop = esc_html( $name );
        }

        $markup = apply_filters( 'g1_site_id_markup', '<h1 class="site-title"><a href="%1$s">%2$s</a></h1>' );

        $out .= '<div id="g1-id">';

        $out .= sprintf(
            $markup,
            esc_url( home_url() ),
            $out_desktop . $out_mobile
        );

        // Capture tagline
        if ( 'none' !== g1_get_theme_option( 'ta_header', 'tagline' ) && strlen( $description ) ) {
            if ( is_front_page() ) {
                $out .= '<p class="site-description"><strong>' . esc_html( $description ) . '</strong></p>';
            } else {
                $out .= '<p class="site-description">' . esc_html( $description ) . '</p>';
            }
        }
        $out .= '</div><!-- #id -->';

        return $out;
    }

    public function render_site_id() {
        echo $this->capture_site_id();
    }

    public function primary_full_body_class( $classes ) {
        $classes[] = 'g1-primary-full';
        return $classes;
    }

    public function secondary_before_body_class( $classes ) {
        $classes[] = 'g1-secondary-before';
        return $classes;
    }
    public function secondary_after_body_class( $classes ) {
        $classes[] = 'g1-secondary-after';
        return $classes;
    }
    public function secondary_none_body_class( $classes ) {
        $classes[] = 'g1-secondary-none';
        return $classes;
    }
    public function secondary_wide_body_class( $classes ) {
        $classes[] = 'g1-secondary-wide';
        return $classes;
    }
    public function secondary_narrow_body_class( $classes ) {
        $classes[] = 'g1-secondary-narrow';
        return $classes;
    }


    public function mediabox_before_body_class( $classes ) {
        $classes[] = 'g1-mediabox-before';
        return $classes;
    }
    public function mediabox_after_body_class( $classes ) {
        $classes[] = 'g1-mediabox-after';
        return $classes;
    }
    public function mediabox_wide_body_class( $classes ) {
        $classes[] = 'g1-mediabox-wide';
        return $classes;
    }
    public function mediabox_narrow_body_class( $classes ) {
        $classes[] = 'g1-mediabox-narrow';
        return $classes;
    }





}

/**
 * Quasi-singleton for our theme
 *
 * @return G1_Theme
 */
function G1_Theme() {
    static $instance;

    if ( !isset( $instance ) ) {
        $instance = new G1_Theme( 'g1_theme03' );
    }

    return $instance;
}
// Fire in the hole :)
G1_Theme();


if ( is_admin() ) {
    require_once( G1_LIB_DIR . '/theme-admin.php' );
} else {
    require_once( G1_LIB_DIR . '/theme-front.php' );
}




/**
 * Gets a theme option
 */
function g1_get_theme_option( $base, $key, $default = false ) {
    static $storage_values = null;

    $storage_name = G1_Theme()->get_id();

    if ( null === $storage_values || defined('G1_CUSTOMIZE_MODE')) {
        $storage_values = get_option( $storage_name , array() );
    }

    $option_name = $base;

    if ( strlen($key) > 0 ) {
        $option_name .= '_' .$key;
    }

    $result = isset( $storage_values[ $option_name ] ) ? $storage_values[ $option_name ] : $default;

    return $result;
}

function g1_get_font_awesome_icon_class ( $icon_id ) {
    $icon_id = g1_map_font_awesome( $icon_id );

    return 'fa fa-' . sanitize_html_class( $icon_id );
}

/**
 * Map FontAwesome icons from 3.2.1 to 4
 * https://github.com/FortAwesome/Font-Awesome/wiki/Upgrading-from-3.2.1-to-4#new-icon-names
 *
 * @param string $icon_name
 *
 * @return string Icon name
 */
function g1_map_font_awesome ( $icon_name ) {
    $map = array(
        'ban-circle' => 'ban',
        'bar-chart' => 'bar-chart-o',
        'beaker' => 'flask',
        'bell' => 'bell-o',
        'bell-alt' => 'bell',
        'bitbucket-sign' => 'bitbucket-square',
        'bookmark-empty' => 'bookmark-o',
        'building' => 'building-o',
        'calendar-empty' => 'calendar-o',
        'check-empty' => 'square-o',
        'check-minus' => 'minus-square-o',
        'check-sign' => 'check-square',
        'check' => 'check-square-o',
        'chevron-sign-down' => 'chevron-down',
        'chevron-sign-left' => 'chevron-left',
        'chevron-sign-right' => 'chevron-right',
        'chevron-sign-up' => 'chevron-up',
        'circle-arrow-down' => 'arrow-circle-down',
        'circle-arrow-left' => 'arrow-circle-left',
        'circle-arrow-right' => 'arrow-circle-right',
        'circle-arrow-up' => 'arrow-circle-up',
        'circle-blank' => 'circle-o',
        'cny' => 'rmb',
        'collapse-alt' => 'minus-square-o',
        'collapse-top' => 'caret-square-o-up',
        'collapse' => 'caret-square-o-down',
        'comment-alt' => 'comment-o',
        'comments-alt' => 'comments-o',
        'copy' => 'files-o',
        'cut' => 'scissors',
        'dashboard' => 'tachometer',
        'double-angle-down' => 'angle-double-down',
        'double-angle-left' => 'angle-double-left',
        'double-angle-right' => 'angle-double-right',
        'double-angle-up' => 'angle-double-up',
        'download' => 'arrow-circle-o-down',
        'download-alt' => 'download',
        'edit-sign' => 'pencil-square',
        'edit' => 'pencil-square-o',
        'ellipsis-horizontal' => 'ellipsis-h',
        'ellipsis-vertical' => 'ellipsis-v',
        'envelope-alt' => 'envelope-o',
        'exclamation-sign' => 'exclamation-circle',
        'expand-alt' => 'plus-square-o',
        'expand' => 'caret-square-o-right',
        'external-link-sign' => 'external-link-square',
        'eye-close' => 'eye-slash',
        'eye-open' => 'eye',
        'facebook-sign' => 'facebook-square',
        'facetime-video' => 'video-camera',
        'file-alt' => 'file-o',
        'file-text-alt' => 'file-text-o',
        'flag-alt' => 'flag-o',
        'folder-close-alt' => 'folder-o',
        'folder-close' => 'folder',
        'folder-open-alt' => 'folder-open-o',
        'food' => 'cutlery',
        'frown' => 'frown-o',
        'fullscreen' => 'arrows-alt',
        'github-sign' => 'github-square',
        'google-plus-sign' => 'google-plus-square',
        'group' => 'users',
        'h-sign' => 'h-square',
        'hand-down' => 'hand-o-down',
        'hand-left' => 'hand-o-left',
        'hand-right' => 'hand-o-right',
        'hand-up' => 'hand-o-up',
        'hdd' => 'hdd-o',
        'heart-empty' => 'heart-o',
        'hospital' => 'hospital-o',
        'indent-left' => 'outdent',
        'indent-right' => 'indent',
        'info-sign' => 'info-circle',
        'keyboard' => 'keyboard-o',
        'legal' => 'gavel',
        'lemon' => 'lemon-o',
        'lightbulb' => 'lightbulb-o',
        'linkedin-sign' => 'linkedin-square',
        'meh' => 'meh-o',
        'microphone-off' => 'microphone-slash',
        'minus-sign-alt' => 'minus-square',
        'minus-sign' => 'minus-circle',
        'mobile-phone' => 'mobile',
        'moon' => 'moon-o',
        'move' => 'arrows',
        'off' => 'power-off',
        'ok-circle' => 'check-circle-o',
        'ok-sign' => 'check-circle',
        'ok' => 'check',
        'paper-clip' => 'paperclip',
        'paste' => 'clipboard',
        'phone-sign' => 'phone-square',
        'picture' => 'picture-o',
        'pinterest-sign' => 'pinterest-square',
        'play-circle' => 'play-circle-o',
        'play-sign' => 'play-circle',
        'plus-sign-alt' => 'plus-square',
        'plus-sign' => 'plus-circle',
        'pushpin' => 'thumb-tack',
        'question-sign' => 'question-circle',
        'remove-circle' => 'times-circle-o',
        'remove-sign' => 'times-circle',
        'remove' => 'times',
        'reorder' => 'bars',
        'resize-full' => 'expand',
        'resize-horizontal' => 'arrows-h',
        'resize-small' => 'compress',
        'resize-vertical' => 'arrows-v',
        'rss-sign' => 'rss-square',
        'save' => 'floppy-o',
        'screenshot' => 'crosshairs',
        'share-alt' => 'share',
        'share-sign' => 'share-square',
        'share' => 'share-square-o',
        'sign-blank' => 'square',
        'signin' => 'sign-in',
        'signout' => 'sign-out',
        'smile' => 'smile-o',
        'sort-by-alphabet-alt' => 'sort-alpha-desc',
        'sort-by-alphabet' => 'sort-alpha-asc',
        'sort-by-attributes-alt' => 'sort-amount-desc',
        'sort-by-attributes' => 'sort-amount-asc',
        'sort-by-order-alt' => 'sort-numeric-desc',
        'sort-by-order' => 'sort-numeric-asc',
        'sort-down' => 'sort-desc',
        'sort-up' => 'sort-asc',
        'stackexchange' => 'stack-overflow',
        'star-empty' => 'star-o',
        'star-half-empty' => 'star-half-o',
        'sun' => 'sun-o',
        'thumbs-down-alt' => 'thumbs-o-down',
        'thumbs-up-alt' => 'thumbs-o-up',
        'time' => 'clock-o',
        'trash' => 'trash-o',
        'tumblr-sign' => 'tumblr-square',
        'twitter-sign' => 'twitter-square',
        'unlink' => 'chain-broken',
        'upload' => 'arrow-circle-o-up',
        'upload-alt' => 'upload',
        'warning-sign' => 'exclamation-triangle',
        'xing-sign' => 'xing-square',
        'youtube-sign' => 'youtube-square',
        'zoom-in' => 'search-plus',
        'zoom-out' => 'search-minus'
    );

    if ( isset( $map[ $icon_name ] ) ) {
        return $map[ $icon_name ];
    }

    return $icon_name;
}

function g1_get_font_awesome ( $icon_name = null ) {
    $list = array('500px' => '500px',
        'adjust' => 'adjust',
        'adn' => 'adn',
        'align-center' => 'align-center',
        'align-justify' => 'align-justify',
        'align-left' => 'align-left',
        'align-right' => 'align-right',
        'amazon' => 'amazon',
        'ambulance' => 'ambulance',
        'anchor' => 'anchor',
        'android' => 'android',
        'angellist' => 'angellist',
        'angle-double-down' => 'angle-double-down',
        'angle-double-left' => 'angle-double-left',
        'angle-double-right' => 'angle-double-right',
        'angle-double-up' => 'angle-double-up',
        'angle-down' => 'angle-down',
        'angle-left' => 'angle-left',
        'angle-right' => 'angle-right',
        'angle-up' => 'angle-up',
        'apple' => 'apple',
        'archive' => 'archive',
        'area-chart' => 'area-chart',
        'arrow-circle-down' => 'arrow-circle-down',
        'arrow-circle-left' => 'arrow-circle-left',
        'arrow-circle-o-down' => 'arrow-circle-o-down',
        'arrow-circle-o-left' => 'arrow-circle-o-left',
        'arrow-circle-o-right' => 'arrow-circle-o-right',
        'arrow-circle-o-up' => 'arrow-circle-o-up',
        'arrow-circle-right' => 'arrow-circle-right',
        'arrow-circle-up' => 'arrow-circle-up',
        'arrow-down' => 'arrow-down',
        'arrow-left' => 'arrow-left',
        'arrow-right' => 'arrow-right',
        'arrow-up' => 'arrow-up',
        'arrows' => 'arrows',
        'arrows-alt' => 'arrows-alt',
        'arrows-h' => 'arrows-h',
        'arrows-v' => 'arrows-v',
        'asterisk' => 'asterisk',
        'at' => 'at',
        'automobile' => 'automobile',
        'backward' => 'backward',
        'balance-scale' => 'balance-scale',
        'ban' => 'ban',
        'bank' => 'bank',
        'bar-chart' => 'bar-chart',
        'bar-chart-o' => 'bar-chart-o',
        'barcode' => 'barcode',
        'bars' => 'bars',
        'battery-0' => 'battery-0',
        'battery-1' => 'battery-1',
        'battery-2' => 'battery-2',
        'battery-3' => 'battery-3',
        'battery-4' => 'battery-4',
        'battery-empty' => 'battery-empty',
        'battery-full' => 'battery-full',
        'battery-half' => 'battery-half',
        'battery-quarter' => 'battery-quarter',
        'battery-three-quarters' => 'battery-three-quarters',
        'bed' => 'bed',
        'beer' => 'beer',
        'behance' => 'behance',
        'behance-square' => 'behance-square',
        'bell' => 'bell',
        'bell-o' => 'bell-o',
        'bell-slash' => 'bell-slash',
        'bell-slash-o' => 'bell-slash-o',
        'bicycle' => 'bicycle',
        'binoculars' => 'binoculars',
        'birthday-cake' => 'birthday-cake',
        'bitbucket' => 'bitbucket',
        'bitbucket-square' => 'bitbucket-square',
        'bitcoin' => 'bitcoin',
        'black-tie' => 'black-tie',
        'bluetooth' => 'bluetooth',
        'bluetooth-b' => 'bluetooth-b',
        'bold' => 'bold',
        'bolt' => 'bolt',
        'bomb' => 'bomb',
        'book' => 'book',
        'bookmark' => 'bookmark',
        'bookmark-o' => 'bookmark-o',
        'briefcase' => 'briefcase',
        'btc' => 'btc',
        'bug' => 'bug',
        'building' => 'building',
        'building-o' => 'building-o',
        'bullhorn' => 'bullhorn',
        'bullseye' => 'bullseye',
        'bus' => 'bus',
        'buysellads' => 'buysellads',
        'cab' => 'cab',
        'calculator' => 'calculator',
        'calendar' => 'calendar',
        'calendar-check-o' => 'calendar-check-o',
        'calendar-minus-o' => 'calendar-minus-o',
        'calendar-o' => 'calendar-o',
        'calendar-plus-o' => 'calendar-plus-o',
        'calendar-times-o' => 'calendar-times-o',
        'camera' => 'camera',
        'camera-retro' => 'camera-retro',
        'car' => 'car',
        'caret-down' => 'caret-down',
        'caret-left' => 'caret-left',
        'caret-right' => 'caret-right',
        'caret-square-o-down' => 'caret-square-o-down',
        'caret-square-o-left' => 'caret-square-o-left',
        'caret-square-o-right' => 'caret-square-o-right',
        'caret-square-o-up' => 'caret-square-o-up',
        'caret-up' => 'caret-up',
        'cart-arrow-down' => 'cart-arrow-down',
        'cart-plus' => 'cart-plus',
        'cc' => 'cc',
        'cc-amex' => 'cc-amex',
        'cc-diners-club' => 'cc-diners-club',
        'cc-discover' => 'cc-discover',
        'cc-jcb' => 'cc-jcb',
        'cc-mastercard' => 'cc-mastercard',
        'cc-paypal' => 'cc-paypal',
        'cc-stripe' => 'cc-stripe',
        'cc-visa' => 'cc-visa',
        'certificate' => 'certificate',
        'chain' => 'chain',
        'chain-broken' => 'chain-broken',
        'check' => 'check',
        'check-circle' => 'check-circle',
        'check-circle-o' => 'check-circle-o',
        'check-square' => 'check-square',
        'check-square-o' => 'check-square-o',
        'chevron-circle-down' => 'chevron-circle-down',
        'chevron-circle-left' => 'chevron-circle-left',
        'chevron-circle-right' => 'chevron-circle-right',
        'chevron-circle-up' => 'chevron-circle-up',
        'chevron-down' => 'chevron-down',
        'chevron-left' => 'chevron-left',
        'chevron-right' => 'chevron-right',
        'chevron-up' => 'chevron-up',
        'child' => 'child',
        'chrome' => 'chrome',
        'circle' => 'circle',
        'circle-o' => 'circle-o',
        'circle-o-notch' => 'circle-o-notch',
        'circle-thin' => 'circle-thin',
        'clipboard' => 'clipboard',
        'clock-o' => 'clock-o',
        'clone' => 'clone',
        'close' => 'close',
        'cloud' => 'cloud',
        'cloud-download' => 'cloud-download',
        'cloud-upload' => 'cloud-upload',
        'cny' => 'cny',
        'code' => 'code',
        'code-fork' => 'code-fork',
        'codepen' => 'codepen',
        'codiepie' => 'codiepie',
        'coffee' => 'coffee',
        'cog' => 'cog',
        'cogs' => 'cogs',
        'columns' => 'columns',
        'comment' => 'comment',
        'comment-o' => 'comment-o',
        'commenting' => 'commenting',
        'commenting-o' => 'commenting-o',
        'comments' => 'comments',
        'comments-o' => 'comments-o',
        'compass' => 'compass',
        'compress' => 'compress',
        'connectdevelop' => 'connectdevelop',
        'contao' => 'contao',
        'copy' => 'copy',
        'copyright' => 'copyright',
        'creative-commons' => 'creative-commons',
        'credit-card' => 'credit-card',
        'credit-card-alt' => 'credit-card-alt',
        'crop' => 'crop',
        'crosshairs' => 'crosshairs',
        'css3' => 'css3',
        'cube' => 'cube',
        'cubes' => 'cubes',
        'cut' => 'cut',
        'cutlery' => 'cutlery',
        'dashboard' => 'dashboard',
        'dashcube' => 'dashcube',
        'database' => 'database',
        'dedent' => 'dedent',
        'delicious' => 'delicious',
        'desktop' => 'desktop',
        'deviantart' => 'deviantart',
        'diamond' => 'diamond',
        'digg' => 'digg',
        'dollar' => 'dollar',
        'dot-circle-o' => 'dot-circle-o',
        'download' => 'download',
        'dribbble' => 'dribbble',
        'dropbox' => 'dropbox',
        'drupal' => 'drupal',
        'edge' => 'edge',
        'edit' => 'edit',
        'eject' => 'eject',
        'ellipsis-h' => 'ellipsis-h',
        'ellipsis-v' => 'ellipsis-v',
        'empire' => 'empire',
        'envelope' => 'envelope',
        'envelope-o' => 'envelope-o',
        'envelope-square' => 'envelope-square',
        'eraser' => 'eraser',
        'eur' => 'eur',
        'euro' => 'euro',
        'exchange' => 'exchange',
        'exclamation' => 'exclamation',
        'exclamation-circle' => 'exclamation-circle',
        'exclamation-triangle' => 'exclamation-triangle',
        'expand' => 'expand',
        'expeditedssl' => 'expeditedssl',
        'external-link' => 'external-link',
        'external-link-square' => 'external-link-square',
        'eye' => 'eye',
        'eye-slash' => 'eye-slash',
        'eyedropper' => 'eyedropper',
        'facebook' => 'facebook',
        'facebook-f' => 'facebook-f',
        'facebook-official' => 'facebook-official',
        'facebook-square' => 'facebook-square',
        'fast-backward' => 'fast-backward',
        'fast-forward' => 'fast-forward',
        'fax' => 'fax',
        'feed' => 'feed',
        'female' => 'female',
        'fighter-jet' => 'fighter-jet',
        'file' => 'file',
        'file-archive-o' => 'file-archive-o',
        'file-audio-o' => 'file-audio-o',
        'file-code-o' => 'file-code-o',
        'file-excel-o' => 'file-excel-o',
        'file-image-o' => 'file-image-o',
        'file-movie-o' => 'file-movie-o',
        'file-o' => 'file-o',
        'file-pdf-o' => 'file-pdf-o',
        'file-photo-o' => 'file-photo-o',
        'file-picture-o' => 'file-picture-o',
        'file-powerpoint-o' => 'file-powerpoint-o',
        'file-sound-o' => 'file-sound-o',
        'file-text' => 'file-text',
        'file-text-o' => 'file-text-o',
        'file-video-o' => 'file-video-o',
        'file-word-o' => 'file-word-o',
        'file-zip-o' => 'file-zip-o',
        'files-o' => 'files-o',
        'film' => 'film',
        'filter' => 'filter',
        'fire' => 'fire',
        'fire-extinguisher' => 'fire-extinguisher',
        'firefox' => 'firefox',
        'flag' => 'flag',
        'flag-checkered' => 'flag-checkered',
        'flag-o' => 'flag-o',
        'flash' => 'flash',
        'flask' => 'flask',
        'flickr' => 'flickr',
        'floppy-o' => 'floppy-o',
        'folder' => 'folder',
        'folder-o' => 'folder-o',
        'folder-open' => 'folder-open',
        'folder-open-o' => 'folder-open-o',
        'font' => 'font',
        'fonticons' => 'fonticons',
        'fort-awesome' => 'fort-awesome',
        'forumbee' => 'forumbee',
        'forward' => 'forward',
        'foursquare' => 'foursquare',
        'frown-o' => 'frown-o',
        'futbol-o' => 'futbol-o',
        'gamepad' => 'gamepad',
        'gavel' => 'gavel',
        'gbp' => 'gbp',
        'ge' => 'ge',
        'gear' => 'gear',
        'gears' => 'gears',
        'genderless' => 'genderless',
        'get-pocket' => 'get-pocket',
        'gg' => 'gg',
        'gg-circle' => 'gg-circle',
        'gift' => 'gift',
        'git' => 'git',
        'git-square' => 'git-square',
        'github' => 'github',
        'github-alt' => 'github-alt',
        'github-square' => 'github-square',
        'gittip' => 'gittip',
        'glass' => 'glass',
        'globe' => 'globe',
        'google' => 'google',
        'google-plus' => 'google-plus',
        'google-plus-square' => 'google-plus-square',
        'google-wallet' => 'google-wallet',
        'graduation-cap' => 'graduation-cap',
        'gratipay' => 'gratipay',
        'group' => 'group',
        'h-square' => 'h-square',
        'hacker-news' => 'hacker-news',
        'hand-grab-o' => 'hand-grab-o',
        'hand-lizard-o' => 'hand-lizard-o',
        'hand-o-down' => 'hand-o-down',
        'hand-o-left' => 'hand-o-left',
        'hand-o-right' => 'hand-o-right',
        'hand-o-up' => 'hand-o-up',
        'hand-paper-o' => 'hand-paper-o',
        'hand-peace-o' => 'hand-peace-o',
        'hand-pointer-o' => 'hand-pointer-o',
        'hand-rock-o' => 'hand-rock-o',
        'hand-scissors-o' => 'hand-scissors-o',
        'hand-spock-o' => 'hand-spock-o',
        'hand-stop-o' => 'hand-stop-o',
        'hashtag' => 'hashtag',
        'hdd-o' => 'hdd-o',
        'header' => 'header',
        'headphones' => 'headphones',
        'heart' => 'heart',
        'heart-o' => 'heart-o',
        'heartbeat' => 'heartbeat',
        'history' => 'history',
        'home' => 'home',
        'hospital-o' => 'hospital-o',
        'hotel' => 'hotel',
        'hourglass' => 'hourglass',
        'hourglass-1' => 'hourglass-1',
        'hourglass-2' => 'hourglass-2',
        'hourglass-3' => 'hourglass-3',
        'hourglass-end' => 'hourglass-end',
        'hourglass-half' => 'hourglass-half',
        'hourglass-o' => 'hourglass-o',
        'hourglass-start' => 'hourglass-start',
        'houzz' => 'houzz',
        'html5' => 'html5',
        'i-cursor' => 'i-cursor',
        'ils' => 'ils',
        'image' => 'image',
        'inbox' => 'inbox',
        'indent' => 'indent',
        'industry' => 'industry',
        'info' => 'info',
        'info-circle' => 'info-circle',
        'inr' => 'inr',
        'instagram' => 'instagram',
        'institution' => 'institution',
        'internet-explorer' => 'internet-explorer',
        'intersex' => 'intersex',
        'ioxhost' => 'ioxhost',
        'italic' => 'italic',
        'joomla' => 'joomla',
        'jpy' => 'jpy',
        'jsfiddle' => 'jsfiddle',
        'key' => 'key',
        'keyboard-o' => 'keyboard-o',
        'krw' => 'krw',
        'language' => 'language',
        'laptop' => 'laptop',
        'lastfm' => 'lastfm',
        'lastfm-square' => 'lastfm-square',
        'leaf' => 'leaf',
        'leanpub' => 'leanpub',
        'legal' => 'legal',
        'lemon-o' => 'lemon-o',
        'level-down' => 'level-down',
        'level-up' => 'level-up',
        'life-bouy' => 'life-bouy',
        'life-buoy' => 'life-buoy',
        'life-ring' => 'life-ring',
        'life-saver' => 'life-saver',
        'lightbulb-o' => 'lightbulb-o',
        'line-chart' => 'line-chart',
        'link' => 'link',
        'linkedin' => 'linkedin',
        'linkedin-square' => 'linkedin-square',
        'linux' => 'linux',
        'list' => 'list',
        'list-alt' => 'list-alt',
        'list-ol' => 'list-ol',
        'list-ul' => 'list-ul',
        'location-arrow' => 'location-arrow',
        'lock' => 'lock',
        'long-arrow-down' => 'long-arrow-down',
        'long-arrow-left' => 'long-arrow-left',
        'long-arrow-right' => 'long-arrow-right',
        'long-arrow-up' => 'long-arrow-up',
        'magic' => 'magic',
        'magnet' => 'magnet',
        'mail-forward' => 'mail-forward',
        'mail-reply' => 'mail-reply',
        'mail-reply-all' => 'mail-reply-all',
        'male' => 'male',
        'map' => 'map',
        'map-marker' => 'map-marker',
        'map-o' => 'map-o',
        'map-pin' => 'map-pin',
        'map-signs' => 'map-signs',
        'mars' => 'mars',
        'mars-double' => 'mars-double',
        'mars-stroke' => 'mars-stroke',
        'mars-stroke-h' => 'mars-stroke-h',
        'mars-stroke-v' => 'mars-stroke-v',
        'maxcdn' => 'maxcdn',
        'meanpath' => 'meanpath',
        'medium' => 'medium',
        'medkit' => 'medkit',
        'meh-o' => 'meh-o',
        'mercury' => 'mercury',
        'microphone' => 'microphone',
        'microphone-slash' => 'microphone-slash',
        'minus' => 'minus',
        'minus-circle' => 'minus-circle',
        'minus-square' => 'minus-square',
        'minus-square-o' => 'minus-square-o',
        'mixcloud' => 'mixcloud',
        'mobile' => 'mobile',
        'mobile-phone' => 'mobile-phone',
        'modx' => 'modx',
        'money' => 'money',
        'moon-o' => 'moon-o',
        'mortar-board' => 'mortar-board',
        'motorcycle' => 'motorcycle',
        'mouse-pointer' => 'mouse-pointer',
        'music' => 'music',
        'navicon' => 'navicon',
        'neuter' => 'neuter',
        'newspaper-o' => 'newspaper-o',
        'object-group' => 'object-group',
        'object-ungroup' => 'object-ungroup',
        'odnoklassniki' => 'odnoklassniki',
        'odnoklassniki-square' => 'odnoklassniki-square',
        'opencart' => 'opencart',
        'openid' => 'openid',
        'opera' => 'opera',
        'optin-monster' => 'optin-monster',
        'outdent' => 'outdent',
        'pagelines' => 'pagelines',
        'paint-brush' => 'paint-brush',
        'paper-plane' => 'paper-plane',
        'paper-plane-o' => 'paper-plane-o',
        'paperclip' => 'paperclip',
        'paragraph' => 'paragraph',
        'paste' => 'paste',
        'pause' => 'pause',
        'pause-circle' => 'pause-circle',
        'pause-circle-o' => 'pause-circle-o',
        'paw' => 'paw',
        'paypal' => 'paypal',
        'pencil' => 'pencil',
        'pencil-square' => 'pencil-square',
        'pencil-square-o' => 'pencil-square-o',
        'percent' => 'percent',
        'phone' => 'phone',
        'phone-square' => 'phone-square',
        'photo' => 'photo',
        'picture-o' => 'picture-o',
        'pie-chart' => 'pie-chart',
        'pied-piper' => 'pied-piper',
        'pied-piper-alt' => 'pied-piper-alt',
        'pinterest' => 'pinterest',
        'pinterest-p' => 'pinterest-p',
        'pinterest-square' => 'pinterest-square',
        'plane' => 'plane',
        'play' => 'play',
        'play-circle' => 'play-circle',
        'play-circle-o' => 'play-circle-o',
        'plug' => 'plug',
        'plus' => 'plus',
        'plus-circle' => 'plus-circle',
        'plus-square' => 'plus-square',
        'plus-square-o' => 'plus-square-o',
        'power-off' => 'power-off',
        'print' => 'print',
        'product-hunt' => 'product-hunt',
        'puzzle-piece' => 'puzzle-piece',
        'qq' => 'qq',
        'qrcode' => 'qrcode',
        'question' => 'question',
        'question-circle' => 'question-circle',
        'quote-left' => 'quote-left',
        'quote-right' => 'quote-right',
        'ra' => 'ra',
        'random' => 'random',
        'rebel' => 'rebel',
        'recycle' => 'recycle',
        'reddit' => 'reddit',
        'reddit-alien' => 'reddit-alien',
        'reddit-square' => 'reddit-square',
        'refresh' => 'refresh',
        'registered' => 'registered',
        'remove' => 'remove',
        'renren' => 'renren',
        'reorder' => 'reorder',
        'repeat' => 'repeat',
        'reply' => 'reply',
        'reply-all' => 'reply-all',
        'retweet' => 'retweet',
        'rmb' => 'rmb',
        'road' => 'road',
        'rocket' => 'rocket',
        'rotate-left' => 'rotate-left',
        'rotate-right' => 'rotate-right',
        'rouble' => 'rouble',
        'rss' => 'rss',
        'rss-square' => 'rss-square',
        'rub' => 'rub',
        'ruble' => 'ruble',
        'rupee' => 'rupee',
        'safari' => 'safari',
        'save' => 'save',
        'scissors' => 'scissors',
        'scribd' => 'scribd',
        'search' => 'search',
        'search-minus' => 'search-minus',
        'search-plus' => 'search-plus',
        'sellsy' => 'sellsy',
        'send' => 'send',
        'send-o' => 'send-o',
        'server' => 'server',
        'share' => 'share',
        'share-alt' => 'share-alt',
        'share-alt-square' => 'share-alt-square',
        'share-square' => 'share-square',
        'share-square-o' => 'share-square-o',
        'shekel' => 'shekel',
        'sheqel' => 'sheqel',
        'shield' => 'shield',
        'ship' => 'ship',
        'shirtsinbulk' => 'shirtsinbulk',
        'shopping-bag' => 'shopping-bag',
        'shopping-basket' => 'shopping-basket',
        'shopping-cart' => 'shopping-cart',
        'sign-in' => 'sign-in',
        'sign-out' => 'sign-out',
        'signal' => 'signal',
        'simplybuilt' => 'simplybuilt',
        'sitemap' => 'sitemap',
        'skyatlas' => 'skyatlas',
        'skype' => 'skype',
        'slack' => 'slack',
        'sliders' => 'sliders',
        'slideshare' => 'slideshare',
        'smile-o' => 'smile-o',
        'soccer-ball-o' => 'soccer-ball-o',
        'sort' => 'sort',
        'sort-alpha-asc' => 'sort-alpha-asc',
        'sort-alpha-desc' => 'sort-alpha-desc',
        'sort-amount-asc' => 'sort-amount-asc',
        'sort-amount-desc' => 'sort-amount-desc',
        'sort-asc' => 'sort-asc',
        'sort-desc' => 'sort-desc',
        'sort-down' => 'sort-down',
        'sort-numeric-asc' => 'sort-numeric-asc',
        'sort-numeric-desc' => 'sort-numeric-desc',
        'sort-up' => 'sort-up',
        'soundcloud' => 'soundcloud',
        'space-shuttle' => 'space-shuttle',
        'spinner' => 'spinner',
        'spoon' => 'spoon',
        'spotify' => 'spotify',
        'square' => 'square',
        'square-o' => 'square-o',
        'stack-exchange' => 'stack-exchange',
        'stack-overflow' => 'stack-overflow',
        'star' => 'star',
        'star-half' => 'star-half',
        'star-half-empty' => 'star-half-empty',
        'star-half-full' => 'star-half-full',
        'star-half-o' => 'star-half-o',
        'star-o' => 'star-o',
        'steam' => 'steam',
        'steam-square' => 'steam-square',
        'step-backward' => 'step-backward',
        'step-forward' => 'step-forward',
        'stethoscope' => 'stethoscope',
        'sticky-note' => 'sticky-note',
        'sticky-note-o' => 'sticky-note-o',
        'stop' => 'stop',
        'stop-circle' => 'stop-circle',
        'stop-circle-o' => 'stop-circle-o',
        'street-view' => 'street-view',
        'strikethrough' => 'strikethrough',
        'stumbleupon' => 'stumbleupon',
        'stumbleupon-circle' => 'stumbleupon-circle',
        'subscript' => 'subscript',
        'subway' => 'subway',
        'suitcase' => 'suitcase',
        'sun-o' => 'sun-o',
        'superscript' => 'superscript',
        'support' => 'support',
        'table' => 'table',
        'tablet' => 'tablet',
        'tachometer' => 'tachometer',
        'tag' => 'tag',
        'tags' => 'tags',
        'tasks' => 'tasks',
        'taxi' => 'taxi',
        'television' => 'television',
        'tencent-weibo' => 'tencent-weibo',
        'terminal' => 'terminal',
        'text-height' => 'text-height',
        'text-width' => 'text-width',
        'th' => 'th',
        'th-large' => 'th-large',
        'th-list' => 'th-list',
        'thumb-tack' => 'thumb-tack',
        'thumbs-down' => 'thumbs-down',
        'thumbs-o-down' => 'thumbs-o-down',
        'thumbs-o-up' => 'thumbs-o-up',
        'thumbs-up' => 'thumbs-up',
        'ticket' => 'ticket',
        'times' => 'times',
        'times-circle' => 'times-circle',
        'times-circle-o' => 'times-circle-o',
        'tint' => 'tint',
        'toggle-down' => 'toggle-down',
        'toggle-left' => 'toggle-left',
        'toggle-off' => 'toggle-off',
        'toggle-on' => 'toggle-on',
        'toggle-right' => 'toggle-right',
        'toggle-up' => 'toggle-up',
        'trademark' => 'trademark',
        'train' => 'train',
        'transgender' => 'transgender',
        'transgender-alt' => 'transgender-alt',
        'trash' => 'trash',
        'trash-o' => 'trash-o',
        'tree' => 'tree',
        'trello' => 'trello',
        'tripadvisor' => 'tripadvisor',
        'trophy' => 'trophy',
        'truck' => 'truck',
        'try' => 'try',
        'tty' => 'tty',
        'tumblr' => 'tumblr',
        'tumblr-square' => 'tumblr-square',
        'turkish-lira' => 'turkish-lira',
        'tv' => 'tv',
        'twitch' => 'twitch',
        'twitter' => 'twitter',
        'twitter-square' => 'twitter-square',
        'umbrella' => 'umbrella',
        'underline' => 'underline',
        'undo' => 'undo',
        'university' => 'university',
        'unlink' => 'unlink',
        'unlock' => 'unlock',
        'unlock-alt' => 'unlock-alt',
        'unsorted' => 'unsorted',
        'upload' => 'upload',
        'usb' => 'usb',
        'usd' => 'usd',
        'user' => 'user',
        'user-md' => 'user-md',
        'user-plus' => 'user-plus',
        'user-secret' => 'user-secret',
        'user-times' => 'user-times',
        'users' => 'users',
        'venus' => 'venus',
        'venus-double' => 'venus-double',
        'venus-mars' => 'venus-mars',
        'viacoin' => 'viacoin',
        'video-camera' => 'video-camera',
        'vimeo' => 'vimeo',
        'vimeo-square' => 'vimeo-square',
        'vine' => 'vine',
        'vk' => 'vk',
        'volume-down' => 'volume-down',
        'volume-off' => 'volume-off',
        'volume-up' => 'volume-up',
        'warning' => 'warning',
        'wechat' => 'wechat',
        'weibo' => 'weibo',
        'weixin' => 'weixin',
        'whatsapp' => 'whatsapp',
        'wheelchair' => 'wheelchair',
        'wifi' => 'wifi',
        'wikipedia-w' => 'wikipedia-w',
        'windows' => 'windows',
        'won' => 'won',
        'wordpress' => 'wordpress',
        'wrench' => 'wrench',
        'xing' => 'xing',
        'xing-square' => 'xing-square',
        'y-combinator' => 'y-combinator',
        'y-combinator-square' => 'y-combinator-square',
        'yahoo' => 'yahoo',
        'yc' => 'yc',
        'yc-square' => 'yc-square',
        'yelp' => 'yelp',
        'yen' => 'yen',
        'youtube' => 'youtube',
        'youtube-play' => 'youtube-play',
        'youtube-square' => 'youtube-square',
    );

    if ( !is_null($icon_name) ) {
        $index = array_search( $icon_name, $list );

        if ( $index !== false ) {
            return array(
                'code'  =>  $index,
                'name'  =>  $list[$index]
            );
        }

        return null;
    }

    return $list;
}



