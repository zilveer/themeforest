<?php global $theme_prefix; ?>
<div class="footer-container margint40 clearfix">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-sm-3">
				<?php if ( is_active_sidebar('footer-1') ) { ?>
                    <?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-1')) :  ?>
                        <div class="no-widget"><a href="wp-admin/widgets.php"><?php echo __("Please Add Widget <a href='wp-admin/widgets.php'>here</a>","2035Themes-fm") ?></a></div>
                    <?php endif; ?>
                <?php } ?>
			</div>		
			<div class="col-lg-3 col-sm-3">
				<?php if ( is_active_sidebar('footer-2') ) { ?>
                    <?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-2')) :  ?>
                        <div class="no-widget"><a href="wp-admin/widgets.php"><?php echo __("Please Add Widget <a href='wp-admin/widgets.php'>here</a>","2035Themes-fm") ?></a></div>
                    <?php endif; ?>
                <?php } ?>
			</div>		
			<div class="col-lg-3 col-sm-3">
				<?php if ( is_active_sidebar('footer-3') ) { ?>
                    <?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-3')) :  ?>
                        <div class="no-widget"><a href="wp-admin/widgets.php"><?php echo __("Please Add Widget <a href='wp-admin/widgets.php'>here</a>","2035Themes-fm") ?></a></div>
                    <?php endif; ?>
                <?php } ?>
			</div>	
			<div class="col-lg-3 col-sm-3">
				<?php if ( is_active_sidebar('footer-4') ) { ?>
                    <?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-4')) :  ?>
                        <div class="no-widget"><a href="wp-admin/widgets.php"><?php echo __("Please Add Widget <a href='wp-admin/widgets.php'>here</a>","2035Themes-fm") ?></a></div>
                    <?php endif; ?>
                <?php } ?>
			</div>
		</div>
	</div>
</div>
<a href="#" class="scrollup"><i class="fa fa-angle-up"></i><span class="hide-mobile"><?php echo __("Top","2035Themes-fm"); ?></span></a>
<?php wp_footer(); ?>
</body>
</html>