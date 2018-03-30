<?php
/**
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Framework
 * @subpackage G1_Post_Meta_Manager
 * @since G1_Post_Meta_Manager 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php


class G1_Post_Meta_Manager {
    protected $priorities;
    protected $sections;

    protected $settings;
    private $_post_values;

    public function __construct() {
        $this->priorities = array();
        $this->sections = array();
        $this->settings = array();

        $this->setup_hooks();
    }

    /**
     * Set up all hooks
     */
    protected function setup_hooks() {
        add_action( 'wp_loaded', array( $this, 'do_register' ) );
    }

    /**
     * Gets all sections
     *
     * @return array
     */
    public function get_sections() {
        return $this->sections;
    }

    /**
     * Gets all settings
     *
     * @return array
     */
    public function get_settings() {
        return $this->settings;
    }

    /**
     * Adds a section
     *
     * @param mixed $id
     * @param array $args
     */
    public function add_section( $id, $args = array() ) {
        if ( is_a( $id, 'G1_Post_Meta_Section' ) ) {
            $section = $id;
        } else {
            $section = new G1_Post_Meta_Section( $id, $args );
        }

        if ( $section ) {
            $this->sections[ $section->get_id() ] = $section;
        }
    }

    /**
     * Gets a section
     *
     * @param string $id
     * @return G1_Post_Meta_Section object
     */
    public function get_section( $id ) {
        if ( $this->has_section( $id ) ) {
            return $this->sections[ $id ];
        }
    }

    /**
     * Removes a section
     *
     * @param string $id
     */
    public function remove_section( $id ) {
        if ( $this->has_section( $id ) ) {
            unset( $this->sections[ $id ] );
        }
    }

    /**
     * Checks whether a section exists.
     *
     * @param string $id
     * @return bool
     */
    public function has_section( $id ) {
        return isset( $this->sections[ $id ] );
    }

    /**
     * Registers sections and settings
     */
    public function do_register() {
        $this->add_section( 'g1_general', array(
                'title' => __( 'General Settings', 'g1_theme' )
            )
        );

        $this->add_section( 'g1_single', array(
                'title' => __( 'Single Page Settings', 'g1_theme' )
            )
        );

        do_action( 'g1_post_meta_manager_register', $this );
        do_action( 'g1_post_meta_manager_init', $this );
    }

    /**
     * Adds a setting.
     *
     * @param string $id
     * @param array $args
     */
    public function add_setting( $id, $args = array() ) {
        $section = isset( $args['section'] ) ? $args['section'] : 'default';
        if ( $this->has_section( $section ) ) {
            $section = $this->get_section( $section );

            if ( is_a( $id, 'G1_Post_Meta_Setting' ) ) {
                $setting = $id;
            } else {
                $setting = new G1_Post_Meta_Setting( $id, $args );
            }

            $priority = isset( $args['priority'] ) ? (int) $args['priority'] : 10;

            $this->settings[ $setting->get_id() ] = $setting;
            $section->add_setting( $setting, $priority );
        }
    }

    /**
     * Gets a setting.
     *
     * @param string $id
     * @return object
     */
    public function get_setting( $id ) {
        if ( $this->has_setting( $id ) ) {
            return $this->settings[ $id ];
        }
    }

    /**
     * Removes a setting.
     *
     * @param string $id
     */
    public function remove_setting( $id ) {
        if ( $this->has_setting( $id ) ) {
            unset( $this->settings[ $id ] );
        }
    }

    /**
     * Checks whether a setting exists.
     *
     * @param string $id
     * @return bool
     */
    public function has_setting( $id ) {
        return isset( $this->settings[ $id ] );
    }
}
/**
 * Quasi-singleton for our manager
 *
 * @return G1_Post_Meta_Manager
 */
function G1_Post_Meta_Manager() {
    static $instance;

    if ( !isset( $instance ) )
        $instance = new G1_Post_Meta_Manager();

    return $instance;
}
// Fire in the hole :)
G1_Post_Meta_Manager();


global $g1_post_meta_manager;
$g1_post_meta_manager = new G1_Post_Meta_Manager();




class G1_Post_Meta_Section {
    protected $id;

    protected $title;
    protected $description;

    protected $settings;
    protected $priorities;



    public function __construct( $id, $args = array() ) {
        $keys = array_keys( get_class_vars( __CLASS__ ) );
        foreach ( $keys as $key ) {
            if ( isset( $args[ $key ] ) )
                $this->$key = $args[ $key ];
        }

        $this->set_id( $id );

        $this->set_title( $args['title'] );
        $this->set_description( '' );

        $this->settings = array();
        $this->priorities = array();


        add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );

