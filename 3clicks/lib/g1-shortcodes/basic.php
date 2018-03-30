<?php
/**
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Theme03
 * @subpackage G1_Shortcodes
 * @since G1_Shortcodes 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php


/**
 * Adds "basic" section to the global shortcode generator
 *
 * @param G1_Shortcode_Generator $generator
 */
function g1_shortgen_section_basic( $generator ) {
    $generator->add_section( 'basic', array(
        'label' => __( 'Basic', 'g1_theme' ),
        'priority' => 100,
    ));
}
add_action( 'g1_shortcode_generator_register', 'g1_shortgen_section_basic', 9 );






class G1_Button_Shortcode extends G1_Shortcode {
    public function __construct( $id, $args = array() ) {
        parent::__construct( $id, $args );

        // content
        $this->set_content( 'content', array(
            'form_control' => 'Text',
            'label' => __( 'label', 'g1_theme' ),
            'hint'	=> __( 'Add a second line by wrapping part of the label with a &lt;small&gt; tag', 'g1_theme' ),
        ));

        $this->set_type( 'inline' );

        add_action( 'g1_shortcode_generator_register', array( $this, 'add_shortcode_generator_item' ) );
    }

    /**
     * Add shortcode to the global shortcode generator
     *
     * @param       G1_Shortcode_Generator $generator
     */
    public function add_shortcode_generator_item( $generator ) {
        $generator->add_item( $this, 'basic' );
    }

    protected function load_attributes() {
        // linking attribute
        $this->add_attribute( 'linking', array(
            'form_control' => 'Choice',
            'hint' => __( 'What to do when user clicks the button?', 'g1_theme' ),
            'choices'	   => array(
                'default' 		=> __( 'open in the same window', 'g1_theme' ),
                'new_window'	=> __( 'open in a new window', 'g1_theme' ),
                'lightbox'		=> __( 'open in a lightbox', 'g1_theme' ),
            ),
            'value_aliases' => array(
                'new_window' => 'new_window',
                'new-window' => 'new_window',
                'default' => 'default',
                'standard' => 'default',
            ),
        ));

        // link attribute
        $this->add_attribute( 'link', array(
            'form_control' => 'Text',
            'id_aliases'   => array(
                'href',
                'url'
            ),
            'hint' => __( 'The destination to which the link leads', 'g1_theme' ),
        ));

        // lightbox_group attribute
        $this->add_attribute( 'lightbox_group', array(
            'form_control' => 'Text',
            'id_aliases'   => array(
                'lightboxgroup',
                'lightbox-group',
                'lightbox'
            ),
            'hint'			=> __( 'Fill in this field, if you want different elements to be in one gallery', 'g1_theme' ),
        ));

        // align attribute
        $this->add_attribute( 'align', array(
            'form_control' => 'Choice',
            'choices'	   => array(
                'left'   => 'left',
                'center' => 'center',
                'right'  => 'right',
            ),
        ));

        // size attribute
        $this->add_attribute( 'size', array(
            'form_control' => 'Choice',
            'default'      => 'small',
            'choices'	   => array(
                'small' 		=> 'small',
                'medium'		=> 'medium',
                'big'		    => 'big',
            ),
            'value_aliases' => array(
                'xs'    => 'small',
                's'     => 'small',
                'm'     => 'medium',
                'large' => 'big',
                'l'     => 'big',
                'xl'    => 'big',
            ),
        ));

        // type attribute
        $this->add_attribute( 'type', array(
            'form_control' => 'Choice',
            'default'      => 'standard',
            'choices'	   => array(
                'standard' 		=> 'standard',
                'wide'			=> 'wide',
            ),
        ));

        // style attribute
        $this->add_attribute( 'style', array(
            'form_control' => 'Choice',
            'default'      => 'solid',
            'choices'	   => array(
                'simple' 		=> 'simple',
                'solid'			=> 'solid',
            ),
        ));

        // icon attribute
        $this->add_attribute( 'icon', array(
            'form_control' => 'Choice',
            'default'      => '',
            'choices_cb'   => 'g1_get_font_awesome',
        ));


        // title attribute
        $this->add_attribute( 'title', array(
            'form_control' => 'Text',
        ));

        // text_color attribute
        $this->add_attribute( 'text_color', array(
            'form_control' => 'Text',
            'id_aliases' => array(
                'textcolor',
                'text-color',
                'color',
            ),
            'hint' => __( 'Text Color', 'g1_theme' ),
        ));

        // bg_color attribute
        $this->add_attribute( 'bg_color', array(
            'form_control' => 'Text',
            'id_aliases' => array(
                'bgcolor',
                'bg-color',
                'background_color',
                'background-color',
                'backgroundcolor',
                'background',
            ),
            'hint' => __( 'Background Color', 'g1_theme' ),
        ));
    }

    /**
     * Shortcode callback function.
     *
     * @return string
     */
    protected function do_shortcode() {
        extract( $this->extract() );

        // Compose final HTML id attribute
        $final_id = strlen( $id ) ? $id : 'g1-button-' . $this->get_counter();

        // Compose final HTML class attribute
        $final_class = array(
            'g1-button',
            'g1-button--' . $size,
            'g1-button--' . $style,
            'g1-button--' . $type,
        );
        
        $final_class = array_merge( $final_class, explode( ' ', $class ) );

        if ( strlen( $icon ) ) {
            $icon = '<i class="'. g1_get_font_awesome_icon_class( $icon ) .'"></i>';
        }

        // Compose HTML rel attribute
        $rel = '';

        switch ( $linking ) {
            case 'lightbox':
                $rel = strlen( $lightbox_group ) ? $lightbox_group : 'single';
                break;
            case 'new_window':
                $final_class[] = 'g1-new-window ';
                break;
            default:
                break;
        }

        // Compose CSS
        $css = '';
        $css_rules = array();

        if ( strlen( $text_color ) ) {
            $color = new G1_Color($text_color);
            $css_rules[] = 'color: #' . $color->get_hex() . ';';
        }

        if ( strlen( $bg_color ) ) {
            $color = new G1_Color($bg_color);

            switch ( $style ) {
                case 'simple':
                    $css_rules[] = 'border-color: #' . $color->get_hex() . ';';
                    break;

                case 'solid':
                    $css_rules[] = 'background-color: #' . $color->get_hex() . ';';
                    $css_rules[] = 'border-color: #' . $color->get_hex() . ';';
                    break;
            }
        }

        if ( count( $css_rules ) ) {
            $css = '<style type="text/css" scoped="scoped">' .
                        '#' . esc_attr( $final_id ) . '.g1-button {' . implode( ' ', $css_rules ) . '}' .
                    '</style>';
        }

        // Compose the template
        $out =	'%css%' .
            '%before%' .
            '<a id="%id%" class="%class%" href="%href%" %title%%ref%>' .
            '%icon%' .
            '%content%' .
            '</a>' .
            '%after%';

        // Fill in the template
        $out = str_replace(
            array(
                '%css%',
                '%before%',
                '%id%',
                '%class%',
                '%href%',
                '%title%',
                '%ref%',
                '%icon%',
                '%content%',
                '%after%',
            ),
            array(
                $css,
                ( 'divider' === $type ) ? '<div class="g1-button-divider">' : '',
                esc_attr( $final_id ),
                sanitize_html_classes( $final_class ),
                esc_url( $link ),
                strlen( $title ) ? 'title="'	. esc_attr( wp_strip_all_tags( $title ) ) . '" ' : '',
                strlen( $rel ) ? 'data-g1-lightbox="' . esc_attr( wp_strip_all_tags( $rel ) ) . '" ' : '',
                $icon,
                do_shortcode( $content ),
                ( 'divider' === $type ) ? '</div>' : '',
            ),
            $out
        );

        return $out;
    }
}
function G1_Button_Shortcode() {
    static $instance = null;

    if ( null === $instance )
        $instance = new G1_Button_Shortcode( 'button' );

    return $instance;
}
// Fire in the hole :)
G1_Button_Shortcode();



