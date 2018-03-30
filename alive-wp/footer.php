<?php
/**
 * The template for displaying the footer.
 *
 */
?>
			
			<!--start footer-->
			<div id="footer">
				 <?php echo of_get_option("copyright"); ?>  
				
				<!--start social icons-->

				<?php $social_icons = of_get_option("social_icons"); 
		
				if ($social_icons['facebook'] == "1") : ?>
				<div class="iconContainer alignRight" >
					<a href="<?php echo of_get_option("facebook_url"); ?>" target="_blank">
					<img class="_rolloverSocial" src="<?php echo THEME_URL; ?>/images/social/facebook_h.png" alt="rollover"/></a>
					<img  src="<?php echo THEME_URL; ?>/images/social/facebook.png" alt="icon"/>      

				</div>
				
				<?php endif; if ($social_icons['twitter'] == "1") : ?>
				<div class="iconContainer alignRight" >
					<a href="<?php echo of_get_option("twitter_url"); ?>" target="_blank">
					<img class="_rolloverSocial" src="<?php echo THEME_URL; ?>/images/social/twitter_h.png" alt="rollover"/></a>
					<img  src="<?php echo THEME_URL; ?>/images/social/twitter.png" alt="icon"/>    
				</div>
				
				<?php endif; if ($social_icons['myspace'] == "1") : ?>
				<div class="iconContainer alignRight" >
					<a href="<?php echo of_get_option("myspace_url"); ?>" target="_blank">
					<img class="_rolloverSocial" src="<?php echo THEME_URL; ?>/images/social/myspace_h.png" alt="rollover"/></a>
					<img  src="<?php echo THEME_URL; ?>/images/social/myspace.png" alt="icon"/>    
				</div>
				
				<?php endif; if ($social_icons['flickr'] == "1") : ?>
				<div class="iconContainer alignRight" >
					<a href="<?php echo of_get_option("flickr_url"); ?>" target="_blank">
					<img class="_rolloverSocial" src="<?php echo THEME_URL; ?>/images/social/flickr_h.png" alt="rollover"/></a>
					<img  src="<?php echo THEME_URL; ?>/images/social/flickr.png" alt="icon"/>    
				</div>
				
				<?php endif; if ($social_icons['youtube'] == "1") : ?>
				<div class="iconContainer alignRight" >
					<a href="<?php echo of_get_option("youtube_url"); ?>" target="_blank">
					<img class="_rolloverSocial" src="<?php echo THEME_URL; ?>/images/social/youtube_h.png" alt="rollover"/></a>
					<img  src="<?php echo THEME_URL; ?>/images/social/youtube.png" alt="icon"/>    
				</div>
				
				<?php endif; if ($social_icons['vimeo'] == "1") : ?>				
				<div class="iconContainer alignRight" >
					<a href="<?php echo of_get_option("vimeo_url"); ?>" target="_blank">
					<img class="_rolloverSocial" src="<?php echo THEME_URL; ?>/images/social/vimeo_h.png" alt="rollover"/></a>
					<img  src="<?php echo THEME_URL; ?>/images/social/vimeo.png" alt="icon"/>    
				</div>
								
				<?php endif; if ($social_icons['rss'] == "1") : ?>
				<div class="iconContainer alignRight" >
					<a class="external" href="<?php bloginfo('rss_url'); ?>" target="_blank">
					<img class="_rolloverSocial" src="<?php echo THEME_URL; ?>/images/social/rss_h.png" alt="rollover"/></a>
					<img  src="<?php echo THEME_URL; ?>/images/social/rss.png" alt="icon"/>    
				</div>
				
				<?php endif; ?>
	
				<!--end social icons-->
				
			</div>
			<!--end footer-->
		</div>
		<!--end content-->
	</div>
	<!--end contentWrapper-->
	
	<?php if(of_get_option("music_toggle") == 1) { ?>
		
				<div id="musicPlayer">
					<div id="jquery_jplayer_1" class="jp-jplayer"></div>
						<div id="jp_container_1" class="jp-audio">
							<div class="jp-type-playlist">
								<div class="jp-gui jp-interface">
									<ul class="jp-controls">
										<li><a href="javascript:;" class="jp-previous" tabindex="1">previous</a></li>
										<li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
										<li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
										<li><a href="javascript:;" class="jp-next" tabindex="1">next</a></li>
										<li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li>
									</ul>
								</div>
								<div class="jp-playlist">
									<ul>
										<li></li>
									</ul>
								</div>
							</div>
						</div>	
					</div>
				</div>
		<?php } ?>
</div>
<!--end wrapper-->






<?php wp_footer(); ?>
<script type="text/javascript">
<?php echo of_get_option("custom_js"); ?>
</script>
</body>
</html>