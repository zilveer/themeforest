	<div id="scoreboard-main-wrapper">
		<div id="scoreboard-main-inner">
			<div class="tabber-container">
				<div id="score-nav-wrapper">
					<select class="tabs">
						<?php if ( get_option('mvp_score_name1') ) { ?><option value="#tab1"><?php echo get_option('mvp_score_name1'); ?></option><?php } ?>
						<?php if ( get_option('mvp_score_name2') ) { ?><option value="#tab2"><?php echo get_option('mvp_score_name2'); ?></option><?php } ?>
						<?php if ( get_option('mvp_score_name3') ) { ?><option value="#tab3"><?php echo get_option('mvp_score_name3'); ?></option><?php } ?>
						<?php if ( get_option('mvp_score_name4') ) { ?><option value="#tab4"><?php echo get_option('mvp_score_name4'); ?></option><?php } ?>
						<?php if ( get_option('mvp_score_name5') ) { ?><option value="#tab5"><?php echo get_option('mvp_score_name5'); ?></option><?php } ?>
						<?php if ( get_option('mvp_score_name6') ) { ?><option value="#tab6"><?php echo get_option('mvp_score_name6'); ?></option><?php } ?>
						<?php if ( get_option('mvp_score_name7') ) { ?><option value="#tab7"><?php echo get_option('mvp_score_name7'); ?></option><?php } ?>
						<?php if ( get_option('mvp_score_name8') ) { ?><option value="#tab8"><?php echo get_option('mvp_score_name8'); ?></option><?php } ?>
						<?php if ( get_option('mvp_score_name9') ) { ?><option value="#tab9"><?php echo get_option('mvp_score_name9'); ?></option><?php } ?>
						<?php if ( get_option('mvp_score_name10') ) { ?><option value="#tab10"><?php echo get_option('mvp_score_name10'); ?></a></option><?php } ?>
					</select>
				</div><!--score-nav-wrapper-->
				<div id="scoreboard-contain">
					<?php if ( get_option('mvp_score_name1') ) { ?>
						<div id="tab1" class="carousel es-carousel es-carousel-wrapper tabber-content">
							<div class="scoreboard-wrapper">
								<ul class="slides">
									<?php global $post; $score_cat1 = get_option('mvp_score_cat1'); $recent = new WP_Query(array( 'post_type' => 'scoreboard', 'posts_per_page' => '999', 'tax_query' => array(array( 'taxonomy' => 'scores_cat', 'field' => 'slug', 'terms' => $score_cat1 ))  )); while($recent->have_posts()) : $recent->the_post();?>
									<li>
										<?php $mvp_link_post = get_post_meta($post->ID, "mvp_link_post", true); if ($mvp_link_post) { ?><a href="<?php the_permalink(); ?>" rel="bookmark"><?php } ?>
										<div class="score-item-wrapper">
											<div class="score-teams-wrapper">
												<div class="score-teams">
													<?php echo get_post_meta($post->ID, "mvp_away_team", true); ?><br />
													<?php echo get_post_meta($post->ID, "mvp_home_team", true); ?>
												</div><!--score-teams-->
												<?php $mvp_show_score = get_post_meta($post->ID, "mvp_show_score", true); if ($mvp_show_score) { ?>
													<div class="score-right">
														<?php echo get_post_meta($post->ID, "mvp_away_team_score", true); ?><br />
														<?php echo get_post_meta($post->ID, "mvp_home_team_score", true); ?>
													</div><!--score-right-->
												<?php } ?>
											</div><!--score-teams-wrapper-->
											<div class="score-status-wrapper">
												<span class="score-status"><?php echo get_post_meta($post->ID, "mvp_status", true); ?></span>
											</div><!--score-status-wrapper-->
										</div><!--score-item-wrapper-->
										<?php $mvp_link_post = get_post_meta($post->ID, "mvp_link_post", true); if ($mvp_link_post) { ?></a><?php } ?>
									</li>
									<?php endwhile; ?>
								</ul>
							</div><!--scoreboard-wrapper-->
						</div><!--tab1-->
					<?php } ?>
					<?php if ( get_option('mvp_score_name2') ) { ?>
						<div id="tab2" class="carousel es-carousel es-carousel-wrapper tabber-content">
							<div class="scoreboard-wrapper">
								<ul class="slides">
									<?php global $post; $score_cat2 = get_option('mvp_score_cat2'); $recent = new WP_Query(array( 'post_type' => 'scoreboard', 'posts_per_page' => '999', 'tax_query' => array(array( 'taxonomy' => 'scores_cat', 'field' => 'slug', 'terms' => $score_cat2 ))  )); while($recent->have_posts()) : $recent->the_post();?>
									<li>
										<?php $mvp_link_post = get_post_meta($post->ID, "mvp_link_post", true); if ($mvp_link_post) { ?><a href="<?php the_permalink(); ?>" rel="bookmark"><?php } ?>
										<div class="score-item-wrapper">
											<div class="score-teams-wrapper">
												<div class="score-teams">
													<?php echo get_post_meta($post->ID, "mvp_away_team", true); ?><br />
													<?php echo get_post_meta($post->ID, "mvp_home_team", true); ?>
												</div><!--score-teams-->
												<?php $mvp_show_score = get_post_meta($post->ID, "mvp_show_score", true); if ($mvp_show_score) { ?>
													<div class="score-right">
														<?php echo get_post_meta($post->ID, "mvp_away_team_score", true); ?><br />
														<?php echo get_post_meta($post->ID, "mvp_home_team_score", true); ?>
													</div><!--score-right-->
												<?php } ?>
											</div><!--score-teams-wrapper-->
											<div class="score-status-wrapper">
												<span class="score-status"><?php echo get_post_meta($post->ID, "mvp_status", true); ?></span>
											</div><!--score-status-wrapper-->
										</div><!--score-item-wrapper-->
										<?php $mvp_link_post = get_post_meta($post->ID, "mvp_link_post", true); if ($mvp_link_post) { ?></a><?php } ?>
									</li>
									<?php endwhile; ?>
								</ul>
							</div><!--scoreboard-wrapper-->
						</div><!--tab2-->
					<?php } ?>
					<?php if ( get_option('mvp_score_name3') ) { ?>
						<div id="tab3" class="carousel es-carousel es-carousel-wrapper tabber-content">
							<div class="scoreboard-wrapper">
								<ul class="slides">
									<?php global $post; $score_cat3 = get_option('mvp_score_cat3'); $recent = new WP_Query(array( 'post_type' => 'scoreboard', 'posts_per_page' => '999', 'tax_query' => array(array( 'taxonomy' => 'scores_cat', 'field' => 'slug', 'terms' => $score_cat3 ))  )); while($recent->have_posts()) : $recent->the_post();?>
									<li>
										<?php $mvp_link_post = get_post_meta($post->ID, "mvp_link_post", true); if ($mvp_link_post) { ?><a href="<?php the_permalink(); ?>" rel="bookmark"><?php } ?>
										<div class="score-item-wrapper">
											<div class="score-teams-wrapper">
												<div class="score-teams">
													<?php echo get_post_meta($post->ID, "mvp_away_team", true); ?><br />
													<?php echo get_post_meta($post->ID, "mvp_home_team", true); ?>
												</div><!--score-teams-->
												<?php $mvp_show_score = get_post_meta($post->ID, "mvp_show_score", true); if ($mvp_show_score) { ?>
													<div class="score-right">
														<?php echo get_post_meta($post->ID, "mvp_away_team_score", true); ?><br />
														<?php echo get_post_meta($post->ID, "mvp_home_team_score", true); ?>
													</div><!--score-right-->
												<?php } ?>
											</div><!--score-teams-wrapper-->
											<div class="score-status-wrapper">
												<span class="score-status"><?php echo get_post_meta($post->ID, "mvp_status", true); ?></span>
											</div><!--score-status-wrapper-->
										</div><!--score-item-wrapper-->
										<?php $mvp_link_post = get_post_meta($post->ID, "mvp_link_post", true); if ($mvp_link_post) { ?></a><?php } ?>
									</li>
									<?php endwhile; ?>
								</ul>
							</div><!--scoreboard-wrapper-->
						</div><!--tab3-->
					<?php } ?>
					<?php if ( get_option('mvp_score_name4') ) { ?>
						<div id="tab4" class="carousel es-carousel es-carousel-wrapper tabber-content">
							<div class="scoreboard-wrapper">
								<ul class="slides">
									<?php global $post; $score_cat4 = get_option('mvp_score_cat4'); $recent = new WP_Query(array( 'post_type' => 'scoreboard', 'posts_per_page' => '999', 'tax_query' => array(array( 'taxonomy' => 'scores_cat', 'field' => 'slug', 'terms' => $score_cat4 ))  )); while($recent->have_posts()) : $recent->the_post();?>
									<li>
										<?php $mvp_link_post = get_post_meta($post->ID, "mvp_link_post", true); if ($mvp_link_post) { ?><a href="<?php the_permalink(); ?>" rel="bookmark"><?php } ?>
										<div class="score-item-wrapper">
											<div class="score-teams-wrapper">
												<div class="score-teams">
													<?php echo get_post_meta($post->ID, "mvp_away_team", true); ?><br />
													<?php echo get_post_meta($post->ID, "mvp_home_team", true); ?>
												</div><!--score-teams-->
												<?php $mvp_show_score = get_post_meta($post->ID, "mvp_show_score", true); if ($mvp_show_score) { ?>
													<div class="score-right">
														<?php echo get_post_meta($post->ID, "mvp_away_team_score", true); ?><br />
														<?php echo get_post_meta($post->ID, "mvp_home_team_score", true); ?>
													</div><!--score-right-->
												<?php } ?>
											</div><!--score-teams-wrapper-->
											<div class="score-status-wrapper">
												<span class="score-status"><?php echo get_post_meta($post->ID, "mvp_status", true); ?></span>
											</div><!--score-status-wrapper-->
										</div><!--score-item-wrapper-->
										<?php $mvp_link_post = get_post_meta($post->ID, "mvp_link_post", true); if ($mvp_link_post) { ?></a><?php } ?>
									</li>
									<?php endwhile; ?>
								</ul>
							</div><!--scoreboard-wrapper-->
						</div><!--tab4-->
					<?php } ?>
					<?php if ( get_option('mvp_score_name5') ) { ?>
						<div id="tab5" class="carousel es-carousel es-carousel-wrapper tabber-content">
							<div class="scoreboard-wrapper">
								<ul class="slides">
									<?php global $post; $score_cat5 = get_option('mvp_score_cat5'); $recent = new WP_Query(array( 'post_type' => 'scoreboard', 'posts_per_page' => '999', 'tax_query' => array(array( 'taxonomy' => 'scores_cat', 'field' => 'slug', 'terms' => $score_cat5 ))  )); while($recent->have_posts()) : $recent->the_post();?>
									<li>
										<?php $mvp_link_post = get_post_meta($post->ID, "mvp_link_post", true); if ($mvp_link_post) { ?><a href="<?php the_permalink(); ?>" rel="bookmark"><?php } ?>
										<div class="score-item-wrapper">
											<div class="score-teams-wrapper">
												<div class="score-teams">
													<?php echo get_post_meta($post->ID, "mvp_away_team", true); ?><br />
													<?php echo get_post_meta($post->ID, "mvp_home_team", true); ?>
												</div><!--score-teams-->
												<?php $mvp_show_score = get_post_meta($post->ID, "mvp_show_score", true); if ($mvp_show_score) { ?>
													<div class="score-right">
														<?php echo get_post_meta($post->ID, "mvp_away_team_score", true); ?><br />
														<?php echo get_post_meta($post->ID, "mvp_home_team_score", true); ?>
													</div><!--score-right-->
												<?php } ?>
											</div><!--score-teams-wrapper-->
											<div class="score-status-wrapper">
												<span class="score-status"><?php echo get_post_meta($post->ID, "mvp_status", true); ?></span>
											</div><!--score-status-wrapper-->
										</div><!--score-item-wrapper-->
										<?php $mvp_link_post = get_post_meta($post->ID, "mvp_link_post", true); if ($mvp_link_post) { ?></a><?php } ?>
									</li>
									<?php endwhile; ?>
								</ul>
							</div><!--scoreboard-wrapper-->
						</div><!--tab5-->
					<?php } ?>
					<?php if ( get_option('mvp_score_name6') ) { ?>
						<div id="tab6" class="carousel es-carousel es-carousel-wrapper tabber-content">
							<div class="scoreboard-wrapper">
								<ul class="slides">
									<?php global $post; $score_cat6 = get_option('mvp_score_cat6'); $recent = new WP_Query(array( 'post_type' => 'scoreboard', 'posts_per_page' => '999', 'tax_query' => array(array( 'taxonomy' => 'scores_cat', 'field' => 'slug', 'terms' => $score_cat6 ))  )); while($recent->have_posts()) : $recent->the_post();?>
									<li>
										<?php $mvp_link_post = get_post_meta($post->ID, "mvp_link_post", true); if ($mvp_link_post) { ?><a href="<?php the_permalink(); ?>" rel="bookmark"><?php } ?>
										<div class="score-item-wrapper">
											<div class="score-teams-wrapper">
												<div class="score-teams">
													<?php echo get_post_meta($post->ID, "mvp_away_team", true); ?><br />
													<?php echo get_post_meta($post->ID, "mvp_home_team", true); ?>
												</div><!--score-teams-->
												<?php $mvp_show_score = get_post_meta($post->ID, "mvp_show_score", true); if ($mvp_show_score) { ?>
													<div class="score-right">
														<?php echo get_post_meta($post->ID, "mvp_away_team_score", true); ?><br />
														<?php echo get_post_meta($post->ID, "mvp_home_team_score", true); ?>
													</div><!--score-right-->
												<?php } ?>
											</div><!--score-teams-wrapper-->
											<div class="score-status-wrapper">
												<span class="score-status"><?php echo get_post_meta($post->ID, "mvp_status", true); ?></span>
											</div><!--score-status-wrapper-->
										</div><!--score-item-wrapper-->
										<?php $mvp_link_post = get_post_meta($post->ID, "mvp_link_post", true); if ($mvp_link_post) { ?></a><?php } ?>
									</li>
									<?php endwhile; ?>
								</ul>
							</div><!--scoreboard-wrapper-->
						</div><!--tab6-->
					<?php } ?>
					<?php if ( get_option('mvp_score_name7') ) { ?>
						<div id="tab7" class="carousel es-carousel es-carousel-wrapper tabber-content">
							<div class="scoreboard-wrapper">
								<ul class="slides">
									<?php global $post; $score_cat7 = get_option('mvp_score_cat7'); $recent = new WP_Query(array( 'post_type' => 'scoreboard', 'posts_per_page' => '999', 'tax_query' => array(array( 'taxonomy' => 'scores_cat', 'field' => 'slug', 'terms' => $score_cat7 ))  )); while($recent->have_posts()) : $recent->the_post();?>
									<li>
										<?php $mvp_link_post = get_post_meta($post->ID, "mvp_link_post", true); if ($mvp_link_post) { ?><a href="<?php the_permalink(); ?>" rel="bookmark"><?php } ?>
										<div class="score-item-wrapper">
											<div class="score-teams-wrapper">
												<div class="score-teams">
													<?php echo get_post_meta($post->ID, "mvp_away_team", true); ?><br />
													<?php echo get_post_meta($post->ID, "mvp_home_team", true); ?>
												</div><!--score-teams-->
												<?php $mvp_show_score = get_post_meta($post->ID, "mvp_show_score", true); if ($mvp_show_score) { ?>
													<div class="score-right">
														<?php echo get_post_meta($post->ID, "mvp_away_team_score", true); ?><br />
														<?php echo get_post_meta($post->ID, "mvp_home_team_score", true); ?>
													</div><!--score-right-->
												<?php } ?>
											</div><!--score-teams-wrapper-->
											<div class="score-status-wrapper">
												<span class="score-status"><?php echo get_post_meta($post->ID, "mvp_status", true); ?></span>
											</div><!--score-status-wrapper-->
										</div><!--score-item-wrapper-->
										<?php $mvp_link_post = get_post_meta($post->ID, "mvp_link_post", true); if ($mvp_link_post) { ?></a><?php } ?>
									</li>
									<?php endwhile; ?>
								</ul>
							</div><!--scoreboard-wrapper-->
						</div><!--tab7-->
					<?php } ?>
					<?php if ( get_option('mvp_score_name8') ) { ?>
						<div id="tab8" class="carousel es-carousel es-carousel-wrapper tabber-content">
							<div class="scoreboard-wrapper">
								<ul class="slides">
									<?php global $post; $score_cat8 = get_option('mvp_score_cat8'); $recent = new WP_Query(array( 'post_type' => 'scoreboard', 'posts_per_page' => '999', 'tax_query' => array(array( 'taxonomy' => 'scores_cat', 'field' => 'slug', 'terms' => $score_cat8 ))  )); while($recent->have_posts()) : $recent->the_post();?>
									<li>
										<?php $mvp_link_post = get_post_meta($post->ID, "mvp_link_post", true); if ($mvp_link_post) { ?><a href="<?php the_permalink(); ?>" rel="bookmark"><?php } ?>
										<div class="score-item-wrapper">
											<div class="score-teams-wrapper">
												<div class="score-teams">
													<?php echo get_post_meta($post->ID, "mvp_away_team", true); ?><br />
													<?php echo get_post_meta($post->ID, "mvp_home_team", true); ?>
												</div><!--score-teams-->
												<?php $mvp_show_score = get_post_meta($post->ID, "mvp_show_score", true); if ($mvp_show_score) { ?>
													<div class="score-right">
														<?php echo get_post_meta($post->ID, "mvp_away_team_score", true); ?><br />
														<?php echo get_post_meta($post->ID, "mvp_home_team_score", true); ?>
													</div><!--score-right-->
												<?php } ?>
											</div><!--score-teams-wrapper-->
											<div class="score-status-wrapper">
												<span class="score-status"><?php echo get_post_meta($post->ID, "mvp_status", true); ?></span>
											</div><!--score-status-wrapper-->
										</div><!--score-item-wrapper-->
										<?php $mvp_link_post = get_post_meta($post->ID, "mvp_link_post", true); if ($mvp_link_post) { ?></a><?php } ?>
									</li>
									<?php endwhile; ?>
								</ul>
							</div><!--scoreboard-wrapper-->
						</div><!--tab8-->
					<?php } ?>
					<?php if ( get_option('mvp_score_name9') ) { ?>
						<div id="tab9" class="carousel es-carousel es-carousel-wrapper tabber-content">
							<div class="scoreboard-wrapper">
								<ul class="slides">
									<?php global $post; $score_cat9 = get_option('mvp_score_cat9'); $recent = new WP_Query(array( 'post_type' => 'scoreboard', 'posts_per_page' => '999', 'tax_query' => array(array( 'taxonomy' => 'scores_cat', 'field' => 'slug', 'terms' => $score_cat9 ))  )); while($recent->have_posts()) : $recent->the_post();?>
									<li>
										<?php $mvp_link_post = get_post_meta($post->ID, "mvp_link_post", true); if ($mvp_link_post) { ?><a href="<?php the_permalink(); ?>" rel="bookmark"><?php } ?>
										<div class="score-item-wrapper">
											<div class="score-teams-wrapper">
												<div class="score-teams">
													<?php echo get_post_meta($post->ID, "mvp_away_team", true); ?><br />
													<?php echo get_post_meta($post->ID, "mvp_home_team", true); ?>
												</div><!--score-teams-->
												<?php $mvp_show_score = get_post_meta($post->ID, "mvp_show_score", true); if ($mvp_show_score) { ?>
													<div class="score-right">
														<?php echo get_post_meta($post->ID, "mvp_away_team_score", true); ?><br />
														<?php echo get_post_meta($post->ID, "mvp_home_team_score", true); ?>
													</div><!--score-right-->
												<?php } ?>
											</div><!--score-teams-wrapper-->
											<div class="score-status-wrapper">
												<span class="score-status"><?php echo get_post_meta($post->ID, "mvp_status", true); ?></span>
											</div><!--score-status-wrapper-->
										</div><!--score-item-wrapper-->
										<?php $mvp_link_post = get_post_meta($post->ID, "mvp_link_post", true); if ($mvp_link_post) { ?></a><?php } ?>
									</li>
									<?php endwhile; ?>
								</ul>
							</div><!--scoreboard-wrapper-->
						</div><!--tab9-->
					<?php } ?>
					<?php if ( get_option('mvp_score_name10') ) { ?>
						<div id="tab10" class="carousel es-carousel es-carousel-wrapper tabber-content">
							<div class="scoreboard-wrapper">
								<ul class="slides">
									<?php global $post; $score_cat10 = get_option('mvp_score_cat10'); $recent = new WP_Query(array( 'post_type' => 'scoreboard', 'posts_per_page' => '999', 'tax_query' => array(array( 'taxonomy' => 'scores_cat', 'field' => 'slug', 'terms' => $score_cat10 ))  )); while($recent->have_posts()) : $recent->the_post();?>
									<li>
										<?php $mvp_link_post = get_post_meta($post->ID, "mvp_link_post", true); if ($mvp_link_post) { ?><a href="<?php the_permalink(); ?>" rel="bookmark"><?php } ?>
										<div class="score-item-wrapper">
											<div class="score-teams-wrapper">
												<div class="score-teams">
													<?php echo get_post_meta($post->ID, "mvp_away_team", true); ?><br />
													<?php echo get_post_meta($post->ID, "mvp_home_team", true); ?>
												</div><!--score-teams-->
												<?php $mvp_show_score = get_post_meta($post->ID, "mvp_show_score", true); if ($mvp_show_score) { ?>
													<div class="score-right">
														<?php echo get_post_meta($post->ID, "mvp_away_team_score", true); ?><br />
														<?php echo get_post_meta($post->ID, "mvp_home_team_score", true); ?>
													</div><!--score-right-->
												<?php } ?>
											</div><!--score-teams-wrapper-->
											<div class="score-status-wrapper">
												<span class="score-status"><?php echo get_post_meta($post->ID, "mvp_status", true); ?></span>
											</div><!--score-status-wrapper-->
										</div><!--score-item-wrapper-->
										<?php $mvp_link_post = get_post_meta($post->ID, "mvp_link_post", true); if ($mvp_link_post) { ?></a><?php } ?>
									</li>
									<?php endwhile; ?>
								</ul>
							</div><!--scoreboard-wrapper-->
						</div><!--tab10-->
					<?php } ?>
				</div><!--scoreboard-contain-->
			</div><!--tabber-container-->
		</div><!--scoreboard-main-inner-->
	</div><!--scoreboard-main-wrapper-->