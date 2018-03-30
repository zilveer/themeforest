<?php
/**
 * The template for displaying header content (logo and menu).
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

$class = function_exists( 'ubermenu' ) ? 'header-ubermenu-active' : '';
?>

  <header id="header" class="group">
	<div class="margin group">
	  <?php if ( has_nav_menu( 'header-menu' ) && !function_exists('ubermenu') ) : ?>
	    <i class="mobile-icon-nav sb-toggle-left fa fa-navicon fa-2x"></i>
	  <?php endif; ?>
	  <?php if ( class_exists('woocommerce') && !is_cart() && !is_checkout() && prima_get_setting( 'topnav' ) && prima_get_setting( 'topnav_cart' ) && function_exists( 'prima_wc_cart_url' ) && !function_exists('ubermenu') ) : ?>
	    <i class="mobile-icon-cart sb-toggle-right fa fa-shopping-cart fa-2x"></i>
	  <?php endif; ?>
	  <div id="header-title" class="group">
	    <?php if ( !is_singular() || ( is_page() && prima_get_post_meta( '_page_title_hide' ) ) || is_page_template('page_blog.php') ) : ?>
		  <h1 class="site-title">
		    <a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a>
		  </h1>
	    <?php else : ?>
		  <div class="site-title">
		    <a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a>
		  </div>
	    <?php endif; ?>
		<?php do_action( 'prima_header_left' ); ?>
	  </div>
	  <div id="header-menu" class="group">
	    <?php if ( !function_exists( 'ubermenu' ) ) : ?>
		  <?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'fallback_cb' => '', 'echo' => true, 'container' => false, 'menu_id' => 'menu-primary', 'menu_class' => 'sf-menu menu-primary' ) ); ?>
		<?php endif; ?>
		<?php do_action( 'prima_header_right' ); ?>
	  </div>
      <?php if ( function_exists( 'ubermenu' ) ) ubermenu( 'main' , array( 'theme_location' => 'header-menu' ) ); ?>
	</div>
  </header>