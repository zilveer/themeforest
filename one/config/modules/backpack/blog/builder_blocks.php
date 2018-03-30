<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

if( ! class_exists( 'THB_BlogBlock' ) && function_exists( 'thb_builder' ) ) {
	/**
	 * Builder blog block.
	 */
	class THB_BlogBlock extends THB_BuilderBlock {

		/**
		 * Constructor
		 *
		 * @param string $title The block title.
		 **/
		public function __construct()
		{
			parent::__construct(
				'thb_blog',
				__( 'Blog', 'thb_text_domain' ),
				thb_get_module_template_path( 'backpack/blog', 'block_thb_blog' )
			);

			$this->setDescription( __( 'Load a blog loop, with different style variants.', 'thb_text_domain' ) );

			$this->buildModals();
		}

		/**
		 * Build the block modals.
		 */
		private function buildModals()
		{
			$thb_modal = new THB_Modal( $this->getTitle(), $this->getSlug() );
				$thb_modal_container = $thb_modal->createContainer( '', $this->getSlug() . '_container' );

					$thb_field = new THB_TextField( 'title' );
					$thb_field->setLabel( __( 'Title', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_SelectField( 'layout' );
					$thb_field->setLabel( __( 'Layout', 'thb_text_domain' ) );
					$thb_field->setOptions( thb_config('backpack/blog', 'builder_blog_layouts') );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_QueryFilterField( 'query_filter' );
					$thb_field->addClass('full');
					$thb_field->setTaxonomies( thb_get_post_type_taxonomies('post') );
					$thb_modal_container->addField( $thb_field );

				$thb_modal_container = $thb_modal->createContainer( __( 'Carousel', 'thb_text_domain' ), $this->getSlug() . '_carousel_container' );

					thb_carousel_options( $thb_modal_container );

			$this->addModal( $thb_modal );
		}

		/**
		 * The classes to be added to the block element on frontend.
		 *
		 * @param array $block_data
		 * @return array
		 */
		public function blockClasses( $block_data ) {
			$block_classes = array(
				$block_data['layout']
			);

			if ( ! empty( $block_data['carousel'] ) ) {
				$block_classes[] = 'thb-carousel-container';
			}

			return array_merge( $block_classes, parent::blockClasses( $block_data ) );
		}

	}

	thb_builder_instance()->addBlock( new THB_BlogBlock() );
}