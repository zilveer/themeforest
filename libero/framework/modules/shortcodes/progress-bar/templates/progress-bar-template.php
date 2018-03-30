<div class="mkd-progress-bar">
	<<?php echo esc_attr($title_tag);?> class="mkd-progress-title-holder clearfix">
		<span class="mkd-progress-title" <?php libero_mikado_inline_style(array($title_color)); ?> ><?php echo esc_attr($title)?></span>
		<span class="mkd-progress-number-wrapper <?php echo esc_attr($percentage_classes)?> " >
			<span class="mkd-progress-number">
				<span class="mkd-percent">0</span>
			</span>
		</span>
	</<?php echo esc_attr($title_tag)?>>
	<div class="mkd-progress-content-outer" <?php libero_mikado_inline_style(array($percentage_bar_inactive_color)); ?>>
		<div data-percentage=<?php echo esc_attr($percent)?> class="mkd-progress-content" <?php libero_mikado_inline_style(array($percentage_bar_color)); ?>></div>
	</div>
</div>	