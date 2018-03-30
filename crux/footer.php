<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package StagFramework
 * @subpackage Crux
 */
?>
		</div><!-- #content -->
	</div><!-- .content-wrapper -->

	<?php
		/**
		 * @hooked stag_display_static_content() - Displays static content in footer.
		 */
		do_action( 'before_footer' );
	?>

	<footer id="colophon" class="site-footer"<?php stag_markup_helper( array( 'context' => 'footer' ) ); ?>>

		<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
			<div class="inside">
				<div class="grids footer-widget-area">
					<?php dynamic_sidebar( 'sidebar-2' ); ?>
				</div>
			</div>
		<?php endif; ?>

		<?php if ( has_nav_menu( 'footer' ) ) : ?>
		<nav class="footer-menu-wrapper"<?php stag_markup_helper( array( 'context' => 'nav' ) ); ?>>
			<?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_class' => 'footer-menu navigation', 'container' => false ) ); ?>
		</nav>
		<?php endif; ?>

		<?php
		$footer_text = stag_get_option('general_footer_text');
		if ( $footer_text != '' ) :
		?>
		<div class="site-info">
			<div class="inside">
				<?php echo stripslashes($footer_text); ?>
			</div>
		</div><!-- .site-info -->
		<?php endif; ?>

	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
