<?php 
	
	// Globals
	global $dd_sn;
	global $dd_post_class;
	global $dd_thumb_size;
	global $dd_count;
	global $dd_max_count;
	global $dd_style;
	global $more; $more = 0; // Make the more tag work

	// Default - Post Class
	if ( ! isset( $dd_post_class ) ) {
		$dd_post_class = 'four columns ';
	}

	// Default - Thumb Size
	if ( ! isset( $dd_thumb_size ) ) {
		$dd_thumb_size = 'dd-one-fourth';	
	}

	// Default - Post Style
	if ( ! isset( $dd_style ) ) {
		$dd_style = 1;
	}

	// Post Class - Append - Thumbnail
	if ( has_post_thumbnail() ) {
		$dd_post_class_append = 'has-thumb ';
	} else {
		$dd_post_class_append = '';
	}

	// Post Class - Last (column)
	if ( $dd_count == $dd_max_count ) {
		$last_class = 'last';
		$dd_count = 0;
	} else {
		$last_class = '';
	}

	if ( $dd_count == 1 ) {
		$last_class = 'clear';
	}

	$staff_position = get_post_meta( get_the_ID(), $dd_sn . 'position', true );
	$staff_twitter = get_post_meta( get_the_ID(), $dd_sn . 'twitter', true );
	$staff_facebook = get_post_meta( get_the_ID(), $dd_sn . 'facebook', true );
	$staff_gplus = get_post_meta( get_the_ID(), $dd_sn . 'gplus', true );
	$staff_linkedin = get_post_meta( get_the_ID(), $dd_sn . 'linkedin', true );
	$staff_email = get_post_meta( get_the_ID(), $dd_sn . 'email', true );


?>

<?php if ( is_single() ) : ?>
		
	<div <?php post_class( 'staff-member-single' ); ?>>

		<div class="staff-member-single-main">

			<h1 class="staff-member-single-title"><?php the_title(); ?></h1>

			<div class="staff-member-single-meta clearfix">
				
				<?php if ( $staff_position ) : ?>

					<div class="staff-member-position fl"><?php echo $staff_position; ?></div>

				<?php endif; ?>

				<?php if ( $staff_twitter || $staff_facebook || $staff_gplus || $staff_linkedin ) : ?>

					<div class="staff-member-social fr">
						
						<?php if ( $staff_twitter ) : ?>

							<a href="<?php echo $staff_twitter; ?>"><span class="icon-social-twitter"></span></a>

						<?php endif; ?>

						<?php if ( $staff_facebook ) : ?>

							<a href="<?php echo $staff_facebook; ?>"><span class="icon-social-facebook"></span></a>

						<?php endif; ?>

						<?php if ( $staff_gplus ) : ?>

							<a href="<?php echo $staff_gplus; ?>"><span class="icon-social-gplus"></span></a>

						<?php endif; ?>

						<?php if ( $staff_linkedin ) : ?>

							<a href="<?php echo $staff_linkedin; ?>"><span class="icon-social-linkedin"></span></a>

						<?php endif; ?>

						<?php if ( $staff_email ) : ?>

							<a href="<?php echo $staff_email; ?>"><span class="icon-mail"></span></a>

						<?php endif; ?>

					</div><!-- .staff-member-social -->

				<?php endif; ?>

			</div><!-- .staff-member-single-meta -->

			<div class="staff-member-single-content">

				<?php the_content(); ?>

			</div><!-- .staff-member-single-content -->

			<div id="post-pagination">
				<?php 
					$args = array(
						'before' => '',
						'after' => '',
						'link_before' => '<span class="dd-button">',
						'link_after' => '</span>',
						'next_or_number' => 'number',
						'pagelink' => '%',
					);
					wp_link_pages( $args ); 
				?>
			</div><!-- #post-pagination -->

		</div><!-- .staff-member-single-main -->

	</div><!-- .staff-member-single -->

