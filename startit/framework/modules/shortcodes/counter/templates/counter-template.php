<?php
/**
 * Counter shortcode template
 */
?>
<div class="qodef-counter-holder <?php echo esc_attr($position); ?>" <?php echo qode_startit_get_inline_style($counter_holder_styles); ?>>
	<div class="qodef-counter-content-top" <?php echo qode_startit_get_inline_style($counter_styles); ?>>
		<span class="qodef-counter-icon">
			<?php print $icon; ?>
		</span>
		<span class="qodef-counter <?php echo esc_attr($type) ?>">
			<?php echo esc_attr($digit); ?>
		</span>
	</div>
	<div class="qodef-counter-content-bottom">
		<<?php echo esc_html($title_tag); ?> class="qodef-counter-title" <?php echo qode_startit_get_inline_style($counter_title_styles); ?>>
			<?php echo esc_attr($title); ?>
		</<?php echo esc_html($title_tag);; ?>>
		<?php if ($text != "") { ?>
			<p class="qodef-counter-text"><?php echo esc_html($text); ?></p>
		<?php } ?>
	</div>
</div>