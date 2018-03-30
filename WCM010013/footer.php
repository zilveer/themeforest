<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage TemplateMela
 * @since TemplateMela 1.0
 */
?>
<?php templatemela_content_after(); ?>
</div>
<!-- .main-content-inner -->
</div>
<!-- .main_inner -->
</div>
<!-- #main -->
<?php templatemela_footer_before(); ?>

<footer id="colophon" class="site-footer" role="contentinfo">
  <div class="footer_inner">
    <?php templatemela_footer_inside(); ?>
	<?php if ( is_page_template('page-templates/home.php')):?>
		<div class="footer-logo">
			<?php templatemela_get_widget('brand-logo');?>
		</div>
	<?php endif; ?>
	<div class="footer-block">
		<h3 class="title"> <?php echo get_option('tmoption_Newsletter_title'); ?> </h3><div class="sub-title"> <?php echo get_option('tmoption_Newsletter_sub_title'); ?> </div>
		<?php templatemela_get_widget('footer-block'); ?>
	</div>
    <?php get_sidebar('footer'); ?>
    <div class="footer-bottom">
      <div class="footer-menu-links">
        <?php
					$tm_footer_menu=array(
					'menu' => 'TM Footer Navigation',
					'depth'=> 1,
					'echo' => false,
					'menu_class'      => 'footer-menu', 
					'container'       => '', 
					'container_class' => '', 
					'theme_location' => 'footer-menu'
					);
					echo wp_nav_menu($tm_footer_menu);				    
					?>
      </div>
      <!-- #footer-menu-links -->
      <div class="site-info">  <?php __( 'Copyright', 'templatemela' ); ?> &copy; <?php echo date('Y'); ?> <a href="<?php echo get_option('tmoption_footer_link'); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" target="_blank" rel="home"><?php echo get_option('tmoption_footer_slog');?>
        </a>
        <?php do_action( 'templatemela_credits' ); ?>
      </div>
	  <div class="footer-payment">
	  	<?php templatemela_get_widget('footer-payment'); ?>
	  </div>
      <!-- .site-info -->
    </div>
    <!-- .footer-bottom -->
  </div>
  <!--. Footer inner -->
</footer>
<!-- #colophon -->
<?php templatemela_footer_after(); ?>
</div>
<!-- #page -->
<?php tm_go_top(); ?>
<?php 
if(trim(get_option('tmoption_google_analytics_id'))!=''):?>
<?php endif; ?>
<?php templatemela_get_widget('before-end-body-widget'); ?>
<?php wp_footer(); ?>
</body></html>