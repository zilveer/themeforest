<?php
/**
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Framework
 * @subpackage G1_Shortcodes
 * @since G1_Shortcodes 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php

abstract class G1_Shortcode {
    private $id;
    private $type;
    private $help;
    private $result;

    /**
     * ID Aliases
     *
     * Improves usability (you can use my_shortcode or myshortcode)
     *
     * Allows to nest shortcodes (_my_shortcode inside my_shortcode)
     *
     * @var array
     */
    private $id_aliases;

    private $attributes;
    private $content;

    private $label;

    private $counter;

    private $attributes_loaded;


    public function __construct( $id, $args = array() ) {
        $this->set_id( $id );
        $this->set_type( isset( $args['type'] ) ? $args['type'] : 'block' );

        if ( isset ( $args['label'] ) ) {
            $label = $args['label'];
        } else {
            $label = ucfirst( $this->get_id() );
            $label = str_replace('_', ' ', $label);
        }

        $this->set_label( $label );
        $this->set_help( isset( $args['help'] ) ? $args['help'] : '' );
        $this->set_result( isset( $args['result'] ) ? $args['result'] : '' );
        $this->set_description( isset ( $args['description'] ) ? $args['description'] : '' );

        $this->set_id_aliases( isset( $args['id_aliases'] ) ? $args['id_aliases'] : array() );

        $this->attributes = array();
        $this->attributes_loaded = false;
        $this->content = null;

        $this->init();
    }

    public function init() {
        // Register shortcode
        add_shortcode( $this->get_id(), array( $this, 'shortcode' ) );

        // Register shortcode under different aliases
        foreach ( $this->get_id_aliases() as $id_alias ) {
            add_shortcode( $id_alias, array( $this, 'shortcode' ) );
        }

        $this->setup_hooks();

        // Add standard attributes
        $this->add_id_attribute();
        $this->add_class_attribute();
    }


    public function setup_hooks() {
    }

    public function reset() {
        foreach ( $this->get_attributes() as $attribute ) {
           $attribute->set_value( $attribute->get_default() );
        }

        if ( $this->has_content() ) {
            $this->get_content()->set_value( null );
        }
    }

    public function validate() {

    }

    /**
     * @param G1_Shortcode_Attribute array $defined_attributes
     * @param array $passed_attributes
     * @return string
     */
    protected function capture_attributes_warnings($defined_attributes, $passed_attributes = array()) {
        $warnings = array();

        $available_attribute_names = array();

        foreach ( $defined_attributes as $defined_attribute ) {
            $available_attribute_names[] = $defined_attribute->get_id();

            $available_attribute_names = array_merge($available_attribute_names, $defined_attribute->get_id_aliases());
        }

        if ( is_array($passed_attributes) ) {
            foreach ($passed_attributes as $id => $value) {
                if ( !in_array($id, $available_attribute_names) ) {
                    $helpmode = new G1_Helpmode(
                        'wrong_shortcode_attribute',
                        __( 'Wrong shortcode attribute:', 'g1_theme' ) . ' ' . $id,
                        sprintf( __( 'Shortcode "%s" has no "%s" attribute', 'g1_theme' ), $this->get_id(), $id ),
                        'error'
                    );

                    $warnings[] = $helpmode->capture();
                }
            }
        }

        return implode('', $warnings);
    }


    /**
     * Extract attributes and content
     *
     * @return array
     */
    public function extract() {
        $result = array();

        foreach ( $this->get_attributes() as $attribute ) {
            $result[ $attribute->get_id() ] = $attribute->get_value();
        }

        $result[ 'content' ] = null;
        if ( $this->has_content() ) {
            $result[ 'content' ] = $this->get_content()->get_value();
        }

        return $result;
    }


    /**
     * Shortcode callback
     *
     * @param array $atts
     * @param string $content
     */
    public function shortcode( $atts, $content = null ) {
        // Count the number of calls
        $this->increment_counter();

        // Reset
        $this->reset();

        if ( null !== $content && $this->has_content() ) {
            $obj = $this->get_content();

            $obj->set_value( preg_replace('#^<\/p>|<p>$#', '', $content ) );
        }

        if ( !empty($atts['doc']) ) {
            return new G1_Shortcode_Doc($this, $atts['doc']);
        }

        // Bind
        foreach ( $this->get_attributes() as $sttribute_id => $attribute ) {
            $attribute->bind( $atts );
        }

        // Validate
        $this->validate();

        $out = $this->capture_attributes_warnings($this->get_attributes(), $atts);

        // Process
        $out .= $this->do_shortcode( $atts, $content );

        return $out;
    }

    abstract protected function do_shortcode();

    protected function load_attributes() {}

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
     *
     * @param string
     */
    public function set_id( $val ) {
        $this->id = $val;
    }

    public function get_type() {
        return $this->type;
    }

    public function set_type($type) {
        $this->type = $type;
    }

    public function get_help() {
        return $this->help;
    }

    public function set_help($help) {
        $this->help = $help;
    }

    public function get_result() {
        return $this->result;
    }

    public function set_result($result) {
        $this->result = $result;
    }

    /*
     * Gets the label
     *
     * @return string
     */
    public function get_label() {
        return $this->label;
    }

    /**
     * Sets the label
     *
     * @param string
     */
    public function set_label( $val ) {
        $this->label = $val;
    }

    /*
     * Gets the description
     *
     * @return string
     */
    public function get_description() {
        return $this->description;
    }

    /**
     * Sets the description
     *
     * @param string
     */
    public function set_description( $val ) {
        $this->description = $val;
    }



    /**
     * Gets the counter
     *
     * @return      string
     */
    public function get_counter() {
        return $this->counter;
    }

    /**
     * Increments the counter
     */
    public function increment_counter() {
        $this->counter++;
    }


    public function has_attribute( $id ) {
        $this->load_attributes_if_not_loaded();

        return array_key_exists( $id, $this->attributes );
    }



    public function add_attribute( $id, $args ) {
        if ( is_a( $id, 'G1_Shortcode_Attribute' ) ) {
            $attribute = $id;
        } else {
            $attribute = new G1_Shortcode_Attribute( $id, $args );
        }

        $this->attributes[ $attribute->get_id() ] = $attribute;
    }


    /**
     * Adds the id (HTML) attribute
     */
    public function add_id_attribute() {
        $this->attributes[ 'id' ] = new G1_Shortcode_Attribute( 'id', array(
            'form_control'  => 'Text',
            'hint'			=>
            __( 'The id attribute specifies an id for an HTML element.', 'g1_theme' ) . '<br />' .
                __( 'It must be unique within the HTML document.', 'g1_theme' ) . '<br />' .
                __( '(Mainly for additional styling/scripting purposes)', 'g1_theme' ),
        ));
    }

    /**
     * Adds the class (HTML) attribute
     */
    public function add_class_attribute() {
        $this->attributes[ 'class' ] = new G1_Shortcode_Attribute( 'class', array(
            'form_control'  => 'Text',
            'hint'			=>
            __( 'The class attribute specifies a class name for an HTML element.', 'g1_theme' ) . '<br />' .
                __( '(Mainly for additional styling/scripting purposes)', 'g1_theme' ),
        ));
    }

    /**
     * Gets an attribute
     *
     * @param string $id
     * @return G1_Shortcode_Attribute
     */
    public function get_attribute( $id ) {
        $this->load_attributes_if_not_loaded();

        return $this->attributes[ $id ];
    }

    /**
     * Checks whether there are attributes
     *
     * @return bool
     */
    public function has_attributes() {
        $this->load_attributes_if_not_loaded();

        return count( $this->attributes );
    }

    /**
     * Gets all attributes
     */
    public function get_attributes() {
        $this->load_attributes_if_not_loaded();

        return $this->attributes;
    }

    protected function load_attributes_if_not_loaded () {
        if ( !$this->attributes_loaded ) {
            $this->load_attributes();
            $this->attributes_loaded = true;
        }
    }

    /**
     * Gets id aliases
     */
    public function get_id_aliases() {
        return $this->id_aliases;
    }


    /**
     * Sets id aliases
     */
    public function set_id_aliases( $id_aliases ) {
        $this->id_aliases = $id_aliases;
    }


    public function has_content() {
        return ( null !== $this->content );
    }


    public function set_content( $id = 'content', $args = array() ) {
        if ( is_a( $id, 'G1_Shortcode_Attribute' ) ) {
            $attribute = $id;
        } else {
            $attribute = new G1_Shortcode_Attribute( $id, $args );
        }

        $this->content = $attribute;
    }

    /**
     * Gets the content
     *
     * @return G1_Shortcode_Attribute
     */
    public function get_content() {
        return $this->content;
    }

    /**
     * Comoposes the shortcode
     *
     * @param array $atts
     */
    public function compose( $atts = array(), $content = null ) {
        $out = '[' . $this->get_id() . ' ';

        // Attach attributes
        foreach ( $this->get_attributes() as $attribute_id => $attribute ) {
            if ( isset( $atts[ $attribute_id ] ) )
                $out .= $attribute_id . '="' . esc_attr( $atts[ $attribute_id ] ) . '" ';
        };

        trim( $out );

        $out .= ']';

        if (!is_null($content)) {
            $out .= $content;
            $out .= '[/' . $this->get_id() . ']';
        }

        return $out;
    }
}

