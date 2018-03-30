<?php
/**
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Framework
 * @subpackage G1_Shortcodes
 * @subpackage G1_Shortcodes 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php

/**
 * The Shortcode Generator
 *
 * @package 			G1_Framework
 * @subpackage 			G1_Shortcodes
 */
class G1_Shortcode_Generator {
    /**
     * Identificator
     * @var string
     */
    protected $id;

    /**
     * Icon
     * @var string
     */
    protected $icon;

    /**
     * Sections
     * @var array
     */
    protected $sections;


    /**
     * Priorities
     *
     * @var array
     */
    protected $priorities;

    /**
     * Items
     * @var array
     */
    protected $items;

    /**
     * Constructor
     */
    public function __construct( $id, $args ) {
        $this->set_id( $id );

        $this->sections = array();
        $this->priorities = array();
        $this->items = array();

        // icon argument
        if ( isset ( $args['icon'] ) ){
            $this->set_icon( $args['icon'] );
        } else {
            $this->set_icon( trailingslashit( G1_FRAMEWORK_URI ) . 'admin/images/icon_shortcode.png' );
        }

        $this->setup_hooks();
    }

    /**
     * Set up all hooks
     */
    protected function setup_hooks() {
        add_action( 'admin_enqueue_scripts', array( &$this, 'enqueue_admin_scripts' ) );

        add_filter( 'tiny_mce_version', array( &$this, 'increase_tinymce_version' ) );
        add_filter( 'mce_external_plugins', array( &$this, 'register_tinymce_plugin') );
        add_filter( 'mce_buttons', array( $this, 'add_tinymce_button'), 0);
        add_filter( 'admin_footer', array( &$this, 'render' ) );

        add_action( 'wp_loaded', array( $this, 'do_register' ) );
    }

    /**
     * Gets the id
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
     * Gets the icon
     */
    public function get_icon() {
        return $this->icon;
    }

    /**
     * Sets the icon
     */
    public function set_icon( $val ) {
        $this->icon = $val;
    }

    /**
     * Enables registration of section and items
     */
    public function do_register() {
        do_action( 'g1_shortcode_generator_register', $this );
    }


    /**
     * Checks whether a section exists
     *
     * @param       string $id
     * @return      bool
     */
    public function has_section( $id ) {
        return isset ( $this->sections[ $id ] );
    }

    /**
     * Adds a new section
     *
     * @param       string $id
     * @param       array $args
     */
    public function add_section( $id, $args = array() ) {
        if ( is_a( $id, 'G1_Shortcode_Generator_Section' ) )
            $section = $id;
        else
            $section = new G1_Shortcode_Generator_Section( $id, $args );


        $priority = isset( $args['priority'] ) ? (int) $args['priority'] : 100;

        if ( $section ) {
            $this->sections[ $section->get_id() ] = $section;
            $this->priorities[ $section->get_id() ] = $priority;
        }
    }

    /**
     * Gets a section
     *
     * @param       string $id
     * @return      G1_Shortcode_Generator_Section
     */
    public function get_section( $id ) {
        if ( $this->has_section( $id ) ) {
            return $this->sections[ $id ];
        }
    }


    /**
     * Removes a section
     *
     * @param           string $id
     */
    public function remove_section( $id ) {
        if ( $this->has_section( $id ) ) {
            unset( $this->sections[ $id ] );
            unset( $this->priorities[ $id ] );
        }
    }


    /**
     * Gets all sections
     *
     * @return array
     */
    public function get_sections() {
        $this->sort_priorities();

        $result = array();
        foreach ( $this->priorities as $section_id => $priority ) {
            $result[ $section_id ] = $this->sections[ $section_id ];
        }

        return $result;
    }


    protected function sort_priorities() {
        asort( $this->priorities, SORT_NUMERIC );
    }




    public function has_item( $id ) {
        return isset( $this->items[ $id ] );
    }


    /**
     * Adds a new item
     *
     * @todo Check if item exists?
     *
     * @param $id
     */
    public function add_item(G1_Shortcode $shortcode, $section) {
        if ( !$this->has_section( $section ) ) {
            return;
        }

        $item = new G1_Shortcode_Generator_Item( $shortcode );
        $section = $this->get_section( $section );
        $section->add_item( $item );

        // Save the reference
        $this->items[ $item->get_id() ] = $item;
    }




