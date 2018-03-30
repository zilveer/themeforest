<?php
/**
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Theme03
 * @subpackage G1_Simple_Sliders_Module
 * @since G1_Simple_Sliders_Module 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php

class G1_Simple_Sliders_Base_Module extends G1_Module {

    private $prefix;

    private $post_type;

    public function set_prefix( $val ) { $this->prefix = $val; }
    public function get_prefix() { return $this->prefix; }

    public function set_post_type( $val ) { $this->post_type = $val; }
    public function get_post_type() { return $this->post_type; }


    public function __construct() {
        parent::__construct();

        $this->set_version('1.0.0');

        $this->set_prefix( 'g1_simple_slider' );
        $this->set_post_type( 'g1_simple_slider' );
    }


    protected function setup_hooks() {
        parent::setup_hooks();

        add_filter( 'g1_element_slider_choices' ,       array($this, 'add_slider_choices') );

        add_action( get_redux_opts_sections_filter_name(), array( $this, 'add_theme_options' ) );

        if ( is_admin() ) {
            // Include stylesheets
            add_action( 'admin_enqueue_scripts', array($this, 'enqueue_admin_styles') );

            // Include javascripts
            add_action( 'admin_enqueue_scripts', array($this, 'enqueue_admin_scripts') );
        } else {
            add_action( 'wp_enqueue_scripts', array($this, 'enqueue_scripts') );
        }

        add_action( 'g1_post_meta_manager_register',array($this, 'g1_post_meta_manager_register') );

        add_filter( 'g1_element_media_box_choices',         array($this, 'add_media_box_choices') );
        add_filter( 'g1_mediabox_help' ,           array($this, 'mediabox_help') );
        add_action( 'g1_mediabox',                 array($this, 'mediabox'), 10, 2 );

        add_action( 'g1_precontent',               array($this, 'precontent') );

        add_action( 'add_meta_boxes',               array($this, 'remove_meta_boxes') );

        add_action( 'init',                         array($this, 'register_post_type') );
    }

    public function add_theme_options ( $sections ) {
        $layout_choices = array();

        foreach ($this->get_layout_choices() as $name => $path) {
            $layout_choices[$name] = array(
                'title' => $name,
                'img' => $path
            );
        }

        $sections['simple_slider'] = array(
            'priority'   => 900,
            'icon'       => 'camera',
            'icon_class' => 'icon-large',
            'title'      => __( 'Sliders', Redux_TEXT_DOMAIN ),
            'content'   => __( 'ddffsfdfsdfsdd', Redux_TEXT_DOMAIN ),
            'fields'     => array(
                array(
                    'id'        => 'simple_slider_info',
                    'priority'  => 5,
                    'type'      => 'info',
                    'desc'      => __( 'Set up the default configuration for all sliders added using "Single Page Options > Media Box" setting.', Redux_TEXT_DOMAIN ),
                ),
//                array(
//                    'id'        => 'simple_slider_animation',
//                    'priority'  => 10,
//                    'type'      => 'select',
//                    'title'     => __( 'Transition', Redux_TEXT_DOMAIN ),
//                    'options'   => $this->get_fx_choices(),
//                    'std'       => $this->get_default_values('animation')
//                ),
                array(
                    'id'        => 'simple_slider_animationDuration',
                    'priority'  => 20,
                    'type'      => 'g1_range',
                    'min'       =>  0,
                    'max'       =>  5,
                    'step'      => 0.1,
                    'title'     => __( 'Transition Speed', Redux_TEXT_DOMAIN ),
                    'desc'      => __( 'Enter the number of seconds, e.g. 1.5', Redux_TEXT_DOMAIN ),
                    'std'       => $this->get_default_values('animationDuration')
                ),
                array(
                    'id'        => 'simple_slider_slideshowSpeed',
                    'priority'  => 30,
                    'type'      => 'g1_range',
                    'min'       =>  0,
                    'max'       =>  10,
                    'step'      => 0.1,
                    'title'     => __( 'Pause Time', Redux_TEXT_DOMAIN ),
                    'sub_desc'  => __( 'Time between slide transitions.', Redux_TEXT_DOMAIN ),
                    'desc'      => __( 'Enter the number of seconds, e.g. 4', Redux_TEXT_DOMAIN ),
                    'std'       => $this->get_default_values('slideshowSpeed')
                ),
                array(
                    'id'        => 'simple_slider_fullscreen',
                    'priority'  => 40,
                    'type'      => 'select',
                    'title'     => __( 'Fullscreen', Redux_TEXT_DOMAIN ),
                    'options'   => $this->get_on_off_choices(),
                    'switch'    => true,
                    'std'       => $this->get_default_values('fullscreen')
                ),
                array(
                    'id'        => 'simple_slider_autoplay',
                    'priority'  => 50,
                    'type'      => 'select',
                    'title'     => __( 'Autoplay', Redux_TEXT_DOMAIN ),
                    'options'   => $this->get_on_off_choices(),
                    'switch'    => true,
                    'std'       => $this->get_default_values('autoplay')
                ),
                array(
                    'id'        => 'simple_slider_coinNavigation',
                    'priority'  => 60,
                    'type'      => 'select',
                    'title'     => __( 'Coin Navigation', Redux_TEXT_DOMAIN ),
                    'options'   => $this->get_coin_nav_choices(),
                    'std'       => $this->get_default_values('coinNavigation')
                ),
                array(
                    'id'        => 'simple_slider_directionNavigation',
                    'priority'  => 70,
                    'type'      => 'select',
                    'title'     => __( 'Direction Navigation', Redux_TEXT_DOMAIN ),
                    'options'   => $this->get_on_off_choices(),
                    'switch'    => true,
                    'std'       => $this->get_default_values('directionNavigation')
                ),
                array(
                    'id'        => 'simple_slider_progressBar',
                    'priority'  => 80,
                    'type'      => 'select',
                    'title'     => __( 'Progress Bar', Redux_TEXT_DOMAIN ),
                    'options'   => $this->get_on_off_choices(),
                    'switch'    => true,
                    'std'       => $this->get_default_values('progressBar')
                ),
            )
        );

        return $sections;
    }


    public function enqueue_admin_styles() {
        $uri = trailingslashit( get_template_directory_uri() );

        wp_register_style(
            'g1_simple_slider',
            $uri . 'lib/g1-simple-sliders/admin/css/g1_simple_slider.css',
            false,
            '1.0'
        );

        wp_enqueue_style( 'g1_simple_slider' );
    }



    public function enqueue_scripts() {
        $parent_uri = trailingslashit( get_template_directory_uri() );

        wp_enqueue_script( 'g1_simple_sliders', $parent_uri . 'lib/g1-simple-sliders/js/g1-simple-sliders.js', array('g1_main', 'jquery.touchSwipe', 'galleria_theme'), '1.0.0', true );
    }

    public function enqueue_admin_scripts() {
        $uri = trailingslashit( get_template_directory_uri() );
    }

    /**
     * Adds Simple Slider to extend Media Box possibilities.
     *
     * @param array $choices
     * @return array
     */
    public function add_media_box_choices( $choices ) {
        $choices[ 'simple_slider' ] = __( 'Slider', 'g1_theme' );

        return $choices;
    }



    /**
     * Adds Simple Slider description
     *
     * Callback for g1_mediabox_help custom filter hook
     *
     * @param string $help
     * @return string
     */
    public function mediabox_help( $help ) {
        $help .= '<p>' . __( 'The <strong>slider</strong> displays only image attachments. It tries to open an attachment alternative link (if provided) in a lightbox.', 'g1_theme' ) . '</p>';

        return $help;
    }


    /**
     * Callback for g1_mediabox custom action hook
     *
     * @param string $size Image size
     * @param string $type Mediabox type
     */
    public function mediabox( $args ) {
        extract($args);

        if( !in_array( $type, array( 'simple_slider', 'simple-slider' ) ) ) {
            return;
        }

        global $post;


        /* Standard Media */
        $items = g1_mediabox_items ( $post->ID, $size );
        $items_html = '';

        if ( count($items) > 0 ) {
            /* Items */
            foreach ( $items as $index => $item ) {
                $class = array_merge( array( ( $index % 2 ) ? 'even' : 'odd'), $item['class']  );

                $items_html .=
                    '<li class="' . sanitize_html_classes( $class ) . '">' .
                        $item['html'] .
                        '</li>';
            }

            /* Thumbnails */
            $items = g1_mediabox_thumbs( $post->ID, 'g1_one_twelfth' );
            $thumbs_html = '';

            foreach ( $items as $index => $item ) {
                $thumbs_html .=
                    '<li class="' . sanitize_html_classes( $item['class'] ) . '">' .
                        $item[ 'html' ] .
                        '</li>';
            }


            /* Lightbox data */
            $items = g1_mediabox_lightbox( $post->ID, 'full' );
            $lightbox_html = '';

            foreach ( $items as $index => $item ) {
                $lightbox_html .=
                    '<li class="' . sanitize_html_classes( $item[ 'class' ] ) . '">' .
                        $item['html'] .
                        '</li>';
            }
        } else if ($force_placeholder) {
            echo do_shortcode( '[placeholder icon="eye-close" size="' . esc_attr( $size ) .  '"]' );
        }

        /* Compose final template */
        $out =
            '<figure class="g1-mediabox g1-mediabox--slider" data-config="' . g1_data_capture( $this->get_default_config() ) .  '">' .
                '<div class="g1-inner">' .
                    '<ol class="g1-slides">' .
                        $items_html .
                    '</ol>' .
                    '<ol class="g1-nav-coin">' .
                        $thumbs_html .
                    '</ol>' .
                    '<ol class="g1-lightbox-data">' .
                        $lightbox_html .
                    '</ol>' .
                '</div>' .
            '</figure>';

        echo $out;
    }



    /**
     * Callback for g1_slider_choices custom filter hook
     *
     * Adds available Simple Sliders.
     *
     * @param array $choices
     * @return array
     */
    public function add_slider_choices( $choices ) {
        $query_args = array(
            'post_type' 	=> $this->get_post_type(),
            'numberposts' 	=> -1,
        );

        $sliders = get_posts( $query_args );
        if ( $sliders ) {
            foreach ( $sliders as $slider ) {
                $title = apply_filters( 'the_title' , $slider->post_title );
                $post_type = get_post_type_object( get_post_type( $slider ) );
                $title .= ' (' . $post_type->labels->singular_name;
                $title .= ', ID:' . $slider->ID . ')';

                $choices[ $slider->ID ] = strip_tags($title);
            }
        }

        return $choices;
    }



    /**
     * Gets layout choices for a Simple Slider
     *
     * If you want to add/delete some choices, hook into the g1_simple_slider_layout_choices custom filter.
     *
     * @return array
     */
    public function get_layout_choices() {
        $uri = trailingslashit( get_template_directory_uri() ) . 'lib/g1-simple-sliders/admin/images/';

        $choices = array(
            'simple'    => $uri . 'layout-simple.png',
            'relay'	    => $uri . 'layout-relay.png',
            'viewport'	=> $uri . 'layout-viewport.png',
            'standout'	=> $uri . 'layout-stand-out.png',
            'kenburns'	=> $uri . 'layout-ken-burns.png',
        );

        return apply_filters( 'g1_simple_slider_layout_choices', $choices );
    }



    /**
     * Gets fx choices for a Simple Slider
     *
     * If you want to add/delete some choices, hook into the g1_simple_slider_fx_choices custom filter.
     *
     * @return array
     */
    public function get_fx_choices() {
        $choices = array(
            'fade'		    => __( 'Fade', 'g1_theme' ),
            'slide-left'	=> __( 'Slide Left', 'g1_theme' ),
            'slide-right'	=> __( 'Slide Right', 'g1_theme' ),
            'slide-up'	    => __( 'Slide Up', 'g1_theme' ),
            'slide-down'    => __( 'Slide Down', 'g1_theme' ),
        );

        return apply_filters( 'g1_simple_slider_fx_choices', $choices );
    }

    public function get_width_choices() {
        $choices = array(
            'g1_simple_slider_wide'     => __( 'Wide', 'g1_theme' ),
            'g1_simple_slider_semi'	    => __( 'Semi', 'g1_theme' ),
            'g1_simple_slider_standard'	=> __( 'Standard', 'g1_theme' ),
            'g1_simple_slider_narrow'	=> __( 'Narrow', 'g1_theme' ),
        );

        return apply_filters( 'g1_simple_slider_width_choices', $choices );
    }

    public function get_on_off_choices() {
        $choices = array(
            'standard'	=> 'on',
            'none'      => 'off',
        );

        return apply_filters( 'g1_simple_slider_on_off_choices', $choices );
    }

    public function get_coin_nav_choices () {
        $choices = array(
            'none'      =>  __( 'None', 'g1_theme' ),
            'standard'  =>  __( 'Standard', 'g1_theme' ),
            'thumbs'    =>  __( 'Thumbnails', 'g1_theme' ),
        );

        return apply_filters( 'g1_simple_slider_coin_nav_choices', $choices );
    }

    public static function get_slider_width_in_pixels ( $width_name ) {
        switch ($width_name) {
            case 'g1_simple_slider_wide':
                $width = 9999;
                break;

            case 'g1_simple_slider_semi':
                $width = 1136;
                break;

            case 'g1_simple_slider_narrow':
                $width = 968;
                break;

            case 'g1_simple_slider_standard':
            default:
                $width = 1024;
        }

        return $width;
    }

    /**
     * Callback for g1_precontent custom action hook
     *
     * Checks if the current object has some Simple Slider assigned.
     * If yes: it renders slider.
     * If no: it does nothing.
     */
    public function precontent() {
        $slider_id = absint( G1_Elements()->get( 'slider' ) );

        if( !$slider_id || $this->get_post_type() !== get_post_type( $slider_id) ) {
            return;
        }

        echo do_shortcode( '[simple_slider slider="' . $slider_id . '" class="g1-primary"]' );
    }



    /**
     * Gets the default configuration for all sliders
     */
    public function get_default_config() {
        $defaults = $this->get_default_values();

        $config = array(
            'layout'				=> $defaults['layout'],
            'width'				    => $defaults['width'],
            'animation'				=> g1_get_theme_option( 'simple_slider', 'animation', $defaults['animation'] ),
            'animationDuration'		=> g1_get_theme_option( 'simple_slider', 'animationDuration', $defaults['animationDuration'] ) * 1000,
            'slideshowSpeed'		=> g1_get_theme_option( 'simple_slider', 'slideshowSpeed', $defaults['slideshowSpeed'] ) * 1000,
            'autoplay'              => g1_get_theme_option( 'simple_slider', 'autoplay', $defaults['autoplay'] ),
            'fullscreen'            => g1_get_theme_option( 'simple_slider', 'fullscreen', $defaults['fullscreen'] ),
            'coinNavigation'        => g1_get_theme_option( 'simple_slider', 'coinNavigation', $defaults['coinNavigation'] ),
            'directionNavigation'   => g1_get_theme_option( 'simple_slider', 'directionNavigation', $defaults['directionNavigation'] ),
            'progressBar'           => g1_get_theme_option( 'simple_slider', 'progressBar', $defaults['progressBar'] ),
        );

        return $config;
    }

    public function get_default_values ( $name = null ) {
        $defaults = array(
            'layout'				=> 'simple',
            'width'				    => 'g1_simple_slider_standard',
            'animation'				=> 'slide-left',
            'animationDuration'		=> 0.5,
            'slideshowSpeed'		=> 5,
            'autoplay'              => 'standard',
            'fullscreen'            => 'standard',
            'coinNavigation'        => 'standard',
            'directionNavigation'   => 'standard',
            'progressBar'           => 'standard'
        );

        return !empty($name) && array_key_exists($name, $defaults) ? $defaults[$name] : $defaults;
    }

    public function get_post_config( $the_post = false ) {
        $result = $this->get_default_config();

        global $post;

        if ( false === $the_post )
            $the_post = $post;
        elseif ( is_numeric( $the_post ) )
            $the_post = get_post( $the_post );

        if ( !is_object( $the_post ) )
            return $result;

        // Get configuration from the attachments parent ( slider )
        if ( $this->get_post_type() === $the_post->post_type ) {

            $_g1 = (array) get_post_meta( $the_post->ID, '_g1', true );

            if( isset( $_g1['simple_slider_layout'] ) )
                $result['layout'] = $_g1['simple_slider_layout'];

            if( isset( $_g1['simple_slider_width'] ) )
                $result['width'] = $_g1['simple_slider_width'];

            if( isset( $_g1['simple_slider_height'] ) )
                $result['height'] = $_g1['simple_slider_height'];

            if( isset( $_g1['simple_slider_animation'] ) )
                $result['animation'] = $_g1['simple_slider_animation'];

            if( isset( $_g1['simple_slider_animation_duration'] ) )
                $result['animationDuration'] = $_g1['simple_slider_animation_duration'] * 1000;

            if( isset( $_g1['simple_slider_slideshow_speed'] ) )
                $result['slideshowSpeed'] = $_g1['simple_slider_slideshow_speed'] * 1000;

            if( isset( $_g1['simple_slider_autoplay'] ) )
                $result['autoplay'] = $_g1['simple_slider_autoplay'];

            if( isset( $_g1['simple_slider_fullscreen'] ) )
                $result['fullscreen'] = $_g1['simple_slider_fullscreen'];

            if( isset( $_g1['simple_slider_progress_bar'] ) )
                $result['progressBar'] = $_g1['simple_slider_progress_bar'];

            if( isset( $_g1['simple_slider_coin_navigation'] ) )
                $result['coinNavigation'] = $_g1['simple_slider_coin_navigation'];

            if( isset( $_g1['simple_slider_direction_navigation'] ) )
                $result['directionNavigation'] = $_g1['simple_slider_direction_navigation'];
        }

        return $result;

    }

    protected function sanitize_string_var( $var ) {
        $clean = preg_replace('/[^0-9a-zA-Z_-]*/', '', $var );

        return $clean;
    }

    /**
     * Returns a simple slider markup
     *
     * @param string $id The id attribute
     * @param integer $width Slider width
     * @param integer $height Slider height
     * @param array $config Slider configuration
     * @param array $slides
     * @return string
     */
    public function capture( $slides, $config, $args ) {
        static $counter = 0;
        $counter++;

        $out = '';

        if ( ! count( $slides ) ) {
            return '';
        }

        // clean arguments
        $args[ 'id' ]			= !empty( $args[ 'id' ] ) ? $args[ 'id' ] : 'g1-slider-counter-' . $counter;
        $args[ 'class' ]		= !empty( $args[ 'class' ] ) ? $args[ 'class' ] : '';
        $args[ 'width' ]		= absint( $args[ 'width' ] );
        $args[ 'height' ] 		= absint( $args[ 'height' ] );

        // clean options
        $config[ 'layout' ]				= $this->sanitize_string_var( $config[ 'layout' ] );
        $config[ 'width' ]				= $this->sanitize_string_var( $config[ 'width' ] );


        $config[ 'height' ]	= 320;
        if ( is_numeric( $config[ 'height' ] ) ) {
            $config[ 'height' ]	= absint( $config[ 'height' ] );
        }


        $config[ 'animation' ]			= $this->sanitize_string_var( $config[ 'animation' ] );
        $config[ 'animation' ]			= str_replace( '-', '_', $config[ 'animation' ] );
        $config[ 'animationDuration' ] 	= absint( $config[ 'animationDuration' ] );
        $config[ 'slideshowSpeed' ]		= absint( $config[ 'slideshowSpeed' ] );
        $config[ 'autoplay' ]			= $this->sanitize_string_var( $config[ 'autoplay' ] );
        $config[ 'fullscreen' ]			= $this->sanitize_string_var( $config[ 'fullscreen' ] );
        $config[ 'coinNavigation' ]		= $this->sanitize_string_var( $config[ 'coinNavigation' ] );
        $config[ 'directionNavigation' ] = $this->sanitize_string_var( $config[ 'directionNavigation' ] );
        $config[ 'progressBar' ]        = $this->sanitize_string_var( $config[ 'progressBar' ] );
        $config[ 'width_in_px' ]        = G1_Simple_Sliders_Module::get_slider_width_in_pixels($config['width']);

        switch ($config[ 'width' ]) {
            case '':
                break;
        }


        // set defaults if needed
        $config_defaults = $this->get_default_config();
        foreach ( $config as $key => $value ) {
            if ( empty($value) ) {
                $config[ $key ] = $config_defaults[ $key ];
            }
        }

        $final_class = array(
            'g1-simple-slider',
            'g1-slider-not-ready',
            'g1-simple-slider-' . $config[ 'layout' ]
        );

        $final_class = array_merge( $final_class, explode(' ', $args[ 'class' ]) );

        // Remove empty strings
        $final_class = array_filter( $final_class );

        $final_class[] = 'g1-width-' . str_replace( 'g1_simple_slider_', '', $config[ 'width' ] );
        $final_class[] = 'g1-nav-direction-' . $config[ 'directionNavigation' ];
        $final_class[] = 'g1-nav-coin-' . $config[ 'coinNavigation' ];
        $final_class[] = 'g1-fullscreen-' . $config[ 'fullscreen' ];
        $final_class[] = 'g1-progress-' . $config[ 'progressBar' ];

        // Install Simple Slider. Not every page needs to load additional javascrips
        add_action('wp_footer', 'g1_simple_slider_wp_footer');

        $out .= '<div id="' . esc_attr( $args['id'] ) . '" class="' . sanitize_html_classes( $final_class ) . '" data-config="' . g1_data_capture( $config ) . '">';
        $out .= '<div class="g1-inner">';

        $out .= '<ol class="g1-slides">' . "\n";
        foreach ( $slides as $i => $slide ) {
            // Default slide configuration
            $x = array(
                'layout' 	=> 'default',
                'width' 	=> $args['width'],
                'height' 	=> $args['height'],
            );
            // Cascade configuration
            $x = array_merge( $x, $slide );
            // Check for an empty link
            $x['linking'] = strlen( $x[ 'link' ] ) ? $x['linking'] : 'none';

            if ( empty( $x['alt'] ) ) {
                $x['alt'] = esc_url( $x['src'] );
            }

            $media = '<img src="' .	esc_url( $x['src'] ) . '" ' .
                'width="' . absint( $x['width'] ) . '" ' .
                'height="' . absint( $x['height']) . '" ' .
                'alt="'. $x['alt'] .'" ' .
                '/>';


            switch ( $x[ 'linking' ] ) {
                case 'none':
                    break;
                case 'new_window':
                case 'new-window':
                    $media = '<a href="' . esc_url( $x[ 'link' ] ) . '" class="g1-new-window">' .
                        do_shortcode( '[indicator type="new-window"]' ) .
                        $media .
                        '</a>';
                    break;
                case 'lightbox':
                    $media = '<a href="' . esc_url( $x[ 'link' ] ) . '">' .
                        do_shortcode( '[indicator type="zoom"]' ) .
                        $media .
                        '</a>';
                    break;
                default:
                    $media = '<a href="' . esc_url( $x[ 'link' ] ) . '">' .
                        do_shortcode( '[indicator type="document"]' ) .
                        $media .
                        '</a>';
                    break;
            }
            $media = '<div>' .
                        $media .
                    '</div>';

            $desc = '';
            if ( strlen( $x['title'] || strlen($x['content']) ) ) {
                $desc .=	'<figcaption>' . "\n" .
                            '<div class="g1-slide__title">' .
                                '<div class="g1-h1">' .
                                    $x['title'] .
                                '</div>' .
                                '<div class="g1-background"></div>' .
                            '</div>' .
                            '<div class="g1-slide__description">' .
                                '<div class="g1-h3">' .
                                    do_shortcode( $x['content'] ) .
                                '</div>' .
                                '<div class="g1-background"></div>' .
                            '</div>' .
                            '</figcaption>' . "\n";
            }

            $final_class = array( 'g1-slide' );
            if ( 0 == $i ) {
                $final_class[] = 'g1-selected';
            }

            $out .= '<li class="' . sanitize_html_classes( $final_class ) . '" data-g1-linking="'.esc_attr($x['linking']).'">' . "\n" .
                '<figure>' . "\n" .
                $media .
                $desc .
                '</figure>' . "\n" .
                '</li>' . "\n";
        }
        $out .= '</ol>' . "\n";

        if ( 'none' !== $config[ 'coinNavigation'] ) {
            // thumbnails
            $out .= '<ol class="g1-nav-coin">' . "\n";

            foreach ( $slides as $slide ) {
                $thumb = wp_get_attachment_image_src( $slide['id'], 'g1_one_twelfth' );

                if ($thumb) {
                    $src = $thumb[0];
                    $width = $thumb[1];
                    $height = $thumb[2];

                    $out .= '<li>' . "\n";
                    $out .= '<a>' . "\n";
                    $out .= '<img src="'.esc_url($src).'" width="'.absint($width).'" height="'.absint($height).'" />' . "\n";
                    $out .= '</a>' . "\n";
                    $out .= '</li>' . "\n";
                }
            }

            $out .= '</ol>' . "\n";
        }

        $out .= '</div>' . "\n";
        $out .= '</div><!-- END .g1-slider -->';

        return $out;
    }

    public function render( $slides, $config, $args ) {
        echo capture( $slides, $config, $args );
    }

    /**
     * Removes unused metaboxes from the Simple Slider edit screen
     */
    public function remove_meta_boxes() {
        remove_meta_box( 'slugdiv', $this->get_post_type(), 'normal' );
    }

    /**
     * Registers custom post type
     *
     * If you want to modify some paremeters, hook into the g1_pre_register_post_type custom filter.
     */
    public function register_post_type(){
        $args = array(
            'label'		=> __('Sliders', 'g1_theme'),
            'labels'	=> array(
                'name'					=> __( 'Sliders', 'g1_theme' ),
                'singular_name' 		=> __( 'Slider', 'g1_theme' ),
                'add_new' 				=> __( 'Add new', 'g1_theme' ),
                'all_items' 			=> __( 'All Sliders', 'g1_theme' ),
                'add_new_item' 			=> __( 'Add new Slider', 'g1_theme' ),
                'edit_item' 			=> __( 'Edit Slider', 'g1_theme' ),
                'new_item' 				=> __( 'New Slider', 'g1_theme' ),
                'view_item' 			=> __( 'View Slider', 'g1_theme' ),
                'search_items' 			=> __( 'Search Sliders', 'g1_theme' ),
                'not_found' 			=> __( 'No Sliders found', 'g1_theme' ),
                'not_found_in_trash'	=> __( 'No Sliders found in Trash', 'g1_theme' ),
                'parent_item_colon' 	=> __( 'Parent Slider', 'g1_theme' ),
                'menu_name'				=> __( 'Sliders', 'g1_theme' ),
            ),
            'public'				=> false,
            'publicly_queryable'	=> false,
            'exclude_from_search'	=> true,
            'show_ui'				=> true,
            'show_in_menu'			=> true,
            'hierarchical'			=> false,
            'supports'				=> array( 'title' ),
            'has_archive'			=> false,
            'rewrite'				=> false,
            'query_var'				=> false,
            'can_export'			=> true,
            'show_in_nav_menus'		=> false,
        );

        // Apply custom filters (this way Child Themes can change some arguments)
        $args = apply_filters( 'g1_pre_register_post_type', $args,$this->get_post_type() );

        register_post_type( $this->get_post_type(), $args );
    }


    /**
     * Registers meta boxes
     *
     * @param G1_Post_Meta_Box_Manager $manager
     */
    public function g1_post_meta_manager_register( G1_Post_Meta_Manager $manager ) {
        $post_type = $this->get_post_type();

        // Configuration meta_box
        $manager->add_section(
            new G1_Post_Meta_Section(
                'simple_sliderconfig',
                array(
                    'title'     => __( 'Configuration', 'g1_theme' )
                )
            )
        );

        $defaults = $this->get_default_config();

        // Layout
        $manager->add_setting( '_g1[simple_slider_layout]', array(
            'apply'	   	=> $post_type,
            'default'	=> $defaults['layout'],
            'view'      => new G1_Form_Image_Choice_Control( '_g1[simple_slider_layout]', array(
                'label'     => __( 'Layout', 'g1_theme' ),
                'choices_cb'    => array($this, 'get_layout_choices'),
                'default' => $defaults['layout']
            )),
            'section'	=> 'simple_sliderconfig',
            'priority'	=> 90,
        ));

        // Width
        $manager->add_setting( '_g1[simple_slider_width]', array(
            'apply'	   	=> $post_type,
            'default'	=> $defaults['width'],
            'view'      => new G1_Form_Choice_Control( '_g1[simple_slider_width]', array(
                'label'         => __( 'Width', 'g1_theme' ),
                'default'   => $defaults['width'],
                'help'      =>
                '<p>' . __( 'The recommended image width', 'g1_theme' ) . '</p>' .
                    '<ul>'  .
                    '<li>' . __( '<strong>wide</strong> - ANY', 'g1_theme' ) . '</li>' .
                    '<li>' . __( '<strong>semi</strong> - '. self::get_slider_width_in_pixels('g1_simple_slider_semi') .'px', 'g1_theme' ) . '</li>' .
                    '<li>' . __( '<strong>standard</strong> - '. self::get_slider_width_in_pixels('g1_simple_slider_standard') .'px', 'g1_theme' ) . '</li>' .
                    '<li>' . __( '<strong>narrow</strong> - '. self::get_slider_width_in_pixels('g1_simple_slider_narrow') .'px', 'g1_theme' ) . '</li>' .
                    '</ul>',
                'choices_cb'	=> array($this, 'get_width_choices'),
            )),
            'section'	=> 'simple_sliderconfig',
            'priority'	=> 100,
        ));

        // Height
        $manager->add_setting( '_g1[simple_slider_height]', array(
            'apply'	   	=> $post_type,
            'default'	=> '',
            'view'      => new G1_Form_Text_Control( '_g1[simple_slider_height]', array(
                'label'     => __( 'Height', 'g1_theme' ),
                'hint'      => __( 'The image height in pixels (optional)', 'g1_theme' ),
                'default'   => '',
                'help'      =>
                '<p>' . __( 'If you leave this value empty, the height will be computed proportionally to the width', 'g1_theme' ) . '</p>',
            )),
            'section'	=> 'simple_sliderconfig',
            'priority'	=> 105,
        ));

        // Transition
//        $manager->add_setting( '_g1[simple_slider_animation]', array(
//            'apply'	   	=> $post_type,
//            'default'	=> $defaults['animation'],
//            'view'      => new G1_Form_Choice_Control( '_g1[simple_slider_animation]', array(
//                'label'         => __( 'Transition', 'g1_theme' ),
//                'hint'			=> __( 'Transition effect', 'g1_theme' ),
//                'choices_cb'	=> array($this, 'get_fx_choices'),
//                'default'       => $defaults['animation']
//            )),
//            'section'	=> 'simple_sliderconfig',
//            'priority'	=> 110,
//        ));

        // Transition speed
        $manager->add_setting( '_g1[simple_slider_animation_duration]', array(
            'apply'	   	=> $post_type,
            'default'	=> $defaults['animationDuration'],
            'view'      => new G1_Form_Range_Control( '_g1[simple_slider_animation_duration]', array(
                'label'     => __( 'Transition speed', 'g1_theme' ),
                'min'       => 0,
                'max'       => 5,
                'step'      => 0.1,
                'default'	=> $defaults['animationDuration']
            )),
            'section'	=> 'simple_sliderconfig',
            'priority'	=> 120,
        ));

        // Pause time
        $manager->add_setting( '_g1[simple_slider_slideshow_speed]', array(
            'apply'	   	=> $post_type,
            'default'	=> $defaults['slideshowSpeed'],
            'view'      => new G1_Form_Range_Control( '_g1[simple_slider_slideshow_speed]', array(
                'label'     => __( 'Pause time', 'g1_theme' ),
                'min'       => 0,
                'max'       => 10,
                'step'      => 0.1,
                'default'	=> $defaults['slideshowSpeed'],
            )),
            'section'	=> 'simple_sliderconfig',
            'priority'	=> 130,
        ));

        // Autoplay
        $manager->add_setting( '_g1[simple_slider_autoplay]', array(
            'apply'	   	=> $post_type,
            'default'	=> $defaults['autoplay'],
            'view'      => new G1_Form_Choice_Control( '_g1[simple_slider_autoplay]', array(
                'label'         => __( 'Autoplay', 'g1_theme' ),
                'choices_cb'	=> array($this, 'get_on_off_choices'),
                'default'	=> $defaults['autoplay'],
            )),
            'section'	=> 'simple_sliderconfig',
            'priority'	=> 140,
        ));

        // Fullscreen mode
        $manager->add_setting( '_g1[simple_slider_fullscreen]', array(
            'apply'	   	=> $post_type,
            'default'	=> $defaults['fullscreen'],
            'view'      => new G1_Form_Choice_Control( '_g1[simple_slider_fullscreen]', array(
                'label' => __( 'Fullscreen', 'g1_theme' ),
                'hint'  => __( 'Allow to display slides in fullscreen mode', 'g1_theme' ),
                'choices_cb'	=> array($this, 'get_on_off_choices'),
                'default'	=> $defaults['fullscreen'],
            )),
            'section'	=> 'simple_sliderconfig',
            'priority'	=> 140,
        ));

        // Coin navigation
        $manager->add_setting( '_g1[simple_slider_coin_navigation]', array(
            'apply'	   	=> $post_type,
            'default'	=> $defaults['coinNavigation'],
            'view'      => new G1_Form_Choice_Control( '_g1[simple_slider_coin_navigation]', array(
                'label' => __( 'Coin navigation', 'g1_theme' ),
                'choices_cb' => array($this, 'get_coin_nav_choices'),
                'default'	=> $defaults['coinNavigation'],
            )),
            'section'	=> 'simple_sliderconfig',
            'priority'	=> 150,
        ));

        // Direction navigation
        $manager->add_setting( '_g1[simple_slider_direction_navigation]', array(
            'apply'	   	=> $post_type,
            'default'	=> $defaults['directionNavigation'],
            'view'      => new G1_Form_Choice_Control( '_g1[simple_slider_direction_navigation]', array(
                'label' => __( 'Direction Navigation', 'g1_theme' ),
                'hint'  => __( 'Allow to navigate using next/prev buttons', 'g1_theme' ),
                'choices_cb'	=> array($this, 'get_on_off_choices'),
                'default'	=> $defaults['directionNavigation'],
            )),
            'section'	=> 'simple_sliderconfig',
            'priority'	=> 160,
        ));

        // Progress bar
        $manager->add_setting( '_g1[simple_slider_progress_bar]', array(
            'apply'	   	=> $post_type,
            'default'	=> $defaults['progressBar'],
            'view'      => new G1_Form_Choice_Control( '_g1[simple_slider_progress_bar]', array(
                'label' => __( 'Progress bar', 'g1_theme' ),
                'choices_cb'	=> array($this, 'get_on_off_choices'),
                'default'	=> $defaults['progressBar'],
            )),
            'section'	=> 'simple_sliderconfig',
            'priority'	=> 170,
        ));
    }
}



