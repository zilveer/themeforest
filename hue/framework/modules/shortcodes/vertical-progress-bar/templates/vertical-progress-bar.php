<div class="mkd-vertical-progress-bar-holder">
	<div class="mkd-vpb-bar" <?php echo hue_mikado_get_inline_attrs($progress_bar_data); ?>>
		<div class="mkd-vpb-inactive-bar" <?php hue_mikado_inline_style($inactive_style); ?>></div>
		<div class="mkd-vpb-active-bar" <?php hue_mikado_inline_style($active_style); ?>></div>
	</div>

	<div class="mkd-vpb-content">
		<?php if($title !== '') : ?>
			<div class="mkd-vpb-title">
				<h6><?php echo esc_html($title); ?></h6>
			</div>
		<?php endif; ?>

		<?php if($percent !== '') : ?>
			<div class="mkd-vpb-percent">
				<h6>
					<span class="mkd-vpb-percent-number"><?php echo esc_html($percent); ?></span><!--
				<--><span class="mkd-vpb-percent-mark">%</span>
				</h6>
			</div>
		<?php endif; ?>
	</div>
</div>