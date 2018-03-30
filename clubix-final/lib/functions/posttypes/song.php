<?php
/**
 * It creates a custom Post-Type for Songs.
 *
 * @package   ZenTeam
 * @author    Vlad Mustiata <alexmustiata@gmail.com>
 * @license   GPL-2.0+
 * @link      http://stylishthemes.co
 * @copyright 2013 StylishThemes, Inc.
 */


class SongPostType {

    const VERSION = '1.0.0';

    protected $plugin_slug = 'clubix_pt_';

    protected static $instance = null;

    protected $plugin_screen_hook_suffix = null;

    protected $plugin_network_activated = false;

    public $postType = 'csong';

    public $postTypeTax = 'csong-genre';

    private function __construct() {

        $this->zen_pt_init();

        if ( is_admin() ) {
            add_filter( 'enter_title_here', array( &$this, 'change_default_title' ) );
        }

        add_filter('manage_csong_posts_columns' , array( &$this, 'add_song_columns'));
        add_action( 'manage_posts_custom_column' , array( &$this, 'custom_columns'), 10, 2 );

    }

    public function zen_pt_init() {

        $labels = array(
            'name'                  => __('Songs', LANGUAGE_ZONE_ADMIN),
            'singular_name'         => __('Song', LANGUAGE_ZONE_ADMIN),
            'add_new'               => __('Add new', LANGUAGE_ZONE_ADMIN),
            'add_new_item'          => __('Add new song', LANGUAGE_ZONE_ADMIN),
            'edit_item'             => __('Edit Song', LANGUAGE_ZONE_ADMIN),
            'new_item'              => __('New Song', LANGUAGE_ZONE_ADMIN),
            'view_item'             => __('View Song', LANGUAGE_ZONE_ADMIN),
            'search_items'          => __('Search Songs', LANGUAGE_ZONE_ADMIN),
            'not_found'             => __('No songs found.', LANGUAGE_ZONE_ADMIN),
            'not_found_in_trash'    => __('No songs found in trash.', LANGUAGE_ZONE_ADMIN),
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
            'supports'              => array('title','thumbnail', 'comments'),
            'menu_icon'             => 'dashicons-media-audio'
        );

        register_post_type( $this->postType, $args );

        register_taxonomy(
            $this->postTypeTax, $this->postType,
            array(
                'hierarchical'      => true,
                'label'             => __('Genres', LANGUAGE_ZONE_ADMIN),
                'singular_label'    => __('Genre', LANGUAGE_ZONE_ADMIN),
                'public'           => true
            )
        );

    }

    public function add_song_columns($columns) {
        unset($columns['date']);
        return array_merge($columns,
            array(
                'song_title' => __('Song Title'),
                'song_author' =>__( 'Artist Name'),
                'genre'     => __('Genre(s)'),
                'date'      => __('Date')
            ));
    }

    public function custom_columns( $column, $post_id ) {

        $prefix = Haze_Meta_Boxes::get_instance()->prefix;

        switch ( $column ) {
            case 'song_title' :
                echo get_post_meta( $post_id , "{$prefix}song_name" , true );
                break;
            case 'song_author' :
                echo get_post_meta( $post_id , "{$prefix}song_artist_name" , true );
                break;
            case 'genre' :
                $terms = get_the_term_list( $post_id , $this->postTypeTax , '' , ',' , '' );
                if ( is_string( $terms ) )
                    echo $terms;
                else
                    _e( '', LANGUAGE_ZONE_ADMIN );
                break;
        }

    }

    public function change_default_title( $title ){

        $screen = get_current_screen();

        if ( $this->postType == $screen->post_type ){
            $title = __('Song full title...', LANGUAGE_ZONE_ADMIN);
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
SongPostType::get_instance();