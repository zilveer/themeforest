						<?php if(get_option('mvp_footer_leader')) { ?>
							<div id="foot-ad-wrap" class="left relative">
								<?php $foot_ad = get_option('mvp_footer_leader'); if ($foot_ad) { echo html_entity_decode($foot_ad); } ?>
							</div><!--foot-ad-wrap-->
						<?php } ?>
					</div><!--body-main-cont-->
				</div><!--body-main-in-->
			</div><!--body-main-out-->
			<footer id="foot-wrap" class="left relative">
				<div id="foot-top-wrap" class="left relative">
					<div class="body-main-out relative">
						<div class="body-main-in">
							<div id="foot-widget-wrap" class="left relative">
								<?php $footer_info = get_option('mvp_footer_info'); if ($footer_info == "true") { ?>
									<div class="foot-widget left relative">
										<?php if(get_option('mvp_logo_footer')) { ?>
											<div class="foot-logo left realtive">
												<img src="<?php echo esc_url(get_option('mvp_logo_footer')); ?>" alt="<?php bloginfo( 'name' ); ?>" />
											</div><!--foot-logo-->
										<?php } else { ?>
											<div class="foot-logo left realtive">
												<img src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-foot.png" alt="<?php bloginfo( 'name' ); ?>" />
											</div><!--foot-logo-->
										<?php } ?>
										<div class="foot-info-text left relative">
											<?php echo wp_kses_post(get_option('mvp_footer_text')); ?>
										</div><!--footer-info-text-->
										<div class="foot-soc left relative">
											<ul class="foot-soc-list relative">
												<?php if(get_option('mvp_facebook')) { ?>
													<li class="foot-soc-fb">
														<a href="<?php echo esc_url(get_option('mvp_facebook')); ?>" target="_blank"><i class="fa fa-facebook-square fa-2"></i></a>
													</li>
												<?php } ?>
												<?php if(get_option('mvp_twitter')) { ?>
													<li class="foot-soc-twit">
														<a href="<?php echo esc_url(get_option('mvp_twitter')); ?>" target="_blank"><i class="fa fa-twitter-square fa-2"></i></a>
													</li>
												<?php } ?>
												<?php if(get_option('mvp_pinterest')) { ?>
													<li class="foot-soc-pin">
														<a href="<?php echo esc_url(get_option('mvp_pinterest')); ?>" target="_blank"><i class="fa fa-pinterest-square fa-2"></i></a>
													</li>
												<?php } ?>
												<?php if(get_option('mvp_instagram')) { ?>
													<li class="foot-soc-inst">
														<a href="<?php echo esc_url(get_option('mvp_instagram')); ?>" target="_blank"><i class="fa fa-instagram fa-2"></i></a>
													</li>
												<?php } ?>
												<?php if(get_option('mvp_google')) { ?>
													<li class="foot-soc-goog">
														<a href="<?php echo esc_url(get_option('mvp_google')); ?>" target="_blank"><i class="fa fa-google-plus-square fa-2"></i></a>
													</li>
												<?php } ?>
												<?php if(get_option('mvp_youtube')) { ?>
													<li class="foot-soc-yt">
														<a href="<?php echo esc_url(get_option('mvp_youtube')); ?>" target="_blank"><i class="fa fa-youtube-play fa-2"></i></a>
													</li>
												<?php } ?>
												<?php if(get_option('mvp_linkedin')) { ?>
													<li class="foot-soc-link">
														<a href="<?php echo esc_url(get_option('mvp_linkedin')); ?>" target="_blank"><i class="fa fa-linkedin-square fa-2"></i></a>
													</li>
												<?php } ?>
												<?php if(get_option('mvp_tumblr')) { ?>
													<li class="foot-soc-tumb">
														<a href="<?php echo esc_url(get_option('mvp_tumblr')); ?>" target="_blank"><i class="fa fa-tumblr-square fa-2"></i></a>
													</li>
												<?php } ?>
												<?php if(get_option('mvp_rss')) { ?>
													<li class="foot-soc-rss">
														<a href="<?php echo esc_url(get_option('mvp_rss')); ?>" target="_blank"><i class="fa fa-rss-square fa-2"></i></a>
													</li>
												<?php } else { ?>
													<li class="foot-soc-rss">
														<a href="<?php bloginfo('rss_url'); ?>" target="_blank"><i class="fa fa-rss-square fa-2"></i></a>
													</li>
												<?php } ?>
											</ul>
										</div><!--foot-soc-->
									</div><!--foot-widget-->
								<?php } ?>
								<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widget Area')): endif; ?>
							</div><!--foot-widget-wrap-->
						</div><!--body-main-in-->
					</div><!--body-main-out-->
				</div><!--foot-top-->
				<div id="foot-bot-wrap" class="left relative">
					<div class="body-main-out relative">
						<div class="body-main-in">
							<div id="foot-bot" class="left relative">
								<div class="foot-menu relative">
									<?php wp_nav_menu(array('theme_location' => 'footer-menu')); ?>
								</div><!--foot-menu-->
								<div class="foot-copy relative">
									<p><?php echo wp_kses_post(get_option('mvp_copyright')); ?></p>
								</div><!--foot-copy-->
							</div><!--foot-bot-->
						</div><!--body-main-in-->
					</div><!--body-main-out-->
				</div><!--foot-bot-->
			</footer>
		</div><!--body-main-wrap-->
	</div><!--site-wrap-->
</div><!--site-->
<div class="fly-to-top back-to-top">
	<i class="fa fa-angle-up fa-3"></i>
	<span class="to-top-text"><?php _e( 'To Top', 'mvp-text' ); ?></span>
</div><!--fly-to-top-->
<div class="fly-fade">
</div><!--fly-fade-->
<?php wp_footer(); ?>
</body>
</html>