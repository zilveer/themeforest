<?php

/**
 * Animate plugin
 * @author alex
 */
class ctCssAnimatePlugin {

	/**
	 * Is someone is using us on this page?
	 * @var bool
	 */

	protected $active = true;

	/**
	 * Animations
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'onInit' ), 9 );
		add_action( 'wp_head', array( $this,'addHeadScripts'), apply_filters('ct.css_animate_hs_priority',10));//min 7 to enqueue in head
		add_filter( 'ct_theme_loader.options.load', array( $this, 'addOptions' ) );
		//add_action( 'wp_footer', array( $this, 'injectScripts' ) );
		add_filter( 'body_class', array( $this, 'customBodyClass' ) );
        add_action('wp_enqueue_scripts',array($this,'addStyle'));
	}

	/**
	 * Register shortcodes
	 */

	public function onInit() {

		//add listeners to our shortcodes
		foreach ( $this->getCompatibleShortcodes() as $shortcode ) {
			ctShortcode::connectInlineAttributeFilter( $shortcode, array( $this, 'addCustomAttributes' ) );
			ctShortcode::connectNormalizedAttributesFilter( $shortcode, array(
				$this,
				'addCustomNormalizedAttributes'
			) );
		}
	}

	/**
	 * Return compatible shortcodes
	 * @return array
	 */
	protected function getCompatibleShortcodes() {
		$shortcodes = array(
			'five_sixth_column',
			'full_column',
			'full_width',
			'half_column',
			'one_sixth_column',
			'quarter_column',
			'row',
			'third_column',
			'three_quarters_column',
			'five_twelfths_column',
			'seven_twelfths_column',
			'title_row',
			'two_thirds_column',
			'vc_column',
			'vc_column_inner',
			'vc_row',
			'img'
		);

		return apply_filters( 'ct.css_animate.compatible_shortcodes', $shortcodes );
	}

	/**
	 * Adds custom options
	 *
	 * @param $sections
	 *
	 * @return mixed
	 */

	public function addOptions( $sections ) {
		//hide options when we do not add animation
		if ( ! $this->getCompatibleShortcodes() ) {
			return $sections;
		}
		foreach ( $sections as $key => $section ) {
			if ( $section['group'] == 'General' ) {
				//add custom fields to general tab
				$sections[ $key ]['fields'][] = array(
					'id'    => "general_show_css_animate",
					'title' => esc_html__( "Enable animations", 'ct_theme' ),
					'type'  => 'select_show',
					'std'   => 1
				);
				break;
			}
		}

		return $sections;
	}

	/**
	 * Is it active?
	 * @return bool
	 */

	public function isEnabled() {
		$val = ct_get_option( 'general_show_css_animate' );

		return $val === '' || $val;
	}

	/**
	 * Body class
	 *
	 * @param $classes
	 *
	 * @return mixed
	 */
	public function customBodyClass( $classes ) {
		if ( $this->isEnabled() ) {
			$classes[] = 'cssAnimate';
		}

		return $classes;
	}

	/**
	 * Adds required scripts
	 */

	public function injectScripts() {
		if ( $this->active && $this->isEnabled() ) {

			//add appear and call animations. In this js we already call proper animation stuff
			wp_register_script( 'ct-appear', CT_THEME_SETTINGS_MAIN_DIR_URI . '/plugin/css-animate/assets/js/jquery.appear.min.js', array( 'jquery' ) );
			wp_enqueue_script( 'ct-appear' );

			wp_register_style( 'ct-animation', CT_THEME_SETTINGS_MAIN_DIR_URI . '/plugin/css-animate/assets/css/animate.css' );
			wp_enqueue_style( 'ct-animation' );
		}
	}


	/**
	 * Adds head scripts
	 */

	public function addHeadScripts() {
		if ( $this->active && $this->isEnabled() ) {
			//add appear and call animations. In this js we already call proper animation stuff
			wp_register_script( 'ct-appear', CT_THEME_SETTINGS_MAIN_DIR_URI . '/plugin/css-animate/assets/js/jquery.appear.min.js', array( 'jquery' ) );
			wp_enqueue_script( 'ct-appear' );
		}
	}
    public function addStyle(){
        if($this->active && $this->isEnabled()){
            wp_register_style( 'ct-animation', CT_THEME_SETTINGS_MAIN_DIR_URI . '/plugin/css-animate/assets/css/animate.css' );
            wp_enqueue_style( 'ct-animation' );
        }
    }