        add_action( 'save_post', array( $this, 'save' ) );
    }



    public function add_meta_boxes() {
        // Get appliable post types
        $apply_set = $this->get_apply_set();

        // For every post type create a meta box
        foreach ( $apply_set as $post_type ) {
            add_meta_box(
                'g1_meta_box_' . $this->get_id(), 		//id
                esc_html( $this->get_title() ),         //title
                array( $this, 'render' ),     	    	//render function callback
                $post_type, 							//post_type
                'normal', 							    //context
                'high'  								//priority
            );
        }
    }

    protected function is_doing_autosave() {
        return defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ? true : false;
    }

    protected function is_inline_edit() {
        return isset( $_POST['_inline_edit'] ) ?  true : false;
    }


    protected function get_nonce_action() {
        return 'g1_post_meta_section_' . $this->get_id();
    }

    protected function get_nonce_name() {
        return 'g1_post_meta_section_' . $this->get_id() . '_nonce';
    }

    protected function is_doing_preview () {
        return !empty( $_POST['wp-preview'] );
    }

    public function save( $post_id ) {

        // Don't save data automatically via autosave feature
        if ( $this->is_doing_autosave() ) {
            return $post_id;
        }

        // Don't save data when doing preview
        if ( $this->is_doing_preview() ) {
            return $post_id;
        }

        // Don't save data when using Quick Edit
        if ($this->is_inline_edit() ) {
            return $post_id;
        }

        $post_type = isset( $_POST['post_type'] ) ? $_POST['post_type'] : null;

        // Update options only if they are appliable
        if( !in_array( $post_type, $this->get_apply_set() ) ) {
            return $post_id;
        }

        // Check permissions
        $post_type_obj = get_post_type_object( $post_type );
        if ( !current_user_can( $post_type_obj->cap->edit_post, $post_id ) ) {
            return $post_id;
        }

        // Verify nonce
        if ( !check_admin_referer( $this->get_nonce_action(), $this->get_nonce_name() ) ) {
            wp_die( __( 'Nonce incorrect!', 'btp_theme' ) );
        }

        // Save each setting
        foreach ( $this->get_settings() as $setting_id => $setting ) {
            $setting->set_object_id( $post_id );
            $setting->save();
        }
    }

    /**
     * Gets the id
     *
     * @return      string
     */
    public function get_id() {
        return $this->id;
    }

    /**
     * Sets the id
     *
     * @param       string
     */
    public function set_id( $val ) {
        $this->id = $val;
    }

    /**
     * Sets the title
     *
     * @param       string
     */
    public function set_title( $val ) {
        $this->title = $val;
    }

    /**
     * Gets the title
     *
     * @return      string
     */
    public function get_title() {
        return $this->title;
    }

    /**
     * Sets the description
     *
     * @param       string
     */
    public function set_description( $val ) {
        $this->description = $val;
    }

    /**
     * Gets the title
     *
     * @return      string
     */
    public function get_description() {
        return $this->description;
    }

    /**
     * check whether a setting exists
     *
     * @return      string
     */
    public function has_setting( $id ) {
        return isset( $this->settings[ $id ] );
    }


    /**
     * Gets a setting
     *
     * @return G1_Post_Meta_Setting
     */
    public function get_setting( $id ) {
        if ( $this->has_setting( $id ) ) {
            return $this->settings[ $id ];
        }
    }

    public function add_setting( G1_Post_Meta_Setting $setting, $priority = 10 ) {
        $this->settings[ $setting->get_id() ] = $setting;
        $this->priorities[ $setting->get_id() ] = $priority;

    }

    public function remove_setting( $id ) {
        if ( $this->has_setting( $id ) ) {
            unset( $this->settings[ $id ] );
            unset( $this->priorities[ $id ] );
        }
    }


    /**
     * Gets all settings
     *
     * @return array
     */
    public function get_settings() {
        $this->sort_priorities();

        $result = array();
        foreach ( $this->priorities as $setting_id => $priority ) {
            $result[ $setting_id ] = $this->settings[ $setting_id ];
        }

        return $result;
    }

    public function sort_priorities() {
        asort( $this->priorities, SORT_NUMERIC );
    }


    /**
     * Composes an array of appliable types
     *
     * @return			array
     */
    public function get_apply_set() {
        $result = array();

        foreach( $this->get_settings() as $settings_id => $setting ) {
            $result = array_unique( array_merge( $result, $setting->get_post_types() ) );
        }

        return $result;
    }

    /**
     * Captures the section
     */
    public function capture( $post, $metabox ) {
        $out = '';

        foreach ( $this->get_settings() as $setting ) {
            $setting->set_object_id( $post->ID );
            if ( $setting->has_post_type( $post->post_type ) ) {
                $out .= $setting->capture();
            }
        }

        // Secure the form with nonce field
        $nonce = wp_nonce_field(
            $this->get_nonce_action(),
            $this->get_nonce_name(),
            true,
            false
        );

        $out =  $nonce .
            '<ul class="g1-post-meta-section-content">' .
            $out .
            '</ul>';

        return $out;
    }
    public function render( $post, $metabox ) {
        echo $this->capture( $post, $metabox );
    }
}




class G1_Post_Meta_Setting {
    /**
     * Unique identifier
     *
     * @var string
     */
    protected $id;


    /**
     * Default value
     *
     * @var mixed
     */
    protected $default;


    protected $post_types;

    protected $view;

