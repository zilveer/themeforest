<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Mega menu.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Modules\Backpack\Megamenu
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2014, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 2.0.2
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$thb_theme = thb_theme();

/**
 * Frontend walker.
 * -----------------------------------------------------------------------------
 */
require_once 'walker.php';

/**
 * Module configuration
 * -----------------------------------------------------------------------------
 */
$thb_config = array(

);
$thb_theme->setConfig( 'backpack/megamenu', thb_array_asum($thb_config, $config) );

$thb_menu = new THB_Menu();
$thb_menu->addCheckboxField( 0, 'megamenu', __( 'Is mega menu?', 'thb_text_domain' ) );
$thb_menu->addSelectField( 0, 'columns', __( 'Columns', 'thb_text_domain' ), array(
	'0' => __( 'Auto', 'thb_text_domain' ),
	'1' => '1',
	'2' => '2',
	'3' => '3',
	'4' => '4',
	'5' => '5',
	'6' => '6'
) );

$thb_menu->addCheckboxField( array( 1,2,3,4,5 ), 'disable_link', __( 'Disable the item link?', 'thb_text_domain' ), __( 'Disable the link applied to the menu item to use this element as label', 'thb_text_domain' ) );