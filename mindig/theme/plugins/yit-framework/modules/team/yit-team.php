<?php
/**
 * @package Yithemes
 * @version 1.0
 */

/**
 * YIT Team
 *
 * Manage the team features in the YIT Framework
 *
 * @class YIT_Team
 * @package	Yithemes
 * @since 1.0
 * @author Your Inspiration Themes
 */
class YIT_Team{
    /**
     * @var string
     * @since 1.0
     */
    public $version = YIT_TEAM_VERSION;

    /**
     * @var object The single instance of the class
     * @since 1.0
     * @since 1.0
     */
    protected static $_instance = null;

    /**
     * @var string
     * @since 1.0
     */
    public $plugin_url;

    /**
     * @var string
     * @since 1.0
     */
    public $plugin_path;

    /**
     * @var string $teams_post_type The post type name for the post type of all teams
     * @since 1.0
     */
    public $teams_post_type = 'teams';

    /**
     * @var string $post_type_prefix The post type of each team
     * @since 1.0
     */
    public $post_type_prefix = 'team_';

    /**
     * @var \YIT_CPT_Unlimited Manage the object of cptu
     * @since 1.0
     */
    public $cptu = null;

    /**
     * Main plugin Instance
     *
     * @static
     * @return object Main instance
     *
     * @since 1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * Constructor
     *
     * Initialize plugin and registers the team cpt
     */
    public function __construct(){
        add_action( 'after_setup_theme', array( $this, 'add_shortcodes_button' ) );

        // define the url and path of plugin
        $this->plugin_url        = untrailingslashit( get_template_directory_uri() . '/theme/plugins/yit-framework/team' );
	    $this->plugin_path       = untrailingslashit( get_template_directory() . '/theme/plugins/yit-framework/team' );

	    // fix the base url and base path in case is the plugin
	    add_action( 'after_setup_theme', array( $this, 'set_path_and_url_by_plugin' ) );

        // Register CPTU
        add_action( 'after_setup_theme', array( $this, 'register_cptu' ), 20 );

        // admin
        add_action( 'admin_init', array( $this, 'customize_table_list_columns' ) );

        // add the shortcode 'team'
        add_shortcode( 'team_section', array( $this, 'add_shortcode' ) );

        $this->add_image_size();

    }

	/**
	 * Fix the base path and base url of plugin
	 *
	 * As soon as the plugin is instantiated, the base path and url are from the YIT theme, but this method is hook
	 * inside 'plugins_loaded', so if it is called, the base path and url must be from plugin
	 */
	public function set_path_and_url_by_plugin() {
        if ( file_exists( get_template_directory() . '/theme/plugins/yit-framework/' ) ) {
            return;
        }

		$this->plugin_url        = untrailingslashit( plugins_url( '/', __FILE__ ) );
		$this->plugin_path       = untrailingslashit( plugin_dir_path( __FILE__ ) );
	}

    /**
     * Load the core of the plugin, added to "after_theme_setup" so you can load the core only if it isn't loaded by plugin
     *
     * @return void
     * @since 1.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.com>
     */
    public function add_shortcodes_button() {
        //add the shortcode button to shortcode panel
        if ( defined( 'YIT_SHORTCODE' ) ) {
            add_filter( 'yit-shortcode-plugin-init', array( $this, 'add_shortcode_to_panel' ) );
            add_filter( 'yit_shortcode_team_section_icon', array( $this, 'shortcode_icon' ), 10, 2 );
        }
    }

    /**
     * Register the Custom Post Type Unlimited
     *
     * @return void
     * @since 1.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.com>
     */
    public function register_cptu() {
        include_once( YIT_CORE_PLUGIN_PATH . '/lib/yit-cpt-unlimited.php' );

        $this->cptu = new YIT_CPT_Unlimited( array(
            'name'              => $this->teams_post_type,
            'post_type_prefix'  => $this->post_type_prefix,
            'labels'            => array(
                'main_name' => __( 'Team', 'yit' ),
                'singular'  => __( 'Team', 'yit' ),
                'plural'    => __( 'Teams', 'yit' ),
                'menu'      => __( 'Team', 'yit' )
            ),
            'plugin_path'       => $this->plugin_path,
            'plugin_url'        => $this->plugin_url,
            'manage_layouts'    => false,
            'add_multiuploader' => true,
            'has_single'        => false,
            'has_taxonomy'      => false,
            'label_item_sing'   => __( 'Member', 'yit' ),
            'label_item_plur'   => __( 'Members', 'yit' ),
            'menu_icon'         => 'dashicons-groups',
        ) );

        $this->cptu->add_item_fields( apply_filters( 'yit_team_input_fields', array(
            'member_role' => array(
                'label' => __( 'Member role', 'yit' ),
                'type'  => 'text',
                'desc'  => __( 'Insert role of team member (leave empty to not use it)', 'yit' ),
                'std'   => ''
            ),

        ) ));
    }

    /**
     * Actions to customize the columns of table list
     *
     * @return array
     * @since  1.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.com>
     */
    public function customize_table_list_columns() {
        add_filter( 'manage_edit-' . $this->teams_post_type . '_columns', array( $this, 'teams_define_columns' ) );
        add_action( 'manage_' . $this->teams_post_type . '_posts_custom_column' , array( $this, 'teams_change_columns' ), 10, 2 );
    }

