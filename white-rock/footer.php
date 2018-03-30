<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package progression
 * @since progression 1.0
 */
?>

<div class="clearfix"></div>
</div><!-- close .width-container -->


<?php if(of_get_option('footer_widgets', '1')): ?>
<div class="widget-area-highlight">
<div class="width-container">
	<div id="footer-widgets">
		
		<div class="footer-<?php echo of_get_option('footer_widgets_column', '4'); ?>-column">
			
			<?php if ( ! dynamic_sidebar( 'Footer Widgets' ) ) : ?>
			<?php endif; // end sidebar widget area ?>

			<div class="clearfix"></div>
		</div><!-- close footer-count -->
		
	</div><!-- close #footer-widgets -->
<div class="clearfix"></div>
</div><!-- close .width-container -->
</div><!-- close .widget-area-highlight -->

<?php endif; ?>


<div class="clearfix"></div>
</div><!-- close #main -->


<footer>
	<div class="width-container">
		
		<div id="copyright">
			<div class="grid2column">
			<?php if(of_get_option('footer_logo', 'get_template_directory_uri() . "/images/logo-footer.png"')): ?>
				<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" id="footer-logo"><img src="<?php echo of_get_option('footer_logo', get_template_directory_uri() . '/images/logo-footer.png'); ?>" width="<?php echo of_get_option('footer_logo_width', '150'); ?>" alt="<?php bloginfo('name'); ?>"></a>
			<?php endif; ?>
			
			<?php if(of_get_option('footer_text')): ?>
				<div id="footer-text"><?php echo of_get_option('footer_text'); ?></div>
			<?php endif; ?>
			
			</div>
			
			<div class="grid2column lastcolumn">
				<?php wp_nav_menu( array('theme_location' => 'footer', 'depth' => 1, 'menu_class' => 'footer-menu') ); ?>
			</div>
		<div class="clearfix"></div>
		</div><!-- close #copyright -->
		
	<div class="clearfix"></div>
	</div><!-- close .width-container -->
</footer>
<?php wp_footer(); ?>

<?php if(of_get_option('custom_js')): ?>
	<?php echo '<script type="text/javascript">'; ?>
	<?php echo of_get_option('custom_js'); ?>
	<?php echo '</script>'; ?>
<?php endif; ?>
<?php if(of_get_option('tracking_code')): ?>
	<?php echo '<script type="text/javascript">'; ?>
	<?php echo of_get_option('tracking_code'); ?>
	<?php echo '</script>'; ?>
<?php endif; ?>
</body>
</html>