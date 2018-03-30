<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 */
?>
<?php do_action('output_layout','end'); ?>
	</div><!-- #main .wrapper -->

	<footer id="footer" role="contentinfo">
		<div class="top-border clear"></div>
		<div class="footer-content entry-content page-width">
			<?php 
			
			// Footer Content
			echo wpautop(stripslashes(htmlspecialchars_decode(get_options_data('content-options', 'footer-content')))); 

			?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>