class G1_Message_Shortcode extends G1_Shortcode {
    public function __construct( $id, $args = array() ) {
        parent::__construct( $id, $args );

        // content
        $this->set_content( 'content', array(
            'form_control' => 'Long_Text',
        ));

        add_action( 'g1_shortcode_generator_register', array( $this, 'add_shortcode_generator_item' ) );
    }

    /**
     * Add shortcode to the global shortcode generator
     *
     * @param G1_Shortcode_Generator $generator
     */
    public function add_shortcode_generator_item( $generator ) {
        $generator->add_item( $this, 'basic' );
    }

    protected function load_attributes() {
        // type attribute
        $this->add_attribute( 'type', array(
            'form_control' => 'Choice',
            'default'      => 'success',
            'choices'	   => array(
                'success'	=> 'success',
                'info'		=> 'info',
                'warning'	=> 'warning',
                'error'		=> 'error',
            ),
        ));
    }

    /**
     * Shortcode callback function.
     *
     * @return string
     */
    protected function do_shortcode() {
        extract( $this->extract() );

        $content = preg_replace('#^<\/p>|<p>$#', '', $content);

        // Compose final HTML id attribute
        $final_id = strlen( $id ) ? $id : 'g1-message-' . $this->get_counter();

        $final_class = array(
            'g1-message',
            'g1-message--' . $type,
        );

        $final_class = array_merge( $final_class, explode( ' ', $class ) );

        // Compose the template
        $out = '<div %id%%class%>' .
                    '<div class="g1-inner">' . $content . '</div>' .
                '</div>';

        // Fill in the template
        $out = str_replace(
            array(
                '%id%',
                '%class%',
                '%content%',
            ),
            array(
                strlen( $final_id ) ? 'id="' . esc_attr( $final_id) . '" ' : '',
                count( $final_class ) ? 'class="' . sanitize_html_classes( $final_class) . '" ' : '',
                $content,
            ),
            $out
        );

        return $out;
    }
}
function G1_Message_Shortcode() {
    static $instance = null;

    if ( null === $instance )
        $instance = new G1_Message_Shortcode( 'message' );

    return $instance;
}
// Fire in the hole :)
G1_Message_Shortcode();



class G1_Dropcap_Shortcode extends G1_Shortcode {
    public function __construct( $id, $args = array() ) {
        parent::__construct( $id, $args );

        // content
        $this->set_content( 'content', array(
            'form_control' => 'Text',
        ));

        $this->set_type( 'inline' );

        add_action( 'g1_shortcode_generator_register', array( $this, 'add_shortcode_generator_item' ) );
    }

    /**
     * Add shortcode to the global shortcode generator
     *
     * @param       G1_Shortcode_Generator $generator
     */
    public function add_shortcode_generator_item( $generator ) {
        $generator->add_item( $this, 'basic' );
    }

    protected function load_attributes() {
        // type attribute
        $this->add_attribute( 'style', array(
            'form_control' => 'Choice',
            'default'      => 'simple',
            'choices'	   => array(
                'simple'	=> 'simple',
                'solid'	    => 'solid',
            ),
        ));

        // text_color attribute
        $this->add_attribute( 'text_color', array(
            'form_control' => 'Text',
            'id_aliases' => array(
                'textcolor',
                'text-color',
                'color',
            ),
            'hint' => __( 'Text Color', 'g1_theme' ),
        ));

        // bg_color attribute
        $this->add_attribute( 'bg_color', array(
            'form_control' => 'Text',
            'id_aliases' => array(
                'bgcolor',
                'bg-color',
                'background_color',
                'background-color',
                'backgroundcolor',
                'background',
            ),
            'hint' => __( 'Background Color', 'g1_theme' ),
        ));
    }

    /**
     * Shortcode callback function.
     *
     * @return string
     */
    protected function do_shortcode() {
        extract( $this->extract() );

        $content = preg_replace('#^<\/p>|<p>$#', '', $content);

        // Compose final HTML id attribute
        $final_id = strlen( $id ) ? $id : 'g1-dropcap-' . $this->get_counter();

        // Compose final HTML class attribute
        $final_class = array(
            'g1-dropcap',
            'g1-dropcap--' . $style,
        );

        $final_class = array_merge( $final_class, explode( ' ', $class ) );


        // Compose CSS
        $css = '';
        if ( strlen( $text_color ) ) {
            $color = new G1_Color($text_color);
            $css .= '#' . esc_attr($final_id) . '.g1-dropcap--simple,' . "\n" .
                    '#' . esc_attr($final_id) . '.g1-dropcap--solid {' . "\n" .
                        'color: #' . $color->get_hex() . ';' ."\n" .
                    '}' ."\n";
        }

        if ( strlen( $bg_color ) ) {
            $color = new G1_Color($bg_color);
            $hex = $color->get_hex();
            list($from, $to) = G1_Color_Generator::get_warm_gradient( $color );
            $from_hex = $from->get_hex();
            $to_hex = $to->get_hex();

            $css .= '#' . esc_attr($final_id) . '.g1-dropcap--solid  {' . "\n" .
                    'background-color: #' . $hex . ';' . "\n" .
                '}' . "\n";
        }
        //$css = str_replace(array("\n", "\r"), '', $css);

        // Compose output
        $out = '';

        $out .= strlen($css) ? "\n" . '<style type="text/css">' . $css . '</style>' . "\n" : '';

        $out .= '<span id="' . esc_attr( $final_id ) . '" ';
        $out .= 'class="' . sanitize_html_classes( $final_class ) . '" ';
        $out .= '><span>';
        $out .= $content;
        $out .= '</span></span>';

        return $out;
    }
}
function G1_Dropcap_Shortcode() {
    static $instance = null;

    if ( null === $instance )
        $instance = new G1_Dropcap_Shortcode( 'dropcap' );

    return $instance;
}
// Fire in the hole :)
G1_Dropcap_Shortcode();





class G1_Lead_Shortcode extends G1_Shortcode {
    public function __construct( $id, $args = array() ) {
        parent::__construct( $id, $args );

        // content
        $this->set_content( 'content', array(
            'form_control' => 'Text',
            'hint'	=> __( 'Add a second line by wrapping part of the label with a &lt;small&gt; tag', 'g1_theme' ),
        ));

        add_action( 'g1_shortcode_generator_register', array( $this, 'add_shortcode_generator_item' ) );
    }

    /**
     * Add shortcode to the global shortcode generator
     *
     * @param       G1_Shortcode_Generator $generator
     */
    public function add_shortcode_generator_item( $generator ) {
        $generator->add_item( $this, 'basic' );
    }

