<?php

/**
 * Wrapper class for Redux
 * @property Redux_Options $redux
 */
class PGL_Options {
	function __construct() {
		$this->THEME_OPTION    = _PREFIX_ . 'THEME_OPTION';
		$this->TEXT_DOMAIN     = PGL;
		$this->options         = array();
		$this->default_options = array();
		$this->setup           = array();
		$this->redux           = NULL;

		//setup REDUX if we are in admin
		PGL_Loader::find( 'redux/defaults' );
		add_action( 'init', array( $this, 'setup_redux' ), 0 );
		add_action( 'init', array( $this, 'init' ), 200 );
		add_filter( 'redux-opts-options-validate-PGL_THEME_OPTION', array( $this, 'recompile_less' ) );
		$this->get_theme_options();
	}

	function get_theme_options() {
		$this->options = wp_parse_args( get_option( $this->THEME_OPTION ), $this->get_theme_default_options() );
//		$this->default_options = $this->get_theme_default_options();
	}

	/**
	 * Get the default options
	 *
	 * @return array
	 */
	function get_theme_default_options() {
		if ( empty( $this->default_options ) )
			$this->default_options = array(
				'enable_slider'        => FALSE,
				'slider_images'        => array(),
				'post_layout'          => 'post-default',
				'home_layout'          => 'post-loop-default',
				'integrate_acf'        => FALSE,
				'enable_estate'        => FALSE,
				'use_default_image'    => FALSE,
				'default_image_width'  => 256,
				'default_image_height' => 256,
				'default_image_text'   => 'pixelGeeklab'
			);
		return $this->default_options;
	}

	/**
	 * Only call this after setup options
	 */
	function init() {
		$this->redux = new Redux_Options( $this->setup['sections'], $this->setup['args'], $this->setup['tabs'] );
	}

	function set_theme_options( $option = array() ) {
		if ( ! empty ( $option ) ) {
			$this->options = $option;
		}
	}

	/**
	 * @param       string/array       $key
	 * @param mixed $value
	 */
	function set_option( $key, $value = '' ) {
		if ( is_array( $key ) ) {
			foreach ( $key as $k => $v ) {
				$this->options[$k] = $v;
			}
		}
		else {
			$this->options[$key] = $value;
		}
	}

	function set_default_option( $key, $value = '' ) {
		if ( is_array( $key ) ) {
			foreach ( $key as $k => $v ) {
				$this->default_options[$k] = $v;
			}
		}
		else {
			$this->default_options[$key] = $value;
		}
	}


	/**
	 * #################################################
	 * #################################################
	 * Wrapper functions for Redux Framework
	 * #################################################
	 * #################################################
	 */

	/**
	 * Setup Redux option & create the option panel
	 *
	 * @param array $setup
	 *
	 * @return void
	 */
	function setup_redux( $setup = array() ) {
		if ( ! defined( 'Redux_TEXT_DOMAIN' ) ) {
			define( 'Redux_TEXT_DOMAIN', $this->TEXT_DOMAIN );
		}
		if ( empty( $setup ) ) {
			$this->setup_arguments();
			$this->setup_sections();
			$this->setup_addons();
			$this->setup_tabs();
			$this->setup_extras();
		}
		else {
			$this->setup_arguments( $setup['args'] );
			$this->setup_sections( $setup['sections'] );
			$this->setup_tabs( $setup['tabs'] );
			$this->setup_addons();
			$this->setup_extras();
		}
	}

