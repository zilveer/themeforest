<?php
/**
 * It creates a custom Post-Type for Albums.
 *
 * @package   ZenTeam
 * @author    Vlad Mustiata <alexmustiata@gmail.com>
 * @license   GPL-2.0+
 * @link      http://stylishthemes.co
 * @copyright 2013 StylishThemes, Inc.
 */


class AlbumPostType {

    const VERSION = '1.0.0';

    protected $plugin_slug = 'clubix_pt_';

    protected static $instance = null;

    protected $plugin_screen_hook_suffix = null;

    protected $plugin_network_activated = false;

    public $postType = 'calbum';

    public $postTypeTax = 'calbum-genre';

    public $postTypeTag = 'atag';

    private function __construct() {

        $this->zen_pt_init();

        if ( is_admin() ) {
            add_filter( 'enter_title_here', array( &$this, 'change_default_title' ) );
        }

        add_filter('manage_csong_posts_columns' , array( &$this, 'add_song_columns'));
        add_action( 'manage_posts_custom_column' , array( &$this, 'custom_columns'), 10, 2 );


        //add_action('init', array( &$this, 'add_taxonomy_objects'));

    }

    public function zen_pt_init() {

        $labels = array(
            'name'                  => __('Albums', LANGUAGE_ZONE_ADMIN),
            'singular_name'         => __('Album', LANGUAGE_ZONE_ADMIN),
            'add_new'               => __('Add new', LANGUAGE_ZONE_ADMIN),
            'add_new_item'          => __('Add new album', LANGUAGE_ZONE_ADMIN),
            'edit_item'             => __('Edit Albuum', LANGUAGE_ZONE_ADMIN),
            'new_item'              => __('New Album', LANGUAGE_ZONE_ADMIN),
            'view_item'             => __('View Album', LANGUAGE_ZONE_ADMIN),
            'search_items'          => __('Search Albums', LANGUAGE_ZONE_ADMIN),
            'not_found'             => __('No albums found.', LANGUAGE_ZONE_ADMIN),
            'not_found_in_trash'    => __('No albums found in trash.', LANGUAGE_ZONE_ADMIN),
            'parent_item_colon'     => ''
        );

        $args = array(
            'labels'                => $labels,
            'taxonomies'            => array( 'post_tag' ),
            'public'                => true,
            'publicly_queryable'    => true,
            'exclude_from_search'   => true,
            'show_ui'               => true,
            'query_var'             => true,
            'rewrite'               => true,
            //'has_archive'           => true,
            'hierarchical'          => false,
            'menu_position'         => null,
            'capability_type'       => 'post',
            'supports'              => array('title','thumbnail', 'editor', 'excerpt', 'comments'),
            'menu_icon'             => 'dashicons-playlist-audio'
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

        // Add new taxonomy, NOT hierarchical (like tags)
        $labels = array(
            'name' => _x( 'Tags', 'taxonomy general name' ),
            'singular_name' => _x( 'Tag', 'taxonomy singular name' ),
            'search_items' =>  __( 'Search Tags' ),
            'popular_items' => __( 'Popular Tags' ),
            'all_items' => __( 'All Tags' ),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __( 'Edit Tag' ),
            'update_item' => __( 'Update Tag' ),
            'add_new_item' => __( 'Add New Tag' ),
            'new_item_name' => __( 'New Tag Name' ),
            'separate_items_with_commas' => __( 'Separate tags with commas' ),
            'add_or_remove_items' => __( 'Add or remove tags' ),
            'choose_from_most_used' => __( 'Choose from the most used tags' ),
            'menu_name' => __( 'Tags' ),
        );

        register_taxonomy($this->postTypeTag, $this->postType, array(
            'hierarchical' => false,
            'labels' => $labels,
            'show_ui' => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => true,
            //'rewrite' => array( 'slug' => 'ctag' ),
        ));

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
            $title = __('Album title...', LANGUAGE_ZONE_ADMIN);
        }

        return $title;
    }


    public function add_taxonomy_objects() {
        register_taxonomy_for_object_type('post_tag', AlbumPostType::get_instance()->postType);
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
AlbumPostType::get_instance();