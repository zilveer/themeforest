<?php
/**
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Framework
 * @subpackage G1_Elements
 * @since G1_Elements 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php


class G1_Element {
    /**
     * Unique identifier
     *
     * @var string
     */
    protected $id;

    /**
     * Feature
     *
     * Read more about the add_post_type_support function in the Codex:
     * http://codex.wordpress.org/Function_Reference/add_post_type_support
     *
     * @var string
     */
    protected $feature;

    /**
     * Label
     *
     * @var string
     */
    protected $label;

    /**
     * Hint
     *
     * @var string
     */
    protected $hint;

    /**
     * Help
     *
     * @var string
     */
    protected $help;


    /**
     * Priority
     *
     * @var int
     */
    protected $priority;


    /**
     * Available choices
     *
     * @var array
     */
    protected $choices;

    /**
     * An array of supported post types
     *
     * @var array
     */
    protected $post_types;



    public function __construct( $id, $args ) {
        $this->set_id( $id );

        // feature argument
        if ( isset ( $args['feature'] ) ) {
            $this->set_feature( $args['feature'] );
        } else {
            $this->set_feature( $this->compose_feature_from_id() );
        }

        $this->set_label( isset( $args['label'] ) ? $args['label'] : $this->get_id() );
        $this->set_hint( isset( $args['hint'] ) ? $args['hint'] : '' );
        $this->set_help( isset( $args['help'] ) ? $args['help'] : '' );

        $this->set_priority( isset( $args['priority'] ) ? $args['priority'] : 100 );


        if ( isset( $args['choices'] ) ) {
            $this->set_choices( $args['choices'] );
        } else {
            $this->set_choices( array(
                'standard'	=> __( 'show', 'g1_theme' ),
                'none'		=> __( 'hide', 'g1_theme' ),
            ));
        }

        $this->post_types = array();
    }

    public function get_id() { return $this->id; }
    public function set_id( $val ) { $this->id = $val; }

    public function get_feature() { return $this->feature; }
    public function set_feature( $val ) { $this->feature = $val; }

    protected function compose_feature_from_id() {
        return $this->feature;
    }

    public function get_label() { return $this->label; }
    public function set_label( $val ) { $this->label = $val; }

    public function get_hint() { return $this->hint; }
    public function set_hint( $val ) { $this->hint = $val; }

    public function get_help() { return $this->help; }
    public function set_help( $val ) { $this->help = $val; }

    public function get_priority() { return $this->priority; }
    public function set_priority( $val ) { $this->priority = (int) $val; }

    public function has_post_type( $post_type ) {
        return in_array( $post_type, $this->get_post_types() );
    }

    /**
     * Gets post types with support for our feature
     *
     * @return array
     */
    public function get_post_types() {
        $result = array();

        foreach ( get_post_types() as $post_type ) {
            if ( post_type_supports( $post_type, $this->get_feature() ) ) {
                $result[ $post_type ] = $post_type;
            }
        }

        return $result;
    }


    public function set_choices( $arr ) {
        $this->choices = $arr;
    }

    public function get_choices() {
        $hook = str_replace( '-', '_', $this->get_id() );
        $hook = 'g1_element_' . $hook . '_choices';

        $choices = apply_filters( $hook, $this->choices );

        return $choices;
    }

    public function get_default_value () {
        $choices = $this->get_choices();

        if ( !empty($choices) && is_array($choices) ) {
            $keys = array_keys($choices);

            return array_shift( $keys );
        }

        return '';
    }
}

class G1_Collection_Element extends G1_Element {
    public function __construct( $id, $args ) {
        parent::__construct( $id, $args );

        $this->setup_hooks();
    }


    protected function compose_feature_from_id() {
        $feature = str_replace( '_', '-', $this->get_id() );
        $feature = 'g1-collection-element-' . $feature;

        return $feature;
    }

