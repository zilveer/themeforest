<div class="qodef-progress-bar">
	<<?php echo esc_attr($title_tag);?> class="qodef-progress-title-holder clearfix">
		<span class="qodef-progress-title"><?php echo esc_attr($title)?></span>
		<span class="qodef-progress-number-wrapper <?php echo esc_attr($percentage_classes)?> " >
			<span class="qodef-progress-number">
				<span class="qodef-percent">0</span>	
				<?php if($floating_type == 'floating_outside' ){ ?>
					<span class="qodef-down-arrow"></span>
				<?php }?>
			</span>
		</span>
	</<?php echo esc_attr($title_tag)?>>
	<div class="qodef-progress-content-outer " <?php  echo suprema_qodef_get_inline_style($inactive_bar_style)?>>
		<div data-percentage=<?php echo esc_attr($percent)?> class="qodef-progress-content" <?php  echo suprema_qodef_get_inline_style($active_bar_style)?>></div>
	</div>
</div>	