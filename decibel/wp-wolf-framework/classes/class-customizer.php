<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Wolf_Theme_Customizer' ) ) {
	/**
	 * Customizer Helper
	 *
	 * Create customizer inputs from array
	 *
	 * @class Wolf_Theme_Customizer
	 * @since 1.4.1
	 * @package WolfFramework
	 * @author WolfThemes
	 */
	class Wolf_Theme_Customizer {

		var $sections = array();

		public function __construct( $sections = array() ) {

			$this->sections = $sections + $this->sections;
			$this->set_priority();
			add_action( 'customize_register', array( $this, 'register_sections' ) );
			add_action( 'customize_preview_init', array( $this, 'script' ) );
		}

		/**
		 * Enqueue custom script
		 */
		public function script() {
			wp_enqueue_script(
				'wolf-theme-customizer',
				WOLF_THEME_URI . '/js/theme-customizer.js',
				array( 'jquery', 'customize-preview' ),
				WOLF_FRAMEWORK_VERSION,
				true
			);
		}

		/**
		 *  Set priority depending on array order
		 */
		public function set_priority() {

			$priority = 34;
			foreach  ( $this->sections as $key => $value ) {

				$priority++;

				$this->sections[$key]['priority'] = $priority;

				if ( isset( $value['options'] ) ) {

					$options_priority = 0;

					foreach ( $value['options'] as $k => $v ) {

						$options_priority++;

						if ( 'background' == $this->sections[$key]['options'][$k]['type'] )
							$options_priority = $options_priority + 9;

							if ( ! isset( $this->sections[$key]['options'][$k]['priority'] ) )
								$this->sections[$key]['options'][$k]['priority'] = $options_priority;
					}
				}
			}
		}

		/**
		 * Register sections
		 *
		 * @param object $wp_customize
		 */
		public function register_sections( $wp_customize ) {

			foreach ( $this->sections as $section ) {

				//debug( $section );

				$section_id    = $section['id'];
				$title    = isset( $section['title'] ) ? $section['title'] : 'Section title';
				$desc = isset( $section['desc'] ) ? $section['desc'] : '';
				$priority = isset( $section['priority'] ) ? $section['priority'] : 35;
				$is_background = isset( $section['background'] ) ? $section['background'] : false;
				$font_color    = $is_background && isset( $section['font_color'] ) ? $section['font_color'] : true;
				$parallax = $is_background && isset( $section['parallax'] ) ? $section['parallax'] : false;
				$is_bg_img     = $is_background && isset( $section['img'] ) ? $section['img'] : true;
				$is_no_bg = $is_background && isset( $section['no_bg'] ) ? $section['no_bg'] : true;
				$opacity = $is_background && isset( $section['opacity'] ) ? $section['opacity'] : true;
				$transport     = isset( $section['transport'] ) ?  $section['transport'] : 'postMessage';

				if ( $is_background ) {
					// Background Section
					$this->background_setting( $section, $section_id, $wp_customize, true );

				} else {

					$wp_customize->add_section(
						$section_id,
						array(
							'title' => $title,
							'description' => $desc,
							'priority' => $priority,
						)
					);

					$options = $section['options'];

					foreach ( $options as $option ) {

						$label     = $option['label'];
						$option_id = $option['id'];
						$type = isset( $option['type'] ) ? $option['type'] : 'text';
						$default   = isset( $option['default'] ) ? $option['default'] : '';
						$priority  = isset( $option['priority'] ) ? $option['priority'] : 1;
						$transport = isset( $option['transport'] ) ?  $option['transport'] : 'refresh';

						/* Text
						---------------*/
						if ( 'text' == $type ) {
							$wp_customize->add_setting(
								$option_id,
								array(
									'default' => $default,
									'transport' => $transport,
								)
							);

							$wp_customize->add_control(
								$option_id,
								array(
									'label' => $label,
									'section' => $section_id,
									'type' => 'text',
								)
							);

							/* Integer
							---------------*/
						} elseif ( 'int' == $type ) {

							$wp_customize->add_setting(
								$option_id,
								array(
									'default' => $default,
									'sanitize_callback' => array( $this, 'sanitize_int' ),
									'transport' => $transport,
								)
							);

							$wp_customize->add_control(
								$option_id,
								array(
									'label' => $label,
									'section' => $section_id,
									'type' => 'text',
								)
							);

							/* Color
							---------------*/
						} elseif ( 'color' == $type ) {


							$wp_customize->add_setting(
								$option_id,
								array(
									'default' => '',
									'sanitize_callback' => 'sanitize_hex_color',
									'transport' => $transport,
								)
							);

							$wp_customize->add_control(
							$wolf_wp_customize_color_control = new WP_Customize_Color_Control(
								$wp_customize,
								$option_id,
									array(
										'label' => $label,
										'section' => $section_id,
										'settings' => $option_id,
									)
								)
							);

							/* Image
							---------------*/
						} elseif ( 'image' == $type ) {

							$wp_customize->add_setting( $option_id );
							$wp_customize->add_control(
							$wolf_wp_customize_image_control = new WP_Customize_Image_Control(
								$wp_customize,
								$option_id,
									array(
										'label' => $label,
										'section' => $section_id,
										'settings' => $option_id,
									)
								)
							);

							/* Select
							---------------*/
						} elseif ( 'select' == $type ) {

							$wp_customize->add_setting(
								$option_id,
								array(
									'default' => $default,
									'transport' => $transport,
								)
							);

							$wp_customize->add_control(
								$option_id,
								array(
									'type' => 'select',
									'label' => $label,
									'section' => $section_id,
									'choices' => $option['choices'],
								)
							);

							/* Select
							---------------*/
						} elseif ( 'radio' == $type ) {

							$wp_customize->add_setting(
								$option_id,
								array(
									'default' => $default,
									'transport' => $transport,
								)
							);

							$wp_customize->add_control(
								$option_id,
								array(
									'type' => 'radio',
									'label' => $label,
									'section' => $section_id,
									'choices' => $option['choices'],
								)
							);


							/* Checkbox
							--------------------*/
						} elseif ( 'checkbox' == $type ) {

							$wp_customize->add_setting(
								$option_id,
								array(
									'default' => $default,
									'transport' => $transport,
								)
							);

							$wp_customize->add_control(
								$option_id,
								array(
									'type' => 'checkbox',
									'label' => $label,
									'section' => $section_id,
								)
							);


							/* Textarea
							--------------------*/
						} elseif ( 'textarea' == $type ) {

							$wp_customize->add_setting( $option_id );

							$wp_customize->add_control(
							$wolf_customize_textarea_control = new Wolf_Customize_Textarea_Control(
								$wp_customize,
								$option_id,
									array(
										'label' => $label,
										'section' => $section_id,
										'settings' => $option_id,
										)
								)
							);


							/* Textarea
							--------------------*/
						} elseif ( 'skins' == $type ) {

							$wp_customize->add_setting( $option_id );

							$wp_customize->add_control(
							$wolf_customize_skins_control = new Wolf_Customize_Skins_Control(
								$wp_customize,
								$option_id,
									array(
										'label' => $label,
										'section' => $section_id,
										'settings' => $option_id,
										'choices' => $option['choices'],
									)
								)
							);
						}

						/*----------------------------- Background option --------------------------------*/

						elseif ( 'background' == $type ) {

							$this->background_setting( $option, $section_id, $wp_customize, false );
						}
					} // end foreach options

				} // end not background
			}
		}

		/**
		 *  Register a background section
		 */
		public function background_setting( $option, $section_id, $wp_customize, $section = true ) {

			$label = isset( $option['label'] ) ? $option['label'] : '';
			$background_id = true == $section ? $section_id :  $option['id'];
			$font_color = isset( $option['font_color'] ) ? $option['font_color'] : true;
			$default_font_color = isset( $option['default_font_color'] ) ? $option['default_font_color'] : 'dark';
			$parallax = isset( $option['parallax'] ) ? $option['parallax'] : false;
			$is_bg_img = isset( $option['img'] ) ? $option['img'] : true;
			$is_no_bg = isset( $option['no_bg'] ) ? $option['no_bg'] : true;
			$opacity = isset( $option['opacity'] ) ? $option['opacity'] : true;
			$transport = isset( $option['transport'] ) ?  $option['transport'] : 'postMessage';

			if ( $section ) {

				$desc     = isset( $option['desc'] ) ? $option['desc'] : '';
				$priority = isset( $option['priority'] ) ? $option['priority'] : 35;

				$wp_customize->add_section(
					$section_id,
					array(
						'title' => $label,
						'description' => $desc,
						'priority' => $priority,
					)
				);
			}

			if ( $font_color ) {

				/* Font Color
				--------------------*/
				$wp_customize->add_setting(
					$background_id . '_font_color',
					array(
						'default' => $default_font_color,
					)
				);

				$wp_customize->add_control(
					$background_id . '_font_color',
					array(
						'type' => 'select',
						'label' => __( 'Font Color', 'wolf' ),
						'section' => $section_id,
						'choices' => array(
							'dark' => 'dark',
							'light' => 'light',

						),
						'priority' => 0,
					)
				);

			} //  endif font color option

			if ( $is_no_bg ) {

				/* None
				--------------------*/
				$wp_customize->add_setting(
					$background_id . '_none',
					array(
						'transport' => 'refresh',
					)
				);

				$wp_customize->add_control(
					$background_id . '_none',
					array(
						'type' => 'checkbox',
						'label' => __( 'No Background', 'wolf' ),
						'section' => $section_id,
						'priority' => 1,
					)
				);

			} // endif no bg option

			/* Color
			---------------*/
			$wp_customize->add_setting(
				$background_id . '_color',
				array(
					'default' => '',
					'sanitize_callback' => 'sanitize_hex_color',

				)
			);

			$wp_customize->add_control(
			$wolf_wp_customize_color_control = new WP_Customize_Color_Control(
				$wp_customize,
				$background_id . '_color',
					array(
						'label' => __( 'Background Color', 'wolf' ),
						'section' => $section_id,
						'settings' => $background_id . '_color',
						'priority' => 2,
					)
				)
			);

			if ( $opacity ) :

				/* Opacity
				---------------*/
				$wp_customize->add_setting(
					$background_id . '_opacity',
					array(
						'default' => 100,
					)
				);

				$wp_customize->add_control(
					$background_id . '_opacity',
					array(
						'label' => __( 'Background color opacity (in percent)', 'wolf' ),
						'section' => $section_id,
						'type' => 'text',
						'priority' => 3,
					)
				);
			endif;

			if ( $is_bg_img ) :

				/* Image
				---------------*/
				$wp_customize->add_setting( $background_id . '_img' );

				$wp_customize->add_control(
				$wolf_wp_customize_image_control = new WP_Customize_Image_Control(
					$wp_customize,
					$background_id . '_img',
						array(
							'label' => __( 'Background Image', 'wolf' ),
							'section' => $section_id,
							'settings' => $background_id . '_img',
							'priority' => 4,
						)
					)
				);

				/* Repeat
				---------------*/
				$wp_customize->add_setting(
					$background_id . '_repeat',
					array(
						'default' => 'repeat',
						'transport' => $transport,
					)
				);

				$wp_customize->add_control(
					$background_id . '_repeat',
					array(
						'type' => 'select',
						'label' => __( 'Background Repeat', 'wolf' ),
						'section' => $section_id,
						'choices' => array(
							'repeat' => 'repeat',
							'no-repeat' => 'no-repeat',
							'repeat-x' => 'repeat-x',
							'repeat-y' => 'repeat-y',
						),
						'priority' => 5,
					)
				);

				/* Position
				---------------*/
				$wp_customize->add_setting(
					$background_id . '_position',
					array(
						'default' => 'center top',
						'transport' => $transport,
					)
				);

				$wp_customize->add_control(
					$background_id . '_position',
					array(
						'type' => 'select',
						'label' => __( 'Background Position', 'wolf' ),
						'section' => $section_id,
						'choices' => array(
							'center top' => 'center top',
							'left top' => 'left top',
							'right top' => 'right top',
							'center bottom' => 'center bottom',
							'left bottom' => 'left bottom',
							'right bottom' => 'right bottom',
							'center center' => 'center center',
							'left center' => 'left center',
							'right center' => 'right center',
						),
						'priority' => 6,
					)
				);

				/* Attachment
				----------------------*/
				$wp_customize->add_setting(
					$background_id . '_attachment',
					array(
						'default' => 'scroll',
						'transport' => $transport,
					)
				);

				$wp_customize->add_control(
					$background_id . '_attachment',
					array(
						'type' => 'select',
						'label' => __( 'Background Attachment', 'wolf' ),
						'section' => $section_id,
						'choices' => array(
							'scroll' => 'scroll',
							'fixed' => 'fixed',
						),
						'priority' => 7,
					)
				);

				/* Size
				---------------*/
				$wp_customize->add_setting(
					$background_id . '_size',
					array(
						'default' => 'normal',
						'transport' => $transport,
					)
				);

				$wp_customize->add_control(
					$background_id . '_size',
					array(
						'type' => 'select',
						'label' => __( 'Background Size', 'wolf' ),
						'section' => $section_id,
						'choices' => array(
							'cover' => __( 'cover (resize)', 'wolf' ),
							'normal' => __( 'normal', 'wolf' ),
							'resize' => __( 'responsive (hard resize)', 'wolf' ),
						),
						'priority' => 8,
					)
				);


				if ( $parallax ) {

					/* Parallax
					--------------------*/
					$wp_customize->add_setting(
						$background_id . '_parallax'
					);

					$wp_customize->add_control(
						$background_id . '_parallax',
						array(
							'type' => 'checkbox',
							'label' => __( 'Parallax', 'wolf' ),
							'section' => $section_id,
							'priority' => 9,
						)
					);

				}

			endif; // end if bg image

		}

		/**
		 *  Sanitize integer
		 *
		 * @param string $input
		 * @return int
		 */
		public function sanitize_int( $input ) {

			return intval( $input );

		}

	} // end class

} // end class exists check

