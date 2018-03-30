<?php
/**
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Framework
 * @subpackage G1_Form_Controls
 * @since G1_Form_Controls 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php

add_action( 'init', 'g1_form_controls_load_scripts' );

function g1_form_controls_load_scripts() {
    if ( is_admin() ) {
        wp_enqueue_script( 'g1-form-controls', trailingslashit( G1_FRAMEWORK_URI ) . 'admin/js/g1-form-controls.js', array( 'jquery' ) );

        $translation_array = array( 'set_background_image_label' => __( 'Set Background Image', 'g1_theme' ) );
        wp_localize_script( 'g1-form-controls', 'g1_form_controls_i18n', $translation_array );

        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'wp-color-picker' );
    }
}


/**
 * Abstract class representing a form control
 */
class G1_Form_Control {
    protected $id;
    protected $name;

    protected $value;

    protected $label;
    protected $hint;
    protected $help;
    protected $default;


    public function __construct( $id, $args = array() ) {
        $this->set_id( $id );

        // Label
        $this->set_label( isset ( $args['label'] ) ? $args['label'] : $this->get_id() );

        // name
        $this->set_name( isset ( $args['name'] ) ? $args['name'] : $this->get_id() );

        // value
        $this->set_value( isset ( $args['value'] ) ? $args['value'] : null );

        // Hint
        $this->set_hint( isset ( $args['hint'] ) ? $args['hint'] : '' );

        // Help
        $this->set_help( isset ( $args['help'] ) ? $args['help'] : '' );

        // Default
        $this->set_default( isset ( $args['default'] ) ? $args['default'] : '' );
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
     * Gets the name
     *
     * @return string
     */
    public function get_name() {
        return $this->name;
    }

    /**
     * Sets the name
     */
    public function set_name( $val ) {
        $this->name = $val;
    }

    /**
     * Gets the value
     *
     * @return      string
     */
    public function get_value() {
        return $this->value;
    }

    /**
     * Sets the value
     */
    public function set_value( $val ) {
        $this->value = $val;
    }

    /**
     * Gets the label
     *
     * @return      string
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
     * Gets the hint
     *
     * @return string
     */
    public function get_hint() {
        return $this->hint;
    }

    /**
     * Sets the hint
     */
    public function set_hint( $val ) {
        $this->hint = $val;
    }

    /**
     * Gets the help
     *
     * @return string
     */
    public function get_help() {
        return $this->help;
    }

    /**
     * Sets the help
     */
    public function set_help( $val ) {
        $this->help = $val;
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
     * Sets the help
     */
    public function set_default( $val ) {
        $this->default = $val;
    }

    public function get_html_id() {
        $html_id = str_replace(
            array(
                '[',
                ']',
            ),
            array(
                '-',
                ''
            ),
            $this->get_id()
        );
        $html_id = 'g1-post-meta-control-' . $html_id;

        return $html_id;
    }

    public function get_html_class() {
        $final_class = array(
            'g1-post-meta-control',
            'g1-option-view',
        );

        return $final_class;
    }

    /**
     * Capture the label
     */
    public function capture_label() {
        $out =  '<div class="g1-label">' .
                    '<label>' .
                        esc_html( $this->get_label() ) .
                    '</label>' .
                '</div>';

        return $out;
    }
    public function render_label() {
        echo $this->capture_label();
    }

    /**
     * Capture the hint
     */
    public function capture_hint() {
        $out = '';

        if ( strlen( $this->get_hint() ) ) {
            global $allowedtags;

            $new_allowed_tags = $allowedtags;
            $new_allowed_tags['p'] = array();
            $new_allowed_tags['br'] = array();

            $out .= '<div class="g1-hint">' .
                        wp_kses( $this->get_hint(), $new_allowed_tags ) .
                    '</div>';
        }

        return $out;
    }
    public function render_hint() {
        echo $this->capture_hint();
    }

    /**
     * Capture the help
     */
    public function capture_help() {
        $out = '';

        if ( strlen( $this->get_help() ) ) {
            global $allowedtags;

            $new_allowed_tags = $allowedtags;
            $new_allowed_tags['p'] = array();
            $new_allowed_tags['ul'] = array();
            $new_allowed_tags['ol'] = array();
            $new_allowed_tags['li'] = array();

            $out .= '<div class="g1-help">' .
                        wp_kses( $this->get_help(), $new_allowed_tags ) .
                    '</div>';
        }

        return $out;
    }
    public function render_help() {
        echo $this->capture_help();
    }


    /**
     * Capture the content.
     */
    public function capture_field() {
    }
    public function render_field() {
        echo $this->capture_field();
    }


    /**
     * Captures the control
     */
    public function capture() {

        // Compose the final template
        $out =  '<li id="' . esc_attr( $this->get_html_id() ) . '" class="' . sanitize_html_classes( $this->get_html_class() ) . '">' .
            $this->capture_label() .
            $this->capture_help() .
            $this->capture_field() .
            $this->capture_hint() .
            '</li>';

        return $out;

    }
    public function render() {
        echo $this->capture();
    }
}



/**
 * Factory (design pattern) of form controls
 *
 * Always use this factory to create new form controls
 */
class G1_Form_Control_Factory {
    const TYPE_TEXT = 'Text';
    const TYPE_COLOR = 'Color';
    const TYPE_LONG_TEXT = 'Long_Text';
    const TYPE_CHOICE = 'Choice';
    const TYPE_MULTICHOICE_TEXT = 'Multichoice_Text';

    /**
     * @return G1_Form_Control
     */
    static public function create( $id, $args, $type = self::TYPE_TEXT ) {
        $class_name = explode( '_', $type );

        // Capitalize first letter
        $class_name = array_map( 'ucfirst', $class_name );

        $class_name = implode( '_', $class_name );
        $class_name = 'G1_Form_' . $class_name . '_Control';

        if ( class_exists( $class_name ) ) {
            $control = new $class_name( $id, $args );

            return $control;
        }
    }

    /**
     * @param G1_Shortcode_Attribute $attribute
     * @return G1_Form_Control
     */
    public static function create_form_control_from_attribute(G1_Shortcode_Attribute $attribute) {
        $attributeArgs = array(
            'label'		=> $attribute->get_label(),
            'name'      => $attribute->get_id(),
            'hint'      => $attribute->get_hint(),
            'help'      => $attribute->get_help()
        );

        switch ($attribute->get_form_control()) {
            case 'Choice':
                $attributeArgs['choices'] = $attribute->get_attr_by_name('choices');
                break;
            case 'Multichoice_Text':
                $attributeArgs['elements'] = $attribute->get_attr_by_name('elements');
                break;
        }

        $attributeArgs = apply_filters('g1_create_form_control_from_attribute', $attributeArgs);

        $control = self::create(
            $attribute->get_id(),
            $attributeArgs,
            $attribute->get_form_control()
        );
        $control->set_value($attribute->get_value());

        return $control;
    }
}

class G1_Form_Text_Control extends G1_Form_Control {

    public function get_html_class() {
        return array_merge( parent::get_html_class(), array( 'g1-option-view-string' ) );
    }

    /**
     * Renders content
     */
    public function capture_field() {
        $out =  '<div class="g1-field">' .
                    '<input name="' . esc_attr( $this->get_name() ) . '"   type="text" value="' . esc_attr( $this->get_value() ) . '" />';
                '</div>';

        return $out;
    }
}

class G1_Form_Long_Text_Control extends G1_Form_Control {
    public function get_html_class() {
        return array_merge( parent::get_html_class(), array( 'g1-option-view-long-text' ) );
    }

    /**
     * Renders content
     */
    public function capture_field() {
        $out = '<div class="g1-field">' .
                    '<textarea name="' . esc_attr( $this->get_name() ) . '" cols="10" rows="10">' .
                        esc_textarea( $this->get_value() ) .
                    '</textarea>' .
                '</div>';

        return $out;
    }
}

class G1_Form_Choice_Control extends G1_Form_Control {
    protected $choices;
    protected $choices_cb;

    public function __construct( $id, $args = array() ) {
        parent::__construct( $id, $args );

        // The 'choices' argument
        $this->set_choices( isset( $args['choices'] ) ? $args['choices'] : array() );

        // The 'choices_cb' argument
        $this->set_choices_cb( isset( $args['choices_cb'] ) ? $args['choices_cb'] : null );
    }

    public function get_html_class() {
        return array_merge( parent::get_html_class(), array( 'g1-option-view-choice' ) );
    }

    protected function get_choices() {
        return $this->choices;
    }

    protected function set_choices( $val ) {
        $this->choices = $val;
    }

    protected function get_choices_cb() {
        return $this->choices_cb;
    }

    protected function set_choices_cb( $val ) {
        $this->choices_cb = $val;
    }

    protected function get_final_choices() {
        $result = array();

        $result = $result + $this->get_choices();

        // Add choices returned by a callback function
        if ( is_callable( $this->get_choices_cb() ) ) {
            $result = $result + call_user_func( $this->get_choices_cb() );
        }


        return $result;
    }


    /**
     * Renders content
     */
    public function capture_field() {
        $choices = $this->get_final_choices();

        if ( empty( $choices ) )
            return;

        $out = '';

        $out .= '<div class="g1-field">' .
            '<select id="' . esc_attr( $this->get_html_id() ) . '" name="' . esc_attr( $this->get_name() ) . '">';

        foreach( $choices as $k => $v ) {
            if ( is_array( $v ) && count( $v ) ) {
                $out .= '<optgroup label="' . esc_attr( $k ) .'">';

                foreach ( $v as $k2 => $v2 ) {
                    if ( $k2 == $this->get_value() ) {
                        $out .= '<option selected="selected" value="' . esc_attr( $k2 ) . '">' . esc_html( $v2 ) . '</option>';
                    } else {
                        $out .= '<option value="' . esc_attr( $k2 ) . '">' . esc_html( $v2 ) . '</option>';
                    }
                }

                $out .= '</optgroup>';
            } else if ( $k == $this->get_value() || (empty($this->value) && $k == $this->get_default()) ) {
                $out .= '<option selected="selected" value="' . esc_attr( $k ) . '">' . esc_html( $v ) . '</option>';
            } else {
                $out .= '<option value="' . esc_attr( $k ) . '">' . esc_html( $v ) . '</option>';
            }
        }

        $out .=     '</select>' .
            '</div>';

        return $out;
    }
}

class G1_Form_Multichoice_Text_Control extends G1_Form_Control {
    private $elements;

    public function get_html_class() {
        return array_merge( parent::get_html_class(), array( 'g1-option-view-multichoice-text' ) );
    }

    public function __construct( $id, $args = array() ) {
        parent::__construct( $id, $args );

        $this->elements = $args['elements'];
    }

    public function get_elements() {
        return $this->elements;
    }

    /**
     * Renders content
     */
    public function capture_field() {
        $out = '<div class="g1-field">';

        foreach ($this->get_elements() as $name => $label) {
            $out .= sprintf('<div><label><input type="checkbox" name="%s" value="%s">%s</label></div>', $name, $name, $label);
        }

        $out .= sprintf('<input type="hidden" name="%s" value="%s" />', esc_attr($this->get_name()), esc_attr($this->get_value()));
        $out .= '<script type="text/javascript">jQuery(document).trigger("g1-field-loaded");</script>';
        $out .= '</div>';

        return $out;
    }
}


class G1_Form_Image_Choice_Control extends G1_Form_Choice_Control {

    public function get_html_class() {
        return array_merge( parent::get_html_class(), array( 'g1-option-view-image-choice' ) );
    }

    public function capture_field() {
        $out = '';
        $i = 0;

        $out .= '<div class="g1-field g1-field-image-choice">';
        foreach( $this->get_final_choices() as $opt_value => $opt_img ) {
            $out .= '<div>';
            $out .= '<label>';

            if ( $opt_value === $this->get_value() || $opt_value === $this->get_default() || ( 0 == $i && !strlen( $this->get_value() && !$this->get_default() ) ) ) {
                $out .= '<input type="radio" name="' . esc_attr( $this->get_name() ) . '" checked="checked" value="' . esc_attr( $opt_value ) . '" />';
            } else {
                $out .= '<input type="radio" name="' . esc_attr( $this->get_name() ) . '" value="' . esc_attr( $opt_value ) . '" />';
            }
            $alt = !empty( $opt_value ) ? esc_attr( $opt_value ) : esc_url( $opt_img );

            $out .= '<img src="' . esc_url( $opt_img ) . '" alt="' . $alt . '" title="' . esc_attr( $opt_value ) . '" width="100" height="100" />';
            $out .= '</label>';
            $out .= '</div>';
            $i++;
        }
        $out .= '</div>';

        return $out;
    }
}


class G1_Form_Range_Control extends G1_Form_Control {
    protected $min;
    protected $max;
    protected $step;

    public function __construct( $id, $args = array() ) {
        parent::__construct( $id, $args );

        // The 'min' argument
        $this->set_min( isset( $args['min'] ) ? $args['min'] : 0 );

        // The 'max' argument
        $this->set_max( isset( $args['max'] ) ? $args['max'] : 100 );

        // The 'step' argument
        $this->set_step( isset( $args['step'] ) ? $args['step'] : 1 );
    }

    public function get_html_class() {
        return array_merge( parent::get_html_class(), array( 'g1-option-view-range' ) );
    }

    public function set_min( $val ) {
        $this->min = (float) $val;
    }

    public function get_min() {
        return $this->min;
    }

    public function set_max( $val ) {
        $this->max = (float) $val;
    }

    public function get_max() {
        return $this->max;
    }

    public function set_step( $val ) {
        $this->step = (float) $val;
    }

    public function get_step() {
        return $this->step;
    }

    public function capture_field() {
        $out = '';
        $value = $this->get_value() ? $this->get_value() : ($this->get_default() / 1000);

        $out .= '<div class="g1-field g1-field-range">' .
            '<input type="range" min="' . esc_attr( $this->get_min() ) . '" max="' . esc_attr( $this->get_max() ) . '" step="' . esc_attr( $this->get_step() ) . '" name="' . esc_attr( $this->get_name() ) . '" value="' . esc_attr( $value ) . '" />' .
            '</div>';

        return $out;
    }
}

class G1_Form_Color_Control extends G1_Form_Control {
    protected $default_color;

    public function __construct( $id, $args = array() ) {
        parent::__construct( $id, $args );

        $this->set_default_color( isset( $args['default_color'] ) ? $args['default_color'] : '' );
    }

    public function set_default_color( $val ) {
        $this->default_color = $val;
    }

    public function get_default_color() {
        return $this->default_color;
    }

    public function get_html_class() {
        return array_merge( parent::get_html_class(), array( 'g1-option-view-color' ) );
    }

    /**
     * Renders content
     */
    public function capture_field() {
        $this_default = $this->get_default_color();
        $default_attr = '';
        if ( $this_default ) {
            if ( false === strpos( $this_default, '#' ) )
                $this_default = '#' . $this_default;
            $default_attr = ' data-default-color="' . esc_attr( $this_default ) . '"';
        }

        $out =  '<div class="g1-field">' .
            '<input class="wp-color-picker"'.$default_attr.' placeholder="'.__( 'Hex Value', 'g1_theme' ).'" name="' . esc_attr( $this->get_name() ) . '"   type="text" value="' . esc_attr( $this->get_value() ) . '" />';
        '</div>';

        return $out;
    }
}

class G1_Form_Upload_Control extends G1_Form_Control {

    public function __construct( $id, $args = array() ) {
        parent::__construct( $id, $args );
    }

    public function get_html_class() {
        return array_merge( parent::get_html_class(), array( 'g1-option-view-upload' ) );
    }

    /**
     * Renders content
     */
    public function capture_field() {
        $preview = '';
        $attachment_id = $this->get_value();

        if ($attachment_id) {
            $attachment = wp_get_attachment_image_src( $attachment_id );;
            $preview = '<img src="'.esc_attr( $attachment[0] ).'" />';
        }

        $out =  '<div class="g1-field g1-media-upload">'.
            '<a href="#" class="button g1-media-upload-button" title="'.__( 'Select an image', 'g1_theme' ).'"><span class="wp-media-buttons-icon"></span>'.__( 'Select an image', 'g1_theme' ).'</a>'.
            '<input class="g1-media-upload-input" name="' . esc_attr( $this->get_name() ) . '" type="hidden" value="' . esc_attr( $this->get_value() ) . '" />'.
            '<a href="#" class="button g1-clear-button">'.__( 'Clear', 'g1_theme' ).'</a>'.
            '<div class="g1-media-upload-preview">'.$preview.'</div>'.
        '</div>';

        return $out;
    }
}