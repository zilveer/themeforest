<?php 
	$fd = etheme_get_option('footer_demo'); 	
	$fbg = etheme_get_option('footer_bg');
	$fcolor = etheme_get_option('footer_text_color');
	$ft = ''; $ft = apply_filters('custom_footer_filter',$ft);
	$custom_footer = etheme_get_custom_field('custom_footer'); 
?>

	<?php if( is_active_sidebar('prefooter') ): ?>
		<footer class="prefooter">
			<div class="container">
				<?php if(is_active_sidebar('prefooter')): ?> 
					<?php dynamic_sidebar('prefooter'); ?>	
				<?php endif; ?>
			</div>
		</footer>
    <?php endif; ?>
    

    <?php if($custom_footer != 'without'): ?>
	
		<?php if((is_active_sidebar('footer10') || $fd) && empty($custom_footer)): ?>
			<footer class="footer text-color-<?php echo $fcolor; ?>" <?php if($fbg != ''): ?>style="background-color:<?php echo $fbg; ?>"<?php endif; ?>>
				<div class="container">
					<?php if(is_active_sidebar('footer10')): ?> 
						<?php dynamic_sidebar('footer10'); ?>	
					<?php else: ?>
						<?php if($fd) etheme_footer_demo('footer10'); ?>
					<?php endif; ?>
				</div>
			</footer>
	    <?php elseif(!empty($custom_footer)): ?>
	        <footer class="footer footer-<?php echo $ft; ?> text-color-<?php echo $fcolor; ?>" <?php if($fbg != ''): ?>style="background-color:<?php echo $fbg; ?>"<?php endif; ?>>
	            <div class="container">
	                <?php echo et_get_block($custom_footer); ?>  
	            </div>
	        </footer>
	    <?php endif; ?>
    <?php endif; ?>
	
	</div> <!-- page wrapper -->
	</div> <!-- template-content -->
	<?php do_action('after_page_wrapper'); ?>
	</div> <!-- template-container -->
	

	<?php
		/* Always have wp_footer() just before the closing </body>
		 * tag of your theme, or you will break many plugins, which
		 * generally use this hook to reference JavaScript files.
		 */

		wp_footer();
	?>
</body>

</html>