if ( ! function_exists( 'wolf_customizer_add_custom_sections' ) ) {
	/**
	 * Adds custom sections to the theme customizer
	 *
	 * @access public
	 * @param object $wp_customize
	 * @return void
	 */
	function wolf_customizer_add_custom_sections( $wp_customize ) {

		class Wolf_Customize_Textarea_Control extends WP_Customize_Control {

			public $type = 'textarea';

			public $statuses;

			public function __construct( $manager, $id, $args = array() ) {
				$this->statuses = array( '' => __( 'Default', 'wolf' ) );
				parent::__construct( $manager, $id, $args );
			}

			public function render_content() {
				?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
				</label>
				<?php
			}
		} // end textarea

		class Wolf_Customize_Skins_Control extends WP_Customize_Control {

			public $type = 'skins';

			public function __construct( $manager, $id, $args = array() ) {
				$this->statuses = array( '' => __( 'Default', 'wolf' ) );
				parent::__construct( $manager, $id, $args );
			}

			public function render_content() {
				$reset_options_confirm = __( 'Are you sure to want to reset all styles to default ?', 'wolf' );
				?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

					<?php if ( ! empty( $this->choices ) ) :
					foreach ( $this->choices as $value => $label ) : ?>
						<a style="margin-bottom:5px;" class="button wolf-preset-button" rel="<?php echo sanitize_title( $value ); ?>" href="<?php echo esc_url( admin_url( 'admin.php?page=wolf-customizer-presets&amp;skin=' . $value ) ); ?>"><?php echo sanitize_title( $label ); ?></a>
						<?php endforeach; ?>
					<a  style="margin-bottom:5px;" class="button wolf-preset-button" rel="reset" href="<?php echo esc_url( admin_url( 'admin.php?page=wolf-customizer-presets&amp;skin=reset' ) ); ?>"><?php _e( 'reset all', 'wolf' ); ?></a>
					<?php endif; ?>
				</label>
				<?php
			}

		} // end textarea

	} // end function

	add_action( 'customize_register', 'wolf_customizer_add_custom_sections' );
} // end function check