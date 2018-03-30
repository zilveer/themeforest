<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Slide field class.
 *
 * This class is entitled to manage the option/meta slide field types.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Core\Fields
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2014, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 2.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
if( !class_exists('THB_SlideField') ) {
	class THB_SlideField extends THB_Field {

		/**
		 * True if the slide has caption associated.
		 *
		 * @var boolean
		 */
		protected $_caption = true;

		/**
		 * Constructor
		 *
		 * @param string $name The field name.
		 * @param string $key The slides key.
		 * @param integer $context The field context.
		 **/
		public function __construct( $name, $key = 'slide', $context = null )
		{
			parent::__construct( $name, $key, $context );

			$this->buildModals();
		}

		/**
		 * Build the slide field modals.
		 */
		private function buildModals()
		{
			// Image modal

			$thb_modal = new THB_Modal( __( 'Edit slide', 'thb_text_domain' ), $this->getName() . '_edit_slide_image' );

				$thb_modal_container = $thb_modal->createContainer( '', 'edit_slide_image_container' );

					$thb_field = new THB_TextareaField( 'caption' );
					$thb_field->setLabel( __( 'Caption', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_TextField( 'class' );
					$thb_field->setLabel( __( 'CSS class', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

			$this->addModal( $thb_modal );

			// Video modal

			$thb_modal = new THB_Modal( __( 'Edit slide', 'thb_text_domain' ), $this->getName() . '_edit_slide_video' );

				$thb_modal_container = $thb_modal->createContainer( '', 'edit_slide_video_container' );

					$thb_field = new THB_TextField( 'id' );
					$thb_field->setLabel( __( 'Video URL', 'thb_text_domain' ) );
					$thb_field->setHelp( __( 'You can specify multiple comma separated formats.', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_TextareaField( 'caption' );
					$thb_field->setLabel( __( 'Caption', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_CheckboxField( 'autoplay' );
					$thb_field->setLabel( __( 'Autoplay', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_CheckboxField( 'loop' );
					$thb_field->setLabel( __( 'Loop', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_CheckboxField( 'fit' );
					$thb_field->setLabel( __( 'Fit', 'thb_text_domain' ) );
					$thb_field->setHelp( __( 'Enable the auto fit mode: leaving this unchecked will result in a stretched video.', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_TextField( 'class' );
					$thb_field->setLabel( __( 'CSS class', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

			$this->addModal( $thb_modal );

			add_filter( 'thb_setup_slide', array( $this, 'setup' ), 10, 2 );
		}

		/**
		 * Setup the slide data.
		 *
		 * @param array $slide
		 * @param array $item
		 * @return array
		 */
		public function setup( $slide, $item )
		{
			$modal_slug = $slide['type'] == 'image' ? 'edit_slide_image' : 'edit_slide_video';
			$modal = $this->getModal( $modal_slug );

			foreach ( $modal->getTabs() as $tab ) {
				foreach ( $tab->getContainers() as $container ) {
					foreach ( $container->getFields() as $field ) {
						$slide[$field->getName()] = isset( $item['value'][$field->getName()] ) ? $item['value'][$field->getName()] : $field->getDefault();
					}
				}
			}

 			return $slide;
		}

		/**
		 * Check if there's support for captions in the slide.
		 *
		 * @return boolean
		 */
		public function supportCaptions()
		{
			return $this->_caption;
		}

		/**
		 * Disable support for captions in the slide.
		 *
		 * @return void
		 */
		public function disableCaptions()
		{
			$this->_caption = false;
		}

	}
}