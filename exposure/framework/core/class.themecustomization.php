<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Theme customization class.
 *
 * This class is entitled to manage the theme customizations.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Core
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
if( !class_exists('THB_ThemeCustomization') ) {
	class THB_ThemeCustomization {

		/**
		 * The theme additional styles.
		 *
		 * @var array
		 */
		public $additionalStyles = array();

		/**
		 * The theme customization sections.
		 *
		 * @var array
		 */
		public $_sections = array();

		/**
		 * The theme settings counter.
		 *
		 * @var int
		 */
		public $_settingsCounter = 0;

		/**
		 * Add a section to the customizer.
		 *
		 * @param string $id The section ID.
		 * @param string $label The section label.
		 * @return void
		 */
		public function addSection( $id, $label )
		{
			$section = array(
				'id'       => $id,
				'label'    => $label,
				'priority' => count($this->_sections),
				'settings' => array()
			);

			$this->_sections[] = $section;
		}

		/**
		 * Add a divider to the section.
		 *
		 * @param string $label The divider label.
		 * @return void
		 */
		public function addDivider( $label = '' )
		{
			$this->addSetting( '_divider_', $label, 'THB_Divider_Control' );
		}

		/**
		 * Add a color setting to the customizer.
		 *
		 * @param array $selectors The setting selectors array
		 * @param string $default The setting default value
		 * @param string $label The setting label
		 */
		public function addColorSetting( $selectors, $default='', $label='' )
		{
			$this->addSetting( '_color', !empty($label) ? $label : __('Color', 'thb_text_domain'), 'WP_Customize_Color_Control', $default );

			foreach( $selectors as $selector => $rule ) {
				$this->addSelector($selector, $rule);
			}
		}

		/**
		 * Add a background control to the section.
		 *
		 * @param array $selector The CSS selector.
		 * @param string $default The default values for the setting.
		 * @return void
		 */
		public function addBackgroundSettings( $selector, $defaults=array() )
		{
			$this->addSetting( '_background_color', __('Background color', 'thb_text_domain'), 'WP_Customize_Color_Control', isset($defaults['background-color']) ? $defaults['background-color'] : '' );
			$this->addSelector($selector, 'background-color');

			$this->addBackgroundImageSettings( $selector, $defaults );
		}

		/**
		 * Add a background image control to the section.
		 *
		 * @param array $selector The CSS selector.
		 * @param string $default The default values for the setting.
		 * @return void
		 */
		public function addBackgroundImageSettings( $selector, $defaults=array() )
		{
			$this->addSetting( '_background_image', __('Background image', 'thb_text_domain'), 'WP_Customize_Image_Control', isset($defaults['background-image']) ? $defaults['background-image'] : '' );
			$this->addSelector( $selector, 'background-image' );

			$this->addSetting( '_background_repeat', __('Repeat', 'thb_text_domain'), 'THB_BackgroundRepeat_Control', isset($defaults['background-repeat']) ? $defaults['background-repeat'] : '' );
			$this->addSelector( $selector, 'background-repeat' );

			$this->addSetting( '_background_position', __('Position', 'thb_text_domain'), 'THB_BackgroundPosition_Control', isset($defaults['background-position']) ? $defaults['background-position'] : '' );
			$this->addSelector( $selector, 'background-position' );

			$this->addSetting( '_background_attachment', __('Attachment', 'thb_text_domain'), 'THB_BackgroundAttachment_Control', isset($defaults['background-attachment']) ? $defaults['background-attachment'] : '' );
			$this->addSelector( $selector, 'background-attachment' );
		}

		/**
		 * Add a font setting to the customizer.
		 *
		 * @param string $selector The setting selector
		 * @param string $default The setting default value
		 * @param string $label The setting label
		 */
		public function addFontsSettings( $selector, $default='', $label='' )
		{
			$this->addSetting( '_font_family', !empty($label) ? $label : __('Family', 'thb_text_domain'), 'THB_FontFamily_Control', $default['font-family'] );
			$this->addSelector($selector, 'font-family');

			$this->addSetting( '_font_size', __('Size', 'thb_text_domain'), 'THB_FontSize_Control', $default['font-size'] );
			$this->addSelector($selector, 'font-size');

			$this->addSetting( '_font_line_height', __('Leading', 'thb_text_domain'), 'THB_FontLineHeight_Control', $default['line-height'] );
			$this->addSelector($selector, 'line-height');

			$this->addSetting( '_font_letter_spacing', __('Spacing', 'thb_text_domain'), 'THB_FontLetterSpacing_Control', $default['letter-spacing'] );
			$this->addSelector($selector, 'letter-spacing');

			$this->addSetting( '_text_variant', __('Variant', 'thb_text_domain'), 'THB_TextVariant_Control', $default['text-variant'] );
			$this->addSelector($selector, 'text-variant');

			$this->addSetting( '_font_case', __('Case', 'thb_text_domain'), 'THB_FontCase_Control', $default['text-transform'] );
			$this->addSelector($selector, 'text-transform');
		}

		/**
		 * Add a setting to the customizer.
		 *
		 * @param string $id The setting ID.
		 * @param string $label The setting label.
		 * @param string $type The setting control type.
		 * @param mixed $default The default value for the setting.
		 * @return void
		 */
		public function addSetting( $id, $label, $type, $default=null )
		{
			$section = $this->_sections[count($this->_sections) - 1];

			$this->_settingsCounter++;

			$setting = array(
				'id'        => $id,
				'label'     => $label,
				'type'      => $type,
				'default'   => $default,
				'priority'  => $this->_settingsCounter,
				'key'		=> $section['id'] . $id . '_' . $this->_settingsCounter,
				'transport' => 'postMessage',
				'selectors' => array()
			);

			$this->_sections[count($this->_sections) - 1]['settings'][] = $setting;

			return $setting;
		}

		/**
		 * Add a CSS selector to a setting.
		 *
		 * @param string $selector The CSS selector.
		 * @param string $rule The CSS rule.
		 * @return void
		 */
		public function addSelector( $selector, $rule )
		{
			$sec = count($this->_sections) - 1;
			$set = count($this->_sections[$sec]['settings']) - 1;

			$this->_sections[$sec]['settings'][$set]['selectors'][$selector][] = $rule;
		}

		/**
		 * Append the scripts needed by the customizer.
		 *
		 * @param WP_Customize $wp_customize The theme customization object.
		 * @return void
		 */
		private function appendCustomizerScripts( $wp_customize )
		{
			if( $wp_customize->is_preview() ) {
				if( is_admin() ) {
					add_action( 'customize_controls_print_scripts', array($this, 'printFonts'), 999 );
				}
				else {
					add_action( 'wp_footer', array($this, 'printFonts'), 999 );
				}
			}
		}

		public function printFonts()
		{
			echo "<script type='text/javascript'>
				var fonts = '" . json_encode(thb_get_fonts()) . "';
			</script>";
			echo "<script type='text/javascript' src='" . THB_ADMIN_JS_URL . "/admin-customizer.js" . "'></script>";

			foreach( $this->_sections as $section ) {
				foreach( $section['settings'] as $setting ) {
					echo "<style type='text/css' id='tempstyle_" . $setting['key'] . "'></style>";
				}
			}

			if( !is_admin() ) {
				$this->renderPostMessage();
			}
		}

		private function renderPostMessage()
		{
			echo "<script type='text/javascript'>"; ?>

			<?php
			foreach( $this->_sections as $section ) {
				foreach( $section['settings'] as $setting ) {
					?>
					wp.customize( "<?php echo $setting['key']; ?>", function( value ) {
						var selectors = {},
							mixins = [],
							tempstyle = jQuery("#tempstyle_" + '<?php echo $setting['key']; ?>');

						<?php $i=0; foreach( $setting['selectors'] as $selector => $rule ) : ?>
							<?php
								$selector = str_replace("\n", "", $selector);
							?>
							value.bind(function(to) {
								if( '<?php echo $i; ?>' == '0' ) {
									tempstyle.html('');
								}

								<?php if( $rule[0] == 'font-family' ) : ?>
									var font = getFont(to),
										font_imports = jQuery("#tempstyle_fontimports"),
										importer = '@import url("http://fonts.googleapis.com/css?family=' + to + ':' + font.variants + '");';

									if( font.type === 'google' && tempstyle.text().indexOf(importer) === -1 ) {
										tempstyle.prepend(importer);
									}
								<?php endif; ?>

								<?php if( thb_text_startsWith($rule[0], 'mixin-') ) : ?>
									<?php $mixin = str_replace('mixin-', '', $rule[0]); ?>
									tempstyle.append( thb_mixin('<?php echo $mixin; ?>', to, '<?php echo $selector; ?>') );
								<?php else : ?>
									var prefix_suffix = thb_css_prefix_suffix('<?php echo $rule[0]; ?>'),
										prefix = prefix_suffix[0],
										suffix = prefix_suffix[1],
										rule = thb_get_css_rule('<?php echo $rule[0]; ?>', to, prefix, suffix);

									tempstyle.append( thb_get_css_selector('<?php echo $selector; ?>', [rule]) );
								<?php endif; ?>
							}<?php echo thb_text_startsWith($rule[0], 'mixin-') ? '.debounce(200)' : ''; ?>);
						<?php $i++; endforeach; ?>
					} );
					<?php
				}
			}

			echo "</script>";
		}

		/**
		 * Register the theme customizations.
		 *
		 * @param WP_Customize $wp_customize The theme customization object.
		 * @return void
		 */
		public function register( $wp_customize )
		{
			foreach( $this->_sections as $section ) {
				$wp_customize->add_section($section['id'], array(
					'title'    => $section['label'],
					'priority' => $section['priority']
				));

				foreach( $section['settings'] as $setting ) {
					$value = get_theme_mod($setting['key']);

					$wp_customize->add_setting($setting['key'], array(
						'default'   => $setting['default'],
						'transport' => $setting['transport']
					));

					$wp_customize->add_control(new $setting['type']($wp_customize, $setting['key'], array(
						'label'    => $setting['label'],
						'section'  => $section['id'],
						'settings' => $setting['key'],
						'priority' => $setting['priority']
					)));
				}
			}

			$this->appendCustomizerScripts($wp_customize);
		}

		/**
		 * Include the fonts in the generated stylesheet.
		 *
		 * @return void
		 */
		private function importFonts()
		{
			$imported_fonts = array(
				'google' => array(),
				'custom' => array()
			);
			$google_fonts = array();
			$fonts = thb_get_fonts();
			$current_font = '';
			$current_font_type = '';

			foreach( $this->_sections as $section ) {
				foreach( $section['settings'] as $setting ) {
					if( $setting['type'] === 'THB_FontFamily_Control' ) {
						$value = get_theme_mod($setting['key']);

						if( empty($value) ) {
							break;
						}

						foreach( $fonts as $style => $families ) {
							foreach( $families as $css => $data ) {
								if( $css == $value ) {
									$current_font = $value;
									$current_font_type = $data['type'];
									$current_font_folder = isset($data['folder']) ? $data['folder'] : '';

									$imported_fonts[$data['type']][$value]['folder'] = $current_font_folder;

									if( !isset($imported_fonts[$data['type']][$value]['variants']) ) {
										$imported_fonts[$data['type']][$value]['variants'] = array();
									}
								}
							}
						}
					}
					else if( $setting['type'] === 'THB_TextVariant_Control' ) {
						$value = get_theme_mod($setting['key']);

						if( empty($value) ) {
							break;
						}

						if( !in_array($value, $imported_fonts[$current_font_type][$current_font]['variants']) && !empty($value) ) {
							$imported_fonts[$current_font_type][$current_font]['variants'][] = $value;
						}
					}
				}
			}

			$upload_dir = wp_upload_dir();
			global $wp_customize;

			foreach( $imported_fonts as $type => $type_fonts ) {
				foreach( $type_fonts as $font => $data ) {
					if( $type == 'google' ) {
						if( isset($wp_customize) ) {
							foreach( $fonts as $cl => $fn ) {
								foreach( $fn as $f => $d ) {
									if( $f == $font ) {
										$google_fonts[] = $font . ':' . $d['variants'];
									}
								}
							}
						}
						else {
							$google_fonts[] = $font . ':' . implode(',', $data['variants']);
						}
					}
					else if( $type == 'custom' ) {
						echo "@import url(" . $upload_dir['baseurl'] . "/fonts/" . $data['folder'] . "/stylesheet.css); ";
					}
				}
			}

			if( !empty($google_fonts) ) {
				$google_fonts = implode('|', $google_fonts);
				echo "@import url(http://fonts.googleapis.com/css?family={$google_fonts}); ";
			}
		}

		/**
		 * Print a well formed CSS stylesheet based on the registered settings.
		 *
		 * @param boolean $hideTag True to hide the <style> tag.
		 * @return void
		 */
		public function render( $hideTag=false )
		{
			if( ! $hideTag ) {
				thb_css_start('thb-style-customizer');
			}

			$this->importFonts();
			$style_rules = array();
			$style_mixins = array();

			foreach( $this->_sections as $section ) {
				foreach( $section['settings'] as $setting ) {
					$value = get_theme_mod($setting['key']);

					if( empty($value) ) {
						$value = $setting['default'];
					}

					foreach( $setting['selectors'] as $selector => $rules ) {
						if( !isset($style_rules[$selector]) ) {
							$style_rules[$selector] = array();
						}

						foreach( $rules as $rule ) {
							if( thb_text_startsWith($rule, 'mixin-') ) {
								$mixin = str_replace('mixin-', '', $rule);
								if( function_exists($mixin) ) {
									$style_mixins[] = call_user_func($mixin, $value, $selector);
								}
							}
							else {
								list( $prefix, $suffix ) = thb_css_prefix_suffix($rule);
								$style_rules[$selector][] = thb_get_css_rule($rule, $value, $prefix, $suffix);
							}
						}
					}
				}
			}

			foreach( $style_rules as $selector => $rules ) {
				thb_css_selector($selector, $rules);
			}

			foreach( $style_mixins as $mixin ) {
				echo $mixin;
			}

			ksort($this->additionalStyles);

			foreach( $this->additionalStyles as $style ) {
				if( function_exists($style) ) {
					echo ' ' . call_user_func($style);
				}
			}

			if( ! $hideTag ) {
				thb_css_end();
			}
		}

	}
}