    /**
     * Gets taxonomies with support for our feature
     *
     * @return array
     */
    public function get_taxonomies( $feature ) {
        $taxonomies = array();
        foreach ( get_taxonomies() as $taxonomy ) {
            if ( taxonomy_supports( $taxonomy, $feature ) ) {
                $taxonomies[ $taxonomy ] = $taxonomy;
            }
        }

        return $taxonomies;
    }

    /**
     * Set up all hooks
     */
    protected function setup_hooks() {
        add_filter( get_redux_opts_sections_filter_name(), array( $this, 'register_post_type_archive_collection_element' ), 99 );
        add_filter( get_redux_opts_sections_filter_name(), array( $this, 'register_taxonomy_collection_element' ), 99 );

        add_action( 'g1_term_meta_manager_register', array( $this, 'register_individual_term_setting' ) );
    }


    protected function get_global_archive_id_base( $name, $type = 'post_type' ) {
        $result = '';

        switch( $type ) {
            case 'post_type':
                $result = str_replace( '-', '_', $name );
                $result = 'post_type_' . $result;
                break;
            case 'taxonomy':
                $result = str_replace( '-', '_', $name );
                $result = 'taxonomy_' . $result;
                break;
        }

        return $result;
    }


    protected function get_global_archive_id_key( $name, $type = 'post_type' ) {
        $result = '';

        $result = str_replace( '-', '_', $this->get_id() );
        $result = 'collection_element_' . $result;

        return $result;
    }

    protected function get_global_archive_setting_id( $name, $type = 'post_type' ) {
        $result = '';

        switch( $type ) {
            case 'post_type':
                $result = $this->get_global_archive_id_base( $name, $type );
                $result = $result . '_' . $this->get_global_archive_id_key( $name, $type );
                break;
            case 'taxonomy':
                $result = $this->get_global_archive_id_base( $name, $type );
                $result = $result . '_' . $this->get_global_archive_id_key( $name, $type );
                break;
        }

        return $result;
    }


    /**
     *
     *
     * @param G1_Term_Meta_Manager $manager
     */
    public function register_individual_term_setting( $manager ) {
        $taxonomies = $this->get_taxonomies( 'g1-collection-individual-elements' );

        foreach ( $taxonomies as $key => $taxonomy ) {
            $taxonomy_obj = get_taxonomy( $taxonomy );
            if ( ! $taxonomy_obj ) {
                unset( $taxonomies[ $key ] );
                continue;
            }

            if ( !count( array_intersect( $this->get_post_types(), $taxonomy_obj->object_type ) ) ) {
                unset( $taxonomies[ $key ] );
                continue;
            }
        }

        if ( count( $taxonomies ) ) {
            $setting_id = str_replace( '-', '_', $this->get_id() );
            $setting_id = '_g1[element_' . $setting_id . ']';

            $choices = $this->get_choices();
            $choices = array( '' => __( 'inherit', 'g1_theme') ) + $choices;

            $manager->add_setting( $setting_id, array(
                'apply'	   	=> $taxonomies,
                'view'      => new G1_Form_Choice_Control( $setting_id, array(
                    'label'     => $this->get_label(),
                    'choices'   => $choices,
                )),
                'section'	=> 'g1_term_single', //G1_Single_Entry_Settings_Feature()->get_section_id(),
                'priority'	=> $this->get_priority(),
            ));
        }
    }




    /**
     * Registers archive elements for post types
     *
     * @param $sections
     */
    public function register_post_type_archive_collection_element( $sections ) {
        foreach ( $this->get_post_types() as $post_type ) {
            if ( !post_type_supports( $post_type, 'g1-collection-global-elements' ) ) {
                continue;
            }

            $id = $this->get_global_archive_setting_id( $post_type, 'post_type' );
            $section_id = G1_Archive_Settings_Feature()->get_section_id( $post_type );

            if ( !empty($sections[$section_id]) ) {
                $sections[$section_id]['fields'][] = array(
                    'id'        => $id,
                    'priority'  => $this->get_priority(),
                    'type'      => 'select',
                    'title'     => $this->get_label(),
                    'options'   => $this->get_choices(),
                );
            }
        }

        return $sections;
    }


