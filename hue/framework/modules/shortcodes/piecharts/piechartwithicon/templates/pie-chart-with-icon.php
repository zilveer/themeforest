<div class="mkd-pie-chart-with-icon-holder" <?php echo hue_mikado_get_inline_attrs($data_attr); ?>>
	<div class="mkd-percentage-with-icon <?php echo esc_attr($icon_holder_classes); ?>" <?php echo hue_mikado_get_inline_attrs($pie_chart_data); ?>>
		<?php print $icon; ?>
	</div>
	<div class="mkd-pie-chart-text" <?php hue_mikado_inline_style($pie_chart_style)?>>
		<<?php echo esc_html($title_tag)?> class="mkd-pie-title">
			<?php echo esc_html($title); ?>
		</<?php echo esc_html($title_tag)?>>
		<p><?php echo esc_html($text); ?></p>
	</div>
</div>