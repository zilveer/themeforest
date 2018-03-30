<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Field class.
 *
 * This class is entitled to manage the option/meta field types.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Core
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2014, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 2.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
if( !class_exists('THB_Field') ) {
	class THB_Field {

		const Free         = -1;
		const THB_Option   = 0;
		const WP_Option    = 1;
		const THB_PostMeta = 2;

		/**
		 * The field context.
		 *
		 * @var integer
		 */
		protected $_context = self::THB_Option;

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
		 * The field index.
		 *
		 * @var integer
		 **/
		protected $_index = 0;

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
		 * The field modal.
		 *
		 * @var THB_Modal
		 **/
		protected $_modals = array();

		/**
		 * The field module.
		 *
		 * @var string
		 **/
		protected $_module = false;

		/**
		 * Constructor
		 *
		 * @param string $name The field name.
		 * @param string $template The field template.
		 * @param integer $context The field context.
		 **/
		public function __construct( $name, $template, $context = null )
		{
			$this->_name = $name;
			$this->_template = $template;

			if ( $context ) {
				$this->setContext( $context );
			}

			$this->reset();
		}

		/**
		 * Add a CSS class to the field.
		 *
		 * @param string $class The CSS class.
		 */
		public function addClass( $class )
		{
			$this->_classes[] = $class;
		}

		/**
		 * Remove a CSS class from the field.
		 *
		 * @param string $class The CSS class.
		 */
		public function removeClass( $class )
		{
			for ( $i=0; $i<count($this->_classes); $i++ ) {
				if ( $this->_classes[$i] == $class ) {
					unset( $this->_classes[$i] );
				}
			}
		}

		/**
		 * Calculate the field name.
		 *
		 * @param string $field_name The field name.
		 * @param string $subKey The field subkey.
		 * @return string
		 */
		public function calculateFieldName( $field_name, $subKey = null )
		{
			if ( $this->isDuplicable() ) {
				$field_name .= '[' . $this->getIndex() . ']';
			}

			if ( $subKey ) {
				$field_name .= '[' . $subKey . ']';
			}
			else {
				if ( $this->isDuplicable() ) {
					$field_name .= '[value]';
				}
			}

			return $field_name;
		}

		/**
		 * Get the field context.
		 *
		 * @return integer
		 */
		public function getContext()
		{
			return $this->_context;
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
		 * Get the field index.
		 *
		 * @return integer
		 */
		public function getIndex()
		{
			return $this->_index;
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
		 * Get the field label.
		 *
		 * @return string
		 */
		public function getLabel()
		{
			return $this->_label;
		}

		/**
		 * Add a subkey to the field.
		 *
		 * @param string $subKey
		 */
		public function addSubkey( $subKey )
		{
			$this->_subKeys[] = $subKey;
		}

		/**
		 * Get the field subkeys.
		 *
		 * @return array
		 */
		public function getSubkeys()
		{
			$subkeys = array();

			foreach ( $this->getModals() as $modal ) {
				foreach ( $modal->getTabs() as $tab ) {
					foreach ( $tab->getContainers() as $container ) {
						foreach ( $container->getFields() as $f ) {
							if ( ! in_array( $f->getName(), $subkeys ) ) {
								$subkeys[] = $f->getName();
							}
						}
					}
				}
			}

			foreach ( $this->_subKeys as $key ) {
				if ( ! in_array( $key, $subkeys ) ) {
					$subkeys[] = $key;
				}
			}

			return $subkeys;
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
			$subkeys = $this->getSubkeys();

			return ! empty( $subkeys );
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
		 */
		protected function preRender()
		{
			$this->setNames();

			switch ( $this->getContext() ) {
				case THB_Field::WP_Option:
					$this->setValue( get_option( $this->getName() ) );
					break;
				case THB_Field::THB_Option:
					$this->setValue( thb_get_option( $this->getName() ) );
					break;
				case THB_Field::THB_PostMeta:
					global $post;
					$post_id = thb_input_get( 'post', 'absint', (int) absint( $post->ID ) );

					if( $this->isComplex() ) {
						$value = array();
						foreach( $this->getSubkeys() as $subKey ) {
							$value[$subKey] = thb_get_post_meta( $post_id, $this->getName() . '_' . $subKey );
						}
					}
					else {
						$value = thb_get_post_meta( $post_id, $this->getName() );
					}

					$this->setValue( $value );
					break;
				default:
					break;
			}
		}

		/**
		 * Set the field context.
		 *
		 * @param integer $context
		 */
		public function setContext( $context )
		{
			$this->_context = $context;
		}

		/**
		 * Set the field module.
		 *
		 * @param string $module
		 */
		public function setModule( $module )
		{
			$this->_module = $module;
		}

		/**
		 * Get the field module.
		 *
		 * @return string
		 */
		public function getModule()
		{
			return $this->_module;
		}

		/**
		 * Render the field.
		 */
		public function render()
		{
			$this->preRender();

			if ( empty( $this->_data ) ) {
				wp_die( 'Empty field data.' );
			}

			$field_name = $this->calculateFieldName( $this->_name );

			$field_label = new THB_Template( THB_TEMPLATES_DIR . '/admin/fields/label', array(
				'label_text' => $this->_label,
				'label_for' => $field_name
			) );

			if ( empty( $this->_label ) ) {
				$this->addClass( 'no-label' );
			}

			if ( $this->isComplex() ) {
				$this->addClass( 'complex' );
			}

			$field_help = new THB_Template( THB_TEMPLATES_DIR . '/admin/fields/help', array(
				'help_text' => $this->_help
			) );

			// Optionally load a subtemplate
			$field_template = $this->_template;
			if( ! empty( $this->_meta['subtemplate'] ) ) {
				$field_template .= '_' . $this->_meta['subtemplate'];
			}

			$field_content_args = array(
				'field_label' => $this->_label,
				'field' => $this
			) + $this->_data;

			if ( $this->getModule() !== false ) {
				$field_content = thb_get_module_template_part( $this->getModule(), "fields/field_{$field_template}", $field_content_args, false );
			}
			else {
				$field_content = thb_get_framework_template_part( "/admin/fields/field_{$field_template}", $field_content_args, false );
			}

			$field_container = new THB_Template( THB_TEMPLATES_DIR . '/admin/fields/field', array(
				'field' => $this,
				'field_template'       => $this->_template,
				'field_template_class' => $this->_template,
				'_field_name'          => $this->_name,
				'field_label'          => $field_label->render(true),
				'field_help'           => $field_help->render(true),
				'field_content'        => $field_content,
				'is_duplicable'        => $this->isDuplicable(),
				'field_class'          => implode(' ', $this->_classes)
			) + $this->_meta + $this->_data );

			$field_container->render();
		}

		/**
		 * Reset the field value.
		 */
		public function reset()
		{
			$this->setValue(null);
		}

		/**
		 * Add a modal for the field.
		 *
		 * @param THB_Modal $modal
		 */
		protected function addModal( $modal )
		{
			$slug = $modal->getSlug();

			if ( ! in_array( $slug, $this->_modals ) ) {
				$this->_modals[] = $slug;
				thb_theme()->getAdmin()->addModal( $modal );
			}

			return $modal;
		}

		/**
		 * Get the modal for the field.
		 *
		 * @return array
		 */
		public function getModals()
		{
			$modals = array();

			foreach ( $this->_modals as $slug ) {
				$modals[] = thb_theme()->getAdmin()->getModal( $slug );
			}

			return $modals;
		}

		/**
		 * Get a modal view of the admin interface.
		 *
		 * @param string $slug The modal slug.
		 * @return THB_Modal
		 */
		public function getModal( $slug )
		{
			$slug = $this->getName() . '_' . $slug;

			foreach( $this->getModals() as $modal ) {
				if( $modal->getSlug() == $slug ) {
					return $modal;
				}
			}

			return false;
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
		 * Set a name for the field.
		 *
		 * @param string $name
		 */
		public function setName( $name = '' )
		{
			$this->_name = $name;
		}

		/**
		 * Set an index for the field.
		 *
		 * @param integer $index
		 */
		public function setIndex( $index = 0 )
		{
			$this->_index = $index;
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
		 * Set the name values for the field.
		 */
		public function setNames()
		{
			$field_names = array();

			if( $this->isComplex() ) {
				foreach( $this->getSubkeys() as $subKey ) {
					$subKeyName = $this->calculateFieldName( $this->_name, $subKey );

					$this->setFieldValue( 'field_name_' . $subKey, $subKeyName );
					$field_names[$subKey] = $subKeyName;
				}

				$this->setFieldValue( 'field_basename', $this->calculateFieldName( $this->_name ) );
				$this->setFieldValue( 'field_name', $field_names );
			}
			else {
				$field_name = $this->calculateFieldName( $this->_name );
				$this->setFieldValue( 'field_name', $field_name );
			}
		}

		/**
		 * Set a value for the field.
		 *
		 * @param mixed $value
		 */
		public function setValue( $value )
		{
			$is_new_post = $this->_context == self::THB_PostMeta && thb_input_get( 'post', 'absint' ) === false;
			$is_value_not_set = $value === null || $value === false;

			if ( $is_new_post || $is_value_not_set ) {
				if( $this->getDefault() != null ) {
					$value = $this->getDefault();
				}
			}

			if( $this->isComplex() ) {
				$field_names = $field_values = array();

				foreach( $this->getSubkeys() as $subKey ) {
					$subkey_value = '';

					if ( isset( $value[$subKey] ) ) {
						$subkey_value = stripslashes( $value[$subKey] );
					}

					$this->setFieldValue( 'field_value_' . $subKey, $subkey_value );
					$field_values[$subKey] = $subkey_value;
				}

				$this->setFieldValue( 'field_value', $field_values );
			}
			else {
				if( $value === null ) {
					$value = '';
				}

				if ( $this->isDuplicable() ) {
					if ( is_array( $value ) && isset( $value['value'] ) ) {
						$value = $value['value'];
					}
				}

				$value = stripslashes( $value );

				$this->setFieldValue( 'field_value', $value );
			}
		}

		/**
		 * Pre-process the field data before saving.
		 *
		 * @param mixed $data The field POST data.
		 * @return mixed
		 */
		public function preProcessData( $data )
		{
			return thb_text_toDB( $data );
		}

		/**
		 * Save the field.
		 */
		public function save()
		{
			if ( ! isset( $_POST[$this->getName()] ) ) {
				return;
			}

			$data = $_POST[$this->getName()];

			switch ( $this->_context ) {
				case self::THB_Option:
					$this->saveOption( $data );
					do_action( 'thb_field_option_save_' . $this->getName(), $data );
					break;
				case self::THB_PostMeta:
					$this->savePostMeta( $data );
					do_action( 'thb_field_post_meta_save_' . $this->getName(), $data );
					break;
				case self::WP_Option:
					$this->saveWPOption( $data );
					do_action( 'thb_field_wp_option_save_' . $this->getName(), $data );
					break;
				default:
					break;
			}
		}

		/**
		 * Save a post meta field.
		 *
		 * @param array $data
		 */
		protected function savePostMeta( $data )
		{
			global $post_id;
			$meta = array();

			if( $this->isComplex() ) {
				foreach( $this->getSubkeys() as $subKey ) {
					if( isset( $data[$subKey] ) ) {
						$value = $this->preProcessData( $data[$subKey] );
						$meta[THB_META_KEY . $this->getName() . '_' . $subKey] = $value;
					}
				}
			}
			else {
				if( isset( $data ) ) {
					$value = $this->preProcessData( $data );
					$meta[THB_META_KEY . $this->getName()] = $value;
				}
			}

			foreach( $meta as $key => $value ) {
				update_post_meta( $post_id, $key, $value );
			}
		}

		/**
		 * Save an option field.
		 *
		 * @param array $data
		 */
		protected function saveOption( $data )
		{
			if( $this->isComplex() ) {
				$value = array();
				foreach( $this->getSubkeys() as $subKey ) {
					$v = $this->preProcessData( $data[$subKey] );
					$value[$subKey] = $v;
				}
			}
			else {
				$v = $this->preProcessData( $data );
				$value = thb_text_toDB( $v );
			}

			$value = apply_filters( 'thb_field_save_option', $value, $data, $this );

			thb_save_option( $this->getName(), $value );
		}

		/**
		 * Save a standard WordPress option field.
		 *
		 * @param array $data
		 */
		protected function saveWPOption( $data )
		{
			if( $this->isComplex() ) {
				$value = array();
				foreach( $this->getSubkeys() as $subKey ) {
					$v = $this->preProcessData( $data[$subKey] );
					$value[$subKey] = $v;
				}
			}
			else {
				$v = $this->preProcessData( $data[$subKey] );
				$value = thb_text_toDB( $v );
			}

			update_option( $this->getName(), $value );
		}

		/**
		 * Serialize the field keys.
		 *
		 * @return array|string
		 */
		public function serializeKeys()
		{
			$keys = array();

			if ( $this->isComplex() ) {
				$keys[$this->getName()] = array();

				foreach( $this->getSubkeys() as $subKey ) {
					$keys[$this->getName()][] = $subKey;
				}
			}
			else {
				$keys[] = $this->getName();
			}

			return $keys;
		}

	}
}