	/**
	 * Add custom attributes
	 *
	 * @param array $content
	 * @param array $attributes
	 *
	 * @internal param $css
	 * @return string
	 */

	public function addCustomAttributes( $content, $attributes = array() ) {
		if ( $this->isEnabled() && isset( $attributes['animation'] ) && $attributes['animation'] ) {
			$this->active         = true;
			$content['data-fx']   = $attributes['animation'];
			$content['data-time'] = isset( $attributes['animation_speed'] ) ? $attributes['animation_speed'] : '';
			$content['class'][]   = 'animated';
		}

		return $content;
	}

	/**
	 * Normalized attributes
	 *
	 * @param $attr
	 */

	public function addCustomNormalizedAttributes( $attr ) {
		$attr['animation_speed'] = array(
			'label'   => esc_html__( "animation speed", 'ct_theme' ),
			'type'    => 'input',
			'default' => '',
			'group'   => esc_html__( "Animation", 'ct_theme' ),
			'help'    => esc_html__( 'In miliseconds ex. 2000 is 2 seconds', 'ct_theme' )
		);
		$attr['animation']       = array(
			'label'   => esc_html__( 'animation', 'ct_theme' ),
			'default' => '',
			'group'   => esc_html__( "Animation", 'ct_theme' ),
			'type'    => 'select',
			'choices' =>
				array(
					"" => esc_html__( "none", "ct_theme" ),
					array(
						esc_html__( 'Attention seekers', "ct_theme" )  => array(
							"flash"  => esc_html__( "Flash", "ct_theme" ),
							"bounce" => esc_html__( "Bounce", "ct_theme" ),
							"shake"  => esc_html__( "Shake", "ct_theme" ),
							"tada"   => esc_html__( "Tada", "ct_theme" ),
							"swing"  => esc_html__( "Swing", "ct_theme" ),
							"wobble" => esc_html__( "Wooble", "ct_theme" ),
							"pulse"  => esc_html__( "Pulse", "ct_theme" )
						),
						esc_html__( 'Flippers', "ct_theme" )           => array(
							"flip"     => esc_html__( "Flip", "ct_theme" ),
							"flipInX"  => esc_html__( "Flip in X", "ct_theme" ),
							"flipOutX" => esc_html__( "Flip out X", "ct_theme" ),
							"flipInY"  => esc_html__( "Flip in Y", "ct_theme" ),
							"flipOutY" => esc_html__( "Flip out Y", "ct_theme" ),
						),
						esc_html__( 'Fading entrances', "ct_theme" )   => array(
							"fadeIn"         => esc_html__( "Fade in", "ct_theme" ),
							"fadeInUp"       => esc_html__( "Fade in up", "ct_theme" ),
							"fadeInDown"     => esc_html__( "Fade in down", "ct_theme" ),
							"fadeInLeft"     => esc_html__( "Fade in left", "ct_theme" ),
							"fadeInRight"    => esc_html__( "Fade in right", "ct_theme" ),
							"fadeInUpBig"    => esc_html__( "Fade in up big", "ct_theme" ),
							"fadeInDownBig"  => esc_html__( "Fade in down big", "ct_theme" ),
							"fadeInLeftBig"  => esc_html__( "Fade in left big", "ct_theme" ),
							"fadeInRightBig" => esc_html__( "Fade in right big", "ct_theme" ),
						),
						esc_html__( 'Fading exits', "ct_theme" )       => array(
							"fadeOut"         => esc_html__( "Fade out", "ct_theme" ),
							"fadeOutUp"       => esc_html__( "Fade out up", "ct_theme" ),
							"fadeOutDown"     => esc_html__( "Fade out down", "ct_theme" ),
							"fadeOutLeft"     => esc_html__( "Fade out left", "ct_theme" ),
							"fadeOutRight"    => esc_html__( "Fade out right", "ct_theme" ),
							"fadeOutUpBig"    => esc_html__( "Fade out up big", "ct_theme" ),
							"fadeOutDownBig"  => esc_html__( "Fade out down big", "ct_theme" ),
							"fadeOutLeftBig"  => esc_html__( "Fade out left big", "ct_theme" ),
							"fadeOutRightBig" => esc_html__( "Fade out right big", "ct_theme" ),
						),
						esc_html__( 'Sliders', "ct_theme" )            => array(
							"slideInDown"   => esc_html__( "Slide in down", "ct_theme" ),
							"slideInLeft"   => esc_html__( "Slide in left", "ct_theme" ),
							"slideInRight"  => esc_html__( "Slide in right", "ct_theme" ),
							"slideOutUp"    => esc_html__( "Slide out up", "ct_theme" ),
							"slideOutLeft"  => esc_html__( "Slide out left", "ct_theme" ),
							"slideOutRight" => esc_html__( "Slide out right", "ct_theme" ),
						),
						esc_html__( 'Bouncing entrances', "ct_theme" ) => array(
							"bounceIn"      => esc_html__( "Bounce in", "ct_theme" ),
							"bounceInDown"  => esc_html__( "Bounce in down", "ct_theme" ),
							"bounceInUp"    => esc_html__( "Bounce in up", "ct_theme" ),
							"bounceInLeft"  => esc_html__( "Bounce in left", "ct_theme" ),
							"bounceInRight" => esc_html__( "Bounce in right", "ct_theme" ),
						),
						esc_html__( 'Bouncing exits', "ct_theme" )     => array(
							"bounceOut"      => esc_html__( "Bounce out", "ct_theme" ),
							"bounceOutDown"  => esc_html__( "Bounce out down", "ct_theme" ),
							"bounceOutUp"    => esc_html__( "Bounce out up", "ct_theme" ),
							"bounceOutLeft"  => esc_html__( "Bounce out left", "ct_theme" ),
							"bounceOutRight" => esc_html__( "Bounce out right", "ct_theme" ),
						),
						esc_html__( 'Rotating entrances', "ct_theme" ) => array(
							"rotateIn"          => esc_html__( "Rotate in", "ct_theme" ),
							"rotateInDownLeft"  => esc_html__( "Rotate in down left", "ct_theme" ),
							"rotateInDownRight" => esc_html__( "Rotate in down right", "ct_theme" ),
							"rotateInUpLeft"    => esc_html__( "Rotate in up left", "ct_theme" ),
							"rotateInUpRight"   => esc_html__( "Rotate in up right", "ct_theme" ),
						),
						esc_html__( 'Rotating exits', "ct_theme" )     => array(
							"rotateOut"          => esc_html__( "Rotate out", "ct_theme" ),
							"rotateOutDownLeft"  => esc_html__( "Rotate out down left", "ct_theme" ),
							"rotateOutDownRight" => esc_html__( "Rotate out down right", "ct_theme" ),
							"rotateOutUpLeft"    => esc_html__( "Rotate out up left", "ct_theme" ),
							"rotateOutUpRight"   => esc_html__( "Rotate out up right", "ct_theme" ),
						),
						esc_html__( 'Lightspeed', "ct_theme" )         => array(
							"lightSpeedIn"  => esc_html__( "Light speed in", "ct_theme" ),
							"lightSpeedOut" => esc_html__( "Light speed out", "ct_theme" ),
						),
						esc_html__( 'Specials', "ct_theme" )           => array(
							"hinge"   => esc_html__( 'Hinge', 'ct_theme' ),
							"rollIn"  => esc_html__( 'Roll in', 'ct_theme' ),
							"rollOut" => esc_html__( 'Roll out', 'ct_theme' ),
						)
					)
				),
			'help'    => sprintf( esc_html__( 'Animate this element once it becomes visible. Supported animations: %s', 'ct_theme' ), '<a target="_blank" href="https://daneden.me/animate/">https://daneden.me/animate/</a>' )
		);

		return $attr;
	}

}

new ctCssAnimatePlugin();