    /**
     * Registers archive elements for taxonomy
     *
     * @param $sections
     */
    public function register_taxonomy_collection_element( $sections ) {
        foreach ( $this->get_taxonomies( 'g1-collection-global-elements' ) as $taxonomy ) {
            $taxonomy_obj = get_taxonomy( $taxonomy );
            if ( ! $taxonomy_obj ) {
                continue;
            }

            if ( !count( array_intersect( $this->get_post_types(), $taxonomy_obj->object_type ) ) ) {
                continue;
            }

            $id = $this->get_global_archive_setting_id( $taxonomy, 'taxonomy' );
            $section_id = G1_Archive_Settings_Feature()->get_section_id( $taxonomy );

            if ( !empty($sections[$section_id]) ) {
                $sections[$section_id]['fields'][] = array(
                    'id'        => $id,
                    'priority'  => $this->get_priority(),
                    'type'      => 'select',
                    'title'     => $this->get_label(),
                    'options'   => $this->get_choices(),
                );
            }
        }

        return $sections;
    }


    public function get_post_type_archive_value( $post_type ) {
        $val = g1_get_theme_option(
            $this->get_global_archive_id_base( $post_type, 'post_type'),
            $this->get_global_archive_id_key( $post_type, 'post_type' )
        );
        $val = strlen( $val ) ? $val : true;

        return $val;
    }

    public function get_global_value( $name, $type = 'post_type' ) {
        $val = null;

        $val = g1_get_theme_option(
            $this->get_global_archive_id_base( $name, $type ),
            $this->get_global_archive_id_key( $name, $type )
        );

        if ( empty($val) ) {
            $val = $this->get_default_value();
        }

        return $val;
    }

    public function get_term_value( $term ) {
        $global_val = $this->get_global_value($term->taxonomy, 'taxonomy');

        $meta = (array) g1_get_term_meta( $term->term_taxonomy_id, '_g1' );
        $setting_id = str_replace( '-', '_', $this->get_id() );
        $setting_id = 'element_' . $setting_id;

        $val = isset( $meta[ $setting_id ] ) ? $meta[ $setting_id ] : true;

        // inherit if string empty or value not set (it has default value = true)
        if ( $val === true || strlen($val) == 0 ) {
            $val = $global_val;
        }

        return $val;
    }
}

class G1_Collection_Element_Author extends G1_Collection_Element {
    public function has_post_type( $post_type ) {
        return true;
    }

    public function get_post_type_archive_value( $post_type ) {
        if ( !post_type_supports( $post_type, 'author' ) ) {
            return false;
        }

        return parent::get_post_type_archive_value($post_type);
    }

    public function get_global_value( $name, $type = 'post_type' ) {
        if ( !post_type_supports( $name, 'author' ) ) {
            return false;
        }

        return parent::get_global_value( $name, $type );
    }
}


class G1_Single_Element extends G1_Element {
    public function __construct( $id, $args ) {
        parent::__construct( $id, $args );

        $this->setup_hooks();
    }


    protected function compose_feature_from_id() {
        $feature = str_replace( '_', '-', $this->get_id() );
        $feature = 'g1-single-element-' . $feature;

        return $feature;
    }


    /**
     * Set up all hooks
     */
    protected function setup_hooks() {
        add_filter( get_redux_opts_sections_filter_name(),   array( $this, 'register_post_type_single_element' ), 99 );

        add_action( 'g1_post_meta_manager_register',    array( $this, 'register_entry_element' ), 99 );
    }


    protected function get_section_id( $post_type ) {
        $section_id = str_replace( array( '-', '_'), array( '', '' ), $post_type );
        $section_id = $section_id . '_single';

        return $section_id;
    }


    protected function get_global_id_base( $name, $type = 'post_type' ) {
        $result = '';

        switch( $type ) {
            case 'post_type':
                $result = str_replace( '-', '_', $name );
                $result = 'post_type_' . $result;
                break;
            case 'taxonomy':
                $result = str_replace( '-', '_', $name );
                $result = 'taxonomy_' . $result;
                break;
        }

        return $result;
    }