<?php else : ?>

	<div <?php post_class( 'staff-member ' . $dd_post_class . $dd_post_class_append . $last_class ); ?>>

		<?php if ( $dd_style == '1' ) : ?>

			<div class="staff-member-inner">

				<div class="staff-member-thumb">

					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $dd_thumb_size ); ?></a>

				</div><!-- .staff-member-thumb -->

				<div class="staff-member-main">

					<h2 class="staff-member-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

					<?php if ( $staff_position ) : ?>

						<div class="staff-member-position"><?php echo $staff_position; ?></div>

					<?php endif; ?>
						
					<div class="staff-member-excerpt">
						<?php the_excerpt(); ?>
					</div><!-- .staff-member-excerpt -->

					<?php if ( $staff_twitter || $staff_facebook || $staff_gplus || $staff_linkedin ) : ?>

						<div class="staff-member-social">
							
							<?php if ( $staff_twitter ) : ?>

								<a href="<?php echo $staff_twitter; ?>"><span class="icon-social-twitter"></span></a>

							<?php endif; ?>

							<?php if ( $staff_facebook ) : ?>

								<a href="<?php echo $staff_facebook; ?>"><span class="icon-social-facebook"></span></a>

							<?php endif; ?>

							<?php if ( $staff_gplus ) : ?>

								<a href="<?php echo $staff_gplus; ?>"><span class="icon-social-gplus"></span></a>

							<?php endif; ?>

							<?php if ( $staff_linkedin ) : ?>

								<a href="<?php echo $staff_linkedin; ?>"><span class="icon-social-linkedin"></span></a>

							<?php endif; ?>

							<?php if ( $staff_email ) : ?>

								<a href="<?php echo $staff_email; ?>"><span class="icon-mail"></span></a>

							<?php endif; ?>

						</div><!-- .staff-member-social -->

					<?php endif; ?>

					<div class="staff-member-permalink">
						<a href="<?php the_permalink(); ?>" class="dd-button small orange-light"><?php _e( 'CONTINUE READING', 'dd_string' ); ?></a>
					</div><!-- .staff-member-permalink -->

				</div><!-- .staff-member-main -->

			</div><!-- .staff-member-inner -->

			<?php if ( is_sticky() ) : ?><span class="dd-sticky"></span><?php endif; ?>

		<?php elseif ( $dd_style == '2' ) : ?>

			<div class="staff-member-inner clearfix">

				<div class="staff-member-thumb four columns">
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'dd-one-fourth-crop' ); ?></a>
				</div><!-- .staff-member-thumb -->

				<div class="staff-member-main">

					<h2 class="staff-member-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

					<div class="staff-member-meta">

						<?php if ( $staff_position ) : ?>

							<div class="staff-member-position"><?php echo $staff_position; ?></div>

						<?php endif; ?>

						<?php if ( $staff_twitter || $staff_facebook || $staff_gplus || $staff_linkedin ) : ?>

							<div class="staff-member-social">
								
								<?php if ( $staff_twitter ) : ?>

									<a href="<?php echo $staff_twitter; ?>"><span class="icon-social-twitter"></span></a>

								<?php endif; ?>

								<?php if ( $staff_facebook ) : ?>

									<a href="<?php echo $staff_facebook; ?>"><span class="icon-social-facebook"></span></a>

								<?php endif; ?>

								<?php if ( $staff_gplus ) : ?>

									<a href="<?php echo $staff_gplus; ?>"><span class="icon-social-gplus"></span></a>

								<?php endif; ?>

								<?php if ( $staff_linkedin ) : ?>

									<a href="<?php echo $staff_linkedin; ?>"><span class="icon-social-linkedin"></span></a>

								<?php endif; ?>

							</div><!-- .staff-member-social -->

						<?php endif; ?>

					</div><!-- .staff-member-meta -->
						
					<div class="staff-member-excerpt">
						<?php the_excerpt(); ?>
					</div><!-- .staff-member-excerpt -->

					<div class="staff-member-permalink">
						<a href="<?php the_permalink(); ?>" class="dd-button small orange-light"><?php _e( 'CONTINUE READING', 'dd_string' ); ?></a>
					</div><!-- .staff-member-permalink -->

				</div><!-- .staff-member-main -->

			</div><!-- .staff-member-inner -->

		<?php endif; ?>

	</div><!-- .staff-member -->

<?php endif; ?>