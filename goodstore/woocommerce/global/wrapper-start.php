<?php
/**
 * Content wrappers
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


echo '<div id="container"><div id="content" class="'. implode(' ', jwLayout::content_width()) . '" role="main">';