    /**
     * Shortcode callback function.
     *
     * @return string
     */
    protected function do_shortcode() {
        extract( $this->extract() );

        $content = preg_replace('#^<\/p>|<p>$#', '', $content );

        // Compose final HTML id attribute
        $final_id = strlen( $id ) ? $id : 'g1-lead-' . $this->get_counter();

        // Compose final HTML class attribute
        $final_class = array(
            'g1-lead ',
        );
        $final_class = array_merge( $final_class, explode( ' ', $class ) );

        // Compose output
        $out = '';

        $out .= '<div id="' . esc_attr( $final_id ) . '" ';
        $out .= 'class="' . sanitize_html_classes( $final_class ) . '" ';
        $out .= '>';
        $out .= do_shortcode(shortcode_unautop($content));
        $out .= '</div>';

        return $out;
    }
}
function G1_Lead_Shortcode() {
    static $instance = null;

    if ( null === $instance )
        $instance = new G1_Lead_Shortcode( 'lead' );

    return $instance;
}
// Fire in the hole :)
G1_Lead_Shortcode();



class G1_List_Shortcode extends G1_Shortcode {
    public function __construct( $id, $args = array() ) {
        parent::__construct( $id, $args );

        // content
        $this->set_content( 'content', array(
            'form_control'  => 'Long_Text',
            'hint'          => 'for example: <br />'.
                htmlspecialchars('<ul>'). '<br />' .
                htmlspecialchars('<li>Line 1</li>'). '<br />' .
                htmlspecialchars('<li>Line 2</li>'). '<br />' .
                htmlspecialchars('<li>Line 3</li>'). '<br />' .
                htmlspecialchars('</ul>')
        ));

        add_action( 'g1_shortcode_generator_register', array( $this, 'add_shortcode_generator_item' ) );
    }

    /**
     * Add shortcode to the global shortcode generator
     *
     * @param       G1_Shortcode_Generator $generator
     */
    public function add_shortcode_generator_item( $generator ) {
        $generator->add_item( $this, 'basic' );
    }

    protected function load_attributes() {
        // type attribute
        $this->add_attribute( 'type', array(
            'form_control' => 'Choice',
            'default'      => 'icon',
            'choices'	   => array(
                'icon' 	        => 'icon',
                'empty' 	    => 'empty',
                'upper-alpha' 	=> 'upper-alpha',
                'lower-alpha'	=> 'lower-alpha',
                'upper-roman'	=> 'upper-roman',
                'lower-roman'	=> 'lower-roman',
                'circle'		=> 'circle',
                'decimal'		=> 'decimal',
                'disc'			=> 'disc',
                'square'		=> 'square',
            ),
        ));

        // style attribute
        $this->add_attribute( 'style', array(
            'form_control' => 'Choice',
            'default'      => 'none',
            'choices'	   => array(
                'none' => 'none',
                'simple' => 'simple',
            ),
        ));

        // icon attribute
        $this->add_attribute( 'icon', array(
            'form_control' => 'Choice',
            'default'      => 'angle-right',
            'choices_cb'   => 'g1_get_font_awesome',
        ));

        // icon_color attribute
        $this->add_attribute( 'icon_color', array(
            'form_control' => 'Text',
            'id_aliases' => array(
                'iconcolor',
                'icon-color',
                'color',
            ),
            'hint' => __( 'Icon Color', 'g1_theme' ),
        ));
    }

    /**
     * Shortcode callback function.
     *
     * @return string
     */
    protected function do_shortcode() {
        extract( $this->extract() );

        $content = preg_replace('#^<\/p>|<p>$#', '', $content);

        // Compose final HTML id attribute
        $final_id = strlen( $id ) ? $id : 'g1-list-' . $this->get_counter();


        $final_class = array(
            'g1-list--' . $type,
            'g1-list--' . $style,
        );

        $final_class = array_merge( $final_class, explode( ' ', $class ) );

        $listItem = '<li>';

        if ( $type === 'icon' && !empty($icon) ) {
            $listItem = $listItem . '<i class="'. g1_get_font_awesome_icon_class( $icon ) .' g1-list__icon"></i>';
        }

        $css = '';
        if ( strlen( $icon_color ) ) {
            $color = new G1_Color( $icon_color );
            $css .= '#' . esc_attr($final_id) . ' li > i[class*="fa-"]:first-child {' .
                        'color: #' . $color->get_hex() . ';' .
                    '}';
        }

        $content = str_replace(
            array(
                '<ul',
                '<ol',
                '<li>'
            ),
            array(
                '<ul id="' . esc_attr( $final_id ) . '" class="' . sanitize_html_classes( $final_class ) .'"',
                '<ol id="' . esc_attr( $final_id ) . '" class="' . sanitize_html_classes( $final_class ) .'"',
                $listItem
            ),

            do_shortcode( $content )
        );

        if ( strlen( $css ) ) {
            $css = '<style type="text/css" scoped="scoped">' .
                        $css .
                    '</style>';
        }

        return $css . $content;
    }
}
function G1_List_Shortcode() {
    static $instance = null;

    if ( null === $instance )
        $instance = new G1_List_Shortcode( 'list' );

    return $instance;
}
// Fire in the hole :)
G1_List_Shortcode();



class G1_Divider_Shortcode extends G1_Shortcode {
    public function __construct( $id, $args = array() ) {
        parent::__construct( $id, $args );

        add_action( 'g1_shortcode_generator_register', array( $this, 'add_shortcode_generator_item' ) );
    }

    /**
     * Add shortcode to the global shortcode generator
     *
     * @param G1_Shortcode_Generator $generator
     */
    public function add_shortcode_generator_item( $generator ) {
        $generator->add_item( $this, 'basic' );
    }

    protected function load_attributes() {
        // icon attribute
        $this->add_attribute( 'icon', array(
            'form_control' => 'Choice',
            'default'      => '',
            'choices_cb'   => 'g1_get_font_awesome',
        ));

        // style attribute
        $this->add_attribute( 'style', array(
            'form_control' => 'Choice',
            'default'      => 'none',
            'choices'	   => array(
                'none' => 'none',
                'simple' => 'simple',
            ),
        ));
    }

    /**
     * Shortcode callback function.
     *
     * @return string
     */
    protected function do_shortcode() {
        extract( $this->extract() );

        // Compose final HTML id attribute
        $final_id = strlen( $id ) ? $id : 'g1-divider-' . $this->get_counter();

        // Compose final HTML class attribute
        $final_class = array(
            'g1-divider',
            'g1-divider--' . $style,
        );

        if ( strlen( $icon ) ) {
            $icon = g1_get_font_awesome_icon_class( $icon );
            $icon = strlen( $icon ) ? "<span><i class=\"{$icon}\"></i></span>" : '';
            $final_class[] = 'g1-divider--icon';
        } else {
            $final_class[] = 'g1-divider--noicon';
        }

        $final_class = array_merge( $final_class, explode( ' ', $class ) );

        $out =  '<div id="' . esc_attr( $final_id ) .  '" class="' . sanitize_html_classes( $final_class ) . '">' .
                    $icon .
                '</div>';

        return $out;
    }
}
function G1_Divider_Shortcode() {
    static $instance;

    if ( !isset( $instance ) )
        $instance = new G1_Divider_Shortcode( 'divider' );

    return $instance;
}
// Fire in the hole :)
G1_Divider_Shortcode();




class G1_Divider_Top_Shortcode extends G1_Shortcode {
    public function __construct( $id, $args = array() ) {
        parent::__construct( $id, $args );

        add_action( 'g1_shortcode_generator_register', array( $this, 'add_shortcode_generator_item' ) );
    }

