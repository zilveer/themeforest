<?php
/**
 * Call to action shortcode template
 */

$content = preg_replace('#^<\/p>|<p>$#', '', $content);
?>

<?php if ($full_width == "no") { ?>
	<div class="qodef-container-inner">
<?php } ?>

	<div class="qodef-call-to-action <?php echo esc_attr($type) ?>">

		<?php if ($content_in_grid == 'yes' && $full_width == 'yes') { ?>
		<div class="qodef-container-inner">
		<?php }

		if ($grid_size == "75") { ?>
			<div class="qodef-call-to-action-row-75-25 clearfix" <?php echo qode_startit_get_inline_style($call_to_action_styles) ?>>
		<?php } elseif ($grid_size == "66") { ?>
			<div class="qodef-call-to-action-row-66-33 clearfix" <?php echo qode_startit_get_inline_style($call_to_action_styles) ?>>
		<?php } else { ?>
			<div class="qodef-call-to-action-row-50-50 clearfix" <?php echo qode_startit_get_inline_style($call_to_action_styles) ?>>
		<?php } ?>

				<div class="qodef-text-wrapper <?php echo esc_attr($text_wrapper_classes) ?>">

				<?php if ($type == "with-icon") { ?>
					<div class="qodef-call-to-action-icon-holder">
						<div class="qodef-call-to-action-icon">
							<div class="qodef-call-to-action-icon-inner">
								<?php print $icon; ?>
							</div>
						</div>
					</div>
				<?php } ?>

					<div class="qodef-call-to-action-text" <?php echo qode_startit_get_inline_style($content_styles) ?>>
						<?php
						echo do_shortcode($content)
						?>
					</div>

				</div>

				<?php if ($show_button == 'yes') { ?>

					<div class="qodef-button-wrapper qodef-call-to-action-column2 qodef-call-to-action-cell" style ="text-align: <?php echo esc_attr($button_position) ?> ;">

						<?php echo qode_startit_get_button_html($button_parameters); ?>

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