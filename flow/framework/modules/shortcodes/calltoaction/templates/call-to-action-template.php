<?php
/**
 * Call to action shortcode template
 */
?>

<?php if ($full_width == "no") { ?>
	<div class="eltd-container-inner">
<?php } ?>

	<div class="eltd-call-to-action <?php echo esc_attr($type) ?>">

		<?php if ($content_in_grid == 'yes' && $full_width == 'yes') { ?>
		<div class="eltd-container-inner">
		<?php }

		if ($grid_size == "75") { ?>
			<div class="eltd-call-to-action-row-75-25 clearfix" <?php echo flow_elated_get_inline_style($call_to_action_styles) ?>>
		<?php } elseif ($grid_size == "66") { ?>
			<div class="eltd-call-to-action-row-66-33 clearfix" <?php echo flow_elated_get_inline_style($call_to_action_styles) ?>>
		<?php } else { ?>
			<div class="eltd-call-to-action-row-50-50 clearfix" <?php echo flow_elated_get_inline_style($call_to_action_styles) ?>>
		<?php } ?>

				<div class="eltd-text-wrapper <?php echo esc_attr($text_wrapper_classes) ?>">

				<?php if ($type == "with-icon") { ?>
					<div class="eltd-call-to-action-icon-holder">
						<div class="eltd-call-to-action-icon">
							<div class="eltd-call-to-action-icon-inner">
								<?php print $icon; ?>
							</div>
						</div>
					</div>
				<?php } ?>

					<div class="eltd-call-to-action-text" <?php echo flow_elated_get_inline_style($content_styles) ?>>
						<?php
						echo do_shortcode($content);
						?>
					</div>

				</div>

				<?php if ($show_button == 'yes') { ?>

					<div class="eltd-button-wrapper eltd-call-to-action-column2 eltd-call-to-action-cell" style ="text-align: <?php echo esc_attr($button_position) ?> ;">

						<?php echo flow_elated_get_button_html($button_parameters); ?>

					</div>

				<?php } ?>

			</div>

		<?php if ($content_in_grid == 'yes' && $full_width == 'yes') { ?>
		</div>
		<?php } ?>

	</div>

<?php if ($full_width == 'no') { ?>
	</div>
<?php } ?>