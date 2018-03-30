<?php

class G1_Theme_Front {

    /**
     * Custom CSS configuration
     *
     * @var array
     */
    protected $css_config;

    public function __construct() {
        add_action( 'after_setup_theme', array( $this, 'setup_hooks' ) );
    }

    public function setup_hooks() {
        // Customize WPML
        $this->setup_wpml();

        // Add brand icons
        $this->setup_branding();


        // Improve Search Engine Optimization
        $this->setup_seo();

        // Improve security
        $this->setup_security();


        // Set up the responsive webdesign
        $this->setup_responsive_design();


        // Set up custom CSS modifications
        $this->setup_custom_css();


        // Enqueue javascripts & stylesheets
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        add_action( 'wp_head', array( $this, 'enqueue_ie_only_scripts' ), 1 );

        // Add some body classes
        $this->setup_body_class();


        // Modify the comment form
        $this->setup_comment_form();

        // Modify the password form
        $this->setup_password_form();


        if ( is_plugin_active( 'revslider/revslider.php' ) ) {
            add_action( 'g1_precontent_inner_before',   array($this, 'put_rev_slider_in_precontent') );
        }
    }




    public function put_rev_slider_in_precontent() {
        $slider_id_prefix = 'revslider_';
        $slider_id = G1_Elements()->get( 'slider' );

        if( false === strpos($slider_id, $slider_id_prefix) ) {
            return;
        }

        $slider_alias = str_replace($slider_id_prefix, '', $slider_id);

        echo do_shortcode( '[rev_slider '.$slider_alias.']' );
    }


    public function get_css_config() { return $this->css_config; }
    public function set_css_config( $val ) { $this->css_config = $val; }


    public function setup_custom_css(){
        add_action( 'g1_custom_css',    array( $this, 'render_css_config') );
        add_action( 'init',             array( $this, 'compose_css_config' ) );
    }



