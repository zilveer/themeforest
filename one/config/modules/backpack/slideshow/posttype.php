<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

if( ! function_exists( 'thb_slideshow_init' ) ) {
	function thb_slideshow_init() {
		$thb_slide = new THB_SlideField( 'showcase_slides' );
		$thb_slide->setLabel( __('Slide', 'thb_text_domain') );
		$thb_slide = apply_filters( 'thb_slideshow_slide', $thb_slide );

		if ( ! thb_is_admin_template( thb_config( 'backpack/slideshow', 'templates' ) ) ) {
			return;
		}

		foreach( thb_theme()->getPublicPostTypes() as $post_type ) {
			if ( ! $thb_metabox = $post_type->getMetabox('layout') ) {
				return;
			}

			$thb_tab = $thb_metabox->createTab( __( 'Slideshow', 'thb_text_domain' ), 'slideshow_tab' );
			$thb_tab->setIcon( 'images-alt2' );
			$thb_tab->addSeparator();
			$thb_container = $thb_tab->createContainer( __( 'Slides configuration', 'thb_text_domain' ), 'slides_config_container' );

			if ( thb_config( 'backpack/slideshow', 'effects' ) ) {
				$thb_field = new THB_SelectField('slideshow_effect');
				$thb_field->setLabel( __('Slideshow effect', 'thb_text_domain') );
				$thb_field->setOptions( thb_config( 'backpack/slideshow', 'effects' ) );
				$thb_container->addField($thb_field);
			}

			if ( thb_config( 'backpack/slideshow', 'speed' ) ) {
				$thb_field = new THB_NumberField( 'slideshow_speed' );
				$thb_field->setLabel( __( 'Slideshow speed', 'thb_text_domain' ) );
				$thb_field->setMin('0');
				$thb_field->setHelp( __( 'Number of seconds after which the slideshow will auto advance.', 'thb_text_domain' ) );
				$thb_container->addField( $thb_field );
			}

			if ( thb_config( 'backpack/slideshow', 'autoplay' ) ) {
				$thb_field = new THB_CheckboxField( 'slideshow_autoplay' );
				$thb_field->setLabel( __( 'Slideshow autoplay', 'thb_text_domain' ) );
				$thb_container->addField( $thb_field );
			}

			$thb_container = new THB_MetaboxDuplicableFieldsContainer( '', 'slides_container' );
			$thb_container->setSortable();

			$thb_container->addControl( __('Add images', 'thb_text_domain'), 'add_image', '', array(
				'action' => 'thb_add_multiple_slides',
				'title'  => __('Add image slides', 'thb_text_domain')
			) );

			if ( thb_config( 'backpack/slideshow', 'video' ) === true ) {
				$thb_container->addControl( __('Add video', 'thb_text_domain'), 'add_video', '', array(
					'action' => 'thb_add_video_slide',
					'title'  => __('Add video slide', 'thb_text_domain')
				) );
			}

			$thb_container->setField( $thb_slide );

			$thb_tab->addContainer( $thb_container );
		}
	}

	add_action( 'wp_loaded', 'thb_slideshow_init' );
}