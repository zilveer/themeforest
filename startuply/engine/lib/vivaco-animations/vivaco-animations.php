<?php
/**
 *
 * Startuply WP Animations
 *
 * @author Vivaco
 * @license Commercial License
 * @link http://startuplywp.com
 * @copyright 2015 Vivaco
 * @package Startuply
 * @version 2.2.0
 *
 */

$use_animation = startuply_option('vivaco_vc_animations_on', 1);

if ( $use_animation == 1 ) {
    class VivacoAnimations {

        private $animations;

        private $animationsParamsForExtendShortcode;

        private $shortcodeWithAnimation = array(
            'vc_column',
            'vc_column_inner',
            'vc_column_text',
            'vc_row',
            'vc_row_inner',
            'vc_single_image',
            /*
            'vc_cta_button',
            'vc_cta_button2',
            'vc_icon',
            'vc_message',
            'vc_toggle'
            */
        );

        private function constructFields() {
            $this->animations = array(
                __( '- Entrance Animations -', 'vivaco' )           => '',
                __( 'Fade in', 'vivaco' )                           => 'fade-in',
                __( 'Flip top to bottom 3D', 'vivaco' )             => 'flip-3d-to-bottom',
                __( 'Flip bottom to top 3D', 'vivaco' )             => 'flip-3d-to-top',
                __( 'Flip right to left 3D', 'vivaco' )             => 'flip-3d-to-left',
                __( 'Flip left to right 3D', 'vivaco' )             => 'flip-3d-to-right',
                __( 'Flip in horizontally 3D', 'vivaco' )           => 'flip-3d-horizontal',
                __( 'Flip in vertically 3D', 'vivaco' )             => 'flip-3d-vertical',
                __( 'Fall bottom to top 3D', 'vivaco' )             => 'fall-3d-to-top',
                __( 'Fall top to bottom 3D', 'vivaco' )             => 'fall-3d-to-bottom',
                __( 'Roll bottom to top 3D', 'vivaco' )             => 'roll-3d-to-top',
                __( 'Roll right to left 3D', 'vivaco' )             => 'roll-3d-to-left',
                __( 'Roll left to right 3D', 'vivaco' )             => 'roll-3d-to-right',
                __( 'Rotate in top left 2D', 'vivaco' )             => 'rotate-in-top-left',
                __( 'Rotate in top right 2D', 'vivaco' )            => 'rotate-in-top-right',
                __( 'Rotate in bottom left 2D', 'vivaco' )          => 'rotate-in-bottom-left',
                __( 'Rotate in bottom right 2D', 'vivaco' )         => 'rotate-in-bottom-right',
                __( 'Slide top to bottom 3D', 'vivaco' )            => 'slide-to-bottom',
                __( 'Slide bottom to top 3D', 'vivaco' )            => 'slide-to-top',
                __( 'Slide right to left 3D', 'vivaco' )            => 'slide-to-left',
                __( 'Slide left to right 3D', 'vivaco' )            => 'slide-to-right',
                __( 'Slide elastic bottom to top 2D', 'vivaco' )    => 'slide-elastic-to-top',
                __( 'Slide elastic top to bottom 2D', 'vivaco' )    => 'slide-elastic-to-bottom',
                __( 'Slide elastic right to left 2D', 'vivaco' )    => 'slide-elastic-to-left',
                __( 'Slide elastic left to right 2D', 'vivaco' )    => 'slide-elastic-to-right',
                __( 'Grow 2D', 'vivaco' )                           => 'size-grow-2d',
                __( 'Shrink 2D', 'vivaco' )                         => 'size-shrink-2d',
                __( 'Spin 2D', 'vivaco' )                           => 'spin-2d',
                __( 'Spin 2D reverse', 'vivaco' )                   => 'spin-2d-reverse',
                __( 'Spin 3D', 'vivaco' )                           => 'spin-3d',
                __( 'Spin 3D reverse', 'vivaco' )                   => 'spin-3d-reverse',
                __( 'Twirl top left 3D', 'vivaco' )                 => 'twirl-3d-top-left',
                __( 'Twirl top right 3D', 'vivaco' )                => 'twirl-3d-top-right',
                __( 'Twirl bottom left 3D', 'vivaco' )              => 'twirl-3d-bottom-left',
                __( 'Twirl bottom right 3D', 'vivaco' )             => 'twirl-3d-bottom-right',
                __( 'Twirl 3D', 'vivaco' )                          => 'twirl-3d',
                __( 'Unfold top to bottom 3D', 'vivaco' )           => 'unfold-3d-to-bottom',
                __( 'Unfold bottom to top 3D', 'vivaco' )           => 'unfold-3d-to-top',
                __( 'Unfold right to left 3D', 'vivaco' )           => 'unfold-3d-to-left',
                __( 'Unfold left to right 3D', 'vivaco' )           => 'unfold-3d-to-right',
                __( 'Unfold horzitonal 3D', 'vivaco' )              => 'unfold-3d-horizontal',
                __( 'Unfold vertical 3D', 'vivaco' )                => 'unfold-3d-vertical',
                // __( 'Three unfold top to bottom 3D', 'vivaco' )     => 'three_unfold-3d-to-bottom',
                // __( 'Three unfold bottom to top 3D', 'vivaco' )     => 'three_unfold-3d-to-top',
                // __( 'Three unfold right to left 3D', 'vivaco' )     => 'three_unfold-3d-to-left',
                // __( 'Three unfold left to right 3D', 'vivaco' )     => 'three_unfold-3d-to-right',
                __( '- Looped Animations -', 'vivaco' )             => '',
                __( 'Pulsate', 'vivaco' )                           => 'loop-pulsate',
                __( 'Pulsate fade', 'vivaco' )                      => 'loop-pulsate-fade',
                __( 'Hover', 'vivaco' )                             => 'loop-hover',
                __( 'Hover floating', 'vivaco' )                    => 'loop-hover-float',
                __( 'Wobble', 'vivaco' )                            => 'loop-wobble',
                __( 'Wobble 3D', 'vivaco' )                         => 'loop-wobble-3d',
                __( 'Dangle', 'vivaco' )                            => 'loop-dangle',
            );

            $this->animationsParamsForExtendShortcode = array(
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'CSS Animation', 'vivaco' ),
                    'param_name' => 'vsc_animation',
                    'value' => array_merge( array( __( 'No', 'vivaco' ) => '' ), $this->animations ),
                    'group' => __( 'Animation', 'vivaco' ),
                    'description' => __( 'Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'vivaco' ),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Animation Duration', 'vivaco' ),
                    'param_name' => 'vsc_duration',
                    'value' => '',
                    'group' => __( 'Animation', 'vivaco' ),
                    'description' => __( 'Duration in seconds. You can use decimal points in the value. Use this field to specify the amount of time the animation plays. <em>The default value depends on the animation, leave blank to use the default.</em>', 'vivaco' ),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Animation Delay', 'vivaco' ),
                    'param_name' => 'vsc_delay',
                    'value' => '',
                    'group' => __( 'Animation', 'vivaco' ),
                    'description' => __( 'Delay in seconds. You can use decimal points in the value. Use this field to delay the animation for a few seconds, this is helpful if you want to chain different effects one after another above the fold.', 'vivaco' ),
                )
            );
        }


        /**
         * Constructor, checks for Visual Composer and defines hooks
         *
         * @return  void
         * @since   1.0
         */
        function __construct() {
            add_action( 'init', array( $this, 'init' ), 9999 );
        }

        public function init() {
            if ( ! defined( 'WPB_VC_VERSION' ) ) {
                return;
            }

            $this->constructFields();

            $this->createAnimationElement();

            $this->extendComposer();

            add_action( 'admin_enqueue_scripts', array( $this, 'adminEnqueueScripts' ) );
            add_action( 'wp_enqueue_scripts', array( $this, 'wpEnqueueScripts' ) );

            add_filter( 'vc_shortcode_output', array( $this, 'shortcodeFilter' ), 9999, 3 );

            add_shortcode( 'css_animation', array( $this, 'cssAnimationShortcode' ) );
            add_shortcode( 'vsc_animations', array( $this, 'vscAnimationsShortcode' ) );
        }

        public function extendComposer() {
            // Check if Visual Composer is installed
            if ( ! defined( 'WPB_VC_VERSION' ) || ! function_exists( 'vc_add_params' ) ) {
                return;
            }

            foreach (array_keys(WPBMap::getShortCodes()) as $key ) {
                if( in_array($key, $this->shortcodeWithAnimation) ) {
                    vc_add_params( $key, $this->animationsParamsForExtendShortcode );
                    vc_remove_param( $key, 'css_animation' );
                }
            }
        }

        public function adminEnqueueScripts() {
            wp_enqueue_style( 'vsc-admin-animation-style', get_template_directory_uri() . '/engine/lib/vivaco-animations/css/admin.css');
        }

        public function wpEnqueueScripts() {
            wp_enqueue_style( 'vsc-animation-style', get_template_directory_uri() . '/engine/lib/vivaco-animations/css/vivaco-animations.css');

            wp_enqueue_script( 'vsc-animation-style', get_template_directory_uri() . '/engine/lib/vivaco-animations/js/vivaco-animations.js');
        }

        public function createAnimationElement() {
            // Check if Visual Composer is installed
            if ( ! defined( 'WPB_VC_VERSION' ) || ! function_exists( 'vc_add_param' ) ) {
                return;
            }

            /**
             * We need to define this so that VC will show our nesting container correctly
             */

            include( 'class-vivaco-animations.php' );

            vc_map( array(
                'name' => __( 'CSS Animator', 'vivaco' ),
                'base' => 'css_animation',
                'as_parent' => array('except' => 'css_animation'),
                'content_element' => true,
                'icon' => 'css_animation',
                'js_view' => 'VcColumnView',
                'description' => __( 'Add animations to your elements', 'vivaco' ),
                'params' => array(
                    // add params same as with any other content element
                    array(
                        'type' => 'dropdown',
                        'heading' => __( 'CSS Animation', 'vivaco' ),
                        'param_name' => 'animation',
                        'value' => array_merge( array( __( 'No', 'vivaco' ) => '' ), $this->animations ),
                        'description' => __( 'Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'vivaco' ),
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Animation Duration', 'vivaco' ),
                        'param_name' => 'duration',
                        'value' => '',
                        'description' => __( 'Duration in seconds. You can use decimal points in the value. Use this field to specify the amount of time the animation plays. <em>The default value depends on the animation, leave blank to use the default.</em>', 'vivaco' ),
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Animation Delay', 'vivaco' ),
                        'param_name' => 'delay',
                        'value' => '',
                        'description' => __( 'Delay in seconds. You can use decimal points in the value. Use this field to delay the animation for a few seconds, this is helpful if you want to chain different effects one after another above the fold.', 'vivaco' ),
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Extra class name', 'vivaco' ),
                        'param_name' => 'el_class',
                        'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'vivaco' ),
                    ),
                ),
            ) );
        }

        public function cssAnimationShortcode( $atts, $content = null ) {
            extract( shortcode_atts( array(
                'el_class'        => '',
                'animation' => '',
                'duration' => '',
                'delay' => '',
            ), $atts ) );

            if ( empty( $animation ) ) {
                return do_shortcode( $content );
            }

            // Enqueue the animation script
            // $animationGroup = substr( $animation, 0, stripos( $animation, '-' ) );
            // wp_enqueue_style( 'vc-css-animation-' . $animationGroup, plugins_url( '/css/' . $animationGroup . '.css', __FILE__ ), false, null );
            // wp_enqueue_script( 'vc-css-animation', plugins_url( '/js/animations.js', __FILE__ ), array( 'jquery' ), null, true );
            wp_enqueue_script( 'waypoints' );

            // Set default values
            $styles = array();
            if ( $duration != '0' && ! empty( $duration ) ) {
                $duration = (float)trim( $duration, "\n\ts" );
                $styles[] = "-webkit-animation-duration: {$duration}s";
                $styles[] = "-moz-animation-duration: {$duration}s";
                $styles[] = "-ms-animation-duration: {$duration}s";
                $styles[] = "-o-animation-duration: {$duration}s";
                $styles[] = "animation-duration: {$duration}s";
                // $styles[] = "-webkit-transition-duration: {$duration}s";
                // $styles[] = "-moz-transition-duration: {$duration}s";
                // $styles[] = "-ms-transition-duration: {$duration}s";
                // $styles[] = "-o-transition-duration: {$duration}s";
                // $styles[] = "transition-duration: {$duration}s";
            }
            if ( $delay != '0' && ! empty( $delay ) ) {
                $delay = (float)trim( $delay, "\n\ts" );
                $styles[] = "opacity: 0";
                $styles[] = "-webkit-animation-delay: {$delay}s";
                $styles[] = "-moz-animation-delay: {$delay}s";
                $styles[] = "-ms-animation-delay: {$delay}s";
                $styles[] = "-o-animation-delay: {$delay}s";
                $styles[] = "animation-delay: {$delay}s";
                // $styles[] = "-webkit-transition-delay: {$delay}s";
                // $styles[] = "-moz-transition-delay: {$delay}s";
                // $styles[] = "-ms-transition-delay: {$delay}s";
                // $styles[] = "-o-transition-delay: {$delay}s";
                // $styles[] = "transition-delay: {$delay}s";
            }
            $styles = implode( ';', $styles );

            if ( preg_match( '/^unfold-/', $animation ) ) {
                return "<div class='wpb_animate_when_almost_visible gambit-css-animation $animation $el_class' style='$styles'><div class='unfolder-container right' style='$styles'><div class='unfolder-content'>" . do_shortcode( $content ) . "</div></div><div class='unfolder-container left' style='$styles'><div class='unfolder-content'>" . do_shortcode( $content ) . "</div></div><div class='real-content' style='$styles'>" . do_shortcode( $content ) . '</div></div>';
            }

            if ( preg_match( '/^three-unfold-/', $animation ) ) {
                return "<div class='wpb_animate_when_almost_visible gambit-css-animation $animation $el_class' style='$styles'><div class='unfolder-container top left' style='$styles'><div class='unfolder-content'>" . do_shortcode( $content ) . "</div></div><div class='unfolder-container mid' style='$styles'><div class='unfolder-content'>" . do_shortcode( $content ) . "</div></div><div class='unfolder-container bottom right' style='$styles'><div class='unfolder-content'>" . do_shortcode( $content ) . "</div></div><div class='real-content' style='$styles'>" . do_shortcode( $content ) . '</div></div>';
            }

            return "<div class='wpb_animate_when_almost_visible gambit-css-animation $animation $el_class' style='$styles'>" . do_shortcode( $content ) . '</div>';
        }

        public function shortcodeFilter( $output, $shortcode, $atts ) {
            if(array_key_exists('vsc_animation', $atts)) {
                extract( shortcode_atts( array(
                    'vsc_animation' => '',
                    'vsc_duration' => '',
                    'vsc_delay' => '',
                ), $atts ) );

                $output = do_shortcode("[vsc_animations vsc_animation='$vsc_animation' vsc_duration='$vsc_duration' vsc_delay='$vsc_delay']".$output."[/vsc_animations]");
            }

            return $output;
        }

        // register vsc_animations_shortcode
        public function vscAnimationsShortcode( $atts, $content = null ) {
            extract( shortcode_atts( array(
                'vsc_animation' => '',
                'vsc_duration' => '',
                'vsc_delay' => '',
            ), $atts ) );

            if ( empty( $vsc_animation ) ) {
                return do_shortcode( $content );
            }

            wp_enqueue_script( 'waypoints' );

            // Set default values
            $styles = array();
            if ( $vsc_duration != '0' && ! empty( $vsc_duration ) ) {
                $vsc_duration = (float)trim( $vsc_duration, "\n\ts" );
                $styles[] = "-webkit-animation-duration: {$vsc_duration}s";
                $styles[] = "-moz-animation-duration: {$vsc_duration}s";
                $styles[] = "-ms-animation-duration: {$vsc_duration}s";
                $styles[] = "-o-animation-duration: {$vsc_duration}s";
                $styles[] = "animation-duration: {$vsc_duration}s";
            }
            if ( $vsc_delay != '0' && ! empty( $vsc_delay ) ) {
                $vsc_delay = (float)trim( $vsc_delay, "\n\ts" );
                $styles[] = "opacity: 0";
                $styles[] = "-webkit-animation-delay: {$vsc_delay}s";
                $styles[] = "-moz-animation-delay: {$vsc_delay}s";
                $styles[] = "-ms-animation-delay: {$vsc_delay}s";
                $styles[] = "-o-animation-delay: {$vsc_delay}s";
                $styles[] = "animation-delay: {$vsc_delay}s";
            }
            $styles = implode( ';', $styles );

            if ( preg_match( '/^unfold-/', $vsc_animation ) ) {
                return "<div class='wpb_animate_when_almost_visible gambit-css-animation $vsc_animation' style='$styles'><div class='unfolder-container right' style='$styles'><div class='unfolder-content'>" . do_shortcode( $content ) . "</div></div><div class='unfolder-container left' style='$styles'><div class='unfolder-content'>" . do_shortcode( $content ) . "</div></div><div class='real-content' style='$styles'>" . do_shortcode( $content ) . '</div></div>';
            }

            if ( preg_match( '/^three-unfold-/', $vsc_animation ) ) {
                return "<div class='wpb_animate_when_almost_visible gambit-css-animation $vsc_animation' style='$styles'><div class='unfolder-container top left' style='$styles'><div class='unfolder-content'>" . do_shortcode( $content ) . "</div></div><div class='unfolder-container mid' style='$styles'><div class='unfolder-content'>" . do_shortcode( $content ) . "</div></div><div class='unfolder-container bottom right' style='$styles'><div class='unfolder-content'>" . do_shortcode( $content ) . "</div></div><div class='real-content' style='$styles'>" . do_shortcode( $content ) . '</div></div>';
            }

            return "<div class='wpb_animate_when_almost_visible gambit-css-animation $vsc_animation' style='$styles'>" . do_shortcode( $content ) . '</div>';
        }

    }

    new VivacoAnimations();
} else {
    // fallback for css animator wrapper if animation option not set

    if ( defined( 'WPB_VC_VERSION' ) ) {
        function create_animation_element() {
            include( 'class-vivaco-animations.php' );

            vc_map( array(
                'name' => __( 'CSS Animator', 'vivaco' ),
                'base' => 'css_animation',
                'as_parent' => array('except' => 'css_animation'),
                'content_element' => true,
                'icon' => 'css_animation',
                'js_view' => 'VcColumnView',
                'description' => __( 'Add animations to your elements', 'vivaco' ),
                'params' => array(
                    // add params same as with any other content element
                    array(
                        'param_name' => 'css_markup1', // all params must have a unique name
                        'type' => 'custom_markup', // this param type
                        'heading' => __( 'CSS Animation', 'vivaco' ),
                        'description' => __( 'Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'vivaco' ),
                        'value' => __( '<div class="alert alert-info">Please turn on "Enable Animations" in Startuply options to use this shortcode</div>', 'vivaco' ), // your custom markup
                    ),
                ),
            ) );

        }

        add_action( 'init', 'create_animation_element', 9999 );
    }

    function css_animation_shortcode( $atts, $content = null ) {
        // no work
        return do_shortcode( $content );
    }
    add_shortcode( 'css_animation', 'css_animation_shortcode' );


    function animation_admin_enqueue_scripts() {
        wp_enqueue_style( 'vsc-admin-animation-style', get_template_directory_uri() . '/engine/lib/vivaco-animations/css/admin.css');
    }
    add_action( 'admin_enqueue_scripts', 'animation_admin_enqueue_scripts');
}