    public function setup_wpml() {
        define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);
    }


    public function setup_responsive_design(){
        $setting = g1_get_theme_option( 'general', 'responsive_design' );

        if ( 'none' !== $setting ) {
            // Let's do it as quickly as posssible (priority 1)
            add_action( 'wp_head', array( $this, 'render_viewport_meta_tag' ), 1 );
        }
    }


    public function setup_branding() {
        add_action( 'wp_head', array( $this, 'render_favicon' ) );
        add_action( 'wp_head', array( $this, 'render_apple_touch_icon' ) );
    }

    /**
     * Captures favicon HTML markup
     *
     * @param string $src
     * @return string
     */
    public function capture_favicon( $src = null ) {
        $src = empty( $src ) ? $src = g1_get_theme_option( 'branding', 'favicon' ) : $src;

        if ( empty( $src ) ) {
            return;
        }

        $out = '';
        $out .= strlen( $src ) ? '<link rel="shortcut icon" href="' . esc_url( $src ) . '" />' : '';

        return $out;
    }
    public function render_favicon( $src = null ) {
        echo $this->capture_favicon( $src );
    }




    /**
     * Captures Apple touch icon HTML markup
     *
     * @param string $src
     * @return string
     */
    function capture_apple_touch_icon($src = null) {
        $src = empty($src) ? $src = g1_get_theme_option( 'branding', 'apple_touch_icon' ) : $src;

        if (empty($src)) {
            return;
        }

        $out = '';

        if (strlen($src)) {
            $out .= sprintf('<link rel="apple-touch-icon" href="%s" />', esc_url( $src ));
        }

        return $out;
    }

    function render_apple_touch_icon( $src = null ) {
        echo $this->capture_apple_touch_icon( $src );
    }


    public function render_viewport_meta_tag() {
        echo    "\n" .
                '<meta name="viewport" content="initial-scale=1.0, width=device-width" />' .
                "\n";
    }


    public function setup_security() {
        // Hide the WordPress version info from the <head>
        remove_action('wp_head', 'wp_generator');
    }

    public function setup_seo() {
        // Make sure the <title> tag is not empty
        add_filter( 'wp_title', array( $this, 'prevent_empty_title_tag'), 10, 3 );
    }


    public function prevent_empty_title_tag( $title, $sep, $seplocation ) {
        if ( !strlen( $title ) ) {
            $title = get_bloginfo('name');

            $desc = get_bloginfo( 'description' );
            $title .= strlen( $desc ) ? ' - ' . $desc : '';
        }

        return $title;
    }




    public function setup_body_class() {
        add_filter( 'body_class', array( $this, 'add_font_size_class' ) );
        add_filter( 'body_class', array( $this, 'add_ui_corners_body_class' ) );
        add_filter( 'body_class', array( $this, 'add_preheader_body_class') );
        add_filter( 'body_class', array( $this, 'add_header_body_class') );
        add_filter( 'body_class', array( $this, 'add_precontent_body_class') );
        add_filter( 'body_class', array( $this, 'add_content_body_class') );
        add_filter( 'body_class', array( $this, 'add_prefooter_body_class') );
        add_filter( 'body_class', array( $this, 'add_footer_body_class') );
        add_filter( 'body_class', array( $this, 'add_scroll_body_class') );
    }


    /**
     * Adds font-size specific class to body classes based on Theme Options
     *
     * @param array $classes
     * @return array
     */
    public function add_font_size_class( $classes ) {
        $temp = g1_get_theme_option( 'style_fonts', 'regular_size', 'm' );
        $classes[] = 'g1-font-regular-' . sanitize_html_class( $temp );

        $temp = g1_get_theme_option( 'style_fonts', 'important_size', 'm' );
        $classes[] = 'g1-font-important-' . sanitize_html_class( $temp );

        return $classes;
    }


    /**
     *  Add body classes specific fo ui corners
     *
     * @param array $classes
     * @return array
     */
    public function add_ui_corners_body_class( $classes ) {
        // UI corners
        $temp = (array) g1_get_theme_option( 'style', 'ui_corners', array() );
        // Merge with defaults
        $temp = array_merge(
            array(
                'tl' => 'square',
                'tr' => 'square',
                'br' => 'square',
                'bl' => 'square',
            ),
            $temp
        );

        $classes[] = 'g1-tl-' . sanitize_html_class( $temp['tl'] );
        $classes[] = 'g1-tr-' . sanitize_html_class( $temp['tr'] );
        $classes[] = 'g1-br-' . sanitize_html_class( $temp['br'] );
        $classes[] = 'g1-bl-' . sanitize_html_class( $temp['bl'] );

        return $classes;
    }


    /**
     *  Add body classes specific for the preheader theme area
     *
     * @param array $classes
     * @return array
     */
    public function add_preheader_body_class( $classes ) {

        $temp = g1_get_theme_option( 'ta_preheader', 'open_type', 'expand' );
        $classes[] = 'g1-preheader-open-' . $temp;

        $temp = g1_get_theme_option( 'ta_preheader', 'open_on_startup', 'none' );
        if ($temp !== 'none') {
            $classes[] = 'g1-preheader-open-on-startup';
        }

        // Space after
        $temp = g1_get_theme_option( 'ta_preheader', 'space', 'none' );
        switch ( $temp ) {
            case 'before':
                $classes[] = 'g1-preheader-space-before';
                break;

            case 'after':
                $classes[] = 'g1-preheader-space-after';
                break;

            case 'before_after':
                $classes[] = 'g1-preheader-space-before';
                $classes[] = 'g1-preheader-space-after';
                break;

            default:
                break;
        }

        // Layout
        $temp = g1_get_theme_option( 'ta_preheader', 'layout', 'semi-standard' );
        if ( strlen( $temp ) ) {
            $classes[] = 'g1-preheader-layout-' . sanitize_html_class( $temp );
        }

        // Corners
        $temp = (array) g1_get_theme_option( 'ta_preheader', 'layout_corners', array() );
        // Merge with defaults
        $temp = array_merge(
            array(
                'tl' => 'square',
                'tr' => 'square',
                'br' => 'square',
                'bl' => 'square',
            ),
            $temp
        );

        $classes[] = 'g1-preheader-tl-' . sanitize_html_class( $temp['tl'] );
        $classes[] = 'g1-preheader-tr-' . sanitize_html_class( $temp['tr'] );
        $classes[] = 'g1-preheader-br-' . sanitize_html_class( $temp['br'] );
        $classes[] = 'g1-preheader-bl-' . sanitize_html_class( $temp['bl'] );

        return $classes;
    }


    /**
     *  Add body classes specific for the header theme area
     *
     * @param array $classes
     * @return array
     */
    public function add_header_body_class( $classes ) {
        // Sticky
        $temp = g1_get_theme_option( 'ta_header', 'position', 'static' );
        if ( strlen( $temp ) ) {
            $classes[] = 'g1-header-position-' . sanitize_html_class( $temp );
        }

        // Space after
        $temp = g1_get_theme_option( 'ta_header', 'space', 'none' );
        switch ( $temp ) {
            case 'before':
                $classes[] = 'g1-header-space-before';
                break;

            case 'after':
                $classes[] = 'g1-header-space-after';
                break;

            case 'before_after':
                $classes[] = 'g1-header-space-before';
                $classes[] = 'g1-header-space-after';
                break;

            default:
                break;
        }

        // Layout
        $temp = g1_get_theme_option( 'ta_header', 'layout', 'semi-standard' );
        if ( strlen( $temp ) ) {
            $classes[] = 'g1-header-layout-' . sanitize_html_class( $temp );
        }

        // Composition
        $temp = g1_get_theme_option( 'ta_header', 'composition', 'left-right' );
        if ( strlen( $temp ) ) {
            $classes[] = 'g1-header-comp-' . sanitize_html_class( $temp );
        }

        // Style
        $temp = g1_get_theme_option( 'ta_header', 'primary_nav_style', 'none' );
        if ( strlen( $temp ) ) {
            $classes[] = 'g1-primary-nav--' . sanitize_html_class( $temp );
        }

        // Corners
        $temp = (array) g1_get_theme_option( 'ta_header', 'layout_corners', array() );
        // Merge with defaults
        $temp = array_merge(
            array(
                'tl' => 'square',
                'tr' => 'square',
                'br' => 'square',
                'bl' => 'square',
            ),
            $temp
        );

        $classes[] = 'g1-header-tl-' . sanitize_html_class( $temp['tl'] );
        $classes[] = 'g1-header-tr-' . sanitize_html_class( $temp['tr'] );
        $classes[] = 'g1-header-br-' . sanitize_html_class( $temp['br'] );
        $classes[] = 'g1-header-bl-' . sanitize_html_class( $temp['bl'] );

        // Search
        $temp = g1_get_theme_option( 'ta_header', 'searchform', 'standard' );
        if ( strlen( $temp ) ) {
            $classes[] = 'g1-header-searchform-' . sanitize_html_class( $temp );
        }

        return $classes;


    }


    /**
     *  Add body classes specific for the precontent theme area
     *
     * @param array $classes
     * @return array
     */
    public function add_precontent_body_class( $classes ) {
        // Space after
        $temp = g1_get_theme_option( 'ta_precontent', 'space', 'none' );
        switch ( $temp ) {
            case 'before':
                $classes[] = 'g1-precontent-space-before';
                break;

            case 'after':
                $classes[] = 'g1-precontent-space-after';
                break;

            case 'before_after':
                $classes[] = 'g1-precontent-space-before';
                $classes[] = 'g1-precontent-space-after';
                break;

            default:
                break;
        }

        // Layout
        $temp = g1_get_theme_option( 'ta_precontent', 'layout', 'standard-narrow' );
        if ( strlen( $temp ) ) {
            $classes[] = 'g1-precontent-layout-' . sanitize_html_class( $temp );
        }

        // Corners
        $temp = (array) g1_get_theme_option( 'ta_precontent', 'layout_corners', array() );
        // Merge with defaults
        $temp = array_merge(
            array(
                'tl' => 'square',
                'tr' => 'square',
                'br' => 'square',
                'bl' => 'square',
            ),
            $temp
        );

        $classes[] = 'g1-precontent-tl-' . sanitize_html_class( $temp['tl'] );
        $classes[] = 'g1-precontent-tr-' . sanitize_html_class( $temp['tr'] );
        $classes[] = 'g1-precontent-br-' . sanitize_html_class( $temp['br'] );
        $classes[] = 'g1-precontent-bl-' . sanitize_html_class( $temp['bl'] );

        return $classes;
    }


    /**
     *  Add body classes specific for the content theme area
     *
     * @param array $classes
     * @return array
     */
    public function add_content_body_class( $classes ) {
        // Space after
        $temp = g1_get_theme_option( 'ta_content', 'space', 'none' );
        switch ( $temp ) {
            case 'before':
                $classes[] = 'g1-content-space-before';
                break;

            case 'after':
                $classes[] = 'g1-content-space-after';
                break;

            case 'before_after':
                $classes[] = 'g1-content-space-before';
                $classes[] = 'g1-content-space-after';
                break;

            default:
                break;
        }

        // Layout
        $temp = g1_get_theme_option( 'ta_content', 'layout', 'standard-narrow' );
        if ( strlen( $temp ) ) {
            $classes[] = 'g1-content-layout-' . sanitize_html_class( $temp );
        }

        // Corners
        $temp = (array) g1_get_theme_option( 'ta_content', 'layout_corners', array() );
        // Merge with defaults
        $temp = array_merge(
            array(
                'tl' => 'square',
                'tr' => 'square',
                'br' => 'square',
                'bl' => 'square',
            ),
            $temp
        );

        $classes[] = 'g1-content-tl-' . sanitize_html_class( $temp['tl'] );
        $classes[] = 'g1-content-tr-' . sanitize_html_class( $temp['tr'] );
        $classes[] = 'g1-content-br-' . sanitize_html_class( $temp['br'] );
        $classes[] = 'g1-content-bl-' . sanitize_html_class( $temp['bl'] );

        return $classes;
    }


    /**
     *  Add body classes specific for the prefooter theme area
     *
     * @param array $classes
     * @return array
     */
    public function add_prefooter_body_class( $classes ) {
        $temp = g1_get_theme_option( 'ta_prefooter', 'space', 'none' );
        switch ( $temp ) {
            case 'before':
                $classes[] = 'g1-prefooter-space-before';
                break;

            case 'after':
                $classes[] = 'g1-prefooter-space-after';
                break;

            case 'before_after':
                $classes[] = 'g1-prefooter-space-before';
                $classes[] = 'g1-prefooter-space-after';
                break;

            default:
                break;
        }

        // Layout
        $temp = g1_get_theme_option( 'ta_prefooter', 'layout', 'semi-standard' );
        if ( strlen( $temp ) ) {
            $classes[] = 'g1-prefooter-layout-' . sanitize_html_class( $temp );
        }

        // Corners
        $temp = (array) g1_get_theme_option( 'ta_prefooter', 'layout_corners', array() );
        // Merge with defaults
        $temp = array_merge(
            array(
                'tl' => 'square',
                'tr' => 'square',
                'br' => 'square',
                'bl' => 'square',
            ),
            $temp
        );

        $classes[] = 'g1-prefooter-tl-' . sanitize_html_class( $temp['tl'] );
        $classes[] = 'g1-prefooter-tr-' . sanitize_html_class( $temp['tr'] );
        $classes[] = 'g1-prefooter-br-' . sanitize_html_class( $temp['br'] );
        $classes[] = 'g1-prefooter-bl-' . sanitize_html_class( $temp['bl'] );

        return $classes;
    }


    /**
     *  Add body classes specific for the footer theme area
     *
     * @param array $classes
     * @return array
     */
    public function add_footer_body_class( $classes ) {
        $temp = g1_get_theme_option( 'ta_footer', 'space', 'none' );
        switch ( $temp ) {
            case 'before':
                $classes[] = 'g1-footer-space-before';
                break;

            case 'after':
                $classes[] = 'g1-footer-space-after';
                break;

            case 'before_after':
                $classes[] = 'g1-footer-space-before';
                $classes[] = 'g1-footer-space-after';
                break;

            default:
                break;
        }

        // Layout
        $temp = g1_get_theme_option( 'ta_footer', 'layout', 'semi-standard' );

        if ( strlen( $temp ) ) {
            $classes[] = 'g1-footer-layout-' . sanitize_html_class( $temp );
        }


        // Composition
        $temp = g1_get_theme_option( 'ta_footer', 'composition', '01' );
        if ( strlen( $temp ) ) {
            $classes[] = 'g1-footer-comp-' . sanitize_html_class( $temp );
        }

        // Corners
        $temp = (array) g1_get_theme_option( 'ta_footer', 'layout_corners', array() );
        // Merge with defaults
        $temp = array_merge(
            array(
                'tl' => 'square',
                'tr' => 'square',
                'br' => 'square',
                'bl' => 'square',
            ),
            $temp
        );

        $classes[] = 'g1-footer-tl-' . sanitize_html_class( $temp['tl'] );
        $classes[] = 'g1-footer-tr-' . sanitize_html_class( $temp['tr'] );
        $classes[] = 'g1-footer-br-' . sanitize_html_class( $temp['br'] );
        $classes[] = 'g1-footer-bl-' . sanitize_html_class( $temp['bl'] );

        return $classes;
    }

    public function add_scroll_body_class( $classes ) {
        // background scroll
        $temp = g1_get_theme_option( 'style', 'background_scroll', 'none' );
        if ( strlen( $temp ) && 'none' !== $temp ) {
            $classes[] = 'g1-background-scroll';
        }

        // top background scroll
        $temp = g1_get_theme_option( 'style', 'top_background_scroll', 'none' );
        if ( strlen( $temp ) && 'none' !== $temp ) {
            $classes[] = 'g1-top-background-scroll';
        }

        return $classes;
    }


    public function setup_comment_form() {
        add_filter( 'comment_form_defaults', array( $this, 'remove_notes_from_comment_form') );
    }

    public function setup_password_form() {
        add_filter( 'the_password_form', array( $this, 'customize_the_password_form') );

        add_filter( 'single_template', array( $this, 'alter_password_required_single_template' ), 999 );
        add_filter( 'page_template',   array( $this, 'alter_password_required_single_template' ), 999 );
    }



    function remove_notes_from_comment_form( $defaults ) {
        $defaults['comment_notes_after'] = '';

        return $defaults;
    }



    /**
     * Customizes password form.
     *
     * @param 			string $form
     * @return			string
     */
    public function customize_the_password_form($form) {
        $object = get_post_type_object(get_post_type());
        $text = sprintf( __( "This %s is password protected. To view it please enter your password below:", 'g1_theme' ), $object->labels->singular_name );

        $parts = array(
            '#<form#' =>
            '<p>' . esc_html( $text ) . '</p>' .
                '<form class="g1-form-pass-protected"',
            '#<p>This post is password protected. To view it please enter your password below:</p>#' =>
            '',
        );

        return preg_replace( array_keys( $parts ), array_values( $parts ), $form );
    }


    /**
     * Alternates the single template when the entry is password protected.
     *
     * @param 				string $template
     */
    public function alter_password_required_single_template( $template ) {
        if ( !post_password_required() ) {
            return $template;
        }

        $templates = array();
        $templates[] = 'g1_template_password_required.php';
        $new_template = locate_template( $templates );

        if ( !empty( $new_template ) ) {
            return $new_template;
        }

        return $template;
    }





    /**
     * Generates color variations based on a single color
     *
     * @param $color
     * @return array
     */
    public function get_color_variations( $color ) {
        $result = array();

        $color = new G1_Color( $color );
        $color_rgb = $color->get_rgb();
        $color_rgb = array_map( 'round', $color_rgb );

        $result['hex']      = $color->get_hex();
        $result['r']        = $color_rgb[0];
        $result['g']        = $color_rgb[1];
        $result['b']        = $color_rgb[2];

        $result['from_hex']     = $color->get_hex();
        $result['from_r']       = $color_rgb[0];
        $result['from_g']       = $color_rgb[1];
        $result['from_b']       = $color_rgb[2];
        $result['to_hex']       = $color->get_hex();
        $result['to_r']         = $color_rgb[0];
        $result['to_g']         = $color_rgb[1];
        $result['to_b']         = $color_rgb[2];

        $border2 = G1_Color_Generator::get_tone_color( $color, 20 );
        $border2_rgb = $border2->get_rgb();
        $border2_rgb = array_map( 'round', $border2_rgb );


        $border1 = clone $color;
        $border1->set_lightness( round( ( $border1->get_lightness() + $border2->get_lightness() ) / 2 ) );
        $border1_rgb = $border1->get_rgb();
        $border1_rgb = array_map( 'round', $border1_rgb );

        $result['border2_hex']  = $border2->get_hex();
        $result['border2_r']    = $border2_rgb[0];
        $result['border2_g']    = $border2_rgb[1];
        $result['border2_b']    = $border2_rgb[2];

        $result['border1_hex']  = $border1->get_hex();
        $result['border1_r']    = $border1_rgb[0];
        $result['border1_g']    = $border1_rgb[1];
        $result['border1_b']    = $border1_rgb[2];


        if( $color->get_lightness() >= 50 ) {
            $result['border1_start'] = 0;
            $result['border1_end'] = 0.66;
        } else {
            $result['border1_start'] = 0.66;
            $result['border1_end'] = 0;
        }

        $tone_20_20 = G1_Color_Generator::get_tone_color( $color, 20, 20 );
        $tone_20_20_rgb = $tone_20_20->get_rgb();
        $tone_20_20_rgb = array_map( 'round', $tone_20_20_rgb );

        $result['tone_20_20_hex']  = $tone_20_20->get_hex();
        $result['tone_20_20_r']    = $tone_20_20_rgb[0];
        $result['tone_20_20_g']    = $tone_20_20_rgb[1];
        $result['tone_20_20_b']    = $tone_20_20_rgb[2];

        $tone_5_90 = G1_Color_Generator::get_tone_color( $color, 5, 90 );
        $tone_5_90_rgb = $tone_5_90->get_rgb();
        $tone_5_90_rgb = array_map( 'round', $tone_5_90_rgb );

        $result['tone_5_90_hex']  = $tone_5_90->get_hex();
        $result['tone_5_90_r']    = $tone_5_90_rgb[0];
        $result['tone_5_90_g']    = $tone_5_90_rgb[1];
        $result['tone_5_90_b']    = $tone_5_90_rgb[2];

        return $result;
    }



    /**
     * Composes CSS config
     */
    function compose_css_config() {
        $config = array();

        $config['cs_1_background'] = array(
            'type' => 'color',
            'rules' => array(
                'id1' => array(
                    'selectors' => array(
                        '.g1-table--solid tbody td',
                        '.shop_table tbody td',
                        '.g1-box--simple  .g1-box__icon',
                        '.g1-box--simple  .g1-box__inner',
                        '.g1-box--solid  .g1-box__inner',
                        '.g1-tabs--simple > div',
                        '.g1-gmap__box > .g1-inner',
                        '.g1gmap-marker-bubble-inner',
                        '.g1-isotope-filters > div',
                        '.g1-slide[class*="layout-bubble-"] > .description > .g1-background',
                        '.g1-collection--gallery .entry-featured-media',
                        '.g1-collection--gallery .g1-nonmedia > .g1-inner',
                        '.g1-collection--masonry .g1-nonmedia',
                        '.g1-nav--expanded #g1-primary-nav-menu:after',
                        '.g1-cartbox__box > .g1-inner',
                        '.widget_price_filter .ui-slider-handle',
                        '#payment .payment_box',
                        '.bbp-logged-in:after',
                    ),
                    'css' => array(
                        'id1' => array( 'prop' => 'background-color', 'val' => '#%hex%' ),
                    ),
                ),
                'id2' => array(
                    'selectors' => array(
                        'section',
                        'aside',
                        'article',
                        'header',
                        'nav',
                        'div',
                        'p',
                        'span',
                        'figure',
                        'blockquote',
                        'ul',
                        'ol',
                        'dl',
                        'li',
                        'a',
                        'table',
                        'td',
                        'th',
                        'hr',
                        'form',
                        'select',
                        'input',
                        'textarea',
                        '.g1-button--divider:before',
                        '.g1-button--divider:after',
                        '.g1-tabs--simple .g1-tabs-nav-item',
                        '.entry-header:after', //??
                        '.archive-header:after',
                        '.g1-nav--expanded #g1-primary-nav-menu:after', //??
                        '.g1-cartbox__switch .g1-cartbox__arrow',
                    ),
                    'css' => array(
                        'id1' => array( 'prop' => 'border-color', 'val' => '#%border1_hex%' ),
                    ),
                ),
                'id6' => array(
                    'selectors' => array(
                        '.g1-progress-bar--solid .g1-progress-bar__track',
                        '.g1-twitter--simple .g1-twitter__items:before',
                        '.g1-quote--solid > .g1-inner:before',
                    ),
                    'css' => array(
                        'id1' => array( 'prop' => 'border-color', 'val' => '#%tone_5_90_hex%' ),
                    ),
                ),
                'id7' => array(
                    'selectors' => array(
                        'pre code',
                        '.g1-twitter--simple .g1-twitter__items',
                        '.g1-quote--solid > .g1-inner',
                        '.g1-quote__image',
                        '.g1-box--simple:before',
                        '.g1-box--solid:before',
                        '.countdown_section span',
                        '.g1-placeholder',
                        '.g1-table--solid',
                        '.shop_table:before',
                        '.g1-progress-bar--simple .g1-progress-bar__bar',
                        '.g1-progress-bar--solid .g1-progress-bar__track',
                        '.g1-tabs--simple',
                        '.g1-collection--masonry article',
                        '.g1-isotope-filters',
                        '.g1-side-nav .children',
                        '#wp-calendar #prev span',
                        '#wp-calendar #next span',
                        '#wp-calendar tbody td',
                        '.g1-chat.g1-authors-two .g1-chat-author-2',
                        '.g1-nav--expanded #g1-primary-nav-menu:before',
                        '.widget_price_filter .price_slider_wrapper .ui-widget-content',
                        '.woocommerce-message',
                        '.woocommerce-info',
                        '.woocommerce-error',
                        '.bbp-template-notice',
                        '#payment',
                        '.bbp-logged-in:before',
                        '.bbp-topics-front ul.super-sticky',
                        '.bbp-topics ul.super-sticky',
                        '.bbp-topics ul.sticky',
                        '.bbp-forum-content ul.sticky',
                    ),
                    'css' => array(
                        'id1' => array ( 'prop' => 'background-color', 'val' => '#%tone_5_90_hex%' ),
                    ),
                ),
                'id8' => array(
                    'selectors' => array(
                        '.g1-divider i',
                        '.g1-duplicate i',
                        '.g1-form-pass-protected:before',
                        '.g1-replies h2:before',
                        '#reply-title:before',
                        '.comment.parent > article:before',
                        '.comment.parent > .children > .comment:before',
                        '.comment.parent > .children > .comment:after',
                    ),
                    'css' => array(
                        'id1' => array( 'prop' => 'color', 'val' => '#%border2_hex%' ),
                    )
                ),
                'id10' => array(
                    'selectors' => array(
                        '.countdown_section:first-child span',
                        '#wp-calendar tbody td + td + td + td + td + td',
                        '.g1-cartbox__box',
                    ),
                    'css' => array(
                        'id1' => array( 'prop' => 'background-color', 'val' => '#%border1_hex%' ),
                    ),
                ),

                'id11' => array(
                    'selectors' => array(
                        '.g1-icon--solid',
                        '#wp-calendar #prev span',
                        '#wp-calendar #next span',
                    ),
                    'css' => array(
                        'id1' => array( 'prop' => 'color', 'val' => '#%hex%' ),
                    ),
                ),
                'id12' => array(
                    'selectors' => array(
                        '.g1-collection--gallery .g1-nonmedia > .g1-inner:after',
                    ),
                    'css' => array(
                        'id1' => array( 'prop' => 'border-color', 'val' => '#%hex%' ),
                    ),
                ),
            ),
        );

        // Important text
        $config['cs_1_text1'] = array(
            'type' => 'color',
            'rules' => array(
                'id1' => array(
                    'selectors' => array(
                        'h1',
                        'h2',
                        'h3',
                        'h4',
                        'h5',
                        'h6',
                        '.g1-meta a:hover',
                        '.g1-button--simple',
                        '.g1-toggle--simple .g1-toggle__swit.g1-isotope-filtersch',
                        '.g1-tabs--button .g1-tabs-nav-item .g1-tab-title',
                        '.g1-side-nav a:hover',
                        '.g1-pagination .prev',
                        '.g1-pagination .next',
                        '.countdown_section:first-child',
                        '.g1-simple-slider .g1-fullscreen > a',
                        '.g1-widget a:hover',
                        '.g1-nav-item__switch',
                    ),
                    'css' => array(
                        'id1' => array( 'prop' => 'color', 'val' => '#%hex%' ),
                    ),
                ),
                'id2' => array(
                    'selectors' => array(
                        '.g1-button--simple',
                        '.g1-toggle--simple .g1-toggle__switch',
                        '.g1-tabs--button .g1-tabs-nav-item .g1-tab-title',
                        '.g1-simple-slider .g1-fullscreen > a',
                        '.g1-nav-item__switch',
                    ),
                    'css' => array(
                        'id1' => array( 'prop' => 'border-color', 'val' => '#%hex%' ),
                    ),
                ),
            ),
        );

        // Regular text
        $config['cs_1_text2'] = array(
            'type' => 'color',
            'rules' => array(
                'id1' => array(
                    'selectors' => array(
                        '',
                        '.g1-regular',
                        'h1 + h3',
                        'h1 + h4',
                        'h1 + h5',
                        'h1 + h6',
                        'h2 + h4',
                        'h2 + h5',
                        'h2 + h6',
                        'h3 + h5',
                        'h3 + h6',
                        'h4 + h6',
                        '.g1-h1 + h3',
                        '.g1-h1 + h4',
                        '.g1-h1 + h5',
                        '.g1-h1 + h6',
                        '.g1-h2 + h4',
                        '.g1-h2 + h5',
                        '.g1-h2 + h6',
                        '.g1-h3 + h5',
                        '.g1-h3 + h6',
                        '.g1-h4 + h6',
                        '.g1-meta a',
                        '.g1-side-nav a',
                        '.g1-duplicator--simple .g1-duplicate--active i',
                        '.g1-isotope-filter > a',
                        '.g1-links a',
                        '.g1-searchbox__switch',
                        '.g1-cartbox__switch',
                    ),
                    'css' => array(
                        'id1' => array( 'prop' => 'color', 'val' => '#%hex%' ),
                    ),
                ),
                'id2' => array(
                    'selectors' => array(
                        '.g1-icon--solid',
                    ),
                    'css' => array(
                        'id1' => array( 'prop' => 'background-color', 'val' => '#%hex%' ),
                    ),
                ),
                'id3' => array(
                    'selectors' => array(
                        '.g1-icon--solid',
                    ),
                    'css' => array(
                        'id1' => array( 'prop' => 'border-color', 'val' => '#%hex%' ),
                    ),
                ),
            ),
        );

        // Meta text
        $config['cs_1_text3'] = array(
            'type' => 'color',
            'rules'=> array(
                'id1' => array(
                    'selectors' => array(
                        '.g1-meta',
                    ),
                    'css' => array(
                        'id1' => array( 'prop' => 'color', 'val' => '#%hex%' ),
                    ),
                ),
                'id2' => array(
                    'selectors' => array(
                        '.g1-dropdown > li + li:before',
                        '.g1-dropdown > li + li:after',
                        '.entry-categories li + li:before',
                        '.entry-categories li + li:after',
                        '.g1-footer-menu li + li:before',
                        '.g1-footer-menu li + li:after',
                    ),
                    'css' => array(
                        'id1' => array( 'prop' => 'border-color', 'val' => '#%hex%' ),
                    ),
                ),
            ),
        );

        // Link
        $config['cs_1_link'] = array(
            'type' => 'color',
            'rules' => array(
                'id1' => array(
                    'selectors' => array(
                        'a',
                        //'#g1-primary-nav-menu > .current_page_ancestor > a',
                        //'#g1-primary-nav-menu > .current_page_parent > a',
                        //'#g1-primary-nav-menu > .current_page_item > a',
                    ),
                    'css' => array(
                        'id1' => array( 'prop' => 'color', 'val' => '#%hex%' ),
                    ),
                ),
            ),
        );

        // Link hover
        $config['cs_1_link_hover'] = array(
            'type' => 'color',
            'rules' => array(
                'id1' => array(
                    'selectors' => array(
                        'a:hover',
                    ),
                    'css' => array(
                        'id1' => array( 'prop' => 'color', 'val' => '#%hex%' ),
                    ),
                ),
            ),
        );

        $config['cs_2_background'] = array(
            'type' => 'color',
            'rules' => array(
                'id1' => array(
                    'selectors' => array(
                        '.g1-divider--simple:before',
                        '.g1-tabs--button .g1-tabs-nav-current-item .g1-tab-title',
                        '.gallery-icon > a:before',
                        '.g1-collection--gallery article:before',
                        '.g1-collection--gallery .g1-nonmedia > .g1-01',
                        '.g1-dropcap--solid',
                        'input[type=button]',
                        'input[type=submit]',
                        'button',
                        '.g1-button--solid',
                        'a.button',
                        '.g1-frame--solid > .g1-decorator',
                        '.g1-toggle--solid .g1-toggle__switch',
                        '.g1-indicator:before',
                        '.g1-progress-bar--solid .g1-progress-bar__bar',
                        '.g1-progress-circle .g1-color-scheme',
                        '.g1-countdown i',
                        '.g1-box--solid .g1-box__icon',
                        '.g1-banda__handle span',
                        '.g1-banda--smooth .g1-banda__handle',
                        '.g1-isotope-filter--current:before',
                        '.g1-simple-slider .g1-progress > div > div',
                        '.g1-simple-slider.g1-nav-coin-thumbs .g1-nav-coin .g1-selected a:before',
                        '.g1-simple-slider .g1-nav-direction__prev',
                        '.g1-simple-slider .g1-nav-direction__next',
                        '.g1-mediabox--slider .g1-nav-coin a:before',
                        '.g1-searchbox .g1-outer',
                        '.g1-gmap-wrapper .g1-pan-control',
                        '.g1-gmap-wrapper .g1-full-map-control',
                        '#wp-calendar #prev a',
                        '#wp-calendar #next a',
                        '.g1-nav--mobile #g1-secondary-nav-menu > li',
                        '#lang_sel ul ul li',
                        '#g1-primary-nav-switch',
                        '.widget_price_filter .ui-slider .ui-slider-range',
                    ),
                    'css' => array(
                        'id1' => array( 'prop' => 'background-color', 'val' => '#%hex%' ),
                    ),
                ),
                'id3' => array(
                    'selectors' => array(
                        '.g1-progress-circle--simple .g1-color-scheme',
                    ),
                    'css' => array(
                        'id1' => array( 'prop' => 'outline-color', 'val' => '#%hex%' ),
                    ),
                ),
                'id4' => array(
                    'selectors' => array(
                        'input[type=button]',
                        'input[type=submit]',
                        'button',
                        '.g1-button--solid',
                        'a.button',
                        '.g1-frame--solid > .g1-decorator',
                        '.g1-progress-bar--solid .g1-progress-bar__bar',
                        '.g1-toggle--solid .g1-toggle__switch',
                        '.g1-tabs--simple .g1-tabs-nav-current-item .g1-tab-title:before',
                        '.g1-tabs--button .g1-tabs-nav-current-item .g1-tab-title',
                        '.g1-tabs--button .g1-tabs-nav-current-item .g1-tab-title:after',
                        '.g1-box--solid .g1-box__icon',
                        '.author-info:before',
                        '.g1-related-entries:before',
                        '.g1-replies:before',
                        '#respond:before',
                        '.upsells:before',
                        '.related:before',
                        '#secondary .widget + .widget:before',
                        '#g1-primary-nav-switch',
                        '.widget_price_filter .ui-slider-handle',
                    ),
                    'css' => array(
                        'id1' => array( 'prop' => 'border-color', 'val' => '#%hex%' ),
                    ),
                ),
                'id5' => array(
                    'selectors' => array(
                        '.g1-tabs--button .g1-tabs-nav-current-item .g1-tab-title',
                    ),
                    'css' => array(
                        'id1' => array( 'prop' => 'background-color', 'val' => '#%to_hex%' ),
                    ),
                ),
                'id6' => array(
                    'selectors' => array(
                        'mark',
                        'input[type=button]:hover',
                        'input[type=submit]:hover',
                        'button:hover',
                        '.g1-button:hover',
                        'a.button:hover',
                        '.g1-simple-slider .g1-fullscreen > a:hover',
                    ),
                    'css' => array(
                        'id1' => array( 'prop' => 'background-color', 'val' => '#%tone_20_20_hex%' ),
                    ),
                ),
                'id6b' => array(
                    'selectors' => array(
                        'input[type=button]:hover',
                        'input[type=submit]:hover',
                        'button:hover',
                        '.g1-button:hover',
                        'a.button:hover',
                        '.g1-simple-slider .g1-fullscreen > a:hover',
                    ),
                    'css' => array(
                        'id1' => array( 'prop' => 'border-color', 'val' => '#%tone_20_20_hex%' ),
                    ),
                ),
                'id7' => array(
                    'selectors' => array(
                        //'#g1-primary-nav-menu li[class*="g1-type-tile-"] > .g1-submenus a',
                    ),
                    'css' => array(
                        'id1' => array( 'prop' => 'border-color', 'val' => '#%hex%' ),
                    ),
                ),
                'id8' => array(
                    'selectors' => array(
                        '.g1-list--simple .g1-list__icon',
                        '.g1-duplicator--solid .g1-duplicate--active i',
                        '.g1-numbers__icon',
                        //'#g1-primary-nav-menu li[class*="g1-type-tile-"] > .g1-submenus a:hover',
                    ),
                    'css' => array(
                        'id1' => array( 'prop' => 'color', 'val' => '#%hex%' ),
                    ),
                ),
                'id9' => array(
                    'selectors' => array(
                        '.g1-gmap-wrapper .g1-zoom-control',
                        '.g1-nav--mobile #g1-secondary-nav-menu',
                        '#lang_sel ul ul',
                        '.g1-searchbox #searchform',
                        '.g1-nav--collapsed #g1-primary-nav-menu > .g1-type-drops ul',
                        '.g1-nav--collapsed #g1-primary-nav-menu > .g1-type-tile > .g1-submenus',
                        '.g1-nav--collapsed #g1-primary-nav-menu > .g1-type-column > .g1-submenus',
                    ),
                    'css' => array(
                        'id1' => array( 'prop' => 'background-color', 'val' => '#%border1_hex%' ),
                    ),
                ),
                'id10' => array(
                    'selectors' => array(
                        '.g1-nav--mobile #g1-secondary-nav-menu > li',
                        '.g1-nav--mobile #g1-secondary-nav-menu:before',
                        '#lang_sel ul ul li',
                        '#lang_sel ul ul:before',
                        '.g1-searchbox__switch .g1-searchbox__arrow',
                        '.g1-nav--collapsed #g1-primary-nav-menu > li > a .g1-nav-item__arrow',
                        '.g1-nav--collapsed #g1-primary-nav-menu > li.g1-type-drops li',
                    ),
                    'css' => array(
                        'id1' => array( 'prop' => 'border-color', 'val' => '#%border1_hex%' ),
                    ),
                ),
            ),
        );

        $config['cs_2_text1'] = array(
            'type' => 'color',
            'rules' => array(
                'id1' => array(
                    'selectors' => array(
                        'mark',
                        '.g1-dropcap--solid',
                        '.g1-indicator:after',
                        'input[type=button]',
                        'input[type=submit]',
                        'button',
                        '.g1-button--solid',
                        'input[type=button]:hover',
                        'input[type=submit]:hover',
                        'button:hover',
                        '.g1-button--solid:hover',
                        '.g1-button--simple:hover',
                        'a.button',
                        '.g1-tabs--button .g1-tabs-nav-current-item .g1-tab-title',
                        '.g1-toggle--solid .g1-toggle__switch',
                        '.g1-progress-bar--solid .g1-progress-bar__bar',
                        '.g1-progress-circle--solid',
                        '.g1-countdown i',
                        '.g1-box--solid .g1-box__icon',
                        '.g1-banda__handle span',
                        '.g1-simple-slider .g1-fullscreen > a:hover',
                        '.g1-simple-slider .g1-nav-direction__prev',
                        '.g1-simple-slider .g1-nav-direction__next',
                        '.g1-mediabox--slider .g1-nav-coin a:after',
                        '.gallery-icon > a:after',
                        '.g1-searchbox #s',
                        '.g1-searchbox .g1-form-actions:before',
                        '.g1-gmap-wrapper .g1-pan-control',
                        '.g1-gmap-wrapper .g1-zoom-control',
                        '.g1-gmap-wrapper .g1-full-map-control a',
                        '.g1-nav--mobile #g1-secondary-nav-menu > li > a',
                        '#lang_sel ul ul a',
                        '#g1-primary-nav-switch',
                        '#wp-calendar #prev a:after',
                        '#wp-calendar #next a:after',
                    ),
                    'css' => array(
                        'id1' => array( 'prop' => 'color', 'val' => '#%hex%' ),
                    ),
                ),
                'id2' => array(
                    'selectors' => array(
                        //'#g1-primary-nav-menu li[class*="g1-type-tile-"] > .g1-submenus a:hover',
                    ),
                    'css' => array(
                        'id1' => array( 'prop' => 'background-color', 'val' => '#%hex%' ),
                    ),
                ),
                'id3' => array(
                    'selectors' => array(
                        '.g1-searchbox #s',
                    ),
                    'css' => array(
                        'id1' => array( 'prop' => 'border-color', 'val' => '#%hex%' ),
                    ),
                ),
                'id4' => array(
                    'selectors' => array(
                        '.g1-progress-circle--solid .g1-color-scheme',
                    ),
                    'css' => array(
                        'id1' => array( 'prop' => 'outline-color', 'val' => '#%hex%' ),
                    ),
                ),
            ),
        );

        $config = apply_filters( 'g1_theme_area_css_config', $config );

        $theme_areas = array(
            'preheader'     => __( 'Preheader', 'g1_theme' ),
            'header'        => __( 'Header', 'g1_theme' ),
            'precontent'    => __( 'Precontent', 'g1_theme' ),
            'content'       => __( 'Content', 'g1_theme' ),
            'prefooter'     => __( 'Prefooter', 'g1_theme' ),
            'footer'        => __( 'Footer', 'g1_theme' ),
        );

        $theme_area_selectors = array(
            'preheader'     => '.g1-preheader',
            'header'        => '.g1-header',
            'precontent'    => '.g1-precontent',
            'content'       => '.g1-content',
            'prefooter'     => '.g1-prefooter',
            'footer'        => '.g1-footer',
        );

        $new_config = array();
        foreach ( $theme_areas as $theme_area => $theme_area_label ) {
            $ta_config = array();

            foreach ( $config as $setting_id => $setting_args ) {
                $new_setting_args = $setting_args;

                foreach ( $setting_args['rules'] as $rule_id => $rule_args ) {
                    $new_rule_args = $rule_args;
                    foreach ( $new_rule_args['selectors'] as $key => $selector ) {
                        $new_rule_args['selectors'][ $key ] = $theme_area_selectors[ $theme_area ] . ' ' . $selector;
                    }

                    $new_setting_args['rules'][ $rule_id ] = $new_rule_args;
                }

                $ta_config[ $setting_id ] = $new_setting_args;
            }

            $new_config[ 'ta_' . $theme_area ] = $ta_config;
        }


        // body

        $new_config['style']['background']['rules']['bg1'] = array(
            'selectors' => array(
                'body',
            ),
            'css' => array(
                'id1' => array( 'prop' => 'background-color', 'val' => '#%hex%' ),
            ),
        );


        // ----- PREHEADER -----
        $opacity = absint( g1_get_theme_option( 'ta_preheader', 'cs_1_background_opacity', 100 ) );
        if ( 100 === $opacity ) {
            $new_config['ta_preheader']['cs_1_background']['rules']['bg1'] = array(
                'selectors' => array(
                    '.g1-preheader > .g1-background',
                ),
                'css' => array(
                    'id1' => array( 'prop' => 'background-color', 'val' => '#%hex%' ),
                ),
            );
        }


        // ----- HEADER -----
        $opacity = absint( g1_get_theme_option( 'ta_header', 'cs_1_background_opacity', 100 ) );
        if ( 100 === $opacity ) {
            $new_config['ta_header']['cs_1_background']['rules']['bg1'] = array(
                'selectors' => array(
                    '.g1-header > .g1-background',
                ),
                'css' => array(
                    'id1' => array( 'prop' => 'background-color', 'val' => '#%hex%' ),
                ),
            );
        }


        array_push($new_config['ta_header']['cs_2_background']['rules']['id1']['selectors'],
            '.g1-nav--collapsed #g1-primary-nav-menu .g1-type-column .g1-submenus:before',
            '.g1-nav--collapsed #g1-primary-nav-menu .g1-type-tile .g1-submenus a',
            '.g1-nav--collapsed #g1-primary-nav-menu .g1-type-drops .g1-submenus a'
        );


        switch ( g1_get_theme_option( 'ta_header', 'primary_nav_style', 'none' ) ) {
            case 'simple':
                array_push( $new_config['ta_header']['cs_1_text2']['rules']['id1']['selectors'],
                    '.g1-nav--simple.g1-nav--collapsed #g1-primary-nav-menu > li > a'
                );
                array_push( $new_config['ta_header']['cs_2_background']['rules']['id1']['selectors'],
                    '.g1-nav--simple.g1-nav--collapsed #g1-primary-nav-menu > .current_page_ancestor > a',
                    '.g1-nav--simple.g1-nav--collapsed #g1-primary-nav-menu > .current_page_parent > a',
                    '.g1-nav--simple.g1-nav--collapsed #g1-primary-nav-menu > .current_page_item > a'
                );
                array_push( $new_config['ta_header']['cs_2_text1']['rules']['id1']['selectors'],
                    '.g1-nav--simple.g1-nav--collapsed #g1-primary-nav-menu > .current_page_ancestor > a',
                    '.g1-nav--simple.g1-nav--collapsed #g1-primary-nav-menu > .current_page_parent > a',
                    '.g1-nav--simple.g1-nav--collapsed #g1-primary-nav-menu > .current_page_item > a'
                );
                break;

            case 'solid':
                array_push( $new_config['ta_header']['cs_1_text2']['rules']['id2']['selectors'],
                    '.g1-nav--solid.g1-nav--collapsed #g1-primary-nav-menu > li > a'
                );

                array_push( $new_config['ta_header']['cs_1_background']['rules']['id11']['selectors'],
                    '.g1-nav--solid.g1-nav--collapsed #g1-primary-nav-menu > li > a'
                );


                array_push( $new_config['ta_header']['cs_2_background']['rules']['id1']['selectors'],
                    '.g1-nav--solid.g1-nav--collapsed #g1-primary-nav-menu > .current_page_ancestor > a',
                    '.g1-nav--solid.g1-nav--collapsed #g1-primary-nav-menu > .current_page_parent > a',
                    '.g1-nav--solid.g1-nav--collapsed #g1-primary-nav-menu > .current_page_item > a'
                );
                array_push( $new_config['ta_header']['cs_2_text1']['rules']['id1']['selectors'],
                    '.g1-nav--solid.g1-nav--collapsed #g1-primary-nav-menu > .current_page_ancestor > a',
                    '.g1-nav--solid.g1-nav--collapsed #g1-primary-nav-menu > .current_page_parent > a',
                    '.g1-nav--solid.g1-nav--collapsed #g1-primary-nav-menu > .current_page_item > a'
                );
                break;

            // Unstyled
            default:
                array_push( $new_config['ta_header']['cs_1_text2']['rules']['id1']['selectors'],
                    '.g1-nav--unstyled.g1-nav--collapsed #g1-primary-nav-menu > li > a'
                );
                array_push( $new_config['ta_header']['cs_1_link']['rules']['id1']['selectors'],
                    '.g1-nav--unstyled.g1-nav--collapsed #g1-primary-nav-menu > .current_page_ancestor > a',
                    '.g1-nav--unstyled.g1-nav--collapsed #g1-primary-nav-menu > .current_page_parent > a',
                    '.g1-nav--unstyled.g1-nav--collapsed #g1-primary-nav-menu > .current_page_item > a'
                );
                break;
        }


//        $new_config['ta_header']['cs_2_background']['rules']['id1']['selectors'][] = '.g1-type-column > .g1-submenus ul';
        $new_config['ta_header']['cs_2_background']['rules']['id7']['selectors'][] = '.g1-nav--collapsed #g1-primary-nav-menu .g1-type-tile .g1-submenus a';
        $new_config['ta_header']['cs_2_background']['rules']['id8']['selectors'][] = '.g1-nav--collapsed #g1-primary-nav-menu .g1-type-tile .g1-submenus a:hover';


        $new_config['ta_header']['cs_2_text1']['rules']['id1']['selectors'][] = '.g1-nav--collapsed #g1-primary-nav-menu .g1-submenus a';
//        $new_config['ta_header']['cs_2_text1']['rules']['id1']['selectors'][] = '#g1-primary-nav-menu li.g1-type-tile > .g1-submenus a';
//        $new_config['ta_header']['cs_2_text1']['rules']['id1']['selectors'][] = '#g1-primary-nav-menu li.g1-type-column > .g1-submenus a';

        $new_config['ta_header']['cs_2_text1']['rules']['id2']['selectors'][] = '.g1-nav--collapsed #g1-primary-nav-menu .g1-type-tile .g1-submenus a:hover';


        // ----- PRECONTENT -----
        $opacity = absint( g1_get_theme_option( 'ta_precontent', 'cs_1_background_opacity', 100 ) );
        if ( 100 === $opacity ) {
            $new_config['ta_precontent']['cs_1_background']['rules']['bg1'] = array(
                'selectors' => array(
                    '.g1-precontent > .g1-background',
                ),
                'css' => array(
                    'id1' => array( 'prop' => 'background-color', 'val' => '#%hex%' ),
                ),
            );
        }



        // ----- CONTENT -----
        $opacity = absint( g1_get_theme_option( 'ta_content', 'cs_1_background_opacity', 100 ) );
        if ( 100 === $opacity ) {
            $new_config['ta_content']['cs_1_background']['rules']['bg1'] = array(
                'selectors' => array(
                    '.g1-content > .g1-background',
                ),
                'css' => array(
                    'id1' => array( 'prop' => 'background-color', 'val' => '#%hex%' ),
                ),
            );
        }


        // ----- PREFOOTER ------
        $opacity = absint( g1_get_theme_option( 'ta_prefooter', 'cs_1_background_opacity', 100 ) );
        if ( 100 === $opacity ) {
            $new_config['ta_prefooter']['cs_1_background']['rules']['bg1'] = array(
                'selectors' => array(
                    '.g1-prefooter > .g1-background',
                ),
                'css' => array(
                    'id1' => array( 'prop' => 'background-color', 'val' => '#%hex%' ),
                ),
            );
        }

        // ----- FOOTER -----
        $opacity = absint( g1_get_theme_option( 'ta_footer', 'cs_1_background_opacity', 100 ) );
        if ( 100 === $opacity ) {
            $new_config['ta_footer']['cs_1_background']['rules']['bg1'] = array(
                'selectors' => array(
                    '.g1-footer > .g1-background',
                ),
                'css' => array(
                    'id1' => array( 'prop' => 'background-color', 'val' => '#%hex%' ),
                ),
            );
        }

        array_push( $new_config['ta_footer']['cs_1_text2']['rules']['id1']['selectors'],
            '#g1-footer-nav-menu > li > a'
        );
        array_push( $new_config['ta_footer']['cs_1_text1']['rules']['id1']['selectors'],
            '#g1-footer-nav-menu > li > a:hover'
        );

        $this->set_css_config( $new_config );
    }



    /**
     * Captures custom styles (set in Theme Options) compiled into css code.
     *
     * @return string
     */
    public function capture_css_config() {
        $out = '';

        foreach( $this->get_css_config() as $base => $settings ) {

            foreach( $settings as $setting_id => $setting_args ) {
                $color = g1_get_theme_option( $base, $setting_id, '' );

                if ( !empty( $color) ) {
                    $out .= '/* ' . $setting_id . ' */' . "\n";

                    $colors = $this->get_color_variations( $color );

                    // Search patterns
                    $search_array = array_keys( $colors );
                    foreach ( $search_array as $k => $v ) {
                        $search_array[$k] = '%' . $v . '%';
                    }

                    // Replace with color values
                    $replace_array = array_values( $colors );

                    foreach( $setting_args['rules'] as $rule_id => $rule_args ) {
                        // Join selectors with comma
                        $selectors = implode(',' . "\n", $rule_args['selectors']);

                        $css = '';
                        foreach ( $rule_args['css'] as $css_id => $css_args ) {
                            $css .= $css_args['prop'] . ':' . $css_args['val'] . ';' . "\n";
                        }

                        $css = str_replace(
                            $search_array,
                            $replace_array,
                            $css
                        );


                        $out .= $selectors . ' {' . "\n" . $css . "\n" . '}' . "\n";
                    }
                }
            }
        }

        $theme_areas = array(
            'preheader',
            'header',
            'precontent',
            'content',
            'prefooter',
            'footer',
        );

        foreach ( $theme_areas as $slug ) {
            $image = g1_get_theme_option( 'ta_' . $slug, 'cs_1_background_image', '' );

            if ( strlen( $image ) ) {
                $repeat = g1_get_theme_option( 'ta_' . $slug, 'cs_1_background_repeat', 'repeat' );
                $position = g1_get_theme_option( 'ta_' . $slug, 'cs_1_background_position', 'center' );
                $attachment = g1_get_theme_option( 'ta_' . $slug, 'cs_1_background_attachment', 'scroll' );

                $css_rules = array();
                $css_rules[] = 'background-image:url(' . esc_url( $image ) .  ');';
                $css_rules[] = 'background-position:' . $position . ';';
                $css_rules[] = 'background-repeat:' . $repeat . ';';
                $css_rules[] = 'background-attachment:' . $attachment . ';';

                $out .= '.g1-' . $slug . ' > .g1-background {' . implode( '', $css_rules ) . '}' . "\n";
            }
        }

        /* body-background */
        $arr = array();
        $bg_color = g1_get_theme_option( 'style', 'background' );
        if ( strlen( $bg_color) ) {
            $bg_color = new G1_Color( $bg_color );
            $bg_color = $bg_color->get_hex();

            $arr[] = "background-color:#{$bg_color};";
        }
        $bg_switch = g1_get_theme_option( 'style', 'background_switch' );
        if ( 'standard' === $bg_switch ) {
            // image
            $bg_image = g1_get_theme_option( 'style', 'background_image' );
            $bg_image = esc_url( $bg_image );
            $arr[] = "background-image:url({$bg_image});";

            //position
            $bg_position = g1_get_theme_option( 'style', 'background_position', 'center center' );
            $bg_position = preg_replace( '/[^a-z- ]/', '', $bg_position );
            $arr[] = "background-position:{$bg_position};";

            //repeat
            $bg_repeat = g1_get_theme_option( 'style', 'background_repeat', 'repeat' );
            $bg_repeat = preg_replace( '/[^a-z- ]/', '', $bg_repeat );
            $arr[] = "background-repeat:{$bg_repeat};";

            //attachment
            $bg_attachment = g1_get_theme_option( 'style', 'background_attachment', 'scroll' );
            $bg_attachment = preg_replace( '/[^a-z- ]/', '', $bg_attachment );
            $arr[] = "background-attachment:{$bg_attachment};";
        }
        $arr = implode( ' ', $arr );
        $out .= "body { {$arr}}\n";



        /* top-background */
        $arr = array();
        $bg_color = g1_get_theme_option( 'style', 'top_background' );
        if ( strlen( $bg_color) ) {
            $bg_color = new G1_Color( $bg_color );
            $bg_color = $bg_color->get_hex();

            $arr[] = "background-color:#{$bg_color};";
        }
        $bg_switch = g1_get_theme_option( 'style', 'top_background_switch' );
        if ( 'standard' === $bg_switch ) {
            // image
            $bg_image = g1_get_theme_option( 'style', 'top_background_image' );
            $bg_image = esc_url( $bg_image );
            $arr[] = "background-image:url({$bg_image});";

            //position
            $bg_position = g1_get_theme_option( 'style', 'top_background_position', 'center center' );
            $bg_position = preg_replace( '/[^a-z- ]/', '', $bg_position );
            $arr[] = "background-position:{$bg_position};";

            //repeat
            $bg_repeat = g1_get_theme_option( 'style', 'top_background_repeat', 'repeat' );
            $bg_repeat = preg_replace( '/[^a-z- ]/', '', $bg_repeat );
            $arr[] = "background-repeat:{$bg_repeat};";

            //attachment
            $bg_attachment = g1_get_theme_option( 'style', 'top_background_attachment', 'scroll' );
            $bg_attachment = preg_replace( '/[^a-z- ]/', '', $bg_attachment );
            $arr[] = "background-attachment:{$bg_attachment};";
        }
        $arr = implode( ' ', $arr );
        $out .= "#g1-top > .g1-background { {$arr}}\n";



        /* Preheader borders */
        $out .= $this->capture_ta_border_top_css('preheader');
        $out .= $this->capture_ta_border_bottom_css('preheader');


        /* Header borders */
        $out .= $this->capture_ta_border_top_css('header');
        $out .= $this->capture_ta_border_bottom_css('header');

        /* Precontent borders */
        $out .= $this->capture_ta_border_top_css('precontent');
        $out .= $this->capture_ta_border_bottom_css('precontent');

        /* Content borders */
        $out .= $this->capture_ta_border_top_css('content');
        $out .= $this->capture_ta_border_bottom_css('content');

        /* Prefooter borders */
        $out .= $this->capture_ta_border_top_css('prefooter');
        $out .= $this->capture_ta_border_bottom_css('prefooter');

        /* Footer borders */
        $out .= $this->capture_ta_border_top_css('footer');
        $out .= $this->capture_ta_border_bottom_css('footer');


        // ----- HEADER -----
        $temp = g1_get_theme_option( 'ta_header', 'id_margin_top' );
        if ( is_numeric( $temp ) ) {
            $_val = absint( $temp );
            $out .= "#g1-id { padding-top:{$_val}px; }\n";
        }
        $temp = g1_get_theme_option( 'ta_header', 'id_margin_bottom' );
        if ( is_numeric( $temp ) ) {
            $_val = absint( $temp );
            $out .= "#g1-id { padding-bottom:{$_val}px; }\n";
        }

        $temp = g1_get_theme_option( 'ta_header', 'primary_nav_margin_top' );
        if ( is_numeric( $temp ) ) {
            $temp = absint( $temp );

            $out .= '#g1-primary-nav {' . "\n" .

                'margin-top: ' . $temp . 'px;' ."\n" .
                '}' . "\n";
        }


        //$colors = $this->get_color_variations( $color );





        $padding_top = g1_get_theme_option( 'style_fonts', 'primary_nav_padding_top' );
        $padding_top = is_numeric( $padding_top ) ? absint( $padding_top ) : 10;

        $padding_bottom = g1_get_theme_option( 'style_fonts', 'primary_nav_padding_bottom' );
        $padding_bottom = is_numeric( $padding_bottom ) ? absint( $padding_bottom ) : 10;

        $font_size = g1_get_theme_option( 'style_fonts', 'primary_nav_size' );
        $line_height = $font_size;

        $arr = array(
            "padding-top:{$padding_top}px;",
            "padding-bottom:{$padding_bottom}px;",
            "font-size:{$font_size}px;",
            "line-height:{$line_height}px;",
        );
        $arr = implode( ' ', $arr );

        $out .= "#g1-primary-nav-menu > li > a { {$arr} }\n";
        $out .= "#g1-primary-nav .g1-searchbox__switch { {$arr} }\n";
        $out .= "#g1-primary-nav .g1-cartbox__switch { {$arr} }\n";

        return $out;
    }
    public function render_css_config( $css ){
        $css .= $this->capture_css_config();
        return $css;
    }

    protected function capture_ta_border_top_css( $ta ) {
        $out = '';
        $prefix = 'ta_' . $ta;

        $temp = g1_get_theme_option( $prefix, 'top_divider_switch' );
        if ( 'standard' === $temp ) {

            $_width = absint( g1_get_theme_option( $prefix, 'top_divider_width' ) );
            $_color = new G1_Color( g1_get_theme_option( $prefix, 'top_divider_color' ) );
            $_color = $_color->get_hex();

            $out .= "#g1-{$ta} { padding-top:{$_width}px; }\n";
            $out .= "#g1-{$ta} > .g1-background { border-top-width:{$_width}px; border-top-color:#{$_color}; }\n";
        }

        return $out;
    }

    protected function capture_ta_border_bottom_css( $ta ) {
        $out = '';
        $prefix = 'ta_' . $ta;

        $temp = g1_get_theme_option( $prefix, 'bottom_divider_switch' );
        if ( 'standard' === $temp ) {

            $_width = absint( g1_get_theme_option( $prefix, 'bottom_divider_width' ) );
            $_color = new G1_Color( g1_get_theme_option( $prefix, 'bottom_divider_color' ) );
            $_color = $_color->get_hex();

            $out .= "#g1-{$ta} { padding-bottom:{$_width}px; }\n";
            $out .= "#g1-{$ta} > .g1-background { border-bottom-width:{$_width}px; border-bottom-color:#{$_color}; }\n";
        }

        return $out;
    }




    /**
     * Registers and enqueues stylesheets
     */
    public function enqueue_styles() {
        // Prevent CSS|JS caching during updates
        $version = G1_Theme()->get_version();

        $uri = trailingslashit( get_template_directory_uri() );

        G1_Theme()->revalidate_dynamic_style_cache();

        wp_register_style( 'g1_screen', $uri . 'css/g1-screen.css', array(), $version, 'screen' );

        wp_register_style( 'g1_dynamic_style', G1_Theme()->get_dynamic_style_file_url() .'?respondjs=no', array('g1_screen'), $version, 'screen' );

        wp_register_style( 'galleria_theme', $uri . 'js/galleria/themes/classic/galleria.classic.css?respondjs=no', array(), $version, 'screen' );
        wp_register_style( 'jquery.magnific-popup', $uri . 'js/jquery.magnific-popup/magnific-popup.css', array(), $version, 'screen' );

        wp_register_style( 'g1_helpmode', trailingslashit( G1_FRAMEWORK_URI ) . '/css/g1-help-mode.css?respondjs=no', array(), $version, 'screen' );

        wp_enqueue_style( 'g1-font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css', array(), '4.5.0', 'screen' );

        wp_enqueue_style( 'g1_screen' );
        wp_enqueue_style( 'g1_dynamic_style' );
        wp_enqueue_style( 'galleria_theme' );
        wp_enqueue_style( 'jquery.magnific-popup' );

        if ( current_user_can( 'administrator' ) && 'none' !== g1_get_theme_option( 'general', 'helpmode' ) ) {
            wp_enqueue_style( 'g1_helpmode' );
        }

        // Load the stylesheet from the child theme
        if ( get_template_directory() !== get_stylesheet_directory() ) {
            wp_register_style( 'g1_style', get_bloginfo( 'stylesheet_url' ), array('g1_screen'), false, 'screen' );
            wp_enqueue_style( 'g1_style' );
        }

    }


    /**
     * Enqueues JavaScripts
     */
    public function enqueue_scripts() {
        // Prevent CSS|JS caching during updates
        $version = G1_Theme()->get_version();

        $parent_uri = trailingslashit( get_template_directory_uri() );
        $child_uri = trailingslashit( get_stylesheet_directory_uri() );


        $uri = get_template_directory_uri();

        wp_register_script( 'metadata', $parent_uri . 'js/jquery-metadata/jquery.metadata.js', array('jquery'), $version, true );
        wp_register_script( 'easing', $parent_uri . 'js/easing/jquery.easing.1.3.js', array('jquery'), $version, true );

        wp_register_script( 'g1_main', $parent_uri . 'js/main.js', array('jquery'), $version, true );
        wp_register_script( 'modernizr', $parent_uri . 'js/modernizr/modernizr.custom.js', array(), $version, false );

        wp_register_script( 'simplemodal', trailingslashit( G1_FRAMEWORK_URI ) . 'js/jquery.simplemodal/js/jquery.simplemodal.1.4.1.min.js', array('jquery'), $version, true );
        wp_register_script( 'helpmode', trailingslashit( G1_FRAMEWORK_URI) . 'js/help-mode.js', array('jquery'), $version, true );

        wp_register_script( 'jquery.isotope', $parent_uri . 'js/jquery.isotope/jquery.isotope.min.js', array('jquery'), $version, true );

        wp_register_script( 'breakpoints', $parent_uri . 'js/breakpoints/breakpoints.js', array('jquery'), $version, true );
        wp_register_script( 'galleria', $parent_uri . 'js/galleria/galleria-1.2.9.min.js', array('jquery'), $version, true );
        wp_register_script( 'galleria_theme', $parent_uri . 'js/galleria/themes/classic/galleria.classic.js', array('galleria'), $version, true );

        wp_register_script( 'caroufredsel', $parent_uri . 'js/carouFredSel/jquery.carouFredSel-6.2.1-packed.js', array('jquery'), $version, true );

        wp_register_script( 'jquery.touchSwipe', $parent_uri . 'js/jquery.touchSwipe/jquery.touchSwipe.min.js', array('jquery'), $version, true );
        wp_register_script( 'jquery.waypoints', $parent_uri . 'js/jquery-waypoints/waypoints.min.js', array('jquery'), $version, true );

        wp_register_script( 'skrollr', $parent_uri . 'js/skrollr/skrollr.min.js', array(), '0.5.14', true );
        wp_register_script( 'jquery.magnific-popup', $parent_uri . 'js/jquery.magnific-popup/jquery.magnific-popup.min.js', array('jquery'), $version, true );

        wp_register_script( 'jquery.smoothscroll', $parent_uri . 'js/jquery.smoothscroll/jquery.smoothscroll.js', array('jquery'), $version, true );

        // Register child theme related scripts
        if ( $parent_uri !== $child_uri ) {
            wp_register_script( 'g1_child_main', $child_uri . 'modifications.js', array('jquery', 'g1_main'), false, true );
        }

        // Enqueue javascripts
        wp_enqueue_script( 'jquery' );

        if ( is_singular() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }

        wp_enqueue_script( 'metadata' );
        wp_enqueue_script( 'easing' );

        wp_enqueue_script( 'breakpoints' );
        wp_enqueue_script( 'galleria' );
        wp_enqueue_script( 'galleria_theme' );
        wp_enqueue_script( 'caroufredsel' );
        wp_enqueue_script( 'jquery.touchSwipe' );
        wp_enqueue_script( 'jquery.waypoints' );
        wp_enqueue_script( 'skrollr' );
        wp_enqueue_script( 'jquery.magnific-popup' );
        wp_enqueue_script( 'jquery.smoothscroll' );

        wp_enqueue_script( 'g1_main' );
        wp_enqueue_script( 'modernizr' );

        $theme_data = array(
            'uri' => $uri,
        );
        wp_localize_script( 'g1_main', 'g1Theme', $theme_data );

        if ( current_user_can( 'administrator' ) && 'none' !== g1_get_theme_option( 'general', 'helpmode' ) ) {
            wp_enqueue_script( 'simplemodal' );
            wp_enqueue_script( 'helpmode' );
        }


        //Enqueue child theme related scripts
        if ( $parent_uri !== $child_uri ) {
            wp_enqueue_script( 'g1_child_main' );
        }
    }



    public function enqueue_ie_only_scripts() {
        echo    '<!--[if lt IE 9]>' .
                '<script src="' . get_template_directory_uri() . '/js/excanvas/excanvas.compiled.js' . '"></script>' .
                '<![endif]-->';
    }
}
/**
 * Quasi-singleton for our theme
 *
 * @return G1_Theme_Front
 */
