<div id="score-wrap" class="left relative">
	<div class="nav-out relative">
		<div class="nav-in">
			<div class="score-cont left relative">
				<div class="score-out relative">
					<div class="tabber-container">
					<div id="score-menu-wrap" class="left relative">
						<div class="score-nav-menu">
							<select class="tabs">
								<?php if ( get_option('mvp_score_name1') ) { ?><option value="#score-tab1"><?php echo esc_html(get_option('mvp_score_name1')); ?></option><?php } ?>
								<?php if ( get_option('mvp_score_name2') ) { ?><option value="#score-tab2"><?php echo esc_html(get_option('mvp_score_name2')); ?></option><?php } ?>
								<?php if ( get_option('mvp_score_name3') ) { ?><option value="#score-tab3"><?php echo esc_html(get_option('mvp_score_name3')); ?></option><?php } ?>
								<?php if ( get_option('mvp_score_name4') ) { ?><option value="#score-tab4"><?php echo esc_html(get_option('mvp_score_name4')); ?></option><?php } ?>
								<?php if ( get_option('mvp_score_name5') ) { ?><option value="#score-tab5"><?php echo esc_html(get_option('mvp_score_name5')); ?></option><?php } ?>
								<?php if ( get_option('mvp_score_name6') ) { ?><option value="#score-tab6"><?php echo esc_html(get_option('mvp_score_name6')); ?></option><?php } ?>
								<?php if ( get_option('mvp_score_name7') ) { ?><option value="#score-tab7"><?php echo esc_html(get_option('mvp_score_name7')); ?></option><?php } ?>
								<?php if ( get_option('mvp_score_name8') ) { ?><option value="#score-tab8"><?php echo esc_html(get_option('mvp_score_name8')); ?></option><?php } ?>
								<?php if ( get_option('mvp_score_name9') ) { ?><option value="#score-tab9"><?php echo esc_html(get_option('mvp_score_name9')); ?></option><?php } ?>
								<?php if ( get_option('mvp_score_name10') ) { ?><option value="#score-tab10"><?php echo esc_html(get_option('mvp_score_name10')); ?></a></option><?php } ?>
							</select>
						</div><!--score-nav-menu-->
					</div><!--score-menu-wrap-->
					<div class="score-in">
						<div class="score-main left relative">
							<?php if ( get_option('mvp_score_name1') ) { ?>
								<div id="score-tab1" class="carousel es-carousel es-carousel-wrapper tabber-content">
									<div class="score-cont">
										<ul class="score-list slides left relative">
											<?php global $post; $score_cat1 = get_option('mvp_score_cat1'); $recent = new WP_Query(array( 'post_type' => 'scoreboard', 'posts_per_page' => '999', 'tax_query' => array(array( 'taxonomy' => 'scores_cat', 'field' => 'slug', 'terms' => $score_cat1 ))  )); while($recent->have_posts()) : $recent->the_post();?>
											<li>
												<?php $mvp_link_post = get_post_meta($post->ID, "mvp_link_post", true); if ($mvp_link_post) { ?><a href="<?php the_permalink(); ?>" rel="bookmark"><?php } ?>
												<div class="score-bot left relative">
													<div class="score-bot-left left relative">
														<p><?php echo esc_html(get_post_meta($post->ID, "mvp_away_team", true)); ?><br>
														<?php echo esc_html(get_post_meta($post->ID, "mvp_home_team", true)); ?></p>
													</div><!--score-bot-left-->
													<?php $mvp_show_score = get_post_meta($post->ID, "mvp_show_score", true); if ($mvp_show_score) { ?>
														<div class="score-bot-right relative">
															<p><?php echo esc_html(get_post_meta($post->ID, "mvp_away_team_score", true)); ?><br>
															<?php echo esc_html(get_post_meta($post->ID, "mvp_home_team_score", true)); ?></p>
														</div><!--score-bot-right-->
													<?php } ?>
												</div><!--score-bot-->
												<div class="score-top relative">
													<p><?php echo esc_html(get_post_meta($post->ID, "mvp_status", true)); ?></p>
												</div><!--score-top-->
												<?php $mvp_link_post = get_post_meta($post->ID, "mvp_link_post", true); if ($mvp_link_post) { ?></a><?php } ?>
											</li>
											<?php endwhile; ?>
										</ul>
									</div><!--score-cont-->
								</div><!--score-tab1-->
							<?php } ?>
							<?php if ( get_option('mvp_score_name2') ) { ?>
								<div id="score-tab2" class="carousel es-carousel es-carousel-wrapper tabber-content">
									<div class="score-cont">
										<ul class="score-list slides left relative">
											<?php global $post; $score_cat2 = get_option('mvp_score_cat2'); $recent = new WP_Query(array( 'post_type' => 'scoreboard', 'posts_per_page' => '999', 'tax_query' => array(array( 'taxonomy' => 'scores_cat', 'field' => 'slug', 'terms' => $score_cat2 ))  )); while($recent->have_posts()) : $recent->the_post();?>
											<li>
												<?php $mvp_link_post = get_post_meta($post->ID, "mvp_link_post", true); if ($mvp_link_post) { ?><a href="<?php the_permalink(); ?>" rel="bookmark"><?php } ?>
												<div class="score-bot left relative">
													<div class="score-bot-left left relative">
														<p><?php echo esc_html(get_post_meta($post->ID, "mvp_away_team", true)); ?><br>
														<?php echo esc_html(get_post_meta($post->ID, "mvp_home_team", true)); ?></p>
													</div><!--score-bot-left-->
													<?php $mvp_show_score = get_post_meta($post->ID, "mvp_show_score", true); if ($mvp_show_score) { ?>
														<div class="score-bot-right relative">
															<p><?php echo esc_html(get_post_meta($post->ID, "mvp_away_team_score", true)); ?><br>
															<?php echo esc_html(get_post_meta($post->ID, "mvp_home_team_score", true)); ?></p>
														</div><!--score-bot-right-->
													<?php } ?>
												</div><!--score-bot-->
												<div class="score-top relative">
													<p><?php echo esc_html(get_post_meta($post->ID, "mvp_status", true)); ?></p>
												</div><!--score-top-->
												<?php $mvp_link_post = get_post_meta($post->ID, "mvp_link_post", true); if ($mvp_link_post) { ?></a><?php } ?>
											</li>
											<?php endwhile; ?>		
										</ul>
									</div><!--score-cont-->
								</div><!--score-tab2-->
							<?php } ?>
							<?php if ( get_option('mvp_score_name3') ) { ?>
								<div id="score-tab3" class="carousel es-carousel es-carousel-wrapper tabber-content">
									<div class="score-cont">
										<ul class="score-list slides left relative">
											<?php global $post; $score_cat3 = get_option('mvp_score_cat3'); $recent = new WP_Query(array( 'post_type' => 'scoreboard', 'posts_per_page' => '999', 'tax_query' => array(array( 'taxonomy' => 'scores_cat', 'field' => 'slug', 'terms' => $score_cat3 ))  )); while($recent->have_posts()) : $recent->the_post();?>
											<li>
												<?php $mvp_link_post = get_post_meta($post->ID, "mvp_link_post", true); if ($mvp_link_post) { ?><a href="<?php the_permalink(); ?>" rel="bookmark"><?php } ?>
												<div class="score-bot left relative">
													<div class="score-bot-left left relative">
														<p><?php echo esc_html(get_post_meta($post->ID, "mvp_away_team", true)); ?><br>
														<?php echo esc_html(get_post_meta($post->ID, "mvp_home_team", true)); ?></p>
													</div><!--score-bot-left-->
													<?php $mvp_show_score = get_post_meta($post->ID, "mvp_show_score", true); if ($mvp_show_score) { ?>
														<div class="score-bot-right relative">
															<p><?php echo esc_html(get_post_meta($post->ID, "mvp_away_team_score", true)); ?><br>
															<?php echo esc_html(get_post_meta($post->ID, "mvp_home_team_score", true)); ?></p>
														</div><!--score-bot-right-->
													<?php } ?>
												</div><!--score-bot-->
												<div class="score-top relative">
													<p><?php echo esc_html(get_post_meta($post->ID, "mvp_status", true)); ?></p>
												</div><!--score-top-->
												<?php $mvp_link_post = get_post_meta($post->ID, "mvp_link_post", true); if ($mvp_link_post) { ?></a><?php } ?>
											</li>
											<?php endwhile; ?>		
										</ul>
									</div><!--score-cont-->
								</div><!--score-tab3-->
							<?php } ?>
							<?php if ( get_option('mvp_score_name4') ) { ?>
								<div id="score-tab4" class="carousel es-carousel es-carousel-wrapper tabber-content">
									<div class="score-cont">
										<ul class="score-list slides left relative">
											<?php global $post; $score_cat4 = get_option('mvp_score_cat4'); $recent = new WP_Query(array( 'post_type' => 'scoreboard', 'posts_per_page' => '999', 'tax_query' => array(array( 'taxonomy' => 'scores_cat', 'field' => 'slug', 'terms' => $score_cat4 ))  )); while($recent->have_posts()) : $recent->the_post();?>
											<li>
												<?php $mvp_link_post = get_post_meta($post->ID, "mvp_link_post", true); if ($mvp_link_post) { ?><a href="<?php the_permalink(); ?>" rel="bookmark"><?php } ?>
												<div class="score-bot left relative">
													<div class="score-bot-left left relative">
														<p><?php echo esc_html(get_post_meta($post->ID, "mvp_away_team", true)); ?><br>
														<?php echo esc_html(get_post_meta($post->ID, "mvp_home_team", true)); ?></p>
													</div><!--score-bot-left-->
													<?php $mvp_show_score = get_post_meta($post->ID, "mvp_show_score", true); if ($mvp_show_score) { ?>
														<div class="score-bot-right relative">
															<p><?php echo esc_html(get_post_meta($post->ID, "mvp_away_team_score", true)); ?><br>
															<?php echo esc_html(get_post_meta($post->ID, "mvp_home_team_score", true)); ?></p>
														</div><!--score-bot-right-->
													<?php } ?>
												</div><!--score-bot-->
												<div class="score-top relative">
													<p><?php echo esc_html(get_post_meta($post->ID, "mvp_status", true)); ?></p>
												</div><!--score-top-->
												<?php $mvp_link_post = get_post_meta($post->ID, "mvp_link_post", true); if ($mvp_link_post) { ?></a><?php } ?>
											</li>
											<?php endwhile; ?>		
										</ul>
									</div><!--score-cont-->
								</div><!--score-tab4-->
							<?php } ?>
							<?php if ( get_option('mvp_score_name5') ) { ?>
								<div id="score-tab5" class="carousel es-carousel es-carousel-wrapper tabber-content">
									<div class="score-cont">
										<ul class="score-list slides left relative">
											<?php global $post; $score_cat5 = get_option('mvp_score_cat5'); $recent = new WP_Query(array( 'post_type' => 'scoreboard', 'posts_per_page' => '999', 'tax_query' => array(array( 'taxonomy' => 'scores_cat', 'field' => 'slug', 'terms' => $score_cat5 ))  )); while($recent->have_posts()) : $recent->the_post();?>
											<li>
												<?php $mvp_link_post = get_post_meta($post->ID, "mvp_link_post", true); if ($mvp_link_post) { ?><a href="<?php the_permalink(); ?>" rel="bookmark"><?php } ?>
												<div class="score-bot left relative">
													<div class="score-bot-left left relative">
														<p><?php echo esc_html(get_post_meta($post->ID, "mvp_away_team", true)); ?><br>
														<?php echo esc_html(get_post_meta($post->ID, "mvp_home_team", true)); ?></p>
													</div><!--score-bot-left-->
													<?php $mvp_show_score = get_post_meta($post->ID, "mvp_show_score", true); if ($mvp_show_score) { ?>
														<div class="score-bot-right relative">
															<p><?php echo esc_html(get_post_meta($post->ID, "mvp_away_team_score", true)); ?><br>
															<?php echo esc_html(get_post_meta($post->ID, "mvp_home_team_score", true)); ?></p>
														</div><!--score-bot-right-->
													<?php } ?>
												</div><!--score-bot-->
												<div class="score-top relative">
													<p><?php echo esc_html(get_post_meta($post->ID, "mvp_status", true)); ?></p>
												</div><!--score-top-->
												<?php $mvp_link_post = get_post_meta($post->ID, "mvp_link_post", true); if ($mvp_link_post) { ?></a><?php } ?>
											</li>
											<?php endwhile; ?>		
										</ul>
									</div><!--score-cont-->
								</div><!--score-tab5-->
							<?php } ?>
							<?php if ( get_option('mvp_score_name6') ) { ?>
								<div id="score-tab6" class="carousel es-carousel es-carousel-wrapper tabber-content">
									<div class="score-cont">
										<ul class="score-list slides left relative">
											<?php global $post; $score_cat6 = get_option('mvp_score_cat6'); $recent = new WP_Query(array( 'post_type' => 'scoreboard', 'posts_per_page' => '999', 'tax_query' => array(array( 'taxonomy' => 'scores_cat', 'field' => 'slug', 'terms' => $score_cat6 ))  )); while($recent->have_posts()) : $recent->the_post();?>
											<li>
												<?php $mvp_link_post = get_post_meta($post->ID, "mvp_link_post", true); if ($mvp_link_post) { ?><a href="<?php the_permalink(); ?>" rel="bookmark"><?php } ?>
												<div class="score-bot left relative">
													<div class="score-bot-left left relative">
														<p><?php echo esc_html(get_post_meta($post->ID, "mvp_away_team", true)); ?><br>
														<?php echo esc_html(get_post_meta($post->ID, "mvp_home_team", true)); ?></p>
													</div><!--score-bot-left-->
													<?php $mvp_show_score = get_post_meta($post->ID, "mvp_show_score", true); if ($mvp_show_score) { ?>
														<div class="score-bot-right relative">
															<p><?php echo esc_html(get_post_meta($post->ID, "mvp_away_team_score", true)); ?><br>
															<?php echo esc_html(get_post_meta($post->ID, "mvp_home_team_score", true)); ?></p>
														</div><!--score-bot-right-->
													<?php } ?>
												</div><!--score-bot-->
												<div class="score-top relative">
													<p><?php echo esc_html(get_post_meta($post->ID, "mvp_status", true)); ?></p>
												</div><!--score-top-->
												<?php $mvp_link_post = get_post_meta($post->ID, "mvp_link_post", true); if ($mvp_link_post) { ?></a><?php } ?>
											</li>
											<?php endwhile; ?>		
										</ul>
									</div><!--score-cont-->
								</div><!--score-tab6-->
							<?php } ?>
							<?php if ( get_option('mvp_score_name7') ) { ?>
								<div id="score-tab7" class="carousel es-carousel es-carousel-wrapper tabber-content">
									<div class="score-cont">
										<ul class="score-list slides left relative">
											<?php global $post; $score_cat7 = get_option('mvp_score_cat7'); $recent = new WP_Query(array( 'post_type' => 'scoreboard', 'posts_per_page' => '999', 'tax_query' => array(array( 'taxonomy' => 'scores_cat', 'field' => 'slug', 'terms' => $score_cat7 ))  )); while($recent->have_posts()) : $recent->the_post();?>
											<li>
												<?php $mvp_link_post = get_post_meta($post->ID, "mvp_link_post", true); if ($mvp_link_post) { ?><a href="<?php the_permalink(); ?>" rel="bookmark"><?php } ?>
												<div class="score-bot left relative">
													<div class="score-bot-left left relative">
														<p><?php echo esc_html(get_post_meta($post->ID, "mvp_away_team", true)); ?><br>
														<?php echo esc_html(get_post_meta($post->ID, "mvp_home_team", true)); ?></p>
													</div><!--score-bot-left-->
													<?php $mvp_show_score = get_post_meta($post->ID, "mvp_show_score", true); if ($mvp_show_score) { ?>
														<div class="score-bot-right relative">
															<p><?php echo esc_html(get_post_meta($post->ID, "mvp_away_team_score", true)); ?><br>
															<?php echo esc_html(get_post_meta($post->ID, "mvp_home_team_score", true)); ?></p>
														</div><!--score-bot-right-->
													<?php } ?>
												</div><!--score-bot-->
												<div class="score-top relative">
													<p><?php echo esc_html(get_post_meta($post->ID, "mvp_status", true)); ?></p>
												</div><!--score-top-->
												<?php $mvp_link_post = get_post_meta($post->ID, "mvp_link_post", true); if ($mvp_link_post) { ?></a><?php } ?>
											</li>
											<?php endwhile; ?>		
										</ul>
									</div><!--score-cont-->
								</div><!--score-tab7-->
							<?php } ?>
							<?php if ( get_option('mvp_score_name8') ) { ?>
								<div id="score-tab8" class="carousel es-carousel es-carousel-wrapper tabber-content">
									<div class="score-cont">
										<ul class="score-list slides left relative">
											<?php global $post; $score_cat8 = get_option('mvp_score_cat8'); $recent = new WP_Query(array( 'post_type' => 'scoreboard', 'posts_per_page' => '999', 'tax_query' => array(array( 'taxonomy' => 'scores_cat', 'field' => 'slug', 'terms' => $score_cat8 ))  )); while($recent->have_posts()) : $recent->the_post();?>
											<li>
												<?php $mvp_link_post = get_post_meta($post->ID, "mvp_link_post", true); if ($mvp_link_post) { ?><a href="<?php the_permalink(); ?>" rel="bookmark"><?php } ?>
												<div class="score-bot left relative">
													<div class="score-bot-left left relative">
														<p><?php echo esc_html(get_post_meta($post->ID, "mvp_away_team", true)); ?><br>
														<?php echo esc_html(get_post_meta($post->ID, "mvp_home_team", true)); ?></p>
													</div><!--score-bot-left-->
													<?php $mvp_show_score = get_post_meta($post->ID, "mvp_show_score", true); if ($mvp_show_score) { ?>
														<div class="score-bot-right relative">
															<p><?php echo esc_html(get_post_meta($post->ID, "mvp_away_team_score", true)); ?><br>
															<?php echo esc_html(get_post_meta($post->ID, "mvp_home_team_score", true)); ?></p>
														</div><!--score-bot-right-->
													<?php } ?>
												</div><!--score-bot-->
												<div class="score-top relative">
													<p><?php echo esc_html(get_post_meta($post->ID, "mvp_status", true)); ?></p>
												</div><!--score-top-->
												<?php $mvp_link_post = get_post_meta($post->ID, "mvp_link_post", true); if ($mvp_link_post) { ?></a><?php } ?>
											</li>
											<?php endwhile; ?>		
										</ul>
									</div><!--score-cont-->
								</div><!--score-tab8-->
							<?php } ?>
							<?php if ( get_option('mvp_score_name9') ) { ?>
								<div id="score-tab9" class="carousel es-carousel es-carousel-wrapper tabber-content">
									<div class="score-cont">
										<ul class="score-list slides left relative">
											<?php global $post; $score_cat9 = get_option('mvp_score_cat9'); $recent = new WP_Query(array( 'post_type' => 'scoreboard', 'posts_per_page' => '999', 'tax_query' => array(array( 'taxonomy' => 'scores_cat', 'field' => 'slug', 'terms' => $score_cat9 ))  )); while($recent->have_posts()) : $recent->the_post();?>
											<li>
												<?php $mvp_link_post = get_post_meta($post->ID, "mvp_link_post", true); if ($mvp_link_post) { ?><a href="<?php the_permalink(); ?>" rel="bookmark"><?php } ?>
												<div class="score-bot left relative">
													<div class="score-bot-left left relative">
														<p><?php echo esc_html(get_post_meta($post->ID, "mvp_away_team", true)); ?><br>
														<?php echo esc_html(get_post_meta($post->ID, "mvp_home_team", true)); ?></p>
													</div><!--score-bot-left-->
													<?php $mvp_show_score = get_post_meta($post->ID, "mvp_show_score", true); if ($mvp_show_score) { ?>
														<div class="score-bot-right relative">
															<p><?php echo esc_html(get_post_meta($post->ID, "mvp_away_team_score", true)); ?><br>
															<?php echo esc_html(get_post_meta($post->ID, "mvp_home_team_score", true)); ?></p>
														</div><!--score-bot-right-->
													<?php } ?>
												</div><!--score-bot-->
												<div class="score-top relative">
													<p><?php echo esc_html(get_post_meta($post->ID, "mvp_status", true)); ?></p>
												</div><!--score-top-->
												<?php $mvp_link_post = get_post_meta($post->ID, "mvp_link_post", true); if ($mvp_link_post) { ?></a><?php } ?>
											</li>
											<?php endwhile; ?>		
										</ul>
									</div><!--score-cont-->
								</div><!--score-tab9-->
							<?php } ?>
							<?php if ( get_option('mvp_score_name10') ) { ?>
								<div id="score-tab10" class="carousel es-carousel es-carousel-wrapper tabber-content">
									<div class="score-cont">
										<ul class="score-list slides left relative">
											<?php global $post; $score_cat10 = get_option('mvp_score_cat10'); $recent = new WP_Query(array( 'post_type' => 'scoreboard', 'posts_per_page' => '999', 'tax_query' => array(array( 'taxonomy' => 'scores_cat', 'field' => 'slug', 'terms' => $score_cat10 ))  )); while($recent->have_posts()) : $recent->the_post();?>
											<li>
												<?php $mvp_link_post = get_post_meta($post->ID, "mvp_link_post", true); if ($mvp_link_post) { ?><a href="<?php the_permalink(); ?>" rel="bookmark"><?php } ?>
												<div class="score-bot left relative">
													<div class="score-bot-left left relative">
														<p><?php echo esc_html(get_post_meta($post->ID, "mvp_away_team", true)); ?><br>
														<?php echo esc_html(get_post_meta($post->ID, "mvp_home_team", true)); ?></p>
													</div><!--score-bot-left-->
													<?php $mvp_show_score = get_post_meta($post->ID, "mvp_show_score", true); if ($mvp_show_score) { ?>
														<div class="score-bot-right relative">
															<p><?php echo esc_html(get_post_meta($post->ID, "mvp_away_team_score", true)); ?><br>
															<?php echo esc_html(get_post_meta($post->ID, "mvp_home_team_score", true)); ?></p>
														</div><!--score-bot-right-->
													<?php } ?>
												</div><!--score-bot-->
												<div class="score-top relative">
													<p><?php echo esc_html(get_post_meta($post->ID, "mvp_status", true)); ?></p>
												</div><!--score-top-->
												<?php $mvp_link_post = get_post_meta($post->ID, "mvp_link_post", true); if ($mvp_link_post) { ?></a><?php } ?>
											</li>
											<?php endwhile; ?>		
										</ul>
									</div><!--score-cont-->
								</div><!--score-tab10-->
							<?php } ?>
						</div><!--score-main-->
					</div><!--score-in-->
					</div><!--tabber-container-->
				</div><!--score-out-->
			</div><!--score-cont-->
		</div><!--nav-in-->
	</div><!--nav-out-->
</div><!--score-wrap-->