    /**
     * Add shortcode to the global shortcode generator
     *
     * @param G1_Shortcode_Generator $generator
     */
    public function add_shortcode_generator_item( $generator ) {
        $generator->add_item( $this, 'basic' );
    }

    /**
     * Shortcode callback function.
     *
     * @return string
     */
    protected function do_shortcode() {
        extract( $this->extract() );

        // Compose final HTML id attribute
        $final_id = strlen( $id ) ? $id : 'g1-divider-top-' . $this->get_counter();

        // Compose final HTML class attribute
        $final_class = array(
            'g1-divider-top',
            'g1-meta'
        );

        $final_class = array_merge( $final_class, explode( ' ', $class ) );

        $out = '<div id="' . esc_attr( $final_id ) . '" class="' . sanitize_html_classes( $final_class ) . '">' .
                    '<a class="g1-meta" href="#">'.__('Top', 'g1_theme').'</a>' .'
                    <div></div>' .
                '</div>';

        return $out;
    }
}
function G1_Divider_Top_Shortcode() {
    static $instance;

    if ( !isset( $instance ) )
        $instance = new G1_Divider_Top_Shortcode( 'divider_top' );

    return $instance;
}
// Fire in the hole :)
G1_Divider_Top_Shortcode();




class G1_Space_Shortcode extends G1_Shortcode {
    public function __construct( $id, $args = array() ) {
        parent::__construct( $id, $args );

        add_action( 'g1_shortcode_generator_register', array( $this, 'add_shortcode_generator_item' ) );
    }

    /**
     * Add shortcode to the global shortcode generator
     *
     * @param       G1_Shortcode_Generator $generator
     */
    public function add_shortcode_generator_item( $generator ) {
        $generator->add_item( $this, 'basic' );
    }

    protected function load_attributes() {
        // px attribute
        $this->add_attribute( 'value', array(
            'form_control' => 'Text',
            'default' => '1.5em',
            'id_aliases' => array(
                'height',
                'pixels',
                'px',
            ),
            'hint'		    => __( 'The height in pixels (can be negative).', 'g1_theme' ),
        ));
    }

    /**
     * Shortcode callback function.
     *
     * @return string
     */
    protected function do_shortcode() {
        extract( $this->extract() );

        // Compose final HTML id attribute
        $final_id = strlen( $id ) ? $id : 'g1-space-' . $this->get_counter();

        // Compose final HTML class attribute
        $final_class = array(
            'g1-space',
        );

        $final_class = array_merge( $final_class, explode( ' ', $class ) );

        if ( false !== filter_var( $value, FILTER_VALIDATE_INT) ) {
            $css_value = $value;
            $css_unit = 'px';
        } else {
            $css_value = (float)$value;
            $css_unit = 'em';
        }

        if ( $css_value > 0 ) {
            $style = 'style="height:' . $css_value . $css_unit . ';"';
        } else {
            $style = 'style="margin-top:' . $css_value . $css_unit . ';"';
        }


        $out = '<span id="' . esc_attr( $final_id ) . '" class="' . sanitize_html_classes( $final_class ) . '" ' . $style . '></span>';

        return $out;
    }
}
function G1_Space_Shortcode() {
    static $instance;

    if ( !isset( $instance ) )
        $instance = new G1_Space_Shortcode( 'space' );

    return $instance;
}
// Fire in the hole :)
G1_Space_Shortcode();




class G1_Table_Shortcode extends G1_Shortcode {
    public function __construct( $id, $args = array() ) {
        parent::__construct( $id, $args );

        // content
        $this->set_content( 'content', array(
            'form_control' => 'Text',
        ));

        add_action( 'g1_shortcode_generator_register', array( $this, 'add_shortcode_generator_item' ) );
    }

    /**
     * Add shortcode to the global shortcode generator
     *
     * @param       G1_Shortcode_Generator $generator
     */
    public function add_shortcode_generator_item( $generator ) {
        $generator->add_item( $this, 'basic' );
    }

    protected function load_attributes() {
        // style attribute
        $this->add_attribute( 'style', array(
            'form_control' => 'Choice',
            'default'      => 'solid',
            'choices'	   => array(
                'simple'		=> 'simple',
                'solid'		=> 'solid',
            ),
        ));
    }

    /**
     * Shortcode callback function.
     *
     * @return string
     */
    protected function do_shortcode() {
        extract( $this->extract() );

        $content = preg_replace('#^<\/p>|<p>$#', '', $content);

        // Compose final HTML id attribute
        $final_id = strlen( $id ) ? $id : 'g1-table-' . $this->get_counter();

        // Compose final HTML class attribute
        $final_class = array(
            'g1-table',
            'g1-table--' . $style,
        );

        $final_class = array_merge( $final_class, explode( ' ', $class ) );


        $content = '<div id="' . esc_attr( $final_id ) . '" class="' . sanitize_html_classes( $final_class ) . '">' .
                    $content .
                    '</div>';

        return do_shortcode( shortcode_unautop( $content ) );
    }
}
function G1_Table_Shortcode() {
    static $instance = null;

    if ( null === $instance )
        $instance = new G1_Table_Shortcode( 'table' );

    return $instance;
}
// Fire in the hole :)
G1_Table_Shortcode();



/**
 * [img_caption] shortcode callback function.
 * 
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function g1_shortcode_img_caption($attr, $content = null) {

	// Allow plugins/themes to override the default caption template.
	$output = apply_filters( 'img_caption_shortcode', '', $attr, $content );
	if ( $output != '' )
		return $output;

	extract(shortcode_atts(array(
		'id'	=> '',
		'align'	=> 'alignnone',
		'width'	=> '',
		'caption' => ''
	), $attr));

	if ( 1 > (int) $width || empty($caption) )
		return $content;

	if ( $id ) $id = 'id="' . esc_attr($id) . '" ';

	return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '" style="width: ' . (10 + (int) $width) . 'px">'
	. do_shortcode( $content ) . '<p class="meta wp-caption-text">' . $caption . '</p></div>';
}



class G1_Placeholder_Shortcode extends G1_Shortcode {
    public function __construct( $id, $args = array() ) {
        parent::__construct( $id, $args );

        $this->set_type( 'inline' );

        add_action( 'g1_shortcode_generator_register', array( $this, 'add_shortcode_generator_item' ) );
    }

    /**
     * Add shortcode to the global shortcode generator
     *
     * @param G1_Shortcode_Generator $generator
     */
    public function add_shortcode_generator_item( $generator ) {
        $generator->add_item( $this, 'basic' );
    }

    protected function load_attributes() {
        // width attribute
        $this->add_attribute( 'width', array(
            'form_control' => 'Text',
            'hint' => __( 'The width in pixels', 'g1_theme' ),
        ));

        // height attribute
        $this->add_attribute( 'height', array(
            'form_control' => 'Text',
            'hint' => __( 'The height in pixels', 'g1_theme' ),
        ));

        // size attribute
        $this->add_attribute( 'size', array(
            'form_control' => 'Text',
        ));

        // type attribute
        $this->add_attribute( 'icon', array(
            'form_control' => 'Choice',
            'default'      => '',
            'choices_cb'   => 'g1_get_font_awesome',
        ));
    }

    /**
     * Shortcode callback function.
     *
     * @return string
     */
    protected function do_shortcode() {
        extract( $this->extract() );

        $content = preg_replace('#^<\/p>|<p>$#', '', $content);

        // Compose final HTML id attribute
        $final_id = strlen( $id ) ? $id : 'placeholder-counter-' . $this->get_counter();

        // Compose final HTML class attribute
        $final_class = array(
            'g1-placeholder',
        );

        $final_class = array_merge( $final_class, explode( ' ', $class ) );


        // Determine width and height
        if ( strlen( $size ) ) {
            list ( $width, $height ) = g1_get_image_dimensions( $size );

            $value = array(
                'width'		=> $width,
                'height' 	=> $height,
            );

            // Apply custom filters
            $value = apply_filters( 'g1_shortcode_placeholder_size', $value, $size );

            $width = $value[ 'width' ];
            $height = $value[ 'height' ];
        }
        $width = absint( $width );
        $width = $width ? $width : 1;

        $height = absint( $height );
        $height = $height ? $height : 1;

        if ( $height == 9999 ) {
            $height = absint(round( $width * (9/16) ));
        }

        $icon = strlen( $icon ) ? '<i class="' . g1_get_font_awesome_icon_class( $icon ) . '"></i>' : '';


        $out =  '<span ' .
                    'id="' . esc_attr( $final_id) . '" ' .
                    'class="' . sanitize_html_classes( $final_class ) . '" ' .
                    'style="width:' . $width . 'px;" ' .
                '>'.
                    '<span class="g1-inner" style="padding-bottom:' . $height/$width * 100 . '%;">' .
                    '</span>' .
                    $icon .
                '</span>';


        return $out;
    }
}
function G1_Placeholder_Shortcode() {
    static $instance = null;

    if ( null === $instance )
        $instance = new G1_Placeholder_Shortcode( 'placeholder' );

    return $instance;
}
// Fire in the hole :)
G1_Placeholder_Shortcode();



