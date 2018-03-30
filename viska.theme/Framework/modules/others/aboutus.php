<?php
/**
 * Project of Megadrupal.com
 * Author: duongle
 * Date: 6/13/14
 * Time: 10:55 AM
 */

class AWEAboutus extends AweFramework
{
    const NAME="awe_aboutus";
    public function __construct()
    {
        //Register portfolio
        add_action( 'init',                                         array($this,'register_about_us') );
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
        if(!$this->is_about_us_screen())
            return;
        wp_dequeue_script( 'autosave' );
    }
    /**
     * Check is portfolio screen
     *
     * @return bool
     */
    public function is_about_us_screen()
    {
        return $this->is_support(self::NAME);
    }


    /**
     * Register portfolio
     */
    public function register_about_us()
    {
        $labels = array(
            'name'               => _x( 'About Us', 'post type general name', self::LANG ),
            'singular_name'      => _x( 'About Us', 'post type singular name', self::LANG ),
            'menu_name'          => _x( 'About Us', 'admin menu', self::LANG ),
            'name_admin_bar'     => _x( 'About Us', 'add new on admin bar', self::LANG ),
            'add_new'            => _x( 'Add New', 'about us', self::LANG ),
            'add_new_item'       => __( 'Add New About Us', self::LANG ),
            'new_item'           => __( 'New About Us', self::LANG ),
            'edit_item'          => __( 'Edit About Us', self::LANG ),
            'view_item'          => __( 'View About Us', self::LANG ),
            'all_items'          => __( 'All About Us', self::LANG ),
            'search_items'       => __( 'Search About Us', self::LANG ),
            'parent_item_colon'  => __( 'Parent About Us:', self::LANG ),
            'not_found'          => __( 'No About Us found.', self::LANG ),
            'not_found_in_trash' => __( 'No About Us found in Trash.', self::LANG ),
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array('slug' => 'aboutus'),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => true,
            'menu_position'      => 7,
            'menu_icon'          => 'dashicons-groups',
            'supports'           => array( self::NAME ,'title' )
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
            1  => __( 'About Us updated.', self::LANG ),
            2  => __( 'Custom field updated.', self::LANG ),
            3  => __( 'Custom field deleted.', self::LANG ),
            4  => __( 'About Us updated.', self::LANG ),
            /* translators: %s: date and time of the revision */
            5  => isset( $_GET['revision'] ) ? sprintf( __( 'About Us restored to revision from %s', self::LANG ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
            6  => __( 'About Us published.', self::LANG ),
            7  => __( 'About Us saved.', self::LANG ),
            8  => __( 'About Us submitted.', self::LANG ),
            9  => sprintf(
                __( 'About Us scheduled for: <strong>%1$s</strong>.', self::LANG ),
                // translators: Publish box date format, see http://php.net/date
                date_i18n( __( 'M j, Y @ G:i', self::LANG ), strtotime( $post->post_date ) )
            ),
            10 => __( 'About Us draft updated.', self::LANG ),
        );
        return $messages;

    }

}