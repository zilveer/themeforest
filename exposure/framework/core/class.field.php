<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Field class.
 *
 * This class is entitled to manage the option/meta field types.
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
if( !class_exists('THB_Field') ) {
	class THB_Field {

		/**
		 * The field CSS classes.
		 *
		 * @var array
		 */
		protected $_classes = array();

		/**
		 * The field data.
		 *
		 * @var array
		 **/
		protected $_data = array();

		/**
		 * The field default value.
		 *
		 * @var mixed
		 **/
		protected $_default = null;

		/**
		 * Dynamic default option callback.
		 *
		 * @var callable
		 */
		protected $dynamicDefault = null;

		/**
		 * True if the field should be duplicable.
		 *
		 * @var boolean
		 **/
		protected $_duplicable = false;

		/**
		 * The field help text.
		 *
		 * @var string
		 **/
		protected $_help = '';

		/**
		 * The field static option.
		 *
		 * @var string
		 */
		protected $_staticOption = null;

		/**
		 * The field label.
		 *
		 * @var string
		 **/
		protected $_label;

		/**
		 * The field meta data.
		 *
		 * @var array
		 **/
		protected $_meta = array( 'subtemplate' => '', 'uniqid' => '' );

		/**
		 * The field name.
		 *
		 * @var string
		 **/
		protected $_name;

		/**
		 * The field static value.
		 *
		 * @var string
		 */
		protected $_staticValue = null;

		/**
		 * The field subkeys.
		 *
		 * @var array
		 **/
		protected $_subKeys = array();

		/**
		 * The field template.
		 *
		 * @var string
		 **/
		protected $_template = '';

		/**
		 * True if the path to the field template has been specified.
		 *
		 * @var boolean
		 */
		protected $_specificTemplatePath = false;

		/**
		 * Constructor
		 *
		 * @param string $name The field name.
		 * @param string $template The field template.
		 **/
		public function __construct( $name, $template )
		{
			$this->_name = $name;
			$this->_template = $template;

			if( thb_text_contains( '/', $this->_template ) ) {
				$this->_specificTemplatePath = true;
			}

			$this->reset();
		}

		/**
		 * Add a CSS class to the field.
		 *
		 * @param string $class The CSS class.
		 * @return void
		 */
		public function addClass( $class )
		{
			$this->_classes[] = $class;
		}

		/**
		 * Calculate the field name.
		 *
		 * @param string $field_name The field name.
		 * @param string $subKey The field subkey.
		 * @return string
		 */
		protected function calculateFieldName( $field_name, $subKey=null )
		{
			if( $subKey ) {
				$field_name .= '[' . $subKey . ']';
			}

			if( $this->isDuplicable() ) {
				$field_name .= '[]';
			}

			return $field_name;
		}

		/**
		 * Get the field data.
		 *
		 * @return string
		 */
		public function getData()
		{
			return $this->_data;
		}

		/**
		 * Get the field default value.
		 *
		 * @return mixed
		 */
		public function getDefault()
		{
			return $this->_default;
		}

		/**
		 * Get the field help text.
		 *
		 * @return string
		 */
		public function getHelp()
		{
			return $this->_help;
		}

		/**
		 * Get the field name.
		 *
		 * @return string
		 */
		public function getName()
		{
			return $this->_name;
		}

		/**
		 * Get the field subkeys.
		 *
		 * @return array
		 */
		public function getSubkeys()
		{
			return $this->_subKeys;
		}

		/**
		 * Get the field value.
		 *
		 * @return array
		 */
		public function getValue()
		{
			return $this->_data;
		}

		/**
		 * Check if the field is complex.
		 *
		 * @return boolean
		 */
		public function isComplex()
		{
			return !empty($this->_subKeys);
		}

		/**
		 * Check if the field is duplicable.
		 *
		 * @return boolean
		 */
		public function isDuplicable()
		{
			return $this->_duplicable;
		}

		/**
		 * Pre-render the field.
		 *
		 * @return void
		 */
		protected function preRender() {
			if( !empty($this->_staticOption) ) {
				$this->setValue( get_option($this->_staticOption) );
			}
		}

		/**
		 * Pre-setValue the field.
		 *
		 * @return void
		 */
		protected function preSetValue()
		{
			if( !empty($this->dynamicDefault) && is_callable($this->dynamicDefault[0]) ) {
				$option = call_user_func($this->dynamicDefault[0], $this->dynamicDefault[1]);
				$this->setDefault($option);
			}
		}

		/**
		 * Set the field dynamic default option
		 *
		 * @param array $callback The select callback.
		 * @return void
		 */
		public function setDynamicDefault( $callback, $param='' )
		{
			$this->dynamicDefault = array($callback, $param);
		}

		/**
		 * Render the field.
		 *
		 * @return void
		 */
		public function render()
		{
			$this->preRender();

			if( empty($this->_data) ) {
				wp_die( 'Empty field data.' );
			}

			$field_name = $this->calculateFieldName($this->_name);

			$field_label = new THB_TemplateLoader('admin/fields/label', array(
				'label_text' => $this->_label,
				'label_for' => $field_name
			));

			if( empty($this->_label) ) {
				$this->addClass('no-label');
			}

			if( $this->isComplex() ) {
				$this->addClass('complex');
			}

			$field_help = new THB_TemplateLoader('admin/fields/help', array(
				'help_text' => $this->_help
			));

			// Optionally load a subtemplate
			$field_template = $this->_template;
			if( !empty($this->_meta['subtemplate']) ) {
				$field_template .= '_' . $this->_meta['subtemplate'];
			}

			if( ! $this->_specificTemplatePath ) {
				$field_template_class = $this->_template;
				$field_content = new THB_TemplateLoader("admin/fields/field_{$field_template}", array(
					'field_name' => $field_name,
					'field' => $this
				) + $this->_data);
			}
			else {
				$field_template_class = basename($field_template);
				$field_content = new THB_Template($field_template, array(
					'field_name' => $field_name,
					'field' => $this
				) + $this->_data);
			}

			$field_container = new THB_TemplateLoader('admin/fields/field', array(
				'field_template' => $this->_template,
				'field_template_class' => $field_template_class,
				'field_name'     => $this->_name,
				'field_label'    => $field_label->render(true),
				'field_help'     => $field_help->render(true),
				'field_content'  => $field_content->render(true),
				'is_duplicable'  => $this->isDuplicable(),
				'field_class'	 => implode(' ', $this->_classes)
			) + $this->_meta);

			$field_container->render();
		}

		/**
		 * Reset the field value.
		 *
		 * @return void
		 */
		public function reset()
		{
			$this->setValue(null);
		}

		/**
		 * Set the field default value.
		 *
		 * @param mixed $default The default value of the field.
		 * @return void
		 */
		public function setDefault( $default )
		{
			$this->_default = $default;
		}

		/**
		 * Set the field to be duplicable.
		 *
		 * @return void
		 */
		public function setDuplicable()
		{
			$this->_duplicable = true;
		}

		/**
		 * Set a value for the field.
		 *
		 * @param string $key
		 * @param mixed $value
		 * @return void
		 */
		public function setFieldValue( $key, $value )
		{
			if( is_array($value) ) {
				foreach( $value as $k => $v ) {
					$value[$k] = thb_text_toForm($v);
				}
				$this->_data[$key] = $value;
			}
			else {
				$this->_data[$key] = thb_text_toForm($value);
			}
		}

		/**
		 * Set a help text for the field.
		 *
		 * @param string $help
		 */
		public function setHelp( $help='' )
		{
			$this->_help = $help;
		}

		/**
		 * Set a label for the field.
		 *
		 * @param string $label
		 */
		public function setLabel( $label='' )
		{
			$this->_label = $label;
		}

		/**
		 * Set the meta data for the field.
		 *
		 * @param array $meta The meta data.
		 */
		public function setMeta( $meta )
		{
			$this->_meta = $meta;
		}

		/**
		 * Set the meta data key for the field.
		 *
		 * @param string $key The meta data key.
		 * @param string $value The meta data value.
		 */
		public function setMetaKey( $key, $value )
		{
			$this->_meta[$key] = $value;
		}

		/**
		 * Set a the field to be in a post page context.
		 *
		 * @return void
		 */
		public function setPostPage()
		{
			$this->_isPostPage = true;
		}

		/**
		 * Set a the field to handle a static option.
		 *
		 * @return void
		 */
		public function setStaticOption( $option )
		{
			$this->_staticOption = $option;
		}

		/**
		 * Set a value for the field.
		 *
		 * @param mixed $value
		 * @return void
		 */
		public function setValue( $value )
		{
			$this->preSetValue();

			if( $value === null || $value === false ) {
				if( $this->getDefault() != null ) {
					$value = $this->getDefault();
				}
			}

			if( $this->isComplex() ) {
				foreach( $this->_subKeys as $subKey ) {
					$this->setFieldValue('field_name_' . $subKey, $this->calculateFieldName($this->_name, $subKey));

					if( empty($value) || !isset($value[$subKey]) ) {
						$this->setFieldValue('field_value_' . $subKey, '');
					}
					else {
						$this->setFieldValue('field_value_' . $subKey, $value[$subKey]);
					}
				}
			}
			else {
				if( $value === null ) {
					$value = '';
				}

				$this->setFieldValue('field_name', $this->calculateFieldName($this->_name));
				$this->setFieldValue('field_value', $value);
			}
		}

	}
}

/**
 * Get a field template (AJAX call)
 *
 * @return string
 */
if( !function_exists('thb_get_field_template') ) {
	function thb_get_field_template() {
		$theme = thb_theme();

		if( isset($_POST['posttype']) ) {
			$postType = $theme->getPostType($_POST['posttype']);
			$metabox = $postType->getMetabox($_POST['metabox']);
			$container = $metabox->getContainer($_POST['container']);
			$field = $container->getField();
		}
		else {
			$page = $theme->getAdmin()->getPage($_POST['page']);
			$tab = $page->getTab($_POST['tab']);
			$container = $tab->getContainer($_POST['container']);
			$field = $container->getField();
		}

		$field->reset();

		if( isset($_POST['subtemplate']) && !empty($_POST['subtemplate']) ) {
			$field->setMetaKey('subtemplate', $_POST['subtemplate']);
		}

		$field->render();
		die();
	}
}