	/**
	 * Setup arguments for Redux
	 *
	 * @param array $args
	 *
	 * @return array
	 */
	function setup_arguments( $args = array() ) {
		if ( empty( $args ) ) {
			$args                        = array();
			$args['dev_mode']            = FALSE;
			$args['std_show']            = TRUE;
			$args['dev_mode_icon_class'] = 'icon-large';
//			$args['intro_text']          = __( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', $this->TEXT_DOMAIN );
//			$args['footer_text'] = __( '<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', $this->TEXT_DOMAIN );
			// Setup custom links in the footer for share icons
			$args['share_icons']['twitter']   = array(
				'link'  => 'http://twitter.com/ghost1227',
				'title' => __( 'Follow me on Twitter', $this->TEXT_DOMAIN ),
				'img'   => Redux_OPTIONS_URL . 'img/social/Twitter.png',
			);
			$args['share_icons']['linked_in'] = array(
				'link'  => 'http://www.linkedin.com/profile/view?id=52559281',
				'title' => __( 'Find me on LinkedIn', $this->TEXT_DOMAIN ),
				'img'   => Redux_OPTIONS_URL . 'img/social/LinkedIn.png',
			);
			$args['import_icon_class']        = 'icon-large';
			$args['opt_name']                 = $this->THEME_OPTION;
			$args['menu_title']               = __( 'Theme Panel', $this->TEXT_DOMAIN );
			$args['page_title']               = __( 'PixelGeekLab Theme Option Panel', $this->TEXT_DOMAIN );
			$args['page_slug']                = 'redux_options';
			$args['help_tabs'][]              = array(
				'id'      => 'redux-opts-1',
				'title'   => __( 'Theme Information 1', $this->TEXT_DOMAIN ),
				'content' => __( '<p>This is the tab content, HTML is allowed.</p>', $this->TEXT_DOMAIN )
			);
			$args['help_tabs'][]              = array(
				'id'      => 'redux-opts-2',
				'title'   => __( 'Theme Information 2', $this->TEXT_DOMAIN ),
				'content' => __( '<p>This is the tab content, HTML is allowed.</p>', $this->TEXT_DOMAIN )
			);
			$args['help_sidebar']             = __( '<p>This is the sidebar content, HTML is allowed.</p>', $this->TEXT_DOMAIN );
			$args['allow_sub_menu']           = FALSE;
			$args['google_api_key']           = 'AIzaSyCNQ6wXgyiNBDlCTrqJQTgCvoZWk0_cZrY';
		}
		$this->setup['args'] = $args;
		return $args;
	}

