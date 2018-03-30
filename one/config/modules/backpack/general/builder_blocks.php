<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

if( ! class_exists( 'THB_TextBoxBlock' ) && function_exists( 'thb_builder' ) ) {
	/**
	 * Builder text box block.
	 */
	class THB_TextBoxBlock extends THB_BuilderBlock {

		/**
		 * Constructor
		 *
		 * @param string $title The block title.
		 **/
		public function __construct()
		{
			parent::__construct(
				'thb_text_box',
				__( 'Text box', 'thb_text_domain' ),
				thb_get_module_template_path( 'backpack/general', 'block_thb_text_box' )
			);

			$this->_can_be_section_title = true;

			$this->setDescription( __( 'A simple text block, with options concerning alignment, icon shown, and the ability to add a call to action button.', 'thb_text_domain' ) );

			$this->buildModals();
		}

		/**
		 * Build the block modals.
		 */
		private function buildModals()
		{
			$thb_modal = new THB_Modal( $this->getTitle(), $this->getSlug() );
				$thb_modal_tab = $thb_modal->createTab( __( 'Icon', 'thb_text_domain' ), $this->getSlug() . '_icon_tab' );
				$thb_modal_container = $thb_modal_tab->createContainer( __( 'Icon', 'thb_text_domain' ), $this->getSlug() . '_icon_container' );

					$thb_field = new THB_IconPickerField( 'icon' );
					$thb_field->setLabel( __( 'Symbol', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_SelectField( 'icon_styles' );
					$thb_field->setLabel( __( 'Style', 'thb_text_domain' ) );
					$thb_field->setOptions( thb_config('backpack/general', 'builder_text_box_icon_styles') );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_ColorField( 'icon_color' );
					$thb_field->setLabel( __( 'Color', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_SelectField( 'icon_size' );
						$thb_field->setLabel( __( 'Size', 'thb_text_domain' ) );
						$thb_field->setOptions(array(
							'icon-small'  => __('Small', 'thb_text_domain'),
							'icon-normal' => __('Normal', 'thb_text_domain'),
							'icon-medium' => __('Medium', 'thb_text_domain'),
							'icon-big'    => __('Big', 'thb_text_domain')
						));
					$thb_modal_container->addField($thb_field);

				$thb_modal_container = $thb_modal_tab->createContainer( __( 'Image', 'thb_text_domain' ), $this->getSlug() . '_image_container' );

					$thb_field = new THB_UploadField( 'icon_image' );
					$thb_field->setLabel( __( 'Image', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

				$thb_modal_container = $thb_modal->createContainer( '', $this->getSlug() . '_container' );
				$thb_modal->getTabs()->getFirst()->setTitle( __( 'Layout', 'thb_text_domain' ) );

					$box_layout = array(
						'layout-centered'  => thb_get_module_url('backpack/general') . '/i/layout-centered.png',
						'layout-left'      => thb_get_module_url('backpack/general') . '/i/layout-left.png',
						'layout-left-alt'  => thb_get_module_url('backpack/general') . '/i/layout-left-alt.png',
						'layout-right'     => thb_get_module_url('backpack/general') . '/i/layout-right.png',
						'layout-right-alt' => thb_get_module_url('backpack/general') . '/i/layout-right-alt.png',
						'layout-inline'    => thb_get_module_url('backpack/general') . '/i/layout-inline.png'
					);

					$box_layout = apply_filters( 'thb_text_box_layouts', $box_layout );

					$thb_field = new THB_GraphicRadioField( 'box_layout' );
						$thb_field->setLabel( __( 'Layout', 'thb_text_domain' ) );
						$thb_field->setOptions( $box_layout );
					$thb_modal_container->addField($thb_field);

					$thb_field = new THB_SelectField( 'layout_styles' );
					$thb_field->setLabel( __( 'Style', 'thb_text_domain' ) );
					$thb_field->setOptions( thb_config('backpack/general', 'builder_text_box_layout_styles') );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_SelectField( 'subtitle_position' );
						$thb_field->setLabel( __( 'Subtitle position', 'thb_text_domain' ) );
						$thb_field->setHelp( __( 'Position relative to the block\'s title.', 'thb_text_domain' ) );
						$thb_field->setOptions(array(
							'subtitle-bottom' => __('Bottom', 'thb_text_domain'),
							'subtitle-top'    => __('Top', 'thb_text_domain'),
						));
					$thb_modal_container->addField($thb_field);

				$thb_modal_tab = $thb_modal->createTab( __( 'Contents', 'thb_text_domain' ), $this->getSlug() . '_contents_tab' );
				$thb_modal_container = $thb_modal_tab->createContainer( '', $this->getSlug() . '_contents_container' );

					$thb_field = new THB_TextareaField( 'title' );
					$thb_field->setLabel( __( 'Title', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_TextareaField( 'subtitle' );
					$thb_field->setLabel( __( 'Subtitle', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_TextareaField( 'content' );
					$thb_field->setLabel( __( 'Content', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

				$thb_modal_tab = $thb_modal->createTab( __( 'Call to action', 'thb_text_domain' ), $this->getSlug() . '_action_tab' );
				$thb_modal_container = $thb_modal_tab->createContainer( __( 'Primary', 'thb_text_domain' ), $this->getSlug() . '_primary_action_container' );

					$thb_field = new THB_TextField( 'call_to_label_primary' );
					$thb_field->setLabel( __( 'Label', 'thb_text_domain' ) );
					$thb_field->setHelp( __('The call to action button label.', 'thb_text_domain'));
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_TextField( 'call_to_url_primary' );
					$thb_field->setLabel( __( 'URL', 'thb_text_domain' ) );
					$thb_field->setHelp( __('The call to action button URL. You can use a manual URL http:// or a post or page ID.', 'thb_text_domain'));
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_CheckboxField( 'call_to_url_primary_target_blank' );
					$thb_field->setLabel( __( 'Link opens in a new tab/window', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

				$thb_modal_container = $thb_modal_tab->createContainer( __( 'Secondary', 'thb_text_domain' ), $this->getSlug() . '_secondary_action_container' );

					$thb_field = new THB_TextField( 'call_to_label_secondary' );
					$thb_field->setLabel( __( 'Label', 'thb_text_domain' ) );
					$thb_field->setHelp( __('The call to action button label.', 'thb_text_domain'));
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_TextField( 'call_to_url_secondary' );
					$thb_field->setLabel( __( 'URL', 'thb_text_domain' ) );
					$thb_field->setHelp( __('The call to action button URL. You can use a manual URL http:// or a post or page ID.', 'thb_text_domain'));
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_CheckboxField( 'call_to_url_secondary_target_blank' );
					$thb_field->setLabel( __( 'Link opens in a new tab/window', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

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

			if ( isset( $block_data['icon_size'] ) ) {
				$block_classes[] = $block_data['icon_size'];
			}

			if ( isset( $block_data['box_layout'] ) ) {
				$block_classes[] = $block_data['box_layout'];
			}

			if ( isset( $block_data['icon_styles'] ) ) {
				$block_classes[] = $block_data['icon_styles'];
			}

			if ( isset( $block_data['layout_styles'] ) ) {
				$block_classes[] = $block_data['layout_styles'];
			}

			return array_merge( $block_classes, parent::blockClasses( $block_data ) );
		}

	}

	thb_builder_instance()->addBlock( new THB_TextBoxBlock() );
}

if( ! class_exists( 'THB_PageBlock' ) && function_exists( 'thb_builder' ) ) {
	/**
	 * Builder page block.
	 */
	class THB_PageBlock extends THB_BuilderBlock {

		/**
		 * Constructor
		 *
		 * @param string $title The block title.
		 **/
		public function __construct()
		{
			parent::__construct(
				'thb_page',
				__( 'Page/post', 'thb_text_domain' ),
				thb_get_module_template_path( 'backpack/general', 'block_thb_page' )
			);

			$this->setDescription( __( 'Load content (title, excerpt, featured image) from a page or post.', 'thb_text_domain' ) );

			$this->buildModals();
		}

		/**
		 * Build the block modals.
		 */
		private function buildModals()
		{
			$thb_modal = new THB_Modal( $this->getTitle(), $this->getSlug() );
				$thb_modal_container = $thb_modal->createContainer( '', $this->getSlug() . '_container' );

					$thb_field = new THB_TextField( 'page_id' );
					$thb_field->setLabel( __( 'ID', 'thb_text_domain' ) );
					$thb_field->setHelp( __( 'Enter a the page ID.', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_TextField( 'title' );
					$thb_field->setLabel( __( 'Title', 'thb_text_domain' ) );
					$thb_field->setHelp( __( 'Enter a new title that will override the original page title.', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_CheckboxField( 'show_excerpt' );
					$thb_field->setLabel( __( 'Show excerpt', 'thb_text_domain' ) );
					$thb_field->setHelp( __( 'Check if you want to show excerpt instead of the content.', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_CheckboxField( 'title_link' );
					$thb_field->setLabel( __( 'Link in title', 'thb_text_domain' ) );
					$thb_field->setHelp( __( 'Check if you want to enable the permalink to the page selected in the block title.', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_CheckboxField( 'thumbnail_link' );
					$thb_field->setLabel( __('Page/post thumbnail opens permalink', 'thb_text_domain') );
					$thb_field->setHelp( __('If checked, post/page featured images link directly to the post/page permalink.', 'thb_text_domain') );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_CheckboxField( 'show_featured_image' );
					$thb_field->setLabel( __( 'Show Featured image', 'thb_text_domain' ) );
					$thb_field->setHelp( __( 'Check if you want to show the featured image.', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_SelectField( 'featured_image_size' );
					$thb_field->setLabel( __( 'Featured image size', 'thb_text_domain' ) );
					$thb_field->setOptions( array(
						'full'      => __( 'Full', 'thb_text_domain' ),
						'large'     => __( 'Large', 'thb_text_domain' ),
						'medium'    => __( 'Medium', 'thb_text_domain' ),
						'thumbnail' => __( 'Small', 'thb_text_domain' )
					) );
					$thb_modal_container->addField( $thb_field );

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

			if ( absint( $block_data['page_id'] ) > 0 ) {
				$block_classes[] = 'thb-post-type-' . get_post_type( $block_data['page_id'] );
			}

			return array_merge( $block_classes, parent::blockClasses( $block_data ) );
		}

	}

	thb_builder_instance()->addBlock( new THB_PageBlock() );
}

if( ! class_exists( 'THB_ProgressBarBlock' ) && function_exists( 'thb_builder' ) ) {
	/**
	 * Builder progress bar block.
	 */
	class THB_ProgressBarBlock extends THB_BuilderBlock {

		/**
		 * Constructor
		 *
		 * @param string $title The block title.
		 **/
		public function __construct()
		{
			parent::__construct(
				'thb_progress_bar',
				__( 'Progress Bar', 'thb_text_domain' ),
				thb_get_module_template_path( 'backpack/general', 'block_thb_progress_bar' )
			);

			$this->setDescription( __( 'Display numeric values in multiple progress bars.', 'thb_text_domain' ) );

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

					$thb_field = new THB_TextareaField( 'progress_data' );
					$thb_field->setLabel( __( 'Data', 'thb_text_domain' ) );
					$thb_field->setHelp( __( 'Enter the progress data, one per line, pipe separated. E.g. <code>90|Design</code>', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_CheckboxField( 'progress_value' );
					$thb_field->setLabel( __( 'Show value', 'thb_text_domain' ) );
					$thb_field->setHelp( __( 'Check if you want to show the progress numeric value.', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_CheckboxField( 'progress_animate' );
					$thb_field->setLabel( __( 'Animated', 'thb_text_domain' ) );
					$thb_field->setHelp( __( 'Check if you want to enable the progress bar animation when the block is loaded.', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_SelectField( 'progress_styles' );
					$thb_field->setLabel( __( 'Styles', 'thb_text_domain' ) );
					$thb_field->setOptions( thb_config('backpack/general', 'builder_progress_bar_styles') );
					$thb_modal_container->addField( $thb_field );

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
				$block_data['progress_styles']
			);

			if ( $block_data['progress_animate'] == 1 ) {
				$block_classes[] = 'animate';
			}

			return array_merge( $block_classes, parent::blockClasses( $block_data ) );
		}

	}

	thb_builder_instance()->addBlock( new THB_ProgressBarBlock() );
}

if( ! class_exists( 'THB_RadialChartBlock' ) && function_exists( 'thb_builder' ) ) {
	/**
	 * Builder radial chart block.
	 */
	class THB_RadialChartBlock extends THB_BuilderBlock {

		/**
		 * Constructor
		 *
		 * @param string $title The block title.
		 **/
		public function __construct()
		{
			parent::__construct(
				'thb_radial_chart',
				__( 'Radial chart', 'thb_text_domain' ),
				thb_get_module_template_path( 'backpack/general', 'block_thb_radial_chart' )
			);

			$this->setDescription( __( 'Display numeric values in an animated radial chart.', 'thb_text_domain' ) );

			$this->buildModals();
		}

		/**
		 * Build the block modals.
		 */
		private function buildModals()
		{
			$thb_modal = new THB_Modal( $this->getTitle(), $this->getSlug() );
				$thb_modal_container = $thb_modal->createContainer( __( 'Icon', 'thb_text_domain' ), $this->getSlug() . '_icon_container' );

					$thb_field = new THB_IconPickerField( 'icon' );
					$thb_field->setLabel( __( 'Icon', 'thb_text_domain' ) );
					$thb_field->setHelp( __( 'The icon will replace the data value', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_SelectField( 'icon_size' );
					$thb_field->setLabel( __( 'Icon size', 'thb_text_domain' ) );
					$thb_field->setOptions(array(
							'small'  => __('Small', 'thb_text_domain'),
							'normal' => __('Normal', 'thb_text_domain'),
							'medium' => __('Medium', 'thb_text_domain'),
							'big'    => __('Big', 'thb_text_domain')
						));
					$thb_modal_container->addField( $thb_field );

					$thb_modal_container = $thb_modal->createContainer( __( 'Data & appearance', 'thb_text_domain' ), $this->getSlug() . '_container' );

					$thb_field = new THB_NumberField( 'radial_data' );
					$thb_field->setLabel( __( 'Value', 'thb_text_domain' ) );
					$thb_field->setHelp( __( 'Enter the radial chart value.', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_TextField( 'radial_unit' );
					$thb_field->setLabel( __( 'Unit', 'thb_text_domain' ) );
					$thb_field->setHelp( __( 'Enter the radial chart unit, e.g. %.', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_CheckboxField( 'hide_radial_data' );
					$thb_field->setLabel( __( 'Hide value and unit', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_TextareaField( 'radial_label' );
					$thb_field->setLabel( __( 'Label', 'thb_text_domain' ) );
					$thb_field->setHelp( __( 'Enter radial chart label', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_CheckboxField( 'disable_animation' );
					$thb_field->setLabel( __( 'Disable animation', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					// $thb_field = new THB_NumberField( 'radial_speed' );
					// $thb_field->setLabel( __( 'Speed', 'thb_text_domain' ) );
					// $thb_field->setStep( '0.5' );
					// $thb_field->setMin( '0' );
					// $thb_field->setHelp( __( 'Animation speed in seconds. Set to 0 to disable.', 'thb_text_domain' ) );
					// $thb_modal_container->addField( $thb_field );

					$thb_field = new THB_NumberField( 'radial_size' );
					$thb_field->setLabel( __( 'Size', 'thb_text_domain' ) );
					$thb_field->setHelp( __( 'Enter the radial size in pixel. It will always be a square.', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_NumberField( 'line_width' );
					$thb_field->setLabel( __( 'Line width', 'thb_text_domain' ) );
					$thb_field->setHelp( __( 'Enter the width of the radial chart line.', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_SelectField( 'line_cap' );
					$thb_field->setLabel( __( 'Line cap', 'thb_text_domain' ) );
					$thb_field->setHelp( __( 'The shape of the end of the radial chart line.', 'thb_text_domain' ) );
					$thb_field->setOptions( array(
						'round'  => __( 'Round', 'thb_text_domain' ),
						'square' => __( 'Square', 'thb_text_domain' )
					) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_ColorField( 'radial_color' );
					$thb_field->setLabel( __( 'Line color', 'thb_text_domain' ) );
					$thb_field->setHelp( __( 'The radial chart color. Please note that if left empty the theme highlight color will be used.', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_ColorField( 'track_color' );
					$thb_field->setLabel( __( 'Track line color', 'thb_text_domain' ) );
					$thb_field->setHelp( __( 'The radial chart track line color.', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

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
				'thb-icon-size-' . $block_data['icon_size']
			);

			return array_merge( $block_classes, parent::blockClasses( $block_data ) );
		}

	}

	thb_builder_instance()->addBlock( new THB_RadialChartBlock() );
}

if( ! class_exists( 'THB_CounterBlock' ) && function_exists( 'thb_builder' ) ) {
	/**
	 * Builder counter block.
	 */
	class THB_CounterBlock extends THB_BuilderBlock {

		/**
		 * Constructor
		 *
		 * @param string $title The block title.
		 **/
		public function __construct()
		{
			parent::__construct(
				'thb_counter',
				__( 'Counter', 'thb_text_domain' ),
				thb_get_module_template_path( 'backpack/general', 'block_thb_counter' )
			);

			$this->setDescription( __( 'Display an animated counter.', 'thb_text_domain' ) );

			$this->buildModals();
		}

		/**
		 * Build the block modals.
		 */
		private function buildModals()
		{
			$thb_modal = new THB_Modal( $this->getTitle(), $this->getSlug() );
				$thb_modal_container = $thb_modal->createContainer( __( 'Icon', 'thb_text_domain' ), $this->getSlug() . '_icon_container' );

				$thb_field = new THB_IconPickerField( 'icon' );
				$thb_field->setLabel( __( 'Icon', 'thb_text_domain' ) );
				$thb_modal_container->addField( $thb_field );

				$thb_field = new THB_ColorField( 'icon_color' );
				$thb_field->setLabel( __( 'Color', 'thb_text_domain' ) );
				$thb_field->setHelp( __( 'The icon color.', 'thb_text_domain' ) );
				$thb_modal_container->addField( $thb_field );

				$thb_field = new THB_SelectField( 'icon_alignment' );
					$thb_field->setLabel( __( 'Alignment', 'thb_text_domain' ) );
					$thb_field->setOptions(array(
						'thb-icon-left'  => __('Icon left', 'thb_text_domain'),
						'thb-icon-center' => __('Icon centered', 'thb_text_domain'),
						'thb-icon-right' => __('Icon right', 'thb_text_domain')
					));
				$thb_modal_container->addField($thb_field);

				$thb_field = new THB_SelectField( 'icon_size' );
					$thb_field->setLabel( __( 'Icon size', 'thb_text_domain' ) );
					$thb_field->setOptions(array(
						'small'  => __('Small', 'thb_text_domain'),
						'normal' => __('Normal', 'thb_text_domain'),
						'medium' => __('Medium', 'thb_text_domain'),
						'big'    => __('Big', 'thb_text_domain')
					));
				$thb_modal_container->addField($thb_field);

				$thb_modal_container = $thb_modal->createContainer( __( 'Data & appearance', 'thb_text_domain' ), $this->getSlug() . '_container' );

				$thb_field = new THB_TextField( 'counter_value' );
				$thb_field->setLabel( __( 'Value', 'thb_text_domain' ) );
				$thb_field->setHelp( __( 'Enter the counter final value.', 'thb_text_domain' ) );
				$thb_modal_container->addField( $thb_field );

				$thb_field = new THB_TextField( 'counter_unit_pre' );
				$thb_field->setLabel( __( 'Prefix', 'thb_text_domain' ) );
				$thb_field->setHelp( __( 'Can be used as unit. e.g. %', 'thb_text_domain' ) );
				$thb_modal_container->addField( $thb_field );

				$thb_field = new THB_TextField( 'counter_unit' );
				$thb_field->setLabel( __( 'Suffix', 'thb_text_domain' ) );
				$thb_field->setHelp( __( 'Can be used as unit. e.g. %', 'thb_text_domain' ) );
				$thb_modal_container->addField( $thb_field );

				$thb_field = new THB_TextareaField( 'counter_label' );
				$thb_field->setLabel( __( 'Label', 'thb_text_domain' ) );
				$thb_field->setHelp( __( 'Enter counter description', 'thb_text_domain' ) );
				$thb_modal_container->addField( $thb_field );

				$thb_field = new THB_SelectField( 'counter_styles' );
				$thb_field->setLabel( __( 'Styles', 'thb_text_domain' ) );
				$thb_field->setOptions( thb_config('backpack/general', 'builder_counter_styles') );
				$thb_modal_container->addField( $thb_field );

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
				$block_data['counter_styles'],
				$block_data['icon_alignment'],
				'thb-icon-size-' . $block_data['icon_size']
			);

			return array_merge( $block_classes, parent::blockClasses( $block_data ) );
		}

	}

	thb_builder_instance()->addBlock( new THB_CounterBlock() );
}

if( ! class_exists( 'THB_TabsBlock' ) && function_exists( 'thb_builder' ) ) {
	/**
	 * Builder page block.
	 */
	class THB_TabsBlock extends THB_BuilderBlock {

		/**
		 * Constructor
		 *
		 * @param string $title The block title.
		 **/
		public function __construct()
		{
			parent::__construct(
				'thb_tabs',
				__( 'Tabs', 'thb_text_domain' ),
				thb_get_module_template_path( 'backpack/general', 'block_thb_tabs' )
			);

			$this->setDescription( __( 'Display a set of tabs.', 'thb_text_domain' ) );

			$this->buildModals();
		}

		/**
		 * Build the block modals.
		 */
		private function buildModals()
		{
			$thb_modal = new THB_Modal( $this->getTitle(), $this->getSlug() );
				$thb_modal_container = $thb_modal->createDuplicableContainer( '', $this->getSlug() . '_duplicable_container' );
				$thb_modal_container->setSortable( true, true );

				$thb_modal_container->addControl( __( 'Add a tab', 'thb_text_domain' ) );

				$thb_field = new THB_TabField( 'tabs' );
				$thb_field->addClass( 'full' );
				$thb_modal_container->setField( $thb_field );

				$thb_modal_container = $thb_modal->createContainer( '', $this->getSlug() . '_container' );

				$thb_field = new THB_SelectField( 'tab_styles' );
				$thb_field->setLabel( __( 'Style', 'thb_text_domain' ) );
				$thb_field->setDefault( 'thb-tab-horizontal' );
				$thb_field->setOptions(array(
					'thb-tab-horizontal' => __('Horizontal', 'thb_text_domain'),
					'thb-tab-vertical'   => __('Vertical', 'thb_text_domain')
				));
				$thb_modal_container->addField( $thb_field );

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
				$block_data['tab_styles']
			);

			return array_merge( $block_classes, parent::blockClasses( $block_data ) );
		}

	}

	thb_builder_instance()->addBlock( new THB_TabsBlock() );
}

if( ! class_exists( 'THB_AccordionBlock' ) && function_exists( 'thb_builder' ) ) {
	/**
	 * Builder page block.
	 */
	class THB_AccordionBlock extends THB_BuilderBlock {

		/**
		 * Constructor
		 *
		 * @param string $title The block title.
		 **/
		public function __construct()
		{
			parent::__construct(
				'thb_accordion',
				__( 'Accordion', 'thb_text_domain' ),
				thb_get_module_template_path( 'backpack/general', 'block_thb_accordion' )
			);

			$this->setDescription( __( 'Display a set of toggles arranged in an accordion.', 'thb_text_domain' ) );

			$this->buildModals();
		}

		/**
		 * Build the block modals.
		 */
		private function buildModals()
		{
			$thb_modal = new THB_Modal( $this->getTitle(), $this->getSlug() );
				$thb_modal_container = $thb_modal->createDuplicableContainer( '', $this->getSlug() . '_duplicable_container' );
				$thb_modal_container->setSortable( true, true );

				$thb_modal_container->addControl( __( 'Add an accordion item', 'thb_text_domain' ) );

				$thb_field = new THB_TabField( 'accordion_items' );
				$thb_field->addClass( 'full' );
				$thb_modal_container->setField( $thb_field );

				$thb_modal_container = $thb_modal->createContainer( '', $this->getSlug() . '_container' );

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

			return array_merge( $block_classes, parent::blockClasses( $block_data ) );
		}

	}

	thb_builder_instance()->addBlock( new THB_AccordionBlock() );
}

if( ! class_exists( 'THB_ImageBlock' ) && function_exists( 'thb_builder' ) ) {
	/**
	 * Builder Image block.
	 */
	class THB_ImageBlock extends THB_BuilderBlock {

		/**
		 * Constructor
		 *
		 * @param string $title The block title.
		 **/
		public function __construct()
		{
			parent::__construct(
				'thb_image',
				__( 'Image', 'thb_text_domain' ),
				thb_get_module_template_path( 'backpack/general', 'block_thb_image' )
			);

			$this->setDescription( __( 'Display a column-wide image. You can put text beneath it, optionally load it in a popup.', 'thb_text_domain' ) );

			$this->buildModals();
		}

		/**
		 * Build the block modals.
		 */
		private function buildModals()
		{
			$thb_modal = new THB_Modal( $this->getTitle(), $this->getSlug() );
				$thb_modal_container = $thb_modal->createContainer( '', $this->getSlug() . '_container' );

					$thb_field = new THB_UploadField( 'image' );
					$thb_field->setLabel( __( 'Image', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_SelectField( 'image_size' );
					$thb_field->setLabel( __( 'Image size', 'thb_text_domain' ) );
					$thb_field->setOptions( array(
						'full'      => __( 'Full', 'thb_text_domain' ),
						'large'     => __( 'Large', 'thb_text_domain' ),
						'medium'    => __( 'Medium', 'thb_text_domain' ),
						'thumbnail' => __( 'Small', 'thb_text_domain' )
					) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_CheckboxField( 'open_lightbox' );
					$thb_field->setLabel( __( 'Open in lightbox', 'thb_text_domain' ) );

					if ( function_exists( 'thb_is_lightbox_enabled' ) && ! thb_is_lightbox_enabled() ) {
						$h = __( 'Remember to activate the lightbox functionality from the <a href="%s" target="_blank">theme options</a> panel.', 'thb_text_domain' );
						$lightbox_panel = thb_system_admin_url( 'thb-theme-options', array( 'tab' => 'lightbox' ) );
						$thb_field->setHelp( sprintf( $h, $lightbox_panel ) );
					}

					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_TextField( 'link_href' );
					$thb_field->setLabel( __( 'Image link URL', 'thb_text_domain' ) );
					$thb_field->setHelp( __( 'When not opening the image in a lightbox, you can specify a custom link. You can use a manual URL http:// or a post or page ID.', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_CheckboxField( 'link_target_blank' );
					$thb_field->setLabel( __( 'Open link in new tab', 'thb_text_domain' ) );
					$thb_field->setHelp( __( 'When specifying a custom link, you can make it open in a new browser tab.', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_TextField( 'title' );
					$thb_field->setLabel( __( 'Title', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_TextareaField( 'content' );
					$thb_field->setLabel( __( 'Content', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

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

			return array_merge( $block_classes, parent::blockClasses( $block_data ) );
		}

	}

	thb_builder_instance()->addBlock( new THB_ImageBlock() );
}

if( ! class_exists( 'THB_VideoBlock' ) && function_exists( 'thb_builder' ) ) {
	/**
	 * Builder Video block.
	 */
	class THB_VideoBlock extends THB_BuilderBlock {

		/**
		 * Constructor
		 *
		 * @param string $title The block title.
		 **/
		public function __construct()
		{
			parent::__construct(
				'thb_video',
				__( 'Video', 'thb_text_domain' ),
				thb_get_module_template_path( 'backpack/general', 'block_thb_video' )
			);

			$this->setDescription( __( 'Display a video. You can put text beneath it, optionally making it autoplay and loop.', 'thb_text_domain' ) );

			$this->buildModals();
		}

		/**
		 * Build the block modals.
		 */
		private function buildModals()
		{
			$thb_modal = new THB_Modal( $this->getTitle(), $this->getSlug() );
				$thb_modal_container = $thb_modal->createContainer( '', $this->getSlug() . '_container' );

					$thb_field = new THB_TextField( 'id' );
					$thb_field->setLabel( __( 'Video URL', 'thb_text_domain' ) );
					$thb_field->setHelp( __( 'You can specify multiple comma separated formats.', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_CheckboxField( 'autoplay' );
					$thb_field->setLabel( __( 'Autoplay', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_CheckboxField( 'loop' );
					$thb_field->setLabel( __( 'Loop', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_TextField( 'ratio' );
					$thb_field->setLabel( __( 'Ratio', 'thb_text_domain' ) );
					$thb_field->setHelp( __( 'Eg. 16:9. Defaults to 16:9.', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_TextField( 'title' );
					$thb_field->setLabel( __( 'Title', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_TextareaField( 'content' );
					$thb_field->setLabel( __( 'Content', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

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

			return array_merge( $block_classes, parent::blockClasses( $block_data ) );
		}

	}

	thb_builder_instance()->addBlock( new THB_VideoBlock() );
}

if( ! class_exists( 'THB_ShortcodeBlock' ) && function_exists( 'thb_builder' ) ) {
	/**
	 * Builder shortcode block.
	 */
	class THB_ShortcodeBlock extends THB_BuilderBlock {

		/**
		 * Constructor
		 *
		 * @param string $title The block title.
		 **/
		public function __construct()
		{
			parent::__construct(
				'thb_shortcode',
				__( 'Shortcode', 'thb_text_domain' ),
				thb_get_module_template_path( 'backpack/general', 'block_thb_shortcode' )
			);

			$this->setDescription( __( 'Display a shortcode.', 'thb_text_domain' ) );

			$this->buildModals();
		}

		/**
		 * Build the block modals.
		 */
		private function buildModals()
		{
			$thb_modal = new THB_Modal( $this->getTitle(), $this->getSlug() );
				$thb_modal_container = $thb_modal->createContainer( '', $this->getSlug() . '_container' );

					$thb_field = new THB_TextField( 'shortcode' );
					$thb_field->setLabel( __( 'The shortcode', 'thb_text_domain' ) );
					$thb_field->setHelp( __( 'Paste here your shortcode code.', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

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

			return array_merge( $block_classes, parent::blockClasses( $block_data ) );
		}

	}

	thb_builder_instance()->addBlock( new THB_ShortcodeBlock() );
}

if( ! class_exists( 'THB_WidgetAreaBlock' ) && function_exists( 'thb_builder' ) ) {
	/**
	 * Builder shortcode block.
	 */
	class THB_WidgetAreaBlock extends THB_BuilderBlock {

		/**
		 * Constructor
		 *
		 * @param string $title The block title.
		 **/
		public function __construct()
		{
			parent::__construct(
				'thb_widget_area',
				__( 'Widget area', 'thb_text_domain' ),
				thb_get_module_template_path( 'backpack/general', 'block_thb_widget_area' )
			);

			$this->setDescription( __( 'Display a widget area.', 'thb_text_domain' ) );

			$this->buildModals();
		}

		/**
		 * Build the block modals.
		 */
		private function buildModals()
		{
			$thb_modal = new THB_Modal( $this->getTitle(), $this->getSlug() );
				$thb_modal_container = $thb_modal->createContainer( '', $this->getSlug() . '_container' );

					$thb_field = new THB_SelectField( 'id' );
					$thb_field->setLabel( __( 'Widget area', 'thb_text_domain' ) );
					$thb_field->setOptions( thb_get_sidebars_for_select() );
					$thb_modal_container->addField( $thb_field );

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

			return array_merge( $block_classes, parent::blockClasses( $block_data ) );
		}

	}

	thb_builder_instance()->addBlock( new THB_WidgetAreaBlock() );
}

if( ! class_exists( 'THB_ListBlock' ) && function_exists( 'thb_builder' ) ) {
	/**
	 * Builder page block.
	 */
	class THB_ListBlock extends THB_BuilderBlock {

		/**
		 * Constructor
		 *
		 * @param string $title The block title.
		 **/
		public function __construct()
		{
			parent::__construct(
				'thb_list',
				__( 'List', 'thb_text_domain' ),
				thb_get_module_template_path( 'backpack/general', 'block_thb_list' )
			);

			$this->setDescription( __( 'Display a list.', 'thb_text_domain' ) );

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

				$thb_field = new THB_TextareaField( 'list' );
				$thb_field->setLabel( __( 'List items', 'thb_text_domain' ) );
				$thb_field->setHelp( __( 'One per line.', 'thb_text_domain' ) );
				$thb_modal_container->addField( $thb_field );

				$thb_field = new THB_IconPickerField( 'icon' );
				$thb_field->setLabel( __( 'Icon', 'thb_text_domain' ) );
				$thb_modal_container->addField( $thb_field );

				$thb_field = new THB_ColorField( 'icon_color' );
				$thb_field->setLabel( __( 'Color', 'thb_text_domain' ) );
				$thb_modal_container->addField( $thb_field );

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

			return array_merge( $block_classes, parent::blockClasses( $block_data ) );
		}

	}

	thb_builder_instance()->addBlock( new THB_ListBlock() );
}

if( ! class_exists( 'THB_DividerBlock' ) && function_exists( 'thb_builder' ) ) {
	/**
	 * Builder divider block.
	 */
	class THB_DividerBlock extends THB_BuilderBlock {

		/**
		 * Constructor
		 *
		 * @param string $title The block title.
		 **/
		public function __construct()
		{
			parent::__construct(
				'thb_divider',
				__( 'Divider', 'thb_text_domain' ),
				thb_get_module_template_path( 'backpack/general', 'block_thb_divider' )
			);

			$this->setDescription( __( 'A simple content divider.', 'thb_text_domain' ) );

			$this->buildModals();
		}

		/**
		 * Build the block modals.
		 */
		private function buildModals()
		{
			$thb_modal = new THB_Modal( $this->getTitle(), $this->getSlug() );
				$thb_modal_container = $thb_modal->createContainer( '', $this->getSlug() . '_container' );

				$thb_field = new THB_NumberField( 'margin_top' );
				$thb_field->setLabel( __( 'Margin top', 'thb_text_domain' ) );
				$thb_modal_container->addField( $thb_field );

				$thb_field = new THB_NumberField( 'margin_bottom' );
				$thb_field->setLabel( __( 'Margin bottom', 'thb_text_domain' ) );
				$thb_modal_container->addField( $thb_field );

				$thb_field = new THB_CheckboxField( 'show_go_top' );
				$thb_field->setLabel( __( 'Show Go top', 'thb_text_domain' ) );
				$thb_field->setHelp( __( 'Check if you want to show the go top text.', 'thb_text_domain' ) );
				$thb_modal_container->addField( $thb_field );

				$thb_field = new THB_SelectField( 'divider_styles' );
				$thb_field->setLabel( __( 'Styles', 'thb_text_domain' ) );
				$thb_field->setOptions( thb_config('backpack/general', 'builder_divider_styles') );
				$thb_modal_container->addField( $thb_field );

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
				$block_data['divider_styles']
			);

			if ( $block_data['show_go_top'] == 1 ) {
				$block_classes[] = 'go-top-active';
			}

			return array_merge( $block_classes, parent::blockClasses( $block_data ) );
		}

	}

	thb_builder_instance()->addBlock( new THB_DividerBlock() );
}

if( ! class_exists( 'THB_PricingTableBlock' ) && function_exists( 'thb_builder' ) ) {
	/**
	 * Builder page block.
	 */
	class THB_PricingTableBlock extends THB_BuilderBlock {

		/**
		 * Constructor
		 *
		 * @param string $title The block title.
		 **/
		public function __construct()
		{
			parent::__construct(
				'thb_pricingtable',
				__( 'Pricing table', 'thb_text_domain' ),
				thb_get_module_template_path( 'backpack/general', 'block_thb_pricingtable' )
			);

			$this->setDescription( __( 'Create your pricing table.', 'thb_text_domain' ) );

			$this->buildModals();
		}

		/**
		 * Build the block modals.
		 */
		private function buildModals()
		{
			$thb_modal = new THB_Modal( $this->getTitle(), $this->getSlug() );
				$thb_modal_container = $thb_modal->createDuplicableContainer( '', $this->getSlug() . '_duplicable_container' );
				$thb_modal_container->setSortable( true, true );

				$thb_modal_container->addControl( __( 'Add a price item', 'thb_text_domain' ) );

				$thb_field = new THB_PricingTableField( 'pricingtable_items' );
				$thb_field->addClass( 'full' );
				$thb_modal_container->setField( $thb_field );

				$thb_modal_container = $thb_modal->createContainer( '', $this->getSlug() . '_container' );

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

			return array_merge( $block_classes, parent::blockClasses( $block_data ) );
		}

	}

	thb_builder_instance()->addBlock( new THB_PricingTableBlock() );
}

if( ! class_exists( 'THB_TestimonialBlock' ) && function_exists( 'thb_builder' ) ) {
	/**
	 * Builder text box block.
	 */
	class THB_TestimonialBlock extends THB_BuilderBlock {

		/**
		 * Constructor
		 *
		 * @param string $title The block title.
		 **/
		public function __construct()
		{
			parent::__construct(
				'thb_testimonial',
				__( 'Testimonial', 'thb_text_domain' ),
				thb_get_module_template_path( 'backpack/general', 'block_thb_testimonial' )
			);

			$this->setDescription( __( 'A testimonial block.', 'thb_text_domain' ) );

			$this->buildModals();
		}

		/**
		 * Build the block modals.
		 */
		private function buildModals()
		{
			$thb_modal = new THB_Modal( $this->getTitle(), $this->getSlug() );
				$thb_modal_container = $thb_modal->createContainer( '', $this->getSlug() . '_container' );

					$thb_field = new THB_UploadField( 'image' );
					$thb_field->setLabel( __( 'Image', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_TextareaField( 'quote' );
					$thb_field->setLabel( __( 'Quote', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_TextField( 'author' );
					$thb_field->setLabel( __( 'Author', 'thb_text_domain' ) );
					$thb_field->setHelp( __( 'The quote author.', 'thb_text_domain' ));
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_TextField( 'author_url' );
					$thb_field->setLabel( __( 'Author URL', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

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

			return array_merge( $block_classes, parent::blockClasses( $block_data ) );
		}

	}

	thb_builder_instance()->addBlock( new THB_TestimonialBlock() );
}

if( ! class_exists( 'THB_GoogleMapBlock' ) && function_exists( 'thb_builder' ) ) {
	/**
	 * Builder text box block.
	 */
	class THB_GoogleMapBlock extends THB_BuilderBlock {

		/**
		 * Constructor
		 *
		 * @param string $title The block title.
		 **/
		public function __construct()
		{
			parent::__construct(
				'thb_google_map',
				__( 'Map', 'thb_text_domain' ),
				thb_get_module_template_path( 'backpack/general', 'block_thb_google_map' ),
				thb_get_module_original_template_path( 'backpack/general', 'block_thb_google_map' )
			);

			$this->setDescription( __( 'A Google Maps block.', 'thb_text_domain' ) );

			$this->buildModals();

			add_action( 'wp_loaded', array( $this, 'addScripts' ), 20 );
		}

		/**
		 * Enqueue the Google Map scripts.
		 */
		public function addScripts()
		{
			if ( $this->isActive() ) {
				$key = thb_get_option( 'google_maps_api_key' );
				$key = sanitize_text_field( $key );

				if ( $key ) {
					thb_theme()->getFrontend()->addScript( 'https://maps.googleapis.com/maps/api/js?callback=thb_builderInitMap&key=' . $key );
				}
				else {
					thb_theme()->getFrontend()->addScript( 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false' );
				}
			}
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
					$thb_field->setOptions( thb_config('backpack/general', 'builder_google_map_layout_styles') );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_SelectField( 'alignment' );
					$thb_field->setLabel( __( 'Alignment', 'thb_text_domain' ) );
					$thb_field->setOptions( array(
						'left'   => __( 'Left', 'thb_text_domain' ),
						'right'  => __( 'Right', 'thb_text_domain' ),
						'center' => __( 'Center', 'thb_text_domain' ),
					) );
					$thb_modal_container->addField( $thb_field );

			$thb_modal_tab = $thb_modal->createTab( __( 'Map', 'thb_text_domain' ), $this->getSlug() . '_map_tab' );
				$thb_modal_container = $thb_modal_tab->createContainer( '', $this->getSlug() . '_map_tab_container' );

					$thb_field = new THB_TextField( 'latlong' );
					$thb_field->setLabel( __( 'Latitude & longitude', 'thb_text_domain' ) );
					$thb_field->setHelp( __( 'The comma separated coordinates to which the map will be centered.', 'thb_text_domain' ));
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_NumberField( 'zoom' );
					$thb_field->setLabel( __( 'Zoom level', 'thb_text_domain' ) );
					$thb_field->setHelp( __( 'Defaults to 12.', 'thb_text_domain' ) );
					$thb_field->setMin( '0' );
					$thb_field->setMax( '19' );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_TextField( 'height' );
					$thb_field->setLabel( __( 'Height', 'thb_text_domain' ) );
					$thb_field->setHelp( __( 'E.g. 300px. If unitless, pixels will be used.', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_TextareaField( 'style' );
					$thb_field->setLabel( __( 'Map style', 'thb_text_domain' ) );
					$thb_field->setHelp( sprintf( __( 'You can get more map styles <a target="_blank" href="%s">here</a>.', 'thb_text_domain' ), 'http://snazzymaps.com/' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_UploadField( 'marker' );
					$thb_field->setLabel( __( 'Custom marker icon', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_CheckboxField( 'disable_map_scroll' );
					$thb_field->setLabel( __( 'Disable map scroll', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

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

			if ( ! isset( $block_data['layout'] ) ) {
				$layout = '';
			}
			else {
				$layout = $block_data['layout'];
			}

			$block_classes[] = 'thb-google-map-block-layout-' . $layout;
			$block_classes[] = 'thb-google-map-block-alignment-' . $block_data['alignment'];

			return array_merge( $block_classes, parent::blockClasses( $block_data ) );
		}

	}

	thb_builder_instance()->addBlock( new THB_GoogleMapBlock() );
}