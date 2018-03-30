<?php get_footer('pre'); ?>

<footer>
	<div class="container">
		<div id="footer-right">
			<nav id="footer-nav">
				<?php wp_nav_menu( array( 'container' => '', 'menu_id' => 'footer-nav-list', 'menu_class' => false, 'theme_location' => 'footer', 'menu' => 'footer', 'depth' => 1, 'fallback_cb' => '' ) ); ?>
			</nav>
		</div>
		<div id="footer-left"><?php echo stripslashes(theme_options('footer', 'footer_copyright_text')); ?></div>
	</div>	
</footer>

</div>

<?php wp_footer(); ?>

</body>
</html>