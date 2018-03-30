<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Shortcode class.
 *
 * This class is entitled to manage a shortcode.
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
if( !class_exists('THB_Shortcode') ) {
	class THB_Shortcode {

		/**
		 * Instance number.
		 *
		 * @var integer
		 */
		public static $instance_number = 0;

		/**
		 * The shortcode attributes aliases.
		 *
		 * @var array
		 */
		protected $_attributesAliases = array(
			'num' => 'posts_per_page',
			'id' => array('p', 'page_id')
		);

		/**
		 * The shortcode class attributes.
		 *
		 * @var array
		 */
		protected $_classAttributes = array(
			'horizontal',
			'vertical',
			'first',
			'last',
			'open',
			'carousel',
			'left',
			'right',
			'center'
		);

		/**
		 * The shortcode default data.
		 */
		protected $_defaultData = array(
			'attributes' => array(),
			'class'      => array(),
			'loop'       => array()
		);

		/**
		 * The shortcode user data.
		 */
		protected $_userData = array(
			'attributes' => array(),
			'class'      => array(),
			'loop'       => array()
		);

		/**
		 * The shortcode data.
		 *
		 * @var array
		 */
		protected $_data = array();

		/**
		 * A function that will optionally add dynamic parameters to the
		 * loop query.
		 *
		 * @var callable
		 */
		protected $_dynamicLoopFunction = null;

		/**
		 * The shortcode example.
		 *
		 * @var string
		 */
		protected $_example = '';

		/**
		 * The shortcode label.
		 *
		 * @var string
		 */
		protected $_label = '';

		/**
		 * True if the shortcode contains a loop.
		 *
		 * @var boolean
		 */
		protected $_loopable = false;

		/**
		 * The shortcode module name.
		 *
		 * @var string
		 */
		protected $_module;

		/**
		 * The shortcode name.
		 *
		 * @var string
		 */
		protected $_name;

		/**
		 * The shortcode template path.
		 *
		 * @var string
		 */
		protected $_template;

		/**
		 * The shortcode type.
		 *
		 * @var string
		 */
		protected $_type = '';

		/**
		 * True if the shortcode is public and is added to TinyMCE.
		 *
		 * @var boolean
		 */
		protected $_public = true;

		/**
		 * Constructor.
		 *
		 * @param string $name The shortcode name.
		 * @param string $template The shortcode template path.
		 * @param string $module The shortcode module name.
		 */
		public function __construct( $name, $template=null, $module='' )
		{
			$this->_name = $name;
			$this->_module = $module;

			if( $template ) {
				$this->setTemplate($template);
			}

			$this->setType( __('General', 'thb_text_domain') );
		}

		/**
		 * Get the example of the shortcode.
		 *
		 * @return string
		 */
		public function getExample()
		{
			return $this->_example;
		}

		/**
		 * Get the name of the shortcode.
		 *
		 * @return string
		 */
		public function getName()
		{
			return $this->_name;
		}

		/**
		 * Get the label of the shortcode.
		 *
		 * @return string
		 */
		public function getLabel()
		{
			return $this->_label;
		}

		/**
		 * Get the type of the shortcode.
		 *
		 * @return string
		 */
		public function getType()
		{
			return $this->_type;
		}

		/**
		 * Get the shortcode attributes to be used in the related widget.
		 *
		 * @return array
		 */
		public function getWidgetAttributes()
		{
			$atts = array();

			foreach( $this->_defaultData as $key ) {
				$atts += $key;
			}

			return $atts;
		}

		/**
		 * Register the shortcode.
		 *
		 * @return void
		 */
		public function register()
		{
			add_shortcode( $this->_name, array($this, 'render') );
		}

		/**
		 * Render the shortcode.
		 *
		 * @param array $atts The shortcode provided attributes.
		 * @param string $content The shortcode enclosed content.
		 * @return string
		 */
		public function render( $atts=array(), $content='' )
		{
			if( empty($this->_template) ) {
				wp_die( 'Empty template path.' );
			}

			self::$instance_number++;

			if( empty($atts) ) {
				$atts = array();
			}

			$this->_userData['attributes'] = thb_array_asum($this->_defaultData['attributes'], $atts);

			$loopArgs = thb_array_asum( $this->_defaultData['loop'], $this->resolveAliases($this->_userData['attributes']) );

			if( $this->_dynamicLoopFunction ) {
				$loopArgs += call_user_func( $this->_dynamicLoopFunction );
			}

			foreach( $atts as $att ) {
				if( in_array($att, $this->_classAttributes) ) {
					$this->setUserClass($att);
				}
			}

			if( isset($atts['class']) && !empty($atts['class']) ) {
				$this->setUserClass($atts['class']);
			}

			$this->_data['class'] = array_merge($this->_defaultData['class'], $this->_userData['class']);
			$this->_data['content'] = $content;
			$this->_data['items'] = array();

			if( $this->_loopable ) {
				$this->_data['items'] = get_posts($loopArgs);
			}

			$template_data = $this->_userData['attributes'] + $this->_data + $loopArgs;

			if( !empty($this->_module) ) {
				$shortcode_output = thb_return_module_template_part($this->_module, $this->_template, $template_data);
			}
			else {
				$output = new THB_TemplateLoader( $this->_template, $template_data );
				$shortcode_output = $output->render(true);
			}

			$this->reset();

			return $shortcode_output;
		}

		/**
		 * Reset the shortcode.
		 *
		 * @return void
		 */
		private function reset()
		{
			$this->_data['items'] = array();
			$this->resetUserAttributes();
		}

		/**
		 * Reset the shortcode user data.
		 *
		 * @return void
		 */
		private function resetUserAttributes()
		{
			foreach( $this->_userData as $key => $value ) {
				$this->_userData[$key] = array();
			}
		}

		/**
		 * Resolve the shortcode attributes aliases.
		 *
		 * @param array $atts The attributes array.
		 * @return void
		 */
		private function resolveAliases( $atts=array() )
		{
			$aliased=array();

			foreach( (array) $atts as $k => $v ) {
				if( array_key_exists($k, $aliased) ) {
					continue;
				}

				if( array_key_exists($k, $this->_attributesAliases) ) {

					if( is_array($this->_attributesAliases[$k]) ) {
						$nk = $this->_attributesAliases[$k][0];

						foreach( $this->_attributesAliases[$k] as $tk ) {
							if( array_key_exists($tk, $this->_defaultData['loop']) ) {
								$nk = $tk;
								break;
							}
						}

						$aliased[$nk] = $v;
					}
					else {
						$aliased[$this->_attributesAliases[$k]] = $v;
					}

				}
				else {
					$aliased[$k] = $v;
				}
			}

			return $aliased;
		}

		/**
		 * Set a shortcode attributes.
		 *
		 * @param array $atts The attributes array.
		 * @return void
		 */
		public function setAttributes( array $atts )
		{
			$this->_defaultData['attributes'] = $atts;
		}

		/**
		 * Set a shortcode class.
		 *
		 * @param string $atts The class name.
		 * @return void
		 */
		public function setClass( $class )
		{
			$this->_defaultData['class'][] = $class;
		}

		/**
		 * Set a user-defined shortcode class.
		 *
		 * @param string $class The class name.
		 * @return void
		 */
		private function setUserClass( $class )
		{
			$this->_userData['class'][] = $class;
		}

		/**
		 * Set the shortcode example text.
		 *
		 * @param string $example The shortcode example text.
		 * @return void
		 */
		public function setExample( $example )
		{
			$this->_example = $example;
		}

		/**
		 * Set the shortcode label.
		 *
		 * @param string $label The shortcode label.
		 * @return void
		 */
		public function setLabel( $label )
		{
			$this->_label = $label;
		}

		/**
		 * Set a shortcode attributes for its loop.
		 *
		 * @param array $atts The attributes array.
		 * @return void
		 */
		public function setLoopAttributes( array $atts )
		{
			$this->_loopable = true;
			$this->_defaultData['loop'] = $atts;
		}

		public function setDynamicLoopAttributes( $callable )
		{
			$this->_dynamicLoopFunction = $callable;
		}

		/**
		 * Set the shortcode data.
		 *
		 * @param string $key The shorcode data key.
		 * @param string $value The shorcode data value.
		 * @return void
		 */
		public function setData( $key, $value )
		{
			$this->_data[$key] = $value;
		}

		/**
		 * Set the shortcode template.
		 *
		 * @param string $template The shorcode template path.
		 * @return void
		 */
		public function setTemplate( $template )
		{
			$this->_template = $template;
		}

		/**
		 * Set the shortcode type.
		 *
		 * @param string $type The shorcode type.
		 * @return void
		 */
		public function setType( $type )
		{
			$this->_type = $type;
		}

		/**
		 * Check if the shortcode is public.
		 *
		 * @return boolean
		 */
		public function isPublic()
		{
			return $this->_public;
		}

		/**
		 * Set the shortcode to be private.
		 *
		 * @return void
		 */
		public function setPrivate()
		{
			$this->_public = false;
		}

	}
}

/**
 * TinyMCE shortcodes interface.
 */
if( thb_system_is_development() ) {

	if( !function_exists('thb_tinymce_add_shortcodes_button') ) {
		function thb_tinymce_add_shortcodes_button() {
			if( current_user_can('edit_posts') && current_user_can('edit_pages') ) {
				add_filter( 'mce_external_plugins', 'thb_add_shortcodes_plugin' );
				add_filter( 'mce_buttons', 'thb_register_shortcodes_button' );
			}
		}
	}
	add_action( 'admin_init', 'thb_tinymce_add_shortcodes_button' );

	if( !function_exists('thb_add_shortcodes_plugin') ) {
		function thb_add_shortcodes_plugin( $plugin_array ) {
			$resource = thb_custom_resource('admin/shortcodes');
			$resource = str_replace('&amp;', '&', $resource);

			$plugin_array['shortcodes'] = $resource;
			return $plugin_array;
		}
	}

	if( !function_exists('thb_register_shortcodes_button') ) {
		function thb_register_shortcodes_button( $buttons ) {
			array_push($buttons, '|', "shortcodes");
			return $buttons;
		}
	}

}