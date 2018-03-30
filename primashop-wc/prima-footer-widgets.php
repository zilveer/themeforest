<?php
/**
 * The template for displaying footer widgets area.
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

  <footer id="footer-widgets" class="group">
	<div class="margin group">
	
	<?php if( (int)prima_get_setting('footer_widgets') >= 10 ) : ?>
	  <div class="footer-widget-1">
	  <?php if ( is_active_sidebar( 'footer-widget-1' ) ) : ?> 
		<?php dynamic_sidebar( 'footer-widget-1' ); ?>
	  <?php else : ?>
		<div class="widget widget-container widget_text">
		  <h3 class="widget-title"><?php _e('Footer Widget #1', 'primathemes'); ?></h3>
		  <div class="textwidget">
		  <p><?php printf(__('This is <strong>"%1$s"</strong> widget area. Visit your <a href="%2$s">Widgets Page</a> to add new widget to this area.', 'primathemes'), __('Footer Widget #1', 'primathemes'), admin_url('widgets.php')); ?></p>
		  </div>
		</div>
	  <?php endif; ?>
	  </div>
	<?php endif; ?>
	
	<?php if( (int)prima_get_setting('footer_widgets') >= 20 ) : ?>
	  <div class="footer-widget-2">
	  <?php if ( is_active_sidebar( 'footer-widget-2' ) ) : ?> 
		<?php dynamic_sidebar( 'footer-widget-2' ); ?>
	  <?php else : ?>
		<div class="widget widget-container widget_text">
		  <h3 class="widget-title"><?php _e('Footer Widget #2', 'primathemes'); ?></h3>
		  <div class="textwidget">
		  <p><?php printf(__('This is <strong>"%1$s"</strong> widget area. Visit your <a href="%2$s">Widgets Page</a> to add new widget to this area.', 'primathemes'), __('Footer Widget #2', 'primathemes'), admin_url('widgets.php')); ?></p>
		  </div>
		</div>
	  <?php endif; ?>
	  </div>
	<?php endif; ?>
	
	<?php if( (int)prima_get_setting('footer_widgets') >= 30 ) : ?>
	  <div class="footer-widget-3">
	  <?php if ( is_active_sidebar( 'footer-widget-3' ) ) : ?> 
		<?php dynamic_sidebar( 'footer-widget-3' ); ?>
	  <?php else : ?>
		<div class="widget widget-container widget_text">
		  <h3 class="widget-title"><?php _e('Footer Widget #3', 'primathemes'); ?></h3>
		  <div class="textwidget">
		  <p><?php printf(__('This is <strong>"%1$s"</strong> widget area. Visit your <a href="%2$s">Widgets Page</a> to add new widget to this area.', 'primathemes'), __('Footer Widget #3', 'primathemes'), admin_url('widgets.php')); ?></p>
		  </div>
		</div>
	  <?php endif; ?>
	  </div>
	<?php endif; ?>
	
	<?php if( (int)prima_get_setting('footer_widgets') >= 40 ) : ?>
	  <div class="footer-widget-4">
	  <?php if ( is_active_sidebar( 'footer-widget-4' ) ) : ?> 
		<?php dynamic_sidebar( 'footer-widget-4' ); ?>
	  <?php else : ?>
		<div class="widget widget-container widget_text">
		  <h3 class="widget-title"><?php _e('Footer Widget #4', 'primathemes'); ?></h3>
		  <div class="textwidget">
		  <p><?php printf(__('This is <strong>"%1$s"</strong> widget area. Visit your <a href="%2$s">Widgets Page</a> to add new widget to this area.', 'primathemes'), __('Footer Widget #4', 'primathemes'), admin_url('widgets.php')); ?></p>
		  </div>
		</div>
	  <?php endif; ?>
	  </div>
	<?php endif; ?>
	
	</div>
  </footer>
  
