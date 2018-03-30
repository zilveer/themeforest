<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * General shortcodes.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Core\Shortcodes
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$thb_theme = thb_theme();

/**
 * Column
 * -----------------------------------------------------------------------------
 */
$shortcode = new THB_Shortcode('thb_one_third', 'frontend/shortcodes/general');
$shortcode->setData('tag', 'div');
$shortcode->setClass('col content-one-third');
$shortcode->setExample('[thb_one_third]...[/thb_one_third]');
$shortcode->setLabel( __('1/3 column', 'thb_text_domain') );
$shortcode->setType( __('Layout', 'thb_text_domain') );
$thb_theme->addShortcode($shortcode);

$shortcode = new THB_Shortcode('thb_two_thirds', 'frontend/shortcodes/general');
$shortcode->setData('tag', 'div');
$shortcode->setClass('col content-two-third');
$shortcode->setExample('[thb_two_thirds]...[/thb_two_thirds]');
$shortcode->setLabel( __('2/3 column', 'thb_text_domain') );
$shortcode->setType( __('Layout', 'thb_text_domain') );
$thb_theme->addShortcode($shortcode);

$shortcode = new THB_Shortcode('thb_one_fourth', 'frontend/shortcodes/general');
$shortcode->setData('tag', 'div');
$shortcode->setClass('col content-one-fourth');
$shortcode->setExample('[thb_one_fourth]...[/thb_one_fourth]');
$shortcode->setLabel( __('1/4 column', 'thb_text_domain') );
$shortcode->setType( __('Layout', 'thb_text_domain') );
$thb_theme->addShortcode($shortcode);

$shortcode = new THB_Shortcode('thb_two_fourths', 'frontend/shortcodes/general');
$shortcode->setData('tag', 'div');
$shortcode->setClass('col content-two-fourth');
$shortcode->setExample('[thb_two_fourths]...[/thb_two_fourths]');
$shortcode->setLabel( __('2/4 column', 'thb_text_domain') );
$shortcode->setType( __('Layout', 'thb_text_domain') );
$thb_theme->addShortcode($shortcode);

$shortcode = new THB_Shortcode('thb_three_fourths', 'frontend/shortcodes/general');
$shortcode->setData('tag', 'div');
$shortcode->setClass('col content-three-fourth');
$shortcode->setExample('[thb_three_fourths]...[/thb_three_fourths]');
$shortcode->setLabel( __('3/4 column', 'thb_text_domain') );
$shortcode->setType( __('Layout', 'thb_text_domain') );
$thb_theme->addShortcode($shortcode);

$shortcode = new THB_Shortcode('thb_one_fifth', 'frontend/shortcodes/general');
$shortcode->setData('tag', 'div');
$shortcode->setClass('col content-one-fifth');
$shortcode->setExample('[thb_one_fifth]...[/thb_one_fifth]');
$shortcode->setLabel( __('1/5 column', 'thb_text_domain') );
$shortcode->setType( __('Layout', 'thb_text_domain') );
$thb_theme->addShortcode($shortcode);

$shortcode = new THB_Shortcode('thb_two_fifths', 'frontend/shortcodes/general');
$shortcode->setData('tag', 'div');
$shortcode->setClass('col content-two-fifth');
$shortcode->setExample('[thb_two_fifths]...[/thb_two_fifths]');
$shortcode->setLabel( __('2/5 column', 'thb_text_domain') );
$shortcode->setType( __('Layout', 'thb_text_domain') );
$thb_theme->addShortcode($shortcode);

$shortcode = new THB_Shortcode('thb_three_fifths', 'frontend/shortcodes/general');
$shortcode->setData('tag', 'div');
$shortcode->setClass('col content-three-fifth');
$shortcode->setExample('[thb_three_fifths]...[/thb_three_fifths]');
$shortcode->setLabel( __('3/5 column', 'thb_text_domain') );
$shortcode->setType( __('Layout', 'thb_text_domain') );
$thb_theme->addShortcode($shortcode);

$shortcode = new THB_Shortcode('thb_four_fifths', 'frontend/shortcodes/general');
$shortcode->setData('tag', 'div');
$shortcode->setClass('col content-four-fifth');
$shortcode->setExample('[thb_four_fifths]...[/thb_four_fifths]');
$shortcode->setLabel( __('4/5 column', 'thb_text_domain') );
$shortcode->setType( __('Layout', 'thb_text_domain') );
$thb_theme->addShortcode($shortcode);

/**
 * Button
 * -----------------------------------------------------------------------------
 */
$shortcode = new THB_Shortcode('thb_button', 'frontend/shortcodes/button');
$shortcode->setClass('thb-btn');
$shortcode->setAttributes(array(
	'color' => '',
	'url'   => '',
	'size'  => '',
	'text'  => ''
));
$shortcode->setExample('[thb_button size="" color="grey/graphite/red/blue/green/yellow/purple" url="" text=""]');
$shortcode->setLabel( __('Button', 'thb_text_domain') );
$shortcode->setType( __('Utility', 'thb_text_domain') );
$thb_theme->addShortcode($shortcode);

/**
 * Bigger text size shortcode
 * -----------------------------------------------------------------------------
 */
$shortcode = new THB_Shortcode('thb_bigtext', 'frontend/shortcodes/general');
$shortcode->setData('tag', 'p');
$shortcode->setClass('bigger');
$shortcode->setExample('[thb_bigtext]...[/thb_bigtext]');
$shortcode->setLabel( __('Bigger text', 'thb_text_domain') );
$shortcode->setType( __('Typography', 'thb_text_domain') );
$thb_theme->addShortcode($shortcode);

