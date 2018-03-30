		
		
		<!-- END CONTENT -->
		</div>
		
	<!-- END CONTAINER -->
	</div>
	
	<footer id="footer">
		
		
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
				<?php if(get_theme_mod('sp_dribbble')) : ?><a href="http://dribbble.com/<?php echo get_theme_mod('sp_dribbble'); ?>" target="_blank"><i class="fa fa-dribbble"></i> <span>Dribbble</span></a><?php endif; ?>
				<?php if(get_theme_mod('sp_soundcloud')) : ?><a href="http://soundcloud.com/<?php echo get_theme_mod('sp_soundcloud'); ?>" target="_blank"><i class="fa fa-soundcloud"></i> <span>Soundcloud</span></a><?php endif; ?>
				<?php if(get_theme_mod('sp_vimeo')) : ?><a href="http://vimeo.com/<?php echo get_theme_mod('sp_vimeo'); ?>" target="_blank"><i class="fa fa-vimeo-square"></i> <span>Vimeo</span></a><?php endif; ?>
				<?php if(get_theme_mod('sp_linkedin')) : ?><a href="<?php echo get_theme_mod('sp_linkedin'); ?>" target="_blank"><i class="fa fa-linkedin"></i> <span>Linkedin</span></a><?php endif; ?>
				<?php if(get_theme_mod('sp_rss')) : ?><a href="<?php echo get_theme_mod('sp_rss'); ?>" target="_blank"><i class="fa fa-rss"></i> <span>RSS</span></a><?php endif; ?>
			
			</div>
			
		</div>
		<?php endif; ?>
		
		<div id="footer-copyright">
			
			<div class="container">

				<span class="left"><?php echo wp_kses_post(get_theme_mod('sp_footer_copyright', '&copy; 2015 - Solo Pine. All Rights Reserved. Designed & Developed by <a href="http://solopine.com">SoloPine.com</a>')); ?></span>
				<a href="#" class="to-top"><?php _e( 'Back to top', 'solopine' ); ?> <i class="fa fa-angle-double-up"></i></a>
				
			</div>
			
		</div>
		
	</footer>
	
	<?php wp_footer(); ?>
</body>

</html>