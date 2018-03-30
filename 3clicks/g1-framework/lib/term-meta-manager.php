<?php
/**
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Framework
 * @subpackage G1_Term_Meta_Manager
 * @since G1_Term_Meta_Manager 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php

/**
 * Gets term option value
 *
 * @param 			int $tt_id
 * @param			string $option_id
 */
function g1_term_get_option_value( $tt_id, $option_id ) {
    return '';
}




final class G1_Term_Meta_Manager {
    protected $priorities;
    protected $sections;
    protected $settings;

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
        add_action( 'wp_loaded',    array( $this, 'do_register' ) );
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
     * @param string $id
     * @param array $args
     */
    public function add_section( G1_Term_Meta_Section $section, $args = array() ) {
        $this->sections[ $section->get_id() ] = $section;
    }

    public function get_section( $id ) {
        if ( $this->has_section( $id ) ) {
            return $this->sections[ $id ];
        }
    }

    public function remove_section( $id ) {
        if ( $this->has_section( $id ) ) {
            unset( $this->sections[ $id ] );
        }
    }

    public function has_section( $id ) {
        return isset( $this->sections[ $id ] );
    }

    /**
     * Return true if it's an AJAX request.
     */
    public function doing_ajax() {
        return ( defined( 'DOING_AJAX' ) && DOING_AJAX );
    }

