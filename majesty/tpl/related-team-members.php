<?php
	global $majesty_options;
	$title			= $majesty_options['related_member_title'];
	$sub_title		= $majesty_options['related_member_sub_title'];
	$num			= $majesty_options['related_member_num'];
	$order			= $majesty_options['related_member_order'];
	$orderby		= $majesty_options['related_member_orderby'];
	$bg				= $majesty_options['related_member_bg'];
	$bg_url			= $majesty_options['related_bg_url'];
	$bg_parallax	= $majesty_options['related_bg_parallax'];
	$bg_trans		= $majesty_options['related_bg_trans'];
	
	if( $bg == 'background' && ! empty( $bg_url ) ) {
		$css = 'our_team dark text-center';	
	} elseif( $bg == 'gray' ) {
		$css = 'our_team gray-bg text-center';
	} else {
		$css = 'our_team text-center';
	}
	
	$default = array(
		'post_type' 			=> 'team-member',
		'ignore_sticky_posts' 	=> 1,
		'posts_per_page'		=> 9,
		'order'					=> 'DESC',
		'orderby'				=> 'date', 
	);
	$args = array(
		'post_type' 			=> 'team-member',
		'ignore_sticky_posts' 	=> 1,
		'posts_per_page'		=> absint( $num ),
		'order'					=> esc_attr($order), //ASC
		'orderby'				=> esc_attr($orderby), 
	);
	$args = wp_parse_args( $args, $default );
	
	$team_query = new WP_Query( $args );
	if ( $team_query->have_posts() ) { ?>
	
		<section id="related-team-members" class="<?php echo esc_attr( $css ); ?>">
		<?php 
		if( $bg == 'background' && ! empty( $bg_url ) ) { 
			if( $bg_parallax ) { ?>
				<div class="bcg related-bg" data-center="background-position: 50% 0px;" data-bottom-top="background-position: 50% 100px;" data-top-bottom="background-position: 50% -100px;" data-anchor-target="#related-team-members">
				<?php } else { ?>
				<div class="custom-bg related-bg">
				<?php } ?>
				<?php if( ! empty( $bg_trans ) ) { ?>
					<div class="bg-transparent <?php echo esc_attr( $bg_trans ); ?>">
				<?php } ?>
					
		<?php } ?>	
					<div class="container">
						<div class="row"> 
							<!-- Head Title -->
							<div class="head_title">
								<i class="icon-intro"></i>
								<h2><?php echo esc_attr( $title ); ?></h2>
								<?php if( ! empty( $sub_title ) ) { ?>
									<span class="welcome"><?php echo esc_attr( $sub_title ); ?></span>
								<?php } ?>
							</div>
							<!-- End# Head Title -->
							<div id="our_team_carousel" class="owl-carousel owl-theme">
							<?php
								while ( $team_query->have_posts() ) {
								$team_query->the_post();
							?>
									<div class="item">
										<div class="overlay_content clearfix">
											<div class="overlay_item">
												<?php
													if ( has_post_thumbnail() ) {
														the_post_thumbnail('humb-450', array('class'=>'img-responsive'));
													}
													$role 			= get_post_meta( get_the_ID(), '_byline', true);
													$email			= get_post_meta( get_the_ID(), '_contact_email', true);
													$facebook_url 	= get_post_meta( get_the_ID(), '_facebook', true);
													$gplus_url  	= get_post_meta( get_the_ID(), '_googleplus', true);
													$linkedin_url  	= get_post_meta( get_the_ID(), '_linkedin', true);
													$twitter_url  	= '';
													if( get_post_meta( get_the_ID(), '_twitter', true) ) {
														$twitter_url  = esc_url ( 'https://twitter.com/'. get_post_meta( get_the_ID(), '_twitter', true) );
													}
													$display_email = $majesty_options['related_member_display_email'];
												?>
												<div class="overlay">
													<div class="icons">
														<?php if ( ! empty( $facebook_url ) ) { ?>
															<a href="<?php echo esc_url( $facebook_url ); ?>" title="<?php esc_html_e('Facebook', 'theme-majesty'); ?>"><i class="fa fa-facebook"></i></a>
														<?php } ?>
														<?php if ( ! empty ( $twitter_url ) ) { ?>
															<a href="<?php echo esc_url( $twitter_url ); ?>" title="<?php esc_html_e('Twitter', 'theme-majesty'); ?>"><i class="fa fa-twitter"></i></a>
														<?php } ?>
														<?php if ( ! empty ( $linkedin_url ) ) { ?>
															<a href="<?php echo esc_url( $linkedin_url ); ?>" title="<?php esc_html_e('Linkedin', 'theme-majesty'); ?>"><i class="fa fa-linkedin"></i></a>
														<?php } ?>
														<?php if ( ! empty ( $gplus_url ) ) { ?>
															<a href="<?php echo esc_url( $gplus_url ); ?>" title="<?php esc_html_e('Google Plus', 'theme-majesty'); ?>"><i class="fa fa-google-plus"></i></a>
														<?php } ?>
														<?php if ( ! empty ( $email ) && $display_email ) { ?>
															<a href="mailto:<?php echo antispambot( sanitize_email($email),0 ); ?>" title="<?php esc_html_e('Email', 'theme-majesty'); ?>"><i class="fa fa-envelope-o"></i></a>
														<?php } ?>

														<a class="close-overlay hidden">x</a>
													</div>
												</div>
												<div class="desc">
													<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
													<?php
														if( $role ) {
															echo '<p>'. esc_attr( $role ) .'</p>';
														}
													?>
												</div>
											</div>
										</div>
									</div>
							<?php
								}
							?>
							</div>
						</div>
					</div>
			<?php if( $bg == 'background' && ! empty( $bg_url ) ) { ?>
				<?php if( ! empty( $bg_trans ) ) { ?>
					</div>
				<?php } ?>
			</div>
			<?php } ?>
		</section>
<?php
	}
	wp_reset_postdata();
?>