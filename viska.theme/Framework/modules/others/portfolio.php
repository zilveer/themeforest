<?php
/**
 * Project of awethemes.com
 * Author: duongle
 * Date: 4/25/14
 * Time: 3:13 PM
 */

class AWEPortfolio extends AWEFramework
{
    const NAME="awe_portfolio";
    public $portfolio_options = array(
        'created_by'    => array(),
        'project_link'  => '',
    );
    public function __construct()
    {
        //Register portfolio
        add_action( 'init',                                         array($this,'register_portfolio') );
//        if($this->awe_main_option['team']==1){
            //Display content created by column
//            add_action( 'manage_awe_portfolio_posts_custom_column' ,    array($this,'display_created_by_stickiness'),                               10, 2 );
            //Add column created by on manage posts list
//            add_filter( 'manage_awe_portfolio_posts_columns' ,          array($this,'add_created_by_column') );
            //Add meta box created by
//            add_action( 'add_meta_boxes',                               array($this,'created_by_add_meta_box') );
//        }
        //loading script
        add_action( 'admin_enqueue_scripts',                array($this, 'loading_js') );
        //Save singular metabox
        add_action( 'edit_form_after_title',                        array($this, 'awe_link_project_html'));
        add_action( 'save_post',                                    array($this, 'awe_singular_portfolio_save'),                                 1,2);
        add_filter( 'post_updated_messages',                        array($this, 'filter_messages'));
    }

    /**
     * Loading JS
     */
    public function loading_js()
    {
        if(!$this->is_portfolio_screen())
            return;
        wp_dequeue_script( 'autosave' );
    }
    /**
     * Check is portfolio screen
     *
     * @return bool
     */
    public function is_portfolio_screen()
    {
        return $this->is_support(self::NAME);
    }


    /**
     * Register portfolio
     */
    public function register_portfolio()
    {
        $labels = array(
            'name'               => _x( 'Portfolios', 'post type general name', self::LANG ),
            'singular_name'      => _x( 'Portfolio', 'post type singular name', self::LANG ),
            'menu_name'          => _x( 'Portfolio', 'admin menu', self::LANG ),
            'name_admin_bar'     => _x( 'Portfolio', 'add new on admin bar', self::LANG ),
            'add_new'            => _x( 'Add New', 'portfolio', self::LANG ),
            'add_new_item'       => __( 'Add New Portfolio', self::LANG ),
            'new_item'           => __( 'New Portfolio', self::LANG ),
            'edit_item'          => __( 'Edit Portfolio', self::LANG ),
            'view_item'          => __( 'View Portfolio', self::LANG ),
            'all_items'          => __( 'All Portfolios', self::LANG ),
            'search_items'       => __( 'Search Portfolio', self::LANG ),
            'parent_item_colon'  => __( 'Parent Portfolio:', self::LANG ),
            'not_found'          => __( 'No Portfolio found.', self::LANG ),
            'not_found_in_trash' => __( 'No Portfolios found in Trash.', self::LANG ),
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array('slug' => 'portfolio'),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => true,
            'menu_position'      => 8,
            'menu_icon'          => 'dashicons-portfolio',
            'supports'           => array( self::NAME ,'title', 'editor','thumbnail' )
        );

        register_post_type( self::NAME, $args );

        ######## Register Categories #######
        $labels = array(
            'name'              => _x( 'Portfolio Categories', 'taxonomy general name',self::LANG ),
            'singular_name'     => _x( 'Portfolio Category', 'taxonomy singular name',self::LANG ),
            'search_items'      => __( 'Search Portfolio Categories',self::LANG ),
            'all_items'         => __( 'All Portfolio Categories',self::LANG ),
            'parent_item'       => __( 'Parent Portfolio Category',self::LANG ),
            'parent_item_colon' => __( 'Parent Portfolio Category:',self::LANG ),
            'edit_item'         => __( 'Edit Portfolio Category',self::LANG ),
            'update_item'       => __( 'Update Portfolio Category',self::LANG ),
            'add_new_item'      => __( 'Add New Portfolio Category',self::LANG ),
            'new_item_name'     => __( 'New Portfolio Category Name',self::LANG ),
            'menu_name'         => __( 'Categories',self::LANG ),
        );

        register_taxonomy('portfolio_cat',array(self::NAME), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav'   => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'portfolio_cat' ),
        ));

        ######## Register Tags #######

        $labels = array(
            'name'              => _x( 'Portfolio Tags', 'taxonomy general name',self::LANG ),
            'singular_name'     => _x( 'Portfolio Tag', 'taxonomy singular name',self::LANG ),
            'search_items'      => __( 'Search Portfolio Tags',self::LANG ),
            'all_items'         => __( 'All Portfolio Tags',self::LANG ),
            'parent_item'       => __( 'Parent Portfolio Tag',self::LANG ),
            'parent_item_colon' => __( 'Parent Portfolio Tag:',self::LANG ),
            'edit_item'         => __( 'Edit Portfolio Tag',self::LANG ),
            'update_item'       => __( 'Update Portfolio Tag',self::LANG ),
            'add_new_item'      => __( 'Add New Portfolio Tag',self::LANG ),
            'new_item_name'     => __( 'New Portfolio Tag Name',self::LANG ),
            'menu_name'         => __( 'Tags',self::LANG ),
        );