class G1_Frame_Shortcode extends G1_Shortcode {
    public function __construct( $id, $args = array() ) {
        parent::__construct( $id, $args );

        // content
        $this->set_content( 'content', array(
            'form_control' => 'Long_Text',
        ));

        $this->set_type( 'inline' );

        add_action( 'g1_shortcode_generator_register', array( $this, 'add_shortcode_generator_item' ) );
    }

    /**
     * Add shortcode to the global shortcode generator
     *
     * @param  G1_Shortcode_Generator $generator
     */
    public function add_shortcode_generator_item( $generator ) {
        $generator->add_item( $this, 'basic' );
    }

    protected function load_attributes() {
        // linking attribute
        $this->add_attribute( 'linking', array(
            'form_control' => 'Choice',
            'choices'	   => array(
                'new_window' => 'new_window',
                'lightbox' => 'lightbox',
                'default' => 'default',
            ),
            'value_aliases' => array(
                'new_window' => 'new_window',
                'new-window' => 'new_window',
                'default' => 'default',
                'standard' => 'default',
            ),
        ));

        // link attribute
        $this->add_attribute( 'link', array(
            'form_control' => 'Text',
            'id_aliases' => array(
                'href',
                'url',
            ),
            'hint' => __( 'The destination to which the link leads', 'g1_theme' ),
        ));

        // lightbox_group attribute
        $this->add_attribute( 'lightbox_group', array(
            'form_control' => 'Text',
            'id_aliases' => array(
                'lightboxgroup',
                'lightbox-group',
                'lightbox',
            ),
            'hint'			=> __( 'Fill in this field, if you want different elements to be in one gallery', 'g1_theme' ),
        ));

        // align attribute
        $this->add_attribute( 'align', array(
            'form_control' => 'Choice',
            'default'      => 'center',
            'choices'	   => array(
                'left' => 'left',
                'center' => 'center',
                'right' => 'right',
            ),
        ));

        // style attribute
        $this->add_attribute( 'style', array(
            'form_control' => 'Choice',
            'default' => 'none',
            'choices' => array(
                'none'      => 'none',
                'simple'    => 'simple',
            ),
            'value_aliases' => array(
                '' => 'none',
            ),
        ));

        // shape attribute
        $this->add_attribute( 'shape', array(
            'form_control' => 'Choice',
            'default' => 'inherit',
            'choices' => array(
                'inherit'   => 'inherit',
                'square'    => 'square',
                'circle'    => 'circle',
            ),
            'value_aliases' => array(
                '' => 'inherit',
            ),
        ));

        // title attribute
        $this->add_attribute( 'title', array(
            'form_control' => 'Text',
        ));
    }

    /**
     * Shortcode callback function.
     *
     * @return string
     */
    protected function do_shortcode() {
        extract( $this->extract() );

        $is_link = strlen( $link ) ? true : false;
        $rel = '';
        $indicator = '';

        // Compose final HTML id attribute
        $final_id = strlen( $id ) ? $id : 'g1-frame-' . $this->get_counter();

        // Compose final HTML class attribute
        $final_class = array(
            'g1-frame',
            'g1-frame--' . $style,
            'g1-frame--' . $shape,
            'g1-frame--' . $align,
        );

        $final_class = array_merge( $final_class, explode( ' ', $class ) );

        // Process the linking attribute
        switch( $linking ) {
            case 'new_window':
                $final_class[] = 'g1-new-window ';
                $indicator = do_shortcode('[indicator type="new-window"]');
                break;

            case 'lightbox':
                $rel = strlen( $lightbox_group) ? $lightbox_group : 'single';
                $indicator = do_shortcode('[indicator type="zoom"]');
                break;

            case 'default':
            default:
                $indicator = do_shortcode('[indicator type="document"]');
                break;
        }

        // Compose the template
        $out =	'<%tag%%href%%id%%class%%rel%%title%><span class="g1-decorator">' . "\n" .
            "\t\t\t\t" . '%content%' .  "\n" .
            "\t\t\t\t" . '%indicator%' .  "\n" .
            '</span></%tag%>';

        // Fill in the template
        $out = str_replace(
            array(
                '%tag%',
                '%href%',
                '%id%',
                '%class%',
                '%rel%',
                '%title%',
                '%content%',
                '%indicator%',
            ),
            array(
                $is_link ? 'a' : 'span',
                $is_link ? ' href="' . esc_url( $link ) . '"' : '',
                ' id="' . esc_attr( $final_id ) . '"',
                ' class="' . sanitize_html_classes( $final_class ) . '"',
                strlen( $rel ) ? ' data-g1-lightbox="' . esc_attr( $rel ) . '"' : '',
                strlen( $title ) ? ' title="' . esc_attr( $title ) . '"' : '',
                do_shortcode( $content ),
                $indicator,
            ),
            $out
        );

        return $out;
    }

}
function G1_Frame_Shortcode() {
    static $instance = null;

    if ( null === $instance )
        $instance = new G1_Frame_Shortcode( 'frame' );

    return $instance;
}
// Fire in the hole :)
G1_Frame_Shortcode();




class G1_Fluid_Wrapper_Shortcode extends G1_Shortcode {
    public function __construct( $id, $args = array() ) {
        parent::__construct( $id, $args );

        // content
        $this->set_content( 'content', array(
            'form_control' => 'Long_Text',
        ));

        add_action( 'g1_shortcode_generator_register', array( $this, 'add_shortcode_generator_item' ) );
    }

    /**
     * Add shortcode to the global shortcode generator
     *
     * @param G1_Shortcode_Generator $generator
     */
    public function add_shortcode_generator_item( $generator ) {
        $generator->add_item( $this, 'basic' );
    }

    protected function load_attributes() {
        // width attribute
        $this->add_attribute( 'width', array(
            'form_control' => 'Text',
        ));

        // height
        $this->add_attribute( 'height', array(
            'form_control' => 'Text',
        ));
    }

