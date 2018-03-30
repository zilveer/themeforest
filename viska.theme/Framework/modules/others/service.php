<?php
/**
 * Project of Megadrupal.com
 * Author: duongle
 * Date: 4/25/14
 * Time: 11:58 AM
 */

class AWEService extends AweFramework
{
    const NAME = "awe_service";
    public $service_option = array(
        'logo'      =>  array(
            'type'      => 'icon',
            'image'     => '',
            'icon'      => 'fa fa-wrench',
        ),
        'summary'   =>  '',

    );
    public function __construct()
    {
        $this->service_option['logo']['image'] = AWE_ROOT_URL."asset/images/logo.png";
        //loading script
        add_action( 'admin_enqueue_scripts',                array($this, 'loading_js') );
        add_action( 'admin_enqueue_scripts',                   array($this, 'loading_css'));
        //init register service
        add_action( 'init',                                 array($this, 'register_service') );
        add_action( 'edit_form_after_title',                array($this, 'settings_panel'));
        // save service
        add_action( 'save_post',                            array($this, 'service_save'),                                1,2);
        add_filter( 'post_updated_messages',                array($this, 'filter_messages'));
        //remove permalinks on edit screen
        add_filter( 'get_sample_permalink_html',            array($this, 'hide_permalinks'));
        //remove view link on post lists screen
        add_filter( 'post_row_actions',                     array($this,'remove_row_actions'), 10, 1 );
        //fitler title
        add_filter( 'gettext',                              array($this, 'custom_enter_title'));
    }

    /**
     * Check is service screen
     *
     * @return bool
     */
    public function is_service_screen()
    {
        return $this->is_support(self::NAME);
    }

    /**
     * Loading JS
     */
    public function loading_js()
    {
        if(!$this->is_service_screen())
            return;
        if(AWE_DEBUG==true)
            $min=".min";
        else
            $min="";
        wp_enqueue_script('awe-service', AWE_JS_URL. 'service'.$min.'.js', array("jquery"), null, false);
    }

    /**
     * Loading CSS
     */
    public function loading_css()
    {
        if(!$this->is_service_screen())
            return;
        wp_register_style( 'awe-service', AWE_CSS_URL. 'service.css', false, '1.0.0' );
        wp_register_style( 'awe-font-icon', AWE_CSS_URL. 'font-icon.css', false, '1.0.0' );
        wp_register_style( 'awe-popup', AWE_CSS_URL. 'popup.css', false, '1.0.0' );
//        wp_register_style( 'awe-font-awesome', AWE_CSS_URL. 'fot-awesome.min.css', false, '1.0.0' );
        wp_enqueue_style( 'awe-service' );
        wp_enqueue_style( 'awe-popup' );
        wp_enqueue_style( 'awe-font-icon' );
//        wp_enqueue_style( 'awe-font-awesome' );
    }


    /**
     * Register Service Custom Post Type
     */
    public function register_service()
    {
        $labels = array(
            'name'               => _x( 'Service', 'post type general name', self::LANG ),
            'singular_name'      => _x( 'Service', 'post type singular name', self::LANG ),
            'menu_name'          => _x( 'Service', 'admin menu', self::LANG ),
            'name_admin_bar'     => _x( 'Service', 'add new on admin bar', self::LANG ),
            'add_new'            => _x( 'Add New', 'service', self::LANG ),
            'add_new_item'       => __( 'Add New Service', self::LANG ),
            'new_item'           => __( 'New Service', self::LANG ),
            'edit_item'          => __( 'Edit Service', self::LANG ),
            'view_item'          => __( 'View Service', self::LANG ),
            'all_items'          => __( 'All Services', self::LANG ),
            'search_items'       => __( 'Search Service', self::LANG ),
            'parent_item_colon'  => __( 'Parent Services:', self::LANG ),
            'not_found'          => __( 'No service found.', self::LANG ),
            'not_found_in_trash' => __( 'No services found in Trash.', self::LANG ),
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
            'menu_icon'          => 'dashicons-admin-tools',
            'supports'           => array( 'title', self::NAME)
        );

        register_post_type( self::NAME, $args );

    }

    /**
     * Hide permalink text, view button, edit slug button bellow Title
     * @param $in
     *
     * @return string
     */
    public function hide_permalinks($in){
        if(!$this->is_service_screen())
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
        if(!$this->is_service_screen())
            return $actions;
        if( get_post_type() === self::NAME )
            unset( $actions['view'] );
        return $actions;
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
            1  => __( 'Service updated.', self::LANG ),
            2  => __( 'Custom field updated.', self::LANG ),
            3  => __( 'Custom field deleted.', self::LANG ),
            4  => __( 'Service updated.', self::LANG ),
            /* translators: %s: date and time of the revision */
            5  => isset( $_GET['revision'] ) ? sprintf( __( 'Service restored to revision from %s', self::LANG ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
            6  => __( 'Service published.', self::LANG ),
            7  => __( 'Service saved.', self::LANG ),
            8  => __( 'Service submitted.', self::LANG ),
            9  => sprintf(
                __( 'Service scheduled for: <strong>%1$s</strong>.', self::LANG ),
                // translators: Publish box date format, see http://php.net/date
                date_i18n( __( 'M j, Y @ G:i', self::LANG ), strtotime( $post->post_date ) )
            ),
            10 => __( 'Service draft updated.', self::LANG ),
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
        if(!$this->is_service_screen())
            return $input;
        global $post_type;
        if(self::NAME != $post_type)
            return $input;
        if( 'Enter title here' == $input)
            return __('Enter Service Name',self::LANG);

        return $input;
    }
    /**
     * Generate additional options service
     * Show after title
     */
    public function settings_panel()
    {
        if(!$this->is_service_screen())
            return;
        wp_nonce_field( self::NAME.'_save', self::NAME.'_nonce' );
        include('service_tpl.php');
    }


    /**
     * Save additional options service
     */
    public function service_save($post_id, $post)
    {
        if(!$this->is_service_screen())
            return;
        if(!isset($_POST['service']))
            return;

        $data = wp_parse_args( $_POST['service'], $this->service_option );
        $this->save_custom_fields( $data, self::NAME.'_save', self::NAME.'_nonce', $post );

    }


}