class G1_Shortcode_Doc {
    private $shortcode;
    private $type;

    public function __construct ( G1_Shortcode $shortcode, $type ) {
        $this->shortcode = $shortcode;
        $this->type = $type;
    }

    public function __toString () {
        return $this->capture();
    }

    /**
     * return string
     */
    public function capture () {
        $out = '';

        $out .= sprintf('<ul class="g1-sc-doc__attributes">%s</ul>', $this->capture_attributes());

        $out = sprintf('<div class="g1-sc-doc">%s</div>', $out);

        return $out;
    }

    public function render () {
        return $this->capture();
    }

    protected function capture_attributes () {
        $out = '';

        foreach ( $this->shortcode->get_attributes() as $attribute ) {
            $out .= $this->capture_attribute($attribute);
        }

        return $out;
    }

    protected function capture_attribute ( G1_Shortcode_Attribute $attribute ) {
        $out = '';

        $name = $attribute->get_label();

        if ( empty($name) ) {
            $name = $attribute->get_id();
        }

        $out .= sprintf('<div class="g1-name">%s</div>', $name);

        $out .= '<div class="g1-description">';

        $hint = $attribute->get_hint();
        if ( strlen($hint) > 0 ) {
            $out .= sprintf('<div class="g1-hint">%s</div>', $attribute->get_hint());
        }

        $help = $attribute->get_help();
        if ( strlen($help) > 0 ) {
            $out .= sprintf('<div class="g1-help">%s</div>', $attribute->get_help());
        }

        if ( $attribute->get_form_control() === 'Choice' ) {
            if ( $attribute->get_id() === 'icon' ) {
                $out .= sprintf('<div class="g1-options-label">%s:</div>', __('Available Options', 'g1_theme'));

                $out .= sprintf('<div>All icons available on <a href="%s">Font Awesome</a> site</div>', 'http://fortawesome.github.io/Font-Awesome/icons/');
            } else {
                $choices = $attribute->get_attr_by_name('choices');

                if ( !empty($choices) ) {
                    $out .= sprintf('<div class="g1-options-label">%s:</div>', __('Available Options', 'g1_theme'));

                    $out .= '<ul class="g1-options">';

                    foreach ( $choices as $key => $value ) {
                        if ( strtolower($key) !== strtolower($value) ) {
                            $out .= sprintf('<li><span>%s</span> - %s</li>', $key, $value);
                        } else {
                            $out .= sprintf('<li><span>%s</span></li>', $key);
                        }


                    }

                    $out .= '</ul>';
                }
            }
        }

        $out .= '</div>';

        $out = sprintf('<li class="g1-sc-doc__attribute">%s</li>', $out);

        return $out;
    }


}

