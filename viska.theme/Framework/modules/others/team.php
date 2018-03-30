<?php
/**
 * Project of Megadrupal.com
 * Author: duongle
 * Date: 4/25/14
 * Time: 4:50 PM
 */


class AWETeam  extends AweFramework
{
    const NAME = "awe_team";
    public $team_option = array(
        'position'      =>  '',
        'skills'         =>  array(),
        'smallintro'        =>  '',
        'photo'        =>  '',

    );

    public function __construct()
    {
        $this->team_option['photo'] = AWE_ROOT_URL."asset/images/avatar.jpg";
        //init register service
        add_action( 'init',                                 array($this,'register_team') );
        add_action( 'edit_form_after_title',                array($this, 'settings_panel'));


        //loading script
        add_action( 'admin_enqueue_scripts',                array($this, 'loading_js') );
        add_action( 'admin_enqueue_scripts',                   array($this, 'loading_css'));
        // save service
        add_action( 'save_post',                            array($this, 'team_save'),                                1,2);
        add_filter( 'post_updated_messages',                array($this, 'filter_messages'));

        //filter social title
        add_filter( 'gettext',                              array($this, 'custom_enter_title'));
        add_filter( 'awe_social_title',                     array($this, 'filter_social_title'));
      //  add_filter( 'awe_social_fields',                    array($this, 'filter_social_fields'));
    }

    public function filter_social_fields($fields)
    {
        $social = array(
            'facebook'  =>  'fa fa-facebook-square',
            'google'    =>  'fa fa-google-plus',
            'twitter'   =>  'fa fa-twitter-square',
        );
        return $social;
    }

    public function filter_social_title($title)
    {
        if($this->is_support('awe_social'))
            return __('Social Contact',self::LANG);
        return $title;
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
        wp_enqueue_script('awe-service', AWE_JS_URL. 'team'.$min.'.js', array("jquery"), null, false);
        wp_dequeue_script( 'autosave' );
    }

    /**
     * Loading CSS
     */
    public function loading_css()
    {
        if(!$this->is_service_screen())
            return;
        wp_register_style( 'awe-team', AWE_CSS_URL. 'team.css', false, '1.0.0' );


//        if(wp_script_is('style-shortcodepop'))

        wp_enqueue_style( 'awe-team' );


        if(!wp_style_is('awe-font-icon')){
            wp_register_style( 'awe-font-icon', AWE_CSS_URL. 'font-icon.css', false, '1.0.0' );
            wp_enqueue_style( 'awe-font-icon' );
            wp_register_style( 'awe-popup', AWE_CSS_URL. 'popup.css', false, '1.0.0' );
            wp_enqueue_style( 'awe-popup' );
        }
    }

    /**
     * Register About US Custom Post Type
     */
    public function register_team()
    {
        $labels = array(
            'name'               => _x( 'Members', 'post type general name', self::LANG ),
            'singular_name'      => _x( 'Member', 'post type singular name', self::LANG ),
            'menu_name'          => _x( 'Team Members', 'admin menu', self::LANG ),
            'name_admin_bar'     => _x( 'Member', 'add new on admin bar', self::LANG ),
            'add_new'            => _x( 'Add New', 'member', self::LANG ),
            'add_new_item'       => __( 'Add New Member', self::LANG ),
            'new_item'           => __( 'New Member', self::LANG ),
            'edit_item'          => __( 'Edit Member', self::LANG ),
            'view_item'          => __( 'View Member', self::LANG ),
            'all_items'          => __( 'All Members', self::LANG ),
            'search_items'       => __( 'Search Member', self::LANG ),
            'parent_item_colon'  => __( 'Parent Member:', self::LANG ),
            'not_found'          => __( 'No Member found.', self::LANG ),
            'not_found_in_trash' => __( 'No Members found in Trash.', self::LANG ),
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
            'has_archive'        => true,
            'hierarchical'       => true,
            'menu_position'      => 7,
            'menu_icon'          => 'dashicons-groups',
//            'taxonomies'         => array('category'),
            'supports'           => array( self::NAME,'title', 'author')//,'awe_skill','awe_social','awe_offer','awe_feature','awe_resume','awe_funfact')
        );

        register_post_type( self::NAME, $args );


        $labels = array(
            'name'              => _x( 'Team Categories', 'taxonomy general name',self::LANG ),
            'singular_name'     => _x( 'Team Categorie', 'taxonomy singular name',self::LANG ),
            'search_items'      => __( 'Search Team Categories',self::LANG ),
            'all_items'         => __( 'All Team Categories',self::LANG ),
            'parent_item'       => __( 'Parent Team Category',self::LANG ),
            'parent_item_colon' => __( 'Parent Team Category:',self::LANG ),
            'edit_item'         => __( 'Edit Team Category',self::LANG ),
            'update_item'       => __( 'Update Team Category',self::LANG ),
            'add_new_item'      => __( 'Add New Team Category',self::LANG ),
            'new_item_name'     => __( 'New Team Category Name',self::LANG ),
            'menu_name'         => __( 'Categories',self::LANG ),
        );
        register_taxonomy('teamcat',array(self::NAME), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav'   => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'teamcat' ),
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
            1  => __( 'Member updated.', self::LANG ),
            2  => __( 'Custom field updated.', self::LANG ),
            3  => __( 'Custom field deleted.', self::LANG ),
            4  => __( 'Member updated.', self::LANG ),
            /* translators: %s: date and time of the revision */
            5  => isset( $_GET['revision'] ) ? sprintf( __( 'Member restored to revision from %s', self::LANG ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
            6  => __( 'Member published.', self::LANG ),
            7  => __( 'Member saved.', self::LANG ),
            8  => __( 'Member submitted.', self::LANG ),
            9  => sprintf(
                __( 'Service scheduled for: <strong>%1$s</strong>.', self::LANG ),
                // translators: Publish box date format, see http://php.net/date
                date_i18n( __( 'M j, Y @ G:i', self::LANG ), strtotime( $post->post_date ) )
            ),
            10 => __( 'Member draft updated.', self::LANG ),
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
            return __('Enter member name',self::LANG);

        return $input;
    }

    /**
     * Generate additional options service
     */
    public function settings_panel()
    {
        if(!$this->is_service_screen())
            return;
        wp_nonce_field( self::NAME.'_save', self::NAME.'_nonce' );
        include_once('team_tpl.php');
    }



    /**
     * Save additional options service
     */
    public function team_save($post_id, $post)
    {
        if(!$this->is_service_screen())
            return;
        if(!isset($_POST['team']))
            return;

        $data = wp_parse_args( $_POST['team'], $this->team_option );
//        var_dump($data);
        $this->save_custom_fields( $data, self::NAME.'_save', self::NAME.'_nonce', $post );
    }
}