function G1_Theme_Front() {
    static $instance;

    if ( !isset( $instance ) ) {
        $instance = new G1_Theme_Front();
    }

    return $instance;
}
// Fire in the hole :)
G1_Theme_Front();



/**
 * Inserts spans into category listing
 *
 * @param unknown_type $in
 */
function g1_insert_cat_count_span( $in ) {
    // Flatten string and insert <span>
    $out = str_replace(
        array(
            "\r\n",
            "\n",
            "\t",
            '</a>',
            '</li>',
        ),
        array(
            '',
            '',
            '',
            '</a><span class="g1-meta">',
            '</span></li>',
        ),
        $in
    );

    return $out;
}
add_filter( 'wp_list_categories', 'g1_insert_cat_count_span' );



function g1_insert_archive_count_span( $in ) {
    $out = '';

    if ( false !== strpos( $in, '<li>' ) ) {
        $out = str_replace(
            array(
                '</a>',
                '</li>',
            ),
            array(
                '</a><span class="g1-meta">',
                '</span></li>',
            ),
            $in
        );

        return $out;
    }

    return $in;
}
add_filter( 'get_archives_link', 'g1_insert_archive_count_span' );





function g1_add_avatar_microdata( $avatar ) {
    if ( !empty ( $avatar ) ) {
        $avatar = str_replace( '<img', '<img itemprop="image"', $avatar );
    }

    return $avatar;
}