class G1_Shortcode_Attribute {
    protected $id;
    protected $value;
    protected $default;
    protected $label;
    protected $hint;
    protected $help;
    protected $translate;
    protected $form_control;

    private $args;

    /**
     * Is required?
     *
     * @var bool
     */
    protected $required;


    /**
     * Aliases for the id
     *
     * @var array
     */
    protected $id_aliases;


    /**
     * Aliases for the value
     *
     * @var array
     */

    protected $value_aliases;

    public function __construct( $id, $args ) {
        $this->args = $args;
        $this->set_id( $id );

        $this->id_aliases = isset( $args['id_aliases'] ) ? $args['id_aliases'] : array();
        $this->value_aliases = isset( $args['value_aliases'] ) ? $args['value_aliases'] : array();

        // required argument
        $this->set_required( isset( $args['required'] ) ? $args['required'] : false );

        $this->set_default( isset( $args['default'] ) ? $args['default'] : '' );

        $this->set_label( isset( $args['label'] ) ? $args['label'] : $this->get_id() );

        $this->set_hint( isset( $args['hint'] ) ? $args['hint'] : '' );
        $this->set_help( isset( $args['help'] ) ? $args['help'] : '' );

        $this->set_translate( isset( $args['translate'] ) ? $args['translate'] : false );

        $this->set_form_control( isset( $args['form_control'] ) ? $args['form_control'] : 'Text' );
    }

