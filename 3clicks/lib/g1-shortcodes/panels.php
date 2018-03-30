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
 * Add "panels" section to the global shortcode generator
 *
 * @param       G1_Shortcode_Generator $generator
 */
function g1_shortgen_section_panels( $generator ) {
    $generator->add_section( 'panels', array(
        'label' => __( 'Panels', 'g1_theme' ),
    ));
}
add_action( 'g1_shortcode_generator_register', 'g1_shortgen_section_panels', 9 );



class G1_Toggle_Shortcode extends G1_Shortcode {
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
        $generator->add_item( $this, 'panels' );
    }

    protected function load_attributes() {
        // title
        $this->add_attribute( 'title', array(
            'form_control' => 'Text',
        ));

        // on attribute
        $this->add_attribute( 'state', array(
            'form_control' => 'Choice',
            'choices'	   => array(
                'on' 		=> 'on',
                'off'	    => 'off',
            ),
            'default'       => 'off',
        ));

        // style attribute
        $this->add_attribute( 'style', array(
            'form_control' => 'Choice',
            'choices'	   => array(
                'simple' 	=> 'simple',
                'solid'	    => 'solid',
            ),
            'default'       => 'solid',
        ));

        // icon attribute
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
        $final_id = strlen( $id ) ? $id : 'g1-toggle-counter-' . $this->get_counter();

        // Compose final HTML class attribute
        $final_class = array(
            'g1-toggle',
            'g1-toggle--' . $state,
            'g1-toggle--' . $style,
        );

        if ( strlen( $icon ) ) {
            $icon = '<i class="fa fa-' . sanitize_html_class( g1_map_font_awesome( $icon ) ) . '"></i>';
            $final_class[] = 'g1-toggle--icon';
        } else {
            $final_class[] = 'g1-toggle--noicon';
        }

        $final_class = array_merge( $final_class, explode( ' ', $class ) );

        // Compose the template
        $out = 	'<div %id%%class%>' .
            '<div class="g1-toggle__title">%icon%%title%</div>' .
            '<div class="g1-toggle__content"><div class="g1-block">%content%</div></div>' .
            '</div>';

        //Fill in the template
        $out = str_replace(
            array(
                '%id%',
                '%class%',
                '%icon%',
                '%title%',
                '%content%',
            ),
            array(
                strlen( $final_id ) ? 'id="' . esc_attr( $final_id ) . '" ' : '',
                count( $final_class ) ? 'class="' . sanitize_html_classes( $final_class ) . '" ' : '',
                $icon,
                $title,
                do_shortcode( shortcode_unautop( $content ) ),
            ),
            $out
        );

        return $out;
    }
}
function G1_Toggle_Shortcode() {
    static $instance = null;

    if ( !isset( $instance ) )
        $instance = new G1_Toggle_Shortcode( 'toggle' );

    return $instance;
}
// Fire in the hole :)
G1_Toggle_Shortcode();



