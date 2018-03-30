	<?php $fd = etheme_get_option('footer_demo'); ?>	
	<?php $ft = ''; $ft = apply_filters('custom_footer_filter',$ft); ?>
    <?php global $etheme_responsive; ?>

	<?php if(is_active_sidebar('prefooter')): ?>
		<div class="prefooter prefooter-<?php echo $ft; ?>">
			<div class="container">
				<div class="double-border">
	                <?php if ( !is_active_sidebar( 'prefooter' ) ) : ?>
	               		<?php //if($fd) etheme_footer_demo('prefooter'); ?>
	                <?php else: ?>
	                    <?php dynamic_sidebar( 'prefooter' ); ?>
	                <?php endif; ?>   
				</div>
			</div>
		</div>
	<?php endif; ?>


	<?php if(is_active_sidebar('footer1') ): ?>
		<div class="footer-top footer-top-<?php echo $ft; ?>">
			<div class="container">
				<div class="double-border">
	                <?php if ( !is_active_sidebar( 'footer1' ) ) : ?>
	               		<?php if($fd) etheme_footer_demo('footer1'); ?>
	                <?php else: ?>
	                    <?php dynamic_sidebar( 'footer1' ); ?>
	                <?php endif; ?>   
				</div>
			</div>
		</div>
	<?php endif; ?>
	<?php if(is_active_sidebar('footer2') || $fd): ?>
		<footer class="footer footer-bottom-<?php echo $ft; ?>">
			<div class="container">
                <?php if ( !is_active_sidebar( 'footer2' ) ) : ?>
               		<?php if($fd) etheme_footer_demo('footer2'); ?>
                <?php else: ?>
                    <?php dynamic_sidebar( 'footer2' ); ?>
                <?php endif; ?> 
			</div>
		</footer>
	<?php endif; ?>

	<?php if(is_active_sidebar('footer9') || is_active_sidebar('footer10') || $fd): ?>
		<div class="copyright copyright-<?php echo $ft; ?>">
			<div class="container">
				<div class="row-fluid">
					<div class="span6">
						<?php if(is_active_sidebar('footer9')): ?> 
							<?php dynamic_sidebar('footer9'); ?>	
						<?php else: ?>
							<?php if($fd) etheme_footer_demo('footer9'); ?>
						<?php endif; ?>
					</div>

					<div class="span6 a-right">
						<?php if(is_active_sidebar('footer10')): ?> 
							<?php dynamic_sidebar('footer10'); ?>	
						<?php else: ?>
							<?php if($fd) etheme_footer_demo('footer10'); ?>
						<?php endif; ?>
					</div>
				</div>
	            <div class="row-fluid">
	                <?php if(etheme_get_option('responsive')): ?>
	                	<div class="span12 responsive-switcher a-center visible-phone visible-tablet <?php if(!$etheme_responsive) echo 'visible-desktop'; ?>">
	                    	<?php if($etheme_responsive): ?>
	                    		<a href="<?php echo home_url(); ?>/?responsive=off"><i class="icon-mobile-phone"></i></a> <?php _e('Mobile version',  ETHEME_DOMAIN) ?>: 
	                    		<a href="<?php echo home_url(); ?>/?responsive=off"><?php _e('Enabled',  ETHEME_DOMAIN) ?></a>
	                    	<?php else: ?>
	                    		<a href="<?php echo home_url(); ?>/?responsive=on"><i class="icon-mobile-phone"></i></a> <?php _e('Mobile version',  ETHEME_DOMAIN) ?>: 
	                    		<a href="<?php echo home_url(); ?>/?responsive=on"><?php _e('Disabled',  ETHEME_DOMAIN) ?></a>
	                    	<?php endif; ?>
	                	</div>
	                <?php endif; ?>  
	            </div>
			</div>
		</div>
	<?php endif; ?>

	</div> <!-- page wrapper -->
	<?php if (etheme_get_option('to_top')): ?>
		<div class="back-to-top">
			<span><?php _e('Back to top', ETHEME_DOMAIN) ?></span>
		</div>
	<?php endif ?>

	<?php do_action('after_page_wrapper'); ?>

	<?php
		/* Always have wp_footer() just before the closing </body>
		 * tag of your theme, or you will break many plugins, which
		 * generally use this hook to reference JavaScript files.
		 */

		wp_footer();
	?>
</body>


</html>