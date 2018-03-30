<?php
/**
 * Your Inspiration Themes
 *
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Custom Post Type Unlimited
 *
 * General structure for the sliders, portfolio and gallery pages (and other similar)
 * where you are able to add many items for each post of a custom post type.
 *
 * The logic is:
 * - each custom post type will be a general section (Sliders, Portfolios, Galleries, etc..)
 * - each post of a custom post type will be each individual element (a slider, a portfolio, a gallery, etc...)
 * - each post will contain several configurations and an array with all elements of each section,
 * all this in several custom post meta of the post
 *
 * Examples:
 * $args = array(
 *
 *     'name' => '',    // nome generale della sezione (usato nel menu e in qualche label delle pagine admin)
 *     'icon_menu' => '',  // url dell'icona da far apparire nel menu, accanto al name
 *     'settings' => array(),   // insieme di opzioni per la pagina di configurazione
 *     'settings_item' => array(),   // insieme di opzioni per la pagina di configurazione del singolo elemento
 *     'labels' => array(
 *         'item_name_sing' => ''  // nome dell'elemento singolo al singolare (slide, work, photo, etc...)
 *         'item_name_plur' => ''  // nome dell'elemento singolo al plurale (slides, works, photos, etc...)
 *     ),
 *
 * );
 *
 * $yit->getModel('cpt_unlimited')->add( 'sliders', $args = array() );
 * yit_add_unlimited_post_type( 'sliders', $args );
 *
 *
 * @since 1.0.0
 */

class YIT_CPT_Unlimited {

    /**
     * All post types created here
     *
     * @var array
     * @since 1.0.0
     */
    protected $_post_types = array();

    /**
     * Name of the metabox fields, used in settings page
     *
     * @var array
     * @since 1.0.0
     */
    public $metabox_name = 'settings_post_type';

    /**
     * Property used for the page single
     *
     * @var array
     * @since 1.0.0
     */
    public $query_vars = array();

	/**
	 * Array of rules to add in custom stylesheet
	 *
	 * @var string
	 * @since 1.0.0
	 */
	protected $_customRules = '';

	/**
	 * Constructor
	 *
	 */
	public function __construct() {}

	/**
	 * Init
	 *
	 */
	public function init() {
	     // register the post types
	     add_action( 'init', array( &$this, 'register_post_types' ) );

	     // change the icon in the menu items
	     add_action( 'admin_head', array( &$this, 'change_icon_menu' ) );

	     // load the recerences for the post type unlimited page
	     add_action( 'admin_enqueue_scripts', array( &$this, 'enqueue_references' ) );

	     // add the options in the settings page of the post type
	     add_action( 'settings-post-type-unlimited', array( &$this, 'settings_options' ) );

	     // add the options in the settings page of the post type
	     add_action( 'typography-post-type-unlimited', array( &$this, 'typography_options' ) );

	     // add the options for each slide of the post type
	     add_action( 'settings-item-post-type', array( &$this, 'settings_item' ), 10, 1 );

	     // save the settings in the database, for each psot
	     add_action( 'save_post', array( &$this, 'save_settings' ) );

	     // add the image size for the thumbnails in the backend
	     yit_add_image_size( 'admin-post-type-thumbnails', 140, 100, true );

	     // add the ajax for the images settings reloading, after uploaded all images
	     add_action( 'wp_ajax_update_images_post_type', array( &$this, 'update_items' ) );

	     // add the ajax for the image url editing
	     add_action( 'wp_ajax_update_image_post_type', array( &$this, 'update_item' ) );

	     // add the ajax to generate the preview image for the admin
	     add_action( 'wp_ajax_generate_preview_image_post_type', array( &$this, 'generate_preview' ) );

	     // add the ajax for the images settings reloading, after uploaded all images
	     add_action( 'wp_ajax_delete_item_post_type', array( &$this, 'delete_item' ) );

	     // add the ajax for the images settings reloading, after uploaded all images
	     add_action( 'wp_ajax_add_category_post_type', array( &$this, 'add_category' ) );

	     // add the ajax useful to remove the category
	     add_action( 'wp_ajax_delete_category_post_type', array( &$this, 'delete_category' ) );

	     // add the template for the page of single element of post type
	     add_filter( 'template_include', array( &$this, 'load_template_single' ) );

	     // add the query vars for the template of single post page
	     add_filter( 'query_vars', array( &$this, 'add_query_vars' ) );

	     // fix classes in the navigation menu
	     add_filter( 'wp_nav_menu_objects',  array( &$this, 'nav_menu_item_classes' ), 2, 20 );

	     // remove the autosave in the posts of the post type
	     add_action( 'admin_enqueue_scripts', array( &$this, 'remove_autosave' ), 1 );

         // enqueue the stylesheets of google fonts, from the typography settings
         add_action( 'init', array( &$this, 'load_options_font' ) );

         // add the css rules for the typography, ready to be saved in the custom.css file
         add_action( 'yit_save_css', array( &$this, 'add_css_rules' ) );

         // give the ability to duplicate the posts
         add_action('admin_action_duplicate_post', array( &$this, 'duplicate_a_post_action' ) );

         // add the link to duplicate the posts
         add_filter( 'post_row_actions', array( &$this, 'duplicate_product_link_row' ), 10, 2 );

	}

    /**
     * Add the post type unlimited in the system
     *
     * @param $post_type string  The name of post type
     * @param $args      array   The arguments of the post type
     * @return $this object  Used to have access of all public methods of this class
     * @since 1.0.0
     */
    public function add( $post_type, $args = array() ) {

        // Defaults arguments
        $defaults = array(
            'name' => !empty( $args['labels']['plural_name'] ) ? $args['labels']['plural_name'] : ucfirst( $post_type ),
            'icon_menu' => null,
            'settings' => array(),
            'settings_item' => array(),
            'settings_items_file' => 'settings-config-items.php',     // the file of template used to managed the second tab
            'use_typography' => false,   // set true to use the tab typography
            'typography_options' => array(),   // options for the tab typography
            'labels' => array(
                'plural_name' => '',
                'singular_name' => '',
                'item_name_sing' => '',
                'item_name_plur' => '',
            ),
            'publicly_queryable' => true
        );
        $args = wp_parse_args( $args, $defaults );

        // default labels
        if ( empty( $args['labels']['plural_name'] ) )    $args['labels']['plural_name']    = $args['name'];
        if ( empty( $args['labels']['singular_name'] ) )  $args['labels']['singular_name']  = $args['name'];
        if ( empty( $args['labels']['item_name_sing'] ) ) $args['labels']['item_name_sing'] = $args['name'];
        if ( empty( $args['labels']['item_name_plur'] ) ) $args['labels']['item_name_plur'] = $args['name'];

        // if is an array, the settings depends from another option
        if ( is_array( $args['settings_item'] ) ) {
            foreach ( $args['settings_item'] as $dep => $supports ) {
                $this->_convertSettingsItem( $args['settings_item'][$dep] );

                // add manually other fields in the configuration of each item
                $args['settings_item'][$dep] = apply_filters( 'yit_cpt_unlimited_settings_item_' . $post_type, $args['settings_item'][$dep] );
            }

        // convert the fields of settings of each item, from string in a complete url
        } else {
            $this->_convertSettingsItem( $args['settings_item'] );

            // add manually other fields in the configuration of each item
            $args['settings_item'] = apply_filters( 'yit_cpt_unlimited_settings_item_' . $post_type, $args['settings_item'] );
        }

        // add other options for the configuration of each item, if exists the index 'settings_item_custom'
        if ( isset( $args['settings_item_custom'] ) ) {
            if ( ! empty( $args['settings_item_custom'] ) ) $args['settings_item'] = array_merge_recursive( $args['settings_item'], $args['settings_item_custom'] );
            unset($args['settings_item_custom']);
        }

        $this->_post_types[ sanitize_key( $post_type ) ] = $args;

        // change the columns of the tables
        add_action( 'manage_' . $post_type . '_posts_custom_column', array( &$this, 'custom_columns' ) );
        add_filter( 'manage_edit-' . $post_type . '_columns', array( &$this, 'edit_columns' ) );

        // add the rewrite rules
        //if ( $args['publicly_queryable'] ) $this->_addRewriteRules( $post_type );

        return $this;
    }

