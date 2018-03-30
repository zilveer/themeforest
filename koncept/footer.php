<?php
/**
 * The footer of the theme
 */
?>

		<!-- Inner Wrapper End -->
		</article>

	<!-- Main Wrapper End -->
	</div>

	<!-- Footer Start -->
	<footer id="footer" class="clearfix">

		<div class="wrapper clearfix">

			<?php if ( is_active_sidebar( 'krown_footer_widget' ) ) {
				dynamic_sidebar( 'krown_footer_widget' );
			} ?>

		</div>

	</footer>
	<!-- Footer End -->

	<!-- GTT Button -->
	<a id="top" href="#"><?php echo krown_svg( 'arrow_up' ); ?></a> 

	<!-- IE7 Message Start -->
	<div id="oldie">
		<p><?php _e('This is a unique website which will require a more modern browser to work!', 'krown'); ?><br /><br />
		<a href="https://www.google.com/chrome/" target="_blank"><?php _e('Please upgrade today!', 'krown'); ?></a>
		</p>
	</div>
	<!-- IE7 Message End -->

	<?php wp_footer(); ?>

</body>
</html>