<div class="mkd-pie-chart-with-icon-holder">
	<div class="mkd-percentage-with-icon" <?php echo libero_mikado_get_inline_attrs($pie_chart_data); libero_mikado_inline_style($pie_chart_style);?>>
		<?php print $icon; ?>
	</div>
	<div class="mkd-pie-chart-text" <?php libero_mikado_inline_style($pie_chart_text_style);?>>
		<<?php echo esc_html($title_tag)?> class="mkd-pie-title">
			<?php echo esc_html($title); ?>
		</<?php echo esc_html($title_tag)?>>
		<p><?php echo esc_html($text); ?></p>
	</div>
</div>