    /**
     * Convert the string that define the fields to configure each item.
     * Ex. 'settings_item' => 'title, description, link, video'
     *
     * @param $settings string  The string to convert
     * @return null
     *
     * @since 1.0.0
     */
    protected function _convertSettingsItem( &$settings ) {
        if ( is_array( $settings ) )
            { return; }

        $return = array();
        $settings = array_map( 'trim', explode( ',', $settings . ', image' ) );

        foreach ( $settings as $setting ) {
            switch ( $setting ) {

                case 'title':
                    $return[] = array(
                        'name' => __( 'Title', 'yit' ),
                        'id' => 'title',
                        'type' => 'text',
                        'desc' => __( "Leave empty, if you don't want to use it.", 'yit' ),
                        'std' => ''
                    );
                    break;

                case 'subtitle':
                    $return[] = array(
                        'name' => __( 'Subtitle', 'yit' ),
                        'id' => 'subtitle',
                        'type' => 'text',
                        'std' => ''
                    );
                    break;

                case 'content':
                    $return[] = array(
                        'name' => __( 'Text', 'yit' ),
                        'id' => 'text',
                        'type' => 'textarea',
                        'desc' => __( 'Add here a content to show for this item', 'yit' ),
                        'std' => ''
                    );
                    break;

                case 'content-editor':
                    $return[] = array(
                        'name' => __( 'Text', 'yit' ),
                        'id' => 'text',
                        'type' => 'textarea-editor',
                        'desc' => __( 'Add here a content to show for this item', 'yit' ),
                        'std' => ''
                    );
                    break;

                case 'link':
                    $return[] = array(
                        'name' => __( 'Link', 'yit' ),
                        'id' => 'link',
                        'type' => 'text',
                        'std' => ''
                    );
                    break;

                case 'image':
                    $return[] = array(
                        'name' => __( 'Image', 'yit' ),
                        'id' => 'image',
                        'type' => 'upload',
                        'desc' => __( 'Change here the image above of this slide', 'yit' ),
                        'std' => ''
                    );
                    break;

                default :
                    $return[] = apply_filters( 'yit_post_type_support_' . $setting, array() );
                    break;

            }
        }

        $settings = $return;
    }

    /**
     * Add the css to change the icon menu for the post types
     *
     * @since 1.0.0
     */
    public function change_icon_menu() {
        global $wp_version;
        ?>
        <style type="text/css">
            <?php foreach ( $this->_post_types as $post_type => $args ) : if ( empty( $args['icon_menu'] ) ) continue; ?>

            <?php if( version_compare( $wp_version, '3.8', '>=' ) ) :; ?>
            /* 3.8 */
            #menu-posts-<?php echo $post_type ?> .wp-menu-image:before { content:"" !important; background:transparent url('<?php echo $args['icon_menu'] ?>') 0 -32px !important; height: 16px; width: 32px;}
            #menu-posts-<?php echo $post_type ?>:hover .wp-menu-image:before, #menu-posts-<?php echo $post_type ?>.wp-has-current-submenu .wp-menu-image:before { content:""!important;background-position:0 0 !important; }

            <?php else : ?>
            /* 3.7 */
            #menu-posts-<?php echo $post_type ?> .wp-menu-image { background:transparent url('<?php echo $args['icon_menu'] ?>') 0 -32px !important; }
            #menu-posts-<?php echo $post_type ?>:hover .wp-menu-image, #menu-posts-<?php echo $post_type ?>.wp-has-current-submenu .wp-menu-image { background-position:0 0 !important; }
            <?php endif; ?>
            <?php endforeach; ?>
        </style>
        <?php
    }

    /**
     * Add the post type unlimited in the system
     *
     * @param $post_type string  The name of post type
     * @param $args      array   The arguments of the post type
     * @return null
     * @since 1.0.0
     */
    public function register_post_types() {
        foreach ( $this->_post_types as $post_type => $args ) {

            // labels
            $labels = array(
                'name' => sprintf( __( '%s', 'yit' ), $args['name'] ),
                'singular_name' => sprintf( __( '%s', 'yit' ), ucfirst( $args['labels']['singular_name'] ) ),
                'add_new' => _x( 'Add New', ucfirst( $args['labels']['singular_name'] ), 'yit' ),
                'add_new_item' => sprintf( __( 'Add New %s', 'yit' ), ucfirst( $args['labels']['singular_name'] ) ),
                'edit_item' => sprintf(  __( 'Edit %s', 'yit' ), $args['labels']['singular_name'] ),
                'new_item' => sprintf( __( 'New %s', 'yit' ), $args['labels']['singular_name'] ),
                'all_items' => sprintf( __( 'All %s', 'yit' ), $args['labels']['plural_name'] ),
                'view_item' => sprintf( __( 'View %s', 'yit' ), $args['labels']['singular_name'] ),
                'search_items' => sprintf( __( 'Search %s', 'yit' ), $args['labels']['plural_name'] ),
                'not_found' =>  sprintf( __( 'No %s found', 'yit' ), $args['labels']['singular_name'] ),
                'not_found_in_trash' => sprintf( __( 'No %s found in Trash', 'yit' ), $args['labels']['singular_name'] ),
                'parent_item_colon' => '',
                'menu_name' => sprintf( __( '%s', 'yit' ), ucfirst( $args['labels']['plural_name'] ) )
            );

            // arguments
            $post_type_args = array(
                'labels' => $labels,
                'public' => false,
                'publicly_queryable' => $args['publicly_queryable'],
                'show_ui' => true,
                'show_in_menu' => true,
                'query_var' => $args['publicly_queryable'],
                'rewrite' => $args['publicly_queryable'],
                'capability_type' => 'post',
                'has_archive' => false,
                'hierarchical' => false,
                'menu_position' => ( isset( $args['menu_position'] ) ? $args['menu_position'] : null ),
                'supports' => array( 'title' ),
                'query_car' => false,
                'register_meta_box_cb' => array( &$this, 'settings_metabox' )
            );

            // register the post type
            register_post_type( $post_type, apply_filters( 'yit_cptu_rewrite_' . $post_type, $post_type_args ) );
        }
    }

