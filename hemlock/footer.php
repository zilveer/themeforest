	
	<!-- END CONTAINER -->
	</div>
	
	<?php if(!get_theme_mod('sp_footer_widget_area')) : ?>
	<div id="widget-area">
	
		<div class="container">
			
			<div class="footer-widget-wrapper">
				<?php	/* Widgetised Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer 1') ) ?>
			</div>
			
			<div class="footer-widget-wrapper">
				<?php	/* Widgetised Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer 2') ) ?>
			</div>
			
			<div class="footer-widget-wrapper last">
				<?php	/* Widgetised Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer 3') ) ?>
			</div>
			
		</div>
		
	</div>
	<?php endif; ?>
	
	<div id="footer-instagram">
					
		<?php	/* Widgetised Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer Instagram') ) ?>
					
	</div>
	
	<?php if(!get_theme_mod('sp_footer_social')) : ?>
	<div id="footer-social">
	
		<div class="container">
		
		<?php if(get_theme_mod('sp_facebook')) : ?><a href="http://facebook.com/<?php echo get_theme_mod('sp_facebook'); ?>" target="_blank"><i class="fa fa-facebook"></i> <span>Facebook</span></a><?php endif; ?>
		<?php if(get_theme_mod('sp_twitter')) : ?><a href="http://twitter.com/<?php echo get_theme_mod('sp_twitter'); ?>" target="_blank"><i class="fa fa-twitter"></i> <span>Twitter</span></a><?php endif; ?>
		<?php if(get_theme_mod('sp_instagram')) : ?><a href="http://instagram.com/<?php echo get_theme_mod('sp_instagram'); ?>" target="_blank"><i class="fa fa-instagram"></i> <span>Instagram</span></a><?php endif; ?>
		<?php if(get_theme_mod('sp_pinterest')) : ?><a href="http://pinterest.com/<?php echo get_theme_mod('sp_pinterest'); ?>" target="_blank"><i class="fa fa-pinterest"></i> <span>Pinterest</span></a><?php endif; ?>
		<?php if(get_theme_mod('sp_bloglovin')) : ?><a href="http://bloglovin.com/<?php echo get_theme_mod('sp_bloglovin'); ?>" target="_blank"><i class="fa fa-heart"></i> <span>Bloglovin</span></a><?php endif; ?>
		<?php if(get_theme_mod('sp_google')) : ?><a href="http://plus.google.com/<?php echo get_theme_mod('sp_google'); ?>" target="_blank"><i class="fa fa-google-plus"></i> <span>Google Plus</span></a><?php endif; ?>
		<?php if(get_theme_mod('sp_tumblr')) : ?><a href="http://<?php echo get_theme_mod('sp_tumblr'); ?>.tumblr.com/" target="_blank"><i class="fa fa-tumblr"></i> <span>Tumblr</span></a><?php endif; ?>
		<?php if(get_theme_mod('sp_youtube')) : ?><a href="http://youtube.com/<?php echo get_theme_mod('sp_youtube'); ?>" target="_blank"><i class="fa fa-youtube-play"></i> <span>Youtube</span></a><?php endif; ?>
		<?php if(get_theme_mod('sp_linkedin')) : ?><a href="<?php echo get_theme_mod('sp_linkedin'); ?>" target="_blank"><i class="fa fa-linkedin"></i> <span>Linkedin</span></a><?php endif; ?>
		<?php if(get_theme_mod('sp_snapchat')) : ?><a href="https://snapchat.com/add/<?php echo get_theme_mod('sp_snapchat'); ?>" target="_blank"><i class="fa fa-snapchat-ghost"></i> <span>Snapchat</span></a><?php endif; ?>
		<?php if(get_theme_mod('sp_rss')) : ?><a href="<?php echo get_theme_mod('sp_rss'); ?>" target="_blank"><i class="fa fa-rss"></i> <span>RSS</span></a><?php endif; ?>
		
		</div>
		
	</div>
	<?php endif; ?>
	
	<?php if(!get_theme_mod('sp_footer_logo_area')) : ?>
	<div id="footer-logo">
		
		<div class="container">
			
			<?php if(get_theme_mod('sp_footer_logo')) : ?>
				<img src="<?php echo get_theme_mod('sp_footer_logo'); ?>" alt="<?php bloginfo( 'name' ); ?>" />
			<?php endif; ?>
			
			<?php if(get_theme_mod('sp_footer_text')) : ?>
				<p><?php echo get_theme_mod('sp_footer_text'); ?></p>
			<?php endif; ?>
			
		</div>
		
	</div>
	<?php endif; ?>
	
	<footer id="footer-copyright">
		
		<div class="container">
		
			<?php if(get_theme_mod('sp_footer_copyright')) : ?>
				<p><?php echo get_theme_mod('sp_footer_copyright');  ?></p>
			<?php endif; ?>
			<a href="#" class="to-top"><?php _e( 'Back to top', 'solopine' ); ?> <i class="fa fa-angle-double-up"></i></a>
			
		</div>
		
	</footer>
	
	<?php wp_footer(); ?>
	
</body>

</html>