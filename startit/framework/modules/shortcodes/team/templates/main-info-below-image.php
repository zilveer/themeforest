<?php
/**
 * Team info on hover shortcode template
 */
global $qode_startit_IconCollections;
$number_of_social_icons = 5;
?>

<div class="qodef-team <?php echo esc_attr($team_type) ?>">
	<div class="qodef-team-inner">
		<?php if ($team_image !== '') { ?>
			<div class="qodef-team-image">
				<img src="<?php print $team_image_src; ?>" alt="qodef-team-image"/>
				<div class="qodef-team-position-holder">
					<div class="qodef-circle-animate"></div>
					<div class="qodef-team-position-icon">
						<?php echo qode_startit_execute_shortcode('qodef_icon', $icon_parameters); ?>
					</div>
					<?php if ($team_position !== "") { ?>
						<h6 class="q_team_position"><?php echo esc_attr($team_position) ?></h6>
					<?php } ?>
				</div>
			</div>
		<?php } ?>

		<?php if ($team_name !== '' || $team_position !== '' || $team_description != "" || $show_skills == 'yes') { ?>
			<div class="qodef-team-info">
				<?php if ($team_name !== '' || $team_position !== '') { ?>
					<div class="qodef-team-title-holder">
						<?php if ($team_name !== '') { ?>
							<<?php echo esc_attr($team_name_tag); ?> class="qodef-team-name">
								<?php echo esc_attr($team_name); ?>
							</<?php echo esc_attr($team_name_tag); ?>>
						<?php } ?>
						
					</div>
				<?php } ?>

				<?php if ($team_description != "") { ?>
					<div class='qodef-team-text'>
						<div class='qodef-team-text-inner'>
							<div class='qodef-team-description'>
								<p><?php echo esc_attr($team_description) ?></p>
							</div>
						</div>
					</div>
				<?php }
			} ?>
		</div>
	</div>
</div>