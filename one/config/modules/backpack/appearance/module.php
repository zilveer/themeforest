<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Theme appearance.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Modules\Backpack\Appearance
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2014, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 2.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Options tab
 * -----------------------------------------------------------------------------
 */
$thb_page = thb_theme()->getAdmin()->getAppearancePage();

if ( $thb_page ) {
	// Custom CSS ------------------------------------------------------------------

	$thb_tab = new THB_Tab( __('Custom CSS', 'thb_text_domain'), 'custom_css' );

		$thb_container = $thb_tab->createContainer( '', 'custom_css_options', 900 );

			$thb_field = new THB_TextareaField( 'custom_css' );
				$thb_field->setAllowCode();
				$thb_field->setLabel( __('Custom frontend CSS', 'thb_text_domain') );
				$thb_field->setHelp( __('You can easily find CSS elements by using your browser inspector or Firebug, or view a quick guide <a href="http://sixrevisions.com/tools/firebug-guide-web-designers/" target="_blank">here</a>.', 'thb_text_domain') );
			$thb_container->addField($thb_field);

	$thb_page->addTab( $thb_tab );

	// Custom JS -------------------------------------------------------------------

	// $thb_tab = new THB_Tab( __('Custom JS', 'thb_text_domain'), 'custom_js' );

	// 	$thb_container = $thb_tab->createContainer( '', 'custom_js_options', 900 );

	// 		$thb_field = new THB_TextareaField( 'custom_js' );
	// 			$thb_field->setAllowCode();
	// 			$thb_field->setCodeLanguage( 'javascript' );
	// 			$thb_field->setLabel( __('Custom frontend JS', 'thb_text_domain') );
	// 			$thb_field->setHelp( __('This option automatically generates a <code>script</code> tag placed at the bottom of the page.', 'thb_text_domain') );
	// 		$thb_container->addField($thb_field);

	// $thb_page->addTab( $thb_tab );

	// Fonts -----------------------------------------------------------------------

	$thb_tab = new THB_Tab( __('Fonts imports', 'thb_text_domain'), 'fonts_imports' );

		$thb_container = $thb_tab->createDuplicableContainer( __( 'Google Fonts', 'thb_text_domain' ), 'appearance_options_google_fontimports', 0 );

			$thb_container->setIntroText( __( 'To import a specific font, just create a new collection at <a href="http://www.google.com/fonts" target="blank">Google Fonts</a> and paste the @import code that you can find on section "3. Add this code to your website:" after clicking on "Use".<br>Upon saving the system will take care of the rest and you\'ll find the font at the bottom of the appropriate Customizer font select controls under the "Other" label.
				<br><br>The code would look like: <code>@import url(http://fonts.googleapis.com/css?family=Frijole);</code>', 'thb_text_domain' ) );

			$thb_container->addControl( __('Add', 'thb_text_domain'), '' );

			$thb_field = new THB_TextField( 'googlefont' );
			$thb_field->setLabel( __( 'Google font', 'thb_text_domain' ) );
			$thb_container->setField( $thb_field );

		$thb_container = $thb_tab->createContainer( __('External', 'thb_text_domain'), 'appearance_options_fontimports', 1 );

			$thb_font_imports_intro_text = '';

			if ( class_exists( 'Typekit' ) ) {
				$thb_font_imports_intro_text .= __( 'Here you can add your Typekit kit ID or include code from other external fonts web services like Fonts.com, Fontdeck, etc.<br /><br />
	<strong>Typekit kit ID</strong><br />
	Paste you Typekit kit ID in order to use your Typekit fonts directly on in the WordPress Customizer.<br />
	You might want to read more about how to <a href="http://help.typekit.com/customer/portal/articles/6780-adding-fonts-to-your-site" target="_blank">create a kit<a> on the Typekit website.<br />
	Please remember to always add your development domain to the Typekit kit domains list. You can read more about this topic <a href="http://help.typekit.com/customer/portal/articles/6856-Domains" target="_blank">here</a> and <a href="http://help.typekit.com/customer/portal/articles/6857-using-typekit-while-developing-locally" target="_blank">here</a>.<br /><br />' );
			}

			$thb_font_imports_intro_text .= __( '<strong>External import code</strong><br />
	You can use the "External import code" textarea to add the code needed by your webfont service in order to import its custom fonts.', 'thb_text_domain' );

			$thb_container->setIntroText( $thb_font_imports_intro_text );

			if ( class_exists( 'Typekit' ) ) {
				$thb_field = new THB_TextField( 'typekit_id' );
					$thb_field->setLabel( __('Typekit kit ID', 'thb_text_domain') );
				$thb_container->addField($thb_field);
			}

			$thb_field = new THB_TextareaField( 'external_import' );
				$thb_field->setAllowCode();
				$thb_field->setLabel( __('External import code', 'thb_text_domain') );
			$thb_container->addField($thb_field);

	$thb_page->addTab( $thb_tab, 30 );

	$thb_tab = new THB_Tab( __('Fonts in use', 'thb_text_domain'), 'fonts_in_use' );

		$thb_container = $thb_tab->createContainer( '', 'customizer_font', 100 );
			$thb_container->setIntroText( __('These are all the fonts used throughout the theme. Every change you make in the WordPress Customizer area will be reflected in this tab.<br /><br />
	Here you can choose to refine your font variants. Variants can then be used in the Custom frontend CSS textarea on this tab.<br />
	For each font family imported in the theme you&#39;ll find a reference to the CSS selector in use for that family. Clicking on it will automatically select the whole selector, so that you can copy and paste it in the Custom frontend CSS textarea or in your external CSS file.', 'thb_text_domain') );

	$thb_page->addTab( $thb_tab, 30 );

	$thb_tab = new THB_StaticTab( __('Custom fonts upload', 'thb_text_domain'), 'custom_fonts' );
	$thb_tab->setAction('thb_upload_custom_fonts');
	$thb_tab->setSubmitLabel( __('Save changes', 'thb_text_domain') );

		$thb_container = $thb_tab->createDuplicableContainer( '', 'custom_fonts_container' );
			$fontsquirrel_url = 'http://www.fontsquirrel.com';
			$thb_container->setIntroText( sprintf( __('Upload a Font Face kit archive package from <a href="%s">Font Squirrel</a>. The archive will be unpacked automatically and the fonts will become available for you to select in the <a href="%s">Customize screen</a>.', 'thb_text_domain'), $fontsquirrel_url, admin_url('customize.php') ) );

			$thb_container->addControl( __('Upload new font', 'thb_text_domain'), '' );

			$thb_upload = new THB_FontField( 'custom_font' );
			$thb_upload->setLabel( __('Upload', 'thb_text_domain') );
			$thb_container->setField($thb_upload);

	$thb_page->addTab($thb_tab, 70);

	if ( class_exists( 'Typekit' ) ) {
		/**
		 * Typekit
		 * -----------------------------------------------------------------------------
		 */
		if( ! function_exists( 'thb_external_fonts_imports' ) ) {
			/**
			 * Include the Typekit importer in the page.
			 */
			function thb_external_fonts_imports() {
				$typekit_id = thb_get_option('typekit_id');
				$external_import = thb_get_option('external_import');

				if ( ! empty( $typekit_id ) ) {
					echo '<script type="text/javascript" src="//use.typekit.net/' . $typekit_id . '.js"></script>';
					echo '<script type="text/javascript">try{Typekit.load();}catch(e){}</script>';
				}

				if ( ! empty($external_import) ) {
					echo $external_import;
				}
			}

			add_action( 'wp_head', 'thb_external_fonts_imports' );
		}
	}

	/**
	 * Helpers
	 * -----------------------------------------------------------------------------
	 */
	if( ! function_exists( 'thb_clear_typekit_cache' ) ) {
		function thb_clear_typekit_cache() {
			thb_cache_clear( 'typekit' );
		}

		add_action( 'thb_field_option_save_typekit_id', 'thb_clear_typekit_cache' );
	}

	function thb_save_custom_css_filter( $value, $data, $field ) {
		if ( $field->getName() === 'custom_css' ) {
			$value = $data;
		}

		return $value;
	}

	add_filter( 'thb_field_save_option', 'thb_save_custom_css_filter', 10, 3 );
}