    protected function get_global_id_key( $name, $type = 'post_type' ) {
        $result = '';

        $result = str_replace( '-', '_', $this->get_id() );
        $result = 'single_element_' . $result;

        return $result;
    }

    protected function get_global_setting_id( $name, $type = 'post_type' ) {
        $result = '';

        switch( $type ) {
            case 'post_type':
                $result = $this->get_global_id_base( $name, $type );
                $result = $result . '_' . $this->get_global_id_key( $name, $type );
                break;
            case 'taxonomy':
                $result = $this->get_global_id_base( $name, $type );
                $result = $result . '_' . $this->get_global_id_key( $name, $type );
                break;
        }

        return $result;
    }



    /**
     * Registers single elements for post types
     *
     * @param $sections
     */
    public function register_post_type_single_element( $sections ) {
        foreach ( $this->get_post_types() as $post_type ) {
            $id = $this->get_global_setting_id( $post_type );
            $section_id = G1_Single_Settings_Feature()->get_section_id( $post_type );

            if ( !empty($sections[$section_id]) ) {
                $sections[$section_id]['fields'][] = array(
                    'id'        => $id,
                    'priority'  => $this->get_priority(),
                    'type'      => 'select',
                    'title'     => $this->get_label(),
                    'sub_desc'  => $this->get_help(),
                    'options'   => $this->get_choices(),
                );
            }
        }

        return $sections;
    }

    public function register_entry_element( $manager ) {
        $post_types = $this->get_post_types();
        foreach ( $post_types as $post_type ) {
            if ( !post_type_supports( $post_type, G1_Single_Entry_Settings_Feature()->get_feature() ) ) {
                unset( $post_types[ $post_type ] );
            }
        }

        if ( count( $post_types ) ) {
            $setting_id = '_g1[' . $this->get_individual_setting_id() . ']';

            // Add the empty choice
            $choices = $this->get_choices();
            $choices = array( '' => __( 'inherit', 'g1_theme') ) + $choices;

            $manager->add_setting( $setting_id, array(
                'apply'	   	=> $post_types,
                'view'      => new G1_Form_Choice_Control( $setting_id, array(
                    'label'     => $this->get_label(),
                    'hint'      => $this->get_hint(),
                    'help'      => $this->get_help(),
                    'choices'   => $choices,
                )),
                'section'	=> G1_Single_Entry_Settings_Feature()->get_section_id(),
                'priority'	=> $this->get_priority(),
            ));
        }
    }







    protected function get_individual_setting_id() {
        $setting_id = str_replace( '-', '_', $this->get_id() );
        $setting_id = 'single_element_' . $setting_id;

        return $setting_id;
    }


    /**
     * @todo feature check?
     */
    public function get_global_value( $name, $type = 'post_type' ) {
        $val = null;

        $val = g1_get_theme_option(
            $this->get_global_id_base( $name, $type ),
            $this->get_global_id_key( $name, $type )
        );

        if ( empty($val) ) {
            $val = $this->get_default_value();
        }

        return $val;
    }


    /**
     * @todo feature check?
     *
     */
    public function get_individual_value( $id, $type = 'post_type' ) {
        $val = null;

        $post = get_post( $id );

        if ( $post ) {
            $meta = get_post_meta( $id, '_g1', true );

            $meta = (array) $meta;
            if ( array_key_exists( $this->get_individual_setting_id(), $meta ) ) {
                $val = $meta[ $this->get_individual_setting_id() ];
            }
        }

        return $val;
    }


    public function get_post_type_single_value( $post ) {
        $val = $this->get_global_value( $post->post_type );

        if ( $post) {
            $temp = $this->get_individual_value( $post->ID );

            if ( strlen( $temp ) )
                $val = $temp;
        }

        $val = strlen( $val ) || $val === false ? $val : true;

        return $val;
    }
}

class G1_Single_Element_Author extends G1_Single_Element {
    public function has_post_type( $post_type ) {
        return true;
    }

    public function get_global_value( $name, $type = 'post_type' ) {
        if ( !post_type_supports( $name, 'author' ) ) {
            return false;
        }

        return parent::get_global_value( $name, $type );
    }

