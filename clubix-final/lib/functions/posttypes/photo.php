<?php
/**
 * It creates a custom Post-Type for Photos.
 *
 * @package   ZenTeam
 * @author    Vlad Mustiata <alexmustiata@gmail.com>
 * @license   GPL-2.0+
 * @link      http://stylishthemes.co
 * @copyright 2013 StylishThemes, Inc.
 */


class PhotoPostType {

    const VERSION = '1.0.0';

    protected $plugin_slug = 'clubix_pt_';

    protected static $instance = null;

    protected $plugin_screen_hook_suffix = null;

    protected $plugin_network_activated = false;

    public $postType = 'cphoto';

    public $postTypeTax = 'pcategory';

    private function __construct() {

        $this->zen_pt_init();

        if ( is_admin() ) {
            add_filter( 'enter_title_here', array( &$this, 'change_default_title' ) );
        }

    }

    public function zen_pt_init() {

        $labels = array(
            'name'                  => __('Photo Galleries', LANGUAGE_ZONE_ADMIN),
            'singular_name'         => __('Photo Gallery', LANGUAGE_ZONE_ADMIN),
            'add_new'               => __('Add new', LANGUAGE_ZONE_ADMIN),
            'add_new_item'          => __('Add new photo gallery', LANGUAGE_ZONE_ADMIN),
            'edit_item'             => __('Edit Photo Gallery', LANGUAGE_ZONE_ADMIN),
            'new_item'              => __('New Photo Gallery', LANGUAGE_ZONE_ADMIN),
            'view_item'             => __('View Photo Gallery', LANGUAGE_ZONE_ADMIN),
            'search_items'          => __('Search Photo Gallery', LANGUAGE_ZONE_ADMIN),
            'not_found'             => __('No photo galleries found.', LANGUAGE_ZONE_ADMIN),
            'not_found_in_trash'    => __('No photo galleries found in trash.', LANGUAGE_ZONE_ADMIN),
            'parent_item_colon'     => ''
        );

        $args = array(
            'labels'                => $labels,
            'public'                => true,
            'publicly_queryable'    => true,
            'exclude_from_search'   => true,
            'show_ui'               => true,
            'query_var'             => true,
            'rewrite'               => true,
            'hierarchical'          => false,
            'menu_position'         => null,
            'capability_type'       => 'post',
            'supports'              => array('title','thumbnail'),
            'menu_icon'             => 'dashicons-images-alt2'
        );

        register_post_type( $this->postType, $args );

        register_taxonomy(
            $this->postTypeTax, $this->postType,
            array(
                'hierarchical'      => true,
                'label'             => __('Categories', LANGUAGE_ZONE_ADMIN),
                'singular_label'    => __('Category', LANGUAGE_ZONE_ADMIN),
                'public'           => true
            )
        );

    }


    public function change_default_title( $title ){

        $screen = get_current_screen();

        if ( $this->postType == $screen->post_type ){
            $title = __('Photo Gallery Title...', LANGUAGE_ZONE_ADMIN);
        }

        return $title;
    }

    /**
     * Return an instance of this class.
     *
     * @since     1.0.0
     *
     * @return    object    A single instance of this class.
     */
    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

}
PhotoPostType::get_instance();