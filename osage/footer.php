	<footer id="footer-wrapper">
		<div id="footer">
			<?php if(get_option('mvp_footer_leader')) { ?>
				<div id="footer-leaderboard">
					<?php $ad970 = get_option('mvp_footer_leader'); if ($ad970) { echo stripslashes($ad970); } ?>
				</div><!--footer-leaderboard-->
			<?php } ?>
			<div id="footer-nav">
				<?php wp_nav_menu(array('theme_location' => 'footer-menu')); ?>
			</div><!--footer-nav-->
			<div id="footer-widget-wrapper">
				<?php $footer_info = get_option('mvp_footer_info'); if ($footer_info == "true") { ?>
					<div class="footer-widget">
						<?php if(get_option('mvp_logo_footer')) { ?>
							<div id="logo-footer">
								<img src="<?php echo get_option('mvp_logo_footer'); ?>" alt="<?php bloginfo( 'name' ); ?>" />
							</div><!--logo-footer-->
						<?php } else { ?>
							<div id="logo-footer">
								<img src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-footer.png" alt="<?php bloginfo( 'name' ); ?>" />
							</div><!--logo-footer-->
						<?php } ?>
						<div class="footer-info-text">
							<?php echo get_option('mvp_footer_text'); ?>
						</div><!--footer-info-text-->
						<div id="footer-social">
							<ul>
								<?php if(get_option('mvp_facebook')) { ?>
								<li class="fb-item">
									<a href="<?php echo get_option('mvp_facebook'); ?>" alt="Facebook" class="fb-but2" target="_blank"></a>
								</li>
								<?php } ?>
								<?php if(get_option('mvp_twitter')) { ?>
								<li class="twitter-item">
									<a href="<?php echo get_option('mvp_twitter'); ?>" alt="Twitter" class="twitter-but2" target="_blank"></a>
								</li>
								<?php } ?>
								<?php if(get_option('mvp_pinterest')) { ?>
								<li class="pinterest-item">
									<a href="<?php echo get_option('mvp_pinterest'); ?>" alt="Pinterest" class="pinterest-but2" target="_blank"></a>
								</li>
								<?php } ?>
								<?php if(get_option('mvp_google')) { ?>
								<li class="google-item">
									<a href="<?php echo get_option('mvp_google'); ?>" alt="Google Plus" class="google-but2" target="_blank"></a>
								</li>
								<?php } ?>
								<?php if(get_option('mvp_instagram')) { ?>
								<li class="instagram-item">
									<a href="<?php echo get_option('mvp_instagram'); ?>" alt="Instagram" class="instagram-but2" target="_blank"></a>
								</li>
								<?php } ?>
								<?php if(get_option('mvp_youtube')) { ?>
								<li class="youtube-item">
									<a href="<?php echo get_option('mvp_youtube'); ?>" alt="YouTube" class="youtube-but2" target="_blank"></a>
								</li>
								<?php } ?>
								<?php if(get_option('mvp_linkedin')) { ?>
								<li class="linkedin-item">
									<a href="<?php echo get_option('mvp_linkedin'); ?>" alt="Linkedin" class="linkedin-but2" target="_blank"></a>
								</li>
								<?php } ?>
								<?php if(get_option('mvp_rss')) { ?>
								<li><a href="<?php echo get_option('mvp_rss'); ?>" alt="RSS Feed" class="rss-but2"></a></li>
								<?php } else { ?>
								<li><a href="<?php bloginfo('rss_url'); ?>" alt="RSS Feed" class="rss-but2"></a></li>
								<?php } ?>
							</ul>
						</div><!--footer-social-->
						<div id="copyright">
							<p><?php echo get_option('mvp_copyright'); ?></p>
						</div><!--copyright-->
					</div><!--footer-widget-->
				<?php } ?>
				<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widget Area')): endif; ?>
			</div><!--footer-widget-wrapper-->
		</div><!--footer-->
	</footer>
</div><!--boxed-wrapper-->
</div><!--site-->

<?php wp_footer(); ?>

</body>
</html>