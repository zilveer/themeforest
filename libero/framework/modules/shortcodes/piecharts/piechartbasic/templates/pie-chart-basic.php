<?php
/**
 * Pie Chart Basic Shortcode Template
 */
?>
<div class="mkd-pie-chart-holder">
	<div class="mkd-percentage" <?php echo libero_mikado_get_inline_attrs($pie_chart_data); libero_mikado_inline_style($pie_chart_style);?>>
		<?php if ($type_of_central_text == "title") { ?>
			<<?php echo esc_attr($title_tag); ?> class="mkd-pie-title">
				<?php echo esc_html($title); ?>
			</<?php echo esc_attr($title_tag); ?>>
		<?php } else { ?>
			<span class="mkd-to-counter">
				<?php echo esc_html($percent ); ?>
			</span>
		<?php } ?>
	</div>
	<div class="mkd-pie-chart-text" <?php libero_mikado_inline_style($pie_chart_text_style); ?>>
		<?php if ($type_of_central_text == "title") { ?>
			<span class="mkd-to-counter">
				<?php echo esc_html($percent ); ?>
			</span>
		<?php } else { ?>
			<<?php echo esc_attr($title_tag); ?> class="mkd-pie-title">
				<?php echo esc_html($title); ?>
			</<?php echo esc_attr($title_tag); ?>>
		<?php } ?>
		<p><?php echo esc_html($text); ?></p>
	</div>
</div>