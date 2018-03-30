<?php
/**
 * The template for displaying footer area.
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

  <footer id="footer" class="group">
	<div class="margin group">
	  <div class="footer-left">
		<?php echo do_shortcode( shortcode_unautop( wpautop( prima_get_setting( 'footer_content' ) ) ) ); ?>
		<?php do_action( 'prima_footer_left' ); ?>
	  </div>
	  <div class="footer-right">
		<?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'fallback_cb' => '', 'echo' => true, 'depth' => 1, 'container' => false, 'menu_id' => 'footer-menu', 'menu_class' => 'footer-menu group' ) ); ?>
		<?php if ( prima_get_setting( 'footer_social' ) > 0 ) : ?>
		  <ul class="footer-menu footer-social">
		<?php for ( $i = 1; $i <= prima_get_setting( 'footer_social' ); $i++ ) : ?>
		  <?php $social = prima_get_setting( "footer_social_{$i}" ); ?>
		  <?php $social_url = prima_get_setting( "footer_social_{$i}_url" ); ?>
		  <?php if ( $social ) echo '<li><a target="_blank" rel="nofollow" href="'.( $social_url ? $social_url : '#' ).'" class="footer-social-item"><i class="fa fa-'.$social.'"></i></a></li>'; ?>
		<?php endfor; ?>
		  </ul>
		<?php endif; ?>
		<?php do_action( 'prima_footer_right' ); ?>
	  </div>
	</div>
  </footer>
