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

add_shortcode( 'get_the_code', 'g1_shortcode_get_the_code' );

function g1_shortcode_get_the_code ( $atts, $content = null ) {
    $content = preg_replace('/<br\s*\/?>/', 'tag_br', $content);
    $content = str_replace('<p>', 'open_p', $content);
    $content = str_replace('</p>', 'close_p', $content);

    $content = htmlspecialchars($content);

    $find = array('tag_br', 'open_p', 'close_p');
    $replace = array('<br />', '<p>', '</p>');

    $content = str_replace($find, $replace, $content);

    $out = '';

    if ( !empty($atts['label']) && $atts['label'] !== 'false' ) {
        $out .= $atts['label'];
    }

    $out .= sprintf('<div class="g1-code">%s</div>', $content);

    return $out;
}


/**
 * Add "misc" section to the global shortcode generator
 *
 * @param       G1_Shortcode_Generator $generator
 */
function g1_shortgen_section_misc( $generator ) {
    $generator->add_section( 'misc', array(
        'label' => __( 'Misc', 'g1_theme' ),
        'priority' => 120,
    ));
}
add_action( 'g1_shortcode_generator_register', 'g1_shortgen_section_misc', 9 );



class G1_Audio_Shortcode extends G1_Shortcode {
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
        $generator->add_item( $this, 'misc' );
    }

    protected function load_attributes() {
        // title attribute
        $this->add_attribute( 'title', array(
            'form_control'  => 'Text',
            'hint'		    => __( 'The title of the audio file.', 'g1_theme' ),
        ));

        // mp3 attribute
        $this->add_attribute( 'mp3', array(
            'form_control'  => 'Text',
            'hint'			=> __( 'The source of the mp3 file', 'g1_theme' ),
        ));
    }

    /**
     * Enqueues javascripts required for the jPlayer to work
     */
    public function enqueue_scripts() {
        wp_enqueue_script('jplayer', get_template_directory_uri().'/js/jquery.jplayer/jquery.jplayer.min.js', array('jquery'));
        wp_print_scripts( 'jplayer' );
    }

    /**
     * Shortcode callback function.
     *
     * @return string
     */
    protected function do_shortcode() {
        extract( $this->extract() );

        // Compose final HTML id attribute
        $final_id = strlen( $id ) ? $id : 'media-audio-counter-' . $this->get_counter();

        // Compose final HTML class attribute
        $final_class = array(
            'media-audio',
        );

        $final_class = array_merge( $final_class, explode( ' ', $class ) );

        // Install jPlayer. Not every page needs to load additional javascrips
        add_action( 'wp_footer', array( $this, 'enqueue_scripts') );

        // Compose output
        $out = '';
        $out .= '<figure id="' . esc_attr( $final_id ) . '" class="' . sanitize_html_classes( $final_class ) . '">'."\n";
        $out .= '<audio src="' . esc_url( $mp3 ) .'">'."\n";
        $out .= '</audio>'."\n";
        if ( strlen( $title ) ) {
            $out .= '<figcaption>' . esc_html( $title ) . '</figcaption>'."\n";
        }
        $out .= '</figure>'."\n";

        return $out;

    }
}
function G1_Audio_Shortcode() {
    static $instance;

    if ( !isset( $instance ) )
        $instance = new G1_Audio_Shortcode( 'audio_player' );

    return $instance;
}
// Fire in the hole :)
G1_Audio_Shortcode();

class G1_Carousel_Shortcode extends G1_Shortcode {
    public function __construct( $id, $args = array() ) {
        parent::__construct( $id, $args );

        $this->set_content( 'content', array(
            'form_control' => 'Long_Text'
        ));

        $this->set_type( 'block' );

        add_action( 'g1_shortcode_generator_register', array( $this, 'add_shortcode_generator_item' ) );
    }

    /**
     * Add shortcode to the global shortcode generator
     *
     * @param G1_Shortcode_Generator $generator
     */
    public function add_shortcode_generator_item( $generator ) {
        $generator->add_item( $this, 'misc' );
    }