class G1_Tabs_Shortcode extends G1_Shortcode {
    /**
     * @todo What about the commented description?
     */
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
        $generator->add_item( $this, 'panels' );
    }

    protected function load_attributes() {
        // position attribute
        $this->add_attribute( 'position', array(
            'form_control' => 'Choice',
            'choices'	   => array(
                'top-left' 		=> 'top-left',
                'top-center'	=> 'top-center',
                'top-right'		=> 'top-right',
                'bottom-left'	=> 'bottom-left',
                'bottom-center'	=> 'bottom-center',
                'bottom-right'	=> 'bottom-right',
                'left-top' 		=> 'left-top',
                'right-top' 	=> 'right-top',
            ),
        ));

        // style attribute
        $this->add_attribute( 'style', array(
            'form_control' => 'Choice',
            'default'      => 'simple',
            'choices'	   => array(
                'simple' 		=> 'simple',
                'button'		=> 'button',
                'transparent'	=> 'transparent',
            ),
        ));

        // type attribute
        $this->add_attribute( 'type', array(
            'form_control' => 'Choice',
            'default'      => 'click',
            'choices'	   => array(
                'click'     => 'change tab on click',
                'hover'		=> 'change tab on hover',
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
        $final_id = strlen( $id ) ? $id : 'g1-tabs-' . $this->get_counter();


        // Compose final HTML class attribute
        $final_class = array(
            'g1-tabs',
            'g1-tabs--' . sanitize_html_class( $style ),
            'g1-type--' . sanitize_html_class( $type ),
        );

        switch ( $position ) {
            case 'top-left':
            case 'top_left':
                $final_class[] = 'g1-tabs--horizontal';
                $final_class[] = 'g1-tabs--top';
                $final_class[] = 'g1-align-left';
                break;

            case 'top-center':
            case 'top_center':
                $final_class[] = 'g1-tabs--horizontal';
                $final_class[] = 'g1-tabs--top';
                $final_class[] = 'g1-align-center';
                break;

            case 'top-right':
            case 'top_right':
                $final_class[] = 'g1-tabs--horizontal';
                $final_class[] = 'g1-tabs--top';
                $final_class[] = 'g1-align-right';
                break;

            case 'bottom-left':
            case 'bottom_left':
                $final_class[] = 'g1-tabs--horizontal';
                $final_class[] = 'g1-tabs--bottom';
                $final_class[] = 'g1-align-left';
                break;

            case 'bottom-center':
            case 'bottom_center':
                $final_class[] = 'g1-tabs--horizontal';
                $final_class[] = 'g1-tabs--bottom';
                $final_class[] = 'g1-align-center';
                break;

            case 'bottom-right':
            case 'bottom_right':
                $final_class[] = 'g1-tabs--horizontal';
                $final_class[] = 'g1-tabs--bottom';
                $final_class[] = 'g1-align-right';
                break;

            case 'left-top':
            case 'left_top':
                $final_class[] = 'g1-tabs--vertical';
                $final_class[] = 'g1-tabs--left';
                $final_class[] = 'g1-align-top';
                break;

            case 'left_center':
            case 'left_center':
            case 'left_middle':
            case 'left_middle':
                $final_class[] = 'g1-tabs--vertical';
                $final_class[] = 'g1-tabs--left';
                $final_class[] = 'g1-align-middle';
                break;

            case 'left-bottom':
            case 'left_bottom':
                $final_class[] = 'g1-tabs--vertical';
                $final_class[] = 'g1-tabs--left';
                $final_class[] = 'g1-align-bottom';
                break;

            case 'right-top':
            case 'right_top':
                $final_class[] = 'g1-tabs--vertical';
                $final_class[] = 'g1-tabs--right';
                $final_class[] = 'g1-align-top';
                break;

            case 'right-center':
            case 'right_center':
            case 'right-middle':
            case 'right_middle':
                $final_class[] = 'g1-tabs--vertical';
                $final_class[] = 'g1-tabs--right';
                $final_class[] = 'g1-align-middle';
                break;

            case 'right-bottom':
            case 'right_bottom':
                $final_class[] = 'g1-tabs--vertical';
                $final_class[] = 'g1-tabs--right';
                $final_class[] = 'g1-align-bottom';
                break;
        }

        $final_class = array_merge( $final_class, explode( ' ', $class ) );

        // Compose output
        $out = '';


        $out .= '<div id="' . esc_attr( $final_id ) . '" class="' . sanitize_html_classes( $final_class ) . '">';
        $out .= do_shortcode( shortcode_unautop( $content ) );
        $out .= '</div>';

        return $out;
    }
}
function G1_Tabs_Shortcode() {
    static $instance = null;

    if ( null === $instance )
        $instance = new G1_Tabs_Shortcode( 'tabs' );

    return $instance;
}
// Fire in the hole :)
G1_Tabs_Shortcode();



class G1_Tab_Title_Shortcode extends G1_Shortcode {
    /**
     * @todo What about the commented description?
     */
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
        $generator->add_item( $this, 'panels' );
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
        $final_id = strlen( $id ) ? $id : 'tab-title-counter-' . $this->get_counter();

        // Compose final HTML class attribute
        $final_class = array(
            'g1-tab-title',
        );

        $final_class = array_merge( $final_class, explode( ' ', $class ) );

        // Compose output
        $out = '<div id="' . esc_attr( $final_id ) . '" class="' . sanitize_html_classes( $final_class ) . '">' .
                    do_shortcode( shortcode_unautop( $content ) ) .
               '</div>';


        return $out;
    }
}
function G1_Tab_Title_Shortcode() {
    static $instance = null;

    if ( null === $instance )
        $instance = new G1_Tab_Title_Shortcode( 'tab_title' );

    return $instance;
}
// Fire in the hole :)
G1_Tab_Title_Shortcode();



class G1_Tab_Content_Shortcode extends G1_Shortcode {
    /**
     * @todo What about the commented description?
     */
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
     * @param  G1_Shortcode_Generator $generator
     */
    public function add_shortcode_generator_item( $generator ) {
        $generator->add_item( $this, 'panels' );
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
        $final_id = strlen( $id ) ? $id : 'tab-content-counter-' . $this->get_counter();

        // Compose final HTML class attribute
        $final_class = array(
            'g1-tab-content',
        );

        $final_class = array_merge( $final_class, explode( ' ', $class ) );

        // Compose output
        $out = '<div id="' . esc_attr( $final_id ) . '" class="' . sanitize_html_classes( $final_class ) . '">' .
                    do_shortcode( shortcode_unautop( $content ) ) .
                '</div>';


        return $out;
    }
}
function G1_Tab_Content_Shortcode() {
    static $instance = null;

    if ( null === $instance )
        $instance = new G1_Tab_Content_Shortcode( 'tab_content' );

    return $instance;
}
// Fire in the hole :)
G1_Tab_Content_Shortcode();



/**
 * Add tabs snippets to the global shortcode generator
 *
 * @param       G1_Shortgen $shortgen
 */
function g1_shortgen_tabs_snippets( $shortgen ) {
$result = <<<G1_HEREDOC_DELIMITER
[tabs style="simple" position="top-left"]

[tab_title]Tab 1[/tab_title]

[tab_content]

here goes some tab content...

[/tab_content]

[tab_title]Tab 2[/tab_title]

[tab_content]

here goes some tab content...

[/tab_content]

[/tabs]
G1_HEREDOC_DELIMITER;

    // 2 tabs
    $shortgen->add_snippet( '*** 2 tabs', array(
        'label' => __('*** 2 tabs', 'g1_theme'),
        'result' => $result,
        'section' => 'panels',
    ));


$result = <<<G1_HEREDOC_DELIMITER
[tabs style="simple" position="top-left"]

[tab_title]Tab 1[/tab_title]

[tab_content]

here goes some tab content...

[/tab_content]

[tab_title]Tab 2[/tab_title]

[tab_content]

here goes some tab content...

[/tab_content]

[tab_title]Tab 3[/tab_title]

[tab_content]

here goes some tab content...

[/tab_content]

[/tabs]
G1_HEREDOC_DELIMITER;

    // 3 tabs
    $shortgen->add_snippet( '*** 3 tabs', array(
        'label' => __('*** 3 tabs', 'g1_theme'),
        'result' => $result,
        'section' => 'panels',
    ));


$result = <<<G1_HEREDOC_DELIMITER
[tabs style="simple" position="top-left"]

[tab_title]Tab 1[/tab_title]

[tab_content]

here goes some tab content...

[/tab_content]

[tab_title]Tab 2[/tab_title]

[tab_content]

here goes some tab content...

[/tab_content]

[tab_title]Tab 3[/tab_title]

[tab_content]

here goes some tab content...

[/tab_content]

[tab_title]Tab 4[/tab_title]

[tab_content]

here goes some tab content...

[/tab_content]

[/tabs]
G1_HEREDOC_DELIMITER;


    // 4 tabs
    $shortgen->add_snippet( '*** 4 tabs', array(
        'label' => __('*** 4 tabs', 'g1_theme'),
        'result' => $result,
        'section' => 'panels',
    ));
}
add_action( 'g1_shortcode_generator_register', 'g1_shortgen_tabs_snippets' );




class G1_Before_After_Shortcode extends G1_Shortcode {
    /**
     * Constructor
     */
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
        $generator->add_item( $this, 'panels' );
    }

    protected function load_attributes() {
        // type attribute
        $this->add_attribute( 'type', array(
            'form_control'  => 'Choice',
            'choices'	    => array(
                'smooth'    => __( 'Splitted image', 'g1_theme' ),
                'flip'	    => __( 'Flip image on click', 'g1_theme' ),
                'hover'	    => __( 'Change on hover', 'g1_theme' ),
            ),
            'default'       => 'smooth',
        ));

        // before_src attribute
        $this->add_attribute( 'before_src', array(
            'form_control' => 'Text',
            'id_aliases' => array(
                'before',
                'before_image',
                'before_path',
                'before_url',
            )
        ));

        // after_src attribute
        $this->add_attribute( 'after_src', array(
            'form_control' => 'Text',
            'id_aliases' => array(
                'after',
                'after_image',
                'after_path',
                'after_url',
            )
        ));

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
    }

    /**
     * shortcode callback function.
     *
     * @param 			array $atts
     * @param			string $content
     * @return			string
     */
    protected function do_shortcode() {
        extract( $this->extract() );

        $content = preg_replace('#^<\/p>|<p>$#', '', $content);

        $width = absint( $width );
        $height = absint( $height );

        // Compose final HTML id attribute
        $final_id = strlen( $id ) ? $id : 'g1-banda-' . $this->get_counter();

        // Compose final HTML class attribute
        $final_class = array(
            'g1-banda',
            'g1-banda--' . $type,
        );

        $final_class = array_merge( $final_class, explode( ' ', $class ) );

        // Compose output
        $out =	'<div id="%id%" class="%class%">' .
                    '[fluid_wrapper %width% %height%]' .
                        '<ol class="g1-banda__items">' .
                            '<li class="g1-banda__before"><img src="%before_src%" %width% %height% alt="%before_alt%" /></li>'.
                            '<li class="g1-banda__after"><img src="%after_src%" %width% %height% alt="%after_alt%" /></li>' .
                        '</ol>' .
                        '<div class="g1-banda__handle">' .
                            '<span></span>' .
                        '</div>' .
                    '[/fluid_wrapper]' .
                '</div>';

        $out = str_replace(
            array(
                '%id%',
                '%class%',
                '%width%',
                '%height%',
                '%before_src%',
                '%before_alt%',
                '%after_src%',
                '%after_alt%',
            ),
            array(
                esc_attr( $final_id ),
                sanitize_html_classes( $final_class ),
                ( $width ? 'width="' . absint( $width ) . '" ' : '' ),
                ( $height ? 'height="' . absint( $height ) . '" ' : '' ),
                esc_url( $before_src ),
                esc_attr( __( 'Before', 'g1_theme' ) ),
                esc_url( $after_src ),
                esc_attr( __( 'After', 'g1_theme' ) ),
            ),
            $out
        );

        $out = do_shortcode( shortcode_unautop( $out ) );


        return $out;
    }
}
function G1_Before_After_Shortcode() {
    static $instance = null;

    if ( null === $instance ) {
        $instance = new G1_Before_After_Shortcode( 'before_after', array( 'label' => 'Before & After' ) );
    }

    return $instance;
}
// Fire in the hole :)
G1_Before_After_Shortcode();