function g1_add_comment_author_microdata( $author ) {
    if ( !empty( $author ) ) {
        $author = '<span itemprop="name">' . $author . '</span>';
    }

    return $author;
}



function g1_add_comment_author_link_metadata( $link ) {
    if ( !empty ( $link ) ) {
        $link = str_replace( '<a', '<a itemprop="url"', $link );
    }

    return $link;
}




/**
 *  Custom function for displaying comments
 */
function g1_wp_list_comments_callback( $comment, $args, $depth ) {
    add_filter( 'get_avatar', 'g1_add_avatar_microdata' );
    add_filter( 'get_comment_author', 'g1_add_comment_author_microdata' );
    add_filter( 'get_comment_author_link', 'g1_add_comment_author_link_metadata' );


    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case '' :
            ?>
	<li <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="li-comment-<?php comment_ID(); ?>">
		<article itemscope itemprop="comment" itemtype="http://schema.org/Comment"  id="comment-<?php comment_ID(); ?>">
            <header itemprop="author" itemscope itemtype="http://schema.org/Person">
                <div itemprop="author" itemscope itemtype="http://schema.org/Person">
                    <?php echo get_avatar( $comment, 60 ); ?>
                    <?php printf( '<cite>%s</cite>', get_comment_author_link() ); ?>
                </div>

                <p class="g1-meta">
                    <a itemprop="url" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                        <time itemprop="commentTime" datetime="<?php echo get_comment_date( 'Y-m-d') . 'T' . get_comment_time('H:i:s') ?>">
                            <?php printf( __( '%1$s at %2$s', 'g1_theme' ), get_comment_date(),  get_comment_time() ); ?>
                        </time>
                    </a>
                    <?php edit_comment_link( __('(Edit)', 'g1_theme' ), ' ' ); ?>
                </p>
            </header>

            <?php if ( '0' == $comment->comment_approved ) : ?>
            <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'g1_theme' ); ?></p>
            <?php endif; ?>

            <div itemprop="text" class="comment-body">
                <?php comment_text(); ?>
            </div>

            <footer class="reply g1-meta">
                <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </footer>
        </article><!-- END: #comment-##  -->

            <?php
            break;
        case 'pingback'  :
        case 'trackback' :
            ?>
        <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
            <p><?php _e( 'Pingback:', 'g1_theme' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'g1_theme' ), '<span class="edit-link">', '</span>' ); ?></p>
        <?php
            break;
    endswitch;


    remove_filter( 'get_avatar', 'g1_add_avatar_microdata' );
    remove_filter( 'get_comment_author', 'g1_add_comment_author_microdata' );
    remove_filter( 'get_comment_author_link', 'g1_add_comment_author_link_metadata' );
}






remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

function g1_print_respond_js(){
    echo '<script type="text/javascript" src="' . get_template_directory_uri() . '/js/respond/respond.src.js"></script>';
}
add_action( 'wp_head', 'g1_print_respond_js', 9999 );



function g1_render_content_before_collection( $collection, $query ) {
    if ( $query->is_main_query() && $query->is_post_type_archive() ) {
        $page_id = G1_Archive_Page_Feature()->get_page_id( get_query_var('post_type') );

        // WPML fallback
        if ( G1_WPML_LOADED )
            $page_id = absint( icl_object_id( $page_id, 'page', true ) );

        if ( $page_id ) {
            $page = get_page( $page_id );
            if ( $page ) {
                $content = $page->post_content;
                $content = apply_filters('the_content', $content);
                $content = str_replace(']]>', ']]&gt;', $content);

                if ( strlen( $content ) ) {
                    echo '<div class="g1-archive-intro">' .
                        $content .
                        '</div>';
                }
            }
        }
    }
}
add_action( 'g1_collection_before', 'g1_render_content_before_collection', 10, 2 );



class G1_Extended_Walker_Nav_Menu extends Walker_Nav_Menu {

    public function __construct( $args ) {
        $defaults = array(
            'with_description' => false,
            'with_icon' => false,
        );

        $args = wp_parse_args( $args, $defaults );

        $this->with_description = (bool)$args['with_description'];
        $this->with_icon = (bool)$args['with_icon'];
    }

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);

        if ($depth === 0) {
            $output .= "\n$indent<div class=\"g1-submenus\"><ul>\n";
        } else {
            $output .= "\n$indent<ul>\n";
        }
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);

        if ($depth === 0) {
            $output .= "$indent</ul></div>\n";
        } else {
            $output .= "$indent</ul>\n";
        }
    }

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        // Some extra classes
        $classes[] = 'g1-menu-item-level-' . $depth;

        if ( $depth === 0 ) {
            $tile_class = $this->find_class( $classes, 'g1-type-tile-' );
            $column_class = $this->find_class( $classes, 'g1-type-column-' );

            if ($tile_class) {
                $classes[] = 'g1-type-tile';
                $classes[] = 'g1-menu-item-type-tile';
            } else if ($column_class) {
                $classes[] = 'g1-type-column';
            } else {
                $classes[] = 'g1-type-drops';
            }
        }

        $icon_class = $this->find_class( $classes, 'g1-menu-icon-' );

        if ($icon_class) {
            $classes = $this->filter_class($classes, $icon_class);
            $icon_name = str_replace('g1-menu-icon-', '', $icon_class);

            $classes[] = 'g1-menu-item-with-icon';
        }


        $classes = apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args );

        // Compose an arrow for parent items
        $arrow = '';
        if ( in_array( 'menu-parent-item', $classes ) ) {
            $arrow = '<div class="g1-nav-item__arrow"></div>';
        }

        $class_names = join( ' ', $classes );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';



        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names .'>';

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';


        $title = '<div class="g1-nav-item__title">' . apply_filters( 'the_title', $item->title, $item->ID ) . '</div>';

        $description = '';
        if ( $this->with_description && strlen( $item->description ) ) {
            $description = '<div class="g1-nav-item__desc">' . esc_html($item->description) . '</div>';
        }

        $icon = '';

        if ( $this->with_icon && !empty($icon_name) ) {
            $icon_classes = array(
                g1_get_font_awesome_icon_class( $icon_name ),
                'g1-nav-item__icon'
            );

            $icon = '<i class="'. implode( ' ', $icon_classes ) .'"></i>';
        }


        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . $arrow . $icon . $title . $description . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

    protected function find_class ( $classes, $class_prefix ) {
        $found = null;

        foreach ( $classes as $class_name ) {
            if ( strpos( $class_name, $class_prefix ) === 0 ) {
                $found = $class_name;
                break;
            }
        }

        return $found;
    }

    protected function filter_class ( $classes, $class_name ) {
        $class_index = array_search( $class_name, $classes );
        unset($classes[$class_index]);

        return $classes;
    }
}

