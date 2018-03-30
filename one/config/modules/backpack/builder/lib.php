<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

if( ! class_exists( 'THB_Builder' ) ) {
	/**
	 * Builder object.
	 */
	class THB_Builder {

		/**
		 * The builder instance.
		 *
		 * @var THB_Builder
		 **/
		private static $_instance = null;

		/**
		 * Get the builder instance.
		 *
		 * @return THB_Builder
		 **/
		public static function getInstance()
		{
			if( self::$_instance == null ) {
				self::$_instance = new THB_Builder();
			}

			return self::$_instance;
		}

		/**
		 * The blocks.
		 *
		 * @var array
		 */
		protected $_blocks = null;

		/**
		 * Constructor
		 *
		 * @param string $title The fields container title.
		 * @param string $slug The fields container slug.
		 **/
		public function __construct()
		{
			$this->_blocks = new THB_List();

			add_action( 'admin_enqueue_scripts', array( $this, 'localizeBlocks' ) );
		}

		/**
		 * Localize the registered builder blocks.
		 */
		public function localizeBlocks()
		{
			wp_localize_script( 'jquery', 'thb_builder', array(
				'blocks' => thb_get_builder_blocks(),
			) );
		}

		/**
		 * Add a block to the builder interface.
		 *
		 * @param THB_BuilderBlock $block
		 */
		public function addBlock( THB_BuilderBlock $block )
		{
			$this->_blocks->insert( $block );
		}

		/**
		 * Get the defined builder blocks.
		 *
		 * @return THB_List
		 */
		public function getBlocks()
		{
			return $this->_blocks;
		}

		/**
		 * Get a defined builder block by its type.
		 *
		 * @return THB_BuilderBlock
		 */
		public function getBlock( $type )
		{
			foreach ( $this->getBlocks() as $block ) {
				if ( $block->getSlug() == $type ) {
					return $block;
				}
			}

			return false;
		}

	}
}

if( ! class_exists( 'THB_BuilderBlock' ) ) {
	/**
	 * Builder object.
	 */
	class THB_BuilderBlock {

		/**
		 * The block active state.
		 *
		 * @var boolean
		 */
		protected $_active = true;

		/**
		 * The block slug.
		 *
		 * @var string
		 */
		protected $_slug = '';

		/**
		 * The block title.
		 *
		 * @var string
		 */
		protected $_title = '';

		/**
		 * The block description.
		 *
		 * @var string
		 */
		protected $_description = '';

		/**
		 * The block template path.
		 *
		 * @var string
		 */
		protected $_template_path = '';

		/**
		 * The original block template path.
		 *
		 * @var string
		 */
		protected $_original_template_path = '';

		/**
		 * The block modals.
		 *
		 * @var array
		 */
		private $_modals = array();

		/**
		 * True if the block can be used as section title.
		 *
		 * @var boolean
		 */
		protected $_can_be_section_title = false;

		/**
		 * Constructor
		 *
		 * @param string $title The block title.
		 * @param string $slug The block slug.
		 * @param string $template_path The block template path.
		 * @param string $template_path The original block template path.
		 **/
		public function __construct( $slug, $title, $template_path, $original_template_path = false )
		{
			if( empty( $slug ) ) {
				wp_die( 'Empty block slug.' );
			}

			if( empty( $title ) ) {
				wp_die( 'Empty block title.' );
			}

			if( empty( $template_path ) ) {
				wp_die( 'Empty block template path.' );
			}

			$this->_slug = $slug;
			$this->_title = $title;
			$this->_template_path = $template_path;
			$this->_original_template_path = $this->_template_path;

			if ( $original_template_path !== false ) {
				$this->_original_template_path = $original_template_path;
			}
		}

		/**
		 * Get the block slug.
		 *
		 * @return string
		 */
		public function getSlug()
		{
			return $this->_slug;
		}

		/**
		 * Get the block title.
		 *
		 * @return string
		 */
		public function getTitle()
		{
			return $this->_title;
		}

		/**
		 * Get the block description.
		 *
		 * @return string
		 */
		public function getDescription()
		{
			return $this->_description;
		}

		/**
		 * Set the block description.
		 *
		 * @param string $description
		 */
		public function setDescription( $description )
		{
			$this->_description = $description;
		}

		/**
		 * Get the block template path.
		 *
		 * @param boolean $original
		 * @return string
		 */
		public function getTemplatePath( $original = false )
		{
			if ( ! $original ) {
				return $this->_template_path;
			}

			return $this->_original_template_path;
		}

		/**
		 * Add a modal for the block.
		 *
		 * @param THB_Modal $modal The modal object.
		 */
		protected function addModal( THB_Modal $modal )
		{
			$slug = $modal->getSlug();

			if ( ! in_array( $slug, $this->_modals ) ) {
				$this->_modals[] = $slug;

				$thb_modal_container = $modal->getContainer( $slug . '_container' );

				if ( $thb_modal_container ) {
					$thb_field = new THB_TextField( 'class' );
					$thb_field->setLabel( __( 'CSS class', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					if ( thb_config( 'backpack/builder', 'advanced_markup' ) && $this->_can_be_section_title ) {
						$thb_modal_advanced_tab = $modal->createTab( __( 'Advanced', 'thb_text_domain' ), $slug . '_tab_advanced' );
						$thb_modal_container = $thb_modal_advanced_tab->createContainer( '', $slug . '_tab_advanced_container' );

							$thb_field = new THB_CheckboxField( 'is_title' );
							$thb_field->setLabel( __( 'Is section title', 'thb_text_domain' ) );
							$thb_field->setHelp( __( "For SEO and good content hierarchy purposes, a block in each section can be identified as the section's title.", 'thb_text_domain' ) );
							$thb_modal_container->addField( $thb_field );
					}
				}

				thb_theme()->getAdmin()->addModal( $modal );
			}
		}

		/**
		 * The classes to be added to the block element on frontend.
		 *
		 * @param array $block_data
		 * @return array
		 */
		public function blockClasses( $block_data ) {
			$block_classes = array();

			if ( isset( $block_data['class'] ) ) {
				$block_classes[] = $block_data['class'];
			}

			$block_classes = apply_filters( 'thb_block_classes', $block_classes, $block_data, $this->getSlug() );

			return $block_classes;
		}

		/**
		 * Set the active status of a block.
		 *
		 * @param boolean $active
		 */
		public function setStatus( $active )
		{
			$this->_active = (bool) $active;
		}

		/**
		 * Check of the block is active.
		 *
		 * @return boolean
		 */
		public function isActive()
		{
			return $this->_active === true;
		}

		/**
		 * Set the status of the block to active.
		 */
		public function activate()
		{
			$this->setStatus( true );
		}

		/**
		 * Set the status of the block to not active.
		 */
		public function deactivate()
		{
			$this->setStatus( false );
		}

	}
}