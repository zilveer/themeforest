<div class="mkd-pie-chart-doughnut-holder">
	<div class="mkd-pie-chart-doughnut">
		<canvas id="pie<?php echo esc_attr($id); ?>" class="mkd-doughnut" height="<?php echo esc_html($height); ?>" width="<?php echo esc_html($width); ?>" <?php echo hue_mikado_get_inline_attrs($pie_chart_data)?>></canvas>
	</div>
	<div class="mkd-pie-legend">
		<ul>
			<?php foreach ($legend_data as $legend_data_item) { ?>
			<li>
				<div class="mkd-pie-color-holder" <?php hue_mikado_inline_style($legend_data_item['color'])?> ></div>
				<p><?php echo esc_html($legend_data_item['legend']); ?></p>
			<?php } ?>
			</li>
		</ul>
	</div>
</div>