    public function get_attr_by_name( $name ) {
        if ( 'choices' === $name ) {
            if ( isset( $this->args['choices_cb'] ) && is_callable( $this->args['choices_cb'] ) ) {
                return call_user_func( $this->args['choices_cb'] );
            }
        }

        if (isset( $this->args[$name] )) {
            return $this->args[$name];
        }

        return null;
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
     *
     * @param  string
     */
    public function set_id( $val ) {
        $this->id = $val;
    }

    /**
     * Gets the required
     *
     * @return bool
     */
    public function get_required() {
        return $this->required;
    }

    /**
     * Sets the required
     *
     * @param  bool
     */
    public function set_required( $val ) {
        $this->required = (bool) $val;
    }

    /**
     * Gets the value
     *
     * @return string
     */
    public function get_value() {
        return $this->value;
    }

    /**
     * Sets the value
     *
     * @param string
     */
    public function set_value( $val ) {
        // Normalize value
        if ( array_key_exists( $val, $this->value_aliases ) ) {
            $val = $this->value_aliases[ $val ];
        }

        $this->value = $val;
    }

    /**
     * Gets the default
     *
     * @return string
     */
    public function get_default() {
        return $this->default;
    }

    /**
     * Sets the value
     *
     * @param string
     */
    public function set_default( $val ) {
        $this->default = $val;
    }


    /**
     * Gets the label
     *
     * @return string
     */
    public function get_label() {
        return $this->label;
    }

    /**
     * Sets the label
     *
     * @param string
     */
    public function set_label( $val ) {
        $this->label = $val;
    }

    /**
     * Gets the hint
     *
     * @return string
     */
    public function get_hint() {
        return $this->hint;
    }

    /**
     * Sets the hint
     *
     * @param string
     */
    public function set_hint( $val ) {
        $this->hint = $val;
    }

    public function get_help() {
        return $this->help;
    }

    public function set_help( $help ) {
        $this->help = $help;
    }

    public function get_translate() {
        return $this->translate;
    }

    public function set_translate( $translate ) {
        $this->translate = $translate;
    }

    public function get_form_control() {
        return $this->form_control;
    }

    public function set_form_control($form_control) {
        $this->form_control = $form_control;
    }

    public function get_id_aliases() {
        return $this->id_aliases;
    }

    public function set_id_aliases( $id_aliases ) {
        $this->id_aliases = $id_aliases;
    }

    /**
     * Binds our attribute
     *
     * @param array $atts
     */
    public function bind( $atts ) {
        $atts = (array) $atts;

        if ( array_key_exists( $this->get_id(), $atts ) ) {
            $this->set_value( $atts[ $this->get_id() ] );

            return;
        } else {
            foreach ( $this->id_aliases as $alias) {
                if ( array_key_exists( $alias, $atts ) ) {
                    $this->set_value( $atts[ $alias ] );

                    return;
                }
            }
        }
    }
}



/**
 * Abstract representation of a widget based on a shortcode
 *
 * @package G1_Framework
 * @subpackage G1_Shortcodes
 */
abstract class G1_Shortcode_Widget extends WP_Widget {
    protected $shortcode;

    public function __construct() {
        add_action( 'wp_loaded', array( $this, 'setup_shortcode' ) );

        // Widget settings.
        $widget_ops = array(
            'description' => '',
        );

        // Widget control settings.
        $control_ops = array(
            'width' => 300,
            'height' => 350,
        );

        // Create the widget.
        parent::__construct(
            $this->get_id_base(),
            $this->get_name(),
            $widget_ops,
            $control_ops
        );
    }

    abstract public function setup_shortcode();

    abstract public function get_id_base();
    abstract public function get_name();

    /**
     *  Renders the widget
     */
    function widget( $args, $instance ) {
        extract( $args );

        $base_id = $this->get_id_base();

        // User-selected settings.
        $title = apply_filters( 'widget_title', $instance['widget_title'] );

        // translate title
        if ( function_exists('icl_translate') ) {
            $title = icl_translate( 'G1 Widgets', $base_id . ' - title', $title );
        }

        // Title of widget (before and after defined by themes)
        if ( $title ) {
            $title = $before_title . $title . $after_title;
        }

        $content = null;
        if ($this->shortcode->has_content()) {
            $content = $instance[$this->shortcode->get_content()->get_id()];

            // translate content
            if ( function_exists('icl_translate') ) {
                $content = icl_translate( 'G1 Widgets', $base_id . ' - content', $content );
            }
        }

        // translate attributes
        foreach ( $this->shortcode->get_attributes() as $attribute_id => $attribute ) {
            if ( $attribute->get_translate() && function_exists('icl_translate') ) {
                if ( isset( $instance[ $attribute_id ] ) ) {
                    $instance[ $attribute_id ] = icl_translate( 'G1 Widgets', $base_id . ' - ' . $attribute_id, $instance[ $attribute_id ] );
                }
            }
        }

        // Compose output
        $out = $before_widget .
                    $title .
                    do_shortcode( $this->shortcode->compose( $instance, $content ) ) .
                $after_widget;

        // Render
        echo $out;
    }


