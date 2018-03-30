	<div class="clear"></div>
	</div><!--.container-->
	<div id="footer"><footer>
		<div class="container">
			<div id="footer-widget-area"><?php if ( ! dynamic_sidebar( 'Footer' ) ) : ?><!--Wigitized Footer--><?php endif ?></div>
		</div><!--.container-->
		<?php if ( function_exists( 'get_option_tree' ) && is_string(get_option_tree( 'copyright' )))  { echo '<div id="copyright" class="clearfix"><div class="container">'.get_option_tree('copyright').'</div></div>'; } ?><!--#copyright-->
	</footer></div><!--#footer-->
</div><!--#main-->
<?php wp_footer(); /* this is used by many Wordpress features and plugins to work properly */ ?>
</body>
</html>