    /**
     * Shortcode callback function.
     *
     * @return string
     */
    protected function do_shortcode() {
        extract( $this->extract() );

        $content = preg_replace('#^<\/p>|<p>$#', '', $content);

        // Compose final HTML id attribute
        $final_id = strlen( $id ) ? $id : 'fluid-wrapper-counter-' . $this->get_counter();

        // Compose final HTML class attribute
        $final_class = array(
            'g1-fluid-wrapper',
        );

        $final_class = array_merge( $final_class, explode( ' ', $class ) );

        // Get width and height values
        $width = absint( $width );
        $height = absint( $height );

        if ( !$width ) {
            $re = '/width=[\'"]?(\d+)[\'"]?/';
            $width = preg_match($re, $content, $match);
            $width = $width ? absint($match[1]) : 0;
        }

        if ( !$height ) {
            $re = '/height=[\'"]?(\d+)[\'"]?/';
            $height = preg_match($re, $content, $match);
            $height = $height ? absint($match[1]) : 0;
        }

        $height = ( 9999 === $height ) ? round( $width*9/16 )  : $height;

        // Compose output
        $out = 	'<div id="%id%" class="%class%" %outer_style%>' .
                    '<div %inner_style%>' .
                        '%content%' .
                    '</div>' .
                '</div>';
        $out = str_replace(
            array(
                '%id%',
                '%class%',
                '%outer_style%',
                '%inner_style%',
                '%content%',
            ),
            array(
                esc_attr( $final_id ),
                sanitize_html_classes( $final_class ),
                ( $width && $height ? 'style="width:' . absint($width).  'px;"' : '' ),
                ( $width && $height ? 'style="padding-bottom:' . ( absint($height) / absint( $width ) ) * 100 . '%;"' : '' ),
                do_shortcode(shortcode_unautop($content))
            ),
            $out
        );

        return $out;
    }
}
function G1_Fluid_Wrapper_Shortcode() {
    static $instance = null;

    if ( null === $instance )
        $instance = new G1_Fluid_Wrapper_Shortcode( 'fluid_wrapper' );

    return $instance;
}
// Fire in the hole :)
G1_Fluid_Wrapper_Shortcode();


function g1_shortcode_fluid_wrapper_embed_oembed_html( $html, $url, $attr ) {
    return do_shortcode( '[fluid_wrapper width="'. esc_attr( $attr['width'] ) .'" height="'. esc_attr( $attr['height'] ) .'"]' . $html . '[/fluid_wrapper]');
}
add_filter( 'embed_oembed_html', 'g1_shortcode_fluid_wrapper_embed_oembed_html', 10, 999 );





/**
 * [indicator] shortcode callback function.
 * 
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function g1_shortcode_indicator( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'type'			=> 'document',
		), $atts ) );
	
	/* Compose output */
	$out = '<span class="g1-indicator g1-indicator-' . sanitize_html_class( $type ) . '"></span>';
	
	return $out;
}
add_shortcode( 'indicator', 'g1_shortcode_indicator' );


/**
 * [clear] shortcode callback function.
 *
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function g1_shortcode_clear( $atts, $content = null ) {
    return '<span class="clear"></span>';
}
add_shortcode( 'clear', 'g1_shortcode_clear' );




/**
 * [icons] shortcode callback function.
 *
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function g1_shortcode_icons( $atts, $content = null ) {
    $out = '';

    foreach ( g1_get_font_awesome() as $code => $name ) {
        $out .= '<li><i class="fa ' . sanitize_html_class( 'fa- ' . $name ) . '"></i></li>';
    }

    $out =  '<ul class="g1-icon-listing">' .
                $out .
            '</ul>';

    return $out;
}
add_shortcode( 'icons', 'g1_shortcode_icons' );





class G1_Icon_Shortcode extends G1_Shortcode {
    public function __construct( $id, $args = array() ) {
        parent::__construct( $id, $args );

        $this->set_type( 'inline' );

        add_action( 'g1_shortcode_generator_register', array( $this, 'add_shortcode_generator_item' ) );
    }

    /**
     * Add shortcode to the global shortcode generator
     *
     * @param       G1_Shortcode_Generator $generator
     */
    public function add_shortcode_generator_item( $generator ) {
        $generator->add_item( $this, 'basic' );
    }

    protected function load_attributes() {
        // icon attribute
        $this->add_attribute( 'icon', array(
            'form_control' => 'Choice',
            'default'      => 'globe',
            'choices_cb'   => 'g1_get_font_awesome',
            'id_aliases'    => array(
                'name',
            )
        ));

        // size attribute
        $this->add_attribute( 'size', array(
            'form_control'  => 'Choice',
            'default'       => 'small',
            'choices'	    => array(
                'small'     => 'small',
                'medium'    => 'medium',
                'big'       => 'big',
            ),
        ));


        // style attribute
        $this->add_attribute( 'style', array(
            'form_control' => 'Choice',
            'default'      => 'solid',
            'choices'	   => array(
                'none' 		    => 'none',
                'simple' 		=> 'simple',
                'solid'			=> 'solid',
            ),
        ));

        // shape attribute
        $this->add_attribute( 'shape', array(
            'form_control' => 'Choice',
            'default'      => 'inherit',
            'choices'	   => array(
                'inherit' 		=> 'inherit',
                'square' 		=> 'square',
                'circle'		=> 'circle',
            ),
        ));

        // text color attribute
        $this->add_attribute( 'text_color', array(
            'form_control' => 'Color',
            'id_aliases' => array(
                'icon_text_color',
            ),
        ));

        // text color attribute
        $this->add_attribute( 'bg_color', array(
            'form_control' => 'Color',
            'id_aliases' => array(
                'icon_bg_color',
            ),
        ));
    }

    /**
     * Shortcode callback function.
     *
     * @return string
     */
    protected function do_shortcode() {
        extract( $this->extract() );

        // Compose final HTML id attribute
        $final_id = strlen( $id ) ? $id : 'icon-' . $this->get_counter();

        // Compose final HTML class attribute
        $final_class = array(
            'g1-icon',
            'g1-icon--' . $style,
            'g1-icon--' . $size,
            'g1-icon--' . $shape,
        );

        $final_class = array_merge( $final_class, explode( ' ', $class ) );
        $final_class = array_map( 'sanitize_html_class', $final_class );

        $final_class[] = g1_get_font_awesome_icon_class( $icon );

        // Compose CSS rules for custom styling
        $css_rules = array();

        if ( strlen( $text_color ) ) {
            $color_obj = new G1_Color($text_color);
            $css_rules[] = 'color: #' . $color_obj->get_hex() . ';';
        }

        if ( strlen( $bg_color ) ) {
            $color_obj = new G1_Color($bg_color);
            $css_rules[] = 'background-color: #' . $color_obj->get_hex() . ';';
            $css_rules[] = 'border-color: #' . $color_obj->get_hex() . ';';
        }

        $css = '';
        if ( count( $css_rules ) ) {
            $css = '<style type="text/css" scoped="scoped">' .
                        '#' . esc_attr($final_id) . '.g1-icon { ' . implode( ' ', $css_rules ) . ' }' .
                    '</style>' . "\n";
        }

        // Compose the template
        $out =  '%css%' .
                '<i id="%id%" class="%class%">' .
                '</i>' ;

        // Fill in the template
        $out = str_replace(
            array(
                '%css%',
                '%id%',
                '%class%',
            ),
            array(
                $css,
                esc_attr( $final_id ),
                implode( ' ', $final_class ),
            ),
            $out
        );

        return $out;
    }
}
function G1_Icon_Shortcode() {
    static $instance = null;

    if ( null === $instance )
        $instance = new G1_Icon_Shortcode( 'icon' );

    return $instance;
}
// Fire in the hole :)
G1_Icon_Shortcode();