    /**
     * Updates the widget configuration
     */
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        // Filter input data
        $instance['widget_title'] = strip_tags( $new_instance['widget_title'] );

        // Process attributes
        foreach ( $this->shortcode->get_attributes() as $attribute_id => $attribute ) {
            // Skip id and class attributes
            if ( in_array($attribute_id, array( 'id', 'class' ) ) )
                continue;

            $instance[ $attribute_id ] = strip_tags( $new_instance[ $attribute_id ] );
        }

        if ( $this->shortcode->has_content() ) {
            $attribute = $this->shortcode->get_content();

            $instance[ $attribute->get_id() ] = strip_tags( $new_instance[ $attribute->get_id() ] );
        }

        return $instance;
    }

    /**
     * Displays the widget form
     */
    function form( $instance ) {
        if (!$this->shortcode) {
            return '';
        }

        $base_id = $this->get_id_base();

        // Set up some default widget settings.
        $defaults = array();
        foreach ( $this->shortcode->get_attributes() as $attribute ) {
            $defaults[ $attribute->get_id() ] = $attribute->get_default();
        }

        $defaults['widget_title'] = $this->shortcode->get_label();
        $instance = wp_parse_args( (array) $instance, $defaults );

        echo '<ul class="g1-form-controls">';

        $form_control = G1_Form_Control_Factory::create( $this->get_field_id( 'widget_title' ), array(
            'label' => __( 'Widget title', 'g1_theme' ),
            'name' => $this->get_field_name( 'widget_title' ),
            'value' => $instance['widget_title'],
        ));
        $form_control->render();

        if ( function_exists('icl_register_string') ) {
            icl_register_string( 'G1 Widgets', $base_id . ' - title', $instance['widget_title'] );
        }

        foreach ( $this->shortcode->get_attributes() as $attribute_id => $attribute ) {
            // Skip id and class attributes
            if ( in_array($attribute_id, array( 'id', 'class' ) ) )
                continue;

            if ( $attribute->get_translate() && function_exists('icl_register_string') ) {
                icl_register_string( 'G1 Widgets', $base_id . ' - ' . $attribute_id, $instance[ $attribute_id ] );
            }

            $attribute = clone $attribute;
            $form_control = G1_Form_Control_Factory::create_form_control_from_attribute($attribute);

            $form_control->set_id( $this->get_field_id( $attribute->get_id() ) );
            $form_control->set_name( $this->get_field_name( $attribute->get_id() ) );
            $form_control->set_value( $instance[ $attribute->get_id() ] );

            $form_control->render();
        }

        if ( $this->shortcode->has_content() ) {
            $attribute = $this->shortcode->get_content();
            $value = !empty($instance[ $attribute->get_id() ]) ? $instance[ $attribute->get_id() ] : '';

            if ( function_exists('icl_register_string') ) {
                icl_register_string( 'G1 Widgets', $base_id . ' - content', $value );
            }

            $form_control = G1_Form_Control_Factory::create_form_control_from_attribute($attribute);

            $form_control->set_id( $this->get_field_id( $attribute->get_id() ) );
            $form_control->set_name( $this->get_field_name( $attribute->get_id() ) );
            $form_control->set_value( $value );

            $form_control->render();
        }

        echo '</ul>';
    }
}



abstract class G1_Collection_Shortcode_Widget extends G1_Shortcode_Widget {
    public function __construct() {
        parent::__construct();

        //$this->set_details();
        //add_action( 'init', array( $this, 'set_details' ), 9999 );


    }

    public function set_details() {
        //$this->name = $this->shortcode->get_label();
        //$this->widget_options['description'] = $this->shortcode->get_label();
    }
}





abstract class G1_Collection_Shortcode extends G1_Shortcode {
    protected $post_type;

    public function __construct( $id, $args ) {
        parent::__construct( $id, $args );
        $this->set_post_type( $args['post_type'] );
    }

    public function set_post_type( $val) { $this->post_type = $val; }
    public function get_post_type() { return $this->post_type; }

    public function setup_hooks() {
        parent::setup_hooks();

        add_action( 'init', array( $this, 'set_details'), 9999 );

        add_action( 'wp_loaded', array( $this, 'add_special_attributes' ), 9999 );

        add_action( 'g1_shortcode_generator_register', array( $this, 'add_shortcode_generator_item' ) );
    }


