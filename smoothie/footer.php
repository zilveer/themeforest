				</div><!-- main -->

			<div id="footer" class="clearfix">
				<div class="footer-inner">
						<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Column 1') && dynamic_sidebar('Footer Column 2') && dynamic_sidebar('Footer Column 3') && dynamic_sidebar('Footer Column 4')) : else : ?>		
						<?php endif; ?>
					
					<div class="clear"></div>
                    <?php if ( of_get_option('of_copyright') == true) { ?>
                    <p class="copyright"><?php echo of_get_option('of_copyright', 'no entry' ); ?></p>
                    <?php } else {?>
					<p class="copyright">&copy; <?php echo date("Y"); ?> <a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a> | <?php bloginfo('description'); ?></p>
                    <?php } ?>
				</div>
            </div><!--footer-->
        </div><!-- wrapper -->
    </div><!--backgrimage-->
	<!-- google analytics code -->
	<?php if (of_get_option('of_tracking_code') == true) { ?>
		<?php echo of_get_option('of_tracking_code', 'no entry' ); ?>
	<?php } ?>
	
	<?php wp_footer(); ?>

</body>
</html>