	function setup_sections( $sections = array() ) {
		if ( empty( $sections ) ) {
			$sections[] = array(
				'id'         => 'general',
				'icon'       => 'cog',
				'title'      => __( 'General settings', PGL ),
				'desc'       => '',
				'fields'     => array(
					array(
						'id'       => 'site_logo',
						'title'    => __( 'Website \'s logo', PGL ),
						'type'     => 'upload',
						'sub_desc' => __( 'Change logo on your website', PGL ),
						'desc'     => __( 'Logo file should be in png format', PGL ),
					),
					array(
						'id'      => 'theme_layout',
						'type'    => 'select',
						'title'   => __( 'Select layout:', PGL ),
						'sub_desc'  => __('Fluid or Boxed layout', PGL),
						'options' => array(
							'fluid'=>__('Fluid', PGL),
							'boxed'=>__('Boxed', PGL)
						),
						'std'     => 'fluid',
					),
                    array(
                        'id'      => 'theme_skin',
                        'type'    => 'select',
                        'title'   => __( 'Select skin:', PGL ),
                        'sub_desc'  => __('Select from default skin or you can select custom skin', PGL),
                        'options' => array(
                            'default'=>__('Default', PGL),
                            'blue'=>__('Blue', PGL),
                            'brown'=>__('Brown', PGL),
                            'green'=>__('Green', PGL),
                            'orange'=>__('Orange', PGL),
                            'water'=>__('Water', PGL),
                            'purple'=>__('Purple', PGL),
                            'custom'=>__('Custom', PGL)
                        ),
                        'std'     => 'default',

                    ),
					array(
						'id'   => 'footer_info',
						'type' => 'info',
						'desc' => '<strong>'.__( 'Footer Copyright Text', PGL ).'</strong>',
					),
					array(
						'id' => 'footer_copyright',
						'type' => 'textarea',
						'title' => __('Footer Copyright Text', PGL),
						'sub_desc' => __('HTML Allowed', PGL),
						'desc' => __('Some HTML is allowed.', PGL),
						'validate' => 'html' // See http://codex.wordpress.org/Function_Reference/wp_kses_post
					),
					array(
						'id'   => 'dummy_info',
						'type' => 'info',
						'desc' => '<strong>'.__( 'Social link settings', PGL ).'</strong>',
					),
					array(
						'id'       => 'link_twitter',
						'type'     => 'text',
						'title'    => 'Twitter',
						'sub_desc' => __( 'Your Twitter URL', PGL ),
						'std'      => 'http://twitter.com',
						'validate' => 'url'
					),
					array(
						'id'       => 'link_facebook',
						'type'     => 'text',
						'title'    => 'Facebook',
						'sub_desc' => __( 'Your Twitter URL', PGL ),
						'std'      => 'http://facebook.com',
						'validate' => 'url'
					),
					array(
						'id'       => 'link_plus',
						'type'     => 'text',
						'title'    => 'Google Plus',
						'sub_desc' => __( 'Your Google+ URL', PGL ),
						'std'      => 'http://plus.google.com',
						'validate' => 'url'
					),
					array(
						'id'       => 'link_pinterest',
						'type'     => 'text',
						'title'    => 'Pinterest',
						'sub_desc' => __( 'Your Piterest URL', PGL ),
						'std'      => '',
						'validate' => 'url'
					),
					array(
						'id'    => 'link_email',
						'type'  => 'text',
						'title' => 'Contact email',
						'std'   => '',
						'validate' => 'email'
					)
				),
			);

			$header     = array(
				'id'         => 'header',
				'icon'       => 'list-alt',
				'title'      => __( 'Header', PGL ),
				'desc'       => __( 'You can change settings for Header here', PGL ),
				'sub_desc'   => __( 'Just a dummy description', PGL ),
				'fields'     => array(
                    array(
                        'id'    => 'header_type',
                        'type'  => 'select',
                        'title' => __('Header type', PGL),
                        'options'=> array('static' => __('Static'), 'fixed' => 'Flexible'),
                        'std'   => 'static',
                        'desc'  => __('Change header type, static is stay on top, flexible is scroll with page scroll')
                    ),
					array(
						'id'    => 'header_image',
						'title' => __( 'Header image', PGL ),
						'type'  => 'upload'
					),
                    array(
                        'id'       => 'show_headimg',
                        'title'    => __( 'Show header image', PGL ),
                        'type'     => 'checkbox',
                        'desc'     => __( 'Show header image for all pages', PGL ),
                        'sub_desc' => __( 'Note: when slider is disabled, the header image will be used instead!', PGL ),
                        'switch'   => TRUE,
                        'std'      => '0',
                    ),
                    array(
                        'id'       => 'show_home_icon',
                        'title'    => __( 'Show first menu item as home icon', PGL ),
                        'type'     => 'checkbox',
                        'desc'     => __( 'Enable to show first menu item as Home Icon, Disable to show text', PGL ),
                        'switch'   => TRUE,
                        'std'      => '1',
                    ),
					array(
						'id'       => 'enable_slider',
						'title'    => __( 'Enable Slider', PGL ),
						'type'     => 'checkbox',
						'desc'     => __( 'Enable or disable Slider on the Front-page', PGL ),
						'sub_desc' => __( 'Note: when slider is disabled, the header image will be used instead!', PGL ),
						'switch'   => TRUE,
						'std'      => '0',
					),
					array(
						'id'       => 'slider_images',
						'title'    => __( 'Slider Images', PGL ),
						'callback' => array( $this, 'callback_slider' ),
					),

				)
			);
			$sections[] = $header;

			$style      = array(
				'id'         => 'style',
				'icon'       => 'tint',
				'title'      => __( 'Custom Skin Config', PGL ),
				'desc'       => __( 'Change color(s) for custom skin only', PGL ),
				'fields'     => array(
					array(
						'id'    => 'bg_image',
						'title' => __( 'Background image', PGL ),
						'desc'  => __('Background image for custom skin', PGL),
						'type'  => 'upload'
					),
					array(
						'id'      => 'bg_repeat',
						'type'    => 'select',
						'title'   => __( 'Background repeat:', PGL ),
						'options' => array(
							'no-repeat'=>__('No repeat', PGL),
							'repeat'=>__('Repeat all', PGL),
							'repeat-x'=>__('Repeat horizontal', PGL),
							'repeat-y'=>__('Repeat vertical', PGL)
						),
						'std'     => 'repeat',

					),
					array(
						'id'      => 'bg_position',
						'type'    => 'text',
						'title'   => __( 'Background image position:', PGL ),
						'desc'  => __('Background image position for uploaded image, you can read about background position by click <a href="https://developer.mozilla.org/en-US/docs/Web/CSS/background-position" target="_blank">here</a>', PGL),
						'std'     => '0 0',
					),
					array(
						'id'    => 'bg_color',
						'type'  => 'color',
						'title' => __('Body background color', PGL),
						'desc'  => __('Background color for custom skin', PGL),
						'std'   => '#000000'
					),
					array(
						'id'    => 'color',
						'type'  => 'color',
						'title' => __('Logo, boxes background', PGL),
						'std'   => '#d84949'
					),
					array(
						'id'    => 'color2',
						'type'  => 'color',
						'title' => __('Base text color, button background', PGL),
						'std'   => '#333333',
					),
					array(
						'id'    => 'link_color',
						'type'  => 'color',
						'title' => __('Link color', PGL),
						'std'   => '#333333',
					),
					array(
						'id'    => 'hlink_color',
						'type'  => 'color',
						'title' => __('Link hover color', PGL),
						'std'   => '#999999',
					),
					array(
						'id'    => 'bg_header_bar',
						'type'  => 'color',
						'title' => __('Header topbar background', PGL),
						'std'   => '#000000',
					),
					array(
						'id'    => 'bg_header_text',
						'type'  => 'color',
						'title' => __('Header topbar text color', PGL),
						'std'   => '#FFFFFF',
					),
					array(
						'id'    => 'bg_header',
						'type'  => 'color',
						'title' => __('Header background', PGL),
						'std'   => '#FFFFFF',
					),
					array(
						'id'    => 'nav_text',
						'type'  => 'color',
						'title' => __('Menu text color', PGL),
						'std'   => '#000000',
					),
					array(
						'id'    => 'nav_hover',
						'type'  => 'color',
						'title' => __('Menu hover background', PGL),
						'std'   => '#000000',
					),
					array(
						'id'    => 'nav_htext',
						'type'  => 'color',
						'title' => __('Menu hover text color', PGL),
						'std'   => '#FFFFFF',
					),
					array(
						'id'    => 'bg_footer',
						'type'  => 'color',
						'title' => __('Footer background color', PGL),
						'std'   => '#000000',
					),
					array(
						'id'    => 'footer_text',
						'type'  => 'color',
						'title' => __('Footer text color', PGL),
						'std'   => '#999999',
					),
					array(
						'id'    => 'footer_heading',
						'type'  => 'color',
						'title' => __('Footer heading text color', PGL),
						'std'   => '#FFFFFF',
					),
//					array(
//						'id'    => 'google_font',
//						'type'  => 'google_webfonts',
//						'title' => 'Google Webfonts',
//					)
				)
			);
			$sections[] = $style;
			/**
			 * Layout settings
			 *
			 * @var array $layout
			 */
			$layout     = array(
				'id'         => 'layout',
				'icon'       => 'eye-close',
				'title'      => __( 'Layout', PGL ),
				'desc'       => __( 'You can change layout for post,page or estate here ', PGL ),
				'fields'     => array(
					array(
						'id'      => 'post_layout',
						'type'    => 'select',
						'title'   => __( 'Post details layout', PGL ),
						'options' => PGL_Utilities::list_template_file( 'templates/single', 'post' ),
						'std'     => 'post-default',

					),
					array(
						'id'      => 'home_layout',
						'type'    => 'select',
						'title'   => __( 'Post listing layout', PGL ),
						'options' => PGL_Utilities::list_template_file( 'templates/loop', 'post-loop' ),
						'std'     => 'post-loop-default',
					)
				)
			);
			$sections[] = $layout;

			$misc       = array(
				'id'         => 'misc',
				'icon'       => 'magic',
				'title'      => __( 'Miscellaneous', PGL ),
				'desc'       => __( '', PGL ),
				'fields'     => array(
					array(
						'id'     => 'use_default_image',
						'type'   => 'checkbox',
						'title'  => __( 'Use default image', PGL ),
						'desc'   => __( 'Generate default image whenever the post doesn\'t have a featured image', PGL ),
						'switch' => TRUE
					),
					array(
						'id'    => 'default_image_text',
						'type'  => 'text',
						'title' => __( 'Default image \'s text', PGL ),
					),
					array(
						'id'    => 'header_code',
						'type'  => 'textarea',
						'title' => 'Header Code',
						'desc'  => __('Code put here will be printed before the close tag </head>',PGL)
					),
					array(
						'id'    => 'footer_code',
						'type'  => 'textarea',
						'title' => 'Footer code',
						'desc'  => __( 'Code put here will be printed before the close tag </body>', PGL)
					)
				)
			);
			$sections[] = $misc;
		}
		$this->setup['sections'] = $sections;
		return $sections;
	}

