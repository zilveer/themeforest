<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main section and all content after
 *
 */
?>
		<?php wolf_content_end(); ?>
		</div><!-- .site-wrapper -->
	</div><!-- #main -->
	<?php wolf_content_after(); ?>

	</div><!-- #page-container -->

	<?php wolf_footer_before(); ?>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="footer-inner clearfix">
			<?php wolf_footer_start(); ?>

			<?php get_sidebar( 'footer' ); ?>

			<div class="footer-end wrap">
				<?php wolf_footer_end(); ?>
			</div>
		</div>
		<div class="clear"></div>
		<?php wolf_site_info(); ?>
	</footer><!-- footer#colophon .site-footer -->

	<?php wolf_footer_after(); ?>
</div><!-- #page .hfeed .site -->
</div><!-- .site-container -->

<?php wolf_body_end(); ?>
<?php wp_footer(); ?>
</body>
</html>