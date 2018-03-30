<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Background field class.
 *
 * This class is entitled to manage the option/meta background field types.
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
 * @since The Happy Framework v 2.0.1
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
if( !class_exists('THB_OneBackgroundField') ) {
	class THB_OneBackgroundField extends THB_Field {

		/**
		 * The field subkeys.
		 *
		 * @var array
		 **/
		protected $_subKeys = array( 'overlay_color', 'overlay_opacity', 'overlay_display', 'background_color', 'id' );

		/**
		 * Constructor
		 *
		 * @param string $name The field name.
		 * @param integer $context The field context.
		 **/
		public function __construct( $name, $context = null )
		{
			parent::__construct( $name, 'one_background', $context );
		}
	}
}

if( ! function_exists( 'thb_admin_background_field_script' ) ) {
	/**
	 * Include the admin style for the background field.
	 */
	function thb_admin_background_field_assets() {
		thb_theme()->getAdmin()->addScript( get_template_directory_uri() . '/js/admin_field_background.js', array( 'jquery' ) );
		thb_theme()->getAdmin()->addStyle( get_template_directory_uri() . '/css/one_background_field.css' );
	}

	thb_admin_background_field_assets();
}

if ( ! function_exists( 'thb_section_background' ) ) {
	/**
	 * Add a background field to the builder section appearance modal.
	 */
	function thb_section_background_field() {
		$thb_section_appearance_modal_tab = thb_theme()->getAdmin()->getModal( 'section_appearance' )->createTab( __( 'Background', 'thb_text_domain' ), 'section_appearance_background', 2 );
		$thb_modal_container = $thb_section_appearance_modal_tab->createContainer( '', 'thb_appearance_dimensions_container' );

			$thb_field = new THB_OneBackgroundField( 'background' );
			$thb_field->setLabel( __( 'Background', 'thb_text_domain' ) );
			$thb_field->setLabel( '' );
			$thb_field->addClass( 'full' );

		$thb_modal_container->addField( $thb_field );

			$thb_field = new THB_SelectField( 'background_appearance' );
			$thb_field->setOptions( array(
				'relative' => __( 'Regular', 'thb_text_domain' ),
				'fixed'    => __( 'Fixed', 'thb_text_domain' ),
				'parallax' => __( 'Parallax', 'thb_text_domain' )
			) );
			$thb_field->setLabel( __( 'Background appearance', 'thb_text_domain' ) );

		$thb_modal_container->addField( $thb_field );

			$thb_field = new THB_CheckboxField( 'fit_height' );
				$thb_field->setLabel( __( 'Fit to the window height', 'thb_text_domain' ) );
				$thb_field->setHelp( __( 'Force a min-height to the section container based on the window height. Please note that this option doesn\'t align the section content', 'thb_text_domain' ) );

		$thb_modal_container->addField( $thb_field );
	}

	add_action( 'wp_loaded', 'thb_section_background_field' );
}

if ( ! function_exists( 'thb_one_section_classes' ) ) {
	/**
	 * Add a skin class to the builder section frontend template.
	 *
	 * @param array $section_classes
	 * @param array $section
	 * @return array
	 */
	function thb_one_section_classes( $section_classes, $section ) {
		if ( isset( $section['appearance'] ) ) {
			$skin = thb_section_get_text_skin( $section['appearance'] );

			if ( ! empty( $skin ) ) {
				$section_classes[] = 'thb-skin-' . $skin;
			}
		}

		return $section_classes;
	}

	add_filter( 'thb_section_classes', 'thb_one_section_classes', 10, 2 );
}

if( ! function_exists( 'thb_section_get_text_skin' ) ) {
	/**
	 * Generate the builder section skin class from a comparison color.
	 *
	 * @param array $appearance
	 * @return string
	 */
	function thb_section_get_text_skin( $appearance ) {
		$pagecontent_background = get_theme_mod('body_bg', '#ffffff');

		if ( isset( $appearance['background'] ) ) {
			$overlay_color     = $appearance['background']['overlay_color'];
			$background_color  = $appearance['background']['background_color'];

			return thb_color_get_skin_from_comparison( $overlay_color, $background_color, $pagecontent_background );
		}
		else {
			return thb_color_get_opposite_skin( $pagecontent_background );
		}

		return '';
	}
}

if ( ! function_exists( 'thb_section_attrs' ) ) {
	function thb_section_attrs( $section_attrs, $section ) {
		if ( ! isset( $section['appearance'] ) || ! isset( $section['appearance']['background'] ) ) {
			return $section_attrs;
		}

		$background_color       = thb_isset( $section['appearance']['background'], 'background_color', '' );
		$background_image       = thb_isset( $section['appearance']['background'], 'id', '' );
		$background_appearance  = thb_isset( $section['appearance'], 'background_appearance', '');
		$section_margin_top     = thb_isset( $section['appearance'], 'margin_top', '');
		$section_margin_bottom  = thb_isset( $section['appearance'], 'margin_bottom', '');
		$section_padding_top    = thb_isset( $section['appearance'], 'padding_top', '');
		$section_padding_bottom = thb_isset( $section['appearance'], 'padding_bottom', '');
		$fit_height             = thb_isset( $section['appearance'], 'fit_height', '');

		if ( $background_appearance ) {
			$section_attrs['data-' . $background_appearance] = '1';
		}

		if ( $fit_height ) {
			$section_attrs['data-fit-height'] = '1';
		}

		if ( ! isset( $section_attrs['style'] ) ) {
			$section_attrs['style'] = '';
		}

		if ( $section_margin_top != '' ) {
			$section_attrs['style'] .= sprintf( ' margin-top: %spx;', $section_margin_top );
		}

		if ( $section_margin_bottom != '' ) {
			$section_attrs['style'] .= sprintf( ' margin-bottom: %spx;', $section_margin_bottom );
		}

		if ( $section_padding_top != '' ) {
			$section_attrs['style'] .= sprintf( ' padding-top: %spx;', $section_padding_top );
		}

		if ( $section_padding_bottom != '' ) {
			$section_attrs['style'] .= sprintf( ' padding-bottom: %spx;', $section_padding_bottom );
		}

		if ( ! empty( $background_color ) ) {
			$section_attrs['style'] .= sprintf( ' background-color: %s;', $background_color );
		}

		if ( ! empty( $background_image ) ) {
			$section_attrs['style'] .= sprintf( ' background-image: url(%s);', thb_image_get_size( $background_image, 'full-width' ) );
		}

		return $section_attrs;
	}

	add_filter( 'thb_section_attrs', 'thb_section_attrs', 10, 2 );
}

if ( ! function_exists( 'thb_section_background' ) ) {
	function thb_section_background( $section ) {
		if ( isset( $section['appearance'] ) && isset( $section['appearance']['background'] ) ) {
			$overlay_display  = $section['appearance']['background']['overlay_display'];
			$overlay_color    = $section['appearance']['background']['overlay_color'];

			if ( empty( $overlay_color ) ) {
				return;
			}

			if ( $overlay_display == '1' ) {
				$overlay_opacity = $section['appearance']['background']['overlay_opacity'];

				thb_overlay( $overlay_color, $overlay_opacity, 'thb-background-overlay' );
			}
		}
	}

	add_action( 'thb_section_pre_wrapper', 'thb_section_background' );
}