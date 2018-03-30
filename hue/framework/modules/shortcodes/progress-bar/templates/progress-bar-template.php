<div class="mkd-progress-bar">
	<h6 class="mkd-progress-title-holder clearfix">
		<span class="mkd-progress-title" <?php hue_mikado_inline_style($title_color); ?>><?php echo esc_attr($title) ?></span>
		<span class="mkd-progress-number-wrapper <?php echo esc_attr($percentage_classes) ?> ">
			<span class="mkd-progress-number">
				<span class="mkd-percent" <?php hue_mikado_inline_style($percentage_color); ?>>0</span>
			</span>
		</span>
	</h6>

	<div class="mkd-progress-content-outer" <?php hue_mikado_inline_style($inactive_bar_style); ?>>
		<div data-percentage=<?php echo esc_attr($percent) ?> class="mkd-progress-content <?php echo esc_attr($bar_class); ?>"></div>
	</div>
</div>	