class G1_Numbers_Shortcode extends G1_Shortcode {
    public function __construct( $id, $args = array() ) {
        parent::__construct( $id, $args );

        // content
        $this->set_content( 'content', array(
            'form_control' => 'Long_Text',
        ));

        add_action( 'g1_shortcode_generator_register', array( $this, 'add_shortcode_generator_item' ) );
    }

    /**
     * Add shortcode to the global shortcode generator
     *
     * @param       G1_Shortcode_Generator $generator
     */
    public function add_shortcode_generator_item( $generator ) {
        $generator->add_item( $this, 'basic' );
    }

    protected function load_attributes() {
        // size attribute
        $this->add_attribute( 'size', array(
            'form_control'  => 'Choice',
            'default'       => 'small',
            'choices'	    => array(
                'small'     => 'small',
                'medium'    => 'medium',
                'big'       => 'big',
            ),
        ));

        $this->add_attribute( 'text_color', array(
            'form_control' => 'Color',
            'id_aliases' => array(
                'textcolor',
                'text-color',
                'color',
            ),
            'hint' => __( 'Text Color', 'g1_theme' ),
        ));

        // bg_color attribute
        $this->add_attribute( 'bg_color', array(
            'form_control' => 'Color',
            'id_aliases' => array(
                'bgcolor',
                'bg-color',
                'background_color',
                'backgroundcolor',
                'background-color',
                'background',
            ),
            'hint' => __( 'Background Color', 'g1_theme' ),
        ));

        $this->add_attribute( 'start', array(
            'form_control' => 'Text',
            'default'   => 0,
            'id_aliases' => array(
                'init',
                'initial',
                'begin',
            ),
            'hint' => __( 'Initial value', 'g1_theme' ),
        ));

        $this->add_attribute( 'stop', array(
            'form_control' => 'Text',
            'default' => 100,
            'id_aliases' => array(
                'final',
                'end',
            ),
            'hint' => __( 'Final value', 'g1_theme' ),
        ));

        $this->add_attribute( 'icon', array(
            'form_control' => 'Choice',
            'default'      => '',
            'choices_cb'   => 'g1_get_font_awesome',
        ));

        $this->add_attribute( 'prefix', array(
            'form_control' => 'Text',
            'hint' => __( 'Put some value before', 'g1_theme' ),
        ));

        $this->add_attribute( 'suffix', array(
            'form_control' => 'Text',
            'hint' => __( 'Put some value after', 'g1_theme' ),
        ));
    }

    /**
     * Shortcode callback function.
     *
     * @return string
     */
    protected function do_shortcode() {
        extract( $this->extract() );

        $stop = apply_filters( 'g1_dynamic_numeric_value', $stop );

        $content = preg_replace('#^<\/p>|<p>$#', '', $content);
        if ( strlen( $content ) ) {
            $content =
                '<div class="g1-numbers__description">' .
                    $content .
                '</div>';
        }

        // Compose final HTML id attribute
        $final_id = strlen( $id ) ? $id : 'numbers-counter-' . $this->get_counter();

        // Compose final HTML class attribute
        $final_class = array(
            'g1-numbers',
            'g1-numbers--' . $size,
        );

        $final_class = array_merge( $final_class, explode( ' ', $class ) );

        if ( strlen( $icon ) ) {
            $icon = '<i class="' . g1_get_font_awesome_icon_class( $icon ) . ' g1-numbers__icon"></i>';

            $final_class[] = 'g1-numbers--icon';
        } else {
            $final_class[] = 'g1-numbers--noicon';
        }


        // Compose CSS
        $css = '';

        if ( strlen( $text_color ) ) {
            $color = new G1_Color($text_color);
            $css .= '#' . esc_attr( $final_id ) . ' .g1-numbers__title { color:#' . $color->get_hex() . '; }';
            $css .= '#' . esc_attr( $final_id ) . ' .g1-numbers__description { color:#' . $color->get_hex() . '; }';
        }

        if ( strlen( $bg_color ) ) {
            $color = new G1_Color($bg_color);
            $css .= '#' . esc_attr( $final_id ) . ' .g1-numbers__icon { color:#' . $color->get_hex() . '; }';
        }

        if ( strlen( $css ) ) {
            $css = '<style type="text/css" scoped="scoped">' .
                        $css .
                    '</style>';
        }

        // Compose the template
        $data = array(
            'data-g1-start="%start%"',
            'data-g1-stop="%stop%"',
        );

        $out =  '%css%' .
                '<div id="%id%" class="%class%" '.implode(' ', $data).'>' .
                    '%icon%' .
                    '<div class="g1-numbers__title">' .
                        '%prefix%<span>%stop%</span>%suffix%' .
                    '</div>' .
                    '%content%' .
                '</div>' ;

        // Fill in the template
        $out = str_replace(
            array(
                '%css%',
                '%id%',
                '%class%',
                '%start%',
                '%stop%',
                '%icon%',
                '%prefix%',
                '%stop%',
                '%suffix%',
                '%content%',
            ),
            array(
                $css,
                esc_attr( $final_id ),
                sanitize_html_classes( $final_class ),
                esc_attr( $start ),
                esc_attr( $stop ),
                $icon,
                esc_attr( $prefix ),
                absint( $stop  ),
                esc_attr( $suffix ),
                $content,
            ),
            $out
        );

        return $out;
    }
}
function G1_Numbers_Shortcode() {
    static $instance = null;

    if ( null === $instance )
        $instance = new G1_Numbers_Shortcode( 'numbers' );

    return $instance;
}
// Fire in the hole :)
G1_Numbers_Shortcode();

class G1_Duplicator_Shortcode extends G1_Shortcode {
    public function __construct( $id, $args = array() ) {
        parent::__construct( $id, $args );

        $this->set_type( 'inline' );

        add_action( 'g1_shortcode_generator_register', array( $this, 'add_shortcode_generator_item' ) );
    }

    /**
     * Add shortcode to the global shortcode generator
     *
     * @param       G1_Shortcode_Generator $generator
     */
    public function add_shortcode_generator_item( $generator ) {
        $generator->add_item( $this, 'basic' );
    }

    protected function load_attributes() {
        $this->add_attribute( 'icon', array(
            'form_control' => 'Choice',
            'default'      => 'heart',
            'choices_cb'   => 'g1_get_font_awesome',
        ));

        $this->add_attribute( 'start', array(
            'form_control' => 'Text',
            'default' => 0,
            'id_aliases' => array(
                'init',
                'initial',
                'begin',
            ),
            'hint' => __( 'Elements at index lower than "start" are visible all time', 'g1_theme' ),
        ));

        $this->add_attribute( 'stop', array(
            'form_control' => 'Text',
            'default' => 15,
            'id_aliases' => array(
                'final',
                'end',
            ),
            'hint' => __( 'Stop animation at this index', 'g1_theme' ),
        ));

        $this->add_attribute( 'max', array(
            'form_control' => 'Text',
            'default' => 20,
            'id_aliases' => array(
                'maximum',
            ),
            'hint' => __( 'Max. amount of elements to show', 'g1_theme' ),
        ));


        $this->add_attribute( 'direction', array(
            'form_control'  => 'Choice',
            'default'      => 'right',
            'choices'	   => array(
                'right' => __('Right', 'g1_theme'),
                'left'  => __('Left', 'g1_theme'),
            ),
        ));

        $this->add_attribute( 'style', array(
            'form_control'  => 'Choice',
            'default'      => 'solid',
            'choices'	   => array(
                'simple' => 'simple',
                'solid'  => 'solid',
            ),
        ));

        // color attribute
        $this->add_attribute( 'color', array(
            'form_control' => 'Color',
            'hint' => __( 'Color', 'g1_theme' ),
        ));
    }