add_filter( 'wp_nav_menu_objects', 'g1_add_menu_parent_class', 10, 2 );
function g1_add_menu_parent_class( $items, $args ) {
    $parents = array();

    foreach ( $items as $key => $item ) {
        if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
            $parents[] = $item->menu_item_parent;
        }
    }

    foreach ( $items as $item ) {
        if ( in_array( $item->ID, $parents ) ) {
            $item->classes[] = 'menu-parent-item';
        }
    }

    return $items;
}




function g1_alter_calendar_output( $out ) {
    $out = str_replace(
        array(
            '<td class="pad" colspan="1">&nbsp;</td>',
            '<td class="pad" colspan="2">&nbsp;</td>',
            '<td class="pad" colspan="3">&nbsp;</td>',
            '<td class="pad" colspan="4">&nbsp;</td>',
            '<td class="pad" colspan="5">&nbsp;</td>',
            '<td class="pad" colspan="6">&nbsp;</td>',
            '<td colspan="1" class="pad">&nbsp;</td>',
            '<td colspan="2" class="pad">&nbsp;</td>',
            '<td colspan="3" class="pad">&nbsp;</td>',
            '<td colspan="4" class="pad">&nbsp;</td>',
            '<td colspan="5" class="pad">&nbsp;</td>',
            '<td colspan="6" class="pad">&nbsp;</td>',
            '<td colspan="3" id="prev" class="pad">&nbsp;</td>',
            '<td colspan="3" id="next" class="pad">&nbsp;</td>',
        ),
        array(
            str_repeat( '<td class="pad">&nbsp;</td>', 1 ),
            str_repeat( '<td class="pad">&nbsp;</td>', 2 ),
            str_repeat( '<td class="pad">&nbsp;</td>', 3 ),
            str_repeat( '<td class="pad">&nbsp;</td>', 4 ),
            str_repeat( '<td class="pad">&nbsp;</td>', 5 ),
            str_repeat( '<td class="pad">&nbsp;</td>', 6 ),
            str_repeat( '<td class="pad">&nbsp;</td>', 1 ),
            str_repeat( '<td class="pad">&nbsp;</td>', 2 ),
            str_repeat( '<td class="pad">&nbsp;</td>', 3 ),
            str_repeat( '<td class="pad">&nbsp;</td>', 4 ),
            str_repeat( '<td class="pad">&nbsp;</td>', 5 ),
            str_repeat( '<td class="pad">&nbsp;</td>', 6 ),
            '<td colspan="3" id="prev" class="pad"><span></span></td>',
            '<td colspan="3" id="next" class="pad"><span></span></td>',
        ),
        $out
    );

    return $out;
}
add_filter( 'get_calendar', 'g1_alter_calendar_output' );



