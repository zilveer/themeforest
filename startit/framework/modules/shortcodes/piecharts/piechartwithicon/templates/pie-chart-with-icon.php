<div class="qodef-pie-chart-with-icon-holder">
	<div class="qodef-percentage-with-icon" <?php echo qode_startit_get_inline_attrs($pie_chart_data); ?>>
		<?php print $icon; ?>
	</div>
	<div class="qodef-pie-chart-text" <?php qode_startit_inline_style($pie_chart_style)?>>
		<<?php echo esc_html($title_tag)?> class="qodef-pie-title">
			<?php echo esc_html($title); ?>
		</<?php echo esc_html($title_tag)?>>
		<p><?php echo esc_html($text); ?></p>
	</div>
</div>