<?php
$porftolio_single_template = get_post_meta(get_the_ID(), "qode_choose-portfolio-single-view", true);
?>

<?php get_header(); ?>
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<?php if(!get_post_meta(get_the_ID(), "qode_show-page-title", true)) { ?>
				<div class="container">
					<div class="container_inner clearfix">
						<div class="title">
							<h1><?php the_title(); ?></h1>
							<?php if(get_post_meta(get_the_ID(), "qode_page-subtitle", true)) { ?><span><?php echo get_post_meta(get_the_ID(), "qode_page-subtitle", true) ?></span><?php } ?>
						</div>
					</div>
				</div>
			<?php } ?>

			<?php if($qode_options_magnet['show_back_button'] == "yes") { ?>
				<a id='back_to_top' href='#'>
					<span class='back_to_top_inner'>
						<span>&nbsp;</span>
					</span>
				</a>
			<?php } ?>
	
			<?php
				$revslider = get_post_meta($id, "qode_revolution-slider", true);
				if (!empty($revslider)){
					echo do_shortcode($revslider);
				}
				?>
			<div class="container">
				<div class="container_inner clearfix">
					<div class="portfolio_single">
					<?php
					if($porftolio_single_template == '') :
					?>
						<?php switch ($qode_options_magnet['portfolio_style']) {
						case 1: ?>
						<div class="two_columns_75_25 clearfix portfolio_container">
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
													
													<img src="<?php echo stripslashes($portfolio_image['portfolioimg']); ?>" alt="" />
													
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
									<div class="portfolio_detail portfolio_single_follow">
									<?php
									$portfolios = get_post_meta(get_the_ID(), "qode_portfolios", true);
									if ($portfolios){
										usort($portfolios, "comparePortfolioOptions");
										foreach($portfolios as $portfolio){	
										?>
											<div class="info">
											<?php if($portfolio['optionLabel'] != ""): ?>
											<span><?php echo stripslashes($portfolio['optionLabel']); ?>:</span>
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
											<span>Date:</span>
											<p><?php echo get_post_meta(get_the_ID(), "qode_portfolio_date", true); ?></p>
										</div>
									<?php endif; ?>
										
										<div class="info"><?php the_content(); ?></div>
									</div>
								</div>
							</div>
						</div>
						<div class="portfolio_navigation">
							<div class="portfolio_prev"><?php previous_post_link('%link', '<span class="prev_button"><span class="inner"><span></span></span></span>'.__('Previous','qode')); ?></div>
							<?php if(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true) != ""){ ?>
								<div class="portfolio_list"><a href="<?php echo get_permalink(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true)); ?>">
								</a></div>
							<?php } ?>
							<div class="portfolio_next"><?php next_post_link('%link', __('Next','qode').'<span class="next_button"><span class="inner"><span></span></span></span>') ?> </div>
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
													<li class="slide">
															<img src="<?php echo stripslashes($portfolio_image['portfolioimg']); ?>" alt="" />
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
												<span><?php echo stripslashes($portfolio['optionLabel']); ?>:</span>
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
											<span>Date:</span>
											<p><?php echo get_post_meta(get_the_ID(), "qode_portfolio_date", true); ?></p>
										</div>
										<?php endif; ?>
										
										<div class="info"><?php the_content(); ?></div>
									</div>
								</div>
							</div>
						</div>
						<div class="portfolio_navigation">
							<div class="portfolio_prev"><?php previous_post_link('%link', '<span class="prev_button"><span class="inner"><span></span></span></span>'.__('Previous','qode')); ?></div>
							<?php if(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true) != ""){ ?>
								<div class="portfolio_list"><a href="<?php echo get_permalink(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true)); ?>"></a></div>
							<?php } ?>
							<div class="portfolio_next"><?php next_post_link('%link', __('Next','qode').'<span class="next_button"><span class="inner"><span></span></span></span>') ?> </div>
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
										<li class="slide">
												<img src="<?php echo stripslashes($portfolio_image['portfolioimg']); ?>" alt="" />
										</li>
										<?php } ?>
									<?php						
									}
								}
								?>
							</ul>
						</div>
						<div class="two_columns_33_66 clearfix portfolio_container">
							<div class="column1">
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
												<span><?php echo stripslashes($portfolio['optionLabel']); ?>:</span>
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
											<span>Date:</span>
											<p><?php echo get_post_meta(get_the_ID(), "qode_portfolio_date", true); ?></p>
										</div>
										<?php endif; ?>
									</div>
								</div>
							</div>
							<div class="column2">
								<div class="column_inner">
									
									<div class="info"><?php the_content(); ?></div>
								</div>
							</div>
						</div>
						<div class="portfolio_navigation">
							<div class="portfolio_prev"><?php previous_post_link('%link', '<span class="prev_button"><span class="inner"><span></span></span></span>'.__('Previous','qode')); ?></div>
							<?php if(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true) != ""){ ?>
								<div class="portfolio_list"><a href="<?php echo get_permalink(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true)); ?>"></a></div>
							<?php } ?>
							<div class="portfolio_next"><?php next_post_link('%link', __('Next','qode').'<span class="next_button"><span class="inner"><span></span></span></span>') ?> </div>
						</div>
						
						<?php	break;		
						case 4: ?>
							<div class="info"><?php the_content(); ?></div>
							<div class="portfolio_navigation">
								<div class="portfolio_prev"><?php previous_post_link('%link', '<span class="prev_button"><span class="inner"><span></span></span></span>'.__('Previous','qode')); ?></div>
								<?php if(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true) != ""){ ?>
									<div class="portfolio_list"><a href="<?php echo get_permalink(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true)); ?>"></a></div>
								<?php } ?>
								<div class="portfolio_next"><?php next_post_link('%link', __('Next','qode').'<span class="next_button"><span class="inner"><span></span></span></span>') ?> </div>
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
											<img src="<?php echo stripslashes($portfolio_image['portfolioimg']); ?>" alt="" />
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
											} ?>
											
										<?php } ?>
										
									<?php						
									}
								}
								?>
								</div>
								<div class="two_columns_33_66 clearfix portfolio_container">
									<div class="column1">
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
														<span><?php echo stripslashes($portfolio['optionLabel']); ?>:</span>
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
													<span>Date:</span>
													<p><?php echo get_post_meta(get_the_ID(), "qode_portfolio_date", true); ?></p>
												</div>
												<?php endif; ?>
											</div>
										</div>
									</div>
									<div class="column2">
										<div class="column_inner">
											<div class="info"><?php the_content(); ?></div>
										</div>
									</div>
								</div>
								<div class="portfolio_navigation">
									<div class="portfolio_prev"><?php previous_post_link('%link', '<span class="prev_button"><span class="inner"><span></span></span></span>'.__('Previous','qode')); ?></div>
									<?php if(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true) != ""){ ?>
										<div class="portfolio_list"><a href="<?php echo get_permalink(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true)); ?>"></a></div>
									<?php } ?>
									<div class="portfolio_next"><?php next_post_link('%link', __('Next','qode').'<span class="next_button"><span class="inner"><span></span></span></span>') ?> </div>
								</div>
						<?php	break;		
						}			
						?>
					<?php elseif($porftolio_single_template == "1"): ?>
					
						<div class="two_columns_75_25 clearfix portfolio_container">
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
												<img src="<?php echo stripslashes($portfolio_image['portfolioimg']); ?>" alt="" />
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
									<div class="portfolio_detail portfolio_single_follow">
									<?php
									$portfolios = get_post_meta(get_the_ID(), "qode_portfolios", true);
									if ($portfolios){
										usort($portfolios, "comparePortfolioOptions");
										foreach($portfolios as $portfolio){	
										?>
											<div class="info">
											<?php if($portfolio['optionLabel'] != ""): ?>
											<span><?php echo stripslashes($portfolio['optionLabel']); ?>:</span>
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
											<span>Date:</span>
											<p><?php echo get_post_meta(get_the_ID(), "qode_portfolio_date", true); ?></p>
										</div>
									<?php endif; ?>
										
										<div class="info"><?php the_content(); ?></div>
									</div>
								</div>
							</div>
						</div>
						<div class="portfolio_navigation">
							<div class="portfolio_prev"><?php previous_post_link('%link', '<span class="prev_button"><span class="inner"><span></span></span></span>'.__('Previous','qode')); ?></div>
							<?php if(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true) != ""){ ?>
								<div class="portfolio_list"><a href="<?php echo get_permalink(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true)); ?>"></a></div>
							<?php } ?>
							<div class="portfolio_next"><?php next_post_link('%link', __('Next','qode').'<span class="next_button"><span class="inner"><span></span></span></span>') ?> </div>
						</div>
						
					<?php elseif($porftolio_single_template == "2"): ?>
						
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
													<li class="slide">
															<img src="<?php echo stripslashes($portfolio_image['portfolioimg']); ?>" alt="" />
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
												<span><?php echo stripslashes($portfolio['optionLabel']); ?>:</span>
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
											<span>Date:</span>
											<p><?php echo get_post_meta(get_the_ID(), "qode_portfolio_date", true); ?></p>
										</div>
										<?php endif; ?>
										
										<div class="info"><?php the_content(); ?></div>
									</div>
								</div>
							</div>
						</div>
						<div class="portfolio_navigation">
							<div class="portfolio_prev"><?php previous_post_link('%link', '<span class="prev_button"><span class="inner"><span></span></span></span>'.__('Previous','qode')); ?></div>
							<?php if(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true) != ""){ ?>
								<div class="portfolio_list"><a href="<?php echo get_permalink(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true)); ?>"></a></div>
							<?php } ?>
							<div class="portfolio_next"><?php next_post_link('%link', __('Next','qode').'<span class="next_button"><span class="inner"><span></span></span></span>') ?> </div>
						</div>
						
					<?php elseif($porftolio_single_template == "3"): ?>
						<div class="big-slider-wrapper box1 no_margin">
							<div class="big-slider">
								<div class="big-slider-inner">
									<div class="big-slider-uber-inner">
										<?php
											$portfolio_images = get_post_meta(get_the_ID(), "qode_portfolio_images", true);
											if ($portfolio_images){
												foreach($portfolio_images as $portfolio_image){
												usort($portfolio_images, "comparePortfolioImages");
												?>
													<?php if($portfolio_image['portfolioimg'] != ""){ ?>

														<div class="big-slider-slide">
															<div class="image"><img src="<?php echo stripslashes($portfolio_image['portfolioimg']); ?>" alt="" /></div>
														</div>

														<?php } ?>
													<?php } ?>
												<?php						
												}
										?>
									</div>
								</div>
							</div>
							<div class="big-slider-control">
								<div class="control-seek" style="">
									<div class="control-seek-box"><div class="control-seek-box-inner"><div class="control-seek-background"></div></div></div>
								</div>
								<a class="control-left" href="#"><span class="control-inner"><span class="control-arrow"></span></span></a>
								<a class="control-right" href="#"><span class="control-inner"><span class="control-arrow"></span></span></a>
							</div>
						</div>
						<div class="two_columns_33_66 clearfix portfolio_container">
							<div class="column1">
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
												<span><?php echo stripslashes($portfolio['optionLabel']); ?>:</span>
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
											<span>Date:</span>
											<p><?php echo get_post_meta(get_the_ID(), "qode_portfolio_date", true); ?></p>
										</div>
										<?php endif; ?>
									</div>
								</div>
							</div>
							<div class="column2">
								<div class="column_inner">
									
									<div class="info"><?php the_content(); ?></div>
								</div>
							</div>
						</div>
						<div class="portfolio_navigation">
							<div class="portfolio_prev"><?php previous_post_link('%link', '<span class="prev_button"><span class="inner"><span></span></span></span>'.__('Previous','qode')); ?></div>
							<?php if(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true) != ""){ ?>
								<div class="portfolio_list"><a href="<?php echo get_permalink(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true)); ?>"></a></div>
							<?php } ?>
							<div class="portfolio_next"><?php next_post_link('%link', __('Next','qode').'<span class="next_button"><span class="inner"><span></span></span></span>') ?> </div>
						</div>

					<?php elseif($porftolio_single_template == "4"): ?>
					
						<div class="info"><?php the_content(); ?></div>
						<div class="portfolio_navigation">
							<div class="portfolio_prev"><?php previous_post_link('%link', '<span class="prev_button"><span class="inner"><span></span></span></span>'.__('Previous','qode')); ?></div>
							<?php if(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true) != ""){ ?>
								<div class="portfolio_list"><a href="<?php echo get_permalink(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true)); ?>"></a></div>
							<?php } ?>
							<div class="portfolio_next"><?php next_post_link('%link', __('Next','qode').'<span class="next_button"><span class="inner"><span></span></span></span>') ?> </div>
						</div>
						
					<?php elseif($porftolio_single_template == "5"): ?>
					
						<div class="portfolio_images">
						<?php
						$portfolio_images = get_post_meta(get_the_ID(), "qode_portfolio_images", true);
						if ($portfolio_images){
							usort($portfolio_images, "comparePortfolioImages");
							foreach($portfolio_images as $portfolio_image){	
							?>
								
								<?php if($portfolio_image['portfolioimg'] != ""){ ?>
									<img src="<?php echo stripslashes($portfolio_image['portfolioimg']); ?>" alt="" />
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
									} ?>
									
								<?php } ?>
								
							<?php						
							}
						}
						?>
						</div>
						<div class="two_columns_33_66 clearfix portfolio_container">
							<div class="column1">
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
												<span><?php echo stripslashes($portfolio['optionLabel']); ?>:</span>
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
											<span>Date:</span>
											<p><?php echo get_post_meta(get_the_ID(), "qode_portfolio_date", true); ?></p>
										</div>
										<?php endif; ?>
									</div>
								</div>
							</div>
							<div class="column2">
								<div class="column_inner">
									<div class="info"><?php the_content(); ?></div>
								</div>
							</div>
						</div>
						<div class="portfolio_navigation">
							<div class="portfolio_prev"><?php previous_post_link('%link', '<span class="prev_button"><span class="inner"><span></span></span></span>'.__('Previous','qode')); ?></div>
							<?php if(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true) != ""){ ?>
								<div class="portfolio_list"><a href="<?php echo get_permalink(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true)); ?>"></a></div>
							<?php } ?>
							<div class="portfolio_next"><?php next_post_link('%link', __('Next','qode').'<span class="next_button"><span class="inner"><span></span></span></span>') ?> </div>
						</div>
					<?php endif; ?>
				<?php endwhile; ?>
			<?php endif; ?>	
		</div>
	</div>
</div>
<?php get_footer(); ?>	