    /**
     * Give the ability to add some options to the typography tab
     *
     * @param $post_type string  The name of post type
     * @param $args      array   The arguments of the typography tab
     * @return null
     * @since 1.0.0
     */
    public function change_typography_tab( $post_type, $options ) {
        $this->_post_types[$post_type] = array_merge( $this->_post_types[$post_type]['typography_options'], $options );
    }

   /*
    * ADMIN INTERFACE
    * ------------------------------------------------------------------------
    */

    /**
     * Customize the columns in the table of all post types
     *
     * @since 1.0.0
     */
    public function custom_columns( $column ) {
        global $post;

        switch ( $column ) {
            case "nitems":
                echo count( $this->get_items( $post->ID ) );
                break;
        }

    }

    /**
     * Edit the columns in the table of all post types
     *
     * @since 1.0.0
     */
    public function edit_columns( $columns ) {
        $columns = array(
            "cb" => "<input type=\"checkbox\" />",
            "title" => __( "Name", 'yit' ),
            "nitems" => __( "N. of Items", 'yit' )
        );

        return $columns;
    }

    /**
     * Include the references for the admin page
     *
     * @since 1.0.0
     */
    public function enqueue_references() {
        global $post_type, $pagenow;

        if ( !( ( $pagenow == 'post.php' || $pagenow == 'post-new.php' ) && in_array( $post_type, array_keys( $this->_post_types ) ) ) )
            { return; }

        wp_enqueue_script( 'post-type-unlimited', YIT_CORE_ASSETS_URL . '/js/post-type-unlimited.js', array(), '1.0.0', true );
        wp_localize_script( 'post-type-unlimited', 'cpt', array(
            'delete_item' => __( 'Are you sure you want to remove this item?', 'yit' ),
            'update_item' => __( 'Update the page before to configure the element.', 'yit' )
        ) );
    }

    /**
     * Add the metabox with all settings of the section
     *
     * @since 1.0.0
     */
    public function settings_metabox() {
        global $post_type;

        add_meta_box( 'post-type-settings', $this->_post_types[$post_type]['labels']['item_name_sing'] . __( ' Settings', 'yit' ), array( &$this, 'settings_page_html' ), $post_type, 'normal', 'high' );
    }

    /**
     * The complete HTML of the settings box of post type
     *
     * @since 1.0.0
     */
    public function settings_page_html() {
        global $post_type;

        // $_POST['post_id'] is in case of AJAX
        $post_id = isset( $_POST['post_id'] ) ? $_POST['post_id'] : false;

        // add the action for the settings of items
        add_action( 'settings-items-post-type', array( &$this, 'settings_items_html' ) );

        yit_get_template( 'admin/post-type-unlimited/settings-page.php', array(
            'args' => $this->_post_types[$post_type],
            'post_type' => $post_type,
            'items' => $this->get_items( $post_id ),
            'this_obj' => &$this
        ) );
    }

    /**
     * The complete HTML of the settings items
     *
     * @since 1.0.0
     */
    public function settings_items_html() {
        global $post_type;

        // $_POST['post_id'] is in case of AJAX
        $post_id = isset( $_POST['post_id'] ) ? $_POST['post_id'] : false;

        // set the globa $post_type
        if ( isset( $_POST['post_type'] ) )
            $post_type = $_POST['post_type'];

        yit_get_template( 'admin/post-type-unlimited/settings-items.php', array(
            'args' => $this->_post_types[$post_type],
            'items' => $this->get_items( $post_id ) + array( 0 => array() ),   // aggiunge un slide di esempio, utile al javascript per l'aggiunta delle immagini
            'post_id' => $post_id,
            'this_obj' => &$this
        ) );
    }

    /**
     * All options of settings page
     *
     * @since 1.0.0
     */
    public function settings_options() {
        global $post_type;

        $options = $this->_post_types[$post_type]['settings'];

        foreach ( $options as $option ) {
            $this->_settingsOption( $option );
        }
    }

    /**
     * All options of typography page
     *
     * @since 1.0.0
     */
    public function typography_options() {
        global $post_type;

        $options = $this->_post_types[$post_type]['typography_options'];

        foreach ( $options as $option ) {
            $this->_settingsOption( $option );
        }
    }

    /**
     * All options of settings page
     *
     * @param $item_id int   It's the ID of each element, to generate the individual field of the post type
     *
     * @since 1.0.0
     */
    public function settings_item( $item_id ) {
        global $post_type, $post;

        $options = $this->_post_types[$post_type]['settings_item'];
        $deps_options = array();

        $post_id = isset( $_POST['post_id'] ) ? $_POST['post_id'] : $post->ID;

        // if the array is associative, it means that was been added dependens
        if ( array_keys($options) !== range(0, count($options) - 1) ) {
            foreach ( $options as $dep => $dep_options ) {
                if ( strpos( $dep, ':' ) === false ) continue;

                list( $dep_id, $dep_value ) = explode( ':', $dep );
                $check = get_post_meta( $post_id, '_' . $this->metabox_name, true );

                if ( $check[$dep_id] == $dep_value ) {
                    $deps_options = $options[$dep];
                }

                unset($options[$dep]);
            }
        }

        $options = array_merge( $options, $deps_options );

        foreach ( $options as $option ) {
            $this->_settingsOption( $option, $item_id );
        }
    }

