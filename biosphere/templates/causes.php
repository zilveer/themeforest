<?php 
	
	// Globals
	global $dd_sn;
	global $dd_post_class;
	global $dd_thumb_size;
	global $dd_count;
	global $dd_max_count;
	global $dd_style;
	global $dd_donation_currency;
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
		$dd_post_class_append = 'no-thumb ';
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

	/**
	 * Translation Sync
	 */

	$cause_id = get_the_ID();	
	
	if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {

		global $dd_lang_curr;
		global $dd_lang_default;

		if ( $dd_lang_curr != $dd_lang_default ) {

			$cause_id = icl_object_id( get_the_ID(), 'dd_causes', true, $dd_lang_default );

		}

	}

	/**
	 * Donation Info
	 */

	$donation_goal = get_post_meta( $cause_id, $dd_sn . 'cause_amount_needed', true );
	$donation_current = round( get_post_meta( $cause_id, $dd_sn . 'cause_amount_current', true ) );

	$show_donation_bar = true;
	if ( $donation_goal == '' || $donation_goal == 0 ) {
		$show_donation_bar = false;
	}

	if ( $donation_current == '' || $donation_current == 0 ) {
		$donation_percentage = 0;
		$donation_current = 0;
	} else {
		if ( $show_donation_bar ) {
			$donation_percentage = round ( $donation_current / $donation_goal * 100, 2 );
		} else {
			$donation_percentage = '0';
		}
	}

	/**
	 * Custom Links
	 */

	$more_details_link = get_post_meta( get_the_ID(), $dd_sn . 'cause_custom_more_details_link', true );
	$make_donation_link = get_post_meta( get_the_ID(), $dd_sn . 'cause_custom_make_donation_link', true );

	if ( ! $more_details_link ) {
		$more_details_link = get_permalink();
	}

	if ( ! $make_donation_link ) {
		$make_donation_link = add_query_arg( 'dd_donate', 'yes', get_permalink( get_the_ID() ) );
	}

	if ( $donation_percentage >= 100 ) {
		$dd_post_class_append .= ' cause-funded ';
	}

?>

<?php if ( is_single() ) : ?>
		
	

