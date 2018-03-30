<div id="fly-wrap">
	<div class="fly-wrap-out">
		<div class="fly-side-wrap">
			<ul class="fly-bottom-soc left relative">
				<?php if(get_option('ht_facebook')) { ?>
					<li class="fb-soc">
						<a href="<?php echo esc_url(get_option('ht_facebook')); ?>" target="_blank">
						<i class="fa fa-facebook-square fa-2"></i>
						</a>
					</li>
				<?php } ?>
				<?php if(get_option('ht_twitter')) { ?>
					<li class="twit-soc">
						<a href="<?php echo esc_url(get_option('ht_twitter')); ?>" target="_blank">
						<i class="fa fa-twitter fa-2"></i>
						</a>
					</li>
				<?php } ?>
				<?php if(get_option('ht_pinterest')) { ?>
					<li class="pin-soc">
						<a href="<?php echo esc_url(get_option('ht_pinterest')); ?>" target="_blank">
						<i class="fa fa-pinterest fa-2"></i>
						</a>
					</li>
				<?php } ?>
				<?php if(get_option('ht_instagram')) { ?>
					<li class="inst-soc">
						<a href="<?php echo esc_url(get_option('ht_instagram')); ?>" target="_blank">
						<i class="fa fa-instagram fa-2"></i>
						</a>
					</li>
				<?php } ?>
				<?php if(get_option('ht_google')) { ?>
					<li class="goog-soc">
						<a href="<?php echo esc_url(get_option('ht_google')); ?>" target="_blank">
						<i class="fa fa-google-plus fa-2"></i>
						</a>
					</li>
				<?php } ?>
				<?php if(get_option('ht_youtube')) { ?>
					<li class="yt-soc">
						<a href="<?php echo esc_url(get_option('ht_youtube')); ?>" target="_blank">
						<i class="fa fa-youtube-play fa-2"></i>
						</a>
					</li>
				<?php } ?>
				<?php if(get_option('ht_linkedin')) { ?>
					<li class="link-soc">
						<a href="<?php echo esc_url(get_option('ht_linkedin')); ?>" target="_blank">
						<i class="fa fa-linkedin fa-2"></i>
						</a>
					</li>
				<?php } ?>
				<?php if(get_option('ht_tumblr')) { ?>
					<li class="tum-soc">
						<a href="<?php echo esc_url(get_option('ht_tumblr')); ?>" target="_blank">
						<i class="fa fa-tumblr fa-2"></i>
						</a>
					</li>
				<?php } ?>
				<?php if(get_option('ht_rss')) { ?>
					<li class="rss-soc">
						<a href="<?php echo esc_url(get_option('ht_rss')); ?>" target="_blank">
						<i class="fa fa-rss fa-2"></i>
						</a>
					</li>
				<?php } else { ?>
					<li class="rss-soc">
						<a href="<?php bloginfo('rss_url'); ?>" target="_blank">
						<i class="fa fa-rss fa-2"></i>
						</a>
					</li>
				<?php } ?>
			</ul>
		</div><!--fly-side-wrap-->
		<div class="fly-wrap-in">
			<div id="fly-menu-wrap">
				<nav class="fly-nav-menu left relative">
					<?php wp_nav_menu(array('theme_location' => 'mobile-menu')); ?>
				</nav>
			</div><!--fly-menu-wrap-->
		</div><!--fly-wrap-in-->
	</div><!--fly-wrap-out-->
</div><!--fly-wrap-->