    public function get_individual_value( $id, $type = 'post_type' ) {
        $post_type = get_post_type( $id );

        if ( !post_type_supports( $post_type, 'author' ) ) {
            return false;
        }

        return parent::get_individual_value($id, $type);
    }
}

abstract class G1_Element_Manager {
    protected $elements;

    public function __construct() {
        $this->elements = array();

        $this->setup_hooks();
    }

    protected function setup_hooks() {
        // Register elements before the WP Customizer is ready
        add_action( 'wp_loaded',    array( $this, 'do_register' ), 4 );
    }

    abstract public function do_register();

    /**
     * Adds an element
     *
     * @param string $id
     * @param array $args
     */
    abstract public function add_element( $id, $args = array() );


    /**
     * Checks whether an element is available
     *
     * @param   string $id
     * @return  bool
     */
    public function has_element( $id ) {
        return isset( $this->elements[ $id ] ) ? true : false;
    }



    /**
     * Returns an element
     *                       collection
     * @param  string $id
     * @return G1_Collection_Element
     */
    public function get_element( $id ) {
        if ( !isset( $this->elements[ $id ] ) ) {
            return false;
        }

        return $this->elements[ $id ];
    }


    /**
     * Returns all elements
     *
     * @return arrat
     */
    public function get_elements() {
        return $this->elements;
    }

    /**
     * Returns an array of available element choices
     *
     * @return array
     */
    public function get_element_choices( $args = array() ) {
        $post_type = isset ( $args['post_type'] ) ? $args['post_type'] : 'any';

        $choices = array();
        foreach ( $this->elements as $id => $element ) {
            if ( 'any' === $post_type || $element->has_post_type( $post_type ) ) {
                $choices[ $id ] = $element->get_id();
            }
        }

        return $choices;
    }


    /**
     * Get elements available for specific post type
     *
     * @param string $post_type
     * @return array
     */
    public function get_post_type_elements( $post_type ) {
        $result = array();

        foreach ( $this->elements as $id => $element ) {
            if ( $element->has_post_type( $post_type ) ) {
                $result[ $id ] = $element;
            }
        }
        return $result;
    }

    public function get_default_values( $post_type ) {
        $result = array();
        foreach ( $this->get_elements() as $id => $element ) {
            $result[ $id ] = false;

            if ( $element->has_post_type( $post_type ) ) {
                $result[ $id ] = true;
            }
        }

        return $result;
    }
}

class G1_Collection_Element_Manager extends G1_Element_Manager {
    public function do_register() {
        $this->register_basic_elements();
        do_action( 'g1_collection_elements_register', $this );
        do_action( 'g1_collection_elements_init' );
    }


    /**
     * Adds an element
     *
     * @param string $id
     * @param array $args
     */
    public function add_element( $id, $args = array() ) {
        if ( is_a( $id, 'G1_Collection_Element' ) ) {
            $element = $id;
        } else {
            $element = new G1_Collection_Element( $id, $args );
        }

        $this->elements[ $element->get_id() ] = $element;
    }

    /**
     * Get elements available for specific taxonomy
     *
     * @param string $post_type
     * @return array
     */
    public function get_taxonomy_elements( $taxonomy ) {
        $result = array();

        $taxonomy_obj = get_taxonomy( $taxonomy );

        if ( ! $taxonomy_obj ) {
            return array();
        }

        foreach ( $this->elements as $id => $element ) {
            foreach ( $taxonomy_obj->object_type as $post_type ) {
                if ( $element->has_post_type( $post_type ) ) {
                    $result[ $id ] = $element;
                }
            }
        }
        return $result;
    }