	function setup_addons() {
		// $addons = array(
		// 	'id'         => 'addons',
		// 	'icon'       => 'globe',
		// 	'icon_class' => 'icon-2x',
		// 	'title'      => __( 'Addons', PGL ),
		// 	'desc'       => '',
		// 	'fields'     => array()
		// );

		$addon_files = PGL_Utilities::list_file( 'inc/addons' );
		$active      = array();
		foreach ( $addon_files as $k => $af ) {
			include_once PGL_PATH . 'inc/addons/' . $k . '.php';
			$className = 'PGL_Addon_' . $k;

			if ( class_exists( $className ) && is_callable( $className . '::add_option_panel' ) ) {
				call_user_func( array( $className, 'add_option_panel' ), $this );
			}
		}
	}

	function setup_tabs( $tabs = array() ) {
		if ( empty( $tabs ) ) {
			$tabs = array();
		}
		$this->setup['tabs'] = $tabs;
		return $tabs;
	}

	function setup_extras( $prefix = '' ) {

	}

	function option( $key, $default = NULL ) {
		if ( is_null( $this->redux ) ) {
			return ( isset( $this->options[$key] ) ? $this->options[$key] : $default );
		}
		else {
			return $this->redux->get( $key, $default );
		}
	}

	function add_section( $section = array(), $after = '' ) {
		if ( ! empty( $section ) )
			if ( $after ) {
				$k = 0;
				foreach ( $this->setup['sections'] as $k => $v ) {
					if ( $v['id'] == $after )
						break;
				}
				$this->setup['sections'] = array_merge( array_slice( $this->setup['sections'], 0, $k + 1, TRUE ) + array( $k + 1 => $section ), array_slice( $this->setup['sections'], $k + 1, count( $this->setup['sections'] ) - ( $k + 1 ), TRUE ) );
			}
			else {
				$this->setup['sections'][] = $section;
			}
	}

