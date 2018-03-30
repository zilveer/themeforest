	</div><!--End Content Container -->

	<div id="footer-container">
		<div class="footer-text">
			<p class="copyright"><?php echo stripslashes(get_option("ocmx_custom_footer")); ?></p>
			<?php if( get_option("ocmx_logo_hide") != "true") : ?>
				<div class="obox-credit">
					<p><a href="http://oboxthemes.com/blogging">WordPress Blogging Theme</a> by <a href="http://www.oboxthemes.com">Obox</a></p>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php get_sidebar(); ?>
<?php wp_footer(); ?>
<!--Get Google Analytics -->
<?php
	if(get_option("ocmx_google_analytics")) :
		echo stripslashes(get_option("ocmx_google_analytics"));
	endif;
?>

</body>
</html>