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
</div><!-- close #main -->


<?php if( is_page_template('homepage.php') ): ?>
	<?php if ( is_active_sidebar( 'homepage-widgets' ) ) : ?>
		<?php dynamic_sidebar( 'homepage-widgets' ); ?>
	<?php endif; ?>
<?php endif; ?>

<?php if ( is_active_sidebar( 'homepage-all-widgets' ) ) : ?>
	<?php dynamic_sidebar( 'homepage-all-widgets' ); ?>
<?php endif; ?>

<div id="widget-area">
	<div class="width-container footer-<?php echo get_theme_mod('footer_cols', '4'); ?>-column">
		<?php if ( ! dynamic_sidebar( 'Footer Widgets' ) ) : ?>
		<?php endif; // end sidebar widget area ?>
	</div>
	<div class="clearfix"></div>
</div>

<footer>
	<div id="copyright">
		<div class="width-container">
			<?php echo get_theme_mod( 'copyright_textbox', '&copy; 2014 All Rights Reserved. Developed by ProgressionStudios' ); ?>
		</div><!-- close .width-container -->
		<div class="clearfix"></div>
	</div><!-- close #copyright -->
</footer>
<?php wp_footer(); ?>
</body>
</html>