    /**
     * Add the type of an option in settings page
     *
     * @param $item_id int   It's the ID of each element, to generate the individual field of the post type
     *
     * @since 1.0.0
     */
    protected function _settingsOption( $option, $item_id = 0 ) {
        global $post, $pagenow;

        $defaults = array(
            'id' => '',
            'name' => '',
            'std' => '',
            'desc' => '',
            'only__saved' => false,
            'only__not_saved' => false
        );
        $option = wp_parse_args( $option, $defaults );

        // don't show the option if it's not set the 'type' index
        if ( ! isset( $option['type'] ) )
            { return; }

        // don't show the option when the post it's not still been saved, if it's set the 'only__saved' argument
        if ( $option['only__saved'] && $pagenow == 'post-new.php' )
            { return; }

        // don't show the option when the post it's been saved and it's set the 'only__not_saved' argument
        if ( $option['only__not_saved'] && $pagenow == 'post.php' )
            { return; }

        // the post ID
        $post_id = isset( $post->ID ) ? $post->ID : 0;

        // get the post ID from $_POST, in case of AJAX
        if ( isset( $_POST['post_id'] ) ) $post_id = $_POST['post_id'];

        // show the field, only if is the dependence results true (the 'deps' index)
        if ( isset( $option['deps'] ) && $this->get_setting( $option['deps']['id'], $post_id ) != $option['deps']['value'] )
            { return; }

        // "name" and "id" of the input fields
        $name_field = $id_field = $value = '';
        if ( ! empty( $option['id'] ) ) {
            $name_field = $this->metabox_name . ( $item_id != 0 ? '[items][' . $item_id . ']' : '' ) . '[' . $option['id'] . ']';
            $id_field   = $this->metabox_name . '_' . $option['id'] . ( $item_id != 0 ? '_' . $item_id : '' );

            // get the value of this option
            $value = get_post_meta( $post_id, '_' . $this->metabox_name, true );

            // if is the image of the post, get the url of the image
            if ( $option['id'] == 'image' ) {
                $value = wp_get_attachment_url( $item_id );

            // if is passed the parameter $item_id, it gets the value from the items array
            } elseif ( $item_id != 0 ) {
                $value = isset( $value['items'][$item_id][ $option['id'] ] ) ? $value['items'][$item_id][ $option['id'] ] : $option['std'];

            // otherwise get the value from the general setting of post type
            } elseif ( isset( $value[ $option['id'] ] ) ) {
                $value = $value[ $option['id'] ];

            // otherwise, get the default value
            } else {
                $value = $option['std'];
            }
        }

        ?><div class="the-metabox <?php echo $option['type'] ?> <?php echo isset($option['id']) ? 'container_'.$option['id'] : '' ?> clearfix"><?php

        $option['title'] = $option['name'];
        $option['name'] = $name_field;
        $option['id'] = $id_field;
        $option['value'] = $value;
        $option['options'] = isset( $option['options'] ) ? $option['options'] : array();

        yit_get_template( 'admin/metaboxes/types/' . $option['type'] . '.php', array( 'args' => $option ) );

        ?></div><?php
    }

    /**
     * Save the metabox values in the database, for the post of the post type
     *
     * @param $post_id int   The ID of the new post
     *
     * @since 1.0.0
     */
    public function save_settings( $post_id ) {
        // verify if this is an auto save routine.
        // If it is our form has not been submitted, so we dont want to do anything
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
            return;

        // verify this came from the our screen and with proper authorization,
        // because save_post can be triggered at other times

        if ( !( isset( $_POST['settings_post_type_nonce'] ) && wp_verify_nonce( $_POST['settings_post_type_nonce'], 'post-type-unilimited-settings' ) ) )
            return;

        // Check permissions
        if ( !current_user_can( 'edit_post', $post_id ) )
            return;

        // OK, we're authenticated: we need to find and save the data

         $settings = isset($_POST[ $this->metabox_name ]) ? $_POST[ $this->metabox_name ] : array();

        // check for the checkboxs
        foreach ( $this->_post_types[ $_POST['post_type'] ]['settings'] as $option ) {
            if ( isset( $option['type'] ) && isset( $option['id'] ) && in_array( $option['type'], array( 'checkbox', 'onoff' ) ) && ! isset( $_POST[ $this->metabox_name ][ $option['id'] ] ) )
                { $settings[ $option['id'] ] = "0"; }
        }

        // remove the sample item used by the javascript
        unset( $settings['items'][0] );

        // add the categories
        $actual_cats = $this->get_setting( 'categories', $post_id );
        if ( empty( $actual_cats ) ) $actual_cats = array();
        $settings['categories'] = $actual_cats;

        // Do something with $settings
        // probably using add_post_meta(), update_post_meta(), or
        // a custom table (see Further Reading section below)
        update_post_meta( $post_id, '_' . $this->metabox_name, $settings );

        // save the css in the file for the typography tab
        yit_save_css();
    }

    /**
     * Update images via AJAX
     *
     * @since 1.0.0
     */
    public function update_items() {
        $post_id = isset( $_POST['post_id'] ) ? $_POST['post_id'] : false;

        // update items in the post
        $items = $this->get_setting( 'items', $post_id );
        $uploaded_items = $this->_getImages($post_id);
        foreach ( $uploaded_items as $item_id => $args ) {
            if ( isset( $items[$item_id] ) )
                $items[$item_id] = wp_parse_args( $args, $items[$item_id] );
            else
                $items[$item_id] = $args;
        }
        $this->update_setting( 'items', $items, $post_id );

        echo json_encode( array_keys( $uploaded_items ) );

        die();
    }

    /**
     * Update the image url of an Item via AJAX.
     *
     * The method remove the previous post id of attachment and assign the post ID
     * to the new attachment. Finally, update the items of the post in the database.
     *
     * @since 1.0.0
     */
    public function update_item() {
        $post_id = isset( $_POST['post_id'] ) ? $_POST['post_id'] : false;
        $from_item_id = isset( $_POST['from_item_id'] ) ? $_POST['from_item_id'] : false;
        $to_item_id   = isset( $_POST['to_item_id'] )   ? $_POST['to_item_id']   : false;
                                                       echo "$post_id - $from_item_id - $to_item_id<br />";
        // delete previous item
        $this->delete_item( $from_item_id );

        // assign the parent post to the new attachment
        $new_image = array();
        $new_image['ID'] = $to_item_id;
        $new_image['post_parent'] = $post_id;
        echo wp_update_post( $new_image );

        if ( function_exists('yit_image') ) $new_image_url = yit_image( "id=$to_item_id&size=admin-post-type-thumbnails&output=url", false );

//         // add the new item in the 'items'
//         $items = $this->get_items( $post_id );
//         $items[$to_item_id] = wp_parse_args( array(
//             'order' => $previous_item['order'],
//             'image_url' => wp_get_attachment_url( $to_item_id ),
//             'image_html' => wp_get_attachment_image( $to_item_id, 'shop_thumbnail' ),
//         ), $previous_item );
//         $this->update_setting( 'items', $items, $post_id );

        die();
    }

    /**
     * Generate the thumbnail preview in the admin
     */
    public function generate_preview() {
        $item_id = intval( $_POST['item_id'] );
        if ( function_exists('yit_image') ) return yit_image( "id=$item_id&size=admin-post-type-thumbnails&output=url", false );
    }

    /**
     * Get all images that are children (that are attachments) of a parent post
     *
     * @return array  All items in one array
     *
     * @since 1.0.0
     */
    protected function _getImages( $post_id = false ) {
        global $post;

        // the post ID
        if ( ! $post_id ) $post_id = isset( $post->ID ) ? $post->ID : 0;

        // if the post ID is 0, there isn't any post to process
        if ( $post_id == 0 ) return;

        // the array with all attachments
        $images = array();

        $attachments = get_posts( array(
    		'post_type' 	=> 'attachment',
    		'numberposts' 	=> -1,
    		'post_status' 	=> null,
    		'post_parent' 	=> $post_id,
    		//'post__not_in'	=> array( get_post_thumbnail_id() ),
    		'post_mime_type'=> 'image',
    		'orderby'		=> 'menu_order',
    		'order'			=> 'ASC'
    	) );
    	if ($attachments) {

    		foreach ( $attachments as $key => $attachment ) {

    		    $images[ $attachment->ID ] = array(
                    'order' => $key,
                    'image_url' => wp_get_attachment_url( $attachment->ID ),
                    'image_html' => wp_get_attachment_image( $attachment->ID, 'admin-post-type-thumbnails' ),
                );

    		}

    	}

    	return $images;

    }

