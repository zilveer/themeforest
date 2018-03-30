<?php
/**
 * Project of Megadrupal.com
 * Author: duongle
 * Date: 4/25/14
 * Time: 3:13 PM
 */

class AWEPricingTable extends AweFramework
{
    const NAME="awe_pricing_table";
    public function __construct()
    {
        //Register
        add_action( 'init',                                         array($this,'register_pricing_table') );

        //loading script
        add_action( 'admin_enqueue_scripts',                array($this, 'loading_js') );
        //Save singular metabox
        add_filter( 'post_updated_messages',                        array($this, 'filter_messages'));
    }

    /**
     * Loading JS
     */
    public function loading_js()
    {
        if(!$this->is_pricing_screen())
            return;
        wp_dequeue_script( 'autosave' );
    }
    /**
     * Check is portfolio screen
     *
     * @return bool
     */
    public function is_pricing_screen()
    {
        return $this->is_support(self::NAME);
    }


    /**
     * Register portfolio
     */
    public function register_pricing_table()
    {
        $labels = array(
            'name'               => _x( 'Pricing Tables', 'post type general name', self::LANG ),
            'singular_name'      => _x( 'Pricing Table', 'post type singular name', self::LANG ),
            'menu_name'          => _x( 'Pricing Table', 'admin menu', self::LANG ),
            'name_admin_bar'     => _x( 'Pricing Table', 'add new on admin bar', self::LANG ),
            'add_new'            => _x( 'Add New', 'Pricing Table', self::LANG ),
            'add_new_item'       => __( 'Add New Pricing Table', self::LANG ),
            'new_item'           => __( 'New Pricing Table', self::LANG ),
            'edit_item'          => __( 'Edit Pricing Table', self::LANG ),
            'view_item'          => __( 'View Pricing Table', self::LANG ),
            'all_items'          => __( 'All Pricing Tables', self::LANG ),
            'search_items'       => __( 'Search Pricing Table', self::LANG ),
            'parent_item_colon'  => __( 'Parent Pricing Table:', self::LANG ),
            'not_found'          => __( 'No Pricing Table found.', self::LANG ),
            'not_found_in_trash' => __( 'No Pricing Tables found in Trash.', self::LANG ),
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array('slug' => 'pricing_table'),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => true,
            'menu_position'      => 8,
            'menu_icon'          => 'dashicons-chart-area',
            'supports'           => array( self::NAME ,'title')
        );

        register_post_type( self::NAME, $args );


    }

    /**
     * Fitler message for service custom post type
     * @param $messages
     *
     * @return mixed
     */
    public function filter_messages($messages)
    {
        global $post;
        $messages[self::NAME]= array(
            0  => '',
            1  => __( 'Pricing Table updated.', self::LANG ),
            2  => __( 'Custom field updated.', self::LANG ),
            3  => __( 'Custom field deleted.', self::LANG ),
            4  => __( 'Pricing Table updated.', self::LANG ),
            /* translators: %s: date and time of the revision */
            5  => isset( $_GET['revision'] ) ? sprintf( __( 'Pricing Table restored to revision from %s', self::LANG ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
            6  => __( 'Pricing Table published.', self::LANG ),
            7  => __( 'Pricing Table saved.', self::LANG ),
            8  => __( 'Pricing Table submitted.', self::LANG ),
            9  => sprintf(
                __( 'Pricing Table scheduled for: <strong>%1$s</strong>.', self::LANG ),
                // translators: Publish box date format, see http://php.net/date
                date_i18n( __( 'M j, Y @ G:i', self::LANG ), strtotime( $post->post_date ) )
            ),
            10 => __( 'Pricing Table draft updated.', self::LANG ),
        );
        return $messages;

    }

}