    protected $object_id;

    /**
     * Constructor.
     *
     * @param       string $id
     * @param       array $args
     */
    function __construct( $id, $args = array() ) {
        $this->set_id( $id );

        $this->object_id = null;

        // The 'default' argument

        if ( isset ( $args['default'] ) ) {
            $this->set_default( $args['default'] );
        }


        $this->post_types = array();

        // The 'apply' argument
        if ( isset ( $args['apply'] ) ) {
            if ( is_array( $args['apply'] ) ) {
                foreach ( $args['apply'] as $post_type ) {
                    $this->add_post_type( $post_type );
                }
            } else {
                $this->add_post_type( $args['apply'] );
            }
        }

        // The 'view' argument
        if ( isset ( $args['view'] ) ) {
            $this->set_view( $args['view'] );
        } else {
            $this->set_view( new G1_Form_Text_Control( $this->get_id() ) );
        }
    }

    public function replace_multidimensional_value( $base, $keys, $value ) {
        if ( count( $keys ) ) {
            $key = array_shift( $keys );

            if ( 0 < count( $keys ) ) {
                if ( !isset( $base[ $key ] ) ) {
                    $base[ $key ] = array();
                }

                $base[ $key ] = $this->replace_multidimensional_value( $base[ $key ], $keys, $value );
            } else {
                $base[ $key ] = $value;
            }
        } else {
            $base = $value;
        }

        return $base;
    }



    public function save() {
        $post_id = $this->get_object_id();

        if ( null === $post_id )
            return null;

        $post_type = isset( $_POST['post_type'] ) ? $_POST['post_type'] : null;

        if ( !$this->has_post_type( $post_type ) )
            return;

        $post_type_obj = get_post_type_object( $post_type );
        if ( !current_user_can( $post_type_obj->cap->edit_post, $post_id ) )
            return $post_id;


        $keys = preg_split( '/\[/', str_replace( ']', '', $this->get_id() ) );

        $meta_key = array_shift( $keys );
        $meta_value = get_post_meta( $post_id, $meta_key, true );

        if ( isset ( $_POST[ $meta_key ] ) ) {
            /* WP ignores the built in php magic quotes setting
             * WP ignores the value of get_magic_quotes_gpc()
             * It will always add magic quotes
             * That's why we need to strip slashes
             */
            $post_value = stripslashes_deep( $_POST[ $meta_key ] );

            $value = $this->get_multidimensional_value( $post_value, $keys );

            $meta_value = $this->replace_multidimensional_value( $meta_value, $keys, $value );
            update_post_meta( $post_id, $meta_key, $meta_value );
        }
    }



    protected function get_multidimensional_value( $hmm_array, $keys ) {
        $key = array_shift( $keys );

        if ( 0 < count( $keys ) ) {
            if ( !isset( $hmm_array[ $key ] ) ) {
                return null;
            }

            return $this->get_multidimensional_value( $hmm_array[ $key ], $keys );
        } else {
            if ( is_array( $hmm_array ) ) {
                if ( isset ( $hmm_array[ $key ] ) ) {
                    return $hmm_array[ $key ];
                } else {
                    return null;
                }
            } else {
                return $hmm_array;
            }
        }
    }


    public function get_value() {
        $post_id = $this->get_object_id();
        if ( null === $post_id ) {
            return null;
        }

        $keys = preg_split( '/\[/', str_replace( ']', '', $this->get_id() ) );

        $hmm_array = array_shift( $keys );

        $val = get_post_meta( $post_id, $hmm_array, true );


        $val = $this->get_multidimensional_value( $val, $keys );
        return $val;
    }


    public function set_view( G1_Form_Control $obj ) {
        $this->view = $obj;
    }


    public function get_view() {
        return $this->view;
    }


    public function capture() {
        $view = $this->get_view();
        $view->set_value( $this->get_value() );

        return $view->capture();
    }




    public function has_post_type( $post_type ) {
        return in_array( $post_type, $this->post_types );
    }

    public function add_post_type( $post_type ) {
        if ( !$this->has_post_type( $post_type ) ) {
            $this->post_types[] = $post_type;
        }
    }

    public function remove_post_type( $post_type ) {
        if ( $this->has_post_type( $post_type ) ) {
            unset( $this->post_types[ $post_type ] );
        }
    }

    public function get_post_types() {
        return $this->post_types;
    }


    /**
     * Gets the id
     *
     * @return      string
     */
    public function get_id() {
        return $this->id;
    }

    /**
     * Sets the id
     */
    public function set_id( $val ) {
        $this->id = $val;
    }

    /**
     * Gets the object_id
     *
     * @return string
     */
    public function get_object_id() {
        return $this->object_id;
    }

    /**
     * Sets the object_id
     */
    public function set_object_id( $val ) {
        $this->object_id = $val;
    }

    /**
     * Gets the default
     *
     * @return      mixed
     */
    public function get_default() {
        return $this->default;
    }

    /**
     * Sets the default
     */
    public function set_default( $val ) {
        $this->default = $val;
    }
}