    /**
     * Get all images from the post meta
     *
     * @return array  All items in one array
     *
     * @since 1.0.0
     */
    public function get_items( $post_id = false, $args = array() ) {
        global $post;

        $defaults = array(
            'posts_per_page' => -1,
            'offset' => false,
            'cat' => array()
        );
        $args = wp_parse_args( $args, $defaults );

        // the post ID
        if ( ! $post_id ) $post_id = isset( $post->ID ) ? $post->ID : 0;

        $items = $this->get_setting( 'items', $post_id );

        // return empty, if there aren't any element
        if ( empty( $items ) ) return array();

        $items = $this->sort_items( $items );
        $items_keys = array_keys( $items );

        if ( isset( $_GET['cat'] ) ) {
            $args['cat'] = $_GET['cat'];
        }

        // get the categories from the query string if it exists
        if ( isset( $_GET['cat'] ) ) {
            $args['cat'] = $_GET['cat'];
        }

        // force array for the categories
        if ( ! is_array( $args['cat'] ) ) {
            $args['cat'] = array( $args['cat'] );
        }

        // filter items to return
        if ( $args['posts_per_page'] >= 0 || $args['offset'] || ! empty( $args['cat'] ) ) {

            // get the actual page for pagination
            $paged = (get_query_var('paged')) ? get_query_var('paged') : false;
            if ( $paged === false ) $paged = (get_query_var('page')) ? get_query_var('page') : false;
            if ( $paged === false ) $paged = 1;

            if ( ! $args['offset'] && $args['posts_per_page'] >= 0 ) {
                $args['offset'] = $args['posts_per_page'] * $paged - $args['posts_per_page'];  // calculate the offset, if we are in a different page
            } else {
                $args['offset'] = 0;
            }

            if ( $args['posts_per_page'] == -1 ) $args['posts_per_page'] = count($items) - 1;
            $from = (int) $args['offset'];
            $to   = $args['posts_per_page'] + $from > count($items) ? count($items) : $args['posts_per_page'] + $from;
            $return = array();
            for ( $i = $from; $i < $to; $i++ ) {
                if ( ! isset( $items_keys[$i] ) ) continue;

                $key = $items_keys[$i];
                if ( ! empty( $args['cat'] ) ) {
                    $continue = true;
                    foreach ( $args['cat'] as $cat ) {
                        if ( isset( $items[$key]['terms'] ) && in_array( $cat, $items[$key]['terms'] ) )
                        { $continue = false; }
                    }
                    //if ( $continue ) continue;  // block the foreach
                }
                $return[$key] = $items[$key];
            }
            $items = $return;
        }

        return $items;
    }

    /**
     * Get the number of items that are in the post type
     *
     * @since 1.0.0
     */
    public function get_number_items( $post_id ) {
        return count( $this->get_items( $post_id ) );
    }

    /**
     * Delete an item
     *
     * @return array  All items in one array
     *
     * @since 1.0.0
     */
    public function delete_item( $item_id = false ) {
        if ( ! $item_id && ! isset( $_POST['post_id'] ) && ! isset( $_POST['item_id'] ) )
            { return; }

        // the post ID
        if ( ! $item_id ) $item_id = $_POST['item_id'];

        // the post ID
        if ( isset( $post->ID ) ) {
            $post_id = $post->ID;
        } elseif ( isset( $_POST['post_id'] ) ) {
            $post_id = $_POST['post_id'];
        } else {
            $post_id = 0;
        }

        wp_delete_post( $item_id );

        $items = $this->get_setting( 'items', $post_id );
        unset($items[$item_id]);

        $this->update_setting( 'items', $items, $post_id );
    }

    /**
     * Order items by a 'order' key, in array like this:
     * array(
     *     array(
     *          'order' => 1,
     *          'title' => '',
     *          'link' => ''
     *     ),
     *     array(
     *          'order' => 2,
     *          'title' => '',
     *          'link' => ''
     *     ),
     * );
     *
     * @since 1.0.0
     */
    public function sort_items( $a, $subkey = 'order' ) {
        if ( empty( $a ) )
            { return; }

        $b = $c = $final = array();

        foreach ( $a as $key => $v ) {
            $v['__key'] = $key;
            $b[] = $v;
        }

        foreach ( $b as $v ) {
            $c[ (int) $v[$subkey] ] = $v;
        }
        ksort($c);

        foreach ( $c as $v ) {
            $key = $v['__key'];
            unset($v['__key']);
            $final[$key] = $v;
        }

        return $final;

//         foreach($a as $k=>$v) {
//             $b[$k] = strtolower($v[$subkey]);
//         }
//         asort($b);
//         foreach($b as $key=>$val) {
//             $c[] = $a[$key];
//         }
//         return $c;
    }

    /**
     * Get a specific setting of this post
     *
     * @return mixed  The results
     *
     * @since 1.0.0
     */
    public function get_setting( $setting, $post_id = false ) {
        global $post;

        // the post ID
        if ( ! $post_id ) $post_id = isset( $post->ID ) ? $post->ID : 0;

        $settings = get_post_meta( $post_id, '_' . $this->metabox_name, true );

        // return null, if it's not defined
        if ( ! isset( $settings[$setting] ) )
            { return; }

        return $settings[$setting];

    }

    /**
     * Get a list of all posts created for a single post type unlimited
     *
     * @return array  Array with all posts: [post_id] => array($post_object)
     *
     * @since 1.0.0
     */
    public function get_posts_types( $post_type ) {
        $posts = wp_cache_get( 'yit_' . $post_type . '_posts' );
        if ( $posts != false )
            { return $posts; }

        $args = array(
            'post_type' => $post_type,
            'orderby'   => 'post_title',
            'order'     => 'ASC',
            'numberposts' => -1
        );

        $posts = get_posts( $args );
                                    // yit_debug($posts);
        // set cache
        wp_cache_set( 'yit_' . $post_type . '_posts', $posts );

        return $posts;
    }

    /**
     * Update a specific setting of this post
     *
     * @return mixed  The results
     *
     * @since 1.0.0
     */
    public function update_setting( $setting, $value, $post_id = false ) {
        global $post;

        // the post ID
        if ( ! $post_id ) $post_id = isset( $post->ID ) ? $post->ID : 0;

        $settings = get_post_meta( $post_id, '_' . $this->metabox_name, true );

        $settings[$setting] = $value;

        update_post_meta( $post_id, '_' . $this->metabox_name, $settings );

    }

