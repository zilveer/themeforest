				<?php $site_users_only = vpanel_options("site_users_only");
				if ($site_users_only != 1) {
					$site_users_only = "no";
				}else {
					$site_users_only = (!is_user_logged_in()?"yes":"no");
				}
				if ($site_users_only != "yes") {
					if (is_single() || is_page()) {
						$vbegy_content_adv_type = rwmb_meta('vbegy_content_adv_type','radio',$post->ID);
						$vbegy_content_adv_code = rwmb_meta('vbegy_content_adv_code','textarea',$post->ID);
						$vbegy_content_adv_href = rwmb_meta('vbegy_content_adv_href','text',$post->ID);
						$vbegy_content_adv_img = rwmb_meta('vbegy_content_adv_img','upload',$post->ID);
					}
					
					if ((is_single() || is_page()) && (($vbegy_content_adv_type == "display_code" && $vbegy_content_adv_code != "") || ($vbegy_content_adv_type == "custom_image" && $vbegy_content_adv_img != ""))) {
						$content_adv_type = $vbegy_content_adv_type;
						$content_adv_code = $vbegy_content_adv_code;
						$content_adv_href = $vbegy_content_adv_href;
						$content_adv_img = $vbegy_content_adv_img;
					}else {
						$content_adv_type = vpanel_options("content_adv_type");
						$content_adv_code = vpanel_options("content_adv_code");
						$content_adv_href = vpanel_options("content_adv_href");
						$content_adv_img = vpanel_options("content_adv_img");
					}
					if (($content_adv_type == "display_code" && $content_adv_code != "") || ($content_adv_type == "custom_image" && $content_adv_img != "")) {
						echo '<div class="clearfix"></div>
						<div class="advertising">';
						if ($content_adv_type == "display_code") {
							echo stripcslashes($content_adv_code);
						}else {
							if ($content_adv_href != "") {
								echo '<a target="_blank" href="'.$content_adv_href.'">';
							}
							echo '<img alt="" src="'.$content_adv_img.'">';
							if ($content_adv_href != "") {
								echo '</a>';
							}
						}
						echo '</div><!-- End advertising -->
						<div class="clearfix"></div>';
					}
				}
				?>
				
				</div><!-- End main -->
				<?php
				if (!is_404() && $site_users_only != "yes") {
					$sidebar_width = vpanel_options("sidebar_width");
					
					if (is_single() || is_page()) {
						$custom_page_setting = rwmb_meta('vbegy_custom_page_setting','checkbox',$post->ID);
					}
					$sticky_sidebar_class = "";
					if ((is_single() || is_page()) && isset($custom_page_setting) && $custom_page_setting == 1) {
						$sticky_sidebar = rwmb_meta('vbegy_sticky_sidebar_s','checkbox',$post->ID);
					}else {
						$sticky_sidebar = vpanel_options("sticky_sidebar");
					}
					if ($sticky_sidebar == 1) {
						$sticky_sidebar_class = " sticky-sidebar";
					}
					?>
					<aside class="<?php echo (isset($sidebar_width) && $sidebar_width != ""?$sidebar_width:"col-md-3")?> sidebar<?php echo esc_attr($sticky_sidebar_class);?>">
						<?php get_sidebar();?>
					</aside><!-- End sidebar -->
				<?php }?>
				<div class="clearfix"></div>
			</div><!-- End with-sidebar-container -->
		</div><!-- End row -->
	</section><!-- End container -->
	<?php $footer_skin = vpanel_options("footer_skin");
	$footer_layout = vpanel_options("footer_layout");
	if ($site_users_only != "yes") {
		if ($footer_layout != "footer_no") {?>
			<footer id="footer" class="<?php if ($footer_skin == "footer_light") {echo "footer_light_top";}else {echo "footer_dark";}?>">
				<section class="container">
					<div class="row">
						<?php if ($footer_layout == "footer_1c") {?>
							<div class="col-md-12">
								<?php dynamic_sidebar('footer_1c_sidebar');?>
							</div>
						<?php }else if ($footer_layout == "footer_2c") {?>
							<div class="col-md-6">
								<?php dynamic_sidebar('footer_1c_sidebar');?>
							</div>
							<div class="col-md-6">
								<?php dynamic_sidebar('footer_2c_sidebar');?>
							</div>
						<?php }else if ($footer_layout == "footer_3c") {?>
							<div class="col-md-4">
								<?php dynamic_sidebar('footer_1c_sidebar');?>
							</div>
							<div class="col-md-4">
								<?php dynamic_sidebar('footer_2c_sidebar');?>
							</div>
							<div class="col-md-4">
								<?php dynamic_sidebar('footer_3c_sidebar');?>
							</div>
						<?php }else if ($footer_layout == "footer_4c") {?>
							<div class="col-md-3">
								<?php dynamic_sidebar('footer_1c_sidebar');?>
							</div>
							<div class="col-md-3">
								<?php dynamic_sidebar('footer_2c_sidebar');?>
							</div>
							<div class="col-md-3">
								<?php dynamic_sidebar('footer_3c_sidebar');?>
							</div>
							<div class="col-md-3">
								<?php dynamic_sidebar('footer_4c_sidebar');?>
							</div>
						<?php }else if ($footer_layout == "footer_5c") {?>
							<div class="col-md-4">
								<?php dynamic_sidebar('footer_1c_sidebar');?>
							</div>
							<div class="col-md-2">
								<?php dynamic_sidebar('footer_2c_sidebar');?>
							</div>
							<div class="col-md-3">
								<?php dynamic_sidebar('footer_3c_sidebar');?>
							</div>
							<div class="col-md-3">
								<?php dynamic_sidebar('footer_4c_sidebar');?>
							</div>
						<?php }?>
					</div><!-- End row -->
				</section><!-- End container -->
			</footer><!-- End footer -->
		<?php }
	}?>
	<footer id="footer-bottom" class="<?php if ($footer_skin == "footer_light") {echo "footer_light_bottom";}if ($footer_layout == "footer_no") {echo " no-footer";}?>">
		<section class="container">
			<div class="copyrights f_left"><?php echo vpanel_options("footer_copyrights")?></div>
			<?php $social_icon_f = vpanel_options("social_icon_f");
			if ($social_icon_f == 1) {
				$twitter_icon_f = vpanel_options("twitter_icon_f");
				$facebook_icon_f = vpanel_options("facebook_icon_f");
				$gplus_icon_f = vpanel_options("gplus_icon_f");
				$youtube_icon_f = vpanel_options("youtube_icon_f");
				$skype_icon_f = vpanel_options("skype_icon_f");
				$flickr_icon_f = vpanel_options("flickr_icon_f");
				$linkedin_icon_f = vpanel_options("linkedin_icon_f");
				$rss_icon_f = vpanel_options("rss_icon_f");
				?>
				<div class="social_icons f_right">
					<ul>
						<?php if ($twitter_icon_f) {?>
						<li class="twitter"><a target="_blank" original-title="<?php _e("Twitter","vbegy")?>" class="tooltip-n" href="<?php echo $twitter_icon_f?>"><i class="social_icon-twitter font17"></i></a></li>
						<?php }
						if ($facebook_icon_f) {?>
							<li class="facebook"><a target="_blank" original-title="<?php _e("Facebook","vbegy")?>" class="tooltip-n" href="<?php echo $facebook_icon_f?>"><i class="social_icon-facebook font17"></i></a></li>
						<?php }
						if ($gplus_icon_f) {?>
							<li class="gplus"><a target="_blank" original-title="<?php _e("Google plus","vbegy")?>" class="tooltip-n" href="<?php echo $gplus_icon_f?>"><i class="social_icon-gplus font17"></i></a></li>
						<?php }
						if ($youtube_icon_f) {?>
							<li class="youtube"><a target="_blank" original-title="<?php _e("Youtube","vbegy")?>" class="tooltip-n" href="<?php echo $youtube_icon_f?>"><i class="social_icon-youtube font17"></i></a></li>
						<?php }
						if ($skype_icon_f) {?>
							<li class="skype"><a target="_blank" original-title="<?php _e("Skype","vbegy")?>" class="tooltip-n" href="skype:<?php echo $skype_icon_f?>?call"><i class="social_icon-skype font17"></i></a></li>
						<?php }
						if ($flickr_icon_f) {?>
							<li class="flickr"><a target="_blank" original-title="<?php _e("Flickr","vbegy")?>" class="tooltip-n" href="<?php echo $flickr_icon_f?>"><i class="social_icon-flickr font17"></i></a></li>
						<?php }
						if ($linkedin_icon_f) {?>
							<li class="linkedin"><a target="_blank" original-title="<?php _e("Linkedin","vbegy")?>" class="tooltip-n" href="<?php echo $linkedin_icon_f?>"><i class="social_icon-linkedin font17"></i></a></li>
						<?php }
						if ($rss_icon_f == 1) {?>
							<li class="rss"><a original-title="<?php _e("Rss","vbegy")?>" class="tooltip-n" href="<?php echo (vpanel_options("rss_icon_f_other") != ""?vpanel_options("rss_icon_f_other"):bloginfo('rss2_url'));?>"><i class="social_icon-rss font17"></i></a></li>
						<?php }?>
					</ul>
				</div><!-- End social_icons -->
			<?php }?>
		</section><!-- End container -->
	</footer><!-- End footer-bottom -->
</div><!-- End wrap -->

<div class="go-up"><i class="icon-chevron-up"></i></div>

<?php wp_footer(); ?>
</body>
</html>