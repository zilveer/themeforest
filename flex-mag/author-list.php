<?php
	/* Template Name: Authors List */
?>
<?php get_header(); ?>
<div id="home-main-wrap" class="left relative">
	<div class="home-wrap-out1">
		<div class="home-wrap-in1">
			<div id="home-left-wrap" class="left relative">
				<div id="home-left-col" class="relative">
					<div id="home-mid-wrap" class="left relative">
						<div id="archive-list-wrap" class="left relative">
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
								<h1 class="arch-head"><?php the_title(); ?></h1>
							<?php endwhile; endif; ?>
<div class="archive-list-left left relative">
								<?php $mvp_users = get_users('orderby=post_count&order=DESC'); foreach($mvp_users as $user) { $post_count = count_user_posts( $user->ID ); if($post_count < 1) continue; ?>
								<div class="author-page-box left relative">
									<div class="author-page-out">
										<div class="author-page-img left relative">
											<?php echo get_avatar( $user->user_email, '63' ); ?>
										</div><!--author-page-img-->
										<div class="author-page-in">
											<div class="author-page-text left relative">
												<h2 class="author-list-head"><a href="<?php echo get_author_posts_url( $user->ID ); ?>"><?php echo esc_html( $user->display_name ); ?></a></h2>
												<ul class="author-social left relative">
													<?php $authordesc = $user->facebook; if ( ! empty ( $authordesc ) ) { ?>
														<li class="fb-item">
															<a href="<?php echo esc_url( $user->facebook ); ?>" alt="Facebook" class="fb-but" target="_blank"><i class="fa fa-facebook-square fa-2"></i></a>
														</li>
													<?php } ?>
													<?php $authordesc = $user->twitter; if ( ! empty ( $authordesc ) ) { ?>
														<li class="twitter-item">
															<a href="<?php echo esc_url( $user->twitter ); ?>" alt="Twitter" class="twitter-but" target="_blank"><i class="fa fa-twitter-square fa-2"></i></a>
														</li>
													<?php } ?>
													<?php $authordesc = $user->pinterest; if ( ! empty ( $authordesc ) ) { ?>
														<li class="pinterest-item">
															<a href="<?php echo esc_url( $user->pinterest ); ?>" alt="Pinterest" class="pinterest-but" target="_blank"><i class="fa fa-pinterest-square fa-2"></i></a>
														</li>
													<?php } ?>
													<?php $authordesc = $user->googleplus; if ( ! empty ( $authordesc ) ) { ?>
														<li class="google-item">
															<a href="<?php echo esc_url( $user->googleplus ); ?>" alt="Google Plus" class="google-but" target="_blank"><i class="fa fa-google-plus-square fa-2"></i></a>
														</li>
													<?php } ?>
													<?php $authordesc = $user->instagram; if ( ! empty ( $authordesc ) ) { ?>
														<li class="instagram-item">
															<a href="<?php echo esc_url( $user->instagram ); ?>" alt="Instagram" class="instagram-but" target="_blank"><i class="fa fa-instagram fa-2"></i></a>
														</li>
													<?php } ?>
													<?php $authordesc = $user->linkedin; if ( ! empty ( $authordesc ) ) { ?>
														<li class="linkedin-item">
															<a href="<?php echo esc_url( $user->linkedin ); ?>" alt="Linkedin" class="linkedin-but" target="_blank"><i class="fa fa-linkedin-square fa-2"></i></a>
														</li>
													<?php } ?>
													<?php $mvp_email = get_option('mvp_author_email'); if ($mvp_email == "true") { ?>
													<li class="email-item">
														<a href="mailto:<?php echo esc_html( $user->user_email); ?>"><i class="fa fa-envelope-square fa-2"></i></a>
													</li>
													<?php } ?>
												</ul>
											</div><!--author-page-text-->
										</div><!--author-page-in-->
									</div><!--author-page-out-->
								</div><!--author-page-box-->
								<div class="author-box-bot left relative">
									<p><?php echo wp_kses_post( $user->description ); ?></p>
								</div><!--author-box-bot-->
								<?php } ?>
							</div><!--archive-list-left-->
						</div><!--archive-list-wrap-->
					</div><!--home-mid-wrap-->
				</div><!--home-left-col-->
			</div><!--home-left-wrap-->
		</div><!--home-wrap-in1-->
		<div id="arch-right-col" class="relative">
			<?php get_sidebar(); ?>
		</div><!--home-right-col-->
	</div><!--home-wrap-out1-->
</div><!--home-main-wrap-->
<?php get_footer(); ?>