function g1_add_custom_widget_classes( $params ) {
    switch( _get_widget_id_base($params[0]['widget_id']) ) {
        case 'archives':
        case 'categories':
        case 'meta':
        case 'links':
        case 'pages':
        case 'recent-posts':
        case 'nav_menu':
            $params[0]['before_widget'] = str_replace(
                'g1-widget--cssclass',
                'g1-links',
                $params[0]['before_widget']
            );
            break;
    }

    return $params;
}
add_filter('dynamic_sidebar_params', 'g1_add_custom_widget_classes' );




/**
 * Renders the Revolution Slider (based on the slider element)
 *
 * revslider_{slug} is the desired value
 */
function g1_render_revslider_element() {
    $prefix = 'revslider_';
    $slider = G1_Elements()->get( 'slider' );

    if ( 0 === strpos( $slider, $prefix ) ) {
        $slider = sanitize_title( substr( $slider, strlen( $prefix ) ) );

        echo '<figure id="g1-primary-slider">';
        echo do_shortcode( "[rev_slider $slider]" );
        echo '</figure>';
    }
}
add_action( 'g1_precontent', 'g1_render_revslider_element' );



function g1_filter_wp_link_pages_args($args) {
    $args = array_merge(
        $args,
        array(
            'before'			=> '<nav class="g1-pagination pagelinks"><p><strong>' . __( 'Pages:', 'g1_theme' ) . '</strong>',
            'after'				=> '</p></nav>',
            'current_before'	=> '<strong class="current">',
            'current_after' 	=> '</strong>',
            'link_before'		=> '<span>',
            'link_after'		=> '</span>',
            'next_or_number' 	=> 'next_and_number',
            'nextpagelink' 		=> __( 'Next', 'g1_theme' ),
            'previouspagelink' 	=> __('Prev', 'g1_theme' ),
        )
    );

    // Based on: http://www.velvetblues.com/web-development-blog/wordpress-number-next-previous-links-wp_link_pages/
    if ( 'next_and_number' === $args[ 'next_or_number' ] ) {
        global $page, $numpages, $multipage, $more, $pagenow;
        $args[ 'next_or_number'] = 'number';
        $prev = '';
        $next = '';
        if ( $multipage ) {
            if ( $more ) {
                $i = $page - 1;
                if ( $i && $more ) {
                    $prev .= _wp_link_page($i);
                    $prev .= $args[ 'link_before' ] . $args[ 'previouspagelink' ] . $args[ 'link_after' ] . '</a>';
                    $prev = str_replace('<a ', '<a class="prev" ', $prev);

                }
                $i = $page + 1;
                if ( $i <= $numpages && $more ) {
                    $next .= _wp_link_page($i);
                    $next .= $args[ 'link_before' ] . $args[ 'nextpagelink' ] . $args[ 'link_after' ] . '</a>';
                    $next = str_replace('<a ', '<a class="next" ', $next);
                }
            }
        }
        $args[ 'before' ] = $args[ 'before' ] . $prev;
        $args[ 'after' ] = $next . $args[ 'after' ];
    }

    return $args;
}
add_filter( 'wp_link_pages_args', 'g1_filter_wp_link_pages_args' );