/**
 * Highlight text
 * -----------------------------------------------------------------------------
 */
$shortcode = new THB_Shortcode('thb_highlight', 'frontend/shortcodes/general');
$shortcode->setData('tag', 'mark');
$shortcode->setClass('thb-highlight');
$shortcode->setExample('[thb_highlight]...[/thb_highlight]');
$shortcode->setLabel( __('Highlighted text', 'thb_text_domain') );
$shortcode->setType( __('Typography', 'thb_text_domain') );
$thb_theme->addShortcode($shortcode);

/**
 * Divider
 * -----------------------------------------------------------------------------
 */
$shortcode = new THB_Shortcode('thb_divider', 'frontend/shortcodes/general');
$shortcode->setData('tag', 'span');
$shortcode->setClass('thb-divider');
$shortcode->setExample('[thb_divider]');
$shortcode->setLabel( __('Divider', 'thb_text_domain') );
$shortcode->setType( __('Layout', 'thb_text_domain') );
$thb_theme->addShortcode($shortcode);

/**
 * Drop caps
 * -----------------------------------------------------------------------------
 */
$shortcode = new THB_Shortcode('thb_dropcaps', 'frontend/shortcodes/dropcaps');
$shortcode->setAttributes(array(
	'color'  => ''
));
$shortcode->setExample('[thb_dropcaps]A[/thb_dropcaps]');
$shortcode->setLabel( __('Dropcap', 'thb_text_domain') );
$shortcode->setType( __('Typography', 'thb_text_domain') );
$thb_theme->addShortcode($shortcode);

/**
 * Message
 * -----------------------------------------------------------------------------
 */
$shortcode = new THB_Shortcode('thb_message', 'frontend/shortcodes/message');
$shortcode->setAttributes(array(
	'type'  => 'notice'
));
$shortcode->setExample('[thb_message type="error/success/warning/info/notice"]...[/thb_message]');
$shortcode->setLabel( __('Message', 'thb_text_domain') );
$shortcode->setType( __('Layout', 'thb_text_domain') );
$thb_theme->addShortcode($shortcode);

/**
 * Icon
 * -----------------------------------------------------------------------------
 */
$shortcode = new THB_Shortcode('thb_icon', 'frontend/shortcodes/icon');
$shortcode->setAttributes(array(
	'url'  => '',
	'align' => 'center'
));
$shortcode->setExample('[thb_icon url="..."]');
$shortcode->setLabel( __('Icon', 'thb_text_domain') );
$shortcode->setType( __('Layout', 'thb_text_domain') );
$thb_theme->addShortcode($shortcode);

/**
 * Box
 * -----------------------------------------------------------------------------
 */
$shortcode = new THB_Shortcode('thb_box', 'frontend/shortcodes/box');
$shortcode->setAttributes(array(
	'title'  => '',
	'icon' => '',
	'align' => 'center'
));
$shortcode->setExample('[thb_box title="" icon="..."]...[/thb_box]');
$shortcode->setLabel( __('Box', 'thb_text_domain') );
$shortcode->setType( __('Layout', 'thb_text_domain') );
$thb_theme->addShortcode($shortcode);

/**
 * Toggle
 * -----------------------------------------------------------------------------
 */
$shortcode = new THB_Shortcode('thb_toggle', 'frontend/shortcodes/toggle');
$shortcode->setAttributes(array(
	'title' => ''
));
$shortcode->setExample('[thb_toggle title=""]...[/thb_toggle]');
$shortcode->setLabel( __('Toggle', 'thb_text_domain') );
$shortcode->setType( __('Layout', 'thb_text_domain') );
$thb_theme->addShortcode($shortcode);

/**
 * Accordion
 * -----------------------------------------------------------------------------
 */
$shortcode = new THB_Shortcode('thb_accordion', 'frontend/shortcodes/accordion');
$shortcode->setAttributes(array());
$shortcode->setExample('[thb_accordion] [thb_toggle title=""]...[/thb_toggle] [thb_toggle title=""]...[/thb_toggle] [/thb_accordion]');
$shortcode->setLabel( __('Accordion', 'thb_text_domain') );
$shortcode->setType( __('Layout', 'thb_text_domain') );
$thb_theme->addShortcode($shortcode);

/**
 * Tabs
 * -----------------------------------------------------------------------------
 */
$shortcode = new THB_Shortcode('thb_tabs', 'frontend/shortcodes/tabs');
$shortcode->setAttributes(array());
$shortcode->setExample('[thb_tabs] [thb_tab title=""]...[/thb_tab] [/thb_tabs]');
$shortcode->setLabel( __('Tabs', 'thb_text_domain') );
$shortcode->setType( __('Layout', 'thb_text_domain') );
$thb_theme->addShortcode($shortcode);

/**
 * Tab
 * -----------------------------------------------------------------------------
 */
$shortcode = new THB_Shortcode('thb_tab', 'frontend/shortcodes/tab');
$shortcode->setAttributes(array());
$shortcode->setExample('[thb_tab title=""]...[/thb_tab]');
$shortcode->setLabel( __('Tab', 'thb_text_domain') );
$shortcode->setType( __('Layout', 'thb_text_domain') );
$thb_theme->addShortcode($shortcode);