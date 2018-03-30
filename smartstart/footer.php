<?php if ( is_active_sidebar('left-footer-widget-area') ): ?>

	<footer id="footer" class="clearfix">

		<div class="container">

			<div class="three-fourth">

				<?php dynamic_sidebar('left-footer-widget-area'); ?>
				
			</div><!-- end .three-fourth -->

			<div class="one-fourth last">

				<?php dynamic_sidebar('right-footer-widget-area'); ?>

			</div><!-- end .one-fourth.last -->
			
		</div><!-- end .container -->

	</footer><!-- end #footer -->

<?php endif; ?>

<?php if( of_get_option('ss_footer_bottom') ): ?>

	<footer id="footer-bottom" class="clearfix">

		<div class="container">

			<?php echo of_get_option('ss_footer_bottom'); ?>

		</div><!-- end .container -->

	</footer><!-- end #footer-bottom -->

<?php endif; ?>

<?php wp_footer(); ?>

<?php do_action('ss_framework_custom_scripts'); ?>

</body>
</html>