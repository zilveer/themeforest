<?php
/**
 * Team info on hover shortcode template
 */
global $libero_mikado_IconCollections;
$number_of_social_icons = 5;
?>

<div class="mkd-team <?php echo esc_attr($team_classes); ?>">
	<div class="mkd-team-inner">
		<?php if ($team_image !== '') { ?>
			<div class="mkd-team-image">
                <?php echo wp_get_attachment_image($team_image,'full'); ?>
			</div>
		<?php } ?>

		<?php if ($team_name !== '' || $team_position !== '' || $team_description != "" || $show_skills == 'yes') { ?>
		<div class="mkd-team-info">
			<?php if ($team_name !== '' || $team_position !== '') { ?>
				<div class="mkd-team-title-holder">
					<?php if ($team_name !== '') { ?>
						<<?php echo esc_attr($team_name_tag); ?> class="mkd-team-name" <?php libero_mikado_inline_style($team_name_style); ?>>
							<?php echo esc_attr($team_name); ?>
						</<?php echo esc_attr($team_name_tag); ?>>
					<?php } ?>
					<?php if ($team_position !== "") { ?>
						<h5 class="mkd-team-position" <?php libero_mikado_inline_style($team_pos_style); ?>><?php echo esc_attr($team_position) ?></h5>
					<?php } ?>
				</div>
			<?php } ?>
		<?php } ?>
			<div class="mkd-team-read-more">
				<?php if($link != '') { ?>
				<a href="<?php echo esc_url($link); ?>">
					<span class="mkd-team-read-more-inner">
						<span class="mkd-team-read-more-text"><?php echo esc_attr($link_text) ?></span>
						<span aria-hidden="true" class="arrow_carrot-right_alt2 mkd-team-read-more-icon"></span>
					</span>
				</a>
				<?php } ?>
			</div>
		</div>
	</div>
	<?php if ($team_description != "") { ?>
		<div class='mkd-team-text'>
			<div class='mkd-team-text-inner'>
				<?php if ($team_description_title != "") { ?>
					<div class="mkd-team-description-title">
						<h4><?php echo esc_html($team_description_title)?></h4>
					</div>
				<?php } ?>
				<div class='mkd-team-description' <?php libero_mikado_inline_style($team_desc_style); ?>>
					<p><?php echo esc_attr($team_description) ?></p>
				</div>
			</div>
		</div>
	<?php } ?>
	<div class="mkd-team-social-holder">
		<div class="mkd-team-social">
			<div class="mkd-team-social-inner">
				<div class="mkd-team-social-wrapp clearfix">

					<?php foreach( $team_social_icons as $team_social_icon ) {
						print $team_social_icon;
					} ?>

				</div>
			</div>
		</div>
	</div>
	<span class="mkd-team-triangle"></span>
</div>