        register_taxonomy('portfolio_tag',array(self::NAME), array(
            'hierarchical' => false,
            'labels' => $labels,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav'   => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'portfolio_tag' ),
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
            1  => __( 'Portfolio updated.', self::LANG ),
            2  => __( 'Custom field updated.', self::LANG ),
            3  => __( 'Custom field deleted.', self::LANG ),
            4  => __( 'Portfolio updated.', self::LANG ),
            /* translators: %s: date and time of the revision */
            5  => isset( $_GET['revision'] ) ? sprintf( __( 'Portfolio restored to revision from %s', self::LANG ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
            6  => __( 'Portfolio published.', self::LANG ),
            7  => __( 'Portfolio saved.', self::LANG ),
            8  => __( 'Portfolio submitted.', self::LANG ),
            9  => sprintf(
                __( 'Portfolio scheduled for: <strong>%1$s</strong>.', self::LANG ),
                // translators: Publish box date format, see http://php.net/date
                date_i18n( __( 'M j, Y @ G:i', self::LANG ), strtotime( $post->post_date ) )
            ),
            10 => __( 'Portfolio draft updated.', self::LANG ),
        );
        return $messages;

    }

    /**
     * Register meta box
     * @param $post_type
     */
    public function created_by_add_meta_box($post_type)
    {
        if(!$this->is_portfolio_screen())
            return;
        if(post_type_supports($post_type,self::NAME)){
            add_meta_box('awe_singular_portfolio',__('Member of Project',self::LANG),array($this,'awe_singular_portfolio_html'),$post_type,'side','high');
            add_filter( "postbox_classes_{$post_type}_awe_singular_portfolio", array($this,'add_my_meta_box_classes') );
        }

    }

    public function awe_link_project_html(){
        if(!$this->is_portfolio_screen())
            return;
        wp_nonce_field( self::NAME.'_save', self::NAME.'_nonce' );
        $data = $this->get_custom_fields('project_link',$this->portfolio_options);
        ?>
        <div class="postbox awe-settings" id="awe_project_link">
            <div title="Click to toggle" class="handlediv"><br></div><h3 class="hndle"><span><?php _e('Project Link:',self::LANG);?></span></h3>
            <div class="inside">
                <input type="text" name="awe_portfolio[project_link]" value="<?php echo $data;?>">
            </div>
        </div>
        <?php
    }
    /**
     * Display Created by box on Portfolio editor screen
     */
    public function awe_singular_portfolio_html()
    {
        $posts = get_posts( array( 'post_type' => 'awe_team' ));
        wp_nonce_field( self::NAME.'_save', self::NAME.'_nonce' );

        if(!is_array($posts) || count($posts)<0){
            _e("Create Member Profile at <a href=\"{get_bloginfo('home_url')}\">",self::LANG);
            return;
        }
        $data = $this->get_custom_fields('created_by');
        foreach($posts as $post):
            ?>
            <div class="tabs-panel" id="portfilio-created-by-all">
                <ul>
                    <li id="portfolio_created_by-<?php echo $post->ID;?>" style="">
                        <label><input type="checkbox" <?php if(is_array($data) && in_array($post->ID,$data)):?> checked="checked" <?php endif;?> name="awe_portfolio[created_by][]" value="<?php echo $post->ID;?>"> <?php echo $post->post_title;?></label>
                    </li>
                </ul>
            </div>
        <?php
        endforeach;

        return;
    }

    /**
     * Save meta post data
     * @param $post_id
     * @param $post
     */
    public function awe_singular_portfolio_save($post_id, $post)
    {
        if(!$this->is_portfolio_screen())
            return;
        if(!isset($_POST['awe_portfolio']))
            return;

        $data = wp_parse_args( $_POST['awe_portfolio'], $this->portfolio_options );
        $this->save_custom_fields( $data, self::NAME.'_save', self::NAME.'_nonce', $post );
    }
    /**
     * Add awe-settings class into wrap
     * @param array $classes
     *
     * @return array
     */
    public function add_my_meta_box_classes( $classes=array() ) {
        /* In order to ensure we don't duplicate classes, we should
            check to make sure it's not already in the array */
        if( !in_array( 'awe-settings', $classes ) )
            $classes[] = 'awe-settings';

        return $classes;
    }

    /**
     * Display created by column
     */
    public function display_created_by_stickiness( $column, $post_id ) {
        $lists = get_post_meta( $post_id, 'created_by', true );
        $resuslt=array();
        if(is_array($lists) && count($lists)>0)
            foreach($lists as $id)
            {
                $mpost = get_post($id);
                $results[] = sprintf('<a href="%1$s">%2$s</a>',$mpost->guid,$mpost->post_title);
            }
        echo implode(", ",$results);
    }


    /**
     * Add created by column to post list
     */
    public function add_created_by_column( $columns ) {
        return array_merge( $columns,
            array( 'created' => __( 'Member of project', self::LANG ) ) );
    }

}