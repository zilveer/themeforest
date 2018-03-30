<?php
/**
 * Pie Chart Basic Shortcode Template
 */
?>
<div class="qodef-pie-chart-holder">
	<div class="qodef-percentage" <?php echo suprema_qodef_get_inline_attrs($pie_chart_data); ?>>
		<?php if ($type_of_central_text == "title") { ?>
			<<?php echo esc_attr($title_tag); ?> class="qodef-pie-title">
				<?php echo esc_html($title); ?>
			</<?php echo esc_attr($title_tag); ?>>
		<?php } else { ?>
			<span class="qodef-to-counter">
				<?php echo esc_html($percent ); ?>
			</span>
		<?php } ?>
	</div>
	<div class="qodef-pie-chart-text" <?php suprema_qodef_inline_style($pie_chart_style); ?>>
		<?php if ($type_of_central_text == "title") { ?>
			<span class="qodef-to-counter">
				<?php echo esc_html($percent ); ?>
			</span>
		<?php } else { ?>
			<<?php echo esc_attr($title_tag); ?> class="qodef-pie-title">
				<?php echo esc_html($title); ?>
			</<?php echo esc_attr($title_tag); ?>>
		<?php } ?>
		<p><?php echo esc_html($text); ?></p>
	</div>
</div>