    /**
     * Registers basic elements
     */
    protected function register_basic_elements() {
        // title
        $this->add_element( 'title', array(
            'label' => __( 'Title', 'g1_theme' ),
            'priority' => 220,
        ));

        // featured-media
        $this->add_element( 'featured-media', array(
            'label' => __( 'Featured Media', 'g1_theme' ),
            'priority' => 230,
        ));

        // date
        $this->add_element( 'date', array(
            'label' => __( 'Date', 'g1_theme' ),
            'priority' => 240,
        ));

        // author
        $this->add_element(new G1_Collection_Element_Author( 'author', array(
            'label' => __( 'Author', 'g1_theme' ),
            'priority' => 250,
        )));

        // comments-link
        $this->add_element( 'comments-link', array(
            'label' => __( 'Comments Link', 'g1_theme' ),
            'priority' => 260,
        ));

        // summary
        $this->add_element( 'summary', array(
            'label' => __( 'Summary', 'g1_theme' ),
            'priority' => 270,
        ));

        // categories
        $this->add_element( 'categories', array(
            'label' => __( 'Categories', 'g1_theme' ),
            'priority' => 280,
        ));

        // tags
        $this->add_element( 'tags', array(
            'label' => __( 'Tags', 'g1_theme' ),
            'priority' => 290,
        ));

        // button-1
        $this->add_element( 'button-1', array(
            'label' => __( 'Button 1', 'g1_theme' ),
            'priority' => 300,
        ));
    }


    public function get_post_type_archive_values() {
        $result = array();

        if ( is_home() ) {
            $post_type = 'post';
        } elseif ( is_post_type_archive() ) {
            $post_type = get_query_var( 'post_type' );
        }

        if ( ! empty( $post_type ) ) {
            foreach ( $this->get_elements() as $id => $element ) {
                $result[ $id ] = false;

                if ( $element->has_post_type( $post_type ) ) {
                    $val = $element->get_post_type_archive_value( $post_type );

                    $result[ $id ] = $val;
                } else {
                    $result[ $id ] = true;
                }
            }
        }

        return $result;
    }

    public function get_term_values( $term ) {
        $result = array();
        foreach( $this->get_elements() as $id => $element ) {
            $result[ $id ] = false;
        }

        foreach ( $this->get_taxonomy_elements( $term->taxonomy ) as $id => $element ) {
            $result[ $id ] = true;
            $val = $element->get_term_value( $term );
            $result[ $id ] = $val;
        }

        return $result;
    }
}

/**
 * Quasi-singleton for our manager
 *
 * @return G1_Collection_Element_Manager
 */
function G1_Collection_Element_Manager() {
    static $instance = null;

    if ( null === $instance ) {
        $instance = new G1_Collection_Element_Manager();
    }

    return $instance;
}
// Fire in the hole :)
G1_Collection_Element_Manager();




class G1_Single_Element_Manager extends G1_Element_Manager {
    public function do_register() {
        $this->register_basic_elements();
        do_action( 'g1_single_elements_register', $this );
        do_action( 'g1_single_elements_init' );
    }


    /**
     * Adds an element
     *
     * @param string $id
     * @param array $args
     */
    public function add_element( $id, $args = array() ) {
        if ( is_a( $id, 'G1_Single_Element' ) ) {
            $element = $id;
        } else {
            $element = new G1_Single_Element( $id, $args );
        }

        $this->elements[ $element->get_id() ] = $element;
    }

