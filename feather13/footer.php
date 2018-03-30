	<div class="clear"></div>
	<footer id="footer" class="fix">
		
		<?php if(wpb_option('footer-contact-enable')): ?>
		<div id="footer-contact">
			<div class="container fix">
				<?php if(wpb_option('footer-address')) { echo '<p id="contact-address">'.wpb_option('footer-address').'</p>'; } ?>
				<?php if(wpb_option('footer-phone')) { echo '<p id="contact-phone">'.wpb_option('footer-phone').'</p>'; } ?>
				<?php if(wpb_option('footer-email')) { echo '<p id="contact-email"><a href="mailto:'.wpb_option('footer-email').'">'.wpb_option('footer-email').'</a></p>'; } ?>
			</div><!--/footer-contact-->
		</div>
		<?php endif; ?>
		
		<?php if(wpb_option('footer-widgets')): ?>
		<div id="footer-widgets">
			<div class="container fix">
				<div class="one-fourth">
					<ul><?php dynamic_sidebar('widget-footer-1'); ?></ul>
				</div>
				<div class="one-fourth">
					<ul><?php dynamic_sidebar('widget-footer-2'); ?></ul>
				</div>
				<div class="one-fourth">
					<ul><?php dynamic_sidebar('widget-footer-3'); ?></ul>
				</div>
				<div class="one-fourth last">
					<ul><?php dynamic_sidebar('widget-footer-4'); ?></ul>
				</div>
			</div>
		</div><!--/footer-widgets-->
		<?php endif; ?>	

		<div id="footer-bottom">
			<div class="container fix">
				<div class="one-half">
					<p id="copy"><?php echo wpb_footer_text(); ?></p>
				</div>
				<div class="one-half last">
					<a id="to-top" href="#"><i class="icon-top"></i></a>
					<?php echo wpb_social_media_links(array('id'=>'footer-social')); ?>
				</div>
			</div>
		</div><!--/footer-bottom-->
		
	</footer><!--/footer-->
	
</div><!--/wrap-->
<?php wp_footer(); ?>
<!--[if lt IE 9]><script src="<?php echo get_template_directory_uri(); ?>/js/ie/respond.min.js"></script> <![endif]-->
</body>
</html>