<?php else : ?>

	<div <?php post_class( 'cause clearfix ' . $dd_post_class . $dd_post_class_append . $last_class ); ?>>

		<?php if ( $dd_style == '1' ) : ?>

			<div class="cause-inner">

				<div class="cause-thumb">

					<a href="<?php echo $more_details_link; ?>"><?php the_post_thumbnail( $dd_thumb_size ); ?></a>

				</div><!-- .cause-thumb -->

				<div class="cause-main">

					<div class="cause-meta clearfix">

						<h2 class="cause-title"><a href="<?php echo $more_details_link; ?>"><?php the_title(); ?></a></h2>
						
						<div class="cause-excerpt">
							<?php the_excerpt(); ?>
						</div><!-- .cause-excerpt -->

					</div><!-- .cause-meta -->

				</div><!-- .cause-main -->		

				<div class="cause-info">
											
					<div class="cause-info-content clearfix">
						
						<div class="fl cause-info-donated">
							<span><?php echo $dd_donation_currency . dd_add_commas( $donation_current ); ?></span> <?php _e ( 'Donated', 'dd_string' ); ?>
						</div><!-- .cause-info-donated -->

						<?php if ( $show_donation_bar ) : ?>

							<div class="fr cause-info-funded">
								<span><?php echo $donation_percentage; ?>%</span> <?php _e ( 'Funded', 'dd_string' ); ?>
							</div><!-- .cause-info-funded -->

						<?php endif; ?>

					</div><!-- .cause-info-content -->

					<?php if ( $show_donation_bar ) : ?>

						<div class="cause-info-bar" data-raised="<?php echo $donation_percentage; ?>%">
							<span></span>
						</div><!-- .cause-info-bar -->

					<?php endif; ?>

					<div class="cause-info-links">
						<a href="<?php echo $more_details_link; ?>" class="dd-button cause-info-link-more orange-light small"><?php _e( 'MORE DETAILS', 'dd_string' ); ?></a>
						<span><?php _e( 'or', 'dd_string' ); ?></span>
						<a href="<?php echo $make_donation_link; ?>" class="dd-button cause-info-link-donate green small"><?php _e( 'MAKE A DONATION', 'dd_string' ); ?></a>
					</div><!-- .cause-info-links -->

				</div><!-- .cause-info -->

			</div><!-- .cause-inner -->

		<?php elseif ( $dd_style == '2' ) : ?>

			<div class="cause-inner">

				<?php if ( has_post_thumbnail() ) : ?>

					<div class="cause-thumb four columns">

						<a href="<?php echo $more_details_link; ?>"><?php the_post_thumbnail( 'dd-one-fourth-crop' ); ?></a>

						<div class="cause-info">
													
							<div class="cause-info-content clearfix">
								
								<div class="fl cause-info-donated">
									<span><?php echo $dd_donation_currency . dd_add_commas( $donation_current ); ?></span> <?php _e ( 'Donated', 'dd_string' ); ?>
								</div><!-- .cause-info-donated -->

								<?php if ( $show_donation_bar ) : ?>

									<div class="fr cause-info-funded">
										<span><?php echo $donation_percentage; ?>%</span> <?php _e ( 'Funded', 'dd_string' ); ?>
									</div><!-- .cause-info-funded -->

								<?php endif; ?>

							</div><!-- .cause-info-content -->

							<?php if ( $show_donation_bar ) : ?>

								<div class="cause-info-bar" data-raised="<?php echo $donation_percentage; ?>%">
									<span></span>
								</div><!-- .cause-info-bar -->

							<?php endif; ?>

						</div><!-- .cause-info -->

					</div><!-- .cause-thumb -->

				<?php endif; ?>

				<div class="cause-main">

					<h2 class="cause-title"><a href="<?php echo $more_details_link; ?>"><?php the_title(); ?></a></h2>
					
					<div class="cause-excerpt">
						<?php the_excerpt(); ?>
					</div><!-- .cause-excerpt -->

					<?php if ( ! has_post_thumbnail() ) : ?>

						<div class="cause-info">
														
							<div class="cause-info-content clearfix">
								
								<div class="fl cause-info-donated">
									<span><?php echo $dd_donation_currency . dd_add_commas( $donation_current ); ?></span> <?php _e ( 'Donated', 'dd_string' ); ?>
								</div><!-- .cause-info-donated -->

								<?php if ( $show_donation_bar ) : ?>

									<div class="fr cause-info-funded">
										<span><?php echo $donation_percentage; ?>%</span> <?php _e ( 'Funded', 'dd_string' ); ?>
									</div><!-- .cause-info-funded -->

								<?php endif; ?>

							</div><!-- .cause-info-content -->

							<?php if ( $show_donation_bar ) : ?>

								<div class="cause-info-bar" data-raised="<?php echo $donation_percentage; ?>%">
									<span></span>
								</div><!-- .cause-info-bar -->

							<?php endif; ?>

						</div><!-- .cause-info -->

					<?php endif; ?>

					<div class="cause-info-links">
						<a href="<?php echo $more_details_link; ?>" class="dd-button cause-info-link-more orange-light small"><?php _e( 'MORE DETAILS', 'dd_string' ); ?></a>
						<span><?php _e( 'or', 'dd_string' ); ?></span>
						<a href="<?php echo $make_donation_link; ?>" class="dd-button cause-info-link-donate green small"><?php _e( 'MAKE A DONATION', 'dd_string' ); ?></a>
					</div><!-- .cause-info-links -->

				</div><!-- .cause-main -->

			</div><!-- .cause-inner -->

		<?php endif; ?>

	</div><!-- .cause -->

<?php endif; ?>