    /**
     * Add shortcode to the global shortcode generator
     *
     * @param G1_Shortcode_Generator $generator
     */
    public function add_shortcode_generator_item( $generator ) {
        $generator->add_item( $this, 'post_type_' . $this->get_post_type() );
    }

    public function add_special_attributes() {
        // template
        $this->add_attribute( 'template', array(
            'form_control'  => 'Choice',
            'choices'	    =>
            G1_Collection_Manager()
                ->get_collection_choices( array( 'post_type' => $this->get_post_type() ) ),
        ));

        $this->add_attribute( 'effect', array(
            'form_control'  => 'Choice',
            'choices'		=> array(
                'none'      => __( 'none', 'g1_theme' ),
                'grayscale' => __( 'grayscale', 'g1_theme' ),
            ),
        ));

        $elements = G1_Collection_Element_Manager()->get_default_values( $this->get_post_type() );
        $elements = array_filter( $elements );

        foreach ( $elements as $key => $value ) {
            $elements[ $key ] = $key;
        }

        // hide
        $this->add_attribute( 'hide', array(
            'form_control'	=> 'Multichoice_Text',
            'id_aliases' => array(
                'hide_elements',
                'hide-elements',
            ),
            'elements'      => $elements,
            //'help' 			=> __('<p>You can hide following elements:</p><ul><li>title</li><li>featured_media</li><li>date</li><li>comments_link</li><li>summary</li><li>categories</li><li>tags</li><li>button_1</li></ul>', 'g1_theme'),
            //'hint' 			=> __('Comma separated list of elements to hide', 'g1_theme'),
        ));
    }


    public function add_max_attribute() {
        $this->add_attribute( 'max', array(
            'form_control'	=> 'Text',
            'id_aliases' => array(
                'maximum',
            ),
            'hint'		    => __( 'Maximum items to display', 'g1_theme' ),
        ));
    }

    /**
     * Shortcode callback function.
     *
     * @return string
     */
    protected function do_shortcode() {
        $default_template = key( G1_Collection_Manager()->get_collection_choices( array( 'post_type' => $this->get_post_type() ) ) );

        extract( $this->extract() );

        if ( !strlen( $template ) ) {
            $template = $default_template;
        }

        $lightbox_group	= 'g1-custom-posts-lightbox';

        $out = '';
        $final_id = 'g1-custom-posts-shortcode-' . $this->get_counter();
        $final_class = array(
            'g1-collection-' . $this->get_id(),
            'g1-custom-posts-shortcode',
            'g1-shortcode',
        );

        $final_class = array_merge( $final_class, explode( ' ', $class ) );


        $query = $this->get_query();
        if ( $query->have_posts() ) {
            // Build config array based on the name of a collection
            $collection = G1_Collection_Manager()->get_collection( $template );

            // Add effect
            $collection->add_class('g1-effect-' . sanitize_html_class( $effect ) );

            // Apply custom filters
            $collection = apply_filters( 'g1_collection_shortcode', $collection, $final_id );

            // Our tricky way to pass variables to a template part
            g1_part_set_data(
                array(
                    'query'         => $query,
                    'collection'    => $collection,
                    'elems'         => $this->get_elements(),
                )
            );

            if ( $collection ) {
                // Capture the template part of our collection
                ob_start();
                get_template_part( $collection->get_file() );
                $out1 = ob_get_clean();
            } else {
                $out1 = '';
            }


            // Compose the final template
            $out =  '<div id="' . esc_attr( $final_id ) .'" class="' . sanitize_html_classes( $final_class ) . '">' .
                        $out1 .
                    '</div>';

        }

        return $out;
    }

    protected function get_elements() {
        $elems = G1_Collection_Element_Manager()->get_default_values( $this->get_post_type() );
        $hide = $this->get_attribute('hide')->get_value();

        // Normalize the value
        $hide = str_replace( '_', '-', $hide );

        foreach ( explode(',', $hide ) as $element ) {
            $element = trim( $element );
            if ( array_key_exists( $element, $elems ) ) {
                $elems[ $element ] = false;
            }
        }

        return $elems;
    }

    abstract protected function set_details();
    abstract protected function get_query();
}



class G1_Custom_Collection_Shortcode extends G1_Collection_Shortcode {
    /**
     * Constructor
     */
    public function __construct( $id, $args = array() ) {
        parent::__construct( $id, $args );
    }

    protected function load_attributes() {
        // entry_ids
        $this->add_attribute( 'entry_ids', array(
            'form_control'  => 'Text',
            'id_aliases' => array(
                'entry-ids',
                'entryids',
                'ids',
                'entries',
            ),
            'hint'			=> __( 'Comma separated list of entry IDs', 'g1_theme' ),
        ));
    }