    public function add_snippet( $id, $args ) {
        $section = isset( $args['section'] ) ? $args['section'] : 'basic';

        if ( $this->has_section( $section ) ) {
            $section = $this->get_section( $section );

            if ( is_a( $id, 'G1_Short_Generator_Snippet' ) ) {
                $snippet = $id;
            } else {
                $snippet = new G1_Shortcode_Generator_Snippet( $id, $args );
            }

            if ( $snippet ) {
                $priority = isset( $args['priority'] ) ? (int) $args['priority'] : 10;

                $this->items[ $snippet->get_id() ] = $snippet;
                $section->add_item( $snippet, $priority );
            }
        }
    }

    /**
     * Gets an item
     *
     * @param       string $id
     * @return      G1_Shortcode_Generator
     */
    public function get_item( $id ) {
        if ( $this->has_item( $id ) ) {
            return $this->items[ $id ];
        }
    }


    /**
     * Enqueues javascripts
     */
    public function enqueue_admin_scripts() {
        wp_register_script(
            'g1_shortcode_generator',
            trailingslashit( G1_FRAMEWORK_URI ). 'admin/js/g1-shortgen.js',
            array( 'jquery' )
        );

        wp_enqueue_script( 'g1_shortcode_generator' );
    }

    /**
     * Increases version number to prevent caching
     *
     * @param 			int $version
     * @return			int
     */
    public function increase_tinymce_version( $version ) {
        return ++$version;
    }



    /**
     * Adds shortcode generator button to TinyMCE visual editor
     *
     * @param 			array $buttons
     * @return			array
     */
    public function add_tinymce_button( $buttons ) {
        $buttons[] = 'separator';
        $buttons[] = 'separator';

        $buttons[]  = esc_attr( $this->get_id() );

        $buttons[] = 'separator';
        $buttons[] = 'separator';

        return $buttons;
    }

    /**
     * Registers shortcode generator as TinyMCE plugin
     *
     * @param 			array $plugin_array
     * @return			array
     */
    public function register_tinymce_plugin( $plugin_array ) {
        $plugin_array[ $this->get_id() ] = trailingslashit( G1_FRAMEWORK_URI ) . 'admin/js/tinymce-plugin-shortgen.js';

        return $plugin_array;
    }



    /**
     * Captures the UI for the Shortcode Generator
     *
     * @return			string
     */
    public function capture() {
        /* Sort items before capturing */
        //$this->sort();

        $out = '';

        $out .= '<div id="' . esc_attr( $this->get_id() ) . '">' .
            '<div class="g1-shortcode-generator">' .
            '<h1>' .
            '<img src="' . esc_attr( $this->get_icon() ) . '" alt="'. esc_attr( $this->get_icon() ) .'" />' .
            '</h1>' .
            $this->capture_viewport() .
            $this->capture_actions() .
            '</div><!-- .g1-shortcode-generator -->' .
            '</div>';

        return $out;
    }
    public function render() {
        echo $this->capture();
    }



    /**
     * Captures the viewport section of the Shortcode Generator
     *
     * @return			string
     */
    protected function capture_viewport() {
        $out = '';
        $out .= '<div class="g1-viewport">';

        foreach( $this->get_sections() as $section_id => $section ) {
            $out .= $section->capture();
        }

        $out .= '</div><!-- .g1-viewport -->';

        return $out;
    }



    /**
     * Captures the actions section of the Shortcode Generator
     *
     * @return			string
     */
    protected function capture_actions() {
        $out =  '<div class="g1-actions">' .
            '<a href="" class="button-secondary">' . __('Insert', 'g1_theme') . '</a>' .
            '</div>';

        return $out;
    }
}

function G1_Shortcode_Generator() {
    static $instance;

    if (!isset($instance)) {
        $instance = new G1_Shortcode_Generator( 'g1_shortcode_manager', array() );
    }

    return $instance;
}

G1_Shortcode_Generator();



/**
 * @todo description
 */
class G1_Shortcode_Generator_Section {
    protected $id;
    protected $label;
    protected $items;

    /**
     * Constructor
     */
    public function __construct( $id, $args ) {
        $this->set_id( $id );

        // label argument
        $this->set_label( isset( $args['label'] ) ? $args['label'] : $id );

        $this->items = array();
    }

    /**
     * Gets the id
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
     * Gets the label
     */
    public function get_label() {
        return $this->label;
    }

    /**
     * Sets the label
     */
    public function set_label( $val ) {
        $this->label = $val;
    }


    /**
     * Checks whether an item exists
     *
     * @param       string $id
     * @return      bool
     */
    public function has_item( $id ) {
        return isset ( $this->items[ $id ] );
    }

    /**
     * Adds an item
     *
     * @todo Check if item exists?
     */
    public function add_item( $item ) {
        $this->items[ $item->get_id() ] = $item;
    }

