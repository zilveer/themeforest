<?php
/**
 * The Sidebar for the causes.
 */

	global $dd_sn;
	global $dd_donation_currency;

	if ( is_single() ) {

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

		$make_donation_link = get_post_meta( get_the_ID(), $dd_sn . 'cause_single_custom_make_donation_link', true );

		if ( ! $make_donation_link ) {
			$make_donation_link = '#';
		}

	}

?>

	<div id="sidebar" class="one-third column last">

		<div id="sidebar-inner">

			<?php if ( is_single() ) : ?>

				<?php

					if ( ot_get_option( $dd_sn . 'cause_info_widget', 'enabled' ) == 'enabled' ) {

						$info_widget_state = get_post_meta( get_the_ID(), $dd_sn . 'cause_info_widget', true );

						if ( $info_widget_state == '' || $info_widget_state == 'enabled' ) {
							$show_info_widget = true;
						} else { 
							$show_info_widget = false;
						}

					} else {
						$show_info_widget = false;
					}

				?>

				<?php if ( $show_info_widget ) : ?>

					<div class="widget">

						<div class="widget-wrap">

							<div class="cause-info-widget">

								<?php dd_multicol_colors(); ?>

								<div class="cause-info-widget-donated">
									<span><?php echo $dd_donation_currency . dd_add_commas( $donation_current ); ?></span>
									<em><?php _e( 'Donated', 'dd_string' ); ?></em>
								</div>

								<?php if ( $show_donation_bar ) : ?>

									<div class="cause-info-widget-percentage">
										<span><?php echo $donation_percentage; ?>%</span> <?php _e( 'raised of', 'dd_string' ); ?> <span><?php echo $dd_donation_currency . dd_add_commas( $donation_goal ); ?></span> <?php _e( 'goal', 'dd_string' ); ?>
										<div class="cause-info-widget-percentage-bar" data-raised="<?php echo $donation_percentage; ?>%">
											<span></span>
										</div><!-- .cause-info-widget-percentage-bar -->
									</div>

								<?php endif; ?>

								<div class="cause-info-widget-donate">
									<a href="<?php echo $make_donation_link; ?>" class="dd-button big green has-icon"><?php _e( 'MAKE A DONATION', 'dd_string' ); ?><span class="dd-button-icon"><span class="icon-plus"></span></span></a>
								</div>

							</div><!-- .cause-info-widget -->

						</div><!-- .widget-wrap -->

					</div><!-- .widget -->

				<?php endif; ?>

			<?php endif; ?>

			<?php if ( ! dynamic_sidebar( 'sidebar-causes' ) ) : ?>

				<!-- No widgets -->

			<?php endif; ?>

		</div><!-- #sidebar-inner -->

	</div><!-- #sidebar -->