    /**
     * Check if the post type is a custom post type unlimited
     *
     * @param $slug string  The slug of post type
     *
     * @since 1.0
     */
    public function is_cptu( $post_type ) {
        if ( isset( $this->_post_types[$post_type] ) ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the post ID of post type, from the its slug
     *
     * @param $slug string  The slug of post type
     *
     * @since 1.0
     */
    public function get_post_type_ID( $slug ) {
        global $wpdb;

        $ID = $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE post_name = '$slug'" );
        if ( ! empty( $ID ) ) {
            return $ID;
        } else {
            return 0;
        }
    }

    /**
     * Get the post slug of post type, from the its post ID
     *
     * @param $post_id integer  The post ID of the post type
     *
     * @since 1.0
     */
    public function get_post_type_slug( $post_id ) {
        $slider_post = get_post( $post_id );
        if ( isset( $slider_post->post_name ) ) {
            return $slider_post->post_name;
        } else {
            return null;
        }
    }

    /**
     * Add category via AJAX
     *
     * @since 1.0.0
     */
    public function add_category() {
        $post_id = isset( $_POST['post_id'] ) ? $_POST['post_id'] : false;
        $new_category = isset( $_POST['new_category'] ) ? $_POST['new_category'] : null;

        if ( empty( $post_id ) && empty( $new_category ) )
            { return; }

        $cats = $this->get_setting( 'categories', $post_id );
        $new_cat_slug = yit_avoid_duplicate( sanitize_key( $new_category ), $cats, 'key' );

        // add category
        $cats[$new_cat_slug] = $new_category;

        // sort alphabetical
        ksort($cats);

        // update in the database
        $this->update_setting( 'categories', $cats, $post_id );

        // echo JSON for the javascript of only new element
        echo json_encode( array( 'slug' => $new_cat_slug, 'name' => $new_category ) );

        die();
    }

    /**
     * Delete category via AJAX
     *
     * @since 1.0.0
     */
    public function delete_category() {
        $post_id = isset( $_POST['post_id'] ) ? $_POST['post_id'] : false;
        $category = isset( $_POST['cat_slug'] ) ? $_POST['cat_slug'] : null;

        if ( empty( $post_id ) && empty( $category ) )
            { return; }

        $cats = $this->get_setting( 'categories', $post_id );

        // add category
        unset( $cats[$category] );

        // sort alphabetical
        ksort($cats);

        // update in the database
        $this->update_setting( 'categories', $cats, $post_id );

        // remove the categories also in each item
        $items = $this->get_setting( 'items', $post_id );
        foreach ( $items as $item_id => $the_ ) {
            $key = array_search( $category, $the_['terms'] );
            if ( $key !== false ) unset( $items[$item_id]['terms'][$key] );
        }
        $this->update_setting( 'items', $items, $post_id );

        die();
    }

    /**
     * Add the rewrite rules for the items of each post type
     *
     * @since 1.0.0
     */
    protected function _addRewriteRules( $post_type ) {
        global $wp_rewrite;

        $posts = get_posts( array(
            'post_type' => $post_type
        ) );

        foreach ( $posts as $post ) {
            $rewrite = $this->get_setting( 'rewrite', $post->ID );
            if ( empty( $rewrite ) ) $rewrite = $post->post_name;
            add_rewrite_rule( "^{$rewrite}/([^/]*)/?", "index.php?cpt_unlimited={$post_type}&cpt_id={$post->ID}&" . 'cpt_item=$matches[1]', 'top' );
        }
    }

    /**
     * Add the query vars, used to get the template to load
     *
     * @since 1.0.0
     */
    public function add_query_vars( $aVars ) {
        $aVars[] = "cpt_unlimited";
        $aVars[] = "cpt_id";
        $aVars[] = "cpt_item";
        $aVars[] = "cpt_item_id";
        return $aVars;
    }

    /**
     * Tell to wordpress what is the template to load if we are in single page
     * of each element of post type.
     *
     * @since 1.0.0
     */
    protected function _queryVarsValidate() {
        global $wp_query, $post;

        //$post_type = isset( $wp_query->query_vars['cpt_unlimited'] ) ? $wp_query->query_vars['cpt_unlimited'] : false;
        //$post_id   = isset( $wp_query->query_vars['cpt_id'] )        ? $wp_query->query_vars['cpt_id']        : false;
        $post_type = isset( $post->post_type )                       ? $post->post_type                       : false;
        $post_id   = isset( $post->ID )                              ? $post->ID                              : false;
        $item_name = isset( $wp_query->query_vars['cpt_item'] )      ? $wp_query->query_vars['cpt_item']      : false;
        $item_id   = isset( $wp_query->query_vars['cpt_item_id'] )   ? $wp_query->query_vars['cpt_item_id']   : false;

        if ( ! $post_type || ! $post_id || ! $item_name & ! $item_id )
            { return false; }

        // check if the post type is existing
        if ( ! isset( $this->_post_types[$post_type] ) )
            { return false; }

        // check if the post is existing
        $check = get_post($post_id);
        if ( !( ! empty( $check ) && $post_type == $check->post_type ) )
            { return false; }

        $items = $this->get_setting( 'items', $post_id );

        // if empty, there isn't any item to show
        if ( empty( $items ) )
            { return false; }

        // check for the title of post
        if ( ! empty( $item_id ) && empty( $item_name ) ) $item_name = $items[$item_id]['title'];
        foreach ( $items as $item_id => $the_ ) {
            $stop = sanitize_title( $the_['title'] ) == sanitize_title( $item_name ) ? true : false;
            if ( $stop ) break;
        }
        if ( ! $stop )
            { return false; }

        return true;
    }

    /**
     * Tell to wordpress what is the template to load if we are in single page
     * of each element of post type.
     *
     * @since 1.0.0
     */
    public function load_template_single( $template ) {
        global $wp_query, $post;

        //$post_type = isset( $wp_query->query_vars['cpt_unlimited'] ) ? $wp_query->query_vars['cpt_unlimited'] : false;
        //$post_id   = isset( $wp_query->query_vars['cpt_id'] )        ? $wp_query->query_vars['cpt_id']        : false;
        $post_type = isset( $post->post_type )                       ? $post->post_type                       : false;
        $post_id   = isset( $post->ID )                              ? $post->ID                              : false;
        $item_name = isset( $wp_query->query_vars['cpt_item'] )      ? $wp_query->query_vars['cpt_item']      : false;
        $item_id   = isset( $wp_query->query_vars['cpt_item_id'] )   ? $wp_query->query_vars['cpt_item_id']   : false;

        if ( ! $this->_queryVarsValidate() )
            { return $template; }

        $items = $this->get_setting( 'items', $post_id );

        if ( ! empty( $item_name ) ) {
            foreach ( $items as $item_id => $the_ ) {
                if ( sanitize_title( $the_['title'] ) == sanitize_title( $item_name ) )
                    { break; }
            }
        } else if ( ! empty( $item_id ) ) {
            $the_ = $items[$item_id];
        }

        if ( ! isset( $the_ ) ) return $template;

        $the_['item_id'] = $item_id;
        $item = $the_;

        // OK ! the post is real.. let's load the template

        $post_type_name = $post->post_title;

    	$templates[] = "single-{$post_type_name}.php";
    	$templates[] = "single-{$post_type}.php";
    	$templates[] = "single-cpt-unlimited.php";
    	$templates[] = "single.php";
    	$templates[] = "index.php";

    	$this->query_vars['post_type'] = $post_type;
    	$this->query_vars['post_id']   = $post_id;
    	$this->query_vars['item']      = $item;

    	do_action( 'yit_load_single_cpt_template' );

    	// change the $post info, to give the configuration of the project, instead of $post portfolio
    	$post->post_title   = $item['title'];
    	$post->post_content = $item['text'];

    	yit_get_model('portfolio')->_current_item = $item;

    	//yit_debug(get_option('rewrite_rules'));
        //yit_debug($wp_query->query_vars);
        return get_query_template( 'single', $templates );
    }

    /**
     * Fix active class in nav for singular page.
     *
     * @access public
     * @param array $menu_items
     * @param array $args
     * @return array
     */
    public function nav_menu_item_classes( $menu_items, $args ) {
        global $post;

    	if ( ! isset( $post->post_type ) || ! $this->is_cptu( $post->post_type ) ) return $menu_items;

    	$page_for_posts = (int) get_option( 'page_for_posts' );

    	foreach ( (array) $menu_items as $key => $menu_item ) {

    		$classes = (array) $menu_item->classes;

    		// Unset active class for blog page
    		if ( $page_for_posts == $menu_item->object_id ) {
    			$menu_items[$key]->current = false;
    			unset( $classes[ array_search('current_page_parent', $classes) ] );
    			unset( $classes[ array_search('current-menu-item', $classes) ] );
    		}

    		$menu_items[$key]->classes = array_unique( $classes );

    	}

    	return $menu_items;
    }

    /**
     * Get the permalink of single page post
     *
     * @since 1.0.0
     */
    public function get_permalink( $args = array() ) {
        $defaults = array(
            'post_type' => $this->query_vars['post_type'],
            'post_id'   => $this->query_vars['post_id'],
            'item_id'   => false,
            'item_name' => false
        );
        extract( wp_parse_args( $args, $defaults ) );

        if ( $item_id != false && ! $item_name ) {
            $items = $this->get_setting( 'items', $post_id );
            $item_name = isset( $items[$item_id]['title'] ) ? sanitize_title( $items[$item_id]['title'] ) : '';
        } else {
            $item_id   = ! $item_id ? $this->query_vars['item']['item_id'] : $item_id;
            $item_name = ! $item_name ? sanitize_title($this->query_vars['item']['title']) : $item_name;
        }

        $permalink = get_option('permalink_structure');

        $cpt_item = empty( $item_name ) ? array( 'cpt_item_id' => $item_id ) : array( 'cpt_item' => $item_name );
//         if ( empty( $permalink ) || empty( $item_name ) ) { //temporany solution
//             $args = array_merge( array( 'post_type' => $post_type, 'p' => $post_id ), $cpt_item );
//             return add_query_arg( $args, home_url() );
//         } else {
//             $post = get_post($post_id);
//             return add_query_arg( $cpt_item, home_url("{$post->post_type}/{$post->post_name}/") );
//         }
        return esc_url( add_query_arg( $cpt_item, get_permalink( $post_id ) ) );
    }

    /**
     * Get the permalink of category page
     *
     * @since 1.0.0
     */
    public function get_term_link( $args = array() ) {
        $defaults = array(
            'post_type' => $this->query_vars['post_type'],
            'post_id'   => $this->query_vars['post_id'],
            'cat'       => false
        );
        extract( wp_parse_args( $args, $defaults ) );

        $permalink = get_option('permalink_structure');

        if ( empty( $permalink ) ) { //temporany solution
            return esc_url( add_query_arg( array( 'post_type' => $post_type, 'p' => $post_id, 'cat' => $cat ), home_url() ) );
        } else {
            $post = get_post($post_id);
            return esc_url( add_query_arg( array( 'cat' => $cat ), home_url("{$post->post_type}/{$post->post_name}/") ) );
        }
    }

	/**
	 * Remove the autosave in the posts, that create the message alert when you
	 * try to go out of the post edit page
	 *
	 * @since 1.0.0
	 */
    public function remove_autosave() {
        global $typenow, $wp_scripts;

        if( in_array( $typenow, array_keys( $this->_post_types ) ) )
            { wp_dequeue_script( 'autosave' ); }
    }

    /**
     * Load Google Fonts stylesheets for the tab typography
     *
     * @return void
     * @since 1.0.0
     */
    public function load_options_font() {
        $google_fonts = yit_get_google_fonts();
        $google_fonts = array_map( 'stripslashes', ( array ) $google_fonts->items );

        foreach ( $this->_post_types as $post_type => $args ) {
            foreach ( $args['typography_options'] as $option ) {
                $posts = $this->get_posts_types( $post_type );

                foreach ( $posts as $post ) {
                    $family = $this->get_setting( $option['id'], $post->ID );
                    if( isset( $family['family'] ) && in_array( $family['family'], $google_fonts ) ) {
                        //yit_wp_enqueue_style( 800, 'font-' . sanitize_title( preg_replace( '/:(.*)?/', '', $family['family'] ) ), yit_ssl_url( 'http://fonts.googleapis.com/css?family=' . $family['family'] ) );
                        yit_add_google_font( $family['family'] );
                    }
                }
            }
        }
    }

    /**
     * Update or create the custom stylesheet
	 *
	 * @since 1.0.0
     */
	public function add_css_rules() {
        foreach ( $this->_post_types as $post_type => $args ) {
            $posts = $this->get_posts_types( $post_type );
            foreach ( $posts as $post ) {
                foreach ( $args['typography_options'] as $option ) {
                    $value = $this->get_setting( $option['id'], $post->ID );
                    if ( ! empty( $value ) ) {
                        $replaces = array(
                            '%s' => $post->post_name
                        );
                        $option['style']['selectors'] = str_replace( array_keys( $replaces ), array_values( $replaces ), $option['style']['selectors'] );
                        yit_add_css_by_option( $option, $value );
                    }
                }
            }
        }
	}

	/**
     * Duplicate a post action
     *
     * @ince 1.0.0
     */
    public function duplicate_a_post_action() {
//     	if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'duplicate_post_save_as_new_page' == $_REQUEST['action'] ) ) ) {
//     		wp_die(__('No post to duplicate has been supplied!', 'yit'));
//     	}

    	// Get the original page
    	$id = (isset($_GET['post']) ? $_GET['post'] : $_POST['post']);
    	check_admin_referer( 'yit-cptu-duplicate-post_' . $id );
    	$post = $this->_get_post_to_duplicate($id);

    	// Copy the page and insert it
    	if (isset($post) && $post!=null) {
    		$new_id = $this->_create_duplicate_from_product($post);

    		// If you have written a plugin which uses non-WP database tables to save
    		// information about a page you can hook this action to dupe that data.
    		do_action( 'yit_cptu_duplicate_post', $new_id, $post );

    		// Redirect to the edit screen for the new draft page
    		wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_id ) );
    		exit;
    	} else {
    		wp_die(__('Product creation failed, could not find original product:', 'woocommerce') . ' ' . $id);
    	}
    }

