<?php
/**
 * Team info on hover shortcode template
 */

?>

<div class="qodef-team <?php echo esc_attr( $team_type )?>">
	<div class="qodef-team-inner">
		<?php if ( $team_image !== '' ) { ?>
		<div class="qodef-team-image">
			<img src="<?php echo esc_url($team_image_src); ?>" alt="team-image" />
			<div class="qodef-team-social-holder">
				<div class="qodef-team-social">
					<div class="qodef-team-social-inner">
						<div class="qodef-team-title-holder">
							<?php if ( $team_name !== '' ) { ?>
							<<?php echo esc_attr($team_name_tag); ?> class="qodef-team-name">
								<?php echo esc_attr( $team_name ); ?>
							</<?php echo esc_attr($team_name_tag); ?>>
							<?php }
							if ( $team_position !== '' ) { ?>
							<h6 class="qodef-team-position">
								<?php echo esc_attr( $team_position ); ?>
							</h6>
							<?php } ?>
						</div>
						<div class="qodef-team-social-wrapp">
							<?php echo qode_startit_execute_shortcode('qodef_icon', $icon_parameters); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php }

		if ($team_description !== '') { ?>
		<div class="qodef-team-text">
			<div class="qodef-team-text-inner">
				<div class="qodef-team-description">
					<p><?php echo esc_attr( $team_description ); ?></p>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
</div>