    /**
     * Removes an item
     *
     * @param       string $id
     */
    public function remove_item( $id ) {
        if ( $this->has_item( $id ) ) {
            unset( $this->items[ $id ] );
        }
    }


    /**
     * Gets all items
     *
     * @return      array
     */
    public function get_items() {
        return $this->items;
    }


    /**
     * Captures the HTML code
     */
    public function capture() {
        $out = '';

        foreach ( $this->get_items() as $item ) {
            $out .= $item->capture();
        }

        $out = '<div class="g1-shortcode-generator-section">' .
            '<h3>' . $this->get_label() . '</h3>' .
            '<div class="g1-shortcode-generator-items">' .
            $out .
            '</div>' .
            '</div>';

        return $out;
    }
    public function render() {
        echo $this->capture();
    }
}




/**
 * @todo description
 */
class G1_Shortcode_Generator_Item {
    private $shortcode;

    public function __construct( G1_Shortcode $shortcode ) {
        $this->shortcode = $shortcode;
    }

    public function get_id() {
        return $this->shortcode->get_id();
    }

    /**
     * @return G1_Shortcode
     */
    protected  function get_shortcode() {
        return $this->shortcode;
    }

    /**
     * Captures the HTML code
     *
     * @return      string
     */
    public function capture() {
        $out = '';

        $out .= '<div class="g1-viewport-item">' .
            '<div class="g1-shortcode">' .
            '<div class="g1-shortcode-meta">' .
            '<input type="hidden" name="display" value="' . esc_attr( $this->get_shortcode()->get_type() ) . '"/>' .
            '<input type="hidden" name="id" value="' . esc_attr( $this->get_shortcode()->get_id() ) . '"/>' .
            '</div>' .
            '<h2>' . esc_html( $this->get_shortcode()->get_label() ) . '</h2>' .
            $this->capture_help() .
            $this->capture_attributes() .
            $this->capture_content() .
            '</div>' .
            '</div>';

        return $out;
    }

    public function render() {
        echo $this->capture();
    }

    /**
     * Captures the HTML with the help
     *
     * @return          string
     */
    public function capture_help() {
        $help = $this->get_shortcode()->get_help();

        $out = '';

        if ( strlen( $help ) ) {
            $out .= '<div class="g1-shortcode-help">'. $help .'</div>';
        }

        return $out;
    }

    /**
     * Captures the HTML code of all attributes
     *
     * @return          string
     */
    public function capture_attributes() {
        $out = '';
        $out .= '<div class="g1-shortcode-attributes">';

        // Capture each attribute
        foreach( $this->get_shortcode()->get_attributes() as $attribute_id => $attribute ) {
            $form_control = G1_Form_Control_Factory::create_form_control_from_attribute($attribute);

            $out .= $form_control->capture();
        }

        $out .= '</div>';

        return $out;
    }

    /**
     * Captures the HTML code of the content
     *
     * @return          string
     */
    public function capture_content() {
        $content = $this->get_shortcode()->get_content();

        $out = '';

        if ( $content ) {
            $control = G1_Form_Control_Factory::create_form_control_from_attribute($content);

            $out .= '<div class="g1-shortcode-content">'. $control->capture() .'</div>';
        }

        return $out;
    }
}


/**
 * @todo description
 */
class G1_Shortcode_Generator_Snippet {
    protected $id;
    protected $label;
    protected $result;

    public function __construct( $id, $args ) {
        $this->set_id( $id );

        // result
        $this->set_result( $args['result'] );

        // label argument
        $this->set_label( isset($args['label']) ? $args['label'] : $this->get_id() );
    }

    public function set_id( $val ) {
        $this->id = $val;
    }

    public function get_id() {
        return $this->id;
    }

    public function set_label( $val ) {
        $this->label = $val;
    }

    public function get_label() {
        return $this->label;
    }

    public function set_result( $val ) {
        $this->result = $val;
    }

    public function get_result() {
        return $this->result;
    }

    /**
     * Captures the HTML code
     *
     * @return string
     */
    public function capture() {
        $out =  '<div class="g1-viewport-item">' .
            '<div class="g1-shortcode">' .
            '<div class="g1-shortcode-meta">' .
            '<input type="hidden" name="display" value="block"/>' .
            '<input type="hidden" name="id" value="'. esc_attr( $this->get_id() ) .'"/>' .
            '</div>' .
            '<h2>' . esc_html( $this->get_label()  ) . '</h2>' .
            '<div class="g1-shortcode-result">' .
            '<textarea>'. esc_textarea( $this->get_result() ) . '</textarea>' .
            '</div>' .
            '</div>' .
            '</div>';

        return $out;
    }

    public function render() {
        echo $this->capture();
    }
}