    /**
     * Define the columns to use in the list table of main teams post type
     *
     * @param $columns array The columns used in the list table
     *
     * @return array
     * @since  1.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.com>
     */
    public function teams_define_columns( $columns ) {
        unset( $columns['date'] );

        $columns['items']      = __( 'Items', 'yit' );

        return $columns;
    }

    /**
     * Change the content of each column of the table list
     *
     * @param $column string The current column
     * @param $post_id int The current post ID
     *
     * @return void
     * @since  1.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.com>
     */
    public function teams_change_columns( $column, $post_id ) {
        $post = get_post( $post_id );

        if( ! empty( $post ) ){
            switch ( $column ) {

                case 'items' :
                    $count_posts = wp_count_posts( get_post_meta( $post_id, '_post_type', true ) );
                    echo ( isset( $count_posts->publish  ) ) ?  $count_posts->publish : '';
                    break;
            }
        }
    }

    /**
     * Callback that prints the shortcode
     *
     * @param mixed[] $atts Shortcode attributes
     * @param string  $content Shortcode content
     *
     * @return string Html markup of the shortcode
     * @since 1.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.com>
     */
    public function add_shortcode( $atts, $content = "" ) {

        $shortcode = $this->shortcode_hook();

        $default_atts = array();

        if ( ! empty( $shortcode['team_section']['attributes'] ) ) {
            foreach ( $shortcode['team_section']['attributes'] as $name => $type ) {
                $default_atts[$name] = isset( $type['std'] ) ? $type['std'] : '';
                if( isset( $atts[$name] ) && $type['type'] == "checkbox"  ){
                    if ( $atts[$name] == 1 || $atts[$name] == 'yes' ){
                        $atts[$name] = 'yes';
                    }else{
                        $atts[$name] = 'no';
                    }

                }
            }
        }

        //combines with user attributes
        $atts = shortcode_atts( $default_atts, $atts );

        global $wpdb;
        $atts['post_type'] = get_post_meta( $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_name = %s AND post_type = %s", $atts['team'], $this->teams_post_type ) ), '_post_type', true );

        ob_start();

        yit_plugin_get_template( $this->plugin_path, 'shortcodes/team_section.php', $atts );

        $shortcode_html = ob_get_clean();

        return apply_filters( 'yit_shortcode_team', $shortcode_html );

    }

    /**
     * Returns an array with all shortcode for team plugin
     *
     * @return mixed[]
     * @since  1.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.com>
     */
    public function shortcode_hook(){
        return apply_filters( 'yit_team_section_shortcode', array(
            'team_section' => array(
                'title' => __( 'Team', 'yit' ),
                'description' => __( 'Adds a slider with team members', 'yit' ),
                'tab' => 'section',
                'create' => false,
                'has_content'  => false,
                'in_visual_composer' => true,
                'attributes' => array(
                    'team' => array(
                        'title' => __( 'Team', 'yit' ),
                        'type' => 'select',
                        'options' => $this->get_teams(),
                        'std' => ''
                    ),
                    'nitems' => array(
                        'title' => __( 'Number of member', 'yit' ),
                        'type' => 'number',
                        'min' => -1,
                        'max' => 99,
                        'std' => -1
                    ),
                    'show_role' => array(
                        'title' => __( 'Show role', 'yit' ),
                        'type' => 'checkbox',
                        'std' => 'yes'
                    )
                )
            )
        ));
    }

    /**
     * Add shortcode to shortcode panel
     *
     * @param $shortcodes mixed[] Array of shortcodes
     *
     * @return mixed[]
     * @since  1.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.com>
     */
    public function add_shortcode_to_panel( $shortcodes ){
        return array_merge( $shortcodes, $this->shortcode_hook() );
    }

    /**
     * Add shortcode icon for shortcode panel
     *
     * @return void
     * @since  1.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.com>
    */
    public function shortcode_icon( $default ){
        return $default;
    }

    /**
     * Returns list of teams defined
     *
     * @return string[]
     * @since  1.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.com>
     */
    public function get_teams(){
        $args = array(
            'post_type' => $this->teams_post_type,
            'order' => 'ASC',
            'posts_per_page' => -1
        );

        $results = array();
        $posts = get_posts( $args );

        if( ! empty( $posts ) ){
            foreach( $posts as $post ){
                $results[ $post->post_name] = $post->post_title;
            }
        }

        return $results;
    }

    /**
     * Add image size for team shortcode
     *
     * @return void
     * @since  1.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.com>
    */
    public function add_image_size(){
        add_image_size( 'thumb_team_big', 369, 372, true );
    }
}

/**
 * Main instance of plugin
 *
 * @return \YIT_Team
 * @since  1.0
 * @author Antonio La Rocca <antonio.larocca@yithemes.com>
 */
function YIT_Team() {
    return YIT_Team::instance();
}

/**
 * Instantiate Team class
 *
 * @since  1.0
 * @author Antonio La Rocca <antonio.larocca@yithemes.com>
 */
YIT_Team();