    /**
     * Registers sections and settings
     */
    public function do_register() {
        do_action( 'g1_term_meta_manager_register', $this );
        do_action( 'g1_term_meta_manager_init', $this );
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

            if ( is_a( $id, 'G1_Term_Meta_Setting' ) ) {
                $setting = $id;
            } else {
                $setting = new G1_Term_Meta_Setting( $id, $args );
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
     * @return G1_Term_Meta_Setting
     */
    public function get_setting( $id ) {
        if ( isset( $this->settings[ $id ] ) ) {
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
     * @param       string $id
     */
    public function has_setting( $id ) {
        return isset( $this->settings[ $id ] );
    }
}

/**
 * Quasi-singleton for our manager
 *
 * @return G1_Term_Meta_Manager
 */
function G1_Term_Meta_Manager() {
    static $instance;

    if ( !isset( $instance ) )
        $instance = new G1_Term_Meta_Manager();

    return $instance;
}
// Fire in the hole :)
G1_Term_Meta_Manager();






class G1_Term_Meta_Section {
    protected $id;
    protected $title;
    protected $description;

    protected $settings;
    protected $priorities;


    public function __construct( $id, $args = array() ) {
        $this->set_id( $id );

        $this->set_title( $args['title'] );
        $this->set_description( '' );

        $this->settings = array();
        $this->priorities = array();

        add_action( 'g1_term_meta_manager_init', array( $this, 'manager_init' ) );
    }

    public function manager_init() {
        // Get appliable post types
        $apply_set = $this->get_apply_set();

        foreach( $apply_set as $taxonomy ) {
            add_action( $taxonomy . '_edit_form_fields', array( $this, 'render' ) );
            add_action( 'edited_term_taxonomy', array( $this, 'save' ) );
        }
    }

    protected function is_doing_autosave() {
        return defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ? true : false;
    }

    protected function is_inline_edit() {
        return isset( $_POST['_inline_edit'] ) ?  true : false;
    }

    protected function get_nonce_action() {
        return 'g1_term_meta_section_' . $this->get_id();
    }

    protected function get_nonce_name() {
        return 'g1_term_meta_section_' . $this->get_id() . '_nonce';
    }


    public function save( $tt_id ) {
        // Save only when edittag form has been submitted
        if ( !isset( $_POST['action'] ) || $_POST['action'] != 'editedtag' )
            return;

        // Don't save data automatically via autosave feature
        if ( $this->is_doing_autosave() )
            return;

        // Don't save data when using Quick Edit
        if ( $this->is_inline_edit() )
            return;

        $taxonomy = isset( $_POST['taxonomy'] ) ? $_POST['taxonomy'] : null;

        // Update options only if they are appliable
        if( !in_array( $taxonomy, $this->get_apply_set() ) )
            return;

        // Check permissions
        $taxonomy_obj = get_taxonomy( $taxonomy );
        if ( !$taxonomy_obj )
            return;

        if ( !current_user_can( $taxonomy_obj->cap->edit_terms ) )
            wp_die( __('You do not have sufficient permissions to access this page.', 'g1_theme') );


        // Verify nonce
        if ( !check_admin_referer( $this->get_nonce_action(), $this->get_nonce_name() ) ) {
            wp_die( __( 'Nonce incorrect!', 'btp_theme' ) );
        }

        // Save each setting
        foreach ( $this->get_settings() as $setting_id => $setting ) {
            $setting->set_object_id( $tt_id );
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
     * @return      string
     */
    public function get_setting( $id ) {
        if ( $this->has_setting( $id ) ) {
            return $this->settings[ $id ];
        }
    }

    public function add_setting( G1_Term_Meta_Setting $setting, $priority = 10 ) {
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
     * @return array
     */
    public function get_apply_set() {
        $result = array();

        foreach( $this->get_settings() as $settings_id => $setting ) {
            $result = array_unique( array_merge( $result, $setting->get_taxonomies() ) );
        }

        return $result;
    }

    /**
     * Captures the section
     */
    public function capture( $term ) {
        $out = '';

        foreach ( $this->get_settings() as $setting ) {
            $setting->set_object_id( $term->term_taxonomy_id );
            if ( $setting->has_taxonomy( $term->taxonomy ) ) {
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

        $out =  '<tr class="form-field">' .
            '<td colspan="2">' .
            $nonce .
            $out .
            '</td>' .
            '</tr>';

        return $out;
    }
    public function render( $term ) {
        echo $this->capture( $term );
    }
}





class G1_Term_Meta_Setting {
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


    protected $taxonomies;

    protected $view;

    protected $object_id;


    /**
     * Sanitize callback function
     *
     * @var mixed
     */
    protected $sanitize_callback;

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


        $this->taxonomies = array();

        // The 'apply' argument
        if ( isset ( $args['apply'] ) ) {
            if ( is_array( $args['apply'] ) ) {
                foreach ( $args['apply'] as $taxonomy ) {
                    $this->add_taxonomy( $taxonomy );
                }
            } else {
                $this->add_taxonomy( $args['apply'] );
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
        $tt_id = $this->get_object_id();

        if ( null === $tt_id )
            return null;

        $taxonomy = isset( $_POST['taxonomy'] ) ? $_POST['taxonomy'] : null;

        if ( !$this->has_taxonomy( $taxonomy ) )
            return;

        // Check permissions
        $taxonomy_obj = get_taxonomy( $taxonomy );
        if ( !$taxonomy_obj )
            return;

        if ( !current_user_can( $taxonomy_obj->cap->edit_terms ) )
            return;

        $temp = get_option( 'g1_tt_' . $tt_id, array() );

        $keys = preg_split( '/\[/', str_replace( ']', '', $this->get_id() ) );
        $meta_key = array_shift( $keys );

        $meta_value = isset( $temp[ $meta_key ] ) ? $temp[ $meta_key ] : null;

        if ( isset ( $_POST[ $meta_key ] ) ) {
            /* WP ignores the built in php magic quotes setting
             * WP ignores the value of get_magic_quotes_gpc()
             * It will always add magic quotes
             * That's why we need to strip slashes
             */
            $post_value = stripslashes_deep( $_POST[ $meta_key ] );

            $value = $this->get_multidimensional_value( $post_value, $keys );

            $meta_value = $this->replace_multidimensional_value( $meta_value, $keys, $value );

            $temp[ $meta_key ] = $meta_value;

            update_option( 'g1_tt_' . $tt_id, $temp );
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
        $tt_id = $this->get_object_id();
        if ( null === $tt_id ) {
            return null;
        }
        $temp = get_option( 'g1_tt_' . $tt_id, array() );

        $keys = preg_split( '/\[/', str_replace( ']', '', $this->get_id() ) );
        $hmm_array = array_shift( $keys );

        $val = isset( $temp[ $hmm_array ] ) ? $temp[ $hmm_array ] : null;
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




    public function has_taxonomy( $taxonomy ) {
        return in_array( $taxonomy, $this->taxonomies );
    }

    public function add_taxonomy( $taxonomy ) {
        if ( !$this->has_taxonomy( $taxonomy ) ) {
            $this->taxonomies[] = $taxonomy;
        }
    }

    public function remove_taxonomy( $taxonomy ) {
        if ( $this->has_taxonomy( $taxonomy ) ) {
            unset( $this->taxonomies[ $taxonomy ] );
        }
    }

    public function get_taxonomies() {
        return $this->taxonomies;
    }


    /**
     * Gets the id
     *
     * @return string
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
     * @return mixed
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