	function add_section_field( $section_id, $field = array() ) {
		if ( isset( $this->setup['sections'][$section_id] ) ) {
			$this->setup['sections'][$section_id]['fields'][] = $field;
		}
	}

	function add_option_tab( $tab = array() ) {
		if ( ! empty( $tab ) )
			$this->setup['tabs'][] = $tab;
	}

	function add_option_args( $args = array() ) {
		if ( ! empty( $args ) )
			$this->setup['args'][] = $args;
	}

	function get_setup() {
		return $this->setup;
	}

	function default_option( $key, $default = NULL ) {
		if ( isset( $this->default_options[$key] ) ) {
			return $this->default_options[$key];
		}
		else {
			return $default;
		}
	}

	/**
	 * ########################################################
	 * ########################################################
	 * Utility functions
	 * ########################################################
	 * ########################################################
	 */


	/**
	 * #########################################################
	 * #########################################################
	 * Callback functions
	 * #########################################################
	 * #########################################################
	 */

	/**
	 *
	 * @param $field
	 * @param $value
	 */
	function callback_slider( $field, $value ) {
		wp_enqueue_media();
		wp_enqueue_script( _PREFIX_ . 'option-panel-slider-js', PGL_URI_JS . 'options/slider-upload.js', array(), '1.1', TRUE );
		wp_enqueue_style( _PREFIX_ . 'option-panel-slider-css', PGL_URI_CSS . 'options/slider-upload.css', array(), '1.0' );
		?>
		<div class="pgl-slider-uploader">
			<input type="hidden" id="slider_count" value="0">
			<input type="hidden" class="slide_option_id" value="<?php echo $this->THEME_OPTION . "[{$field['id']}]" ?>">

			<div class="uploader">
				<label>
					<input class="button slide_button_trigger" name="_unique_name_button" value="Select image" />
				</label>
			</div>
			<div class="image-container">
				<ul class="slide-image-list">
					<?php
					if ( isset( $value ) && ! empty( $value ) ) {
						for ( $i = 0; $i < count( $value['url'] ); $i ++ ) {
							?>
							<li class="pgl-slider-thumb">
								<a href="#" title="Delete" class="slide-remove"><i
											class="icon-remove icon-large"></i></a>
								<img src="<?php echo $value['url'][$i] ?>" alt="">
								<input type="hidden"
								       name="<?php echo $this->THEME_OPTION . "[{$field['id']}][url][]" ?>"
								       value="<?php echo $value['url'][$i]; ?>" />
								<input type="hidden" name="<?php echo $this->THEME_OPTION . "[{$field['id']}][id][]" ?>"
								       value="<?php echo $value['id'][$i]; ?>" />

								<div class="info-container">
									<label>
										<input type="text"
										       name="<?php echo $this->THEME_OPTION . "[{$field['id']}][title][]" ?>"
										       value="<?php echo $value['title'][$i] ?>" placeholder="text...">
									</label>
									<label for=""><input type="text" name="<?php echo $this->THEME_OPTION . "[{$field['id']}][link][]" ?>" value="<?php if ( isset( $value['link'][$i] ) ) echo $value['link'][$i] ?>" placeholder="Link"></label>
									<textarea name="<?php echo $this->THEME_OPTION . "[{$field['id']}][desc][]" ?>"
									          id="" cols="30" rows="10"
									          style=""><?php echo $value['desc'][$i] ?></textarea>
								</div>
							</li>
						<?php
						}
					} ?>
				</ul>
			</div>
		</div>
	<?php
	}

