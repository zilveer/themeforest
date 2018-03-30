<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

if( ! class_exists( 'THB_PhotogalleryBlock' ) && function_exists( 'thb_builder' ) ) {
	/**
	 * Builder blog block.
	 */
	class THB_PhotogalleryBlock extends THB_BuilderBlock {

		/**
		 * Constructor
		 *
		 * @param string $title The block title.
		 **/
		public function __construct()
		{
			parent::__construct(
				'thb_photogallery',
				__( 'Photogallery', 'thb_text_domain' ),
				thb_get_module_template_path( 'backpack/photogallery', 'block_thb_photogallery' ),
				thb_get_module_original_template_path( 'backpack/photogallery', 'block_thb_photogallery' )
			);

			$this->setDescription( __( 'A collection of images in a grid format.', 'thb_text_domain' ) );

			$this->buildModals();
		}

		/**
		 * Build the block modals.
		 */
		private function buildModals()
		{
			$grid_columns = thb_config( 'backpack/photogallery', 'builder_block_columns' );

			$thb_modal = new THB_Modal( $this->getTitle(), $this->getSlug() );
				$thb_modal_container = $thb_modal->createContainer( '', $this->getSlug() . '_container' );

					$thb_field = new THB_TextField( 'title' );
					$thb_field->setLabel( __( 'Title', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

				$thb_modal_tab = $thb_modal->createTab( __('Layout', 'thb_text_domain'), 'photogallery_layout' );

					$thb_modal_container = $thb_modal_tab->createContainer( '', $this->getSlug() . '_layout_container' );

						$thb_field = new THB_SelectField( 'layout' );
						$thb_field->setLabel( __( 'Layout', 'thb_text_domain' ) );
						$thb_field->setOptions( array(
							'grid' => __( 'Grid', 'thb_text_domain' ),
							'mosaic' => __( 'Mosaic', 'thb_text_domain' )
						) );
						$thb_modal_container->addField( $thb_field );

					$thb_modal_container = $thb_modal_tab->createContainer( __( 'Grid options', 'thb_text_domain' ), $this->getSlug() . '_layout_grid_container' );
						thb_grid_layout_add_fields( $thb_modal_container, $grid_columns );

					$thb_modal_container = $thb_modal_tab->createContainer( __( 'Mosaic options', 'thb_text_domain' ), $this->getSlug() . '_layout_mosaic_container' );
						$thb_field = new THB_TextField( 'mosaic_module' );
						$thb_field->setLabel( __( 'Mosaic module', 'thb_text_domain' ) );
						$thb_field->setHelp( __( 'E.g. 231 will produce three rows, the 1st with two images, the 2nd with three, etc.', 'thb_text_domain' ) );
						$thb_modal_container->addField( $thb_field );

						$thb_field = new THB_NumberField( 'mosaic_gutter' );
						$thb_field->setLabel( __( 'Mosaic gutter', 'thb_text_domain' ) );
						$thb_field->setHelp( __( 'Space between images, in pixels.', 'thb_text_domain' ) );
						$thb_field->setMin( 0 );
						$thb_modal_container->addField( $thb_field );

						$thb_field = new THB_SelectField( 'mosaic_image_size' );
						$thb_field->setLabel( __( 'Image size', 'thb_text_domain' ) );
						$thb_field->setOptions( array(
							'large'     => __( 'Large', 'thb_text_domain' ),
							'medium'    => __( 'Medium', 'thb_text_domain' ),
							'thumbnail' => __( 'Small', 'thb_text_domain' ),
							'full'      => __( 'Full', 'thb_text_domain' ),
						) );
						$thb_modal_container->addField( $thb_field );

				$thb_modal_tab = $thb_modal->createTab( __('Photos', 'thb_text_domain'), 'photogallery_slides' );
					$thb_modal_container = $thb_modal_tab->createContainer( '', 'photogallery_slides_config' );

					$thb_field = new THB_CheckboxField( 'force_disable_lightbox' );
						$thb_field->setLabel( __( 'Force disable lightbox', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_modal_container = $thb_modal_tab->createDuplicableContainer( __('Photos', 'thb_text_domain'), 'photogallery_slides' );
					$thb_modal_container->setSortable();

						$thb_modal_container->addControl( __('Add photo', 'thb_text_domain'), 'add_image', '', array(
							'action' => 'thb_add_multiple_slides',
							'title' => __('Add photos', 'thb_text_domain')
						) );

						$field = new THB_SlideField( 'photogallery_slide' );
						$field->setLabel( __('Slide', 'thb_text_domain') );
						$field->getModal( 'edit_slide_image' )->getContainer( 'edit_slide_image_container' )->removeField( 'class' );

						$thb_modal_container->setField($field);

			$this->addModal( $thb_modal );
		}

		/**
		 * The classes to be added to the block element on frontend.
		 *
		 * @param array $block_data
		 * @return array
		 */
		public function blockClasses( $block_data ) {
			$block_classes = array();

			$layout = thb_isset( $block_data, 'layout', 'grid' );
			$images_height = thb_isset( $block_data, 'grid_images_height', 'fixed' );

			if ( $layout == 'grid' && $images_height != 'fixed' ) {
				$block_classes[] = 'masonry';
			}

			if ( $layout == 'grid' ) {
				$block_classes[] = 'thb-grid-layout';
			}
			elseif ( $layout == 'mosaic' ) {
				$block_classes[] = 'thb-mosaic-layout';
			}

			return array_merge( $block_classes, parent::blockClasses( $block_data ) );
		}

	}

	thb_builder_instance()->addBlock( new THB_PhotogalleryBlock() );
}