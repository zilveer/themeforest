<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Custom fonts module.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Modules\Core\Customfonts
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$thb_theme = thb_theme();
$thb_page = $thb_theme->getAdmin()->getMainPage();

/**
 * Custom fonts
 */
$thb_tab = new THB_StaticTab( __('Custom fonts', 'thb_text_domain'), 'custom_fonts' );
$thb_tab->setAction('thb_upload_custom_fonts');
$thb_tab->setSubmitLabel( __('Save changes', 'thb_text_domain') );

	$thb_container = $thb_tab->createDuplicableContainer( '', 'custom_fonts_container' );
		$fontsquirrel_url = 'http://www.fontsquirrel.com';
		$thb_container->setIntroText( sprintf( __('Upload a Font Face kit archive package from <a href="%s">Font Squirrel</a>. The archive will be unpacked automatically and the fonts will become available for you to select in the <a href="%s">Customize screen</a>.', 'thb_text_domain'), $fontsquirrel_url, admin_url('customize.php') ) );

		$thb_container->addControl( __('Upload new font', 'thb_text_domain'), '' );

		$thb_upload = new THB_FontField( 'custom_font' );
		$thb_upload->setLabel( __('Upload', 'thb_text_domain') );
		$thb_container->setField($thb_upload);

$thb_page->addTab($thb_tab);