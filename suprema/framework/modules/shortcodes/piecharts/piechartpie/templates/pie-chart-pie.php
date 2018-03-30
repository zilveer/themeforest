<div class="qodef-pie-chart-pie-holder">
	<div class="qodef-pie-chart-pie">
		<canvas id="pie<?php echo esc_attr($id); ?>" class="qodef-pie" height="<?php echo esc_html($height); ?>" width="<?php echo esc_html($width); ?>" <?php echo suprema_qodef_get_inline_attrs($pie_chart_data)?>></canvas>
	</div>
	<div class="qodef-pie-legend">
		<ul>
			<?php foreach ($legend_data as $legend_data_item) { ?>
			<li>
				<div class="qodef-pie-color-holder" <?php suprema_qodef_inline_style($legend_data_item['color'])?> ></div>
				<p><?php echo esc_html($legend_data_item['legend']); ?></p>
				<?php } ?>
			</li>
		</ul>
	</div>
</div>