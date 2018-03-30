<?php
$id = get_the_ID();

$portfolio_qode_like = "on";
if (isset($qode_options_theme13['portfolio_qode_like'])) {
	$portfolio_qode_like = $qode_options_theme13['portfolio_qode_like'];
}

$lightbox_single_project = "no";
if (isset($qode_options_theme13['lightbox_single_project'])) 
	$lightbox_single_project = $qode_options_theme13['lightbox_single_project'];

if(get_post_meta($id, "qode_page_background_color", true) != ""){
	$background_color = get_post_meta($id, "qode_page_background_color", true);
}else{
	$background_color = "";
}

$porftolio_template = 1;
if(get_post_meta(get_the_ID(), "qode_choose-portfolio-single-view", true) != ""){
	if(get_post_meta(get_the_ID(), "qode_choose-portfolio-single-view", true) == 1){
		$porftolio_template = 1;
	}elseif(get_post_meta(get_the_ID(), "qode_choose-portfolio-single-view", true) == 2){
		$porftolio_template = 2;
	}elseif(get_post_meta(get_the_ID(), "qode_choose-portfolio-single-view", true) == 3){
		$porftolio_template = 3;
	}elseif(get_post_meta(get_the_ID(), "qode_choose-portfolio-single-view", true) == 4){
		$porftolio_template = 4;
	}elseif(get_post_meta(get_the_ID(), "qode_choose-portfolio-single-view", true) == 5){
		$porftolio_template = 5;
	}elseif(get_post_meta(get_the_ID(), "qode_choose-portfolio-single-view", true) == 6){
		$porftolio_template = 6;
	}elseif(get_post_meta(get_the_ID(), "qode_choose-portfolio-single-view", true) == 7){
		$porftolio_template = 7;
	}
}elseif(isset($qode_options_theme13['portfolio_style'])){
	if($qode_options_theme13['portfolio_style'] == 1){
		$porftolio_template = 1;
	}elseif($qode_options_theme13['portfolio_style'] == 2){
		$porftolio_template = 2;
	}elseif($qode_options_theme13['portfolio_style'] == 3){
		$porftolio_template = 3;
	}elseif($qode_options_theme13['portfolio_style'] == 4){
		$porftolio_template = 4;
	}elseif($qode_options_theme13['portfolio_style'] == 5){
		$porftolio_template = 5;
	}elseif($qode_options_theme13['portfolio_style'] == 6){
		$porftolio_template = 6;
	}elseif($qode_options_theme13['portfolio_style'] == 7){
		$porftolio_template = 7;
	}
}
	
$porftolio_single_template = get_post_meta(get_the_ID(), "qode_choose-portfolio-single-view", true);
	
$columns_number = "v4";
if(get_post_meta(get_the_ID(), "qode_choose-number-of-portfolio-columns", true) != ""){
	if(get_post_meta(get_the_ID(), "qode_choose-number-of-portfolio-columns", true) == 2){
		$columns_number = "v2";
	} else if(get_post_meta(get_the_ID(), "qode_choose-number-of-portfolio-columns", true) == 3){
		$columns_number = "v3";
	} else if(get_post_meta(get_the_ID(), "qode_choose-number-of-portfolio-columns", true) == 4){
		$columns_number = "v4";
	}
}else{
	if(isset($qode_options_theme13['portfolio_columns_number'])){
		if($qode_options_theme13['portfolio_columns_number'] == 2){
			$columns_number = "v2";
		} else if($qode_options_theme13['portfolio_columns_number'] == 3) {
			$columns_number = "v3";
		} else if($qode_options_theme13['portfolio_columns_number'] == 4) {
			$columns_number = "v4";
		}
	}
}

?>