    public function set_details(){
        $post_obj = get_post_type_object( $this->get_post_type() );

        if ( $post_obj ) {
            $label = $post_obj->labels->name;
            $label = sprintf( __( '%s: Custom', 'g1_theme'), $label );
            $this->set_label( $label );
        }
    }



    protected function get_query() {
        $entry_ids = $this->get_attribute( 'entry_ids' )->get_value();

        $entry_ids = explode(',', $entry_ids);

        if ( G1_WPML_LOADED ) {
            $post_type = $this->get_post_type();

            if ( empty($post_type) ) {
                $post_type = 'post';
            }

            foreach ( $entry_ids as $entry_key => $entry_id ) {
                $entry_ids[$entry_key] = absint( icl_object_id( $entry_id, $post_type, true ) );
            }
        }

        $limit = count($entry_ids);

        $query_args = array(
            'post_type'				=> $this->get_post_type(),
            'post__in'				=> $entry_ids,
            'orderby'				=> 'post__in',
            'ignore_sticky_posts'	=> true,
            'posts_per_page'        => $limit
        );

        $query = new WP_Query( $query_args );

        return $query;
    }
}



class G1_Popular_Collection_Shortcode extends G1_Collection_Shortcode {
    /**
     * Constructor
     */
    public function __construct( $id, $args = array() ) {
        parent::__construct( $id, $args );
    }

    protected function load_attributes() {
        $this->add_max_attribute();
    }

    public function set_details(){
        $post_obj = get_post_type_object( $this->get_post_type() );
        if ( $post_obj ) {

            $label = $post_obj->labels->name;
            $label = sprintf( __( '%s: Popular', 'g1_theme'), $label );
            $this->set_label( $label );
        }
    }

    protected function get_query() {
        $max = $this->get_attribute( 'max' )->get_value();

        $query_args = array(
            'post_type'				=> $this->get_post_type(),
            'posts_per_page'		=> $max,
            'orderby'				=> 'comment_count',
            'order'					=> 'desc',
            'ignore_sticky_posts'	=> true,
        );

        /* Modify post query to consider only commented posts */
        //add_filter( 'posts_where', 'g1_filter_where_commented_posts' );

        $query = new WP_Query( $query_args );

        return $query;
    }
}

class G1_Recent_Collection_Shortcode extends G1_Collection_Shortcode {
    private $category_filter_taxonomy_name;

    public function __construct( $id, $args = array() ) {
        parent::__construct( $id, $args );

        if ( !empty($args['category_filter_taxonomy_name']) ) {
            $this->category_filter_taxonomy_name = $args['category_filter_taxonomy_name'];
        }
    }

    protected function load_attributes() {
        $this->add_max_attribute();
        // category
        $this->add_category_ids_attribute();
        $this->add_exclude_category_ids_attribute();
        // tag
        $this->add_tag_ids_attribute();
        $this->add_exclude_tag_ids_attribute();
    }

    public function add_category_ids_attribute() {
        $this->add_attribute( 'category_ids', array(
            'form_control'	=> 'Text',
            'hint'		    => __( 'Comma separated list of category IDs (optional)', 'g1_theme' ),
        ));
    }

    public function add_exclude_category_ids_attribute() {
        $this->add_attribute( 'exclude_category_ids', array(
            'form_control'	=> 'Text',
            'hint'		    => __( 'Comma separated list of excluded category IDs (optional)', 'g1_theme' ),
        ));
    }

    public function add_tag_ids_attribute() {
        $this->add_attribute( 'tag_ids', array(
            'form_control'	=> 'Text',
            'hint'		    => __( 'Comma separated list of tag IDs (optional)', 'g1_theme' ),
        ));
    }

    public function add_exclude_tag_ids_attribute() {
        $this->add_attribute( 'exclude_tag_ids', array(
            'form_control'	=> 'Text',
            'hint'		    => __( 'Comma separated list of excluded tag IDs (optional)', 'g1_theme' ),
        ));
    }

    public function set_details(){
        $post_obj = get_post_type_object( $this->get_post_type() );
        if ( $post_obj ) {
            $label = $post_obj->labels->name;
            $label = sprintf( __( '%s: Recent', 'g1_theme'), $label );
            $this->set_label( $label );
        }
    }

