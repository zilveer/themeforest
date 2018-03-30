<?php
/**
 * Project of Megadrupal.com
 * Author: duongle
 * Date: 4/29/14
 * Time: 5:46 PM
 */

class AWETestimonial extends AweFramework
{
    const NAME = "awe_testimonial";

    public $testimonial_option = array(
        'photo'         =>  '',
        'subtitle'      =>  '',
        'quote'         =>  '',
    );

    public function __construct()
    {
        $this->testimonial_option['photo'] = AWE_ROOT_URL."asset/images/avatar.jpg";
        //init register service
        add_action( 'init',                                 array($this,'register_testimonial') );
        //loading script
        add_action( 'admin_enqueue_scripts',                array($this, 'loading_js') );

        add_action( 'edit_form_after_title',                array($this, 'settings_panel'));
        // save service
        add_action( 'save_post',                            array($this, 'testimonial_save'),  1,2);
        add_filter( 'post_updated_messages',                array($this, 'filter_messages'));
        //remove permalinks on edit screen
        add_filter( 'get_sample_permalink_html',            array($this, 'hide_permalinks'));
        //remove view link on post lists screen
        add_filter( 'post_row_actions',                     array($this, 'remove_row_actions'), 10, 1 );
        //fitler title
        add_filter( 'gettext',                              array($this, 'custom_enter_title'));
    }

    /**
     * Loading JS
     */
    public function loading_js()
    {
        if(!$this->is_testimonial_screen())
            return;
        if(AWE_DEBUG==true)
            $min=".min";
        else
            $min="";
        wp_enqueue_script('awe-service', AWE_JS_URL. 'testimonial'.$min.'.js', array("jquery"), null, false);
    }

    /**
     * Check is testimonial screen
     *
     * @return bool
     */
    public function is_testimonial_screen()
    {
        return $this->is_support(self::NAME);
    }

    public function register_testimonial()
    {
        $labels = array(
            'name'               => _x( 'Testimonials', 'post type general name', self::LANG ),
            'singular_name'      => _x( 'Testimonial', 'post type singular name', self::LANG ),
            'menu_name'          => _x( 'Testimonial', 'admin menu', self::LANG ),
            'name_admin_bar'     => _x( 'Testimonial', 'add new on admin bar', self::LANG ),
            'add_new'            => _x( 'Add New', 'testimonial', self::LANG ),
            'add_new_item'       => __( 'Add New Testimonial', self::LANG ),
            'new_item'           => __( 'New Testimonial', self::LANG ),
            'edit_item'          => __( 'Edit Testimonial', self::LANG ),
            'view_item'          => __( 'View Testimonial', self::LANG ),
            'all_items'          => __( 'All Testimonials', self::LANG ),
            'search_items'       => __( 'Search Testimonial', self::LANG ),
            'parent_item_colon'  => __( 'Parent Testimonial:', self::LANG ),
            'not_found'          => __( 'No Testimonial found.', self::LANG ),
            'not_found_in_trash' => __( 'No Testimonial found in Trash.', self::LANG ),
        );


        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array('slug' => self::NAME),
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => false,
            'menu_position'      => 7,
            'menu_icon'          => 'dashicons-format-chat',
            'supports'           => array( self::NAME,'title','slug')
        );

        register_post_type( self::NAME, $args );

        ######## Register Categories #######
        $labels = array(
            'name'              => _x( 'Testimonial Categories', 'taxonomy general name',self::LANG ),
            'singular_name'     => _x( 'Testimonial Category', 'taxonomy singular name',self::LANG ),
            'search_items'      => __( 'Search Testimonial Categories',self::LANG ),
            'all_items'         => __( 'All Testimonial Categories',self::LANG ),
            'parent_item'       => __( 'Parent Testimonial Category',self::LANG ),
            'parent_item_colon' => __( 'Parent Testimonial Category:',self::LANG ),
            'edit_item'         => __( 'Edit Testimonial Category',self::LANG ),
            'update_item'       => __( 'Update Testimonial Category',self::LANG ),
            'add_new_item'      => __( 'Add New Testimonial Category',self::LANG ),
            'new_item_name'     => __( 'New Testimonial Category Name',self::LANG ),
            'menu_name'         => __( 'Categories',self::LANG ),
        );

        register_taxonomy('testimonial_cat',array(self::NAME), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav'   => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'testimonial_cat' ),
        ));
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
            1  => __( 'Testimonial updated.', self::LANG ),
            2  => __( 'Custom field updated.', self::LANG ),
            3  => __( 'Custom field deleted.', self::LANG ),
            4  => __( 'Testimonial updated.', self::LANG ),
            /* translators: %s: date and time of the revision */
            5  => isset( $_GET['revision'] ) ? sprintf( __( 'Testimonial restored to revision from %s', self::LANG ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
            6  => __( 'Testimonial published.', self::LANG ),
            7  => __( 'Testimonial saved.', self::LANG ),
            8  => __( 'Testimonial submitted.', self::LANG ),
            9  => sprintf(
                __( 'Testimonial scheduled for: <strong>%1$s</strong>.', self::LANG ),
                // translators: Publish box date format, see http://php.net/date
                date_i18n( __( 'M j, Y @ G:i', self::LANG ), strtotime( $post->post_date ) )
            ),
            10 => __( 'Testimonial draft updated.', self::LANG ),
        );
        return $messages;

    }

    /**
     * Filter Enter Title Here
     * @param $input
     *
     * @return string
     */
    public function custom_enter_title( $input ) {
        if(!$this->is_testimonial_screen())
            return $input;
        global $post_type;
        if(self::NAME != $post_type)
            return $input;
        if( 'Enter title here' == $input)
            return __('Enter name',self::LANG);

        return $input;
    }

    /**
     * Hide permalink text, view button, edit slug button bellow Title
     * @param $in
     *
     * @return string
     */
    public function hide_permalinks($in){
        if(!$this->is_testimonial_screen())
            return $in;
        return '';
    }


    /**
     * Remove the 'View' link from the admin posts list screen
     * @param $actions
     *
     * @return mixed
     */
    function remove_row_actions( $actions )
    {
        if(!$this->is_testimonial_screen())
            return $actions;
        if( get_post_type() === self::NAME )
            unset( $actions['view'] );
        return $actions;
    }

    public function settings_panel()
    {
        if(!$this->is_testimonial_screen())
            return;
        wp_nonce_field( 'awe_testimonial_save', 'awe_testimonial_nonce' );
        include_once("testimonial_tpl.php");
    }

    public function testimonial_save($post_id, $post)
    {
        if(!$this->is_testimonial_screen())
            return;
        if(!isset($_POST['testimonial']))
            return;

        $data = wp_parse_args( $_POST['testimonial'], $this->testimonial_option );
        $this->save_custom_fields( $data, 'awe_testimonial_save', 'awe_testimonial_nonce', $post );
    }
}