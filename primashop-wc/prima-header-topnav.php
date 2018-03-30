<?php
/**
 * The template for displaying top navigation.
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

  <header id="topnav" class="group">
	<div class="margin group">
	  <div class="topnav-left">
		<?php echo do_shortcode( shortcode_unautop( wpautop( prima_get_setting( 'topnav_message' ) ) ) ); ?>
		<?php do_action( 'prima_topnav_left' ); ?>
	  </div>
	  <div class="topnav-right">
	    <ul class="topnav-menu">
		
		<?php if ( prima_get_setting( 'topnav_myaccount' ) && function_exists( 'prima_wc_myaccount_url' ) ) : ?>
		  <li><a href="<?php prima_wc_myaccount_url(); ?>"><?php _e( 'My Account', 'primathemes' ); ?></a></li>
		<?php endif; ?>
		
		<?php if ( prima_get_setting( 'topnav_login' ) && function_exists( 'prima_wc_myaccount_url' ) ) : ?>
		  <?php if ( is_user_logged_in() ) : ?>
		    <li><a href="<?php echo wp_logout_url(home_url('/')); ?>"><?php _e( 'Logout', 'primathemes' ); ?></a></li>
		  <?php else : ?>
		    <li><a href="<?php prima_wc_myaccount_url(); ?>"><?php _e( 'Login', 'primathemes' ); ?></a></li>
		  <?php endif; ?>
		<?php endif; ?>
		
		<?php if ( prima_get_setting( 'topnav_cart' ) && function_exists( 'prima_wc_cart_url' ) ) : ?>
		  <li class="topnav-cart">
		    <a class="topnav-cart-count" href="<?php prima_wc_cart_url(); ?>"><?php echo prima_wc_top_nav_cartcount_text(); ?></a>
			<?php if( prima_get_setting( 'topnav_minicart' ) && !is_cart() && !is_checkout() && class_exists("WC_Widget_Cart") ) : ?>
				<div class="minicart group">
				<?php if ( prima_get_wc_cart_count() > 0 ) : ?>
					<?php 
					$instance = array('title' => '', 'number' => 999);
					$args = array('before_widget' => '<div class="widget_shopping_cart woocommerce group">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget_title">', 'title' => '', 'after_title' => '</h4>');
					$prima_minicart = new WC_Widget_Cart();
					$prima_minicart->number = $instance['number'];
					$prima_minicart->widget($args,$instance);
					?>
				<?php else : ?>
					<div class="widget_shopping_cart woocommerce group">
						<div class="widget_shopping_cart_content">
							<p><?php _e( 'Your cart is empty', 'primathemes' ); ?></p>
							<p class="buttons">
								<a class="button" href="<?php prima_wc_shop_url(); ?>"><?php _e( 'Visit Shop', 'primathemes' ); ?></a>
							</p>
						</div>
					</div>
				<?php endif; ?>
				</div>
			<?php endif; ?>
		  </li>
		<?php endif; ?>
		
		<?php if ( prima_get_setting( 'topnav_productsearch' ) ) : ?>
		  <?php if ( class_exists( 'YITH_WCAS' ) ) : ?>
		    <li class="topnav-search"><?php echo do_shortcode('[yith_woocommerce_ajax_search]'); ?></li>
		  <?php elseif ( function_exists( 'prima_product_search' ) ) : ?>
		    <li class="topnav-search"><?php prima_product_search( 'searchform-topnav' ); ?></li>
		  <?php endif; ?>
		<?php endif; ?>
		
		</ul>
		<?php do_action( 'prima_topnav_right' ); ?>
	  </div>
	</div>
  </header>