if ( !class_exists( 'G1_Simple_Sliders_Module' ) ) :
    /**
     * Final class for our module
     *
     * This class is intentionally left empty!
     * To extend (modify) the base class, define the G1_Simple_Sliders_Module class in your child theme.
     */
    final class G1_Simple_Sliders_Module extends G1_Simple_Sliders_Base_Module {
    }
endif;






class G1_Simple_Slider_Shortcode extends G1_Shortcode {
    public function __construct( $id, $args = array() ) {
        parent::__construct( $id, $args );

        //add_action( 'g1_shortcode_generator_register', array( $this, 'add_shortcode_generator_item' ) );
    }

    /**
     * Add shortcode to the global shortcode generator
     *
     * @param       G1_Shortcode_Generator $generator
     */
    public function add_shortcode_generator_item( $generator ) {
        $generator->add_item( $this, 'sliders' );
    }

    protected function load_attributes() {
        // entry_id
        $this->add_attribute( 'slider', array(
            'form_control' => 'Choice',
            'choices' => $this->get_avaliable_slider_choices()
        ));
    }

    /**
     * Shortcode callback function.
     *
     * @return string
     */
    protected function do_shortcode() {
        extract( $this->extract() );

        global $post;

        $content	= preg_replace( '#^<\/p>|<p>$#', '', $content );
        $imgs 		= strip_tags( $content );
        $imgs 		= explode( "\n", trim( $imgs ) );

        // Clean attributes
        $entry_id 	= absint( $slider );

        $config = G1_Simple_Sliders_Module()->get_default_config();

        $slides = array();

        /* --------------------------------------------------------------------- */
        /* Build slider from attachments */
        /* --------------------------------------------------------------------- */
        if ( $entry_id ) {

            // Compose final HTML id attribute
            $id = strlen( $id ) ? $id : 'g1-simple-slider-entry-' . $entry_id;

            $slider = get_post( $entry_id );
            if ( ! $slider  )
                return '';

            // Get configuration from the attachments parent ( slider )
            $config = G1_Simple_Sliders_Module()->get_post_config( $slider );

            $width = G1_Simple_Sliders_Module::get_slider_width_in_pixels($config['width']);
            $height = !empty($config['height']) ? $config['height'] : null;

            // Prepare query arguments
            $query_args = array(
                'post_parent'		=> $entry_id,
                'post_type'			=> 'attachment',
                'post_mime_type'	=> array( 'image' ),
                'post_status'		=> 'inherit',
                'posts_per_page'	=> 50,
                'orderby'			=> 'menu_order',
                'order'				=> 'ASC',
                'suppress_filters'  => true
            );

            $query = new WP_Query($query_args);

            if ( $query->have_posts() ) {
                while ( $query->have_posts() ) { $query->the_post();
                    $slide = array(
                        'id'        => $post->ID,
                        'title' 	=> $post->post_excerpt,
                        'content'	=> $post->post_content,
                        'link'		=> get_post_meta( $post->ID, '_g1_alt_link', true ),
                        'linking'	=> get_post_meta( $post->ID, '_g1_alt_linking', true ),
                        'layout'	=> get_post_meta( $post->ID, '_g1_layout', true ),
                        'alt'	    => get_post_meta( $post->ID, '_g1_image_alt', true ),
                    );

                    $orig_src = wp_get_attachment_url( $post->ID );
                    $img_data = aq_resize($orig_src, $width, $height, true, false);

                    if ( $img_data !== false ) {
                        $slide['src'] = $img_data[0];
                        $slide['width'] = $img_data[1];
                        $slide['height'] = $img_data[2];

                        $slides[] = $slide;
                    }
                }
                wp_reset_postdata();
            }

            /* --------------------------------------------------------------------- */
            /* Build slider from shortcode content */
            /* --------------------------------------------------------------------- */
        } else {
            foreach( $imgs as $img ) {
                $slide = array(
                    'title'		=> '',
                    'content'	=> '',
                    'link'		=> '',
                    'linking'	=> '',
                    'layout'	=> '',
                    'src'		=> $img,
                );
                $slides[] = $slide;
            }
        }

        $args = array(
            'id'		=> $id,
            'class'		=> $class,
            'width'		=> $width,
            'height'	=> $height,
        );

        return G1_Simple_Sliders_Module()->capture( $slides, $config, $args );
    }

    protected function get_avaliable_slider_choices () {
        $slider_choices = array();

        $posts_array = get_posts( array('post_type' => 'g1_simple_slider') );

        foreach ( $posts_array as $post ) {
            $slider_choices[$post->ID] = $post->post_title;
        }

        return $slider_choices;
    }
}
function G1_Simple_Slider_Shortcode() {
    static $instance = null;

    if ( null === $instance )
        $instance = new G1_Simple_Slider_Shortcode( 'simple_slider' );

    return $instance;
}
// Fire in the hole :)
G1_Simple_Slider_Shortcode();



/**
 * Enqueues javascripts required for the Simple Slider to work
 */
function g1_simple_slider_wp_footer() {
}