    /**
     * Registers basic elements
     */
    protected function register_basic_elements() {
        // sidebar-1
        $this->add_element( 'sidebar-1', array(
            'label' => __( 'Sidebar', 'g1_theme' ),
            'choices' => g1_sidebar_get_choices(),
            'priority' => 210,
        ));

        // breadcrumbs
        $this->add_element( 'breadcrumbs', array(
            'label' => __( 'Breadcrumbs', 'g1_theme' ),
            'priority' => 212,

        ));

        // title
        $this->add_element( 'title', array(
            'label' => __( 'Title', 'g1_theme' ),
            'priority' => 220,
        ));

        // featured-media
        $this->add_element( 'media-box', array(
            'label' => __( 'Media Box', 'g1_theme' ),
            'choices' => array(
                'list' => __( 'List', 'g1_theme' ),
                'featured-media' => __( 'Featured Media', 'g1_theme' ),
                'none' => __( 'None', 'g1_theme' ),
            ),
            'help' =>
                '<p>' . __( 'A media box is a part of a template, that displays entry attachments.', 'g1_theme' ) . '</p>' .
                '<p>' . __( 'The <strong>list</strong> displays image &amp; audio attachments.', 'g1_theme' ) . '</p>'.
                '<p>' . __( 'The <strong>slider</strong> displays only image attachments.', 'g1_theme' ) . '</p>'.
                '<p>' . __( 'The <strong>featured media</strong> displays featured image.', 'g1_theme' ) . '</p>'.
                '<p>' . __( 'The <strong>none</strong> displays nothing.', 'g1_theme' ) . '</p>',
            'priority' => 230,
        ));

        // date
        $this->add_element( 'date', array(
            'label' => __( 'Date', 'g1_theme' ),
            'priority' => 240,
        ));

        // author
        $this->add_element(new G1_Single_Element_Author( 'author', array(
            'label' => __( 'Author', 'g1_theme' ),
            'priority' => 250,
        )));

        // comments-link
        $this->add_element( 'comments-link', array(
            'label' => __( 'Comments Link', 'g1_theme' ),
            'priority' => 260,
        ));

        // categories
        $this->add_element( 'categories', array(
            'label' => __( 'Categories', 'g1_theme' ),
            'priority' => 280,
        ));

        // tags
        $this->add_element( 'tags', array(
            'label' => __( 'Tags', 'g1_theme' ),
            'priority' => 290,
        ));
    }


    public function get_single_values( $post_id = null ) {
        $result = array();

        if ( $post_id ) {
            $the_post = get_post( $post_id );
        } else {
            global $post;
            $the_post = $post;
        }

        foreach ( $this->get_elements() as $id => $element ) {
            $result[ $id ] = true;

            if ( $element->has_post_type( $the_post->post_type ) ) {
                $val = $element->get_post_type_single_value( $the_post );

                $result[ $id ] = $val;
            }
        }

        return $result;
    }
}
/**
 * Quasi-singleton for our manager
 *
 * @return G1_Single_Element_Manager
 */
function G1_Single_Element_Manager() {
    static $instance = null;

    if ( null === $instance ) {
        $instance = new G1_Single_Element_Manager();
    }

    return $instance;
}
// Fire in the hole :)
G1_Single_Element_Manager();



/**
 * Elements
 *
 */
class G1_Elements {
    /**
     * Replaces none values with false
     *
     * @param array $arr
     */
    protected function replace_none_values( $arr ) {
        foreach( $arr as $key => $value ) {
            if ( is_array( $value ) ) {
                $arr[ $key ] = $this->replace_none_values( $value );
            } elseif ( $value === 'none' ) {
                $arr[ $key ] = false;
            }
        }

        return $arr;
    }