class G1_Section_Shortcode extends G1_Shortcode {
    /**
     * Constructor
     */
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
        $generator->add_item( $this, 'panels' );
    }

    protected function load_attributes() {
        // background color
        $this->add_attribute( 'background_color', array(
            'form_control' => 'Text',
            'hint' => __( 'In hex format, like #123456', 'g1_theme' ),
            'id_aliases' => array(
                'backgroundcolor',
                'backgroundColor',
                'bg_color',
                'bgcolor',
                'bgColor',
            )
        ));

        // background image
        $this->add_attribute( 'background_image', array(
            'form_control' => 'Text',
            'id_aliases' => array(
                'backgroundimage',
                'backgroundImage',
                'bg_image',
                'bgimage',
                'bgImage',
            )
        ));

        // background repeat
        $this->add_attribute( 'background_repeat', array(
            'form_control' => 'Choice',
            'default' => 'repeat',
            'choices' => array(
                'no-repeat'   => 'no-repeat',
                'repeat'      => 'repeat',
                'repeat-x'    => 'repeat-x',
                'repeat-y'    => 'repeat-y',
            ),
            'id_aliases' => array(
                'backgroundrepeat',
                'backgroundRepeat',
                'bg_repeat',
                'bgrepeat',
                'bgRepeat',
            )
        ));

        // background position
        $this->add_attribute( 'background_position', array(
            'form_control' => 'Choice',
            'default' => 'center top',
            'choices' => array(
                'left top'      => 'left top',
                'center top'    => 'center top',
                'right top'     => 'right top',
                'left bottom'   => 'left bottom',
                'center bottom' => 'center bottom',
                'right bottom'  => 'right bottom',
            ),
            'id_aliases' => array(
                'backgroundposition',
                'backgroundPosition',
                'bg_position',
                'bgposition',
                'bgPosition',
            )
        ));

        // background attachment
        $this->add_attribute( 'background_attachment', array(
            'form_control' => 'Choice',
            'default' => 'static',
            'choices' => array(
                'static'   => 'static',
                'fixed'    => 'fixed',
            ),
            'id_aliases' => array(
                'backgroundattachment',
                'backgroundAttachment',
                'bg_attachment',
                'bgattachment',
                'bgAttachment',
            )
        ));


        // background scroll
        $this->add_attribute( 'background_scroll', array(
            'form_control' => 'Choice',
            'default' => 'none',
            'choices' => array(
                'none'      => 'none',
                'standard'  => 'standard',
            ),
            'id_aliases' => array(
                'backgroundscroll',
                'backgroundScroll',
                'bg_scroll',
                'bgscroll',
                'bgScroll',
            )
        ));

        // border size
        $this->add_attribute( 'border_size', array(
            'form_control' => 'Text',
            'hint' => __( 'In pixels', 'g1_theme' ),
            'id_aliases' => array(
                'bordersize',
                'borderSize',
            )
        ));

        // padding bottom
        $this->add_attribute( 'padding_bottom', array(
            'form_control' => 'Text',
            'hint' => __( 'In pixels', 'g1_theme' ),
            'id_aliases' => array(
                'paddingbottom',
                'paddingBottom',
            )
        ));

        // padding top
        $this->add_attribute( 'padding_top', array(
            'form_control' => 'Text',
            'hint' => __( 'In pixels', 'g1_theme' ),
            'id_aliases' => array(
                'paddingtop',
                'paddingTop',
            )
        ));
    }

    /**
     * shortcode callback function.
     *
     * @param 			array $atts
     * @param			string $content
     * @return			string
     */
    protected function do_shortcode() {
        extract( $this->extract() );

        $content = preg_replace('#^<\/p>|<p>$#', '', $content);

        // Compose final HTML id attribute
        $final_id = strlen( $id ) ? $id : 'g1-section-' . $this->get_counter();

        // Compose final HTML class attribute
        $final_class = array(
            'g1-section',
        );

        if ( 'standard' === $background_scroll ) {
            $final_class[] = 'g1-section--scroll';
        }

        $final_class = array_merge( $final_class, explode( ' ', $class ) );

        // Compose custom CSS rules
        $css = '';
        $css_rules = array();

        if ( strlen( $background_color ) ) {
            $color = new G1_Color( $background_color );
            $css_rules[] = 'background-color: #' . $color->get_hex() . ';';
        }

        if ( strlen( $background_image ) ) {
            $css_rules[] = 'background-image:url(' . esc_url( $background_image ) .  ');';
        }

        if ( strlen( $background_repeat ) ) {
            $background_repeat = preg_replace( '/[^a-zA-Z -]*/', '', $background_repeat );
            $css_rules[] = 'background-repeat:' . $background_repeat . ';';
        }

        if ( strlen( $background_position ) ) {
            $background_position = preg_replace( '/[^a-zA-Z -]*/', '', $background_position );
            $css_rules[] = 'background-position:' . $background_position . ';';
        }

        if ( strlen( $background_attachment ) ) {
            $background_position = preg_replace( '/[^a-zA-Z -]*/', '', $background_attachment );
            $css_rules[] = 'background-attachment:' . $background_attachment . ';';
        }

        if ( strlen( $border_size ) ) {
            $css_rules[] = 'border-width:' . absint( $border_size ) . 'px 0;';
        }

        if ( strlen( $padding_bottom ) ) {
            $css_rules[] = 'padding-bottom:' . absint( $padding_bottom ) . 'px;';
        }

        if ( strlen( $padding_top ) ) {
            $css_rules[] = 'padding-top:' . absint( $padding_top ) . 'px;';
        }

        if ( count( $css_rules ) ) {
            $css = '<style type="text/css" scoped="scoped">' .
                '#' . esc_attr( $final_id ) . '.g1-section {' . implode( ' ', $css_rules ) . '}' .
                '</style>';
        }

        // Compose output
        $out =	'%css%' .
                '<div id="%id%" class="%class%">' .
                    '<div class="g1-layout-inner">' .
                        '%content%' .
                    '</div>' .
                '</div>';

        $out = str_replace(
            array(
                '%css%',
                '%id%',
                '%class%',
                '%content%',
            ),
            array(
                $css,
                esc_attr( $final_id ),
                sanitize_html_classes( $final_class ),
                do_shortcode( shortcode_unautop( $content ) ),
            ),
            $out
        );

        return $out;
    }
}
function G1_Section_Shortcode() {
    static $instance = null;

    if ( null === $instance ) {
        $instance = new G1_Section_Shortcode( 'section', array( 'label' => 'Section' ) );
    }

    return $instance;
}
// Fire in the hole :)
G1_Section_Shortcode();