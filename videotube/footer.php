<?php if( !defined('ABSPATH') ) exit;?>
	<div id="footer">
		<div class="container">
			<div class="row">
				<?php dynamic_sidebar('mars-footer-sidebar');?>
			</div>
			<div class="copyright">
				<?php do_action('mars_copyright');?>
            </div>
		</div>
	</div><!-- /#footer -->
    <?php wp_footer();?> 
</body>
</html>