<?php
/**
 * Content wrappers
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<div class="content-wrapper">
<div class="main-content<?php echo (of_get_option('sidebar_alignment', "left") == "right")? " float-left" : " float-right"; ?>">
<div class="main-content-inner" role="main">