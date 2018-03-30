<div id="footer">
	<footer>
		<?php if(of_get_option('footer_phone') != "") { ?><div id="footer-label">
			<div class="internal heading-style">
				<?php if(of_get_option('footer_text') != "") { ?><?php echo of_get_option('footer_text') ?><br/><?php } ?>
				<span class="number"><?php echo of_get_option('footer_phone') ?></span>
			</div>
		</div><?php 
		} ?>
		<div class="footer-inner">
			
			<div class="one-third float-left">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 1') ) : ?><?php endif; ?>
			</div>

			<div class="one-third float-left">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 2') ) : ?><?php endif; ?>
			</div>
			
			<div class="one-third last float-left">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 3') ) : ?><?php endif; ?>
			</div>
			
			<div class="clear"></div>
		</div>
	</footer>
	</div>
</div>
<?php if(of_get_option('scripts') <> ""){ echo of_get_option('scripts'); } ?>
<?php wp_footer() ?>
</body>
</html>