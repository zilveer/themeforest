<?php /* Template Name: Contact us */
get_header();
	if ( have_posts() ) : while ( have_posts() ) : the_post();
		$contact_map = rwmb_meta('vbegy_contact_map','textarea',$post->ID);
		$contact_form = rwmb_meta('vbegy_contact_form','text',$post->ID);
		$about_widget = rwmb_meta('vbegy_about_widget','checkbox',$post->ID);
		$vbegy_about_content = rwmb_meta('vbegy_about_content','textarea',$post->ID);
		$vbegy_address = rwmb_meta('vbegy_address','text',$post->ID);
		$vbegy_phone = rwmb_meta('vbegy_phone','text',$post->ID);
		$vbegy_email = rwmb_meta('vbegy_email','text',$post->ID);
		$vbegy_social = rwmb_meta('vbegy_social','checkbox',$post->ID);
		$vbegy_facebook = rwmb_meta('vbegy_facebook','text',$post->ID);
		$vbegy_twitter = rwmb_meta('vbegy_twitter','text',$post->ID);
		$vbegy_youtube = rwmb_meta('vbegy_youtube','text',$post->ID);
		$vbegy_linkedin = rwmb_meta('vbegy_linkedin','text',$post->ID);
		$vbegy_google_plus = rwmb_meta('vbegy_google_plus','text',$post->ID);
		$vbegy_instagram = rwmb_meta('vbegy_instagram','text',$post->ID);
		$vbegy_dribbble = rwmb_meta('vbegy_dribbble','text',$post->ID);
		$vbegy_pinterest = rwmb_meta('vbegy_pinterest','text',$post->ID);
		$vbegy_rss = rwmb_meta('vbegy_rss','checkbox',$post->ID);?>
		
		<div class="contact-us">
			<?php if ($contact_map != "") {?>
				<div class="page-content">
					<?php echo $contact_map;?>
				</div><!-- End page-content -->
			<?php }?>
			
			<div class="row">
				<div class="<?php if ($about_widget == 1) {?>col-md-7<?php }else {echo "col-md-12";}?>">
					<div class="page-content">
						<h2><?php the_title()?></h2>
						<?php the_content()?>
						<div class="form-style form-style-3 form-style-5">
							<?php echo do_shortcode($contact_form);?>
						</div>
					</div><!-- End page-content -->
				</div>
				<?php if ($about_widget == 1) {?>
					<div class="col-md-5">
						<div class="page-content">
							<h2><?php _e("About Us","vbegy")?></h2>
							<?php if ($vbegy_about_content != "") {?>
								<p><?php echo $vbegy_about_content?></p>
							<?php }?>
							<div class="widget widget_contact">
								<ul>
									<?php if ($vbegy_address != "") {?>
										<li><i class="icon-map-marker"></i><?php _e("Address :","vbegy")?><p><?php echo $vbegy_address?></p></li>
									<?php }
									if ($vbegy_phone != "") {?>
										<li><i class="icon-phone"></i><?php _e("Phone number :","vbegy")?><p><?php echo $vbegy_phone?></p></li>
									<?php }
									if ($vbegy_email != "") {?>
										<li><i class="icon-envelope-alt"></i><?php _e("E-mail :","vbegy")?><p><?php echo $vbegy_email?></p></li>
									<?php }
									if ($vbegy_social != "") {?>
										<li>
											<i class="icon-share"></i><?php _e("Social links :","vbegy")?>
											<p>
												<?php if ($vbegy_facebook != "") {?>
													<a href="<?php echo $vbegy_facebook?>" original-title="<?php _e("Facebook","vbegy")?>" class="tooltip-n">
														<span class="icon_i">
															<span class="icon_square" icon_size="25" span_bg="#3b5997" span_hover="#2f3239">
																<i i_color="#FFF" class="social_icon-facebook"></i>
															</span>
														</span>
													</a>
												<?php }
												if ($vbegy_twitter != "") {?>
													<a href="<?php echo $vbegy_twitter?>" original-title="<?php _e("Twitter","vbegy")?>" class="tooltip-n">
														<span class="icon_i">
															<span class="icon_square" icon_size="25" span_bg="#00baf0" span_hover="#2f3239">
																<i i_color="#FFF" class="social_icon-twitter"></i>
															</span>
														</span>
													</a>
												<?php }
												if ($vbegy_youtube != "") {?>
													<a original-title="<?php _e("Youtube","vbegy")?>" class="tooltip-n" href="<?php echo $vbegy_youtube?>">
														<span class="icon_i">
															<span class="icon_square" icon_size="25" span_bg="#cc291f" span_hover="#2f3239">
																<i i_color="#FFF" class="social_icon-youtube"></i>
															</span>
														</span>
													</a>
												<?php }
												if ($vbegy_linkedin != "") {?>
													<a href="<?php echo $vbegy_linkedin?>" original-title="<?php _e("Linkedin","vbegy")?>" class="tooltip-n">
														<span class="icon_i">
															<span class="icon_square" icon_size="25" span_bg="#006599" span_hover="#2f3239">
																<i i_color="#FFF" class="social_icon-linkedin"></i>
															</span>
														</span>
													</a>
												<?php }
												if ($vbegy_google_plus != "") {?>
													<a href="<?php echo $vbegy_google_plus?>" original-title="<?php _e("Google plus","vbegy")?>" class="tooltip-n">
														<span class="icon_i">
															<span class="icon_square" icon_size="25" span_bg="#ca2c24" span_hover="#2f3239">
																<i i_color="#FFF" class="social_icon-gplus"></i>
															</span>
														</span>
													</a>
												<?php }
												if ($vbegy_rss == 1) {?>
													<a original-title="<?php _e("RSS","vbegy")?>" class="tooltip-n" href="<?php bloginfo('rss2_url');?>">
														<span class="icon_i">
															<span class="icon_square" icon_size="25" span_bg="#F18425" span_hover="#2f3239">
																<i i_color="#FFF" class="icon-rss"></i>
															</span>
														</span>
													</a>
												<?php }
												if ($vbegy_instagram != "") {?>
													<a original-title="<?php _e("Instagram","vbegy")?>" class="tooltip-n" href="<?php echo $vbegy_instagram?>">
														<span class="icon_i">
															<span class="icon_square" icon_size="25" span_bg="#306096" span_hover="#2f3239">
																<i i_color="#FFF" class="social_icon-instagram"></i>
															</span>
														</span>
													</a>
												<?php }
												if ($vbegy_dribbble != "") {?>
													<a original-title="<?php _e("Dribbble","vbegy")?>" class="tooltip-n" href="<?php echo $vbegy_dribbble?>">
														<span class="icon_i">
															<span class="icon_square" icon_size="25" span_bg="#e64281" span_hover="#2f3239">
																<i i_color="#FFF" class="social_icon-dribbble"></i>
															</span>
														</span>
													</a>
												<?php }
												if ($vbegy_pinterest != "") {?>
													<a original-title="<?php _e("Pinterest","vbegy")?>" class="tooltip-n" href="<?php echo $vbegy_pinterest?>">
														<span class="icon_i">
															<span class="icon_square" icon_size="25" span_bg="#c7151a" span_hover="#2f3239">
																<i i_color="#FFF" class="icon-pinterest"></i>
															</span>
														</span>
													</a>
												<?php }?>
											</p>
										</li>
									<?php }?>
								</ul>
							</div>
						</div><!-- End page-content -->
					</div><!-- End col-md-5 -->
				<?php }?>
			</div><!-- End row -->
		</div><!-- End contact-us -->
	<?php endwhile; endif;
get_footer();?>