    /**
     * Get a product from the database to duplicate
     *
     * @param mixed $id
     * @return void
     * @since 1.0.0
     */
    protected function _get_post_to_duplicate($id) {
    	global $wpdb;
    	$post = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE ID=$id");
    	if (isset($post->post_type) && $post->post_type == "revision"){
    		$id = $post->post_parent;
    		$post = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE ID=$id");
    	}
    	return $post[0];
    }

    /**
     * Function to create the duplicate of the product.
     *
     * @param mixed $post
     * @param int $parent (default: 0)
     * @param string $post_status (default: '')
     * @return void
     *
     * @since 1.0.0
     */
    protected function _create_duplicate_from_product( $post, $parent = 0, $post_status = '' ) {
    	global $wpdb;

    	$new_post_author 	= wp_get_current_user();
    	$new_post_date 		= current_time('mysql');
    	$new_post_date_gmt 	= get_gmt_from_date($new_post_date);

    	if ( $parent > 0 ) {
    		$post_parent		= $parent;
    		$post_status 		= $post_status ? $post_status : 'publish';
    		$suffix 			= '';
    	} else {
    		$post_parent		= $post->post_parent;
    		$post_status 		= $post_status ? $post_status : 'draft';
    		$suffix 			= ' ' . __("(Copy)", 'yit');
    	}

    	$new_post_type 			= $post->post_type;
    	$post_content    		= str_replace("'", "''", $post->post_content);
    	$post_content_filtered 	= str_replace("'", "''", $post->post_content_filtered);
    	$post_excerpt    		= str_replace("'", "''", $post->post_excerpt);
    	$post_title      		= str_replace("'", "''", $post->post_title).$suffix;
    	$post_name       		= str_replace("'", "''", $post->post_name);
    	$comment_status  		= str_replace("'", "''", $post->comment_status);
    	$ping_status     		= str_replace("'", "''", $post->ping_status);

    	// Insert the new template in the post table
    	$wpdb->query(
    			"INSERT INTO $wpdb->posts
    			(post_author, post_date, post_date_gmt, post_content, post_content_filtered, post_title, post_excerpt,  post_status, post_type, comment_status, ping_status, post_password, to_ping, pinged, post_modified, post_modified_gmt, post_parent, menu_order, post_mime_type)
    			VALUES
    			('$new_post_author->ID', '$new_post_date', '$new_post_date_gmt', '$post_content', '$post_content_filtered', '$post_title', '$post_excerpt', '$post_status', '$new_post_type', '$comment_status', '$ping_status', '$post->post_password', '$post->to_ping', '$post->pinged', '$new_post_date', '$new_post_date_gmt', '$post_parent', '$post->menu_order', '$post->post_mime_type')");

    	$new_post_id = $wpdb->insert_id;

    	// Copy the meta information
    	$this->_duplicate_post_meta( $post->ID, $new_post_id );

    	return $new_post_id;
    }

    /**
     * Copy the meta information of a post to another post
     *
     * @access public
     * @param mixed $id
     * @param mixed $new_id
     * @return void
     */
    protected function _duplicate_post_meta($id, $new_id) {
    	global $wpdb;
    	$post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$id");

    	if (count($post_meta_infos)!=0) {
    		$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
    		foreach ($post_meta_infos as $meta_info) {
    			$meta_key = $meta_info->meta_key;
    			$meta_value = addslashes($meta_info->meta_value);
    			$sql_query_sel[]= "SELECT $new_id, '$meta_key', '$meta_value'";
    		}
    		$sql_query.= implode(" UNION ALL ", $sql_query_sel);
    		$wpdb->query($sql_query);
    	}
    }

    /**
     * Duplicate a product link on products list
     *
     * @access public
     * @param mixed $actions
     * @param mixed $post
     * @return array
     */
    public function duplicate_product_link_row($actions, $post) {

    	if ( function_exists( 'duplicate_post_plugin_activation' ) )
    		return $actions;

    	if ( ! current_user_can( 'manage_options' ) ) return $actions;

    	if ( ! isset( $this->_post_types[ $post->post_type ] ) )
    		return $actions;

    	$actions['duplicate'] = '<a href="' . wp_nonce_url( admin_url( 'admin.php?action=duplicate_post&amp;post=' . $post->ID ), 'yit-cptu-duplicate-post_' . $post->ID ) . '" title="' . __("Make a duplicate from this product", 'yit')
    		. '" rel="permalink">' .  __("Duplicate", 'yit') . '</a>';

    	return $actions;
    }

}

if( !function_exists( 'yit_add_unlimited_post_type' ) ) {
    /**
     * Add the post type unlimited in the system
     *
     * @param $id string
     * @return null
     * @since 1.0.0
     */
    function yit_add_unlimited_post_type( $post_type, $args = array() ) {
        global $yit;
        return $yit->getModel('cpt_unlimited')->add( $post_type, $args );
    }
}

if( !function_exists( 'yit_get_post_type_setting' ) ) {
    /**
     * Get a specific setting of this post
     *
     * @return mixed  The results
     *
     * @since 1.0.0
     */
    function yit_get_post_type_setting( $setting, $post_type ) {
        global $yit;

        $post_id = $yit->getModel('cpt_unlimited')->get_post_type_ID( $post_type );
        return $yit->getModel('cpt_unlimited')->get_setting( $setting, $post_id );
    }
}

if( !function_exists( 'is_testimonial' ) ) {
    /**
     * Check if the current post is a testimonial
     *
     * @return bool
     * @since 1.0.0
     */
    function is_testimonial() {
        global $post;

        if( !isset( $post ) || !is_object( $post ) )
            { return false; }



        return $post->post_type == 'testimonial' ? true : false;
    }
}

if( !function_exists( 'is_portfolio' ) ) {
    /**
     * Check if the current post is a portfolio
     *
     * @return bool
     * @since 1.0.0
     */
    function is_portfolio() {
        global $post;

        if( !isset( $post ) || !is_object( $post ) )
            { return false; }
        //return $post->post_type == 'portfolios' ? true : false;
    }
}

if( !function_exists( 'is_services' ) ) {
    /**
     * Check if the current post is a service
     *
     * @return bool
     * @since 1.0.0
     */
    function is_services() {
        global $post;

        if( !isset( $post ) || !is_object( $post ) )
            { return false; }

        return $post->post_type == 'services' ? true : false;
    }
}

if( !function_exists( 'is_gallery' ) ) {
    /**
     * Check if the current post is a gallery
     *
     * @return bool
     * @since 1.0.0
     */
    function is_gallery() {
        global $post;

        if( !isset( $post ) || !is_object( $post ) )
            { return false; }

        return $post->post_type == 'galleries' ? true : false;
    }
}

if( !function_exists( 'is_internal' ) ) {
    /**
     * Check if is portfolio, testimonial or gallery.
     *
     * @return bool
     * @since 1.0.0
     */
    function is_internal() {
        global $post;

        if( !isset( $post ) || !is_object( $post ) )
            { return false; }

        return is_portfolio() || is_gallery() || is_testimonial() || is_services();
    }
}