    protected function load_attributes() {
        // coin nav
        $this->add_attribute( 'coin_nav', array(
            'form_control'  => 'Choice',
            'id_aliases' => array(
                'coinnav',
                'coin-nav',
                'coin',
            ),
            'hint'		    => __( 'Enable Coin Navigation', 'g1_theme' ),
            'choices'       => array(
                'none'      => __( 'hide', 'g1_theme' ),
                'standard'  => __( 'show', 'g1_theme' ),
            )
        ));

        // direction nav
        $this->add_attribute( 'direction_nav', array(
            'form_control'  => 'Choice',
            'id_aliases' => array(
                'directionnav',
                'direction-nav',
                'direction',
            ),
            'hint'		    => __( 'Enable Next/Prev Navigation', 'g1_theme' ),
            'choices'       => array(
                'none'      => __( 'hide', 'g1_theme' ),
                'standard'  => __( 'show', 'g1_theme' ),
            )
        ));

        // autoplay
        $this->add_attribute( 'autoplay', array(
            'form_control'  => 'Choice',
            'id_aliases' => array(
                'autoplay',
                'auto',
            ),
            'choices'       => array(
                'standard'  => __( 'yes', 'g1_theme' ),
                'none'      => __( 'no', 'g1_theme' ),
            )
        ));

        $this->add_attribute( 'timeout', array(
            'form_control'  => 'Text',
            'hint'		    => __( 'The time carousel will pause between transitions (in miliseconds).', 'g1_theme' ),
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
        $final_id = strlen( $id ) ? $id : 'g1-html-rotator-counter-' . $this->get_counter();

        // Compose final HTML class attribute
        $final_class = array(
            'g1-html-rotator',
        );

        $final_class = array_merge( $final_class, explode( ' ', $class ) );

        $rotate_items = 1;

        if ( empty( $timeout ) ) {
            $timeout = 3000;
        }

        $content = preg_replace('#^<\/p>|<p>$#', '', $content);

        $content = do_shortcode( shortcode_unautop( $content ) );

        $content = '<div class="g1-carousel-content"><ul class="g1-carousel-items">' . $content . '</ul></div>';

        $out = '';
        $toolbar = '';

        if ( $coin_nav === 'standard' ) {
            $toolbar .= '<ol class="g1-nav-coin"></ol>';
        }

        if ( $direction_nav === 'standard' ) {
            $toolbar .=
                '<div class="g1-nav-direction">'.
                    '<div class="g1-nav-direction__prev"></div>'.
                    '<div class="g1-nav-direction__next"></div>'.
                '</div>';
        }

        if ( $autoplay === 'standard' ) {
            $final_class[] = 'g1-autoplay';
        }

        if ( strlen($toolbar) > 0 ) {
            $toolbar = '<div class="g1-toolbar">' . $toolbar . '</div>';
        }

        if( !empty( $content ) && $rotate_items > 0 ) {
            $out .= '<div id="'.$final_id.'" class="'.sanitize_html_classes($final_class).'" data-g1-rotate-items="'. esc_attr($rotate_items) .'" data-g1-timeout="'. esc_attr( $timeout ) .'">';
            $out .= $content;
            $out .= $toolbar;
            $out .= '</div>';
        }

        return $out;
    }
}

function G1_Carousel_Shortcode() {
    static $instance;

    if ( !isset( $instance ) )
        $instance = new G1_Carousel_Shortcode( 'carousel' );

    return $instance;
}
// Fire in the hole :)
G1_Carousel_Shortcode();

class G1_Carousel_Item_Shortcode extends G1_Shortcode {
    public function __construct( $id, $args = array() ) {
        parent::__construct( $id, $args );

        $this->set_content( 'content', array(
            'form_control' => 'Long_Text'
        ));

        $this->set_type( 'block' );

        add_action( 'g1_shortcode_generator_register', array( $this, 'add_shortcode_generator_item' ) );
    }

    /**
     * Add shortcode to the global shortcode generator
     *
     * @param G1_Shortcode_Generator $generator
     */
    public function add_shortcode_generator_item( $generator ) {
        $generator->add_item( $this, 'misc' );
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
        $final_id = strlen( $id ) ? $id : 'g1-carousel-item-counter-' . $this->get_counter();

        // Compose final HTML class attribute
        $final_class = array(
            'g1-carousel-item',
        );

        $final_class = array_merge( $final_class, explode( ' ', $class ) );

        // Compose output
        $out = '<li id="' . esc_attr( $final_id ) . '" class="' . sanitize_html_classes( $final_class ) . '">' .
            do_shortcode( shortcode_unautop( $content ) ) .
            '</li>';

        return $out;
    }
}

function G1_Carousel_Item_Shortcode() {
    static $instance;

    if ( !isset( $instance ) )
        $instance = new G1_Carousel_Item_Shortcode( 'carousel_item' );

    return $instance;
}
// Fire in the hole :)
G1_Carousel_Item_Shortcode();

class G1_Countdown_Shortcode extends G1_Shortcode {
    public function __construct( $id, $args = array() ) {
        parent::__construct( $id, $args );

        $this->set_content( 'content', array(
            'form_control' => 'Long_Text',
            'label' => __( 'expiry_text', 'g1_theme' ),
        ));

        $this->set_type( 'block' );

        add_action( 'g1_shortcode_generator_register', array( $this, 'add_shortcode_generator_item' ) );
    }

    /**
     * Add shortcode to the global shortcode generator
     *
     * @param G1_Shortcode_Generator $generator
     */
    public function add_shortcode_generator_item( $generator ) {
        $generator->add_item( $this, 'misc' );
    }

    protected function load_attributes() {
        // title attribute
        $this->add_attribute( 'until', array(
            'form_control'  => 'Text',
            'hint'		    => __( 'For example: 1 June 2013', 'g1_theme' ),
        ));

        // icon attribute
        $this->add_attribute( 'icon', array(
            'form_control' => 'Choice',
            'default'      => 'time',
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

        // Compose final HTML id attribute
        $final_id = strlen( $id ) ? $id : 'g1-countdown-counter-' . $this->get_counter();

        // Compose final HTML class attribute
        $final_class = array(
            'g1-countdown',
        );

        $final_class = array_merge( $final_class, explode( ' ', $class ) );

        // Install Countdown
        add_action( 'wp_footer', array( $this, 'enqueue_scripts') );

        $until = strtotime($until);
        $content = preg_replace('#^<\/p>|<p>$#', '', $content);

        $until_year 	= date("Y", $until);
        $until_month 	= date("n", $until);
        $until_day 		= date("j", $until);
        $until_hours 	= date("G", $until);
        $until_minutes 	= intval(date("i", $until));
        $until_seconds 	= intval(date("s", $until));

        if ( strlen( $icon ) ) {
            $icon = g1_get_font_awesome_icon_class( $icon );
            $icon = "<i class=\"{$icon}\"></i>";
        }

        /* Compose output */
        $out = '';
        $out .= '<div class="g1-countdown">';
        $out .= $icon;
        $out .= '<div class="g1-metadata { ';
        $out .= 'until_year: \''.esc_attr($until_year).'\', ';
        $out .= 'until_month: \''.esc_attr($until_month).'\', ';
        $out .= 'until_day: \''.esc_attr($until_day).'\', ';
        $out .= 'until_hours: \''.esc_attr($until_hours).'\', ';
        $out .= 'until_minutes: \''.esc_attr($until_minutes).'\', ';
        $out .= 'until_seconds: \''.esc_attr($until_seconds).'\'';
        $out .=	' }"></div>';
        $out .= '<div class="g1-countdown-inner"></div>';

        if( !empty( $content ) ) {
            $out .= '<div class="g1-countdown-expiry-text">'.do_shortcode($content).'</div>';
        }

        $out .= '</div>';

        return $out;
    }

    public function enqueue_scripts() {
        wp_enqueue_script('countdown', get_template_directory_uri().'/js/jquery.countdown/jquery.countdown.min.js', array('jquery'));
        wp_print_scripts( 'countdown' );
    }
}
function G1_Countdown_Shortcode() {
    static $instance;

    if ( !isset( $instance ) )
        $instance = new G1_Countdown_Shortcode( 'countdown' );

    return $instance;
}
// Fire in the hole :)
G1_Countdown_Shortcode();

/**
 * Class G1_Progress_Circle_Shortcode
 */
class G1_Progress_Circle_Shortcode extends G1_Shortcode {

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
        $generator->add_item( $this, 'misc' );
    }

    protected function load_attributes() {
        $this->add_attribute( 'value', array(
            'form_control'  => 'Text',
            'default' => 50,
            'id_aliases' => array(
                'final',
                'end',
            ),
            'hint'		    => __( '0-100 range', 'g1_theme' ),
        ));

        $this->add_attribute( 'icon', array(
            'form_control' => 'Choice',
            'default'      => '',
            'choices_cb'   => 'g1_get_font_awesome',
        ));

        $this->add_attribute( 'style', array(
            'form_control' => 'Choice',
            'default'      => 'solid',
            'choices'	   => array(
                'simple' => 'simple',
                'solid' => 'solid',
            ),
        ));


        $this->add_attribute( 'text_color', array(
            'default'      => '',
            'form_control'  => 'Color',
            'id_aliases' => array(
                'textcolor',
                'text-color',
                'color',
            ),
        ));

        $this->add_attribute( 'bg_color', array(
            'default'      => '',
            'form_control'  => 'Color',
            'id_aliases' => array(
                'backgroundcolor',
                'background-color',
                'background_color',
                'background',
                'bg_color',
                'bgcolor',
                'bg-color',
            ),
        ));
    }

    public function enqueue_scripts() {
        wp_enqueue_script('easyPieChart', get_template_directory_uri().'/js/jquery.easypiechart/jquery.easy-pie-chart.js', array('jquery'), true);
    }

    /**
     * Shortcode callback function.
     *
     * @return string
     */
    protected function do_shortcode() {
        extract( $this->extract() );

        $value = absint($value);
        if  ($value < 0 ) {
            $value = 0;
        }

        if( $value > 100 ) {
            $value = 100;
        }

        $final_id = strlen( $id ) ? $id : 'g1-progress-circle-' . $this->get_counter();

        $final_class = array(
            'g1-progress-circle',
            'g1-progress-circle--' . $style,
        );

        $final_class = array_merge( $final_class, explode( ' ', $class ) );

        $config = array();

        add_action( 'wp_footer', array( $this, 'enqueue_scripts') );

        $css = '';


        switch ( $style ) {
            case 'simple':
                if ( strlen( $text_color ) ) {
                    $color = new G1_Color($text_color);
                    $css .= '#' . esc_attr($final_id) . '.g1-progress-circle {' . "\n" .
                        'color: #' . $color->get_hex() . ';' ."\n" .
                        '}' ."\n";
                }

                if ( strlen( $bg_color ) ) {
                    $color = new G1_Color( $bg_color );
                    $config['barColor'] = '#' . $color->get_hex();
                }

                break;

            case 'solid':
                if ( strlen( $text_color ) ) {
                    $color = new G1_Color($text_color);
                    $css .= '#' . esc_attr($final_id) . '.g1-progress-circle {' . "\n" .
                        'color: #' . $color->get_hex() . ';' ."\n" .
                        '}' ."\n";

                    $config['barColor'] = '#' . $color->get_hex();
                }

                if ( strlen( $bg_color ) ) {
                    $color = new G1_Color( $bg_color );
                    $config['bgColor'] = '#' . $color->get_hex();
                }

                break;
        }

        $icon = strlen( $icon ) ? '<i class="' . g1_get_font_awesome_icon_class( $icon ) . ' g1-progress-circle__icon"></i>' : '%';

        $out = '%css%<div id="%id%" class="%class%" data-config="%data_config%" data-percent="%percent%">%content%</div>';

        $out = str_replace(
            array(
                '%css%',
                '%id%',
                '%class%',
                '%data_config%',
                '%percent%',
                '%content%',
            ),
            array(
                strlen($css) ? "\n" . '<style type="text/css" scoped="scoped">' . $css . '</style>' . "\n" : '',
                esc_attr( $final_id ),
                sanitize_html_classes($final_class),
                g1_data_capture($config),
                esc_attr($value),
                '<span class="g1-progress-circle__value">' . esc_html($value) . '</span>' . $icon . '<div class="g1-color-scheme"></div>',
            ),
            $out
        );

        return $out;

    }
}
function G1_Progress_Circle_Shortcode() {
    static $instance;

    if ( !isset( $instance ) )
        $instance = new G1_Progress_Circle_Shortcode( 'progress_circle' );

    return $instance;
}
// Fire in the hole :)
G1_Progress_Circle_Shortcode();


/**
 * Class G1_Progress_Bar_Shortcode
 */
class G1_Progress_Bar_Shortcode extends G1_Shortcode {

    public function __construct( $id, $args = array() ) {
        parent::__construct( $id, $args );

        // content
        $this->set_content( 'content', array(
            'form_control' => 'Text',
            'label' => __( 'label', 'g1_theme' ),
        ));

        add_action( 'g1_shortcode_generator_register', array( $this, 'add_shortcode_generator_item' ) );
    }

    /**
     * Add shortcode to the global shortcode generator
     *
     * @param G1_Shortcode_Generator $generator
     */
    public function add_shortcode_generator_item( $generator ) {
        $generator->add_item( $this, 'misc' );
    }

    protected function load_attributes() {
        // value attribute
        $this->add_attribute( 'value', array(
            'form_control'  => 'Text',
            'default' => 50,
            'id_aliases' => array(
                'final',
                'end',
            ),
            'hint'		    => __( '0-100 range', 'g1_theme' ),
        ));

        // direction attribute
        $this->add_attribute( 'direction', array(
            'form_control'  => 'Choice',
            'default'      => 'right',
            'choices'	   => array(
                'right' => __('Right', 'g1_theme'),
                'left'  => __('Left', 'g1_theme'),
            ),
        ));

        // icon attribute
        $this->add_attribute( 'icon', array(
            'form_control' => 'Choice',
            'default'      => '',
            'choices_cb'   => 'g1_get_font_awesome',
        ));

        // style attribute
        $this->add_attribute( 'style', array(
            'form_control' => 'Choice',
            'default'      => 'solid',
            'choices'	   => array(
                'simple' => 'simple',
                'solid' => 'solid',
            ),
        ));

        // size attribute
        $this->add_attribute( 'size', array(
            'form_control' => 'Choice',
            'default'      => 'small',
            'choices'	   => array(
                'small' => 'small',
                'medium' => 'medium',
                'big' => 'big',
            ),
        ));

        // text color attribute
        $this->add_attribute( 'text_color', array(
            'default'      => '',
            'id_aliases' => array(
                'textcolor',
                'text-color',
                'color',
            ),
            'form_control'  => 'Color',
        ));

        // background color attribute
        $this->add_attribute( 'bg_color', array(
            'default'      => '',
            'form_control'  => 'Color',
            'id_aliases' => array(
                'background',
                'bg',
                'backgroundcolor',
                'background-color',
                'background_color',
                'bgcolor',
                'bg-color',
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

        $value = absint($value);
        if  ($value < 0 ) {
            $value = 0;
        }

        if( $value > 100 ) {
            $value = 100;
        }

        $final_id = strlen( $id ) ? $id : 'g1-progress-bar-' . $this->get_counter();

        $final_class = array(
            'g1-progress-bar',
            'g1-progress-bar--' . $style,
            'g1-progress-bar--' . $size,
            'g1-progress-bar--' . $direction,
        );

        $final_class = array_merge( $final_class, explode( ' ', $class ) );

        $css_rules = array();

        /* Compose CSS */
        if ( strlen( $text_color ) ) {
            $color = new G1_Color($text_color);
            $css_rules[] = 'color: #' . $color->get_hex() . ';';
        }

        if ( strlen( $bg_color ) ) {
            $color = new G1_Color($bg_color);
            $css_rules[] = 'background-color: #' . $color->get_hex() . ';';
            $css_rules[] = 'border-color: #' . $color->get_hex() . ';';
        }

        $css = '';
        if ( count( $css_rules ) ) {
            $css = '<style type="text/css" scoped="scoped">' .
                        '#' . esc_attr( $final_id ) . '.g1-progress-bar .g1-progress-bar__bar {' . implode( ' ', $css_rules ) .'}' .
                    '</style>' . "\n";
        }


        /* Compose icon */
        if ( strlen( $icon ) ) {
            $icon = '<i class="' . g1_get_font_awesome_icon_class( $icon ) . ' g1-progress-bar__icon"></i>';

            $final_class[] = 'g1-progress-bar--icon';
        } else {
            $final_class[] = 'g1-progress-bar--noicon';
        }

        /* Compose label */
        if ( strlen( $content ) ) {
            $content = '<div class="g1-progress-bar__label">' . $content . '</div>';
        }


        /* Compose output */
        $out =
            '%css%' .
            '<div id="%id%" class="%class%">' .
                '%content%' .
                '<div class="g1-progress-bar__track">' .
                    '<div class="g1-progress-bar__bar" style="width:%value%%;">' .
                        '<span>%value%</span>' .
                        '%icon%' .
                    '</div>' .
                '</div>' .
            '</div>';

        $out = str_replace(
            array(
                '%css%',
                '%id%',
                '%class%',
                '%content%',
                '%value%',
                '%icon%',
            ),
            array(
                $css,
                esc_attr( $final_id ),
                sanitize_html_classes( $final_class ),
                $content,
                $value,
                $icon,
            ),
            $out
        );


        return $out;

    }
}
function G1_Progress_Bar_Shortcode() {
    static $instance;

    if ( !isset( $instance ) )
        $instance = new G1_Progress_Bar_Shortcode( 'progress_bar' );

    return $instance;
}
// Fire in the hole :)
G1_Progress_Bar_Shortcode();



class G1_Box_Shortcode extends G1_Shortcode {
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
        $generator->add_item( $this, 'misc' );
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
            'default'      => 'simple',
            'choices'	   => array(
                'simple' => 'simple',
                'solid' => 'solid',
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
        $final_id = strlen( $id ) ? $id : 'g1-box-counter-' . $this->get_counter();

        // Compose final HTML class attribute
        $final_class = array(
            'g1-box',
            'g1-box--' . $style,
        );

        $final_class = array_merge( $final_class, explode( ' ', $class ) );

        if ( strlen( $icon ) ) {
            $icon = '<i class="' . g1_get_font_awesome_icon_class( $icon ) . ' g1-box__icon"></i>';

            $final_class[] = 'g1-box--icon';
        } else {
            $final_class[] = 'g1-box--noicon';
        }


        // Compose output
        $out = '';
        $out .= '<div id="' . esc_attr( $final_id ) . '" ';
        $out .= 'class="' . sanitize_html_classes( $final_class ) . '" ';
        $out .= '>';
        $out .= $icon;
        $out .= '<div class="g1-box__inner">';
        $out .= do_shortcode( shortcode_unautop( $content ) );
        $out .= '</div>';
        $out .= '</div>';

        return $out;

    }
}
function G1_Box_Shortcode() {
    static $instance;

    if ( !isset( $instance ) )
        $instance = new G1_Box_Shortcode( 'box' );

    return $instance;
}
// Fire in the hole :)
G1_Box_Shortcode();