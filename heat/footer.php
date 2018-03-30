<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 * @subpackage Heat
 * @since Heat 1.0
 */
?>

	</div><!-- #main -->
</section><!-- #page -->

	<!-- Footer
    ================================================== -->
	<footer id="colophon" role="contentinfo">

		<div id="site-generator-wrapper">
			<section id="site-generator" class="clearfix">
				<?php
				/*
				 * Print the footer info.
				 */
				$footer_info = ot_get_option( 'footer_info' );
					
				echo $footer_info;
				?>
					
				<?php get_template_part( 'social-accounts' ); // Social accounts ?>
			</section>
		</div><!-- #site-generator-wrapper -->
	</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>