<?php get_header(); ?>
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<?php if(get_post_meta($id, "qode_page_scroll_amount_for_sticky", true)) { ?>
				<script>
				var page_scroll_amount_for_sticky = <?php echo get_post_meta($id, "qode_page_scroll_amount_for_sticky", true); ?>;
				</script>
			<?php } ?>
				<?php get_template_part( 'title' ); ?>
			<?php
			$revslider = get_post_meta($id, "qode_revolution-slider", true);
			if (!empty($revslider)){ ?>
				<div class="q_slider"><div class="q_slider_inner">
				<?php echo do_shortcode($revslider); ?>
				</div></div>
			<?php
			}
			?>
			<?php if($porftolio_template != "7"){ ?>
				<div class="container"<?php if($background_color != "") { echo " style='background-color:". $background_color ."'";} ?>>
					<div class="container_inner clearfix">
						<div class="portfolio_single">
							<?php switch ($porftolio_template) {
							case 1: ?>
							<div class="two_columns_66_33 clearfix portfolio_container">
								<div class="column1">
									<div class="column_inner">
										<div class="portfolio_images">
										<?php
										$portfolio_images = get_post_meta(get_the_ID(), "qode_portfolio_images", true);
										if ($portfolio_images){
											usort($portfolio_images, "comparePortfolioImages");
											foreach($portfolio_images as $portfolio_image){	
											?>

												<?php if($portfolio_image['portfolioimg'] != ""){ ?>
													<?php 
														global $wpdb;
														$image_src = $portfolio_image['portfolioimg'];
														$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
														$id = $wpdb->get_var($query);
														$title = get_the_title($id);
														$alt = get_post_meta($id, '_wp_attachment_image_alt', true);
													?>
													<?php if($lightbox_single_project == "yes"){ ?>
														<a class="lightbox_single_portfolio" title="<?php echo $title; ?>" href="<?php echo stripslashes($portfolio_image['portfolioimg']); ?>" data-rel="prettyPhoto[single_pretty_photo]">
															<img src="<?php echo stripslashes($portfolio_image['portfolioimg']); ?>" alt="<?php echo $alt; ?>" />
														</a>
													<?php } else { ?>
														<img src="<?php echo stripslashes($portfolio_image['portfolioimg']); ?>" alt="<?php echo $alt; ?>" />
													<?php } ?>

												<?php }else{ ?>
													
													<?php
													$portfoliovideotype = "";
													if (isset($portfolio_image['portfoliovideotype'])) $portfoliovideotype = $portfolio_image['portfoliovideotype'];
													switch ($portfoliovideotype){
														case "youtube": ?>
															<iframe width="100%" src="http://www.youtube.com/embed/<?php echo $portfolio_image['portfoliovideoid'];  ?>?wmode=transparent" wmode="Opaque" frameborder="0" allowfullscreen></iframe>
														<?php	break;
														case "vimeo": ?>
															<iframe src="http://player.vimeo.com/video/<?php echo $portfolio_image['portfoliovideoid'];  ?>?title=0&amp;byline=0&amp;portrait=0" width="100%" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
														<?php break; 
														case "self": ?> 
															<div class="video"> 
																<div class="mobile-video-image" style="background-image: url(<?php echo $portfolio_image['portfoliovideoimage']; ?>);"></div> 
																<div class="video-wrap"  > 
																	<video class="video" poster="<?php echo $portfolio_image['portfoliovideoimage']; ?>" preload="auto"> 
																		<?php if(!empty($portfolio_image['portfoliovideowebm'])) { ?> <source type="video/webm" src="<?php echo $portfolio_image['portfoliovideowebm']; ?>"> <?php } ?> 
																		<?php if(!empty($portfolio_image['portfoliovideomp4'])) { ?> <source type="video/mp4" src="<?php echo $portfolio_image['portfoliovideomp4']; ?>"> <?php } ?> 
																		<?php if(!empty($portfolio_image['portfoliovideoogv'])) { ?> <source type="video/ogg" src="<?php echo $portfolio_image['portfoliovideoogv']; ?>"> <?php } ?> 
																		<object width="320" height="240" type="application/x-shockwave-flash" data="<?php echo get_template_directory_uri(); ?>/js/flashmediaelement.swf"> 
																		<param name="movie" value="<?php echo get_template_directory_uri(); ?>/js/flashmediaelement.swf" /> 
																		<param name="flashvars" value="controls=true&file=<?php echo $portfolio_image['portfoliovideomp4']; ?>" /> 
																		<img src="<?php echo $portfolio_image['portfoliovideoimage']; ?>" width="1920" height="800" title="No video playback capabilities" alt="Video thumb" /> 
																		</object> 
																	</video>   
															</div></div> 
														<?php break;  
													} ?>
													
												<?php } ?>
											<?php						
											}
										}
										?>
										</div>
									</div>
								</div>
								<div class="column2">
									<div class="column_inner">
										<div class="portfolio_detail portfolio_single_follow clearfix">
										<?php
										$portfolios = get_post_meta(get_the_ID(), "qode_portfolios", true);
										if ($portfolios){
											usort($portfolios, "comparePortfolioOptions");
											foreach($portfolios as $portfolio){	
											?>
												<div class="info">
												<?php if($portfolio['optionLabel'] != ""): ?>
												<h6><?php echo stripslashes($portfolio['optionLabel']); ?></h6>
												<?php endif; ?>
												<p>
													<?php if($portfolio['optionUrl'] != ""): ?>
														<a href="<?php echo $portfolio['optionUrl']; ?>" target="_blank">
														<?php echo do_shortcode(stripslashes($portfolio['optionValue'])); ?>
														</a>
													<?php else:?>
														<?php echo do_shortcode(stripslashes($portfolio['optionValue'])); ?>
													<?php endif; ?>
												</p>
												</div>
											<?php						
											}
										}
										?>
										<?php if(get_post_meta(get_the_ID(), "qode_portfolio_date", true)) : ?>
											<div class="info">
												<h6><?php _e('Date','qode'); ?></h6>
												<p><?php echo get_post_meta(get_the_ID(), "qode_portfolio_date", true); ?></p>
											</div>
										<?php endif; ?>
										<div class="info">
											<h6><?php _e('Category ','qode'); ?></h6>
										<span class="category">
										<?php
											$terms = wp_get_post_terms(get_the_ID(),'portfolio_category');
											$counter = 0;
											$all = count($terms);
											foreach($terms as $term) {
												$counter++;
												if($counter < $all){ $after = ', ';}
												else{ $after = ''; }
												echo $term->name.$after;
											}
										?>
										</span>
										</div>
										
											<h6><?php echo _e('About This Project','qode'); ?></h6>
											<div class="info">
												<?php the_content(); ?>
											</div>
										<div class="portfolio_social_holder">
											<?php echo do_shortcode('[social_share]'); ?>
											<?php if($portfolio_qode_like == "on") { ?>
												<div class="portfolio_like"><?php if( function_exists('qode_like') ) qode_like(); ?></div>
											<?php } ?>
										</div>
										</div>
									</div>
								</div>
							</div>
							<div class="portfolio_navigation">
								<div class="portfolio_prev"><?php previous_post_link('%link', '<i class="fa fa-angle-left"></i>'); ?></div>
								<?php if(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true) != ""){ ?>
									<div class="portfolio_button"><a href="<?php echo get_permalink(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true)); ?>"></a></div>
								<?php } ?>
								<div class="portfolio_next"><?php next_post_link('%link','<i class="fa fa-angle-right"></i>'); ?></div>
							</div>
							
							<?php	break;
							case 2: ?>
							<div class="two_columns_66_33 clearfix portfolio_container">
								<div class="column1">
									<div class="column_inner">
										<div class="flexslider">
											<ul class="slides">
												<?php
												$portfolio_images = get_post_meta(get_the_ID(), "qode_portfolio_images", true);
												if ($portfolio_images){
													usort($portfolio_images, "comparePortfolioImages");
													foreach($portfolio_images as $portfolio_image){	
													?>

														<?php if($portfolio_image['portfolioimg'] != ""){ ?>
															<?php 
																global $wpdb;
																$image_src = $portfolio_image['portfolioimg'];
																$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
																$id = $wpdb->get_var($query);
																$alt = get_post_meta($id, '_wp_attachment_image_alt', true);
															?>
															<li class="slide">
																<img src="<?php echo stripslashes($portfolio_image['portfolioimg']); ?>" alt="<?php echo $alt; ?>" />
															</li>	
														<?php }else{ ?>
															
															<?php
															$portfoliovideotype = "";
															if (isset($portfolio_image['portfoliovideotype'])) $portfoliovideotype = $portfolio_image['portfoliovideotype'];
															switch ($portfoliovideotype){
																case "youtube": ?>
																	<li class="slide">
																		<iframe width="100%" src="http://www.youtube.com/embed/<?php echo $portfolio_image['portfoliovideoid'];  ?>?wmode=transparent" wmode="Opaque" frameborder="0" allowfullscreen></iframe>
																	</li>	
																<?php	break;
																case "vimeo": ?>
																	<li class="slide">
																		<iframe src="http://player.vimeo.com/video/<?php echo $portfolio_image['portfoliovideoid'];  ?>?title=0&amp;byline=0&amp;portrait=0" width="100%" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
																	</li>
																<?php break; 
																case "self": ?> 
																	<li class="slide">
																	<div class="video"> 
																		<div class="mobile-video-image" style="background-image: url(<?php echo $portfolio_image['portfoliovideoimage']; ?>);"></div> 
																		<div class="video-wrap"  > 
																			<video class="video" poster="<?php echo $portfolio_image['portfoliovideoimage']; ?>" preload="auto"> 
																				<?php if(!empty($portfolio_image['portfoliovideowebm'])) { ?> <source type="video/webm" src="<?php echo $portfolio_image['portfoliovideowebm']; ?>"> <?php } ?> 
																				<?php if(!empty($portfolio_image['portfoliovideomp4'])) { ?> <source type="video/mp4" src="<?php echo $portfolio_image['portfoliovideomp4']; ?>"> <?php } ?> 
																				<?php if(!empty($portfolio_image['portfoliovideoogv'])) { ?> <source type="video/ogg" src="<?php echo $portfolio_image['portfoliovideoogv']; ?>"> <?php } ?> 
																				<object width="320" height="240" type="application/x-shockwave-flash" data="<?php echo get_template_directory_uri(); ?>/js/flashmediaelement.swf"> 
																				<param name="movie" value="<?php echo get_template_directory_uri(); ?>/js/flashmediaelement.swf" /> 
																				<param name="flashvars" value="controls=true&file=<?php echo $portfolio_image['portfoliovideomp4']; ?>" /> 
																				<img src="<?php echo $portfolio_image['portfoliovideoimage']; ?>" width="1920" height="800" title="No video playback capabilities" alt="Video thumb" /> 
																				</object> 
																			</video>   
																	</div></div>
																	</li>
																<?php break; 
															
															} ?>
															
														<?php } ?>

													<?php						
													}
												}
												?>
											</ul>
										</div>
									</div>
								</div>
								<div class="column2">
									<div class="column_inner">
										<div class="portfolio_detail">
											<?php
											$portfolios = get_post_meta(get_the_ID(), "qode_portfolios", true);
											if ($portfolios){
												usort($portfolios, "comparePortfolioOptions");
												foreach($portfolios as $portfolio){	
												
												?>
													<div class="info">
													<?php if($portfolio['optionLabel'] != ""): ?>
													<h6><?php echo stripslashes($portfolio['optionLabel']); ?></h6>
													<?php endif; ?>
													<p>
														<?php if($portfolio['optionUrl'] != ""): ?>
															<a href="<?php echo $portfolio['optionUrl']; ?>" target="_blank">
															<?php echo do_shortcode(stripslashes($portfolio['optionValue'])); ?>
															</a>
														<?php else:?>
															<?php echo do_shortcode(stripslashes($portfolio['optionValue'])); ?>
														<?php endif; ?>
													</p>
													</div>
												<?php						
												}
											}
											?>
											<?php if(get_post_meta(get_the_ID(), "qode_portfolio_date", true)) : ?>
												<div class="info">
													<h6><?php _e('Date','qode'); ?></h6>
													<p><?php echo get_post_meta(get_the_ID(), "qode_portfolio_date", true); ?></p>
												</div>
											<?php endif; ?>
											<div class="info">
												<h6><?php _e('Category ','qode'); ?></h6>
											 <span class="category">
											 <?php
												$terms = wp_get_post_terms(get_the_ID(),'portfolio_category');
												$counter = 0;
												$all = count($terms);
												foreach($terms as $term) {
													$counter++;
													if($counter < $all){ $after = ', ';}
													else{ $after = ''; }
													echo $term->name.$after;
												}
												?>
												</span>
											 </div>
											<div class="info">
												<h6><?php echo _e('About This Project','qode'); ?></h6>
												<?php the_content(); ?>
											</div>
											<div class="portfolio_social_holder">
												<?php echo do_shortcode('[social_share]'); ?>
												<?php if($portfolio_qode_like == "on") { ?>
													<div class="portfolio_like"><?php if( function_exists('qode_like') ) qode_like(); ?></div>
												<?php } ?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="portfolio_navigation">
								<div class="portfolio_prev"><?php previous_post_link('%link', '<i class="fa fa-angle-left"></i>'); ?></div>
								<?php if(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true) != ""){ ?>
									<div class="portfolio_button"><a href="<?php echo get_permalink(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true)); ?>"></a></div>
								<?php } ?>
								<div class="portfolio_next"><?php next_post_link('%link','<i class="fa fa-angle-right"></i>'); ?></div>
							</div>
							
							<?php	break;
							case 3: ?>		
							<div class="flexslider">
								<ul class="slides">
									<?php
									$portfolio_images = get_post_meta(get_the_ID(), "qode_portfolio_images", true);
									if ($portfolio_images){
										foreach($portfolio_images as $portfolio_image){
										usort($portfolio_images, "comparePortfolioImages");
										?>

											<?php if($portfolio_image['portfolioimg'] != ""){ ?>
												<?php 
													global $wpdb;
													$image_src = $portfolio_image['portfolioimg'];
													$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
													$id = $wpdb->get_var($query);
													$alt = get_post_meta($id, '_wp_attachment_image_alt', true);
												?>
												<li class="slide">
													<img src="<?php echo stripslashes($portfolio_image['portfolioimg']); ?>" alt="<?php echo $alt; ?>" />
												</li>	
											<?php }else{ ?>
												
												<?php
												$portfoliovideotype = "";
												if (isset($portfolio_image['portfoliovideotype'])) $portfoliovideotype = $portfolio_image['portfoliovideotype'];
												switch ($portfoliovideotype){
													case "youtube": ?>
														<li class="slide">
															<iframe width="100%" src="http://www.youtube.com/embed/<?php echo $portfolio_image['portfoliovideoid'];  ?>?wmode=transparent" wmode="Opaque" frameborder="0" allowfullscreen></iframe>
														</li>	
													<?php	break;
													case "vimeo": ?>
														<li class="slide">
															<iframe src="http://player.vimeo.com/video/<?php echo $portfolio_image['portfoliovideoid'];  ?>?title=0&amp;byline=0&amp;portrait=0" width="100%" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
														</li>
													<?php break; 
													case "self": ?> 
														<div class="video"> 
															<div class="mobile-video-image" style="background-image: url(<?php echo $portfolio_image['portfoliovideoimage']; ?>);"></div> 
															<div class="video-wrap"  > 
																<video class="video" poster="<?php echo $portfolio_image['portfoliovideoimage']; ?>" preload="auto"> 
																	<?php if(!empty($portfolio_image['portfoliovideowebm'])) { ?> <source type="video/webm" src="<?php echo $portfolio_image['portfoliovideowebm']; ?>"> <?php } ?> 
																	<?php if(!empty($portfolio_image['portfoliovideomp4'])) { ?> <source type="video/mp4" src="<?php echo $portfolio_image['portfoliovideomp4']; ?>"> <?php } ?> 
																	<?php if(!empty($portfolio_image['portfoliovideoogv'])) { ?> <source type="video/ogg" src="<?php echo $portfolio_image['portfoliovideoogv']; ?>"> <?php } ?> 
																	<object width="320" height="240" type="application/x-shockwave-flash" data="<?php echo get_template_directory_uri(); ?>/js/flashmediaelement.swf"> 
																	<param name="movie" value="<?php echo get_template_directory_uri(); ?>/js/flashmediaelement.swf" /> 
																	<param name="flashvars" value="controls=true&file=<?php echo $portfolio_image['portfoliovideomp4']; ?>" /> 
																	<img src="<?php echo $portfolio_image['portfoliovideoimage']; ?>" width="1920" height="800" title="No video playback capabilities" alt="Video thumb" /> 
																	</object> 
																</video>   
														</div></div> 
													<?php break;  
												} ?>
												
											<?php } ?>

										<?php						
										}
									}
									?>
								</ul>
							</div>
							<div class="two_columns_75_25 clearfix portfolio_container">
								<div class="column1">
									<div class="column_inner">
										<div class="portfolio_single_text_holder">
											<h3><?php echo _e('About This Project','qode'); ?></h3>
											<?php the_content(); ?>
										</div>
									</div>
								</div>
								<div class="column2">
									<div class="column_inner">
										<div class="portfolio_detail">
											<?php
											$portfolios = get_post_meta(get_the_ID(), "qode_portfolios", true);
											if ($portfolios){
												usort($portfolios, "comparePortfolioOptions");
												foreach($portfolios as $portfolio){	
												?>
													<div class="info">
													<?php if($portfolio['optionLabel'] != ""): ?>
													<h6><?php echo stripslashes($portfolio['optionLabel']); ?></h6>
													<?php endif; ?>
													<p>
														<?php if($portfolio['optionUrl'] != ""): ?>
															<a href="<?php echo $portfolio['optionUrl']; ?>" target="_blank">
															<?php echo do_shortcode(stripslashes($portfolio['optionValue'])); ?>
															</a>
														<?php else:?>
															<?php echo do_shortcode(stripslashes($portfolio['optionValue'])); ?>
														<?php endif; ?>
													</p>
													</div>
												<?php						
												}
											}
											?>
											<?php if(get_post_meta(get_the_ID(), "qode_portfolio_date", true)) : ?>
												<div class="info">
													<h6><?php _e('Date','qode'); ?></h6>
													<p><?php echo get_post_meta(get_the_ID(), "qode_portfolio_date", true); ?></p>
												</div>
											<?php endif; ?>
											<div class="info">
												<h6><?php _e('Category ','qode'); ?></h6>
											 <span class="category">
											 <?php
												$terms = wp_get_post_terms(get_the_ID(),'portfolio_category');
												$counter = 0;
												$all = count($terms);
												foreach($terms as $term) {
													$counter++;
													if($counter < $all){ $after = ', ';}
													else{ $after = ''; }
													echo $term->name.$after;
												}
												?>
												</span>
											 </div>
											 <div class="portfolio_social_holder">
												<?php echo do_shortcode('[social_share]'); ?>
												<?php if($portfolio_qode_like == "on") { ?>
													<div class="portfolio_like"><?php if( function_exists('qode_like') ) qode_like(); ?></div>
												<?php } ?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="portfolio_navigation">
								<div class="portfolio_prev"><?php previous_post_link('%link', '<i class="fa fa-angle-left"></i>'); ?></div>
								<?php if(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true) != ""){ ?>
									<div class="portfolio_button"><a href="<?php echo get_permalink(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true)); ?>"></a></div>
								<?php } ?>
								<div class="portfolio_next"><?php next_post_link('%link','<i class="fa fa-angle-right"></i>'); ?></div>
							</div>
							
							<?php	break;
							case 4: ?>		
								<?php the_content(); ?>

								<div class="portfolio_navigation">
									<div class="portfolio_prev"><?php previous_post_link('%link', '<i class="fa fa-angle-left"></i>'); ?></div>
									<?php if(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true) != ""){ ?>
										<div class="portfolio_button"><a href="<?php echo get_permalink(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true)); ?>"></a></div>
									<?php } ?>
									<div class="portfolio_next"><?php next_post_link('%link','<i class="fa fa-angle-right"></i>'); ?></div>
								</div>
							<?php	break;
							case 5: ?>
								<div class="portfolio_images">
									<?php
									$portfolio_images = get_post_meta(get_the_ID(), "qode_portfolio_images", true);
									if ($portfolio_images){
										usort($portfolio_images, "comparePortfolioImages");
										foreach($portfolio_images as $portfolio_image){	
										?>

											<?php if($portfolio_image['portfolioimg'] != ""){ ?>

												<?php 
													global $wpdb;
													$image_src = $portfolio_image['portfolioimg'];
													$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
													$id = $wpdb->get_var($query);
													$title = get_the_title($id);
													$alt = get_post_meta($id, '_wp_attachment_image_alt', true);
												?>

												<?php if($lightbox_single_project == "yes"){ ?>
													<a class="lightbox_single_portfolio" title="<?php echo $title; ?>" href="<?php echo stripslashes($portfolio_image['portfolioimg']); ?>" data-rel="prettyPhoto[single_pretty_photo]">
														<img src="<?php echo stripslashes($portfolio_image['portfolioimg']); ?>" alt="<?php echo $alt; ?>" />
													</a>
												<?php } else { ?>
													<img src="<?php echo stripslashes($portfolio_image['portfolioimg']); ?>" alt="<?php echo $alt; ?>" />	
												<?php } ?>

											<?php }else{ ?>
												
												<?php
												$portfoliovideotype = "";
												if (isset($portfolio_image['portfoliovideotype'])) $portfoliovideotype = $portfolio_image['portfoliovideotype'];
												switch ($portfoliovideotype){
													case "youtube": ?>
														<iframe width="100%" src="http://www.youtube.com/embed/<?php echo $portfolio_image['portfoliovideoid'];  ?>?wmode=transparent" wmode="Opaque" frameborder="0" allowfullscreen></iframe>	
													<?php	break;
													case "vimeo": ?>
														<iframe src="http://player.vimeo.com/video/<?php echo $portfolio_image['portfoliovideoid'];  ?>?title=0&amp;byline=0&amp;portrait=0" width="100%" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
													<?php break; 
													case "self": ?> 
														<div class="video"> 
															<div class="mobile-video-image" style="background-image: url(<?php echo $portfolio_image['portfoliovideoimage']; ?>);"></div> 
															<div class="video-wrap"  > 
																<video class="video" poster="<?php echo $portfolio_image['portfoliovideoimage']; ?>" preload="auto"> 
																	<?php if(!empty($portfolio_image['portfoliovideowebm'])) { ?> <source type="video/webm" src="<?php echo $portfolio_image['portfoliovideowebm']; ?>"> <?php } ?> 
																	<?php if(!empty($portfolio_image['portfoliovideomp4'])) { ?> <source type="video/mp4" src="<?php echo $portfolio_image['portfoliovideomp4']; ?>"> <?php } ?> 
																	<?php if(!empty($portfolio_image['portfoliovideoogv'])) { ?> <source type="video/ogg" src="<?php echo $portfolio_image['portfoliovideoogv']; ?>"> <?php } ?> 
																	<object width="320" height="240" type="application/x-shockwave-flash" data="<?php echo get_template_directory_uri(); ?>/js/flashmediaelement.swf"> 
																	<param name="movie" value="<?php echo get_template_directory_uri(); ?>/js/flashmediaelement.swf" /> 
																	<param name="flashvars" value="controls=true&file=<?php echo $portfolio_image['portfoliovideomp4']; ?>" /> 
																	<img src="<?php echo $portfolio_image['portfoliovideoimage']; ?>" width="1920" height="800" title="No video playback capabilities" alt="Video thumb" /> 
																	</object> 
																</video>   
														</div></div> 
													<?php break; 
												} ?>
												
											<?php } ?>
											
										<?php						
										}
									}
									?>
									</div>
									<div class="two_columns_75_25 clearfix portfolio_container">
										<div class="column1">
											<div class="column_inner">
												<div class="portfolio_single_text_holder">
													<h3><?php echo _e('About This Project','qode'); ?></h3>
													<?php the_content(); ?>
												</div>
											</div>
										</div>
										<div class="column2">
											<div class="column_inner">
												<div class="portfolio_detail portfolio_single_follow">
													<?php
													$portfolios = get_post_meta(get_the_ID(), "qode_portfolios", true);
													if ($portfolios){
														usort($portfolios, "comparePortfolioOptions");
														foreach($portfolios as $portfolio){	
														?>
															<div class="info">
															<?php if($portfolio['optionLabel'] != ""): ?>
															<h6><?php echo stripslashes($portfolio['optionLabel']); ?></h6>
															<?php endif; ?>
															<p>
																<?php if($portfolio['optionUrl'] != ""): ?>
																	<a href="<?php echo $portfolio['optionUrl']; ?>">
																	<?php echo do_shortcode(stripslashes($portfolio['optionValue'])); ?>
																	</a>
																<?php else:?>
																	<?php echo do_shortcode(stripslashes($portfolio['optionValue'])); ?>
																<?php endif; ?>
															</p>
															</div>
														<?php						
														}
													}
													?>
													<?php if(get_post_meta(get_the_ID(), "qode_portfolio_date", true)) : ?>
														<div class="info">
															<h6><?php _e('Date','qode'); ?></h6>
															<p><?php echo get_post_meta(get_the_ID(), "qode_portfolio_date", true); ?></p>
														</div>
													<?php endif; ?>
													<div class="info">
														<h6><?php _e('Category ','qode'); ?></h6>
													 <span class="category">
													 <?php
														$terms = wp_get_post_terms(get_the_ID(),'portfolio_category');
														$counter = 0;
														$all = count($terms);
														foreach($terms as $term) {
															$counter++;
															if($counter < $all){ $after = ', ';}
															else{ $after = ''; }
															echo $term->name.$after;
														}
														?>
														</span>
													 </div>
													 <div class="portfolio_social_holder">
														<?php echo do_shortcode('[social_share]'); ?>
														<?php if($portfolio_qode_like == "on") { ?>
															<div class="portfolio_like"><?php if( function_exists('qode_like') ) qode_like(); ?></div>
														<?php } ?>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="portfolio_navigation">
										<div class="portfolio_prev"><?php previous_post_link('%link', '<i class="fa fa-angle-left"></i>'); ?></div>
										<?php if(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true) != ""){ ?>
											<div class="portfolio_button"><a href="<?php echo get_permalink(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true)); ?>"></a></div>
										<?php } ?>
										<div class="portfolio_next"><?php next_post_link('%link','<i class="fa fa-angle-right"></i>'); ?></div>
									</div>
							<?php	break;
							case 6: ?>
								<div class="portfolio_gallery">
									<?php
									$portfolio_images = get_post_meta(get_the_ID(), "qode_portfolio_images", true);
									if ($portfolio_images){
										usort($portfolio_images, "comparePortfolioImages");
										foreach($portfolio_images as $portfolio_image){	
										?>

											<?php if($portfolio_image['portfolioimg'] != ""){ ?>
												<?php 
													global $wpdb;
													$image_src = $portfolio_image['portfolioimg'];
													$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
													$id = $wpdb->get_var($query);
													$alt = get_post_meta($id, '_wp_attachment_image_alt', true);
												?>	
												<?php if($lightbox_single_project == "yes"){ ?>
													<a class="lightbox_single_portfolio <?php echo $columns_number; ?>" title="<?php echo $portfolio_image['portfoliotitle'];  ?>" href="<?php echo stripslashes($portfolio_image['portfolioimg']); ?>" data-rel="prettyPhoto[single_pretty_photo]">
														<span class="gallery_text_holder"><span class="gallery_text_inner"><h5><?php echo $portfolio_image['portfoliotitle'];  ?></h5></span></span>
														<img src="<?php echo stripslashes($portfolio_image['portfolioimg']); ?>" alt="<?php echo $alt; ?>" />
													</a>
												<?php } else { ?>
													<a class="lightbox_single_portfolio <?php echo $columns_number; ?>" href="#">
														<span class="gallery_text_holder"><span class="gallery_text_inner"><h5><?php echo $portfolio_image['portfoliotitle'];  ?></h5></span></span>
														<img src="<?php echo stripslashes($portfolio_image['portfolioimg']); ?>" alt="<?php echo $alt; ?>" />
													</a>
												<?php } ?>

											<?php }else{ ?>
												
												<?php
												$portfoliovideotype = "";
												if (isset($portfolio_image['portfoliovideotype'])) $portfoliovideotype = $portfolio_image['portfoliovideotype'];
												switch ($portfoliovideotype){
													case "youtube": ?>
														<?php if($lightbox_single_project == "yes"){ ?>
															<a class="lightbox_single_portfolio <?php echo $columns_number; ?>" title="<?php echo $portfolio_image['portfoliotitle'];  ?>" href="http://www.youtube.com/watch?feature=player_embedded&v=<?php echo $portfolio_image['portfoliovideoid']; ?>" rel="prettyPhoto[single_pretty_photo]">
																<span class="gallery_text_holder"><span class="gallery_text_inner"><h6><?php echo $portfolio_image['portfoliotitle'];  ?></h6></span></span>
																<img width="100%" src="http://img.youtube.com/vi/<?php echo $portfolio_image['portfoliovideoid'];  ?>/maxresdefault.jpg" />
															</a>
														<?php } else { ?>
															<a class="lightbox_single_portfolio <?php echo $columns_number; ?>" href="#">
																<iframe width="100%" src="http://www.youtube.com/embed/<?php echo $portfolio_image['portfoliovideoid'];  ?>?wmode=transparent" wmode="Opaque" frameborder="0" allowfullscreen></iframe>	
															</a>
														<?php } ?>
													<?php	break;
													case "vimeo": ?>
														<?php if($lightbox_single_project == "yes"){ 
															$videoid = $portfolio_image['portfoliovideoid'];
															$xml = simplexml_load_file("http://vimeo.com/api/v2/video/".$videoid.".xml");
															$xml = $xml->video;
															$xml_pic = $xml->thumbnail_large; ?>
															<a class="lightbox_single_portfolio <?php echo $columns_number; ?>" title="<?php echo $portfolio_image['portfoliotitle'];  ?>" href="http://vimeo.com/<?php echo $portfolio_image['portfoliovideoid']; ?>" rel="prettyPhoto[single_pretty_photo]">
																<span class="gallery_text_holder"><span class="gallery_text_inner"><h6><?php echo $portfolio_image['portfoliotitle'];  ?></h6></span></span>
																<img width="100%" src="<?php echo $xml_pic;  ?>" />
															</a>	
														<?php } else { ?>
															<a class="lightbox_single_portfolio <?php echo $columns_number; ?>" href="">
																<iframe src="http://player.vimeo.com/video/<?php echo $portfolio_image['portfoliovideoid'];  ?>?title=0&amp;byline=0&amp;portrait=0" width="100%" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
															</a>
														<?php } ?>

													<?php break; 
													case "self": ?> 
														
														<a class="lightbox_single_portfolio <?php echo $columns_number; ?>" onclick='return false;' href="#">
														<div class="video"> 
															<div class="mobile-video-image" style="background-image: url(<?php echo $portfolio_image['portfoliovideoimage']; ?>);"></div> 
															<div class="video-wrap"  > 
																<video class="video" poster="<?php echo $portfolio_image['portfoliovideoimage']; ?>" preload="auto"> 
																	<?php if(!empty($portfolio_image['portfoliovideowebm'])) { ?> <source type="video/webm" src="<?php echo $portfolio_image['portfoliovideowebm']; ?>"> <?php } ?> 
																	<?php if(!empty($portfolio_image['portfoliovideomp4'])) { ?> <source type="video/mp4" src="<?php echo $portfolio_image['portfoliovideomp4']; ?>"> <?php } ?> 
																	<?php if(!empty($portfolio_image['portfoliovideoogv'])) { ?> <source type="video/ogg" src="<?php echo $portfolio_image['portfoliovideoogv']; ?>"> <?php } ?> 
																	<object width="320" height="240" type="application/x-shockwave-flash" data="<?php echo get_template_directory_uri(); ?>/js/flashmediaelement.swf"> 
																	<param name="movie" value="<?php echo get_template_directory_uri(); ?>/js/flashmediaelement.swf" /> 
																	<param name="flashvars" value="controls=true&file=<?php echo $portfolio_image['portfoliovideomp4']; ?>" /> 
																	<img src="<?php echo $portfolio_image['portfoliovideoimage']; ?>" width="1920" height="800" title="No video playback capabilities" alt="Video thumb" /> 
																	</object> 
																</video>   
															</div>
														</div> 
														</a>
														
													<?php break; 
												} ?>
												
											<?php } ?>
											
										<?php						
										}
									}
									?>
								</div>
								<div class="two_columns_75_25 clearfix portfolio_container">
									<div class="column1">
										<div class="column_inner">
											<div class="portfolio_single_text_holder">
												<h3><?php echo _e('About This Project','qode'); ?></h3>
												<?php the_content(); ?>
											</div>
										</div>
									</div>
									<div class="column2">
										<div class="column_inner">
											<div class="portfolio_detail">
												<?php
												$portfolios = get_post_meta(get_the_ID(), "qode_portfolios", true);
												if ($portfolios){
													usort($portfolios, "comparePortfolioOptions");
													foreach($portfolios as $portfolio){	
													?>
														<div class="info">
														<?php if($portfolio['optionLabel'] != ""): ?>
														<h6><?php echo stripslashes($portfolio['optionLabel']); ?></h6>
														<?php endif; ?>
														<p>
															<?php if($portfolio['optionUrl'] != ""): ?>
																<a href="<?php echo $portfolio['optionUrl']; ?>">
																<?php echo do_shortcode(stripslashes($portfolio['optionValue'])); ?>
																</a>
															<?php else:?>
																<?php echo do_shortcode(stripslashes($portfolio['optionValue'])); ?>
															<?php endif; ?>
														</p>
														</div>
													<?php						
													}
												}
												?>
												<?php if(get_post_meta(get_the_ID(), "qode_portfolio_date", true)) : ?>
													<div class="info">
														<h6><?php _e('Date','qode'); ?></h6>
														<p><?php echo get_post_meta(get_the_ID(), "qode_portfolio_date", true); ?></p>
													</div>
												<?php endif; ?>
												<div class="info">
													<h6><?php _e('Category ','qode'); ?></h6>
												 <span class="category">
												 <?php
													$terms = wp_get_post_terms(get_the_ID(),'portfolio_category');
													$counter = 0;
													$all = count($terms);
													foreach($terms as $term) {
														$counter++;
														if($counter < $all){ $after = ', ';}
														else{ $after = ''; }
														echo $term->name.$after;
													}
													?>
													</span>
												 </div>
												 <div class="portfolio_social_holder">
													<?php echo do_shortcode('[social_share]'); ?>
													<?php if($portfolio_qode_like == "on") { ?>
														<div class="portfolio_like"><?php if( function_exists('qode_like') ) qode_like(); ?></div>
													<?php } ?>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="portfolio_navigation">
									<div class="portfolio_prev"><?php previous_post_link('%link', '<i class="fa fa-angle-left"></i>'); ?></div>
									<?php if(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true) != ""){ ?>
										<div class="portfolio_button"><a href="<?php echo get_permalink(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true)); ?>"></a></div>
									<?php } ?>
									<div class="portfolio_next"><?php next_post_link('%link','<i class="fa fa-angle-right"></i>'); ?></div>
								</div>
							<?php	break;
							}
							?>
						</div>
					</div>
				</div>
			<?php } ?>
			<?php switch ($porftolio_template) {
				case 7: ?>		
					<div class="full_width">
						<div class="full_width_inner">
							<div class="portfolio_single">
								<?php the_content(); ?>

								<div class="container">
									<div class="container_inner clearfix">
										<div class="portfolio_navigation">
											<div class="portfolio_prev"><?php previous_post_link('%link', '<i class="fa fa-angle-left"></i>'); ?></div>
											<?php if(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true) != ""){ ?>
												<div class="portfolio_button"><a href="<?php echo get_permalink(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true)); ?>"></a></div>
											<?php } ?>
											<div class="portfolio_next"><?php next_post_link('%link','<i class="fa fa-angle-right"></i>'); ?></div>
										</div>
									</div>
								</div>		
							</div>	
						</div>
					</div>	
				<?php break; 
			} ?>		
		<?php endwhile; ?>
	<?php endif; ?>	
<?php get_footer(); ?>	