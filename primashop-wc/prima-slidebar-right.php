<?php
/**
 * The template for displaying right slidebar.
 *
 * WARNING: This file is part of the PrimaShop parent theme.
 * Please do all modifications in the form of a child theme.
 *
 * @category PrimaShop
 * @package  Templates
 * @author   PrimaThemes
 * @link     http://www.primathemes.com
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<div class="sb-slidebar sb-right sb-style-push">
	<?php 
		$instance = array('title' => '', 'number' => 999);
		$args = array('before_widget' => '<div class="widget widget_shopping_cart woocommerce group">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget_title">', 'after_title' => '</h4>');
		$prima_minicart = new WC_Widget_Cart();
		$prima_minicart->number = $instance['number'];
		$prima_minicart->widget($args,$instance);
	?>
</div>