/**
 * Enqueues javascripts required for the Isotope Plugin
 *
 * @since			1.1.0
 */
function g1_isotope_wp_footer() {
    wp_enqueue_script( 'jquery.isotope' );
    wp_print_scripts( 'jquery.isotope' );
}



function g1_remove_post_classes( $classes ) {
    return array_diff(
        $classes,
        array(
            'hentry'
        )
    );
}
add_filter( 'post_class', 'g1_remove_post_classes', 20 );



function g1_mediabox_items ( $post_id, $size, $only_featured_media = false ) {
    $items = array();

    $post_format = get_post_format( $post_id );

    switch ( $post_format ) {
        case 'audio':
            $html = do_shortcode( g1_capture_post_audio( $post_id, $size ) );

            if ( !empty( $html ) ) {
                $items[] = array(
                    'class' => array(),
                    'html' => $html,
                );
            }

            break;

        case 'video':
            $html = do_shortcode( g1_capture_post_video( $post_id, $size ) );

            if ( !empty( $html ) ) {
                $items[] = array(
                    'class' => array(),
                    'html' => $html,
                );
            }

            break;

        default:
            break;
    }

    // get post thumbnail
    if ( $only_featured_media && !in_array($post_format, array('audio', 'video')) && has_post_thumbnail($post_id)) {
        $html = get_the_post_thumbnail($post_id, $size);

        $items[] = array(
            'class' => array(),
            'html' => $html,
        );
    }

    if ( $only_featured_media ) {
        return $items;
    }


    // Get all image|audio attachments not excluded from the media box
    $query_args = array(
        'post_parent'		=> $post_id,
        'post_type'			=> 'attachment',
        'post_mime_type'	=> array( 'image', 'audio' ),
        'orderby' 			=> 'menu_order',
        'order'         	=> 'ASC',
        'meta_query'        => array(
            'relation' => 'OR',
            array(
                'key'       => '_g1_type',
                'value'     => 'exclude',
                'compare'   => 'NOT EXISTS',
            ),
            array(
                'key'       => '_g1_type',
                'value'     => 'exclude',
                'compare'   => '!=',
            ),
        ),
    );

    foreach ( get_children( $query_args ) as $attachment_id => $attachment ) {
        $title = esc_html( $attachment->post_title );
        $caption = esc_html( $attachment->post_excerpt );
        $description = esc_html( $attachment->post_content );

        $mime_type = substr( $attachment->post_mime_type, 0, strpos( $attachment->post_mime_type, "/") );

        switch ( $mime_type ) {
            case 'image':
                $html = '<figure class="media-embed">' .
                    wp_get_attachment_image( $attachment_id, $size ) .
                    '</figure>';

                $items[] = array(
                    'class' => array(),
                    'html' => $html,
                );

                break;

            case 'audio':
                $html = do_shortcode( '[audio_player title="' . $caption .'" mp3="' . wp_get_attachment_url( $attachment_id )  . '"]' );

                $items[] = array(
                    'class' => array(),
                    'html' => $html,
                );

                break;
        }
    }

    return $items;
}



function g1_mediabox_thumbs ( $post_id, $size, $only_featured_media = false ) {
    $thumbs = array();

    $post_format = get_post_format( $post_id );

    switch ( $post_format ) {
        case 'audio':
            $thumb = array(
                'html' => '',
                'class' => array(),
            );

            $thumb['html'] .=
                '<a href="#">' .
                    do_shortcode( '[placeholder size="' . esc_attr( $size ) .'" icon="microphone"]' ) .
                    '</a>';

            $thumbs[] = $thumb;

            break;

        case 'video':
            $thumb = array(
                'html' => '',
                'class' => array(),
            );

            $thumb['html'] .=
                '<a href="#">' .
                    do_shortcode( '[placeholder size="' . esc_attr( $size ) .'" icon="film"]' ) .
                    '</a>';

            $thumbs[] = $thumb;

            break;

        default:
            break;
    }

    // Get all image|audio attachments not excluded from the media box
    $query_args = array(
        'post_parent'		=> $post_id,
        'post_type'			=> 'attachment',
        'post_mime_type'	=> array( 'image', 'audio' ),
        'orderby' 			=> 'menu_order',
        'order'         	=> 'ASC',
        'meta_query'        => array(
            'relation' => 'OR',
            array(
                'key'       => '_g1_type',
                'value'     => 'exclude',
                'compare'   => 'NOT EXISTS',
            ),
            array(
                'key'       => '_g1_type',
                'value'     => 'exclude',
                'compare'   => '!=',
            ),
        ),
    );

    foreach ( get_children( $query_args ) as $attachment_id => $attachment ) {
        $thumb = array(
            'html' => '',
            'class' => array(),
        );

        $mime_type = substr( $attachment->post_mime_type, 0, strpos( $attachment->post_mime_type, "/") );
        $thumb['class'][] = 'g1-thumb-' . $mime_type;

        switch ( $mime_type ) {
            case 'audio':
                $thumb['html'] .=
                    '<a href="#">' .
                        do_shortcode( '[placeholder size="' . esc_attr( $size ) .'" icon="camera"]' ) .
                        '</a>';
                break;

            case 'image':
                $thumb['html'] .=
                    '<a href="#">' .
                        wp_get_attachment_image( $attachment_id, $size ) .
                        '</a>';
                break;
        }

        $thumbs[] = $thumb;
    }

    return $thumbs;
}

function g1_mediabox_lightbox( $post_id, $size, $only_featured_media = false ) {
    $items = array();

    $post_format = get_post_format( $post_id );

    switch ( $post_format ) {
        case 'audio':
            if ( $size === 'full' ) {
                $size = 'g1_max';
            }

            $audio = g1_capture_post_audio( $post_id, $size );
            $audio = do_shortcode( $audio );

            $script_id = 'g1_var_' . rand();
            $html =   '<script id="' . esc_attr( $script_id ) . '" class="g1-var">' .
                'var ' . $script_id .' = ' . json_encode( array('html_code' => $audio) ) . ';' .
                '</script>';

            if ( !empty( $audio ) ) {
                $items[] = array(
                    'class' => array(),
                    'html' => $html
                );
            }
            break;

        case 'video':
            if ( $size === 'full' ) {
                $size = 'g1_max';
            }

            $video = g1_capture_post_video( $post_id, $size );
            $video = do_shortcode( $video );

            if ( !empty( $video ) ) {
                $script_id = 'g1_var_' . rand();
                $html =   '<script id="' . esc_attr( $script_id ) . '" class="g1-var">' .
                    'var ' . $script_id .' = ' . json_encode( array('html_code' => $video) ) . ';' .
                    '</script>';

                $items[] = array(
                    'class' => array(),
                    'html' => $html
                );
            }
            break;

        default:
            break;
    }

    if ( $only_featured_media && !in_array($post_format, array('audio', 'video')) && has_post_thumbnail($post_id)) {
        $html = get_the_post_thumbnail($post_id, $size);

        $items[] = array(
            'class' => array(),
            'html' => $html,
        );
    }

    if ( $only_featured_media ) {
        return $items;
    }

    // Get all image|audio attachments not excluded from the media box
    $query_args = array(
        'post_parent'		=> $post_id,
        'post_type'			=> 'attachment',
        'post_mime_type'	=> array( 'image', 'audio' ),
        'orderby' 			=> 'menu_order',
        'order'         	=> 'ASC',
        'meta_query'        => array(
            'relation' => 'OR',
            array(
                'key'       => '_g1_type',
                'value'     => 'exclude',
                'compare'   => 'NOT EXISTS',
            ),
            array(
                'key'       => '_g1_type',
                'value'     => 'exclude',
                'compare'   => '!=',
            ),
        ),
    );

    foreach ( get_children( $query_args ) as $attachment_id => $attachment ) {
        $title = esc_html( $attachment->post_title );
        $caption = esc_html( $attachment->post_excerpt );
        $description = esc_html( $attachment->post_content );

        $mime_type = substr( $attachment->post_mime_type, 0, strpos( $attachment->post_mime_type, "/") );

        switch ( $mime_type ) {
            case 'image':
                $item = array(
                    'class' => array(),
                    'html' => '',
                );

                $src = wp_get_attachment_image_src( $attachment_id, $size );
                $src = $src[0];

                $item['html'] .=
                    '<a href="' . esc_url( $src )  .  '">' .
                        '</a>';

                $items[] = $item;

                break;

            case 'audio':
                $item = array(
                    'class' => array(),
                    'html' => '',
                );

                $audio = do_shortcode( '[audio_player title="' . $caption .'" mp3="' . wp_get_attachment_url( $attachment_id )  . '"]' ) .

                    $js_id = 'g1_var_' . rand();
                $item['html'] =
                    '<script id="' . esc_attr( $js_id ) . '" class="g1-var">' .
                        'var ' . $js_id .' = ' . json_encode( array('html_code' => $audio) ) . ';' .
                        '</script>';


                $items[] = $item;

                break;
        }
    }

    return $items;
}

function get_mediabox_placeholder ( $size, $type ) {
    $icon = '';

    switch ( $type ) {
        case 'audio':
            $icon = 'camera';
            break;

        case 'video':
            $icon = 'facetime-video';
            break;
    }

    return do_shortcode( '[placeholder size="' . esc_attr( $size ) .'" icon="'. $icon .'"]' );
}

function g1_add_breadcrumbs() {
    if ( G1_Elements()->get( 'breadcrumbs' ) ) {
        G1_Breadcrumbs()->render();
    }
}
add_action( 'g1_content_begin', 'g1_add_breadcrumbs' );











function g1_post_format_the_content( $content ) {
    global $post;

    if ( $post ) {
        switch ( get_post_format( $post->ID ) ) {
            case 'chat':
                $content = G1_Post_Format_Chat::format(array(
                    'content' => $content,
                    'post_id' => $post->ID,
                ));
                break;

            case 'quote':
                $content = G1_Post_Format_Quote::format(array(
                    'content' => $content,
                    'post_id' => $post->ID,
                ));
                break;

            case 'alink':
                $content = G1_Post_Format_Link::format(array(
                    'content' => $content,
                    'post_id' => $post->ID,
                ));
                break;
        }
    }

    return $content;
}
add_filter( 'the_content', 'g1_post_format_the_content', 20 );



global $g1_loop_stack;
$g1_loop_stack = array();

function g1_add_post_class_brief( $classes ) {
    $classes[] = 'g1-brief';

    return $classes;
}
function g1_add_post_class_complete( $classes ) {
    $classes[] = 'g1-complete';

    return $classes;
}

function g1_loop_start( $query ) {
    if ( !$query ) {
        return;
    }

    global $wp_the_query, $g1_loop_stack;

    remove_action( 'post_class', 'g1_add_post_class_brief' );
    remove_action( 'post_class', 'g1_add_post_class_complete' );

    if ( method_exists( $query, 'is_singular' ) && $query->is_singular() ) {
        array_push( $g1_loop_stack, 'single' );
        add_action( 'post_class', 'g1_add_post_class_complete' );
    } else {
        array_push( $g1_loop_stack, 'collection' );
        add_action( 'post_class', 'g1_add_post_class_brief' );
    }
}
add_action( 'loop_start', 'g1_loop_start' );

function g1_loop_end( $query ) {
    if ( !$query ) {
        return;
    }

    global $g1_loop_stack;

    remove_action( 'post_class', 'g1_add_post_class_complete' );
    remove_action( 'post_class', 'g1_add_post_class_brief' );

    if ( 'single' === array_pop( $g1_loop_stack ) ) {
        add_action( 'post_class', 'g1_add_post_class_complete' );
    } else {
        add_action( 'post_class', 'g1_add_post_class_brief' );
    }
}
add_action( 'loop_end', 'g1_loop_end' );