    /**
     * Shortcode callback function.
     *
     * @return string
     */
    protected function do_shortcode() {
        extract( $this->extract() );

        $step = 1;
        $delay = 0;
        $duration = 1500;

        // Compose final HTML id attribute
        $final_id = strlen( $id ) ? $id : 'duplicator-counter-' . $this->get_counter();

        // Compose final HTML class attribute
        $final_class = array(
            'g1-duplicator',
            'g1-duplicator--' . $style,
            'g1-duplicator--' . $direction,
        );

        $final_class = array_merge( $final_class, explode( ' ', $class ) );


        // Compose custom CSS rules
        $css = '';
        if ( strlen( $color ) ) {
            $color = new G1_Color( $color );

            $css .= '#' . esc_attr( $final_id ) . '.g1-duplicator .g1-duplicate--active i { color:#' . $color->get_hex() . '; }';
        }
        $css = strlen( $css ) ? "\n" . '<style type="text/css" scoped="scoped">' . $css . '</style>' . "\n" : '';

        $content = '<i class="' . g1_get_font_awesome_icon_class( $icon ) . '"></i>';

        // Compose the template
        $data = array(
            'data-g1-start="%start%"',
            'data-g1-stop="%stop%"',
            'data-g1-max="%max%"',
            'data-g1-step="%step%"'
        );

        if ( strlen( $delay ) ) {
            $data[] = 'data-g1-delay="' . esc_attr( $delay ) . '"';
        }

        $out =  '%CSS%<span id="%id%" class="%class%" '.implode(' ', $data).'>%content%</span>' ;


        // Fill in the template
        $out = str_replace(
            array(
                '%CSS%',
                '%id%',
                '%class%',
                '%start%',
                '%stop%',
                '%max%',
                '%step%',
                '%duration%',
                '%content%',
            ),
            array(
                $css,
                esc_attr( $final_id ),
                sanitize_html_classes( $final_class ),
                esc_attr( $start ),
                esc_attr( $stop ),
                esc_attr( $max ),
                esc_attr( $step ),
                esc_attr( $duration ),
                do_shortcode(shortcode_unautop( $content )),
            ),
            $out
        );

        return $out;
    }
}
function G1_Duplicator_Shortcode() {
    static $instance = null;

    if ( null === $instance )
        $instance = new G1_Duplicator_Shortcode( 'duplicator' );

    return $instance;
}
// Fire in the hole :)
G1_Duplicator_Shortcode();



class G1_Quote_Shortcode extends G1_Shortcode {
    public function __construct( $id, $args = array() ) {
        parent::__construct( $id, $args );

        // content
        $this->set_content( 'content', array(
            'form_control' => 'Text',
        ));

        add_action( 'g1_shortcode_generator_register', array( $this, 'add_shortcode_generator_item' ) );
    }

    /**
     * Add shortcode to the global shortcode generator
     *
     * @param G1_Shortcode_Generator $generator
     */
    public function add_shortcode_generator_item( $generator ) {
        $generator->add_item( $this, 'basic' );
    }

    protected function load_attributes() {
        // author_name attribute
        $this->add_attribute( 'author_name', array(
            'form_control' => 'Text',
            'id_aliases' => array(
                'author',
                'name',
                'authorname',
                'author-name',
            ),
        ));

        // author_description attribute
        $this->add_attribute( 'author_description', array(
            'form_control' => 'Text',
            'id_aliases' => array(
                'authordescription',
                'author-description',
                'description',
            ),
        ));

        // author_image
        $this->add_attribute( 'author_image', array(
            'form_control' => 'Text',
            'id_aliases' => array(
                'authorimage',
                'author-image',
                'image',
                'img',
            ),
        ));

        // size attribute
        $this->add_attribute( 'size', array(
            'form_control' => 'Choice',
            'default'      => 'small',
            'choices'	   => array(
                'small' 		=> 'small',
                'medium'		=> 'medium',
                'big'		    => 'big',
            ),
        ));

        // style attribute
        $this->add_attribute( 'style', array(
            'form_control' => 'Choice',
            'choices'	   => array(
                'none' 		    => 'none',
                'simple'		=> 'simple',
                'solid'			=> 'solid',
            ),
            'default'       => 'simple'
        ));
    }

    /**
     * Shortcode callback function.
     *
     * @return string
     */
    protected function do_shortcode() {
        extract( $this->extract() );

        $content = preg_replace('#^<\/p>|<p>$#', '', $content);

        // Compose final HTML id attribute
        $final_id = strlen( $id ) ? $id : 'g1-quote-' . $this->get_counter();

        // Compose final HTML class attribute
        $final_class = array(
            'g1-quote',
            'g1-quote--' . $style,
            'g1-quote--' . $size,
        );

        $final_class = array_merge( $final_class, explode( ' ', $class ) );

        $image_size = apply_filters( 'g1_quote_author_image_size', array( 'width' => 40, 'height' => 40 ) );

        $width = $image_size['width'];
        $height= $image_size['height'];

        if ( strlen( $author_image ) ) {
            $author_image = sprintf( '<img src="%s" width="%d" height="%d" alt="%s"/>',
                esc_url( $author_image ),
                $width,
                $height,
                esc_attr('Author\'s image' )
            );
        } else {
            $author_image = '<span class="g1-quote__image"></span>';
        }

        if ( strlen( $author_name ) ) {
            $author_name = '<strong>' . esc_html( $author_name ) . '</strong>';
        }

        if ( strlen( $author_description ) ) {
            $author_description = '<span>' . esc_html( $author_description ) . '</span>';
        }

        $figcaption = '';
        if ( $author_image || $author_name || $author_description ) {
            $figcaption =
                '<figcaption class="g1-meta">' .
                    $author_image .
                    $author_name .
                    $author_description .
                '</figcaption>';
        }

        // Compose the template
        $out = 	'<figure %id%%class%>' .
                    '<div class="g1-inner">' .
                        '%content%' .
                    '</div>' .
                    '%figcaption%' .
                '</figure>';

        // Fill in the template
        $out = str_replace(
            array(
                '%id%',
                '%class%',
                '%content%',
                '%figcaption%',
            ),
            array(
                strlen( $final_id ) ? 'id="' . esc_attr( $final_id ) . '" ' : '',
                count( $final_class ) ? 'class="' . sanitize_html_classes( $final_class ) . '" ' : '',
                do_shortcode( $content ),
                $figcaption
            ),
            $out
        );


        return $out;
    }
}
function G1_Quote_Shortcode() {
    static $instance = null;

    if ( null === $instance )
        $instance = new G1_Quote_Shortcode( 'quote' );

    return $instance;
}
// Fire in the hole :)
G1_Quote_Shortcode();