    protected function get_query() {
        $max = $this->get_attribute( 'max' )->get_value();
        // categories
        $category_ids = $this->get_attribute( 'category_ids' )->get_value();
        $exclude_category_ids = $this->get_attribute( 'exclude_category_ids' )->get_value();
        // tags
        $tag_ids = $this->get_attribute( 'tag_ids' )->get_value();
        $exclude_tag_ids = $this->get_attribute( 'exclude_tag_ids' )->get_value();

        $query_args = array(
            'post_type'				=> $this->get_post_type(),
            'posts_per_page'		=> $max,
            'orderby'				=> 'date',
            'order'					=> 'desc',
            'ignore_sticky_posts'	=> true,
        );

        $query_args = apply_filters( 'g1_recent_collection_shortcode_query_args', $query_args );

        if ( !empty($category_ids) ) {
            $category_ids = explode(',', $category_ids);

            if ( !empty($this->category_filter_taxonomy_name) ) {
                if ( G1_WPML_LOADED ) {
                    foreach ( $category_ids as $category_key => $category_id ) {
                        $category_ids[$category_key] = absint( icl_object_id( $category_id, $this->category_filter_taxonomy_name, true ) );
                    }
                }

                $query_args['tax_query'] = array(
                    array(
                        'taxonomy' => $this->category_filter_taxonomy_name,
                        'field' => 'ID',
                        'terms' => $category_ids
                    )
                );
            } else {
                if ( G1_WPML_LOADED ) {
                    foreach ( $category_ids as $category_key => $category_id ) {
                        $category_ids[$category_key] = absint( icl_object_id( $category_id, 'category', true ) );
                    }
                }

                $query_args['category__in'] = $category_ids;
            }
        } else if ( !empty($exclude_category_ids) ) {
            $exclude_category_ids = explode(',', $exclude_category_ids);

            if ( !empty($this->category_filter_taxonomy_name) ) {
                if ( G1_WPML_LOADED ) {
                    foreach ( $exclude_category_ids as $category_key => $category_id ) {
                        $exclude_category_ids[$category_key] = absint( icl_object_id( $category_id, $this->category_filter_taxonomy_name, true ) );
                    }
                }

                $query_args['tax_query'] = array(
                    array(
                        'taxonomy' => $this->category_filter_taxonomy_name,
                        'field' => 'ID',
                        'terms' => $exclude_category_ids,
                        'operator' => 'NOT IN'
                    )
                );
            } else {
                if ( G1_WPML_LOADED ) {
                    foreach ( $exclude_category_ids as $category_key => $category_id ) {
                        $exclude_category_ids[$category_key] = absint( icl_object_id( $category_id, 'category', true ) );
                    }
                }

                $query_args['category__not_in'] = $exclude_category_ids;
            }
        } else if ( !empty($tag_ids) ) {
            $tag_ids = explode(',', $tag_ids);

            if ( !empty($this->tag_filter_taxonomy_name) ) {
                if ( G1_WPML_LOADED ) {
                    foreach ( $tag_ids as $tag_key => $tag_id ) {
                        $tag_ids[$tag_key] = absint( icl_object_id( $tag_id, $this->tag_filter_taxonomy_name, true ) );
                    }
                }

                $query_args['tax_query'] = array(
                    array(
                        'taxonomy' => $this->tag_filter_taxonomy_name,
                        'field' => 'ID',
                        'terms' => $tag_ids
                    )
                );
            } else {
                if ( G1_WPML_LOADED ) {
                    foreach ( $tag_ids as $tag_key => $tag_id ) {
                        $tag_ids[$tag_key] = absint( icl_object_id( $tag_id, 'post_tag', true ) );
                    }
                }

                $query_args['tag__in'] = $tag_ids;
            }
        } else if ( !empty($exclude_tag_ids) ) {
            $exclude_tag_ids = explode(',', $exclude_tag_ids);

            if ( !empty($this->tag_filter_taxonomy_name) ) {
                if ( G1_WPML_LOADED ) {
                    foreach ( $exclude_tag_ids as $tag_key => $tag_id ) {
                        $exclude_tag_ids[$tag_key] = absint( icl_object_id( $tag_id, $this->tag_filter_taxonomy_name, true ) );
                    }
                }

                $query_args['tax_query'] = array(
                    array(
                        'taxonomy' => $this->tag_filter_taxonomy_name,
                        'field' => 'ID',
                        'terms' => $exclude_tag_ids,
                        'operator' => 'NOT IN'
                    )
                );
            } else {
                if ( G1_WPML_LOADED ) {
                    foreach ( $exclude_tag_ids as $tag_key => $tag_id ) {
                        $exclude_tag_ids[$tag_key] = absint( icl_object_id( $tag_id, 'post_tag', true ) );
                    }
                }

                $query_args['tag__not_in'] = $exclude_tag_ids;
            }
        }

        $query = new WP_Query( $query_args );

        return $query;
    }
}