	/**
	 * Miscellanous functions
	 */
	function recompile_less( $values ) {
        if($values['theme_skin']=='custom'){
	        global $blog_id;
            require_once PGL_PATH . '/inc/lib/lessc.php';
            $lessc = new lessc;
	        foreach(array('bg_image','bg_header','bg_header_bar','bg_header_text','bg_repeat','bg_position','bg_color','color','color2','link_color','hlink_color','nav_text','nav_hover','nav_htext','bg_footer','footer_text','footer_heading') as $key){
		        if($values[$key]){
			        $val = $values[$key];
			        if($key=='bg_image'){
				        $val = '"'.$val.'"';
			        }
			        if($key=='bg_position'){
				        $position = explode(' ',$val);
				        if(count($position>1)){
					        $lessc->setVariables(array(
						        'bg_pos_x' => $position[0],
						        'bg_pos_y' => $position[1]
					        ));
				        }
			        }else{
				        $lessc->setVariables(array(
					        $key => $val
				        ));
			        }
		        }
	        }
	        if(is_multisite()){
		        $lessc->compileFile( PGL_PATH . 'assets/less/custom.less', PGL_PATH . 'assets/css/skins/custom'.$blog_id.'.css' );
	        }else{
                $lessc->compileFile( PGL_PATH . 'assets/less/custom.less', PGL_PATH . 'assets/css/skins/custom.css' );
	        }
        }
        return $values;
	}
}

?>