    /**
     * Get elements of the current context
     *
     * @return array
     */
    public function get( $id = null ) {
        $elements = array();

        if ( is_singular() ) {
            $elements = G1_Single_Element_Manager()->get_single_values();
        } elseif( is_home() || is_post_type_archive() ) {
            $post_type = get_query_var('post_type');

            if ( empty($post_type) ) {
                $post_type = 'post';
            }

            $page_id = G1_Archive_Page_Feature()->get_page_id( $post_type );

            // WPML fallback
            if ( G1_WPML_LOADED ) {
                $page_id = absint( icl_object_id( $page_id, 'page', true ) );
            }

            if ( $page_id ) {
                $elements = G1_Single_Element_Manager()->get_single_values( $page_id );
            } else {
                $elements = G1_Single_Element_Manager()->get_default_values( 'page' );
            }

            $elements['collection'] = G1_Collection_Element_Manager()->get_post_type_archive_values();
        } elseif( is_archive() ) {
            $post_type = get_query_var( 'post_type' );
            if ( empty( $post_type ) ) {
                $post_type = 'post';
            }

            $elements = G1_Single_Element_Manager()->get_default_values( 'post' );

            $elements['collection'] = array();

            if ( is_date() || is_author() ) {
                $elements['collection'] = G1_Collection_Element_Manager()->get_default_values( 'post' );
            } elseif( is_category() ) {
                $taxonomy = 'category';
                $term = get_query_var( 'cat' );

                if ( is_numeric( $term ) ) {
                    $term_obj = get_term_by( 'id', $term, $taxonomy );
                } else {
                    $term_obj = get_term_by( 'slug', $term, $taxonomy );
                }

                $elements['sidebar-1'] = $this->get_sidebar($term_obj->term_taxonomy_id, 'category');

                if ( $term_obj ) {
                    $elements['collection'] = G1_Collection_Element_Manager()->get_term_values( $term_obj );
                } else {
                    $elements['collection'] = G1_Collection_Element_Manager()->get_default_values( 'post' );
                }
            } elseif( is_tag() ) {
                $taxonomy = 'post_tag';
                $term = get_query_var( 'tag' );

                if ( is_numeric( $term ) ) {
                    $term_obj = get_term_by( 'id', $term, $taxonomy );
                } else {
                    $term_obj = get_term_by( 'slug', $term, $taxonomy );
                }

                $elements['sidebar-1'] = $this->get_sidebar($term_obj->term_taxonomy_id, 'post_tag');

                if ( $term_obj ) {
                    $elements['collection'] = G1_Collection_Element_Manager()->get_term_values( $term_obj );
                } else {
                    $elements['collection'] = G1_Collection_Element_Manager()->get_default_values( 'post' );
                }
            } elseif ( is_tax() ) {
                $taxonomy = get_query_var('taxonomy');
                $term = get_query_var( 'term' );

                $term_obj = get_term_by( 'slug', $term, $taxonomy );
                if ( $term_obj ) {
                    $elements['sidebar-1'] = $this->get_sidebar($term_obj->term_taxonomy_id, $taxonomy);

                    $elements['collection'] = G1_Collection_Element_Manager()->get_term_values( $term_obj );
                }
            }
        }

        // Apply custom filter
        $elements = apply_filters( 'g1_get_elements', $elements );

        // Replace 'none' values with boolean false
        $elements = $this->replace_none_values( $elements );

        if ( null !== $id ) {
            if ( array_key_exists( $id, $elements ) ) {
                return $elements[ $id ];
            } else {
                return null;
            }
        } else {
            return $elements;
        }
    }

    protected function get_sidebar ($term_taxonomy_id, $taxonomy) {
        $sidebar = 'primary';

        $single_sidebar = $this->get_term_value($term_taxonomy_id, 'template_sidebar_1');

        if ($single_sidebar) {
            $sidebar = $single_sidebar;
        } else {
            $global_sidebar = $this->get_global_value('sidebar_1', $taxonomy, 'taxonomy');

            if ($global_sidebar) {
                $sidebar = $global_sidebar;
            }
        }

        return $sidebar;
    }

    public function get_global_value( $key, $name, $type = 'post_type' ) {
        $val = null;

        $val = g1_get_theme_option( $this->get_global_archive_id_base( $name, $type ), $key );

        return $val;
    }

    protected function get_global_archive_id_base( $name, $type = 'post_type' ) {
        $result = '';

        switch( $type ) {
            case 'post_type':
                $result = str_replace( '-', '_', $name );
                $result = 'post_type_' . $result;
                break;
            case 'taxonomy':
                $result = str_replace( '-', '_', $name );
                $result = 'taxonomy_' . $result;
                break;
        }

        return $result;
    }

    public function get_term_value( $term_taxonomy_id, $setting_id ) {
        $meta = (array) g1_get_term_meta( $term_taxonomy_id, '_g1' );

        $val = isset( $meta[ $setting_id ] ) ? $meta[ $setting_id ] : null;

        return $val;
    }
}
/**
 * Quasi-singleton for our G1_Elements
 *
 * @return G1_Elements
 */
function G1_Elements() {
    static $instance;

    if ( ! isset( $instance ) )
        $instance = new G1_Elements();

    return $instance;
}
// Fire in the hole :)
G1_Elements();